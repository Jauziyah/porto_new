<?php

namespace App\Controllers;

use App\Models\Profile_model;
use App\Models\UserModel;
use CodeIgniter\Controller;

class Profile_controller extends BaseController
{
    public function index()
    {
        // Authentication removed - filter will handle it
        $model = new Profile_model();
        $data = $model->getProfileData();
        return view('pages/profile', $data);
    }

    // PUBLIC API METHODS FOR PORTFOLIO
    public function getCategories()
    {
        $model = new Profile_model();
        $categories = $model->getCategoriesData(); // This method now exists
        return $this->response->setJSON($categories);
    }

    public function getTechStack()
    {
        $model = new Profile_model();
        $techStack = $model->getTechStackData(); // This method now exists
        return $this->response->setJSON($techStack);
    }
    public function storeCategory()
    {
        // Authentication removed - filter will handle it
        helper('url');
        $model = new Profile_model();
        $name = trim((string) $this->request->getPost('name'));
        $slug = $name !== '' ? url_title($name, '-', true) : '';
        if ($name === '' || $slug === '') {
            return redirect()->back()->with('error', 'Name and slug are required');
        }
        $model->createCategory([
            'name' => $name,
            'slug' => $slug,
        ]);
        return redirect()->to('/profile/manage');
    }

    public function updateCategory($id)
    {
        // Authentication removed - filter will handle it
        helper('url');
        $model = new Profile_model();
        $name = trim((string) $this->request->getPost('name'));
        $slug = $name !== '' ? url_title($name, '-', true) : '';
        if ($name === '' || $slug === '') {
            return redirect()->back()->with('error', 'Name and slug are required');
        }
        $model->updateCategoryById((int)$id, [
            'name' => $name,
            'slug' => $slug,
        ]);
        return redirect()->to('/profile/manage');
    }

    public function deleteCategory($id)
    {
        // Authentication removed - filter will handle it
        $model = new Profile_model();
        $model->deleteCategoryById((int)$id);
        return redirect()->to('/profile/manage');
    }

    public function storeTech()
    {
        // Authentication removed - filter will handle it
        helper('url');
        $model = new Profile_model();
        $name = trim((string) $this->request->getPost('name'));
        $type = trim((string) $this->request->getPost('type'));
        $slug = $name !== '' ? url_title($name, '-', true) : '';
        if ($name === '' || $slug === '') {
            return redirect()->back()->with('error', 'Name and slug are required');
        }

        $imageUrl = null;
        $file = $this->request->getFile('image');
        if ($file && $file->isValid() && !$file->hasMoved()) {
            $targetDir = rtrim(FCPATH, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR . 'upload' . DIRECTORY_SEPARATOR . 'tech_stack' . DIRECTORY_SEPARATOR;
            if (!is_dir($targetDir)) {
                @mkdir($targetDir, 0755, true);
            }
            $newName = $file->getRandomName();
            $file->move($targetDir, $newName);
            $imageUrl = $newName; // store filename only
        }

        $model->createTech([
            'name' => $name,
            'slug' => $slug,
            'type' => $type ?: null,
            'image_url' => $imageUrl,
        ]);
        return redirect()->to('/profile/manage');
    }

    public function updateTech($id)
    {
        // Authentication removed - filter will handle it
        helper('url');
        $model = new Profile_model();
        $name = trim((string) $this->request->getPost('name'));
        $type = trim((string) $this->request->getPost('type'));
        $slug = $name !== '' ? url_title($name, '-', true) : '';
        if ($name === '' || $slug === '') {
            return redirect()->back()->with('error', 'Name and slug are required');
        }

        $updateData = [
            'name' => $name,
            'slug' => $slug,
            'type' => $type ?: null,
        ];

        $file = $this->request->getFile('image');
        if ($file && $file->isValid() && !$file->hasMoved()) {
            $targetDir = rtrim(FCPATH, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR . 'upload' . DIRECTORY_SEPARATOR . 'tech_stack' . DIRECTORY_SEPARATOR;
            if (!is_dir($targetDir)) {
                @mkdir($targetDir, 0755, true);
            }
            $newName = $file->getRandomName();
            $file->move($targetDir, $newName);
            $updateData['image_url'] = $newName; // store filename only

            // delete old image file
            $oldImage = $model->getTechById((int)$id);
            if ($oldImage['image_url']) {
                $oldImagePath = rtrim(FCPATH, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR . 'upload' . DIRECTORY_SEPARATOR . 'tech_stack' . DIRECTORY_SEPARATOR . $oldImage['image_url'];
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }
        }

        $model->updateTechById((int)$id, $updateData);
        return redirect()->to('/profile/manage');
    }

    public function deleteTech($id)
    {
        // Authentication removed - filter will handle it
        $model = new Profile_model();
        $model->deleteTechById((int)$id);
        return redirect()->to('/profile/manage');
    }

    public function serveImage($filename)
    {
        $filePath = rtrim(FCPATH, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR . 'upload' . DIRECTORY_SEPARATOR . 'tech_stack' . DIRECTORY_SEPARATOR . $filename;

        if (!file_exists($filePath)) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Image not found');
        }

        $mimeType = mime_content_type($filePath);
        $this->response->setHeader('Content-Type', $mimeType);
        $this->response->setHeader('Content-Length', filesize($filePath));

        return $this->response->sendFile($filePath);
    }

    public function storeCertificate()
    {
        // Authentication removed - filter will handle it
        helper('url');
        $model = new Profile_model();
        $session = session();
        $userId = (int) ($session->get('user_id') ?? 0);

        $title = trim((string) $this->request->getPost('title'));
        $slug = $title !== '' ? url_title($title, '-', true) : '';
        $description = trim((string) $this->request->getPost('description')) ?: null;
        $issuer = trim((string) $this->request->getPost('issuer'));
        $achievedAt = $this->request->getPost('achieved_at');

        if ($userId <= 0) {
            // Fallback: resolve user_id via username for legacy sessions
            $username = (string) ($session->get('username') ?? '');
            if ($username !== '') {
                $userModel = new UserModel();
                $user = $userModel->getUserByUsername($username);
                if (!empty($user) && isset($user['id'])) {
                    $userId = (int) $user['id'];
                }
            }
            if ($userId <= 0) {
                return redirect()->back()->with('error', 'User session missing. Please re-login.');
            }
        }

        if ($title === '' || $slug === '' || $issuer === '' || empty($achievedAt)) {
            return redirect()->back()->with('error', 'Title, issuer, and achieved date are required');
        }

        $imageUrl = null;
        $file = $this->request->getFile('image');
        if ($file && $file->isValid() && !$file->hasMoved()) {
            $targetDir = rtrim(FCPATH, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR . 'upload' . DIRECTORY_SEPARATOR . 'profile' . DIRECTORY_SEPARATOR;
            if (!is_dir($targetDir)) {
                @mkdir($targetDir, 0755, true);
            }
            $newName = $file->getRandomName();
            $file->move($targetDir, $newName);
            $imageUrl = $newName; // store filename only
        }

        $model->createCertificate([
            'user_id' => $userId,
            'title' => $title,
            'slug' => $slug,
            'description' => $description,
            'issued_by' => $issuer,
            'achieved_at' => $achievedAt,
            'image_url' => $imageUrl,
        ]);

        return redirect()->to('/profile/manage');
    }

    public function updateCertificate($id)
    {
        // Authentication removed - filter will handle it
        helper('url');
        $model = new Profile_model();

        $title = trim((string) $this->request->getPost('title'));
        $slug = $title !== '' ? url_title($title, '-', true) : '';
        $description = trim((string) $this->request->getPost('description')) ?: null;
        $issuer = trim((string) $this->request->getPost('issuer'));
        $achievedAt = $this->request->getPost('achieved_at');

        if ($title === '' || $slug === '' || $issuer === '' || empty($achievedAt)) {
            return redirect()->back()->with('error', 'Title, issuer, and achieved date are required');
        }

        $updateData = [
            'title' => $title,
            'slug' => $slug,
            'description' => $description,
            'issued_by' => $issuer,
            'achieved_at' => $achievedAt,
        ];

        $file = $this->request->getFile('image');
        if ($file && $file->isValid() && !$file->hasMoved()) {
            $targetDir = rtrim(FCPATH, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR . 'upload' . DIRECTORY_SEPARATOR . 'profile' . DIRECTORY_SEPARATOR;
            if (!is_dir($targetDir)) {
                @mkdir($targetDir, 0755, true);
            }
            $newName = $file->getRandomName();
            $file->move($targetDir, $newName);
            $updateData['image_url'] = $newName; // store filename only

            // delete old image file
            $old = $model->getCertificateById((int)$id);
            if (!empty($old['image_url'])) {
                $oldImagePath = $targetDir . $old['image_url'];
                if (file_exists($oldImagePath)) {
                    @unlink($oldImagePath);
                }
            }
        }

        $model->updateCertificateById((int)$id, $updateData);
        return redirect()->to('/profile/manage');
    }

    public function deleteCertificate($id)
    {
        // Authentication removed - filter will handle it
        $model = new Profile_model();

        // remove image file if exists
        $existing = $model->getCertificateById((int)$id);
        if (!empty($existing['image_url'])) {
            $targetDir = rtrim(FCPATH, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR . 'upload' . DIRECTORY_SEPARATOR . 'profile' . DIRECTORY_SEPARATOR;
            $path = $targetDir . $existing['image_url'];
            if (file_exists($path)) {
                @unlink($path);
            }
        }

        $model->deleteCertificateById((int)$id);
        return redirect()->to('/profile/manage');
    }

    public function getCertificates(){
        $model = new Profile_model();
        $certificates = $model->getCertificates();
        return $this->response->setJSON($certificates);
    }
}

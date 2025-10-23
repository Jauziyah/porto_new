<?php

namespace App\Controllers;

use App\Models\Profile_model;
use CodeIgniter\Controller;

class Profile_controller extends Controller
{
    public function index()
    {
        $session = session();
        if (!$session->get('isLoggedIn')) {
            return redirect()->to('/auth');
        }

        $model = new Profile_model();
        $data = $model->getProfileData();
        return view('pages/profile', $data);
    }

    public function storeCategory()
    {
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
        $model = new Profile_model();
        $model->deleteCategoryById((int)$id);
        return redirect()->to('/profile/manage');
    }

    public function storeTech()
    {
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
}
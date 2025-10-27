<?php
namespace App\Controllers;

use CodeIgniter\API\ResponseTrait;
use App\Models\Pkl_model;
use App\Models\UserModel;

class Pkl_controller extends BaseController{
    public function index(){
        $session = session();
        $userId = (int) ($session->get('user_id') ?? 0);

        if ($userId <= 0) {
            $username = (string) ($session->get('username') ?? '');
            if ($username !== '') {
                $userModel = new UserModel();
                $user = $userModel->getUserByUsername($username);
                if (!empty($user) && isset($user['id'])) {
                    $userId = (int) $user['id'];
                }
            }
        }

        $model = new Pkl_model();
        $data = [
            'pkl_list' => $userId > 0 ? $model->getAllByUser($userId) : []
        ];
        return view('pages/pkl', $data);
    }

    public function store(){
        helper('url');
        $session = session();
        $userId = (int) ($session->get('user_id') ?? 0);

        if ($userId <= 0) {
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

        $title = trim((string) $this->request->getPost('title'));
        $description = trim((string) $this->request->getPost('description')) ?: null;

        if ($title === '') {
            return redirect()->back()->with('error', 'Title is required');
        }

        $imageUrl = null;
        $file = $this->request->getFile('image');
        if ($file && $file->isValid() && !$file->hasMoved()) {
            $targetDir = rtrim(FCPATH, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR . 'upload' . DIRECTORY_SEPARATOR . 'pkl' . DIRECTORY_SEPARATOR;
            if (!is_dir($targetDir)) {
                @mkdir($targetDir, 0755, true);
            }
            $newName = $file->getRandomName();
            $file->move($targetDir, $newName);
            $imageUrl = $newName;
        }

        $model = new Pkl_model();
        $model->createItem([
            'user_id' => $userId,
            'title' => $title,
            'description' => $description,
            'image_url' => $imageUrl,
        ]);

        return redirect()->to('/pkl');
    }

    public function update($id){
        helper('url');
        $model = new Pkl_model();

        $existing = $model->getById((int)$id);
        if (!$existing) {
            return redirect()->back()->with('error', 'Item not found');
        }

        $titlePost = $this->request->getPost('title');
        $descriptionPost = $this->request->getPost('description');
        $updateData = [];

        if ($titlePost !== null) {
            $updateData['title'] = trim((string)$titlePost);
        }
        if ($descriptionPost !== null) {
            $updateData['description'] = trim((string)$descriptionPost);
        }

        $file = $this->request->getFile('image');
        if ($file && $file->isValid() && !$file->hasMoved()) {
            $targetDir = rtrim(FCPATH, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR . 'upload' . DIRECTORY_SEPARATOR . 'pkl' . DIRECTORY_SEPARATOR;
            if (!is_dir($targetDir)) {
                @mkdir($targetDir, 0755, true);
            }
            $newName = $file->getRandomName();
            $file->move($targetDir, $newName);
            $updateData['image_url'] = $newName;

            if (!empty($existing['image_url'])) {
                $oldImagePath = $targetDir . $existing['image_url'];
                if (file_exists($oldImagePath)) {
                    @unlink($oldImagePath);
                }
            }
        }

        if (!empty($updateData)) {
            $model->updateById((int)$id, $updateData);
        }

        return redirect()->to('/pkl');
    }

    public function delete($id){
        $model = new Pkl_model();
        $existing = $model->getById((int)$id);
        if ($existing) {
            $targetDir = rtrim(FCPATH, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR . 'upload' . DIRECTORY_SEPARATOR . 'pkl' . DIRECTORY_SEPARATOR;
            if (!empty($existing['image_url'])) {
                $path = $targetDir . $existing['image_url'];
                if (file_exists($path)) {
                    @unlink($path);
                }
            }
            $model->deleteById((int)$id);
        }
        return redirect()->to('/pkl');
    }
}
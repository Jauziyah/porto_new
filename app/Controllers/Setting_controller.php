<?php

namespace App\Controllers;

use App\Models\Setting_model;
use CodeIgniter\RESTful\ResourceController;

class Setting_controller extends BaseController
{
    protected $modelName = 'App\Models\Setting_model';
    protected $format = 'json';

    public function index()
    {
        $model = new Setting_model();
        $users = $model->getUserData();
        return $this->respond($users);
    }

    public function show($id = null)
    {
        $model = new Setting_model();
        $user = $model->getUserData($id);

        if (!$user) {
            return $this->failNotFound('User not found');
        }

        // Transform grouped strings into arrays (optional prettification)
        $user['titles'] = $this->splitCommaString($user['titles']);
        $user['social_links'] = $this->parseSocialLinks($user['social_links']);
        $user['skills'] = $this->parseSkills($user['skills']);
        $user['what_i_do'] = $this->parseWhatIDo($user['what_i_do']);

        return $this->respond($user);
    }

    // PUBLIC API METHODS FOR PORTFOLIO
// PUBLIC API METHODS FOR PORTFOLIO
public function getWhatIDo()
{
    $model = new Setting_model();
    $data = $model->getWhatIDoData(); // This method now exists
    return $this->respond($data);
}

public function getSocialLinks()
{
    $model = new Setting_model();
    $data = $model->getSocialLinksData(); // This method now exists
    return $this->respond($data);
}

public function getSkills()
{
    $model = new Setting_model();
    $data = $model->getSkillsData(); // This method now exists
    return $this->respond($data);
}

    public function page($id = 1)
    {
        // Authentication removed - filter will handle it
        $model = new Setting_model();
        $user = $model->getUserData($id);

        if (!$user) {
            return redirect()->to('/settings')->with('error', 'User not found');
        }

        $data = [
            'user' => $user,
            'titles_list' => $this->splitCommaString($user['titles'] ?? ''),
            'social_links_list' => $this->parseSocialLinks($user['social_links'] ?? ''),
            'skills_list' => $this->parseSkills($user['skills'] ?? ''),
            'what_i_do_list' => $this->parseWhatIDo($user['what_i_do'] ?? ''),
        ];

        return view('pages/settings', $data);
    }

    // --- Helper formatting methods --- //
    private function splitCommaString($str)
    {
        return $str ? explode(',', $str) : [];
    }

    private function parseSocialLinks($str)
    {
        if (!$str) return [];
        $items = explode(',', $str);
        $result = [];
        foreach ($items as $item) {
            $p = explode('|', $item);
            if (!isset($p[1])) continue;
            $result[] = [
                'id' => isset($p[0]) && $p[0] !== '' ? (int)$p[0] : null,
                'platform' => $p[1] ?? null,
                'url' => $p[2] ?? null,
                'icon' => $p[3] ?? null,
            ];
        }
        return $result;
    }

    private function parseSkills($str)
    {
        if (!$str) return [];
        $items = explode(',', $str);
        $result = [];
        foreach ($items as $item) {
            $p = explode('|', $item);
            if (!isset($p[1])) continue;
            $result[] = [
                'id' => isset($p[0]) && $p[0] !== '' ? (int)$p[0] : null,
                'name' => $p[1] ?? null,
                'icon' => $p[2] ?? null,
            ];
        }
        return $result;
    }

    private function parseWhatIDo($str)
    {
        if (!$str) return [];
        $items = explode(',', $str);
        $result = [];
        foreach ($items as $item) {
            $p = explode('|', $item);
            if (!isset($p[1])) continue;
            $result[] = [
                'id' => isset($p[0]) && $p[0] !== '' ? (int)$p[0] : null,
                'title' => $p[1] ?? null,
                'description' => $p[2] ?? null,
                'icon' => $p[3] ?? null,
            ];
        }
        return $result;
    }

    // --- CRUD: User basics --- //
    public function updateUserBasics()
    {
        // Authentication removed - filter will handle it
        $userId = 1; // current single-user assumption
        $db = \Config\Database::connect();

        $greeting = trim((string)$this->request->getPost('greeting'));
        $name = trim((string)$this->request->getPost('name'));
        $hero = trim((string)$this->request->getPost('hero_description'));
        $titles = trim((string)$this->request->getPost('titles'));

        $update = [];
        if ($greeting !== '') $update['greeting'] = $greeting;
        if ($name !== '') $update['name'] = $name;
        if ($hero !== '') $update['hero_description'] = $hero;

        if (!empty($update)) {
            $db->table('users')->where('id', $userId)->update($update);
        }

        // update titles if provided: replace all and insert
        if ($titles !== '') {
            $db->table('user_titles')->where('user_id', $userId)->delete();
            $titlesArr = array_filter(array_map('trim', explode(',', $titles)));
            foreach ($titlesArr as $t) {
                $db->table('user_titles')->insert(['user_id' => $userId, 'title' => $t]);
            }
        }

        return redirect()->to('/settings');
    }

    // --- CRUD: What I Do --- //
    public function storeWhatIDo()
    {
        // Authentication removed - filter will handle it
        $db = \Config\Database::connect();
        $userId = 1;

        $title = trim((string)$this->request->getPost('title'));
        $description = trim((string)$this->request->getPost('description'));
        $icon = $this->handleUpload('image');

        if ($title === '') return redirect()->back()->with('error', 'Title required');

        $db->table('user_what_i_do')->insert([
            'user_id' => $userId,
            'title' => $title,
            'description' => $description ?: null,
            'icon' => $icon,
        ]);
        return redirect()->to('/settings');
    }

    public function updateWhatIDo($id)
    {
        // Authentication removed - filter will handle it
        $db = \Config\Database::connect();
        $row = $db->table('user_what_i_do')->where('id', (int)$id)->get()->getRowArray();
        if (!$row) return redirect()->back()->with('error', 'Item not found');

        $update = [
            'title' => trim((string)$this->request->getPost('title')),
            'description' => trim((string)$this->request->getPost('description')),
        ];

        $file = $this->request->getFile('image');
        if ($file && $file->isValid() && !$file->hasMoved()) {
            $newName = $this->handleUpload('image');
            if ($newName) {
                $update['icon'] = $newName;
                $this->deleteOldUpload($row['icon']);
            }
        }

        $db->table('user_what_i_do')->where('id', (int)$id)->update($update);
        return redirect()->to('/settings');
    }

    public function deleteWhatIDo($id)
    {
        // Authentication removed - filter will handle it
        $db = \Config\Database::connect();
        $row = $db->table('user_what_i_do')->where('id', (int)$id)->get()->getRowArray();
        if ($row) {
            $db->table('user_what_i_do')->where('id', (int)$id)->delete();
            $this->deleteOldUpload($row['icon'] ?? null);
        }
        return redirect()->to('/settings');
    }

    // --- CRUD: Social Links --- //
    public function storeSocialLink()
    {
        // Authentication removed - filter will handle it
        $db = \Config\Database::connect();
        $userId = 1;
        $platform = trim((string)$this->request->getPost('platform'));
        $url = trim((string)$this->request->getPost('url'));
        $icon = $this->handleUpload('image');
        if ($platform === '' || $url === '') return redirect()->back()->with('error', 'Platform and URL required');
        $db->table('user_social_links')->insert([
            'user_id' => $userId,
            'platform' => $platform,
            'url' => $url,
            'icon' => $icon,
        ]);
        return redirect()->to('/settings');
    }

    public function updateSocialLink($id)
    {
        // Authentication removed - filter will handle it
        $db = \Config\Database::connect();
        $row = $db->table('user_social_links')->where('id', (int)$id)->get()->getRowArray();
        if (!$row) return redirect()->back()->with('error', 'Item not found');

        $update = [
            'platform' => trim((string)$this->request->getPost('platform')),
            'url' => trim((string)$this->request->getPost('url')),
        ];
        $file = $this->request->getFile('image');
        if ($file && $file->isValid() && !$file->hasMoved()) {
            $newName = $this->handleUpload('image');
            if ($newName) {
                $update['icon'] = $newName;
                $this->deleteOldUpload($row['icon'] ?? null);
            }
        }
        $db->table('user_social_links')->where('id', (int)$id)->update($update);
        return redirect()->to('/settings');
    }

    public function deleteSocialLink($id)
    {
        // Authentication removed - filter will handle it
        $db = \Config\Database::connect();
        $row = $db->table('user_social_links')->where('id', (int)$id)->get()->getRowArray();
        if ($row) {
            $db->table('user_social_links')->where('id', (int)$id)->delete();
            $this->deleteOldUpload($row['icon'] ?? null);
        }
        return redirect()->to('/settings');
    }

    // --- CRUD: Skills --- //
    public function storeSkill()
    {
        // Authentication removed - filter will handle it
        $db = \Config\Database::connect();
        $userId = 1;
        $name = trim((string)$this->request->getPost('name'));
        $icon = $this->handleUpload('image');
        if ($name === '') return redirect()->back()->with('error', 'Name required');
        $db->table('user_skills')->insert([
            'user_id' => $userId,
            'name' => $name,
            'icon' => $icon,
        ]);
        return redirect()->to('/settings');
    }

    public function updateSkill($id)
    {
        // Authentication removed - filter will handle it
        $db = \Config\Database::connect();
        $row = $db->table('user_skills')->where('id', (int)$id)->get()->getRowArray();
        if (!$row) return redirect()->back()->with('error', 'Item not found');
        $update = [
            'name' => trim((string)$this->request->getPost('name')),
        ];
        $file = $this->request->getFile('image');
        if ($file && $file->isValid() && !$file->hasMoved()) {
            $newName = $this->handleUpload('image');
            if ($newName) {
                $update['icon'] = $newName;
                $this->deleteOldUpload($row['icon'] ?? null);
            }
        }
        $db->table('user_skills')->where('id', (int)$id)->update($update);
        return redirect()->to('/settings');
    }

    public function deleteSkill($id)
    {
        // Authentication removed - filter will handle it
        $db = \Config\Database::connect();
        $row = $db->table('user_skills')->where('id', (int)$id)->get()->getRowArray();
        if ($row) {
            $db->table('user_skills')->where('id', (int)$id)->delete();
            $this->deleteOldUpload($row['icon'] ?? null);
        }
        return redirect()->to('/settings');
    }

    // --- Helpers: uploads --- //
    private function handleUpload(string $field): ?string
    {
        $file = $this->request->getFile($field);
        if ($file && $file->isValid() && !$file->hasMoved()) {
            $targetDir = rtrim(FCPATH, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR . 'upload' . DIRECTORY_SEPARATOR . 'settings' . DIRECTORY_SEPARATOR;
            if (!is_dir($targetDir)) {
                @mkdir($targetDir, 0755, true);
            }
            $newName = $file->getRandomName();
            $file->move($targetDir, $newName);
            return $newName;
        }
        return null;
    }

    private function deleteOldUpload(?string $filename): void
    {
        if (!$filename) return;
        $path = rtrim(FCPATH, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR . 'upload' . DIRECTORY_SEPARATOR . 'settings' . DIRECTORY_SEPARATOR . $filename;
        if (file_exists($path)) {
            @unlink($path);
        }
    }
}
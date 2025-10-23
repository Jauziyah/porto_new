<?php

namespace App\Controllers;

use App\Models\Project_model;
use CodeIgniter\RESTful\ResourceController;

class Project_controller extends BaseController
{
    protected $modelName = 'App\Models\Project_model';
    protected $format = 'json';

    public function index()
    {
        $model = new Project_model();
        $projects = $model->getProjects();
        return $this->respond($projects);
    }

    public function show($id = null)
    {
        $model = new Project_model();
        $project = $model->getProjects($id);
        if (!$project) {
            return $this->failNotFound('Project not found');
        }

        // Convert concatenated strings to arrays for nicer JSON
        $project['images']     = $this->parseComplexList($project['images']);
        $project['categories'] = $this->parseComplexList($project['categories']);
        $project['tags']       = $this->parseComplexList($project['tags']);

        return $this->respond($project);
    }

    public function page()
    {
        $session = session();
        if (!$session->get('isLoggedIn')) {
            return redirect()->to('/auth');
        }

        $model = new Project_model();
        $rows = $model->getProjects();
        $projects = [];
        foreach ($rows as $row) {
            $row['images'] = $this->parseComplexList($row['images']);
            $row['categories'] = $this->parseComplexList($row['categories']);
            $row['tags'] = $this->parseComplexList($row['tags']);
            $projects[] = $row;
        }

        $db = \Config\Database::connect();
        $categories = $db->table('categories')->select('id, name')->orderBy('name','asc')->get()->getResultArray();
        $tags = $db->table('tech_stack')->select('id, name')->orderBy('name','asc')->get()->getResultArray();

        return view('pages/content_management', [
            'projects' => $projects,
            'categories' => $categories,
            'tags' => $tags,
        ]);
    }

    public function store()
    {
        $this->ensureAuth();
        helper('url');
        $db = \Config\Database::connect();

        $title = trim((string)$this->request->getPost('title'));
        $slug = $title !== '' ? url_title($title, '-', true) : '';
        if ($title === '' || $slug === '') {
            return redirect()->back()->with('error', 'Title is required');
        }
        $data = [
            'title' => $title,
            'slug' => $slug,
            'description' => trim((string)$this->request->getPost('description')) ?: null,
            'demo_link' => trim((string)$this->request->getPost('demo_link')) ?: null,
            'github_link' => trim((string)$this->request->getPost('github_link')) ?: null,
            'featured' => $this->request->getPost('featured') ? 1 : 0,
            'published' => $this->request->getPost('published') ? 1 : 0,
        ];
        $db->table('projects')->insert($data);
        $projectId = (int)$db->insertID();

        $categoryIds = (array)$this->request->getPost('category_ids');
        foreach ($categoryIds as $cid) {
            $cid = (int)$cid; if ($cid>0) $db->table('project_categories')->insert(['project_id'=>$projectId,'category_id'=>$cid]);
        }
        $tagIds = (array)$this->request->getPost('tag_ids');
        foreach ($tagIds as $tid) {
            $tid = (int)$tid; if ($tid>0) $db->table('project_tags')->insert(['project_id'=>$projectId,'tag_id'=>$tid]);
        }

        $this->handleMultipleUploads($projectId);

        return redirect()->to('/content-management');
    }

    public function update($id)
    {
        $this->ensureAuth();
        helper('url');
        $db = \Config\Database::connect();
        $id = (int)$id;
        $exists = $db->table('projects')->where('id',$id)->get()->getRowArray();
        if (!$exists) return redirect()->back()->with('error','Project not found');

        $title = trim((string)$this->request->getPost('title'));
        $slug = $title !== '' ? url_title($title, '-', true) : $exists['slug'];
        $data = [
            'title' => $title ?: $exists['title'],
            'slug' => $slug,
            'description' => trim((string)$this->request->getPost('description')),
            'demo_link' => trim((string)$this->request->getPost('demo_link')),
            'github_link' => trim((string)$this->request->getPost('github_link')),
            'featured' => $this->request->getPost('featured') ? 1 : 0,
            'published' => $this->request->getPost('published') ? 1 : 0,
        ];
        $db->table('projects')->where('id',$id)->update($data);

        // Replace relationships
        $db->table('project_categories')->where('project_id',$id)->delete();
        $categoryIds = (array)$this->request->getPost('category_ids');
        foreach ($categoryIds as $cid) {
            $cid = (int)$cid; if ($cid>0) $db->table('project_categories')->insert(['project_id'=>$id,'category_id'=>$cid]);
        }
        $db->table('project_tags')->where('project_id',$id)->delete();
        $tagIds = (array)$this->request->getPost('tag_ids');
        foreach ($tagIds as $tid) {
            $tid = (int)$tid; if ($tid>0) $db->table('project_tags')->insert(['project_id'=>$id,'tag_id'=>$tid]);
        }

        // If new images are provided, replace all previous images with the new ones
        $this->replaceImages($id);

        return redirect()->to('/content-management');
    }

    public function delete($id)
    {
        $this->ensureAuth();
        $db = \Config\Database::connect();
        $id = (int)$id;
        $images = $db->table('project_images')->where('project_id',$id)->get()->getResultArray();
        foreach ($images as $img) {
            $this->deleteOldUpload($img['url'] ?? null);
        }
        $db->table('project_images')->where('project_id',$id)->delete();
        $db->table('project_categories')->where('project_id',$id)->delete();
        $db->table('project_tags')->where('project_id',$id)->delete();
        $db->table('projects')->where('id',$id)->delete();
        return redirect()->to('/content-management');
    }

    private function handleMultipleUploads(int $projectId): void
    {
        $files = $this->request->getFiles();
        if (!isset($files['images'])) return;
        $db = \Config\Database::connect();
        foreach ($files['images'] as $file) {
            if ($file && $file->isValid() && !$file->hasMoved()) {
                $targetDir = rtrim(FCPATH, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR . 'upload' . DIRECTORY_SEPARATOR . 'project' . DIRECTORY_SEPARATOR;
                if (!is_dir($targetDir)) {
                    @mkdir($targetDir, 0755, true);
                }
                $newName = $file->getRandomName();
                $file->move($targetDir, $newName);
                $db->table('project_images')->insert([
                    'project_id' => $projectId,
                    'url' => $newName,
                    'alt_text' => null,
                ]);
            }
        }
    }

    /**
     * If the request contains new images, delete all existing images for the project
     * (both files and DB rows) and replace them with the new uploads.
     */
    private function replaceImages(int $projectId): void
    {
        $files = $this->request->getFiles();
        if (!isset($files['images']) || empty($files['images'])) {
            return; // nothing uploaded -> keep existing images
        }

        // Check if at least one file is actually valid upload; if none valid, do nothing
        $hasValid = false;
        foreach ($files['images'] as $file) {
            if ($file && $file->isValid() && !$file->hasMoved()) {
                $hasValid = true; break;
            }
        }
        if (!$hasValid) return;

        // Delete existing image files and DB rows
        $db = \Config\Database::connect();
        $existing = $db->table('project_images')->where('project_id', $projectId)->get()->getResultArray();
        foreach ($existing as $img) {
            $this->deleteOldUpload($img['url'] ?? null);
        }
        $db->table('project_images')->where('project_id', $projectId)->delete();

        // Insert new uploads
        foreach ($files['images'] as $file) {
            if ($file && $file->isValid() && !$file->hasMoved()) {
                $targetDir = rtrim(FCPATH, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR . 'upload' . DIRECTORY_SEPARATOR . 'project' . DIRECTORY_SEPARATOR;
                if (!is_dir($targetDir)) {
                    @mkdir($targetDir, 0755, true);
                }
                $newName = $file->getRandomName();
                $file->move($targetDir, $newName);
                $db->table('project_images')->insert([
                    'project_id' => $projectId,
                    'url' => $newName,
                    'alt_text' => null,
                ]);
            }
        }
    }

    private function deleteOldUpload(?string $filename): void
    {
        if (!$filename) return;
        $path = rtrim(FCPATH, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR . 'upload' . DIRECTORY_SEPARATOR . 'project' . DIRECTORY_SEPARATOR . $filename;
        if (file_exists($path)) {
            @unlink($path);
        }
    }

    private function ensureAuth(): void
    {
        $session = session();
        if (!$session->get('isLoggedIn')) {
            redirect()->to('/auth')->send();
            exit;
        }
    }

    /** Split entries that were glued together with commas and pipes */
    private function parseComplexList($str)
    {
        if (!$str) return [];
        $items = explode(',', $str);
        $result = [];
        foreach ($items as $item) {
            $parts = explode('|', $item);
            $result[] = [
                'id_or_url' => $parts[0] ?? '',
                'name_or_alt' => $parts[1] ?? '',
            ];
        }
        return $result;
    }
}
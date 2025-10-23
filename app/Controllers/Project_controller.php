<?php

namespace App\Controllers;

use App\Models\Project_model;
use CodeIgniter\RESTful\ResourceController;

class Project_controller extends ResourceController
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
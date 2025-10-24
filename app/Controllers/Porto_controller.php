<?php
namespace App\Controllers;

use App\Models\Porto_model;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\RESTful\ResourceController;

class Porto_controller extends BaseController
{
    protected $model;
    
    use ResponseTrait;

    public function __construct()
    {
        $this->model = new Porto_model();
    }

    public function index()
    {
        $data['profile'] = $this->model->getUserProfile();
        $data['titles'] = $this->model->getUserTitles();
        return view('portofolio/main_layout', $data);
    }
    
    public function getUserProfile()
    {
        return $this->response->setJSON($this->model->getUserProfile());
    }
    
    public function getUserSkills()
    {
        return $this->response->setJSON($this->model->getUserSkills());
    }
    
    public function getUserSocialLinks()
    {
        return $this->response->setJSON($this->model->getUserSocialLinks());
    }
    
    public function getUserTitles()
    {
        return $this->response->setJSON($this->model->getUserTitles());
    }
    
    public function getUserWhatIDo()
    {
        return $this->response->setJSON($this->model->getUserWhatIDo());
    }
    
    public function getCategories()
    {
        return $this->response->setJSON($this->model->getCategories());
    }
    
    public function getProjects()
    {
        return $this->response->setJSON($this->model->getProjects());
    }
    
    public function getProjectDetails($projectId)
    {
        $project = $this->model->getProjects();
        $project['categories'] = $this->model->getProjectCategories($projectId);
        $project['images'] = $this->model->getProjectImages($projectId);
        $project['tags'] = $this->model->getProjectTags($projectId);
        
        return $this->response->setJSON($project);
    }
    
    public function getTechStack()
    {
        return $this->response->setJSON($this->model->getTechStack());
    }
    
    public function getAllData()
    {
        return $this->response->setJSON($this->model->getAllData());
    }
}
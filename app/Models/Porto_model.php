<?php

namespace App\Models;

use CodeIgniter\Model;

class Porto_model extends Model
{
    protected $DBGroup = 'default';

    // User Profile
    public function getUserProfile()
    {
        return $this->db->table('users')
            ->select('greeting, name, hero_description, profile_image, created_at, updated_at')
            ->where('id', 1)
            ->get()->getRowArray();
    }

    // User Skills
    public function getUserSkills()
    {
        return $this->db->table('user_skills')
            ->select('id, user_id, name, icon')
            ->get()->getResultArray();
    }

    // User Social Links
    public function getUserSocialLinks()
    {
        return $this->db->table('user_social_links')
            ->select('id, user_id, platform, url, icon')
            ->get()->getResultArray();
    }

    // User Titles
    public function getUserTitles()
    {
        return $this->db->table('user_titles')
            ->select('id, user_id, title')
            ->get()->getResultArray();
    }

    // User What I Do
    public function getUserWhatIDo()
    {
        return $this->db->table('user_what_i_do')
            ->select('id, user_id, title, description, icon')
            ->get()->getResultArray();
    }

    // Categories
    public function getCategories()
    {
        return $this->db->table('categories')
            ->select('id, name, slug, image_url, created_at, updated_at')
            ->get()->getResultArray();
    }

    // Projects
    public function getProjects($featured = null, $published = null)
    {
        $builder = $this->db->table('projects')
            ->select('id, title, slug, description, demo_link, github_link, featured, published, created_at, updated_at');
            
        if ($featured !== null) {
            $builder->where('featured', $featured);
        }
        
        if ($published !== null) {
            $builder->where('published', $published);
        }
        
        return $builder->get()->getResultArray();
    }

    // Project Categories
    public function getProjectCategories($projectId)
    {
        return $this->db->table('project_categories')
            ->select('project_id, category_id')
            ->where('project_id', $projectId)
            ->get()->getResultArray();
    }

    // Project Images
    public function getProjectImages($projectId)
    {
        return $this->db->table('project_images')
            ->select('id, project_id, url, alt_text')
            ->where('project_id', $projectId)
            ->get()->getResultArray();
    }

    // Project Tags
    public function getProjectTags($projectId)
    {
        return $this->db->table('project_tags')
            ->select('project_id, tag_id')
            ->where('project_id', $projectId)
            ->get()->getResultArray();
    }

    // Tech Stack
    public function getTechStack()
    {
        return $this->db->table('tech_stack')
            ->select('id, name, slug, type, image_url, created_at, updated_at')
            ->get()->getResultArray();
    }

    public function getAllProjectData()
    {
        $projects = $this->getProjects();
        
        foreach ($projects as &$project) {
            $project['categories'] = $this->getProjectCategories($project['id']);
            $project['images'] = $this->getProjectImages($project['id']);
            $project['tags'] = $this->getProjectTags($project['id']);
        }
        
        return $projects;
    }

    public function getAllData()
    {
        return [
            'profile' => $this->getUserProfile(),
            'skills' => $this->getUserSkills(),
            'socialLinks' => $this->getUserSocialLinks(),
            'titles' => $this->getUserTitles(),
            'whatIDo' => $this->getUserWhatIDo(),
            'categories' => $this->getCategories(),
            'projects' => $this->getAllProjectData(),
            'techStack' => $this->getTechStack()
        ];
    }

    public function getAllProjectDataInOneCall()
    {
        $builder = $this->db->table('projects')
            ->select('projects.id, projects.title, projects.slug, projects.description, projects.demo_link, projects.github_link, projects.featured, projects.published, projects.created_at, projects.updated_at')
            ->join('project_categories', 'project_categories.project_id = projects.id')
            ->join('project_images', 'project_images.project_id = projects.id')
            ->join('project_tags', 'project_tags.project_id = projects.id')
            ->get()->getResultArray();
        
        return $builder;
    }
}

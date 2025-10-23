<?php

namespace App\Models;

use CodeIgniter\Model;

class Project_model extends Model
{
    protected $table = 'projects';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'title', 'slug', 'description',
        'demo_link', 'github_link',
        'featured', 'published',
        'created_at', 'updated_at'
    ];

    /**
     * Get project list or single project with images, categories, and tags
     */
    public function getProjects($id = null)
    {
        $builder = $this->db->table('projects p')
            ->select("
                p.*,
                GROUP_CONCAT(DISTINCT pi.url, '|', IFNULL(pi.alt_text, '')) AS images,
                GROUP_CONCAT(DISTINCT c.id, '|', c.name) AS categories,
                GROUP_CONCAT(DISTINCT t.id, '|', t.name) AS tags
            ")
            ->join('project_images pi', 'pi.project_id = p.id', 'left')
            ->join('project_categories pc', 'pc.project_id = p.id', 'left')
            ->join('categories c', 'c.id = pc.category_id', 'left')
            ->join('project_tags pt', 'pt.project_id = p.id', 'left')
            ->join('tech_stack t', 't.id = pt.tag_id', 'left')
            ->groupBy('p.id');

        if ($id !== null) {
            $builder->where('p.id', $id);
            return $builder->get()->getRowArray();
        }

        return $builder->get()->getResultArray();
    }
}
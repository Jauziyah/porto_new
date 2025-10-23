<?php

namespace App\Models;

use CodeIgniter\Model;

class Profile_model extends Model
{
    protected $DBGroup          = 'default';

    /**
     * Default table is optional — we'll override it as needed.
     */
    protected $table            = 'categories';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $protectFields    = true;

    /**
     * Shared allowed fields structure (adjust if you’ll do inserts/updates later)
     */
    protected $allowedFields = [
        'name', 'slug', 'image_url', 'created_at', 'updated_at'
    ];

    /**
     * Fetch all categories
     * @return array
     */
    public function getCategories(): array
    {
        return $this->db->table('categories')
                        ->orderBy('name', 'ASC')
                        ->get()
                        ->getResultArray();
    }

    /**
     * Fetch category by slug
     * @param string $slug
     * @return array|null
     */
    public function getCategoryBySlug(string $slug): ?array
    {
        return $this->db->table('categories')
                        ->where('slug', $slug)
                        ->get()
                        ->getRowArray();
    }

    /**
     * Fetch all tech stacks
     * @return array
     */
    public function getTechStacks(): array
    {
        return $this->db->table('tech_stack')
                        ->orderBy('name', 'ASC')
                        ->get()
                        ->getResultArray();
    }

    /**
     * Fetch tech stack by slug
     * @param string $slug
     * @return array|null
     */
    public function getTechStackBySlug(string $slug): ?array
    {
        return $this->db->table('tech_stack')
                        ->where('slug', $slug)
                        ->get()
                        ->getRowArray();
    }

    /**
     * Optional: Combined fetch (example)
     * Returns both categories and tech stacks.
     */
    public function getProfileData(): array
    {
        return [
            'categories'  => $this->getCategories(),
            'tech_stacks' => $this->getTechStacks(),
        ];
    }
}
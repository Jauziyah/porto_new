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

    public function createCategory(array $data): bool
    {
        return (bool) $this->db->table('categories')->insert($data);
    }

    public function updateCategoryById(int $id, array $data): bool
    {
        return (bool) $this->db->table('categories')->where('id', $id)->update($data);
    }

    public function deleteCategoryById(int $id): bool
    {
        return (bool) $this->db->table('categories')->where('id', $id)->delete();
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

    public function getTechById(int $id): ?array
    {
        return $this->db->table('tech_stack')
                        ->where('id', $id)
                        ->get()
                        ->getRowArray();
    }

    public function createTech(array $data): bool
    {
        return (bool) $this->db->table('tech_stack')->insert($data);
    }

    public function updateTechById(int $id, array $data): bool
    {
        return (bool) $this->db->table('tech_stack')->where('id', $id)->update($data);
    }

    public function deleteTechById(int $id): bool
    {
        return (bool) $this->db->table('tech_stack')->where('id', $id)->delete();
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
            'certificates' => $this->getCertificates(),
        ];
    }

        // ADD THESE NEW METHODS FOR PUBLIC API
    public function getCategoriesData()
    {
        return $this->getCategories(); // Use existing method
    }

    public function getTechStackData()
    {
        return $this->getTechStacks(); // Use existing method
    }

        public function getCertificates($userId = null)
    {
        $builder = $this->db->table('certificates')
            ->select('id, user_id, title, slug, image_url, description, issued_by, achieved_at, credential_id');
        
        if ($userId !== null) {
            $builder->where('user_id', $userId);
        }
        
        return $builder->orderBy('achieved_at', 'DESC')
                      ->get()
                      ->getResultArray();
    }

    public function getCertificateById(int $id): ?array
    {
        return $this->db->table('certificates')
                        ->where('id', $id)
                        ->get()
                        ->getRowArray();
    }

    public function createCertificate(array $data): bool
    {
        return (bool) $this->db->table('certificates')->insert($data);
    }

    public function updateCertificateById(int $id, array $data): bool
    {
        return (bool) $this->db->table('certificates')->where('id', $id)->update($data);
    }

    public function deleteCertificateById(int $id): bool
    {
        return (bool) $this->db->table('certificates')->where('id', $id)->delete();
    }

}
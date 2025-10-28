<?php

namespace App\Models;

use CodeIgniter\Model;

class Setting_model extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'username', 'email', 'password',
        'greeting', 'name', 'hero_description', 'profile_image',
        'created_at', 'updated_at'
    ];

    public function getUserData($userId = null)
    {
        // Return bare user row(s) only; related metadata fetched via dedicated getters
        if ($userId !== null) {
            return $this->db->table('users')
                            ->where('id', (int) $userId)
                            ->get()
                            ->getRowArray();
        }

        return $this->db->table('users')
                        ->get()
                        ->getResultArray();
    }

        // ADD THESE NEW METHODS FOR PUBLIC API
    public function getWhatIDoData(int $userId = 1)
    {
        return $this->db->table('user_what_i_do')
                        ->select('id, title, description, icon')
                        ->where('user_id', $userId)
                        ->orderBy('id', 'asc')
                        ->get()
                        ->getResultArray();
    }

    public function getSocialLinksData(int $userId = 1)
    {
        return $this->db->table('user_social_links')
                        ->select('id, platform, url, icon')
                        ->where('user_id', $userId)
                        ->orderBy('id', 'asc')
                        ->get()
                        ->getResultArray();
    }

    public function getSkillsData(int $userId = 1)
    {
        return $this->db->table('user_skills')
                        ->select('id, name, icon')
                        ->where('user_id', $userId)
                        ->orderBy('id', 'asc')
                        ->get()
                        ->getResultArray();
    }

    public function getUserTitles(int $userId = 1): array
    {
        $rows = $this->db->table('user_titles')
                         ->select('title')
                         ->where('user_id', $userId)
                         ->orderBy('id', 'asc')
                         ->get()
                         ->getResultArray();
        return array_map(static function ($row) {
            return $row['title'];
        }, $rows);
    }
}
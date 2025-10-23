<?php

namespace App\Models;

use CodeIgniter\Model;

class Setting_model extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'username', 'email', 'password',
        'greeting', 'name', 'hero_description',
        'created_at', 'updated_at'
    ];

    public function getUserData($userId = null)
    {
        $builder = $this->db->table('users u')
            ->select(
                'u.*, 
                 GROUP_CONCAT(DISTINCT ut.title) as titles,
                 GROUP_CONCAT(DISTINCT usl.id, "|", usl.platform, "|", usl.url, "|", IFNULL(usl.icon, "")) as social_links,
                 GROUP_CONCAT(DISTINCT usk.id, "|", usk.name, "|", IFNULL(usk.icon, "")) as skills,
                 GROUP_CONCAT(DISTINCT uw.id, "|", uw.title, "|", IFNULL(uw.description, ""), "|", IFNULL(uw.icon, "")) as what_i_do'
            )
            ->join('user_titles ut', 'ut.user_id = u.id', 'left')
            ->join('user_social_links usl', 'usl.user_id = u.id', 'left')
            ->join('user_skills usk', 'usk.user_id = u.id', 'left')
            ->join('user_what_i_do uw', 'uw.user_id = u.id', 'left')
            ->groupBy('u.id');

        if ($userId !== null) {
            $builder->where('u.id', $userId);
            return $builder->get()->getRowArray();
        }

        return $builder->get()->getResultArray();
    }
}
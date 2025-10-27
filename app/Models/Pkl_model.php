<?php

namespace App\Models;

use CodeIgniter\Model;

class Pkl_model extends Model
{
    protected $table = 'pkl';
    protected $primaryKey = 'id';
    protected $allowedFields = ['user_id', 'title', 'description', 'image_url'];
    protected $useTimestamps = false;

    public function getAllByUser(int $userId): array
    {
        return $this->where('user_id', $userId)
            ->orderBy('id', 'ASC')
            ->findAll();
    }

    public function getById(int $id): ?array
    {
        $row = $this->find($id);
        return $row ?: null;
    }

    public function createItem(array $data): int
    {
        $this->insert($data);
        return (int) $this->getInsertID();
    }

    public function updateById(int $id, array $data): bool
    {
        return (bool) $this->update($id, $data);
    }

    public function deleteById(int $id): bool
    {
        return (bool) $this->delete($id);
    }
}


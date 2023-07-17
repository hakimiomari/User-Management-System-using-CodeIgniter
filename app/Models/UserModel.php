<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $beforeInsert = ['hashPassword'];
    protected $beforeUpdate = ['hashPassword'];

    protected function hashPassword(array $data)
    {
        if (!isset($data['data']['u_password'])) {
            return $data;
        }
        $data['data']['u_password'] = password_hash($data['data']['u_password'], PASSWORD_DEFAULT);

        return $data;
    }

    protected $table = 'users';
    protected $primaryKey = 'u_id';

    protected $returnType = 'array';
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField  = 'deleted_at';

    protected $allowedFields = ['u_first_name', 'u_last_name', 'u_dob', 'u_gender', 'u_email', 'u_phone', 'u_password', 'image', 'created_at', 'updated_at', 'role'];
}

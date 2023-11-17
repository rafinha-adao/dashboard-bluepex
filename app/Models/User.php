<?php

namespace App\Models;

use CodeIgniter\Model;

class User extends Model
{
    protected $table            = 'users';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'name',
        'email',
        'password'
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    public function getAll()
    {
        $users = model(User::class)->findAll();

        return $users;
    }

    public function getById($id)
    {
        $user = model(User::class)->select('name, email')->where('id', $id)->first();

        return $user;
    }

    public function addNew($data)
    {
        $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        $user = model(User::class)->insert($data);

        return $user;
    }

    public function updateById($id, $data)
    {
        $user = model(User::class)->update($id, $data);

        return $user;
    }

    public function deleteById($id)
    {
        $user = model(User::class)->delete($id);

        return $user;
    }

    public function login($data)
    {
        $user = model(User::class)->where('email', $data['email'])->first();

        if (!$user) {
            return redirect()->route('login')->with('error', 'E-mail ou senha incorretos.');
        }

        if (!password_verify($data['password'], $user['password'])) {
            return redirect()->route('login')->with('error', 'E-mail ou senha incorretos.');
        }

        unset($user['password'], $user['created_at'], $user['updated_at']);
        session()->set('user', $user);

        return redirect()->route('/');
    }

    public function logout()
    {
        session()->destroy();

        return redirect()->route('login');
    }
}

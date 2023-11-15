<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\User as ModelsUser;

class User extends BaseController
{
    public function index()
    {
        if (!session()->has('user')) {
            return redirect()->route('login');
        }

        $user = model(ModelsUser::class)->getAll();

        $data = $user;
        $data['title'] = "Usuários";

        return view('users', $data);
    }

    public function create()
    {
        if (!session()->has('user')) {
            return redirect()->route('login');
        }

        $data['title'] = "Adicionar novo usuário";

        return view('users_form', $data);
    }

    public function store()
    {
        $data = $this->request->getPost(['name', 'email', 'password']);

        $user = model(ModelsUser::class)->addNew($data);

        if ($user) {
            echo 'success';
        } else {
            echo 'error';
        }
    }

    public function edit($id)
    {
        if (!session()->has('user')) {
            return redirect()->route('login');
        }
        
        $data = [
            'title' => "Editar usuário",
            'id'    => $id
        ];

        return view('users_form', $data);
    }

    public function update($id)
    {
        $data = $this->request->getPost(['name', 'email', 'password']);

        $user = model(ModelsUser::class)->updateById($id, $data);

        if ($user) {
            echo 'success';
        } else {
            echo 'error';
        }
    }

    public function destroy($id)
    {
        $user = model(ModelsUser::class)->deleteById($id);

        if ($user) {
            echo 'success';
        } else {
            echo 'error';
        }
    }
}

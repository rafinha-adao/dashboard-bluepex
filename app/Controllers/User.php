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

        $users = model(ModelsUser::class)->getAll();

        $data = [
            'users' => $users,
            'title' => "Usuários"
        ];

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
        $rules = [
            'name'              => 'required|max_length[100]',
            'email'             => 'required|valid_email|max_length[100]',
            'password'          => 'required|max_length[255]',
            'confirm_password'  => 'required|max_length[255]|matches[password]',
        ];

        $validated = $this->validate($rules);

        if (!$validated) {
            return redirect()->back()->with('errors', $this->validator->getErrors());
        }

        $data = $this->request->getPost(['name', 'email', 'password']);

        $user = model(ModelsUser::class)->addNew($data);

        $error = model(ModelsUser::class)->db->error();

        if ($error['code'] == 1062) {
            return redirect()->back()->with('error', 'Erro ao adicionar usuário: e-mail já cadastrado');
        }

        if (!$user) {
            return redirect()->back()->with('error', 'Erro ao adicionar usuário: ' . $error['message']);
        }

        return redirect()->route('users')->with('success', 'Usuário adicionado com sucesso!');
    }

    public function edit($id)
    {
        if (!session()->has('user')) {
            return redirect()->route('login');
        }

        $user = model(ModelsUser::class)->getById($id);

        $data = [
            'title' => "Editar usuário",
            'id'    => $id,
            'user'  => $user
        ];

        return view('users_form', $data);
    }

    public function update($id)
    {
        $rules = [
            'name'              => 'required|max_length[100]',
            'email'             => 'required|valid_email|max_length[100]',
            'password'          => 'max_length[255]',
            'confirm_password'  => 'max_length[255]|matches[password]',
        ];

        $validated = $this->validate($rules);

        if (!$validated) {
            return redirect()->back()->with('errors', $this->validator->getErrors());
        }

        $data = $this->request->getPost(['name', 'email', 'password']);

        if (!$data['password']) {
            unset($data['password']);
        } else {
            $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        }

        $user = model(ModelsUser::class)->updateById($id, $data);

        $error = model(ModelsUser::class)->db->error();

        if ($error['code'] == 1062) {
            return redirect()->back()->with('error', 'Erro ao atualizar usuário: e-mail já cadastrado');
        }

        if (!$user) {
            return redirect()->back()->with('error', 'Erro ao atualizar usuário: ' . $error['message']);
        }

        return redirect()->route('users')->with('success', 'Usuário atualizado com sucesso!');
    }

    public function destroy($id)
    {
        $user = model(ModelsUser::class)->deleteById($id);

        $error = model(ModelsUser::class)->db->error();

        if (!$user) {
            return redirect()->back()->with('error', 'Erro ao excluir usuário: ' . $error['message']);
        }

        if (session()->get('user')['id'] == $id) {
            model(ModelsUser::class)->logout();
        }

        return redirect()->back()->with('success', 'Usuário excluído com sucesso!');
    }
}

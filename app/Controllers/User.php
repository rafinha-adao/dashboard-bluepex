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
        $data = $this->request->getPost(['name', 'email', 'password']);

        $user = model(ModelsUser::class)->addNew($data);

        if (!$user) {
            return redirect()->route('users')->with('error', 'Erro ao adicionar usuário!');
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
        $data = $this->request->getPost(['name', 'email', 'password']);

        $user = model(ModelsUser::class)->updateById($id, $data);

        if (!$user) {
            return redirect()->route('users')->with('error', 'Erro ao atualizar usuário!');
        }

        return redirect()->route('users')->with('success', 'Usuário atualizado com sucesso!');
    }

    public function destroy($id)
    {
        $user = model(ModelsUser::class)->deleteById($id);

        if (!$user) {
            return redirect()->route('users')->with('error', 'Erro ao excluir usuário!');
        }

        if (session()->get('user')['id'] == $id) {
            model(ModelsUser::class)->logout();
        }

        return redirect()->route('users')->with('success', 'Usuário excluído com sucesso!');
    }
}

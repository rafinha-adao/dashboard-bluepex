<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\User;

class Login extends BaseController
{
    public function index()
    {
        if (session()->has('user')) {
            return redirect()->route('/');
        }

        $data['title'] = "Login";
        return view("login", $data);
    }

    public function store()
    {
        $rules = [
            'email'     => 'required|valid_email|max_length[100]',
            'password'  => 'required|max_length[255]',
        ];

        $validated = $this->validate($rules);

        if (!$validated) {
            return redirect()->route('login')->with('errors', $this->validator->getErrors());
        }

        $data = $this->request->getPost(['email', 'password']);

        $user = model(User::class);
        return $user->login($data);
    }

    public function destroy()
    {
        $user = model(User::class);
        $user->logout();

        return redirect()->route('login');
    }
}

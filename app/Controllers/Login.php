<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Login extends BaseController
{
    public function index()
    {
        $data['title'] = "Login";
        return view("login", $data);
    }

    public function store()
    {
        // login
    }

    public function destroy()
    {
        // logout
    }
}

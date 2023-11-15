<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Dashboard extends BaseController
{
    public function index()
    {
        if (!session()->has('user')) {
            return redirect()->route('login');
        }

        $data['title'] = "Dashboard";
        return view("data", $data);
    }

    public function catchAll()
    {
        return redirect()->route('/');
    }
}

<?php

namespace App\Controllers;

class Admin extends BaseController
{
    public function index(): string
    {
        $data = [ 'index' => 'true' ];
        return view('admin_page', $data);
    }

    public function manage_marathon(): string
    {
        $data = [ 'manage_marathon' => 'true' ];
        return view('marathon_page', $data);
    }

    public function add_marathon(): string
    {
        $data = [ 'add_marathon' => 'true' ];
        return view('add_page', $data);
    }

    public function manage_runners(): string
    {
        $data = [ 'manage_runners' => 'true' ];
        return view('runners_page', $data);
    }

    public function registration_form(): string
    {
        $data = [ 'registration_form' => 'true' ];
        return view('registration_page', $data);
    }
}
<?php

namespace App\Controllers;

use App\Models\Member;

class Home extends BaseController
{
    public function index(): string
    {
        helper('form');
        return view('homepage');
    }

    public function login(): string
    {
        helper('form');

        $rules = [
            "username" => "required|valid_email",
            "password" => "required"
        ];

        if (!$this->validate($rules))
        {
            $data = [
                "load_error" => "true",
            ];
            return view('homepage', $data);
        }

        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');


        $Member = new Member();
        if ($Member->user_login($username, $password))
        {
            //return view('admin_page');
            header('Location: admin');
            exit();
        }
        else {
            $data = [
                "load_error" => "true",
                "error_message" => "Invalid Username or Password."
            ];
            return view('homepage', $data);
        }
    }

    public function create(): string
    {

        helper('form');

        $rules = [
            "username" => "required",
            "email" => "required|valid_email",
            "password" => "required",
            "retypePassword" => "required"

        ];

        if (!$this->validate($rules))
        {
            $data = [
                "load_error" => "true",
            ];
            return view('homepage', $data);
        }

        $memberName = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $retypePassword = $this->request->getPost('retypePassword');


        $Member = new Member();
        if ($Member->add_user($memberName, $memberEmail, $password))
        {
            //return view('admin_page');
            header('Location: admin');
            exit();
        }
        else {
            $data = [
                "load_error" => "true",
                "error_message" => "Invalid Username or Password."
            ];
            return view('homepage', $data);
        }

        echo "create";
        exit();
        return view('homepage');
    }

    public function play($data): string
    {
        $data = $data * 12;
        echo "Hello World -> " . $data;
        exit();
    }
}

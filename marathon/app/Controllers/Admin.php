<?php

namespace App\Controllers;

use App\Models\Race;

class Admin extends BaseController
{
    public function index(): string
    {
        $data = [ 'index' => 'true' ];
        return view('admin_page', $data);
    }

    public function manage_marathon(): string
    {
        $Race = new Race();

        $data = [
            'manage_marathon' => 'true',
            'races' => $Race->get_races()
        ];
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

    public function add_race()
    {
        $Race = new Race();

        $name = $this->request->getPost('race_name');
        $description = $this->request->getPost('race_description');
        $location = $this->request->getPost('race_location');
        $dateTime = $this->request->getPost('race_dateTime');

        $Race->add_race($name, $description, $location, $dateTime);

        header('Location: marathon');
        exit();
    }

    public function update_race($id)
    {
        $this->session = service('session');
        $this->session->start();
        $memberKey = $this->session->get('memberKey');

        $Member = new Member();
        if($Member->has_access($memberKey, $id)) {
            $Race = new Race();

            $data = [
                'manage_marathon' => 'true',
                'race' => $Race->get_race($id)
            ];
            return view('update_page', $data);
        }
        echo "No Access";
        exit();


    }

    public function edit_race()
    {
        $this->session = service('session');
        $this->session->start();
        $memberKey = $this->session->get('memberKey');
        $id = $this->request->getPost('race_id');
        $name = $this->request->getPost('race_name');
        $description = $this->request->getPost('race_description');
        $location = $this->request->getPost('race_location');
        $dateTime = $this->request->getPost('race_datetime');

        $Member = new Member();
        if($Member->has_access($memberKey, $id)) {
            $Race = new Race();
            $Member = new Member();

            $Race->update_race($id, $name, $description, $location, $dateTime);
            header('Location: /marathon/public/marathon');
            exit();
        }
        echo "No Access";
        exit();
    }

    public function delete_race($id)
    {
        $this->session = service('session');
        $this->session->start();
        $memberKey = $this->session->get('memberKey');

        $Member = new Member();
        if($Member->has_access($memberKey, $id)) {
            $Race = new Race();
            $Race->delete_race($id);
            header('Location: /marathon/public/marathon');
            exit();
        }
        echo "No Access";
        exit();
    }
}
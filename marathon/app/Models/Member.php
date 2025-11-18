<?php

namespace App\Models;

use CodeIgniter\Model;

class Member extends Model
{

    public function user_login($email, $password)
    {
        $db = db_connect();
        $query = "SELECT * FROM members WHERE memberEmail = ?";
        $result = $db->query($query, [ $email ]);
        $row = $result->getFirstRow();

        if ($row == null) return false; //email is not in DB

        $dbPassword = $row->memberPassword;
        $dbMemberKey = $row->memberKey;
        $hashedPassword = md5($password. $dbMemberKey);

        if ($dbPassword != $hashedPassword) return false; //Incorrect pw entered


        $this->session = service('session');
        $this->session->start();

        $this->session->set('memberID', $row->memberID);
        $this->session->set('roleID', $row->roleID);

        return true;
    }
}
//Don't create new model for homework just add function
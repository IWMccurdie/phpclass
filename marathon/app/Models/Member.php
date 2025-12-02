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

    public function add_user($memberName, $email, $password)
    {
        $db = db_connect();
        $query = "INSERT INTO members (memberName, memberEmail, memberPassword) VALUES (?, ?, ?)";
        $result = $db->query($query, [ $memberName, $email ]);
        $row = $result->getFirstRow();

        if ($row == null) return false; //email is not in DB

        $dbPassword = $row->memberPassword;
        $dbMemberKey = $row->memberKey;
        $hashedPassword = md5($password. $dbMemberKey);

        if ($dbPassword != $hashedPassword) return false; //Incorrect pw entered


        $this->session = service('session');
        $this->session->start();

        $this->session->set('roleID', $row->roleID);
        $this->session->set('memberID', $row->memberID);
        $this->session->set('memberKey', $row->memberKey);
        $this->session->set('memberName', $row->memberName);


        return true;
    }

    public function has_access($memberKey, $raceID)
    {
        try {
            $db = db_connect();
            $query = "SELECT r.raceID FROM races r JOIN member_race mr ON r.raceID = mr.raceID JOIN members m ON mr.memberID = m.memberID WHERE memberKey = ? AND mr.roleID > 1 AND mr.raceID = ?;";
            $result = $db->query($query, [ $memberKey, $raceID ]);
            $row = $result->getFirstRow();
            return $row != null;
        }
        catch (Exception $ex) {
            return false;
        }
    }
}
//Don't create new model for homework just add function
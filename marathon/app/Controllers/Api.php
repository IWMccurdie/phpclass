<?php

namespace App\Controllers;

use App\Models\Race;
use App\Models\Member;

class Api extends BaseController
{
    public function get_races($apiKey)
    {
        $Race = new Race();
        $races = $Race->get_races_api($apiKey);
        echo json_encode($races);
        exit();
    }
    public function get_runners($apiKey, $raceID)
    {
        $Race = new Race();
        $runners = $Race->get_runners($apiKey, $raceID);
        echo json_encode($runners);
        exit();
    }

    public function add_runner()
    {
        $body = file_get_contents("php://input");
        $json = json_decode($body, true);
        $apiKey = $json["apiKey"];
        $raceID = $json["raceId"];
        $memberID = $json["memberID"];

        $Member = new Member();
        if (!$Member->has_access($apiKey, $raceID))
        {
            echo "Access Denied";
            exit();
        }

        $Race = new Race();
        $Race->add_runner($memberID, $raceID);
        echo "Runner Added";
        exit();

    }

    public function delete_runner()
    {
        $body = file_get_contents("php://input");
        $json = json_decode($body, true);
        $apiKey = $json["apiKey"];
        $raceID = $json["raceId"];
        $memberID = $json["memberID"];

        $Member = new Member();
        if (!$Member->has_access($apiKey, $raceID))
        {
            echo "Access Denied";
            exit();
        }

        $Race = new Race();
        $Race->delete_runner($memberID, $raceID);
        echo "Runner Deleted";
        exit();
    }

}
<?php

    namespace App\Models;

    use CodeIgniter\Model;

    class Race extends Model
    {

        public function get_races()
        {
            $this->session = service("session");
            $this->session->start();
            $memberKey = $this->session->get('memberKey');

                $db = db_connect();
                $query = "SELECT r.raceID, raceName, raceLocation, raceDescription, raceDateTime FROM races r JOIN member_race mr ON r.raceID = mr.raceID JOIN members m ON m.memberID = mr.memberID WHERE memberKey = '?' AND m.roleID <= 2";
                $result = $db->query($query, [ $memberKey ]);
                return $result->getResultArray();
        }

        public function get_race($id)
        {
            $db = db_connect();
            $query = "SELECT * FROM races WHERE raceID = ?";
            $result = $db->query($query, [ $id ]);
            return $result->getResultArray()[0];
        }

        public function add_race($name, $description, $location, $dateTime)
        {
            $this->session = service("session");
            $this->session->start();
            $memberID = $this->session->get('memberID');

            $db = db_connect();
            $query = "INSERT INTO races(raceName, raceDescription, raceLocation, raceDateTime ) VALUES(?,?,?,?)";
            $db->query($query, [ $name, $description, $location, $dateTime ]);

            $query = "SELECT LAST_INSERT_ID()";
            $result = $db->query($query)->getResultArray()[0];
            $raceID = $result["LAST_INSERT_ID()"];

            $query = "INSERT INTO member_race (memberID, raceID, roleID) VALUES (?,?,?)";
            $db->query($query, [ $memberID, $raceID, 2]);
        }

        public function delete_race($id)
        {
            $db = db_connect();
            $query = "DELETE FROM races WHERE raceID = ?";
            $db->query($query, [ $id]);
        }

        public function update_race($id, $name, $description, $location, $dateTime)
        {
            $db = db_connect();
            $query = "UPDATE races SET raceName = ?, raceDescription = ?, raceLocation = ?, raceDateTime = ? WHERE raceID = ?";
            $db->query($query, [ $name, $description, $location, $dateTime, $id ]);
        }
    }
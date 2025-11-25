<?php

    namespace App\Models;

    use CodeIgniter\Model;

    class Race extends Model
    {

        public function get_races()
        {
                $db = db_connect();
                $query = "SELECT * FROM races";
                $result = $db->query($query);
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
            $db = db_connect();
            $query = "INSERT INTO races(raceName, raceDescription, raceLocation, raceDateTime ) VALUES(?,?,?,?)";
            $db->query($query, [ $name, $description, $location, $dateTime ]);
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
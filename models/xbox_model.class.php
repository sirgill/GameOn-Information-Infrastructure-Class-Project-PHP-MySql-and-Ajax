<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class XboxModel {

    private $db;
    private $dbConnection;
    static private $_instance = NULL;
    private $tblXbox;
    private $tblGameRating;

    private function __construct() {
        $this->db = Database::getDatabase();
        $this->dbConnection = $this->db->getConnection();
        $this->tblXbox = $this->db->getXboxTable();
        $this->tblGameRating = $this->db->getGameRatingTable();



        foreach ($_POST as $key => $value) {
            $_POST[$key] = $this->dbConnection->real_escape_string($value);
        }

        //Escapes special characters in a string for use in an SQL statement. This stops SQL Injection in GET vars 
        foreach ($_GET as $key => $value) {
            $_GET[$key] = $this->dbConnection->real_escape_string($value);
        }

        //initialize game ratings here 
        if (!isset($_SESSION['esrb_rating'])) {
            $ratings = $this->get_esrb_rating();
            $_SESSION['esrb_rating'] = $ratings;
        }
    }

    public static function getXboxModel() {
        if (self::$_instance == NULL) {
            self::$_instance = new XboxModel();
        }
        return self::$_instance;
    }

    public function list_game() {


        $sql = "SELECT * FROM " . $this->tblXbox . "," . $this->tblGameRating .
                " WHERE " . $this->tblXbox . ".esrb_rating=" . $this->tblGameRating . ".esrb_rating_id";
        try {
            //execute the query
            $query = $this->dbConnection->query($sql);


            // if the query failed, return false. 
            if (!$query) {
                throw new Exception("Query Failed in Model");
            }


            //if the query succeeded, but no game was found.
            if ($query->num_rows == 0) {
                throw new Exception();
            }


            //handle the result
            //create an array to store all returned games
            $xboxs = array();

            //loop through all rows in the returned recordsets
            while ($obj = $query->fetch_object()) {
                $xbox = new Xbox(stripslashes($obj->title), stripslashes($obj->release_year), stripslashes($obj->developer), stripslashes($obj->platform), stripslashes($obj->image), stripslashes($obj->esrb_rating));

                //set the id for the game
                $xbox->setId($obj->id);

                //add the game into the array
                $xboxs[] = $xbox;
            }
            return $xboxs;

            $errmsg = $this->dbconnection->error;
            throw new DatabaseException($e->getMessage());
        } catch (DatabaseException $e) {
            $error = new Error();
            $error->display($e->getMessage());
            return false;
        } catch (Exception $e) {
            $error = new Error();
            $error->display($e->getMessage());
            return false;
        }
    }

    public function view_game($id) {
        $sql = "SELECT * FROM " . $this->tblXbox . "," . $this->tblGameRating .
                " WHERE " . $this->tblXbox . ".esrb_rating=" . $this->tblGameRating . ".esrb_rating_id" .
                " AND " . $this->tblXbox . ".id='$id'";
        try {
            //execute the query
            $query = $this->dbConnection->query($sql);

            if ($query && $query->num_rows > 0) {
                $obj = $query->fetch_object();

                //create a game object
                $xbox = new Xbox(stripslashes($obj->title), stripslashes($obj->release_year), stripslashes($obj->developer), stripslashes($obj->platform), stripslashes($obj->image), stripslashes($obj->esrb_rating));

                //set the id for the game
                $xbox->setId($obj->id);

                return $xbox;
            }
            $errmsg = $this->dbconnection->error;
            throw new DatabaseException($e->getMessage());
        } catch (DatabaseException $e) {
            $error = new Error();
            $error->display($e->getMessage());
            return false;
        } catch (Exception $e) {
            $error = new Error();
            $error->display("An unexpected error has occurred.");
            return false;
        }
    }

    public function update_game($id) {
        //if the script did not received post data, display an error message and then terminite the script immediately

        if (!filter_has_var(INPUT_POST, 'title') ||
                !filter_has_var(INPUT_POST, 'release_year') ||
                !filter_has_var(INPUT_POST, 'developer') ||
                !filter_has_var(INPUT_POST, 'platform') ||
                !filter_has_var(INPUT_POST, 'image') ||
                !filter_has_var(INPUT_POST, 'esrb_rating')) {

            return false;
        }


        //retrieve data for the new xbox game; data are sanitized and escaped for security.
        $title = $this->dbConnection->real_escape_string(trim(filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING)));
        $release_year = $this->dbConnection->real_escape_string(trim(filter_input(INPUT_POST, 'release_year', FILTER_SANITIZE_STRING)));
        $developer = $this->dbConnection->real_escape_string(filter_input(INPUT_POST, 'developer', FILTER_SANITIZE_STRING));
        $platform = $this->dbConnection->real_escape_string(trim(filter_input(INPUT_POST, 'platform', FILTER_SANITIZE_STRING)));
        $image = $this->dbConnection->real_escape_string(trim(filter_input(INPUT_POST, 'image', FILTER_SANITIZE_STRING)));
        $esrb_rating = $this->dbConnection->real_escape_string(trim(filter_input(INPUT_POST, 'esrb_rating', FILTER_SANITIZE_STRING)));

        //query string for update 
        $sql = "UPDATE " . $this->tblXbox .
                " SET title='$title', release_year='$release_year', developer='$developer', platform='$platform', "
                . "image='$image', esrb_rating='$esrb_rating' WHERE id='$id'";

        //execute the query
        return $this->dbConnection->query($sql);
    }

    public function add_game() {

        if (!filter_has_var(INPUT_POST, 'title') ||
                !filter_has_var(INPUT_POST, 'release_year') ||
                !filter_has_var(INPUT_POST, 'developer') ||
                !filter_has_var(INPUT_POST, 'platform') ||
                !filter_has_var(INPUT_POST, 'image') ||
                !filter_has_var(INPUT_POST, 'esrb_rating')) {

            return false;
        }


        //retrieve data for the new xbox game; data are sanitized and escaped for security.
        $title = $this->dbConnection->real_escape_string(trim(filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING)));
        $release_year = $this->dbConnection->real_escape_string(trim(filter_input(INPUT_POST, 'release_year', FILTER_SANITIZE_STRING)));
        $developer = $this->dbConnection->real_escape_string(filter_input(INPUT_POST, 'developer', FILTER_SANITIZE_STRING));
        $platform = $this->dbConnection->real_escape_string(trim(filter_input(INPUT_POST, 'platform', FILTER_SANITIZE_STRING)));
        $image = $this->dbConnection->real_escape_string(trim(filter_input(INPUT_POST, 'image', FILTER_SANITIZE_STRING)));
        $esrb_rating = $this->dbConnection->real_escape_string(trim(filter_input(INPUT_POST, 'esrb_rating', FILTER_SANITIZE_STRING)));


        //query string for update 
        $sql = "INSERT INTO " . $this->tblXbox . " VALUES(NULL, '$title', '$release_year', '$developer', '$platform', '$image', '$esrb_rating')";

        //execute the query
        return $this->dbConnection->query($sql);
    }

    public function delete_game($id) {

//this query statement deletes game from table
        $sql = "DELETE FROM . $this->tblXbox . WHERE id=$id";

        return $this->dbConnection->query($sql);
    }

    public function search_xbox($terms) {
        $terms = explode(" ", $terms); //explode multiple terms into an array
        //select statement for AND serach
        $sql = "SELECT * FROM " . $this->tblXbox . "," . $this->tblGameRating .
                " WHERE " . $this->tblXbox . ".esrb_rating=" . $this->tblGameRating . ".esrb_rating_id AND (1";
        try {
            foreach ($terms as $term) {
                $sql .= " AND title LIKE '%" . $term . "%'";
            }

            $sql .= ")";

            //execute the query
            $query = $this->dbConnection->query($sql);

            // the search failed, give error message. 
            if (!$query) {
                return false;
            }

            //search succeeded, but no xbox game was found.
            if ($query->num_rows == 0) {
                throw new Exception("");
            }
            //search succeeded, and found at least 1 xbox game found.
            //create an array to store all the returned xbox game
            $xboxs = array();

            //loop through all rows in the returned recordsets
            while ($obj = $query->fetch_object()) {
                $xbox = new Xbox($obj->title, $obj->release_year, $obj->developer, $obj->platform, $obj->image, $obj->esrb_rating);

                //set the id for the movie
                $xbox->setId($obj->id);

                //add the xbox games into the array
                $xboxs[] = $xbox;
            }
            return $xboxs;
            $errmsg = $this->dbconnection->error;
            throw new DatabaseException($e->getMessage());
        } catch (DatabaseException $e) {
            $error = new Error();
            $error->display($e->getMessage());
            return false;
        } catch (Exception $e) {
            $error = new Error();
            $error->display("No Xbox Games were Found");
            return false;
        }
    }

    private function get_esrb_rating() {
        $sql = "SELECT * FROM " . $this->tblGameRating;
        try {
            //execute the query
            $query = $this->dbConnection->query($sql);

            if (!$query) {
                return false;
            }

            //loop through all rows
            $ratings = array();
            while ($obj = $query->fetch_object()) {
                $ratings[$obj->esrb_rating] = $obj->esrb_rating_id;
            }
            return $ratings;
            $errmsg = $this->dbconnection->error;
            throw new DatabaseException($e->getMessage());
        } catch (DatabaseException $e) {
            $error = new Error();
            $error->display($e->getMessage());
            return false;
        } catch (Exception $e) {
            $error = new Error();
            $error->display("An unexpected error has occurred.");
            return false;
        }
    }

}

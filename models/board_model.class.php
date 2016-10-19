<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class BoardModel {

    private $db;
    private $dbConnection;
    static private $_instance = NULL;
    private $tblBoard;
    private $tblBoardRating;

    private function __construct() {
        $this->db = Database::getDatabase();
        $this->dbConnection = $this->db->getConnection();
        $this->tblBoard = $this->db->getBoardTable();
        $this->tblBoardRating = $this->db->getBoardRatingTable();




        foreach ($_POST as $key => $value) {
            $_POST[$key] = $this->dbConnection->real_escape_string($value);
        }

        //Escapes special characters in a string for use in an SQL statement. This stops SQL Injection in GET vars 
        foreach ($_GET as $key => $value) {
            $_GET[$key] = $this->dbConnection->real_escape_string($value);
        }
        if (!isset($_SESSION['age_rating'])) {
            $ratings = $this->get_age_rating();
            $_SESSION['age_rating'] = $ratings;
        }
    }

    public static function getBoardModel() {
        if (self::$_instance == NULL) {
            self::$_instance = new BoardModel();
        }
        return self::$_instance;
    }

    public function list_game() {


        $sql = "SELECT * FROM " . $this->tblBoard . "," . $this->tblBoardRating .
                " WHERE " . $this->tblBoard . ".age_rating=" . $this->tblBoardRating . ".age_rating_id";

        //execute the query
        $query = $this->dbConnection->query($sql);


        // if the query failed, return false. 
        if (!$query)
            return false;

        //if the query succeeded, but no game was found.
        if ($query->num_rows == 0)
            return 0;

        //handle the result
        //create an array to store all returned games
        $boards = array();

        //loop through all rows in the returned recordsets
        while ($obj = $query->fetch_object()) {
            $board = new Board(stripslashes($obj->title), stripslashes($obj->release_year), stripslashes($obj->publisher), stripslashes($obj->image), stripslashes($obj->age_rating));

            //set the id for the game
            $board->setId($obj->id);

            //add the game into the array
            $boards[] = $board;
        }
        return $boards;
    }

    public function view_game($id) {
        $sql = "SELECT * FROM " . $this->tblBoard . "," . $this->tblBoardRating .
                " WHERE " . $this->tblBoard . ".age_rating=" . $this->tblBoardRating . ".age_rating_id" .
                " AND " . $this->tblBoard . ".id='$id'";
        try {
            //execute the query
            $query = $this->dbConnection->query($sql);

            if ($query && $query->num_rows > 0) {
                $obj = $query->fetch_object();

                //create a game object
                $board = new Board(stripslashes($obj->title), stripslashes($obj->release_year), stripslashes($obj->publisher), stripslashes($obj->image), stripslashes($obj->age_rating));

                //set the id for the game
                $board->setId($obj->id);

                return $board;
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
                !filter_has_var(INPUT_POST, 'publisher') ||
                !filter_has_var(INPUT_POST, 'image') ||
                !filter_has_var(INPUT_POST, 'age_rating')) {

            return false;
        }

        //retrieve data for the new game; data are sanitized and escaped for security.
        $title = $this->dbConnection->real_escape_string(trim(filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING)));
        $release_year = $this->dbConnection->real_escape_string(trim(filter_input(INPUT_POST, 'release_year', FILTER_SANITIZE_STRING)));

        $publisher = $this->dbConnection->real_escape_string(trim(filter_input(INPUT_POST, 'publisher', FILTER_SANITIZE_STRING)));
        $image = $this->dbConnection->real_escape_string(trim(filter_input(INPUT_POST, 'image', FILTER_SANITIZE_STRING)));
        $age_rating = $this->dbConnection->real_escape_string(trim(filter_input(INPUT_POST, 'age_rating', FILTER_SANITIZE_STRING)));

        //query string for update 
        $sql = "UPDATE " . $this->tblBoard .
                " SET title='$title', release_year='$release_year',  publisher='$publisher', "
                . "image='$image', age_rating='$age_rating' WHERE id='$id'";

        //execute the query
        return $this->dbConnection->query($sql);
    }

    public function add_game() {

        if (!filter_has_var(INPUT_POST, 'title') ||
                !filter_has_var(INPUT_POST, 'release_year') ||
                !filter_has_var(INPUT_POST, 'publisher') ||
                !filter_has_var(INPUT_POST, 'image') ||
                !filter_has_var(INPUT_POST, 'age_rating')) {

            return false;
        }


        //retrieve data for the new game; data are sanitized and escaped for security.
        $title = $this->dbConnection->real_escape_string(trim(filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING)));
        $release_year = $this->dbConnection->real_escape_string(trim(filter_input(INPUT_POST, 'release_year', FILTER_SANITIZE_STRING)));
        $publisher = $this->dbConnection->real_escape_string(filter_input(INPUT_POST, 'publisher', FILTER_SANITIZE_STRING));
        $image = $this->dbConnection->real_escape_string(trim(filter_input(INPUT_POST, 'image', FILTER_SANITIZE_STRING)));
        $age_rating = $this->dbConnection->real_escape_string(trim(filter_input(INPUT_POST, 'age_rating', FILTER_SANITIZE_STRING)));


        //query string for update 
        $sql = "INSERT INTO " . $this->tblBoard . " VALUES(NULL, '$title', '$release_year', '$publisher', '$image', '$age_rating')";

        //execute the query
        return $this->dbConnection->query($sql);
    }

    public function search_board($terms) {
        $terms = explode(" ", $terms); //explode multiple terms into an array
        //select statement for AND serach
        $sql = "SELECT * FROM " . $this->tblBoard . "," . $this->tblBoardRating .
                " WHERE " . $this->tblBoard . ".age_rating=" . $this->tblBoardRating . ".age_rating_id AND (1";
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

            //search succeeded, and found at least 1  game found.
            //create an array to store all the returned  game
            $boards = array();

            //loop through all rows in the returned recordsets
            while ($obj = $query->fetch_object()) {
                $board = new Board($obj->title, $obj->release_year, $obj->publisher, $obj->image, $obj->age_rating);

                //set the id for the game
                $board->setId($obj->id);

                //add the  games into the array
                $boards[] = $board;
            }
            return $boards;
            $errmsg = $this->dbconnection->error;
            throw new DatabaseException($e->getMessage());
        } catch (DatabaseException $e) {
            $error = new Error();
            $error->display($e->getMessage());
            return false;
        } catch (Exception $e) {
            $error = new Error();
            $error->display("No Board Games were Found");
            return false;
        }
    }

    private function get_age_rating() {
        $sql = "SELECT * FROM " . $this->tblBoardRating;
        try {
            //execute the query
            $query = $this->dbConnection->query($sql);

            if (!$query) {
                $errmsg = $this->dbconnection->error;
                throw new DatabaseException($e->getMessage());
            }

            //loop through all rows
            $ratings = array();
            while ($obj = $query->fetch_object()) {
                $ratings[$obj->age_rating] = $obj->age_rating_id;
            }
            return $ratings;
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

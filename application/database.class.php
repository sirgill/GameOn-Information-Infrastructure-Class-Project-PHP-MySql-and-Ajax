<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Database {

    //define database parameters
    private $param = array(
        'host' => 'localhost',
        'login' => 'phpuser',
        'password' => 'phpuser',
        'database' => 'gameon_db',
        'tblXbox' => 'xbox',
        'tblBoard' => 'board_games',
        'tblMobile' => 'mobile',
        'tblGameRating' => 'games_ratings',
        'tblBoardRating' => 'board_rating'
    );
    //define the database connection object
    private $objDBConnection = NULL;
    static private $_instance = NULL;

    //constructor
    private function __construct() {
        try {
            $this->objDBConnection = @new mysqli(
                    $this->param['host'], $this->param['login'], $this->param['password'], $this->param['database']
            );
            if (mysqli_connect_errno() != 0) {
                $errmsg = "Error: " . mysqli_connect_error();
                throw new DatabaseException($errmsg);
            }
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

    //static method to ensure there is just one Database instance
    static public function getDatabase() {
        if (self::$_instance == NULL)
            self::$_instance = new Database();
        return self::$_instance;
    }

    //this function returns the database connection object
    public function getConnection() {
        return $this->objDBConnection;
    }

    public function getXboxTable() {
        return $this->param['tblXbox'];
    }

    public function getBoardTable() {
        return $this->param['tblBoard'];
    }

    public function getMobileTable() {
        return $this->param['tblMobile'];
    }

    public function getGameRatingTable() {
        return $this->param['tblGameRating'];
    }

    public function getBoardRatingTable() {
        return $this->param['tblBoardRating'];
    }

}

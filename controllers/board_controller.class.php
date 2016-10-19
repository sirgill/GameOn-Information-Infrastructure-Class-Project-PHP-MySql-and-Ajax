<?php

/*
 * Xbox controller 
 */

class BoardController {

    private $board_model; //private data member

    public function __construct() { //construct to grab the xbox model
        $this->board_model = BoardModel::getBoardModel();
    }

    public function index() { // the index view which will display xbox array
        $boards = $this->board_model->list_game();

        if (!$boards) { // will display xbox error if books not found
            $message = "There was a problem displaying games";
            $this->error($message);
            return;
        }
        $view = new BoardIndex();
        $view->display($boards);
    }

    public function detail($id) { //detail view in which the details of the xbox will be displayed
        $board = $this->board_model->view_game($id);

        if (!$board) { // will display error in view if xbox game not found
            $message = "There was a problem displaying the game id='" . $id . "'.";
            $this->error($message);
            return;
        }
        $view = new BoardDetail();
        $view->display($board);
    }
   
     public function edit($id) {
        //retrieve the specific movie
        $board = $this->board_model->view_game($id);

        if (!$board) {
            //display an error
            $message = "There was a problem displaying the game id='" . $id . "'.";
            $this->error($message);
            return;
        }

        $view = new BoardEdit();
        $view->display($board);
    }
    
     public function update($id) {
        //update the movie
        $update = $this->board_model->update_game($id);
        if (!$update) {
            //handle errors
            $message = "There was a problem updating the game id='" . $id . "'.";
            $this->error($message);
            return;
        }

        //display the updateed movie details
        $confirm = "The board game was successfully updated.";
        $board = $this->board_model->view_game($id);

        $view = new BoardDetail();
        $view->display($board, $confirm);
    }
    
    public function insert() {
        
            $insert=$this->board_model->add_game();
            
            $view=new BoardInsert();
            $view->display();      
        
    }
    
    public function search() {
        //retrieve query terms from search form
        $query_terms = trim($_GET['query-terms']);

        //if search term is empty, list all movies
        if ($query_terms == "") {
            $this->index();
        }

        //search the database for matching movies
        $boards = $this->board_model->search_board($query_terms);

        if ($boards === false) {
            //handle error
            $message = "An error has occurred.";
            $this->error($message);
            return;
        }
        //display matched movies
        $search = new BoardSearch();
        $search->display($query_terms, $boards);
    }
    
    public function suggest($terms) {
        //retrieve query terms
        $query_terms = urldecode(trim($terms));
        $boards = $this->board_model->search_board($query_terms);

        //retrieve all movie titles and store them in an array
        $titles = array();
        if ($boards) {
            foreach ($boards as $board) {
                $titles[] = $board->getTitle();
            }
        }

        echo json_encode($titles);
    }
 
    

    public function error($message) {
        //create an object of the Error class
        $error = new BoardError();

        //display the error page
        $error->display($message);
    }

}


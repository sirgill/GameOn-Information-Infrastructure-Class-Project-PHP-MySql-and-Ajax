<?php

/*
 * Xbox controller 
 */

class XboxController {

    private $xbox_model; //private data member

    public function __construct() { //construct to grab the xbox model
        $this->xbox_model = XboxModel::getXboxModel();
    }

    public function index() { // the index view which will display xbox array
        $xboxs = $this->xbox_model->list_game();

        if (!$xboxs) { // will display xbox error if xbox not found
            $message = "There was a problem displaying games";
            $this->error($message);
            return;
        }
        $view = new XboxIndex();
        $view->display($xboxs);
    }

    public function detail($id) { //detail view in which the details of the xbox will be displayed
        $xbox = $this->xbox_model->view_game($id);

        try {
            if (!$xbox) { // will display error in view if xbox game not found
                throw new Exception("Error displaying this game");
            }
            $view = new XboxDetail();
            $view->display($xbox);
        } catch (DataMissingException $e) {
            $error = new Error();
            $error->display($e->getMessage());
            return false;
        } catch (Exception $e) {
            $error = new Error();
            $error->display($e->getMessage());
            return false;
        }
    }

    public function edit($id) {
        //retrieve the specific movie
        $xbox = $this->xbox_model->view_game($id);


        if (!$xbox) {
            // display an error
            $message = "There was a problem displaying the movie id='" . $id . "'.";
            $this->error($message);
            return;
        }
        $view = new XboxEdit();
        $view->display($xbox);
    }

    public function update($id) {
        //update the movie
        $update = $this->xbox_model->update_game($id);
        if (!$update) {
            //handle errors
            $message = "There was a problem updating the game id='" . $id . "'.";
            $this->error($message);
            return;
        }

        //display the updateed movie details
        $confirm = "The xbox game was successfully updated.";
        $xbox = $this->xbox_model->view_game($id);

        $view = new XboxDetail();
        $view->display($xbox, $confirm);
    }

    public function add() {

        $add = $this->xbox_model->add_game();

        $view = new XboxInsert();
        $view->display();
    }

    public function delete($id) {
        $delete = $this->xbox_model->delete_game($id);
        if (!$delete) {
            //handle errors
            $message = "There was a problem deleting the game id='" . $id . "'.";
            $this->error($message);
            return;
        }

        //display the updateed movie details
        $confirm = "The xbox game was successfully deleted.";
        $xbox = $this->xbox_model->view_game($id);

        $view = new XboxDetail();
        $view->display($xbox, $confirm);
    }

    public function search() {
        //retrieve query terms from search form
        $query_terms = trim($_GET['query-terms']);

        //if search term is empty, list all movies
        if ($query_terms == "") {
            $this->index();
        }

        //search the database for matching movies
        $xboxs = $this->xbox_model->search_xbox($query_terms);

        if ($xboxs === false) {
            //handle error
            $message = "An error has occurred.";
            $this->error($message);
            return;
        }
        //display matched movies
        $search = new XboxSearch();
        $search->display($query_terms, $xboxs);
    }

    public function suggest($terms) {
        //retrieve query terms
        $query_terms = urldecode(trim($terms));
        $xboxs = $this->xbox_model->search_xbox($query_terms);

        //retrieve all movie titles and store them in an array
        $titles = array();
        if ($xboxs) {
            foreach ($xboxs as $xbox) {
                $titles[] = $xbox->getTitle();
            }
        }

        echo json_encode($titles);
    }

    public function error($message) {
        //create an object of the Error class
        $view = new Error();

        //display the error page
        $view->display($message);
    }

}

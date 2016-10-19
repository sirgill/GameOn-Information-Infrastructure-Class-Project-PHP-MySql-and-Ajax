<?php

/*
 * mobile controller 
 */

class MobileController {

    private $mobile_model; //private data member

    public function __construct() { //construct to grab the mobile model
        $this->mobile_model = MobileModel::getMobileModel();
    }

    public function index() { // the index view which will display mobile array
        $mobiles = $this->mobile_model->list_game();

        if (!$mobiles) { // will display mobile error if mobile not found
            $message = "There was a problem displaying games";
            $this->error($message);
            return;
        }
        $view = new MobileIndex();
        $view->display($mobiles);
    }

    public function detail($id) { //detail view in which the details of the mobile will be displayed
        $mobile = $this->mobile_model->view_game($id);

        if (!$mobile) { // will display error in view if mobile game not found
            $message = "There was a problem displaying the game id='" . $id . "'.";
            $this->error($message);
            return;
        }
        $view = new MobileDetail();
        $view->display($mobile);
    }

    public function edit($id) {
        //retrieve the specific game
        $mobile = $this->mobile_model->view_game($id);

        if (!$mobile) {
            //display an error
            $message = "There was a problem displaying the game id='" . $id . "'.";
            $this->error($message);
            return;
        }

        $view = new MobileEdit();
        $view->display($mobile);
    }

    public function update($id) {
        //update the game
        $update = $this->mobile_model->update_game($id);
        if (!$update) {
            //handle errors
            $message = "There was a problem updating the game id='" . $id . "'.";
            $this->error($message);
            return;
        }

        //display the updateed game details
        $confirm = "The mobile game was successfully updated.";
        $mobile = $this->mobile_model->view_game($id);

        $view = new MobileDetail();
        $view->display($mobile, $confirm);
    }

    public function add() {

        $add = $this->mobile_model->add_game();

        $view = new MobileInsert();
        $view->display();
    }

    public function search() {
        //retrieve query terms from search form
        $query_terms = trim($_GET['query-terms']);

        //if search term is empty, list all games
        if ($query_terms == "") {
            $this->index();
        }

        //search the database for matching games
        $mobiles = $this->mobile_model->search_mobile($query_terms);

        if ($mobiles === false) {
            //handle error
            $message = "An error has occurred.";
            $this->error($message);
            return;
        }
        //display matched games
        $search = new MobileSearch();
        $search->display($query_terms, $mobiles);
    }

    public function suggest($terms) {
        //retrieve query terms
        $query_terms = urldecode(trim($terms));
        $mobiles = $this->mobile_model->search_mobile($query_terms);

        //retrieve all games titles and store them in an array
        $titles = array();
        if ($mobiles) {
            foreach ($mobiles as $mobile) {
                $titles[] = $mobile->getTitle();
            }
        }

        echo json_encode($titles);
    }

    public function error($message) {
        //create an object of the Error class
        $error = new Error();

        //display the error page
        $error->display($message);
    }

}

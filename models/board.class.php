<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Board {

    private $id, $title, $release_year, $publisher, $image, $age_rating;

    public function __construct($title, $release_year, $publisher, $image, $age_rating) {
        $this->title = $title;
        $this->release_year = $release_year;
        $this->publisher = $publisher;
        $this->image = $image;
        $this->age_rating = $age_rating;
    }

    public function getId() {
        return $this->id;
    }

    public function getTitle() {
        return $this->title;
    }

    public function getRelease_year() {
        return $this->release_year;
    }

    public function getPublisher() {
        return $this->publisher;
    }

    public function getImage() {
        return $this->image;
    }

    public function getAge_rating() {
        return $this->age_rating;
    }

    public function setId($id) {
        $this->id = $id;
    }

}

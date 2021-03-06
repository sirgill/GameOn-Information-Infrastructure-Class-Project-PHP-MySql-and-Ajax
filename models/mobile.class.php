<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Mobile {

    private $id, $title, $release_year, $developer, $operating_system, $image, $esrb_rating;

    public function __construct($title, $release_year, $developer, $operating_system, $image, $esrb_rating) {
        $this->title = $title;
        $this->release_year = $release_year;
        $this->developer = $developer;
        $this->operating_system = $operating_system;
        $this->image = $image;
        $this->esrb_rating = $esrb_rating;
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

    public function getDeveloper() {
        return $this->developer;
    }

    public function getOperating_system() {
        return $this->operating_system;
    }

    public function getImage() {
        return $this->image;
    }

    public function getEsrb_rating() {
        return $this->esrb_rating;
    }

    public function setId($id) {
        $this->id = $id;
    }

}

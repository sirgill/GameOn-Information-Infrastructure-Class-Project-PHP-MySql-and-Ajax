<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class Utilities {
    //validate an email address. An valid email address appears in the format of "username@domain.domain"
    public static function checkemail($email) {
        $result = TRUE;
        if (!preg_match("/^[_a-z0-9-]+(.[_a-z0-9-]+)*@[a-z0-9-]+(.[a-z0-9-]+)*(.[a-z]{2,3})$/i", $email)) {
            $result = FALSE;
        }
        return $result;
    }

    //validate a date. A valid date must be entered in 'mm/dd/yyyy' or 'mm-dd-yyyy' format
    public static function validatedate($date) {
        if(count(explode('/', $date))<3) {return false;}
        list( $m, $d, $y ) = preg_split('/[-\.\/ ]/', $date);
        if (!is_numeric($m) || !is_numeric($d) || !is_numeric($y) || $y < 1000 || $y > 9999)
        {return false;}
        return checkdate($m, $d, $y);
    }

}

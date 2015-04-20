<?php
/**
 * Created by IntelliJ IDEA.
 * User: SethUrban
 * Date: 4/19/15
 * Time: 8:37 PM
 */

include "sqlcreds.php";

class customer {
    private $first_name;
    private $last_name;
    private $s_first_name;
    private $s_last_name;
    private $s_address_1;
    private $s_address_2;
    private $s_city;
    private $s_region;
    private $s_postalcode;
    private $b_address1;
    private $b_address2;
    private $b_city;
    private $b_region;
    private $b_postalcode;
    private $password;
    private $email_address;
    private $home_phone;
    private $bus_phone;
    private $mobile_phone;
    private $cc_number;
    private $cc_expm;
    private $cc_expy;
    private $cc_ccv;

    private $sqlinfo;

    function __construct(){
        $this->sqlinfo = new sqlcreds("private");
    }

    function get_billing($fn, $ln, $add1, $add2, $city, $region, $postal){
        $this->first_name = $fn;
        $this->last_name = $ln;
        $this->b_address1 = $add1;
        $this->b_address2 = $add2;
        $this->b_city = $city;
        $this->b_region = $region;
        $this->b_postalcode = $postal;
    }

    function get_shipping($fn, $ln, $add1, $add2, $city, $region, $postal){
        $this->s_first_name = $fn;
        $this->s_last_name = $ln;
        $this->s_address_1 = $add1;
        $this->s_address_2 = $add2;
        $this->s_city = $city;
        $this->s_region = $region;
        $this->s_postalcode = $postal;
    }

    function get_payment($cardnum, $expm, $expy, $ccv){
        $this->cc_number = $cardnum;
        $this->cc_expm = $expm;
        $this->cc_expy = $expy;
        $this->cc_ccv = $ccv;
    }




}
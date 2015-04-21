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

    function post_info(){
        mysql_connect($this->sqlinfo->server, $this->sqlinfo->username, $this->sqlinfo->password);
        mysql_select_db($this->sqlinfo->database);
        $result = mysql_query('INSERT INTO customer(first_name,last_name,shipping_address_1,shipping_address_2,shipping_city,shipping_region,shipping_postal_code,
        billing_address_1,billing_address_2,billing_city,billing_region,billing_postal_code)
        VALUES("'.$this->first_name.'","'.$this->last_name.'","'.$this->s_address_1.'","'.$this->s_address_2.'","'.$this->s_city.'","'.$this->s_region.'","'.$this->s_postalcode.'",
        "'.$this->b_address1.'","'.$this->b_address2.'","'.$this->b_city.'","'.$this->b_region.'","'.$this->b_postalcode.'");');
        $result = mysql_query('SELECT customer_id FROM customer WHERE first_name = "'.$this->first_name .'" AND last_name = "'.$this->last_name.'" AND billing_postal_code = "' . $this->b_postalcode.'";');
        $returned_row = mysql_fetch_row($result);
        $customerid = $returned_row[0];
        return $customerid;
    }






}
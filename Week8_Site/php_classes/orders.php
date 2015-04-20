<?php
include "customer.php";
include_once "sqlcreds.php";

class orders {
    private $products;
    private $ordered_qtys;
    private $prices;
    private $customer;
    private $sqlinfo;
    private $orderid;

    function __construct(){
        $this->products = array();
        $this->ordered_qtys = array();
        $this->prices = array();
        $this->sqlinfo = new sqlcreds("private");
    }

    function get_products(){
        //go through all the products ordered and get the ids and values
        foreach ( $_POST as $key => $value){
            if ($value > 0){
                array_push($this->products, $key);
                array_push($this->ordered_qtys, $value);
            }
        }
        $this->push_order();
    }

    function push_order(){
        //create a temp record using timestamp
        mysql_connect($this->sqlinfo->server, $this->sqlinfo->username, $this->sqlinfo->password);
        mysql_select_db($this->sqlinfo->database);
        $result = mysql_query('SELECT unix_timestamp()');
        $returned_row = mysql_fetch_row($result);
        $date = $returned_row[0];

        $create_order = mysql_query('INSERT INTO order_header(customer_id,order_date,method_of_payment,payment_number,expire_month,expire_year,shipping_method,shipping_type,billto_first_name,
billto_last_name,billto_address_1,billto_address_2,billto_city,billto_region,billto_postal_code,shipto_first_name,shipto_last_name,shipto_address_1,shipto_address_2,
shipto_city,shipto_region,shipto_postal_code,estimated_delivery_date)VALUES("","'.$date.'","","","","","","","","","","","","","","","","","","","","","");');

        $orderid = mysql_query('SELECT order_id FROM order_header WHERE order_date = "' . $date . '";');
        $returned_row = mysql_fetch_row($orderid);
        $this->orderid = $returned_row[0];

    }


}
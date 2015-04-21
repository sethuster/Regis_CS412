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

        $orderid = mysql_query('SELECT order_id FROM order_header WHERE order_date = ' . $date . ';');
        $returned_row = mysql_fetch_row($orderid);
        $this->orderid = $returned_row[0];

        for($i = 0; $i < count($this->products); $i++){
            $returned_row = mysql_query('SELECT prod_cost, prod_qty_on_hand, prod_ship_cost FROM product WHERE prod_id = ' . $this->products[$i] . ';' );
            $returned_row = mysql_fetch_row($returned_row);
            $available = $returned_row[1] - $this->ordered_qtys[$i];
            if($available > 0){
                $available = $this->ordered_qtys[$i];
            }
            else{
                //This is where we have less on hand than customer wants
                $available = $this->ordered_qtys[$i] - $available;
            }
            mysql_query('INSERT into order_line (order_id, product_id, qty_ordered, qty_shipping, unit_price, unit_ship_price) VALUES ('.$this->orderid.', '.$this->products[$i].',
            '.$this->ordered_qtys[$i].', '.$available.', '.$returned_row[0].', '.$returned_row[2].');');
        }
    }

    function get_orderid(){
        return $this->orderid;
    }

    function create_order($orderid){
        mysql_connect($this->sqlinfo->server, $this->sqlinfo->username, $this->sqlinfo->password);
        mysql_select_db($this->sqlinfo->database);
        //now we need to get the customer information
        $customer = new customer();
        $customer->get_billing($_POST['cust_first_name'],$_POST['cust_last_name'], $_POST['cust_address1'], $_POST['cust_address2'], $_POST['cust_city'], $_POST['cust_state'], $_POST['cust_zip']);
        $customer->get_shipping($_POST['ship_first_name'],$_POST['ship_last_name'], $_POST['ship_address1'], $_POST['ship_address2'], $_POST['ship_city'], $_POST['ship_state'], $_POST['ship_zip']);
        $customerid = $customer->post_info();
        $result = mysql_query('UPDATE order_header set customer_id = "'. $customerid .'", order_date = CURRENT_DATE, method_of_payment = "'.$_POST['Credit_Card_Type'].'", payment_number = "'.$_POST['Credit_Card_Number'].'",
        expire_month = "'.$_POST['Credit_Card_Month'].'", expire_year = "'.$_POST['Credit_Card_Year'].'", shipping_method = "'.$_POST['shipping'].'" WHERE order_id = "'.$orderid.'";');

        $result = mysql_query('UPDATE order_header set billto_first_name = "'.$_POST['cust_first_name'].'", billto_last_name = "'.$_POST['cust_last_name'].'", billto_address_1 = "'.$_POST['cust_address1'].'", billto_address_2 = "'.$_POST['cust_address2'].'",
        billto_city = "'.$_POST['cust_city'].'", billto_region = "'.$_POST['cust_state'].'", billto_postal_code = "'.$_POST['cust_zip'].'", shipto_first_name = "'.$_POST['ship_first_name'].'", shipto_last_name="'.$_POST['ship_last_name'].'", shipto_address_1="'.$_POST['ship_address1'].'",
        shipto_address_2="'.$_POST['ship_address2'].'", shipto_city="'.$_POST['ship_city'].'", shipto_region = "'.$_POST['ship_state'].'", shipto_postal_code = "'.$_POST['ship_zip'].'" WHERE order_id = "'.$orderid.'";');

        //update shipping here - there's probably a better way to do this but, not a lot of time
        $shipping = $_POST['shipping'];
        if ($shipping == "parcel"){
            mysql_query('UPDATE order_header set estimated_delivery_date = DATE_ADD(CURRENT_DATE, INTERVAL 42 DAY) WHERE order_id = "'.$orderid.'";');
        }
        if ($shipping == "regular"){
            mysql_query('UPDATE order_header set estimated_delivery_date = DATE_ADD(CURRENT_DATE, INTERVAL 4 DAY) WHERE order_id = "'.$orderid.'";');
        }
        if ($shipping == "express"){
            mysql_query('UPDATE order_header set estimated_delivery_date = DATE_ADD(CURRENT_DATE, INTERVAL 1 DAY) WHERE order_id = "'.$orderid.'";');
        }

        $output = "";
        foreach ($_POST as $key => $value){
            $output .= "key: " . $key . " value: " . $value . "<br>";
        }
        return $output;

    }


}
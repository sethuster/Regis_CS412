<?php
/**
 * Created by IntelliJ IDEA.
 * User: SethUrban
 * Date: 4/12/15
 * Time: 5:20 PM
 */
include "sqlcreds.php";

class product_info {
    //product infos
    private $_prodid;
    private $_prodname;
    private $_prodDescription;
    private $_prodcost;
    private $_prod_category;
    private $_prod_qty;
    private $_prod_ship_cost;
    private $_prod_ship_weight;
    private $_prod_filename;
    private $_prod_demo;

    //sql info
    private $sqlinfo;
    private $query = "SELECT * FROM product WHERE prod_id = ";

    function __construct($prodid){
        $this->sqlinfo = new sqlcreds();
        $this->_prodid = (int) $prodid;
        $this->queryDatabase();
    }

    function queryDatabase(){
        mysql_connect( $this->sqlinfo->server, $this->sqlinfo->username, $this->sqlinfo->password);
        mysql_select_db($this->sqlinfo->database);
        $result = mysql_query($this->query . $this->_prodid);
        $result = mysql_fetch_row($result);
        $this->_prodname = $result[1];
        $this->_prodDescription = $result[2];
        $this->_prod_category = $result[3];
        $this->_prodcost = $result[4];
        $this->_prod_qty = $result[5];
        $this->_prod_ship_cost = $result[6];
        $this->_prod_ship_weight = $result[7];
        $this->_prod_filename = "./images/robots/" . $result[8];
        $this->_prod_demo = $result[9];
    }

    function get_prodname(){
        return $this->_prodname;
    }

    function display_product(){
        $prod_head = '<table width="100%"><td><H1>'. $this->_prodname . '</H1></td></table>';
        $prod_body = '<table width="100%"><td width="35%"><img src="' . $this->_prod_filename . '" width="200px" height="300px"></td>
                <td valign="top"><p>' . $this->_prodDescription . '</p>' . $this->_prod_demo . '</td></table>';
        $prod_prices = '<table class="prices" width="100%"><td>Unit Price: $' . $this->_prodcost . '</td><td>Shipping Cost: $' . $this->_prod_ship_cost . '</td></table>';
        $prod_buy = '<a class="bot-link" href="./bill_order_info.html" align="right">Buy Now!</a>';
        return $prod_head . $prod_body . $prod_prices . $prod_buy;
    }

    function prod_demo(){
        $prod_demo = "";
        if($this->_prod_demo != ""){
            $prod_demo = '<iframe width="100%" height="315" src="'. $this->_prod_demo . '" frameborder="0" allowfullscreen></iframe>';
        }
        return $prod_demo;
    }

}

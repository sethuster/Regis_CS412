<?php
/**
 * Created by IntelliJ IDEA.
 * User: SethUrban
 * Date: 4/12/15
 * Time: 8:18 PM
 */
include "sqlcreds.php";

class product_list {
    //sql info
    private $fighter = "<tr><td><H1>Fighters</H1></td></tr>";
    private $defender = "<tr><td><H1>Defenders</H1></td></tr>";
    private $useless = "<tr><td><H1>Useless</H1></td></tr>";
    private $sqlinfo;
    private $query_base = "SELECT prod_id, prod_name, prod_descrip, prod_filename FROM product ";
    private $showbots = "";

    function __construct(){
        $this->sqlinfo = new sqlcreds();
    }

    function query_db($category){
        $result = null;
        mysql_connect( $this->sqlinfo->server, $this->sqlinfo->username, $this->sqlinfo->password);
        mysql_select_db($this->sqlinfo->database);
        if($category == "F"){
            //Get fighters
            $result = mysql_query($this->query_base . "WHERE prod_category = 'F'");
            $this->showbots .= $this->fighter . $this->get_bots($result);
        }
        if($category == "U"){
            //Get Useless
            $result = mysql_query($this->query_base . 'WHERE prod_category = "U"');
            $this->showbots .= $this->useless . $this->get_bots($result);
        }
        if($category == "D"){
            //Get Defenders
            $result = mysql_query($this->query_base . 'WHERE prod_category = "D"');
            $this->showbots .= $this->defender . $this->get_bots($result);
        }
        if($category == "ALL"){
            $result = mysql_query("SELECT prod_id, prod_name FROM product");
            $this->showbots = "";
            $this->showbots .= $this->list_bots($result);
        }
    }

    function get_bots($result){
        $category_list = "";
        while( $returned_row = mysql_fetch_row( $result ))
        {
            $category_list .= '<tr>
                    <td align="center"><img src="./images/robots/' . $returned_row[3] . '" height="100px" width="100px"> </td>
                    <td>
                        <h2>' . $returned_row[1] . '</h2>
                        <p>' . $returned_row[2] . '</p>
                        <a class="bot-link" href="./product_detail.php?prod_id=' . $returned_row[0] . '"align="right">More Info</a>
                    </td>
                </tr>';
        }
        return $category_list;
    }

    function get_list(){
        return $this->showbots;
    }

    function list_bots($result){
        $dd_options = "";
        while( $returned_row = mysql_fetch_row( $result)){
            $dd_options .= '<option value="./product_detail.php?prod_id=' . $returned_row[0] .
                '"> ' . $returned_row[1] . '</option>';
        }
        return '<select onchange="location = this.options[this.selectedIndex].value;">' . $dd_options . '</select>';

    }

}
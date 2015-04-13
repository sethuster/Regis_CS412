<?php
/**
 * Created by IntelliJ IDEA.
 * User: SethUrban
 * Date: 4/12/15
 * Time: 8:18 PM
 */

class product_list {
    //sql info
    private $fighter = "<tr><td><H1>Fighters</H1></td></tr>";
    private $defender = "<tr><td><H1>Defenders</H1></td></tr>";
    private $useless = "<tr><td><H1>Useless</H1></td></tr>";
    private $server = "127.0.0.1:3306";
    private $username = "root";
    private $database = "cs482";
    private $query_base = "SELECT prod_name, prod_descrip, prod_filename FROM product ";
    private $showbots = "";

    function __construct(){

    }

    function query_db($category){
        $result = null;
        mysql_connect( $this->server, $this->username);
        mysql_select_db($this->database);
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
    }

    function get_bots($result){
        $category_list = "";
        while( $returned_row = mysql_fetch_row( $result ))
        {
            $category_list .= '<tr>
                    <td align="center"><img src="/images/robots/' . $returned_row[2] . '" height="100px" width="100px"> </td>
                    <td>
                        <h2>' . $returned_row[0] . '</h2>
                        <p>' . $returned_row[1] . '</p>
                        <a class="bot-link" href="./bender_unit.html" align="right">More Info</a>
                    </td>
                </tr>';
        }
        return $category_list;
    }

    function get_list(){
        return $this->showbots;
    }


}
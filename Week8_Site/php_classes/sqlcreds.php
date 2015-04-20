<?php
/**
 * Created by IntelliJ IDEA.
 * User: SethUrban
 * Date: 4/12/15
 * Time: 10:21 PM
 */

class sqlcreds {
    public $server = '';
    public $username = '';
    public $password = '';
    public $database = '';

    function __construct($version = "regis"){
        if($version == "private"){
            $this->server = '127.0.0.1:3306';
            $this->username = 'root';
            $this->database = 'cs482';
        }
        else{
            $this->server = 'localhost:3306';
            $this->username = "laurare2_regis5";
            $this->database = 'laurare2_student5';
            $this->password = '$v*L.;MB{Qzg';
        }
    }

}
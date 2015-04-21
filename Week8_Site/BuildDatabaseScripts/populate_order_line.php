<?php

include "../php_classes/sqlcreds.php";
$sqlinfo = new sqlcreds("private");

mysql_connect($sqlinfo->server, $sqlinfo->username, $sqlinfo->password);
mysql_select_db($sqlinfo->database);

$create_table = "CREATE TABLE order_line (
order_id INT NULL,
product_id INT NULL,
qty_ordered INT NULL,
qty_shipping INT NULL,
unit_price DECIMAL(6,2) NULL,
unit_ship_price DECIMAL(6,2) NULL);";
$bool_result = mysql_query( "DROP TABLE order_line" );
$bool_result = mysql_query( $create_table );

if($bool_result == false){
    die("Unable to create customer table");
}
else{
    echo "Customer Table created";
    $populate_table = 'INSERT into order_line (order_id, product_id, qty_ordered, qty_shipping, unit_price, unit_ship_price) VALUES
(1, 1, 5, 5, 160.00, 300.00);';
    $populate_result = mysql_query( $populate_table );
    if( $populate_result == FALSE){
        die("Unable to populate order_line table");
    }
    else{
        echo "Product table populated.";
    }
}
$test_prod = mysql_query("SELECT * FROM order_line");
$counter = 0;
while( $returned_row = mysql_fetch_row( $test_prod ))
{
    $counter++;
    echo "<p><strong>$counter.</strong> $returned_row[1]</p>";

}




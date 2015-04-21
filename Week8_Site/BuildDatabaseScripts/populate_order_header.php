<?php

include "../php_classes/sqlcreds.php";
$sqlinfo = new sqlcreds("private");

mysql_connect($sqlinfo->server, $sqlinfo->username, $sqlinfo->password);
mysql_select_db($sqlinfo->database);

$create_table = "CREATE TABLE order_header (
order_id INT NOT NULL AUTO_INCREMENT,
customer_id INT NULL,
order_date VARCHAR(25) NULL,
method_of_payment VARCHAR(30) NULL,
payment_number VARCHAR (20) NULL,
expire_month VARCHAR (10) NULL,
expire_year VARCHAR (10) NULL,
shipping_method VARCHAR (20) NULL,
shipping_type VARCHAR (20) NULL,
billto_first_name VARCHAR (25) NULL,
billto_last_name VARCHAR (25) NULL,
billto_address_1 VARCHAR (50) NULL,
billto_address_2 VARCHAR (50) NULL,
billto_city VARCHAR (25) NULL,
billto_region VARCHAR (25) NULL,
billto_postal_code VARCHAR (25) NULL,
shipto_first_name VARCHAR (25) NULL,
shipto_last_name VARCHAR (25) NULL,
shipto_address_1 VARCHAR (50) NULL,
shipto_address_2 VARCHAR (50) NULL,
shipto_city VARCHAR (25) NULL,
shipto_region VARCHAR (25) NULL,
shipto_postal_code VARCHAR (25) NULL,
estimated_delivery_date VARCHAR (20),
PRIMARY KEY (order_id));";
$bool_result = mysql_query( "DROP TABLE order_header" );
$bool_result = mysql_query( $create_table );

if($bool_result == false){
    die("Unable to create customer table");
}
else{
    echo "Customer Table created";
    $populate_table = 'INSERT into order_header (customer_id, order_date, method_of_payment, payment_number, expire_month, expire_year, shipping_method, shipping_type, billto_first_name, billto_last_name, billto_address_1, billto_address_2, billto_city, billto_region, billto_postal_code, shipto_first_name,
shipto_last_name, shipto_address_1, shipto_address_2, shipto_city, shipto_region, shipto_postal_code, estimated_delivery_date) VALUES
(-1, "01/01/1900", "MasterCard", "4444123412341234", "01", "1900", "FedEx", "Ground", "Test BILL FN", "Test BILL LN", "123 Fake st", "unit test", "Testoloplis", "Testarado", "90210", "Test SHIP FN",
"Test SHIP LN", "312 Fake st", "test unit", "Testopolis", "Testarado", "90210", "01/02/1900");';

    $populate_result = mysql_query( $populate_table );
    if( $populate_result == FALSE){
        die("Unable to populate order_header table");
    }
    else{
        echo "Product table populated.";
    }
}
$test_prod = mysql_query("SELECT * FROM order_header");
$counter = 0;
while( $returned_row = mysql_fetch_row( $test_prod ))
{
    $counter++;
    echo "<p><strong>$counter.</strong> $returned_row[1]</p>";

}




<?php

include "sqlcreds.php";
$sqlinfo = new sqlcreds("private");

mysql_connect($sqlinfo->server, $sqlinfo->username, $sqlinfo->password);
mysql_select_db($sqlinfo->database);

$create_table = "CREATE TABLE customer (
customer_id INT NOT NULL AUTO_INCREMENT,
first_name VARCHAR(25) NULL,
last_name VARCHAR(25) NULL,
shipping_address_1 VARCHAR(50) NULL,
shipping_address_2 VARCHAR (50) NULL,
shipping_city VARCHAR (25) NULL,
shipping_region VARCHAR (25) NULL,
shipping_postal_code VARCHAR (25) NULL,
billing_address_1 VARCHAR (50) NULL,
billing_address_2 VARCHAR (50) NULL,
billing_city VARCHAR (25) NULL,
billing_region VARCHAR (25) NULL,
billing_postal_code VARCHAR (25) NULL,
password VARCHAR (50) NULL,
email_address VARCHAR (50) NULL,
home_phone VARCHAR (25) NULL,
business_phone VARCHAR (25) NULL,
mobile_phone VARCHAR (25) NULL,
PRIMARY KEY (customer_id));";

$bool_result = mysql_query( $create_table );

if($bool_result == false){
    die("Unable to create customer table");
}
else{
    echo "Customer Table created";
    $populate_table = 'INSERT into customer (first_name, last_name, shipping_address_1, shipping_address_2, shipping_city, shipping_region, shipping_postal_code, billing_address_1, billing_address_2, billing_city, billing_region, billing_postal_code,
 password, email_address, home_phone, business_phone, mobile_phone) VALUES
 ("Seth", "Urban", "123 Shipp Ct", "Unit A", "Denver", "Colorado", "80123", "321 Bill Dr", "Unit 1", "Aspen", "Colorado", "80122", "password1", "urban123@regis.edu", "3031112222", "3032223333", "3033334444"),
 ("Philip", "Fry", "02 W 57th Street", "", "New New York", "New York", "01182", "02 W 57th Street", "New New York", "New York", "01182", "password2", "philipfry@planetexpress.com", "54711122222", "5472223333", "5473334444")';

    $populate_result = mysql_query( $populate_table );
    if( $populate_result == FALSE){
        die("Unable to populate product table");
    }
    else{
        echo "Product table populated.";
    }
}
$test_prod = mysql_query("SELECT * FROM customer");
$counter = 0;
while( $returned_row = mysql_fetch_row( $test_prod ))
{
    $counter++;
    echo "<p><strong>$counter.</strong> $returned_row[1]</p>";

}




<?php

# Establish a connection to the database
$server   = "127.0.0.1:3306";
$username = "root";
mysql_connect( $server, $username );


# Select the schema in the database
$database = "cs482";
mysql_select_db( $database );

# Execute a query
$query    = "SELECT * FROM product";
$bool_result = mysql_query( $query );

# If the query failed, then stop processing the PHP script
if ( $bool_result == FALSE )
{
    die( "The query against the table product table failed." );
}

# If the query succeeded, retrieve all rows of the first column.
$counter = 0;
while( $returned_row = mysql_fetch_row( $bool_result ))
{
    $counter++;
    echo "<p><strong>$counter.</strong> $returned_row[1]</p>";

}

?>
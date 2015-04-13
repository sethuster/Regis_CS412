<?php
include "sqlcreds.php";

$sqlinfo = new sqlcreds("private");
# Establish a connection to the database
#$server   = "localhost:3306";
#$username = "laurare2_student5";
#$password = '$v*L.;MB{Qzg';
mysql_connect( $sqlinfo->server, $sqlinfo->username, $sqlinfo->password );


# Select the schema in the database
$database = "cs482";
mysql_select_db( $sqlinfo->database );

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
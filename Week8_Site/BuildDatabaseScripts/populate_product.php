<?php
include "../php_classes/sqlcreds.php";

$sqlinfo = new sqlcreds("private");
# Establish a connection to the database
#$server   = "localhost:3306";
#$username = "laurare2_student5";
#$password = '$v*L.;MB{Qzg';
mysql_connect( $sqlinfo->server, $sqlinfo->username, $sqlinfo->password );


# Select the schema in the database
mysql_select_db( $sqlinfo->database );

# Execute a query
$create_table    = "CREATE TABLE product (
  prod_id INT NOT NULL AUTO_INCREMENT,
  prod_name VARCHAR(24) NULL,
  prod_descrip VARCHAR(2000) NULL,
  prod_category VARCHAR(1) NULL,
  prod_cost DECIMAL(6,2) NULL,
  prod_qty_on_hand INT NULL,
  prod_ship_cost DECIMAL(6,2) NULL,
  prod_ship_weight DECIMAL(6,2) NULL,
  prod_filename VARCHAR(40) NULL,
  prod_demo VARCHAR(100) NULL,
  PRIMARY KEY (prod_id));";
$bool_result = mysql_query( "DROP TABLE product" );
$bool_result = mysql_query( $create_table );

# If the query failed, then stop processing the PHP script
if ( $bool_result == FALSE )
{
    die( "Unable to create product table." );
}
else{
    echo "Product table created";
    $populate_table = 'insert into product ( prod_name, prod_descrip, prod_category, prod_cost, prod_qty_on_hand, prod_ship_cost, prod_ship_weight, prod_filename, prod_demo) values
    ("Bending Unit", "This is the classic bening unit. Not only does it bend things to various degrees, it also goes on literal benders. Its powercells are fuel by alcohol. So you will need to make sure that you have plenty of booze in stock. Also keep in mind that the unit is emmits larges amounts of carbon dioxide and methan. It would be wise to keep it away from children.Warning: The unit sometimes can not get up if it falls directly on its back.", "F", 160.00, 10, 300.00, 75.0, "bending_unit.jpg", "https://www.youtube.com/embed/U3RjP6_TV0E"),
    ("Acting Unit", "<p>This is the quintisential Acting unit.  All other acting bots are nothing compared to this bot. Just ask the famed directors and producers that this unit has worked with:</p><ul><li>Directing Unit #14</li><li>Procuing Unit #2</li><li>Casting Unit #1138</li><li>Michael Bay</li></ul>", "U", 170.00, 10, 300.00, 75.0, "Calculon_unit.png", "https://www.youtube.com/embed/AqZlG5r4zXI"),
    ("Clamping Unit", "Hey Clamps, why dont you give this guy the clamps? Oh, you mean do the thing that I think about all the time? What a brilliant idea. Yeah this unit, like the stabbing unit, will try and clamp you. Thats what you get when you order a battle bot from the robot mafia.", "F", 180.00, 10, 300.00, 75.0, "clamping_unit.jpg", "https://www.youtube.com/embed/qf8_tn7lBIc"),
    ("Devil Unit", "The devil unit destroys its enemies with tricky deals and shaddy negotiations. You may think you beat the devil unit by trading your hands for its hands so you can play the Holophoner better, but be careful. The devil unit will defeat its enemies one way or another. Say for example executing a long list of trades to get your favorite person to give up her ears so she can listen to your Holophoner concert. Then tricking you to give him his robot hands back or hell marry your crush. It has only happened once before but it could happen again,", "F", 190.00, 10, 300.00, 75.0, "devil_unit.jpg", "https://www.youtube.com/embed/sFBhR4QcBtE"),
    ("Hedonism Unit", "The Hedonism bot is only concerned with one thing: himself. Well that and robot orgies. What is more hedonistic than participating in robot orgies you say? Well eating grapes with one arm while gesturing with the other. Thats right, this defeats it enemies with hedonism. Also voilence. Those grape eating arms are very powerful so watch out!", "D", 200.00, 10, 300.00, 75.0, "hedonism_unit.jpg", "https://www.youtube.com/embed/gt4Pfhd02w0"),
    ("Kwanzaa Unit", "This is the perfect Kwanzaa Bot.  It helps destroy your enemies, especially if your enemies are the X-Mas unit and Passover Unit (Comming soon!).  Do not make Kwanzaa bot angry", "F", 210.00, 10, 300.00, 75.0, "kwanzaa_unit.png", ""),
    ("Lucy Liu Unit", "Once only available on kidnapster.com, the Lucy Liu bot is now available here.  Purchase the Liu bot for memories that will last a lifetime - just don not delete her memory.", "F", 210.00, 10, 300.00, 75.0, "Lucyliu_unit.gif", ""),
    ("Mafia Unit", "The mafia bot is the king of the robot underworld.  It works best with Thug Unit and Clamps.  ", "F", 220.00, 10, 300.00, 75.0, "mafia_unit.png", "https://www.youtube.com/embed/EXXiWgw9K9k"),
    ("Nixon Unit", "Evil Robot Nixon.  As if Nixon in his corporeal form was not bad enough.  Now he has a shiney new robot body.  His head is also interchangeable.", "F", 230.00, 10, 300.00, 75.0, "nixon_unit.png", "https://www.youtube.com/embed/_t8hpEKb4gk"),
    ("Orphan Unit", "Pick this robot for all your orphanarium needs.  It will beg for gruel, and sleep and shelter.  Its pretty useless, You raised my hopes and dashed them most expertly sir.", "U", 230.00, 10, 300.00, 75.0, "orphan_unit.png", ""),
    ("Police Unit", "This is the police robot to end all robots.  Make sure you have plenty of donuts and coffee.  This unit will win any fight.", "U", 240.00, 10, 300.00, 75.0, "police_unit.png", "https://www.youtube.com/embed/-nt07hdOsaE"),
    ("Preacher Unit", "This is the enemy of the Devil Unit.  Although preaching doesn not do very much.  It is fun to watch him fight against the devil unit", "D", 250.00, 10, 300.00, 75.0, "preacher_unit.gif", ""),
    ("Santa Unit", "You DARE bribe Santa?! Im gonna shove coal so far up your stocking, youll be coughing up diamonds! Every year on Xmas Eve, Santa comes to Earth on his robot-reindeer sleigh to punish the naughty with extreme prejudice.  ", "F", 220.00, 10, 300.00, 75.0, "Santa_unit.png", "https://www.youtube.com/embed/KBpxbF1lqmI"),
    ("Stabbing Unit", "Heya, Heya Ya! This is the stabbing unit. He will try and stab you when you unpackage him. Do not fall for his tricks. This is the robot that cases a joint and then robs it a little. His robbery was really only a cover for casing the joint and then robbing it a lot later. He is very very stabby. ", "F", 220.00, 10, 300.00, 75.0, "stabbing_unit.png", "https://www.youtube.com/embed/AboBRvj_8MI"),
    ("Thug Unit", "Goes great with Mafia Unit and Clamps!", "F", 220.00, 10, 300.00, 75.0, "thug_unit.png", "")';

    $populate_result = mysql_query( $populate_table );
    if( $populate_result == FALSE){
        die("Unable to populate product table");
    }
    else{
        echo "Product table populated.";
    }
}

$test_prod = mysql_query("SELECT * FROM product");

# If the query succeeded, retrieve all rows of the first column.
$counter = 0;
while( $returned_row = mysql_fetch_row( $test_prod ))
{
    $counter++;
    echo "<p><strong>$counter.</strong> $returned_row[1]</p>";

}

?>
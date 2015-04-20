<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>Seth's Electronics</title>
    <link rel="stylesheet" type="text/css" href="./main_style.css">
</head>
<body>
<table style="width:100%" >
    <table id="page_header" height="100px" width="85%" align="left">
        <td>
            <img src="./images/sethselec_logo.png" height="80px">
        </td>
    </table>
    <table id="spacer_header" height="100px" width="15%" align="right"></table>
    <table id="menu_container" align="left" height="100%" width="15%">
        <td width="100%" valign="top">
        <table id="menu_leftnav"  height="100%" width="100%" >
            <nav>
                <ul class="menu">
                    <li><a href="homePage.php">Home</a> </li>
                    <li><a href="./battle_bots.php">Battle Bots</a></li>
                    <li><a href="./aboutus.html">About Us</a></li>
                </ul>
            </nav>
        </table>
        <td>
    </table>
    <table id="content_body" align="left" height="100%"  width="69%" >
        <td valign="top">
            <?php include("./php_classes/product_list.php");
                $list = new product_list();
                $list->query_db("D");
                $list->query_db("F");
                $list->query_db("U");
                echo $list->get_list();
            ?>
        </td>
    </table>
    <table id="spacer_content" width="15%" height="100%" ></table>
    <table id="footer" align="center" valign="bottom" height="15%" width="100%">
        <td valign="bottom" align="center">
            <p>Send mail: <a href="mailto:urban123@regis.edu?Subject=Your%20is%20bad%20and%20you%20should%20feel%20bad" target="_top">webmaster@ramabots.com</a>
                Contact Us: 1-800-Ramabots</p>
        </td>
    </table>

</table>

</body>
</html>
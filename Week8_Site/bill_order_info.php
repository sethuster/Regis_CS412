<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>Seth's Electronics</title>
    <link rel="stylesheet" type="text/css" href="main_style.css">
    <script type="text/javascript" src="order.js"></script>
    <?php include("./php_classes/product_list.php");
    $list = new product_list();
    $list->query_db("ORDER");?>
</head>
<body>
<table style="width:100%" >
    <table id="page_header" height="100px" width="85%" align="left">
        <td>
            <img src="images/sethselec_logo.png" height="80px">
        </td>
    </table>
    <table id="spacer_header" height="100px" width="15%" align="right"></table>
    <table id="menu_container" align="left" height="1200px" width="15%">
        <td width="100%" valign="top">
        <table id="menu_leftnav"  height="600px" width="100%" >
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
        <tr valign="top" height="5%">
            <td><h2>Order Information</h2>
                <p id="order_err"></p>
            </td>
        </tr>
        <form method="post" name= "orderform" onsubmit="return checkOrder(this.form)" action="bill_billing_info.php">
        <tr valign="top"  height="90%">
            <td>
                <table id="product_list" width="100%">
                <?php
                    echo $list->get_list();
                ?>
                </table>
            </td>
        </tr>
        <tr id="linker_info" valign="bottom" height="5%">
            <td align="right"><input id="orderbtn" class="bot-link" type="submit" name="submit" value="Order Now"></td>
        </tr>
        </form>
    </table>
    <table id="spacer_content" width="15%" height="1200px" ></table>
    <table id="footer" align="center" valign="bottom" height="15%" width="100%">
        <td valign="bottom" align="center">
            <p>Send mail: <a href="mailto:urban123@regis.edu?Subject=Your%20is%20bad%20and%20you%20should%20feel%20bad" target="_top">webmaster@ramabots.com</a>
                Contact Us: 1-800-Ramabots</p>
        </td>
    </table>

</table>

</body>
</html>
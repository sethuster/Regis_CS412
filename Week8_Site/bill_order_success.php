<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>Seth's Electronics</title>
    <link rel="stylesheet" type="text/css" href="main_style.css">
    <?php include_once("./php_classes/orders.php");
        $order = new orders();

    ?>
</head>
<body>
<table style="width:100%" >
    <table id="page_header" height="100px" width="85%" align="left">
        <td>
            <img src="images/sethselec_logo.png" height="80px">
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
       <tr>
           <td align="center" valign="top" >
               <h1>Order Successful!</h1>
               <h2></h2>
               <h2>Please give us some time to send out your new battle bot!</h2>
               <h3>Thanks for Shopping at S-Mart.  Shop Smart.  Shop S-Mart.</h3>
           </td>
       </tr>
    </table>
    <table id="content_body" align="center" height="100%" width="69%">
        <tr align="center" valign="top">
            <td align="left" width="50%"><p><b>Items Ordered</b></p></td>
            <td align="center" width="10%"><p><b>QTY Ordered</b></p></td>
            <td align="center" width="10%"><p><b>QTY Shipped</b></p></td>
            <td align="right" width="30%"><p><b>Item Total</b></p></td>
        </tr>
        <?php echo $order->create_order($_GET['orderid']);?>
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
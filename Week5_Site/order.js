//Order info functions
function checkOrder(form){
    //this function will be used to verify input on the bill_order_info form
    var wegood = true;
    qtys = document.getElementsByTagName('input');
    for (i = 0; i < qtys.length; i++){
        if(qtys[i].value)
        {
            qtys[i].style.backgroundColor = "#FFFFFF";
            if((isNaN(qtys[i].value)) && (qtys[i].value != "Order Now"))
            {
                wegood = false;
                qtys[i].style.backgroundColor = "#FF9999";
            }
        }
    }
    document.getElementById('orderbtn').style.backgroundColor = "#99CCFF";
    return wegood;
}

//Billing info functions
function setShipping(value){
    if(value == "parcel")
    {
        var sixweeks = 1000 * 60 * 60 * 24 * 42;
        var sixweekstime = new Date(new Date().getTime() + sixweeks);
        document.getElementById("today").innerHTML = "<b>Estimated Delivery:</b> " + sixweekstime.toDateString();
    }
    if(value == "regular"){
        var fourdays = 1000 * 60 * 60 * 24 * 4;
        var fourdaystime = new Date(new Date().getTime() + fourdays);
        document.getElementById("today").innerHTML = "<b>Estimated Delivery:</b> " + fourdaystime.toDateString();
    }
    if(value == "express"){
        var fourdays = 1000 * 60 * 60 * 24 * 1;
        var fourdaystime = new Date(new Date().getTime() + fourdays);
        document.getElementById("today").innerHTML = "<b>Estimated Delivery:</b> " + fourdaystime.toDateString();
    }
}

function setToday(){
    document.getElementById("today").innerHTML = "<b>Today:</b> " + new Date().toDateString();;
}

function setShippingInfo(form){
    form.cust_ship_first_name.value = form.cust_first_name.value;
    form.cust_ship_middle_name.value = form.cust_middle_name.value;
    form.cust_ship_last_name.value = form.cust_last_name.value;
    form.cust_ship_address1.value = form.cust_address1.value;
    form.cust_ship_address2.value = form.cust_address2.value;
    form.cust_ship_city.value = form.cust_city.value;
    form.cust_ship_state.value = form.cust_state.value;
    form.cust_ship_zip.value = form.cust_zip.value;
}

function clearshipping(form){
     form.cust_ship_first_name.value = "";
        form.cust_ship_middle_name.value = "";
        form.cust_ship_last_name.value = "";
        form.cust_ship_address1.value = "";
        form.cust_ship_address2.value = "";
        form.cust_ship_city.value = "";
        form.cust_ship_state.value = "";
        form.cust_ship_zip.value = "";
}
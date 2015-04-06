//Order info functions
function checkOrder(form){
    //this function will be used to verify input on the bill_order_info form
    var wegood = true;
    var qty = 0;
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
            else
            {
                if(!isNaN(qtys[i].value))
                {
                    qty += parseInt(qtys[i].value);
                }
            }

        }
    }
    document.getElementById('orderbtn').style.backgroundColor = "#99CCFF";
    if(qty == 0)
    {
        wegood = false;
        document.getElementById("order_err").innerHTML = "<b> You must order at least 1 item </b>"
        document.getElementById("order_err").style.color = "red";
    }
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
    setShipping("parcel");
}

function setShippingInfo(form){
    form.ship_first_name.value = form.cust_first_name.value;
    form.ship_middle_name.value = form.cust_middle_name.value;
    form.ship_last_name.value = form.cust_last_name.value;
    form.ship_address1.value = form.cust_address1.value;
    form.ship_address2.value = form.cust_address2.value;
    form.ship_city.value = form.cust_city.value;
    form.ship_state.value = form.cust_state.value;
    form.ship_zip.value = form.cust_zip.value;
}

function clearshipping(form){
    form.ship_first_name.value = "";
    form.ship_middle_name.value = "";
    form.ship_last_name.value = "";
    form.ship_address1.value = "";
    form.ship_address2.value = "";
    form.ship_city.value = "";
    form.ship_state.value = "";
    form.ship_zip.value = "";
}

function validateForm(form){
    var validForm = false;
    var valid_ci = true;
    var valid_cc = true;
    var cc_num = document.getElementById("cc_num");
    var cc_type = document.getElementById("cc_type");
    var ci_info = document.getElementsByClassName("ci_info");
    clearErrors();
    for(i = 0; i < ci_info.length; i++){
        if((ci_info[i].name.indexOf("address2") == -1)&&(ci_info[i].name.indexOf("middle") == -1)){
            if(!ci_info[i].value){
                //true if these fields are blank
                valid_ci = false;
                setErrors(ci_info[i], "Field is blank!");
            }
        }

        if((ci_info[i].name.indexOf("zip") > -1)||(ci_info[i].name.indexOf("cc") > -1)){
            if(isNaN(ci_info[i].value)){
                //true if text is in this field
                valid_ci = false;
                setErrors(ci_info[i], "Field is not a number!");
            }
        }
    }
    if(cc_type.value == "American_Express")
    {
        if((cc_num.value.length > 15)||(cc_num.value.length < 15))
        {
            setErrors(cc_num, "American Express Needs 15 digits!");
            valid_cc = false;
        }
        if((cc_num.value[0] != 3)||(cc_num.value[1] != 7))
        {
            setErrors(cc_num, "American Express Cards start with 37!");
            valid_cc = false;
        }
    }
    if((cc_type.value == "Mastercard")||(cc_type.value == "Visa")||(cc_type.value == "Discover"))
    {
        if((cc_num.value.length > 16)||(cc_num.value.length < 16))
        {
            setErrors(cc_num, "Not enough Digits");
            valid_cc = false;
        }
    }
    if(cc_type.value == "Mastercard")
    {
        if(cc_num.value[0] != 5)
        {
            setErrors(cc_num, "Mastercards Start with 5!");
            valid_cc = false;
        }
    }
    if(cc_type.value == "Visa")
    {
        if(cc_num.value[0] != 4)
        {
            setErrors(cc_num, "Visas Start with 4!");
            valid_cc = false;
        }
    }
    if(cc_type.value == "Discover")
    {
        if(cc_num.value[0] != 6)
        {
            setErrors(cc_num, "Discover Cards Start with 6!");
            valid_cc = false;
        }
    }

    if((valid_ci == true)&&(valid_cc == true)){
        validForm = true;
    }
    return validForm;
}

function setErrors(element, message){
    element.style.backgroundColor = "#FF9999";
    error_text = "<b>There is a problem with " + element.name + ": " + message + "</b>";
    if (element.name.indexOf("ship") > -1){
        var ship_err = document.getElementById("ship_info_err");
        ship_err.innerHTML = error_text;
        ship_err.style.color = "red";
    }
    if (element.name.indexOf("cust") > -1){
        var cust_err = document.getElementById("cust_info_err");
        cust_err.innerHTML = error_text;
        cust_err.style.color = "red";
    }
    if (element.name.indexOf("Credit Card") > -1){
        var cust_err = document.getElementById("cc_info_err");
        cust_err.innerHTML = error_text;
        cust_err.style.color = "red";
    }
}

function clearErrors(){
    var errors = document.getElementsByClassName("error");
    for(i = 0; i < errors.length; i++){
        errors[i].innerHTML = "";
    }
    var infos = document.getElementsByClassName("ci_info");
    for(i = 0; i < infos.length; i++){
        infos[i].style.backgroundColor = "#FFFFFF";
    }
}
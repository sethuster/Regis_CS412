//Order info functions
function checkOrder(form){
    //this function will be used to verify input on the bill_order_info form
    var wegood = true;
    var qty = 0;
    qtys = document.getElementsByTagName('input');
    for (i = 0; i < qtys.length; i++){
        if(qtys[i].value) //check if there is a value
        {
            qtys[i].style.backgroundColor = "#FFFFFF";  //reset the error status
            if((isNaN(qtys[i].value)) && (qtys[i].value != "Order Now"))//check that the field is a number - not the order button
            {
                wegood = false; //If NaN is true it's not a number
                qtys[i].style.backgroundColor = "#FF9999"; //set the field error color
            }
            else
            {
                if(!isNaN(qtys[i].value))//make sure it's a number again
                {
                    qty += parseInt(qtys[i].value); //check to add the qty
                }
            }

        }
    }
    document.getElementById('orderbtn').style.backgroundColor = "#99CCFF"; //reset the order button background = there's better way to do this for sure
    if(qty == 0) //throw error if the qtys of all the items is zero
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
        var sixweeks = 1000 * 60 * 60 * 24 * 42; //6 weeks = 42 days
        var sixweekstime = new Date(new Date().getTime() + sixweeks);
        document.getElementById("today").innerHTML = "<b>Estimated Delivery:</b> " + sixweekstime.toDateString();
    }
    if(value == "regular"){ //4 days
        var fourdays = 1000 * 60 * 60 * 24 * 4;
        var fourdaystime = new Date(new Date().getTime() + fourdays);
        document.getElementById("today").innerHTML = "<b>Estimated Delivery:</b> " + fourdaystime.toDateString();
    }
    if(value == "express"){
        var oneday = 1000 * 60 * 60 * 24 * 1; //1 days
        var onedaystime = new Date(new Date().getTime() + oneday);
        document.getElementById("today").innerHTML = "<b>Estimated Delivery:</b> " + onedaystime.toDateString();
    }
}

function setToday(){
    setShipping("parcel");
}

function setShippingInfo(form){ //set the shipping info from billing info
    form.ship_first_name.value = form.cust_first_name.value;
    form.ship_middle_name.value = form.cust_middle_name.value;
    form.ship_last_name.value = form.cust_last_name.value;
    form.ship_address1.value = form.cust_address1.value;
    form.ship_address2.value = form.cust_address2.value;
    form.ship_city.value = form.cust_city.value;
    form.ship_state.value = form.cust_state.value;
    form.ship_zip.value = form.cust_zip.value;
}

function clearshipping(form){ //set shipping info back to blanks
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
    var validForm = false; //default form is false
    var valid_ci = true;
    var valid_cc = true;
    var cc_num = document.getElementById("cc_num");
    var cc_type = document.getElementById("cc_type");
    var cvc_code = document.getElementById("cvc_code");
    var ci_info = document.getElementsByClassName("ci_info");
    var cyear = new Date().getFullYear();
    var cmonth = new Date().getMonth();
    clearErrors();
    for(i = 0; i < ci_info.length; i++){
        //check to make sure that the required fields are not blank - middle initial and address2 are not required.
        if((ci_info[i].name.indexOf("address2") == -1)&&(ci_info[i].name.indexOf("middle") == -1)){
            if(!ci_info[i].value){
                //true if these fields are blank
                valid_ci = false;
                setErrors(ci_info[i], "Field is blank!");
            }
        }
        //check to make sure that the zip code and cc number fields are numbers
        if((ci_info[i].name.indexOf("zip") > -1)||(ci_info[i].name.indexOf("Credit Card") > -1)){
            if(isNaN(ci_info[i].value)){
                //true if text is in this field
                valid_ci = false;
                setErrors(ci_info[i], "Field is not a number!");
            }
        }
    }
    //special check for amex
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
        if(cvc_code.value.length < 4){
            setErrors(cvc_code, "American Express Cards have a 4 digit CCV code");
            valid_cc = false;
        }
    }
    //check cc num length for non-amex
    if((cc_type.value == "Mastercard")||(cc_type.value == "Visa")||(cc_type.value == "Discover"))
    {
        if((cc_num.value.length > 16)||(cc_num.value.length < 16))
        {
            setErrors(cc_num, "Not enough Digits");
            valid_cc = false;
        }
        if(cvc_code.value.length < 3 || cvc_code.value.length > 3)
        {
            setErrors(cvc_code, "Your Credit Card has a 3 digit CCV code");
        }
    }
    //check mastercards start with 5
    if(cc_type.value == "Mastercard")
    {
        if(cc_num.value[0] != 5)
        {
            setErrors(cc_num, "Mastercards Start with 5!");
            valid_cc = false;
        }
    }
    //check visas start with 4
    if(cc_type.value == "Visa")
    {
        if(cc_num.value[0] != 4)
        {
            setErrors(cc_num, "Visas Start with 4!");
            valid_cc = false;
        }
    }
    //check discovers start with 6
    if(cc_type.value == "Discover")
    {
        if(cc_num.value[0] != 6)
        {
            setErrors(cc_num, "Discover Cards Start with 6!");
            valid_cc = false;
        }
    }
    //check that the cc expiration date is at least the current month of the current year
    if((cc_year.value < cyear)||(cc_month.value < cmonth))
    {
        cc_info_err.innerHTML = "<b> Your Credit Card is expired.</b>";
        cc_info_err.style.color = "red";
        valid_cc = false;
    }
    //check that both peices of the form validate
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
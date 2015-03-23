var products = [];
var prices = [];

function get_products(){
    init_prods();
    var num_prods = -1;
    var ordered_pids = [];
    var quantities = [];

    while(num_prods != 0){
        var prod_num = prompt("Enter Product number (1-5) (0 to stop):");
        //Should Check to make sure the input is a number
        if((prod_num != 0) && (prod_num < 6))
        {
            ordered_pids.push(prod_num) //push onto an array
            var quantity = prompt("Enter a quantity sold today: ");
            quantities.push(quantity)
        }
        else
        {
            write_out(ordered_pids, quantities);
            num_prods = 0;
        }
    }
}

function init_prods(){
    products[0] = "Bending Unit";
    prices[0] = 2.98;
    products[1] = "Acting Unit";
    prices[1] = 4.50;
    products[2] = "Devil Unit";
    prices[2] = 9.98;
    products[3] = "Hedonism Unit";
    prices[3] = 4.49;
    products[4] = "X-Mas Unit";
    prices[4] = 6.87;
}

function write_out(ordered_pids, quantities){
    var totals = []
    var grandtotal = 0;
    document.write("<h2>Product Orders</h2>");
    document.write('<table border="1" cellspacing="1" cellpadding="5">');
    document.write('<tr><td> <b>Product Name</b> </td><td><b>Total Sales</b></td></tr>')
    for(i = 0; i < ordered_pids.length; i++){
        product = products[ordered_pids[i]-1]; //get the product zero-based index
        price = prices[ordered_pids[i] -1]; //get the price for the product
        total = price * quantities[i]; //get the quanity ordered
        totals.push(total)
        document.write('<tr><td>'+ product + '</td><td> $' + total.toFixed(2) + '</td></tr>')
    }
    for(i = 0; i < totals.length; i++){
        grandtotal += totals[i];
    }
    document.write('<tr><td><b>Grand Total:</b></td><td><b> $' + grandtotal.toFixed(2) + '</b></td></tr>')
    document.write('</table>');
}


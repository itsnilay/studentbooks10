<?php
/* 
 * This page displays the contents of the shopping cart
 * This page also lets the user update the contents of the cart
 */

//set the page title and include the header
$page_special= 'SpindleTree | View Your Shopping Cart';
require_once('include/header.php');
    //check to see if form has been submitted(to update the cart)
    if(isset($_POST['submitted'])){
        //change any quantities:
        $updt = 0;
        foreach($_POST['qty'] as $k => $v){

            // skip if quantity is not an integer
            if ($v != "0" && (int)$v == 0)
                continue;

            //must be integers!
            $pid = (int) $k;
            $qty = (int) $v;

            // skip if quantity did not change
            if (($_SESSION['cart'][$pid]['quantity']) == $qty)
                continue;

            if($qty == 0 ){//delete
                unset($_SESSION['cart'][$pid]);
            } elseif ($qty> 0){//change quantity
                $_SESSION['cart'][$pid]['quantity'] = $qty;
            }
            $updt += 1;

        }//end of foreach
        
        if ($updt > 0)
            echo '<p class="info">Your cart has been successfully updated.</p>';

    }//end of submit

    if ($_GET['result']=='addSuccess') {
        echo '<p class="info">A book has been added to your shopping cart.</p>';
    }

    //display the cart if not empty
    if(!empty($_SESSION['cart'])){
        //retrieve all the information for the books in the cart:
        require_once('include/mysql_connect.php');

        $q = "SELECT bookid, title, price, stocknew FROM book WHERE bookid IN (";
	foreach ($_SESSION['cart'] as $pid => $value) {
		$q .= $pid . ' ,';
	}
	$q = substr($q, 0, -1). ')';//$q = substr($q, 0, -1) . ')';
        
	$r = mysqli_query ($dbc, $q);

        //create the form and a table:
        echo '<form action="view_cart.php" method="post">
                <fieldset>
                    <table>
                        <tr>
                            <th>Title</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total Price</th>
                            
                        </tr>
                ';
                        //print each item...
                        $total = 0; //total cost of order
                        
                        while($row = mysqli_fetch_array($r, MYSQLI_ASSOC)){
                            //calculate the total and the subtotals
                            $subtotal = $_SESSION['cart'][$row['bookid']]['quantity']* $_SESSION['cart'][$row['bookid']]['price'];
                            $total +=$subtotal;

                            //print the row //$_SESSION['cart'][$row['bookid']]['price']
                            echo "<tr>
                                        <td><a href='./book_details.php?bkid={$row['bookid']}'>{$row['title']}</a></td>
                                        <td>$"."{$_SESSION['cart'][$row['bookid']]['price']}</td>
                                        <td><input type=\"text\" size=\"3\" name=\"qty[{$row['bookid']}]\" value=\"{$_SESSION['cart'][$row['bookid']]['quantity']}\"/></td>
                                        <td>$".  number_format($subtotal, 2)."</td>
                                        
                                  </tr>";
                        }//end of while loop
                        mysqli_close($dbc);//close database connection
                        
                        //print the footer, close the table, and thr form
                        echo    '<tr>
                                    <td colspan="3"> <b>Total</b></td>
                                    <td>$'.number_format($total, 2).'</td>
                                </tr>
                    </table>

                    <div style="width:50%;float:left;">
                        <h4><a href="./books_listing.php"><u>Click Here</u></a> to continue shopping.</h4>
                    </div>
                    <div style="width=50%;float:right;">
                        <input type="submit" name ="submit" value="Update Cart"/>
                        <input type="button" value="Checkout" onClick="window.location.href=\'checkOut.php\'"/>
                    </div>
                    <div style="width:100%;float:right" align="right">* Enter a quantity of 0 to remove an item.</div>
                    <input type="hidden" name="submitted" value="TRUE"/>                 
               </fieldset>
            </form>';


    }else{//end of if cart not empty
        echo '<p class="info">Your cart is currently empty.</p>
            <img src="" alt="" />';

        echo "<h3><a href='./books_listing.php'><u>Click Here</u></a> to browse our selection.</h3>";
    }
require_once('include/footer.php');

?>
<script language="javascript" type="text/javascript">
function deleteBook() {
 
 alert('Hello World - this is an alert message!');
}
</script>


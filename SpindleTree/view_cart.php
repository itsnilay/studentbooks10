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
        foreach($_POST['qty'] as $k => $v){

            //must be integers!
            $pid = (int) $k;
            $qty = (int) $v;

            if($qty == 0 ){//delete
                unset($_SESSION['cart'][$pid]);
            } elseif ($qty> 0){//change quantity
                $_SESSION['cart'][$pid]['quantity'] = $qty;
            }
        }//end of foreach

    }//end of submit

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
                                        <td>{$row['title']}</td>
                                        <td>${$_SESSION['cart'][$row['bookid']]['price']}</td>
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
                    <div align="center"><input type="submit" name ="submit" value="Update My Cart"/></div>
                    <input type="hidden" name="submitted" value="TRUE"/>                 
               </fieldset>
            </form>
            <p>Enter a quantity of 0 to remove an item.<br/><br/><a href="checkout.php">Check Out</a></p>';
    }else{//end of if cart not empty
        echo '<p>Your cart is currently empty.</p>
            <img src="" alt="" />';
    }
require_once('include/footer.php');

?>
<script language="javascript" type="text/javascript">
function deleteBook() {
 
 alert('Hello World - this is an alert message!');
}
</script>


<?php

require_once ('include/config.php');
$page_title='SpindleTree | Checkout';
include('include/header.php');

//Changes by Nilay to Display Cart contents here
    //display the cart if not empty
    if(!empty($_SESSION['cart']) && !isset($_POST['submitted'])){
        //retrieve all the information for the books in the cart:
        require_once('include/mysql_connect.php');

        $q = "SELECT bookid, title, price, stocknew FROM book WHERE bookid IN (";
	foreach ($_SESSION['cart'] as $pid => $value) {
		$q .= $pid . ' ,';
	}
	$q = substr($q, 0, -1). ')';//$q = substr($q, 0, -1) . ')';

	$r = mysqli_query ($dbc, $q);

        //create the form and a table:
        echo '<form action="view_cart.php?searchbox='.urlencode($_GET['searchbox']).'&p='.urlencode($_GET['p']).'&cid='.urlencode($_GET['cid']).'&cat='.urlencode($_GET['cat']).'&sid='.urlencode($_GET['sid']).'" method="post">
                <fieldset>
                    <h3>My Cart</h3>
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
                                        <td><a href='./book_details.php?sid=".$sid."&bkid={$row['bookid']}'>{$row['title']}</a></td>
                                        <td>$"."{$_SESSION['cart'][$row['bookid']]['price']}</td>
                                        <td><input type=\"text\" size=\"3\" name=\"qty[{$row['bookid']}]\" value=\"{$_SESSION['cart'][$row['bookid']]['quantity']}\" disabled/></td>
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

                        <h4><a href="./view_cart.php?searchbox='.urlencode($_GET['searchbox']).'&p='.urlencode($_GET['p']).'&cid='.urlencode($_GET['cid']).'&cat='.urlencode($_GET['cat']).'&sid='.urlencode($_GET['sid']).'"><u>Click Here</u></a> to change Cart items.</h4>
                    </div>
                 
                    </fieldset>
            </form>';


    }


///////////////////////////////////////////////////////Nilay's changes till here
include ('include/addressform.php');

echo '<h2>Check Out</h2>';

if (isset($_POST['submitted'])){
        require_once(GLOBAL_MYSQL);//connect to database

            //trim all the incoming data:
            $trimmed = array_map('trim', $_POST);

            // TODO: Verify checkout and post order

            mysqli_close($dbc); //close the database

            //ob_end_clean();// delete the existing buffer from header.php

            header('Location: confirmOrder.php?sid='.$sid.'&result=orderSuccess');
            //header('Location: login.php?sid='.$sid.'&result=orderSuccess');
            exit();

}// end of main submit conditional
?>

    <div class = "form_box">
    <form action="checkOut.php" method="post">

            <h3>Billing Address</h3>
            <?php
                if (!isset($trimmed))
                    printAddressForm("bill_",NULL);
                else
                    printAddressForm("bill_",$trimmed);
            ?>
            <hr/>

            <h3>Shipping Address</h3>
            <?php
                if (!isset($trimmed))
                    printAddressForm("ship_",NULL);
                else
                    printAddressForm("ship_",$trimmed);
            ?>
            <hr/>

            <h3>Credit Card Info</h3>
            <?php
                /*  form IDs
                 *  --------
                 *  CC_name    : credit card holder's name (i.e., name on card)
                 *  CC_number  : credit card number (max length 19, all digits [0-9])
                 *  CC_vcode   : CCV2 number (max length 4, all digits [0-9])
                 *  CC_expdate : card expiration date (month [1-12], year [00-99] <last 2 digits>)
                 */
            // TODO: Make CC info form pretty
            ?>
            <p><label for="CC_name" class="label">Name on Card: </label><input id="CC_name" type="text" name="CC_name" size="15" maxlength="80" value="<?php if (isset($trimmed['CC_name'])) echo $trimmed['CC_name']; ?>" /></p>
                <div style="width:55%;float:left;">
                    <label for="CC_number" class="label">Card Number: </label>
                    <input id="CC_number" type="text" name="CC_number" size="19" maxlength="80" value="<?php if (isset($trimmed['CC_number'])) echo $trimmed['CC_number']; ?>" />
                </div>
                <div style="width:45%;float:left;">
                    <label for="CCV2" class="label" style="width:30px;">CCV2: </label>
                    <input id="CC_vcode" type="text" name="CC_vcode" size="5" maxlength="4" value="" />
                </div>
            <?php // TODO: implement CC expiration date as value instead of text
            ?>
            <p><label for="CC_expdate" class="label">Expiration Date: </label><input id="CC_expdate" type="text" name="CC_expdate" size="10" maxlength="20" value="" />
            &nbsp(format: MM/YY)
            </p>

        <p><input type="submit" name="submit" value="Submit" style="position: relative; left: 350px"/></p>
        <input type="hidden" name="sid" value="<?php echo $sid; ?>" />
        <input type="hidden" name="submitted" value="TRUE" />

    </form>
    </div>

 <?php
include('include/footer.php');
?>


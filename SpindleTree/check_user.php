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


echo '<h2></h2>';

if (isset($_POST['submitted'])){
        require_once(GLOBAL_MYSQL);//connect to database

            //trim all the incoming data:
            //$trimmed = array_map('trim', $_POST);

            // TODO: Verify checkout and post order

            mysqli_close($dbc); //close the database

            //ob_end_clean();// delete the existing buffer from header.php
            if($_POST['choice'] == "EUser")
            {
                 header('Location: login.php?sid='.$sid.'&result=orderSuccess');
            }
            else if($_POST['choice'] == "NUser")
            {
                 header('Location: registration.php?sid='.$sid.'&result=orderSuccess');
            }
            else{
            //header('Location: confirmOrder.php?sid='.$sid.'&result=orderSuccess');
            header('Location: checkOut.php?sid='.$sid.'&result=orderSuccess');
            }
            exit();

}// end of main submit conditional
?>

    <div class = "form_box">
    <form action="check_user.php" method="post">

            <h3>I am </h3>
            <input type="radio" name="choice" value="EUser" selected/> Existing User<br />
            <input type="radio" name="choice" value="NUser" /> New User (Once you register, you need not register again at SpindleTree!!)<br/>
            <input type="radio" name="choice" value="GUser" /> Guest User
            <hr/>

        <p><input type="submit" name="submit" value="Submit" style="position: relative; left: 200px"/></p>
        <input type="hidden" name="sid" value="<?php echo $sid; ?>" />
        <input type="hidden" name="submitted" value="TRUE" />

    </form>
    </div>

 <?php
include('include/footer.php');
?>


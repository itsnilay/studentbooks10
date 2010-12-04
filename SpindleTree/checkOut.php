<?php

require_once ('include/config.php');
$page_special='SpindleTree | Checkout';
include('include/header.php');

include ('include/addressform.php');

echo '<h2>Check Out</h2>';

if (isset($_POST['submitted'])){
        require_once(GLOBAL_MYSQL);//connect to database

            //trim all the incoming data:
            $trimmed = array_map('trim', $_POST);

            /* TODO: Verify checkout and post order */

            mysqli_close($dbc); //close the database

            $url = GLOBAL_BASE_URL . 'confirmOrder.php'; //define the URL:
            ob_end_clean();// delete the existing buffer from header.php

            header("Location: $url");
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
            /* TODO: Make CC info form pretty */
            ?>
            <p><label for="CC_name" class="label">Name on Card: </label><input id="CC_name" type="text" name="CC_name" size="15" maxlength="80" value="<?php if (isset($trimmed['CC_name'])) echo $trimmed['CC_name']; ?>" /></p>
	    <p><label for="CC_number" class="label">Card Number: </label><input id="CC_number" type="text" name="CC_number" size="19" maxlength="80" value="<?php if (isset($trimmed['CC_number'])) echo $trimmed['CC_number']; ?>" /></p>
            <p><label for="CCV2" class="label">CCV2: </label><input id="CC_vcode" type="text" name="CC_vcode" size="5" maxlength="4" value="" /> </p>
            <?php /* TODO: implement CC expiration date as value instead of text */ ?>
            <p><label for="CC_expdate" class="label">Expiration Date: </label><input id="CC_expdate" type="text" name="CC_expdate" size="10" maxlength="20" value="" /></p>

        <p><input type="submit" name="submit" value="Submit" /></p>
	<input type="hidden" name="submitted" value="TRUE" />

    </form>
    </div>

 <?php
include('include/footer.php');
?>


<?php
$page_title ='SpindleTree | Checkout';
include('include/header.php');
?>
        <h2>Check Out</h2>
      <!TODO: Address form is begging for a function>
        <!FIXME: reused form id from Sign In page>
        <form id="sign_in" class="span-9">
             <h3>Billing Address</h3>
             <?php include('include/addressform.php'); ?>
             <!FIXME: needs a break>
             <h3>Shipping Address</h3>
             <!FIXME: input id's are not unique (again, really needs a function)>
             <?php include('include/addressform.php'); ?>
			 <a href="confirmOrder.php"><img src="img/submit.JPG" align = "right"></a>
            <!--button type="submit" onclick="index.php">Submit</button-->
        </form>
<?php
include('include/footer.php');
?>
		
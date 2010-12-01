<?php
$page_title ='SpindleTree | Check Out';
include('include/header.php');
?>
    <h2>SpindleTree Checkout</h2>
        <?php $cart->display_cart($jcart);?>
        <p><a href="books_listing.php">&larr; Continue shopping</a></p>
    <script type="text/javascript" src="jcart/jquery-1.3.2.min.js"></script>
    <script type="text/javascript" src="jcart/jcart-javascript.min.php"></script>
<?php
include('include/footer.php');
?>

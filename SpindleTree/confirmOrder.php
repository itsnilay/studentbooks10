<?php
$page_title ='SpindleTree | Order Confirmed';
include('include/header.php');

if (isset($_GET['result']) && $_GET['result'] == 'orderSuccess'){
    echo '<h2>Order Confirmed</h2>';
    echo '<p>Your books will be shipped within 3-5 business days.<br/><br/>Thanks for shopping SpindleTree!</p>';
}else{
    echo '<p class="error">This page has been accessed in error!</p>';
}

include('include/footer.php');
?>

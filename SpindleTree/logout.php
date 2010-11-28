<?php
/*
 *logout.php
 */
require_once('include/config.php');
$page_title = 'Logout';

include('include/header.php');

//if no email session variable exist, redirect the user
if(!isset($_SESSION['email'])){
    $url = GLOBAL_BASE_URL . 'index.php';// define the url
    ob_end_clean();//delete the buffer
    header("Location: $url");
    exit();//quit the script

}else{//log the user out
    $_SESSION = array();//destroy the variables
    session_destroy();//destroy the session itself.
    setcookie(session_name(),'', time()-300);//destroy the cookie
}

//print a customized message:
echo '<h3>You are now logged out.</h3>';

include('include/footer.php');
?>



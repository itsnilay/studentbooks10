<?php 
session_start();//start the session

//if no session value is present, redirect the user

//include the configuration file for error mangement
require_once('include/config.inc.php');

if(!isset($_SESSION['user_id'])){
    require_once('include/login_functions.php');
    $url=absolute_url();
    header("Location: $url");
    exit();
}

$page_title ='Simplytraders | My Account Settings';
include('include/header.php');
?>

<div id="header_title" class="border_1"><h1 id="style_2">Personal Info</h1></div>
 <div id="subnav_header">
       <ul class="sub_nav">
	     <li><a href="my_account.php">Personal Information</a></li>
	     <li><a href="change_password.php">Change Password</a></li>
	     <li><a href="email.php">Email Notifications</a></li>
       </ul>
 </div>

<div class="info_bar">Your personal information.</div>

<?php 
include('include/footer.php');
 ?>	
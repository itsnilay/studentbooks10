<?php #version 1.1 config.inc.php
/* This script:
*- define constants and settings
*- dictates how errors are handled
*- defines useful functions

created by: Jerry Mathurin date: November 8, 2010
*/


// ******************************************* //
// **************** SETTINGS **************** //

// Flag variable for site status
define('GLOBAL_LIVE', FALSE);

//Admin contact address:
define('GLOBAL_EMAIL', 'noreply@spindletree.com');

//site URL (base for all redirections):
define('GLOBAL_BASE_URL', 'http://hci.cs.sfsu.edu/~fall2010.10/');

//location of the MySQL connection script:
define('GLOBAL_MYSQL', 'include/mysql_connect.php');

//Adjust the time zone for PHP 5.1 and greater

date_default_timezone_set('US/Eastern');

// **************** SETTINGS ***************** //
// ******************************************* //

// ************ ERROR MANAGEMENT ************* //
// ******************************************* //

//create the error handler:
function my_error_handler($e_number, $e_message, $e_file, $e_line, $e_vars){
     //build error message
     $message ="<p> An error occured in script '$e_file' on line $e_line: $e_message\n<br/>";
     
     //add the date and time:
     $message .="Date/Time:".date('n-j-Y H:i:s')."\n<br/>";
     
     //Append $e_vars to the message:
     $message .="<pre>".print_r($e_vars,1)."</pre>\n</p>";
     
     if(!GLOBAL_LIVE){//DEVELOPMENT (print the error)
         echo'<div>'.$message.'</div><br/>';
     }else{//don't show the error
          //send an email to admin
	  mail(GLOBAL_EMAIL, 'Site Error!', $message,'From: admin@spindletree.com');
	  
	  //Only print an error message if the error isn't a notice
	  if($e_number != E_NOTICE){
               echo'<div>A system error occured. We apologize for the inconvenience</div><br/>';
	  }
     }//endof !LIVE IF
}//endof my error_handler definition

//use my error handler
set_error_handler('my_error_handler');

// ************ ERROR MANAGEMENT ************* //
// ******************************************* //


?>
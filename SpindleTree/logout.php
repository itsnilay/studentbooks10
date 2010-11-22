<?php  #logout.php version 1.0
//this page logs out the user
 
session_start();//access the existing session

function absolute_url($page = 'index.php'){
    //start defining URL...
    //URL is http:// plus the host name plus the current directory:
    $url='http://'.$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF']);
    
    //Remove any trailing slashes:
    $url = rtrim($url, '/\\');
    
    //add the page:
    $url .= '/' . $page;
    
    //return the url
    return $url; 
    
 }// end of absolute_url function
 
//require_once('include/login_functions.php'); 
 
//if no first_name variable exist, redirect the user
if(!isset($_SESSION['user_id'])){



 
 
$url = absolute_url();	       
header("Location: $url");
exit();//quit the script

}else{//cancel the session
	       $_SESSION = array();//clear the variables
	       session_destroy();//destroy the session itself
	       setcookie('PHPSESSID', '', time()-3600, '/', '', 0,0);//destroy the cookie
	       
	       //redirect user to index page
               $url = absolute_url();	
	       header("Location: $url");
	       exit();//quit the script
}
	       
?>
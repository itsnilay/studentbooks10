<?php //activate.php
// include the configuration file for error management
require_once ('include/config.inc.php');

$page_title ='SpindleTree | Activate';
include('include/header.php');

//validate $_GET['x'] and $_GET['y']
$x = $y = FALSE;

if(isset($_GET['x']) && preg_match('/^[\w.-]+@[\w.-]+\.[A-Za-z]{2,6}$/', $_GET['x'])){
	$x = (int)$_GET['x'];
}

if(isset($_GET['y'])&& (strlen($_GET['y'])== 32)){
		  $y = (int)$_GET['y'];
}

// if $x and $y aren't correct ridirect the user
if($x && $y){
			require_once(MYSQL);//connect the database
			$query = "UPDATE users SET active=NULL WHERE (email='".mysqli_real_escape_string($dbc, $x)."' AND active='" .mysqli_real_escape_string($dbc, $y). "') LIMIT 1";
			$result = mysqli_query($dbc, $query) or trigger_error("Query: $query\n<br/>MySQL Error: " .mysqli_error($dbc));
			
			//print a customized message
			if (mysqli_affected_rows($dbc)==1){
				 echo "<h3>Your account is now active. You may now log in</h3>";
			}else{
			         echo'<p class ="error">Your account could not be activated. Please re-click the link or contact the system administrator.</p>';
			}
			mysqli_close($dbc);
}else{//redirect
			//start defining the URL.
			$url = BASE_URL.'index.php';//define the URL:
							
			//ob_end_clean();//delete the buffer
			//header("Location: $url");
			exit();//quit the script
}//end the main IF-ELSE								

include('include/footer.php');
 ?>
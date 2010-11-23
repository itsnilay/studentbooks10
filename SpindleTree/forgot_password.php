<?php  #forgot_password.php
//this page allows a user to reset their password, if forgotten

require_once ('include/config.inc.php');


$page_title ='Simplytraders | Forgot Password';
include('include/header.php');


echo '<div id="header_title1"><h1>Reset Your Password</h1></div>';

if(isset($_POST['submitted'])){//handle the form
require_once(MYSQL);//connect to the database
echo'<div id="error_box">';

//Assume nothing:
$uid = FALSE;

if(!empty($_POST['email'])){//validate email address

			//check for the existance of that email address...
			$query = 'SELECT user_id FROM users WHERE email ="'.mysqli_real_escape_string($dbc, $_POST['email']).'"';
			$result = mysqli_query($dbc, $query) or trigger_error("Query: $query\n<br/>MySQL Error: " .mysqli_error($dbc));

			if (mysqli_num_rows($result)==1){//retrieve the user ID
				 list($uid)=mysqli_fetch_array($result, MYSQLI_NUM);
			}else{//no database match made
				       echo'<p class ="error">The submitted email address does not match those on file!</p>';
			}
}else{//no email!
                        echo'<p class ="error">You forgot to enter your email address!</p>';
}//end of empty if

if($uid){// everything is okay
				 //create a new, random password.
				 $p = substr(md5(uniqid (rand(), true)), 3, 10);
				 
				 //make the query
				 $query = "UPDATE users SET password=SHA1('$p') WHERE user_id=$uid LIMIT 1";
				 $result = mysqli_query($dbc, $query) or trigger_error("Query: $query\n<br/>MySQL Error: " .mysqli_error($dbc));

				 if (mysqli_affected_rows($dbc)==1){// if it ran okay
				       //send an email
				       $body="Your password to log into Simplytraders has been temporarily changed to '$p'. Please log in using this password and your username. At that time you may change your password to something more familiar.";
				       mail($_POST['email'], 'Your temporary password.', $body, 'From: noreply@simplytraders.com');
				       echo'<h3>Your password has been changed. You will recieve the new, temporary password at the email address with which you registered. Once you have logged in with this password, you may change it by clicking on the "Change Password" link.</h3>';
				       
				       mysqli_close($dbc);//close the database connection
				       include('include/footer.php');
				       exit();
				 }else{//if it did not run okay
				       echo'<p class="error">Your password could not be changed due to a system error. We apologize for any inconvenience.</p>';
				 }
}else{//failed the validation test
				       echo'<p class="error">Please try again.</p></div>';
}
mysqli_close($dbc);//close the database connection
 }//end of main submit conditional

 ?>
 
 
 <p>Enter your email address below and your password will be reset.</p>
 <form action ="forgot_password.php" method="post">
 		<div class = "form_box">
 			 <p><label for="email" class="label">Email:</label><input id="email" type="text" name="email" size="20" maxlength="40" value= "<?php  if(isset($_POST['email'])) echo $_POST['email']; ?>" /></p>
			 <p><input type="submit"  name="submit" value="Reset my Password" /></p>
			 <p><input type="hidden"  name="submitted" value="TRUE" /></p>
		</div>
 
 </form>

<?php

include('include/footer.php');  
  ?>
	 
 
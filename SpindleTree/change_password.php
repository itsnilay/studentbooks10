<?php  #change_password.php
//this page allows a user to change their password

require_once ('include/config.inc.php');

//if no session value is present, redirect the user

if(!isset($_SESSION['user_id'])){
    require_once('include/login_functions.php');
    $url=absolute_url();
    header("Location: $url");
    exit();
}

$page_title ='SpindleTree | Change Your Password';
include('include/header.php');
?>

<div id="header_title" class="border_1"><h1 id="style_2">Change Password</h1></div>

<div id="subnav_header">
	 <ul class="sub_nav">
		   <li><a href="my_account.php">Personal Information</a></li>
		   <li><a href="change_password.php">Change Password</a></li>
		   <li><a href="email.php">Email Notifications</a></li>
	 </ul>
</div>

<?php	 
if(isset($_POST['submitted'])){//handle the form
	 require_once(MYSQL);//connect to the database
		  $p=FALSE;
		  //check for a new password and match it against the confirmed password
		  if(preg_match('/^(\w){4,20}$/', $_POST['password1'])){
			   if ($_POST['password1'] == $_POST['password2']){
				    $p=mysqli_real_escape_string($_POST['password1']);
			   }else{
				    echo '<div id="error_box"><p class = "error">Your password did not match the confirmed password!</p>';
			   }
		  }else{			   
			   echo '<p class = "error">Please enter a valid password!</p>';
		  }	
		  
		  if($p){// if everything is okay		  
					  
			   //make query
			   $query = "UPDATE users SET password=SHA1('$p') WHERE user_id={$_SESSION['user_id']} LIMIT 1";
			   $result= mysqli_query($dbc, $query) or trigger_error("Query: $query\n<br/>MySQL Error: " .mysqli_error($dbc));

			   if (mysqli_affected_rows($result)== 1){//if it ran okay
			   
				    //send an email			   
				    echo'<h3>Your password has been changed.</h3>';
				    mysqli_close($dbc);//close the database connection
				    include('include/footer.php');
				    exit();
			   }else{//if it didn't run okay			   
				    //send a message to the error log				    
				    echo'<p class="error">Your password could not be changed. Make sure your new password if different than the current password. Contact the system administrator if you think an error occured.</p>';
			   }	
		  
		  }else{// failed the validation test
			   echo'<p class="error">Please try again.</p>';
		  }			
		  mysqli_close($dbc);//close the database connection
				
}//end of main SUBMIT conditional

?>

 <form action ="change_password.php" method="post">
 <div class="form_box"> 
	 <p><label for="new_password" class="label">New Password:</label> <input id="new_password" type="password" name="password1" size="20" maxlength="20" /></p>
	 <p>Use only letters and numbers. Must be between 4 and 20 chaaracters long.</p>
	 <p><label for="new_password" class="label">Confirm New Password:</label> <input id="new_password" type="password" name="password2" size="20" maxlength="20" /></p>
	 <p><input type="submit"  name="submit" value="Change my Password" /></p>
	 <p><input type="hidden"  name="submitted" value="TRUE" /></p>
		
 </div>
 </form>

<?php
include('include/footer.php');  
?>
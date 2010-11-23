<?php  #register.php

require_once ('include/config.inc.php');
$page_special= 'SpindleTree | Register';
include ('include/header.php');

echo '<h1>Register</h1>';

if (isset($_POST['submitted'])){
	 require_once(MYSQL);//connect to database

	 //trim all the incoming data:
	 $trimmed = array_map('trim', $_POST);

	 //assume invalid values:
	 $fn = $ln = $e = $p = FALSE;

	 //check for a first name:
	 if(preg_match('/^[A-Z \'.-]{2,20}$/i', $trimmed['first_name'])){
		  $fn = mysqli_real_escape_string($dbc, $trimmed['first_name']);
	 }else{
		  echo'<p class="error">Please enter your first name!</p>';
	 }

	 //check for a last name:
	 if(preg_match('/^[A-Z \'.-]{2,40}$/i', $trimmed['first_name'])){
		  $ln = mysqli_real_escape_string($dbc, $trimmed['last_name']);
	 }else{
		  echo'<p class="error">Please enter your last name!</p>';
	 }

	 //check for a email address:
	 if(preg_match('/^[\w.-]+@[\w.-]+\.[A-Za-z]{2,6}$/', $trimmed['email'])){
		  $e = mysqli_real_escape_string($dbc, $trimmed['email']);
	 }else{
		  echo'<p class="error">Please enter a valid email address!</p>';
	 }

	 //check for a password and match against the confirmed password:
	 if(preg_match('/^\w{4,20}$/', $trimmed['password1'])){
		  if($trimmed['password1'] == $trimmed['password2']){
			   $p = mysqli_real_escape_string($dbc, $trimmed['password1']);
		  }else{
			   echo'<p class="error">Your password did not match the confirmed password!</p>';
		  }
	 }else{
		echo'<p class="error">Please enter a valid password!</p>';
	 }

	 if($fn && $ln && $e && $p){//if everything is ok....
		  //make sure the email address avaliable
		  $q ="SELECT user_id FROM users WHERE email='$e'";
		  $r = mysqli_query($dbc, $q) or trigger_error("Query: $q\n<br/>MySQL Error: ".mysqli_error($dbc));

		  if(mysqli_num_rows($r)==0){//available
			   //create activation code:
			   $a = md5(uniqid(rand(), true));

			   //add the user to the database:

			   $q = "INSERT INTO users (email, password, fname, lname, active, registrationDate) VALUES ('$e', SHA1('$p'), '$fn', '$ln', '$a', NOW())";
			   $r = mysqli_query($dbc, $q) or trigger_error("Query: $q\n<br/>MySQL Error: ".mysqli_error($dbc));

			   if(mysqli_affected_rows($dbc)==1){//if it ran ok
				    //send email
				    $body ="Thank you for registering at SpindleTree. To activate your account, please click on this link:\n\n";
				    $body .= BASE_URL.'activate.php?x='.urldecode($e)."&y=$a";

				    mail($trimmed['email'],'Registration Confirmation',$body,'From: welcome@spindletree.com');

				    //finish the page:
				    echo'<h3>Thank You for registering! A confirmation email has been sent to your address. Please click on the link in that email in order to activate your account.</h3>';
				    include('include/footer.php');
				    exit();//stop the page
			   }else{//if it did not run OK
				    echo'<p class="error">You could not be registered due to a system error. We apologize for any inconveinence.</p>';
			   }

		  }else{//email address is not avaliable
			   echo'<p class="error">That email address has already been registered. If you have forgotten your password, please <a href="#">click here</a></p>';
		  }
	 }else{//one of the data test failed
		  echo'<p class="error">Please re-enter your passwords and try again.</p>';
	 }

	 mysqli_close($dbc);//close the database
}// end of main submit conditional

?>

<div class = "form_box">
<form action="registration.php" method="post">
	<p><label for="first_name" class="label">First Name: </label><input id="first_name" type="text" name="first_name" size="15" maxlength="15" value="<?php if (isset($trimmed['first_name'])) echo $trimmed['first_name']; ?>" /></p>
	<p><label for="last_name" class="label">Last Name: </label><input id="last_name" type="text" name="last_name" size="15" maxlength="30" value="<?php if (isset($trimmed['last_name'])) echo $trimmed['last_name']; ?>" /></p>
	<p><label for="email" class="label">Email Address: </label><input id="email" type="text" name="email" size="20" maxlength="40" value="<?php if (isset($trimmed['email'])) echo $trimmed['email']; ?>"  /> </p>
	<p><label for="password1" class="label">Password: </label><input id="password1" type="password" name="password1" size="10" maxlength="20" /></p>
	<p>Use only letters and numbers. Must be between 4 and 20 characters long</p>
	<p><label for="password2" class="label">Confirm Password: </label><input id="password2" type="password" name="password2" size="10" maxlength="20" /></p>
	<p><input type="submit" name="submit" value="Register" /></p>
	<input type="hidden" name="submitted" value="TRUE" />
</form><!-- end of form -->
</div>
<?php
include('include/footer.php');
 ?>      `
<?php  #register.php

require_once ('include/config.php');
$page_title= 'SpindleTree | Register';
include ('include/header.php');

include ('include/addressform.php');

echo '<h1>Register</h1>';

if (isset($_POST['submitted'])){
	 require_once(GLOBAL_MYSQL);//connect to database
         
             //trim all the incoming data:
             $trimmed = array_map('trim', $_POST);

             //assume invalid values:
             $un = $e = $p = FALSE;

             //check for a username name:
             if(preg_match('/^[a-z\d_]{5,20}$/i', $trimmed['user_name'])){
                      $un = mysqli_real_escape_string($dbc, $trimmed['user_name']);
             }else{
                      echo '<p class="error">Please enter a valid user name.</p>';
             }

             //check for a email address:             
             if(preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $trimmed['email'])){
                      $e = mysqli_real_escape_string($dbc, $trimmed['email']);
             }else{
                      echo'<p class="error">Please enter a valid email address.</p>';
             }

             //check for a password and match against the confirmed password:
             if(preg_match('/^\w{4,20}$/', $trimmed['password1'])){
                      if($trimmed['password1'] == $trimmed['password2']){
                               $p = mysqli_real_escape_string($dbc, $trimmed['password1']);
                      }else{
                               echo'<p class="error">Your password did not match the confirmed password!</p>';
                      }
             }else{
                    echo'<p class="error">Please enter a valid password.</p>';
             }
             //validate non required fields
             $a1 = $a2 = $c = $s = $z = NULL;

             if(!empty($_POST['address1'])){
                $trimmed['address1'] = preg_replace('/\s\s+/', ' ', $trimmed['address1']);
                if(preg_match('/^[\w\s.]{4,75}$/', $trimmed['address1'])){
                    $a1 = mysqli_real_escape_string($dbc, $trimmed['address1']);
                }else{
                        echo'<p class="error">Invalid address line 1!</p>';
                    $a1 = "X";
                }
             }
             if(!empty($_POST['address2'])){
                $trimmed['address2'] = preg_replace('/\s\s+/', ' ', $trimmed['address2']);
                if(preg_match('/^[\w\s.]{4,75}$/', $trimmed['address2'])){
                    $a2 = mysqli_real_escape_string($dbc, $trimmed['address2']);
                }else{
                        echo'<p class="error">Invalid address line 2!</p>';
                    $a2 = "X";
                }
             }
             if(!empty($_POST['city'])){
                if(preg_match('/^[A-Z \'.-]{2,25}$/i', $trimmed['city'])){
                    $c = mysqli_real_escape_string($dbc, $trimmed['city']);
                }else{
                        echo'<p class="error">Invalid city name!</p>';
                    $c = "X";
                }
             }

            if(!empty($_POST['state'])){
                if(preg_match('/^[A-Z \'.-]{2}$/i', $trimmed['state'])){
                    $s = mysqli_real_escape_string($dbc, $trimmed['state']);
                }else{
                        echo'<p class="error">Invalid state!</p>';
                    $s = "X";
                }
            }else{
                if(!empty($_POST['city'])){
                         echo'<p class="error">Please enter your state.</p>';
                    $s = "X";
                }
            }

             if(!empty($_POST['zip'])){
                if(preg_match("/^([0-9]{5})(-[0-9]{4})?$/i", $trimmed['zip'])){
                    $z = mysqli_real_escape_string($dbc, $trimmed['zip']);
                }else{
                        echo'<p class="error">Invalid zip code!</p>';
                    $z = "X";
                }
             }

             if($un && $e && $p && $a1!="X" && $a2!="X" && $c!="X" && $s!="X" && $z!="X"){//if everything is ok....
                      //make sure the email address avaliable
                      $q ="SELECT uid FROM user WHERE email='$e'";
                      $r = mysqli_query($dbc, $q) or trigger_error("Query: $q\n<br/>MySQL Error: ".mysqli_error($dbc));

                      if(mysqli_num_rows($r)==0){//available
                               //add the user to the database:

                               $q = "INSERT INTO user (email, password, uname, address1, address2, city, state, zip, registrationDate) VALUES ('$e', SHA1('$p'), '$un', '$a1', '$a2', '$c', '$s', '$z', NOW())";
                               $r = mysqli_query($dbc, $q) or trigger_error("Query: $q\n<br/>MySQL Error: ".mysqli_error($dbc));   

                               if(mysqli_affected_rows($dbc)==1){//if it ran ok
                                        //set activation code to null (setting to NULL activates the user):
                                       $q = "UPDATE user SET  active = NULL LIMIT 1 ";
                                       $r = mysqli_query($dbc, $q) or trigger_error("Query: $q\n<br/>MySQL Error: ".mysqli_error($dbc));

                                        //finish the page:
                                        echo '<h3>Thank you for registering! <a href="login.php?sid='.$sid.'"><u>Click Here</u></a> to log into your account.</h3>';

                                        mysqli_close($dbc);//close the database
                                        include('include/footer.php');
                                        exit();//stop the page
                               }else{//if it did not run OK
                                        echo'<p class="error">You could not be registered due to a system error. We apologize for any inconvenience.</p>';
                               }

                      }else{//email address is not avaliable
                               echo'<p class="error">That email address has already been registered. If you have forgotten your password, please <a href="forgot_password.php">Click Here</a></p>';
                      }
             }
	 mysqli_close($dbc);//close the database
}// end of main submit conditional

?>

<div class = "form_box">
<form action="registration.php" method="post">
	<h3>Required:</h3>
        <p><label for="user_name" class="label">User Name: </label><input id="user_name" type="text" name="user_name" size="15" maxlength="20" value="<?php if (isset($trimmed['user_name'])) echo $trimmed['user_name']; ?>" /></p>
	<p>User name must be 5-20 characters -- letters, numbers, underscores only.</p>
	<p><label for="email" class="label">Email Address: </label><input id="email" type="text" name="email" size="20" maxlength="320" value="<?php if (isset($trimmed['email'])) echo $trimmed['email']; ?>"  /> </p>
	<p><label for="password1" class="label">Password: </label><input id="password1" type="password" name="password1" size="10" maxlength="20" /></p>
	<p>Password must be 4-20 characters -- letters, numbers only.</p>
	<p><label for="password2" class="label">Confirm Password: </label><input id="password2" type="password" name="password2" size="10" maxlength="20" /></p>
	<hr/>
        <h3>Optional:</h3>
        <?php
            if (!isset($trimmed))
                printAddressForm(NULL,NULL);
            else
                printAddressForm(NULL,$trimmed);
         ?>
        <p><input type="submit" name="submit" value="Register" /></p>
        <input type="hidden" name="sid" value="<?php echo $sid; ?>" />
        <input type="hidden" name="submitted" value="TRUE" />
    </form><!-- end of form -->
    </div>

<?php
include('include/footer.php');
 ?>
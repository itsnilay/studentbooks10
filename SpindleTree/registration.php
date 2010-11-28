<?php  #register.php

require_once ('include/config.php');
$page_special= 'SpindleTree | Register';
include ('include/header.php');


echo '<h1>Register</h1>';

function showOptionsDrop($array){
    $string = '';
    foreach($array as $k => $v){
        $string .= '<option value="'.$k.'">'.$v.'</option>'."\n";
    }
    return $string;
}

//create states array
$states_arr = array('AL'=>"Alabama",'AK'=>"Alaska",'AZ'=>"Arizona",'AR'=>"Arkansas",'CA'=>"California",'CO'=>"Colorado",'CT'=>"Connecticut",'DE'=>"Delaware",'DC'=>"District Of Columbia",'FL'=>"Florida",'GA'=>"Georgia",'HI'=>"Hawaii",'ID'=>"Idaho",'IL'=>"Illinois", 'IN'=>"Indiana", 'IA'=>"Iowa",  'KS'=>"Kansas",'KY'=>"Kentucky",'LA'=>"Louisiana",'ME'=>"Maine",'MD'=>"Maryland", 'MA'=>"Massachusetts",'MI'=>"Michigan",'MN'=>"Minnesota",'MS'=>"Mississippi",'MO'=>"Missouri",'MT'=>"Montana",'NE'=>"Nebraska",'NV'=>"Nevada",'NH'=>"New Hampshire",'NJ'=>"New Jersey",'NM'=>"New Mexico",'NY'=>"New York",'NC'=>"North Carolina",'ND'=>"North Dakota",'OH'=>"Ohio",'OK'=>"Oklahoma", 'OR'=>"Oregon",'PA'=>"Pennsylvania",'RI'=>"Rhode Island",'SC'=>"South Carolina",'SD'=>"South Dakota",'TN'=>"Tennessee",'TX'=>"Texas",'UT'=>"Utah",'VT'=>"Vermont",'VA'=>"Virginia",'WA'=>"Washington",'WV'=>"West Virginia",'WI'=>"Wisconsin",'WY'=>"Wyoming");

if (isset($_POST['submitted'])){
	 require_once(GLOBAL_MYSQL);//connect to database
         
         echo '<div class="error">';
             //trim all the incoming data:
             $trimmed = array_map('trim', $_POST);

             //assume invalid values:
             $un = $e = $p = FALSE;

             //check for a username name:
             if(preg_match('/^[a-z\d_]{5,20}$/i', $trimmed['user_name'])){
                      $un = mysqli_real_escape_string($dbc, $trimmed['user_name']);
             }else{
                      echo'<p>Please enter your user name</p>';
             }

             //check for a email address:             
             if(preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $trimmed['email'])){
                      $e = mysqli_real_escape_string($dbc, $trimmed['email']);
             }else{
                      echo'<p>Please enter a valid email address!</p>';
             }

             //check for a password and match against the confirmed password:
             if(preg_match('/^\w{4,20}$/', $trimmed['password1'])){
                      if($trimmed['password1'] == $trimmed['password2']){
                               $p = mysqli_real_escape_string($dbc, $trimmed['password1']);
                      }else{
                               echo'<p>Your password did not match the confirmed password!</p>';
                      }
             }else{
                    echo'<p>Please enter a valid password!</p>';
             }
             //validate non required fields
             $a1 = $a2 = $c = $s = $z = NULL;

             if(!empty($_POST['address1'])){
                if(preg_match('/^\w{4,75}$/', $trimmed['address1'])){
                    $a1 = mysqli_real_escape_string($dbc, $trimmed['address1']);
                }else{
                    echo'<p>Please correct the address in the Address1 field.</p>';
                }
             }
             if(!empty($_POST['address2'])){
                if(preg_match('/^\w{4,20}$/', $trimmed['address1'])){
                    $a2 = mysqli_real_escape_string($dbc, $trimmed['address2']);
                }else{
                    echo'<p>Please correct the address in the Address2 field.</p>';
                }
             }
             if(!empty($_POST['city'])){
                if(preg_match('/^[A-Z \'.-]{2,20}$/i', $trimmed['city'])){
                    $c = mysqli_real_escape_string($dbc, $trimmed['city']);
                }else{
                    echo'<p>Please enter the city in the correct format.</p>';
                }
             }

            if(!empty($_POST['state'])){
                if(preg_match('/^[A-Z \'.-]{2}$/i', $trimmed['state'])){
                    $s = mysqli_real_escape_string($dbc, $trimmed['state']);
                }else{
                    echo'<p>Please enter the state in the correct format.</p>';
                }
             }
             if(!empty($_POST['zip'])){
                if(preg_match("/^([0-9]{5})(-[0-9]{4})?$/i", $trimmed['zip'])){
                    $z = mysqli_real_escape_string($dbc, $trimmed['zip']);
                }else{
                    echo'<p>Please enter the zip code in the correct format.</p>';
                }
             }

             if($un && $e && $p){//if everything is ok....
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
                                        echo'<h3>Thank You for registering! You may now log into SpindleTree. Please <a href="login.php">Click Here</a> to log into your account.</h3>';
                                        include('include/footer.php');
                                        exit();//stop the page
                               }else{//if it did not run OK
                                        echo'<p>You could not be registered due to a system error. We apologize for any inconveinence.</p>';
                               }

                      }else{//email address is not avaliable
                               echo'<p>That email address has already been registered. If you have forgotten your password, please <a href="forgot_password.php">click here</a></p>';
                      }
             }else{//one of the data test failed
                      echo'<p>Please re-enter your passwords and try again.</p>';
             }
         echo '</div>';
	 mysqli_close($dbc);//close the database
}// end of main submit conditional

?>

<div class = "form_box">
<form action="registration.php" method="post">
	<h3>Required:</h3>
        <p><label for="user_name" class="label">User Name: </label><input id="user_name" type="text" name="user_name" size="15" maxlength="20" value="<?php if (isset($trimmed['user_name'])) echo $trimmed['user_name']; ?>" /></p>
	<p><label for="email" class="label">Email Address: </label><input id="email" type="text" name="email" size="20" maxlength="40" value="<?php if (isset($trimmed['email'])) echo $trimmed['email']; ?>"  /> </p>
	<p><label for="password1" class="label">Password: </label><input id="password1" type="password" name="password1" size="10" maxlength="20" /></p>
	<p>Use only letters and numbers. Must be between 4 and 20 characters long</p>
	<p><label for="password2" class="label">Confirm Password: </label><input id="password2" type="password" name="password2" size="10" maxlength="20" /></p>
	<hr/>
        <h3>Optional:</h3>
        <p><label for="address1" class="label">Address 1: </label><input id="address1" type="text" name="address1" size="15" maxlength="75" value="<?php if (isset($trimmed['address1'])) echo $trimmed['address1']; ?>" /></p>
        <p><label for="address2" class="label">Address 2: </label><input id="address2" type="text" name="address2" size="15" maxlength="20" value="<?php if (isset($trimmed['address2'])) echo $trimmed['address2']; ?>" /></p>
        <p><label for="city" class="label">City: </label><input id="city" type="text" name="city" size="15" maxlength="20" value="<?php if (isset($trimmed['city'])) echo $trimmed['city']; ?>" /></p>
        <p>
            <label for="state" class="label">State: </label>
            <select name="states">
                <option value="0">Choose a state</option>
                <?php echo showOptionsDrop($states_arr); ?>
            </select>
        </p>
        <p><label for="zip" class="label">Zip: </label><input id="zip" type="text" name="zip" size="15" maxlength="10" value="<?php if (isset($trimmed['zip'])) echo $trimmed['zip']; ?>" /></p>
        
        <p><input type="submit" name="submit" value="Register" /></p>
	<input type="hidden" name="submitted" value="TRUE" />
</form><!-- end of form -->
</div>
<?php
include('include/footer.php');
 ?>
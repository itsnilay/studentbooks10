<?php
/*
 * forgot_password.php
 */

require_once 'include/config.php';
$page_title = 'SpindleTree | Forgot Password';

include('include/header.php');

if(isset($_POST['submitted'])){
    require_once(GLOBAL_MYSQL);

    //assume nothing
    $uid= FALSE;


    //validate email address
    //there is no need for regular expression b/c the submitted email address must match the value stored in the database and that value was already run through strict validatio :)
    if(!empty($_POST['email'])){
        //check the existance of that email address
        $q = 'SELECT uid FROM user WHERE email="'.mysqli_real_escape_string($dbc,$_POST['email']).'"';
        $r = mysqli_query($dbc, $q) or trigger_error("Query: $q\n<br/>MySQL Error: ". mysqli_error($dbc));

        if(mysqli_num_rows ($r) == 1){//retrieve the user ID:

            list($uid) = mysqli_fetch_array($r, MYSQLI_NUM);//same as writing: $row = mysqli_fetch_array($r, MYSQLI_NUM); $uid=$row[0];
        }else{//no database match made
            echo '<p class="error">The submitted email address does not match those on file!</p>';
        }
    }else{//no email
        echo '<p class="error">You forgot to enter your email address!</p>';
    }//end of empty($_POST['email']) IF

    if($uid){//if everything is ok
        //create a new random password (must create new password b/c no way to retrieve unencrypted version of current password)
        $p = substr(md5(uniqid(rand(), true)), 3, 10);

        //update the database:
        $q = "UPDATE user SET password=SHA('$p') WHERE uid=$uid LIMIT 1";
        $r = mysqli_query($dbc, $q) or trigger_error("Query: $q\n<br/>MySQL Error: ". mysqli_error($dbc));

        if(mysqli_affected_rows ($dbc) == 1){//if it ran ok
            //send an email:
            $body = "Your password to log into SpindleTree has been temporarily changed to '$p'. Please log in using this password and email address. Then you may change your password to something more familiar.";

            mail($_POST['email'], 'Your temporary password.', $body, 'From: noreply@spindletree.com');

            //print a message and wrap up:
            echo '<h3>Your passsword has been changed. You will receive a new temporary password ath the email address with which you registered. Once you have logged in with this password, you may change it by clicking on the "Change Password" link.</h3>';

            mysqli_close($dbc);
            include('include/footer.php');
            exit();//stop the script
        }else{//everything did not run ok
            echo '<p class="error">Your password could not be changed due to a system error. We apologize for any inconvenience.</p>';
        }
    }else{//failed validation test
        echo '<p class="error">Please try again.</p>';
    }
    mysqli_close($dbc);
}//end of main submit conditional.
?>

<p>Enter your email address below and your password will be reset.</p>
<form action ="forgot_password.php" method="post">
    <div class = "form_box">
        <p><label for="email" class="label">Email:</label><input id="email" type="text" name="email" size="20" maxlength="40" value= "<?php  if(isset($_POST['email'])) echo $_POST['email']; ?>" /></p>
        <p><input type="submit"  name="submit" value="Reset my Password" /></p>
        <p><input type="hidden"  name="submitted" value="TRUE" /></p>
    </div>
</form>

<?php include('include/footer.php'); ?>s
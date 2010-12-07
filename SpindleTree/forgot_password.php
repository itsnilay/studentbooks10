<?php
/*
 * forgot_password.php
 */

require_once 'include/config.php';
$page_title = 'SpindleTree | Forgot Password';
include('include/header.php');

echo '<h2>Forgot Your Password?</h2>';

if(isset($_POST['submitted'])){
    require_once(GLOBAL_MYSQL);

    //assume nothing
    $uid= FALSE;

    //validate email address
    //there is no need for regular expression b/c the submitted email address must match the value stored in the database and that value was already run through strict validation :)
    if(empty($_POST['email'])){//no email
        echo '<p class="error">Please enter your email address.</p>';
    }elseif(!preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', trim($_POST['email']))){
        //bad format on email address
        echo'<p class="error">Please enter a valid email address.</p>';
    }else{
        //check the existance of that email address
        $q = 'SELECT uid FROM user WHERE email="'.mysqli_real_escape_string($dbc,$_POST['email']).'"';
        $r = mysqli_query($dbc, $q) or trigger_error("Query: $q\n<br/>MySQL Error: ". mysqli_error($dbc));

        if(mysqli_num_rows ($r) != 1){//email not on file
            // print dummy message
            echo '<h3>A new password has been sent to '.$_POST['email'].'.</h3>';
            $_POST['email'] = NULL; // deter repeated submissions

        }else{//retrieve the user ID:
            list($uid) = mysqli_fetch_array($r, MYSQLI_NUM);//same as writing: $row = mysqli_fetch_array($r, MYSQLI_NUM); $uid=$row[0];
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
                    echo '<h3>A new password has been sent to '.$_POST['email'].'.</h3>';
                    $_POST['email'] = NULL; // deter repeated submissions

                    mysqli_close($dbc);
                    include('include/footer.php');
                    exit();//stop the script

                }else{//everything did not run ok
                    echo '<p class="error">Your password could not be changed due to a system error. We apologize for any inconvenience.</p>';
                }
            }
        }
    }//end of empty($_POST['email']) IF

    mysqli_close($dbc);
}//end of main submit conditional.
?>

<p>Enter your email address below and a new password will be sent to you.</p>

<form action ="forgot_password.php" method="post">
    <div class = "form_box">
        <p><label for="email" class="label">Email:</label><input id="email" type="text" name="email" size="20" maxlength="40" value= "<?php  if(isset($_POST['email'])) echo $_POST['email']; ?>" /></p>
        <p><input type="submit"  name="submit" value="Reset my Password" /></p>
        <input type="hidden" name="sid" value="<?php echo $sid; ?>" />
        <input type="hidden" name="submitted" value="TRUE" />
    </div>
</form>

<?php include('include/footer.php'); ?>
<?php
/*
 * change_password.php
 * page allows a logged in user to change their password
 */

require_once('include/config.php');
$page_title = 'SpindleTree | Change Your Password';
include('include/header.php');

//if no session variable exists, redirect the user:
if(!isset($_SESSION['email'])){
    $url = GLOBAL_BASE_URL . 'index.php';//define the URL
    ob_end_clean();//delete the buffer
    header("Location: $url ");
    exit();//quit the script
}

if (isset($_POST['submitted'])){
    require_once (GLOBAL_MYSQL);

    //check for a new password and match against the confirmed password
    $p = FALSE;
    if (preg_match('/^(\w){4,20}$/', $_POST['password1'])){
        if($_POST['password1']==$_POST['password2']){
            $p = mysqli_real_escape_string($dbc, $_POST['password1']);
        }else{
            echo '<p class="error">Your password did not match the confirmed password.</p>';
        }
    }else{
        echo '<p class="error">Please enter a valid password.</p>';
    }

    if($p){//if everything is ok
        //make the query
        $q = "UPDATE user SET password=SHA1('$p') WHERE uid={$_SESSION['uid']} LIMIT 1";
        $r = mysqli_query($dbc, $q) or trigger_error("Query: $q\n<br/>MySQL Error: ". mysqli_error($dbc));

        if (mysqli_affected_rows ($dbc)==1){//it ran ok
            //send the email, if desired.
            echo'<h3>Your Password has been changed.</h3>';
            mysqli_close($dbc);//close the database connection
            include('includes/footer.php');
            exit();
        }else{//if everything did not run ok
            echo '<p class="error">Your password was not changed. Make sure your new password is different than the current password. Contact the sytem administrator if you think an error a has occured.</p>';
        }

    }else{//failed the validation test
        echo'<p class="error">Please try again.</p>';
    }
    mysqli_close($dbc);//close the database connection
}//end of main Submit conditional
?>

 <form action ="change_password.php" method="post">
     <div class="form_box">
             <p><label for="new_password" class="label">New Password:</label> <input id="new_password" type="password" name="password1" size="20" maxlength="20" /></p>
             <p>Use only letters and numbers. Must be between 4 and 20 characters long.</p>
             <p><label for="new_password" class="label">Confirm New Password:</label> <input id="new_password" type="password" name="password2" size="20" maxlength="20" /></p>
             <p><input type="submit"  name="submit" value="Change my Password" /></p>
             <p><input type="hidden"  name="submitted" value="TRUE" /></p>
     </div>
 </form>

<?php
include('include/footer.php');
?>
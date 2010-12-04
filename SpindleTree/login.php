<?php #login page inc version 1.0

//This page prints any errors accociated with logging in
//and it creates the entire login page including the form.
//include the header
require_once('include/config.php');
$page_title='SpindleTree | Login';
include('include/header.php');

echo '<h1>Login</h1>';

if(isset($_POST['submitted'])){
    require_once(GLOBAL_MYSQL);//connect to database

        //validate email address:
        if(!empty ($_POST['email'])){
            $e = mysqli_real_escape_string($dbc, $_POST['email']);
        }else{
            $e = FALSE;
            echo '<p class="error">Please enter your email address.</p>';
        }

        //validate password
        if (!empty($_POST['password1'])){            
            $p = mysqli_real_escape_string($dbc, $_POST['password1']);
        }else{
             $p = FALSE;
            echo '<p class="error">Please enter your password.</p>';
        }

        if($e && $p){//if everything is ok
            //query the database
            $q = "SELECT uid, email, uname FROM user WHERE email='$e'";// AND password=SHA1('$p')
            $r = mysqli_query($dbc, $q) or trigger_error("Query: $q\n<br/>MySQL Error:" . mysqli_error($dbc));

            if (@mysqli_num_rows($r)==1){//a match was made
                
                //register the values and redirect
                $_SESSION = mysqli_fetch_array($r, MYSQLI_ASSOC);//will return array of three elements, resulting in $_SESSION['uid'], $_SESSION['uname'], $_SESSION['email']
                mysqli_free_result($r);
                mysqli_close($dbc);

                $url = GLOBAL_BASE_URL . 'index.php'; //define the URL:
                ob_end_clean();// delete the existing buffer from header.php

                header("Location: $url");
                exit();
            }else{//no match was made
                echo '<p class="error">Either the email address and password entered do not match those on file or you have not yet activated your account.</p>';
            }
        }

    mysqli_close($dbc);
}//end of submit conditional
?>

<form action ="login.php" method="post">
    <div class = "form_box">
        <p><label for="email" class="label">Email:</label><input id="email" type="text" name="email" size ="20" maxlenght="40" value="<?php if(isset($_POST['email'])) echo $_POST['email']; ?>" /></p>
        <p><label for="password1" class="label">Password:</label><input id="password1" type="password" name="password1" size ="20" maxlenght="20"  /></p>
        <input type="submit" name="submit" value="login"/>
        <input type="hidden" name="submitted" value="TRUE"/>
    </div>
    <br/>
    <?php echo '<p>Forgot your password? <a href="./forgot_password.php">Click Here!</a></p>'; ?>
</form>

<?php
 include('include/footer.php');
?>

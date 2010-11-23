<?php #login page inc version 1.0

//This page prints any errors accociated with logging in

//and it creates the entire login page including the form.
//include the header
$page_title='SpindleTree | Login';

include('include/header.php');


//print any error messages, if they exist:
if(!empty($errors)){
    echo'<h1>Error!</h1>
    <p class="error"> The following error(s) occured: <br/>';
    foreach($errors as $msg){
        echo " -$msg<br/>\n";
    }
    echo '</p><p>Please try again.</p>';
}

//Display the form
?>

<p>Please make sure your browser allows cookies in order to login.</p>
<form action ="login.php" method="post">
    <div class = "form_box">
        <p><label for="email" class="label">Email:</label><input id="email" type="text" name="email" size ="20" maxlenght="40" value="<?php if(isset($_POST['email'])) echo $_POST['email']; ?>" /></p>
        <p><label for="password1" class="label">Password:</label><input id="password1" type="password" name="pass" size ="20" maxlenght="20"  /></p>

        <input type="submit" name="submit" value="login"/>
        <input type="hidden" name="submitted" value="TRUE"/>
    </div>		 
</form>
 
<?php 
 include('include/footer.php');
?>
 
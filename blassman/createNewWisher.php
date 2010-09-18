<?php require_once("Includes/db.php"); ?>
<?php
    /** other variables */
    $userNameIsUnique = true;
    $passwordIsValid = true;
    $userIsEmpty = false;
    $passwordIsEmpty = false;
    $password2IsEmpty = false;

    /** Check that the page was requested from itself via the POST method. */
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        /** Check whether the user has filled in the wisher's name in the text field "user" */
        if ($_POST["user"]=="")
            $userIsEmpty = true;

        /** Look up in Database */
        $wisher = WishDB::getInstance()->get_wisher($_POST["user"]);
        if ($wisher)
            $userNameIsUnique = false;

        /** Check whether a password was entered and confirmed correctly */
        if ($_POST["password"]=="")
            $passwordIsEmpty = true;
        if ($_POST["password2"]=="")
            $password2IsEmpty = true;
        if ($_POST["password"]!=$_POST["password2"])
            $passwordIsValid = false;

        /** Check whether the boolean values show that the input data was validated successfully.
         * If the data was validated successfully, add it as a new entry in the "wishers" database.
         * After adding the new entry, close the connection and redirect the application to editWishList.php.
         */
        if (!$userIsEmpty && $userNameIsUnique && !$passwordIsEmpty && !$password2IsEmpty && $passwordIsValid)
        {
            WishDB::getInstance()->create_wisher($_POST["user"], $_POST["password"]);
            session_start();
            $_SESSION["user"] = $_POST["user"];
            header('Location: editWishList.php' );
            exit;
        }
    }
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8">
        <link href="wishlist.css" type="text/css" rel="stylesheet" media="all" />
        <title>Wishlist registration</title>
    </head>
    <body>
        <div class="Welcome">Create a Wishlist</div><br/>
        <form action="createNewWisher.php" method="POST">
            <label>Username</label><br/>
            <input type="text" name="user"/>
            <?php
                if ($userIsEmpty)
                    echo ("<font color=\"#ff0000\">* Please enter a username.</font>");
                if (!$userNameIsUnique)
                    echo ("<font color=\"#ff0000\">* That user already exists. Please select a different username.</font>");
            ?>
            <br/>
            <label>Password</label><br>
            <input type="password" name="password"/>
            <?php
                if ($passwordIsEmpty)
                    echo ("<font color=\"#ff0000\">* Please enter a password.</font>");
            ?>
            <br/>
            <label>Confirm Password</label><br>
            <input type="password" name="password2"/>
            <?php
                if ($password2IsEmpty)
                    echo ("<font color=\"#ff0000\">* Please confirm your password.</font>");
                if (!$password2IsEmpty && !$passwordIsValid)
                    echo ("<font color=\"#ff0000\">* The password you entered did not match. Please try again.</font>");
            ?>
            <br/>
            <input type="submit" value="Register Me"/>
        </form>
        <form name="backToMainPage" action="index.php">
            <input type="submit" value="Back To Main Page"/>
        </form>
    </body>
</html>

<?php require_once("Includes/db.php"); ?>
<?php
    session_start();
    if (!array_key_exists("user", $_SESSION)) // no user login
    {
        header('Location: index.php');
        exit;
    }

    /** Look up in Database **/
    $wisher = WishDB::getInstance()->get_wisher($_SESSION["user"]);

    $wishDescriptionIsEmpty = false;
    $dateIsInvalid = false;
    $dateIsPast = false;

    /** Check that the Request method is POST, which means that the data
     * was submitted from the form for entering the wish data on the editWish.php
     * page itself */
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        /** Check if the back button was clicked. **/
        if (array_key_exists("back", $_POST))
        {
            header('Location: editWishList.php' );
            exit;
        }
        /** Check if the wish field was blank. **/
        else if ($_POST["wish"] == "")
        {
            $wishDescriptionIsEmpty =  true;
        }
        /** Check if an invalid date was entered. **/
        else if (!WishDB::getInstance()->is_valid_date($_POST["dueDate"]))
        {
            $dateIsInvalid = true;
        }
        /** Check if date has already passed **/
        else if (WishDB::getInstance()->is_date_past($_POST["dueDate"]))
        {
            $dateIsPast = true;
        }
        /** Check (by ID) if the wish doesn't already exist. **/
        else if ($_POST["wishID"] == "")
        {
            WishDB::getInstance()->insert_wish($wisher["id"], $_POST["wish"], $_POST["dueDate"]);
            header('Location: editWishList.php');
            exit;
        }
        else // if ($_POST["wishID"] != "")
        {
            WishDB::getInstance()->update_wish($_POST["wishID"], $_POST["wish"], $_POST["dueDate"]);
            header('Location: editWishList.php');
            exit;
        }
    }
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link href="wishlist.css" type="text/css" rel="stylesheet" media="all" />
    </head>
    <body>
        <?php
            echo "<div class=\"Welcome\">".$_SESSION["user"]."'s Wish</div><br/>";
            if ($_SERVER["REQUEST_METHOD"] == "POST")
                $wish = array("id" => $_POST["wishID"], "description" => $_POST["wish"], "due_date" => $_POST["dueDate"]);
            else if (array_key_exists("wishID", $_GET))
                $wish = mysql_fetch_array(WishDB::getInstance()->get_wish_by_wish_id($_GET["wishID"]));
            else
                $wish = array("id" => "", "description" => "", "due_date" => "");
        ?>
        <form name="editWish" action="editWish.php" method="POST">
            <input type="hidden" name="wishID" value="<?php echo $wish["id"];?>" />
            Describe your wish: <input type="text" name="wish"  value="<?php echo $wish['description'];?>" />
            <?php
                if ($wishDescriptionIsEmpty) echo "<font color=\"#ff0000\">* Please enter a description.</font>";
            ?>
            <br/>
            When do you want to get it? <input type="text" name="dueDate" value="<?php if (!$dateIsInvalid) echo $wish['due_date']; ?>"/>
            <?php
                if ($dateIsInvalid)
                    echo("<font color=\"#ff0000\">* Invalid date.</font>");
            ?>
            (format: YYYY-MM-DD)
            <?php
                if ($dateIsPast)
                    echo("<font color=\"#ff0000\">* Date entered is in the past.</font>");
            ?>
            <br/>
            <input type="submit" name="saveWish" value="Save Changes"/>
            <input type="submit" name="back" value="Back to the List"/>
        </form>
    </body>
</html>

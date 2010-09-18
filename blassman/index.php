<?php require_once("Includes/db.php"); ?>
<?php
    $logonSuccess = true;

    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        if (WishDB::getInstance()->verify_wisher_credentials($_POST["user"], $_POST["userpassword"]) == 1)
        {
            session_start();
            $wisher = WishDB::getInstance()->get_wisher($_POST["user"]);;
            $_SESSION["user"] = $wisher["name"];
            header('Location: editWishList.php');
        }
        else
        {
            $logonSuccess = false;
        }
    }
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link href="wishlist.css" type="text/css" rel="stylesheet" media="all" />
        <title>Wishlist</title>
    </head>
    <body>
        <div class="logo">
            <img src="static/star.png" title="Make a wish!" alt="(star)"/>
            <img src="static/title.png" alt="Wishlist"/>
        </div>
        <div class="logon">
            <input type="submit" name="myWishList" value="My Wishlist >>" onclick="javascript:showHideLogonForm()"/>
            <form name="logon" action="index.php" method="POST" style="visibility:<?php if ($logonSuccess) echo "hidden";
                                                                                        else echo "visible";?>">
                Username <input type="text" name="user"/>
                Password <input type="password" name="userpassword"/>
                <div class="error">
                <?php
                    if (!$logonSuccess)
                        echo "Invalid name and/or password";
                ?>
                </div>
                <input type="submit" value="Edit My Wishlist"/>
            </form>
        </div>
        <div class="viewWishList">
            <input type="submit" name="viewWishList" value="View User's Wishlist >>" onclick="javascript:showHideViewWishListForm()"/>
            <form action="wishlist.php" method="GET" name="wishList" style="visibility:hidden">
                <input type="text" name="user"  />
                <input type="submit" value="Show me" />
            </form>
        </div>
        <div class="createWishList">
            Still don't have a wishlist? <a href="createNewWisher.php">Create one now!</a>
        </div>
        <script type="text/javascript">
            function showHideLogonForm ()
            {
                if (document.all.logon.style.visibility == "visible")
                {
                    document.all.logon.style.visibility = "hidden";
                    document.all.myWishList.value = "My Wishlist >>";
                }
                else
                {
                    document.all.logon.style.visibility = "visible";
                    document.all.myWishList.value = "<< My Wishlist";
                }
            }

            function showHideViewWishListForm ()
            {
                if (document.all.wishList.style.visibility == "visible")
                {
                    document.all.wishList.style.visibility = "hidden";
                    document.all.viewWishList.value = "View User's Wishlist >>";
                }
                else
                {
                    document.all.wishList.style.visibility = "visible";
                    document.all.viewWishList.value = "<< View User's Wishlist";
                }
            }
        </script>
    </body>
</html>

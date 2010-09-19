<?php
require_once("includes/db.php");
$logonSuccess = true;
if ($_SERVER["REQUEST_METHOD"] == "POST"){
    if (WishDB::getInstance()->verify_wisher_credentials($_POST["user"], $_POST["userpassword"]) == 1) {
        session_start();
        $_SESSION["user"] = $_POST["user"];
        header('Location: editWishList.php');
    } else {
        $logonSuccess = false;
    }
}
?>
<?php require_once("includes/header.php");?>        
        <div class="">
            <input type="submit" name="myWishList" value="My Wish List >>" onclick="javascript:showHideLogonForm()"/>
            <form name="logon" action="index.php" method="POST"
                  style="visibility:<?php if ($logonSuccess) echo "hidden"; else echo "visible";?>">
                Username: <input type="text" name="user"/><br/>
                Password:  <input type="password" name="userpassword"/><br/>
                <div class="">
                    <?php
                    if (!$logonSuccess)
                    echo "Invalid name and/or password";
                    ?>
                </div>
                <input type="submit" value="Edit My Wish List"/>
            </form>
        </div>
        <div class="showWishList">
            <input type="submit" name="showWishList" value="Show Wish List of >>" onclick="javascript:showHideShowWishListForm()"/>

            <form name="wishList" action="wishlist.php" method="GET" style="visibility:hidden">
                <input type="text" name="user"/>
                <input type="submit" value="Go" />
            </form>
        </div>        
        <script type="text/javascript">
            function showHideLogonForm() {
                if (document.all.logon.style.visibility == "visible"){
                    document.all.logon.style.visibility = "hidden";
                    document.all.myWishList.value = "My Wishlist >>";
                }
                else {
                    document.all.logon.style.visibility = "visible";
                    document.all.myWishList.value = "<< My Wishlist";
                }
            }

            function showHideShowWishListForm() {
                if (document.all.wishList.style.visibility == "visible") {
                    document.all.wishList.style.visibility = "hidden";
                    document.all.showWishList.value = "Show Wish List of >>";
                }
                else {
                    document.all.wishList.style.visibility = "visible";
                    document.all.showWishList.value = "<< Show Wish List of";
                }
            }
        </script>
<?php require_once("includes/footer.php");?>
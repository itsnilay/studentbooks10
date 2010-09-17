<?php
session_start();
if (array_key_exists("user", $_SESSION)) {
    echo "Hello " . $_SESSION["user"];
}
else {
    header('Location: index.php');
    exit;
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    </head>
    <body>
        <table border="black">
            <tr><th>Item</th><th>Due Date</th></tr>
            <?php
            require_once("Includes/db.php");

            $wisherID = WishDB::getInstance()->get_wisher_id_by_name($_SESSION["user"]);
            $result = WishDB::getInstance()->get_wishes_by_wisher_id($wisherID);
            while($row = mysql_fetch_array($result)) {
                strip_tags($row["description"],'<br><p><h1>');
                echo "<tr><td>" . $row["description"]."</td>";
                strip_tags($row["due_date"],'<br><p><h1>');
                echo "<td>".$row["due_date"]."</td>";
                $wishID = $row["id"];
                 //The loop is left open
                ?>
            <td>
                <form name="editWish" action="editWish.php" method="GET">
                    <input type="hidden" name="wishID" value="<?php echo $wishID; ?>"/>
                    <input type="submit" name="editWish" value="Edit"/>
                </form>
            </td>
            <td>
                <form name="deleteWish" action="deleteWish.php" method="POST">
                    <input type="hidden" name="wishID" value="<?php echo $wishID; ?>"/>
                    <input type="submit" name="deleteWish" value="Delete"/>
                </form>
            </td>
            <?php
            echo "</tr>\n";
            //The loop is now closed
        }
        ?>
        </table>
        <form name="addNewWish" action="editWish.php">
            <input type="submit" value="Add Wish"/>
        </form>
        <form name="backToMainPage" action="index.php">
            <input type="submit" value="Back To Main Page"/>
        </form>
    </body>
</html>
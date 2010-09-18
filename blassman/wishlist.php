<?php require_once("Includes/db.php"); ?>
<?php
    if ($_GET["user"] == "")
        header("location: index.php");

    $wisher = WishDB::getInstance()->get_wisher($_GET["user"]);
 ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <head>
       <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
       <link href="wishlist.css" type="text/css" rel="stylesheet" media="all" />
       <title>Wishlist of <?php if ($wisher) echo $wisher["name"]; else echo $_GET["user"]; ?></title>
    </head>
    <body>
        <?php
            if (!$wisher)
               die("The user " .$_GET["user"]. " was not found. Please check the spelling and try again." );
        ?>
        <div class="Welcome"><?php echo $wisher["name"];?>'s Wishlist</div><br/>
        <table border="black">
            <tr>
                <th>Item</th>
                <th>Due Date</th>
            </tr>
            <?php
                $result = WishDB::getInstance()->get_wishes_by_wisher_id($wisher["id"]);
                while($row = mysql_fetch_array($result))
                {
                    $desc = $row["description"];
                    $dueDate = $row["due_date"];
                    echo "<tr><td>" . strip_tags($desc,'<br><p><h1>')."</td>";
                    echo "<td>";
                    WishDB::getInstance()->print_checked_date(strip_tags($dueDate));
                    echo "</td></tr>\n";
                }
            ?>
        </table>
        <form name="backToMainPage" action="index.php">
            <input type="submit" value="Back To Main Page"/>
        </form>
    </body>
</html>

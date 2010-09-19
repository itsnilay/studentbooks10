<?php require_once("includes/header.php");?>
        Wish List of <?php echo $_GET["user"]."<br/>";?>
        <?php
        require_once("includes/db.php");
        
        $wisherID = WishDB::getInstance()->get_wisher_id_by_name($_GET["user"]);
        if (!$wisherID) {
            die("The person " .$_GET["user"]. " is not found. Please check the spelling and try again" );
        }
        ?>
        <table border="black">
            <tr>
                <th>Item</th>
                <th>Due Date</th>
            </tr>
            <?php
            $result = WishDB::getInstance()->get_wishes_by_wisher_id($wisherID);
            while($row = mysql_fetch_array($result)) {
                $desc = $row["description"];
                $dueDate = $row["due_date"];
                echo "<tr><td>" . strip_tags($desc,'<br><p><h1>')."</td>";
                echo "<td>". strip_tags($dueDate)."</td></tr>\n";
            }
            ?>
        </table>
<?php require_once("includes/footer.php");?>
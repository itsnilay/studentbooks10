<?php
$page_special="HOME";
require_once('include/header.php');//open header
$page_special="";
?>
<h2>Welcome to SpindleTree!</h2>

    <?php
        if (isset($_SESSION['email'])){
            echo "You are now logged in :) Just click on the 'Broswe Books' tab above & start shoppping.";
        }else{
            echo'
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean in tortor egestas dolor dictum suscipit. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Integer erat eros, malesuada at vulputate vitae, aliquam sit amet velit. Proin dictum sagittis mi vitae adipiscing. Suspendisse sit amet odio dui, non blandit lorem. Sed venenatis convallis turpis non lobortis. Nam sed nunc lacus. Vivamus felis lorem, condimentum eu molestie sit amet, ultricies a augue. Quisque vitae mi augue, vitae sollicitudin nulla. Sed leo enim, egestas eu suscipit sed, sodales quis metus.</p>
                <div class="content_wrapper">
                        <div class="rgt_border_column">
                            <a href="./book_details.php?cid='.$cid.'&cat='.$cat.'&sid='.$sid.'&bkid=10001"><img src="img/SE2.jpg" alt="" /></a>
                        </div>
                        <div class="mid_column">
                            <a href="./book_details.php?cid='.$cid.'&cat='.$cat.'&sid='.$sid.'&bkid=10000"><img src="img/SE.jpg" alt="" /></a>
                        </div>
                         <div class="mid_column">
                            <a href="./book_details.php?cid='.$cid.'&cat='.$cat.'&sid='.$sid.'&bkid=10012"><img src="img/CO.JPG" alt="" /></a>
                        </div>
                         <div class="lft_border_column">
                            <a href="./book_details.php?cid='.$cid.'&cat='.$cat.'&sid='.$sid.'&bkid=10008"><img src="img/AI.JPG" alt="" /></a>
                        </div>
                </div>
            ';
        }
    ?>

    
<?php require_once('include/footer.php');//open header ?>
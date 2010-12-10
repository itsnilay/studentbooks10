<?php
require_once('include/header.php');//open header
?>
<h2>Welcome to SpindleTree!</h2>

    <?php
        if (isset($_SESSION['email'])){
            // TODO: Make logged-in message a one-time thing. Currently, it shows over the homepage all the time.
            echo "You are now logged in :) Just click on the 'Browse Books' tab above & start shoppping.";
        }else{
            echo'
                <p>If you\'re looking for hot deals on Computer Science textbooks, you\'ve come to the right place. SpindleTree is dedicated to providing top-notch information at competitive prices. With our expertise, we aim to become your ultimate destination for CS textbooks, both new and used. We hope you enjoy every bit of your experience with us and that you return to SpindleTree for all your textbook needs.</p><p>Thanks for shopping SpindleTree!</p>
                <br/>
                <div class="content_wrapper">
                        <div class="rgt_border_column">
                            <a href="./book_details.php?cid='.urlencode($_GET['cid']).'&cat='.urlencode($_GET['cat']).'&sid='.$sid.'&bkid=10001"><img src="img/SE2.jpg" alt="" /></a>
                        </div>
                        <div class="mid_column">
                            <a href="./book_details.php?cid='.urlencode($_GET['cid']).'&cat='.urlencode($_GET['cat']).'&sid='.$sid.'&bkid=10000"><img src="img/SE.jpg" alt="" /></a>
                        </div>
                         <div class="mid_column">
                            <a href="./book_details.php?cid='.urlencode($_GET['cid']).'&cat='.urlencode($_GET['cat']).'&sid='.$sid.'&bkid=10012"><img src="img/CO.jpg" alt="" /></a>
                        </div>
                         <div class="lft_border_column">
                            <a href="./book_details.php?cid='.urlencode($_GET['cid']).'&cat='.urlencode($_GET['cat']).'&sid='.$sid.'&bkid=10008"><img src="img/AI.jpg" alt="" /></a>
                        </div>
                </div>
                <br/><h2>About Us</h2>
                <p>SpindleTree is the result of a collaborative effort in software engineering between students from <a href="http://www.sfsu.edu/">San Francisco State University</a> and <a href="http://www.fau.edu/">Florida Atlantic University</a> in the Fall semester of 2010, developed under the guidance of <a href="http://cs.sfsu.edu/dragutin/index.html">Dr. Dragutin Petkovic</a> at SFSU and <a href="http://www.cse.fau.edu/~shihong/">Dr. Shihong Huang</a> at FAU.</p>
                <br/>
                <p><b>Team SpindleTree</b></p>
                <p><u>San Francisco State University</u><br/>
                Nilaykumar Patel <i>(Team Lead)</i><br/>
                Andrew McCandless<br/>
                <br/>
                <u>Florida Atlantic University</u><br/>
                Blake Lassman <i>(Team Lead)</i><br/>
                Jerry Mathurin<br/>
                Cory Wardrop<br/></p>
            ';
        }
    ?>

    
<?php require_once('include/footer.php');//open header ?>
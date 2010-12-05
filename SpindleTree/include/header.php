<?php  #script header.php


/*start output buffering:
 * instead of immediately sending HTML to the web browser, store output temporary memory
 * (this is to eradicate those pesky headers already sent error messages, when using HTTP headers, redirect the user, or send cookies :) )
 */
ob_start();

//initialize a session:
session_start();

require_once("mysql_connect.php");
include("getVars.php");

//Get reference to DB
$dbInst = SpindleTreeDB::getInstance();


//check for a page title value:
if(!isset($page_title)){
    if (isset($page_special) && isset($_GET[bkid])){
            $query = $dbInst->getTitle($_GET[bkid]);
            if ($query!=NULL){
                $row = mysql_fetch_array($query);
                $page_title = 'SpindleTree | '.$row['title'];
            }else{
                $page_title = 'SpindleTree | Book Not Found';
            }
    }
    if (!isset($page_title))
        $page_title = 'Welcome to SpindleTree';
}

function draw_category_dropdown($schid, $cid, $cat){
    $result = SpindleTreeDB::getInstance()->getCategory($schid);
    while($row = mysql_fetch_array($result)) {
        if ($schid != 0)
            if ($cid == $row['courseid']){
                echo "<option selected value='".$row['courseid']."'>".$row['courseid']." - ". $row['coursename']."</option>";
            }else echo "<option value='".$row['courseid']."'>".$row['courseid']." - ". $row['coursename']."</option>";
        else {
            if ($cat == $row['coursename'])
                echo "<option selected value='".$row['coursename']."'>". $row['coursename']."</option>";
            else echo "<option value='".$row['coursename']."'>". $row['coursename']."</option>";
        }
    }
}

//This PHP Block will check the URL and if school is selected corresponding values will be displayed on comboBox
function draw_left_panel($sid){
    $result = SpindleTreeDB::getInstance()->getCategory($sid);
    if($sid){
        while($row = mysql_fetch_array($result)) {
                echo "<li><a href='./books_listing.php?sid=".$sid."&cid=".urlencode($row['courseid'])."'>".$row['courseid']." - ". $row['coursename']."</a></li>";
        }
    }else {
        while($row = mysql_fetch_array($result)) {
                echo "<li><a href='./books_listing.php?sid=".$sid."&cat=".urlencode($row['coursename'])."'>".$row['coursename']."</a></li>";
        }
    }
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
    <title><?php echo $page_title; ?></title>
    <link rel="stylesheet" type="text/css" href="blueprint/screen.css" media="screen, projection" />
    <link rel="stylesheet" type="text/css" href="blueprint/print.css" media="print" />
    <link rel="stylesheet" type="text/css" href="blueprint/layout.css" media="all" />
    <!--[if IE]>
        <link rel="stylesheet" type="text/css" href="blueprint/ie.css" media="screen,projection" />
    <![endif]-->
</head>
<?php
    require_once('mysql_connect.php');//connect to database
?>
<body>
    <div class="container" >

        <div class="span-24 last">
            <div class="span-12">
                <?php echo '<a href ="index.php?sid='.$sid.'"> <img src="img/spindletreelogo250X89.png" alt="" /></a>';?>
            </div>
            <div id="secondary_menu" class="span-12 last">
               <span>
                <?php
                if (isset($_SESSION['uid'])AND (substr($_SERVER['PHP_SELF'], -10) != 'logout.php')){
                          echo /* '<a href ="index.php?sid='.$sid.'">Home </a> | ' */ '<a href= "logout.php?sid='.$sid.'">Logout</a>' /* ' | <a href="contact.php?sid='.$sid.'">Contact</a>' */;
                          // REMOVED link to Home (superfluous), REMOVED link to Contact (low priority)
                }else{//not logged in
                          echo '<a href="registration.php?sid='.$sid.'"> Register </a> | <a href="login.php?sid='.$sid.'"> Login </a>' /* ' | <a href="forgot_password.php"> Forgot Password </a>' */;
                          // REMOVED link to Forgot Password (now linked from Login page)
                }
                ?>
                </span>
                    <!--
                    <a href="user_account.php">My Account</a> |
                    <a href="sign_in.php">Sign In</a> |
                    <a href="contact.php">Contact</a> |
                    -->
                
            </div>
        </div>
        <div class="span-24 last">
            <div id="search_bar" class="span-22">
                <form name="searchForm" action="books_listing.php">
                    <script type="text/javascript">
                        function make_blank()
                        {
                        document.searchForm.searchbox.value ="";
                        }
                        </script>
                    <input id="searchbox" name="searchbox" class="text span-10" type="text" value="Enter Title, Author, Course ID, ISBN ..." onclick="make_blank();"/>
                    <?php
                    if($sid) echo '<select name="cid" class="span-5" id="category">';
                    else echo '<select name="cat" class="span-5" id="category">';?>
                         <option class="first" value="0"> Choose a Category...</option>
                         <?php draw_category_dropdown($sid, $cid, $cat); ?>
                     </select>

                        <!--Below java script block will be executed when School is selected and it will generate URL and pass arguments to call above PHP function of ComboBox catCombo(schId) -->
                        <script language="javascript">
                            function changeCat(schList){
                                var catCombo = document.getElementById("category");
                                while(catCombo.hasChildNodes())
                                   catCombo.removeChild(catCombo.lastChild);

                                var schoolid = schList.selectedIndex;
                                // the url which you have to reload is this page, but you add an action to the GET- or POST-variable
                                var url="<?php echo $_SERVER[PHP_SELF]; ?>?sid="+schoolid;

                                // Opens the url in the same window
                                   window.open(url, "_self");

                             }
                        </script>
                         <select name="sid" class="span-4" onChange=changeCat(this)>
                            <option class="first" value="0"> Choose a School...</option>
                            <?php
                          $result = SpindleTreeDB::getInstance()->getSchool();
                          
                          //call once to skip "general" option.
                          mysql_fetch_array($result);
                          $i=1;
                            while($row = mysql_fetch_array($result)) {
                                if($sid==$i)
                                    echo '<option selected value="'.$i.'">'. $row['schoolname'].'</option>';
                                else
                                    echo '<option value="'.$i.'">'. $row['schoolname'].'</option>';
                                $i++;
                            } ?>
                        </select>
                        <script language="javascript">
                            function searchNow(){
                                var search = document.getElementById("searchbox").value;
                               
                                // the url which you have to reload is this page, but you add an action to the GET- or POST-variable
                                var url="./search.php?search="+search;
                                 alert(url);
                                // Opens the url in the same window
                                 //  window.open(url, "_self");

                             }
                        </script>
                        <button id="search_button" class="span-2 last" type="submit">Search</button>
                    <!--/div-->
                </form>
            </div>
        </div>
        <div class="span-23 solidblockmenu prepend-top last">
                    <div class="span-16">
                        <ul>
                           <?php
                                echo '<li><a href="./index.php?sid='.$sid.'" class=\"current\">SpindleTree Home</a></li>';
                                echo '<li><a href="./books_listing.php?sid='.$sid.'" class=\"current\">Browse Books</a></li>';
                            ?>

                        </ul>
                    </div>
                    <div id="cart_price" class="span-3">
                         <p>
                            <?php
                            $result = SpindleTreeDB::getInstance()->getAllBooks();
                            $num_rows = mysql_num_rows($result);

                            echo "$num_rows item(s):\n";
                            ?>
                             <span>$23,673.64</span>
                         </p>
                    </div>
                    <div class="span-2 last">
                       <p><a href="shopping_cart.php"><img src="img/checkout_button.gif" alt="" /></a></p>
                    </div>
        </div>

        <?php if (isset($page_special)){
	  echo "
                <div class='span-5'>
                    <div class='arrowlistmenu fade_bottom'>
                        <h3 class='headerbar'>Categories</h3>
                        <ul>";
                  draw_left_panel($sid);
                  echo" </ul>
                    </div>
                </div>
                <div  class='span-19 last'>
                    <div id ='wrapper' class='span-18'>
                        <div id='wrapper_inner' class='span-18 last'>
          ";
        }else{
                echo "
                <div  class='span-24 last'>
                    <div id ='wrapper' class='span-23'>
                        <div id='wrapper_inner' class='span-23 last'>
          ";
        }
        ?>

			 



        

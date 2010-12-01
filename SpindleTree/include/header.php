<?php  #script header.php


/*start output buffering:
 * instead of immediately sending HTML to the web browser, store output temporary memory
 * (this is to eradicate those pesky headers already sent error messages, when using HTTP headers, redirect the user, or send cookies :) )
 */
ob_start();

//initialize a session:
session_start();

include("mysql_connect.php");

//check for a page title value:
if(!isset($page_special)){
    $page_special = 'Welcome to SpindleTree';
}

if(isset($_GET[vars])){
    if ($vars < 0 || $vars > 2) $vars = 0;
}else $vars = 0;

 
function catCombo($schid){
    $result = SpindleTreeDB::getInstance()->getCategory($schid);
    while($row = mysql_fetch_array($result)) {
        if ($schid != 0)
            echo "<option>".$row['courseid']." - ". $row['coursename']."</option>";
        else
            echo "<option>". $row['coursename']."</option>";
    }
}

//This PHP Block will check the URL and if school is selected corresponding values will be displayed on comboBox
function catLeftPanel($schid){
    $result = SpindleTreeDB::getInstance()->getCategory($schid);
    while($row = mysql_fetch_array($result)) {
        if($schid != 0)
            echo "<a href='./books_listing.php?action=catCombo&vars=".$schid."&action1=dispBooks&cat=".$row['courseid']."'>".$row['courseid']." - ". $row['coursename']."</a>";
        else
            echo "<a href='./books_listing.php?action=catCombo&vars=".$schid."&action1=dispBooks&cat=".$row['courseid']."'>". $row['coursename']."</a>";
    }
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
    <title><?php echo $page_special; ?></title>
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
                <a href="index.php"><img src="img/spindletreelogo250X89.png" alt="" /></a>
            </div>
            <div id="secondary_menu" class="span-12 last">
               <span>
                <?php
                if (isset($_SESSION['uid'])AND (substr($_SERVER['PHP_SELF'], -10) != 'logout.php')){
                          echo '  <a href ="index.php">Home </a> | <a href= "logout.php">Logout</a> | <a href="contact.php">Contact</a> ';
                }else{//not logged in
                          echo '<a href="registration.php"> Register </a> | <a href="login.php"> Login </a> | <a href="forgot_password.php"> Forgot Password </a>';
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
                <form action="books_listing.php">
                    <input id="searchbox" class="text span-10" type="text" />
                    <select name="category" class="span-5" id="category">
                         <option class="first" value=""> Choose a Category...</option>

                         <?php catCombo("0"); ?>
                     </select>

                        <!--Below java script block will be executed when School is selected and it will generate URL and pass arguments to call above PHP function of ComboBox catCombo(schId) -->
                        <script language="javascript">
                            function changeCat(schList){
                                var catCombo = document.getElementById("category");
                                while(catCombo.hasChildNodes())
                                   catCombo.removeChild(catCombo.lastChild);

                                var schoolid = schList.selectedIndex-1;
                                // the url which you have to reload is this page, but you add an action to the GET- or POST-variable
                                var url="<?php echo $_SERVER[PHP_SELF];?>?action=catCombo&vars="+schoolid;

                                // Opens the url in the same window
                                   window.open(url, "_self");

                               }
                        </script>
                        
                         <select class="span-4" onChange=changeCat(this)>
                            <option class="first" value=""> Choose a School...</option>
                            <?php
                          $result = SpindleTreeDB::getInstance()->getSchool();
                          //call once to get rid of "General" option in school
                          mysql_fetch_array($result);
                          $i=1;
                            while($row = mysql_fetch_array($result)) {
                                if($vars)
                                {
                                    if($vars==$i)
                                        echo "<option selected>". $row['schoolname']."</option>";
                                    else
                                        echo "<option>". $row['schoolname']."</option>";
                                }
                                else
                                    echo "<option>". $row['schoolname']."</option>";
                                $i++;
                            } ?>
                        </select>
                    
                        <button id="search_button" class="span-2 last" type="submit">Search</button>
                    <!--/div-->
                </form>
            </div>
        </div>
        <div class="span-23 solidblockmenu prepend-top last">
                    <div class="span-16">
                        <ul>
                            <?php
                           if (isset($_GET[action])){
                                echo '<li><a href="./index.php?action=catCombo&vars='.$_GET[vars].'" class=\"current\">SpindleTree Home</a></li>';
                                echo '<li><a href="./books_listing.php?action=catCombo&vars='.$_GET[vars].'" class=\"current\">Browse Books</a></li>';
                           }
                           else{
                                echo '<li><a href="index.php" class=\"current\">SpindleTree Home</a></li>';
                                echo '<li><a href="books_listing.php" class=\"current\">Browse Books</a></li>';
                           }
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

        <?php if ($page_special=="BOOKS"){
	  echo "
                <div class='span-5'>
                    <div class='arrowlistmenu fade_bottom'>
                        <h3 class='headerbar'>Categories</h3>
                        <ul>

                            <li>";
                             catLeftPanel($vars);

                          

                  echo" </li>
                        </ul>
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

        
			  
			 

	
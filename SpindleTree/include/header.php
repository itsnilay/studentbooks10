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
                <a href="index.php"><img src="img/spindletreelogo250X89.png" alt="" /></a>
            </div>
            <div id="secondary_menu" class="span-12 last">
               <span>
                <?php
                if (isset($_SESSION['user_id'])AND (substr($_SERVER['PHP_SELF'], -10) != 'logout.php')){
                          echo '  <a href ="home.php">Home </a> | <a href= "logout.php">Logout</a> | <a href="help.php">help</a> ';
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
                    <select name="" class="span-4">
                        <option value="">Lorem ipsum dolor</option>
                        <option value="">Lorem ipsum dolor</option>
                        <option value="">Lorem ipsum dolor</option>
                        <option value="">Lorem ipsum dolor</option>
                        <option value="">Lorem ipsum dolor</option>
                    </select>
                    <div class="span-8 last">
                        <input id="search_button" type="submit" value="Search"/>
                    </div>
                </form>
            </div>
        </div>
        <div class="span-23 solidblockmenu prepend-top last">
                    <div class="span-16">
                        <ul>
                            <li><a href="index.php" <?php if ($page_special=="HOME") echo "class=\"current\"";?>>SpindleTree Home</a></li>
                            <li><a href="books_listing.php" <?php if ($page_special=="BOOKS") echo "class=\"current\"";?>>Browse Books</a></li>
                            <!--<li><a href="buy_back.php" <?php // if ($page_special=="BUYBACK") echo "class=\"current\"";?>>BuyBack</a></li>-->
                        </ul>
                    </div>
                    <div id="cart_price" class="span-3">
                         <p>23 item(s): <span>$23,673.64</span>  </p>
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
                            <li>
                                <a href=''>(17) Lorem ipsum dolor</a>
                                <a href=''>(3) Lorem ipsum dolor</a>
                                <a href=''>(12) Lorem ipsum dolor</a>
                                <a href=''>(24) Lorem ipsum dolor</a>
                                <a href=''>(8) Lorem ipsum dolor</a>
                            </li>
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

        
			  
			 

	
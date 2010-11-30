<?php
$page_title ='SpindleTree | Principles of Software Engineering (Edition 8) - Schmoe, Joe';
$page_special = "BOOKS";
include('include/header.php');
$page_special = "";
include('include/book_details_api.php');
require_once("include/mysql_connect.php");
include_once('include/book.php');


if (isset($_GET[action2])){
        // Retrieve the GET parameters and executes the function
          $funcName	 = $_GET[action2];
          $vars	  = $_GET[bkid];
          $funcName($vars);
     }
     else if (isset($_POST[action2])){
        // Retrieve the POST parameters and executes the function
        $funcName	 = $_POST[action2];
        $vars	  = $_POST[bkid];
        $funcName($vars);
     }

function dispBookLstg($bkid)
{
$dbInst = SpindleTreeDB::getInstance();
$book = $dbInst->getBook($bkid);
//$book = $dbInst->getBook($_GET[id]);

//Set up some initial variables to be replaced
$like_new_book_price = 38.26;
$like_new_book_amount = 7;
$very_good_book_price = 57.60;
$very_good_book_amount = 12;
$good_book_price = 27.50;
$good_book_amount = 15;
$terrible_book_price = 13.60;
$terrible_book_amount = 3;
?>

<?php draw_book_details_main($book); ?>

<?php draw_book_details_subnav($book->getTitle());

} ?>

<ul id="used_books" class="span-18 last">
    <li id="like_new" class="odd">
        <span class="condition span-3">Like New (<?php echo $like_new_book_amount ?>)</span>
        <span class="price span-2">$<?php printf("%0.2f",$like_new_book_price); ?></span>
        <a class="buy_button span-1">(buy)</a>
        <span class="description span-12 last">Excepteur sint occaecat, sunt in...</span>
    </li>
    <li id="very_good" class="even">
        <span class="condition span-3">Very Good (<?php echo $very_good_book_amount ?>)</span>
        <span class="price span-2">$<?php printf("%0.2f",$very_good_book_price); ?></span>
        <a class="buy_button span-1">(buy)</a>
        <span class="description span-12 last">Excepteur sint occaecat, sunt in...</span>
    </li>
    <li id="good" class="odd">
        <span class="condition span-3">Good (<?php echo $good_book_amount ?>)</span>
        <span class="price span-2">$<?php printf("%0.2f",$good_book_price); ?></span>
        <a class="buy_button span-1">(buy)</a>
        <span class="description span-12 last">Excepteur sint occaecat, sunt in culpa...</span>
    </li>
    <li id="terrible" class="even">
        <span class="condition span-3">Terrible (<?php echo $terrible_book_amount ?>)</span>
        <span class="price span-2">$<?php printf("%0.2f",$terrible_book_price); ?></span>
        <a class="buy_button span-1">(buy)</a>
        <span class="description span-12 last">Excepteur sint occaecat, sunt in culpa...</span>
    </li>
</ul>

<?php
include('include/footer.php');
?>
		
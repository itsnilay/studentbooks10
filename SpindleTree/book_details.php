<?php
$page_title ='SpindleTree | Principles of Software Engineering (Edition 8) - Schmoe, Joe';
$page_special = "BOOKS";
include('include/header.php');
$page_special = "";
include('include/book_details_api.php');
require_once("include/mysql_connect.php");
include_once('include/book.php');

$dbInst = SpindleTreeDB::getInstance();
$book = $dbInst->getBook('10001');
//$book = $dbInst->getBook($_GET[id]);

//Set up some initial variables to be replaced
$book_title = "Principles of Software Engineering (Edition 8)";
$book_author_first = "Joe";
$book_author_last = "Schmoe";
$book_synopsis = "Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.";
$book_expert_rating = 3.5;
$new_book_price = 45.90;
$book_cover_small = "img/51Zy0q83ipL._AA200_.jpg";
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

<?php draw_book_details_subnav($page_title); ?>

<ul id="used_books" class="span-18 last">
    <li id="like_new" class="odd">
        <span class="detail span-3">Dimensions</span>
        <span class="price span-2">(<?php echo $book->getLength() .' x '. $book->getWidth() .' x '. $book->getHeight() ?>)</span>
    </li>
    <li id="very_good" class="even">
        <span class="condition span-3">Very Good (<?php echo $very_good_book_amount ?>)</span>
        <span class="price span-2">$<?php printf("%0.2f",$very_good_book_price); ?></span>
        <a class="buy_button span-1">(buy)</a>
        <span class="description span-12 last">Excepteur sint occaecat, sunt in...</span>
    </li>
</ul>

<?php
include('include/footer.php');
?>
		
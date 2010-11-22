<?php
$page_title ='SpindleTree | Principles of Software Engineering (Edition 8) - Schmoe, Joe';
$page_special = "BOOKS";
include('include/header.php');
$page_special = "";
include('include/book_details.php');

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

<?php draw_book_details_main(); ?>

<?php draw_book_details_subnav($page_title); ?>

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
		
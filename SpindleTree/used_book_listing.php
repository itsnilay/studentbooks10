<?php 
$page_title ='SpindleTree | Principles of Software Engineering (Edition 8) - Schmoe, Joe';
$page_special = "BOOKS";
include('include/header.php');
$page_special = "";
include('include/book_details.php');

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

<?php
    /*
     *  TODO: Replace this section with a php function, since it is the same
     * for each Book Details page, save for some minor changes.  In the future, queries should
     * be used to retrieve book title, author, rating, etc, so we'll only need to pass the
     * book's unique ID to the function.  -Andrew
     */
?>
<h2 id="title"><?php echo $book_title ?></h2>
<h4 id="author"><?php echo $book_author_last . ', ' . $book_author_first; ?></h4>
<div id="main" class="span-18 last">
    <div id="main_left" class="span-5">
        <img id="cover" class="span-5 last" src="<?php echo $book_cover_small ?>"/>
        <p id="new_price_container" class="span-5 last">
            <span class="subtitle">New: </span>
            <span id="price">$<?php printf("%0.2f",$new_book_price); ?></span>
        </p>
        <a href="shopping_cart.php" class="span-5 last">(+ Buy New Button)</a>
    </div>
    <div id="main_right" class="span-13 last">
        <span class="subtitle" class="span-13 last">Synopsis:</span>
        <p id="synopsis" class="span-13 last"><?php echo $book_synopsis ?></p>
        <div class="span-13 last">
            <span class="subtitle span-3">Expert Rating</span>
            <ul id="expert_rating_stars" class="rating_stars">
                <li class="rating_star"><a href="#">(star)</a></li>
                <li class="rating_star"><a href="#">(star)</a></li>
                <li class="rating_star"><a href="#">(star)</a></li>
                <li class="rating_star"><a href="#">(star)</a></li>
                <li class="rating_star"><a href="#">(star)</a></li>
            </ul>
        </div>
    </div>
</div>

<ul id="subnav" class="span-18 last">
    <li id="used_books" class="tab current"><a href="used_book_listing.php">Used Books</a></li>
    <li id="expert_reviews" class="tab"><a href="expert_reviews.php">Expert Reviews</a></li>
    <li id="used_books" class="tab"><a href="reviews.php">Reviews</a></li>
    <li id="used_books" class="tab"><a href="book_details.php">Details</a></li>
</ul>

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
		
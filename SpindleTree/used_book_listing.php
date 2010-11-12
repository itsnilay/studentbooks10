<?php 
$page_title ='XXX';
include('include/header.php');
include('include/book_details.php');

//Set up some initial variables to be replaced
$book_title = "Principles of Software Engineering (Edition 8)";
$book_author_first = "Joe";
$book_author_last = "Schmoe";
$book_synopsis = "Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.";
$book_expert_rating = 3.5;
$new_book_price = 45.90;
$book_cover_small = "img/51Zy0q83ipL._BO2,204,203,200_PIsitb-sticker-arrow-click,TopRight,35,-76_AA300_SH20_OU01_.jpg";
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
<h1 id="title"><?php echo $book_title ?></h1>
<p id="author"><?php echo $book_author_last . ', ' . $book_author_first; ?></p>
<div id="main" class="span-18 last">
    <div id="main_left" class="span-5">
        <img id="cover" class="span-5 last" src="<?php echo $book_cover_small ?>"/>
        <p id="new_price_container" class="span-5 last">
            <span class="subtitle">New: </span>
            <span id="price">$<?php echo $new_book_price ?></span>
        </p>
        <a href="shopping_cart.php" class="span-5 last">(+ Buy New Button)</a>
    </div>
    <div id="main_right" class="span-13 last">
        <span class="subtitle" class="span-13 last">Synopsis:</span>
        <p id="synopsis" class="span-13 last"><?php echo $book_synopsis ?></p>
        <div class="span-13 last">
            <span class="subtitle">Expert Rating</span>
            <span id="expert_rating_stars">(placeholder for stars)</span>
        </div>
    </div>
</div>

<ul id="subnav" class="span-18 last">
    <li id="used_books" class="tab current"><a href="used_book_listing.php">Used Books</a></li>
    <li id="expert_reviews" class="tab"><a href="expert_reviews.php">Expert Reviews</a></li>
    <li id="used_books" class="tab"><a href="reviews.php">Reviews</a></li>
    <li id="used_books" class="tab"><a href="book_details">Details</a></li>
</ul>

<ul id="used_books" class="span-18 last">
    <li id="like_new" class="odd">
        <span class="condition">Like New (<?php echo $like_new_book_amount ?>)</span>
        <span class="price"><?php echo '\$$like_new_book_price' ?></span>
        <a class="buy_button">(buy)</a>
        <span class="description">Excepteur sint occaecat, sunt in...</span>
    </li>
    <li id="very_good" class="even"
        <span class="condition">Very Good (<?php echo $very_good_book_amount ?>)</span>
        <span class="condition"><?php echo '\$$very_good_book_price' ?></span>
        <a class="buy_button">(buy)</a>
        <span class="description">Excepteur sint occaecat, sunt in...</span>
    </li>
    <li id="good" class="odd">
        <span class="condition">Good (<?php echo $good_book_amount ?>)</span>
        <span class="condition"><?php echo '\$$good_book_price' ?></span>
        <a class="buy_button">(buy)</a>
        <span class="description">Excepteur sint occaecat, sunt in culpa...</span>
    </li>
    <li id="terrible" class="even">
        <span class="condition">Terrible (<?php echo $terrible_book_amount ?>)</span>
        <span class="condition"><?php echo '\$$terrible_book_price' ?></span>
        <a class="buy_button">(buy)</a>
        <span class="description">Excepteur sint occaecat, sunt in culpa...</span>
    </li>
</ul>

<?php 
include('include/footer.php');
?>	
		
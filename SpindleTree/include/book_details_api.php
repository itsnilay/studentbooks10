<?php
/**
 * Draw the subnavigational menu for the Book Details pages.
 *
 * @param <string> $page_title the title of the current subpage of the book
 *  details page.  Used to determine which tab is highlighted and which link
 *  to replace with "#".
 *
 * @author Andrew
 *
 * TODO: Add highlighting based on $page_title
 * TODO: Add link replacement based on $page_title
 */
function draw_book_details_subnav($page_title){
    echo
    '<ul id="subnav" class="span-18 last">' .
    '<li id="used_books" class="tab current"><a href="used_book_listing.php?cid='.$_GET['cid'].'&cat='.$_GET['cat'].'&sid='.$_GET['sid'].'&bkid='.$_GET['bkid'].'">Used Books</a></li>' .
    //'<li id="expert_reviews" class="tab"><a href="expert_reviews.php">Expert Reviews</a></li>' .
    //'<li id="used_books" class="tab"><a href="reviews.php">Reviews</a></li>' .
    '<li id="book_details" class="tab"><a href="book_details.php?cid='.$_GET['cid'].'&cat='.$_GET['cat'].'&sid='.$_GET['sid'].'&bkid='.$_GET['bkid'].'">Details</a></li>' .
    '</ul>';
}

/**
 * Draw the main content subnavigational menu for the Book Details pages.
 *
 * @author Andrew
 *
 * TODO: Add highlighting based on $page_title
 * TODO: Add link replacement based on $page_title
 */
function draw_book_details_main($book){
    //Set up some initial variables to be replaced
    $book_title = $book->getTitle();
    $book_author = $book->getAuthor();
    $book_synopsis = $book->getDesc(); //"Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.  Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.  Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.";
    $book_expert_rating = 3.5;
    $new_book_price = $book->getPrice();
    $bkid = $book->getBookId();
    
    
    echo '
        <h1 id="title">'. $book_title . '</h1>
        <h4 id="author">'. $book_author. '</h4>
        <div id="main" class="span-18 last">
            <img id="cover" class="span-3"src="include/getBLOB.php?id='.$bkid.'"/>
            <span class="subtitle">Synopsis:</span>
            <p id="synopsis">' . $book_synopsis . '</p>

            <div class="span-18">
                <div class="span-9">
                    <p id="new_price_container">
                        <span class="subtitle">New: </span>
                        <span class="new_price">$'; printf("%01.2f", $new_book_price); echo '</span>
                    </p>
                </div>
                <div class="buttons span-9 last">
                    <script language="javascript">
                        function addToCart(){ alert("Selected book is added to Cart"); }
                    </script>
                    <button type="submit" value="book-'. $bkid . '" onclick=addToCart()>+ Add to Cart</button>
                    <!--
                    <form action="shopping_cart.php">
                        <button type="submit" value="book-'. $bkid . '" onclick=checkout()>+ Buy New & Checkout</button>
                    </form>//-->
                </div>
            </div>
        </div>
    ';
}
?>
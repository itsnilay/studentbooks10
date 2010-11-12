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
    '<ul id="subnav">' .
        '<li id="used_books" class="tab current"><a href="used_book_listing.php">Used Books</a></li>' .
        '<li id="expert_reviews" class="tab"><a href="expert_reviews.php">Expert Reviews</a></li>' .
        '<li id="used_books" class="tab"><a href="reviews.php">Reviews</a></li>' .
        '<li id="used_books" class="tab"><a href="book_details.php">Details</a></li>' .
    '</ul>';
}
?>
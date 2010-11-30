<?php

/**
 * Display the given books in an ordered list.
 *
 * @param <array<Book>> $books Books to be displayed.
 * @author Nilay/Andrew
 */
$cart->display_cart($jcart);

function draw_books_listing_list($books)
{
?>
<div class="span-18">
    <ul id="books_list" class="span-18 last">

<?php
    $isOdd = false;
    $isFirst = true;

    foreach ($books as $book)
    {
        $cc_savings = 13.05;


        if($isFirst) {
            echo '<li class="book even span-18 top last">';
            $isFirst = false;
        } else if($isOdd) echo '<li class="book odd span-18 last">';
        else echo '<li class="book even span-18 last">';
?>
    <div class="title_space span-18 last">
        <h2 class="title"><a href=used_book_listing.php><?php echo $book->getTitle(); ?></a></h2>
        <span class="author"><?php echo $book->getAuthor(); ?></span>
    </div>
<table width="100%" cellspacing="0" cellpadding="4" border="0">
    <form method="post" action="">
        <tr valign="bottom">
            <td width="1%">
                <a href="used_book_listing.php"><img class="span-3" src="include/getBLOB.php?id=<?php echo $book->getBookId(); ?>"></a>
            </td>
            <td>
                <p class="price">Used: <span class="used_price">$<?php printf("%0.2f",$book->getTerriblePrice()); ?></span></p>
                <p class="price">New: <span class="new_price">$<?php printf("%0.2f",$book->getPrice()); ?></span></p>
            </td>
            <td>
                <p class="cc_savings">Save <span>$<?php echo $cc_savings?></span> on the price at your bookstore!</p>
            </td>
            <td class="buttons">
                <!--<script language="javascript">
                    function addToCart(){ alert("Selected book is added to Cart"); }
                </script>-->
                    <input type="hidden" name="my-item-id" value="<?php echo $book->getBookId(); ?>" />
                    <input type="hidden" name="my-item-name" value="<?php echo $book->getTitle(); ?>" />
                    <input type="hidden" name="my-item-price" value="<?php printf("%0.2f",$book->getPrice()); ?>" />
                    <input type="hidden" name="my-item-qty" value="1" />
                <input type="submit" name="my-add-button" value="Add to Cart" class="button"/>
               <!-- <button type="submit" value="book-<?php // $book->getBookId(); ?>" onclick=checkout()>+ Buy New & Checkout</button>                -->
            </td>
        </tr>
    </form>
</table>

<?php
        $isOdd = !$isOdd;
    } //end of foreach
?>
    </ul>
</div>

<?
    unset($book);
 }//end of function
?>


<?php

    /**
     * This function is used to build the pagination <div> tag to be printed to
     * the books listing page.
     *
     * @param <type> $page the current page in the books listing
     * @param <type> $booksPerPage the number of books to be displayed per page
     * @param <type> $size total number of paginated to be paginated.
     */
    function draw_pagination($page, $booksPerPage, $numBooks){
            $MAX_PAGINATION_PAGES = 9;
            //build_pagination($page, $booksPerPage, sizeof($tmp_book_ids));
            $numPages = ceil($numBooks/$booksPerPage); 
            if ($page > $numPages) $page = $numPages;
            $isAbbrLeft = false;
            $isAbbrRight = false;
            $begin = 2;
            $end = $MAX_PAGINATION_PAGES;

            //figure out which page numbers we need to abbreviate
            if($numPages > $MAX_PAGINATION_PAGES){
                if($page > 5) $isAbbrLeft = true;
                if(($numPages - $page) > 5) $isAbbrRight = true;
            }

            //abbreviate excess page numbers
            if($isAbbrLeft && $isAbbrRight) {
                $begin = $page - 3;
                $end = $page + 3;
            }else if ($isAbbrLeft){
                $begin = $numPages - $MAX_PAGINATION_PAGES + 2;
                $end = $numPages - 1;
            }else if ($isAbbrRight){
                $end = 8;
            }
        //echo '<div>$page = '.$page.'; $begin = '.$begin.'; $end = '.$end.'; $numPages = '.$numPages.'; $isAbbrLeft = '.$isAbbrLeft.'; $isAbbrRight = '.$issAbbrRight.'; $MAX = '.$MAX_PAGINATION_PAGES.'; $numBooks = '.$numBooks.';<br>$booksPerPage = '.$booksPerPage.';</div>';
        ?>
        <div class="pagn span-8">
            <ul>
                <?php
                    //Print pagination beginning
                    if ($page > 1) echo '<li><a href="?p='.($page - 1).'">Previous | </a></li>';
                    else echo '<li>Previous | </li>';
                    if($page != 1) echo '<li><a href="?p=1">1 </a></li>';
                    else echo '<li>1 </li>';

                    //print left abbreviation if needed
                    if ($isAbbrLeft) echo '... ';

                    //Print pagination middle
                    for($i=$begin; $i<=$end; $i++){
                        if($page != $i) echo '<li><a href="?p='.$i.'">'.$i.' </a></li>';
                        else echo '<li>'.$i.' </li>';
                    }

                    //print right abbreviation if needed
                    if ($isAbbrRight) echo '... ';

                    //Print pagination end
                    if($page != $numPages) echo '<li><a href="?p='.$numPages.'">'.$numPages.' </a></li>';
                    else echo '<li>'.$numPages.' </li>';
                    if ($page < $end) echo '<li><a href="?p='.($page + 1).'">| Next</a></li>';
                    else echo '<li>| Next</li>';
                ?>
            </ul>
        </div>
<?php
    }//end function
?>

<?php
    function draw_list_header_footer($page, $booksPerPage, $numBooks){
?>
    <div class="results-info span-18 last">
        <?php draw_pagination($page, $booksPerPage, $numBooks); ?>
        <form action="books_listing.php" method="get" class="prepend-4 span-6 last">
            <select class="span-3" name="sort">
                <option class="first" value="">Sort by...</option>
                <option value="">Price</option>
                <option value="">Rating</option>
                <option value="">Relevance</option>
            </select>
            <div class="span-1">&nbsp;</div>
            <button class="span-2" type="submit">Sort</button>
        </form>
    </div>
<?php
    }//end function draw_list_header_footer
?>

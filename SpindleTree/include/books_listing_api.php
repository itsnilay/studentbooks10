<?php

/**
 * Display the given books in an ordered list.
 *
 * @param <array<Book>> $books Books to be displayed.
 * @author Nilay/Andrew
 */

function draw_books_listing_list($page, $books, $booksPerPage)
{

?>
<div class="span-18">
    <ul id="books_list" class="span-18 last">

<?php
    $isOdd = false;
    $isFirst = true;
    $numBooks = sizeof($books);

    $end = (($booksPerPage*$page) < $numBooks)? ($booksPerPage*$page) : $numBooks;
    for ($i = ($page-1)*$booksPerPage; $i<$end; $i++)
    {
        $book = $books[$i];

        $cc_savings = abs($book->getPrice() - $book->getBookstorePrice());

        if($isFirst) {
            echo '<li class="book even span-18 top last">';
            $isFirst = false;
        } else if($isOdd) echo '<li class="book odd span-18 last">';
        else echo '<li class="book even span-18 last">';
?>
    <div class="title_space span-18 last">
        <h2 class="title">
        <?php
            echo "<a href='./book_details.php?cid=".urlencode($_GET['cid'])."&cat=".urlencode($_GET['cat'])."&sid=".urlencode($_GET['sid'])."&bkid=".$book->getBookId()."&action=add'>".$book->getTitle()." </a>"?></h2>
        <span class="author"><?php echo $book->getAuthor(); ?></span>
    </div>
    <table width="100%" cellspacing="0" cellpadding="4" border="0"><tr valign="bottom">
        <td width="1%">
            <?php echo "<a href='./book_details.php?cid=".urlencode($_GET['cid'])."&cat=".urlencode($_GET['cat'])."&sid=".urlencode($_GET['sid'])."&bkid=".$book->getBookId()."&action=add'><img class='span-3' src='include/getBLOB.php?id=".$book->getBookId()."'></a>"?>

        </td>
        <td>
            <p class="price">Used: <span class="used_price">$<?php printf("%0.2f",$book->getTerriblePrice()); ?></span></p>
            <p class="price">New: <span class="new_price">$<?php printf("%0.2f",$book->getPrice()); ?></span></p>
        </td>
        <td>
            <?php
                if ($_GET['sid'] > 0){
                    echo '<p class="cc_savings">Save <span>$';
                    printf("%0.2f",$cc_savings);
                    echo '</span> on the price at your bookstore!</p>';
                }
            ?>
        </td>
        <td class="buttons">
            <!--
            <script language="javascript">
                function addToCart(){ alert("Selected book is added to Cart"); }
            </script>
            
            <button type="submit" value="book-<?php// $book->getBookId(); ?>">+ Add to Cart</button>-->
            <?php echo '<input type="button" value="+ Add to Cart" onClick="location.href=\'add_cart.php?sid='.urlencode($_GET['sid']).'&bkid='.$book->getBookId().'\'">'; ?>
            <!--<input type="button" value="Proceed To Checkout &gt;&gt;" onClick="window.location.href='view_cart.php'">-->

            <!--
            <form action="shopping_cart.php">
                <button type="submit" value="book-<?php //$book->getBookId(); ?>" onclick=checkout()>+ Buy New & Checkout</button>
            </form>
            -->
        </td>
    </tr></table>

<?php
        $isOdd = !$isOdd;
    } //end of foreach
?>
    </ul>
</div>

<?
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
    function draw_pagination($page, $numBooks, $booksPerPage){
            $MAX_MIDPAGES = 5; //# of pages to display between first and last

            $numPages = ceil($numBooks/$booksPerPage);

            if ($page > $numPages)
                $page = $numPages;
            elseif ($page < 1)
                $page = 1;

            // set first page of middle range
            $midStart = $page+3-$MAX_MIDPAGES;
            if ($midStart > $numPages-$MAX_MIDPAGES+1)
                $midStart = $numPages-$MAX_MIDPAGES+1;

            // set last page of middle range
            $midEnd = $midStart+$MAX_MIDPAGES-1;
            if ($midEnd < $MAX_MIDPAGES)
                $midEnd = $MAX_MIDPAGES;

            // check middle range at low end
            $isAbbrLeft = true;
            if ($midStart <= 2){
                $isAbbrLeft = false;
                if ($midStart < 2)
                    $midStart = 2;
            }

            // check middle range at high end
            $isAbbrRight = true;
            if ($midEnd >= $numPages-1){
                $isAbbrRight = false;
                if ($midEnd > $numPages-1)
                    $midEnd = $numPages-1;
            }
        //echo '<div>$page = '.$page.'; $begin = '.$begin.'; $end = '.$end.'; $numPages = '.$numPages.'; $isAbbrLeft = '.$isAbbrLeft.'; $isAbbrRight = '.$issAbbrRight.'; $MAX = '.$MAX_PAGINATION_PAGES.'; $numBooks = '.$numBooks.';<br>$booksPerPage = '.$booksPerPage.';</div>';
        ?>
        <div class="pagn span-8">
            <ul>
                <?php
                    //print 'previous' pagelink
                    if ($page > 1){
                        echo '<li><a href="?';
                        if ($_GET['searchbox']) echo 'searchbox='.urlencode($_GET['searchbox']).'&';
                        echo 'p='.($page - 1).'&cid='.urlencode($_GET['cid']).'&cat='.urlencode($_GET['cat']).'&sid='.urlencode($_GET['sid']).'">Previous </a>|</li>';
                    }else echo '<li>Previous |</li>';

                    //print first page
                    if ($page > 1){
                        echo '<li><a href="?';
                        if ($_GET['searchbox']) echo 'searchbox='.urlencode($_GET['searchbox']).'&';
                        echo 'p=1&cid='.urlencode($_GET['cid']).'&cat='.urlencode($_GET['cat']).'&sid='.urlencode($_GET['sid']).'"> 1 </a></li>';
                    }else echo '<li> 1 </li>';

                    //print left abbreviation if needed
                    if ($isAbbrLeft) echo '... ';

                    //print middle range
                    for($i=$midStart; $i<=$midEnd; $i++){
                        if($page != $i){
                            echo '<li><a href="?';
                            if ($_GET['searchbox']) echo 'searchbox='.urlencode($_GET['searchbox']).'&';
                            echo 'p='.$i.'&cid='.urlencode($_GET['cid']).'&cat='.urlencode($_GET['cat']).'&sid='.urlencode($_GET['sid']).'">'.$i.' </a></li>';
                        }else echo '<li>'.$i.' </li>';
                    }

                    //print right abbreviation if needed
                    if ($isAbbrRight) echo '... ';

                    //print last page
                    if($numPages > 1){
                        if($page < $numPages){
                            echo '<li><a href="?';
                            if ($_GET['searchbox']) echo 'searchbox='.urlencode($_GET['searchbox']).'&';
                            echo 'p='.$numPages.'&cid='.urlencode($_GET['cid']).'&cat='.urlencode($_GET['cat']).'&sid='.urlencode($_GET['sid']).'">'.$numPages.' </a></li>';
                        }else echo '<li>'.$numPages.' </li>';
                    }

                    //print 'next' pagelink
                    if ($page < $numPages){
                        echo '<li>|<a href="?';
                        if ($_GET['searchbox']) echo 'searchbox='.urlencode($_GET['searchbox']).'&';
                        echo 'p='.($page + 1).'&cid='.urlencode($_GET['cid']).'&cat='.urlencode($_GET['cat']).'&sid='.urlencode($_GET['sid']).'"> Next</a></li>';
                    }else echo '<li>| Next</li>';
                ?>
            </ul>
        </div>
<?php
    }//end function
?>

<?php
    function draw_list_header_footer($page, $numBooks, $booksPerPage){
?>
    <div class="results-info span-18 last">
        <?php draw_pagination($page, $numBooks, $booksPerPage); ?>
        <!--
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
        //-->
    </div>
<?php
    }//end function draw_list_header_footer
?>

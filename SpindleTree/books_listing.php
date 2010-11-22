<?php
$page_title ='SpindleTree | Search Results';
$page_special="BOOKS";
include('include/header.php');
require_once("include/mysql_connect.php");
$page_special="";

//TODO: Create some initial check based on search results.  If search is
//default/null/empty, use some default splash page.  Otherwise, generate/refine
//results based on search query.
?>
    <h2>Search Results</h2>
    <div class="prepend-8 span-18 last">
        <select class="span-5">
            <option class="first" value="">Choose a School...</option>
            <option value="">SFSU</option>
            <option value="">FAU</option>
            <option value="">CCSF</option>
            <option value="">MIT</option>
            <option value="">Harvey Mudd</option>
        </select>
        <select class="span-5">
            <option class="first" value="">Sort by...</option>
            <option value="">Price</option>
            <option value="">Rating</option>
            <option value="">Relevance</option>
        </select>
    </div>

    <div class="span-18">
        <ul id="books_list" class="span-18 last">
            <li>
            <?php
                $isOdd = false;
                $isFirst = true;
                $result = SpindleTreeDB::getInstance()->get_all_books();
                while($row = mysql_fetch_array($result)) {
                    $bookid = $row["bookid"];
                    $book_title = $row["title"];
                    $book_author = $row["author"];
                    $book_synopsis = $row["description"];
                    $book_expert_rating = 3.5;
                    $new_book_price = $row["price"];
                    $used_book_price = 28.86;
                    $book_cover_tiny = $row["bookimage"];
                    $cc_savings = 13.05;
            ?>
            <?php   if($isFirst) {
                        echo '<li class="book even span-18 top last">';
                        $isFirst = false;
                    } else if($isOdd) echo '<li class="book odd span-18 last">';
                    else echo '<li class="book even span-18 last">';
            ?>
                <div class="title_space span-18 last">
                    <h2 class="title"><a href=used_book_listing.php><?php echo $book_title ?></a></h2>
                    <span class="author"><?php echo $book_author; ?></span>
                </div>
                <table width="100%" cellspacing="0" cellpadding="4" border="0"><tr valign="bottom">
                    <td width="1%">
                        <a href="used_book_listing.php"><img class="span-3" src="include/getBLOB.php?id=<?php echo $bookid ?>"></a>
                    </td>
                    <td>
                        <p class="price">Used: <span class="used_price">$<?php echo $used_book_price ?></span></p>
                        <p class="price">New: <span class="new_price">$<?php echo $new_book_price ?></span></p>
                    </td>
                    <td>
                        <p class="cc_savings">Save <span>$<?php echo $cc_savings?></span> on the price at your bookstore!</p>
                    </td>
                    <td class="buttons">
                        <script language="javascript">
                            function addToCart(){ alert("Selected book is added to Cart"); }
                        </script>
                        <button type="submit" value="book-<?php $bookid ?>" onclick=addToCart()>+ Add to Cart</button>
                        <!--
                        <form action="shopping_cart.php">
                            <button type="submit" value="book-<?php $bookid ?>" onclick=checkout()>+ Buy New & Checkout</button>
                        </form>
                        <a href="shopping_cart.php"><img src="img/BuyButton.JPG"></a>//-->
                    </td>
                </tr></table>
            </li>
            <?
                    $isOdd = !$isOdd;
                } //end while
            ?>
        </ul>
    </div>
<?php
include('include/footer.php');
?>
		
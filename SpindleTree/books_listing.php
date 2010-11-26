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
    <script language="javascript">
        function nextPage(){
            var bookList = document.getElementById('books_list');
            var item = bookList.childNodes.item(0);
              
              

            alert(item); }
    </script>
    <button type="submit" onclick=nextPage()>Next Page>></button>
    <div class="prepend-8 span-18 last">
        <!--select class="span-5">
            <option class="first" value="">Choose a School...</option>
            <option value="">SFSU</option>
            <option value="">FAU</option>
            <option value="">CCSF</option>
            <option value="">MIT</option>
            <option value="">Harvey Mudd</option>
        </select-->
        <select class="span-5">
            <option class="first" value="">Sort by...</option>
            <option value="">Price</option>
            <option value="">Rating</option>
            <option value="">Relevance</option>
        </select>
     </div>

    <div class="span-18">
        <ul id="books_list" class="span-18 last">
           
            <?php
                $isOdd = false;
                $isFirst = true;
                $limit = 5;
               $dbInst = SpindleTreeDB::getInstance();
                $i=-1;
                
                while($i < $limit) {
                    $i++;
                    $bookInst = $dbInst->getBook($i);
                    $bookid = $bookInst->getBookId();
                    $book_title = $bookInst->getTitle();
                    $book_author = $bookInst->getAuthor();
                    $book_synopsis = $bookInst->getDesc();
                    $book_expert_rating = 3.5;
                    $new_book_price = $bookInst->getPrice();
                    $used_book_price = 28.86;
                    $book_cover_tiny = $bookInst->getBookid();
                    $cc_savings = 13.05;

                    if($isFirst) {
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
                        
                        <form action="shopping_cart.php">
                            <button type="submit" value="book-<?php $bookid ?>" onclick=checkout()>+ Buy New & Checkout</button>
                        </form>
                        <!--a href="shopping_cart.php"><img src="img/BuyButton.JPG"></a-->
                    </td>
                </tr></table>
           
            <?
                    $isOdd = !$isOdd;
                } //end while
            ?>
        </ul>
    </div>
<?php
include('include/footer.php');
?>
		
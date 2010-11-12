<?php 
$page_title ='XXX';
include('include/header.php');

//Set up some initial variables to be replaced
$book_title = "Principles of Software Engineering (Edition 8)";
$book_author_first = "Joe";
$book_author_last = "Schmoe";
$book_synopsis = "Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.";
$book_expert_rating = 3.5;
$new_book_price = 45.90;
$used_book_price = 28.86;
$book_cover_tiny = "img/51Zy0q83ipL._BO2,204,203,200_PIsitb-sticker-arrow-click,TopRight,35,-76_AA300_SH20_OU01_.jpg";
$ccsavings = array(13.05, 18.86, 5.07, 3.86, 21.70, 18.60, 24.37, 12.34, 24.35, 8.00);
?>
    <h1>Books Listing</h1>
    <div class="span-18 last">
        <select class="span-5">
            <option class="first" value="">Choose a School...</option>
            <option value="">School #1</option>
            <option value="">School #2</option>
            <option value="">School #3</option>
            <option value="">School #4</option>
            <option value="">School #5</option>
        </select>
        <select class="span-5">
            <option class="first" value="">Sort by...</option>
            <option value="">School #1</option>
            <option value="">School #2</option>
            <option value="">School #3</option>
            <option value="">School #4</option>
            <option value="">School #5</option>
        </select>
    </div>

    <div class="span-18">
        <ul id="books_list" class="span-18 last">
            <!-- ITEM NUMBER 0 //-->
            <li class="book odd span-18 last">
                <div class="span-18 last">
                    <h2 class="title"><a href=used_book_listing.php><?php echo $book_title ?></a></h2>
                    <span id="author"><?php echo $book_author_last . ', ' . $book_author_first; ?></span>
                </div>
                <div class="span-18 last">
                    <div class="span-3">
                        <a href="used_book_listing.php"><img class="span-3" src="<?php echo $book_cover_tiny ?>"/></a>
                    </div>
                    <div class="span-3">
                        <p>Used: <span class="used_price">$<?php echo $used_book_price ?></span></p>
                        <p>New: <span class="new_price">$<?php echo $new_book_price ?></span></p>
                    </div>
                    <div class="span-6">
                        <p>Save <span class="cc_savings"><?php echo $ccsavings[0]?> </span> on the price at your bookstore!</p>
                    </div>
                    <div class="span-6 last">
                        <button class="add_to_cart" type="submit" value="book-<?php echo 0 ?>">+ Add to Cart</button>
                    </div>
                </div>
            </li>
            <!-- ITEM NUMBER 1 //-->
            <li class="book even span-18 last">
                <div class="span-18 last">
                    <h2 class="title"><a href=used_book_listing.php><?php echo $book_title ?></a></h2>
                    <span id="author"><?php echo $book_author_last . ', ' . $book_author_first; ?></span>
                </div>
                <div class="span-18 last">
                    <div class="span-3">
                        <a href="used_book_listing.php"><img class="span-3" src="<?php echo $book_cover_tiny ?>"/></a>
                    </div>
                    <div class="span-3">
                        <p>Used: <span class="used_price">$<?php echo $used_book_price ?></span></p>
                        <p>New: <span class="new_price">$<?php echo $new_book_price ?></span></p>
                    </div>
                    <div class="span-6">
                        <p>Save <span class="cc_savings"><?php echo $ccsavings[1]?> </span> on the price at your bookstore!</p>
                    </div>
                    <div class="span-6 last">
                        <button class="add_to_cart" type="submit" value="book-<?php echo 1 ?>">+ Add to Cart</button>
                    </div>
                </div>
            </li>
            <!-- ITEM NUMBER 2 //-->
            <li class="book odd span-18 last">
                <div class="span-18 last">
                    <h2 class="title"><a href=used_book_listing.php><?php echo $book_title ?></a></h2>
                    <span id="author"><?php echo $book_author_last . ', ' . $book_author_first; ?></span>
                </div>
                <div class="span-18 last">
                    <div class="span-3">
                        <a href="used_book_listing.php"><img class="span-3" src="<?php echo $book_cover_tiny ?>"/></a>
                    </div>
                    <div class="span-3">
                        <p>Used: <span class="used_price">$<?php echo $used_book_price ?></span></p>
                        <p>New: <span class="new_price">$<?php echo $new_book_price ?></span></p>
                    </div>
                    <div class="span-6">
                        <p>Save <span class="cc_savings"><?php echo $ccsavings[2]?> </span> on the price at your bookstore!</p>
                    </div>
                    <div class="span-6 last">
                         <button class="add_to_cart" type="submit" value="book-<?php echo 2 ?>">+ Add to Cart</button>
                    </div>
                </div>
            </li>
            <!-- ITEM NUMBER 3 //-->
            <li class="book even span-18 last">
                <div class="span-18 last">
                    <h2 class="title"><a href=used_book_listing.php><?php echo $book_title ?></a></h2>
                    <span id="author"><?php echo $book_author_last . ', ' . $book_author_first; ?></span>
                </div>
                <div class="span-18 last">
                    <div class="span-3">
                        <a href="used_book_listing.php"><img class="span-3" src="<?php echo $book_cover_tiny ?>"/></a>
                    </div>
                    <div class="span-3">
                        <p>Used: <span class="used_price">$<?php echo $used_book_price ?></span></p>
                        <p>New: <span class="new_price">$<?php echo $new_book_price ?></span></p>
                    </div>
                    <div class="span-6">
                        <p>Save <span class="cc_savings"><?php echo $ccsavings[3]?> </span> on the price at your bookstore!</p>
                    </div>
                    <div class="span-6 last">
                         <button class="add_to_cart" type="submit" value="book-<?php echo 3 ?>">+ Add to Cart</button>
                    </div>
                </div>
            </li>
            <!-- ITEM NUMBER 4 //-->
            <li class="book odd span-18 last">
                <div class="span-18 last">
                    <h2 class="title"><a href=used_book_listing.php><?php echo $book_title ?></a></h2>
                    <span id="author"><?php echo $book_author_last . ', ' . $book_author_first; ?></span>
                </div>
                <div class="span-18 last">
                    <div class="span-3">
                        <a href="used_book_listing.php"><img class="span-3" src="<?php echo $book_cover_tiny ?>"/></a>
                    </div>
                    <div class="span-3">
                        <p>Used: <span class="used_price">$<?php echo $used_book_price ?></span></p>
                        <p>New: <span class="new_price">$<?php echo $new_book_price ?></span></p>
                    </div>
                    <div class="span-6">
                        <p>Save <span class="cc_savings"><?php echo $ccsavings[4]?> </span> on the price at your bookstore!</p>
                    </div>
                    <div class="span-6 last">
                         <button class="add_to_cart" type="submit" value="book-<?php echo 4 ?>">+ Add to Cart</button>
                    </div>
                </div>
            </li>
            <!-- ITEM NUMBER 5 //-->
            <li class="book even span-18 last">
                <div class="span-18 last">
                    <h2 class="title"><a href=used_book_listing.php><?php echo $book_title ?></a></h2>
                    <span id="author"><?php echo $book_author_last . ', ' . $book_author_first; ?></span>
                </div>
                <div class="span-18 last">
                    <div class="span-3">
                        <a href="used_book_listing.php"><img class="span-3" src="<?php echo $book_cover_tiny ?>"/></a>
                    </div>
                    <div class="span-3">
                        <p>Used: <span class="used_price">$<?php echo $used_book_price ?></span></p>
                        <p>New: <span class="new_price">$<?php echo $new_book_price ?></span></p>
                    </div>
                    <div class="span-6">
                        <p>Save <span class="cc_savings"><?php echo $ccsavings[5]?> </span> on the price at your bookstore!</p>
                    </div>
                    <div class="span-6 last">
                         <button class="add_to_cart" type="submit" value="book-<?php echo 5 ?>">+ Add to Cart</button>
                    </div>
                </div>
            </li>
            <!-- ITEM NUMBER 6 //-->
            <li class="book odd span-18 last">
                <div class="span-18 last">
                    <h2 class="title"><a href=used_book_listing.php><?php echo $book_title ?></a></h2>
                    <span id="author"><?php echo $book_author_last . ', ' . $book_author_first; ?></span>
                </div>
                <div class="span-18 last">
                    <div class="span-3">
                        <a href="used_book_listing.php"><img class="span-3" src="<?php echo $book_cover_tiny ?>"/></a>
                    </div>
                    <div class="span-3">
                        <p>Used: <span class="used_price">$<?php echo $used_book_price ?></span></p>
                        <p>New: <span class="new_price">$<?php echo $new_book_price ?></span></p>
                    </div>
                    <div class="span-6">
                        <p>Save <span class="cc_savings"><?php echo $ccsavings[6]?> </span> on the price at your bookstore!</p>
                    </div>
                    <div class="span-6 last">
                         <button class="add_to_cart" type="submit" value="book-<?php echo 6 ?>">+ Add to Cart</button>
                    </div>
                </div>
            </li>
            <!-- ITEM NUMBER 7 //-->
            <li class="book even span-18 last">
                <div class="span-18 last">
                    <h2 class="title"><a href=used_book_listing.php><?php echo $book_title ?></a></h2>
                    <span id="author"><?php echo $book_author_last . ', ' . $book_author_first; ?></span>
                </div>
                <div class="span-18 last">
                    <div class="span-3">
                        <a href="used_book_listing.php"><img class="span-3" src="<?php echo $book_cover_tiny ?>"/></a>
                    </div>
                    <div class="span-3">
                        <p>Used: <span class="used_price">$<?php echo $used_book_price ?></span></p>
                        <p>New: <span class="new_price">$<?php echo $new_book_price ?></span></p>
                    </div>
                    <div class="span-6">
                        <p>Save <span class="cc_savings"><?php echo $ccsavings[7]?> </span> on the price at your bookstore!</p>
                    </div>
                    <div class="span-6 last">
                         <button class="add_to_cart" type="submit" value="book-<?php echo 7 ?>">+ Add to Cart</button>
                    </div>
                </div>
            </li>
            <!-- ITEM NUMBER 8 //-->
            <li class="book odd span-18 last">
                <div class="span-18 last">
                    <h2 class="title"><a href=used_book_listing.php><?php echo $book_title ?></a></h2>
                    <span id="author"><?php echo $book_author_last . ', ' . $book_author_first; ?></span>
                </div>
                <div class="span-18 last">
                    <div class="span-3">
                        <a href="used_book_listing.php"><img class="span-3" src="<?php echo $book_cover_tiny ?>"/></a>
                    </div>
                    <div class="span-3">
                        <p>Used: <span class="used_price">$<?php echo $used_book_price ?></span></p>
                        <p>New: <span class="new_price">$<?php echo $new_book_price ?></span></p>
                    </div>
                    <div class="span-6">
                        <p>Save <span class="cc_savings"><?php echo $ccsavings[8]?> </span> on the price at your bookstore!</p>
                    </div>
                    <div class="span-6 last">
                         <button class="add_to_cart" type="submit" value="book-<?php echo 8 ?>">+ Add to Cart</button>
                    </div>
                </div>
            </li>
            <!-- ITEM NUMBER 9 //-->
            <li class="book even span-18 last">
                <div class="span-18 last">
                    <h2 class="title"><a href=used_book_listing.php><?php echo $book_title ?></a></h2>
                    <span id="author"><?php echo $book_author_last . ', ' . $book_author_first; ?></span>
                </div>
                <div class="span-18 last">
                    <div class="span-3">
                        <a href="used_book_listing.php"><img class="span-3" src="<?php echo $book_cover_tiny ?>"/></a>
                    </div>
                    <div class="span-3">
                        <p>Used: <span class="used_price">$<?php echo $used_book_price ?></span></p>
                        <p>New: <span class="new_price">$<?php echo $new_book_price ?></span></p>
                    </div>
                    <div class="span-6">
                        <p>Save <span class="cc_savings"><?php echo $ccsavings[9]?> </span> on the price at your bookstore!</p>
                    </div>
                    <div class="span-6 last">
                        <button class="add_to_cart" type="submit" value="book-<?php echo 9 ?>">+ Add to Cart</button>
                    </div>
                </div>
            </li>
        </ul>
    </div>
<?php 
include('include/footer.php');
?>	
		
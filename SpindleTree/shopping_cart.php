<?php 
$page_title ='SpindleTree | Shopping Cart';
include('include/header.php');

//Set up some initial variables to be replaced
$book_titles = array("Software Engineering", "Absolute C++", "Absolute Java", "Absolute SmallTalk", "Absolut Vodka", "Design Patterns");
$book_prices = array(108.95, 89.50, 56.30, 9.95, 2000.86, 75.25);
$book_conditions = array("New", "Like New", "Good", "Terrible", "New", "Good");
$book_quantities = array(12, 8, 16, 2, 5, 4);
?>
	<h2>Shopping Cart</h2>
        <div id="cart" class="span-18 push-2 prepend-top last">
            <div class="span-18 last">
                    <div class="span-2">Delete?</div>
                    <div class="span-6">Book</div>
                    <div class="span-4">Price</div>
                    <div class="span-4">Condition</div>
                    <div class="span-1 last">Quantity</div>
            </div>
            <ul id="cart_contents" class="span-18 last">
                <li id="cart_item" class="span-18 last">
                    <div class="span-2 odd"><input type="checkbox" name="delete" value="0"/></div>
                    <div class="span-6 even"><?php echo $book_titles[0]?></div>
                    <div class="span-4 odd"><?php printf("%0.2f",$book_prices[0]);?></div>
                    <div class="span-4 even"><?php echo $book_conditions[0]?></div>
                    <div class="span-1 odd last"><input type="text" value="<?php echo $book_quantities[0]?>" /></div>
                </li>
                <li id="cart_item" class="span-18 last">
                    <div class="span-2 odd"><input type="checkbox" name="delete" value="1"/></div>
                    <div class="span-6 even"><?php echo $book_titles[1]?></div>
                    <div class="span-4 odd"><?php printf("%0.2f",$book_prices[1]);?></div>
                    <div class="span-4 even"><?php echo $book_conditions[1]?></div>
                    <div class="span-1 odd last"><input type="text" value="<?php echo $book_quantities[1]?>" /></div>
                </li>
                <li id="cart_item" class="span-18 last">
                    <div class="span-2 odd"><input type="checkbox" name="delete" value="2"/></div>
                    <div class="span-6 even"><?php echo $book_titles[2]?></div>
                    <div class="span-4 odd"><?php printf("%0.2f",$book_prices[2]);?></div>
                    <div class="span-4 even"><?php echo $book_conditions[2]?></div>
                    <div class="span-1 odd last"><input type="text" value="<?php echo $book_quantities[2]?>" /></div>
                </li>
                <li id="cart_item" class="span-18 last">
                    <div class="span-2 odd"><input type="checkbox" name="delete" value="3"/></div>
                    <div class="span-6 even"><?php echo $book_titles[3]?></div>
                    <div class="span-4 odd"><?php printf("%0.2f",$book_prices[3]);?></div>
                    <div class="span-4 even"><?php echo $book_conditions[3]?></div>
                    <div class="span-1 odd last"><input type="text" value="<?php echo $book_quantities[3]?>" /></div>
                </li>
                <li id="cart_item" class="span-18 last">
                    <div class="span-2 odd"><input type="checkbox" name="delete" value="4"/></div>
                    <div class="span-6 even"><?php echo $book_titles[4]?></div>
                    <div class="span-4 odd"><?php printf("%0.2f",$book_prices[4]);?></div>
                    <div class="span-4 even"><?php echo $book_conditions[4]?></div>
                    <div class="span-1 odd last"><input type="text" value="<?php echo $book_quantities[4]?>" /></div>
                </li>
                <li id="cart_item" class="span-18 last">
                    <div class="span-2 odd"><input type="checkbox" name="delete" value="5"/></div>
                    <div class="span-6 even"><?php echo $book_titles[5]?></div>
                    <div class="span-4 odd"><?php printf("%0.2f",$book_prices[5]);?></div>
                    <div class="span-4 even"><?php echo $book_conditions[5]?></div>
                    <div class="span-1 odd last"><input type="text" value="<?php echo $book_quantities[5]?>" /></div>
                </li>
            </ul>
                <div id="price" class="span-4 push-15 last">
                    <span>Total: <span id="cart_total">$23,673.64</span></span>
            </div>
        </div>
        <div class="span-23 last">
            <div class="span-5 push-15 last">
                <form action="checkOut.php" style="display: inline;"><input style="float:right; margin-left: 1em;" type="submit" value="Confirm" /></form>
                <button style="float:right;">Update</button>
            </div>
        </div>
<?php 
include('include/footer.php');
?>	
		
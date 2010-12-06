<?php
/* 
 * This page adds books to shopping cart
 */
//set the page title and include the header
include('include/header.php');
if (isset($_GET['bkid']) && is_numeric($_GET['bkid'])){//check for book id
    $bookid= (int) $_GET['bkid'];
    
    //check if cart already contains book, if so increment quantity
    if (isset($_SESSION['cart'][$bookid])){
        $_SESSION['cart'][$bookid]['quantity']++;//add another
        //echo "the quantity is now". $_SESSION['cart'][$bookid]['quantity'];
        //diplay message
        echo '<p>Another book has been added to your cart<br/>
                <a href="books_listing.php">Continue Shopping on SpindleTree :)</a></p>';
    }else{//new product to the cart
        //get the books price from the datatbase
        require_once('include/mysql_connect.php');
        $q = "SELECT price from book where bookid = $bookid";
        $r = mysqli_query($dbc, $q);
        
        if(mysqli_num_rows ($r)==1){
            ////valid book id
            
            //fetch the information
            list($price) = mysqli_fetch_array($r, MYSQLI_NUM);
            
            //add to cart
            $_SESSION['cart'][$bookid] = array('quantity'=>1,'price'=> $price);
            
            //display message
            echo'<p>Book has been added to your shopping cart<br/>
                <a href="books_listing.php">Continue Shopping on SpindleTree :)</a></p>';
            
        }else{//not a valid book id
            echo '<div class="error">This page has been accessed in error!</div>';
        }
        mysqli_close($dbc);
    }//end of isset($_SESSION['cart'][$bookid] conditional)
    
}else{//no print id
    echo '<div class="error">This page has been accessed in error!</div>';
}

include('include/footer.php');
?>

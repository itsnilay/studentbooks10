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
            
        }else{//not a valid book id
            echo '<p class="error">This page has been accessed in error!</p>';

            mysqli_close($dbc);
            include('include/footer.php');

            exit();
        }
        mysqli_close($dbc);
    }//end of isset($_SESSION['cart'][$bookid] conditional)

    header('Location: view_cart.php?result=addSuccess');
    
    //display message
    //echo'<p class="info">A book has been added to your shopping cart.</p>
    //    <h2><a href="books_listing.php"><u>Click Here</u></a> to continue shopping.</h2>
    //    <h2><a href="view_cart.php"><u>Click Here</u></a> to view your cart.</h2>';
  
}else{//no print id
    echo '<p class="error">This page has been accessed in error!</p>';
}

include('include/footer.php');
?>

<?php
$page_title ='SpindleTree | Browse Books';
$page_special="BOOKS";
include('include/header.php');
include('include/books_listing_api.php');
require_once("include/mysql_connect.php");

//Book Listing according to search Criteria
if($searchbox && $searchbox != 'Enter Title, Author, Course ID, ISBN ...' /* This ain't elegant, but... */)
{
    //Search Result books will be stored in this array
    $sbooks=array();


//If searchbox had only course number//////////////////////////////////////
    $result = SpindleTreeDB::getInstance()->getCourseIds();
    while($row = mysql_fetch_array($result)){
            if(strcasecmp($searchbox,$row['courseid']) == 0){
                  $sbooks = SpindleTreeDB::getInstance()->getBooksByCourseId($row['courseid']);
            }
     }


//If searchbox had Title//////////////////////////////////////
     //Get All books
    $allbooks = SpindleTreeDB::getInstance()->getAllBooks();
    $trimsearch = trim($searchbox);

    //Search for exact string match
    foreach($allbooks as $sbook){
       if(strcasecmp($sbook->getTitle(),$trimsearch) == 0 )
            $sbooks[]=$sbook;
       else if(strcasecmp($sbook->getAuthor(),$trimsearch) == 0)
            $sbooks[]=$sbook;
       else if(strcasecmp($sbook->getISBN(),$trimsearch) == 0)
            $sbooks[]=$sbook;
    }

    //More Loose Search on each words
    $searcharray = explode(" ",$trimsearch);

    foreach($allbooks as $sbook){
        $searchtitle = explode(" ",$sbook->getTitle());
        $searchauthor = explode(" ",$sbook->getAuthor());
        $searchisbn = explode(" ",$sbook->getISBN());
        $searchauthor = preg_replace("/[^A-Za-z0-9]/","",$searchauthor);

        foreach($searcharray as $sa){ //Check with all words from search box.
           foreach($searchtitle as $st){ //Check with each word of all the titles of book
               if(strcasecmp($sa,$st) == 0 ){
                 //This is the logic to remove duplicate books we get when each word of the input query matches with same book's title
                   $flag=0;
                   foreach($sbooks as $sbk){

                       if($sbk->getBookId() == $sbook->getBookId()){
                           $flag =1;
                       }
                   }
                   if($flag ==0)
                    $sbooks[]=$sbook;
               }
           }
           foreach($searchauthor as $sauth){
               if(strcasecmp($sa,$sauth) == 0 )
                    $sbooks[]=$sbook;
           }

       }
        
    }

    $numBooks = sizeof($sbooks);

    $booksPerPage = 5; //# of books to be displayed per page

    //Refine by searchQuery
    //TODO: Impelement Search

   if($sbooks){
         echo "<h2>Search Results for \"<U>".$trimsearch."</U>\"</h2>";
         draw_list_header_footer($page, $numBooks, $booksPerPage);
         draw_books_listing_list($page, $sbooks, $booksPerPage, $sid);
         draw_list_header_footer($page, $numBooks, $booksPerPage);
   }
   else{ //If no books found.. Display all books with notifier..
       $numBooks = 0 /*sizeof($allbooks)*/;
        echo "<h2>No Results found for \"<U>".$trimsearch."</U>\".</h2><h2><a href='./books_listing.php?p=1&cat=".$_GET[cat]."&cid=".$_GET[cid]."&sid=".$_GET[sid]."'><u>Click Here</u></a> to browse our books.</h2>";
         draw_list_header_footer($page, $numBooks, $booksPerPage);
         draw_books_listing_list($page, null /*$allbooks*/, $booksPerPage, $sid);
         draw_list_header_footer($page, $numBooks, $booksPerPage);
   }

}
//Default Book Listing
else
{
    //Get id's for all books that match category
    if($cid){
        $books = SpindleTreeDB::getInstance()->getBooksByCourseId($cid);
    }else if ($category){
        if ($sid){
            $books = SpindleTreeDB::getInstance()->getBooksByCourseId($cid);
        }else {
            $books = Book::getBooksByCategory($category);
        }
    }else $books = $dbInst->getAllBooks();

    $numBooks = sizeof($books);

    $booksPerPage = 5; //# of books to be displayed per page

    //Refine by searchQuery
    //TODO: Impelement Search

    ?>
        <h2>Browse Books <?php
                            // display category or course ID if selected
                            if($_GET['sid']>0){
                                if($_GET['cid'])
                                    echo '('.$_GET['cid'].')';
                                }elseif($_GET['cat'])
                                    echo '('.$_GET['cat'].')';
                          ?>
        </h2>

        <?php draw_list_header_footer($page, $numBooks, $booksPerPage); ?>
        <?php draw_books_listing_list($page, $books, $booksPerPage, $sid); ?>
        <?php draw_list_header_footer($page, $numBooks, $booksPerPage); }//End of else?>
    <?php
    include('include/footer.php');
    ?>
		

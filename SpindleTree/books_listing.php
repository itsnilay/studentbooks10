<?php
$page_title ='SpindleTree | Browse Books';
$page_special="BOOKS";
include('include/header.php');
include('include/books_listing_api.php');
require_once("include/mysql_connect.php");

//Book Listing according to search Criteria
if($searchbox)
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
        $searchisbn = preg_replace("/[^A-Za-z0-9]/","",$searchisbn);

       foreach($searcharray as $sa){
           foreach($searchtitle as $st){
               if(strcasecmp($sa,$st) == 0 )
                    $sbooks[]=$sbook;
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
   else{
       $numBooks = sizeof($allbooks);
        echo "<h2>No Results found for \"<U>".$trimsearch."</U>\"</h2> Please Browse these available Books..";
         draw_list_header_footer($page, $numBooks, $booksPerPage);
         draw_books_listing_list($page, $allbooks, $booksPerPage, $sid);
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
        <h2>Browse Books</h2>
        <?php draw_list_header_footer($page, $numBooks, $booksPerPage); ?>
        <?php draw_books_listing_list($page, $books, $booksPerPage, $sid); ?>
        <?php draw_list_header_footer($page, $numBooks, $booksPerPage); }//End of else?>
    <?php
    include('include/footer.php');
    ?>
		

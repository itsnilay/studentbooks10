<?php $searchbox = "Prof. Hans van Vliet";

$page_title ='SpindleTree | Search Results';
$page_special="BOOKS";
include('include/header.php');
include('include/books_listing_api.php');
require_once("include/mysql_connect.php");


//Search Result books will be stored in this array
$sbooks=array();


//If searchbox had only course number//////////////////////////////////////
    $result = SpindleTreeDB::getInstance()->getCourseIds();
    while($row = mysql_fetch_array($result)){
            if($searchbox == $row['courseid']){
                  $sbooks = SpindleTreeDB::getInstance()->getBooksByCourseId($row['courseid']);
            }
     }


//If searchbox had Title//////////////////////////////////////
     //Get All books
    $books = SpindleTreeDB::getInstance()->getAllBooks();

    foreach($books as $sbook){
       if($sbook->getTitle() == $searchbox)
            $sbooks[]=$sbook;
       else if($sbook->getAuthor() == $searchbox)
            $sbooks[]=$sbook;
       else if($sbook->getISBN() == $searchbox)
            $sbooks[]=$sbook;


    }


//Get id's for all books that match category
/*if($cid){
    $sbooks = SpindleTreeDB::getInstance()->getBooksByCourseId($cid);
}else if ($category){
    if ($sid){
        $sbooks = SpindleTreeDB::getInstance()->getBooksByCourseId($cid);
    }else {
        $sbooks = Book::getBooksByCategory($category);
    }
}else $sbooks = $dbInst->getAllBooks();*/

$numBooks = sizeof($sbooks);

$booksPerPage = 5; //# of books to be displayed per page

//Refine by searchQuery
//TODO: Impelement Search

?>
    <h2>Search Results</h2>
    <?php draw_list_header_footer($page, $numBooks, $booksPerPage); ?>
    <?php draw_books_listing_list($page, $sbooks, $booksPerPage, $sid); ?>
    <?php draw_list_header_footer($page, $numBooks, $booksPerPage); ?>
<?php
include('include/footer.php');
?>

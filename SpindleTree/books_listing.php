<?php
$page_title ='SpindleTree | Browse Books';
$page_special="BOOKS";
include('include/header.php');
include('include/books_listing_api.php');
require_once("include/mysql_connect.php");
$page_special="";


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
    <?php draw_list_header_footer($page, $numBooks, $booksPerPage); ?>
<?php
include('include/footer.php');
?>
		

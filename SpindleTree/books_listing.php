<?php
$page_title ='SpindleTree | Search Results';
$page_special="BOOKS";
include('include/header.php');
include('include/books_listing_api.php');
require_once("include/mysql_connect.php");
$page_special="";

//Get reference to DB
$dbInst = SpindleTreeDB::getInstance();

//set up some initial variables
$booksPerPage = 5;
$page = $_GET[p];
if(!$page || $page <1) $page = 1; //default page value

if (isset($_GET[action1]))
{
    // Retrieve the GET parameters and executes the function
      $funcName	 = $_GET[action1];
      $vars	  = $_GET[cat];
      $funcName($vars);
 }
 else if (isset($_POST[action1])){
    // Retrieve the POST parameters and executes the function
    $funcName	 = $_POST[action1];
    $vars	  = $_POST[cat];
    $funcName($vars);
 }

if(isset($_GET[vars]))
    $vars=$_GET[vars];
else
    $vars=0;

//$cat_id = $_GET[category];
//if(!$cat_id) $cat_id = "default";
$cat_id = "default";

//Get id's for all books that match category
$tmp_book_ids = Book::getBookIdsByCat($cat_id);
$numBooks = sizeof($tmp_book_ids);

//Refine by searchQuery
//TODO: Impelement Search

//Make sure we don't mix up any previous search results
if($books) unset($books);
$books = array();

//Determine books to be displayed on this page.
$end = ($booksPerPage*$page-1 < sizeof($tmp_book_ids))? $booksPerPage*$page-1 : sizeof($tmp_book_ids);
for($i=($page-1)*$booksPerPage; $i<$end; $i++){
    $books[] = $dbInst->getBook($tmp_book_ids[$i]);
}

//cleanup
unset($i);
unset($end);
?>
    <h2>Browse Books</h2>
    <?php draw_list_header_footer($page, $booksPerPage, $numBooks); ?>
    <?php draw_books_listing_list($books); ?>
    <?php draw_list_header_footer($page, $booksPerPage, $numBooks); ?>
<?php
include('include/footer.php');
?>
		
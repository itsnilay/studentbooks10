<?php
$page_title ='SpindleTree | Principles of Software Engineering (Edition 8) - Schmoe, Joe';
$page_special = "BOOKS";
include('include/header.php');
$page_special = "";
include('include/book_details_api.php');
require_once("include/mysql_connect.php");
include_once('include/book.php');

$dbInst = SpindleTreeDB::getInstance();
$book = $dbInst->getBook(10001);
//$book = $dbInst->getBook($_GET[id]);
?>

<?php draw_book_details_main($book); ?>

<?php draw_book_details_subnav($page_title); ?>

<?php
include('include/footer.php');
?>
		
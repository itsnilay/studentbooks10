<?php
require_once('mysql_connect.php');

$id = $_GET['id'];
//$storedid = "10000";
 // $id = (int)$storedid;

if(!isset($id) || empty($id)){
die("Please select your image!");
}else{

$query = SpindleTreeDB::getInstance()->get_book_image($id);
$row = mysql_fetch_array($query);
$content = $row['bookimage'];
//$content = SpindleTreeDB::getInstance()->book[$id]->bookimage;

header('Content-type: image/jpg');
echo $content;

}

?>
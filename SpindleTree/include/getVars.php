<?php

//page variable is used for pagination in bookslisting page
if(!isset($_GET['p']) || $_GET['p'] <1){
    $_GET['p'] = 1;
    $page = 1; //default page value
}
else $page = $_GET['p'];

//sid variable is used to identify the school id that is to be searched for
if(isset($_GET['sid'])){
    $sid = $_GET['sid'];
    if ($sid < 0 || $sid > 5) $sid = 0;
}elseif (isset($_POST['sid'])){
    $sid = $_POST['sid'];
    if ($sid < 0 || $sid > 5) $sid = 0;
}else {
    $_GET['sid'] = 0;
    $sid = 0;
}
//course variable is used to determine the category of books a user is searching for.
if(isset($_GET['cat'])){
    $category = $_GET['cat'];
}else{
    $_GET['cat'] = "";
    $category = null;
}

//TODO: Validate and sanitize category input.
//cid variable is used to determine the course id of books currently being searched/browsed for
if(isset($_GET['cid'])){
    $cid = $_GET['cid'];
}else {
    $_GET['cid'] = "";
    $cid = null;
}

if(isset($_GET['searchbox'])){
    $searchbox = $_GET['searchbox'];
}else {
    $_GET['searchbox'] = "";
    $searchbox = null;
}

?>

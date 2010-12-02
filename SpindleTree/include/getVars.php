<?php

//page variable is used for pagination in bookslisting page
if(!isset($_GET[p]) || $_GET[p] <1) $page = 1; //default page value
else $page = $_GET[p];

//TODO: Rename $vars to $sid (for "school id")
//vars variable is used to identify
if(isset($_GET[vars])){
    if ($vars < 0 || $vars > 2) $vars = 0;
}else $vars = 0;

//course variable is used to determine the category of books a user is searching for.
if(isset($_GET[cat])){
    $category = urldecode($_GET[cat]);
}else $category = null;

//TODO: Validate and sanitize category input.
//cid variable is used to determine the course id of books currently being searched/browsed for
if(isset($_GET[cid])){
    $cid = urldecode($_GET[cid]);
}else $cid = null;

?>

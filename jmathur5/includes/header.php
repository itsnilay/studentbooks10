<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link href="includes/styles.css" rel="stylesheet" type="text/css" />
        <title>Wishlist Application</title>
    </head>
    <body>
        <div id = "wrapper">
                 <div id = "wrapper_inner">
                    <div id="main_nav">
                        <a href="index.php"><img src="./img/wishlistlogo.png"/></a>
                        <ul>
                          <li<?php if ($page_title=="wishlist home")
                                echo " id=\"currentpage\""; ?>>
                                <a href="index.php">Home</a>
                          </li>
                          <li<?php if ($page_title=="create wistlist")
                                echo " id=\"currentpage\""; ?>>
                                <a href="createNewWisher.php">Create new wisher</a>
                          </li>
                          <li<?php if ($page_title=="edit wishlist")
                                echo " id=\"currentpage\""; ?>>
                                <a href="wishlist.php">Wishlist</a>
                          </li>
                        </ul>
                    </div>

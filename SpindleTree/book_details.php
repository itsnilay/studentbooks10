<?php
$page_special = "BOOKS";
include('include/header.php');
include('include/book_details_api.php');
include_once('include/book.php');

if(isset($_GET[bkid]))
    $book = $dbInst->getBookById($_GET[bkid]);
//else
//    $book = $dbInst->getBookById(10001);

if (!isset($book)){
    echo '<p class="error">Book not found.</p>';
    include('include/footer.php');
    exit();
}
?>

<?php draw_book_details_main($book); ?>

<h2>Details</h2>

<ul id="used_books" class="span-18 last">
    <li class="odd">
        <span class="detail span-4">ISBN-13</span>
        <span class="detail-value span-6"><?php echo $book->getIsbn(); ?></span>
    </li>
    <li class="even">
        <span class="detail span-4">Page Count</span>
        <span class="detail-value span-6"><?php echo $book->getPageCount(); ?></span>
    </li>
    <li class="odd">
        <span class="detail span-4">Publisher</span>
        <span class="detail-value span-6"><?php echo $book->getPublisher(); ?></span>
    </li>
    <li class="even">
        <span class="detail span-4">Date Published</span>
        <span class="detail-value span-6"><?php echo $book->getMonthPublished() .'/'. $book->getDayPublished() .'/'. $book->getYearPublished(); ?></span>
    </li>
    <li class="odd">
        <span class="detail span-4">Language</span>
        <span class="detail-value span-6"><?php echo $book->getLanguage(); ?></span>
    </li>
    <li class="even">
        <span class="detail span-4">Dimensions</span>
        <span class="detail-value span-6"><?php echo $book->getLength() .'" x '. $book->getWidth() .'" x '. $book->getHeight() .'"'; ?></span>
    </li>
    <li class="odd">
        <span class="detail span-4">Weight</span>
        <span class="detail-value span-6"><?php echo $book->getWeight().' lb.'; ?></span>
    </li>
</ul>

<?php
include('include/footer.php');
?>
		
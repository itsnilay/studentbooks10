<?php

/**
 * @explanation
 * The shopping cart item is used as a convenient encapsulation of a number of
 * books of varying quantities.  This makes it easier to deal with adding
 * prices and quantities than if we used, for example, a set of arrays of Books.
 */
class ShoppingCartItem {
    private $book;
    private $new_quantity = 0;
    private $like_new_quantity = 0;
    private $very_good_quantity = 0;
    private $good_quantity = 0;
    private $terrible_quantity = 0;

    public function __construct($book, $quantity){
        $this->book = $book;
        $this->quantity = $quantity;
    }

    public function getTotalValue(){
        $value = 0.0;
        $value += $this->new_quantity * $this->book->getPrice();
        $value += $this->like_new_quantity * $this->book->getLikeNewPrice();
        $value += $this->very_good_quantity * $this->book->getVGoodPrice();
        $value += $this->good_quantity * $this->book->getGoodPrice();
        $value += $this->terible_quantity * $this->book ->getTerriblePrice();
        return $value;
    }

    public function getTotalQuantity(){
        return $this->new_quantity + $this->like_new_quantity + $this->very_good_quantity + $this->good_quantity + $this->terrible_quantity;
    }

    public function getNewQuantity(){
        return $this->new_quantity;
    }

    public function getLikeNewQuantity(){
        return $this->like_new_quantity;
    }

    public function getVeryGoodQuantity(){
        return $this->very_good_quantity;
    }

    public function getGoodQuantity(){
        return $this->good_quantity;
    }

    public function getTerribleQuantity(){
        return $this->terrible_quantity;
    }

    public function getBookId(){
        return $this->book->getBookId();
    }

    public function getAuthor(){
        return $this->book->getAuthor();
    }

    public function getTitle(){
        return $this->book->getTitle();
    }

    public function getIsbn(){
        return $this->book->getIsbn();
    }

    public function getPrice(){
        return $this->book->getPrice();
    }

    public function getYear(){
        return $this->book->getYear();
    }

    public function getCategory(){
        return $this->book->getCategory();
    }

    public function getPublisher(){
        return $this->book->getPublisher();
    }

    public function getDesc(){
        return $this->book->getDescription();
    }

    public function getBookImage(){
        return $this->book->getBookImage();
    }

    public function getLength(){
        return $this->book->getLength();
    }

    public function getWidth(){
        return $this->book->getWidth();
    }

    public function getHeight(){
        return $this->book->getHeight();
    }

    public function getWeight(){
        return $this->book->getWeight();
    }

    public function getPageCount(){
        return $this->book->getPageCount();
    }

    public function getFormat(){
        return $this->book->getFormat();
    }

    public function getLanguage(){
        return $this->book->getLanguage();
    }

    public function getYearPublished(){
        return $this->book->getYearPublished();
    }

    public function getMonthPublished(){
        return $this->book->getMonthPublished();
    }

    public function getDayPublished(){
        return $this->book->getDayPublished();
    }

    public function getEdition(){
        return $this->book->getEdition();
    }

    public function getLikeNewPrice(){
        return $this->book->getLikeNewPrice();
    }

    public function getLikeNewQuantity(){
        return $this->book->getLikeNewQuantity();
    }

    public function getVGoodPrice(){
        return $this->book->getVGoodPrice();
    }

    public function getVGoodQuantity(){
        return $this->book->getVGoodQuantity();
    }

    public function getGoodPrice(){
        return $this->book->getGoodPrice();
    }

    public function getGoodQuantity(){
        return $this->book->getGoodQuantity();
    }

    public function getTerriblePrice(){
        return $this->book->getTerriblePrice();
    }

    public function getTerribleQuantity(){
        return $this->book->getTerribleQuantity();
    }

    public function getBookstorePrice(){
        return $this->book->getBookstorePrice();
    }

    public function setNewQuantity($quantity){
        $this->book->new_quantity = $quantity;
    }

    public function setLikeNewQuantity($quantity){
        $this->like_new_quantity = $quantity;
    }

    public function setVeryGoodQuantity($quantity){
        $this->very_good_quantity = $quantity;
    }

    public function setGoodQuantity($quantity){
        $this->good_quantity = $quantity;
    }

    public function setTerribleQuantity($quantity){
        $this->terrible_quantity = $quantity;
    }
}

?>

<?php

/**
 * @explanation
 * The Shopping cart class is a singleton class used to represent a user's shopping
 * cart and keep track of the items the user purchases up to the checkout process.
 */
class ShoppingCart {
    private static $instance = null;
    public $items = array();

    /**
     * @explanation
     * This function is used to get an instance of the user's shopping cart.
     *
     * @return <ShoppingCar> an instance of the current shopping cart
     */
    public static function getInstance() {
        if (!self::$instance instanceof self) {
            self::$instance = new self;
        }
        return self::$instance;
    }

    /*
     * The clone and wakeup methods prevents external instantiation of copies of 
     * the Singleton class, thus eliminating the possibility of duplicate objects.
     */
    public function __clone() {
        trigger_error('Clone is not allowed.', E_USER_ERROR);
    }
    public function __wakeup() {
        trigger_error('Deserializing is not allowed.', E_USER_ERROR);
    }

    // private constructor
    private function __construct() {
        
    }

    /**
     * @explanation
     * Add a given number of items to the shopping cart.
     *
     * @param <Book> $book the item to be added to the shopping cart.
     * @param <uint> $quantity The number of the given item to be added to the cart.
     *
     * @author Andrew
     */
    public function addItem($book, $quantity, $condition){
        $id = $book->getBookId();
        if (array_key_exists($id, $this->items)){
            //add add item quantity to existing item
            $item = $this->items[$id];
            $item->setQuantity($item->getQuantity + $quantity);
        }else {
            //add a new item
            $items[$id] = new ShoppingCartItem($book, $quantity);
        }
    }

    /**
     * @explanation
     * Remove an item from the shopping cart, as specified by its ID.
     *
     * @param <uint> $id
     *
     * @author Andrew
     */
    public function deleteItem($id){
        unset($this->items[$id]);
    }

    /**
     * @explanation
     * Empty the contents of the entire cart.
     *
     * @author Andrew
     */
    public function emptyCart(){
        unset($this->items);
        $this->items = array();
    }

    /**
     * @explanation
     * Set the number of a specific item held by the shopping cart to the quantity specified.
     *
     * @param <uint> $id The ID of the item whose quantity is to be modified
     * @param <uint> $quantity The number of the specified book which the shopping cart is to hold.
     * @param <uint> $condition a condition constant as specified by the Book class.
     *
     * @author Andrew
     */
    public function setItemQuantity($id, $quantity, $condition){
        if (array_key_exists($id, $this->items)) {
            $item = $this->items[$id];

            //return quantity of items of given condition
            switch ($condition){
                case Book::CONDITION_NEW:
                    return $item->setNewQuantity($quantity);
                case Book::CONDITION_LIKE_NEW:
                    return $item->setLikeNewQuantity($quantity);
                case Book::CONDITION_VERY_GOOD:
                    return $item->setVeryGoodQuantity($quantity);
                case Book::CONDITION_GOOD:
                    return $item->setGoodQuantity($quantity);
                case Book::CONDITION_TERRIBLE:
                    return $item->setTerribleQuantity($quantity);
            }
        }
    }

    /**
     * @explanation
     * Get the quantity of items in the shopping cart of a given condition.
     *
     * @param <uint> $id the id of the item whose quantity we want to retrieve
     * @param <uint> $condition a condition constant as defined by the Book class
     * @return <uint> the quantity of items in the shopping cart of the given condition
     *
     * @author Andrew
     */
    public function getItemQuantity($id, $condition){
        if(array_key_exists($id, $this->items)){
            //get item
            $item = $this->items[$id];

            //return quantity of items of given condition
            switch ($condition){
                case Book::CONDITION_NEW:
                    return $item->getNewQuantity();
                case Book::CONDITION_LIKE_NEW:
                    return $item->getLikeNewQuantity();
                case Book::CONDITION_VERY_GOOD:
                    return $item->getVeryGoodQuantity();
                case Book::CONDITION_GOOD:
                    return $item->getGoodQuantity();
                case Book::CONDITION_TERRIBLE:
                    return $item->getTerribleQuantity();
            }
        }
        return 0;
    }

    /**
     * @explanation
     * Get the total cost of all items of all qualities in the cart.
     *
     * @return <float> the total cost of all items of all quantities in the cart
     *
     * @author Andrew
     */
    public function getTotalValue(){
        $value = 0.0;
        foreach($this->items as $item){
            $value += $item->getTotalValue();
        }
        return $value;
    }

    /**
     * @explanation
     * Get the total number of items in the shopping cart.
     *
     * @return <uint> the total number of items in the shopping cart.
     *
     * @author Andrew
     */
    public function getTotalQuantity(){
        $quantity = 0;
        foreach($this->items as $item){
            $quantity += $item->getTotalQuantity();
        }
        return $quantity;
    }

    /**
     * @explanation
     * Get the cost of shipping the cart.
     * TODO: Calculate zipcode.  We probably won't ever need this function, but it's nice to plan ahead.
     *
     * @param <string> $zipcode the zipcode to send the shopping cart contents to.
     *
     * @return <float> The total cost of shipping the contents of the cart.
     *
     * @author Andrew
     */
    public function getShippingCost($zipcode){
        return 0.0;
    }
}
?>
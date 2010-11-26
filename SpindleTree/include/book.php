<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
 class Book {
     // single instance of self shared among all instances
    private static $instance = null;
    public static $numOfBooks = 0;
    private  $bookid;
    private  $author;
    private  $title;
    private  $isbn;
    private  $price;
    private  $year;
    private  $category;
    private  $publisher;
    private  $description;
    private  $stocknew;
    private  $stocklikenew;
    private  $stockvgood;
    private  $stockgood;
    private  $bookimage;
    public  $row;

     //This method must be static, and must return an instance of the object if the object
    //does not already exist.
    public static function getInstance() {
        if (!self::$instance instanceof self) {
            self::$instance = new self;
        }
        return self::$instance;
    }

    public static function getNumOfBooks(){
        return self::$numOfBooks;
    }
    // The clone and wakeup methods prevents external instantiation of copies of the Singleton class,
    // thus eliminating the possibility of duplicate objects.
    public function __clone() {
        trigger_error('Clone is not allowed.', E_USER_ERROR);
    }
    public function __wakeup() {
        trigger_error('Deserializing is not allowed.', E_USER_ERROR);
    }

    public function __construct($row){
        
        $this->bookid = $row["bookid"];
        $this->author = $row["author"];
        $this->title = $row["title"];
        $this->isbn = $row["isbn"];
        $this->price = $row["price"];
        $this->year = $row["year"];
        $this->category = $row["category"];
        $this->publisher = $row["publisher"];
        $this->description = $row["description"];
        $this->stocknew = $row["stocknew"];
        $this->stocklikenew = $row["stocklikenew"];;
        $this->stockvgood = $row["stockvgood"];
        $this->stockgood = $row["stockgood"];
        $this->bookimage = $row['bookimage'];
        $this->row = $row;
        self::$numOfBooks++;
    }

    public function getBookId(){
        return $this->bookid;
    }

    public function getAuthor(){
        return $this->author;
    }

    public function getTitle(){
        return $this->title;
    }

    public function getIsbn(){
        return $this->isbn;
    }

    public function getPrice(){
        return $this->price;
    }

    public function getYear(){
        return $this->year;
    }

    public function getCategory(){
        return $this->category;
    }

    public function getPublisher(){
        return $this->publisher;
    }

    public function getDesc(){
        return $this->desc;
    }
    
    public function getBookImage(){
        return $this->bookimage;
    }

 }
?>

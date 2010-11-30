<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
 class Book {
     // single instance of self shared among all instances
    private static $instance = null;
    public static $numOfBooks = 0;
    public static $bookids = array();
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
    private  $height;
    private  $width;
    private  $length;
    private  $weight;
    private  $pagecount;
    private  $isbn13;
    private  $format;
    private  $yearpublished;
    private  $monthpublished;
    private  $daypublished;
    private  $language;
    private  $edition;
    private  $likenewprice;
    private  $likenewquantity;
    private  $vgoodprice;
    private  $vgoodquantity;
    private  $goodprice;
    private  $goodquantity;
    private  $terribleprice;
    private  $terriblequantity;
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

    public static function getBookIdsByCat($catid){
        if($catid != "default")
        {
            $result = SpindleTreeDB::getInstance()->getBookIdsByCat($catid);
            $bkids = array();
            while($row = mysql_fetch_array($result))
                $bkids[] = SpindleTreeDB::getInstance()->getBook($row['bookid']);
            return $bkids;
        }
        else
            return self::$bookids;
        
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

        //Create dummy values until we implement DB entries for the following
        $this->height = 1.3;
        $this->width = 7.4;
        $this->length = 9.1;
        $this->weight = 3;
        $this->pagecount = 792;
        $this->isbn13 = "978-0137035151";
        $this->format = "Hardcover";
        $this->publisher = "Addison Wesley";
        $this->yearpublished = 2010;
        $this->monthpublished = 3;
        $this->daypublished = 13;
        $this->language = "English";
        $this->edition = 8;
        $this->likenewprice = 60.75;
        $this->likenewquantity = 7;
        $this->vgoodprice = 40.50;
        $this->vgoodquantity = 22;
        $this->goodprice = 20.25;
        $this->goodquantity = 13;
        $this->terribleprice = 10.00;
        $this->terriblequantity = 5;

        self::$numOfBooks++;
        self::$bookids[] = $row["bookid"];
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

    public function getLength(){
        return $this->length;
    }

    public function getWidth(){
        return $this->width;
    }

    public function getHeight(){
        return $this->height;
    }

    public function getWeight(){
        return $this->weight;
    }

    public function getPageCount(){
        return $this->pagecount;
    }

    public function getIsbn13(){
        return $this->isbn13;
    }

    public function getFormat(){
        return $this->format;
    }

    public function getLanguage(){
        return $this->language;
    }

    public function getYearPublished(){
        return $this->yearpublished;
    }

    public function getMonthPublished(){
        return $this->monthpublished;
    }

    public function getDayPublished(){
        return $this->daypublished;
    }

    public function getEdition(){
        return $this->daypublished;
    }

    public function getLikeNewPrice(){
        return $this->likenewprice;
    }

    public function getLikeNewQuantity(){
        return $this->likenewquantity;
    }

    public function getVGoodPrice(){
        return $this->vgoodprice;
    }

    public function getVGoodQuantity(){
        return $this->vgoodquantity;
    }

    public function getGoodPrice(){
        return $this->goodprice;
    }

    public function getGoodQuantity(){
        return $this->goodquantity;
    }

    public function getTerriblePrice(){
        return $this->terribleprice;
    }

    public function getTerribleQuantity(){
        return $this->terriblequantity;
    }

 }
?>

<?php
#version 1.1 mysql_connect.php
#mysql_connect.php
// This file contains the database access information
// This file also establshes a connection to mySQL and selects the database
//This file also defines the escape_data() function

  class SpindleTreeDB {
  // single instance of self shared among all instances
    private static $instance = null;

    // db connection config vars
    private $user = "SpindleTree";
    private $pass = "sfsufauf10";
    private $dbName = "SpindleTree";
    private $dbHost = "hci.cs.sfsu.edu";

    private $con = null;
    public $book = array();

    //This method must be static, and must return an instance of the object if the object
    //does not already exist.
    public static function getInstance() {
        if (!self::$instance instanceof self) {
            self::$instance = new self;
        }
        return self::$instance;
    }

    // The clone and wakeup methods prevents external instantiation of copies of the Singleton class,
    // thus eliminating the possibility of duplicate objects.
    public function __clone() {
        trigger_error('Clone is not allowed.', E_USER_ERROR);
    }
    public function __wakeup() {
        trigger_error('Deserializing is not allowed.', E_USER_ERROR);
    }

    // private constructor
    private function __construct() {
        $this->con = mysql_connect($this->dbHost, $this->user, $this->pass)
            or die ("Could not connect to db: " . mysql_error());
        //SET NAMES sets client, results, and connection character sets
        mysql_query("SET NAMES 'utf8'");
        mysql_select_db($this->dbName, $this->con)
            or die ("Could not select db: " . mysql_error());
    }

    public function getBook($i){
        return $this->book[$i];
    }

    public function getBookById($id){
        return $this->book[$id-10000];
    }

    /*
    public function getBookById($id){
        $result = mysql_query("SELECT * FROM `book` where bookid='".$id."'");
        if (mysql_num_rows($result) > 0) return new Book($result);
        else return null;
    }
    */

    public function getAllBooks () {
        if($this->book){
            return $this->book;
        }else {
            $result = mysql_query("SELECT * FROM `book`");
            require_once("include/book.php");
            //$i = 10000;
            $i = 0;
            while($row = mysql_fetch_array($result)) {
                $this->book[$i]=new Book($row);
                $i++;
            }
            if (mysql_num_rows($result) > 0) return $result;
            else return null;
        }
    }

     public function getBookImage ($bookid) {
        $result = mysql_query("SELECT bookimage FROM `book` where bookid='".$bookid."'");
        if (mysql_num_rows($result) > 0)
        return $result;
        else
        return null;
    }

    public function getCategory ($schid) {
        $result = mysql_query("SELECT courseid,coursename FROM `course` where schoolid='".$schid."'");
        if (mysql_num_rows($result) > 0) return $result;
        else return null;
    }

    public function getCourseIds () {
        $result = mysql_query("SELECT courseid,coursename FROM `course`");
        if (mysql_num_rows($result) > 0) return $result;
        else return null;
    }

    public function getSchool () {
        $result = mysql_query("SELECT distinct schoolname FROM `course`");
        if (mysql_num_rows($result) > 0) return $result;
        else return null;
    }

    public function getBookIdsByCourseId ($cid) {
        $result = mysql_query("SELECT bookid FROM `course_book` where courseid='".$cid."'");
        if (mysql_num_rows($result) > 0) return $result;
        else return null;
    }

    public function getBookIdsByCategory ($category) {
        $result = mysql_query("SELECT bookid FROM `book` where category='".$category."'");
        if (mysql_num_rows($result) > 0) return $result;
        else return null;
    }

    public function getBooksByCourseId ($cid) {
        $cids = $this->getBookIdsByCourseId($cid);
        $numRows = mysql_num_rows($cids);
        if ($numRows > 0) {
            $books = array();
            while($bkid = mysql_fetch_array($cids)){
                $books[] = $this->getBookById($bkid['bookid']);
            }
            return $books;
        }
        return null;
    }

    public function getBooksByCategory ($category) {
        $result = mysql_query("SELECT * FROM `book` where category='".$category."'");
        if (mysql_num_rows($result) > 0) return $result;
        else return null;
    }

    public function getBookIdsBySchool ($sid) {
        //do some input checking just in case...
        if ($sid < 0 || $sid > 4)
            return null;

        //Get all the books that belong to a specific school.
        $cids = mysql_query("SELECT courseid FROM `course` where schoolid='".$sid."'");
        
        //Get ID's of books that belong to that school
        $rows = mysql_num_rows($cids);
        if ($rows > 0) {
            for ($i = 0; $i < $rows; $i++){
                $result = mysql_query("SELECT bookid FROM `course_book` where courseid='".$cids[i]."'");
            }

            if(mysql_num_rows($result) > 0){
                return $result;
            }else return null;
        }

    }
  }
    // Set the database access information as constants
    DEFINE ('DB_USER', 'SpindleTree');
    DEFINE ('DB_PASSWORD', 'sfsufauf10');
    DEFINE ('DB_HOST', 'hci.cs.sfsu.edu');
    DEFINE ('DB_NAME', 'SpindleTree');


    // Make the connection
    $dbc= @mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);

    if (!$dbc){// make the connection
         trigger_error('Could not connect to MySQL: '. mysqli_connect_error());
    }//end of !$dbc IF
?>
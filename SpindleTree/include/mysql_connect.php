<?php  #version 1.1 mysql_connect.php
#mysql_connect.php
// This file contains the database access information
// This file also establshes a connection to mySQL and selects the database
//This file also defines the escape_data() function


// Set the database access information as constants
//DEFINE ('DB_USER', 'SpindleTree');
//DEFINE ('DB_PASSWORD', 'sfsufauf10');
//DEFINE ('DB_HOST', 'localhost');
//DEFINE ('DB_NAME', 'SpindleTree');


// Make the connection
//$dbc= @mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);

//if (!$dbc){// make the connection
//	 trigger_error('Could not connect to MySQL: '. mysqli_connect_error($dbc));
//}//end of !$dbc IF
  class SpindleTreeDB {
  // single instance of self shared among all instances
    private static $instance = null;

    // db connection config vars
    private $user = "SpindleTree";
    private $pass = "sfsufauf10";
    private $dbName = "SpindleTree";
    private $dbHost = "hci.cs.sfsu.edu";

    private $con = null;

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

    public function get_all_books () {
        $result = mysql_query("SELECT * FROM `book`");
        if (mysql_num_rows($result) > 0)
        return $result;
        else
        return null;
    }

     public function get_book_image ($bookid) {
        $result = mysql_query("SELECT bookimage FROM `book` where bookid=".$bookid);
        if (mysql_num_rows($result) > 0)
        return $result;
        else
        return null;
    }
  }
?>
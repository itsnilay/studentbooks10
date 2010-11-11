<?php
  class WishDB {
  // single instance of self shared among all instances
    private static $instance = null;

    // db connection config vars
    private $user = "SpindleTree";
    private $pass = "sfsufauf2010";
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
        $result = mysql_query("SELECT * FROM book");
        if (mysql_num_rows($result) > 0)
        return mysql_result($result, 0);
        else
        return null;
    }
  }
?>
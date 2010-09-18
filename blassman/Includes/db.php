<?php
    class WishDB
    {
        //single instance of self shared among all instances
        private static $instance = null;

        // db connection config vars
        private $user = "blassman";
        private $pass = "sqlowl";
        private $dbName = "blassman";
        private $dbHost = "localhost";

        private $con = null;

        // private constructor
        private function __construct ()
        {
            $this->con = mysql_connect($this->dbHost, $this->user, $this->pass)
                    or die ("Could not connect to db: " . mysql_error());
            mysql_query("SET NAMES 'utf8'");
            mysql_select_db($this->dbName, $this->con)
                    or die ("Could not select db: " . mysql_error());
        }

        //This method must be static, and must return an instance of the object if the object
        //does not already exist.
        public static function getInstance ()
        {
            if (!self::$instance instanceof self)
                self::$instance = new self;
            return self::$instance;
        }

        public function create_wisher ($name, $password)
        {
            $name = mysql_real_escape_string($name);
            $password = mysql_real_escape_string($password);
            mysql_query("INSERT INTO wishers (name, password) VALUES ('" . $name . "', '" . $password . "')");
        }

        public function verify_wisher_credentials ($name, $password)
        {
            $name = mysql_real_escape_string($name);
            $password = mysql_real_escape_string($password);

            return mysql_num_rows(mysql_query("SELECT * FROM wishers WHERE name = '" . $name . "' AND password = '" . $password . "'"));
        }

        public function insert_wish ($wisherId, $description, $duedate)
        {
            $description = mysql_real_escape_string($description);
            return mysql_query("INSERT INTO wishes (wisher_id, description, due_date)" . 
                               " VALUES (" . $wisherId . ", '" . $description . "', " 
                               . $this->format_date_for_sql($duedate) . ")");
        }

        public function update_wish ($wishID, $description, $duedate)
        {
            $description = mysql_real_escape_string($description);
            return mysql_query("UPDATE wishes SET description = '" . $description . "',
                               due_date = " . $this->format_date_for_sql($duedate)
                               . " WHERE id =" . $wishID);
        }

        public function delete_wish ($wishID)
        {
            return mysql_query("DELETE FROM wishes WHERE id = " . $wishID);
        }

        public function format_date_for_sql ($date)
        {
            if ($date == "")
                return "NULL";
            else
            {
                $dateParts = date_parse($date);
                return $dateParts["year"]*10000 + $dateParts["month"]*100 + $dateParts["day"];
            }
        }

        public function is_valid_date ($date)
        {
            if ($date != "")
            {
                $dateParts = date_parse($date);
                return checkdate($dateParts["month"],$dateParts["day"],$dateParts["year"]);
            }
            else
                return true; // NOTE: blank date is considered valid
        }

        public function get_wisher ($name)
        {
            $name = mysql_real_escape_string($name);
            $result = mysql_query("SELECT * FROM wishers WHERE name = '" . $name . "'");
            if (mysql_num_rows($result) < 1)
                return null;
            return mysql_fetch_array($result);
        }

        public function get_wishes_by_wisher_id ($id)
        {
            return mysql_query("SELECT * FROM wishes WHERE wisher_id=" . $id);
        }

        public function get_wish_by_wish_id ($wishID)
        {
            return mysql_query("SELECT * FROM wishes WHERE id = " . $wishID);
        }

        // The clone and wakeup methods prevents external instantiation of copies of the Singleton class,
        // thus eliminating the possibility of duplicate objects.
        public function __clone ()
        {
            trigger_error('Clone is not allowed.', E_USER_ERROR);
        }

        public function __wakeup ()
        {
            trigger_error('Deserializing is not allowed.', E_USER_ERROR);
        }
    }
?>

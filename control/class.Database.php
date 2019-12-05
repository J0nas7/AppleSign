<?php
if (!defined("IN_APP")) { die("Access denied"); }

class DatabaseConfig {

  private $DatabaseConnect;
  private static $DBinstance = NULL;

  private function __construct() {
    if ($this->stripget($_GET)) { die("Prevented a XSS attack through a GET variable!"); }

    // Database configuration start
    $Servername = "mysql35.unoeuro.com";
    $Username = "applesign_dk";
    $Password = "rnceh2za";
    $Databasename = "applesign_dk_db";

    $this->DatabaseConnect = new mysqli($Servername, $Username, $Password, $Databasename);
    unset($Servername, $Username, $Password, $Databasename);
    if ($this->DatabaseConnect->connect_error) {
    	die('Kunne ikke forbinde til database ('.$this->DatabaseConnect->connect_errno.') '.$this->DatabaseConnect->connect_error);
    }
    $this->DatabaseConnect->set_Charset("utf8");
    define("DB_PREFIX", "App_");
    // Database configuration end
  }

  static function getInstance() {
      if (!self::$DBinstance) {
        self::$DBinstance = new DatabaseConfig();
      }
      return self::$DBinstance;
  }

  // Preventing XSS attack through a GET variable
  public function stripget($check_url) {
  	$return = false;
  	if (is_array($check_url)) {
  		foreach ($check_url as $value) {
  			if ($this->stripget($value) == true) {
  				return true;
  			}
  		}
  	} else {
  		$check_url = str_replace(array("\"", "\'"), array("", ""), urldecode($check_url));
  		if (preg_match("/<[^<>]+>/i", $check_url)) {
  			return true;
  		}
  	}
  	return $return;
  }

  // Securing a string before using in sql string
  public function res($string) {
  	if (!is_array($string)) {
  		$string = $this->DatabaseConnect->real_escape_string($string);
  		return $string;
  	} else {
  		return $string;
  	}
  }

  // Outputs a query from a sql string
  public function dbquery($query, $optional = "") {
  	//global $sql_connect, $mysql_queries_count, $mysql_queries_time; $mysql_queries_count++;

  	//$query_time = get_microtime();
  	$result = $this->DatabaseConnect->query($query);
  	//$query_time = substr((get_microtime() - $query_time),0,7);

  	//$mysql_queries_time[$mysql_queries_count] = array($query_time, $query, $optional);

  	if (!$result) {
  		echo $this->DatabaseConnect->error;
  		return false;
  	} else {
  		return $result;
  	}
  }

  // Returns the number of rows in a query
  public function dbcount($result) {
  	return $result->num_rows;
  }

  // Outputs an array from a query
  public function dbarray($result) {
  	$row = $result->fetch_assoc();
  	return $row;
  }

  public function getInsertID() {
    return mysqli_insert_id($this->DatabaseConnect);
  }

}
?>
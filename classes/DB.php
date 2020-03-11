<?php
require_once 'core/init.php';

class DB {
  private static $_instance = null; // Store instace of database
  private $_pdo, //this is going to represent when we instantiate the PDO object we're gonna store it here so we can use it elsewhere
          $_query, // last query we executed
          $_error = false, // store error
          $_results, // store our result sets
          $_count = 0; // results returned or not

  private function __construct() {
    try {
      $this->_pdo = new PDO('mysql:host=' . Config::get('mysql/host').';dbname=' . Config::get('mysql/db'), Config::get('mysql/username'), Config::get('mysql/password'));
    } catch(PDOException $e) {
      echo "Connection failed: " . $e->getMessage();
    }
  }

  public static function getInstance() {
    if(!isset(self::$_instance)) {
      self::$_instance = new DB();
    }
    return self::$_instance;
  }



}

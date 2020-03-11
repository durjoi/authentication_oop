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

  private function query($sql, $params = array()) {
    $this->_error = false; // Reset Error Message
    if($this->_query = $this->_pdo->prepare($sql)) {
      $x = 1;
      if(count($params)) {
        foreach ($params as $param) {
          $this->_query->bindValue($x, $param);
          $x++;
        }
      }
      if($this->_query->execute()) {
        $this->_results = $this->_query->fetchAll(PDO::FETCH_OBJ);
        $this->_count = $this->_query->rowCount();
      } else {
        $this->_error = true;
      }
    }
    return $this;
  }

  public function action($action, $table, $where = array()) {
     if(count($where) === 3) {
       $operators = array('=', '>', '<', '>=', '<=');

       $field     = $where[0];
       $operator  = $where[1];
       $value     = $where[2];

       if (in_array($operator, $operators)) {
         $sql = "{$action} FROM {$table} WHERE {$field} {$operator} ?";

         if(!$this->query($sql, array($value))->error()) {
           return $this->_results;
         }
       }
     }
  }

  public function get($table, $where = array()) {
    return $this->action('SELECT *', $table, $where);
  }

  public function delete($table, $where = array()) {
    return $this->action('DELETE', $table, $where);
  }

  public function error() {
    return $this->_error;
  }

  public function count() {
    return $this->_count;
  }



}

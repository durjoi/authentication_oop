<?php
session_start();

$GLOBALS['config'] = array(
  'mysql' => array(
    'host' => '127.0.0.1',
    'username' => 'root',
    'password' => '',
    'dbname' => 'authentication_oop'
  ),
  'remember' => array(
    'cookie_name' => 'hash',
    'cookie_expiry' => '604800'
  ),
  'session' => 'user'
);

function __autoload($class) {
  $path = $DOCUMENT_ROOT . '/classes';
  require_once $path . $class .'.php';
}

require_once 'function/sanitize.php';

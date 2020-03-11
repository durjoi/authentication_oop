<?php
session_start();

$GLOBALS['config'] = array(
  'mysql' => array(
    'host' => '127.0.0.1',
    'username' => 'root',
    'password' => '',
    'db' => 'authentication_oop'
  ),
  'remember' => array(
    'cookie_name' => 'hash',
    'cookie_expiry' => '604800'
  ),
  'session' => 'user'
);

function __autoload($class) {
  require_once 'classes/' . $class .'.php';
}

require_once 'functions/sanitize.php';

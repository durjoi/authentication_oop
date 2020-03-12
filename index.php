<?php
require_once 'core/init.php';

$user = DB::getInstance()->update('users', 1, array(
  'password' => 'newpassword',
));


?>

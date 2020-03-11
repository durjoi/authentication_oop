<?php
require_once 'core/init.php';

$user = DB::getInstance();
$users = $user->get("groups", array('id', '=', 9));

if($user->count()) {
  echo "ok";
} else {
  echo "No User";
}

?>

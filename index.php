<?php
require_once 'core/init.php';

$user = DB::getInstance()->get("groups", array('id', '=', 2));

if(!$user->count()) {
  echo "NO Data";
} else {
  echo $user->first()->name;
}

?>

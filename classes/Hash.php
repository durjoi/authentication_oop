<?php
class Hash {
  public static function make($string, $salt = '') {
    $options = [
      'cost' => 10,
    ];
    return password_hash($string, PASSWORD_BCRYPT, $options);
  }

  public static function salt($length) {
    return random_bytes($length);
  }

  public static function unique() {
    return self::make(uniqid());
  }
}

<?php

namespace App\Core;

// model base
class Model
{
  private static $instance;

  public static function getConn()
  { //se não existe uma instancia cria uma
    if (!isset(self::$instance)) {
      self::$instance = new \PDO('mysql:host=localhost;dbname=mvc;charset=utf8', 'root', '');
    }

    return self::$instance;
  }
}

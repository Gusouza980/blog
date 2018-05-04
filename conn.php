<?php


  class Conexao{

    public static function conecta(){
      $user = "root";
      $pass = "";
      $db = "blog";
      $server = "localhost";
      try {
        $conn = new PDO("mysql:host=$server;dbname=$db", $user, $pass);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conn;
      } catch(PDOException $e) {
        echo 'ERROR: ' . $e->getMessage();
      }
    }

  }
?>

<?php

  class Settings{

    public static function carregarSettings(){
      $conn = new Conexao();
      $result = $conn->select("SELECT * FROM settings");
      $row = $result[0];
      return $row;
    }

  }

?>

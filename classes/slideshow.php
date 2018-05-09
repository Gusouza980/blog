<?php

  class Slideshow{

    public static function carregarImagens(){
      $conn = new Conexao();
      $result = $conn->select("SELECT * FROM slideshow");
      return $result;
    }

  }

?>

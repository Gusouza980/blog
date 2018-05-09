<?php

  class Categoria{

    public static function novaCategoria($nome){
      $conn = new Conexao();

      $result = $conn->query("INSERT INTO categoria(nomeCategoria) VALUES(:nome)", array(
        ":nome"=>$nome
      ));
    }

    public static function retornaCategorias(){
      $conn = new Conexao();
      $result = $conn->select("SELECT * FROM categoria");
      return $result;
    }

    public static function deletarCategoria($id){
      $conn = new Conexao();
      $result = $conn->query("DELETE FROM categoria WHERE idCategoria = :id", array(
        ":id" => $id
      ));
    }

    public static function quantidadeCategorias(){
      return count(Categoria::retornaCategorias());
    }

  }

?>

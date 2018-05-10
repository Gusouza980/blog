<?php

  class Categoria{

    public static function novaCategoria($nome){
      $conn = new Conexao();
      if(Categoria::verificaCategoria($nome)){
        $result = $conn->query("INSERT INTO categoria(nomeCategoria) VALUES(:nome)", array(
          ":nome"=>$nome
        ));
        return true;
      }else{
        return false;
      }
    }

    public static function retornaCategorias(){
      $conn = new Conexao();
      $result = $conn->select("SELECT * FROM categoria");
      return $result;
    }

    public static function consultaCategoriaId($id){
      $conn = new Conexao();
      $result = $conn->select("SELECT * FROM categoria WHERE idCategoria = :id", array(
        ":id" => $id
      ));

      return $result[0];
    }

    public static function alterarCategoria($id, $novoNome){
      $conn = new Conexao();
      $result = $conn->query("UPDATE categoria SET nomeCategoria = :novoNome WHERE idCategoria = :id", array(
        ":id" => $id,
        ":novoNome" => $novoNome
      ));
    }

    private static function verificaCategoria($nome){
      $conn = new Conexao();
      $result = $conn->select("SELECT * FROM categoria WHERE nomeCategoria = :nome", array(
        ":nome" => $nome
      ));
      if(count($result) > 0){
        return false;
      }else{
        return true;
      }
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

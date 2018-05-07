<?php
  //include "conn.php";

  class Categoria{

    public function novaCategoria($nome){
      $conn = new Conexao();

      $result = $conn->query("INSERT INTO categoria(nomeCategoria) VALUES(:nome)", array(
        ":nome"=>$nome
      ));
    }

    public function retornaCategorias(){
      $conn = new Conexao();
      $result = $conn->select("SELECT * FROM categoria");
      return $result;
    }

    public function deletarCategoria($id){
      $conn = new Conexao();
      $result = $conn->query("DELETE FROM categoria WHERE idCategoria = :id", array(
        ":id" => $id
      ));
    }

  }

?>

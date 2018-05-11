<?php

  class Settings{

    public static function carregarSettings(){
      $conn = new Conexao();
      $result = $conn->select("SELECT * FROM settings");
      $row = $result[0];
      return $row;
    }

    public static function alterarSettings($id, $nome, $email, $telefone){
      $conn = new Conexao();
      $result = $conn->query("UPDATE settings 
                              SET nomeSite = :nome, emailSite = :email, telefoneSite = :telefone 
                              WHERE idSite = :id", array(
        ":nome" => $nome,
        ":email" => $email,
        ":telefone" => $telefone,
        ":id" => $id
      ));
    }

  }

?>

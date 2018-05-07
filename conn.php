<?php


  class Conexao extends PDO{

    private $conn;

    // Função que executa a conexão com o banco
    public function __construct(){

      $user = "root";
      $pass = "";
      $db = "blog";
      $server = "localhost";

      $this->conn = new PDO("mysql:host=$server;dbname=$db", $user, $pass);
    }

    // Seta os parametros da consulta no banco
    private function setParams($stmt, $params = array()){
      foreach ($params as $key => $value) {
        $this->setParam($stmt, $key, $value);
      }
    }

    // Faz o bind de um único parâmetro
    private function setParam($stmt, $key, $value){
      $stmt->bindParam($key, $value);
    }

    //Executa a query no banco
    public function query($query, $params = array()){
      $stmt = $this->conn->prepare($query);
      $this->setParams($stmt, $params);

      $stmt->execute();

      return $stmt;
    }

    //Caso a query seja de SELECT, chame essa função que retornará um array com os dados
    public function select($query, $params = array()){
      $stmt = $this->query($query, $params);
      return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

  }
?>

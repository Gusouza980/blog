<?php

  class Usuario{

    private $idUsuario;
    private $emailUsuario;
    private $nomeUsuario;
    private $senhaUsuario;

    public function logar($email, $senha){

        $conn = new Conexao();

        $result = $conn->select("SELECT * FROM usuario WHERE emailUsuario = :email", array(
          ":email"=>$email
        ));

        if(isset($result[0])){
          $row = $result[0];
          if($row['senhaUsuario'] == $senha){
            $this->setDados($row);
            return true;
          }else{
            return false;
          }
        }else{
          return false;
        }
    }

    public static function carregaUsuarios(){
      $conn = new Conexao();
      $result = $conn->select("SELECT * FROM usuario");

      return $result;
    }

    public static function novoUsuario($nomeUsuario, $emailUsuario, $senhaUsuario){

      $conn = new Conexao();
      if(Usuario::verificaUsuarioEmail($emailUsuario)){
        $result = $conn->query("INSERT INTO usuario(nomeUsuario, emailUsuario, senhaUsuario) 
                                VALUES (:nome, :email, :senha)", array(
            ":nome" =>$nomeUsuario,
            ":email"=>$emailUsuario,
            ":senha"=>$senhaUsuario
        ));
        return true;
      }else{
        return false;
      }
    }

    public static function verificaUsuarioEmail($email){
      $conn = new Conexao();

      $result = $conn->select("SELECT * FROM usuario WHERE emailUsuario = :email", array(
        ":email"=>$email
      ));

      if(count($result) > 0){
        return false;
      }else{
        return true;
      }
    }

    public static function consultaUsuarioId($id){
      $conn = new Conexao();

      $result = $conn->select("SELECT * FROM usuario WHERE idUsuario = :id", array(
        ":id"=>$id
      ));

      return $result[0];

    }

    public static function alterarUsuario($id, $nome, $email, $senha){
      $conn = new Conexao();
      $result = $conn->query("UPDATE usuario 
                              SET nomeUsuario = :novoNome, emailUsuario = :novoEmail, senhaUsuario = :novaSenha 
                              WHERE idUsuario = :id", array(
        ":id" => $id,
        ":novoNome" => $nome,
        ":novoEmail" => $email,
        ":novaSenha" => $senha
      ));
    }

    public static function deletarUsuario($id){
      $conn = new Conexao();

      $result = $conn->query("DELETE FROM usuario WHERE idUsuario = :idUsuario", array(
        ":idUsuario" => $id
      ));
    }

    private function setDados($usuario = array()){
      $this->setIdUsuario($usuario["idUsuario"]);
      $this->setEmailUsuario($usuario["emailUsuario"]);
      $this->setNomeUsuario($usuario["nomeUsuario"]);
      $this->setSenhaUsuario($usuario["senhaUsuario"]);
    }

    //-----------------ID---------------------------------------------

    public function getIdUsuario(){
      return $this->idUsuario;
    }

    private function setIdUsuario($id){
      $this->idUsuario = $id;
    }

    //-------------EMAIL-------------------------------------------------

    public function getEmailUsuario(){
      return $this->emailUsuario;
    }

    public function setEmailUsuario($email){
      $this->emailUsuario = $email;
    }

    //-----------------NOME---------------------------------------------

    public function getNomeUsuario(){
      return $this->nomeUsuario;
    }

    public function setNomeUsuario($nome){
      $this->nomeUsuario = $nome;
    }

    //-----------------SENHA---------------------------------------------

    public function getSenhaUsuario(){
      return $this->senhaUsuario;
    }

    public function setSenhaUsuario($senha){
      $this->senhaUsuario = $senha;
    }

  }

?>

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

    private function setDados($usuario = array()){
      $this->setEmailUsuario($usuario["emailUsuario"]);
      $this->setNomeUsuario($usuario["nomeUsuario"]);
      $this->setSenhaUsuario($usuario["senhaUsuario"]);
    }

    //-----------------ID---------------------------------------------

    public function getIdUsuario(){
      return $this->idUsuario;
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

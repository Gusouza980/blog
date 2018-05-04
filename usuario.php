<?php
  include "conn.php";

  class Usuario{

    public static function verificaLogin($email, $senha){
        $PDO = Conexao::conecta();
        $sql = "SELECT * FROM usuario WHERE emailUsuario = :email";
        $stmt = $PDO->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $resultado = $stmt->fetchAll();
        if(!empty($resultado)){
          return true;
        }else{
          return false;
        }
    }

  }

?>

<?php

  class Noticia{

    public static function novaNoticia($idUsuario, $idCategoria, $imagemNoticia, $tituloNoticia, $conteudoNoticia, $fonteNoticia){
      $conn = new Conexao();

      $result = $conn->query("INSERT INTO noticia(idUsuario, idCategoria, imagemNoticia, tituloNoticia, conteudoNoticia, fonteNoticia)
      VALUES (:idUsuario, :idCategoria, :imagemNoticia, :tituloNoticia, :conteudoNoticia, :fonteNoticia)", array(
        ":idUsuario" => $idUsuario,
        ":idCategoria" => $idCategoria,
        ":imagemNoticia" => $imagemNoticia,
        ":tituloNoticia" => $tituloNoticia,
        ":conteudoNoticia" => $conteudoNoticia,
        ":fonteNoticia" => $fonteNoticia
      ));

    }

    public static function retornaNoticias(){
      $conn = new Conexao();
      $result = $conn->select("SELECT * FROM noticia");
      return $result;
    }

    public static function retornaNoticiasDecre(){
      $conn = new Conexao();
      $result = $conn->select("SELECT * FROM noticia ORDER BY idNoticia DESC");
      return $result;
    }

    public static function consultaNoticiaPorId($id){
      $conn = new Conexao();
      $result = $conn->select("SELECT * FROM noticia WHERE idNoticia = :idNoticia", array(
        ":idNoticia" => $id
      ));
      $row = $result[0];
      return $row;
    }

    public static function quantidadeNoticias(){
      return count(Noticia::retornaNoticias());
    }
  

  }

?>

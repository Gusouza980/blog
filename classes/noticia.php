<?php

  class Noticia{

    public static function novaNoticia($idUsuario, $idCategoria, $imagemNoticia, $tituloNoticia, $conteudoNoticia, $fonteNoticia){
      $conn = new Conexao();

      $data = date("Y-m-d H:i:s");
      
      try{
        $result = $conn->query("INSERT INTO noticia(idUsuario, idCategoria, imagemNoticia, tituloNoticia, conteudoNoticia, fonteNoticia, dataNoticia)
        VALUES (:idUsuario, :idCategoria, :imagemNoticia, :tituloNoticia, :conteudoNoticia, :fonteNoticia, :dataNoticia)", array(
          ":idUsuario" => $idUsuario,
          ":idCategoria" => $idCategoria,
          ":imagemNoticia" => $imagemNoticia,
          ":tituloNoticia" => $tituloNoticia,
          ":conteudoNoticia" => $conteudoNoticia,
          ":fonteNoticia" => $fonteNoticia,
          ":dataNoticia" => $data
        ));
        return true;
      }catch(Exception $ex){
        echo ($ex);
      }
      

    }

    public static function alterarNoticiaSemImagem($idNoticia, $idCategoria, $tituloNoticia, $conteudoNoticia, $fonteNoticia){
      $conn = new Conexao();

      $result = $conn->query("UPDATE noticia 
                              SET idCategoria = :idCategoria, tituloNoticia = :tituloNoticia, conteudoNoticia = :conteudoNoticia, fonteNoticia = :fonteNoticia
                              WHERE idNoticia = :idNoticia", array(
          ":idCategoria" => $idCategoria,
          ":tituloNoticia" => $tituloNoticia,
          ":conteudoNoticia" => $conteudoNoticia,
          ":fonteNoticia" => $fonteNoticia,
          ":idNoticia" => $idNoticia
        ));
    }

    public static function alterarNoticiaComImagem($idNoticia, $idCategoria, $tituloNoticia, $conteudoNoticia, $fonteNoticia, $imagem){
      $conn = new Conexao();

      $result = $conn->query("UPDATE noticia 
                              SET idCategoria = :idCategoria, tituloNoticia = :tituloNoticia, imagemNoticia = :imagemNoticia, conteudoNoticia = :conteudoNoticia, fonteNoticia = :fonteNoticia
                              WHERE idNoticia = :idNoticia", array(
          ":idCategoria" => $idCategoria,
          ":tituloNoticia" => $tituloNoticia,
          ":conteudoNoticia" => $conteudoNoticia,
          ":fonteNoticia" => $fonteNoticia,
          ":idNoticia" => $idNoticia,
          ":imagemNoticia" => $imagem
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

    public static function insereImagemGaleria($idNoticia, $imagem){
      $conn = new Conexao();
      $result = $conn->query("INSERT INTO galeria(idNoticia, imagem) VALUES(:id, :imagem)", array(
          ":id"=>$idNoticia,
          ":imagem"=>$imagem
        ));
    }

    public static function retornaGaleriaPorId($id){
      $conn = new Conexao();
      $result = $conn->select("SELECT * FROM galeria WHERE idNoticia = :idNoticia", array(
        ":idNoticia" => $id
      ));
      return $result;
    }

    public static function deletarImagemGaleria($imagem){
      $conn = new Conexao();
      $result = $conn->query("DELETE FROM galeria WHERE imagem = :imagem", array(
        ":imagem" => $imagem
      ));
    }

    public static function quantidadeNoticias(){
      return count(Noticia::retornaNoticias());
    }
  

  }

?>

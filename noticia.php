<?php

  class Noticia{

    private $idNoticia;
    private $idUsuario;
    private $idCategoria;
    private $imagemNoticia;
    private $tituloNoticia;
    private $conteudoNoticia;
    private $fonteNoticia;

    public function novaNoticia($idUsuario, $idCategoria, $imagemNoticia, $tituloNoticia, $conteudoNoticia, $fonteNoticia){
      $conn = new Conexao();

      $result = $conn->query("INSERT INTO noticia(idUsuario, idCategoria, imagemNoticia, tituloNoticia, conteudoNoticia, fonteNoticia)
      VALUES (:idUsuario, :idCategoria, :imagemNoticia, :tituloNoticia, :conteudoNoticia, :fonteNoticia)", array(
        ":idUsuario" => $idUsuario,
        ":idCategoria" => $idCategoria,
        ":imagemNoticia" => $imagemNoticia,
        ":tituloNoticia" => $tituloNoticia,
        ":conteudoNoticia" => $conteudoNoticia,
        ":fonteNoticia" => $fonteNoticia
      )));

    }

    public function retornaNoticias(){
      $conn = new Conexao();
      $result = $conn->select("SELECT * FROM noticia");
      return $result;
    }

    public function consultaNoticiaPorId($id){
      $conn = new Conexao();
      $result = $conn->select("SELECT * FROM noticia WHERE idNoticia = :idNoticia", array(
        ":idNoticia" => $id
      ));
      $row = $result[0];
      return $row;
    }

  }

?>

<?php
    include "conn.php";
    include "noticia.php";
    include "categoria.php";
    include "usuario.php";

    //Noticia::novaNoticia(1,1,"assets/images/slider2.png","Lol manero","Conteudo teste","riotgames.com");
    $result = Noticia::retornaNoticiasDecre();
    json_encode($result);
?>
<?php

  include "../classes/includes.php";

  session_start();

  if(isset($_POST["sair"])){
    session_destroy();
    header("Location: login.php");
  }

  if(!isset($_SESSION["usuario"])){
    header("Location: login.php");
  }else{
      $usuario = $_SESSION["usuario"];
  }

  if(isset($_SESSION["settings"])){
      $settings = $_SESSION["settings"];
  }else{
      $settings = Settings::carregarSettings();
      $_SESSION["settings"] = $settings;
  }

  $noticias = Noticia::retornaNoticias();

?>

<?php include "admin_header.php"; ?>

<body>
    <div id="wrapper">
        <!-- Include da navbar -->
        <?php include "admin_nav.php" ?>
        <div id="page-wrapper">
            <div id="page-inner">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        Notícias Publicadas
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover" data-height="400" data-page-size="10" data-pagination="true" data-toggle="table" data-search="true">
                                <thead>
                                    <tr>
                                        <th>Imagem</th>
                                        <th>Titulo</th>
                                        <th>Galeria</th> 
                                        <th>Editar</th>                           
                                        <th>Excluir</th>                                                                              
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($noticias as $noticia){?>
                                        <tr>
                                            <td>
                                                <img src="../<?php echo $noticia["imagemNoticia"]; ?>" width="70px"  />
                                            </td>
                                            <td>
                                                <?php echo $noticia["tituloNoticia"]; ?>
                                            </td>
                                            <td>
                                                <a href="galeria_post.php?noticia=<?php echo $noticia["idNoticia"]; ?>">
                                                    <button class="btn btn-sm btn-success">Editar Galeria</button>
                                                </a>
                                            </td>
                                            <td>
                                                <a href="novo_post.php?editar=<?php echo $noticia["idNoticia"]; ?>">
                                                    <button class="btn btn-sm btn-default">Editar Notícia</button>
                                                </a>
                                            </td>
                                            <td>
                                                <a href="lista_post.php?excluir=<?php echo $noticia["idNoticia"]; ?>">
                                                    <button class="btn btn-sm btn-danger">Excluir</button>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php };?>                                  
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php include "admin_footer.php"; ?>

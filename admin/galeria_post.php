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

  if(isset($_GET["excluir"])){
      Noticia::deletarImagemGaleria($_GET["excluir"]);
      header("Location:galeria_post.php?noticia=" . $_GET["noticia"]);
  }

  if(isset($_POST["novaImagem"])){
    if(isset($_FILES["imagem"])){
        $root = ".." . DIRECTORY_SEPARATOR;
        $diretorioImagem = "assets". DIRECTORY_SEPARATOR . "images" . DIRECTORY_SEPARATOR . date("dmyHis") . $_FILES["imagem"]["name"];
        $diretorioUpload = $root . "assets". DIRECTORY_SEPARATOR . "images" . DIRECTORY_SEPARATOR . date("dmyHis") . $_FILES["imagem"]["name"];
        Noticia::insereImagemGaleria($_GET["noticia"], $diretorioImagem);
        $arquivo = $_FILES['imagem']['tmp_name'];
        move_uploaded_file( $arquivo, $diretorioUpload );
    }

  }

  $galeria = Noticia::retornaGaleriaPorId($_GET["noticia"]);

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
                        Inserir nova imagem
                    </div>
                    <div class="panel-body">
                        
                        <form action="#" method="post" role="form" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label class="control-label col-lg-4">Imagem de Destaque</label>
                                    <div class="">
                                        <div class="fileupload fileupload-new" data-provides="fileupload">
                                            <div class="fileupload-preview thumbnail align-left" style="width: 200px; height: 150px;"></div>
                                            <div>
                                                <span class="btn btn-file btn-success">
                                                <span class="fileupload-new">Selecionar Imagem</span>
                                                <span class="fileupload-exists">Mudar</span>
                                                <input type="file" name="imagem"></span>
                                                <a href="#" class="btn btn-danger fileupload-exists" data-dismiss="fileupload">Remover</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <button class="btn btn-info" name="novaImagem" type="submit">Salvar</button>
                        </form>

                    </div>
                </div>
                <div class="panel panel-info">
                    <div class="panel-heading">
                        Imagens na galeria
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover" data-height="400" data-page-size="10" data-pagination="true" data-toggle="table" data-search="true">
                                <thead>
                                    <tr>
                                        <th>Imagem</th>
                                        <th>Excluir</th>                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($galeria as $imagem){?>
                                        <tr>
                                            <td>
                                                <img src="../<?php echo $imagem["imagem"]; ?>" width="70px"  />
                                            </td>
                                            <td>
                                                <a href="galeria_post.php?noticia=<?php echo $_GET["noticia"]; ?>&excluir=<?php echo $imagem["imagem"]; ?>">
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

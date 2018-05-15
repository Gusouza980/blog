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

  if(isset($_POST["novaNoticia"])){
    if(isset($_POST["titulo"]) && isset($_POST["categoria"]) && isset($_POST["fonte"]) && isset($_POST["conteudo"]) && isset($_FILES["imagem"])){
        
        $idUsuario = $usuario->getIdUsuario();
        $titulo = $_POST["titulo"];
        $idCategoria = $_POST["categoria"];
        $fonte = $_POST["fonte"];
        $conteudo = $_POST["conteudo"];
        $root = ".." . DIRECTORY_SEPARATOR;
        $diretorioImagem = "assets". DIRECTORY_SEPARATOR . "images" . DIRECTORY_SEPARATOR . date("dmyHis") . $_FILES["imagem"]["name"];
        $diretorioUpload = $root . "assets". DIRECTORY_SEPARATOR . "images" . DIRECTORY_SEPARATOR . date("dmyHis") . $_FILES["imagem"]["name"];
        
        $teste = Noticia::novaNoticia($idUsuario, $idCategoria, $diretorioImagem, $titulo, $conteudo, $fonte);
        if($teste){
            $arquivo = $_FILES['imagem']['tmp_name'];
            move_uploaded_file( $arquivo, $diretorioUpload );

        }
        
    }
  }
  if(isset($_GET["editar"])){
      $editar = true;
      $noticia = Noticia::consultaNoticiaPorId($_GET["editar"]);
  }
  
  if(isset($_POST["editarNoticia"])){
    if(isset($_POST["titulo"]) && isset($_POST["categoria"]) && isset($_POST["fonte"]) && isset($_POST["conteudo"])){
       
        $titulo = $_POST["titulo"];
        $idCategoria = $_POST["categoria"];
        $fonte = $_POST["fonte"];
        $conteudo = $_POST["conteudo"];

        if($_FILES["imagem"]["name"] != ""){
            $root = ".." . DIRECTORY_SEPARATOR;
            $diretorioImagem = "assets". DIRECTORY_SEPARATOR . "images" . DIRECTORY_SEPARATOR . date("dmyHis") . $_FILES["imagem"]["name"];
            $diretorioUpload = $root . "assets". DIRECTORY_SEPARATOR . "images" . DIRECTORY_SEPARATOR . date("dmyHis") . $_FILES["imagem"]["name"];
            Noticia::alterarNoticiaComImagem($_GET["editar"],$idCategoria,$titulo,$conteudo,$fonte,$diretorioImagem);
            $arquivo = $_FILES['imagem']['tmp_name'];
            move_uploaded_file( $arquivo, $diretorioUpload );
        }else{          
            Noticia::alterarNoticiaSemImagem($_GET["editar"],$idCategoria,$titulo,$conteudo,$fonte);
        }

        header("Location:lista_post.php");
    }
  }

  $categorias = Categoria::retornaCategorias();
  

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
                        Nova notícia
                    </div>
                    <div class="panel-body">

                        <?php if(isset($editar)){ ?>

                            <form action="#" method="post" role="form" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="titulo">Título</label>
                                    <input type="text" class="form-control" name="titulo" value="<?php echo $noticia['tituloNoticia'] ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="categoria">Categoria</label>
                                    <select name="categoria" class="form-control">
                                        <?php foreach($categorias as $categoria){ ?>
                                            <?php if($noticia["idCategoria"] == $categoria["idCategoria"]){ ?>
                                                <option value="<?php echo $categoria['idCategoria']; ?>" selected>
                                                    <?php echo $categoria['nomeCategoria']; ?>
                                                </option>
                                            <?php } else{ ?>
                                                <option value="<?php echo $categoria['idCategoria']; ?>">
                                                    <?php echo $categoria['nomeCategoria']; ?>
                                                </option>
                                            <?php } ?>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-lg-4">Imagem de Destaque</label>
                                    <div class="">
                                        <div class="fileupload fileupload-new" data-provides="fileupload">
                                            <div class="fileupload-preview thumbnail align-left" style="width: 200px; height: 150px;"></div>
                                            <div>
                                                <span class="btn btn-file btn-success"><span class="fileupload-new">Selecionar Imagem</span><span class="fileupload-exists">Mudar</span><input type="file" name="imagem"></span>
                                                <a href="#" class="btn btn-danger fileupload-exists" data-dismiss="fileupload">Remover</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="categoria">Conteúdo</label>
                                    <textarea id="summernote" class="form-control" name="conteudo" required><?php echo $noticia["conteudoNoticia"] ?></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="titulo">Fonte</label>
                                    <input type="text" class="form-control" name="fonte" value="<?php echo $noticia['fonteNoticia'] ?>"required/>
                                </div>
                                <button class="btn btn-info" name="editarNoticia" type="submit">Salvar</button>
                            </form>

                        <?php }else{ ?>

                            <form action="#" method="post" role="form" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="titulo">Título</label>
                                    <input type="text" class="form-control" name="titulo" required/>
                                </div>
                                <div class="form-group">
                                    <label for="categoria">Categoria</label>
                                    <select name="categoria" class="form-control">
                                        <?php foreach($categorias as $categoria){ ?>

                                             <option value="<?php echo $categoria['idCategoria']; ?>">
                                                <?php echo $categoria['nomeCategoria']; ?>
                                             </option>

                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-lg-4">Imagem de Destaque</label>
                                    <div class="">
                                        <div class="fileupload fileupload-new" data-provides="fileupload">
                                            <div class="fileupload-preview thumbnail align-left" style="width: 200px; height: 150px;"></div>
                                            <div>
                                                <span class="btn btn-file btn-success"><span class="fileupload-new">Selecionar Imagem</span><span class="fileupload-exists">Mudar</span><input type="file" name="imagem" required></span>
                                                <a href="#" class="btn btn-danger fileupload-exists" data-dismiss="fileupload">Remover</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="categoria">Conteúdo</label>
                                    <textarea id="summernote" class="form-control" name="conteudo" required></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="titulo">Fonte</label>
                                    <input type="text" class="form-control" name="fonte" required/>
                                </div>
                                <button class="btn btn-info" name="novaNoticia" type="submit">Salvar</button>
                            </form> 

                        <?php }; ?>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</body>

<?php include "admin_footer.php"; ?>
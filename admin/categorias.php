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
  
  if(isset($_POST["categoria"])){
      $teste = Categoria::novaCategoria($_POST["categoria"]);
  } 
  
  if(isset($_POST["editarCategoria"]) && isset($_POST["idCategoria"])){
      Categoria::alterarCategoria($_POST["idCategoria"], $_POST["editarCategoria"]);
      header("Location: categorias.php");
  }

  if(isset($_GET["editar"])){
      $editar = true;
      $idCategoria = $_GET["editar"];
      $categoriaEditar = Categoria::consultaCategoriaId($idCategoria);
  };

  if(isset($_GET["excluir"])){
      Categoria::deletarCategoria($_GET["excluir"]);
      header("Location:categorias.php");
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
                        Cadastrar categoria
                    </div>
                    <div class="panel-body">
                        <?php 
                            if(isset($teste)){
                                if($teste){
                                    echo "<div class='alert alert-success'>Categoria cadastrada com sucesso!</div>";
                                }else{
                                    echo "<div class='alert alert-warning'>Essa categoria já existe!</div>";
                                }
                            }
                        ?>
                        <?php if(!isset($editar)){ ?>

                            <form action="#" method="post" role="form">
                                <div class="form-group">
                                    <label for="categoria">Nome da categoria</label>
                                    <input type="text" class="form-control" name="categoria" required/>
                                </div>
                                <button class="btn btn-info" type="submit">Salvar</button>
                            </form>

                        <?php }else{ ?>

                            <form action="#" method="post" role="form">
                                <input type="hidden" name="idCategoria" value="<?php echo $categoriaEditar["idCategoria"] ?>">
                                <div class="form-group">
                                    <label for="categoria">Escolha um novo nome pra categoria: <?php echo $categoriaEditar["nomeCategoria"]; ?> </label>
                                    <input type="text" class="form-control" name="editarCategoria" value="<?php echo $categoriaEditar["nomeCategoria"]; ?>" required/>
                                </div>
                                <button class="btn btn-info" type="submit">Salvar</button>
                                <a href="categorias.php"><button class="btn btn-danger" type="">Cancelar</button></a>

                            </form>

                        <?php }; ?>
                    </div>
                </div>
                <div class="panel panel-info">
                    <div class="panel-heading">
                        Categorias cadastradas
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nome</th>
                                        <th>Editar</th>
                                        <th>Excluir</th>                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($categorias as $categoria){?>
                                        <tr>
                                            <td>
                                                <?php echo $categoria["idCategoria"]; ?>
                                            </td>
                                            <td>
                                                <?php echo $categoria["nomeCategoria"]; ?>
                                            </td>
                                            <td>
                                                <a href="categorias.php?editar=<?php echo $categoria["idCategoria"]; ?>">
                                                    <button class="btn btn-sm btn-default">Editar</button>
                                                </a>
                                            </td>
                                            <td>
                                                <a href="categorias.php?excluir=<?php echo $categoria["idCategoria"]; ?>">
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
</body>

<?php include "admin_footer.php"; ?>
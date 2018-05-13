<?php

  include "../classes/includes.php";

  session_start();

  if(isset($_SESSION["excluido"])){
      $_SESSION["excluido"] = null;
  }

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
  
  if(isset($_POST["novoUsuario"])){
      if(isset($_POST["nomeUsuario"]) && isset($_POST["emailUsuario"]) && isset($_POST["senhaUsuario"])){
        if($_POST["nomeUsuario"] != "" && $_POST["emailUsuario"] != "" && $_POST["senhaUsuario"] != ""){
            $teste = Usuario::novoUsuario($_POST["nomeUsuario"], $_POST["emailUsuario"], $_POST["senhaUsuario"]);
            if(!$teste){
                $mensagem = "Já existe um usuário cadastrado com esse email";
            }
        }else{
            $teste = false;
            $mensagem = "Preencha todos os campos corretamente";
        }       
    }     
  } 
  
  if(isset($_POST["editarUsuario"])){
    if(isset($_POST["idUsuario"]) && isset($_POST["nomeUsuario"]) && isset($_POST["emailUsuario"]) && isset($_POST["senhaUsuario"])){
        Usuario::alterarUsuario($_POST["idUsuario"], $_POST["nomeUsuario"],$_POST["emailUsuario"],$_POST["senhaUsuario"]);
        $_SESSION["editar"] = true;
        header("Location: usuarios.php");
    }
  }

  if(isset($_GET["editar"])){
      $editar = true;
      $idUsuario = $_GET["editar"];
      $usuarioEditar = Usuario::consultaUsuarioId($idUsuario);
  };

  if(isset($_GET["excluir"])){
      Usuario::deletarUsuario($_GET["excluir"]);
      $_SESSION["excluido"] = "excluiu";
      header("Location:usuarios.php");
  }

  $usuarios = Usuario::carregaUsuarios();

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
                        Cadastrar usuário
                    </div>
                    <div class="panel-body">
                        <?php 
                            if(isset($teste)){
                                if(!$teste){
                                    echo "<div class='alert alert-warning'>Já existe um usuário com esse email</div>";
                                }
                            }
                        ?>
                        <?php if(!isset($editar)){ ?>
                            
                            <form action="#" method="post" role="form">
                                <div class="form-group">
                                    <label for="nomeUsuario">Nome</label>
                                    <input type="text" class="form-control" name="nomeUsuario" required/>
                                </div>
                                <div class="form-group">
                                    <label for="emailUsuario">Email</label>
                                    <input type="text" class="form-control" name="emailUsuario" required/>
                                </div>
                                <div class="form-group">
                                    <label for="senhaUsuario">Senha</label>
                                    <input type="password" class="form-control" name="senhaUsuario" required/>
                                </div>
                                <button class="btn btn-info" type="submit" name="novoUsuario">Salvar</button>
                            </form>

                        <?php }else{ ?>

                        <form action="#" method="post" role="form">
                            <input type="hidden" name="idUsuario" value="<?php echo $usuarioEditar["idUsuario"] ?>">
                            <div class="form-group">
                                <label for="categoria">Novo nome:</label>
                                <input type="text" class="form-control" name="nomeUsuario" value="<?php echo $usuarioEditar["nomeUsuario"]; ?> " required/>
                            </div>
                            <div class="form-group">
                                <label for="categoria">Novo email:</label>
                                <input type="text" class="form-control" name="emailUsuario" value="<?php echo $usuarioEditar["emailUsuario"]; ?>" required/>
                            </div>
                            <div class="form-group">
                                <label for="categoria">Nova Senha:</label>
                                <input type="text" class="form-control" name="senhaUsuario" value="<?php echo $usuarioEditar["senhaUsuario"]; ?>" required/>
                            </div>
                            <button class="btn btn-info" type="submit" name="editarUsuario">Salvar</button>
                            <a href="usuarios.php" class="btn btn-danger">Cancelar</a>

                        </form>

                        <?php }; ?>
                    </div>
                </div>
                <div class="panel panel-info">
                    <div class="panel-heading">
                        Usuários Cadastrados
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover" data-height="400" data-page-size="10" data-pagination="true" data-toggle="table" data-search="true">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nome</th>
                                        <th>Email</th>
                                        <th>Editar</th>
                                        <th>Excluir</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($usuarios as $usuario){?>
                                        <tr>
                                            <td><?php echo $usuario["idUsuario"]; ?></td>
                                            <td><?php echo $usuario["nomeUsuario"]; ?></td>
                                            <td><?php echo $usuario["emailUsuario"]; ?></td>
                                            <td>
                                                <a href="usuarios.php?editar=<?php echo $usuario["idUsuario"]; ?>">
                                                    <button class="btn btn-sm btn-default">Editar</button>
                                                </a>
                                            </td>
                                            <td>
                                                <a href="usuarios.php?excluir=<?php echo $usuario["idUsuario"]; ?>">
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
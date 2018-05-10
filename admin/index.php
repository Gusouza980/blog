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

  $todosUsuarios = Usuario::carregaUsuarios();

?>

<?php include "admin_header.php" ?>
<body>
    <div id="wrapper">
        <!-- Include da navbar -->
        <?php include "admin_nav.php" ?>
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper">
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-head-line">Visão Geral</h1>
                        <h1 class="page-subhead-line">Aqui você terá dados atualizados sobre o seu site. </h1>

                    </div>
                </div>
                <!-- /. ROW  -->
                <div class="row">
                    <div class="col-md-4">
                        <div class="main-box mb-red">
                            <a href="#">
                                <i class="fa fa-bolt fa-5x"></i>
                                <h5><?php echo Noticia::quantidadeNoticias(); ?> Noticias</h5>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="main-box mb-dull">
                            <a href="#">
                                <i class="fa fa-plug fa-5x"></i>
                                <h5><?php echo Categoria::quantidadeCategorias();?> Categorias</h5>
                            </a>
                        </div>
                    </div>

                </div>
                <!-- /. ROW  -->

                
                <hr />
                <div class="row">

                    <div class="col-md-8">

                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover">
                                <caption class="text-left">Usuários cadastrados</caption>
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nome</th>
                                        <th>Email</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($todosUsuarios as $usuarios){?>
                                        <tr>
                                            <td><?php echo $usuarios["idUsuario"]; ?></td>
                                            <td><?php echo $usuarios["nomeUsuario"]; ?></td>
                                            <td><?php echo $usuarios["emailUsuario"]; ?></td>
                                        </tr>
                                    <?php };?>                                  
                                </tbody>
                            </table>
                        </div>




                    </div>
                </div>
                <!--/.Row-->
                <hr />
                
            </div>
            <!-- /. PAGE INNER  -->
        </div>
        <!-- /. PAGE WRAPPER  -->
    </div>
    <!-- /. WRAPPER  -->
    <?php include "admin_footer.php" ?>
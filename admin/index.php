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
        <nav class="navbar navbar-default navbar-cls-top " role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php"><?php echo $settings["nomeSite"]; ?></a>
            </div>

            <div class="header-right">
            
                <!-- Conteúdo que fica na barra verde a direita do nome do site -->
 
            </div>
        </nav>
        <!-- /. NAV TOP  -->
        <nav class="navbar-default navbar-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="main-menu">
                    <!-- Quadro azul com foto, nome do usuário e botão de sair -->
                    <li>
                        <div class="user-img-div">
                            <img src="assets/img/user.png" class="img-thumbnail" />

                            <div class="inner-text">
                                <?php echo $usuario->getNomeUsuario(); ?>
                            </div>
                            <div class="inner-text">
                                <form action="#" method="post">
                                    <input type="submit" class="btn-sm btn-danger" value="Sair" name="sair"/>
                                </form>
                            </div>
                        </div>

                    </li>
                    <!-- ############################################################# -->

                    <li>
                        <a class="active-menu" href="index.html"><i class="fa fa-dashboard "></i>Visão Geral</a>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-desktop "></i>Postagens <span class="fa arrow"></span></a>
                         <ul class="nav nav-second-level">
                            <li>
                                <a href="panel-tabs.html"><i class="fa fa-toggle-on"></i>Criar Postagem</a>
                            </li>
                            <li>
                                <a href="notification.html"><i class="fa fa-bell "></i>Listar Postagens</a>
                            </li>

                        </ul>
                    </li>
                     <li>
                        <a href="#"><i class="fa fa-yelp "></i>Categorias <span class="fa arrow"></span></a>
                         <ul class="nav nav-second-level">
                            <li>
                                <a href="invoice.html"><i class="fa fa-coffee"></i>Criar Categoria</a>
                            </li>
                            <li>
                                <a href="pricing.html"><i class="fa fa-flash "></i>Listar Categorias</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-bicycle "></i>Slideshow <span class="fa arrow"></span></a>
                         <ul class="nav nav-second-level">

                             <li>
                                <a href="form.html"><i class="fa fa-desktop "></i>Adicionar Imagem </a>
                            </li>
                             <li>
                                <a href="form-advance.html"><i class="fa fa-code "></i>Listar Imagens</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-bicycle "></i>Usuários <span class="fa arrow"></span></a>
                         <ul class="nav nav-second-level">

                             <li>
                                <a href="form.html"><i class="fa fa-desktop "></i>Cadastrar usuário</a>
                            </li>
                             <li>
                                <a href="form-advance.html"><i class="fa fa-code "></i>Listar usuários</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="table.html"><i class="fa fa-flash "></i>Configurações </a>

                    </li>
                </ul>

            </div>

        </nav>
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
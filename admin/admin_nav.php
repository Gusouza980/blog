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
                        <a class="active-menu" href="index.php"><i class="fa fa-dashboard "></i>Visão Geral</a>
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
                        <a href="categorias.php"><i class="fa fa-yelp "></i>Categorias</a>
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
                        <a href="usuarios.php"><i class="fa fa-bicycle "></i>Usuários </a>
                    </li>
                    <li>
                        <a href="configuracoes.php"><i class="fa fa-flash "></i>Configurações </a>

                    </li>
                </ul>

            </div>

        </nav>
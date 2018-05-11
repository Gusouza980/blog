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

  if(isset($_POST["editarSettings"])){
      if(isset($_POST["nomeSite"]) && isset($_POST["emailSite"]) && isset($_POST["telefoneSite"])){
          Settings::alterarSettings($settings["idSite"], $_POST["nomeSite"], $_POST["emailSite"], $_POST["telefoneSite"]);
          $_SESSION["settings"] = Settings::carregarSettings();
          $settings = $_SESSION["settings"];
      }
  }

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
                        Editar configurações
                    </div>
                    <div class="panel-body">
                        <form action="#" method="post" role="form">
                            <div class="form-group">
                                <label for="categoria">Nome do Site:</label>
                                <input type="text" class="form-control" name="nomeSite" value="<?php echo $settings["nomeSite"]; ?> " required/>
                            </div>
                            <div class="form-group">
                                <label for="categoria">Email para contato:</label>
                                <input type="text" class="form-control" name="emailSite" value="<?php echo $settings["emailSite"]; ?>" required/>
                            </div>
                            <div class="form-group">
                                <label for="categoria">Telefone para contato:</label>
                                <input type="text" class="form-control" name="telefoneSite" value="<?php echo $settings["telefoneSite"]; ?>" required/>
                            </div>
                            <button class="btn btn-info" type="submit" name="editarSettings">Salvar</button>
                            <a href="configuracoes.php" class="btn btn-danger">Cancelar</a>

                        </form>
                    </div>
                </div>               
            </div>
        </div>
    </div>
</body>
<?php include "admin_footer.php"; ?>
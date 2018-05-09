<?php

  include "../classes/includes.php";
  session_start();

  $erro = "";

  if(isset($_POST["senha"]) && isset($_POST["usuario"])){
    $user = new Usuario();
    if($user->logar($_POST["usuario"], $_POST["senha"])){
      $_SESSION["usuario"] = $user;
      header("Location: index.php");
    }else{
      $erro = '<div class="alert alert-danger" role="alert"> Dados incorretos. Tente novamente! </div>';
    }
  }

?>

<?php include "admin_header.php"; ?>

<body style="background-color: #E2E2E2;">
    <div class="container">
        <div class="row text-center " style="padding-top:100px;">
            <div class="col-md-12">
                <img src="assets/img/logo-invoice.png" />
            </div>
        </div>
         <div class="row ">

                <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-10 col-xs-offset-1">

                            <div class="panel-body">
                                <?php echo $erro ?>
                                <form role="form" action="#" method="POST">
                                    <hr />
                                    <h5>Enter Details to Login</h5>
                                       <br />
                                     <div class="form-group input-group">
                                            <span class="input-group-addon"><i class="fa fa-tag"  ></i></span>
                                            <input type="text" name="usuario" class="form-control" placeholder="Your Username " />
                                        </div>
                                                                              <div class="form-group input-group">
                                            <span class="input-group-addon"><i class="fa fa-lock"  ></i></span>
                                            <input type="password" name="senha" class="form-control"  placeholder="Your Password" />
                                        </div>
                                    <div class="form-group">
                                            <label class="checkbox-inline">
                                                <input type="checkbox" /> Remember me
                                            </label>
                                            <span class="pull-right">
                                                   <a href="index.html" >Forget password ? </a>
                                            </span>
                                        </div>

                                     <input type="submit" value="logar" />
                                    <hr />
                                    Not register ? <a href="index.html" >click here </a> or go to <a href="index.html">Home</a>
                                    </form>
                            </div>

                        </div>


        </div>
    </div>
    <?php include "admin_footer.php"; ?>

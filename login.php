<?php
require_once("cnx/swgc-mysql.php");
require_once("cls/cls-sistema.php");
include("inc/fun-ini.php");
$clSistema = new clSis();
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <base href="/" />
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="SGI Dashboard">
    <meta name="author" content="SGI Dashboard">
    <meta name="keywords" content="SGI Dashboard">

    <!-- Title Page-->
    <title>E.C.A. | Dashboard</title>

    <!-- Fontfaces CSS-->
    <link href="/css/font-face.css" rel="stylesheet" media="all">
    <link href="/vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <link href="/vendor/font-awesome-5/css/fontawesome-all.min.css" rel="stylesheet" media="all">
    <link href="/vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">

    <!-- Bootstrap CSS-->
    <link href="/vendor/bootstrap-4.1/bootstrap.min.css" rel="stylesheet" media="all">

    <!-- Vendor CSS-->
    <link href="/vendor/animsition/animsition.min.css" rel="stylesheet" media="all">
    <link href="/vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet" media="all">
    <link href="/vendor/wow/animate.css" rel="stylesheet" media="all">
    <link href="/vendor/css-hamburgers/hamburgers.min.css" rel="stylesheet" media="all">
    <link href="/vendor/slick/slick.css" rel="stylesheet" media="all">
    <link href="/vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="/vendor/perfect-scrollbar/perfect-scrollbar.css" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="/css/theme.css" rel="stylesheet" media="all">

</head>

<body class="animsition">
    <div class="page-wrapper">
        <div class="page-content--bge5">
            <div class="container">

                <div class="login-wrap">
                    <div class="login-content">
                        <?
if($_POST)
{
	$res = $clSistema->iniciarSesion();
	if($res['exito']==1 && $_SESSION['sessionAdmin']['eCodUsuario']>0)
	{ ?>
       <div class="alert alert-success" role="alert">
                Inicio de Sesi&oacute;n Correcto. Redirigiendo...
            </div>                  
      <script>
setTimeout(function(){
    window.location="<?=base64_decode($res['seccion'])?>";
},2500);
</script>
	<? }
    else
    { ?>
       <div class="alert alert-danger" role="alert">
                Error de Inicio de Sesi&oacute;n!
            </div> 
    <? }
}
?>
                        
                        <div class="login-logo">
                            <a href="#">
                                <img src="images/icon/logo.png" alt="SWGC" style="max-width:120px;">
                            </a>
                        </div>
                        <div class="login-form">
                            <form action="<?=obtenerURL();?>login/" method="post">
                                <div class="form-group">
                                    <label>Correo electr&oacute;nico</label>
                                    <input class="au-input au-input--full" type="email" name="tCorreo" placeholder="E-mail">
                                </div>
                                <div class="form-group">
                                    <label>Password</label>
                                    <input class="au-input au-input--full" type="password" name="tPasswordAcceso" placeholder="Password">
                                </div>
                                <div class="login-checkbox">
                                    <!--<label>
                                        <input type="checkbox" name="remember">Remember Me
                                    </label>
                                    <label>
                                        <a href="pedirPassword.php">Olvidaste tu contrase&ntilde;a?</a>
                                    </label>-->
                                </div>
                                <input class="au-btn au-btn--block au-btn--green m-b-20" type="submit" value="Entrar">    
                            </form>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Jquery JS-->
    <script src="vendor/jquery-3.2.1.min.js"></script>
    <!-- Bootstrap JS-->
    <script src="vendor/bootstrap-4.1/popper.min.js"></script>
    <script src="vendor/bootstrap-4.1/bootstrap.min.js"></script>
    <!-- Vendor JS       -->
    <script src="vendor/slick/slick.min.js">
    </script>
    <script src="vendor/wow/wow.min.js"></script>
    <script src="vendor/animsition/animsition.min.js"></script>
    <script src="vendor/bootstrap-progressbar/bootstrap-progressbar.min.js">
    </script>
    <script src="vendor/counter-up/jquery.waypoints.min.js"></script>
    <script src="vendor/counter-up/jquery.counterup.min.js">
    </script>
    <script src="vendor/circle-progress/circle-progress.min.js"></script>
    <script src="vendor/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="vendor/chartjs/Chart.bundle.min.js"></script>
    <script src="vendor/select2/select2.min.js">
    </script>

    <!-- Main JS-->
    <script src="js/main.js"></script>

</body>

</html>
<!-- end document-->
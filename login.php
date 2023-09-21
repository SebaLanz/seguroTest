<?php
session_start();
    require_once("config/constantes.php");
    require_once("clases/API.class.php");
    $accion = "";
    $usuario = "";
    $password = "";
    if(isset($_POST['accion'])){
        $accion = $_POST['accion'];
        $usuario = $_POST['usuario'];
        $password = $_POST['password'];
      
    }

    if ($accion=="login")
    {
      
        $loginErrorMsg = "";
        try{
            $oApi = new API();
            $login_status = $oApi->login($usuario, $password);
            if ($login_status == "RENEWPASS"){
                header("Location:index.php");
                exit;
            }
        }catch (Exception $e){
            $loginErrorMsg =  $e->getMessage();
        }
        
         
        if (empty($loginErrorMsg)){
            // Login OK;                      
            header("Location:index.php");            
            
        }



    }

?>

<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="img/candado.png"> <!--Acá cambio el ícono del buscador-->
    <?php if (!empty($loginErrorMsg)){ ?>
        <script src="//code.jquery.com/jquery-1.12.0.min.js"></script>
        <script>
              $(document).ready(function()
              {         
                 $("#myModal").modal("show");
              });
        </script>
    <?php } ?>
</head>
    <title>Seguros</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">



<!--Acá cambio el color de fondo-->
    <!--<body class="" style="background: linear-gradient(90deg, rgba(45,156,132,1) 24%, rgba(202,255,183,1) 50%, rgba(0,212,255,1) 100%);">-->          
    <body class="" style="background-color:#E3DAD8;">  
    
    <style>
      
    </style>
    <div class="container" >

        <!-- Outer Row -->
        <div class="row justify-content-center" >

            <div class="col-xl-9 col-lg-18 col-md-1">

                <div class="card o-hidden border-2 shadow-lg my-5 ">
                    <div class="card">
                        <!-- Acá cambio el color de fondo De la CARTA -->
                        <div class="row" style="background: linear-gradient(90deg, rgba(255,255,255,1) 24%, rgba(243,255,239,1) 50%, rgba(191,253,255,1) 100%);">
                            <div class="col-lg-3 d-none d-lg-block bg-login-image"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4"><b>¡Bienvenido!</b></h1><!--Altura entre el texto y los botones-->
                                    </div>
                                    <form  method=POST action=login.php>
                                        <div class="form-group" class="text-center">
                                            <input type="user" class="form-control form-control-user"
                                                id="usuario" aria-describedby="emailHelp"
                                                placeholder="Ingrese su usuario..." name="usuario">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user"
                                                id="password" placeholder="Password" name="password">
                                        </div>                                        
                                        <input type="submit" class="btn btn-# btn-user btn-block" style="background: rgb(50,206,208);" value="Ingresar"> <input type="hidden" name="accion" value="login" />                                            
                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="forgot-password.html">¿Olvidó su clave?</a>
                                    </div>                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>


    <!-- error Modal-->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Error de inicio de sesión</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body"><?php if (!empty($loginErrorMsg)){echo $loginErrorMsg;} ?></div>
                <div class="modal-footer">
                    <button class="btn btn-primary" type="button" data-dismiss="modal">OK</button>                    
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

</body>

</html>
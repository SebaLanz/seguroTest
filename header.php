<!DOCTYPE html>
<html lang="ES">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Seguros</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous"></head>
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
    <link rel="icon" href="img/candado.png"> <!--Acá cambio el ícono del buscador-->

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav sidebar sidebar-dark accordion" id="accordionSidebar" style="background-color:#0076CE">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center"href="index.php">
                <div class="sidebar-brand-icon rotate-n-15">
                    
                </div>
                <div class="sidebar-brand-text mx-12"><br>Menú</div>
            </a>

            <!-- Divider Divide el menú con una línea--> 
            <hr class="sidebar-divider my-1">            

            <!-- MENÚ USUARIOS -->
            <?php
            
            $oApi = new API();
            $userLogeado = $_SESSION['TISA_USERNAME'];//Obtengo el username Logeado
            $usuarioLogeado = $oApi->getIdByUsuario($userLogeado);//instancio el método para obtener el ID del usuario.
            foreach($usuarioLogeado as $usuario){            
                    $id_usuario=$usuario->id_usuario;
            }  
            $usuarios = $oApi->getUsuarioById($id_usuario);  
            
            foreach($usuarios as $usuario){
                 $usuarioPermiso = $usuario->perfil;
            }
            if($usuarioPermiso == 'ADMINISTRADOR'){       
            ?> 
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-user-cog"></i>
                    <span> Usuarios</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">                        
                        <a class="collapse-item" href="index.php?seccion=usuarios.php">Administrar usuarios</a>
                    </div>
                </div>
            </li>
            <?php }?>                                  
            <!-- MENÚ CLIENTES, ANTES ERA EMPLEADOS EN TISA -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
                    aria-expanded="true" aria-controls="collapseUtilities">
                    <i class="fas fa-user-tie"></i>
                    <span>  Clientes</span>
                </a>
                <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        
                        <a class="collapse-item" href="index.php?seccion=clientes.php">Administrar Clientes</a>
                        
                    </div>
                </div>
            </li>
            
              <!-- MENÚ Vehículos-->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePagesVehículos"
                    aria-expanded="true" aria-controls="collapsePagesVehículos">
                    <i class="fas fa-car"></i>
                    <span>Administración</span>
                </a>
                <div id="collapsePagesVehículos" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <!--<h6 class="collapse-header">Alta - Baja - Modificación</h6>-->
                        <a class="collapse-item" href="index.php?seccion=automoviles.php">Vehículos</a>
                        <a class="collapse-item" href="index.php?seccion=planes.php">Planes</a>
                        <a class="collapse-item" href="index.php?seccion=medios_de_pagos.php">Medios de Pago</a>

                </div>
            </li>

             <!-- MENÚ Pagos -->
             <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePagos"
                    aria-expanded="true" aria-controls="collapsePagos">
                    <i class="far fa-money-bill-alt"></i>
                   <span>Pagos</span>
                </a>
                <div id="collapsePagos" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        
                        <a class="collapse-item" href="index.php?seccion=pagos.php">Gestionar Pagos</a>
                    </div>
                </div>
                </li>    
            <!-- MENÚ informes -->
            <li class="nav-item">

                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseInformes"
                    aria-expanded="true" aria-controls="collapseInformes">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>Informes</span>
                </a>
                <div id="collapseInformes" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        
                        <a class="collapse-item" href="index.php?seccion=informes.php">Buscar Historial</a>
                    </div>
                </div>
            </li>    
            
        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                   

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small"
                                            placeholder="Search for..." aria-label="search"
                                            aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php //echo $_SESSION['TISA_USERNAME'];?></span>
                                <?php  
                                
                                $oApi = new API();
                                $userLogeado = $_SESSION['TISA_USERNAME'];//Obtengo el username Logeado
                                $usuarioLogeado = $oApi->getIdByUsuario($userLogeado);//instancio el método para obtener el ID del usuario.
                                foreach($usuarioLogeado as $usuario){            
                                        $id_usuario=$usuario->id_usuario;
                                }         
                                $usuarioImg = $oApi->getUsuarioImgPerfil($id_usuario);  
                                ?><img class="img-profile rounded-circle" src="<?php  
                                
                                foreach($usuarioImg as $uImg){ 
                                     echo $uImg->imgPerfil;
                                
                                     }
                                    ?>  
                                    ">
                                    <h6 style="color:green; font-size:13px"><?php echo "&nbsp"."<b>".$_SESSION['TISA_USERNAME']."</b>";?></h6>

                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                
                                <a class="dropdown-item text-black-400" href="#">      
                                                             
                                                                
                                
                                    <img class="img-profile rounded-circle mx-auto d-block " src="<?php  
                                
                                foreach($usuarioImg as $uImg){ 
                                     echo $uImg->imgPerfil; 
                                     }
                                    ?>  
                                    " width="35" height="35">
                               
                                </a>   
                                <a class="dropdown-item" href="index.php?seccion=usuario/edt_perfil.php&id=<?php echo $usuario->id_usuario;?>">
                                
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-black-400"></i>
                                    
                                    Perfil
                                </a>                                
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-black-400"></i>
                                    Cerrar sesión
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->
         
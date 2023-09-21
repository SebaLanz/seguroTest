<?php

require_once("accesscontrol.php");

$ErrorMsg = "";
try{
        $oApi = new API();
        $userLogeado = $_SESSION['TISA_USERNAME'];//Obtengo el username Logeado
        $usuarioLogeado = $oApi->getIdByUsuario($userLogeado);//instancio el método para obtener el ID del usuario.
        foreach($usuarioLogeado as $usuario){            
                $id_usuario=$usuario->id_usuario;
        }                            
                
        $automoviles = $oApi->getClientesDelUsuario($id_usuario); 
        
    }catch (Exception $e){
        $ErrorMsg =  $e->getMessage();
    }
 

?>

<?php if (!empty($ErrorMsg )) { ?>
    <!-- error Modal-->
    <script src="//code.jquery.com/jquery-1.12.0.min.js"></script>
    <script>
              $(document).ready(function()
              {         
                 $("#myModal").modal("show");
              });
    </script>
    
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Mensaje</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body"><?php if (!empty($ErrorMsg)){echo $ErrorMsg;} ?></div>
                <div class="modal-footer">
                    <button class="btn btn-primary" type="button" data-dismiss="modal">OK</button>                    
                </div>
            </div>
        </div>
    </div>
    <!-- fin error Modal-->
<?php } ?>    
<!-- Begin Page Content -->
<?php if(empty($ErrorMsg)) { ?>

<style>
 p { color: red; }
 g { color: green; }
</style>
                <div class="container-fluid">

                    <!-- Page Heading  Abajo genero el camino de la vibora para volver atrás-->
                    <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="./index.php">Inicio</a></li>
        <li class="breadcrumb-item"><a href="./index.php?seccion=automoviles.php">Administración de Pagos</a></li>
        <li class="breadcrumb-item active" aria-current="page">Información completa</li>
    </ol>
</nav>
                    
                    <h1 class="h3 mb-2 text-gray-800">Administración de Pagos</h1>
                    <p class="mb-4"> </p>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">

                        <h6 class="m-0 font-weight-bold text-primary">Generar Pago						
                                <a class="btn btn-outline-primary" href="index.php?seccion=pago/edt_pago.php&id=0"
                                    data-toggle="tooltip" data-placement="bottom" title=" Nuevo ">
                                    <i class="fas fa-arrow-circle-up"></i>
                                </a>					
							</h6> 
							 
                          

                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">

                                <thead style="text-align: center;">
                                        <tr>
                                            <th>Nombre</th>
                                            <th>Apellido</th>
                                            <th>Email</th>
                                            <th>Teléfono</th>
                                            <th>Patente</th>
                                            <th>Modelo</th>
                                            <th>Marca</th>
                                            <th>Tipo</th>
                                            <th>Abonó</th>
                                            <th>Fecha</th>
                                            <th>Plan</th>
                                            <th>Medio de Pago</th>
                                        </tr>
                                    </thead>
                                    </tfoot>
                                    <tbody>
                                    <?php foreach($automoviles as $automovil){ ?>
                                        <tr style="text-align: left;">
                                        
                                            <td><?php echo $automovil->nombre;?></td>
                                            <td><?php echo $automovil->apellido;?></td>
                                            <td><?php echo $automovil->email;?></td>
                                            <td><?php echo $automovil->telefono;?></td>
                                            <td><?php echo $automovil->patente;?></td>
                                            <td ><?php echo $automovil->modelo;?></td>
                                            <td><?php echo $automovil->marca;?></td>
                                            <td><?php echo $automovil->tipo;?></td>    
                                            <td><?php echo "$".$automovil->abonó;?></td>    
                                            <td><?php echo $automovil->fecha;?></td>    
                                            <td><?php echo $automovil->tipo_plan;?></td>  
                                            <td><?php echo $automovil->medio_pago;?></td>                                                                                                                 
                                        </tr>  
										
														
	
                                        <?php }?>                                      

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

<?php } 
include_once FOOTER_FILE;?>

<script>$(document).ready(function() {
  $('#dataTable5').DataTable({
    "language": {
      "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
    }
  });

});</script>
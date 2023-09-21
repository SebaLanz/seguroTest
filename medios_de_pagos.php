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
        $pagos = $oApi->getMediosDePagoAll(); 
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

                    <!-- Page Heading -->
                    <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="./index.php">Inicio</a></li>
        <li class="breadcrumb-item active" aria-current="page">Administración</li>
    </ol>
</nav>
                    
                    <h1 class="h3 mb-2 text-gray-800">Medios de Pagos</h1>
                    <p class="mb-4"> </p>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">

                            <h6 class="m-0 font-weight-bold text-primary">Generar Medio de Pago							
                                <a class="btn btn-outline-primary" href="index.php?seccion=medios_de_pagos/edt_mdp.php&id=0"
                                    data-toggle="tooltip" data-placement="bottom" title=" Nuevo ">
                                    <i style="color:green; "class="fas fa-arrow-up"> </i>
                                </a>					
                            </h6>        

                        </div>
                        <div class="card-body">
                            <div class="table-responsive"  >
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="10">

                                    <thead>
                                        <tr>
                                            <th style="width:8%">Medio de Pago</th>
                                            <th style="width:5%">Estado</th>
                                            <th style="width:1%">Acción</th>

                                    </thead>
                                    </tfoot>
                                    <tbody>
                                    <?php foreach($pagos as $pago){ ?>
                                        <tr>
                                        
                                            <!--Hago esto para traerme el ID de la Fila pero-->
                                            <?php  $pago->id_medios_pago;?>
                                            <td><?php echo $pago->medio_pago;?></td>
                                            <td ><g><?php if($pago->estado == '1') {echo "Activo";}?></g>
                                                <p><?php if($pago->estado == '0'){echo "Inactivo";}?></p></td>
                                                                        
                                                <td>
											
                                            <div class=btn-group>									
												
												<a style="text-align: center;" class="btn btn-outline-success" href="index.php?seccion=medios_de_pagos/edt_mdp.php&id=<?php echo $pago->id_medios_pago;?>"
                                                data-toggle="tooltip" data-placement="bottom" title=" Editar ">
                                                <i class="fas fa-pencil-alt"> </i>
												</a>
																							
												<!-- fas fa-trash-alt -->
                                                <a <?php if($pago->estado == '1') {?> class="btn btn-outline-danger" title=" Baja " <?php }else{?> class="btn btn-outline-success" <?php }?> href="" data-toggle="modal" data-toggle="tooltip"
												data-placement="bottom" title=" Alta " data-target="#ModalEditar<?php echo $pago->id_medios_pago;?>">
                                                <?php if($pago->estado == '1') {?> <i class="fas fa-user-slash"> </i><?php }?>
                                                <?php if($pago->estado == '0') {?> <i class="fas fa-user-check"> </i><?php }?>
												</a>																																	                                             											
											</div>																				
                                        </tr>  
										
									<!-- Modal Dar de baja -->
                            <div class="modal fade" id="ModalEditar<?php echo $pago->id_medios_pago;?>" tabindex="-1" role="dialog">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                        <?php if($pago->estado == '1') {?> <h4 class="modal-title">Esta seguro de dar la baja al Medio de Pago <b><br> "<?php echo $pago->medio_pago;?>"</b>  ?</h4><?php }?>
                                        <?php if($pago->estado == '0') {?> <h4 class="modal-title">Esta seguro de dar el alta al Medio de Pago <b>--><?php echo $pago->medio_pago;?></b> ?</h4><?php }?>
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        </div>
                                        
                                        <div class="modal-body">
                                            <form method="POST" action="index.php?seccion=medios_de_pagos/mdp_save.php&id_medios_pago=<?php echo $pago->id_medios_pago;?>&estado=<?php echo $pago->estado;?>" autocomplete="off" enctype="multipart/form-data">
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-light btn-lg" data-dismiss="modal">Cerrar</button>
                                                    <?php if($pago->estado == '1') {?><button type="submit" class="btn btn-outline-danger btn-lg"><i class="fas fa-user-slash"></i> Dar de Baja</button><?php }?>
                                                    <?php if($pago->estado == '0') {?><button type="submit" class="btn btn-outline-success btn-lg"><i class="fas fa-user-check"></i> Dar de Alta</button><?php }?>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>															
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

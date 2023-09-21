<?php
//Esto es CLIENTES
require_once("accesscontrol.php");


$ErrorMsg = "";
try{
        $oApi = new API();
        $userLogeado = $_SESSION['TISA_USERNAME'];//Obtengo el username Logeado
        $usuarioLogeado = $oApi->getIdByUsuario($userLogeado);//instancio el método para obtener el ID del usuario.
        foreach($usuarioLogeado as $usuario){            
                $id_usuario=$usuario->id_usuario;
        }         
        $clientes = $oApi->getAllByUserLog($id_usuario);            
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
                    <h5 class="modal-title" id="exampleModalLabel"><?php echo $ErrorMsg;?> </h5>
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
		<li class="breadcrumb-item active" aria-current="page">Administración de Clientes</li>
    </ol>
</nav>
					
                    <h1 class="h3 mb-2 text-gray-800">Administración de Clientes</h1>
                    <p class="mb-4"> </p>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">

                            <h6 class="m-0 font-weight-bold text-primary">Registrar Cliente -->
							
							<a class="btn btn-outline-primary" href="index.php?seccion=cliente/edt_cliente.php&id=0"
                            data-toggle="tooltip" data-placement="bottom" title=" Nuevo ">
                            <i class="fas fa-user-plus"> </i>
								</a>					
							</h6> 
							 
                          

                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">

                                    <thead>
                                        <tr>
                                            <th>Nombre</th>
                                            <th>Apellido</th>
                                            <th>DNI</th>
                                            <th>Calle</th>
                                            <th>Nro</th>
                                            <th>Localidad</th>
                                            <th>Prov.</th>
                                            <th>Email</th>
                                            <th>Activo</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <!--<tfoot>
                                        <tr>
                                            <th>ID</th>
                                            <th>Nombre</th>
                                            <th>Apellido</th>
                                            <th>Calle</th>
                                            <th>nro</th>
                                            <th>Localidad</th>
                                            <th>Prov.</th>
                                            <th>Email</th>
                                            <th>Acciones</th>                           
                                        </tr> -->
                                    </tfoot>
                                    <tbody>
                                    <?php foreach($clientes as $cliente){ ?>
                                        <tr>
                                            <?php  $cliente->id_empleado;?>
                                            <td><?php echo $cliente->nombre;?></td>
                                            <td><?php echo $cliente->apellido;?></td>
                                            <td><?php echo $cliente->dni;?></td>
                                            <td><?php echo $cliente->calle;?></td>
                                            <td><?php echo $cliente->numero_calle;?></td> 
                                            <td><?php echo $cliente->localidad;?></td> 
                                            <td><?php echo $cliente->provincia;?></td> 
                                            <td><?php echo $cliente->email;?></td> 
                                            <td><g><?php if($cliente->activo == '1') {echo "Activo";}?></g>
                                                <p><?php if($cliente->activo == '0'){echo "Inactivo";}?></p></td>
                                                                        
                                            <td>
											
                                            <div class=btn-group>
												
												
												<a class="btn btn-outline-success" href="index.php?seccion=cliente/edt_cliente.php&id=<?php echo $cliente->id_empleado;?>"
                                                data-toggle="tooltip" data-placement="bottom" title=" Editar ">
                                                <i class="fas fa-pencil-alt"> </i>
												</a>
												
												
												<!-- fas fa-trash-alt -->
                                                <a <?php if($cliente->activo == '1') {?> class="btn btn-outline-danger" title=" Baja " <?php }else{?> class="btn btn-outline-success" <?php }?> href="" data-toggle="modal" data-toggle="tooltip"
												data-placement="bottom" title=" Alta " data-target="#ModalEditar<?php echo $cliente->apellido;?>">
                                                <?php if($cliente->activo == '1') {?> <i class="fas fa-user-slash"> </i><?php }?>
                                                <?php if($cliente->activo == '0') {?> <i class="fas fa-user-check"> </i><?php }?>
												</a>
														
																						                                             
												
											</div>																				
                                        </tr>  
                                  
                                    
									<!-- Modal Borrar -->
                            <div class="modal fade" id="ModalEditar<?php echo $cliente->apellido;?>" tabindex="-1" role="dialog">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                        <?php if($cliente->activo == '1') {?> <h4 class="modal-title">Esta seguro de dar la baja al cliente <b>--><?php echo $cliente->apellido;?></b> ?</h4><?php }?>
                                        <?php if($cliente->activo == '0') {?> <h4 class="modal-title">Esta seguro de dar el alta al cliente <b>--><?php echo $cliente->apellido;?></b> ?</h4><?php }?>
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        </div>
                                        <div class="modal-body">
                                            <form method="POST" action="index.php?seccion=cliente/cliente_save.php&id_empleado=<?php echo $cliente->id_empleado;?>&activo=<?php echo $cliente->activo;?>&apellido=<?php echo $cliente->apellido;?>" autocomplete="off" enctype="multipart/form-data">
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-light btn-lg" data-dismiss="modal">Cerrar</button>
                                                    <?php if($cliente->activo == '1') {?><button type="submit" class="btn btn-outline-danger btn-lg"><i class="fas fa-user-slash"></i> Dar de Baja</button><?php }?>
                                                    <?php if($cliente->activo == '0') {?><button type="submit" class="btn btn-outline-success btn-lg"><i class="fas fa-user-check"></i> Dar de Alta</button><?php }?>
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
				
								
				
<?php }?> 
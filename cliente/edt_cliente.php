<?php

require_once("accesscontrol.php");


$ErrorMsg = "";
if(isset($_GET["id"])){try{

        $oApi = new API();
        
        if(!empty($_GET["id"])){
            // si el id no es cero es editar de cliente
            $clientes = $oApi->getClienteById($_GET["id"]);            
            $cliente = $clientes[0];
            $titulo = "Edición de cliente";
        }else{
            // si el id es cero es alta
            $titulo = "Alta de cliente";
            $jsonModel = '{
                            "id_empleado": 0,
                            "nombre": "",
                            "apellido": "",
                            "dni": "",
                            "calle": "",
                            "numero_calle": "",
                            "localidad": "",
                            "cod_provincia": null,
                            "id_usuario":"",
                            "email": ""                            
                        }';


            $cliente = json_decode($jsonModel);

        }
        $provincias = $oApi->getProvincias(); 
    }catch (Exception $e){
        $ErrorMsg =  $e->getMessage();
    }
}else{
    $ErrorMsg = "Falta el parámetro id_empleado";
}


$userLogeado = $_SESSION['TISA_USERNAME'];//Obtengo el username Logeado
$usuarioLogeado = $oApi->getIdByUsuario($userLogeado);//instancio el método para obtener el ID del usuario.
foreach($usuarioLogeado as $usuario){            
        $id_usuario=$usuario->id_usuario;
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
              
        <!-- /.acá poner el form yu cargarle los valores -->
       <div class="container-fluid">

                    <!-- Page Heading -->
					<nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="./index.php">Inicio</a></li>
                            <li class="breadcrumb-item"><a href="./index.php?seccion=clientes.php">Administración de clientes</a></li>
                            <li class="breadcrumb-item active" aria-current="page"><?php echo $titulo ?></li>
                        </ol>
                    </nav>
                    <h1 class="h3 mb-2 text-gray-800">Administración de clientes</h1>
                    <p class="mb-4"> </p>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary"><?php echo $titulo ; ?></h6>
                        </div>
                        <div class="card-body">                            
                            <div>
                               <form id="form_cliente" method="post" action="index.php?seccion=cliente/cliente_save.php">
                                  <!-- 2 column grid layout with text inputs for the first and last names -->
                                  <div class="row mb-4">
                                 <!--col 1-->
                                    <div class="col">
                                      <div class="form-outline">
                                        <input type="text" name="id_empleado_sh" id="id_empleado_sh" disabled="" class="form-control"  value="<?php echo $cliente->id_empleado ;?>" />
                                        <input type="hidden" name="id_empleado" id="id_empleado" class="form-control"  value="<?php echo $cliente->id_empleado;?>" />
                                        <label class="form-label" for="nombre">ID</label>
                                        <input size="15" type="text" name="id_usuario" id="id_usuario" disabled="" class="form-control"  value="<?php echo $usuario->id_usuario;?>" />
                                        <input type="hidden" name="id_usuario" id="id_usuario" class="form-control"  value="<?php echo $usuario->id_usuario;?>" />
                                        <label class="form-label" for="nombre">ID Usuario</label>
                                        <input type="text" name="numero_calle" id="numero_calle" class="form-control" value="<?php echo $cliente->numero_calle;?>"/>
                                        <label class="form-label" for="numero_calle">Nro.</label>
                                        <select name="cod_provincia" class="form-control" id="provincia" >
                                            <?php if($cliente->cod_provincia==null) { ?>
                                                <option value="">Sin provincia </option>
                                            <?php } ?>
                                            <?php foreach($provincias as $provincia){ ?>
                                                <option value="<?php echo $provincia->cod_provincia;?>" <?php if($provincia->cod_provincia==$cliente->cod_provincia){
                                                    echo 'selected';
                                                }?>><?php echo $provincia->provincia;?></option>
                                            <?php } ?>
                                        </select>
                                        <label  class="form-label" for="provincia">Provincia</label>
                                      </div>
                                    </div>

                                  <!--col 2-->
                                    <div class="col">
                                      <div class="form-outline">
                                        <input type="text" name="nombre" id="nombre" class="form-control" value="<?php echo $cliente->nombre;?>" />
                                        <label class="form-label" for="nombre">Nombre</label>
                                        <input type="text" name="dni" id="dni" class="form-control" value="<?php echo $cliente->dni;?>" />
                                        <label class="form-label" for="dni" >DNI</label>
                                        <input type="text" name="localidad" id="localidad" class="form-control" value="<?php echo $cliente->localidad;?>" />
                                        <label class="form-label" for="nombre">Localidad</label>
                                      </div>
                                    </div>
                                  <!--col 3-->
                                    <div class="col">
                                      <div class="form-outline">
                                        <input type="text" name="apellido" id="apellido" class="form-control" value="<?php echo $cliente->apellido;?>"/>
                                        <label class="form-label" for="apellido">Apellido</label>
                                        <input type="text" name="calle" id="calle" class="form-control" value="<?php echo $cliente->calle;?>" />
                                        <label class="form-label" for="calle">Calle</label>
                                        <input type="email" name="email" id="email" class="form-control" value="<?php echo $cliente->email;?>" />
                                        <label class="form-label" for="email">Email</label>
                                      </div>
                                    </div>
                                  </div>

                                 </div>
                                  </div>
                                    




                                  <!-- Submit button -->
                                  <button type="submit" class="btn btn-primary btn-block mb-4">Guardar</button>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->
<?php } 

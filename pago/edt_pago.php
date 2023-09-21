<?php

require_once("accesscontrol.php");


$ErrorMsg = "";
if(isset($_GET["id"])){try{

        $oApi = new API();
        
        if(!empty($_GET["id"])){
            // si el id no es cero es editar de cliente
            $pagos = $oApi->getPagoById($_GET["id"]);            
            $pago = $pagos[0];

            
            $titulo = "Edición de Pagos";
        }else{
            // si el id es cero es alta
            $titulo = "Alta de Pagos";
            $jsonModel = ' {
                            "id_plan_pago": "0",
                            "id_automovil": "",
                            "id_tipo_plan": "",
                            "id_medios_pago": "",
                            "abonó": "",
                            "fecha": ""
                        }';


            $pago = json_decode($jsonModel);

        }
        $provincias = $oApi->getProvincias(); 
       
        $planes = $oApi->getPlanAll(); 
        $medios_de_pagos = $oApi->getMediosDePagoAll(); 

        $userLogeado = $_SESSION['TISA_USERNAME'];//Obtengo el username Logeado
        $usuarioLogeado = $oApi->getIdByUsuario($userLogeado);//instancio el método para obtener el ID del usuario.
        foreach($usuarioLogeado as $usuario){            
                $id_usuario=$usuario->id_usuario;
        }  
        $automoviles= $oApi->getAutomovilesAll($id_usuario); 
  
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
                            <li class="breadcrumb-item"><a href="./index.php?seccion=pagos.php">Administración de Pagos</a></li>
                            <li class="breadcrumb-item active" aria-current="page"><?php echo $titulo ?></li>
                        </ol>
                    </nav>
                    <h1 class="h3 mb-2 text-gray-800">Administración de Pagos</h1>
                    <p class="mb-4"> </p>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary"><?php echo $titulo ; ?></h6>
                        </div>
                        <div class="card-body">                            
                            <div>
                               <form id="form_cliente" method="post" action="index.php?seccion=pago/pago_save.php">
                                  <!-- 2 column grid layout with text inputs for the first and last names -->
                                  <div class="row mb-4">
                                 <!--col 1-->
                                    <div class="col">
                                      <div class="form-outline">
                                        <input type="text" name="id_plan_pago_sh" id="id_plan_pago_sh" disabled="" class="form-control"  value="<?php echo $pago->id_plan_pago ;?>" />
                                        <input type="hidden" name="id_plan_pago" id="id_plan_pago" class="form-control"  value="<?php echo $pago->id_plan_pago;?>" />
                                        <label class="form-label" for="nombre">ID</label>
                                        <select name="id_automovil" class="form-control" id="id_automovil" >
                                            <?php foreach($automoviles as $automovil){ ?>
                                                <option value="<?php echo $automovil->id_automovil;?>" <?php if($automovil->id_automovil==$automovil->id_automovil){
                                                    echo 'selected';
                                                }?>><?php echo $automovil->patente;?></option>
                                            <?php } ?>
                                        </select>
                                        <label  class="form-label" for="id_automovil">Automovil - Patente</label>
                                    
                                      </div>
                                    </div>

                                  <!--col 2-->
                                    <div class="col">
                                      <div class="form-outline">
                                      <select name="id_tipo_plan" class="form-control" id="id_tipo_plan" >
                                            <?php foreach($planes as $plan){ ?>
                                                <option value="<?php echo $plan->id_tipo_plan;?>" <?php if($plan->id_tipo_plan==$plan->id_tipo_plan){
                                                    echo 'selected';
                                                }?>><?php echo $plan->tipo_plan;?></option>
                                            <?php } ?>
                                        </select>

                                        <label  class="form-label" for="tipo_plan">Plan</label>

                                        <input type="text" name="abonó" id="abonó" class="form-control" value="<?php echo $pago->abonó;?>"/>
                                        <label class="form-label" for="abonó">Monto abonado</label>
                                   
                                      </div>
                                    </div>
                                  <!--col 3-->
                                    <div class="col">
                                      <div class="form-outline">
                                        
                                      <select name="id_medios_pago" placeholder="yyyy-mm-dd" value=""
                                              min="1997-01-01" max="2030-12-31"class="form-control" id="id_medios_pago" >
                                        
                                            <?php foreach($medios_de_pagos as $mdp){ ?>
                                                
                                                <option value="<?php echo $mdp->id_medios_pago;?>" <?php if($mdp->id_medios_pago==$mdp->id_medios_pago){
                                                    echo 'selected';
                                                }?>><?php echo $mdp->medio_pago;?></option>
                                            <?php } ?>
                                        </select>
                                        <label  class="form-label" for="medio_pago">Método de Pago</label>

                                        <input type="date" name="fecha" id="fecha" class="form-control" value="<?php echo $pago->fecha;?>"/>
                                        <label class="form-label" for="fecha">Fecha</label>
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

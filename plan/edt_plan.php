<?php

require_once("accesscontrol.php");


$ErrorMsg = "";
if(isset($_GET["id"])){try{

        $oApi = new API();
        
        if(!empty($_GET["id"])){
            // si el id no es cero es editar de empleado
            $planes = $oApi->getPlanById($_GET["id"]);    
            $plan = $planes[0];        
            $titulo = "Edición de datos del automovil";
        }else{
            // si el id es cero es alta
            $titulo = "Alta de Plan";
            $jsonModel = '{
                            "id_tipo_plan": 0,
                            "tipo_plan": "",
                            "descripcion": ""                     
                        }';


            $plan = json_decode($jsonModel);

        }
        // --- //
        $userLogeado = $_SESSION['TISA_USERNAME'];//Obtengo el username Logeado
        $usuarioLogeado = $oApi->getIdByUsuario($userLogeado);//instancio el método para obtener el ID del usuario.
        foreach($usuarioLogeado as $usuario){            
                $id_usuario=$usuario->id_usuario;
        }  
    }catch (Exception $e){
        $ErrorMsg =  $e->getMessage();
    }
}else{
    $ErrorMsg = "Falta el parámetro plan";
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
                    <h5 class="modal-title" id="exampleModalLabel">Error de cargando datos</h5>
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

  <!--Buscador con selector-->
  <link rel="stylesheet" type="text/css" href="css/select2.min.css">
  <link rel="stylesheet" href="css/seba.css">
    <script
  src="https://code.jquery.com/jquery-3.6.1.js"
  integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI="
  crossorigin="anonymous"></script>
    <script src="js/select2.min.js"> </script>
              
        <!-- /.acá poner el form yu cargarle los valores -->
       <div class="container-fluid">

                    <!-- Page Heading -->
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="./index.php">Inicio</a></li>
                            <li class="breadcrumb-item"><a href="./index.php?seccion=planes.php">Administración de Planes</a></li>
                            <li class="breadcrumb-item active" aria-current="page"><?php echo $titulo ?></li>
                        </ol>
                    </nav>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary"><?php echo $titulo ; ?></h6>
                        </div>
                        <div class="card-body">                            
                            <div>
                               <form id="form_plan" method="post" action="index.php?seccion=plan/plan_save.php">
                                  <!-- 2 column grid layout with text inputs for the first and last names -->
                                  <div class="row mb-4">
                                    <div class="col" >
                                      <div class="form-outline">
                                      <input style="width:5%;text-align: center;" type="text" name="id_tipo_plan_sh" id="id_tipo_plan_sh" disabled="" class="form-control"  value="<?php echo $plan->id_tipo_plan ;?>" />
                                        <input type="hidden" name="id_tipo_plan" id="id_tipo_plan" class="form-control"  value="<?php echo $plan->id_tipo_plan;?>" />
                                        <label class="form-label" for="id_tipo_plan">ID</label>
                                    </div>

                                        <input style="width:10%" type="text" name="tipo_plan" id="tipo_plan" class="form-control"  value="<?php  echo $plan->tipo_plan?>" />
                                        <label  class="form-label" for="tipo_plan">Plan</label>


                                        <input style="width:50%" type="text" name="descripcion" id="descripcion" class="form-control"  value="<?php  echo $plan->descripcion?>" />
                                        <label class="form-label" for="descripcion">Descripcion</label>
                                  </div>
                                  </div>
                                  <!-- Submit button -->
                                    <button size="45" type="submit" class="btn btn-primary btn-block mb-4" size="15">Guardar</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.container-fluid -->
<?php } ?>
<script type="text/javascript">
$(document).ready(function() {
$('.js-example-basic-single').select2();
});
</script>
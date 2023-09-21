<?php

require_once("accesscontrol.php");

try{
        // valido lo recibido del form
        if (isset($_POST["id_tipo_plan"])){  
         
            $jsonPlan='{
                "id_tipo_plan": '.$_POST["id_tipo_plan"].',
                "tipo_plan": "'.$_POST["tipo_plan"].'",
                "descripcion": "'.$_POST["descripcion"].'"
            
            }';
            $oApi = new API();
            if (empty($_POST["id_tipo_plan"])){
                if(!empty($_GET["tipo_plan"])){
                $oApi->crearPlan($jsonPlan); 
                $Msg = "Plan Creado correctamente";
            }else{
            $Msg = "El Tipo de plan es obligatorio";
                }
            }else{
                if(!empty($_GET["tipo_plan"])){
                $oApi->actualizarPlan($jsonPlan); 
                $Msg = "Plan Actualizado correctamente";
            }else{
                $Msg = "El Tipo de plan es obligatorio";
                }
            }   
        }else{
            if (isset($_GET["id_tipo_plan"])){
                $oApi = new API();
                if($_GET["activo"]==1){
                $oApi->desactivarPlan($_GET["id_tipo_plan"]);
                $Msg = "El plan se desactivó correctamente";}
                else{
                $oApi->activarPlan($_GET["id_tipo_plan"]);
                $Msg = "El plan se activó correctamente";  
                }
                   
            }else{
                $var = $_POST["id_tipo_plan"];
                $Msg = "Faltan datos para completar la operación / no entró a ningun lado $var";
            }
        }        
    }catch (Exception $e){
        $Msg =  $e->getMessage();
    }

?>


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
                    <h5 class="modal-title" id="exampleModalLabel">Estado del Plan</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body"><?php if (!empty($Msg)){echo $Msg;} ?></div>
                <div class="modal-footer">
                    <a href="index.php?seccion=planes.php">
                    <button class="btn btn-primary" type="button" >OK</button> 
                    </a>                   
                </div>
            </div>
        </div>
    </div>
    <!-- fin error Modal-->




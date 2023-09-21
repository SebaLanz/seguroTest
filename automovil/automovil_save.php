<?php

require_once("accesscontrol.php");



try{
        // valido lo recibido del form
        if (isset($_POST["id_automovil"])){
           
            $jsonAutomovil = '{
                                "id_automovil": '.$_POST["id_automovil"].',
                                "id_cliente": '.$_POST["id_cliente"].',
                                "patente": "'.$_POST["patente"].'",
                                "modelo": "'.$_POST["modelo"].'",
                                "id_marca": "'.$_POST["id_marca"].'",
                                "id_tipo_automovil": "'.$_POST["id_tipo_automovil"].'"
                               
                            }';; 

            $oApi = new API();
            if (empty($_POST["id_automovil"])){
                $oApi->crearAutomovil($jsonAutomovil); 
                $Msg = "automovil Creado correctamente";
            }else{
                $oApi->actualizarAutomovil($jsonAutomovil); 
                $Msg = "automovil Actualizado correctamente";
            }   
        }else{
            if (isset($_GET["patente"])){
                $oApi = new API();
                if($_GET["activo"]==1){
                $oApi->desactivarAutomovil($_GET["patente"]);
                $Msg = "El automovil con Patente <b>".$_GET["patente"]."</b> se desactivó correctamente";}
                else{
                $oApi->activarAutomovil($_GET["patente"]);
                $Msg = "El automovil con Patente <b>".$_GET["patente"]."</b> se activó correctamente";  
                }
                   
            }else{
                $var = $_POST["id_automovil"];
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
                    <h5 class="modal-title" id="exampleModalLabel">automovil</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body"><?php if (!empty($Msg)){echo $Msg;} ?></div>
                <div class="modal-footer">
                    <a href="index.php?seccion=automoviles.php">
                    <button class="btn btn-primary" type="button" >OK</button> 
                    </a>                   
                </div>
            </div>
        </div>
    </div>
    <!-- fin error Modal-->




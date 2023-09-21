<?php

require_once("accesscontrol.php");


$Msg = "Datos guardados correctamente";
try{

        // valido lo recibido del form
        if (isset($_POST["id_plan_pago"])){
            $jsonPago = '{               
                                "id_plan_pago": "'.$_POST["id_plan_pago"].'",
                                "id_automovil": "'.$_POST["id_automovil"].'",
                                "id_tipo_plan": "'.$_POST["id_tipo_plan"].'",
                                "id_medios_pago": "'.$_POST["id_medios_pago"].'",
                                "abonó": "'.$_POST["abonó"].'",
                                "fecha": "'.$_POST["fecha"].'"                         
                            }';


            $oApi = new API();
            if (empty($_POST["id_plan_pago"])){
                $oApi->crearPago($jsonPago); 
                $Msg = "Pago creado correctamente";
            }else{
                $oApi->actualizarPago($jsonPago); 
                $Msg = "Pago actualizado correctamente";
            }   
        
                   
            }else{
                $Msg = "Faltan datos para completar la operación / no entró a ningun lado";
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
                    <h5 class="modal-title" id="exampleModalLabel">Cliente</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body"><?php if (!empty($Msg)){echo $Msg;} ?></div>
                <div class="modal-footer">
                    <a href="index.php?seccion=pagos.php">
                    <button class="btn btn-primary" type="button" >OK</button> 
                    </a>                   
                </div>
            </div>
        </div>
    </div>
    <!-- fin error Modal-->






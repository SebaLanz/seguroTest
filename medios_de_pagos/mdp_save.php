<?php

require_once("accesscontrol.php");

try{
        // valido lo recibido del form
        if (isset($_POST["id_medios_pago"])){  
         
            $jsonPago='{
                "id_medios_pago": '.$_POST["id_medios_pago"].',
                "medio_pago": "'.$_POST["medio_pago"].'"
            
            }';
            $oApi = new API();
            if (empty($_POST["id_medios_pago"])){
                if($_POST["medio_pago"] == ""){
                    $Msg = "Medio de Pago necesario";
                }else{                  
                $oApi->crearMedioDePago($jsonPago); 
                $Msg = "Medio de Pago Creado correctamente";  
                }      
            }else{       
                if($_POST["medio_pago"] == ""){
                    $Msg = "Medio de Pago necesario";
                }else{                  
                $oApi->actualizarPago($jsonPago); 
                $Msg = "Medio de Pago Actualizado correctamente";  
                }      
            }   
        }else{
            if (isset($_GET["id_medios_pago"])){
                $oApi = new API();
                if($_GET["estado"]==1){
                $oApi->desactivarPago($_GET["id_medios_pago"]);
                $Msg = "El Medio de Pago se desactivó correctamente";}
                else{
                $oApi->activarPago($_GET["id_medios_pago"]);
                $Msg = "El Medio de Pago se activó correctamente";  
                }
                   
            }else{
                $var = $_POST["id_medios_pago"];
                $Msg = "Faltan datos para completar la operación";
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
                    <h5 class="modal-title" id="exampleModalLabel">Estado de los Medios de Pagos</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body"><?php if (!empty($Msg)){echo $Msg;} ?></div>
                <div class="modal-footer">
                    <a href="index.php?seccion=medios_de_pagos.php">
                    <button class="btn btn-primary" type="button" >OK</button> 
                    </a>                   
                </div>
            </div>
        </div>
    </div>
    <!-- fin error Modal-->




<?php

require_once("accesscontrol.php");

try{
    
        // valido lo recibido del form
        if (isset($_POST["id_usuario"])){
            if(empty($_POST["cod_provincia"])){
                $_POST["cod_provincia"] = null;
            }
            $jsonUsuario = '{
                                "id_usuario_perfil": 1,
                                "nombre": "'.$_POST["nombre"].'",
                                "apellido": "'.$_POST["apellido"].'",
                                "dni": "'.$_POST["dni"].'",
                                "calle": "'.$_POST["calle"].'",
                                "numero_calle": "'.$_POST["numero_calle"].'",
                                "localidad": "'.$_POST["localidad"].'",
                                "telefono": "'.$_POST["telefono"].'",
                                "cod_provincia": "'.$_POST["cod_provincia"].'",
                                "id_usuario": "'.$_POST["id_usuario"].'"
                                
                            }';
            $oApi = new API();
                //actualizarUsuarioPerfil actualizo los datos del usuario
                $oApi->actualizarUsuarioPerfil($jsonUsuario);

                //actualizarUsuario actualizo el email.
                     $emailRecibido = $_POST['email'];
                     $usuarioRecibido = $_POST['usuario'];
                $oApi->actualizarUsuario($usuarioRecibido,$emailRecibido);
                $Msg = "Perfil Actualizado correctamente";
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
                    <h5 class="modal-title" id="exampleModalLabel">Usuarios</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body"><?php if (!empty($Msg)){echo $Msg;} ?></div>
                <div class="modal-footer">
                    <a href="index.php?seccion=usuario/edt_perfil.php">
                    <button class="btn btn-primary" type="button" >OK</button> 
                    </a>                   
                </div>
            </div>
        </div>
    </div>
    <!-- fin error Modal-->
















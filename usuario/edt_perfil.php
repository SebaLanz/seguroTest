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
        $usuarioImg = $oApi->getUsuarioImgPerfil($id_usuario);  
        $usuarioPerfil = $oApi->getUsuarioPerfilAll($id_usuario);
        $usuarioPerfilAll = $oApi->getUsuarioPerfilDatosAll($id_usuario);
        $provincias = $oApi->getProvincias(); 

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
              
        <!-- /.acá poner el form yu cargarle los valores -->
       <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Administración del Perfil</h1>
        <p class="mb-4"> </p>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h4 class="m-0 font-weight-bold text-success"><?php //echo $userLogeado ; ?></h4>
            </div>
            <div class="card-body">                            
                <div>
                    <form id="form_usuario" method="post" action="index.php?seccion=usuario/usuarioPerfil_save.php">

                    <section style="background-color: #eee;">
              <div class="container py-5">
                <div class="row">
                  <div class="col">
                    <nav aria-label="breadcrumb" class="bg-light rounded-3 p-3 mb-4">
                      <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="index.php">Menú</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Perfil del Usuario</li>
                      </ol>
                    </nav>
                  </div>
                </div>

                <div class="row">
                  <div class="col-lg-4">
                    <div class="card mb-4">
                      <div class="card-body text-center">
                        <img src="
                        <?php                                
                            foreach($usuarioImg as $uImg){ 
                            echo $uImg->imgPerfil;           
                            }//Acá Obtengo la foto de perfil
                        ?>       
                        " alt="Imagen"
                          class="rounded-circle img-fluid" style="width: 150px;">
                        <h5 class="my-2"><?php echo "-> ".$userLogeado." <-";?></h5>
                        
                        <?php foreach($usuarioPerfil as $uPerfil){ ?>
                        
                        <p class="text-muted mb-1"><?php echo "Permiso: ".$uPerfil->perfil?></p>
                       
                        <?php }?>

                        <div class="d-flex justify-content-center mb-2">
                          <!--<button type="button" class="btn btn-primary">Cambiar Imagen</button>-->
                          <!--<button type="button" class="btn btn-outline-primary ms-1">Message</button>-->
                        </div>
                      </div>
                    </div>
        
      </div>
      <?php foreach($usuarioPerfilAll as $uPerfilDatos){ ?>
      <div class="col-lg-8">
        <div class="card mb-4">
          <div class="card-body">
          <div class="row">
              <div class="col-sm-3">
               
              </div>
              <div class="col-sm-9">
              </div>
            </div>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0"></p>
              </div>
              <div class="col-sm-9">
              <input type="hidden" name="id_usuario" id="id_usuario" class="form-control"  value="<?php echo $usuario->id_usuario;?>" />
              <?php if($usuario->id_usuario != 0){?><input type="hidden" name="usuario" id="usuario" class="form-control" value="<?php  echo $usuario->usuario;?>" /><?php }?>
            </div>
            </div>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Nombre</p>
              </div>
              <div class="col-sm-9">
                <input type="text" name="nombre" id="nombre" required="" class="form-control" value="<?php echo $uPerfilDatos->nombre;?>" />
              </div>
            </div>
            <hr>
            <!---->
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Apellido</p>
              </div>
              <div class="col-sm-9">
              <input type="text" name="apellido" id="apellido" required=""class="form-control" value="<?php echo $uPerfilDatos->apellido;?>" />
              </div>
            </div>
            <hr>
            <!---->
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">DNI</p>
              </div>
              <div class="col-sm-9">
              <input type="text" name="dni" id="dni" class="form-control" value="<?php echo $uPerfilDatos->dni;?>" />
              </div>
            </div>
            <hr>
            <!---->
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Calle</p>
              </div>
              <div class="col-sm-9">
              <input type="text" name="calle" id="calle" class="form-control" value="<?php echo $uPerfilDatos->calle;?>" />
              </div>
            </div>
            <hr>
            <!---->
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">N° Calle</p>
              </div>
              <div class="col-sm-9">
              <input type="text" name="numero_calle" id="numero_calle" class="form-control" value="<?php echo $uPerfilDatos->numero_calle;?>" />
              </div>
            </div>
            <hr>
            <!---->
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Localidad</p>
              </div>
              <div class="col-sm-9">
              <input type="text" name="localidad" id="localidad" class="form-control" value="<?php echo $uPerfilDatos->localidad;?>" />
              </div>
            </div>
            <hr>
            <!---->
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Teléfono</p>
              </div>
              <div class="col-sm-9">
              <input type="text" name="telefono" id="telefono" class="form-control" value="<?php echo $uPerfilDatos->telefono;?>" />
              </div>
            </div>
            <hr>
            <!---->
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Provincia</p>
              </div>
              <div class="col-sm-9">
            <select name="cod_provincia" class="form-control" id="provincia" >
                <?php if($uPerfilDatos->cod_provincia==null) { ?>
                    <option value="">Sin provincia </option>
                <?php } ?>
                <?php foreach($provincias as $provincia){ ?>
                    <option value="<?php echo $provincia->cod_provincia;?>" <?php if($provincia->cod_provincia==$uPerfilDatos->cod_provincia){
                        echo 'selected';
                    }?>><?php echo $provincia->provincia;?></option>
                <?php } ?>
            </select>
            </div>
            </div>
            <hr>
            <!---->
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Email</p>
              </div>
              <div class="col-sm-9">
              <input type="text" name="email" required="" id="email" class="form-control" value="<?php echo $usuario->email;?>" />
              </div>
            </div>
            <hr>
            
          </div>
        </div>
        <?php }?> 
      </div>
    </div>
  </div>
</section>
                                 

      <!-- Submit button -->
      <button type="submit" class="btn btn-primary btn-block mb-4">Guardar</button>
      
        <!--?php echo $empleado->id_empleado;?>-->
        <td><a href="index.php?">
        <button class="btn btn-primary btn-block mb-4" type="button" >Volver Atras</button>
          </a>
        </td> 
      
    </form>
</div>
</div>
</div>

</div>
<!-- /.container-fluid -->
<?php } 



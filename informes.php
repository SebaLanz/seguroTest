<?php

require_once("accesscontrol.php");
$ErrorMsg = "";
try{
        $oApi = new API();
        $informes = $oApi->getInformesAll();   
        $informesMe = $oApi->getInformesMe();   
        $informesMp = $oApi->getInformesMp();   
        $informesPe = $oApi->getInformesPe();   
        $rubros = $oApi->getRubrosAll();  
         
    }catch (Exception $e){
        $ErrorMsg =  $e->getMessage();
    }



?>
<?php
$materia = "";
if (!empty($_POST['materia'])) {
    $materia=$_POST['materia'];
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



    <!-- PROBANDO FILTROS-->
<?php } ?>    
<!-- Begin Page Content -->
<?php if(empty($ErrorMsg)) { ?>
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="./index.php">Inicio</a></li>
        <li class="breadcrumb-item active" aria-current="page">Administración de Informes</li>
    </ol>
</nav>
                    
                    <h1 class="h3 mb-2 text-gray-800">Administración de Informes</h1>
                    <p class="mb-4"> </p>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">

                           
                        </div>
                        
                        <div class="card-body">
                            <div class="table-responsive">
                                
                                <!-- LISTA DESPLEGABLE DE RUBROS-->
                                <form method="post">
                                
                                <select name="materia" class="btn btn dropdown-toggle" style="background-color:#0076CE;color:white" >
                                    <option style="background-color:#0076CE;color:white" selected="true"  disabled selected> Seleccione el Rubro</option>
                                    <option style="background-color:#0076CE;color:white" value="mp">Materia Prima</option>
                                    <option style="background-color:#0076CE;color:white" value="me">Material de Empaque</option>
                                    <option style="background-color:#0076CE;color:white" value="pe">Producto elaborado</option>
                                    
                                </select> <br><br>
                                <button name="buscar" type="submit" class="btn btn-primary" style="background-color:#0076CE;color:white">Filtrar</button>                                             
                                </form>
                                <!-- LISTA DESPLEGABLE TERMINA-->

                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">

                            <?php 
                                if ($materia == "mp" || $materia == "me") {?>
                            <thead>
                                    <tr style="background-color:#d2ffbd">
                                    <th >ID</th>
									<th>N° Lote</th>
                                    <th>Producto</th>
                                    <th>Cód. Producto</th>
                                    <th>Vencimiento</th>
                                    <th>N° Bultos</th>
                                    <th>N° Stock</th> 
                                    <th>Origen</th> 
                                    <th>Presentación</th>  
                                    <th>Mostrar</th>  
                            </thead>
                            <?php }else{?>
                                <thead>
                                <tr style="background-color:#d2ffbd">
                                <th>ID</th>    
								<th>N° Stock</th> 	
								<th>Nombre</th> 
                                <th>Cód. Producto</th>
                                <th>N° Lote</th>
                                <th>Vencimiento</th>
                                <th>N° Bultos</th>
                                <th>Origen</th> 
                                <th>Presentación</th>  
                                <th>Mostrar</th>  
                        </thead>
                           <?php } ?>
                                <tbody>
                                
                                <?php 
                                if ($materia == "mp") {
                                    
                                    foreach($informesMp as $informe){ ?>
                                        <tr>
                                            <td><?php echo $informe->id_stock;?></td>
											<td><?php echo $informe->nro_stock;?></td>
                                            <td><?php echo $informe->producto?></td>
                                            <td><?php echo $informe->codigo_producto;?></td>
                                            <td><?php echo $informe->vencimiento;?></td>
                                            <td><?php echo $informe->bultos;?></td>
											<td><?php echo $informe->nro_lote;?></td>
                                            <td><?php echo $informe->iso_origen;?></td>
                                            <td><?php echo $informe->presentacion;?></td>                                          
                                            <td>                                            
                                                <div class=btn-group>
                                                    
                                                    
                                                    <a class="btn btn-outline-success" href="index.php?seccion=informe/edt_informe.php&id=<?php echo $informe->nro_stock;?>"
                                                    data-toggle="tooltip" data-placement="bottom" title="Mostrar">
                                                    <i class="fas fa-arrow-right"></i>
                                                    </a>
                                                </div>																													
                                        </tr>                                    
                                    <?php }                                
                                }?>
                                
                                <?php 
                                if ($materia == "me") {
                                    
                                    foreach($informesMe as $informe){ ?>
                                        <tr>
                                        <td><?php echo $informe->id_stock;?></td>
										<td><?php echo $informe->nro_stock;?></td>
                                        <td><?php echo $informe->producto?></td>
                                        <td><?php echo $informe->codigo_producto;?></td>
                                        <td><?php echo $informe->vencimiento;?></td>
                                        <td><?php echo $informe->bultos;?></td>
										<td><?php echo $informe->nro_lote;?></td>
                                        <td><?php echo $informe->iso_origen;?></td>
                                        <td><?php echo $informe->presentacion;?></td>    
                                        <td>                                            
                                        <div class=btn-group>                                             
                                            <a class="btn btn-outline-success" href="index.php?seccion=informe/edt_informe.php&id=<?php echo $informe->nro_stock;?>"
                                            data-toggle="tooltip" data-placement="bottom" title="Mostrar">
                                            <i class="fas fa-arrow-right"></i>
                                            </a>
                                        </div>		                                                                                                       
                                    </tr>  
                                    <?php }                                



                                }?>  
                                
                                <?php 
                                if ($materia == "pe") {
                                    
                                    foreach($informesPe as $informe){ ?>
                                        <tr>
                                        <td><?php echo $informe->id_stock;?></td>
										<td><?php echo $informe->nro_stock;?></td>
										<td><?php echo $informe->nombre_pe;?></td>
                                        <td><?php echo $informe->codigo_producto;?></td>
										<td><?php echo $informe->nro_lote;?></td>
                                        <td><?php echo $informe->vencimiento;?></td>
                                        <td><?php echo $informe->bultos;?></td>
                                        <td><?php echo $informe->iso_origen;?></td>
                                        <td><?php echo $informe->presentacion;?></td>    
                                        <td>                                            
                                        <div class=btn-group>                                             
                                            <a class="btn btn-outline-success" href="index.php?seccion=informe/informe_save.php&id=<?php echo $informe->nro_stock;?>"
                                            data-toggle="tooltip" data-placement="bottom" title="Mostrar">
                                            <i class="fas fa-arrow-right"></i>
                                            </a>
                                        </div>		
                                        

                                    </tr>  
                                    <?php }                                




                                }?>    
                                 
                                </tbody>
                            </table>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

                

<?php } 



include_once FOOTER_FILE;?>

<script>
    $('#dataTable').DataTable({
        "language": {
            "url": "lenguaje.json"
        }
    });
</script>
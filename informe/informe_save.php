<?php

require_once("accesscontrol.php");

//en "id" recibo el n° de stock
$ErrorMsg = "";
if(isset($_GET["id"])){try{

        $oApi = new API();
        
       $mp = $_GET["id"];
        
    }catch (Exception $e){
        $ErrorMsg =  $e->getMessage();
    }
}else{
    $ErrorMsg = "Falta el parámetro de Stock";
}
?>
<?php
$ErrorMsg = "";
try{
        $oApi = new API();
        $informesDpe = $oApi->getMateriaDePE($mp);   
		$informesNPE = $oApi->getNombrePE($mp);  
         
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
                     <!-- Page Heading -->
                     <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="./index.php">Inicio</a></li>
                        <li class="breadcrumb-item"><a href="./index.php?seccion=informes.php">Administración de Informes</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Detalle Producto Elaborado</li>
                    </ol>
                </nav>
                    <h1 class="h3 mb-2 text-gray-800">Detalle Producto Elaborado</h1>
					<h1 class="h5 mb-2 text-gray-800"><?php foreach($informesNPE as $informe){
									echo $mp." -> ".$informe->nombre_pe;}  ?></h1>                          
                             
                                    

                    <p class="mb-4"> </p>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary"></h6>
                        </div>
                        <div class="card-body">                            
                            <div>
                             
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                              <thead>
                                <tr style="background-color:#d2ffbd">
                                <th>Orden Producción</th>
                                <th>Fecha de Orden</th>
                                <th>Cod. Producto</th>
								<th>Producto</th>
								<th>Cantidad</th>
								<th>Detalle</th>
                                <th>N° Stock</th>
                                <th>N° Lote</th> 
                                <th>Vencimiento</th>  
                              </thead>              
                              <tbody>
                              <?php 
                                
                                    
                                    foreach($informesDpe as $informe){ ?>
                                        <tr>
                                            <td><?php echo $informe->orden_prod;?></td>
                                            <td><?php echo $informe->fecha_orden_prod;?></td>
                                            <td><?php echo $informe->codigo_producto;?></td>
                                            <td><?php echo $informe->producto;?></td>
											<td><?php echo $informe->cantidad;?></td>
											<td><?php echo $informe->detalle;?></td>
                                            <td><?php echo $informe->nro_stock;?></td>
                                            <td><?php echo $informe->nro_lote;?></td>
                                            <td><?php echo $informe->vencimiento;?></td>                                       
                                                                                   
                                                																											
                                        </tr>                                    
                                    <?php }                                
                                ?>


                              
                            
                              
                              </tbody>
                           </table>         
                                        
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
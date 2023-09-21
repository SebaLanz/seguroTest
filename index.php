<?php
session_start();
require_once("config/constantes.php");
require_once("accesscontrol.php");
require_once("clases/API.class.php");
?>
<?php include_once HEADER_FILE; 
if (isset($_GET['seccion'])){
	include_once $_GET['seccion'];
}else{
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Proyecto TISA</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="estilo.css">
</head>
<body>

<div class="intro-container">
    
</div>
</body></html>

<?php } ?>
<?php include_once FOOTER_FILE; ?>
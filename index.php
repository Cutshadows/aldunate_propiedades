<?include_once("includes/conexion.php");
$conn=conectar();


?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta http-equiv="content-type" content="text/html; utf-8">
    <!-- <meta charset="UTF-8"> -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Propiedades Aldunate</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/animate.css">
    <link rel="stylesheet" href="css/min.css">
	<link rel="stylesheet" href="css/price_range_style.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css" type="text/css" media="all" />

</head>
<body>

<?include("includes/pages/menu.php");?>



<div id="contenedor" name="contenedor">
</div>

    <div class="jumbotron text-center" style="margin-bottom:0">
     <p>INFORMACION DEL FOOTER</p>
    </div>
<script src="js/jquery.js"></script>
<script src="js/carousel.js"></script>    
<script src="js/jsfunciones.js"></script>    
<script src="js/bootstrap.min.js"></script>
<script src="js/price_range_script.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js" type="text/javascript"></script>

<script>
  verContenedor('detalles.php',1);
</script>

</body>
</html>
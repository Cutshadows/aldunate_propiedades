<?
include_once("includes/conexion.php");
$conn = conectar();
    write_visita ();
    get_client_ip();

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta http-equiv="content-type" content="text/html; UTF-8">
    <link rel="icon" href="img/aldunate.ico">
    <!-- <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"> -->
    <!-- <meta charset="UTF-8"> -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Propiedades Aldunate</title>
    <!-- <link rel="stylesheet" href="css/bootstrap.css"> -->
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/animate.css">
    <link rel="stylesheet" href="./css/min.css">
    <link rel="stylesheet" href="./css/price_range_style.css">
    <link rel="stylesheet" href="./cliente/css/notifications.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-slider/10.6.1/css/bootstrap-slider.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-slider/10.6.1/css/bootstrap-slider.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css" type="text/css" media="all" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">


</head>

<body>
    <!--Carousel Wrapper-->
<div id="carousel-thumb" class="carousel slide carousel-fade carousel-thumbnails" data-ride="carousel">
  <!--Slides-->
  <div class="carousel-inner" role="listbox">
    <div class="carousel-item active">
      <img class="d-block w-100" src="https://mdbootstrap.com/img/Photos/Slides/img%20(88).jpg"
        alt="First slide">
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" src="https://mdbootstrap.com/img/Photos/Slides/img%20(121).jpg"
        alt="Second slide">
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" src="https://mdbootstrap.com/img/Photos/Slides/img%20(31).jpg"
        alt="Third slide">
    </div>
  </div>
  <!--/.Slides-->
  <!--Controls-->
  <!--a class="carousel-control-prev" href="#carousel-thumb" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carousel-thumb" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a-->
  <!--/.Controls-->
  <ol class="carousel-control-prev" style="list-style-type:none;">
    <li data-target="#carousel-thumb" data-slide-to="0" class="active" style="position:absolute;top: 0px;bottom: 0;left: 0;right: 0;width: 50%;height: 30%;margin: auto;">
      <img src="https://mdbootstrap.com/img/Photos/Others/Carousel-thumbs/img%20(88).jpg" width="100">
    </li>
    <li data-target="#carousel-thumb" data-slide-to="1"  style="position:absolute;top: 100px;bottom: 0;left: 0;right: 0;width: 50%;height: 30%;margin: auto;">
      <img src="https://mdbootstrap.com/img/Photos/Others/Carousel-thumbs/img%20(121).jpg" width="100">
     </li>
    <li data-target="#carousel-thumb" data-slide-to="2"  style="position:absolute;top:200px;bottom: 0;left: 0;right: 0;width: 50%;height: 30%;margin: auto;">
      <img src="https://mdbootstrap.com/img/Photos/Others/Carousel-thumbs/img%20(31).jpg" width="100">
    </li>
  </ol>
</div>
<!--/.Carousel Wrapper-->

    <? include("includes/pages/menu.php"); ?>



    <div id="contenedor" name="contenedor">
    </div>

    <!-- <div class="jumbotron text-center" style="margin-bottom:0">
        <p>INFORMACION DEL FOOTER</p>
    </div> -->
    <? include("includes/pages/footer.php"); ?>
    <script src="./js/jquery.js"></script>
    <script src="./js/carousel.js"></script>
    <script src="./js/jsfunciones.js"></script>
    <script src="./js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-slider/10.6.1/bootstrap-slider.js" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-slider/10.6.1/bootstrap-slider.min.js" type="text/javascript"></script>

    <script>
        verContenedor('detalles.php', 1);
    </script>

</body>

</html> 
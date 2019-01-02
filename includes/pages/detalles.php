<?
$_POST[];
?>

<? include_once("includes/conexion.php");
$conn = conectar();


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Propiedades Aldunate</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/animate.css">
    <link rel="stylesheet" href="css/min.css">
</head>
<body>

<? include("includes/pages/menu.php"); ?>



<div id="sliderAldunate" class="carousel slide" data-ride="carousel">
  <ul class="carousel-indicators">
  <?
    $consulContenido2 = $conn->query("SELECT coTitulo, coidContenido, coDescripcion FROM tb_contenido");
    $activarItem2 = 0;
    while ($resultContenido2 = $consulContenido2->fetch_assoc()) {
      /* echo $resultContenido2['coTitulo']; */
        $consultImg1 = $conn->query("SELECT coidImagen, coNomimg, tb_contenido_coidContenido, cotipoImg FROM tb_imagenes WHERE tb_contenido_coidContenido=" . $resultContenido2['coidContenido'] . " AND cotipoImg='carrusel' ORDER BY coidImagen ASC");
        while ($resultImagen2 = $consultImg1->fetch_assoc()) {

            ?>
  <li data-target="#sliderAldunate" data-slide-to="<?= $activarItem2; ?>" <? if ($activarItem2 == 0) { ?>class="<? echo 'active'; ?>"<?
                                                                                                                            } ?>></li>
    <!-- <li data-target="#sliderAldunate" data-slide-to="1"></li> -->
    <!-- <li data-target="#sliderAldunate" data-slide-to="2"></li> -->
    <?
    $activarItem2++;
}
}
?>
    </ul>
    <div class="carousel-inner">
  <?
    $consulContenido = $conn->query("SELECT coTitulo, coidContenido, coDescripcion FROM tb_contenido");
    $activarItem = 0;
    while ($resultContenido = $consulContenido->fetch_assoc()) {
      /* echo $resultContenido['coTitulo']; */
        $consultImg = $conn->query("SELECT coidImagen, coNomimg, tb_contenido_coidContenido, cotipoImg FROM tb_imagenes WHERE tb_contenido_coidContenido=" . $resultContenido['coidContenido'] . " AND cotipoImg='carrusel' ORDER BY coidImagen ASC");
        while ($resultImagen = $consultImg->fetch_assoc()) {
            if ($activarItem == 0) {
                $item = "active";
            } else {
                $item = "";
            }

            ?>
  
     	<div class="carousel-item <?= $item; ?>" style="height: 60%!important; margin-top:10%;" >
     	 	<img src="img/contenido/<?= $resultImagen['coNomimg']; ?>" ><!-- alt="Colina" -->
     	 	<div class="carousel-caption fadeInLeft ">
				<div class="caption-titulo" >
					<p><?= substr($resultContenido['coTitulo'], 0, 20); ?></p>
				</div>
				<div class="caption-contenido">
					<p><?= substr($resultContenido['coDescripcion'], 0, 40); ?>...</p>
					<p><a class="btn btn-sm btn-success" id="carouselButtons" href="/" role="button">Ver Más</a></p>          
				</div>
     	 	</div>   
	  	</div>

    <?
    $activarItem++;
}
} ?>
  
  </div>
  <a class="carousel-control-prev" href="#sliderAldunate" data-slide="prev">
    <span class="carousel-control-prev-icon"></span>
  </a>
  <a class="carousel-control-next" href="#sliderAldunate" data-slide="next">
    <span class="carousel-control-next-icon"></span>
  </a>
</div>


<!-- FILTRO DE LA BUSQUEDAS -->

<section class="jumbotron text-center">
    <div class="container">
        <h1 class="jumbotron-heading">Descripcion de </h1>
        <div class="row">
			     
        </div>        
    </div>
</section>




<div class="album py-5 bg-light">
        <div class="container">

          <div class="row" id="mostrar_resultado" name="mostrar_resultado">
          <?
            $consultaContenido = $conn->query("SELECT * FROM tb_contenido");
            while ($resultadoContenido = $consultaContenido->fetch_assoc()) {
                $consultaImagenes = $conn->query("SELECT coNomimg, coidImagen, cotipoImg, tb_contenido_coidContenido FROM tb_imagenes WHERE tb_contenido_coidContenido= " . $resultadoContenido['coidContenido'] . " AND cotipoImg='principal'");
                $Imagen = $consultaImagenes->fetch_assoc();
                ?>
            <div class="col-md-4">
              <div class="card mb-4 shadow-sm">
                <img class="card-img-top" src="img/contenido/<?= $Imagen['coNomimg']; ?>" alt="Thumbnail [100%x225]" style="height: 225px; width: 100%; display: block;"  data-holder-rendered="true"> <!-- data-src="holder.js/100px225?theme=thumb&amp;bg=55595c&amp;fg=eceeef&amp;text=Thumbnail" alt="Thumbnail [100%x225]" style="height: 225px; width: 100%; display: block;" src="data:image/svg+xml;charset=UTF-8,%3Csvg%20width%3D%22348%22%20height%3D%22225%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20viewBox%3D%220%200%20348%20225%22%20preserveAspectRatio%3D%22none%22%3E%3Cdefs%3E%3Cstyle%20type%3D%22text%2Fcss%22%3E%23holder_166aba16d02%20text%20%7B%20fill%3A%23eceeef%3Bfont-weight%3Abold%3Bfont-family%3AArial%2C%20Helvetica%2C%20Open%20Sans%2C%20sans-serif%2C%20monospace%3Bfont-size%3A17pt%20%7D%20%3C%2Fstyle%3E%3C%2Fdefs%3E%3Cg%20id%3D%22holder_166aba16d02%22%3E%3Crect%20width%3D%22348%22%20height%3D%22225%22%20fill%3D%22%2355595c%22%3E%3C%2Frect%3E%3Cg%3E%3Ctext%20x%3D%22116.71875%22%20y%3D%22120.15%22%3EThumbnail%3C%2Ftext%3E%3C%2Fg%3E%3C%2Fg%3E%3C%2Fsvg%3E" data-holder-rendered="true"> -->
                <div class="card-body">
                  <p class="card-text"><?= utf8_encode($resultadoContenido['coDescripcion']); ?></p>
                  <div class="d-flex justify-content-between align-items-center">
                    <div class="btn-group">
                      <button type="button" class="btn btn-sm btn-outline-primary">Detalles</button>
                      <button type="button" class="btn btn-sm btn-outline-primary">Compartir</button>
                    </div>
                    <small class="text-muted">9 mins</small>
                  </div>
                </div>
              </div>
            </div>
            <?
        } ?>
          </div>
        </div>
      </div>

    <div class="jumbotron text-center" style="margin-bottom:0">
     <p>INFORMACION DEL FOOTER</p>
    </div>
<script src="js/jquery.js"></script>
<script src="js/carousel.js"></script>    
<script src="js/bootstrap.min.js"></script>




</body>
</html>
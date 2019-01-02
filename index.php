<?include_once("includes/conexion.php");
$conn=conectar();


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
	<link rel="stylesheet" href="css/price_range_style.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css" type="text/css" media="all" />

</head>
<body>

<?include("includes/pages/menu.php");?>



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
  <li data-target="#sliderAldunate" data-slide-to="<?=$activarItem2; ?>" <?if ($activarItem2 == 0) {?>class="<?echo 'active'; ?>"<?}?>></li>
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
  
     	<div class="carousel-item <?=$item;?>" style="height: 60%!important;" >
     	 	<img src="img/contenido/<?=$resultImagen['coNomimg'];?>" style="height:750px;" ><!-- alt="Colina" -->
     	 	<div class="carousel-caption fadeInLeft ">
				<div class="caption-titulo" >
					<p><?= substr($resultContenido['coTitulo'],0, 20); ?></p>
				</div>
				<div class="caption-contenido">
					<p><?= substr($resultContenido['coDescripcion'], 0, 40); ?>...</p>
					<p><a class="btn btn-sm btn-success" id="carouselButtons" href="/" role="button">Ver Más</a></p>          
				</div>
     	 	</div>   
	  	</div>

    <?
    $activarItem ++;
  }
}?>
  
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
        <h1 class="jumbotron-heading">Busqueda de Propiedad</h1>
        <div class="row mb20">
			<div class="col-md-6">
				<fieldset>
					<label for="busqueda" class="form-label large">Buscar Propiedad por Palabra Clave</label>
					<input type="text" id="busqueda"  name="busqueda" class="form-control input-sm" placeholder="Busqueda">
				</fieldset>
			  </div>
			  <div class="col-md-3">
				  <label for="busqueda" class="form-label large">&nbsp;</label>
			  	<div class="input-group">
					  <!-- <label for="busqueda" class="small">¿Estacionamiento?</label> -->
			  		<select class="form-control" name="slctComuna" id="slctComuna" >
			  			<option value="0">Comuna</option>
			  			<?
			  		$pregunta = $conn->query("SELECT * FROM tb_comuna ORDER BY coidComuna ='P2C2CO07' DESC");
			  		$numOrden = 1;
			  		while ($row = $pregunta->fetch_assoc()) {
			  			$seleccionado = $datos['coComuna'] == $row['coidComuna'] ? 'selected="selected"' : "";
			  			$nombre = utf8_encode($row['coNomComuna']);
			  			echo '<option value="' . $row['coidComuna'] . '" ' . $seleccionado . '  > ' . $numOrden . '. ' . $nombre . ' </option>';
			  			$numOrden++;
			  		}
			  		?>
			  		</select>
			  	</div>
			  </div> 
		  </div>
		  <div class="row">
			<div class="col-md-1">
				<label class="form-label small">Valor :</label>
			</div>
			<div class="col-md-2">
				<div class="row ">
					<div class="form-check-inline">
						<label class="form-check-label">
							<input type="radio" class="form-check-input" name="optradio">Valor CLP
						</label>
					</div> 
					<div class="form-check-inline">
						<label class="form-check-label">
							<input type="radio" class="form-check-input" name="optradio"> Valor UF
						</label>
					</div>
				</div>
			</div>
			<div class="col-md-2">
				<label class="form-label small"> Rango de Valor :</label>
			</div>
			<div class="col-md-6">
				<div class="price-range-block" style="margin:10px!important;">
					<!-- <div class="sliderText">jQuery UI Price Range Slider</div> --> 
							<div id="slider-range" class="price-filter-range" style="width:80%!important;" name="rangeInput">
								
							</div>
							<div class="col-md-8">
								<input type="number" min=0 max="9900" oninput="validity.valid||(value='0');" id="min_price" class="price-range-field" style="width: 45%!important;" />
								<input type="number" min=0 max="10000" oninput="validity.valid||(value='10000');" id="max_price" class="price-range-field" style="width: 45%!important;" />
							</div>
						<!-- <button class="price-range-search" id="price-range-submit">Search</button> -->
						<!-- <div id="searchResults" class="search-results-block"></div> -->
				</div>
			</div>
			
			
			
		</div>
        <div class="row mb20">
			<div class="col-md-3">
				<div class="input-group">
					<!-- <label for="busqueda" class="small">¿Cuantos Baños?</label> -->
					<select class="form-control" name="tipoContenido" id="tipoContenido">
						<option value="">Seleccionar</option>
						<option value="">Arriendos</option>
						<option value="">Ventas</option>
						<!-- <option value=""></option> -->
					</select>
				</div>
			</div>
			<div class="col-md-3">
				<div class="input-group">
					<!-- <label for="busqueda" class="small">¿Cuantos Pisos?.</label> -->
					<select class="form-control" name="" id="">
						<option value="">Pisos</option>
						<option value="">1 Piso</option>
						<option value="">2 Pisos</option>
						<option value="">3 Pisos o más</option>
					</select>
				</div>
			</div>
			<div class="col-md-3">
				<div class="input-group">
				<!-- 	<label for="busqueda" class="small">¿Cuantas Oficinas?.</label> -->
					<select class="form-control" name="" id="">
						<option value="">Oficinas</option>
						<option value="">1 Oficinas</option>
						<option value="">2 Oficinas</option>
						<option value="">3 Oficinas o más</option>
					</select>                  
				</div>
			</div>
			<div class="col-md-3">
				<div class="input-group">
					<!-- <label for="busqueda" class="small">¿Estacionamiento?</label> -->
					<select class="form-control" name="" id="">
						<option value="">Estacionamiento</option>
						<option value="">Sin Estacionamiento</option>
						<option value="">Con Estacionamiento</option>
						<!-- <option value=""></option> -->
					</select>
				</div>
			</div> 
		</div>
	</div>       
    <!-- </div> -->
    <div class="row mb20">
    	<div class="col-md-12 pull-right" >
    	        <input type="button" class="btn btn-success small col-md-3 pull-right" value="Buscar Propiedad">
    	</div>
    </div>
</section>




<div class="album py-5 bg-light">
        <div class="container">

          <div class="row" id="mostrar_resultado" name="mostrar_resultado">
          <?
          $consultaContenido=$conn->query("SELECT * FROM tb_contenido");
            while($resultadoContenido= $consultaContenido->fetch_assoc()){
              $consultaImagenes=$conn->query("SELECT coNomimg, coidImagen, cotipoImg, tb_contenido_coidContenido FROM tb_imagenes WHERE tb_contenido_coidContenido= ".$resultadoContenido['coidContenido']." AND cotipoImg='principal'");
              $Imagen=$consultaImagenes->fetch_assoc();
          ?>
            <div class="col-md-4">
              <div class="card mb-4 shadow-sm">
                <img class="card-img-top" src="img/contenido/<?=$Imagen['coNomimg']; ?>" alt="Thumbnail [100%x225]" style="height: 225px; width: 100%; display: block;"  data-holder-rendered="true"> <!-- data-src="holder.js/100px225?theme=thumb&amp;bg=55595c&amp;fg=eceeef&amp;text=Thumbnail" alt="Thumbnail [100%x225]" style="height: 225px; width: 100%; display: block;" src="data:image/svg+xml;charset=UTF-8,%3Csvg%20width%3D%22348%22%20height%3D%22225%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20viewBox%3D%220%200%20348%20225%22%20preserveAspectRatio%3D%22none%22%3E%3Cdefs%3E%3Cstyle%20type%3D%22text%2Fcss%22%3E%23holder_166aba16d02%20text%20%7B%20fill%3A%23eceeef%3Bfont-weight%3Abold%3Bfont-family%3AArial%2C%20Helvetica%2C%20Open%20Sans%2C%20sans-serif%2C%20monospace%3Bfont-size%3A17pt%20%7D%20%3C%2Fstyle%3E%3C%2Fdefs%3E%3Cg%20id%3D%22holder_166aba16d02%22%3E%3Crect%20width%3D%22348%22%20height%3D%22225%22%20fill%3D%22%2355595c%22%3E%3C%2Frect%3E%3Cg%3E%3Ctext%20x%3D%22116.71875%22%20y%3D%22120.15%22%3EThumbnail%3C%2Ftext%3E%3C%2Fg%3E%3C%2Fg%3E%3C%2Fsvg%3E" data-holder-rendered="true"> -->
                <div class="card-body">
                  <p class="card-text"><?=utf8_encode($resultadoContenido['coDescripcion']);?></p>
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
            <?}?>
           <!--  <div class="col-md-4">
              <div class="card mb-4 shadow-sm"> -->
                <!-- <img class="card-img-top" data-src="holder.js/100px225?theme=thumb&amp;bg=55595c&amp;fg=eceeef&amp;text=Thumbnail" alt="Thumbnail [100%x225]" src="data:image/svg+xml;charset=UTF-8,%3Csvg%20width%3D%22348%22%20height%3D%22225%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20VerBox%3D%220%200%20348%20225%22%20preserveAspectRatio%3D%22none%22%3E%3Cdefs%3E%3Cstyle%20type%3D%22text%2Fcss%22%3E%23holder_166aba16d03%20text%20%7B%20fill%3A%23eceeef%3Bfont-weight%3Abold%3Bfont-family%3AArial%2C%20Helvetica%2C%20Open%20Sans%2C%20sans-serif%2C%20monospace%3Bfont-size%3A17pt%20%7D%20%3C%2Fstyle%3E%3C%2Fdefs%3E%3Cg%20id%3D%22holder_166aba16d03%22%3E%3Crect%20width%3D%22348%22%20height%3D%22225%22%20fill%3D%22%2355595c%22%3E%3C%2Frect%3E%3Cg%3E%3Ctext%20x%3D%22116.71875%22%20y%3D%22120.15%22%3EThumbnail%3C%2Ftext%3E%3C%2Fg%3E%3C%2Fg%3E%3C%2Fsvg%3E" data-holder-rendered="true" style="height: 225px; width: 100%; display: block;"> -->
                <!-- <img class="card-img-top" src="img/imagenes_aldunate/ALGARROBAL3.jpg" alt="Thumbnail [100%x225]" style="height: 225px; width: 100%; display: block;"  data-holder-rendered="true">
                <div class="card-body">
                  <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                  <div class="d-flex justify-content-between align-items-center">
                    <div class="btn-group">
                      <button type="button" class="btn btn-sm btn-outline-secondary">Ver</button>
                      <button type="button" class="btn btn-sm btn-outline-secondary">Contactar</button>
                    </div>
                    <small class="text-muted">9 mins</small>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="card mb-4 shadow-sm"> -->
                <!-- <img class="card-img-top" data-src="holder.js/100px225?theme=thumb&amp;bg=55595c&amp;fg=eceeef&amp;text=Thumbnail" alt="Thumbnail [100%x225]" src="data:image/svg+xml;charset=UTF-8,%3Csvg%20width%3D%22348%22%20height%3D%22225%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20VerBox%3D%220%200%20348%20225%22%20preserveAspectRatio%3D%22none%22%3E%3Cdefs%3E%3Cstyle%20type%3D%22text%2Fcss%22%3E%23holder_166aba16d05%20text%20%7B%20fill%3A%23eceeef%3Bfont-weight%3Abold%3Bfont-family%3AArial%2C%20Helvetica%2C%20Open%20Sans%2C%20sans-serif%2C%20monospace%3Bfont-size%3A17pt%20%7D%20%3C%2Fstyle%3E%3C%2Fdefs%3E%3Cg%20id%3D%22holder_166aba16d05%22%3E%3Crect%20width%3D%22348%22%20height%3D%22225%22%20fill%3D%22%2355595c%22%3E%3C%2Frect%3E%3Cg%3E%3Ctext%20x%3D%22116.71875%22%20y%3D%22120.15%22%3EThumbnail%3C%2Ftext%3E%3C%2Fg%3E%3C%2Fg%3E%3C%2Fsvg%3E" data-holder-rendered="true" style="height: 225px; width: 100%; display: block;"> -->
                <!-- <img class="card-img-top" src="img/imagenes_aldunate/IMG_7302.jpg" alt="Thumbnail [100%x225]" style="height: 225px; width: 100%; display: block;"  data-holder-rendered="true">
                <div class="card-body">
                  <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                  <div class="d-flex justify-content-between align-items-center">
                    <div class="btn-group">
                      <button type="button" class="btn btn-sm btn-outline-secondary">Ver</button>
                      <button type="button" class="btn btn-sm btn-outline-secondary">Contactar</button>
                    </div>
                    <small class="text-muted">9 mins</small>
                  </div>
                </div>
              </div>
            </div> 

            <div class="col-md-4">
              <div class="card mb-4 shadow-sm">-->
                <!-- <img class="card-img-top" data-src="holder.js/100px225?theme=thumb&amp;bg=55595c&amp;fg=eceeef&amp;text=Thumbnail" alt="Thumbnail [100%x225]" src="data:image/svg+xml;charset=UTF-8,%3Csvg%20width%3D%22348%22%20height%3D%22225%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20VerBox%3D%220%200%20348%20225%22%20preserveAspectRatio%3D%22none%22%3E%3Cdefs%3E%3Cstyle%20type%3D%22text%2Fcss%22%3E%23holder_166aba16d05%20text%20%7B%20fill%3A%23eceeef%3Bfont-weight%3Abold%3Bfont-family%3AArial%2C%20Helvetica%2C%20Open%20Sans%2C%20sans-serif%2C%20monospace%3Bfont-size%3A17pt%20%7D%20%3C%2Fstyle%3E%3C%2Fdefs%3E%3Cg%20id%3D%22holder_166aba16d05%22%3E%3Crect%20width%3D%22348%22%20height%3D%22225%22%20fill%3D%22%2355595c%22%3E%3C%2Frect%3E%3Cg%3E%3Ctext%20x%3D%22116.71875%22%20y%3D%22120.15%22%3EThumbnail%3C%2Ftext%3E%3C%2Fg%3E%3C%2Fg%3E%3C%2Fsvg%3E" data-holder-rendered="true" style="height: 225px; width: 100%; display: block;"> -->
                <!-- <img class="card-img-top" src="img/imagenes_aldunate/IMG_7302.jpg" alt="Thumbnail [100%x225]" style="height: 225px; width: 100%; display: block;"  data-holder-rendered="true">
                <div class="card-body">
                  <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                  <div class="d-flex justify-content-between align-items-center">
                    <div class="btn-group">
                      <button type="button" class="btn btn-sm btn-outline-secondary">Ver</button>
                      <button type="button" class="btn btn-sm btn-outline-secondary">Contactar</button>
                    </div>
                    <small class="text-muted">9 mins</small>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="card mb-4 shadow-sm"> -->
                <!-- <img class="card-img-top" data-src="holder.js/100px225?theme=thumb&amp;bg=55595c&amp;fg=eceeef&amp;text=Thumbnail" alt="Thumbnail [100%x225]" src="data:image/svg+xml;charset=UTF-8,%3Csvg%20width%3D%22348%22%20height%3D%22225%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20VerBox%3D%220%200%20348%20225%22%20preserveAspectRatio%3D%22none%22%3E%3Cdefs%3E%3Cstyle%20type%3D%22text%2Fcss%22%3E%23holder_166aba16d06%20text%20%7B%20fill%3A%23eceeef%3Bfont-weight%3Abold%3Bfont-family%3AArial%2C%20Helvetica%2C%20Open%20Sans%2C%20sans-serif%2C%20monospace%3Bfont-size%3A17pt%20%7D%20%3C%2Fstyle%3E%3C%2Fdefs%3E%3Cg%20id%3D%22holder_166aba16d06%22%3E%3Crect%20width%3D%22348%22%20height%3D%22225%22%20fill%3D%22%2355595c%22%3E%3C%2Frect%3E%3Cg%3E%3Ctext%20x%3D%22116.71875%22%20y%3D%22120.15%22%3EThumbnail%3C%2Ftext%3E%3C%2Fg%3E%3C%2Fg%3E%3C%2Fsvg%3E" data-holder-rendered="true" style="height: 225px; width: 100%; display: block;"> -->
                <!-- <img class="card-img-top" src="img/imagenes_aldunate/IMG_7302.jpg" alt="Thumbnail [100%x225]" style="height: 225px; width: 100%; display: block;"  data-holder-rendered="true">
                <div class="card-body">
                  <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                  <div class="d-flex justify-content-between align-items-center">
                    <div class="btn-group">
                      <button type="button" class="btn btn-sm btn-outline-secondary">Ver</button>
                      <button type="button" class="btn btn-sm btn-outline-secondary">Contactar</button>
                    </div>
                    <small class="text-muted">9 mins</small>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="card mb-4 shadow-sm"> -->
                <!-- <img class="card-img-top" data-src="holder.js/100px225?theme=thumb&amp;bg=55595c&amp;fg=eceeef&amp;text=Thumbnail" alt="Thumbnail [100%x225]" src="data:image/svg+xml;charset=UTF-8,%3Csvg%20width%3D%22348%22%20height%3D%22225%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20VerBox%3D%220%200%20348%20225%22%20preserveAspectRatio%3D%22none%22%3E%3Cdefs%3E%3Cstyle%20type%3D%22text%2Fcss%22%3E%23holder_166aba16d06%20text%20%7B%20fill%3A%23eceeef%3Bfont-weight%3Abold%3Bfont-family%3AArial%2C%20Helvetica%2C%20Open%20Sans%2C%20sans-serif%2C%20monospace%3Bfont-size%3A17pt%20%7D%20%3C%2Fstyle%3E%3C%2Fdefs%3E%3Cg%20id%3D%22holder_166aba16d06%22%3E%3Crect%20width%3D%22348%22%20height%3D%22225%22%20fill%3D%22%2355595c%22%3E%3C%2Frect%3E%3Cg%3E%3Ctext%20x%3D%22116.71875%22%20y%3D%22120.15%22%3EThumbnail%3C%2Ftext%3E%3C%2Fg%3E%3C%2Fg%3E%3C%2Fsvg%3E" data-holder-rendered="true" style="height: 225px; width: 100%; display: block;"> -->
                <!-- <img class="card-img-top" src="img/imagenes_aldunate/IMG_7302.jpg" alt="Thumbnail [100%x225]" style="height: 225px; width: 100%; display: block;"  data-holder-rendered="true">
                <div class="card-body">
                  <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                  <div class="d-flex justify-content-between align-items-center">
                    <div class="btn-group">
                      <button type="button" class="btn btn-sm btn-outline-secondary">Ver</button>
                      <button type="button" class="btn btn-sm btn-outline-secondary">Contactar</button>
                    </div>
                    <small class="text-muted">9 mins</small>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-md-4">
              <div class="card mb-4 shadow-sm"> -->
                <!-- <img class="card-img-top" data-src="holder.js/100px225?theme=thumb&amp;bg=55595c&amp;fg=eceeef&amp;text=Thumbnail" alt="Thumbnail [100%x225]" src="data:image/svg+xml;charset=UTF-8,%3Csvg%20width%3D%22348%22%20height%3D%22225%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20VerBox%3D%220%200%20348%20225%22%20preserveAspectRatio%3D%22none%22%3E%3Cdefs%3E%3Cstyle%20type%3D%22text%2Fcss%22%3E%23holder_166aba16d07%20text%20%7B%20fill%3A%23eceeef%3Bfont-weight%3Abold%3Bfont-family%3AArial%2C%20Helvetica%2C%20Open%20Sans%2C%20sans-serif%2C%20monospace%3Bfont-size%3A17pt%20%7D%20%3C%2Fstyle%3E%3C%2Fdefs%3E%3Cg%20id%3D%22holder_166aba16d07%22%3E%3Crect%20width%3D%22348%22%20height%3D%22225%22%20fill%3D%22%2355595c%22%3E%3C%2Frect%3E%3Cg%3E%3Ctext%20x%3D%22116.71875%22%20y%3D%22120.15%22%3EThumbnail%3C%2Ftext%3E%3C%2Fg%3E%3C%2Fg%3E%3C%2Fsvg%3E" data-holder-rendered="true" style="height: 225px; width: 100%; display: block;"> -->
                <!-- <img class="card-img-top" src="img/imagenes_aldunate/IMG_7302.jpg" alt="Thumbnail [100%x225]" style="height: 225px; width: 100%; display: block;"  data-holder-rendered="true">
                <div class="card-body">
                  <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                  <div class="d-flex justify-content-between align-items-center">
                    <div class="btn-group">
                      <button type="button" class="btn btn-sm btn-outline-secondary">Ver</button>
                      <button type="button" class="btn btn-sm btn-outline-secondary">Contactar</button>
                    </div>
                    <small class="text-muted">9 mins</small>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="card mb-4 shadow-sm"> -->
                <!-- <img class="card-img-top" data-src="holder.js/100px225?theme=thumb&amp;bg=55595c&amp;fg=eceeef&amp;text=Thumbnail" alt="Thumbnail [100%x225]" src="data:image/svg+xml;charset=UTF-8,%3Csvg%20width%3D%22348%22%20height%3D%22225%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20VerBox%3D%220%200%20348%20225%22%20preserveAspectRatio%3D%22none%22%3E%3Cdefs%3E%3Cstyle%20type%3D%22text%2Fcss%22%3E%23holder_166aba16d08%20text%20%7B%20fill%3A%23eceeef%3Bfont-weight%3Abold%3Bfont-family%3AArial%2C%20Helvetica%2C%20Open%20Sans%2C%20sans-serif%2C%20monospace%3Bfont-size%3A17pt%20%7D%20%3C%2Fstyle%3E%3C%2Fdefs%3E%3Cg%20id%3D%22holder_166aba16d08%22%3E%3Crect%20width%3D%22348%22%20height%3D%22225%22%20fill%3D%22%2355595c%22%3E%3C%2Frect%3E%3Cg%3E%3Ctext%20x%3D%22116.71875%22%20y%3D%22120.15%22%3EThumbnail%3C%2Ftext%3E%3C%2Fg%3E%3C%2Fg%3E%3C%2Fsvg%3E" data-holder-rendered="true" style="height: 225px; width: 100%; display: block;"> -->
                <!-- <img class="card-img-top" src="img/imagenes_aldunate/IMG_7302.jpg" alt="Thumbnail [100%x225]" style="height: 225px; width: 100%; display: block;"  data-holder-rendered="true">
                <div class="card-body">
                  <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                  <div class="d-flex justify-content-between align-items-center">
                    <div class="btn-group">
                      <button type="button" class="btn btn-sm btn-outline-secondary">Ver</button>
                      <button type="button" class="btn btn-sm btn-outline-secondary">Contactar</button>
                    </div>
                    <small class="text-muted">9 mins</small>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="card mb-4 shadow-sm"> -->
                <!-- <img class="card-img-top" data-src="holder.js/100px225?theme=thumb&amp;bg=55595c&amp;fg=eceeef&amp;text=Thumbnail" alt="Thumbnail [100%x225]" src="data:image/svg+xml;charset=UTF-8,%3Csvg%20width%3D%22348%22%20height%3D%22225%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20VerBox%3D%220%200%20348%20225%22%20preserveAspectRatio%3D%22none%22%3E%3Cdefs%3E%3Cstyle%20type%3D%22text%2Fcss%22%3E%23holder_166aba16d09%20text%20%7B%20fill%3A%23eceeef%3Bfont-weight%3Abold%3Bfont-family%3AArial%2C%20Helvetica%2C%20Open%20Sans%2C%20sans-serif%2C%20monospace%3Bfont-size%3A17pt%20%7D%20%3C%2Fstyle%3E%3C%2Fdefs%3E%3Cg%20id%3D%22holder_166aba16d09%22%3E%3Crect%20width%3D%22348%22%20height%3D%22225%22%20fill%3D%22%2355595c%22%3E%3C%2Frect%3E%3Cg%3E%3Ctext%20x%3D%22116.71875%22%20y%3D%22120.15%22%3EThumbnail%3C%2Ftext%3E%3C%2Fg%3E%3C%2Fg%3E%3C%2Fsvg%3E" data-holder-rendered="true" style="height: 225px; width: 100%; display: block;"> -->
                <!-- <img class="card-img-top" src="img/imagenes_aldunate/IMG_7302.jpg" alt="Thumbnail [100%x225]" style="height: 225px; width: 100%; display: block;"  data-holder-rendered="true">
                <div class="card-body">
                  <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                  <div class="d-flex justify-content-between align-items-center">
                    <div class="btn-group">
                      <button type="button" class="btn btn-sm btn-outline-secondary">Ver</button>
                      <button type="button" class="btn btn-sm btn-outline-secondary">Contactar</button>
                    </div>
                    <small class="text-muted">9 mins</small>
                  </div>
                </div>
              </div>
            </div> -->
          </div>
        </div>
      </div>

    <div class="jumbotron text-center" style="margin-bottom:0">
     <p>INFORMACION DEL FOOTER</p>
    </div>
<script src="js/jquery.js"></script>
<script src="js/carousel.js"></script>    
<script src="js/bootstrap.min.js"></script>
<script src="js/price_range_script.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js" type="text/javascript"></script>



</body>
</html>
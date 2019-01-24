<? include_once("includes/conexion.php");
$conn = conectar();


$accion = $_POST['accion'];


switch ($accion) {
  case 1:
    contenedor();
    exit;
  case 2:
    detalles();
    exit;
}

function contenedor()
{
  include_once("includes/conexion.php");
  $conn = conectar();
  ?>
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
  
     	<div class="carousel-item <?= $item; ?>" style="height: 60%!important;" >
     	 	<img src="img/contenido/<?= $resultImagen['coNomimg']; ?>" style="height:750px;" ><!-- alt="Colina" -->
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
  <form action="" id="frmFiltro" name="frmFiltro">
    <div class="container">
        <h1 class="jumbotron-heading">Busqueda de Propiedad</h1>
        <div class="row mb20">
        <div class="col-md-2"></div>
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
			
      <!--<div class="col-md-1">
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
			</div> -->
      <div class="col-md-2"></div>
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
        <div class="col-md-3"></div>
      <div class="col-md-3">
				<div class="input-group">
					<!-- <label for="busqueda" class="small">¿Cuantos Baños?</label> -->
					<select class="form-control" name="tipoContenido" id="tipoContenido">
						<option value="">¿Venta o Arriendo?</option>
						<option value="">Arriendo</option>
						<option value="">Venta</option>
						<!-- <option value=""></option> -->
					</select>
				</div>
			</div>
        <div class="col-md-3">
				<div class="input-group">
            <!-- <label for="busqueda" class="small">¿Cuantos Pisos?.</label> -->
            <select class="form-control" name="" id="">
              <option value="">¿Que Busca?</option>
              <option value="">Casa</option>
              <option value="">Departamento</option>
              <option value="">Terreno</option>
            </select>
          </div>
        </div>
		
		<!-- 	<div class="col-md-3">
				<div class="input-group"> -->
				<!-- 	<label for="busqueda" class="small">¿Cuantas Oficinas?.</label> -->
					<!-- <select class="form-control" name="" id="">
						<option value="">Oficinas</option>
						<option value="">1 Oficinas</option>
						<option value="">2 Oficinas</option>
						<option value="">3 Oficinas o más</option>
					</select>                  
				</div>
			</div> -->
		<!-- 	<div class="col-md-3">
				<div class="input-group"> -->
					<!-- <label for="busqueda" class="small">¿Estacionamiento?</label> -->
					<!-- <select class="form-control" name="" id="">
						<option value="">Estacionamiento</option>
						<option value="">Sin Estacionamiento</option>
						<option value="">Con Estacionamiento</option> -->
						<!-- <option value=""></option> -->
				<!-- 	</select>
				</div>
			</div>  -->
		</div>
	</div>       
    <!-- </div> -->
    <div class="row mb20">
    	<div class="col-md-12 pull-right" >
    	        <input type="button" class="btn btn-success small col-md-3 pull-right" value="Buscar Propiedad">
    	</div>
    </div>
    </form>
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
                  <p class="card-text"><?= $resultadoContenido['coDescripcion']; ?></p>
                  <div class="d-flex justify-content-between align-items-center">
                    <div class="btn-group">
                      <a href="javascript:void(0)" onclick="cargaFormulario(<?= $Imagen['tb_contenido_coidContenido']; ?>,'detalles.php')"><button type="button" class="btn btn-sm btn-outline-primary">Detalles</button></a>
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
        <?
      } 


function detalles(){
  include_once("includes/conexion.php");
  $conn = conectar();
  $id=$_POST['id_propiedad'];
  
  echo '<prev>'.var_dump($id).'</prev>';
  
?>


<div id="sliderAldunate" class="carousel slide" data-ride="carousel">
  <ul class="carousel-indicators">
  <?
  $consulContenido2 = $conn->query("SELECT coTitulo, coidContenido, coDescripcion FROM tb_contenido WHERE coidContenido=".$id);
  $activarItem2 = 0;
  while ($resultContenido2 = $consulContenido2->fetch_assoc()) {
      /* echo $resultContenido2['coTitulo']; */
    $consultImg1 = $conn->query("SELECT coidImagen, coNomimg, tb_contenido_coidContenido, cotipoImg FROM tb_imagenes WHERE tb_contenido_coidContenido=$id ORDER BY coidImagen ASC");
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
  $consulContenido = $conn->query("SELECT coTitulo, coidContenido, coDescripcion, coDireccion, coComuna FROM tb_contenido WHERE coidContenido=".$id);
  $activarItem = 0;
  while ($resultContenido = $consulContenido->fetch_assoc()) {
      /* echo $resultContenido['coTitulo']; */
    $consultImg = $conn->query("SELECT coidImagen, coNomimg, tb_contenido_coidContenido, cotipoImg FROM tb_imagenes WHERE tb_contenido_coidContenido= $id ORDER BY coidImagen ASC");
    while ($resultImagen = $consultImg->fetch_assoc()) {
      if ($activarItem == 0) {
        $item = "active";
      } else {
        $item = "";
      }
      switch($resultContenido['coComuna']){
        case 'P1C1CO00': $comuna='Canela';
          break;
        case 'P1C1CO01' :$comuna='Illapel';
          break;
        case 'P1C1CO02' :$comuna='Los Vilos';
          break;
        case 'P1C1CO03' :$comuna='Salamanca';
          break;
        case 'P2C2CO04' :$comuna='Andacollo';
          break;
        case 'P2C2CO05' :$comuna='Coquimbo';
          break;
        case 'P2C2CO06' :$comuna='La Higuera';
          break;
        case 'P2C2CO07' :$comuna='La Serena';
          break;
        case 'P2C2CO08' :$comuna='Paihuano';
          break;
        case 'P2C2CO09' :$comuna='Vicuña';
          break;
        case 'P3C3CO10' :$comuna='Combarbala';
          break;
        case 'P3C3CO11' :$comuna='Monte Patria';
          break;
        case 'P3C3CO12' :$comuna='Ovalle';
          break;
        case 'P3C3CO13' :$comuna='Punitaqui';
          break;
        case 'P3C3CO14' :$comuna='Rio Hurtado';
          break;
      }

      ?>
  
     	<div class="carousel-item <?= $item; ?>" style="height: 60%!important;" >
     	 	<img src="img/contenido/<?= $resultImagen['coNomimg']; ?>" style="height:750px;" ><!-- alt="Colina" -->
        <div class="carousel-caption" style="text-align:start; position:absolute;">
            <h4><?= $resultContenido['coTitulo']; ?></h4>
            <p><?= $resultContenido['coDireccion'];?>, <?=$comuna?></p>
        </div>
     	 	<!--<div class="carousel-caption fadeInLeft ">
				 <div class="caption-titulo" >
					<p><?= substr($resultContenido['coTitulo'], 0, 20); ?></p>
				</div> -->
				<<!-- div class="caption-contenido">
					<p><?= substr($resultContenido['coDescripcion'], 0, 40); ?>...</p>
					<p><a class="btn btn-sm btn-success" id="carouselButtons" href="/" role="button">Ver Más</a></p>          
				</div> 
     	 	</div> -->  
	  	</div>

    <?
    $titulo= $resultContenido['coTitulo'];
    $descripcion=$resultContenido['coDescripcion'];
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
        <h1 class="jumbotron-heading"><?=$titulo?> </h1>
        <div class="row">
			     
        </div>        
    </div>
</section>
<section>
  <div class="container d-flex flex-column mt-4">
      <div class="d-flex flex-lg-row flex-md-column flex-column mt-3 mb-3">
          <div class="col-lg-7 col-md-12 col-12 d-flex flex-column">
              <div class="card w-100 mb-2">
                  <div class="card-body">
                      <h4 class="card-title">Descripción</h4>
                      <p class="card-text">
                          <?=$descripcion;?>
                      </p>
                  </div>
              </div>
              <div class="card w-100">
                  <div class="card-body">
                      <h4 class="card-title">Características </h4>
                      <h5 class="card-subtitle mt-3">Baño</h5>
                      <div class="d-flex flex-row">
                          <span class="w-100">servicio 1</span>
                          <span class="w-100">servicio 2</span>
                      </div>
                      <h5 class="card-subtitle mt-3">Oficinas</h5>
                      <div class="d-flex flex-row">
                          <span class="w-100">servicio 1</span>
                          <span class="w-100">servicio 2</span>
                      </div>
                      <div class="d-flex flex-row">
                          <span class="w-100">servicio 1</span>
                          <span class="w-100">servicio 2</span>
                      </div>
                      <h5 class="card-subtitle mt-3">Estacionamiento</h5>
                      <div class="d-flex flex-row">
                          <span class="w-100">servicio 1</span>
                          <span class="w-100">servicio 2</span>
                      </div>
                      <h5 class="card-subtitle mt-3">Pisos</h5>
                      <div class="d-flex flex-row">
                          <span class="w-100">servicio 1</span>
                          <span class="w-100">servicio 2</span>
                      </div>
                      <div class="d-flex flex-row">
                          <span class="w-100">servicio 1</span>
                          <span class="w-100">servicio 2</span>
                      </div>
                      <div class="d-flex flex-row">
                          <span class="w-100">servicio 1</span>
                          <span class="w-100">servicio 2</span>
                      </div>
                  </div>
              </div>
          </div>
          <div class="col-lg-5 col-md-12 col-12 d-flex flex-column">
              <div class="card mb-2">
                  <div class="card-body">
                   <h4 class="card-title">Conoce Nuestros Servicios</h4>
                      <h5 class="card-subtitle mt-3">Servicios</h5>
                      <table class="table table-borderless">
                          <tbody>
                              <tr>
                                  <th scope="row">Dirección:</th>
                                  <td>Isidora Goyenechea 3322, Las Condes</td>
                              </tr>
                              <tr>
                                  <th scope="row">Comuna:</th>
                                  <td>Santiago</td>
                              </tr>
                              <tr>
                                  <th scope="row">Tel. fijo:</th>
                                  <td>25212345678</td>
                              </tr>
                              <tr>
                                  <th scope="row">Tel. movil:</th>
                                  <td>25212345678</td>
                              </tr>
                              <tr>
                                  <th scope="row">Email:</th>
                                  <td>contacto@servicio.com</td>
                              </tr>
                              <tr>
                                  <th scope="row">Sitio Web:</th>
                                  <td><a href="">http://url.com</a></td>
                              </tr>
                              <tr>
                                  <th scope="row">Taller:</th>
                                  <td><i>marca1,marca2,marca3</i></td>
                              </tr>
                          </tbody>
                      </table>
                  </div>
              </div>
              <!-- <div class="card mb-2">
                  <div class="card-body">
                      <form>
                          <div class="d-flex flex-row">
                              <div class="form-group w-100 mr-2">
                                  <label class="text-muted" for="exampleInputPassword1">Nombre</label>
                                  <input type="text" class="form-control form-control-sm" id="exampleInputPassword1"
                                      placeholder="Nombre">
                              </div>
                              <div class="form-group w-100">
                                  <label class="text-muted" for="exampleInputPassword1">Telefono</label>
                                  <input type="text" class="form-control form-control-sm" id="exampleInputPassword1"
                                      placeholder="Telefono">
                              </div>
                          </div>
                          <div class="form-group">
                              <label class="text-muted" for="exampleInputEmail1">Email</label>
                              <input type="email" class="form-control form-control-sm" id="exampleInputEmail1"
                                  aria-describedby="emailHelp" placeholder="Email">
                          </div>
                          <div class="form-group">
                              <label class="text-muted" for="exampleFormControlTextarea1">Mensaje</label>
                              <textarea class="form-control" id="exampleFormControlTextarea1" rows="2"></textarea>
                          </div>
                          <button type="submit" class="btn btn-primary btn-block">Enviar</button>
                      </form>
                  </div>
              </div> -->
              <!-- <div class="btn-bottom">
                  <button type="submit" class="btn btn-light btn-block" ng-click="vm.back()">
                      <i class="fa fa-long-arrow-left"></i>
                      Volver a Resultados
                  </button>
              </div> -->
          </div>
      </div>

  </div>
</section>



<!-- <div class="album py-5 bg-light">
        <div class="container">

          <div class="row" id="mostrar_resultado" name="mostrar_resultado"> -->
          <?
            $consultaContenido = $conn->query("SELECT * FROM tb_contenido");
            while ($resultadoContenido = $consultaContenido->fetch_assoc()) {
                $consultaImagenes = $conn->query("SELECT coNomimg, coidImagen, cotipoImg, tb_contenido_coidContenido FROM tb_imagenes WHERE tb_contenido_coidContenido= " . $resultadoContenido['coidContenido'] . " AND cotipoImg='principal'");
                $Imagen = $consultaImagenes->fetch_assoc();
                ?>
            <!-- <div class="col-md-4">
              <div class="card mb-4 shadow-sm">
                <img class="card-img-top" src="img/contenido/<?= $Imagen['coNomimg']; ?>" alt="Thumbnail [100%x225]" style="height: 225px; width: 100%; display: block;"  data-holder-rendered="true">  --><!-- data-src="holder.js/100px225?theme=thumb&amp;bg=55595c&amp;fg=eceeef&amp;text=Thumbnail" alt="Thumbnail [100%x225]" style="height: 225px; width: 100%; display: block;" src="data:image/svg+xml;charset=UTF-8,%3Csvg%20width%3D%22348%22%20height%3D%22225%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20viewBox%3D%220%200%20348%20225%22%20preserveAspectRatio%3D%22none%22%3E%3Cdefs%3E%3Cstyle%20type%3D%22text%2Fcss%22%3E%23holder_166aba16d02%20text%20%7B%20fill%3A%23eceeef%3Bfont-weight%3Abold%3Bfont-family%3AArial%2C%20Helvetica%2C%20Open%20Sans%2C%20sans-serif%2C%20monospace%3Bfont-size%3A17pt%20%7D%20%3C%2Fstyle%3E%3C%2Fdefs%3E%3Cg%20id%3D%22holder_166aba16d02%22%3E%3Crect%20width%3D%22348%22%20height%3D%22225%22%20fill%3D%22%2355595c%22%3E%3C%2Frect%3E%3Cg%3E%3Ctext%20x%3D%22116.71875%22%20y%3D%22120.15%22%3EThumbnail%3C%2Ftext%3E%3C%2Fg%3E%3C%2Fg%3E%3C%2Fsvg%3E" data-holder-rendered="true"> -->
                <!-- <div class="card-body">
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
            </div> -->
            <?
        } ?>
          <!-- </div>
        </div>
      </div> -->

<!-- <script src="js/carousel.js"></script>    
<script src="js/jsfunciones.js"></script>    
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery.js"></script> -->
<?}



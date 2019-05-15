<?error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);
include_once("includes/conexion.php");
$conn = conectar();


$accion = $_GET['accion'];


switch ($accion) {
    case 1:
        contenedor();
        exit;
    case 2:
        detalles();
        exit;
    case 3:
        shared();
        exit;
    case 4:
        about();
        exit;
    case 5:
        paginaTion();
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
                <li data-target="#sliderAldunate" data-slide-to="<?= $activarItem2; ?>" <? if ($activarItem2 == 0) { ?>class="
                    <? echo 'active'; ?>"
                    <?
                } ?>></li>
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

                <div class="carousel-item <?= $item; ?>" style="height: 30%!important;">
                    <img src="img/contenido/<?= $resultImagen['coNomimg']; ?>"><!-- alt="Colina" style="height:750px;" -->
                    <div class="carousel-caption fadeInLeft ">
                        <div class="doblea">
                            <p>
                                <?= substr(($resultContenido['coTitulo']), 0, 40); ?>
                            </p>
                            <!-- </div>
                        <div class="doblea"> -->
                            <p>
                                <?= substr(($resultContenido['coDescripcion']), 0, 40); ?>...</p>
                            <p><a class="btn btn-sm btn-success" id="carouselButtons" href="javascript:void(0)" onclick="cargaFormulario(<?= $resultImagen['tb_contenido_coidContenido']; ?>,'detalles.php')" role="button">Ver Más</a></p>
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
    <form id="frmFiltro" name="frmFiltro">
        <div class="container">
            <h1 class="jumbotron-heading">Busqueda de Propiedad</h1>
            <div class="row mb20">
                <div class="col-md-2"></div>
                <div class="col-md-6">
                    <fieldset>
                        <label for="busqueda" class="form-label large">Buscar Propiedad por Palabra Clave</label>
                        <input type="text" id="busqueda" name="busqueda" class="form-control input-sm" placeholder="Busqueda">
                    </fieldset>
                </div>
                <div class="col-md-3">
                    <label for="busqueda" class="form-label large">&nbsp;</label>
                    <div class="input-group">
                        <select class="form-control" name="slctComuna" id="slctComuna">
                            <option value="0">Comuna</option>
                            <?
                            $pregunta = $conn->query("SELECT * FROM tb_comuna ORDER BY coidComuna ='P2C2CO07' DESC");
                            $numOrden = 1;
                            while ($row = $pregunta->fetch_assoc()) {
                                $nombre = utf8_encode($row['coNomComuna']);
                                echo '<option value="' . $row['coidComuna'] . '"  > ' . $numOrden . '. ' . $nombre . ' </option>';
                                $numOrden++;
                            }
                            ?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">

                <div class="col-md-2"></div>
                <!-- <div class="col-md-2">
                </div> -->
                <div class="col-md-6">
                    <div style="margin:10px!important;">
                        <b id="valSlider1"> $200.000 </b>&nbsp;&nbsp;&nbsp;<input id="precio_rango" name="precio_rango" type="text" data-slider-value="[200000, 1000000]" data-slider-ticks="[200, 500, 1000]" data-slider-lock-to-ticks="false"/>&nbsp;&nbsp;&nbsp;<b id="valSlider2">$500.000 </b>

                        <!-- Filter by price interval: <b>€ 10</b> <input id="ex24" type="text" class="span2" value="" data-slider-min="10" data-slider-max="1000" data-slider-step="5" data-slider-value="[250,450]"/> <b>€ 1000</b> -->
                    </div>
                </div>
            </div>
            <div class="row mb20">
                <div class="col-md-3"></div>
                <div class="col-md-3">
                    <div class="input-group">
                        <select class="form-control" name="tipoContenido" id="tipoContenido">
                            <option value="0">¿Venta o Arriendo?</option>
                            <option value="1">Arriendo</option>
                            <option value="2">Venta</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="input-group">
                        <select class="form-control" name="tipoEstructura" id="tipoEstructura">
                            <option value="0">¿Que Busca?</option>
                            <option value="casa">Casa</option>
                            <option value="departamento">Departamento</option>
                            <option value="terreno">Terreno</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mb20">
            <div class="col-md-12 pull-right">
                <input type="hidden" name="opcion" id="opcion" value="activar-filtro">
                <input type="hidden" name="valSlid1" id="valSlid1" value="">
                <input type="hidden" name="valSlid2" id="valSlid2" value="">
                <input type="submit" class="btn btn-success small col-md-3 pull-right" value="Buscar Propiedad">
            </div>
        </div>
    </form>
</section>
<section id="mostrar_resultado_paginador" name="mostrar_resultado_paginador">
    <?
    if(!isset($_GET['pagina'])){
        $pagina=1;
    }else{
        $pagina=$_GET['pagina'];
    }?>
    <script>
       verContenedorPagina('detalles.php', 5, '<?=$pagina;?>');
    </script>
</section>
<script src="js/jquery.js"></script>
<script src="cliente/js/notifications.min.js"></script>
<script src="js/jsFilterSearch.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-slider/10.6.1/bootstrap-slider.js" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-slider/10.6.1/bootstrap-slider.min.js" type="text/javascript"></script>

<script>
    /* $(document).ready(function(){
        $("#ex24").slider({});
    }); */

    var slider = new Slider('#precio_rango',{
        value: [200000, 500000, 1000000, 1500000, 2000000],
        ticks: [200000, 500000, 1000000, 1500000, 2000000],
        lock_to_ticks: true
        });
        slider.on("slide", function(sliderValue) {
            var slideVal1=sliderValue[0];
            var slideVal2=(sliderValue[1]==2000000)?"más":"$"+sliderValue[1];
            
            document.getElementById("valSlider1").textContent = "$"+slideVal1;
            document.getElementById("valSlider2").textContent = slideVal2;
            document.getElementById("valSlid1").value = sliderValue[0];
            document.getElementById("valSlid2").value = sliderValue[1];
        });
</script>


<?
}

function paginaTion(){
    include_once("includes/conexion.php");
    $conn = conectar();
    ?>

    <div class="album py-5 bg-light"  >
        <div class="container" >
            <div class="row" >
                <?
                if(!isset($_GET['pagina'])){
                    $pagina=1;
                }else{
                    $pagina=$_GET['pagina'];
                }

                $result_per_page = 6;
                $query = $conn->query("SELECT * FROM tb_contenido");
                $number_rows = mysqli_num_rows($query);
                
                $number_of_pages = ceil($number_rows / $result_per_page);
                //if (!isset($_GET['page'])) {
                //    $page = 1;
                //} else {
                //    $page = $_GET['page'];
                //}
                $this_page_first_result = ($pagina-1)*$result_per_page;
                //starting_limit_number=(page-1)*results_per_page
                $consultaContenido = $conn->query("SELECT coidContenido, coDescripcion, cofechaCreacion FROM tb_contenido LIMIT ".$this_page_first_result."," . $result_per_page);

                while($resultadoContenido = $consultaContenido->fetch_array()){
                    $consultaImagenes = $conn->query("SELECT coNomimg, coidImagen, cotipoImg, tb_contenido_coidContenido FROM tb_imagenes WHERE tb_contenido_coidContenido= " . $resultadoContenido['coidContenido'] . " AND cotipoImg='principal'");
                    $Imagen = $consultaImagenes->fetch_assoc();
                    ?>
                    <div class="col-md-4">
                        <div class="card mb-4 shadow-sm">
                            <img class="card-img-top" src="img/contenido/<?= $Imagen['coNomimg']; ?>" alt="Thumbnail [100%x225]" style="height: 225px; width: 100%; display: block;" data-holder-rendered="true"> <!-- data-src="holder.js/100px225?theme=thumb&amp;bg=55595c&amp;fg=eceeef&amp;text=Thumbnail" alt="Thumbnail [100%x225]" style="height: 225px; width: 100%; display: block;" src="data:image/svg+xml;charset=UTF-8,%3Csvg%20width%3D%22348%22%20height%3D%22225%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20viewBox%3D%220%200%20348%20225%22%20preserveAspectRatio%3D%22none%22%3E%3Cdefs%3E%3Cstyle%20type%3D%22text%2Fcss%22%3E%23holder_166aba16d02%20text%20%7B%20fill%3A%23eceeef%3Bfont-weight%3Abold%3Bfont-family%3AArial%2C%20Helvetica%2C%20Open%20Sans%2C%20sans-serif%2C%20monospace%3Bfont-size%3A17pt%20%7D%20%3C%2Fstyle%3E%3C%2Fdefs%3E%3Cg%20id%3D%22holder_166aba16d02%22%3E%3Crect%20width%3D%22348%22%20height%3D%22225%22%20fill%3D%22%2355595c%22%3E%3C%2Frect%3E%3Cg%3E%3Ctext%20x%3D%22116.71875%22%20y%3D%22120.15%22%3EThumbnail%3C%2Ftext%3E%3C%2Fg%3E%3C%2Fg%3E%3C%2Fsvg%3E" data-holder-rendered="true"> -->
                            <div class="card-body">
                                <p class="card-text">
                                    <?= $resultadoContenido['coDescripcion']; ?>
                                </p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="btn-group">
                                        <a href="javascript:void(0)" onclick="cargaFormulario(<?= $Imagen['tb_contenido_coidContenido']; ?>,'detalles.php')"><button type="button" class="btn btn-sm btn-outline-primary">Detalles</button></a>
                                        <button type="button" class="btn btn-sm btn-outline-primary" onclick="clipboard(3,<?= $resultadoContenido['coidContenido']; ?>)">Compartir</button>
                                    </div>

                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <small class="label text-muted">
                                        Publicado <?= time_passed($resultadoContenido['cofechaCreacion']); ?> </small>
                                </div>
                            </div>
                        </div>
                    </div>
                <?}?>
            </div>
            <nav aria-label="Paginacion Aldunate">
                <ul class="pagination">
                    <li class="page-item  <?echo $_GET['pagina']<= 1? 'disabled':''?>"><a class="page-link" href="javascript:void(0)"  onclick="verContenedorPagina('detalles.php', 5, '<?=$_GET['pagina']-1;?>')" >Anterior</a></li>
                    <?
                    for ($page = 0; $page < $number_of_pages; $page++) {
                    ?>
                        <li class="page-item  <? echo $_GET['pagina']== $page+1? 'active':''?>"><a class="page-link" href="javascript:void(0)" onclick="verContenedorPagina('detalles.php', 5, '<?=$page+1;?>')"><?=$page+1;?></a></li>
                    <?}?>
                    <li class="page-item <?echo $_GET['pagina']>= $number_of_pages? 'disabled':''?>"><a class="page-link" href="javascript:void(0)" onclick="verContenedorPagina('detalles.php', 5, '<?=$_GET['pagina']+1;?>')">Siguiente</a></li><!-- index.php?pagina=<?//echo $_GET['pagina']+1 ?>-->
                </ul>
            </nav>
        </div>
    </div>

<script src="js/jsfunciones.js"></script>
<?}


function detalles()
{
    include_once("includes/conexion.php");
    $conn = conectar();
    $id = $_GET['id_propiedad'];
    //echo '<prev>' . var_dump($id) . '</prev>';
    ?>
    <div id="sliderAldunate" class="carousel slide" data-ride="carousel">
        <ul class="carousel-indicators">
            <?
            $consulContenido2 = $conn->query("SELECT coTitulo, coidContenido, coDescripcion FROM tb_contenido WHERE coidContenido=" . $id);
            $activarItem2 = 0;
            while ($resultContenido2 = $consulContenido2->fetch_assoc()) {
                /* echo $resultContenido2['coTitulo']; */
                $consultImg1 = $conn->query("SELECT coidImagen, coNomimg, tb_contenido_coidContenido, cotipoImg FROM tb_imagenes WHERE tb_contenido_coidContenido=$id ORDER BY coidImagen ASC");
                while ($resultImagen2 = $consultImg1->fetch_assoc()) {
                    ?>
            <li data-target="#sliderAldunate" data-slide-to="<?= $activarItem2; ?>" <? if ($activarItem2 == 0) { ?>class="
                <? echo 'active'; ?>"
                <?
            } ?>></li>
            <?
            $activarItem2++;
        }
    }
    ?>
    </ul>
    <div class="carousel-inner">
        <?
        $consulContenido = $conn->query("SELECT coTitulo, coidContenido, coDescripcion, coDireccion, coComuna, coDetalles, coPrecioCLP, coPreciouF  FROM tb_contenido WHERE coidContenido=" . $id);
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
                $jsonDetalles = json_decode($resultContenido['coDetalles'], true);
                foreach ($jsonDetalles as $detalles => $extras) :
                    foreach ($jsonDetalles['contenido'] as $contenedor => $resultado) :
                        foreach ($jsonDetalles['contenido'][$contenedor] as $llave => $valor) :
                            foreach ($jsonDetalles['contenido'][0][$llave] as $key => $value) { //=> $value) {
                                switch ($key) {
                                    case 'validation_bano':
                                        if ($value == 1) {
                                            $banoval = 'Si';
                                        } else if ($value == 0) {
                                            $banoval = 'No';
                                        }
                                        break;
                                    case 'cantidad_bano':
                                        if ($value == null) {
                                            $banocant = 0;
                                        } else {
                                            $banocant = $value;
                                        }
                                        break;
                                    case 'validation_pisos':
                                        if ($value == 1) {
                                            $pisosval = 'Si';
                                        } else if ($value == 0) {
                                            $pisosval = 'No';
                                        }
                                        break;
                                    case 'cantidad_pisos':
                                        if ($value == null) {
                                            $pisoscant = 0;
                                        } else {
                                            $pisoscant = $value;
                                        }
                                        break;
                                    case 'validation_oficina':
                                        if ($value == 1) {
                                            $oficinaval = 'Si';
                                        } else if ($value == 0) {
                                            $oficinaval = 'No';
                                        }
                                        break;
                                    case 'cantidad_oficina':
                                        if ($value == null) {
                                            $oficinacant = 0;
                                        } else {
                                            $oficinacant = $value;
                                        }
                                        break;
                                    case 'validation_estacionamiento':
                                        if ($value == 1) {
                                            $estaval = 'Si';
                                        } else if ($value == 0) {
                                            $estaval = 'No';
                                        }
                                        break;
                                }
                            }
                        endforeach;
                    endforeach;
                endforeach;

                switch ($resultContenido['coComuna']) {
                    case 'P1C1CO00':
                        $comuna = 'Canela';
                        break;
                    case 'P1C1CO01':
                        $comuna = 'Illapel';
                        break;
                    case 'P1C1CO02':
                        $comuna = 'Los Vilos';
                        break;
                    case 'P1C1CO03':
                        $comuna = 'Salamanca';
                        break;
                    case 'P2C2CO04':
                        $comuna = 'Andacollo';
                        break;
                    case 'P2C2CO05':
                        $comuna = 'Coquimbo';
                        break;
                    case 'P2C2CO06':
                        $comuna = 'La Higuera';
                        break;
                    case 'P2C2CO07':
                        $comuna = 'La Serena';
                        break;
                    case 'P2C2CO08':
                        $comuna = 'Paihuano';
                        break;
                    case 'P2C2CO09':
                        $comuna = 'Vicuña';
                        break;
                    case 'P3C3CO10':
                        $comuna = 'Combarbala';
                        break;
                    case 'P3C3CO11':
                        $comuna = 'Monte Patria';
                        break;
                    case 'P3C3CO12':
                        $comuna = 'Ovalle';
                        break;
                    case 'P3C3CO13':
                        $comuna = 'Punitaqui';
                        break;
                    case 'P3C3CO14':
                        $comuna = 'Rio Hurtado';
                        break;
                }

                ?>

        <div class="carousel-item <?= $item; ?>" style="height: 60%!important;">
            <img src="img/contenido/<?= $resultImagen['coNomimg']; ?>" style="height:750px;"><!-- alt="Colina" -->
            <div class="carousel-caption" style="text-align:start; position:absolute;">
                <h4>
                    <?= $resultContenido['coTitulo']; ?>
                </h4>
                <p>
                    <?= $resultContenido['coDireccion']; ?>,
                    <?= $comuna ?>
                </p>
                <p>
                    <?='$'.$val=miles($resultContenido['coPrecioCLP']); ?> CLP, UF <?= $resultContenido['coPreciouF']; ?>
                </p>
            </div>
            <!--<div class="carousel-caption fadeInLeft ">
				 <div class="caption-titulo" >
					<p><?= substr($resultContenido['coTitulo'], 0, 20); ?></p>
				</div> -->
            <!-- div class="caption-contenido">
                <p>
                    <?= substr($resultContenido['coDescripcion'], 0, 40); ?>...</p>
                <p><a class="btn btn-sm btn-success" id="carouselButtons" href="/" role="button">Ver Más</a></p>
        </div>
    </div> -->
        </div>

        <?
        $titulo = $resultContenido['coTitulo'];
        $descripcion = ($resultContenido['coDescripcion']);
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
        <h1 class="jumbotron-heading">
            <?= $titulo ?>
        </h1>
        <div class="row"></div>
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
                            <?= $descripcion; ?>
                        </p>
                    </div>
                </div>
                <div class="card w-100">
                    <div class="card-body">
                        <h4 class="card-title">Características </h4>
                        <h5 class="card-subtitle mt-3">Baño</h5>
                        <div class="d-flex flex-row">
                            <span class="w-100">
                                <?= $banoval; ?> </span>
                            <span class="w-100">
                                <?= $banocant; ?> Baños</span>
                        </div>
                        <h5 class="card-subtitle mt-3">Pisos</h5>
                        <div class="d-flex flex-row">
                            <span class="w-100">
                                <?= $pisosval; ?></span>
                            <span class="w-100">
                                <?= $pisoscant; ?> Pisos</span>
                        </div>
                        <h5 class="card-subtitle mt-3">Oficinas</h5>
                        <div class="d-flex flex-row">
                            <span class="w-100">
                                <?= $oficinaval; ?></span>
                            <span class="w-100">
                                <?= $oficinacant; ?> Oficinas</span>
                        </div>
                        <h5 class="card-subtitle mt-3">Estacionamiento</h5>
                        <div class="d-flex flex-row">
                            <span class="w-100">
                                <?= $estaval; ?></span>
                        </div>


                    </div>
                </div>
            </div>
            <div class="col-lg-5 col-md-12 col-12 d-flex flex-column">
                <div class="card mb-2">
                    <div class="card-body">
                        <h4 class="card-title">Contacto</h4>
                        <h5 class="card-subtitle mt-3">Propiedades Aldunate:</h5>
                        <table class="table table-borderless">
                            <tbody>
                                <tr>
                                    <th scope="row">Ubicación:</th>
                                    <td>Balmaceda #469, Oficina 22, La Serena.</td>
                                </tr>
                                <tr>
                                    <th scope="row">Tel. movil:</th>
                                    <td><a href="tel:+56977568094">+56 9 77568094</a></td>
                                </tr>
                                <tr>
                                    <th scope="row">Email:</th>
                                    <td><a href="mailto:juliaaldunateg@gmail.com" target="blank_">juliaaldunateg@gmail.com</a></td>
                                </tr>
                                <tr>
                                    <th scope="row">Sitio Web:</th>
                                    <td><a href="http://www.propiedadesaldunate.cl/" target="blank_">www.propiedadesaldunate.cl</a></td>
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

<?
}



function shared()
{
    include_once("includes/conexion.php");
    $conn = conectar();
    $id = $_GET['id_propiedad'];
    $consultaContentShared = $conn->query("SELECT coTitulo, coidContenido, coDescripcion FROM tb_contenido WHERE coidContenido=" . $id);
    $resultContentShared = $consultaContentShared->fetch_assoc();
    $tituloShared = $resultContentShared['coTitulo'];
    $descripcionShared = $resultContentShared['coDescripcion'];
    $consultImgShared = $conn->query("SELECT coidImagen, coNomimg, tb_contenido_coidContenido, cotipoImg FROM tb_imagenes WHERE tb_contenido_coidContenido=$id AND cotipoImg='principal' ORDER BY coidImagen ASC");
    $resultImgShared = $consultImgShared->fetch_assoc();
    $nomImgShared = $resultImgShared['coNomimg'];
    ?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta http-equiv="content-type" content="text/html; utf-8">
    <!-- <meta charset="UTF-8"> -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- meta tags de redes sociales -->
    <meta property="og:url" content="http://propiedadesaldunate.cl/proiedad/3/id/<?= $id; ?>" />
    <meta property="og:type" content="article" />
    <meta property="og:title" content="<?= $tituloShared; ?>" />
    <meta property="og:description" content="<?= $descripcionShared; ?>" />
    <meta property="og:image" content="http://propiedadesaldunate.cl/img/contenido/<?=$nomImgShared; ?>" />
    <meta property="og:image:secure_url" content="https://propiedadesaldunate.cl/img/contenido/<?= $nomImgShared; ?>" />
    <meta property="og:image:type" content="image/png" />
    <meta property="og:image:type" content="image/jpeg" />
    <meta property="og:image:width" content="400" />
    <meta property="og:image:height" content="300" />
    <!-- meta tags de redes sociales -->
    <title>Propiedades Aldunate</title>
    <link rel="stylesheet" href="../../../css/bootstrap.min.css">
    <link rel="stylesheet" href="../../../css/bootstrap.min.css">
    <link rel="stylesheet" href="../../../css/animate.css">
    <link rel="stylesheet" href="../../../css/min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <link rel="shortcut icon" href="../../../img/aldunate.ico" type="image/x-icon">
</head>

<body>
    <!-- <nav class="navbar navbar-expand-md navbar-dark fixed-top" style="background-color:#232528;"> -->
<nav class="navbar navbar-dark navbar-expand-md navbar-fixed-top" style="background-color:#232528;">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="javascript:void(0)" onclick="verContenedor('detalles.php',1)" style="diplay:block; margin: 0 0 0 0;"> <img src="../../../img/logo_aldunate.png" width="50%;"> </a><!--  -->
        </div>
        <!-- <navbar-dark navbar-expand-lg> -->

        <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarsExampleDefault" style="margin: 0 0 0 15%;">
            <ul class="nav navbar-nav mr-auto navbar-right">
                <li class="nav-item active">
                    <a class="nav-link" href="javascript:void(0)" onclick="verContenedor('detalles.php',1)">Inicio <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="javascript:void(0)" onclick="verContenedor('detalles.php', 4);">Conócenos</a>
                </li>
            </ul>
        </div>
    </div>
</nav> 

    <div id="contenedor" name="contenedor">
        <!-- ACA VA A CARGAR LOS ENLACES DE COMPARTIR -->
        <div id="sliderAldunate" class="carousel slide" data-ride="carousel">
            <ul class="carousel-indicators">
                <?
                $consulContenido2 = $conn->query("SELECT coTitulo, coidContenido, coDescripcion FROM tb_contenido WHERE coidContenido=" . $id);
                $activarItem2 = 0;
                while ($resultContenido2 = $consulContenido2->fetch_assoc()) {
                    /* echo $resultContenido2['coTitulo']; */
                    $consultImg1 = $conn->query("SELECT coidImagen, coNomimg, tb_contenido_coidContenido, cotipoImg FROM tb_imagenes WHERE tb_contenido_coidContenido=$id ORDER BY coidImagen ASC");
                    while ($resultImagen2 = $consultImg1->fetch_assoc()) {
                        ?>
                <li data-target="#sliderAldunate" data-slide-to="<?= $activarItem2; ?>" <? if ($activarItem2 == 0) { ?>class="
                    <? echo 'active'; ?>"
                    <?
                } ?>></li>
                <?
                $activarItem2++;
            }
        }
        ?>
            </ul>
            <div class="carousel-inner">
                <?
                $consulContenido = $conn->query("SELECT coTitulo, coidContenido, coDescripcion, coDireccion, coComuna, coDetalles FROM tb_contenido WHERE coidContenido=" . $id);
                $activarItem = 0;
                while ($resultContenido = $consulContenido->fetch_assoc()) {
                    $consultImg = $conn->query("SELECT coidImagen, coNomimg, tb_contenido_coidContenido, cotipoImg FROM tb_imagenes WHERE tb_contenido_coidContenido= $id ORDER BY coidImagen ASC");
                    while ($resultImagen = $consultImg->fetch_assoc()) {
                        if ($activarItem == 0) {
                            $item = "active";
                        } else {
                            $item = "";
                        }
                        $jsonDetalles = json_decode($resultContenido['coDetalles'], true);
                        foreach ($jsonDetalles as $detalles => $extras) :
                            foreach ($jsonDetalles['contenido'] as $contenedor => $resultado) :
                                foreach ($jsonDetalles['contenido'][$contenedor] as $llave => $valor) :
                                    foreach ($jsonDetalles['contenido'][0][$llave] as $key => $value) { //=> $value) {
                                        switch ($key) {
                                            case 'validation_bano':
                                                if ($value == 1) {
                                                    $banoval = 'Si';
                                                } else if ($value == 0) {
                                                    $banoval = 'No';
                                                }
                                                break;
                                            case 'cantidad_bano':
                                                if ($value == null) {
                                                    $banocant = 0;
                                                } else {
                                                    $banocant = $value;
                                                }
                                                break;
                                            case 'validation_pisos':
                                                if ($value == 1) {
                                                    $pisosval = 'Si';
                                                } else if ($value == 0) {
                                                    $pisosval = 'No';
                                                }
                                                break;
                                            case 'cantidad_pisos':
                                                if ($value == null) {
                                                    $pisoscant = 0;
                                                } else {
                                                    $pisoscant = $value;
                                                }
                                                break;
                                            case 'validation_oficina':
                                                if ($value == 1) {
                                                    $oficinaval = 'Si';
                                                } else if ($value == 0) {
                                                    $oficinaval = 'No';
                                                }
                                                break;
                                            case 'cantidad_oficina':
                                                if ($value == null) {
                                                    $oficinacant = 0;
                                                } else {
                                                    $oficinacant = $value;
                                                }
                                                break;
                                            case 'validation_estacionamiento':
                                                if ($value == 1) {
                                                    $estaval = 'Si';
                                                } else if ($value == 0) {
                                                    $estaval = 'No';
                                                }
                                                break;
                                        }
                                    }
                                endforeach;
                            endforeach;
                        endforeach;

                        switch ($resultContenido['coComuna']) {
                            case 'P1C1CO00':
                                $comuna = 'Canela';
                                break;
                            case 'P1C1CO01':
                                $comuna = 'Illapel';
                                break;
                            case 'P1C1CO02':
                                $comuna = 'Los Vilos';
                                break;
                            case 'P1C1CO03':
                                $comuna = 'Salamanca';
                                break;
                            case 'P2C2CO04':
                                $comuna = 'Andacollo';
                                break;
                            case 'P2C2CO05':
                                $comuna = 'Coquimbo';
                                break;
                            case 'P2C2CO06':
                                $comuna = 'La Higuera';
                                break;
                            case 'P2C2CO07':
                                $comuna = 'La Serena';
                                break;
                            case 'P2C2CO08':
                                $comuna = 'Paihuano';
                                break;
                            case 'P2C2CO09':
                                $comuna = 'Vicuña';
                                break;
                            case 'P3C3CO10':
                                $comuna = 'Combarbala';
                                break;
                            case 'P3C3CO11':
                                $comuna = 'Monte Patria';
                                break;
                            case 'P3C3CO12':
                                $comuna = 'Ovalle';
                                break;
                            case 'P3C3CO13':
                                $comuna = 'Punitaqui';
                                break;
                            case 'P3C3CO14':
                                $comuna = 'Rio Hurtado';
                                break;
                        }
                        ?>

                <div class="carousel-item <?= $item; ?>" style="height: 60%!important;">
                    <img src="../../../img/contenido/<?=$resultImagen['coNomimg']; ?>" style="height:750px;"><!-- alt="Colina" -->
                    <div class="carousel-caption" style="text-align:start; position:absolute;">
                        <h4>
                            <?= $resultContenido['coTitulo']; ?>
                        </h4>
                        <p>
                            <?= $resultContenido['coDireccion']; ?>,
                            <?= $comuna ?>
                        </p>
                    </div>
                </div>

                <?
                $titulo = $resultContenido['coTitulo'];
                $descripcion = ($resultContenido['coDescripcion']);
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
                <h1 class="jumbotron-heading">
                    <?= $titulo ?>
                </h1>
                <div class="row"></div>
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
                                    <?= $descripcion; ?>
                                </p>
                            </div>
                        </div>
                        <div class="card w-100">
                            <div class="card-body">
                                <h4 class="card-title">Características </h4>
                                <h5 class="card-subtitle mt-3">Baño</h5>
                                <div class="d-flex flex-row">
                                    <span class="w-100">
                                        <?= $banoval; ?> </span>
                                    <span class="w-100">
                                        <?= $banocant; ?> Baños</span>
                                </div>
                                <h5 class="card-subtitle mt-3">Pisos</h5>
                                <div class="d-flex flex-row">
                                    <span class="w-100">
                                        <?= $pisosval; ?></span>
                                    <span class="w-100">
                                        <?= $pisoscant; ?> Pisos</span>
                                </div>
                                <h5 class="card-subtitle mt-3">Oficinas</h5>
                                <div class="d-flex flex-row">
                                    <span class="w-100">
                                        <?= $oficinaval; ?></span>
                                    <span class="w-100">
                                        <?= $oficinacant; ?> Oficinas</span>
                                </div>
                                <h5 class="card-subtitle mt-3">Estacionamiento</h5>
                                <div class="d-flex flex-row">
                                    <span class="w-100">
                                        <?= $estaval; ?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-5 col-md-12 col-12 d-flex flex-column">
                        <div class="card mb-2">
                            <div class="card-body">
                                <h4 class="card-title">Contacto</h4>
                                <h5 class="card-subtitle mt-3">Propiedades Aldunate:</h5>
                                <table class="table table-borderless">
                                    <tbody>
                                        <tr>
                                            <th scope="row">Ubicación:</th>
                                            <td>Balmaceda #469, Oficina 22, La Serena.</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Tel. movil:</th>
                                            <td>+56 9 77568094</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Email:</th>
                                            <td>juliaaldunateg@gmail.com</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Sitio Web:</th>
                                            <td><a href="https://www.propiedadealdunate.com">www.propiedadealdunate.com</a></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </section>



    </div>

    <!-- footer -->
    <div class="md-card" style="background: #232528">
        <div class="container">
            <div class="row" style="color:#fff">
                <div class="col-md-6">
                    <!-- style="padding:0 10px" -->
                    <ul class="ek auk">
                        <li class="ace">
                            <!-- <h6 class="att">Conócenos</h6> -->
                        </li>
                        <li>
                        </li>
                    </ul>
                </div>
                <div class="col-md-2" style="padding:0 10px">
                </div>
                <div class="col-md-4" style="padding:0 10px">
                    <ul class="ek">
                        <li class="ace">
                            <h6 class="att">Contáctanos</h6>
                        </li>
                        <li class="an">
                            <a href="https://www.amarillas.cl/fichas/propiedades-aldunate_7455014315694371/" target="_blank">
                                <i class="fab" title="Amarillas Publiguias"> <img src="../../../img/amarillas.png" style="width:35px; heigth:35px; vertical-align:baseline;"></i>&nbsp;
                                <!-- Amarillas -->
                                <!-- fab fa-twitter-square fa-lg -->
                            </a>
                            <a href="https://www.facebook.com/PropiedadesAldunate" target="_blank">
                                <i class="fab fa-facebook-square fa-3x" title="facebook"></i>&nbsp;
                                <!-- Facebook -->
                            </a>
                            <a href="mailto:juliaaldunateg@gmail.com">
                                <i class="fa fa-envelope fa-3x" title="Mail Contacto" style="color:#FFF;"></i>&nbsp;
                                <!-- Mail -->
                            </a>
                            <a href="tel:+56977568094">
                                <i class="fas fa-phone-square fa-3x" title="Telefono Celular" style="color:#25d366;"></i>&nbsp;
                                <!-- +56977568094 -->
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <script src="../../../js/jquery.js"></script>
    <script src="../../../js/carousel.js"></script>
    <script src="../../../js/jsfunciones2.js"></script>
    <script src="../../../js/bootstrap.min.js"></script>
</body>

</html>
<?
}

function about()
{ ?>
<section class="jumbotron text-center">
    <div class="container">
        <h1 class="jumbotron-heading">
            Conócenos
        </h1>
        <div class="row"></div>
    </div>
</section>
<section>
    <div class="container d-flex flex-column mt-4">
        <div class="d-flex flex-lg-row flex-md-column flex-column mt-3 mb-3">
            <div class="col-lg-7 col-md-12 col-12 d-flex flex-column">
                <div class="card w-100 mb-2">
                    <div class="card-body">
                        <h4 class="ek auk card-title"></h4>
                        <ul class="ek auk">
                            <li class="ace">
                                <!-- <h6 class="att">Conócenos</h6> -->
                            </li>
                            <li style="font-size:18px;">
                                <kbd>En Propiedades Aldunate</kbd> Somos corredor de Propiedades con más de 15 años de Experiencia. Nuestros servicios profesionales estan diseñados para la tranquilidad de nuestros clientes que abarcan desde: 
                                <p></p>
                                <ul>
                                    <li type="disc">Venta y Arriendo de Inmuebles y Terrenos.</li>
                                    <li type="disc">Administraci&oacute;n de Propiedades.</li>
                                    <li type="disc">Asesor&iacute;a Jur&iacute;dica Inmobiliaria.</li>
                                    <li type="disc">Obras Menores y Remodelaciones.</li>
                                </ul>
                                <p></p>
                                <ul>
                                    <ol><p> Telefono de Contacto:&nbsp;<a href="tel:+56977568094" style="color:black;" target="_blank">+56 9 77568094</a></p></ol>
                                    <ol><p> Email de Contacto:&nbsp;<a href="mailto:juliaaldunateg@gmail.com" style="color:black;" target="_blank">juliaaldunateg@gmail.com</a></p></ol>
                                </ul>
                            </li>
                        </ul>
                        <p class="card-text">
                        </p>
                    </div>

                </div>
            </div>
            <div class="col-lg-5 col-md-12 col-12 d-flex flex-column">
                <div class="card mb-2">
                    <div class="card-body">
                        <!-- <h4 class="card-title"></h4> -->
                        <!-- <h5 class="card-subtitle mt-3">Propiedades Aldunate:</h5> -->
                        <table >
                            <tbody>
                                <tr>
                                    <td><iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d216.1665677375379!2d-71.2500600581384!3d-29.90274953313729!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x9691ca7a5f2e6be9%3A0xd4def51cdeda24a0!2sAv.+Balmaceda+469%2C+Oficina+22%2C+La+Serena%2C+Regi%C3%B3n+de+Coquimbo!5e0!3m2!1ses!2scl!4v1557910727940!5m2!1ses!2scl" width="130%" height="240%" frameborder="0" style="border:0" allowfullscreen></iframe></td>
                                </tr>
                                <!-- <tr>
                                    <th scope="row">Tel. movil:</th>
                                    <td>+56 9 77568094</td>
                                </tr>
                                <tr>
                                    <th scope="row">Email:</th>
                                    <td>juliaaldunateg@gmail.com</td>
                                </tr>
                                <tr>
                                    <th scope="row">Sitio Web:</th>
                                    <td><a href="http://www.propiedadealdunate.com">www.propiedadealdunate.com</a></td>
                                </tr> -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>



        </div>
</section>

<?
}

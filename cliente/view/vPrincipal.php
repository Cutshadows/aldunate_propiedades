<?
error_reporting(E_ALL & ~E_NOTICE);
include_once('../include/conexion.php');
$conn=conectar();
$router=$_POST['ruta'];
switch ($router) {
    case 1:inicio();exit;
    case 2:formulario_contenido();exit;
    case 3:admin_contenido();exit;
    case 4:agregar_admin();exit;
		case 5:tabla_admin();exit;
		case 6:tabla_actividad();exit;
		case 7:todo_contenido();exit;
}

function inicio(){?>
     <!-- Main content -->
    <section class="content">
      <div class="callout callout-warning">
        <h4>Warning!</h4>

        <p><b>Morris.js</b> charts are no longer maintained by its author. We would recommend using any of the other
          charts that come with the template.</p>
      </div>
      <div class="row">
        <div class="col-md-6">
          
			<!-- LINE CHART -->
			<div class="box box-info">
				<div class="box-header with-border">
				<h3 class="box-title">Entradas Mensuales</h3>

				<div class="box-tools pull-right">
					<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
					</button>
					<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
				</div>
				</div>
				<div class="box-body chart-responsive">
				<div class="chart" id="entradas-mensuales" style="height: 300px;"></div>
				</div>
				<!-- /.box-body -->
			</div>
			<!-- /.box -->
          <!-- DONUT CHART -->
          <div class="box box-danger">
            <div class="box-header with-border">
              <h3 class="box-title">Ciudades</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body chart-responsive">
              <div class="chart" id="sales-chart" style="height: 300px; position: relative;"></div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

        </div>
        <!-- /.col (LEFT) -->
        <div class="col-md-6">
          <!-- LINE CHART -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Entradas Ultimos 7 dias</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body chart-responsive">
              <div class="chart" id="entradas-diarias" style="height: 300px;"></div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

         					

        </div>
        <!-- /.col (RIGHT) -->
      </div>
      <!-- /.row -->

    </section>
    <!-- /.content -->
  </div>
	
	<script src="../cliente/js/raphael.min.js"></script>
	<script src="../cliente/js/morris.min.js"></script>
	<script src="../cliente/js/controller/router.js"></script>
	<script src="../cliente/js/controller/graphic.js"></script>
	<!-- /.content -->
<?}


function formulario_contenido(){
	include_once('../include/conexion.php');
	$conn=conectar();
	$id=$_POST['id'];
	if ($id > 0) {
		//echo "area de actualizar usuario";
		include_once("../include/conexion.php");
		$conn = conectar();
		$boton = "Modificar";
		$consul = $conn->query("SELECT coidContenido, coTitulo, coDescripcion, coComuna, coDireccion, coDetalles, coPrecioCLP, coPreciouF, tb_usuario_coidUsuario, cofechaCreacion, coestadoContenido FROM tb_contenido WHERE coidContenido=" . $id);
		$datos = $consul->fetch_assoc();


		$jsonDetalles=json_decode($datos['coDetalles'], true);
		
		foreach($jsonDetalles as $detalles => $extras):
			/* echo $detalles."<br />"; */
			/* echo $extras."<br />"; */
			foreach($jsonDetalles['contenido'] as $contenedor => $resultado):
				//echo $contenedor . "<br />";
				foreach($jsonDetalles['contenido'][$contenedor] as $llave => $valor):
					//echo $llave . "<br />";
					//echo $valor . "<br />";
						foreach ($jsonDetalles['contenido'][0][$llave] as $key => $value){ //=> $value) {
								//echo $key  . "<br />"; //. $value;
								switch($key){
									case 'validation_bano':
										if($value==1){
												$banoval='checked';
										}else if($value == 0){
											 $banoval = '';
										}
									break;
									case 'cantidad_bano':
										$banocant=$value;
									break;
								case 'validation_pisos':
									if ($value == 1) {
										 $pisosval = 'checked';
									} else if ($value == 0) {
										 $pisosval = '';
									}
									break;
								case 'cantidad_pisos':
									$pisoscant = $value;
									break;
								case 'validation_oficina':
									if ($value == 1) {
										 $oficinaval = 'checked';
									} else if ($value == 0) {
										 $oficinaval = '';
									}
									break;
								case 'cantidad_oficina':
									$oficinacant = $value;
									break;
								case 'validation_estacionamiento':
									if ($value == 1) {
										 $estaval = 'checked';
									} else if ($value == 0) {
										 $estaval = '';
									}
									break;
								}
						}
				endforeach;
			endforeach;
		endforeach;
	

		
		/* foreach ($jsonDetalles as $llave => $valor):
			echo $llave . "<br/>";
			foreach($jsonDetalles[$llave] as $bano => $valbano) :
				echo $bano . "<br/>";
				echo $valbano . "<br/>";
			endforeach;
		endforeach; */
		

	} 
	?>
	<section class="content-header">
		<h1>
			Creación Contenido
			<small>Para Mostrar en Web</small>
		</h1>
		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
			<li><a href="#">Examples</a></li>
			<li class="active">Blank page</li>
		</ol>
		</section>
		<div class="row">
			<div class="col-md-12">
				<!-- Main content -->
				<section class="content">

				<!-- Default box -->
				<div class="box">
					<div class="box-header with-border">
					<h3 class="box-title">Formulario de Contenido</h3>

					<div class="box-tools pull-right">
						<button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
								title="Collapse">
						<i class="fa fa-minus"></i></button>
						<button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
						<i class="fa fa-times"></i></button>
					</div>
					</div>
					<div class="box-body">
					<form id="form-contenido" name="form-contenido" role="form" enctype="multipart/form-data" >
						<div class="box-body">
							<div class="form-group">
								<label for="txtTitulo">Titulo</label>
								<input type="text" class="form-control" id="txtTitulo" name="txtTitulo" placeholder="" <?if($id>0){?>value="<?=$datos['coTitulo'];?>"<?}?>>
							</div>
							
							<div class="form-group">
								<label>Descripción</label>
								<textarea class="form-control" rows="4" name="txtdescripcion" id="txtdescripcion" placeholder="Ingrese Descripción ..."><?if($id>0){echo $datos['coDescripcion'];}?></textarea>
							</div>
							<div class="input-group">
								<!-- <label for="txtValor">Valor</label>  -->
								<span class="input-group-addon"><i class="fa fa-dollar"></i></span>
									<input type="text" class="form-control txtnumber" id="txtValor" name="txtValor" placeholder="Valor Monetario" <?if($id>0){?>value="<?=$datos['coPrecioCLP'];?>"<?}?>>
								<span class="input-group-addon">CLP</span>
							</div>
							<div class="input-group" style="margin-top:2%;">
								<!-- <label for="txtValor">Valor</label>  -->
								<!-- <span class="input-group-addon"><i class="fa fa-dollar"></i></span> -->
									<input type="text" class="form-control txtnumber" id="txtvaluf" name="txtvaluf" placeholder="Valor en Unidad de Fomento" <?if($id>0){?>value="<?=$datos['coPreciouF'];?>"<?}?> >
								<span class="input-group-addon">UF</span>
							</div>
							<div class="row">
								<div class="col-md-4">
									<div class="form-group">
										<label for="txtDetalles">Dirección</label> 
										<input type="text" class="form-control" id="txtDireccion" name="txtDireccion" placeholder="" <?if($id>0){?>value="<?=$datos['coPrecioCLP'];?>"<?}?>>
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label for="txtDetalles">Comuna</label>
										<!-- <input type="text" class="form-control" id="txtDetalles" placeholder=""> -->
										<select class="form-control" name="slctComuna" id="slctComuna" >
											<option value="0">Seleccionar</option>
											<?
											$pregunta=$conn->query("SELECT * FROM tb_comuna ORDER BY coidComuna ='P2C2CO07' DESC");
										
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
								<div class="col-md-4">
									<div class="form-group">
										<label for="txtDetalles">Tipo Contenido</label>
										<!-- <input type="text" class="form-control" id="txtDetalles" placeholder=""> -->
										<?
										switch ($datos['coestadoContenido']) {
											case 1:
													$select1='selected="selected"';
												break;
											case 2:
													$select2 = 'selected="selected"';
												break;
											case 3:
													$select3 = 'selected="selected"';
												break;
											case 4:
													$select4 = 'selected="selected"';
												break;
										}
										?>
										<select class="form-control" name="slctEstado" id="slctEstado" >
											<option value="0" >Seleccionar</option>
											<option value="1" <?=$select1;?>>Venta</option>
											<option value="2" <?=$select2;?>>Arriendo</option>
											<option value="3" <?=$select3;?>>Arrendado</option>
											<option value="4" <?=$select4;?>>Vendido</option>
										</select>
										
									</div>
								</div>
							</div>
										<div class="row mb20">
											<div class="col-lg-3">
												<label for="txtDetalles">Baños</label>
												<div class="input-group">
														<span class="input-group-addon">
														<input type="checkbox" <?=$banoval;?> name="chkboxBanos" id="chkboxBanos">
														</span>
										<input type="text" class="form-control txtnumber" id="txtBanos"  name="txtBanos" <?if($id>0 && $banocant != 0){echo 'value="'.$banocant.'"'; }else{?> disabled="disabled"<?}?>>
												</div>
												<!-- /input-group -->
											</div>
											<div class="col-lg-3">
												<label for="txtDetalles">Pisos</label>
												<div class="input-group">
														<span class="input-group-addon">
														<input type="checkbox"  <?=$pisosval;?>  name="chkboxPiso" id="chkboxPiso">
														</span>
													<input type="text" class="form-control txtnumber"  name="txtPiso" id="txtPiso" <?if($id>0 && $pisoscant != 0){echo 'value="'.$pisoscant.'"'; }else{?> disabled="disabled"<?}?>>
												</div>
												<!-- /input-group -->
											</div>
											<div class="col-lg-3">
												<label for="txtDetalles">Oficinas</label>
												<div class="input-group">
														<span class="input-group-addon">
														<input type="checkbox"  <?=$oficinaval;?> name="chkboxOficinas" id="chkboxOficinas">
														</span>
													<input type="text" class="form-control txtnumber" name="txtOficinas" id="txtOficinas" <?if($id>0 && $oficinacant!=0){echo 'value="'.$oficinacant.'"'; }else{?> disabled="disabled"<?}?>>
												</div>
												<!-- /input-group -->
											</div>
											<div class="col-lg-3">
												<label for="txtDetalles">Estacionamiento</label>
												<div class="input-group">
														<input type="checkbox"  <?=$estaval;?> data-toggle="data-toggle" name="chkboxEstacion" id="chkboxEstacion">
												</div>
												<!-- /input-group -->
											</div>
										</div>
										<?
									
										?>
								<div class="panel panel-info">
									<div class="panel-heading"><h5><strong>IMAGENES</strong>
										<small> [Imagenes de los Sectores.]</small></h5>
									</div>
									<div class="container-fluid">
										<div class="row mb20">
											<!-- <div class="col-md-6">
												<label for="exampleInputFile">File input</label>
												<div class="form-group"> 
													<input type="file" id="exampleInputFile	">-->
												<!-- </div> 
											</div>-->
											<div class="col-md-8">
												<!-- <div class="row">
													<div class="col-md-6">
														<label for="btnAddImg"> Agregar Imagenes</label>
													</div>
													<div class="col-md-6">
														<button type="button" class="btn btn-success btn-block text-right" id="btnAddImg" name="btnAddImg">
															<span class="fa fa-plus" aria-hidden="true"></span>
														</button>
													</div>	
												</div> -->
												<?if($id==0) {?>
												<div class="row"><div class="col-md-12"><div class="form-group"><div class="input-group"><span class="input-group-addon"><b>1</b></span><input type="file" class="form-control" name="cnombreimg[]" id="cnombreimg" multiple /></div></div></div></div>
												<?}?>
											</div>
											<!-- <div class="col-md-1">
												<label></label>
												<button type="button" class="btn btn-danger btn-block text-right" id="btnAddImg" name="btnAddImg">
												<span class="fa fa-minus" aria-hidden="true"></span>
												</button>
											</div> -->
										</div>
										<div class="row">
											<div class="col-md-12">
												<div class="container-fluid" id="constructor-imagen" name="constructor-imagen">
												
													<?$datos['coidContenido'];
													$pregunta = $conn->query("SELECT coidImagen, coNomimg, tb_contenido_coidContenido FROM tb_imagenes WHERE tb_contenido_coidContenido=". $datos['coidContenido']);
												define('_ruta_', '../img/contenido/');
													if($id > 0){
														while($reqImagen=$pregunta->fetch_assoc()){?>
														<div class="row">
														<form  method="post" class="form-img-update"  enctype="multipart/form-data">
															
															<div class="col-md-4">
																<div class="input-group">
																	<img src="<?= _ruta_ . $reqImagen['coNomimg']; ?>" width='180px' height='180px'>
																	<input type="hidden" name="idImagen" id="idImagen" value="<?= $reqImagen['coidImagen'] ?>">
																</div>
															</div>
															<div class="col-md-6">
																<div class="input-group">
																	<input type="file" name="imgEditar<?=$reqImagen['coidImagen'];?>" id="imgEditar<?= $reqImagen['coidImagen']; ?>">
																	
																</div>
															</div>
															<div class="col-md-1">							
																	<button type="button" class="btn btn-sm btn-block btn-info fa fa-upload" name="imgCargar" onclick="uploadImage(<?= $reqImagen['coidImagen'] ?>, <?= $datos['coidContenido']; ?>)" id="imgCargar" ></button>
																	<input type="hidden" name="opcionImg" id="opcionImg" value="editar-imagen">
															</div>
											<!-- 				<div class="col-md-1">							
																	<button type="button" class="btn btn-sm btn-block btn-danger fa fa-trash-o" name="imgCancelar" id="imgCancelar" ></button>
															</div> -->
																
															</form>
														</div>
															
														<?}
													}
													?>
												</div>
											</div>
											<div class="col-md-3">
											</div>
										</div>
										
									</div> 
								</div>

						<div class="box-footer">
							<input type="hidden" id="opcion" name="opcion" value=<?if($id==0){echo "crear-contenido";}else{?><?echo "editar-contenido";}?> > <!-- value="" -->
							<?if($id>0){?>
									<input type="hidden" id="id_registro" name="id_registro" value=<?=$datos['coidContenido'];?> > 
							<?}?>
							<button type="submit" class="btn-block btn-block-sm btn btn-primary">Ingresar</button>
						</div>
						</form>
					
					</div>
				</div>
			</div>
		</div>

		</section>
		<!-- /.content -->
		<script src="../cliente/js/controller/contenido.js"></script>
		<script src="../cliente/js/notifications.min.js"></script>
		<script>
        /*  */
        $(function() {
				    $('#chkboxEstacion').bootstrapToggle({
                on: 'Si',
                off: 'No'
						});
            $('#chkboxEstacion').change(function(){
                    if($(this).prop('checked')==true){
                        $('#console-event').html('Toggle: ' + $(this).prop('checked'));
                        console.log('estado :' + $("#chkboxEstacion").prop('checked'));
                    }else{
                        $('#console-event').html('Toggle: ' + $(this).prop('checked'));
                        console.log('estado :' + $("#chkboxEstacion").prop('checked'));
                    }
            });				
				});				
    </script>
		<script>
			tinymce.init({
			selector: 'textarea#txtdescripcion',
			height: 300,
			menubar: false,
			plugins: [
				'advlist autolink lists link image charmap print preview anchor textcolor',
				'searchreplace visualblocks code fullscreen',
				'insertdatetime media table paste code help wordcount'
			],
			toolbar: 'undo redo | formatselect | bold italic backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat | help',
			content_css: [
				'//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
			]
			});
			$(document).ready( function() {
				/* MK Web Notification init */
				var config = {
					// Default, Primary, Success, Danger, Warning, Info, Light, Dark, Purple
					positionY: "left",
					positionX: "top",
					scrollable: false, //true
					rtl: false, // true = ltr
					max: 5, // number of notifications to display,
					dismissable: true
				};
				mkNotifications(config);
				
			}); 
		</script>
<?}

/**FUNCION PARA ABRIR EL ADMINISTRADOR DE CONTENIDO */
function admin_contenido(){?>
<section class="content-header">
		<h1>
			Administrador 
			<small>Administrar Imagenes Web</small>
		</h1>
		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
			<li><a href="#">Usuarios</a></li>
			<li class="active">Tabla Imagenes del Frontis</li>
		</ol>
		</section>
		<div class="row">
			<div class="col-md-12">
			
			<!-- Main content -->
			<section class="content">

				<!-- Default box -->
				<div class="box">
				<!-- <div class="box-header">
					<h3 class="box-title">Todos los Usuarios</h3>
				<div class="box"> -->
					<div class="box-header">
              			<h3 class="box-title">Tabla de Imagenes que Muestra en Frontis</h3>
            		</div>							
            <!-- /.box-header -->
            <div class="box-body">

              <table id="tabla_usuario" name="tabla_usuario" class="table table-bordered table-striped display"  >
                <thead>
                <tr>
                  <th>ID</th>
				  <th>Imagen</th>
                  <th>Titulo Contenido</th>
                  <th>Usuario</th>
                  <th>Tipo de Imagen</th>
                  <!-- <th>Accion</th> -->
                </tr>
                </thead>
                <tbody>
				<?
			define('_controlador_', 'cContenido.php');
			include_once("../include/conexion.php");
			$conn = conectar();

			$consulta = $conn->query("SELECT coidImagen, coNomimg, tb_contenido_coidContenido, tb_usuario_coidUsuario, cotipoImg FROM tb_imagenes");
			while ($resultado = $consulta->fetch_array()) {
				$reqContenido = $conn->query("SELECT coidContenido, coTitulo FROM tb_contenido WHERE coidContenido='" . $resultado['tb_contenido_coidContenido'] . "'");

				$resContenido = $reqContenido->fetch_array();

				$reqUsuario = $conn->query("SELECT coidUsuario, coNomUsuario FROM tb_usuario WHERE coidUsuario='" . $resultado['tb_usuario_coidUsuario'] . "'");
				$resUsuario = $reqUsuario->fetch_array();
				define('_ruta_', '../img/contenido/');
				/* switch ($resultado['cotipoImg']) {
					case 'carrusel':
						$select1 = '<div class="form-group"><select class="form-control" name="slectTipo'.$resultado['coidImagen'].'" id="slectTipo'.$resultado['coidImagen'].'" onchange="return cambiarTipo('.$resultado[' tb_contenido_coidContenido '].','.$resultado[' coidImagen '].')" ><option value="carrusel" selected="selected" >Carrusel</option><option value="normal" >Normal</option><option value="principal" >Principal</option></select></div>';
						break;
					case 'principal':
						$select1 .= '<div class="form-group"><select class="form-control" name="slectTipo'.$resultado['coidImagen'].'" id="slectTipo'.$resultado['coidImagen'].'" onchange="return cambiarTipo('.$resultado[' tb_contenido_coidContenido '].','.$resultado[' coidImagen ']. ')" ><option value="carrusel">Carrusel</option><option value="normal">Normal</option><option value="principal" selected="selected">Principal</option></select></div>';
						break;
					case 'normal':
						$select1 .= '<div class="form-group"><select class="form-control" name="slectTipo'.$resultado['coidImagen'].'" id="slectTipo'.$resultado['coidImagen'].'" onchange="return cambiarTipo('.$resultado[' tb_contenido_coidContenido '].','.$resultado[' coidImagen ']. ')" ><option value="carrusel" >Carrusel</option><option value="normal" selected="selected">Normal</option><option value="principal" >Principal</option></select></div>';
						break;
					default: echo "You bought a rusty iron medal from a shady guy who insists it's a Nobel Prize..."; break;
				} */
				
				/* if($resultado['cotipoImg']==$valores[1]){
						$select1 = '<option value="carrusel" selected="selected" >Carrusel</option><option value="normal" >Normal</option><option value="principal" >Principal</option>';
					}elseif($resultado['cotipoImg'] == $valores[0]){
						$select1 .= '<option value="carrusel">Carrusel</option><option value="normal">Normal</option><option value="principal" selected="selected">Principal</option>';
					}elseif ($resultado['cotipoImg'] == $valores[2]) {
						$select1 .= '<option value="carrusel" >Carrusel</option><option value="normal" selected="selected">Normal</option><option value="principal" >Principal</option>';
					} */
			
				?>
				<tr>
                  <td><?= $resultado['coidImagen']; ?></td>
                  <td><img src="<?= _ruta_ . $resultado['coNomimg']; ?>" width='50px' height='50px'></td>
				  <td><?= $resContenido['coTitulo']; ?></td>
				  <td><?= $resUsuario['coNomUsuario']; ?></td>
				  <td>
							<div class="form-group">
									<select class="form-control" name="slectTipo<?=$resultado['coidImagen']; ?>" id="slectTipo<?=$resultado['coidImagen']; ?>" onchange="return cambiarTipo(<?=$resultado['tb_contenido_coidContenido'];?>,<?=$resultado['coidImagen']; ?>)" >
										<?$valores= array('principal', 'carrusel','normal');
											switch ($resultado['cotipoImg']) {
												case $resultado['cotipoImg']==$valores[1]:
														echo $select1 = '<option value="carrusel" selected="selected" >Carrusel</option><option value="normal" >Normal</option><option value="principal" >Principal</option>';
													break;
												case $resultado['cotipoImg'] == $valores[0]:
														echo $select2 = '<option value="carrusel">Carrusel</option><option value="normal">Normal</option><option value="principal" selected="selected">Principal</option>';
													break;
												case $resultado['cotipoImg'] == $valores[2]:
														echo $select3 = '<option value="carrusel" >Carrusel</option><option value="normal" selected="selected">Normal</option><option value="principal" >Principal</option>';
													break;
											}										
										?>
									</select>
							</div>
					</td>
                  <!-- <td><a href="javascript:void(0)" onclick="cargaFormulario(<?= $resultado['coidContenido']; ?>,'<?= basename($_SERVER['PHP_SELF']) ?>', 2)">
                    <div id="editar" class="btn-group btn-group-toggle" data-toggle="buttons">
                    <label class="btn btn-primary">
                       
                        <span class="fa fa-pencil"></span>
                    </label>
                </a>
                <a href="javascript:void(0)" onclick="eliminararchivos('eliminar-contenido',<?= $resultado['coidContenido']; ?>,'<?= _controlador_ ?>')">
                    <label class="btn btn-danger">
                   
                    <span class="fa fa-trash"></span>
                    </label> 
                </a></td> -->
				</tr>
				<?
			}
		 ?>
                </tbody>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
				<!-- /.box-body -->
				<!--  <div class="box-footer">
					Footer
				</div> -->
				<!-- /.box-footer-->
				</div>
				<!-- /.box -->

			</section>
			</div>
		</div>
		<!-- <script src="js/controller/admin.js"></script> -->
		<!-- /.content -->
		<!-- <script src="js/jquery.dataTables.min.js"></script> -->
		<script type="text/javascript" src="../cliente/js/controller/contenido.js"></script>
		<!-- <script src="js/dataTables.bootstrap.min.js"></script> -->
		<script  src="../cliente/js/jquery.dataTables.min.js"></script>
		<script src="../cliente/js/notifications.min.js"></script>
		
		 <script>
			$(document).ready( function() {
				/* MK Web Notification init */
				var config = {
					// Default, Primary, Success, Danger, Warning, Info, Light, Dark, Purple
					positionY: "left",
					positionX: "top",
					scrollable: false, //true
					rtl: false, // true = ltr
					max: 5, // number of notifications to display,
					dismissable: true
				};
				mkNotifications(config);
				
			}); 
		</script>
<?}

/* CONTROL DE USUARIOS Y CREACION */
function agregar_admin(){
	$opcion="crear-usuario";
	$boton="Crear Nuevo Usuario";
	$id=$_POST['id'];
	if($id>0){
		//echo "area de actualizar usuario";
		$opcion = "editar-usuario";
		include_once("../include/conexion.php");
		$conn=conectar();
		$boton="Modificar";
		$consul=$conn->query("SELECT coidUsuario, coNomUsuario, coEmailUsuario, coPrivilegiosUsuario, coClaveUsuario FROM tb_usuario WHERE coidUsuario=".$id);
		$datos=$consul->fetch_assoc();
		
		
		
	}
	?>
	<section class="content-header">
		<h1>
			Administrador
			<small>Control de Usuarios</small>
		</h1>
		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
			<li><a href="#">Usuarios</a></li>
			<li class="active">Administrador</li>
		</ol>
		</section>
		<div class="row">
			<div class="col-md-8">
			
			<!-- Main content -->
			<section class="content">

				<!-- Default box -->
				<div class="box">
				<div class="box-header with-border">
					<h3 class="box-title">Crear Nuevo Usuario</h3>

					<!-- <div class="box-tools pull-right">
					<button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
							title="Collapse">
						<i class="fa fa-minus"></i></button>
					<button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
						<i class="fa fa-times"></i></button>
					</div>
				</div> -->
					<div class="box-body">
						<form id="form-usuarios">
							<div class="box-body">
								<div class="form-group">
									<label for="txtNomUsuario">Nombre Usuario:</label>
									<input type="text" autocomplete="username" class="form-control" id="txtNomUsuario" name="txtNomUsuario" placeholder="Ingrese Nombre de Usuario" <?if($id>0){?>value="<?=$datos['coNomUsuario'];?>"<?}?>>
								</div>
								<div class="form-group">
									<label for="txtEmail">Email Usuario:</label>
									<input type="text" class="form-control" autocomplete="off"  id="txtEmail" name="txtEmail" placeholder="Ingrese Email de Usuario" <?if($id>0){?>value="<?=$datos['coEmailUsuario'];?>"<?}?>>
								</div>
								
								<div class="form-group">
									<label for="tipoUsuario" class="small">Orden en el Menú</label>
									
									<?$datos['coPrivilegiosUsuario'];
									switch ($datos['coPrivilegiosUsuario']) {
										case 'super':
											$slct1='selected="selected"';
											break;
										case 'admin':
										$slct2 = 'selected="selected"';
											break;
										case 'digi':
											$slct3 = 'selected="selected"';
											break;										
									}?>
									<select class="form-control" name="tipoUsuario" id="tipoUsuario" >
									<option value="admin" <?=$slct2;?> >Administrador</option>
									<option value="digi" <?=$slct3; ?>>Digitador</option>
									<option value="super" <?= $slct1; ?>>Super Usuario</option>
									</select>
								</div>
								
								<div class="form-group">
									<label for="txtClave">Contraseña:</label>
									<input type="password"  pattern=".{6,}"  autocomplete="off"  class="form-control" id="txtClave" name="txtClave" placeholder="Clave para la Session" >
								</div>
								<div class="form-group">
									<label for="txtClave">Contraseña:</label>
									<input type="password"  pattern=".{6,}"  autocomplete="off"  class="form-control" id="txtRepiteClave" name="txtRepiteClave" placeholder="Repetir Clave para la Session" >
								</div>
								
								
							<div class="box-footer">
							<input type="hidden" name="opcion" id="opcion" value="<?if($id==0){echo $opcion;}else{echo $opcion;}?>">
							<? if($id > 0){ ?>
							<input type="hidden" name="id_usuario" id="id_usuario" value="<?=$datos['coidUsuario'];?>">
							<?};?>
								<button type="submit" class="btn-block btn-block-sm btn btn-primary"><?if($id==0){echo $boton;}else{ echo $boton;}?></button>
							</div>
						</form>
					</div>
				<!-- /.box-body -->
				<!--  <div class="box-footer">
					Footer
				</div> -->
				<!-- /.box-footer-->
				</div>
				<!-- /.box -->

			</section>
			</div>
		</div>

		<script src="../cliente/js/controller/admin.js"></script>
		<script src="../cliente/js/notifications.min.js"></script>
		
		 <script>
			$(document).ready( function() {
				/* MK Web Notification init */
				var config = {
					// Default, Primary, Success, Danger, Warning, Info, Light, Dark, Purple
					positionY: "left",
					positionX: "top",
					scrollable: false, //true
					rtl: false, // true = ltr
					max: 5, // number of notifications to display,
					dismissable: true
				};
				mkNotifications(config);
				
			}); 
		</script>
		
		
		
		
		
		<!-- /.content -->
<?}

function tabla_admin(){?>
	<section class="content-header">
		<h1>
			Administrador
			<small>Control de Usuarios</small>
		</h1>
		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
			<li><a href="#">Usuarios</a></li>
			<li class="active">Tabla Usuarios</li>
		</ol>
		</section>
		<div class="row">
			<div class="col-md-12">
			
			<!-- Main content -->
			<section class="content">

				<!-- Default box -->
				<div class="box">
				<!-- <div class="box-header">
					<h3 class="box-title">Todos los Usuarios</h3>
				<div class="box"> -->
					<div class="box-header">
              			<h3 class="box-title">Tabla de Usuarios del Sistema</h3>
            		</div>							
            <!-- /.box-header -->
            <div class="box-body">

              <table id="tabla_usuario" name="tabla_usuario" class="table table-bordered table-striped display"  >
                <thead>
                <tr>
                  <th>Nombres</th>
                  <th>Email</th>
                  <th>Ultima Conexi&oacute;n(es)</th>
                  <th>Privilegios</th>
                  <th>Acciones</th>
                </tr>
                </thead>
                <tbody>
				<?
				define("_controlador_", 'cAdmin.php');
				include_once("../include/conexion.php");
				$conn=conectar();

				$consulta=$conn->query("SELECT coidUsuario, coNomUsuario, coEmailUsuario, coPrivilegiosUsuario, coUltimaLog FROM tb_usuario");
				while($resultado=$consulta->fetch_assoc()){
				?>
				<tr>
                  <td><?=$resultado['coNomUsuario'];?></td>
                  <td><?=$resultado['coEmailUsuario'];?></td>
                  <th><?=fecha_formato_espanol_hora($resultado['coUltimaLog']); ?></th>
                  <td><? switch ($resultado['coPrivilegiosUsuario']) {
					  case 'admin': echo 'Administrador'; break;
					  case 'super': echo 'Super Usuario'; break;
					  case 'digi': echo 'Digitador'; break;
				  }
				    ?></td>
                  <td><a href="javascript:void(0)" onclick="cargaFormulario(<?= $resultado['coidUsuario']; ?>,'<?= basename($_SERVER['PHP_SELF']) ?>', 4)">
                    <div id="editar" class="btn-group btn-group-toggle" data-toggle="buttons">
                    <label class="btn btn-primary">
                        <!-- <input type="" name="options"  autocomplete="off" checked> -->
                        <span class="fa fa-pencil"></span>
                    </label>
                </a>
                <a href="javascript:void(0)" onclick="eliminararchivos('eliminar-usuario',<?=$resultado['coidUsuario']; ?>,'<?=_controlador_ ?>')">
                    <label class="btn btn-danger">
                    <!-- <input type="radio" name="options" autocomplete="off" > -->
                    <span class="fa fa-trash"></span>
                    </label> 
                </a></td>
				</tr>
				<?} ?>
                </tbody>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
				<!-- /.box-body -->
				<!--  <div class="box-footer">
					Footer
				</div> -->
				<!-- /.box-footer-->
				</div>
				<!-- /.box -->

			</section>
			</div>
		</div>
		<!-- <script src="js/controller/admin.js"></script> -->
		<!-- /.content -->
		<!-- <script src="js/jquery.dataTables.min.js"></script> -->
		<script type="text/javascript" src="../cliente/js/controller/admin.js"></script>
		<!-- <script src="js/dataTables.bootstrap.min.js"></script> -->
		<script  src="../cliente/js/jquery.dataTables.min.js"></script>
		<script src="../cliente/js/notifications.min.js"></script>
		
		 <script>
			$(document).ready( function() {
				/* MK Web Notification init */
				var config = {
					// Default, Primary, Success, Danger, Warning, Info, Light, Dark, Purple
					positionY: "left",
					positionX: "top",
					scrollable: false, //true
					rtl: false, // true = ltr
					max: 5, // number of notifications to display,
					dismissable: true
				};
				mkNotifications(config);
				
			}); 
		</script>
		
<?}
function tabla_actividad(){?>
	<section class="content-header">
		<h1>
			Administrador
			<small>Control de Usuarios</small>
		</h1>
		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
			<li><a href="#">Usuarios</a></li>
			<li class="active">Tabla Usuarios</li>
		</ol>
		</section>
		<div class="row">
			<div class="col-md-12">
			
			<!-- Main content -->
			<section class="content">

				<!-- Default box -->
				<div class="box">
				<!-- <div class="box-header">
					<h3 class="box-title">Todos los Usuarios</h3>
				<div class="box"> -->
					<div class="box-header">
              			<h3 class="box-title">Tabla de Usuarios del Sistema</h3>
            		</div>							
            <!-- /.box-header -->
            <div class="box-body">

              <table id="tabla_usuario" name="tabla_usuario" class="table table-bordered table-striped display"  >
                <thead>
                <tr>
                  <th>Registro Accion</th>
                  <th>Usuario</th>
                  <th>Fecha Moficiacion</th>
                  <th>Privilegios</th>
                </tr>
                </thead>
                <tbody>
				<?
				include_once("../include/conexion.php");
				$conn=conectar();

				$consulta=$conn->query("SELECT t1.coidActividad, t1.coAccion, t1.coFecha, t2.coNomUsuario, t2.coPrivilegiosUsuario FROM tb_actividad AS t1 INNER JOIN tb_usuario as t2 ON t1.db_usuarios_id_usuarios = t2.coidUsuario");
				while($resultado=$consulta->fetch_assoc()){
				?>
				<tr>
                  <td><?=$resultado['coAccion'];?></td>
                  <td><?=$resultado['coNomUsuario'];?></td>
                  <th><?=fecha_formato_espanol_hora($resultado['coFecha']); ?></th>
                  <td><?switch ($resultado['coPrivilegiosUsuario']) {
					  case 'admin':
					  echo 'Administrador';
					  break;
					  case 'super':
					  echo 'Super Usuario';
					  break;
					  case 'digi':
					  echo 'Digitador';
					  break;
					}
				?></td>
				</tr>
				<?} ?>
                </tbody>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
				<!-- /.box-body -->
				<!--  <div class="box-footer">
					Footer
				</div> -->
				<!-- /.box-footer-->
				</div>
				<!-- /.box -->

			</section>
			</div>
		</div>
		<!-- <script src="js/controller/admin.js"></script> -->
		<!-- /.content -->
		<!-- <script src="js/jquery.dataTables.min.js"></script> -->
		<script type="text/javascript" src="../cliente/js/controller/admin.js"></script>
		<!-- <script src="js/dataTables.bootstrap.min.js"></script> -->
		<script  src="../cliente/js/jquery.dataTables.min.js"></script>
<?}

function todo_contenido(){?>
<section class="content-header">
		<h1>
			Administrador 
			<small>Contenido Web</small>
		</h1>
		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
			<li><a href="#">Usuarios</a></li>
			<li class="active">Tabla Contenido del Frontis</li>
		</ol>
		</section>
		<div class="row">
			<div class="col-md-12">
			
			<!-- Main content -->
			<section class="content">

				<!-- Default box -->
				<div class="box">
				<!-- <div class="box-header">
					<h3 class="box-title">Todos los Usuarios</h3>
				<div class="box"> -->
					<div class="box-header">
              			<h3 class="box-title">Tabla de Contenido que Muestra en Frontis</h3>
            		</div>							
            <!-- /.box-header -->
            <div class="box-body">
<?
define("_controlador_", 'cContenido.php');
include_once("../include/conexion.php");
$conn = conectar();

$consulta = $conn->query("SELECT coidContenido, coTitulo, coComuna, tb_usuario_coidUsuario, cofechaCreacion FROM tb_contenido");
?>
              <table id="tabla_imagenes" name="tabla_imagenes" class="table table-bordered table-striped display"  >
                <thead>
                <tr>
                  <th>ID</th>
									<th>Titulo</th>
                  <th>Comuna</th>
                  <th>Usuario</th>
                  <th>Fecha Creacion</th>
                  <th>Acciones</th>
                </tr>
                </thead>
                <tbody>
				<?
			
			while ($resultado = $consulta->fetch_assoc()) {
				$reqComuna= $conn->query("SELECT coidComuna, coNomComuna FROM tb_comuna WHERE coidComuna='".$resultado['coComuna']."'");
				
				$resComuna = $reqComuna->fetch_array();
				
				$reqUsuario = $conn->query("SELECT coidUsuario, coNomUsuario FROM tb_usuario WHERE coidUsuario='" . $resultado['tb_usuario_coidUsuario'] . "'");
				$resUsuario = $reqUsuario->fetch_array();
			
				?>
				<tr>
                  <td><?=$resultado['coidContenido']; ?></td>
                  <td><?=utf8_encode($resultado['coTitulo']); ?></td>
									<td><?= $resComuna['coNomComuna']; ?></td>
									<td><?= $resUsuario['coNomUsuario']; ?></td>
                  <th><?=fecha_formato_espanol_hora($resultado['cofechaCreacion']); ?></th>
                  <td><a href="javascript:void(0)" onclick="cargaFormulario(<?=$resultado['coidContenido']; ?>,'<?= basename($_SERVER['PHP_SELF']) ?>', 2)">
                    <div id="editar" class="btn-group btn-group-toggle" data-toggle="buttons">
                    <label class="btn btn-primary">
                        <!-- <input type="" name="options"  autocomplete="off" checked> -->
                        <span class="fa fa-pencil"></span>
                    </label>
                </a>
                <a href="javascript:void(0)" onclick="eliminararchivos('eliminar-contenido',<?= $resultado['coidContenido']; ?>,'<?= _controlador_ ?>')">
                    <label class="btn btn-danger">
                    <!-- <input type="radio" name="options" autocomplete="off" > -->
                    <span class="fa fa-trash"></span>
                    </label> 
                </a></td>
				</tr>
				<?
		} ?>
                </tbody>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
				<!-- /.box-body -->
				<!--  <div class="box-footer">
					Footer
				</div> -->
				<!-- /.box-footer-->
				</div>
				<!-- /.box -->

			</section>
			</div>
		</div>
		<!-- <script src="js/controller/admin.js"></script> -->
		<!-- /.content -->
		<!-- <script src="js/jquery.dataTables.min.js"></script> -->
		<script type="text/javascript" src="../cliente/js/controller/contenido.js"></script>
		<!-- <script src="js/dataTables.bootstrap.min.js"></script> -->
		<script src="../cliente/js/notifications.min.js"></script>
		<script  src="../cliente/js/jquery.dataTables.min.js"></script>
		
		 <script>
			$(document).ready( function() {
				/* MK Web Notification init */
				var config = {
					// Default, Primary, Success, Danger, Warning, Info, Light, Dark, Purple
					positionY: "left",
					positionX: "top",
					scrollable: false, //true
					rtl: false, // true = ltr
					max: 5, // number of notifications to display,
					dismissable: true
				};
				mkNotifications(config);
				
			}); 
		</script>
<?}
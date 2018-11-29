<?
error_reporting(E_ALL & ~E_NOTICE);
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
    <section class="content-header">
      <h1>
        Principal
        <small>Subtitulo de la web</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Examples</a></li>
        <li class="active">Blank page</li>
      </ol>
    </section>
    <div class="row">
        <div class="col-md-8">
        
          <!-- Main content -->
          <section class="content">

            <!-- Default box -->
            <div class="box">
             	<div class="box-header with-border">
                	<h3 class="box-title">Titulo</h3>

			 	</div>
			</div>
            <!-- /.box -->

          </section>
         </div>
    </div>
    <!-- /.content -->
<?}


function formulario_contenido(){?>
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
			<div class="col-md-10">
				<!-- Main content -->
				<section class="content">

				<!-- Default box -->
				<div class="box">
					<div class="box-header with-border">
					<h3 class="box-title">Formulario de Contenido</h3>

					<!-- <div class="box-tools pull-right">
						<button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
								title="Collapse">
						<i class="fa fa-minus"></i></button>
						<button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
						<i class="fa fa-times"></i></button>
					</div>
					</div> -->
					<div class="box-body">
					<form role="form">
						<div class="box-body">
							<div class="form-group">
							<label for="txtTitulo">Titulo</label>
							<input type="text" class="form-control" id="txtTitulo" placeholder=" ">
							</div>
							<div class="form-group">
							<label for="txtDetalles">Detalles</label>
							<input type="text" class="form-control" id="txtDetalles" placeholder="">
							</div>
							<div class="form-group">
							<label for="txtValor">Valor</label>
							<input type="text" class="form-control" id="txtValor" placeholder="">
							</div>
							<div class="form-group">
							<label for="exampleInputFile">File input</label>
							<input type="file" id="exampleInputFile">

							<p class="help-block">Example block-level help text here.</p>
							</div>
							<div class="checkbox">
							<label>
								<input type="checkbox"> Check me out
							</label>
							</div>
						</div>
						<!-- /.box-body -->

						<div class="box-footer">
							<button type="submit" class="btn btn-primary">Submit</button>
						</div>
						</form>
					
					</div>
					<!-- /.box-body -->
					<div class="box-footer">
					Footer
					</div>
					<!-- /.box-footer-->
				</div>
				<!-- /.box -->
			</div>
		</div>

		</section>
		<!-- /.content -->
<?}

/**FUNCION PARA ABRIR EL ADMINISTRADOR DE CONTENIDO */
function admin_contenido(){

}

/* CONTROL DE USUARIOS Y CREACION */
function agregar_admin(){
	$opcion="crear-usuario";
	$boton="Crear Nuevo Usuario";
	$id=$_POST['id'];
	if($id>0){
		//echo "area de actualizar usuario";
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
									<input type="text" class="form-control" id="txtEmail" name="txtEmail" placeholder="Ingrese Email de Usuario" <?if($id>0){?>value="<?=$datos['coEmailUsuario'];?>"<?}?>>
								</div>
								<div class="form-group">
									<label for="tipoUsuario" class="small">Orden en el Menú</label>
									<select class="form-control" name="tipoUsuario" id="tipoUsuario" >
									<option value="admin">Administrador</option>
									<option value="digi">Digitador</option>
									<option value="super">Super Usuario</option>
									</select>
								</div>
								
								<div class="form-group">
									<label for="txtClave">Contraseña:</label>
									<input type="password"  pattern=".{6,}"  autocomplete="new-password"  class="form-control" id="txtClave" name="txtClave" placeholder="Clave para la Session" <?if($id>0){?>value=""<?}?>>
								</div>
								
								
							<div class="box-footer">
							<input type="hidden" name="opcion" <?if($id==0){?>value="<?echo $opcion;}else{echo $opcion;};?>">
							<? if($id > 0){ ?>
							<input type="hidden" name="id_usuario" value="<?=$datos['coidUsuario'];?>">
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

		<script src="js/controller/admin.js"></script>
		<script src="js/notifications.min.js"></script>
		
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
		<script type="text/javascript" src="js/controller/admin.js"></script>
		<!-- <script src="js/dataTables.bootstrap.min.js"></script> -->
		<script  src="js/jquery.dataTables.min.js"></script>
		<script src="js/notifications.min.js"></script>
		
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
		<script type="text/javascript" src="js/controller/admin.js"></script>
		<!-- <script src="js/dataTables.bootstrap.min.js"></script> -->
		<script  src="js/jquery.dataTables.min.js"></script>
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
			$conn = conectar();

			$consulta = $conn->query("SELECT coidUsuario, coNomUsuario, coEmailUsuario, coPrivilegiosUsuario, coUltimaLog FROM tb_usuario");
			while ($resultado = $consulta->fetch_assoc()) {
				?>
				<tr>
                  <td><?= $resultado['coNomUsuario']; ?></td>
                  <td><?= $resultado['coEmailUsuario']; ?></td>
                  <th><?= fecha_formato_espanol_hora($resultado['coUltimaLog']); ?></th>
                  <td><? switch ($resultado['coPrivilegiosUsuario']) {
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
                  <td><a href="javascript:void(0)" onclick="cargaFormulario(<?= $resultado['coidUsuario']; ?>,'<?= basename($_SERVER['PHP_SELF']) ?>', 4)">
                    <div id="editar" class="btn-group btn-group-toggle" data-toggle="buttons">
                    <label class="btn btn-primary">
                        <!-- <input type="" name="options"  autocomplete="off" checked> -->
                        <span class="fa fa-pencil"></span>
                    </label>
                </a>
                <a href="javascript:void(0)" onclick="eliminararchivos('eliminar-usuario',<?= $resultado['coidUsuario']; ?>,'<?= _controlador_ ?>')">
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
		<script type="text/javascript" src="js/controller/admin.js"></script>
		<!-- <script src="js/dataTables.bootstrap.min.js"></script> -->
		<script  src="js/jquery.dataTables.min.js"></script>
		<script src="js/notifications.min.js"></script>
		
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
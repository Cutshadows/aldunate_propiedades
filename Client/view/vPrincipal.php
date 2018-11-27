<?
error_reporting(E_ALL & ~E_NOTICE);
$router=$_POST['ruta'];
switch ($router) {
    case 1:inicio();exit;
    case 2:formulario_contenido();exit;
    case 3:cargar_contenido();exit;
    case 4:agregar_admin();exit;
	case 5:tabla_admin();exit;
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
			Pagina en Blanco
			<small>Subtitulo de la web</small>
		</h1>
		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
			<li><a href="#">Examples</a></li>
			<li class="active">Blank page</li>
		</ol>
		</section>

		<!-- Main content -->
		<section class="content">

		<!-- Default box -->
		<div class="box">
			<div class="box-header with-border">
			<h3 class="box-title">Tabla del Contenido</h3>

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
					<label for="exampleInputEmail1">Email address</label>
					<input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
					</div>
					<div class="form-group">
					<label for="exampleInputPassword1">Password</label>
					<input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
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

		</section>
		<!-- /.content -->
<?}

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
									<input type="text" class="form-control" id="txtNomUsuario" name="txtNomUsuario" placeholder="Ingrese Nombre de Usuario" <?if($id>0){?>value="<?=$datos['coNomUsuario'];?>"<?}?>>
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
								<?if($id==0){?>
								<div class="form-group">
									<label for="txtClave">Contraseña:</label>
									<input   class="form-control" id="txtClave" name="txtClave" placeholder="Clave para la Session" >
								</div>
								<?}?>
								
							<div class="box-footer">
							<input type="hidden" name="opcion" <?if($id==0){?>value="<?echo $opcion;}else{echo $opcion;};?>">
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
                  <td><?=$resultado['coUltimaLog']; ?></td>
                  <td><?= $resultado['coPrivilegiosUsuario']; ?></td>
                  <td><a href="javascript:void(0)" onclick="cargaFormulario(<?= $resultado['coidUsuario']; ?>,'<?= basename($_SERVER['PHP_SELF']) ?>', 4)">
                    <div id="editar" class="btn-group btn-group-toggle" data-toggle="buttons">
                    <label class="btn btn-primary">
                        <!-- <input type="" name="options"  autocomplete="off" checked> -->
                        <span class="fa fa-pencil"></span>
                    </label>
                </a>
                <a href="javascript:void(0)" onclick="eliminararchivos('eliminar-usuario',<?= $resultado['coidUsuario']; ?>,'<?=_controlador_ ?>')">
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
		
<?}
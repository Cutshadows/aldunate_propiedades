<?
error_reporting(E_ALL & ~E_NOTICE);
include_once('../include/conexion.php');
$conn=conectar();

        $boton="Checkear Email";
        $opcion="recuperar-password";
		
    ?>
    <!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Aldunate | Login Admin</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="./cliente/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="./cliente/fonts/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="./cliente/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="./cliente/css/AdminLTE.min.css">
  <link rel="stylesheet" href="./cliente/css/notifications.min.css">

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition register-page">
<div>
  <div class="register-logo">
    <a href="./administrador"><b>Admin</b>Aldunate</a>
  </div>

  <section class="content-header">
		<h1>
			Recuperar Contraseña
			<small>Control de Contraseñas</small>
		</h1>
		</section>
		<div class="row">
			<div class="col-md-12">
            
			
			<!-- Main content -->
			<section class="content">

				<!-- Default box -->
				<div class="box">
				<div class="box-header with-border">
					<h3 class="box-title">Recuperar Clave Usuario</h3>
					<div class="box-body">
						<form id="form-usuarios">
							<div class="box-body">
								<div class="form-group">
									<label for="txtEmail">Email Usuario:</label>
									<input type="text" class="form-control" autocomplete="off"  id="txtEmail" name="txtEmail" placeholder="Ingrese Email de Usuario" <?if($id>0){?>value="<?=$datos['coEmailUsuario'];?>" readonly <?}?>>
								</div>
								
							<div class="box-footer">
							<input type="hidden" name="opcion" id="opcion" value="<?if($id==0){echo $opcion;}else{echo $opcion;}?>">
								<button type="submit" class="btn-block btn-block-sm btn btn-primary"><?if($id==0){echo $boton;}else{ echo $boton;}?></button>
                            </div>
                            
                        </form>
                        <div class="alert alert-danger alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <h4><i class="icon fa fa-ban"></i> Alert!</h4>
                            Danger alert preview. This alert is dismissable. A wonderful serenity has taken possession of my entire
                            soul, like these sweet mornings of spring which I enjoy with my whole heart.
                        </div>
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


   

  </div>
  <!-- /.form-box -->
</div>
<!-- /.register-box -->
<script src="./cliente/js/controller/login.js"></script>    
<script src="./cliente/js/notifications.min.js"></script>

<!-- jQuery 3 -->
<script src="./cliente/js/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="./cliente/js/bootstrap.min.js"></script>
<!-- iCheck -->
<!-- <script src="../../plugins/iCheck/icheck.min.js"></script> -->
<script>
$(document).ready(function() {
    /* MK Web Notification init */
    var config = {
        // Default, Primary, Success, Danger, Warning, Info, Light, Dark, Purple
        positionY: "left",        
        positionX:"top",
        scrollable: false,//true
        rtl: false, // true = ltr
        max: 5, // number of notifications to display,
        dismissable: true
    };

    mkNotifications(config);

      /* $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%'
    }); */
}); 
</script>
</body>
</html>
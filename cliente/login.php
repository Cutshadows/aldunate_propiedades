<? session_start();
if (isset($_GET['cerrar_sesion'])) {
  unset($_SESSION['nombre']);
  session_destroy();
  header("location:../../administrador");
}
   

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
<div class="register-box">
  <div class="register-logo">
    <a href="../index.php"><b>Admin</b>Aldunate</a>
  </div>

  <div class="register-box-body">
    <p class="login-box-msg">Iniciar Sesion para entrar al Adminsitrador</p>

    <form id="form-login" name="form-login" method="post">
      <div class="form-group has-feedback">
        <input type="text" class="form-control" id="txtUsuario" name="txtUsuario" placeholder="Email">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" id="txtClave" name="txtClave" placeholder="Password">
        <span class="fa fa-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-8">
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
           <input type="hidden" id="tipo" name="tipo" value="login">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Login</button>
        </div>
        <!-- /.col -->
      </div>
    </form>

   

    <a href="javascript:void(0)" onclick="window.open('seguiridad', 'blank')" class="text-center">¿Olvido la Contraseña?</a>
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

<?
try {
  include_once('include/conexion.php');
  $conn = conectar();
} catch (Exception $e) {
  $error = $e->getMessage();
}
if (isset($_SESSION['login']) && $_SESSION['login'] == true) {
?>
<? include_once 'templates/header.php';?>

<body class="hold-transition skin-blue sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">

  <?include_once 'templates/menu.php';?>

  <!-- =============================================== -->

 <?include_once 'templates/navegacion.php';?>

  <!-- =============================================== -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" id="contenido-aldunate" name="contenido-aldunate">

    <!-- Content Header (Page header) -->
    



  </div>
  <!-- /.content-wrapper -->

 

 <?include_once 'templates/footer.php';?>

<?
} else {
  //echo "Esta pagina es solo para usuarios registrados.<br>";
  ?>
  <script>
    alert("Acceso Restringido!! Solo Usuarios del sistema");
    setTimeout(function(){window.location.href ='login.php';}, 1800);
  </script>
  <?
    //header("Location: login.php");
  exit;
}
/*$now = time();

if($now > $_SESSION['expire']) {
  session_destroy();

  echo "Su sesion a terminado";
exit;
}*/


?>

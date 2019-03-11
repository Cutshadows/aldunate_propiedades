<?include_once('../include/conexion.php');
$conn = conectar();



"SELECT * FROM tb_contenido WHERE coidContenido LIKE '%4000%' or coTitulo LIKE '%4000%' or coDescripcion LIKE '%4000%' or coComuna LIKE '%4000%' or coDireccion LIKE '%4000%' or coDetalles LIKE '%4000%' or coPrecioCLP LIKE '%4000%' or coPreciouF LIKE '%4000%' or tb_usuario_coidUsuario LIKE '%4000%' or cofechaCreacion LIKE '%4000%' or coestadoContenido LIKE '%4000%' ORDER BY coidContenido";
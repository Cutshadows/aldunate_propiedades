<?include_once('../include/conexion.php');
$conn = conectar();

$opcion = htmlspecialchars($_POST['opcion']);
if (isset($opcion) || trim($opcion)) {
    switch ($opcion) {
        case 'crear-contenido':
            crearContenido();
            exit;
        case 'editar-contenido':
            editarContenido();
            exit;
        case 'eliminar-contenido':
            eliminarContenido();
            exit;
    }
}

define("_pathfile_", "/");

function crearContenido(){
    include_once('../include/conexion.php');
    $conn = conectar();

    $imgs=$_FILES['imagenes'];

    die(json_encode($_POST));

}
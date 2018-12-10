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

    define("_imagen_", "../img/contenido/");
    $img = $_FILES['imagenes'];
    $directorio = _imagen_;
    $carpeta = 'contenido';

    if (!is_dir($directorio) && !file_exists($carpeta)) {
        mkdir($directorio, 0755, true);
        shell_exec('chcon -R -t httpd_sys_rw_content_t ' . $directorio);
    }
    
    
    if (move_uploaded_file($img['tmp_name'], $directorio . $img['name'])) {
        $imagen_url = $img['name'];
        $imagen_resultado = "Se subio correctamente";
    } else {
        $respuesta = array(
            'respuesta' => error_get_last()
        );
    }

    die(json_encode($respuesta));

}
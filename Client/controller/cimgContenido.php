<? 
include_once('../include/conexion.php');
$conn = conectar();


$opcion = $_POST['tipo'];

if(isset($opcion) && $opcion=='editar-imagen'){
    /* echo $opcion; */
    $imagen = $_FILES['imagenes'];
    $idimg = $_POST['id'];
    $id=$_POST['id_registro'];

    /* echo $idimg; */

    define("_imagen_", "../../img/contenido/");
    $directorio = _imagen_;
    $carpeta = 'contenido';

    if (!is_dir($directorio) && !file_exists($carpeta)) {
        mkdir($directorio, 0755, true);
        shell_exec('chcon -R -t httpd_sys_rw_content_t ' . $directorio);
    }

    if (move_uploaded_file($_FILES['imagenes']['tmp_name'], $directorio . $_FILES['imagenes']['name'])) {
        $imagen_url = $_FILES['imagenes']['name'];
        $imagen_resultado = "Se subio correctamente";
    } else {
        $respuesta = array(
            'respuesta' => error_get_last()
        );
    }
    $tipoimg='normal';
    $stmt = $conn->prepare("UPDATE tb_imagenes SET coNomimg=?, tb_usuario_coidUsuario=?, cotipoImg=? WHERE tb_contenido_coidContenido=? AND coidImagen=?");
    $stmt->bind_param("sisii", $imagen_url, $_SESSION["id_usuario"], $tipoimg, $id, $idimg);
    $stmt->execute();
    if ($stmt->affected_rows > 0) {
        $resultado = array(
            'respuesta' => 'exito',
            'img_actualizado' => $imagen_resultado,
            'registro'=>$id
        );
    }
    die(json_encode($resultado));

}



/* if (isset($opcion) || trim($opcion)) {
    switch ($opcion) {
        case 'editar-imagen':
            editarImagen();
            exit;
    }
} */

/* function editarImagen()
{ */
    
    
    /*  */
/* } */
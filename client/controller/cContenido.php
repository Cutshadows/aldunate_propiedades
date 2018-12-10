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

    define("_imagen_", "../img/contenido/");
   
        if(isset($_FILES['imagenes'])){


            for ($x=0; $x <count($_FILES['imagenes']) ; $x++) { 
                # code...
            
                $img = $_FILES['imagenes'];
                
                $directorio = _imagen_;
                $carpeta = 'contenido';

                 $nombre = $img["name"][$x];
                 $tipo = $img["type"][$x];
                 $ruta_provisional = $img["tmp_name"][$x];
                 $size = $img["size"][$x];
                 $dimensiones = getimagesize($ruta_provisional);
                 $width = $dimensiones[0];
                 $height = $dimensiones[1];

                
                if (!is_dir($directorio) && !file_exists($carpeta)) {
                    mkdir($directorio, 0755, true);
                    shell_exec('chcon -R -t httpd_sys_rw_content_t ' . $directorio);
                }
                if (move_uploaded_file($ruta_provisional, $directorio . $nombre)) {
                    $imagen_url = $nombre;
                    $imagen_resultado = "Se subio correctamente";
                } else {
                    $respuesta = array(
                        'respuesta' => error_get_last(),
                        'nombre' => $nombre,
                        'tipo' => $tipo,
                        'ruta_tmp'=>$ruta_provisional,
                        "tamano"=>$size
                    );
                }
            }
        
        } else {
            $respuesta = array(
                'respuesta' => "el archivo esta vacio"
            );
        }
            
    
        die(json_encode($respuesta));
        

}

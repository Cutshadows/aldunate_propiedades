<? 
include_once('../include/conexion.php');
$conn = conectar();

die(json_encode($_POST));
$opcion = $_POST['tipo'];

if(isset($opcion)){
    echo $opcion;
    $imagen = $_FILES['imagenes'];
    $idimg = $_POST['id'];

    echo $idimg;
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
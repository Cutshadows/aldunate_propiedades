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
echo $type = $_FILES['imagenes']['type'];
echo $tmp_name = $_FILES['imagenes']["tmp_name"];
echo $name = $_FILES['imagenes']["name"];

define("_pathfile_", "/");

function crearContenido(){
    include_once('../include/conexion.php');
    $conn = conectar();

        if(isset($_FILES['cnombreimg'])){
            $titulo=$_POST['txtTitulo'];
            $descripcion = $_POST['txtdescripcion'];
            $valorClp = $_POST['txtValor'];
            $valorUf = $_POST['txtvaluf'];
            $detalles = $_POST['txtDetalles'];
            $Comuna = $_POST['slctComuna'];
            /* $titulo = $_POST['txtDetalles'];
            $titulo=$_POST['txtDetalles'];
            $titulo=$_POST['txtDetalles'];*/
            $targetDir = "../img/contenido/";
            $allowTypes = array('jpg', 'png', 'jpeg', 'gif');

            $images_arr = array();

            foreach ($_FILES['cnombreimg']['name'] as $key => $value) {
                $name = $_FILES['cnombreimg']['name'][$key];
                $tmp_name = $_FILES['cnombreimg']['tmp_name'][$key];
                $size = $_FILES['cnombreimg']['size'][$key];
                $type = $_FILES['cnombreimg']['type'][$key];
                $error = $_FILES['cnombreimg']['error'][$key];
        # code...

                $fileName = basename($_FILES['cnombreimg']['name'][$key]);
                $targetFilePath = $targetDir . $fileName;

                $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
                if (in_array($fileType, $allowTypes)) {
                    if (move_uploaded_file($_FILES['cnombreimg']['tmp_name'][$key], $targetFilePath)) {
                        $images_arr[] = $targetFilePath;
                    }
                }
            }
            
            $respuesta = array(
                'respuesta' => "exito"
            );

        
        } else {
            $respuesta = array(
                'respuesta' => "vacio"
            );
        }
            
    
        die(json_encode($_POST));
        

}

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

        if(isset($_FILES['cnombreimg'])){
            $titulo= htmlspecialchars($_POST['txtTitulo']);
            $descripcion = htmlspecialchars($_POST['txtdescripcion']);
            $valorClp = htmlspecialchars($_POST['txtValor']);
            $valorUf = htmlspecialchars($_POST['txtvaluf']);
            $direccion = htmlspecialchars($_POST['txtDireccion']);
            $Comuna = $_POST['slctComuna'];
            $hora = date("H:i:s");
            //CHECKBOX BAÑOS
            $chkbanos = (bool)filter_input(INPUT_POST, 'chkboxBanos', FILTER_VALIDATE_BOOLEAN);
            //echo "cpublicado estado es :". $publicado;
            if ($chkbanos == true) {
                $banos = 1;
            } else {
                $banos = 0;
            }
            $txtBanos=$_POST['txtBanos'];
             $cadenaBano=array('bano'=> $banos, 'cantidad'=> $txtBanos);
            echo var_dump($cadenaBano);
            
            //CHECKBOX PISO
            $chkpiso = (bool)filter_input(INPUT_POST, 'chkboxPiso', FILTER_VALIDATE_BOOLEAN);
                //echo "cpublicado estado es :". $publicado;
            if ($chkpiso == true) {
                $piso = 1;
            } else {
                $piso = 0;
            }
            $txtPiso = $_POST['txtPiso'];
            $cadenaPiso = array('bano' => $piso, 'cantidad' => $txtPiso);
            echo var_dump($cadenaPiso);
            //CHECKBOX OFICINAS
            $chkoficina = (bool)filter_input(INPUT_POST, 'chkboxOficinas', FILTER_VALIDATE_BOOLEAN);
                //echo "cpublicado estado es :". $publicado;
            if ($chkoficina == true) {
                $oficina = 1;
            } else {
                $oficina = 0;
            }
            $txtOficina = $_POST['txtOficinas'];
            $cadenaOficina = array('bano' => $oficina, 'cantidad' => $txtOficina);
            echo var_dump($cadenaOficina);

            //CHechbox Estacionamientos
            $chkoEstacionamiento = (bool)filter_input(INPUT_POST, 'chkboxEstacion', FILTER_VALIDATE_BOOLEAN);
                //echo "cpublicado estado es :". $publicado;
            if ($chkoEstacionamiento == true) {
                $estacionamiento = 1;
            } else {
                $estacionamiento = 0;
            }

            
            /* die(json_encode($_POST)); */
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
            
            $fecha = fecha_formato_base_gore(date("Y-m-d")) . " " . $hora;
            
            $cadenaCheckbox = '{"contenido":' . $titulo . '," bano ":' . $cadenaBano . '," pisos ":' . $cadenaPiso . '," oficina ":" ' . $cadenaOficina . ' "," estacionamiento ":" ' . $estacionamiento . ' "}';

            $conn->begin_transaction();
            $stmt = $conn->prepare("INSERT INTO db_contenido (coTitulo, coDescripcion, coComuna, coDireccion, coDetalles, coPrecioCLP, coPreciouF, tb_usuarios_coidUsuario, coFechaCreacion) VALUES(?,?,?,?,?,?,?,?,?)");
            //$stmt->bind_param("sssssss", $cadenaUpdateCabecera, $textInfo, $tituloInfo, $alias, fecha_formato_base_gore($cfecha)." ".$hora, $publicado, $_SESSION['id_usuario']);
            $stmt->bind_param("sssssiiis", $titulo, $descripcion, $Comuna, $direccion, $cadenaCheckbox, $valorClp, $valorUf, $_SESSION['id_usuario'], $fecha);
            
            $stmt->execute();
            
            
            
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

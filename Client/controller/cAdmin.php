<?
include_once('../include/conexion.php');
$conn = conectar();

$opcion = htmlspecialchars($_POST['opcion']);
if (isset($opcion) || trim($opcion)) {
    switch ($opcion) {
        case 'crear-usuario':
            crearUsuario();
            exit;
        case 'editar-usuario':
            editarUsuario();
            exit;
        case 'eliminar-usuario':
            eliminarUsuario();
            exit;
    }
}

function crearUsuario(){
    try {
        include_once('../include/conexion.php');
        $conn = conectar();

        $nomUser = htmlspecialchars($_POST['txtNomUsuario']);
        $emailUser = htmlspecialchars($_POST['txtEmail']);
        $passwordUser = htmlspecialchars($_POST['txtClave']);
        $tipoUsuario = htmlspecialchars($_POST['tipoUsuario']);
        
        $fecha=date('Y-m-d H:m:s');
        //echo $fecha;
        //die(json_encode($_POST));
        //hash para la clave
        $opciones = array(
            'cost' => 12
        );
        $hash_password = password_hash($passwordUser, PASSWORD_BCRYPT, $opciones);
        //importar la conexion*/
        //echo $hash_password;
        //die(json_encode($_POST));
        
        $conn->begin_transaction();
        $stmt = $conn->prepare("INSERT INTO tb_usuario(coNomUsuario, coEmailUsuario, coPrivilegiosUsuario, coClaveUsuario, coUltimaLog) VALUES(?,?,?,?,?)");
        
        $stmt->bind_param("sssss", $nomUser, $emailUser, $tipoUsuario, $hash_password, $fecha);
        
        

        $stmt->execute();
		
		//$id_registro=$stmt->insert_id;
        $id_registro = $stmt->insert_id;

        if ($stmt->affected_rows) {
            $respuesta = array(
                'respuesta' => 'exito',
                'registro' => $id_registro
            );
            /*  $stmt = $conn->prepare("INSERT INTO db_bk_contenido (db_miniSitios_id_minisitios, db_menu_web_id_menu, db_noticias_id_noticias) VALUES(?,?,?)");
            $stmt->bind_param("iii", $_SESSION["SitiosPer"], $menu, $id_registro);
            $stmt->execute();
            if ($stmt->affected_rows) {
                $resultado = array(
                    'respuesta' => 'exito'
                );
            } */
            //reg_acciones(1, "Nuevo Registro, Boleta Agua Potable Rural (" . $boleta . ")", 1, $id_registro);
        } else {
            $respuesta = array(
                'respuesta' => 'Error'
            );
        }

        $conn->commit();
        $stmt->close();
        $conn->close();

    } catch (Exception $e) {
        $conn->rollBack();
        echo "Error: " . $e->getMessage();

    }
    die(json_encode($respuesta));
}

function editarUsuario(){

}
function eliminarUsuario(){
    
}
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
            reg_acciones("Registro de Usuario (" . $nomUser . "), con Privilegios de :". $tipoUsuario ."",1, $id_registro);
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
    try {
        
        include_once('../include/conexion.php');
        $conn = conectar();

        $nomUser = htmlspecialchars($_POST['txtNomUsuario']);
        $emailUser = htmlspecialchars($_POST['txtEmail']);
        $tipoUsuario = htmlspecialchars($_POST['tipoUsuario']);
        $claveUsuario= htmlspecialchars($_POST['txtClave']);
        $id=htmlspecialchars($_POST['id_usuario']);

        $opciones = array(
            'cost' => 12
        );
        $hash_password = password_hash($claveUsuario, PASSWORD_BCRYPT, $opciones);

        $conn->begin_transaction();
        $stmt = $conn->prepare("UPDATE tb_usuario SET coNomUsuario= ?, coEmailUsuario= ?, coPrivilegiosUsuario= ?, coClaveUsuario=? WHERE coidUsuario= ?");
        
		//$stmt->bind_param("sssssss", $cadenaUpdateCabecera, $textInfo, $tituloInfo, $alias, fecha_formato_base_gore($cfecha)." ".$hora, $publicado, $_SESSION['id_usuario']);
        $stmt->bind_param("ssssi", $nomUser, $emailUser, $tipoUsuario, $hash_password, $id);

        $stmt->execute();
		
		//$id_registro=$stmt->insert_id;
            //$id_registro = $stmt->insert_id;

        if ($stmt->affected_rows > 0) {
            $respuesta = array(
                'respuesta' => 'exito',
                'registro' => $nomUser,
                'tipo' => $tipoUsuario
            );
            /*  $stmt = $conn->prepare("INSERT INTO db_bk_contenido (db_miniSitios_id_minisitios, db_menu_web_id_menu, db_noticias_id_noticias) VALUES(?,?,?)");
            $stmt->bind_param("iii", $_SESSION["SitiosPer"], $menu, $id_registro);
            $stmt->execute();
            if ($stmt->affected_rows) {
                $resultado = array(
                    'respuesta' => 'exito'
                );
            } */
            reg_acciones("Actualizacion de Usuario(" . $nomUser . "), con Privilegios de : ".  $tipoUsuario . " ", 2, $id_registro);
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
function eliminarUsuario(){
    try {
        include_once('../include/conexion.php');
        $conn = conectar();


        $id = $_POST['id_registro'];
        $destino = 'vPrincipal.php';

        $conn->begin_transaction();
        $stmt = $conn->prepare("DELETE FROM tb_usuario WHERE coidUsuario=?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        if ($stmt->affected_rows > 0) {
            $respuesta = array(
                'respuesta' => 'exito',
                'id_eliminado' => $id,
                'destino' => $destino
            );
        } else {
            $respuesta = array(
                'respuesta' => 'Error'
            );
        }
        reg_acciones("Eliminar Usuario Exitosamente.", 3, $id);
        $conn->commit();
        $stmt->close();
        $conn->close();

    } catch (Exception $e) {
        $conn->rollBack();
        echo "Error: " . $e->getMessage();
    }
    die(json_encode($respuesta));
}
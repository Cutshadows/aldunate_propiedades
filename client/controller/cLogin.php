<?
include_once('../include/conexion.php');
$conn = conectar();

$usuario = htmlspecialchars($_POST['usuario']);
$clave = htmlspecialchars($_POST['clave']);
$accion = htmlspecialchars($_POST['accion']);


if($accion === 'login') {
    try{
        //seleccionar el adrministrador de la base de datos
        include_once('../include/conexion.php');
        $conn = conectar();
        $stmt = $conn->prepare("SELECT coidUsuario, coNomUsuario, coPrivilegiosUsuario, coClaveUsuario, coUltimaLog FROM tb_usuario WHERE  coEmailUsuario =? ");
        $stmt->bind_param('s', $usuario);
        $stmt->execute();
        //loagear al usuario
        $stmt->bind_result($idUsuario, $nombreUsuario, $Privilegios, $claveUsuario, $ultimoLog);
        $stmt->fetch();

        if ($nombreUsuario) {
            if (password_verify($clave, $claveUsuario)) {
                  //if($clave == $claveUsuario){
                    //iniciar Session

                ultimologin($idUsuario);
                 //session_start();
                $_SESSION['id_usuario'] = $idUsuario;
                $_SESSION['usuario'] = ucfirst($nombreUsuario);
                $_SESSION['ultimolog'] = $ultimoLog;
                $_SESSION['privilegios'] = $Privilegios;
                $_SESSION['login'] = true;
                $_SESSION['start'] = time();
                $_SESSION['expire'] = $_SESSION['start'] + (10 * 60);

                                        //login correcto
                $respuesta = array(
                    'respuesta' => 'correcto',
                    'usuario' => $nombreUsuario,
                    'tipo' => $accion
                );

            } else {
                    //login incorrecto enviar error
                $respuesta = array(
                    'resultado' => 'error '
                );
            }

        } else {
            $respuesta = array(
                'resultado' => 'error'
            );
        }

        $stmt->close();
        $conn->close();

    } catch (Exception $e) {
         // En caso de un error, tomar la exepcion
        $respuesta = array(
            'pass' => $e->getMessage()
        );
    }
    echo json_encode($respuesta);
}

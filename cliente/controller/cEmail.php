<?
include_once('../include/conexion.php');
$conn = conectar();

$email = htmlspecialchars($_POST['email']);
$opcion = htmlspecialchars($_POST['opcion']);

if($opcion=='email-validar'){
  try {
    include_once('../include/conexion.php');
        $conn = conectar();
        $stmt = $conn->prepare("SELECT coNomUsuario, coEmailUsuario, token FROM tb_usuario WHERE  coEmailUsuario =?");
        $stmt->bind_param('s', $email);
        $stmt->execute();
        //loagear al usuario
        $stmt->bind_result($nombreUsuario, $emailUsuario, $token);
        $stmt->fetch();

        if ($nombreUsuario) {
          $codigohtml = '
          <html xmlns="http://www.w3.org/1999/xhtml">
          <head>
          <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
          </head>
          <body>
          <div>
          Estimad@ '.$nombreUsuario.', Su clave de Acceso es '.$token.' ;. 
          </div>
          <div><br />
          </div>
          <div>Este link se hará visible para Ud. al utilizar los siguientes datos:</div>
          <div><br />
          </div>
          <div><strong>usuario: '.$emailUsuario.'</strong></div>
          <div><strong>clave: '.$token.' </strong></div>
          <div><strong><br />
          </strong></div>
          <div><strong>Se le recuerda que estos datos (Usuario y Clave) son personales e intransferibles y el uso de ellos es de su responsabilidad. </strong></div>
          <div><br />
          </div>
          <div>Para cualquier consulta puede dirigirse al Celular +56 9 77568094  o al correo <a href="mailto:juliaaldunateg@gmail.com" target="_blank">juliaaldunateg@gmail.com</a>.  Atte., </div>
          </body>
          </html>
          ';
          
          $email = $emailUsuario;
          $asunto = 'Acceso a sistema de Administracion Aldunate Propiedades';
          // Para enviar un correo HTML mail, la cabecera Content-type debe fijarse
          $cabeceras  = 'MIME-Version: 1.0' . "\r\n";
          $cabeceras .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
          
          // Cabeceras adicionales
          $cabeceras .= 'To: '.$nombreUsuario.' <'.$emailUsuario.'>' . "\r\n";
          $cabeceras .= 'From: Acceso a Sistemas Administracion <_mainaccount@propiedadesaldunate.cl>' . "\r\n";
  //				$cabeceras .= 'Bcc: mesadeayuda@laserena.cl' . "\r\n";
          
          mail($email,$asunto,$codigohtml,$cabeceras);

                $respuesta = array(
                    'respuesta' => 'enviado',
                    'usuario' => $nombreUsuario,
                    'codigo' => 200
                );

            

        } else {
            $respuesta = array(
                'resultado' => 'error',
                'codigo'=>404
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
}
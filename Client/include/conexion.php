<?session_start();
define("DB_HOST", "localhost");
define("DB_USER", "root");
define("DB_PASS", "Q1a2z3w4S5croot");
define("DB_NAME", "bdaldunate");
define('DB_CHARSET', 'utf-8');
date_default_timezone_set('America/Santiago');

function conectar()
{
    $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS);
    mysqli_select_db($conn, DB_NAME);

    if ($conn->connect_error) {
        echo $error = $conn->connect_error;

    }
    return $conn;
}


function ultimologin($idUsuario)
{
    try {
        $conn = conectar();
        $sql = ("UPDATE tb_usuario SET coUltimaLog=NOW() WHERE coidUsuario=" . $idUsuario . "");
        $stmt = $conn->prepare($sql);
   // execute the query
        $stmt->execute();
    // echo a message to say the UPDATE succeeded
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
    $stmt->close();
    $conn->close();
}

function fecha_formato_espanol($fecha)
{
    $ano = substr($fecha, 0, 4);
    $mes = substr($fecha, 5, 2);
    $dia = substr($fecha, 8, 2);
    $fecha = "$dia/$mes/$ano";
    return ($fecha);
}

function fecha_formato_espanol_gore($fecha)
{
    $ano = substr($fecha, 0, 4);
    $mes = substr($fecha, 5, 2);
    $dia = substr($fecha, 8, 2);
    $fecha = "$dia/$mes/$ano";
    return ($fecha);
}

function fecha_formato_base($fecha)
{
    $ano = substr($fecha, 6, 4);
    $mes = substr($fecha, 3, 2);
    $dia = substr($fecha, 0, 2);
    $fecha = "$ano/$mes/$dia";
    return ($fecha);
}
function fecha_formato_base_gore($fecha)
{
    $ano = substr($fecha, 6, 4);
    $mes = substr($fecha, 3, 2);
    $dia = substr($fecha, 0, 2);
    $fecha = "$ano-$mes-$dia";
    return ($fecha);
}

function fecha_formato_espanol_hora($fecha)
{
    $ano = substr($fecha, 0, 4);
    $mes = substr($fecha, 5, 2);
    $dia = substr($fecha, 8, 2);
    $hora = substr($fecha, 10);
    $fecha = "$dia/$mes/$ano $hora";
    return ($fecha);
}
function fecha_formato_base_hora($fecha)
{
    $ano = substr($fecha, 6, 4);
    $mes = substr($fecha, 6, 2);
    $dia = substr($fecha, 0, 2);
    $hora = substr($fecha, 10);
    $fecha = "$ano-$mes-$dia $hora";
    return ($fecha);
}
function mes($mesi)
{
    $mesi = $mesi - 1;
    $mes[0] = "Enero";
    $mes[6] = "Julio";
    $mes[1] = "Febrero";
    $mes[7] = "Agosto";
    $mes[2] = "Marzo";
    $mes[8] = "Setiembre";
    $mes[3] = "Abril";
    $mes[9] = "Octubre";
    $mes[4] = "Mayo";
    $mes[10] = "Noviembre";
    $mes[5] = "Junio";
    $mes[11] = "Diciembre";

    return $mes[$mesi];
}
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

function reg_acciones($accion, $tipo, $id)
{
    try {
        $conn = conectar();
        $fecha = date("Y-m-d H:i:s");
        $q = "INSERT INTO `tb_actividad` SET `db_usuarios_id_usuarios`=" . $_SESSION["id_usuario"] . ",`coAccion`='" . $accion . "',`coFecha`='" . $fecha . "',`coTipo`=" . $tipo . ", coId=" . $id . ";";
        $stmt = $conn->prepare($q);
        $stmt->execute();
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


function time_passed($get_timestamp)
{
        $timestamp = strtotime($get_timestamp);
        $diff = time() - (int)$timestamp;

        if ($diff == 0) 
             return 'justo ahora';

        if ($diff > 604800)
 
            return  date("d m Y",$timestamp);

        $intervals = array
        (
            //1                   => array('año',    31556926),
           // $diff < 31556926    => array('mes',   2628000),
           // $diff < 2629744     => array('semana',    604800),
            $diff < 604800      => array('día',     86400),
            $diff < 86400       => array('hora',    3600),
            $diff < 3600        => array('minuto',  60),
            $diff < 60          => array('segundo',  1)
        );

        $value = floor($diff/$intervals[1][1]);
        return 'hace '.$value.' '.$intervals[1][0].($value > 1 ? 's' : '');
}




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

function miles($valor){
    if ($valor){ 
        $digitos = strlen($valor); 
                    // primero separamos los numeros 
            switch ($digitos){
                    case 6: 
                            $num1 = substr($valor, 0, 1); 
                            $num2 = substr($valor, 1, 1); 
                            $num3 = substr($valor, 2, 1); 
                            $num4 = substr($valor, 3, 1); 
                            $num5 = substr($valor, 4, 1); 
                            $num6 = substr($valor, 5, 1); 
                        return 	$num1.$num2.$num3.'.'.$num4.$num5.$num6;
                    break; 
                    case 7: 
                            $num =''; 
                            $num1 = substr($valor, 0, 1); 
                            $num2 = substr($valor, 1, 1); 
                            $num3 = substr($valor, 2, 1); 
                            $num4 = substr($valor, 3, 1); 
                            $num5 = substr($valor, 4, 1); 
                            $num6 = substr($valor, 5, 1); 
                            $num7 = substr($valor, 6, 1);
                            $num8 = substr($valor, 7, 1);
                        return 	$num1.".".$num2.$num3.$num4.".".$num5.$num6.$num7;
                    break;   
                    case 8: 
                            $num = substr($valor, 0, 1);     
                            $num1 = substr ($valor, 1, 1); 
                            $num2 = substr ($valor, 2, 1); 
                            $num3 = substr ($valor, 3, 1); 
                            $num4 = substr ($valor, 4, 1); 
                            $num5 = substr ($valor, 5, 1); 
                            $num6 = substr ($valor, 6, 1); 
                            $num7 = substr ($valor, 7, 1); 
                        return 	$num.$num1.".".$num2.$num3.$num4.".".$num5.$num6.$num7;
                     break;
                     case 9: 
                            $num = substr($valor, 0, 1);     
                            $num1 = substr ($valor, 1, 1); 
                            $num2 = substr ($valor, 2, 1); 
                            $num3 = substr ($valor, 3, 1); 
                            $num4 = substr ($valor, 4, 1); 
                            $num5 = substr ($valor, 5, 1); 
                            $num6 = substr ($valor, 6, 1); 
                            $num7 = substr ($valor, 7, 1); 
                            $num8 = substr ($valor, 8, 1);
                        return 	$num.$num1.$num2.".".$num3.$num4.$num5.".".$num6.$num7.$num8;
                     break;
                     case 10: 
                            $num = substr($valor, 0, 1);     
                            $num1 = substr ($valor, 1, 1); 
                            $num2 = substr ($valor, 2, 1); 
                            $num3 = substr ($valor, 3, 1); 
                            $num4 = substr ($valor, 4, 1); 
                            $num5 = substr ($valor, 5, 1); 
                            $num6 = substr ($valor, 6, 1); 
                            $num7 = substr ($valor, 7, 1); 
                            $num8 = substr ($valor, 8, 1);
                            $num9 = substr ($valor, 9, 1);
                        return 	$num.'.'.$num1.$num2.$num3.".".$num4.$num5.$num6.".".$num7.$num8.$num9;
                     break;
                    case 10: 
                            $num = substr($valor, 0, 1);     
                            $num1 = substr ($valor, 1, 1); 
                            $num2 = substr ($valor, 2, 1); 
                            $num3 = substr ($valor, 3, 1); 
                            $num4 = substr ($valor, 4, 1); 
                            $num5 = substr ($valor, 5, 1); 
                            $num6 = substr ($valor, 6, 1); 
                            $num7 = substr ($valor, 7, 1); 
                            $num8 = substr ($valor, 8, 1);
                            $num9 = substr ($valor, 9, 1);
                            $num10 = substr ($valor, 10, 1);
                        return 	$num.$num1.'.'.$num2.$num3.$num4.'.'.$num5.$num6.$num7.".".$num8.$num9.$num10;
                    break;  
            } 
    }
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

//función que escribe la IP del cliente en un archivo de texto    

function write_visita (){
    $counter=0;
    //Indicar ruta de archivo válida
    $archivo="cliente/view/visitas.txt";

    //Si que quiere ignorar la propia IP escribirla aquí, esto se podría automatizar
    $ip="172.16.1.224";
    $new_ip=get_client_ip();
   
    if ($new_ip!==$ip){
        $now = new DateTime();

   //Distinguir el tipo de petición, 
   // tiene importancia en mi contexto pero no es obligatorio

    if (!$_GET) {
        //$datos="*POST: ".$_POST;
        foreach ($_POST as $key => $value) {
            $datos="*POST: ".$value;
            
        }
        $counter++;
    } 
    else
    {
        $counter++;
        //Saber a qué URL se accede
        $peticion = explode('/', $_GET['PATH_INFO']);
        $datos=str_pad($peticion[0],10).' '.$peticion[1];   
    }
   /*  try {
        $conn = conectar();
        $info=ip_info($new_ip, "City")." ".json_decode($datos);
        $fechaHora=$now->format('Y-m-d H:i:s');
        $sql = ("INSERT tb_visita SET ip='$new_ip', fechahora_visita='$fechaHora', accion='$info'");
        $stmt = $conn->prepare($sql);
   // execute the query
        $stmt->execute();
    // echo a message to say the UPDATE succeeded
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
    $stmt->close();
    $conn->close(); */
    /* $txt =  str_pad($counter,25). " ".
            str_pad($new_ip,25). " ".
            str_pad($now->format('Y-m-d H:i:s'),25)." ".
            str_pad(ip_info($new_ip, "Country"),25)." ".json_decode($datos);
    
    

    $myfile = file_put_contents($archivo, $txt.PHP_EOL , FILE_APPEND); */
    }
    
}


//Obtiene la IP del cliente
function get_client_ip() {
    $ipaddress = '';
    if (getenv('HTTP_CLIENT_IP'))
        $ipaddress = getenv('HTTP_CLIENT_IP');
    else if(getenv('HTTP_X_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
    else if(getenv('HTTP_X_FORWARDED'))
        $ipaddress = getenv('HTTP_X_FORWARDED');
    else if(getenv('HTTP_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_FORWARDED_FOR');
    else if(getenv('HTTP_FORWARDED'))
       $ipaddress = getenv('HTTP_FORWARDED');
    else if(getenv('REMOTE_ADDR'))
        $ipaddress = getenv('REMOTE_ADDR');
    else
        $ipaddress = 'UNKNOWN';
    return $ipaddress;
}


//Obtiene la info de la IP del cliente desde geoplugin

function ip_info($ip = NULL, $purpose = "location", $deep_detect = TRUE) {
    $output = NULL;
    if (filter_var($ip, FILTER_VALIDATE_IP) === FALSE) {
        $ip = $_SERVER["REMOTE_ADDR"];
        if ($deep_detect) {
            if (filter_var(@$_SERVER['HTTP_X_FORWARDED_FOR'], FILTER_VALIDATE_IP))
                $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
            if (filter_var(@$_SERVER['HTTP_CLIENT_IP'], FILTER_VALIDATE_IP))
                $ip = $_SERVER['HTTP_CLIENT_IP'];
        }
    }
    $purpose    = str_replace(array("name", "\n", "\t", " ", "-", "_"), NULL, strtolower(trim($purpose)));
    $support    = array("country", "countrycode", "state", "region", "city", "location", "address");
    $continents = array(
        "AF" => "Africa",
        "AN" => "Antarctica",
        "AS" => "Asia",
        "EU" => "Europe",
        "OC" => "Australia (Oceania)",
        "NA" => "North America",
        "SA" => "South America"
    );
    if (filter_var($ip, FILTER_VALIDATE_IP) && in_array($purpose, $support)) {
        $ipdat = @json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip=" . $ip));
        if (@strlen(trim($ipdat->geoplugin_countryCode)) == 2) {
            switch ($purpose) {
                case "location":
                    $output = array(
                        "city"           => @$ipdat->geoplugin_city,
                        "state"          => @$ipdat->geoplugin_regionName,
                        "country"        => @$ipdat->geoplugin_countryName,
                        "country_code"   => @$ipdat->geoplugin_countryCode,
                        "continent"      => @$continents[strtoupper($ipdat->geoplugin_continentCode)],
                        "continent_code" => @$ipdat->geoplugin_continentCode
                    );
                    break;
                case "address":
                    $address = array($ipdat->geoplugin_countryName);
                    if (@strlen($ipdat->geoplugin_regionName) >= 1)
                        $address[] = $ipdat->geoplugin_regionName;
                    if (@strlen($ipdat->geoplugin_city) >= 1)
                        $address[] = $ipdat->geoplugin_city;
                    $output = implode(", ", array_reverse($address));
                    break;
                case "city":
                    $output = @$ipdat->geoplugin_city;
                    break;
                case "state":
                    $output = @$ipdat->geoplugin_regionName;
                    break;
                case "region":
                    $output = @$ipdat->geoplugin_regionName;
                    break;
                case "country":
                    $output = @$ipdat->geoplugin_countryName;
                    break;
                case "countrycode":
                    $output = @$ipdat->geoplugin_countryCode;
                    break;
            }
        }
    }
    return $output;
}

function specialChar($frase){
    $string=trim($frase);
    $string=str_replace(
        array('Ñ','ñ','á','Á','é','É','í','Í','ó','Ó','ú','Ú'), 
        array('&Ntilde;','&ntilde;','&aacute;','&Aacute;','&eacute;','&Eacute;','&iacute;','&Iacute;','&oacute;','&Oacute;','&uacute;','&Uacute;'),
        $string);
    return $string;
}
function specialCharReverse($frase){
    $string=trim($frase);
    $string=str_replace(
        array('&Ntilde;','&ntilde;','&aacute;','&Aacute;','&eacute;','&Eacute;','&iacute;','&Iacute;','&oacute;','&Oacute;','&uacute;','&Uacute;'),
        array('Ñ','ñ','á','Á','é','É','í','Í','ó','Ó','ú','Ú'), 
        $string);
    return $string;
}



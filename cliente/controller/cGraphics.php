<?
$opcion=htmlspecialchars($_POST['opcion']);

switch ($opcion) {
    case 'ultimo-siete':
        semanalFunction();
        break;
    case 'ultimo-mes':
        mensualFunction();
    break;
    case 'grafico-torta':
        tortaFuncion();
    break;
}


function semanalFunction(){
    include_once('../include/conexion.php');
    $conn = conectar();     
    try {
        //code...
    $consulta=$conn->query("SELECT DISTINCT date_format(fechahora_visita, '%Y-%m-%d') as Fecha, COUNT(id_visita) as VISITAS
    FROM tb_visita
    WHERE fechahora_visita BETWEEN DATE_SUB(CURDATE(),INTERVAL 7 DAY)  AND CURDATE()+1
   GROUP BY Fecha DESC");
    while($resultados=$consulta->fetch_assoc()){
        $respuesta[]=array(
            "codigo"=>200,
            "fecha"=>$resultados['Fecha'],
            "visitas"=>$resultados['VISITAS']
        );
    }

    } catch (Exception $e) {
        //$conn->rollBack();
        echo "Error: " . $e->getMessage();
    }
    die(json_encode($respuesta));
}

function mensualFunction(){
    include_once('../include/conexion.php');
    $conn = conectar();     
    try {
        //code...
    $consulta=$conn->query("SELECT DISTINCT date_format(fechahora_visita, '%Y-%m') as Fecha, COUNT(id_visita) as VISITAS
    FROM tb_visita
    WHERE fechahora_visita BETWEEN DATE_SUB(CURDATE(),INTERVAL 7 MONTH)  AND CURDATE()+1
   GROUP BY Fecha DESC");
    while($resultados=$consulta->fetch_assoc()){
        $respuesta[]=array(
            "codigo"=>200,
            "fecha"=>$resultados['Fecha'],
            "visitas"=>$resultados['VISITAS']
        );
    }

    } catch (Exception $e) {
        //$conn->rollBack();
        echo "Error: " . $e->getMessage();
    }
    die(json_encode($respuesta));
}

function tortaFuncion(){
    include_once('../include/conexion.php');
    $conn = conectar();     
    try {
        //code...
    $consulta=$conn->query("SELECT date_format(fechahora_visita, '%Y-%m-%d') as Fecha, COUNT(id_visita) as VISITAS, ciudad 
    FROM tb_visita 
    WHERE fechahora_visita > DATE_SUB(NOW(), INTERVAL  6 MONTH) 
    GROUP BY ciudad DESC");
    while($resultados=$consulta->fetch_assoc()){
        
        $respuesta[]=array(
            "label"=>$resultados['ciudad'],
            "value"=>$resultados['VISITAS']
        );
    }

    } catch (Exception $e) {
        //$conn->rollBack();
        echo "Error: " . $e->getMessage();
    }
    die(json_encode($respuesta));
}
<?include_once('../include/conexion.php');
$conn = conectar();

$opcion=htmlspecialchars($_POST['opcion']);
if($opcion=="activar-filtro"){
    $txtBusqueda=$_POST['busqueda'];
    $comuna=($_POST['slctComuna']!='0')? " or coComuna LIKE '%".$_POST['slctComuna']."%'":'';
    $tipoContenido=($_POST['tipoContenido']!='0')? " or coestadoContenido LIKE  '%".$_POST['tipoContenido']."%'":'';
    $tipoEstructura=$_POST['tipoEstructura'];
    $rango_inicio=$_POST['valSlid1'];
    $rango_final=$_POST['valSlid2'];
    if($rango_inicio!='' && $rango_final!=''){
        $consultaRango=" or coPrecioCLP BETWEEN '$rango_inicio' AND '$rango_final'";
        if($rango_final=='2000000'){
            $consultaRango=" or coPrecioCLP >='$rango_final'";
        }
    }
    //$WHERE="WHERE coTitulo LIKE '%$txtBusqueda%' or coDescripcion LIKE '%$txtBusqueda%' or coComuna LIKE '%$comuna%' or coestadoContenido LIKE '%$tipoContenido%' or coDireccion LIKE '%$txtBusqueda%' or coPrecioCLP LIKE '%$txtBusqueda%' or coPreciouF LIKE '%$txtBusqueda%'";
    echo "SELECT coidContenido, coTitulo, coDescripcion, coComuna, coDireccion, cofechaCreacion, coestadoContenido, coPrecioCLP FROM tb_contenido WHERE coTitulo LIKE '%$txtBusqueda%' or coDescripcion LIKE '%$txtBusqueda%' or coDireccion LIKE '%$txtBusqueda%' $comuna $tipoContenido $consultaRango ORDER BY coidContenido ASC LIMIT 6";


    $consulta=$conn->query("SELECT coidContenido, coTitulo, coDescripcion, coComuna, coDireccion, cofechaCreacion, coestadoContenido FROM tb_contenido WHERE coTitulo LIKE '%$txtBusqueda%' or coDescripcion LIKE '%$txtBusqueda%' or coDireccion LIKE '%$txtBusqueda%' $comuna $tipoContenido $consultaRango ORDER BY coidContenido ASC LIMIT 6");

    
    $temp='<div class="album py-5 bg-light"  >'.
                '<div class="container" >'.
                    '<div class="row" >';
    
        
    while($resultados=$consulta->fetch_assoc()){
        $idContenido=$resultados['coidContenido'];
        $fechaCrecion=$resultados['cofechaCreacion'];

        $consultaImg=$conn->query("SELECT coNomimg, tb_contenido_coidContenido FROM tb_imagenes WHERE tb_contenido_coidContenido='".$resultados['coidContenido']."' AND cotipoImg='principal' ORDER BY tb_contenido_coidContenido ASC");
        $Imagen=$consultaImg->fetch_assoc();
         $temp.='<div class="col-md-4">'.
                    '<div class="card mb-4 shadow-sm">'.
                        '<img class="card-img-top" src="img/contenido/'.$Imagen['coNomimg'].'" alt="Thumbnail [100%x225]" style="height: 225px; width: 100%; display: block;" data-holder-rendered="true">'. 
                        '<div class="card-body">'.
                            '<p class="card-text">'.
                                $resultados['coDescripcion'].
                            '</p>'.
                            '<div class="d-flex justify-content-between align-items-center">'.
                                '<div class="btn-group">'.
                                    '<a href="javascript:void(0)" onclick="cargaFormulario('.$idContenido.',\'detalles.php\')"><button type="button" class="btn btn-sm btn-outline-primary">Detalles</button></a>'.
                                    '<button type="button" class="btn btn-sm btn-outline-primary" onclick="clipboard(3, '.$idContenido.')">Compartir</button>'.
                                '</div>'.

                            '</div>'.
                            '<div class="d-flex justify-content-between align-items-center">'.
                                '<small class="label text-muted">'.
                                    'Publicado '.time_passed($fechaCrecion).'</small>'.
                            '</div>'.
                        '</div>'.
                    '</div>'.
                '</div>';
        
        
    }
    $temp.='</div></div></div>';
    echo $temp;
}

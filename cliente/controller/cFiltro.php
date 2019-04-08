<?include_once('../include/conexion.php');
$conn = conectar();

$opcion=htmlspecialchars($_POST['opcion']);
if($opcion=="activar-filtro"){
    $txtBusqueda=$_POST['busqueda'];
    $comuna=$_POST['slctComuna'];
    $tipoContenido=$_POST['tipoContenido'];
    $tipoEstructura=$_POST['tipoEstructura'];
    $temp='<div class="album py-5 bg-light"  >'.
                '<div class="container" >'.
                    '<div class="row" >';
    $consulta=$conn->query("SELECT coidContenido, coTitulo, coDescripcion, coComuna, coDireccion, cofechaCreacion FROM tb_contenido WHERE coTitulo LIKE '%$txtBusqueda%' or coDescripcion LIKE '%$txtBusqueda%' or coComuna LIKE '%$comuna%' or coDireccion LIKE '%$txtBusqueda%' or coPrecioCLP LIKE '%$txtBusqueda%' or coPreciouF LIKE '%$txtBusqueda%' ORDER BY coidContenido ASC");
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

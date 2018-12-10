$(document).ready(function(){
/**
      * AQUI EMPIEZA LA INTERACCION CON EL TEXTAREA
      */
     var cont = 0;// se inicia el contador para el control de ingreso de horarios solo pueden 3 
     //implementamos la funcion en el boton que agregara los campos en el horario
    $("#btnAddImg").click(function () {
    //$("#constructor-imagen").on('click', 'button.btn-success', function () {
        if (cont < 7) {                 
            mkNoti(
                'Alerta de Notificación',
                'Se Agrego un cuadro para Imagen exitosamente',
                {
                    status: 'info',
                    duration: 2000
                }
            );
            /* var num = Math.round(Math.random()*(100)); */ // - 5) + 5;    
            var tempInfo = '<div class="row"><div class="col-md-6"><div class="form-group"><div class="input-group"><input type="file" class="form-control" name="cnombreimg[]" id="cnombreimg" /><!-- input type="hidden" name="imgbd" id="imgdb" value="<?=//$imgStandar?>"--></div></div></div><div class="col-md-4 pull-left"><button type="button" class="btn btn-success col-md-2 pull-left" style="margin: 0px 2px" id="btnAddImg" name="btnAddImg"><span class="fa fa-plus"  aria-hidden="true"></span></button><button type="button" class="btn btn-danger col-md-2 pull-left" style="margin: 0px 2px" id="btnSupInfo" name="btnSupInfo"><span class="fa fa-trash" aria-hidden="true"></span></button></div></div>';
            $("#constructor-imagen").append(tempInfo);
           /*  $('textarea').each(function () {
                tinymce.execCommand('mceAddEditor', false, $(this).attr('id'));
            }); */
            cont++;
        } else {
            mkNoti(
                'Alerta de Notificación',
                'Ya no se pueden Agregar mas Cuadros para Imagen',
                {
                    status: 'warning',
                    duration: 2000
                }
            );
        } 
            
    });
    $("#constructor-imagen").on('click', 'button.btn-success', function () {
        //$("#constructor-imagen").on('click', 'button.btn-success', function () {
        if (cont < 7) {
            mkNoti(
                'Alerta de Notificación',
                'Se Agrego Cuadro para Imagen exitosamente', {
                    status: 'info',
                    duration: 2000
                }
            );
            /* var num = Math.round(Math.random() * (100)); */ // - 5) + 5;    
            var tempInfo = '<div class="row"><div class="col-md-6"><div class="form-group"><div class="input-group"><input type="file" class="form-control" name="cnombreimg[]" id="cnombreimg" /><!--input type="hidden" name="imgbd" id="imgdb" value="<?=//$imgStandar?>"--></div></div></div><div class="col-md-4 pull-left"><button type="button" class="btn btn-success col-md-2 pull-left" style="margin: 0px 2px" id="btnAddImg" name="btnAddImg"><span class="fa fa-plus"  aria-hidden="true"></span></button><button type="button" class="btn btn-danger col-md-2 pull-left" style="margin: 0px 2px" id="btnSupInfo" name="btnSupInfo"><span class="fa fa-trash" aria-hidden="true"></span></button></div></div>';
            $("#constructor-imagen").append(tempInfo);
            /* $('textarea').each(function () {
                tinymce.execCommand('mceAddEditor', false, $(this).attr('id'));
            }); */
            cont++;
        } else {
            mkNoti(
                'Alerta de Notificación',
                'Ya no se pueden Agregar mas Cuadros para Imagen', {
                    status: 'warning',
                    duration: 2000
                }
            );
        }

    });
    $("#constructor-imagen").on('click', 'button.btn-danger', function () {
        var contenedor = $(this).closest('div[id*="constructor-"]').attr('id');
        var textoNombre = contenedor.split("data-");
        /* swal({
            title: '¿Desea elimninar esta Fila ?',
            text: "Verifique bien antes de eliminar la fila !",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, Eliminar Fila!',
            cancelButtonText: 'No, Cancelar'
        }).then((result) => { */
            /* if (result.value) { */
                if ($("#" + contenedor).find('.row').length > 1 || contenedor == "constructor-imagen") {
                    $(this).closest('.row').remove(); // ELIMINA LA FILA DEL REGISRO.
                    cont--;
                } else {
                    mkNoti(
                        'Alerta de Notificación',
                        'No se puede eliminar todos los "' + textoNombre[1] + '", siempre debe existir un registro',
                        {
                            status: 'warning',
                            duration: 3000
                        }
                    );
                    // console.log("no se puede eliminar todos los "+textoNombre[1]+", siempre debe existir un registro");
                }
            /*  }*/
            /* } else if (result.dismiss === swal.DismissReason.cancel) {
                swal(
                    'Cancelado',
                    'La Fila no ah sido Eliminada!',
                    'error'
                )
            }
        });*/
    });
    //FUNCION PARA PROCESAR EL FORMULARIO DE INGRESO
    $("#form-contenido").on("submit", function (e) {
        //$("#btnNuevoContenido").on("click", function (e) {        
        e.preventDefault();

        /* var imagenesjson=[];
        var jsonimg=''; */

        /* $.each($('#constructor-imagen').find('.row'), function (index, div) {
            var imagen = $(div).find('input[type="file"]')[0];
            jsonimg ={
                imagen:$(imagen).val()
            };
            imagenesjson.push(jsonimg);
            console.log(jsonimg);
            console.log(imagenesjson);
        
        }); */

        /* var infoimg = JSON.stringify(imagenesjson); */
        //console.log(infoimg);
        var files = $('#cnombreimg')[0].files;

        var form = $(this);
        var formData = new FormData();
        var params = form.serializeArray();
        formData.append("imagenes", files[0]);
        /* formData.append("imagenes", infoimg); */
        $(params).each(function (index, element) {
            formData.append(element.name, element.value);
        });
        var datos = formData;
        $.ajax({
            url: 'controller/cContenido.php',
            type: 'POST',
            dataType: 'JSON',
            cache: false,
            contentType: false,
            processData: false,
            async: true,
            data: datos,
            success: function (data) {
                //console.log(data);
                var resultado = data;
                console.log(resultado);
                /* if (resultado.respuesta == 'exito') { */
                    //llamamos a la notificacion para que se muestre en el escritorio con su body y url 
                    mkNoti(
                        'Alerta de Notificación',
                        'Contenido Ingresado Correctamente', {
                            status: 'success',
                            duration: 3000
                        }
                    );
                    /* notificar(resultado.texto, resultado.alias); */
                    /* setTimeout(function () {
                        verContenedor('vContenido.php');
                    }, 1800); */
                
                /* } */

            },
            error: function (data) {
                console.log(data);
                mkNoti(
                    'Alerta de Notificación',
                    'Error en el Ingreso de Datos', {
                        status: 'warning',
                        duration: 3000
                    }
                );
            }
        });
    });
});
$(document).ready(function(){
    
      /**
      * AQUI EMPIEZA LA INTERACCION CON EL TEXTAREA
      */
     $('#cnombreimg').on('change', function(){
        $('constructor-imagen').html('');
        var archivos =document.getElementById('cnombreimg').files;
        var navegador= window.URL || window.webkitURL;
        /* recorrer archivos*/
        for(x=0; x<archivos.length; x++){
            /* validar tamaño y tipo de archiv*/
            var size=archivos[x].size,
            type= archivos[x].type,
            name=archivos[x].name;
            if (size > 720000 * 720000) {
                mkNoti(
                    'Alerta de Notificación',
                    'El archivo'+name+'No puede superar los 5 mb',
                    {
                        status: 'danger',
                        duration: 3000
                    }
                );
            } else if (type != 'image/jpeg' && type != 'image/jpg' && type != 'image/png' && type != 'image/gif'){
                mkNoti(
                    'Alerta de Notificación',
                    'El archivo' + name + 'No es del tipo de imagen permitida',
                    {
                        status: 'danger',
                        duration: 3000
                    }
                );
            }else{
                var objeto_url=navegador.createObjectURL(archivos[x]);
                $("#constructor-imagen").append("<img src="+objeto_url+" width='180px' height='180px'>");
            }
        }

     });

    //Solo permite introducir numeros.
    $('.txtnumber').on('input',function () {
        this.value = this.value.replace(/[^0-9]/g, '');
    });

    $('#chkboxBanos').change(function () {
        if ($(this).prop('checked') == true) {
            /* $('#console-event').html('Toggle: ' + $(this).prop('checked')); */
            /* console.log('estado Baños:' + $("#chkboxBanos").prop('checked')); */
            $("#txtBanos").removeAttr('disabled');
        } else if (($(this).prop('checked') == false)) {
            /* $('#console-event').html('Toggle: ' + $(this).prop('checked')); */
            /* console.log('estado Baños:' + $("#chkboxBanos").prop('checked')); */
            $("#txtBanos").attr('disabled', 'disabled');
            $("#txtBanos").val('');
            
        }
    });
    $('#chkboxPiso').change(function () {
        if ($(this).prop('checked') == true) {
            /* $('#console-event').html('Toggle: ' + $(this).prop('checked')); */
            /* console.log('estado Pisos:' + $("#chkboxPiso").prop('checked')); */
            $("#txtPiso").removeAttr('disabled');
        } else if (($(this).prop('checked') == false)) {
            /* $('#console-event').html('Toggle: ' + $(this).prop('checked')); */
            /* console.log('estado Pisos:' + $("#chkboxPiso").prop('checked')); */
            $("#txtPiso").attr('disabled', 'disabled');
            $("#txtPiso").val('');

        }
    });
    $('#chkboxOficinas').change(function () {
        if ($(this).prop('checked') == true) {
            /* $('#console-event').html('Toggle: ' + $(this).prop('checked')); */
            /* console.log('estado Oficinas:' + $("#chkboxOficinas").prop('checked')); */
            $("#txtOficinas").removeAttr('disabled');
        } else if (($(this).prop('checked') == false)) {
            /* $('#console-event').html('Toggle: ' + $(this).prop('checked')); */
            /* console.log('estado Oficinas:' + $("#chkboxOficinas").prop('checked')); */
            $("#txtOficinas").attr('disabled', 'disabled');
            $("#txtOficinas").val('');

        }
    });
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
        /* var files = $('#cnombreimg')[0].files;

        var form = $(this);
        var formData = new FormData();
        var params = form.serializeArray();
        formData.append("imagenes", files[0]);
       
        $(params).each(function (index, element) {
            formData.append(element.name, element.value);
        });
        var datos = formData; */
        $.ajax({
            url: 'controller/cContenido.php',
            type: 'POST',
            dataType: 'JSON',
            cache: false,
            contentType: false,
            processData: false,
            async: true,
            data: new FormData(this),
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
                setTimeout(function () {
                    verContenedor('vPrincipal.php', 3);
                }, 1800);
            },
            error: function (data) {
                console.log(data);
                mkNoti(
                    'Alerta de Notificación',
                    'Se Creo el contenido Con Detalles', {
                        status: 'warning',
                        duration: 3000
                    }
                );
            }
        });
    });
});


function uploadImage(idimg, idContenido){
    
    var img = $("#imgEditar"+idimg)[0].files;
    var formData = new FormData();
    formData.append("imagenes", img[0]);
    formData.append("id", idimg);
    formData.append("id_registro", idContenido);
    formData.append("tipo", 'editar-imagen');
    

   var datos = formData;
    $.ajax({
        url: 'controller/cimgContenido.php',
        /* type: 'POST', */
        method: 'POST',
        dataType: 'JSON',
        cache: false,
        contentType: false,
        processData: false,
        /* async: true, */ 
        data: datos,
        success: function (data) {
            //console.log(data);
            var resultado = data;
            /* console.log(resultado); */
            /* if (resultado.respuesta == 'exito') { */
            //llamamos a la notificacion para que se muestre en el escritorio con su body y url 
            mkNoti(
                'Alerta de Notificación',
                'Contenido Actualizado Correctamente', {
                    status: 'success',
                    duration: 3000
                }
            );
            /* notificar(resultado.texto, resultado.alias); */
            setTimeout(function () {
                cargaFormulario(resultado.registro, 'vPrincipal.php', 2);
            }, 1800);

            /* } */

        },
        error: function (data) {
            /* console.log(data); */
            mkNoti(
                'Alerta de Notificación',
                'Hubo un Problema al ingresar la imagen', {
                    status: 'danger',
                    duration: 3000
                }
            );
        }
    });
    $('#tabla_usuario').DataTable({
        responsive: true,
        paging: true,
        pageLength: 10,
        lengthChange: false,
        searching: true,
        scrollCollapse: true,
        order: [
            [3, 'desc'],
            [0, 'asc']
        ],
        scroller: false,
        language: {
            emptyTable: 'No hay Registros',
            zeroRecords: 'No Encontrado - Lo Siento',
            infoFiltered: "(Filtrada de _MAX_ total entradas)"
        }
    });

}

function eliminararchivos(ac, id_registro, destino) {
    $.ajax({
        url: 'controller/' + destino,
        type: 'POST',
        dataType: 'JSON',
        data: {
            opcion: ac,
            id_registro: id_registro
        },
        success: function (d) {
            var resultado = d;
            if (resultado.respuesta == 'exito') {
                mkNoti(
                    'Contenido Eliminado ',
                    'Exitosamente', {
                        status: "primary",
                        duration: 1500
                    }
                );
                setTimeout(function () {
                    verContenedor(resultado.destino, 7);
                }, 1800);
            } else if (resultado.respuesta == 'Error') {
                mkNoti(
                    'Error del Sistema',
                    'Error al intentar eliminar', {
                        status: "danger",
                        duration: 1500
                    }
                );
            }
        }
    });
};

function cambiarTipo(id_registros, id_imagen){
    var tipo = $("#slectTipo").val();
  /*   console.log("el tipo de imagen es :"+tipo);

    console.log("id contenido :"+id_registros);
    console.log("id Imagen"+id_imagen);
     */
        $.ajax({
            url: 'controller/cContenido.php',
            type: 'POST',
            dataType: 'JSON',
            cache: false,
            data: {
                opcion: 'modificar-tipo',
                id_contenido: id_registros,
                id_img: id_imagen,
                tipo: tipo
            },
            success: function (d) {
                var resultado = d;
               /*  console.log(resultado); */
                if (resultado.respuesta == 'exito') {
                    mkNoti(
                        'Notificación',
                        'Imagen :  Cambio de Tipo a!!'+resultado.respuesta.tipo, {
                            status: 'success',
                            duration: 3000
                        }
                    );
                } else {
                    mkNoti(
                        'Notificación',
                        'Imagen con Problemas al cambiar Tipo!!', {
                            status: 'warning',
                            duration: 3000
                        }
                    );
                }
            }
        });
    
}
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
            if(size > 5120*5120){
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


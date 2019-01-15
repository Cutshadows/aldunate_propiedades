$(document).ready(function(){
    
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
            url: 'cliente/controller/cFiltro.php',
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
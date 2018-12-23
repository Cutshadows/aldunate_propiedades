//CARGA EL CONTENEDOR ACTUAL
function verContenedor(destino, ruta) {
    //var abuscar = $('#abuscar').attr('value');
    $.ajax({
        url: 'view/' + destino,
        type: 'POST',
        data: {
            ruta: ruta
        },
        success: function (datos) {
            $("#contenido-aldunate").html(datos);
            $('html, body').animate({
                scrollTop: 0
            }, 'slow');
            return false;
        }
    });
}
//CARGA FORMULARIO
function cargaFormulario(id_registro, destino, ruta) {
    $.ajax({
        url: 'view/' + destino,
        type: 'POST',
        data: {
            ruta: ruta,
            id: id_registro
        },
        success: function (datos) {
            $("#contenido-aldunate").html(datos);
            $('html, body').animate({
                scrollTop: 0
            }, 'slow');
            return false;
        }
    });
}

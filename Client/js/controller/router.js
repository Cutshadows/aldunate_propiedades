//CARGA EL CONTENEDOR ACTUAL
function verContenedor(destino, ruta, id) {
    //var abuscar = $('#abuscar').attr('value');
    $.ajax({
        url: 'view/' + destino,
        type: 'POST',
        data: {
            ruta: ruta,
            id: id
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
function cargaFormulario(id_registro, destino) {
    $.ajax({
        url: 'view/' + destino,
        type: 'POST',
        data: {
            accion: 2,
            id: id_registro
        },
        success: function (datos) {
            $("#contenidos").html(datos);
            $('html, body').animate({
                scrollTop: 0
            }, 'slow');
            return false;
        }
    });
}

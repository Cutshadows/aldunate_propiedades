//CARGA EL CONTENEDOR ACTUAL
function verContenedor(destino, id) {
    //var abuscar = $('#abuscar').attr('value');
    $.ajax({
        url: 'controller/' + destino,
        type: 'POST',
        data: {
            ruta: 1,
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
        url: 'controller/' + destino,
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

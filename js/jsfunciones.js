function verContenedor(destino, id) {
    //var abuscar = $('#abuscar').attr('value');
    $.ajax({
        url: destino,
        type: 'POST',
        data: {
            accion: 1,
            id: id
        },
        success: function (datos) {
            $("#contenedor").html(datos);
            $('html, body').animate({
                scrollTop: 0
            }, 'slow');
            return false;
        }
    });
}

function cargaFormulario(id_propiedad, destino) {
    /* console.log(id_propiedad);
    console.log(destino); */
    $.ajax({
        url: destino,
        type: 'POST',
        data: {
            accion: 2,
            id_propiedad: id_propiedad
        },
        success: function (datos) {
            $("#contenedor").html(datos);
            $('html, body').animate({
                scrollTop: 0
            }, 'slow');
            return false;
        }
    });
}
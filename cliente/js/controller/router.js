//CARGA EL CONTENEDOR ACTUAL
function verContenedor(destino, ruta) {
    //var abuscar = $('#abuscar').attr('value');
    $.ajax({
        url: '../cliente/view/' + destino,
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
        url: '../cliente/view/' + destino,
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


function loadDoc() {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        document.getElementById("mostrarEntradas").innerHTML =
        this.responseText;
      }
    };
    xhttp.open("POST", "../cliente/view/visitas.txt", true);
    //xhttp.setRequestHeader("Content-type", "text/*");
    xhttp.setRequestHeader("Content-type", "application/json");
    xhttp.send();
  }

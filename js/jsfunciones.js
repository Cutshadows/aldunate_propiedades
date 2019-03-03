function verContenedor(destino, id) {
    //var abuscar = $('#abuscar').attr('value');
    $.ajax({
        url: destino,
        type: 'GET',
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
        type: 'GET',
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

function fallbackCopyTextToClipboard(text) {
    try {
        var successful = document.execCommand("copy");
        var msg = successful ? "successful" : "unsuccessful";
        console.log("Fallback: Copying text command was " + msg);
    } catch (err) {
        console.error("Fallback: Oops, unable to copy", err);
    }
   // document.body.removeChild(textArea);
}

function copyTextToClipboard(text) {
    if (!navigator.clipboard) {
        fallbackCopyTextToClipboard(text);
        return;
    }
    navigator.clipboard.writeText(text).then(
        function () {
            return true;
            //console.log("Async: Copying to clipboard was successful!");
        },
        function (err) {
            return false;
            //console.error("Async: Could not copy text: ", err);
        }
    );
}


function clipboard(accion, id){
    var config = {
        positionY: "top"
    };
    mkNotifications(config);
    var options = {
        status: "info",
        duration:1500,
        link: {
            url: "http://"+window.location.host+"/aldunate_propiedades/detalles.php?accion=" + accion + "&id_propiedad=" + id,
            function: function () {
                mkNoti('Link Callback function', 'This is the callback function.', {
                    status: 'success'
                });
            }
        }
    };
    mkNoti(
        "Copiando...",
        "Contenido Copiado a Portapapeles",
        options
    );
    //console.log("http://" + window.location.host + "/aldunate_propiedades/detalles.php?accion=" + accion + "&id_propiedad=" + id);
    copyTextToClipboard("http://"+window.location.host+"/aldunate_propiedades/detalles.php?accion=" + accion + "&id_propiedad=" + id);
}
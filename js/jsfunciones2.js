function verContenedor(destino, accion, id) {
    //var abuscar = $('#abuscar').attr('value');
    $.ajax({
        url: "../../../"+destino,
        type: 'GET',
        data: {
            accion: accion,
            id: id
        },
        success: function (datos) {
            setTimeout(function () {
                location.assign(window.location.href="../../../");
            }, 1000);
        }
    });
}

/* function verContenedorPagina(destino, accion, pagina) {
    //var abuscar = $('#abuscar').attr('value');
    $.ajax({
        url: "../../../"+destino,
        type: 'GET',
        data: {
            accion: accion,
            pagina: pagina
        },
        success: function (datos) {
            $("#mostrar_resultado_paginador, row").html(datos);
            $('html, body').animate({
                scrollTop: 0
            }, 'slow'); 
            return false;
        }
    });
} */


/* function cargaFormulario(id_propiedad, destino) {
    $.ajax({
        url: "../../../"+destino,
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
} */

function fallbackCopyTextToClipboard(text) {
    try {
        var successful = document.execCommand("copy");
        var msg = successful ? "successful" : "unsuccessful";
        //console.log("Fallback: Copying text command was " + msg);
    } catch (err) {
        //console.error("Fallback: Oops, unable to copy", err);
    }
   // document.body.removeChild(textArea);
}

function copyTextToClipboard(text) {
    if (navigator.permissions) {
        var estadoAct = navigator.permissions.query({
            name: 'clipboard-read'
        })
        switch (estadoAct.state) {
            case "prompt":
                //console.log("Permisos sin establecer todavía")
                break;
            case "denied":
                //console.log("Permiso denegado")
                break;
            case "granted":
                //console.log("Permiso concedido")
                break;
            default:
                //console.log("Estado desconocido: " + estadoAct.state)
        }
    }
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
            url: "http://"+window.location.host+"/propiedad/" + accion + "/id/" + id,
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
    //console.log(window.location.href+"propiedad/" + accion + "/id/" + id);
    copyTextToClipboard(window.location.href+"propiedad/" + accion + "/id/" + id);
}
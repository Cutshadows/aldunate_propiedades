$(document).ready(function(){
    
    


    $("#frmFiltro").on("submit", function (e) {
        //$("#btnNuevoContenido").on("click", function (e) {        
        e.preventDefault();

        
        var form = $(this);
        var formData = new FormData();
        var params = form.serializeArray();
       
        $(params).each(function (index, element) {
            formData.append(element.name, element.value);
        });
        var datos = formData; 
        $.ajax({
            url: 'cliente/controller/cFiltro.php',
            type: 'POST',
            dataType: 'HTML',
            cache: false,
            contentType: false,
            processData: false,
            async: true,
            data: datos,
            success: function (data) {
                //console.log(data);
                var resultado = data;
                $("#mostrar_resultado_paginador").html(resultado);
                /* if (resultado.respuesta == 'exito') { */
                //llamamos a la notificacion para que se muestre en el escritorio con su body y url 
               /*  mkNoti(
                    'Alerta de Notificación',
                    'Datos encontrados', {
                        status: 'success',
                        duration: 3000
                    }
                ); */
                $('#mostrar_resultado_paginador').html();
                /* setTimeout(function () {
                    verContenedor('vPrincipal.php', 3);
                }, 1800); */
            },
            error: function (data) {
                console.log(data);
                mkNoti(
                    'Alerta de Notificación',
                    'No fue posible encontrar la busqueda!!!', {
                        status: 'warning',
                        duration: 3000
                    }
                );
            }
        });
    });


});
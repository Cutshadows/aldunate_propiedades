$(document).ready(function () {
    $('#btnnoti').on('click', function (e) {
        e.preventDefault();
        mkNoti(
            'Login Correcto',
            'Bienvenid@ : ',
            {
                status: "danger",
                duration: 1000
            }
        );
    });
    
    $('#tabla_usuario').DataTable({
        responsive: true,
        paging: true,
        pageLength: 10,
        lengthChange: false,
        searching: true,
        scrollCollapse: true,
        order: [
            [3, 'asc'],
            [0, 'desc']
        ],
        scroller: false,
        language: {
            emptyTable: 'No hay Registros',
            zeroRecords: 'No Encontrado - Lo Siento',
            infoFiltered: "(Filtrada de _MAX_ total entradas)"
        }
    });
    // #myInput is a <input type="text"> element
    /* $('#buscadorContenido').on('keyup', function () {
        table.search(this.value).draw();
    }); */
    $("#form-usuarios").on("submit", function (e) {
        e.preventDefault();
        var form = $(this);
        var formData = new FormData();
        var params = form.serializeArray();
        $(params).each(function (index, element) {
            formData.append(element.name, element.value);
        });
        //console.log(params);
        var datos = formData;
        //console.log(datos);
        $.ajax({
            url: 'controller/cAdmin.php',
            type: 'POST',
            dataType: 'JSON',
            cache: false,
            contentType: false,
            processData: false,
            async: true,
            data: datos,
            success: function (data) { 
                //console.log(data);
                var resultado = data;
                console.log(resultado);
                mkNoti(
                    'Usuari@ Cread@ ',
                    'Exitosamente',
                    {
                        status: "success",
                        duration: 2000
                    }
                );
                setTimeout(function () {
                    verContenedor('vPrincipal.php',5);
                }, 2500);
                
                
            },
            error: function (data) {
                console.log(data);
            }
        })
    });
});
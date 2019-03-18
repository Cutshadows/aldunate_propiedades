eventListeners();

function eventListeners() {
    document.querySelector('#form-login').addEventListener('submit', validarLogin);
}

// var ruta = window.location;
// console.log(ruta);


function validarLogin(e) {
    e.preventDefault();
    var usuario = document.querySelector('#txtUsuario').value;
    var clave = document.querySelector('#txtClave').value;
    var tipo = document.querySelector('#tipo').value;
    var formulario = document.querySelector('#form-login');
    if (usuario === '' || clave === '') {
        mkNoti(
            'Alerta de Notificación',
            'Usuario y Clave son Requeridos', {
                status: 'warning',
                duration: 3000
            }
        );
    } else {

        //datos que se envian al servidor
        var datos = new FormData();
        datos.append('usuario', usuario);
        datos.append('clave', clave);
        datos.append('accion', tipo);
        //console.log(datos);
        // crear el llamado a ajax
        var xhr = new XMLHttpRequest();
        //abrir conexion
        xhr.open('POST', 'controller/cLogin.php', true);
        xhr.setRequestHeader('X_Requested_With', 'XMLHttpRequest');

        //xhr.setRequestHeader('X_Requested_with', 'XMLHttpRequest');
        //xhr.onload= function(){
        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status === 200) {
                var respuesta = xhr.responseText;
                //var json = JSON.parse(respuesta);
                var json = JSON.parse(respuesta); //console.log(json.respuesta);
                //var respuesta= JSON.parse(xhr.responseText);
                //si la respuesta del ingreso-login es correcta
                if (json.tipo == 'login') {
                    if (json.respuesta == 'correcto') {
                        // console.log(json.respuesta.tipo);
                        var options = {
                            status: "success",
                            duration: 1000
                        };
                        mkNoti(
                            'Login Correcto',
                            'Bienvenid@ : ' + json.usuario,
                            options
                        );
                        setTimeout(function () {
                            window.location.href = 'administrador';
                        }, 1800);

                        //console.log(respuesta);
                    }
                } else {
                    mkNoti(
                        'Login Error',
                        'Usuario o Clave Incorrectos, Comunicarse con el administrador', {
                            status: 'danger',
                            duration: 3000,
                        }
                    );
                }
            }
        }

        //}

        //enviar datos
        xhr.send(datos);

    }
}
eventListeners();

function eventListeners() {
    document.querySelector('#form-email').addEventListener('submit', encontrarEmail);
}
function validarLogin(e) {
  e.preventDefault();
  var email = document.querySelector('#txtEmail').value;
  var formulario = document.querySelector('#form-email');
  var opcion = document.querySelector('#opcion');
  if (email === '') {
      mkNoti(
          'Alerta de Notificación',
          'Email es Requerido', {
              status: 'warning',
              duration: 3000
          }
      );
  } else {

      //datos que se envian al servidor
      var datos = new FormData();
      datos.append('email', email);
      datos.append('opcion', opcion);
      //console.log(datos);
      // crear el llamado a ajax
      var xhr = new XMLHttpRequest();
      //abrir conexion
      xhr.open('POST', './cliente/controller/cEmail.php', true);
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
              if (json.tipo == 'email') {
                  if (json.respuesta == 'correcto') {
                      // console.log(json.respuesta.tipo);
                     /*  var options = {
                          status: "success",
                          duration: 1000
                      };
                      mkNoti(
                          'Login Correcto',
                          'Bienvenid@ : ' + json.usuario,
                          options
                      );
                      setTimeout(function () {
                          window.location.href = 'administrador/cliente';
                      }, 1800); */

                      //console.log(respuesta);
                  }
              } else {
                  /* mkNoti(
                      'Login Error',
                      'Usuario o Clave Incorrectos, Comunicarse con el administrador', {
                          status: 'danger',
                          duration: 3000,
                      }
                  ); */
              }
          }
      }

      //}

      //enviar datos
      xhr.send(datos);

  }
}
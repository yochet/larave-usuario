// public/js/angular/userController.js

var app = angular.module('userApp', []);

app.controller('userController', function($scope, $http) {
    $scope.user = {};
    $scope.modo = 'nuevo';
    $scope.tituloModal = 'Agregar Usuario';
    $scope.accionFormulario = "/usuarios"; // ruta por defecto (store)

    // 🟢 Abrir modal (nuevo o editar)
    $scope.abrirModal = function(modo, user = null) {
        $scope.modo = modo;

        if (modo === 'nuevo') {
            $scope.tituloModal = 'Agregar Usuario';
            $scope.user = {};
            $scope.accionFormulario = "/usuarios";
        } else if (modo === 'editar') {
            $scope.tituloModal = 'Editar Usuario';
            $scope.user = angular.copy(user);
            $scope.accionFormulario = "/usuarios/" + user.id; // ruta para update
        }

        $('#modalUsuario').modal('show');
    };

    // 🟢 Guardar o actualizar
    $scope.guardarUsuario = function() {
        document.getElementById('formulario').submit();
    };

    // 🔴 Eliminar usuario
    $scope.eliminarUsuario = function(id) {
        if (confirm('¿Seguro que deseas eliminar este usuario?')) {
            var form = document.createElement('form');
            form.method = 'POST';
            form.action = '/usuarios/' + id;

            var csrf = document.createElement('input');
            csrf.type = 'hidden';
            csrf.name = '_token';
            csrf.value = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            form.appendChild(csrf);

            var method = document.createElement('input');
            method.type = 'hidden';
            method.name = '_method';
            method.value = 'DELETE';
            form.appendChild(method);

            document.body.appendChild(form);
            form.submit();
        }
    };

     $scope.email = '';

    $scope.enviarCorreo = function() {
        $http.post('/api/enviar-correo', { email: $scope.email })
        .then(function(response) {
            alert(response.data.message);
        })
        .catch(function(error) {
            console.error(error);
            alert('Error al enviar el correo');
        });
    };
});

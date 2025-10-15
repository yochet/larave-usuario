<!DOCTYPE html> 
<html lang="es" ng-app="userApp" ng-controller="userController"> 
    <head> 
        <meta charset="UTF-8"> <title>Gestión de Usuarios</title> <!-- jQuery (debe ir antes de Bootstrap y AngularJS) --> 
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> <!-- AngularJS --> 
        <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.8.3/angular.min.js"></script> <!-- Bootstrap --> 
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/css/bootstrap.min.css">
         <script src="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/js/bootstrap.min.js"></script> 
         <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
        </head> 
        <body class="container" ng-app="userApp" ng-controller="userController">

    <h3 class="mt-4">Lista de Usuarios</h3>

    <!-- Botón que abre el modal para agregar -->
    <button class="btn btn-primary" ng-click="abrirModal('nuevo')">
        Agregar Usuario
    </button>

    <!-- TABLA DE USUARIOS -->
    <div class="card-body bg-white" style="margin-top: 20px;">
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Correo</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                <!-- EDITAR -->
                                <button class="btn btn-warning btn-sm"
                                    ng-click="abrirModal('editar', {{ json_encode($user) }})">
                                    Editar
                                </button>

                                <!-- ELIMINAR -->
                                <button class="btn btn-danger btn-sm"
                                    ng-click="eliminarUsuario({{ $user->id }})">
                                    Eliminar
                                </button>
                                <!-- <button ng-click="enviarCorreo()">Enviar correo</button> -->
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- MODAL -->
    <div class="modal fade" id="modalUsuario" tabindex="-1" role="dialog" aria-labelledby="modalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
              <span aria-hidden="true">&times;</span>
            </button>
            <h4 class="modal-title">@{{ tituloModal }}</h4>
          </div>
          
          <div class="modal-body">
            <form id="formulario" method="POST" action="@{{ accionFormulario }}">
              @csrf
              <div ng-if="modo == 'editar'">
                  @method('PUT')
                  <input type="hidden" name="id" ng-value="user.id">
              </div>

              <div class="form-group">
                <label>Nombre:</label>
                <input type="text" name="name" class="form-control" ng-model="user.name" required>
              </div>

              <div class="form-group">
                <label>Email:</label>
                <input type="email" name="email" class="form-control" ng-model="user.email" required>
              </div>
              <!-- <div class="form-group">
                <label>Contraseña:</label>
                <input type="password" name="password" class="form-control" ng-model="user.password" required>
              </div> -->
            </form>
          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
            <button type="button" class="btn btn-success" ng-click="guardarUsuario()">Guardar</button>
          </div>

        </div>
      </div>
    </div>

    <!-- 🔹 Tu archivo Angular -->
    <script src="{{ asset('js/angular/userController.js') }}"></script>

  </body>

</html> 
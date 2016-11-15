var app = angular.module("myShoppingList", []);

app.controller('myCtrl', function($scope, $http) {
  $scope.init = function(id){
    $scope.id = id;

  	$http.get(urlRequisiciones + 'getReqDetails/' + id).success(function(data, status, headers, config) {
  		$scope.insumos = data['data'];
  	}).error(function(data, status, headers, config) {
  			alert("Se ha producido un error al cargar la lista de insumos requisitados");		// log error
  	});
  };
});

app.directive('cambiarStatus', function($http) {
  return {
    restrict: 'E',
    template : '<button type="button" id="btnActualizar" onclick="posData()" data-name="{{dataval}}" class="btn btn-{{class}} btn-sm">{{value}} <i class="glyphicon glyphicon-{{icon}}"></i></button>',
    link: function(scope, el, attr) {
     // $http.get(urlRequisiciones + 'getButtonStatus/' + scope.idEstado).success(function(data, status, headers, config) {
          switch (/*data['data'][0]['idEstado']*/ scope.idEstado ) {
              case '1':
                    scope.value = 'Surtir';
                    scope.class = "success";
                    scope.icon = "saved";
                    scope.dataval = 2;
                  break;
              case '2':
                    scope.value = 'Cancelar';
                    scope.class = "danger";
                    scope.icon = "ban-circle";
                    scope.dataval = 3;
                  break;
          }
    //	});
    }
  }
});

app.directive('eliminarRequisicion', function(){
    return {
        restrict: 'E',
        template: '<button type="button" id="btnEliminar" class="btn btn-danger btn-sm" ng-click="eliminarReq()">Eliminar <i class="glyphicon glyphicon-remove-circle"></i></button>',
        controller: function($scope, $http) {
          $scope.eliminarReq = function() {
                    posEliminar();
            }
        }
    }
});

app.directive('editarRequisicion', function(){
    return {
        restrict: 'E',
        template: 
             '<div class="col-md-6">'+
              '<div class="dropdown combo">'+
                '<button class="btn btn-primary dropdown-toggle btn-sm" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">'+
                  'Opciones'+
                  '<span class="caret"></span>'+
               '</button>'+
                '<ul class="dropdown-menu" aria-labelledby="dropdownMenu1">'+
                  '<li><a id="btnEditar" ng-click="editarReq()" href="#">Modificar <i class="glyphicon glyphicon-edit"></i></a></li>'+
                  '<li><a id="btnDatosC" onclick="posDatosCompra()" data-name="{{dataval}}" class="dropdown-item" href="#">{{value}} <i class="glyphicon glyphicon-{{icon}}"></i></a></li>'+
                  '<li role="separator" class="divider"></li>'+
                  '<li><a href="#">Eliminar</a></li>'+
                '</ul>'+
              '</div>'+            
           '</div>',
    link: function(scope, el, attr) {
          switch (scope.idEstado) {
              case '1':
                    scope.value = 'Datos Compra';
                    scope.class = "danger";
                    scope.icon = "saved";
                    scope.dataval = 2;
                  break;
              case '2':
                    scope.value = 'Completar Compra';
                    scope.class = "danger";
                    scope.icon = "saved";
                    scope.dataval = 3;
                  break;
          }
    },
    controller: function($scope, $http) {

          $scope.editarReq = function() {
              posEditar();
          }

          $scope.eliminarReq = function() {
                    posEliminar();
            }          
      }
    }
});

/*
app.directive('datosCompra', function($http) {
  return {
    restrict: 'E',
    template : '<a id="btnDatosC" onclick="posDatosCompra()" data-name="{{dataval}}" class="dropdown-item" href="#">{{value}} <i class="glyphicon glyphicon-{{icon}}"></i></a>',
    link: function(scope, el, attr) {
          switch (scope.idEstado) {
              case '1':
                    scope.value = 'Datos Compra';
                    scope.class = "danger";
                    scope.icon = "saved";
                    scope.dataval = 2;
                  break;
              case '2':
                    scope.value = 'Completar Compra';
                    scope.class = "danger";
                    scope.icon = "saved";
                    scope.dataval = 3;
                  break;
          }
    }
  }
});
*/
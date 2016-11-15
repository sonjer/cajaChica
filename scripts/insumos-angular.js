var app = angular.module('insumosApp', ['scrollable-table', 'ngMask']);
app.controller('insumosCtrl', function($scope, $http, ResponsesFactory) {

  $scope.insumos = {};
//  $scope.insumosList = [];


  $scope.loadData = function () {
      $http.get(urlInsumos + 'getDataJson').success(function(data, status, headers, config) {
      $scope.insumos = data['data'];
      }).error(function(data, status, headers, config) {
        // log error
      });
  }

  $scope.agregarInsumos = function(){
    ResponsesFactory.setidInsumo($scope.insumos.idInsumo);
  	$http({
			url : urlInsumos + 'agregarInsumos',
			method : "POST",
			data : $scope.insumos,
		}).success(function(data) {
      $scope.buscarInsumos();
		});
	}

  $scope.submitForm = function(){
    alert('Was submitForm');
	}

  $scope.buscarInsumos = function(){
    $("#btnBuscar").prop('disabled', false);
    $scope.dataLocal = ResponsesFactory.data;
      $http({
       url : urlInsumos + 'getWhereDataJson',
       method : "POST",
       data : $scope.dataLocal,
     }).success(function(data) {
        $scope.insumos = data['data'];

     });
    // print_r($scope.dataLocal);
	}

});

app.factory('ResponsesFactory', function(){
	return {
		data : {
			idInsumo : 'idInsumo',
			descripcion : 'descripcion',
			unidad : 'unidad',
		},
		setidInsumo : function(value){
			this.data.idInsumo = value;
		},
		setDescripcion : function(value){
			this.data.descripcion = value;
		},
		setUnidad : function(value){
			this.data.unidad = value;
		},
	};
});
// FIN CONTROLLER

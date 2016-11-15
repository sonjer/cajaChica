var app = angular.module('myApp', ['scrollable-table', 'ngMask']);
app.controller('customersCtrl', function($scope, $http) {
	$http.get(urlRequisiciones + 'getDataJson/insumos').success(function(data, status, headers, config) {
		$scope.insumos = data['data'];
	}).error(function(data, status, headers, config) {
		// log error
	});

	$scope.Remove = function() {
		RemoveHidden();
	};

	$scope.setSelected = function(idSelectedVote) {
		$scope.idSelectedVote = idSelectedVote;
		values(idSelectedVote);
	};

	$scope.det = {};
	$scope.det.cantidad = "";
	$scope.det.comentarios = "";
	$scope.detallesList = [];

	$scope.add = function() {
		// claveCompuesta, idInsumo, cantidad, fecha, comentarios
		var data = {};
		data.claveCompuesta = 666;
		data.idInsumo = insumoObj.idInsumo;
		data.descripcion = insumoObj.descripcion;
		data.cantidad = $scope.det.cantidad;
		data.unidad = insumoObj.unidad;
		data.fecha = $("#fechaInsumo").val();
		data.comentarios = $scope.det.comentarios;
		$scope.detallesList.push(data);
		$scope.limpiarInput();
	}

	$scope.delete = function() {
		$scope.det = {};
		$scope.det.cantidad = "";
		$scope.det.comentarios = "";
		$scope.detallesList.splice(0);
	};

	$scope.limpiarInput = function(){
		$('#insumos').val('');
		$('#fechaInsumo').val('');
		$("#cantidad1").val('');
		$("#comentarios").val('');
		$('#insumos').focus();
		$('#unidadlbl').html('');
	}

	$scope.remove = function(obj) {
		//	console.log('end' + $scope.detallesList);
		if (obj != -1) {
			$scope.detallesList.splice(obj, 1);
			$scope.coments = '';
		}
	}

	$scope.showdetails = function(idx) {
		$scope.coments = $scope.detallesList[idx]['comentarios'];	
	}

	$scope.nodetails = function() {
			$scope.coments = '';
	}

	$scope.postData = function() {
		$scope.response = "";
		var json = angular.toJson($scope.detallesList);
	}
	// function to submit the form after all validation has occurred
	$scope.submitForm = function() {
		if ($scope.userForm.$valid) {
			var json = angular.toJson($scope.detallesList);
			$scope.response = GuardarReq(json);
		}
	};

});
// FIN CONTROLLER

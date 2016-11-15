var app = angular.module('myApp', ['scrollable-table', 'ngMask']);
app.controller('editarRequisicionCtrl', function($scope, $http) {
	$http.get(urlRequisiciones + 'getDataJson/insumos').success(function(data, status, headers, config) {
		$scope.insumos = data['data'];
	}).error(function(data, status, headers, config) {
		// log error
	});

	$http.get(urlRequisiciones + 'getReqDetails/' + claveCompuesta).success(function(data, status, headers, config) {
		angular.forEach(data['data'], function(value, key){
			  var obj = {};
		 		obj.claveCompuesta = data['data'][key]['claveCompuesta'];
		 		obj.idInsumo = data['data'][key]['idInsumo'];
				obj.descripcion = data['data'][key]['descripcion']
				obj.cantidad = data['data'][key]['cantidad'];
				obj.unidad = data['data'][key]['unidad'];		 		
		 		obj.fecha = data['data'][key]['fecha'];
		 		obj.comentarios = data['data'][key]['comentarios'];
		 		$scope.detallesList.push(obj);
		 });
	 }).error(function(data, status, headers, config) {
	  	alert("Se ha producido un error al cargar la lista de insumos requisitados");		// log error
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
		data.claveCompuesta = claveCompuesta;
		data.idInsumo = insumoObj.idInsumo;
		data.descripcion = insumoObj.descripcion;
		data.cantidad = $scope.det.cantidad;
		data.unidad = insumoObj.unidad;
		data.fecha = $("#fechaInsumo").val();
		data.comentarios = $scope.det.comentarios;
		$scope.detallesList.push(data);
	//	print_r($scope.detallesList);
		$scope.limpiarInput();
	}

	$scope.delete = function() {
		$scope.det = {};
		$scope.det.cantidad = "";
		$scope.det.comentarios = "";
		$scope.detallesList.splice(0);
	};

	$scope.limpiarInput = function() {
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
			var json = angular.toJson($scope.detallesList);
			$scope.response = GuardarReq(json);
	};

});
// FIN CONTROLLER

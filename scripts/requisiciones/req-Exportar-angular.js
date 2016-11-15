var formats = [moment.ISO_8601, "YYYY-MM-DD  :)  HH*mm*ss"];
var app = angular.module('myApp', ['scrollable-table', 'ui.router']);

app.controller('OpcionesCtrl', function($scope, $http, MyService, $state) {
	$scope.today = new Date();
	$scope.fechaMin;
	$scope.op = {}
	$scope.opciones = []

	$scope.setfechaInicio = function(){
		$("#fechaInicio").datepicker({
			changeMonth : true,
			dateFormat : 'yy-mm-dd',
			onSelect: function(selected, evnt) {
				$scope.fechaMin = selected;
				$scope.op.fechaInicio = selected;
			},
		});
	}

	$scope.setfechaFin = function(){
		$("#fechaFin").datepicker({
			changeMonth : true,
			dateFormat : 'yy-mm-dd',
			onSelect: function(selected, evnt) {
				$scope.op.fechaFin = selected;
			},
		});
	}

	$scope.agregar = function(){
		MyService.update($scope.op.fechaInicio, $scope.op.fechaFin);
		$state.go($state.current, {}, {reload: true});
	}

	$scope.init = function(){
		$http.get(urlReportes + 'repDetallesJSON').success(function(data, status, headers, config) {
			$scope.detalles = data['result1'];
		}).error(function(data, status, headers, config) {
  				alert("Se ha producido un error al cargar la lista de insumos requisitados");		// log error
  			});
	};

		$scope.initOrden = function(){
		$http.get(urlReportes + 'repDetallesJSON').success(function(data, status, headers, config) {
			$scope.detalles = data['result1'];
		}).error(function(data, status, headers, config) {
  				alert("Se ha producido un error al cargar la lista de insumos requisitados");		// log error
  			});
	};


	$scope.repDetFecha = function(){
		$scope.data = MyService.data;
		$http.get(urlReportes + 'repDetallesDateRangeJSON/'+ $scope.data.fechaInicio +'/'+ $scope.data.fechaFin).success(function(data, status, headers, config) {
			$scope.detalles = data['result1'];
		}).error(function(data, status, headers, config) {
  			alert("Se ha producido un error al cargar la lista de insumos requisitados");		// log error
  		});
	};

	$scope.generar = function(id){
		switch (id) {
			case 1:
			window.location.href = urlReportes + 'outDetaRequisiones/' + id;
			break;
			case 2:
			window.location.href = urlReportes + 'outDetaRequisiones/' + id;
			break;
			case 3:
			$.get(urlReportes + 'outDetaRequisiones/' + id, function( data ) {
				var printWindow = window.open('', '', 'height=400,width=400');
				printWindow.document.write(data);
				printWindow.document.close();
				printWindow.print();
			});
			break;
			default:
			alert('Error!!');
		}
	}

	$scope.generarFecha = function(id){
		$scope.data = MyService.data
		switch (id) {
			case 1:
			window.location.href = urlReportes + 'outDetaFechaRequisiones/' + id + '/' + $scope.data.fechaInicio + '/' +  $scope.data.fechaFin;
			break;
			case 2:
			window.location.href = urlReportes + 'outDetaFechaRequisiones/' + id + '/' + $scope.data.fechaInicio + '/' +  $scope.data.fechaFin;
			break;
			case 3:
			$.get(urlReportes + 'outDetaFechaRequisiones/' + id + '/' + $scope.data.fechaInicio + '/' +  $scope.data.fechaFin, function( data ) {
				var printWindow = window.open('', '', 'height=400,width=400');
				printWindow.document.write(data);
				printWindow.document.close();
				printWindow.print();
			});
			break;
			default:
			alert('Error!!');
		}
	}

}); // FIN CONTROLLER

app.controller('InsumosCtrl', function($scope, $http, InsumoFactory, $state) {

	$scope.claveInsumo;

	$scope.jerson = function(){
		$scope.dataLocal = InsumoFactory.data;
		$http.get(urlReportes + 'repDetallesInsumoJSON/'+ $scope.dataLocal.claveInsumo).success(function(data, status, headers, config) {
			$scope.detalles = data['result1'];
		//	console.log(urlReportes + 'repDetallesInsumoJSON/'+ $scope.dataLocal.claveInsumo);
	}).error(function(data, status, headers, config) {
  				alert("Se ha producido un error al cargar la lista de insumos requisitados");		// log error
  			});
};

$scope.cargarInsumo = function (){

	if($scope.idInsumo == undefined){
			InsumoFactory.update('idInsumo');
	} else {
			InsumoFactory.update($scope.claveInsumo);
	}

	$state.go($state.current, {}, {reload: true});
}

$scope.generar = function(id){
	$scope.dataLocal = InsumoFactory.data;
	switch (id) {
		case 1:
		window.location.href = urlReportes + 'outDetaInsumoRequisiones/' + id + '/' + $scope.dataLocal.claveInsumo;
		break;
		case 2:
		window.location.href = urlReportes + 'outDetaInsumoRequisiones/' + id + '/' + $scope.dataLocal.claveInsumo;
		break;
		case 3:
		$.get(urlReportes + 'outDetaInsumoRequisiones/' + id + '/' + $scope.dataLocal.claveInsumo, function( data ) {
			var printWindow = window.open('', '', 'height=400,width=400');
			printWindow.document.write(data);
			printWindow.document.close();
			printWindow.print();
		});
		break;
		default:
		alert('Error!!');
	}
}


}); // FIN CONTROLLER

app.controller('CcostosCtrl', function($scope, $http, CcostosFactory, $state) {
	$scope.idCentroCostos;
	$scope.idCliente;

	$scope.init= function(){
		$scope.dataLocal = CcostosFactory.data;

		$http({
			url : urlReportes + 'getDataJSON',
			method: "POST",
			data: $scope.dataLocal,
		})
		.success(function(data) {
			$scope.detalles = data;
		});
	}

	$scope.cargarCentroCostos = function (){

		if($scope.idCentroCostos == undefined){
			CcostosFactory.update('idCentroCostos');
		} else {
			CcostosFactory.update($scope.idCentroCostos);
		}

		if($scope.idCliente == undefined){
			CcostosFactory.setCliente('idCliente');
		} else {
			CcostosFactory.setCliente($scope.idCliente);
		}

		if($scope.idCliente == undefined && $scope.idCentroCostos == undefined){
			CcostosFactory.setCliente('idCliente');
		}

		$state.go($state.current, {}, {reload: true});
		$scope.init();
	}

	$scope.generarReporte = function(id){
		$scope.dataLocal = CcostosFactory.data;
		 var array = JSON.stringify($scope.dataLocal);
		switch (id) {
			case 1:
			    window.location.href = urlReportes + 'outRequisiones/' + id + '/' + encodeURIComponent(array);
			break;
			case 2:
			   window.location.href = urlReportes + 'outRequisiones/' + id + '/' + encodeURIComponent(array);
			break;
			case 3:
				$.get(urlReportes + 'outRequisiones/' + id + '/' + encodeURIComponent(array), function( data ) {
					var printWindow = window.open('', '', 'height=400,width=400');
					printWindow.document.write(data);
					printWindow.document.close();
					printWindow.print();
				});
			break;
			default:
			alert('Error!!');
		}
	}

}); // FIN CONTROLLER
app.controller('CcostosCtrl2', function($scope, $http, CcostosFactory2, $state) {
/* NG-MODEL */
	$scope.obra;
	$scope.usuario;
/* NG -MODEL FIN */

	$scope.initOBxUS = function(){

		$scope.dataLocal = CcostosFactory2.data;
		//print_r($scope.dataLocal);

		$http({
			url : urlReportes + 'getDataJSON',
			method: "POST",
			data: $scope.dataLocal,
		})
		.success(function(data) {
			$scope.detalles = data;
		});
	}

	$scope.cargarCentroCostos2 = function (){

		if($scope.obra == undefined){
			CcostosFactory2.update('obra');
		} else {
			CcostosFactory2.update($scope.obra);
		}

		if($scope.usuario == undefined){
			CcostosFactory2.setusuario('usuario');
		} else {
			CcostosFactory2.setusuario($scope.usuario);
		}

		$state.go($state.current, {}, {reload: true});
		$scope.init();
	}

	$scope.generarReporte2 = function(id){
		$scope.dataLocal = CcostosFactory2.data;
		var array = JSON.stringify($scope.dataLocal);
		switch (id) {
			case 1:
			    window.location.href = urlReportes + 'outRequisiones2/' + id + '/' + encodeURIComponent(array);
			break;
			case 2:
			   window.location.href = urlReportes + 'outRequisiones2/' + id + '/' + encodeURIComponent(array);
			break;
			case 3:
				$.get(urlReportes + 'outRequisiones2/' + id + '/' + encodeURIComponent(array), function( data ) {
					var printWindow = window.open('', '', 'height=400,width=400');
					printWindow.document.write(data);
					printWindow.document.close();
					printWindow.print();
				});
			break;
			default:
			alert('Error!!');
		}
	}

}); // FIN CONTROLLER
app.controller('CcostosCtrl3', function($scope, $http, CcostosFactory3, $state) {
/* NG-MODEL */
	$scope.claveCompuesta;
	$scope.estadoPartida;
/* NG -MODEL FIN */

	$scope.initOrden = function(){
		$scope.dataLocal = CcostosFactory3.data;
		//print_r($scope.dataLocal);
		$http({
			url : urlReportes + 'getDataJSON2',
			method: "POST",
			data: $scope.dataLocal,
		})
		.success(function(data) {
			$scope.detalles = data;
		});
	}

	$scope.cargarCentroCostos3 = function (){

		if($scope.claveCompuesta == undefined){
			CcostosFactory3.update('claveCompuesta');
		} else {
			CcostosFactory3.update($scope.claveCompuesta);
		}

		if($scope.estadoPartida == undefined){
			CcostosFactory3.setestadoPartida('estadoPartida');
		} else {
			CcostosFactory3.setestadoPartida($scope.estadoPartida);
		}

		$state.go($state.current, {}, {reload: true});
		$scope.init();
	}

	$scope.generarReporte3 = function(id){
		$scope.dataLocal = CcostosFactory3.data;
		var array = JSON.stringify($scope.dataLocal);
		switch (id) {
			case 1:
			    window.location.href = urlReportes + 'outRequisiones3/' + id + '/' + encodeURIComponent(array);
			break;
			case 2:
			   window.location.href = urlReportes + 'outRequisiones3/' + id + '/' + encodeURIComponent(array);
			break;
			case 3:
				$.get(urlReportes + 'outRequisiones3/' + id + '/' + encodeURIComponent(array), function( data ) {
					var printWindow = window.open('', '', 'height=400,width=400');
					printWindow.document.write(data);
					printWindow.document.close();
					printWindow.print();
				});
			break;
			default:
			alert('Error!!');
		}
	}

}); // FIN CONTROLLER
app.config(function($stateProvider, $urlRouterProvider){
	$stateProvider
	.state('getAll', {
		url: '/getAll',
		templateUrl: '../scripts/requisiciones/views/todoTable.html',
		controller: 'OpcionesCtrl'
	})
	.state('getFecha', {
		url: '/getFecha',
		templateUrl: '../scripts/requisiciones/views/fechaTabla.html',
		controller: 'OpcionesCtrl'
	})
	.state('getInsumos', {
		url: '/getInsumos',
		templateUrl: '../scripts/requisiciones/views/insumosTabla.html',
		controller: 'InsumosCtrl'
	})
	.state('getCcostos', {
		url: '/getCcostos',
		templateUrl: '../scripts/requisiciones/views/reqCcostosTabla.html',
		controller: 'CcostosCtrl'

	})
	.state('getCcostos2', {
	url: '/getCcostos2',
	templateUrl: '../scripts/requisiciones/views/reqCcostosTablaxO.U.html',
	controller: 'CcostosCtrl2'

	})

	.state('getOrden', {
	url: '/getOrden',
	templateUrl: '../scripts/requisiciones/views/reqDatosCompTabla.html',
	controller: 'CcostosCtrl3'

	})
	$urlRouterProvider.otherwise('getAll');
})
/*  **************************************** Directivas ************************************************************************** */
app.directive("editarRequisicion", function($templateRequest, $compile, MyService){
	return {
		scope: true,
		link: function(scope, element, attrs){
			scope.name = attrs.foo;
			scope.show = false;
			$templateRequest("../scripts/requisiciones/directives/options.html").then(function(html){
				element.append($compile(html)(scope));
			});
		}
	};
});

app.directive("directivaInsumos", function($templateRequest, $compile, MyService){
	return {
		scope: true,
		link: function(scope, element, attrs){
			scope.name = attrs.foo;
			scope.show = false;
			$templateRequest("../scripts/requisiciones/directives/optionInsumo.html").then(function(html){
				element.append($compile(html)(scope));
			});
		}
	};
});

app.directive("directivaCcostos", function($templateRequest, $compile){
	return {
		scope: true,
		link: function(scope, element, attrs){
			scope.name = attrs.foo;
			scope.show = false;
			$templateRequest("../scripts/requisiciones/directives/optionCcostos.html").then(function(html){
				element.append($compile(html)(scope));
			});
		}
	};
});

app.directive("directivaCcostos2", function($templateRequest, $compile){
	return {
		scope: true,
		link: function(scope, element, attrs){
			scope.name = attrs.foo;
			scope.show = false;
			$templateRequest("../scripts/requisiciones/directives/optionCcostos2.html").then(function(html){
				element.append($compile(html)(scope));
			});
		}
	};
});

app.directive("directivaOrden", function($templateRequest, $compile){
	return {
		scope: true,
		link: function(scope, element, attrs){
			scope.name = attrs.foo;
			scope.show = false;
			$templateRequest("../scripts/requisiciones/directives/optionOrden.html").then(function(html){
				element.append($compile(html)(scope));
			});
		}
	};
});
/*********************************** FACTORY ********************************************************/
// A new factory with an update method
app.factory('MyService', function(){
	return {
		data: {
			fechaInicio: '',
			fechaFin: '',
		},
		update: function(first, last) {
      // Improve this method as needed
      this.data.fechaInicio = first;
      this.data.fechaFin = last;
  },
};
});

app.factory('InsumoFactory', function(){
	return {
		data: {
			claveInsumo: 'idInsumo',
		},
		update: function(clave) {
      // Improve this method as needed
      this.data.claveInsumo = clave;
  },
};
});

app.factory('CcostosFactory', function(){
	return {
		data: {
			idCentroCostos: 'idCentroCostos',
			idCliente: 'idCliente',
		},
		update: function(clave) {
			this.data.idCentroCostos = clave;
		},
		setCliente: function(clave2) {
			this.data.idCliente = clave2;
		},
	};
});

app.factory('CcostosFactory2', function(){
	return {
		data: {
			obra: 'obra',
			usuario: 'usuario',
		},
		update: function(clave3) {
			this.data.obra = clave3;
		},
		setusuario: function(clave4) {
			this.data.usuario = clave4;
		},
	};
});

app.factory('CcostosFactory3', function(){
	return {
		data: {
			claveCompuesta: 'claveCompuesta',
			estadoPartida: 'estadoPartida',
		},
		update: function(clave3) {
			this.data.claveCompuesta = clave3;
		},
		setestadoPartida: function(clave4) {
			this.data.estadoPartida = clave4;
		},
	};
});

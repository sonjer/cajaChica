var app = angular.module('myApp', ['ui.router', 'scrollable-table', 'ngMask']);

app.controller('comprasCtrl', function($scope, $http, DatosCompraFactory, ResponsesFactory, $state, $stateParams) {
	$scope.events = {};
	$scope.det = {};
	$scope.datosCompra = {};
	$scope.vdc = {};
	$scope.object = {};

	$scope.detallesList = [];
	$scope.vistaDatosCompra = [];
	$scope.dataRetrive = {};
	$scope.idCentroCostos

	/* Declaraciones */
	$scope.loadData = function() {
		$http.get(urlRequisiciones + 'getReqDetails/' + claveCompuesta).success(function(data, status, headers, config) {
			angular.forEach(data['data'], function(value, key) {
				$scope.insumosRequisitados = data['data'];
				$("#directiva2").show();
			});
		}).error(function(data, status, headers, config) {
			alert("Se ha producido un error al cargar la lista de insumos requisitados");
		});
	};

	$scope.loadDatosCompra = function() {
		$scope.dataRetrive = $stateParams.portfolioId;
		$("#directiva2").hide();
		$scope.object.idCentroCostos = idCentroCostos;

		if (esVacio($scope.dataRetrive)){
			$state.go('listado');
			$("#directiva2").show();
		}

		$http.get(urlRequisiciones + 'getDatosCompra/' + $scope.dataRetrive.idDetalle).success(function(data, status, headers, config) {
			angular.forEach(data['data'], function(value, key) {
				$scope.vistaDatosCompra = data['data'];
			});
		}).error(function(data, status, headers, config) {
			alert("Se ha producido un error al cargar la lista de insumos requisitados");
		});
	};

	/* $scope.selecciona = function(obj){
	 $scope.vdc.idPartida = obj.idPartida;
	 $scope.vdc.idDetalle = obj.idDetalle;
	 $scope.vdc.ordenCompra = obj.ordenCompra;
	 $scope.vdc.fechaCompra = obj.fechaCompra;
	 $scope.vdc.cantComprada = obj.cantComprada;
	 document.getElementById("claveCompra").focus();
	 print_r(obj);
	 }
	 */
	actualizarReq = function() {
		window.location.href = urlRequisiciones + 'actualizarPartidas/' + claveCompuesta;
	}

	eliminarReq = function() {
		window.location.href = urlRequisiciones + 'req_delete_pro/' + claveCompuesta;
	}

	rechazarReq = function() {
	//	alert('Rechazar requisicion en proceso!');
		window.location.href = urlRequisiciones + 'req_Rechazar_pro/' + claveCompuesta;
	}

	$scope.agregarPartida = function() {
		$scope.data = DatosCompraFactory.data;
		$scope.dataRetrive = $stateParams.portfolioId;

		var cantCompra = parseFloat($scope.object.cantComprada).toFixed(2);
		var cantSolicitada = parseFloat($scope.dataRetrive.cantidad).toFixed(2);
		if (parseFloat(cantCompra) == '0.00') {
			$scope.setMessage('cantComprada', 'La cantidad comprada no puede ser 0.');
		} else {
			if (parseFloat(cantCompra) > parseFloat(cantSolicitada)) {
				$scope.setMessage('cantComprada', 'La cantidad comprada no puede ser Mayor a la cantidad Requisitada.');
			} else {
					$scope.events.error = '';
					$scope.getTotalRequisitado($scope.dataRetrive.idDetalle);
			}
		}
	}

	$scope.guardarRegistro = function() {
		$scope.dataLocal = DatosCompraFactory.data;
		$http({
			url : urlRequisiciones + 'saveDatosCompra',
			method : "POST",
			data : $scope.dataLocal,
		}).success(function(data) {
			if ( data = 1) {
					$http.get(urlRequisiciones + 'searchTotalOrdCompra/' + $scope.dataRetrive.idDetalle).success(function(data) {
								if (parseFloat($scope.dataRetrive.cantidad) == parseFloat(data['total'])) {
									$scope.set_flashdata('Se surtio la partida correctamente', 'success');
									$scope.changeStatus($scope.dataRetrive.idDetalle, 3);
								} else{
									$scope.set_flashdata('La partida se encuentra parcialmente surtida', 'info');
									$scope.changeStatus($scope.dataRetrive.idDetalle, 2);
								}
					 });
			  	$state.go('listado');
			}
		});
		$scope.limpiaeForm();
	}

	$scope.changeState = function(element, obj) {
		$state.go(element, {
			portfolioId : obj
		});
	}

	$scope.ocultarBotones = function() {
			$("#directiva2").hide();
	}

	$scope.set_flashdata = function(message, priority) {
		$("#msj").html('<div class="alert alert-'+ priority +' alert-dismissable">' + '<button type="button" class="close" ' + 'data-dismiss="alert" aria-hidden="true">' + '&times;' + '</button><strong>'+ message +'</strong></div>');
	}

	$scope.eliminarPartida = function(id) {
		$http.get(urlRequisiciones + 'datosCompra_delete_pro/' + id).success(function(data) {
			$state.go($state.current, {}, {
				reload : true
			});
			$scope.set_flashdata('Se elimino la partida correctamente!', 'danger');
		}).error(function(data, status, headers, config) {

		});
	};

	$scope.limpiaeForm = function(element) {
		$('#claveCompra').val('');
		$('#cantComprada').val('');
		$('#fechaCompra').val('');
		$('#claveCompra').val('');
	}

	$scope.setMessage = function(selector, message) {
		$('#' + selector).focus();
		$('#' + selector).val('');
		$scope.events.error = message;
	}

	$scope.sayHi = function() {
		setTimeout(function() {
			alert('hi!');
		}, 1000);
	}

	$scope.reloadState = function(){
		$state.go($state.current, {}, {
			reload : true
		});
	}

	$scope.changeStatus = function(idPartida, idEstado) {
		$http({
			url : urlRequisiciones + 'cambiarStatusPartida/' + idPartida + '/' + idEstado,
			method: "POST",
			data: $scope.dataLocal,
		})
		.success(function(data) {
			$state.go($state.current, {}, {
				reload : true
			});
		});
	}

	$scope.getTotalRequisitado = function (id){
		$http.get(urlRequisiciones + 'searchTotalOrdCompra/' + id).success(function(data) {
				$scope.dataRetrive.cantTotal = data['total'];
				var resultado = Math.abs($scope.dataRetrive.cantidad - $scope.dataRetrive.cantTotal);
				if (parseFloat($scope.object.cantComprada) > parseFloat(resultado)) {
						$scope.setMessage('cantComprada', 'La cantidad a acomulada en ordenes de compra no puede ser mayor a la cantidad Requisitada.');
				} else {
						DatosCompraFactory.setIdPartida($scope.dataRetrive.idDetalle);
						DatosCompraFactory.setOrdenCompra($scope.object.idCentroCostos + '-' + $scope.object.ordenCompra);
						DatosCompraFactory.setCantidadComp($scope.object.cantComprada);
						$scope.object.fechaCompra = $('#fechaCompra').val();
						DatosCompraFactory.setFecha($scope.object.fechaCompra);
						$scope.guardarRegistro();
				}
		 }).error(function(data, status, headers, config) {
		 		$scope.dataRetrive.cantTotal = 'Error';
		});
	};

});

// FIN CONTROLLER

/************************************* UI ROUTER ***************************************************/
app.config(function($stateProvider, $urlRouterProvider) {
	$stateProvider.state('listado', {
		url : '/listado',
		templateUrl : '../../scripts/requisiciones/compras/views/todoTable.php',
		controller : 'comprasCtrl'
	}).state('compras', {
		url : '/compras/{id}',
		templateUrl : '../../scripts/requisiciones/compras/views/' + vista,
		params : {
			portfolioId : null,
		},
		controller : 'comprasCtrl',
	}), $urlRouterProvider.otherwise('listado');
});

app.factory('DatosCompraFactory', function() {
	return {
		data : {
			idPartida : '---',
			ordenCompra : '---',
			cantidad : '---',
			fecha : '---',
		},
		setIdPartida : function(value) {
			this.data.idPartida = value;
		},
		setOrdenCompra : function(value) {
			this.data.ordenCompra = value;
		},
		setCantidadComp : function(value) {
			this.data.cantidad = value;
		},
		setFecha : function(value) {
			this.data.fecha = value;
		},
	};
});

app.factory('ResponsesFactory', function(){
	return {
		data : {
			mensaje : '--',
			priority : '--',
		},
		setMensaje : function(value){
			this.data.mensaje = value;
		},
		setPriority : function(value){
			this.data.priority = value;
		},
	};
});

app.directive('myEnter', function() {
	return function(scope, element, attrs) {
		element.bind("keydown keypress", function(event) {
			if (event.which === 13) {
				scope.$apply(function() {
					scope.$eval(attrs.myEnter);
				});
				event.preventDefault();
			}

			if (event.keyCode == 13) {

			}
		});
	};
});

app.directive('ngConfirmClick', [
function() {
	return {
		link : function(scope, element, attr) {
			var msg = attr.ngConfirmClick || "Are you sure?";
			var clickAction = attr.confirmedClick;
			element.bind('click', function(event) {
				setTimeout(function() {
					alert('hi!');
				}, 1000);
			});
		}
	};
}]);

app.directive('cambiarStatus', function($http) {
	return {
		restrict : 'E',
		template : '<button class="btn btn-danger btn-sm" onclick="eliminarReq()">' + 'Eliminar Requisicion' + '</button>',
		link : function(scope, el, attr) {

		}
	}
});

app.directive('rechazarReq', function($http) {
	return {
		restrict : 'E',
		template : '<button class="btn btn-info btn-sm" onclick="rechazarReq()">' + 'Rechazar Requisicion' + '</button>',
		link : function(scope, el, attr) {

		}
	}
});

app.directive('editarPartidas', function($http) {
	return {
		restrict : 'E',
		template : '<button type="button" class="btn btn-primary btn-sm" onclick="actualizarReq()">' + 'Editar Requisicion' + '</button>',
		link : function(scope, el, attr) {

		}
	}
});

app.directive('descargarRequisicion', function($http) {
	return {
		restrict : 'E',
		template : '<button class="btn btn-warning btn-sm" onclick="descargarReq()">' + 'Descargar <i class="glyphicon glyphicon-save-file"></i>' + '</button>',
		link : function(scope, el, attr) {

		}
	}
});

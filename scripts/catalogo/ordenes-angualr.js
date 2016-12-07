var app = angular.module('centroCostosApp', ['ui.router', 'ui.grid', 'ui.grid.selection']);
app.controller('centroCostosCtrl', function($scope, $http, comprasFactory, $state) {
	$scope.filterTerm;
    $scope.ceco;


    $scope.asignaDatos = function (){
        comprasFactory.data.idCompra = $scope.ceco.idCompra;
        comprasFactory.data.OrdenComp = $scope.ceco.OrdenComp;
        comprasFactory.data.ClaveProv = $scope.ceco.ClaveProv;
        $scope.guardarRegistro();
       // print_r(comprasFactory.data);
    }

    $scope.cancelar = function (){
        $scope.ceco = [];
    }

    $scope.usuarios = {
     	enableFiltering: true,
     	enableRowSelection: true,
     	enableRowHeaderSelection: false,
     	modifierKeysToMultiSelect: true,
     	multiSelect: true,
        columnDefs: [
            //idCompra, OrdenComp, ClaveProv
            { field: 'idCompra', displayName: 'Clave', visible: true }, //0
            { field: 'OrdenComp', visible: true }, //1
            { field: 'ClaveProv',  displayName: 'Cliente', visible: true }, //1
        ],
		onRegisterApi: function(gridApi){
            $scope.gridApi = gridApi;
            gridApi.selection.on.rowSelectionChanged($scope,function(rows){
                $scope.myClickHandler(gridApi.selection.getSelectedRows());
            });
	    },
			//	 showGridFooter: true,
		}; 

		$scope.filterGrid = function(value) {
			$scope.gridApi.grid.columns[5].filters[0].term=value;
		};

        $scope.myClickHandler = function(rowItem) {
           // $scope.ceco = [];
            $scope.ceco = rowItem[0];
            if(rowItem[0]['idCompra']){
            $scope.titulo = 'Modificar Centro Costos';
            $("#idCompra").prop('disabled', true);
            $("#modal-footer").html('<button type="button" ng-click="cancelar()" class="btn btn-default btn-sm" data-dismiss="modal">Cancelar</button>'
					         + '<button type="button" onclick="eliminarRegistro()" class="btn btn-danger btn-sm">Eliminar</button>'
                             + '<input type="submit" class="btn btn-primary btn-sm" value=" Modificar" />');                             
            $("#memberModal").modal();
            }
        }

        $scope.openModal = function(){
            $scope.ceco = [];
            $scope.titulo = 'Registrar nuevo Centro Costos';
            $("#modal-footer").html('<button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Cancelar</button>'
					         + '<input type="submit" class="btn btn-primary btn-sm" value="Guardar" />');
            $("#memberModal").modal();
            $("#idCompra").prop('disabled', false);
        }

        $scope.set_flashdata = function(message, priority){
            $("#msj").html('<div id="msjAlert" class="alert alert-'+ priority +' alert-dismissable">' + '<button type="button" class="close" ' + 'data-dismiss="alert" aria-hidden="true">' + '&times;' + '</button><strong>'+ message +'</strong></div>');
            $("#msjAlert").fadeTo(1000, 200).slideUp(200, function(){
            $("#msjAlert").slideUp(200);
            $scope.loadData(); });   
        }

		$scope.guardarRegistro = function() {
			$scope.dataLocal = comprasFactory.data;	
                $http({
                    url : urlCatalogo + 'saveAcceso',
                    method : "POST",
                    data : $scope.dataLocal,
                }).success(function(data) {
                if (data = "insertado") {
                    $scope.set_flashdata('Se agrego el centro de costos!', 'success');
                    location.reload();
                }
                if(data = "actualizado"){
                    $scope.set_flashdata('Se actualizo la informacion del centro de costos', 'success');
                    //location.reload();
                } else {
                    $scope.set_flashdata('No se pudo completar la transaccion.', 'info');
                }
                    $('#memberModal').modal('hide');
                    $scope.ceco = [];
                     $scope.gridApi.core.refresh();          
            }).error(function(){
                    $scope.set_flashdata('No se pudo completar la transaccion.', 'info');
                    $('#memberModal').modal('hide');
         });
	}

	$scope.eliminar = function(id) {
        comprasFactory.data.idCompra = $scope.ceco.idCompra;  
		$http.get(urlCatalogo + 'eliminaCentroCostos/' + comprasFactory.data.idCompra).success(function(data) {
			$scope.set_flashdata('Se elimino la partida correctamente!', 'danger');
            	$('#memberModal').modal('hide');  
            	location.reload();
		}).error(function(data, status, headers, config) {

		});
	};	    

 	     
/******************************  EVENTOS  *************************/
        $("#btnEliminar").click(function(){
           /// alert('salkdsamdklsaldadjkasldjals');
        });

	});//Fin Controlador

/************************************* UI ROUTER ***************************************************/
app.config(function($stateProvider, $urlRouterProvider) {
	$stateProvider.state('listado', {
		url : '',
		controller : 'centroCostosCtrl'
	}), $urlRouterProvider.otherwise('listado');
});

app.factory('comprasFactory', function(){
	return {
		data : {
			idCompra : 'idCompra',
			OrdenComp : '--',
			ClaveProv : '--',
		},
	};
});


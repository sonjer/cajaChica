var app = angular.module('centroCostosApp', ['ui.router', 'ui.grid', 'ui.grid.selection']);
app.controller('centroCostosCtrl2', function($scope, $http, centroCostosFactory, $state) {
	$scope.filterTerm;
    $scope.ceco;

    $scope.loadData = function () {
		$http.get(urlCatalogo + 'getInsumos/' + centroCostosFactory.data.idInsumo).success(function(data, status, headers, config) {
			$scope.usuarios.data  = data['data'];
            $scope.gridApi.core.refresh();
         //   print_r($scope.usuarios.data);
	     }).error(function(data, status, headers, config) {
                // log` error
	    });	
    }

    $scope.asignaDatos = function (){
        centroCostosFactory.data.idInsumo = $scope.ceco.idInsumo;
        centroCostosFactory.data.descripcion = $scope.ceco.descripcion;
        centroCostosFactory.data.unidad = $scope.ceco.unidad;
        $scope.guardarRegistro();
       // print_r(centroCostosFactory.data);
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
            //idInsumo, descripcion, unidad
            { field: 'idInsumo', displayName: 'Clave', visible: true }, //0
            { field: 'descripcion', visible: true }, //1
            { field: 'unidad',  displayName: 'Cliente', visible: true }, //1
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
            if(rowItem[0]['idInsumo']){
            $scope.titulo = 'Modificar Centro Costos';
            $("#idInsumo").prop('disabled', true);
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
            $("#idInsumo").prop('disabled', false);
        }

        $scope.set_flashdata = function(message, priority){
            $("#msj").html('<div id="msjAlert" class="alert alert-'+ priority +' alert-dismissable">' + '<button type="button" class="close" ' + 'data-dismiss="alert" aria-hidden="true">' + '&times;' + '</button><strong>'+ message +'</strong></div>');
            $("#msjAlert").fadeTo(1000, 200).slideUp(200, function(){
            $("#msjAlert").slideUp(200);
            $scope.loadData(); });   
        }

		$scope.guardarRegistro = function() {
			$scope.dataLocal = centroCostosFactory.data;	
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
        centroCostosFactory.data.idInsumo = $scope.ceco.idInsumo;  
		$http.get(urlCatalogo + 'eliminaInsumos/' + centroCostosFactory.data.idInsumo).success(function(data) {
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
		controller : 'centroCostosCtrl2'
	}), $urlRouterProvider.otherwise('listado');
});

app.factory('centroCostosFactory', function(){
	return {
		data : {
			idInsumo : 'idInsumo',
			descripcion : 'descripcion',
			unidad : 'unidad',
            id_Clase: 'id_Clase',
            id_Grupo: 'id_Grupo',
            id_Subg: 'id_Subg',
		},
	};
});


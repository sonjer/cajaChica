var formats = [moment.ISO_8601, "YYYY-MM-DD  :)  HH*mm*ss"];
var app = angular.module('myApp', ['scrollable-table', 'ngMask', 'xeditable', 'moment-picker']);

app.run(function(editableOptions, editableThemes) {
  editableOptions.theme = 'bs3';
  editableThemes['bs3'].submitTpl = '';
  editableThemes['bs3'].cancelTpl = '';
 // editableThemes['bs3'].inputclass = 'form-sm';
});

 app.config(['momentPickerProvider', function (momentPickerProvider) {
        momentPickerProvider.options({
            /* Picker properties */
            locale:        'es',
            format:        'L',
            minView:       'year',
            maxView:       'day',
            startView:     'month',
            autoclose:     true,
            today:         true,
            keyboard:      false,

            /* Extra: Views properties */
            leftArrow:     '&larr;',
            rightArrow:    '&rarr;',
            yearsFormat:   'YYYY',
            monthsFormat:  'MMM',
            daysFormat:    'D'
        });
    }]);

app.controller('editarRequisicionCtrl', function($scope, $http, $filter) {
$scope.priority = "hidden";

$scope.init = function () {
	$http.get(urlRequisiciones + 'getReqDetails/' + claveCompuesta).success(function(data, status, headers, config) {
			angular.forEach(data['data'], function(value, key){
				  var obj = {};
			 		obj.idPartida = key;
			 		obj.idDetalle = data['data'][key]['idDetalle'];
			 		obj.claveCompuesta = data['data'][key]['claveCompuesta'];
			 		obj.idInsumo = data['data'][key]['idInsumo'];
					obj.descripcion = data['data'][key]['descripcion']
					obj.cantidad = data['data'][key]['cantidad'];
					obj.unidad = data['data'][key]['unidad'];		 		
			 		obj.fecha = data['data'][key]['fecha'];
			 		obj.comentarios = data['data'][key]['comentarios'];
// ordenCompra, cantComprada, fechaCompra
					obj.ordenCompra = data['data'][key]['ordenCompra'];
					obj.cantidadComp = data['data'][key]['cantComprada'];
					obj.fechaCompra = data['data'][key]['fechaCompra'];

			 		$scope.detallesList.push(obj);
			 });
		 }).error(function(data, status, headers, config) {
		  	alert("Se ha producido un error al cargar la lista de insumos requisitados");		// log error
	});
};

$scope.copyObj = function (){
	$scope.datosCompraList = [];

	angular.forEach($scope.detallesList, function(value, key) {

		if (value.ordenCompra !== null || value.cantidadComp !== null || value.fechaCompra !== null) {
				
			var datosCompra = {};
			datosCompra.idDetalle = value.idDetalle;
			datosCompra.idPartida = value.idDetalle;
			datosCompra.ordenCompra = value.ordenCompra;
			datosCompra.cantidad = value.cantidadComp;
			datosCompra.fecha = value.fechaCompra;
			$scope.datosCompraList.push(datosCompra);
			
		} else {
			$scope.respuesta = "Aun quedan partidas sin completar.";
			$scope.priority = "alert alert-info";						
		}

    });
	$scope.GuardarReq($scope.datosCompraList);
}	 


  // add user
  $scope.addUser = function() {
    $scope.inserted = {
      id: $scope.users.length+1,
      name: '',
    };
    $scope.users.push($scope.inserted);
  };

  $scope.setName = function (idx) {
	$("#insumosRow").autocomplete({
		source : urlRequisiciones + 'autoCompleteInsumos',
		minLength : 1,
		select : function(event, ui) {
			$scope.detallesList[idx]['idInsumo'] = ui.item.id;
			$scope.detallesList[idx]['descripcion'] = ui.item.descripcion;
			$scope.detallesList[idx]['cantidad'] = '';
			$scope.detallesList[idx]['unidad'] = ui.item.unidad;
			$scope.detallesList[idx]['comentarios'] = '';
			angular.element('#cant'+ idx).triggerHandler('click');
		}
	});
   };

$scope.setDate = function(idx){
	$("#fechaInsumo").datepicker({
		minDate : 0,
		beforeShowDay : $.datepicker.noWeekends,
		changeMonth : true,
		dateFormat : 'yy-mm-dd',
	    onSelect: function(selected,evnt) {
			$scope.detallesList[idx]['fecha'] = selected;
			$scope.detallesList[idx]['fechaCompra'] = "0";	    	
		    $('#dateModal').modal('toggle');
	    },		
	});
}

$scope.setFechaCompra = function(idx){
	$("#dateCompraModal").modal();
	var fechaInsumo = moment($scope.detallesList[idx]['fecha'], 'YYYY/MM/DD');
	var month = fechaInsumo.format('MM');
	var day   = fechaInsumo.format('DD');
	var year  = fechaInsumo.format('YYYY');

	$("#fechaCompra").datepicker({
		minDate : new Date(year, month - 1, day),
		beforeShowDay : $.datepicker.noWeekends,
		changeMonth : true,
		dateFormat : 'yy-mm-dd',
	    onSelect: function(selected, evnt) {
		  	$scope.detallesList[idx]['fechaCompra'] = selected;	    	
		    $('#dateCompraModal').modal('toggle');
		    $("#fechaCompra").datepicker( "destroy" );
	    },		
	});
}

$scope.$watch('detallesList', function (newValue, oldValue) {
   for(var i = 0; i < newValue.length; i++) {
      if(newValue[i].idInsumo != oldValue[i].idInsumo)
        var indexOfChangedItem = i;
   }
		if(typeof indexOfChangedItem !== "undefined"){
		 $scope.searchInsumo(newValue[indexOfChangedItem].idInsumo, oldValue[indexOfChangedItem].idInsumo, indexOfChangedItem);
	 		
		} 

}, true);


$scope.searchInsumo = function (id, oldValue, idx){

	$http.get(urlRequisiciones + 'searchInsumo/' + id).success(function(data) {
			$scope.detallesList[idx]['idInsumo'] = data['idInsumo'];
			$scope.detallesList[idx]['descripcion'] = data['descripcion'];
			$scope.detallesList[idx]['cantidad'] = '';
			$scope.detallesList[idx]['unidad'] = data['unidad'];
	 }).error(function(data, status, headers, config) {
	 	$scope.searchInsumo(oldValue, 0, idx);
	});

};


	$scope.onSelect = function(selection) {
		console.log(selection);
		$scope.selectedData = selection;
	};

	$scope.clearInput = function() {
		$scope.$broadcast('simple-autocomplete:clearInput');
	};


$scope.cambiarMarcara = function(idx){
	//alert($scope.detallesList[idx]['unidad']);
	switch ($scope.detallesList[idx]['unidad']) {
	    case 'PZA':
	        changeMask("##0000");
	        break;
			case 'KGS':
			    changeMask("##0.00");
			    break;
			case 'MT2':
					changeMask("##0.00");
				  break;
			case 'SRV':
				changeMask("0");
				break;
	}	
}

$scope.GuardarReq = function(data) {

	var data_str = angular.toJson(data);

	$.ajax({
		type : 'post',
		url : urlRequisiciones + 'saveJson',
		data : {
			source1 : data_str
		},
		beforeSend : function() {
			$("#btnGuardar").prop('disabled', true);
		},
		success : function(data) {
			$("#btnGuardar").prop('disabled', false);

			$scope.detallesList = [];
			$scope.init();
			//location.reload();
		},
		error : function(request, status, error) {
			//location.reload();
		}
	});

};

$scope.eliminaPartida = function(id) {
	$http.get(urlRequisiciones + 'datosCompra_delete_pro/' + id).success(function(data) {
		$scope.Message(data, "alert alert-success");
	 }).error(function(data, status, headers, config) {
			$scope.respuesta = status;
			$scope.priority = "alert alert-danger";	 	
	});
};

$scope.Message = function (msj, priority){
	$scope.detallesList = [];
	$scope.init();

	$scope.respuesta = msj;
	$scope.priority = priority;	
}
/********************************************************************************************/

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

		data.ordenCompra = "";
		data.cantidad = "";
		data.fecha = "";
		$scope.detallesList.push(data);
	//	print_r($scope.detallesList);
		$scope.limpiarInput();
	}

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
  $scope.CloseRespuesta = function(){
		$scope.respuesta = "";
		$scope.priority = "";
  }	

});
// FIN CONTROLLER



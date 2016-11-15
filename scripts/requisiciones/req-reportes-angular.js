var app = angular.module('reportes', ['scrollable-table']);
app.controller('ReportesCtrl', function($scope, $http) {
	
	$http.get(urlRequisiciones + 'getvistaRequisiciones').success(function(data, status, headers, config) {
		$scope.requisiciones = data['data'];
		/* alert(data['data'][0]['idCentroCostos']);	
		
		for (var key in requisiciones) {

		}		*/
			
	}).error(function(data, status, headers, config) {

	});
	
	$scope.firstName = "John";
    $scope.lastName = "Doe";

});
// FIN CONTROLLER

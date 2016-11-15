$(document).ready(function() {

	
			$(document).on('click', '.box-stats', function() {
				$("#estado").val($(this).attr("data-id"));
				reporte($("#estado").val());
			});	
			
			$(document).on('click', '#btnExportar', function() {
				
				ExportarRep($("#estado").val());
			});				
	
//btnExportar
});
// fin JQUERY

function reporte(data) {
	//idCentroCostos, consecutivo, idCliente, obra, fecha, usuario, estadoa
	var table = $('#example').DataTable({
		destroy : true,
		"ajax" : urlRequisiciones + 'getvistaRequisiciones/' + data,
		"columns" : [{
			"data" : "idCentroCostos"
		}, {
			"data" : "consecutivo"
		}, {
			"data" : "idCliente"
		}, {
			"data" : "obra"
		}, {
			"data" : "fecha"
		}, {
			"data" : "usuario"
		}, {
			"data" : "estado"
		}],
		scrollY : '45vh',
		scrollCollapse : true,
		paging : false,
		"language" : {
			"sInfo" : "Registros totales: _TOTAL_"
		},
	});

}

ExportarRep = function(id) {
		// http://www.iicom.mx/intranet/requisiciones/pdfTodoCentroDeCostos/1
	window.location.href = urlReportes + 'pdfTodoCentroDeCostos/' + id;		

}

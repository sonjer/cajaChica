<link href="<?php echo base_url(); ?>styles/ui-grid.min.css" rel="stylesheet" type="text/css">
<link href="<?php echo base_url(); ?>bootstrap/css/bootstrap-table.css" rel="stylesheet" type="text/css">
<style>.ui-grid-filter-container { display: none!important; }</style>
<div  id="requisicionID" ng-app="centroCostosApp" ng-controller="centroCostosCtrl" class="white-area-content">
	<!-- INICIO CONTROLLER -->
	<div id="msj"></div>
	<div>
		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-warning height">
					<div class="panel-heading">
						<span class="glyphicon glyphicon-user"></span> LISTA DE ORDENES DE COMPRAS
					</div>
					<div>
					<b><script type="text/javascript" > var meses = new Array ("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre"); var diasSemana = new Array("Domingo","Lunes","Martes","Miércoles","Jueves","Viernes","Sábado"); var f=new Date(); document.write(diasSemana[f.getDay()] + " " + f.getDate() + " de " + meses[f.getMonth()] + " de " + f.getFullYear()); </script><b><br>
					<script type="text/javascript" > function startTime(){ today=new Date(); h=today.getHours(); m=today.getMinutes(); s=today.getSeconds(); m=checkTime(m); s=checkTime(s); document.getElementById('reloj').innerHTML=h+":"+m+":"+s; t=setTimeout('startTime()',500);} function checkTime(i) {if (i<10) {i="0" + i;}return i;} window.onload=function(){startTime();} </script>
					<b><div id="reloj" ></div><b>
					</a>
					</div>
					<div class="panel-body">
						<table
						    id="table2"
						    ng-init="loadData()"
						    data-height="430"
						    data-click-to-select="true"
						    data-search="true">
						  <thead>
						    <tr>
									<th data-field="state" data-checkbox="true" data-formatter="stateFormatter"></th>
									<th data-field="idCompra">IDCOMP</th>
									<th data-field="CveSuc">CLIENTE</th>
									<th data-field="NoOrden">#ORDEN-COMP</th>
									<th data-field="NomProv">PROVEEDOR</th>
									<th data-field="SubtPed" >SUBTOTAL</th>
									<th data-field="TotalPed" >TOTAL</th>
									<th data-field="StatusPart" >STATUS PART.</th>
									<th data-field="FalltaPed">FECHA PEDIDO</th>
									<th data-field="NomUser" >USUARIO</th>
									<th data-field="statusAut">STATUS AUT.</th>
									<th data-field="FechHoraAut">FECHA Y HORA AUT.</th>
						    </tr>
						  </thead>
						</table>
					</div>
				</div>
			</div>
		</div>
		<div class="row">

		</div>
	</div>

	<div class="modal fade" id="memberModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
					<h4 class="modal-title" id="myModalLabel"><strong>{{titulo}}</strong></h4>
				</div>
				<form class="form-horizontal" ng-submit="asignaDatos()">
				<div class="modal-body">

					<div class="form-group">
						<label for="email-in" class="col-md-3 label-heading">Clave</label>
						<div class="col-md-9">
							<input type="text" id="idCentroCostos" class="form-control input-sm" ng-model="ceco.idCentroCostos" required>
						</div>
					</div>
					<div class="form-group">
						<label for="username-in" class="col-md-3 label-heading">Descripción</label>
						<div class="col-md-9">
                            <input type="text" class="form-control input-sm" ng-model="ceco.descripcion" required>
						</div>
					</div>
					<div class="form-group">
					<label for="name-in" class="col-md-3 label-heading">Cliente</label>
						<div class="col-md-9">

						</div>
					</div>
				</div>
				<div id="modal-footer" class="modal-footer">
				</div>
				</form>
			</div>
		</div>
	</div>

	<!-- FIN CONTROLLER -->
	<script src="<?php echo base_url(); ?>bootstrap/js/ui-grid.min.js"></script>
	<script>
	$('#table2').on('check.bs.table', function (e, row) {
	//	print_r(row);
		angular.element($('#requisicionID')).scope().aprobar(row);

	});

	$('#table2').on('uncheck.bs.table', function (e, row) {

		console.log(row);
	});

	function stateFormatter(value, row, index) {
         if (value === 'false') {
             return {
              //   disabled: true,
                 checked: false
             }
         }
         return value;
     }
	</script>
	<script>
    var $table = $('#table2'),
        $button = $('#data-checkbox');
    $(function () {
        $button.click(function () {
            $table.bootstrapTable('refresh');
        });
    });
</script>

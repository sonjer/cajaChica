<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="<?php echo base_url(); ?>styles/ui-grid.min.css" rel="stylesheet" type="text/css">
<link href="<?php echo base_url(); ?>bootstrap/css/bootstrap-table.css" rel="stylesheet" type="text/css">

<style>.ui-grid-filter-container { display: none!important; }</style>
<div  id="requisicionID" ng-app="centroCostosApp" ng-controller="centroCostosCtrl" class="white-area-content">
	<!-- INICIO CONTROLLER -->
	<div id="msj"></div>
		<div class="row">
		<div class="col-md-12">
			<div class="panel panel-warning height">

					  <div class="panel-heading">
					  	<span class="glyphicon glyphicon-user"></span> LISTA DE ORDENES DE COMPRAS
				     </div>
					<div class="alert alert-info" role="alert">
					  <b><script type="text/javascript" > var meses = new Array ("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre"); var diasSemana = new Array("Domingo","Lunes","Martes","Miércoles","Jueves","Viernes","Sábado"); var f=new Date(); document.write(diasSemana[f.getDay()] + " " + f.getDate() + " de " + meses[f.getMonth()] + " de " + f.getFullYear()); </script><b><br>
					  <script type="text/javascript" > function startTime(){ today=new Date(); h=today.getHours(); m=today.getMinutes(); s=today.getSeconds(); m=checkTime(m); s=checkTime(s); document.getElementById('reloj').innerHTML=h+":"+m+":"+s; t=setTimeout('startTime()',500);} function checkTime(i) {if (i<10) {i="0" + i;}return i;} window.onload=function(){startTime();} </script>
					  <b><div id="reloj" ></div><b>
					  </a>
					</div>
					<h4 align="center">SELECCIONE UNA ORDEN DE COMPRA PARA AUTORIZAR</h4>
             <div class="panel-body">
							 <form id="mw_contacto_frm" name="mw_contacto_frm" action="../mail.php" method="post">
 					<table cellpadding="0" cellspacing="0" align="center">
 						<tr><td>Escriba su nombre: </td></tr>
 						<tr><td><input type="text" id="nombre" name="nombre" tabindex="1" class="mw_contacto_inputs" maxlength="255" required="required" value="" placeholder="Nombre" /></td></tr>
 						<tr><td>Escriba su e-mail (sunombre@dominio.com): </td></tr>
 						<tr><td><input type="email" id="email" name="email" tabindex="2" class="mw_contacto_inputs" maxlength="255" required="required" value="" placeholder="Correo electronico" /></td></tr>
 						<tr><td>Escriba su tel&eacute;fono (10 d&iacute;gitos): </td></tr>
 						<tr><td><input type="text" id="telefono" name="telefono" tabindex="3" class="mw_contacto_inputs" maxlength="255" value="" placeholder="Telefono" /></td></tr>
 						<tr><td>Escriba su mensaje: </td></tr>
 						<tr><td><textarea type="text" id="comentarios" name="com" tabindex="14" class="mw_contacto_inputs" maxlength="255" required="required" value="" placeholder="Comentarios adicionales" style="height:82px;"></textarea></td></tr>
 						<tr><td align="center" style="text-align:center;"><input type="submit"  class="mw_contacto_btn" value="ENVIAR" title="ENVIAR" alt="ENVIAR" /></td></tr>
 					</table>

					  	<table  id="table2" ng-init="loadData()"data-height="430"  data-click-to-select="true"data-search="true">
						  <thead>
						    <tr>
									<th data-field="statusAut" data-checkbox="true" data-formatter="stateFormatter"></th>
									<th data-field="idCompra">IDCOMP</th>
									<th data-field="CveSuc">CLIENTE</th>
									<th data-field="NoOrden">ORDEN-COMP</th>
									<th data-field="NomProv">PROVEEDOR</th>
									<th data-field="SubtPed" >SUBTOTAL</th>
									<th data-field="TotalPed" >TOTAL</th>
									<th data-field="StatusPart" >STATUS PART.</th>
									<th data-field="FalltaPed">FECHA PEDIDO</th>
									<th data-field="NomUser" >USUARIO</th>
									<th data-field="FechHoraAut">FECHA Y HORA AUT.</th>
						    </tr>
						    </thead>
					    	</table>
             </form>
			</div>
		</div>
	</div>
</div>
		</div>
	<!-- FIN CONTROLLER -->
	<script src="<?php echo base_url(); ?>bootstrap/js/ui-grid.min.js"></script>
	<script>
	$('#table2').on('check.bs.table', function (e, row) {
	//	print_r(row);
	         var array = {data: row};
	         var paramJSON = JSON.stringify(array);
 //	print_r(JSON.stringify(array));
            console.log(array);
	          $.ajax({
							    data: {"parametro1" : "valor1", "parametro2" : "valor2"},
									type: "GET",
									dataType: "json",
									url: 'http://localhost/correo/mail.php',
								})
				 .done(function( data, textStatus, jqXHR ) {
				     if ( console && console.log ) {
				         console.log( "La solicitud se ha completado correctamente." );
				     }
				 })
				 .fail(function( jqXHR, textStatus, errorThrown ) {
				     if ( console && console.log ) {
				         console.log( "La solicitud a fallado: " +  textStatus);
				     }
				});


		angular.element($('#requisicionID')).scope().aprobar(row);

	});

	$('#table2').on('uncheck.bs.table', function (e, row) {

		console.log(row);

	});

	function stateFormatter(value, row, index) {
         if (value === 'Autorizada') {
             return {
                 disabled: true,
                 checked: true
             }
         }
         return value;
     }
	</script>

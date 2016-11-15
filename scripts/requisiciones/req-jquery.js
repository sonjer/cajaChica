var insumoObj = {};
var jsonResponse;

function setData(insumoObj1) {
	return insumoObj1;
}

function RemoveHidden() {
	$("#busquedaForm").addClass("hidden");
	$("#busqueda").removeClass("hidden");
}

function Pass(data_str) {
	$.ajax({
		type : 'post',
		url : urlRequisiciones + 'saveJson',
		data : {
			source1 : data_str
		}
	});
}

CancelarReq = function(data_str) {
	location.reload();
	$("#msj").html('<div class="alert alert-warning alert-dismissable">' + '<button type="button" class="close" ' + 'data-dismiss="alert" aria-hidden="true">' + '&times;' + '</button><strong>Se ha cancelado la captura</strong></div>');
}
GuardarReq = function(data_str) {
	var formData = {
		'consecutivo' : $('#consecutivo').val(),
		'idCliente' : $('#cliente_id').val(),
		'idCentroCostos' : $('#ccostos_id').val(),
		'obra' : $('#obra').val()
	};

	$.ajax({
		type : 'post',
		url : urlRequisiciones + 'saveReq2',
		data : {
			source1 : formData,
			source2 : data_str
		},
		beforeSend : function() {
			$("#btnGuardar").prop('disabled', true);
			// disable button
		},
		success : function(data) {
			$("#btnGuardar").prop('disabled', false);
			location.reload();
		},
		error : function(request, status, error) {
			//	alert(request.responseText);
		}
	});
}

function AddHidden() {
	$("#busquedaForm").removeClass("hidden");
	$("#busqueda").addClass("hidden");
}

function values(id) {
	$("#insumos").val(id);
	buscarInsumos(id);
	AddHidden();
}

(function($) {//inicio JQUERY
	var ccostosID;
	var clienteID;
	var insumoID;
	var formats = [moment.ISO_8601,
	// "DD/MM/YYYY  :)  HH*mm*ss"
	"YYYY-MM-DD  :)  HH*mm*ss"];

	function changeMask(maskara) {
		$('#cantidad1').mask(maskara, {
			reverse : true
		});
	}


	$('#cantidad1').keydown(function() {
		switch (insumoObj.unidad) {
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
	});

	/* BUSCAR CLIENTE */
	$("#cliente").autocomplete({
		source : urlRequisiciones + "autoCompleteCliente",
		minLength : 1,
		select : function(event, ui) {
			clienteID = ui.item.id;
			$("#cliente_id").val(ui.item.id);
		}
	});

	/* FUNCIONES FECHA */

	$("#fechaInsumo").datepicker({
		minDate : 0,
		beforeShowDay : $.datepicker.noWeekends,
		changeMonth : true,
		dateFormat : 'yy-mm-dd'
	});

	$("#fechaInsumo").change(function() {
		if (moment("" + $("#fechaInsumo").val() + "  :)  13*17*21", formats, true).isValid() == false) {
			$(this).val("");
			$(this).focus();
		} else {
			$("#cantidad1").focus();
		}
	});

	function dateConvert(date) {
		var d = new Date(date.split("/").reverse().join("-"));
		var dd = d.getDate() + 1;
		var mm = d.getMonth() + 1;
		var yy = d.getFullYear();
		return yy + "/" + mm + "/" + dd;
	}

	/*  CLIENTES  */
	$("#cliente").change(function() {
		//	angular.element($('#requisicionID')).scope().claveCompuesta() = "";
		if (clienteID == null) {
			var campo = ($('#cliente').val());

			if (campo.length > 3) {
				campo.substr(0, 3);
				$("#cliente").val('');
				$("#cliente_id").val('');
				buscarCliente(campo);
			} else if (campo.length = 3) {
				$("#cliente").val('');
				$("#cliente_id").val('');
				buscarCliente(campo);
			}
		}
	});

	/* FIN */

	/* BUSCAR CENTRO DE COSTOS */
	$("#ccostos").autocomplete({
		source : urlRequisiciones + "autoCompleteCcostos",
		minLength : 1,
		select : function(event, ui) {
			ccostosID = ui.item.id;
			$("#ccostos_id").val(ui.item.id);
			$("#consecutivo").val(ui.item.consecutivo);
			$("#lblIdRequisiciones").html(ui.item.claveCompuesta);
		}
	});

	$("#ccostos").change(function() {
		//	angular.element($('#requisicionID')).scope().claveCompuesta() = "";
		if (ccostosID == null) {
			var campo = ($('#ccostos').val());

			if (campo.length > 5) {
				campo.substr(0, 5);
				$("#ccostos").val('');
				$("#ccostos_id").val('');
				buscarCentroCostos(campo);
			} else if (campo.length = 5) {
				$("#ccostos").val('');
				$("#ccostos_id").val('');
				buscarCentroCostos(campo);
			}
		}
	});
	/* FIN BUSCAR */

	/* BUSCAR INSUMOS */
	$("#insumos").autocomplete({
		source : urlRequisiciones + 'autoCompleteInsumos',
		minLength : 2,
		select : function(event, ui) {
			$("#insumos_id").val(ui.item.id);
			insumoID = ui.item.id;
			insumoObj.idInsumo = ui.item.id;
			insumoObj.descripcion = ui.item.descripcion;
			insumoObj.unidad = ui.item.unidad;
			$("#unidadlbl").html('<strong>' + ui.item.unidad + '<strong>');
			$("#fechaInsumo").focus();
			angular.element($('#requisicionID')).scope().nodetails();
		}
	});

	$("#insumos").change(function() {
		if (insumoID == null) {
			var campo = ($('#insumos').val());
			if (campo.length > 8) {
				campo.substr(0, 8);
				$("#insumos").val('');
				$("#insumos_id").val('');
				buscarInsumos(campo);
			} else if (campo.length = 8) {
				$("#insumos").val('');
				$("#insumos_id").val('');
				buscarInsumos(campo);
			}
		}
	});

	/* FIN INSUMOS */

	$.fn.floatLabels = function(options) {

		// Settings
		var self = this;
		var settings = $.extend({}, options);

		// Event Handlers
		function registerEventHandlers() {
			self.on('input keyup change', 'input, textarea', function() {
				actions.swapLabels(this);
			});
		}

		// Actions
		var actions = {
			initialize : function() {
				self.each(function() {
					var $this = $(this);
					var $label = $this.children('label');
					var $field = $this.find('input,textarea').first();

					if ($this.children().first().is('label')) {
						$this.children().first().remove();
						$this.append($label);
					}
					var placeholderText = ($field.attr('placeholder') && $field.attr('placeholder') != $label.text()) ? $field.attr('placeholder') : $label.text();

					//   $label.data('placeholder-text', placeholderText);
					$label.data('original-text', $label.text());

					if ($field.val() == '') {
						$field.addClass('empty')
					}
				});
			},
			swapLabels : function(field) {
				var $field = $(field);
				var $label = $(field).siblings('label').first();
				var isEmpty = Boolean($field.val());

				if (isEmpty) {
					$field.removeClass('empty');
					$label.text($label.data('original-text'));
				} else {
					$field.addClass('empty');
					$label.text($label.data('placeholder-text'));
				}
			}
		}

		// Initialization
		function init() {
			registerEventHandlers();

			actions.initialize();
			self.each(function() {
				actions.swapLabels($(this).find('input,textarea').first());
			});
		}

		init();
		return this;
	};

	$(function() {
		$('.float-label-control').floatLabels();
	});

})(jQuery);

function buscarCentroCostos(id) {
	var url;
	var ccostos = [];

	url = urlRequisiciones + 'getConsecutivoReq/' + id;
	$.getJSON(url).done(function(data) {
		$.each(data, function(i) {
			ccostos.push(data[i])
			var notnull = ccostos[0][0]['idCentroCostos'];
			if (notnull != null) {
				$("#ccostos").val(ccostos[0][0]['idCentroCostos'] + ' | ' + ccostos[0][0]['descripcion']);
				$("#ccostos_id").val(ccostos[0][0]['idCentroCostos']);
				$("#consecutivo").val(ccostos[0][0]['consecutivo']);
				$("#lblIdRequisiciones").html(ccostos[0][0]['claveCompuesta']);
			} else {
				$("#ccostoslbl").append("<span class='retry-again'><strong> ¡Intente de Nuevo!</strong></span>");
				$("#ccostos").focus();
			}
		});
	}).fail(function() {
		$("#ccostos").val('');
		$("#ccostos_id").val('');
		$("#consecutivo").val("");
		$("#lblIdRequisiciones").html("");
		$("#ccostoslbl").append("<span class='retry-again'><strong> ¡Intente de Nuevo!</strong></span>");
		$("#ccostos").focus();
	});
}

function buscarCliente(id) {
	var url;
	var cliente = [];

	url = urlRequisiciones + 'getWhereClientes/' + id;
	$.getJSON(url).done(function(data) {
		$.each(data, function(i) {
			cliente.push(data[i])
			var notnull = cliente[0][0]['idCliente'];
			if (notnull != null) {
				$("#cliente").val(cliente[0][0]['idCliente'] + ' | ' + cliente[0][0]['nombre']);
				$("#cliente_id").val(cliente[0][0]['idCliente']);
			} else {
				$("#clientelbl").append("<span class='retry-again'><strong> ¡Intente de Nuevo!</strong></span>");
				$("#cliente").focus();
			}
		});
	}).fail(function() {
		$("#cliente").val('');
		$("#cliente_id").val('');
		$("#clientelbl").append("<span class='retry-again'><strong> ¡Intente de Nuevo!</strong></span>");
		$("#cliente").focus();
	});
}


function buscarInsumos(id) {
	var url;
	var insumo = [];
	angular.element($('#requisicionID')).scope().nodetails();

	url = urlRequisiciones + 'getWhereInsumos/' + id;
	$.getJSON(url, function(data) {
		$.each(data, function(i) {
			insumo.push(data[i])
			$("#insumos").val(insumo[0][0]['idInsumo'] + ' | ' + insumo[0][0]['descripcion']);
			$("#insumos_id").val(insumo[0][0]['idInsumo']);
			$("#unidadlbl").html('<strong>' + insumo[0][0]['unidad'] + '<strong>');
			insumoObj.idInsumo = insumo[0][0]['idInsumo'];
			insumoObj.descripcion = insumo[0][0]['descripcion'];
			insumoObj.unidad = insumo[0][0]['unidad'];
			$('#cantidad1').val('');
			$("#fechaInsumo").focus();
		});
	}).fail(function() {

		$("#insumos").val('');
		$("#insumos_id").val('');
		$("#insumoslbl").append("<span class='retry-again'><strong> ¡Intente de Nuevo!</strong></span>");
		$("#insumos").focus();
	});
}

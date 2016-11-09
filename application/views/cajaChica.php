<link href="<?php echo base_url(); ?>styles/ui-grid.min.css" rel="stylesheet" type="text/css">

<style>
    .grid { height: 248px; } .ui-grid-filter-container { display: none!important; }
.form-control-inline {
    min-width: 0;
    width: auto;
    display: inline;
}
</style>
    <div  id="requisicionID" ng-app="insumosApp" ng-controller="insumosCtrl" class="white-area-content">
        <!-- INICIO CONTROLLER -->
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-warning height">
                    <div class="panel-heading">
                        <span class="glyphicon glyphicon-user"></span> FORMULARIO CAJA CHICA
                        <div class="db-header-extra">

                        </div>
                    </div>
                    <div class="panel-body">
                       <div class="row">
                        <?php echo form_open_multipart(site_url("admin/edit_member_pro"), array("class" => "form-horizontal")) ?>                    
                        <div class="col-xs-2">
                         <div class="input-group">
                          <div class="input-group-btn">
                           <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">CeCo <span class="caret"></span></button>
                           <ul class="dropdown-menu">
                            <li><a href="#">LG000</a></li>
                            <li><a href="#">LG001</a></li>
                            <li><a href="#">LG002</a></li>
                           </ul>
                          </div><!-- /btn-group -->
                         <input type="text" class="form-control" aria-label="...">
                        </div><!-- /input-group -->
                       </div><!-- /.col-xs-2 -->

                        <div class='form-group col-sm-4' id="apellidos_field_box">
                            <label class="control-label col-sm-3" id="fechaNacimiento_display"> FACTURA</label>
                            <div class='col-sm-9' id="apellidos_input_box">
                                <input id='txtapellidos' class='form-control input-sm' name='apellidos' placeholder="NUMERO DE FACTURA" type='text' value="" maxlength='100' />
                            </div>
                        </div>

                        <div class='form-group col-sm-4' id="fechaNacimiento_field_box">
                        <label class="control-label col-sm-5" id="fechaNacimiento_display"> FECHA</label>
                            
                        <div class="container">
                         <div class="row">
                          <div class='col-sm-2'>
                           <div class="form-group">
                            <div class='input-group date' id='datetimepicker1'>
                            <input type='text' class="form-control" />
                            <span class="input-group-addon">
                            <span class="glyphicon glyphicon-calendar"></span>
                           </span>
                          </div>
                          </div>
                         </div>
                         <script type="text/javascript">
                          $(function () {
                          $('#datetimepicker1').datetimepicker();
                          });
                         </script>
                        </div>
                       </div>
                        </div>                        

                        <div class='form-group col-sm-7' id="NSS_field_box">
                            <label class="control-label col-sm-2" id="NSS_display">PROVEEDOR</label>
                            <div class='col-sm-10' id="NSS_input_box">
                                    <input id='txtLproveedor' class='form-control input-sm' name='Proveedor' placeholder="Nombre Proveedor" type='text' value="" maxlength='100' />
                            </div>
                        </div>
                        <div class='form-group col-sm-7 pull-left' id="RFC_field_box">
                            <label class="control-label col-sm-2" id="RFC_display">DESCRIPCION</label>
                            <div class='col-sm-10' id="RFC_input_box">
                                <input id='txtdescripcion' class='form-control input-sm' name='Descripción' placeholder="Descripción" type='text' value="" maxlength='100' />

                            </div>
                        </div>
                        <div class='input-group col-sm-4' id="RFC_field_box">
                            <label class="control-label col-sm-3" id="RFC_display">IMPORTE</label>
                            <div class='col-sm-6' id="NSS_input_box">
                                 <input id='txtLimporte' class='form-control input-sm' name='Importe'  type='text' value="" maxlength='100' />
                            </div>
                        </div><br>
                        <div class='input-group col-sm-4' id="RFC_field_box">
                            <label class="control-label col-sm-3" id="RFC_display">I.V.A</label>
                            <div class='col-sm-6' id="NSS_input_box">
                                 <input id='txtLimporte' class='form-control input-sm' name='iva'  type='text' value="" maxlength='100' />
                            </div>
                        </div><br>
                        <div class='input-group col-sm-7' id="RFC_field_box">
                            <label class="control-label col-sm-3" id="RFC_display">MONTO TOTAL</label>
                            <div class='col-sm-3' id="NSS_input_box">
                                 <input id='txtLimporte' class='form-control input-sm' name='monto total'  type='text' value="" maxlength='100' />
                            </div>
                        </div><br>
                        <div class="row">
                            <div class="col-sm-5">
                                <button type="button" ng-click="eliminaUsuario()" class="btn btn-danger btn-sm">Cancelar</button>
                                <button type="submit" class="btn btn-primary btn-sm">Guardar Cambios</button>
                            </div>                                              
                        </div>                                                
                        <?php echo form_close() ?>
                    </div>
                </div>
            </div>
        </div>        
    </div>

    <div class="row">
        <div class="col-md-7">
            <div class="panel panel-warning height">
                <div class="panel-heading">
                    <span class="glyphicon glyphicon-user"></span> Datos Generales
                    <div class="db-header-extra">

                    </div>
                </div>
                <div class="panel-body">
                    <?php echo form_open_multipart(site_url("admin/edit_member_pro"), array("class" => "form-horizontal")) ?>

                    <div class='form-group col-sm-12' id="domicilio_field_box">
                        <label class="control-label col-sm-3" id="domicilio_display">SEMANA</label>
                        <div class='col-sm-3' id="domicilio_input_box">
                            <input id='txtdomicilio' class='form-control input-sm' name='domicilio' type='text' value="" maxlength='200' />
                        </div>
                    </div>

                    <div class='form-group col-sm-12' id="telefono_field_box">
                        <label class="control-label col-sm-3" id="telefono_display">FECHA</label>
                        <div class='col-sm-3' id="telefono_input_box">
                            <input id='txttelefono' class='form-control input-sm' name='telefono' type='text' value="" maxlength='25' />
                        </div>
                    </div>

                    <div class='form-group col-sm-12' id="beneficiarioNombre_field_box">
                        <label class="control-label col-sm-3" id="beneficiarioNombre_display">MONTO CAJA</label>
                        <div class='col-sm-3' id="beneficiarioNombre_input_box">
                            <input id='txtbeneficiarioNombre' class='form-control input-sm' name='beneficiarioNombre' type='text' value="" maxlength='200' />
                        </div>
                    </div>

                    <div class='form-group col-sm-12' id="beneficiarioParentesco_field_box">
                        <label class="control-label col-sm-3" id="beneficiarioParentesco_display">DIFERENCIA </label>
                        <div class='col-sm-3' id="beneficiarioParentesco_input_box">
                            <input id='txtbeneficiarioParentesco' class='form-control input-sm' name='beneficiarioParentesco' type='text' value="" maxlength='20' />
                        </div>
                    </div>

                    <div class='form-group col-sm-12' id="beneficiarioRFC_field_box">
                        <label class="control-label col-sm-3" id="beneficiarioRFC_display">SOLICITA</label>
                        <div class='col-sm-3' id="beneficiarioRFC_input_box">
                            <input id='txtbeneficiarioRFC' class='form-control input-sm' name='beneficiarioRFC' type='text' value="" maxlength='15' />
                        </div>
                    </div>

                    <div class='form-group col-sm-12' id="idEstatus_field_box">
                        <label class="control-label col-sm-3" id="idEstatus_display">CONSECUTIVO</label>
                        <div class='col-sm-3' id="idEstatus_input_box">
                            <input id='txtidEstatus' class='form-control input-sm' name='idEstatus' type='text' value="" maxlength='10' />
                        </div>
                    </div>

                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="button" ng-click="eliminaUsuario()" class="btn btn-danger btn-sm">Eliminar </button>
                        <button type="submit" class="btn btn-primary btn-sm">Guardar Cambios</button>
                    </div>
                </div>
                <?php echo form_close() ?>
            </div>
        </div>        
    </div>    
</div>
<blockquote>
  <p>Solo se puede eliminar al usuario siempre y cuando no tenga asignado Clientes o CeCo y no haya requisitado.</p>
</blockquote>
<script src="<?php echo base_url(); ?>bootstrap/js/ui-grid.min.js"></script>
 <script src=" https://framework-gb.cdn.gob.mx/assets/scripts/jquery-ui-datepicker.js"></script>
 <script src="<?php echo base_url(); ?>scripts/custom/inputmask.js"></script>
<script>
 /* BUSQUEDA DE CLIENTES Y CECO : REQUISITORES Y RESIDENTES */
function NumAndTwoDecimals(e , field) {
    var val = field.value;
    var re = /^([0-9]+[\.]?[0-9]?[0-9]?|[0-9]+)$/g;
    var re1 = /^([0-9]+[\.]?[0-9]?[0-9]?|[0-9]+)/g;
    if (re.test(val)) {
        //do something here

    } else {
        val = re1.exec(val);
        if (val) {
            field.value = val[0];
        } else {
            field.value = "";
        }
    }
}

$('#txtNSS').keyup(function() {
    var $th = $(this);
    $th.val( $th.val().replace(/[^a-zA-Z0-9]/g, function(str) {  return ''; } ) );
});

//$("#txtLugarNacimiento").mask("PEPF910227HVZRRR07");
//$("#txtCURP").inputmask({ mask: function () { /* do stuff */ return ["AAAA999999AAAAAA99"]; }});
$("#txtCURP").inputmask({ mask: "AAAA999999AAAAAA99"});

$("#txtCURP").blur(function(){
    var $th = $(this);
    var validation = validaCURP2($th.val());
    if(validation == false ){

    }
});

function validaCURP2(curp){
    var segRaiz = "";
    var digVer  = "";
    var lngSuma      = 0.0;
    var lngDigito    = 0.0;
    var strDigitoVer = "";
    var intFactor    = new Array(17);
    var chrCaracter  = "0123456789ABCDEFGHIJKLMN�OPQRSTUVWXYZ";

    segRaiz = curp.substring(0,17);
    digVer  = curp.substring(17,18);
    
    for(var i=0; i<17; i++)
    {
        for(var j=0;j<37; j++)
        {
            if(segRaiz.substring(i,i+1)==chrCaracter.substring(j,j+1))
            {               
                intFactor[i]=j;
            }
        }
    }
    
    for(var k = 0; k < 17; k++)
    {
        lngSuma= lngSuma + ((intFactor[k]) * (18 - k));
    }
    
    lngDigito= (10 - (lngSuma % 10));
    
    if(lngDigito==10)
    {
        lngDigito=0;
    }

    var reg = /[A-Z]{4}\d{6}[HM][A-Z]{2}[B-DF-HJ-NP-TV-Z]{3}[A-Z0-9][0-9]/;
    if(curp.search(reg))
    {
        alert("La curp: " + curp + " no es valida, verifiqu� ");
        return false;
        
    }
    
    if(!(parseInt(lngDigito)==parseInt(digVer)))
    {
        alert("La curp: " + curp + " no es valida, revis� el Digito Verificador (" +  lngDigito + ")");
        return false;
    }
    return true;
}
</script>
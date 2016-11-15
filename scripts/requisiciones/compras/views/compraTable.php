<div class="col-md-12">
  <div class="panel panel-warning height">
    <div class="panel-body">
      <div class="col-md-6"><strong>Insumo: </strong>{{dataRetrive.idInsumo}} | {{dataRetrive.descripcion}}
      </div>
      <div class="col-md-3"><strong>Cantidad: </strong>{{dataRetrive.cantidad}} {{dataRetrive.unidad}}
      </div>
      <div class="col-md-3"><strong>Fecha de Solicitud: </strong>{{dataRetrive.fecha | date : "dd/MM/y"}}
      </div>
    </div>
  </div>
</div>
<div class="col-md-8">
    <div class="panel panel-primary">
        <div class="panel-heading">
            Listado de ordenes de compra
            <div class="db-header-extra"><strong><i class="glyphicon glyphicon-refresh" ng-click="reloadState()"></i></strong></div>
        </div>
        <div class="panel-body">
            <scrollable-table watch="visibleProjects">
                <table id="contenido" class="table table-bordered table-over" ng-init="loadDatosCompra()" width="100%">
                    <tr>
                        <th >Orden Compra</th>
                        <th>Cantidad</th>
                        <th>UDM</th>
                        <th>Fecha</th>
                        <th style="width:1%"></th>
                    </tr>
                    <tr ng-repeat="vdc in vistaDatosCompra" ng-click='selecciona(vdc)'>
                        <td>{{vdc.ordenCompra || '---'}}</td>
                        <td>{{vdc.cantidad || '---'}}</td>
                        <td>{{dataRetrive.unidad || '---'}}</td>
                        <td>{{vdc.fecha || '---'}}</td>
                        <td>
                            <input type="button" class="btn btn-danger btn-xs btn-block" value="X" ng-click="eliminarPartida(vdc.idRow)">
                        </td>
                    </tr>
                </table>
            </scrollable-table>
            <data>{{descripcion}}  {{unidad}}</data>
        </div>
        <div class="panel-footer">
            <div class="button-group">
                <button class="btn btn-warning btn-sm" onclick="ShowOptions()" ui-sref="listado()">
                    Regresar
                </button>
                <strong>Comentarios: </strong><data>{{vdc.comentarios || 'Sin comentarios'}}</data>
            </div>
           <!-- <button confirmed-click="sayHi()" ng-confirm-click="Seguro que desea eliminar?">Eliminar</button>   -->
        </div>
    </div>
</div>
<div id="busquedaForm" class="col-md-4">
    <div class="panel panel-primary">
        <div class="panel-heading">
            Datos de la Compra
            <div class="db-header-extra"><strong><div class="lblIdRequisiciones">{{vdc.idInsumo}}</div></strong></div>
        </div>
        <div class="panel-body">
            <form ng-submit="agregarPartida()">
                    <div class="row">
                        <div class="col-md-12">
                            <label for="email">Orden Compra:</label>
                            <div class="input-group input-group-sm">
                                <div id="unidadlbl" class="input-group-addon"><strong>{{object.idCentroCostos}}</strong></div>
                                <input type="text" id="ordenCompra" class="form-control input-sm" placeholder="Orden de Compra" ng-model="object.ordenCompra"  mask="9999" restrict="reject" maxlength="10" size="10" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="input-group">
                                <label for="email">Fecha Compra:</label>
                                <input type="text" id="fechaCompra" ng-model="object.fechaCompra" class="form-control input-sm" placeholder="Date" maxlength=5 size=5 required disable>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="email">Cantidad:</label>
                            <div class="input-group input-group-sm">
                                <input type="text" id ="cantComprada" ng-model="object.cantComprada" class="form-control"  placeholder="Ej. 10.00 ó 15.53" maxlength="10" size="10" required>
                                <div id="unidadlbl" class="input-group-addon"><strong>{{dataRetrive.unidad}}</strong></div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <button id='addBtn' class="btn btn-warning btn-sm btn-block">
                                    <i class="glyphicon glyphicon-arrow-left"></i> Agregar
                                </button>
                            </div>
                            <error>{{events.error}}</error>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function ShowOptions(){
            $("#directiva2").show();
        }

        $("#fechaCompra").datepicker({
            minDate : 0,
            changeMonth : true,
            dateFormat : 'yy-mm-dd',
            onSelect: function() {
                $('#cantComprada').focus();
            },
        });


        $('#fechaCompra').keydown(function (e){
             if (e.keyCode > 36){
                var date = $('#fechaCompra').datepicker('getDate');
                date.setTime(date.getTime() + (1000*60*60*24))
                $('#fechaCompra').datepicker("setDate", date);
            }
        });


</script>

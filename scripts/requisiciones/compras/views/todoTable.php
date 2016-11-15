
        <div class="col-md-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    Insumos para la Obra: <strong>{{obra}}</strong>
                    <div class="db-header-extra"><strong><i class="glyphicon glyphicon-refresh" ng-click="reloadState()"></i></strong></div>
                </div>
                <div class="panel-body">
                    <scrollable-table watch="visibleProjects">
                        <table id="contenido" class="table table-bordered table-over"  ng-init="loadData()" width="100%">
                            <tr style="font-weight: bold">
                                <th style="width:8%">Clave</th>
                                <th class="col-md-4">Descripcion</th>
                                <th>Cant.</th>
                                <th>UDM</th>
                                <th>Fecha Colocada</th>
                                <th>#OCompra</th>
                                <th>Cant.Comprada</th>
                                <th>Estado</th>
                            </tr>
                            <tr ng-repeat="det in insumosRequisitados" ng-click="changeState('compras', det)">
                                <td class="ComprasTbl">
                                    <input class="ComprasInput" type="text" value="{{det.idInsumo}}" my-enter="changeState('compras', det)" readonly='true'>
                                </td>
                                <td>{{ det.descripcion }}</td>
                                <td> {{ det.cantidad }}</td>
                                <td>{{det.unidad}}</td>
                                <td>{{det.fecha | date : "dd/MM/y"}}</td>
                                <td>{{det.OrdenesCompra}}</td>
                                <td>{{det.cantidadComprada || '0'}}</td>
                                <td>{{det.estadoPartida || 'Por Surtir'}}</td>
                            </tr>
                        </table>
                    </scrollable-table>
                </div>
                <div class="panel-footer">
                    <div class="button-group">
                         <data>{{coments}}</data>
                    </div>
                </div>
            </div>
        </div>
<script>
    $('.ComprasInput').focus();
    function descargarReq() {
      window.location.href = urlRequisiciones + 'generarReqPDF/' + claveCompuesta;
    }
    function actualizarReq() {
      window.location.href = urlRequisiciones + 'actualizarPartidas/' + claveCompuesta;
    }

</script>

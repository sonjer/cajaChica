
<!DOCTYPE html>
<html>
<head>

    <title>ICOM INGENIERÍA</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="//localhost/intranet/assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="//localhost/intranet/assets/bootstrap-table/src/bootstrap-table.css">
    <link rel="stylesheet" href="//localhost/intranet/assets/examples.css">
    <script src="//localhost/intranet/assets/jquery.min.js"></script>
    <script src="//localhost/intranet/assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="//localhost/intranet/assets/bootstrap-table/src/bootstrap-table.js"></script>
    <script src="//localhost/intranet/ga.js"></script>
</head>
<body >
<div class="alert alert-info" role="alert">
<b><script type="text/javascript" > var meses = new Array ("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre"); var diasSemana = new Array("Domingo","Lunes","Martes","Miércoles","Jueves","Viernes","Sábado"); var f=new Date(); document.write(diasSemana[f.getDay()] + " " + f.getDate() + " de " + meses[f.getMonth()] + " de " + f.getFullYear()); </script><b><br>
<script type="text/javascript" > function startTime(){ today=new Date(); h=today.getHours(); m=today.getMinutes(); s=today.getSeconds(); m=checkTime(m); s=checkTime(s); document.getElementById('reloj').innerHTML=h+":"+m+":"+s; t=setTimeout('startTime()',500);} function checkTime(i) {if (i<10) {i="0" + i;}return i;} window.onload=function(){startTime();} </script> 
<b><div id="reloj" ></div><b>
</a>
</div>
    <div class="container">
        <h4>ORDENES DE COMPRA POR AUTORIZAR</h4>
        
        <table id="table"
               data-toggle="table"
               data-height="420"
               data-click-to-select="true"
               data-show-columns="true">
               
            <thead>
            <tr>  
                <th data-field="OrdenComp" data-switchable="false">OrdenCompra</th>
                <th data-field="ClaveProv"data-visible="false">ClaveProv</th>
                <th data-field="ClaveMon"data-visible="false">ClaveMon</th>
                <th data-field="DescMon" data-visible="false">DescMon</th>
                <th data-field="TipCamb"data-visible="false">TipCamb</th>
                <th data-field="NomProv"data-visible="false">NomProv</th>
                <th data-field="Cve_iva" data-visible="false">Cve_iva</th>
                <th data-field="ClaveProd"data-switchable="false">ClaveProd</th>
                <th data-field="Unidad"data-switchable="false">Unidad</th>
                <th data-field="DescProd" data-switchable="false">DescProd</th>
                <th data-field="StatusPart"data-switchable="false">StatusPart</th>
                <th data-field="FaltaPed"data-visible="false">FaltaPed</th>
                <th data-field="FechEnt" data-visible="false">FechEnt</th>
                <th data-field="CeCo"data-switchable="false">CeCo</th>
                <th data-field="ValorProd" data-visible="false">ValorProd</th>
                <th data-field="dcto1"data-visible="false">dcto1</th>
                <th data-field="CantProd"data-visible="false">CantProd</th>
                <th data-field="Importe" data-visible="false">Importe</th>
                <th data-field="ivaProv"data-visible="false">ivaProv</th>
                <th data-field="Total"data-switchable="false">Total</th>
                <th data-field="Partida" data-visible="false">Partida</th>
                <th data-field="VistBueno"data-visible="false">VistBueno</th>
                <th data-field="Retencion"data-visible="false">Retencion</th>
                <th data-field="Reten_iva" data-visible="false">Reten_iva</th>
                <th data-field="CveSuc"data-switchable="false">CveSuc</th>
                <th data-field="iepsProd"data-visible="false">iepsProd</th>
                <th data-field="DesClase" data-visible="false">DesClase</th>
                <th data-field="CveComp"data-visible="false">CveComp</th>
                <th data-field="NumReq"data-visible="false">NumReq</th>
                <th data-field="state" data-checkbox="true"
                    data-formatter="stateFormatter"></th>
            </tr>
            
            </thead>
            <?php  
 
      $db_host="localhost";
      $db_user="root";
      $db_password= "";
      $db_name="localicom";
      $db_table_name="detallescompra";
      $db_connection = mysqli_connect($db_host, $db_user, $db_password, $db_name);
      $sql = "SELECT OrdenComp, ClaveProv, ClaveMon, DescMon, TipCamb, NomProv, Cve_iva, ClaveProd, Unidad, DescProd, StatusPart, FaltaPed, FechEnt, CeCo, ValorProd, dcto1, CantProd, Importe, ivaProv, Total, Partida, VistBueno, Retencion, Reten_iva, CveSuc, iepsProd, DesClase, CveComp, NumReq FROM detallescompra";
      $resultado = mysqli_query($db_connection,$sql);
      
      while($row = mysqli_fetch_array($resultado))
      {
        echo "<tr><td width=\"6%\"><font face=\"verdana\">" .
	        $row["OrdenComp"] . "</font></td>";
        echo "<td width=\"15%\"><font face=\"verdana\">" .
	        $row["ClaveProv"] . "</font></td>";
        echo "<td width=\"13%\"><font face=\"verdana\">" .
	        $row["ClaveMon"] . "</font></td>";
        echo "<td width=\"20%\"><font face=\"verdana\">" .
	        $row["DescMon"] . "</font></td>";
        echo "<td width=\"25%\"><font face=\"verdana\">" .
	        $row["TipCamb"] . "</font></td>";
        echo "<td width=\"8%\"><font face=\"verdana\">" .
	        $row["NomProv"] . "</font></td>";
        echo "<td width=\"6%\"><font face=\"verdana\">" .
	        $row["Cve_iva"] . "</font></td>";
        echo "<td width=\"15%\"><font face=\"verdana\">" .
	        $row["ClaveProd"] . "</font></td>";
        echo "<td width=\"13%\"><font face=\"verdana\">" .
	        $row["Unidad"] . "</font></td>";
        echo "<td width=\"20%\"><font face=\"verdana\">" .
	        $row["DescProd"] . "</font></td>";
        echo "<td width=\"25%\"><font face=\"verdana\">" .
	        $row["StatusPart"] . "</font></td>";
        echo "<td width=\"8%\"><font face=\"verdana\">" .
	        $row["FaltaPed"] . "</font></td>";
        echo "<td width=\"6%\"><font face=\"verdana\">" .
	        $row["FechEnt"] . "</font></td>";
        echo utf8_encode("<td width=\"25%\"><font face=\"verdana\">" .
	        $row["CeCo"] . "</font></td>");
        echo "<td width=\"8%\"><font face=\"verdana\">" .
	        $row["ValorProd"] . "</font></td>";
        echo "<td width=\"6%\"><font face=\"verdana\">" .
	        $row["dcto1"] . "</font></td>";
        echo "<td width=\"15%\"><font face=\"verdana\">" .
	        $row["CantProd"] . "</font></td>";
        echo "<td width=\"13%\"><font face=\"verdana\">" .
	        $row["Importe"] . "</font></td>";
        echo "<td width=\"20%\"><font face=\"verdana\">" .
	        $row["ivaProv"] . "</font></td>";
        echo "<td width=\"25%\"><font face=\"verdana\">" .
	        $row["Total"] . "</font></td>";
        echo "<td width=\"8%\"><font face=\"verdana\">" .
	        $row["Partida"] . "</font></td>";
        echo "<td width=\"6%\"><font face=\"verdana\">" .
	        $row["VistBueno"] . "</font></td>"; 
        echo "<td width=\"25%\"><font face=\"verdana\">" .
	        $row["Retencion"] . "</font></td>";
        echo "<td width=\"8%\"><font face=\"verdana\">" .
	        $row["Reten_iva"] . "</font></td>";
        echo utf8_encode("<td width=\"6%\"><font face=\"verdana\">" .
	        $row["CveSuc"] . "</font></td>");
        echo "<td width=\"15%\"><font face=\"verdana\">" .
	        $row["iepsProd"] . "</font></td>";
        echo "<td width=\"13%\"><font face=\"verdana\">" .
	        $row["DesClase"] . "</font></td>";
        echo "<td width=\"20%\"><font face=\"verdana\">" .
	        $row["CveComp"] . "</font></td>";   
        echo "<td width=\"8%\"><font face=\"verdana\">" .
	        $row["NumReq"]. "</font></td></tr>";
        
     }
 
       mysqli_free_result($resultado);
       mysqli_close($db_connection);
       ?>
        </table>
         <button type="button" ng-click="eliminaUsuario()" class="btn btn-danger btn-sm">Cancelar</button>
         <button type="submit" name= "enviar" value= "Aceptar informacion"class="btn btn-primary btn-sm">Guardar</button>
    </div>

                                
<script>
    function stateFormatter(value, $row, index) {
        if (index === 2) {
            return {
                disabled: true
            };
        }
        if (index === 1817) {
            return {
                disabled: true,
                checked: true
            }
        }
        return value;
    }
</script>
<!-- <style>
body {
background:url(//localhost/intranet/images/icom-wallpaper.png) no-repeat center center fixed;
-webkit-background-size: cover;
-moz-background-size: cover;
-o-background-size: cover;
background-size: cover;
}
</style> -->
</body>
</html>
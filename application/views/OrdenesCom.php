
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
        <button type="submit" name= "enviar" value= "Aceptar informacion"class="btn btn-primary btn-sm">Autorizar Seleccionados</button><br>
        <table id="table"
               data-toggle="table"
               data-height="420"
               data-click-to-select="true"
               data-show-columns="true">

               
            <thead>
            <tr>  

                <th data-field="idCompra" data-checkbox="true"></th>
                <th data-field="CeCo" >CeCo</th>
                <th data-field="OrdenComp">OrdenComp</th>
                <th data-field="ClaveProv">ClaveProv</th>
                <th data-field="ClaveMon" >ClaveMon</th>
                <th data-field="DescMon">DescMon</th>
                <th data-field="TipCamb">TipCamb</th>
                <th data-field="NomProv" >NomProv</th>
                <th data-field="Cve_iva">Cve_iva</th>
                <th data-field="CveSuc">CveSuc</th>
                <th data-field="StatusPart" >StatusPart</th>
                <th data-field="FalltaPed">FaltaPed</th>
                <th data-field="FechEnt" >FechEnt</th>
                <th data-field="Descr">Descr</th>
                <th data-field="TotalPed" >TotalPed</th>
                <th data-field="SubtPed" >SubtPed</th>
                <th data-field="Retencion">Retencion</th>
                <th data-field="Reten_iva">Reten_iva</th>
                <th data-field="ieps" >ieps</th>
                <th data-field="iva">iva</th>
                <th data-field="UsuAut">UsuAut</th>
                <th data-field="NomUser" >NomUser</th>
                <th data-field="statusAut">statusAut</th>
                <th data-field="FechHoraAut">FechHoraAut</th>
            </tr>
            
            </thead>
            <?php  
 
      $db_host="localhost";
      $db_user="root";
      $db_password= "";
      $db_name="localicom";
      $db_table_name="ORDENESCOMPRA";
      $db_connection = mysqli_connect($db_host, $db_user, $db_password, $db_name);
      $sql = "SELECT  *  FROM ORDENESCOMPRA";
      $resultado = mysqli_query($db_connection,$sql);
      
      while($row = mysqli_fetch_array($resultado))
      {
        echo "<tr><td width=\"8%\">" .
	        $row["idCompra"] . "</td>";
        echo utf8_encode("<td width=\"8%\">" .
	        $row["CeCo"] . "</td>");
        echo utf8_encode("<td width=\"15%\">" .
	        $row["OrdenComp"] . "</td>");
        echo utf8_encode("<td width=\"13%\">" .
	        $row["ClaveProv"] . "</td>");
        echo "<td width=\"20%\">" .
	        $row["ClaveMon"] . "</td>";
        echo "<td width=\"20%\">" .
	        $row["DescMon"] . "</td>";
        echo "<td width=\"25%\">" .
	        $row["TipCamb"] . "</td>";
        echo utf8_encode("<td width=\"8%\">" .
	        $row["NomProv"] . "</td>");
        echo "<td width=\"6%\">" .
	        $row["Cve_iva"] . "</td>";
        echo utf8_encode("<td width=\"15%\">" .
	        $row["CveSuc"] . "</td>");
        echo "<td width=\"13%\">" .
	        $row["StatusPart"] . "</td>";
        echo "<td width=\"20%\">" .
	        $row["FalltaPed"] . "</td>";
        echo "<td width=\"25%\">" .
	        $row["FechEnt"] . "</td>";
        echo utf8_encode("<td width=\"25%\">" .
	        $row["Descr"] . "</td>");
        echo "<td width=\"8%\">" .
	        $row["TotalPed"] . "</td>";
        echo "<td width=\"8%\">" .
	        $row["SubtPed"] . "</td>";
        echo "<td width=\"6%\">" .
	        $row["Retencion"] . "</td>";
        echo "<td width=\"15%\">" .
	        $row["Reten_iva"] . "</td>";
        echo "<td width=\"13%\">" .
	        $row["ieps"] . "</td>";
        echo "<td width=\"20%\">" .
	        $row["iva"] . "</td>";
        echo "<td width=\"25%\">" .
	        $row["UsuAut"] . "</td>";
        echo utf8_encode("<td width=\"8%\">" .
	        $row["NomUser"] . "</td>");
        echo "<td width=\"6%\">" .
	        $row["statusAut"] . "</td>";  
        echo "<td width=\"8%\">" .
	        $row["FechHoraAut"]. "</td></tr>";
        
     }
 
       mysqli_free_result($resultado);
       mysqli_close($db_connection);
       ?>
        </table>
         <button type="button" ng-click="eliminaUsuario()" class="btn btn-danger btn-sm">Cancelar</button>
         <button type="submit" name= "enviar" value= "Aceptar informacion"class="btn btn-primary btn-sm">Guardar</button>
    </div>

                                

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
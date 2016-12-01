            <?php  
 
      $db_host="localhost";
      $db_user="root";
      $db_password= "";
      $db_name="localicom";
      $db_table_name="detallescompra";
      $db_connection = mysqli_connect($db_host, $db_user, $db_password, $db_name);
      $sql = "SELECT   OrdenComp, ClaveProv, ClaveMon, DescMon, TipCamb, NomProv, Cve_iva, ClaveProd, Unidad, DescProd, StatusPart, FaltaPed, FechEnt, CeCo, ValorProd, dcto1, CantProd, Importe, ivaProv, Total, Partida, VistBueno, Retencion, Reten_iva, CveSuc, iepsProd, DesClase, CveComp, NumReq FROM detallescompra";
      $resultado = mysqli_query($db_connection,$sql);
      
      while($row = mysqli_fetch_array($resultado))
      {
        echo "<tr><td width=\"8%\">" .
	        $row["OrdenComp"] . "</td>";
        echo "<td width=\"15%\">" .
	        $row["ClaveProv"] . "</td>";
        echo "<td width=\"13%\">" .
	        $row["ClaveMon"] . "</td>";
        echo "<td width=\"20%\">" .
	        $row["DescMon"] . "</td>";
        echo "<td width=\"25%\">" .
	        $row["TipCamb"] . "</td>";
        echo utf8_encode("<td width=\"8%\">" .
	        $row["NomProv"] . "</td>");
        echo "<td width=\"6%\">" .
	        $row["Cve_iva"] . "</td>";
        echo "<td width=\"15%\">" .
	        $row["ClaveProd"] . "</td>";
        echo "<td width=\"13%\">" .
	        $row["Unidad"] . "</td>";
        echo utf8_encode("<td width=\"20%\">" .
	        $row["DescProd"] . "</td>");
        echo "<td width=\"25%\">" .
	        $row["StatusPart"] . "</td>";
        echo "<td width=\"8%\">" .
	        $row["FaltaPed"] . "</td>";
        echo "<td width=\"6%\">" .
	        $row["FechEnt"] . "</td>";
        echo utf8_encode("<td width=\"25%\">" .
	        $row["CeCo"] . "</td>");
        echo "<td width=\"8%\">" .
	        $row["ValorProd"] . "</td>";
        echo "<td width=\"6%\">" .
	        $row["dcto1"] . "</td>";
        echo "<td width=\"15%\">" .
	        $row["CantProd"] . "</td>";
        echo "<td width=\"13%\">" .
	        $row["Importe"] . "</td>";
        echo "<td width=\"20%\">" .
	        $row["ivaProv"] . "</td>";
        echo "<td width=\"25%\">" .
	        $row["Total"] . "</td>";
        echo "<td width=\"8%\">" .
	        $row["Partida"] . "</td>";
        echo "<td width=\"6%\">" .
	        $row["VistBueno"] . "</td>"; 
        echo "<td width=\"25%\">" .
	        $row["Retencion"] . "</td>";
        echo "<td width=\"8%\">" .
	        $row["Reten_iva"] . "</td>";
        echo utf8_encode("<td width=\"6%\">" .
	        $row["CveSuc"] . "</td>");
        echo "<td width=\"15%\">" .
	        $row["iepsProd"] . "</td>";
        echo utf8_encode("<td width=\"13%\">" .
	        $row["DesClase"] . "</td>");
        echo "<td width=\"20%\">" .
	        $row["CveComp"] . "</td>";   
        echo "<td width=\"8%\">" .
	        $row["NumReq"]. "</td></tr>";
        
     }
 
       mysqli_free_result($resultado);
       mysqli_close($db_connection);
       ?>

               <table id="table"
               data-toggle="table"
               data-height="420">
               
            <thead>
            <tr>  
                <th data-field="state" data-checkbox="true"
                    data-formatter="stateFormatter"></th>
                <th data-field="OrdenComp" >OrdenCompra</th>
                <th data-field="ClaveProv">ClaveProv</th>
                <th data-field="ClaveMon">ClaveMon</th>
                <th data-field="DescMon" >DescMon</th>
                <th data-field="TipCamb">TipCamb</th>
                <th data-field="NomProv">NomProv</th>
                <th data-field="Cve_iva" >Cve_iva</th>
                <th data-field="ClaveProd">ClaveProd</th>
                <th data-field="Unidad">Unidad</th>
                <th data-field="DescProd" >DescProd</th>
                <th data-field="StatusPart">StatusPart</th>
                <th data-field="FaltaPed">FaltaPed</th>
                <th data-field="FechEnt" >FechEnt</th>
                <th data-field="CeCo">CeCo</th>
                <th data-field="ValorProd" >ValorProd</th>
                <th data-field="dcto1">dcto1</th>
                <th data-field="CantProd">CantProd</th>
                <th data-field="Importe" >Importe</th>
                <th data-field="ivaProv">ivaProv</th>
                <th data-field="Total">Total</th>
                <th data-field="Partida" >Partida</th>
                <th data-field="VistBueno">VistBueno</th>
                <th data-field="Retencion">Retencion</th>
                <th data-field="Reten_iva" >Reten_iva</th>
                <th data-field="CveSuc">CveSuc</th>
                <th data-field="iepsProd">iepsProd</th>
                <th data-field="DesClase" >DesClase</th>
                <th data-field="CveComp">CveComp</th>
                <th data-field="NumReq">NumReq</th>
            </tr>
            
            </thead>

        </table>
<html>
<body>

<?php
$db_host="localhost";
$db_user="root";
$db_name="localicom";
$db_table_name="detalle_caja_chica";
   $db_connection = mysqli_connect($db_host, $db_user);
if (!$db_connection) {
	die('No se ha podido conectar a la base de datos');
}
// process form
$sql = "INSERT INTO detalle_caja_chica ( Ccostos, factura, fecha, proveedor, descripcon, importe, iva, Total)" +
 " VALUES ('$Ccostos', '$factura', '$fecha', '$proveedor', '$descripcon', '$importe', '$iva', '$Total')";
$result = mysqli_query($sql);
echo "¡Gracias! Hemos recibido sus datos.\n";
?> 
</body>
</html>
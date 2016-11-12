
<?php
$db_host="localhost";
$db_user="root";
$db_password= "";
$db_name="localicom";
$db_table_name="detalle_caja_chica";

 try  { $db_connection = mysqli_connect($db_host, $db_user, $db_password, $db_name);
 
	echo 'conexion correcta';
}
catch ( PDOException $e ){
     echo "error al conectar :" . $e->getMessage();
}
if ($db_connection) {
  echo "conexion exitosa";
$Ccostos = $_POST['Ccostos']; 
$factura = $_POST['factura']; 
$fecha = $_POST['fecha']; 
$proveedor = $_POST['proveedor']; 
$descripcion = $_POST['descripcion']; 
$importe = $_POST['importe']; 
$iva = $_POST['iva']; 
$Total= $_POST['Total']; 
// process form
$sql = ("insert into detalle_caja_chica ( Ccostos, factura, fecha, proveedor, descripcon, importe, iva, Total)
 values ('$Ccostos', '$factura', '$fecha', '$proveedor', '$descripcion', '$importe', '$iva', '$Total')");
$resultado = mysqli_query($db_connection,$sql);
		if ($resultado) {
			echo "perfil almacenado. <br />";
		}
		else {
			echo "error en la ejecución de la consulta. <br />";
		}
}
echo "¡Gracias! Hemos recibido sus datos.\n";

?>
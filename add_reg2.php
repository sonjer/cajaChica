<?php 

$db_host="localhost";
$db_user="root";
$db_password= "";
$db_name="localicom";
$db_table_name="detalle_caja_chica";

//Creamos la conexión
$db_connection = mysqli_connect($db_host, $db_user, $db_password, $db_name);
or die("Ha sucedido un error inexperado en la conexion de la base de datos");

//generamos la consulta
$sql = "SELECT * FROM detalle_caja_chica";
mysqli_set_charset($db_connection, "utf8"); //formato de datos utf8

if(!$result = mysqli_query($db_connection, $sql)) die();

$detalle_caja = array(); //creamos un array

while($row = mysqli_fetch_array($result)) 
{ 
$Ccostos = $row['Ccostos']; 
$factura = $row['factura']; 
$fecha = $row['fecha']; 
$proveedor = $row['proveedor']; 
$descripcion = $row['descripcion']; 
$importe = $row['importe']; 
$iva = $row['iva']; 
$Total= $row['Total']; 
    

    $detalle_caja[] = array('Ccostos'=> $Ccostos, 'factura'=> $factura, 'fecha'=> $fecha, 'proveedor'=> $proveedor,
                        'descripcion'=> $descripcion, 'importe'=> $importe, 'iva'=> $iva, 'Total'=> $Total );

}
    
//desconectamos la base de datos
$close = mysqli_close($db_connection) 
or die("Ha sucedido un error inexperado en la desconexion de la base de datos");
  

//Creamos el JSON

$file = 'detalle.json';
file_put_contents($file, $json_string);

    

?>
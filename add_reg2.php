 <?php 

      $db_host="localhost";
      $db_user="root";
      $db_password= "";
      $db_name="localicom";
      $db_connection = mysqli_connect($db_host, $db_user, $db_password, $db_name);

        if(isset($_POST["data"]))
       { 
       $data = json_decode($_POST["data"]);
       //var_dump($data);
       foreach($data->data as $mydata)
       {
        $sql = ("UPDATE ordenescompra SET statusAut='Autorizada' WHERE idCompra=".$mydata->id);

        $resultado = mysqli_query($db_connection, $sql);
       }

        if ($resultado) {
		echo '<script language="javascript">alert("EGRESO DE CAJA GUARDADO CORRECTAMENTE");
		window.location.href="http://localhost/intranet/caja";
        </script>'; 
		}
		else {
			echo "error en la ejecución de la consulta. <br />";
     }
     
      
    }

       ?>
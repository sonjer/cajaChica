 <?php  
      $db_host="localhost";
      $db_user="root";
      $db_password= "";
      $db_name="localicom";
      $db_connection = mysqli_connect($db_host, $db_user, $db_password, $db_name);

      $sql = "UPDATE ORDENESCOMPRA SET statusAut='Autorizada' WHERE idCompra='1';";
      echo "Actualizacion correcta";

      $resultado = mysqli_query($db_connection,$sql);
      

       mysqli_close($db_connection);
       ?>
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
         $sql = "UPDATE vistacompras SET statusAut='Autorizada' WHERE idCompra=".$mydata->id;
    }
}

       ?>
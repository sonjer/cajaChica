<?php
$dsn ="mysqli:dbname=php_sql_course; host=127.0.0.1 ";
$user="root";
$password="";

try {
     $pdo = new PDO (
                   $dsn,
                   $user,
                   $password
                   );
                   echo "conexion correcta";
}
catch ( PDOException $e ){
     echo "error al conectar :" . $e->getMessage();
}

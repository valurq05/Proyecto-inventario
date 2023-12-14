<?php
    $host = "localhost";
    $User = "root";
    $pass = "";

    $db = "supermercado_proyecto";

    $conexion = mysqli_connect($host, $User , $pass, $db);

    if (!$conexion) {
     echo "Conexion fallida";
    }
    
?>
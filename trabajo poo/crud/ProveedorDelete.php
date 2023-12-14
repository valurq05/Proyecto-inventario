<?php

include("../clases/conexion2.php");
$query=("DELETE FROM proveedor WHERE prov_id ={$_POST['id']}");
$result= mysqli_query($conexion,$query);

        echo "Proveedor eliminado";


?>
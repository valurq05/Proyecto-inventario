<?php

include("../clases/conexion2.php");
$query=("DELETE FROM producto WHERE pro_id ={$_POST['id']}");
$result= mysqli_query($conexion,$query);

        echo "Producto eliminado";


?>
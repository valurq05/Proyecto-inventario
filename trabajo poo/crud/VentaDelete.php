<?php

include("../clases/conexion2.php");
$query=("DELETE FROM venta WHERE ven_id ={$_POST['id']}");
$result= mysqli_query($conexion,$query);



?>
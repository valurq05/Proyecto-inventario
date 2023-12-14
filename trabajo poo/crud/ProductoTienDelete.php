<?php

include("../clases/conexion2.php");
$query=("DELETE FROM producto_en_tienda WHERE pro_tienda_id ={$_POST['id']}");
$result= mysqli_query($conexion,$query);



?>
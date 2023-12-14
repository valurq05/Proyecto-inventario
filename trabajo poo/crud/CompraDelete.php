<?php

include("../clases/conexion2.php");
$query=("DELETE FROM compra WHERE com_id={$_POST['id']}");
$result= mysqli_query($conexion,$query);

        echo "Compra eliminada";


?>
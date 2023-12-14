<?php
        $conex= mysqli_connect("localhost", "root", "", "supermercado_proyecto");
        $query=("DELETE FROM producto WHERE pro_id ={$_POST['id']}");
        $result= mysqli_query($conex,$query);

        echo "Producto eliminado";


?>
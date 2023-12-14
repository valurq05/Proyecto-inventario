<?php
require_once "../clases/producto.php";
require_once "../clases/proveedor.php";
require_once "../clases/tienda.php";
require_once "../clases/producto_en_tienda.php";
require_once "../clases/conexion2.php";
require_once "../clases/administrador.php";
require_once "../clases/venta.php";
require_once "../clases/compra.php";
require_once "../clases/cliente.php";

$producto = Producto::mostrar();
$proveedor = Proveedor::mostrar();
$tienda = Tienda::mostrar();
$producto_tienda = ProductoEnTienda::mostrar();
$administrador = Administrador::mostrar();
$venta = Venta::mostrar();
$compra = Compra::mostrar();
$cliente = Cliente::mostrar();


session_start();
if (!isset($_SESSION["adm_id"])) {
	header("Location:../crearCuenta.php");
  }
  
	$adminId = $_SESSION["adm_id"];
	$consultaUser = "SELECT adm_id, adm_nombre FROM administrador WHERE adm_id = '$adminId'";
	$resultado = $conexion->query($consultaUser);
	$row = $resultado->fetch_assoc();

	$adminTienda = $_SESSION["adm_tienda"];

?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="../css/stylesMain.css">
	<link href='https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css' rel='stylesheet'>
	<link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
	<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<title>ProSystem</title>
</head>
<body>


	<!-- SIDEBAR -->
	<section id="sidebar">
		<a href="#" class="brand">
            <i class='bx bx-store-alt'></i>
			<span class="text">ProSystem</span>
		</a>
		<ul class="side-menu top">
			<li class="active">
				<a href="#inicio">
					<i class='bx bxs-dashboard'></i>
					<span class="text">Dashboard</span>
				</a>
			</li>
			<li>
				<a href="#productos">
				<i class='bx bx-customize'></i>
					<span class="text">Productos</span>
				</a>
			</li>
			<li>
				<a href="#proveedor">
				<i class='bx bx-group'></i>
					<span class="text">Proveedores</span>
				</a>
			</li>
			<li>
				<a href="#tienda">
				   <i class='bx bx-store' ></i>
					<span class="text">Tienda</span>
				</a>
			</li>
			<li>
				<a href="#compras">
				<i class='bx bx-shopping-bag'></i>
					<span class="text">Compras</span>
				</a>
			</li>
			<li>
				<a href="#ventas">
				<i class='bx bx-wallet'></i>
					<span class="text">Ventas</span>
				</a>
			</li>
			<li>
				<a href="#admin">
				  <i class='bx bx-user-circle' ></i>
					<span class="text">Perfil</span>
				</a>
			</li>
            
		</ul>

				
	</section>
	<!-- SIDEBAR -->

	<!-- CONTENT -->
	<section id="content">
		<!-- NAVBAR -->
		<nav>
			<i class='bx bx-menu' ></i>
			<form action="#">
				<div class="form-input">
					<input type="search" placeholder="Search...">
					<button type="submit" class="search-btn"><i class='bx bx-search' ></i></button>
				</div>
			</form>
			<input type="checkbox" id="switch-mode" hidden>
			<label for="switch-mode" class="switch-mode"></label>
			<a href="#" class="profile">
				<p>Hola, <?php echo utf8_decode($row["adm_nombre"]); ?></p>
			</a>
		</nav>
		<!-- NAVBAR -->

		<!-- MAIN -->
		<main>

		<!-- Inicio Productos -->
		<div id="productos">
			<div class="head-title">
				<div class="left">
					<h1>Productos</h1>
					<ul class="breadcrumb">
						<li>
							<a href="#">Productos</a>
						</li>
						<li><i class='bx bx-chevron-right' ></i></li>
						<li>
							<a class="" href="#">Inicio</a>
						</li>
					</ul>
				</div>
			</div>

			<div class="Botones">
				<button class="AddProducto" id="AgregarProducto" onclick="mostrarFormularioProducto()">Agregar Producto</button>

			</div>

			<div id="FormAgregarProductos" class="FormAgregarProducto" style="display: none">
			<span class="cerrar" id="cerrarBtn" onclick="cerrarFormularioProducto()">&times;</span>
			<h3 class="pt-3 font-weight-bold">Agregar Producto</h3>
			<form class = "form_agr_producto" action="../crud/ProductoCreate.php" method="post">
        		<p>Código producto:<input type="text" name="codProducto" required></p>
        		<p>Nombre producto :<input type="text" name="nombre_producto" required></p>
        		<p>Valor de venta:<input type="text" name="valor_venta" required></p>
        		<p>Proveedor:</p>
				<select name="prov_id" id="prov_select" class="form-control" required>
   				<option value="" disabled selected>Seleccione proveedor</option>
    					<?php
    					foreach ($proveedor as $item): 
							echo "<option value='{$item['prov_id']}'>{$item['prov_nombre']}</option>";
					 	endforeach;
    					?>
				</select>
        		<p><input type="submit" value="Agregar"></p>
    		</form>
			</div>

			<div id="FormModifProducto" class="FormModProducto" style="display: none">
			<span class="cerrar" id="cerrarBtn" onclick="cerrarFormularioModProducto()">&times;</span>
			<h3 class="pt-3 font-weight-bold">Modificar Producto</h3>
			<form action="../crud/ProductoUpdate.php" method="post">
        		<p>Código producto:<input type="text" name="codProducto" required id="pro-mod-id"></p>
        		<p>Nombre producto :<input type="text" name="nombre_producto" required id="pro-mod-nombre"></p>
        		<p>Valor de venta:<input type="text" name="valor_venta" required id="pro-mod-valor-venta"></p>
				<p>Proveedor:</p>
				<select name="prov_id" id="proveedorSelectModPro" class="form-control" required>
        		<option value="" disabled selected>Selecciona el proveedor</option>
        		<?php
        		$consultaProveedor = $conexion->query("SELECT prov_id, prov_nombre FROM proveedor");
        		while ($rowProveedor = $consultaProveedor->fetch_array()) {
        		    echo "<option value='{$rowProveedor['prov_id']}'>{$rowProveedor['prov_nombre']}</option>";
        		}
        		?>
    			</select>
        		<p><input type="submit" value="Modificar"></p>
    		</form>
			</div>

			<div class="table-data">
				<div class="order">
					<div class="head">
						<h3>Productos disponibles</h3>
						<i class='bx bx-search' ></i>
						<i class='bx bx-filter' ></i>
					</div>
					<table>
						<thead>
							<tr>
								<th>Código producto</th>
								<th>Nombre</th>
								<th>Proveedor</th>
								<th>Valor</th>
							</tr>
						</thead>
						<tbody>
						<?php 
						$consulta = $conexion->query("SELECT p.pro_id, p.pro_nombre, pr.prov_nombre, p.pro_precioVenta
						FROM proveedor pr
						INNER JOIN producto p
						ON pr.prov_id = p.prov_id");
						while ($row = $consulta->fetch_array()) { ?>
						    <tr>
						        <td><?php echo $row['pro_id'] ?></td>
						        <td><?php echo $row['pro_nombre'] ?></td>
						        <td><?php echo $row['prov_nombre'] ?></td>
						        <td><?php echo $row['pro_precioVenta'] ?></td>
						        <td><button type="button" class="btn btn-primary" pro_id="<?php echo $row['pro_id']; ?>" pro_nombre="<?php echo $row['pro_nombre']; ?>" prov_nombre="<?php echo $row['prov_nombre']; ?>" pro_precioVenta="<?php echo $row['pro_precioVenta']; ?>" onclick="mostrarFormularioModProducto(this)">Editar</button></td>
						        <td><button class="btn btn-danger btn-eliminar" data-id-producto="<?php echo $row['pro_id']; ?>">Eliminar</button></td>
						    </tr>
						<?php } ?>
						
						</tbody>
					</table>

				</div>
		</div>
	</div>

		<!-- Final Productos-->

		<!-- Inicio Proveedor -->

		<div id="proveedor">
			<div class="head-title">
				<div class="left">
					<h1>Proveedores</h1>
					<ul class="breadcrumb">
						<li>
							<a href="#">Proveedores</a>
						</li>
						<li><i class='bx bx-chevron-right' ></i></li>
						<li>
							<a class="active" href="#">Inicio</a>
						</li>
					</ul>
				</div>
			</div>

			<div class="Botones">
				<button class="AddProducto" id="AgregarProducto" onclick="mostrarFormularioProveedor()">Agregar Proveedor</button>
				<button class="ModificarProducto" id="ModificarProducto" onclick="mostrarFormularioModProveedor()">Modificar Proveedor</button>
				<button class="EliminarProducto" id="EliminarProducto">Eliminar</button>

			</div>

			<div id="FormAgregarProveedor" class="FormAgregarProveedor" style="display: none">
			<span class="cerrar" id="cerrarBtn" onclick="cerrarFormularioProveedor()">&times;</span>
			<h3 class="pt-3 font-weight-bold">Agregar Proveedor</h3>
			<form action="../crud/ProveedorCreate.php" method="post">
            <p>Nombre proveedor:<input type="text" name="prov_nombre" required></p>
            <p>Número de telefono:<input type="text" name="prov_telefono" required></p>
            <p>Correo: <input type="email" name="prov_correo" required></p>
            <p><input type="submit" value="Enviar"></p>
            </form>
			</div>

			<div id="FormModProveedor" class="FormModProveedor" style="display : none">
			<span class="cerrar" id="cerrarBtn2" onclick="cerrarFormularioModProveedor()">&times;</span>
			<h3 class="pt-3 font-weight-bold">Modificar Proveedor</h3>
			<form action="../crud/ProveedorUpdate.php" method="post">
            <p>Código proveedor:<input type="text" name="prov_id" required></p>
            <p>Nombre proveedor:<input type="text" name="prov_nombre" required></p>
            <p>Número de telefono:<input type="text" name="prov_telefono" required></p>
            <p>Correo: <input type="email" name="prov_correo" required></p>
            <p><input type="submit" value="Enviar"></p>
            </form>
			</div>

			<div class="table-prov">
                <?php foreach ($proveedor as $item): ?>
                    <div class="proveedor_each">
                    <ul>
                    <li>Código Proveedor: <?php echo $item['prov_id'] ?> </li>
                    <li>Nombre: <?php echo $item['prov_nombre'] ?> </li>
                    <li>Telefono: <?php echo $item['prov_telefono'] ?> </li>
                    <li>Correo Electrónico: <?php echo $item['prov_correo'] ?> </li>
<<<<<<< HEAD
					<li><button class="btn btn-danger btn-eliminar-proveedor" data-id-proveedor="<?php echo $item['prov_id']; ?>">Eliminar</button></li>
=======
					<td><button type="button" class="btn btn-primary" proveedorid="<?php echo $item['prov_id']; ?>" proveeNombre="<?php echo $row['prov_nombre']; ?>" proveedorCorreo="<?php echo $row['prov_correo']; ?>" proveedorTelefono="<?php echo $row['pro__telefono']; ?>"  onclick="mostrarFormularioModProTienda(this)">Editar</button></td>
					<li><button class="btn btn-danger btn-eliminar" data-id-proveedor="<?php echo $item['prov_id']; ?>">Eliminar</button></li>
>>>>>>> 7a21d981cff0fe71902c75c5560ebe5a6f4422f2
                    </ul>
                    </div>
                <?php endforeach; ?>
        
            </div>			
		</div>

		<!-- Final Proveedor -->

		<!-- Inicio Tienda -->

		<div id="tienda">
			<div class="head-title">
				<div class="left">
				<?php
				$consulta = $conexion ->query("SELECT t.tie_nombre FROM tienda t WHERE tie_id ='$adminTienda'");
						while($row = $consulta ->fetch_array()){ ?>
						<?php  $nombreTienda = $row["tie_nombre"];?>
							<h1>Tienda: <?php echo $nombreTienda; ?></h1> 
						<?php }?>

					<ul class="breadcrumb">
						<li>
							<a href="#">Tienda</a>
						</li>
						<li><i class='bx bx-chevron-right' ></i></li>
						<li>
							<a class="active" href="#">Inicio</a>
						</li>
					</ul>
				</div>
			</div>

			<div class="Botones">
				<button class="AddProducto" id="AgregarProducto" onclick="mostrarFormularioProTienda()">Agregar producto tienda</button>
			</div>		

			<div id="FormAgregarProTienda" class="FormAgregarProTienda" style="display: none">
			<span class="cerrar" id="cerrarBtn2" onclick="cerrarFormularioProTienda()">&times;</span>
			<h3 class="pt-3 font-weight-bold">Agregar Producto a Tienda</h3>
			<form action="../crud/ProductTienCreate.php" method="post">
			<p>Producto:</p>
        	<select name="cod_producto" class="form-control" required>
                                <option value="" disabled selected>Selecciona el producto</option>
                                    <?php
                                        foreach ($producto as $item): 
                                            echo "<option value='{$item['pro_id']}'>{$item['pro_nombre']}</option>";
                                     endforeach; ?>
                                </select>
        	<p>Cantidad producto: <input type="text" name="cant_producto" required></p>
        	<p>Código Tienda: <input value = "<?php echo $adminTienda ?>" name="cod_tienda" readonly onmousedown="return false;"></p>
        	<p>Persona que entregó el producto:<input type="text" name="nombre_repartidot" required></p>
        	<p>Fecha Recibido:<input type="date" name="fecha_recibido" required></p>
        	<p><input type="submit" value="Agregar"></p>
    		</form>
			</div> 

			<div id="FormModifyProTienda" class="FormModifyProTienda" style="display:none">
			<span class="cerrar" id="cerrarBtn2" onclick="cerrarFormularioModProTienda()">&times;</span>
			<h3 class="pt-3 font-weight-bold">Modificar Producto en Tienda</h3>
			<form action="../crud/ProductTienUpdate.php" method="post">
        	<p>id: <input type="text" name="id_producto_tienda" id="proTien-pro-id" required></p>
			<p>Producto:</p>
        	<select name="cod_producto" id="proTien-select-pro" class="form-control" required>
                                <option value="" disabled selected>Selecciona el producto</option>
                                    <?php
                                        foreach ($producto as $item): 
                                            echo "<option value='{$item['pro_id']}'>{$item['pro_nombre']}</option>";
                                     endforeach; ?>
                                </select>
        	<p>Cantidad producto: <input type="text" name="cant_producto" id="proTien-pro-cant" required></p>
			<p>Código Tienda: <input value = "<?php echo $adminTienda ?>" name="cod_tienda" readonly onmousedown="return false;"></p>
        	<p>Persona que entregó el producto:<input type="text" id="proTien-pro-repartidor" name="nombre_repartidot" required></p>
        	<p>Fecha Recibido:<input type="date" name="fecha_recibido"  id="proTien-pro-fechaLLegada" required></p>
        	<p><input type="submit" value="Modificar" required></p>
    		</form>
			</div>

			<div class="table-data">
				<div class="order">
					<div class="head">

						<h3>Productos disponibles<?php echo $nombreTienda; ?></h3> 

						<i class='bx bx-search' ></i>
						<i class='bx bx-filter' ></i>
					</div>
					<table>
						<thead>
							<tr>
								<th>Código producto</th>
								<th>Nombre</th>
								<th>Precio Venta</th>
								<th>Cantidad en Tienda</th>
								<th>Nombre Repartidor</th>
								<th>Fecha Entrega</th>
							</tr>
						</thead>
						<tbody>
                    	
						<?php 
						 $totalProductosEnTienda = 0;
						 $consulta = $conexion ->query("SELECT pt.pro_tienda_id, pt.pro_id, p.pro_nombre,  p.pro_precioVenta, pt.pro_tienda_cant, pt.nombre_repartidor, pt.fecha_recibido FROM producto p INNER JOIN producto_en_tienda pt ON p.pro_id = pt.pro_id WHERE tie_id = '$adminTienda' ");
						 while($row = $consulta ->fetch_array()){ ?>
						 <tr>
							<td> <?php echo $row["pro_id"] ?></td> 
							<td> <?php echo $row["pro_nombre"] ?></td>
							<td> <?php echo $row["pro_precioVenta"]?></td>
							<td> <?php echo $row["pro_tienda_cant"]?></td>
							<td> <?php echo $row["nombre_repartidor"]?></td> 
							<td> <?php echo $row["fecha_recibido"]?></td> 
							<td><button type="button" class="btn btn-primary" pro_id="<?php echo $row['pro_id']; ?>" pro_tienda_ID="<?php echo $row['pro_tienda_id']; ?>" pro_precioVenta="<?php echo $row['pro_precioVenta']; ?>" pro_tienda_cant="<?php echo $row['pro_tienda_cant']; ?>" persona_entrega_producto="<?php echo $row['nombre_repartidor']; ?>" fecha_entrega_producto="<?php echo $row['fecha_recibido']; ?>" onclick="mostrarFormularioModProTienda(this)">Editar</button></td>
						    <td><button class="btn btn-danger btn-eliminar" data-id-producto="<?php echo $row['pro_id']; ?>">Eliminar</button></td>
							</tr>

						<?php $totalProductosEnTienda = $row["pro_tienda_cant"] + $totalProductosEnTienda?>
						<?php }?>
    
                    	
						</tbody>
					</table>
				</div>
		</div>


			</div>
		</div>

		<!-- Final Tienda -->

		<!-- Inicio Compras -->

		<div id="compras">

		<div class="head-title">
				<div class="left">
					<h1>Compras</h1>
					<ul class="breadcrumb">
						<li>
							<a href="#">Compras</a>
						</li>
						<li><i class='bx bx-chevron-right' ></i></li>
						<li>
							<a class="active" href="#">Inicio</a>
						</li>
					</ul>
				</div>
			</div>

			<div class="Botones">
				<button class="AddProducto" id="AgregarProducto" onclick="mostrarFormularioAddVenta()">Agregar compra</button>
			
				<div id="FormCrearCompra" class="FormCrearCompra" style="display: none">
			<span class="cerrar" id="cerrarBtn2" onclick="cerrarFormCrearVenta()">&times;</span>
				<h3 class="pt-3 font-weight-bold">Agregar Compra</h3>
				<form action="../crud/CompraCreate.php" method="post">
				<p>Código Tienda: <input value = "<?php echo $adminTienda ?>" name="cod_tienda" readonly onmousedown="return false;"></p>
        			<p>Código Compra: <input type="text" name="codCompra" required></p>
				<select name="productoSelect" id="productoSelect" class="form-control" required>
        		<option value="" disabled selected>Selecciona el producto</option>
        		<?php
        		$consultaProducto = $conexion->query("SELECT pro_id, pro_nombre, prov_id FROM producto");
        		while ($rowProducto = $consultaProducto->fetch_array()) {
        		    echo "<option value='{$rowProducto['pro_id']}' data-proveedor='{$rowProducto['prov_id']}'>{$rowProducto['pro_nombre']}</option>";
        		}
        		?>
    		</select>
    		<select name="proveedorSelect" id="proveedorSelect" class="form-control" required>
        	<option value="" disabled selected>Selecciona el proveedor</option>
        	<?php
        	$consultaProveedor = $conexion->query("SELECT prov_id, prov_nombre FROM proveedor");
        	while ($rowProveedor = $consultaProveedor->fetch_array()) {
            echo "<option value='{$rowProveedor['prov_id']}'>{$rowProveedor['prov_nombre']}</option>";
        	}
        	?>
    		</select>
        		<p>Precio Proveedor: <input type="text" name="precioProveedor" required></p>
        		<p>Cantidad: <input type="text" name="cant_producto" required></p>
        		<p><input type="submit" value="Enviar"></p>
    		</form>
			</div>


			<div id="FormModifyCompra" class="FormModifyCompra" style="display: none">
			<span class="cerrar" id="cerrarBtn2"  onclick="cerrarFormularioModComprass()">&times;</span>
			<h3 class="pt-3 font-weight-bold">Modificar Compra</h3>
			<form action="../crud/CompraUpdate.php" method="post">
			<p>Código Tienda: <input value = "<?php echo $adminTienda ?>" name="cod_tienda" readonly onmousedown="return false;"></p>
            <p>Código compra: <input id="compra-codigo" type="text" name="codCompra" required></p>
		     <p>Producto:</p>
			<select name="codProducto" id="compra-producto-select" class="form-control" required>
            <option value="" disabled selected>Selecciona el producto</option>
    		<?php
    		$consulta = $conexion->query("SELECT pro_id, pro_nombre, prov_nombre FROM producto INNER JOIN proveedor ON producto.prov_id = proveedor.prov_id");
    		while ($row = $consulta->fetch_array()) {
    		    echo "<option value='{$row['pro_id']}' data-proveedor='{$row['prov_nombre']}'>{$row['pro_nombre']}</option>";
    		}
    		?>
			</select>
			<p>Proveedor:</p>
			<select name="prov_id" id="compra-proveedor-select" class="form-control" required>
        	<option value="" disabled selected>Selecciona el proveedor</option>
        	<?php
        	$consultaProveedor = $conexion->query("SELECT prov_id, prov_nombre FROM proveedor");
        	while ($rowProveedor = $consultaProveedor->fetch_array()) {
        	    echo "<option value='{$rowProveedor['prov_id']}'>{$rowProveedor['prov_nombre']}</option>";
        	}
        	?>
    		</select>
            <p>Precio Proveedor: <input id="compra-precio-proveedor" type="text" name="precioProveedor" required></p>
            <p>Cantidad: <input type="text" id="compra-cantidad" name="cant_producto" required></p>
            <p><input type="submit" value="Enviar"></p>
    		</form>
			</div>

			</div>
			<div class="table-data">
				<div class="order">
					<div class="head">
						<h3>Productos Comprados</h3>
						<i class='bx bx-search' ></i>
						<i class='bx bx-filter' ></i>
					</div>
					<table>
						<thead>
							<tr>
								<th>Código compra</th>
								<th>Proveedor</th>
								<th>Producto</th>
								<th>Cantidad</th>
								<th>Precio proveedor</th>
								<th>Subtotal</th>
							</tr>
						</thead>
						<tbody>
						<?php
						$totalCompras = 0;
						$consulta = $conexion ->query("SELECT c.com_id, pv.prov_id, pv.prov_nombre, p.pro_id, p.pro_nombre, c.com_cantidad, c.com_pre_provee
						FROM producto p
						INNER JOIN compra c
						ON p.pro_id = c.pro_id
						INNER JOIN proveedor pv
						ON c.prov_id = pv.prov_id
						WHERE tie_id =  '$adminTienda'");
						 while($row = $consulta ->fetch_array()){ ?>
						 <tr>
							<td> <?php echo $row["com_id"] ?></td> 
							<td> <?php echo $row["prov_nombre"] ?></td>
							<td> <?php echo $row["pro_nombre"]?></td>
							<td> <?php echo $row["com_cantidad"]?></td>
							<td> <?php echo $row["com_pre_provee"]?></td>
							<td><?php  $multiplicacion = $row['com_pre_provee'] * $row['com_cantidad'];
							echo $multiplicacion;
						?></td> 
							<td><button type="button" class="btn btn-primary" cod_compra="<?php echo $row['com_id']; ?>" prov_id="<?php echo $row['prov_id']; ?>" pro_id="<?php echo $row['pro_id']; ?>" com_cantidad="<?php echo $row['com_cantidad']; ?>" compra_pre_proveedor="<?php echo $row['com_pre_provee']; ?>" onclick="mostrarFormularioModCompras(this)">Editar</button></td>
						    <td><button class="btn btn-danger btn-eliminar" data-id-producto="<?php echo $row['com_id']; ?>">Eliminar</button></td>
							</tr>

							<?php 
							$totalCompras = $multiplicacion + $totalCompras;
						?>
						<?php }?>
							
						</tbody>
					</table>
				</div>
				
						 </div>

		</div>

		<!-- Final Compras -->

		<!-- Inicio ventas -->

		<div id="ventas">

		<div class="head-title">
				<div class="left">
					<h1>Ventas</h1>
					<ul class="breadcrumb">
						<li>
							<a href="#">Ventas</a>
						</li>
						<li><i class='bx bx-chevron-right' ></i></li>
						<li>
							<a class="active" href="#">Inicio</a>
						</li>
					</ul>
				</div>
			</div>

			<div class="Botones">
			<button class="AddCliente" id="AddCliente" onclick="mostrarFormularioCliente('formularioCliente')">Agregar cliente</button>
			<button class="AddProducto" id="AgregarProducto" onclick=" mostrarFormularioCompra('formularioCliente')">Agregar venta</button>

			</div>

			<div id="formularioCliente" style="display: none;">
			<span class="cerrar" id="cerrarCliente" onclick="cerrarFormularioCliente()">&times;</span>
			<h3 class="pt-3 font-weight-bold">Registro cliente</h3>
			<form id="formRegistroCliente" action="../crud/ClienteCreate.php" method="post">
				<?php  $cont = 3; ?>
				<p>id cliente: <?php echo $cont ?></p>
               <p>Número de documento<input type="text" name="cli_documento"></p>
               <p><input type="submit" value="Enviar"></p>
			   <?php $cont = $cont + 1;?>
            </form>
			</div>

			<div id="FormularioCrearVenta" class="PopUp_ModificarProd" style="display: none;">
			<span class="cerrar" id="cerrarBtn2" onclick="cerrarFormularioCrearCompra()">&times;</span>
			<h3 class="pt-3 font-weight-bold">Agregar venta</h3>
			<form action="../crud/VentaCreate.php" method="post">
            	<p>Fecha: <input type="date" name="fecha_venta" required></p>
				<p>Tienda: <input value = "<?php echo $adminTienda ?>" name="cod_tienda" readonly onmousedown="return false;"></p>
            	<p>Cliente:</p>
				<select name="cli_documento" id="venta_select" class="form-control">
                                <option value="" disabled selected>Seleccione el cliente</option>
                                    <?php
                                        foreach ($cliente as $item): 
                                        echo "<option value='{$item['cli_id']}'>{$item['cli_documento']}</option>";
                                     endforeach; ?>
                                </select>
				<p>Producto:</p>
        		<select name="codProducto"  class="form-control" required>
    			<option value="" disabled selected>Selecciona el producto</option>
				<?php
    				$consulta = $conexion->query("SELECT pt.pro_id, p.pro_nombre
                                  FROM producto_en_tienda pt
                                  INNER JOIN producto p ON pt.pro_id = p.pro_id WHERE tie_id = '$adminTienda'");

    					while ($row = $consulta->fetch_array()) {
        					$pro_id = $row["pro_id"];
        					$pro_nombre = $row["pro_nombre"];
        					?>
        					<option value="<?php echo $pro_id; ?>">
        					    <?php echo $pro_nombre . ' - ID: ' . $pro_id; ?>
        					</option> <?php } ?>
			</select>
            	<p>Cantidad: <input type="text" name="cant_producto" required></p>
            	<p><input type="submit" value="Enviar"></p>
    		</form>
			</div>

			<div id="FormModificarVenta" class="PopUp_ModificardPjro" style="display:none;">
			<span class="cerrar" id="cerrarBtn2" onclick="cerrarFormularioModVentas()">&times;</span>
			<h3 class="pt-3 font-weight-bold">Modificar venta</h3>
			<form action="../crud/VentaUpdate.php" method="post">
			    <p>Código Tienda: <input value = "<?php echo $adminTienda ?>" name="cod_tienda" readonly onmousedown="return false;"></p>
            	<p>Código venta: <input type="text" id="venta-codigo" name="cod_venta" required></p>
            	<p>Fecha: <input type="date" id="venta-fecha" name="fecha_venta" required></p>
            	<p>Cliente:</p>
				<select name="cli_documento" id="venta-documentocli" class="form-control">
                                <option value="" disabled selected>Seleccione el cliente</option>
                                    <?php
                                        foreach ($cliente as $item): 
                                        echo "<option value='{$item['cli_id']}'>{$item['cli_documento']}</option>";
                                     endforeach; ?>
                                </select>
				<p>Producto:</p>
            	<select name="codProducto" id="venta-productoid" class="form-control">
    			<option value="" disabled selected>Selecciona el producto</option>
				<?php
    				$consulta = $conexion->query("SELECT pt.pro_id, p.pro_nombre
                                  FROM producto_en_tienda pt
                                  INNER JOIN producto p ON pt.pro_id = p.pro_id WHERE tie_id = '$adminTienda'");

    					while ($row = $consulta->fetch_array()) {
        					$pro_id = $row["pro_id"];
        					$pro_nombre = $row["pro_nombre"];
        					?>
        					<option value="<?php echo $pro_id; ?>">
        					    <?php echo $pro_nombre . ' - ID: ' . $pro_id; ?>
        					</option> <?php } ?>
			</select>
            	<p>Cantidad: <input type="text" id="venta-cantidad" name="cant_producto"></p>
            	<p><input type="submit" value="Enviar"></p>
    		</form>
			</div>

			<div class="table-data">
				<div class="order">
					<div class="head">
						<h3>Productos Vendidos</h3>
						<i class='bx bx-search' ></i>
						<i class='bx bx-filter' ></i>
					</div>
					<table>
						<thead>
							<tr>
								<th>Código venta</th>
								<th>Fecha</th>
								<th>Documento Cliente</th>
								<th>Producto</th>
								<th>Cantidad</th>
								<th>Valor Unitario</th>
								<th>Subtotal</th>
							</tr>
						</thead>
						<tbody>
						<?php 
						$consulta = $conexion->query("SELECT v.cli_id, c.cli_documento, v.ven_fecha, v.ven_id, p.pro_id,p.pro_nombre, v.ven_cant, p.pro_precioVenta
						FROM producto p
						INNER JOIN venta v
						ON p.pro_id = v.pro_id
						INNER JOIN cliente c
						ON v.cli_id = c.cli_id WHERE tie_id = '$adminTienda'");
						$totalVentas = 0;
						$contadorVentas = 0;
						while($row = $consulta ->fetch_array()){?>
                    	<tr>
						<td><?php echo $row['ven_id']?></td>
						<td><?php echo $row['ven_fecha']?></td>
                        <td><?php echo $row['cli_documento']?></td>
						<td><?php echo $row['pro_nombre']?></td>
						<td><?php echo $row['ven_cant']?></td>
						<td><?php echo $row['pro_precioVenta']?></td>
						<td><?php  $multiplicacion = $row['pro_precioVenta'] * $row['ven_cant'];
							echo $multiplicacion;
						?></td>
						<?php 
							$contadorVentas = $row["ven_cant"] + $contadorVentas;
							$totalVentas = $multiplicacion + $totalVentas;
						?>
						 <td><button type="button" class="btn btn-primary" cod_venta="<?php echo $row['ven_id']; ?>" cliente_id="<?php echo $row['cli_id']; ?>" pro_id="<?php echo $row['pro_id']; ?>" ven_cantidad="<?php echo $row['ven_cant']; ?>" ven_fecha="<?php echo $row['ven_fecha']; ?>" onclick="mostrarFormularioModVentas(this)">Editar</button></td>
                		 <td><button class="btn btn-danger btn-eliminar" data-id-venta="<?php echo $row['ven_id'];?>">Eliminar</button></td>
           				
                    	</tr>
						  <?php } ?>

						</tbody>
					</table>
				</div>
				
			</div>

			
		</div>

		<!-- Final ventas -->

		
		<!-- Inicio  Administrador-->

		<div id = "admin">

			<div class="head-title">
				<div class="left">
					<h1>Perfil</h1>
					<ul class="breadcrumb">
						<li>
							<a href="#">Su perfil</a>
						</li>
						<li><i class='bx bx-chevron-right' ></i></li>
						<li>
							<a class="active" href="#">Inicio</a>
						</li>
					</ul>
				</div>
			</div>
				<?php
				$consulta = $conexion ->query("SELECT adm_id,adm_nombre,adm_cargo,adm_usuario,adm_contraseña,tie_nombre,tie_direccion FROM administrador a INNER JOIN tienda t
				ON a.tie_id = t.tie_id WHERE a.adm_id = '$adminId'");
				while($row = $consulta ->fetch_array()){ ?>
						
						<?php $idAdmin= $row["adm_id"]; ?></p> 
						<?php $admNombre = $row["adm_nombre"]; ?></p> 
						<?php $admCargo = $row["adm_cargo"]; ?></p> 
						<?php $admusuario = $row["adm_usuario"]; ?></p> 
						<?php $admcontraseña = $row["adm_contraseña"]; ?></p> 
						<?php $tiendaNombrecito = $row["tie_nombre"]; ?></p> 
						<?php $tiendaDireccion = $row["tie_direccion"]; ?></p> 
			
				<?php }   ?>

			<div id="form_admin" class="form_admin">
			<form class="formADMin" action="../crud//AdminUpdate.php" method="POST">
                        <div class="form-group py-2">
                            <div class="input-field">
                                <span class="far fa-user p-2"></span>
                                <input type="text" name="num_documento"  id="documento" placeholder="Documento" required  value="<?php echo $idAdmin; ?>">
                            </div>
                        </div>

                        <div class="form-group py-2">
                            <div class="input-field">
                                <span class="far fa-user p-2"></span>
                                <input type="text" name="adm_nombre" id="nombre" placeholder="Nombre" required  value="<?php echo $admNombre; ?>">

                            </div>
                        </div>

                        <div class="form-group py-2">
                         <div class="input-field">
                             <span class="far fa-user p-2"></span>
                             <select name="adm_cargo"  id="cargo" class="form-control" required>
                                 <option value="" disabled selected>Selecciona el Cargo</option>
								 <option value="administrador" <?php echo ($admCargo == 'administrador') ? 'selected' : ''; ?>>Administrador</option>
                                <option value="supervisor" <?php echo ($admCargo == 'supervisor') ? 'selected' : ''; ?>>Supervisor</option>
                             </select>
                         </div>
                         </div>


                        <div class="form-group py-2">
                            <div class="input-field">
                                <span class="far fa-user p-2"></span>
                                <input type="text" name="adm_usuario" id="usuario" placeholder="Usuario" required  value="<?php echo $admusuario; ?>">
                            </div>
                        </div>
                        <div class="form-group py-1 pb-2">
                            <div class="input-field">
                                <span class="fas fa-lock px-2"></span>
                                <input type="password" name="adm_contrasena"  id="contraseña" placeholder="Ingrese su contraseña" required  value="<?php echo $admcontraseña; ?>">
                                <button type="button" class="btn bg-white text-muted">
                                    <span class="far fa-eye-slash"></span>
                                </button>
                            </div>
                        </div>
                        
                        <div class="form-group py-2">
    					<div class="input-field">
    					    <span class="far fa-user p-2"></span>
    					    <select name="tienda_codigo" class="form-control">
    					        <option value="" disabled>Selecciona la tienda</option>
    					        <?php
    					        foreach ($tienda as $item):
    					            $selected = ($item['tie_id'] == $tiendaNombrecito) ? 'selected' : '';
    					            echo "<option value='{$item['tie_id']}' $selected>{$item['tie_nombre']}</option>";
    					        endforeach;
    					        ?>
    					    </select>
    					</div>
						</div>


                        <div>
							<button type="submit"class="btn btn-primary btn-block mt-3" id="ModificarProducto">Modificar información</button>
                        </div>
                    </form>
					</div>

					<a href="../clases/cerrarSesion.php" class="logout">
					<i class='bx bxs-log-out-circle' ></i>
					<span class="text">Cerrar Sesión</span>
			        </a>
		</div>

		<!-- Final Administrador -->

		<!-- Inicio dashboard -->

		<div id="inicio">
			<div class="head-title">
				<div class="left">
					<h1>Dashboard</h1>
					<ul class="breadcrumb">
						<li>
							<a href="#">Dashboard</a>
						</li>
						<li><i class='bx bx-chevron-right' ></i></li>
						<li>
							<a class="active" href="#">Inicio</a>
						</li>
					</ul>
				</div>
				
			</div>

			<ul class="box-info">
				<li>
					<i class='bx bxs-calendar-check' ></i>
					<span class="text">
						<h3><?php echo $totalProductosEnTienda;?></h3>
						<p>Productos disponibles en Tienda</p>
					</span>
				</li>
				<li>
					<i class='bx bxs-group' ></i>
					<span class="text">
						<h3>$<?php echo $totalCompras;?></h3>
						<p>Valor total de compras</p>
					</span>
				</li>
				<li>
					<i class='bx bxs-dollar-circle' ></i>
					<span class="text">
						<h3>
						<h3>$<?php echo $totalVentas;?></h3>
						</h3>
						<p>Valor total de ventas</p>
					</span>
				</li>

				<li>
				<i class='bx bxs-wallet' style='color:#566944' ></i>
					<span class="text">
						<h3><?php echo $ganancias = $totalVentas - $totalCompras;?></h3>
						<p>Ganancias</p>
					</span>
				</li>
			</ul>

			<h1>Compras, Ventas y Productos</h1>
				<p>Visualización de estadisticas</p>

			<div class="dashboardGraficas">
		
				<canvas id="productoVentasChart" ></canvas>
			
				
				<canvas id="productoComprasChart"></canvas>
			
			
				<canvas id="TiendasCantidadProChart"></canvas>
				
			</div>

		</div>

		<!-- Final DashBoard -->

		</main>

		<!-- MAIN -->
	</section>
	<!-- CONTENT -->

	<script src="../dist/cambioSeccion.js"></script>
	<script src="../dist/cliente.js"></script>
	<script src="../dist/proveedor.js"></script>
	<script src="../dist/script.js"></script>
	<script src="../dist/updateProducto.js"></script>
	<script src="../dist/updateProductoTienda.js"></script>
	<script src="../dist/eliminarProducto.js"></script>
	<script src="../dist/eliminarProveedor.js"></script>

	<script src="../dist/updateVentas.js"></script>	
	<script src="../dist/updateCompras.js"></script>	
</body>
</html>
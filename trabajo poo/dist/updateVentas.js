function mostrarFormularioModVentas(btnEditar) {
    var ventaId = btnEditar.getAttribute("cod_venta");
    var proId = btnEditar.getAttribute("pro_id");
    var cli_id = btnEditar.getAttribute("cliente_id");
    var venta_cantidad = btnEditar.getAttribute("ven_cantidad");
    var venta_fecha= btnEditar.getAttribute("ven_fecha");

    document.getElementById("venta-codigo").value = ventaId;
    document.getElementById("venta-fecha").value = venta_fecha; 
    document.getElementById("venta-documentocli").value = cli_id;
    document.getElementById("venta-productoid").value = proId;
    document.getElementById("venta-cantidad").value = venta_cantidad;
    document.getElementById("FormModificarVenta").style.display = "block";
}

function cerrarFormularioModVentas() {
    document.getElementById("FormModificarVenta").style.display = "none";
}

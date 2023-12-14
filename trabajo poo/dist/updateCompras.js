function mostrarFormularioModCompras(btnEditar) {
    var compraId = btnEditar.getAttribute("cod_compra");
    var proId = btnEditar.getAttribute("pro_id");
    var prov_id = btnEditar.getAttribute("prov_id");
    var precio_proveedor = btnEditar.getAttribute("compra_pre_proveedor");
    var cant_compra= btnEditar.getAttribute("com_cantidad");

    document.getElementById("compra-codigo").value = compraId;
    document.getElementById("compra-producto-select").value = proId; 
    document.getElementById("compra-proveedor-select").value = prov_id;
    document.getElementById("compra-precio-proveedor").value = precio_proveedor;
    document.getElementById("compra-cantidad").value = cant_compra;

    document.getElementById("FormModifyCompra").style.display = "block";
}

function cerrarFormularioModComprass() {
    document.getElementById("FormModifyCompra").style.display = "none";
}

function mostrarFormularioModCompras(btnEditar) {
    var proId = btnEditar.getAttribute("pro_id");
    var proTienda_id = btnEditar.getAttribute("pro_tienda_id");
    var proCantTienda = btnEditar.getAttribute("pro_tienda_cant");
    var proTiendaRepartidor = btnEditar.getAttribute("persona_entrega_producto");
    var fechaEntregaProTienda = btnEditar.getAttribute("fecha_entrega_producto");

    document.getElementById("proTien-pro-id").value = proTienda_id;
    document.getElementById("proTien-select-pro").value = proId; 
    document.getElementById("proTien-pro-cant").value = proCantTienda;
    document.getElementById("proTien-pro-repartidor").value = proTiendaRepartidor;
    document.getElementById("proTien-pro-fechaLLegada").value = fechaEntregaProTienda;

    document.getElementById("FormModifyProTienda").style.display = "block";
}

function cerrarFormularioModProTienda() {
    document.getElementById("FormModifyProTienda").style.display = "none";
}

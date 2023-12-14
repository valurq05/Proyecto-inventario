function mostrarFormularioModProducto(btnEditar) {
   
    var proId = btnEditar.getAttribute("pro_id");
    var proNombre = btnEditar.getAttribute("pro_nombre");
    var provNombre = btnEditar.getAttribute("prov_nombre");
    var proPrecioVenta = btnEditar.getAttribute("pro_precioVenta");

    document.getElementById("pro-mod-id").value = proId;
    document.getElementById("pro-mod-nombre").value = proNombre;
    document.getElementById("pro-mod-valor-venta").value = proPrecioVenta;

    // Selecciona el proveedor en el formulario
    var selectProveedor = document.getElementById("proveedorSelectModPro");
    for (var i = 0; i < selectProveedor.options.length; i++) {
        if (selectProveedor.options[i].text === provNombre) {
            selectProveedor.options[i].selected = true;
            break;
        }
    }

    document.getElementById("FormModifProducto").style.display = "block";
}

function cerrarFormularioModProducto() {
    document.getElementById("FormModifProducto").style.display = "none";
}

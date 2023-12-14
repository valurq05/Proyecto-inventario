function mostrarFormularioModProveedor(btnEditar) {
    var provId = btnEditar.getAttribute("proveedorid");
    var provNombre = btnEditar.getAttribute("proveedornombre");
    var provCorreo = btnEditar.getAttribute("proveedorcorreo");
    var provTelefono = btnEditar.getAttribute("proveedortelefono");

    document.getElementById("proveedor-codigo").value = provId;
    document.getElementById("proveedor-nombre").value = provNombre;
    document.getElementById("proveedor-telefono").value = provTelefono;
    document.getElementById("proveedor-correo").value = provCorreo;
    document.getElementById("FormModProveedor").style.display = "block";
}

function cerrarFormularioModProveedor() {
    document.getElementById("FormModProveedor").style.display = "none";
}

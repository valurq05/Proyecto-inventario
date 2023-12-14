function mostrarFormularioModVentas(btnEditar) {
    var provId = btnEditar.getAttribute("prov_id");
    var provNombre = btnEditar.getAttribute("prov_nombre");
    var provCorreo = btnEditar.getAttribute("prov_correo");
    var provTelefono = btnEditar.getAttribute("prov_telefono");


    document.getElementById("proveedor-codigo").value = provId;
    document.getElementById("proveedor-nombre").value = provNombre; 
    document.getElementById("proveedor-telefono").value = provCorreo;
    document.getElementById("proveedor-correo").value = provTelefono;
    document.getElementById("FormModProveedor").style.display = "block";
}

function cerrarFormularioModVentas() {
    document.getElementById("FormModProveedor").style.display = "none";
}

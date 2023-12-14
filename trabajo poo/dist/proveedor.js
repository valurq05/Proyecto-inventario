document.addEventListener('DOMContentLoaded', function() {
    var selectProducto = document.getElementById('productoSelect');
    var selectProveedor = document.getElementById('proveedorSelect');

    selectProducto.addEventListener('change', function() {
        var selectedOption = selectProducto.options[selectProducto.selectedIndex];
        var proveedorId = selectedOption.getAttribute('data-proveedor');

        for (var i = 0; i < selectProveedor.options.length; i++) {
            if (selectProveedor.options[i].value === proveedorId) {
                selectProveedor.selectedIndex = i;
                break;
            }
        }
    });
});
$(document).ready(function() {
    $('.btn-eliminar').on('click', function() {
        var idProducto = $(this).data('id-producto');

        $.ajax({
            type: 'POST',
            url: '/ruta/a/tu/script.php',
            data: { action: 'eliminar', pro_id: idProducto },
            success: function(response) {
                console.log('Producto eliminado con éxito');
                location.reload();
            },
            error: function(error) {
                console.error('Error al eliminar el producto', error);
            }
        });
    });
});

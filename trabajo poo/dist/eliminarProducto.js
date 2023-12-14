$(document).ready(function() {
    $('.btn-eliminar').on('click', function() {
        var idProducto = $(this).data('id-producto');
        Swal.fire({
            title: "Estas seguro de eliminar este producto?",
            text: "No podras reversar esta accion!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Si, Eliminar"
          }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: 'POST',
                    url: '../crud/ProductoDelete.php',
                    data: {
                         id:idProducto},
                    success: function(response) {
                        location.reload()
                    },
                    error: function(error) {
                        console.error('Error al eliminar el producto', error);
                    }
                });
            }
          });

    
    });
});

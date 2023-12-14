$(document).ready(function() {
    console.log("working")
    $('.btn-eliminar-producto-tienda').on('click', function() {
        var idProductoTienda = $(this).data('id-productotienda');
        console.log(idProductoTienda);
        Swal.fire({
            title: "Seguro que quieres eliminar este producto de la tienda?",
            text: "No podrás reversar esta accion!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Eliminar"
          }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: 'POST',
                    url: '../crud/ProductoTienDelete.php',
                    data: {
                         id:idProductoTienda},
                    success: function(response) {
                        location.reload()
                    },
                    error: function(error) {
                        console.error('Error al eliminar el producto en tienda', error);
                    }
                });
            }
          });

    
    });
});

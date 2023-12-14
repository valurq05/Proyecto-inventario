$(document).ready(function() {
    $('.btn-eliminar-compra').on('click', function() {
        console.log("working")
        var idCompra = $(this).data('id-compra');
        console.log(idProveedor)
        Swal.fire({
            title: "Seguro que quieres eliminar esta compra?",
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
                    url: '../crud/CompraDelete.php',
                    data: {
                         id:idProveedor},
                    success: function(response) {
                        location.reload()
                    },
                    error: function(error) {
                        console.error('Error al eliminar el proveedor', error);
                    }
                });
            }
          });
    });
});

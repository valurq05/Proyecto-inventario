$(document).ready(function() {
    $('.btn-eliminar-venta').on('click', function() {
        console.log("working")
        var idVenta = $(this).data('id-venta');
        console.log(idVenta)
        Swal.fire({
            title: "Seguro que quieres eliminar esta venta?",
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
                    url: '../crud/VentaDelete.php',
                    data: {
                         id:idVenta},
                    success: function(response) {
                        location.reload()
                    },
                    error: function(error) {
                        console.error('Error al eliminar la venta', error);
                    }
                });
            }
          });
    });
});

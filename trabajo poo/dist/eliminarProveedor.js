$(document).ready(function() {
    $('.btn-eliminar').on('click', function() {
        var idProveedor = $(this).data('id-proveedor');
        Swal.fire({
            title: "Estás seguro de eliminar este proveedor?",
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
                    url: '../crud/ProveedorDelete.php',
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

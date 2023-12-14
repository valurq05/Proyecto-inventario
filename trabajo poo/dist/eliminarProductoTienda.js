$(document).ready(function() {
    console.log("working")
    $('.btn-eliminar-producto-tienda').on('click', function() {
<<<<<<< HEAD:trabajo poo/dist/eliminarProductoTienda.js
        var idProductoTienda = $(this).data('id-productotienda');
=======
        console.log("working");
        var idProductoTienda = $(this).data('id-productoTienda');
>>>>>>> 1264fa60742d932ecbfd82b1f8a783c8a9cd499c:trabajo poo/dist/eliminarProdcutoTienda.js
        console.log(idProductoTienda);
        Swal.fire({
            title:"Seguro que quieres eliminar este producto de la tienda?",
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

$(document).ready(function () {
    $(".add-deseo").click(function (event) {
        event.preventDefault();

        // Obtener datos del producto
        var productId = $(this).data('id');
        var productName = $(this).data('nombre');
        var productPrice = $(this).data('precio');

        // Obtener la lista actual de deseos desde localStorage
        var listaDeseos = JSON.parse(localStorage.getItem('listaDeseos')) || [];

        // Verificar si el producto ya está en la lista
        var productoExistente = listaDeseos.find(function (producto) {
            return producto.id === productId;
        });

        if (!productoExistente) {
            // Agregar el nuevo producto a la lista de deseos
            listaDeseos.push({
                id: productId,
                nombre: productName,
                precio: productPrice
            });

            // Actualizar localStorage con la nueva lista de deseos
            localStorage.setItem('listaDeseos', JSON.stringify(listaDeseos));
            updateDeseoView()
            message('Producto añadido a la lista de deseos', 'success');
        } else {
            message('El producto ya está en la lista de deseos', 'warning');
        }
    });
});
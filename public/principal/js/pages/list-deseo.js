$(document).ready(function () {
    updateCartView();
    updateDeseoView();

    // Obtener la lista de deseos desde localStorage
    var listaDeseos = JSON.parse(localStorage.getItem('listaDeseos')) || [];

    // Función para renderizar la lista de deseos en la tabla
    function renderizarListaDeseos() {
        var cartBody = $('#cart-body');
        cartBody.empty();

        if (listaDeseos.length === 0) {
            // Mostrar un mensaje si no hay productos en la lista de deseos
            cartBody.append('<tr><td colspan="4">No hay productos en la lista de deseos</td></tr>');
        } else {
            // Renderizar la lista de deseos si hay productos
            listaDeseos.forEach(function (producto) {
                var fila = $('<tr>');
                fila.append('<td class="text-left">' + producto.nombre + '</td>');
                fila.append('<td>$' + producto.precio + '</td>');
                fila.append('<td><button class="btn btn-danger eliminar" data-id="' + producto.id + '">Eliminar</button></td>');
                fila.append('<td><button class="btn btn-primary mover-carrito" data-id="' + producto.id + '">Mover al carrito</button></td>');
                cartBody.append(fila);
            });
        }

        updateCartView();
        updateDeseoView();
    }

    // Llamar a la función para inicializar la tabla
    renderizarListaDeseos();

    // Manejar clic en el botón de eliminar
    $('#cart-body').on('click', '.eliminar', function () {
        var productId = $(this).data('id');

        // Filtrar la lista de deseos para excluir el producto con el ID seleccionado
        listaDeseos = listaDeseos.filter(function (producto) {
            return producto.id !== productId;
        });

        // Actualizar localStorage con la nueva lista de deseos
        localStorage.setItem('listaDeseos', JSON.stringify(listaDeseos));

        // Volver a renderizar la tabla
        renderizarListaDeseos();
    });

    // ...

    $('#cart-body').on('click', '.mover-carrito', function () {
        var productId = $(this).data('id');

        // Obtener el producto de la lista de deseos
        var productoAMover = listaDeseos.find(function (producto) {
            return producto.id === productId;
        });

        if (productoAMover) {
            // Comprobar si el producto ya está en el carrito
            var carrito = JSON.parse(localStorage.getItem('cart')) || [];
            var productoEnCarrito = carrito.find(function (producto) {
                return producto.id === productId;
            });

            if (productoEnCarrito) {
                // Aumentar la cantidad en 1 si el producto ya está en el carrito
                productoEnCarrito.quantity += 1;
            } else {
                // Ajustar la cantidad a 1 si es la primera vez que se agrega
                productoAMover.quantity = 1;

                // Agregar el producto al carrito (puedes tener otra clave en localStorage para el carrito)
                carrito.push(productoAMover);
            }

            // Actualizar localStorage con la nueva lista de deseos
            localStorage.setItem('cart', JSON.stringify(carrito));

            // Eliminar el producto de la lista de deseos
            listaDeseos = listaDeseos.filter(function (producto) {
                return producto.id !== productId;
            });

            // Actualizar localStorage con la nueva lista de deseos
            localStorage.setItem('listaDeseos', JSON.stringify(listaDeseos));
            message('Producto agregado al carrito', 'success');
            // Volver a renderizar la tabla de lista de deseos
            renderizarListaDeseos();
        } else {
            message('Producto no encontrado en la lista de deseos', 'error');
        }
    });

    // ...

});

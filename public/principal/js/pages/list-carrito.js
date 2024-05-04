$(document).ready(function () {
    updateCartView();
    // Función para cargar y mostrar productos del carrito
    function loadCart() {
        var cart = JSON.parse(localStorage.getItem('cart')) || [];
        var cartBody = $('#cart-body');
        var cartTotalContainer = $('#cart-total-container');

        // Limpiar la tabla y el total actual
        cartBody.empty();

        // Verificar si el carrito está vacío
        if (cart.length === 0) {
            // Mostrar una alerta o mensaje indicando que el carrito está vacío
            cartBody.append('<tr><td colspan="5">Tu carrito está vacío</td></tr>');

            // También puedes ocultar el contenedor del total
            cartTotalContainer.hide();
            return; // Salir de la función, ya que no hay productos en el carrito
        } else {
            // Si hay productos, mostrar el contenedor del total
            cartTotalContainer.show();
        }

        // Iterar sobre los productos en el carrito
        cart.forEach(function (item) {
            // Crear una fila para cada producto
            var row = '<tr>' +
                '<td class="shoping__cart__item">' +
                '<h5>' + item.nombre + '</h5>' + // Asegúrate de tener la propiedad correcta
                '</td>' +
                '<td class="shoping__cart__price">$' + parseFloat(item.precio).toFixed(2) + '</td>' +
                '<td class="shoping__cart__quantity">' +
                '<div class="quantity">' +
                '<div class="pro-qty">' +
                '<input type="number" value="' + item.quantity + '" min="1" data-product-id="' + item.id + '">' +
                '</div>' +
                '</div>' +
                '</td>' +
                '<td class="shoping__cart__total">$' + (item.quantity * parseFloat(item.precio)).toFixed(2) + '</td>' +
                '<td class="shoping__cart__item__close">' +
                '<span class="icon_close" data-product-id="' + item.id + '"></span>' +
                '</td>' +
                '</tr>';

            cartBody.append(row);
        });

        // Calcular el total del carrito
        var cartTotal = cart.reduce(function (total, item) {
            return total + (item.quantity * parseFloat(item.precio));
        }, 0);

        // Mostrar el total del carrito
        var totalHTML = '<h5>Total del carrito</h5>' +
            '<ul>' +
            '<li>Subtotal <span>$' + cartTotal.toFixed(2) + '</span></li>' +
            '<li>Total <span>$' + cartTotal.toFixed(2) + '</span></li>' +
            '</ul>' +
            '<a href="' + base_url + 'checkout" class="primary-btn">PROCESAR</a>';

        cartTotalContainer.html(totalHTML);
    }

    // Llama a esta función al cargar la página para mostrar el carrito inicial
    loadCart();

    // Evento de cambio de cantidad
    $(document).on('change', '.pro-qty input', function () {
        var newQuantity = parseInt($(this).val());
        var productId = $(this).data('product-id');

        // Obtener el carrito actual desde localStorage
        var cart = JSON.parse(localStorage.getItem('cart')) || [];

        // Actualizar la cantidad en el carrito
        var productIndex = cart.findIndex(function (item) {
            return item.id === productId;
        });

        if (productIndex !== -1) {
            cart[productIndex].quantity = newQuantity;

            // Guardar el carrito actualizado en localStorage
            localStorage.setItem('cart', JSON.stringify(cart));

            // Actualizar la visualización del carrito
            loadCart();
            updateCartView();
        }
    });

    // Evento de eliminación de producto
    $(document).on('click', '.icon_close', function () {
        var productId = $(this).data('product-id');

        // Obtener el carrito actual desde localStorage
        var cart = JSON.parse(localStorage.getItem('cart')) || [];

        // Eliminar el producto del carrito
        var updatedCart = cart.filter(function (item) {
            return item.id !== productId;
        });

        // Guardar el carrito actualizado en localStorage
        localStorage.setItem('cart', JSON.stringify(updatedCart));
        message('Producto eliminado del carrito', 'success');
        // Actualizar la visualización del carrito
        loadCart();

        updateCartView();
    });
});
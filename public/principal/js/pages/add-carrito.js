$(document).ready(function () {
    $('.add-to-cart').on('click', function (e) {
        e.preventDefault();

        // Obtener el ID, precio y cualquier otra información del producto desde el atributo data-product-id, data-precio, etc.
        var productId = $(this).data('product-id');
        var productTitle = $(this).data('nombre');
        var productCant = 1;
        var productPrice = parseFloat($(this).data('precio')); // Asegúrate de convertir el precio a un número

        addCarrito(productId, productTitle, productCant, productPrice);
    });

    // Llama a esta función al cargar la página para mostrar la cantidad y el total iniciales
    updateCartView();
});
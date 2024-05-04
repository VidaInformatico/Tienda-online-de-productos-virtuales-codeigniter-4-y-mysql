$(document).ready(function () {
    $('.add-to-cart').on('click', function (e) {
        e.preventDefault();

        // Obtener el ID, precio y cualquier otra información del producto desde el atributo data-product-id, data-precio, etc.
        var productId = $(this).data('product-id');
        var productTitle = $(this).data('nombre');
        var productCant = $('#cantidadAdd').val();
        var productPrice = parseFloat($(this).data('precio')); // Asegúrate de convertir el precio a un número

        addCarrito(productId, productTitle, productCant, productPrice);
    });

    // Llama a esta función al cargar la página para mostrar la cantidad y el total iniciales
    updateCartView();

    
});

function compartirEnFacebook() {
    var urlActual = obtenerUrlActual();
    window.open('https://www.facebook.com/sharer/sharer.php?u=' + encodeURIComponent(urlActual), '_blank');
}

function compartirEnTwitter() {
    var urlActual = obtenerUrlActual();
    window.open('https://twitter.com/intent/tweet?url=' + encodeURIComponent(urlActual), '_blank');
}

function compartirEnPinterest() {
    var urlActual = obtenerUrlActual();
    window.open('https://pinterest.com/pin/create/button/?url=' + encodeURIComponent(urlActual), '_blank');
}

function obtenerUrlActual() {
    // Obtener la URL actual del navegador
    return window.location.href;
}
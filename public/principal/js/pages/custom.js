// Función para actualizar la visualización del carrito
function updateCartView() {
    // Obtener el carrito actual desde localStorage o inicializar uno vacío
    var cart = JSON.parse(localStorage.getItem('cart')) || [];

    // Calcular la cantidad total de productos y el precio total
    var totalQuantity = cart.reduce(function (total, item) {
        return parseInt(total) + parseInt(item.quantity);
    }, 0);

    var totalPrice = cart.reduce(function (total, item) {
        // Agregar la multiplicación del precio por la cantidad
        return parseFloat(total) + (parseInt(item.quantity) * parseFloat(item.precio));
    }, 0);

    // Actualizar la visualización en el HTML
    $('#cart-count').text(totalQuantity);
    $('#cart-count1').text(totalQuantity);
    $('#cart-total').text('$' + totalPrice.toFixed(2));
    $('#cart-total1').text('$' + totalPrice.toFixed(2));
}

function updateDeseoView() {
    // Obtener la lista de deseos actual desde localStorage o inicializar una vacía
    var listaDeseos = JSON.parse(localStorage.getItem('listaDeseos')) || [];
    console.log(listaDeseos);
    // Actualizar la visualización en el HTML
    $('#wishlist-count').text(listaDeseos.length);
    $('#wishlist-count1').text(listaDeseos);
}


function addCarrito(productId, productTitle, productCant, productPrice) {
    // Obtener el carrito actual desde localStorage o inicializar uno vacío
    var cart = JSON.parse(localStorage.getItem('cart')) || [];

    // Verificar si el producto ya está en el carrito
    var existingProduct = cart.find(function (item) {
        return item.id === productId;
    });

    if (existingProduct) {
        // Incrementar la cantidad si el producto ya está en el carrito
        existingProduct.quantity += parseInt(productCant);
    } else {
        // Agregar el producto al carrito con cantidad 1
        cart.push({ id: productId, quantity: productCant, nombre: productTitle, precio: productPrice });
    }

    // Guardar el carrito actualizado en localStorage
    localStorage.setItem('cart', JSON.stringify(cart));

    // Actualizar la visualización del carrito
    updateCartView();

    message('Producto agregado al carrito', 'success');
}

function message(title, tipo) {
    Swal.fire({
        toast: true,
        position: 'top-right',
        icon: tipo,
        title: title,
        showConfirmButton: false,
        timer: 2000
    })
}
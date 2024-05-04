$(document).ready(function () {
    updateCartView();

    // Obtener el elemento del tbody de la tabla
    const tbodyElement = document.getElementById("productList");
    // Obtener el elemento del subtotal
    const subtotalElement = document.getElementById("subtotal");
    // Obtener el elemento del total
    const totalElement = document.getElementById("total");

    // Obtener productos desde localStorage
    const storedProducts = JSON.parse(localStorage.getItem("cart")) || [];

    // Mostrar productos en la tabla
    storedProducts.forEach(product => {
        const row = tbodyElement.insertRow();
        
        // Columna para la cantidad de productos
        const quantityCell = row.insertCell(0);
        quantityCell.textContent = product.quantity;

        // Columna para el nombre del producto (truncado)
        const nameCell = row.insertCell(1);
        const truncatedName = truncateProductName(product.nombre, 20); // Cambia 20 al valor deseado
        nameCell.textContent = truncatedName;

        // Columna para el precio del producto
        const priceCell = row.insertCell(2);
        priceCell.textContent = `$${parseFloat(product.precio).toFixed(2)}`;
    });

    // Calcular y mostrar subtotal y total
    const subtotal = storedProducts.reduce((acc, product) => acc + parseFloat(product.precio) * parseInt(product.quantity), 0);
    subtotalElement.querySelector("span").textContent = `$${subtotal.toFixed(2)}`;
    totalElement.querySelector("span").textContent = `$${subtotal.toFixed(2)}`;
});

// Función para truncar el nombre del producto si es demasiado largo
function truncateProductName(name, maxLength) {
    return name.length > maxLength ? name.slice(0, maxLength) + "..." : name;
}
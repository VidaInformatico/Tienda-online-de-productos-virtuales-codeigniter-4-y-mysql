<?= $this->extend('cliente_layout') ?>

<?= $this->section('content') ?>

<div class="card">
    <div class="card-body">
        <div class="accordion" id="accordionExample">
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingOne">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        PAYPAL
                    </button>
                </h2>
                <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <div id="paypal-button-container"></div>
                    </div>
                </div>
            </div>
            <!-- <div class="accordion-item">
                <h2 class="accordion-header" id="headingTwo">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                        MERCADO PAGO
                    </button>
                </h2>
                <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        
                    
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingThree">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                        STRIPE
                    </button>
                </h2>
                <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        
                    </div>
                </div>
            </div> -->
        </div>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('js') ?>
<script src="<?= base_url('principal/js/pages/custom.js'); ?>"></script>
<script src="https://www.paypal.com/sdk/js?client-id=AZGIq7dkoOaS1jGfWhL3NmwZldHgVypW11yqjvY2vAIx3HZjBneyWUOgwu3RUMKykR-UK8uEhUE1PKWx&currency=USD"></script>
<script>
    mostrarPaypal()

    function mostrarPaypal() {
        // Recuperar productos desde el localStorage
        const storedProducts = JSON.parse(localStorage.getItem("cart")) || [];

        // Calcular el total basado en los productos
        const total = calculateTotal(storedProducts);

        paypal
            .Buttons({
                createOrder: (data, actions) => {
                    return actions.order.create({
                        application_context: {
                            shipping_preference: "NO_SHIPPING",
                        },
                        purchase_units: [{
                            amount: {
                                currency_code: "USD",
                                value: total,
                                breakdown: {
                                    item_total: {
                                        currency_code: "USD",
                                        value: total,
                                    },
                                },
                            },
                            items: storedProducts.map(product => {
                                return {
                                    name: product.nombre,
                                    quantity: product.quantity,
                                    unit_amount: {
                                        currency_code: "USD",
                                        value: product.precio,
                                    },
                                };
                            }),
                        }, ],
                    });
                },
                onApprove(data, actions) {
                    return actions.order.capture().then(function(orderData) {
                        fetch('<?= base_url('registrarPedido'); ?>', {
                                method: "POST",
                                headers: {
                                    "Content-Type": "application/json",
                                },
                                body: JSON.stringify({
                                    pedidos: orderData,
                                    productos: storedProducts,
                                }),
                            })
                            .then((response) => response.json())
                            .then((data) => {
                                message(data.msg, data.icono);
                                if (data.icono == "success") {
                                    localStorage.removeItem('cart');
                                    setTimeout(function() {
                                        window.location = '<?= base_url('descargas'); ?>';
                                    }, 1500);
                                }
                            });
                    });
                },
            })
            .render("#paypal-button-container");
    }

    // Función para calcular el total basado en los productos
    function calculateTotal(products) {
        return products.reduce((acc, product) => acc + product.precio * product.quantity, 0).toFixed(2);
    }
</script>
<?= $this->endSection() ?>
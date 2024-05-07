<?= $this->extend('tienda_layout') ?>

<?= $this->section('content') ?>

<section class="breadcrumb-section set-bg" data-setbg="<?= base_url('principal'); ?>/img/breadcrumb.jpg">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="breadcrumb__text">
                    <h2>Producto en el Carrito</h2>
                    <div class="breadcrumb__option">
                        <a href="<?= base_url(); ?>">Home</a>
                        <span>Carrito</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="shoping-cart spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="shoping__cart__table">
                            <table>
                                <thead>
                                    <tr>
                                        <th class="shoping__product">Producto</th>
                                        <th>Precio</th>
                                        <th>Cantidad</th>
                                        <th>Total</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody id="cart-body">
                                    <!-- Aquí se agregarán las filas del carrito -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <!-- <div class="col-lg-6">
                <div class="shoping__continue">
                    <div class="shoping__discount">
                        <h5>Códigos de descuento</h5>
                        <form action="#">
                            <input type="text" placeholder="Ingrese su código de cupón">
                            <button type="submit" class="site-btn">APLICAR CUPÓN</button>
                        </form>
                    </div>
                </div>
            </div> -->
            <div class="col-lg-6 ml-auto">
                <div class="shoping__checkout" id="cart-total-container">
                    <!-- Aquí se mostrará el total del carrito -->
                </div>
            </div>
        </div>
    </div>
</section>

<?= $this->endSection() ?>

<?= $this->section('js') ?>
<script src="<?= base_url('principal/js/pages/custom.js'); ?>"></script>
<script src="<?= base_url('principal/js/pages/list-carrito.js'); ?>"></script>
<script>
    updateDeseoView()
</script>
<?= $this->endSection() ?>
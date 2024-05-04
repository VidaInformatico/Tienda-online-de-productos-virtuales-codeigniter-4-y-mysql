<?= $this->extend('tienda_layout') ?>

<?= $this->section('content') ?>
    <!-- ... Tu código existente ... -->

    <section class="shoping-cart spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="shoping__cart__table">
                        <table>
                            <thead>
                                <tr>
                                    <th class="shoping__product">Producto</th>
                                    <th>Precio</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody id="cart-body">
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>

<?= $this->endSection() ?>

<?= $this->section('js') ?>
    <!-- ... Tu código existente ... -->
    <script src="<?= base_url('principal/js/pages/custom.js'); ?>"></script>
    <script src="<?= base_url('principal/js/pages/list-deseo.js'); ?>"></script>
<?= $this->endSection() ?>
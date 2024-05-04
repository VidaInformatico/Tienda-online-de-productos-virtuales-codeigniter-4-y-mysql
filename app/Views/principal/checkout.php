<?= $this->extend('cliente_layout') ?>

<?= $this->section('content') ?>

<div class="card">
    <div class="card-body">
        <div class="table-responsive" id="checkoutOrder">
            <h1 class="card-title">Su pedido</h1>
            <hr>
            <table class="table" style="width: 100%;">
                <tbody>
                    <tr>
                        <td>Cantidad</td>
                        <td>Productos</td>
                        <td>Total</td>
                    </tr>
                </tbody>
                <tbody id="productList">

                </tbody>
            </table>
        </div>
    </div>
    <div class="card-footer text-end">
        <h4 class="" id="subtotal">Subtotal <span>$0.00</span></h4>
        <h4 class="" id="total">Total <span>$0.00</span></h4>
        <hr>
        <a href="<?= base_url('carrito'); ?>" class="btn btn-danger">Carrito</a>
        <a href="<?= base_url('pagos'); ?>" class="btn btn-primary">REALIZAR PEDIDO</a>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('js') ?>
<script src="<?= base_url('principal/js/pages/custom.js'); ?>"></script>
<script src="<?= base_url('principal/js/pages/checkout.js'); ?>"></script>
<?= $this->endSection() ?>
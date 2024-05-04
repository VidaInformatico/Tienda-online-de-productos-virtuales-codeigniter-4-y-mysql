<?= $this->extend('cliente_layout') ?>

<?= $this->section('content') ?>

<div class="card">
    <div class="card-body">
        <a id="carritoLink" class="btn btn-warning" href="<?= base_url('checkout'); ?>" style="display: none;">Tienes Productos Agregados en el Carrito</a>
        <div class="table-responsive">
            <table class="table table-striped table-hover table-borderless align-middle">
                <thead>
                    <tr>
                        <th>Item</th>
                        <th>Monto</th>
                        <th>Productos</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($descargas)) {
                        $item = 1;
                        foreach ($descargas as $pedido) : ?>
                            <tr>
                                <td><?= $item; ?></td>
                                <td><?= $pedido['monto']; ?></td>
                                <td>
                                    <ul class="list-group mb-2">
                                        <?php foreach ($pedido['productos'] as $producto) : ?>
                                            <li class="list-group-item">
                                                <h6><?= $producto['titulo']; ?></h6>
                                                <div class="text-end">
                                                    <a href="<?= base_url($producto['archivo_zip']); ?>" download="<?= $producto['archivo_zip']; ?>" class="btn btn-success btn-sm"><i class="material-icons-two-tone">download</i> Descargar</a>
                                                </div>
                                            </li>
                                        <?php endforeach; ?>
                                    </ul>
                                </td>
                            </tr>
                        <?php $item++;
                        endforeach;
                    } else { ?>
                        <tr>
                            <td colspan="5" class="text-center">NO HAY PEDIDOS</td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>

        </div>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('js') ?>
<script src="<?= base_url('principal/js/pages/custom.js'); ?>"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var productosEnLocalStorage = JSON.parse(localStorage.getItem('cart'));

        if (productosEnLocalStorage && productosEnLocalStorage.length > 0) {
            document.getElementById('carritoLink').style.display = 'block';
        }
    })
</script>
<?= $this->endSection() ?>
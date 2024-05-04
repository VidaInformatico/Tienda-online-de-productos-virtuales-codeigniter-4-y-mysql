<?= $this->extend('admin_layout') ?>

<?= $this->section('content') ?>

<div class="card">
    <div class="card-body">
        <h5 class="card-title">Detalle del Pedido</h5>
        <hr>
        <div class="table-responsive">
            <table class="table nowrap" id="pedidoTable" width="100%">
                <thead>
                    <tr>
                        <th>Producto</th>
                        <th>Cantidad</th>
                        <th>Precio</th>
                        <th>Sub Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $total = 0;
                    foreach ($productos as $pedido) {
                        $total += $pedido['cantidad'] * $pedido['precio'];
                    ?>
                        <tr>
                            <td><?= $pedido['titulo']; ?></td>
                            <td><?= $pedido['cantidad']; ?></td>
                            <td><?= $pedido['precio']; ?></td>
                            <td><?= number_format($pedido['cantidad'] * $pedido['precio'], 2); ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="card-footer text-end">
        <h4>Total: <?= number_format($total, 2); ?></h4>
    </div>
</div>

<?= $this->endSection() ?>
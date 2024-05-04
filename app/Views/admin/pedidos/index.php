<?= $this->extend('admin_layout') ?>

<?= $this->section('content') ?>

<div class="card">
    <div class="card-body">
        <h5 class="card-title">Lista de Pedidos</h5>
        <hr>
        <div class="table-responsive">
            <table class="table nowrap" id="pedidoTable" width="100%">
                <thead>
                    <tr>
                        <th>Acciones</th>
                        <th>ID</th>
                        <th>Cliente</th>
                        <th>Transacción</th>
                        <th>Fecha/Hora</th>
                        <th>Monto</th>
                        <th>Correo</th>
                        <th>Método</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('js') ?>
<script>
    let pedidoTable;
    $(document).ready(function() {
        pedidoTable = $('#pedidoTable').DataTable({
            responsive: true,
            "ajax": "<?= base_url('admin/pedidos/show'); ?>",
            "columns": [{
                    "data": null,
                    "render": function(data, type, row) {
                        return '<a href="<?= base_url('admin/pedidos'); ?>/' + row.id + '/detalle" class="btn btn-warning">Detalle</a>';
                    }
                },
                {
                    "data": "id"
                },
                {
                    "data": "usuario"
                },
                {
                    "data": "transaccion"
                },
                {
                    "data": "fecha"
                },
                {
                    "data": "monto"
                },
                {
                    "data": "correo"
                },
                {
                    "data": "metodo"
                },

            ],
            language: {
                url: 'https://cdn.datatables.net/plug-ins/1.13.7/i18n/es-ES.json',
            },
            "createdRow": function(row, data, index) {
                //pintar una celda
                if (data.leido == 1) {
                    //pintar una fila
                    $('td', row).css({
                        'background-color': '#ff968f',
                        'color': 'white'
                    });
                }
            },
        });
    });
</script>
<?= $this->endSection() ?>
<?= $this->extend('admin_layout') ?>

<?= $this->section('content') ?>

<a href="<?= base_url('admin/categorias/new') ?>" class="btn btn-primary mb-3">Nuevo Categoria</a>

<div class="card">
    <div class="card-body">
        <h5 class="card-title">Lista de Categorias</h5>
        <hr>
        <?php $successMessage = session()->getFlashdata('success'); ?>
        <?php if ($successMessage) : ?>
            <div class="alert alert-success">
                <?= esc($successMessage) ?>
            </div>
        <?php endif; ?>
        <div class="table-responsive">
            <table class="table nowrap" id="categoriaTable" width="100%">
                <thead>
                    <tr>
                        <th>Acciones</th>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Imagen</th>
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
    let categoriaTable;
    $(document).ready(function() {
        categoriaTable = $('#categoriaTable').DataTable({
            responsive: true,
            "ajax": "<?= base_url('admin/categorias/show'); ?>",
            "columns": [{
                    "data": null,
                    "render": function(data, type, row) {
                        return '<a href="<?= base_url('admin/categorias'); ?>/' + row.id + '/edit" class="btn btn-warning">Editar</a>' +
                            '<a href="#" class="btn btn-danger" onclick="confirmDelete(' + row.id + ')">Eliminar</a>';
                    }
                },
                {
                    "data": "id"
                },
                {
                    "data": "nombre"
                },
                {
                    "data": "imagen",
                    "render": function(data, type, row) {
                        return '<img src="<?= base_url('img/'); ?>' + data + '" alt="Imagen" width="50">';
                    }
                }

            ],
            language: {
                url: 'https://cdn.datatables.net/plug-ins/1.13.7/i18n/es-ES.json',
            },
        });
    });

    function confirmDelete(idUser) {
        Swal.fire({
            title: "Esta seguro de eliminar?",
            text: "¡No podrás revertir esto!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "¡Sí, bórralo!"
        }).then((result) => {
            if (result.isConfirmed) {
                let url = '<?php echo base_url('admin/categorias/'); ?>' + idUser;
                let data = new FormData();
                data.append('_method', 'DELETE');
                //hacer una instancia del objeto XMLHttpRequest 
                const http = new XMLHttpRequest();
                //Abrir una Conexion - POST - GET
                http.open('POST', url, true);
                //Enviar Datos
                http.send(data);
                //verificar estados
                http.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        const res = JSON.parse(this.responseText);
                        Swal.fire({
                            toast: true,
                            position: 'top-right',
                            icon: res.tipo,
                            title: res.msg,
                            showConfirmButton: false,
                            timer: 2000
                        })
                        if (res.tipo == 'success') {
                            categoriaTable.ajax.reload();
                        }
                    }
                }
            }
        });
    }
</script>
<?= $this->endSection() ?>
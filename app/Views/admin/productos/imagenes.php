<?= $this->extend('admin_layout') ?>

<?= $this->section('css') ?>
<link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="card">
    <div class="card-body">
        <h5 class="card-title">Galeria de Producto</h5>
        <hr>
        <form action="<?= base_url('admin/imageProductos'); ?>" class="dropzone mb-3" id="file-upload" method="post">
            <input type="hidden" id="idProducto" name="idProducto" value="<?= $producto['id']; ?>">
        </form>
        <div class="row">
            <?php if (empty($imagenes)) : ?>
                <div class="alert alert-warning" role="alert">
                    No hay imágenes disponibles.
                </div>
            <?php else : ?>
                <?php foreach ($imagenes as $imagen) : ?>
                    <div class="card col-md-3">
                        <img src="<?= base_url('img/productos/' . $producto['id'] . '/' . $imagen) ?>" class="card-img-top" alt="<?= $imagen ?>">
                        <div class="card-body">
                            <h5 class="card-title"><?= $imagen ?></h5>
                            <button class="btn btn-danger" onclick="confirmDelete('<?= $producto['id'] . '/' . $imagen; ?>')">Eliminar</button>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>

    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('js') ?>
<script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>
<script>
    Dropzone.options.fileUpload = {
        uploadMultiple: true,
        dictDefaultMessage: "Arrastar y Soltar Archivos",
        maxFilesize: 10,
        acceptedFiles: '.pdf, .jpg, .jpeg, .png',

        init: function() {
            var myDropzone = this;

            this.on("sendingmultiple", function() {});
            this.on("successmultiple", function(files, response) {
                const res = JSON.parse(response);
                Swal.fire({
                    toast: true,
                    position: 'top-right',
                    icon: res.tipo,
                    title: res.msg,
                    showConfirmButton: false,
                    timer: 2000
                })
                setTimeout(() => {
                    window.location.reload();
                }, 1500);
            });

            this.on("errormultiple", function(files, response) {});
        }
    };

    function confirmDelete(ruta) {
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
                let url = '<?php echo base_url('admin/deleteImagen/'); ?>' + ruta;
                //hacer una instancia del objeto XMLHttpRequest 
                const http = new XMLHttpRequest();
                //Abrir una Conexion - POST - GET
                http.open('GET', url, true);
                //Enviar Datos
                http.send();
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
                            setTimeout(() => {
                                window.location.reload();
                            }, 1500);
                        }
                    }
                }
            }
        });
    }
</script>
<?= $this->endSection() ?>
<?= $this->extend('admin_layout') ?>

<?= $this->section('css') ?>
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="card">
    <div class="card-body">
        <h5 class="card-title">Crear Nuevo Producto</h5>
        <hr>
        <?php if (isset($validation)) : ?>
            <div class="alert alert-danger">
                <?= $validation->listErrors() ?>
            </div>
        <?php endif; ?>
        <form action="<?= base_url('admin/productos'); ?>" method="post" class="row" enctype="multipart/form-data">
            <div class="form-group col-md-6 mb-3">
                <label>Código</label>
                <input type="text" name="codigo" class="form-control" value="<?= set_value('codigo'); ?>" placeholder="Código">
            </div>
            <div class="form-group col-md-6 mb-3">
                <label>Título</label>
                <input type="text" name="titulo" class="form-control" value="<?= set_value('titulo'); ?>" placeholder="Título">
            </div>
            <div class="form-group col-md-6 mb-3">
                <label>Precio Normal</label>
                <input type="text" name="precio_normal" class="form-control" value="<?= set_value('precio_normal'); ?>" placeholder="Precio Normal">
            </div>
            <div class="form-group col-md-6 mb-3">
                <label>Precio Rebajado</label>
                <input type="text" name="precio_rebajado" class="form-control" value="<?= set_value('precio_rebajado'); ?>" placeholder="Precio Rebajado">
            </div>

            <div class="form-group col-md-6 mb-3">
                <label>Categoria</label>
                <select id="id_categoria" class="form-control" name="id_categoria">
                    <option value="" <?= set_select('id_categoria', '', (empty($categoria)) ? true : false); ?>>Seleccionar</option>
                    <?php foreach ($categorias as $categoria) { ?>
                        <option value="<?= $categoria['id']; ?>" <?= set_select('id_categoria', $categoria['id'], (!empty($categoria) && $categoria == $categoria['id']) ? true : false); ?>>
                            <?= $categoria['nombre']; ?>
                        </option>
                    <?php } ?>
                </select>
            </div>

            <div class="form-group col-md-6 mb-3">
                <label>Archivo</label>
                <input type="file" name="archivo_zip" class="form-control">
            </div>

            <div class="form-group col-md-6 mb-3">
                <label>Descripción</label>
                <textarea name="descripcion" class="form-control" id="descripcion" value="<?= set_value('descripcion'); ?>" placeholder="Descripción"></textarea>
            </div>

            <div class="form-group col-md-6 mb-3">
                <label>Imagen</label>
                <input type="file" name="imagen" id="imageInput" class="form-control">
                <div id="imagePreview">
                    <!-- Vista previa de la imagen aparecerá aquí -->
                </div>
            </div>

            <div class="col-md-12 text-end">
                <a href="<?= base_url('admin/productos'); ?>" class="btn btn-danger">Cancelar</a>
                <button type="submit" class="btn btn-primary">Guardar</button>
            </div>
        </form>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('js') ?>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>

<script>
    $(document).ready(function() {
        $('#descripcion').summernote({
            placeholder: 'Descripcion del producto',
            tabsize: 2,
            height: 100
        });

        document.getElementById("imageInput").addEventListener("change", function(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    const imagePreview = document.getElementById("imagePreview");
                    imagePreview.innerHTML = ""; // Limpiar cualquier contenido anterior

                    const img = document.createElement("img");
                    img.src = e.target.result; // URL de la imagen seleccionada
                    img.style.maxWidth = "100%"; // Ajustar tamaño para evitar desbordamientos
                    img.style.height = "auto";

                    imagePreview.appendChild(img); // Agregar la imagen al contenedor
                };

                reader.readAsDataURL(file); // Leer el archivo como URL de datos
            }
        });
    });
</script>
<?= $this->endSection() ?>
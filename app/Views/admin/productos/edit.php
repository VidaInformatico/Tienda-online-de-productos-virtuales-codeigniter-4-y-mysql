<?= $this->extend('admin_layout') ?>

<?= $this->section('css') ?>
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="card">
    <div class="card-body">
        <h5 class="card-title">Editar Producto</h5>
        <hr>
        <?php if (isset($validation)) : ?>
            <div class="alert alert-danger">
                <?= $validation->listErrors() ?>
            </div>
        <?php endif; ?>
        <form action="<?= base_url('admin/productos/' . $producto['id']) ?>" method="post" class="row" enctype="multipart/form-data">
            <input type="hidden" name="_method" value="PUT">
            <div class="form-group col-md-6 mb-3">
                <label>Código</label>
                <input type="text" name="codigo" class="form-control" value="<?= set_value('codigo', $producto['codigo']) ?>" placeholder="Código" >
            </div>
            <div class="form-group col-md-6 mb-3">
                <label>Título</label>
                <input type="text" name="titulo" class="form-control" value="<?= set_value('titulo', $producto['titulo']) ?>" placeholder="Título" >
            </div>
            <div class="form-group col-md-6 mb-3">
                <label>Precio Normal</label>
                <input type="text" name="precio_normal" class="form-control" value="<?= set_value('precio_normal', $producto['precio_normal']) ?>" placeholder="Precio Normal" >
            </div>
            <div class="form-group col-md-6 mb-3">
                <label>Precio Rebajado</label>
                <input type="text" name="precio_rebajado" class="form-control" value="<?= set_value('precio_rebajado', $producto['precio_rebajado']) ?>" placeholder="Precio Rebajado" >
            </div>
            
            <!-- En tu vista del formulario -->
            <div class="form-group col-md-6 mb-3">
                <label>Categoria</label>
                <select id="id_categoria" class="form-control" name="id_categoria">
                    <option value="">Seleccionar</option>
                    <?php foreach ($categorias as $categoria) { ?>
                        <option value="<?= $categoria['id']; ?>" <?= set_select('id_categoria', $categoria['id'], ($producto['id_categoria'] == $categoria['id']) ? true : false); ?>>
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
                <textarea name="descripcion" id="descripcion" class="form-control" placeholder="Descripción"><?= set_value('descripcion', $producto['descripcion']) ?></textarea>
            </div>

            <div class="form-group col-md-6 mb-3">
                <label>Imagen</label>
                <input type="file" name="imagen" id="imageInput" class="form-control">
                <div id="imagePreview">
                    <img src="<?= base_url('img/'. $producto['imagen']); ?>" width="100%">
                </div>
            </div>

            <div class="col-md-12 text-end">
                <a href="<?= base_url('admin/productos'); ?>" class="btn btn-danger">Cancelar</a>
                <button type="submit" class="btn btn-primary">Actualizar</button>
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
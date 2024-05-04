<?= $this->extend('admin_layout') ?>

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
            <div class="form-group col-md-6 mb-3">
                <label>Descripción</label>
                <textarea name="descripcion" class="form-control" placeholder="Descripción"><?= set_value('descripcion', $producto['descripcion']) ?></textarea>
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
                <label>Imagen</label>
                <input type="file" name="imagen" class="form-control">
            </div>

            <div class="form-group col-md-6 mb-3">
                <label>Archivo</label>
                <input type="file" name="archivo_zip" class="form-control">
            </div>

            <div class="col-md-12 text-end">
                <a href="<?= base_url('admin/productos'); ?>" class="btn btn-danger">Cancelar</a>
                <button type="submit" class="btn btn-primary">Actualizar</button>
            </div>
        </form>
    </div>
</div>

<?= $this->endSection() ?>
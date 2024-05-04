<?= $this->extend('admin_layout') ?>

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
                <input type="text" name="codigo" class="form-control" value="<?= set_value('codigo'); ?>" placeholder="Código" >
            </div>
            <div class="form-group col-md-6 mb-3">
                <label>Título</label>
                <input type="text" name="titulo" class="form-control" value="<?= set_value('titulo'); ?>" placeholder="Título" >
            </div>
            <div class="form-group col-md-6 mb-3">
                <label>Precio Normal</label>
                <input type="text" name="precio_normal" class="form-control" value="<?= set_value('precio_normal'); ?>" placeholder="Precio Normal" >
            </div>
            <div class="form-group col-md-6 mb-3">
                <label>Precio Rebajado</label>
                <input type="text" name="precio_rebajado" class="form-control" value="<?= set_value('precio_rebajado'); ?>" placeholder="Precio Rebajado" >
            </div>
            <div class="form-group col-md-6 mb-3">
                <label>Descripción</label>
                <textarea name="descripcion" class="form-control" value="<?= set_value('descripcion'); ?>" placeholder="Descripción"></textarea>
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
                <label>Imagen</label>
                <input type="file" name="imagen" class="form-control">
            </div>

            <div class="form-group col-md-6 mb-3">
                <label>Archivo</label>
                <input type="file" name="archivo_zip" class="form-control">
            </div>

            <div class="col-md-12 text-end">
                <a href="<?= base_url('admin/productos'); ?>" class="btn btn-danger">Cancelar</a>
                <button type="submit" class="btn btn-primary">Guardar</button>
            </div>
        </form>
    </div>
</div>

<?= $this->endSection() ?>
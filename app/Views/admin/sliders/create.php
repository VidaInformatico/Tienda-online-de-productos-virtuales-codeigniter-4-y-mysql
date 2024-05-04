<?= $this->extend('admin_layout') ?>

<?= $this->section('content') ?>

<div class="card">
    <div class="card-body">
        <h5 class="card-title">Crear Nuevo Slider</h5>
        <hr>
        <?php if (isset($validation)) : ?>
            <div class="alert alert-danger">
                <?= $validation->listErrors() ?>
            </div>
        <?php endif; ?>
        <form action="<?= base_url('admin/sliders'); ?>" method="post" class="row" enctype="multipart/form-data">
            <div class="form-group col-md-6 mb-3">
                <label>Titulo Corta</label>
                <input type="text" name="titulo" class="form-control" value="<?= set_value('titulo'); ?>" placeholder="Titulo" required>
            </div>
            <div class="form-group col-md-6 mb-3">
                <label>Sub Título Corta</label>
                <input type="text" name="subtitulo" class="form-control" value="<?= set_value('subtitulo'); ?>" placeholder="Sub Titulo" required>
            </div>
            <div class="form-group col-md-6 mb-3">
                <label>Descripcion Corta</label>
                <input type="text" name="descripcion" class="form-control" value="<?= set_value('descripcion'); ?>" placeholder="Descripcion" required>
            </div>
            <div class="form-group col-md-6 mb-3">
                <label for="imagen">Imagen</label>
                <input type="file" name="imagen" class="form-control">
            </div>
            
            <div class="col-md-12 text-end">
                <a href="<?= base_url('admin/sliders'); ?>" class="btn btn-danger">Cancelar</a>
                <button type="submit" class="btn btn-primary">Guardar</button>
            </div>
        </form>
    </div>
</div>

<?= $this->endSection() ?>
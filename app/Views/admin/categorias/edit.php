<?= $this->extend('admin_layout') ?>

<?= $this->section('content') ?>

<div class="card">
    <div class="card-body">
        <h5 class="card-title">Editar Categoria</h5>
        <hr>
        <?php if (isset($validation)) : ?>
            <div class="alert alert-danger">
                <?= $validation->listErrors() ?>
            </div>
        <?php endif; ?>
        <form action="<?= base_url('admin/categorias/' . $categoria['id']) ?>" method="post" class="row" enctype="multipart/form-data">
            <input type="hidden" name="_method" value="PUT">
            
            <div class="form-group col-md-6 mb-3">
                <label for="nombre">Nombre</label>
                <input type="text" name="nombre" class="form-control" value="<?= set_value('nombre', $categoria['nombre']) ?>" placeholder="Nombre" required>
            </div>
            <div class="form-group col-md-6 mb-3">
                <label for="imagen">Imagen</label>
                <input type="file" name="imagen" class="form-control">
            </div>
            <div class="col-md-12 text-end">
                <a href="<?= base_url('admin/categorias'); ?>" class="btn btn-danger">Cancelar</a>
                <button type="submit" class="btn btn-primary">Actualizar</button>
            </div>
        </form>
    </div>
</div>

<?= $this->endSection() ?>
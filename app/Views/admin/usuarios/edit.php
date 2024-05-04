<?= $this->extend('admin_layout') ?>

<?= $this->section('content') ?>

<div class="card">
    <div class="card-body">
        <h5 class="card-title">Editar Usuario</h5>
        <hr>
        <?php if (isset($validation)) : ?>
            <div class="alert alert-danger">
                <?= $validation->listErrors() ?>
            </div>
        <?php endif; ?>
        <form action="<?= base_url('admin/usuarios/' . $usuario['id']) ?>" method="post" class="row" autocomplete="off">
            <input type="hidden" name="_method" value="PUT">
            <div class="form-group col-md-6 mb-3">
                <label for="usuario">Usuario</label>
                <input type="text" name="usuario" class="form-control" value="<?= set_value('usuario', $usuario['usuario']) ?>" placeholder="Usuario">
            </div>
            <div class="form-group col-md-6 mb-3">
                <label for="correo">Correo</label>
                <input type="email" name="correo" class="form-control" value="<?= set_value('correo', $usuario['correo']) ?>" placeholder="Correo Electrónico">
            </div>
            <div class="form-group col-md-6 mb-3">
                <label for="nombre">Nombre</label>
                <input type="text" name="nombre" class="form-control" value="<?= set_value('nombre', $usuario['nombre']) ?>" placeholder="Nombre">
            </div>
            <div class="form-group col-md-6 mb-3">
                <label for="apellido">Apellido</label>
                <input type="text" name="apellido" class="form-control" value="<?= set_value('apellido', $usuario['apellido']) ?>" placeholder="Apellido">
            </div>
            <div class="form-group col-md-6 mb-3">
                <label for="rol">Rol</label>
                <select id="rol" class="form-control" name="rol">
                    <option value="" <?= set_select('rol', '', $usuario['rol'] == '' ? true : false); ?>>Seleccionar</option>
                    <option value="admin" <?= set_select('rol', 'admin', $usuario['rol'] == 'admin' ? true : false); ?>>Admin</option>
                    <option value="usuario" <?= set_select('rol', 'usuario', $usuario['rol'] == 'usuario' ? true : false); ?>>Usuario</option>
                </select>
            </div>
            <div class="col-md-12 text-end">
                <a href="<?= base_url('admin/usuarios'); ?>" class="btn btn-danger">Cancelar</a>
                <button type="submit" class="btn btn-primary">Actualizar</button>
            </div>
        </form>
    </div>
</div>

<?= $this->endSection() ?>
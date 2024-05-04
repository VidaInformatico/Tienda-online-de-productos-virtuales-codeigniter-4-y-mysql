<?= $this->extend('admin_layout') ?>

<?= $this->section('content') ?>

<div class="card">
    <div class="card-body">
        <h5 class="card-title">Crear Nuevo Usuario</h5>
        <hr>
        <?php if (isset($validation)) : ?>
            <div class="alert alert-danger">
                <?= $validation->listErrors() ?>
            </div>
        <?php endif; ?>
        <form action="<?= base_url('admin/usuarios'); ?>" method="post" class="row" autocomplete="off">
            <div class="form-group col-md-3 mb-3">
                <label for="usuario">Usuario</label>
                <input type="text" name="usuario" class="form-control" value="<?= set_value('usuario'); ?>" placeholder="Usuario" required>
            </div>
            <div class="form-group col-md-5 mb-3">
                <label for="correo">Correo</label>
                <input type="email" name="correo" class="form-control" value="<?= set_value('correo'); ?>" placeholder="Correo Electrónico" required>
            </div>
            <div class="form-group col-md-4 mb-3">
                <label for="nombre">Nombre</label>
                <input type="text" name="nombre" class="form-control" value="<?= set_value('nombre'); ?>" placeholder="Nombre" required>
            </div>
            <div class="form-group col-md-6 mb-3">
                <label for="apellido">Apellido</label>
                <input type="text" name="apellido" class="form-control" value="<?= set_value('apellido'); ?>" placeholder="Apellido" required>
            </div>
            <div class="form-group col-md-6 mb-3">
                <label for="password">Contraseña</label>
                <input type="password" name="password" class="form-control" placeholder="Contraseña" required>
            </div>
            <div class="form-group col-md-6 mb-3">
                <label for="password">Confirmar Contraseña</label>
                <input type="password" name="password_confirm" class="form-control" placeholder="Confirmar Contraseña" required>
            </div>            
            <div class="form-group col-md-6 mb-3">
                <label for="rol">Rol</label>
                <select id="rol" class="form-control" name="rol">
                    <option value="">Seleccionar</option>
                    <option value="admin">Admin</option>
                    <option value="usuario">Usuario</option>
                </select>
            </div>
            <div class="col-md-12 text-end">
                <a href="<?= base_url('admin/usuarios'); ?>" class="btn btn-danger">Cancelar</a>
                <button type="submit" class="btn btn-primary">Guardar</button>
            </div>
        </form>
    </div>
</div>

<?= $this->endSection() ?>
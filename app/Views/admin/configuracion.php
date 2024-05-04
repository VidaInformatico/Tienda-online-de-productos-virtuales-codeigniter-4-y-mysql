<?= $this->extend('admin_layout') ?>

<?= $this->section('content') ?>

<div class="card">
    <div class="card-body">
        <h5 class="card-title">Editar Empresa</h5>
        <hr>
        <?php if (isset($validation)) : ?>
            <div class="alert alert-danger">
                <?= $validation->listErrors() ?>
            </div>
        <?php endif; ?>
        <?php $successMessage = session()->getFlashdata('success'); ?>
        <?php if ($successMessage) : ?>
            <div class="alert alert-success">
                <?= esc($successMessage) ?>
            </div>
        <?php endif; ?>
        <form action="<?= base_url('admin/empresa/' . $empresa['id']) ?>" method="post" class="row" autocomplete="off">
            <input type="hidden" name="_method" value="PUT">
            <div class="form-group col-md-6 mb-3">
                <label>Identidad</label>
                <input type="text" name="identidad" class="form-control" value="<?= set_value('identidad', $empresa['identidad']) ?>" placeholder="Identidad" required>
            </div>
            <div class="form-group col-md-6 mb-3">
                <label>Nombre Comercial</label>
                <input type="text" name="nombre_comercial" class="form-control" value="<?= set_value('nombre_comercial', $empresa['nombre_comercial']) ?>" placeholder="Nombre Comercial" required>
            </div>
            <div class="form-group col-md-6 mb-3">
                <label>Razon Social</label>
                <input type="text" name="razon_social" class="form-control" value="<?= set_value('razon_social', $empresa['razon_social']) ?>" placeholder="Razon Social" required>
            </div>
            <div class="form-group col-md-6 mb-3">
                <label>Telefono</label>
                <input type="text" name="telefono" class="form-control" value="<?= set_value('telefono', $empresa['telefono']) ?>" placeholder="Telefono" required>
            </div>
            <div class="form-group col-md-6 mb-3">
                <label>Correo Electronico</label>
                <input type="email" name="correo" class="form-control" value="<?= set_value('correo', $empresa['correo']) ?>" placeholder="Correo Electronico" required>
            </div>
            <div class="form-group col-md-6 mb-3">
                <label>Dirección</label>
                <textarea name="direccion" class="form-control" placeholder="Dirección"><?= set_value('direccion', $empresa['direccion']) ?></textarea>
            </div>
            <div class="form-group col-md-6 mb-3">
                <label>Mensaje</label>
                <textarea name="mensaje" class="form-control" placeholder="Mensaje"><?= set_value('mensaje', $empresa['mensaje']) ?></textarea>
            </div>

            <div class="form-group col-md-6 mb-3">
                <label>Imagen</label>
                <input type="file" name="imagen" class="form-control">
            </div>

            <div class="col-md-12">
                <h4>REDES SOCIALES</h4>
                <hr>
            </div>

            <div class="form-group col-md-6 mb-3">
                <label>URL Facebook</label>
                <input type="url" name="facebook" class="form-control" value="<?= set_value('facebook', $empresa['facebook']) ?>" placeholder="Facebook">
            </div>
            <div class="form-group col-md-6 mb-3">
                <label>URL Twitter</label>
                <input type="url" name="twitter" class="form-control" value="<?= set_value('twitter', $empresa['twitter']) ?>" placeholder="Twitter">
            </div>
            <div class="form-group col-md-6 mb-3">
                <label>URL Instagram</label>
                <input type="url" name="instagram" class="form-control" value="<?= set_value('instagram', $empresa['instagram']) ?>" placeholder="Instragram">
            </div>
            <div class="form-group col-md-6 mb-3">
                <label>URL WhatsApp</label>
                <input type="url" name="whatsapp" class="form-control" value="<?= set_value('whatsapp', $empresa['whatsapp']) ?>" placeholder="WhatsApp">
            </div>

            <div class="col-md-12">
                <h4>CONFIGURACIONES SMTP PARA ENVIOS DE CORREOS</h4>
                <hr>
            </div>

            <div class="form-group col-md-6 mb-3">
                <label>Host Smtp</label>
                <input type="text" name="host_smtp" class="form-control" value="<?= set_value('host_smtp', $empresa['host_smtp']) ?>" placeholder="Host">
            </div>
            <div class="form-group col-md-6 mb-3">
                <label>User Smtp</label>
                <input type="text" name="user_smtp" class="form-control" value="<?= set_value('user_smtp', $empresa['user_smtp']) ?>" placeholder="User">
            </div>
            <div class="form-group col-md-6 mb-3">
                <label>Clave Smtp</label>
                <input type="password" name="clave_smtp" class="form-control" value="<?= set_value('clave_smtp', $empresa['clave_smtp']) ?>" placeholder="Clave">
            </div>
            <div class="form-group col-md-6 mb-3">
                <label>Puerto Smtp</label>
                <input type="text" name="puerto_smtp" class="form-control" value="<?= set_value('puerto_smtp', $empresa['puerto_smtp']) ?>" placeholder="Puerto">
            </div>

            <div class="col-md-12">
                <h4>GOOGLE MAPS</h4>
                <hr>
            </div>

            <div class="form-group col-md-12 mb-3">
                <label>URL Mapa</label>
                <textarea name="mapa" class="form-control"  rows="6" placeholder="Url Mapa"><?= set_value('mapa', $empresa['mapa']) ?></textarea>
            </div>            

            <div class="col-md-12 text-end">
                <button type="submit" class="btn btn-primary">Actualizar</button>
            </div>
        </form>
    </div>
</div>

<?= $this->endSection() ?>
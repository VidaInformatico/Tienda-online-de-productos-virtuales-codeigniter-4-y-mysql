<!-- app/Views/admin/usuarios/index.php -->

<?= $this->extend('admin_layout') ?>

<?= $this->section('content') ?>
<section class="h-100 gradient-custom-2">
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col col-lg-9 col-xl-7">
                <div class="card">
                    <div class="rounded-top text-white d-flex flex-row" style="background-color: #000; height:200px;">
                        <div class="ms-4 mt-5 d-flex flex-column" style="width: 150px;">
                            <img src="<?= base_url('img/logo.png'); ?>" alt="Generic placeholder image" class="img-fluid img-thumbnail mt-4 mb-2" style="width: 150px; z-index: 1">
                            <!-- <button type="button" class="btn btn-outline-dark" data-mdb-ripple-color="dark" style="z-index: 1;">
                                Edit profile
                            </button> -->
                        </div>
                        <div class="ms-3" style="margin-top: 130px;">
                            <h5><?= $usuario['nombre'] . ' ' . $usuario['apellido']; ?></h5>
                            <p><?= $usuario['rol']; ?></p>
                        </div>
                    </div>
                    <div class="card-body p-4 text-black">
                        <?php $successMessage = session()->getFlashdata('success'); ?>
                        <?php if ($successMessage) : ?>
                            <div class="alert alert-success">
                                <?= esc($successMessage) ?>
                            </div>
                        <?php endif; ?>
                        <?php $errorMessage = session()->getFlashdata('error'); ?>
                        <?php if ($errorMessage) : ?>
                            <div class="alert alert-danger">
                                <?= esc($errorMessage) ?>
                            </div>
                        <?php endif; ?>
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane" type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">Tus Datos</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-tab-pane" type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false">Credendiciales</button>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active p-3" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">
                                <?php if (isset($validation)) : ?>
                                    <div class="alert alert-danger">
                                        <?= $validation->listErrors() ?>
                                    </div>
                                <?php endif; ?>
                                <form action="<?= base_url('perfil'); ?>" method="post" class="row" autocomplete="off">
                                    <input type="hidden" name="_method" value="PUT">
                                    <div class="form-group col-md-6 mb-3">
                                        <label for="usuario">Usuario</label>
                                        <input type="text" name="usuario" class="form-control" value="<?= set_value('usuario', $usuario['usuario']); ?>" placeholder="Usuario" required>
                                    </div>
                                    <div class="form-group col-md-6 mb-3">
                                        <label for="correo">Correo</label>
                                        <input type="email" name="correo" class="form-control" value="<?= set_value('correo', $usuario['correo']); ?>" placeholder="Correo Electrónico" required>
                                    </div>
                                    <div class="form-group col-md-6 mb-3">
                                        <label for="nombre">Nombre</label>
                                        <input type="text" name="nombre" class="form-control" value="<?= set_value('nombre', $usuario['nombre']); ?>" placeholder="Nombre" required>
                                    </div>
                                    <div class="form-group col-md-6 mb-3">
                                        <label for="apellido">Apellido</label>
                                        <input type="text" name="apellido" class="form-control" value="<?= set_value('apellido', $usuario['apellido']); ?>" placeholder="Apellido" required>
                                    </div>
                                    <div class="col-md-12 text-end">
                                        <button type="submit" class="btn btn-primary">Guardar</button>
                                    </div>
                                </form>
                            </div>
                            <div class="tab-pane fade p-3" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab" tabindex="0">
                                <?php if (isset($validation)) : ?>
                                    <div class="alert alert-danger">
                                        <?= $validation->listErrors() ?>
                                    </div>
                                <?php endif; ?>
                                <form action="<?= base_url('updatePassword'); ?>" method="post" class="row">
                                    <input type="hidden" name="_method" value="PUT">
                                    <div class="form-group col-md-12 mb-3">
                                        <label for="password">Contraseña Actual</label>
                                        <input type="password" name="actual" class="form-control" placeholder="Contraseña Actual">
                                    </div>

                                    <div class="form-group col-md-6 mb-3">
                                        <label for="password">Contraseña Nueva</label>
                                        <input type="password" name="nueva" class="form-control" placeholder="Contraseña Nueva">
                                    </div>

                                    <div class="form-group col-md-6 mb-3">
                                        <label for="password">Confirmar Contraseña</label>
                                        <input type="password" name="confirmar" class="form-control" placeholder=" Confirmar Contraseña">
                                    </div>

                                    <div class="col-md-12 text-end">
                                        <button type="submit" class="btn btn-primary">Guardar</button>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?= $this->endSection() ?>

<?= $this->section('js') ?>
<script>


</script>
<?= $this->endSection() ?>
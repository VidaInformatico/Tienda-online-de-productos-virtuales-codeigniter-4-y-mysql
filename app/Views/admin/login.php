<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="<?= base_url('admins/assets/js/64d58efce2.js'); ?>" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="<?= base_url('admins/assets/css/login.css'); ?>" />

    <title>Iniciar | Sesión</title>
</head>

<body>
    <div class="container-login <?php echo ($register) ? 'sign-up-mode' : ''; ?>">
        <div class="forms-container-login">
            <div class="signin-signup">
                <form action="<?= base_url('login'); ?>" method="post" class="sign-in-form" autocomplete="off">
                    <h2 class="title">Login</h2>
                    <?php if (session()->getFlashdata('error')) : ?>
                        <div class="text-danger">
                            <?= session()->getFlashdata('error'); ?>
                        </div>
                    <?php endif; ?>
                    <div class="input-field">
                        <i class="fas fa-user"></i>
                        <input type="text" id="usuario" name="usuario" placeholder="Usuario" />
                    </div>
                    <?php if (isset($username_error)) : ?>
                        <div class="text-danger mt-2">
                            <?= $username_error ?>
                        </div>
                    <?php endif; ?>
                    <div class="input-field">
                        <i class="fas fa-lock"></i>
                        <input type="password" id="password" name="password" placeholder="Contraseña" />
                    </div>
                    <?php if (isset($password_error)) : ?>
                        <div class="text-danger mt-2">
                            <?= $password_error ?>
                        </div>
                    <?php endif; ?>
                    <button class="btn solid" type="submit"><i class="fas fa-sign-in-alt"></i><span id="btnAccion"> Login</span></button>
                </form>
                <form class="sign-up-form" action="<?= base_url('registro'); ?>" method="post" autocomplete="off">
                    <?php if (session()->getFlashdata('error')) : ?>
                        <div class="text-danger">
                            <?= session()->getFlashdata('error'); ?>
                        </div>
                    <?php endif; ?>
                    <div class="row">
                        <div class="col-md-7">
                            <div class="input-field">
                                <i class="fas fa-list"></i>
                                <input type="text" placeholder="Nombre" name="nombre_registro"  />
                            </div>
                            <?php if (isset($nombre_registro_error)) : ?>
                                <div class="text-danger mt-2">
                                    <?= $nombre_registro_error ?>
                                </div>
                            <?php endif; ?>
                        </div>

                        <div class="col-md-7">
                            <div class="input-field">
                                <i class="fas fa-list-alt"></i>
                                <input type="text" placeholder="Apellido" name="apellido_registro"  />
                            </div>
                            <?php if (isset($apellido_registro_error)) : ?>
                                <div class="text-danger mt-2">
                                    <?= $apellido_registro_error ?>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="col-md-5">
                            <div class="input-field">
                                <i class="fas fa-user"></i>
                                <input type="text" placeholder="Usuario" name="usuario_registro"  />
                            </div>
                            <?php if (isset($usuario_registro_error)) : ?>
                                <div class="text-danger mt-2">
                                    <?= $usuario_registro_error ?>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="col-md-6">
                            <div class="input-field">
                                <i class="fas fa-envelope"></i>
                                <input type="email" placeholder="Correo" name="correo_registro"  />
                            </div>
                            <?php if (isset($correo_registro_error)) : ?>
                                <div class="text-danger mt-2">
                                    <?= $correo_registro_error ?>
                                </div>
                            <?php endif; ?>
                        </div>

                        <div class="col-md-6">
                            <div class="input-field">
                                <i class="fas fa-key"></i>
                                <input type="password" placeholder="Contraseña" name="password_registro"  />
                            </div>
                            <?php if (isset($password_registro_error)) : ?>
                                <div class="text-danger mt-2">
                                    <?= $password_registro_error ?>
                                </div>
                            <?php endif; ?>
                        </div>

                    </div>
                    <button class="btn" type="submit" id="btnAccion">Registrar</button>
                </form>
            </div>
        </div>

        <div class="panels-container-login">
            <div class="panel left-panel">
                <div class="content">
                    <h3>Solicitar Registro</h3>
                    <p>
                        Lorem ipsum, dolor sit amet consectetur adipisicing elit. Debitis,
                        ex ratione. Aliquid!
                    </p>
                    <button class="btn transparent" id="sign-up-btn">
                        Registro
                    </button>

                    <a class="text-danger" href="<?= base_url(); ?>">Regresar</a>
                    
                </div>
                <img src="<?= base_url('img/log.svg'); ?>" class="image" alt="" />
            </div>
            <div class="panel right-panel">
                <div class="content">
                    <h3>Ya tienes una cuenta</h3>
                    <p>
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Nostrum
                        laboriosam ad deleniti.
                    </p>
                    <button class="btn transparent" id="sign-in-btn">
                        Login
                    </button>

                    <a class="text-danger" href="<?= base_url(); ?>">Regresar</a>
                </div>
                <img src="<?= base_url('img/register.svg'); ?>" class="image" alt="" />
            </div>
        </div>
    </div>
    <script src="<?= base_url('principal/js/jquery-3.3.1.min.js'); ?>"></script>
    <script src="<?= base_url('admins/assets/js/login.js'); ?>"></script>
</body>

</html>
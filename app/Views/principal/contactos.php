<?= $this->extend('tienda_layout') ?>

<?= $this->section('content') ?>

<section class="breadcrumb-section set-bg" data-setbg="<?= base_url('principal'); ?>/img/breadcrumb.jpg">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="breadcrumb__text">
                    <h2>Contactenos</h2>
                    <div class="breadcrumb__option">
                        <a href="<?= base_url(); ?>">Home</a>
                        <span>Contactos</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Contact Section Begin -->
<section class="contact spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-6 text-center">
                <div class="contact__widget">
                    <span class="icon_phone"></span>
                    <h4>Télefono</h4>
                    <p><?= $empresa['telefono']; ?></p>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-6 text-center">
                <div class="contact__widget">
                    <span class="icon_pin_alt"></span>
                    <h4>Dirección</h4>
                    <p><?= $empresa['direccion']; ?></p>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-6 text-center">
                <div class="contact__widget">
                    <span class="icon_mail_alt"></span>
                    <h4>Correo</h4>
                    <p><?= $empresa['correo']; ?></p>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Contact Section End -->

<!-- Map Begin -->
<div class="map">

    <?= $empresa['mapa']; ?>

    <!-- <iframe
            src="#"
            height="500" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe> -->

    <div class="map-inside">
        <i class="icon_pin"></i>
        <div class="inside-widget">
            <h4><?= $empresa['nombre_comercial']; ?></h4>
            <ul>
                <li>Télefono: <?= $empresa['telefono']; ?></li>
                <li>Dirección: <?= $empresa['direccion']; ?></li>
            </ul>
        </div>
    </div>
</div>
<!-- Map End -->

<!-- Contact Form Begin -->
<div class="contact-form spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="contact__form__title">
                    <h2>Deja un mensaje</h2>
                </div>
            </div>
        </div>
        <form action="<?= base_url('contactos'); ?>" method="post" autocomplete="off">
            <div class="row">
                <div class="col-md-12">
                    <?php if (isset($validation)) : ?>
                        <div class="alert alert-danger">
                            <?= $validation->listErrors() ?>
                        </div>
                    <?php endif; ?>
                    <?php 
                    $successMessage = session()->getFlashdata('success');
                    if ($successMessage) : ?>
                        <div class="alert alert-success">
                            <?= esc($successMessage) ?>
                        </div>
                    <?php endif; ?>
                    <?php $errorMessage = session()->getFlashdata('error');
                    if ($errorMessage) : ?>
                        <div class="alert alert-danger">
                            <?= esc($errorMessage) ?>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="col-lg-6 col-md-6">
                    <input type="text" name="nombre" placeholder="Nombre">
                </div>
                <div class="col-lg-6 col-md-6">
                    <input type="text" name="correo" placeholder="Correo Electrónico">
                </div>
                <div class="col-lg-12 text-center">
                    <textarea placeholder="Tu mensaje" name="mensaje"></textarea>
                    <button type="submit" class="site-btn">ENVIAR MENSAJE</button>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- Contact Form End -->

<?= $this->endSection() ?>

<?= $this->section('js') ?>
<script src="<?= base_url('principal/js/pages/custom.js'); ?>"></script>
<script src="<?= base_url('principal/js/pages/detail-carrito.js'); ?>"></script>
<script>
    updateDeseoView()
</script>
<?= $this->endSection() ?>
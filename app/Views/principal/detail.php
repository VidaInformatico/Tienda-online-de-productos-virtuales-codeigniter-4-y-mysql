<?= $this->extend('tienda_layout') ?>

<?= $this->section('css') ?>
<link rel="stylesheet" href="<?php echo base_url('principal/css/custom.css') ?>">
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<section class="breadcrumb-section set-bg" data-setbg="<?= base_url('principal'); ?>/img/breadcrumb.jpg">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="breadcrumb__text">
                    <h2><?= $producto['titulo']; ?></h2>
                    <div class="breadcrumb__option">
                        <a href="<?= base_url(); ?>">Home</a>
                        <span>Detalle</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="product-details spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6">
                <div class="product__details__pic">
                    <div class="product__details__pic__item">
                        <img class="product__details__pic__item--large" src="<?= base_url('img/' . $producto['imagen']); ?>" alt="">
                    </div>
                    <div class="product__details__pic__slider owl-carousel">
                        <?php foreach ($imagenes as $imagen) : ?>
                            <img data-imgbigurl="<?= base_url('img/productos/' . $producto['id'] . '/' . $imagen) ?>" src="<?= base_url('img/productos/' . $producto['id'] . '/' . $imagen) ?>" alt="">
                        <?php endforeach; ?>

                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6">
                <div class="product__details__text">
                    <h3><?= $producto['titulo']; ?></h3>
                    <?php if (session()->getFlashdata('success')) { ?>
                        <div class="alert alert-success" role="alert">
                            <?= session()->getFlashdata('success'); ?>
                        </div>
                        <br>
                    <?php } ?>
                    <div class="product__details__rating">
                        <?php
                        $starsHTML = '';
                        $promedio_calificacion = $promedio_calificacion ?? 0; // Si es null, establecer en 0

                        for ($i = 1; $i <= 5; $i++) {
                            $starClass = ($i <= $promedio_calificacion) ? 'fa-star' : 'fa-star-o';
                            $starsHTML .= '<i class="fa ' . $starClass . '"></i>';
                        }

                        echo $starsHTML;
                        echo '<span> (' . $promedio_calificacion . ' reviews)</span>';
                        ?>
                    </div>
                    <div class="product__details__price">$<?= $producto['precio_rebajado']; ?></div>
                    <p><?= $producto['descripcion']; ?></p>
                    <div class="product__details__quantity">
                        <div class="quantity">
                            <div class="pro-qty">
                                <input type="text" id="cantidadAdd" value="1">
                            </div>
                        </div>
                    </div>
                    <a href="#" data-precio="<?= $producto['precio_rebajado']; ?>" data-nombre="<?= $producto['titulo']; ?>" data-product-id="<?= $producto['id']; ?>" class="primary-btn add-to-cart">AÑADIR AL CARRITO</a>
                    <a href="#" data-precio="<?= $producto['precio_rebajado']; ?>" data-nombre="<?= $producto['titulo']; ?>" data-id="<?= $producto['id']; ?>" class="heart-icon add-deseo"><span class="icon_heart_alt"></span></a>
                    <ul>
                        <li><b>Compartir en</b>
                            <div class="share">
                                <a href="#" onclick="compartirEnFacebook()"><i class="fa fa-facebook"></i></a>
                                <a href="#" onclick="compartirEnTwitter()"><i class="fa fa-twitter"></i></a>
                                <a href="#" onclick="compartirEnPinterest()"><i class="fa fa-pinterest"></i></a>
                            </div>
                        </li>
                    </ul>
                    <hr>

                    <?php if (!empty($_SESSION['user_id'])) { ?>

                        <form action="<?php echo base_url('calificacion/agregar') ?>" method="post">
                            <input type="hidden" name="producto_id" value="<?php echo $producto['id']; ?>"> <!-- Reemplaza 1 con el valor correcto -->

                            <div class="form-group mb-0">
                                <label>Calificación</label>

                                <div class="star-rating">
                                    <input type="radio" id="5-stars" name="rating" value="5" />
                                    <label for="5-stars" class="star">&#9733;</label>
                                    <input type="radio" id="4-stars" name="rating" value="4" />
                                    <label for="4-stars" class="star">&#9733;</label>
                                    <input type="radio" id="3-stars" name="rating" value="3" />
                                    <label for="3-stars" class="star">&#9733;</label>
                                    <input type="radio" id="2-stars" name="rating" value="2" />
                                    <label for="2-stars" class="star">&#9733;</label>
                                    <input type="radio" id="1-star" name="rating" value="1" />
                                    <label for="1-star" class="star">&#9733;</label>
                                </div>

                                <?php $comentario = '';
                                if (session()->getFlashdata('error')) {
                                    $comentario = session()->getFlashdata('error')['comentario'];
                                ?>
                                    <div class="text-danger">
                                        <?= session()->getFlashdata('error')['rating_error']; ?>
                                    </div>
                                    <br>
                                <?php } ?>

                            </div>
                            <div class="form-group">
                                <label for="comentario">Comentario:</label>
                                <textarea id="comentario" class="form-control" name="comentario" placeholder="Comentario" rows="3"><?php echo $comentario; ?></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Agregar Calificación</button>
                        </form>

                    <?php } ?>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="product__details__tab">
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#tabs-3" role="tab" aria-selected="true">Reviews <span>(<?= $promedio_calificacion; ?>)</span></a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active mt-3" id="tabs-3" role="tabpanel">
                            <div class="categories__slider owl-carousel">
                                <?php foreach ($calificaciones as $calificacion) { ?>
                                    <div class="col-lg-3">
                                        <div class="card">
                                            <div class="card-body text-center">
                                                <img class="img-thumbnail rounded-circle" src="<?= base_url('principal/img/user.png'); ?>" width="80" alt="">
                                                <hr>
                                                <h5 class="card-title"><?= $calificacion['nombre']; ?></h5>

                                                <?php
                                                $starsHTML = '';
                                                for ($i = 1; $i <= 5; $i++) {
                                                    $starClass = ($i <= $calificacion['calificacion']) ? 'fa-star text-warning' : 'fa-star-o';
                                                    $starsHTML .= '<i class="fa ' . $starClass . '"></i>';
                                                }
                                                echo $starsHTML;
                                                ?>

                                                <p class="card-text"><?= $calificacion['comentario']; ?></p>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
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
<script src="<?= base_url('principal/js/pages/custom.js'); ?>"></script>
<script src="<?= base_url('principal/js/pages/detail-carrito.js'); ?>"></script>
<script src="<?= base_url('principal/js/pages/add-lista-deseo.js'); ?>"></script>
<?= $this->endSection() ?>
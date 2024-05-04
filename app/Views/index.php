<?= $this->extend('tienda_layout') ?>

<?= $this->section('css') ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<!-- Categories Section Begin -->
<section class="categories">
    <div class="container">
        <div class="row">
            <div class="categories__slider owl-carousel">
                <?php foreach ($categorias as $categoria) { ?>
                    <div class="col-lg-3">
                        <div class="categories__item set-bg" data-setbg="<?= base_url('img/' . $categoria['imagen']); ?>">
                            <h5><a href="<?= base_url('categorias/' . $categoria['slug']); ?>"><?= $categoria['nombre']; ?></a></h5>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</section>
<!-- Categories Section End -->

<!-- Featured Section Begin -->
<section class="featured spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title">
                    <h2>Nuevos Productos</h2>
                </div>
                <div class="featured__controls">
                    <ul>
                        <li class="active" data-filter="*">Todos</li>
                        <?php foreach ($categorias as $categoria) { ?>
                            <li data-filter=".cat_<?= $categoria['id']; ?>"><?= $categoria['nombre']; ?></li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        </div>
        <div class="row featured__filter">
            <?php foreach ($productos as $producto) { ?>
                <div class="col-lg-3 col-md-4 col-sm-6 mix oranges cat_<?= $producto['id_categoria']; ?>">
                    <div class="featured__item">
                        <div class="featured__item__pic set-bg" data-setbg="<?= base_url('img/' . $producto['imagen']); ?>">
                            <ul class="featured__item__pic__hover">
                                <li>
                                    <a href="#" data-precio="<?= $producto['precio_rebajado']; ?>" data-nombre="<?= $producto['titulo']; ?>" data-id="<?= $producto['id']; ?>" class="add-deseo">
                                        <i class="fa fa-heart"></i>
                                    </a>
                                </li>

                                <li>
                                    <a href="<?= base_url('producto/' . $producto['slug']); ?>">
                                        <i class="fa fa-retweet"></i>
                                    </a>
                                </li>

                                <li>
                                    <a href="#" class="add-to-cart" data-precio="<?= $producto['precio_rebajado']; ?>" data-nombre="<?= $producto['titulo']; ?>" data-product-id="<?= $producto['id']; ?>">
                                        <i class="fa fa-shopping-cart"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="featured__item__text">
                            <h6><a href="#"><?= $producto['titulo']; ?></a></h6>
                            <h5>$<?= $producto['precio_rebajado']; ?></h5>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</section>
<!-- Featured Section End -->

<?= $this->endSection() ?>

<?= $this->section('js') ?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>

<script src="<?= base_url('principal/js/pages/custom.js'); ?>"></script>
<script src="<?= base_url('principal/js/pages/add-carrito.js'); ?>"></script>
<script src="<?= base_url('principal/js/pages/add-lista-deseo.js'); ?>"></script>

<script>
    $(document).ready(function() {
        updateDeseoView()
        $('.owl-carousel').owlCarousel({
            rtl: true,
            loop: true,
            margin: 10,
            nav: true,
            autoplay: true,
            infinite: true,
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 1
                },
                1000: {
                    items: 1
                }
            }
        });
    });
</script>
<?= $this->endSection() ?>
<?= $this->extend('tienda_layout') ?>

<?= $this->section('content') ?>

<section class="breadcrumb-section set-bg" data-setbg="<?= base_url('principal'); ?>/img/breadcrumb.jpg">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="breadcrumb__text">
                    <h2>Categoria</h2>
                    <div class="breadcrumb__option">
                        <a href="<?= base_url(); ?>">Home</a>
                        <span>Tienda</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="product spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-5">
                <div class="sidebar">
                    <div class="sidebar__item">
                        <h4>Categorias</h4>
                        <ul>
                            <?php foreach ($categorias as $categoria) { ?>
                                <li><a href="<?= base_url('categorias/' . $categoria['slug']); ?>"><?php echo $categoria['nombre']; ?></a></li>
                            <?php } ?>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-9 col-md-7">
                <div class="filter__item">
                    <div class="row">
                        <div class="col-lg-6">
                            <h5>Total Productos <b><?php echo $totalProductos; ?></b></h5>
                        </div>
                        <!-- <div class="col-lg-6 col-md-3">
                            <div class="filter__option">
                                <span class="icon_grid-2x2"></span>
                                <span class="icon_ul"></span>
                            </div>
                        </div> -->
                    </div>
                </div>
                <div class="row">
                    <?php foreach ($productos as $producto) { ?>
                        <div class="col-lg-4 col-md-6 col-sm-6">
                            <div class="product__item">
                                <div class="product__item__pic set-bg" data-setbg="<?= base_url('img/' . $producto['imagen']); ?>">
                                    <ul class="product__item__pic__hover">
                                        <li>
                                            <a href="#" data-precio="<?= $producto['precio_rebajado']; ?>" data-nombre="<?= $producto['titulo']; ?>" data-id="<?= $producto['id']; ?>" class="add-deseo">
                                                <i class="fa fa-heart"></i>
                                            </a>
                                        </li>
                                        <li><a href="<?= base_url('producto/' . $producto['slug']); ?>"><i class="fa fa-retweet"></i></a></li>
                                        <li><a href="#" class="add-to-cart" data-precio="<?= $producto['precio_rebajado']; ?>" data-nombre="<?= $producto['titulo']; ?>" data-product-id="<?= $producto['id']; ?>"><i class="fa fa-shopping-cart"></i></a></li>
                                    </ul>
                                </div>
                                <div class="product__item__text">
                                    <h6><a href="#"><?= $producto['titulo']; ?></a></h6>
                                    <h5>$<?= $producto['precio_rebajado']; ?></h5>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
                <div class="product__pagination">
                    <?= $paginador->links() ?>
                </div>
            </div>
        </div>
    </div>
</section>

<?= $this->endSection() ?>

<?= $this->section('js') ?>
<script src="<?= base_url('principal/js/pages/custom.js'); ?>"></script>
<script src="<?= base_url('principal/js/pages/add-carrito.js'); ?>"></script>
<script src="<?= base_url('principal/js/pages/add-lista-deseo.js'); ?>"></script>
<?= $this->endSection() ?>
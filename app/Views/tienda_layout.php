<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Ogani Template">
    <meta name="keywords" content="Ogani, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?= $title ?? 'Tienda' ?></title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;600;900&display=swap" rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="<?= base_url('principal'); ?>/css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="<?= base_url('principal'); ?>/css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="<?= base_url('principal'); ?>/css/elegant-icons.css" type="text/css">
    <link rel="stylesheet" href="<?= base_url('principal'); ?>/css/nice-select.css" type="text/css">
    <link rel="stylesheet" href="<?= base_url('principal'); ?>/css/jquery-ui.min.css" type="text/css">
    <link rel="stylesheet" href="<?= base_url('principal'); ?>/css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="<?= base_url('principal'); ?>/css/slicknav.min.css" type="text/css">

    <link rel="stylesheet" href="<?= base_url('principal'); ?>/css/style.css" type="text/css">

    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

    <?= $this->renderSection('css') ?>
</head>

<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    <!-- Humberger Begin -->
    <div class="humberger__menu__overlay"></div>
    <div class="humberger__menu__wrapper">
        <div class="humberger__menu__logo">
            <a href="#"><img src="<?= base_url(); ?>img/logo.png" width="60" alt=""></a>
        </div>
        <div class="humberger__menu__cart">
            <ul>
                <li><a href="<?= base_url('deseo'); ?>"><i class="fa fa-heart"></i> <span id="wishlist-count1">0</span></a></li>
                <li><a href="<?= base_url('carrito'); ?>"><i class="fa fa-shopping-bag"></i> <span id="cart-count1">0</span></a></li>
            </ul>
            <div class="header__cart__price">item: <span id="cart-total1">$0.00</span></div>
        </div>
        <div class="humberger__menu__widget">
            <div class="header__top__right__auth">
                <a href="<?= base_url('login'); ?>"><i class="fa fa-user"></i> Login</a>
            </div>
        </div>
        <nav class="humberger__menu__nav mobile-menu">
            <ul>
                <li class="<?= $active == 'inicio' ? 'active' : ''; ?>"><a href="<?= base_url(); ?>">Inicio</a></li>
                <li class="<?= $active == 'tienda' ? 'active' : ''; ?>"><a href="<?= base_url('tienda'); ?>">Tienda</a></li>
                <li class="<?= $active == 'carrito' ? 'active' : ''; ?>"><a href="<?= base_url('carrito'); ?>">Carrito</a></li>
                <li class="<?= $active == 'contactos' ? 'active' : ''; ?>"><a href="<?= base_url('contactos'); ?>">Contactos</a></li>
            </ul>
        </nav>
        <div id="mobile-menu-wrap"></div>
        <div class="header__top__right__social">
            <a href="<?= $empresa['facebook']; ?>" target="_blank"><i class="fa fa-facebook"></i></a>
            <a href="<?= $empresa['twitter']; ?>" target="_blank"><i class="fa fa-twitter"></i></a>
            <a href="<?= $empresa['instagram']; ?>" target="_blank"><i class="fa fa-instagram"></i></a>
            <a href="<?= $empresa['whatsapp']; ?>" target="_blank"><i class="fa fa-whatsapp"></i></a>
        </div>
        <div class="humberger__menu__contact">
            <ul>
                <li><i class="fa fa-envelope"></i> <?= $empresa['correo']; ?></li>
                <li><?= $empresa['mensaje']; ?></li>
            </ul>
        </div>
    </div>
    <!-- Humberger End -->

    <!-- Header Section Begin -->
    <header class="header">
        <div class="header__top">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <div class="header__top__left">
                            <ul>
                                <li><i class="fa fa-envelope"></i> <?= $empresa['correo']; ?></li>
                                <li><?= $empresa['mensaje']; ?></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="header__top__right">
                            <div class="header__top__right__social">
                                <a href="<?= $empresa['facebook']; ?>" target="_blank"><i class="fa fa-facebook"></i></a>
                                <a href="<?= $empresa['twitter']; ?>" target="_blank"><i class="fa fa-twitter"></i></a>
                                <a href="<?= $empresa['instagram']; ?>" target="_blank"><i class="fa fa-instagram"></i></a>
                                <a href="<?= $empresa['whatsapp']; ?>" target="_blank"><i class="fa fa-whatsapp"></i></a>
                            </div>

                            <div class="header__top__right__auth">
                                <a href="<?= base_url('login'); ?>"><i class="fa fa-user"></i> Login</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="header__logo">
                        <a href="<?= base_url(); ?>"><img src="<?= base_url(); ?>img/logo.png" width="60" alt=""></a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <nav class="header__menu">
                        <ul>
                            <li class="<?= $active == 'inicio' ? 'active' : ''; ?>"><a href="<?= base_url(); ?>">Inicio</a></li>
                            <li class="<?= $active == 'tienda' ? 'active' : ''; ?>"><a href="<?= base_url('tienda'); ?>">Tienda</a></li>
                            <li class="<?= $active == 'carrito' ? 'active' : ''; ?>"><a href="<?= base_url('carrito'); ?>">Carrito</a></li>
                            <li class="<?= $active == 'contactos' ? 'active' : ''; ?>"><a href="<?= base_url('contactos'); ?>">Contactos</a></li>
                        </ul>
                    </nav>
                </div>
                <div class="col-lg-3">
                    <div class="header__cart">
                        <ul>
                            <li><a href="<?= base_url('deseo'); ?>"><i class="fa fa-heart"></i> <span id="wishlist-count">0</span></a></li>
                            <li><a href="<?= base_url('carrito'); ?>"><i class="fa fa-shopping-bag"></i> <span id="cart-count">0</span></a></li>
                        </ul>
                        <div class="header__cart__price">item: <span id="cart-total">$0.00</span></div>
                    </div>

                </div>
            </div>
            <div class="humberger__open">
                <i class="fa fa-bars"></i>
            </div>
        </div>
    </header>
    <!-- Header Section End -->

    <!-- Hero Section Begin -->
    <section class="<?= $class; ?>">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="hero__categories">
                        <div class="hero__categories__all">
                            <i class="fa fa-bars"></i>
                            <span>Categorias</span>
                        </div>
                        <ul>
                            <?php foreach ($categorias as $categoria) { ?>
                                <li><a href="<?= base_url('categorias/' . $categoria['slug']); ?>"><?php echo $categoria['nombre']; ?></a></li>
                            <?php } ?>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="hero__search">
                        <div class="hero__search__form">
                            <form action="#">
                                <input type="text" id="buscarInput" placeholder="Que estas buscando?">
                                <button type="button" class="site-btn">BUSCAR</button>
                            </form>
                        </div>
                        <div class="hero__search__phone">
                            <div class="hero__search__phone__icon">
                                <i class="fa fa-phone"></i>
                            </div>
                            <div class="hero__search__phone__text">
                                <h5><?= $empresa['telefono']; ?></h5>
                                <span><?= $empresa['direccion']; ?></span>
                            </div>
                        </div>
                    </div>
                    <?php if ($class == 'hero') { ?>
                        <div class="owl-carousel owl-theme">
                            <?php foreach ($sliders as $slider) { ?>
                                <div class="hero__item set-bg" data-setbg="<?= base_url('img/' . $slider['imagen']); ?>">
                                    <div class="hero__text">
                                        <span><?= $slider['titulo']; ?></span>
                                        <h2><?= $slider['subtitulo']; ?></h2>
                                        <p><?= $slider['subtitulo']; ?></p>
                                        <!-- <a href="#" class="primary-btn">VER MAS</a> -->
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </section>
    <!-- Hero Section End -->

    <?= $this->renderSection('content') ?>


    <!-- Footer Section Begin -->
    <footer class="footer spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="footer__about">
                        <div class="footer__about__logo">
                            <a href="<?= base_url(); ?>"><img src="<?= base_url(); ?>img/logo.png" width="40" alt=""></a>
                        </div>
                        <ul>
                            <li>Dirección: <?= $empresa['direccion']; ?></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6 offset-lg-1">
                    <div class="footer__widget">
                        <h6>Enlaces útiles</h6>
                        <ul>
                            <li><a href="#">Sobre Nosotros</a></li>
                            <li><a href="#">Compras Seguras</a></li>
                        </ul>
                        <ul>
                            <li><a href="#">Servicios</a></li>
                            <li><a href="<?= base_url('contactos'); ?>">Contactos</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12">
                    <div class="footer__widget">
                        <!-- <h6>Únase a nuestro boletín ahora</h6>
                        <p>Reciba actualizaciones por correo electrónico sobre nuestra última tienda y ofertas especiales.</p>
                        <form action="#">
                            <input type="text" placeholder="Introduce tu correo">
                            <button type="submit" class="site-btn">Suscribir</button>
                        </form> -->
                        <h6>Redes Sociales</h6>
                        <div class="footer__widget__social">
                            <a href="<?= $empresa['facebook']; ?>" target="_blank"><i class="fa fa-facebook"></i></a>
                            <a href="<?= $empresa['twitter']; ?>" target="_blank"><i class="fa fa-twitter"></i></a>
                            <a href="<?= $empresa['instagram']; ?>" target="_blank"><i class="fa fa-instagram"></i></a>
                            <a href="<?= $empresa['whatsapp']; ?>" target="_blank"><i class="fa fa-whatsapp"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="footer__copyright">
                        <div class="footer__copyright__text">
                            <p><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                                Copyright &copy;<script>
                                    document.write(new Date().getFullYear());
                                </script> All rights reserved <i class="fa fa-heart" aria-hidden="true"></i> by <a href="#" target="_blank">Tu sitio web</a>
                                <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p>
                        </div>
                        <div class="footer__copyright__payment"><img src="<?= base_url('principal'); ?>/img/payment-item.png" alt=""></div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- Footer Section End -->

    <!-- Js Plugins -->
    <script src="<?= base_url('principal'); ?>/js/jquery-3.3.1.min.js"></script>
    <script src="<?= base_url('principal'); ?>/js/bootstrap.min.js"></script>
    <script src="<?= base_url('principal'); ?>/js/jquery.nice-select.min.js"></script>
    <script src="<?= base_url('principal'); ?>/js/jquery-ui.min.js"></script>
    <script src="<?= base_url('principal'); ?>/js/jquery.slicknav.js"></script>
    <script src="<?= base_url('principal'); ?>/js/mixitup.min.js"></script>
    <script src="<?= base_url('principal'); ?>/js/owl.carousel.min.js"></script>
    <script src="<?= base_url('principal'); ?>/js/main.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <script>
        const base_url = '<?= base_url(); ?>';
        $(document).ready(function() {
            $("#buscarInput").autocomplete({
                source: function(request, response) {
                    $.ajax({
                        url: base_url + 'search',
                        type: "GET",
                        dataType: "json",
                        data: {
                            term: request.term
                        }, // Envía el término de búsqueda
                        success: function(data) {
                            response(data);
                        }
                    });
                },
                select: function(event, ui) {
                    window.location = base_url + 'producto/' + ui.item.slug;
                }
            });
        });
    </script>

    <?= $this->renderSection('js') ?>

</body>

</html>
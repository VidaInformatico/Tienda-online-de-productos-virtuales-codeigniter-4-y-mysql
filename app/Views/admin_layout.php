<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Responsive Admin Dashboard Template">
    <meta name="keywords" content="admin,dashboard">
    <meta name="author" content="stacks">
    <!-- The above 6 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <!-- Title -->
    <title><?= $title ?? 'Dashboard' ?></title>

    <!-- Styles -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp" rel="stylesheet">
    <link href="<?= base_url('admins/'); ?>assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= base_url('admins/'); ?>assets/plugins/perfectscroll/perfect-scrollbar.css" rel="stylesheet">
    <link href="<?= base_url('admins/'); ?>assets/plugins/pace/pace.css" rel="stylesheet">

    <link href="<?= base_url(); ?>plugin/datatables/datatables.min.css" rel="stylesheet">
    <!-- Theme Styles -->
    <link href="<?= base_url('admins/'); ?>assets/css/main.css" rel="stylesheet">
    <link href="<?= base_url('admins/'); ?>assets/css/custom.css" rel="stylesheet">

    <link rel="icon" type="image/png" sizes="32x32" href="<?= base_url('img/'); ?>logo.png" />
    <link rel="icon" type="image/png" sizes="16x16" href="<?= base_url('img/'); ?>logo.png" />

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <?= $this->renderSection('css') ?>

</head>

<body>
    <div class="app align-content-stretch d-flex flex-wrap">
        <div class="app-sidebar">
            <div class="logo">
                <a href="<?= base_url('dashboard'); ?>" class="logo-icon"><span class="logo-text">Tu sitio web</span></a>
                <div class="sidebar-user-switcher user-activity-online">
                    <a href="#">
                        <img src="<?= base_url('img/'); ?>logo.png">
                        <span class="activity-indicator"></span>
                        <span class="user-info-text"><?= $_SESSION['username']; ?><br><span class="user-state-info"><?= $_SESSION['rol']; ?></span></span>
                    </a>
                </div>
            </div>
            <div class="app-menu">
                <ul class="accordion-menu">
                    <li class="sidebar-title">
                        Apps
                    </li>
                    <li class="active-page">
                        <a href="<?= base_url('dashboard'); ?>" class="active"><i class="material-icons-two-tone">dashboard</i>Dashboard</a>
                    </li>
                    <li>
                        <a href="<?= base_url('admin/pedidos'); ?>"><i class="material-icons-two-tone">inbox</i>Pedidos<span class="badge rounded-pill badge-danger float-end" id="totalPedidos">0</span></a>
                    </li>
                    <li>
                        <a href=""><i class="material-icons-two-tone">star</i>Administración<i class="material-icons has-sub-menu">keyboard_arrow_right</i></a>
                        <ul class="sub-menu">
                            <li>
                                <a href="<?= base_url('admin/empresa'); ?>">Configuración</a>
                            </li>
                            <li>
                                <a href="<?= base_url('admin/sliders'); ?>">Sliders</a>
                            </li>
                            <li>
                                <a href="<?= base_url('admin/usuarios'); ?>">Usuarios </a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#"><i class="material-icons-two-tone">color_lens</i>Mantenimientos<i class="material-icons has-sub-menu">keyboard_arrow_right</i></a>
                        <ul class="sub-menu">
                            <li>
                                <a href="<?= base_url('admin/categorias'); ?>">Categorias</a>
                            </li>
                            <li>
                                <a href="<?= base_url('admin/productos'); ?>">Productos</a>
                            </li>
                        </ul>
                    </li>
                    <li class="sidebar-title">
                        Other
                    </li>
                    <li>
                        <a href="<?= base_url('logout'); ?>"><i class="material-icons-two-tone">bookmark</i>Cerrar Sesión</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="app-container">
            <div class="app-header">
                <nav class="navbar navbar-light navbar-expand-lg">
                    <div class="container-fluid">
                        <div class="navbar-nav" id="navbarNav">
                            <ul class="navbar-nav">
                                <li class="nav-item">
                                    <a class="nav-link hide-sidebar-toggle-button" href="#"><i class="material-icons">first_page</i></a>
                                </li>
                            </ul>

                        </div>
                        <div class="d-flex">
                            <ul class="navbar-nav">
                                <li class="nav-item hidden-on-mobile">
                                    <a class="nav-link language-dropdown-toggle" href="#" id="languageDropDown" data-bs-toggle="dropdown"><img src="<?= base_url('img/'); ?>logo.png" alt=""></a>
                                    <ul class="dropdown-menu dropdown-menu-end language-dropdown" aria-labelledby="languageDropDown">
                                        <li class="text-center"><a class="dropdown-item" href="<?= base_url('perfil'); ?>">Perfil</a></li>
                                        <hr>
                                        <li class="text-center"><a class="dropdown-item" href="<?= base_url('logout'); ?>">Salir</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>
            </div>
            <div class="app-content">
                <div class="content-wrapper">
                    <div class="container">

                        <?= $this->renderSection('content') ?>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Javascripts -->
    <script src="<?= base_url('admins/'); ?>assets/plugins/jquery/jquery-3.5.1.min.js"></script>
    <script src="<?= base_url('admins/'); ?>assets/plugins/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?= base_url('admins/'); ?>assets/plugins/perfectscroll/perfect-scrollbar.min.js"></script>
    <script src="<?= base_url('admins/'); ?>assets/plugins/pace/pace.min.js"></script>
    <script src="<?= base_url('admins/'); ?>assets/js/main.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="<?= base_url(); ?>plugin/datatables/datatables.min.js"></script>
    <script>
        const base_url = '<?= base_url(); ?>';
    </script>
    <script src="<?= base_url('admins/'); ?>assets/js/custom.js"></script>

    <?= $this->renderSection('js') ?>
</body>

</html>
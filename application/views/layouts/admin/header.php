<?php
    /**
     * @var $this CI_Loader
     */
?>
<!DOCTYPE html>
<html>
<head>
    <title><?= isset($title) ? $title : 'SDCE Admin' ?></title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <?= $this->registerAssets($assets) ?>
</head>

<body class="skin-blue-light sidebar-mini">
<div class="wrapper">

    <header class="main-header">
        <!-- Logo -->
        <a href="<?= site_url() ?>" class="logo">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini"><i class="ion-waterdrop"></i></span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg"><span class="ion-waterdrop"></span> <b>SDCE</b> <span style="font-size: 8pt;">admin blue!</span></span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                <span class="sr-only">Menu</span>
            </a>

            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    <!-- User Account: style can be found in dropdown.less -->
                    <li class="dropdown user user-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <span class="ion ion-locked"></span>
                            <span class="hidden-xs"><?= $this->session->userdata('NOMBRE_USUARIO'); ?></span>
                        </a>
                        <ul class="dropdown-menu">
                            <!-- User image -->
                            <li class="user-header">
                                <p>
                                    Admistrador
                                    <small>Miembro desde <?= $this->session->userdata('FECHA_REGISTRO') ?></small>
                                </p>
                                <p>
                                    Inició sesión
                                    <small><?= $this->usuarios_model->TraeUltimoInicioSesionAdmin() ?></small>
                                </p>
                            </li>

                            <!-- Menu Footer-->
                            <li class="user-footer" style="background-color: rgba(61, 142, 188, 0.7)">
                                <!--<div class="pull-left">-->
                                <!--    <a href="-->
                                <? //= site_url('perfil') ?><!--" class="btn btn-default btn-flat">Perfil</a>-->
                                <!--</div>-->
                                <div class="pull-right">
                                    <a href="<?= site_url('app/logout') ?>" style="" id="logout"
                                       class="btn btn-default btn-flat">Cerrar sesi&oacute;n <i style="color: #b60000"
                                                                                                class="ion-power"></i></a>
                                </div>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
        <script>
        </script>
    </header>

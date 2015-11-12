<?php
    /**
     * @var $this CI_Loader
     */
?>
<!DOCTYPE html>
<html>
<head>
    <title><?= isset($title) ? $title : 'SDCE Asesor' ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= $this->registerAssets($assets) ?>
</head>


<body class="skin-green-light sidebar-mini">
<div class="wrapper">

    <header class="main-header">
        <!-- Logo -->
        <a href="<?= site_url() ?>" class="logo">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini"><i class="fa fa-leaf"></i></span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg"><span class="ion-leaf"></span> <b>SDCE</b> <span
                    style="font-size: 8pt;">live green!</span></span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                <span class="sr-only">Menu</span>
            </a>

            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    <?= $this->parametros_model->PeriodoAcademicoHeader(YEAR_SDCE) ?>
                    <!-- User Account: style can be found in dropdown.less -->
                    <li class="dropdown user user-menu" id="usermenu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <img
                                src="<?= base_url('asesorfotos/' . $this->session->userdata('FOTO')) ?>"
                                class="user-image" alt="User Image"/>
                            <span class="hidden-xs"><?= $this->session->userdata('NOMBRE_USUARIO') ?></span>
                        </a>
                        <ul class="dropdown-menu">
                            <!-- User image -->
                            <li class="user-header">
                                <img
                                    src="<?= base_url('asesorfotos/' . $this->session->userdata('FOTO')) ?>"
                                    class="img-circle" alt="User Image"/>

                                <p>
                                    <?= $this->session->userdata('NOMBRE_USUARIO') ?>
                                    - Asesor
                                    <small>Miembro desde <?= $this->session->userdata('FECHA_REGISTRO') ?></small>
                                </p>
                            </li>
                            <!-- Menu Footer-->
                            <li class="user-footer" style="background-color: rgba(2, 140, 76, 0.7)">
                                <div class="pull-left">
                                    <a href="<?= site_url('perfil') ?>" class="btn btn-default btn-flat">Perfil <i
                                            class="ion-ios-color-wand"></i></a>
                                </div>
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
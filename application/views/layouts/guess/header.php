<?php
    /**
     * @var $this CI_Loader
     */
?>
<!DOCTYPE html>
<html>
<head>
    <title><?= isset($title) ? $title : 'SDCE Admin' ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= $this->registerAssets($assets) ?>
</head>


<body class="skin-green-light sidebar-mini sidebar-collapse">
<div class="wrapper">

    <header class="main-header">
        <!-- Logo -->
        <a href="#" class="logo">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini"><i class="ion ion-android-home"></i></span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg"><span class="ion-leaf"></span> <b>SDCE</b> <span style="font-size: 8pt;">live green!</span></span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
            <!-- Sidebar toggle button-->

            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">

                    <!-- Full screen -->
                    <li class="dropdown fullscreen">
                        <a href="#" onclick="BigScreen.toggle()" class="dropdown-toggle" id="screen"
                           data-toggle="dropdown"
                           data-toggle="tooltip" title="Pantalla completa">
                            <i class="ion ion-monitor"></i>
                        </a>
                    </li>

                    <!-- User Account: style can be found in dropdown.less -->
                    <li class="dropdown user user-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">

                            <span class="hidden-xs"><i
                                    class="ion ion-person"></i> <?= $this->session->userdata('GUESS_NOMBRE') ?></span>
                        </a>
                    </li>

                </ul>
            </div>
        </nav>
        <script>
        </script>
    </header>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
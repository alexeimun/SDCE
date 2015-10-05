<?php
    /**
     * @var $this CI_Loader
     */
?>

<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left ">
                <img
                    src="<?= base_url() ?>/public/images/logo.jpg" draggable="false" style="cursor: pointer"
                    class="img-responsive" alt="FUMC"  onclick="location.href='<?= site_url() ?>'"/>
            </div>

        </div>
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
            <li class="header"><span style="color:#6b6b6b;">MENU PRINCIPAL</span></li>

            <li class="treeview">


        <li class="treeview">
            <a href="#">
                <i class="ion-person"></i> <span>&nbsp;&nbsp;Asesores</span>
                <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
                <li>
                <li><a href="<?= site_url('crearasesor') ?>"><i class="fa ion-person-add"></i> Crear Asesor</a></li>
                <li><a href="<?= site_url('asesores') ?>"><i class="fa ion-clipboard"></i> Listado Asesores</a></li>
        </li>
        </ul>
        </li>

        </li>

        <li class="treeview">
            <a href="#">
                <i class="ion-cube"></i> <span>&nbsp;&nbsp;Agencias</span>
                <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
                <li>
                <li><a href="<?= site_url('agencias/crearagencia') ?>"><i class="fa ion-android-add"></i> Crear Agencia</a>
                </li>
                <li><a href="<?= site_url('agencias') ?>"><i class="fa ion-clipboard"></i> Listado Agencias</a></li>
        </li>
        </ul>
        </li>

        <li class="treeview">
            <a href="#">
                <i class="ion-android-folder-open"></i> <span>&nbsp;&nbsp;Proyectos</span>
                <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
                <li>
                    <!--Tipos de proyecto-->
                <li class="treeview">
                    <a href="#">
                        <i class="ion-funnel"></i> <span>&nbsp;&nbsp;Tipos de Proyectos</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li>
                        <li><a href="<?= site_url('proyectos/creartipoproyecto') ?>"><i class="fa ion-android-add"></i>
                                Crear Tipo Proyecto</a></li>
                        <li><a href="<?= site_url('proyectos/tipoproyectos') ?>"><i class="fa ion-clipboard"></i> Listado Tipo Proyectos</a></li>
                </li>
            </ul>
        </li>
        <!--Tipos de proyecto-->
        <li><a href="<?= site_url('proyectos/crearproyecto') ?>"><i class="fa ion-android-add"></i> Crear Proyecto</a>
        </li>
        <li><a href="<?= site_url('proyectos') ?>"><i class="fa ion-clipboard"></i> Listado Proyectos</a></li>
        </li>
        </ul>
        </li>


            <li class="treeview">
                <a href="#">
                    <i class="ion-person"></i> <span>&nbsp;&nbsp;Cooperadores</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li>
                    <li><a href="<?= site_url('cooperadores/crearcooperador') ?>"><i class="fa ion-person-add"></i> Crear
                            Cooperador</a></li>
                    <li><a href="<?= site_url('cooperadores') ?>"><i class="fa ion-clipboard"></i> Listado Cooperadores</a>
                    </li>
                    </li>
                </ul>
            </li>


                <li class="treeview">
                        <a href="#">
                                <i class="ion-person-stalker"></i> <span>&nbsp;&nbsp;Practicantes</span>
                                <i class="fa fa-angle-left pull-right"></i>
                        </a>
                        <ul class="treeview-menu">
                                <li>
                                <li><a href="<?= site_url('practicantes/crearpracticante') ?>"><i class="fa ion-person-add"></i> Crear
                                                Practicante</a></li>
                                <li><a href="<?= site_url('practicantes') ?>"><i class="fa ion-clipboard"></i> Listado Practicantes</a>
                                </li>
                                </li>
                        </ul>
                </li>
        <li class="treeview">
            <a href="<?= site_url('parametros') ?>">
                <i class="glyphicon glyphicon-cog"></i> <span>Parámetros</span>
            </a>
        </li>
        <li class="treeview">
            <a href="<?= site_url('app/acerca') ?>">
                <i class="ion ion-android-contact"></i> <span>Acerca</span>
            </a>
        </li>

        </ul>
    </section>
    <!-- /.sidebar -->
</aside>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

<?php
    /**
     * @var $this CI_Loader
     */
?>
<section class="content">
    <!-- Small boxes (Stat box) -->
    <div class="row">
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-orange-active">
                <div class="inner">
                    <h3><?= $Asesores ?></h3>

                    <p>Asesores</p>
                </div>
                <div class="icon">
                    <i style="cursor: pointer;" onclick="location.href='asesores'"
                       class="ion ion-person-stalker"></i>
                </div>
                <a href="practicantes" class="small-box-footer">Más información <i class="fa fa-arrow-circle-right"></i></a>
            </div>

        </div>

        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-green-gradient">
                <div class="inner">
                    <h3><?= $Practicantes ?></h3>

                    <p>Practicantes</p>
                </div>
                <div class="icon">
                    <i style="cursor: pointer;" onclick="location.href='practicantes'"
                       class="ion ion-person-stalker"></i>
                </div>
                <a href="practicantes" class="small-box-footer">Más información <i class="fa fa-arrow-circle-right"></i></a>
            </div>

        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-blue-gradient">
                <div class="inner">
                    <h3><?= $Proyectos ?></h3>

                    <p>Proyectos</p>
                </div>
                <div class="icon">
                    <i style="cursor: pointer;" onclick="location.href='proyectos'"
                       class="ion ion-help-buoy"></i>
                </div>
                <a href="proyectos" class="small-box-footer">Más información <i
                        class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-purple-gradient">
                <div class="inner">
                    <h3><?= $Agencias ?></h3>

                    <p>Agencias</p>
                </div>
                <div class="icon">
                    <i class="ion ion-cube" style="cursor: pointer;" onclick="location.href='agencias'"></i>
                </div>
                <a href="agencias" class="small-box-footer">Más información <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-red-gradient">
                <div class="inner">
                    <h3><?= $Usuarios ?></h3>

                    <p>Usuarios</p>
                </div>
                <div class="icon">
                    <i class="ion ion-person-stalker" style="cursor: pointer;" onclick="location.href='usuarios'"></i>
                </div>
                <a href="usuarios" class="small-box-footer">Más información <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <!-- ./col -->
    </div>
    <div class="row">
        <div class="col-md-5">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Personas conectadas...</h3>

                    <div class="box-tools pull-right">
                        <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <ul class="products-list product-list-in-box">

                        <?php
                            $c = 0;
                            foreach ($this->usuarios_model->TraeTodoUsuariosLogin() as $user): ?>
                                <?php
                                if($user['ID_USUARIO'] == $this->session->userdata('ID_USUARIO'))
                                {
                                    continue;
                                }

                                if($user['LOG_IN'] != 1 || (strtotime(date('Y-m-d H:i:s')) - strtotime($user['FACHA_ULTIMO_INICIO_SESION']) > 7200))
                                {
                                    continue;
                                }
                                $c++;
                                ?>
                                <li class="item">
                                    <div class="product-img">
                                        <img src="<?= base_url('asesorfotos/' . ($user['FOTO'])) ?>" width="50"
                                             height="50" alt="User Image">
                                    </div>
                                    <div class="product-info">
                                        <a target="_blank"
                                           href="<?= ($user['NIVEL'] == 0 ? 'asesores/verasesor/' : 'usuarios/verusuario/') . $user['ID_USUARIO'] ?>
                                        " class="product-title"><?= $user['NOMBRE'] ?> <span
                                                class="label label-success pull-right"><?= Momento($user['FACHA_ULTIMO_INICIO_SESION']) ?></span></a>
                        <span class="product-description">
                          <?= ($user['NIVEL'] == 0 ? 'Asesor de prácticas' : 'Administrador del sistema') ?>
                        </span>
                                    </div>
                                </li><!-- /.item -->
                            <?php endforeach ?>
                        <?php
                            if($c == 0)
                            {
                                echo '<p> &nbsp;&nbsp;&nbsp;No hay personas conectadas...</p>';
                            }
                        ?>
                    </ul>
                </div>
                <!-- /.box-body -->
                <div class="box-footer text-center">
                </div>
                <!-- /.box-footer -->
            </div>
            <!-- /.box -->
        </div>

        <div class="col-md-6">
            <!-- USERS LIST -->
            <div class="box box-success">
                <div class="box-header with-border">
                    <h3 class="box-title">Asesores y usuarios creados recientemente...</h3>

                    <div class="box-tools pull-right">
                        <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body no-padding">
                    <ul class="users-list clearfix">
                        <?php
                            $c = 0;
                            foreach ($this->usuarios_model->TraeTodoUsuarios() as $user): ?>
                                <li>
                                    <img src="<?= base_url('asesorfotos/' . ($user['FOTO'])) ?>" width="50" height="50"
                                         alt="User Image">
                                    <a class="users-list-name" target="_blank"
                                       href="<?= ($user['NIVEL'] == 0 ? 'asesores/verasesor/' : 'usuarios/verusuario/') . $user['ID_USUARIO'] ?>"><?= $user['NOMBRE'] ?></a>
                                    <span
                                        class="users-list-date">creado <?= strtolower(Momento($user['FECHA_REGISTRO'])) ?></span>
                                </li>
                                <?php
                                $c++;
                                if($c == 8)
                                {
                                    break;
                                }
                            endforeach ?>
                        <?php
                            if($c == 0)
                            {
                                echo '<p> &nbsp;&nbsp;&nbsp;No hay usuarios ni asesores recientes...</p>';
                            }
                        ?>
                    </ul>
                    <!-- /.users-list -->
                </div>
                <!-- /.box-body -->
                <div class="box-footer text-center">
                    Ver todos los: <a target="_blank" href="<?= site_url('asesores') ?>" class="uppercase">asesores</a>
                    o
                    <a target="_blank" href="<?= site_url('usuarios') ?>" class="uppercase"> usuarios</a>
                </div>
                <!-- /.box-footer -->
            </div>
            <!--/.box -->
        </div>

        <!-- /.col -->
    </div>
</section><!-- /.content -->
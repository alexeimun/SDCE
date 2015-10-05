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
                       class="ion ion-android-folder-open"></i>
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
        <!-- ./col -->
    </div>
</section><!-- /.content -->

<?php
    /**
     * @var $this CI_Loader
     */
    $this->Header(['assets' => ['dialogs', 'spin', 'jvalidator', 'datatables']]);
?>
<!-- Content Header (Page header) -->
<section class="content-header">
</section>
<!-- Main content -->
<div class="container">
    <?= form_open('', ['class' => 'form-horizontal col-md-10', 'style' => 'margin-left: 10%']) ?>

    <div class="row">
        <div class="col-md-12 col-lg-push-0">
            <!-- Widget: user widget style 1 -->
            <div class="box box-widget widget-user">
                <!-- Add the bg color to the header using any of the bg-* classes -->
                <div class="widget-user-header bg-aqua-active">
                    <h3 class="widget-user-username"><?= $Info->NOMBRE ?></h3>
                    <h5 class="widget-user-desc">Miembro desde, <?= Momento($Info->FECHA_REGISTRO) ?></h5>
                    <h5 class="widget-user-desc">Último inicio de
                        sesión <?= Momento($Info->FACHA_ULTIMO_INICIO_SESION) ?></h5>
                </div>
                <div class="widget-user-image">
                    <img class="img-circle" src="<?= base_url('asesorfotos/' . $Info->FOTO) ?>" width="128" height="128"
                         alt="User Avatar">
                </div>
                <div class="box-footer">
                    <div class="row">
                        <div class="col-sm-4 border-right">
                            <div class="description-block">
                                <h5 class="description-header" style="color: #3878a3"><?= $Data['TPRO'] ?> <i
                                        class="ion-help-buoy"></i>
                                </h5>
                                <b> Proyectos</b>
                            </div>
                            <!-- /.description-block -->
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-4">
                            <div class="description-block">
                                <h5 class="description-header"><br></h5>
                                <b>
                                    <?php
                                        if($Data['ESTADO']->L == 1 &&  (strtotime(date('Y-m-d H:i:s')) - strtotime($Data['ESTADO']->U) < 7200))
                                        {
                                            echo '<i style="color: rgba(13, 134, 78, 0.83)" class="ion-record"></i> Conectado';
                                        }
                                        else
                                        {
                                            echo '<i style="color: rgba(153, 25, 46, 0.83)" class="ion-record"></i> Desconectado';
                                        }
                                    ?>
                                </b>
                            </div>
                            <!-- /.description-block -->
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-4">
                            <div class="description-block">
                                <h5 class="description-header" style="color: #3878a3"><?= $Data['TPRA'] ?> <i class="ion-person-stalker"></i></h5>
                                <b> Practicantes</b>
                            </div>
                            <!-- /.description-block -->
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
            </div>
            <!-- /.widget-user -->
        </div>
        <!-- /.col -->
    </div>
    <br>
    <?= form_input(['readonly' => true, 'label' => ['text' => 'Correo']], $Info->CORREO) ?>
    <?= form_input(['readonly' => true, 'label' => ['text' => 'Documento']], $Info->DOCUMENTO) ?>
    <?= form_input(['readonly' => true, 'label' => ['text' => 'Teléfono']], Telefono($Info->TELEFONO)) ?>
    <?= form_input(['readonly' => true, 'label' => ['text' => 'Celular']], Telefono($Info->CELULAR)) ?>
    <?= br(2) ?>

    <div class="box">
        <div class="box-header bg-gray">
            <h3 style="color:#7d7d80;text-align: center"><span class="ion ion-person-stalker"></span> Practicantes
            </h3>
        </div>
        <div class="box-body">
            <?= Component::Table(['columns' => ['Nombre', 'Proyecto', 'Agencia'],
                'tableName' => 'practicante', 'autoNumeric' => true, 'id' => 'ID_PRACTICANTE', 'controller' => 'practicantes',
                'fields' => ['NOMBRE_PRACTICANTE', 'NOMBRE_PROYECTO', 'NOMBRE_AGENCIA']
                , 'dataProvider' => $this->practicantes_model->TraePracticantes($Info->ID_USUARIO), 'actions' => 'uv']) ?>
        </div>

    </div>
    <?= br(2) ?>

    <?= form_close() ?>

</div>
<?= $this->Footer() ?>
<script type="text/javascript">
    $(function () {
        $("#tabla").dataTable();
    });
</script>

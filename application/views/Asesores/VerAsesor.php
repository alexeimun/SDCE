<?php
    /**
     * @var $this CI_Loader
     */
    $this->Header(['assets' => ['dialogs', 'spin', 'jvalidator', 'dropdown']]);

?>
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <?= page_title(['ob'=>$this,'class' => 'ios ion-person', 'text' => Uncamelize(__FILE__)]) ?>
    </section>
    <!-- Main content -->
    <div class="container">
        <?= form_open('', ['class' => 'form-horizontal col-md-10', 'style' => 'margin-left: 10%']) ?>
        <hr style="border: 1px solid #3D8EBC;"/>
        <div style="text-align: center;" id="imagen">

            <img style="width: 130px;height: 130px;cursor: pointer"
                 src="<?= base_url('asesorfotos/' . $Info->FOTO) ?>"
                 class="img-circle" alt="Asesor image"/>
        </div>
        <br>
        <?= form_input(['readonly' => true, 'label' => ['text' => 'Nombre']], $Info->NOMBRE) ?>
        <?= form_input(['readonly' => true, 'label' => ['text' => 'Correo']], $Info->CORREO) ?>
        <?= form_input(['readonly' => true, 'label' => ['text' => 'Documento']], $Info->DOCUMENTO) ?>
        <?= form_input(['readonly' => true, 'label' => ['text' => 'Teléfono']], $Info->TELEFONO) ?>
        <?= form_input(['readonly' => true, 'label' => ['text' => 'Fecha registro', 'col' => 2], 'input' => ['col' => 10]], Momento($Info->FECHA_REGISTRO)) ?>

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
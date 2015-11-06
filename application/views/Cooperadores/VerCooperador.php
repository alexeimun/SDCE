<?php
    /**
     * @var $this CI_Loader
     */
    $this->Header(['assets' => ['dialogs', 'spin', 'jvalidator']]);

?>
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <?= page_title(['ob'=>$this,'class' => 'fa fa-eye', 'text' => Uncamelize(__FILE__)]) ?>
    </section>
    <!-- Main content -->
    <div class="container">
        <?= form_open('', ['class' => 'form-horizontal col-md-6', 'style' => 'margin-left: 20%'], ['ID_AGENCIA' => $Info->ID_COOPERADOR]) ?>
        <hr style="border: 1px solid #3D8EBC;"/>
        <?= form_input(['readonly' => true, 'label' => ['text' => 'Nombre']], $Info->NOMBRE_COOPERADOR) ?>
        <?= select_input(['select' => Dropdown(['name' => 'ID_AGENCIA', 'index' => $Info->ID_AGENCIA, 'dataProvider' => $this->agencias_model->TraeAgenciasDD(), 'readonly' => true,
            'placeholder' => '-- Seleccione una agencia--', 'fields' => ['NOMBRE_AGENCIA']]), 'text' => 'Agencia']) ?>

        <?= form_input(['readonly' => true, 'label' => ['text' => 'Correo']], $Info->CORREO_COOPERADOR) ?>
        <?= form_input(['readonly' => true, 'label' => ['text' => 'Dirección']], $Info->DIRECCION_COOPERADOR) ?>
        <?= form_input(['readonly' => true, 'label' => ['text' => 'Teléfono']], $Info->TELEFONO_COOPERADOR) ?>
        <?= form_input(['readonly' => true, 'label' => ['text' => 'Cargo']], $Info->CARGO) ?>
        <?= form_input(['readonly' => true, 'label' => ['text' => 'Fecha registro', 'col' => 3], 'input' => ['col' => 9]], Momento($Info->FECHA_REGISTRO)) ?>

        <?= form_close() ?>
    </div>
<?= $this->Footer() ?>
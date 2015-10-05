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
        <?= form_open('', ['class' => 'form-horizontal col-md-6', 'style' => 'margin-left: 20%']) ?>
        <hr style="border: 1px solid #3D8EBC;"/>
        <?= form_input(['class' => 'obligatorio', 'readonly' => true, 'label' => ['text' => 'Nombre']], $Info->NOMBRE_AGENCIA) ?>
        <?= form_input(['class' => 'correo', 'readonly' => true, 'label' => ['text' => 'Correo']], $Info->CORREO_AGENCIA) ?>
        <?= select_input(['select' => $Ciudades, 'text' => 'Ciudad']) ?>
        <?= form_input(['class' => 'obligatorio', 'readonly' => true, 'label' => ['text' => 'Dirección']], $Info->DIRECCION) ?>
        <?= form_input(['readonly' => true, 'label' => ['text' => 'Teléfono']], $Info->TELEFONO1) ?>
        <?= form_input(['class' => '', 'readonly' => true, 'label' => ['text' => 'Teléfono#2']],$Info->TELEFONO2) ?>
        <?= form_input(['class' => '', 'readonly' => true, 'label' => ['text' => 'Fax']],$Info->FAX) ?>
        <?= form_input(['class' => '', 'readonly' => true, 'label' => ['text' => 'Página']],$Info->PAGINA_WEB) ?>
        <?= form_input(['class' => 'obligatorio', 'readonly' => true, 'label' => ['text' => 'Fecha registro']], $Info->FECHA_REGISTRO) ?>
        <!--Envíar-->

        <?= call_spin_div() ?>

        <?= form_close() ?>

    </div>
<?= $this->Footer() ?>
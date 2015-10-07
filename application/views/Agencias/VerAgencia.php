<?php
    /**
     * @var $this CI_Loader
     */
    $this->Header(['assets' => ['dialogs', 'spin', 'jvalidator', 'dropdown']]);

?>
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <?= page_title(['ob' => $this, 'class' => 'ios ion-person', 'text' => Uncamelize(__FILE__)]) ?>
    </section>
    <!-- Main content -->
    <div class="container">
        <?= form_open('', ['class' => 'form-horizontal col-md-6', 'style' => 'margin-left: 20%']) ?>
        <hr style="border: 1px solid #3D8EBC;"/>
        <?= form_input(['class' => 'obligatorio', 'readonly' => true, 'label' => ['text' => 'Nombre']], $Info->NOMBRE_AGENCIA) ?>
        <?= form_input(['class' => 'correo', 'readonly' => true, 'label' => ['text' => 'Correo']], $Info->CORREO_AGENCIA) ?>
        <?= select_input(['select' => $Ciudades, 'text' => 'Ciudad']) ?>
        <?= form_input(['class' => 'obligatorio', 'readonly' => true, 'label' => ['text' => 'Dirección']], $Info->DIRECCION) ?>
        <?= form_input(['readonly' => true, 'label' => ['text' => 'Teléfono']], Telefono($Info->TELEFONO1)) ?>
        <?= form_input(['class' => '', 'readonly' => true, 'label' => ['text' => 'Teléfono#2']], Telefono($Info->TELEFONO2)) ?>
        <?= form_input(['class' => '', 'readonly' => true, 'label' => ['text' => 'Fax']], $Info->FAX) ?>
        <div class='form-group'>
            <label for='$name' class='col-lg-2 control-label'>Página</label>
            <div class='col-lg-10'>
                <a target="_blank" class="btn-link" href="http://<?= str_replace('https', '', str_replace('http', '', str_replace('://', '', $Info->PAGINA_WEB))) ?>"><b><?= $Info->PAGINA_WEB ?></b></a>
            </div>
        </div>
        <?= form_input(['class' => 'obligatorio', 'readonly' => true, 'label' => ['text' => 'Fecha registro']], Momento($Info->FECHA_REGISTRO)) ?>
        <!--Envíar-->

        <?= call_spin_div() ?>
        <br>
        <?= form_close() ?>

    </div>
<?= $this->Footer() ?>
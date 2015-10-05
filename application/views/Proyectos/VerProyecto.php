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
    <?= form_input(['readonly'=>true,'class' => 'obligatorio', 'readonly'=>true,'label' => ['text' => 'Nombre']],$Info->NOMBRE_PROYECTO) ?>

    <?= form_input(['readonly'=>true, 'label' => ['text' => 'Fecha registro','col'=>3],'input'=>['col'=>9]],Momento($Info->FECHA_REGISTRO)) ?>

    <?= form_close() ?>
</div>
<?= $this->Footer() ?>
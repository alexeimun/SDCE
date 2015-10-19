<?php
    /**
     * @var $this CI_Loader
     */
    $this->Header(['assets' => ['dialogs', 'spin', 'jvalidator', 'icheck']]);

?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <?= page_title(['ob' => $this, 'class' => 'ios ion-ios-eye', 'text' => Uncamelize(__FILE__)]) ?>
</section>
<!-- Main content -->
<div class="container">
    <?= form_open('', ['class' => 'form-horizontal col-md-6', 'style' => 'margin-left: 20%']) ?>
    <hr style="border: 1px solid #3D8EBC;"/>
    <br>
    <?= form_input(['readonly' => true, 'label' => ['text' => 'Nombre']], $Info->NOMBRE) ?>
    <?= form_input(['readonly' => true, 'label' => ['text' => 'Correo']], $Info->CORREO) ?>
    <?= form_input(['readonly' => true, 'label' => ['text' => 'Fecha registro', 'col' => 2], 'input' => ['col' => 10]], Momento($Info->FECHA_REGISTRO)) ?>
    <h3 style="text-align: center;color: #3D8EBC">El usuario puede administrar</h3>
    <hr style="border: 1px solid #3D8EBC;"/>
    <?= $Modulos ?>
    <?= br(2) ?>

    <?= form_close() ?>

</div>
<?= $this->Footer() ?>

<script>

    $('input:checkbox').iCheck({
        checkboxClass: 'iradio_square-blue',
        increaseArea: '90%' // optional
    });
</script>

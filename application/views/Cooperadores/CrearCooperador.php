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
    <?= form_input(['placeholder' => 'Ingrese el nombre del cooperador', 'name' => 'NOMBRE_COOPERADOR', 'class' => 'obligatorio', 'label' => ['text' => 'Nombre']]) ?>
    <?= select_input(['select' => Dropdown(['name' => 'ID_AGENCIA', 'dataProvider' => $this->agencias_model->TraeAgenciasDD(),
        'placeholder' => '-- Seleccione una agencia--', 'fields' => ['NOMBRE_AGENCIA']]), 'text' => 'Agencia']) ?>

    <?= form_input(['placeholder' => 'Ingrese el correo del cooperador', 'name' => 'CORREO_COOPERADOR', 'class' => 'correo', 'label' => ['text' => 'Correo']]) ?>
    <?= form_input(['placeholder' => 'Ingrese la dirección del cooperador', 'name' => 'DIRECCION_COOPERADOR', 'label' => ['text' => 'Dirección']]) ?>
    <?= form_input(['placeholder' => 'Ingrese el teléfono del cooperador', 'name' => 'TELEFONO_COOPERADOR', 'label' => ['text' => 'Teléfono']]) ?>
    <?= form_input(['placeholder' => 'Ingrese el teléfono del cooperador', 'name' => 'CARGO', 'label' => ['text' => 'Cargo']]) ?>

    <!--Envíar-->
    <?= input_submit(['class' => 'col-lg-offset-9 col-lg-10']) ?>

    <?= call_spin_div() ?>

    <?= form_close() ?>

</div>
<?= $this->Footer() ?>

<script>

    $('form').jValidate();

    (new Spinner({
        lines: 10, width: 4,
        radius: 6, color: '#000', speed: 1, length: 15, top: '10%'
    })).spin(document.getElementById("spin"));

    function Save() {
        if ($('select[name=ID_AGENCIA] :selected').val() == 0)
            Message('Debe seleccionar una agencia');
        else {
            $.ajax({
                type: 'post', url: 'crearcooperador', data: $('form').serialize(),
                beforeSend: function () {
                    $('body').addClass('Wait');
                    $('body,html').animate({scrollTop: 0}, 200);
                    $('#spin').show();
                },
                success: function () {
                    $('body').removeClass('Wait');
                    Alerta('el cooperador se ha creado correctamente');
                    $('#spin').hide();
                }
            });
        }
    }
</script>
<?php
    /**
     * @var $this CI_Loader
     */
    $this->Header(['assets' => ['dialogs', 'spin', 'jvalidator']]);

?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <?= page_title(['ob' => $this, 'class' => 'ios ion-edit', 'text' => Uncamelize(__FILE__)]) ?>
</section>
<!-- Main content -->
<div class="container">
    <?= form_open('', ['class' => 'form-horizontal col-md-6', 'style' => 'margin-left: 20%'], ['ID_COOPERADOR' => $Info->ID_COOPERADOR]) ?>
    <hr style="border: 1px solid #3D8EBC;"/>
    <?= form_input(['placeholder' => 'Ingrese el nombre completo del cooperador', 'name' => 'NOMBRE_COOPERADOR', 'class' => 'obligatorio', 'label' => ['text' => 'Nombre']], $Info->NOMBRE_COOPERADOR) ?>
    <?= select_input(['select' => Dropdown(['name' => 'ID_AGENCIA', 'index' => $Info->ID_AGENCIA, 'dataProvider' => $this->agencias_model->TraeAgenciasDD(),
        'placeholder' => '-- Seleccione una agencia--', 'fields' => ['NOMBRE_AGENCIA']]), 'text' => 'Agencia']) ?>

    <?= form_input(['placeholder' => 'Ingrese el correo electrónico del cooperador', 'name' => 'CORREO_COOPERADOR', 'class' => 'correo', 'label' => ['text' => 'Correo']], $Info->CORREO_COOPERADOR) ?>
    <?= form_input(['placeholder' => 'Ingrese la dirección del cooperador', 'name' => 'DIRECCION_COOPERADOR', 'class' => 'obligatorio', 'label' => ['text' => 'Dirección']], $Info->DIRECCION_COOPERADOR) ?>
    <?= form_input(['placeholder' => 'Ingrese el teléfono del cooperador', 'name' => 'TELEFONO_COOPERADOR', 'class' => 'numero telefono', 'label' => ['text' => 'Teléfono']], $Info->TELEFONO_COOPERADOR) ?>
    <?= form_input(['placeholder' => 'Ingrese el cargo del cooperador', 'name' => 'CARGO', 'class' => 'obligatorio', 'label' => ['text' => 'Cargo']], $Info->CARGO) ?>
    <?= br() ?>

    <!--Envíar-->
    <?= input_submit(['class' => 'col-lg-offset-5 col-lg-10', 'text' => 'Actualizar']) ?>
    <?= br() ?>

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
                type: 'post', url: 'actualizarcooperador', data: $('form').serialize(),
                beforeSend: function () {
                    $('body').addClass('Wait');
                    $('body,html').animate({scrollTop: 0}, 200);
                    $('#spin').show();
                },
                success: function () {
                    $('body').removeClass('Wait');
                    Alerta('El cooperador se ha actualizado correctamente', function () {
                        location.href = '';
                    });
                    $('#spin').hide();
                }
            });
        }
    }
</script>
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
    <?= form_input(['placeholder' => 'Ingrese el nombre del practicante', 'name' => 'NOMBRE_PRACTICANTE', 'class' => 'obligatorio', 'label' => ['text' => 'Nombre']]) ?>
    <?= form_input(['placeholder' => 'Ingrese el número del documento', 'name' => 'DOCUMENTO', 'class' => 'obligatorio numero documento', 'label' => ['text' => 'Documento']]) ?>
    <?= form_input(['placeholder' => 'Ingrese el correo electrónico', 'name' => 'CORREO_PRACTICANTE', 'class' => 'obligatorio correo correo_unico', 'label' => ['text' => 'Correo']]) ?>
    <?= form_input(['placeholder' => 'Ingrese el código del estudiante', 'name' => 'CODIGO', 'class' => 'obligatorio', 'label' => ['text' => 'Código']]) ?>
    <?= form_input(['placeholder' => 'Ingrese el número telefónico', 'name' => 'TELEFONO', 'class' => 'obligatorio numero telefono', 'label' => ['text' => 'Teléfono']]) ?>
    <?= form_dropdown('ID_PROGRAMA', [1 => 'Ingeniería de sistemas', 2 => 'Ingeniería de software', 'Electromedicina'], ['label' => ['text' => 'Programa']]) ?>
    <?= form_dropdown('ID_MODALIDAD_PRACTICA', [1 => 'Validación experiencia profesional', 2 => 'Práctica empresarial'], ['label' => ['text' => 'Modalidad']]) ?>
    <?= select_input(['select' => $Asesores, 'text' => 'Asesor']) ?>
    <?= select_input(['select' => $Proyectos, 'text' => 'Proyecto']) ?>
    <?= select_input(['select' => $Agencias, 'text' => 'Agencia']) ?>
    <div id="flag">
        <?= select_input(['select' => $Cooperadores, 'text' => 'Cooperador']) ?>
    </div>
    <!--Envíar-->
    <br>
    <?= input_submit(['class' => 'col-lg-offset-5 col-lg-10']) ?>
    <?= call_spin_div() ?>
    <?= br(5) ?>
    <?= form_close() ?>
</div>

<?= $this->Footer() ?>
<script>

    $('form').jValidate({persona: 'Practicante', url: '<?=site_url('Validaciones/ValidaCampos')?>'});

    (new Spinner({
        lines: 10, width: 4,
        radius: 6, color: '#000', speed: 1, length: 15, top: '10%'
    })).spin(document.getElementById("spin"));

    function Save() {
        if ($('select[name=ID_ASESOR] :selected').val() == 0)
            Message('Debe seleccionar un asesor');

        else if ($('select[name=ID_PROYECTO] :selected').val() == 0)
            Message('Debe seleccionar un proyecto');

        else if ($('select[name=ID_AGENCIA] :selected').val() == 0)
            Message('Debe seleccionar una agencia');

        else if ($('select[name=ID_COOPERADOR] :selected').val() == 0)
            Message('Debe seleccionar un cooperador');

        else {
            $.ajax({
                type: 'post', url: 'crearpracticante', data: $('form').serialize(),
                beforeSend: function () {
                    $('body').addClass('Wait');
                    $('body,html').animate({scrollTop: 0}, 200);
                    $('#spin').show();
                },
                success: function () {
                    $('body').removeClass('Wait');
                    Alerta('El practicante se ha creado correctamente');
                    $('#spin').hide();
                }
            });
        }
    }
</script>
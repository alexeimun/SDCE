<?php
    /**
     * @var $this CI_Loader
     */
    $this->Header(['assets' => ['dialogs', 'spin', 'jvalidator']]);

?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <?= page_title(['ob' => $this, 'class' => 'ios ion-person', 'text' => Uncamelize(__FILE__)]) ?>
</section>
<!-- Main content -->
<div class="container">
    <?= form_open('', ['class' => 'form-horizontal col-md-6', 'style' => 'margin-left: 20%']) ?>
    <hr style="border: 1px solid #3D8EBC;"/>
    <?= form_input(['placeholder' => 'Ingrese el nombre del asesor', 'name' => 'NOMBRE', 'class' => 'obligatorio', 'label' => ['text' => 'Nombre']]) ?>
    <?= form_input(['placeholder' => 'Ingrese el número del documento del asesor', 'name' => 'DOCUMENTO', 'class' => 'obligatorio numero documento', 'label' => ['text' => 'Documento']]) ?>
    <?= form_input(['placeholder' => 'Ingrese el correo electrónico del asesor', 'name' => 'CORREO', 'class' => 'obligatorio correo correo_unico', 'label' => ['text' => 'Correo']]) ?>
    <?= form_input(['placeholder' => 'Ingrese el número telefónico del asesor', 'name' => 'TELEFONO', 'class' => 'obligatorio numero telefono', 'label' => ['text' => 'Teléfono']]) ?>
    <?= form_input(['placeholder' => 'Ingrese el número celular del asesor', 'name' => 'CELULAR', 'class' => 'numero telefono', 'label' => ['text' => 'Celular']]) ?>
    <!--Envíar-->
    <?= input_submit(['class' => 'col-lg-offset-9 col-lg-10']) ?>
    <?= call_spin_div() ?>
    <?= form_close() ?>
</div>
<?= $this->Footer() ?>

<script>

    $('form').jValidate({persona: 'Asesor', url: '<?=site_url('Validaciones/ValidaCampos')?>'});

    (new Spinner({
        lines: 10, width: 4,
        radius: 6, color: '#000', speed: 1, length: 15, top: '10%'
    })).spin(document.getElementById("spin"));

    function Save() {
        $.ajax({
            type: 'post', url: '<?=site_url('usuario/crearasesor')?>', data: $('form').serialize(),
            beforeSend: function () {
                $('body').addClass('Wait');
                $('body,html').animate({scrollTop: 0}, 200);
                $('#spin').show();
            },
            success: function () {
                $('body').removeClass('Wait');
                Alerta('El asesor se ha creado correctamente');
                $('#spin').hide();
            }
        });
    }
</script>
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
    <?= form_open('', ['class' => 'form-horizontal col-md-6', 'style' => 'margin-left: 20%'], ['ID_AGENCIA' => $Info->ID_AGENCIA]) ?>
    <hr style="border: 1px solid #3D8EBC;"/>
    <?= form_input(['placeholder' => 'Ingrese el nombre de la agencia', 'name' => 'NOMBRE_AGENCIA', 'class' => 'obligatorio', 'label' => ['text' => 'Nombre']], $Info->NOMBRE_AGENCIA) ?>
    <?= form_input(['placeholder' => 'Ingrese el correo electrónico de la agencia', 'name' => 'CORREO_AGENCIA', 'class' => 'correo', 'label' => ['text' => 'Correo']], $Info->CORREO_AGENCIA) ?>
    <?= select_input(['select' => $Ciudades, 'text' => 'Ciudad']) ?>
    <?= form_input(['placeholder' => 'Ingrese la dirección de la agencia', 'name' => 'DIRECCION', 'class' => 'obligatorio', 'label' => ['text' => 'Dirección']], $Info->DIRECCION) ?>
    <?= form_input(['placeholder' => 'Ingrese el teléfono de la agencia', 'name' => 'TELEFONO1', 'class' => 'obligatorio numero telefono', 'label' => ['text' => 'Teléfono#1']], $Info->TELEFONO1) ?>
    <?= form_input(['placeholder' => 'Ingrese un segundo teléfono de la agencia (opcional)', 'name' => 'TELEFONO2', 'class' => 'numero telefono', 'label' => ['text' => 'Teléfono#2']], $Info->TELEFONO2) ?>
    <?= form_input(['placeholder' => 'Ingrese el fax de la agencia', 'name' => 'FAX', 'class' => '', 'label' => ['text' => 'Fax']], $Info->FAX) ?>
    <?= form_input(['placeholder' => 'Ingrese la página web de la agencia', 'name' => 'PAGINA_WEB', 'class' => '', 'label' => ['text' => 'Página']], $Info->PAGINA_WEB) ?>

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
        $.ajax({
            type: 'post', url: 'actualizaragencia', data: $('form').serialize(),
            beforeSend: function () {
                $('body').addClass('Wait');
                $('body,html').animate({scrollTop: 0}, 200);
                $('#spin').show();
            },
            success: function () {
                $('body').removeClass('Wait');
                Alerta('La agencia se ha actualizado correctamente', function () {
                    location.href = '';
                });
                $('#spin').hide();
            }
        });
    }
</script>
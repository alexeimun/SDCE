<?php
    /**
     * @var $this CI_Loader
     */
    $this->Header(['assets' => ['dialogs', 'spin', 'jvalidator']]);

?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <?= page_title(['ob' => $this, 'class' => 'fa fa-edit', 'text' => Uncamelize(__FILE__)]) ?>
</section>
<!-- Main content -->
<div class="container">
    <?= form_open('', ['class' => 'form-horizontal col-md-6', 'style' => 'margin-left: 20%'], ['ID_USUARIO' => $Info->ID_USUARIO]) ?>
    <small style="margin-left: 20%;">Último cambio realizado <?= Momento($Info->FECHA_MODIFICA) ?> por
        <a href="<?= site_url("usuarios/verusuario/" . $Info->ID) ?>" target="_blank"
           class="btn-link"> <?= $Info->NOMBRE_USUARIO_MODIFICA ?> </a></small>

    <hr style="border: 1px solid #3D8EBC;"/>
    <?= form_input(['placeholder' => 'Ingrese el nombre completo del asesor', 'name' => 'NOMBRE', 'class' => 'obligatorio', 'label' => ['text' => 'Nombre']], $Info->NOMBRE) ?>
    <?= form_input(['placeholder' => 'Ingrese el número del documento del asesor', 'name' => 'DOCUMENTO', 'class' => 'obligatorio numero documento', 'label' => ['text' => 'Documento']], $Info->DOCUMENTO) ?>
    <?= form_input(['placeholder' => 'Ingrese el correo electrónico del asesor', 'name' => 'CORREO', 'class' => 'obligatorio correo correo_unico', 'label' => ['text' => 'Correo']], $Info->CORREO) ?>
    <?= form_input(['placeholder' => 'Ingrese el número telefónico del asesor', 'name' => 'TELEFONO', 'class' => 'obligatorio numero telefono', 'label' => ['text' => 'Telefono']], $Info->TELEFONO) ?>
    <?= form_input(['placeholder' => 'Ingrese el número celular del asesor', 'name' => 'CELULAR', 'class' => 'numero telefono', 'label' => ['text' => 'Celular']], $Info->CELULAR) ?>
    <?= br() ?>
    <!--Envíar-->
    <?= input_submit(['class' => 'col-lg-offset-5 col-lg-10', 'text' => 'Actualizar']) ?>
    <?= br() ?>
    <?= call_spin_div() ?>
    <?= br(2) ?>
    <?= form_close() ?>
</div>
<?= $this->Footer() ?>

<script>

    $('form').jValidate({
        persona: 'Asesor', url: '<?=site_url('Validaciones/ValidaCampos')?>',
        docId: '<?= $Info->DOCUMENTO?>', emailUser: '<?= $Info->CORREO?>'
    });

    (new Spinner({
        lines: 10, width: 4,
        radius: 6, color: '#000', speed: 1, length: 15, top: '10%'
    })).spin(document.getElementById("spin"));

    function Save() {
        $.ajax({
            type: 'post', url: '<?=site_url('usuario/actualizarasesor')?>', data: $('form').serialize(),
            beforeSend: function () {
                $('body').addClass('Wait');
                $('body,html').animate({scrollTop: 0}, 200);
                $('#spin').show();
            },
            success: function () {
                $('body').removeClass('Wait');
                Alerta('El asesor se ha actualizado correctamente', function () {
                    location.href = '';
                });
                $('#spin').hide();
            }
        });
    }
</script>
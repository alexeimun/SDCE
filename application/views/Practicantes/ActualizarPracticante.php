<?php
    /**
     * @var $this CI_Loader
     */
    $this->Header(['assets' => ['dialogs', 'spin', 'jvalidator']]);

?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <?= page_title(['ob'=>$this,'class' => 'fa fa-edit', 'text' => Uncamelize(__FILE__)]) ?>
</section>
<!-- Main content -->
<div class="container">
    <?= form_open('', ['class' => 'form-horizontal col-md-6', 'style' => 'margin-left: 20%'], ['ID_USUARIO' => $Info->ID_PRACTICANTE]) ?>
    <small style="margin-left: 20%;">Último cambio realizado <?= Momento($Info->FECHA_MODIFICA) ?> por
        <a href="<?= site_url("usuarios/verusuario/" . $Info->ID) ?>" target="_blank"
           class="btn-link"> <?= $Info->NOMBRE_USUARIO_MODIFICA ?> </a></small>
    <hr style="border: 1px solid #3D8EBC;"/>
    <?= form_input(['placeholder' => 'Ingrese el nombre completo del practicante', 'name' => 'NOMBRE_PRACTICANTE', 'class' => 'obligatorio', 'label' => ['text' => 'Nombre']], $Info->NOMBRE_PRACTICANTE) ?>
    <?= form_input(['placeholder' => 'Ingrese el número del documento', 'name' => 'DOCUMENTO', 'class' => 'obligatorio numero documento', 'label' => ['text' => 'Documento']], $Info->DOCUMENTO) ?>
    <?= form_input(['placeholder' => 'Ingrese el correo electrónico', 'name' => 'CORREO_PRACTICANTE', 'class' => 'obligatorio correo correo_unico', 'label' => ['text' => 'Correo']], $Info->CORREO_PRACTICANTE) ?>
    <?= form_input(['placeholder' => 'Ingrese el número telefónico', 'name' => 'TELEFONO', 'class' => 'obligatorio numero telefono', 'label' => ['text' => 'Teléfono']], $Info->TELEFONO) ?>
    <?= form_input(['placeholder' => 'Ingrese el número de celular', 'name' => 'CELULAR', 'class' => 'numero telefono', 'label' => ['text' => 'Celular']],$Info->CELULAR) ?>
    <?= form_input(['placeholder' => 'Ingrese el código del estudiante', 'name' => 'CODIGO', 'class' => 'obligatorio', 'label' => ['text' => 'Código']],$Info->CODIGO) ?>
    <?= form_dropdown('ID_PROGRAMA', [1 => 'Ingeniería de sistemas', 2 => 'Ingeniería de software',3=>'Electromedicina',4=>'Robótica y automatización'], ['label' => ['text' => 'Programa']],['selected'=>$Info->ID_PROGRAMA]) ?>
    <?= form_dropdown('ID_MODALIDAD_PRACTICA', ['1' => 'Validación experiencia profesional', 2 => 'Práctica empresarial'], ['label' => ['text' => 'Modalidad']],['selected'=>$Info->ID_MODALIDAD_PRACTICA]) ?>
    <?= select_input(['select' => $Proyectos, 'text' => 'Proyecto']) ?>
    <?= select_input(['select' => $Agencias, 'text' => 'Agencia']) ?>
    <div id="flag"><?= select_input(['select' => $Cooperadores, 'text' => 'Cooperador']) ?></div>
    <!--Envíar-->
    <?= input_submit(['class' => 'col-lg-offset-5 col-lg-10', 'text' => 'Actualizar']) ?>

    <?= call_spin_div() ?>
    <?= br(3) ?>
    <?= form_close() ?>
</div>
<?= $this->Footer() ?>

<script>

    $('form').jValidate({
        persona: 'Practicante', url: '<?=site_url('Validaciones/ValidaCampos')?>',
        docId: '<?= $Info->DOCUMENTO?>', emailUser: '<?= $Info->CORREO_PRACTICANTE?>'
    });

    $('select[name=ID_AGENCIA]').on('change', function () {
        console.log($(this).val());
        if($(this).val()!=0)
            $.post('<?=site_url('practicantes/traeCooperadoresAgenciaAjax') ?>', {ID_AGENCIA: $(this).val()}, function (data) {
                $('#flag').html(data);
            });
        else $('#flag').html('');
    });

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
                type: 'post', url: 'actualizarpracticante', data: $('form').serialize(),
                beforeSend: function () {
                    $('body').addClass('Wait');
                    $('body,html').animate({scrollTop: 0}, 200);
                    $('#spin').show();
                },
                success: function () {
                    $('body').removeClass('Wait');
                    Alerta('El practicante se ha creado correctamente',function () {
                        location.href = '';
                    });
                    $('#spin').hide();
                }
            });
        }
    }
</script>
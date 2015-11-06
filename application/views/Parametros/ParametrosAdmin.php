<?php
    /**
     * @var $this CI_Loader
     */
    $this->Header(['assets' => ['dialogs', 'spin', 'jvalidator']]);
?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <?= page_title(['ob' => $this, 'class' => 'fa fa-sliders', 'text' => 'Parámetros']) ?>
</section>
<!-- Main content -->
<div class="container">
    <?= form_open('', ['class' => 'form-horizontal col-md-8', 'style' => 'margin-left: 15%']) ?>
    <small style="margin-left: 35%;">Último cambio realizado el <?= FechaFormal($Info->FECHA_REGISTRO) ?></small>
    <hr style="border: 1px solid #3D8EBC;"/>
    <!--Decanatura-->
    <?= form_dropdown('DECANATURA_TITULO', [0 => 'Ingeniera', 1 => 'Ingeniero'], ['input' => ['col' => 5], 'label' => ['text' => 'Referirse como', 'col' => 4]], ['selected' => $Info->DECANATURA_TITULO]) ?>
    <?= form_input(['placeholder' => 'Ingrese el nombre de la persona encargada', 'name' => 'DECANATURA', 'class' => 'obligatorio',
        'input' => ['col' => 8], 'label' => ['text' => 'Facultad de Ingeniería', 'col' => 4]], $Info->DECANATURA) ?>
    <hr style="border: 1px solid #3D8EBC;"/>
    <!--Admisiones-->
    <?= form_dropdown('ADMISIONES_TITULO', [0 => 'Doctora', 1 => 'Doctor'], ['input' => ['col' => 5], 'label' => ['text' => 'Referirse como', 'col' => 4]], ['selected' => $Info->ADMISIONES_TITULO]) ?>
    <?= form_input(['placeholder' => 'Ingrese el nombre de la persona encargada', 'name' => 'ADMISIONES', 'class' => 'obligatorio',
        'input' => ['col' => 8], 'label' => ['text' => 'Admisiones Registro y Control Académico', 'col' => 4]], $Info->ADMISIONES) ?>
    <!--Centro prácticas-->
    <?= form_dropdown('CP_TITULO', [0 => 'Doctora', 1 => 'Doctor'], ['input' => ['col' => 5], 'label' => ['text' => 'Referirse como', 'col' => 4]], ['selected' => $Info->CP_TITULO]) ?>
    <?= form_input(['placeholder' => 'Ingrese el nombre de la persona encargada', 'name' => 'CP', 'class' => 'obligatorio',
        'input' => ['col' => 8], 'label' => ['text' => 'Centro de Prácticas', 'col' => 4]], $Info->CP) ?>
    <!--CIAD-->
    <?= form_dropdown('CIAD_TITULO', [0 => 'Doctora', 1 => 'Doctor'], ['input' => ['col' => 5], 'label' => ['text' => 'Referirse como', 'col' => 4]], ['selected' => $Info->CIAD_TITULO]) ?>
    <?= form_input(['placeholder' => 'Ingrese el nombre de la persona encargada', 'name' => 'CIAD', 'class' => 'obligatorio',
        'input' => ['col' => 8], 'label' => ['text' => 'Centro de Información y Ayudas Didácticas', 'col' => 4]], $Info->CIAD) ?>

    <!--Envíar-->
    <?= br(1) ?>
    <?= input_submit(['class' => 'col-lg-offset-5 col-lg-10']) ?>
    <?= br(2) ?>

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
            type: 'post', url: '<?=site_url('parametros')?>', data: $('form').serialize(),
            beforeSend: function () {
                $('body').addClass('Wait');
                $('body,html').animate({scrollTop: 0}, 200);
                $('#spin').show();
            },
            success: function () {
                console.log();
                $('body').removeClass('Wait');
                Alerta('Parámetros establecidos correctamente!!', function () {
                    location.href = '';
                });
                $('#spin').hide();
            }
        });
    }
</script>
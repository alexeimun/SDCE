<?php
    /**
     * @var $this CI_Loader
     */
    $this->Header(['assets' => ['dialogs', 'spin', 'jvalidator', 'datetimepicker']]);

?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <?= page_title(['ob' => $this, 'class' => 'ios ion-clock', 'text' => 'Horario Asesorías']) ?>
</section>
<!-- Main content -->
<div class="container">
    <?= form_open('', ['class' => 'form-horizontal col-md-6', 'style' => 'margin-left: 20%']) ?>
    <hr style="border: 1px solid #099a5b;"/>
    <?= select_input(['text' => 'Proyecto', 'select' => Dropdown(['name' => 'ID_PROYECTO', 'dataProvider' => $this->proyectos_model->TraeAsesorProyectosDD(),
        'placeholder' => '-- Seleccione un proyecto --', 'fields' => ['NOMBRE_PROYECTO']])]) ?>
    <div class="horario"></div>
    <!--Envíar-->
    <?= br(1) ?>
    <?= input_submit(['class' => 'col-lg-offset-4 col-lg-10']) ?>

    <?= call_spin_div() ?>

    <?= form_close() ?>

</div>
<?= $this->Footer() ?>

<script>

    $('form').jValidate();

    $('select[name=ID_PROYECTO]').on('change', function () {
        if ($('select[name=ID_PROYECTO] :selected').val() != 0)
            $('.horario').load('<?=site_url('proyectos/TraeHorarioAjax')?>', {ID_PROYECTO: $(this).val()}, function () {
                $('input[name=HORARIO]').datetimepicker({format: 'Y/m/d h:i a'});
            });
        else $('.horario').html('');
    });

    (new Spinner({
        lines: 10, width: 4,
        radius: 6, color: '#000', speed: 1, length: 15, top: '10%'
    })).spin(document.getElementById("spin"));

    function Save() {
        if ($('select[name=ID_PROYECTO] :selected').val() == 0)
            Message('Debe seleccionar un tipo de proyecto');
        else {
            $.ajax({
                type: 'post', url: '<?=site_url('proyectos/horarios') ?>', data: $('form').serialize(),
                beforeSend: function () {
                    $('body').addClass('Wait');
                    $('body,html').animate({scrollTop: 0}, 200);
                    $('#spin').show();
                },
                success: function () {
                    $('body').removeClass('Wait');
                    Alerta('El proyecto se ha actualizado correctamente');
                    $('#spin').hide();
                }
            });
        }
    }
</script>
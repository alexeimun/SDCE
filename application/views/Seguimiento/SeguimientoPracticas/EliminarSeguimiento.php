<?php
    /**
     * @var $this CI_Loader
     */
    $this->Header(['assets' => ['dialogs', 'spin', 'jvalidator']]);

?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <?= page_title(['ob' => $this, 'class' => 'ion-ios-trash', 'text' => 'Eliminar Calificación']) ?>
</section>
<!-- Main content -->
<div class="container">
    <?= form_open(site_url('seguimiento/seguimientos'), ['target' => '_blank', 'class' => 'form-horizontal col-md-8', 'style' => 'margin-left: 15%']) ?>
    <hr style="border: 1px solid #099a5b;"/>
    <?= select_input(['text' => 'Proyecto', 'collabel' => 3, 'colinput' => 5, 'select' => Dropdown(['name' => 'ID_PROYECTO', 'dataProvider' => $this->proyectos_model->TraeAsesorProyectosDD(),
        'placeholder' => '-- Seleccione un proyecto --', 'fields' => ['NOMBRE_PROYECTO']])]) ?>
    <div class="practicantes"></div>
    <div class="momento"></div>
    <?= br(1) ?>
    <!--Envíar-->
    <?= input_submit(['class' => 'col-lg-offset-4 col-lg-10', 'icon' => 'trash', 'text' => 'Eliminar', 'btn' => 'danger']) ?>

    <?= call_spin_div() ?>

    <?= form_close() ?>
</div>
<?= $this->Footer() ?>

<script>

    $('form').jValidate();

    $('select[name=ID_PROYECTO]').on('change', function () {
        if ($('select[name=ID_PROYECTO] :selected').val() != 0)
            $('.practicantes').load('<?=site_url('seguimiento/traepracticantesDDAjax')?>', {ID_PROYECTO: $(this).val()});
        else $('.practicantes').html('');
    });

    $('body').on('change', 'select[name=ID_PRACTICANTE]', function () {
        if ($('select[name=ID_PRACTICANTE] :selected').val() != 0)
            $('.momento').load('<?=site_url('seguimiento/traeMomentoPracticanteDDAjax')?>', {ID_PRACTICANTE: $(this).val()});
        else $('.momento').html('');
    });

    (new Spinner({
        lines: 10, width: 4,
        radius: 6, color: '#000', speed: 1, length: 15, top: '10%'
    })).spin(document.getElementById("spin"));

    function Save() {
        var practicante = $('select[name=ID_PRACTICANTE]');
        var momento = $('select[name=MOMENTO]');

        if ($('select[name=ID_PROYECTO]').val() == 0) {
            event.preventDefault();
            Message('Debe seleccionar un proyecto');
        }
        else if (practicante.length && practicante.val() == 0) {
            event.preventDefault();
            Message('Debe seleccionar un practicante');
        }
        else if (momento.length && momento.val() == 0) {
            event.preventDefault();
            Message('No se ha encontrado ningún momento');
        }
        else {
            console.log('s');
            $.ajax({
                type: 'post', url: 'eliminarcalificacion', data: $('form').serialize(),
                beforeSend: function () {
                    $('body').addClass('Wait');
                    $('body,html').animate({scrollTop: 0}, 200);
                    $('#spin').show();
                },
                success: function () {
                    $('body').removeClass('Wait');
                    Alerta('La calificación se ha eliminado correctamente');
                    $('#spin').hide();
                }
            });
        }
    }
</script>
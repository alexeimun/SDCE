<?php
    /**
     * @var $this CI_Loader
     */
    $this->Header(['assets' => ['dialogs', 'spin', 'jvalidator']]);
?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <?= page_title(['ob' => $this, 'class' => 'glyphicon glyphicon-pencil', 'text' => Uncamelize(__FILE__)]) ?>
</section>
<!-- Main content -->
<div class="container">
    <?= form_open('seguimiento/registronotas', ['class' => 'form-horizontal col-md-6', 'target' => '_blank', 'style' => 'margin-left: 20%']) ?>
    <hr style="border: 1px solid #099a5b;"/>
    <div class="form-group">
        <label for="inputID" class="col-lg-4 col-sm-4 control-label">Periodo:</label>

        <div class="col-lg-3 col-sm-3">
            <?= $Periodo ?>
        </div>
    </div>
    <?= form_dropdown('PROGRAMA', ['Ingeniería de sistemas' => 'Ingeniería de sistemas', 'Ingeniería de software' => 'Ingeniería de software',
        'Electromedicina' => 'Electromedicina', 'Robótica y automatización' => 'Robótica y automatización'], ['input' => ['col' => 6], 'label' => ['text' => 'Programa', 'col' => 4]]) ?>

    <br><br>
    <!--Envíar-->
    <?= input_submit(['class' => 'col-lg-offset-4 col-lg-10', 'type' => 'submit', 'icon' => 'print', 'text' => 'Imprimir']) ?>
    <?= br(2) ?>
</div>


<?= call_spin_div() ?>

<?= form_close() ?>

<?= $this->Footer() ?>

<script>

    (new Spinner({
        lines: 10, width: 4,
        radius: 6, color: '#000', speed: 1, length: 15, top: '10%'
    })).spin(document.getElementById("spin"));


    function Save() {
        $.ajax({
            type: 'post', url: '<?=site_url('seguimiento/crearregistronotas')?>', data: $('form').serialize(),
            beforeSend: function () {
                $('body').addClass('Wait');
                $('body,html').animate({scrollTop: 0}, 200);
                $('#spin').show();
            },
            success: function (data) {
                $('body').removeClass('Wait');
                Alerta('La lista de Informes de transporte se ha creado correctamente', function (dialogItself) {
                    dialogItself.close();
                    window.open('<?=site_url('seguimiento/imprimirregistronotas')?>/' + data);
                });
                $('#spin').hide();
            }
        });
    }
</script>
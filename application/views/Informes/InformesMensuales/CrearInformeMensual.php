<?php
    /**
     * @var $this CI_Loader
     */
    $this->Header(['assets' => ['dialogs', 'spin', 'jvalidator', 'datetimepicker']]);
?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <?= page_title(['ob' => $this, 'class' => 'ios ion-calendar', 'text' => Uncamelize(__FILE__)]) ?>
</section>
<!-- Main content -->
<div class="container">
    <?= form_open('', ['class' => 'form-horizontal col-md-6', 'style' => 'margin-left: 20%']) ?>
    <hr style="border: 1px solid #099a5b;"/>

    <?= select_input(['text' => 'Proyecto', 'select' => Dropdown(['name' => 'ID_PROYECTO[]', 'width' => '100%', 'dataProvider' => $this->proyectos_model->TraeAsesorProyectosDD(),
        'placeholder' => '-- Seleccione un proyecto --', 'fields' => ['NOMBRE_PROYECTO']])]) ?>

    <div class="form-group">
        <label for="inputID" class="col-lg-2 control-label">Mes:</label>
        <div class="col-lg-10">
            <?= $this->parametros_model->CrearMesComponente() ?>
        </div>
    </div>

    <div class="form-group">
        <div class="row">
            <label class="col-sm-9 control-label">Avances, logros y cumplimiento de objetivos:</label>
        </div>

        <div class="col-lg-12">
            <textarea name="AVANCES[]" style="height: 120px;margin-top:5px;"
                      class="form-control obligatorio" maxlength="600" title=""></textarea>
        </div>
    </div>


<div class="filas">
</div>
<div class="form-group">
    <div class="col-lg-offset-5 col-lg-10">
        <button id="add" type="button" class="btn btn-success btn-lg" data-toggle="tooltip"
                title="Agregar fila"><span
                class="glyphicon glyphicon-plus"></span>
        </button>
    </div>
</div>
<?= br(2) ?>
<!--Envíar-->
<?= input_submit(['class' => 'col-lg-offset-4 col-lg-10', 'type' => 'button']) ?>
<?= br(2) ?>
</div>


<?= call_spin_div() ?>

<?= form_close() ?>

<?= $this->Footer() ?>

<script>
    $('form').jValidate();

    (new Spinner({
        lines: 10, width: 4,
        radius: 6, color: '#000', speed: 1, length: 15, top: '10%'
    })).spin(document.getElementById("spin"));

    function ValidateProject() {
        var pass = true;
        $('.filas > div').each(function (index, ele) {
            var select = $(ele).find('.form-group select :selected');
            if (select.val() == 0) {
                $('body').animate({scrollTop: $(ele).offset().top}, 200);
                pass = false;
                return false;
            }
        });
        return pass;
    }

    function Save() {
        if (ValidateProject()) {
            $.ajax({
                type: 'post', url: '<?=site_url('informe/crearinformemensual')?>', data: $('form').serialize(),
                beforeSend: function () {
                    $('body').addClass('Wait');
                    $('body,html').animate({scrollTop: 0}, 200);
                    $('#spin').show();
                },
                success: function (data) {
                    $('body').removeClass('Wait');
                    Alerta('La lista de Informes de transporte se ha creado correctamente', function (dialogItself) {
                        dialogItself.close();
                        window.open('<?=site_url('informe/imprimirinformemensual')?>/' + data);
                    });
                    $('#spin').hide();
                }
            });
        }
    }
</script>
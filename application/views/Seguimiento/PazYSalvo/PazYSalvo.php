<?php
    /**
     * @var $this CI_Loader
     */
    $this->Header(['assets' => ['jvalidator', 'icheck']]);
?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <?= page_title(['ob' => $this, 'class' => 'fa fa-check', 'text' => 'Certificado ' . Uncamelize(__FILE__)]) ?>
</section>
<!-- Main content -->
<div class="container">
    <?= form_open('seguimiento/pazysalvo', ['class' => 'form-horizontal col-md-6', 'target' => '_blank', 'style' => 'margin-left: 20%']) ?>
    <hr style="border: 1px solid #099a5b;"/>
    <?= select_input(['text' => 'Proyecto', 'select' => Dropdown(['name' => 'ID_PROYECTO', 'dataProvider' => $this->proyectos_model->TraeAsesorProyectosDD(),
        'placeholder' => '-- Seleccione un proyecto --', 'fields' => ['NOMBRE_PROYECTO']])]) ?>
    <div class="box">
        <div class="box-header bg-gray">
            <h3 style="color:#7d7d80;text-align: center"><span class="fa fa-group"></span> Practicantes
            </h3>
        </div>
        <div class="box-body"></div>
    </div>
    <?= form_dropdown('PROGRAMA', ['Ingeniería de sistemas' => 'Ingeniería de sistemas', 'Ingeniería de software' => 'Ingeniería de software',
        'Electromedicina' => 'Electromedicina', 'Robótica y automatización' => 'Robótica y automatización'], ['input' => ['col' => 8], 'label' => ['text' => 'Programa', 'col' => 2]]) ?>
    <div class="form-group">
        <label class="col-lg-3 control-label">Inicio:</label>

        <div class="col-lg-5">
            <div class="input-group">
                <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                </div>
                <input type="date" class="form-control fecha" name="INICIO"
                       value="<?= $this->session->userdata('PERIODO') ?>"
                       required>
            </div>
        </div>
    </div>

    <div class="form-group">
        <label class="col-lg-3 control-label">Finalización:</label>

        <div class="col-lg-5">
            <div class="input-group">
                <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                </div>
                <input type="date" class="form-control fecha" name="FINALIZACION"
                       value="<?= (new DateTime($this->session->userdata('PERIODO')))->add(new DateInterval('P6M'))->format('Y-m-d')?>"
                       required>
            </div>
        </div>
    </div>

    <div class="form-group">
        <div class="row"><label class="col-sm-7 control-label">Concepto</label>
        </div>
        <div class="col-lg-12">
            <textarea name="CONCEPTO" style="height: 100px;margin-top:5px;" class="form-control obligatorio"
                      placeholder="Concepto del asesor frente al cumplimiento y entrega de todos los compromisos del estudiante en la práctica (máximo 600 caracteres)"
                      maxlength="600" title=""></textarea>
        </div>
    </div>
    <br>
    <br><br>
    <!--Envíar-->
    <?= input_submit(['class' => 'col-lg-offset-4 col-lg-10', 'type' => 'submit', 'icon' => 'print', 'text' => 'Imprimir']) ?>
    <?= br(2) ?>
</div>


<?= call_spin_div() ?>

<?= form_close() ?>

<?= $this->Footer() ?>

<script>
    $('form').jValidate();

    function SavePost() {
        if ($('input:checkbox:checked').length == 0) {
            Message('Debe seleccionar al menos un practicante...');
            event.preventDefault();
        }
        else {
            $('table tbody input:checkbox:checked').each(function (i, e) {
                $('form').append('<input  type="hidden" value="' + $(e).val() + '" name="ID_PRACTICANTE[]">');
            });
            $('select[name=ID_PROYECTO]').val(0);
            $('select[name=ID_PROYECTO]').trigger('change');
        }
    }

    $(function () {

        $('select[name=ID_PROYECTO]').on('change', function () {
            if ($('select[name=ID_PROYECTO] :selected').val() != 0) {
                $('input:hidden').remove();
                $('.box-body').load('<?=site_url('seguimiento/tableAjax')?>', {ID_PROYECTO: $('select[name=ID_PROYECTO] :selected').val()}, function () {
                    $('input:checkbox').iCheck({
                        checkboxClass: 'iradio_square-green',
                        radioClass: 'iradio_flat-green',
                        increaseArea: '90%' // optional
                    });
                });
            }
            else {
                $('.box-body').html('');
            }
        });
    });

</script>

<style>
    td
    {
        padding: 5px;
        text-align: left;
    }

    td.option
    {
        cursor: pointer;
    }

    .b
    {
        font-weight: bold;
        color: black;
    }
</style>
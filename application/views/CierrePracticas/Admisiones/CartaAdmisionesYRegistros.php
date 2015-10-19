<?php
    /**
     * @var $this CI_Loader
     */
    $this->Header(['assets' => ['dialogs', 'jvalidator']]);
    $sem = explode('-', $this->session->userdata('PERIODO'))[2] == 2 ? 'primer' : 'segundo';
?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <?= page_title(['ob' => $this, 'class' => 'glyphicon glyphicon-pencil', 'text' => Uncamelize(__FILE__)]) ?>
</section>
<!-- Main content -->
<div class="container">
    <?= form_open('cierres/cartaadmisiones', ['class' => 'form-horizontal col-md-6', 'target' => '_blank', 'style' => 'margin-left: 20%']) ?>
    <hr style="border: 1px solid #099a5b;"/>
    <?= form_input(['style' => 'text-align:center', 'placeholder' => 'Ingrese el consecutivo', 'name' => 'CONSECUTIVO', 'class' => 'obligatorio', 'input' => ['col' => 5], 'label' => ['text' => 'Consecutivo', 'col' => 4]]) ?>
    <div class="form-group">
        <div class="row"><label class="col-sm-6 control-label">Asunto</label>
        </div>
        <div class="col-lg-12">
            <textarea name="ASUNTO" style="height: 80px;margin-top:5px;" class="form-control obligatorio"
                      placeholder="Ingrese aquí el asunto de la carta (máximo 300 caracteres)"
                      maxlength="300" title="">Entrega Registros de Evaluación y Paz y Salvo de Proyectos de Práctica Programa de Ingeniería de Sistemas - <?= ($sem == 'primer' ? 'I' : 'II') . '-' . date('Y') ?>.</textarea>
        </div>
    </div>

    <div class="form-group">
        <div class="row"><label class="col-sm-7 control-label">Contenido</label>
        </div>
        <div class="col-lg-12">
            <textarea name="CARTA" style="height: 220px;margin-top:5px;" class="form-control obligatorio"
                      placeholder="Ingrese aquí el contenido de la carta (máximo 600 caracteres)"
                      maxlength="800" title="">Le estoy haciendo entrega de los Registros correspondientes a la evaluación del primero y segundo momento y nota definitiva, paz y salvo del Asesor y paz y salvo de de la Agencia, de los Proyectos de Práctica desarrollados durante el <?= $sem ?> semestre de <?= date('Y') ?> de los Estudiantes del Programa de Ingeniería de Sistemas.

Se anexa el listado de estudiantes para los cuales se está haciendo entrega de los registros en referencia.</textarea>
        </div>
    </div>


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
    }
</script>
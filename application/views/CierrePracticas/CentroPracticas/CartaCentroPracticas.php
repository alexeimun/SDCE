<?php
    /**
     * @var $this CI_Loader
     */
    $this->Header(['assets' => ['dialogs', 'jvalidator']]);
    $sem = explode('-', $this->session->userdata('PERIODO'))[2] == 2 ? 'primer' : 'segundo';
?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <?= page_title(['ob' => $this, 'class' => 'fa fa-pencil', 'text' => 'Carta Centro Prácticas']) ?>
</section>
<!-- Main content -->
<div class="container">
    <?= form_open('cierres/cartacentropracticas', ['class' => 'form-horizontal col-md-6', 'target' => '_blank', 'style' => 'margin-left: 20%']) ?>
    <hr style="border: 1px solid #099a5b;"/>
    <?= form_input(['style' => 'text-align:center', 'placeholder' => 'Ingrese el consecutivo', 'name' => 'CONSECUTIVO', 'class' => 'obligatorio', 'input' => ['col' => 5], 'label' => ['text' => 'Consecutivo', 'col' => 4]]) ?>
    <div class="form-group">
        <div class="row"><label class="col-sm-6 control-label">Asunto</label>
        </div>
        <div class="col-lg-12">
            <textarea name="ASUNTO" style="height: 80px;margin-top:5px;" class="form-control obligatorio" placeholder="Ingrese aquí el asunto de la carta (máximo 300 caracteres)"
                      maxlength="300" title="">Entrega Informe de Cierre de Práctica del Programa de Ingeniería de Sistemas - <?=($sem=='primer'?'I':'II').'-'.date('Y') ?>.</textarea>
        </div>
    </div>

    <div class="form-group">
        <div class="row"><label class="col-sm-7 control-label">Contenido</label>
        </div>
        <div class="col-lg-12">
            <textarea name="CARTA" style="height: 280px;margin-top:5px;" class="form-control obligatorio" placeholder="Ingrese aquí el contenido de la carta (máximo 800 caracteres)"
                      maxlength="800">Le estoy haciendo entrega del Informe de cierre de Práctica correspondiente al <?= $sem ?> semestre de <?= date('Y') ?> de los Estudiantes del Programa de Ingeniería de Sistemas.

Para su información, igualmente se ha hecho entrega por parte de la Decanatura de la Facultad de Ingeniería:


1.	A la Dirección de  Admisiones Registro y Control Académico, de lo Registros correspondientes a la evaluación del primero y segundo momento y nota definitiva, paz y salvo del Asesor y paz y salvo de de la Agencia, de los Proyectos de Práctica desarrollados durante el <?= $sem ?> semestre de <?= date('Y') ?> de los Estudiantes del Programa de Ingeniería de Sistemas.

2.	A la Dirección del Centro de Información y Ayudas Didácticas, de los CD que contienen el Informe Final correspondiente a los Proyectos de Práctica desarrollados durante el <?= $sem ?> semestre de <?= date('Y') ?> de los Estudiantes del Programa de Ingeniería de Sistemas.
</textarea>
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

    function SavePost() {}
</script>
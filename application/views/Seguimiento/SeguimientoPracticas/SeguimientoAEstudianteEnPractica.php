<?php
    /**
     * @var $this CI_Loader
     */
    $this->Header(['assets' => ['dialogs', 'spin', 'jvalidator', 'icheck', 'tagsinput']], 'guess');
    $r = 0;

?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <?= page_title(['ob'=>$this,'class' => 'ios ion-person', 'text' => Uncamelize(__FILE__)]) ?>
</section>
<!-- Main content -->
<div class="container">
    <?= form_open('', ['class' => 'form-horizontal col-md-8', 'style' => 'margin-left: 15%']) ?>
    <hr style="border: 1px solid #099a5b;"/>

    <div style="padding-left:20%">

        <?= Question(['question' => '¿Recibió inducción acerca de la empresa?', 'name' => ++$r,
            'options' => ['Si', 'No']]) ?>
        <?= Question(['question' => '¿Recibió inducción del cargo o proyecto?', 'name' => ++$r,
            'options' => ['Si', 'No']]) ?></div>
    <br>
    <hr style="border: 1px solid #06674e;"/>


    <div class="">
        <p class="font1">Funciones (del cargo) o actividades a realizar:</p>

        <div class="form-group">
            <label class="col-lg-2 control-label" style="font-size: 17pt">&bull;</label>

            <div class="col-lg-10">
                <input type="text" name="FUNCION1" class="form-control obligatorio"
                       placeholder="Ingrese una función o actividad a realizar">
            </div>
        </div>
        <div class="form-group">
            <label class="col-lg-2 control-label" style="font-size: 17pt">&bull;</label>

            <div class="col-lg-10">
                <input type="text" name="FUNCION2" class="form-control obligatorio"
                       placeholder="Ingrese una función o actividad a realizar">
            </div>
        </div>
        <div class="form-group">
            <label class="col-lg-2 control-label" style="font-size: 17pt">&bull;</label>

            <div class="col-lg-10">
                <input type="text" name="FUNCION3" class="form-control"
                       placeholder="Ingrese una función o actividad a realizar">
            </div>
        </div>
        <div class="form-group">
            <label class="col-lg-2 control-label" style="font-size: 17pt">&bull;</label>

            <div class="col-lg-10">
                <input type="text" name="FUNCION4" class="form-control"
                       placeholder="Ingrese una función o actividad a realizar">
            </div>
        </div>
    </div>
    <br>

    <p class="font1">1. FUNCIÓN DIAGNÓSTICA</p>

    <p class="font2">Autoevaluación en fortalezas y debilidades, establecimiento metas y estrategias de acuerdo a la
        modalidad de práctica y al área específica.</p>

    <p class="font2"><b>Aspectos a analizar:</b></p>
    <div class="">
        <div class="form-group">

            <div class="col-lg-12">
                <textarea  name="FD" class="form-control obligatorio"
                       placeholder="Ingrese una respuesta"></textarea>
            </div>
        </div>
    </div>

    <?= br(2) ?>
    <p class="font1">1.1 Fundamentación Teórico-Práctico</p><br>
    <?= Question(['question' => '¿En qué grado considera usted que posee los elementos teóricos suficientes para la ejecución de las funciones o actividades de la práctica seleccionada?', 'num' => '1.1.1', 'name' => ++$r,
        'options' => ['Alta', 'Mediano', 'Bajo']]) ?>

    <div class="">
        <p class="font1">1.1.2 ¿Qué elementos conceptuales considera Usted que debería fortalecer o incorporar para
            cumplir exitosamente las funciones o actividades propuestas?</p>

        <div class="form-group">
            <label class="col-lg-1 control-label" style="font-size: 17pt"></label>

            <div class="col-lg-11">
                <input type="text" name="RESP1" class="form-control obligatorio"
                       placeholder="Ingrese su respuesta aquí">
            </div>
        </div>
    </div>

    <?= Question(['question' => '¿Ha tenido experiencia previa en las funciones o actividades establecidas?', 'num' => '1.1.3', 'name' => ++$r, 'options' => ['Sí', 'No']]) ?>

    <?= br(2) ?>
    <p class="font1">1.2 Motivación e interés frente a la práctica.</p><br>
    <?= Question(['question' => '¿Considera que las funciones o actividades a realizar en la práctica influyen positivamente en su formación profesional?', 'num' => '1.2.1', 'name' => ++$r,
        'options' => ['Sí', 'No']]) ?>

    <?= Question(['question' => '¿Cuál es el aspecto más relevante para la selección  de su práctica?', 'num' => '1.2.1', 'name' => ++$r, 'opcional' => true,
        'options' => ['Agencia', 'Funciones', 'Oportunidad de Vinculación', 'Reto', 'Remuneración']]) ?>
    <div class="">
        <div class="form-group">
            <label class="col-lg-2 control-label">¿Otra? Cual</label>

            <div class="col-lg-10">
                <input type="text" name="R121" class="form-control"
                       placeholder="Ingrese otro aspecto personalizado">
            </div>
        </div>
    </div>

    <?= Question(['question' => ' Respecto a su formación profesional, la experiencia de la práctica considera que es', 'num' => '1.2.3', 'name' => ++$r,
        'options' => ['Poco Pertinente', 'Pertinente', 'Muy Pertinente']]) ?>

    <div class="">
        <div class="form-group">
            <label class="col-lg-2 control-label">¿Porqué?</label>

            <div class="col-lg-10">
                <input type="text" name="RESP2" class="form-control obligatorio"
                       placeholder="Ingrese una justificación a su respuesta">
            </div>
        </div>
    </div>

    <?= Question(['question' => 'Respecto a su formación personal, la experiencia de la práctica considera que es:', 'num' => '1.2.4', 'name' => ++$r,
        'options' => ['Poco Beneficiosa', 'Beneficiosa', 'Muy Beneficiosa']]) ?>

    <div class="">
        <div class="form-group">
            <label class="col-lg-2 control-label">¿Porqué?</label>

            <div class="col-lg-10">
                <input type="text" name="RESP3" class="form-control obligatorio"
                       placeholder="Ingrese una justificación a su respuesta">
            </div>
        </div>
    </div>

    <?= br(2) ?>
    <p class="font1">1.3 Habilidades y competencias frente a la área de desempeño.</p>
    <br>
    <?= Question(['question' => 'En qué grado conoce Usted las competencias requeridas para las funciones o actividades a realizar', 'num' => '1.3.1', 'name' => ++$r,
        'options' => ['Alto grado', 'Mediano grado', 'Bajo grado']]) ?>

    <?= Question(['question' => 'Cuál de las siguientes competencias considera Usted que tiene en mayor grado, para el desarrollo de las actividades o funciones establecidas', 'num' => '1.3.2', 'name' => ++$r,
        'options' => ['Interpretativa', 'Argumentativa', 'Propositiva']]) ?>

    <?= br(2) ?>
    <p class="font1">DEBILIDADES Y/O FORTALEZAS</p>
    <?= form_input(['placeholder' => 'Ingrese las debilidades y/o fortalezas, luego presione la tecla enter', 'name' => 'DEBFOR', 'class' => 'debfor obligatorio',
        'input' => ['col' => '12'], 'label' => ['col' => 0]], 'Responsabilidad') ?>

    <?= br(2) ?>
    <p class="font1">METAS Y ESTRATEGIAS</p>
    <?= form_input(['placeholder' => 'Ingrese las metas y estrategias, luego presione la tecla enter', 'name' => 'METEST', 'class' => 'metest obligatorio',
        'input' => ['col' => '12'], 'label' => ['col' => 0]], 'Trabajar en equipo') ?>

    <br>
    <!--Envíar-->
    <?= input_submit(['class' => 'col-lg-offset-5 col-lg-10', 'text' => 'Envíar formulario']) ?>

    <?= call_spin_div() ?>
    <?= br(5) ?>

    <?= form_close() ?>
</div>
<?= $this->Footer() ?>

<script>

    $('form').jValidate();


    $(function () {

        $('.debfor').tagsinput({
            tagClass: 'label label-success',
            freeInput: true,
            maxTags: 8,
            maxChars: 40,
            trimValue: true
        });
        $('.metest').tagsinput({
            tagClass: 'label label-primary',
            freeInput: true,
            maxTags: 8,
            maxChars: 40,
            trimValue: true
        });

        $('input:radio').iCheck({
            checkboxClass: 'iradio_square-green',
            radioClass: 'iradio_flat-green',
            increaseArea: '90%' // optional
        });
    });

    (new Spinner({
        lines: 10, width: 4,
        radius: 6, color: '#000', speed: 1, length: 15, top: '10%'
    })).spin(document.getElementById("spin"));

    function validateRadios() {
        Clear();
        var free = {pass: true, id: null};
        for (var i = 1; i <= <?=$r?>; i++) {
            var radio = $("form:first input:radio[name=R" + i + "]");

            if (!radio.is(':checked')) {
                if (radio.hasClass('opcional')) {
                    if ($('input:text[name=R121]').val().length == 0) {
                        free = {pass: false, id: 'st' + i}
                        break;
                    }
                }
                else {
                    free = {pass: false, id: 'st' + i}
                    break;
                }
            }
        }
        if (!free.pass) {
            $('body').animate({scrollTop: $('#' + free.id).offset().top}, function () {
                $('#' + free.id).closest('div').find('.font1').hide().css({'color': 'red'}).fadeIn(900);
            });
        }
        return free.pass;
    }
    function Save() {
        if (validateRadios()) {
            $.ajax({
                type: 'post', url: '<?=site_url('seguimiento/evaluarestudiante')?>',
                data: $('form').serialize(),
                beforeSend: function () {
                    $('body').addClass('Wait');
                    $('body,html').animate({scrollTop: 0}, 200);
                    $('#spin').show();
                },
                success: function (data) {
                    console.log(data);
                    $('body').removeClass('Wait');
                    Alerta('El formulario se ha enviado al asesor <b><?=$this->session->userdata('ASESOR')?></b>', function (dialogItself) {
                        $('#send-ajax').parent().remove();
                        dialogItself.close();
                    });
                    $('#spin').hide();
                }
            });
        }
    }

    $('input:radio[name=R6]').on('ifChanged', function () {
        $('input:text[name=R121]').attr('readOnly', true);
    })

    function Clear() {
        $('form > div >div').each(function (index, element) {
            $(element).css({'color': '#06674e'});
        })
    }

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

    label
    {
        color: #06674e !important;
    }
</style>

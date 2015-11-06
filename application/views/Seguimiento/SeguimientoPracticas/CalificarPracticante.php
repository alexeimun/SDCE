<?php
    /**
     * @var $this CI_Loader
     */
    $this->Header(['assets' => ['dialogs', 'spin', 'jvalidator', 'icheck', 'ionslider']]);
    $r = 0;

?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <?= page_title(['ob' => $this, 'class' => 'fa fa-edit', 'text' => Uncamelize(__FILE__)]) ?>
</section>
<!-- Main content -->
<div class="container">
    <?= form_open('', ['class' => 'form-horizontal col-md-8', 'style' => 'margin-left: 15%']) ?>
    <hr style="border: 1px solid #099a5b;"/>
    <br>
    <?= Alert(['icon' => 'ion-ios-chatboxes', 'title' => 'Nota:', 'text' => 'Recuerde que sí no se califica como <b>Ambos</b>, el sistema esperará la calificación individual del <b>Asesor</b> y el <b>Cooperador</b>']) ?>

    <?= form_dropdown('PERSONA', ['A' => 'Asesor', 'C' => 'Cooperador', 'M' => 'Ambos'],
        ['input' => ['col' => '8'], 'label' => ['text' => 'Calificar como', 'col' => '3', 'title' => 'Puede evaluar como asesor, cooperador o como ambos']]) ?>

    <?= select_input(['text' => 'Proyecto', 'collabel' => 3, 'colinput' => 8, 'select' => Dropdown(['name' => 'ID_PROYECTO', 'dataProvider' => $this->proyectos_model->TraeAsesorProyectosCalificarDD(),
        'placeholder' => '-- Seleccione un proyecto --', 'fields' => ['NOMBRE_PROYECTO']])]) ?>
    <div class="practicantes"></div>
    <br>

    <p style="text-align: center;color: #06674e;font-size: 25px;">SABER SER (33%)</p>
    <hr style="border: 1px solid #06674e;"/>
    <br>

    <?= Question(['question' => 'Considera usted que la actitud del estudiante frente a sugerencias es: <span class="b">(Adaptabilidad)</span>',
        'num' => ++$r, 'name' => $r, 'slider' => true, 'options' => ['Excelente', 'Bueno', 'Aceptable', 'Deficiente']]) ?>

    <?= Question(['question' => 'La disposición del estudiante frente al trabajo en equipo es: <span class="b">(Colaboración)</span>',
        'num' => ++$r, 'name' => $r, 'slider' => true, 'options' => ['Excelente', 'Bueno', 'Aceptable', 'Deficiente']]) ?>

    <?= Question(['question' => 'Frente a las debilidades o dificultades presentadas durante la práctica, la participación activa del estudiante con soluciones o propuestas de mejoramiento es: <span class="b">(Creatividad)</span>',
        'num' => ++$r, 'name' => $r, 'slider' => true, 'options' => ['Excelente', 'Bueno', 'Aceptable', 'Deficiente']]) ?>

    <?= Question(['question' => 'El nivel de respeto que demuestra el estudiante por su entorno y compañeros de grupo, es: <span class="b">(Relaciones Interpersonales)</span>',
        'num' => ++$r, 'name' => $r, 'slider' => true, 'options' => ['Excelente', 'Bueno', 'Aceptable', 'Deficiente']]) ?>

    <?= Question(['question' => 'La responsabilidad del estudiante con respecto al cumplimiento del horario establecido es: <span class="b">(Responsabilidad)</span>',
        'num' => ++$r, 'name' => $r, 'slider' => true, 'options' => ['Excelente', 'Bueno', 'Aceptable', 'Deficiente']]) ?>

    <?= Question(['question' => 'La transparencia en las acciones o funciones realizadas por el estudiante, discreción y manejo adecuado de la información derivada de la práctica o el proyecto, demostrada por el estudiante es: <span class="b">(Ética)</span>',
        'num' => ++$r, 'name' => $r, 'slider' => true, 'options' => ['Excelente', 'Bueno', 'Aceptable', 'Deficiente']]) ?>

    <div class="form-group">
        <div class="row"><label class="col-sm-7 control-label">Observaciones:</label>
        </div>
        <div class="col-lg-12">
            <textarea name="OBS_SABERSER" style="height: 120px;margin-top:5px;"
                      placeholder="Ingrese la observación del saber ser (opcional)" class="form-control"
                      maxlength="255"></textarea>
        </div>
    </div>
    <p style="text-align: center;color: #06674e;font-size: 25px;">SABER HACER (34%)</p>
    <hr style="border: 1px solid #06674e;"/>
    <br>
    <?php $s = 0 ?>
    <?= Question(['question' => 'La capacidad del estudiante para realizar eficazmente las funciones o actividades asignadas es: <span class="b">(Cumplimiento)</span>',
        'num' => ++$s, 'name' => ++$r, 'slider' => true, 'options' => ['Excelente', 'Bueno', 'Aceptable', 'Deficiente']]) ?>

    <?= Question(['question' => 'La utilización y el manejo, por parte del estudiante, de los recursos proporcionados para el desarrollo de la práctica, es: <span class="b">(Manejo de Recursos)</span>',
        'num' => ++$s, 'name' => ++$r, 'slider' => true, 'options' => ['Excelente', 'Bueno', 'Aceptable', 'Deficiente']]) ?>

    <?= Question(['question' => 'La capacidad del estudiante para reconocer las debilidades y fortalezas frente al proyecto o cargo asignado y utilizarlas para el planteamiento de propuestas de mejoramiento es: <span class="b">(Detección de Oportunidades)</span>',
        'num' => ++$s, 'name' => ++$r, 'slider' => true, 'options' => ['Excelente', 'Bueno', 'Aceptable', 'Deficiente']]) ?>


    <?= Question(['question' => 'La capacidad del estudiante para determinar las metas y prioridades, estipular cursos de acción, los plazos y recursos para alcanzarlos es: <span class="b">(Planeación)</span>',
        'num' => ++$s, 'name' => ++$r, 'slider' => true, 'options' => ['Excelente', 'Bueno', 'Aceptable', 'Deficiente']]) ?>

    <?= Question(['question' => 'La presentación de los informes y/o avances de las funciones o actividades por parte del estudiante son: <span class="b">(Comunicación Oral y Escrita)</span>',
        'num' => ++$s, 'name' => ++$r, 'slider' => true, 'options' => ['Excelente', 'Bueno', 'Aceptable', 'Deficiente']]) ?>

    <?= Question(['question' => 'La orientación hacia la calidad y el mejoramiento continuo en la ejecución de las actividades o funciones, evidenciada por  el estudiante es: <span class="b">(Calidad del trabajo y desempeño laboral)</span>',
        'num' => ++$s, 'name' => ++$r, 'slider' => true, 'options' => ['Excelente', 'Bueno', 'Aceptable', 'Deficiente']]) ?>
    <div class="form-group">
        <div class="row"><label class="col-sm-7 control-label">Observaciones:</label>
        </div>
        <div class="col-lg-12">
            <textarea name="OBS_SABERHACER" style="height: 120px;margin-top:5px;"
                      placeholder="Ingrese la observación del saber hacer (opcional)" class="form-control"
                      maxlength="255"></textarea>
        </div>
    </div>

    <p style="text-align: center;color: #06674e;font-size: 25px;">SABER SABER (33%)</p>
    <hr style="border: 1px solid #06674e;"/>
    <br>
    <?php $s = 0 ?>
    <?= Question(['question' => 'La  revisión e interpretación por parte del estudiante de la documentación teórica y otros referentes aplicables a su práctica es: <span class="b">(Interpretación)</span>',
        'num' => ++$s, 'name' => ++$r, 'slider' => true, 'options' => ['Excelente', 'Bueno', 'Aceptable', 'Deficiente']]) ?>

    <?= Question(['question' => 'La articulación por parte del estudiante, de los diferentes campos de conocimientos de su saber específico y las situaciones problemáticas surgidas es: <span class="b">(Análisis)</span>',
        'num' => ++$s, 'name' => ++$r, 'slider' => true, 'options' => ['Excelente', 'Bueno', 'Aceptable', 'Deficiente']]) ?>

    <?= Question(['question' => 'La capacidad del estudiante frente a la búsqueda de información acertada para la resolución y optimización de problemas es: <span class="b">(Proposición)</span>',
        'num' => ++$s, 'name' => ++$r, 'slider' => true, 'options' => ['Excelente', 'Bueno', 'Aceptable', 'Deficiente']]) ?>

    <?= Question(['question' => 'La capacidad investigativa del estudiante orientada al desarrollo de procesos innovadores es: <span class="b">(Argumentación)</span>',
        'num' => ++$s, 'name' => ++$r, 'slider' => true, 'options' => ['Excelente', 'Bueno', 'Aceptable', 'Deficiente']]) ?>

    <?= Question(['question' => 'La capacidad de síntesis coherente de los resultados obtenidos en el desarrollo de sus actividades o funciones, por parte del estudiante es: <span class="b">(Síntesis)</span>',
        'num' => ++$s, 'name' => ++$r, 'slider' => true, 'options' => ['Excelente', 'Bueno', 'Aceptable', 'Deficiente']]) ?>

    <?= Question(['question' => 'El interés demostrado por el estudiante frente al aprendizaje de nuevos conceptos es: <span class="b">(Actualización)</span>',
        'num' => ++$s, 'name' => ++$r, 'slider' => true, 'options' => ['Excelente', 'Bueno', 'Aceptable', 'Deficiente']]) ?>
    <div class="form-group">
        <div class="row"><label class="col-sm-7 control-label">Observaciones:</label>
        </div>
        <div class="col-lg-12">
            <textarea name="OBS_SABERSABER" style="height: 120px;margin-top:5px;"
                      placeholder="Ingrese la observación del saber saber (opcional)" class="form-control"
                      maxlength="255"></textarea>
        </div>
    </div>

    <?= br(3) ?>
    <!--Envíar-->
    <?= input_submit(['class' => 'col-lg-offset-5 col-lg-10', 'text' => 'Envíar calificación']) ?>

    <?= call_spin_div() ?>

    <?= form_close() ?>
</div>
<?= $this->Footer() ?>

<script>
    $('form').jValidate();

    $('select[name=ID_PROYECTO]').on('change', function ()
    {
        if ($('select[name=ID_PROYECTO] :selected').val() != 0)
            $('.practicantes').load('<?=site_url('seguimiento/traepracticantesMomentoActualDDAjax')?>', {ID_PROYECTO: $(this).val()});
    });

    $(function ()
    {
        for (var j = 1; j <= <?=$r?>; j++)
        {
            $("#range" + j).ionRangeSlider({
                min: 0,
                max: 3.4,
                type: 'single',
                step: 0.1,
                postfix: "",
                prettify: false,
                grid: true
            });
        }
        <?php
         for($i = 1; $i <= $r; $i++)
         {
         echo "\n$('body').on('ifChanged', 'input:radio[name=R$i]:checked', function () {
                $('#range$i').data('ionRangeSlider').update(UpdateRate($(this).val()));});";
         }
    ?>

        $('input:radio').iCheck({
            checkboxClass: 'iradio_square-green',
            radioClass: 'iradio_flat-green',
            increaseArea: '90%' // optional
        });

        //$('input:radio').iCheck('check');

    });

    function UpdateRate(val)
    {
        switch (val)
        {
            case 'd':
                return {min: 0, max: 3.4,}
                break;
            case 'c':
                return {min: 3.5, max: 3.9,}
                break;
            case 'b':
                return {min: 4, max: 4.5}
                break;
            case 'a':
                return {min: 4.6, max: 5,}
                break;
        }
    }

    (new Spinner({
        lines: 10, width: 4,
        radius: 6, color: '#000', speed: 1, length: 15, top: '10%'
    })).spin(document.getElementById("spin"));

    function validateRadios()
    {
        Clear();
        var free = {pass: true, id: null};
        for (var i = 1; i <= <?=$r?>; i++)
        {
            var radio = $("form:first input:radio[name=R" + i + "]");

            if (!radio.is(':checked'))
            {
                free = {pass: false, id: 'st' + i}
                break;
            }
        }
        if (!free.pass)
        {
            $('body').animate({scrollTop: $('#' + free.id).offset().top}, function ()
            {
                $('#' + free.id).closest('div').find('.font1').hide().css({'color': 'red'}).fadeIn(900);
            });
        }
        return free.pass;
    }
    function Save()
    {
        if (validateRadios())
        {
            var practicante = $('select[name=ID_PRACTICANTE]');

            if ($('select[name=ID_PROYECTO]').val() == 0)
                Message('Debe seleccionar un proyecto para continuar.');

            else if (!practicante.length || practicante.val() == 0)
                Message('Debe seleccionar un practicante para continuar.');
            else
            {
                $.ajax({
                    type: 'post', url: '<?=site_url('seguimiento/calificarpracticante')?>',
                    data: $('form').serialize(),
                    beforeSend: function ()
                    {
                        $('body').addClass('Wait');
                        $('body,html').animate({scrollTop: 0}, 200);
                        $('#spin').show();
                    },
                    success: function (response)
                    {
                        console.log(response);
                        var message = 'La calificación se ha realizado correctamente...';
                        var type = BootstrapDialog.TYPE_SUCCESS;
                        var title = true;
                        if (response != '')
                        {
                            message = response;
                            type = BootstrapDialog.TYPE_DANGER;
                            title = '<span style="color: #ffffff;font-size: 20pt;"class="ion ion-close-circled"></span>&nbsp;&nbsp; <span style="font-size: 18pt;">No se puede envíar la calificación...</span>';
                        }
                        $('body').removeClass('Wait');
                        Alerta(message, function ()
                        {
                            self.location = '';
                        }, type, title);
                        $('#spin').hide();
                    }
                });
            }
        }
    }

    function Clear()
    {
        $('form > div > div').each(function (index, element)
        {
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

    .b
    {
        font-weight: bold;
        color: black;
    }
</style>
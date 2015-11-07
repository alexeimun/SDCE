<?php
    /**
     * @var $this CI_Loader
     */
    $this->Header(['assets' => ['dialogs', 'spin', 'jvalidator']]);

?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <?= page_title(['ob' => $this, 'class' => 'fa fa-paper-plane-o', 'text' => 'Enviar Autoevaluación']) ?>
</section>
<!-- Main content -->
<div class="container">
    <?= form_open('', ['class' => 'form-horizontal col-md-8', 'style' => 'margin-left: 15%']) ?>
    <hr style="border: 1px solid #099a5b;"/>
    <?= select_input(['text' => 'Proyecto', 'select' => Dropdown(['name' => 'ID_PROYECTO', 'dataProvider' => $this->proyectos_model->TraeAsesorProyectosLinkDD(),
        'placeholder' => '-- Seleccione un proyecto --', 'fields' => ['NOMBRE_PROYECTO']])]) ?>


    <div class="box">
        <div class="box-header bg-gray">
            <h3 style="color:#7d7d80;text-align: center"><span class="fa fa-group"></span> Practicantes</h3>
        </div>
        <div class="box-body"></div>
    </div>
    <?= form_input(['placeholder' => 'Ingrese el plazo en días a partir de hoy', 'name' => 'DIAS', 'class' => 'obligatorio numero porcentaje',
        'input' => ['col' => '6'], 'label' => ['text' => 'Plazo (Días)', 'col' => 3]], 7) ?>
    <div class="panel panel-success">
        <div class="panel-heading">
            <h3 class="panel-title">Plazo para responder el formulario</h3>
        </div>
        <div class="panel-body">

        </div>
    </div>
    <?= br(1) ?>
    <!--Enviar-->
    <?= input_submit(['class' => 'col-lg-offset-5 col-lg-10', 'text' => 'Enviar formularios']) ?>

    <?= call_spin_div() ?>

    <?= form_close() ?>
</div>
<?= $this->Footer() ?>

<script>

    $('form').jValidate();


    $(function ()
    {
        function Periodo(Dias)
        {
            $('.panel-body').load('<?=site_url('seguimiento/periodoAjax')?>', {DIAS: Dias});
        }

        $('input[name=DIAS]').on('keyup', function ()
        {
            Periodo($(this).val().replace('.', ''));
        });

        Periodo($('input[name=DIAS]').val());

        $('select[name=ID_PROYECTO]').on('change', function ()
        {
            if ($('select[name=ID_PROYECTO] :selected').val() != 0)
            {
                $('.box-body').load('<?=site_url('seguimiento/changetableAjax')?>', {ID_PROYECTO: $('select[name=ID_PROYECTO] :selected').val()});
            }
            else
            {
                $('.box-body').html('');
            }
        });
    });


    $('body').on('click', '.box-body table tbody tr', function ()
    {
        $(this).iCheck('toggle');
    });

    (new Spinner({
        lines: 10, width: 4,
        radius: 6, color: '#000', speed: 1, length: 15, top: '10%'
    })).spin(document.getElementById("spin"));

    function Save()
    {
        if ($('select[name=ID_PROYECTO]').val() == 0)
        {
            Message('Debe seleccionar un proyecto');
        }
        else if (!$('.box-body table tbody tr td:first').length)
        {
            Message('El proyecto no tiene practicantes.');
        }
        else
        {
            var Practicantes = [];
            $('.box-body table tbody tr').each(function (index, ele)
            {
                ele = $(ele);
                Practicantes.push({
                    correo: ele.find('td:nth-of-type(2)').text(),
                    cc: ele.find('td:nth-of-type(3)').text()
                });
            });
            $.ajax({
                type: 'post', url: '<?=site_url('seguimiento/enviarautoevaluacion')?>',
                data: {
                    Practicantes: Practicantes,
                    Dias: $('input[name=DIAS]').val(),
                    ID_PROYECTO: $('select[name=ID_PROYECTO] :selected').val()
                },
                beforeSend: function ()
                {
                    $('body').addClass('Wait');
                    $('body,html').animate({scrollTop: 0}, 200);
                    $('#spin').show();
                },
                success: function ()
                {
                    $('body').removeClass('Wait');
                    Alerta('Los formularios se han enviado correctamente... Espere la respueta de los mismos.', function ()
                    {
                        self.location = '';
                    });
                    $('#spin').hide();
                }
            });
        }
    }
</script>
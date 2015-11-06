<?php
    /**
     * @var $this CI_Loader
     */
    $this->Header(['assets' => ['dialogs', 'spin', 'jvalidator', 'icheck']]);

?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <?= page_title(['ob' => $this, 'class' => 'fa fa-paper-plane-o', 'text' => 'Enviar Asesorías de Práctica']) ?>
</section>
<!-- Main content -->
<div class="container">
    <?= form_open('', ['class' => 'form-horizontal col-md-8', 'style' => 'margin-left: 15%']) ?>
    <hr style="border: 1px solid #099a5b;"/>
    <?= select_input(['text' => 'Proyecto', 'select' => Dropdown(['name' => 'ID_PROYECTO', 'dataProvider' => $this->proyectos_model->TraeAsesorProyectosDD(),
        'placeholder' => '-- Seleccione un proyecto --', 'fields' => ['NOMBRE_PROYECTO']])]) ?>

    <div class="col-lg-offset-5"><span style="text-align: center;" class="font1" id="consecutivo"></span></div>
    <div class="box">
        <div class="box-header bg-gray">
            <h3 style="color:#7d7d80;text-align: center"><span class="fa fa-group"></span> Practicantes
            </h3>
        </div>
        <div class="box-body"></div>
    </div>

    <?= br(1) ?>
    <!--Enviar-->
    <?= input_submit(['class' => 'col-lg-offset-5 col-lg-10', 'text' => 'Enviar ']) ?>

    <?= call_spin_div() ?>

    <?= form_close() ?>
</div>
<?= $this->Footer() ?>

<script>

    $('form').jValidate();

    $(function () {

        $('select[name=ID_PROYECTO]').on('change', function () {
            if ($('select[name=ID_PROYECTO] :selected').val() != 0) {
                $('#consecutivo').load('<?=site_url('informe/consecutivoAjax')?>', {ID_PROYECTO: $('select[name=ID_PROYECTO] :selected').val()});
                $('.box-body').load('<?=site_url('informe/changetableAjax')?>', {ID_PROYECTO: $('select[name=ID_PROYECTO] :selected').val()}, function () {
                    $('input:radio').iCheck({
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


    $('body').on('click', '.box-body table tbody tr', function () {
        $(this).iCheck('toggle');
    });

    (new Spinner({
        lines: 10, width: 4,
        radius: 6, color: '#000', speed: 1, length: 15, top: '10%'
    })).spin(document.getElementById("spin"));

    function Save() {
        if ($('select[name=ID_PROYECTO]').val() == 0)
            Message('Debe seleccionar un proyecto');
        else if (!$('.box-body table tbody tr td:first').length)
            Message('El proyecto no tiene practicantes.');

        else {
            var radio = $('input[name=RADIO]:checked');
            var cc = radio.closest('td').prev().text();
            var correo = radio.closest('td').prev().prev().text();
            $.ajax({
                type: 'post', url: '<?=site_url('informe/enviarasesoriaspractica')?>',
                data: {
                    ID_PRACTICANTE: radio.val(),
                    ID_PROYECTO: $('select[name=ID_PROYECTO]').val(),
                    CORREO: correo,
                    CC: cc,
                },
                beforeSend: function () {
                    $('body').addClass('Wait');
                    $('body,html').animate({scrollTop: 0}, 200);
                    $('#spin').show();
                },
                success: function () {
                    $('body').removeClass('Wait');
                    Alerta('La solicitud de edición del formato de asesoría se envió correctamente... Espere la respueta de los mismos.', function () {
                        self.location = '';
                    });
                    $('#spin').hide();
                }
            });
        }
    }
</script>

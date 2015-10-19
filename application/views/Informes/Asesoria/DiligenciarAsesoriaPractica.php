<?php
    /**
     * @var $this CI_Loader
     */
    $this->Header(['assets' => ['dialogs', 'spin', 'jvalidator','icheck','datetimepicker']],'guess');

?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <?= page_title(['ob'=>$this,'class' => 'ios ion-edit', 'text' => 'Diligenciar Asesoría Práctica']) ?>
</section>
<!-- Main content -->
<div class="container">
    <?= form_open('', ['class' => 'form-horizontal col-md-7', 'style' => 'margin-left: 15%']) ?>
    <hr style="border: 1px solid #099a5b;"/>

    <?= Question(['question' => 'Tipo:','name' =>1,  'options' => ['Asesoría: FUMC', 'Visita agencia']]) ?>
    <?= form_input(['name' => 'FECHA_HORA', 'id'=>'horafecha','class' => 'obligatorio fecha', 'required'=>'required','input'=>['col'=>5],'label' => ['col'=>3,'text' => 'Fecha y hora']], date('d/m/Y h:i a')) ?>
    <div class="form-group">
        <div class="row">
    	<label for="inputID" class="col-sm-9 control-label">Desarrollo de la reunión de la asesoría:</label>
        </div>
    	<div class="col-lg-12">
    		<textarea name="REUNION_ASESORIA" id="inputID" style="height: 400px;margin-top:5px;" class="form-control obligatorio" maxlength="1500" title="" ></textarea>
    	</div>
    </div>

    <!--Envíar-->
    <?= input_submit(['class' => 'col-lg-offset-9 col-lg-10','text'=>'Envíar']) ?>
    <?= call_spin_div() ?>

    <?= form_close() ?>

</div>
<?= $this->Footer() ?>

<script>
    jQuery('#horafecha').datetimepicker({format:'d/m/Y h:i a'});

    $('form').jValidate();
    $('input:radio').iCheck({
        checkboxClass: 'iradio_square-green',
        radioClass: 'iradio_flat-green',
        increaseArea: '90%' // optional
    });

    (new Spinner({
        lines: 10, width: 4,
        radius: 6, color: '#000', speed: 1, length: 15, top: '10%'
    })).spin(document.getElementById("spin"));

    function validateRadios() {
        Clear();
        var free = {pass: true, id: null};
            var radio = $("form:first input:radio[name=R1]");

            if (!radio.is(':checked')) {
                free = {pass: false, id: 'st1'}
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
                type: 'post', url: '<?=site_url('informe/asesoriapracticas') ?>', data: $('form').serialize(),
                beforeSend: function () {
                    $('body').addClass('Wait');
                    $('body,html').animate({scrollTop: 0}, 200);
                    $('#spin').show();
                },
                success: function () {
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
    function Clear() {
        $('form > div > div').each(function (index, element) {
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
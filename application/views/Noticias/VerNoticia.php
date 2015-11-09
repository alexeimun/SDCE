<?php
    /**
     * @var $this CI_Loader
     */
    $this->Header(['assets' => ['jvalidator', 'icheck', 'datatables', 'dialogs', 'wysihtml5', 'spin']]);
?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <?= page_title(['ob' => $this, 'class' => 'ion-speakerphone', 'text' => 'Ver Noticia']) ?>
</section>
<!-- Main content -->
<div class="container">
    <?= form_open('seguimiento/pazysalvo', ['class' => 'form-horizontal col-md-8', 'target' => '_blank', 'style' => 'margin-left: 15%']) ?>
    <hr style="border: 1px solid #099a5b;"/>
        <!--<h1 style="text-align: center;">--><?//= $Info->ASUNTO ?><!--</h1>-->
    <br>

    <div class="form-group">

        <div class="col-lg-12">

            <div class='box'>
                <div class='box-header' style="background: #8e1513">
                    <h3  style="color: whitesmoke"><i class="fa fa-newspaper-o"></i> <?= $Info->ASUNTO ?></h3>
                </div>
                <!-- /.box-header -->
                <div class='box-body pad' style="padding: 20px;">
                    <?= $Info->MENSAJE ?>
                </div>
                <div class="box-footer">
                    <small><?= 'Creada el '. FechaFormal($Info->FECHA_ENVIO).' por '.$Info->NOMBRE_USUARIO ?></small>
                </div>
            </div>

        </div>
    </div>
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

    $('select[name=TIPO]').on('change', function ()
    {

        if ($('select[name=TIPO] :selected').val() == 2)
        {
            $('input[name=ASUNTO]').parent().parent().hide(300);
            $('input[name=ASUNTO]').removeClass('obligatorio').val('');
        }
        else
        {
            $('input[name=ASUNTO]').parent().parent().show(300);
            $('input[name=ASUNTO]').addClass('obligatorio');
        }
    });

    $(function ()
    {
        $("#tabla").dataTable();
    });
    $('input:checkbox').iCheck({
        checkboxClass: 'iradio_square-green',
        radioClass: 'iradio_flat-green',
        increaseArea: '90%' // optional
    });

    function Save()
    {
        if ($('table tbody input:checkbox:checked').length == 0)
        {
            Message('Debe seleccionar al menos un asesor...');
        }
        else
        {
            var ASESORES = [];
            $('table tbody input:checkbox:checked').each(function (i, e)
            {
                ASESORES.push($(e).val());
            });
            $.ajax({
                type: 'post', url: '<?=site_url('noticias') ?>', data: $('form').serialize() + '&ID_ASESOR=' + ASESORES,
                beforeSend: function ()
                {
                    $('body').addClass('Wait');
                    $('body,html').animate({scrollTop: 0}, 200);
                    $('#spin').show();
                },
                success: function ()
                {
                    $('body').removeClass('Wait');
                    Alerta('Se ha enviado correctamente la información', function ()
                    {
                        location.href = '';
                    });
                    $('#spin').hide();
                }
            });
        }
    }
    //bootstrap WYSIHTML5 - text editor
    $(".textarea").wysihtml5();
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
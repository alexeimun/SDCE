<?php
    /**
     * @var $this CI_Loader
     */
    $this->Header(['assets' => ['jvalidator', 'icheck', 'datatables', 'dialogs', 'wysihtml5', 'spin']]);
?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <?= page_title(['ob' => $this, 'class' => 'ion-speakerphone', 'text' => 'Noticias Y Mensajes']) ?>
</section>
<!-- Main content -->
<div class="container">
    <?= form_open('seguimiento/pazysalvo', ['class' => 'form-horizontal col-md-8', 'target' => '_blank', 'style' => 'margin-left: 15%']) ?>
    <hr style="border: 1px solid #3d8ebc;"/>
    <?= form_dropdown('TIPO', [1 => 'Noticia', 2 => 'Mensaje'], ['input' => ['col' => 6], 'label' => ['text' => 'Tipo']]) ?>
    <?= form_input(['placeholder' => 'Ingrese el encabezado de la noticia', 'name' => 'ASUNTO', 'class' => 'obligatorio', 'label' => ['text' => 'Encabezado']]) ?>

    <div class="form-group">

        <div class="col-lg-12">
            <div class='box'>
                <div class='box-header'>
                    <h3 class='box-title'> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Cuerpo del mensaje o noticia</h3>
                </div>
                <!-- /.box-header -->
                <div class='box-body pad'>

                    <div class="col-lg-12">
               <textarea name="MENSAJE" style="height: 200px;margin-top:5px;" class="form-control textarea obligatorio"
                         placeholder="Digite la información completa de su escrito, trate de ser breve en caso de ser un mensaje (máximo 800 caracteres)"
                         maxlength="800"></textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <p style="text-align: center;color: #214e67;font-weight: bold;font-size: 11pt">Dirigido a</p>
    <hr style="border: 1px solid #3d8ebc;"/>

    <div class="box">
        <div class="box-header bg-gray">
            <h3 style="color:#7d7d80;text-align: center"><span class="ion ion-person-stalker"></span> Asesores
            </h3>
        </div>

        <div class="box-body">
            <?= Component::Table(['columns' => ['Foto', 'Nombre'], 'tableName' => 'asesor', 'controller' => 'asesores', 'autoNumeric' => false, 'id' => 'ID_USUARIO',
                'fields' => ['FOTO' => ['type' => 'img', 'path' => base_url('asesorfotos')], 'NOMBRE'],
                'dataProvider' => $this->usuarios_model->TraeAsesores(), 'actions' => 'c']) ?>
        </div>
    </div>

    <br><br>
    <!--Envíar-->
    <?= input_submit(['class' => 'col-lg-offset-4 col-lg-10', 'text' => 'Enviar']) ?>
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
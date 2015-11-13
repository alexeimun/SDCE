<?php
    /**
     * @var $this CI_Loader
     */
    $this->Header(['assets' => ['jvalidator', 'dialogs']]);
?>
<!-- Content Header (Page header) -->
<div class="container">
    <br>
    <?= form_open('', ['class' => 'form-horizontal col-md-11', 'target' => '_blank', 'style' => 'margin-left:0%']) ?>

    <div class="form-group">

        <div class="col-lg-12">

            <div class='box'>
                <div class='box-header' style="background: #9e1715">
                    <h3 style="color: whitesmoke"><i class="fa fa-newspaper-o"></i> <?= $Info->ASUNTO ?></h3>
                </div>
                <!-- /.box-header -->
                <div class='box-body pad' style="padding: 20px;">
                    <?= $Info->MENSAJE ?>
                </div>
                <div class="box-footer">
                    <small><?= (!is_null($Info->FECHA_MODIFICA) ? 'Actualizado' : 'Creada') . ' el ' . FechaFormal($Info->FECHA_ENVIO) . ' por ' . $Info->NOMBRE_USUARIO ?></small>
                </div>
            </div>

        </div>
    </div>


    <?= form_close() ?>
    <?= br(1) ?>
    <form id="comment" onsubmit="event.preventDefault()" class="form-horizontal col-md-10" style="margin-left: 5%;">
        <h3 style="color:lightslategrey "><i class="fa fa-comments"></i> Comentarios...</h3>
        <br/>

        <div class="form-group">
            <img style="width: 70px;height: 60px;"
                 src="<?= base_url('asesorfotos/' . $this->session->userdata('FOTO')) ?>"
                 class="col-xs-2 col-sm-2 col-md-2 col-lg-2 img-responsive form-control" alt="User Image"/>

            <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10">

                <div class="input-group">
                    <input type="hidden" value="<?= $Info->ID_NOTICIA ?>" name="ID_NOTICIA"/>
                    <input type="text" class="form-control box-com" style="height: 50px;" name="COMENTARIO"
                           placeholder="Deja tu comentario...">

                    <div class="input-group-addon bg-red-gradient comentar"
                         style="cursor: pointer;font-size: 13pt;padding-left:10px;padding-right:10px;color: #ffffff ">
                        Comentar
                    </div>
                </div>
            </div>
        </div>
    </form>
    <?= br(2) ?>
    <form id="comments" class="form-horizontal col-md-10" role="form" style="margin-left: 5%;">
        <?= $Comentarios ?>
        <?= br(2) ?>
    </form>
</div>
<!-- Main content -->
<section class="content-header">
</section>


<?= $this->Footer() ?>

<script>
    $('form').jValidate();


    $('.comentar').click(function ()
    {
        if ($('input[name=COMENTARIO]').val().trim() != '')
        {
            killMessage();
            $.post('<?=site_url('noticias/crearcomentarioAjax') ?>', $('#comment').serialize(), function (reply)
            {
                $('input[name=COMENTARIO]').val('');
                $('#comments').html(reply);
            });
        }
        else
        {
            Message('El comentario no puede estar vacío...', 'danger', '#comment');
        }
    });
    function SavePost()
    {

    }
    $('body').on('keyup', '#comment input:text', function (e)
    {
        if (e.keyCode == 13)
        {
            $('div.comentar').trigger('click');
        }
    });
    $(document).on('ready', function ()
    {
        $('body').addClass('sidebar-collapse')
        $('body').removeClass('skin-green-light');
        $('body').addClass('skin-red-light');
        setTimeout(function ()
        {
            console.log('1');
            //$.post('<?//=site_url('noticias/comentariosrefreshAjax') ?>//', $('#comment').serialize(), function (reply)
            //{
            //    $('#comments').html(reply);
            //});
        }, 1000);
    });

</script>
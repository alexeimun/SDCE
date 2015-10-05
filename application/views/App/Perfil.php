<?php
    /**
     * @var $this CI_Loader
     */
    $this->Header(['assets' => ['dialogs', 'spin', 'jvalidator', 'uploadify']]);

?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <?= page_title(['ob' => $this, 'class' => 'ios ion-person', 'text' => Uncamelize(__FILE__)]) ?>
</section>
<!-- Main content -->
<div class="container">
    <?= form_open('', ['class' => 'form-horizontal col-md-6', 'style' => 'margin-left: 20%'], ['ID_USUARIO' => $Info->ID_USUARIO]) ?>
    <hr style="border: 1px solid #099a5b;"/>
    <div style="text-align: center;" id="imagen">
        <img style="width: 130px;height: 130px;cursor: pointer"
             src="<?= base_url('asesorfotos/' . $this->session->userdata('FOTO')) ?>"
             class="img-circle" alt="Asesor image" id="dim"/>
    </div>
    <?= br(1) ?>
    <div id="errorload"></div>
    <div style="margin-left: 38%">
        <input type="file" style="" id="file_upload">
    </div>
    <?= br(1) ?>

    <?= form_input(['placeholder' => 'Ingrese el número telefónico del asesor', 'name' => 'TELEFONO', 'class' => 'obligatorio numero telefono', 'label' => ['text' => 'Telefono']], $Info->TELEFONO) ?>
    <?= form_input(['placeholder' => 'Ingrese el número celular del asesor', 'name' => 'CELULAR', 'class' => 'numero telefono', 'label' => ['text' => 'Celular']], $Info->CELULAR) ?>

    <?= form_input(['placeholder' => 'Ingrese su la contraseña', 'name' => 'CLAVE', 'type' => 'password', 'class' => 'obligatorio clave claveinicial', 'label' => ['text' => 'Clave']], $Info->CLAVE) ?>
    <?= form_input(['placeholder' => 'Ingrese de nuevo su cobtraseña', 'type' => 'password', 'class' => 'obligatorio clave confirmar', 'label' => ['text' => 'Comprobar Clave']], $Info->CLAVE) ?>

    <!--Envíar-->
    <?= input_submit(['class' => 'col-lg-offset-5 col-lg-10', 'text' => 'Actualizar']) ?>

    <?= call_spin_div() ?>
    <?= br(2) ?>
    <?= form_close() ?>
</div>
<?= $this->Footer() ?>

<script>

    $('form').jValidate();

    (new Spinner({
        lines: 10, width: 4,
        radius: 6, color: '#000', speed: 1, length: 15, top: '10%'
    })).spin(document.getElementById("spin"));

    function Save() {
        if ($('input[name=CLAVE]').val().length< 7)
            Message('La contraseña debe tener una longitud de al menos 8 caracteres');
        else
        {
            $.ajax({
                type: 'post', url: '<?=site_url('usuario/actualizarasesor')?>', data: $('form').serialize(),
                beforeSend: function () {
                    $('body').addClass('Wait');
                    $('body,html').animate({scrollTop: 0}, 200);
                    $('#spin').show();
                },
                success: function () {
                    $('body').removeClass('Wait');
                    Alerta('Tu perfil se ha actualizado correctamente.');
                    $('#spin').hide();
                }
            });
        }
    }
    <?php $timestamp = time();?>

    $('#file_upload').uploadify({
        'formData': {
            'timestamp': '<?= $timestamp;?>',
            'token': '<?= md5('Jürgen Habermas' . $timestamp);?>'
        },
        buttonText: 'SUBIR FOTO',
        multi: false,
        'swf': '<?=base_url('public/plugins/uploadify/uploadify.swf') ?>',
        'uploader': '<?= site_url('app/subirimagenasesor')?>',
        onUploadSuccess: function (file, data) {
            data = JSON.parse(data);
            if (data.status) {
                $('#dim').attr('src', '<?=base_url('asesorfotos') ?>/' + data.data);
            }
        }
    });
</script>


<style>
    img.img-thumbnail
    {
        min-width: 45px;
        min-height: 45px;
        max-height: 170px;
        max-width: 170px;
        width: 15%;
        height: 30%;
        margin: 5px;
        cursor: pointer;
    }

    .Selection
    {
        box-shadow: 2px 2px 2px 2px #52b532;
    }

</style>

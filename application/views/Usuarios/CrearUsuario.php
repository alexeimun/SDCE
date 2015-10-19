<?php
    /**
     * @var $this CI_Loader
     */
    $this->Header(['assets' => ['dialogs', 'spin', 'jvalidator', 'icheck']]);

?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <?= page_title(['ob' => $this, 'class' => 'ios ion-person-add', 'text' => Uncamelize(__FILE__)]) ?>
</section>
<!-- Main content -->
<div class="container">
    <?= form_open('', ['class' => 'form-horizontal col-md-6', 'style' => 'margin-left: 20%']) ?>
    <hr style="border: 1px solid #3D8EBC;"/>
    <?= form_input(['placeholder' => 'Ingrese el nombre del usuario', 'name' => 'NOMBRE', 'class' => 'obligatorio', 'label' => ['text' => 'Nombre']]) ?>
    <?= form_input(['placeholder' => 'Ingrese el correo electrónico del usuario', 'name' => 'CORREO', 'class' => 'obligatorio correo correo_unico', 'label' => ['text' => 'Correo']]) ?>
    <?= form_input(['placeholder' => 'Ingrese una contraseña', 'name' => 'CLAVE', 'type' => 'password', 'class' => 'obligatorio clave claveinicial', 'label' => ['text' => 'Clave']]) ?>
    <?= form_input(['placeholder' => 'Ingrese de nuevo la contraseña', 'type' => 'password', 'class' => 'obligatorio clave confirmar', 'label' => ['text' => 'Comprobar Clave']]) ?>

    <?= br() ?>
    <h3 style="text-align: center;color: #3D8EBC">El usuario puede administrar</h3>
    <hr style="border: 1px solid #3D8EBC;"/>
    <?= $Modulos ?>
    <?= br() ?>

    <!--Envíar-->
    <?= input_submit(['class' => 'col-lg-offset-5 col-lg-10']) ?>
    <?= br() ?>

    <?= call_spin_div() ?>
    <?= form_close() ?>
</div>
<?= $this->Footer() ?>

<script>
    $('input:checkbox').iCheck({
        checkboxClass: 'iradio_square-blue',
        increaseArea: '90%' // optional
    });

    $('form').jValidate({persona: 'Asesor', url: '<?=site_url('Validaciones/ValidaCampos')?>'});

    (new Spinner({
        lines: 10, width: 4,
        radius: 6, color: '#000', speed: 1, length: 15, top: '10%'
    })).spin(document.getElementById("spin"));

    function Save() {
        if ($('input[name=CLAVE]').val().length < 8)
            Message('La clave debe tener una longitud de al menos 8 caracteres');
        else {
            $.ajax({
                type: 'post', url: '<?=site_url('usuario/crearusuario')?>', data: $('form').serialize(),
                beforeSend: function () {
                    $('body').addClass('Wait');
                    $('body,html').animate({scrollTop: 0}, 200);
                    $('#spin').show();
                },
                success: function () {
                    $('body').removeClass('Wait');
                    Alerta('El usuario se ha creado correctamente',function () {
                        location.href = '';
                    });
                    $('#spin').hide();
                }
            });
        }
    }
</script>
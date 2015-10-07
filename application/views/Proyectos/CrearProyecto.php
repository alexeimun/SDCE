<?php
    /**
     * @var $this CI_Loader
     */
    $this->Header(['assets' => ['dialogs', 'spin', 'jvalidator','dropdown']]);

?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <?= page_title(['ob'=>$this,'class' => 'ios ion-person', 'text' => Uncamelize(__FILE__)]) ?>
</section>
<!-- Main content -->
<div class="container">
    <?= form_open('', ['class' => 'form-horizontal col-md-6', 'style' => 'margin-left: 20%']) ?>
    <hr style="border: 1px solid #3D8EBC;"/>
    <?= form_input(['placeholder' => 'Ingrese el nombre del proyecto', 'name' => 'NOMBRE_PROYECTO', 'class' => 'obligatorio', 'label' => ['text' => 'Nombre']]) ?>

    <?= select_input(['text'=>'Tipo','select'=> Dropdown(['name' => 'ID_TIPO_PROYECTO', 'dataProvider' => $this->proyectos_model->TraeTipoProyectos(),
        'placeholder' => '-- Seleccione un tipo de proyecto --', 'fields' => ['NOMBRE_TIPO_PROYECTO']])]) ?>

    <!--Envíar-->
    <?= input_submit(['class' => 'col-lg-offset-9 col-lg-10']) ?>
    <?= call_spin_div() ?>

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
        if ($('select[name=ID_TIPO_PROYECTO] :selected').val() == 0)
            Message('Debe seleccionar un tipo de proyecto');
        else {
            $.ajax({
                type: 'post', url: 'crearproyecto', data: $('form').serialize(),
                beforeSend: function () {
                    $('body').addClass('Wait');
                    $('body,html').animate({scrollTop: 0}, 200);
                    $('#spin').show();
                },
                success: function () {
                    $('body').removeClass('Wait');
                    Alerta('El proyecto se ha creado correctamente',function () {
                        location.href = '';
                    });
                    $('#spin').hide();
                }
            });
        }
    }
</script>
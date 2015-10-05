<?php
    /**
     * @var $this CI_Loader
     */
    $this->Header(['assets' => ['dialogs', 'spin', 'jvalidator']]);

?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <?= page_title(['ob'=>$this,'class' => 'glyphicon glyphicon-cog', 'text' => 'Parámetros']) ?>
</section>
<!-- Main content -->
<div class="container">
    <?= form_open('', ['class' => 'form-horizontal col-md-6', 'style' => 'margin-left: 20%']) ?>
    <hr style="border: 1px solid #099a5b;"/>
    <div class="form-group">
    	<label for="inputID" class="col-lg-4 col-sm-4 control-label">Periodo:</label>
    	<div class="col-lg-3 col-sm-3">
            <?= $Periodo ?>
    	</div>
    </div>
    <!--Envíar-->
    <?= br(2) ?>
    <?= input_submit(['class' => 'col-lg-offset-4 col-lg-10']) ?>

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
        $.ajax({
            type: 'post', url: '<?=site_url('parametros')?>', data: $('form').serialize(),
            beforeSend: function () {
                $('body').addClass('Wait');
                $('body,html').animate({scrollTop: 0}, 200);
                $('#spin').show();
            },
            success: function () {
                console.log();
                $('body').removeClass('Wait');
                Alerta('Parámetros establecidos correctamente!!');
                $('#spin').hide();
            }
        });
    }
</script>
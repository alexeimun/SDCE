<?php
    /**
     * @var $this CI_Loader
     */
    $this->Header(['assets' => ['textillate']]);
?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <?= page_title(['ob' => $this, 'class' => 'ion-android-contact', 'text' => 'Acerca de SDCE Project']) ?>
</section>
<!-- Main content -->
<div class="container">
    <?= form_open('', ['class' => 'form-horizontal col-md-8', 'target' => '_blank', 'style' => 'margin-left: 15%']) ?>
    <hr style="border: 1px solid #099a5b;"/>

    <br>

    <h1 class="tit" data-in-effect="rollIn" style="color: #099a5b">Sistema de Gestión para el Desarrollo de Competencias Empresariales en la FI-FUMC</h1>
    <p class="inte" style="color: #065d37;font-size: 12pt;"></p>

    <?= br(2) ?>
</div>


<?= call_spin_div() ?>

<?= form_close() ?>

<?= $this->Footer() ?>

<script>
    $(function () {
        $('.tit').textillate({
            in: {
                effect: 'rollIn',
                callback: function () {
                    $('.inte').text('SDCE es un sistema de gestión de procesos internos de prácticas que facilita y mejora la priductiviad del asesor en sus labores de documentación, control, informes y seguimiento de sus practicantes.')
                        .textillate();
                }
            }
        });
    });
</script>
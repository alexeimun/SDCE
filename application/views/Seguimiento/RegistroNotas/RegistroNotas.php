<?php
    /**
     * @var $this CI_Loader
     */
    $this->Header(['assets' => ['dialogs', 'spin', 'jvalidator']]);
?>
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <?= page_title(['ob' => $this, 'class' => 'fa fa-pencil', 'text' => Uncamelize(__FILE__)]) ?>
    </section>
    <!-- Main content -->
    <div class="container">
        <?= form_open('seguimiento/registronotas', ['class' => 'form-horizontal col-md-6', 'target' => '_blank', 'style' => 'margin-left: 20%']) ?>
        <hr style="border: 1px solid #099a5b;"/>
        <?= form_dropdown('PROGRAMA', ['Ingeniería de sistemas' => 'Ingeniería de sistemas', 'Ingeniería de software' => 'Ingeniería de software',
            'Electromedicina' => 'Electromedicina', 'Robótica y automatización' => 'Robótica y automatización'], ['input' => ['col' => 6], 'label' => ['text' => 'Programa', 'col' => 4]]) ?>
        <br><br>
        <!--Envíar-->
        <?= input_submit(['class' => 'col-lg-offset-4 col-lg-10', 'type' => 'submit', 'icon' => 'print', 'text' => 'Imprimir']) ?>
        <?= br(2) ?>
    </div>

<?= form_close() ?>
<?= $this->Footer() ?>
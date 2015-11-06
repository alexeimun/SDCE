<?php
    /**
     * @var $this CI_Loader
     */
    $this->Header(['assets' => ['dialogs', 'spin', 'jvalidator']]);
?>
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <?= page_title(['ob' => $this, 'class' => 'fa fa-eye', 'text' => Uncamelize(__FILE__)]) ?>
    </section>
    <!-- Main content -->
    <div class="container">
        <?= form_open('', ['class' => 'form-horizontal col-md-6', 'style' => 'margin-left: 20%']) ?>
        <hr style="border: 1px solid #3D8EBC;"/>
        <?= form_input(['readonly' => true, 'label' => ['text' => 'Nombre']], $Info->NOMBRE_PROYECTO) ?>
        <?= form_input(['readonly' => true, 'label' => ['text' => 'Tipo de proyecto']], $Info->NOMBRE_TIPO_PROYECTO) ?>
        <?php if($this->session->userdata('ADMIN'))
        {
            echo form_input(['readonly' => true, 'label' => ['text' => 'Asesor']], $Info->NOMBRE_USUARIO);
            echo form_input(['readonly' => true, 'label' => ['text' => 'Horario asesoría']], !is_null($Info->HORARIO) ? NombreDia($Info->HORARIO) . ', ' . date('h:i a', strtotime($Info->HORARIO)) : 'No asignado');
        }
        else
        {
            echo "<div class='form-group'>
            <label for='' class='col-lg-2 control-label'>Horario asesoría</label>

            <div class='col-lg-10'>
                <a target='_blank' class='btn-link' data-toggle='tooltip' title='" . (!is_null($Info->HORARIO) ? 'Ver horarios' : 'Asignar un horario') . "'
                   href='" . site_url('proyectos/horarios') . "'><b>" . (!is_null($Info->HORARIO) ? NombreDia($Info->HORARIO) . ', ' . date('h:i a', strtotime($Info->HORARIO)) : 'No asignado') . "</b></a>
            </div>
        </div>";
        } ?>
        <?= form_input(['readonly' => true, 'label' => ['text' => 'Periodo']], date('Y-', strtotime($Info->PERIODO)) . (date('m', strtotime($Info->PERIODO)) > 6 ? 2 : 1)) ?>
        <?= form_input(['readonly' => true, 'label' => ['text' => 'Fecha registro', 'col' => 3], 'input' => ['col' => 9]], Momento($Info->FECHA_REGISTRO)) ?>
        <?= br(1) ?>
        <div class="box">
            <div class="box-header bg-gray">
                <h3 style="color:#7d7d80;text-align: center"><span class="fa fa-group"></span> Practicantes
                </h3>
            </div>
            <div class="box-body">
                <?= Component::Table(['columns' => ['Nombre'],
                    'tableName' => 'practicante', 'id' => 'ID_PRACTICANTE', 'controller' => 'practicantes',
                    'fields' => ['NOMBRE_PRACTICANTE']
                    , 'dataProvider' => $this->practicantes_model->TraePracticantesPorProyecto($Info->ID_PROYECTO), 'actions' => 'v']) ?>
            </div>
        </div>
        <?= br(2) ?>
        <?= form_close() ?>
    </div>
<?= $this->Footer() ?>
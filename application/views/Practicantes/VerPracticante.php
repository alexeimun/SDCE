<?php
    /**
     * @var $this CI_Loader
     */
    $this->Header(['assets' => ['dialogs', 'spin', 'jvalidator', 'dropdown']]);

?>
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <?= page_title(['ob'=>$this,'class' => 'ios ion-person', 'text' => 'Ver Practicante']) ?>
    </section>
    <!-- Main content -->
    <div class="container">
        <?= form_open('', ['class' => 'form-horizontal col-md-6', 'style' => 'margin-left: 20%'], ['ID_USUARIO' => $Info->ID_PRACTICANTE]) ?>
        <hr style="border: 1px solid #3D8EBC;"/>


        <?php
            $Notas = $this->seguimientos_model->TraeCalificacion($Info->ID_PRACTICANTE);
            if(!empty($Notas))
            {
                echo '<h3 style="text-align: center;color: #3D8EBC"><span class="ion-edit"></span> Notas</h3>';
                br(1);
                echo "<div class='row'>
          <div class='col-lg-4'>
                <div class=\"alert alert-" . ($Notas['NOTA1'] >= 3.5 ? 'success' : 'danger') . "\">
                                <strong>Primera Nota: </strong>" . $Notas['NOTA1'] . "
                            </div>
                </div>
            <div class='col-lg-4'>
                        <div class=\"alert alert-" . ($Notas['NOTA2'] >= 3.5 ? 'success' : 'danger') . "\">
                                        <strong>Segundo Nota: </strong>" . $Notas['NOTA2'] . "
                                    </div>
                        </div>
            <div class='col-lg-4'>
                        <div class=\"alert alert-" . ((($Notas['NOTA1'] + $Notas['NOTA2']) / 2) >= 3.5 ? 'success' : 'danger') . "\">
                                        <strong>Nota Final: </strong> " . (($Notas['NOTA1'] + $Notas['NOTA2']) / 2) . "
                                    </div>
                        </div>
            </div>";
            }
        ?>
        <h3 style="text-align: center;color: #3D8EBC">Información del practicante</h3>
        <hr style="border: 1px solid #3D8EBC;"/>
        <?= form_input(['readonly' => true, 'label' => ['text' => 'Nombre']], $Info->NOMBRE_PRACTICANTE) ?>
        <?= form_input(['readonly' => true, 'label' => ['text' => 'Correo']], $Info->CORREO_PRACTICANTE) ?>
        <?= form_input(['readonly' => true, 'label' => ['text' => 'Documento']], $Info->DOCUMENTO) ?>
        <?= form_input(['readonly' => true, 'label' => ['text' => 'Teléfono']], $Info->TELEFONO) ?>
        <?= form_input(['readonly' => true, 'label' => ['text' => 'Código']], $Info->CODIGO) ?>
        <?= form_input(['readonly' => true, 'label' => ['text' => 'Programa']], $Info->PROGRAMA) ?>
        <?= form_input(['readonly' => true, 'label' => ['text' => 'Modalidad']], $Info->MODALIDAD) ?>
        <?= select_input(['select' => $Asesores, 'text' => 'Asesor']) ?>
        <?= select_input(['select' => $Proyectos, 'text' => 'Proyecto']) ?>
        <?= select_input(['select' => $Agencias, 'text' => 'Agencia']) ?>
        <?= select_input(['select' => $Cooperadores, 'text' => 'Cooperador']) ?>


        <?= form_input(['readonly' => true, 'label' => ['text' => 'Fecha registro', 'col' => 3], 'input' => ['col' => 9]], Momento($Info->FECHA_REGISTRO)) ?>
        <?= br(5) ?>
        <?= form_close() ?>
    </div>
<?= $this->Footer() ?>
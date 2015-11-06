<?php
    /**
     * @var $this CI_Loader
     */
?>
<section class="content">
    <!-- Small boxes (Stat box) -->
    <div class="row">
        <div class="col-lg-3 col-xs-6" id="totalproyectos">
            <!-- small box -->
            <div class="small-box bg-green-gradient">
                <div class="inner">

                    <h3><?= $Practicantes ?></h3>

                    <p>Practicantes</p>
                </div>
                <div class="icon">
                    <i style="cursor: pointer;" onclick="location.href='practicantes'"
                       class="fa fa-group"></i>
                </div>
                <a href="practicantes" class="small-box-footer">Más información <i class="fa fa-arrow-circle-right"></i></a>
            </div>

        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6" id="totalpracticantes">
            <!-- small box -->
            <div class="small-box bg-blue-gradient">
                <div class="inner">
                    <h3><?= $Proyectos ?></h3>

                    <p>Proyectos</p>
                </div>
                <div class="icon">
                    <i style="cursor: pointer;" onclick="location.href='proyectos'"
                       class="fa fa-rocket"></i>
                </div>
                <a href="proyectos" class="small-box-footer">Más información <i
                        class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <!-- ./col -->
    </div>
    <?= Beginbox(['title' => 'Horarios de asesoría <b>' .
        date('Y-', strtotime($this->session->userdata('PERIODO'))) . (date('m', strtotime($this->session->userdata('PERIODO'))) > 6 ? 2 : 1) . '</b>', 'text' => 'ss']) ?>

    <?php
        $c = 0;
        foreach ($this->proyectos_model->TraeHorarios() as $proyecto)
        {
            $horario = new DateTime(date('Y-m-d', strtotime($proyecto->HORARIO)));
            $actual = new DateTime(date('Y-m-d'));

            while ($horario->diff($actual)->days > 7 && $horario->diff($actual)->invert == 0)
            {
                $horario->add(new DateInterval('P7D'));
            }
            $momento = MomentoFuturo($horario->format('Y-m-d'), date('h:i a', strtotime($proyecto->HORARIO)));

            echo Alert(['title' => ucfirst($momento), 'icon' => 'ion-calendar', 'type' => is_int(strpos($momento, 'hoy, ')) ? 'danger' : 'success',
                'text' => 'será el próximo encuentro con el proyecto
                <a data-toggle="tooltip" title="Ver proyecto"  href="proyectos/verproyecto/' . $proyecto->ID_PROYECTO . '" target="_blank"><b>' . $proyecto->NOMBRE_PROYECTO . '</b></a>']);
            $c++;
        }
        if($c == 0)
        {
            echo "<a id='horarios' style='color: cornsilk;font-size: 13pt;text-decoration:underline' href='proyectos/horarios'><b>¡Agregue sus horarios de asesoría prara visualizar los eventos aquí!</b></a>";
        }
    ?>

    <?= Endbox() ?>
    <!-- /.row -->
    <!-- Notificaciones de Evaluaciones -->
    <div class="row">
        <?php foreach ($this->seguimientos_model->TraeEvaluacionEstudianteNotificacion(1) as $i => $note): ?>
            <div class="col-lg-10">
                <?= Alert(['title' => '¡Evaluación recibida!', 'text' => 'El estudainte <a target="_blank" data-toggle="tooltip" title="Ver practicante" href="practicantes/verpracticante/' . $note->ID_PRACTICANTE . '"><b>' . $note->NOMBRE_PRACTICANTE . '</b></a> ha evaluado el momento ' . $note->MOMENTO . '&nbsp;&nbsp;&nbsp;&nbsp; <b>' . Momento($note->FECHA_FINALIZA) . '</b>']) ?>
            </div>
        <?php endforeach; ?>
    </div>

    <div class="row">
        <?php foreach ($this->seguimientos_model->TraeEvaluacionEstudianteNotificacion(0) as $i => $note): ?>
            <div class="col-lg-10">
                <?= Alert(['title' => '¡En espera!', 'icon' => 'ion-clock', 'type' => 'danger', 'text' => 'El estudiante <a target="_blank" data-toggle="tooltip" title="Ver practicante" href="practicantes/verpracticante/' . $note->ID_PRACTICANTE . '"><b>' . $note->NOMBRE_PRACTICANTE . '</b></a> aún no ha evaluado el momento ' .
                    $note->MOMENTO . ' enviado <b>' . Momento($note->FECHA_REGISTRO) . '</b> y finaliza el <b>' . FechaFormal($note->FECHA_CADUCA, false) . '</b>']) ?>
            </div>
        <?php endforeach; ?>
    </div>
    <!-- Notificaxiones de asesorías -->
    <div class="row">
        <?php foreach ($this->seguimientos_model->TraeEvaluacionEstudianteNotificacion(1, 'ap') as $i => $note): ?>
            <div class="col-lg-10">
                <?= Alert(['title' => '¡Acta de asesoría recibida!', 'text' => 'El estudainte <a target="_blank" data-toggle="tooltip" title="Ver practicante" href="practicantes/verpracticante/' . $note->ID_PRACTICANTE . '"><b>' . $note->NOMBRE_PRACTICANTE . '</b></a> ha diligenciado la asesoria de práctica #' . $note->CONSECUTIVO . ' &nbsp&nbsp;' . Momento($note->FECHA_FINALIZA) . '</b>']) ?>
            </div>
        <?php endforeach; ?>
    </div>

    <div class="row">
        <?php foreach ($this->seguimientos_model->TraeEvaluacionEstudianteNotificacion(0, 'ap') as $i => $note): ?>
            <div class="col-lg-10">
                <?= Alert(['icon' => 'ion-clock', 'type' => 'danger', 'title' => 'En espera', 'text' => 'El estudainte <a target="_blank" data-toggle="tooltip" title="Ver practicante" href="practicantes/verpracticante/' . $note->ID_PRACTICANTE . '"><b>' . $note->NOMBRE_PRACTICANTE . '</b></a> aún no ha diligenciado la asesoria de práctica #' . $note->CONSECUTIVO . ' enviada  &nbsp&nbsp; ' . Momento($note->FECHA_REGISTRO) . '</b>']) ?>
            </div>
        <?php endforeach; ?>
    </div>
</section><!-- /.content -->
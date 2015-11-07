<?php
    /**
     * @var $this CI_Loader
     */
    $this->Header(['assets' => ['Bootstraptour']]);
    $per = date('Y-', strtotime($this->session->userdata('PERIODO'))) . (date('m', strtotime($this->session->userdata('PERIODO'))) > 6 ? 2 : 1);
?>
<section class="content-header">
    <h1>Tablero
        <small> Periodo académico
            <b><?= $per ?></b>
        </small>
    </h1>
</section>
<br>
<div class="container">
    <?= $Dashboard ?>
</div>

<?= $this->Footer() ?>

<script>
    // Instance the tour
    var tour = new Tour({
        template: "<div class='popover tour'>" +
        "<div class='arrow'></div>" +
        "<h3 class='popover-title'></h3>" +
        "<div class='popover-content'></div>" +
        "<div class='popover-navigation'>" +
        "<button class='btn btn-warning' data-role='prev'>« Atrás</button>" +
        "<span data-role='separator'> </span>" +
        "<button class='btn btn-success' data-role='next'>Siguiente »</button>" +
        "&nbsp;<button class='btn btn-primary' data-role='end'>Fin</button>" +
        " </div>" +
        "</div>",
        steps: [
            {
                element: "#periodoacademico",
                title: "<i class='green ion-university'></i> <b>Periodo académico</b>",
                content: "<b>!No se pierda entre semestres!</b><br> Aquí prodrá ajustar el periodo académico que necesite y cuando lo necesite. Además, puede visualizar la cantidad de practicantes de cada periodo académico.<br><br>" +
                "<img src='<?=site_url('asesorfotos/tour/periodo.png') ?>' height='135' width='245'>"
            },
            {
                element: "#totalpracticantes",
                title: "<i class='green ion-help-buoy'></i> <b>Total de proyectos</b>",
                content: "Aquí podrá visualizar los proyectos del periodo académico que usted haya seleccionado."
            },
            {
                element: "#totalproyectos",
                title: "<i class='green ion-person-stalker'></i> <b>Total de practicantes</b>",
                content: "Aquí podrá visualizar los practicantes del periodo académico que usted haya seleccionado."
            },
            {
                element: "#horarios",
                title: "<i class='green ios ion-clock'></i> <b>Horarios de asesoría</b>",
                content: "<b>¡Esté siempre al tanto de sus asesorías!</b> visualice todos sus horarios con sus practicantes en esta sección! <br><br>" +
                "<img src='<?=site_url('asesorfotos/tour/horario.png') ?>' height='90' width='245'>"
            },
            {
                element: "#informes",
                title: "<i class='green ion-compose'></i> <b>Informes</b>",
                content: "En esta sección usted podrá gestionar las <span class='green'>actas  de asesoría</span> y crear <span class='green'>gastos de transportes</span>."
            },
            {
                element: "#seguimiento",
                title: "<i class='green ion-arrow-graph-up-right'></i> <b>Seguimiento</b>",
                content: "En esta sección podrá expedir  <span class='green'>certificados de paz y salvo, calificar practicantes, enviar formularios de autoevaluación</span>."
            },
            {
                element: "#cierreprácticas",
                title: "<i class='green ion-android-time'></i> <b>Cierre de prácticas</b>",
                content: "En esta sección podrá diligenciar las cartas a las respectivas dependencias y generar <span class='green'>cierres de prácticas</span>."
            },
            {
                element: "#proyectos",
                title: "<i class='green ion-help-buoy'></i> <b>Proyectos de prácticas</b>",
                content: "En esta sección podrá ver sus <span class='green'>proyectos de prácticas</span> y modificar sus <span class='green'>horarios de asesoría</span> en la semana."
            },
            {
                element: "#documentación",
                title: "<i class='green ion-document'></i> <b>Documentación</b>",
                content: "En esta sección podrá ver la documentación relacionada con la <span class='green'>asesoría de prácticas</span> y el funcionamiento de la aplicación <span class='green'>SDCE</span>"
            },
            {
                element: "#practicantes",
                title: "<i class='green ion-person-stalker'></i> <b>Practicantes</b>",
                content: "En esta sección podrá ver los practicantes que tiene su periodo académico actual (<?=$per ?>)"
            },
            {
                element: "#acerca",
                title: "<i class='green ion-android-contact'></i> <b>Acerca de SDCE</b>",
                content: "¿Cuál es nuestro propósito con SDCE?"
            },
        ]
    });

    // Initialize the tour
    tour.init();

    // Start the tour
    tour.start();
</script>

<style>
    .green
    {
        color: #088951;
        font-weight: bold;
    }
</style>

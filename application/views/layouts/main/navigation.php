<?php
    /**
     * @var $this CI_Loader
     */
    echo Component::Sidebar([
        'options' => ['img' => ['path' => 'public/images/logo.jpg', 'url' => ''], 'header' => 'MENU PRINCIPAL'],
        'items' =>
            [
                ['label' => 'Informes', 'options' => ['icon' => 'fa fa-clipboard'],
                    'items' =>
                        [
                            ['label' => 'Asesoría', 'options' => ['icon' => 'fa fa-th-list'],
                                'items' =>
                                    [
                                        ['label' => 'Enviar asesorías', 'url' => 'informe/enviarasesoriaspractica', 'options' => ['icon' => 'ion-paper-airplane']],
                                        ['label' => 'Asesorías de prácticas', 'url' => 'informe/asesoriapracticas', 'options' => ['icon' => 'fa fa-list-alt']],
                                    ],
                            ],
                            ['label' => 'Gastos de transporte', 'options' => ['icon' => 'fa fa-bus'],
                                'items' =>
                                    [
                                        ['label' => 'Crear Gasto transporte', 'url' => 'informe/creargastostransporte', 'options' => ['icon' => 'ion-android-add']],
                                        ['label' => 'Gastos de transporte', 'url' => 'informe/gastostransporte', 'options' => ['icon' => 'fa fa-list-alt']],
                                    ],
                            ],
                        ],
                ],
                ['label' => 'Seguimiento', 'options' => ['icon' => 'fa fa-location-arrow'],
                    'items' =>
                        [
                            ['label' => 'Certificado paz y salvo', 'url' => 'seguimiento/pazysalvo', 'options' => ['icon' => 'fa fa-check']],
                            ['label' => 'Registro de notas', 'url' => 'seguimiento/registronotas', 'options' => ['icon' => 'fa fa-pencil']],
                            ['label' => 'Seguimiento prácticas', 'options' => ['icon' => 'ion-arrow-graph-up-right'],
                                'items' =>
                                    [
                                        ['label' => 'Seguimiento', 'url' => 'seguimiento/seguimientos', 'options' => ['icon' => 'ion-android-exit']],
                                        ['label' => 'Enviar autoevaluación', 'url' => 'seguimiento/enviarautoevaluacion', 'options' => ['icon' => 'ion-paper-airplane']],
                                        ['label' => 'Calificar practicante', 'url' => 'seguimiento/calificarpracticante', 'options' => ['icon' => 'ion-edit']],
                                        ['label' => 'Eliminar calificación', 'url' => 'seguimiento/eliminarcalificacion', 'options' => ['icon' => 'fa fa-trash']],
                                    ]],
                        ],
                ],
                ['label' => 'Cierre prácticas', 'options' => ['icon' => 'fa fa-clock-o'],
                    'items' =>
                        [
                            ['label' => 'Admisiones y registros', 'options' => ['icon' => 'fa fa-folder-open'],
                                'items' =>
                                    [
                                        ['label' => 'Cierre admisiones y registros', 'url' => 'cierres/admisiones', 'options' => ['icon' => 'fa fa-dot-circle-o']],
                                        ['label' => 'Carta admisiones y registros', 'url' => 'cierres/cartaadmisiones', 'options' => ['icon' => 'ion-compose']],
                                    ]],
                            ['label' => 'CIAD', 'options' => ['icon' => 'fa fa-folder-open'],
                                'items' =>
                                    [
                                        ['label' => 'Cierre CIAD', 'url' => 'cierres/ciad', 'options' => ['icon' => 'fa fa-dot-circle-o']],
                                        ['label' => 'Carta CIAD', 'url' => 'cierres/cartaciad', 'options' => ['icon' => 'ion-compose']],
                                    ]],
                            ['label' => 'Centro prácticas', 'options' => ['icon' => 'fa fa-folder-open'],
                                'items' =>
                                    [
                                        ['label' => 'Cierre centro prácticas', 'url' => 'cierres/centropracticas', 'options' => ['icon' => 'fa fa-dot-circle-o']],
                                        ['label' => 'Carta centro prácticas', 'url' => 'cierres/cartacentropracticas', 'options' => ['icon' => 'ion-compose']],
                                    ]],
                            ['label' => 'Decanatura', 'options' => ['icon' => 'fa fa-folder-open'],
                                'items' =>
                                    [
                                        ['label' => 'Cierre decanatura', 'url' => 'cierres/decanatura', 'options' => ['icon' => 'fa fa-dot-circle-o']],
                                        ['label' => 'Carta decanatura', 'url' => 'cierres/cartadecanatura', 'options' => ['icon' => 'ion-compose']],
                                    ]],
                        ],
                ],
                ['label' => 'Proyectos', 'options' => ['icon' => 'fa fa fa-rocket'],
                    'items' =>
                        [
                            ['label' => 'Horario asesorías', 'url' => 'proyectos/horarios', 'options' => ['icon' => 'ios ion-clock']],
                            ['label' => 'Proyectos', 'url' => 'proyectos', 'options' => ['icon' => 'fa fa-list-alt']],
                        ],
                ],
                ['label' => 'Practicantes', 'url' => 'practicantes', 'options' => ['icon' => 'fa fa-group']],
                ['label' => 'Documentación', 'options' => ['icon' => 'fa fa-book'],
                    'items' =>
                        [
                            ['label' => 'Estructura administrativa', 'url' => 'public/documentacion/eap.pdf', 'options' => ['icon' => 'fa fa-file-pdf-o', 'target' => '_blank']],
                            ['label' => 'Instructivo seguimiento', 'url' => 'public/documentacion/instructivo.pdf', 'options' => ['icon' => 'fa fa-file-pdf-o', 'target' => '_blank']],
                            ['label' => 'Manual de SDCE', 'url' => 'public/documentacion/manualasesor.pdf', 'options' => ['icon' => 'fa fa-file-pdf-o', 'target' => '_blank']],
                        ],
                ],
                ['label' => 'Acerca', 'url' => 'app/acerca', 'options' => ['icon' => 'fa fa-leaf']],
            ],
    ]);
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
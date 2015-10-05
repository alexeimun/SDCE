<?php
    /**
     * @var $this CI_Loader
     */

    echo Component::Sidebar([
        'options' => ['img' => ['path' => 'public/images/logo.jpg', 'url' => ''], 'header' => 'MENU PRINCIPAL'],
        'items' =>
            [
                ['label' => 'Informes', 'url' => 'asesores', 'options' => ['icon' => 'ion-person'],
                    'items' =>
                        [
                            ['label' => 'Asesoría', 'options' => ['icon' => 'ion-android-list'],
                                'items' =>
                                    [
                                        ['label' => 'Enviar formulario', 'url' => 'informe/enviarasesoriaspractica', 'options' => ['icon' => 'ion-paper-airplane']],
                                        ['label' => 'Asesorías prácticas', 'url' => 'informe/asesoriapracticas', 'options' => ['icon' => 'ion-clipboard']],
                                    ],
                            ],
                            ['label' => 'Gastos de transporte', 'options' => ['icon' => 'ion-android-list'],
                                'items' =>
                                    [
                                        ['label' => 'Crear Gasto transporte', 'url' => 'informe/creargastostransporte', 'options' => ['icon' => 'ion-android-add']],
                                        ['label' => 'Gastos transporte', 'url' => 'informe/gastostransporte', 'options' => ['icon' => 'ion-clipboard']],
                                    ],
                            ],
                            ['label' => 'Informe mensual', 'visible' => false, 'options' => ['icon' => 'ion-android-list'],
                                'items' =>
                                    [
                                        ['label' => 'Crear informe mensual', 'url' => 'informe/crearinformemensual', 'options' => ['icon' => 'ion-android-add']],
                                        ['label' => 'Informes mensuales', 'url' => 'informe/informesmensuales', 'options' => ['icon' => 'ion-clipboard']],
                                    ],
                            ],
                        ],
                ],
                ['label' => 'Seguimiento', 'options' => ['icon' => 'ion-arrow-graph-up-right'],
                    'items' =>
                        [
                            ['label' => 'Certificado paz y salvo', 'url' => 'seguimiento/pazysalvo', 'options' => ['icon' => 'ion-checkmark']],
                            ['label' => 'Registro de notas', 'url' => 'seguimiento/registronotas', 'options' => ['icon' => 'glyphicon glyphicon-pencil']],
                            ['label' => 'Seguimiento prácticas',  'options' => ['icon' => 'ion-arrow-graph-up-right'],
                                'items' =>
                                    [
                                        ['label' => 'Seguimiento', 'url' => 'seguimiento/seguimientos', 'options' => ['icon' => 'ion-android-exit']],
                                        ['label' => 'Enviar formularios', 'url' => 'seguimiento/enviarformularios', 'options' => ['icon' => 'ion-paper-airplane']],
                                        ['label' => 'Calificar practicante', 'url' => 'seguimiento/calificarpracticante', 'options' => ['icon' => 'ion-edit']],

                                    ]],
                        ],
                ],
                ['label' => 'Cierre prácticas', 'options' => ['icon' => 'ion-android-time'],
                    'items' =>
                        [
                            ['label' => 'Admisiones y registros', 'options' => ['icon' => 'ion-filing'],
                                'items' =>
                                    [
                                        ['label' => 'Cierre admisiones y registros', 'url' => 'cierres/admisiones', 'options' => ['icon' => 'ion-plus-round']],
                                        ['label' => 'Carta admisiones y registros', 'url' => 'cierres/cartaadmisiones', 'options' => ['icon' => 'ion-compose']],
                                    ]],
                            ['label' => 'CIAD', 'options' => ['icon' => 'ion-filing'],
                                'items' =>
                                    [
                                        ['label' => 'Cierre CIAD', 'url' => 'cierres/ciad', 'options' => ['icon' => 'ion-plus-round']],
                                        ['label' => 'Carta CIAD', 'url' => 'cierres/cartaciad', 'options' => ['icon' => 'ion-compose']],
                                    ]],
                            ['label' => 'Centro prácticas', 'options' => ['icon' => 'ion-filing'],
                                'items' =>
                                    [
                                        ['label' => 'Cierre centro prácticas', 'url' => 'cierres/centropracticas', 'options' => ['icon' => 'ion-plus-round']],
                                        ['label' => 'Carta centro prácticas', 'url' => 'cierres/cartacentropracticas', 'options' => ['icon' => 'ion-compose']],
                                    ]],
                            ['label' => 'Decanatura', 'options' => ['icon' => 'ion-filing'],
                                'items' =>
                                    [
                                        ['label' => 'Cierre decanatura', 'url' => 'cierres/decanatura', 'options' => ['icon' => 'ion-plus-round']],
                                        ['label' => 'Carta decanatura', 'url' => 'cierres/cartadecanatura', 'options' => ['icon' => 'ion-compose']],
                                    ]],
                        ],
                ],
                ['label' => 'Proyectos', 'options' => ['icon' => 'ion-ios-folder'],
                    'items' =>
                        [
                            ['label' => 'Horario proyectos', 'url' => 'proyectos/horarios', 'options' => ['icon' => 'ion-android-calendar']],
                            ['label' => 'Proyectos', 'url' => 'proyectos', 'options' => ['icon' => 'ion-android-list']],
                        ],
                ],
                ['label' => 'Documentación', 'options' => ['icon' => 'ion-document'],
                    'items' =>
                        [
                            ['label' => 'Estructura administrativa', 'url' => 'public/Documentacion/eap.pdf', 'options' => ['icon' => 'ion-document', 'target' => '_blank']],
                            ['label' => 'Instructivo seguimiento', 'url' => 'public/Documentacion/instructivo.pdf', 'options' => ['icon' => 'ion-document', 'target' => '_blank']],
                        ],
                ],
                ['label' => 'Practicantes', 'url' => 'practicantes', 'options' => ['icon' => 'ion-person-stalker']],
                ['label' => 'Parámetros', 'url' => 'parametros', 'options' => ['icon' => 'glyphicon glyphicon-cog']],
                ['label' => 'Acerca', 'url' => 'app/acerca', 'options' => ['icon' => 'ion ion-android-contact']],
            ],
    ]);
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

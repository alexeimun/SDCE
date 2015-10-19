<?php
    /**
     * @var $this CI_Loader
     */
    echo Component::Sidebar([
        'options' => ['img' => ['path' => 'public/images/logo.jpg', 'url' => ''], 'header' => 'MENU PRINCIPAL'],
        'items' =>
            [
                ['label' => 'Asesores', 'options' => ['icon' => 'ion-person-stalker'], 'visible' => $this->rbca->can('asesores', false),
                    'items' =>
                        [
                            ['label' => 'Crear asesor', 'url' => 'asesores/crearasesor', 'options' => ['icon' => 'ion-person-add']],
                            ['label' => 'Listado asesores', 'url' => 'asesores', 'options' => ['icon' => 'ion-android-list']],
                        ],
                ],
                ['label' => 'Agencias', 'options' => ['icon' => 'ion-cube'], 'visible' => $this->rbca->can('agencias', false),
                    'items' =>
                        [
                            ['label' => 'Crear agencia', 'url' => 'agencias/crearagencia', 'options' => ['icon' => 'ion-android-add']],
                            ['label' => 'Listado agencias', 'url' => 'agencias', 'options' => ['icon' => 'ion-clipboard']],
                        ],
                ],
                ['label' => 'Proyectos', 'options' => ['icon' => 'ion-help-buoy'], 'visible' => $this->rbca->can('proyectos', false),
                    'items' =>
                        [
                            ['label' => 'Tipos de proyectos', 'options' => ['icon' => 'ion-funnel'],
                                'items' =>
                                    [
                                        ['label' => 'Crear tipo de proyecto', 'url' => 'proyectos/creartipoproyecto', 'options' => ['icon' => 'ion-android-add']],
                                        ['label' => 'Listado tipo proyectos', 'url' => 'proyectos/tipoproyectos', 'options' => ['icon' => 'ion-clipboard']],
                                    ],
                            ],
                            ['label' => 'Crear proyecto', 'url' => 'proyectos/crearproyecto', 'options' => ['icon' => 'ion-android-add']],
                            ['label' => 'Listado proyectos', 'url' => 'proyectos', 'options' => ['icon' => 'ion-clipboard']],
                        ],
                ],
                ['label' => 'Cooperadores', 'options' => ['icon' => 'ion-ios-people'], 'visible' => $this->rbca->can('cooperadores', false),
                    'items' =>
                        [
                            ['label' => 'Crear cooperador', 'url' => 'cooperadores/crearcooperador', 'options' => ['icon' => 'ion-person-add']],
                            ['label' => 'Listado cooperadores', 'url' => 'cooperadores', 'options' => ['icon' => 'ion-clipboard']],
                        ],
                ],
                ['label' => 'Practicantes', 'url' => 'practicantes', 'options' => ['icon' => 'ion-person-stalker'], 'visible' => $this->rbca->can('practicantes', false),
                    'items' =>
                        [
                            ['label' => 'Crear practicante', 'url' => 'practicantes/crearpracticante', 'options' => ['icon' => 'ion-person-add']],
                            ['label' => 'Listado practicantes', 'url' => 'practicantes', 'options' => ['icon' => 'ion-clipboard']],
                        ],
                ],
                ['label' => 'Usuarios', 'url' => 'usuarios', 'options' => ['icon' => 'ion-person-stalker'], 'visible' => $this->rbca->can('usuarios', false),
                    'items' =>
                        [
                            ['label' => 'Crear usuario', 'url' => 'usuarios/crearusuario', 'options' => ['icon' => 'ion-person-add']],
                            ['label' => 'Listado usuarios', 'url' => 'usuarios', 'options' => ['icon' => 'ion-clipboard']],
                        ],
                ],
                ['label' => 'Parámetros', 'url' => 'parametros', 'options' => ['icon' => 'ion-android-options'], 'visible' => $this->rbca->can('parámetros', false)],
                ['label' => 'Acerca', 'url' => 'app/acerca', 'options' => ['icon' => 'ion ion-android-contact']],
            ],
    ]);
?>
<div class="content-wrapper">
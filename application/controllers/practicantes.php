<?php

    class Practicantes extends CI_Controller
    {
        private $actions = 'duv';

        function __construct()
        {
            parent::__construct();
            $action = @explode('/', uri_string())[1];

            if($this->session->userdata('ASESOR'))
            {
                if($action == 'verpracticante')
                {
                }
                else if(empty($action))
                {
                    $this->actions = 'v';
                }
                else
                {
                    redirect(site_url(), 'refresh');
                }
            }
            else if($this->session->userdata('ADMIN') && !$this->rbca->can('practicantes',false))
            {
                redirect(site_url(), 'refresh');
            }
            else if(!$this->session->userdata('ADMIN'))
            {
                redirect(site_url(), 'refresh');
            }

            $this->load->model(['practicantes_model', 'agencias_model', 'proyectos_model', 'cooperadores_model', 'seguimientos_model']);
        }

        public function index()
        {
            $this->load->view('Practicantes/Practicantes');
        }

        public function crearpracticante()
        {
            if($this->input->is_ajax_request())
            {
                $this->practicantes_model->InsertarPracticante();
            }
            else
            {
                $this->load->view('Practicantes/CrearPracticante', [
                    'Proyectos' => Dropdown(['name' => 'ID_PROYECTO', 'dataProvider' => $this->proyectos_model->TraeProyectosDD(),
                        'placeholder' => '-- Seleccione un proyecto --', 'fields' => ['NOMBRE_PROYECTO']]),
                    'Agencias' => Dropdown(['name' => 'ID_AGENCIA', 'dataProvider' => $this->agencias_model->TraeAgenciasDD(),
                        'placeholder' => '-- Seleccione una agencia--', 'fields' => ['NOMBRE_AGENCIA']]),
                    'Cooperadores' => Dropdown(['name' => 'ID_COOPERADOR', 'dataProvider' => $this->cooperadores_model->TraeCooperadoresDD(),
                        'placeholder' => '-- Seleccione un cooperador--', 'fields' => ['NOMBRE_COOPERADOR']]),
                ]);
            }
        }

        public function actualizarpracticante($Id = null)
        {
            if($this->input->is_ajax_request())
            {
                $this->practicantes_model->ActualizarPracticante();
            }
            else if(is_numeric($Id))
            {
                $Data = $this->practicantes_model->TraePracticante($Id);

                if($Data != null)
                {
                    $this->load->view('Practicantes/ActualizarPracticante', [
                        'Asesores' => Dropdown(['name' => 'ID_ASESOR', 'index' => $Data->ID_ASESOR, 'dataProvider' => $this->usuarios_model->TraeAsesoresDD(),
                            'placeholder' => '-- Seleccione un asesor --', 'fields' => ['NOMBRE']]),
                        'Proyectos' => Dropdown(['name' => 'ID_PROYECTO', 'index' => $Data->ID_PROYECTO, 'dataProvider' => $this->proyectos_model->TraeProyectosDD(),
                            'placeholder' => '-- Seleccione un proyecto --', 'fields' => ['NOMBRE_PROYECTO']]),
                        'Agencias' => Dropdown(['name' => 'ID_AGENCIA', 'index' => $Data->ID_AGENCIA, 'dataProvider' => $this->agencias_model->TraeAgenciasDD(),
                            'placeholder' => '-- Seleccione una agencia-- ', 'fields' => ['NOMBRE_AGENCIA']]), 'Info' => $Data,
                        'Cooperadores' => Dropdown(['name' => 'ID_COOPERADOR', 'index' => $Data->ID_COOPERADOR, 'dataProvider' => $this->cooperadores_model->TraeCooperadoresDD(),
                            'placeholder' => '-- Seleccione un cooperador--', 'fields' => ['NOMBRE_COOPERADOR']]),
                    ]);
                }
                else
                {
                    redirect(site_url(), 'refresh');
                }
            }
            else
            {
                redirect(site_url(), 'refresh');
            }
        }

        public function verpracticante($Id)
        {
            if(is_numeric($Id))
            {
                $Data = $this->practicantes_model->TraePracticante($Id);

                if($Data != null)
                {
                    $this->load->view('Practicantes/VerPracticante', [
                        'Asesores' => Dropdown(['name' => 'ID_ASESOR', 'readonly' => true, 'index' => $Data->ID_ASESOR, 'dataProvider' => $this->usuarios_model->TraeAsesoresDD(),
                            'placeholder' => '-- Seleccione un asesor --', 'fields' => ['NOMBRE']]),
                        'Proyecto' => $this->proyectos_model->TraeProyectosDD($Data->ID_PROYECTO),
                        'Agencias' => Dropdown(['name' => 'ID_AGENCIA', 'readonly' => true, 'index' => $Data->ID_AGENCIA, 'dataProvider' => $this->agencias_model->TraeAgenciasDD($Id),
                            'placeholder' => '-- Seleccione una agencia-- ', 'fields' => ['NOMBRE_AGENCIA']]), 'Info' => $Data,
                        'Cooperadores' => Dropdown(['name' => 'ID_COOPERADOR', 'readonly' => true, 'index' => $Data->ID_COOPERADOR, 'dataProvider' => $this->cooperadores_model->TraeCooperadoresDD(),
                            'placeholder' => '-- Seleccione un cooperador--', 'fields' => ['NOMBRE_COOPERADOR']]),
                    ]);
                }
                else
                {
                    redirect(site_url(), 'refresh');
                }
            }
            else
            {
                redirect(site_url(), 'refresh');
            }
        }

        public function traeCooperadoresAgenciaAjax()
        {
            if($this->input->is_ajax_request())
            {
                echo select_input(['select' => Dropdown(['name' => 'ID_COOPERADOR', 'dataProvider' => $this->practicantes_model->TraeCooperadoresAgencia(),
                    'placeholder' => '-- Seleccione un cooperador--', 'fields' => ['NOMBRE_COOPERADOR']]), 'text' => 'Cooperador']);
            }
            else
            {
                redirect(site_url(), 'refresh');
            }
        }

        public function eliminarpracticante()
        {
            if($this->input->is_ajax_request())
            {
                $this->practicantes_model->EliminarPracticante();
            }
            else
            {
                redirect(site_url(), 'refresh');
            }
        }
    }
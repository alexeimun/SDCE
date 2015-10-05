<?php

    class Agencias extends CI_Controller
    {
        function __construct()
        {
            parent::__construct();

            if(!$this->session->userdata('ADMIN'))
            {
                redirect(site_url(), 'refresh');
            }

            $this->load->model(['agencias_model']);
        }

        public function index()
        {
            $this->load->view('Agencias/Agencias');
        }

        public function crearagencia()
        {
            if(!empty($_POST))
            {
                $this->agencias_model->InsertarAgencia();
            }
            else
            {
                $this->load->view('Agencias/CrearAgencia',
                    ['Ciudades' => Dropdown(['name' => 'ID_CIUDAD', 'dataProvider' => $this->agencias_model->TraeCiudades(),
                        'placeholder' => '-- Seleccione una ciudad-- ', 'fields' => ['NOMBRE', 'tag' => ' - ', 'DEPARTAMENTO']])]);
            }
        }

        public function actualizaragencia($Id = null)
        {
            if(!empty($_POST))
            {
                $this->agencias_model->ActualizarAgencia();
            }
            else if(is_numeric($Id))
            {
                $Data = $this->agencias_model->TraeAgencia($Id);

                if($Data != null)
                {
                    $this->load->view('Agencias/ActualizarAgencia', ['Ciudades' => Dropdown(['name' => 'ID_CIUDAD', 'index' => $Data->ID_CIUDAD,
                        'dataProvider' => $this->agencias_model->TraeCiudades(),
                        'placeholder' => '-- Seleccione una ciudad-- ', 'fields' => ['NOMBRE', 'tag' => ' - ', 'DEPARTAMENTO']]), 'Info' => $Data]);
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

        public function veragencia($Id)
        {
            if(is_numeric($Id))
            {
                $Data = $this->agencias_model->TraeAgencia($Id);

                if($Data != null)
                {
                    $this->load->view('Agencias/VerAgencia', ['Ciudades' => Dropdown(['name' => 'ID_CIUDAD', 'readonly' => true, 'index' => $Data->ID_CIUDAD,
                        'dataProvider' => $this->agencias_model->TraeCiudades(),
                        'placeholder' => '-- Seleccione una ciudad-- ', 'fields' => ['NOMBRE', 'tag' => ' - ', 'DEPARTAMENTO']]), 'Info' => $Data]);
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

        public function eliminaragencia()
        {
            if(!empty($_POST))
            {
                $this->agencias_model->EliminarAgencia();
            }
            else
            {
                redirect(site_url(), 'refresh');
            }
        }
    }
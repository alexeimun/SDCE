<?php

    class Parametros extends CI_Controller
    {
        function __construct()
        {
            parent::__construct();

            $this->load->model('parametros_model');
        }

        public function index()
        {
            if($this->input->is_ajax_request())
            {
                if($this->session->userdata('ASESOR'))
                {
                    $this->parametros_model->InsertaPeriodo();
                }
                else if($this->session->userdata('ADMIN'))
                {
                    $this->parametros_model->ActualizarDependencias();
                }
            }
            else if($this->session->userdata('ASESOR'))
            {
                $this->load->view('Parametros/Parametros', ['Periodo' => $this->parametros_model->CrearPeriodoComponente(2015)]);
            }
            else if($this->session->userdata('ADMIN'))
            {
                $this->load->view('Parametros/ParametrosAdmin', ['Info' => $this->parametros_model->TraeDependencias()]);
            }
            else
            {
                show_404();
            }
        }
    }
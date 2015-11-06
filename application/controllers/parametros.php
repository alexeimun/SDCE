<?php

    class Parametros extends CI_Controller
    {
        function __construct()
        {
            parent::__construct();
            if($this->session->userdata('ADMIN'))
            {
                $this->rbca->can('parámetros');
            }
        }

        public function index()
        {
            if($this->input->is_ajax_request())
            {
                $this->parametros_model->ActualizarDependencias();
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

        public function CambiarPeriodoAcdemicoAjax()
        {
            if($this->input->is_ajax_request())
            {
                $this->parametros_model->CambiarPeriodoAcdemicoAjax();
            }
            else
            {
                show_404();
            }
        }
    }
<?php

    class Cooperadores extends CI_Controller
    {
        function __construct()
        {
            parent::__construct();

            $this->rbca->can('cooperadores');

            $this->load->model(['cooperadores_model', 'agencias_model']);
        }

        public function index()
        {
            $this->load->view('Cooperadores/Cooperadores');
        }

        public function crearcooperador()
        {
            if($this->input->is_ajax_request())
            {
                $this->cooperadores_model->InsertarCooperador();
            }
            else
            {
                $this->load->view('Cooperadores/CrearCooperador');
            }
        }

        public function actualizarcooperador($Id=null)
        {
            if($this->input->is_ajax_request())
            {
                $this->cooperadores_model->ActualizarCooperador();
            }
            else if(is_numeric($Id))
            {
                $Data = $this->cooperadores_model->TraeCooperador($Id);

                if($Data != null)
                {
                    $this->load->view('Cooperadores/ActualizarCooperador', ['Info' => $Data]);
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

        public function vercooperador($Id)
        {
            if(is_numeric($Id))
            {
                $Data = $this->cooperadores_model->TraeCooperador($Id);

                if($Data != null)
                {
                    $this->load->view('Cooperadores/VerCooperador', ['Info' => $Data]);
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

        public function eliminarcooperador()
        {
            if($this->input->is_ajax_request())
            {
                $this->cooperadores_model->EliminarCooperador();
            }
            else
            {
                redirect(site_url(), 'refresh');
            }
        }
    }
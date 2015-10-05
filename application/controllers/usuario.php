<?php

    class Usuario extends CI_Controller
    {
        function __construct()
        {
            parent::__construct();

            if($this->input->is_ajax_request())
            {

            }
            else if(!$this->session->userdata('ADMIN'))
            {
                redirect(site_url(), 'refresh');
            }
        }

        public function index()
        {
            $this->load->view('Asesores/Asesores');
        }

        public function crearasesor()
        {
            if(!empty($_POST))
            {
                $this->usuarios_model->InsertarAsesor();
            }
            else
            {
                $this->load->view('Asesores/CrearAsesor');
            }
        }

        public function actualizarasesor($Id = null)
        {
            if($this->input->is_ajax_request())
            {
                $this->usuarios_model->ActualizarAsesor();
            }
            else if(is_numeric($Id))
            {
                $Data = $this->usuarios_model->TraeAsesor($Id);

                if($Data != null)
                {
                    $this->load->view('Asesores/ActualizarAsesor', ['Info' => $Data]);
                }
            }
            else
            {
                redirect(site_url(), 'refresh');
            }
        }

        public function VerAsesor($Id)
        {
            if(is_numeric($Id))
            {
                $this->load->model('practicantes_model');
                $Data = $this->usuarios_model->TraeAsesor($Id);
                if($Data != null)
                {
                    $this->load->view('Asesores/VerAsesor', ['Info' => $Data]);
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

        public function EliminarAsesor()
        {
            if($this->input->is_ajax_request())
            {
                $this->usuarios_model->EliminaAsesor();
            }
            else
            {
                redirect(site_url(), 'refresh');
            }
        }
    }
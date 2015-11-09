<?php

    class Noticias extends CI_Controller
    {
        function __construct()
        {
            parent::__construct();

            $this->load->model(['usuarios_model', 'parametros_model']);
        }

        public function index()
        {
            if(!$this->session->userdata('ADMIN'))
            {
                redirect(site_url(), 'refresh');
            }

            if($this->input->is_ajax_request())
            {
                $this->parametros_model->EnviarNoticiasYMensajes();
            }
            else
            {
                $this->load->view('Noticias/Noticias');
            }
        }

        public function vernoticia($id)
        {
            if(is_numeric($id) && $this->session->userdata('ID_USUARIO'))
            {
                $Data = $this->parametros_model->TraeNoticia($id);
                if(!is_null($Data))
                {
                    $this->load->view('Noticias/VerNoticia', ['Info' => $Data]);
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
    }
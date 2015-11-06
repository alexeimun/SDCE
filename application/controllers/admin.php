<?php

    class Admin extends CI_Controller
    {
        public $Data = [];

        function __construct()
        {
            parent::__construct();
        }

        public function index()
        {
            if($this->session->userdata('ADMIN'))
            {
                $this->load->view('Admin/Inicio/Inicio', $this->Data);
            }
            else if(!$this->session->userdata('ASESOR'))
            {
                $this->load->view('Admin/Inicio/Login');
            }
            else
            {
                redirect(site_url(), 'refresh');
            }
        }
    }
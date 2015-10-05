<?php

    class validaciones extends CI_Controller
    {
        function __construct()
        {
            parent::__construct();

            if(empty($_POST))
            {
                redirect(site_url(), 'refresh');
            }
            $this->load->model('validaciones_model');
        }

        public function ValidaCampos()
        {
            echo $this->validaciones_model->ValidaCampos() ? 'no' : 'ok';
        }
    }
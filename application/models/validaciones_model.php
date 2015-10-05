<?php

    Class validaciones_model extends CI_Model
    {
        public function __construct()
        {
            parent::__construct();
        }

        public function ValidaCampos()
        {
            if($this->input->post('PERSONA') == 'Asesor')
            {
                if($this->input->post('CORREO'))
                {
                    return $this->db->query("SELECT CORREO FROM t_usuarios WHERE CORREO='" . $this->input->post('CORREO') . "'")->num_rows() > 0;
                }
                else if($this->input->post('DOCUMENTO'))
                {
                    return $this->db->query('SELECT DOCUMENTO FROM t_usuarios WHERE DOCUMENTO=' . $this->input->post('DOCUMENTO'))->num_rows() > 0;
                }
            }
            else if($this->input->post('PERSONA') == 'Practicante')
            {
                if($this->input->post('CORREO'))
                {
                    return $this->db->query("SELECT CORREO_PRACTICANTE FROM t_practicantes WHERE CORREO_PRACTICANTE='" . $this->input->post('CORREO') . "'")->num_rows() > 0;
                }
                else if($this->input->post('DOCUMENTO'))
                {
                    return $this->db->query('SELECT DOCUMENTO FROM t_practicantes WHERE DOCUMENTO=' . $this->input->post('DOCUMENTO'))->num_rows() > 0;
                }
            }
        }
    }
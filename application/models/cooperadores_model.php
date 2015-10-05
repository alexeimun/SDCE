<?php

    Class cooperadores_model extends CI_Model
    {
        public function __construct()
        {
            parent::__construct();
        }

        public function TraeCooperador($IdCooperador)
        {
            return @$this->db->query("SELECT
              ID_COOPERADOR,
              ID_AGENCIA,
              NOMBRE_COOPERADOR,
              CORREO_COOPERADOR,
              TELEFONO_COOPERADOR,
              DIRECCION_COOPERADOR,
              FECHA_REGISTRO,
              CARGO

               FROM t_cooperadores

                WHERE  ID_COOPERADOR=$IdCooperador LIMIT 1")->result()[0];
        }

        public function ContarCooperadores()
        {
            return $this->db->query("SELECT COUNT(ID_COOPERADOR) AS COOPERADORS FROM t_cooperadores")->result()[0];
        }

        public function InsertarCooperador()
        {
            $this->db->set('FECHA_REGISTRO', 'NOW()', false);
            $this->db->insert('t_cooperadores', $this->input->post(null, true));
        }

        public function EliminarCooperador()
        {
            $this->db->delete('t_cooperadores', ['ID_COOPERADOR' => $this->input->post('Id')]);
        }

        public function ActualizarCooperador()
        {
            $Idcooperador = array_shift($_POST);
            $this->db->update('t_cooperadores', $this->input->post(null, true), ['ID_COOPERADOR' => $Idcooperador]);
        }

        public function TraeCooperadores()
        {
            return $this->db->query("SELECT
             ID_COOPERADOR,
             ID_AGENCIA,
              NOMBRE_COOPERADOR,
              CORREO_COOPERADOR,
              TELEFONO_COOPERADOR,
              DIRECCION_COOPERADOR,
              CARGO

             FROM t_cooperadores")->result('array');
        }

        public function TraeCooperadoresDD()
        {
            return @$this->db->query("SELECT DISTINCT
             t_cooperadores.ID_COOPERADOR,
             t_cooperadores.NOMBRE_COOPERADOR

             FROM t_cooperadores")->result('array');
        }
    }
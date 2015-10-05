<?php

    Class agencias_model extends CI_Model
    {
        public function __construct()
        {
            parent::__construct();
        }
        public function TraeCiudades()
        {
            return @$this->db->query('SELECT t_ciudades.ID_CIUDAD,
            CONCAT(UPPER(LEFT(t_ciudades.NOMBRE, 1)), LOWER(SUBSTRING(t_ciudades.NOMBRE, 2))) AS NOMBRE,
            CONCAT(UPPER(LEFT(t_ciudades.DEPARTAMENTO, 1)), LOWER(SUBSTRING(t_ciudades.DEPARTAMENTO, 2)))AS DEPARTAMENTO
            FROM
            t_ciudades
            ORDER BY NOMBRE')->result('array');
        }

        public function TraeAgencia($IdAgencia)
        {
            return @$this->db->query("SELECT
              ID_AGENCIA,
              t_ciudades.ID_CIUDAD,
              t_ciudades.NOMBRE NOMBRE_CUIDAD,
              NOMBRE_AGENCIA,
              CORREO_AGENCIA,
              TELEFONO1,
              TELEFONO2,
              FAX,
              PAGINA_WEB,
              DIRECCION,
              FECHA_REGISTRO

               FROM t_agencias
               INNER JOIN t_ciudades USING (ID_CIUDAD)

                WHERE  ID_AGENCIA=$IdAgencia LIMIT 1")->result()[0];
        }

        public function ContarAgencias()
        {
            return $this->db->query("SELECT COUNT(ID_AGENCIA) AS AGENCIAS FROM t_agencias")->result()[0];
        }

        public function InsertarAgencia()
        {
            $this->db->set('FECHA_REGISTRO', 'NOW()', false);
            $this->db->set('ID_ASESOR', $this->session->userdata('ID_USUARIO'));
            $this->db->insert('t_agencias', $this->input->post(null, true));
        }

        public function EliminarAgencia()
        {
            $this->db->delete('t_agencias', ['ID_AGENCIA' => $this->input->post('Id')]);
        }

        public function ActualizarAgencia()
        {
            $Idagencia = array_shift($_POST);
            $this->db->update('t_agencias', $this->input->post(null, true), ['ID_AGENCIA' => $Idagencia]);
        }

        public function TraeAgencias()
        {
            return $this->db->query("SELECT
             ID_AGENCIA,
              NOMBRE_AGENCIA,
              CORREO_AGENCIA,
              TELEFONO1,
              TELEFONO2,
              DIRECCION,
              FECHA_REGISTRO

             FROM t_agencias")->result('array');
        }

        public function TraeAgenciasDD()
        {
            return @$this->db->query("SELECT DISTINCT
             t_agencias.ID_AGENCIA,
             t_agencias.NOMBRE_AGENCIA

             FROM t_agencias")->result('array');
        }
    }
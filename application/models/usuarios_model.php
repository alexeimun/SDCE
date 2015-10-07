<?php

    Class usuarios_model extends CI_Model
    {
        public function __construct()
        {
            parent::__construct();
        }

        public function TraeAsesor($IdAsesor)
        {
            return @$this->db->query("SELECT
                ID_USUARIO,
                CLAVE,
                FOTO,
                NOMBRE,
                CORREO,
                CELULAR,
                DOCUMENTO,
                TELEFONO,
                FECHA_REGISTRO

               FROM t_usuarios

                WHERE ESTADO=1 AND ID_USUARIO=$IdAsesor LIMIT 1")->result()[0];
        }

        private function Clean($value)
        {
            return str_replace('"', '', str_replace("'", '', str_replace("\\", '', $value)));
        }

        public function ValidarCredenciales($usuario, $clave, $nivel)
        {

            $query = $this->db->query("SELECT * FROM t_usuarios WHERE CORREO='" . $this->Clean($usuario) . "'
            AND NIVEL=" . $this->Clean($nivel) . " AND CLAVE = '" . $this->Clean($clave) . "' LIMIT 1");

            if($query->num_rows() == 1)
            {
                return $query->result();
            }
            else
            {
                return null;
            }
        }

        public function ActualizarAsesor()
        {
            $Idasesor = array_shift($_POST);
            $this->session->set_userdata($this->input->post(null, true));
            $this->db->update('t_usuarios', $this->input->post(null, true), ['ID_USUARIO' => $Idasesor]);
        }

        public function ActualizarFotoAsesor($Foto)
        {
            $this->db->update('t_usuarios', ['FOTO' => $Foto], ['ID_USUARIO' => $this->session->userdata('ID_USUARIO')]);
        }

        public function EliminaFotoAnteriorAsesor()
        {
            $Foto = $this->db->query("SELECT
            FOTO
             FROM t_usuarios WHERE ESTADO=1 AND ID_USUARIO=" . $this->session->userdata('ID_USUARIO') . " LIMIT 1")->result()[0]->FOTO;
            if(!is_null($Foto))
            {
                unlink(APPPATH . '../asesorfotos/' . $Foto);
            }
        }

        public function ContarAsesores()
        {
            return $this->db->query('SELECT COUNT(ID_USUARIO) ASESORES FROM t_usuarios WHERE ESTADO=1 AND NIVEL=0 LIMIT  1')->result()[0]->ASESORES;
        }

        public function InsertarAsesor()
        {
            $this->db->set('PERIODO', date('m') > 6 ? date('Y-07-01') : date('Y-01-01'));
            $this->db->set('CLAVE', 'Sdce' . date('Y'));
            $this->db->set('FECHA_REGISTRO', 'NOW()', false);
            $this->db->insert('t_usuarios', $this->input->post(null, true));
        }

        public function EliminaAsesor()
        {
            $this->db->update('t_usuarios', ['ESTADO' => 0], ['ID_USUARIO' => $this->input->post('Id')]);
        }

        public function ActualizarInicioSesion()
        {
            $this->db->set('FACHA_ULTIMO_INICIO_SESION', 'NOW()', false);
            return $this->db->update('t_usuarios', null, ['ID_USUARIO' => $this->session->userdata('ID_USUARIO')]);
        }

        public function TraeAsesores()
        {
            return $this->db->query('
            SELECT
		    t_usuarios.ID_USUARIO,
		    t_usuarios.NOMBRE,
		    t_usuarios.FOTO,
		    t_usuarios.CORREO,
		    t_usuarios.FACHA_ULTIMO_INICIO_SESION,
		    t_usuarios.FECHA_REGISTRO,
            count(t_practicantes.ID_PRACTICANTE) PRACTICANTES
			FROM t_usuarios
			LEFT JOIN t_practicantes ON t_practicantes.ID_ASESOR=t_usuarios.ID_USUARIO AND t_practicantes.ESTADO=1
			WHERE t_usuarios.ESTADO=1 AND NIVEL=0 GROUP BY t_usuarios.ID_USUARIO ORDER BY ID_USUARIO DESC ')->result('array');
        }

        public function TraeUltimoInicioSesionAdmin()
        {
            $this->db->select('FACHA_ULTIMO_INICIO_SESION');
            return @Momento($this->db->get_where('t_usuarios', ['NIVEL' => 1], 1)->result()[0]->FACHA_ULTIMO_INICIO_SESION);
        }

        public function TraeAsesoresDD()
        {
            return @$this->db->query("SELECT DISTINCT
             ID_USUARIO ID_ASESOR,
             NOMBRE

             FROM t_usuarios
             WHERE NIVEL=0")->result('array');
        }
    }
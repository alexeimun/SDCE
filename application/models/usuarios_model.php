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
				user1.ID_USUARIO,
				user1.CLAVE,
				user1.NOMBRE,
				user1.TELEFONO,
				user1.FACHA_ULTIMO_INICIO_SESION,
				user1.DOCUMENTO,
				user1.CELULAR,
				user1.FOTO,
				t_usuarios.NOMBRE NOMBRE_USUARIO_MODIFICA,
				user1.CORREO,
				user1.FECHA_REGISTRO,
				user1.FECHA_MODIFICA,
				t_usuarios.ID_USUARIO_MODIFICA ID

			 FROM t_usuarios user1
			 INNER JOIN t_usuarios ON t_usuarios.ID_USUARIO= user1.ID_USUARIO_MODIFICA
				WHERE user1.ESTADO=1 AND user1.NIVEL = 0 AND user1.ID_USUARIO=$IdAsesor LIMIT 1")->result()[0];
        }

        public function TraeUsuario($IdUsuario)
        {
            return @$this->db->query("SELECT
				user1.ID_USUARIO,
				user1.CLAVE,
				user1.NOMBRE,
				t_usuarios.NOMBRE NOMBRE_USUARIO_MODIFICA,
				user1.CORREO,
				user1.FECHA_REGISTRO,
				user1.FECHA_MODIFICA,
				user1.NIVEL,
				t_usuarios.ID_USUARIO_MODIFICA ID

			 FROM t_usuarios user1
			 INNER JOIN t_usuarios ON t_usuarios.ID_USUARIO= user1.ID_USUARIO_MODIFICA
				WHERE user1.ESTADO=1 AND user1.NIVEL > 0 AND user1.ID_USUARIO=$IdUsuario LIMIT 1")->result()[0];
        }

        public function ValidarCredenciales($usuario, $clave, $nivel)
        {
            $super = $nivel == 1 ? 2 : 0;
            $query = $this->db->query("SELECT * FROM t_usuarios WHERE CORREO='" . CleanSql($usuario) . "'
            AND (NIVEL=" . CleanSql($nivel) . " OR NIVEL=$super) AND CLAVE = '" . CleanSql($clave) . "' LIMIT 1");

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
            $this->db->set('FECHA_MODIFICA', 'NOW()', false);
            $this->db->set('ID_USUARIO_MODIFICA', $this->session->userdata('ID_USUARIO'));
            $this->session->set_userdata($this->input->post(null, true));
            $this->db->update('t_usuarios', $this->input->post(null, true), ['ID_USUARIO' => $Idasesor]);
        }

        public function ActualizarUsuario()
        {
            $permisos = $_POST['PERMISOS'];
            unset($_POST['PERMISOS']);
            $IdUsuario = array_shift($_POST);
            $this->db->set('FECHA_MODIFICA', 'NOW()', false);
            $this->db->set('ID_USUARIO_MODIFICA', $this->session->userdata('ID_USUARIO'));
            $this->db->update('t_usuarios', $this->input->post(null, true), ['ID_USUARIO' => $IdUsuario]);
            $this->InsertarPermisos($permisos, $IdUsuario);
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

        public function ContarUsuarios()
        {
            return $this->db->query('SELECT COUNT(ID_USUARIO) USUARIOS FROM t_usuarios WHERE ESTADO=1 AND NIVEL>0 LIMIT  1')->result()[0]->USUARIOS;
        }

        public function InsertarAsesor()
        {
            $this->db->set('FECHA_MODIFICA', 'NOW()', false);
            $this->db->set('ID_USUARIO_MODIFICA', $this->session->userdata('ID_USUARIO'));
            $this->db->set('PERIODO', date('m') > 6 ? date('Y-07-01') : date('Y-01-01'));
            $this->db->set('CLAVE', 'Sdce' . date('Y'));
            $this->db->set('FECHA_REGISTRO', 'NOW()', false);
            $this->db->insert('t_usuarios', $this->input->post(null, true));
        }

        public function InsertarUsuario()
        {
            $permisos = $_POST['PERMISOS'];
            unset($_POST['PERMISOS']);
            $this->db->set('NIVEL', 1);
            $this->db->set('FECHA_MODIFICA', 'NOW()', false);
            $this->db->set('ID_USUARIO_MODIFICA', $this->session->userdata('ID_USUARIO'));
            $this->db->set('FECHA_REGISTRO', 'NOW()', false);
            $this->db->insert('t_usuarios', $this->input->post(null, true));
            $this->db->select_max('ID_USUARIO');
            $id = $this->db->get('t_usuarios')->result()[0]->ID_USUARIO;
            $this->InsertarPermisos($permisos, $id);
        }

        private function InsertarPermisos($permisos, $id)
        {
            $Items = [];
            foreach ($permisos as $i => $permiso)
            {
                $Items[] =
                    [
                        'item_name' => $permiso,
                        'user_id' => $id,
                    ];
            }
            $this->db->delete('t_auth_assignment', ['user_id' => $id]);
            $this->db->insert_batch('t_auth_assignment', $Items);
        }

        public function TraePermiso($item, $user_id)
        {
            $this->db->select('item_name');
            $this->db->where('item_name', $item);
            $this->db->where('user_id', $user_id);
            return $this->db->get('t_auth_assignment')->num_rows() > 0;
        }

        public function EliminarUsuario()
        {
            $this->db->update('t_usuarios', ['ESTADO' => 0], ['ID_USUARIO' => $this->input->post('Id')]);
        }

        public function ActualizarInicioSesion()
        {
            $this->db->set('FACHA_ULTIMO_INICIO_SESION', 'NOW()', false);
            $this->db->update('t_usuarios', ['LOG_IN' => 1], ['ID_USUARIO' => $this->session->userdata('ID_USUARIO')]);
        }

        public function Lougout()
        {
            $this->db->update('t_usuarios', ['LOG_IN' => 0], ['ID_USUARIO' => $this->session->userdata('ID_USUARIO')]);
        }

        public function TraeAsesores()
        {
            return $this->db->query('
            SELECT DISTINCT
		    t_usuarios.ID_USUARIO,
		    t_usuarios.NOMBRE,
		    t_usuarios.FOTO,
		    t_usuarios.CORREO,
		    t_usuarios.NIVEL,
		    t_usuarios.FACHA_ULTIMO_INICIO_SESION,
		    t_usuarios.FECHA_REGISTRO,
            count(t_practicantes.ID_PRACTICANTE) PRACTICANTES,
            count(t_proyectos.ID_PROYECTO) PROYECTOS
			FROM t_usuarios
			LEFT JOIN t_proyectos ON t_proyectos.ID_ASESOR=t_usuarios.ID_USUARIO
			LEFT JOIN t_practicantes ON t_practicantes.ID_PROYECTO=t_proyectos.ID_PROYECTO

			WHERE t_usuarios.ESTADO=1 AND NIVEL=0 GROUP BY t_usuarios.ID_USUARIO ORDER BY ID_USUARIO DESC')->result('array');
        }

        public function TraeTodoUsuarios()
        {
            return $this->db->query('
            SELECT
		    t_usuarios.ID_USUARIO,
		    t_usuarios.NOMBRE,
		    t_usuarios.FOTO,
		    t_usuarios.NIVEL,
		    t_usuarios.FECHA_REGISTRO

			FROM t_usuarios
			WHERE t_usuarios.ESTADO=1 AND NIVEL!=2 GROUP BY t_usuarios.ID_USUARIO ORDER BY ID_USUARIO DESC')->result('array');
        }

        public function TraeTodoUsuariosLogin()
        {
            return $this->db->query('
            SELECT
		    t_usuarios.ID_USUARIO,
		    t_usuarios.NOMBRE,
		    t_usuarios.FOTO,
		    t_usuarios.NIVEL,
		    t_usuarios.CORREO,
		    t_usuarios.FACHA_ULTIMO_INICIO_SESION,
		    t_usuarios.LOG_IN

			FROM t_usuarios
			WHERE t_usuarios.ESTADO=1 GROUP BY t_usuarios.ID_USUARIO ORDER BY ID_USUARIO DESC ')->result('array');
        }

        public function TraeUsuarios()
        {
            return $this->db->query('
            SELECT
		    t_usuarios.ID_USUARIO,
		    t_usuarios.NOMBRE,
		    t_usuarios.CORREO,
		    t_usuarios.NIVEL,
		    t_usuarios.FACHA_ULTIMO_INICIO_SESION,
		    t_usuarios.FECHA_REGISTRO

			FROM t_usuarios
			WHERE t_usuarios.ESTADO=1 AND NIVEL>0 ORDER BY ID_USUARIO DESC ')->result('array');
        }

        public function TraeUltimoInicioSesionAdmin()
        {
            return @Momento($this->db->query('SELECT FACHA_ULTIMO_INICIO_SESION FROM t_usuarios WHERE NIVEL>0 AND ID_USUARIO=' .
                $this->session->userdata('ID_USUARIO'))->result()[0]->FACHA_ULTIMO_INICIO_SESION);
        }

        public function TraeModulos()
        {
            return $this->db->get('t_auth_item')->result('array');
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
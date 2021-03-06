<?php

    Class proyectos_model extends CI_Model
    {
        public function __construct()
        {
            parent::__construct();
        }

        public function TraeProyecto($IdProyecto)
        {
            $query = '';
            if($this->session->userdata('ASESOR'))
            {
                $query = "AND t_proyectos.PERIODO='" . $this->session->userdata('PERIODO') .
                    "' AND t_usuarios.ID_USUARIO='" . $this->session->userdata('ID_USUARIO') . "'";
            }

            return @$this->db->query("SELECT
              t_proyectos.ID_PROYECTO,
              t_proyectos.ID_ASESOR,
              NOMBRE_PROYECTO,
              t_proyectos.FECHA_REGISTRO,
              ID_TIPO_PROYECTO,
              t_proyectos.PERIODO,
              t_usuarios.NOMBRE NOMBRE_USUARIO,
              HORARIO,
              t_tipo_proyectos.NOMBRE_TIPO_PROYECTO

               FROM t_proyectos
               INNER JOIN t_tipo_proyectos USING (ID_TIPO_PROYECTO)
               INNER JOIN t_usuarios ON t_usuarios.ID_USUARIO = t_proyectos.ID_ASESOR

                WHERE ID_PROYECTO=$IdProyecto $query LIMIT 1")->result()[0];
        }

        public function TraeTipoProyectos()
        {
            return @$this->db->query("SELECT * FROM t_tipo_proyectos")->result('array');
        }

        public function ContarProyectos($asesor = false)
        {
            if($asesor)
            {
                return $this->db->query("SELECT COUNT(ID_PROYECTO) AS PROYECTOS FROM t_proyectos
              WHERE ID_ASESOR=" . $this->session->userdata('ID_USUARIO') . " AND PERIODO='" . $this->session->userdata('PERIODO') . "'")->result()[0];
            }
            else
            {
                return $this->db->query("SELECT COUNT(ID_PROYECTO) AS PROYECTOS FROM t_proyectos")->result()[0];
            }
        }

        public function InsertarProyecto()
        {
            $this->db->set('FECHA_REGISTRO', 'NOW()', false);
            $this->db->insert('t_proyectos', $this->input->post(null, true));
        }

        public function InsertarTipoProyecto()
        {
            $this->db->set('FECHA_REGISTRO', 'NOW()', false);
            $this->db->insert('t_tipo_proyectos', $this->input->post(null, true));
        }

        public function EliminarProyecto()
        {
            $this->db->delete('t_proyectos', ['ID_PROYECTO' => $this->input->post('Id')]);
        }

        public function EliminarTipoProyecto()
        {
            $this->db->delete('t_tipo_proyectos', ['ID_TIPO_PROYECTO' => $this->input->post('Id')]);
        }

        public function ActualizarProyecto()
        {
            $Idproyecto = array_shift($_POST);
            $this->db->update('t_proyectos', $this->input->post(null, true), ['ID_PROYECTO' => $Idproyecto]);
        }

        public function ActualizarHorarioProyecto()
        {
            $this->db->update('t_proyectos', $this->input->post(null, true), ['ID_PROYECTO' => $this->input->post('ID_PROYECTO')]);
        }

        public function TraeProyectos()
        {
            return $this->db->query("SELECT
             t_proyectos.ID_PROYECTO,
             t_proyectos.NOMBRE_PROYECTO,
             t_proyectos.FECHA_REGISTRO,
             t_proyectos.PERIODO,
             COUNT(t_practicantes.ID_PRACTICANTE) PRACTICANTES,
			  t_cooperadores.NOMBRE_COOPERADOR,
			  t_tipo_proyectos.NOMBRE_TIPO_PROYECTO,
			   t_usuarios.NOMBRE NOMBRE_USUARIO

             FROM t_proyectos
			  LEFT JOIN t_practicantes USING (ID_PROYECTO)
			  LEFT JOIN t_usuarios ON t_usuarios.ID_USUARIO=t_proyectos.ID_ASESOR
			  LEFT JOIN t_cooperadores USING (ID_COOPERADOR)
			  LEFT JOIN t_tipo_proyectos USING (ID_TIPO_PROYECTO)

              GROUP BY t_proyectos.ID_PROYECTO ORDER BY t_proyectos.FECHA_REGISTRO DESC")->result('array');
        }

        public function TraeProyectosAsesor()
        {
            return $this->db->query("SELECT
             t_proyectos.ID_PROYECTO,
             t_proyectos.NOMBRE_PROYECTO,
             t_proyectos.FECHA_REGISTRO,
             COUNT(t_practicantes.ID_PRACTICANTE) PRACTICANTES,
			  t_cooperadores.NOMBRE_COOPERADOR,
			  t_tipo_proyectos.NOMBRE_TIPO_PROYECTO,
			  t_usuarios.NOMBRE NOMBRE_USUARIO

             FROM t_proyectos
			  LEFT JOIN t_practicantes USING (ID_PROYECTO)
			  LEFT JOIN t_usuarios ON t_usuarios.ID_USUARIO=t_practicantes.ID_ASESOR
			  LEFT JOIN t_cooperadores USING (ID_COOPERADOR)
			  INNER JOIN t_tipo_proyectos USING (ID_TIPO_PROYECTO)

              WHERE t_proyectos.ID_ASESOR=" . $this->session->userdata('ID_USUARIO') . "
               AND t_proyectos.PERIODO ='" . $this->session->userdata('PERIODO') . "'
             GROUP BY t_proyectos.ID_PROYECTO ORDER BY t_proyectos.FECHA_REGISTRO DESC")->result('array');
        }

        public function TraeProyectosDD($idproyecto = null)
        {
            if(is_null($idproyecto))
            {
                return $this->db->query("SELECT DISTINCT
              t_proyectos.ID_PROYECTO,
              t_proyectos.NOMBRE_PROYECTO

            FROM t_proyectos")->result('array');
            }
            else
            {
                return $this->db->query("SELECT DISTINCT
              t_proyectos.ID_PROYECTO,
              t_proyectos.NOMBRE_PROYECTO

            FROM t_proyectos
            WHERE ID_PROYECTO=$idproyecto")->result('array');
            }
        }

        public function TraeHorario()
        {
            $h = $this->db->query("SELECT
              HORARIO
            FROM t_proyectos
            WHERE ID_PROYECTO=" . $this->input->post('ID_PROYECTO'))->result()[0]->HORARIO;

            return is_null($h) ? date('d/m/Y h:i a') : $h;
        }

        public function TraeHorarios()
        {
            return $this->db->query("SELECT DISTINCT
              HORARIO,
              ID_PROYECTO,
              NOMBRE_PROYECTO
            FROM t_proyectos
            WHERE HORARIO IS NOT NULL  AND t_proyectos.PERIODO ='" . $this->session->userdata('PERIODO') . "'
            AND ID_ASESOR=" . $this->session->userdata('ID_USUARIO'))->result();
        }

        public function TraeAsesorProyectosLinkDD()
        {
            return $this->db->query("SELECT DISTINCT
              t_proyectos.ID_PROYECTO,
              t_proyectos.NOMBRE_PROYECTO

              FROM t_practicantes
              INNER JOIN t_proyectos USING (ID_PROYECTO)

            WHERE t_proyectos.PERIODO='" . $this->session->userdata('PERIODO') . "'
             AND t_practicantes.ID_ASESOR= " . $this->session->userdata('ID_USUARIO'))->result('array');
        }

        public function TraeAsesorProyectosCalificarDD()
        {
            return $this->db->query("SELECT DISTINCT
              t_proyectos.ID_PROYECTO,
              t_proyectos.NOMBRE_PROYECTO

              FROM t_practicantes
              INNER JOIN t_proyectos USING (ID_PROYECTO)

            WHERE  t_proyectos.PERIODO ='" . $this->session->userdata('PERIODO') . "'
            AND t_practicantes.ID_ASESOR = " . $this->session->userdata('ID_USUARIO'))->result('array');
        }

        public function TraeAsesorProyectosDD()
        {
            return $this->db->query("SELECT DISTINCT
              t_proyectos.ID_PROYECTO,
              t_proyectos.NOMBRE_PROYECTO

              FROM t_practicantes
              INNER JOIN t_proyectos USING (ID_PROYECTO)

            WHERE t_proyectos.PERIODO ='" . $this->session->userdata('PERIODO') . "'
            AND t_practicantes.ID_ASESOR= " . $this->session->userdata('ID_USUARIO'))->result('array');
        }
    }
<?php

    Class practicantes_model extends CI_Model
    {
        public function __construct()
        {
            parent::__construct();
        }

        public function TraePracticante($IdPracticante)
        {
            $Asesor = $this->session->userdata('ASESOR') ? "AND t_practicantes.ID_ASESOR=" . $this->session->userdata('ID_USUARIO') : '';

            return @$this->db->query("SELECT
             t_practicantes.ID_PRACTICANTE,
             t_practicantes.ID_PROYECTO,
             t_practicantes.DOCUMENTO,
             t_practicantes.ID_AGENCIA,
             CASE t_practicantes.ID_MODALIDAD_PRACTICA WHEN 1 THEN  'Validación experiencia profesional' WHEN 2 THEN 'Práctica empresarial'  END AS MODALIDAD,
             CASE t_practicantes.ID_PROGRAMA WHEN 1 THEN 'Ingeniería de Sistemas' WHEN 2 THEN 'Ingeniería de Software' WHEN 3 THEN 'Electromedicina'  WHEN 4 THEN 'Robótica y automatización' ELSE 'N/A' END PROGRAMA,
             t_practicantes.ID_MODALIDAD_PRACTICA,
             t_practicantes.ID_PROGRAMA,
             t_practicantes.CELULAR,
             t_usuarios.NOMBRE NOMBRE_ASESOR,
             t_usuarios.ID_USUARIO ID_ASESOR,
             t_cooperadores.ID_COOPERADOR,
             t_practicantes.TELEFONO,
             t_practicantes.NOMBRE_PRACTICANTE,
             t_practicantes.CODIGO,
             t_proyectos.NOMBRE_PROYECTO,
             t_practicantes.CORREO_PRACTICANTE,
              t_cooperadores.NOMBRE_COOPERADOR,
              t_cooperadores.CARGO CARGO_COOPERADOR,
             t_practicantes.FECHA_REGISTRO,
             t_practicantes.FECHA_MODIFICA,
             t_agencias.NOMBRE_AGENCIA,
             reg.NOMBRE NOMBRE_USUARIO_MODIFICA,
             reg.ID_USUARIO_MODIFICA ID

             FROM t_practicantes
             LEFT JOIN t_usuarios ON t_usuarios.ID_USUARIO=t_practicantes.ID_ASESOR
             LEFT JOIN t_usuarios reg ON t_usuarios.ID_USUARIO_MODIFICA=t_practicantes.ID_USUARIO_MODIFICA
             LEFT JOIN t_cooperadores USING (ID_COOPERADOR)
             LEFT JOIN t_proyectos USING (ID_PROYECTO)
             LEFT JOIN t_agencias ON t_practicantes.ID_AGENCIA=t_agencias.ID_AGENCIA
             WHERE t_practicantes.ID_PRACTICANTE=$IdPracticante " . $Asesor)->result()[0];
        }

        public function ContarTodoPracticantes()
        {
            return $this->db->count_all_results("t_practicantes");
        }

        public function ActualizarPracticante()
        {
            $Idasesor = array_shift($_POST);
            $this->db->select('ID_ASESOR');
            $_POST['ID_ASESOR'] = @$this->db->get_where('t_proyectos', ['ID_PROYECTO' => $this->input->post('ID_PROYECTO')])->result()[0]->ID_ASESOR;
            $this->db->set('FECHA_MODIFICA', 'NOW()', false);
            $this->db->set('ID_USUARIO_MODIFICA', $this->session->userdata('ID_USUARIO'));
            $this->db->update('t_practicantes', $this->input->post(null, true), ['ID_PRACTICANTE' => $Idasesor]);
            $this->db->update('t_proyectos', ['ID_ASESOR' => $this->input->post('ID_ASESOR', true)], ['ID_PROYECTO' => $this->input->post('ID_PROYECTO', true)]);
        }

        public function InsertarPracticante()
        {
            $this->db->select('ID_ASESOR');
            $_POST['ID_ASESOR'] = @$this->db->get_where('t_proyectos', ['ID_PROYECTO' => $this->input->post('ID_PROYECTO')])->result()[0]->ID_ASESOR;
            $this->db->set('FECHA_REGISTRO', 'NOW()', false);
            $this->db->set('FECHA_MODIFICA', 'NOW()', false);
            $this->db->set('ID_USUARIO_MODIFICA', $this->session->userdata('ID_USUARIO'));
            $this->db->insert('t_practicantes', $this->input->post(null, true));
            $this->db->update('t_proyectos', ['ID_ASESOR' => $this->input->post('ID_ASESOR', true)], ['ID_PROYECTO' => $this->input->post('ID_PROYECTO', true)]);
        }

        public function EliminarPracticante()
        {
            $this->db->delete('t_practicantes', ['ID_PRACTICANTE' => $this->input->post('Id')]);
        }

        public function TraePracticantes($id = null)
        {
            $id = is_null($id) ? $this->session->userdata('ID_USUARIO') : $id;
            if($this->session->userdata('ADMIN'))
            {
                return $this->db->query("SELECT
             t_practicantes.ID_PRACTICANTE,
             t_practicantes.NOMBRE_PRACTICANTE,
             t_proyectos.NOMBRE_PROYECTO,
             t_practicantes.CORREO_PRACTICANTE,
             t_cooperadores.NOMBRE_COOPERADOR,
             t_agencias.NOMBRE_AGENCIA,
             t_agencias.DIRECCION DIRECCION_AGENCIA,
             t_agencias.TELEFONO1 TELEFONO_AGENCIA,
            CASE t_practicantes.ID_MODALIDAD_PRACTICA WHEN 1 THEN  'Validación experiencia profesional' WHEN 2 THEN 'Práctica empresarial'  END AS MODALIDAD


             FROM t_practicantes
             INNER JOIN t_cooperadores USING (ID_COOPERADOR)
             INNER JOIN t_proyectos USING (ID_PROYECTO)
             INNER JOIN t_agencias ON t_practicantes.ID_AGENCIA=t_agencias.ID_AGENCIA

             WHERE t_practicantes.ID_ASESOR=$id")->result('array');
            }
            else
            {
                return $this->db->query("SELECT
             t_practicantes.ID_PRACTICANTE,
             t_practicantes.NOMBRE_PRACTICANTE,
             t_proyectos.NOMBRE_PROYECTO,
             t_practicantes.CORREO_PRACTICANTE,
             t_cooperadores.NOMBRE_COOPERADOR,
             t_agencias.NOMBRE_AGENCIA,
             t_agencias.DIRECCION DIRECCION_AGENCIA,
             t_agencias.TELEFONO1 TELEFONO_AGENCIA,
            CASE t_practicantes.ID_MODALIDAD_PRACTICA WHEN 1 THEN  'Validación experiencia profesional' WHEN 2 THEN 'Práctica empresarial'  END AS MODALIDAD


             FROM t_practicantes
             INNER JOIN t_cooperadores USING (ID_COOPERADOR)
             INNER JOIN t_proyectos USING (ID_PROYECTO)
             INNER JOIN t_agencias ON t_practicantes.ID_AGENCIA=t_agencias.ID_AGENCIA

             WHERE  t_proyectos.PERIODO='" . $this->session->userdata('PERIODO') . "'
             AND t_practicantes.ID_ASESOR=$id")->result('array');
            }
        }

        public function TraePracticantesPorProyecto($IdProyecto, $full = false)
        {
            if($full)
            {
                return $this->db->query("SELECT
             t_practicantes.ID_PRACTICANTE,
             t_practicantes.NOMBRE_PRACTICANTE,
             t_practicantes.CORREO_PRACTICANTE,
             t_practicantes.DOCUMENTO,
             CASE t_practicantes.ID_MODALIDAD_PRACTICA WHEN 1 THEN  'Validación profesional' WHEN 2 THEN 'Práctica empresarial' END AS MODALIDAD,
             t_agencias.NOMBRE_AGENCIA

             FROM t_practicantes
             INNER JOIN t_agencias USING (ID_AGENCIA)
             INNER JOIN t_proyectos USING (ID_PROYECTO)

             WHERE t_proyectos.PERIODO='" . $this->session->userdata('PERIODO') . "'
             AND t_practicantes.ID_PROYECTO=$IdProyecto")->result('array');
            }
            else
            {
                if($this->session->userdata('ASESOR'))
                {
                    return $this->db->query("SELECT
                         t_practicantes.ID_PRACTICANTE,
                         t_practicantes.NOMBRE_PRACTICANTE,
                         t_practicantes.CORREO_PRACTICANTE,
                         t_practicantes.DOCUMENTO,
                         t_proyectos.NOMBRE_PROYECTO

                         FROM t_practicantes
                         INNER JOIN t_proyectos USING (ID_PROYECTO)

                         WHERE t_practicantes.ID_PROYECTO=$IdProyecto AND
                         t_proyectos.PERIODO='" . $this->session->userdata('PERIODO') . "'")->result('array');
                }
                else
                {
                    return $this->db->query("SELECT
                         t_practicantes.ID_PRACTICANTE,
                         t_practicantes.NOMBRE_PRACTICANTE,
                         t_practicantes.CORREO_PRACTICANTE,
                         t_practicantes.DOCUMENTO,
                         t_proyectos.NOMBRE_PROYECTO

                         FROM t_practicantes
                         INNER JOIN t_proyectos USING (ID_PROYECTO)

                         WHERE t_practicantes.ID_PROYECTO=$IdProyecto")->result('array');
                }
            }
        }

        public function TraeTodoPracticantes()
        {
            return $this->db->query("SELECT
             t_practicantes.ID_PRACTICANTE,
             t_practicantes.NOMBRE_PRACTICANTE,
             t_practicantes.CORREO_PRACTICANTE,
             t_proyectos.NOMBRE_PROYECTO,
             t_usuarios.NOMBRE NOMBRE_ASESOR,
             t_cooperadores.NOMBRE_COOPERADOR,
             t_agencias.NOMBRE_AGENCIA,
             t_agencias.DIRECCION DIRECCION_AGENCIA,
             t_agencias.TELEFONO1 TELEFONO_AGENCIA,
             CASE t_practicantes.ID_MODALIDAD_PRACTICA WHEN 1 THEN  'Validación experiencia profesional' WHEN 2 THEN 'Práctica empresarial'  END AS MODALIDAD

             FROM t_practicantes

             LEFT JOIN t_usuarios ON t_usuarios.ID_USUARIO=t_practicantes.ID_ASESOR
              LEFT JOIN t_cooperadores USING (ID_COOPERADOR)
             LEFT JOIN t_proyectos USING (ID_PROYECTO)
             LEFT JOIN t_agencias ON t_practicantes.ID_AGENCIA=t_agencias.ID_AGENCIA")->result('array');
        }

        public function TraeCooperadoresAgencia()
        {
            $this->db->select('ID_COOPERADOR,NOMBRE_COOPERADOR');
            $this->db->join('t_agencias', 't_agencias.ID_AGENCIA=t_cooperadores.ID_AGENCIA', 'inner');
            $this->db->where('t_agencias.ID_AGENCIA', $this->input->post('ID_AGENCIA'));
            return $this->db->get('t_cooperadores')->result('array');
        }
    }
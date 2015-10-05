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

            $e = @$this->db->query("SELECT
             t_practicantes.ID_PRACTICANTE,
             t_practicantes.ID_PROYECTO,
             t_practicantes.DOCUMENTO,
             t_practicantes.ID_AGENCIA,
             CASE t_practicantes.ID_MODALIDAD_PRACTICA WHEN 1 THEN  'Validación experiencia profesional' WHEN 2 THEN 'Practica empresarial'  END AS MODALIDAD,
             CASE t_practicantes.ID_PROGRAMA WHEN 1 THEN 'Ingeniería de sistemas' WHEN 2 THEN 'Ingniería de software' WHEN 3 THEN 'Electromedicina' ELSE 'N/A' END PROGRAMA,
             t_practicantes.ID_MODALIDAD_PRACTICA,
             t_practicantes.ID_PROGRAMA,
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
             t_agencias.NOMBRE_AGENCIA

             FROM t_practicantes
             INNER JOIN t_usuarios ON t_usuarios.ID_USUARIO=t_practicantes.ID_ASESOR
             INNER JOIN t_cooperadores USING (ID_COOPERADOR)
             INNER JOIN t_proyectos USING (ID_PROYECTO)
             INNER JOIN t_agencias ON t_practicantes.ID_AGENCIA=t_agencias.ID_AGENCIA
             WHERE t_practicantes.ID_PRACTICANTE=$IdPracticante " . $Asesor)->result()[0];
            return $e;
        }

        public function ContarPracticantes()
        {
            return $this->db->query("SELECT
           COUNT(ID_PRACTICANTE) AS PRACTICANTES
            FROM t_practicantes

          WHERE t_practicantes.ESTADO=1 AND
          t_practicantes.ID_ASESOR=" . $this->session->userdata('ID_USUARIO') . " AND t_practicantes.FECHA_REGISTRO>='" . $this->session->userdata('PERIODO') . "'
          AND t_practicantes.FECHA_REGISTRO<='" . $this->session->userdata('FPERIODO') . "'")->result()[0];
        }

        public function ContarTodoPracticantes()
        {
            return $this->db->query("SELECT COUNT(ID_PRACTICANTE) AS PRACTICANTES FROM t_practicantes
          WHERE ESTADO=1")->result()[0];
        }

        public function ActualizarPracticante()
        {
            $Idasesor = array_shift($_POST);
            $this->db->update('t_practicantes', $this->input->post(null, true), ['ID_PRACTICANTE' => $Idasesor]);
        }

        public function InsertarPracticante()
        {
            $this->db->set('FECHA_REGISTRO', 'NOW()', false);
            $this->db->insert('t_practicantes', $this->input->post(null, true));
        }

        public function EliminarPracticante()
        {
            $this->db->update('t_practicantes', ['ESTADO' => 0], ['ID_PRACTICANTE' => $this->input->post('Id')]);
        }

        public function TraePracticantes($id = null)
        {
            $id = is_null($id) ? $this->session->userdata('ID_USUARIO') : $id;

            return $this->db->query("SELECT
             t_practicantes.ID_PRACTICANTE,
             t_practicantes.NOMBRE_PRACTICANTE,
             t_proyectos.NOMBRE_PROYECTO,
             t_practicantes.CORREO_PRACTICANTE,
             t_cooperadores.NOMBRE_COOPERADOR,
             t_agencias.NOMBRE_AGENCIA,
            CASE t_practicantes.ID_MODALIDAD_PRACTICA WHEN 1 THEN  'Validación experiencia profesional' WHEN 2 THEN 'Practica empresarial'  END AS MODALIDAD


             FROM t_practicantes
             INNER JOIN t_cooperadores USING (ID_COOPERADOR)
             INNER JOIN t_proyectos USING (ID_PROYECTO)
             INNER JOIN t_agencias ON t_practicantes.ID_AGENCIA=t_agencias.ID_AGENCIA

             WHERE t_practicantes.ESTADO=1 AND t_practicantes.FECHA_REGISTRO>='" . $this->session->userdata('PERIODO') . "'
             AND t_practicantes.FECHA_REGISTRO<='" . $this->session->userdata('FPERIODO') . "'
             AND t_practicantes.ID_ASESOR=$id")->result('array');
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
             CASE t_practicantes.ID_MODALIDAD_PRACTICA WHEN 1 THEN  'Validación profesional' WHEN 2 THEN 'Practica empresarial' END AS MODALIDAD,
             t_agencias.NOMBRE_AGENCIA

             FROM t_practicantes
             INNER JOIN t_agencias USING (ID_AGENCIA)

             WHERE t_practicantes.ESTADO=1 AND t_practicantes.ID_PROYECTO=$IdProyecto")->result('array');
            }
            else
            {
                return $this->db->query("SELECT
             t_practicantes.ID_PRACTICANTE,
             t_practicantes.NOMBRE_PRACTICANTE,
             t_practicantes.CORREO_PRACTICANTE,
             t_practicantes.DOCUMENTO

             FROM t_practicantes

             WHERE t_practicantes.ESTADO=1 AND t_practicantes.ID_PROYECTO=$IdProyecto")->result('array');
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
             CASE t_practicantes.ID_MODALIDAD_PRACTICA WHEN 1 THEN  'Validación experiencia profesional' WHEN 2 THEN 'Practica empresarial'  END AS MODALIDAD

             FROM t_practicantes

             INNER JOIN t_usuarios ON t_usuarios.ID_USUARIO=t_practicantes.ID_ASESOR
              INNER JOIN t_cooperadores USING (ID_COOPERADOR)
             INNER JOIN t_proyectos USING (ID_PROYECTO)
             INNER JOIN t_agencias ON t_practicantes.ID_AGENCIA=t_agencias.ID_AGENCIA
             WHERE t_practicantes.ESTADO=1")->result('array');
        }
    }
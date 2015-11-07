<?php

    Class seguimientos_model extends CI_Model
    {
        public function __construct()
        {
            parent::__construct();
        }

        public function InsertarLinkFormularioSeguimiento($Data)
        {
            $this->db->insert_batch('t_links', $Data);
        }

        public function InsertarCalificarPracticante()
        {
            $this->db->set('FECHA_REGISTRO', 'NOW()', false);
            $this->db->set('ID_PRACTICANTE', $this->input->post('ID_PRACTICANTE'), false);
            $this->db->set('MOMENTO', $this->input->post('MOMENTO'), false);
            #Observaciones
            $this->db->set('OBS_SABERSER', $this->input->post('OBS_SABERSER'));
            $this->db->set('OBS_SABERHACER', $this->input->post('OBS_SABERHACER'));
            $this->db->set('OBS_SABERSABER', $this->input->post('OBS_SABERSABER'));
            $this->db->insert('t_calificacion_practicantes',
                ['NOTA' => implode(',', $_POST['range']),
                    'PERSONA' => $this->input->post('PERSONA')]);
        }

        public function ExisteCalificacion($c, $momento = 0, $practicante = null)
        {
            $c = explode(',', $c);
            $c1 = isset($c[0]) ? $c[0] : '';
            $c2 = isset($c[1]) ? $c[1] : '';
            $c3 = isset($c[2]) ? $c[2] : '';
            $practicante = $this->input->post('ID_PRACTICANTE') ? $this->input->post('ID_PRACTICANTE') : $practicante;

            $momento = $this->input->post('MOMENTO') ? $this->input->post('MOMENTO') : $momento;

            return $this->db->query("SELECT DISTINCT ID_CALIFICACION_PRACTICANTE FROM t_calificacion_practicantes
            WHERE PERSONA IN ('$c1','$c2','$c3') AND MOMENTO=$momento
             AND ID_PRACTICANTE = $practicante")->num_rows() > 0;
        }

        public function InsertarEvaluacionEstudiante()
        {
            $this->db->trans_start();
            $this->db->set('ID_PRACTICANTE', $this->session->userdata('ID_PRACTICANTE'));
            $this->db->insert('t_evaluacion_estudiante', $this->input->post(null, true));

            $this->db->set('FECHA_FINALIZA', 'NOW()', false);
            $this->db->update('t_links', ['FINALIZADO' => 1], ['TIPO' => 'sp', 'ID_PRACTICANTE' => $this->session->userdata('ID_PRACTICANTE')]);

            if($this->db->trans_status() == false)
            {
                $this->db->trans_rollback();
            }
            else
            {
                $this->session->sess_destroy();
                $this->db->trans_complete();
            }
        }

        public function ActualizaPracticanteMomento()
        {
            $this->db->query('UPDATE t_practicantes SET MOMENTO = MOMENTO + 1 WHERE ID_PRACTICANTE = ' . $this->input->post('ID_PRACTICANTE'));
        }

        public function EliminarCalificacion()
        {
            $this->db->delete('t_calificacion_practicantes', ['ID_PRACTICANTE' => $this->input->post('ID_PRACTICANTE'), 'MOMENTO' => $this->input->post('MOMENTO')]);
        }

        public function TraeMomento()
        {
            return $this->db->query("SELECT MOMENTO FROM t_practicantes WHERE ID_PRACTICANTE = " . $this->input->post('ID_PRACTICANTE'))->result()[0]->MOMENTO;
        }

        public function TraePracticantes()
        {
            return $this->db->query("SELECT
             ID_PRACTICANTE,
             MOMENTO,
             NOMBRE_PRACTICANTE
             FROM t_practicantes
             WHERE ID_PROYECTO=" . $this->input->post('ID_PROYECTO'))->result('array');
        }

        public function TraePracticantesCalificacion()
        {
            $inf = $this->input->post('PERIODO');
            $sup = (new DateTime($inf))->add(new DateInterval('P6M'))->format('Y-m-d');

            return $this->db->query("SELECT
             t_practicantes.ID_PRACTICANTE,
             t_practicantes.CODIGO,
             t_practicantes.NOMBRE_PRACTICANTE,
             t_proyectos.NOMBRE_PROYECTO,
             t_agencias.NOMBRE_AGENCIA,
             CASE t_practicantes.ID_MODALIDAD_PRACTICA WHEN 1 THEN  'Validación profesional' WHEN 2 THEN 'Práctica empresarial' ELSE 'Idea de negocio' END AS MODALIDAD

             FROM t_practicantes
             INNER JOIN t_proyectos USING (ID_PROYECTO)
             INNER JOIN t_agencias ON t_practicantes.ID_AGENCIA=t_agencias.ID_AGENCIA

             WHERE t_practicantes.FECHA_REGISTRO>='$inf' AND t_practicantes.FECHA_REGISTRO<'$sup'
             AND t_practicantes.ID_ASESOR=" . $this->session->userdata('ID_USUARIO'))->result('array');
        }

        public function TraeCalificaciones()
        {
            $Practicantes = $this->TraePracticantesCalificacion();
            foreach ($Practicantes as $i => $practicante)
            {
                $p = $practicante['ID_PRACTICANTE'];
                if(($this->ExisteCalificacion('M', 1, $p) && $this->ExisteCalificacion('M', 2, $p)))
                {
                    $Notas = $this->TraeNotasPracticante($p);
                    $Practicantes[$i]['NOTA1'] = $Notas['NOTA1'];
                    $Practicantes[$i]['NOTA2'] = $Notas['NOTA2'];
                }
                else if($this->ExisteCalificacion('A', 1, $p) && $this->ExisteCalificacion('C', 1, $p) && $this->ExisteCalificacion('M', 2, $p))
                {
                    $Notas = $this->TraeNotasPracticante($p);
                    $Practicantes[$i]['NOTA1'] = $Notas['NOTA1'];
                    $Practicantes[$i]['NOTA2'] = $Notas['NOTA2'];
                }
                else if($this->ExisteCalificacion('A', 2, $p) && $this->ExisteCalificacion('C', 2, $p) && $this->ExisteCalificacion('M', 1, $p))
                {
                    $Notas = $this->TraeNotasPracticante($p);
                    $Practicantes[$i]['NOTA1'] = $Notas['NOTA1'];
                    $Practicantes[$i]['NOTA2'] = $Notas['NOTA2'];
                }
                else if($this->ExisteCalificacion('A', 1, $p) && $this->ExisteCalificacion('C', 1, $p) && $this->ExisteCalificacion('A', 2, $p) && $this->ExisteCalificacion('C', 2, $p))
                {
                    $Notas = $this->TraeNotasPracticante($p);
                    $Practicantes[$i]['NOTA1'] = $Notas['NOTA1'];
                    $Practicantes[$i]['NOTA2'] = $Notas['NOTA2'];
                }
                else
                {
                    unset($Practicantes[$i]);
                }
            }
            return $Practicantes;
        }

        /**
         * Trae las notas del practicante
         * @param $p
         * @return array
         */
        public function TraeCalificacion($p)
        {
            $Notas = [];
            if(($this->ExisteCalificacion('M', 1, $p) && $this->ExisteCalificacion('M', 2, $p)))
            {
                $Notas = $this->TraeNotasPracticante($p);
            }
            else if($this->ExisteCalificacion('A', 1, $p) && $this->ExisteCalificacion('C', 1, $p) && $this->ExisteCalificacion('M', 2, $p))
            {
                $Notas = $this->TraeNotasPracticante($p);
            }
            else if($this->ExisteCalificacion('A', 2, $p) && $this->ExisteCalificacion('C', 2, $p) && $this->ExisteCalificacion('M', 1, $p))
            {
                $Notas = $this->TraeNotasPracticante($p);
            }
            else if($this->ExisteCalificacion('A', 1, $p) && $this->ExisteCalificacion('C', 1, $p) && $this->ExisteCalificacion('A', 2, $p) && $this->ExisteCalificacion('C', 2, $p))
            {
                $Notas = $this->TraeNotasPracticante($p);
            }
            return $Notas;
        }

        public function TraeNotasPracticante($IdPracticante)
        {
            $calificaciones = $this->db->query("SELECT
            t_calificacion_practicantes.NOTA,
            t_calificacion_practicantes.MOMENTO

            FROM t_calificacion_practicantes

            WHERE ID_PRACTICANTE=$IdPracticante")->result();
            $Notas['Momento1'] = ['saberser' => 0, 'saberhacer' => 0, 'sabersaber' => 0];
            $Notas['Momento2'] = ['saberser' => 0, 'saberhacer' => 0, 'sabersaber' => 0];

            foreach ($calificaciones as $nota)
            {
                if($nota->MOMENTO == 1)
                {
                    $this->EvaluarNota(explode(',', $nota->NOTA), $Notas, 1);
                }
                else if($nota->MOMENTO == 2)
                {
                    $this->EvaluarNota(explode(',', $nota->NOTA), $Notas, 2);
                }
            }
            $Notas['NOTA1'] = number_format($Notas['Momento1']['saberser'] + $Notas['Momento1']['saberhacer'] + $Notas['Momento1']['sabersaber'], 1);
            $Notas['NOTA2'] = number_format($Notas['Momento2']['saberser'] + $Notas['Momento2']['saberhacer'] + $Notas['Momento2']['sabersaber'], 1);
            return $Notas;
        }

        private function  EvaluarNota($notas, &$Momentos, $m)
        {
            $N = ['saberser' => 0, 'saberhacer' => 0, 'sabersaber' => 0];
            foreach ($notas as $i => $nota)
            {
                if($i >= 0 && $i < 6)
                {
                    $N['saberser'] += $nota;
                }
                else if($i >= 6 && $i < 12)
                {
                    $N['saberhacer'] += $nota;
                }
                else
                {
                    $N['sabersaber'] += $nota;
                }
            }
            $Momentos['Momento' . $m]['saberser'] += ($N['saberser'] / 6) * .33;
            $Momentos['Momento' . $m]['sabersaber'] += ($N['sabersaber'] / 6) * .33;
            $Momentos['Momento' . $m]['saberhacer'] += ($N['saberhacer'] / 6) * .34;
            return $N;
        }

        public function TraePracticantesCalificar($momento, $auto = false)
        {
            $Practicantes = $this->TraePracticantes();
            foreach ($Practicantes as $i => $practicante)
            {
                if($practicante['MOMENTO'] == 3 || ($this->ExisteCalificacion('A', $momento, $practicante['ID_PRACTICANTE']) && $this->ExisteCalificacion('C', $auto ? $practicante['MOMENTO'] : $momento, $practicante['ID_PRACTICANTE'])
                        || $this->ExisteCalificacion('M', $momento, $practicante['ID_PRACTICANTE']))
                )
                {
                    unset($Practicantes[$i]);
                }
            }
            return $Practicantes;
        }

        public function TraeTodoMomentos()
        {
            return $this->db->query("SELECT COUNT(ID_LINK) MOMENTOS
                FROM t_links
                WHERE FINALIZADO=1 AND TIPO='sp' AND ID_PRACTICANTE=" . $this->input->post('ID_PRACTICANTE'))->result()[0]->MOMENTOS;
        }

        public function TraeEvaluacionEstudiante($IdPracticante)
        {
            return $this->db->query("SELECT * FROM t_evaluacion_estudiante WHERE  ID_PRACTICANTE=$IdPracticante")->result()[0];
        }

        public function TraeCalificacionPracticante($IdPracticante, $Momento)
        {
            return $this->db->query("SELECT
             MOMENTO,
             NOTA,
             FECHA_REGISTRO,
             PERSONA,
             OBS_SABERHACER,
             OBS_SABERSABER,
             OBS_SABERSER

         FROM t_calificacion_practicantes
           WHERE MOMENTO=$Momento AND ID_PRACTICANTE=$IdPracticante")->result();
        }

        public function ExisteLink()
        {
            CleanSql($_GET);
            return $this->db->query("SELECT DISTINCT
             ID_LINK

             FROM t_links
             INNER JOIN t_practicantes ON t_practicantes.ID_PRACTICANTE=t_links.ID_PRACTICANTE
             WHERE FECHA_CADUCA>=CURDATE()

             AND t_links.ID_PRACTICANTE='$_GET[_id]' AND t_links.TIPO='$_GET[_type]'
             AND MD5(concat(t_practicantes.CORREO_PRACTICANTE,t_practicantes.DOCUMENTO))='$_GET[_link]'
              AND  t_links.FINALIZADO=0 LIMIT 1")->num_rows() > 0;
        }

        public function TraeEvaluacionEstudianteNotificacion($fin = 0, $tipo = 'sp')
        {
            $IdAsesor = $this->session->userdata('ID_USUARIO');
            $now = date('Y-m-d H:i:s');
            return $this->db->query("SELECT
            t_practicantes.NOMBRE_PRACTICANTE,
            t_practicantes.ID_PRACTICANTE,
            t_links.FECHA_FINALIZA,
            t_links.FECHA_REGISTRO,
            t_links.CONSECUTIVO,
            t_links.FECHA_CADUCA

            FROM t_practicantes
            INNER JOIN t_links USING(ID_PRACTICANTE)
            INNER JOIN t_proyectos USING(ID_PROYECTO)
            WHERE t_practicantes.ID_ASESOR=$IdAsesor AND
             t_links.FINALIZADO=$fin AND
             t_links.TIPO='$tipo'
            AND t_links.FECHA_CADUCA>='$now' ORDER BY t_links.FECHA_FINALIZA DESC ")->result();
        }

        public function ValidaPracticanteIngreso()
        {
            CleanSql($_POST);
            $query = $this->db->query("SELECT
             NOMBRE_PRACTICANTE,
             ID_PRACTICANTE,
             t_usuarios.NOMBRE NOMBRE_ASESOR

             FROM t_practicantes
             INNER  JOIN t_usuarios ON t_usuarios.ID_USUARIO=t_practicantes.ID_ASESOR
             WHERE CORREO_PRACTICANTE='" . $this->input->post('CORREO', true) . "'
             AND t_practicantes.ID_PRACTICANTE=" . $this->input->post('ID_PRACTICANTE') . "
             AND t_practicantes.DOCUMENTO='" . $this->input->post('DOCUMENTO', true) . "' LIMIT 1");
            if($query->num_rows() > 0)
            {
                $query = $query->result()[0];
                $this->session->set_userdata(['GUESS' => true, 'GUESS_CORREO' => $this->input->post('CORREO'), 'ASESOR' => $query->NOMBRE_ASESOR,
                    'GUESS_NOMBRE' => $query->NOMBRE_PRACTICANTE, 'ID_PRACTICANTE' => $query->ID_PRACTICANTE]);
                if($this->input->post('CONSECUTIVO'))
                {
                    $this->session->set_userdata(['CONSECUTIVO' => $this->input->post('CONSECUTIVO')]);
                }
                return true;
            }
            else
            {
                return false;
            }
        }

        public function ExisteRegistro($Consecutivo, $Tipo)
        {
            return $this->db->query("SELECT ID_REGISTRO FROM t_registros WHERE CONSECUTIVO=$Consecutivo AND TIPO='$Tipo' AND ID_ASESOR=" . $this->session->userdata('ID_USUARIO'))->num_rows() > 0;
        }

        public function TraeRegistroNotas($Consecutivo)
        {
            if($this->ExisteRegistro($Consecutivo, 'RN'))
            {
                return $this->db->query("SELECT
                  NOTA1,
                  NOTA2,
                  CODIGO,
                  ID_PROYECTO

               FROM t_registro_notas

                WHERE CONSECUTIVO=$Consecutivo");
            }
            else
            {
                return null;
            }
        }
    }
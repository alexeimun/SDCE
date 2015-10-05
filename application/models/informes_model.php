<?php

    Class Informes_model extends CI_Model
    {
        public function __construct()
        {
            parent::__construct();
        }

        public function EliminaGastosTransporte()
        {
            $this->db->delete('t_registros', ['TIPO' => 'GT', 'CONSECUTIVO' => $this->input->post('Id')]);
            $this->db->delete('t_gastos_transporte', ['CONSECUTIVO' => $this->input->post('Id')]);
        }

        public function EliminarInformeMensual()
        {
            $this->db->delete('t_registros', ['TIPO' => 'IM', 'CONSECUTIVO' => $this->input->post('Id')]);
            $this->db->delete('t_informes_mensuales', ['CONSECUTIVO' => $this->input->post('Id')]);
        }

        public function EliminaAsesoriaPractica()
        {
            $this->db->delete('t_asesoria_practicas', ['TIPO' => 'AP', 'ID_ASESORIA_PRACTICA' => $this->input->post('Id')]);
        }

        public function TraeTodoGastosTransporte()
        {
            return @$this->db->query("SELECT * FROM t_registros WHERE TIPO='GT' AND ID_ASESOR=" . $this->session->userdata('ID_USUARIO') . " ORDER BY CONSECUTIVO DESC")->result('array');
        }

        public function TraeTodoInformeMensuales()
        {
            return @$this->db->query("SELECT
            * FROM t_registros WHERE TIPO='IM' AND ID_ASESOR=" . $this->session->userdata('ID_USUARIO') . " ORDER BY CONSECUTIVO DESC")->result('array');
        }

        public function TraeRegistro($Consecutivo, $Tipo)
        {
            return @$this->db->query("SELECT * FROM t_registros WHERE TIPO='$Tipo' AND CONSECUTIVO=$Consecutivo")->result()[0];
        }

        public function TraeGastosTransporte($Consecutivo)
        {
            if($this->ExisteRegistro($Consecutivo, 'GT'))
            {
                return $this->db->query("SELECT
              ACTIVIDAD,
              VALOR_UNITARIO,
              FECHA_GASTO,
              NUMERO_DESPLAZAMIENTOS,
              LUGAR,
              (NUMERO_DESPLAZAMIENTOS*VALOR_UNITARIO) AS VALOR_TOTAL

               FROM t_gastos_transporte

                WHERE CONSECUTIVO=$Consecutivo AND ID_ASESOR=".$this->session->userdata('ID_USUARIO'));
            }
            else
            {
                return null;
            }
        }

        public function ExisteRegistro($Consecutivo, $Tipo)
        {
            return $this->db->query("SELECT ID_REGISTRO FROM t_registros WHERE CONSECUTIVO=$Consecutivo AND TIPO='$Tipo' AND ID_ASESOR=" . $this->session->userdata('ID_USUARIO'))->num_rows() > 0;
        }

        public function TraeInformeMensual($Consecutivo)
        {
            if($this->ExisteRegistro($Consecutivo, 'IM'))
            {
                return @$this->db->query("SELECT DISTINCT
               AVANCES,
               OBSERVACIONES,
               FECHAS,
               t_proyectos.ID_PROYECTO,
               t_proyectos.NOMBRE_PROYECTO

               FROM t_informes_mensuales
               INNER JOIN t_proyectos USING (ID_PROYECTO)

                WHERE CONSECUTIVO=$Consecutivo");
            }
            else
            {
                return null;
            }
        }

        public function TraeAsesoriaPractica($id)
        {
            return @$this->db->query("SELECT
              TIPO_ASESORIA,
              FECHA_HORA,
              REUNION_ASESORIA,
              t_practicantes.ID_PRACTICANTE

               FROM t_asesoria_practicas
               INNER  JOIN t_practicantes USING (ID_PRACTICANTE)

                WHERE ID_ASESORIA_PRACTICA=$id AND t_practicantes.ID_ASESOR=" . $this->session->userdata('ID_USUARIO'));
        }

        public function TraeInformacionCabezera($id)
        {
            return @$this->db->query("SELECT
              t_proyectos.NOMBRE_PROYECTO,
              t_proyectos.ID_PROYECTO,
              t_agencias.NOMBRE_AGENCIA,
              t_agencias.DIRECCION DIRECCION_AGENCIA,
              CASE t_practicantes.ID_PROGRAMA WHEN 1 THEN 'Ingeniería de Sistemas' WHEN 2 THEN 'Ingeniería de Software' WHEN 3 THEN 'Electromedicina' ELSE 'N/A' END PROGRAMA,
              t_cooperadores.NOMBRE_COOPERADOR

               FROM t_practicantes
               INNER  JOIN t_proyectos USING (ID_PROYECTO)
               INNER  JOIN t_agencias USING (ID_AGENCIA)
               INNER  JOIN t_cooperadores ON t_cooperadores.ID_AGENCIA=t_agencias.ID_AGENCIA

                WHERE t_practicantes.ID_PRACTICANTE=$id AND t_practicantes.ID_ASESOR=" . $this->session->userdata('ID_USUARIO'))->result()[0];
        }

        public function InsertarLink()
        {
            $this->db->set('FECHA_REGISTRO', 'NOW()', false);
            $this->db->set('CONSECUTIVO', $this->consecutivos_model->TraeConsecutivoAsesoria($this->input->post('ID_PROYECTO')));
            $this->db->set('FECHA_CADUCA', (new DateTime())->add(new DateInterval('P90D'))->format('Y-m-d H:i:s'));
            $this->db->insert('t_links', ['ID_PRACTICANTE' => $this->input->post('ID_PRACTICANTE'), 'TIPO' => 'ap']);
        }

        public function InsertarGastosTransporte()
        {
            $Post = $this->input->post(null, true);
            $Total = 0;

            $semestre = date('m') > 6 ? date('Y-07-01') : date('Y-01-01');
            //$semestre = '2016-01-01';
            $TieneSemestre=$this->ExisteSemestre($semestre);

            $Consecutivo = $this->consecutivos_model->TraeGastosTransporte($TieneSemestre);

            if(!$TieneSemestre)
            {
                $this->db->set('FECHA_REGISTRO', 'NOW()', false);
                $this->db->set('ID_ASESOR', $this->session->userdata('ID_USUARIO'));
                $this->db->set('SEMESTRE', $semestre);
                $this->db->insert('t_registros', ['CONSECUTIVO' => $Consecutivo, 'TOTAL' => $Total, 'ID_ASESOR' => $this->session->userdata('ID_USUARIO'), 'TIPO' => 'GT']);
                $this->consecutivos_model->ActualizaGastosTransporte();
            }

            foreach ($Post['FECHA_GASTO'] as $i => $reg)
            {
                $VU = str_replace(',', '', str_replace('$', '', $Post['VALOR_UNITARIO'][$i]));
                $Data[] =
                    [
                        'FECHA_GASTO' => $Post['FECHA_GASTO'][$i],
                        'LUGAR' => $Post['LUGAR'][$i],
                        'ACTIVIDAD' => $Post['ACTIVIDAD'][$i],
                        'NUMERO_DESPLAZAMIENTOS' => $Post['NUMERO_DESPLAZAMIENTOS'][$i],
                        'VALOR_UNITARIO' => $VU,
                        'CONSECUTIVO' => $Consecutivo,
                        'ID_ASESOR' => $this->session->userdata('ID_USUARIO'),
                    ];
                $Total += $Post['NUMERO_DESPLAZAMIENTOS'][$i] * $VU;
            }

            $this->db->insert_batch('t_gastos_transporte', $Data);

            $this->db->update('t_registros', ['TOTAL' => $Total], ['ID_ASESOR' => $this->session->userdata('ID_USUARIO'), 'CONSECUTIVO' => $Consecutivo, 'TIPO' => 'GT']);


            if($this->db->trans_status() == false)
            {
                $this->db->trans_rollback();
            }
            else
            {
                $this->db->trans_complete();
                echo $Consecutivo;
            }
        }

        public function InsertarInformeMensual()
        {
            array_shift($_POST['ID_PROYECTO']);
            $Post = $this->input->post(null, true);
            $Consecutivo = $this->consecutivos_model->TraeConsecutivoInformeMensual();

            foreach ($Post['ID_PROYECTO'] as $i => $reg)
            {
                $Data[] =
                    [
                        'ID_PROYECTO' => $Post['ID_PROYECTO'][$i],
                        'FECHAS' => $Post['FECHAS'][$i],
                        'AVANCES' => $Post['AVANCES'][$i],
                        'OBSERVACIONES' => $Post['OBSERVACIONES'][$i],
                        'CONSECUTIVO' => $Consecutivo,
                    ];
            }

            $this->db->trans_start();

            $this->db->insert_batch('t_informes_mensuales', $Data);

            $this->db->set('FECHA_REGISTRO', 'NOW()', false);
            $this->db->set('ID_ASESOR', $this->session->userdata('ID_USUARIO'));

            $this->db->insert('t_registros', ['CONSECUTIVO' => $Consecutivo, 'TIPO' => 'IM']);
            $this->consecutivos_model->ActualizaConsecutivoInformeMensual();

            if($this->db->trans_status() == false)
            {
                $this->db->trans_rollback();
            }
            else
            {
                $this->db->trans_complete();
                echo $Consecutivo;
            }
        }

        public function InsertarAsesoriaPractica()
        {
            $this->db->trans_start();

            $this->db->set('ID_PRACTICANTE', $this->session->userdata('ID_PRACTICANTE'));
            $this->db->set('CONSECUTIVO', $this->session->userdata('CONSECUTIVO'));
            $this->db->insert('t_asesoria_practicas', $this->input->post(null, true));

            $this->db->set('FECHA_FINALIZA', 'NOW()', false);
            $this->db->update('t_links', ['FINALIZADO' => 1], ['TIPO' => 'ap', 'ID_PRACTICANTE' => $this->session->userdata('ID_PRACTICANTE')]);

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

        public function ExisteLink()
        {
            return $this->db->query("SELECT DISTINCT
             ID_LINK

             FROM t_links
             INNER JOIN t_practicantes ON t_practicantes.ID_PRACTICANTE=t_links.ID_PRACTICANTE
             INNER JOIN t_proyectos ON t_proyectos.ID_PROYECTO=t_practicantes.ID_PROYECTO
             WHERE FECHA_CADUCA>=CURDATE()

             AND t_links.ID_PRACTICANTE='$_GET[_id]' AND t_links.TIPO='$_GET[_type]'
             AND MD5(concat(t_practicantes.DOCUMENTO,t_practicantes.CORREO_PRACTICANTE,'id_proyecto',t_proyectos.ID_PROYECTO,'consecutivo','$_GET[_cvo]'))='$_GET[_link]'
              AND  t_links.FINALIZADO=0 LIMIT 1")->num_rows() > 0;
        }

        private function ExisteSemestre($semestre)
        {
            return $this->db->query("SELECT DISTINCT
             SEMESTRE

             FROM t_registros
             WHERE SEMESTRE='$semestre' AND ID_ASESOR=".$this->session->userdata('ID_USUARIO'))->num_rows() > 0;
        }

        public function TraeAsesoriaPracticas()
        {
            return $this->db->query("SELECT DISTINCT
            t_asesoria_practicas.ID_ASESORIA_PRACTICA,
            t_asesoria_practicas.CONSECUTIVO,
            t_asesoria_practicas.FECHA_HORA,
            t_asesoria_practicas.TIPO_ASESORIA,
            t_asesoria_practicas.REUNION_ASESORIA,
            t_practicantes.NOMBRE_PRACTICANTE,
            t_proyectos.NOMBRE_PROYECTO,
            t_links.FECHA_FINALIZA

            FROM t_asesoria_practicas
            INNER JOIN t_practicantes USING(ID_PRACTICANTE)
            INNER JOIN t_proyectos ON t_practicantes.ID_PRACTICANTE=t_proyectos.ID_PROYECTO
            INNER JOIN t_links ON t_asesoria_practicas.ID_PRACTICANTE=t_links.ID_PRACTICANTE

            WHERE t_practicantes.ID_ASESOR=" . $this->session->userdata('ID_USUARIO') . " ORDER BY t_links.FECHA_FINALIZA")->result('array');
        }
    }
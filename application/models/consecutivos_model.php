<?php

    Class consecutivos_model extends CI_Model
    {
        public function __construct()
        {
            parent::__construct();
        }

        public function ActualizaGastosTransporte()
        {
            $this->db->query("UPDATE  t_consecutivos SET CONSECUTIVO=CONSECUTIVO+1 WHERE NOMBRE='GT'");
        }

        public function ActualizaConsecutivoInformeMensual()
        {
            $this->db->query("UPDATE  t_consecutivos SET CONSECUTIVO=CONSECUTIVO+1 WHERE NOMBRE='InformeMensual'");
        }

        public function ActualizaConsecutivoRegistroNotas()
        {
            $this->db->query("UPDATE  t_consecutivos SET CONSECUTIVO=CONSECUTIVO+1 WHERE NOMBRE='RegistroNotas'");
        }

        public function TraeGastosTransporte($Tienesemestre)
        {
            if($this->ExisteConsecutivoGT() && $Tienesemestre)
            {
                return @$this->db->query("SELECT CONSECUTIVO FROM  t_consecutivos WHERE NOMBRE='GT' AND ID_USUARIO=" . $this->session->userdata('ID_USUARIO'))
                    ->result()[0]->CONSECUTIVO - 1;
            }
            else
            {
                $this->db->insert('t_consecutivos', ['NOMBRE' => 'GT', 'CONSECUTIVO' => 1, 'ID_USUARIO' => $this->session->userdata('ID_USUARIO')]);
                return @$this->db->query("SELECT CONSECUTIVO FROM  t_consecutivos WHERE NOMBRE='GT' AND ID_USUARIO=" . $this->session->userdata('ID_USUARIO'))
                    ->result()[0]->CONSECUTIVO;
            }
        }

        private function ExisteConsecutivoGT()
        {
            return $this->db->query("SELECT CONSECUTIVO FROM  t_consecutivos WHERE NOMBRE='GT' AND ID_USUARIO=" . $this->session->userdata('ID_USUARIO'))
                ->num_rows() > 0;
        }

        public function TraeConsecutivoRegistroNotas()
        {
            return @$this->db->query("SELECT CONSECUTIVO FROM  t_consecutivos WHERE NOMBRE='RegistroNotas'")->result()[0]->CONSECUTIVO;
        }

        public function TraeConsecutivoInformeMensual()
        {
            return @$this->db->query("SELECT CONSECUTIVO FROM  t_consecutivos WHERE NOMBRE='InformeMensual'")->result()[0]->CONSECUTIVO;
        }

        public function TraeConsecutivoAsesoria($IdProyecto)
        {
            if($this->ExisteConsecutivoAsesoria())
            {
                return $this->db->query("SELECT CONSECUTIVO FROM  t_consecutivos WHERE ID_PROYECTO= $IdProyecto AND NOMBRE='ap'")->result()[0]->CONSECUTIVO;
            }
            else
            {
                $this->db->insert('t_consecutivos', ['NOMBRE' => 'ap', 'CONSECUTIVO' => 1, 'ID_PROYECTO' => $IdProyecto]);
                return 1;
            }
        }

        private function ExisteConsecutivoAsesoria()
        {
            return @$this->db->query("SELECT CONSECUTIVO FROM  t_consecutivos WHERE ID_PROYECTO= " . $this->input->post('ID_PROYECTO') . " AND NOMBRE='ap'")->num_rows() > 0;
        }

        public function ActualizaConsecutivoAsesoria()
        {
            $this->db->query("UPDATE t_consecutivos SET CONSECUTIVO=CONSECUTIVO+1 WHERE NOMBRE='ap' AND ID_PROYECTO=" . $this->input->post('ID_PROYECTO'));
        }
    }
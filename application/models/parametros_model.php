<?php

    Class parametros_model extends CI_Model
    {
        public function __construct()
        {
            parent::__construct();
        }

        public function InsertaPeriodo()
        {
            $this->session->set_userdata(['PERIODO' => $this->input->post('PERIODO')]);
            $this->session->set_userdata(['FPERIODO' => (new DateTime($this->input->post('PERIODO')))->add(new DateInterval('P6M'))->format('Y-m-d')]);
            $this->db->update('t_usuarios', ['PERIODO' => $this->input->post('PERIODO')], ['ID_USUARIO' => $this->session->userdata('ID_USUARIO')]);
        }

        public function TraeDependencias()
        {
            return $this->db->get('t_dependencias')->result()[0];
        }

        public function ActualizarDependencias()
        {
            $this->db->set('FECHA_REGISTRO', 'now()', false);
            $this->db->update('t_dependencias', $this->input->post(null, true));
        }

        public function TraePeriodo()
        {
            $q = $this->db->query("SELECT
              PERIODO
               FROM t_usuarios
                WHERE ID_USUARIO=" . $this->session->userdata('ID_USUARIO'));
            return $q->num_rows() > 0 ? $q->result()[0]->PERIODO : null;
        }

        public function CrearMesComponente()
        {
            $select = "<select class='form-control' name='MES'>";
            $select .= '<option>-- Seleccione un mes --</option>';

            if(date('m', strtotime($this->session->userdata('PERIODO'))) > 6)
            {
                for ($i = 7; $i <= 12; $i++)
                {
                    $select .= "<option value='$i' >" . MesNombre($i) . "</option>";
                }
            }
            else
            {
                for ($i = 1; $i <= 6; $i++)
                {
                    $select .= "<option value='$i' >" . MesNombre($i) . "</option>";
                }
            }
            return $select . '</select>';
        }

        public function CrearPeriodoComponente($inicial)
        {
            $p1 = new DateTime($inicial . '-01-01');
            $actual = new DateTime(date('Y-m-d'));
            $select = "<select class='form-control' name='PERIODO'>";
            $Options = [];
            $selected = $this->TraePeriodo();

            while ($actual >= $p1)
            {
                $Options[] = ['value' => $p1->format('Y-m-d'), 'text' => $p1->format('Y') . '-' . ($p1->format('m') > 6 ? 2 : 1)];
                $p1->add(new DateInterval('P6M'));
            }
            for ($i = count($Options) - 1; $i >= 0; $i--)
            {
                $select .= "<option value='" . $Options[$i]['value'] . "' " . ($selected == $Options[$i]['value'] ? 'selected' : '') . ">" . $Options[$i]['text'] . "</option>";
            }
            $select .= "</select>";
            return $select;
        }
    }
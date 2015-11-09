<?php

    Class parametros_model extends CI_Model
    {
        public function __construct()
        {
            parent::__construct();
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

        public function EnviarNoticiasYMensajes()
        {
            $Asesores = explode(',', $_POST['ID_ASESOR']);
            $Noticias = [];
            unset($_POST['_wysihtml5_mode'], $_POST['ID_ASESOR'], $_POST['tabla_length']);

            $this->db->set('FECHA_ENVIO', 'now()', false);
            $this->db->set('ENVIADO_POR', $this->session->userdata('ID_USUARIO'));
            $this->db->insert('t_noticias', $this->input->post(null, true));
            $id_noticia = @$this->db->query("SELECT max(ID_NOTICIA) ID FROM t_noticias")->result()[0]->ID;

            foreach ($Asesores as $asesor)
            {
                $Noticias[] =
                    [
                        'ID_NOTICIA' => $id_noticia,
                        'ID_ASESOR' => $asesor,
                    ];
            }
            $this->db->insert_batch('t_destinatarios', $Noticias);
        }

        public function TraePeriodo()
        {
            $q = $this->db->query("SELECT
              PERIODO
               FROM t_usuarios
                WHERE ID_USUARIO=" . $this->session->userdata('ID_USUARIO'));
            return $q->num_rows() > 0 ? $q->result()[0]->PERIODO : date('Y-') . (date('m') > 6 ? '07' : '01') . '-01';
        }

        public function TraeNoticias()
        {
            return $this->db->query("SELECT
              t_noticias.ID_NOTICIA,
              t_noticias.TIPO,
              t_noticias.ASUNTO,
              t_noticias.FECHA_ENVIO

               FROM t_destinatarios
               INNER JOIN t_noticias ON t_destinatarios.ID_NOTICIA=t_noticias.ID_NOTICIA
                WHERE t_noticias.TIPO=1 AND t_destinatarios.ID_ASESOR=" . $this->session->userdata('ID_USUARIO'))->result();
        }

        public function TraeNoticia($idnoticia)
        {
            $q = $this->db->query("SELECT
              t_noticias.ID_NOTICIA,
              t_noticias.TIPO,
              t_noticias.MENSAJE,
              t_noticias.ASUNTO,
              t_noticias.FECHA_ENVIO,
              t_usuarios.NOMBRE NOMBRE_USUARIO

               FROM t_destinatarios
               INNER JOIN t_noticias ON t_destinatarios.ID_NOTICIA=t_noticias.ID_NOTICIA
               INNER JOIN t_usuarios ON t_usuarios.ID_USUARIO=t_noticias.ENVIADO_POR
                WHERE t_noticias.TIPO=1 AND t_destinatarios.ID_NOTICIA=$idnoticia AND t_destinatarios.ID_ASESOR=" . $this->session->userdata('ID_USUARIO') . ' limit 1');
            return $q->num_rows() > 0 ? $q->result()[0] : null;
        }

        public function TraeMensajes()
        {
            return $this->db->query("SELECT
              t_noticias.ID_NOTICIA,
              t_noticias.TIPO,
              t_noticias.MENSAJE,
              t_noticias.ASUNTO,
              t_noticias.FECHA_ENVIO

               FROM t_destinatarios
               INNER JOIN t_noticias ON t_destinatarios.ID_NOTICIA=t_noticias.ID_NOTICIA
                WHERE t_noticias.TIPO=2 AND t_destinatarios.ID_ASESOR=" . $this->session->userdata('ID_USUARIO'))->result();
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

        public function CrearPeriodoComponente($inicial, $periodo = null)
        {
            $p1 = new DateTime($inicial . '-01-01');
            $actual = new DateTime((date('Y') + 1) . date('-m-d'));
            $select = "<select class='form-control' name='PERIODO'>";
            $Options = [];
            $selected = !is_null($periodo) ? $periodo : $this->TraePeriodo();

            while ($actual >= $p1)
            {
                $Options[] = ['value' => $p1->format('Y-m-d'), 'text' => $p1->format('Y') . '-' . ($p1->format('m') > 6 ? 2 : 1)];
                $p1->add(new DateInterval('P6M'));
            }
            for ($i = count($Options) - 2; $i >= 0; $i--)
            {
                $select .= "<option value='" . $Options[$i]['value'] . "' " . ($selected == $Options[$i]['value'] ? 'selected' : '') . ">" . $Options[$i]['text'] . "</option>";
            }
            $select .= "</select>";
            return $select;
        }

        public function CrearModuloComponente($id = 0, $disabled = false)
        {
            $disabled = $disabled ? 'disabled' : '';
            $list = '<div class="well-lg bg-blue-active" style="margin: 20px;padding: 20px 20px 20px 50px;">';
            foreach ($this->usuarios_model->TraeModulos() as $module)
            {
                $checked = 'checked';
                if($id != 0)
                {
                    $checked = $this->usuarios_model->TraePermiso($module['name'], $id) ? 'checked' : '';
                }
                $list .= "<div class='form-group'>
                    <div class='col-lg-2 col-sm-2'>
                    <input type='checkbox' name='PERMISOS[]' value='$module[name]'  id='$module[name]' $disabled $checked>
                    </div>
                       <label for='$module[name]' class='col-lg-2 col-sm-2 col-lg-pull-1 control-label' style='color: white'>" . ucfirst($module['name']) . "</label>
                    </div>";
            }
            $list .= "</div>";
            return $list;
        }

        public function PeriodoAcademicoHeader($inicial)
        {
            $p1 = new DateTime($inicial . '-01-01');
            $actual = new DateTime((date('Y') + 1) . date('-m-d'));
            $periodo = $this->TraePeriodo();

            $select = "<li id='periodoacademico' class='dropdown messages-menu' data-periodo_academico_url='" . site_url('parametros/CambiarPeriodoAcdemicoAjax') . "'>
                        <a href='#' class='dropdown-toggle' data-toggle='dropdown'>
                             <i class='ion ion-university'></i> <b>" . date('Y', strtotime($periodo)) . '-' . (date('m', strtotime($periodo)) > 6 ? 2 : 1) . "</b>
                                </a>
                                <ul class='dropdown-menu'>
                                    <li>
                                        <!-- inner menu: contains the actual data -->
                                           <ul class='menu'>";

            while ($actual >= $p1)
            {
                $Options[] = ['value' => $p1->format('Y-m-d'), 'text' => $p1->format('Y') . '-' . ($p1->format('m') > 6 ? 2 : 1)];
                $p1->add(new DateInterval('P6M'));
            }
            for ($i = count($Options) - 2; $i >= 0; $i--)
            {
                $pr = $this->ContarPracticantesPeriodo($Options[$i]['value']);
                $select .= "<li>
                                <a href='#' data-periodo_academico='" . $Options[$i]['value'] . "'>
                                         <h4>
                                        <i class='ion-university'></i> " . $Options[$i]['text'] . "
                                        <small><i class='ion ion-person-stalker'></i> $pr " . ($pr == 1 ? 'practicante' : 'practicantes') . " </small>
                                    </h4>
                                </a>
                            </li>";
            }
            $select .= " </ul>
                            </li>
                        </ul>
                    </li>";
            return $select;
        }

        public function ContarPracticantesPeriodo($periodo)
        {
            return $this->db->query("SELECT
                              COUNT(ID_PRACTICANTE) TOTAL
                            FROM t_practicantes
                            INNER JOIN t_proyectos USING (ID_PROYECTO)
                            WHERE t_proyectos.PERIODO='$periodo' AND t_practicantes.ID_ASESOR=" . $this->session->userdata('ID_USUARIO'))->result()[0]->TOTAL;
        }

        public function CambiarPeriodoAcdemicoAjax()
        {
            $this->session->set_userdata(['PERIODO' => $this->input->post('PERIODO')]);
            return $this->db->update('t_usuarios', ['PERIODO' => $this->input->post('PERIODO')], ['ID_USUARIO' => $this->session->userdata('ID_USUARIO')]);
        }

        public function TareTodoPracticantesAsesor($idasesor)
        {
            $data['TPRA'] = $this->db->query("SELECT count(ID_PRACTICANTE) TPRA FROM t_practicantes WHERE ID_ASESOR=$idasesor")->result()[0]->TPRA;
            $data['TPRO'] = $this->db->query("SELECT count(ID_PROYECTO) TPRO FROM t_proyectos WHERE ID_ASESOR=$idasesor")->result()[0]->TPRO;
            $data['ESTADO'] = $this->db->query("SELECT FACHA_ULTIMO_INICIO_SESION U,LOG_IN L  FROM t_usuarios WHERE ID_USUARIO=$idasesor")->result()[0];
            return $data;
        }
    }
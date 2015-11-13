<?php

    class Noticias extends CI_Controller
    {
        function __construct()
        {
            parent::__construct();

            $this->load->model(['usuarios_model', 'parametros_model']);
        }

        public function index()
        {
            if(!$this->session->userdata('ADMIN'))
            {
                redirect(site_url(), 'refresh');
            }
            else
            {
                $this->load->view('Noticias/Noticias');
            }
        }

        public function crearnoticia()
        {
            if(!$this->session->userdata('ADMIN'))
            {
                redirect(site_url(), 'refresh');
            }

            if($this->input->is_ajax_request())
            {
                $this->parametros_model->EnviarNoticias();
            }
            else
            {
                $this->load->view('Noticias/CrearNoticia');
            }
        }

        public function vernoticia($id)
        {
            if(is_numeric($id) && $this->session->userdata('ID_USUARIO'))
            {
                if($this->session->userdata('ADMIN'))
                {
                    $Data = $this->parametros_model->TraeNoticiaAdmin($id);

                }
                else
                {
                    $Data = $this->parametros_model->TraeNoticia($id);
                }
                $Comentarios = $this->parametros_model->TraeComentarios($id);
                if(!is_null($Data))
                {
                    $this->load->view('Noticias/VerNoticia', ['Info' => $Data, 'Comentarios' => $this->ListarComentarios($Comentarios)]);
                }
                else
                {
                    redirect(site_url(), 'refresh');
                }
            }
            else
            {
                redirect(site_url(), 'refresh');
            }
        }

        public function actualizarnoticia($id = null)
        {
            if($this->input->is_ajax_request() && $this->session->userdata('ID_USUARIO'))
            {
                $this->parametros_model->ActualizarNoticia();
            }
            else if(is_numeric($id) && $this->session->userdata('ID_USUARIO'))
            {
                $Data = $this->parametros_model->TraeNoticiaAdmin($id);

                if(!is_null($Data))
                {
                    $this->load->view('Noticias/ActualizarNoticia', ['Info' => $Data]);
                }
                else
                {
                    redirect(site_url(), 'refresh');
                }
            }
            else
            {
                redirect(site_url(), 'refresh');
            }
        }

        public function EliminarNoticia()
        {
            if($this->input->is_ajax_request())
            {
                $this->parametros_model->EliminarNoticia();
            }
            else
            {
                redirect(site_url(), 'refresh');
            }
        }

        public function crearcomentarioAjax()
        {
            if($this->input->is_ajax_request())
            {
                $this->parametros_model->CrearComentario();
                echo $this->ListarComentarios($this->parametros_model->TraeComentarios($this->input->post('ID_NOTICIA')));
            }
        }

        public function ListarComentarios($Comentarios)
        {
            $com = '';
            foreach ($Comentarios as $comentario)
            {
                $com .= '<div class="form-group">
        <div class="row" style="margin-bottom: 5px;">
            <div class="col-lg-10">
                <span style="font-size: 11pt;color:lightslategrey">' . $comentario->NOMBRE . ',  <small style="color:#6e1110"><em>' . Momento($comentario->FECHA_COMENTARIO) . '</em></small></span>
            </div>
        </div>
        <div class="row">
            <img style="width: 70px;height: 60px;"
                 src="' . base_url('asesorfotos/' . $comentario->FOTO) . '"
                 class="col-xs-2 col-sm-2 col-md-2 col-lg-2 img-responsive form-control" alt="User Image"/>

            <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10">
                <div class="box ' . ($comentario->ID_USUARIO % 2 == 0 ? 'box-danger' : 'box-info') . '"
                    style="background: #ffffff;min-height: 60px;padding: 10px;text-align:justify;border-radius:3px;">' . $comentario->COMENTARIO . '
                    </div>

            </div>
        </div>
    </div>';
            }
            return $com;
        }
    }
<?php

    class Proyectos extends CI_Controller
    {
        function __construct()
        {
            parent::__construct();
            $action = @explode('/', uri_string())[1];

            if($this->session->userdata('ASESOR'))
            {
                if($action == '' || $action == 'horarios' || $action == 'TraeHorarioAjax' || $action == 'verproyecto')
                {
                }
            }
            else if(!$this->session->userdata('ADMIN'))
            {
                redirect(site_url(), 'refresh');
            }

            $this->load->model(['proyectos_model', 'practicantes_model']);
        }

        public function index()
        {
            $this->load->view('Proyectos/Proyectos');
        }

        public function horarios()
        {
            if($this->input->is_ajax_request())
            {
                $this->proyectos_model->ActualizarHorarioProyecto();
                $correos = '';
                $practicantes = $this->practicantes_model->TraePracticantesPorProyecto($this->input->post('ID_PROYECTO', true));
                foreach ($practicantes as $correo)
                {
                    $correos .= $correo['CORREO_PRACTICANTE'] . ';';
                }
                $correos = trim($correos, ';');
                mail($correos, 'Horario de asesoría para el proyecto ' . $practicantes[0]['NOMBRE_PROYECTO'],
                    "Buen día,\n\nEl proyecto " . $practicantes[0]['NOMBRE_PROYECTO'] . ", tiene asesorías los días todos los " .
                    NombreDia($this->input->post('HORARIO')) . " de cada semana a las " . date('H:i a', strtotime($this->input->post('HORARIO'))),"From: ".$this->session->userdata('CORREO'));
            }
            else
            {
                $this->load->view('Proyectos/HorarioProyectos');
            }
        }

        public function TraeHorarioAjax()
        {
            if($this->input->is_ajax_request() && !empty($_POST))
            {
                echo form_input(['placeholder' => 'Ingrese un horario', 'name' => 'HORARIO', 'class' => 'obligatorio', 'input' => ['col' => 5], 'label' => ['text' => 'Horario inicial']], $this->proyectos_model->TraeHorario());
            }
            else
            {
                show_404();
            }
        }

        public function tipoproyectos()
        {
            $this->load->view('Proyectos/TipoProyecto/TipoProyecto');
        }

        public function crearproyecto()
        {
            if($this->input->is_ajax_request())
            {
                $this->proyectos_model->InsertarProyecto();
            }
            else
            {
                $this->load->view('Proyectos/CrearProyecto');
            }
        }

        public function creartipoproyecto()
        {
            if($this->input->is_ajax_request())
            {
                $this->proyectos_model->InsertarTipoProyecto();
            }
            else
            {
                $this->load->view('Proyectos/TipoProyecto/CrearTipoProyecto');
            }
        }

        public function actualizarproyecto($Id = null)
        {
            if($this->input->is_ajax_request())
            {
                $this->proyectos_model->ActualizarProyecto();
            }
            else if(is_numeric($Id))
            {
                $Data = $this->proyectos_model->TraeProyecto($Id);

                if($Data != null)
                {
                    $this->load->view('Proyectos/ActualizarProyecto', ['Info' => $Data]);
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

        public function verproyecto($Id)
        {
            if(is_numeric($Id))
            {
                $Data = $this->proyectos_model->TraeProyecto($Id);

                if($Data != null)
                {
                    $this->load->view('Proyectos/VerProyecto', ['Info' => $Data]);
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

        public function eliminarproyecto()
        {
            if($this->input->is_ajax_request())
            {
                $this->proyectos_model->EliminarProyecto();
            }
            else
            {
                redirect(site_url(), 'refresh');
            }
        }

        public function eliminartipoproyecto()
        {
            if($this->input->is_ajax_request())
            {
                $this->proyectos_model->EliminarTipoProyecto();
            }
            else
            {
                redirect(site_url(), 'refresh');
            }
        }
    }
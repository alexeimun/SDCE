<?php

    class Usuario extends CI_Controller
    {
        function __construct()
        {
            parent::__construct();

            if($this->input->is_ajax_request())
            {
            }
            else if(!$this->session->userdata('ADMIN'))
            {
                redirect(site_url(), 'refresh');
            }
            $this->load->model(['practicantes_model']);
        }

        public function index()
        {
            $this->rbca->can('usuarios');
            $this->load->view('Usuarios/Usuarios');
        }

        public function asesores()
        {
            $this->rbca->can('asesores');
            $this->load->view('Asesores/Asesores');
        }

        public function crearasesor()
        {
            $this->rbca->can('asesores');
            if($this->input->is_ajax_request())
            {
                $this->usuarios_model->InsertarAsesor();
                mail($this->input->post('CORREO'), "Credenciales de acceso a SDCE FI-FUMC", "Su usuario de de acceso es: " . $this->input->post('CORREO')
                    . "\nSu clave es: Sdce" . date('Y') . "\nLink de ingreso: " . site_url("asesor") .
                    "\n\nNo olvide cambiar su clave en cuanto ingrese al portal\nCulaquier porblema o inquietud, no dude en cosultarlo
                con la administración del sistema\n\nSDCE FI-FUMC - " . date('Y'));
            }
            else
            {
                $this->load->view('Asesores/CrearAsesor');
            }
        }

        public function crearusuario()
        {
            $this->rbca->can('usuarios');
            if($this->input->is_ajax_request())
            {
                $this->usuarios_model->InsertarUsuario();
            }
            else
            {
                $this->load->view('Usuarios/CrearUsuario', ['Modulos' => $this->parametros_model->CrearModuloComponente()]);
            }
        }

        public function actualizarusuario($Id = null)
        {
            $this->rbca->can('usuarios');
            if($this->input->is_ajax_request())
            {
                $this->usuarios_model->ActualizarUsuario();
            }
            else if(is_numeric($Id))
            {
                $Data = $this->usuarios_model->TraeUsuario($Id);
                if($Data != null)
                {
                    $Pass['Info'] = $Data;
                    if($Data->NIVEL != 2 && $this->session->userdata('ID_USUARIO') != $Data->ID_USUARIO)
                    {
                        $Pass['Modulos'] = $this->parametros_model->CrearModuloComponente($Id);
                    }
                    $this->load->view('Usuarios/ActualizarUsuario', $Pass);
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

        public function actualizarasesor($Id = null)
        {
            if($this->input->is_ajax_request())
            {
                $this->usuarios_model->ActualizarAsesor();
            }
            else if(is_numeric($Id) && $this->rbca->can('asesores', false))
            {
                $Data = $this->usuarios_model->TraeAsesor($Id);

                if($Data != null)
                {
                    $this->load->view('Asesores/ActualizarAsesor', ['Info' => $Data]);
                }
            }
            else
            {
                redirect(site_url(), 'refresh');
            }
        }

        public function VerAsesor($Id)
        {
            $this->rbca->can('asesores');
            if(is_numeric($Id))
            {

                $Data = $this->usuarios_model->TraeAsesor($Id);
                if($Data != null)
                {
                    $this->load->view('Asesores/VerAsesor', ['Info' => $Data, 'Data' => $this->parametros_model->TareTodoPracticantesAsesor($Id)]);
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

        public function VerUsuario($Id)
        {
            $this->rbca->can('usuarios');
            if(is_numeric($Id))
            {
                $Data = $this->usuarios_model->TraeUsuario($Id);
                if($Data != null)
                {
                    $this->load->view('Usuarios/VerUsuario', ['Info' => $Data, 'Info' => $Data, 'Modulos' => $this->parametros_model->CrearModuloComponente($Id, true)]);
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

        public function EliminarUsuario()
        {
            if($this->input->is_ajax_request())
            {
                $this->usuarios_model->EliminarUsuario();
            }
            else
            {
                redirect(site_url(), 'refresh');
            }
        }
    }
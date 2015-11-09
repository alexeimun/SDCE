<?php

    class App extends CI_Controller
    {
        function __construct()
        {
            parent::__construct();
        }

        public function index()
        {
            if($this->session->userdata('ASESOR'))
            {
                $this->load->view('App/Inicio', $this->DashboardAsesor());
            }
            else if($this->session->userdata('ADMIN'))
            {
                $this->load->view('Admin/Inicio/Inicio', $this->DashboarAdmin());
            }
            else
            {
                $this->load->view('App/Roam');
            }
        }

        public function asesor()
        {
            $this->load->view('App/Login');
        }

        public function logout()
        {
            $this->usuarios_model->Lougout();
            $this->session->sess_destroy();
            redirect(site_url(), 'refresh');
        }

        public function error404()
        {
            $this->load->view('App/Error404');
        }

        public function ValidarCredenciales()
        {
            $log = $this->usuarios_model->ValidarCredenciales($this->input->post('usuario', true), $this->input->post('clave', true), $this->input->post('nivel', true));
            if($log != null)
            {
                $this->session->set_userdata(
                    [
                        'NOMBRE_USUARIO' => $log[0]->NOMBRE,
                        'ID_USUARIO' => $log[0]->ID_USUARIO,
                        'DOCUMENTO' => $log[0]->DOCUMENTO,
                        'PERIODO' => $log[0]->PERIODO,
                        'CORREO' => $log[0]->CORREO,
                        'CLAVE' => $log[0]->CLAVE,
                        'NIVEL' => $log[0]->NIVEL,
                        'FOTO' => $log[0]->FOTO,
                        'FECHA_REGISTRO' => MesNombreAbr(round(date_format(new DateTime($log[0]->FECHA_REGISTRO), 'm'))) . '. ' . date_format(new DateTime($log[0]->FECHA_REGISTRO), 'Y'),
                    ]
                );
                $this->usuarios_model->ActualizarInicioSesion();

                if($log[0]->NIVEL == 0)
                {
                    $this->session->set_userdata(['ASESOR' => true]);
                }
                else
                {
                    $this->rbca->load_permissions();
                    $this->session->set_userdata(['ADMIN' => true]);
                }
                echo 'ok';
            }
            else
            {
                sleep(1);
            }
        }

        public function acerca()
        {
            if($this->session->userdata('ID_USUARIO'))
            {
                $this->load->view('App/About');
            }
        }

        public function Perfil()
        {
            if($this->session->userdata('ASESOR'))
            {
                $this->usuarios_model->TraeAsesor($this->session->userdata('ID_USUARIO'));
                $this->load->view('App/Perfil', ['Info' => $this->usuarios_model->TraeAsesor($this->session->userdata('ID_USUARIO'))]);
            }
            else
            {
                redirect(site_url(), 'refresh');
            }
        }

        public function subirimagenasesor()
        {
            //var_dump($_POST);exit;
            $route = '/';
            if($_SERVER['DOCUMENT_ROOT'] == 'C:/wamp/www')
            {
                $route = '/sdce/';
            }
            //Define a destination
            $targetFolder = $_SERVER['DOCUMENT_ROOT'] . $route . 'asesorfotos'; // Relative to the root
            $verifyToken = md5('unique_salt' . $_POST['timestamp']);
            if(!empty($_FILES) && $_POST['token'] == $verifyToken)
            {
                $ext = explode('.', $_FILES['Filedata']['name']);
                $ext = $ext[count($ext) - 1];
                $tempFile = $_FILES['Filedata']['tmp_name'];
                $filename = time() . '.' . $ext;
                $targetFile = rtrim($targetFolder, '/') . '/' . $filename;
                // Validate the file type
                $fileTypes = ['jpg', 'jpeg', 'gif', 'png']; // File extensions
                if(in_array($ext, $fileTypes))
                {
                    if(move_uploaded_file($tempFile, $targetFile))
                    {
                        $this->usuarios_model->EliminaFotoAnteriorAsesor();
                        $this->usuarios_model->ActualizarFotoAsesor($filename);
                        $this->session->set_userdata(['FOTO' => $filename]);
                        echo json_encode(['status' => true, 'data' => $filename]);
                    }
                }
                else
                {
                    echo json_encode(['status' => false, 'data' => '<h2 style="color: #d3d3d3">Tipo de archivo denegado.</h2>']);
                }
            }
        }

        private function DashboardAsesor()
        {
            $this->load->model(['practicantes_model', 'agencias_model', 'proyectos_model', 'seguimientos_model']);
            $Dashboard["Practicantes"] = $this->parametros_model->ContarPracticantesPeriodo($this->session->userdata('PERIODO'));
            $Dashboard["Proyectos"] = $this->proyectos_model->ContarProyectos(true)->PROYECTOS;

            return ['Dashboard' => $this->load->view('Dashboard/DashboardAsesor', $Dashboard, true)];
        }

        private function DashboarAdmin()
        {
            $this->load->model(['practicantes_model', 'agencias_model', 'proyectos_model', 'seguimientos_model', 'cooperadores_model']);
            $Dashboard["Practicantes"] = $this->practicantes_model->ContarTodoPracticantes();
            $Dashboard["Asesores"] = $this->usuarios_model->ContarAsesores();
            $Dashboard["Usuarios"] = $this->usuarios_model->ContarUsuarios();
            $Dashboard["Proyectos"] = $this->proyectos_model->ContarProyectos()->PROYECTOS;
            $Dashboard["Agencias"] = $this->agencias_model->ContarAgencias()->AGENCIAS;
            $Dashboard["Cooperadores"] = $this->cooperadores_model->ContarCooperadores();
            return ['Dashboard' => $this->load->view('Dashboard/DashboardAdmin', $Dashboard, true)];
        }
    }
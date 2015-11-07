<?php

    class Informe extends CI_Controller
    {
        function __construct()
        {
            parent::__construct();
            $action = @explode('/', uri_string())[1];
            if($action == 'asesoriapracticas')
            {

            }
            else if(!$this->session->userdata('ASESOR'))
            {
                redirect(site_url(), 'refresh');
            }
            $this->load->model(['informes_model', 'practicantes_model', 'consecutivos_model', 'proyectos_model', 'seguimientos_model']);
            $this->load->library('fpdf/pdf');
        }

        public function changetableAjax()
        {
            if($this->input->is_ajax_request())
            {
                echo Component::Table(['columns' => ['Nombre', 'Correo', 'Documento'],
                    'tableName' => 'practicante', 'id' => 'ID_PRACTICANTE', 'controller' => 'practicantes',
                    'fields' => ['NOMBRE_PRACTICANTE', 'CORREO_PRACTICANTE', 'DOCUMENTO' => 'numeric'], 'actions' => 'r'
                    , 'dataProvider' => $this->practicantes_model->TraePracticantesPorProyecto($this->input->post('ID_PROYECTO'))]);
            }
        }

        public function consecutivoAjax()
        {
            if($this->input->is_ajax_request())
            {
                echo 'Asesoría #' . ($this->consecutivos_model->TraeConsecutivoAsesoria($this->input->post('ID_PROYECTO')));
            }
            else
            {
                show_404();
            }
        }

        public function asesoriapracticas()
        {
            if($this->input->is_ajax_request())
            {
                $_POST['TIPO_ASESORIA'] = $_POST['R1'] == 'a' ? 0 : 1;
                unset($_POST['R1']);
                $this->informes_model->InsertarAsesoriaPractica();
            }
            else if($this->session->userdata('GUESS'))
            {
                $this->load->view('Informes/Asesoria/DiligenciarAsesoriaPractica');
            }
            else if(isset($_GET['_id']) && isset($_GET['_link']) && isset($_GET['_type']) && $this->informes_model->ExisteLink())
            {
                $this->load->view('Informes/Asesoria/IngresoEstudiante');
            }
            else if($this->session->userdata('ASESOR'))
            {
                $this->load->view('Informes/Asesoria/AsesoriaPracticas');
            }
            else
            {
                show_404();
            }
        }

        public function enviarasesoriaspractica()
        {
            if($this->input->is_ajax_request())
            {
                $this->informes_model->InsertarLink();
                $cons = $this->consecutivos_model->TraeConsecutivoAsesoria($this->input->post('ID_PROYECTO'));
                $this->consecutivos_model->ActualizaConsecutivoAsesoria();

                $link = site_url('informe/asesoriapracticas') . '?_link=' . md5(str_replace(',', '', $this->input->post('CC')) . $this->input->post('CORREO') . 'id_proyecto' . $this->input->post('ID_PROYECTO') .
                        'consecutivo' . $cons)
                    . '&_id=' . $this->input->post('ID_PRACTICANTE') . '&_cvo=' . $cons . '&_type=ap';
                #Enviar por correo los links
                $headers = "From: webmaster@sdceadmin.edu.co";
                mail($this->input->post('CORREO'), 'Link de ingreso al portal para el deligenciamiento de la asesoría de prácticas', "Buen día.\nSe ha habilitado un link de ingreso al portal\n
                Recuerde ingresar su correo institucional y la cédula para tener un ingreso limpio y seguro.\nSu link al portal es: " . $link, $headers);
                echo $link;
                echo ' ' . str_replace(',', '', $this->input->post('CC'));
                echo ' ' . $this->input->post('CORREO');
            }
            else
            {
                $this->load->view('Informes/Asesoria/EnviarAsesoriasDePractica');
            }
        }

        public function creargastostransporte()
        {
            if($this->input->is_ajax_request())
            {
                $this->informes_model->InsertarGastosTransporte();
            }
            else
            {
                $this->load->view('Informes/GastosDeTransporte/CrearGastosDeTransporte');
            }
        }

        public function crearinformemensual()
        {
            if($this->input->is_ajax_request())
            {
                //var_dump($_POST);exit;
                $this->informes_model->InsertarInformeMensual();
            }
            else
            {
                $this->load->view('Informes/InformesMensuales/CrearInformeMensual');
            }
        }

        public function gastostransporte()
        {
            $this->load->view('Informes/GastosDeTransporte/GastosDeTransporte');
        }

        public function informesmensuales()
        {
            $this->load->view('Informes/InformesMensuales/InformesMensuales');
        }

        public function eliminargastostransporte()
        {
            if($this->input->is_ajax_request())
            {
                $this->informes_model->EliminaGastosTransporte();
            }
            else
            {
                show_404();
            }
        }

        public function eliminarinformemensual()
        {
            if($this->input->is_ajax_request())
            {
                $this->informes_model->EliminarInformeMensual();
            }
            else
            {
                show_404();
            }
        }

        public function eliminarasesoriapractica()
        {
            if($this->input->is_ajax_request())
            {
                $this->informes_model->EliminaAsesoriaPractica();
            }
            else
            {
                show_404();
            }
        }

        public function imprimirasesoriapracticas($id)
        {
            if(isset($id) && is_numeric($id))
            {
                $Asesoria = $this->informes_model->TraeAsesoriaPractica($id);
                if($Asesoria->num_rows() == 0)
                {
                    redirect(site_url(), 'refresh');
                }
                else
                {
                    $Asesoria = $Asesoria->result()[0];
                }
            }
            else
            {
                redirect(site_url(), 'refresh');
            }
            $pdf = new PDF();
            $pdf->AddPage();
            $Info = $this->informes_model->TraeInformacionCabezera($Asesoria->ID_PRACTICANTE);
            $Practicantes = [];
            foreach ($this->practicantes_model->TraePracticantesPorProyecto($Info->ID_PROYECTO) as $Practicante)
            {
                $Practicantes[] = $Practicante['NOMBRE_PRACTICANTE'];
            }

            $pdf->Image(base_url('public/images/logo.jpg'), 10, 15, 70, 15);

            $pdf->SetFont('Arial', 'B', 10);
            #ENCABEZADO
            //$pdf->SetXY(10,35);
            $pdf->Text(180, 45, 'D0-32-F');
            $pdf->Text(70, 50, 'FORMATO REGISTRO DE ASESORíA DE PRÁCTICA');
            $pdf->Text(10, 60, 'FACULTAD DE INGENIERÍA');
            $pdf->Text(90, 60, 'PROGRAMA DE ' . strtoupper($Info->PROGRAMA));
            $pdf->SetFont('Arial', '', 10);

            #Marco grande
            $pdf->SetXY(10, 65);
            $pdf->Cell(190, 210, '', 1);
            #Nombres estudiantes
            $pdf->SetXY(10, 65);
            $pdf->Cell(190, 18, '', 1);
            $pdf->Text(12, 70, 'NOMBRE DEL (los) ESTUDIANTE (s): ' . ($Practicantes[0]));
            $pdf->Text(12, 76, (isset($Practicantes[1]) ? ($Practicantes[1]) : '') . (isset($Practicantes[2]) ? ', ' . ($Practicantes[2]) : ''));

            #Empresa donde realiza la práctica
            $pdf->SetXY(10, 65);
            $pdf->Cell(190, 25, '', 1);
            $pdf->Text(12, 88, 'EMPRESA DONDE REALIZA LA PRÁCTICA: ' . ($Info->NOMBRE_AGENCIA));
            #Proyecto de práctica
            $pdf->SetXY(10, 65);
            $pdf->Cell(190, 32, '', 1);
            $pdf->Text(12, 95, 'PROYECTO DE PRÁCTICA: ' . ($Info->NOMBRE_PROYECTO));
            #Cooperador
            $pdf->SetXY(10, 65);
            $pdf->Cell(190, 39, '', 1);
            $pdf->Text(12, 102, 'COOPERADOR: ' . ($Info->NOMBRE_COOPERADOR));
            #Dirección empresa
            $pdf->SetXY(10, 65);
            $pdf->Cell(190, 46, '', 1);
            $pdf->Text(12, 109, 'DIRECCIÓN EMPRESA: ' . ($Info->DIRECCION_AGENCIA));
            #Asesoría
            $pdf->Text(12, 119, 'ASESORíA: FUMC');
            $pdf->SetXY(45, 115);
            $pdf->Cell(10, 5, $Asesoria->TIPO_ASESORIA == 0 ? 'X' : '', 1, 0, 'C');
            #Visita agencia
            $pdf->Text(60, 119, 'VISTA AGENCIA:');
            $pdf->SetXY(90, 115);
            $pdf->Cell(10, 5, $Asesoria->TIPO_ASESORIA == 1 ? 'X' : '', 1, 0, 'C');
            #Fecha y hora
            $pdf->Text(110, 119, 'FECHA Y HORA: ' . $Asesoria->FECHA_HORA);
            $pdf->Line(172, 120, 138, 120);
            #Desarrollo de la reunión de asesoría
            $pdf->Text(12, 126, 'Desarrollo de la reunión de asesoría:');
            $pdf->SetFont('Arial', '', 9);
            $pdf->SetXY(12, 131);
            $pdf->MultiCell(185, 4, ($Asesoria->REUNION_ASESORIA), 0);
            $pdf->SetFont('Arial', 'B', 10);
            #Firmas
            $pdf->SetXY(10, 65);
            $pdf->Cell(190, 175, '', 1);
            #Firma asesor
            $pdf->Text(12, 249, 'FIRMA ASESOR:');
            $pdf->Line(102, 249, 42, 249);
            #Firma estudiante
            $pdf->Text(105, 249, 'FIRMA ESTUDIANTE:');
            $pdf->Line(198, 249, 142, 249);
            #Firma estudiante
            $pdf->Text(12, 259, 'FIRMA ESTUDIANTE:');
            $pdf->Line(102, 259, 49, 259);
            #Firma estudiante
            $pdf->Text(105, 259, 'FIRMA ESTUDIANTE:');
            $pdf->Line(198, 259, 142, 259);
            #Firma cooperador
            $pdf->Text(12, 269, 'FIRMA COOPERADOR:');
            $pdf->Line(125/*Longitud*/, 269/*y*/, 52/*x*/, 269/*y*/);

            $pdf->SetFont('Arial', '', 10);
            $pdf->Text(12, 286, 'Fecha de actualización 05/11/2009 Versión 1');
            $pdf->Text(190, 286, '1 de 1');

            $pdf->Output();
            $pdf->Cell($pdf->PageNo());
        }

        public function imprimirgastostransporte($id)
        {
            if(isset($id) && is_numeric($id))
            {
                $Gastos = $this->informes_model->TraeGastosTransporte($id);
                if(!is_null($Gastos))
                {
                    if($Gastos->num_rows() == 0)
                    {
                        redirect(site_url(), 'refresh');
                    }
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

            $pdf = new PDF();
            $pdf->AddPage();
            $Detalle = $this->informes_model->TraeRegistro($id, 'GT');

            $pdf->Image(base_url('public/images/logo.jpg'), 10, 15, 70, 15);

            $pdf->SetFont('Arial', 'B', 10);
            #ENCABEZADO
            $pdf->Text(180, 45, 'D0-69-F');
            $pdf->Text(70, 48, 'FORMATO REPORTE GASTOS DE TRANSPORTE');
            $pdf->Text(75, 55, 'FUNDACIÓN UNIVERSITARIA MARÍA CANO');
            $pdf->Text(78, 60, 'PROGRAMA DE INGENIERÍA DE SISTEMAS');
            $pdf->SetFont('Arial', '', 10);
            $pdf->Text(10, 65, 'Período: ' . (date('m', strtotime($Detalle->FECHA_REGISTRO)) > 6 ? 2 : 1) . ' Semestre ' . date('Y', strtotime($Detalle->FECHA_REGISTRO)));
            $pdf->Text(10, 75, 'Páguese a nombre de: ' . $this->session->userdata('NOMBRE_USUARIO') . '   C.C ' . number_format($this->session->userdata('DOCUMENTO'), 0, ',', ','));

            #Headers
            $pdf->SetFont('Arial', 'B', 9);
            $pdf->SetXY(5, 82);
            $pdf->Cell(25, 10, 'FECHA', 1, 0, 'C');
            $pdf->SetXY(30, 82);
            $pdf->Cell(50, 10, 'LUGAR', 1, 0, 'C');
            $pdf->SetXY(80, 82);
            $pdf->Cell(40, 10, 'ACTIVIDAD', 1, 0, 'C');
            $pdf->SetXY(120, 82);
            $pdf->MultiCell(34, 5, 'NÚMERO DE DESPLAZAMIENTOS', 1, 'C');
            $pdf->SetXY(154, 82);
            $pdf->MultiCell(25, 5, 'VALOR UNITARIO', 1, 'C');
            $pdf->SetXY(179, 82);
            $pdf->MultiCell(27, 10, 'VALOR TOTAL', 1, 'C');

            $pdf->SetFont('Arial', '', 9);

            $pdf->SetWidths([25, 50, 40, 34, 25, 27]);
            $pdf->SetAligns(['C', 'C', 'C', 'C', 'C']);

            $Total = 0;
            foreach ($Gastos->result() as $gasto)
            {
                $pdf->SetX(5);
                $pdf->Row([Fecha($gasto->FECHA_GASTO), utf8_encode($gasto->LUGAR), utf8_encode($gasto->ACTIVIDAD), $gasto->NUMERO_DESPLAZAMIENTOS,
                    number_format($gasto->VALOR_UNITARIO, 0, '', ','), number_format($gasto->VALOR_TOTAL, 0, '', ',')]);
                $Total += $gasto->VALOR_TOTAL;
            }
            $pdf->SetFont('Arial', 'B', 9);

            $pdf->SetX(5);
            $pdf->Row(['', '', '', '', 'Total', number_format($Total, 0, '', ',')]);

            #Footer
            $pdf->Text(25, $pdf->GetY() + 20, 'Firma Coordinador de Práctica');
            $pdf->Line(10, $pdf->GetY() + 15, 90, $pdf->GetY() + 15);
            $pdf->Text(140, $pdf->GetY() + 20, 'CENTRO DE PRÁCTICAS');

            $pdf->Output();
            $pdf->Cell($pdf->PageNo());
        }

        public function imprimirinformemensual($id)
        {
            if(isset($id) && is_numeric($id))
            {
                $Informes = $this->informes_model->TraeInformeMensual($id);

                if(!is_null($Informes))
                {
                    if($Informes->num_rows() == 0)
                    {
                        redirect(site_url(), 'refresh');
                    }
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

            $pdf = new PDF();
            $pdf->AddPage('L');

            $pdf->Image(base_url('public/images/logo.jpg'), 10, 12, 60, 15);

            $pdf->SetFont('Arial', 'B', 10);
            #ENCABEZADO
            //$pdf->SetXY(10,35);
            $pdf->Text(120, 36, 'CENTRO DE PRÁCTICAS');
            $pdf->Text(85, 42, 'FORMATO PARA LA PRESENTACIÓN DE INFORMES MENSUALES');
            $pdf->Text(120, 49, 'ASESORES DE PRÁCTICA');
            $pdf->SetFont('Arial', '', 10);

            #Headers
            $pdf->SetFillColor(230, 230, 230);
            $pdf->SetFont('Arial', 'B', 9);
            $pdf->SetXY(10, 55);
            $pdf->Cell(60, 10, 'Nombre estudiantes', 1, 0, 'C', true);
            $pdf->SetXY(70, 55);
            $pdf->MultiCell(60, 10, 'Nombre empresa y/o proyecto', 1, 'C', true);
            $pdf->SetXY(130, 55);
            $pdf->MultiCell(45, 5, 'Fechas de asesorías realizadas', 1, 'C', true);
            $pdf->SetXY(175, 55);
            $pdf->MultiCell(55, 5, 'Avances, logros y cumplimiento de objetivos', 1, 'C', true);
            $pdf->SetXY(230, 55);
            $pdf->MultiCell(55, 5, 'Observaciones y/o recomendaciones', 1, 'C', true);

            $pdf->SetFont('Arial', '', 9);

            $pdf->SetWidths([60, 60, 45, 55, 55]);
            $pdf->SetAligns(['C', 'C', 'C', 'C', 'C']);

            foreach ($Informes->result() as $informe)
            {
                $Practicantes = '';
                $Agencia = '';
                foreach ($this->practicantes_model->TraePracticantesPorProyecto($informe->ID_PROYECTO, true) as $practicante)
                {
                    $Practicantes .= $practicante['NOMBRE_PRACTICANTE'] . ', ';
                    $Agencia = $practicante['NOMBRE_AGENCIA'] . ', ';
                }
                $Practicantes = substr_replace($Practicantes, '', strlen($Practicantes) - 2, 1);

                $pdf->SetX(10);
                $pdf->Row([trim($Practicantes), $Agencia . $informe->NOMBRE_PROYECTO, $informe->FECHAS, $informe->AVANCES, $informe->OBSERVACIONES]);
            }

            $pdf->Output();
            $pdf->Cell($pdf->PageNo());
        }
    }
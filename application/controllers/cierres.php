<?php

    class Cierres extends CI_Controller
    {
        function __construct()
        {
            parent::__construct();

            if(!$this->session->userdata('ASESOR'))
            {
                redirect(site_url(), 'refresh');
            }

            $this->load->model(['cierres_model', 'practicantes_model', 'parametros_model']);
            $this->load->helper(['cierre']);
        }

        public function admisiones()
        {
            $this->load->view('CierrePracticas/Admisiones/Admisiones');
        }

        public function cartaadmisiones()
        {
            if(!empty($_POST))
            {
                $this->ImprimeCartaAdmisiones();
            }
            else
            {
                $this->load->view('CierrePracticas/Admisiones/CartaAdmisionesYRegistros');
            }
        }

        public function ciad()
        {
            $this->load->view('CierrePracticas/CIAD/CIAD');
        }

        public function cartaciad()
        {
            if(!empty($_POST))
            {
                $this->ImprimeCartaCIAD();
            }
            else
            {
                $this->load->view('CierrePracticas/CIAD/CartaCIAD');
            }
        }

        public function centropracticas()
        {
            $this->load->view('CierrePracticas/CentroPracticas/CentroPracticas');
        }

        public function cartacentropracticas()
        {
            if(!empty($_POST))
            {
                $this->ImprimeCartaCentroPrácticas();
            }
            else
            {
                $this->load->view('CierrePracticas/CentroPracticas/CartaCentroPracticas');
            }
        }

        public function decanatura()
        {
            $this->load->view('CierrePracticas/Decanatura/Decanatura');
        }

        public function cartadecanatura()
        {
            if(!empty($_POST))
            {
                $this->ImprimeCartaDecanatura();
            }
            else
            {
                $this->load->view('CierrePracticas/Decanatura/CartaDecanatura');
            }
        }

        private function ImprimeCartaAdmisiones()
        {
            $this->load->library('fpdf/pdf');
            $pdf = new PDF();
            $pdf->AddPage();

            $pdf->Image(base_url('public/images/logo.jpg'), 80, 15, 60, 18);
            $Dep = $this->parametros_model->TraeDependencias();
            #ENCABEZADO
            $pdf->SetFont('Arial', 'b', 10);
            $pdf->Text(178, 35, 'GD-026-F');
            $pdf->SetFillColor(230, 230, 230);
            $pdf->SetXY(25, 38);
            $pdf->Cell(170, 5, 'MEMORANDO', 0, 0, 'C', true);
            $pdf->Text(25, 48, strtoupper($this->input->post('CONSECUTIVO')));
            $pdf->SetFont('Arial', '', 10);
            $pdf->Text(25, 58, 'Medellín, ' . MesNombre(date('m')) . ' ' . round(date('d')) . ' de ' . date('Y'));
            #PARA
            $pdf->SetFont('Arial', 'b', 10);
            $pdf->Text(25, 75, 'PARA:');
            $pdf->Text(50, 75, ($Dep->ADMISIONES_TITULO == 0 ? 'Doctora' : 'Doctor') . ' ' . $Dep->ADMISIONES);
            $pdf->SetFont('Arial', '', 10);
            $pdf->Text(50, 80, ($Dep->ADMISIONES_TITULO == 0 ? 'Directora' : 'Director') . ' Admisiones Registro y Control Académico');

            #DE
            $pdf->SetFont('Arial', 'b', 10);
            $pdf->Text(25, 90, 'DE:');
            $pdf->Text(50, 90, ($Dep->DECANATURA_TITULO == 0 ? 'Ingeniera' : 'Ingeniero') . ' ' . $Dep->DECANATURA);
            $pdf->SetFont('Arial', '', 10);
            $pdf->Text(50, 95, ($Dep->DECANATURA_TITULO == 0 ? 'Decana' : 'Decano') . ' Facultad de Ingeniería');

            #ASUNTO
            $pdf->SetFont('Arial', 'b', 10);
            $pdf->Text(25, 103, 'ASUNTO:');
            $pdf->SetFont('Arial', '', 10);
            $pdf->SetXY(50, 100);
            $pdf->MultiCell(130, 4, $this->input->post('ASUNTO'));

            $pdf->Text(25, 130, 'Cordial Saludo,');
            $pdf->SetXY(25, 140);
            $pdf->MultiCell(165, 4, ($this->input->post('CARTA')));
            $pdf->Text(25, 20+$pdf->GetY(), 'Atentamente,');

            $pdf->SetFont('Arial', 'b', 10);
            $pdf->Text(25, $pdf->GetY()+40, Ucspecial($Dep->DECANATURA));
            $pdf->SetFont('Arial', '', 10);

            $pdf->Text(25, $pdf->GetY()+45, ($Dep->DECANATURA_TITULO == 0 ? 'Decana' : 'Decano') . ' Facultad de Ingeniería');

            $pdf->Output();
            $pdf->Cell($pdf->PageNo());
        }
        private function ImprimeCartaCIAD()
        {
            $this->load->library('fpdf/pdf');
            $pdf = new PDF();
            $pdf->AddPage();

            $pdf->Image(base_url('public/images/logo.jpg'), 80, 15, 60, 18);
            $Dep = $this->parametros_model->TraeDependencias();
            #ENCABEZADO
            $pdf->SetFont('Arial', 'b', 10);
            $pdf->Text(178, 35, 'GD-026-F');
            $pdf->SetFillColor(230, 230, 230);
            $pdf->SetXY(25, 38);
            $pdf->Cell(170, 5, 'MEMORANDO', 0, 0, 'C', true);
            $pdf->Text(25, 48, strtoupper($this->input->post('CONSECUTIVO')));
            $pdf->SetFont('Arial', '', 10);
            $pdf->Text(25, 58, 'Medellín, ' . MesNombre(date('m')) . ' ' . round(date('d')) . ' de ' . date('Y'));
            #PARA
            $pdf->SetFont('Arial', 'b', 10);
            $pdf->Text(25, 75, 'PARA:');
            $pdf->Text(50, 75, ($Dep->CIAD_TITULO == 0 ? 'Doctora' : 'Doctor') . ' ' . $Dep->CIAD);
            $pdf->SetFont('Arial', '', 10);
            $pdf->Text(50, 80, ($Dep->CIAD_TITULO == 0 ? 'Directora' : 'Director') . ' Centro de Información y Ayudas Didácticas');

            #DE
            $pdf->SetFont('Arial', 'b', 10);
            $pdf->Text(25, 90, 'DE:');
            $pdf->Text(50, 90, ($Dep->DECANATURA_TITULO == 0 ? 'Ingeniera' : 'Ingeniero') . ' ' . $Dep->DECANATURA);
            $pdf->SetFont('Arial', '', 10);
            $pdf->Text(50, 95, ($Dep->DECANATURA_TITULO == 0 ? 'Decana' : 'Decano') . ' Facultad de Ingeniería');

            #ASUNTO
            $pdf->SetFont('Arial', 'b', 10);
            $pdf->Text(25, 103, 'ASUNTO:');
            $pdf->SetFont('Arial', '', 10);
            $pdf->SetXY(50, 100);
            $pdf->MultiCell(130, 4, $this->input->post('ASUNTO'));

            $pdf->Text(25, 130, 'Cordial Saludo,');
            $pdf->SetXY(25, 140);
            $pdf->MultiCell(165, 4, ($this->input->post('CARTA')));
            $pdf->Text(25, 20+$pdf->GetY(), 'Atentamente,');

            $pdf->SetFont('Arial', 'b', 10);
            $pdf->Text(25, $pdf->GetY()+40, Ucspecial($Dep->DECANATURA));
            $pdf->SetFont('Arial', '', 10);

            $pdf->Text(25, $pdf->GetY()+45, ($Dep->DECANATURA_TITULO == 0 ? 'Decana' : 'Decano') . ' Facultad de Ingeniería');

            $pdf->Output();
            $pdf->Cell($pdf->PageNo());
        }
        private function ImprimeCartaCentroPrácticas()
        {
            $this->load->library('fpdf/pdf');
            $pdf = new PDF();
            $pdf->AddPage();

            $pdf->Image(base_url('public/images/logo.jpg'), 80, 15, 60, 18);
            $Dep = $this->parametros_model->TraeDependencias();
            #ENCABEZADO
            $pdf->SetFont('Arial', 'b', 10);
            $pdf->Text(178, 35, 'GD-026-F');
            $pdf->SetFillColor(230, 230, 230);
            $pdf->SetXY(25, 38);
            $pdf->Cell(170, 5, 'MEMORANDO', 0, 0, 'C', true);
            $pdf->Text(25, 48, strtoupper($this->input->post('CONSECUTIVO')));
            $pdf->SetFont('Arial', '', 10);
            $pdf->Text(25, 58, 'Medellín, ' . MesNombre(date('m')) . ' ' . round(date('d')) . ' de ' . date('Y'));
            #PARA
            $pdf->SetFont('Arial', 'b', 10);
            $pdf->Text(25, 75, 'PARA:');
            $pdf->Text(50, 75, ($Dep->CP_TITULO == 0 ? 'Doctora' : 'Doctor') . ' ' . $Dep->CP);
            $pdf->SetFont('Arial', '', 10);
            $pdf->Text(50, 80, ($Dep->CP_TITULO == 0 ? 'Directora' : 'Director') . ' Centro de Prácticas');

            #DE
            $pdf->SetFont('Arial', 'b', 10);
            $pdf->Text(25, 90, 'DE:');
            $pdf->Text(50, 90, ($Dep->DECANATURA_TITULO == 0 ? 'Ingeniera' : 'Ingeniero') . ' ' . $Dep->DECANATURA);
            $pdf->SetFont('Arial', '', 10);
            $pdf->Text(50, 95, ($Dep->DECANATURA_TITULO == 0 ? 'Decana' : 'Decano') . ' Facultad de Ingeniería');

            #ASUNTO
            $pdf->SetFont('Arial', 'b', 10);
            $pdf->Text(25, 103, 'ASUNTO:');
            $pdf->SetFont('Arial', '', 10);
            $pdf->SetXY(50, 100);
            $pdf->MultiCell(130, 4, $this->input->post('ASUNTO'));

            $pdf->Text(25, 130, 'Cordial Saludo,');
            $pdf->SetXY(25, 140);
            $pdf->MultiCell(165, 4, ($this->input->post('CARTA')));
            $pdf->Text(25, 20+$pdf->GetY(), 'Atentamente,');

            $pdf->SetFont('Arial', 'b', 10);
            $pdf->Text(25, $pdf->GetY()+40, Ucspecial($Dep->DECANATURA));
            $pdf->SetFont('Arial', '', 10);

            $pdf->Text(25, $pdf->GetY()+45, ($Dep->DECANATURA_TITULO == 0 ? 'Decana' : 'Decano') . ' Facultad de Ingeniería');

            $pdf->Output();
            $pdf->Cell($pdf->PageNo());
        }
        private function ImprimeCartaDecanatura()
        {
            $this->load->library('fpdf/pdf');
            $pdf = new PDF();
            $pdf->AddPage();

            $pdf->Image(base_url('public/images/logo.jpg'), 80, 15, 60, 18);
            $Dep = $this->parametros_model->TraeDependencias();
            #ENCABEZADO
            $pdf->SetFont('Arial', 'b', 10);
            $pdf->Text(178, 35, 'GD-026-F');
            $pdf->SetFillColor(230, 230, 230);
            $pdf->SetXY(25, 38);
            $pdf->Cell(170, 5, 'MEMORANDO', 0, 0, 'C', true);
            $pdf->Text(25, 48, strtoupper($this->input->post('CONSECUTIVO')));
            $pdf->SetFont('Arial', '', 10);
            $pdf->Text(25, 58, 'Medellín, ' . MesNombre(date('m')) . ' ' . round(date('d')) . ' de ' . date('Y'));
            #PARA
            $pdf->SetFont('Arial', 'b', 10);
            $pdf->Text(25, 75, 'PARA:');
            $pdf->Text(50, 75, ($Dep->DECANATURA_TITULO == 0 ? 'Ingeniera' : 'Ingeniero') . ' ' . $Dep->DECANATURA);
            $pdf->SetFont('Arial', '', 10);
            $pdf->Text(50, 80, ($Dep->DECANATURA_TITULO == 0 ? 'Decana' : 'Decano') . ' Facultad de ingeniería');

            #DE
            $pdf->SetFont('Arial', 'b', 10);
            $pdf->Text(25, 90, 'DE:');
            $pdf->Text(50, 90, $this->input->post('TITULO') . ' ' . $this->session->userdata('NOMBRE_USUARIO'));
            $pdf->SetFont('Arial', '', 10);
            $pdf->Text(50, 95,'Docente Asesor de Prácticas');

            #ASUNTO
            $pdf->SetFont('Arial', 'b', 10);
            $pdf->Text(25, 103, 'ASUNTO:');
            $pdf->SetFont('Arial', '', 10);
            $pdf->SetXY(50, 100);
            $pdf->MultiCell(130, 4, $this->input->post('ASUNTO'));

            $pdf->Text(25, 130, 'Cordial Saludo,');
            $pdf->SetXY(25, 140);
            $pdf->MultiCell(165, 4, ($this->input->post('CARTA')));
            $pdf->Text(25, 20+$pdf->GetY(), 'Atentamente,');

            $pdf->SetFont('Arial', 'b', 10);
            $pdf->Text(25, $pdf->GetY()+40, $this->session->userdata('NOMBRE_USUARIO'));
            $pdf->SetFont('Arial', '', 10);

            $pdf->Text(25, $pdf->GetY()+45, 'Docente Asesor de Prácticas');

            $pdf->Output();
            $pdf->Cell($pdf->PageNo());
        }
    }
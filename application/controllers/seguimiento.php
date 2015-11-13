<?php

    class Seguimiento extends CI_Controller
    {
        function __construct()
        {
            parent::__construct();
            $action = @explode('/', uri_string())[1];
            if($action == 'evaluarestudiante' || $action == 'validaringreso')
            {
            }
            else if(!$this->session->userdata('ASESOR'))
            {
                redirect(site_url(), 'refresh');
            }
            $this->load->model(['practicantes_model', 'seguimientos_model', 'agencias_model', 'proyectos_model', 'cooperadores_model']);
        }

        private $item = 0;
        private $Notas2 = [];

        public function registronotas()
        {
            if(!empty($_POST))
            {
                $this->imprimirregistronotas();
            }
            else
            {
                $this->load->view('Seguimiento/RegistroNotas/RegistroNotas', ['Periodo' => $this->parametros_model->CrearPeriodoComponente(YEAR_SDCE)]);
            }
        }

        public function certificadopazysalvo()
        {
            //if(!empty($_POST))
            $this->ImprimePazySalvo();
        }

        public function calificarpracticante()
        {
            if($this->input->is_ajax_request())
            {
                /**
                 * Significado de los caracteres
                 * A = Asesor
                 * C = Cooperdor
                 * M = Ambos
                 */
                $momento = $this->input->post('MOMENTO', true);
                if($this->seguimientos_model->ExisteCalificacion('M'))
                {
                    echo '¡Ya se ha calificado como ambos a este practicante en el momento ' . $momento . '!';
                }
                else if($this->seguimientos_model->ExisteCalificacion('A') && $this->input->post('PERSONA') == 'A')
                {
                    echo '¡Ya se ha calificado como asesor a este practicante en el momento ' . $momento . '!';
                }
                else if($this->seguimientos_model->ExisteCalificacion('C') && $this->input->post('PERSONA') == 'C')
                {
                    echo '¡Ya se ha calificado como cooperador a este practicante en el momento ' . $momento . '!';
                }
                else if($this->seguimientos_model->ExisteCalificacion('A,C') && $this->input->post('PERSONA') == 'M')
                {
                    echo 'No se puede calificar como ambos a este practicante, debido a que fue calificado anteriormente en el el momento ' . $momento . '.';
                }
                else
                {
                    $persona = '';
                    switch ($this->input->post('PERSONA', true))
                    {
                        case 'A':
                            $persona = 'Asesor';
                            break;
                        case 'M':
                            $persona = 'Ambos';
                            break;
                        case 'C':
                            $persona = 'Cooperador';
                            break;
                    }

                    if($this->seguimientos_model->ExisteCalificacion('C,A'))
                    {
                        $this->seguimientos_model->ActualizaPracticanteMomento();
                    }
                    else if($this->input->post('PERSONA') == 'M')
                    {
                        $this->seguimientos_model->ActualizaPracticanteMomento();
                    }

                    $this->seguimientos_model->InsertarCalificacionPracticante();

                    $correo = $this->practicantes_model->TraePracticante($this->input->post('ID_PRACTICANTE'))->CORREO_PRACTICANTE;
                    $subjet = 'Calificación del ' . ($momento == 1 ? 'primer' : 'segundo') . ' momento calificado como: ' . $persona;
                    $Nota = $this->seguimientos_model->TraeNotasPracticante($this->input->post('ID_PRACTICANTE'));
                    $body = 'Su nota del ' . ($momento == 1 ? 'primer' : 'segundo') . ' momento es:' . $Nota['NOTA' . $momento];
                    //Se envía un correo para poner al tanto al estudiante sobre su nota de evaluación
                    mail($correo, $subjet, $body);
                }
            }
            else
            {
                $this->load->view('Seguimiento/SeguimientoPracticas/CalificarPracticante');
            }
        }

        public function traepracticantesMomentoAjax()
        {
            if($this->input->is_ajax_request())
            {
                $Momento = $this->seguimientos_model->TraeMomento();
                echo '<div class="row"><p class="font1 col-lg-11" style="text-align: center;">' .
                    ($this->seguimientos_model->TraeTodoMomentos() == 0 ? ('<a target="_blank" href="' . site_url('seguimiento/enviarautoevaluacion') . '"><span class="ion-forward"></span> Primero se deben  diligenciar los formularios de autoevaluación</a>')
                        : 'Momento ' . $Momento . '</p> <input type="hidden" name="MOMENTO" value="' . $Momento . '">') .
                    '</div>';
            }
            else
            {
                show_404();
            }
        }

        public function traepracticantesMomentoActualDDAjax()
        {
            if($this->input->is_ajax_request())
            {
                echo '<div class="momento"></div>' . select_input(['text' => 'Practicante', 'collabel' => 3, 'colinput' => 5, 'select' =>
                        Dropdown(['name' => 'ID_PRACTICANTE', 'simple' => true, 'dataProvider' => $this->seguimientos_model->TraePracticantesCalificar(0, true),
                            'placeholder' => '-- Seleccione un practicante --', 'fields' => ['NOMBRE_PRACTICANTE']])]);
            }
            else
            {
                show_404();
            }
        }

        public function traepracticantesDDAjax()
        {
            if($this->input->is_ajax_request() && !empty($_POST))
            {
                echo select_input(['text' => 'Practicante', 'collabel' => 3, 'colinput' => 7, 'select' =>
                    Dropdown(['name' => 'ID_PRACTICANTE', 'simple' => true, 'dataProvider' => $this->seguimientos_model->TraePracticantes(),
                        'placeholder' => '-- Seleccione un practicante --', 'fields' => ['NOMBRE_PRACTICANTE']])]);
            }
            else
            {
                show_404();
            }
        }

        public function traeMomentoPracticanteDDAjax()
        {
            if($this->input->is_ajax_request() && !empty($_POST))
            {
                $CalificacionMomentos = $this->seguimientos_model->TraeTodoMomentos();

                if($CalificacionMomentos > 0)
                {
                    $Calificado1 = ($this->seguimientos_model->ExisteCalificacion('A', 1) && $this->seguimientos_model->ExisteCalificacion('C', 1))
                        || $this->seguimientos_model->ExisteCalificacion('M', 1);

                    $Calificado2 = ($this->seguimientos_model->ExisteCalificacion('A', 2) && $this->seguimientos_model->ExisteCalificacion('C', 2))
                        || $this->seguimientos_model->ExisteCalificacion('M', 2);

                    if($Calificado2 == true)
                    {
                        $CalificacionMomentos = [1 => 'Momento 1', 2 => 'Momento 2'];
                    }
                    else if($Calificado1 == true)
                    {
                        $CalificacionMomentos = [1 => 'Momento 1'];
                    }
                    else
                    {
                        $CalificacionMomentos = [0 => 'No hay momentos'];
                    }
                }
                else
                {
                    $CalificacionMomentos = false;
                }
                echo $CalificacionMomentos === false ? "<a target='_blank' class='col-lg-9 col-lg-push-2'  href='" . site_url('seguimiento/enviarautoevaluacion') . "'><b>El practicante no ha realizado la aotoevaluación, ¿desea enviarsela?</b></a><br>" :
                    form_dropdown('MOMENTO', $CalificacionMomentos, ['input' => ['col' => '7'], 'label' => ['text' => 'Momento', 'col' => 3]]);
            }
            else
            {
                show_404();
            }
        }

        public function traeMomentoEliminarAjax()
        {
            if($this->input->is_ajax_request() && !empty($_POST))
            {
                $Calificado1 = ($this->seguimientos_model->ExisteCalificacion('A', 1) && $this->seguimientos_model->ExisteCalificacion('C', 1))
                    || $this->seguimientos_model->ExisteCalificacion('M', 1);

                $Calificado2 = ($this->seguimientos_model->ExisteCalificacion('A', 2) && $this->seguimientos_model->ExisteCalificacion('C', 2))
                    || $this->seguimientos_model->ExisteCalificacion('M', 2);

                if($Calificado2 == true)
                {
                    $CalificacionMomentos = [2 => 'Momento 2'];
                }
                else if($Calificado1 == true)
                {
                    $CalificacionMomentos = [1 => 'Momento 1'];
                }
                else
                {
                    $CalificacionMomentos = [0 => 'No hay momentos'];
                }

                echo form_dropdown('MOMENTO', $CalificacionMomentos, ['input' => ['col' => '7'], 'label' => ['text' => 'Momento', 'col' => 3]]);
            }
            else
            {
                show_404();
            }
        }

        public function enviarautoevaluacion()
        {
            if($this->input->is_ajax_request() && !empty($_POST))
            {
                $IDPracticantes = $this->practicantes_model->TraePracticantesPorProyecto($this->input->post('ID_PROYECTO'));
                $Data = [];
                $Dias = is_numeric($this->input->post('Dias')) > 0 ? $this->input->post('Dias') : 2;
                $hasta = new DateTime(date('Y-m-d H:i:s'));
                $hasta->add(new DateInterval('P' . $Dias . 'D'));

                $Caduca = $hasta->format('Y-m-d H:i:s');
                $Links = [];

                foreach ($_POST['Practicantes'] as $i => $Practicante)
                {
                    $link = site_url('seguimiento/evaluarestudiante?_link=' . md5($Practicante['correo'] . str_replace(',', '', $Practicante['cc']))
                        . '&_id=' . $IDPracticantes[$i]['ID_PRACTICANTE'] . '&_type=sp');
                    $Links[] = $link;
                    $Data[] = [
                        'TIPO' => 'sp',
                        'ID_PRACTICANTE' => $IDPracticantes[$i]['ID_PRACTICANTE'],
                        'FECHA_REGISTRO' => date('Y-m-d H:i:s'),
                        'FECHA_CADUCA' => $Caduca];

                    #Enviar por correo los links
                    mail($Practicante['correo'], 'Ingreso al portal de seguimiento al practicante', 'Buen día, su link de ingreso al portal es: ' . $link);
                }
                $this->seguimientos_model->InsertarLinkFormularioSeguimiento($Data);
                var_dump($Links);
                echo $Practicante['correo'] . str_replace(',', '', $Practicante['cc']);
            }
            else
            {
                $this->load->view('Seguimiento/SeguimientoPracticas/EnviarAutoevaluacion');
            }
        }

        public function seguimientos()
        {
            if(!empty($_POST))
            {
                $this->ImprimeSeguimientoPractica();
            }
            else
            {
                $this->load->view('Seguimiento/SeguimientoPracticas/Seguimientos');
            }
        }

        public function eliminarcalificacion()
        {
            if($this->input->is_ajax_request())
            {
                $this->seguimientos_model->EliminarCalificacion();
            }
            else
            {
                $this->load->view('Seguimiento/SeguimientoPracticas/EliminarSeguimiento');
            }
        }

        public function evaluarestudiante()
        {
            if($this->input->is_ajax_request())
            {
                $this->seguimientos_model->InsertarEvaluacionEstudiante();
            }
            else if($this->session->userdata('GUESS'))
            {
                $this->load->view('Seguimiento/SeguimientoPracticas/SeguimientoAEstudianteEnPractica');
            }
            else if(isset($_GET['_id']) && isset($_GET['_type']) && isset($_GET['_link']) && $this->seguimientos_model->ExisteLink())
            {
                $this->load->view('Seguimiento/SeguimientoPracticas/IngresoEstudiante');
            }
            else
            {
                show_404();
            }
        }

        public function changetableAjax()
        {
            if($this->input->is_ajax_request())
            {
                echo Component::Table(['columns' => ['Nombre', 'Correo', 'Documento'],
                    'tableName' => 'practicante', 'id' => 'ID_PRACTICANTE', 'controller' => 'practicantes',
                    'fields' => ['NOMBRE_PRACTICANTE', 'CORREO_PRACTICANTE', 'DOCUMENTO' => 'numeric']
                    , 'dataProvider' => $this->practicantes_model->TraePracticantesPorProyecto($this->input->post('ID_PROYECTO'))]);
            }
            else
            {
                show_404();
            }
        }

        public
        function validaringreso()
        {
            if($this->input->is_ajax_request() && !empty($_POST))
            {
                if($this->seguimientos_model->ValidaPracticanteIngreso())
                {
                    echo 'ok';
                }
            }
            else
            {
                show_404();
            }
        }

        public function tableAjax()
        {
            #Paz y salvo
            if($this->input->is_ajax_request())
            {
                echo Component::Table(['columns' => ['Nombre', 'Documento'],
                    'tableName' => 'practicante', 'id' => 'ID_PRACTICANTE', 'controller' => 'practicantes',
                    'fields' => ['NOMBRE_PRACTICANTE', 'DOCUMENTO' => 'numeric'], 'actions' => 'c'
                    , 'dataProvider' => $this->practicantes_model->TraePracticantesPorProyecto($this->input->post('ID_PROYECTO'))]);
            }
            else
            {
                show_404();
            }
        }

        public function periodoAjax()
        {
            if($this->input->is_ajax_request())
            {
                if(is_numeric($this->input->post('DIAS')))
                {
                    $desde = new DateTime('now');
                    $hasta = new DateTime('now');
                    $hasta->add(new DateInterval('P' . $this->input->post('DIAS') . 'D'));
                    echo 'Desde el ' . round($desde->format('d')) . ' de ' . MesNombre($desde->format('m')) . '/' . $desde->format('Y') . ' <b>Hasta el</b> ' .
                        round($hasta->format('d')) . ' de ' . MesNombre($hasta->format('m')) . '/' . $hasta->format('Y') . ' Para evaluar';
                }
                else
                {
                    echo '<b>N/A</b>';
                }
            }
        }

        private function imprimirregistronotas()
        {
            $Notas = $this->seguimientos_model->TraeCalificaciones();
            $this->load->library('fpdf/pdf');
            $pdf = new PDF();
            $pdf->AddPage();

            $pdf->Image(base_url('public/images/logo.jpg'), 10, 15, 60, 15);

            $pdf->SetFont('Arial', 'B', 10);
            #ENCABEZADO
            //$pdf->SetXY(10,35);
            $pdf->Text(180, 35, 'D0-68-F');
            $pdf->Text(85, 40, 'FORMATO REGISTRO DE NOTAS');
            $pdf->Text(80, 50, 'FUNDACIÓN UNIVERSITARIA MARÍA CANO');
            $pdf->Text(83, 55, 'PROGRAMA: ' . Ucspecial(strtoupper(($this->input->post('PROGRAMA')))));
            $pdf->Text(10, 66, 'MOMENTO EVALUATIVO: PRIMER Y SEGUNDO MOMENTO');
            $pdf->Text(150, 66, 'FECHA: ' . FechaFormal(date('Y-m-d'), false));
            $pdf->Text(10, 73, 'ASESOR: ' . (Ucspecial($this->session->userdata('NOMBRE_USUARIO'))));
            $pdf->SetFont('Arial', 'B', 9);
            #Headers
            $pdf->SetXY(5, 82);
            $pdf->Cell(50, 8, 'NOMBRES Y APELLIDOS', 1, 0, 'C');
            $pdf->SetXY(55, 82);
            $pdf->Cell(30, 8, 'CÓDIGO', 1, 0, 'C');
            $pdf->SetXY(85, 82);
            $pdf->Cell(30, 8, 'NIVEL PRÁCTICA', 1, 0, 'C');
            $pdf->SetXY(115, 82);
            $pdf->Cell(45, 8, 'AGENCIA PRÁCTICA', 1, 0, 'C');
            $pdf->SetXY(160, 82);
            $pdf->Cell(15, 8, 'NOTA 1', 1, 0, 'C');
            $pdf->SetXY(175, 82);
            $pdf->Cell(15, 8, 'NOTA 2', 1, 0, 'C');
            $pdf->SetXY(190, 82);
            $pdf->Cell(15, 8, 'DEF', 1, 0, 'C');
            $pdf->SetWidths([50, 30, 30, 45, 15, 15, 15]);
            $pdf->SetAligns(['C', 'C', 'C', 'C', 'C', 'C', 'C']);
            $pdf->SetFont('Arial', '', 9);
            $pdf->SetXY(5, 90);

            foreach ($Notas as $nota)
            {
                $pdf->SetX(5);
                $pdf->Row([utf8_encode($nota['NOMBRE_PRACTICANTE']), $nota['CODIGO'], utf8_encode($nota['MODALIDAD']), utf8_encode($nota['NOMBRE_AGENCIA']),
                    $nota['NOTA1'], $nota['NOTA2'], number_format(($nota['NOTA1'] + $nota['NOTA2']) / 2, 1)]);
            }
            $pdf->SetFont('Arial', 'B', 9);

            #Footer
            $pdf->Text(12, $pdf->GetY() + 20, 'FIRMA DOCENTE:');
            $pdf->Line(132, $pdf->GetY() + 20, 42, $pdf->GetY() + 20);
            $pdf->Text(135, $pdf->GetY() + 20, 'CENTRO DE PRÁCTICAS');

            $pdf->SetFont('Arial', 'B', 10);

            $pdf->Output();
            $pdf->Cell($pdf->PageNo());
        }

        public function pazysalvo()
        {
            if(!empty($_POST))
            {
                $this->ImprimePazySalvo();
            }
            else
            {
                $this->load->view('Seguimiento/PazYSalvo/PazYSalvo');
            }

        }

        private function ImprimePazySalvo()
        {
            $this->load->library('fpdf/pdf');
            $pdf = new PDF();
            $pdf->AddPage();

            $pdf->Image(base_url('public/images/logo.jpg'), 10, 15, 60, 15);
            $Practicantes = [];
            foreach ($_POST['ID_PRACTICANTE'] as $practicante)
            {
                $Practicantes[] = $this->practicantes_model->TraePracticante($practicante);
            }
            #ENCABEZADO
            $pdf->SetFont('Arial', 'b', 10);
            $pdf->Text(180, 35, 'DO-033-F');
            $pdf->Text(70, 40, 'FORMATO DE PAY Y SALVO DE LA PRÁCTICA');

            #Fields
            $h = 5;
            $f = 0;
            $pdf->SetFont('Arial', '', 9);
            $pdf->SetXY(10, 45 + ($f++ * $h));
            $pdf->Cell(190, $h, 'NOMBRE DEL(LOS) ESTUDIANTE(S): ' . $Practicantes[0]->NOMBRE_PRACTICANTE . (count($Practicantes) > 1 ? ', ' . $Practicantes[1]->NOMBRE_PRACTICANTE : ''), 1, 0, 'L');
            $pdf->SetXY(10, 45 + ($f++ * $h));
            $pdf->Cell(190, $h, count($Practicantes) > 2 ? $Practicantes[2]->NOMBRE_PRACTICANTE : '', 1, 0, 'L');
            $pdf->SetXY(10, 45 + ($f++ * $h));
            $pdf->Cell(190, $h, '', 1, 0, 'L');

            $pdf->SetXY(10, 45 + ($f++ * $h));
            $pdf->Cell(190, $h, 'PROGRAMA: ' . $this->input->post('PROGRAMA'), 1, 0, 'L');

            $pdf->SetXY(10, 45 + ($f++ * $h));
            $pdf->Cell(190, $h, 'SITIO DE REALIZACIÓN DE LA PRACTICA: ' . $Practicantes[0]->NOMBRE_AGENCIA, 1, 0, 'L');
            $pdf->SetXY(10, 45 + ($f++ * $h));
            $pdf->Cell(190, $h, '', 1, 0, 'L');

            $pdf->SetXY(10, 45 + ($f++ * $h));
            $pdf->Cell(190, $h, 'INTENSIDAD HORARIA: ' . ($Practicantes[0]->MODALIDAD == 'Práctica empresarial' ? '400' : '160') . ' horas', 1, 0, 'L');

            $pdf->SetXY(10, 45 + ($f * $h));
            $pdf->Cell(60, $h, 'PERIODO DE REALIZACIÓN', 1, 0, 'L');

            $pdf->SetXY(70, 45 + ($f * $h));
            $pdf->Cell(50, $h, 'INICIO: ' . Fecha($this->input->post('INICIO')), 1, 0, 'L');

            $pdf->SetXY(120, 45 + ($f++ * $h));
            $pdf->Cell(80, $h, 'FINALIZACIÓN: ' . Fecha($this->input->post('FINALIZACION')), 1, 0, 'L');

            $pdf->SetXY(10, 45 + ($f++ * $h));
            $pdf->MultiCell(190, $h, 'CONCEPTO DEL ASESOR FRENTE AL CUMPLIMIENTO Y ENTREGA DE TODOS LOS COMPROMISOS DEL ESTUDIANTE EN LA PRÁCTICA:', 1, 'L');
            $f++;
            $pdf->SetXY(10, 45 + ($f++ * $h));
            $pdf->Cell(190, $h * 24, '', 1, 0, 'L');

            $pdf->SetFont('Arial', '', 10);
            $pdf->SetXY(15, 45 + ($f * $h));
            $pdf->MultiCell(180, 5, $this->input->post('CONCEPTO'), 0);
            $pdf->SetFont('Arial', '', 9);

            $f = $f + 23;
            $pdf->SetXY(10, 45 + ($f++ * $h));
            $pdf->MultiCell(190, $h, 'EL (LOS) ESTUDIANTE(S) QUEDA A PAZ Y SALVO POR TODO CONCEPTO EN LA AGENCIA DE PRÁCTICA Y CON EL ASESOR.
SI  X                                   NO', 1, 'L');
            $f += 2;

            $pdf->SetXY(10, 45 + ($f++ * $h));
            $pdf->Cell(190, $h * 2, 'FIRMA DE (LOS) ESTUDIANTE(S):', 1, 0, 'L');
            $f++;

            $pdf->SetXY(10, 45 + ($f++ * $h));
            $pdf->Cell(190, $h, '', 1, 0, 'L');
            $pdf->SetXY(10, 45 + ($f++ * $h));
            $pdf->Cell(190, $h, '', 1, 0, 'L');
            $pdf->SetXY(10, 45 + ($f++ * $h));
            $pdf->Cell(190, $h, '', 1, 0, 'L');

            $pdf->SetXY(10, 45 + ($f++ * $h));
            $pdf->Cell(190, $h * 2, 'FIRMA DEL ASESOR:', 1, 0, 'L');
            $f++;
            $pdf->SetXY(10, 45 + ($f++ * $h));
            $pdf->Cell(190, $h * 2, 'FECHA DE EXPEDICIÓN DEL PAZ Y SALVO: ' . Fecha(), 1, 0, 'L');

            $pdf->Output();
            $pdf->Cell($pdf->PageNo());
        }

        private
        function ImprimeSeguimientoPractica()
        {
            $this->load->library('fpdf/pdf');
            $pdf = new PDF('L');

            $Practicante = $this->practicantes_model->TraePracticante($this->input->post('ID_PRACTICANTE'));
            $Agencia = $this->agencias_model->TraeAgencia($Practicante->ID_AGENCIA);
            $Epracticante = $this->seguimientos_model->TraeEvaluacionEstudiante($Practicante->ID_PRACTICANTE);

            $pdf->AddPage();

            $pdf->Image(base_url('public/images/logo.jpg'), 20, 10, 40, 10);

            #ENCABEZADO
            $pdf->SetFont('Arial', 'B', 9);
            $pdf->Text(260, 20, 'DO-075-F');
            $pdf->Text(80, 25, 'FACULTAD DE CIENCIAS EMPRESARIALES Y FACULTAD DE INGENIERÍAS');
            $pdf->Text(97, 30, 'FORMATO SEGUIMIENTO A ESTUDIANTES EN PRÁCTICA');
            $pdf->Text(110, 38, 'PROGRAMA: INGENIERÍA DE SISTEMAS');

            #Fields
            $h = 6;
            $f = 0;
            $c = 45;
            $x = 12;
            $pdf->Rect(10, 45, 280, 150);
            $pdf->Rect(10, 45, 280, 54);
            $pdf->Rect(10, 45, 135, 54);
            $pdf->Rect(10, 45, 280, 78);
            $pdf->Rect(10, 45, 280, 100);

            ##############Información Practicante############
            $pdf->SetFont('Arial', 'B', 8);
            $pdf->Text($x, $c + $h * ++$f, 'Información del practicante');
            $pdf->SetFont('Arial', '', 8);
            $pdf->Text($x, $c + $h * ++$f, 'Nombre: ' . $Practicante->NOMBRE_PRACTICANTE);
            $pdf->Text($x + 65, $c + $h * $f, 'Código: ' . $Practicante->CODIGO);
            $pdf->Text($x, $c + $h * ++$f, 'Programa: ' . $Practicante->PROGRAMA);
            $pdf->Text($x, $c + $h * ++$f, 'Modalidad de práctica: ' . $Practicante->MODALIDAD);
            $pdf->Text($x, $c + $h * ++$f, 'Teléfono: ' . Telefono($Practicante->TELEFONO));
            $pdf->Text($x, $c + $h * ++$f, 'Cargo o proyecto del practicante: ' . ($Practicante->NOMBRE_PROYECTO));
            $f++;
            $pdf->Text($x, $c + $h * ++$f, 'Asesor de práctica: ' . ($Practicante->NOMBRE_ASESOR));
            #############Información Agencia###############
            $r = 0;
            $pdf->SetFont('Arial', 'B', 8);
            $pdf->Text($x + 135, $c + $h * ++$r, 'Información de la empresa');
            $pdf->SetFont('Arial', '', 8);
            $pdf->Text($x + 135, $c + $h * ++$r, 'Empresa: ' . ($Agencia->NOMBRE_AGENCIA));
            $h = 5;
            $pdf->Text($x + 135, 2 + $c + $h * ++$r, 'Ciudad-país: ' . (ucfirst(strtolower($Agencia->NOMBRE_CUIDAD))) . ', Colombia');
            $pdf->Text($x + 135, 2 + $c + $h * ++$r, 'Dirección: ' . ($Agencia->DIRECCION));
            $pdf->Text($x + 135, 2 + $c + $h * ++$r, 'Teléfonos: ' . Telefono($Agencia->TELEFONO1) . '   ' . Telefono($Agencia->TELEFONO2));
            $pdf->Text($x + 135, 2 + $c + $h * ++$r, 'Fax: ' . Telefono($Agencia->FAX));
            $pdf->Text($x + 170, 2 + $c + $h * $r, 'E-mail: ' . $Agencia->CORREO_AGENCIA);
            $pdf->Text($x + 135, 2 + $c + $h * ++$r, 'Página web: ' . $Agencia->PAGINA_WEB);
            $pdf->Text($x + 135, 2 + $c + $h * ++$r, 'Cooperador: ' . ($Practicante->NOMBRE_COOPERADOR));
            $pdf->Text($x + 205, 2 + $c + $h * $r, 'Cargo: ' . ($Practicante->CARGO_COOPERADOR));

            $r1 = $Epracticante->R1 == 'a' ? 'SI: X       NO:' : 'SI:        NO: X';
            $r2 = $Epracticante->R2 == 'a' ? 'SI: X       NO:' : 'SI:           NO: X';
            $pdf->Text($x + 135, 2 + $c + $h * ++$r, 'El estudiante recibió inducción acerca de la empresa?           ' . $r1);
            $pdf->Text($x + 135, 2 + $c + $h * ++$r, 'El estudiante recibió inducción del cargo o proyecto?              ' . $r2);

            $h = 6;
            ################FUNCIONES DEL CARGO#################
            $pdf->Text($x, 4 + $c + $h * ++$f, 'Funciones (del cargo) o actividades (del proyecto) a realizar:');
            $pdf->SetFont('Arial', 'B', 20);
            $pdf->Text($x + 10, 9 + $c + $h * $f, '.');
            $pdf->Text($x + 10, 13 + $c + $h * $f, '.');
            $pdf->Text($x + 10, 17 + $c + $h * $f, '.');
            $pdf->Text($x + 10, 21 + $c + $h * $f, '.');
            #Funciones feed
            $pdf->SetFont('Arial', '', 8);
            $pdf->Text($x + 10, 9 + $c + $h * $f, '   ' . $Epracticante->FUNCION1);
            $pdf->Text($x + 10, 13 + $c + $h * $f, '   ' . $Epracticante->FUNCION2);
            $pdf->Text($x + 10, 17 + $c + $h * $f, '   ' . $Epracticante->FUNCION3);
            $pdf->Text($x + 10, 21 + $c + $h * $f, '   ' . $Epracticante->FUNCION4);
            #End funcionesd Feed

            ################FUNCIÓN DIAGNÓSTICA#################
            $f += 4;
            $pdf->Text($x, $c + $h * ++$f - 2, '1. FUNCIÓN DIAGNÓSTICA');
            $pdf->Text($x, $c + $h * ++$f - 2, 'Autoevaluación en fortalezas y debilidades, estableciendo metas y estrategias  de acuerdo a la modalidad de práctica y al área específica.');
            $pdf->SetFont('Arial', 'b', 8);
            $pdf->Text($x, $c + $h * ++$f - 2, 'Aspectos a analizar: ');
            $pdf->SetFont('Arial', '', 8);
            $pdf->SetXY($x + 27, $c + $h * $f - 5);
            $pdf->MultiCell(250, 4, ($Epracticante->FD));
            ################FUNDAMENTACIÓN TEÓRICO-PRÁCTICA#################
            $pdf->Text($x, 2 + $c + $h * ++$f, '1.1     Fundamentación teórico-práctica');

            $r3 = '';
            switch ($Epracticante->R3)
            {
                case 'a':
                    $r3 = 'a) Alta: X   b) Mediano:   c) Bajo:';
                    break;
                case 'b':
                    $r3 = 'a) Alta:   b) Mediano: X   c) Bajo:';
                    break;
                case 'c':
                    $r3 = 'a) Alta:   b) Mediano:   c) Bajo: X';
                    break;
            }

            $pdf->Text($x, 4 + $c + $h * ++$f, '1.1.1 ¿En qué grado considera usted que posee los elementos teóricos suficientes para la ejecución de las funciones o actividades de la práctica seleccionada?');

            $pdf->Text($x, 4 + $c + $h * ++$f, '        ' . $r3);

            $pdf->Text($x, 4 + $c + $h * ++$f, '1.1.2 ¿Qué elementos conceptuales considera Usted que debería fortalecer o incorporar para cumplir exitosamente las funciones o actividades propuestas?');
            $pdf->Text($x, 4 + $c + $h * ++$f, '         ' . ($Epracticante->RESP1));

            $r4 = $Epracticante->R4 == 'a' ? 'Sí: X     No:' : 'Sí:     No: X';

            $pdf->Text($x, 4 + $c + $h * ++$f, '1.1.3 ¿Ha tenido experiencia previa en las funciones o actividades establecidas?');
            $pdf->Text($x, 4 + $c + $h * ++$f, '        ' . $r4);

            $pdf->Text(270, 13 + $c + $h * ++$f, 'Página ' . $pdf->PageNo());

            ######################Page Nro 2######################
            $pdf->AddPage('L');

            $pdf->Image(base_url('public/images/logo.jpg'), 20, 10, 40, 10);

            #ENCABEZADO
            $pdf->SetFont('Arial', 'B', 9);
            $pdf->Text(260, 20, 'DO-075-F');
            $pdf->Text(80, 25, 'FACULTAD DE CIENCIAS EMPRESARIALES Y FACULTAD DE INGENIERÍAS');
            $pdf->Text(97, 30, 'FORMATO SEGUIMIENTO A ESTUDIANTES EN PRÁCTICA');
            $pdf->SetFont('Arial', '', 8);
            #Fields
            $h = 6;
            $f = 0;
            $c = 35;
            $x = 12;
            $pdf->Rect(10, 32, 280, 169);
            $pdf->Rect(10, 32, 280, 5);
            $pdf->Rect(10, 32, 280, 78);
            #######################MOTIVACIÓN########################
            $pdf->Text($x, $c + $h * ++$f, '1.2 Motivación e interés frente a la práctica.');

            $r5 = $Epracticante->R5 == 'a' ? 'Sí: X     No:' : 'Sí:     No: X';

            $pdf->Text($x, $c + $h * ++$f, '1.2.1 ¿Considera que las funciones o actividades a realizar en la práctica influyen positivamente en su formación profesional?');
            $pdf->Text($x, $c + $h * ++$f, '        ' . $r5);

            switch ($Epracticante->R6)
            {
                case 'a':
                    $r6 = 'Agencia: X    Funciones:    Oportunidad de Vinculación:    Reto:    Remuneración:    Otra? Cual _________________________';
                    break;
                case 'b':
                    $r6 = 'Agencia:    Funciones: X    Oportunidad de Vinculación:    Reto:    Remuneración:    Otra? Cual _________________________';
                    break;
                case 'c':
                    $r6 = 'Agencia:    Funciones:    Oportunidad de Vinculación: X    Reto:    Remuneración:    Otra? Cual _________________________';
                    break;
                case 'd':
                    $r6 = 'Agencia:    Funciones:    Oportunidad de Vinculación:    Reto: X    Remuneración:    Otra? Cual _________________________';
                    break;
                case 'e':
                    $r6 = 'Agencia:    Funciones:    Oportunidad de Vinculación:    Reto:    Remuneración: X    Otra? Cual _________________________';
                    break;
                default:
                    $r6 = 'Agencia:    Funciones:    Oportunidad de Vinculación:    Reto:    Remuneración:    Otra? Cual: ' . ($Epracticante->R121);
                    break;
            }

            $pdf->Text($x, $c + $h * ++$f, '1.2.2 ¿Cuál es el aspecto más relevante para la selección  de su práctica?');
            $pdf->Text($x, $c + $h * ++$f, '        ' . $r6);
            $f++;
            $r7 = '';
            switch ($Epracticante->R7)
            {
                case 'a':
                    $r7 = 'Poco Pertinente: X      Pertinente      Muy Pertinente:';
                    break;
                case 'b':
                    $r7 = 'Poco Pertinente:      Pertinente: X      Muy Pertinente:';
                    break;
                case 'c':
                    $r7 = 'Poco Pertinente:      Pertinente:      Muy Pertinente: X';
                    break;
            }

            $pdf->Text($x, $c + $h * ++$f, '1.2.3 Respecto a su formación profesional, la experiencia de la práctica considera que es:          ' . $r7);
            $pdf->Text($x, 1 + $c + $h * ++$f, '¿Porqué?: ' . ($Epracticante->RESP2));

            $f++;
            $r8 = '';
            switch ($Epracticante->R8)
            {
                case 'a':
                    $r8 = 'Poco Beneficiosa: X      Beneficiosa:      Muy Beneficiosa:';
                    break;
                case 'b':
                    $r8 = 'Poco Beneficiosa:      Beneficiosa: X      Muy Beneficiosa:';
                    break;
                case 'c':
                    $r8 = 'Poco Beneficiosa:      Beneficiosa:      Muy Beneficiosa: X';
                    break;
            }
            $pdf->Text($x, $c + $h * ++$f, '1.2.4 Respecto a su formación personal, la experiencia de la práctica considera que es:');
            $pdf->Text($x, $c + $h * ++$f, '        ' . $r8);
            $pdf->Text($x, $c + $h * ++$f, '¿Porqué?: ' . ($Epracticante->RESP3));

            ######################HABILIDADES#######################
            $f++;
            $pdf->Text($x, $c - 2 + $h * ++$f, '1.3 Habilidades y competencias frente al área de desempeño');

            $pdf->Text($x, $c + $h * ++$f, '1.3.1 En qué grado conoce Usted las competencias requeridas para las funciones o actividades a realizar');

            switch ($Epracticante->R9)
            {
                case 'a':
                    $pdf->Text($x + 15, $c + $h * ($f + 1) - 1, 'X');
                    break;
                case 'b':
                    $pdf->Text($x + 15, $c + $h * ($f + 2) - 1, 'X');
                    break;
                case 'c':
                    $pdf->Text($x + 15, $c + $h * ($f + 3) - 1, 'X');
                    break;
            }
            $pdf->Text($x + 10, $c + $h * ++$f - 1, 'a)  __ Alto grado');
            $pdf->Text($x + 10, $c + $h * ++$f - 1, 'b)  __ Mediano grado');
            $pdf->Text($x + 10, $c + $h * ++$f - 1, 'c)  __ Bajo grado');

            $r10 = '';
            switch ($Epracticante->R10)
            {
                case 'a':
                    $r10 = 'Interpretativa: X      Argumentativa:      Propositiva:';
                    break;
                case 'b':
                    $r10 = 'Interpretativa:      Argumentativa: X      Propositiva:';
                    break;
                case 'c':
                    $r10 = 'Interpretativa:      Argumentativa:      Propositiva: X';
                    break;
            }

            $pdf->Text($x, $c + $h * ++$f, '1.3.2 Cuál de las siguientes competencias considera Usted que tiene en mayor grado, para el desarrollo de las actividades o funciones establecidas');
            $pdf->Text($x, $c + $h * ++$f, ' ' . $r10);
            #####################DEBILIDADES/METAS#################
            $pdf->Rect(10, $c + $h * ++$f, 280, 40);
            $pdf->Rect(10, $c + $h * $f, 140, 40);
            $pdf->Rect(10, $c + $h * $f, 280, 6);
            $pdf->SetFont('Arial', 'B', 8);
            $pdf->Text($x + 45, $c + $h * ++$f - 2, 'DEBILIDADES Y/O FORTALEZAS');
            $pdf->Text($x + 190, $c + $h * $f - 2, 'METAS Y ESTRATEGIAS');
            $pdf->SetFont('Arial', '', 20);

            #Debilidades y fortalezas
            $Debfor = explode(',', $Epracticante->DEBFOR);

            for ($i = 0; $i < count($Debfor); $i++)
            {
                $pdf->SetFont('Arial', '', 20);
                $pdf->Text($x + 5, 4 + $c + $h * $f + $i * 4, '.  ');
                $pdf->SetFont('Arial', '', 8);
                $pdf->Text($x + 8, 4 + $c + $h * $f + $i * 4, rtrim(ucfirst(trim(strtolower($Debfor[$i]))), '.') . '.');
            }
            #Metas y estrategias
            $Metest = explode(',', $Epracticante->METEST);

            for ($i = 0; $i < count($Metest); $i++)
            {
                $pdf->SetFont('Arial', '', 20);
                $pdf->Text($x + 145, 4 + $c + $h * $f + $i * 4, '.  ');
                $pdf->SetFont('Arial', '', 8);
                $pdf->Text($x + 148, 4 + $c + $h * $f + $i * 4, rtrim(ucfirst(trim(strtolower($Metest[$i]))), '.') . '.');
            }
            $pdf->SetFont('Arial', '', 8);

            $pdf->Text(270, 13 + $c + $h * ++$f + 20, 'Página ' . $pdf->PageNo());
            ######################FUNCIÓN FORMATIVA#########################
            $Ambos = false;
            $Asesor = false;
            $Cooperador = false;

            if($this->input->post('MOMENTO') == 2)
            {
                foreach ($this->seguimientos_model->TraeCalificacionPracticante($this->input->post('ID_PRACTICANTE'), 2) as $calificacion)
                {
                    $calificacion->NOTA = explode(',', $calificacion->NOTA);

                    switch ($calificacion->PERSONA)
                    {
                        case 'A':
                            $Asesor = $calificacion;
                            break;
                        case 'C':
                            $Cooperador = $calificacion;
                            break;
                        case 'M':
                            $Ambos = $calificacion;
                            break;
                    }
                }

                $Asesor2 = false;
                $Ambos2 = false;
                $Cooperador2 = null;
                foreach ($this->seguimientos_model->TraeCalificacionPracticante($this->input->post('ID_PRACTICANTE'), 1) as $calificacion)
                {
                    $calificacion->NOTA = explode(',', $calificacion->NOTA);
                    switch ($calificacion->PERSONA)
                    {
                        case 'A':
                            $Asesor2 = $calificacion;
                            break;
                        case 'C':
                            $Cooperador2 = $calificacion;
                            break;
                        case 'M':
                            $Ambos2 = $calificacion;
                            break;
                    }
                }
                ##Calculo las notas del momento 2
                if($Ambos === false)
                {
                    $this->CalcularMomento($Asesor->NOTA, $Cooperador->NOTA, $Asesor->FECHA_REGISTRO);
                }
                else
                {
                    $this->CalcularMomento($Ambos->NOTA, null, $Ambos->FECHA_REGISTRO);
                }

                ##Calculo de las posibles combinaciones de evaluacion en los 2 momentos
                if($Ambos === false && $Ambos2 === false)
                {
                    #Momento 1
                    $this->FuncionFormativa($pdf, $Asesor2);
                    $this->Observaciones($pdf, $Asesor2);
                    $this->FuncionFormativa($pdf, $Cooperador2);
                    $this->Observaciones($pdf, $Cooperador2);
                    #Momento 2
                    $this->FuncionFormativa($pdf, $Asesor);
                    $this->Observaciones($pdf, $Asesor);
                    $this->FuncionFormativa($pdf, $Cooperador);
                    $this->Observaciones($pdf, $Cooperador);
                    $this->FuncionSumativa($pdf, $Asesor2, $Cooperador2->NOTA);
                }
                else if($Ambos2 === false && $Ambos !== false)
                {
                    #Momento 1
                    $this->FuncionFormativa($pdf, $Asesor2);
                    $this->Observaciones($pdf, $Asesor2);
                    $this->FuncionFormativa($pdf, $Cooperador2);
                    $this->Observaciones($pdf, $Cooperador2);
                    #Momento 2
                    $this->FuncionFormativa($pdf, $Ambos);
                    $this->Observaciones($pdf, $Ambos);
                    $this->FuncionSumativa($pdf, $Asesor2, $Cooperador2->NOTA);
                }
                else if($Ambos2 !== false && $Ambos === false)
                {
                    #Momento 1
                    $this->FuncionFormativa($pdf, $Ambos2);
                    $this->Observaciones($pdf, $Ambos2);
                    #Momento 2
                    $this->FuncionFormativa($pdf, $Asesor);
                    $this->Observaciones($pdf, $Asesor);
                    $this->FuncionFormativa($pdf, $Cooperador);
                    $this->Observaciones($pdf, $Cooperador);
                    $this->FuncionSumativa($pdf, $Ambos2);
                }
                else if($Ambos2 !== false && $Ambos !== false)
                {
                    #Momento 1
                    $this->FuncionFormativa($pdf, $Ambos2);
                    $this->Observaciones($pdf, $Ambos2);
                    #Momento 2
                    $this->FuncionFormativa($pdf, $Ambos);
                    $this->Observaciones($pdf, $Ambos);
                    $this->FuncionSumativa($pdf, $Ambos2);
                }
            }
            else
            {
                foreach ($this->seguimientos_model->TraeCalificacionPracticante($this->input->post('ID_PRACTICANTE'), 1) as $calificacion)
                {
                    $calificacion->NOTA = explode(',', $calificacion->NOTA);

                    switch ($calificacion->PERSONA)
                    {
                        case 'A':
                            $Asesor = $calificacion;
                            break;
                        case 'C':
                            $Cooperador = $calificacion;
                            break;
                        case 'M':
                            $Ambos = $calificacion;
                            break;
                    }
                }

                if($Ambos == false)
                {
                    $this->FuncionFormativa($pdf, $Asesor);
                    $this->FuncionFormativa($pdf, $Cooperador);
                    $this->Observaciones($pdf, $Asesor);
                    $this->Observaciones($pdf, $Cooperador);
                    $this->FuncionSumativa($pdf, $Asesor, $Cooperador->NOTA);
                }
                else
                {
                    $this->FuncionFormativa($pdf, $Ambos);
                    $this->Observaciones($pdf, $Ambos);
                    $this->FuncionSumativa($pdf, $Ambos);
                }
            }

            $pdf->Output();
            $pdf->Cell($pdf->PageNo());
        }

        /**
         * @param PDF $pdf
         * @param $Persona
         */
        private
        function FuncionFormativa($pdf, $Persona)
        {
            ######################Page Nro 2######################
            $pdf->AddPage('L');
            $this->item = 0;
            $pdf->Image(base_url('public/images/logo.jpg'), 20, 10, 40, 10);

            #ENCABEZADO
            $pdf->SetFont('Arial', 'B', 9);
            $pdf->Text(260, 15, 'DO-075-F');
            $pdf->Text(80, 20, 'FACULTAD DE CIENCIAS EMPRESARIALES Y FACULTAD DE INGENIERÍAS');
            $pdf->Text(97, 25, 'FORMATO SEGUIMIENTO A ESTUDIANTES EN PRÁCTICA');
            $pdf->Text(120, 30, 'FUNCIÓN FORMATIVA');
            #Fields
            $h = 5;
            $f = 0;
            $c = 35;
            $x = 12;
            #ESCALA DE VALORACIÓN
            $pdf->SetXY($x + 28, $c);
            $pdf->Cell(220, $h, 'ESCALA DE VALORACIÓN', 1, 0, 'C');
            $pdf->SetFont('Arial', 'B', 8);

            $pdf->SetXY($x + 28, $c + $h * ++$f);
            $pdf->Cell(55, $h, 'Excelente', 1, 0, 'C');

            $pdf->SetXY($x + 28 + 55, $c + $h * $f);
            $pdf->Cell(55, $h, 'Bueno', 1, 0, 'C');

            $pdf->SetXY($x + 28 + 110, $c + $h * $f);
            $pdf->Cell(55, $h, 'Aceptable', 1, 0, 'C');

            $pdf->SetXY($x + 28 + 165, $c + $h * $f);
            $pdf->Cell(55, $h, 'Deficiente', 1, 0, 'C');

            $pdf->SetXY($x + 28, $c + $h * ++$f);
            $pdf->Cell(55, $h, '4.6 - 5', 1, 0, 'C');

            $pdf->SetXY($x + 28 + 55, $c + $h * $f);
            $pdf->Cell(55, $h, '4 - 4.5', 1, 0, 'C');

            $pdf->SetXY($x + 28 + 110, $c + $h * $f);
            $pdf->Cell(55, $h, '3.5 - 3.9', 1, 0, 'C');

            $pdf->SetXY($x + 28 + 165, $c + $h * $f);
            $pdf->Cell(55, $h, '0.0 - 3.4', 1, 0, 'C');

            $h = 6;
            $pdf->Rect($x, $c + $h * ++$f, 280, 142);

            $pdf->SetXY($x, $c + $h * $f);
            $pdf->Cell(93, $h, 'SABER SER', 1, 0, 'C');

            $pdf->SetXY($x + 93, $c + $h * $f);
            $pdf->Cell(95, $h, 'SABER HACER', 1, 0, 'C');

            $pdf->SetXY($x + 188, $c + $h * $f);
            $pdf->Cell(92, $h, 'SABER SABER', 1, 0, 'C');
            $pdf->SetFont('Arial', '', 8);

            #FECHA
            $pdf->SetXY($x, $c + $h * ++$f);
            $pdf->Cell(93, $h, 'Fecha: ' . Fecha($Persona->FECHA_REGISTRO), 1, 0, 'L');

            $pdf->SetXY($x + 93, $c + $h * $f);
            $pdf->Cell(95, $h, 'Fecha: ' . Fecha($Persona->FECHA_REGISTRO), 1, 0, 'L');

            $pdf->SetXY($x + 188, $c + $h * $f);
            $pdf->Cell(92, $h, 'Fecha: ' . Fecha($Persona->FECHA_REGISTRO), 1, 0, 'L');

            $pdf->Rect($x, $c + $h * ++$f, 93, 130);
            $pdf->Rect($x, $c + $h * $f, 188, 130);
            $ff = $f;
            ###########Columna #1 ###########
            $x = 13;
            $pdf->SetXY($x, $c + $h * $f);
            $pdf->MultiCell(92, 4, '1.Considera usted que la actitud del estudiante frente a sugerencias es: (Adaptabilidad)');
            $f++;
            $pdf->Text($x, $c + $h * ++$f, '  Exclente ___   Bueno___   Aceptable___   Deficiente ___');
            $this->Nota($x, $c + $h * $f, $pdf, $Persona->NOTA);
            $pdf->SetXY($x, $c + $h * ++$f);
            $pdf->MultiCell(92, 4, '2.	La disposición del estudiante frente al trabajo en equipo es: (Colaboración)');
            $f++;
            $pdf->Text($x, $c + $h * ++$f, '  Exclente ___   Bueno___   Aceptable___   Deficiente ___');
            $this->Nota($x, $c + $h * $f, $pdf, $Persona->NOTA);
            $pdf->SetXY($x, $c + $h * ++$f);
            $pdf->MultiCell(92, 4, '3.	Frente a las debilidades o dificultades presentadas durante la práctica, la participación activa del estudiante con soluciones o propuestas de mejoramiento es: (Creatividad)');
            $f += 2;
            $pdf->Text($x, $c + $h * ++$f, '  Exclente ___   Bueno___   Aceptable___   Deficiente ___');
            $this->Nota($x, $c + $h * $f, $pdf, $Persona->NOTA);

            $pdf->SetXY($x, $c + $h * ++$f);
            $pdf->MultiCell(92, 4, '4.	El nivel de respeto que demuestra el estudiante por su entorno y compañeros de grupo, es: (Relaciones Interpersonales)');
            $f++;
            $pdf->Text($x, $c + 1 + $h * ++$f, '  Exclente ___   Bueno___   Aceptable___   Deficiente ___');
            $this->Nota($x, $c + 1 + $h * $f, $pdf, $Persona->NOTA);

            $pdf->SetXY($x, $c + $h * ++$f);
            $pdf->MultiCell(92, 4, '5.	La responsabilidad del estudiante con respecto al cumplimiento del horario establecido es: (Responsabilidad)');
            $f++;
            $pdf->Text($x, $c + 2 + $h * ++$f, '  Exclente ___   Bueno___   Aceptable___   Deficiente ___');
            $this->Nota($x, $c + 2 + $h * $f, $pdf, $Persona->NOTA);

            $pdf->SetXY($x, $c + $h * ++$f);
            $pdf->MultiCell(92, 4, '6.	La transparencia en las acciones o funciones realizadas por el estudiante, discreción y manejo adecuado de la información derivada de la práctica o el proyecto, demostrada por el estudiante es: (Ética)');
            $f += 2;
            $pdf->Text($x, $c + $h * ++$f, '  Exclente ___   Bueno___   Aceptable___   Deficiente ___');
            $this->Nota($x, $c + $h * $f, $pdf, $Persona->NOTA);

            ###########Columna #2 ###########
            $f = $ff;
            $x = 13;
            $x += 93;
            $pdf->SetXY($x, $c + $h * $f);
            $pdf->MultiCell(94, 4, '1.	La capacidad del estudiante para realizar eficazmente las funciones o actividades asignadas es: (Cumplimiento)');
            $f++;
            $pdf->Text($x, $c + $h * ++$f, '  Exclente ___   Bueno___   Aceptable___   Deficiente ___');
            $this->Nota($x, $c + $h * $f, $pdf, $Persona->NOTA);

            $pdf->SetXY($x, $c + $h * ++$f);
            $pdf->MultiCell(94, 4, '2.	La utilización y el manejo, por parte del estudiante, de los recursos proporcionados para el desarrollo de la práctica, es: (Manejo de Recursos)');
            $f += 2;
            $pdf->Text($x, $c + $h * ++$f, '  Exclente ___   Bueno___   Aceptable___   Deficiente ___');
            $this->Nota($x, $c + $h * $f, $pdf, $Persona->NOTA);

            $pdf->SetXY($x, $c + $h * ++$f);
            $pdf->MultiCell(94, 4, '3.	La capacidad del estudiante para reconocer las debilidades y fortalezas frente al proyecto o cargo asignado y utilizarlas para el planteamiento de propuestas de mejoramiento es: (Detección de Oportunidades)');
            $f += 2;
            $pdf->Text($x, $c + 2 + $h * ++$f, '  Exclente ___   Bueno___   Aceptable___   Deficiente ___');
            $this->Nota($x, $c + 2 + $h * $f, $pdf, $Persona->NOTA);

            $pdf->SetXY($x, $c + $h * ++$f);
            $pdf->MultiCell(94, 4, '4.	La capacidad del estudiante para determinar las metas y prioridades, estipular cursos de acción, los plazos y recursos para alcanzarlos es: (Planeación)');
            $f += 2;
            $pdf->Text($x, $c + $h * ++$f, '  Exclente ___   Bueno___   Aceptable___   Deficiente ___');
            $this->Nota($x, $c + $h * $f, $pdf, $Persona->NOTA);

            $pdf->SetXY($x, $c + $h * ++$f);
            $pdf->MultiCell(94, 4, '5.	La presentación de los informes y/o avances de las funciones o actividades por parte del estudiante son: (Comunicación Oral y Escrita)');
            $f++;
            $pdf->Text($x, $c + $h * ++$f, '  Exclente ___   Bueno___   Aceptable___   Deficiente ___');
            $this->Nota($x, $c + $h * $f, $pdf, $Persona->NOTA);

            $pdf->SetXY($x, $c + $h * ++$f);
            $pdf->MultiCell(94, 4, '6.	La orientación hacia la calidad y el mejoramiento continuo en la ejecución de las actividades o funciones, evidenciada por  el estudiante es: (Calidad del trabajo y desempeño laboral)');
            $f += 2;
            $pdf->Text($x, $c + $h * ++$f, '  Exclente ___   Bueno___   Aceptable___   Deficiente ___');
            $this->Nota($x, $c + $h * $f, $pdf, $Persona->NOTA);
            ###########Columna #3 ###########
            $f = $ff;
            $x += 94;
            $pdf->SetXY($x, $c + $h * $f);
            $pdf->MultiCell(92, 4, '1.	La  revisión e interpretación por parte del estudiante de la documentación teórica y otros referentes aplicables a su práctica es: (Interpretación)');
            $f += 2;
            $pdf->Text($x, $c + $h * ++$f, '  Exclente ___   Bueno___   Aceptable___   Deficiente ___');
            $this->Nota($x, $c + $h * $f, $pdf, $Persona->NOTA);

            $pdf->SetXY($x, $c + $h * ++$f);
            $pdf->MultiCell(92, 4, '2.	La articulación por parte del estudiante, de los diferentes campos de conocimientos de su saber específico y las situaciones problemáticas surgidas es: (Análisis)');
            $f += 2;
            $pdf->Text($x, $c + $h * ++$f, '  Exclente ___   Bueno___   Aceptable___   Deficiente ___');
            $this->Nota($x, $c + $h * $f, $pdf, $Persona->NOTA);

            $pdf->SetXY($x, $c + $h * ++$f);
            $pdf->MultiCell(92, 4, '3.	La capacidad del estudiante frente a la búsqueda de información acertada para la resolución y optimización de problemas es: (Proposición)');
            $f += 2;
            $pdf->Text($x, $c + $h * ++$f, '  Exclente ___   Bueno___   Aceptable___   Deficiente ___');
            $this->Nota($x, $c + $h * $f, $pdf, $Persona->NOTA);

            $pdf->SetXY($x, $c + $h * ++$f);
            $pdf->MultiCell(92, 4, '4.	La capacidad investigativa del estudiante orientada al desarrollo de procesos innovadores es: (Argumentación)');
            $f++;
            $pdf->Text($x, $c + $h * ++$f, '  Exclente ___   Bueno___   Aceptable___   Deficiente ___');
            $this->Nota($x, $c + $h * $f, $pdf, $Persona->NOTA);

            $pdf->SetXY($x, $c + $h * ++$f);
            $pdf->MultiCell(92, 4, '5.	La capacidad de síntesis coherente de los resultados obtenidos en el desarrollo de sus actividades o funciones, por parte del estudiante es: (Síntesis)');
            $f += 2;
            $pdf->Text($x, $c + $h * ++$f, '  Exclente ___   Bueno___   Aceptable___   Deficiente ___');
            $this->Nota($x, $c + $h * $f, $pdf, $Persona->NOTA);

            $pdf->SetXY($x, $c + $h * ++$f);
            $pdf->MultiCell(92, 4, '6.	El interés demostrado por el estudiante frente al aprendizaje de nuevos conceptos es: (Actualización)');
            $f++;
            $pdf->Text($x, $c + 1 + $h * ++$f, '  Exclente ___   Bueno___   Aceptable___   Deficiente ___');
            $this->Nota($x, $c + 1 + $h * $f, $pdf, $Persona->NOTA);

            $pdf->Text(270, 5 + $c + $h * ++$f, 'Página ' . $pdf->PageNo());
        }

        private
        function CalcularMomento($Nota1, $Nota2 = null, $fecha)
        {
            $Notas = [];
            $saberser = 0;
            $saberhacer = 0;
            $sabersaber = 0;

            if(is_null($Nota2))
            {
                foreach ($Nota1 as $i => $calificacion)
                {
                    $Notas[] = $calificacion;
                    if($i < 6)
                    {
                        $saberser += $calificacion;
                    }
                    else if($i < 12)
                    {
                        $saberhacer += $calificacion;
                    }
                    else if($i < 18)
                    {
                        $sabersaber += $calificacion;
                    }
                }
            }
            else
            {
                foreach ($Nota1 as $i => $calificacion)
                {
                    $pro = number_format(($calificacion + $Nota2[$i]) / 2, 1);
                    $Notas[] = $pro;
                    if($i < 6)
                    {
                        $saberser += $pro;
                    }
                    else if($i < 12)
                    {
                        $saberhacer += $pro;
                    }
                    else if($i < 18)
                    {
                        $sabersaber += $pro;
                    }
                }
            }
            $this->Notas2['Saberser'] = number_format(($saberser / 6) * .33, 2);
            $this->Notas2['Saberhacer'] = number_format(($saberhacer / 6) * .34, 2);
            $this->Notas2['Sabersaber'] = number_format(($sabersaber / 6) * .33, 2);
            $this->Notas2['Fecha'] = $fecha;
            $this->Notas2['Notas'] = $Notas;
        }

        /**
         * @param $x
         * @param $y
         * @param PDF $pdf
         * @param $Nota
         * @param bool $eval
         * @param bool $index
         * @return
         */
        private
        function Nota($x, $y, $pdf, $Nota, $eval = false, $index = false)
        {
            $pdf->SetFont('Arial', 'B', 8);
            if($index === false)
            {
                $index = $this->item++;
            }
            $Nota = $Nota[$index];
            if($eval)
            {
                $pdf->Text($x, $y, $Nota);
            }
            else
            {
                $_note = strlen($Nota) == 1 ? ' ' . $Nota : $Nota;
                if($Nota >= 0 && $Nota <= 3.4)
                {
                    $pdf->Text($x, $y, '                                                                                        ' . $_note);
                }
                else if($Nota >= 3.5 && $Nota <= 3.9)
                {
                    $pdf->Text($x, $y, '                                                              ' . $_note);
                }
                else if($Nota >= 4 && $Nota <= 4.5)
                {
                    $pdf->Text($x, $y, '                                     ' . $_note);
                }
                else if($Nota >= 4.6 && $Nota <= 5)
                {
                    $pdf->Text($x, $y, '                 ' . $_note);
                }
            }
            $pdf->SetFont('Arial', '', 8);
            if($eval)
            {
                return $Nota;
            }
        }

        /**
         * @param PDF $pdf
         * @param $Persona
         */
        private
        function Observaciones($pdf, $Persona = null)
        {
            ######################Page Nro 2######################
            $pdf->AddPage('L');

            $pdf->Image(base_url('public/images/logo.jpg'), 20, 10, 40, 10);

            #ENCABEZADO
            $pdf->SetFont('Arial', 'B', 9);
            $pdf->Text(260, 15, 'DO-075-F');
            $pdf->Text(80, 20, 'FACULTAD DE CIENCIAS EMPRESARIALES Y FACULTAD DE INGENIERÍAS');
            $pdf->Text(97, 25, 'FORMATO SEGUIMIENTO A ESTUDIANTES EN PRÁCTICA');
            #Fields
            $h = 5;
            $f = 0;
            $c = 25;
            $x = 12;

            $pdf->SetFont('Arial', '', 8);
            $pdf->Rect($x, $c + $h * ++$f, 93, 160);
            $pdf->Rect($x + 93, $c + $h * $f, 93, 160);
            $pdf->Rect($x + 186, $c + $h * $f, 93, 160);
            $pdf->Text($x + 1, $c + $h * $f + 3, 'OBSERVACIONES:');
            $pdf->SetXY($x + 1, $c + $h * $f + 7);
            $pdf->MultiCell(91, 4, $Persona->OBS_SABERSER);
            $pdf->Text($x + 94, $c + $h * $f + 3, 'OBSERVACIONES:');
            $pdf->SetXY($x + 94, $c + $h * $f + 7);
            $pdf->MultiCell(91, 4, $Persona->OBS_SABERHACER);
            $pdf->Text($x + 187, $c + $h * $f + 3, 'OBSERVACIONES:');
            $pdf->SetXY($x + 187, $c + $h * $f + 7);
            $pdf->MultiCell(91, 4, $Persona->OBS_SABERSABER);

            $pdf->Text(270, 200, 'Página ' . $pdf->PageNo());
        }

        /**
         * @param PDF $pdf
         * @param $Persona1
         * @param $Persona2
         */
        private
        function FuncionSumativa($pdf, $Persona1, $Persona2 = null)
        {
            $pdf->AddPage('L');
            $this->item = 0;
            $Notas = [];

            if(is_null($Persona2))
            {
                $Notas = $Persona1->NOTA;
            }
            else
            {
                foreach ($Persona1->NOTA as $i => $calificacion)
                {
                    $Notas[] = number_format(($calificacion + $Persona2[$i]) / 2, 1);
                }
            }

            $pdf->Image(base_url('public/images/logo.jpg'), 20, 10, 40, 10);

            #ENCABEZADO
            $pdf->SetFont('Arial', 'B', 9);
            $pdf->SetFillColor(210, 200, 200);
            $pdf->Text(260, 15, 'DO-075-F');
            $pdf->Text(85, 20, 'FACULTAD DE CIENCIAS EMPRESARIALES Y FACULTAD DE INGENIERÍAS');
            $pdf->Text(103, 25, 'FORMATO SEGUIMIENTO A ESTUDIANTES EN PRÁCTICA');
            $pdf->Text(125, 30, 'FUNCIÓN SUMATIVA');
            #Fields
            $h = 9;
            $f = 0;
            $c = 25;
            $x = 30;

            $pdf->SetFont('Arial', '', 7);

            $pdf->Rect($x, $c + $h * ++$f, 240, 59);
            $pdf->Rect($x, $c + $h * $f, 240, 5);
            #NUMERACIÓN
            $pdf->Text($x + 64, $c + $h * $f + 3, '1°            2°');
            $pdf->Text($x + 144, $c + $h * $f + 3, '1°            2°');
            $pdf->Text($x + 224, $c + $h * $f + 3, '1°            2°');

            $pdf->SetXY($x, $c + $h * $f);
            $pdf->Cell(60, 5, 'SABER SER (33%)', 1, 0, 'C');
            #bar 1
            $pdf->SetXY($x + 60, $c + $h * $f + 5);
            $pdf->Cell(20, 54, '', 1, 0, 'C', true);

            $pdf->SetXY($x + 60, $c + $h * $f);
            $pdf->Cell(10, 59, '', 1, 0, 'C');

            $pdf->SetXY($x + 80, $c + $h * $f);
            $pdf->Cell(60, 5, 'SABER HACER (34%)', 1, 0, 'C');
            #bar 2
            $pdf->SetXY($x + 140, $c + $h * $f + 5);
            $pdf->Cell(20, 54, '', 1, 0, 'C', true);

            $pdf->SetXY($x + 140, $c + $h * $f);
            $pdf->Cell(10, 59, '', 1, 0, 'C');

            $pdf->SetXY($x + 160, $c + $h * $f);
            $pdf->Cell(60, 5, 'SABER SABER (33%)', 1, 0, 'C');
            #bar 3
            $pdf->SetXY($x + 220, $c + $h * $f + 5);
            $pdf->Cell(20, 54, '', 1, 0, 'C', true);

            $pdf->SetXY($x + 220, $c + $h * $f);
            $pdf->Cell(10, 59, '', 1, 0, 'C');

            $ff = $f;
            $x += 4;
            $c += 1;
            $t = 0;

            #Saber ser Text
            $pdf->Text($x, $c + $h * ++$f, '1.   ADAPTABILIDAD');
            $saberser = $this->Nota($x + 59, $c + $h * $f, $pdf, $Notas, true);
            if(isset($this->Notas2['Notas']))
            {
                $this->Nota($x + 69, $c + $h * $f, $pdf, $this->Notas2['Notas'], true, $t);
            }
            $pdf->Text($x, $c + $h * ++$f, '2.   COLABORACIÓN');
            $saberser += $this->Nota($x + 59, $c + $h * $f, $pdf, $Notas, true);
            if(isset($this->Notas2['Notas']))
            {
                $this->Nota($x + 69, $c + $h * $f, $pdf, $this->Notas2['Notas'], true, ++$t);
            }
            $pdf->Text($x, $c + $h * ++$f, '3.   CREATIVIDAD');
            $saberser += $this->Nota($x + 59, $c + $h * $f, $pdf, $Notas, true);
            if(isset($this->Notas2['Notas']))
            {
                $this->Nota($x + 69, $c + $h * $f, $pdf, $this->Notas2['Notas'], true, ++$t);
            }
            $pdf->Text($x, $c + $h * ++$f, '4.   RELACIONES INTERPERSONALES');
            $saberser += $this->Nota($x + 59, $c + $h * $f, $pdf, $Notas, true);
            if(isset($this->Notas2['Notas']))
            {
                $this->Nota($x + 69, $c + $h * $f, $pdf, $this->Notas2['Notas'], true, ++$t);
            }
            $pdf->Text($x, $c + $h * ++$f, '5.   RESPONSABILIDAD');
            $saberser += $this->Nota($x + 59, $c + $h * $f, $pdf, $Notas, true);
            if(isset($this->Notas2['Notas']))
            {
                $this->Nota($x + 69, $c + $h * $f, $pdf, $this->Notas2['Notas'], true, ++$t);
            }
            $pdf->Text($x, $c + $h * ++$f, '6.   ÉTICA');
            $saberser += $this->Nota($x + 59, $c + $h * $f, $pdf, $Notas, true);
            if(isset($this->Notas2['Notas']))
            {
                $this->Nota($x + 69, $c + $h * $f, $pdf, $this->Notas2['Notas'], true, ++$t);
            }
            $f = $ff;
            $x += 82;
            #Saber hacer Text
            $pdf->Text($x, $c + $h * ++$f, '1.   CUMPLIMIENTO DE OBJETIVOS');
            $saberhacer = $this->Nota($x + 57, $c + $h * $f, $pdf, $Notas, true);
            if(isset($this->Notas2['Notas']))
            {
                $this->Nota($x + 67, $c + $h * $f, $pdf, $this->Notas2['Notas'], true, ++$t);
            }
            $pdf->Text($x, $c + $h * ++$f, '2.   MANEJO DE RECURSOS');
            $saberhacer += $this->Nota($x + 57, $c + $h * $f, $pdf, $Notas, true);
            if(isset($this->Notas2['Notas']))
            {
                $this->Nota($x + 67, $c + $h * $f, $pdf, $this->Notas2['Notas'], true, ++$t);
            }
            $pdf->Text($x, $c + $h * ++$f, '3.   DETECCIÓN DE OPORTUNIDADES');
            $saberhacer += $this->Nota($x + 57, $c + $h * $f, $pdf, $Notas, true);
            if(isset($this->Notas2['Notas']))
            {
                $this->Nota($x + 67, $c + $h * $f, $pdf, $this->Notas2['Notas'], true, ++$t);
            }
            $pdf->Text($x, $c + $h * ++$f, '4.   PLANEACIÓN');
            $saberhacer += $this->Nota($x + 57, $c + $h * $f, $pdf, $Notas, true);
            if(isset($this->Notas2['Notas']))
            {
                $this->Nota($x + 67, $c + $h * $f, $pdf, $this->Notas2['Notas'], true, ++$t);
            }
            $pdf->Text($x, $c + $h * ++$f, '5.   COMUNICACIÓN ORAL Y ESCRITA');
            $saberhacer += $this->Nota($x + 57, $c + $h * $f, $pdf, $Notas, true);
            if(isset($this->Notas2['Notas']))
            {
                $this->Nota($x + 67, $c + $h * $f, $pdf, $this->Notas2['Notas'], true, ++$t);
            }
            $pdf->Text($x, $c + $h * ++$f, '6.   CALIDAD DEL TRABAJO');
            $saberhacer += $this->Nota($x + 57, $c + $h * $f, $pdf, $Notas, true);
            if(isset($this->Notas2['Notas']))
            {
                $this->Nota($x + 67, $c + $h * $f, $pdf, $this->Notas2['Notas'], true, ++$t);
            }

            $f = $ff;
            $x += 80;
            #Saber saber Text
            $pdf->Text($x, $c + $h * ++$f, '1.   INTERPRETACIÓN');
            $sabersaber = $this->Nota($x + 57, $c + $h * $f, $pdf, $Notas, true);
            if(isset($this->Notas2['Notas']))
            {
                $this->Nota($x + 67, $c + $h * $f, $pdf, $this->Notas2['Notas'], true, ++$t);
            }
            $pdf->Text($x, $c + $h * ++$f, '2.   ANÁLISIS');
            $sabersaber += $this->Nota($x + 57, $c + $h * $f, $pdf, $Notas, true);
            if(isset($this->Notas2['Notas']))
            {
                $this->Nota($x + 67, $c + $h * $f, $pdf, $this->Notas2['Notas'], true, ++$t);
            }
            $pdf->Text($x, $c + $h * ++$f, '3.   PROPOSICIÓN');
            $sabersaber += $this->Nota($x + 57, $c + $h * $f, $pdf, $Notas, true);
            if(isset($this->Notas2['Notas']))
            {
                $this->Nota($x + 67, $c + $h * $f, $pdf, $this->Notas2['Notas'], true, ++$t);
            }
            $pdf->Text($x, $c + $h * ++$f, '4.   ARGUMENTACIÓN');
            $sabersaber += $this->Nota($x + 57, $c + $h * $f, $pdf, $Notas, true);
            if(isset($this->Notas2['Notas']))
            {
                $this->Nota($x + 67, $c + $h * $f, $pdf, $this->Notas2['Notas'], true, ++$t);
            }
            $pdf->Text($x, $c + $h * ++$f, '5.   SÍNTESIS');
            $sabersaber += $this->Nota($x + 57, $c + $h * $f, $pdf, $Notas, true);
            if(isset($this->Notas2['Notas']))
            {
                $this->Nota($x + 67, $c + $h * $f, $pdf, $this->Notas2['Notas'], true, ++$t);
            }
            $pdf->Text($x, $c + $h * ++$f, '6.   ACTUALIZACIÓN');
            $sabersaber += $this->Nota($x + 57, $c + $h * $f, $pdf, $Notas, true);
            if(isset($this->Notas2['Notas']))
            {
                $this->Nota($x + 67, $c + $h * $f, $pdf, $this->Notas2['Notas'], true, $t);
            }

            ##########################
            $c = 30;
            $x = 30;

            $f = $ff;
            $pdf->Rect($x, $c + $h * $f, 240, 9);
            $pdf->Rect($x, $c + $h * ++$f, 240, 9);
            $pdf->Rect($x, $c + $h * ++$f, 240, 9);
            $pdf->Rect($x, $c + $h * ++$f, 240, 9);
            $pdf->Rect($x, $c + $h * ++$f, 240, 9);
            $pdf->Rect($x, $c + $h * ++$f, 240, 9);

            $saberser = number_format(($saberser / 6) * .33, 2);
            $saberhacer = number_format(($saberhacer / 6) * .34, 2);
            $sabersaber = number_format(($sabersaber / 6) * .33, 2);
            $f++;
            $pdf->SetFont('Arial', 'B', 8);
            $pdf->SetWidths([50, 35, 35]);
            $pdf->SetAligns(['C', 'C', 'C']);
            $pdf->SetXY($x, $c + $h * ++$f);
            $pdf->Row(['TOTALES', 'PRIMER MOMENTO', 'SEGUNDO MOMENTO']);
            $pdf->SetAligns(['L', 'C', 'C']);
            $pdf->SetXY($x, $c + $h * $f + 5);
            $pdf->Row(['SABER SER (33%)', $saberser, isset($this->Notas2['Saberser']) ? $this->Notas2['Saberser'] : '']);
            $pdf->SetXY($x, $c + $h * $f + 10);
            $pdf->Row(['SABER HACER (34%)', $saberhacer, isset($this->Notas2['Saberhacer']) ? $this->Notas2['Saberhacer'] : '']);
            $pdf->SetXY($x, $c + $h * $f + 15);
            $pdf->Row(['SABER SABER (33%)', $sabersaber, isset($this->Notas2['Sabersaber']) ? $this->Notas2['Sabersaber'] : '']);

            $pdf->SetFont('Arial', '', 8);

            $f += 2;
            #######Nota Primer momento#########
            $nota1 = $sabersaber + $saberser + $saberhacer;
            $nota1 = $nota1 > 5 ? 5 : $nota1;
            $pdf->Text($x, $c + $h * ++$f, 'Nota primer momento');

            $pdf->SetXY($x + 32, $c + $h * $f - 3);
            $pdf->Cell(15, 4, number_format($nota1, 1), 1, 0, 'C');
            $pdf->Text($x + 48, $c + $h * $f, 'Fecha');
            $pdf->Text($x + 65, $c - 1 + $h * $f, Fecha($Persona1->FECHA_REGISTRO));
            $pdf->Line($x + 58, $c + $h * $f, 120, $c + $h * $f);

            $pdf->Text($x + 92, $c + $h * $f, 'Firma estudiante');
            $pdf->Line($x + 115, $c + $h * $f, 205, $c + $h * $f);

            $pdf->Text($x, $c + $h * ++$f, 'Firma asesor');
            $pdf->Line($x + 18, $c + $h * $f, 95, $c + $h * $f);

            $pdf->Text($x + 70, $c + $h * $f, 'Firma cooperador');
            $pdf->Line($x + 95, $c + $h * $f, 185, $c + $h * $f);

            ###Nota Segundo Memento########
            $pdf->Text($x, $c + $h * ++$f, 'Nota segundo momento');
            $nota2 = 0;
            if(isset($this->Notas2['Notas']))
            {
                $nota2 = number_format($this->Notas2['Sabersaber'] + $this->Notas2['Saberser'] + $this->Notas2['Saberhacer'], 1);
                $nota2 = $nota2 > 5 ? 5 : $nota2;
            }
            $pdf->SetXY($x + 32, $c + $h * $f - 3);
            $pdf->Cell(15, 4, isset($this->Notas2['Notas']) ? $nota2 : '', 1, 0, 'C');
            $pdf->Text($x + 48, $c + $h * $f, 'Fecha');
            if(isset($this->Notas2['Notas']))
            {
                $pdf->Text($x + 65, $c - 1 + $h * $f, Fecha($this->Notas2['Fecha']));
            }
            $pdf->Line($x + 58, $c + $h * $f, 120, $c + $h * $f);
            $pdf->Text($x + 92, $c + $h * $f, 'Firma estudiante');
            $pdf->Line($x + 115, $c + $h * $f, 205, $c + $h * $f);

            $pdf->Text($x, $c + $h * ++$f, 'Firma asesor');
            $pdf->Line($x + 18, $c + $h * $f, 95, $c + $h * $f);

            $pdf->Text($x + 70, $c + $h * $f, 'Firma cooperador');
            $pdf->Line($x + 95, $c + $h * $f, 185, $c + $h * $f);

            $pdf->Text($x, $c + $h * ++$f, 'Nota definitiva');

            $pdf->SetXY($x + 32, $c + $h * $f - 3);
            $pdf->Cell(15, 4, isset($this->Notas2['Notas']) ? number_format(($nota2 + $nota1) / 2, 1) : '', 1, 0, 'C');

            $pdf->SetFont('Arial', 'B', 8);
            $pdf->Text($x, $c + $h * ++$f, 'Escala de calificación 0-5');
            $pdf->SetFont('Arial', '', 8);
            $pdf->Text($x + 50, $c + $h * $f, 'V°B° Coordinador de práctica');
            $pdf->Line($x + 90, $c + $h * $f, 205, $c + $h * $f);
            $pdf->Text($x, $c + $h * ++$f, 'NOTA: Anexar a este, los registros de asesoría que dan cuenta del acompañamiento al estudiante en el semestre');

            $pdf->Text(270, $c + $h * ++$f + 5, 'Página ' . $pdf->PageNo());

        }
    }
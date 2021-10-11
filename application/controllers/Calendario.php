
<?php if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class calendario extends CI_Controller
{

	function __construct()
	{

		parent::__construct();
		$this->load->library('session');
		$this->load->model('model_actividades');
		$this->load->model('model_trabajos');
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->library('mpdf60/Mpdf');
	}

	public function index()
	{
		$date  = "";
		$data['query'] = $this->model_actividades->getAll($date);
		$data['trabajos']	= $this->model_actividades->getAllWORK($date);
		$this->load->view('plantilla/Head_v1');
		$this->load->view('actividades/calendario', $data);
		$this->load->view('plantilla/Footer');
	}

	function activFecha()
	{
		$dias = array("DOMINGO", "LUNES", "MARTES", "MIERCOLES", "JUEVES", "VIERNES", "SABADO");
		$meses = array('ENE', 'FEB', 'MAR', 'ABR', 'MAY', 'JUN', 'JUL', 'AGO', 'SEP', 'OCT', 'NOV', 'DIC');
		$diasB = array("Domingo", "Lunes ", "Martes ", "Miercoles ", "Jueves", "Viernes", "Sabado");
		$mesesb = array('ENERO', 'FEBRERO', 'MARZO', 'ABRIL', 'MAYO', 'JUNIO', 'JUULIO', 'AGOSTO', 'SEPTIEMBRE', 'OCTUBRE', 'NOVIEMBRE', 'DICIEMBRE');


		$inicio  = $this->input->post('inicio');
		$termino  = $this->input->post('termino');
		$queryActv = $this->model_actividades->getAllRango($inicio, $termino);


		$titulo = "DESDE: " . date('d', strtotime($inicio)) . " de " . $mesesb[date('n', strtotime($inicio)) - 1] . " del " . date('Y', strtotime($inicio));

		if ($inicio <> $termino) {
			$titulo .= ' <BR> ';

			$titulo2 = "HASTA:" . date('d', strtotime($termino)) . " de " . $mesesb[date('n', strtotime($termino)) - 1] . " del " . date('Y', strtotime($termino));
		};
		$sumado = 0;
		foreach ($queryActv as $a) {
			$sumado += $a->act_nprsns;
		}

		echo ' <div class="col-lg-12" id="activ_fechas">';

		echo '
				 <table border="0" style="
    font-size: 16px; margin:10px;text-aling:right;    background: #337ab7;
    color: #FFF;">
  <tbody>
    <tr>
      <td style="padding: 5px;">' . $titulo . '</td>
      <td style="padding: 5px;">' . $titulo2 . '</td>
      <td style="padding: 5px;     font-size: 20px;
    font-weight: 700;">Nº Prsns: ' . $sumado . '</td>
    </tr>
  </tbody>
</table>
				 
				 ';





		/* $semana_select= $diasB[date("w",strtotime($inicio))];
				$mes_select= $meses[(date("m",strtotime($inicio)) - 1)];
				$dia_select = date("d",strtotime($inicio));
				
				$num_sem_select=date("W",strtotime($inicio));*/


		echo '<div class="table-responsive" >
								 
								 <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
										<th>Fecha</th>
                                        <th>Inicio</th>
                                        <th>Termino</th>
                                        <th>Categoria</th>
                                        <th>Subcategoria</th>
										 <th>Actividad</th>
                                        <th>Dependencia</th>
                                       
                                        <th>Responsable</th>
                                         <th>N° Prsns	</th>
										 
                                    </tr>
                                </thead>
                                <tbody>
                                ';
		$n = 0;
		foreach ($queryActv as $i) {


			$semana = $dias[date("w", strtotime($i->act_fecha))];
			$dia = date("d", strtotime($i->act_fecha));
			$mes = $meses[date('n', strtotime($i->act_fecha)) - 1];

			$num_sem = date("W", strtotime($i->act_fecha));
			$num_sem_hoy = date("W");

			$categoria = $i->act_ctg_id;
			$class = 'class="blanco"';

			switch ($categoria) {
				case 1:
					$class = 'class="warning"';
					break;
				case 3:
					$class = 'class="verde"';
					break;
			}



			$n++;
			echo '  <tr ' . $class . '>
                                        
										 
                                       <td width="11%">' . $semana . ', ' . $dia . ' ' . $mes . '</td> 
                                       <td>' . date("H:i", strtotime($i->act_inicio)) . '</td>
                                        <td>' . date("H:i", strtotime($i->act_termino)) . '</td>
                                        <td>' . $i->ctg_nombre . '</td>
                                        <td>' . $i->sctg_nombre . '</td>
										<td>' . $i->act_evento . '</td>
                                        <td>';

			$dep = $this->model_actividades->getDepen($i->act_id);

			foreach ($dep as $d) {
				echo '' . $d->dep_nombre . ' <br>';
			}

			echo '</td>
									
                                    <td>' . $i->act_responsable . '</td>
								    <td>' . $i->act_nprsns . '</td>
									 
									</tr>';
		}

		$trabajos = $this->model_trabajos->getAllRango($inicio, $termino);

		foreach ($trabajos as $t) {

			$semanat = $dias[date("w", strtotime($t->tb_fecha))];
			$diat = date("d", strtotime($t->tb_fecha));
			$mest = $meses[date('n', strtotime($t->tb_fecha)) - 1];

			$num_semt = date("W", strtotime($t->tb_fecha));

			$num_sem_hoyt = date("W");

			$class = 'class="azul"';
			if ((date("N", strtotime($t->tb_fecha)) == 6) or (date("N", strtotime($t->tb_fecha)) == 7)) {

				$class = 'class="danger"';
			}

			$n++;
			echo '  <tr ' . $class . '>
                                        <td>' . $semanat . ', ' . $diat . ' ' . $mest . '</td>
                                        <td>' . date("H:i", strtotime($t->tb_inicio)) . '</td>
                                        <td>' . date("H:i", strtotime($t->tb_termino)) . '</td>
                                        <td>' . $t->ctg_nombre . '</td>
                                        <td>' . $t->sctg_nombre . '</td>
										<td>' . $t->tb_descripcion . '</td>

                                        <td>';
			/*responsable*/

			if ($t->tb_tipo_responsable  == 1) {

				$id_work = $t->tb_id;
				$fun_work = $this->model_actividades->getFuncionarioWORK("" . $id_work . "");
				//var_dump( $fun_work);
				foreach ($fun_work  as $fw) {
					echo '' . $fw->nombre_fun . ' ' . $fw->paterno . '</br>';
				}
			} else {

				echo $t->tb_responsable;
			}

			echo '</td>
                                        <td>';

			/*dependencia*/

			$id_work = $t->tb_id;
			$fun_work = $this->model_actividades->getDepWORK("" . $id_work . "");
			//var_dump( $fun_work);
			foreach ($fun_work  as $fw) {
				echo '' . $fw->dep_nombre . '</br>';
			}

			echo '</td>
										
									 <td>&nbsp;</td>';
		}


		echo ' </tbody>
                            </table>
							</div>
							  </div>';
	}


	function toexcel()
	{

		$fecha_inicio = $this->input->post('txt_inicio');
		$fecha_termino = $this->input->post('txt_termino');
		$data['inicio'] = $fecha_inicio;
		$data['termino'] = $fecha_termino;
		$data['actividades'] = $this->model_actividades->getAllRango($fecha_inicio, $fecha_termino);
		$data['trabajos'] = $this->model_trabajos->getAllRango($fecha_inicio, $fecha_termino);
		$this->load->view('reportes/activity_report', $data);
	}

	function topdf()
	{

		$fecha_inicio = $this->uri->segment(3);
		$fecha_inicio .= '/';
		$fecha_inicio .= $this->uri->segment(4);
		$fecha_inicio .= '/';
		$fecha_inicio .= $this->uri->segment(5);



		$fecha_termino = $this->uri->segment(6);
		$fecha_termino .= '/';
		$fecha_termino .= $this->uri->segment(7);
		$fecha_termino .= '/';
		$fecha_termino .= $this->uri->segment(8);



		$data['inicio'] = $fecha_inicio;
		$data['termino'] = $fecha_termino;
		$data['actividades'] = $this->model_actividades->getAllRango($fecha_inicio, $fecha_termino);
		$data['trabajos'] = $this->model_trabajos->getAllRango($fecha_inicio, $fecha_termino);

		/*$this->load->view('reportes/pdf_activity_report', $data);*/
		/*$mpdf->WriteHTML($this->load->view('reportes/pdf_activity_report',$data,true)); 
			$mpdf->Output;*/

		$html = $this->load->view('reportes/pdf_activity_report', $data, true);







		$cabecera = "<span><b>Mi primer documento PDF dinámico con mPDF</b></span>";

		$pie = "<span><i>Creado " . date("d/m/Y") . "</i></span>";


		$mpdf = new mPDF('', 'A4');
		$mpdf->AddPage('L');
		$mpdf->SetHTMLHeader($cabecera);
		$mpdf->WriteHTML($html);
		$mpdf->SetHTMLFooter($pie);

		/* $mpdf->WriteHTML($html);*/

		//download it.
		$mpdf->Output();
	}
}


?>
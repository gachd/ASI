<?php
//defined('BASEPATH') OR exit('No direct script access allowed');

class report_diarios extends CI_Controller
{

  function __construct()
  {

    parent::__construct();
    $this->load->library('session');
    $this->load->model('model_report');
    $this->load->helper('url');
    $this->load->helper('form');
    $this->load->library('form_validation');
    $this->load->library('session');
  }


  public function index()
  {

    $usuario = $this->session->userdata('id');
    $data['sector'] = $this->model_report->getSector();
    $data['incidentes'] = $this->model_report->getIncidentes($usuario);
    $data['categoria'] = $this->model_report->getCategoria();
    $data['prioridad'] = $this->model_report->getPrioridad();
    $this->load->view('plantilla/Head');
    $this->load->view('trabajos/report_diarios', $data);
    $this->load->view('plantilla/Footer');
  }
  
  function listdepen()
  {
    $sector  = $this->input->post('sector');
    if ($sector <> 0) {
      /*echo' <option value="0"> '.$ctg.'lllego</option>';*/
      $depen = $this->model_report->getDepen($sector);
      foreach ($depen as $d) {
        echo ' <option value="' . $d->dep_id . '">' . $d->dep_nombre . '</option>';
      }
    } else {
      echo ' <option value="0"> Seleccionar</option>';
    }
  }
  function newincident()
  {
    date_default_timezone_set("Chile/Continental");
    $hoy = date("Y-m-d H:i:s");

    //Validaciones
    //Nombre del campo, titulo, restricciones
    $this->form_validation->set_rules('sector', 'Sector', 'required');
    $this->form_validation->set_rules('depen', 'Dependencia', 'required');
    $this->form_validation->set_rules('categoria', 'Categoria', 'required');
    $this->form_validation->set_rules('prioridad', 'Prioridad', 'required');
    $this->form_validation->set_rules('descripcion', 'Descripcion', 'required|min_length[3]|trim');
    /* $this->form_validation->set_rules('msj', 'Mensaje', 'required|trim'); 
		$this->form_validation->set_rules('g-recaptcha-response', 'recaptcha validation', 'required|validate_captcha'); */

    // %s es el nombre del campo que ha fallado
    $this->form_validation->set_message('required', 'El campo %s es obligatorio');
    $this->form_validation->set_message('min_length', 'El campo %s debe tener mas de 3 caracteres');
    if ($this->form_validation->run() == FALSE) {
      echo validation_errors('<li style="    background: crimson;
					color: #fff;
					margin-bottom: 3px;
					list-style: none;
					margin: 20px;
					padding: 5px;">', '</li>');
    } else {


      $sector = $this->input->post('sector');
      $dep = $this->input->post('depen');
      $categoria = $this->input->post('categoria');
      $descripcion = $this->input->post('descripcion');

      $funcionario_depto = $this->model_report->funcionario_depto($categoria);
      foreach ($funcionario_depto as $fd) {
        $correo_fundepto = $fd->correo;
        $rut_fundepto = $fd->rut;
      }




      $data = array(
        'ri_sector' => $this->input->post('sector'),
        'ri_dep' => $this->input->post('depen'),
        'ri_categoria' => $this->input->post('categoria'),
        'ri_prioridad' => $this->input->post('prioridad'),
        'ri_desc' => $this->input->post('descripcion'),
        'ri_fecha_report' => $hoy,
        'ri_usuario' => $this->session->userdata('id'),
        'ri_asignado' => $rut_fundepto
      );



      /*INSERT INCIDENTE*/

      $this->model_report->insert_incident($data);

      /*datos del usuario*/
      $usuario = $this->session->userdata('id');
      $funcionario = $this->model_report->getfuncionario($usuario);
      foreach ($funcionario as $f) {
        $nom_fun = $f->nombre_fun;
        $ape_fun = $f->paterno;
        $correo_fun = $f->correo;
      }
      //Cargamos la librería email
      $this->load->library('email');
      $this->load->library('form_validation');
      $this->email->set_mailtype("html");
      //Ponemos la dirección de correo que enviará el email y un nombre

      $this->email->from('' . $correo_fun . '', '' . $nom_fun . ' ' . $ape_fun . '');


      /*
       * Ponemos el o los destinatarios para los que va el email
       * en este caso al ser un formulario de contacto te lo enviarás a ti
       * mismo
       */





      switch ($categoria) {
        case 1:
          $this->email->cc('fvalencia@enti-italiani.cl');
          $this->email->to('ymunoz@enti-italiani.cl');
          break;
        case 2:
          $this->email->to('vvenegas@enti-italiani.cl');
          break;
        case 3:
          $this->email->to('djimenez@enti-italiani.cl');
          break;
        case 4:
          $this->email->cc('manuopazo@gmail.com');
          $this->email->to('fibarra8@gmail.com');
          break;
        case 10:
          $this->email->cc('circolo@enti-italiani.cl');
          break;
      }


      /* $this->email->cc('vvenegas@enti-italiani.cl');*/
      //Definimos el asunto del mensaje
      $this->email->subject('Nuevo Requerimiento');

      /*DEPENDENCIA*/
      $depen = $this->model_report->getDepen($sector);
      foreach ($depen as $d) {
        $nom_dependencia = $d->dep_nombre;
      }

      /*CATEGORIA*/
      $cat = $this->model_report->getCategoriaID($categoria);
      foreach ($cat as $c) {
        $nom_cataegoria = $c->rc_nombre;
      }

$html =  '<html>
<style>
body {
font-size: 12px !important;
font-family: "Telex", sans-serif;
}
table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {
padding: 8px;
line-height: 1.42857143;
vertical-align: middle;
border: 1px solid #ddd;
}
</style>
<head>
<meta charset="utf-8">
<title>Documento sin título</title>
</head>

<body>
<table style="text-transform:uppercase;">
<tbody>
<tr>
  <td>SECTOR ' . $sector . ':</td>
  <td>' . $nom_dependencia . '</td>
</tr>
<tr>
  <td>' . $nom_cataegoria . '</td>
  <td>' . $descripcion . '</td>
</tr>
<tr>
  <td>Reporta:</td>
  <td>' . $nom_fun . ' ' . $ape_fun . '</td>
</tr>
</tbody>
</table>
<br>Para mayor información revisa en <a href="http://www.stadioitalianodiconcepcion.cl/ASI">ASI</a>
</body>
</html>';

      //Definimos el mensaje a enviar
      $this->email->message($html);
      echo $html;
     /*  if ($this->email->send()) {

        //mensaje de exito
        $this->session->set_flashdata('category_success', 'Incidente agregado exitosamente.');
       // redirect (base_url().'trabajos/report_diarios');
        echo '<script>
				window.location.href = "' . base_url() . 'trabajos/report_diarios";
				</script>';
      } else {
        echo 'error al enviar el mail';
      } */
    }
  }
  function coment_report()
  {
    $id_report  = $this->input->post('trid');
    $comentarios = $this->model_report->getComentID($id_report);

    if (!empty($comentarios)) {
      echo  '<div class="table-responsive">
  <table class="table table-hover ">
  <tbody>
    <tr>
      <td>FECHA</td>
	  
      <td>COMENTARIO</td>
    </tr>';
      foreach ($comentarios as $c) {
        $com_texto = $c->rc_comentario;
        $com_fecha = $c->rc_fecha;
        $com_usuario = $c->rc_usuario;

        $fun_coment = $this->model_report->getfuncionario($com_usuario);
        foreach ($fun_coment as $fc) {
          $nom_func = $fc->nombre_fun;
          $ape_func = $fc->paterno;
        }

        echo '	 
			 
    <tr>
      <td>' . date('d/m/Y H:i', strtotime($com_fecha)) . '</td>
	   <td><span style="    text-transform: capitalize;
    letter-spacing: 1px;
    font-weight: 600;    background: #efefef;
    padding: 2px;">' . $nom_func . ' ' . substr($ape_func, 0, 1) . '.</span> ' . $com_texto . '</td>
	  
     
    </tr>
   ';
      }
      echo '  </tbody>
</table>
</div>';
    } else {
      echo 'no hay comentarios disponibles';
    }
  }
  function asignado()
  {
    $id_report  = $this->input->post('id');
    /*echo''.$id_report.'<br>';*/
    /*$this->load->model('model_report');
			*/
    $asignado = $this->model_report->getIncidentesID($id_report);
    $asg = $this->model_report->getasg();

    foreach ($asignado as $as) {
      $id_asignado = $as->ri_asignado;
    }

    echo '  
			<input type="hidden" name="txt_incidente" value="' . $id_report . '">
			<table width="100%" border="0">
			  <tbody>';

    foreach ($asg as $a) {
      $id_asg = $a->id;
      $nombre_asg = $a->nombre;
      $chek = "";
      if ($id_asg == $id_asignado) {
        $chek = "checked";
      }

      echo '<tr>
								<td>
								<label><input type="radio" name="idasignado" value="' . $id_asg . '" ' . $chek . '  >&nbsp;' . $nombre_asg . '</td></label>
								</tr>';
    }
    echo '</tbody>
			</table>';
  }
  function actualizar_asignado()
  {

    $id_asignado = $_POST['idasignado'];
    $id_incidente = $_POST['txt_incidente'];
    $this->model_report->editarAsignado($id_asignado, $id_incidente);
    $this->session->set_flashdata('category_success', 'Asignado Correctamente.');
    redirect(base_url() . 'trabajos/report_diarios');
  }
  function ventana_comentario()
  {

    $id_report  = $this->input->post('id');
    $incidenteID = $this->model_report->getIncidentesID($id_report);

    foreach ($incidenteID as $t) {

      $tiempo = $t->ri_tiempo;
    }
    if ($tiempo ==  0) {
      echo '<p>Tiempo estimado<input class="form-control" type="number" name="txt_dias" style="width:77px;     display: inline-block; margin:3px;">días</p>';
    }

    echo '<input type="hidden" name="txt_incidente" value="' . $id_report . '">
		 <textarea style="width:100%; min-height:160px; margin-top:15px;" name="comentario" class="form-control"></textarea>
';
  }
  function comentarios()
  {
    $this->form_validation->set_rules('comentario', 'Descripcion', 'required|min_length[3]|trim');
    $this->form_validation->set_message('required', 'El campo %s es obligatorio');
    $this->form_validation->set_message('min_length', 'El campo %s debe tener mas de 3 caracteres');
    if ($this->form_validation->run() == FALSE) {
      echo validation_errors('<li style="    background: crimson;
					color: #fff;
					margin-bottom: 3px;
					list-style: none;
					margin: 20px;
					padding: 5px;">', '</li>');
    } else {

      date_default_timezone_set("Chile/Continental");
      $hoy = date("Y-m-d H:i:s");
      $data = array(
        'rc_incidente' => $this->input->post('txt_incidente'),
        'rc_comentario' => $this->input->post('comentario'),
        'rc_fecha' => $hoy,
        'rc_usuario' => $this->session->userdata('id')
      );

      /*actualizar tiempo*/
      $tiempo = $this->input->post('txt_dias');
      $id_report = $this->input->post('txt_incidente');
      $incidenteID = $this->model_report->getIncidentesID($id_report);
      foreach ($incidenteID as $t) {
        $tiempoi = $t->ri_tiempo;
      }
      if ($tiempoi ==  0) {
        $this->model_report->editartiempo($tiempo, $id_report);
      }
      /*INSERT ACTIVIDAD*/

      $this->model_report->insert_coment($data);
      $this->session->set_flashdata('category_success', 'Comentario agregado exitosamente.');
      echo '<script>
				window.location.href = "' . base_url() . 'trabajos/report_diarios";
				</script>';
      /*echo'<script>
				document.getElementById("form-comentario").reset();
				</script>';*/
    }
  }
  function actualizar_estado()
  {
    $id = $_POST['trid'];
    $this->model_report->updateIncidente($id);
    $this->session->set_flashdata('category_success', 'Asignado Correctamente.');
    echo '<script>
				window.location.href = "' . base_url() . 'trabajos/report_diarios";
				</script>';
  }
  function programa()
  {
    $id = $_POST['trid'];
    /* echo $id;*/
    $estado = $this->model_report->selectEstado($id);
    foreach ($estado as $e) {
      $ri_estado = $e->ri_estado;
    }

    if ($ri_estado <> 1) {

      $comentarios = $this->model_report->getComentID($id);
      $total = count($comentarios);
      /*echo $total;*/

      /*Tiene comentarios*/
      if ($total > 0) {
        $delete_c = $this->model_report->deleteComent($id);
        /*HAY COMENTARIOS*/
        if (!$delete_c) {
          /*ELIMINAR INCIDENTES*/
          $delete_i = $this->model_report->deleteIncidente($id);
          if (!$delete_i) {
            $this->session->set_flashdata('category_success', 'Eliminado Correctamente.');
            echo '<script>
				window.location.href = "' . base_url() . 'trabajos/report_diarios";
				</script>';
          } else {
            echo '
	<div class="error alert alert-danger alert-dismissible " role="alert" style="margin:15px;"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>Error al eliminar incidente, se eliminaron solo comentarios</div>
					  ';
          }
        } else {
          echo '<div class="error alert alert-danger alert-dismissible " role="alert" style="margin:15px;"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>Error al eliminar comentarios</div>';
        }
      }
      /* NO HAY COMENTARIOS*/ else {

        /*ELIMINAR INCIDENTES*/
        $delete_i = $this->model_report->deleteIncidente($id);
        if (!$delete_i) {
          $this->session->set_flashdata('category_success', 'Eliminado Correctamente.');
          echo '<script>
				window.location.href = "' . base_url() . 'trabajos/report_diarios";
				</script>';
        } else {
          echo '<div class="error alert alert-danger alert-dismissible " role="alert" style="margin:15px;"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>Error al eliminar incidente</div>';
        }
      }




      /* 
			  $this->session->set_flashdata('category_success', 'Eliminado Correctamente.');
		  echo'<script>
				window.location.href = "'.base_url().'trabajos/report_diarios";
				</script>';*/
    } else {
      echo '<div class="error alert alert-danger alert-dismissible " role="alert" style="margin:15px;"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>Incidente Cerrado ! no puede ser eliminado</div>';
    }
  }
  function incidentesfecha()
  {

    $inicio = $_POST['inicio'];
    $termino = $_POST['termino'];
    $usuario = $this->session->userdata('id');
    function dias_transcurridos($fecha_i, $fecha_f)
    {
      $dias = (strtotime($fecha_i) - strtotime($fecha_f)) / 86400;
      $dias = abs($dias);
      $dias = floor($dias);
      return $dias;
    }

    if (empty($termino)) {
      $incidentes = $this->model_report->getIncidentesFecha($inicio, $inicio, $usuario);
    } else {
      $incidentes = $this->model_report->getIncidentesFecha($inicio, $termino, $usuario);
    }

    if (!empty($incidentes)) {

      /*inicio*/
      echo ' <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                     <thead style="text-align:center;">
									        <th>Nª</th>
                                            <th>Fecha</th>
                                            <th>Reporto</th>
                                            <th>Sector</th>
                                            <th>Dependencia</th>
                                            <th>Categoria</th>
                                            <th>Descripción</th>
                                            <th>Asignado a</th>
											<th>Tiempo<br>Est.</th>
                                            <th>Tiempo<br>Trans.</th>
                                            <th>Estado</th>
                                            <th>Prioridad</th>
                                            <th>&nbsp;</th>
                                            <th>&nbsp;</th>
                                            <th>&nbsp;</th>
                                       </tr>
                                    </thead>
                                    <tbody>';
      foreach ($incidentes as $i) {

        $date_report = date('d/m/y H:i', strtotime($i->ri_fecha_report));

        $fun = $this->model_report->getFunID($i->ri_usuario);
        foreach ($fun as $f) {
          $fun_nombre = $f->nombre_fun;
          $fun_paterno = $f->paterno;
        }



        if ($i->ri_estado == 0) {
          $estado = '<span class="label label-success">Pendiente</span>';
        } else {
          $estado = '<span class="label label-default">Cerrado</span>
    ';
        }

        switch ($i->ri_prioridad) {
          case "1":
            $color = "info";
            break;
          case "2":
            $color = "warning";
            break;
          case "3":
            $color = "danger";
            break;
        }

        $alert_tiempo = "";
        $dias_transcurridos = "";
        $date_requerimiento = date('Y/m/d', strtotime($i->ri_fecha_report));
        $date_cierre = date('Y/m/d', strtotime($i->ri_fecha_cierre));
        $fechaactual = date("Y/m/d");
        if ($i->ri_estado == 0) {

          $dias_transcurridos = dias_transcurridos($date_requerimiento, $fechaactual);
          if (($dias_transcurridos > $i->ri_tiempo) && ($i->ri_tiempo <> 0)) {
            $alert_tiempo = 'style="background:lightyellow;"';
          }
        } else {
          $dias_transcurridos = dias_transcurridos($date_requerimiento, $date_cierre);
        }

        echo '<tr ' . $alert_tiempo . '>
				 <td  class="clickable-row"  id="' . $i->ri_id . '"> ' . $i->ri_id . ' </td>
				<td  class="clickable-row"  id="' . $i->ri_id . '"> ' . $date_report . ' </td>
                 <td  class="clickable-row"  id="' . $i->ri_id . '">' . $fun_nombre . ' ' . substr($fun_paterno, 0, 1) . '.</td>
                 <td class="clickable-row"  id="' . $i->ri_id . '" >' . $i->nombre . '</td>
                 <td class="clickable-row"  id="' . $i->ri_id . '" >' . $i->dep_nombre . '</td>
				  <td  class="clickable-row"  id="' . $i->ri_id . '">' . $i->rc_nombre . '</td>
                 <td class="clickable-row"  id="' . $i->ri_id . '" >' . $i->ri_desc . '</td>';

        /*asignado*/
        if (empty($i->ri_asignado)) {
          echo '<td class="clickable-row"  id="' . $i->ri_id . '">&nbsp;</td>';
        } else {
          $asignado = $this->model_report->getFunID($i->ri_asignado);
          foreach ($asignado as $a) {

            $nom_asignado = $a->nombre_fun;
            $ape_asignado = $a->paterno;
            echo '<td class="clickable-row"  id="' . $i->ri_id . '">' . $nom_asignado . ' ' . $ape_asignado . '</td>';
          }
        }
        /*tiempo estimado*/
        echo '<td class="clickable-row"  id="' . $i->ri_id . '" >' . $i->ri_tiempo . ' d&iacute;as</td>';
        /*tiempo trasncurrido*/
        echo '<td class="clickable-row"  id="' . $i->ri_id . '" >' . $dias_transcurridos . ' d&iacute;as</td>';
        /*estado y prioridad*/
        echo '<td class="clickable-row"  id="' . $i->ri_id . '" >' . $estado . '</td>
                 <td class="clickable-row"  id="' . $i->ri_id . '" ><span class="label label-' . $color . '">' . $i->rp_nombre . '</span></td>';
        /*comentarios*/
        if (($usuario == $i->ri_asignado) or ($usuario == $i->ri_usuario)) {
          echo ' <td class="comentario icono"  id="' . $i->ri_id . '" ><span class="glyphicon glyphicon-comment" aria-hidden="true"></span></td>';
        } else {
          echo '<td></td>';
        }
        /*cerrar requerimiento*/
        if (($usuario == $i->ri_asignado)) {
          echo '<td class="ok icono"  id="' . $i->ri_id . '" ><span class="glyphicon glyphicon-ok" aria-hidden="true"></span></td>';
        } else {
          echo '<td></td>';
        }
        /*eliminar*/
        if ($usuario == $i->ri_usuario) {
          echo '<td class="eliminar icono"  id="' . $i->ri_id . '" ><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></td>
                 </tr>';
        } else {
          echo '<td></td>';
        }
      }

      echo ' </tbody>
									 </table>';

      /*fin*/
    } else {
      echo 'no hay resultados para su busqueda';
    }
  }
  function toexcel()
  {



    $inicio = $this->input->post('txt_inicio');
    $termino = $this->input->post('txt_termino');
    $usuario = $this->session->userdata('id');

    if (empty($termino)) {
      $data['incidentes'] = $this->model_report->getIncidentesFecha($inicio, $inicio, $usuario);
    } else {
      $data['incidentes'] = $this->model_report->getIncidentesFecha($inicio, $termino, $usuario);
    }

    $this->load->view('reportes/incidentes_report', $data);
  }
}

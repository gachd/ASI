<?php



class inicio extends CI_Controller
{



  function __construct()
  {

    parent::__construct();

    $this->load->library('session');

    $this->load->model('model_reportes');

    $this->load->model('model_trabajos');

    $this->load->model('model_turnos');

    $this->load->model('model_actividades');

    $this->load->model('model_socios');

    $this->load->helper('url');

    $this->load->helper('form');

    $this->load->library('form_validation');

    $this->load->library('session');

    $this->load->library('mpdf60/Mpdf');
  }





  public function index()
  {



    $data['activos'] = $this->model_socios->socios_activos();

    $data['inactivos'] = $this->model_socios->socios_inactivos();

    $data['baja'] = $this->model_socios->socios_baja();





    $this->load->view('plantilla/Head');

    $this->load->view('socios/inicio', $data);

    $this->load->view('plantilla/Footer');
  }





  public function mostrarcantidad()
  {



    $estado  = $this->input->post('estado');



    $socorros = '72265900-7';

    $centro = '70331500-3';

    $atletico = '71888800-k';

    $stadio = '65106820-7';

    $scuola = '65467840-5';





    //consulta cantidad socios socorros

    if ($estado != 4) {

      $cant_socorros = $this->model_socios->mostrar_socios($estado, $socorros);

      $cant_centro = $this->model_socios->mostrar_socios($estado, $centro);

      $cant_atletico = $this->model_socios->mostrar_socios($estado, $atletico);

      $cant_stadio = $this->model_socios->mostrar_socios($estado, $stadio);

      $cant_scuola = $this->model_socios->mostrar_socios($estado, $scuola);
    } else {

      $cant_socorros = $this->model_socios->mostrar_sociosb($estado, $socorros);

      $cant_centro = $this->model_socios->mostrar_sociosb($estado, $centro);

      $cant_atletico = $this->model_socios->mostrar_sociosb($estado, $atletico);

      $cant_stadio = $this->model_socios->mostrar_sociosb($estado, $stadio);

      $cant_scuola = $this->model_socios->mostrar_sociosb($estado, $scuola);
    }



    // $cant_centro = $this -> model_socios->mostar_socios($estado,$centro);

    // $cant_atletico = $this -> model_socios->mostar_socios($estado,$atletico);

    // $cant_stadio = $this -> model_socios->mostar_socios($estado,$stadio);

    // $cant_scuola = $this -> model_socios->mostar_socios($estado,$scuola);

    echo '<table id="cantidad" >

         <thead>		    

              <th>Corporación</th>

              <th>Cantidad de Socios</th>

              </thead>

         <tbody>     

          <tr> 

            <td>Socorros Mutuos</td>

            <td>' . $cant_socorros . '</td>

          </tr>

          <tr> 

            <td>Centro Italiano</td>

            <td>' . $cant_centro . '</td>

          </tr>

          <tr> 

            <td>Stadio Italiano</td>

            <td>' . $cant_stadio . '</td>

          </tr>

          <tr> 

            <td>Stadio Atletico</td>

            <td>' . $cant_atletico . '</td>

          </tr>

          <tr> 

            <td>Scuola</td>

            <td>' . $cant_scuola . '</td>

          </tr>

         </tbody>

        </table>';





    echo '<a href="' . base_url() . 'socios/inicio" type="button" class="btn btn-info">Volver</a>';
  }
}

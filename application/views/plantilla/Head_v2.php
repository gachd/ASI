<?php !isset($this->session->userdata['logueado']) ?   die('Página con acceso restringido. <a href="' . base_url() . 'Login">Click aquí para hacer login</a>')   :   ''; ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">


  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

  <!-- Bootstrap Core JavaScript -->
  <script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
  <!-- Morris Charts JavaScript -->
  <script src="<?php echo base_url(); ?>assets/js/plugins/morris/raphael.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/js/plugins/morris/morris.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/js/plugins/morris/morris-data.js"></script>

  <script src="<?php echo base_url(); ?>assets/js/plugins/jquery.dataTables.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/js/plugins/dataTables.bootstrap.min.js"></script>





  <!-- Bootstrap -->
  <link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet">
  <link href="<?php echo base_url(); ?>assets/css/plugins/dataTables.bootstrap.min.css" rel="stylesheet" type="text/css">


  <!-- Custom CSS -->
  <link href="<?php echo base_url(); ?>assets/css/sb-admin.css" rel="stylesheet">
  <link href="<?php echo base_url(); ?>assets/css/header/header.css" rel="stylesheet">

  <!-- Morris Charts CSS -->

  <!-- Custom Fonts -->
  <link href="<?php echo base_url(); ?>/assets/fonts/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

  <!-- datepicker-->
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

  <style>
    .dropdown-submenu {
      position: relative;
      background: #fff;
    }

    .navbar-nav .dropdown .dropdown-menu li {

      background: #fff;
      text-transform: uppercase;
      font-size: 11px;
      letter-spacing: 2px;
      border-bottom: 1px solid #c1c1c1;
    }

    .navbar-nav .dropdown .dropdown-menu .tercer-menu li {

      background: #f8f8f8;
      padding-left: 15px;
      border-bottom: none;
      margin-bottom: 3px;
    }

    .dropdown-submenu .dropdown-menu {
      top: 0;
      left: 100%;
      margin-top: -1px;
    }

    .nav-titulo {

      /*position: absolute;
    z-index: 1010;
    top: 0;*/
      width: 100%;
      /*margin: 0px;
    float: left;*/
      /*left: 200px;*/
      -moz-box-shadow: 1px 2px 3px rgba(0, 0, 0, .1);
      -webkit-box-shadow: 1px 2px 3px rgba(0, 0, 0, .1);
      box-shadow: 1px 2px 3px rgba(0, 0, 0, .1);
      -moz-border-radius: 0;
      -webkit-border-radius: 0;
      border-radius: 0;
      padding: 0;
      margin-bottom: 10px;
      border: none;
      background-color: #fff;
      padding-bottom: 5px;
    }

    body,
    html {
      height: 100%;
    }

    #wrapper {
      padding: inherit;
    }

    .cont-sidebar {
      z-index: 1060;
    }

    #wrapper .cont-sidebar {
      width: auto;
      height: 100%;
      /*background-color: #2B333E;*/
      float: left;
      position: fixed;
      top: 0;
    }


    nav.sidebar,
    .main {
      -webkit-transition: margin 200ms ease-out;
      -moz-transition: margin 200ms ease-out;
      -o-transition: margin 200ms ease-out;
      transition: margin 200ms ease-out;
    }

    .main {
      padding: 0px 10px 0 10px;
    }

    @media (min-width: 765px) {

      .main {
        position: absolute;
        width: calc(100% - 40px);
        margin-left: 40px;
        float: right;
        top: 0;
      }

      nav.sidebar:hover+.main {
        margin-left: 200px;
      }

      nav.sidebar.navbar.sidebar>.container .navbar-brand,
      .navbar>.container-fluid .navbar-brand {
        margin-left: 0px;
      }

      nav.sidebar .navbar-brand,
      nav.sidebar .navbar-header {
        text-align: center;
        width: 100%;
        margin-left: 0px;
      }

      nav.sidebar a {
        padding-right: 13px;
      }

      nav.sidebar .navbar-nav>li:first-child {
        border-top: 1px #e5e5e5 solid;
      }

      nav.sidebar .navbar-nav>li {
        border-bottom: 1px #e5e5e5 solid;
        text-transform: uppercase;
        font-size: 11px;
        letter-spacing: 2px;
      }

      nav.sidebar .navbar-nav .open .dropdown-menu {
        position: static;
        float: none;
        width: auto;
        margin-top: 0;
        background-color: transparent;
        border: 0;
        -webkit-box-shadow: none;
        box-shadow: none;
      }

      nav.sidebar .navbar-collapse,
      nav.sidebar .container-fluid {
        padding: 0 0px 0 0px;
      }

      .navbar-inverse .navbar-nav .open .dropdown-menu>li>a {
        color: #777;
      }

      nav.sidebar {
        width: 200px;
        height: 100%;
        margin-left: -160px;
        float: left;
        margin-bottom: 0px;
      }

      nav.sidebar li {
        width: 100%;
      }

      nav.sidebar:hover {
        margin-left: 0px;
      }

      .forAnimate {
        opacity: 0;
      }
    }

    @media (min-width: 1330px) {

      .main {
        width: calc(100% - 200px);
        margin-left: 200px;
      }

      nav.sidebar {
        margin-left: 0px;
        float: left;
      }

      nav.sidebar .forAnimate {
        opacity: 1;
      }
    }

    nav.sidebar .navbar-nav .open .dropdown-menu>li>a:hover,
    nav.sidebar .navbar-nav .open .dropdown-menu>li>a:focus {
      color: #ffffff;
      background-color: #0089286e;
    }

    nav:hover .forAnimate {
      opacity: 1;
    }

    section {
      padding-left: 15px;
    }
  </style>
</head>

<body>
  <div id="wrapper">
    <div class="cont-sidebar">
      <nav class="navbar navbar-default sidebar" role="navigation">
        <div class="container-fluid">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-sidebar-navbar-collapse-1">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
          </div>
          <div class="collapse navbar-collapse" id="bs-sidebar-navbar-collapse-1">

            <ul class="nav navbar-nav">
              <li style="text-align: center;"><img width="120" src="https://www.stadioitalianodiconcepcion.cl/ASI/assets/images/logo_instituciones.png"></li>


              <?php
              //print_r( $_SESSION );  

              //echo' <li><a href="'.base_url().'actividades/nueva>Actividades</a></li>';

              $this->load->library('session');
              $usuario = $this->session->userdata('id');
              $ci = &get_instance();
              $ci->load->model("model_login");
              $menu = $ci->model_login->menu_principal($usuario);
             



              foreach ($menu as $m) {
                $principal = $m->perm_principal;

                if (($principal == 1) or ($principal == 0)) {
                  if ($principal <> 0) {
                    $sub_menu = $ci->model_login->sub_menu($usuario, $principal);
                  } else {
                    $sub_menu = $ci->model_login->sub_menu(0, 1);
                  }
                  echo '<li class="dropdown">
		    	<a href="#" class="dropdown-toggle" data-toggle="dropdown">Actividades <b class="caret"></b><span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-calendar"></span></a>
		    	<ul class="dropdown-menu">';
                  foreach ($sub_menu as $sm) {
                    $perm_nombre = $sm->perm_nombre;
                    $perm_ruta = $sm->perm_ruta;
                    echo ' <li><a href="' . base_url() . '' . $perm_ruta . '">' . $perm_nombre . '</a></li>';
                  }
                  echo '</ul></li>';
                }


                //TRABAJOS

                if (($principal == 2) or ($principal == 0)) {
                  echo '<li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">Trabajos <b class="caret"></b><span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-wrench	Try it"></span></a>
		    		<ul class="dropdown-menu">
		    		       <li class="dropdown-submenu"><a class="test"  href="">Planificaion<span class="caret"></span></a>
		    		           <ul class="dropdown-menu tercer-menu">
		    		                <li><a href="' . base_url() . 'trabajos/disp_trabajo">1. Disp. Trabajos</a></li>
		    		                <li><a href="' . base_url() . 'trabajos/planificacion_temporada">2. Temporada</a></li>
		    		                <li><a href="' . base_url() . 'trabajos/planificacion_diaria">3. Plan Mensual</a></li>
		    		           </ul>
		    		       </li>
                   <li><a href="' . base_url() . 'trabajos/chek_trabajos">Chek-in</a></li>
                    <li><a href="' . base_url() . 'trabajos/planificacion">Acumulado</a></li>
		    		       
		    		       <li><a href="' . base_url() . 'trabajos/nuevo">Nuevo Trabajo</a></li>
		    		</ul>
		    		</li>';
                }

                if (($principal == 3) or ($principal == 0)) {
                  echo ' <li><a href="' . base_url() . 'trabajos/report_diarios">Requerimientos<span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-pushpin"></span></a></li>';
                }
                if (($principal == 4) or ($principal == 0)) {
                  echo ' <li><a href="' . base_url() . 'dependencias/inicio">Dependencias<span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-home"></span></a></li>';
                }
                if (($principal == 5) or ($principal == 0)) {
                  echo ' <li><a href="' . base_url() . 'turnos/planificacion">Turnos<span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-user"></span></a></li>';
                }
              }


              ?>
              <li><a href="<?php echo base_url(); ?>reportes/inicio">Informes<span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon  glyphicon-save-file"></span></a></li>
              <li><a href="<?php echo base_url(); ?>socios/inicio">Socios<span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-wrench  Try it"></span></a> </li>
              <li><a href="<?php echo base_url(); ?>accionistas/inicio">Accionistas<span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-briefcase  Try it"></span></a> </li>
              <li><a href="<?php echo base_url(); ?>accionistas/inicio">Accionistas<span style="font-size:16px;"></span></a> </li>  
            </ul>
          </div>

        </div>
      </nav>
    </div>




    <!-- Navigation -->
    <script>
      $(document).ready(function() {
        $('.dropdown-submenu a.test').on("click", function(e) {
          $(this).next('ul').toggle();
          e.stopPropagation();
          e.preventDefault();
        });
      });
    </script>
<?php !isset($this->session->userdata['logueado'])?   die('Página con acceso restringido. <a href="'.base_url().'Login">Click aquí para hacer login</a>')   :   '';?>
	<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
   

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
    <!-- Morris Charts JavaScript -->
    <script src="<?php echo base_url(); ?>assets/js/plugins/morris/raphael.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/plugins/morris/morris.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/plugins/morris/morris-data.js"></script>
    
	  <script  src="<?php echo base_url(); ?>assets/js/plugins/jquery.dataTables.min.js"></script>
      <script  src="<?php echo base_url(); ?>assets/js/plugins/dataTables.bootstrap.min.js"></script>

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

   
</head>
<body>
<nav class="navbar navbar-default navbar-fixed-top">
      <div class="container">
      
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">STADIO ITALINO</a>
          
        </div>
        <?php
		
			 ?>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
          
           
           <?php
			//print_r( $_SESSION );  
			
		   //echo' <li><a href="'.base_url().'actividades/nueva>Actividades</a></li>';
		   
		  $this->load->library('session');
		  $usuario = $this->session->userdata('id');
		  $ci = &get_instance();
		  $ci->load->model("model_login");
		  $menu= $ci->model_login->menu_principal($usuario);
		  
		 
		 
		   foreach($menu as $m){
			   
			   $principal = $m->perm_principal;
			  
					  			if (($principal == 1) OR ($principal == 0) ){
							
							if($principal <> 0){		
						     $sub_menu= $ci->model_login->sub_menu($usuario,$principal);}
							 else{
							   $sub_menu= $ci->model_login->sub_menu(0,1);	 
								 }

									
								echo'<li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
          Actividades <b class="caret"></b></a>		
		<ul class="dropdown-menu">';
		foreach($sub_menu as $sm){
								 $perm_nombre= $sm -> perm_nombre;
								 $perm_ruta= $sm -> perm_ruta;
		
								echo' <li><a href="'.base_url().''.$perm_ruta.'">'.$perm_nombre.'</a></li>';
									}
									echo'</ul></li>';
								}
								
								if (($principal == 2) OR ($principal == 0)){
									if($principal <> 0){		
						     $sub_menu= $ci->model_login->sub_menu($usuario,$principal);}
							 else{
							   $sub_menu= $ci->model_login->sub_menu(0,2);	 
								 }
								echo'<li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
          Trabajos <b class="caret"></b></a>		
		<ul class="dropdown-menu">';
		foreach($sub_menu as $sm){
								 $perm_nombre= $sm -> perm_nombre;
								 $perm_ruta= $sm -> perm_ruta;
		
								echo' <li><a href="'.base_url().''.$perm_ruta.'">'.$perm_nombre.'</a></li>';
									}
									echo'</ul></li>';
								}
								
								
								if (($principal == 3) OR ($principal == 0)){
								echo' <li><a href="'.base_url().'trabajos/report_diarios">Requerimientos</a></li>';
								}
								
			   
			   
			   
				
			}	  
				
		   
		   
		   		   
		 /* switch ($permisos) {
		//TRABAJOS
    	case 1:
		echo'<li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
          Trabajos <b class="caret"></b></a>		
		<ul class="dropdown-menu">
		<li><a href="'.base_url().'trabajos/nuevo">Reporte de trabajos</a></li>
		<li><a href="'.base_url().'trabajos/gest_trabajos">Control de trabajos</a></li>
		<li><a href="'.base_url().'trabajos/planificacion">Planificación</a></li>
		</ul>
		</li>';
        break;
		
		// ACTIVIDADES
		case 0:
		 echo'<li><a href="'.base_url().'actividades/nueva">Actividades</a></li>';
		echo'<li><a href="'.base_url().'calendario">Calendario</a></li>';
		break;
		
		// ACTIVIDADES
		case 3:
		echo' <li><a href="'.base_url().'actividades/nueva">Actividades</a></li>';
		echo'<li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
          Trabajos <b class="caret"></b></a>		
		<ul class="dropdown-menu">
		<li><a href="'.base_url().'trabajos/nuevo">Reporte de trabajos</a></li>
		<li><a href="'.base_url().'trabajos/gest_trabajos">Control de trabajos</a></li>
		<li><a href="'.base_url().'trabajos/planificacion">Planificación</a></li>
		</ul>
		</li>';
		echo'<li><a href="'.base_url().'calendario">Calendario</a></li>';
		break;
		
		
		
		case 4:
		echo'<li><a href="'.base_url().'calendario">Calendario</a></li>';
		echo'
		
		<li><a href="'.base_url().'trabajos/gest_trabajos">Control de trabajos</a></li>
		</ul>
		</li>';
        break;
		
		
		
		
		//ADMINISTRADOR
		default:
        
		echo'';
     
		}*/
		   
		   
		    ?>
            
           
          </ul>
          
         
          <ul class="nav navbar-nav navbar-right">
          <li><a href="<?php echo base_url();?>login/logout" onClick="logout()">Cerrar sesión</a></li>
           <!-- <li><a href="../navbar/">Default</a></li>
            <li><a href="../navbar-static-top/">Static top</a></li>
            <li class="active"><a href="./">Fixed top <span class="sr-only">(current)</span></a></li>-->
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>


    <div >

        <!-- Navigation -->
       
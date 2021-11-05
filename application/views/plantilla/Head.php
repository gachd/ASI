<?php

if (!isset($this->session->userdata['logueado'])) { ?>


	<?php $this->view('errors\no_sesion'); ?>


	<?php die ?>

<?php } ?>


<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="apple-touch-icon" sizes="180x180" href="<?php echo base_url(); ?>assets/icon/apple-touch-icon.png">
	<link rel="icon" type="image/png" sizes="32x32" href="<?php echo base_url(); ?>assets/icon/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="16x16" href="<?php echo base_url(); ?>assets/icon/favicon-16x16.png">
	<link rel="manifest" href="<?php echo base_url(); ?>assets/icon/site.webmanifest">
	<link rel="mask-icon" href="<?php echo base_url(); ?>assets/icon/safari-pinned-tab.svg" color="#5bbad5">
	<meta name="msapplication-TileColor" content="#2b5797">
	<meta name="theme-color" content="#ffffff">



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



	<!-- pickerDate -->
	<script src="<?php echo base_url(); ?>assets/picker_fecha/js/picker.js"></script>
	<script src="<?php echo base_url(); ?>assets/picker_fecha/js/picker.date.js"></script>
	<script src="<?php echo base_url(); ?>assets/picker_fecha/js/legacy.js"></script>

	<link href="<?php echo base_url(); ?>assets/picker_fecha/css/default.css" rel="stylesheet">
	<link href="<?php echo base_url(); ?>assets/picker_fecha/css/default.date.css" rel="stylesheet">



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

	<!-- Alertas -->
	<script src="<?php echo base_url(); ?>/assets/js/sweetalert.min.js"></script>
	<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" rel="stylesheet" />
	<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>
	<!-- sweetalert2 -->




	<!-- new navbar -->




	<style>
		.navbar-default .navbar-nav>li>a:hover,
		.navbar-default .navbar-nav>li>a:focus {
			color: #fff;
			background-color: #8dc89e;
		}







		.ui-datepicker-header {
			background: #2c3e50;
			color: #fff;
			font-weight: bold;
			border-bottom: 1px solid #e0e0e0;
			border-radius: 3px 3px 0 0;
			padding: 10px 15px;
		}

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

			.navbar-toggle {
				display: block;
			}

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

			.navbar-toggle:active {
				background: yellow;
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



		.salto_celu {

			display: none;
		}

		input[type=file]::-webkit-file-upload-button {
			display: none;

		}

		input[type=file] {
			cursor: pointer;

		}

		ul.breadcrumb {


			padding: 10px 16px;
			list-style: none;
			background-color: #eee;
		}

		ul.breadcrumb li {
			display: inline;
			font-size: 15px;
		}

		ul.breadcrumb li+li:before {
			padding: 2px;
			color: black;
			content: "/\00a0";
		}

		ul.breadcrumb li a {
			color: #00ae00;
			text-decoration: none;
		}

		ul.breadcrumb li a:hover {
			color: #01447e;
			text-decoration: underline;
		}

		.oculto {
			display: none;
		}

		.col-center {
			float: none;
			margin: 0 auto;
		}

		.input-group {
			z-index: 0;
		}

		.input-group-btn {
			z-index: -1;
		}


		.loader {
			position: fixed;
			left: 0px;
			top: 0px;
			width: 100%;
			height: 100%;
			z-index: 9999;

			background: url('<?php echo base_url(); ?>assets/images/carga_pagina.gif') 50% 50% no-repeat rgb(249, 249, 249);
			opacity: .97;
		}


		@media only screen and (max-width: 480px) {
			
			
		}
	</style>

	<script>
		/* async function detectAdBlock() {
			let adBlockEnabled = false
			const googleAdUrl = 'https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js'
			try {
				await fetch(new Request(googleAdUrl)).catch(_ => adBlockEnabled = true)
			} catch (e) {
				adBlockEnabled = true

			} finally {

				if (adBlockEnabled) {

					alert("Desactiva adblock ");

				} else {
					alert("Muy bien adblock desbiltado ");

				}


			}
		}
		detectAdBlock() */

		var vis = (function() {
			var stateKey, eventKey, keys = {
				hidden: "visibilitychange",
				webkitHidden: "webkitvisibilitychange",
				mozHidden: "mozvisibilitychange",
				msHidden: "msvisibilitychange"
			};
			for (stateKey in keys) {
				if (stateKey in document) {
					eventKey = keys[stateKey];
					break;
				}
			}
			return function(c) {
				if (c) document.addEventListener(eventKey, c);
				return !document[stateKey];
			}
		})();






		vis(function() {

			vis() ? console.log("Visible") : console.log("No visible");
		});




		var minutos = 0;

		function listo() {

			$(".loader").fadeOut(200);

			/* 	toggleFullScreen(document.body); */
			/* TimerSesion(); */




		}



		function TimerSesion() {



			setInterval(function() {
				minutos++;
				/* 	console.log(minutos); */

				if (minutos == 8) {



					swal({
							title: "Se ha detectado inactivdad",
							text: "Se cerrara la sesion",
							icon: "warning",
							buttons: {
								cancel: "Cancelar",
								Cerrrar: true,
							},
						})
						.then((ok) => {

							if (ok) {
								window.location = '<?php echo base_url(); ?>login/logout';

							} else {
								resetTiempo()

							}

						});



				}



				if (minutos == 15) {
					window.location = '<?php echo base_url(); ?>login/logout';

				}


			}, 60000); //  cuenta cada minutos

		}

		function resetTiempo() {

			/* console.log("tiempo reseteado"); */
			minutos = 0;


		}








		$.datepicker.regional['es'] = {
			closeText: 'Cerrar',
			prevText: '< Ant',
			nextText: 'Sig >',
			currentText: 'Hoy',
			monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
			monthNamesShort: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
			dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércole xs', 'Jueves', 'Viernes', 'Sábado'],
			dayNamesShort: ['Dom', 'Lun', 'Mar', 'Mié', 'Juv', 'Vie', 'Sáb'],
			dayNamesMin: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sá'],
			weekHeader: 'Sm',
			dateFormat: 'dd/mm/yy',
			firstDay: 1,
			isRTL: false,
			showMonthAfterYear: false,
			yearSuffix: ''
		};

		$(function() {
			$.datepicker.setDefaults($.datepicker.regional['es']);
		});



		$(document).ready(function() {


			$('.tabla_dinamica').DataTable({
				"oLanguage": {
					"sProcessing": "Procesando...",
					"sLengthMenu": "Mostrar _MENU_ registros",
					"sZeroRecords": "No se encontraron resultados",
					"sEmptyTable": "Ningún dato disponible en esta tabla",
					"sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
					"sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
					"sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
					"sInfoPostFix": "",
					"sSearch": "Buscar:",
					"sUrl": "",
					"sInfoThousands": ",",
					"sLoadingRecords": "Cargando...",
					"oPaginate": {
						"sFirst": "Primero",
						"sLast": "Último",
						"sNext": "Siguiente",
						"sPrevious": "Anterior"
					},
					"oAria": {
						"sSortAscending": ": Activar para ordenar la columna de manera ascendente",
						"sSortDescending": ": Activar para ordenar la columna de manera descendente"
					}
				}
			});





		});



		function getIEVersion() {
			var match = navigator.userAgent.match(/(?:MSIE |Trident\/.*; rv:)(\d+)/);
			return match ? parseInt(match[1]) : undefined;
		}



		if (getIEVersion() <= 11) {

			alert("Navegador no compatible")
			document.location = "<?php echo base_url(); ?>login/logout"; //Es IE <= 11, REDIRECCIONA A PAGINA QUE SUGIERE USAR UNA MAYOR VERSIÓN!
		}
	</script>



</head>
<?php

$this->load->library('session');
$usuario = $this->session->userdata('id');
$ci = &get_instance();
$ci->load->model("model_login");;

?>

<body onload="listo()" onkeypress="resetTiempo()" onclick="resetTiempo()" onMouseMove="resetTiempo()" ontouchstart="resetTiempo()">
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
							<li class="dropdown">
								<a href="" class="dropdown-toggle" data-toggle="dropdown"><?php echo ($this->session->userdata('username')); ?><b class="caret"></b><span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon glyphicon-user"></span></a>
								<ul class="dropdown-menu">

									<li><a href="<?php echo base_url(); ?>login/logout">Cerrar Sesion</a></li>
								</ul>
							</li>
							<li style="text-align: center;"><img width="120" src="https://www.stadioitalianodiconcepcion.cl/ASI/assets/images/logo_instituciones.png"></li>



							<?php
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
		    		       <li class="dropdown-submenu"><a class="test"  href="">Planificacion<span class="caret"></span></a>
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




								if (($principal == 7) or ($principal == 0)) {
									echo ' <li ><a href="' . base_url() . 'socios/socios" >Socios<span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-wrench  Try it"></span></a> </li>
          <li ><a href="' . base_url() . 'accionistas/inicio" >Accionistas<span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-briefcase  Try it"></span></a> </li>';
								}
							}

							echo '<li><a href="' . base_url() . 'reportes/inicio">Informes<span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon  glyphicon-save-file"></span></a></li>';


							?>


						</ul>
					</div>

				</div>
			</nav>
		</div>
		<div class="loader"></div>




		<!-- Navigation -->
		<script>
			$(document).ready(function() {

				$('.dropdown-submenu a.test').on("click", function(e) {
					$(this).next('ul').toggle();
					e.stopPropagation();
					e.preventDefault();
				});


				$('.navbar-toggle').click(function() {
					if (screen.width > 1024) {
						var main = $('.main');
						var nav = $('nav');
						var tog = $('.navbar-toggle');
						var col = $('.navbar-collapse');
						var titulo = $('.nav-titulo');
						var margen = main.css('margin-left');
						var info_det = $('.info_det');
						if (margen != '60px') {

							col.hide();
							main.css('margin-left', '60px');
							main.css('width', 'calc(100% - 60px)');
							tog.css('padding', '10px 5px 10px 5px');
							tog.css('margin-right', '3px');
							nav.css('margin-left', '-160px');
							titulo.css('margin-left', '0px');
							info_det.css('width', '94%');
							// alert(info_det.css('width'));

						} else {
							col.show();
							main.css('margin-left', '200px');
							main.css('width', 'calc(100% - 200px)');
							nav.css('margin-left', '0px');
							info_det.css('width', '84%');

						}
					}
				});


				/* function ocultar() {
					if (screen.width > 1024) {
						var main = $('.main');
						var nav = $('nav');
						var tog = $('.navbar-toggle');
						var col = $('.navbar-collapse');
						var titulo = $('.nav-titulo');
						var margen = main.css('margin-left');

						if (margen != '60px') {

							col.hide();
							main.css('margin-left', '60px');
							main.css('width', 'calc(100% - 60px)');
							tog.css('padding', '10px 5px 10px 5px');
							tog.css('margin-right', '3px');
							nav.css('margin-left', '-160px');
							titulo.css('margin-left', '0px');


						} else {
							col.show();
							main.css('margin-left', '200px');
							main.css('width', 'calc(100% - 200px)');
							nav.css('margin-left', '0px');
							info_det.css('width', '84%');

						}
					}
				} */

				/* ocultar(); */

			});
		</script>
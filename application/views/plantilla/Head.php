<?php

if (!isset($this->session->userdata['logueado'])) { ?>

	<?php $this->view('errors/no_sesion');  ?>

	<?php die; ?>

<?php }



?>


<!DOCTYPE html>
<html lang="es">

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

	<title>ASI - Stadio Italiano di Concepcion</title>


	<!-- Bootstrap -->
	<link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet">


	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

	<!-- Bootstrap Core JavaScript -->
	<script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>


	<!-- Custom CSS -->
	<link href="<?php echo base_url(); ?>assets/css/sb-admin.css" rel="stylesheet">
	<link href="<?php echo base_url(); ?>assets/css/header/header.css" rel="stylesheet">

	<!-- Morris Charts CSS -->

	<!-- Custom Fonts -->
	<link href="<?php echo base_url(); ?>/assets/fonts/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

	<!-- datepicker-->
	<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>


	<!-- JavaScript -->
	<script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>

	<!-- CSS -->
	<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css" />


	<!-- pickerDate -->
	<script src="<?php echo base_url(); ?>assets/picker_fecha/js/picker.js"></script>
	<script src="<?php echo base_url(); ?>assets/picker_fecha/js/picker.date.js"></script>
	<script src="<?php echo base_url(); ?>assets/picker_fecha/js/legacy.js"></script>

	<link href="<?php echo base_url(); ?>assets/picker_fecha/css/default.css" rel="stylesheet">
	<link href="<?php echo base_url(); ?>assets/picker_fecha/css/default.date.css" rel="stylesheet">

	<!-- Font Awesome -->
	<!-- 	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" > -->


	<!-- 	<script src="<?php echo base_url(); ?>assets/js/plugins/jquery.dataTables.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/plugins/dataTables.bootstrap.min.js"></script> -->

	<!-- Bootstrap -->
	<link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet">
	<!-- 	<link href="<?php echo base_url(); ?>assets/css/plugins/dataTables.bootstrap.min.css" rel="stylesheet" type="text/css"> -->


	<!-- Custom CSS -->
	<link href="<?php echo base_url(); ?>assets/css/sb-admin.css" rel="stylesheet">
	<link href="<?php echo base_url(); ?>assets/css/header/header.css" rel="stylesheet">

	<!-- Morris Charts CSS -->

	<!-- Custom Fonts -->
	<link href="<?php echo base_url(); ?>/assets/fonts/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

	<!-- datepicker-->
	<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

	<!-- datatables -->

	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.css">
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css">

	<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.js"></script>
	<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
	<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/responsive/2.2.9/js/responsive.bootstrap.min.js"></script>

	<!-- 	fin datables -->
	<!-- Alertas -->
	<!-- sweetalert -->
	<script src="<?php echo base_url(); ?>/assets/js/sweetalert.min.js"></script>

	<!-- Toastr -->
	<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" rel="stylesheet" />
	<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>

	<!-- sweetalert2 -->
	<!-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> -->


	<!-- Busqueda select -->

	<script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/js/standalone/selectize.min.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/css/selectize.bootstrap3.min.css" />


	<!-- new navbar -->




	<style>
		input[type="date"]::-webkit-calendar-picker-indicator {

			background: transparent;
			color: transparent;
			cursor: pointer;
			position: absolute;
			width: 100px;

		}

		.linea_separacion {
			border-top: 1px solid #adadad;
			height: 2px;
			padding-top: 10px;
			padding-bottom: 10px;
			margin: 20px auto 0 auto;
		}

		.navbar-default .navbar-nav>li>a:hover,
		.navbar-default .navbar-nav>li>a:focus {
			color: #fff;
			background-color: #8dc89e;
		}

		.autocomplete-items {

			/*position: absolute;*/

			position: inherit;

			border: 1px solid #d4d4d4;

			border-bottom: none;

			border-top: none;

			z-index: 99;

			/*position the autocomplete items to be the same width as the container:*/

			top: 100%;

			left: 0;

			right: 0;

		}

		.autocomplete-items div {

			padding: 10px;

			cursor: pointer;

			background-color: #fff;

			border-bottom: 1px solid #d4d4d4;

		}

		.autocomplete-items div:hover {

			/*when hovering an item:*/

			background-color: #8dc89e;

		}

		.autocomplete-active {

			/*when navigating through the items using the arrow keys:*/

			background-color: #8dc89e !important;

			color: #ffffff;

		}



		/* spinner cargando... */

		.spinner {

			margin: 10px auto;
			border: 4px solid rgba(0, 0, 0, 0.1);
			width: 36px;
			height: 36px;
			border-radius: 50%;
			border-left-color: #61cc33;

			animation: spin 1s linear infinite;
		}

		@keyframes spin {
			0% {
				transform: rotate(0deg);
			}

			100% {
				transform: rotate(360deg);
			}
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
				border-top: 2px #e5e5e5 solid;

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





		input[type=file]::-webkit-file-upload-button {
			display: none;

		}

		input[type=file] {
			cursor: pointer;

		}

		nav.bradcrumb {
			position: fixed;
			top: 40px;
			width: 100%;
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

		.ir-arriba {
			display: none;
			background-repeat: no-repeat;
			font-size: 25px;
			color: black;
			cursor: pointer;
			position: fixed;
			bottom: 10px;
			right: 10px;
			z-index: 2;
		}

		@media print {

			.no-print,
			.no-print * {
				display: none !important;
			}

			.breadcrumb,
			.breadcrumb * {
				display: none !important;
			}

			.show_print {
				display: contents;
			}
		}

		
	</style>

	<script>
		/*  async function detectAdBlock() {
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
		detectAdBlock()  */


		function valida_sesion() {

			$.ajax({
				type: "GET",
				url: "<?php echo base_url(); ?>login/comprobar_sesion",
				dataType: "json",
				success: function(validacion) {

					if (validacion) {



					} else {

						window.location.href = "<?php echo base_url(); ?>";

					}

				},

			});
		}
		setInterval(valida_sesion, 30000);


		function listo() {

			$(".loader").fadeOut(200);

			let URLactual = window.location; // obtener url actual


		}

		window.onbeforeunload = function(e) { // al cambiar de pagina
			$(".loader").fadeIn(200);
		};

		spinnerHTML = ('<div class="spinner"></div>');


		spain = {
			"sProcessing": "Procesando...",
			"sLengthMenu": "Mostrar _MENU_ registros",
			"sZeroRecords": "No se encontraron resultados",
			"sEmptyTable": "Ning??n dato disponible en esta tabla",
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
				"sLast": "??ltimo",
				"sNext": "Siguiente",
				"sPrevious": "Anterior"
			},
			"oAria": {
				"sSortAscending": ": Activar para ordenar la columna de manera ascendente",
				"sSortDescending": ": Activar para ordenar la columna de manera descendente"
			}
		};


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
			dayNames: ['Domingo', 'Lunes', 'Martes', 'Mi??rcole xs', 'Jueves', 'Viernes', 'S??bado'],
			dayNamesShort: ['Dom', 'Lun', 'Mar', 'Mi??', 'Juv', 'Vie', 'S??b'],
			dayNamesMin: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'S??'],
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

			irArriba();





			$('.tabla_dinamica').DataTable({
				"oLanguage": {
					"sProcessing": "Procesando...",
					"sLengthMenu": "Mostrar _MENU_ registros",
					"sZeroRecords": "No se encontraron resultados",
					"sEmptyTable": "Ning??n dato disponible en esta tabla",
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
						"sLast": "??ltimo",
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



		function irArriba() {
			$('.ir-arriba').click(function() {
				$('body,html').animate({
					scrollTop: '0px'
				}, 500);
			});
			$(window).scroll(function() {
				if ($(this).scrollTop() > 0) {
					$('.ir-arriba').slideDown(300);
				} else {
					$('.ir-arriba').slideUp(300);
				}
			});
			$('.ir-abajo').click(function() {
				$('body,html').animate({
					scrollTop: '1000px'
				}, 1000);
			});
		}



		function getIEVersion() {
			var match = navigator.userAgent.match(/(?:MSIE |Trident\/.*; rv:)(\d+)/);
			return match ? parseInt(match[1]) : undefined;
		}



		if (getIEVersion() <= 11) {

			alert("Navegador no compatible")
			document.location = "<?php echo base_url(); ?>login/logout"; //Es IE <= 11, REDIRECCIONA A PAGINA QUE SUGIERE USAR UNA MAYOR VERSI??N!
		}
	</script>



</head>
<?php

$this->load->library('session');
$useraaa = $_SESSION;
$usuario = $this->session->userdata('id');
$ci = &get_instance();
$ci->load->model("model_login");;

?>
<a class="ir-arriba no-print" javascript:void(0) title="Volver arriba">
	<span class="fa-stack">
		<i class="fa fa-circle fa-stack-2x"></i>
		<i class="fa fa-arrow-up fa-stack-1x fa-inverse"></i>
	</span>
</a>

<body onload="listo()" onkeypress="resetTiempo()" onclick="resetTiempo()" onMouseMove="resetTiempo()" ontouchstart="resetTiempo()">
	<div id="wrapper">
		<div class="cont-sidebar" id="contenido-sidebar">
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

							<li id="logo_sidebar" style="text-align: center;"><img width="120" src="https://www.stadioitalianodiconcepcion.cl/ASI/assets/images/logo_instituciones.png"></li>



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




								if (($principal == 6) or ($principal == 0)) {
									echo ' <li ><a href="' . base_url() . 'socios/inicio" >Socios<span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-wrench  Try it"></span></a> </li>';
								}
								if (($principal == 7) or ($principal == 0)) {
									echo ' <li ><a href="' . base_url() . 'accionistas/inicio" >Accionistas<span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-briefcase  Try it"></span></a> </li>';
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
			sidebar_posicion($(window).width());

			$(window).resize(function() {

				let ancho = $(this).width();

				sidebar_posicion(ancho);

			});

			function sidebar_posicion(ancho) {

				if (ancho < 768) {

					/* 	console.log("menos 768"); */
					$("#contenido-sidebar").removeClass("cont-sidebar");
					$("#logo_sidebar").css("display", "none");

				} else {
					$("#contenido-sidebar").addClass("cont-sidebar");
					$("#logo_sidebar").css("display", "block");
				}

			}



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
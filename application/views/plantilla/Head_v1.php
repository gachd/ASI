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



	<script src="<?php echo base_url(); ?>assets/js/jquery.min.js"></script>



	<!-- Bootstrap Core JavaScript -->
	<script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>




	<!-- pickerDate -->
	<script src="<?php echo base_url(); ?>assets/picker_fecha/js/picker.js"></script>
	<script src="<?php echo base_url(); ?>assets/picker_fecha/js/picker.date.js"></script>
	<script src="<?php echo base_url(); ?>assets/picker_fecha/js/legacy.js"></script>

	<link href="<?php echo base_url(); ?>assets/picker_fecha/css/default.css" rel="stylesheet">
	<link href="<?php echo base_url(); ?>assets/picker_fecha/css/default.date.css" rel="stylesheet">

	<!-- JqueryDataTable -->


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





	<style>

		.dropdown-submenu {
			position: relative;
		}

		.dropdown-submenu>.dropdown-menu {
			top: 0;
			left: 100%;
			margin-top: -6px;
			margin-left: -1px;
			-webkit-border-radius: 0 6px 6px 6px;
			-moz-border-radius: 0 6px 6px 6px;
			border-radius: 0 6px 6px 6px;
		}

		.dropdown-submenu:hover>.dropdown-menu {
			display: block;
		}

		.dropdown-submenu>a:after {
			display: block;
			content: " ";
			float: right;
			width: 0;
			height: 0;
			border-color: transparent;
			border-style: solid;
			border-width: 5px 0 5px 5px;
			border-left-color: #cccccc;
			margin-top: 5px;
			margin-right: -10px;
		}

		.dropdown-submenu:hover>a:after {
			border-left-color: #ffffff;
		}

		.dropdown-submenu.pull-left {
			float: none;
		}

		.dropdown-submenu.pull-left>.dropdown-menu {
			left: -100%;
			margin-left: 10px;
			-webkit-border-radius: 6px 0 6px 6px;
			-moz-border-radius: 6px 0 6px 6px;
			border-radius: 6px 0 6px 6px;
		}

		@media only screen and (min-width: 0px) and (max-width: 768px) {


			nav#navbar_Home {
				position: sticky;
				display: block;
				z-index: 10000;
			}

			div#ui-datepicker-div {

				width: 60%;
				height: auto;
			}

			.salto_linea {

				display: none;
			}

			.salto_celu {

				display: block !important;
			}


		}

		.salto_celu {

			display: none;
		}

		div#ui-datepicker-div {
			z-index: 99999;


		}

		html,
		body {
			background: white;

		}




		.div-wrapper {
			display: block;
			overflow-x: auto;
			white-space: nowrap;


		}





		div.fixeded {

			position: fixed;
			border-radius: 5px;
			width: auto;
			padding-bottom: 3px;
			align-content: center;
			text-align: center;
			box-shadow: 2px 2px 2px 2px #c0c0c0;
			z-index: 0;


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
			TimerSesion();




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



		function getIEVersion() {
			var match = navigator.userAgent.match(/(?:MSIE |Trident\/.*; rv:)(\d+)/);
			return match ? parseInt(match[1]) : undefined;
		}



		if (getIEVersion() <= 11) {

			alert("Navegador no compatible")
			document.location = "<?php echo base_url(); ?>login/logout"; //Es IE <= 9, REDIRECCIONA A PAGINA QUE SUGIERE USAR UNA MAYOR VERSI??N!
		}
	</script>



</head>

<body onload="listo()" onkeypress="resetTiempo()" onclick="resetTiempo()" onMouseMove="resetTiempo()" ontouchstart="resetTiempo()">

	<div id="pickerFecha"></div>
	
	<nav class="navbar navbar-default navbar-fixed-top" id="navbar_Home">
		<div class="container">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>



				<a class="navbar-brand" href="<?php echo base_url(); ?>"><img width="40" src="<?php echo base_url(); ?>assets/logo.svg"></a>

			</div>
			<?php

			?>
			<div id="navbar" class="navbar-collapse collapse">
				<ul class="nav navbar-nav">


					<?php


					$this->load->library('session');
					$usuario = $this->session->userdata('id');
					$ci = &get_instance();
					$ci->load->model("model_login");
					$menu = $ci->model_login->menu_principal($usuario);

					?>


					<?php foreach ($menu as $m) {

						$principal = $m->perm_principal; ?>





						<?php if (($principal == 1) or ($principal == 0)) { ?>

							<?php if ($principal <> 0) {
								$sub_menu = $ci->model_login->sub_menu($usuario, $principal);
							} else {
								$sub_menu = $ci->model_login->sub_menu(0, 1);
							}
							?>


							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown">Actividades <b class="caret"></b><span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-calendar"></span></a>
								<ul class="dropdown-menu">

									<?php


									foreach ($sub_menu as $sm) {
										$perm_nombre = $sm->perm_nombre;
										$perm_ruta = $sm->perm_ruta;
										echo ' <li><a href="' . base_url() . '' . $perm_ruta . '">' . $perm_nombre . '</a></li>';
										echo ' <li class="divider"></li>';
									}

									?>


								</ul>
							</li>



						<?php } ?>

						<?php
						//TRABAJOS

						if (($principal == 2) or ($principal == 0)) {
							echo '<li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">Trabajos <b class="caret"></b><span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-wrench	Try it"></span></a>
<ul class="dropdown-menu">
<li class=class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"  href="">Planificaion<span class="caret"></span></a>
<ul class="dropdown-submenu">
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










						?>










						<?php if (($principal == 7) or ($principal == 0)) { ?>



							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown">Accionista<b class="caret"></b></a>
								<ul class="dropdown-menu">

									<li><a href="<?php echo base_url() ?>accionistas/inicio">Inicio</a></li>
									<li><a href="<?php echo base_url() ?>accionistas/titulos">Titulos</a></li>


								</ul>
							</li>
							<?php  ?>


							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown">Socios<b class="caret"></b></a>
								<ul class="dropdown-menu">


									<li><a href="<?php echo base_url() ?>socios/inicio">Inicio</a></li>

									<li><a href="<?php echo base_url() ?>socios/InformesSocio">Informes</a></li>

								</ul>


							</li>

						<?php } ?>

					<?php }  ?>


				</ul>



				<ul class=" nav navbar-nav navbar-right">


					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">
							<?php echo ($this->session->userdata('username')); ?> <b class="caret"></b></a>
						<ul class="dropdown-menu">
							<li><a href="<?php echo base_url(); ?>login/logout" onClick="logout()">Cerrar sesi??n</a></li>

						</ul>
					</li>



				</ul>
			</div>

		</div>
	</nav>

	<div class="loader"></div>



</body>


</html>



<!-- Navigation -->
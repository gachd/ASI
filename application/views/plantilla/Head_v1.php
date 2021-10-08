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
			color: #0275d8;
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
		var minutos = 0;

		function listo() {

			$(".loader").fadeOut(200);

			/* 	toggleFullScreen(document.body); */
			timerSesion();




		}



		function timerSesion() {



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
			document.location = "<?php echo base_url(); ?>login/logout"; //Es IE <= 9, REDIRECCIONA A PAGINA QUE SUGIERE USAR UNA MAYOR VERSIÓN!
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
							<li><a href="<?php echo base_url(); ?>login/logout" onClick="logout()">Cerrar sesión</a></li>

						</ul>
					</li>



				</ul>
			</div>

		</div>
	</nav>

	<div class="loader"></div>


</body>

<script>
	function toggleFullScreen(elem) {
		if ((document.fullScreenElement !== undefined && document.fullScreenElement === null) || (document.msFullscreenElement !== undefined && document.msFullscreenElement === null) || (document.mozFullScreen !== undefined && !document.mozFullScreen) || (document.webkitIsFullScreen !== undefined && !document.webkitIsFullScreen)) {
			if (elem.requestFullScreen) {
				elem.requestFullScreen();
			} else if (elem.mozRequestFullScreen) {
				elem.mozRequestFullScreen();
			} else if (elem.webkitRequestFullScreen) {
				elem.webkitRequestFullScreen(Element.ALLOW_KEYBOARD_INPUT);
			} else if (elem.msRequestFullscreen) {
				elem.msRequestFullscreen();
			}
		} else {
			if (document.cancelFullScreen) {
				document.cancelFullScreen();
			} else if (document.mozCancelFullScreen) {
				document.mozCancelFullScreen();
			} else if (document.webkitCancelFullScreen) {
				document.webkitCancelFullScreen();
			} else if (document.msExitFullscreen) {
				document.msExitFullscreen();
			}
		}
	}
</script>

</html>



<!-- Navigation -->
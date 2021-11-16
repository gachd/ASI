<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Calendario</title>

	<head>

		<style>
			body {
				/* margin: 40px 10px; */
				padding: 0;
				/* font-family: "Lucida Grande", Helvetica, Arial, Verdana, sans-serif;
			font-size: 14px; */
			}

			#calendar {
				max-width: 100%;
				margin-top: 5px;
				/*margin: 0 auto;*/
			}

			.categoria {
				width: 20px;
				float: left;
			}

			.text-categoria {
				margin-left: 10px;
			}

			.fc-center h2 {
				text-transform: uppercase;
			}
		</style>
	</head>

<body>



	<?php $this->load->view('actividades/content_actividad', $data); ?>

	<div class="main">
		<nav class="navbar navbar-default nav-titulo">
			<div class="col-md-3">
				<h1 style="text-align:center;">Actividades Coorporaciones</h1>
			</div>
			<div class="padre buscador1">
				<div class="hijo">
					<div class="col-md-3">
						<div style="background:#064b70;" class="categoria">&nbsp;</div><span class="text-categoria">Scuola</span>
					</div>
					<div class="col-md-3">
						<div style="background:#4b7006;" class="categoria">&nbsp;</div><span class="text-categoria"> Stadio</span>
					</div>
					<div class="col-md-3">
						<div style="background:#702b06;" class="categoria">&nbsp;</div><span class="text-categoria"> Concesionario</span>
					</div>
					<div class="col-md-3">
						<div style="background:#00ddff;" class="categoria">&nbsp;</div><span class="text-categoria"> Instituto</span>
					</div>

				</div>
			</div>
			<div class="col-md-4" style="padding-top: 15px;">
				<div class="btn-group">
					<button type="button" class="btn-nuevo btn btn-default" id="nuevo" title="Nueva Actividad"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Nueva actividad</button>

					<!--<button type="button" class="btn btn-default" id="buscar_rango" title="Imprimir día"><span class="glyphicon glyphicon-print" aria-hidden="true"></span></button>-->
				</div>
			</div>
			<div class="padre buscador2">
				<div class="hijo">
					<div class="col-md-3">
						<div style="background:red;" class="categoria">&nbsp;</div><span class="text-categoria"> Suspendida</span>
					</div>
				</div>
			</div>
		</nav>

		<div class="col-md-12" style="background: white;padding: 15px;">
			<div id='calendar'></div>
		</div>
	</div>

	<!--fin .wrapper y content -->
	</div>

	</div>

</body>
<meta charset='utf-8' />
<link href='<?php echo base_url(); ?>assets/js/plugins/fullcalendar-3.5.1/fullcalendar.min.css' rel='stylesheet' />
<link href='<?php echo base_url(); ?>assets/js/plugins/fullcalendar-3.5.1/fullcalendar.print.min.css' rel='stylesheet' media='print' />
<script src='<?php echo base_url(); ?>assets/js/plugins/fullcalendar-3.5.1/lib/moment.min.js'></script>
<script src='<?php echo base_url(); ?>assets/js/plugins/fullcalendar-3.5.1/lib/jquery.min.js'></script>
<script src='<?php echo base_url(); ?>assets/js/plugins/fullcalendar-3.5.1/fullcalendar.min.js'></script>
<script src='<?php echo base_url(); ?>assets/js/plugins/fullcalendar-3.5.1/locale/es.js'></script>
<script>
	$(document).ready(function() {

		$('#calendar').append(
			'<div class="center-block" >' +
			'<img src="<?php echo base_url(); ?>assets/img/loader.gif" alt="">' +
			'</div>');



		$.post('<?php echo base_url(); ?>actividades/calendario/getactivity',
			function(data) {
				//alert (data);
				//var datos = JSON.parse(data);
				// var estado= datos[0].id;
				// alert(estado);


				$('#calendar').empty();

				$('#calendar').fullCalendar({
					header: {
						left: 'prev,next today',
						center: 'title',
						right: 'agendaDay,agendaWeek,month'
					},

					defaultDate: new Date(),
					editable: false,
					timeFormat: 'H:mm',
					eventLimit: true,

					dayClick: function(date, jsEvent, view) {

						alert(date.format());

						dia = date.format();
						/*$.post( "<?php //echo base_url();
									?>actividades/nueva/", { fcha: dia} );*/

						window.location = "<?php echo base_url(); ?>actividades/nueva/selectcalendar/" + date.format();
						// change the day's background color just for fun
						// $(this).css('background-color', 'red');


					},
					events: $.parseJSON(data),

					eventRender: function(events, element) {

						if (events.estado == 1) {
							element.css('background', 'red');
							//  console.log('entrooo');
							//$('.fc-content').css("text-decoration-line", "line-through");
						}

						console.log(events);
					}


					// allow "more" link when too many events



				});

			});



	});
</script>

</html>
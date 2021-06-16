<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">s
	<title>Agenda Contactos</title>
	 <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">	
	  <!-- jvectormap -->
	  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/complemento/css/jquery-jvectormap.css">

	  <!-- Theme style -->
	  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/complemento/css/AdminLTE.min.css">
	  <!-- AdminLTE Skins. Choose a skin from the css/skins
	       folder instead of downloading all of them to reduce the load. -->
	   <link href="<?php echo base_url(); ?>/assets/vendors/datatables/dataTables.bootstrap.css" rel="stylesheet" media="screen">
	  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<style type="text/css">
	.menu h1{
		font-size: 16px;
		font-weight: bold;
	}
	#correo {
		text-transform: uppercase;
	}
	#example span{
		font-size: 14px;
		color:white;
	}
	span a{
		color: white;
	}
	span a:hover{
		color:white;
	}
	tbody td{
		text-align: center;
	}

</style>
<body>
	<div class="main">
		<section class="content">			 
		   <div class="menu row well">
		   	 <div class="content-box-large">
                <div class="col-md-3">			  	 	
			  	 	  <h1>Agenda Socios</h1>
			  	</div>
			    
		    <div class="col-md-9">
	            <div class="btn-group" style="float: right;">
	              <button type="button" class="btn btn-primary" id="menuprincipal"><span class="badge"><i class="glyphicon glyphicon-home"></i> Menú <br> Principal</span></button>
	              <button type="button" class="btn btn-danger" id="menupagos"><span class="badge"><i class="glyphicon glyphicon-usd"></i>Menú <br> Pagos</span></button>
	              <button type="button" class="btn btn-warning" id="gestionsocios"><span class="badge"><i class="glyphicon glyphicon-lock"></i>Gestión <br> Socios</span></button>
	              <button type="button" class="btn btn-success" id="dato_pagos"><span class="badge"><i class="glyphicon glyphicon-signal"></i>Datos <br> Socios</span></button>
	              <button type="button" class="btn btn-info" id="agenda"><span class="badge"><i class="glyphicon glyphicon-envelope"></i>Agenda <br> Socios</span></button>
	          </div>
	       </div>
	     </div>
	 </div>


			<div class="row" id="mostrarSocios">
		        <div class="col-md-12">
		          <div class="content-box-large">  
		            <div class="panel-body">
		              <div class="table-responsive">
		                <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example">
		                  <thead>
		                    <tr>                      
		                      <th>Apellido Paterno</th>
		                      <th>Apellido Materno</th>
		                      <th>Nombres</th>
		                      <th>Email</th>
		                      <th>Celular</th>                      
		                    </tr>
		                  </thead>
		                  <tbody> 
		                  
		                  </tbody>
		                </table>
		              </div>
		            </div>
		          </div>
		        </div>
		      </div>

		</section>		
	</div>
	<link href="<?php echo base_url(); ?>/assets/vendors/datatables/dataTables.bootstrap.css" rel="stylesheet" media="screen">
  <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
  <script src="https://code.jquery.com/jquery.js"></script>
  <!-- jQuery UI -->
  <script src="https://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
  <!-- Include all compiled plugins (below), or include individual files as needed -->
  <script src="<?php echo base_url(); ?>/assets/vendors/datatables/js/jquery.dataTables.min.js"></script>
  <script src="<?php echo base_url(); ?>/assets/vendors/datatables/dataTables.bootstrap.js"></script>
  <script src="<?php echo base_url(); ?>/assets/js/custom.js"></script>
 
  
 
</body>
<script type="text/javascript">
	$("#menuprincipal").click(function() {
    window.location.href = "<?php echo base_url(); ?>socios/inicio";
  });
  $("#menupagos").click(function() {
    window.location.href = "<?php echo base_url(); ?>socios/pago_cuota";
  });
  $("#dLabel").click(function() {
    window.location.href = "<?php echo base_url(); ?>socios/mod_cumple";
  });
  $("#gestionsocios").click(function() {
    window.location.href = "<?php echo base_url(); ?>socios/gestionsocios";
  });
  $("#dato_pagos").click(function() {
    window.location.href = "<?php echo base_url(); ?>socios/dashboard";
}); 
 $("#agenda").click(function() {
    window.location.href = "<?php echo base_url(); ?>socios/agenda";
}); 


$(document).ready(function() {	      
     $('#example').dataTable( {	
		"bDeferRender": true,				
		"ajax": {
			"url": '<?php echo base_url() ?>socios/agenda/mostrarActivos',
        	"type": "POST",
        	 succes: function(data){
               console.log(data);
            }

		},	
		"data":'response',				
		"columns": [
			{ "data": "paterno" },
			{ "data": "materno" },
			{ "data": "nombres" },
			{ "data": "email" },
			{ "data": "fono" }			
			]
	});
	



   

});

	

</script>
</html>
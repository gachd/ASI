<head>
  <title>Subir Excel</title>

</head>

<style type="text/css">
  #highlight-table {
    font-size: 10px;
    font-family: monospace;
    text-transform: uppercase;
  }

  .fecha {
    padding: 3px;
    text-align: center;
  }

  .cab_mes {
    padding: 3px;
    text-align: center;
    font-size: 13px;
  }

  .td_sigla {
    padding-left: 9px;
    padding-bottom: 5px;
  }

  .hijo {
    padding-right: 5px;
  }

  #informes {
    position: absolute;
    /*top: 80px;*/
    background: #fff;
    text-transform: uppercase;
  }

  .contenido {
    padding-top: 15px;
  }

  .filtro {
    float: left;
    max-width: 50%;
    margin-left: 5px;
  }

  #year,
  #mes {
    display: none;
  }
</style>
<div class="main">
  <nav class="navbar navbar-default nav-titulo">
    <div class="col-md-2">
      <h1 style="text-align:center;">Subida EXCEL</h1>
    </div>
    <div class="col-md-4">

      <!-- tipo informe -->
      <div class="">
        <label>Excel</label>
        <input type="file" class="form-control" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" name="excelFile" id="excelFileID">
      </div>



    </div>
    <div class="col-md-1">
      <a href="javascript: void(0)" title="Exportar Excel" id="btn_excel" class="descargar btn btn-sm btn-warning"><span class="glyphicon glyphicon-circle-arrow-down"></span> Subir Excel</a>
    </div>

  </nav>

  <div class="col-md-12" id="resultado_excel">
   


  </div>
</div>

<script type="text/javascript">
  $("#btn_excel").click(function() {

    archivo = document.getElementById('excelFileID').files[0];

    if (archivo) {

      $("#resultado_excel").empty();
      $("#resultado_excel").append('<div class="center-block" style="text-align:center" ><img src="<?php echo base_url(); ?>assets/img/loader.gif" alt=""></div>');



      data = new FormData();
      data.append('excel', archivo);


      $.ajax({

        cache: false,

        type: "POST",

        data: data,

        contentType: false,

        dataType: "json",

        processData: false,

        url: "<?php echo base_url() ?>socios/pago_cuota/leer_excel",

        success: function(data) {
          console.log(data);
          var html = '';



          var excel = data['excel'];

          var nombre = data['Nombre_institucion'];

          var rut = data['Rut_institucion'];

          var saltos = data['saltos'];

          var personas = data['personas'];


          console.log(saltos);
          console.log(personas);





          html += '<h2>' + nombre + ' ' + rut + '</h2>'

          html += '<table  class=" table table-hover table-bordered" >';

          html += '<thead>';
          html += '<tr>';


          html += '<th>Indice</th>';
          html += '<th>Rut</th>';
          html += '<th>Nombre</th>';
          html += '<th>Debe</th>';
          html += '<th>Haber</th>';
          html += '<th>Saldo</th>';


          html += '</tr>';
          html += '</thead>';


          html += '<tbody>';






          Object.keys(personas).forEach(function(indice) {

            html += '<tr>';

            html += '<td>' + indice + '</td>';
            html += '<td>' + personas[indice]["rut"] + '</td>';
            html += '<td>' + personas[indice]["nombre"] + '</td>';
            html += '<td>' + personas[indice]["debe"] + '</td>';
            html += '<td>' + personas[indice]["haber"] + '</td>';
            html += '<td>' + personas[indice]["saldo"] + '</td>';

            html += '</tr>';
          })



          html += '</tbody>';
          html += '</table>';







          $("#resultado_excel").empty();

          $("#resultado_excel").append(html);







        },

        error: function() {
          alert('Ocurrio un error en el servidor ..');
          $("#resultado_excel").empty();

        }




      });




    } else {

      swal("Ingrese archivo", "", "warning");
    }



  });
</script>
<!DOCTYPE html>

<html lang="en">

<head>

  <meta charset="UTF-8">

  <title>Document</title>

  <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.js"></script>

  <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/chartJS/Chart.min.js"></script>

  <script src="https://code.highcharts.com/highcharts.js"></script>

  <script src="https://code.highcharts.com/modules/exporting.js"></script>

  <script src="https://code.highcharts.com/modules/export-data.js"></script>

  <style type="text/css">
    #detalle h1 {

      text-align: center;



    }

    #tableID {

      width: 100%;

      margin: auto;

    }
  </style>

</head>

<body>

  <div class="main">

    <div class="container-fluid">

      <div class="well">

        <div class="row panel">

          <div class="caja col-md-4">

            <label>Tipo de Persona</label>

            <div class="form-group form-check">

              <label class="form-check-label">

                <input type="radio" class="form-check-input" value="1" name="tipo" id="tipo">Socios

              </label>

            </div>

            <div class="form-group form-check">

              <label class="form-check-label">

                <input type="radio" class="form-check-input" value="2" name="tipo" id="tipo">Cargas

              </label>

            </div>



          </div>

          <div class="col-md-4">

            <label>Tipo de Gráfico</label>

            <div class="form-group form-check">

              <label class="form-check-label">

                <input type="radio" class="form-check-input" value="1" name="tipoGraf" id="tipoGraf">Edades/Género

              </label>

            </div>

            <div class="form-group form-check">

              <label class="form-check-label">

                <input type="radio" class="form-check-input" value="2" name="tipoGraf" id="tipoGraf">Género

              </label>

            </div>

            <div class="form-group form-check" style="display: none;" id="clasif">

              <label class="form-check-label">

                <input type="radio" class="form-check-input" value="3" name="tipoGraf" id="tipoSocios">Clasificación

              </label>

            </div>


          </div>

          <div class="col-md-4">

            <div id="genero1" style="display: none;">

              <label>Genero</label>

              <select id="genero" class="form-control">

                <option value="1" selected>Seleccionar</option>

                <option value="2">Ambos</option>

                <option value="3">Hombres</option>

                <option value="4">Mujeres</option>

              </select>

            </div>
            <div id="tipSocio" style="display: none;">

              <label>Clasificación Socio </label>

              <div class="form-group form-check">

                <label class="form-check-label">

                  <input type="radio" class="form-check-input" value="1" name="tip_Socio" id="tip_Socio">Tipo

                </label>

              </div>

              <div class="form-group form-check">

                <label class="form-check-label">

                  <input type="radio" class="form-check-input" value="2" name="tip_Socio" id="tip_Socio">Condición

                </label>

              </div>

              <div class="form-group form-check">

                <label class="form-check-label">

                  <input type="radio" class="form-check-input" value="3" name="tip_Socio" id="tip_Socio">Condición 2

                </label>

              </div>

            </div>

          </div>

        </div>

        <div class="well row">

          <div class="resultados">

            <div class="col-md-6">

              <div id="grafico2"></div>

            </div>

            <div class="panel col-md-6">

              <div id="detalle" style="display: none" class="table-responsive">

                <h1>Detalle</h1>

              </div>



            </div>



          </div>

        </div>



      </div>

    </div>

</body>

</html>

<script type="text/javascript">
  function detalleGrafico(cat) {

    var gen = document.getElementById("genero").value;

    var tipo = $('input:radio[name=tipo]:checked').val();

    var tipoGraf = $('input:radio[name=tipoGraf]:checked').val();


    if (tipoGraf == 1) {

      var paso = cat.split('-');

      var año1 = paso[0].split('[');

      var año2 = paso[1].split(']');

      var desde = parseInt(año1[1]);

      var hasta = parseInt(año2[0]);

      data = {
        'desde': desde,
        'hasta': hasta,
        'gen': gen,
        'tipo': tipo
      };



    }

    if (tipoGraf == 2) {

      if (cat == 'Masculino') {

        genero = 1;

      } else {

        genero = 0;

      }



      data = {
        'genero': genero,
        'tipo': tipo
      };



    }

    if (tipoGraf == 3) {
      var tip_Socio = $('input:radio[name=tip_Socio]:checked').val();

      if (tip_Socio == 1) {

        if (cat == 'Honorario') {

          var tipSoc = 2;

        }

        if (cat == 'Ausente') {

          var tipSoc = 4;

        }

        if (cat == 'Activo') {

          var tipSoc = 1;

        }

        if (cat == 'Empresa') {

          var tipSoc = 5;

        }

      }
      if (tip_Socio == 2) {
        if (cat == 'RENUNCIA') {
          var tipSoc = 1;
        }
        if (cat == 'FALLECIDO') {
          var tipSoc = 2;
        }
        if (cat == 'EXPULSIÓN') {
          var tipSoc = 3;
        }
        if (cat == 'NINGUNA') {
          var tipSoc = 4;
        }
      }
      if (tip_Socio == 3) {
        if (cat == 'MOROSIDAD') {
          var tipSoc = 1;
        }
        if (cat == 'PERNICIOSO') {
          var tipSoc = 2;
        }
        if (cat == 'SUSPENSIÓN') {
          var tipSoc = 3;
        }
        if (cat == 'NINGUNA') {
          var tipSoc = 4;
        }
      }

      data = {
        'tipo': tipoGraf,
        'tipSoc': tipSoc,
        'tipoSocio': tip_Socio
      };

    }


    $.ajax({

      type: 'POST',

      url: '<?php echo base_url() ?>socios/Graficoedad/detalle',

      data: data,

      dataType: 'json',

      success: function(data) {



        var tipoGraf = $('input:radio[name=tipoGraf]:checked').val();

        $('#tableID').remove();



        $('#detalle').css('display', 'block');

        $("#detalle").append($('<table>').attr({
          id: 'tableID',
          class: 'table table-bordered table-striped'
        }));

        for (var i = 0; i < data.length; i++) {

          var j = parseInt(i) + 1;

          if (tipoGraf == 1) {

            var tr = '<tr><td>' + j + '</td><td>' + data[i][0] + '</td><td>' + data[i][1] + '</td><td>' + data[i][2] + '</td> <td>' + data[i][3] + '</td><td>' + data[i][4] + '</td></tr>';

          }

          if (tipoGraf == 2) {

            var tr = '<tr><td>' + j + '</td><td>' + data[i][0] + '</td><td>' + data[i][1] + '</td><td>' + data[i][2] + '</td> <td>' + data[i][3] + '</td></tr>';

          }

          if (tipoGraf == 3) {

            var tr = '<tr><td>' + j + '</td><td>' + data[i][0] + '</td><td>' + data[i][1] + '</td><td>' + data[i][2] + '</td> <td>' + data[i][3] + '</td></tr>';

          }



          $("#tableID").append(tr)

        }







        //var nombre = data[0];

      }

    });
    

  };




  var chart1;

  var titulo;







  jQuery(document).ready(function() {

    var options = {

      chart: {

        plotBackgroundColor: null,

        plotBorderWidth: null,

        plotShadow: false,

        type: 'pie',

        renderTo: 'grafico2'



      },

      title: {

        text: 'Número de Socios por Edades'

      },

      tooltip: {

        //pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'

      },

      plotOptions: {

        pie: {

          allowPointSelect: true,

          point: {

            events: {

              click: function() {

                // alert('value: ' + this.name);

                detalleGrafico(this.name);



              }

            }

          },

          cursor: 'pointer',

          dataLabels: {

            enabled: true,

            //format: '<b>{point.name}</b>: {point.percentage:.1f} %',

            format: '<b>{point.name}</b>: {point.y}',

            style: {

              color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'

            }

          },



          showInLegend: true

        }

      },

      series: [{}]

    };



    $('#leyendaCarga').hide();

    $('#leyenda').hide();





    $('input[name=tipo]').change(function() {

      $('#tableID').remove();

      var tipo = $('input:radio[name=tipo]:checked').val()

      $("input:radio[name=tipoGraf]").removeAttr("checked");

      document.getElementById("genero").value = 1;

      if (tipo == 1) {
        $('#clasif').css('display', 'block');
      } else {
        $('#clasif').css('display', 'none');
      }



      $('input[name=tipoGraf]').change(function() {


        var tipoGraf = $('input:radio[name=tipoGraf]:checked').val();



        if (tipoGraf == 3) {
          $('#tipSocio').css('display', 'block');
          $('input[name=tip_Socio]').change(function() {

            var tipoSocio = $('input:radio[name=tip_Socio]:checked').val();
            $('#tableID').remove();

            gen = 0;

            $.ajax({

              type: 'POST',

              url: '<?php echo base_url() ?>socios/Graficoedad/procesar',

              data: {
                'tipo': tipoSocio,
                'gen': gen,
                'tipoGraf': tipoGraf
              },

              dataType: 'json',

              success: function(data) {



                options.series[0].data = data;

                var chart = new Highcharts.Chart(options);

                var tp = $('input:radio[name=tipo]:checked').val();

                var tg = $('input:radio[name=tipoGraf]:checked').val();

                if (tp == 1) {

                  chart.setTitle({
                    text: 'Clasificación de Socios'
                  });

                  // console.log(data);

                }

              } //fin success

            });

          });
        }



        if (tipoGraf == 2) {
          $('#tipSocio').css('display', 'none');
          gen = 0;

          $.ajax({

            type: 'POST',

            url: '<?php echo base_url() ?>socios/Graficoedad/procesar',

            data: {
              'tipo': tipo,
              'gen': gen,
              'tipoGraf': tipoGraf
            },

            dataType: 'json',

            success: function(data) {



              options.series[0].data = data;

              var chart = new Highcharts.Chart(options);

              var tp = $('input:radio[name=tipo]:checked').val();

              var tg = $('input:radio[name=tipoGraf]:checked').val();

              if (tp == 1) {

                chart.setTitle({
                  text: 'Número de Socios por Género'
                });

                // console.log(data);

              }

              if (tp == 2) {

                chart.setTitle({
                  text: 'Número de Cargas por Género'
                });

                // console.log(data);

              }







              // chart1.series[1].setData(data.series_data[1]);



            } //fin success

          });



        }



        if (tipoGraf == 1) {



          $('#genero1').css('display', 'block');
          $('#tipSocio').css('display', 'none');


          $('#genero').change(function() {

            var tipo = $('input:radio[name=tipo]:checked').val();

            var tipoGraf = $('input:radio[name=tipoGraf]:checked').val();

            var gen = document.getElementById("genero").value;

            $('#tableID').remove();







            $.ajax({

              type: 'POST',

              url: '<?php echo base_url() ?>socios/Graficoedad/procesar',

              data: {
                'tipo': tipo,
                'gen': gen,
                'tipoGraf': tipoGraf
              },

              dataType: 'json',

              success: function(data) {



                options.series[0].data = data;

                var chart = new Highcharts.Chart(options);

                var tp = $('input:radio[name=tipo]:checked').val();

                var tg = $('input:radio[name=tipoGraf]:checked').val();

                if (tp == 2 & tg == 1) {

                  chart.setTitle({
                    text: 'Número de Cargas por Edades'
                  });

                  // console.log(data);



                }

              } //fin success

            });





          });

        } else {

          $('#genero1').css('display', 'none');

          document.getElementById("genero").value = 1;

        }

      });

    });



  });
</script>
<script src='<?php echo base_url(); ?>assets/js/plugins/Chart.js/2.7.0/Chart.js'></script>
<script src='<?php echo base_url(); ?>assets/js/plugins/Chart.js/2.7.0/Chart.bundle.js'></script>



<script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/angular-morris/1.3.0/angular-morris.min.js"></script>
<link href='<?php echo base_url(); ?>assets/js/plugins/fullcalendar-3.5.1/fullcalendar.min.css' rel='stylesheet' />
<link href='<?php echo base_url(); ?>assets/js/plugins/fullcalendar-3.5.1/fullcalendar.print.min.css' rel='stylesheet' media='print' />
<script src='<?php echo base_url(); ?>assets/js/plugins/fullcalendar-3.5.1/lib/moment.min.js'></script>
<script src='<?php echo base_url(); ?>assets/js/plugins/fullcalendar-3.5.1/lib/jquery.min.js'></script>
<script src='<?php echo base_url(); ?>assets/js/plugins/fullcalendar-3.5.1/fullcalendar.min.js'></script>
<script src='<?php echo base_url(); ?>assets/js/plugins/fullcalendar-3.5.1/locale/es.js'></script>
<script>
    $(document).ready(function() {

        $.post('<?php echo base_url(); ?>actividades/calendario/getactivity',
            function(data) {
                /*alert (data);*/
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

                        dia = date.format();
                        /*$.post( "<?php //echo base_url();
                                    ?>actividades/nueva/", { fcha: dia} );*/

                        window.location = "<?php echo base_url(); ?>actividades/nueva/selectcalendar/" + date.format();
                        // change the day's background color just for fun
                        // $(this).css('background-color', 'red');


                    },
                    // allow "more" link when too many events
                    events: $.parseJSON(data)
                });
            });



    });
</script>
<style>
    .table-total-categoria {
        font-size: 10px;
        text-transform: capitalize;
        border: 1px solid #ccc;
    }

    .table-total-categoria td {
        padding: 3px;
        border-bottom: 1px solid #ccc;
    }

    .table-total-categoria th {
        background: rgba(204, 204, 204, 0.15);
    }


    /*contador*/
    .count_top {
        margin-right: 5px;
    }

    span.txt_count {
        font-size: 9px;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .count {
        font-size: 30px;
        font-weight: 600;
        color: #6d6464;
    }

    span.txt_bottom {
        font-size: 11px;
        color: #8c8c8c;
    }

    p.txt_dec_mes {
        font-size: 11px;
        letter-spacing: 1px;
        line-height: 1px;
    }

    p.txt_mes {
        letter-spacing: 2px;
        font-size: 18px;
        font-weight: 600;
        text-transform: uppercase;
        color: gray;
    }
</style>
<div class="main">
    <div>
        <div class="panel panel-default col-md-12">

            <div class="col-md-2 panel-body">

                <?php setlocale(LC_ALL, 'es_ES') . ': ';
                echo '<p class="txt_mes">' . iconv('ISO-8859-1', 'UTF-8',  strftime("%B")) . '</p>';
                ?>
                <p class="txt_dec_mes">Nº Personas</p>
                <?php
                foreach ($total_prsns_mes as $tp) {
                    echo '<span class="count">' . $tp->total . '</span> aprox.';
                }


                ?>
            </div>
            <?php
            foreach ($total_mes_cat as $tcm) {
                echo '
               
                <div class="panel-body" style="width:9%;float: left;">
                <span class="txt_count">' . $tcm->ctg_nombre . '</span>
                <div class="count">' . $tcm->total . '</div>
                <span class="txt_bottom">' . $tcm->porcentaje . '% del mes</span>
                </div>
                ';
            }
            ?>
        </div>
    </div>
    <div>
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">PORCENTAJE ACUMULADO PERIODO 2017</div>
                <div class="panel-body">
                    <div class="col-md-3">
                        <table class="table-total-categoria">
                            <thead>
                                <tr>
                                    <th>Categoria</th>
                                    <th>Nº Activ.</th>
                                    <th style="text-align: center;">%</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($total_cat as $tc) {

                                    echo '<tr>
                    <td>' . $tc->ctg_nombre . '</td>
                    <td>' . $tc->total . '</td>
                    <td>' . $tc->porcentaje . '%</td>
                    </tr>';
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-9"><canvas id="chart_con"></canvas></div>
                </div>
            </div>
        </div>
        <div class="col-md-5">
            <div class="panel panel-default">
                <div class="panel-body" id='calendar'></div>
            </div>
        </div>
        <div class="col-md-12" style="padding:15px;text-align: center;">
            <div>
                <button type="button" class="btn btn-default btn-xs categoria" id="">Todos</button>
                <?php
                foreach ($categorias as $c) {
                    echo '<button type="button"  class="btn btn-default btn-xs categoria" id="' . $c->ctg_id . '">' . $c->ctg_nombre . '</button>';
                }
                ?>
            </div>
        </div>
    </div>
    <div>
        <div class="col-md-5">
            <div class="panel panel-default">
                <div class="panel-heading">% anual - categorias</div>
                <div class="panel-body"><canvas id="myChart" width="400" height="218"></canvas></div>
            </div>
        </div>
        <div class="col-md-5">
            <div class="panel panel-default">
                <div class="panel-heading">% anual - categorias</div>
                <div class="panel-body"><canvas id="myChart" width="400" height="218"></canvas></div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="panel panel-default">
                <div class="panel-heading">% anual - categorias</div>
                <div class="panel-body"><canvas id="char-subcate" width="400" height="218"></canvas></div>
            </div>
        </div>
    </div>
</div>






<script type="text/javascript">
    // ANUAL


    function cargachart(id) {
        var paramMonth = [];
        var paramPercentage = [];
        $.post("<?php echo site_url('dashboard/dash_actividad/anual'); ?>", {
                id: id
            },

            function(data) {
                // alert("Data Loaded: " + data);
                var obj = JSON.parse(data);

                $.each(obj, function(i, item) {
                    paramMonth.push(item.mes);
                    paramPercentage.push(item.total);
                });


                var ctx = document.getElementById("myChart");
                var config = {
                    type: 'line',
                    data: {
                        labels: paramMonth,
                        datasets: [{
                            label: 'Nº Actividades',
                            data: paramPercentage,
                            backgroundColor: [
                                'rgba(255, 99, 132, 0.2)',
                                'rgba(54, 162, 235, 0.2)',
                                'rgba(255, 206, 86, 0.2)',
                                'rgba(75, 192, 192, 0.2)',
                                'rgba(153, 102, 255, 0.2)',
                                'rgba(255,102,204, 0.2)',
                                'rgba(102,204,255, 0.2)',
                                'rgba(204,255,102, 0.2)',
                                'rgba(255,153,102,0.2)',
                                'rgba(204,255,102,0.2)'
                            ],
                            borderColor: [
                                'rgba(255,99,132,1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(75, 192, 192, 1)',
                                'rgba(153, 102, 255, 1)',
                                'rgba(255, 159, 64, 1)'
                            ],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero: true
                                }
                            }]
                        }
                    }
                };

                var forecast_chart = new Chart(ctx, config);
                forecast_chart.destroy();
                var forecast_chart = new Chart(ctx, config);
            });
    }






    function carga_subcategoria(id) {
        var paramMonth = [];
        var paramPercentage = [];
        $.post("<?php echo site_url('dashboard/dash_actividad/total_subcategorias'); ?>", {
                id: id
            },

            function(data) {
                // alert("Data Loaded: " + data);
                var obj = JSON.parse(data);

                $.each(obj, function(i, item) {
                    paramMonth.push(item.sctg_nombre);
                    paramPercentage.push(item.total);
                });


                var ctx = document.getElementById("char-subcate");
                var config = {
                    type: 'horizontalBar',
                    data: {
                        labels: paramMonth,
                        datasets: [{
                            label: 'Nº Actividades',
                            data: paramPercentage,
                            backgroundColor: [
                                'rgba(255, 99, 132, 0.2)',
                                'rgba(54, 162, 235, 0.2)',
                                'rgba(255, 206, 86, 0.2)',
                                'rgba(75, 192, 192, 0.2)',
                                'rgba(153, 102, 255, 0.2)',
                                'rgba(255,102,204, 0.2)',
                                'rgba(102,204,255, 0.2)',
                                'rgba(204,255,102, 0.2)',
                                'rgba(255,153,102,0.2)',
                                'rgba(204,255,102,0.2)'
                            ],
                            borderColor: [
                                'rgba(255,99,132,1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(75, 192, 192, 1)',
                                'rgba(153, 102, 255, 1)',
                                'rgba(255, 159, 64, 1)'
                            ],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero: true
                                }
                            }]
                        }
                    }
                };

                var forecast_chart = new Chart(ctx, config);
                forecast_chart.destroy();
                var forecast_chart = new Chart(ctx, config);
            });
    }


    $(document).ready(function() {
        cargachart();
        carga_subcategoria();

    });

    $(".categoria").click(function() {
        var id = $(this).attr('id');
        //alert(id);
        cargachart(id);
        carga_subcategoria(id);

    });




    // categorias

    var cat_nombre = [];
    var cat_total = [];
    $.post("<?php echo site_url('dashboard/dash_actividad/total_categorias'); ?>",

        function(data) {

            var obj = JSON.parse(data);

            $.each(obj, function(i, item) {
                cat_nombre.push(item.ctg_nombre);
                cat_total.push(item.total);
            });

            //alert("Data Loaded: " + cat_nombre);
            var pie = document.getElementById("chart_con");
            var chartOptions = {
                segmentShowStroke: true,
                segmentStrokeColor: "#fff",
                segmentStrokeWidth: 2,
                percentageInnerCutout: 50,
                animationSteps: 100,
                animationEasing: "easeOutBounce",
                animateRotate: true,
                animateScale: false,
                responsive: true,
                maintainAspectRatio: true,
                showScale: true,
                animateScale: true,
                legend: {
                    display: true,
                    position: "right",
                    fontSize: 10
                }

            };
            var chart = new Chart(pie, {
                type: 'pie',
                data: {
                    labels: cat_nombre,
                    datasets: [{

                        data: cat_total,
                        backgroundColor: [
                            'rgb(241, 148, 138  )',
                            'rgb(231, 76, 60  )',
                            'rgb(230, 126, 34  )',
                            'rgb(241, 196, 15)',
                            'rgb(46, 204, 113  )',
                            'rgb(22, 160, 133  )',
                            'rgb(127, 179, 213)',
                            'rgb(118, 215, 196)',
                            'rgb(108, 52, 131  )',
                            'rgb(175, 122, 197  )'
                        ]
                    }]
                },
                options: chartOptions
                /*{
                        tooltips: {
                            callbacks: {
                                label: function(tooltipItem, data) {
                                    var allData = data.datasets[tooltipItem.datasetIndex].data;
                                    var tooltipLabel = data.labels[tooltipItem.index];
                                    var tooltipData = allData[tooltipItem.index];
                                    var total = 0;
                                    for (var i in allData) {
                                        total += allData[i];
                                    }
                                    var tooltipPercentage = Math.round((tooltipData / total) * 100);
                                    return tooltipLabel + ': ' + tooltipData + ' (' + tooltipPercentage + '%)';
                                }
                            }
                        }
                    }*/
            });

        });
</script>
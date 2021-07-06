<style> 
 .table_wrapper{
    display: block;
    overflow-x: auto;
    white-space: nowrap;
}
</style>
<br>
<br>
<div class="container">
    <div class="form-group">

    </div>


    <div class="table-responsive table_wrapper">
        <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="grid">
            <thead>
                <tr>


                    <th>Titulo Actual</th>
                    <th>Fecha Cesion</th>
                    <th>Titulo Origen</th> 
                    <th>Poseedor</th> 
                    <th>Rut</th>                   
                    <th>Cantidad Acciones</th>
                    <th>Estado</th>

                   




                </tr>
            </thead>

            <tbody>



                <?php 
                
                for ($i = 0; $i <$indice; $i++) {


                    echo '<tr class="odd gradeX">';
                    echo '<td>' . $historial_t[$i][0]['tiulo_actual'] . '</td>';
                    echo '<td>' . $historial_t[$i][0]['fecha_cesion'] . '</td>';
                    echo '<td>' . $historial_t[$i][0]['titulo_origen'] . '</td>';
                    echo '<td>' . $historial_t[$i][0]['prsn_nombres'] . '</td>';
                    echo '<td>' . $historial_t[$i][0]['prsn_rut'] . '</td>';
                    echo '<td>' . $historial_t[$i][0]['numero_acciones'] . '</td>';
                    echo '<td>' . $historial_t[$i][0]['estado'] . '</td>';
                    
                   
                    echo '</tr>';
                }

                ?>



            </tbody>
           
        </table>

    </div>
</div>
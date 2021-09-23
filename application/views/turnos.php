<div class="col-md-6">
  <div class="panel panel-primary">

    <div class="panel-heading">
      <h3 class="panel-title"><i class="fa fa-group fa-plus-square"></i> TRABAJADORES</h3>
    </div>

    <div class="panel-body">

      <div class="table-responsive">
        <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
          
          <thead>
            <tr>
              <th>Fecha</th>
              <th>Funcionario</th>
              <th>Turno</th>
            </tr>
          </thead>
          <tbody>

            <?php
            foreach ($query as $i) {

              echo ' <tr>
                                  <td>' . $i->fecha . '</td>
                                  <td>' . $i->nombre_fun . ' ' . $i->paterno . ' ' . $i->materno . '</td>
                                  <td>' . $i->t_turno . '</td>
                                </tr>';
            }

            ?>


            <tr>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
          </tbody>
        </table>

      </div>


    </div>

  </div>
</div>
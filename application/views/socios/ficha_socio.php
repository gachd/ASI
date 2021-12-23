<html lang="">

<head>

  <link rel="stylesheet" href="css/bootstrap.css">

  <link rel="stylesheet" href="css/bootstrap-theme.css">

</head>

<style>
  @page oficio {

    size: 210mm 330mm;

    margin: 2cm;

  }

  div.tamaño {
    page: oficio;
  }

  di.row {
    width: 100%;
  }

  .tbl-inf-af tr {
    height: 18px;
  }

  .tbl-inf-af tr td {
    font-size: 10px;
  }

  .tbl-inf-af th {
    font-size: 12px;
  }

  .tbl-inf-af {
    margin-left: 16%;
  }



  .container {

    width: 1000px;

  }

  .col-md-4 img {

    display: block;

    margin-left: auto;

    margin-right: auto;



  }

  table th,
  td,
  tr {

    border: 1px solid black;

    border-collapse: collapse;

  }

  table th {

    background-color: #008928;

    color: white;

  }

  table tr {

    height: 35px;

  }
</style>

<body>

  <div class="container">

    <div class="row">

      <div class="col-md-4">

        <img src="<?php echo base_url(); ?>assets/images/user.jpg" width="150px" height="120px" alt="user" border="0">

      </div>

      <div class="col-md-4">

        <img width="320" height="195" src="http://www.stadioitalianodiconcepcion.cl/ASI/assets/images/logo_instituciones.png">



      </div>

      <div class="col-md-4">



        <table width="80%" border="1" class="tbl-inf-af">

          <thead>

            <tr>

              <th width="70%">Corporación</th>

              <th width="30%">Nº Registro</th>

            </tr>

          </thead>

          <tbody>

            <tr>

              <td>CENTRO ITALIANO DI CONCEPCIÓN</td>

              <td></td>

            </tr>

            <tr>

              <td>SOCIEDAD SOCORROS MUTUOS CONCORDIA</td>

              <td></td>

            </tr>

            <tr>

              <td>STADIO ATLETICO ITALIANO</td>

              <td></td>

            </tr>

            <tr>

              <td>STADIO ITALIANO DI CONCEPCIÓN</td>

              <td></td>

            </tr>

            <tr>

              <td>SCUOLA ITALIANA DI CONCEPCIÓN</td>

              <td></td>

            </tr>

            <tr>

              <td>Nº ACCIONES</td>

              <td></td>

            </tr>

          </tbody>

        </table>

      </div>

      <div class="col-md-12"><a href="#" title="Exportar Pdf" id="pdf" class="descargar btn btn-sm btn-warning"><span class="glyphicon glyphicon-circle-arrow-down"></span> Descargar PDF</a>

        <h3 align="center">FICHA INCORPORACIÓN SOCIOS</h3>
      </div>



      <table width="100%" class="table tbl-datos">

        <thead>

          <tr>

            <th colspan="4">1.- ANTECEDENTES PERSONALES</th>

          </tr>

        </thead>

        <tbody>

          <tr>

            <td width="15%">RUT </td>

            <td></td>

            <td width="15%">NOMBRES </td>

            <td></td>

          </tr>

          <tr>

            <td width="21%">APELLIDO PATERNO </td>

            <td></td>

            <td width="20%">APELLIDO MATERNO </td>

            <td></td>

          </tr>

          <tr>

            <td>FECHA DE NACIMIENTO </td>

            <td></td>

            <td>LUGAR </td>

            <td></td>



          </tr>

          <tr>

            <td>ESTADO CIVIL </td>

            <td></td>

            <td>NACIONALIDAD </td>

            <td></td>

          </tr>

          <tr>

            <td>TELEFONO FIJO </td>

            <td></td>

            <td>TELEFONO CELULAR </td>

            <td></td>

          </tr>




          <tr>

            <td>CIUDAD </td>

            <td></td>

            <td>DOMICILIO(CALLE) </td>

            <td></td>

          </tr>

          <tr>

            <td>Nª </td>

            <td></td>

            <td>DPTO </td>

            <td></td>

          </tr>
          <tr>

            <td>CORREO</td>


          </tr>

        </tbody>

      </table>

      <table width="100%" class="table tbl-datos">

        <thead>

          <tr>

            <th colspan="6">2.- ANTECEDENTES LABORALES</th>

          </tr>

        </thead>

        <tbody>

          <tr>

            <td width="25%">ACTIVIDAD O PROFESIÓN </td>

            <td colspan="2"></td>

            <td width="10%">EMPRESA </td>

            <td colspan="2"></td>

          </tr>

          <tr>

            <td>CALLE </td>

            <td width="30%"></td>

            <td width="5%">Nº </td>

            <td></td>

            <td width="8%">DPTO </td>

            <td></td>

          </tr>

        </tbody>

      </table>

      <table width="100%" class="table tbl-datos">

        <thead>

          <tr>

            <th colspan="4">3.- PATROCINANTES</th>

          </tr>

        </thead>

        <tbody>

          <tr>

            <td width="21%">NOMBRE SOCIO </td>

            <td colspan="3"></td>

          </tr>

          <tr>

            <td>FECHA DE NACIMIENTO </td>

            <td></td>

            <td width="18%">Nº DE REGISTRO </td>

            <td></td>

          </tr>

          <tr>

            <td width="20%">NOMBRE SOCIO </td>

            <td colspan="3"></td>

          </tr>

          <tr>

            <td>FECHA DE NACIMIENTO </td>

            <td></td>

            <td>Nº DE REGISTRO </td>

            <td></td>

          </tr>

        </tbody>

      </table>

      <table width="100%" class="table tbl-datos">

        <thead>

          <tr>

            <th colspan="6">4.- FAMILIAR ITALIANO(CERTIFICADO POR UN ÁRBOL GENEALOGICO)</th>

          </tr>

        </thead>

        <tbody>

          <tr>

            <td>NOMBRE </td>

            <td colspan="2"></td>

            <td width="14%">PARENTESCO </td>

            <td colspan="2"></td>

          </tr>

          <tr>

            <td width="21%">FECHA DE NACIMIENTO </td>

            <td width="15%"></td>

            <td width="10%">REGIÓN </td>

            <td></td>

            <td width="18%">CIUDAD O PUEBLO </td>

            <td width="12%"></td>

          </tr>

        </tbody>

      </table>



      <table width="100%" class="table tbl-datos">

        <thead>

          <tr>

            <th colspan="4">5.- ANTECEDENTES FAMILIARES</th>

          </tr>

          <tr>

            <th colspan="4">5.1.- CONYUGE</th>

          </tr>

        </thead>

        <tbody>

          <tr>

            <td>NOMBRE </td>

            <td></td>

            <td>APELLIDO PATERNO </td>

            <td></td>

          </tr>

          <tr>

            <td>APELLIDO MATERNO </td>

            <td></td>

            <td>RUT </td>

            <td></td>

          </tr>

          <tr>

            <td width="21%">FECHA DE NACIMIENTO </td>

            <td width="28%"></td>

            <td width="20%">CELULAR </td>

            <td></td>

          </tr>

          <tr>

            <td>EMAIL </td>

            <td colspan="3"></td>

          </tr>



        </tbody>

      </table>

      <table width="100%" class="table tbl-cargas">

        <thead>

          <tr>

            <th colspan="4">5.2.- PADRES</th>

          </tr>

        </thead>

        <tbody>



          <tr>

            <td align="center" rowspan="4" width="20%">PADRE</td>

            <td>NOMBRE </td>

            <td></td>

          </tr>

          <tr>

            <td ">APELLIDO PATERNO </td>

                    <td ></td>

                  </tr>

                  <tr>

                  	<td >APELLIDO MATERNO </td>

                    <td ></td>                    

                  </tr>    

                  <tr>

                  	<td width=" 21%">FECHA DE NACIMIENTO </td>

            <td></td>

          </tr>

          <tr>

            <td align="center" rowspan="4" width="20%">MADRE</td>

            <td>NOMBRE </td>

            <td></td>

          </tr>

          <tr>

            <td ">APELLIDO PATERNO </td>

                    <td ></td>

                  </tr>

                  <tr>

                  	<td >APELLIDO MATERNO </td>

                    <td ></td>                    

                  </tr>    

                  <tr>

                  	<td>FECHA DE NACIMIENTO </td>

                    <td ></td>

                  </tr>                

                </tbody>

              </table>

              <table width=" 100%" class="table tbl-cargas">

              <thead>

                <tr>

                  <th colspan="5">5.3.- CARGAS O BENEFICIARIOS</th>

                </tr>

              </thead>

        <tbody>

          <tr>

            <th width="10%">
              <center>PARENTESCO</center>
            </th>

            <th width="35%">
              <center>NOMBRES Y APELLIDOS</center>
            </th>

            <th width="12%">
              <center>RUT</center>
            </th>

            <th>
              <center>FECHA DE NACIMIENTO</center>
            </th>

            <th>
              <center>CELULAR</center>
            </th>

          </tr>

          <tr>

            <td></td>

            <td></td>

            <td></td>

            <td></td>

            <td></td>

          </tr>

          <tr>

            <td></td>

            <td></td>

            <td></td>

            <td></td>

            <td></td>

          </tr>

          <tr>

            <td></td>

            <td></td>

            <td></td>

            <td></td>

            <td></td>

          </tr>



        </tbody>

      </table>

      <table width="100%" class="table tbl-cargas">

        <thead>

          <tr>

            <th colspan="5">6.- ¿QUÉ LO MOTIVA A POSTULARSE COMO SOCIO DE LAS INSTITUCIONES ITALIANAS?</th>

          </tr>

        </thead>

        <tbody>

          <tr>

            <td height="200px"></td>

          </tr>

        </tbody>

      </table>

      <table width="100%" class="table tbl-datos">

        <thead>

          <tr>

            <th colspan="3">7.- USO INTERNO</th>

          </tr>

          <tr>

            <th colspan="3">7.1.- INGRESO</th>

          </tr>

        </thead>

        <tbody>

          <tr>

            <th width="32%">
              <center>REUNION DIRECTORIO</center>
            </th>

            <th width="25%">
              <center>FECHA ACTA</center>
            </th>

            <th>
              <center>GLOSA</center>
            </th>

          </tr>

          <tr>

            <td>CENTRO ITALIANO DE CONCEPCIÓN</td>

            <td></td>

            <td></td>

          </tr>

          <tr>

            <td>STADIO ATLÉTICO ITALIANO</td>

            <td></td>

            <td></td>

          </tr>

          <tr>

            <td>SOCIEDAD DE SOCORROS MUTUOS CONCORDIA</td>

            <td></td>

            <td></td>

          </tr>

          <tr>

            <td>STADIO ITALIANO DI CONCEPCIÓN</td>

            <td></td>

            <td></td>

          </tr>

          <tr>

            <td>SCUOLA ITALIANA DI CONCEPCIÓN</td>

            <td></td>

            <td></td>

          </tr>

          <tr>

            <th colspan="3">7.2.- RETIRO</th>

          </tr>

          <tr>

            <th width="32%">
              <center>REUNION DIRECTORIO</center>
            </th>

            <th width="25%">
              <center>FECHA ACTA</center>
            </th>

            <th>
              <center>GLOSA</center>
            </th>

          </tr>

          <tr>

            <td>CENTRO ITALIANO DE CONCEPCIÓN</td>

            <td></td>

            <td></td>

          </tr>

          <tr>

            <td>STADIO ATLÉTICO ITALIANO</td>

            <td></td>

            <td></td>

          </tr>

          <tr>

            <td>SOCIEDAD DE SOCORROS MUTUOS CONCORDIA</td>

            <td></td>

            <td></td>

          </tr>

          <tr>

            <td>STADIO ITALIANO DI CONCEPCIÓN</td>

            <td></td>

            <td></td>

          </tr>

          <tr>

            <td>SCUOLA ITALIANA DI CONCEPCIÓN</td>

            <td></td>

            <td></td>

          </tr>

        </tbody>

      </table>

      <table width="100%" class="table tbl-cargas">

        <thead>

          <tr>

            <th colspan="5">8.- INFORMACIÓN ACCIONISTAS</th>

          </tr>

        </thead>

        <tbody>

          <tr>

            <th width="10%">
              <center>ACCIONES</center>
            </th>

            <th width="35%">
              <center>Nº LIBRO</center>
            </th>

            <th width="12%">
              <center>FOJAS</center>
            </th>

            <th>
              <center>TITULO Nº</center>
            </th>

            <th>
              <center>FECHA ACCION</center>
            </th>

          </tr>

          <tr>

            <td></td>

            <td></td>

            <td></td>

            <td></td>

            <td></td>

          </tr>

          <tr>

            <th colspan="5">DATOS DE LA VENTA DE LA ACCION</th>

          </tr>

          <tr>

            <th colspan="2">
              <center>FECHA DE VENTA</center>
            </th>

            <th colspan="3">
              <center>NOMBRE COMPRADOR</center>
            </th>

          </tr>

          <tr>

            <td colspan="2"></td>

            <td colspan="3"></td>

          </tr>



        </tbody>

      </table>



    </div>

  </div>

  <script src="js/bootstrap.js"></script>

</body>

<script>
  $("a[id=pdf]").click(function() {


    url = "<?php echo base_url(); ?>socios/Ficha_socio/ficha_socios";

    window.open(url, '_blank');

  });
</script>

</html>
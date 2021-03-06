<head>

  <link rel="stylesheet" href="css/bootstrap.css">

  <link rel="stylesheet" href="css/bootstrap-theme.css">

</head>

<body>

  <style type="text/css">
    @page oficio {

      size: 216mm 330mm;
      margin: 5px;

    }

    @page carta {

      size: 216mm 280mm;
      margin: 5px;

    }

    div.container {
      page: oficio;

    }


    div.encab {
      width: 100%;



    }

    .tbl-inf-af tr {
      height: 30px;
    }

    .tbl-inf-af tr td {

      font-size: 11px;

      border: 1px solid black;

      border-collapse: collapse;

      height: 25px;

    }

    .tbl-inf-af th {

      font-size: 12px;

      border: 1px solid black;

      border-collapse: collapse;

    }

    .tbl-datos tr td {

      border: 1px solid black;

      border-collapse: collapse;

      height: 30px;

    }

    .tbl-datos th {

      border: 1px solid black;

      border-collapse: collapse;

    }

    .tbl-cargas tr td {

      border: 1px solid black;

      border-collapse: collapse;

      height: 30px;

    }

    .tbl-motiva tr td {

      border: 1px solid black;

      border-collapse: collapse;

    }

    .tbl-motiva th {

      border: 1px solid black;

      border-collapse: collapse;

    }

    .tbl-cargas th {

      border: 1px solid black;

      border-collapse: collapse;

    }

    .tbl-cargas tr {

      height: 35px;

    }



    .container {

      width: 1000px;

    }

    img.logo {

      display: block;

      margin-left: auto;

      margin-right: auto;



    }



    table th {

      background-color: #008928;

      color: white;

    }





    .encabezado th tr td {

      border: 1px solid white;

    }

    table {

      font-size: 12px;

    }

    .td_datos {


      font-weight: bold;
      font-style: monospace;
      font-size: 14px;
      text-align: center;

      
      


    }

    .img_circulo {
      border-radius: 50%;
      border: 1px solid #ddd;
      padding: 4px;
    }
  </style>

  <?php


  function FotoPerfil($dir)
  {
    //valido que se encuentre directorio en base de datos
    if (!empty($dir)) {

      $dir = $dir . "/perfil";
      $permitidos = array('jpeg', 'png', 'jpg', 'gif');
      $archivos = array();
      $urlBase = base_url();

      if (is_dir($dir)) {

        foreach (scandir($dir) as $listado) {

          //validor los elementos oermitidos

          //valido que el elemto no sea un directorio
          if (!is_dir($dir . '/' . $listado)) {

            $extension = pathinfo($dir . '/' . $listado, PATHINFO_EXTENSION);

            $extension = strtolower($extension);

            if (in_array($extension, $permitidos)) {


              $archivos[$listado] = filemtime($dir . '/' . $listado);
            }
          }
        }
        //ordeno del mas reciente al mas antiguo gracias al filetime
        arsort($archivos);

        $archivos = array_keys($archivos);

        //valido que el directorio no este vacio
        if (empty($archivos)) {

          echo 'https://upload.wikimedia.org/wikipedia/commons/9/99/Sample_User_Icon.png';
        } else {

          //muestro la foto mas reciente

          echo ($urlBase . $dir . '/' . $archivos[0]);
        }
      } else {

        echo 'https://upload.wikimedia.org/wikipedia/commons/9/99/Sample_User_Icon.png';
      }
    } else {
      echo 'https://upload.wikimedia.org/wikipedia/commons/9/99/Sample_User_Icon.png';
    }
  }


  $corporaciones;
  $datos_personales;
  $patrocinadores;
  $patrocinados;
  $cargas;
  $cuotas;
  $InfoSocio;






  ?>




  <div class="container">

    <div class="encab">

      <table width="100%" class="encabezado" id="encabezado">

        <tbody>

          <tr>

            <td width="27%"><img src="<?php FotoPerfil($InfoSocio->path) ?>" width="150px" height="150px" alt="user" class="img_circulo"></td>

            <td width="45%"><img class="logo" width="80%" height="220" src="http://www.stadioitalianodiconcepcion.cl/ASI/assets/images/logo_instituciones.png"></td>

            <td width="28%">



              <table width="100%" class="tbl-inf-af">

                <thead>

                  <tr>

                    <th width="70%">Corporaci??n</th>

                    <th width="30%">N?? Registro</th>

                  </tr>

                </thead>



                <tbody>

                  <tr>

                    <td>CENTRO ITALIANO DI CONCEPCI??N</td>

                    <td class="td_datos"><?php echo $corporaciones["70331500-3"]->n_registro  ?></td>

                  </tr>

                  <tr>

                    <td>SOCIEDAD SOCORROS MUTUOS CONCORDIA</td>

                    <td class="td_datos"><?php echo $corporaciones["72265900-7"]->n_registro  ?></td>

                  </tr>

                  <tr>

                    <td>STADIO ATLETICO ITALIANO</td>

                    <td class="td_datos"><?php echo $corporaciones["71888800-k"]->n_registro  ?></td>

                  </tr>

                  <tr>

                    <td>STADIO ITALIANO DI CONCEPCI??N</td>

                    <td class="td_datos"><?php echo $corporaciones["65106820-7"]->n_registro  ?></td>

                  </tr>

                  <tr>

                    <td>SCUOLA ITALIANA DI CONCEPCI??N</td>

                    <td class="td_datos"><?php echo $corporaciones["65467840-5"]->n_registro  ?></td>

                  </tr>

                  <tr>

                    <td>N?? ACCIONES</td>

                    <td class="td_datos"> </td>

                  </tr>

                </tbody>

              </table>



            </td>

          </tr>



        </tbody>

      </table>



    </div>





    <h2 align="center">FICHA REGISTRO SOCIOS</h2>


    <table width="100%" class="table tbl-datos">

      <thead>

        <tr>

          <th colspan="4">1.- ANTECEDENTES PERSONALES</th>

        </tr>

      </thead>

      <tbody>

        <tr>

          <td width="15%">RUT </td>


          <td class="td_datos"><?php echo $datos_personales->prsn_rut ?></td>

          <td width="15%">NOMBRES </td>

          <td class="td_datos"><?php echo $datos_personales->prsn_nombres ?></td>

        </tr>

        <tr>

          <td width="21%">APELLIDO PATERNO </td>

          <td class="td_datos"><?php echo $datos_personales->prsn_apellidopaterno ?></td>

          <td width="20%">APELLIDO MATERNO </td>

          <td class="td_datos"><?php echo $datos_personales->prsn_apellidomaterno ?></td>

        </tr>

        <tr>

          <td>FECHA DE NACIMIENTO </td>

          <td class="td_datos"><?php echo formato_fecha($datos_personales->prsn_fechanacimi) ?></td>

          <td>LUGAR </td>

          <td class="td_datos"><?php echo $datos_personales->prsn_nac ?></td>



        </tr>

        <tr>

          <td>ESTADO CIVIL </td>

          <td class="td_datos"><?php echo $datos_personales->estacivil_nombre ?></td>

          <td>NACIONALIDAD </td>

          <td class="td_datos"><?php echo $datos_personales->nac_nombre ?></td>

        </tr>

        <tr>

          <td>TELEFONO </td>

          <td class="td_datos"><?php echo $datos_personales->prsn_fono_casa ?></td>

          <td>CELULAR </td>

          <td class="td_datos"><?php echo $datos_personales->prsn_fono_movil ?></td>

        </tr>

        <tr>

          <td>CIUDAD </td>

          <td class="td_datos"><?php echo $datos_personales->comuna_nombre ?></td>

          <td>DOMICILIO(CALLE) </td>

          <td class="td_datos"><?php echo $datos_personales->prsn_direccion ?></td>

        </tr>


        <tr>

          <td>EMAIL</td>
          <td class="td_datos" colspan="3"><?php echo $datos_personales->prsn_email ?></td>



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

          <td width="25%">ACTIVIDAD O PROFESI??N </td>

          <td class="td_datos" colspan="2"><?php echo $datos_personales->prsn_profesion ?></td>

          <td width="10%">EMPRESA </td>

          <td class="td_datos" colspan="2"><?php echo $datos_personales->prsn_empresa ?></td>

        </tr>

        <tr>

          <td>DIRECCION </td>

          <td  colspan="4" class="td_datos"><?php echo $datos_personales->prsn_direccion_empresa ?></td>



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

          <td class="td_datos" colspan="3"> <?php echo $patrocinadores[0]->prsn_nombres . " " . $patrocinadores[0]->prsn_apellidopaterno . " " . $patrocinadores[0]->prsn_apellidomaterno  ?></td>

        </tr>

        <tr>

          <td>FECHA DE NACIMIENTO </td>

          <td class="td_datos"><?php echo formato_fecha($patrocinadores[0]->prsn_fechanacimi) ?></td>

          <td width="18%">N?? DE REGISTRO </td>

          <td class="td_datos"><?php echo $patrocinadores[0]->n_registro ?></td>

        </tr>

        <tr>

          <td width="20%">NOMBRE SOCIO </td>

          <td class="td_datos" colspan="3"> <?php echo $patrocinadores[1]->prsn_nombres . " " . $patrocinadores[1]->prsn_apellidopaterno . " " . $patrocinadores[1]->prsn_apellidomaterno  ?> </td>

        </tr>

        <tr>

          <td>FECHA DE NACIMIENTO </td>

          <td class="td_datos"> <?php echo formato_fecha($patrocinadores[1]->prsn_fechanacimi) ?> </td>

          <td>N?? DE REGISTRO </td>

          <td class="td_datos"> <?php echo $patrocinadores[1]->n_registro ?> </td>

        </tr>

      </tbody>

    </table>
    <!-- 
    <table width="100%" class="table tbl-datos">

      <thead>

        <tr>

          <th colspan="6">4.- FAMILIAR ITALIANO(CERTIFICADO POR UN ??RBOL GENEALOGICO)</th>

        </tr>

      </thead>

      <tbody>

        <tr>

          <td>NOMBRE </td>

          <td colspan="2"></td>

          <td width="10%">PARENTESCO </td>

          <td colspan="2"></td>

        </tr>

        <tr>

          <td width="21%">FECHA DE NACIMIENTO </td>

          <td width="15%"></td>

          <td width="10%">REGI??N </td>

          <td></td>

          <td width="14%">CIUDAD O PUEBLO</td>

          <td width="12%"></td>

        </tr>

      </tbody>

    </table>
 -->


    <table width="100%" class="table tbl-datos">

      <thead>

        <tr>

          <th colspan="4">4.- ANTECEDENTES FAMILIARES</th>

        </tr>

        
        <tr>

          <th colspan="4">4.1.- CONYUGE</th>

        </tr>

      </thead>

      <tbody>

        <tr>

          <td>NOMBRE </td>

          <td class="td_datos"><?php echo $beneficiarios["conyugue"]->prsn_nombres?></td>

          <td>APELLIDO PATERNO </td>

          <td class="td_datos"><?php echo $beneficiarios["conyugue"]->prsn_apellidopaterno ?></td>

        </tr>

        <tr>

          <td>APELLIDO MATERNO </td>

          <td class="td_datos"><?php echo $beneficiarios["conyugue"]->prsn_apellidomaterno ?></td>

          <td >RUT </td>

          <td class="td_datos"> <?php echo $beneficiarios["conyugue"]->s_personas_prsn_rut ?> </td>

        </tr>

        <tr>

          <td width="21%">FECHA DE NACIMIENTO </td>

          <td width="28%" class="td_datos"> <?php echo formato_fecha($beneficiarios["conyugue"]->prsn_fechanacimi )?></td>

          <td width="20%">CELULAR </td>

          <td class="td_datos"> <?php echo $beneficiarios["conyugue"]->prsn_fono_movil?></td>

        </tr>

        <tr>

          <td>EMAIL </td>

          <td class="td_datos" colspan="3"></td>

        </tr>



      </tbody>

    </table>

    <table width="100%" class="table tbl-cargas">

      <thead>

        <tr>

          <th colspan="4">4.2.- PADRES</th>

        </tr>

      </thead>

      <tbody>



        <tr>

          <td align="center" rowspan="4" width="20%">PADRE</td>

          <td>NOMBRE </td>

          <td class="td_datos" colspan="2"><?php echo   $beneficiarios['padre']->prsn_nombres ?></td>

        </tr>

        <tr>

          <td>APELLIDO PATERNO </td>

          <td class="td_datos" colspan="2"><?php echo   $beneficiarios['padre']->prsn_apellidopaterno ?></td>

        </tr>

        <tr>

          <td>APELLIDO MATERNO </td>

          <td class="td_datos" colspan="2"><?php echo   $beneficiarios['padre']->prsn_apellidomaterno ?></td>

        </tr>

        <tr>

          <td width="26%">FECHA DE NACIMIENTO </td>

          <td class="td_datos" colspan="2">  <?php echo formato_fecha($beneficiarios["padre"]->prsn_fechanacimi )?> </td>

        </tr>

        <tr>

          <td align="center" rowspan="4" width="20%">MADRE</td>

          <td>NOMBRE </td>

          <td class="td_datos" colspan="2">  <?php  echo   $beneficiarios['madre']->prsn_nombres ?> </td>

        </tr>

        <tr>

          <td>APELLIDO PATERNO </td>

          <td class="td_datos" colspan="2"> <?php  echo   $beneficiarios['madre']->prsn_apellidopaterno ?> </td>

        </tr>

        <tr>

          <td>APELLIDO MATERNO </td>

          <td class="td_datos" colspan="2"> <?php  echo   $beneficiarios['madre']->prsn_apellidomaterno ?> </td>

        </tr>

        <tr>

          <td>FECHA DE NACIMIENTO </td>

          <td class="td_datos" colspan="2">    <?php echo formato_fecha($beneficiarios["madre"]->prsn_fechanacimi )?> </td>

        </tr>

      </tbody>

    </table>

    <table width="100%" class="table tbl-cargas">

      <thead>

        <tr>

          <th colspan="5">4.3.- CARGAS O BENEFICIARIOS</th>

        </tr>

      </thead>

      <?php if ($beneficiarios){ ?>

     

      <tbody>

        <tr>

          <th width="13%">
            <center>PARENTESCO</center>
          </th>

          <th width="42%">
            <center>NOMBRES Y APELLIDOS</center>
          </th>

          <th width="18%">
            <center>RUT</center>
          </th>

          <th width="15%">
            <center>FECHA DE NACIMIENTO</center>
          </th>

          <th>
            <center>CELULAR</center>
          </th>

        </tr>


        <?php foreach ( $cargas as $index => $c){ ?>

        <tr>

          <td height="30px"><?php echo $c->pt_nombre  ?> </td>

          <td class="td_datos"><?php echo $c->prsn_nombres.' '.$c->prsn_apellidopaterno.' '.$c->prsn_apellidomaterno  ?></td>

          <td class="td_datos"><?php echo $c->prsn_rut  ?></td>

          <td class="td_datos"><?php echo formato_fecha($c->prsn_fechanacimi)  ?></td>

          <td class="td_datos"><?php echo $c->prsn_fono_movil  ?></td>

        </tr>

      

     
        <?php } ?>



      </tbody>

      <?php }else{
        echo "<tr><td colspan='5'><center>No hay beneficiarios registrados</center></td></tr>";
      } ?>

    </table>
    <!-- 
    <table width="100%" class="table tbl-motiva" >

      <thead>

        <tr>

          <th colspan="5">6.- ??QU?? LO MOTIVA A POSTULARSE COMO SOCIO DE LAS INSTITUCIONES ITALIANAS?</th>

        </tr>

      </thead>

      <tbody>

        <tr>

          <td width="100%" height="200px"></td>

        </tr>

      </tbody>

    </table> -->

    <table width="100%" class="table tbl-datos">

      <thead>

        <tr>

          <th colspan="3">5.- USO INTERNO</th>

        </tr>

        <tr>

          <th colspan="3">5.1.- INGRESO</th>

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

          <td>CENTRO ITALIANO DE CONCEPCI??N</td>

          <td class="td_datos"><?php echo formato_fecha($corporaciones['70331500-3']->fecha_registro) ?></td>

          <td class="td_datos"><?php echo $corporaciones['70331500-3']->n_registro ?></td>

        </tr>

        <tr>

          <td>STADIO ATL??TICO ITALIANO</td>

          <td class="td_datos"><?php echo formato_fecha($corporaciones['71888800-k']->fecha_registro) ?></td>

          <td class="td_datos"><?php echo $corporaciones['71888800-k']->n_registro ?></td>

        </tr>

        <tr>

          <td>SOCIEDAD DE SOCORROS MUTUOS CONCORDIA</td>

          <td class="td_datos"><?php echo formato_fecha($corporaciones['72265900-7']->fecha_registro) ?></td>

          <td class="td_datos"><?php echo $corporaciones['72265900-7']->n_registro ?></td>

        </tr>

        <tr>

          <td>STADIO ITALIANO DI CONCEPCI??N</td>

          <td class="td_datos"><?php echo formato_fecha($corporaciones['65106820-7']->fecha_registro) ?></td>

          <td class="td_datos"><?php echo $corporaciones['65106820-7']->n_registro ?></td>

        </tr>

        <tr>

          <td>SCUOLA ITALIANA DI CONCEPCI??N</td>


          <td class="td_datos"><?php echo formato_fecha($corporaciones['65467840-5']->fecha_registro) ?></td>

          <td class="td_datos"><?php echo $corporaciones['65467840-5']->n_registro ?></td>

        </tr>

        <tr>

          <th colspan="3">5.2.- RETIRO</th>

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

          <td>CENTRO ITALIANO DE CONCEPCI??N</td>

          <td class="td_datos"><?php echo formato_fecha($corporaciones['70331500-3']->fecha_retiro) ?></td>

          <td class="td_datos"><?php echo $corporaciones['70331500-3']->n_registro ?></td>

        </tr>

        <tr>

          <td>STADIO ATL??TICO ITALIANO</td>

          <td class="td_datos"><?php echo formato_fecha($corporaciones['71888800-k']->fecha_retiro) ?></td>

          <td class="td_datos"><?php echo $corporaciones['71888800-k']->n_registro ?></td>

        </tr>

        <tr>

          <td>SOCIEDAD DE SOCORROS MUTUOS CONCORDIA</td>

          <td class="td_datos"><?php echo formato_fecha($corporaciones['72265900-7']->fecha_retiro) ?></td>

          <td class="td_datos"><?php echo $corporaciones['72265900-7']->n_registro ?></td>

        </tr>

        <tr>

          <td>STADIO ITALIANO DI CONCEPCI??N</td>

          <td class="td_datos"><?php echo formato_fecha($corporaciones['65106820-7']->fecha_retiro) ?></td>

          <td class="td_datos"><?php echo $corporaciones['65106820-7']->n_registro ?></td>

        </tr>

        <tr>

          <td>SCUOLA ITALIANA DI CONCEPCI??N</td>


          <td class="td_datos"><?php echo formato_fecha($corporaciones['65467840-5']->fecha_retiro) ?></td>

          <td class="td_datos"><?php echo $corporaciones['65467840-5']->n_registro ?></td>

        </tr>

      </tbody>

    </table>

    <table width="100%" class="table tbl-cargas">

      <thead>

        <tr>

          <th colspan="5">6.- INFORMACI??N ACCIONISTAS</th>

        </tr>

      </thead>

      <tbody>

        <tr>

          <th width="10%">
            <center>ACCIONES</center>
          </th>

          <th width="35%">
            <center>N?? LIBRO</center>
          </th>

          <th width="12%">
            <center>FOJAS</center>
          </th>

          <th>
            <center>TITULO N??</center>
          </th>

          <th>
            <center>FECHA ACCION</center>
          </th>

        </tr>
        <?php if($titulos){ ?>

        <?php foreach ($titulos as $titulo) { ?>

        <tr>

          <td class="td_datos" height="30px">   <?php echo $titulo->numero_acciones ?>  </td>

          <td  class="td_datos"><?php echo $accionista->libro_accionista ?> </td>

          <td  class="td_datos"><?php echo $accionista->foja_accionista ?>  </td>

          <td  class="td_datos"><?php echo $titulo->id_titulos ?> </td>

          <td  class="td_datos"><?php echo formato_fecha($titulo->fecha) ?> </td>

        </tr>

        <?php } ?>

        <?php }else{?>
          <tr>

            <td colspan="5"  class="td_datos"> No registra acciones </td>

          </tr>


          <?php } ?>
        

      



      </tbody>

    </table>



  </div>

  </div>

  </div>

</body>
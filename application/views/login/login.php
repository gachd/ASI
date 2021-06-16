<!doctype html>
<html>

<head>
  <meta charset="utf-8">
  <title>Stadio Italiano Di Concepcion</title>
  <link href="<?php echo base_url(); ?>/assets/css/login.css" rel="stylesheet" type="text/css">
  <link href="<?php echo base_url(); ?>/assets/css/bootstrap.min.css" rel="stylesheet">
  <script type="text/javascript" src="<?php echo base_url(); ?>/assets/js/jquery.js"></script>
  <style type="text/css">
    #msg {
      margin-top: 10px;
    }
  </style>
</head>

<body>
  <div id="page-wrapper">
    <div class="container-fluid">
      <div class="login-page">
        <div class="form">
          <?php echo form_open(base_url() . 'login'); ?>
          <?php echo validation_errors(); ?>
          <form class="login-form">
            <div class="row">
              <div class="col-md-4 logo"><img width="150" src="https://www.stadioitalianodiconcepcion.cl/ASI/assets/images/logo_instituciones.png"></div>
              <div class="col-md-8">
                <input type="text" placeholder="usuario" name="username" />
                <input type="password" placeholder="contraseña" name="password" />
                <button>ingresar</button>
                <p class="message"> <?php echo base_url() ?>   No estas registrado? solicita tu cuenta a <a href="#">ffigueroa@enti-italiani.cl</a></p>
                <?php echo form_close(); ?>
              </div>
            </div>
            <div class="row-fluid">
              <?php if ($_POST['msj'] == 1) { ?>
                <div id="msg">
                  <div class="alert alert-danger" id="msg-alert">
                    <strong>ACCESO DENEGADO!</strong><br> Favor ingrese sus datos correctamente.
                  </div>
                </div>
              <?php } ?>
            </div>
          </form>

        </div>

      </div>
    </div>
  </div>
</body>

</html>
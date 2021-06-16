<!doctype html>
<html>
<head>
<meta charset="utf-8">
<link href="<?php echo base_url(); ?>/assets/css/login.css" rel="stylesheet" type="text/css">
<!-- Bootstrap -->
    <link href="<?php echo base_url(); ?>/assets/css/bootstrap.min.css" rel="stylesheet">
      <script type="text/javascript" src="<?php echo base_url(); ?>/assets/js/jquery.js"></script>
</head>

<body>
 <div id="page-wrapper">

            <div class="container-fluid">
            
<div class="login-page">
  <div class="form">
    <form class="register-form">
      <input type="text" placeholder="name"/>
      <input type="password" placeholder="password"/>
      <input type="text" placeholder="email address"/>
      <button>create</button>
      <p class="message">Already registered? <a href="#">Sign In</a></p>
    </form>
    
        
    
    
    <?php echo form_open(base_url().'Login'); ?>
 <?php echo validation_errors(); ?>
    <form class="login-form">
      <input type="text" placeholder="username" name="username"/>
      <input type="password" placeholder="password" name="password"/>
      <button>login</button>
      <p class="message">No estas registrado? solicita tu cuenta a <a href="#">vvenegas@enti-italiani.cl</a></p>
       <?php echo form_close(); ?>
    </form>
    
 <?php if( $_POST['msj'] ==1 ) { ?> 
            <div id="msg"> 
                <div class="alert alert-danger">
  <strong>ACCESO DENEGADO!</strong> Favor ingrese sus datos correctamente.
</div>
            </div> 
            <?php } ?> 
  </div>
</div>

</div>
</div>
</body>

</html>
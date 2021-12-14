
</body>

</html>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Stadio Italiano di Concepcion</title>

  <style type="text/css">
    body {
      margin: 0;
      padding: 0;
      min-width: 100% !important;
    }

    img {
      height: auto;
    }

    .content {
      width: 100%;
      max-width: 600px;
    }

    .header {
      padding: 40px 30px 20px 30px;
    }

    .innerpadding {
      padding: 0px 30px 30px 30px;
    }

    .borderbottom {
      border-bottom: 1px solid #f2eeed;
    }

    .subhead {
      font-size: 15px;
      color: #ffffff;
      font-family: sans-serif;
      letter-spacing: 10px;
    }

    .h1,
    .h2,
    .bodycopy {
      color: #153643;
      font-family: sans-serif;
    }

    .h1 {
      font-size: 33px;
      line-height: 38px;
      font-weight: bold;
    }

    .h2 {
      padding: 0 0 15px 0;
      font-size: 24px;
      line-height: 28px;
      font-weight: bold;
    }

    .bodycopy {
      font-size: 16px;
      line-height: 22px;
    }

    .button {
      text-align: center;
      font-size: 18px;
      font-family: sans-serif;
      font-weight: bold;
      padding: 0 30px 0 30px;
    }

    .button a {
      color: #ffffff;
      text-decoration: none;
    }

    .footer {
      padding: 5px 5px 5px 5px;
    }

    .footercopy {
      font-family: sans-serif;
      font-size: 14px;
      color: #ffffff;
    }

    .footercopy a {
      color: #ffffff;
      text-decoration: underline;
    }
    .invisible {
      display: none;
    }

    @media only screen and (max-width: 550px),
    screen and (max-device-width: 550px) {
      body[yahoo] .hide {
        display: none !important;
      }

      body[yahoo] .buttonwrapper {
        background-color: transparent !important;
      }

      body[yahoo] .button {
        padding: 0px !important;
      }

      body[yahoo] .button a {
        background-color: #e05443;
        padding: 15px 15px 13px !important;
      }

      body[yahoo] .unsubscribe {
        display: block;
        margin-top: 20px;
        padding: 10px 50px;
        background: #2f3942;
        border-radius: 5px;
        text-decoration: none !important;
        font-weight: bold;
      }
    }

  
  </style>
</head>



<body yahoo bgcolor="#f6f8f1">

  <div class="main">

  <?php
  
  $anno = date('Y');


  ?>


    <table width="100%" bgcolor="#f6f8f1" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td>

          <table bgcolor="#ffffff" class="content" align="center" cellpadding="0" cellspacing="0" border="0">
            <tr>
              <td class="header">
                <table width="70" align="left" border="0" cellpadding="0" cellspacing="0">
                  <tr>
                    <td height="70" style="padding: 0 20px 20px 0;">
                      <img class="fix" src="https://www.stadioitalianodiconcepcion.cl/ASI/assets/images/logo_instituciones.png" width="70" height="70" border="0" alt="" />
                      
                      <img class="" src="<?php echo base_url()."/Correo/rastreo?code=".$hash ?>" width="1" height="1" border="0" alt="" />
                    
                    </td>
                  </tr>

                <table width="100%" align="left" border="0" cellpadding="0" cellspacing="0">
                  <tr>
                    <td style="padding: 0 20px 20px 0;">
                      <img class="fix" src="" border="0" alt="" />
                    </td>
                  </tr>
                </table>

               
              </td>
            </tr>
            <tr>
              <td class="innerpadding borderbottom">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td class="h2">
                      <?php echo $asunto ?>
                    </td>
                  </tr>
                  <tr>
                    <td class="bodycopy" style="font-size:12px;">
                      <p><?php echo 'Estimado(a) :' ?> </p>
                      <p>
                       <?php  echo $mensaje ?>
                      <p>&nbsp;</p>
                    </td>
                  </tr>
                </table>
              </td>
            </tr>


            <tr>
              <td class="footer" bgcolor="#4b7006">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td align="center" class="footercopy">
                      <p>Stadio Italiano di Concepción <?php echo $anno  ?><br />
                        
                        <a href="mailto:circolo@enti-italiani.cl">
                          <font color="#ffffff">circolo@enti-italiani.cl</font>
                        </a>


                      </p>
                     
                    </td>
                  </tr>
                  <tr>
              
                  </tr>
                </table>
              </td>
            </tr>
          </table>

        </td>
      </tr>
    </table>

  </div>




</body>

</html>
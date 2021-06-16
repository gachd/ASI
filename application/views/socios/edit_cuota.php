<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Document</title>
  
</head>
<style>
  .tbl-afiliacion{ color: #353535;
                   font-size: 10px;
                   text-transform: capitalize; 
                   border: 1px #b9b6b6  solid;
                 }
  .n_registro{
    text-align: center;

  }

  .n_registro input {
    height: 10px;
  }

  .card-title{border-left: 3px solid #4b7006;
    color: #4b7006;
    margin: 5px 0px 5px 0px;
    padding: 10px;
    font-weight: 600;
    text-transform: uppercase;
  }



.bs-callout {
    /*padding: 20px;*/
    padding:0px 10px;
    margin: 2px 5px;
    border: 1px solid #eee;
    border-left-width: 5px;
    border-radius: 3px;
}
.bs-callout-green h4 {
    color: #4b7006;
    }
  .bs-callout-green {
    border-left-color: #4b7006;
    width: 30%;
    float: left ;

}

.tbl-datos{font-size: 11px; text-transform: uppercase;}
.pat{font-size: 10px;}
.box-pat{    max-height: 127px;
    overflow: auto;}
.box-pat > ul{padding-left: 5px;}
.box-pat > ul > li > a {color: #333;}


  /*tab panel*/
  .nav-tabs { border-bottom: 2px solid #DDD; }
    .nav-tabs > li.active > a, .nav-tabs > li.active > a:focus, .nav-tabs > li.active > a:hover { border-width: 0; }
    .nav-tabs > li > a { border: none; color: #ffffff;background: #4b7006 ;height: 50px;  }
        .nav-tabs > li.active > a, .nav-tabs > li > a:hover { border: none;  color: #4b7006  !important; background: #fff; }
        .nav-tabs > li > a::after { content: ""; background: #4b7006 ; height: 2px; position: absolute; width: 100%; left: 0px; bottom: -1px; transition: all 250ms ease 0s; transform: scale(0); }
    .nav-tabs > li.active > a::after, .nav-tabs > li:hover > a::after { transform: scale(1); }
.tab-nav > li > a::after { background: ##4b7006  none repeat scroll 0% 0%; color: #fff; }
.tab-pane { padding: 15px 0; }
.tab-content{padding:20px;overflow: hidden;}
.nav-tabs > li  {width:25%; text-align:center;}
.card {background: #FFF none repeat scroll 0% 0%; box-shadow: 0px 1px 3px rgba(0, 0, 0, 0.3); margin-bottom: 30px; }


@media all and (max-width:724px){
.nav-tabs > li > a > span {display:none;} 
.nav-tabs > li > a {padding: 5px 5px;}
}

table.registro_socios{font-size: 12px;}
table.registro_socios tbody{text-align: center;}
.r_coorp{text-align: left;}

.historial{max-height: 240px;
           overflow: overlay;}
table.historial_coorp{width: 100%; font-size: 12px;}
table.historial_coorp th{
                          vertical-align: bottom;
                          border-bottom: 2px solid #dee2e6;
                          color: #555555;
                          padding: 1.05rem 0.75rem;
                          text-transform: capitalize;
                          letter-spacing: 1px;
                        }

    table.historial_coorp tr{    padding-bottom: 20px;}
    table.historial_coorp tr:last-child {
    border-bottom: none;
}
table.historial_coorp td{border-top: 1px solid #ccc;
  padding: 1.05rem 0.75rem;}

  table.datos_coorp{font-size: 12px; text-transform: capitalize;}
  table.datos_coorp td{padding: 4px 3px; }

.n_accion{    font-size: 50px;
    text-align: center;
}

.desc_accion{border-right: none; border-left: none;}

.desc_accion .list-group-item:first-child {border-radius:  none;}

/*==================================================
 * left tab
 * ===============================================*/

 
 
 .tabs-left > .nav-tabs {
    float: left;
    /*margin-right: 19px;*/
    border: none;
}

.tabs-below > .nav-tabs, .tabs-right > .nav-tabs, .tabs-left > .nav-tabs {
    border-bottom: 0;
}

.tabs-left > .nav-tabs > li, .tabs-right > .nav-tabs > li {
    float: none;
    text-align: left;
    width: 100%;
}

.tabs-left > .nav-tabs > li > a {
    margin-right: -1px;
    -webkit-border-radius: 4px 0 0 4px;
    -moz-border-radius: 4px 0 0 4px;
    border-radius: 4px 0 0 4px;
}
.tabs-left > .nav-tabs > li > a, .tabs-right > .nav-tabs > li > a {
    min-width: 74px;
    margin-right: 0;
    margin-bottom: 3px;
    background-color: #4b7006;
    border-radius:0px;
    color: white;
    font-size: 11px;
}

.tabs-left > .nav-tabs .active > a, .tabs-left > .nav-tabs .active > a:hover, .tabs-left > .nav-tabs .active > a:focus {
    border-color: #ddd transparent #ddd #ddd;
      background-color: #fff;
color: dimgrey;
border:none;
}

.left-tab-process .tab-content{
  background-color:#fff;
      margin-left: 131px;
      padding: 0px 15px;}

.tab-content > .active, .pill-content > .active {
    display: block;
}

.book-process-ltab{
  max-width:131px;}
  
.left-tab-process .tab-pane{
    padding: 0px 1px;
    min-height: 442px;
}

.left-tab-process h4{
  color:#536779;}


  
.term-fa{
margin-right: 7px;
    font-size: 11px;
    margin-left: -18px;
    color: #2EA72F;}
    
.tac-content{
    background-color:#ccc;}
  
  
.det_accion{ border-right: none;
border-left: none; }

table#reg_accion thead>tr>td{background: #f5f5f5;
                            text-transform: uppercase;
                            font-size: 11px;
                            vertical-align: inherit;}
table#cargas thead>tr>td{background: #f5f5f5;
                            text-transform: uppercase;
                            font-size: 11px;
                            vertical-align: inherit;}

table#cargas tbody>tr>td{font-size:10px;}
table#tablacargas  tbody>tr>td{font-size:12px;}                            
 
.bloqueado{color:#9a9a99; background: #yellow;}


#contenedor {
  width: 99%;
  margin: auto;
}
 
  @media (max-width:768px){
   
}
 

 
   /*==================================================
}
}
 * left tab
 * ===============================================

*/
</style>
<body>
 <?php 
           setlocale(LC_ALL, 'es_ES').': ';

    if(!empty($cuotaOrd)){
  foreach ($cuotaOrd as $co) {
     $valor = $co -> valor ;
     $emision = $co -> fecha_emision ;
     $vcto = $co -> fecha_vcto ;
     $sem = $co -> semestre ;
     $stadio = $co -> valor_stadio ;
     $concordia = $co -> valor_concordia ;
     $atletico = $co -> valor_atletico ;
     $centro = $co -> valor_centro ;
     $scuola = $co -> valor_scuola ;
  }}
?>
<div class="well col-sm-6">          
    <div class="row">
      <center>
        <label for="input-nombre" class="control-label" style="font-size: 20px">Valor Semestral Cuota</label> 
      </center>
    </div>

        <div class="col-sm-6 col-md-offset-3">
          <div class="input-group">
              <span class="input-group-addon"><i class="glyphicon glyphicon-usd"></i></span>
              <input type="number" name="cuotaSem" id="cuotaSem" class="form-control" value="<?php echo $valor ?>"> 
          </div>
        </div>
     
     </div>
     <div class="well col-sm-6" id="semestre1" >
      <div class="row">
      <center><label style="font-size: 20px">Periodo <?php echo $sem ?></label></center>
     </div>

       <label class="col-sm-2 ">Emisión</label>
        <div class="col-sm-4">
       <input class="form-control w_fecha" type="text" name="emi_sem1" id="emi_sem1"  value="<?php echo $emision ?>">
       </div>
       <label class="col-sm-2 control-label">Vencimiento</label>
        <div class="col-sm-4">
       <input class="form-control w_fecha" type="text" name="venc_sem1" id="venc_sem1"  value="<?php echo $vcto ?>">
       </div>
     </div>     
       <div class="control-label">
      <div class="col-md-12"><center><label style="font-size: 1.2em">VALORES POR CORPORACIONES</label></center></div>
        <form class="form-inline" id="corp">
        
          <div class="col-md-4 col-sm-6 col-xxs-12">
          <div class="panel panel-success">
             <div class="panel-heading"><center>CENTRO ITALIANO DE CONCEPCION</center></div>
             <div class="panel-body">
              <div class="input-group">
              <span class="input-group-addon"><i class="glyphicon glyphicon-usd"></i></span>
              <input type="number"  name="cuotaCentro" id="cuotaCentro" class="form-control" value="<?php echo $centro ?>">
                        
              </div>

             </div>
          </div>
          </div>
          <div class="col-md-4 col-sm-6 col-xxs-12">
          <div class="panel panel-success">
             <div class="panel-heading"><center>STADIO ITALIANO DI CONCEPCION</center></div>
             <div class="panel-body">
             <div class="input-group">
              <span class="input-group-addon"><i class="glyphicon glyphicon-usd"></i></span>
              <input type="number" name="cuotaStadio" id="cuotaStadio" class="form-control" value="<?php echo $stadio ?>">
              </div>
             </div>
          </div>
          </div>
          
          <div class="col-md-4 col-sm-6 col-xxs-12">
          <div class="panel panel-success">
             <div class="panel-heading"><center>STADIO ATLETICO ITALIANO</center></div>
             <div class="panel-body">
              <div class="input-group">
              <span class="input-group-addon"><i class="glyphicon glyphicon-usd"></i></span>
              <input type="number" name="cuotaAtletico" id="cuotaAtletico" class="form-control" value="<?php echo $atletico ?>">
              </div>
            </div>
          </div>
          </div>   
          <div class=" col-md-offset-2 col-md-4 col-sm-6 col-xxs-12">
          <div class="panel panel-success">
             <div class="panel-heading"><center>SOCIEDAD ITALIANA DE SOCORROS MUTUOS</center></div>
             <div class="panel-body">
             <div class="input-group">
              <span class="input-group-addon"><i class="glyphicon glyphicon-usd"></i></span>
              <input type="number" name="cuotaSocorros" id="cuotaSocorros" class="form-control"  value="<?php echo $concordia ?>">
              </div>
            </div>
          </div>
          </div> 
          <div class="col-md-4 col-sm-6 col-xxs-12">
          <div class="panel panel-primary">
             <div class="panel-heading"><center>SCUOLA ITALIANA DI CONCEPCION</center></div>
             <div class="panel-body">
              <div class="input-group">
              <span class="input-group-addon"><i class="glyphicon glyphicon-usd"></i></span>
              <input type="number" name="cuotaScuela" id="cuotaScuola" class="form-control"  value="<?php echo $scuola ?>">
              </div>
             </div>
          </div>
          </div>          
          
        
       </form>
      </div>
  </body>

      <script type="text/javascript">
  $.datepicker.regional['es'] = {
 closeText: 'Cerrar',
 prevText: '<Ant',
 nextText: 'Sig>',
 currentText: 'Hoy',
 monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
 monthNamesShort: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
 dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
 dayNamesShort: ['Dom','Lun','Mar','Mié','Juv','Vie','Sáb'],
 dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sá'],
 weekHeader: 'Sm',
 dateFormat: 'yy/mm/dd',
 firstDay: 1,
 isRTL: false,
 showMonthAfterYear: false,
 yearSuffix: ''
 };
 $.datepicker.setDefaults($.datepicker.regional['es']);
$(function () {
$("#emi_sem1").datepicker();
});
$(function () {
$("#venc_sem1").datepicker();
});
$(function () {
$("#emi_sem2").datepicker();
});
$(function () {
$("#venc_sem2").datepicker();
});
  $(document).ready(function(){
     $('#reset').click(function() {
          setTimeout("window.location.href = '<?php echo base_url()?>socios/Nuevacuota'",500);  
  });
});


  $(document).ready(function(){
     $('#cuotaCentro').attr('disabled','disabled');
    $('#cuotaStadio').attr('disabled','disabled');
    $('#cuotaScuola').attr('disabled','disabled');
    $('#cuotaSocorros').attr('disabled','disabled');
    $('#cuotaAtletico').attr('disabled','disabled');


    

  });
  jQuery('#cuotaCentro').blur(function(){

     var valor = $('#cuotaCentro').val();
     var sem = $('#cuotaSem').val();
    

   if(valor > sem){
   // alert('error');
    $('#cuotaStadio').attr('disabled','disabled');
    $('#cuotaScuola').attr('disabled','disabled');
    $('#cuotaSocorros').attr('disabled','disabled');
    $('#cuotaAtletico').attr('disabled','disabled');
    $('#cuotaCentro').focus();
   }else{
     var confirma = confirm("Es correcto el valor ingresado?");
      //  $(this).prop("checked", returnVal);
      if(confirma && valor !=0){

    $('#cuotaCentro').attr('disabled','disabled');
    $('#cuotaStadio').removeAttr('disabled','disabled');
    $('#cuotaScuola').attr('disabled','disabled');
    $('#cuotaSocorros').attr('disabled','disabled');
    $('#cuotaAtletico').attr('disabled','disabled');
       }      
   
   } 

});
  jQuery('#cuotaStadio').blur(function(){

     var centro = $('#cuotaCentro').val();
     var sem = $('#cuotaSem').val();
     var stadio = $('#cuotaStadio').val();
     var sum = parseFloat(centro)+ parseFloat(stadio);
    

   if(sum > sem){   // alert('error');
   
    $('#cuotaScuola').attr('disabled','disabled');
    $('#cuotaSocorros').attr('disabled','disabled');
    $('#cuotaAtletico').attr('disabled','disabled');
    $('#cuotaStadio').focus();
   }else{
      var confirma2 = confirm("Es correcto el valor ingresado?");
      //  $(this).prop("checked", returnVal);
      if(confirma2 && stadio !=0){
     $('#cuotaStadio').attr('disabled','disabled');
     $('#cuotaAtletico').removeAttr('disabled','disabled');
      $('#cuotaScuola').attr('disabled','disabled');
    $('#cuotaSocorros').attr('disabled','disabled');
       }   
     
    
   } 

});
  jQuery('#cuotaAtletico').blur(function(){

     var centro = $('#cuotaCentro').val();
     var sem = $('#cuotaSem').val();
     var stadio = $('#cuotaStadio').val();
     var atletico = $('#cuotaAtletico').val();

     var sum = parseFloat(centro)+ parseFloat(stadio) + parseFloat(atletico);
    

   if(sum > sem){   // alert('error');
   
    $('#cuotaScuola').attr('disabled','disabled');
    $('#cuotaSocorros').attr('disabled','disabled');    
    $('#cuotaAtletico').focus();
   }else{

       var confirma3 = confirm("Es correcto el valor ingresado?");
      //  $(this).prop("checked", returnVal);
      if(confirma3 && atletico !=0){
     $('#cuotaAtletico').attr('disabled','disabled');
     $('#cuotaSocorros').removeAttr('disabled','disabled');
      $('#cuotaScuola').attr('disabled','disabled');
       }  
      
     
    
   } 

});
  jQuery('#cuotaSocorros').blur(function(){

     var centro = $('#cuotaCentro').val();
     var sem = $('#cuotaSem').val();
     var stadio = $('#cuotaStadio').val();
     var atletico = $('#cuotaAtletico').val();
     var socorros = $('#cuotaSocorros').val();

     var sum = parseFloat(centro)+ parseFloat(stadio) + parseFloat(atletico) + parseFloat(socorros);
    

   if(sum == sem){   // alert('error');
   var confirma3 = confirm("Es correcto el valor ingresado?");
      //  $(this).prop("checked", returnVal);
      if(confirma3 && socorros !=0){
     $('#cuotaSocorros').attr('disabled','disabled');
      $('#cuotaScuola').removeAttr('disabled','disabled');  
       }  
      
    
   }else{

      $('#cuotaSocorros').focus();      
      $('#cuotaScuola').attr('disabled','disabled');   
    
   } 

});

  jQuery('#cuotaSem').blur(function(){

     
     var sem = $('#cuotaSem').val();
     if(sem != null){
       var returnVal = confirm("Es correcto el valor ingresado?");
      //  $(this).prop("checked", returnVal);
      if(returnVal){
          $('#cuotaSem').attr('disabled','disabled');  
          $('#cuotaSem').closest('.form-group').removeClass('has-error has-feedback').addClass('has-success has-feedback');
          $('#cuotaSem').closest('.input-group').append('<span class="input-group-addon"><i class="glyphicon glyphicon-ok"></i></span>');
           $('#cuotaCentro').removeAttr('disabled','disabled'); 
         
        }
       
     }

});
  jQuery('#cuotaScuola').blur(function(){

     
     var scuo = $('#cuotaScuola').val();
     if(scuo != null){
       var returnVal = confirm("Es correcto el valor ingresado?");
      //  $(this).prop("checked", returnVal);
      if(returnVal){
      $('#cuotaScuola').attr('disabled','disabled');  
      $('#cuotaScuola').closest('.form-group').removeClass('has-error has-feedback').addClass('has-success has-feedback');
      $('#cuotaScuola').closest('.input-group').append('<span class="input-group-addon"><i class="glyphicon glyphicon-ok"></i></span>');
           
         
        }
       
     }

});
/*$(document).ready(function () {
jQuery.validator.setDefaults({
            highlight: function (element, errorClass, validClass) {
                if (element.type === "radio") {
                    this.findByName(element.name).addClass(errorClass).removeClass(validClass);
                } else {
                    $(element).closest('.form-group').removeClass('has-success has-feedback').addClass('has-error has-feedback');
                    $(element).closest('.form-group').find('i.fa').remove();
                    $(element).closest('.form-group').append('<i class="fa fa-exclamation fa-lg form-control-feedback"></i>');
                }
            },
            unhighlight: function (element, errorClass, validClass) {
                if (element.type === "radio") {
                    this.findByName(element.name).removeClass(errorClass).addClass(validClass);
                } else {
                    $(element).closest('.form-group').removeClass('has-error has-feedback').addClass('has-success has-feedback');
                    $(element).closest('.form-group').find('i.fa').remove();

                    $(element).closest('.form-group').append('<i class="fa fa-check fa-lg form-control-feedback"></i>');
                }
            }
        });});*/
</script>
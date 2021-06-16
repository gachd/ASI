<style type="text/css">
	.sector{ letter-spacing: 5px; }
	.nav-tabs { border-bottom: none;}
    .nav-tabs > li.active > a, .nav-tabs > li.active > a:focus, .nav-tabs > li.active > a:hover { border-width: 0; }
    .nav-tabs > li > a { border: none; color: #666; }
        .nav-tabs > li.active > a, .nav-tabs > li > a:hover { border: none; color: #4285F4 !important; background: transparent; }
        .nav-tabs > li > a::after { content: ""; background: #4285F4; height: 2px; position: absolute; width: 100%; left: 0px; bottom: -1px; transition: all 250ms ease 0s; transform: scale(0); }
    .nav-tabs > li.active > a::after, .nav-tabs > li:hover > a::after { transform: scale(1); }
.tab-nav > li > a::after { background: #21527d none repeat scroll 0% 0%; color: #fff; }
.tab-pane { padding: 15px 0;  overflow: auto;}
.tab-content{padding:20px}

.card {background: #FFF none repeat scroll 0% 0%; box-shadow: 0px 1px 3px rgba(0, 0, 0, 0.3); /*margin-bottom: 30px;*/ }

.bs-callout {
    padding: 13px 3px;
    margin: 20px 0;
    border: 1px solid #eee;
    border-left-width: 5px;
    border-radius: 3px;
	overflow:hidden;
}


.bs-callout h4 {
    font-size: 18px;
    letter-spacing: 5px;
    margin-top: 0px;
    text-transform: uppercase;
    color: darkgray;
	margin-left:15px;
}

.tb-dep-sectores{font-size: 10px;
letter-spacing: 1px;
text-transform: uppercase;}

.alert-porcentaje{    background: #ffbfbf;
    font-weight: 600;
    border: 2px solid #fff;}

    .glyphicon-exclamation-sign{    color: #ca1414;
    font-size: 12px;
    padding-right: 6px;}
</style>

<div id="page-wrapper">
<div class="container-fluid">
	


<div class="col-md-12">
            <div class="panel panel-default">
                <div class="card">
                        <ul class="nav nav-tabs">
                            <li class=""><a href="#tab1default" data-toggle="tab">Default 1</a></li>
                            <li class=""><a href="#tab2default" data-toggle="tab">Default 2</a></li>
                            <li class=""><a href="#tab3default" data-toggle="tab">Default 3</a></li>
                            <li class="dropdown active">
                                <a href="#" data-toggle="dropdown">Dropdown <span class="caret"></span></a>
                                <ul class="dropdown-menu" role="menu">
                                    <li class="active"><a href="#tab4default" data-toggle="tab">Default 4</a></li>
                                    <li class=""><a href="#tab5default" data-toggle="tab">Default 5</a></li>
                                </ul>
                            </li>
                        </ul>
                </div>
                <div>
                    <div class="tab-content">
                        <div class="tab-pane fade" id="tab1default">

                        	<?php
                        	  foreach ($sectores as $s) {

                        	  	echo '
                        	  	<div class="col-md-2">
                                <div class="panel panel-default">
                                <div class="panel-heading">'.$s -> nombre.'</div>
  <div class="panel-body" style="padding: 5px;">

                        	  	<table class="tb-dep-sectores">
			                        <thead>
				                <tr>
				                	<th  colspan="2" >Depend.</th>
                                    <th>%</th>
                                    
                               </tr>
                                    </thead>
                                    <tbody>';

                                $dep_sector= $this->model_trabajos->getDepenID($s -> id);
                                foreach ($dep_sector as $ds) {

                                	$porc_dep=$this->model_trabajos->dep_planificadovsrealizado($ds -> dep_id);

                                    $class="";

                                	foreach ($porc_dep as $pd) {

                                       if($pd->porcentaje < 50){ $class="alert-porcentaje";}


                                		echo' <tr class="'.$class.'">';

                                        if($pd->porcentaje < 50){
                                         echo'<td><span class="glyphicon                 glyphicon-exclamation-sign" aria-hidden="true"></span></td>';

                                        }else{
                                            echo'<td></td>';
                                        }

                               echo' <td>'.$ds -> dep_nombre.'</td>
                                <td>'.$pd -> porcentaje.'%</td>
                                </tr>';
                                	}

                                }


                       

                               
                                    
                                    echo'</tbody>
                                </table>
                                </div>
                                </div>
                                </div>';
                        	  	# code...
                        	  }

                        	 ?>

            



                
                        </div>
                        <div class="tab-pane fade" id="tab2default">Default 2</div>
                        <div class="tab-pane fade" id="tab3default">Default 3</div>
                        <div class="tab-pane fade active in" id="tab4default">Default 4</div>
                        <div class="tab-pane fade" id="tab5default">Default 5</div>
                    </div>
                </div>
            </div>
</div>

	
</div>
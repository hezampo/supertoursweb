<?php 

if(isset($this->data['reserve']) && isset($_SESSION['login'])){
	$valida = false;
	$reserva = $data['reserve'];
	$rastro = $data['rastro'];
	$pagado = $this->data['pagado'];
	$cliente = $data['cliente'];
	$pickup1 = $data['pickup1'];
	$pickup2 = $data['pickup2'];
	$drop1 = $data['drop1'] ;
	$drop2 =	$data['drop2'] ;
	$extencion1 = $data['extencion1'] ;
	$extencion2 = $data['extencion2'] ;
	$extencion4	= $data['extencion4'] ;
	$extencion3	= $data['extencion3'] ;
	$agencia = $data['agencia'];
	$disponible = $this->data['disponible'];
	$agen_account = $data['agen_account'];
	$reserva_a = $data['reserver_a'];
	$userA = $data['userA'];
	$area =	$data['areas'];
	$extenFrom1 = $data['extenFrom1'];
	$extenTo1 = $data['extenTo1'];
	$extenFrom2 = $data['extenFrom2'];
	$extenTo2 = $data['extenTo2'];
	
	$to_areas = $data['to_areas'];
	$dato_pago = $reserva->pago;
	$var = explode('-',$dato_pago);
	$typo_pago = strtoupper($var[0]);
	if(isset($var[1])){
		$typo_saldo = $var[1];
		$rest_comision = 0;
	}else{
		$typo_saldo = 'FULL';
		$rest_comision = isset($reserva_a->agency_fee)?$reserva_a->agency_fee:0;
	}
	
	if($agencia->type_rate == 0){
		$precioExt = $extencion1->precio + $extencion2->precio + $extencion3->precio + $extencion4->precio ;	
	}else{
		$precioExt = $extencion1->precio_neto + $extencion2->precio_neto + $extencion3->precio_neto + $extencion4->precio_neto ;	
	}

	$transporadult = $reserva->precioA;
	$transporechil = $reserva->precioN;
	$subtoadult = $reserva->precioA + $precioExt;
    $subtochild = $reserva->precioN + $precioExt;
	$totaltotal = ($subtoadult * $reserva->pax) + ($subtochild * $reserva->pax2);
	
	if($typo_pago==strtoupper('Credit Card+ 4 % FEE')){
		$fee = $totaltotal *0.04;	
	}else{
		$fee = 0;
	}
	$totaltotal = $totaltotal + $fee  + $reserva->extra_charge	- $rest_comision;
	
	//conf Other Amount
	if($reserva->otheramount!=0){
		$saldoxPagar = $reserva->otheramount-$pagado;
	}else{
		$saldoxPagar = $totaltotal- $pagado;
	}
	
	$adaptacion = "";
	if($extencion1->id != 0){
		$adaptacion .= "$('#pickup1').attr('disabled','true');";
		$adaptacion .= "$('#pickup1').attr('value','');";
		$adaptacion .= "$('#id_p1').attr('value','');";
		$precio = ($agencia->type_rate==0)?$extencion1->precio:$extencion1->precio_neto;
		$_SESSION['price']['exten1'] =  $precio;
	}
	if($extencion2->id != 0){
		
		$adaptacion .= "$('#dropoff1').attr('disabled','true');";
		$adaptacion .= "$('#dropoff1').attr('value','');";
		$adaptacion .= "$('#id_dropoff1').attr('value','');";
		$precio = ($agencia->type_rate==0)?$extencion2->precio:$extencion2->precio_neto;
	    $_SESSION['price']['exten2'] =  $precio;
	}
	if($extencion3->id != 0){
		$adaptacion .= "$('#pickup2').attr('disabled','true');";
		$adaptacion .= "$('#pickup2').attr('value','');";
		$adaptacion .= "$('#id_p2').attr('value','');";
		$precio = ($agencia->type_rate==0)?$extencion3->precio:$extencion3->precio_neto;
		$_SESSION['price']['exten3'] =  $precio;
	}
	if($extencion4->id != 0){
		$adaptacion .= "$('#dropoff2').attr('disabled','true');";
		$adaptacion .= "$('#dropoff2').attr('value','');";
		$adaptacion .= "$('#id_dropoff2').attr('value','');";
		$precio = ($agencia->type_rate==0)?$extencion4->precio:$extencion4->precio_neto;
		$_SESSION['price']['exten4'] = $precio;
	}
	
}else{
	echo 'Acceso denegado';
	exit();
}
$login = $_SESSION['login'];


?>

<link rel="stylesheet" type="text/css" href="<?php echo $data['rootUrl']; ?>global/css/autocompletar/css/style.css" />
<link rel="stylesheet" type="text/css" href="<?php echo $data['rootUrl']; ?>global/css/jquery.notice2.css"/>  
<script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/jquery.notice.js"></script>
<script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/jquery.ausu-autosuggest.js"></script>
<script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/Concurrent.Thread.js"></script>

<script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/form.js"></script>
<!--jquery para el calendario-->
<link rel="stylesheet" type="text/css" href="<?php echo $data['rootUrl']; ?>global/css/blitzer/jquery-ui-1.8.16.custom.css" />
<script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/jquery-ui-1.8.18.custom.min.js"></script>

<link rel="stylesheet" type="text/css" href="<?php echo $data['rootUrl']; ?>global/css/modal.css"/>

<style type="text/css" media="screen">
	 #search{
	    cursor:pointer;
	 }
         #reservation{
             width:300px !important;
         }
	</style>
    <script>
	

    </script>

    <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.2/themes/smoothness/jquery-ui.css" />
 
 

<div id="header_page" >
<div class="header">Reservas [ <strong style="color:#F00">read only</strong>  ]</div>
        <div  id="toolbar">
            <div class="toolbar-list">
                <u>

                    <li class="btn-toolbar" id="btn-cancel1">
                        <a  class="link-button" >
                            <span class="icon-back" title="Editar" >&nbsp;</span>
                            Back
                        </a>
                    </li>                      
                </ul>
                <div class="clear"></div>
            </div>
            <div class="clear"></div>
        </div>
        </div>
        <!-- header options -->
<div id="info-group2">
   <div id="cancelation">
       <div class="ho">CANCELATION <span>#</span></div>
       <div id="cancel">00000</div>
   </div>
   <div id="reservation" style="width:150px">
       <div class="ho">RESERVATION <span>#</span></div>
       <div id="reser"><?php echo $reserva->codconf;?><input disabled="disabled"  type="hidden" /></div>
   </div>
   <div id="status">
       <div class="ho">STATUS</div>
       <div id="stat"><?php echo $reserva->estado;?></div>
   </div>
</div>


<div id="content_page"  >

        <div id="serpare"> 
    <form id="formula" class="form" action="<?php echo $data['rootUrl']; ?>admin/reservas/save-edit-reserve" method="post" name="formula" >

	<input    disabled="disabled"     type="hidden"  id="vista" value="1" />
	<input    disabled="disabled"     name="id" type="hidden"  id="id"  value="<?php if(isset($reserva)){echo $reserva->id;}?>" />
	
        <fieldset id="liderpax" style="margin-left: 0px;"><legend>LEADER PASS</legend>
        <table>
            <tr>
                                    <td >
                                        <div id="opera" class="input" style="padding-top:5px;">        
                    	<table>
                        	<tr>
                            	<td>
                                                        <label style="" id="label" >SEARCH </label>
                                                    </td>
                                                    <td>
                                                        <div class="ausu-suggest" id="opera">
                                                            <input type="text" size="65" value="<?php if (isset($cliente) && isset($reserva)) {
    if ($cliente->id == $reserva->id_clientes) {
        echo $cliente->lastname . " " . $cliente->firstname . " - E-Mail -" . $cliente->username;
    }
} ?>" name="leader" id="leader" autocomplete="off" />
                                	         
                                                            <input type="hidden" size="4" value="" name="id_leader" id="id_leader" autocomplete="off" disabled="disabled"  readonly="readonly"/>
                                                        </div>
                                                    </td>
                                                    <td>&nbsp;&nbsp;</td>
                                                    <td title="">
                                                        <div  class="ausu-suggest" style="margin-top:-5px; margin-left:2px; display:none">		
                                                            <a id="newClient" style="cursor:pointer; visibility:hidden;" ><img src="<?php echo $data['rootUrl']; ?>global/img/new.png" alt=""  align="absmiddle" border="0"  style="padding-bottom:0px;" /></a>
                                                        </div>	
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div id="opera" class="input" >
                                           <table width="100%">
                                                <tr>
                                                    <td width="" align="right">

                                                        <input type="hidden" name="idCliente"   id="idCliente"  value="<?php
                                                        if (isset($cliente) && isset($reserva)) {
                                                            if ($cliente->id == $reserva->id_clientes) {
							echo trim($reserva->id_clientes);
						}
                                                        }
                                                        ?>" />
                                                        <input type="hidden" name="idPagador" id="idPagador" value="0"  />
                                                        <input type="hidden" name="idPagador_aux" id="idPagador_aux" value="0"  />
                                                        <input type="hidden" name="cliente_apto" id="cliente_apto" value="0"  />
                                                        <label style="" id="labeldere12">FIRST NAME</label>		
                                </td>
                                                    <td width="">
                                                        <input name="firstname1" type="text"  id="firstname1" size="20" maxlength="20" value="<?php if (isset($reserva)) {echo $reserva->firsname;} ?>" />	
                                </td>
                                                    <td width="" align="right"> 
                                                        <label style="" id="labeldere12" >LAST NAME </label>
                                </td>
                                                    <td width="">  
                                                        <input name="lastname1" type="text"  id="lastname1" size="20" maxlength="20" value="<?php if ( isset($reserva)) {echo $reserva->lasname;} ?>" />
                                </td>
                            </tr>
                    		<tr>
                                                    <td align="right">
                                                        <label style="" id="labeldere12">PHONE </label>
                                </td>
                                <td>
                                                        <input name="phone1" type="text"  id="phone1" size="20" maxlength="20" value="<?php if (isset($cliente) && isset($reserva)) {
                                                            if ($cliente->id == $reserva->id_clientes) {
                                                                echo $cliente->phone;
                                                            }
                                                        } ?>" /> 
                                                        <input  type="hidden" name="type_cliente"  id="type_cliente" value="<?php if (isset($cliente) && isset($reserva)) {
                                                            if ($cliente->id == $reserva->id_clientes) {
                                                                echo $cliente->tipo_client;
                                                            }
                                                        } ?>" />       	
                                </td>
                                                    <td align="right"> 
                                                        <label style="" id="labeldere12">E-MAIL </label>
                                </td>
                                <td>  
                                                        <input name="email1" type="text"  id="email1" size="20" value="<?php if ( isset($reserva)) {echo $reserva->email;} ?>"/>
                                </td>
                            </tr>
                    	</table>   
                    </div>
                </td>
            </tr>
        </table>
       </fieldset>
			
            
             <fieldset id="inputype" style="width:200px;margin-right:0px;margin-left: 0px;"><legend>INPUT TYPE</legend>
               <div id="opera" class="input">  
             <table width="100%" >
             	<tr align="left">
                	<td >
                    	 <label style="" id="label">CALL CENTER</label>
                    </td>
                    <td >
                                <input name="nombre" type="text" id="nombre" value="<?php echo  trim($login->nombre.' ('.$login->usuario.')');?>" readonly="readonly"/>
                    </td>
                </tr>
                        <tr>
                            <td colspan="2" >
                	<table width="100%">
                                <tr>
                            <td width="10%">
                                  <label><strong>AGENCY</strong></label>
                            </td>
                            <td width="40%">
                                 <div class="ausu-suggest" >
                                                <input name="agency" type="text"  id="agency" size="19" maxlength="30" value="<?php echo $agencia->company_name;?>"  autocomplete="off"  disabled="disabled"  />
                                                <input type="hidden" size="4" value="<?php echo $agencia->id;?>" name="id_agency" id="id_agency" autocomplete="off"  readonly="readonly"/>
                                                <input type="hidden" size="4" value="<?php echo $agencia->type_rate;?>" name="type_rate" id="type_rate" autocomplete="off"  readonly="readonly"/>
                                                <input type="hidden" size="4" value="0" name="disponible" id="disponible" autocomplete="off"  readonly="readonly"/>
                                                <input type="hidden" size="4" value="0" name="comision" id="comision" autocomplete="off"  readonly="readonly"/>
                                  </div>
                            </td>
                            <td width="10%">
                                 <label><strong>Employ</strong></label>
                            </td>
                            <td width="40%">
                                 <div class="ausu-suggest" >
                                                <input style="width:120px;" name="uagency" type="text"  id="uagency" size="11" maxlength="30" value="<?php echo ($agencia->id != -1)?$userA->firstname.' '.$userA->lastname:'';?>"  />
                                                <input type="hidden" size="4" value="<?php echo ($agencia->id != -1)?$userA->id:'';?>" name="id_auser" id="id_auser" autocomplete="off" />
                              </div>
                            </td>
                        </tr>
                    </table>
                            </td>
                        </tr>
                <tr><td colspan="2" >&nbsp;</td></tr>
                 <tr><td colspan="2">
                 	<table align="center" cellspacing="10">
                    	<tr valign="top">
                                        <td><label  for="calan_phone"> BY PHONE</label> <input name="canal" <?php if($reserva->canal=='PHONE'){echo ' checked="checked" ';}?>  type="radio" id="calan_phone" value="PHONE" />  </td>
                                        <td><label  for="calan_mail"> BY MAIL</label> <input name="canal" <?php if($reserva->canal=='MAIL'){echo ' checked="checked" ';}?> type="radio"  id="calan_mail"  value="MAIL" /> </td>
                                        <td><label for="calan_web"> WEBSALE </label><input name="canal"  <?php if($reserva->canal=='WEBSALE'){echo ' checked="checked" ';}?> type="radio" id="calan_web" value="WEBSALE" />  </td>
                        </tr>
                    </table>
                            </td>
                        </tr>
             </table>
        </div>
            </fieldset>
            
             <fieldset id="boo" ><legend>BOOKING</legend>
    <input type="hidden" name="id_oneway" id="id_tipo_ticket" value="<?php  if(isset($reserva)){
			if($reserva->tipo_ticket=='oneway'){
				echo 1;
			}else{
				echo 2;
			}
			}?>"/>
    <div id="opera" class="input" style="padding-top:5px;"> <label>ONE WAY </label> <input name="tipo_ticket"  id="oneway" type="radio" value="1"
         <?php if(isset($reserva)){
				if($reserva->tipo_ticket=='oneway'){
					echo ' checked ';
				}
			}?>
            <?php if(isset($reserva)){
				if($reserva->tipo_ticket!='oneway'){
                    echo ' disabled ';
				}
            }?>/></div>
    <div id="opera" class="input" style="padding-top:5px;"> <label>ROUND TRIP </label><input name="tipo_ticket" id="roundtrip" type="radio" value="2" <?php if(isset($reserva)){
            if($reserva->tipo_ticket!='oneway'){
                echo ' checked disabled';
            }
			}?> /> </div>
        <div id="opera" class="input" style="padding-top:5px;"> <label style="padding-right:5px;">TYPE OF PASS </label>
        <select name="tipo_pass" id="tipo_pass" disabled="disabled">
        <option value="0">NO RESIDENT</option>
        <option value="1">RESIDENT</option>
        </select>  </div>
        
          
    <div id="opera" class="input" style="float: right;"><input name="byr" type="checkbox" value="1" <?php if(isset($reserva)){
                if($reserva->customer_disabilities==1){
                    echo ' checked ';
                }
            }?> /><label id="labeldere" style="background-color: rgb(243, 229, 155);"> Customer With Disabilities </label>
    </div>
          <div id="opera" class="input"  style="padding-top:10px; clear:left;">        
          <label style="width:45px"  >ADULT</label>
        <input name="pax" type="number" min="1"  id="pax" size="2" maxlength="2" value="<?php echo $reserva->pax?>"  style="width:50px" onchange="
             var a = document.getElementById('pax').value
        	if (isNaN(a)) { 
            	 return false;
     		}else{
            	 var max = 16-a;
                 if(max<0){
                 	var valor = 16-$('#pax2').val();
                    document.getElementById('pax').value = valor;
                    $('#pax2').attr('max',valor);
                 }else{
                     $('#pax2').attr('max',max);
                     if($('#pax2').val()>max){
                        $('#pax2').attr('value',max);
                     }
                 }
            }
            
        "   />
        </div>
          <div id="opera" class="input"  style="padding-top:10px;">        
          <label style="width:45px"  >CHILD</label>
        <input name="pax2" type="number"  id="pax2" size="2" maxlength="2" value="<?php echo $reserva->pax2?>" style="width:50px" min="0" max="15" onchange="
      		var a = document.getElementById('pax2').value;
        	if (isNaN(a)) { 
            	 return false;
     		}else{
           		 var max = 16-a;
                 if(max<=0){
                 	var valor = 16-$('#pax').val();
                    document.getElementById('pax2').value = valor;
                    $('#pax2').attr('max',valor);
                 }else{
                     if($('#pax').val()>max){
                        $('#pax').attr('value',max);
                     }
                 }
            }"  />
        </div>
          <div id="opera" class="input"  style="padding-top:10px;">        
          <label style="width:45px"  ><strong>TOTAL</strong></label>
        <input name="totalpax" type="text"  id="totalpax" size="2" maxlength="2" value=""  readonly="readonly"/>
        </div>
         <div id="opera" class="input"  style="padding-top:10px;">        
          <label style="width:45px"  >INFANT</label>
        <input name="infat" type="number"  id="infat" size="2" maxlength="2" value="0" min="0" max="16" style="width:50px"  />
        </div>
        
    <!--<div id="opera" class="input" style="padding-right:200px; padding-top:10px;"><input name="byr" type="radio" value="" /><label id="labeldere"> Customer With Disabilities </label></div>-->
        
            </fieldset>
          <!--&nbsp;-->

<table width="200"  cellspacing="0" class="sup" >
  <tr>
        <td width="167" ><label > <strong>SUPERCLUB#</strong></label></td>
        <td width="27"><label id="labeldere"><span id="number_supu">N/A</span></label></td>
  </tr>
  <tr>
    <td><label> <strong>POINTS BALANCE</strong></label></td>
    <td><label id="labeldere"><span id="points">N/A</span></label></td>
  </tr>
  <tr>
    <td><label > <strong>POINTS REQUIRED 
                    <span style="font-size: 8px;">FOR THIS TRIP</span>

</strong></label></td>
    <td><label id="labeldere" >N/A</label></td>
  </tr>
</table>
              <fieldset id="onew" ><legend>ONE WAY</legend>
              
   			  <div id="opera" class="input" style="padding-top:18px; "> 
                     
          <label style="width:75px;"  >DEPARTURE </label><a href="" id="dataclick1" ><img src="<?php echo $data['rootUrl']; ?>global/images/calendar.png" alt=""  align="absmiddle" width="19" height="20" border="0"  /></a>
        <input name="fecha_salida" type="text"  id="fecha_salida" size="10" maxlength="15" value="<?php if(isset($reserva)){echo ($reserva->fecha_salida == "0000-00-00"?"00-00-0000":date('m-d-Y',strtotime($reserva->fecha_salida)));} ?>" autocomplete="off"/>
        </div>
         <div id="opera" class="input"  >        
          <div id="explo">  <label style="width:45px"  > FROM</label></div>
        <div id="explo" align="left"> 
           <select name="fromt"  style="width:125px; height:25px;" id="from">
                       <option value=""></option> 
                <?php foreach($data["areas"] as $e){?>
					  <option value="<?php echo $e["id"]; ?>" <?php if(isset($reserva)){echo (trim($reserva->fromt) == trim($e["id"]))?'selected':'';}else{ echo (trim($e['nombre'] == trim("ORLANDO")?'selected':''));} ?> ><?php echo $e["nombre"]; ?></option>			 
                <?php }?>
           </select>
        </div>
    </div>
         <div id="opera" class="input"  >        
        <div id="explo"><label style="width:45px"  > TO</label></div>
       <div id="explo" align="left">
            <select name="to"  id="to" style="width:130px; height:25px;">
         	<?php foreach($to_areas as $area){ ?>
            	 <option value="<?php echo $area['trip_to'];?>"  <?php echo ($area["trip_to"] == $reserva->tot ? 'selected' : '')?> >
				 <?php echo $area['nombre']; ?>                
                 </option>
            <?php }?>
         </select>
            <input type="hidden" name="valto" id="valto" value="<?php  if(isset($reserva)){echo $reserva->tot;}?>"/>
       </div>
        </div>
		<div id="mascaraP" style="display: none;">
		</div>
		<div id="popup" style="display: none;">
			<div class="content-popup">		
		</div>
		</div>

    <div id="clienteN" style="display:none; width: 700px; margin-left: 100px;" ></div>
		
         <div id="opera" class="input">        
        <div style="width:50px;" id="popup1">  <label style="width:20px"  > TRIP</label><a id="search" style="cursor:pointer;"><img src="<?php echo $data['rootUrl'];?>global/images/search.png" alt=""  align="absmiddle" border="0"  style="padding-bottom:0px;" /></a>
            <input type="hidden" id="valorcomision01" name="valorcomision01" value="<?php echo $subto['comi1']?>" /></div>
        <div style="width:50px;"> <input type="hidden" id="trip_no_c" name="trip_no_c"  value="<?php if(isset($reserva)){echo $reserva->trip_no;}?>"/><input name="trip_no" type="text"  id="trip_no" size="3" maxlength="3" value="<?php if(isset($reserva)){echo $reserva->trip_no;}?>"  readonly="readonly"/>
       </div>
        </div>
          <div id="opera" class="input"  style="clear:right; padding-left:7px;">        
          <div style="width:50px;">  <label style="width:45px"  > DEP.TIME</label></div>
       <div style="width:50px;">
            <input name="departure1" type="text"  id="departure1" size="5" maxlength="8" value="<?php if(isset($reserva)){echo date("g:i a",strtotime($reserva->deptime1));}?>" readonly="readonly"/>
       </div>
        </div>
      <div id="opera" class="input"  style="clear:left; ">        
          <div style="width:265px;">  <label style="width:150px"  >PICK UP POINT/ADDRESS</label></div>
       <div style="width:200px;">
        <div class="ausu-suggest" >
                <input name="pickup1" type="text"  id="pickup1" size="40" maxlength="55" value="<?php if(isset($pickup1) && $pickup1 != ""){echo $pickup1->place;} ?>" autocomplete="off"/>
                <input name="id_p1" type="hidden"  id="id_p1" size="40" maxlength="55" value="<?php if(isset($pickup1)&& $pickup1 != ""){echo $pickup1->id;} ?>" />
         </div>
       </div>
        </div>
          <div id="opera" class="input"  >        
          <div style="width:265px;">  <label style="width:250px"  >DROP OFF POINT/ADDRESS</label></div>
       <div style="width:200px;">
       <div class="ausu-suggest" >
                <input name="dropoff1" type="text"  id="dropoff1" size="39" maxlength="55" value="<?php if(isset($drop1) && $drop1 != ""){echo $drop1->place;} ?>" autocomplete="off"/>
                <input name="id_dropoff1" type="hidden"  id="id_dropoff1" size="40" maxlength="55" value="<?php if(isset($drop1) && $drop1 != ""){echo $drop1->id;} ?>" />
         </div>
       </div>
        </div>
         <div id="opera" class="input"  >        
          <div style="width:50px;">  <label style="width:45px"  >ARR.TIME</label></div>
       <div style="width:50px;">
            <input name="arrival1" type="text"  id="arrival1" size="5" maxlength="8" value="<?php if(isset($reserva)){echo date("g:i a",strtotime($reserva->arrtime1));}?>" readonly="readonly" />
       </div>
        </div>
        
        
         <div id="opera" class="input" style="padding-top:5px;"> <label style="padding-right:5px;"><strong>EXTENSION AREA:</strong></label>
        <select name="ext_from1" id="ext_from1" style='width:123px;' >
         <option value="0"></option>
         <?php foreach($extenFrom1 as $ex){?>
         	<option value="<?php echo $ex['id']?>"  <?php echo ($extencion1->id ==$ex['id'])?' selected ':''; ?> > <?php echo $ex['place'].' '.$ex['address']?></option>
            <?php }?>
         </select></div>
         
          <div id="opera" class="input" style="padding-top:5px;"> <label style="padding-right:5px;"><strong>EXTENSION AREA:</strong></label>
        <select name="ext_to1" id="ext_to1" style='width:123px;'>
          <option value="0"></option>
           <?php foreach($extenTo1 as $ex){?>
         	<option value="<?php echo $ex['id']?>"  <?php echo ($extencion2->id ==$ex['id'])?' selected ':''; ?> > <?php echo $ex['place'].' '.$ex['address']?></option>
            <?php }?>
          </select>  </div>
    <div id="opera" class="input" style="padding-left:13px; clear:right;">
        <label style="width:48px" >ROOM #</label>
        <input name="room1" type="text"  id="room1" size="4" maxlength="6" value="<?php echo $reserva->room1;?>" />
        </div>
        
         <div id="opera" class="input"  style="clear:left; ">  
               
          <div style="width:300px;">  <label style="width:250px"  >EXTENSION PICK UP POINT/ADDRESS</label></div>
       <div style="width:200px;">
       <div class="ausu-suggest" >
                <input name="exten1" type="text"  id="exten1" size="46" maxlength="55" value="<?php echo $reserva->pickup_exten1;?>" <?php if($extencion1->id == 0){echo ' disabled="disabled" ';}?>  autocomplete="off"/>
                <input name="id_ext_pikup1" type="hidden"  id="id_ext_pikup1" size="40" maxlength="55" value="" />
         </div>
       </div>
        </div>
        <div id="opera" class="input" >        
          <div style="width:265px;">  <label style="width:250px"  >EXTENSION DROP OFF POINT/ADDRESS</label></div>
       <div style="width:200px;">
       <div class="ausu-suggest" >
                <input name="exten2" type="text"  id="exten2" size="47" maxlength="55" value="<?php echo $reserva->pickup_exten2;?>"  <?php if($extencion2->id == 0){echo ' disabled="disabled" ';}?>  autocomplete="off"/>
                <input name="id_ext_pikup2" type="hidden"  id="id_ext_pikup2" size="40" maxlength="55" value="" />
         </div>
       </div>
        </div>
        
   </fieldset> 
              
          
          
     <fieldset id="round" style="display:none;"><legend><font color="#990000">ROUND TRIP</font></legend>

   			  <div id="opera" class="input" style="padding-top:18px; "> 
                     
          <label style="width:75px;"  >DEPARTURE </label><a href="" id="dataclick2" ><img src="<?php echo $data['rootUrl']; ?>global/images/calendar.png" alt=""  align="absmiddle" width="19" height="20" border="0"  /></a>
        <input name="fecha_retorno" type="text"  id="fecha_retorno" size="10" maxlength="15" value="<?php if(isset($reserva) && $reserva->tipo_ticket != 'oneway'){echo ($reserva->fecha_retorno == "0000-00-00"?"00-00-0000":date('m-d-Y',strtotime($reserva->fecha_retorno)));}?>" autocomplete="off" />
        </div>
        
         <div id="opera" class="input"  >        
          <div id="explo">  <label style="width:45px"  > FROM</label></div>
        <div id="explo" align="left">
            <select name="fromt2"  style="width:125px; height:25px;" id="from2" >
                <option value=""></option>
               <?php foreach($to_areas as $area){ ?>
                    <option value="<?php echo $area['trip_to'];?>"  <?php echo ($area["trip_to"] == $reserva->fromt2 ? 'selected' : '')?>  >
				 <?php echo $area['nombre']; ?>                
                 </option>
            <?php }?>
					   
        </select></div>
        </div>
        
          <div id="opera" class="input"  >        
          <div id="explo">  <label style="width:45px"  > TO</label></div>
       <div id="explo" align="left">
            <select name="to2"  id="to2" style="width:130px; height:25px;" <?php
//            if($reserva->tipo_ticket=='oneway'){
//                echo ' disabled="disabled" ';
//            }
            ?> >
                <?php foreach($data["to_areas2"] as $area){?>
                    <option value="<?php echo $area['trip_to'];?>"  <?php echo ($area["trip_to"] == $reserva->tot2 ? 'selected' : '')?>  >
                        <?php echo $area['nombre']; ?>
                    </option>
                <?php }?>
         </select>
       </div>
        </div>
        <div id="opera" class="input"  >        
        <div style="width:50px;" id="popup2">  <label style="width:20px"  > TRIP</label><a id="search2" style="cursor:pointer;"><img src="<?php echo $data['rootUrl'];?>global/images/search.png" alt=""  align="absmiddle" border="0"  style="padding-bottom:0px;" />
                <input type="hidden" id="valorcomision02" name="valorcomision02" value="<?php echo $subto['comi2']?>" />
            </a></div>
        <div style="width:50px;"><input type="hidden" id="trip_no2_c" name="trip_no2_c"  value="<?php if(isset($reserva)){echo $reserva->trip_no2;} ?>"/> <input name="trip_no2" type="text"  id="trip_no2" size="3" maxlength="3" value="<?php if(isset($reserva)){echo ($reserva->trip_no2!=0?$reserva->trip_no2:"");} ?>"  readonly="readonly"/>
       </div>
        </div>
          <div id="opera" class="input"  style="clear:right; padding-left:7px;">        
          <div style="width:50px;">  <label style="width:45px"  > DEP.TIME</label></div>
       <div style="width:50px;">
            <input name="departure2" type="text"  id="departure2" size="5" maxlength="8" value="<?php if(isset($reserva)){echo ($reserva->deptime2!="00:00:00"?date("g:i a",strtotime($reserva->deptime2)):"");}?>" readonly="readonly"/>
       </div>
        </div>
        
      <div id="opera" class="input"  style="clear:left; ">        
          <div style="width:265px;">  <label style="width:150px"  >PICK UP POINT/ADDRESS</label></div>
       <div style="width:200px;">
         <div class="ausu-suggest" >
                <input name="pickup2" type="text"  id="pickup2" size="40" maxlength="55" value="<?php if(isset($pickup2)&& $pickup2 != ""){echo $pickup2->place;} ?>" autocomplete="off"/>
                <input name="id_pickup2" type="hidden"  id="id_pickup2" size="40" maxlength="55" value="<?php if(isset($pickup2)&& $pickup2 != ""){echo $pickup2->id;} ?>" />
         </div>
       </div>
        </div>
          <div id="opera" class="input"  >        
          <div style="width:265px;">  <label style="width:250px"  >DROP OFF POINT/ADDRESS</label></div>
       <div style="width:200px;">
       <div class="ausu-suggest" >
                <input name="dpoff2" type="text"  id="dropoff2" size="39" maxlength="55" value="<?php if(isset($drop2)&& $drop2 != ""){echo $drop2->place;} ?>" autocomplete="off"/>
                <input name="id_dropoff2" type="hidden"  id="id_dropoff2" size="40" maxlength="55" value="<?php if(isset($drop2)&& $drop2 != ""){echo $drop2->id;} ?>" />
         </div>
       </div>
        </div>
         <div id="opera" class="input"  >        
          <div style="width:50px;">  <label style="width:45px"  >ARR.TIME</label></div>
       <div style="width:50px;">
            <input name="arrival2" type="text"  id="arrival2" size="5" maxlength="8" value="<?php if(isset($reserva)){echo ($reserva->arrtime2!= "00:00:00"?date("g:i a",strtotime($reserva->arrtime2)):"");}?>" readonly="readonly" />
       </div>
        </div>
        
        
         <div id="opera" class="input" style="padding-top:5px;"> <label style="padding-right:5px;"><strong>EXTENSION AREA:</strong></label>
         <select name="ext_from2" id="ext_from2" style='width:123px;' >
           <option value="0"></option>
           <?php foreach($extenFrom2 as $ex){?>
         	<option value="<?php echo $ex['id']?>"  <?php echo ($extencion3->id ==$ex['id'])?' selected ':''; ?> > <?php echo $ex['place'].' '.$ex['address']?></option>
            <?php }?>
         </select>  </div>
         
          <div id="opera" class="input" style="padding-top:5px;"> <label style="padding-right:5px;"><strong>EXTENSION AREA:</strong></label>
          <select name="ext_to2" id="ext_to2" style='width:123px;'>
          <option value="0"></option>
            <?php foreach($extenTo2 as $ex){?>
         	<option value="<?php echo $ex['id']?>"  <?php echo ($extencion4->id ==$ex['id'])?' selected ':''; ?> > <?php echo $ex['place'].' '.$ex['address']?></option>
            <?php }?>
          </select>  </div>
            <div id="opera" class="input"  style="padding-left:13px; clear:right;">        
          <label style="width:48px"  >ROOM #</label>
        <input name="room2" type="text"  id="room2" size="4" maxlength="6" value="<?php echo $reserva->room2;?>" />
        </div>
         <div id="opera" class="input"  style="clear:left; ">        
          <div style="width:300px;">  <label style="width:250px"  >EXTENSION PICK UP POINT/ADDRESS</label></div>
       <div style="width:200px;">
         <div class="ausu-suggest" >
                <input name="exten3" type="text"  id="exten3" size="47" maxlength="55" value="<?php echo $reserva->pickup_exten3;?>"   <?php if($extencion3->id == 0){echo ' disabled="disabled" ';}?> autocomplete="off" />
                <input name="id_ext_pikup3" type="hidden"  id="id_ext_pikup3" size="40" maxlength="55" value="" />
         </div>
       </div>
        </div>
        <div id="opera" class="input" >        
        <div style="width:265px;"><label style="width:250px"  >EXTENSION DROP OFF POINT/ADDRESS</label></div>
       <div style="width:200px;">
        <div class="ausu-suggest" >
                <input name="exten4" type="text"  id="exten4" size="47" maxlength="55" value="<?php echo $reserva->pickup_exten4;?>"  <?php if($extencion4->id == 0){echo ' disabled="disabled" ';}?>  autocomplete="off" />
                <input name="id_ext_pikup4" type="hidden"  id="id_ext_pikup4" size="40" maxlength="55" value="" />
         </div>
       </div>
        </div>
   </fieldset> 
   
   <table width="246" cellspacing="0" class="sup2" style="margin-top: 2px;">
  <tr>
    <td width="136"><label><strong>QUOTE</strong></label></td>
    <td width="54"><label><strong>Adult</strong></label></td>
    <td width="48"><label><strong>Child</strong></label></td>
  </tr>
  <tr>
    <td><label style="text-align:left;"><strong>Line Transportation</strong></label></td>
    <td><span name ="transporadult" id="transporadult" value=""></span></td>
        <input type="hidden" name ="transadult" id="transadult"/>
        <input type="hidden" name ="transchild" id="transchild"/>
    <td><span name ="transporechil" id="transporechil"></span></td>
  </tr>
  <tr>
    <td><label style="text-align:left;"><strong>Extensions</strong></label></td>
    <td><span id="extenadult"></span></td>
    <td><span id="extenchil"></span></td>
  </tr>
    <tr>
    <td><label style="text-align:left;"><strong> Discount %</strong></label></td>
    <td colspan="2">
      <input name="descuento" type="number" id="descuento" maxlength="3" onkeyup="valorExtra();" max="100" min="0"  value="<?php echo $reserva->descuento_procentaje;?>"  style="height:20px; width:100px;" />
    </td>
    </tr>
    <tr>
    <td><label style="text-align:left;"><strong> Discount &nbsp;$</strong></label></td>
    <td colspan="2">
      <input name="descuento_valor" type="number" id="descuento_valor" size="12" maxlength="10" pattern="6[0-9]" style="height:20px; width:100px;" onkeyup="valorExtra();"   value="<?php echo $reserva->descuento_valor;?>"  />
    </td>
    </tr>
  <tr>
        <td><label style="text-align:left;"><strong>Extra Charges &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$</strong></label></td>
    <td colspan="2">
            <input name="extra" type="text" id="extra" size="12" maxlength="10" style="height:20px;" onkeyup="valorExtra();"  />
    </td>
    </tr>
  <tr>
    <td><label style="text-align:left;"><strong>Sub-total per Pax</strong></label></td>
    <td><span id="subtoadult"></span></td>
    <td><span id="subtochild"></span></td>
  </tr>
  <tr>
    <td><label ><strong>Total</strong></label></td>
    <td colspan="2"><label ><strong id="totaltotal" >$ 00.0</strong></label></td>
	 <div id="enviarDatos"></div>
         <input size="5" type="hidden" id="subtochild1" name="subtochild1" value="<?php echo $reserva->precio_trip1_c;?>" />
         <input size="5" type="hidden" id="subtoadult1" name="subtoadult1" value="<?php echo $reserva->precio_trip1_a;?>" />
         <input size="5" type="hidden" id="subtochild2" name="subtochild2" value="<?php echo  $reserva->precio_trip2_c;?>" />
         <input size="5" type="hidden" id="subtoadult2" name="subtoadult2" value="<?php echo $reserva->precio_trip2_a;?>" />
         <input size="5" type="hidden" id="price_exten01" name="price_exten01" value="<?php echo $reserva->precio_exten1_a;?>" />
         <input size="5" type="hidden" id="price_exten02" name="price_exten02" value="<?php echo $reserva->precio_exten2_a;?>" />
         <input size="5" type="hidden" id="price_exten03" name="price_exten03" value="<?php echo $reserva->precio_exten3_a;?>"  />
         <input size="5" type="hidden" id="price_exten04" name="price_exten04" value="<?php echo $reserva->precio_exten4_a;?>" />
         
         
         <input size="5" type="hidden" id="subtochild1_o" name="subtochild1_o" value="<?php echo $reserva->precio_trip1_c;?>" />
         <input size="5" type="hidden" id="subtoadult1_o" name="subtoadult1_o" value="<?php echo $reserva->precio_trip1_a;?>" />
         <input size="5" type="hidden" id="subtochild2_o" name="subtochild2_o" value="<?php echo  $reserva->precio_trip2_c;?>" />
         <input size="5" type="hidden" id="subtoadult2_o" name="subtoadult2_o" value="<?php echo $reserva->precio_trip2_a;?>" />
         <input size="5" type="hidden" id="price_exten01_o" name="price_exten01_o" value="<?php echo $reserva->precio_exten1_a;?>" />
         <input size="5" type="hidden" id="price_exten02_o" name="price_exten02_o" value="<?php echo $reserva->precio_exten2_a;?>" />
         <input size="5" type="hidden" id="price_exten03_o" name="price_exten03_o" value="<?php echo $reserva->precio_exten3_a;?>"  />
         <input size="5" type="hidden" id="price_exten04_o" name="price_exten04_o" value="<?php echo $reserva->precio_exten4_a;?>" />
         
  </tr>
     <!--<tr>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
        <td>&nbsp;
            </td>
        <td colspan="2">&nbsp;
           
        </td>
  </tr>
  <tr>
        <td>&nbsp;

            </td>
        <td colspan="2">&nbsp;
            </td>
  </tr>
  <tr>
        <td>&nbsp;
            </td>
        <td colspan="2">&nbsp;
            

        </td>
  </tr>
  <tr>
        <td>&nbsp;

            </td>
        <td colspan="2">&nbsp;
            </td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
  </tr>
  
  <tr>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
    </tr>-->
  
</table >

     <fieldset id="pymen" style="height:375px;" ><legend >PAYMENT INFORMATIONS</legend>
<input type="hidden" value="0" id="totalcom" name="totalcom">
       <table width="100%">
      	<tr><td>
       <div id="opera" class="input" style="padding-top:5px; width:450px;"> 
            <table width="100%" id="tr_complementary"  style="display:
            <?php
            if($agencia->id == -1){
                echo 'block';
            }else{
                echo 'none';
            }
            ?>;" ><tr>
                    <td width="2%">
                        <input name="opcion_pago" id="opcion_pago_complementary" value="7"  type="radio"  <?php echo ($typo_pago==strtoupper('Complementary'))?' checked ':'';?>    ></td>
                    <td width="20%"><label for="opcion_pago_complementary">Complementary</label></td>
                </tr></table>
       	<table width="100%" height="125" id="tableorder">
      <tr>
        <td  colspan="3" width="34%" height="" align="center"  >
                        <input type="hidden" name="opcion_pago_saldo" id="opcion_pago_saldo" value="1" />
        		<table width="100%" align="center" id="tableTypeSaldo" 
                 style="display:
				 <?php 
                               if($agencia->id != -1 && $agencia->type_rate == 0){
					 echo 'block';
				}else{ 
					  echo 'none';
				}
					 ?>;" >
                 <tr>
                                <td colspan="6"   height="20" id="titlett" align="center"  ><strong>PAYMENT OPTION</strong></td>
                  </tr>

                	<tr>
                     <td>&nbsp;</td>
        				<td width="2%">
                                    <input name="opcion_saldo" id="opcion_saldo1" value="1" type="radio"  <?php echo ($typo_saldo=='FULL')?' checked ':'';?> ></td>
                        <td width="20%">Paid Full</td>
                                <td width="2%"><input name="opcion_saldo" id="opcion_saldo2" value="2" <?php echo ($typo_saldo=='BALANCE')?' checked ':'';?>   type="radio"></td>
                        <td width="20%">Paid Balance</td>
                        <td>&nbsp;</td>
                    <tr>
                    <tr><td colspan="6"><hr /></td></tr>
                </table>
        	</td>
      </tr>
        <tr>
                    <td  width="34%" height="35" id="titlett" align="left"  ><strong>PRED-PAID</strong></td>
                    <td  width="34%" height="35" id="titlett" align="left"  ><strong>COLLECT ON BOARD</strong></td>
                    <td  width="34%" height="35" id="titlett" align="left"  ><strong>VOUCHER</strong></td>
      </tr>
      <tr>
      <td valign="top"  >
      <table style="width:160px;">    
       <tr>
    <td colspan="2"></td>
    </tr>
   <?php if($agen_account['opcion1'] != 0){?>
   <tr id="tipo_passager">
                                    <td width="5"><input name="opcion_pago" id="opcion_pago_passager"  value="2" agencypago="true" type="radio"  <?php echo ($typo_pago==strtoupper('Passenger Credit Card'))?' checked ':'';?>  ></td>
      <td width="" align="left"><label id="label_tipo_passager" for="opcion_pago_passager" class="opcion_pago">Passenger Credit Card</label></td>
      
   </tr>
    <tr id="tipo_agency" style="" >
                                    <td width="5"><input name="opcion_pago" id="opcion_pago_agency"  value="1" agencypago="true" type="radio"   <?php echo ($typo_pago==strtoupper('Agency Credit Card'))?' checked ':'';?>   ></td>
      <td width="" align="left"> <label id="label_tipo_agency" for="opcion_pago_agency" class="opcion_pago">Agency Credit Card</label></td>
    </tr>        
     <?php } else{?>
	<tr id="tipo_passager">
                                    <td width="5"><input name="opcion_pago" id="opcion_pago_passager"  value="2" agencypago="true" type="radio" <?php echo ($typo_pago==strtoupper('Credit Card') || $typo_pago==strtoupper('Passenger Credit Card'))?' checked ':'';?>  ></td>
      <td width="" align="left"><label id="label_tipo_passager" for="opcion_pago_passager" class="opcion_pago">Passenger Credit Card</label></td>
   </tr>
    <tr id="tipo_predpaid_cash" style="">
                                    <td width="5"><input name="opcion_pago" id="opcion_pago_predpaid_cash"  value="6" agencypago="true" type="radio" <?php echo ($typo_pago==strtoupper('Cash in terminal'))?' checked ':'';?>   ></td>
      <td width="" align="left" id=""> <label id="label_tipo_predpaid_cash" for="opcion_pago_predpaid_cash" class="opcion_pago">Cash in terminal </label></td>
    </tr>
	 <?php }?>
   </table>        
</td>
      <td valign="top">
          <table style="width:160px;" >
              <tr>
    <td colspan="2"></td>
    </tr>
    <?php if($agen_account['opcion3'] != 0){?>
  <tr id="tipo_CrediFee">
                                    <td width="5"><input name="opcion_pago" id="opcion_pago_CrediFee" value="3" type="radio"    <?php echo ($typo_pago==strtoupper('Credit Card+ 4 % FEE'))?' checked ':'';?>   ></td>
    <td align="left" > <label id="label_tipo_CrediFee" for="opcion_pago_CrediFee" class="opcion_pago">Credit Card+ 4 % FEE</label></td>
  </tr>
  <?php } ?>
   <?php if($agen_account['opcion4'] != 0){?>
  <tr id="tipo_Cash">
                                <td width="5"><input name="opcion_pago" id="opcion_pago_Cash" value="4" type="radio"  <?php echo ($typo_pago==strtoupper('Cash'))?' checked ':'';?>  ></td>
    <td align="left"><label id="label_tipo_Cash" for="opcion_pago_Cash" class="opcion_pago">Cash</label></td>
      <?php } ?>
  </tr>
          </table> 
          </td>
      <td align="left" valign="top" >
      <?php if($agen_account['opcion5'] != 0){?>
      	<div id="tipo_Voucher" style="">
        <table>
        	<tr>
            <td>
                                            <input name="opcion_pago" id="opcion_pago_Voucher" value="5" type="radio"   <?php echo ($typo_pago==strtoupper('Credit Voucher'))?' checked ':'';?> >
         </td>
         <td>
         <label id="label_tipo_Cash" for="opcion_pago_Voucher" class="opcion_pago">Credit Voucher</label>
                                        </td>
                                    </tr>
                                </table>
       </div>
       <?php }?>
      </td>
   </tr>
   </table>
    </div>
    </td>
    <td>
        <div id="comco" class="input"><div style="width:265px;"><label style="width:150px;padding-left:100%;"  ><strong>NOTES</strong></label></div><textarea id="comments" name="notes" cols="0" rows="0"  style="margin: 2px; width: 339px; height: 180px; "><?php echo trim($reserva->comments);?></textarea></div>
    </td>
    </tr>
    	<tr>
        	<td colspan="2">
            <div id="opera" class="input" >
            <table>
            	<tr>
                    <td>
                        <table>
                            <tr>
                                <td style="width:100px">  &nbsp;
                                    <a id="enviarF" style="display:none" ><img src="<?php echo $data['rootUrl']; ?>global/img/admin/charge.png" /></a>
                                </td>
                                <td style="width:60px;">
                                    &nbsp;
                                    <a id="btn-save2" title="Save"><img width="50" height="40" src="<?php echo $data['rootUrl']; ?>global/img/admin/save2.png" /></a>
                                    <input type="button" style="display:none" id="enviar_escondido" value="0"  />
                                </td>
                            </tr>
                        </table>
                    </td>
                    <td>
                        <table>
                            <tr>
                	<td >
                                    <?php if($agencia->id != -1 && $agencia->type_rate == 0){?>
                                    <label  style="padding-left:20px; font-size:11px; "><strong style="padding-bottom:10px;" >Agency Comision	$ </strong></label>
          </td>
            <td>
          <label id="totalComision" ></label>
           <br />
           <?php }?>
           			</td>
                 </tr>
                 <tr>
             <td>
                                    <label  style="padding-left:20px; font-size:12px; "><strong style="padding-bottom:0px; color:#090;">Prepaid value	</strong></label>
           </td>
            <td>
           <label id="saldoPagado" >$  <?php echo number_format($pagado,2,'.',',');?></label>
           <br />
           		 </td>
                </tr>
                  <tr>
             <td>
                                    <label  style="padding-left:20px; font-size:12px; "><strong   id="txtamountpendiente" style="padding-bottom:0px; color:#F00">Amount to be paid in advance </strong></label>
           </td>
            <td>
           <label id="saldoporpagar" >$  <?php echo number_format(($saldoxPagar),2,'.',',');?></label>
           <br />
           		 </td>
                </tr>
           		<tr>
                <td>
                                    <label  style="padding-left:20px; font-size:16px; "><strong style="padding-bottom:10px;">TOTAL AMOUNT PAID	$ </strong></label>
           </td>
            <td>
           <label  style="font-size:16px; padding-left:3px; font-weight:bold;" id="totalPagar" ></label>
                                    <input name="totP" type="hidden"  id="totP" value="" />
         		</td>
                </tr>
                            <tr id="tr_otheramount" <?php if($agencia->id == -1){echo ' style="display:none" ';}?>  ><td>
                                    <label  style="padding-left:20px; font-size:11px; "><strong style="padding-bottom:10px;">OTHER AMOUNT $</strong></label>	</td>
      <td>
                                    <input type="text" id="otheramount" name="otheramount" style="width:100px; font-weight:bold; font-family:Verdana, Geneva, sans-serif;" value="<?php echo number_format($reserva->otheramount,2,'.',',');?>" onkeyup="CalcularTotalTotal();"  />
              </table>
          </td>
                    <td>
                   		<div id="estadoTranssacion">
                        
                        </div>
                   </td>
            </tr>
       </table>
      </div>
            </td>
        </tr>
    </table>
</td>
</tr>
</table>
       
      </fieldset>
    
        </div>
        
        </div>
    </form>
<div id="userr"></div>
<div id="dialog" title="History of changes of the reserve" style="display:none;">
 <div style="overflow-y: scroll;height:250px;">
 	 <table class="grid2" cellspacing="1" id="grid2">
         <thead>
           <tr>
        	<td>Action</td>
            <td>User</td>
        	<td>Date</td>
            <td>&nbsp;</td>
        </tr>
         </thead>
         <tbody>
        <?php foreach($rastro as $rr){?>
			<tr class="row1">
            	<td><?php echo $rr['tipo_cambio'];?></td>
                <td><?php echo $rr['usuario'];?></td>
                <td><?php echo date('M-d-Y',strtotime($rr['fecha']));?></td>
                <td onclick="detalles_rastro('<?php echo $rr['id']?>');"><img src="<?php echo $data['rootUrl']?>global/img/admin/info.png" width="24" height="24" title="Details of change" /></td>
            </tr>
		<?php }?>
       </tbody>
    </table>
 </div>
</div>

 
<div id="dialog-message" title="Details of change">
  <div id="conten_rastro">
  </div>
</div>


<script type="text/javascript">
$(window).load(function() {
      //alert("Se cargo");
      $("#content").css("opacity","1");
});    
$(document).ready(function() {
    $("#content").css("opacity","0.2");
    if($("#id_tipo_ticket").val() == "1" ){

        $("#round").css("display","none");
        $(".sup2").css("margin-top"," 2px");
    }else{

        $("#round").css("display","block");
        $(".sup2").css("margin-top"," -209px");
    }
	
    });
	     		$("#fecha_retorno").attr("disable", true);
				$("#from2").attr("disable",true);
				$("#from2").attr("readonly", "readonly");
				$("#fecha_retorno").attr("readonly", "readonly");
				$("#pickup2").attr("readonly", "readonly");
				$("#dropoff2").attr("readonly", "readonly");
				$("#arrival2").attr("readonly", "readonly");
				$("#to2").attr("readonly", "readonly");
				$("#ext_from2").attr("disabled", "disabled");
				$("#departure2").attr("readonly", "readonly");
				$("#ext_to2").attr("disabled", "disabled");
				$("#room2").attr("readonly", "readonly");
				$("#exten3").attr("readonly", "readonly");
				$("#exten4").attr("readonly", "readonly");
				$("#trip_no2").html("");
				$("#departure2").html("");
				$("#arrival2").html("");
	
		

	
    $('#btn-cancel1').click(function(){
        window.location = '<?php echo $data['rootUrl']; ?>admin/reservas';
    });
	desabilitarTodo();
	function desabilitarTodo(){
		var sAux="";
			var frm = document.getElementById("formula");
			for (i=0;i<frm.elements.length;i++){
				var id = frm.elements[i].id;
				$("#"+id).attr('disabled', true);
			}
	}

	   
</script>



<?php 

$valida = false;
if(isset($data["reserve"])){
	$reserva= $data["reserve"]; 
}else{
	$valida = true;
}


if(isset($data['cliente'])){
$cliente = $data['cliente'];

}

if(isset($data['pickup'])){
$p = $data['pickup'];
}

if(isset($data['drop1'])){
$drop1 = $data['drop1'];
//print_r($drop1);
}

if(isset($data['pickup2'])){
$pickup2 = $data['pickup2'];
}

if(isset($data['drop2'])){
$drop2 = $data['drop2'];

}

if(isset($data['routes'])){
$routes = $data['routes'];

}

if(isset($data['routes2'])){
$routes2 = $data['routes2'];
//print_r($routes2);

}
$login = $_SESSION['login'];
?>

<link rel="stylesheet" type="text/css" href="<?php echo $data['rootUrl']; ?>global/css/autocompletar/css/style.css" />
<link rel="stylesheet" type="text/css" href="<?php echo $data['rootUrl']; ?>global/css/jquery.notice2.css"/>  

<link rel="stylesheet" type="text/css" href="<?php echo $data['rootUrl']; ?>global/css/modal.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo $data['rootUrl']; ?>global/css/blitzer/jquery-ui-1.10.3.custom.min.css" />

<script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/jquery.notice.js"></script>
<script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/jquery.ausu-autosuggest.js"></script>
<script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/Concurrent.Thread.js"></script>

<script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/form.js"></script>

<!--jquery para el calendario-->
<script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/jquery-ui-1.8.18.custom.min.js"></script>


<style type="text/css" media="screen">
	 #search{
	    cursor:pointer;
	 }
   
	</style>
	
	
<div id="header_page" >
<div class="header2">
	<table style="width:500px;" >
    	<tr>
        	<td width="30%">Reserves [ ]</td>
            <td width="10%">
              <table>
                	<tr>
                    	<td id="bnt-trips" class="btn"><img src="<?php echo $data['rootUrl']; ?>global/img/admin/calendar_aviso32x32.png" /></td>
                    </tr>
                </table>
            </td>
<td>&nbsp;</td>
<td width="10%" ><div id="mensajeTrip"  class="temporizador"></div></td>
</tr>
</table>
</div>
        <div  id="toolbar">
      
            <div class="toolbar-list">
                <ul>
                    <li class="btn-toolbar" id="btn-save1">
                        <a   class="link-button" id="btn-save1">
                            <span class="icon-32-save" title="Nuevo" >&nbsp;</span>
                            Save
                        </a>
                    </li>

                    <li class="btn-toolbar" id="btn-cancel1">
                        <a  class="link-button" >
                            <span class="icon-back" title="Editar" >&nbsp;</span>
                            Cancel
                        </a>
                    </li>                      
                </ul>
                <div class="clear"></div>
            </div>
            <div class="clear"></div>
        </div>
        </div>
    <!-- header options -->
  <form  id="formula" class="form" action="<?php echo $data['rootUrl']; ?>admin/reservas/save" method="post" name="formula" target="_blank" >
<div id="info-group">
   <div id="status-change" >
       	<table>
        	<tr>
        		<td><h3>STATUS</h3></td>
                <td>
                   <select id="estado" name="estado">
                       <option></option>
                       <option value="CONFIRMED">CONFIRMED</option>
                       <option value="QUOTE">QUOTE</option>
                       
                   </select>
                </td>
           </tr>
      </table>
   </div>
</div>


<div id="content_page"  >
        <div id="serpare"> 
   

	<input type="hidden"  id="vista" value="1" />
	<input name="id" type="hidden"  id="id"  value="<?php if(isset($reserva)){echo $reserva->id;}?>" />
	<table><tr><td>
        <fieldset id="liderpax"><legend>LEADER PASS</legend>
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
               <input type="text" size="55" value="<?php if(isset($cliente)&& isset($reserva)){if($cliente->id == $reserva->id_clientes){echo $cliente->lastname . " " .$cliente->firstname . " - E-Mail -" . $cliente->username;}}?>" name="leader" id="leader" autocomplete="off" />
              
    		<input type="hidden" size="4" value="" name="id_leader" id="id_leader" autocomplete="off" disabled="disabled"  readonly="readonly"/>
          </div>
                        </td>
                        <td>&nbsp;&nbsp;</td>
                        <td title="">
                        	<div  class="ausu-suggest" style="margin-top:-5px; margin-left:2px; display:none">		
		<a id="newClient" style="cursor:pointer; visibility:hidden;" ><img src="<?php echo $data['rootUrl'];?>global/img/new.png" alt=""  align="absmiddle" border="0"  style="padding-bottom:0px;" /></a>
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
                    	<table>
                        	<tr>
                            	<td>
                                	         
		  <input type="hidden" name="idCliente"   id="idCliente"  value="<?php if(isset($cliente) && isset($reserva)){
						if($cliente->id == $reserva->id_clientes){
							echo trim($reserva->id_clientes);
						}
				  }?>" />
                  
                  
                      <input type="hidden" name="idPagador" id="idPagador" value="0"  />
                      <input type="hidden" name="idPagador_aux" id="idPagador_aux" value="0"  />
                  <input type="hidden" name="cliente_apto" id="cliente_apto" value="0"  />
          <label style="" id="label">FIRST NAME</label>		
                                </td>
                                <td>
                                	<input name="firstname1" type="text"  id="firstname1" size="20" maxlength="20" value="<?php if(isset($cliente) && isset($reserva)){if($cliente->id == $reserva->id_clientes){echo $cliente->firstname;}}?>" />	
                                </td>
                          
                            	<td> 
                                 	 <label style="" id="label" >LAST NAME </label>
                                </td>
                                <td>  
                                 <input name="lastname1" type="text"  id="lastname1" size="20" maxlength="20" value="<?php if(isset($cliente)&& isset($reserva)){if($cliente->id == $reserva->id_clientes){echo $cliente->lastname;}}?>" />
                                </td>
                            </tr>
                    		<tr>
                            	<td>
                                	 <label style="" id="label">PHONE </label>
                                </td>
                                <td>
                                	 <input name="phone1" type="text"  id="phone1" size="20" maxlength="20" value="<?php if(isset($cliente)&& isset($reserva)){if($cliente->id == $reserva->id_clientes){echo $cliente->phone;}}?>" /> 
                                     <input  type="hidden" name="type_cliente"  id="type_cliente" value="<?php if(isset($cliente)&& isset($reserva)){if($cliente->id == $reserva->id_clientes){echo $cliente->tipo_client	;}}?>" />       	
                                </td>
                          
                            	<td> 
                                 	 <label style="" id="label">E-MAIL </label>
                                </td>
                                <td>  
                                 <input name="email1" type="text"  id="email1" size="20" value="<?php if(isset($cliente)&& isset($reserva)){if($cliente->id == $reserva->id_clientes){echo $cliente->username;}}?>"/>
                                </td>
                            </tr>
                    	</table>   
                    </div>
                </td>
            </tr>
        </table>
       </fieldset>
		</td>
	        <td>
            
             <fieldset id="inputype" ><legend>INPUT TYPE</legend>
               <div id="opera" class="input">  
             <table width="100%" >
             	<tr align="left">
                	
                	<td >
                    	 <label style="" id="label">CALL CENTER</label>
                    </td>
                    <td >
                         <input name="nombre" type="text"  id="nombre" value="<?php echo  trim($login->nombre.' ('.$login->usuario.')');?>" readonly="readonly"/>
                    </td>
                    
                </tr>
                <tr><td colspan="2" >
                	<table width="100%">
                                <tr>
                            <td width="10%">
                                  <label><strong>AGENCY</strong></label>
                            </td>
                            <td width="40%">
                                 <div class="ausu-suggest" >
                                  <input name="agency" type="text"  id="agency" size="" maxlength="30" value=""  autocomplete="off"   />
                                  <input type="hidden" size="4" value="-1" name="id_agency" id="id_agency" autocomplete="off"  readonly="readonly"/> 
                                  <input type="hidden" size="4" value="0" name="type_rate" id="type_rate" autocomplete="off"  readonly="readonly"/> 
                                  <input type="hidden" size="4" value="0" name="disponible" id="disponible" autocomplete="off"  readonly="readonly"/>
                                   <input type="hidden" size="4" value="0" name="comision" id="comision" autocomplete="off"  readonly="readonly"/>
                                 
                                  </div>
                            </td>
                            <td width="10%">
                                 <label><strong>Employ</strong></label>
                            </td>
                            <td width="40%">
                                 <div class="ausu-suggest" >
                              <input style="width:120px;" name="uagency" type="text"  id="uagency" size="11" maxlength="30" value="" autocomplete="off"  />
                               <input type="hidden" size="4" value="" name="id_auser" id="id_auser" autocomplete="off" />
                              </div>
                            </td>
                        </tr>
                    </table>
                </td></tr>
                
                <tr><td colspan="2" >&nbsp;</td></tr>
                 <tr><td colspan="2">
                 	<table align="center" cellspacing="10">
                    	<tr valign="top">
                        	<td><label  for="calan_phone"> BY PHONE</label> <input name="canal" type="radio" id="calan_phone" value="PHONE" />  </td>
                            <td><label  for="calan_mail"> BY MAIL</label> <input name="canal" type="radio"  id="calan_mail"  value="MAIL" /> </td>
                            <td><label for="calan_web"> WEBSALE </label><input name="canal" type="radio" id="calan_web" value="WEBSALE" />  </td>
                        </tr>
                    </table>
                </td></tr>
             </table>
        </div>
       
      
        
            </fieldset>
            </td></tr></table>
       
             <fieldset id="boo" ><legend>BOOKING</legend>
		<input type="hidden" name="id_oneway" id="id_tipo_ticket" value="<?php  if(isset($reserva)){echo $reserva->tipo_ticket;}?>"/>
         <div id="opera" class="input" style="padding-top:5px;"> <label for="oneway">ONE WAY </label> <input name="tipo_ticket"  id="oneway" type="radio" value="1" /></div>
        <div id="opera" class="input" style="padding-top:5px;"> <label  for="roundtrip">ROUND TRIP </label><input name="tipo_ticket" id="roundtrip" type="radio" value="2" /> </div>
        <div id="opera" class="input" style="padding-top:5px;"> <label style="padding-right:5px;">TYPE OF PASS </label>
        <select name="tipo_pass" id="tipo_pass"><option value="0">NO RESIDENT</option><option value="1">RESIDENT</option></select>  </div>
        
          
          
          <div id="opera" class="input"  style="padding-top:10px; clear:left;">        
          <label style="width:45px"  >ADULT</label>
          <input name="pax" autocomplete="off" type="number" min="1"  id="pax" size="2" maxlength="2" value="1"  style="width:50px" onchange="
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
          <input name="pax2" type="number"  id="pax2" size="2" maxlength="2" value="0" autocomplete="off" style="width:50px" min="0" max="15" onchange=" 	
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
        
 <div id="opera" class="input" style="padding-right:200px; padding-top:10px;"><input name="byr" type="radio" value="" /><label id="labeldere"> Customer With Disabilities </label></div>
        
            </fieldset>
          <!--&nbsp;-->

<table width="200"  cellspacing="0" class="sup" >
  <tr>
    <td width="129" ><label > <strong>SUPERCLUB#</strong></label></td>
    <td width="65"><label id="labeldere"><span id="number_supu">N/A</span></label></td>
  </tr>
  <tr>
    <td><label> <strong>POINTS BALANCE</strong></label></td>
    <td><label id="labeldere"><span id="points">N/A</span></label></td>
  </tr>
  <tr>
    <td><label > <strong>POINTS REQUIRED 
FOR THIS TRIP

</strong></label></td>
    <td><label id="labeldere" >N/A</label></td>
  </tr>
</table>
              <fieldset id="onew" ><legend>ONE WAY</legend>
              <div id="CargaTrip"></div>
              
   			  <div id="opera" class="input" style="padding-top:18px; "> 
                     
          <label style="width:75px;"  >DEPARTURE </label><a href="" id="dataclick1" ><img src="<?php echo $data['rootUrl']; ?>global/images/calendar.png" alt=""  align="absmiddle" width="19" height="20" border="0"  /></a>
          <input name="fecha_salida" type="text"  id="fecha_salida" size="10" maxlength="15" value="" readonly="readonly" />
        </div>
        
         <div id="opera" class="input"  >        
          <div id="explo">  <label style="width:45px"  > FROM</label></div>
       <div id="explo" align="left"> <select name="fromt"  style="width:125px; height:25px;" id="from"> 
                       <option value="0"></option> 
                      <?php foreach($data["areas"] as $e):?>
					  <option value="<?php echo $e["id"]; ?>"  ><?php echo $e["nombre"]; ?></option>			 
                      <?php endforeach;?>					   
        </select></div>
        </div>
         <div id="opera" class="input"  >        
          <div id="explo">  <label style="width:45px"  > TO</label></div>
       <div id="explo" align="left">
         <select name="to"  id="to" style="width:130px; height:25px;">
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

		<div id="clienteN" style=" display:none; width: 700px; margin-left: 100px;"></div>
		
         <div id="opera" class="input">        
	   <div style="width:50px;" id="popup1">  <label style="width:20px"  > TRIP</label><a id="search" style="cursor:pointer;"><img src="<?php echo $data['rootUrl'];?>global/images/search.png" alt=""  align="absmiddle" border="0"  style="padding-bottom:0px;" /></a>
       <input type="hidden" id="valorcomision01" name="valorcomision01" value="0" />
       </div>
       <div style="width:50px;"> <input name="trip_no" type="text"  id="trip_no" size="3" maxlength="3" value="<?php if(isset($reserva)){echo $reserva->trip_no;}?>"  readonly="readonly"/>
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
         <input name="pickup1" type="text"  id="pickup1" size="40" maxlength="55" value="<?php if(isset($p) && $p != ""){echo $p->place;} ?>" autocomplete="off"  />
         <input name="id_p1" type="hidden"  id="id_p1" size="40" maxlength="55" value="<?php if(isset($p)&& $p != ""){echo $p->id;} ?>" />
         </div>
       </div>
        </div>
          <div id="opera" class="input"  >        
          <div style="width:265px;">  <label style="width:250px"  >DROP OFF POINT/ADDRESS</label></div>
       <div style="width:200px;">
       <div class="ausu-suggest" >
         <input name="dropoff1" type="text"  id="dropoff1" size="39" maxlength="55" value="<?php if(isset($drop1) && $drop1 != ""){echo $drop1->place;} ?>" autocomplete="off" />
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
         </select></div>
         
          <div id="opera" class="input" style="padding-top:5px;"> <label style="padding-right:5px;"><strong>EXTENSION AREA:</strong></label>
          <select name="ext_to1" id="ext_to1" style='width:123px;'>
           <option value="0"></option>
          </select>  </div>
            <div id="opera" class="input"  style="padding-left:13px; clear:right;">        
          <label style="width:48px"  >ROOM #</label>
          <input name="room1" type="text"  id="room1" size="2" maxlength="1" value="" />
        </div>
        
         <div id="opera" class="input"  style="clear:left; ">  
               
          <div style="width:300px;">  <label style="width:250px"  >EXTENSION PICK UP POINT/ADDRESS</label></div>
       <div style="width:200px;">
       <div class="ausu-suggest" >
         <input name="exten1" type="text"  id="exten1" size="46" maxlength="55" value=""  autocomplete="off" disabled="disabled" />
         <input name="id_ext_pikup1" type="hidden"  id="id_ext_pikup1" size="40" maxlength="55" value="" />
         </div>
       </div>
        </div>
        <div id="opera" class="input" >        
          <div style="width:265px;">  <label style="width:250px"  >EXTENSION DROP OFF POINT/ADDRESS</label></div>
       <div style="width:200px;">
       <div class="ausu-suggest" >
         <input name="exten2" type="text"  id="exten2" size="47" maxlength="55" value="" disabled="disabled" />
         <input name="id_ext_pikup2" type="hidden"  id="id_ext_pikup2" size="40" maxlength="55" value="" />
         </div>
       </div>
        </div>
        
   </fieldset> 
     <fieldset id="round" ><legend><font color="#990000">ROUND TRIP</font></legend>
              
   			  <div id="opera" class="input" style="padding-top:18px; "> 
                     
          <label style="width:75px;"  >DEPARTURE </label><a href="" id="dataclick2" ><img src="<?php echo $data['rootUrl']; ?>global/images/calendar.png" alt=""  align="absmiddle" width="19" height="20" border="0"  />
          </a>
          <input name="fecha_retorno" type="text"  id="fecha_retorno" size="10" maxlength="15" value="<?php if(isset($reserva)){echo $reserva->fecha_retorno;}?>"  readonly="readonly" />
          
        </div>
        
         <div id="opera" class="input"  >        
          <div id="explo">  <label style="width:45px"  > FROM</label></div>
       <div id="explo" align="left"> <select name="fromt2"  style="width:125px; height:25px;" id="from2" > 
       <option value=""></option> 
					   
        </select></div>
        </div>
        
          <div id="opera" class="input"  >        
          <div id="explo">  <label style="width:45px"  > TO</label></div>
       <div id="explo" align="left">
         <select name="to2"  id="to2" style="width:130px; height:25px;"  >
          <option value="0"></option> 
                      <?php foreach($data["areas"] as $e):?>
					  <option value="<?php echo $e["id"]; ?>"  ><?php echo $e["nombre"]; ?></option>			 
                      <?php endforeach;?>	
         </select>
       </div>
        </div>
        <div id="opera" class="input"  >        
		  <div style="width:50px;" id="popup2">  <label style="width:20px"  > TRIP</label><a id="search2" style="cursor:pointer;"><img src="<?php echo $data['rootUrl'];?>global/images/search.png" alt=""  align="absmiddle" border="0"  style="padding-bottom:0px;" /></a>
          <input type="hidden" id="valorcomision02" name="valorcomision02" value="0" />
          </div>
       <div style="width:50px;"> <input name="trip_no2" type="text"  id="trip_no2" size="3" maxlength="3" value="<?php if(isset($reserva)){echo $reserva->trip_no2;} ?>"  readonly="readonly"/>
       </div>
        </div>
          <div id="opera" class="input"  style="clear:right; padding-left:7px;">        
          <div style="width:50px;">  <label style="width:45px"  > DEP.TIME</label></div>
       <div style="width:50px;">
         <input name="departure2" type="text"  id="departure2" size="5" maxlength="8" value="<?php if(isset($reserva)){echo date("g:i a",strtotime($reserva->deptime2));}?>" />
       </div>
        </div>
        
      <div id="opera" class="input"  style="clear:left; ">        
          <div style="width:265px;">  <label style="width:150px"  >PICK UP POINT/ADDRESS</label></div>
       <div style="width:200px;">
         <div class="ausu-suggest" >
         <input name="pickup2" type="text"  id="pickup2" size="40" maxlength="55" value="" autocomplete="off"  />
         <input name="id_pickup2" type="hidden"  id="id_pickup2" size="40" maxlength="55" value=" " />
         </div>
       </div>
        </div>
          <div id="opera" class="input"  >        
          <div style="width:265px;">  <label style="width:250px"  >DROP OFF POINT/ADDRESS</label></div>
       <div style="width:200px;">
       <div class="ausu-suggest" >
         <input name="dpoff2" type="text"  id="dropoff2" size="39" maxlength="55" value="<?php if(isset($drop2)&& $drop2 != ""){echo $drop2->place;} ?>" autocomplete="off"  />
          <input name="id_dropoff2" type="hidden"  id="id_dropoff2" size="40" maxlength="55" value="<?php if(isset($drop2)&& $drop2 != ""){echo $drop2->id;} ?>" />
         </div>
       </div>
        </div>
         <div id="opera" class="input"  >        
          <div style="width:50px;">  <label style="width:45px"  >ARR.TIME</label></div>
       <div style="width:50px;">
         <input name="arrival2" type="text"  id="arrival2" size="5" maxlength="8" value="<?php if(isset($reserva)){echo date("g:i a",strtotime($reserva->arrtime2));}?>" />
       </div>
        </div>
        
        
         <div id="opera" class="input" style="padding-top:5px;"> <label style="padding-right:5px;"><strong>EXTENSION AREA:</strong></label>
         <select name="ext_from2" id="ext_from2" style='width:123px;' >
         	<option value="0"></option>
         </select>  </div>
         
          <div id="opera" class="input" style="padding-top:5px;"> <label style="padding-right:5px;"><strong>EXTENSION AREA:</strong></label>
          <select name="ext_to2" id="ext_to2" style='width:123px;'>
          <option value="0"></option>
          </select>  </div>
            <div id="opera" class="input"  style="padding-left:13px; clear:right;">        
          <label style="width:48px"  >ROOM #</label>
          <input name="room2" type="text"  id="room2" size="2" maxlength="1" value="" />
        </div>
         
           
        
         <div id="opera" class="input"  style="clear:left; ">        
          <div style="width:300px;">  <label style="width:250px"  >EXTENSION PICK UP POINT/ADDRESS</label></div>
       <div style="width:200px;">
         <div class="ausu-suggest" >
         <input name="exten3" type="text"  id="exten3" size="47" maxlength="55" value="" disabled="disabled" />
         <input name="id_ext_pikup3" type="hidden"  id="id_ext_pikup3" size="40" maxlength="55" value="" />
         </div>
       </div>
        </div>
        <div id="opera" class="input" >        
          <div style="width:265px;">  <label style="width:250px"  >EXTENSION DROP OFF POINT/ADDRESS</label></div>
       <div style="width:200px;">
        <div class="ausu-suggest" >
         <input name="exten4" type="text"  id="exten4" size="47" maxlength="55" value="" disabled="disabled" />
         <input name="id_ext_pikup4" type="hidden"  id="id_ext_pikup4" size="40" maxlength="55" value="" />
         </div>
       </div>
        </div>
        
   </fieldset> 
   
      <table width="246" cellspacing="0" class="sup2">
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
    <td><label style="text-align:left;"><strong>Special Discount %</strong></label></td>
    <td colspan="2">
      <input name="descuento" type="number" id="descuento" maxlength="3" onkeyup="valorExtra();" max="100" min="0"   style="height:20px; width:100px;" />
    </td>
    </tr>
    <tr>
    <td><label style="text-align:left;"><strong>Special Discount &nbsp;$</strong></label></td>
    <td colspan="2">
      <input name="descuento_valor" type="text" id="descuento_valor" size="12" maxlength="10" pattern="6[0-9]" style="height:20px;" onkeyup="valorExtra();"  />
    </td>
    </tr>
  <tr>
  <tr>
    <td><label style="text-align:left;"><strong>Extra Charges</strong></label></td>
    <td colspan="2">
      <input name="extra" type="text" id="extra" size="12" style=" width:100px; height:20px;" min="0" onkeyup="valorExtra();"  />
    </td>
    </tr>
  <tr>
    <td><label style="text-align:left;"><strong>Sub-total per Pax</strong></label></td>
    <td><span id="subtoadult"></span></td>
    <td><span id="subtochild"></span></td>
  </tr>
  <tr>
    <td><label ><strong>Total</strong></label></td>
    <td colspan="2"><label ><strong id="totaltotal" >$ 00.0</strong>
   
    </label></td>
	 <div id="enviarDatos"></div>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;
     <input size="5" type="hidden" id="subtochild1" name="subtochild1" value="0" /></td>
    <td colspan="2">&nbsp;
    <input size="5" type="hidden" id="subtoadult1" name="subtoadult1" value="0" />
    
    </td>
  </tr>
  <tr>
    <td>&nbsp;
    
    <input size="5" type="hidden" id="subtochild2" name="subtochild2" value="0" /></td>
    <td colspan="2">&nbsp;
    <input size="5" type="hidden" id="subtoadult2" name="subtoadult2" value="0" /></td>
  </tr>
  <tr>
    <td>&nbsp;
     <input size="5" type="hidden" id="price_exten01" name="price_exten01" value="0" /></td>
    <td colspan="2">&nbsp;
    <input size="5" type="hidden" id="price_exten02" name="price_exten02" value="0" />
    
    </td>
  </tr>
  <tr>
    <td>&nbsp;
    
    <input size="5" type="hidden" id="price_exten03" name="price_exten03" value="0"  /></td>
    <td colspan="2">&nbsp;
    <input size="5" type="hidden" id="price_exten04" name="price_exten04" value="0" /></td>
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
  </tr>
  
</table >

      <fieldset id="pymen" style="height:340px;" ><legend >PAYMENT INFORMATIONS</legend>
      <table width="100$">
      	<tr><td>
        
       <div id="opera" class="input" style="padding-top:5px; width:450px;"> 
        <table width="100%" id="tr_complementary"><tr>
        	<td width="2%">
             <input name="opcion_pago" id="opcion_pago_complementary" value="7"  type="radio"></td>
             <td width="20%"><label for="opcion_pago_complementary">Complementary</label></td>
        </tr></table>
       	<table width="100%" height="125" id="tableorder">
      <tr>
        <td  colspan="3" width="34%" height="20" align="center"  >
        <input type="hidden" name="opcion_pago_saldo" id="opcion_pago_saldo" value="1" />
        		<table width="100%" align="center" id="tableTypeSaldo" style="display:none;">
                 <tr>
                    <td colspan="6"   height="20" id="titlett" align="center"  ><strong>PAYMENT OPTION 
                    </strong> 
                    </td>
                  </tr>

                	<tr>
                      <td>&nbsp;</td>
        				<td width="2%">
                        <input name="opcion_saldo" id="opcion_saldo1" value="1" checked="checked" type="radio"></td>
                        <td width="20%">Paid Full</td>
                        <td width="2%"><input name="opcion_saldo" id="opcion_saldo2" value="2" type="radio"></td>
                        <td width="20%">Paid Balance</td>
                        <td>&nbsp;</td>
                    <tr>
                    <tr><td colspan="6"><hr /></td></tr>
                </table>
        	</td>
      </tr>
        <tr>
        <td  width="34%" height="35" id="titlett" align="left"  ><strong>PRED-PAID</strong> </td>
        <td  width="34%" height="35" id="titlett" align="left"  ><strong>COLLECT ON BOARD</strong> </td>
        <td  width="34%" height="35" id="titlett" align="left"  ><strong>VOUCHER</strong> </td>
      </tr>
      <tr>
      <td valign="top"  >
      <table style="width:160px;">    
       <tr>
    <td colspan="2"></td>
    </tr>
   <tr id="tipo_passager">
   	<td width="5"><input name="opcion_pago" id="opcion_pago_passager"  value="2" agencypago="true" type="radio"></td>
      <td width="" align="left"><label id="label_tipo_passager" for="opcion_pago_passager" class="opcion_pago">Credit Card</label></td>
   </tr>
    <tr id="tipo_agency" style="display:none">
      	<td width="5"><input name="opcion_pago" id="opcion_pago_agency"  value="1" agencypago="true" type="radio"></td>
      <td width="" align="left"> <label id="label_tipo_agency" for="opcion_pago_agency" class="opcion_pago">Agency Credit Card</label></td>
    </tr> 
    <tr id="tipo_predpaid_cash" style="">
      	<td width="5"><input name="opcion_pago" id="opcion_pago_predpaid_cash"  value="6" agencypago="true" type="radio"></td>
      <td width="" align="left" id=""> <label id="label_tipo_predpaid_cash" for="opcion_pago_predpaid_cash" class="opcion_pago">Cash in terminal </label></td>
    </tr>        
     

   </table>        
</td>
      <td valign="top" >
          <table style="width:160px;">
              <tr>
    <td colspan="2"></td>
    </tr>
  <tr id="tipo_CrediFee">
    <td width="5"><input name="opcion_pago" id="opcion_pago_CrediFee" value="3" type="radio"></td>
    <td align="left" > <label id="label_tipo_CrediFee" for="opcion_pago_CrediFee" class="opcion_pago">Credit Card+ 4 % FEE</label></td>
  </tr>
  <tr id="tipo_Cash">
    <td width="5"><input name="opcion_pago" id="opcion_pago_Cash" value="4" type="radio"></td>
    <td align="left"><label id="label_tipo_Cash" for="opcion_pago_Cash" class="opcion_pago">Cash</label></td>
  </tr>


          </table> 
          </td>
      <td align="left" valign="top" >
      	<div id="tipo_Voucher" style="display:none">
      		 <input name="opcion_pago" id="opcion_pago_Voucher" value="5" type="radio"><label id="label_tipo_Cash" for="opcion_pago_Voucher" class="opcion_pago">Credit Voucher</label>
       </div>
      </td>
   </tr>
   
   </table>
    </div>
    </td>
    <td>
    	<div id="comco" class="input"> <div style="width:275px;">  <label style="width:150px;padding-left:100%;"  ><strong>NOTES</strong></label></div><textarea id="comments" name="notes" cols="0" rows="0"  style="margin: 2px; width: 339px; height: 180px; "></textarea></div>
    </td>
    </tr>
    	<tr>
        	<td colspan="2">
            <div id="opera" class="input" >
               <table><tr id="tr_agencycomision" style="display:none">
               <td>
          <label  style="padding-left:200px; font-size:11px; "><strong style="padding-bottom:10px;">Agency Comision	$</strong></label></td>
          <td>
          	<label id="totalComision" ></label></td>
          </tr>
          <tr><td>
           <label  style="padding-left:200px; font-size:12px; "><strong style="padding-bottom:10px;">TOTAL AMOUNT	$</strong></label>
           <input name="totP" type="hidden"  id="totP" value="" />
           </td>
           <td>
           <label id="totalPagar" ></label>
           </td></tr>
           <tr id="tr_otheramount" style="display:none"><td>
         <label  style="padding-left:200px; font-size:11px; "><strong style="padding-bottom:10px;">OTHER AMOUNT $</strong></label>	</td>
      <td>
         <input type="text" id="otheramount" name="otheramount" style="width:100px;" />
         </td>
         </tr>
          </table>
		 </div>
          </td>
        </tr>
        <tr height="">
        	<td colspan="2">
       <table width="100%" border="0">
       		<tr>
            	<td style="width:100px">  &nbsp;
                 <div id="opera" class="enviarForm" style="padding-top:5px; cursor:pointer;" align="left">
                <a id="enviarF" style="display:none" ><img src="<?php echo $data['rootUrl']; ?>global/img/admin/charge.png" /></a>
                </div>
                </td>
                 
                <td style="width:50px" >
                
                         &nbsp;<a id="btn-save2"><img width="50" height="40" src="<?php echo $data['rootUrl']; ?>global/img/admin/save2.png" /></a>
                 <input type="button" style="display:none" id="enviar_escondido" value="0"  />
                    </td>
                    <td style="width:310px">&nbsp;</td>
                   <td style="width:420px;">
                   		<div id="estadoTranssacion">
                        	
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
<div id="puestosEnUso"></div>

<div id="dialog_states__trips" title="Seats available on trips" style="display:none;">
 <div>
 	<div id="states__trips_conte"></div>
 </div>
</div>

<div id="dialog-trip-pregunta" title="Time limit for booking" style="display:none">
  <p>
  		<div id="reloj_temporizador" class="temporizador"></div>
  		<div id="mensaje_trips_pregunta"></div>
  </p>
</div>




<script type="text/javascript">

$(document).ready(function() {

$("#calan_phone").attr('checked',true);

var tipo;



client = document.getElementById("newClient");
//client.style.visibility = "hidden";

if($("#pax").val()!= "" || $("#pax2").val()!= ""){
		
		var pax = $('#pax').val();
		var pax2 = $('#pax2').val();
		var total;
		
		if(pax2 == ""){
			pax2 = 0;
       	  // $('#pax2').val(0);
		}
		
		if(pax == ""){
			pax = 0;
			$('#pax').val(0);
		}
				
		total =(parseInt(pax)+parseInt(pax2));
		$('#totalpax').val(total);		
		CalcularTotalTotal();
}

//var noReserva = '<?php if(!isset($reserva)){echo 4;} ?>';
var validar = '<?php echo $valida ?>';


if(validar){

$("#roundtrip").attr("checked", true);



}

$('#uagency').attr('disabled','disabled');
$('#leader').focus();
	$.fn.autosugguest({			
           className: 'ausu-suggest',
          methodType: 'POST',
            minChars: 1,
              rtnIDs: true,
            dataFile: '<?php echo $data['rootUrl']; ?>leader/ajax'
    });
	
	
	
   
	
	
	
	  var id = $("#from").val();
	  
         
         if (id != ""){		 
			
             $("#to").load(encodeURI('<?php echo $data['rootUrl']; ?>load/' + id), function(response, status, xhr) {
			 if(response != ''){
			 var id2 = $("#to").val();
			 
			 if('<?php echo $valida ?>' == ""){
			 
				var idto = $("#valto").val();				
				
				$("#to option[value="+ idto +"]").attr("selected",true); 
				$("#from2 option[value="+ idto +"]").attr("selected",true); 
				
				var idFrom = $("#from").val();
				$("#to2 option[value="+ idFrom +"]").attr("selected",true); 
				
				$('#from2').attr('disabled','disabled');
				$('#to2').attr('disabled','disabled');
			 }
			 
			 
			 $("#ext_to1").load(encodeURI('<?php echo $data['rootUrl']; ?>consul/exten/' + id2));
			
			   $("#ext_from2").load(encodeURI('<?php echo $data['rootUrl']; ?>consul/exten/' + id2));
			
			 }
            });	
			
			 $("#ext_from1").load(encodeURI('<?php echo $data['rootUrl']; ?>consul/exten/' + id));
			   $("#ext_to2").load(encodeURI('<?php echo $data['rootUrl']; ?>consul/exten/' + id));
			   
	       }
		   
		
		   
		  	
});



    function poner(id,id2){
			 var id = id;
			 var id2 = id2;
			 
			$("#userr").load(encodeURI('<?php echo $data['rootUrl']; ?>leader/ajax2/' + id + '/' + id2 ), function(response, status, xhr) {
			       var id_leader = $('#id_leader').val();
				 $("#userr").load(encodeURI('<?php echo $data['rootUrl']; ?>consul/superclub/' + id_leader));
			});
			
		}  
	
				
$('#agency').change(function() {
		if($("#agency").val() == ""){
                    $('#uagency').attr('disabled',true);
                    $('#uagency').val('');
                    $('#id_auser').val('');
                    $('#id_agency').val('-1');	
                    $('#comision').val('0');	
                    $('#disponible').val('0');
                }else{
                    $('#uagency').attr('disabled',false);	
                }
		
});



 $('#pax').change(function() {
				var pax = $('#pax').val();
				var pax2 = $('#pax2').val();
				var total;
				if(pax2 == ""){
				   pax2 = 0;
				  // $('#pax2').val(0);
				}
				if(pax == ""){
				   pax = 0;
				   $('#pax').val(0);
				}
				 total =(parseInt(pax)+parseInt(pax2));
				$('#totalpax').val(total);
				
				CalcularTotalTotal();			
								
		});

		 function CalcularTotal(pax_1,pax_2){						
			var transporChil1 = $("#subtochild1").val();
			var transporAdul1 = $("#subtoadult1").val();
			var transporChil2 = $("#subtochild2").val();
			var transporAdul2 = $("#subtoadult2").val();
			var price_exten01 = $("#price_exten01").val();
			var price_exten02 = $("#price_exten02").val();
			var price_exten03 = $("#price_exten03").val();
			var price_exten04 = $("#price_exten04").val();
			
			if (isNaN(transporChil1)){transporChil1 = 0;}
			if (isNaN(transporAdul1)){transporAdul1 = 0;}
			if (isNaN(transporChil2)){transporChil2 = 0;}
			if (isNaN(transporAdul2)){transporAdul2 = 0;}
			if (isNaN(price_exten01)){price_exten01 = 0;}
			if (isNaN(price_exten02)){price_exten02 = 0;}
			if (isNaN(price_exten03)){price_exten03 = 0;}
			if (isNaN(price_exten04)){price_exten04 = 0;}
			
			
			
			//alert(transporChil1+', '+transporAdul1+', '+transporChil2+', '+transporAdul2+', '+price_exten01+', '+price_exten02+', '+price_exten03+', '+price_exten04);
			var price_exten = parseFloat(price_exten01)+parseFloat(price_exten02)+parseFloat(price_exten03)+parseFloat(price_exten04);
			
			var transadult = ( parseFloat(transporAdul1)+parseFloat(transporAdul2) )* pax_1  ;
			var transchild = ( parseFloat(transporChil1)+parseFloat(transporChil2) )* pax_2 ;
			var totalA = parseFloat(transadult)+ (parseFloat(price_exten) *pax_1);
			var totalC = parseFloat(transchild)+ (parseFloat(price_exten) *pax_2);
			
			var totalP = totalA + totalC;
			
			var comi = comision();
			$("#totalComision").text(comi.toFixed(2));
			$("#totalPagar").text(totalP.toFixed(2));
			$("#totalPagar2").text(totalP.toFixed(2));	
			$("#extenadult").text('$'+(price_exten*pax_1).toFixed(2));	
			$("#extenchil").text('$'+(price_exten*pax_2).toFixed(2));
			$("#transporadult").text('$'+transadult.toFixed(2));	
			$("#subtoadult").text('$'+(totalA/parseFloat($("#pax").val())).toFixed(2));
			$("#transporechil").text('$'+transchild.toFixed(2));         		
                        if(parseFloat($("#pax2").val()) <= 0){
                            $("#subtochild").text('$0.00');	
                        }else{
                            $("#subtochild").text('$'+(totalC/parseFloat($("#pax2").val())).toFixed(2));	
                        }
			return totalP;
		}
		
		function comision(){
                    
			var id_agency = $('#id_agency').val();
			var type_rate = $('#type_rate').val();
			if(id_agency == '-1'){
				id_agency = -1;
				type_rate = 0;
			}
			if(id_agency == '-1' || type_rate == '1'){
				$("#comision").val(0);
				return 0;
			}
			var pax_1 = $('#pax').val();
			var pax_2 = $('#pax2').val();
			var total;
			if(pax_1 == ""){
			   pax_1 = 0;
			}
			if(pax_2 == ""){
			   pax_2 = 0;
			}
			
			var totalP = CalcularTotal(pax_1,pax_2);
			if(totalP != 0){	
				var transporChil1 = $("#subtochild1").val();
				var transporAdul1 = $("#subtoadult1").val();
				var transporChil2 = $("#subtochild2").val();
				var transporAdul2 = $("#subtoadult2").val();
				var porc_comi1 = $("#valorcomision01").val();
				var porc_comi2 = $("#valorcomision02").val();
				if(porc_comi2 != 0){
					var porc_comiEx =  (porc_comi1 + porc_comi2 )/2;	
					$("#comision").val((porc_comi1 + porc_comi2+porc_comiEx)/2);
				}else{
					var porc_comiEx =  porc_comi1;
					$("#comision").val(porc_comi1);
				}
				var transpor1 = (transporChil1*pax_2)+(transporAdul1*pax_1);
				var transpor2 = (transporChil2*pax_2)+(transporAdul2*pax_1);
				var transporEx = totalP - (transpor1 + transpor2);
				var comiT1 = transpor1 * porc_comi1 / 100;
				var comiT2 = transpor2 * porc_comi2 / 100;
				if(transporEx>0){
					var comiEx = transporEx * porc_comiEx  / 100;	
				}else{
					var comiEx = 0;
				}
				var comi = comiT1 + comiT2 + comiEx ;
				//alert(subtotalAdulto+', '+subtotalninio+', '+totalP+','+transporChil1+', '+transporAdul1+', '+transporChil2+', '+transporAdul2+', '+porc_comi1+', '+porc_comi2+', '+transpor1+', '+transpor2+', '+transporEx+', '+comiT1+', '+comiT2+', '+porc_comi2+', '+comiEx+', '+comi);
				
			}else{
				var comi = 0;
			}
			return comi;
		}
		
		
		
		 
		 $('#pax2').change(function() {
		     
				var pax = $('#pax').val();
				var pax2 = $('#pax2').val();
				if(pax2 == ""){
				   pax2= 0;
				    $('#pax2').val(0);
				}
				if(pax == ""){
				   pax = 0;
				    $('#pax').val(0);
				}
				var total;
				 total = (parseInt(pax)+parseInt(pax2));
                 
				$('#totalpax').val(total);
				
				CalcularTotalTotal();			
		});
		
	
		$('#oneway').change(function() {
				/*$("#round").css("display", "none");*/
	     		$("#fecha_retorno").attr("readonly", 'readonly');
				$("#fecha_retorno").attr("disable", 'disable');
				$("#from2").attr("disable",true);
				$("#from2").attr("readonly", "readonly");
				$("#pickup2").attr("readonly", "readonly");
				$("#dropoff2").attr("readonly", "readonly");
				$("#arrival2").attr("readonly", "readonly");
				$("#to2").attr("readonly", "readonly");
				$("#ext_from2").attr("readonly", "readonly");
				$("#departure2").attr("readonly", "readonly");
				$("#ext_to2").attr("readonly", "readonly");
				$("#room2").attr("readonly", "readonly");
				$("#exten3").attr("readonly", "readonly");
				$("#exten4").attr("readonly", "readonly");
				$("#trip_no2").html("");
				$("#departure2").html("");
				$("#arrival2").html("");
		});
	
		
		
		
		$('#roundtrip').change(function() {
				$("#fecha_retorno").attr("disable", '');
				$("#fecha_retorno").removeAttr("disable");
				$("#from2").attr("disable",false);
				$("#departure2").removeAttr("readonly");
				$("#dropoff2").removeAttr("readonly");
				$("#pickup2").removeAttr("readonly");
				$("#arrival2").removeAttr("readonly");
				$("#to2").removeAttr("readonly");
				$("#ext_from2").removeAttr("readonly");
				$("#ext_to2").removeAttr("readonly");
				$("#exten3").removeAttr("readonly");
				$("#exten4").removeAttr("readonly");
				$("#room2").removeAttr("readonly");
				$("#from2").removeAttr("readonly");
				$("#round").css("display", "block");
				
								
				});
		
		
$('#fecha_salida').datepicker({
	dateFormat:      'mm-dd-yy',
    maxDate:         365,
    minDate:         0,                   
});
					 
 $("#dataclick1").click(function(e) {	
		e.preventDefault();
		$("#fecha_salida").datepicker("show");
});
	
	$("#fecha_retorno").datepicker({
		dateFormat:      'mm-dd-yy',
		maxDate:         365,
        minDate:         0,
		beforeShow: function() {
			if($('#fecha_retorno').attr("disable")){
				return false;
			}
		}
	});
		 
	$("#dataclick2").click(function(e) {	
		e.preventDefault();
		$("#fecha_retorno").datepicker("show");
	});			 
		


  $("#fecha_salida").change(function(){
	  $("#trip_no").val('');
	  $("#departure1").val('');
	  $("#arrival1").val('');
	  borrar();
	  
	  fechaRetorno($("#fecha_salida").val());
  });
  function fechaRetorno(menor){
		 var d = new Date(menor);
		 d.setTime( d.getTime())
		$('#fecha_retorno').datepicker('option', 'minDate',d );
	}
  
  
  $("#fecha_retorno").change(function(){
	  $("#trip_no2").val('');
	  $("#departure2").val('');
	  $("#arrival2").val('');
  });
					 
  $("#from").change(function(){
        var id = $("#from").val();   
		 $("#pickup1").val('');
		 $("#id_p1").val(''); 
		 $("#dropoff2").val('');
		 $("#id_dropoff2").val(''); 
		 $("#dropoff1").val('');
		 $("#id_dropoff1").val(''); 
		 $("#pickup2").val('');
		 $("#id_pickup2").val(''); 
         if (id != ""){
		   $("#to").load(encodeURI('<?php echo $data['rootUrl']; ?>load/' + id),function(){
                       if(id == 1){
                           $("#to").val(7);
                       }
                   });
		    $("#ext_to1").load(encodeURI('<?php echo $data['rootUrl']; ?>exten_to_tot_of_from/' + id));
			 $("#ext_from2").load(encodeURI('<?php echo $data['rootUrl']; ?>exten_to_tot_of_from/' + id));
			
			
			 $("#from2").load(encodeURI('<?php echo $data['rootUrl']; ?>load/' + id),function(){ 
                             if(id == 1){
                                $("#from2").val(7);
                             }
                             $("#to2").load(encodeURI('<?php echo $data['rootUrl']; ?>area_to_tot_of_from/' + $("#from2").val()));
                         });
			 $("#ext_from1").load(encodeURI('<?php echo $data['rootUrl']; ?>consul/exten/' + id));
                         
		   
	}
     });
	 
	 $("#to").change(function(){
         
         var id = $("#to").val();
		 $("#dropoff2").val('');
		 $("#id_dropoff2").val(''); 
		 $("#dropoff1").val('');
		 $("#id_dropoff1").val(''); 
		 $("#pickup2").val('');
		 $("#id_pickup2").val('');   
         if (id != ""){
			  $("#ext_from2").load(encodeURI('<?php echo $data['rootUrl']; ?>consul/exten/' + id));
                          $("#from2").attr("value",id);
                          setTimeout($("#to2").load(encodeURI('<?php echo $data['rootUrl']; ?>area_to_tot_of_from/' + $("#from2").val())),200);
                          var idFrom = $("#from").val();
			 
		 }
     });
	 
	 
	  $("#from2").change(function(){
         var id = $("#from2").val();    
		 $("#dropoff2").val('');
		 $("#id_dropoff2").val(''); 
		 $("#pickup2").val('');
		 $("#id_pickup2").val('');
         if (id != ""){
		 
             $("#to2").load(encodeURI('<?php echo $data['rootUrl']; ?>load/' + id));
			 $("#ext_from2").load(encodeURI('<?php echo $data['rootUrl']; ?>consul/exten/' + id));	 
			 }
     });
	 
	 
	 
    
 $("#to2").change(function(){
         
         var id = $("#to2").val();
         $("#dropoff2").val('');
		 $("#id_dropoff2").val(''); 
         if (id != ""){
            
			 $("#ext_to2").load(encodeURI('<?php echo $data['rootUrl']; ?>consul/exten/' + id));
			 }
     });
	 
	 
	 function extenprince(id, id2){
		 var transAdult = $("#transporadult").text(); 
		 var transChild = $("#transporechil").text();
		 if(isNaN(transAdult)){ 
		 	transAdult = 0;
		 }else{
			 transAdult = parseFloat(transAdult.substring(1,transAdult.length));
		 }
		 if(isNaN(transChild)){ 
		 	transChild = 0; 
		}else{
			transChild= parseFloat(transChild.substring(1,transChild.length));
		}
         var id_agency = $("#id_agency").text();
		 var type_rate = $("#type_rate").val();
		 if(id_agency == ''){
			 id_agency = '-1';
		 }
		 
		 var url = '<?php echo $data['rootUrl']; ?>consul/extenp/' + id + '/' + id2 + '/' + transAdult + '/' + transChild + '/' + type_rate;
         $("#userr").load(encodeURI(url));
	 }
	 
	$("#ext_from1").change(function(){
         var id = $("#ext_from1").val();
		 var id2= 1;
		 extenprince(id,id2);
		 if(id > 0){
		      $('#exten1').removeAttr('disabled');
		     $("#pickup1").val('');
			 $("#id_p1").val('');
			 $('#pickup1').attr('disabled','disabled');
		 }else{
			 $('#pickup1').removeAttr('disabled');
			 $('#exten1').attr('disabled','disabled');
			 $("#exten1").val('');
			 $("#id_ext_pikup1").val('');
		 }		
     });
    $("#ext_to1").change(function(){
		 var id = $("#ext_to1").val();
    	 var id2= 2;
		  extenprince(id,id2);
        if(id > 0){
		    $('#exten2').removeAttr('disabled');
		     $("#dropoff1").val('');
			 $("#id_dropoff1").val('');
			 $('#dropoff1').attr('disabled','disabled');
		 }
		 else{
			  $('#dropoff1').removeAttr('disabled');
			  $('#exten2').attr('disabled','disabled');
			  $("#exten2").val('');
			  $("#id_ext_pikup2").val('');
		 }
     });
	 
	 $("#ext_from2").change(function(){
         
         var id = $("#ext_from2").val();
		 var id2= 3;
		 extenprince(id,id2);
        if(id > 0){
		     $('#exten3').removeAttr('disabled');
		     $("#pickup2").val('');
			 $("#id_pickup2").val('');
			 $('#pickup2').attr('disabled','disabled');
		 }else{
			 $('#pickup2').removeAttr('disabled');
			 $('#exten3').attr('disabled','disabled');
			 $("#exten3").val('');
			 $("#id_ext_pikup2").val('');
		 }
     });
    $("#ext_to2").change(function(){
         var id = $("#ext_to2").val();
		 var id2= 4;
		 extenprince(id,id2);
         if(id > 0){
		     $('#exten4').removeAttr('disabled');
		     $("#dropoff2").val('');
			 $("#id_dropoff2").val('');
			 $('#dropoff2').attr('disabled','disabled');
		 }
		 else{
			 $('#dropoff2').removeAttr('disabled');
			 $('#exten4').attr('disabled','disabled');
			 $("#exten4").val('');
			 $("#id_ext_pikup4").val('');
		 }
     });
	 
	 function valorExtra(){
		 CalcularTotalTotal();
	}
	 $("#extra").change(function(){
		  valorExtra();
     });
	 
	 $("#descuento").keypress( Event, function(e) {
        if(e.charCode > 47 && e.charCode<58){
			var char = String.fromCharCode(e.charCode);
			var valor = $("#descuento").val()
			var d =valor+ ''+char;
			if(d>100 || d<0){
				return false;
			}
			/*
			$("#descuento").val(valor + char + '%');
			var pos = valor.length;
			
			if((valor+char) == '' ){
				$("#descuento").val('0%');
			}	
			establerCursorPosicion(pos+1,'descuento');*/
		} else{
			return false;
		}
    });
	 
		
		var saber;
		
	

			
		$("#popup1 a").click(function(){
			
			var from = $('#from').val();
			var to = $('#to').val();
			var fecha_sali = $('#fecha_salida').val();
			var tipopas = $('#tipo_pass').val();
			var agency;
			if($('#id_agency').val() != '-1'){
				agency = $('#id_agency').val()
			}else{
				agency = -1;
			}
			tipo = 1;
			if($('#fecha_salida').val() != '' && $('#totalpax').val() != ''){
		
			}else{
			var mensage ="";
			if(trim($('#fecha_salida').val()) == '' ){
			    mensage += "- Departure date is required. \n";
			}
			if(trim($('#totalpax').val()) == '' ){
			    mensage += "- Total passengers required. \n";
			}
			if(trim($('#from').val()) == '' ){
			    mensage += "From is required. \n";
			}
			if(trim($('#to').val()) == '' ){
			    mensage += "To  is required. \n";
			}
			
			alert(mensage);
			
			return false;
		  
			}
			
					
			$('#mascaraP').fadeIn('slow');				
			$('#popup').fadeIn('slow');
			
			$("#transporadult").html("");
			$("#transporechil").html("");
			$("#subtoadult").html("");
		    $("#subtochild").html("");
			$("#subtoadult1").val(0);
			$("#subtochild1").val(0);
			$("#subtoadult2").val(0);
			$("#subtochild2").val(0);
			$("#transporechil").html("");
			$("#totaltotal").html("$ 00.0");
			//$("#ext_from1 option[value="+0+"]").attr("selected",true);
			$("#extenadult").html("");
			$("#extenchil").html("");
			  	  
			$('.content-popup').load('<?php echo $data['rootUrl']; ?>consul/trips/' + from + '/' + to + '/' + fecha_sali + '/' + tipopas + '/' + saber + '/' + tipo + '/'+ agency);
			saber =1;
			
		});
		
		$("#popup2 a").click(function(){
			var from = $('#from2').val();
			var to = $('#to2').val();
			var fecha_retorno = $('#fecha_retorno').val();
			var tipopas = $('#tipo_pass').val();
			
			if($('#trip_no').val() == ''){
					alert("Must fill out the form ONE WAY");
					return false;
				}

			tipo = 2;
			
			if($('#from2').attr("readonly")!="readonly"){
				if($('#fecha_retorno').val() != '' && $('#totalpax').val() != ''){
				}else{
				
				var mensage ="";
				
				
				
				if($('#fecha_retorno').val() == '' ){
					mensage += "- Return date is required. \n";
				}
				
				if($('#totalpax').val() == '' ){
					mensage += "- Total passengers required. \n";
				}
				
				if($('#from2').val() == '' ){
					mensage += "- From is required. \n";
				}
			
				if($('#to2').val() == '' ){
					mensage += "- To  is required. \n";
				}
				
				$("#subtoadult2").val("0");
			    $("#subtochild1").val("0");
			
				alert(mensage);
				
				return false;
		  
				}
				
				$('#mascaraP').fadeIn('slow');	
				$('#popup').fadeIn('slow');
				var agency;
				if($('#id_agency').val() != '-1'){
					agency = $('#id_agency').val()
				}else{
					agency = -1;
				}

				
				$('.content-popup').load('<?php echo $data['rootUrl']; ?>consul/trips/' + from + '/' + to + '/' + fecha_retorno + '/' + tipopas + '/' + saber + '/' + tipo+ '/' + agency);
			
				
				saber =2;
           // alert(texto[0]+'trips/1/12-12/1'+'][400x250]');
		   }
			
			
		});
		
		$("#newClient").click(function(){
			registrarCliente();
		});
		
		function registrarCliente(){
			var email = $("#email1").val();
			var firstname = $("#firstname1").val();
			var lastname = $("#lastname1").val();
			var phone = $("#phone1").val();
			var id = $("#idCliente").val();
			if(id == ''){
				id = 0;
			}
			if(email==''){
				email = 0;
			}
			if(firstname==''){
				firstname = 0;
			}
			if(lastname==''){
				lastname = 0;
			}
			if(phone==''){
				phone = 0;
			}
			$("#clienteN").load(encodeURI('<?php echo $data['rootUrl']; ?>admin/clientes/pagador/'+email+'/'+firstname+'/'+lastname+'/'+phone+'/'+id),function(){
                            $("input[name='creator']").remove();
                        }); 
			$('#mascaraP').fadeIn('slow');				
			$('#clienteN').fadeIn('slow');
			$("#email1").focus();
			//setInterval('setTimeout("activarenvioPago()",5000)',5000);
		}
		
		
	function borrar(){
		$("#transporadult").html("");
		$("#transporechil").html("");
		$("#subtoadult").html("");
		$("#subtochild").html("");
		$("#totaltotal").html("$ 00.0");
		//$("#ext_from1 option[value="+0+"]").attr("selected",true);
		$("#extenadult").html("");
		$("#extenchil").html("");
		$("#totalPagar").html('$ 00.00');
	}	
	   
    function llamar(extraSettings,$innerbox){
	   var $innerbox = $innerbox;
	   var dato = extraSettings;
	   if(saber == 1){
		   var from = $('#from').val();
		   var to = $('#to').val();
		   var fecha_sali = $('#fecha_salida').val();
		   var tipopas = $('#tipo_pass').val();
	   }else{
		   var from = $('#from2').val();
		   var to = $('#to2').val();
		   var fecha_sali = $('#fecha_retorno').val();
		   var tipopas = $('#tipo_pass').val();
	   }
	   
	   var ruta = dato[0]  + '/' + from + '/' + to + '/' + fecha_sali + '/' + tipopas + '/' + saber;
	                 // alert(ruta);
				
					$.get( ruta, function(data){
						$(data).appendTo($innerbox);
					});
			
			if(saber == 1){		
		    var mensage ="";
			if($('#fecha_salida').val() == '' ){
			    mensage += "- Departure date is required. \n";
			}
			if($('#totalpax').val() == '' ){
			    mensage += "Total pass  is requerido. \n";
			}
			if($('#from').val() == '' ){
			    mensage += "From is requerido. \n";
			}
			if($('#to').val() == '' ){
			    mensage += "to  is requerido. \n";
			}
			
			
			
			if(mensage){
			
			$("P.close A").click();
			}
			}
			else{
			 var mensage ="";
			if($('#fecha_retorno').val() == '' ){
			    mensage += "fecha salida is requerida. \n";
			}
			if($('#totalpax').val() == '' ){
			    mensage += "total pass  is requerido. \n";
			}
			if($('#from2').val() == '' ){
			    mensage += "From is requerido. \n";
			}
			if($('#to2').val() == '' ){
			    mensage += "to  is requerido. \n";
			}
			
			
			
			if(mensage){
			
			$("P.close A").click();
			}
			
			
			}		
	}
    $('#btn-save1').click(function(){
       if(validarFomulario()){
		   CalcularTotalTotal();
		$("#totP").val($("#totalPagar").text());		
		$("#transadult").val($("#transporadult").text().substring(1,$("#transporadult").text().length));		
		$("#transchild").val($("#transporechil").text().substring(1,$("#transporechil").text().length));	
		$("#formula").attr('target','_parent');
		$("#formula").attr('action','<?php echo $data['rootUrl']; ?>admin/reservas/save');	
		$("#formula").submit();
		}
		
    });
	
	$('#btn-save2').click(function(){
       if(validarFomulario()){
		   CalcularTotalTotal();
		$("#totP").val($("#totalPagar").text());		
		$("#transadult").val($("#transporadult").text().substring(1,$("#transporadult").text().length));		
		$("#transchild").val($("#transporechil").text().substring(1,$("#transporechil").text().length));
		$("#formula").attr('target','_parent');
		$("#formula").attr('action','<?php echo $data['rootUrl']; ?>admin/reservas/save');
		$("#formula").submit();
		}
		
    });
	
	$("#enviarF").click(function(){
		 if(validarFomulario()){
			 if($("#enviar_escondido").val()==1){
				 $("#enviar_escondido").val(0);
				 irApagar();
			 }else{
				 registrarCliente(); 
			 }
		 }
	});
	
	function irApagar(){
		if(validarFomulario()){
			 CalcularTotalTotal();
			$("#totP").val($("#totalPagar").text());		
			$("#transadult").val($("#transporadult").text().substring(1,$("#transporadult").text().length));		
			$("#transchild").val($("#transporechil").text().substring(1,$("#transporechil").text().length));
			$("#formula").attr('action','<?php echo $data['rootUrl']; ?>admin/reservas/pago');
			$("#formula").attr('target','_blank');			
			var hilo = setInterval("estadoPago()",5000);
			$("#formula").submit();
		 }
	}
	
	function activarenvioPago(){
			if($("#enviar_escondido").val()==1){
				$("#enviar_escondido").val(0);
				irApagar();
			}
	}
	
	function validarFomulario(){
		var msError = '';
		if(trim($("#idCliente").val())==''){
			if(trim($("#firstname1").val())==''){
				msError = '- Enter the first name of the passenger';
				alert(msError);
				$("#leader").focus();	
				return false;
			}
			
			if(trim($("#lastname1").val())==''){
				msError = '- Enter the last name of the passenger';
				alert(msError);
				$("#leader").focus();	
				return false;
			}
			
			if(trim($("#phone1").val())==''){
				msError = '- Enter the phone of the passenger';
				alert(msError);
				$("#leader").focus();	
				return false;
			}
			
		}
		if(trim($("#id_agency").val())!='-1' && trim($("#id_agency").val()) != ''){
			if(trim($("#id_auser").val())==''){
				msError = '- Enter employee data Agency';
				alert(msError);
				$("#uagency").focus();
				return false;
			}
		}
		
		var canal  = 0;
		var num = document.getElementsByName('canal').length
		for(var i = 0; i<num; i++){
			 if(document.getElementsByName('canal').item(i).checked){
				 canal = document.getElementsByName('canal').item(i).value;
			}
		}
		if(canal == 0){
			msError = '- Select the channel through which came the reservation.';
			alert(msError);
			$("#calan_phone").focus();
			return false;
		}
		
		if(trim($("#trip_no").val())==''){
			msError = '- Select Output Trip';
			alert(msError);
			$("#trip_no").focus();
			return false;
		}
		if(trim($("#id_p1").val())==''  && trim($("#ext_from1").val())=='0'){
			msError = '- Enter  pickup of ONE WAY';
			alert(msError);
			$("#pickup1").focus();
			return false;
		}
		
		if(trim($("#id_dropoff1").val())==''  && trim($("#ext_to1").val())=='0'){
			msError = '- Enter  dropoff of ONE WAY';
			alert(msError);
			$("#dropoff1").focus();
			return false;
		}
		
		
		
		if(document.getElementById('roundtrip').checked){
			if(trim($("#trip_no2").val())==''){
				msError = '- Select Return Trip';
				alert(msError);
				$("#trip_no2").focus();
				return false;
			}
			if(trim($("#id_pickup2").val())==''  && trim($("#ext_from2").val())=='0'){
				msError = '- Enter  pickup of Return TRIP';
				alert(msError);
				$("#pickup2").focus();
				return false;
			}
			if(trim($("#id_dropoff2").val())==''  && trim($("#ext_to2").val())=='0'){
				msError = '- Enter  dropoff of Return TRIP';
				alert(msError);
				$("#dropoff2").focus();
				return false;
			}		
			
		}
		
		var tipo_pago  = 0;
		var num = document.getElementsByName('opcion_pago').length
		for(var i = 0; i<num; i++){
			 if(document.getElementsByName('opcion_pago').item(i).checked){
				 tipo_pago = document.getElementsByName('opcion_pago').item(i).value;
			}
		}
		if(tipo_pago == 0){
			msError = '- Select the type of payment';
			alert(msError);
			return false;
		}
		
		return true;
	}
	
    $('#btn-cancel1').click(function(){
        window.location = '<?php echo $data['rootUrl']; ?>admin/reservas';
    });
    
function trim (myString){
	if(myString == null ||myString == ''){
		return '';
	}
	return myString.replace(/^\s+/g,'').replace(/\s+$/g,'')
}


function CalcularTotalTotal(){
	var  error = "";
	var pax = $('#pax').val();
	var pax2 = $('#pax2').val();
	if(pax2 == ""){  pax2 = 0; }
	if(pax == ""){   pax = 0;  }
	
	
	error += validateNumber($("#extra").val(), 'Extra', true);
	var extra = 0;
	if(error == ""){
		extra = $("#extra").val();
	}
	
	var comi= comision();
	var full = CalcularTotal(pax,pax2);
	var balance = full-comi;
	var disponible = $("#disponible").val();
	var agency = $("#id_agency").val();
	var fee = full*0.04;
	var tipo_pago  = 0;
	var num = document.getElementsByName('opcion_pago').length
	for(var i = 0; i<num; i++){
		 if(document.getElementsByName('opcion_pago').item(i).checked){
			 tipo_pago = document.getElementsByName('opcion_pago').item(i).value;
		}
	}
	var tipo_saldo = $('#opcion_pago_saldo').val();
	var apagar = full;
	if(tipo_saldo == 2){ 
		apagar = balance;	
	}
	
	
	//RESTAMOS DESCUENTO DE %
	error = "";
	error += validateNumber($("#descuento").val(), 'Descuento', true);
	var desc_porc = 0;
	if(error == ""){
		desc_porc = $("#descuento").val();
	} 

	
	//RESTAMOS DESCUENTO DE $
	error = "";
	error += validateNumber($("#descuento_valor").val(), 'Descuento Valor', true);
	var desc_valor = 0;
	if(error == ""){
		desc_valor = $("#descuento_valor").val();
	} 
	apagar = parseFloat(apagar) + parseFloat(extra) - parseFloat( (full*desc_porc)/100 ) - parseFloat(desc_valor);
	var totalPax = parseFloat(pax)+parseFloat(pax2);
	$("#totalComision").text(comi.toFixed(2));
	if(tipo_pago==5){
		if(disponible-balance<0){
			/*alert('Your available credit is less than the total amount to be paid');
			$("#opcion_pago").attr("checked",false);
			$("#opcion_saldo1").attr('checked',false);
			$("#opcion_saldo2").attr('checked',false);
			$("#opcion_saldo2").attr('disabled',false);
			$("#opcion_saldo1").attr('disabled',false);*/
			$("#opcion_saldo2").attr('checked',true);
			$("#opcion_saldo1").attr('disabled',true);
			$("#opcion_saldo2").attr('disabled',false);
			$("#opcion_pago_saldo").val('2');
			$("#totalPagar").text((balance).toFixed(2));
			$("#totaltotal").text((balance).toFixed(2));
		}else{
			$("#opcion_saldo2").attr('checked',true);
			$("#opcion_saldo1").attr('disabled',true);
			$("#opcion_saldo2").attr('disabled',false);
			$("#opcion_pago_saldo").val('2');
			$("#totalPagar").text((balance).toFixed(2));
			$("#totaltotal").text((balance).toFixed(2));
		}
	}else if(tipo_pago==1){
			$("#opcion_saldo2").attr('checked',true);
			$("#opcion_saldo1").attr('disabled',true);
			$("#opcion_saldo2").attr('disabled',false);
			$("#opcion_pago_saldo").val('2');
			$("#totalPagar").text((balance).toFixed(2));
			$("#totaltotal").text((balance).toFixed(2));
	}else{
			$("#opcion_saldo2").attr('disabled',false);
			$("#opcion_saldo1").attr('disabled',false);
		if(tipo_pago==3){
			$("#totalPagar").text((apagar + fee).toFixed(2));
			$("#totaltotal").text((apagar + fee).toFixed(2));
		}else{
			$("#totalPagar").text((apagar).toFixed(2));
			$("#totaltotal").text((apagar).toFixed(2));
		}
	}
	if(tipo_pago == 1 || tipo_pago == 2){
		$('#enviarF').css('display','block');
		$('#btn-save1').css('display','none');
		$('#btn-save2').css('display','none');
	}else{
		$('#enviarF').css('display','none');
		$('#btn-save1').css('display','block');
		$('#btn-save2').css('display','block');
	} 		
}

$('#opcion_saldo1, #opcion_saldo2').change(function(){
	if($(this).get(0).id=='opcion_saldo1'){
	  $('#opcion_pago_saldo').val('1');
	}else if($(this).get(0).id=='opcion_saldo2'){
	  $('#opcion_pago_saldo').val('2');
	}
	CalcularTotalTotal();
}); 

$('#opcion_pago_passager, #opcion_pago_agency, #opcion_pago_predpaid_cash,#opcion_pago_complementary,#opcion_pago_CrediFee, #opcion_pago_Cash,#opcion_pago_Voucher').change(function(e) {
    CalcularTotalTotal();
});
	   
	 
 
 function estadoPago(){
	$("#estadoTranssacion").load('<?php echo $data['rootUrl']; ?>transaction/admin/reserva/pago');
 }
 
 $("#cardholder").click(function(e) {
    if($("#cardholder").is(':checked')){
		var idPagador = $("#idPagador").val();
		var idCliente = $("#idCliente").val();
		$("#idPagador_aux").val(idPagador);
		$("#idPagador").val(idCliente);
	}else{
		 var idPagador = $("#idPagador_aux").val();
		 $("#idPagador").val(idPagador);
	}
});


function mosrtarTrips(left,top){
		$( "#dialog_states__trips" ).dialog({
		  autoOpen: false,
		  width: 300,   
		  height: 300,
		  show: {
			effect: "blind",
			duration: 1000
		  },
		  hide: {
			effect: "blind",
			duration: 1000
		  },
		  position: [left-260,top+50],
		});
		 $("#states__trips_conte").empty().html('<img src="<?php echo $data['rootUrl']; ?>global/images/loading.gif"   width="100px" height="100px" id="gif"/>');
		  $("#states__trips_conte").load('<?php echo $data['rootUrl']; ?>admin/reservas/estado_trips');
		$( "#dialog_states__trips" ).dialog( "open" );
}

 $( "#bnt-trips" ).click(function() {
		var posicion =  $( this  ).position();
		mosrtarTrips(posicion.left,posicion.top);
 });
 
  function estadoTrip(){
		$("#mensajeTrip").load('<?php echo $data['rootUrl']; ?>admin/reservas/consultatrip');
  }
 
 function preguntaTrip(){
	 $("#dialog-trip-pregunta" ).dialog({
      resizable: false,
      height:250,
      modal: true,
      buttons: {
        "YES": function() {
		  $("#puestosEnUso").load("<?php echo $data['rootUrl']; ?>admin/reservas/ocuparPuestoUsuario/2");
          $( this ).dialog( "close" );
        },
        'NOT': function() {
		    $("#puestosEnUso").load("<?php echo $data['rootUrl']; ?>admin/reservas/ocuparPuestoUsuario/4");
          $( this ).dialog( "close" );
        }
      }
    });
}

</script>



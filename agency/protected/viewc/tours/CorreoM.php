<head>
<style type='text/css'>
#clearTable {
	width: 800px;
	font-size: 13px;
	font-family: Verdana, Geneva, sans-serif;
}
#clearTable tr #titletd3 {
	font-family: Verdana, Geneva, sans-serif;
}
#clearTable tr #titletd2 {
	font-size: 20px;
}
#clearTable tr td p {
	text-align: center;
}

#content #center-column #tdgris {
	background-color: #F0F0F0;
}
#content #center-column #tdrojo {
	background-color: #FFE6E6;
}
#content #center-column1 #titletd {
	background-color: #F5EDEB;
	padding-left: 5px;
	font-size: 12px;
}
 #titlett {
	background-color: #E8E8E8;
	padding-left: 5px;
	font-size: 12px;
}
 #titlell {
	padding-left: 5px;
	font-size: 12px;
	border-bottom-width: 1px;
	border-left-width: 1px;
	border-bottom-style: solid;
	border-left-style: solid;
	border-bottom-color: #E6E6E6;
	border-left-color: #E6E6E6;
}
#titlelp {
	padding-left: 5px;
	font-size: 12px;
	border-bottom-width: 1px;
	border-bottom-style: solid;
	border-bottom-color: #E6E6E6;
}
 #titlelr {
	padding-left: 5px;
	font-size: 12px;
	border-top-width: 1px;
	border-top-style: solid;
	border-top-color: #CE0000;
	color: #CE0000;
}
 #tdgristable {
	background-color: #FFF;
	padding-left: 5px;
}



.Estilo1 {color: #FF0000}
</style>
</head>

 <div id="byti">
     <div id="byti2">
     <table width="27%" class="redondo" id="toursbooking">
<tr>
                                            <td valign="top" >
                                               <div id="yourtour" class="bksep">
                                                    <table width="100%" >
                                                        <tr>
                                                            <td align="left" ><div class="booking-title"><img src="<?php echo $data['rootUrl']; ?>global/img/yourtour.png"/></div></td>
                                                      </tr>
                                                       <tr>
                              <td align="center" ><font color="#FF0000"><span id="premiun"><?php
                              if($_SESSION ['toursbooking']['question']==1)
								  echo 'PREMIUM SHEDULED';
							   else
							   		echo 'PRIVATE SERVICE';
							  ?></span></font></td>
                            </tr>
                                                        <tr>
                                                          <td height="30" align="center" style="padding:5px"><table>
                                                            <tr align="center" valign="middle">
                                                                <td>Tour Length:</td>
                                                             </tr>
                                                             <tr align="center" valign="middle">
                                                                <td colspan="2"><font> <? echo $toursbooking['dias']; ?></font> Days <font color="#FF0000"> <? echo $toursbooking['noches']; ?></font> Nights</td>
                                                             </tr>
                                                             <tr align="center" valign="middle">
                                                                <td colspan="2">Total of <font> <? echo $toursbooking['totalpax']; ?></font> Passengers</td>
                                                             </tr>      
                                                            </table>                                                                                                </td>
                                                      </tr>
                                                    </table>
                                               </div>

                                              <div id="itinerarty" class="bksep">
                                                    <table width="100%">
                                                        
                                                        <tr>
                                                            <td colspan="2" class="booking-title">ARRIVAL</td>
                                                        </tr>
                                                        <tr valign="top">
                                                            <td width="100%"><table width="100%">
                                                              <tr valign="top">
                                                                <td width="51">Arrival Date:</td>
                                                                <td width="258"><font class="bkfont"><? echo date("l", strtotime($toursbooking['fecha_llegada'])); ?>,<? echo date("M", strtotime($toursbooking['fecha_llegada'])); ?> <? echo date("d", strtotime($toursbooking['fecha_llegada'])); ?>,<? echo date("Y", strtotime($toursbooking['fecha_llegada'])); ?></font></td>
                                                              </tr>
                                                              <tr valign="top">
                                                                <td>Arriving:</td>
                                                                <td><font class="bkfont"><?php if($_SESSION['toursbooking']['sarrival']==1 || $_SESSION['toursbooking']['sarrival']==2){
	echo 'by '.$toursbooking['service1'] .' from Miami';
}else{
	echo 'by '.$toursbooking['service1'] ;
}?></font></td>
                                                              </tr>
                                                              <? if(isset($toursbooking['trip1'])){?>
                                                              
                                                              <? } ?>
                                                          </table></td>
                                                      </tr>
                                                        
                                                    </table>
                                              </div>
                                              <div id="accomodation" class="bksep">
                                                    <table width="100%">
                                                        <tr>
                                                            <td colspan="2" class="booking-title">ACCOMMODATION</td>
                                                        </tr>
                                                        <tr valign="top">
                                                          <td width="100%">
                                                          <table width="98%">
                                                            <tr valign="middle">
                                                              <td width="60">Hotel</td>
                                                              <td width="237"><font class="bkfont"><? echo $toursbooking['hotel'];?></font></td>
                                                            </tr>
                                                            <tr valign="middle">
                                                              <td>Room(s):</td>
                                                              <td><font class="bkfont"><? echo $toursbooking['rooms']; ?></font></td>
                                                            </tr>
                                                            <tr valign="middle">
                                                              <td height="20" colspan="2"><span style="font-size:9px;"><?php 
								 if(isset($_SESSION ['menosbuff']['buff'] )){
									echo $_SESSION ['menosbuff']['buff'] ;		
									}else{ echo 'Free Breakfast  ';}
							?></span></td>
                                                            </tr>
                                                          </table></td>
                                                        </tr>
                                                    </table>
                                              </div>
                                                <div id="accomodation" class="bksep"></div>
                                               <div id="tours-price" class="bksep">
                                                <table width="100%">
                                                        <tr>
                                                            <td colspan="2" class="booking-title" >
<?php echo ($_SESSION['toursbooking']['sarrival']==4)?'LOCAL TRANSFERS TO PARKS BY CAR':'LOCAL TRANSFERS TO PARKS';?>&nbsp;</td>
                                                        </tr>
                                                        <tr valign="top">
                                                          <td style="padding:7px">
                                                          <div id="attractions2">
                                                          <? echo "<ol>";
		  foreach($namepark as $value)
		    {
					echo "<li>".$value."</li>";
			
			}
			echo "</ol>";
		 ?> 
                                                          </div>
                                                          </td>
                                                        </tr>
                                                 </table>
                                              </div>
                                               <div id="accomodation" class="bksep">
                                      <table width="100%">
                                                        <tr>
                                                            <td colspan="2" class="booking-title">PARKS TICKETS</td>
                                                        </tr>
                                                        <tr valign="top">
                                                          <td width="100%">
                                                          <table width="98%">
                                                            <tr valign="middle">
                                                              <td><span  id="tickes"><? echo ($toursbooking['ticketpark']==1?'INCLUDED in tour price':'NOT INCLUDED in tour price');?></span></td>
                                                            </tr>
                                                            <tr valign="middle">
                                                              <td>&nbsp;</td>
                                                            </tr>
                                                            <tr valign="middle">
                                                              <td>&nbsp;</td>
                                                            </tr>
                                                          </table></td>
                                                        </tr>
                                                    </table>
                                            
                                              <table width="100%">
                       	  <tr>
                                                                                            <td colspan="2" class="booking-title">  <span style="text-align:">DEPARTURE</span></td>
                                           	    </tr>
                                                                                        <tr valign="top">
                                                                                                <td width="100%" height="64" style="padding:7px"><table width="100%">
                                                                                                  <tr valign="top">
                                                                                                    <td width="100%">Departure Date:</td>
                                                                                                    <td width="100%"><font color="#FF0000"><? echo date("l", strtotime($toursbooking['fecha_salida'])); ?>,<? echo date("M", strtotime($toursbooking['fecha_salida'])); ?> <? echo date("d", strtotime($toursbooking['fecha_salida'])); ?>,<? echo date("Y", strtotime($toursbooking['fecha_salida'])); ?></font></td>
                                                                                                  </tr>
                                                                                                  <tr valign="top">
                                                                                                    <td>Departure:</td>
                                                                                                    <td><font color="#FF0000" > <?php 
		if($_SESSION['toursbooking']['sdeparture']==1 || $_SESSION['toursbooking']['sdeparture']==2){
	echo 'by '.$toursbooking['service2'] .' To Miami';
}else{
	echo 'by '.$toursbooking['service2'] ;
}?>         </font></td>
                                                                                                  </tr>
                                                                                                  
                                                                                                </table></td>
                                                                                      </tr>
                                              </table>
        </tr>
                                    </table>
                                  <div id="tq" class="redondo">
                                    <div id="tqp-text">TOURS PRICE</div>
                                    <div id="tqp-text-2">PER PERSON (Including Taxes)</div>
                                    <div id="tqp">$<? echo round($toursbooking['tqp']);?></div></div>
                                
                                <!-- fin buy ticket -->
                                
       </div>
     <div id="byti3">
      <table width="100%"  id="clearTable"> 
     <tr>
    <!--td width="79%" height="21" id="titletd"> <p><strong>QUOTATION #: 000001   (This is not a CONFIRMATION number)</strong></p></td-->
    <td width="21%" id="titletd">Date:   <? echo date("M-d-Y");?></td>
     </tr>
  <tr>
    <td colspan="2" >

        <!--formulario de confirmaciòn.-->
    <div id="formConfirm">
    <table id="tableorder"  width="96%">
      <tr>
        <td height="28" colspan="6"  ><div align="right" ><strong><? echo $toursbooking['adults'];?></strong> ADULTS AND <strong><? echo $toursbooking['childs'];?></strong> CHILDREN TOTAL OF <strong><? echo $toursbooking['totalpax'];?></strong> PASSENGERS </div></td>
        </tr>

       <tr>
        <?php 
          if(isset($_SESSION ["tourstick"])){
             $user = $_SESSION ["tourstick"];
             
          }
        ?>
           <td><span id="r1">Firstname: </span></td>
        
        <td><input type="text" name="firstname_tick" id="firstname"  value="<?php echo isset($user)?$user['firstname']:""; ?>"/></td>
        <td colspan="3"><span id="r2">Lastname: </span></td>
        <td width="36%"><input type="text" name="lastname_tick" id="lastname"   value="<?php echo isset($user)?$user['lastname']:""; ?>" /></td>
      </tr>
      <tr>
        <td width="11%"><span id="r3">E-Mail: </span>          </td>
        <td width="34%"><input type="text" name="email_tick" id="email"   value="<?php echo isset($user)?$user['email']:""; ?>" /></td>
       <td colspan="3"><span id="r6">Cell Phone: </span>         </td>
        <td><input type="text" name="cellular_tick" id="cellular"   value="<?php echo isset($user)?$user['cellphone']:""; ?>"  /></td>
      </tr>
      <tr>
        <td><span id="r5">Phone:</span></td>
        <td><input type="text" name="phone_tick" id="phone"   value="<?php echo isset($user)?$user['phone']:""; ?>" /></td>
        
      </tr>
    </table>
       </div>
	   
	<!-- Carga la tabla de itinerarios, dependiendo del tipo de bus que escojan -->   
    <div id="idIt">
   <?php include_once('ResponseItinerary.php'); ?>
        <table id="tableorder" width="96%">
 
      <?php 
        if(isset($_SESSION['data_agency'])){
           Doo::loadModel("Agency");
           $dat = new Agency($_SESSION['data_agency']);
           Doo::loadModel("Agency_Account");
           $acountAgen = new Agency_Account($_SESSION['agencyAcount']);
           
           if($dat->type_rate == '0'){ 
             echo ("<tr>
               <td>&nbsp;</td>
               <td>&nbsp;</td>
               <td id=\"titlelr\" align=\"center\" >Agency Comision</td>
               <td colspan=\"2\"  id=\"titlelr\" ><strong>$ ".number_format($toursbooking['comision_agency'], 2, '.', '')."</strong></td>
             </tr>"); 
            }
        }
        ?>
      
    
     
        </table>
        
            
	</div>
    
         <table width="96%" border="0">
        
        
      <tr>
        <td height="32" align="center"><strong>TOTAL AMOUNT for THIS TOUR:</strong> <STRONG id="total_amount" STYLE="COLOR:rED;" >$<? 
		echo number_format($toursbooking['tqp'] * $toursbooking['totalpax'], 2, '.', '') ;
		?></sTRONG> 
        <? $toursbooking['totaltotal'] = number_format($toursbooking['tqp'] * $toursbooking['totalpax'], 2, '.', '') ; ?>
            <input class="input-text" id="tqprice1" name="angency_fee" type="hidden" value=""  ></input></td>
      </tr>
       <tr id="error" style="display:none;" >
        <td  id="titlelr" align="center" colspan="5" style="backgroup-color:blue; color:rgb(153,51,0);" ><div id="msg">Error </div></td>
      </tr>      
      <tr>
        <td height="40" align="center" ><span class="Estilo1">CHECK YOUR TOUR BEFORE PROCEEDING WITH  PAY TOUR</span></td>
      </tr>
      <tr>
        <td align="center">Once you select the PAY TOUR button, you can no longer make changes to your TOUR  online. You must call (407) 370-3001 and speak with our  Call Center.<br /></td>
      </tr>
    </table>
    <table width="90%" border="0" style="padding-left:20px;">
      <tr>
        <td height="20" colspan="2"><h5 class="Estilo3">PLEASE  READ  THE  TERMS  AND  BOOK ING  COND IT IONS</h5></td>
      </tr>
      <tr>
        <td width="3%" height="21" ><label>
          <input type="checkbox" name="ter1" id="ter1" />
        </label></td>
        <td width="97%" >I accept the <a href="<?php echo $data['rootUrl']; ?>terms-conditions-tours" target="_blank">Terms and Conditions</a> </td>
      </tr>
      <tr>
        <td><label>
          <input type="checkbox" name="ter2" id="ter2" />
          </label>
            <br /></td>
        <td>I accept the <a href="<?php echo $data['rootUrl']; ?>cancellation-policies"  target="_blank" >Cancellation Policy</a></td>
      </tr>
    </table>
    <p>&nbsp;</p>
          </td>
  </tr>
      </table>
    
      </div>

    </div>
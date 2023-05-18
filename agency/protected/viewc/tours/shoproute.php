<?php $disponible = $data['disponible'];
		Doo::loadModel("Agency");
        if(isset($_SESSION['data_agency'])){
           $dat = new Agency($_SESSION['data_agency']);
           Doo::loadModel("Agency_Account");
           $acountAgen = new Agency_Account($_SESSION['agencyAcount']);
		}else{
			$dat = new Agency();
			$dat->type_rate == 0;
		}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>Supertours Of Orlando, Inc.</title>
        
        <link href="<?php echo $data['rootUrl']; ?>global/styles.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo $data['rootUrl']; ?>global/styles-Tours.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo $data['rootUrl']; ?>global/css/style.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo $data['rootUrl']; ?>global/menu.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="<?php echo $data['rootUrl']; ?>global/css/jquery-ui-timepicker-addon.css"> 

           
          

            <link rel="stylesheet" href="<?php echo $data['rootUrl']; ?>global/themes/base/jquery.ui.all.css">  

                <link rel="stylesheet" type="text/css" href="<?php echo $data['rootUrl']; ?>global/css/blitzer/jquery-ui-1.8.16.custom.css" />
                <link rel="stylesheet" href="<?php echo $data['rootUrl']; ?>global/css/nav.css"> 

                    <link rel="stylesheet" type="text/css" href="<?php echo $data['rootUrl']; ?>global/css/jquery.notice.css"/>  


                   <script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/jquery.min.js"  language="javascript"></script>
                    <script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/jquery-ui.min.js"></script>
                    <!-- <script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/jquery.tipTip.js"></script>
                    <script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/jquery.tipTip.minified.js"></script>

                    <script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/jquery-ui-timepicker-addon.js"></script>
                    <script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/jquery-ui-sliderAccess.js"></script>

                    <script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/jquery.ddslick.min.js"></script>
                    <script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/jquery.validator.js"></script>
					<!--<script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/jquery-latest.js"></script>
                    
                    <script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/booking.js"></script>
                            <script src="<?php echo $data['rootUrl']; ?>global/js/modernizr.js"></script>
                            <script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/form.js"></script>
                      
						function valid(){
							     if(!$('#ter1').attr('checked') && !$('#ter2').attr('checked'))
							     {     
								   	alert(' PLEA SE READ THE TERMS AND BOOK ING COND IT IONS');
									return false;
								 }else{
							          if (validateForm())
									  {
							             return false;
										// $('#form1').submit();
                                      }else{
									     return false;
									  }
							      }
					    }	
							
							
                 	 
                            </script>
                     -->      

                          <script type="text/javascript">
            $(document).ready(function() {		
	
							 $('#nav li').hover(
								function () {
									//show its submenu
									$('ul', this).slideDown(100);
								},
								function () {
									//hide its submenu
									$('ul', this).slideUp(100);        
								}
							);
                    var v = $('#resp2').val();		
					
					
				
				});
           
				 </script>
           
				

                    <style>
                        .notFilled{
                            border: 2px solid #f00;
                            background: #f99;
                        }
                        input.error 
                        {
                            border: solid 1px red;  
                            color: Red;    
                        }


                    .Estilo1 {color: #FF0000}
.Estilo3 {font-weight: bold; color: #1941A5;}

					.totalRojo{
						padding-left: 5px;
				font-size: 12px;
				border-top-width: 1px;
				border-top-style: solid;
				border-top-color: #CE0000;
				color: #CE0000;
}
					
                    </style>




                    </head>

                    <body class="no-js" >
                        <script>
                                                var el = document.getElementsByTagName("body")[0];
                                                el.className = "";
                        </script>
                        <noscript>
                            <!--[if IE]>
                            <link rel="stylesheet" href="css/ie.css">
                        <![endif]-->
                        </noscript>
                        <div id="contenedor">
                            <div id="header">
                                <div id="logo" ><a href="<?php echo $data['rootUrl']; ?>"><img src="<?php echo $data['rootUrl']; ?>global/images/logo.png" width="316" height="119" border="0" /></a></div>
  <div style="display:inline; float:right;">
                <a class="home img-link" href="<?php echo $data['rootUrl']; ?>" id="home">Home</a>
     <?php if(isset($_SESSION['user'])){ ?>          
      <a class="logout img-link" href="<?php echo $data['rootUrl']; ?>close/session">Logout</a>
     <?php } ?>
   </div>
                                <div id="redes"><div id="iconos"><div id="redesGo"></div><div id="redesGo"><a href="https://www.facebook.com/pages/Supertours-of-Orlando/157301064337315" target="_blank"><img src="<?php echo $data['rootUrl']; ?>global/images/Icon-facebook-Colombia.png"  border="0" /></a></div><div id="redesGo"><a href="<?php echo $data['rootUrl']; ?>contact-us-supertours"><img src="<?php echo $data['rootUrl']; ?>global/images/Icon-gmail-Colombia.png"  border="0" /></a></div></div>
                                    <div class="textosHead" >Toll Free <b> 1-800-251-4206 </b>- Open <br />
                                        From 4 am To Midnight - (Eastern Time) <br />
                                        <strong>Hablamos Español</strong></div> </div>
                            </div>
                            <div id="barra">
<?php
	include_once('global/menu/menu1.php');?>
    </div>

                            <div id="policy"> 
                                <?php
                                if (isset($_SESSION["toursbooking"]) && isset($_SESSION["namepark"])) {
                                    $toursbooking = $_SESSION["toursbooking"];
				    $namepark = $_SESSION['namepark'];
                                }
                                ?>
                                <div id="contendinfo">
                                    <div id="mapmarcohome">
                                       
                                        <div id="contenidohometours"><br />
                                           
                                                <div id="content">
                                                <form id="form1" class="form" action="<?php echo $data['rootUrl']; ?>tours/userlog" onsubmit="valid()" method="post" name="form1">
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
                                                        <tr >
                                                          <td height="30" align="center" style="padding:5px"><table>
                                                            <tr align="center" valign="middle">
                                                                <td>Tour Length:</td>
                                                             </tr>
                                                             <tr align="center" valign="middle">
                                                                <td colspan="2"><font> <?php echo $toursbooking['dias']; ?></font> Days <font color="#FF0000"> <?php echo $toursbooking['noches']; ?></font> Nights</td>
                                                             </tr>
                                                             <tr align="center" valign="middle">
                                                                <td colspan="2">Total of <font> <?php echo $toursbooking['totalpax']; ?></font> Passengers</td>
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
                                                                <td width="258"><font class="bkfont"><?php echo date("l", strtotime($toursbooking['fecha_llegada'])); ?>,<? echo date("M", strtotime($toursbooking['fecha_llegada'])); ?> <? echo date("d", strtotime($toursbooking['fecha_llegada'])); ?>,<? echo date("Y", strtotime($toursbooking['fecha_llegada'])); ?></font></td>
                                                              </tr>
                                                              <tr valign="top">
                                                                <td>Arriving:</td>
                                                                <td><font class="bkfont"><?php if($_SESSION['toursbooking']['sarrival']==1 || $_SESSION['toursbooking']['sarrival']==2){
	echo 'by '.$toursbooking['service1'] .' from Miami';
}else{
	echo 'by '.$toursbooking['service1'] ;
}?></font></td>
                                                              </tr>
                                                              <?php if(isset($toursbooking['trip1'])){?>
                                                              
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
                                                              <td width="237"><font class="bkfont"><?php echo $toursbooking['hotel'];?></font></td>
                                                            </tr>
                                                            <tr valign="middle">
                                                              <td>Room(s):</td>
                                                              <td><font class="bkfont"><?php echo $toursbooking['rooms']; ?></font></td>
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
                                                          <?php echo "<ol>";
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
                                                              <td><span  id="tickes"><?php echo ($toursbooking['ticketpark']==1?'INCLUDED in tour price':'NOT INCLUDED in tour price');?></span></td>
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
                                    <div id="tqp-text">TOUR PRICE</div>
                                    <div id="tqp-text-2">PER PERSON (Including Taxes)</div>
                                    <div id="tqp">$<?php echo round($toursbooking['tqp']);?></div></div>
                                
                                <!-- fin buy ticket -->
                                
       </div>
     <div id="byti3">
      <table width="100%"  id="clearTable" cellpadding="0"> 
     <tr>
    <td width="21%" id="titletd">Date:   <? echo date("M-d-Y");?></td>
     </tr>
  <tr>
    <td colspan="2" >

        <!--formulario de confirmaciòn.-->
    <div id="formConfirm">
    <table id="tableorder"  width="96%">
      <tr>
        <td height="" colspan="6"  ><div align="right" ><strong><?php echo $toursbooking['adults'];?></strong> ADULTS AND <strong><?php echo $toursbooking['childs'];?></strong> CHILDREN TOTAL OF <strong><?php echo $toursbooking['totalpax'];?></strong> PASSENGERS </div></td>
        </tr>

       <tr>
        <?php 
          if(isset($_SESSION ["tourstick"] )){
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
        </div>
      
  <tr>
    <td height="" colspan="2" id="titletd" ><strong>PRICE</strong></td>
  </tr>
    <tr><td>
       	<table style=" " width="90%" border="0" cellpadding="1" id="tableorder">
      <tbody><tr>
        <td height="" colspan="5" align="center" id="titlett"><strong>COST SUMMARY</strong></td>
      </tr>
       <tr>
        <td height=""></td>
        <td>&nbsp;</td>
        <td id="titlell"> Total per Adults </td>
        <td width="20%" id="titlelp">$ <?php echo number_format($data['por_adults'],2,'.',',');?></td>
      </tr>
	  <tr>
        <td height=""></td>
        <td>&nbsp;</td>
        <td id="titlell"> Total per Childs </td>
        <td width="20%" id="titlelp">$ <?php echo number_format($data['por_childs'],2,'.',',');?></td>
      </tr>
       <tr>
        <td height=""></td>
        <td>&nbsp;</td>
        <td id="titlell"> Total net </td>
        <td width="20%" id="titlelp">$ <?php echo number_format($toursbooking['tqp']*$toursbooking['totalpax'],2,'.',',');?></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td id="titlell">Taxes and Fees</td>
        <td id="titlelp"><div id="fee_collect">$ 0.00<div></div></div></td>
      </tr>
   
           
      <tr style="">
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td id="titlelr" style="padding-left: 5px;
font-size: 16px;
border-top-width: 1px;
border-top-style: solid;
border-top-color: #CE0000;
color: #CE0000;
}" align="center">TOTAL AMOUNT</td>
        <td id="titlelr" colspan="2" style="padding-left: 5px;
font-size: 16px;
border-top-width: 1px;
border-top-style: solid;
border-top-color: #CE0000;
color: #CE0000;
}" ><strong id="total_amount">$ <?php echo number_format($toursbooking['tqp']*$toursbooking['totalpax'],2,'.',',');?> </strong></td>
      </tr>
      <tr id="error" style="display:none;">
        <td id="titlelr" align="center" colspan="5" style="backgroup-color:blue;"><div id="msg">Error </div></td>
      </tr>
      
      
      <?php 
        if(isset($_SESSION['data_agency'])){
           Doo::loadModel("Agency");
           $dat = new Agency($_SESSION['data_agency']);
           Doo::loadModel("Agency_Account");
           $acountAgen = new Agency_Account($_SESSION['agencyAcount']);
           
           if($dat->type_rate == '0'){  
				 ?>
              <tr>
               <td>&nbsp;</td>
               <td>&nbsp;</td>
               <td id="titlelr" align="center" >Agency Comision</td>
               <td colspan="2"  id="titlelr" ><strong id=""><?php echo '$ '.number_format($toursbooking['comision_agency'], 2, '.', '');?></strong></td>
             </tr>
			 <tr>
               <td>&nbsp;</td>
               <td>&nbsp;</td>
               <td id="titlelr" align="center" >Balance</td>
               <td colspan="2"  id="titlelr" ><strong id="balance"><?php echo '$ '.number_format(($toursbooking['tqp']*$toursbooking['totalpax']) - (isset($toursbooking['comision_agency'])?$toursbooking['comision_agency']:0), 2, '.', '');?></strong></td>
             </tr>
			 <?php 
				
            }else{?>
				<tr>
               <td>&nbsp;</td>
               <td>&nbsp;</td>
               <td style="padding-left: 5px;
                font-size: 12px;
                border-top-width: 1px;
                border-top-style: solid;
                border-top-color: #CE0000;
                color: #CE0000;
                }" align="center">Other Amount</td>
                               <td style="padding-left: 5px;
                font-size: 12px;
                border-top-width: 1px;
                border-top-style: solid;
                border-top-color: #CE0000;
                color: #CE0000;
                }" colspan="2" id="titlelr" onclick="
                $('#otheramount').attr('disabled',false);
                 $('#otheramount').focus();
                " ><input  id="otheramount" name="otheramount" value="" disabled="disabled" style="width:100px; padding-left:3px;"/></td>
                             </tr><tr>
               <td>&nbsp;</td>
               <td><label for="textarea">Comentarios:</label></td>
               <td colspan="3">
               <textarea name="comentarios" id="comentarios" cols="45" rows="5"></textarea></td>
               </tr>
			<?php }
				
        }
        ?>
       
			                
    </tbody></table>
       </td>
       </tr>
           <br/> 
  <?php if(isset($_SESSION['data_agency'])&& isset($_SESSION['data_agency'])){ ?>
  <tr>
    <td height="" colspan="2" id="titletd" ><strong>PAYMENT</strong></td>
  </tr>
  <td colspan="2" >
      <table width="90%" height="125" id="tableorder" cellpadding="0">
      <tr>
        <td  colspan="3" width="34%" height="20" align="center"  >
        <input type="hidden" name="opcion_pago_saldo" id="opcion_pago_saldo" value="1" />
         <?php if($dat->type_rate == '0'){?>
        		<table width="100%" align="center">
               
                 <tr>
                    <td colspan="6"   height="20" id="titlett" align="center"  ><strong>PAYMENT OPTION 
                    </strong> 
                    </td>
                  </tr>

                	<tr>
                      <td>&nbsp;</td>
        				<td width="2%">
                        <input name="opcion_saldo" id="opcion_saldo1" value="1" type="radio" checked="checked"></td>
                        <td width="10%">Paid Full</td>
                        <td width="2%"><input name="opcion_saldo" id="opcion_saldo2" value="2" type="radio"></td>
                        <td width="10%">Paid Balance</td>
                        <td>&nbsp;</td>
                    <tr>
                   
                    <tr><td colspan="6"><hr /></td></tr>
                    
                </table>
                 <?php }?>
        	</td>
      </tr>
        <tr>
        <td  width="34%" height="35" id="titlett" align="left"  ><strong>PRED-PAID</strong> </td>
        <td  width="34%" height="35" id="titlett" align="left"  ><strong>COLLECT ON BOARD</strong> </td>
        <td  width="34%" height="35" id="titlett" align="left"  ><strong>VOUCHER</strong> </td>
      </tr>
      <tr>
      <td >
      <table>    
       <tr>
    <td colspan="2"></td>
    </tr>
  <tr>
    <td width="23"><input name="opcion_pago" id="opcion_pago" <?php echo ($acountAgen->opcion1 != 1)?"readonly=\"readonly\"  disabled=\"true\" ":""; ?> value="2" type="radio"></td>
    <td width="164" <?php echo ($acountAgen->opcion1 != 1)?"style=\"color:FF33FF\" ":""; ?>><? echo "Passager Credit Car"; ?></td>
  </tr>    
    <tr>
    <td width="23"><input name="opcion_pago" id="opcion_pago" <?php echo ($acountAgen->opcion1 != 1)?"readonly=\"readonly\"  disabled=\"true\" ":""; ?>  value="1" agencypago="true" type="radio"></td>
    <td width="164" <?php echo ($acountAgen->opcion1 != 1)?"style=\"color:FF33FF\" ":""; ?>>Agency Credit Car</td>
  </tr>            

   </table>        
</td>
      <td >
          <table>
              <tr>
    <td colspan="2"></td>
    </tr>
    <tr>
    	<td colspan="2" id="td_otheramount"></td>
    </tr>
  <tr>
    <td width="23"><input name="opcion_pago" id="opcion_pago" <?php echo ($acountAgen->opcion3 != 1)?"readonly=\"readonly\"  disabled=\"true\" ":""; ?>  value="3" type="radio"></td>
    <td width="164"  <?php echo ($acountAgen->opcion3 != 1)?"style=\"color:FF33FF\" ":""; ?>  >Credit Car+ 4 % FEE</td>
  </tr>
  <tr>
    <td><input name="opcion_pago" id="opcion_pago" <?php echo ($acountAgen->opcion4 != 1)?"readonly=\"readonly\"  disabled=\"true\" ":""; ?> value="4" type="radio"></td>
    <td <?php echo ($acountAgen->opcion4 != 1)?"style=\"color:FF33FF\" ":""; ?> >Cash</td>
    
  </tr>
  


          </table> </td>
      <td >
      <div id="typeVoucher">
      <table>
              <tr>
    <td colspan="2"></td>
    </tr>
  <tr>
    <td width="23"><input name="opcion_pago" id="opcion_pago" <?php echo (($acountAgen->opcion5 != 1)&&( trim($acountAgen->opcion5) != "2")  )?"readonly=\"readonly\"  disabled=\"true\" ":""; ?> value="5" type="radio"></td>
    <td width="164" <?php echo (($acountAgen->opcion5 != 1)||($acountAgen->opcion5 != 2))?"style=\"color:FF33FF\" ":""; ?> >Credit Voucher</td>
  </tr>


          </table> 
          </div>
          </td>
      </tr>
    </table>  
 <?php }  ?>   
        
        </td></tr>
       </table>
      </tr>
      <table width="96%" border="0">
        
        
 
       <tr id="error" style="display:none;" >
        <td  id="titlelr" align="center" colspan="5" style="backgroup-color:blue; color:rgb(153,51,0);" >
         <input class="input-text" id="tqprice1" name="angency_fee" type="hidden" value=""  ></input>
        <div id="msg">Error </div></td>
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
  
  <tr>
    <td height="56" colspan="2" align="center"> <p align="center" class="titulopago"> <button  class="btn2" id="btn-continue" <?php echo (isset($_SESSION['data_agency'])?"disabled=\"true\"":""); ?> ><img src="<?php echo $data['rootUrl']; ?>global/images/paytours.jpg" /></button>
    <button  class="btn2" id="btn-testing"  ><img src="<?php echo $data['rootUrl']; ?>global/images/savequote.jpg" /></button>
    
</p>       </td>
  </tr>
      </table>
    
      </div>

    </div>
      
	 </form>
</div>  

                                    </div>




                                </div>
                                <div id="foot">
                                    <h4>Home   |   Our Company  |   My Superclub  |   Tickets Policy   &nbsp;|&nbsp;Baggage   | © 2012 Super Tours of Orlando Inc.<br />
                                        Copyright ©  1989 - 2012 Supertours Of  Orlando, INC . All Rights Reserved.  </h4>
                                </div>



                            </div>


                            <div id="roomsdistri">
                                
                                
                                
                                
                            </div>

                           
                            <!--    <script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/booking.js"></script>
                            <script src="<?php echo $data['rootUrl']; ?>global/js/modernizr.js"></script> -->
                            <script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/form.js"></script> 
                            <script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/jquery.maskMoney.js"></script>
                            <script type="text/javascript">
     $(document).ready(function(){
  
      
     $('input[type="radio"]').change(function(){   
		 if($(this).get(0).name=='opcion_pago'){
		  <?php $pagof = $toursbooking['tqp']*$toursbooking['totalpax'];  
				$pagob = $pagof - (isset($toursbooking['comision_agency'])?$toursbooking['comision_agency']:0); 
				$toursbooking['4fee'] = ($toursbooking['totaltotal']*0.04);
				?> 					
			 if($(this).val()=='5'){
				  <?php $total_rt = $toursbooking['tqp']*$toursbooking['totalpax'];
						if($total_rt > $disponible && $acountAgen->opcion5 != 1){
							?>
							$('#btn-continue').attr("disabled","false");
							alert('Your available credit (<?php echo $disponible; ?>) is less than the total amount to be paid');
							$(this).attr("checked",false);
							 $("#opcion_saldo2").attr('checked',true);
							<?php
						}else{
							?>
							$('#btn-continue').removeAttr("disabled"); 
							 $("#opcion_saldo2").attr('checked',true);
							 $("#opcion_saldo2").attr('disabled',false);
							 $("#opcion_saldo1").attr('disabled',true);
							 document.getElementById('opcion_pago_saldo').value = '2';
							<?php
						}
					?>
					 actualizarAmount('<?php echo $pagob;?>');
			 }else{
					   if($(this).val()=='3'){
							if( $("#opcion_pago_saldo").val()=='2'){
								actualizarAmount('<?php echo $toursbooking['4fee']+$pagob;?>');
							}else{
								actualizarAmount('<?php echo $toursbooking['4fee']+$pagof;?>');
							}
					   }else{
							if($(this).val()=='1' && $(this).attr('agencypago') ){
								 actualizarAmount('<?php echo $pagob;?>');
							}else{
								 if( $("#opcion_pago_saldo").val()=='2'){
								  	actualizarAmount('<?php echo $pagob;?>');
								}else{
									 actualizarAmount('<?php echo $pagof;?>');
								}
							}         
					   }
					   $('#btn-continue').removeAttr("disabled"); 
					   $('#error').fadeOut('slow');
			 } 
			 
			 if($(this).val()=='1'){
					 $("#opcion_saldo2").attr('checked',true);
					 $("#opcion_saldo2").attr('disabled',false);
					 $("#opcion_saldo1").attr('disabled',true);
				     document.getElementById('opcion_pago_saldo').value = '2';
			 }else if($(this).val()!='5'){
				 $("#opcion_saldo2").attr('disabled',false);
				 $("#opcion_saldo1").attr('disabled',false);
			 }
			 
		 }else {
			var num = document.getElementsByName('opcion_pago').length
			 var typePago  = 0;
			 for(var i = 0; i<num; i++){
				 if(document.getElementsByName('opcion_pago').item(i).checked){
					 typePago = document.getElementsByName('opcion_pago').item(i).value;
				 }
			 }
			if(typePago == 0){
				if($(this).get(0).id=='opcion_saldo1'){
					actualizarAmount('<?php echo $pagof;?>');
				}else{
					actualizarAmount('<?php echo $pagob;?>');
				}
			}else if($(this).get(0).id=='opcion_saldo1'){
					document.getElementById('opcion_pago_saldo').value = '1';
					if(typePago =='3'){
						actualizarAmount('<?php echo $toursbooking['4fee']+$pagof;?>');
					}else if(typePago =='2' || typePago =='4'){
						actualizarAmount('<?php echo $pagof;?>');
					}
			 }else  if($(this).get(0).id=='opcion_saldo2'){
				 document.getElementById('opcion_pago_saldo').value = '2';
				 if(typePago=='3'){
						actualizarAmount('<?php echo $toursbooking['4fee']+$pagob;?>');
					}else if(typePago =='2' || typePago =='4'){
						actualizarAmount('<?php echo $pagob;?>');
					}
			 }
		 }
       });
      
     });
	 
	  function valor_other(){
	   <?php $pagof = $toursbooking['totaltotal']; ?> ;	  
	   <?php $toursbooking['4fee'] = $toursbooking['totaltotal']*0.04; ?>;
	     var num = document.getElementsByName('opcion_pago').length
	     var typePago  = 0;
		 for(var i = 0; i<num; i++){
			 if(document.getElementsByName('opcion_pago').item(i).checked){
				 typePago = document.getElementsByName('opcion_pago').item(i).value;
			 }
		 }
		 if(typePago==3){
			 actualizarAmount('<?php echo ($toursbooking['4fee']+$pagof);?>');
		 }else{
			 actualizarAmount('<?php echo ($pagof);?>');
		 }
  }

    function actualizarAmount(amount){
		
		var valor = parseFloat(amount).toFixed(2);
	   $('#total_amount').html('$ '+valor);
	     var num = document.getElementsByName('opcion_pago').length
	     var typePago  = 0;
		 for(var i = 0; i<num; i++){
			 if(document.getElementsByName('opcion_pago').item(i).checked){
				 typePago = document.getElementsByName('opcion_pago').item(i).value;
			 }
		 }
		  if(typePago==3){
			 $('#balance').html('$ <?php echo number_format($toursbooking['4fee']+$pagob,2,'.',',');?> ');
			  $('#fee_collect').html('$ <?php echo number_format($toursbooking['4fee'],2,'.',',');?> ');
		 }else{
			 $('#balance').html('$ '+formato('<?php echo ($pagob);?>',2));
			 $('#fee_collect').html('$ 0.00');
		 }
		
	}
	
	function formato(cnt, cents) {
			cnt = cnt.toString().replace(/\$|\u20AC|\,/g,'');
			if (isNaN(cnt))
				return 0;	
			var sgn = (cnt == (cnt = Math.abs(cnt)));
			cnt = Math.floor(cnt * 100 + 0.5);
			cvs = cnt % 100;
			cnt = Math.floor(cnt / 100).toString();
			if (cvs < 10)
			cvs = '0' + cvs;
			for (var i = 0; i < Math.floor((cnt.length - (1 + i)) / 3); i++)
				cnt = cnt.substring(0, cnt.length - (4 * i + 3)) + ',' 
                                + cnt.substring(cnt.length - (4 * i + 3));

			return (((sgn) ? '' : '-') + cnt) + ( cents ?  '.' + cvs : '');
	}
	
  
    function validarOtherAmount(){
		var msg='';
		try{
		   var campo = document.getElementById('otheramount').value;
		   if(campo != ''){
		   		 return msg = validateNumberPositivo(campo, 'Other Amount',true);
		   }else{
			   return msg;   
		   }
		}catch(e){
		   return msg;
		}  
	}
	
	$("#otheramount").blur(function(){
		 var campo = document.getElementById('otheramount').value;
		 if(campo == ""){
			 $('#otheramount').attr('disabled','disabled');
		 }else{
			 msg = validateNumberPositivo(campo, 'Other Amount',true);
			 if(msg != ""){
				 if(campo != '0'){
					 alert('Error type the other amount field. Try again');
					 $("#otheramount").focus();
				 }
			 }
		 }
	});
	
	function valorOtherAmount(){
		var msg='';
		try{
		   var campo = document.getElementById('otheramount').value;
		   if(campo != ''){
		   		msg = validateNumberPositivo(campo, 'Other Amount',true);
				if(msg == ''){
					return campo;
				}else{
					return 0;
				}
		   }else{
			   return 0;   
		   }
		}catch(e){
		   return 0;
		}  
	}
                         
                                
                                
                                
                                
	function validateForm(){
        var sErrMsg = "";
       sErrMsg += validateText($('#firstname').val(),$('#r1').html() , true);
        sErrMsg += validateText($('#lastname').val(),$('#r2').html() , true);
		sErrMsg += validateEmail($('#email').val(),$('#r3').html() , true);
	  
        sErrMsg += validateText($('#phone').val(),$('#r5').html() , true);
		 sErrMsg += validateText($('#cellular').val(),$('#r6').html() , true);
        if(sErrMsg != "")
        {
            alert(sErrMsg);
            return false;
		 }
		 return true;
    }
    
    
							
							$("#btn-continue").click(function(){
							 
							
							if(!$('#ter2').is(":checked") || !$('#ter1').is(":checked") )
											  {     
											    	alert(' PLEA SE READ THE TERMS AND BOOK ING COND IT IONS');
													return false;
											  }
							  
							  
							  
							if (validateForm()){
                                                                  if($('input[type="radio"]:checked').attr("agencypago")){
         <?php $toursbooking['totaltotal'] = number_format($toursbooking['totaltotal']-(isset($toursbooking['comision_agency'])?$toursbooking['comision_agency']:0), 2, '.', '');
            $toursbooking['comision_agency'] = 0;    
         ?>
       }
      if($('input[type="radio"]:checked').val()=='3'){
        <?php $toursbooking['totaltotal'] = number_format(($toursbooking['4fee']+$toursbooking['totaltotal']), 2, '.', '');?>
      }
                                                            
							   $('#form1').submit();
                            }else{
							   return false;
							}
							
							});
                                                        
                                                        
                                                        $("#btn-testing").click(function(){
							 
							
							if(!$('#ter2').is(":checked") || !$('#ter1').is(":checked") )
											  {     
											    	alert(' PLEA SE READ THE TERMS AND BOOK ING COND IT IONS');
													return false;
											  }
							  
							  
							  
							if (validateForm()){
                                                           $('#form1').attr("action","<?php echo $data['rootUrl']; ?>tours/quotation");  
							   $('#form1').submit();
                                                        }else{
							   return false;
							}
							
							});
                                                        
							
							
                 	 
                            </script>

               


                    </body>
                    </html>

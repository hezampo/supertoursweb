<head>

<title>Documento sin título</title>
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
<? $toursbooking = $_SESSION['toursbooking']; ?> 
</head><div align='center'>
<br />
<table   id='clearTable'> 
     <tr>
       <td width='316' height='33' rowspan='2' id='titletd3'><img src='https://www.supertours.com/Logo-Supertours-mail.jpg' width='316' height='88' /></td>
       <td colspan='3' align='center' id='titletd3'>Supertours.com</td>
     </tr>
     <tr>
       <td height='35' colspan='3' id='titletd4'>Date/Time of Booking:  / </td>
    </tr>
     <tr>
       <td align='center' height='33' colspan='4' id='titletd2'> E-TICKET</td>
     </tr>
     <tr>
       <td height='15' id='titletd6'>LEAD TRAVELER:  </td>
       <td width='145' height='15' id='titletd6'>&nbsp;</td>
       <td colspan='2' id='titletd6'>AD : <strong>  </strong>CHD :  <strong> TOTAL</strong> : </td>
     </tr>
     <tr>
       <td height='16' id='titletd7'></td>
       <td height='16' id='titletd7'>Status: CONFIRMED</td>
       <td width='197' height='16' id='titletd7'>Confirmation # </td>
       <td width='122' height='16' id='titletd7'>Paid by: </td>
     </tr>
     <tr>
    <td height='45' colspan='4' id='titletd'> <p><strong>ORDER&nbsp;  CONFIRMATION</strong> +  </p></td>
  </tr>
  <tr>
    <td colspan='4' ><table width="90%" height="90" id="tableorder">
      <tr>
        <td height="35" colspan="3" id="titlett"  ><div align="left" ><strong> ITINERARY</strong></div></td>
      </tr>
      <tr>
        <td height="47" colspan="3"><p >
          <? if($toursbooking['sarrival'] == 1){?>
          ITINERARY ARRIVAL<br />
          <br />
          Date Arrival <strong><? echo $toursbooking['fecha_llegada']; ?></strong> - Pick up time <strong><? echo date("g:i A",strtotime($toursbooking['datedeparturetrip1'])); ?></strong> – Trip <strong><? echo $toursbooking['trip1']; ?></strong>, Luxury <strong><? echo $toursbooking['equipment1']; ?></strong> –transportation from <strong><span id="area">unselected</span> </strong>, to Orlando Super Tours Terminal, arriving at <strong><? echo $toursbooking['datearrivingtrip1']; ?></strong> , you will be greeted by your tour guide/driver in Orlando.
          <? } ?>
          <? if($toursbooking['sarrival'] == 2){?>
          ITINERARY ARRIVAL<br />
          Date Arrival <strong><? echo $toursbooking['fecha_llegada']; ?></strong> - Pick up Time: <strong><? echo date("h:s A",strtotime($toursbooking['hora1'])); ?></strong>,  PRIVATE SERVICE – transportation VIP  from <strong><? echo $toursbooking['city']; ?></strong>, PICK UP POINT <strong><? echo $toursbooking['address']; ?></strong> to Orlando Super Tours Terminal.
          <? } ?>
          <? if($toursbooking['sarrival'] == 3){?>
          ITINERARY ARRIVAL<br />
          Date Arrival <strong><? echo $toursbooking['fecha_llegada']; ?></strong> – Arriving: By plane  at Orlando International Airport 
          Data Transfer In  :   Airline: <strong><? echo $toursbooking['airlinearrival']; ?></strong> Flight #: <strong><? echo $toursbooking['flightarrival']; ?></strong> Arrival Time:<strong><? echo date("h:s A",strtotime($toursbooking['hora1'])); ?></strong>
          <? } ?>
          <? if($toursbooking['sarrival'] == 4){?>
          ITINERARY ARRIVAL<br />
          Date Arrival <strong><? echo $toursbooking['fecha_llegada']; ?></strong>7 – Arriving: By Car     - Estimated arrival time to Orlando: <strong><? echo date("h:s A",strtotime($toursbooking['hora1'])); ?></strong>
          <? } ?>
          </p>
            <p>
              <? if($toursbooking['sdeparture'] == 1){?>
              ITINERARY DEPARTURE<br />
              <br />
              Date departure <strong><? echo $toursbooking['fecha_salida']; ?></strong> - <strong><? echo $toursbooking['datedeparturetrip2']; ?></strong> -  Trip <strong><? echo $toursbooking['trip2']; ?></strong>, Luxury <strong><? echo $toursbooking['equipment2']; ?></strong> –transportation from Orlando Super Tours Terminal to MIAMI BEACH SOUTH arriving at <strong><? echo $toursbooking['datearrivingtrip2']; ?></strong>, you will be greeted by your tour guide/driver in Orlando. <br />
              <? } ?>
              <? if($toursbooking['sdeparture'] == 2){?>
              ITINERARY DEPARTURE<br />
              Date departure <strong><? echo $toursbooking['fecha_salida']; ?></strong> - Drop Off Time: <strong><? echo date("h:s A",strtotime($toursbooking['hora2'])); ?></strong>, PRIVATE SERVICE – transportation VIP from Orlando, to MIAMI BEACH SOUTH <br />
              <? } ?>
              <? if($toursbooking['sdeparture'] == 3){?>
              ITINERARY DEPARTURE<br />
              Date departure <strong><? echo $toursbooking['fecha_salida']; ?></strong> – Departure: By Plane at Orlando International Airport 
              Data Transfer Out:   Airline: <strong><? echo $toursbooking['airlinedeparture']; ?></strong> Flight #: <strong><? echo $toursbooking['flightdeparture']; ?></strong> Arrival Time: <strong>><? echo date("h:s A",strtotime($toursbooking['hora2'])); ?></strong> <br />
              <? } ?>
              <? if($toursbooking['sdeparture'] == 4){?>
              ITINERARY DEPARTURE<br />
              Date departure <strong><? echo $toursbooking['fecha_salida']; ?></strong> – Departure: By Car <br />
              <? } ?>
              <br />
              <br />
          </p></td>
      </tr>
    </table>    
      <table width="90%" height="90" id="tableorder2">
        <tr>
          <td height="35" colspan="3" id="titlett2"  ><div align="left" ><strong>ACCOMMODATIONS</strong></div></td>
        </tr>
        <tr>
          <td height="47" colspan="3"><p>Hotel accommodation at the <strong><? echo $toursbooking['hotel'];?></strong> in <strong><? echo $toursbooking['rooms'];?></strong> room / s. for <strong><? echo $toursbooking['noches'];?></strong> night/s from <strong><? echo $toursbooking['fecha_llegada'];?></strong> Check In Time is 4:00pm  . To <strong><? echo $toursbooking['fecha_salida'];?></strong> Check Out Time is 11:00am. <strong><? echo ($toursbooking['desayuno'] == 1?'(FREE DAILY CONTINENTAL BREKFAST).':'')?></strong> Taxes are Included. </p>
              <p><strong><? echo ($toursbooking['dbufe'] == 1?'(FREE DAILY CONTINENTAL BREKFAST).':'')?></strong> <br />
                  <br />
            </p></td>
        </tr>
      </table>
      <table width="90%" height="90" id="tableorder3">
        <tr>
          <td height="35" colspan="3" id="titlett3"  ><div align="left" ><strong>ATTRACTION</strong></div></td>
        </tr>
        <tr>
          <td height="47" colspan="3">Round trip daily transportation from your Hotel to <? echo "<ol>";
		
			echo "</ol>";
		 ?> <br />
              <? echo ($toursbooking['ticketpark'] == 1 ?'Admissions to Selected  Attractions.':''); ?> <br />
              <br /></td>
        </tr>
      </table>
      </td>
  </tr>
  <tr>
    <td height='33' colspan='4' id='titletd' ><strong>PRICE</strong></td>
  </tr>
  <tr>
    <td colspan='4'><table width="90%" border="0">
      <tr>
        <td height="32" align="center"><strong>TOTAL AMOUNT for THIS TOUR:</strong> <span id="tqprice" >$</span> </td>
      </tr>
      <tr>
        <td height="40" align="center" ><span class="Estilo1">CHECK YOUR TOUR BEFORE PROCEEDING WITH  PAY TOUR</span></td>
      </tr>
      <tr>
        <td align="center">Once you select the PAY TOUR button, you can no longer make changes to your TOUR  online. You must call (407) 370-3001 and speak with our  Call Center.<br /></td>
      </tr>
    </table>
    <p>&nbsp;</p>
    <p>Non-refundable - non-transferable - no changes are allowed on dates or time of departure - no pets allowed on board -<br />
      luggage restrictions apply - Please read the terms of transportation at www.supertours.com<br />
      THANK YOU FOR CHOOSING US<br />
      HAVE A NICE TRIP<br />
      SUPER TOURS OF ORLANDO,Inc. 5419 International Drive, Orlando Fl. 32819<br />
      Phone: (407) 370-3001 / U.S.A. TOLL FREE 1-800-251-4206 / reservations@supertours.com
    
    </p></td>
  </tr>
  <tr>
    <td height="18" colspan='4' align='center'> <p align='center' class='titulopago'> 
    
</p>       </td>

  </tr>
  </table>



</div>
<html>
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
</head><div align='center'>
<br />
<table   id='clearTable'> 
     <tr>
       <td width='316' height='33' rowspan='2' id='titletd3'><img src='https://www.supertours.com/Logo-Supertours-mail.jpg' width='316' height='88' /></td>
       <td colspan='3' align='center' id='titletd3'>Supertours.com</td>
     </tr>
     <tr>
       <td height='35' colspan='3' id='titletd4'>Fecha:".date("M-d-Y")." / Hora:".date("g:i A")." </td>
    </tr>
     <tr>
       <td align='center' height='33' colspan='4' id='titletd2'> E-TICKET</td>
     </tr>
     <tr>
       <td height='15' id='titletd6'>LEAD TRAVELER:
       <br/><br/>
       <strong>User Name: </strong>".$login['email']."
       <br/><br/>
       <strong>Firstname: </strong>".$login['firstname']."
       <br/><br/>
       <strong>Lastname: </strong>".$login['lastname']."
       <br/><br/>
       <strong>Phone: </strong>".$login['phone']."
        <br/><br/>
       <strong>Cellphone: </strong>".$login['cellphone']."    
           
       </td>
       <td width='145' height='15' id='titletd6'>&nbsp;</td>
       <td colspan='2' id='titletd6'><strong>AD :</strong>".$_SESSION['toursbooking']['adults']." <strong>CHD :</strong>".$_SESSION['toursbooking']['childs']."  <strong> TOTAL :</strong>".$_SESSION['toursbooking']['totalpax']."<br/><br/><strong>Status :</strong> QUOTATION<br/><br/><strong> Code Quotation :</Strong> ".$_SESSION['codconf']."</td>
     </tr>
      <tr>
    <td height='45' colspan='4' id='titletd'> <p><strong>ORDER&nbsp;  QUOTATION</strong></p></td>
  </tr>
  <tr>
     <table width=\"96%\" height=\"90\" id=\"tableorder\">
      <tr>
        <td height=\"35\" colspan=\"3\" id=\"titlett\"  ><strong ><div align=\"left\" > ITINERARY ARRIVAL</div></strong></td>
        </tr>
      <tr>
        <td height=\"47\" colspan=\"3\"><br/><p>"
        <strong>".$toursbooking['fecha_llegada']."</strong> &#45; Pick up time <strong>".date("g:i A",strtotime($toursbooking['datedeparturetrip1']))."</strong> &#45; Trip <strong>".$toursbooking['trip1']."</strong>, Luxury <strong>".$toursbooking['equipment1']."</strong> &#45; transportation from <strong>".$area."</strong>, to Super Tours of orlando Terminal, arriving at <strong>".date("H:i A",strtotime($toursbooking['datearrivingtrip1']))."</strong> , you will be greeted by your tour guide/driver in Orlando. 

<br>
<strong > <div align=\"left\" > LOCAL TRANSFERS TO PARKS</div></strong>
Round trip daily transportation from your Hotel to
<ul>".$npark."</ul>".(($question == 1)?"<strong>Admissions to selected Atractions.</strong>":"")."<hr>":"").(($toursbooking['sarrival'] == 2)?"Date Arrival <strong>".$toursbooking['fecha_llegada']."</strong> &#45;you have choosen <strong>".date("h:s A",strtotime($toursbooking['hora1']))."</strong>, on a luxury private transportation from <strong>".$toursbooking['city']."</strong>, <strong>".$toursbooking['address']."</strong> ,<strong>".$area."</strong> to <strong>".$toursbooking['hotel']."</strong><hr><strong > <div align=\"left\" > ACCOMMODATION</div></strong><br>Hotel accommodation at the <strong>".$toursbooking['hotel']."</strong> in <strong>".$toursbooking['rooms']."</strong> room(s). for <strong>".$toursbooking['noches']."</strong> night(s) from <strong>".$toursbooking['fecha_llegada']."</strong> Check In Time is 4:00pm . To<strong>".$toursbooking['fecha_salida']."</strong> Check Out Time is 11:00am.".(($desayuno!=0)?" FREE DAILY CONTINENTAL BREKFAST. ":"")."Taxes are Included.<br>".(($buffet == 1 && $_SESSION['categoria'] != 2 )?"<br><br>Daily SUPER BREKFAST BUFFET at your hotel.":"")."<br><hr><br><strong > <div align=\"left\" > LOCAL TRANSFERS TO PARKS</div></strong>
<strong>".$toursbooking['fecha_salida']."</strong> Check Out Time is 11:00am.".(($desayuno!=0)?" FREE DAILY CONTINENTAL BREKFAST. ":"")."Taxes are Included.<br>".(($buffet == 1 && $_SESSION['categoria'] != 2 )?"<br><br>Daily SUPER BREKFAST BUFFET at your hotel.":"")."<br><hr><br><strong > <div align=\"left\" > LOCAL TRANSFERS TO PARKS</div></strong>
Round trip daily transportation from your Hotel to
<ul>".$npark."</ul>".(($question == 1)?"<strong>Admissions to selected Atractions.</strong>":"")."<hr>
    ":"").(($toursbooking['sarrival'] == 3)?"<br />Date Arrival <strong>".$toursbooking['fecha_llegada']."</strong> YOU HAVE CHOOSEN ARRIVAL TO ORLANDO INTERNATIONAL AIRPORT AT  BAGGAGE CLAIM   .  YOU WILL BE GREETED BY YOUR TOUR GUIDE/DRIVER IN ORLANDO TO TAKE YOU TO  <strong>".$toursbooking['hotel']."</strong>
<hr><strong > <div align=\"left\" > ACCOMMODATION</div></strong><br>
Hotel accommodation at the <strong>".$toursbooking['hotel']."</strong> in <strong>".$toursbooking['rooms']."</strong> room(s). for <strong>".$toursbooking['noches']."</strong> night(s) from <strong>".$toursbooking['fecha_llegada']."</strong> Check In Time is 4:00pm . To
<strong>".$toursbooking['fecha_salida']."</strong> Check Out Time is 11:00am.".(( $desayuno!=0)?" FREE DAILY CONTINENTAL BREKFAST. ":"")." Taxes are Included.
   <br>".(($buffet == 1 && $_SESSION['categoria'] != 2)?"<br><br>Daily SUPER BREKFAST BUFFET at your hotel.":"")."<br>
<hr><br>
<strong > <div align=\"left\" > LOCAL TRANSFERS TO PARKS</div></strong>
Round trip daily transportation from your Hotel to<ul>".$npark."</ul>".(($question == 1)?"<strong>Admissions to selected Atractions.</strong>":"")."<hr>":"")                
.(($toursbooking['sarrival'] == 4)?"<br />
Date Arrival <strong>".$toursbooking['fecha_llegada']."</strong> PLEASE, LET US KNOW ABOUT YOUR ARRIVAL TO ORLANDO BY  DIALING  OUR TOLL FREE 1800-251-4206, TO PLACE YOUR TICKETS AT  <strong>".$toursbooking['hotel']."</strong> OR FIGURE OUT ABOUT OTHER SERVICES. WE WILL PLEASED TO ASSIST YOU. 
<hr>
<strong > <div align=\"left\" > ACCOMMODATION</div></strong><br>

Hotel accommodation at the <strong>".$toursbooking['hotel']."</strong> in <strong>".$toursbooking['rooms']."</strong> room(s). for <strong>".$toursbooking['noches']."</strong> night(s) from <strong>".$toursbooking['fecha_llegada']."</strong> Check In Time is 4:00pm . To
<strong>".$toursbooking['fecha_salida']."</strong> Check Out Time is 11:00am.".(( $desayuno!=0)?" FREE DAILY CONTINENTAL BREKFAST. ":"")." Taxes are Included.
 <br>".(($buffet == 1 && $_SESSION['categoria'] != 2)?"<br><br>Daily SUPER BREKFAST BUFFET at your hotel.":"")."<br>
<br>
<strong > <div align=\"left\" > LOCAL TRANSFERS TO PARKS</div></strong>
<ul>".$npark."</ul>".(($question == 1)?"<strong>Admissions to selected Atractions.</strong>":"")."<hr>":"")."
        </p>
        <p>".(($toursbooking['sdeparture'] == 1)?"<strong > <div align=\"left\" > ITINERARY DEPARTURE</div></strong><br>
          Date departure <strong>".date("m/d/Y",strtotime($toursbooking['fecha_salida']))."</strong> &#45; <strong>".date("H:i A",strtotime($toursbooking ['datedeparturetrip2']))."</strong> &#45;  Trip <strong>".$toursbooking['trip2']."</strong>, Luxury <strong>".$toursbooking['equipment2']."</strong> &#45; transportation from Orlando Super Tours Terminal to MIAMI BEACH SOUTH arriving at <strong>".date("H:i A",strtotime($toursbooking ['datearrivingtrip2']))."</strong>, Thank you for choosing us !. <br />
           ":"").(($toursbooking['sdeparture'] == 2)?"<strong > <div align=\"left\" > ITINERARY DEPARTURE</div></strong>
         <br>Date departure <strong>".$toursbooking['fecha_salida']."</strong> &#45; Drop Off Time:  <strong>".date("h:s A",strtotime($toursbooking['hora2']))."</strong>, PRIVATE SERVICE  &#45; transportation VIP from Orlando, to MIAMI BEACH SOUTH 
        <br />
          ":"").(($toursbooking['sdeparture'] == 3)?"<strong > <div align=\"left\" > ITINERARY DEPARTURE</div></strong>
         <br>
Date departure <strong>"<?php echo $toursbooking['fecha_salida']?>"</strong>  &#45; Departure: By Plane at Orlando International Airport 
Data Transfer Out:   Airline: <strong>".$toursbooking['airlinedeparture']."</strong>   Flight #:   <strong>".$toursbooking['flightdeparture']."</strong> Arrival Time: <strong>".date("h:s A",strtotime($toursbooking['hora2']))."</strong>



        <br />
          ":"").(($toursbooking['sdeparture'] == 4)?"<strong > <div align=\"left\" > ITINERARY DEPARTURE</div></strong>
         <br>
     Date departure <strong>".$toursbooking['fecha_salida']."</strong> <br> Departure: By Car   


        <br />
          ":"")."
          
            <br />
              <br />
            </p></td>
        </tr>
    </table>

      </td>
  </tr>
  <tr>
    <td height='33' colspan='4' id='titletd' ><strong>PRICE</strong></td>
  </tr>
  <tr>
    <td colspan='4'><table width='90%' border='0'>
      <tr>
        <td height='32' align='center'><strong>TOTAL AMOUNT for THIS TOUR:</strong> <span id=tqprice' >$" . $toursbooking ['tqp'] * $toursbooking ['totalpax'] . "</span> </td>
      </tr>
      <tr>
        <td height='40' align='center' ><span class='Estilo1'>CHECK YOUR TOUR BEFORE PROCEEDING WITH  PAY TOUR</span></td>
      </tr>
      <tr>
        <td align='center'>Once you select the PAY TOUR button, you can no longer make changes to your TOUR  online. You must call (407) 370-3001 and speak with our  Call Center.<br /></td>
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
    <td height='18' colspan='4' align='center'> <p align='center' class='titulopago'> 
    
</p>       </td>

  </tr>
  </table></div>
  </body>
  </html>
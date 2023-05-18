<html>
    <body>
    <table> 
     <tbody><tr>
       <td width="316" height="33" rowspan="2"><img width="316" height="88" src="<?php $this->data["rootUrl"]?>Logo-Supertours-mail.jpg"></td>
       <td colspan="3" align="center">Supertours.com</td>
     </tr>
     <tr>
       <td height="35" colspan="3">Date:<?php $this->data["date"]?> / Hour: <?php $this->data["hour"]?> </td>
    </tr>
     <tr>
       <td align="center" height="33" colspan="4"> <h3>MULTI DAY TOURS CONFIRMATION</h3></td>
     </tr>
     <tr>
       <td height="15"><div><div class="im">LEAD TRAVELER:
       <br><br>
       <strong>User Name: </strong><a href="mailto:<?php $this->data["cliente"]->username?>" target="_blank"><?php $this->data["cliente"]->username?></a>
       <br><br>
       <strong>Firstname: </strong><?php $this->data["cliente"]->firstname?>
       <br><br>
       </div><strong>Lastname: </strong><?php $this->data["cliente"]->lastname?>
       <br><br>
       <strong>Phone: </strong><a href="tel:<?php $this->data["cliente"]->phone?>" value="+1<?php $this->data["cliente"]->phone?>" target="_blank"><?php $this->data["cliente"]->phone?></a>
        <br><br>
       </div><strong>Cellphone: </strong><?php $this->data["cliente"]->celphone?>    
           
       </td>
       <td width="145" height="15">&nbsp;</td>
       <td colspan="2"><strong>AD: </strong><?php $this->data["adult"]?> <strong>CHD:<?php $this->data["child"]?></strong>  <strong> TOTAL:</strong><?php $this->data["child"] + $this->data["adult"]?><br><br><strong>Status :</strong><?php $this->data["tour"]->estado?><br><br><strong> Code Quotation :</strong><?php $this->data["tour"]->code_conf?></td>
     </tr>
      <tr>
    <td height="45" colspan="4"> <p><strong>ORDER&nbsp;  QUOTATION</strong></p></td>
  </tr>
  <tr><td colspan="3">
     <table width="96%" height="90">
      <tbody><tr>
        <td height="35" colspan="3"><strong><div align="left"> ITINERARY ARRIVAL</div></strong></td>
        </tr>
        <tr>
          <td height="47" colspan="3"><br><p> Date Arrival <strong>';
        
          $time = strtotime($this->data["tour"]->starting_date);
          $newformat = date("M d \of Y",$time);
          
          $mail+=$newformat?></strong>';
          
          if($this->data["tour"]->id_transfer_in == -1){ 
          $mail+='- Pick up time <strong>';
          
          $time = strtotime($this->data["reserve"]->deptime1);
          $newformat = date("h:i A",$time);
          
          $mail+=$newformat;

          $mail+='</strong> - Trip <strong><?php $this->data["reserve"]->trip_no?></strong>, Luxury <strong><?php $this->data["trip"]->equipment?></strong> - transportation from <strong>';
          $mail+=$this->data["pickup1"]->place?>
          </strong>, to <strong> <?php $this->data["dropoff1"]->place?> of Orlando</strong>, arriving at <strong>';
          $time = strtotime($this->data["reserve"]->arrtime1);
          $newformat = date("h:i A",$time);
          $mail+=$newformat?>
          </strong> , you will be greeted by your tour guide/driver in Orlando. 
          </p><hr>
          <br>';
          } else{ 
            if($this->data["transfer_in"]->type == 3) {
                $mail+='- Arriving: <strong>By plane</strong>  at Orlando International Airport'; 
                $mail+='Data Transfer In  :   Airline: <strong><?php $this->data["transfer_in"]->airlie?></strong>   Flight #:   <strong><?php $this->data["transfer_in"]->flight ?></strong> Arrival Time: <strong>';                
                $time = strtotime($this->data["transfer_in"]->arrival_time);
                $newformat = date("h:i A",$time);
                $mail+=$newformat?>
                </strong>?>;
                if($this->data["tour"]->id_hotel_reserve !=-1){
                $mail+='You will be greeted by your tour guide/driver in orlando to take you to  <strong><?php echo $this->data["hotel"]->nombre;?></strong>';
                }
                }else if($this->data["transfer_in"]->type == 2){
                $mail+= '- you have choosen <strong>';
                $time = strtotime($this->data["transfer_in"]->arrival_time);
                $newformat = date("h:i A",$time);
                $mail+=$newformat?></strong>, on a luxury private transportation from <strong><?php $this->data["transfer_in"]->city?></strong>, <strong><?php $this->data["transfer_in"]->address?></strong>?>;
                if($this->data["tour"]->id_hotel_reserve !=-1){
                $mail+='And you will be take to <strong><?php $this->data["hotel"]->nombre?></strong>?>;
                }
                } else if($this->data["transfer_in"]->type == 4){
                $mail+='Date Arrival <strong><?php $this->data["tour"]->starting_date?></strong> PLEASE, LET US KNOW ABOUT YOUR ARRIVAL TO ORLANDO BY  DIALING  OUR TOLL FREE 1800-251-4206, 
                TO FIGURE OUT HOW YOU WILL GET YOUR TICKETS?>;
            if($this->data["tour"]->id_hotel_reserve != -1) {
                $mail+='OR WE CAN LEAVE YOUR TICKETS ON  <strong><?php $this->data["hotel"]->nombre?></strong> AND TALK ABOUT OTHER SERVICES?>;
                }
                $mail+='WE WILL PLEASED TO ASSIST YOU?>;
                }
                }
                //<!-- Acomodacion -->
                if($this->data["tour"]->id_hotel_reserve != -1){
                $mail+='<strong> <div align="left"> ACCOMMODATION</div></strong>
                <br>
                Hotel accommodation at the <strong><?php $this->data["hotel"]->nombre?></strong> in <strong>.<?php $this->data["n_rooms"]?></strong> room(s). for <strong>.<?php $this->data["reserve_hotel"]->days?></strong> day(s)';
                if($this->data["reserve_hotel"]->nights >= 1){
                    $mail+='and <strong><?php $this->data["reserve_hotel"]->nights ?></strong> night(s)';
                    };
                    $mail+='from <strong>';
                }
                $time = strtotime($this->data["reserve_hotel"]->starting_date);
                $newtime = date("M d Y",$time);
                $mail+=$newtime;
                $mail+='</strong> Check In Time is 4:00pm . To
                <strong>';
                $time = strtotime($this->data["reserve_hotel"]->ending_date);
                $newtime = date("M d Y",$time);
                $mail+= $newtime;
                $mail+='</strong> Check Out Time is 11:00am?>;
                if($this->data["hotel"]->breakfast == 1) {
                    $mail+='FREE DAILY CONTINENTAL BREKFAST';
                    }  
                 $mail+='Taxes are Included.
                <br><br>
                <hr><br>';
                //<!-- fin acomodacion -->
                if(count($this->data["attractions_traffic"])>0){
                $mail+='<strong> <div align="left"> LOCAL TRANSFERS TO PARKS</div></strong>';
                $mail+='Parks tagged with <strong>Transportations</strong> means you will have tranportation included from the hotel to the park.
                        Parks tagged with <strong> Tickets </strong> means you already payed for the entrances tickets to the park.
                        <br>
                        <ul style="list-style-type: square">';
                foreach($this->data["attractions_traffic"] as $park){
                $mail+='<li>';
                $id = $park->id_park;
                $mail+= $this->data["parks"][$id]->nombre." ";
                if($park->admission == 1){ 
                $mail+= "<strong>Ticket(s)</strong>";
                }
                if($park->trafic == 1 && $park->admission == 1){ 
                $mail+= " and ";
                }
                if($park->trafic == 1){ 
                $mail+= " <strong>Tranportations</strong>";
                }
                $mail+= "</li>";
                }
                $mail+='</ul>
                <div class="im">
                </div>
                <p></p>
                <p><strong> </strong></p><div align="left">';
                }  
            $mail+='<strong> ITINERARY DEPARTURE</strong></div><br></div>
                Date departure <strong><?php $this->data["tour"]->ending_date?> ';
          if($this->data["tour"]->id_transfer_out == -1) {
          $mail+='- Pick up time <strong>';
          $time = strtotime($this->data["reserve"]->deptime2);
          $newformat = date("h:i A",$time);
          $mail+=$newformat;
          $mail+='</strong> -  Trip <strong><?php $this->data["trip2"]->trip_no?></strong>, Luxury <strong><?php $this->data["trip2"]->equipment?></strong> - transportation from <strong>Orlando<?php $this->data["pickup2"]->place?></strong> to <strong><?php $this->data["dropoff2"]->place?></strong> arriving at <strong>';
          
          $time = strtotime($this->data["reserve"]->arrtime2);
          $newformat = date("h:i A",$time);
          $mail+=$newformat;
          } else {
              if($this->data["transfer_out"]->type == 4) {
              $mail+='Departure: By Car.</p>';
              }else if($this->data["transfer_out"]->type == 3) {
              $mail+='- Departure: By Plane at Orlando International Airport Transfer Out: Airline: <strong><?php $this->data["transfer_out"]->airlie?></strong> Flight #: <strong><?php $this->data["transfer_out"]->flight?></strong> Departure Time: <strong><?php $this->data["transfer_out"]->arrival_time?></strong> ';
              }else if($this->data["transfer_out"]->type == 2) {
              $mail+='</strong> - Time: <strong>';
               
              $time = strtotime($this->data["transfer_out"]->arrival_time);
              $newformat = date("h:i A",$time);
              $mail+=$newformat;
              $mail+='</strong>, on a luxury private transportation to <strong><?php $this->data["transfer_out"]->city?></strong>, <strong><?php $this->data["transfer_out"]->address?></strong>, in MIAMI?>;          
               }
               }
                $mail+='</strong>Thank you for choosing us !. <br>
           <br>
              <br>
            <p></p></td>
        </tr>
    </tbody></table>

      </td>
  </tr>
  <tr>
    <td height="33" colspan="4"><strong>PRICE</strong></td>
  </tr>
  <tr>
    <td colspan="4"><table width="90%" border="0">
      <tbody><tr>
        <td height="32" align="center"><strong>TOTAL AMOUNT for THIS TOUR:</strong> <span>$<?php $this->data["tour"]->totalouta?></span> </td>
      </tr>
      <tr>
        <td height="40" align="center"><span>CHECK YOUR TOUR BEFORE PROCEEDING WITH  PAY TOUR</span></td>
      </tr>
      <tr>
        <td align="center">Once you select the PAY TOUR button, you can no longer make changes to your TOUR  online. You must call <a href="tel:%28407%29%20370-3001" value="+14073703001" target="_blank">(407) 370-3001</a> and speak with our  Call Center.<br>
</td>
      </tr>
    </tbody></table><div class="im">
    <p>&nbsp;</p>
    <p>Non-refundable - non-transferable - no changes are allowed on dates or time of departure - no pets allowed on board -</p><div><br>
      luggage restrictions apply - Please read the terms of transportation at <a href="http://www.supertours.com" target="_blank">www.supertours.com</a><br>
      THANK YOU FOR CHOOSING US<br>
      HAVE A NICE TRIP<br>
      SUPER TOURS OF ORLANDO,Inc. 5419 International Drive, Orlando Fl. 32819<br>
      Phone: <a href="tel:%28407%29%20370-3001" value="+14073703001" target="_blank">(407) 370-3001</a> / U.S.A. TOLL FREE <a href="tel:1-800-251-4206" value="+18002514206" target="_blank">1-800-251-4206</a> / <a href="mailto:reservations@supertours.com" target="_blank">reservations@supertours.com</a>
    
    </div><p></p></div></td>
  </tr>
  <tr>
    <td height="18" colspan="4" align="center"> <p align="center"> 
    
</p>       </td>

  </tr>
  </tbody></table>
</body>
</html>;

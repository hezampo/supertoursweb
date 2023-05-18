
<?php
$toursbooking = $_SESSION["toursbooking"];

$question = $toursbooking['ticketpark'];
$buffet = isset($_SESSION['bufet']) ? $_SESSION['bufet'] : 0;
if (isset($_SESSION['area']))
    $area = $_SESSION['area'];
else
    $area = -1;
if (isset($_SESSION['area2']))
    $area2 = $_SESSION['area2'];
else
    $area2 = -1;

if (isset($_SESSION['pickup']))
    $pickup = $_SESSION['pickup'];
else
    $pickup = -1;

if (isset($_SESSION['pickup2']))
    $pickup2 = $_SESSION['pickup2'];
else
    $pickup2 = -1;


//print_r($_SESSION['categoria']);
$namepark = $_SESSION['namepark'];
?>

<div id="Bus">
    <table width="96%" height="90" id="tableorder">
        <tr>
            <td height="35" colspan="3" id="titlett"  ><strong ><div align="left" > Your Tour include</div></strong></td>
        </tr>
        <tr>
            <td height="47" colspan="3"><p ><?php if($toursbooking['sarrival'] == 1){?>

                    Date Arrival <strong><?php echo date('M-d-Y', strtotime($toursbooking['fecha_llegada'])) ; ?></strong> &#45; Pick up time <strong><?php echo date("g:i A",strtotime($toursbooking['datedeparturetrip1'])); ?></strong> &#45; Trip <strong><?php echo $toursbooking['trip1']; ?></strong>, Luxury <strong><?php echo $toursbooking['equipment1']; ?></strong> &#45; transportation from <strong> <?php echo $area . '-' . $pickup; ?></strong>, to Super Tours of orlando Terminal, arriving at <strong><?php echo date("H:i A",strtotime($toursbooking['datearrivingtrip1'])); ?></strong> , you will be greeted by your tour guide/driver in Orlando. 
                <hr>
                <!--
                <strong><? echo  date('M-d-Y', strtotime($toursbooking['fecha_llegada'])); ?></strong> &#45;&#45; <strong><? echo date("g:i A",strtotime($toursbooking['datedeparturetrip1'])); ?></strong> &#45; LUXURY  BUS  TRANSPORTATION FROM <strong><?php echo $pickup ?></strong>, <strong> <?php echo $area ?></strong>&#45;&#45;  TO SUPER TOURS OF ORLANDO TERMINAL (5419 INT'L DRIVE, ORL FL 32819) <strong><? echo $toursbooking['datearrivingtrip1']; ?></strong>.&#45;&#45; YOU WILL BE GREETED  BY YOUR TOUR GUIDE/DRIVER IN ORLANDO.
                -->
                <br>


                <br>
                <strong > <div align="left" > LOCAL TRANSFERS TO PARKS</div></strong>

                Round trip transportation from Super Tours Bus Terminal to
<?php
echo "<ul>";
foreach ($namepark as $value) {
    echo "<li>" . $value . "</li>";
}
echo "</ul>";
?> 


                <?php
                echo ($question == 1) ? "<strong>Includes tickets to parks.</strong>" : "<strong>Not includes tickets to parks.</strong>";
                ?>

                <hr>
                <?php } ?> 
                <?php if ($toursbooking['sarrival'] == 2) { ?>


                    Date Arrival <strong><?php echo date("M-d-Y", strtotime($toursbooking['fecha_llegada'])); ?></strong> &#45;you have choosen <strong><?php echo date("h:s A", strtotime($toursbooking['hora1'])); ?></strong>, on a luxury private transportation from <strong><?php echo $toursbooking['city']; ?></strong>, <strong><?php echo $toursbooking['address']; ?></strong> ,<strong> <?php echo $area ?></strong> to <strong><?php echo $toursbooking['hotel']; ?></strong>. 



                    <hr><br>

                    <strong > <div align="left" > LOCAL TRANSFERS TO PARKS</div></strong>

                    Round trip transportation from Super Tours Bus Terminal to
    <?php
    echo "<ul>";
    foreach ($namepark as $value) {
        echo "<li>" . $value . "</li>";
    }
    echo "</ul>";
    ?> 


                    <?php
                    echo ($question == 1) ? "<strong>Includes tickets to parks.</strong>" : "<strong>Not includes tickets to parks.</strong>";
                    ?>
                    <hr>
<?php } ?> 
                <?php if ($toursbooking['sarrival'] == 3) { ?>
                    <br />

    <!--Date Arrival <strong><? echo $toursbooking['fecha_llegada']; ?></strong> &#45 Arriving: By plane  at Orlando International Airport 
    Data Transfer In  :   Airline: <strong><? echo $toursbooking['airlinearrival']; ?></strong>   Flight #:   <strong><? echo $toursbooking['flightarrival']; ?></strong> Arrival Time:<strong><? echo date("h:s A",strtotime($toursbooking['hora1'])); ?></strong>-->

                    Date Arrival <strong><?php echo date('M-d-Y', strtotime($toursbooking['fecha_llegada'])); ?></strong> YOU HAVE CHOOSEN ARRIVAL TO ORLANDO INTERNATIONAL AIRPORT AT  BAGGAGE CLAIM   .  YOU WILL BE GREETED BY YOUR TOUR GUIDE/DRIVER IN ORLANDO TO TAKE YOU TO  <strong><?php echo $toursbooking['hotel']; ?></strong>
                    <hr>
                    <strong > <div align="left" > ACCOMMODATION</div></strong>
                    <br>
                    Hotel accommodation at the <strong><?php echo $toursbooking['hotel']; ?></strong> in <strong><?php echo $toursbooking['rooms']; ?></strong> room(s). for <strong><?php echo $toursbooking['noches']; ?></strong> night(s) from <strong><?php echo date("M-d-Y", strtotime($toursbooking['fecha_llegada'])); ?></strong> Check In Time is 4:00pm . To
                    <strong><?php echo $toursbooking['fecha_salida'] = date("d/m/y"); ?></strong> Check Out Time is 11:00am.<?php if ($desayuno != 0) {
                    echo " FREE DAILY CONTINENTAL BREKFAST ";
                } ?>. Taxes are Included.
                    <br>
    <?php if ($buffet == 1 && $_SESSION['categoria'] != 2) { ?>
        <?php echo "<br><br>Daily SUPER BREKFAST BUFFET at your hotel."; ?><br>
    <?php } ?>


                    <hr><br>
                    <strong > <div align="left" > LOCAL TRANSFERS TO PARKS</div></strong>

                    Round trip daily transportation from your Hotel to
    <?php
    echo "<ul>";
    foreach ($namepark as $value) {
        echo "<li>" . $value . "</li>";
    }
    echo "</ul>";
    ?> 



                    <?php
                    echo ($question == 1) ? "<strong>Includes tickets to parks.</strong>" : "<strong>Not includes tickets to parks.</strong>";
                    ?>
                    <hr>
                <?php } ?> 
                <?php if ($toursbooking['sarrival'] == 4) { ?>
                    <br />

                    <!--informacion anterior
                    Date Arrival <strong><? echo $toursbooking['fecha_llegada']; ?></strong>7 � Arriving: By Car     - Estimated arrival time to Orlando: <strong><? echo date("h:s A",strtotime($toursbooking['hora1'])); ?></strong> -->

                    Date Arrival <strong><?php echo date("M-d-Y", strtotime($toursbooking['fecha_llegada'])); ?></strong> PLEASE, LET US KNOW ABOUT YOUR ARRIVAL TO ORLANDO BY  DIALING  OUR TOLL FREE 1800-251-4206, TO PLACE YOUR TICKETS AT  <strong><?php echo $toursbooking['hotel']; ?></strong> OR FIGURE OUT ABOUT OTHER SERVICES. WE WILL PLEASED TO ASSIST YOU. 
                    <hr>
                    <strong > <div align="left" > ACCOMMODATION</div></strong><br>

                    Hotel accommodation at the <strong><?php echo $toursbooking['hotel']; ?></strong> in <strong><?php echo $toursbooking['rooms']; ?></strong> room(s). for <strong><?php echo $toursbooking['noches']; ?></strong> night(s) from <strong><?php echo date("M-d-Y", strtotime($toursbooking['fecha_llegada'])); ?></strong> Check In Time is 4:00pm . To
                    <strong><?php echo date("M-d-Y", strtotime($toursbooking['fecha_salida'])); ?></strong> Check Out Time is 11:00am.<?php if ($desayuno != 0) {
                    echo " FREE DAILY CONTINENTAL BREKFAST ";
                } ?>. Taxes are Included.
                    <br>  
    <?php if ($buffet == 1 && $_SESSION['categoria'] != 2) { ?>
        <?php echo "<br><br>Daily SUPER BREKFAST BUFFET at your hotel."; ?><br>
                    <?php } ?>


                    <br>
                    <strong > <div align="left" > LOCAL TRANSFERS TO PARKS</div></strong>

    <?php
    echo "<ul>";
    foreach ($namepark as $value) {
        echo "<li>" . $value . "</li>";
    }
    echo "</ul>";
    ?> 

                    <?php
                    echo ($question == 1) ? "<strong>Includes tickets to parks.</strong>" : "<strong>Not includes tickets to parks.</strong>";
                    ?>
                    <hr>

                <?php } ?> 

                </p>
                <p><?php if ($toursbooking['sdeparture'] == 1) { ?>
                        <strong > <div align="left" > ITINERARY DEPARTURE</div></strong>
                        <br>
                        Date departure <strong><?php echo date("M-d-Y", strtotime($toursbooking['fecha_salida'])); ?></strong> &#45; <strong><?php echo date("g:i A", strtotime($toursbooking ['datedeparturetrip2'])); ?></strong> &#45;  Trip <strong><?php echo $toursbooking['trip2']; ?></strong>, Luxury <strong><?php echo $toursbooking['equipment2']; ?></strong> &#45; transportation from Orlando Super Tours Terminal to  <strong> <?php echo $area2 . '-' . $pickup2; ?></strong> arriving at <strong><?php echo date("g:i A", strtotime($toursbooking ['datearrivingtrip2'])); ?></strong>, Thank you for choosing us !. <br />
<?php } ?>
<?php if ($toursbooking['sdeparture'] == 2) { ?>
                        <strong > <div align="left" > ITINERARY DEPARTURE</div></strong>
                        <br>
                        Date departure <strong><?php echo date("M-d-Y", strtotime($toursbooking['fecha_salida'])); ?></strong> &#45; Drop Off Time:  <strong><?php echo date("h:s A", strtotime($toursbooking['hora2'])); ?></strong>, PRIVATE SERVICE  &#45; transportation VIP from Orlando, to MIAMI BEACH SOUTH 

                        <br />
<?php } ?>

<?php if ($toursbooking['sdeparture'] == 3) { ?>
                        <strong > <div align="left" > ITINERARY DEPARTURE</div></strong>
                        <br>
                        Date departure <strong><?php echo date("M-d-Y", strtotime($toursbooking['fecha_salida'])); ?></strong>  &#45; Departure: By Plane at Orlando International Airport 
                        Data Transfer Out:   Airline: <strong><?php echo $toursbooking['airlinedeparture']; ?></strong>   Flight #:   <strong><?php echo $toursbooking['flightdeparture']; ?></strong> Arrival Time: <strong><?php echo date("g:i A", strtotime($toursbooking['hora2'])); ?></strong>



                        <br />
<?php } ?>
<?php if ($toursbooking['sdeparture'] == 4) { ?>
                        <strong > <div align="left" > ITINERARY DEPARTURE</div></strong>
                        <br>
                        Date departure <strong><?php echo date("M-d-Y", strtotime($toursbooking['fecha_salida'])); ?></strong> <br> Departure: By Car   


                        <br />
<?php } ?>

                    <br />
                    <br />
                </p></td>
        </tr>
    </table>
</div>

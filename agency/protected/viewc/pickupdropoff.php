<?php // print_r($data["pickup1"]);?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
        <title>Supertours Of Orlando, Inc.</title>
        <link href="<?php echo $data['rootUrl']; ?>global/css/style.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" type="text/css" href="<?php echo $data['rootUrl']; ?>global/css/blitzer/jquery-ui-1.8.16.custom.css" />
        <script language="JavaScript" src="<?php echo $data['rootUrl']; ?>global/js/jquery-1.6.4.min.js" type="text/JavaScript"></script>
        <script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/jquery-ui-1.8.18.custom.min.js"></script>
    </head>
    <body>
        <div id="container">

            <?php            
            $booking = $_SESSION['booking'];
            if (isset($_SESSION['user'])) {
                $login = $_SESSION['user'];
            }
            ?>   
            <div id="header">
                <div id="logo"><a href="<?php echo $data['rootUrl']; ?>"><img src="<?php echo $data['rootUrl']; ?>global/images/logo.png" width="316" height="119" border="0" /></a></div>
                <div id="telinfo"><img src="<?php echo $data['rootUrl']; ?>global/img/reservations.jpg"  /></div>
            </div>
            <div id="topnav">

                <div style="display:inline; float:right;">
                    <a class="home img-link" href="<?php echo $data['rootUrl']; ?>" id="home">Home</a>
                    <?php if (isset($_SESSION['user'])) { ?>          
                        <a class="logout img-link" href="<?php echo $data['rootUrl']; ?>close/session">Cerrar Session</a>
<?php } ?>
                </div>
            </div><div id="content">

                <div id="center-column">
                    <form name="form2" action="<?php echo $data['rootUrl']; ?>booking/pickup-dropoff/autentication" method="post" id="form1"> 
                        <?php
                        if (isset($data['salida']) && isset($data['pickup1'])) {
                            $e = $data['salida'];

                            list($mes, $dia, $anyo) = explode("-", $e['fecha']);


                            $fecha1 = $anyo . "-" . $mes . "-" . $dia;

                            $booking = array(
                                "tipo_ticket" => $booking['tipo_ticket'],
                                "fromt" => $booking['fromt'],
                                "tot" => $booking['tot'],
                                "fecha_salida" => $booking['fecha_salida'],
                                "fecha_retorno" => $booking['fecha_retorno'],
                                "pax" => $booking['pax'],
                                "trip_no" => $e['trip_no'],
                                "price" => $e['price'],
                                "pricer" => $e['price2'],
                                "pricechil" => $e['price3'],
                                "priceadult" => $e['price4'],
                                "trip_arrival" => $booking['trip_arrival'],
                                "trip_departure" => $booking['trip_departure'],
                                "trip_arrival2" => $booking['trip_arrival2'],
                                "trip_departure2" => $booking['trip_departure2'],
                                "chil" => $booking['chil'],
                                "resident" => $booking['resident'],
                                "zip" => $booking['zip']
                            );
                            $_SESSION["booking"] = $booking;
                            $booking = $_SESSION["booking"];
                            ?>
                            <h2>PICK UP / DROP OFF  + EXTENSIONS</h2>
                            <div class="title"> <span id="r1"> <?php echo $e["trip_from"]; ?> To <?php echo $e["trip_to"]; ?></span></div> 
                            <table class="table table-bordered table-striped">  
                                <thead>
                                    <tr>
                                        <th width="14%">Trip</th>
                                        <th width="23%">Departing </th>
                                        <th width="9%">Departure</th>
                                        <th width="14%">&nbsp;&nbsp;Arrival&nbsp;&nbsp;</th>
                                        <th width="17%">PickUp</th>
                                        <th width="43%">DropOff</th>
                                    </tr>
                                </thead>  
                                <tr>  
                                    <td><?php echo $e['trip_no']; ?></td>
                                    <td><?php echo date("M-d-y", strtotime($fecha1)); ?></td>
                                    <td><?php echo date("g:i a", strtotime($e['trip_departure'])); ?></td>
                                    <td><?php echo date("g:i a", strtotime($e['trip_arrival'])); ?></td>
                                    <td>
                                        <select name="pickup1" id="pickup1">
                                            <option value=""></option>
                                            <?php
                                            $pck = '';
                                            $ext = '';
                                           
                                            foreach ($data["pickup1"] as $row) {
                                                if ($row['valid'] == '1') {
                                                    $ext .= '<option value="' . $row["id"] . ',' . $row["valid"] . ',1,' . $row["type"] . '">' . $row["nombre"] . " - " . $row["address"] .  " - $ " . $row["precio"] . ' P.P </option>';
                                                } else {
                                                    $pck .= '<option value="' . $row["id"] . ',' . $row["valid"] . ',1,' . $row["type"] . '">' . $row["nombre"] . " - " . $row["address"] . '</option>';
                                                }
                                            }
                                            echo $pck . '<option id="opt" value="">-----Extension' . "'s" . '------------------------------------------------</option>' . $ext;
                                            ?>                                     
                                        </select>
                                        <div id="areapickup1">Indicate Hotel Name  
                                            <input name="hotelarea1" id="hotelarea1" type="text" />
                                        </div>                   </td>
                                    <td>

                                        <select name="dropoff1" id="dropoff1">
                                            <option value=""></option>
                                            <?php
                                            $pck = '';
                                            $ext = '';
                                            $valid = '';
                                            foreach ($data["dropoff1"] as $row) {
                                                if (isset($row["valid"]))
                                                    $valid = $row["valid"];
                                                if ($valid == '1') {
                                                    $ext .= '<option value="' . $row["id"] . ',' . $valid . ',2,' . $row["type"] . '">' . $row["nombre"] . " - " . $row["address"].  " - $ " . $row["precio"] . ' P.P</option>';
                                                } else {
                                                    $pck .= '<option value="' . $row["id"] . ',' . $valid . ',2,' . $row["type"] . '">' . $row["nombre"] . " - " . $row["address"] . '</option>';
                                                }
                                                $valid = '';
                                            }
                                            echo $pck . '<option id="opt" value="">-----Extension' . "'s" . '------------------------------------------------</option>' . $ext;
                                            ?> 
                                        </select>

                                        <div id="areadropoff1">Indicate Hotel Name
                                            <input name="hotelarea2" id="hotelarea2" type="text" />
                                        </div>                    </td>
                                </tr>
                            </table>
<?php } ?>
                        <?php
                        if (isset($data['retorno'])) {
                            $e = $data['retorno'];
                            list($mes, $dia, $anyo) = explode("-", $e['fecha']);


                            $fecha = $anyo . "-" . $mes . "-" . $dia;

                            $booking = array(
                                "tipo_ticket" => $booking['tipo_ticket'],
                                "fromt" => $booking['fromt'],
                                "tot" => $booking['tot'],
                                "fecha_salida" => $booking['fecha_salida'],
                                "fecha_retorno" => $booking['fecha_retorno'],
                                "pax" => $booking['pax'],
                                "trip_no" => $booking['trip_no'],
                                "trip_no2" => $e['trip_no'],
                                "price" => $booking['price'],
                                "2price" => $e['price'],
                                "price2" => $e['price'],
                                "pricer" => $booking['pricer'],
                                "2pricer" => $e['price2'],
                                "2pricechil" => $e['price3'],
                                "pricechil" => $booking['pricechil'],
                                "priceadult" => $booking['priceadult'],
                                "2priceadult" => $e['price4'],
                                "trip_departure2" => $e['trip_departure'],
                                "trip_departure" => $booking['trip_departure'],
                                "chil" => $booking['chil'],
                                "resident" => $booking['resident'],
                                "zip" => $booking['zip']
                            );
                            $_SESSION["booking"] = $booking;
                            $booking = $_SESSION["booking"];
                            ?>
                            <div class="title"><span id="r2"><?php echo $e["trip_from"]; ?> To <?php echo $e["trip_to"]; ?></span></div> 
                            <table width="86%" class="table table-bordered table-striped">  
                                <thead>
                                    <tr>
                                        <th width="16%">Trip</th>
                                        <th width="23%">Returning</th>
                                        <th width="9%">Departure</th>
                                        <th width="16%">&nbsp;&nbsp;Arrival&nbsp;&nbsp;</th>
                                        <th width="16%">PickUp</th>
                                        <th width="20%">DropOff</th>
                                    </tr>
                                </thead>  
                                <tr>  
                                    <td height="47"><?php echo $e['trip_no']; ?></td>
                                    <td><?php echo date("M-d-y", strtotime($fecha)); ?></td>
                                    <td><?php echo date("g:i a", strtotime($e['trip_departure'])); ?></td>
                                    <td><?php echo date("g:i a", strtotime($e['trip_arrival'])); ?></td>
                                    <td>
                                        <select name="pickup2" id="pickup2">
                                            <option value=""></option>
    <?php
    $pck = '';
    $ext = '';
    $valid = '';
    foreach ($data["pickup2"] as $row) {
        if (isset($row["valid"]))
            $valid = $row["valid"];
        if ($valid == '1') {
            $ext .= '<option value="' . $row["id"] . ',' . $valid . ',3,' . $row["type"] . '">' . $row["nombre"] . " - " . $row["address"] .  " - $ " . $row["precio"] . ' P.P</option>';
        } else {
            $pck .= '<option value="' . $row["id"] . ',' . $valid . ',3,' . $row["type"] . '">' . $row["nombre"] . " - " . $row["address"] . '</option>';
        }
        $valid = '';
    }
    echo $pck . '<option id="opt" value="">-----Extension' . "'s" . '------------------------------------------------</option>' . $ext;
    ?> 
                                        </select>
                                        <div id="areapickup2">Indicate Hotel Name
                                            <input name="hotelarea3" id="hotelarea3" type="text" />
                                        </div></td>
                                    <td>
                                        <select name="dropoff2" id="dropoff2">
                                            <option value=""></option>
    <?php
    $pck = '';
    $ext = '';
    $valid = '';
    foreach ($data["pickup1"] as $row) {
        if ($row['valid'] == '1') {
            if (isset($row["valid"])) {
                $valid = $row["valid"];
            }
            $ext .= '<option value="' . $row["id"] . ',' . $valid . ',4,' . $row["type"] . '">' . $row["nombre"] . " - " . $row["address"] .  " - $ " . $row["precio"] . ' P.P</option>';
        } else {
            $pck .= '<option value="' . $row["id"] . ',' . $valid . ',4,' . $row["type"] . '">' . $row["nombre"] . " - " . $row["address"] . '</option>';
        }
        $valid = '';
    }
    echo $pck . '<option id="opt" value="">-----Extension' . "'s" . '------------------------------------------------</option>' . $ext;
    ?>  

                                        </select>
                                        <div id="areadropoff2">Indicate Hotel Name
                                            <input name="hotelarea4" id="hotelarea4" type="text" />
                                        </div>                    </td>
                                </tr>
                            </table>
<?php } ?>  
                        <p align="center">
                            <button  class="btn" id="btn-back" type="button">Back</button>   
                            <button   class="btn" id="btn-continue">Continue</button>
                        </p>



                    </form>
                </div>  

                <div id="n"></div>
                <div id="footer"><table width="100%" border="0">
                        <tr>
                            <td width="3%">&nbsp;</td>
                            <td width="24%"><img src="<?php echo $data['rootUrl']; ?>global/img/Visa.png"  /></td>
                            <td width="72%">Millions of passengers proved our red carpet service specially created to provide peace and comfort in traveling. Our purpose is to serve you like a king. <b> Copyright &copy;  1989 - 2012 Supertours Of  Orlando, INC . All Rights Reserved.</b> </td>
                            <td width="1%">&nbsp;</td>
                        </tr>
                    </table>
                </div>
                <div class="clear"></div>
            </div>

        </div>

    </body>

    <script>
        $(document).ready(function() {
            $("#areapickup1").css("display", "none");
            $("#areapickup2").css("display", "none");
            $("#areadropoff1").css("display", "none");
            $("#areadropoff2").css("display", "none");
        });

        $("#pickup1").change(function() {


            if ($("#pickup1").val() != "") {
                $("#n").load('<?php echo $data['rootUrl']; ?>load5/' + $("#pickup1").val(), function() {
                    $("#n").val('<?php echo $booking["tot"] ?>');
                });
            }

        });


        $("#dropoff1").change(function() {


            if ($("#dropoff1").val() != "") {
                $("#n").load('<?php echo $data['rootUrl']; ?>load5/' + $("#dropoff1").val(), function() {
                    $("#n").val('<?php echo $booking["tot"] ?>');
                });
            }

        });


        $("#pickup2").change(function() {


            if ($("#pickup2").val() != "") {
                $("#n").load('<?php echo $data['rootUrl']; ?>load5/' + $("#pickup2").val(), function() {
                    $("#n").val('<?php echo $booking["tot"] ?>');
                });
            }

        });

        $("#dropoff2").change(function() {


            if ($("#dropoff2").val() != "") {


                $("#n").load('<?php echo $data['rootUrl']; ?>load5/' + $("#dropoff2").val(), function() {
                    $("#n").val('<?php echo $booking["tot"] ?>');
                });
            }

        });



    </script>




    <script type="text/javascript">

        $("#btn-back").click(function() {
            window.location = '<?php echo $data['rootUrl']; ?>booking';
        });

        $("#btn-continue").click(function() {
            var msg = "";
            var p1 = $("#pickup1").val();
            var d1 = $("#dropoff1").val();
            var p2 = $("#pickup2").val();
            var d2 = $("#dropoff2").val();



            var id1 = $("#dropoff2").val();
            var id2 = $("#pickup1").val();
            var id3 = $("#pickup2").val();
            var id4 = $("#dropoff1").val();

            if (id4 == 327 || id4 == 328 || id4 == 329)
            {

                var drof = $("#hotelarea4").val();

                if (drof == "") {
                    msg += $('#r1').html() + " Hotel Area \n";
                }

            }

            if (id3 == 327 || id3 == 328 || id3 == 329)
            {

                var drof = $("#hotelarea6").val();

                if (drof == "") {
                    msg += $('#r2').html() + " Hotel Area \n";
                }

            }

            if (id1 == 327 || id1 == 328 || id1 == 329)
            {

                var drof = $("#hotelarea22").val();

                if (drof == "") {
                    msg += $('#r2').html() + " Hotel Area \n";
                }

            }

            if (id2 == 327 || id2 == 328 || id2 == 329)
            {
                var pick = $("#hotelarea1").val();

                if (pick == "") {
                    msg += $('#r1').html() + " Hotel Area \n";
                }

            }




            if (!p1) {
                if (p1 == "")
                    msg += $('#r1').html() + " PickUp is required\n";
            }
            if (!d1) {
                if (d1 == "")
                    msg += $('#r1').html() + " DropOff is required\n";
            }

            if (!p2) {
                if (p2 == "")
                    msg += $('#r2').html() + " PickUp is required\n";
            }

            if (!d2) {
                if (d2 == "")
                    msg += $('#r2').html() + " DropOff is required\n";
            }

            if (msg != "") {
                alert(msg);
                return false;
            }

            return true;

        });


    </script>    

    <script type="text/javascript">

        var _gaq = _gaq || [];
        _gaq.push(['_setAccount', 'UA-33124456-1']);
        _gaq.push(['_trackPageview']);

        (function() {
            var ga = document.createElement('script');
            ga.type = 'text/javascript';
            ga.async = true;
            ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
            var s = document.getElementsByTagName('script')[0];
            s.parentNode.insertBefore(ga, s);
        })();

    </script>

</html>
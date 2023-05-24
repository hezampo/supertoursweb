<?php 
   $areas = $this->data['areas'];
   if (isset($_SESSION['booking'])) {
       $booking = $_SESSION['booking'];
   }
   
   ?>
   <?php
//                                            echo '<pre>';
//                                            print_r($data['salida']);
//                                            echo '<pre>';
                                            foreach ($data['salida'] as $e):

                                                if(isset($booking["trip1"]) || isset($booking["trip2"])){
                                                    $booking = array(
                                                    "tipo_ticket" => $booking['tipo_ticket'],
                                                    "fromt" => $booking['fromt'],
                                                    "tot" => $booking['tot'],
                                                    "fecha_salida" => $booking['fecha_salida'],
                                                    "fecha_retorno" => $booking['fecha_retorno'],
                                                    "pax" => $booking['pax'],
                                                    "trip_departure" => $e['trip_departure'],
                                                    "chil" => $booking['chil'],
                                                    "resident" => $booking["resident"],
                                                    "zip" => $booking["zip"],
                                                    "iden" => $booking["iden"],
                                                    "dateT" => $booking["dateT"],
                                                    "dateT1" => $booking["dateT1"],
                                                    "dateT2" => $booking["dateT2"],
                                                    'trip1' => $booking["trip1"],
                                                    'trip2' => $booking["trip2"],
                                                    'idPrecioIda' => $booking["idPrecioIda"],
                                                    'idPrecioVuelta' => $booking["idPrecioVuelta"],
                                                    );
                                                }else{
                                                    $booking = array(
                                                    "tipo_ticket" => $booking['tipo_ticket'],
                                                    "fromt" => $booking['fromt'],
                                                    "tot" => $booking['tot'],
                                                    "fecha_salida" => $booking['fecha_salida'],
                                                    "fecha_retorno" => $booking['fecha_retorno'],
                                                    "pax" => $booking['pax'],
                                                    "trip_departure" => $e['trip_departure'],
                                                    "chil" => $booking['chil'],
                                                    "resident" => $booking["resident"],
                                                    "zip" => $booking["zip"],
                                                    "iden" => $booking["iden"],
                                                    "dateT" => $booking["dateT"],
                                                    "dateT1" => $booking["dateT1"],
                                                    "dateT2" => $booking["dateT2"],
                                                    );
                                                }

                                                $_SESSION["booking"] = $booking;
                                                $booking = $_SESSION['booking'];
                                                //print_r($booking);
                                                //die;
                                            endforeach;
                                            ?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta name="description" content>
      <meta name="keywords" content>
      <title>Super Tours</title>
      <link rel="icon" type="image/x-icon" href="<?php echo $data['rootUrl'] ?>global/icon.png">
      <link rel="stylesheet" href="<?php echo $data['rootUrl'] ?>global/assets/css/bootstrap.min.css">
      <link rel="stylesheet" href="<?php echo $data['rootUrl'] ?>global/assets/css/all-fontawesome.min.css">
      <link rel="stylesheet" href="<?php echo $data['rootUrl'] ?>global/assets/css/flaticon.css">
      <link rel="stylesheet" href="<?php echo $data['rootUrl'] ?>global/assets/css/animate.min.css">
      <link rel="stylesheet" href="<?php echo $data['rootUrl'] ?>global/assets/css/magnific-popup.min.css">
      <link rel="stylesheet" href="<?php echo $data['rootUrl'] ?>global/assets/css/owl.carousel.min.css">
      <link rel="stylesheet" href="<?php echo $data['rootUrl'] ?>global/assets/css/nice-select.min.css">
      <link rel="stylesheet" href="<?php echo $data['rootUrl'] ?>global/assets/css/jquery-ui.min.css">
      <link rel="stylesheet" href="<?php echo $data['rootUrl'] ?>global/assets/css/jquery.timepicker.min.css">
      <link rel="stylesheet" href="<?php echo $data['rootUrl'] ?>global/assets/css/style.css">
   </head>
   <body>
      <div class="preloader">
         <div class="loader">
            <span style="--i:1;"></span>
            <span style="--i:2;"></span>
            <span style="--i:3;"></span>
            <span style="--i:4;"></span>
            <span style="--i:5;"></span>
            <span style="--i:6;"></span>
            <span style="--i:7;"></span>
            <span style="--i:8;"></span>
            <span style="--i:9;"></span>
            <span style="--i:10;"></span>
            <span style="--i:11;"></span>
            <span style="--i:12;"></span>
            <span style="--i:13;"></span>
            <span style="--i:14;"></span>
            <span style="--i:15;"></span>
            <span style="--i:16;"></span>
            <span style="--i:17;"></span>
            <span style="--i:18;"></span>
            <span style="--i:19;"></span>
            <span style="--i:20;"></span>
            <div class="loader-plane"></div>
         </div>
      </div>
      <header class="header">
         <div class="header-top">
            <div class="container">
               <div class="row align-items-center">
                  <div class="col-md-7">
                     <div class="header-top-left">
                        <div class="top-contact-info">
                           <ul>
                              <li><a href="tel:+21234567897"><i class="far fa-phone-arrow-down-left"></i>Orlando (407) 370 3001 </a></li>
                              <li><a href="tel:+21234567897"><i class="far fa-phone-arrow-down-left"></i>Miami (305) 677 2676 </a></li>
                              <li><a
                                 href="https://live.themewild.com/cdn-cgi/l/email-protection#eb82858d84ab8e938a869b878ec5888486"><i
                                 class="far fa-envelopes"></i><span class="__cf_email__"
                                 data-cfemail="71181f171e311409101c011d145f121e1c">reservations@supertours.com</span></a>
                              </li>
                           </ul>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-5">
                     <div class="header-top-right">
                        <div class="account">
                           <a href="#"><i class="far fa-sign-in"></i>Login</a>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="main-navigation">
            <nav class="navbar navbar-expand-lg">
               <div class="container">
                  <a class="navbar-brand" href="{{route('home')}}">
                  <img src="<?php echo $data['rootUrl'] ?>global/assets/img/logo/logoSupertours.png" class="logo-display" alt="logo">
                  <img src="<?php echo $data['rootUrl'] ?>global/assets/img/logo/logoSupertours.png" class="logo-scrolled" alt="logo">
                  </a>
                  <div class="mobile-menu-right">
                     <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#main_nav" aria-expanded="false" aria-label="Toggle navigation">
                     <span class="navbar-toggler-btn-icon"><i class="far fa-bars"></i></span>
                     </button>
                  </div>
                  <div class="collapse navbar-collapse" id="main_nav">
                     <ul class="navbar-nav">
                        <li class="nav-item ">
                           <a class="nav-link dropdown-toggle active" href="{{route('home')}}">Home</a>
                        </li>
                        <li class="nav-item dropdown">
                           <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">Our Company</a>
                           <ul class="dropdown-menu fade-down">
                              <li><a class="dropdown-item" href="flight-grid.html">Super Tours</a></li>
                              <li><a class="dropdown-item" href="flight-list.html">Fleet and Terminal</a></li>
                              <li><a class="dropdown-item" href="{{ route('tickets-policy-supertours') }}">Ticket Policy</a>
                              </li>
                              <li><a class="dropdown-item" href="flight-single.html">Baggage</a></li>
                           </ul>
                        </li>
                        <li class="nav-item dropdown">
                           <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">Our Services</a>
                           <ul class="dropdown-menu fade-down">
                              <li><a class="dropdown-item" href="hotel-grid.html">Transportation</a></li>
                              <li><a class="dropdown-item" href="hotel-list.html">1 Day Tour</a></li>
                              <li><a class="dropdown-item" href="hotel-full-width.html">Multy Day Tour</a></li>
                           </ul>
                        </li>
                        <li class="nav-item">
                           <a class="nav-link" href="#">Destinations</a>
                        </li>
                        <li class="nav-item">
                           <a class="nav-link" href="#">FAQ</a>
                        </li>
                        <li class="nav-item"><a class="nav-link" href="contact.html">Contact Us</a></li>
                     </ul>
                  </div>
               </div>
            </nav>
         </div>
      </header>
      <main class="main">
         <div class="site-breadcrumb" style="background: url('<?php echo $data['rootUrl'] ?>global/assets/img/hero/epcot4217875_1920.jpg')">
            <div class="container">
               <h2 class="breadcrumb-title">Bus List</h2>
               <ul class="breadcrumb-menu">
                  <li><a href="index.html">Home</a></li>
                  <li class="active">Bus List</li>
               </ul>
            </div>
         </div>
         <div class="search-area">
            <div class="container">
               <div class="search-wrapper">
                  <div class="search-box flight-search">
                     <div class="search-form">
                        <form action="#" method="POST">
                           <div class="flight-type">
                              <div class="form-check form-check-inline">
                                 <input class="form-check-input" type="radio" value="one-way"
                                    name="flight-type" id="flight-type1">
                                 <label class="form-check-label" for="flight-type1">
                                 One Way Trip
                                 </label>
                              </div>
                              <div class="form-check form-check-inline">
                                 <input class="form-check-input" type="radio" value="round-way"
                                    name="flight-type" id="flight-type2">
                                 <label class="form-check-label" for="flight-type2">
                                 Round Trip
                                 </label>
                              </div>
                           </div>
                           <div class="flight-search-wrapper">
                              <div class="flight-search-content">
                                 <div class="flight-search-item">
                                    <div class="row">
                                       <div class="col-lg-3">
                                          <div class="form-group">
                                             <label>From</label>
                                             <div class="form-group-icon">
                                                <select class="form-control swap-to" name="fromt" id="from" onchange="myFunction()">
                                                   <?php foreach ($areas as $main){   
                                                      if ($main["id"] != 13 && $main["id"] != 15 && $main["id"] != 16 && $main["id"] != 17 && $main["id"]!=18 && $main["id"]!=19 && $main["id"]!=20) { ?>
                                                   <option   value="<?php echo $main['id']?>"  <?php echo (isset($booking['fromt']) AND $booking['fromt'] == $main['id']) ? 'selected' : '' ; ?>><?php echo $main['nombre']?></option>
                                                   <?php } } ?> 
                                                </select>
                                                <i class="fal fa-bus"></i>
                                             </div>
                                          </div>
                                       </div>
                                       <div class="col-lg-3">
                                          <div class="form-group">
                                             <div class="search-form-swap"><i
                                                class="far fa-repeat"></i>
                                             </div>
                                             <label>To</label>
                                             <div class="form-group-icon">
                                                <select class="form-control swap-to" name="to" id="to">
                                                   <?php foreach ($areas as $main){   
                                                      if ($main["id"] != 13 && $main["id"] != 15 && $main["id"] != 16 && $main["id"] != 17 && $main["id"]!=18 && $main["id"]!=19 && $main["id"]!=20) { ?>
                                                   <option   value="<?php echo $main['id']?>"  <?php echo (isset($booking['tot']) AND $booking['tot'] == $main['id']) ? 'selected' : '' ; ?>><?php echo $main['nombre']?></option>
                                                   <?php } } ?> 
                                                </select>
                                                <script>
                                                   function myFunction() {
                                                       var id = $("#from").val();
                                                       if (id !== ""){
                                                           $("#to").load(encodeURI('<?php echo $data['rootUrl']; ?>load/' + id));
                                                       }
                                                       }
                                                </script>
                                                <i class="fal fa-bus"></i>
                                             </div>
                                          </div>
                                       </div>
                                       <div class="col-lg-3">
                                          <div class="form-group">
                                             <div class="search-form-date">
                                                <div class="search-form-journey">
                                                   <label>Journey Date</label>
                                                   <div class="form-group-icon">
                                                      <input type="text" name="fecha_salida" id="dateFrom"
                                                         class="form-control date-picker journey-date" value="<?php echo $booking["fecha_salida"]?>">
                                                      <i class="fal fa-calendar-days"></i>
                                                   </div>
                                                </div>
                                                <div class="search-form-return" style="display: block">
                                                   <label>Return Date</label>
                                                   <div class="form-group-icon">
                                                      <input type="text" name="fecha_retorno" id="dateTo"
                                                         class="form-control date-picker return-date" value="<?php echo $booking["fecha_retorno"]?>">
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                       <div class="col-lg-3">
                                          <div class="form-group dropdown passenger-box">
                                             <div class="passenger-class" role="menu"
                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                <label>Passenger</label>
                                                <div class="form-group-icon">
                                                   <div class="passenger-total"><span
                                                      class="passenger-total-amount">2</span>
                                                      Passenger
                                                   </div>
                                                   <i class="fal fa-user-plus"></i>
                                                </div>
                                             </div>
                                             <div class="dropdown-menu dropdown-menu-end">
                                                <div class="dropdown-item">
                                                   <div class="passenger-item">
                                                      <div class="passenger-info">
                                                         <h6>Adults</h6>
                                                         <p>12+ Years</p>
                                                      </div>
                                                      <div class="passenger-qty">
                                                         <button type="button"
                                                            class="minus-btn"><i
                                                            class="far fa-minus"></i></button>
                                                         <input type="text" name="adult"
                                                            class="qty-amount passenger-adult"
                                                            value="2" readonly>
                                                         <button type="button"
                                                            class="plus-btn"><i
                                                            class="far fa-plus"></i></button>
                                                      </div>
                                                   </div>
                                                </div>
                                                <div class="dropdown-item">
                                                   <div class="passenger-item">
                                                      <div class="passenger-info">
                                                         <h6>Children</h6>
                                                         <p>2-12 Years</p>
                                                      </div>
                                                      <div class="passenger-qty">
                                                         <button type="button"
                                                            class="minus-btn"><i
                                                            class="far fa-minus"></i></button>
                                                         <input type="text" name="children"
                                                            class="qty-amount passenger-children"
                                                            value="0" readonly>
                                                         <button type="button"
                                                            class="plus-btn"><i
                                                            class="far fa-plus"></i></button>
                                                      </div>
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <div class="search-btn">
                                 <button type="submit" class="theme-btn"><span
                                    class="far fa-search"></span>Search Now</button>
                              </div>
                           </div>
                        </form>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <form action="<?php echo $data['rootUrl'] ?>booking/pickup-dropoff" method="POST">
            <div class="flight-booking flight-list py-120">
               <div class="container">
                  <div class="row">
                     <div class="col-lg-6 col-xl-6 mb-4">
                        <div class="col-md-12">
                           <div class="booking-sort">
                              <h5>Trip from <b><i><?php echo $this->data['from_name']?></i></b> to <b><i><?php echo $this->data['to_name']?></i></b></h5>
                           </div>
                        </div>
                        
                        <div class="row">
                           <div class="col-lg-12">
                              
                                 <?php  
                                    if(count($data['salida']) > 0){
                                        foreach($data['salida'] as $e){
                                            $estado = $e['seats_remain'];
                                                            $idfrom = $booking['fromt'];
                                                            $fromt = $booking['fromt'];
                                                            $idto = $booking['tot'];
                                                            $tot = $booking['tot'];
                                                            $trip = $e['trip_no'];                                                            
                                                            //echo $trip;
                                                            $fecha = $e['fecha_ini'];
                                                            // $sql = "SELECT SUM(cantidad)as CANTIDAD from reservas_trip_puestos where fecha_trip= ? AND trip_to = ? AND (tipo = '1' OR tipo = '2') AND (estado='USING' OR estado='RENEWED' ) AND tarifa = 5";
                                                            // $rs = Doo::db()->query($sql, array($fecha,$trip));
                                                            // $puestos = $rs->fetchAll(PDO::FETCH_ASSOC);
                                                            // $p_ocupadoswf = $puestos[0]['CANTIDAD'];
                                                            
                                                            //consultas paradas pickup dropoff
                                                            $sqlpckf = "SELECT place, address, instructions FROM pickup_dropoff WHERE id_area ='$fromt' AND tripw$trip ='1' AND active_web ='1'";

                                                            $rspckf = Doo::db()->query($sqlpckf);
                                                            $dplocf = $rspckf->fetchAll();

                                                            foreach ($dplocf as $dplf){
                                                                $placef = $dplf['place'];
                                                                $addrf = $dplf['address'];
                                                                $instf = $dplf['instructions'];
                                                            }
                                                            
                                                            $sqlpckt = "SELECT place, address, instructions FROM pickup_dropoff WHERE id_area ='$tot' AND tripw$trip ='1' AND active_web ='1'";

                                                            $rspckt = Doo::db()->query($sqlpckt);
                                                            $dploct = $rspckt->fetchAll();

                                                            foreach ($dploct as $dplt){
                                                                $placet = $dplt['place'];
                                                                $addrt = $dplt['address'];
                                                                $instt = $dplt['instructions'];
                                                            }
                                                                    
                                                            
                                                            

                                                            $sql = "SELECT
                                                            SUM(cantidad) AS cantwebf,
                                                                (SELECT SUM(cantidad) FROM reservas_trip_puestos
                                                            WHERE fecha_trip = ?
                                                            AND trip_to = ?
                                                            AND (tipo = '1' OR tipo = '2')
                                                            AND ( estado = 'USING' OR estado = 'RENEWED' ) AND tarifa = '4'
                                                            ) as cantsuperp,
                                                            (SELECT SUM(cantidad) FROM reservas_trip_puestos
                                                            WHERE fecha_trip = ?
                                                            AND trip_to = ?
                                                            AND (tipo = '1' OR tipo = '2')
                                                            AND ( estado = 'USING' OR estado = 'RENEWED' ) AND tarifa = '5'
                                                            ) as cantsuperdisc,
                                                            (SELECT SUM(cantidad) FROM reservas_trip_puestos
                                                            WHERE fecha_trip = ?
                                                            AND trip_to = ?
                                                            AND (tipo = '1' OR tipo = '2')
                                                            AND ( estado = 'USING' OR estado = 'RENEWED' ) AND tarifa = '2'
                                                            ) as cantsuperflex,
                                                            (SELECT SUM(cantidad) FROM reservas_trip_puestos
                                                            WHERE fecha_trip = ?
                                                            AND trip_to = ?
                                                            AND (tipo = '1' OR tipo = '2')
                                                            AND ( estado = 'USING' OR estado = 'RENEWED' ) AND tarifa = '1'
                                                            ) as cantstandar
                                                            FROM reservas_trip_puestos WHERE fecha_trip = ?
                                                            AND trip_to = ?
                                                            AND (tipo = '1' OR tipo = '2')
                                                            AND ( estado = 'USING' OR estado = 'RENEWED' ) AND tarifa = '3' ";
                                                            $rs = Doo::db()->query($sql, array($fecha,$trip,$fecha,$trip,$fecha,$trip,$fecha,$trip,$fecha,$trip));
                                                            $puestos = $rs->fetchAll(PDO::FETCH_ASSOC);
                                                            // $p_ocupadoswf = $puestos[0]['CANTIDAD'];

                                                            $cantidadwebf = $puestos[0]['cantwebf'] ? $puestos[0]['cantwebf'] : 0;
                                                            $cantidadsuperpro = $puestos[0]['cantsuperp'] ? $puestos[0]['cantsuperp'] : 0;
                                                            $cantidadsuperdisc = $puestos[0]['cantsuperdisc'] ? $puestos[0]['cantsuperdisc'] : 0;
                                                            $cantidadsuperflex = $puestos[0]['cantsuperflex'] ? $puestos[0]['cantsuperflex'] : 0;
                                                            $cantidadsstandar = $puestos[0]['cantstandar'] ? $puestos[0]['cantstandar'] : 0;

                                                            // print_r($cantidadsuperdisc);
                                                            $tota = $cantidadwebf+$cantidadsuperpro+$cantidadsuperdisc+$cantidadsuperflex+$cantidadsstandar;
                                                            $sql2 = "SELECT DISTINCT spseats,sdseats,wfseats,sflexseats,stseats,spprcseats,toursseats,vehicles,capacity,capacity2,capacity3,capacity4,capacity5,seats_remain FROM routes WHERE fecha_ini = ? AND trip_no = ?";
                                                            $rs2 = Doo::db()->query($sql2, array($fecha,$trip));
                                                            $routes = $rs2->fetchAll(PDO::FETCH_ASSOC);
                                                            // $seats = $routes[0]['seats_remain'];

                                                            $capacidad100_1 = $routes[0]['capacity'];
                                                            $capacidad100_2 = $routes[0]['capacity2'];
                                                            $capacidad100_3 = $routes[0]['capacity3'];
                                                            $capacidad100_4 = $routes[0]['capacity4'];
                                                            $capacidad100_5 = $routes[0]['capacity5'];


                                                            $webfare_100 = $routes[0]['wfseats'];
                                                            $superpromo_100 = $routes[0]['spseats'];
                                                            $superdiscount_100 = $routes[0]['sdseats'];
                                                            $superflex_100 = $routes[0]['sflexseats'];
                                                            $standard_100 = $routes[0]['sflexseats'];
                                                            $sppr_100 = $routes[0]['spprcseats'];
                                                            $tour_100 = $routes[0]['toursseats'];

                                                            $seatstot = $capacidad100_1 + $capacidad100_2 + $capacidad100_3 + $capacidad100_4 +$capacidad100_5;

                                                            $sql_spcida100 = "SELECT
                                                            (sum(pax) + sum(pax2)) AS superpromo,
                                                            (SELECT (sum(pax) + sum(pax2)) FROM reservas WHERE trip_no = ? AND fecha_salida = ?
                                                            AND estado != 'QUOTE'
                                                            AND estado != 'CANCELED'
                                                            AND estado != 'NOT SHOW W/ CHARGE'
                                                            AND estado != 'NOT SHOW W/O CHARGE'
                                                            AND estado != 'NO SHOW'
                                                            AND id1 = '5') as superdiscount,
                                                            (SELECT (sum(pax) + sum(pax2)) FROM reservas WHERE trip_no = ? AND fecha_salida = ?
                                                            AND estado != 'QUOTE'
                                                            AND estado != 'CANCELED'
                                                            AND estado != 'NOT SHOW W/ CHARGE'
                                                            AND estado != 'NOT SHOW W/O CHARGE'
                                                            AND estado != 'NO SHOW'
                                                            AND id1 = '3') as webfare,
                                                            (SELECT (sum(pax) + sum(pax2)) FROM reservas WHERE trip_no = ? AND fecha_salida = ?
                                                            AND estado != 'QUOTE'
                                                            AND estado != 'CANCELED'
                                                            AND estado != 'NOT SHOW W/ CHARGE'
                                                            AND estado != 'NOT SHOW W/O CHARGE'
                                                            AND estado != 'NO SHOW'
                                                            AND id1 = '1') as standard,
                                                            (SELECT (sum(pax) + sum(pax2)) FROM reservas  WHERE trip_no = ? AND fecha_salida = ?
                                                            AND estado != 'QUOTE'
                                                            AND estado != 'CANCELED'
                                                            AND estado != 'NOT SHOW W/ CHARGE'
                                                            AND estado != 'NOT SHOW W/O CHARGE'
                                                            AND estado != 'NO SHOW'
                                                            AND id1 = '2') as superflex,
                                                            (SELECT (sum(pax) + sum(pax2)) FROM  reservas Where trip_no = ? AND fecha_salida = ?
                                                            AND (type_tour = 'ONE'
                                                            OR type_tour = 'MULTI')
                                                            AND estado != 'QUOTE'
                                                            AND estado != 'CANCELED'
                                                            AND estado != 'NOT SHOW W/ CHARGE'
                                                            AND estado != 'NOT SHOW W/O CHARGE') AS tours,
                                                            (SELECT (sum(pax) + sum(pax2)) FROM  reservas Where trip_no = ?  AND fecha_salida = ?
                                                            AND id1 = '6'
                                                            AND estado != 'QUOTE'
                                                            AND estado != 'CANCELED'
                                                            AND estado != 'NOT SHOW W/ CHARGE'
                                                            AND estado != 'NOT SHOW W/O CHARGE') AS especial

                                                            FROM reservas  WHERE trip_no = ? AND fecha_salida = ?
                                                            AND estado != 'QUOTE'
                                                            AND estado != 'CANCELED'
                                                            AND estado != 'NOT SHOW W/ CHARGE'
                                                            AND estado != 'NOT SHOW W/O CHARGE'
                                                            AND estado != 'NO SHOW'
                                                            AND id1 = '4' ";
                                                            $trips100 = Doo::db()->query($sql_spcida100, array($trip,$fecha,$trip,$fecha,$trip,$fecha,$trip,$fecha,$trip,$fecha,$trip,$fecha,$trip,$fecha));
                                                            $r_spcida100 = $trips100->fetchAll();
                                                            //print_r($r_spcida100);
                                                            //die;
                                                            // $seats_ida100 = $r_spcida100[0]['superdiscount'];
                                                            $spro_ida100 = $r_spcida100[0]['superpromo'] ? $r_spcida100[0]['superpromo'] : 0;
                                                            $sdic_ida100 = $r_spcida100[0]['superdiscount'] ? $r_spcida100[0]['superdiscount'] : 0;
                                                            $wfare_ida100 = $r_spcida100[0]['webfare'] ? $r_spcida100[0]['webfare'] : 0;
                                                            $standr_ida100 = $r_spcida100[0]['standard'] ? $r_spcida100[0]['standard'] : 0;
                                                            $sflex_ida100 = $r_spcida100[0]['superflex'] ? $r_spcida100[0]['superflex'] : 0;
                                                            $special_ida100 = $r_spcida100[0]['especial'] ? $r_spcida100[0]['especial'] : 0;
                                                            $tour_ida100 = $r_spcida100[0]['tours'] ? $r_spcida100[0]['tours'] : 0;

                                                            $sql_spcretorno100 = "SELECT (sum(pax_r) + sum(pax2_r)) AS superpromo,
                                                            (SELECT (sum(pax_r) + sum(pax2_r)) FROM  reservas WHERE trip_no2 = ? AND fecha_retorno = ?
                                                            AND estado != 'QUOTE'
                                                            AND estado != 'CANCELED'
                                                            AND estado != 'NOT SHOW W/ CHARGE'
                                                            AND estado != 'NOT SHOW W/O CHARGE'
                                                            AND estado != 'NO SHOW'
                                                            AND id2 = '5') as superdiscount,
                                                            (SELECT (sum(pax_r) + sum(pax2_r)) FROM reservas WHERE trip_no2 = ? AND fecha_retorno = ?
                                                            AND estado != 'QUOTE'
                                                            AND estado != 'CANCELED'
                                                            AND estado != 'NOT SHOW W/ CHARGE'
                                                            AND estado != 'NOT SHOW W/O CHARGE'
                                                            AND estado != 'NO SHOW'
                                                            AND id2 = '3') as webfare,
                                                            (SELECT (sum(pax_r) + sum(pax2_r)) FROM reservas WHERE trip_no2 = ? AND fecha_retorno = ?
                                                            AND estado != 'QUOTE'
                                                            AND estado != 'CANCELED'
                                                            AND estado != 'NOT SHOW W/ CHARGE'
                                                            AND estado != 'NOT SHOW W/O CHARGE'
                                                            AND estado != 'NO SHOW'
                                                            AND id2 = '1') as standard,
                                                            (SELECT (sum(pax_r) + sum(pax2_r)) FROM reservas WHERE trip_no2 = ? AND fecha_retorno = ?
                                                            AND estado != 'QUOTE'
                                                            AND estado != 'CANCELED'
                                                            AND estado != 'NOT SHOW W/ CHARGE'
                                                            AND estado != 'NOT SHOW W/O CHARGE'
                                                            AND estado != 'NO SHOW'
                                                            AND id2 = '2') as superflex,
                                                            (SELECT (sum(pax_r) + sum(pax2_r)) FROM  reservas  Where trip_no2 = ? AND fecha_retorno = ?
                                                            AND (type_tour = 'ONE'
                                                            OR type_tour = 'MULTI')
                                                            AND estado != 'QUOTE'
                                                            AND estado != 'CANCELED'
                                                            AND estado != 'NOT SHOW W/ CHARGE'
                                                            AND estado != 'NOT SHOW W/O CHARGE') AS tours,
                                                            (SELECT (sum(pax_r) + sum(pax2_r)) FROM  reservas Where trip_no2 = ? AND fecha_retorno = ?
                                                            AND id2 = '6'
                                                            AND estado != 'QUOTE'
                                                            AND estado != 'CANCELED'
                                                            AND estado != 'NOT SHOW W/ CHARGE'
                                                            AND estado != 'NOT SHOW W/O CHARGE') AS especial
                                                            FROM reservas WHERE trip_no2 = ? AND fecha_retorno = ?
                                                            AND estado != 'QUOTE'
                                                            AND estado != 'CANCELED'
                                                            AND estado != 'NOT SHOW W/ CHARGE'
                                                            AND estado != 'NOT SHOW W/O CHARGE'
                                                            AND estado != 'NO SHOW'
                                                            AND id2 = '4'";
                                                            // $rs_spcretorno100 = Doo::db()->query($sql_spcretorno100, array($trip100, $fecha));
                                                            $rs_spcretorno100 = Doo::db()->query($sql_spcretorno100, array($trip,$fecha,$trip,$fecha,$trip,$fecha,$trip,$fecha,$trip,$fecha,$trip,$fecha,$trip,$fecha));
                                                            $r_spcretorno100 = $rs_spcretorno100->fetchAll();

                                                            $spro_retorno100 = $r_spcretorno100[0]['superpromo'] ? $r_spcretorno100[0]['superpromo'] : 0;
                                                            $sdic_retorno100 = $r_spcretorno100[0]['superdiscount'] ? $r_spcretorno100[0]['superdiscount'] : 0;
                                                            $wfare_retorno100 = $r_spcretorno100[0]['webfare'] ? $r_spcretorno100[0]['webfare'] : 0;
                                                            $standr_retorno100 = $r_spcretorno100[0]['standard'] ? $r_spcretorno100[0]['standard'] : 0;
                                                            $sflex_retorno100 = $r_spcretorno100[0]['superflex'] ? $r_spcretorno100[0]['superflex'] : 0;
                                                            $special_retorno100 = $r_spcretorno100[0]['especial'] ? $r_spcretorno100[0]['especial'] : 0;
                                                            $tour_retorno100 = $r_spcretorno100[0]['tours'] ? $r_spcretorno100[0]['tours'] : 0;


                                                            $total_spro100 = $spro_ida100 + $spro_retorno100 ;
                                                            $total_sdic100 = $sdic_ida100 + $sdic_retorno100 ;
                                                            $total_wfare100 = $wfare_ida100 + $wfare_retorno100 ;
                                                            $total_standr100 = $standr_ida100 + $standr_retorno100 ;
                                                            $total_sflex100 = $sflex_ida100 + $sflex_retorno100 ;
                                                            $total_especial100 = $special_ida100 + $special_retorno100 ;
                                                            $total_tours100 = $tour_ida100 + $tour_retorno100 ;

                                                            $ReservasTotales = $total_spro100 + $total_sdic100 + $total_wfare100  + $total_standr100 + $total_sflex100 + $total_especial100 + $total_tours100;

                                                            $resultsuperflex = $total_sflex100 - $superflex_100;

                                                            $OcupadosTotales =  $ReservasTotales;
                                                            $seats = $seatstot - $ReservasTotales;

                                                            $numperson100 = $_SESSION['booking']['pax'] + $_SESSION['booking']['chil'];
                                                            
                                                            $wf_tot = ($webfare_100 - $total_wfare100)-$total_standr100-$total_especial100-$total_tours100 -$total_spro100-$total_sdic100-$numperson100-$cantidadwebf-$cantidadsuperpro-$cantidadsuperdisc - $cantidadsstandar ;

                                                                $sflx_tot = ($superflex_100 - $total_sflex100)-$numperson100-$cantidadsuperflex;

                                                                $spr_tot = ($superpromo_100 - $total_spro100)-$numperson100-$cantidadsuperpro;

                                                                $sdc_tot = ($superdiscount_100 - $total_sdic100)-$numperson100-$cantidadsuperdisc;

                                                                if($wf_tot <= $spr_tot){
                                                                    $spr_tot = $wf_tot;
                                                                    }else{
                                                                    $spr_tot = $spr_tot;
                                                                    }

                                                                    if($wf_tot <= $sdc_tot){
                                                                    $sdc_tot = $wf_tot;
                                                                    }else{
                                                                    $sdc_tot = $sdc_tot;
                                                                    }
                                                                    $wdext = 0;
                                                                $unvext = 0;

                                                            if ($idfrom == 24 or $idto == 24) {
                                                                $wdext = $e['wdext'];
                                                            } elseif ($idfrom == 22 or $idto == 22) {
                                                                $wdext = $e['wdext'];
                                                            } elseif ($idfrom == 23 or $idto == 23) {
                                                                $unvext = $e['univext'];
                                                            } elseif ($idfrom == 21 or $idto == 21) {
                                                                $unvext = $e['univext'];
                                                            } else {
                                                                $wdext = 0;
                                                                $unvext = 0;
                                                            }
                                                            $booking["resident"] = 0;
                                                            $residente = $booking["resident"];
                                                            if($booking["resident"] == 1){
                                                                
                                                                $webfarer_adult = ($unvext + $wdext  + $e['wfprc_adult'] + $e['flresprc_adult'] + $e['f1t3'] + $e['f1t4'] + $e['f1t5'] + $e['f1t6'] + $e['f1t7'] + $e['f1t8'] + $e['f1t9'] + $e['f1t10'] + $e['f1t19'] + $e['f1t11'] + $e['f1t12'] + $e['f1t13'] + $e['f1t14'] + $e['f2t3'] + $e['f2t3'] + $e['f2t4'] + $e['f2t5'] + $e['f2t6'] + $e['f2t7'] + $e['f2t8'] + $e['f2t9'] + $e['f2t10'] + $e['f2t19'] + $e['f2t11'] + $e['f2t12'] + $e['f2t13'] + $e['f2t14'] + $e['f3t4'] + $e['f3t5'] + $e['f3t6'] + $e['f3t7'] + $e['f3t8'] + $e['f3t9'] + $e['f3t10'] + $e['f3t19'] + $e['f3t11'] + $e['f3t12'] + $e['f3t13'] + $e['f3t14'] + $e['f4t5'] + $e['f4t6'] + $e['f4t7'] + $e['f4t8'] + $e['f4t9'] + $e['f4t10'] + $e['f4t19'] + $e['f4t11'] + $e['f4t12'] + $e['f4t13'] + $e['f4t14'] + $e['f5t6'] + $e['f5t7'] + $e['f5t8'] + $e['f5t9'] + $e['f5t10'] + $e['f5t19'] + $e['f5t11'] + $e['f5t12'] + $e['f5t13'] + $e['f5t14']);
                                                                $webfarer_child = ($unvext + $wdext  + $e['wfprc_child'] + $e['flresprc_child'] + $e['f1t3'] + $e['f1t4'] + $e['f1t5'] + $e['f1t6'] + $e['f1t7'] + $e['f1t8'] + $e['f1t9'] + $e['f1t10'] + $e['f1t19'] + $e['f1t11'] + $e['f1t12'] + $e['f1t13'] + $e['f1t14'] + $e['f2t3'] + $e['f2t3'] + $e['f2t4'] + $e['f2t5'] + $e['f2t6'] + $e['f2t7'] + $e['f2t8'] + $e['f2t9'] + $e['f2t10'] + $e['f2t19'] + $e['f2t11'] + $e['f2t12'] + $e['f2t13'] + $e['f2t14'] + $e['f3t4'] + $e['f3t5'] + $e['f3t6'] + $e['f3t7'] + $e['f3t8'] + $e['f3t9'] + $e['f3t10'] + $e['f3t19'] + $e['f3t11'] + $e['f3t12'] + $e['f3t13'] + $e['f3t14'] + $e['f4t5'] + $e['f4t6'] + $e['f4t7'] + $e['f4t8'] + $e['f4t9'] + $e['f4t10'] + $e['f4t19'] + $e['f4t11'] + $e['f4t12'] + $e['f4t13'] + $e['f4t14'] + $e['f5t6'] + $e['f5t7'] + $e['f5t8'] + $e['f5t9'] + $e['f5t10'] + $e['f5t19'] + $e['f5t11'] + $e['f5t12'] + $e['f5t13'] + $e['f5t14']);

                                                                $superpromo_adult = $unvext + $wdext + $e['spprc_adult'] + $e['f1t3'] + $e['f1t4'] + $e['f1t5'] + $e['f1t6'] + $e['f1t7'] + $e['f1t8'] + $e['f1t9'] + $e['f1t10'] + $e['f1t19'] + $e['f1t11'] + $e['f1t12'] + $e['f1t13'] + $e['f1t14'] + $e['f2t3'] + $e['f2t3'] + $e['f2t4'] + $e['f2t5'] + $e['f2t6'] + $e['f2t7'] + $e['f2t8'] + $e['f2t9'] + $e['f2t10'] + $e['f2t19'] + $e['f2t11'] + $e['f2t12'] + $e['f2t13'] + $e['f2t14'] + $e['f3t4'] + $e['f3t5'] + $e['f3t6'] + $e['f3t7'] + $e['f3t8'] + $e['f3t9'] + $e['f3t10'] + $e['f3t19'] + $e['f3t11'] + $e['f3t12'] + $e['f3t13'] + $e['f3t14'] + $e['f4t5'] + $e['f4t6'] + $e['f4t7'] + $e['f4t8'] + $e['f4t9'] + $e['f4t10'] + $e['f4t19'] + $e['f4t11'] + $e['f4t12'] + $e['f4t13'] + $e['f4t14'] + $e['f5t6'] + $e['f5t7'] + $e['f5t8'] + $e['f5t9'] + $e['f5t10'] + $e['f5t19'] + $e['f5t11'] + $e['f5t12'] + $e['f5t13'] + $e['f5t14'];
                                                                $superpromo_child = $unvext + $wdext + $e['spprc_child'] + $e['f1t3'] + $e['f1t4'] + $e['f1t5'] + $e['f1t6'] + $e['f1t7'] + $e['f1t8'] + $e['f1t9'] + $e['f1t10'] + $e['f1t19'] + $e['f1t11'] + $e['f1t12'] + $e['f1t13'] + $e['f1t14'] + $e['f2t3'] + $e['f2t3'] + $e['f2t4'] + $e['f2t5'] + $e['f2t6'] + $e['f2t7'] + $e['f2t8'] + $e['f2t9'] + $e['f2t10'] + $e['f2t19'] + $e['f2t11'] + $e['f2t12'] + $e['f2t13'] + $e['f2t14'] + $e['f3t4'] + $e['f3t5'] + $e['f3t6'] + $e['f3t7'] + $e['f3t8'] + $e['f3t9'] + $e['f3t10'] + $e['f3t19'] + $e['f3t11'] + $e['f3t12'] + $e['f3t13'] + $e['f3t14'] + $e['f4t5'] + $e['f4t6'] + $e['f4t7'] + $e['f4t8'] + $e['f4t9'] + $e['f4t10'] + $e['f4t19'] + $e['f4t11'] + $e['f4t12'] + $e['f4t13'] + $e['f4t14'] + $e['f5t6'] + $e['f5t7'] + $e['f5t8'] + $e['f5t9'] + $e['f5t10'] + $e['f5t19'] + $e['f5t11'] + $e['f5t12'] + $e['f5t13'] + $e['f5t14'];
                                                                
                                                                $superdiscount_adult = $unvext + $wdext + $e['sdprc_adult'] + $e['f1t3'] + $e['f1t4'] + $e['f1t5'] + $e['f1t6'] + $e['f1t7'] + $e['f1t8'] + $e['f1t9'] + $e['f1t10'] + $e['f1t19'] + $e['f1t11'] + $e['f1t12'] + $e['f1t13'] + $e['f1t14'] + $e['f2t3'] + $e['f2t3'] + $e['f2t4'] + $e['f2t5'] + $e['f2t6'] + $e['f2t7'] + $e['f2t8'] + $e['f2t9'] + $e['f2t10'] + $e['f2t19'] + $e['f2t11'] + $e['f2t12'] + $e['f2t13'] + $e['f2t14'] + $e['f3t4'] + $e['f3t5'] + $e['f3t6'] + $e['f3t7'] + $e['f3t8'] + $e['f3t9'] + $e['f3t10'] + $e['f3t19'] + $e['f3t11'] + $e['f3t12'] + $e['f3t13'] + $e['f3t14'] + $e['f4t5'] + $e['f4t6'] + $e['f4t7'] + $e['f4t8'] + $e['f4t9'] + $e['f4t10'] + $e['f4t19'] + $e['f4t11'] + $e['f4t12'] + $e['f4t13'] + $e['f4t14'] + $e['f5t6'] + $e['f5t7'] + $e['f5t8'] + $e['f5t9'] + $e['f5t10'] + $e['f5t19'] + $e['f5t11'] + $e['f5t12'] + $e['f5t13'] + $e['f5t14'];
                                                                $superdiscount_child = $unvext + $wdext + $e['sdprc_child'] + $e['f1t3'] + $e['f1t4'] + $e['f1t5'] + $e['f1t6'] + $e['f1t7'] + $e['f1t8'] + $e['f1t9'] + $e['f1t10'] + $e['f1t19'] + $e['f1t11'] + $e['f1t12'] + $e['f1t13'] + $e['f1t14'] + $e['f2t3'] + $e['f2t3'] + $e['f2t4'] + $e['f2t5'] + $e['f2t6'] + $e['f2t7'] + $e['f2t8'] + $e['f2t9'] + $e['f2t10'] + $e['f2t19'] + $e['f2t11'] + $e['f2t12'] + $e['f2t13'] + $e['f2t14'] + $e['f3t4'] + $e['f3t5'] + $e['f3t6'] + $e['f3t7'] + $e['f3t8'] + $e['f3t9'] + $e['f3t10'] + $e['f3t19'] + $e['f3t11'] + $e['f3t12'] + $e['f3t13'] + $e['f3t14'] + $e['f4t5'] + $e['f4t6'] + $e['f4t7'] + $e['f4t8'] + $e['f4t9'] + $e['f4t10'] + $e['f4t19'] + $e['f4t11'] + $e['f4t12'] + $e['f4t13'] + $e['f4t14'] + $e['f5t6'] + $e['f5t7'] + $e['f5t8'] + $e['f5t9'] + $e['f5t10'] + $e['f5t19'] + $e['f5t11'] + $e['f5t12'] + $e['f5t13'] + $e['f5t14'];

                                                                $superfelx_adult = $unvext + $wdext + $e['sflexprc_adult'] + $e['flresprc_adult'] + $e['f1t3'] + $e['f1t4'] + $e['f1t5'] + $e['f1t6'] + $e['f1t7'] + $e['f1t8'] + $e['f1t9'] + $e['f1t10'] + $e['f1t19'] + $e['f1t11'] + $e['f1t12'] + $e['f1t13'] + $e['f1t14'] + $e['f2t3'] + $e['f2t3'] + $e['f2t4'] + $e['f2t5'] + $e['f2t6'] + $e['f2t7'] + $e['f2t8'] + $e['f2t9'] + $e['f2t10'] + $e['f2t19'] + $e['f2t11'] + $e['f2t12'] + $e['f2t13'] + $e['f2t14'] + $e['f3t4'] + $e['f3t5'] + $e['f3t6'] + $e['f3t7'] + $e['f3t8'] + $e['f3t9'] + $e['f3t10'] + $e['f3t19'] + $e['f3t11'] + $e['f3t12'] + $e['f3t13'] + $e['f3t14'] + $e['f4t5'] + $e['f4t6'] + $e['f4t7'] + $e['f4t8'] + $e['f4t9'] + $e['f4t10'] + $e['f4t19'] + $e['f4t11'] + $e['f4t12'] + $e['f4t13'] + $e['f4t14'] + $e['f5t6'] + $e['f5t7'] + $e['f5t8'] + $e['f5t9'] + $e['f5t10'] + $e['f5t19'] + $e['f5t11'] + $e['f5t12'] + $e['f5t13'] + $e['f5t14'];
                                                                $superfelx_child = $unvext + $wdext + $e['sflexprc_child'] + $e['flresprc_child'] + $e['f1t3'] + $e['f1t4'] + $e['f1t5'] + $e['f1t6'] + $e['f1t7'] + $e['f1t8'] + $e['f1t9'] + $e['f1t10'] + $e['f1t19'] + $e['f1t11'] + $e['f1t12'] + $e['f1t13'] + $e['f1t14'] + $e['f2t3'] + $e['f2t3'] + $e['f2t4'] + $e['f2t5'] + $e['f2t6'] + $e['f2t7'] + $e['f2t8'] + $e['f2t9'] + $e['f2t10'] + $e['f2t19'] + $e['f2t11'] + $e['f2t12'] + $e['f2t13'] + $e['f2t14'] + $e['f3t4'] + $e['f3t5'] + $e['f3t6'] + $e['f3t7'] + $e['f3t8'] + $e['f3t9'] + $e['f3t10'] + $e['f3t19'] + $e['f3t11'] + $e['f3t12'] + $e['f3t13'] + $e['f3t14'] + $e['f4t5'] + $e['f4t6'] + $e['f4t7'] + $e['f4t8'] + $e['f4t9'] + $e['f4t10'] + $e['f4t19'] + $e['f4t11'] + $e['f4t12'] + $e['f4t13'] + $e['f4t14'] + $e['f5t6'] + $e['f5t7'] + $e['f5t8'] + $e['f5t9'] + $e['f5t10'] + $e['f5t19'] + $e['f5t11'] + $e['f5t12'] + $e['f5t13'] + $e['f5t14'];

                                                            }else{

                                                                $webfarer_adult = ($residente == '1' ? ($unvext + $wdext  + $e['wfprc_adult'] + $e['f1t3'] + $e['f1t4'] + $e['f1t5'] + $e['f1t6'] + $e['f1t7'] + $e['f1t8'] + $e['f1t9'] + $e['f1t10'] + $e['f1t19'] + $e['f1t11'] + $e['f1t12'] + $e['f1t13'] + $e['f1t14'] + $e['f2t3'] + $e['f2t3'] + $e['f2t4'] + $e['f2t5'] + $e['f2t6'] + $e['f2t7'] + $e['f2t8'] + $e['f2t9'] + $e['f2t10'] + $e['f2t19'] + $e['f2t11'] + $e['f2t12'] + $e['f2t13'] + $e['f2t14'] + $e['f3t4'] + $e['f3t5'] + $e['f3t6'] + $e['f3t7'] + $e['f3t8'] + $e['f3t9'] + $e['f3t10'] + $e['f3t19'] + $e['f3t11'] + $e['f3t12'] + $e['f3t13'] + $e['f3t14'] + $e['f4t5'] + $e['f4t6'] + $e['f4t7'] + $e['f4t8'] + $e['f4t9'] + $e['f4t10'] + $e['f4t19'] + $e['f4t11'] + $e['f4t12'] + $e['f4t13'] + $e['f4t14'] + $e['f5t6'] + $e['f5t7'] + $e['f5t8'] + $e['f5t9'] + $e['f5t10'] + $e['f5t19'] + $e['f5t11'] + $e['f5t12'] + $e['f5t13'] + $e['f5t14']) : ($unvext + $wdext + $e['wfprc_adult'] + $e['f1t3'] + $e['f1t4'] + $e['f1t5'] + $e['f1t6'] + $e['f1t7'] + $e['f1t8'] + $e['f1t9'] + $e['f1t10'] + $e['f1t19'] + $e['f1t11'] + $e['f1t12'] + $e['f1t13'] + $e['f1t14'] + $e['f2t3'] + $e['f2t3'] + $e['f2t4'] + $e['f2t5'] + $e['f2t6'] + $e['f2t7'] + $e['f2t8'] + $e['f2t9'] + $e['f2t10'] + $e['f2t19'] + $e['f2t11'] + $e['f2t12'] + $e['f2t13'] + $e['f2t14'] + $e['f3t4'] + $e['f3t5'] + $e['f3t6'] + $e['f3t7'] + $e['f3t8'] + $e['f3t9'] + $e['f3t10'] + $e['f3t19'] + $e['f3t11'] + $e['f3t12'] + $e['f3t13'] + $e['f3t14'] + $e['f4t5'] + $e['f4t6'] + $e['f4t7'] + $e['f4t8'] + $e['f4t9'] + $e['f4t10'] + $e['f4t19'] + $e['f4t11'] + $e['f4t12'] + $e['f4t13'] + $e['f4t14'] + $e['f5t6'] + $e['f5t7'] + $e['f5t8'] + $e['f5t9'] + $e['f5t10'] + $e['f5t19'] + $e['f5t11'] + $e['f5t12'] + $e['f5t13'] + $e['f5t14']));
                                                                $webfarer_child = ($residente == '1' ? ($unvext + $wdext  + $e['wfprc_child'] + $e['f1t3'] + $e['f1t4'] + $e['f1t5'] + $e['f1t6'] + $e['f1t7'] + $e['f1t8'] + $e['f1t9'] + $e['f1t10'] + $e['f1t19'] + $e['f1t11'] + $e['f1t12'] + $e['f1t13'] + $e['f1t14'] + $e['f2t3'] + $e['f2t3'] + $e['f2t4'] + $e['f2t5'] + $e['f2t6'] + $e['f2t7'] + $e['f2t8'] + $e['f2t9'] + $e['f2t10'] + $e['f2t19'] + $e['f2t11'] + $e['f2t12'] + $e['f2t13'] + $e['f2t14'] + $e['f3t4'] + $e['f3t5'] + $e['f3t6'] + $e['f3t7'] + $e['f3t8'] + $e['f3t9'] + $e['f3t10'] + $e['f3t19'] + $e['f3t11'] + $e['f3t12'] + $e['f3t13'] + $e['f3t14'] + $e['f4t5'] + $e['f4t6'] + $e['f4t7'] + $e['f4t8'] + $e['f4t9'] + $e['f4t10'] + $e['f4t19'] + $e['f4t11'] + $e['f4t12'] + $e['f4t13'] + $e['f4t14'] + $e['f5t6'] + $e['f5t7'] + $e['f5t8'] + $e['f5t9'] + $e['f5t10'] + $e['f5t19'] + $e['f5t11'] + $e['f5t12'] + $e['f5t13'] + $e['f5t14']) : ($unvext + $wdext + $e['wfprc_child'] + $e['f1t3'] + $e['f1t4'] + $e['f1t5'] + $e['f1t6'] + $e['f1t7'] + $e['f1t8'] + $e['f1t9'] + $e['f1t10'] + $e['f1t19'] + $e['f1t11'] + $e['f1t12'] + $e['f1t13'] + $e['f1t14'] + $e['f2t3'] + $e['f2t3'] + $e['f2t4'] + $e['f2t5'] + $e['f2t6'] + $e['f2t7'] + $e['f2t8'] + $e['f2t9'] + $e['f2t10'] + $e['f2t19'] + $e['f2t11'] + $e['f2t12'] + $e['f2t13'] + $e['f2t14'] + $e['f3t4'] + $e['f3t5'] + $e['f3t6'] + $e['f3t7'] + $e['f3t8'] + $e['f3t9'] + $e['f3t10'] + $e['f3t19'] + $e['f3t11'] + $e['f3t12'] + $e['f3t13'] + $e['f3t14'] + $e['f4t5'] + $e['f4t6'] + $e['f4t7'] + $e['f4t8'] + $e['f4t9'] + $e['f4t10'] + $e['f4t19'] + $e['f4t11'] + $e['f4t12'] + $e['f4t13'] + $e['f4t14'] + $e['f5t6'] + $e['f5t7'] + $e['f5t8'] + $e['f5t9'] + $e['f5t10'] + $e['f5t19'] + $e['f5t11'] + $e['f5t12'] + $e['f5t13'] + $e['f5t14']));

                                                                $superpromo_adult = $unvext + $wdext + $e['spprc_adult'] + $e['f1t3'] + $e['f1t4'] + $e['f1t5'] + $e['f1t6'] + $e['f1t7'] + $e['f1t8'] + $e['f1t9'] + $e['f1t10'] + $e['f1t19'] + $e['f1t11'] + $e['f1t12'] + $e['f1t13'] + $e['f1t14'] + $e['f2t3'] + $e['f2t3'] + $e['f2t4'] + $e['f2t5'] + $e['f2t6'] + $e['f2t7'] + $e['f2t8'] + $e['f2t9'] + $e['f2t10'] + $e['f2t19'] + $e['f2t11'] + $e['f2t12'] + $e['f2t13'] + $e['f2t14'] + $e['f3t4'] + $e['f3t5'] + $e['f3t6'] + $e['f3t7'] + $e['f3t8'] + $e['f3t9'] + $e['f3t10'] + $e['f3t19'] + $e['f3t11'] + $e['f3t12'] + $e['f3t13'] + $e['f3t14'] + $e['f4t5'] + $e['f4t6'] + $e['f4t7'] + $e['f4t8'] + $e['f4t9'] + $e['f4t10'] + $e['f4t19'] + $e['f4t11'] + $e['f4t12'] + $e['f4t13'] + $e['f4t14'] + $e['f5t6'] + $e['f5t7'] + $e['f5t8'] + $e['f5t9'] + $e['f5t10'] + $e['f5t19'] + $e['f5t11'] + $e['f5t12'] + $e['f5t13'] + $e['f5t14'];
                                                                $superpromo_child = $unvext + $wdext + $e['spprc_child'] + $e['f1t3'] + $e['f1t4'] + $e['f1t5'] + $e['f1t6'] + $e['f1t7'] + $e['f1t8'] + $e['f1t9'] + $e['f1t10'] + $e['f1t19'] + $e['f1t11'] + $e['f1t12'] + $e['f1t13'] + $e['f1t14'] + $e['f2t3'] + $e['f2t3'] + $e['f2t4'] + $e['f2t5'] + $e['f2t6'] + $e['f2t7'] + $e['f2t8'] + $e['f2t9'] + $e['f2t10'] + $e['f2t19'] + $e['f2t11'] + $e['f2t12'] + $e['f2t13'] + $e['f2t14'] + $e['f3t4'] + $e['f3t5'] + $e['f3t6'] + $e['f3t7'] + $e['f3t8'] + $e['f3t9'] + $e['f3t10'] + $e['f3t19'] + $e['f3t11'] + $e['f3t12'] + $e['f3t13'] + $e['f3t14'] + $e['f4t5'] + $e['f4t6'] + $e['f4t7'] + $e['f4t8'] + $e['f4t9'] + $e['f4t10'] + $e['f4t19'] + $e['f4t11'] + $e['f4t12'] + $e['f4t13'] + $e['f4t14'] + $e['f5t6'] + $e['f5t7'] + $e['f5t8'] + $e['f5t9'] + $e['f5t10'] + $e['f5t19'] + $e['f5t11'] + $e['f5t12'] + $e['f5t13'] + $e['f5t14'];
                                                                
                                                                $superdiscount_adult = $unvext + $wdext + $e['sdprc_adult'] + $e['f1t3'] + $e['f1t4'] + $e['f1t5'] + $e['f1t6'] + $e['f1t7'] + $e['f1t8'] + $e['f1t9'] + $e['f1t10'] + $e['f1t19'] + $e['f1t11'] + $e['f1t12'] + $e['f1t13'] + $e['f1t14'] + $e['f2t3'] + $e['f2t3'] + $e['f2t4'] + $e['f2t5'] + $e['f2t6'] + $e['f2t7'] + $e['f2t8'] + $e['f2t9'] + $e['f2t10'] + $e['f2t19'] + $e['f2t11'] + $e['f2t12'] + $e['f2t13'] + $e['f2t14'] + $e['f3t4'] + $e['f3t5'] + $e['f3t6'] + $e['f3t7'] + $e['f3t8'] + $e['f3t9'] + $e['f3t10'] + $e['f3t19'] + $e['f3t11'] + $e['f3t12'] + $e['f3t13'] + $e['f3t14'] + $e['f4t5'] + $e['f4t6'] + $e['f4t7'] + $e['f4t8'] + $e['f4t9'] + $e['f4t10'] + $e['f4t19'] + $e['f4t11'] + $e['f4t12'] + $e['f4t13'] + $e['f4t14'] + $e['f5t6'] + $e['f5t7'] + $e['f5t8'] + $e['f5t9'] + $e['f5t10'] + $e['f5t19'] + $e['f5t11'] + $e['f5t12'] + $e['f5t13'] + $e['f5t14'];
                                                                $superdiscount_child = $unvext + $wdext + $e['sdprc_child'] + $e['f1t3'] + $e['f1t4'] + $e['f1t5'] + $e['f1t6'] + $e['f1t7'] + $e['f1t8'] + $e['f1t9'] + $e['f1t10'] + $e['f1t19'] + $e['f1t11'] + $e['f1t12'] + $e['f1t13'] + $e['f1t14'] + $e['f2t3'] + $e['f2t3'] + $e['f2t4'] + $e['f2t5'] + $e['f2t6'] + $e['f2t7'] + $e['f2t8'] + $e['f2t9'] + $e['f2t10'] + $e['f2t19'] + $e['f2t11'] + $e['f2t12'] + $e['f2t13'] + $e['f2t14'] + $e['f3t4'] + $e['f3t5'] + $e['f3t6'] + $e['f3t7'] + $e['f3t8'] + $e['f3t9'] + $e['f3t10'] + $e['f3t19'] + $e['f3t11'] + $e['f3t12'] + $e['f3t13'] + $e['f3t14'] + $e['f4t5'] + $e['f4t6'] + $e['f4t7'] + $e['f4t8'] + $e['f4t9'] + $e['f4t10'] + $e['f4t19'] + $e['f4t11'] + $e['f4t12'] + $e['f4t13'] + $e['f4t14'] + $e['f5t6'] + $e['f5t7'] + $e['f5t8'] + $e['f5t9'] + $e['f5t10'] + $e['f5t19'] + $e['f5t11'] + $e['f5t12'] + $e['f5t13'] + $e['f5t14'];

                                                                $superfelx_adult = $unvext + $wdext + $e['sflexprc_adult'] + $e['f1t3'] + $e['f1t4'] + $e['f1t5'] + $e['f1t6'] + $e['f1t7'] + $e['f1t8'] + $e['f1t9'] + $e['f1t10'] + $e['f1t19'] + $e['f1t11'] + $e['f1t12'] + $e['f1t13'] + $e['f1t14'] + $e['f2t3'] + $e['f2t3'] + $e['f2t4'] + $e['f2t5'] + $e['f2t6'] + $e['f2t7'] + $e['f2t8'] + $e['f2t9'] + $e['f2t10'] + $e['f2t19'] + $e['f2t11'] + $e['f2t12'] + $e['f2t13'] + $e['f2t14'] + $e['f3t4'] + $e['f3t5'] + $e['f3t6'] + $e['f3t7'] + $e['f3t8'] + $e['f3t9'] + $e['f3t10'] + $e['f3t19'] + $e['f3t11'] + $e['f3t12'] + $e['f3t13'] + $e['f3t14'] + $e['f4t5'] + $e['f4t6'] + $e['f4t7'] + $e['f4t8'] + $e['f4t9'] + $e['f4t10'] + $e['f4t19'] + $e['f4t11'] + $e['f4t12'] + $e['f4t13'] + $e['f4t14'] + $e['f5t6'] + $e['f5t7'] + $e['f5t8'] + $e['f5t9'] + $e['f5t10'] + $e['f5t19'] + $e['f5t11'] + $e['f5t12'] + $e['f5t13'] + $e['f5t14'];
                                                                $superfelx_child = $unvext + $wdext + $e['sflexprc_child'] + $e['f1t3'] + $e['f1t4'] + $e['f1t5'] + $e['f1t6'] + $e['f1t7'] + $e['f1t8'] + $e['f1t9'] + $e['f1t10'] + $e['f1t19'] + $e['f1t11'] + $e['f1t12'] + $e['f1t13'] + $e['f1t14'] + $e['f2t3'] + $e['f2t3'] + $e['f2t4'] + $e['f2t5'] + $e['f2t6'] + $e['f2t7'] + $e['f2t8'] + $e['f2t9'] + $e['f2t10'] + $e['f2t19'] + $e['f2t11'] + $e['f2t12'] + $e['f2t13'] + $e['f2t14'] + $e['f3t4'] + $e['f3t5'] + $e['f3t6'] + $e['f3t7'] + $e['f3t8'] + $e['f3t9'] + $e['f3t10'] + $e['f3t19'] + $e['f3t11'] + $e['f3t12'] + $e['f3t13'] + $e['f3t14'] + $e['f4t5'] + $e['f4t6'] + $e['f4t7'] + $e['f4t8'] + $e['f4t9'] + $e['f4t10'] + $e['f4t19'] + $e['f4t11'] + $e['f4t12'] + $e['f4t13'] + $e['f4t14'] + $e['f5t6'] + $e['f5t7'] + $e['f5t8'] + $e['f5t9'] + $e['f5t10'] + $e['f5t19'] + $e['f5t11'] + $e['f5t12'] + $e['f5t13'] + $e['f5t14'];
                                                            }
                                    ?>
                                 <div class="flight-booking-item">
                                    <div class="flight-booking-wrapper">
                                       <div class="flight-booking-info">
                                          <div class="flight-booking-content">
                                             <div class="flight-booking-airline">
                                                <h5 class="flight-airline-name">Trip <?php echo $e['trip_no']?></h5>
                                             </div>
                                             <div class="flight-booking-time">
                                                <div class="start-time">
                                                   <div class="start-time-info">
                                                      <h6 class="start-time-text"><?php echo $e['trip_departure']?></h6>
                                                      <span class="flight-destination"><?php echo $this->data['from_name']?></span>
                                                   </div>
                                                </div>
                                                <div class="flight-stop">
                                                   <span class="flight-stop-number">
                                                   <?php
                                                      $hora1 = new DateTime($e['trip_departure']);
                                                      $hora2 = new DateTime($e['trip_arrival']);
                                                      $diferencia = $hora1->diff($hora2);
                                                      echo $diferencia->format('%H:%I');
                                                      ?>
                                                   </span>
                                                   <div class="flight-stop-arrow"></div>
                                                </div>
                                                <div class="end-time">
                                                   <div class="start-time-info">
                                                      <h6 class="end-time-text"><?php echo $e['trip_arrival']?></h6>
                                                      <span class="flight-destination"><?php echo $this->data['to_name']?></span>
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                    </div>   
                                       <div class="flight-booking-detail">
                                          <div class="flight-booking-info">
                                             <div class="flight-booking-content">
                                                <div class="">
                                                   <span class="flight-destination">Web Farer</span>
                                                   <div class="price-info">
                                                      <span class="price-amount">
                                                      <?php
                                                      $na = "<b>N/A</b>";
                                                                    $disponiblewebfarer = $wf_tot;
                                                                    list($dia, $mes, $anio) = explode("-", $booking["fecha_salida"]);
                                                                    $fechaS = $anio . '-' . $mes . '-' . $dia;
                                                                    if($disponiblewebfarer < 0 || $seats <= 0 || ($e['trip_departure'] < date('H:i:s') && $fechaS == date("Y-m-d"))){
                                                                        echo $na;
                                                                        $disabled = 'style="display: none;"';
                                                                    } else {
                                                                        $disabled = "";
                                                                        echo number_format($webfarer_adult + $webfarer_child, 2, '.', ',');
                                                                    }
                                                                    
                                                                    ?>
                                                      </span>
                                                      <input type="radio" class="form-check-input" name="price" id="price" <?php echo $disabled;?> onclick="llenarTablaDinamica<?php echo $e['id']?>(<?php echo $webfarer_adult?>,<?php echo $webfarer_child; ?>)" value="<?php echo $e['id']?>,webfarer">                                                   
                                                    </div>
                                                </div>
                                                <div class="">
                                                   <span class="flight-destination">Super Discount</span>
                                                   <div class="price-info">
                                                      <span class="price-amount">
                                                      <?php
                                                        $disponibles = $sdc_tot;
                                                        $na = "<b>N/A</b>";
                                                        if($disponibles < 0 || $seats <= 0 || ($e['trip_departure'] < $date->format('H:i:s') && $fechaS == date("Y-m-d") )){
                                                            echo $na;
                                                            $disabled = 'style="display: none;"';
                                                        }else{
                                                            $disabled = "";
                                                            echo number_format($superdiscount_adult + $superdiscount_child, 2, '.', '.');
                                                        }
                                                        ?>
                                                      </span>
                                                      <input type="radio" class="form-check-input" name="price" id="price" <?php echo $disabled;?> onclick="llenarTablaDinamica<?php echo $e['id']?>(<?php echo $superdiscount_adult?>,<?php echo $superdiscount_child; ?>)" value="<?php echo $e['id']?>,superdiscount">
                                                   </div>
                                                </div>
                                                <div class="">
                                                   <span class="flight-destination">Super Promo</span>
                                                   <div class="price-info">
                                                      <span class="price-amount">
                                                                <?php
                                                                    $disponiblespromo = $spr_tot;
                                                                    if( $disponiblespromo < 0 || $seats <= 0 || ($e['trip_departure'] < $date->format('H:i:s') && $fechaS == date("Y-m-d") )){
                                                                        echo $na;
                                                                        $disabled = 'style="display: none;"';
                                                                    }else{
                                                                        $disabled = "";
                                                                        echo number_format($superpromo_adult + $superpromo_child, 2, '.', '.');
                                                                    }
                                                                ?>
                                                      </span>
                                                      <input type="radio" class="form-check-input" name="price"  <?php echo $disabled;?> id="price<?php echo $e['id']?>" onclick="llenarTablaDinamica<?php echo $e['id']?>(<?php echo $superpromo_adult?>,<?php echo $superpromo_child; ?>)" value="<?php echo $e['id']?>,superpromo">                                                   
                                                    </div>
                                                </div>
                                                <div class="">
                                                   <span class="flight-destination">Super Flex</span>
                                                   <div class="price-info">
                                                      <span class="price-amount">
                                                            <?php
                                                                    if( $sflx_tot < 0 || $seats <= 0 || ($e['trip_departure'] < $date->format('H:i:s') && $fechaS == date("Y-m-d") )){
                                                                        echo $na;
                                                                        $disabled = 'style="display: none;"';
                                                                    }else{
                                                                        $disabled = '';
                                                                        echo number_format($superfelx_adult + $superfelx_child, 2, '.', ',');
                                                                    }
                                                            ?>
                                                      </span>
                                                      <input type="radio" class="form-check-input" name="price" <?php echo $disabled;?> id="price" onclick="llenarTablaDinamica<?php echo $e['id']?>(<?php echo $superfelx_adult?>,<?php echo $superfelx_child; ?>)" value="<?php echo $e['id']?>,superfelx">                                                  
                                                     </div>
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                    
                                    <div class="flight-booking-detail">
                                       <div class="flight-booking-detail-header">
                                          <a href="#flight-booking-collapse<?php echo $e['id']?>" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="flight-booking-collapse1">Trip
                                          Details <i class="far fa-angle-down"></i></a>
                                       </div>
                                       <div class="collapse" id="flight-booking-collapse<?php echo $e['id']?>">
                                          <div class="flight-booking-detail-wrapper">
                                             <div class="row">
                                                <div class="col-lg-12 col-xl-12">
                                                   <div class="flight-booking-detail-right">
                                                      <ul class="nav nav-tabs" id="frTab" role="tablist">
                                                         <li class="nav-item" role="presentation">
                                                            <button class="nav-link active" id="fr-tab<?php echo $e['id']?>" data-bs-toggle="tab" data-bs-target="#fr-tab-pane<?php echo $e['id']?>" type="button" role="tab" aria-controls="fr-tab-pane<?php echo $e['id']?>" aria-selected="true">Fare</button>
                                                         </li>
                                                         <li class="nav-item" role="presentation">
                                                            <button class="nav-link" id="fr-tab<?php echo $e['id']?>" data-bs-toggle="tab" data-bs-target="#fr-tab-pane1<?php echo $e['id']?>" type="button" role="tab" aria-controls="fr-tab-pane<?php echo $e['id']?>" aria-selected="false">Policy</button>
                                                         </li>
                                                      </ul>
                                                      <div class="tab-content" id="frTabContent<?php echo $e['id']?>">
                                                         <div class="tab-pane fade show active" id="fr-tab-pane<?php echo $e['id']?>" role="tabpanel" aria-labelledby="fr-tab<?php echo $e['id']?>" tabindex="0">
                                                            <div class="flight-booking-detail-info">
                                                                
                                                               <table class="table table-borderless" id="tablaPreciosTarifa<?php echo $e['id']?>">
                                                                  <tr>
                                                                     <th>Fare Summary</th>
                                                                     <th>Fare</th>
                                                                     <th>Total</th>
                                                                  </tr>
                                                                  <tr>
                                                                     <td>Adult x <?php echo $booking['pax']?> </td>
                                                                     <td colspan="3">
                                                                           please select a rate
                                                                     </td>
                                                                  </tr>
                                                                  <tr>
                                                                     <td>Child x <?php echo $booking['chil']?> </td>
                                                                     <td colspan="3">
                                                                           please select a rate
                                                                     </td>
                                                                  </tr>
                                                               </table>
                                                               <script>
                                                               function llenarTablaDinamica<?php echo $e['id']?>(adult,child){
                                                                  var url = "<?php echo $data['rootUrl'] ?>cargarTablaDinamica/"+adult+"/"+child;
                                                                  $("#tablaPreciosTarifa<?php echo $e['id']?>").load(encodeURI(url));
                                                                  var priceUrl = "<?php echo $data['rootUrl'] ?>cargarPrecioDinamico/"+adult+"/"+child;
                                                                  $("#precioTotal<?php echo $e['id']?>").load(encodeURI(priceUrl));
                                                               }
                                                              </script>
                                                            </div>
                                                         </div>
                                                         <div class="tab-pane fade" id="fr-tab-pane1<?php echo $e['id']?>" role="tabpanel" aria-labelledby="fr-tab<?php echo $e['id']?>" tabindex="0">
                                                            <div class="flight-booking-detail-info">
                                                               <div class="flight-booking-policy">
                                                                  <ul>
                                                                     <li>
                                                                        1. The ticket is valid only for the date and time printed on the e-ticket.
                                                                     </li>
                                                                     <li>
                                                                        2. Passengers have to bring a valid ID and a printout of the e-Tickets (confirmation email) at boarding for ID Check.
                                                                     </li>
                                                                     <li>
                                                                        3. Ticket Holder name (s) on e-ticket must match the passenger's name.
                                                                     </li>
                                                                     <li>
                                                                        4. Passenger must arrive 30 minutes prior departure time, otherwise the seat might be sold to others.
                                                                     </li>
                                                                  </ul>
                                                               </div>
                                                            </div>
                                                         </div>
                                                      </div>
                                                      <div class="flight-booking-detail-price">
                                                         <h6 class="flight-booking-detail-price-title">Total (2 Traveler)</h6>
                                                         <div class="flight-detail-price-amount">
                                                            $ <span id="precioTotal<?php echo $e['id']?>">00.00</span>
                                                         </div>
                                                      </div>
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                                 <?php
                                    }
                                    }
                                    ?> 
                           </div>
                        </div>
                     </div>
                     <?php if($_SESSION['booking']['tipo_ticket'] == 'roundtrip'){?>
                     <div class="col-lg-6 col-xl-6">
                        <div class="col-md-12">
                           <div class="booking-sort">
                              <h5>Trip from <b><i><?php echo $this->data['to_name']?></i></b> to <b><i><?php echo $this->data['from_name']?></i></b></h5>
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-lg-12">
                              <div class="col-lg-12">
                                 <?php  
                                     foreach ($data['retorno'] as $e):
                                                        
                                        if ($idfrom == 24 or $idto == 24) {
                                            $wdext = $e['wdext'];
                                        } elseif ($idfrom == 22 or $idto == 22) {
                                            $wdext = $e['wdext'];
                                        } elseif ($idfrom == 23 or $idto == 23) {
                                            $unvext = $e['univext'];
                                        } elseif ($idfrom == 21 or $idto == 21) {
                                            $unvext = $e['univext'];
                                        } else {
                                            $wdext = 0;
                                            $unvext = 0;
                                        }
                                        $estado = $e['seats_remain'];
                                        //echo $e['univext'];
//                                                        $idfrom = $data['idto'];
//                                                        $idto = $data['idfrom'];
                                        
                                        $idfrom_r = $booking['tot'];
                                        $idto_r = $booking['fromt'];
                                        $trip2 = $e['trip_no'];
                                        $trip_no = $e['trip_no'];
                                        $fecha_trip = $e['fecha_ini'];
                                                                                              
                                        
                                        
                                        $sqlpckt_r = "SELECT place, address, instructions FROM pickup_dropoff WHERE id_area ='$idfrom_r' AND tripw$trip2 ='1' AND active_web ='1'";

                                        $rspckt_r = Doo::db()->query($sqlpckt_r);
                                        $dploct_r = $rspckt_r->fetchAll();

                                        foreach ($dploct_r as $dplt_r){
                                            $placet_r = $dplt_r['place'];
                                            $addrt_r = $dplt_r['address'];
                                            $instt_r = $dplt_r['instructions'];
                                        }
                                        
                                        $sqlpckf_r = "SELECT place, address, instructions FROM pickup_dropoff WHERE id_area ='$idto_r' AND tripw$trip2 ='1' AND active_web ='1'";

                                        $rspckf_r = Doo::db()->query($sqlpckf_r);
                                        $dplocf_r = $rspckf_r->fetchAll();

                                        foreach ($dplocf_r as $dplf_r){
                                            $placef_r = $dplf_r['place'];
                                            $addrf_r = $dplf_r['address'];
                                            $instf_r = $dplf_r['instructions'];
                                        }                           
                                        
                                        
                                        $sql = "SELECT
                                        SUM(cantidad) AS cantwebf,
                                            (SELECT SUM(cantidad) FROM reservas_trip_puestos
                                        WHERE fecha_trip = ?
                                        AND trip_to = ?
                                        AND (tipo = '1' OR tipo = '2')
                                        AND ( estado = 'USING' OR estado = 'RENEWED' ) AND tarifa = '4'
                                        ) as cantsuperp,
                                        (SELECT SUM(cantidad) FROM reservas_trip_puestos
                                        WHERE fecha_trip = ?
                                        AND trip_to = ?
                                        AND (tipo = '1' OR tipo = '2')
                                        AND ( estado = 'USING' OR estado = 'RENEWED' ) AND tarifa = '5'
                                        ) as cantsuperdisc,
                                        (SELECT SUM(cantidad) FROM reservas_trip_puestos
                                        WHERE fecha_trip = ?
                                        AND trip_to = ?
                                        AND (tipo = '1' OR tipo = '2')
                                        AND ( estado = 'USING' OR estado = 'RENEWED' ) AND tarifa = '2'
                                        ) as cantsuperflex,
                                        (SELECT SUM(cantidad) FROM reservas_trip_puestos
                                        WHERE fecha_trip = ?
                                        AND trip_to = ?
                                        AND (tipo = '1' OR tipo = '2')
                                        AND ( estado = 'USING' OR estado = 'RENEWED' ) AND tarifa = '1'
                                        ) as cantstandar
                                        FROM reservas_trip_puestos WHERE fecha_trip = ?
                                        AND trip_to = ?
                                        AND (tipo = '1' OR tipo = '2')
                                        AND ( estado = 'USING' OR estado = 'RENEWED' ) AND tarifa = '3' ";
                                        $rs = Doo::db()->query($sql, array($fecha_trip,$trip_no,$fecha_trip,$trip_no,$fecha_trip,$trip_no,$fecha_trip,$trip_no,$fecha_trip,$trip_no));
                                        $puestos = $rs->fetchAll(PDO::FETCH_ASSOC);
                                        // $p_ocupadoswf = $puestos[0]['CANTIDAD'];

                                        $cantidadwebfreturn = $puestos[0]['cantwebf'] ? $puestos[0]['cantwebf'] : 0;
                                        $cantidadsuperproreturn = $puestos[0]['cantsuperp'] ? $puestos[0]['cantsuperp'] : 0;
                                        $cantidadsuperdiscreturn = $puestos[0]['cantsuperdisc'] ? $puestos[0]['cantsuperdisc'] : 0;
                                        $cantidadsuperflexreturn = $puestos[0]['cantsuperflex'] ? $puestos[0]['cantsuperflex'] : 0;
                                        $cantidadsstandarreturn = $puestos[0]['cantstandar'] ? $puestos[0]['cantstandar'] : 0;

                                        // print_r($cantidadsuperdisc);
                                        $sql2 = "SELECT DISTINCT spseats,sdseats,wfseats,sflexseats,stseats,spprcseats,toursseats,vehicles,capacity,capacity2,capacity3,capacity4,capacity5,seats_remain FROM routes WHERE fecha_ini = ? AND trip_no = ?";
                                        $rs2 = Doo::db()->query($sql2, array($fecha_trip,$trip_no));
                                        $routesreturn = $rs2->fetchAll(PDO::FETCH_ASSOC);
                                        // $seats2 = $routesreturn[0]['seats_remain'];

                                        $capacidad100_1return = $routesreturn[0]['capacity'];
                                        $capacidad100_2return = $routesreturn[0]['capacity2'];
                                        $capacidad100_3return = $routesreturn[0]['capacity3'];
                                        $capacidad100_4return = $routesreturn[0]['capacity4'];
                                        $capacidad100_5return = $routesreturn[0]['capacity5'];
                                        $seatstot2 =$capacidad100_1return + $capacidad100_2return + $capacidad100_3return + $capacidad100_4return +$capacidad100_5return;
                                        $webfare_100return = $routesreturn[0]['wfseats'];
                                        $superpromo_100return = $routesreturn[0]['spseats'];
                                        $superdiscount_100return = $routesreturn[0]['sdseats'];
                                        $superflex_100return = $routesreturn[0]['sflexseats'];
                                        $standard_100return = $routesreturn[0]['sflexseats'];
                                        $sppr_100return = $routesreturn[0]['spprcseats'];
                                        $tour_100return = $routesreturn[0]['toursseats'];

                                        // echo '<pre>';
                                        // print_r($seatstot2);
                                        // echo '</pre>';

                                        $sql_spcida100 = "SELECT
                                        (sum(pax) + sum(pax2)) AS superpromo,
                                        (SELECT (sum(pax) + sum(pax2)) FROM reservas WHERE trip_no = ? AND fecha_salida = ?
                                        AND estado != 'QUOTE'
                                        AND estado != 'CANCELED'
                                        AND estado != 'NOT SHOW W/ CHARGE'
                                        AND estado != 'NOT SHOW W/O CHARGE'
                                        AND estado != 'NO SHOW'
                                        AND id1 = '5') as superdiscount,
                                        (SELECT (sum(pax) + sum(pax2)) FROM reservas WHERE trip_no = ? AND fecha_salida = ?
                                        AND estado != 'QUOTE'
                                        AND estado != 'CANCELED'
                                        AND estado != 'NOT SHOW W/ CHARGE'
                                        AND estado != 'NOT SHOW W/O CHARGE'
                                        AND estado != 'NO SHOW'
                                        AND id1 = '3') as webfare,
                                        (SELECT (sum(pax) + sum(pax2)) FROM reservas WHERE trip_no = ? AND fecha_salida = ?
                                        AND estado != 'QUOTE'
                                        AND estado != 'CANCELED'
                                        AND estado != 'NOT SHOW W/ CHARGE'
                                        AND estado != 'NOT SHOW W/O CHARGE'
                                        AND estado != 'NO SHOW'
                                        AND id1 = '1') as standard,
                                        (SELECT (sum(pax) + sum(pax2)) FROM reservas  WHERE trip_no = ? AND fecha_salida = ?
                                        AND estado != 'QUOTE'
                                        AND estado != 'CANCELED'
                                        AND estado != 'NOT SHOW W/ CHARGE'
                                        AND estado != 'NOT SHOW W/O CHARGE'
                                        AND estado != 'NO SHOW'
                                        AND id1 = '2') as superflex,
                                        (SELECT (sum(pax) + sum(pax2)) FROM  reservas Where trip_no = ? AND fecha_salida = ?
                                        AND (type_tour = 'ONE'
                                        OR type_tour = 'MULTI')
                                        AND estado != 'QUOTE'
                                        AND estado != 'CANCELED'
                                        AND estado != 'NOT SHOW W/ CHARGE'
                                        AND estado != 'NOT SHOW W/O CHARGE') AS tours,
                                        (SELECT (sum(pax) + sum(pax2)) FROM  reservas Where trip_no = ?  AND fecha_salida = ?
                                        AND id1 = '6'
                                        AND estado != 'QUOTE'
                                        AND estado != 'CANCELED'
                                        AND estado != 'NOT SHOW W/ CHARGE'
                                        AND estado != 'NOT SHOW W/O CHARGE') AS especial

                                        FROM reservas  WHERE trip_no = ? AND fecha_salida = ?
                                        AND estado != 'QUOTE'
                                        AND estado != 'CANCELED'
                                        AND estado != 'NOT SHOW W/ CHARGE'
                                        AND estado != 'NOT SHOW W/O CHARGE'
                                        AND estado != 'NO SHOW'
                                        AND id1 = '4' ";
                                        $trips100return = Doo::db()->query($sql_spcida100, array($trip_no,$fecha_trip,$trip_no,$fecha_trip,$trip_no,$fecha_trip,$trip_no,$fecha_trip,$trip_no,$fecha_trip,$trip_no,$fecha_trip,$trip_no,$fecha_trip));
                                        $r_spcida100return = $trips100return->fetchAll();
                                        // $seats_ida100 = $r_spcida100[0]['superdiscount'];
                                        $spro_ida100return = $r_spcida100return[0]['superpromo'] ? $r_spcida100return[0]['superpromo'] : 0;
                                        $sdic_ida100return = $r_spcida100return[0]['superdiscount'] ? $r_spcida100return[0]['superdiscount'] : 0;
                                        $wfare_ida100return = $r_spcida100return[0]['webfare'] ? $r_spcida100return[0]['webfare'] : 0;
                                        $standr_ida100return = $r_spcida100return[0]['standard'] ? $r_spcida100return[0]['standard'] : 0;
                                        $sflex_ida100return = $r_spcida100return[0]['superflex'] ? $r_spcida100return[0]['superflex'] : 0;
                                        $special_ida100return = $r_spcida100return[0]['especial'] ? $r_spcida100return[0]['especial'] : 0;
                                        $tour_ida100return = $r_spcida100return[0]['tours'] ? $r_spcida100return[0]['tours'] : 0;

                                        $sql_spcretorno100 = "SELECT (sum(pax) + sum(pax2)) AS superpromo,
                                        (SELECT (sum(pax) + sum(pax2)) FROM  reservas WHERE trip_no2 = ? AND fecha_retorno = ?
                                        AND estado != 'QUOTE'
                                        AND estado != 'CANCELED'
                                        AND estado != 'NOT SHOW W/ CHARGE'
                                        AND estado != 'NOT SHOW W/O CHARGE'
                                        AND estado != 'NO SHOW'
                                        AND id2 = '5') as superdiscount,
                                        (SELECT (sum(pax_r) + sum(pax2_r)) FROM reservas WHERE trip_no2 = ? AND fecha_retorno = ?
                                        AND estado != 'QUOTE'
                                        AND estado != 'CANCELED'
                                        AND estado != 'NOT SHOW W/ CHARGE'
                                        AND estado != 'NOT SHOW W/O CHARGE'
                                        AND estado != 'NO SHOW'
                                        AND id2 = '3') as webfare,
                                        (SELECT (sum(pax_r) + sum(pax2_r)) FROM reservas WHERE trip_no2 = ? AND fecha_retorno = ?
                                        AND estado != 'QUOTE'
                                        AND estado != 'CANCELED'
                                        AND estado != 'NOT SHOW W/ CHARGE'
                                        AND estado != 'NOT SHOW W/O CHARGE'
                                        AND estado != 'NO SHOW'
                                        AND id2 = '1') as standard,
                                        (SELECT (sum(pax_r) + sum(pax2_r)) FROM reservas WHERE trip_no2 = ? AND fecha_retorno = ?
                                        AND estado != 'QUOTE'
                                        AND estado != 'CANCELED'
                                        AND estado != 'NOT SHOW W/ CHARGE'
                                        AND estado != 'NOT SHOW W/O CHARGE'
                                        AND estado != 'NO SHOW'
                                        AND id2 = '2') as superflex,
                                        (SELECT (sum(pax_r) + sum(pax2_r)) FROM  reservas  Where trip_no2 = ? AND fecha_retorno = ?
                                        AND (type_tour = 'ONE'
                                        OR type_tour = 'MULTI')
                                        AND estado != 'QUOTE'
                                        AND estado != 'CANCELED'
                                        AND estado != 'NOT SHOW W/ CHARGE'
                                        AND estado != 'NOT SHOW W/O CHARGE') AS tours,
                                        (SELECT (sum(pax_r) + sum(pax2_r)) FROM  reservas Where trip_no2 = ? AND fecha_retorno = ?
                                        AND id2 = '6'
                                        AND estado != 'QUOTE'
                                        AND estado != 'CANCELED'
                                        AND estado != 'NOT SHOW W/ CHARGE'
                                        AND estado != 'NOT SHOW W/O CHARGE') AS especial
                                        FROM reservas WHERE trip_no2 = ? AND fecha_retorno = ?
                                        AND estado != 'QUOTE'
                                        AND estado != 'CANCELED'
                                        AND estado != 'NOT SHOW W/ CHARGE'
                                        AND estado != 'NOT SHOW W/O CHARGE'
                                        AND estado != 'NO SHOW'
                                        AND id2 = '4'";
                                        // $rs_spcretorno100 = Doo::db()->query($sql_spcretorno100, array($trip100, $fecha));
                                        $rs_spcretorno100return = Doo::db()->query($sql_spcretorno100, array($trip_no,$fecha_trip,$trip_no,$fecha_trip,$trip_no,$fecha_trip,$trip_no,$fecha_trip,$trip_no,$fecha_trip,$trip_no,$fecha_trip,$trip_no,$fecha_trip));
                                        $r_spcretorno100return = $rs_spcretorno100return->fetchAll();

                                        $spro_retorno100return = $r_spcretorno100return[0]['superpromo'] ? $r_spcretorno100return[0]['superpromo'] : 0;
                                        $sdic_retorno100return = $r_spcretorno100return[0]['superdiscount'] ? $r_spcretorno100return[0]['superdiscount'] : 0;
                                        $wfare_retorno100return = $r_spcretorno100return[0]['webfare'] ? $r_spcretorno100return[0]['webfare'] : 0;
                                        $standr_retorno100return = $r_spcretorno100return[0]['standard'] ? $r_spcretorno100return[0]['standard'] : 0;
                                        $sflex_retorno100return = $r_spcretorno100return[0]['superflex'] ? $r_spcretorno100return[0]['superflex'] : 0;
                                        $special_retorno100return = $r_spcretorno100return[0]['especial'] ? $r_spcretorno100return[0]['especial'] : 0;
                                        $tour_retorno100return = $r_spcretorno100return[0]['tours'] ? $r_spcretorno100return[0]['tours'] : 0;


                                        $total_spro100return = $spro_ida100return + $spro_retorno100return ;
                                        $total_sdic100return = $sdic_ida100return + $sdic_retorno100return ;
                                        $total_wfare100return = $wfare_ida100return + $wfare_retorno100return ;
                                        $total_standr100return = $standr_ida100return + $standr_retorno100return ;
                                        $total_sflex100return = $sflex_ida100return + $sflex_retorno100return ;
                                        $total_especial100return = $special_ida100return + $special_retorno100return ;
                                        $total_tours100return = $tour_ida100return + $tour_retorno100return ;

                                        $ReservasTotalesreturn = $total_spro100return + $total_sdic100return + $total_wfare100return  + $total_standr100return + $total_sflex100return + $total_especial100return + $total_tours100return;
                                        $resultsuperflexreturn = $total_sflex100return - $superflex_100return;

                                        $OcupadosTotalesreturn =  $ReservasTotalesreturn;
                                        $seats2 = $seatstot2 - $ReservasTotalesreturn;
                                        // $cantidadwebfreturn = $puestos[0]['cantwebf'] ? $puestos[0]['cantwebf'] : 0;
                                        // $cantidadsuperproreturn = $puestos[0]['cantsuperp'] ? $puestos[0]['cantsuperp'] : 0;
                                        // $cantidadsuperdiscreturn = $puestos[0]['cantsuperdisc'] ? $puestos[0]['cantsuperdisc'] : 0;
                                        // $cantidadsuperflexreturn = $puestos[0]['cantsuperflex'] ? $puestos[0]['cantsuperflex'] : 0;


                                            $numperson100return = $_SESSION['booking']['pax'] + $_SESSION['booking']['chil'];

                                            $wf_totreturn = ($webfare_100return - $total_wfare100return)-$total_standr100return-$total_especial100return-$total_tours100return-$total_spro100return-$total_sdic100return-$numperson100return-$cantidadwebfreturn-$cantidadsuperproreturn-$cantidadsuperdiscreturn -  $cantidadsstandarreturn;

                                            $sflx_totreturn = ($superflex_100return - $total_sflex100return)-$numperson100return-$cantidadsuperflexreturn;

                                            $spr_totreturn = ($superpromo_100return - $total_spro100return)-$numperson100return-$cantidadsuperproreturn;

                                            $sdc_totreturn = ($superdiscount_100return - $total_sdic100return)-$numperson100return-$cantidadsuperdiscreturn;

                                            if($wf_totreturn < $spr_totreturn){
                                                $spr_totreturn = $wf_totreturn;
                                                }else{
                                                $spr_totreturn = $spr_totreturn;
                                                }

                                                if($wf_totreturn < $sdc_totreturn){
                                                $sdc_totreturn = $wf_totreturn;
                                                }else{
                                                $sdc_totreturn = $sdc_totreturn;
                                                }


                                            //   echo '<pre>';
                                            //   print_r($seats2);
                                            //   echo '</pre>';

                                        if($booking["resident"] == 1){
                                            $superpromo_adultR = $unvext + $wdext + $e['spprc_adult'] + $e['f1t3'] + $e['f1t4'] + $e['f1t5'] + $e['f1t6'] + $e['f1t7'] + $e['f1t8'] + $e['f1t9'] + $e['f1t10'] + $e['f1t19'] + $e['f1t11'] + $e['f1t12'] + $e['f1t13'] + $e['f1t14'] + $e['f2t3'] + $e['f2t3'] + $e['f2t4'] + $e['f2t5'] + $e['f2t6'] + $e['f2t7'] + $e['f2t8'] + $e['f2t9'] + $e['f2t10'] + $e['f2t19'] + $e['f2t11'] + $e['f2t12'] + $e['f2t13'] + $e['f2t14'] + $e['f3t4'] + $e['f3t5'] + $e['f3t6'] + $e['f3t7'] + $e['f3t8'] + $e['f3t9'] + $e['f3t10'] + $e['f3t19'] + $e['f3t11'] + $e['f3t12'] + $e['f3t13'] + $e['f3t14'] + $e['f4t5'] + $e['f4t6'] + $e['f4t7'] + $e['f4t8'] + $e['f4t9'] + $e['f4t10'] + $e['f4t19'] + $e['f4t11'] + $e['f4t12'] + $e['f4t13'] + $e['f4t14'] + $e['f5t6'] + $e['f5t7'] + $e['f5t8'] + $e['f5t9'] + $e['f5t10'] + $e['f5t19'] + $e['f5t11'] + $e['f5t12'] + $e['f5t13'] + $e['f5t14'];
                                            $superpromo_childR = $unvext + $wdext + $e['spprc_child'] + $e['f1t3'] + $e['f1t4'] + $e['f1t5'] + $e['f1t6'] + $e['f1t7'] + $e['f1t8'] + $e['f1t9'] + $e['f1t10'] + $e['f1t19'] + $e['f1t11'] + $e['f1t12'] + $e['f1t13'] + $e['f1t14'] + $e['f2t3'] + $e['f2t3'] + $e['f2t4'] + $e['f2t5'] + $e['f2t6'] + $e['f2t7'] + $e['f2t8'] + $e['f2t9'] + $e['f2t10'] + $e['f2t19'] + $e['f2t11'] + $e['f2t12'] + $e['f2t13'] + $e['f2t14'] + $e['f3t4'] + $e['f3t5'] + $e['f3t6'] + $e['f3t7'] + $e['f3t8'] + $e['f3t9'] + $e['f3t10'] + $e['f3t19'] + $e['f3t11'] + $e['f3t12'] + $e['f3t13'] + $e['f3t14'] + $e['f4t5'] + $e['f4t6'] + $e['f4t7'] + $e['f4t8'] + $e['f4t9'] + $e['f4t10'] + $e['f4t19'] + $e['f4t11'] + $e['f4t12'] + $e['f4t13'] + $e['f4t14'] + $e['f5t6'] + $e['f5t7'] + $e['f5t8'] + $e['f5t9'] + $e['f5t10'] + $e['f5t19'] + $e['f5t11'] + $e['f5t12'] + $e['f5t13'] + $e['f5t14'];
                                            //descuento
                                            //echo $e['flresprc_adult'];
                                            $webfarer_adultR = ($unvext + $wdext +  $e['wfprc_adult'] + $e['flresprc_adult'] + $e['f1t3'] + $e['f1t4'] + $e['f1t5'] + $e['f1t6'] + $e['f1t7'] + $e['f1t8'] + $e['f1t9'] + $e['f1t10'] + $e['f1t19'] + $e['f1t11'] + $e['f1t12'] + $e['f1t13'] + $e['f1t14'] + $e['f2t3'] + $e['f2t3'] + $e['f2t4'] + $e['f2t5'] + $e['f2t6'] + $e['f2t7'] + $e['f2t8'] + $e['f2t9'] + $e['f2t10'] + $e['f2t19'] + $e['f2t11'] + $e['f2t12'] + $e['f2t13'] + $e['f2t14'] + $e['f3t4'] + $e['f3t5'] + $e['f3t6'] + $e['f3t7'] + $e['f3t8'] + $e['f3t9'] + $e['f3t10'] + $e['f3t19'] + $e['f3t11'] + $e['f3t12'] + $e['f3t13'] + $e['f3t14'] + $e['f4t5'] + $e['f4t6'] + $e['f4t7'] + $e['f4t8'] + $e['f4t9'] + $e['f4t10'] + $e['f4t19'] + $e['f4t11'] + $e['f4t12'] + $e['f4t13'] + $e['f4t14'] + $e['f5t6'] + $e['f5t7'] + $e['f5t8'] + $e['f5t9'] + $e['f5t10'] + $e['f5t19'] + $e['f5t11'] + $e['f5t12'] + $e['f5t13'] + $e['f5t14']);
                                            $webfarer_childR = ($unvext + $wdext +  $e['wfprc_child'] + $e['flresprc_child'] + $e['f1t3'] + $e['f1t4'] + $e['f1t5'] + $e['f1t6'] + $e['f1t7'] + $e['f1t8'] + $e['f1t9'] + $e['f1t10'] + $e['f1t19'] + $e['f1t11'] + $e['f1t12'] + $e['f1t13'] + $e['f1t14'] + $e['f2t3'] + $e['f2t3'] + $e['f2t4'] + $e['f2t5'] + $e['f2t6'] + $e['f2t7'] + $e['f2t8'] + $e['f2t9'] + $e['f2t10'] + $e['f2t19'] + $e['f2t11'] + $e['f2t12'] + $e['f2t13'] + $e['f2t14'] + $e['f3t4'] + $e['f3t5'] + $e['f3t6'] + $e['f3t7'] + $e['f3t8'] + $e['f3t9'] + $e['f3t10'] + $e['f3t19'] + $e['f3t11'] + $e['f3t12'] + $e['f3t13'] + $e['f3t14'] + $e['f4t5'] + $e['f4t6'] + $e['f4t7'] + $e['f4t8'] + $e['f4t9'] + $e['f4t10'] + $e['f4t19'] + $e['f4t11'] + $e['f4t12'] + $e['f4t13'] + $e['f4t14'] + $e['f5t6'] + $e['f5t7'] + $e['f5t8'] + $e['f5t9'] + $e['f5t10'] + $e['f5t19'] + $e['f5t11'] + $e['f5t12'] + $e['f5t13'] + $e['f5t14']);
                                            $superdiscount_adultR = $unvext + $wdext + $e['sdprc_adult'] + $e['f1t3'] + $e['f1t4'] + $e['f1t5'] + $e['f1t6'] + $e['f1t7'] + $e['f1t8'] + $e['f1t9'] + $e['f1t10'] + $e['f1t19'] + $e['f1t11'] + $e['f1t12'] + $e['f1t13'] + $e['f1t14'] + $e['f2t3'] + $e['f2t3'] + $e['f2t4'] + $e['f2t5'] + $e['f2t6'] + $e['f2t7'] + $e['f2t8'] + $e['f2t9'] + $e['f2t10'] + $e['f2t19'] + $e['f2t11'] + $e['f2t12'] + $e['f2t13'] + $e['f2t14'] + $e['f3t4'] + $e['f3t5'] + $e['f3t6'] + $e['f3t7'] + $e['f3t8'] + $e['f3t9'] + $e['f3t10'] + $e['f3t19'] + $e['f3t11'] + $e['f3t12'] + $e['f3t13'] + $e['f3t14'] + $e['f4t5'] + $e['f4t6'] + $e['f4t7'] + $e['f4t8'] + $e['f4t9'] + $e['f4t10'] + $e['f4t19'] + $e['f4t11'] + $e['f4t12'] + $e['f4t13'] + $e['f4t14'] + $e['f5t6'] + $e['f5t7'] + $e['f5t8'] + $e['f5t9'] + $e['f5t10'] + $e['f5t19'] + $e['f5t11'] + $e['f5t12'] + $e['f5t13'] + $e['f5t14'];
                                            $superdiscount_childR = $unvext + $wdext + $e['sdprc_child'] + $e['f1t3'] + $e['f1t4'] + $e['f1t5'] + $e['f1t6'] + $e['f1t7'] + $e['f1t8'] + $e['f1t9'] + $e['f1t10'] + $e['f1t19'] + $e['f1t11'] + $e['f1t12'] + $e['f1t13'] + $e['f1t14'] + $e['f2t3'] + $e['f2t3'] + $e['f2t4'] + $e['f2t5'] + $e['f2t6'] + $e['f2t7'] + $e['f2t8'] + $e['f2t9'] + $e['f2t10'] + $e['f2t19'] + $e['f2t11'] + $e['f2t12'] + $e['f2t13'] + $e['f2t14'] + $e['f3t4'] + $e['f3t5'] + $e['f3t6'] + $e['f3t7'] + $e['f3t8'] + $e['f3t9'] + $e['f3t10'] + $e['f3t19'] + $e['f3t11'] + $e['f3t12'] + $e['f3t13'] + $e['f3t14'] + $e['f4t5'] + $e['f4t6'] + $e['f4t7'] + $e['f4t8'] + $e['f4t9'] + $e['f4t10'] + $e['f4t19'] + $e['f4t11'] + $e['f4t12'] + $e['f4t13'] + $e['f4t14'] + $e['f5t6'] + $e['f5t7'] + $e['f5t8'] + $e['f5t9'] + $e['f5t10'] + $e['f5t19'] + $e['f5t11'] + $e['f5t12'] + $e['f5t13'] + $e['f5t14'];

                                            $superfelx_adultR = ($unvext + $wdext + $e['sflexprc_adult'] + $e['flresprc_adult'] + $e['f1t3'] + $e['f1t4'] + $e['f1t5'] + $e['f1t6'] + $e['f1t7'] + $e['f1t8'] + $e['f1t9'] + $e['f1t10'] + $e['f1t19'] + $e['f1t11'] + $e['f1t12'] + $e['f1t13'] + $e['f1t14'] + $e['f2t3'] + $e['f2t3'] + $e['f2t4'] + $e['f2t5'] + $e['f2t6'] + $e['f2t7'] + $e['f2t8'] + $e['f2t9'] + $e['f2t10'] + $e['f2t19'] + $e['f2t11'] + $e['f2t12'] + $e['f2t13'] + $e['f2t14'] + $e['f3t4'] + $e['f3t5'] + $e['f3t6'] + $e['f3t7'] + $e['f3t8'] + $e['f3t9'] + $e['f3t10'] + $e['f3t19'] + $e['f3t11'] + $e['f3t12'] + $e['f3t13'] + $e['f3t14'] + $e['f4t5'] + $e['f4t6'] + $e['f4t7'] + $e['f4t8'] + $e['f4t9'] + $e['f4t10'] + $e['f4t19'] + $e['f4t11'] + $e['f4t12'] + $e['f4t13'] + $e['f4t14'] + $e['f5t6'] + $e['f5t7'] + $e['f5t8'] + $e['f5t9'] + $e['f5t10'] + $e['f5t19'] + $e['f5t11'] + $e['f5t12'] + $e['f5t13'] + $e['f5t14']);
                                            $superfelx_childR = ($unvext + $wdext + $e['sflexprc_child'] + $e['flresprc_child'] + $e['f1t3'] + $e['f1t4'] + $e['f1t5'] + $e['f1t6'] + $e['f1t7'] + $e['f1t8'] + $e['f1t9'] + $e['f1t10'] + $e['f1t19'] + $e['f1t11'] + $e['f1t12'] + $e['f1t13'] + $e['f1t14'] + $e['f2t3'] + $e['f2t3'] + $e['f2t4'] + $e['f2t5'] + $e['f2t6'] + $e['f2t7'] + $e['f2t8'] + $e['f2t9'] + $e['f2t10'] + $e['f2t19'] + $e['f2t11'] + $e['f2t12'] + $e['f2t13'] + $e['f2t14'] + $e['f3t4'] + $e['f3t5'] + $e['f3t6'] + $e['f3t7'] + $e['f3t8'] + $e['f3t9'] + $e['f3t10'] + $e['f3t19'] + $e['f3t11'] + $e['f3t12'] + $e['f3t13'] + $e['f3t14'] + $e['f4t5'] + $e['f4t6'] + $e['f4t7'] + $e['f4t8'] + $e['f4t9'] + $e['f4t10'] + $e['f4t19'] + $e['f4t11'] + $e['f4t12'] + $e['f4t13'] + $e['f4t14'] + $e['f5t6'] + $e['f5t7'] + $e['f5t8'] + $e['f5t9'] + $e['f5t10'] + $e['f5t19'] + $e['f5t11'] + $e['f5t12'] + $e['f5t13'] + $e['f5t14']);

                                            }else{

                                            $superpromo_adultR = $unvext + $wdext + $e['spprc_adult'] + $e['f1t3'] + $e['f1t4'] + $e['f1t5'] + $e['f1t6'] + $e['f1t7'] + $e['f1t8'] + $e['f1t9'] + $e['f1t10'] + $e['f1t19'] + $e['f1t11'] + $e['f1t12'] + $e['f1t13'] + $e['f1t14'] + $e['f2t3'] + $e['f2t3'] + $e['f2t4'] + $e['f2t5'] + $e['f2t6'] + $e['f2t7'] + $e['f2t8'] + $e['f2t9'] + $e['f2t10'] + $e['f2t19'] + $e['f2t11'] + $e['f2t12'] + $e['f2t13'] + $e['f2t14'] + $e['f3t4'] + $e['f3t5'] + $e['f3t6'] + $e['f3t7'] + $e['f3t8'] + $e['f3t9'] + $e['f3t10'] + $e['f3t19'] + $e['f3t11'] + $e['f3t12'] + $e['f3t13'] + $e['f3t14'] + $e['f4t5'] + $e['f4t6'] + $e['f4t7'] + $e['f4t8'] + $e['f4t9'] + $e['f4t10'] + $e['f4t19'] + $e['f4t11'] + $e['f4t12'] + $e['f4t13'] + $e['f4t14'] + $e['f5t6'] + $e['f5t7'] + $e['f5t8'] + $e['f5t9'] + $e['f5t10'] + $e['f5t19'] + $e['f5t11'] + $e['f5t12'] + $e['f5t13'] + $e['f5t14'];
                                            $superpromo_childR = $unvext + $wdext + $e['spprc_child'] + $e['f1t3'] + $e['f1t4'] + $e['f1t5'] + $e['f1t6'] + $e['f1t7'] + $e['f1t8'] + $e['f1t9'] + $e['f1t10'] + $e['f1t19'] + $e['f1t11'] + $e['f1t12'] + $e['f1t13'] + $e['f1t14'] + $e['f2t3'] + $e['f2t3'] + $e['f2t4'] + $e['f2t5'] + $e['f2t6'] + $e['f2t7'] + $e['f2t8'] + $e['f2t9'] + $e['f2t10'] + $e['f2t19'] + $e['f2t11'] + $e['f2t12'] + $e['f2t13'] + $e['f2t14'] + $e['f3t4'] + $e['f3t5'] + $e['f3t6'] + $e['f3t7'] + $e['f3t8'] + $e['f3t9'] + $e['f3t10'] + $e['f3t19'] + $e['f3t11'] + $e['f3t12'] + $e['f3t13'] + $e['f3t14'] + $e['f4t5'] + $e['f4t6'] + $e['f4t7'] + $e['f4t8'] + $e['f4t9'] + $e['f4t10'] + $e['f4t19'] + $e['f4t11'] + $e['f4t12'] + $e['f4t13'] + $e['f4t14'] + $e['f5t6'] + $e['f5t7'] + $e['f5t8'] + $e['f5t9'] + $e['f5t10'] + $e['f5t19'] + $e['f5t11'] + $e['f5t12'] + $e['f5t13'] + $e['f5t14'];
                                            //descuento
                                            //echo $e['flresprc_adult'];
                                            $webfarer_adultR = ($unvext + $wdext +  $e['wfprc_adult'] + $e['f1t3'] + $e['f1t4'] + $e['f1t5'] + $e['f1t6'] + $e['f1t7'] + $e['f1t8'] + $e['f1t9'] + $e['f1t10'] + $e['f1t19'] + $e['f1t11'] + $e['f1t12'] + $e['f1t13'] + $e['f1t14'] + $e['f2t3'] + $e['f2t3'] + $e['f2t4'] + $e['f2t5'] + $e['f2t6'] + $e['f2t7'] + $e['f2t8'] + $e['f2t9'] + $e['f2t10'] + $e['f2t19'] + $e['f2t11'] + $e['f2t12'] + $e['f2t13'] + $e['f2t14'] + $e['f3t4'] + $e['f3t5'] + $e['f3t6'] + $e['f3t7'] + $e['f3t8'] + $e['f3t9'] + $e['f3t10'] + $e['f3t19'] + $e['f3t11'] + $e['f3t12'] + $e['f3t13'] + $e['f3t14'] + $e['f4t5'] + $e['f4t6'] + $e['f4t7'] + $e['f4t8'] + $e['f4t9'] + $e['f4t10'] + $e['f4t19'] + $e['f4t11'] + $e['f4t12'] + $e['f4t13'] + $e['f4t14'] + $e['f5t6'] + $e['f5t7'] + $e['f5t8'] + $e['f5t9'] + $e['f5t10'] + $e['f5t19'] + $e['f5t11'] + $e['f5t12'] + $e['f5t13'] + $e['f5t14']);
                                            $webfarer_childR = ($unvext + $wdext +  $e['wfprc_child'] + $e['f1t3'] + $e['f1t4'] + $e['f1t5'] + $e['f1t6'] + $e['f1t7'] + $e['f1t8'] + $e['f1t9'] + $e['f1t10'] + $e['f1t19'] + $e['f1t11'] + $e['f1t12'] + $e['f1t13'] + $e['f1t14'] + $e['f2t3'] + $e['f2t3'] + $e['f2t4'] + $e['f2t5'] + $e['f2t6'] + $e['f2t7'] + $e['f2t8'] + $e['f2t9'] + $e['f2t10'] + $e['f2t19'] + $e['f2t11'] + $e['f2t12'] + $e['f2t13'] + $e['f2t14'] + $e['f3t4'] + $e['f3t5'] + $e['f3t6'] + $e['f3t7'] + $e['f3t8'] + $e['f3t9'] + $e['f3t10'] + $e['f3t19'] + $e['f3t11'] + $e['f3t12'] + $e['f3t13'] + $e['f3t14'] + $e['f4t5'] + $e['f4t6'] + $e['f4t7'] + $e['f4t8'] + $e['f4t9'] + $e['f4t10'] + $e['f4t19'] + $e['f4t11'] + $e['f4t12'] + $e['f4t13'] + $e['f4t14'] + $e['f5t6'] + $e['f5t7'] + $e['f5t8'] + $e['f5t9'] + $e['f5t10'] + $e['f5t19'] + $e['f5t11'] + $e['f5t12'] + $e['f5t13'] + $e['f5t14']);

                                            $superdiscount_adultR = $unvext + $wdext + $e['sdprc_adult'] + $e['f1t3'] + $e['f1t4'] + $e['f1t5'] + $e['f1t6'] + $e['f1t7'] + $e['f1t8'] + $e['f1t9'] + $e['f1t10'] + $e['f1t19'] + $e['f1t11'] + $e['f1t12'] + $e['f1t13'] + $e['f1t14'] + $e['f2t3'] + $e['f2t3'] + $e['f2t4'] + $e['f2t5'] + $e['f2t6'] + $e['f2t7'] + $e['f2t8'] + $e['f2t9'] + $e['f2t10'] + $e['f2t19'] + $e['f2t11'] + $e['f2t12'] + $e['f2t13'] + $e['f2t14'] + $e['f3t4'] + $e['f3t5'] + $e['f3t6'] + $e['f3t7'] + $e['f3t8'] + $e['f3t9'] + $e['f3t10'] + $e['f3t19'] + $e['f3t11'] + $e['f3t12'] + $e['f3t13'] + $e['f3t14'] + $e['f4t5'] + $e['f4t6'] + $e['f4t7'] + $e['f4t8'] + $e['f4t9'] + $e['f4t10'] + $e['f4t19'] + $e['f4t11'] + $e['f4t12'] + $e['f4t13'] + $e['f4t14'] + $e['f5t6'] + $e['f5t7'] + $e['f5t8'] + $e['f5t9'] + $e['f5t10'] + $e['f5t19'] + $e['f5t11'] + $e['f5t12'] + $e['f5t13'] + $e['f5t14'];
                                            $superdiscount_childR = $unvext + $wdext + $e['sdprc_child'] + $e['f1t3'] + $e['f1t4'] + $e['f1t5'] + $e['f1t6'] + $e['f1t7'] + $e['f1t8'] + $e['f1t9'] + $e['f1t10'] + $e['f1t19'] + $e['f1t11'] + $e['f1t12'] + $e['f1t13'] + $e['f1t14'] + $e['f2t3'] + $e['f2t3'] + $e['f2t4'] + $e['f2t5'] + $e['f2t6'] + $e['f2t7'] + $e['f2t8'] + $e['f2t9'] + $e['f2t10'] + $e['f2t19'] + $e['f2t11'] + $e['f2t12'] + $e['f2t13'] + $e['f2t14'] + $e['f3t4'] + $e['f3t5'] + $e['f3t6'] + $e['f3t7'] + $e['f3t8'] + $e['f3t9'] + $e['f3t10'] + $e['f3t19'] + $e['f3t11'] + $e['f3t12'] + $e['f3t13'] + $e['f3t14'] + $e['f4t5'] + $e['f4t6'] + $e['f4t7'] + $e['f4t8'] + $e['f4t9'] + $e['f4t10'] + $e['f4t19'] + $e['f4t11'] + $e['f4t12'] + $e['f4t13'] + $e['f4t14'] + $e['f5t6'] + $e['f5t7'] + $e['f5t8'] + $e['f5t9'] + $e['f5t10'] + $e['f5t19'] + $e['f5t11'] + $e['f5t12'] + $e['f5t13'] + $e['f5t14'];

                                            $superfelx_adultR = ($unvext + $wdext + $e['sflexprc_adult'] + $e['f1t3'] + $e['f1t4'] + $e['f1t5'] + $e['f1t6'] + $e['f1t7'] + $e['f1t8'] + $e['f1t9'] + $e['f1t10'] + $e['f1t19'] + $e['f1t11'] + $e['f1t12'] + $e['f1t13'] + $e['f1t14'] + $e['f2t3'] + $e['f2t3'] + $e['f2t4'] + $e['f2t5'] + $e['f2t6'] + $e['f2t7'] + $e['f2t8'] + $e['f2t9'] + $e['f2t10'] + $e['f2t19'] + $e['f2t11'] + $e['f2t12'] + $e['f2t13'] + $e['f2t14'] + $e['f3t4'] + $e['f3t5'] + $e['f3t6'] + $e['f3t7'] + $e['f3t8'] + $e['f3t9'] + $e['f3t10'] + $e['f3t19'] + $e['f3t11'] + $e['f3t12'] + $e['f3t13'] + $e['f3t14'] + $e['f4t5'] + $e['f4t6'] + $e['f4t7'] + $e['f4t8'] + $e['f4t9'] + $e['f4t10'] + $e['f4t19'] + $e['f4t11'] + $e['f4t12'] + $e['f4t13'] + $e['f4t14'] + $e['f5t6'] + $e['f5t7'] + $e['f5t8'] + $e['f5t9'] + $e['f5t10'] + $e['f5t19'] + $e['f5t11'] + $e['f5t12'] + $e['f5t13'] + $e['f5t14']);
                                            $superfelx_childR = ($unvext + $wdext + $e['sflexprc_child'] + $e['f1t3'] + $e['f1t4'] + $e['f1t5'] + $e['f1t6'] + $e['f1t7'] + $e['f1t8'] + $e['f1t9'] + $e['f1t10'] + $e['f1t19'] + $e['f1t11'] + $e['f1t12'] + $e['f1t13'] + $e['f1t14'] + $e['f2t3'] + $e['f2t3'] + $e['f2t4'] + $e['f2t5'] + $e['f2t6'] + $e['f2t7'] + $e['f2t8'] + $e['f2t9'] + $e['f2t10'] + $e['f2t19'] + $e['f2t11'] + $e['f2t12'] + $e['f2t13'] + $e['f2t14'] + $e['f3t4'] + $e['f3t5'] + $e['f3t6'] + $e['f3t7'] + $e['f3t8'] + $e['f3t9'] + $e['f3t10'] + $e['f3t19'] + $e['f3t11'] + $e['f3t12'] + $e['f3t13'] + $e['f3t14'] + $e['f4t5'] + $e['f4t6'] + $e['f4t7'] + $e['f4t8'] + $e['f4t9'] + $e['f4t10'] + $e['f4t19'] + $e['f4t11'] + $e['f4t12'] + $e['f4t13'] + $e['f4t14'] + $e['f5t6'] + $e['f5t7'] + $e['f5t8'] + $e['f5t9'] + $e['f5t10'] + $e['f5t19'] + $e['f5t11'] + $e['f5t12'] + $e['f5t13'] + $e['f5t14']);

                                        }
                                        ?>
                                        <div class="flight-booking-item">
                                    <div class="flight-booking-wrapper">
                                       <div class="flight-booking-info">
                                          <div class="flight-booking-content">
                                             <div class="flight-booking-airline">
                                                <h5 class="flight-airline-name">Trip <?php echo $e['trip_no']?></h5>
                                             </div>
                                             <div class="flight-booking-time">
                                                <div class="start-time">
                                                   <div class="start-time-info">
                                                      <h6 class="start-time-text"><?php echo $e['trip_departure']?></h6>
                                                      <span class="flight-destination"><?php echo $this->data['from_name']?></span>
                                                   </div>
                                                </div>
                                                <div class="flight-stop">
                                                   <span class="flight-stop-number">
                                                   <?php
                                                      $hora1 = new DateTime($e['trip_departure']);
                                                      $hora2 = new DateTime($e['trip_arrival']);
                                                      $diferencia = $hora1->diff($hora2);
                                                      echo $diferencia->format('%H:%I');
                                                      ?>
                                                   </span>
                                                   <div class="flight-stop-arrow"></div>
                                                </div>
                                                <div class="end-time">
                                                   <div class="start-time-info">
                                                      <h6 class="end-time-text"><?php echo $e['trip_arrival']?></h6>
                                                      <span class="flight-destination"><?php echo $this->data['to_name']?></span>
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                    </div>   
                                       <div class="flight-booking-detail">
                                          <div class="flight-booking-info">
                                             <div class="flight-booking-content">
                                                <div class="">
                                                   <span class="flight-destination">Web Farer</span>
                                                   <div class="price-info">
                                                      <span class="price-amount">
                                                      <?php
                                                      $na = "<b>N/A</b>";
                                                                    $disponiblewebfarer = $wf_tot;
                                                                    list($dia, $mes, $anio) = explode("-", $booking["fecha_salida"]);
                                                                    $fechaS = $anio . '-' . $mes . '-' . $dia;
                                                                    if($disponiblewebfarer < 0 || $seats <= 0 || ($e['trip_departure'] < date('H:i:s') && $fechaS == date("Y-m-d"))){
                                                                        echo $na;
                                                                        $disabled = 'style="display: none;"';
                                                                    } else {
                                                                        $disabled = "";
                                                                        echo number_format($webfarer_adult + $webfarer_child, 2, '.', ',');
                                                                    }
                                                                    
                                                                    ?>
                                                      </span>
                                                      <input type="radio" class="form-check-input" name="price1" id="price" <?php echo $disabled;?> onclick="llenarTablaDinamica<?php echo $e['id']?>(<?php echo $webfarer_adult?>,<?php echo $webfarer_child; ?>)" value="<?php echo $e['id']?>,webfarer">                                                   
                                                    </div>
                                                </div>
                                                <div class="">
                                                   <span class="flight-destination">Super Discount</span>
                                                   <div class="price-info">
                                                      <span class="price-amount">
                                                      <?php
                                                        $disponibles = $sdc_tot;
                                                        $na = "<b>N/A</b>";
                                                        if($disponibles < 0 || $seats <= 0 || ($e['trip_departure'] < $date->format('H:i:s') && $fechaS == date("Y-m-d") )){
                                                            echo $na;
                                                            $disabled = 'style="display: none;"';
                                                        }else{
                                                            $disabled = "";
                                                            echo number_format($superdiscount_adult + $superdiscount_child, 2, '.', '.');
                                                        }
                                                        ?>
                                                      </span>
                                                      <input type="radio" class="form-check-input" name="price1" id="price" <?php echo $disabled;?> onclick="llenarTablaDinamica<?php echo $e['id']?>(<?php echo $superdiscount_adult?>,<?php echo $superdiscount_child; ?>)" value="<?php echo $e['id']?>,superdiscount">
                                                   </div>
                                                </div>
                                                <div class="">
                                                   <span class="flight-destination">Super Promo</span>
                                                   <div class="price-info">
                                                      <span class="price-amount">
                                                                <?php
                                                                    $disponiblespromo = $spr_tot;
                                                                    if( $disponiblespromo < 0 || $seats <= 0 || ($e['trip_departure'] < $date->format('H:i:s') && $fechaS == date("Y-m-d") )){
                                                                        echo $na;
                                                                        $disabled = 'style="display: none;"';
                                                                    }else{
                                                                        $disabled = "";
                                                                        echo number_format($superpromo_adult + $superpromo_child, 2, '.', '.');
                                                                    }
                                                                ?>
                                                      </span>
                                                      <input type="radio" class="form-check-input" name="price1"  <?php echo $disabled;?> id="price<?php echo $e['id']?>" onclick="llenarTablaDinamica<?php echo $e['id']?>(<?php echo $superpromo_adult?>,<?php echo $superpromo_child; ?>)" value="<?php echo $e['id']?>,superpromo">                                                   
                                                    </div>
                                                </div>
                                                <div class="">
                                                   <span class="flight-destination">Super Flex</span>
                                                   <div class="price-info">
                                                      <span class="price-amount">
                                                            <?php
                                                                    if( $sflx_tot < 0 || $seats <= 0 || ($e['trip_departure'] < $date->format('H:i:s') && $fechaS == date("Y-m-d") )){
                                                                        echo $na;
                                                                        $disabled = 'style="display: none;"';
                                                                    }else{
                                                                        $disabled = '';
                                                                        echo number_format($superfelx_adult + $superfelx_child, 2, '.', ',');
                                                                    }
                                                            ?>
                                                      </span>
                                                      <input type="radio" class="form-check-input" name="price1" <?php echo $disabled;?> id="price" onclick="llenarTablaDinamica<?php echo $e['id']?>(<?php echo $superfelx_adult?>,<?php echo $superfelx_child; ?>)" value="<?php echo $e['id']?>,superfelx">                                                  
                                                     </div>
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                    
                                    <div class="flight-booking-detail">
                                       <div class="flight-booking-detail-header">
                                          <a href="#flight-booking-collapse<?php echo $e['id']?>" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="flight-booking-collapse1">Trip
                                          Details <i class="far fa-angle-down"></i></a>
                                       </div>
                                       <div class="collapse" id="flight-booking-collapse<?php echo $e['id']?>">
                                          <div class="flight-booking-detail-wrapper">
                                             <div class="row">
                                                <div class="col-lg-12 col-xl-12">
                                                   <div class="flight-booking-detail-right">
                                                      <ul class="nav nav-tabs" id="frTab" role="tablist">
                                                         <li class="nav-item" role="presentation">
                                                            <button class="nav-link active" id="fr-tab<?php echo $e['id']?>" data-bs-toggle="tab" data-bs-target="#fr-tab-pane<?php echo $e['id']?>" type="button" role="tab" aria-controls="fr-tab-pane<?php echo $e['id']?>" aria-selected="true">Fare</button>
                                                         </li>
                                                         <li class="nav-item" role="presentation">
                                                            <button class="nav-link" id="fr-tab<?php echo $e['id']?>" data-bs-toggle="tab" data-bs-target="#fr-tab-pane1<?php echo $e['id']?>" type="button" role="tab" aria-controls="fr-tab-pane<?php echo $e['id']?>" aria-selected="false">Policy</button>
                                                         </li>
                                                      </ul>
                                                      <div class="tab-content" id="frTabContent<?php echo $e['id']?>">
                                                         <div class="tab-pane fade show active" id="fr-tab-pane<?php echo $e['id']?>" role="tabpanel" aria-labelledby="fr-tab<?php echo $e['id']?>" tabindex="0">
                                                            <div class="flight-booking-detail-info">
                                                                
                                                               <table class="table table-borderless" id="tablaPreciosTarifa<?php echo $e['id']?>">
                                                                  <tr>
                                                                     <th>Fare Summary</th>
                                                                     <th>Fare</th>
                                                                     <th>Total</th>
                                                                  </tr>
                                                                  <tr>
                                                                     <td>Adult x <?php echo $booking['pax']?> </td>
                                                                     <td colspan="3">
                                                                           please select a rate
                                                                     </td>
                                                                  </tr>
                                                                  <tr>
                                                                     <td>Child x <?php echo $booking['chil']?> </td>
                                                                     <td colspan="3">
                                                                           please select a rate
                                                                     </td>
                                                                  </tr>
                                                               </table>
                                                               <script>
                                                               function llenarTablaDinamica<?php echo $e['id']?>(adult,child){
                                                                  var url = "<?php echo $data['rootUrl'] ?>cargarTablaDinamica/"+adult+"/"+child;
                                                                  $("#tablaPreciosTarifa<?php echo $e['id']?>").load(encodeURI(url));
                                                                  var priceUrl = "<?php echo $data['rootUrl'] ?>cargarPrecioDinamico/"+adult+"/"+child;
                                                                  $("#precioTotal<?php echo $e['id']?>").load(encodeURI(priceUrl));
                                                               }
                                                              </script>
                                                            </div>
                                                         </div>
                                                         <div class="tab-pane fade" id="fr-tab-pane1<?php echo $e['id']?>" role="tabpanel" aria-labelledby="fr-tab<?php echo $e['id']?>" tabindex="0">
                                                            <div class="flight-booking-detail-info">
                                                               <div class="flight-booking-policy">
                                                                  <ul>
                                                                     <li>
                                                                        1. The ticket is valid only for the date and time printed on the e-ticket.
                                                                     </li>
                                                                     <li>
                                                                        2. Passengers have to bring a valid ID and a printout of the e-Tickets (confirmation email) at boarding for ID Check.
                                                                     </li>
                                                                     <li>
                                                                        3. Ticket Holder name (s) on e-ticket must match the passenger's name.
                                                                     </li>
                                                                     <li>
                                                                        4. Passenger must arrive 30 minutes prior departure time, otherwise the seat might be sold to others.
                                                                     </li>
                                                                  </ul>
                                                               </div>
                                                            </div>
                                                         </div>
                                                      </div>
                                                      <div class="flight-booking-detail-price">
                                                         <h6 class="flight-booking-detail-price-title">Total (2 Traveler)</h6>
                                                         <div class="flight-detail-price-amount">
                                                            $ <span id="precioTotal<?php echo $e['id']?>">00.00</span>
                                                         </div>
                                                      </div>
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                                    <?php endforeach?>
                              </div>
                           </div>
                        </div>
                     </div>
                     <?php }?>
                     <div class="search-btn">
                        <button type="submit" class="theme-btn"><span
                           class="far fa-arrow-right"></span>Continue</button>
                     </div>
                  </div>
               </div>
            </div>
         </form>
      </main>
      <footer class="footer-area">
         <div class="footer-widget">
            <div class="container">
               <div class="row footer-widget-wrapper pt-100 pb-70">
                  <div class="col-md-6 col-lg-3">
                     <div class="footer-widget-box about-us">
                        <a href="#" class="footer-logo">
                        <img src="<?php echo $data['rootUrl'] ?>global/assets/img/logo/logoSupertours.png" alt>
                        </a>
                        <p class="mb-4">
                           We are many variations of passages available but the majority have suffer alteration
                           in some form by injected.
                        </p>
                        <ul class="footer-contact">
                           <li>
                              <div class="footer-call">
                                 <div class="footer-call-icon">
                                    <i class="fal fa-headset"></i>
                                 </div>
                                 <div class="footer-call-info">
                                    <h6>24/7 Call Service</h6>
                                    <a href="tel:+21236547898">Orlando (407) 370 3001</a>
                                    <a href="tel:+21236547898">Miami (305) 677 2676</a>
                                 </div>
                              </div>
                           </li>
                           <li><i class="far fa-map-marker-alt"></i>Orlando Terminal 3718 L.B. MCLEOD RD, 32805</li>
                           <li><a
                              href="https://live.themewild.com/cdn-cgi/l/email-protection#0a63646c654a6f726b677a666f24696567"><i
                              class="far fa-envelopes"></i><span class="__cf_email__"
                              data-cfemail="046d6a626b44617c65697468612a676b69">reservations@supertours.com</span></a>
                           </li>
                        </ul>
                     </div>
                  </div>
                  <div class="col-md-6 col-lg-2">
                     <div class="footer-widget-box list">
                        <h4 class="footer-widget-title">Our Company</h4>
                        <ul class="footer-list">
                           <li><a href="#"><i class="fas fa-angle-double-right"></i> Super Tours</a></li>
                           <li><a href="#"><i class="fas fa-angle-double-right"></i> Fleet and Terminal</a></li>
                           <li><a href="#"><i class="fas fa-angle-double-right"></i> Tickets Policy</a></li>
                           <li><a href="#"><i class="fas fa-angle-double-right"></i> Baggage</a></li>
                        </ul>
                     </div>
                  </div>
                  <div class="col-md-6 col-lg-2">
                     <div class="footer-widget-box list">
                        <h4 class="footer-widget-title">Our Services</h4>
                        <ul class="footer-list">
                           <li><a href="#"><i class="fas fa-angle-double-right"></i> Transportation</a></li>
                           <li><a href="#"><i class="fas fa-angle-double-right"></i> One Day Torus</a></li>
                           <li><a href="#"><i class="fas fa-angle-double-right"></i> Multy Day Tours</a></li>
                        </ul>
                     </div>
                  </div>
                  <div class="col-md-6 col-lg-2">
                     <div class="footer-widget-box list">
                     </div>
                  </div>
                  <div class="col-md-6 col-lg-3">
                     <div class="footer-widget-box list">
                        <h4 class="footer-widget-title">Newsletter</h4>
                        <div class="footer-newsletter">
                           <p>Subscribe Our Newsletter To Get Latest Update And News</p>
                           <div class="subscribe-form">
                              <form action="#">
                                 <div class="form-group">
                                    <div class="form-group-icon">
                                       <input type="email" class="form-control" placeholder="Your Email">
                                       <i class="far fa-envelope"></i>
                                    </div>
                                 </div>
                                 <button class="theme-btn" type="submit">
                                 Subscribe Now <i class="far fa-paper-plane"></i>
                                 </button>
                                 <p><i class="far fa-lock"></i> Your information is safe with us.</p>
                              </form>
                           </div>
                        </div>
                        <div class="footer-payment-method">
                           <h6>We Accept:</h6>
                           <div class="payment-method-img">
                              <img src="<?php echo $data['rootUrl'] ?>global/assets/img/payment/paypal.svg" alt>
                              <img src="<?php echo $data['rootUrl'] ?>global/assets/img/payment/mastercard.svg" alt>
                              <img src="<?php echo $data['rootUrl'] ?>global/assets/img/payment/visa.svg" alt>
                              <img src="<?php echo $data['rootUrl'] ?>global/assets/img/payment/discover.svg" alt>
                              <img src="<?php echo $data['rootUrl'] ?>global/assets/img/payment/american-express.svg" alt>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="copyright">
            <div class="container">
               <div class="row">
                  <div class="col-md-6 align-self-center">
                     <p class="copyright-text">
                        &copy;2023 Super Tours Inc. Copyright © 1989 - 2023 Super Tours Inc. All Rights Reserved.
                     </p>
                  </div>
                  <div class="col-md-6 align-self-center">
                     <ul class="footer-social">
                        <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                        <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                        <li><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
                        <li><a href="#"><i class="fab fa-youtube"></i></a></li>
                     </ul>
                  </div>
               </div>
            </div>
         </div>
      </footer>
      <a href="#" id="scroll-top"><i class="far fa-angle-up"></i></a>
      <script data-cfasync="false" src="../cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
      <script src="<?php echo $data['rootUrl'] ?>global/assets/js/jquery-3.6.0.min.js"></script>
      <script src="<?php echo $data['rootUrl'] ?>global/assets/js/modernizr.min.js"></script>
      <script src="<?php echo $data['rootUrl'] ?>global/assets/js/bootstrap.bundle.min.js"></script>
      <script src="<?php echo $data['rootUrl'] ?>global/assets/js/imagesloaded.pkgd.min.js"></script>
      <script src="<?php echo $data['rootUrl'] ?>global/assets/js/jquery.magnific-popup.min.js"></script>
      <script src="<?php echo $data['rootUrl'] ?>global/assets/js/isotope.pkgd.min.js"></script>
      <script src="<?php echo $data['rootUrl'] ?>global/assets/js/jquery.appear.min.js"></script>
      <script src="<?php echo $data['rootUrl'] ?>global/assets/js/jquery.easing.min.js"></script>
      <script src="<?php echo $data['rootUrl'] ?>global/assets/js/owl.carousel.min.js"></script>
      <script src="<?php echo $data['rootUrl'] ?>global/assets/js/counter-up.js"></script>
      <script src="<?php echo $data['rootUrl'] ?>global/assets/js/masonry.pkgd.min.js"></script>
      <script src="<?php echo $data['rootUrl'] ?>global/assets/js/jquery.nice-select.min.js"></script>
      <script src="<?php echo $data['rootUrl'] ?>global/assets/js/jquery-ui.min.js"></script>
      <script src="<?php echo $data['rootUrl'] ?>global/assets/js/jquery.timepicker.min.js"></script>
      <script src="<?php echo $data['rootUrl'] ?>global/assets/js/wow.min.js"></script>
      <script src="<?php echo $data['rootUrl'] ?>global/assets/js/main.js"></script>
      <script src="<?php echo $data['rootUrl'] ?>global/assets/js/app.js"></script>
   </body>
</html>
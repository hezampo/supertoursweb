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
                  <a class="navbar-brand" href="">
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
         <div class="site-breadcrumb" style="background: url(<?php echo $data['rootUrl'] ?>global/assets/img/hero/epcot4217875_1920.jpg)">
            <div class="container">
               <h2 class="breadcrumb-title">Bus Booking</h2>
               <ul class="breadcrumb-menu">
                  <li><a href="#">Home</a></li>
                  <li >Bus List</li>
                  <li class="active">Bus Confirm</li>
               </ul>
            </div>
         </div>
         <form action="#" method="POST">
            <div class="flight-booking py-120">
               <div class="container">
                  <div class="row">
                     <div class="col-lg-7">
                        <div class="booking-widget">
                           <h4 class="booking-widget-title">Booking Personal Info</h4>
                           <div class="booking-form">
                                 <div class="row">
                                    <div class="col-lg-6">
                                       <div class="form-group">
                                          <label>First Name</label>
                                          <div class="form-group-icon">
                                             <input type="text" class="form-control" name="firstName" placeholder="First Name">
                                             <i class="far fa-user"></i>
                                          </div>
                                       </div>
                                    </div>
                                    <div class="col-lg-6">
                                       <div class="form-group">
                                          <label>Last Name</label>
                                          <div class="form-group-icon">
                                             <input type="text" class="form-control" name="lastName" placeholder="Last Name">
                                             <i class="far fa-user"></i>
                                          </div>
                                       </div>
                                    </div>
                                    <div class="col-lg-6">
                                       <div class="form-group">
                                          <label>Email</label>
                                          <div class="form-group-icon">
                                             <input type="email" class="form-control" name="email" placeholder="Email Address">
                                             <i class="far fa-envelopes"></i>
                                          </div>
                                       </div>
                                    </div>
                                    <div class="col-lg-6">
                                       <div class="form-group">
                                          <label>Phone</label>
                                          <div class="form-group-icon">
                                             <input type="text" class="form-control" name="phone" placeholder="Phone Number">
                                             <i class="far fa-phone"></i>
                                          </div>
                                       </div>
                                    </div>
                                    <div class="col-lg-12">
                                       <div class="form-group">
                                          <label>Address 1</label>
                                          <div class="form-group-icon">
                                             <input type="text" class="form-control" name="address1" placeholder="Address Line">
                                             <i class="far fa-map-location-dot"></i>
                                          </div>
                                       </div>
                                    </div>
                                    <div class="col-lg-12">
                                       <div class="form-group">
                                          <label>Address 2</label>
                                          <div class="form-group-icon">
                                             <input type="text" class="form-control" name="address2" placeholder="Address Line">
                                             <i class="far fa-map-location-dot"></i>
                                          </div>
                                       </div>
                                    </div>
                                    <div class="col-lg-6">
                                       <div class="form-group">
                                          <label>Country</label>
                                          <div class="form-group-icon">
                                             <select class="select" name="contry" @readonly(true)>
                                                <option value="5" selected>United States</option>
                                             </select>
                                             <i class="far fa-globe"></i>
                                          </div>
                                       </div>
                                    </div>
                                    <div class="col-lg-6">
                                       <div class="form-group">
                                          <label>Age</label>
                                          <div class="form-group-icon">
                                             <input type="text" class="form-control" name="age" placeholder="Age">
                                             <i class="fab fa-pagelines"></i>
                                          </div>
                                       </div>
                                    </div>
                                    <div class="col-lg-4">
                                       <div class="form-group">
                                          <label>State</label>
                                          <div class="form-group-icon">
                                             <select class="form-control swap-to" name="state" id="estados">
                                               
                                             </select>
                                             <i class="far fa-location-dot"></i>
                                          </div>
                                       </div>
                                    </div>
                                    <div class="col-lg-4">
                                       <div class="form-group">
                                          <label>City</label>
                                          <div class="form-group-icon">
                                             <select name="ciudad" class="form-control swap-to" name="city" id="ciudad">
                                                <option value=""></option>
                                             </select>
                                             <i class="far fa-location-dot"></i>
                                          </div>
                                       </div>
                                    </div>
                                    <div class="col-lg-4">
                                       <div class="form-group">
                                          <label>Zip Code</label>
                                          <div class="form-group-icon">
                                             <input type="text" class="form-control" name="zipcode" placeholder="Zip Code">
                                             <i class="far fa-location-dot"></i>
                                          </div>
                                       </div>
                                    </div>
                                    <div class="col-lg-12">
                                       <div class="form-group">
                                          <label>Additional Info</label>
                                          <div class="form-group-icon">
                                             <textarea class="form-control" cols="30" rows="5" name="additionalInfo" placeholder="Additional Comment"></textarea>
                                             <i class="far fa-pen"></i>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                           </div>
                        </div>
                        <div class="booking-widget">
                           <h4 class="booking-widget-title">Your Card Information</h4>
                           <div class="booking-payment-area">
                              <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                                 <li class="nav-item" role="presentation">
                                    <a class="nav-link active" id="pills-tab-1" data-bs-toggle="pill" data-bs-target="#pills-1" type="button" role="tab" aria-controls="pills-1" aria-selected="true">
                                       <div class="payment-card-img">
                                          <img src="<?php echo $data['rootUrl'] ?>global/assets/img/payment/mastercard.svg" alt>
                                          <img src="<?php echo $data['rootUrl'] ?>global/assets/img/payment/visa.svg" alt>
                                          <img src="<?php echo $data['rootUrl'] ?>global/assets/img/payment/american-express.svg" alt>
                                          <img src="<?php echo $data['rootUrl'] ?>global/assets/img/payment/discover.svg" alt>
                                       </div>
                                       <span>Payment With Credit Card</span>
                                    </a>
                                 </li>
                              </ul>
                              <div class="tab-content" id="pills-tabContent">
                                 <div class="tab-pane fade show active" id="pills-1" role="tabpanel" aria-labelledby="pills-tab-1" tabindex="0">
                                    <div class="booking-form">
                                       <form action="#">
                                          <div class="row">
                                             <div class="col-lg-6">
                                                <div class="form-group">
                                                   <label>Card Holder Name</label>
                                                   <div class="form-group-icon">
                                                      <input type="text" class="form-control" name="nameOnCard" placeholder="Name On Card">
                                                      <i class="far fa-user"></i>
                                                   </div>
                                                </div>
                                             </div>
                                             <div class="col-lg-6">
                                                <div class="form-group">
                                                   <label>Card Number</label>
                                                   <div class="form-group-icon">
                                                      <input type="text" class="form-control" name="numberOnCard" placeholder="Your Card Number">
                                                      <i class="far fa-credit-card"></i>
                                                   </div>
                                                </div>
                                             </div>
                                             <div class="col-lg-6">
                                                <div class="form-group">
                                                   <label>Expire Date</label>
                                                   <div class="form-group-icon">
                                                      <input type="text" class="form-control" name="expeireDate" placeholder="Expire">
                                                      <i class="far fa-calendar-days"></i>
                                                   </div>
                                                </div>
                                             </div>
                                             <div class="col-lg-6">
                                                <div class="form-group">
                                                   <label>CCV</label>
                                                   <div class="form-group-icon">
                                                      <input type="text" class="form-control" name="cvv" placeholder="CVV">
                                                      <i class="far fa-credit-card"></i>
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                       </form>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="col-lg-5">
                        <div class="booking-summary">
                           <h4 class="mb-30">Booking Summary</h4>
                           <div class="booking-property-img">
                              <img src="https://www.supertours.com/global/slidesWEN/images/transportation.jpeg" alt>
                           </div>
                           <div class="booking-property-content">
                              <div class="booking-property-title">
                                 <div>
                                    <h5>Order Info From <?php echo $_SESSION['booking']['nombreFrom']?> To <?php echo $_SESSION['booking']['nombreTo']?></h5>
                                    <p><?php echo $_SESSION['booking']['tipo_ticket']?> </p>
                                 </div>
                              </div>
                           </div>
                          
                           <div class="booking-info-summary ">
                           <?php
                                        $booking = $_SESSION['booking'];
                                        echo '<pre>';
                                        print_r($booking);
                                        echo '</pre>';
                                            if (isset($data['salida']) && isset($data['pickup1'])) {
                                                $e = $data['salida'];
                        
                                                //print_r($data['salida']);
                                                
                                                list($mes, $dia, $anyo) = explode("-", $e['fecha']);
                        
                        
                                                $fecha1 = $anyo . "-" . $mes . "-" . $dia;
                                                // A continuacion se realiza una conversion en las fechas, para que pueda ser aceptada con los valores que se ingresaron en la BD
                                                list ($mes2, $dia2, $anyo2) = explode("-", $booking['fecha_salida']);
                                                $fecha_s = $anyo2 . "-" . $mes2 . "-" . $dia2;
                            
                                                //Se asignan las variables de sesion de booking a otras variables php para hacer la nueva consulta
                                                $tripT=$e['trip_no'];
                                                $FromT=$booking['fromt'];
                                                $ToTs=$booking['tot'];
                                                $idPrecioIdaT=$booking['idPrecioIda'];//Id del ID del Precio de ida
                                                //echo "**".$idPrecioIdaT."**".$ToTs."**".$FromT."**".$tripT."**".$fecha_s;
                                                //Se realiza la consulta con los datos seleccionados por el usuario
                                                $sql1 = "SELECT sdprc_adult, sdprc_child, spprc_adult, spprc_child, wfprc_adult, wfprc_child, sflexprc_adult, sflexprc_child, flresprc_adult, flresprc_child, f1t3, f1t4, f1t5, f1t6, f1t7, f1t8, f1t9, f1t10, f1t19, f1t11, f1t12, f1t13, f1t14,
                                                f2t3, f2t4, f2t5, f2t6, f2t7, f2t8, f2t9, f2t10, f2t19, f2t11, f2t12, f2t13, f2t14, f3t4, f3t5, f3t6, f3t7, f3t8, f3t9, f3t10, f3t19, f3t11, f3t12, f3t13, f3t14, f4t5, f4t6, f4t7, f4t8, f4t9, f4t10, f4t19, f4t11, f4t12, f4t13, f4t14,
                                                f5t6, f5t7, f5t8, f5t9, f5t10, f5t19, f5t11, f5t12, f5t13, f5t14 FROM routes WHERE trip_no = '$tripT' AND fecha_ini = '$fecha_s' AND trip_from = '$FromT' AND trip_to = '$ToTs'";
                                                $rs1 = Doo::db()->query($sql1);
                                                $rutas = $rs1->fetchAll();
                        
                                                //print_r($rutas);
                        
                                                if($idPrecioIdaT == 5){ //5=Super Discount 
                                                    foreach ($rutas as $prc){
                                                        if($booking['resident']==0){
                                                            $pretAD = $prc['sdprc_adult'] + $prc['f1t3'] + $prc['f1t4'] + $prc['f1t5'] + $prc['f1t6']+ $prc['f1t7'] + $prc['f1t8'] + $prc['f1t9'] + $prc['f1t10'] + $prc['f1t19'] + $prc['f1t11'] + $prc['f1t12'] + $prc['f1t13'] + $prc['f1t14'] +
                                                            $prc['f2t3'] + $prc['f2t4'] + $prc['f2t5'] + $prc['f2t6'] + $prc['f2t7'] + $prc['f2t8'] + $prc['f2t9'] + $prc['f2t10'] + $prc['f2t19'] + $prc['f2t11'] + $prc['f2t12'] + $prc['f2t13'] + $prc['f2t14'] +
                                                            $prc['f3t4'] + $prc['f3t5'] + $prc['f3t6'] + $prc['f3t7'] + $prc['f3t8'] + $prc['f3t9'] + $prc['f3t10'] + $prc['f3t19'] + $prc['f3t11'] + $prc['f3t12'] + $prc['f3t13'] + $prc['f3t14'] +  
                                                            $prc['f4t5'] + $prc['f4t6'] + $prc['f4t7'] + $prc['f4t8'] + $prc['f4t9'] + $prc['f4t10'] + $prc['f4t19'] + $prc['f4t11'] +$prc['f4t12'] + $prc['f4t13'] + $prc['f4t14'] +
                                                            $prc['f5t6'] + $prc['f5t7'] + $prc['f5t8'] + $prc['f5t9'] + $prc['f5t10'] + $prc['f5t19'] + $prc['f5t11'] + $prc['f5t12'] + $prc['f5t13'] + $prc['f5t14'];
                                                            $pretCH = $prc['sdprc_child'] + $prc['f1t3'] + $prc['f1t4'] + $prc['f1t5'] + $prc['f1t6']+ $prc['f1t7'] + $prc['f1t8'] + $prc['f1t9'] + $prc['f1t10'] + $prc['f1t19'] + $prc['f1t11'] + $prc['f1t12'] + $prc['f1t13'] + $prc['f1t14'] +
                                                            $prc['f2t3'] + $prc['f2t4'] + $prc['f2t5'] + $prc['f2t6'] + $prc['f2t7'] + $prc['f2t8'] + $prc['f2t9'] + $prc['f2t10'] + $prc['f2t19'] + $prc['f2t11'] + $prc['f2t12'] + $prc['f2t13'] + $prc['f2t14'] +
                                                            $prc['f3t4'] + $prc['f3t5'] + $prc['f3t6'] + $prc['f3t7'] + $prc['f3t8'] + $prc['f3t9'] + $prc['f3t10'] + $prc['f3t19'] + $prc['f3t11'] + $prc['f3t12'] + $prc['f3t13'] + $prc['f3t14'] +  
                                                            $prc['f4t5'] + $prc['f4t6'] + $prc['f4t7'] + $prc['f4t8'] + $prc['f4t9'] + $prc['f4t10'] + $prc['f4t19'] + $prc['f4t11'] +$prc['f4t12'] + $prc['f4t13'] + $prc['f4t14'] +
                                                            $prc['f5t6'] + $prc['f5t7'] + $prc['f5t8'] + $prc['f5t9'] + $prc['f5t10'] + $prc['f5t19'] + $prc['f5t11'] + $prc['f5t12'] + $prc['f5t13'] + $prc['f5t14'];
                                                        }else{
                                                            $pretAD = $prc['sdprc_adult'] + $prc['f1t3'] + $prc['f1t4'] + $prc['f1t5'] + $prc['f1t6']+ $prc['f1t7'] + $prc['f1t8'] + $prc['f1t9'] + $prc['f1t10'] + $prc['f1t19'] + $prc['f1t11'] + $prc['f1t12'] + $prc['f1t13'] + $prc['f1t14'] +
                                                            $prc['f2t3'] + $prc['f2t4'] + $prc['f2t5'] + $prc['f2t6'] + $prc['f2t7'] + $prc['f2t8'] + $prc['f2t9'] + $prc['f2t10'] + $prc['f2t19'] + $prc['f2t11'] + $prc['f2t12'] + $prc['f2t13'] + $prc['f2t14'] +
                                                            $prc['f3t4'] + $prc['f3t5'] + $prc['f3t6'] + $prc['f3t7'] + $prc['f3t8'] + $prc['f3t9'] + $prc['f3t10'] + $prc['f3t19'] + $prc['f3t11'] + $prc['f3t12'] + $prc['f3t13'] + $prc['f3t14'] +  
                                                            $prc['f4t5'] + $prc['f4t6'] + $prc['f4t7'] + $prc['f4t8'] + $prc['f4t9'] + $prc['f4t10'] + $prc['f4t19'] + $prc['f4t11'] +$prc['f4t12'] + $prc['f4t13'] + $prc['f4t14'] +
                                                            $prc['f5t6'] + $prc['f5t7'] + $prc['f5t8'] + $prc['f5t9'] + $prc['f5t10'] + $prc['f5t19'] + $prc['f5t11'] + $prc['f5t12'] + $prc['f5t13'] + $prc['f5t14'];
                                                            $pretCH = $prc['sdprc_child'] + $prc['f1t3'] + $prc['f1t4'] + $prc['f1t5'] + $prc['f1t6']+ $prc['f1t7'] + $prc['f1t8'] + $prc['f1t9'] + $prc['f1t10'] + $prc['f1t19'] + $prc['f1t11'] + $prc['f1t12'] + $prc['f1t13'] + $prc['f1t14'] +
                                                            $prc['f2t3'] + $prc['f2t4'] + $prc['f2t5'] + $prc['f2t6'] + $prc['f2t7'] + $prc['f2t8'] + $prc['f2t9'] + $prc['f2t10'] + $prc['f2t19'] + $prc['f2t11'] + $prc['f2t12'] + $prc['f2t13'] + $prc['f2t14'] +
                                                            $prc['f3t4'] + $prc['f3t5'] + $prc['f3t6'] + $prc['f3t7'] + $prc['f3t8'] + $prc['f3t9'] + $prc['f3t10'] + $prc['f3t19'] + $prc['f3t11'] + $prc['f3t12'] + $prc['f3t13'] + $prc['f3t14'] +  
                                                            $prc['f4t5'] + $prc['f4t6'] + $prc['f4t7'] + $prc['f4t8'] + $prc['f4t9'] + $prc['f4t10'] + $prc['f4t19'] + $prc['f4t11'] +$prc['f4t12'] + $prc['f4t13'] + $prc['f4t14'] +
                                                            $prc['f5t6'] + $prc['f5t7'] + $prc['f5t8'] + $prc['f5t9'] + $prc['f5t10'] + $prc['f5t19'] + $prc['f5t11'] + $prc['f5t12'] + $prc['f5t13'] + $prc['f5t14'];
                                                        }
                                                    }
                                                }elseif($idPrecioIdaT == 4 ){// 4=Super Promo 
                                                    foreach ($rutas as $prc) {
                                                        if($booking['resident']==0){
                                                            $pretAD = $prc['spprc_adult'] + $prc['f1t3'] + $prc['f1t4'] + $prc['f1t5'] + $prc['f1t6']+ $prc['f1t7'] + $prc['f1t8'] + $prc['f1t9'] + $prc['f1t10'] + $prc['f1t19'] + $prc['f1t11'] + $prc['f1t12'] + $prc['f1t13'] + $prc['f1t14'] +
                                                            $prc['f2t3'] + $prc['f2t4'] + $prc['f2t5'] + $prc['f2t6'] + $prc['f2t7'] + $prc['f2t8'] + $prc['f2t9'] + $prc['f2t10'] + $prc['f2t19'] + $prc['f2t11'] + $prc['f2t12'] + $prc['f2t13'] + $prc['f2t14'] +
                                                            $prc['f3t4'] + $prc['f3t5'] + $prc['f3t6'] + $prc['f3t7'] + $prc['f3t8'] + $prc['f3t9'] + $prc['f3t10'] + $prc['f3t19'] + $prc['f3t11'] + $prc['f3t12'] + $prc['f3t13'] + $prc['f3t14'] +  
                                                            $prc['f4t5'] + $prc['f4t6'] + $prc['f4t7'] + $prc['f4t8'] + $prc['f4t9'] + $prc['f4t10'] + $prc['f4t19'] + $prc['f4t11'] +$prc['f4t12'] + $prc['f4t13'] + $prc['f4t14'] +
                                                            $prc['f5t6'] + $prc['f5t7'] + $prc['f5t8'] + $prc['f5t9'] + $prc['f5t10'] + $prc['f5t19'] + $prc['f5t11'] + $prc['f5t12'] + $prc['f5t13'] + $prc['f5t14'];
                                                            $pretCH = $prc['spprc_child'] + $prc['f1t3'] + $prc['f1t4'] + $prc['f1t5'] + $prc['f1t6']+ $prc['f1t7'] + $prc['f1t8'] + $prc['f1t9'] + $prc['f1t10'] + $prc['f1t19'] + $prc['f1t11'] + $prc['f1t12'] + $prc['f1t13'] + $prc['f1t14'] +
                                                            $prc['f2t3'] + $prc['f2t4'] + $prc['f2t5'] + $prc['f2t6'] + $prc['f2t7'] + $prc['f2t8'] + $prc['f2t9'] + $prc['f2t10'] + $prc['f2t19'] + $prc['f2t11'] + $prc['f2t12'] + $prc['f2t13'] + $prc['f2t14'] +
                                                            $prc['f3t4'] + $prc['f3t5'] + $prc['f3t6'] + $prc['f3t7'] + $prc['f3t8'] + $prc['f3t9'] + $prc['f3t10'] + $prc['f3t19'] + $prc['f3t11'] + $prc['f3t12'] + $prc['f3t13'] + $prc['f3t14'] +  
                                                            $prc['f4t5'] + $prc['f4t6'] + $prc['f4t7'] + $prc['f4t8'] + $prc['f4t9'] + $prc['f4t10'] + $prc['f4t19'] + $prc['f4t11'] +$prc['f4t12'] + $prc['f4t13'] + $prc['f4t14'] +
                                                            $prc['f5t6'] + $prc['f5t7'] + $prc['f5t8'] + $prc['f5t9'] + $prc['f5t10'] + $prc['f5t19'] + $prc['f5t11'] + $prc['f5t12'] + $prc['f5t13'] + $prc['f5t14'];
                                                        }else{
                                                            $pretAD = $prc['spprc_adult'] + $prc['f1t3'] + $prc['f1t4'] + $prc['f1t5'] + $prc['f1t6']+ $prc['f1t7'] + $prc['f1t8'] + $prc['f1t9'] + $prc['f1t10'] + $prc['f1t19'] + $prc['f1t11'] + $prc['f1t12'] + $prc['f1t13'] + $prc['f1t14'] +
                                                            $prc['f2t3'] + $prc['f2t4'] + $prc['f2t5'] + $prc['f2t6'] + $prc['f2t7'] + $prc['f2t8'] + $prc['f2t9'] + $prc['f2t10'] + $prc['f2t19'] + $prc['f2t11'] + $prc['f2t12'] + $prc['f2t13'] + $prc['f2t14'] +
                                                            $prc['f3t4'] + $prc['f3t5'] + $prc['f3t6'] + $prc['f3t7'] + $prc['f3t8'] + $prc['f3t9'] + $prc['f3t10'] + $prc['f3t19'] + $prc['f3t11'] + $prc['f3t12'] + $prc['f3t13'] + $prc['f3t14'] +  
                                                            $prc['f4t5'] + $prc['f4t6'] + $prc['f4t7'] + $prc['f4t8'] + $prc['f4t9'] + $prc['f4t10'] + $prc['f4t19'] + $prc['f4t11'] +$prc['f4t12'] + $prc['f4t13'] + $prc['f4t14'] +
                                                            $prc['f5t6'] + $prc['f5t7'] + $prc['f5t8'] + $prc['f5t9'] + $prc['f5t10'] + $prc['f5t19'] + $prc['f5t11'] + $prc['f5t12'] + $prc['f5t13'] + $prc['f5t14'];;
                                                        $pretCH = $prc['spprc_child'] + $prc['f1t3'] + $prc['f1t4'] + $prc['f1t5'] + $prc['f1t6']+ $prc['f1t7'] + $prc['f1t8'] + $prc['f1t9'] + $prc['f1t10'] + $prc['f1t19'] + $prc['f1t11'] + $prc['f1t12'] + $prc['f1t13'] + $prc['f1t14'] +
                                                        $prc['f2t3'] + $prc['f2t4'] + $prc['f2t5'] + $prc['f2t6'] + $prc['f2t7'] + $prc['f2t8'] + $prc['f2t9'] + $prc['f2t10'] + $prc['f2t19'] + $prc['f2t11'] + $prc['f2t12'] + $prc['f2t13'] + $prc['f2t14'] +
                                                        $prc['f3t4'] + $prc['f3t5'] + $prc['f3t6'] + $prc['f3t7'] + $prc['f3t8'] + $prc['f3t9'] + $prc['f3t10'] + $prc['f3t19'] + $prc['f3t11'] + $prc['f3t12'] + $prc['f3t13'] + $prc['f3t14'] +  
                                                        $prc['f4t5'] + $prc['f4t6'] + $prc['f4t7'] + $prc['f4t8'] + $prc['f4t9'] + $prc['f4t10'] + $prc['f4t19'] + $prc['f4t11'] +$prc['f4t12'] + $prc['f4t13'] + $prc['f4t14'] +
                                                        $prc['f5t6'] + $prc['f5t7'] + $prc['f5t8'] + $prc['f5t9'] + $prc['f5t10'] + $prc['f5t19'] + $prc['f5t11'] + $prc['f5t12'] + $prc['f5t13'] + $prc['f5t14'];
                                                        }
                                                    }
                                                }elseif($idPrecioIdaT == 3){// 3=Web Fare
                                                    foreach ($rutas as $prc) {
                                                        if($booking['resident']==0){
                                                            $pretAD = $prc['wfprc_adult'] + $prc['f1t3'] + $prc['f1t4'] + $prc['f1t5'] + $prc['f1t6']+ $prc['f1t7'] + $prc['f1t8'] + $prc['f1t9'] + $prc['f1t10'] + $prc['f1t19'] + $prc['f1t11'] + $prc['f1t12'] + $prc['f1t13'] + $prc['f1t14'] +
                                                            $prc['f2t3'] + $prc['f2t4'] + $prc['f2t5'] + $prc['f2t6'] + $prc['f2t7'] + $prc['f2t8'] + $prc['f2t9'] + $prc['f2t10'] + $prc['f2t19'] + $prc['f2t11'] + $prc['f2t12'] + $prc['f2t13'] + $prc['f2t14'] +
                                                            $prc['f3t4'] + $prc['f3t5'] + $prc['f3t6'] + $prc['f3t7'] + $prc['f3t8'] + $prc['f3t9'] + $prc['f3t10'] + $prc['f3t19'] + $prc['f3t11'] + $prc['f3t12'] + $prc['f3t13'] + $prc['f3t14'] +  
                                                            $prc['f4t5'] + $prc['f4t6'] + $prc['f4t7'] + $prc['f4t8'] + $prc['f4t9'] + $prc['f4t10'] + $prc['f4t19'] + $prc['f4t11'] +$prc['f4t12'] + $prc['f4t13'] + $prc['f4t14'] +
                                                            $prc['f5t6'] + $prc['f5t7'] + $prc['f5t8'] + $prc['f5t9'] + $prc['f5t10'] + $prc['f5t19'] + $prc['f5t11'] + $prc['f5t12'] + $prc['f5t13'] + $prc['f5t14'];
                                                         
                                                            $pretCH = $prc['wfprc_child'] + $prc['f1t8']+ $prc['f1t3'] + $prc['f1t4'] + $prc['f1t5'] + $prc['f1t6']+ $prc['f1t7'] + $prc['f1t8'] + $prc['f1t9'] + $prc['f1t10'] + $prc['f1t19'] + $prc['f1t11'] + $prc['f1t12'] + $prc['f1t13'] + $prc['f1t14'] +
                                                            $prc['f2t3'] + $prc['f2t4'] + $prc['f2t5'] + $prc['f2t6'] + $prc['f2t7'] + $prc['f2t8'] + $prc['f2t9'] + $prc['f2t10'] + $prc['f2t19'] + $prc['f2t11'] + $prc['f2t12'] + $prc['f2t13'] + $prc['f2t14'] +
                                                            $prc['f3t4'] + $prc['f3t5'] + $prc['f3t6'] + $prc['f3t7'] + $prc['f3t8'] + $prc['f3t9'] + $prc['f3t10'] + $prc['f3t19'] + $prc['f3t11'] + $prc['f3t12'] + $prc['f3t13'] + $prc['f3t14'] +  
                                                            $prc['f4t5'] + $prc['f4t6'] + $prc['f4t7'] + $prc['f4t8'] + $prc['f4t9'] + $prc['f4t10'] + $prc['f4t19'] + $prc['f4t11'] +$prc['f4t12'] + $prc['f4t13'] + $prc['f4t14'] +
                                                            $prc['f5t6'] + $prc['f5t7'] + $prc['f5t8'] + $prc['f5t9'] + $prc['f5t10'] + $prc['f5t19'] + $prc['f5t11'] + $prc['f5t12'] + $prc['f5t13'] + $prc['f5t14'];
                                                        }else{
                                                            $pretAD = $prc['wfprc_adult']+ $prc['flresprc_adult']+ $prc['f1t3'] + $prc['f1t4'] + $prc['f1t5'] + $prc['f1t6']+ $prc['f1t7'] + $prc['f1t8'] + $prc['f1t9'] + $prc['f1t10'] + $prc['f1t19'] + $prc['f1t11'] + $prc['f1t12'] + $prc['f1t13'] + $prc['f1t14'] +
                                                            $prc['f2t3'] + $prc['f2t4'] + $prc['f2t5'] + $prc['f2t6'] + $prc['f2t7'] + $prc['f2t8'] + $prc['f2t9'] + $prc['f2t10'] + $prc['f2t19'] + $prc['f2t11'] + $prc['f2t12'] + $prc['f2t13'] + $prc['f2t14'] +
                                                            $prc['f3t4'] + $prc['f3t5'] + $prc['f3t6'] + $prc['f3t7'] + $prc['f3t8'] + $prc['f3t9'] + $prc['f3t10'] + $prc['f3t19'] + $prc['f3t11'] + $prc['f3t12'] + $prc['f3t13'] + $prc['f3t14'] +  
                                                            $prc['f4t5'] + $prc['f4t6'] + $prc['f4t7'] + $prc['f4t8'] + $prc['f4t9'] + $prc['f4t10'] + $prc['f4t19'] + $prc['f4t11'] +$prc['f4t12'] + $prc['f4t13'] + $prc['f4t14'] +
                                                            $prc['f5t6'] + $prc['f5t7'] + $prc['f5t8'] + $prc['f5t9'] + $prc['f5t10'] + $prc['f5t19'] + $prc['f5t11'] + $prc['f5t12'] + $prc['f5t13'] + $prc['f5t14'];
                                                            $pretCH = $prc['wfprc_child']+ $prc['flresprc_child'] + $prc['f1t3'] + $prc['f1t4'] + $prc['f1t5'] + $prc['f1t6']+ $prc['f1t7'] + $prc['f1t8'] + $prc['f1t9'] + $prc['f1t10'] + $prc['f1t19'] + $prc['f1t11'] + $prc['f1t12'] + $prc['f1t13'] + $prc['f1t14'] +
                                                            $prc['f2t3'] + $prc['f2t4'] + $prc['f2t5'] + $prc['f2t6'] + $prc['f2t7'] + $prc['f2t8'] + $prc['f2t9'] + $prc['f2t10'] + $prc['f2t19'] + $prc['f2t11'] + $prc['f2t12'] + $prc['f2t13'] + $prc['f2t14'] +
                                                            $prc['f3t4'] + $prc['f3t5'] + $prc['f3t6'] + $prc['f3t7'] + $prc['f3t8'] + $prc['f3t9'] + $prc['f3t10'] + $prc['f3t19'] + $prc['f3t11'] + $prc['f3t12'] + $prc['f3t13'] + $prc['f3t14'] +  
                                                            $prc['f4t5'] + $prc['f4t6'] + $prc['f4t7'] + $prc['f4t8'] + $prc['f4t9'] + $prc['f4t10'] + $prc['f4t19'] + $prc['f4t11'] +$prc['f4t12'] + $prc['f4t13'] + $prc['f4t14'] +
                                                            $prc['f5t6'] + $prc['f5t7'] + $prc['f5t8'] + $prc['f5t9'] + $prc['f5t10'] + $prc['f5t19'] + $prc['f5t11'] + $prc['f5t12'] + $prc['f5t13'] + $prc['f5t14'];
                                                        }
                                                    }
                                                }else{// Super Flex
                                                    foreach ($rutas as $prc) {
                                                        if($booking['resident']==0){
                                                            $pretAD = $prc['sflexprc_adult'] + $prc['f1t3'] + $prc['f1t4'] + $prc['f1t5'] + $prc['f1t6']+ $prc['f1t7'] + $prc['f1t8'] + $prc['f1t9'] + $prc['f1t10'] + $prc['f1t19'] + $prc['f1t11'] + $prc['f1t12'] + $prc['f1t13'] + $prc['f1t14'] +
                                                            $prc['f2t3'] + $prc['f2t4'] + $prc['f2t5'] + $prc['f2t6'] + $prc['f2t7'] + $prc['f2t8'] + $prc['f2t9'] + $prc['f2t10'] + $prc['f2t19'] + $prc['f2t11'] + $prc['f2t12'] + $prc['f2t13'] + $prc['f2t14'] +
                                                            $prc['f3t4'] + $prc['f3t5'] + $prc['f3t6'] + $prc['f3t7'] + $prc['f3t8'] + $prc['f3t9'] + $prc['f3t10'] + $prc['f3t19'] + $prc['f3t11'] + $prc['f3t12'] + $prc['f3t13'] + $prc['f3t14'] +  
                                                            $prc['f4t5'] + $prc['f4t6'] + $prc['f4t7'] + $prc['f4t8'] + $prc['f4t9'] + $prc['f4t10'] + $prc['f4t19'] + $prc['f4t11'] +$prc['f4t12'] + $prc['f4t13'] + $prc['f4t14'] +
                                                            $prc['f5t6'] + $prc['f5t7'] + $prc['f5t8'] + $prc['f5t9'] + $prc['f5t10'] + $prc['f5t19'] + $prc['f5t11'] + $prc['f5t12'] + $prc['f5t13'] + $prc['f5t14'];
                                                            $pretCH = $prc['sflexprc_child'] + $prc['f1t3'] + $prc['f1t4'] + $prc['f1t5'] + $prc['f1t6']+ $prc['f1t7'] + $prc['f1t8'] + $prc['f1t9'] + $prc['f1t10'] + $prc['f1t19'] + $prc['f1t11'] + $prc['f1t12'] + $prc['f1t13'] + $prc['f1t14'] +
                                                            $prc['f2t3'] + $prc['f2t4'] + $prc['f2t5'] + $prc['f2t6'] + $prc['f2t7'] + $prc['f2t8'] + $prc['f2t9'] + $prc['f2t10'] + $prc['f2t19'] + $prc['f2t11'] + $prc['f2t12'] + $prc['f2t13'] + $prc['f2t14'] +
                                                            $prc['f3t4'] + $prc['f3t5'] + $prc['f3t6'] + $prc['f3t7'] + $prc['f3t8'] + $prc['f3t9'] + $prc['f3t10'] + $prc['f3t19'] + $prc['f3t11'] + $prc['f3t12'] + $prc['f3t13'] + $prc['f3t14'] +  
                                                            $prc['f4t5'] + $prc['f4t6'] + $prc['f4t7'] + $prc['f4t8'] + $prc['f4t9'] + $prc['f4t10'] + $prc['f4t19'] + $prc['f4t11'] +$prc['f4t12'] + $prc['f4t13'] + $prc['f4t14'] +
                                                            $prc['f5t6'] + $prc['f5t7'] + $prc['f5t8'] + $prc['f5t9'] + $prc['f5t10'] + $prc['f5t19'] + $prc['f5t11'] + $prc['f5t12'] + $prc['f5t13'] + $prc['f5t14'];   
                                                        }else{
                                                            $pretAD = $prc['sflexprc_adult'] + $prc['flresprc_adult']+ $prc['f1t3'] + $prc['f1t4'] + $prc['f1t5'] + $prc['f1t6']+ $prc['f1t7'] + $prc['f1t8'] + $prc['f1t9'] + $prc['f1t10'] + $prc['f1t19'] + $prc['f1t11'] + $prc['f1t12'] + $prc['f1t13'] + $prc['f1t14'] +
                                                            $prc['f2t3'] + $prc['f2t4'] + $prc['f2t5'] + $prc['f2t6'] + $prc['f2t7'] + $prc['f2t8'] + $prc['f2t9'] + $prc['f2t10'] + $prc['f2t19'] + $prc['f2t11'] + $prc['f2t12'] + $prc['f2t13'] + $prc['f2t14'] +
                                                            $prc['f3t4'] + $prc['f3t5'] + $prc['f3t6'] + $prc['f3t7'] + $prc['f3t8'] + $prc['f3t9'] + $prc['f3t10'] + $prc['f3t19'] + $prc['f3t11'] + $prc['f3t12'] + $prc['f3t13'] + $prc['f3t14'] +  
                                                            $prc['f4t5'] + $prc['f4t6'] + $prc['f4t7'] + $prc['f4t8'] + $prc['f4t9'] + $prc['f4t10'] + $prc['f4t19'] + $prc['f4t11'] +$prc['f4t12'] + $prc['f4t13'] + $prc['f4t14'] +
                                                            $prc['f5t6'] + $prc['f5t7'] + $prc['f5t8'] + $prc['f5t9'] + $prc['f5t10'] + $prc['f5t19'] + $prc['f5t11'] + $prc['f5t12'] + $prc['f5t13'] + $prc['f5t14'];
                                                            $pretCH = $prc['sflexprc_child']+ $prc['flresprc_child'] + $prc['f1t3'] + $prc['f1t4'] + $prc['f1t5'] + $prc['f1t6']+ $prc['f1t7'] + $prc['f1t8'] + $prc['f1t9'] + $prc['f1t10'] + $prc['f1t19'] + $prc['f1t11'] + $prc['f1t12'] + $prc['f1t13'] + $prc['f1t14'] +
                                                            $prc['f2t3'] + $prc['f2t4'] + $prc['f2t5'] + $prc['f2t6'] + $prc['f2t7'] + $prc['f2t8'] + $prc['f2t9'] + $prc['f2t10'] + $prc['f2t19'] + $prc['f2t11'] + $prc['f2t12'] + $prc['f2t13'] + $prc['f2t14'] +
                                                            $prc['f3t4'] + $prc['f3t5'] + $prc['f3t6'] + $prc['f3t7'] + $prc['f3t8'] + $prc['f3t9'] + $prc['f3t10'] + $prc['f3t19'] + $prc['f3t11'] + $prc['f3t12'] + $prc['f3t13'] + $prc['f3t14'] +  
                                                            $prc['f4t5'] + $prc['f4t6'] + $prc['f4t7'] + $prc['f4t8'] + $prc['f4t9'] + $prc['f4t10'] + $prc['f4t19'] + $prc['f4t11'] +$prc['f4t12'] + $prc['f4t13'] + $prc['f4t14'] +
                                                            $prc['f5t6'] + $prc['f5t7'] + $prc['f5t8'] + $prc['f5t9'] + $prc['f5t10'] + $prc['f5t19'] + $prc['f5t11'] + $prc['f5t12'] + $prc['f5t13'] + $prc['f5t14'];   
                                                        }
                                                    }
                                                }
                        
                        
                                                //echo "aquí---------tengo # ".$idPrecioIdaT."y valen ". $pretCH." para niños y ".$pretAD." para dultos **".$prc['flresprc_adult']."**".$prc['flresprc_child'];
                                                $departureT1= $booking["trip_departure"];
                                                //$departureT2 = $booking["trip_departure2"];
                        
                                                $booking = array(
                                                    "tipo_ticket" => $booking['tipo_ticket'],
                                                    "fromt" => $booking['fromt'],
                                                    "tot" => $booking['tot'],
                                                    "fecha_salida" => $booking['fecha_salida'],
                                                    "fecha_retorno" => $booking['fecha_retorno'],
                                                    "pax" => $booking['pax'],
                                                    "trip_no" => $e['trip_no'],
                                                    "price" => $pretAD,
                                                    "priceAdult" => "",
                                                    "priceChild" => "",
                                                    "priceAdultR" => "",
                                                    "priceChildR" => "",
                                                    "pricer" => $pretCH,
                                                    "pricechil" => "",
                                                    "priceadult" => "",
                                                    "trip_arrival" => $booking['trip_arrival'],
                                                    "trip_departure" => $booking['trip_departure'],
                                                    "trip_arrival2" => $booking['trip_arrival2'],
                                                    "trip_departure2" => $booking['trip_departure2'],
                                                    "chil" => $booking['chil'],
                                                    "resident" => $booking['resident'],
                                                    "zip" => $booking['zip'],
                                                    "idPrecioIda" => $booking['idPrecioIda'],
                                                    "idPrecioVuelta" => $booking['idPrecioVuelta'],
                                                    "iden" => $booking['iden'],
                                                    "dateT" => $booking["dateT"],
                                                    "dateT1" => $booking["dateT1"],
                                                    "dateT2" => $booking["dateT2"],
                                                    "trip1" => $booking["trip1"],
                                                    "trip2" => $booking["trip2"]
                                                );
                                                $_SESSION["booking"] = $booking;
                                                $booking = $_SESSION["booking"];
                                                //print_r($booking);
                                            //  echo '<pre>';
                                            //  print_r($this->data['pickup2']);
                                            //  echo '</pre>';    
                    ?>
                              <h5>Order Info From {{$dataArea["nombreAreaFrom"]}} To {{$dataArea["nombreAreaTo"]}}</h5>
                              <ul>
                                 <li>Departure Location:
                                       
                              </li>
                                 <li>Arrival Location:
                                 
                                 </li>
                                 <li>Departure Date: <span>{{$reserva["fecha_salida"]}}</span></li>
                                 <li>Departure Time <span>
                                        
                                     </span></li>
                                 <li>Bus: <span>{{$price[0]->trip_no}}</span></li>
                              </ul>
                            <?php } ?>                    
                              <h5>Order Info From {{$dataArea["nombreAreaTo"]}} To {{$dataArea["nombreAreaFrom"]}}</h5>
                              <ul>
                                 <li>Departure Location:
                                    <select name="pickUp1" class="form-control swap-to" id="">
                                       
                                 </select>
                                 </li>
                                 <li>
                                    Arrival Location:
                                   

                                 <div class="col-lg-12 booking-form" id="ocultar2" style="display: none;">
                                       <div class="form-group">
                                          <label>Address </label>
                                          <div class="form-group-icon">
                                             <input type="text" name="addressHotel2" class="form-control" placeholder="Address Line">
                                             <i class="far fa-map-location-dot"></i>
                                          </div>
                                       </div>
                                    </div>
                                 </li>
                                 <li>Departure Date: <span>{{$reserva["fecha_retorno"]}}</span></li>
                                 <li>Departure Time <span>
                                         <?php
                                         $date = new DateTime($price2[0]->trip_departure);
                                         echo $date->format('H:i a');
                                         ?>
                                     </span></li>
                                 <li>Bus: <span>{{$price2[0]->trip_no}}</span></li>
                              </ul>
                           </div>
                              <?php
                                 /*  switch ($tarifa) {
                                    case 'wfprc':
                                       $precioTotal = ($reserva["adult"]*$reserva[0]->wfprc_adult) + ($reserva["children"]*$reserva[0]->wfprc_child);
                                       $totalBooking = number_format($precioTotal, 2, ',', '.');
                                       $Tax = $precioTotal*0.05;
                                       $totalTax = number_format($Tax, 2,',','.');
                                       $total = ($precioTotal + $Tax);
                                       $priceTotal = number_format($total, 2, ',', '.');
                                       break;
                                    case 'spprc':
                                       $precioTotal = ($reserva["adult"]*$reserva[0]->spprc_adult) + ($reserva["children"]*$reserva[0]->spprc_child);
                                       $totalBooking = number_format($precioTotal, 2, ',', '.');
                                       $Tax = $precioTotal*0.05;
                                       $totalTax = number_format($Tax, 2,',','.');
                                       $total = ($precioTotal + $Tax);
                                       $priceTotal = number_format($total, 2, ',', '.');
                                       break;
                                    case 'sdprc':
                                       $precioTotal = ($reserva["adult"]*$reserva[0]->sdprc_adult) + ($reserva["children"]*$reserva[0]->sdprc_child);
                                       $totalBooking = number_format($precioTotal, 2, ',', '.');
                                       $Tax = $precioTotal*0.05;
                                       $totalTax = number_format($Tax, 2,',','.');
                                       $total = ($precioTotal + $Tax);
                                       $priceTotal = number_format($total, 2, ',', '.');
                                       break;
                                    case 'sflexprc':
                                       $precioTotal = ($reserva["adult"]*$reserva[0]->sflexprc_adult) + ($reserva["children"]*$reserva[0]->sflexprc_child);
                                       $totalBooking = number_format($precioTotal, 2, ',', '.');
                                       $Tax = $precioTotal*0.05;
                                       $totalTax = number_format($Tax, 2,',','.');
                                       $total = ($precioTotal + $Tax);
                                       $priceTotal = number_format($total, 2, ',', '.');
                                       break;
                                 }
                                 $data = array(
                                    "tarifa" => $tarifa,
                                    "precio" =>$precioTotal,
                                    "tax" => $Tax,
                                    "total"=>($precioTotal + $Tax)
                              );
                              ?>
                              <?php
                                 switch ($tarifa2) {
                                    case 'wfprc':
                                       $precioTotal2 = ($reserva["adult"]*$reserva[1]->wfprc_adult) + ($reserva["children"]*$reserva[1]->wfprc_child);
                                       $totalBooking2 = number_format($precioTotal2, 2, ',', '.');
                                       $Tax2 = $precioTotal2*0.05 + $Tax;
                                       $totalTax2 = number_format($Tax2, 2,',','.');
                                       $total2 = ($precioTotal2 + $Tax2);
                                       $priceTotal2 = number_format($total2, 2, ',', '.');
                                       break;
                                    case 'spprc':
                                       $precioTotal2 = ($reserva["adult"]*$reserva[1]->spprc_adult) + ($reserva["children"]*$reserva[1]->spprc_child);
                                       $totalBooking2 = number_format($precioTotal2, 2, ',', '.');
                                       $Tax2 = $precioTotal2*0.05 + $Tax;
                                       $totalTax2 = number_format($Tax2, 2,',','.');
                                       $total2 = ($precioTotal2 + $Tax2);
                                       $priceTotal2 = number_format($total2, 2, ',', '.');
                                       break;
                                    case 'sdprc':
                                       $precioTotal2 = ($reserva["adult"]*$reserva[1]->sdprc_adult) + ($reserva["children"]*$reserva[1]->sdprc_child);
                                       $totalBooking2 = number_format($precioTotal2, 2, ',', '.');
                                       $Tax2 = $precioTotal2*0.05 + $Tax;
                                       $totalTax2 = number_format($Tax2, 2,',','.');
                                       $total2 = ($precioTotal2 + $Tax2);
                                       $priceTotal2 = number_format($total2, 2, ',', '.');
                                       break;
                                    case 'sflexprc':
                                       $precioTotal2 = ($reserva["adult"]*$reserva[1]->sflexprc_adult) + ($reserva["children"]*$reserva[1]->sflexprc_child);
                                       $totalBooking2 = number_format($precioTotal2, 2, ',', '.');
                                       $Tax2 = $precioTotal2*0.05 + $Tax;
                                       $totalTax2 = number_format($Tax2, 2,',','.');
                                       $total2 = ($precioTotal2 + $Tax2);
                                       $priceTotal2 = number_format($total2, 2, ',', '.');
                                       break;
                                 } */
                              ?>
                           <div class="booking-order-info">
                              <div class="booking-pay-info">
                                 <h5>Booking Payment</h5>
                                 <ul>
                                    <li>Sub Total: <span id="subTotal">$ <?php //echo $a = number_format(($precioTotal+$precioTotal2), 2, ',', '.')?></span></li>
                                    <li>Taxes: <span id="taxes">$ <?php //echo $b = number_format(($Tax+$Tax2), 2, ',', '.')?></span></li>
                                    <li class="order-total">You Pay: <span id="totalPagar">$ <?php //echo number_format(($precioTotal+$precioTotal2+$Tax+$Tax2), 2, ',','.')?></span></li>
                                 </ul>
                              </div>
                              <div class="text-end mt-40">
                                 <button type="submit" class="theme-btn">Confirm Booking <i class="far fa-arrow-right"></i></button>
                              </div>
                           </div>
                        </div>
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
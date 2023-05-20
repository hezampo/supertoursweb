<?php 
    $areas = $this->data['areas'];
    if (isset($_SESSION['booking'])) {
        $booking = $_SESSION['booking'];
    }
?>
<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from live.themewild.com/mytrip/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 12 Apr 2023 20:21:58 GMT -->

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
                    <a class="navbar-brand" href="index.html">
                        <img src="<?php echo $data['rootUrl'] ?>global/assets/img/logo/logoSupertours.png" class="logo-display" alt="logo">
                        <img src="<?php echo $data['rootUrl'] ?>global/assets/img/logo/logoSupertours.png" class="logo-scrolled" alt="logo">
                    </a>
                    <div class="mobile-menu-right">
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                            data-bs-target="#main_nav" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-btn-icon"><i class="far fa-bars"></i></span>
                        </button>
                    </div>
                    <div class="collapse navbar-collapse" id="main_nav">
                        <ul class="navbar-nav">
                            <li class="nav-item ">
                                <a class="nav-link dropdown-toggle active" href="#">Home</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">Our Company</a>
                                <ul class="dropdown-menu fade-down">
                                    <li><a class="dropdown-item" href="flight-grid.html">Super Tours</a></li>
                                    <li><a class="dropdown-item" href="flight-list.html">Fleet and Terminal</a></li>
                                    <li><a class="dropdown-item" href="flight-full-width.html">Ticket Policy</a>
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

        <div class="hero-section">
            <div class="hero-single" style="background: url(<?php echo $data['rootUrl'] ?>global/assets/img/hero/epcot4217875_1920.jpg)">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-lg-12 mx-auto">
                            <div class="hero-content text-center">
                                <div class="hero-content-wrapper">
                                    <h1 class="hero-title">Bus Service</h1>
                                    <p>Super Tours offers 3 Trips daily, between Miami, Miami Beach and Fort Laurderdale to Kissimmee and Orlando.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="search-area">
            <div class="container">
                <div class="search-wrapper">

                    <div class="search-header">
                        <div class="search-nav">
                            <ul class="nav nav-pills" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="pills-tab-1" data-bs-toggle="pill"
                                        data-bs-target="#pills-1" type="button" role="tab" aria-controls="pills-1"
                                        aria-selected="true"><i class="far fa-bus"></i>Bus Ticket</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="pills-tab-2" data-bs-toggle="pill"
                                        data-bs-target="#pills-2" type="button" role="tab" aria-controls="pills-2"
                                        aria-selected="false"><i class="far fa-hotel"></i>Multi Day Tours</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="pills-tab-3" data-bs-toggle="pill"
                                        data-bs-target="#pills-3" type="button" role="tab" aria-controls="pills-3"
                                        aria-selected="false"><i
                                            class="far fa-person-biking-mountain"></i>One Day Tours</button>
                                </li>
                            </ul>
                        </div>
                    </div>


                    <div class="tab-content" id="pills-tabContent">

                        <div class="tab-pane fade show active" id="pills-1" role="tabpanel"
                            aria-labelledby="pills-tab-1" tabindex="0">
                            <div class="flight-search">
                                <div class="search-form">
                                    <form action="<?php echo $data['rootUrl']; ?>booking" method="POST">    
                                        <div class="flight-type">
                                        <div class="form-check form-check-inline">
                                                <input class="form-check-input" checked type="radio" value="roundtrip"
                                                    name="tipo_ticket" id="flight-type2">
                                                <label class="form-check-label" for="flight-type2">
                                                    Round Trip
                                                </label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" value="oneway"
                                                    name="tipo_ticket" id="flight-type1">
                                                <label class="form-check-label" for="flight-type1">
                                                    One Way Trip
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
                                                                            <option   value="<?php echo $main['id']?>"  <?php echo (isset($idfrom) AND $idfrom == $main['id'])? 'selected' : '' ; ?>><?php echo $main['nombre']?></option>
                                                                        <?php } } ?> 
                                                                        </select>
                                                                    <i class="fal fa-bus"></i>
                                                                </div>
                                                                <p id="address"></p>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <div class="form-group">
                                                                <div class="search-form-swap"><i
                                                                        class="far fa-repeat"></i>
                                                                </div>
                                                                <label>To</label>
                                                                <div class="form-group-icon">
                                                                    <select class="form-control swap-to" name="tot" id="to">
                                                                    <?php foreach ($areas as $main){   
                                                                            if ($main["id"] != 13 && $main["id"] != 15 && $main["id"] != 16 && $main["id"] != 17 && $main["id"]!=18 && $main["id"]!=19 && $main["id"]!=20) { ?>
                                                                            <option   value="<?php echo $main['id']?>"  <?php echo ($main["id"] == '3' ? 'selected' : ''); ?>><?php echo $main['nombre']?></option>
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
                                                                <p id="addressTo"></p>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <div class="form-group">
                                                                <div class="search-form-date">
                                                                    <div class="search-form-journey">
                                                                        <label>Journey Date</label>
                                                                        <div class="form-group-icon">
                                                                            <input type="text" name="fecha_salida" id="dateFrom"
                                                                                class="form-control date-picker journey-date">
                                                                            <i class="fal fa-calendar-days"></i>
                                                                        </div>
                                                                    </div>
                                                                    <div class="search-form-return" style="display: block">
                                                                        <label>Return Date</label>
                                                                        <div class="form-group-icon">
                                                                            <input type="text" name="fecha_retorno" id="dateTo"
                                                                                class="form-control date-picker return-date">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <div class="form-group dropdown passenger-box">
                                                                <div class="passenger-class" role="menu"
                                                                    data-bs-toggle="dropdown" aria-expanded="false">
                                                                    <label>Passenger, Class</label>
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
                                                                                <input type="text" name="pax"
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
                                                                                <input type="text" name="pax2"
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
            </div>
        </div>


        <div class="feature-area pt-120 pb-80">
            <div class="container">
                <div class="feature-wrapper">
                    <div class="row">
                        <div class="col-md-6 col-lg-4">
                            <div class="feature-item wow fadeInUp" data-wow-duration="1s" data-wow-delay=".25s">
                                <div class="feature-icon">
                                    <i class="flaticon-global-1"></i>
                                </div>
                                <h4 class="feature-title">Worldwide Coverage</h4>
                                <p>It is a long established fact that a reader will be distracted by the readable
                                    content of a page when looking at its layout.</p>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-4">
                            <div class="feature-item wow fadeInUp" data-wow-duration="1s" data-wow-delay=".50s">
                                <div class="feature-icon">
                                    <i class="flaticon-medal"></i>
                                </div>
                                <h4 class="feature-title">Best Quality Services</h4>
                                <p>It is a long established fact that a reader will be distracted by the readable
                                    content of a page when looking at its layout.</p>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-4">
                            <div class="feature-item wow fadeInUp" data-wow-duration="1s" data-wow-delay=".75s">
                                <div class="feature-icon">
                                    <i class="flaticon-customer-service"></i>
                                </div>
                                <h4 class="feature-title">24/7 Customer Service</h4>
                                <p>It is a long established fact that a reader will be distracted by the readable
                                    content of a page when looking at its layout.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="destination-area pb-120">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 mx-auto wow fadeInDown" data-wow-duration="1s" data-wow-delay=".25s">
                        <div class="site-heading text-center">
                            <span class="site-title-tagline">Destination</span>
                            <h2 class="site-title">Our Most Popular Destinations</h2>
                        </div>
                    </div>
                </div>
                <div class="row align-items-center">
                    <div class="col-md-12 col-lg-6">
                        <div class="destination-item wow fadeInUp" data-wow-duration="1s" data-wow-delay=".25s">
                            <div class="destination-img">
                                <img src="<?php echo $data['rootUrl'] ?>global/assets/img/destination/01.jpg" alt>
                            </div>
                            <div class="destination-info">
                                <h4>Orlando</h4>
                                <div class="destination-rate">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fal fa-star"></i>
                                    <span>(2.5k Reviews)</span>
                                </div>
                                <div class="destination-more-info">
                                    <ul>
                                        <li><i class="far fa-earth-americas"></i> 30 Tour</li>
                                        <li><i class="far fa-hotel"></i> 35 Hotel</li>
                                        <li><i class="far fa-ship"></i> 15 Cruise</li>
                                    </ul>
                                </div>
                            </div>
                            <a href="#" class="destination-btn"><i class="far fa-arrow-right"></i></a>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <div class="destination-item wow fadeInUp" data-wow-duration="1s" data-wow-delay=".50s">
                            <div class="destination-img">
                                <img src="<?php echo $data['rootUrl'] ?>global/assets/img/destination/02.jpg" alt>
                            </div>
                            <div class="destination-info">
                                <h4>San Francisco</h4>
                                <div class="destination-rate">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fal fa-star"></i>
                                    <span>(2.5k Reviews)</span>
                                </div>
                                <div class="destination-more-info">
                                    <ul>
                                        <li><i class="far fa-earth-americas"></i> 30 Tour</li>
                                        <li><i class="far fa-hotel"></i> 35 Hotel</li>
                                        <li><i class="far fa-ship"></i> 15 Cruise</li>
                                    </ul>
                                </div>
                            </div>
                            <a href="#" class="destination-btn"><i class="far fa-arrow-right"></i></a>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <div class="destination-item wow fadeInUp" data-wow-duration="1s" data-wow-delay=".75s">
                            <div class="destination-img">
                                <img src="<?php echo $data['rootUrl'] ?>global/assets/img/destination/03.jpg" alt>
                            </div>
                            <div class="destination-info">
                                <h4>Las Vegas</h4>
                                <div class="destination-rate">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fal fa-star"></i>
                                    <span>(2.5k Reviews)</span>
                                </div>
                                <div class="destination-more-info">
                                    <ul>
                                        <li><i class="far fa-earth-americas"></i> 30 Tour</li>
                                        <li><i class="far fa-hotel"></i> 35 Hotel</li>
                                        <li><i class="far fa-ship"></i> 15 Cruise</li>
                                    </ul>
                                </div>
                            </div>
                            <a href="#" class="destination-btn"><i class="far fa-arrow-right"></i></a>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <div class="destination-item wow fadeInUp" data-wow-duration="1s" data-wow-delay=".25s">
                            <div class="destination-img">
                                <img src="<?php echo $data['rootUrl'] ?>global/assets/img/destination/04.jpg" alt>
                            </div>
                            <div class="destination-info">
                                <h4>Los Angeles</h4>
                                <div class="destination-rate">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fal fa-star"></i>
                                    <span>(2.5k Reviews)</span>
                                </div>
                                <div class="destination-more-info">
                                    <ul>
                                        <li><i class="far fa-earth-americas"></i> 30 Tour</li>
                                        <li><i class="far fa-hotel"></i> 35 Hotel</li>
                                        <li><i class="far fa-ship"></i> 15 Cruise</li>
                                    </ul>
                                </div>
                            </div>
                            <a href="#" class="destination-btn"><i class="far fa-arrow-right"></i></a>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <div class="destination-item wow fadeInUp" data-wow-duration="1s" data-wow-delay=".50s">
                            <div class="destination-img">
                                <img src="<?php echo $data['rootUrl'] ?>global/assets/img/destination/05.jpg" alt>
                            </div>
                            <div class="destination-info">
                                <h4>Sydney</h4>
                                <div class="destination-rate">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fal fa-star"></i>
                                    <span>(2.5k Reviews)</span>
                                </div>
                                <div class="destination-more-info">
                                    <ul>
                                        <li><i class="far fa-earth-americas"></i> 30 Tour</li>
                                        <li><i class="far fa-hotel"></i> 35 Hotel</li>
                                        <li><i class="far fa-ship"></i> 15 Cruise</li>
                                    </ul>
                                </div>
                            </div>
                            <a href="#" class="destination-btn"><i class="far fa-arrow-right"></i></a>
                        </div>
                    </div>
                    <div class="col-md-12 col-lg-6">
                        <div class="destination-item wow fadeInUp" data-wow-duration="1s" data-wow-delay=".75s">
                            <div class="destination-img">
                                <img src="<?php echo $data['rootUrl'] ?>global/assets/img/destination/06.jpg" alt>
                            </div>
                            <div class="destination-info">
                                <h4>New Orleans</h4>
                                <div class="destination-rate">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fal fa-star"></i>
                                    <span>(2.5k Reviews)</span>
                                </div>
                                <div class="destination-more-info">
                                    <ul>
                                        <li><i class="far fa-earth-americas"></i> 30 Tour</li>
                                        <li><i class="far fa-hotel"></i> 35 Hotel</li>
                                        <li><i class="far fa-ship"></i> 15 Cruise</li>
                                    </ul>
                                </div>
                            </div>
                            <a href="#" class="destination-btn"><i class="far fa-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

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

<!-- Mirrored from live.themewild.com/mytrip/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 12 Apr 2023 20:22:44 GMT -->

</html>
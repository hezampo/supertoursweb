<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Supertours Of Orlando, Inc.</title>
    <link href="<?php echo $data['rootUrl']; ?>global/styles.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo $data['rootUrl']; ?>global/styles-Tours.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo $data['rootUrl']; ?>global/tooltip.css" rel="stylesheet" type="text/css" />

    <link rel="stylesheet" href="<?php echo $data['rootUrl']; ?>global/css/jquery-ui-timepicker-addon.css">

    <link href="<?php echo $data['rootUrl']; ?>global/css/style.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo $data['rootUrl']; ?>global/css/tipTip.css" rel="stylesheet" type="text/css" />

    <link rel="stylesheet" href="<?php echo $data['rootUrl']; ?>global/themes/blitzer/jquery-ui-1.9.0.custom.min.css">
    <link href="<?php echo $data['rootUrl']; ?>global/styles.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo $data['rootUrl']; ?>global/css/style.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo $data['rootUrl']; ?>global/menu.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo $data['rootUrl']; ?>global/js/nivolightbox/nivo-lightbox.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo $data['rootUrl']; ?>global/js/nivolightbox/themes/default/default.css" rel="stylesheet" type="text/css" />

    <link rel="stylesheet" type="text/css" href="<?php echo $data['rootUrl']; ?>global/css/jquery.notice.css"/>

    <script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/jquery.min.js"  language="javascript"></script>
    <script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/jquery-ui.min.js"></script>
    <script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/jquery.tipTip.js"></script>
    <script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/jquery.tipTip.minified.js"></script>
    <script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/jquery-ui-timepicker-addon.js"></script>
    <script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/jquery-ui-sliderAccess.js"></script>
    <script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/jquery.ddslick.min.js"></script>
    <script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/jquery.validator.js"></script>
    <script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/jquery.form.js"></script>
    <script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/nivolightbox/nivo-lightbox.js"></script>
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
        .notFilled {
            border: 2px solid #f00;
            background: #f99;
        }
        input.error {
            border: solid 1px red;
            color: Red;
        }
    </style>
</head>

<body class="no-js">
<script>
     var bPreguntar = true;
    var el = document.getElementsByTagName("body")[0];
    el.className = "";
</script>
<div id="contenedor">
<div id="header">
<div id="logo" ><a href="<?php echo $data['rootUrl'];?>">
        <img src="<?php echo $data['rootUrl']; ?>global/images/logo.png" width="316" height="119" /></a></div>

<div style="display:inline; float:right;">
    <a class="home img-link" href="<?php echo $data['rootUrl']; ?>" id="home">Home</a>
    <?php if(isset($_SESSION['user'])){ ?>
        <a class="logout img-link" href="<?php echo $data['rootUrl']; ?>close/session">Cerrar Session</a>
    <?php } ?>
</div>
<div id="redes">


        <div id="iconos"><div id="redesGo"></div><div id="redesGo"><a href="https://www.facebook.com/pages/Supertours-of-Orlando/157301064337315" target="_blank"><img src="<?php echo $data['rootUrl']; ?>global/images/Icon-facebook-Colombia.png"  border="0" /></a></div><div id="redesGo"><a href="<?php echo $data['rootUrl']; ?>contact-us-supertours"><img src="<?php echo $data['rootUrl']; ?>global/images/Icon-gmail-Colombia.png"  border="0" /></a></div></div>
        <div class="textosHead" >Toll Free <b> 1-800-251-4206 </b>- Open <br />
            From 4 am To Midnight - (Eastern Time) <br />
            <strong>Hablamos Español</strong></div>
    </div>
</div>
<div id="barra">
    <?php
    include('global/menu/menu1.php');?>
</div>
<div id="policy">

<?php
if (isset($_SESSION["toursbooking"])) {
    $toursbooking = $_SESSION["toursbooking"];


    //Numero de parques dias;s
    $npar_dias = $toursbooking['dias'];// parque de dia
    if(isset($toursbooking['trip1'])){
        $llegada1 = $toursbooking['datearrivingtrip1'];
        if(date('H:i:s',strtotime($llegada1))>'13:00'){
            $npar_dias--;
        }
    }
    if(isset($toursbooking['trip2'])){
        $llegada2 = $toursbooking['datedeparturetrip2'];
        if(date('H:i:s',strtotime($llegada2))<'12:00'){
            $npar_dias--;
        }
    }
}

?>
<div id="contendinfotours">


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
                                        <td><font class="bkfont">

                                                <?php if($_SESSION['toursbooking']['sarrival']==1 || $_SESSION['toursbooking']['sarrival']==2){
                                                    echo 'by '.$toursbooking['service1'] .' from Miami';
                                                }else{
                                                    echo 'by '.$toursbooking['service1'] ;
                                                }?>                                                                </font></td>
                                    </tr>
                                    <?php if(isset($toursbooking['trip1'])){?>

                                    <?php } ?>
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
                                        <td height="20" colspan="2"><span style="font-size:9px;">
							<?php
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
                                        <td><span  id="tickes"></span></td>
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
                                        <td width="100%"><font color="#FF0000"><?php echo date("l", strtotime($toursbooking['fecha_salida'])); ?>,<? echo date("M", strtotime($toursbooking['fecha_salida'])); ?> <? echo date("d", strtotime($toursbooking['fecha_salida'])); ?>,<? echo date("Y", strtotime($toursbooking['fecha_salida'])); ?></font></td>
                                    </tr>
                                    <tr valign="top">
                                        <td>Departure:</td>
                                        <td><font color="#FF0000" >
                                                <?php
                                                if($_SESSION['toursbooking']['sdeparture']==1 || $_SESSION['toursbooking']['sdeparture']==2){
                                                    echo 'by '.$toursbooking['service2'] .' To Miami';
                                                }else{
                                                    echo 'by '.$toursbooking['service2'];
                                                }?>

                                            </font></td>
                                    </tr>

                                </table></td>
                        </tr>
                    </table>
        </tr>
    </table>
    <div id="tq" class="redondo">
        <div id="tqp-text">TOUR PRICE</div>
        <div id="tqp-text-2">PER PERSON (Including Taxes)</div>
        <div id="tqp">$<?php echo round($_SESSION['toursbooking']['tqp1']); ?>
        </div></div>
</div>
<!-- fin buy ticket -->

<div id="rigthtour">
<form action="<?php echo $data['rootUrl']; ?>tours/4" id="form1"  name="form" method="post">
<table width="95%">
<tr>
    <td width="69" id="schoice"><img src="<?php echo $data['rootUrl']; ?>global/img/step3.png" /></td>
    <td width="1073" id="schoice">Please select the attraction of your choice. </td>
</tr>
<tr>
    <td height="20" colspan="2"class="tours-price-title"><!--<img src="<?php echo $data['rootUrl']; ?>global/img/tqp.png"/>--></td>
</tr>
<tr>
<td colspan="2">
<div id="parks">
<div id="disney-park" >
    <table>
        <tr>
            <td colspan="4"><img src="<?php echo $data['rootUrl']; ?>global/img/wall-disney.png"/></td>
        </tr>
        <tr>
            <td>
                <table width="214" class="parks-group"  id="tabladisney">
                    <tr>
                        <td width="56">
                            <div id="apDiv1" align="center" class="cursor">                                
                                <div class="checked_icono" id="check1_img"><img src="<?php echo $data['rootUrl']; ?>global/img/selected.png"/></div>
                                <div id="apDiv2"><?php echo $data["magk"];?></div>
                                <div id="apDiv3">Magic Kingdom</div>
                                <div id="apDiv4">
                                    <input type="checkbox" id="check1" name="check1" value="7,4"  class="ck"/>
                                    <label for="check1" id="check1_n" title="Click">ADD TO TOUR</label>
                                </div>
                            </div>                                            </td>
                        <td width="42">
                            <div id="apDiv1" align="center" class="cursor">
                                <div class="checked_icono" id="check2_img"><img src="<?php echo $data['rootUrl']; ?>global/img/selected.png"/></div>
                                <div id="apDiv2"><?php echo $data["epcot"];?></div>
                                <div id="apDiv3">Epcot</div>
                                <div id="apDiv4">
                                    <input type="checkbox" id="check2" name="check2" value="8,4" class="ck"/>
                                    <label for="check2" id="check2_n" title="Click">ADD TO TOUR</label>
                                </div>
                            </div>                                            </td>
                        <td width="42">
                            <div id="apDiv1" align="center" class="cursor">
                                <div class="checked_icono" id="check3_img"><img src="<?php echo $data['rootUrl']; ?>global/img/selected.png"/></div>
                                <div id="apDiv2"><?php echo $data["hs"];?></div>
                                <div id="apDiv3">Hollywood Studios</div>
                                <div id="apDiv4">
                                    <input type="checkbox" id="check3"  name="check3" value="9,4" class="ck"/>
                                    <label for="check3" id="check3_n" title="Click">ADD TO TOUR</label>
                                </div>
                            </div>                                            </td>
                        <td width="42">
                            <div id="apDiv1" align="center" class="cursor">
                                <div class="checked_icono" id="check4_img"><img src="<?php echo $data['rootUrl']; ?>global/img/selected.png"/></div>
                                <div id="apDiv2"><?php echo $data["animalk"];?></div>
                                <div id="apDiv3">Animal Kingdom</div>
                                <div id="apDiv4">
                                    <input type="checkbox" id="check4"  name="check4" value="10,4" class="ck" />
                                    <label for="check4" id="check4_n" title="Click">ADD TO TOUR</label>
                                </div>
                            </div>                                            </td>
                    </tr>
                </table>                                </td>
        </tr>
    </table>
</div>

<div id="seaworld-park"  >
    <table>
        <tr>
            <td><img src="<?php echo $data['rootUrl']; ?>global/img/sea-world.png"/></td>
        </tr>
        <tr>
            <td>
                <table class="parks-group">
                    <tr>
                        <td>
                            <div id="apDiv1" align="center" class="cursor">
                                <div class="checked_icono" id="check5_img"><img src="<?php echo $data['rootUrl']; ?>global/img/selected.png"/></div>
                                <div id="apDiv2"><?php echo $data["sw"];?></div>
                                <div id="apDiv3">Sea World</div>
                                <div id="apDiv4">
                                    <input type="checkbox" id="check5" name="check5" value="11,5" class="ck" />
                                    <label for="check5" id="check5_n" title="Click">ADD TO TOUR</label>
                                </div>
                            </div>                                            </td>
                        <td><?php if($toursbooking['noches']>=2){?>
                                <div id="apDiv1" align="center" class="cursor">
                                    <div class="checked_icono" id="check6_img"><img src="<?php echo $data['rootUrl']; ?>global/img/selected.png"/></div>
                                    <div id="apDiv2"><?php echo $data["bg"];?></div>
                                    <div id="apDiv3">Busch Gardens</div>
                                    <div id="apDiv4">
                                        <input type="checkbox" id="check6" name="check6" value="12,5" class="ck" />
                                        <label for="check6" id="check6_n" title="Click">ADD TO TOUR</label>
                                    </div>
                                </div>
                            <?php }?>
                        </td>
                        <td><div id="apDiv1" align="center" class="cursor">
                                <div class="checked_icono" id="check7_img"><img src="<?php echo $data['rootUrl']; ?>global/img/selected.png"/></div>
                                <div id="apDiv2"><?php echo $data["acuatica"];?></div>
                                <div id="apDiv3">Aquatica</div>
                                <div id="apDiv4">
                                    <input type="checkbox" id="check7" name="check7" value="13,5" class="ck" />
                                    <label for="check7" id="check7_n" title="Click">ADD TO TOUR</label>
                                </div>
                            </div>                                            </td>
                    </tr>
                </table>                                </td>
        </tr>
    </table>
</div>



<div id="universal-park" >
    <table  >
        <tr>
            <td><img src="<?php echo $data['rootUrl']; ?>global/img/universal-parks.png"/></td>
        </tr>
        <tr>
            <td>
                <table width="133" class="parks-group">
                    <tr>
                        <td width="42">
                            <div id="apDiv1" align="center" class="cursor">
                                <div class="checked_icono" id="check8_img"><img src="<?php echo $data['rootUrl']; ?>global/img/selected.png"/></div>
                                <div id="apDiv2"><?php echo $data["us"];?></div>
                                <div id="apDiv3" class="parksfont">Universal Studios</div>
                                <div id="apDiv4">
                                    <input type="checkbox" id="check8"  name="check8" value="14,6" class="ck" />
                                    <label for="check8" id="check8_n" title="Click">ADD TO TOUR</label>
                                </div>
                            </div>                                            </td>
                        <td width="42">
                            <div id="apDiv1" align="center" class="cursor">
                                <div class="checked_icono" id="check9_img"><img src="<?php echo $data['rootUrl']; ?>global/img/selected.png"/></div>
                                <div id="apDiv2"><?php echo $data["ua"];?></div>
                                <div id="apDiv3" class="parksfont">Island of Adventure</div>
                                <div id="apDiv4">
                                    <input type="checkbox" id="check9" name="check9" value="15,6" class="ck" />
                                    <label for="check9" id="check9_n" title="Click">ADD TO TOUR</label>
                                </div>
                            </div>                                            </td>
                    </tr>
                </table>                                </td>
        </tr>
    </table>
</div>



<div id="water-park" >
    <table>
        <tr>
            <td width="102" colspan="2"><img src="<?php echo $data['rootUrl']; ?>global/img/water-parks.png" alt=""/></td>
        </tr>
        <tr>
            <td><table width="104" class="parks-group">
                    <tr>
                        <td width="42">
                            <div id="apDiv1" align="center" class="cursor">
                                <div class="checked_icono" id="check10_img"><img src="<?php echo $data['rootUrl']; ?>global/img/selected.png"/></div>
                                <div id="apDiv2"><?php echo $data["ww"];?></div>
                                <div id="apDiv3" class="parksfont">Wet’n Wild</div>
                                <div id="apDiv4">
                                    <input type="checkbox" id="check10" name="check10" value="16,7" class="ck" />
                                    <label for="check10" id="check10_n" title="Click">ADD TO TOUR</label>
                                </div>
                            </div>                                            </td>
                        <td width="42">
                            <div id="apDiv1" align="center" class="cursor">
                                <div class="checked_icono" id="check11_img"><img src="<?php echo $data['rootUrl']; ?>global/img/selected.png"/></div>
                                <div id="apDiv2"><?php echo $data["bb"];?></div>
                                <div id="apDiv3" class="parksfont">Blizzard Beach</div>
                                <div id="apDiv4">
                                    <input type="checkbox" id="check11" name="check11" value="17,7" class="ck"/>
                                    <label for="check11" id="check11_n" title="Click">ADD TO TOUR</label>
                                </div>
                            </div>                                            </td>
                    </tr>
                </table>                                </td>
        </tr>
    </table>
</div>

<div id="historyc-park"  >
    <table >
        <tr>
            <td><img src="<?php echo $data['rootUrl']; ?>global/img/historic-parks.png" alt=""/></td>
        </tr>
        <tr>
            <td><table width="112" class="parks-group">
                    <tr>
                        <td width="59">
                            <div id="apDiv1" align="center" class="cursor">
                                <div class="checked_icono" id="check12_img"><img src="<?php echo $data['rootUrl']; ?>global/img/selected.png"/></div>
                                <div id="apDiv2"><?php echo $data["ks"];?></div>
                                <div id="apDiv3" class="parksfont">Kennedy Space Cter.</div>
                                <div id="apDiv4">
                                    <input type="checkbox" id="check12" name="check12" value="19,11" class="ck" />
                                    <label for="check12" id="check12_n" title="Click">ADD TO TOUR</label>
                                </div>
                            </div>                                            </td>
                        <td width="42">
                            <div id="apDiv1" align="center" class="cursor">
                                <div class="checked_icono" id="check13_img"><img src="<?php echo $data['rootUrl']; ?>global/img/selected.png"/></div>
                                <div id="apDiv2"><?php echo $data["hl"];?></div>
                                <div id="apDiv3" class="parksfont">Holy Land</div>
                                <div id="apDiv4">
                                    <input type="checkbox" id="check13" name="check13" value="20,12" class="ck" />
                                    <label for="check13" id="check13_n" title="Click">ADD TO TOUR</label>
                                </div>
                            </div>                                            </td>
                    </tr>
                </table>                                </td>
    </table>
</div>

<div id="after-park">
    <table >
        <tr>
            <td ><img src="<?php echo $data['rootUrl']; ?>global/img/afp.png" alt=""/></td>
        </tr>
        <tr>
            <td>
                <table class="parks-group">
                    <tr>
                        <td width="42" >
                            <div id="apDiv1" align="center" class="cursor">
                                <div class="checked_icono" id="check14_img"><img src="<?php echo $data['rootUrl']; ?>global/img/selected.png"/></div>
                                <div id="apDiv2"><?php echo $data["mt"];?></div>
                                <div id="apDiv3" class="parksfont">Medieval Times</div>
                                <div id="apDiv4">
                                    <input type="checkbox" id="check14"  name="check14" value="21,9" class="ck" />
                                    <label for="check14" id="check14_n" title="Click">ADD TO TOUR</label>
                                </div>
                            </div>                                            </td>
                        <td width="42">
                            <div id="apDiv1" align="center" class="cursor">
                                <div class="checked_icono" id="check15_img"><img src="<?php echo $data['rootUrl']; ?>global/img/selected.png"/></div>
                                <div id="apDiv2"><?php echo $data["cs"];?></div>
                                <div id="apDiv3" class="parksfont">Cirque du Soleil</div>
                                <div id="apDiv4">
                                    <input type="checkbox" id="check15" name="check15" value="22,9" class="ck" />
                                    <label for="check15" id="check15_n" title="Click">ADD TO TOUR</label>
                                </div>
                            </div>                                            </td>
                    </tr>
                </table>                                </td>
        </tr>
    </table>
</div>

<div id="fullday-park">
    <table >
        <tr>
            <td><img src="<?php echo $data['rootUrl']; ?>global/img/fdst.png" alt=""/></td>
        </tr>
        <tr>
            <td>
                <table class="parks-group">
                    <tr>
                        <td>
                            <div id="apDiv1" align="center" class="cursor">
                                <div class="checked_icono_outlet" id="check16_img"><img src="<?php echo $data['rootUrl']; ?>global/img/selected.png"/></div>
                                <div id="apDiv2"><?php echo $data["op"];?></div>
                                <div id="apDiv3" class="parksfont">Orlando Premium Outlet Mall</div>
                                <div id="apDiv4">
                                    <input type="checkbox" id="check16" name="check17" value="23,10" class="ck" />
                                    <label for="check16" id="check16_n" title="Click">ADD TO TOUR</label>
                                </div>
                            </div>                                            </td>
                    </tr>
                </table>                                </td>
        </tr>
    </table>
</div>

<div id="tip">
    <img src="<?php echo $data['rootUrl']; ?>global/img/tips.png" alt=""/>                    </div>
</div>            </td>
</tr>
</table>


</div>
<table width="100%" border="0">
    <tr>
        <td width="293">&nbsp;</td>
        <td width="912" style="font-size:20px;">


            Do you want to include admissions to the attractions for ONLY <span id="tikets" >$</span> per person per visit?
            <input name="question" type="radio" value="1"  id="resp1"/> Yes    <input name="question" type="radio" value="0" id="resp2" /> No</td>
    </tr>
</table>


<p align="right">
    <button  class="btn" id="btn-continue" onclick="bPreguntar = false;">Continue</button>
</p>

</form>

<div id="foot">

    <h4>Home   |   Our Company  |   My Superclub  |   Tickets Policy   &nbsp;|&nbsp;Baggage   | © 2012 Super Tours of Orlando Inc.<br />
        Copyright ©  1989 - 2012 Supertours Of  Orlando, INC . All Rights Reserved. </h4>
</div>
</div>

<div id="dialog-message" title="Number of parks" style="display:none;">
    <p>
        <span id="conten-mensaje" class="ui-icon ui-icon-circle-check" style="float:left; margin:0 7px 50px 0;"></span>
        You only have <?php echo $npar_dias; ?> tickets to parks
    </p>
</div>

<div id="dialog-message1" title="Ops!!" style="display:none;">
    <p>
        <span id="conten-mensaje" class="ui-icon ui-icon-circle-check" style="float:left; margin:0 7px 50px 0;"></span>
        This parks is not available for this dates. If you want to go to this park please
        Call Us to our Call Center and we will make all posible to take you there.
        1-800-251-4206.
    </p>
</div>

<div id="dialog-message5" title="AFTER PARKS SHOWS" style="display:none;">
    <p>
        <span id="conten-mensaje" class="ui-icon ui-icon-circle-check" style="float:left; margin:0 7px 50px 0;"></span>
        Before you continue remember can you add to your tours <?php echo ($toursbooking['noches']==1)?'1 attraction':'2 attractions'?> (AFTER PARKS SHOWS) of night
        <input type="hidden" id="mensaje_agregar_park_noces" value="0" />
    </p>
</div>

<div id="dialog-message6" title="PARKS ADMISSIONS" style="display:none;">
    <p>
        Do you want to include admissions to the attractions for ONLY <span id="tiketsMess" >$</span> per person per visit?
        <input type="hidden" name="admision-pregunta" id="admision-pregunta"  value="0" />
        <label><input type="radio" name="admision-radio-mensaje-yes" id="admision-radio-mensaje-yes"  value="1" />YES
        </label><input type="radio" name="admision-radio-mensaje-no" id="admision-radio-mensaje-no" value="0" />NO
    </p>
</div>


<div id="only"></div>



<div id="dialog-message4" title="Number of parks" style="display:none;">
    <p>
        <span class="ui-icon ui-icon-circle-check" style="float:left; margin:0 7px 50px 0;"></span>
        You are only entitled to <?php echo $toursbooking['noches']; ?> night park
    </p>

</div>

<div id="attractions">

</div>
</div>
</body>

<script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/booking.js"></script>
<!--<script src="<?php echo $data['rootUrl']; ?>global/js/modernizr.js"></script>-->
<script>

$(document).ready(function() {
    $('.galeria').nivoLightbox({ effect: 'fade' });
    $(".ck:checkbox:checked").removeAttr("checked");
    $("#resp1:radio:checked").removeAttr("checked");
    $("#resp2:radio:checked").removeAttr("checked");
    $("#admision-radio-mensaje-yes:radio:checked").removeAttr("checked");
    $("#admision-radio-mensaje-no:radio:checked").removeAttr("checked");
    $("#admision-pregunta").val(0);
    $("input","#rigthtour" ).button();

/*     
    window.onbeforeunload = preguntarAntesDeSalir;

    function preguntarAntesDeSalir()
    {
      if (bPreguntar)
        return "¿Seguro que quieres salir?";
    }
*/

});

function incluyeAdmision(){
    if( $(".ck:checkbox:checked").val())
    {

        if($('#resp1').is(":checked"))
        {
            var resp =  $('#resp1').val();
            $("#attractions").load('<?php echo $data['rootUrl']; ?>tours/question9/' + resp);
        }


        if($('#resp2').is(":checked"))
        {
            var resp =  $('#resp2').val();
            $("#attractions").load('<?php echo $data['rootUrl']; ?>tours/question9/' + resp);

        }

    }
    else
    {
        if($('#resp1').is(":checked"))
        {
            $('#tickes').html('INCLUDED in tour price ');
        }
        if($('#resp2').is(":checked"))
        {
            $('#tickes').html('NOT INCLUDED in tour price ');

        }
        alert("Select Your Parks");

    }
}

$('#admision-radio-mensaje-yes, #admision-radio-mensaje-no').change(function() {
    $('#dialog-message6').dialog( "close" );
    var resp = $(this).val();
    if(resp == 1){
        $('#resp1').attr('checked', true);
        $('#resp2').attr('checked', false);
        $('#tickes').html('INCLUDED in tour price ');
    }else{
        $('#resp1').attr('checked', false);
        $('#resp2').attr('checked', true);
        $('#tickes').html('NOT INCLUDED in tour price ');
    }
    incluyeAdmision();

});

$('#resp1,#resp2').change(function() {
    incluyeAdmision();
});


/*$("#dialog-message").css("display", "none");
$("#dialog-message1").css("display", "none");
$("#dialog-message2").css("display", "none");
$("#dialog-message4").css("display", "none");
$("#dialog-message5").css("display", "none");
$("#dialog-message6").css("display", "none");*/


$(function() {

    
});


var noch = <?php echo $toursbooking['noches']; ?>;
var sumando = 0;
$("#check14,#check15").change(function(){

    if($(this).is(":checked"))

    {
        if(sumando >= noch)
        {
            $(this).removeAttr("checked");


            $( "#dialog-message4" ).dialog({
                modal: true,
                buttons: {
                    Ok: function() {
                        $( this ).dialog( "close" );
                    }
                }
            });
            return false;
        }
        sumando++;
        var id = $(this).val();
        if($('#resp1').is(":checked"))
        {
            var resp =  $('#resp1').val();

        }
        else
        {
            var resp =  3;
        }
        $("#tqp").empty().html('<img src="<?php echo $data['rootUrl']; ?>global/img/ajax-loader.gif"  />');

        $("#attractions").load('<?php echo $data['rootUrl']; ?>tours/question7/' + id + '/' + resp);
        if(sumando > noch)
        {
            $(this).removeAttr("checked");


            $( "#dialog-message4" ).dialog({
                modal: true,
                buttons: {
                    Ok: function() {
                        $( this ).dialog( "close" );
                    }
                }
            });
        }
        checkbox(this,1);
    }

    if(!$(this).is(":checked"))
    {
        sumando--;
        var ides = $(this).val();
        if($('#resp1').is(":checked"))
        {
            var resp =  $('#resp1').val();

        }
        else
        {
            var resp = 3;
        }
        $("#tqp").empty().html('<img src="<?php echo $data['rootUrl']; ?>global/img/ajax-loader.gif"    />');
        $("#attractions").load('<?php echo $data['rootUrl']; ?>tours/question8/' + ides + '/' + resp);
        checkbox(this,0);
    }


});

var parcks = <?php echo $npar_dias;?>;

var suma = 0;



$('#check1,#check2,#check3,#check4,#check5,#check6,#check7,#check8,#check9,#check10,#check11,#check12,#check13,#check16').change(
    function() {



        if($(this).is(":checked") == true){

             if(suma >= parcks) {

                $(this).removeAttr("checked");


                $( "#dialog-message" ).dialog({
                    modal: true,
                    buttons: {
                        Ok: function() {
                            $( this ).dialog( "close" );
                        }
                    }
                });
                return false;
            }

            //alert('Esta agregando');
            suma++;
            var id = $(this).val();
            $("#tqp").empty().html('<img src="<?php echo $data['rootUrl']; ?>global/img/ajax-loader.gif"    />');
            if($('#resp1').is(":checked")){
                var resp =  $('#resp1').val();
            } else {
                var resp = 3;
        }

            $("#attractions").load('<?php echo $data['rootUrl']; ?>tours/question7/' + id + '/' + resp,function() {
                //alert( "Pausa" );
               
            });
           
           checkbox(this,1);
            
            
        }
        if($(this).is(":checked") == false)
        {
            //alert('Esta sacando');
           //$(this).attr("disabled", true);
            suma--;
            var ides = $(this).val();
            $("#tqp").empty().html('<img src="<?php echo $data['rootUrl']; ?>global/img/ajax-loader.gif"    />');																	 if($('#resp1').is(":checked"))
        {
            var resp =  $('#resp1').val();

        }
        else
        {
            var resp =  3;
        }
            //alert('entro2');
            $("#attractions").load('<?php echo $data['rootUrl']; ?>tours/question8/' + ides + '/' + resp,function() {
                 
            });
            //$(this).attr("disabled", false);
            checkbox(this,0);
        }
        //do something
  
  
     
    });
(function($){

    //cache nav


    //add indicator and hovers to submenu parents

})(jQuery);
$(this).find('.notFilled').first().focus();



$("#btn-continue").click(function(){

    if(!$('#resp1').is(":checked") && !$('#resp2').is(":checked"))
    {
        alert('Answer Question');
        return false;
    }

    if(!$(".ck:checkbox:checked").val())
    {
        alert('Select Your Parks');
        return false;

    }

    if(sumando == -10 && $( "#mensaje_agregar_park_noces" ).val()==0){
        document.getElementById('mensaje_agregar_park_noces').value = '1';
        $( "#dialog-message5" ).dialog({
            modal: true,
            width: 600,
            buttons: {
                Ok: function() {
                    $( this ).dialog( "close" );
                }
            }
        });
        return false;
    }
});

function checkbox(datos,agregar){
     var id_elemento = $(datos).attr("id");
     var agregando = agregar;
     
         if(agregando == 1){
             $("#"+id_elemento+"_img").css("display","block");
             $("#"+id_elemento+"_n").find("span").html("REMOVE");
         }else{
             $("#"+id_elemento+"_img").css("display","none");
             $("#"+id_elemento+"_n").find("span").html("ADD TO TOUR");
         } 
}
</script>

</html>
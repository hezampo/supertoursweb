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
<div id="logo" ><a href="<?php echo $data['rootUrl']; ?>"><img src="<?php echo $data['rootUrl']; ?>global/images/logo.png" width="316" height="119" /></a></div>
<div style="display:inline; float:right;">
    <a class="home img-link" href="<?php echo $data['rootUrl']; ?>" id="home">Home</a>
    <?php if(isset($_SESSION['user'])){ ?>
        <a class="logout img-link" href="<?php echo $data['rootUrl']; ?>close/session">Cerrar Session</a>
    <?php } ?>
</div>
<div id="redes">
    <div style="display:inline; float:right;">

        <div id="iconos">
            <div id="redesGo"></div>
            <div id="redesGo"><a href="https://www.facebook.com/pages/Supertours-of-Orlando/157301064337315" target="_blank"><img src="<?php echo $data['rootUrl']; ?>global/images/Icon-facebook-Colombia.png"  /></a></div>
            <div id="redesGo"><a href="<?php echo $data['rootUrl']; ?>contact-us-supertours"><img src="<?php echo $data['rootUrl']; ?>global/images/Icon-gmail-Colombia.png"  /></a></div>
        </div>
        <div class="textosHead" >Toll Free <b> 1-800-251-4206 </b>- Open <br />
            From 4 am To Midnight - (Eastern Time) <br />
            <strong>Hablamos Español</strong></div>
    </div>
</div>
<div id="barra">
    <?php
    include_once('global/menu/menu1.php');?>
</div>
<div id="policy">

<?php
if (isset($_SESSION["toursbooking"])) {
    $toursbooking = $_SESSION["toursbooking"];
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
                            <td align="center" ><font color="#FF0000"><span id="premiun">PREMIUM SCHEDULED</span></font></td>
                        </tr>
                        <tr>
                            <td align="center" ><samp>1 DAY TOUR</span></td>
                        </tr>
                        <tr>
                            <td height="30" align="center" style="padding:5px"><table>
                                    <tr align="center" valign="middle">
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
                                        <td width="258"><font class="bkfont"><?php echo date("l", strtotime($toursbooking['fecha_llegada'])); ?>,<? echo date("M", strtotime($toursbooking['fecha_llegada'])); ?> <? echo date("d", strtotime($toursbooking['fecha_llegada'])); ?>,<? echo date("Y", strtotime($toursbooking['fecha_llegada'])); ?></font>s</td>
                                    </tr>
                                    <tr valign="top">
                                        <td>Arriving:</td>
                                        <td><font class="bkfont">by <?php echo $toursbooking['service1']; ?> from Miami</font></td>
                                    </tr>
                                    <?php if(isset($toursbooking['trip1'])){?>

                                    <?php } ?>
                                </table></td>
                        </tr>
                    </table>
                </div>

                <div id="accomodation" class="bksep"></div>
                <div id="tours-price" class="bksep">
                    <table width="100%">
                        <tr>
                            <td colspan="2" class="booking-title" >LOCAL TRANSFERS TO PARKS&nbsp;</td>
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
                                        <td><span  id="tickes"><?php if(isset($_SESSION ['toursbooking'] ['especial'])){ if($_SESSION ['toursbooking'] ['especial'] == true){echo "INCLUDED in tour price";}}?></span></td>
                                    </tr>
                                    <tr valign="middle">
                                        <td>&nbsp;</td>
                                    </tr>
                                    <tr valign="middle">
                                        <td>&nbsp;</td>
                                    </tr>
                                </table>
                                    
                            </td>
                        </tr>
                    </table>

                    <table width="100%">
                        <tr>
                            <td colspan="2" class="booking-title">  <span style="text-align:">DEPARTURE</span></td>
                        </tr>
                        <tr valign="top">
                            <td width="100%" height="64" style="padding:7px">
                                <table width="100%">
                                    <tr valign="top">
                                        <td width="100%">Departure Date:</td>
                                        <td width="100%"><font color="#FF0000"><?php echo date("l", strtotime($toursbooking['fecha_salida'])); ?>,<?php echo date("M", strtotime($toursbooking['fecha_salida'])); ?> <?php echo date("d", strtotime($toursbooking['fecha_salida'])); ?>,<?php echo date("Y", strtotime($toursbooking['fecha_salida'])); ?></font></td>
                                    </tr>
                                    <tr valign="top">
                                        <td>Departure:</td>
                                        <td><font color="#FF0000" >by <?php echo $toursbooking['service2']; ?> to Miami</font></td>
                                    </tr>

                                </table>
                            </td>
                        </tr>
                    </table>
        </tr>
    </table>
    <div id="tq" class="redondo">
        <div id="tqp-text">TOUR PRICE</div>
        <div id="tqp-text-2">PER PERSON (Including Taxes)</div>
        <div id="tqp">$<?php echo round($_SESSION['toursbooking']['tqp']);?></div>
</div>
</div>
<!-- fin buy ticket -->

<div id="rigthtour">
    <form action="<?php echo $data['rootUrl']; ?>tours/18" id="form1"  name="form" method="post">
        <table width="95%">
            <tr>
                <td width="69" id="schoice"><img src="<?php echo $data['rootUrl']; ?>global/img/paso2.png" /></td>
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
                                    <td colspan="4"><img src="<?php echo $data['rootUrl']; ?>global/img/wall-disney.png" /></td>
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
                                                            <label for="check1" id="check1_n">ADD TO TOUR</label>
                                                        </div>
                                                    </div>                                            </td>
                                                <td width="42">
                                                    <div id="apDiv1" align="center" class="cursor">
                                                        <div class="checked_icono" id="check2_img"><img src="<?php echo $data['rootUrl']; ?>global/img/selected.png"/></div>
                                                        <div id="apDiv2"><?php echo $data["epcot"];?></div>
                                                        <div id="apDiv3">Epcot</div>
                                                        <div id="apDiv4">
                                                            <input type="checkbox" id="check2" name="check2" value="8,4" class="ck"/>
                                                            <label for="check2" id="check2_n">ADD TO TOUR</label>
                                                        </div>
                                                    </div>                                            </td>
                                                <td width="42">
                                                    <div id="apDiv1" align="center" class="cursor">
                                                        <div class="checked_icono" id="check3_img"><img src="<?php echo $data['rootUrl']; ?>global/img/selected.png"/></div>
                                                        <div id="apDiv2"><?php echo $data["hs"];?></div>
                                                        <div id="apDiv3">Hollywood Studios</div>
                                                        <div id="apDiv4">
                                                            <input type="checkbox" id="check3"  name="check3" value="9,4" class="ck"/>
                                                            <label for="check3" id="check3_n">ADD TO TOUR</label>
                                                        </div>
                                                    </div>                                            </td>
                                                <td width="42">
                                                    <div id="apDiv1" align="center" class="cursor">
                                                        <div class="checked_icono" id="check4_img"><img src="<?php echo $data['rootUrl']; ?>global/img/selected.png"/></div>
                                                        <div id="apDiv2"><?php echo $data["animalk"];?></div>
                                                        <div id="apDiv3">Animal Kingdom</div>
                                                        <div id="apDiv4">
                                                            <input type="checkbox" id="check4"  name="check4" value="10,4" class="ck"/>
                                                            <label for="check4" id="check4_n">ADD TO TOUR</label>
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
                                                            <label for="check8" id="check8_n">ADD TO TOUR</label>
                                                        </div>
                                                    </div>                                            </td>
                                                <td width="42">
                                                    <div id="apDiv1" align="center" class="cursor">
                                                        <div class="checked_icono" id="check9_img"><img src="<?php echo $data['rootUrl']; ?>global/img/selected.png"/></div>
                                                        <div id="apDiv2"><?php echo $data["ua"];?></div>
                                                        <div id="apDiv3" class="parksfont">Island of Adventure</div>
                                                        <div id="apDiv4">
                                                            <input type="checkbox" id="check9" name="check9" value="15,6" class="ck" />
                                                            <label for="check9" id="check9_n">ADD TO TOUR</label>
                                                        </div>
                                                    </div>                                            </td>
                                            </tr>
                                        </table>                                </td>
                                </tr>
                            </table>
                        </div>
                        <table style="float:left;"><tr><td>
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
                                                                        <label for="check5" id="check5_n">ADD TO TOUR</label>
                                                                    </div>
                                                                </div>                                            </td>
                                                            <td><div id="apDiv1" align="center" class="cursor">
                                                                    <div class="checked_icono" id="check7_img"><img src="<?php echo $data['rootUrl']; ?>global/img/selected.png"/></div>
                                                                    <div id="apDiv2"><?php echo $data["acuatica"];?></div>
                                                                    <div id="apDiv3">Aquatica</div>
                                                                    <div id="apDiv4">
                                                                        <input type="checkbox" id="check7" name="check7" value="13,5" class="ck" />
                                                                        <label for="check7" id="check7_n">ADD TO TOUR</label>
                                                                    </div>
                                                                </div>                                            </td>
                                                        </tr>
                                                    </table>                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </td>
                                <td>
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
                                                                        <label for="check10" id="check10_n">ADD TO TOUR</label>
                                                                    </div>
                                                                </div>                                            </td>
                                                            <td width="42">
                                                                <div id="apDiv1" align="center" class="cursor">
                                                                    <div class="checked_icono" id="check11_img"><img src="<?php echo $data['rootUrl']; ?>global/img/selected.png"/></div>
                                                                    <div id="apDiv2"><?php echo $data["bb"];?></div>
                                                                    <div id="apDiv3" class="parksfont">Blizzard Beach</div>
                                                                    <div id="apDiv4">
                                                                        <input type="checkbox" id="check11" name="check11" value="17,7" class="ck"/>
                                                                        <label for="check11" id="check11_n">ADD TO TOUR</label>
                                                                    </div>
                                                                </div>                                            </td>
                                                        </tr>
                                                    </table>                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </td>
                                <td>
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
                                                                        <label for="check12" id="check12_n">ADD TO TOUR</label>
                                                                    </div>
                                                                </div>                                            </td>
                                                            <td width="42">
                                                                <div id="apDiv1" align="center" class="cursor">
                                                                    <div class="checked_icono" id="check13_img"><img src="<?php echo $data['rootUrl']; ?>global/img/selected.png"/></div>
                                                                    <div id="apDiv2"><?php echo $data["hl"];?></div>
                                                                    <div id="apDiv3" class="parksfont">Holy Land</div>
                                                                    <div id="apDiv4">
                                                                        <input type="checkbox" id="check13" name="check13" value="20,12" class="ck" />
                                                                        <label for="check13" id="check13_n">ADD TO TOUR</label>
                                                                    </div>
                                                                </div>                                            </td>
                                                        </tr>
                                                    </table>                                </td>
                                        </table>
                                    </div>
                                </td>
                            </tr></table>
                </td>
            </tr>
        </table> </div>
<table width="100%" border="0">
    <?php if(isset($_SESSION ['toursbooking'] ['especial'])){
             if($_SESSION ['toursbooking'] ['especial'] == false){
                 
             
        ?>
    <tr>
        <td width="293">&nbsp;</td>
        <td width="912" style="font-size:20px;">Do you want to include admissions to the attractions for ONLY <span id="tikets" >$</span> per person per visit?
            <input name="question" type="radio" value="1"  id="resp1"/> Yes    <input name="question" type="radio" value="0" id="resp2" /> No</td>
    </tr>
    <?php }} else{
        
    ?>
    <tr>
        <td width="293">&nbsp;</td>
        <td width="912" style="font-size:20px;">Do you want to include admissions to the attractions for ONLY <span id="tikets" >$</span> per person per visit?
            <input name="question" type="radio" value="1"  id="resp1"/> Yes    <input name="question" type="radio" value="0" id="resp2" /> No</td>
    </tr>
    <?php }      
    ?>
    <tr>
        <td>&nbsp;</td>
        <td>
            <table width="100%">
                <tr>
                    <td width="50%"><a style="display:none" href="<?php echo $data['rootUrl'];?>one-day-tour"><button  class="btn" id="btn-back" >Back</button></a> </td>
                    <td width="50%" align="right"><button  class="btn" id="btn-continue">Continue</button></td>
                </tr>
            </table>
        </td>

    </tr>
</table>



</form>

<div id="foot">

    <h4>Home   |   Our Company  |   My Superclub  |   Tickets Policy   &nbsp;|&nbsp;Baggage   | © 2012 Super Tours of Orlando Inc.<br />
        Copyright ©  1989 - 2012 Supertours Of  Orlando, INC . All Rights Reserved. </h4>
</div>
</div>
<div id="dialog-message-new" style='display:none' title="Number of parks">
    <p>
        <span class="ui-icon ui-icon-circle-check" style="float:left; margin:0 7px 50px 0;"></span>
        For Kennedy Space Center you need a minimum of two people
    </p>
</div>

<div id="dialog-message" title="Number of parks">
    <p>
        <span class="ui-icon ui-icon-circle-check" style="float:left; margin:0 7px 50px 0;"></span>
        You only have <?php echo $toursbooking['dias']; ?> tickets to parks
    </p>
</div>
<?php if(isset($_SESSION ['toursbooking'] ['especial'])){
    if($_SESSION ['toursbooking'] ['especial'] == false){
    ?>
<div id="dialog-message6" title="PARKS ADMISSIONS">
    <p>
        Do you want to include admissions to the attractions for ONLY <span id="tiketsMess" >$</span> per person per visit?
        <input type="hidden" name="admision-pregunta" id="admision-pregunta"  value="0" />
        <label><input type="radio" name="admision-radio-mensaje-yes" id="admision-radio-mensaje-yes"  value="1" />YES
        </label><input type="radio" name="admision-radio-mensaje-no" id="admision-radio-mensaje-no" value="0" />NO
    </p>
</div>
<?php }}else{?>
<div id="dialog-message6" title="PARKS ADMISSIONS">
    <p>
        Do you want to include admissions to the attractions for ONLY <span id="tiketsMess" >$</span> per person per visit?
        <input type="hidden" name="admision-pregunta" id="admision-pregunta"  value="0" />
        <label><input type="radio" name="admision-radio-mensaje-yes" id="admision-radio-mensaje-yes"  value="1" />YES
        </label><input type="radio" name="admision-radio-mensaje-no" id="admision-radio-mensaje-no" value="0" />NO
    </p>
</div>
<?php }?>
<div id="dialog-message7" title="No Prices for the park!">
    <p>
        This park has not price configured for this date!! Sorry.
    </p>
</div>

<div id="only"></div>



<div id="dialog-message4" title="Numero de parques">
    <p>
        <span class="ui-icon ui-icon-circle-check" style="float:left; margin:0 7px 50px 0;"></span>
        Usted solo tiene derecho a  <?php echo $toursbooking['noches']; ?> nocturnos
    </p>

</div>
<div id="attractions">

</div>

</body>

<script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/booking.js"></script>
<script src="<?php echo $data['rootUrl']; ?>global/js/modernizr.js"></script>
<script>

    $(document).ready(function() {
        $('.galeria').nivoLightbox({ effect: 'fade' });
        $(".ck:checkbox:checked").removeAttr("checked");
        $("#resp1:radio:checked").removeAttr("checked");
        $("#resp2:radio:checked").removeAttr("checked");
    });

    $('#admision-radio-mensaje-yes, #admision-radio-mensaje-no').change(function() {
        $('#dialog-message6').dialog( "close" );
        var resp = $(this).val();
        if(resp == 1){
            $('#resp1').attr('checked', true);
            $('#resp2').attr('checked', false);
        }else{
            $('#resp1').attr('checked', false);
            $('#resp2').attr('checked', true);
        }
        incluyeAdmision();

    });

    $('#resp1,#resp2').change(function() {
        incluyeAdmision();
    });

    function incluyeAdmision(){
        if( $(".ck:checkbox:checked").val()){
            if($('#resp1').is(":checked")){
                var resp =  $('#resp1').val();
                $("#attractions").load('<?php echo $data['rootUrl']; ?>tours/onedaytour-tiquete/' + resp);
            }
            if($('#resp2').is(":checked")){
                var resp =  $('#resp2').val();
                $("#attractions").load('<?php echo $data['rootUrl']; ?>tours/onedaytour-tiquete/' + resp);
            }
        }else{
            if($('#resp1').is(":checked")){
                $('#tickes').html('INCLUDED in tour price ');
            }
            if($('#resp2').is(":checked")){
                $('#tickes').html('NO INCLUDED in tour price ');
            }
            alert("Select Your Parks");
        }
    }



    $("#dialog-message").css("display", "none");
    $("#dialog-message2").css("display", "none");
    $("#dialog-message4").css("display", "none");
    $("#dialog-message6").css("display", "none");
    $("#dialog-message7").css("display", "none");


    $(function() {$("input","#rigthtour" ).button(); });
    var parcks =1;// one park
    var suma = 0;
    var idPark = '';

    $('#check1,#check2,#check3,#check4,#check5,#check6,#check7,#check8,#check9,#check10,#check11,#check12,#check13,#check16').change(function() {
        var opc;
        if($(this).is(":checked") && idPark ==''){
            opc = 0;
            suma++;

            var id = $(this).val();
            $("#tqp").empty().html('<img src="<?php echo $data['rootUrl']; ?>global/img/ajax-loader.gif"    />')
            if($('#resp1').is(":checked")){
                var resp =  $('#resp1').val();
            } else {
                var resp = 3;
            }

            idPark = id;
            $("#attractions").load('<?php echo $data['rootUrl']; ?>tours/onedaytour-park/' + id + '/' + resp);
            if(suma > parcks) {
                $(this).removeAttr("checked");
                $( "#dialog-message" ).dialog({
                    modal: true,
                    buttons: {
                        Ok: function() {  $( this ).dialog( "close" );  }
                    }
                });
            }
            checkbox(this,1);
        }else if(!$(this).is(":checked")){
            var ides = $(this).val();
            if( idPark == ides){
                suma--;
                $("#tqp").empty().html('<img src="<?php echo $data['rootUrl']; ?>global/img/ajax-loader.gif"    />');																			      if($('#resp1').is(":checked")){
                    var resp =  $('#resp1').val();
                }else{
                    var resp =  3;
                }
                $("#attractions").load('<?php echo $data['rootUrl']; ?>tours/onedaytour-park2/' + ides + '/' + resp );
                idPark = '';
                checkbox(this,0);
            }
        }else{

            $( "#dialog-message" ).dialog({
                modal: true,
                buttons: {
                    Ok: function() {  $( this ).dialog( "close" );  }
                }
            });
            $(this).get(0).checked=false;
        }
    });

    (function($){

        //cache nav


        //add indicator and hovers to submenu parents

    })(jQuery);
    $(this).find('.notFilled').first().focus();



    $("#btn-continue").click(function(){
        <?php if(isset($_SESSION ['toursbooking'] ['especial'])){
                 if($_SESSION ['toursbooking'] ['especial'] == false){
            ?>
        if(!$('#resp1').is(":checked") && !$('#resp2').is(":checked"))
        {
            alert('Answer Question');
            return false;
        }
         <?php }}else{?>
             if(!$('#resp1').is(":checked") && !$('#resp2').is(":checked"))
        {
            alert('Answer Question');
            return false;
        }
         <?php }?>
        if(!$(".ck:checkbox:checked").val())
        {
            alert('Select Your Parks');
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
                    
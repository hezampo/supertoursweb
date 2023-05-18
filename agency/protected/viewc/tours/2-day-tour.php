
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

    <link rel="stylesheet" href="<?php echo $data['rootUrl']; ?>global/css/nav.css">

    <link rel="stylesheet" type="text/css" href="<?php echo $data['rootUrl']; ?>global/css/jquery.notice.css"/>


    <script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/jquery.min.js"  language="javascript"></script>
    <script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/jquery-ui.min.js"></script>
    <script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/jquery.tipTip.js"></script>
    <script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/jquery.tipTip.minified.js"></script>

    <script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/jquery-ui-timepicker-addon.js"></script>
    <script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/jquery-ui-sliderAccess.js"></script>

    <script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/jquery.ddslick.min.js"></script>
    <script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/jquery.validator.js"></script>
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
            var dd = $('.dd-option');
            //$(dd[0]).trigger('click');

            $(dd[0]).click(function () {
                $('#buffet').hide();
            });

            $(dd[1]).click(function () {
                $('#buffet').hide();
            });

            $(dd[2]).click(function () {
                $('#buffet').hide();
            });

            $('#btn-continue').click(function (event) {
                if($('input.btns').is(':checked')){
                    location.href = '/supertoursface2/tours/2';
                }
                else{
                    alert('Please first select a hotel!');
                    return false;
                }
            });

            $('#buffet').hide();
            $('#capacidad').hide();

            $('.dd-option').click(function (){
                $("#tqp").html('$');
                $("#namehotel").html("");
                $("#roomss").html("");
                $("#desayuno").html("");
            });


        });



    </script>

    <style>
        .notFilled{
            border: 2px solid #f00;
            background: #f99;
        }
        input.error
        {
            border: solid 1px red;
            color: Red;
        }
        #ht{
            display:none;}


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
    <div id="logo" ><a href="<?php echo $data['rootUrl']; ?>"><img src="<?php echo $data['rootUrl']; ?>global/images/logo.png" width="316" height="119" border="0" /></a></div>
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
            <strong>Hablamos Español</strong></div> </div>
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



<div id="contendinfo">
    <div id="mapmarcohome">
        <div id="contenidohometours"><br />
            <form action="<?php echo $data['rootUrl']; ?>tours/2" id="form" name="form" method="post" >
                <div id="toursajax2" align="left">
                    <table class="separatours2" width="100%" border="0" cellpadding="0" >
                        <tr>
                            <td  align="center" width="23%" rowspan="4" valign="top">
                                <table width="190" border="0" class="redondo" id="toursbooking">
                                    <tr valign="top">
                                        <td width="190">
                                            <table border="0" class="redondo" id="toursbooking2" >
                                                <tr>
                                                    <td width="190" >
                                                        <div>
                                                            <table width="100%">
                                                                <tr>
                                                                    <td align="left"><div class="booking-title"><img src="<?php echo $data['rootUrl']; ?>global/img/yourtour.png"/></div></td>
                                                                </tr>
                                                                <tr>
                                                                    <td align="center" ><font color="#FF0000"><span id="premiun"><?php
                                                                                if($_SESSION ['toursbooking']['question']==1)
                                                                                    echo 'PREMIUM SHEDULED';
                                                                                else
                                                                                    echo 'PRIVATE SERVICE';
                                                                                ?></span></font></td>
                                                                </tr>
                                                                <tr align="center" valign="middle">
                                                                    <td height="66">
                                                                        <table>
                                                                            <tr align="center" valign="middle">
                                                                                <td>Tour Length:</td>
                                                                            </tr>
                                                                            <tr align="center" valign="middle">
                                                                                <td colspan="2"><font color="#FF0000"><?php echo $toursbooking['dias']; ?> </font>Days <font color="#FF0000"> <? echo $toursbooking['noches']; ?></font> Nights</td>
                                                                            </tr>
                                                                        </table>                                                                                                </td>
                                                                </tr>
                                                            </table>
                                                        </div>

                                                        <div>
                                                            <table width="190">
                                                                <tr>
                                                                    <td colspan="2" class="booking-title">  <span style="text-align:">ARRIVAL</span></td>
                                                                </tr>
                                                                <tr valign="top">
                                                                    <td width="190" style="padding:7px"><table width="190">
                                                                            <tr valign="top">
                                                                                <td width="84">Arrival Date:</td>
                                                                                <td width="145"><font color="#FF0000"><?php echo date("l", strtotime($toursbooking['fecha_llegada'])); ?>,<? echo date("M", strtotime($toursbooking['fecha_llegada'])); ?> <? echo date("d", strtotime($toursbooking['fecha_llegada'])); ?>,<? echo date("Y", strtotime($toursbooking['fecha_llegada'])); ?></font></td>
                                                                            </tr>
                                                                            <tr valign="top">
                                                                                <td>Arriving:</td>
                                                                                <td><font color="#FF0000" ><?php if($_SESSION['toursbooking']['sarrival']==1 || $_SESSION['toursbooking']['sarrival']==2){
                                                                                            echo 'by '.$toursbooking['service1'] .' from Miami';
                                                                                        }else{
                                                                                            echo 'by '.$toursbooking['service1'] ;
                                                                                        }?></font></td>
                                                                            </tr>
                                                                            <?php if(isset($toursbooking['trip1'])){?>
                                                                            <?php } ?>
                                                                        </table>                                                                                          </td>
                                                                </tr>
                                                            </table>
                                                            <table width="190" >
                                                                <tr>
                                                                    <td colspan="2" class="booking-title">  <span style="text-align:">ACCOMMODATION</span></td>
                                                                </tr>
                                                                <tr valign="top">
                                                                    <td width="190" height="68" style="padding:7px"><table width="190">
                                                                            <tr valign="top">
                                                                                <td><span id="namehotel" style="font-size:9px;" class="clean" ></span></font></td>
                                                                            </tr>
                                                                            <tr valign="top">
                                                                                <td><span id="roomss" style="font-size:9px;" class="clean" ></span></td>
                                                                            </tr>
                                                                            <tr valign="top">
                                                                                <td><span id="desayuno" style="font-size:9px;" class="clean"></span></td>
                                                                            </tr>

                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                            </table><table width="190">
                                                                <tr>
                                                                    <td colspan="2" class="booking-title">  <span style="text-align:">DEPARTURE</span></td>
                                                                </tr>
                                                                <tr valign="top">
                                                                    <td width="190" height="64" style="padding:7px"><table width="190">
                                                                            <tr valign="top">
                                                                                <td width="105">Departure Date:</td>
                                                                                <td width="124"><font color="#FF0000"><? echo date("l", strtotime($toursbooking['fecha_salida'])); ?>,<? echo date("M", strtotime($toursbooking['fecha_salida'])); ?> <? echo date("d", strtotime($toursbooking['fecha_salida'])); ?>,<? echo date("Y", strtotime($toursbooking['fecha_salida'])); ?></font></td>
                                                                            </tr>
                                                                            <tr valign="top">
                                                                                <td>Departure:</td>
                                                                                <td><font color="#FF0000" > <?php
                                                                                        if($_SESSION['toursbooking']['sdeparture']==1 || $_SESSION['toursbooking']['sdeparture']==2){
                                                                                            echo 'by '.$toursbooking['service2'] .' To Miami';
                                                                                        }else{
                                                                                            echo 'by '.$toursbooking['service2'] ;
                                                                                        }?>         </font></td>
                                                                            </tr>

                                                                        </table></td>
                                                                </tr>
                                                            </table>
                                                        </div>

                                                        <div>
                                                            <table>
                                                                <tr>
                                                                    <td width="auto">                                                                                          </td>
                                                                </tr>
                                                            </table>
                                                        </div>                                                                              </tr>
                                            </table></td >
                                    </tr>

                                </table>
                                <div id="tq" class="redondo">
                                    <div id="tqp-text">TOUR PRICE</div>
                                    <div id="tqp-text-2">PER PERSON (Including Taxes)</div>
                                    <div id="tqp">$</div></div>
                </div>
                <!-- fin buy ticket -->                                                       </td>
                <td width="1%" height="42">&nbsp;</td>
                <td width="4%"> <img src="<?php echo $data['rootUrl']; ?>global/img/paso2.png"  />&nbsp;</td>
                <td colspan="2" id="schoice">&nbsp; Please select your Hotel in Orlando.</td>
                <td width="2%">&nbsp;</td>
                <td width="200px">&nbsp;</td>
                </tr>
               <!-- <tr>
                    <td height="19" colspan="5">&nbsp;</td>
                    <td height="19">&nbsp;</td>
                </tr>-->
                <tr>
                    <td height="50">&nbsp;</td>
                    <td height="50" colspan="2">How many rooms You will need</td>
                    <td width="35%">
                        <select name="rooms" id="rooms" class="tours-list">
                            <option value="1" >1 Room</option>
                            <option value="2">2 Rooms</option>
                            <option value="3">3 Rooms</option>
                            <option value="4">4 Rooms</option>
                        </select>                                                          </td>
                    <td colspan="2"><select name="select" id="select1" ></select></td>
                </tr>

                <tr>
                    <td height="62">&nbsp;</td>
                    <td height="170" colspan="7"><div id="selectos"></div><table width="100%" border="0">
                            <tr>
                                <td></td>
                            </tr>
                            <tr>
                                <td height="87"><div id="hotels" align="center" ></div></td>
                            </tr>
                            <tr>
                                <td height="21">
                                    <div id="buffet" title="This hotel does not include breakfast"><table width="100%" border="0" cellspacing="1"><tr><td width="22%"><img src="<? echo Doo::conf()->APP_URL; ?>global/images/desayunob.jpg" width="150px;" heigth="50px;"/></td><td colspan="2">&nbsp;</td><td width="76%">Do you want to include SUPER BREAKFAST BUFFET in your Hotel?<label></label><label><br /><input type="radio" name="buffet" id="buffet"  class="buff" value="1" />YES</label><input type="radio" name="buffet" class="buff" id="buffet" value="0" />NO</td></tr></table></div>

                                    <div id="capacidad" title="Trip capacity exceeded"><table width="100%" border="0" cellspacing="1"><tr><td><br />
                                                    <span id="txtCapacidad" style="font-size:16px; font: Tahoma, Geneva, sans-serif"></span>
                                                </td></tr></table></div>
                                    <p align="right">
                                        <button  class="btn" id="btn-continue">Continue</button>
                                    </p></td>
                            </tr>
                           <!-- <tr>
                                <td height="177">&nbsp;</td>
                            </tr>-->
                        </table></td>
                </tr>
                </table>
                <br />


            </form>

        </div>


    </div>




</div>
<div id="foot">
    <h4>Home   |   Our Company  |   My Superclub  |   Tickets Policy   &nbsp;|&nbsp;Baggage   | © 2012 Super Tours of Orlando Inc.<br />
        Copyright ©  1989 - 2012 Supertours Of  Orlando, INC . All Rights Reserved.  </h4>
</div>



</div>


<div id="roomsdistri">
</div>


<div id="dialog" title="This hotel does not include breakfast" style="display:none;">

    <table width="100%" border="0">
        <tr>
            <td width="129" height="111"><img src="<?php echo $data['rootUrl']; ?>global/images/desayunob.jpg" width="128" height="108" /></td>
            <td width="759">Do you want to include SUPER BREAKFAST BUFFET in your Hotel? <br /></td>
        </tr>
    </table>


</div>
<div id="dialog-message-t" title="Ops!!" style="display:none;">
    <p>
        <span id="conten-mensaje" class="ui-icon ui-icon-circle-check" style="float:left; margin:0 7px 50px 0;"></span>
        This hotel is not available for this dates. If you want to go to this hotel please
        Call Us to our Call Center and we will make all posible to take you there.
        1-800-251-4206.
    </p>
</div>

<script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/booking.js"></script>
<!--<script src="<?php echo $data['rootUrl']; ?>global/js/modernizr.js"></script>-->

<script>


    $(document).ready(function() {
        
        var id = $("#rooms").val();

        $("#selectos").load('<?php echo $data['rootUrl']; ?>tours/question4/' + id);});

        /*$("#hotels").empty().html('<img src="<?php echo $data['rootUrl']; ?>global/images/loading.gif"   width="300px" height="250" id="gif"/>');
            //alert(id);
        $("#hotels").load('<?php echo $data['rootUrl']; ?>tours/question33/0/0' );*/
   // $("#dialog").css("display", "none");

    $("#rooms").change(function(){
        var id = $("#rooms").val();
        $("#tqp").html('$');
        $("#namehotel").html("");
        $("#roomss").html("");
        $("#desayuno").html("");
        $( ".btns" ).button( "destroy" );
        $( ".btns").attr("checked", false);
        $( ".btns").attr("checked", false);

        $( ".btns" ).button();
        $("#selectos").load('<?php echo $data['rootUrl']; ?>tours/question4/' + id);
        $( ".ui-button-text").html("REQUEST");

    });

    $(".buff").change(function(){
        var id = $(this).val();
        $('#buffet').dialog('close');
        $(".buff").attr("checked",false);

    });


    var ddData = [
        {
            text: "TOURIST",
            value: 2,
            selected: false,
            description: "Free Breackfast",
            imageSrc: "<?php echo $data['rootUrl']; ?>global/img/2.png"
        },
        {
            text: "SUPERIOR",
            value: 3,
            selected: false,
            description: "",
            imageSrc: "<?php echo $data['rootUrl']; ?>global/img/3.png"
        },
        {
            text: "FIRST CLASS",
            value: 4,
            selected: false,
            description: "",
            imageSrc: "<?php echo $data['rootUrl']; ?>global/img/4.png"
        }
    ];

    $('#select1').ddslick({
        data: ddData,
        width: 200,
        imagePosition: "right",
        selectText: "Select Hotel Category",
        onSelected: function (data) {
            
            var id = data.selectedData.value;
            $("#hotels").empty().html('<img src="<?php echo $data['rootUrl']; ?>global/images/loading.gif"   width="300px" height="250" id="gif"/>');
            //alert(id);
            $("#hotels").load('<?php echo $data['rootUrl']; ?>tours/question3/' + id );


        }
    });


    $(this).find('.notFilled').first().focus();
    $(document).ready(function(){
        $('form').validator();
    });
    $('#rooms').blur(function() {
        $(this).removeClass('notFilled');
    });



</script>

</body>
</html>

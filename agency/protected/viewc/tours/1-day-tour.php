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
    <script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/jquery.timeentry.js"></script>
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
        });
        function fechaRetorno(menor){
            var d = new Date(menor);
            d.setTime( d.getTime()+1*24*60*60*1000 )
            $('#fecha_retorno').datepicker('option', 'minDate',d );
        }

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
        .nodisponible{
            color:#F00;
            font-style:oblique;
            text-decoration: underline;
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
        <div id="logo"><a href="<?php echo $data['rootUrl']; ?>"><img src="<?php echo $data['rootUrl']; ?>global/images/logo.png" width="316" height="119" border="0" /></a></div>

        <div style="display:inline; float:right;">
            <a class="home img-link" href="<?php echo $data['rootUrl']; ?>" id="home">Home</a>
            <?php if(isset($_SESSION['user'])){ ?>
                <a class="logout img-link" href="<?php echo $data['rootUrl']; ?>close/session">Cerrar Session</a>
            <?php } ?>
        </div>

        <div id="redes">

            <div id="iconos"  >

                <div id="redesGo" ></div><div id="redesGo"><a href="https://www.facebook.com/pages/Supertours-of-Orlando/157301064337315" target="_blank"><img src="<?php echo $data['rootUrl']; ?>global/images/Icon-facebook-Colombia.png"  border="0" /></a></div><div id="redesGo"><a href="<?php echo $data['rootUrl']; ?>contact-us-supertours"><img src="<?php echo $data['rootUrl']; ?>global/images/Icon-gmail-Colombia.png"  border="0" /></a></div></div>
            <div class="textosHead" >Toll Free <b> 1-800-251-4206 </b>- Open <br />
                From 4 am To Midnight - (Eastern Time) <br />
                <strong>Hablamos Español</strong></div> </div>
    </div>
    <div id="barra">
        <?php
        include_once('global/menu/menu1.php');?>
    </div>

    <form action="<?php echo $data['rootUrl']; ?>tours/1" id="form" method="post" >
        <div id="policy">

            <div id="contendinfo">
                <div id="mapmarcohome">
                    <div id="contenidohometours">
                        <div>
                            <table width="100%" cellpadding="0" cellspacing="0" >
                                <tr>
                                    <td valign="top" id="Informacion">
                                        <table width="306" border="0" class="redondo" id="toursbooking" style="height:100%;">
                                            <tr valign="top">
                                                <td width="300" height="173"><table border="0" class="redondo" id="toursbooking2"  >
                                                        <tr>
                                                            <td width="292" ><div>
                                                                    <table width="100%">
                                                                        <tr>
                                                                            <td align="left"><div class="booking-title"><img src="<?php echo $data['rootUrl']; ?>global/img/yourtour.png"/></div></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td align="center" ><font color="#FF0000"><span id="premiun">PREMIUM SCHEDULED</span></font></td>
                                                                        </tr>
                                                                        <tr align="center" valign="middle">
                                                                            <td height="66"><table width="100%">
                                                                                    <tr align="center" valign="middle">
                                                                                        <td>Tour Length:</td>
                                                                                    </tr>
                                                                                    <tr align="center" valign="middle">
                                                                                        <td colspan="2"><span id="dias"></span> Days / <span id="noches"></span> Nights</td>
                                                                                    </tr>
                                                                                </table>
                                                                                <table align="left" width="100%" border="0" cellspacing="1">
                                                                                    <tr align="left">
                                                                                        <td width="90">ARRIVAL</td>
                                                                                        <td width="156">&nbsp;</td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td align="left"><span id="arrival0" style="font-size:9px;"></span></td>
                                                                                        <td align="left"><font size="-2"><span id="arrival1" style="font-size:9px;"></span></font></td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td align="left"><span id="arrival2" style="font-size:9px;"></span></td>
                                                                                        <td><font size="-2"><span id="arrival3" style="font-size:9px;"></span></font></td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td align="left">&nbsp;</td>
                                                                                        <td>&nbsp;</td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td align="left" >DEPARTURE</td>
                                                                                        <td>&nbsp;</td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td align="left"><span id="departure0" style="font-size:9px;"></span></td>
                                                                                        <td align="left"><font size="-2"><span id="departure1" style="font-size:9px;"></span></font></td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td align="left" ><span id="departure2" style="font-size:9px;"></span></td>
                                                                                        <td align="left"><font size="-2"><span id="departure3" style="font-size:9px;"></span></font></td>
                                                                                    </tr>
                                                                                </table>
                                                                                <p>&nbsp;</p></td>
                                                                        </tr>
                                                                    </table>
                                                                </div>
                                                                <div></div>
                                                                <div>
                                                                    <table>
                                                                        <tr>
                                                                            <td width="auto"></td>
                                                                        </tr>
                                                                    </table>
                                                                </div></td>
                                                        </tr>
                                                    </table></td >
                                            </tr>
                                        </table>
                                    </td>
                                    <td width="5">&nbsp;</td>
                                    <td valign="top" >
                                        <table width="100%">
                                            <tr>
                                                <td>
                                                    <table width="100%">
                                                        <tr>
                                                            <td width="10%" height="61"><img src="<?php echo $data['rootUrl']; ?>global/images/step1.jpg" /></td>
                                                            <td width="63%" align="left" id="schoice">Please complete this important information about your travel party.</td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <table width="100%">
                                                        <tr>
                                                            <td rowspan="3" width="10%">
                                                            </td>
                                                            <td colspan="6" style="padding:7px"><strong>Select if you want shared or private transportation </strong></td>
                                                        </tr>
                                                        <tr>
                                                            <td width="67%" height="28"><input type="radio" name="question" id="rest1" value="1"    checked="checked" /><label for="rest1" >
                                                                    Red Carpet Premium Class Scheduled  Tours</label></td>

                                                        </tr>
                                                        <tr>
                                                            <td><input type="radio" name="question"  id="rest2" value="2"    />
                                                                <label for="rest2" > Platinum VIP  Private Service Taylored To Your Request</label>
                                                            </td>

                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div id="toursajax">
                                                        <br />

                                                        <table width="100%" border="0"  >
                                                            <tr>
                                                                <td >&nbsp;</td>
                                                                <td align="center" ><strong>Tour Starting Date</strong></td>
                                                                <td>&nbsp;</td>
                                                                <td align="center"><strong>Tour Ending Date</strong></td>
                                                            </tr>
                                                            <tr>
                                                                <td height="30" >&nbsp;</td>
                                                                <td align="center" ><table width="110" border="0" align="center">
                                                                        <tr>
                                                                            <td width="60"><input name="fecha_salida" type="text" id="fecha_salida" size="10"  class="required" onchange="
                                      fechaRetorno(this.value);" /></td>
                                                                            <td width="124"><a href="" id="dataclick1" ><img border="0"  src="<?php echo $data['rootUrl'];  ?>global/images/calendar.png" /></a></td>
                                                                        </tr>
                                                                    </table></td>
                                                                <td>&nbsp;</td>
                                                                <td align="center"><table width="110" border="0">
                                                                        <tr>
                                                                            <td width="60"><input name="fecha_retorno" type="text" id="fecha_retorno" size="10" class="required"  /></td>
                                                                            <td width="124"><a href="" id="dataclick2" ><img  src="<?php echo $data['rootUrl']; ?>global/images/calendar.png" /></a></td>
                                                                        </tr>
                                                                    </table></td>
                                                            </tr>
                                                            <tr>
                                                                <td width="103" >
                                                                    <div class="demo-live" ></div>        </td>
                                                                <td width="356" >
                                                                    <select disabled="disabled" name="select1" id="select1" >
                                                                    </select>

                                                                    <input type="hidden" value="-1" id="indexSelect1" name="indexSelect1" />
                                                                </td>
                                                                <td width="50">&nbsp;</td>
                                                                <td width="381" align="center">
                                                                    <select name="select2" id="select2" disabled="disabled">
                                                                    </select>  <input type="hidden" value="-1" id="indexSelect2" name="indexSelect2" />    </td>
                                                            </tr>
                                                            <tr height="200">
                                                                <td colspan="2" width="47%" align="center"><div id="conte" ></div><div id="pickups" ></div></td>
                                                                <td width="1%" align="center"><img src="<?php echo $data['rootUrl']; ?>global/img/vertical_line.png" height=""/></td>
                                                                <td colspan="2" width="47%" align="center"><div id="conte2" ></div><div id="pickups2" ></div></td>
                                                            </tr>
                                                            <tr><td colspan="6" align="right">
                                                                    <button  class="btn" id="btn-continue">Continue</button>
                                                                </td>
                                                            </tr>
                                                        </table>
    </form> </div>
</td>
</tr>
</table>
</td>
</tr>
</table>
</div>

<div id="lefttours">
</div>


<span id="platium"></span>


</div>
<div id="foot">
    <h4>Home   |   Our Company  |   My Superclub  |   Tickets Policy   &nbsp;|&nbsp;Baggage   | © 2012 Super Tours of Orlando Inc.<br />
        Copyright ©  1989 - 2012 Supertours Of  Orlando, INC . All Rights Reserved.  </h4>
</div>



</div>




<script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/booking.js"></script>
<script src="<?php echo $data['rootUrl']; ?>global/js/modernizr.js"></script>
<script>
$(function(){
    $(".someClass").tipTip({maxWidth: "auto", edgeOffset: 10});
});

$("#fecha_salida").change(function(){
    var fecha_salida = $('#fecha_salida').val();
    if(!Validar(fecha_salida)){
        $('#fecha_salida').focus();
        $('#fecha_salida')
    }else{
        var fecha_retorno = $('#fecha_retorno').val();
        if(Validar(fecha_retorno)){
            $("#platium").load('<?php echo $data['rootUrl']; ?>tours/question12/' + fecha_salida + '/' + fecha_retorno);
            if($("#indexSelect1").val() != -1){
                selectTrip1();
            }
        }
    }
});
$("#fecha_retorno").change(function(){
    var fecha_retorno = $('#fecha_retorno').val();
    if(!Validar(fecha_retorno)){
        $('#fecha_retorno').focus();
    }else{
        var fecha_salida = $('#fecha_salida').val();
        if(Validar(fecha_salida)){
            $("#platium").load('<?php echo $data['rootUrl']; ?>tours/question12/' + fecha_salida + '/' + fecha_retorno);
            if($("#indexSelect1").val() != -1){
                selectTrip1();
            }
        }
        $("#select1").focus();
    }
});


$('#rest1').change(function() {
    var id = $(this).val();
    $("#conte").empty().html('<img src="<?php echo $data['rootUrl']; ?>global/images/loading.gif"   width="300px" height="250" id="gif"/>');
    $("#conte2").empty().html('<img src="<?php echo $data['rootUrl']; ?>global/images/loading.gif"   width="300px" height="250" id="gif"/>');
    $("#platium").load('<?php echo $data['rootUrl']; ?>tours/question11/' + id);

});

$('#rest2').change(function() {
    var id = $(this).val();
    $("#conte").empty().html('<img src="<?php echo $data['rootUrl']; ?>global/images/loading.gif"   width="300px" height="250" id="gif"/>');
    $("#conte2").empty().html('<img src="<?php echo $data['rootUrl']; ?>global/images/loading.gif"   width="300px" height="250" id="gif"/>');
    $("#platium").load('<?php echo $data['rootUrl']; ?>tours/question11/' + id);

});

var ddData = [
    {
        text: "Super Tours Bus",
        value: 1,
        selected: false,
        description: "BY SUPER TOURS BUS FROM MIAMI?",
        imageSrc: "<?php echo $data['rootUrl']; ?>global/img/BUS2.png"
    },
    {
        text: "Airport (Transfer In)",
        value: 1,
        selected: false,
        description: "BY PLANE AT ORLANDO INT'L AIRPORT (TRANSFER IN)?",
        imageSrc: "<?php echo $data['rootUrl']; ?>global/img/icon-plane.png"
    },
    {
        text: "By Car",
        value: 1,
        selected: false,
        description: "BY CAR?",
        imageSrc: "<?php echo $data['rootUrl']; ?>global/img/car.png"
    }
];

var ddData1 = [
    {
        text: "Super Tours Bus",
        value: 2,
        selected: false,
        description: "BY SUPER TOURS BUS TO MIAMI?",
        imageSrc: "<?php echo $data['rootUrl']; ?>global/img/BUS2.png"
    },
    {
        text: "Airport (Transfer Out)",
        value: 2,
        selected: false,
        description: "BY PLANE AT ORLANDO INT'L AIRPORT (TRANSFER OUT)?",
        imageSrc: "<?php echo $data['rootUrl']; ?>global/img/icon-plane.png"
    },
    {
        text: "By Car",
        value: 2,
        selected: false,
        description: "BY CAR?",
        imageSrc: "<?php echo $data['rootUrl']; ?>global/img/car.png"
    }
];





$('#select1').ddslick({
    data: ddData,
    width: 300,
    imagePosition: "left",
    selectText: "Method of arrival to Orlando",
    onSelected: function (data) {
        var id = data.selectedIndex;
        $('#indexSelect1').val(id);
        selectTrip1();
    }

});



$('#select2').ddslick({
    data: ddData1,
    width: 300,
    imagePosition: "left",
    selectText: "Method of departure from Orlando",
    onSelected: function (data) {
        var id = data.selectedIndex;
        $('#indexSelect2').val(id);
        selectTrip2();
    }
});

function restar(dia1, mes1, ano1, dia2, mes2, ano2)    {        var fecha1 = new Date(ano1, mes1 - 1, dia1);        var fecha2 = new Date(ano2, mes2 - 1, dia2);        var resta = (fecha2 - fecha1) / 1000 / 3600 / 24;        return resta;            }    var f=new Date();    var dato = restar(26, 5, 2014, f.getDate(), f.getMonth(), f.getFullYear());



$( "#fecha_salida" ).datepicker({
    dateFormat:'mm-dd-yy',
    maxDate:         918 - dato,
    minDate:         0

});
$( "#fecha_retorno" ).datepicker({
    dateFormat:'mm-dd-yy',
    maxDate:         918 - dato,
    minDate:         3

});


$("#dataclick1").click(function(e) {



    e.preventDefault();



    $("#fecha_salida").datepicker("show");



});
$("#dataclick2").click(function(e) {



    e.preventDefault();



    $("#fecha_retorno").datepicker("show");



});

$(this).find('.notFilled').first().focus();
$(document).ready(function(){
    $('form').validator();
});

$('#fecha_salida').blur(function() {
    $(this).removeClass('notFilled');
});
$('#fecha_retorno').blur(function() {
    $(this).removeClass('notFilled');
});

$('#pax1').blur(function() {
    $(this).removeClass('notFilled');
});
$('#pax2').blur(function() {
    $(this).removeClass('notFilled');
});




function getItemChecked(parametro){

    var radios = document.getElementsByName(parametro);
    var valor = -1;

    for (var x=0; x < radios.length; x++) {
        if (radios[x].checked) {
            valor =  radios[x].value;
            break;
        }
    }

    return valor;
}



$("#btn-continue").click(function(){

    var texto1 = $("#select1").find('.dd-selected-text').html();
    var texto2 = $("#select2").find('.dd-selected-text').html();


    if( texto1 == "Super Tours Bus"){
        if((getItemChecked("trip1") < 0 )){

            alert('You must select the output trip');
            return false;
        }
    }
    if( texto2 == "Super Tours Bus"){
        if((getItemChecked("trip2") < 0 )){
            alert('You must select the return trip');
            return false;
        }
    }




    var id3 = $("#fecha_salida").val();
    var id4 = $("#fecha_retorno").val();

    var primera = Date.parse(id3); 
    var segunda = Date.parse(id4); 
 

    if(primera > segunda){
        
        $("#fecha_salida").addClass('notFilled');
        $("#fecha_salida").focus();
        return false;
    }

    var fecha_sal_arr = id3.split("-");
    var fecha_ret_arr = id4.split("-");

    if(fecha_sal_arr[0] == fecha_ret_arr[0]){
        if(parseInt(fecha_sal_arr[1]) == fecha_ret_arr[1]){
            $("#fecha_retorno").addClass('notFilled');
            $("#fecha_retorno").focus();
            return false;
        }
    }

    var contenido = $("#conte").html();
    if(contenido==""){
        return false;
    }

    (function($){
        $.fn.validator = function(opts){
            return $(this).submit(function(evt){
                $(this).find('.required').each(function(){
                    if ($(this).attr('value') == ''){
                        $(this).addClass('notFilled');

                        evt.preventDefault();
                    }
                });

                $(this).find('.notFilled').first().focus();
            });

        };

    })(jQuery);





});
function selectTrip1(){
    var id = $('#indexSelect1').val();
    var id2 = 1;
    var id3 = $("#fecha_salida").val();
    var id4 = $("#fecha_retorno").val();
    var respf1 = Validar(id3);
    var respf2 = true;
    $('#indexSelect1').val(id);
    $('#indexSelect2').val(id);
    if(respf1){ Validar(id4); }
    if(!respf1 || !respf2){
        if(!respf1){
            $("#fecha_salida").addClass('notFilled');
            return false;
        }else{
            $("#fecha_retorno").addClass('notFilled');
            return false;
        }
    }else{
        if(id == 0 | id3 == ""  | id4 == ""){
            if(id3 == ""){

                $("#fecha_salida").addClass('notFilled');
                return false;
            }

            if(id4 == ""){
                $("#fecha_retorno").addClass('notFilled');
                return false;
            }
        }

        if($('#rest2').is(":checked")){// Platinum
            var corte = 1;
        }else {  var corte = 0;  }

        if(id == 0 && id3 != ""  && id4 != ""){
            var id5 = 0;
            $("#conte").empty().html('<img src="<?php echo $data['rootUrl']; ?>global/images/loading.gif"   width="300px" height="250" id="gif"/>');
            $("#conte2").empty().html('<img src="<?php echo $data['rootUrl']; ?>global/images/loading.gif"   width="300px" height="250" id="gif"/>');
            $("#conte").load('<?php echo $data['rootUrl']; ?>tours/question2/' + id +'/' + id2 + '/' + id3 + '/' + corte );
            if(corte == 0){
                $("#platium").load('<?php echo $data['rootUrl']; ?>tours/question13/' + id3 + '/' + id5);
                id5 = 1;
                $("#platium").load('<?php echo $data['rootUrl']; ?>tours/question13/' + id4 + '/' + id5);
            }else{
                id5 = 2;
                $("#platium").load('<?php echo $data['rootUrl']; ?>tours/question13/' + id3 + '/' + id5);
                id5 = 3;
                $("#platium").load('<?php echo $data['rootUrl']; ?>tours/question13/' + id4 + '/' + id5);
            }

        }else{
            id++;
            div = document.getElementById('conte');
            div.style.display = 'block';

            div = document.getElementById('pickups');
            div.style.display = 'none';
            $("#conte").empty().html('<img src="<?php echo $data['rootUrl']; ?>global/images/loading.gif"   width="300px" height="250" id="gif"/>');
            if(corte == 1){
                $("#conte").load('<?php echo $data['rootUrl']; ?>tours/question/' + 1 +'/' + id2 + '/' + corte );
            }else{
                $("#conte").load('<?php echo $data['rootUrl']; ?>tours/question/' + id +'/' + id2 + '/' + corte );
            }


            if(id == 1){
                var id5 = 2;
            }
            if(id == 2){
                var id5 = 4;
            }
            if(id == 3){
                var id5 = 6;
            }
            $("#platium").load('<?php echo $data['rootUrl']; ?>tours/question13/' + id3 + '/' + id5);
            if(id == 1){
                var id5 = 3;
            }
            if(id == 2){
                var id5 = 5;
            }
            if(id == 3){
                var id5 = 7;
            }
            $("#platium").load('<?php echo $data['rootUrl']; ?>tours/question13/' + id4 + '/' + id5);
        }
    }
}

function selectTrip2(){
    var id =  $("#indexSelect2").val();
    var id2 = 2;
    var id3 = $("#fecha_retorno").val();

    if(id3 == ""){
        $("#fecha_retorno").addClass('notFilled');
        return false;
    }
    if($('#rest2').is(":checked")){
        var corte = 1;
    }else{
        var corte = 0;
    }
    if(id == 0){
        var id5 = 1;
        $("#conte2").empty().html('<img src="<?php echo $data['rootUrl']; ?>global/images/loading.gif"   width="300px" height="250" id="gif"/>');
        $("#conte2").load('<?php echo $data['rootUrl']; ?>tours/question2/' + id +'/' + id2 + '/' + id3 + '/' + corte );
        if(corte == 1){
            var id5 = 3;
        }
        $("#platium").load('<?php echo $data['rootUrl']; ?>tours/question13/' + id3 + '/' + id5);
    }else{
        id++;
        $("#conte2").empty().html('<img src="<?php echo $data['rootUrl']; ?>global/images/loading.gif"   width="300px" height="250" id="gif"/>');
        if(corte == 1){
            $("#conte2").load('<?php echo $data['rootUrl']; ?>tours/question/' + 1 +'/' + id2 + '/' + corte );
        }else{
            $("#conte2").load('<?php echo $data['rootUrl']; ?>tours/question/' + id +'/' + id2 + '/' + corte );
        }
        if(id == 2){ var id5 = 5; }
        if(id == 3){  var id5 = 7;  }
        $("#platium").load('<?php echo $data['rootUrl']; ?>tours/question13/' + id3 + '/' + id5);
    }
}


</script>


</body>
</html>

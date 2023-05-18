<?php $ratesroom = $data["ratesroom"]; ?>
<?php $tarifastrip = $data["tarifastrip"];?>
<?php $tarifasplane = $data["tarifasplane"];?>
<?php $tarifascar = $data["tarifascar"];
$data["type_rate"];

?>



<head>
    <link rel="stylesheet" type="text/css" href="<?php echo $data['rootUrl']; ?>global/themes/blitzer/jquery-ui-1.9.0.custom.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo $data['rootUrl']; ?>global/themes/blitzer/jquery-ui-1.9.0.custom.min.css" />
    <script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/jquery-ui-1.8.18.custom.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">

    <style>
        .info, .success, .warning, .error, .validation {
            border: 1px solid;
            margin: 10px 0px;
            /*padding:15px 10px 15px 50px;*/
            padding: 10px 10px 10px 30px;
            background-repeat: no-repeat;
            background-position: 10px center;
        }

        .error {
            color: #D8000C;
            background-color: #FFBABA;
            background-image: url('<?php echo $data['rootUrl']; ?>global/img/error.png');
        }
        .success {
            color: #4F8A10;
            background-color: #DFF2BF;
            background-image:url('<?php echo $data['rootUrl']; ?>global/img/error.png');
        }     

    </style>    
</head>
<?php if (isset($_GET['menssage'])) { ?>
    <?php if ($_GET['menssage'] == 'error') { ?>
        <div class="error">Error al Generar tarifas, intente nuevamente</div>
    <?php } else { ?>
        <div class="success">Guardado Correctamente</div>
    <?php } ?>

<?php } ?>
<div id="header_page" style="background:#F0F8FF;" >
    <div class="header2"> Room Rates [ <?php echo $data['dato']; ?> ]</div>
    <div  id="toolbar">

        <div class="toolbar-list">
            <ul>

                <li class="btn-toolbar" id="btn-save">
                    <a   class="link-button" id="btn-save">
                        <span class="icon-32-save" title="Nuevo" >&nbsp;</span>
                        Save
                    </a>
                </li>

                <li class="btn-toolbar" id="btn-cancel">
                    <a  class="link-button" >
                        <span class="icon-back" title="Editar" >&nbsp;</span>
                        Cancel
                    </a>
                </li>


            </ul>
            <div class="clear"></div>
        </div>
        <div class="clear"></div>
    </div>
</div>
<div id="content_page"style="background:#B0C4DE;" >
    <div id="serpare">    

        <fieldset>

            <form id="form1" class="form" action="<?php echo $data['rootUrl']; ?>admin/tours/room-rates/save" method="post" name="form1">


<!--                <div class="input" style="display: none;">
                    <label style="width:150px" class="required" id="l_trip_no">NAME CATEGORY: </label>
                    <select name="id_hotel">
                        <? foreach ($data["hotel"] as $e): ?>

                            <option value="<? echo $e['id']; ?>"  <? echo ($ratesroom->id_hotel == trim($e['id']) ? 'selected' : ''); ?>><? echo $e["nombre"]; ?></option>
                        <? endforeach; ?>
                    </select>
                </div>-->

   
<div style="" id="resultado"></div>
                <table border = "5" style="margin: 0 auto; margin-top: -2%;">
                    <tr style="background:#FF4500; color: #fff; ">

                        <th colspan="2">
                           <div class="">
                            <label style="width:120px; font-size: 125%;" class="required" id="l_trip_no"><b>TOUR NAME</b> </label>&nbsp; <i class="fa fa-table fa-2x"></i>&nbsp;
                                                        
                            <input type="text" tabindex="1" name="rate"  style="width: 180px;text-align: center;font-weight: bold;color:#0000FF;" autocomplete="off" onKeyUp="this.value=this.value.toUpperCase();" id="rate"value="<?php echo $ratesroom->rate; ?>"></th>

                           </div> 
                        </th>
                        <th colspan="2" >
                            <div class="" style="">
                                <label style="width:150px; font-weight: bold; font-size: 125%;" class="required" id="l_trip_no" ><b>START DATE</b> </label>&nbsp; <i class="fa fa-calendar fa-2x" aria-hidden="true"></i>&nbsp;
                                <input type="text" tabindex="2" name="fecha_ini" id="fecha_ini" size="35" maxlength="50" style="width: 130px;text-align: center;font-weight: bold;color:#0000FF;" required="required" value="<?php echo ($ratesroom->fecha_ini != "" ? date("m-d-Y", $ratesroom->fecha_ini) : ''); ?>"/>
                            </div>
                        </th>
                        <th colspan="2">
                            <div class="">
                                <label style="width:150px; font-weight: bold; font-size: 125%;" class="required" id="l_trip_no"><b>END DATE</b> </label>&nbsp; <i class="fa fa-calendar fa-2x" aria-hidden="true"></i>&nbsp;
                                <input type="text" tabindex="3" name="fecha_fin" id="fecha_fin" size="35" maxlength="50" style="width: 130px; text-align: center;font-weight: bold;color:#0000FF;" required="required" value="<?php echo ($ratesroom->fecha_fin != "" ? date("m-d-Y", $ratesroom->fecha_fin) : ''); ?>"/>
                            </div>
                        </th>
                        
                        <th colspan="3" style="font-size: initial;">
                         <i class="fa fa-usd" aria-hidden="true" > </i>&nbsp;Room(SPN)<br>
                         
                            V&nbsp;<input type="text" tabindex="4" onkeypress="return justNumbers(event);" name="schv" id="schv" size="25" maxlength="25" style="text-align: center; width: 55px;font-weight: bold;color:#000000;" autocomplete="off" value="<?php echo $ratesroom->schv; ?>" >
                            M&nbsp;<input type="text" tabindex="5" onkeypress="return justNumbers(event);" name="schm" id="schm" size="25" maxlength="25" style="text-align: center; width: 55px;font-weight: bold;color:#000000;" autocomplete="off" value="<?php echo $ratesroom->schm; ?>" >
                            
                        </th>
                        
                        <th colspan="" style="height: 54px;background:	#0174DF ; height: 54px; font-size: initial"> 
                            <i class="fa fa-bus fa-2x" aria-hidden="true"></i><br>Trip 100                            
                        </th>
                        <th colspan="" style="background: #3b5998;font-size: 135%; ">
                            Adult<input type="text" tabindex="118" onkeypress="return justNumbers(event);" name="trip100" id="trip100" size="25" maxlength="25" style="width: 50px; font-weight: bold;color:#000000;text-align: center; " autocomplete="off" value="<?php echo $ratesroom->trip100; ?>" >
                            Child<input type="text" tabindex="119" onkeypress="return justNumbers(event);" name="trip100c" id="trip100c" size="25" maxlength="25" style="width: 50px; font-weight: bold;color:#000000;text-align: center; " autocomplete="off" value="<?php echo $ratesroom->trip100c; ?>" >
                        </th>
                       
                    </tr>
                    <tr style="background: 	#4B0082;font-size: initial;color: #fff;">
                        <th style="text-align: center;">Tour Length</th>
                        <th style="width:95px">&nbsp;&nbsp;<i class="fa fa-h-square" aria-hidden="true"></i>&nbsp;&nbsp;<br>Hotel</th>
                        <th style="width:95px">&nbsp;&nbsp;<i class="fa fa-bed" aria-hidden="true"></i>&nbsp;&nbsp;<br>Single</th>
                        <th style="width:95px">&nbsp;&nbsp;<i class="fa fa-bed" aria-hidden="true"></i>&nbsp;<i class="fa fa-bed" aria-hidden="true"></i>&nbsp;&nbsp<br>Double</th>
                        <th style="width:135px">&nbsp;&nbsp;<i class="fa fa-bed" aria-hidden="true"></i>&nbsp;<i class="fa fa-bed" aria-hidden="true"></i>&nbsp;<i class="fa fa-bed" aria-hidden="true"></i>&nbsp;&nbsp;<br>Triple</th>
                        <th style="width:145px">&nbsp;&nbsp;<i class="fa fa-bed" aria-hidden="true"></i>&nbsp;<i class="fa fa-bed" aria-hidden="true"></i>&nbsp;<i class="fa fa-bed" aria-hidden="true"></i>&nbsp;<i class="fa fa-bed" aria-hidden="true"></i>&nbsp;&nbsp;Quad</th>
                        <th style="width:95px"><i class="fa fa-child" aria-hidden="true"></i>&nbsp;<br>Child (3-9)</th>
                        <th style="width:95px"><i  aria-hidden="true"></i>&nbsp;<i class="fa fa-sign-out" aria-hidden="true"></i><br>Free Day Adult</th>
                        <th style="width:95px"><i  aria-hidden="true"></i>&nbsp;<i class="fa fa-sign-out" aria-hidden="true"></i><br>Free Day Child</th>
                        
                        <td style="width:95px; background:#0174DF; color: #fff;  text-align: -webkit-center; "><i  aria-hidden="true"></i>&nbsp;<i class="fa fa-bus fa-2x" aria-hidden="true"></i><br><b>Trip 200</b></td>
                        <th style="width:95px; background:#3b5998;">
                        Adult<input type="text" tabindex="120" onkeypress="return justNumbers(event);" name="trip200" id="trip200" size="25" maxlength="25" style="width: 50px; font-weight: bold;color:#000000;text-align: center;" autocomplete="off" value="<?php echo $ratesroom->trip200; ?>"> 
                        Child<input type="text" tabindex="121" onkeypress="return justNumbers(event);" name="trip200c" id="trip200c" size="25" maxlength="25" style="width: 50px; font-weight: bold;color:#000000;text-align: center;" autocomplete="off" value="<?php echo $ratesroom->trip200c; ?>">
                        </th>                        
                    </tr>
                    <tr>
                        <td rowspan="2" style="width:110px; background: #008000;font-size: 120%; color: #fff;text-align: center;"><b>2 Days / 1 Night<br> 2 Parks</b></td>
                        <td style="text-align: center;background:  #D2E0E4;font-size: 125%;color: #000;"><b>VALUE</b></td>
                        <td style="text-align: center;background: #D2E0E4;font-size: 135%;color: #000;">&nbsp;<input type="text" tabindex="6" onkeypress="return justNumbers(event);" name="sgl" id="sgl" size="20" maxlength="20" style="width: 55px;font-weight: bold;color:#000000;text-align: center;" autocomplete="off" value="<?php echo $ratesroom->sgl; ?>"/></td>
                        <td style="text-align: center;background: #D2E0E4;font-size: 135%;color: #000;">&nbsp;<input type="text" tabindex="7" onkeypress="return justNumbers(event);" name="dbl" id="dbl" size="20" maxlength="20" style="width: 55px;font-weight: bold;color:#000000;text-align: center;" autocomplete="off" value="<?php echo $ratesroom->dbl; ?>"/></td>
                        <td style="text-align: center;background: #D2E0E4;font-size: 135%;color: #000;">&nbsp;<input type="text" tabindex="8" onkeypress="return justNumbers(event);" name="tpl" id="tpl" size="20" maxlength="25" style="width: 55px;font-weight: bold;color:#000000;text-align: center;" autocomplete="off" value="<?php echo $ratesroom->tpl; ?>"/></td>
                        <td style="text-align: center;background: #D2E0E4;font-size: 135%;color: #000;">&nbsp;<input type="text" tabindex="9" onkeypress="return justNumbers(event);" name="qua" id="qua" size="20" maxlength="20" style="width: 55px;font-weight: bold;color:#000000;text-align: center;" autocomplete="off" value="<?php echo $ratesroom->qua; ?>"/></td>
                        <td style="text-align: center;background: #D2E0E4;font-size: 135%;color: #000;">&nbsp;<input type="text" tabindex="10" onkeypress="return justNumbers(event);" name="chv21" id="chv21" size="25" maxlength="25" style="width: 55px;font-weight: bold;color:#000000;text-align: center;" autocomplete="off"  value="<?php echo $ratesroom->chv21; ?>" ></td>
                        <td style="text-align: center;background: #D2E0E4;font-size: 135%;color: #000;">&nbsp;<input type="text" tabindex="11" onkeypress="return justNumbers(event);" name="fdv_adult21" id="fdv_adult21" size="25" maxlength="25" style="width: 55px;font-weight: bold;color:#000000;text-align: center;" autocomplete="off"  value="<?php echo ($ratesroom->fdv_adult21); ?>" ></td>
                        <td style="text-align: center;background: #D2E0E4;font-size: 135%;color: #000;">&nbsp;<input type="text" tabindex="12" onkeypress="return justNumbers(event);" name="fdv_child21" id="fdv_child21" size="25" maxlength="25" style="width: 55px;font-weight: bold;color:#000000;text-align: center;" autocomplete="off"  value="<?php echo ($ratesroom->fdv_child21);  ?>" ></td>
                        
                        <th style="width:95px; background: #0174DF; color: #fff;font-size: initial;" rowspan="2"><i  aria-hidden="true"></i>&nbsp;<i class="fa fa-bus fa-2x"  aria-hidden="true"></i><br>Trip 300</th>
                    <th rowspan="2" style="text-align: center;background:#3b5998 ;font-size: 135%;color: #fff;">&nbsp;
                        Adult<input type="text" tabindex="122" onkeypress="return justNumbers(event);" name="trip300" id="trip300" size="25" maxlength="25" style="width: 50px; font-weight: bold;color:#000000;text-align: center;" autocomplete="off" value="<?php echo $ratesroom->trip300; ?>">
                        Child<input type="text" tabindex="123" onkeypress="return justNumbers(event);" name="trip300c" id="trip300c" size="25" maxlength="25" style="width: 50px; font-weight: bold;color:#000000;text-align: center;" autocomplete="off" value="<?php echo $ratesroom->trip300c; ?>">
                    </th>   
                    </tr>
                    <tr style="color: #fff;">
                        <td style="text-align: center;background: #0174DF;font-size: 125%;color: #fff;"><b>MODERATE</td>
                        <td style="text-align: center;background: #0174DF;font-size: 125%;color: #fff;">&nbsp;<input style="width: 55px;font-weight: bold;color:#000000;text-align: center;" type="text" tabindex="13" onkeypress="return justNumbers(event);" name="sglm" id="sglm" size="25" maxlength="25" autocomplete="off" value="<?php echo $ratesroom->sglm; ?>"/></td>
                        <td style="text-align: center;background: #0174DF;font-size: 125%;color: #fff;">&nbsp;<input style="width: 55px;font-weight: bold;color:#000000;text-align: center;" type="text" tabindex="14" onkeypress="return justNumbers(event);" name="dblm" id="dblm" size="25" maxlength="25" autocomplete="off" value="<?php echo $ratesroom->dblm; ?>"/></td>
                        <td style="text-align: center;background: #0174DF;font-size: 125%;color: #fff;">&nbsp;<input style="width: 55px;font-weight: bold;color:#000000;text-align: center;" type="text" tabindex="15" onkeypress="return justNumbers(event);" name="tplm" id="tplm" size="25" maxlength="25" autocomplete="off" value="<?php echo $ratesroom->tplm; ?>"/></td>
                        <td style="text-align: center;background: #0174DF;font-size: 125%;color: #fff;">&nbsp;<input style="width: 55px;font-weight: bold;color:#000000;text-align: center;" type="text" tabindex="16" onkeypress="return justNumbers(event);" name="quam" id="quam" size="25" maxlength="25" autocomplete="off" value="<?php echo $ratesroom->quam; ?>"/></td>
                        <td style="text-align: center;background: #0174DF;font-size: 125%;color: #fff;">&nbsp;<input type="text" tabindex="17" onkeypress="return justNumbers(event);" name="chm21" id="chm21" size="25" maxlength="25" style="width: 55px;font-weight: bold;color:#000000;text-align: center;" autocomplete="off" value="<?php echo $ratesroom->chm21; ?>" ></td>
                        <td style="text-align: center;background: #0174DF;font-size: 135%;color: #fff;">&nbsp;<input type="text" tabindex="18" onkeypress="return justNumbers(event);" name="fdm_adult21" id="fdm_adult21" size="25" maxlength="25" style="width: 55px;font-weight: bold;color:#000000;text-align: center;" autocomplete="off" value="<?php echo $ratesroom->fdm_adult21; ?>" ></td>
                        <td style="text-align: center;background: #0174DF;font-size: 135%;color: #fff;">&nbsp;<input type="text" tabindex="19" onkeypress="return justNumbers(event);" name="fdm_child21" id="fdm_child21" size="25" maxlength="25" style="width: 55px;font-weight: bold;color:#000000;text-align: center;" autocomplete="off" value="<?php echo $ratesroom->fdm_child21;  ?>" ></td>
                        
                        
                        
                    </tr>
                    <tr>
                        <td rowspan="2" style="background: #0174DF;font-size: 120%; color: #fff;text-align: center;"><b>3 Days / 2 Nights<br> 3 Parks</b></td>
                        <td style="text-align: center;background: #D2E0E4;font-size: 125%;color: #000;"><b><b>VALUE</b></td>
                        <td style="text-align: center;background: #D2E0E4;font-size: 125%;color: #000;">&nbsp;<input type="text" tabindex="20" onkeypress="return justNumbers(event);" name="sgl2" style="width: 55px;font-weight: bold;color:#000000;text-align: center;" id="sgl2" size="25" maxlength="25" autocomplete="off" value="<?php echo $ratesroom->sgl2; ?>"/></td>
                        <td style="text-align: center;background: #D2E0E4;font-size: 125%;color: #000;">&nbsp;<input type="text" tabindex="21" onkeypress="return justNumbers(event);" name="dbl2" style="width: 55px;font-weight: bold;color:#000000;text-align: center;" id="dbl2" size="25" maxlength="25" autocomplete="off" value="<?php echo $ratesroom->dbl2; ?>"/></td>
                        <td style="text-align: center;background: #D2E0E4;font-size: 125%;color: #000;">&nbsp;<input type="text" tabindex="22" onkeypress="return justNumbers(event);" name="tpl2" style="width: 55px;font-weight: bold;color:#000000;text-align: center;" id="tpl2" size="25" maxlength="25" autocomplete="off" value="<?php echo $ratesroom->tpl2; ?>"/></td>
                        <td style="text-align: center;background: #D2E0E4;font-size: 125%;color: #000;">&nbsp;<input type="text" tabindex="23" onkeypress="return justNumbers(event);" name="qua2" style="width: 55px;font-weight: bold;color:#000000;text-align: center;" id="qua2" size="25" maxlength="25" autocomplete="off" value="<?php echo $ratesroom->qua2; ?>"/></td>
                        <td style="text-align: center;background: #D2E0E4;font-size: 125%;color: #000;">&nbsp;<input type="text" tabindex="24" onkeypress="return justNumbers(event);" name="chv32" id="chv32" size="25" maxlength="25" style="width: 55px;font-weight: bold;color:#000000;text-align: center;"  autocomplete="off" value="<?php echo $ratesroom->chv32; ?>" ></td>
                        <td style="text-align: center;background: #D2E0E4;font-size: 135%;color: #000;">&nbsp;<input type="text" tabindex="25" onkeypress="return justNumbers(event);" name="fdv_adult32" id="fdv_adult32" size="25" maxlength="25" style="width: 55px;font-weight: bold;color:#000000;text-align: center;" autocomplete="off" value="<?php echo $ratesroom->fdv_adult32; ?>" ></td>
                        <td style="text-align: center;background: #D2E0E4;font-size: 135%;color: #000;">&nbsp;<input type="text" tabindex="26" onkeypress="return justNumbers(event);" name="fdv_child32" id="fdv_child32" size="25" maxlength="25" style="width: 55px;font-weight: bold;color:#000000;text-align: center;" autocomplete="off" value="<?php echo $ratesroom->fdv_child32;  ?>" ></td>

                        <th style="width:95px; background: #0174DF; color: #fff;font-size: initial" rowspan="2"><i  aria-hidden="true"></i>&nbsp;<i class="fa fa-bus fa-2x" aria-hidden="true"></i><br>Trip 101</th>
                        <th rowspan="2" style="text-align: center;background:#3b5998;font-size: 135%;color: #fff;">&nbsp;
                            Adult<input type="text" tabindex="124" onkeypress="return justNumbers(event);" name="trip101" id="trip101" size="25" maxlength="25" style="width: 50px; font-weight: bold;color:#000000;text-align: center;" autocomplete="off" value="<?php echo $ratesroom->trip101; ?>" >
                            Child<input type="text" tabindex="125" onkeypress="return justNumbers(event);" name="trip101c" id="trip101c" size="25" maxlength="25" style="width: 50px; font-weight: bold;color:#000000;text-align: center;" autocomplete="off" value="<?php echo $ratesroom->trip101c; ?>" >
                        </th>
                    </tr>
                    <tr>
                        <td style="text-align: center;background: #0174DF;font-size: 125%;color: #fff;"><b>MODERATE</td>
                        <td style="text-align: center;background: #0174DF;font-size: 125%;color: #fff;">&nbsp;<input style="width: 55px;font-weight: bold;color:#000000;text-align: center;" type="text" tabindex="27" onkeypress="return justNumbers(event);" name="sglm2" id="sglm2" size="25" maxlength="25" autocomplete="off" value="<?php echo $ratesroom->sglm2; ?>"/></td>
                        <td style="text-align: center;background: #0174DF;font-size: 125%;color: #fff;">&nbsp;<input style="width: 55px;font-weight: bold;color:#000000;text-align: center;" type="text" tabindex="28" onkeypress="return justNumbers(event);" name="dblm2" id="dblm2" size="25" maxlength="25" autocomplete="off" value="<?php echo $ratesroom->dblm2; ?>"/></td>
                        <td style="text-align: center;background: #0174DF;font-size: 125%;color: #fff;">&nbsp;<input style="width: 55px;font-weight: bold;color:#000000;text-align: center;" type="text" tabindex="29" onkeypress="return justNumbers(event);" name="tplm2" id="tplm2" size="25" maxlength="25" autocomplete="off" value="<?php echo $ratesroom->tplm2; ?>"/></td>
                        <td style="text-align: center;background: #0174DF;font-size: 125%;color: #fff;">&nbsp;<input style="width: 55px;font-weight: bold;color:#000000;text-align: center;" type="text" tabindex="30" onkeypress="return justNumbers(event);" name="quam2" id="quam2" size="25" maxlength="25" autocomplete="off" value="<?php echo $ratesroom->quam2; ?>"/></td>
                        <td style="text-align: center;background: #0174DF;font-size: 125%;color: #fff;">&nbsp;<input type="text" tabindex="31" onkeypress="return justNumbers(event);" name="chm32" id="chm32" size="25" maxlength="25" style="width: 55px;font-weight: bold;color:#000000;text-align: center;"  autocomplete="off" value="<?php echo $ratesroom->chm32; ?>" ></td>
                        <td style="text-align: center;background: #0174DF;font-size: 135%;color: #fff;">&nbsp;<input type="text" tabindex="32" onkeypress="return justNumbers(event);" name="fdm_adult32" id="fdm_adult32" size="25" maxlength="25" style="width: 55px;font-weight: bold;color:#000000;text-align: center;" autocomplete="off" value="<?php echo $ratesroom->fdm_adult32; ?>" ></td>
                        <td style="text-align: center;background: #0174DF;font-size: 135%;color: #fff;">&nbsp;<input type="text" tabindex="33" onkeypress="return justNumbers(event);" name="fdm_child32" id="fdm_child32" size="25" maxlength="25" style="width: 55px;font-weight: bold;color:#000000;text-align: center;" autocomplete="off" value="<?php echo $ratesroom->fdm_child32; ?>" ></td>
                        
                        
                        
                    </tr>
                    <tr>
                        <td rowspan="2" style="background: #008000;font-size: 120%; color: #fff;text-align: center;"><b>4 Days / 3 Nights<br> 4 Parks</b></td>
                        <td style="text-align: center;background: #D2E0E4;font-size: 125%;color: #000;"><b>VALUE</td>
                        <td style="text-align: center;background: #D2E0E4;font-size: 125%;color: #000;">&nbsp;<input type="text" tabindex="34" onkeypress="return justNumbers(event);" name="sgl3" style="width: 55px;font-weight: bold;color:#000000;text-align: center;" id="sgl3" size="25" maxlength="25" autocomplete="off" value="<?php echo $ratesroom->sgl3; ?>"/></td>
                        <td style="text-align: center;background: #D2E0E4;font-size: 125%;color: #000;">&nbsp;<input type="text" tabindex="35" onkeypress="return justNumbers(event);" name="dbl3" style="width: 55px;font-weight: bold;color:#000000;text-align: center;" id="dbl3" size="25" maxlength="25" autocomplete="off" value="<?php echo $ratesroom->dbl3; ?>"/></td>
                        <td style="text-align: center;background: #D2E0E4;font-size: 125%;color: #000;">&nbsp;<input type="text" tabindex="36" onkeypress="return justNumbers(event);" name="tpl3" style="width: 55px;font-weight: bold;color:#000000;text-align: center;" id="tpl3" size="25" maxlength="25" autocomplete="off" value="<?php echo $ratesroom->tpl3; ?>"/></td>
                        <td style="text-align: center;background: #D2E0E4;font-size: 125%;color: #000;">&nbsp;<input type="text" tabindex="37" onkeypress="return justNumbers(event);" name="qua3" style="width: 55px;font-weight: bold;color:#000000;text-align: center;" id="qua3" size="25" maxlength="25" autocomplete="off" value="<?php echo $ratesroom->qua3; ?>"/></td>
                        <td style="text-align: center;background: #D2E0E4;font-size: 125%;color: #000;">&nbsp;<input type="text" tabindex="38" onkeypress="return justNumbers(event);" name="chv43" id="chv43" size="25" maxlength="25" style="width: 55px;font-weight: bold;color:#000000;text-align: center;"  autocomplete="off" value="<?php echo $ratesroom->chv43; ?>" ></td>
                        <td style="text-align: center;background: #D2E0E4;font-size: 135%;color: #000;">&nbsp;<input type="text" tabindex="39" onkeypress="return justNumbers(event);" name="fdv_adult43" id="fdv_adult43" size="25" maxlength="25" style="width: 55px;font-weight: bold;color:#000000;text-align: center;" autocomplete="off" value="<?php echo $ratesroom->fdv_adult43; ?>" ></td>
                        <td style="text-align: center;background: #D2E0E4;font-size: 135%;color: #000;">&nbsp;<input type="text" tabindex="40" onkeypress="return justNumbers(event);" name="fdv_child43" id="fdv_child43" size="25" maxlength="25" style="width: 55px;font-weight: bold;color:#000000;text-align: center;" autocomplete="off" value="<?php  echo $ratesroom->fdv_child43; ?>" ></td>
                        
                        <th style="width:95px; background: #0174DF; color: #fff; font-size: initial" rowspan="2"><i  aria-hidden="true"></i>&nbsp;<i class="fa fa-bus fa-2x" aria-hidden="true"></i><br>Trip 201</th>
                        <th rowspan="2" style="text-align: center;background:#3b5998;font-size: 135%;color: #fff;">&nbsp;
                            Adult<input type="text" tabindex="126" onkeypress="return justNumbers(event);" name="trip201" id="trip201" size="25" maxlength="25" style="width: 50px; font-weight: bold;color:#000000;text-align: center;" autocomplete="off" value="<?php echo $ratesroom->trip201; ?>" >
                            Child<input type="text" tabindex="127" onkeypress="return justNumbers(event);" name="trip201c" id="trip201c" size="25" maxlength="25" style="width: 50px; font-weight: bold;color:#000000;text-align: center;" autocomplete="off" value="<?php echo $ratesroom->trip201c; ?>" >
                        </th>
                    </tr>
                    <tr>
                        <td style="text-align: center;background: #0174DF;font-size: 125%;color: #fff;"><b>MODERATE</td>
                        <td style="text-align: center;background: #0174DF;font-size: 125%;color: #fff;">&nbsp;<input style="width: 55px;font-weight: bold;color:#000000;text-align: center;" type="text" tabindex="41" onkeypress="return justNumbers(event);" name="sglm3" id="sglm3" size="25" maxlength="25" autocomplete="off" value="<?php echo $ratesroom->sglm3; ?>"/></td>
                        <td style="text-align: center;background: #0174DF;font-size: 125%;color: #fff;">&nbsp;<input style="width: 55px;font-weight: bold;color:#000000;text-align: center;" type="text" tabindex="42" onkeypress="return justNumbers(event);" name="dblm3" id="dblm3" size="25" maxlength="25" autocomplete="off" value="<?php echo $ratesroom->dblm3; ?>"/></td>
                        <td style="text-align: center;background: #0174DF;font-size: 125%;color: #fff;">&nbsp;<input style="width: 55px;font-weight: bold;color:#000000;text-align: center;" type="text" tabindex="43" onkeypress="return justNumbers(event);" name="tplm3" id="tplm3" size="25" maxlength="25" autocomplete="off" value="<?php echo $ratesroom->tplm3; ?>"/></td>
                        <td style="text-align: center;background: #0174DF;font-size: 125%;color: #fff;">&nbsp;<input style="width: 55px;font-weight: bold;color:#000000;text-align: center;" type="text" tabindex="44" onkeypress="return justNumbers(event);" name="quam3" id="quam3" size="25" maxlength="25" autocomplete="off" value="<?php echo $ratesroom->quam3; ?>"/></td>
                        <td style="text-align: center;background: #0174DF;font-size: 125%;color: #fff;">&nbsp;<input type="text" tabindex="45" onkeypress="return justNumbers(event);" name="chm43" id="chm43" size="25" maxlength="25" style="width: 55px;font-weight: bold;color:#000000;text-align: center;"  autocomplete="off" value="<?php echo $ratesroom->chm43; ?>" ></td>
                        <td style="text-align: center;background: #0174DF;font-size: 135%;color: #fff;">&nbsp;<input type="text" tabindex="46" onkeypress="return justNumbers(event);" name="fdm_adult43" id="fdm_adult43" size="25" maxlength="25" style="width: 55px;font-weight: bold;color:#000000;text-align: center;" autocomplete="off" value="<?php echo $ratesroom->fdm_adult43; ?>" ></td>
                        <td style="text-align: center;background: #0174DF;font-size: 135%;color: #fff;">&nbsp;<input type="text" tabindex="47" onkeypress="return justNumbers(event);" name="fdm_child43" id="fdm_child43" size="25" maxlength="25" style="width: 55px;font-weight: bold;color:#000000;text-align: center;" autocomplete="off" value="<?php echo $ratesroom->fdm_child43; ?>" ></td>
                        
              
                    </tr>
                    <tr>
                        <td rowspan="2" style="background: #0174DF; font-size: 120%;color: #fff;text-align: center;"><b>5 Days / 4 Nights<br> 5 Parks</b></td>
                        <td style="text-align: center;background: #D2E0E4;font-size: 125%;color: #000;"><b>VALUE</td>
                        <td style="text-align: center;background: #D2E0E4;font-size: 125%;color: #000;">&nbsp;<input style="width: 55px;font-weight: bold;color:#000000;text-align: center;" type="text" tabindex="48" onkeypress="return justNumbers(event);" name="sgl4" id="sgl4" size="25" maxlength="25" autocomplete="off" value="<?php echo $ratesroom->sgl4; ?>"/></td>
                        <td style="text-align: center;background: #D2E0E4;font-size: 125%;color: #000;">&nbsp;<input style="width: 55px;font-weight: bold;color:#000000;text-align: center;" type="text" tabindex="49" onkeypress="return justNumbers(event);" name="dbl4" id="dbl4" size="25" maxlength="25" autocomplete="off" value="<?php echo $ratesroom->dbl4; ?>"/></td>
                        <td style="text-align: center;background: #D2E0E4;font-size: 125%;color: #000;">&nbsp;<input style="width: 55px;font-weight: bold;color:#000000;text-align: center;" type="text" tabindex="50" onkeypress="return justNumbers(event);" name="tpl4" id="tpl4" size="25" maxlength="25" autocomplete="off" value="<?php echo $ratesroom->tpl4; ?>"/></td>
                        <td style="text-align: center;background: #D2E0E4;font-size: 125%;color: #000;">&nbsp;<input style="width: 55px;font-weight: bold;color:#000000;text-align: center;" type="text" tabindex="51" onkeypress="return justNumbers(event);" name="qua4" id="qua4" size="25" maxlength="25" autocomplete="off" value="<?php echo $ratesroom->qua4; ?>"/></td>
                        <td style="text-align: center;background: #D2E0E4;font-size: 125%;color: #000;">&nbsp;<input type="text" tabindex="52" onkeypress="return justNumbers(event);" name="chv54" id="chv54" size="25" maxlength="25" style="width: 55px;font-weight: bold;color:#000000;text-align: center;"  autocomplete="off" value="<?php echo $ratesroom->chv54; ?>" ></td>
                        <td style="text-align: center;background: #D2E0E4;font-size: 135%;color: #000;">&nbsp;<input type="text" tabindex="53" onkeypress="return justNumbers(event);" name="fdv_adult54" id="fdv_adult54" size="25" maxlength="25" style="width: 55px;font-weight: bold;color:#000000;text-align: center;" autocomplete="off"  value="<?php echo $ratesroom->fdv_adult54; ?>" ></td>
                        <td style="text-align: center;background: #D2E0E4;font-size: 135%;color: #000;">&nbsp;<input type="text" tabindex="54" onkeypress="return justNumbers(event);" name="fdv_child54" id="fdv_child54" size="25" maxlength="25" style="width: 55px;font-weight: bold;color:#000000;text-align: center;" autocomplete="off" value="<?php  echo $ratesroom->fdv_child54; ?>" ></td>
                        
                        <th style="width:95px; background: #0174DF; color: #fff; font-size: initial;" rowspan="2"><i  aria-hidden="true"></i>&nbsp;<i class="fa fa-bus fa-2x" aria-hidden="true"></i><br>Trip 301</th>
                        <th rowspan="2" style="text-align: center;background:#3b5998;font-size: 135%;color: #fff;">&nbsp;
                            Adult<input type="text" tabindex="128" onkeypress="return justNumbers(event);" name="trip301" id="trip301" size="25" maxlength="25" style="width: 50px; font-weight: bold;color:#000000;text-align: center;" autocomplete="off" value="<?php echo $ratesroom->trip301; ?>" >
                            Child<input type="text" tabindex="129" onkeypress="return justNumbers(event);" name="trip301c" id="trip301c" size="25" maxlength="25" style="width: 50px; font-weight: bold;color:#000000;text-align: center;" autocomplete="off" value="<?php echo $ratesroom->trip301c; ?>" >
                        </th>
                    </tr>
                    <tr>
                        <td style="text-align: center;background: #0174DF;font-size: 125%;color: #fff;"><b>MODERATE</td>
                        <td style="text-align: center;background: #0174DF;font-size: 125%;color: #fff;">&nbsp;<input style="width: 55px;font-weight: bold;color:#000000;text-align: center;" type="text" tabindex="55" onkeypress="return justNumbers(event);" name="sglm4" id="sglm4" size="25" maxlength="25" autocomplete="off" value="<?php echo $ratesroom->sglm4; ?>"/></td>
                        <td style="text-align: center;background: #0174DF;font-size: 125%;color: #fff;">&nbsp;<input style="width: 55px;font-weight: bold;color:#000000;text-align: center;" type="text" tabindex="56" onkeypress="return justNumbers(event);" name="dblm4" id="dblm4" size="25" maxlength="25" autocomplete="off" value="<?php echo $ratesroom->dblm4; ?>"/></td>
                        <td style="text-align: center;background: #0174DF;font-size: 125%;color: #fff;">&nbsp;<input style="width: 55px;font-weight: bold;color:#000000;text-align: center;" type="text" tabindex="57" onkeypress="return justNumbers(event);" name="tplm4" id="tplm4" size="25" maxlength="25" autocomplete="off" value="<?php echo $ratesroom->tplm4; ?>"/></td>
                        <td style="text-align: center;background: #0174DF;font-size: 125%;color: #fff;">&nbsp;<input style="width: 55px;font-weight: bold;color:#000000;text-align: center;" type="text" tabindex="58" onkeypress="return justNumbers(event);" name="quam4" id="quam4" size="25" maxlength="25" autocomplete="off" value="<?php echo $ratesroom->quam4; ?>"/></td>
                        <td style="text-align: center;background: #0174DF;font-size: 125%;color: #fff;">&nbsp;<input type="text" tabindex="59" onkeypress="return justNumbers(event);" name="chm54" id="chm54" size="25" maxlength="25" style="width: 55px;font-weight: bold;color:#000000;text-align: center;"  autocomplete="off" value="<?php echo $ratesroom->chm54; ?>" ></td>
                        <td style="text-align: center;background: #0174DF;font-size: 135%;color: #fff;">&nbsp;<input type="text" tabindex="60" onkeypress="return justNumbers(event);" name="fdm_adult54" id="fdm_adult54" size="25" maxlength="25" style="width: 55px;font-weight: bold;color:#000000;text-align: center;" autocomplete="off" value="<?php echo $ratesroom->fdm_adult54; ?>" ></td>
                        <td style="text-align: center;background: #0174DF;font-size: 135%;color: #fff;">&nbsp;<input type="text" tabindex="61" onkeypress="return justNumbers(event);" name="fdm_child54" id="fdm_child54" size="25" maxlength="25" style="width: 55px;font-weight: bold;color:#000000;text-align: center;" autocomplete="off" value="<?php echo $ratesroom->fdm_child54; ?>" ></td>
                        
                        
                    </tr>
                    <tr>
                        <td rowspan="2" style="background: #008000;font-size: 120%; color: #fff;text-align: center;"><b>6 Days / 5 Nights<br> 6 Parks</b></td>
                        <td style="text-align: center;background: #D2E0E4;font-size: 125%;color: #000;"><b>VALUE</td>
                        <td style="text-align: center;background: #D2E0E4;font-size: 125%;color: #000;">&nbsp;<input style="width: 55px;font-weight: bold;color:#000000;text-align: center;" type="text" tabindex="62" onkeypress="return justNumbers(event);" name="sgl5" id="sgl5" size="25" maxlength="25" autocomplete="off" value="<?php echo $ratesroom->sgl5; ?>"/></td>
                        <td style="text-align: center;background: #D2E0E4;font-size: 125%;color: #000;">&nbsp;<input style="width: 55px;font-weight: bold;color:#000000;text-align: center;" type="text" tabindex="63" onkeypress="return justNumbers(event);" name="dbl5" id="dbl5" size="25" maxlength="25" autocomplete="off" value="<?php echo $ratesroom->dbl5; ?>"/></td>
                        <td style="text-align: center;background: #D2E0E4;font-size: 125%;color: #000;">&nbsp;<input style="width: 55px;font-weight: bold;color:#000000;text-align: center;" type="text" tabindex="64" onkeypress="return justNumbers(event);" name="tpl5" id="tpl5" size="25" maxlength="25" autocomplete="off" value="<?php echo $ratesroom->tpl5; ?>"/></td>
                        <td style="text-align: center;background: #D2E0E4;font-size: 125%;color: #000;">&nbsp;<input style="width: 55px;font-weight: bold;color:#000000;text-align: center;" type="text" tabindex="65" onkeypress="return justNumbers(event);" name="qua5" id="qua5" size="25" maxlength="25" autocomplete="off" value="<?php echo $ratesroom->qua5; ?>"/></td>
                        <td style="text-align: center;background: #D2E0E4;font-size: 125%;color: #000;">&nbsp;<input type="text" tabindex="66" onkeypress="return justNumbers(event);" name="chv65" id="chv65" size="25" maxlength="25" style="width: 55px;font-weight: bold;color:#000000;text-align: center;"  autocomplete="off" value="<?php echo $ratesroom->chv65; ?>" ></td>
                        <td style="text-align: center;background: #D2E0E4;font-size: 135%;color: #000;">&nbsp;<input type="text" tabindex="67" onkeypress="return justNumbers(event);" name="fdv_adult65" id="fdv_adult65" size="25" maxlength="25" style="width: 55px;font-weight: bold;color:#000000;text-align: center;" autocomplete="off"  value="<?php echo $ratesroom->fdv_adult65; ?>" ></td>
                        <td style="text-align: center;background: #D2E0E4;font-size: 135%;color: #000;">&nbsp;<input type="text" tabindex="68" onkeypress="return justNumbers(event);" name="fdv_child65" id="fdv_child65" size="25" maxlength="25" style="width: 55px;font-weight: bold;color:#000000;text-align: center;" autocomplete="off" value="<?php  echo $ratesroom->fdv_child65; ?>" ></td>
                        
                        <th style="width:95px; background: #0174DF; color: #fff; font-size: initial" rowspan="2"><i  aria-hidden="true"></i>&nbsp;<i class="fa fa-plane fa-2x" aria-hidden="true"></i><br>T-in</th>
                        <td rowspan="2" style="text-align: center;background:#3b5998;font-size: 135%;color: #000;">&nbsp;<input type="text" tabindex="130" onkeypress="return justNumbers(event);" name="t_in" id="t_in" size="25" maxlength="25" style="width: 50px; font-weight: bold;color:#000000;text-align: center;" autocomplete="off" value="<?php echo $ratesroom->t_in; ?>" ></td>
                    </tr>
                    <tr>
                        <td style="text-align: center;background: #0174DF;font-size: 125%;color: #fff;"><b>MODERATE</td>
                        <td style="text-align: center;background: #0174DF;font-size: 125%;color: #fff;">&nbsp;<input style="width: 55px;font-weight: bold;color:#000000;text-align: center;" type="text" tabindex="69" onkeypress="return justNumbers(event);" name="sglm5" id="sglm5" size="25" maxlength="25" autocomplete="off" value="<?php echo $ratesroom->sglm5; ?>"/></td>
                        <td style="text-align: center;background: #0174DF;font-size: 125%;color: #fff;">&nbsp;<input style="width: 55px;font-weight: bold;color:#000000;text-align: center;" type="text" tabindex="70" onkeypress="return justNumbers(event);" name="dblm5" id="dblm5" size="25" maxlength="25" autocomplete="off" value="<?php echo $ratesroom->dblm5; ?>"/></td>
                        <td style="text-align: center;background: #0174DF;font-size: 125%;color: #fff;">&nbsp;<input style="width: 55px;font-weight: bold;color:#000000;text-align: center;" type="text" tabindex="71" onkeypress="return justNumbers(event);" name="tplm5" id="tplm5" size="25" maxlength="25" autocomplete="off" value="<?php echo $ratesroom->tplm5; ?>"/></td>
                        <td style="text-align: center;background: #0174DF;font-size: 125%;color: #fff;">&nbsp;<input style="width: 55px;font-weight: bold;color:#000000;text-align: center;" type="text" tabindex="72" onkeypress="return justNumbers(event);" name="quam5" id="quam5" size="25" maxlength="25" autocomplete="off" value="<?php echo $ratesroom->quam5; ?>"/></td>
                        <td style="text-align: center;background: #0174DF;font-size: 125%;color: #fff;">&nbsp;<input type="text" tabindex="73" onkeypress="return justNumbers(event);" name="chm65" id="chm65" size="25" maxlength="25" style="width: 55px;font-weight: bold;color:#000000;text-align: center;"  autocomplete="off"  value="<?php echo $ratesroom->chm65; ?>" ></td>
                        <td style="text-align: center;background: #0174DF;font-size: 135%;color: #fff;">&nbsp;<input type="text" tabindex="74" onkeypress="return justNumbers(event);" name="fdm_adult65" id="fdm_adult65" size="25" maxlength="25" style="width: 55px;font-weight: bold;color:#000000;text-align: center;" autocomplete="off" value="<?php echo $ratesroom->fdm_adult65; ?>" ></td>
                        <td style="text-align: center;background: #0174DF;font-size: 135%;color: #fff;">&nbsp;<input type="text" tabindex="75" onkeypress="return justNumbers(event);" name="fdm_child65" id="fdm_child65" size="25" maxlength="25" style="width: 55px;font-weight: bold;color:#000000;text-align: center;" autocomplete="off" value="<?php echo $ratesroom->fdm_child65; ?>" ></td>
                        
                        
                    </tr>
                    <tr>
                        <td rowspan="2" style="background: #0174DF;font-size: 120%; color: #fff;text-align: center;"><b>7 Days / 6 Nights<br> 7 Parks</b></td>
                        <td style="text-align: center;background: #D2E0E4;font-size: 125%;color: #000;"><b>VALUE</td>
                        <td style="text-align: center;background: #D2E0E4;font-size: 125%;color: #000;">&nbsp;<input style="width: 55px;font-weight: bold;color:#000000;text-align: center;" type="text" tabindex="76" onkeypress="return justNumbers(event);" name="sgl6" id="sgl6" size="25" maxlength="25" autocomplete="off" value="<?php echo $ratesroom->sgl6; ?>"/></td>
                        <td style="text-align: center;background: #D2E0E4;font-size: 125%;color: #000;">&nbsp;<input style="width: 55px;font-weight: bold;color:#000000;text-align: center;" type="text" tabindex="77" onkeypress="return justNumbers(event);" name="dbl6" id="dbl6" size="25" maxlength="25" autocomplete="off" value="<?php echo $ratesroom->dbl6; ?>"/></td>
                        <td style="text-align: center;background: #D2E0E4;font-size: 125%;color: #000;">&nbsp;<input style="width: 55px;font-weight: bold;color:#000000;text-align: center;" type="text" tabindex="78" onkeypress="return justNumbers(event);" name="tpl6" id="tpl6" size="25" maxlength="25" autocomplete="off" value="<?php echo $ratesroom->tpl6; ?>"/></td>
                        <td style="text-align: center;background: #D2E0E4;font-size: 125%;color: #000;">&nbsp;<input style="width: 55px;font-weight: bold;color:#000000;text-align: center;" type="text" tabindex="79" onkeypress="return justNumbers(event);" name="qua6" id="qua6" size="25" maxlength="25" autocomplete="off" value="<?php echo $ratesroom->qua6; ?>"/></td>
                        <td style="text-align: center;background: #D2E0E4;font-size: 125%;color: #000;">&nbsp;<input type="text" tabindex="80" onkeypress="return justNumbers(event);" name="chv76" id="chv76" size="25" maxlength="25" style="width: 55px;font-weight: bold;color:#000000;text-align: center;"  autocomplete="off" value="<?php echo $ratesroom->chv76; ?>" ></td>
                        <td style="text-align: center;background: #D2E0E4;font-size: 135%;color: #000;">&nbsp;<input type="text" tabindex="81" onkeypress="return justNumbers(event);" name="fdv_adult76" id="fdv_adult76" size="25" maxlength="25" style="width: 55px;font-weight: bold;color:#000000;text-align: center;" autocomplete="off"  value="<?php echo $ratesroom->fdv_adult76; ?>" ></td>
                        <td style="text-align: center;background: #D2E0E4;font-size: 135%;color: #000;">&nbsp;<input type="text" tabindex="82" onkeypress="return justNumbers(event);" name="fdv_child76" id="fdv_child76" size="25" maxlength="25" style="width: 55px;font-weight: bold;color:#000000;text-align: center;" autocomplete="off" value="<?php  echo $ratesroom->fdv_child76; ?>" ></td>
                        
                        <th style="width:95px; background: #0174DF; color: #fff;font-size: initial" rowspan="2"><i  aria-hidden="true"></i>&nbsp;<i class="fa fa-plane fa-2x" aria-hidden="true"></i><br>T-out</th>
                        <td rowspan="2" style="text-align: center;background:#3b5998;font-size: 135%;color: #000;">&nbsp;<input type="text" tabindex="131" onkeypress="return justNumbers(event);" name="t_out" id="t_out" size="25" maxlength="25" style="width: 50px; font-weight: bold;color:#000000;text-align: center;" autocomplete="off" value="<?php echo $ratesroom->t_out; ?>" ></td>
                    </tr>
                    <tr>
                        <td style="text-align: center;background: #0174DF;font-size: 125%;color: #fff;"><b>MODERATE</td>
                        <td style="text-align: center;background: #0174DF;font-size: 125%;color: #fff;">&nbsp;<input style="width: 55px;font-weight: bold;color:#000000;text-align: center;" type="text" tabindex="83" onkeypress="return justNumbers(event);" name="sglm6" id="sglm6" size="25" maxlength="25" autocomplete="off" value="<?php echo $ratesroom->sglm6; ?>"/></td>
                        <td style="text-align: center;background: #0174DF;font-size: 125%;color: #fff;">&nbsp;<input style="width: 55px;font-weight: bold;color:#000000;text-align: center;" type="text" tabindex="84" onkeypress="return justNumbers(event);" name="dblm6" id="dblm6" size="25" maxlength="25" autocomplete="off" value="<?php echo $ratesroom->dblm6; ?>"/></td>
                        <td style="text-align: center;background: #0174DF;font-size: 125%;color: #fff;">&nbsp;<input style="width: 55px;font-weight: bold;color:#000000;text-align: center;" type="text" tabindex="85" onkeypress="return justNumbers(event);" name="tplm6" id="tplm6" size="25" maxlength="25" autocomplete="off" value="<?php echo $ratesroom->tplm6; ?>"/></td>
                        <td style="text-align: center;background: #0174DF;font-size: 125%;color: #fff;">&nbsp;<input style="width: 55px;font-weight: bold;color:#000000;text-align: center;" type="text" tabindex="86" onkeypress="return justNumbers(event);" name="quam6" id="quam6" size="25" maxlength="25" autocomplete="off" value="<?php echo $ratesroom->quam6; ?>"/></td>
                        <td style="text-align: center;background: #0174DF;font-size: 125%;color: #fff;">&nbsp;<input type="text" tabindex="87" onkeypress="return justNumbers(event);" name="chm76" id="chm76" size="25" maxlength="25" style="width: 55px;font-weight: bold;color:#000000;text-align: center;"  autocomplete="off" value="<?php echo $ratesroom->chm76; ?>" ></td>
                        <td style="text-align: center;background: #0174DF;font-size: 135%;color: #fff;">&nbsp;<input type="text" tabindex="88" onkeypress="return justNumbers(event);" name="fdm_adult76" id="fdm_adult76" size="25" maxlength="25" style="width: 55px;font-weight: bold;color:#000000;text-align: center;" autocomplete="off" value="<?php echo $ratesroom->fdm_adult76; ?>" ></td>
                        <td style="text-align: center;background: #0174DF;font-size: 135%;color: #fff;">&nbsp;<input type="text" tabindex="89" onkeypress="return justNumbers(event);" name="fdm_child76" id="fdm_child76" size="25" maxlength="25" style="width: 55px;font-weight: bold;color:#000000;text-align: center;" autocomplete="off" value="<?php echo $ratesroom->fdm_child76; ?>" ></td>
                        
                        
                   </tr>
                    <tr>
                        <td rowspan="2" style="background: #008000;font-size: 120%;color: #fff;text-align: center;"><b>8 Days / 7 Nights<br> 8 Parks</b></td>
                        <td style="text-align: center;background: #D2E0E4;font-size: 125%;color: #000;"><b>VALUE</td>
                        <td style="text-align: center;background: #D2E0E4;font-size: 125%;color: #000;">&nbsp;<input style="width: 55px;font-weight: bold;color:#000000;text-align: center;" type="text" tabindex="90" onkeypress="return justNumbers(event);" name="sgl7" id="sgl7" size="25" maxlength="25" autocomplete="off" value="<?php echo $ratesroom->sgl7; ?>"/></td>
                        <td style="text-align: center;background: #D2E0E4;font-size: 125%;color: #000;">&nbsp;<input style="width: 55px;font-weight: bold;color:#000000;text-align: center;" type="text" tabindex="91" onkeypress="return justNumbers(event);" name="dbl7" id="dbl7" size="25" maxlength="25" autocomplete="off" value="<?php echo $ratesroom->dbl7; ?>"/></td>
                        <td style="text-align: center;background: #D2E0E4;font-size: 125%;color: #000;">&nbsp;<input style="width: 55px;font-weight: bold;color:#000000;text-align: center;" type="text" tabindex="92" onkeypress="return justNumbers(event);" name="tpl7" id="tpl7" size="25" maxlength="25" autocomplete="off" value="<?php echo $ratesroom->tpl7; ?>"/></td>
                        <td style="text-align: center;background: #D2E0E4;font-size: 125%;color: #000;">&nbsp;<input style="width: 55px;font-weight: bold;color:#000000;text-align: center;" type="text" tabindex="93" onkeypress="return justNumbers(event);" name="qua7" id="qua7" size="25" maxlength="25" autocomplete="off" value="<?php echo $ratesroom->qua7; ?>"/></td>
                        <td style="text-align: center;background: #D2E0E4;font-size: 125%;color: #000;">&nbsp;<input type="text" tabindex="94" onkeypress="return justNumbers(event);" name="chv87" id="chv87" size="25" maxlength="25" style="width: 55px;font-weight: bold;color:#000000;text-align: center;"  autocomplete="off" value="<?php echo $ratesroom->chv87; ?>" ></td>
                        <td style="text-align: center;background: #D2E0E4;font-size: 135%;color: #000;">&nbsp;<input type="text" tabindex="95" onkeypress="return justNumbers(event);" name="fdv_adult87" id="fdv_adult87" size="25" maxlength="25" style="width: 55px;font-weight: bold;color:#000000;text-align: center;" autocomplete="off"  value="<?php echo $ratesroom->fdv_adult87; ?>" ></td>
                        <td style="text-align: center;background: #D2E0E4;font-size: 135%;color: #000;">&nbsp;<input type="text" tabindex="96" onkeypress="return justNumbers(event);" name="fdv_child87" id="fdv_child87" size="25" maxlength="25" style="width: 55px;font-weight: bold;color:#000000;text-align: center;" autocomplete="off" value="<?php  echo $ratesroom->fdv_child87; ?>" ></td>

                        <th style="width:95px; background:#0174DF; color: #fff; font-size: initial" rowspan="2"><i  aria-hidden="true"></i>&nbsp;<i class="fa fa-car fa-2x" aria-hidden="true"></i><br>Car-in</th>
                        <td rowspan="2" style="text-align: center;background:#3b5998;font-size: 135%;color: #000;">&nbsp;<input type="text" tabindex="132" onkeypress="return justNumbers(event);" name="car_in" id="car_in" size="25" maxlength="25" style="width: 50px; font-weight: bold;color:#000000;text-align: center;" autocomplete="off" value="<?php echo $ratesroom->car_in; ?>" ></td>
                    </tr>
                    <tr>
                        <td style="text-align: center;background: #0174DF;font-size: 125%;color: #fff;"><b>MODERATE</td>
                        <td style="text-align: center;background: #0174DF;font-size: 125%;color: #fff;">&nbsp;<input style="width: 55px;font-weight: bold;color:#000000;text-align: center;" type="text" tabindex="97" onkeypress="return justNumbers(event);" name="sglm7" id="sglm7" size="25" maxlength="25" autocomplete="off" value="<?php echo $ratesroom->sglm7; ?>"/></td>
                        <td style="text-align: center;background: #0174DF;font-size: 125%;color: #fff;">&nbsp;<input style="width: 55px;font-weight: bold;color:#000000;text-align: center;" type="text" tabindex="98" onkeypress="return justNumbers(event);" name="dblm7" id="dblm7" size="25" maxlength="25" autocomplete="off" value="<?php echo $ratesroom->dblm7; ?>"/></td>
                        <td style="text-align: center;background: #0174DF;font-size: 125%;color: #fff;">&nbsp;<input style="width: 55px;font-weight: bold;color:#000000;text-align: center;" type="text" tabindex="99" onkeypress="return justNumbers(event);" name="tplm7" id="tplm7" size="25" maxlength="25" autocomplete="off" value="<?php echo $ratesroom->tplm7; ?>"/></td>
                        <td style="text-align: center;background: #0174DF;font-size: 125%;color: #fff;">&nbsp;<input style="width: 55px;font-weight: bold;color:#000000;text-align: center;" type="text" tabindex="100" onkeypress="return justNumbers(event);" name="quam7" id="quam7" size="25" maxlength="25" autocomplete="off" value="<?php echo $ratesroom->quam7; ?>"/></td>
                        <td style="text-align: center;background: #0174DF;font-size: 125%;color: #fff;">&nbsp;<input type="text" tabindex="101" onkeypress="return justNumbers(event);" name="chm87" id="chm87" size="25" maxlength="25" style="width: 55px;font-weight: bold;color:#000000;text-align: center;" autocomplete="off" value="<?php echo $ratesroom->chm87; ?>" ></td>
                        <td style="text-align: center;background: #0174DF;font-size: 135%;color: #fff;">&nbsp;<input type="text" tabindex="102" onkeypress="return justNumbers(event);" name="fdm_adult87" id="fdm_adult87" size="25" maxlength="25" style="width: 55px;font-weight: bold;color:#000000;text-align: center;" autocomplete="off" value="<?php echo $ratesroom->fdm_adult87; ?>" ></td>
                        <td style="text-align: center;background: #0174DF;font-size: 135%;color: #fff;">&nbsp;<input type="text" tabindex="103" onkeypress="return justNumbers(event);" name="fdm_child87" id="fdm_child87" size="25" maxlength="25" style="width: 55px;font-weight: bold;color:#000000;text-align: center;" autocomplete="off" value="<?php echo $ratesroom->fdm_child87; ?>" ></td>
                        
                        
                    </tr>
                    <tr>
                        <td rowspan="2" style="background: #0174DF;font-size: 120%;color: #fff;text-align: center;"><b>9 Days / 8 Nights<br> 9 Parks</b></td>
                        <td style="text-align: center;background: #D2E0E4;font-size: 125%;color: #000;"><b>VALUE</td>
                        <td style="text-align: center;background: #D2E0E4;font-size: 125%;color: #000;">&nbsp;<input style="width: 55px;font-weight: bold;color:#000000;text-align: center;" type="text" tabindex="104" onkeypress="return justNumbers(event);" name="sgl8" id="sgl8" size="25" maxlength="25" autocomplete="off" value="<?php echo $ratesroom->sgl8; ?>"/></td>
                        <td style="text-align: center;background: #D2E0E4;font-size: 125%;color: #000;">&nbsp;<input style="width: 55px;font-weight: bold;color:#000000;text-align: center;" type="text" tabindex="105" onkeypress="return justNumbers(event);" name="dbl8" id="dbl8" size="25" maxlength="25" autocomplete="off" value="<?php echo $ratesroom->dbl8; ?>"/></td>
                        <td style="text-align: center;background: #D2E0E4;font-size: 125%;color: #000;">&nbsp;<input style="width: 55px;font-weight: bold;color:#000000;text-align: center;" type="text" tabindex="106" onkeypress="return justNumbers(event);" name="tpl8" id="tpl8" size="25" maxlength="25" autocomplete="off" value="<?php echo $ratesroom->tpl8; ?>"/></td>
                        <td style="text-align: center;background: #D2E0E4;font-size: 125%;color: #000;">&nbsp;<input style="width: 55px;font-weight: bold;color:#000000;text-align: center;" type="text" tabindex="107" onkeypress="return justNumbers(event);" name="qua8" id="qua8" size="25" maxlength="25" autocomplete="off" value="<?php echo $ratesroom->qua8; ?>"/></td>
                        <td style="text-align: center;background: #D2E0E4;font-size: 125%;color: #000;">&nbsp;<input type="text" tabindex="108" onkeypress="return justNumbers(event);" name="chv98" id="chv98" size="25" maxlength="25" style="width: 55px;font-weight: bold;color:#000000;text-align: center;"  autocomplete="off" value="<?php echo $ratesroom->chv98; ?>" ></td>
                        <td style="text-align: center;background: #D2E0E4;font-size: 135%;color: #000;">&nbsp;<input type="text" tabindex="109" onkeypress="return justNumbers(event);" name="fdv_adult98" id="fdv_adult98" size="25" maxlength="25" style="width: 55px;font-weight: bold;color:#000000;text-align: center;" autocomplete="off"  value="<?php echo $ratesroom->fdv_adult98; ?>" ></td>
                        <td style="text-align: center;background: #D2E0E4;font-size: 135%;color: #000;">&nbsp;<input type="text" tabindex="110" onkeypress="return justNumbers(event);" name="fdv_child98" id="fdv_child98" size="25" maxlength="25" style="width: 55px;font-weight: bold;color:#000000;text-align: center;" autocomplete="off" value="<?php  echo $ratesroom->fdv_child98; ?>" ></td>
                
                        <th style="width:95px; background:#0174DF; color: #fff;font-size: initial" rowspan="2"><i  aria-hidden="true"></i>&nbsp;<i class="fa fa-car fa-2x" aria-hidden="true"></i><br>Car-out</th>
                        <td rowspan="2" style="text-align: center;background: #3b5998;font-size: 135%;color: #000;">&nbsp;<input type="text" tabindex="133" onkeypress="return justNumbers(event);" name="car_out" id="car_out" size="25" maxlength="25" style="width: 50px; font-weight: bold;color:#000000;text-align: center;" autocomplete="off" value="<?php echo $ratesroom->car_out; ?>" ></td>
                    </tr>
                    <tr>
                        <td style="text-align: center;background: #0174DF;font-size: 125%;color: #fff;"><b>MODERATE</td>
                        <td style="text-align: center;background: #0174DF;font-size: 125%;color: #fff;">&nbsp;<input style="width: 55px;font-weight: bold;color:#000000;text-align: center;" type="text" tabindex="111" onkeypress="return justNumbers(event);" name="sglm8" id="sglm8" size="25" maxlength="25" autocomplete="off" value="<?php echo $ratesroom->sglm8; ?>"/></td>
                        <td style="text-align: center;background: #0174DF;font-size: 125%;color: #fff;">&nbsp;<input style="width: 55px;font-weight: bold;color:#000000;text-align: center;" type="text" tabindex="112" onkeypress="return justNumbers(event);" name="dblm8" id="dblm8" size="25" maxlength="25" autocomplete="off" value="<?php echo $ratesroom->dblm8; ?>"/></td>
                        <td style="text-align: center;background: #0174DF;font-size: 125%;color: #fff;">&nbsp;<input style="width: 55px;font-weight: bold;color:#000000;text-align: center;" type="text" tabindex="113" onkeypress="return justNumbers(event);" name="tplm8" id="tplm8" size="25" maxlength="25" autocomplete="off" value="<?php echo $ratesroom->tplm8; ?>"/></td>
                        <td style="text-align: center;background: #0174DF;font-size: 125%;color: #fff;">&nbsp;<input style="width: 55px;font-weight: bold;color:#000000;text-align: center;" type="text" tabindex="114" onkeypress="return justNumbers(event);" name="quam8" id="quam8" size="25" maxlength="25" autocomplete="off" value="<?php echo $ratesroom->quam8; ?>"/></td>
                        <td style="text-align: center;background: #0174DF;font-size: 125%;color: #fff;">&nbsp;<input type="text" tabindex="115" onkeypress="return justNumbers(event);" name="chm98" id="chm98" size="25" maxlength="25" style="width: 55px;font-weight: bold;color:#000000;text-align: center;"  autocomplete="off" value="<?php echo $ratesroom->chm98; ?>" ></td>
                        <td style="text-align: center;background: #0174DF;font-size: 135%;color: #fff;">&nbsp;<input type="text" tabindex="116" onkeypress="return justNumbers(event);" name="fdm_adult98" id="fdm_adult98" size="25" maxlength="25" style="width: 55px;font-weight: bold;color:#000000;text-align: center;" autocomplete="off" value="<?php echo $ratesroom->fdm_adult98; ?>" ></td>
                        <td style="text-align: center;background: #0174DF;font-size: 135%;color: #fff;">&nbsp;<input type="text" tabindex="117" onkeypress="return justNumbers(event);" name="fdm_child98" id="fdm_child98" size="25" maxlength="25" style="width: 55px;font-weight: bold;color:#000000;text-align: center;" autocomplete="off" value="<?php echo $ratesroom->fdm_child98; ?>" ></td>
                     
                        
                    </tr>
                </table>



<div style="" id="resultado"></div>


                <input name="id" type="hidden" id="id" value="<?php echo $ratesroom->id; ?>" />
                <input type="hidden" name="rate_no" placeholder="" style="width: 14%;" id="rate_no" value="<?php echo $ratesroom->rate_no; ?>">
                <input name="id_hotel" type="hidden" id="id_hotel" value="<?php echo $ratesroom->id_hotel=49; ?>" />
            </form>
        </fieldset>
    </div>

    <!--    <CENTER>
            <TABLE BORDER>
                <CAPTION ALING=botton>Resumen de tablas</CAPTION>
                <tr>
                    <td><th>table</th><th>tr</th>td</th><th>th</th><th>CAPTION</TH></TD>
                </tr>
                
                
                
            </TABLE>
            
            
        </CENTER>-->







</div>
</form>
<div id="to"></div>
</div>
<script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/form.js"></script>
<script type="text/javascript">

    $("#fecha_ini").datepicker({
        dateFormat: 'mm-dd-yy',
        numberOfMonths: 2
    });

    $("#fecha_fin").datepicker({
        dateFormat: 'mm-dd-yy',
        numberOfMonths: 2
    });



    function validateForm() {

        var sErrMsg = "";
        var flag = true;


        // sErrMsg += validateInt($('#capacity').val(),$('#l_capacity').html() , true);
        //sErrMsg += validateText($('#frecuency').val(),$('#l_frecuency').html() , true);

        if (sErrMsg !== "")
        {
            alert(sErrMsg);
            flag = false;
        }

        return flag;

    }

    $('#btn-save').click(function () {
        if (validateForm()) {
            $('#form1').submit();
        }
    });

    $('#btn-cancel').click(function () {
        window.location = '<?php echo $data['rootUrl']; ?>admin/tours/room-rates';
    });

</script>
 <script>
         
    var z;
    function capturar()
    {
        var resultado="ninguno";
        
        var porNombre=document.getElementsByName("tarifario");
        // Recorremos todos los valores del radio button para encontrar el
        // seleccionado
        for(var i=0;i<porNombre.length;i++)
        {
            if(porNombre[i].checked)
                resultado=porNombre[i].value;
           
        }
  
        //document.getElementById("resultado").innerHTML=" \
       //Value: "+resultado;
        z= document.getElementById("resultado").innerHTML=" \ "+resultado;
        
                  	
    } 
    function justNumbers(e)
        {
        var keynum = window.event ? window.event.keyCode : e.which;
        if ((keynum == 8) || (keynum == 46)|| (keynum == 45)
        return true;
    
        return /\d/.test(String.fromCharCode(keynum));
        
        }    
    </script>



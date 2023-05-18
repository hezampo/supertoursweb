
<?php $ratesroom = $data["ratesroom"]; ?>
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
<div id="header_page" >
    <div class="header2">(Tours) Room Rates [ <?php echo $data['dato']; ?> ]</div>
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
<div id="content_page" >
    <div id="serpare">    

        <fieldset>
            <legend>Rates</legend>

            <form id="form1" class="form" action="<?php echo $data['rootUrl']; ?>admin/tours/room-rates/save" method="post" name="form1">


                <div class="input" style="display: none;">
                    <label style="width:150px" class="required" id="l_trip_no">NAME CATEGORY: </label>
                    <select name="id_hotel">
                        <?php foreach ($data["hotel"] as $e): ?>

                            <option value="<?php echo $e['id']; ?>"  <?php echo ($ratesroom->id_hotel == trim($e['id']) ? 'selected' : ''); ?>><?php echo $e["nombre"]; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>


                <table border = "0" style="margin: 0 auto; margin-top: 2%;">
                    <tr style="background: #3AAA35; color: #fff;">
                        <th colspan="2" style="color: #fff;"><label> <b>RATE</b></label> <input type="text" value="A"></th>
                        <th colspan="3" >
                            <div class="" style="">
                                <label style="width:150px" class="required" id="l_trip_no" ><b>START DATE</b> </label>&nbsp; <i class="fa fa-calendar" aria-hidden="true"></i>&nbsp;
                                <input type="text" name="fecha_ini" id="fecha_ini" size="25" maxlength="25" style="width: 68px; " value="<?php echo ($ratesroom->fecha_ini != "" ? date("m-d-Y", $ratesroom->fecha_ini) : ''); ?>"/>
                            </div>
                        </th>
                        <th colspan="2">
                            <div class="">
                                <label style="width:150px" class="required" id="l_trip_no"><b>END DATE</b> </label>&nbsp; <i class="fa fa-calendar" aria-hidden="true"></i>&nbsp;
                                <input type="text" name="fecha_fin" id="fecha_fin" size="25" maxlength="25" style="width: 68px; " value="<?php echo ($ratesroom->fecha_fin != "" ? date("m-d-Y", $ratesroom->fecha_fin) : ''); ?>"/>
                            </div>
                        </th>
                      
                    </tr>
                    <tr style="background: #0174DF;font-size: initial;color: #fff;">
                        <th>Tour Length</th>
                        <th>&nbsp;&nbsp;<i class="fa fa-h-square" aria-hidden="true"></i>&nbsp;&nbsp;<br>Hotel</th>
                        <th>&nbsp;&nbsp;<i class="fa fa-bed" aria-hidden="true"></i>&nbsp;&nbsp;<br>Single</th>
                        <th>&nbsp;&nbsp;<i class="fa fa-bed" aria-hidden="true"></i>&nbsp;<i class="fa fa-bed" aria-hidden="true"></i>&nbsp;&nbsp;<br>Double</th>
                        <th>&nbsp;&nbsp;<i class="fa fa-bed" aria-hidden="true"></i>&nbsp;<i class="fa fa-bed" aria-hidden="true"></i>&nbsp;<i class="fa fa-bed" aria-hidden="true"></i>&nbsp;&nbsp;<br>Triple</th>
                        <th>&nbsp;&nbsp;<i class="fa fa-bed" aria-hidden="true"></i>&nbsp;<i class="fa fa-bed" aria-hidden="true"></i>&nbsp;<i class="fa fa-bed" aria-hidden="true"></i>&nbsp;<i class="fa fa-bed" aria-hidden="true"></i>&nbsp;&nbsp;<br>Quad</th>
                        <th><i class="fa fa-child" aria-hidden="true"></i>&nbsp;<br>Child (3-9)</th>
                    </tr>
                    <tr>
                        <td rowspan="2" style="background: #3AAA35;font-size: initial;color: #fff;"><b>2 Days / 1 Night</b></td>
                        <td style="text-align: right;background: #D2E0E4;font-size: initial;color: #000;"><b>Value</b></td>
                        <td style="text-align: center;background: #D2E0E4;font-size: initial;color: #000;"><i class="fa fa-usd" aria-hidden="true"></i>&nbsp;<input type="text" name="sgl" id="sgl"  maxlength="25" style="width: 48px;" value="<?php echo $ratesroom->sgl; ?>"/></td>
                        <td style="text-align: center;background: #D2E0E4;font-size: initial;color: #000;"><i class="fa fa-usd" aria-hidden="true"></i>&nbsp;<input type="text" name="dbl" id="dbl" size="25" maxlength="25"style="width: 48px;"  value="<?php echo $ratesroom->dbl; ?>"/></td>
                        <td style="text-align: center;background: #D2E0E4;font-size: initial;color: #000;"><i class="fa fa-usd" aria-hidden="true"></i>&nbsp;<input type="text" name="tpl" id="tpl" size="25" maxlength="25" style="width: 48px;"  value="<?php echo $ratesroom->tpl; ?>"/></td>
                        <td style="text-align: center;background: #D2E0E4;font-size: initial;color: #000;"><i class="fa fa-usd" aria-hidden="true"></i>&nbsp;<input type="text" name="qua" id="qua" size="25" maxlength="25" style="width: 48px;"  value="<?php echo $ratesroom->qua; ?>"/></td>
                        <td style="text-align: center;background: #D2E0E4;font-size: initial;color: #000;"><i class="fa fa-usd" aria-hidden="true"></i></td>         
                    </tr>
                    <tr style="color: #fff;">
                        <td style="text-align: right;background: #0174DF;font-size: initial;color: #fff;"><b>Moderate</td>
                        <td style="text-align: center;background: #0174DF;font-size: initial;color: #fff;"><i class="fa fa-usd" aria-hidden="true"></i>&nbsp;<input style="width: 48px;" type="text" name="sglm" id="sglm" size="25" maxlength="25" autocomplete="off" value="<?php echo $ratesroom->sglm; ?>"/></td>
                        <td style="text-align: center;background: #0174DF;font-size: initial;color: #fff;"><i class="fa fa-usd" aria-hidden="true"></i>&nbsp;<input style="width: 48px;" type="text" name="dblm" id="dblm" size="25" maxlength="25" autocomplete="off" value="<?php echo $ratesroom->dblm; ?>"/></td>
                        <td style="text-align: center;background: #0174DF;font-size: initial;color: #fff;"><i class="fa fa-usd" aria-hidden="true"></i>&nbsp;<input style="width: 48px;" type="text" name="tplm" id="tplm" size="25" maxlength="25" autocomplete="off" value="<?php echo $ratesroom->tplm; ?>"/></td>
                        <td style="text-align: center;background: #0174DF;font-size: initial;color: #fff;"><i class="fa fa-usd" aria-hidden="true"></i>&nbsp;<input style="width: 48px;" type="text" name="quam" id="quam" size="25" maxlength="25" autocomplete="off" value="<?php echo $ratesroom->quam; ?>"/></td>
                        <td style="text-align: center;background: #0174DF;font-size: initial;color: #fff;"><i class="fa fa-usd" aria-hidden="true"></i>&nbsp;</td>
                    </tr>
                    <tr>
                        <td rowspan="2" style="background: #0174DF;font-size: initial;color: #fff;"><b>3 Days / 2 Nights</b></td>
                        <td style="text-align: right;background: #D2E0E4;font-size: initial;color: #000;"><b><b>Value</b></td>
                        <td style="text-align: center;background: #D2E0E4;font-size: initial;color: #000;"><i class="fa fa-usd" aria-hidden="true"></i>&nbsp;<input type="text" name="sgl2" style="width: 48px;" id="sgl2" size="25" maxlength="25" value="<?php echo $ratesroom->sgl2; ?>"/></td>
                        <td style="text-align: center;background: #D2E0E4;font-size: initial;color: #000;"><i class="fa fa-usd" aria-hidden="true"></i>&nbsp;<input type="text" name="dbl2" style="width: 48px;" id="dbl2" size="25" maxlength="25" value="<?php echo $ratesroom->dbl2; ?>"/></td>
                        <td style="text-align: center;background: #D2E0E4;font-size: initial;color: #000;"><i class="fa fa-usd" aria-hidden="true"></i>&nbsp;<input type="text" name="tpl2" style="width: 48px;" id="tpl2" size="25" maxlength="25" value="<?php echo $ratesroom->tpl2; ?>"/></td>
                        <td style="text-align: center;background: #D2E0E4;font-size: initial;color: #000;"><i class="fa fa-usd" aria-hidden="true"></i>&nbsp;<input type="text" name="qua2" style="width: 48px;" id="qua2" size="25" maxlength="25" value="<?php echo $ratesroom->qua2; ?>"/></td>
                        <td style="text-align: center;background: #D2E0E4;font-size: initial;color: #000;"><i class="fa fa-usd" aria-hidden="true"></i>&nbsp;</td>
                    </tr>
                    <tr>
                        <td style="text-align: right;background: #0174DF;font-size: initial;color: #fff;"><b>Moderate</td>
                        <td style="text-align: center;background: #0174DF;font-size: initial;color: #fff;"><i class="fa fa-usd" aria-hidden="true"></i>&nbsp;<input style="width: 48px;" type="text" name="sglm2" id="sglm2" size="25" maxlength="25" autocomplete="off" value="<?php echo $ratesroom->sglm2; ?>"/></td>
                        <td style="text-align: center;background: #0174DF;font-size: initial;color: #fff;"><i class="fa fa-usd" aria-hidden="true"></i>&nbsp;<input style="width: 48px;" type="text" name="dblm2" id="dblm2" size="25" maxlength="25" autocomplete="off" value="<?php echo $ratesroom->dblm2; ?>"/></td>
                        <td style="text-align: center;background: #0174DF;font-size: initial;color: #fff;"><i class="fa fa-usd" aria-hidden="true"></i>&nbsp;<input style="width: 48px;" type="text" name="tplm2" id="tplm2" size="25" maxlength="25" autocomplete="off" value="<?php echo $ratesroom->tplm2; ?>"/></td>
                        <td style="text-align: center;background: #0174DF;font-size: initial;color: #fff;"><i class="fa fa-usd" aria-hidden="true"></i>&nbsp;<input style="width: 48px;" type="text" name="quam2" id="quam2" size="25" maxlength="25" autocomplete="off" value="<?php echo $ratesroom->quam2; ?>"/></td>
                        <td style="text-align: center;background: #0174DF;font-size: initial;color: #fff;"><i class="fa fa-usd" aria-hidden="true"></i>&nbsp;</td>
                    </tr>
                    <tr>
                        <td rowspan="2" style="background: #3AAA35;font-size: initial;color: #fff;"><b>4 Days / 3 Nights</b></td>
                        <td style="text-align: right;background: #D2E0E4;font-size: initial;color: #000;"><b>Value</td>
                        <td style="text-align: center;background: #D2E0E4;font-size: initial;color: #000;"><i class="fa fa-usd" aria-hidden="true"></i>&nbsp;<input type="text" name="sgl3" style="width: 48px;" id="sgl3" size="25" maxlength="25" value="<?php echo $ratesroom->sgl3; ?>"/></td>
                        <td style="text-align: center;background: #D2E0E4;font-size: initial;color: #000;"><i class="fa fa-usd" aria-hidden="true"></i>&nbsp;<input type="text" name="dbl3" style="width: 48px;" id="dbl3" size="25" maxlength="25" value="<?php echo $ratesroom->dbl3; ?>"/></td>
                        <td style="text-align: center;background: #D2E0E4;font-size: initial;color: #000;"><i class="fa fa-usd" aria-hidden="true"></i>&nbsp;<input type="text" name="tpl3" style="width: 48px;" id="tpl3" size="25" maxlength="25" value="<?php echo $ratesroom->tpl3; ?>"/></td>
                        <td style="text-align: center;background: #D2E0E4;font-size: initial;color: #000;"><i class="fa fa-usd" aria-hidden="true"></i>&nbsp;<input type="text" name="qua3" style="width: 48px;" id="qua3" size="25" maxlength="25" value="<?php echo $ratesroom->qua3; ?>"/></td>
                        <td style="text-align: center;background: #D2E0E4;font-size: initial;color: #000;"><i class="fa fa-usd" aria-hidden="true"></i>&nbsp;</td>
                    </tr>
                    <tr>
                        <td style="text-align: right;background: #0174DF;font-size: initial;color: #fff;"><b>Moderate</td>
                        <td style="text-align: center;background: #0174DF;font-size: initial;color: #fff;"><i class="fa fa-usd" aria-hidden="true"></i>&nbsp;<input style="width: 48px;" type="text" name="sglm3" id="sglm3" size="25" maxlength="25" autocomplete="off" value="<?php echo $ratesroom->sglm3; ?>"/></td>
                        <td style="text-align: center;background: #0174DF;font-size: initial;color: #fff;"><i class="fa fa-usd" aria-hidden="true"></i>&nbsp;<input style="width: 48px;" type="text" name="dblm3" id="dblm3" size="25" maxlength="25" autocomplete="off" value="<?php echo $ratesroom->dblm3; ?>"/></td>
                        <td style="text-align: center;background: #0174DF;font-size: initial;color: #fff;"><i class="fa fa-usd" aria-hidden="true"></i>&nbsp;<input style="width: 48px;" type="text" name="tplm3" id="tplm3" size="25" maxlength="25" autocomplete="off" value="<?php echo $ratesroom->tplm3; ?>"/></td>
                        <td style="text-align: center;background: #0174DF;font-size: initial;color: #fff;"><i class="fa fa-usd" aria-hidden="true"></i>&nbsp;<input style="width: 48px;" type="text" name="quam3" id="quam3" size="25" maxlength="25" autocomplete="off" value="<?php echo $ratesroom->quam3; ?>"/></td>
                        <td style="text-align: center;background: #0174DF;font-size: initial;color: #fff;"><i class="fa fa-usd" aria-hidden="true"></i>&nbsp;</td>
                    </tr>
                    <tr>
                        <td rowspan="2" style="background: #0174DF;font-size: initial;color: #fff;"><b>5 Days / 4 Nights</b></td>
                        <td style="text-align: right;background: #D2E0E4;font-size: initial;color: #000;"><b>Value</td>
                        <td style="text-align: center;background: #D2E0E4;font-size: initial;color: #000;"><i class="fa fa-usd" aria-hidden="true"></i>&nbsp;<input style="width: 48px;" type="text" name="sgl4" id="sgl4" size="25" maxlength="25" value="<?php echo $ratesroom->sgl4; ?>"/></td>
                        <td style="text-align: center;background: #D2E0E4;font-size: initial;color: #000;"><i class="fa fa-usd" aria-hidden="true"></i>&nbsp;<input style="width: 48px;" type="text" name="dbl4" id="dbl4" size="25" maxlength="25" value="<?php echo $ratesroom->dbl4; ?>"/></td>
                        <td style="text-align: center;background: #D2E0E4;font-size: initial;color: #000;"><i class="fa fa-usd" aria-hidden="true"></i>&nbsp;<input style="width: 48px;" type="text" name="tpl4" id="tpl4" size="25" maxlength="25" value="<?php echo $ratesroom->tpl4; ?>"/></td>
                        <td style="text-align: center;background: #D2E0E4;font-size: initial;color: #000;"><i class="fa fa-usd" aria-hidden="true"></i>&nbsp;<input style="width: 48px;" type="text" name="qua4" id="qua4" size="25" maxlength="25" value="<?php echo $ratesroom->qua4; ?>"/></td>
                        <td style="text-align: center;background: #D2E0E4;font-size: initial;color: #000;"><i class="fa fa-usd" aria-hidden="true"></i>&nbsp;</td>                
                    </tr>
                    <tr>
                        <td style="text-align: right;background: #0174DF;font-size: initial;color: #fff;"><b>Moderate</td>
                        <td style="text-align: center;background: #0174DF;font-size: initial;color: #fff;"><i class="fa fa-usd" aria-hidden="true"></i>&nbsp;<input style="width: 48px;" type="text" name="sglm4" id="sglm4" size="25" maxlength="25" autocomplete="off" value="<?php echo $ratesroom->sglm4; ?>"/></td>
                        <td style="text-align: center;background: #0174DF;font-size: initial;color: #fff;"><i class="fa fa-usd" aria-hidden="true"></i>&nbsp;<input style="width: 48px;" type="text" name="dblm4" id="dblm4" size="25" maxlength="25" autocomplete="off" value="<?php echo $ratesroom->dblm4; ?>"/></td>
                        <td style="text-align: center;background: #0174DF;font-size: initial;color: #fff;"><i class="fa fa-usd" aria-hidden="true"></i>&nbsp;<input style="width: 48px;" type="text" name="tplm4" id="tplm4" size="25" maxlength="25" autocomplete="off" value="<?php echo $ratesroom->tplm4; ?>"/></td>
                        <td style="text-align: center;background: #0174DF;font-size: initial;color: #fff;"><i class="fa fa-usd" aria-hidden="true"></i>&nbsp;<input style="width: 48px;" type="text" name="quam4" id="quam4" size="25" maxlength="25" autocomplete="off" value="<?php echo $ratesroom->quam4; ?>"/></td>
                        <td style="text-align: center;background: #0174DF;font-size: initial;color: #fff;"><i class="fa fa-usd" aria-hidden="true"></i>&nbsp;</td>
                    </tr>
                    <tr>
                        <td rowspan="2" style="background: #3AAA35;font-size: initial;color: #fff;"><b>6 Days / 5 Nights</b></td>
                        <td style="text-align: right;background: #D2E0E4;font-size: initial;color: #000;"><b>Value</td>
                        <td style="text-align: center;background: #D2E0E4;font-size: initial;color: #000;"><i class="fa fa-usd" aria-hidden="true"></i>&nbsp;<input style="width: 48px;" type="text" name="sgl5" id="sgl5" size="25" maxlength="25" value="<?php echo $ratesroom->sgl5; ?>"/></td>
                        <td style="text-align: center;background: #D2E0E4;font-size: initial;color: #000;"><i class="fa fa-usd" aria-hidden="true"></i>&nbsp;<input style="width: 48px;" type="text" name="dbl5" id="dbl5" size="25" maxlength="25" value="<?php echo $ratesroom->dbl5; ?>"/></td>
                        <td style="text-align: center;background: #D2E0E4;font-size: initial;color: #000;"><i class="fa fa-usd" aria-hidden="true"></i>&nbsp;<input style="width: 48px;" type="text" name="tpl5" id="tpl5" size="25" maxlength="25" value="<?php echo $ratesroom->tpl5; ?>"/></td>
                        <td style="text-align: center;background: #D2E0E4;font-size: initial;color: #000;"><i class="fa fa-usd" aria-hidden="true"></i>&nbsp;<input style="width: 48px;" type="text" name="qua5" id="qua5" size="25" maxlength="25" value="<?php echo $ratesroom->qua5; ?>"/></td>
                        <td style="text-align: center;background: #D2E0E4;font-size: initial;color: #000;"><i class="fa fa-usd" aria-hidden="true"></i>&nbsp;</td>
                    </tr>
                    <tr>
                        <td style="text-align: right;background: #0174DF;font-size: initial;color: #fff;"><b>Moderate</td>
                        <td style="text-align: center;background: #0174DF;font-size: initial;color: #fff;"><i class="fa fa-usd" aria-hidden="true"></i>&nbsp;<input style="width: 48px;" type="text" name="sglm5" id="sglm5" size="25" maxlength="25" autocomplete="off" value="<?php echo $ratesroom->sglm5; ?>"/></td>
                        <td style="text-align: center;background: #0174DF;font-size: initial;color: #fff;"><i class="fa fa-usd" aria-hidden="true"></i>&nbsp;<input style="width: 48px;" type="text" name="dblm5" id="dblm5" size="25" maxlength="25" autocomplete="off" value="<?php echo $ratesroom->dblm5; ?>"/></td>
                        <td style="text-align: center;background: #0174DF;font-size: initial;color: #fff;"><i class="fa fa-usd" aria-hidden="true"></i>&nbsp;<input style="width: 48px;" type="text" name="tplm5" id="tplm5" size="25" maxlength="25" autocomplete="off" value="<?php echo $ratesroom->tplm5; ?>"/></td>
                        <td style="text-align: center;background: #0174DF;font-size: initial;color: #fff;"><i class="fa fa-usd" aria-hidden="true"></i>&nbsp;<input style="width: 48px;" type="text" name="quam5" id="quam5" size="25" maxlength="25" autocomplete="off" value="<?php echo $ratesroom->quam5; ?>"/></td>
                        <td style="text-align: center;background: #0174DF;font-size: initial;color: #fff;"><i class="fa fa-usd" aria-hidden="true"></i>&nbsp;</td>
                    </tr>
                    <tr>
                        <td rowspan="2" style="background: #0174DF;font-size: initial;color: #fff;"><b>7 Days / 6 Nights</b></td>
                        <td style="text-align: right;background: #D2E0E4;font-size: initial;color: #000;"><b>Value</td>
                        <td style="text-align: center;background: #D2E0E4;font-size: initial;color: #000;"><i class="fa fa-usd" aria-hidden="true"></i>&nbsp;<input style="width: 48px;" type="text" name="sgl6" id="sgl6" size="25" maxlength="25" value="<?php echo $ratesroom->sgl6; ?>"/></td>
                        <td style="text-align: center;background: #D2E0E4;font-size: initial;color: #000;"><i class="fa fa-usd" aria-hidden="true"></i>&nbsp;<input style="width: 48px;" type="text" name="dbl6" id="dbl6" size="25" maxlength="25" value="<?php echo $ratesroom->dbl6; ?>"/></td>
                        <td style="text-align: center;background: #D2E0E4;font-size: initial;color: #000;"><i class="fa fa-usd" aria-hidden="true"></i>&nbsp;<input style="width: 48px;" type="text" name="tpl6" id="tpl6" size="25" maxlength="25" value="<?php echo $ratesroom->tpl6; ?>"/></td>
                        <td style="text-align: center;background: #D2E0E4;font-size: initial;color: #000;"><i class="fa fa-usd" aria-hidden="true"></i>&nbsp;<input style="width: 48px;" type="text" name="qua6" id="qua6" size="25" maxlength="25" value="<?php echo $ratesroom->qua6; ?>"/></td>
                        <td style="text-align: center;background: #D2E0E4;font-size: initial;color: #000;"><i class="fa fa-usd" aria-hidden="true"></i>&nbsp;</td>               
                    </tr>
                    <tr>
                        <td style="text-align: right;background: #0174DF;font-size: initial;color: #fff;"><b>Moderate</td>
                        <td style="text-align: center;background: #0174DF;font-size: initial;color: #fff;"><i class="fa fa-usd" aria-hidden="true"></i>&nbsp;<input style="width: 48px;" type="text" name="sglm6" id="sglm6" size="25" maxlength="25" autocomplete="off" value="<?php echo $ratesroom->sglm6; ?>"/></td>
                        <td style="text-align: center;background: #0174DF;font-size: initial;color: #fff;"><i class="fa fa-usd" aria-hidden="true"></i>&nbsp;<input style="width: 48px;" type="text" name="dblm6" id="dblm6" size="25" maxlength="25" autocomplete="off" value="<?php echo $ratesroom->dblm6; ?>"/></td>
                        <td style="text-align: center;background: #0174DF;font-size: initial;color: #fff;"><i class="fa fa-usd" aria-hidden="true"></i>&nbsp;<input style="width: 48px;" type="text" name="tplm6" id="tplm6" size="25" maxlength="25" autocomplete="off" value="<?php echo $ratesroom->tplm6; ?>"/></td>
                        <td style="text-align: center;background: #0174DF;font-size: initial;color: #fff;"><i class="fa fa-usd" aria-hidden="true"></i>&nbsp;<input style="width: 48px;" type="text" name="quam6" id="quam6" size="25" maxlength="25" autocomplete="off" value="<?php echo $ratesroom->quam6; ?>"/></td>
                        <td style="text-align: center;background: #0174DF;font-size: initial;color: #fff;"><i class="fa fa-usd" aria-hidden="true"></i>&nbsp;</td>
                    </tr>
                    <tr>
                        <td rowspan="2" style="background: #3AAA35;font-size: initial;color: #fff;"><b>8 Days / 7 Nights</b></td>
                        <td style="text-align: right;background: #D2E0E4;font-size: initial;color: #000;"><b>Value</td>
                        <td style="text-align: center;background: #D2E0E4;font-size: initial;color: #000;"><i class="fa fa-usd" aria-hidden="true"></i>&nbsp;<input style="width: 48px;" type="text" name="sgl7" id="sgl7" size="25" maxlength="25" value="<?php echo $ratesroom->sgl7; ?>"/></td>
                        <td style="text-align: center;background: #D2E0E4;font-size: initial;color: #000;"><i class="fa fa-usd" aria-hidden="true"></i>&nbsp;<input style="width: 48px;" type="text" name="dbl7" id="dbl7" size="25" maxlength="25" value="<?php echo $ratesroom->dbl7; ?>"/></td>
                        <td style="text-align: center;background: #D2E0E4;font-size: initial;color: #000;"><i class="fa fa-usd" aria-hidden="true"></i>&nbsp;<input style="width: 48px;" type="text" name="tpl7" id="tpl7" size="25" maxlength="25" value="<?php echo $ratesroom->tpl7; ?>"/></td>
                        <td style="text-align: center;background: #D2E0E4;font-size: initial;color: #000;"><i class="fa fa-usd" aria-hidden="true"></i>&nbsp;<input style="width: 48px;" type="text" name="qua7" id="qua7" size="25" maxlength="25" value="<?php echo $ratesroom->qua7; ?>"/></td>
                        <td style="text-align: center;background: #D2E0E4;font-size: initial;color: #000;"><i class="fa fa-usd" aria-hidden="true"></i>&nbsp;</td>
                    </tr>
                    <tr>
                        <td style="text-align: right;background: #0174DF;font-size: initial;color: #fff;"><b>Moderate</td>
                        <td style="text-align: center;background: #0174DF;font-size: initial;color: #fff;"><i class="fa fa-usd" aria-hidden="true"></i>&nbsp;<input style="width: 48px;" type="text" name="sglm7" id="sglm7" size="25" maxlength="25" autocomplete="off" value="<?php echo $ratesroom->sglm7; ?>"/></td>
                        <td style="text-align: center;background: #0174DF;font-size: initial;color: #fff;"><i class="fa fa-usd" aria-hidden="true"></i>&nbsp;<input style="width: 48px;" type="text" name="dblm7" id="dblm7" size="25" maxlength="25" autocomplete="off" value="<?php echo $ratesroom->dblm7; ?>"/></td>
                        <td style="text-align: center;background: #0174DF;font-size: initial;color: #fff;"><i class="fa fa-usd" aria-hidden="true"></i>&nbsp;<input style="width: 48px;" type="text" name="tplm7" id="tplm7" size="25" maxlength="25" autocomplete="off" value="<?php echo $ratesroom->tplm7; ?>"/></td>
                        <td style="text-align: center;background: #0174DF;font-size: initial;color: #fff;"><i class="fa fa-usd" aria-hidden="true"></i>&nbsp;<input style="width: 48px;" type="text" name="quam7" id="quam7" size="25" maxlength="25" autocomplete="off" value="<?php echo $ratesroom->quam7; ?>"/></td>
                        <td style="text-align: center;background: #0174DF;font-size: initial;color: #fff;"><i class="fa fa-usd" aria-hidden="true"></i>&nbsp;</td>
                    </tr>
                    <tr>
                        <td rowspan="2" style="background: #0174DF;font-size: initial;color: #fff;"><b>9 Days / 8 Nights</b></td>
                        <td style="text-align: right;background: #D2E0E4;font-size: initial;color: #000;"><b>Value</td>
                        <td style="text-align: center;background: #D2E0E4;font-size: initial;color: #000;"><i class="fa fa-usd" aria-hidden="true"></i>&nbsp;<input style="width: 48px;" type="text" name="sgl8" id="sgl8" size="25" maxlength="25" value="<?php echo $ratesroom->sgl8; ?>"/></td>
                        <td style="text-align: center;background: #D2E0E4;font-size: initial;color: #000;"><i class="fa fa-usd" aria-hidden="true"></i>&nbsp;<input style="width: 48px;" type="text" name="dbl8" id="dbl8" size="25" maxlength="25" value="<?php echo $ratesroom->dbl8; ?>"/></td>
                        <td style="text-align: center;background: #D2E0E4;font-size: initial;color: #000;"><i class="fa fa-usd" aria-hidden="true"></i>&nbsp;<input style="width: 48px;" type="text" name="tpl8" id="tpl8" size="25" maxlength="25" value="<?php echo $ratesroom->tpl8; ?>"/></td>
                        <td style="text-align: center;background: #D2E0E4;font-size: initial;color: #000;"><i class="fa fa-usd" aria-hidden="true"></i>&nbsp;<input style="width: 48px;" type="text" name="qua8" id="qua8" size="25" maxlength="25" value="<?php echo $ratesroom->qua8; ?>"/></td>
                        <td style="text-align: center;background: #D2E0E4;font-size: initial;color: #000;"><i class="fa fa-usd" aria-hidden="true"></i>&nbsp;</td>
                    </tr>
                    <tr>
                        <td style="text-align: right;background: #0174DF;font-size: initial;color: #fff;"><b>Moderate</td>
                        <td style="text-align: center;background: #0174DF;font-size: initial;color: #fff;"><i class="fa fa-usd" aria-hidden="true"></i>&nbsp;<input style="width: 48px;" type="text" name="sglm8" id="sglm8" size="25" maxlength="25" autocomplete="off" value="<?php echo $ratesroom->sglm8; ?>"/></td>
                        <td style="text-align: center;background: #0174DF;font-size: initial;color: #fff;"><i class="fa fa-usd" aria-hidden="true"></i>&nbsp;<input style="width: 48px;" type="text" name="dblm8" id="dblm8" size="25" maxlength="25" autocomplete="off" value="<?php echo $ratesroom->dblm8; ?>"/></td>
                        <td style="text-align: center;background: #0174DF;font-size: initial;color: #fff;"><i class="fa fa-usd" aria-hidden="true"></i>&nbsp;<input style="width: 48px;" type="text" name="tplm8" id="tplm8" size="25" maxlength="25" autocomplete="off" value="<?php echo $ratesroom->tplm8; ?>"/></td>
                        <td style="text-align: center;background: #0174DF;font-size: initial;color: #fff;"><i class="fa fa-usd" aria-hidden="true"></i>&nbsp;<input style="width: 48px;" type="text" name="quam8" id="quam8" size="25" maxlength="25" autocomplete="off" value="<?php echo $ratesroom->quam8; ?>"/></td>
                        <td style="text-align: center;background: #0174DF;font-size: initial;color: #fff;"><i class="fa fa-usd" aria-hidden="true"></i>&nbsp;</td>
                    </tr>
                </table>







                <input name="id" type="" id="id" hidden="hidden" value="<?php echo $ratesroom->id; ?>" />
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

        if (sErrMsg != "")
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
    })

    $('#btn-cancel').click(function () {
        window.location = '<?php echo $data['rootUrl']; ?>admin/tours/room-rates';
    })

</script>



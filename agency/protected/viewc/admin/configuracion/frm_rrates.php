<?php $ratesroom = $data["ratesroom"]; ?>
<?php $tarifastrip = $data["tarifastrip"]; ?>
<?php $tarifasplane = $data["tarifasplane"]; ?>
<?php
$tarifascar = $data["tarifascar"];
$data["type_rate"];

$tarifario = $ratesroom->rate;
$id_tarifario = $ratesroom->id;

//print($id_tarifario);
//FECHAS DE RANGO No 1
//llega (Y - m - d)
//Sale (m - d - Y)

//VALUE
$fechaschv = $ratesroom->fecha_schv;
//echo $fechaschv;

    if($fechaschv == ""){

        $fecha_schv = "";      
        
        
    }else{

        $fecha_schv = date("m-d-Y",strtotime($fechaschv)); 

    }

//MODERATE

$fechaschm = $ratesroom->fecha_schm;

    if($fechaschm == ""){

        $fecha_schm = "";

    }else{

        $fecha_schm = date("m-d-Y",strtotime($fechaschm)); 

    }

//FECHAS RANGO No 2

//VALUE

$fechaschv2 = $ratesroom->fecha_schv2;


    if($fechaschv2 == ""){

        $fecha_schv2 = "";

    }else{

        $fecha_schv2 = date("m-d-Y",strtotime($fechaschv2)); 
    }

//MODERATE
    
$fechaschm2 = $ratesroom->fecha_schm2;

    if($fechaschm2 == ""){

        $fecha_schm2 = "";

    }else{

        $fecha_schm2 = date("m-d-Y",strtotime($fechaschm2)); 

    }
    
//FECHAS RANGO No 3

//VALUE

$fechaschv3 = $ratesroom->fecha_schv3;

    if($fechaschv3 == ""){

        $fecha_schv3 = "";

    }else{

        $fecha_schv3 = date("m-d-Y",strtotime($fechaschv3)); 
    }

//MODERATE
    
$fechaschm3 = $ratesroom->fecha_schm3;

    if($fechaschm3 == ""){

        $fecha_schm3 = "";

    }else{

        $fecha_schm3 = date("m-d-Y",strtotime($fechaschm3)); 

    }
    
//FECHAS RANGO No 4

//VALUE

$fechaschv4 = $ratesroom->fecha_schv4;

    if($fechaschv4 == ""){

        $fecha_schv4 = "";

    }else{

        $fecha_schv4 = date("m-d-Y",strtotime($fechaschv4)); 
    }

//MODERATE
    
$fechaschm4 = $ratesroom->fecha_schm4;

    if($fechaschm4 == ""){

        $fecha_schm4 = "";

    }else{

        $fecha_schm4 = date("m-d-Y",strtotime($fechaschm4)); 

    }

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

        .verdefosf{
            background: rgba(230,227,225,0.45);
            background: -moz-linear-gradient(top, rgba(230,227,225,0.45) 0%, rgba(189,226,222,0.45) 25%, rgba(142,224,219,1) 53%, rgba(86,222,215,1) 87%, rgba(87,126,224,1) 100%);
            background: -webkit-gradient(left top, left bottom, color-stop(0%, rgba(230,227,225,0.45)), color-stop(25%, rgba(189,226,222,0.45)), color-stop(53%, rgba(142,224,219,1)), color-stop(87%, rgba(86,222,215,1)), color-stop(100%, rgba(87,126,224,1)));
            background: -webkit-linear-gradient(top, rgba(230,227,225,0.45) 0%, rgba(189,226,222,0.45) 25%, rgba(142,224,219,1) 53%, rgba(86,222,215,1) 87%, rgba(87,126,224,1) 100%);
            background: -o-linear-gradient(top, rgba(230,227,225,0.45) 0%, rgba(189,226,222,0.45) 25%, rgba(142,224,219,1) 53%, rgba(86,222,215,1) 87%, rgba(87,126,224,1) 100%);
            background: -ms-linear-gradient(top, rgba(230,227,225,0.45) 0%, rgba(189,226,222,0.45) 25%, rgba(142,224,219,1) 53%, rgba(86,222,215,1) 87%, rgba(87,126,224,1) 100%);
            background: linear-gradient(to bottom, rgba(230,227,225,0.45) 0%, rgba(189,226,222,0.45) 25%, rgba(142,224,219,1) 53%, rgba(86,222,215,1) 87%, rgba(87,126,224,1) 100%);
            filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#e6e3e1', endColorstr='#577ee0', GradientType=0 );
        }

    </style>  
    <style>
        .multiselect {
            width: 200px;
        }
        .selectBox {
            position: relative;
        }
        .selectBox select {
            width: 100%;
            font-weight: bold;
        }
        .overSelect {
            position: absolute;
            left: 0; right: 0; top: 0; bottom: 0;
        }
        #checkboxes {
            display: none;
            border: 1px #dadada solid;
        }
        #checkboxes label {
            display: block;
        }
        #checkboxes label:hover {
            background-color: #1e90ff;
        }
        
        .ui-datepicker .ui-datepicker-header {
            position: relative;
            padding: .2em 0;
            margin-top: -92px;
            

        }
        .ui-datepicker-multi .ui-datepicker-group {
    float: left;
    height: 98px;
    margin-top: 88px;
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
<div id="header_page" style="height:50px; background-image: url('<?php echo $data['rootUrl'] ?>global/img/bg2.jpg');">
    <div class="header2"> Multi Rates [ <?php echo $data['dato']; ?> ] <div class="multiselect" style="margin-left:219px; width:250px; margin-top:-36px;font-size:12px;line-height: 0.5em;" onclick="darclick(); cambiafondo();">
            <div class="selectBox" onclick="showCheckboxes();" >
                <select name="agencia[]" id="agencia" onclick="cambiafondo();">
                    <option>Select Agency</option>
                </select>                
                <div class="overSelect"></div>
            </div>
            <div id="checkboxes" style="width: 142%;">
                <input style="margin-left: 4px; margin-top:7px;" type="checkbox" onclick="toggle(this);" />Check all
                <?php
                
                $dato = $data['dato'];
                $tarifario = $ratesroom->rate;
                $id_tarifario = $ratesroom->id;
                //where id NOT IN('53','208')
                if($dato == 'New'){
                
                $sql = "SELECT id, company_name FROM agencia where id NOT IN('208') order by company_name asc";
                $rs = Doo::db()->query($sql);
                $agency_name = $rs->fetchAll();

                foreach ($agency_name as $r):
                    ?>   

                    <label for="one"> <input type="checkbox" name="checkbox" id="<?php echo $r['id'] ?>" onclick="darclick();" value="<?php echo $r['id'] ?>"/><?php echo $r['company_name']; ?></label>      
                <?php endforeach; }else if($dato == 'edit'){
                    
                $tarifario = $ratesroom->rate;
                $id_tarifario = $ratesroom->id;
                //id NOT IN('53','208') AND
                               
                $sql = "SELECT id, company_name FROM agencia where id NOT IN('208')AND id_tour='$id_tarifario'  order by company_name asc";
                $rs = Doo::db()->query($sql);
                $agency_name = $rs->fetchAll();

                foreach ($agency_name as $r):
                    ?>   

                    <label for="one"> <input type="checkbox" name="checkbox" checked="checked"  id="<?php echo $r['id'] ?>" onclick="darclick();" value="<?php echo $r['id'] ?>"/><?php echo $r['company_name']; ?></label>      
                <?php endforeach;
                }
                
                
                ?>

            </div>
        </div>
    </div>



    <script type="text/javascript">

        function darclick() {
            var obj = document.getElementById('button');
            obj.click();
        }

    </script>

    <script type="text/javascript">
        function toggle(source) {
            var checkboxes = document.querySelectorAll('input[type="checkbox"]');
            for (var i = 0; i < checkboxes.length; i++) {
                if (checkboxes[i] != source)
                    checkboxes[i].checked = source.checked;
            }
        }
    </script>




    <button id="button" style="margin-top:-21px; margin-left:597px; display:none;">Ids!</button>
    <script type="text/javascript">

        $('button').click(function () {
            var ids;
            ids = $('input[type=checkbox]:checked').map(function () {
                return $(this).attr('id');
            }).get();
            //alert('IDS: ' + ids.join(', '));
            //alert(ids.join(', '));
            document.getElementById('sodastereo').value = ids;
            //alert(ids);                            

        });
    </script>




    <input type="hidden" id="cont">

    <script>
        var expanded = false;
        function showCheckboxes() {
            var checkboxes = document.getElementById("checkboxes");
            if (!expanded) {
                checkboxes.style.display = "block";
                expanded = true;
            } else {
                checkboxes.style.display = "none";
                expanded = false;
            }
        }
    </script>



    <?php if ($data['dato'] == 'edit') { ?>
        <label style="font-size:18px; margin-top:15px;margin-left:2px; color:#0B55C4;"  for="bck_tarifario"><span><strong>Duplicar Tarifario</strong></span></label>
        <input style="margin-top:22px; margin-left:4px; background-color: white; " type="checkbox" id="bck_tarifario" name="bck_tarifario" value="1"/>
    <?php } else { ?>
        <label style="font-size:18px; margin-top:16px;margin-left:2px; display: none;"  for="bck_tarifario"><span><strong>Duplicar Tarifario</strong></span></label>
        <input style="margin-top:22px; margin-left:4px; display: none;" type="checkbox" id="bck_tarifario" name="bck_tarifario" value="1"/>
    <?php } ?>
    <div  id="toolbar">



        <div class="toolbar-list">
            <ul>

                <li class="btn-toolbar" id="btn-save">
                    <a class="link-button" id="btn-save"><span class="icon-32-save" title="Nuevo" >&nbsp;</span>Save</a>
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
<!--        style="border-radius: 20px; margin-top:2px; background-image: url('<?php echo $data['rootUrl'] ?>global/img/bg4blue2.jpg'); "-->
<div id="content_page" class="verdefosf">
    <div id="serpare">    

        <fieldset>

            <form id="form1" class="form" action="<?php echo $data['rootUrl']; ?>admin/tours/room-rates/save" method="post" name="form1">

                <input type="text" style="display:none; margin-top:15px; margin-left:1px; " name="sodastereo" id="sodastereo" value="" />
                


                <div style="" id="resultado"></div>
                
                <table border = "5" style="margin: 0 auto; margin-top: 0.5%;">
                    <tr style="background:#FF4500; height:20px; color: #fff; ">

                        <th colspan="3" style="">
                            <div class="" style="height:53px;">
                                <label style="margin-top:2px; width:120px; font-size: 125%;" class="required" id="l_trip_no"><b>TOUR NAME</b> </label>&nbsp; <i class="fa fa-table fa-2x"></i></BR>

                                <input type="text" tabindex="1" name="rate"  style="width: 253px; margin-top:-1px; text-align: left; padding-left: 9px; padding-top: 3px; font-weight: bold;color:#0000FF;" autocomplete="off" onKeyUp="this.value = this.value.toUpperCase();cambiafondo();" id="rate"value="<?php echo $ratesroom->rate; ?>">

                            </div> 
                        </th>
                        <th colspan="3" >
                            <div class="" style="height:53px;">
                                <label style="width:150px; font-weight: bold; font-size: 125%;" class="required" id="l_trip_no" ><b>START DATE</b> </label>&nbsp; <i class="fa fa-calendar fa-2x" aria-hidden="true"></i></BR>
                                <input type="text" tabindex="2" name="fecha_ini" id="fecha_ini" title="M-D-Y" size="35" maxlength="50" style="width: 130px;text-align: center;font-weight: bold;color:#0000FF;" required="required" value="<?php echo ($ratesroom->fecha_ini != "" ? date("m-d-Y", $ratesroom->fecha_ini) : ''); ?>" onchange="fechaFin(this.value); fechaIni1(this.value);" />
                            </div>
                        </th>
                        <th colspan="3">
                            <div class="" style="height:53px;">
                                <label style="width:150px; font-weight: bold; font-size: 125%;" class="required" id="l_trip_no"><b>END DATE</b> </label>&nbsp; <i class="fa fa-calendar fa-2x" aria-hidden="true"></i></BR>
                                <input type="text" tabindex="3" name="fecha_fin" id="fecha_fin" title="M-D-Y" size="35" maxlength="50" style="width: 130px; text-align: center;font-weight: bold;color:#0000FF;" required="required" value="<?php echo ($ratesroom->fecha_fin != "" ? date("m-d-Y", $ratesroom->fecha_fin) : ''); ?>" />
                            </div>
                        </th>


                        
                        <th colspan="" style="height: 54px;background:	#0174DF ; height: 54px; font-size: initial"> 
                            <i class="fa fa-bus fa-2x" aria-hidden="true"></i><br>Trip 100                            
                        </th>
                        <th colspan="" style="background: #3b5998;font-size: 135%; ">
                            Adult<input type="text" tabindex="118" onkeypress="validate(event)" name="trip100" id="trip100" size="25" maxlength="25" style="width: 50px; font-weight: bold;color:#000000;text-align: center; "  autocomplete="off" value="<?php echo $ratesroom->trip100; ?>" >
                            Child<input type="text" tabindex="119" onkeypress="validate(event)" name="trip100c" id="trip100c" size="25" maxlength="25" style="width: 50px; font-weight: bold;color:#000000;text-align: center; "  autocomplete="off" value="<?php echo $ratesroom->trip100c; ?>" >
                        </th>

                    </tr>
                    <tr style="background: 	#4B0082;font-size: initial;color: #fff;">
                        <th style="text-align: center;">Tour Length</th>
                        <th style="width:95px">&nbsp;&nbsp;<i class="fa fa-h-square" aria-hidden="true"></i>&nbsp;&nbsp;<br>Hotel</th>
                        <th style="width:95px">&nbsp;&nbsp;<i class="fa fa-bed" aria-hidden="true"></i>&nbsp;&nbsp;<br>Single</th>
                        <th style="width:95px">&nbsp;&nbsp;<i class="fa fa-bed" aria-hidden="true"></i>&nbsp;<i class="fa fa-bed" aria-hidden="true"></i>&nbsp;&nbsp<br>Double</th>
                        <th style="width:135px">&nbsp;&nbsp;<i class="fa fa-bed" aria-hidden="true"></i>&nbsp;<i class="fa fa-bed" aria-hidden="true"></i>&nbsp;<i class="fa fa-bed" aria-hidden="true"></i>&nbsp;&nbsp;<br>Triple</th>
                        <th style="width:136px"><i class="fa fa-bed" aria-hidden="true"></i>&nbsp;<i class="fa fa-bed" aria-hidden="true"></i>&nbsp;<i class="fa fa-bed" aria-hidden="true"></i>&nbsp;<i class="fa fa-bed" aria-hidden="true"></i>&nbsp;&nbsp;Quad</th>
                        <th style="width:71px"><i class="fa fa-child" aria-hidden="true"></i>&nbsp;<br>Child (3-9)</th>
                        <th style="width:95px"><i  aria-hidden="true"></i>&nbsp;<i class="fa fa-sign-out" aria-hidden="true"></i><br>Free Day Adult</th>
                        <th style="width:95px"><i  aria-hidden="true"></i>&nbsp;<i class="fa fa-sign-out" aria-hidden="true"></i><br>Free Day Child</th>

                        <td style="width:95px; background:#0174DF; color: #fff;  text-align: center; "><i  aria-hidden="true"></i>&nbsp;<i class="fa fa-bus fa-2x" aria-hidden="true"></i><br><b>Trip 200</b></td>
                        <th style="width:95px; background:#3b5998;">
                            Adult<input type="text" tabindex="120" onkeypress="validate(event)" name="trip200" id="trip200" size="25" maxlength="25" style="width: 50px; font-weight: bold;color:#000000;text-align: center;"  autocomplete="off" value="<?php echo $ratesroom->trip200; ?>"> 
                            Child<input type="text" tabindex="121" onkeypress="validate(event)" name="trip200c" id="trip200c" size="25" maxlength="25" style="width: 50px; font-weight: bold;color:#000000;text-align: center;"  autocomplete="off" value="<?php echo $ratesroom->trip200c; ?>">
                        </th>                        
                    </tr>
                    <tr>
                        <td rowspan="2" style="width:110px; background: #008000;font-size: 120%; color: #fff;text-align: center;"><b>2 Days / 1 Night<br> 2 Parks</b></td>
                        <td style="text-align: center;background:  #D2E0E4;font-size: 125%;color: #000;"><b>VALUE</b></td>
                        <td style="text-align: center;background: #D2E0E4;font-size: 135%;color: #000;">&nbsp;<input type="text" tabindex="6" onkeypress="validate(event)" name="sgl" id="sgl"  size="20" maxlength="20" style="width: 55px;font-weight: bold;color:#000000;text-align: center;" autocomplete="off" value="<?php echo $ratesroom->sgl; ?>"/></td>
                        <td style="text-align: center;background: #D2E0E4;font-size: 135%;color: #000;">&nbsp;<input type="text" tabindex="7" onkeypress="validate(event)" name="dbl" id="dbl"  size="20" maxlength="20" style="width: 55px;font-weight: bold;color:#000000;text-align: center;" autocomplete="off" value="<?php echo $ratesroom->dbl; ?>"/></td>
                        <td style="text-align: center;background: #D2E0E4;font-size: 135%;color: #000;">&nbsp;<input type="text" tabindex="8" onkeypress="validate(event)" name="tpl" id="tpl"  size="20" maxlength="25" style="width: 55px;font-weight: bold;color:#000000;text-align: center;" autocomplete="off" value="<?php echo $ratesroom->tpl; ?>"/></td>
                        <td style="text-align: center;background: #D2E0E4;font-size: 135%;color: #000;">&nbsp;<input type="text" tabindex="9" onkeypress="validate(event)" name="qua" id="qua"  size="20" maxlength="20" style="width: 55px;font-weight: bold;color:#000000;text-align: center;" autocomplete="off" value="<?php echo $ratesroom->qua; ?>"/></td>
                        <td style="text-align: center;background: #D2E0E4;font-size: 135%;color: #000;">&nbsp;<input type="text" tabindex="10" onkeypress="validate(event)" name="chv21" id="chv21"  size="25" maxlength="25" style="width: 55px;font-weight: bold;color:#000000;text-align: center;" autocomplete="off"  value="<?php echo $ratesroom->chv21; ?>" ></td>
                        <td style="text-align: center;background: #D2E0E4;font-size: 135%;color: #000;">&nbsp;<input type="text" tabindex="11" onkeypress="validate(event)" name="fdv_adult21" id="fdv_adult21"  size="25" maxlength="25" style="width: 55px;font-weight: bold;color:#000000;text-align: center;" autocomplete="off"  value="<?php echo ($ratesroom->fdv_adult21); ?>" ></td>
                        <td style="text-align: center;background: #D2E0E4;font-size: 135%;color: #000;">&nbsp;<input type="text" tabindex="12" onkeypress="validate(event)" name="fdv_child21" id="fdv_child21"  size="25" maxlength="25" style="width: 55px;font-weight: bold;color:#000000;text-align: center;" autocomplete="off"  value="<?php echo ($ratesroom->fdv_child21); ?>" ></td>

                        <th style="width:95px; background: #0174DF; color: #fff;font-size: initial;" rowspan="2"><i  aria-hidden="true"></i>&nbsp;<i class="fa fa-bus fa-2x"  aria-hidden="true"></i><br>Trip 300</th>
                        <th rowspan="2" style="text-align: center;background:#3b5998 ;font-size: 135%;color: #fff;">&nbsp;
                            Adult<input type="text" tabindex="122" onkeypress="validate(event)" name="trip300" id="trip300" size="25" maxlength="25" style="width: 50px; font-weight: bold;color:#000000;text-align: center;"  autocomplete="off" value="<?php echo $ratesroom->trip300; ?>">
                            Child<input type="text" tabindex="123" onkeypress="validate(event)" name="trip300c" id="trip300c" size="25" maxlength="25" style="width: 50px; font-weight: bold;color:#000000;text-align: center;"  autocomplete="off" value="<?php echo $ratesroom->trip300c; ?>">
                        </th>   
                    </tr>
                    <tr style="color: #fff;">
                        <td style="text-align: center;background: #0174DF;font-size: 125%;color: #fff;"><b>MODERATE</td>
                        <td style="text-align: center;background: #0174DF;font-size: 125%;color: #fff;">&nbsp;<input style="width: 55px;font-weight: bold;color:#000000;text-align: center;" type="text" tabindex="13" onkeypress="validate(event)" name="sglm" id="sglm"  size="25" maxlength="25" autocomplete="off" value="<?php echo $ratesroom->sglm; ?>"/></td>
                        <td style="text-align: center;background: #0174DF;font-size: 125%;color: #fff;">&nbsp;<input style="width: 55px;font-weight: bold;color:#000000;text-align: center;" type="text" tabindex="14" onkeypress="validate(event)" name="dblm" id="dblm"  size="25" maxlength="25" autocomplete="off" value="<?php echo $ratesroom->dblm; ?>"/></td>
                        <td style="text-align: center;background: #0174DF;font-size: 125%;color: #fff;">&nbsp;<input style="width: 55px;font-weight: bold;color:#000000;text-align: center;" type="text" tabindex="15" onkeypress="validate(event)" name="tplm" id="tplm"  size="25" maxlength="25" autocomplete="off" value="<?php echo $ratesroom->tplm; ?>"/></td>
                        <td style="text-align: center;background: #0174DF;font-size: 125%;color: #fff;">&nbsp;<input style="width: 55px;font-weight: bold;color:#000000;text-align: center;" type="text" tabindex="16" onkeypress="validate(event)" name="quam" id="quam"  size="25" maxlength="25" autocomplete="off" value="<?php echo $ratesroom->quam; ?>"/></td>
                        <td style="text-align: center;background: #0174DF;font-size: 125%;color: #fff;">&nbsp;<input type="text" tabindex="17" onkeypress="validate(event)" name="chm21" id="chm21" size="25" maxlength="25" style="width: 55px;font-weight: bold;color:#000000;text-align: center;"  autocomplete="off" value="<?php echo $ratesroom->chm21; ?>" ></td>
                        <td style="text-align: center;background: #0174DF;font-size: 135%;color: #fff;">&nbsp;<input type="text" tabindex="18" onkeypress="validate(event)" name="fdm_adult21" id="fdm_adult21" size="25" maxlength="25" style="width: 55px;font-weight: bold;color:#000000;text-align: center;"  autocomplete="off" value="<?php echo $ratesroom->fdm_adult21; ?>" ></td>
                        <td style="text-align: center;background: #0174DF;font-size: 135%;color: #fff;">&nbsp;<input type="text" tabindex="19" onkeypress="validate(event)" name="fdm_child21" id="fdm_child21" size="25" maxlength="25" style="width: 55px;font-weight: bold;color:#000000;text-align: center;"  autocomplete="off" value="<?php echo $ratesroom->fdm_child21; ?>" ></td>



                    </tr>
                    <tr>
                        <td rowspan="2" style="background: #0174DF;font-size: 120%; color: #fff;text-align: center;"><b>3 Days / 2 Nights<br> 3 Parks</b></td>
                        <td style="text-align: center;background: #D2E0E4;font-size: 125%;color: #000;"><b><b>VALUE</b></td>
                        <td style="text-align: center;background: #D2E0E4;font-size: 125%;color: #000;">&nbsp;<input type="text" tabindex="20" onkeypress="validate(event)" name="sgl2" style="width: 55px;font-weight: bold;color:#000000;text-align: center;" id="sgl2"  size="25" maxlength="25" autocomplete="off" value="<?php echo $ratesroom->sgl2; ?>"/></td>
                        <td style="text-align: center;background: #D2E0E4;font-size: 125%;color: #000;">&nbsp;<input type="text" tabindex="21" onkeypress="validate(event)" name="dbl2" style="width: 55px;font-weight: bold;color:#000000;text-align: center;" id="dbl2"  size="25" maxlength="25" autocomplete="off" value="<?php echo $ratesroom->dbl2; ?>"/></td>
                        <td style="text-align: center;background: #D2E0E4;font-size: 125%;color: #000;">&nbsp;<input type="text" tabindex="22" onkeypress="validate(event)" name="tpl2" style="width: 55px;font-weight: bold;color:#000000;text-align: center;" id="tpl2"  size="25" maxlength="25" autocomplete="off" value="<?php echo $ratesroom->tpl2; ?>"/></td>
                        <td style="text-align: center;background: #D2E0E4;font-size: 125%;color: #000;">&nbsp;<input type="text" tabindex="23" onkeypress="validate(event)" name="qua2" style="width: 55px;font-weight: bold;color:#000000;text-align: center;" id="qua2"  size="25" maxlength="25" autocomplete="off" value="<?php echo $ratesroom->qua2; ?>"/></td>
                        <td style="text-align: center;background: #D2E0E4;font-size: 125%;color: #000;">&nbsp;<input type="text" tabindex="24" onkeypress="validate(event)" name="chv32" id="chv32" size="25" maxlength="25" style="width: 55px;font-weight: bold;color:#000000;text-align: center;"   autocomplete="off" value="<?php echo $ratesroom->chv32; ?>" ></td>
                        <td style="text-align: center;background: #D2E0E4;font-size: 135%;color: #000;">&nbsp;<input type="text" tabindex="25" onkeypress="validate(event)" name="fdv_adult32" id="fdv_adult32" size="25" maxlength="25" style="width: 55px;font-weight: bold;color:#000000;text-align: center;"  autocomplete="off" value="<?php echo $ratesroom->fdv_adult32; ?>" ></td>
                        <td style="text-align: center;background: #D2E0E4;font-size: 135%;color: #000;">&nbsp;<input type="text" tabindex="26" onkeypress="validate(event)" name="fdv_child32" id="fdv_child32" size="25" maxlength="25" style="width: 55px;font-weight: bold;color:#000000;text-align: center;" autocomplete="off" value="<?php echo $ratesroom->fdv_child32; ?>" ></td>

                        <th style="width:95px; background: #0174DF; color: #fff;font-size: initial" rowspan="2"><i  aria-hidden="true"></i>&nbsp;<i class="fa fa-bus fa-2x" aria-hidden="true"></i><br>Trip 101</th>
                        <th rowspan="2" style="text-align: center;background:#3b5998;font-size: 135%;color: #fff;">&nbsp;
                            Adult<input type="text" tabindex="124" onkeypress="validate(event)" name="trip101" id="trip101" size="25" maxlength="25" style="width: 50px; font-weight: bold;color:#000000;text-align: center;"  autocomplete="off" value="<?php echo $ratesroom->trip101; ?>" >
                            Child<input type="text" tabindex="125" onkeypress="validate(event)" name="trip101c" id="trip101c" size="25" maxlength="25" style="width: 50px; font-weight: bold;color:#000000;text-align: center;"  autocomplete="off" value="<?php echo $ratesroom->trip101c; ?>" >
                        </th>
                    </tr>
                    <tr>
                        <td style="text-align: center;background: #0174DF;font-size: 125%;color: #fff;"><b>MODERATE</td>
                        <td style="text-align: center;background: #0174DF;font-size: 125%;color: #fff;">&nbsp;<input style="width: 55px;font-weight: bold;color:#000000;text-align: center;" type="text" tabindex="27" onkeypress="validate(event)" name="sglm2" id="sglm2"  size="25" maxlength="25" autocomplete="off" value="<?php echo $ratesroom->sglm2; ?>"/></td>
                        <td style="text-align: center;background: #0174DF;font-size: 125%;color: #fff;">&nbsp;<input style="width: 55px;font-weight: bold;color:#000000;text-align: center;" type="text" tabindex="28" onkeypress="validate(event)" name="dblm2" id="dblm2"  size="25" maxlength="25" autocomplete="off" value="<?php echo $ratesroom->dblm2; ?>"/></td>
                        <td style="text-align: center;background: #0174DF;font-size: 125%;color: #fff;">&nbsp;<input style="width: 55px;font-weight: bold;color:#000000;text-align: center;" type="text" tabindex="29" onkeypress="validate(event)" name="tplm2" id="tplm2"  size="25" maxlength="25" autocomplete="off" value="<?php echo $ratesroom->tplm2; ?>"/></td>
                        <td style="text-align: center;background: #0174DF;font-size: 125%;color: #fff;">&nbsp;<input style="width: 55px;font-weight: bold;color:#000000;text-align: center;" type="text" tabindex="30" onkeypress="validate(event)" name="quam2" id="quam2"  size="25" maxlength="25" autocomplete="off" value="<?php echo $ratesroom->quam2; ?>"/></td>
                        <td style="text-align: center;background: #0174DF;font-size: 125%;color: #fff;">&nbsp;<input type="text" tabindex="31" onkeypress="validate(event)" name="chm32" id="chm32" size="25" maxlength="25" style="width: 55px;font-weight: bold;color:#000000;text-align: center;"   autocomplete="off" value="<?php echo $ratesroom->chm32; ?>" ></td>
                        <td style="text-align: center;background: #0174DF;font-size: 135%;color: #fff;">&nbsp;<input type="text" tabindex="32" onkeypress="validate(event)" name="fdm_adult32" id="fdm_adult32" size="25" maxlength="25" style="width: 55px;font-weight: bold;color:#000000;text-align: center;"  autocomplete="off" value="<?php echo $ratesroom->fdm_adult32; ?>" ></td>
                        <td style="text-align: center;background: #0174DF;font-size: 135%;color: #fff;">&nbsp;<input type="text" tabindex="33" onkeypress="validate(event)" name="fdm_child32" id="fdm_child32" size="25" maxlength="25" style="width: 55px;font-weight: bold;color:#000000;text-align: center;"  autocomplete="off" value="<?php echo $ratesroom->fdm_child32; ?>" ></td>



                    </tr>
                    <tr>
                        <td rowspan="2" style="background: #008000;font-size: 120%; color: #fff;text-align: center;"><b>4 Days / 3 Nights<br> 4 Parks</b></td>
                        <td style="text-align: center;background: #D2E0E4;font-size: 125%;color: #000;"><b>VALUE</td>
                        <td style="text-align: center;background: #D2E0E4;font-size: 125%;color: #000;">&nbsp;<input type="text" tabindex="34" onkeypress="validate(event)" name="sgl3" style="width: 55px;font-weight: bold;color:#000000;text-align: center;" id="sgl3"  size="25" maxlength="25" autocomplete="off" value="<?php echo $ratesroom->sgl3; ?>"/></td>
                        <td style="text-align: center;background: #D2E0E4;font-size: 125%;color: #000;">&nbsp;<input type="text" tabindex="35" onkeypress="validate(event)" name="dbl3" style="width: 55px;font-weight: bold;color:#000000;text-align: center;" id="dbl3"  size="25" maxlength="25" autocomplete="off" value="<?php echo $ratesroom->dbl3; ?>"/></td>
                        <td style="text-align: center;background: #D2E0E4;font-size: 125%;color: #000;">&nbsp;<input type="text" tabindex="36" onkeypress="validate(event)" name="tpl3" style="width: 55px;font-weight: bold;color:#000000;text-align: center;" id="tpl3"  size="25" maxlength="25" autocomplete="off" value="<?php echo $ratesroom->tpl3; ?>"/></td>
                        <td style="text-align: center;background: #D2E0E4;font-size: 125%;color: #000;">&nbsp;<input type="text" tabindex="37" onkeypress="validate(event)" name="qua3" style="width: 55px;font-weight: bold;color:#000000;text-align: center;" id="qua3"  size="25" maxlength="25" autocomplete="off" value="<?php echo $ratesroom->qua3; ?>"/></td>
                        <td style="text-align: center;background: #D2E0E4;font-size: 125%;color: #000;">&nbsp;<input type="text" tabindex="38" onkeypress="validate(event)" name="chv43" id="chv43" size="25" maxlength="25" style="width: 55px;font-weight: bold;color:#000000;text-align: center;"   autocomplete="off" value="<?php echo $ratesroom->chv43; ?>" ></td>
                        <td style="text-align: center;background: #D2E0E4;font-size: 135%;color: #000;">&nbsp;<input type="text" tabindex="39" onkeypress="validate(event)" name="fdv_adult43" id="fdv_adult43" size="25" maxlength="25" style="width: 55px;font-weight: bold;color:#000000;text-align: center;"  autocomplete="off" value="<?php echo $ratesroom->fdv_adult43; ?>" ></td>
                        <td style="text-align: center;background: #D2E0E4;font-size: 135%;color: #000;">&nbsp;<input type="text" tabindex="40" onkeypress="validate(event)" name="fdv_child43" id="fdv_child43" size="25" maxlength="25" style="width: 55px;font-weight: bold;color:#000000;text-align: center;"  autocomplete="off" value="<?php echo $ratesroom->fdv_child43; ?>" ></td>

                        <th style="width:95px; background: #0174DF; color: #fff; font-size: initial" rowspan="2"><i  aria-hidden="true"></i>&nbsp;<i class="fa fa-bus fa-2x" aria-hidden="true"></i><br>Trip 201</th>
                        <th rowspan="2" style="text-align: center;background:#3b5998;font-size: 135%;color: #fff;">&nbsp;
                            Adult<input type="text" tabindex="126" onkeypress="validate(event)" name="trip201" id="trip201" size="25" maxlength="25" style="width: 50px; font-weight: bold;color:#000000;text-align: center;"  autocomplete="off" value="<?php echo $ratesroom->trip201; ?>" >
                            Child<input type="text" tabindex="127" onkeypress="validate(event)" name="trip201c" id="trip201c" size="25" maxlength="25" style="width: 50px; font-weight: bold;color:#000000;text-align: center;"  autocomplete="off" value="<?php echo $ratesroom->trip201c; ?>" >
                        </th>
                    </tr>
                    <tr>
                        <td style="text-align: center;background: #0174DF;font-size: 125%;color: #fff;"><b>MODERATE</td>
                        <td style="text-align: center;background: #0174DF;font-size: 125%;color: #fff;">&nbsp;<input style="width: 55px;font-weight: bold;color:#000000;text-align: center;" type="text" tabindex="41" onkeypress="validate(event)" name="sglm3" id="sglm3"  size="25" maxlength="25" autocomplete="off" value="<?php echo $ratesroom->sglm3; ?>"/></td>
                        <td style="text-align: center;background: #0174DF;font-size: 125%;color: #fff;">&nbsp;<input style="width: 55px;font-weight: bold;color:#000000;text-align: center;" type="text" tabindex="42" onkeypress="validate(event)" name="dblm3" id="dblm3"  size="25" maxlength="25" autocomplete="off" value="<?php echo $ratesroom->dblm3; ?>"/></td>
                        <td style="text-align: center;background: #0174DF;font-size: 125%;color: #fff;">&nbsp;<input style="width: 55px;font-weight: bold;color:#000000;text-align: center;" type="text" tabindex="43" onkeypress="validate(event)" name="tplm3" id="tplm3"  size="25" maxlength="25" autocomplete="off" value="<?php echo $ratesroom->tplm3; ?>"/></td>
                        <td style="text-align: center;background: #0174DF;font-size: 125%;color: #fff;">&nbsp;<input style="width: 55px;font-weight: bold;color:#000000;text-align: center;" type="text" tabindex="44" onkeypress="validate(event)" name="quam3" id="quam3"  size="25" maxlength="25" autocomplete="off" value="<?php echo $ratesroom->quam3; ?>"/></td>
                        <td style="text-align: center;background: #0174DF;font-size: 125%;color: #fff;">&nbsp;<input type="text" tabindex="45" onkeypress="validate(event)" name="chm43" id="chm43" size="25" maxlength="25" style="width: 55px;font-weight: bold;color:#000000;text-align: center;"   autocomplete="off" value="<?php echo $ratesroom->chm43; ?>" ></td>
                        <td style="text-align: center;background: #0174DF;font-size: 135%;color: #fff;">&nbsp;<input type="text" tabindex="46" onkeypress="validate(event)" name="fdm_adult43" id="fdm_adult43" size="25" maxlength="25" style="width: 55px;font-weight: bold;color:#000000;text-align: center;"  autocomplete="off" value="<?php echo $ratesroom->fdm_adult43; ?>" ></td>
                        <td style="text-align: center;background: #0174DF;font-size: 135%;color: #fff;">&nbsp;<input type="text" tabindex="47" onkeypress="validate(event)" name="fdm_child43" id="fdm_child43" size="25" maxlength="25" style="width: 55px;font-weight: bold;color:#000000;text-align: center;"  autocomplete="off" value="<?php echo $ratesroom->fdm_child43; ?>" ></td>


                    </tr>
                    <tr>
                        <td rowspan="2" style="background: #0174DF; font-size: 120%;color: #fff;text-align: center;"><b>5 Days / 4 Nights<br> 5 Parks</b></td>
                        <td style="text-align: center;background: #D2E0E4;font-size: 125%;color: #000;"><b>VALUE</td>
                        <td style="text-align: center;background: #D2E0E4;font-size: 125%;color: #000;">&nbsp;<input style="width: 55px;font-weight: bold;color:#000000;text-align: center;" type="text" tabindex="48" onkeypress="validate(event)" name="sgl4" id="sgl4" size="25" maxlength="25"  autocomplete="off" value="<?php echo $ratesroom->sgl4; ?>"/></td>
                        <td style="text-align: center;background: #D2E0E4;font-size: 125%;color: #000;">&nbsp;<input style="width: 55px;font-weight: bold;color:#000000;text-align: center;" type="text" tabindex="49" onkeypress="validate(event)" name="dbl4" id="dbl4" size="25" maxlength="25"  autocomplete="off" value="<?php echo $ratesroom->dbl4; ?>"/></td>
                        <td style="text-align: center;background: #D2E0E4;font-size: 125%;color: #000;">&nbsp;<input style="width: 55px;font-weight: bold;color:#000000;text-align: center;" type="text" tabindex="50" onkeypress="validate(event)" name="tpl4" id="tpl4" size="25" maxlength="25"  autocomplete="off" value="<?php echo $ratesroom->tpl4; ?>"/></td>
                        <td style="text-align: center;background: #D2E0E4;font-size: 125%;color: #000;">&nbsp;<input style="width: 55px;font-weight: bold;color:#000000;text-align: center;" type="text" tabindex="51" onkeypress="validate(event)" name="qua4" id="qua4" size="25" maxlength="25"  autocomplete="off" value="<?php echo $ratesroom->qua4; ?>"/></td>
                        <td style="text-align: center;background: #D2E0E4;font-size: 125%;color: #000;">&nbsp;<input type="text" tabindex="52" onkeypress="validate(event)" name="chv54" id="chv54" size="25" maxlength="25" style="width: 55px;font-weight: bold;color:#000000;text-align: center;"   autocomplete="off" value="<?php echo $ratesroom->chv54; ?>" ></td>
                        <td style="text-align: center;background: #D2E0E4;font-size: 135%;color: #000;">&nbsp;<input type="text" tabindex="53" onkeypress="validate(event)" name="fdv_adult54" id="fdv_adult54" size="25" maxlength="25" style="width: 55px;font-weight: bold;color:#000000;text-align: center;"  autocomplete="off"  value="<?php echo $ratesroom->fdv_adult54; ?>" ></td>
                        <td style="text-align: center;background: #D2E0E4;font-size: 135%;color: #000;">&nbsp;<input type="text" tabindex="54" onkeypress="validate(event)" name="fdv_child54" id="fdv_child54" size="25" maxlength="25" style="width: 55px;font-weight: bold;color:#000000;text-align: center;"  autocomplete="off" value="<?php echo $ratesroom->fdv_child54; ?>" ></td>

                        <th style="width:95px; background: #0174DF; color: #fff; font-size: initial;" rowspan="2"><i  aria-hidden="true"></i>&nbsp;<i class="fa fa-bus fa-2x" aria-hidden="true"></i><br>Trip 301</th>
                        <th rowspan="2" style="text-align: center;background:#3b5998;font-size: 135%;color: #fff;">&nbsp;
                            Adult<input type="text" tabindex="128" onkeypress="validate(event)" name="trip301" id="trip301" size="25" maxlength="25" style="width: 50px; font-weight: bold;color:#000000;text-align: center;"  autocomplete="off" value="<?php echo $ratesroom->trip301; ?>" >
                            Child<input type="text" tabindex="129" onkeypress="validate(event)" name="trip301c" id="trip301c" size="25" maxlength="25" style="width: 50px; font-weight: bold;color:#000000;text-align: center;"  autocomplete="off" value="<?php echo $ratesroom->trip301c; ?>" >
                        </th>
                    </tr>
                    <tr>
                        <td style="text-align: center;background: #0174DF;font-size: 125%;color: #fff;"><b>MODERATE</td>
                        <td style="text-align: center;background: #0174DF;font-size: 125%;color: #fff;">&nbsp;<input style="width: 55px;font-weight: bold;color:#000000;text-align: center;" type="text" tabindex="55" onkeypress="validate(event)" name="sglm4" id="sglm4"  size="25" maxlength="25" autocomplete="off" value="<?php echo $ratesroom->sglm4; ?>"/></td>
                        <td style="text-align: center;background: #0174DF;font-size: 125%;color: #fff;">&nbsp;<input style="width: 55px;font-weight: bold;color:#000000;text-align: center;" type="text" tabindex="56" onkeypress="validate(event)" name="dblm4" id="dblm4"  size="25" maxlength="25" autocomplete="off" value="<?php echo $ratesroom->dblm4; ?>"/></td>
                        <td style="text-align: center;background: #0174DF;font-size: 125%;color: #fff;">&nbsp;<input style="width: 55px;font-weight: bold;color:#000000;text-align: center;" type="text" tabindex="57" onkeypress="validate(event)" name="tplm4" id="tplm4"  size="25" maxlength="25" autocomplete="off" value="<?php echo $ratesroom->tplm4; ?>"/></td>
                        <td style="text-align: center;background: #0174DF;font-size: 125%;color: #fff;">&nbsp;<input style="width: 55px;font-weight: bold;color:#000000;text-align: center;" type="text" tabindex="58" onkeypress="validate(event)" name="quam4" id="quam4"  size="25" maxlength="25" autocomplete="off" value="<?php echo $ratesroom->quam4; ?>"/></td>
                        <td style="text-align: center;background: #0174DF;font-size: 125%;color: #fff;">&nbsp;<input type="text" tabindex="59" onkeypress="validate(event)" name="chm54" id="chm54" size="25" maxlength="25" style="width: 55px;font-weight: bold;color:#000000;text-align: center;"   autocomplete="off" value="<?php echo $ratesroom->chm54; ?>" ></td>
                        <td style="text-align: center;background: #0174DF;font-size: 135%;color: #fff;">&nbsp;<input type="text" tabindex="60" onkeypress="validate(event)" name="fdm_adult54" id="fdm_adult54" size="25" maxlength="25" style="width: 55px;font-weight: bold;color:#000000;text-align: center;"  autocomplete="off" value="<?php echo $ratesroom->fdm_adult54; ?>" ></td>
                        <td style="text-align: center;background: #0174DF;font-size: 135%;color: #fff;">&nbsp;<input type="text" tabindex="61" onkeypress="validate(event)" name="fdm_child54" id="fdm_child54" size="25" maxlength="25" style="width: 55px;font-weight: bold;color:#000000;text-align: center;"  autocomplete="off" value="<?php echo $ratesroom->fdm_child54; ?>" ></td>


                    </tr>
                    <tr>
                        <td rowspan="2" style="background: #008000;font-size: 120%; color: #fff;text-align: center;"><b>6 Days / 5 Nights<br> 6 Parks</b></td>
                        <td style="text-align: center;background: #D2E0E4;font-size: 125%;color: #000;"><b>VALUE</td>
                        <td style="text-align: center;background: #D2E0E4;font-size: 125%;color: #000;">&nbsp;<input style="width: 55px;font-weight: bold;color:#000000;text-align: center;" type="text" tabindex="62" onkeypress="validate(event)" name="sgl5" id="sgl5" size="25" maxlength="25"  autocomplete="off" value="<?php echo $ratesroom->sgl5; ?>"/></td>
                        <td style="text-align: center;background: #D2E0E4;font-size: 125%;color: #000;">&nbsp;<input style="width: 55px;font-weight: bold;color:#000000;text-align: center;" type="text" tabindex="63" onkeypress="validate(event)" name="dbl5" id="dbl5" size="25" maxlength="25"  autocomplete="off" value="<?php echo $ratesroom->dbl5; ?>"/></td>
                        <td style="text-align: center;background: #D2E0E4;font-size: 125%;color: #000;">&nbsp;<input style="width: 55px;font-weight: bold;color:#000000;text-align: center;" type="text" tabindex="64" onkeypress="validate(event)" name="tpl5" id="tpl5" size="25" maxlength="25"  autocomplete="off" value="<?php echo $ratesroom->tpl5; ?>"/></td>
                        <td style="text-align: center;background: #D2E0E4;font-size: 125%;color: #000;">&nbsp;<input style="width: 55px;font-weight: bold;color:#000000;text-align: center;" type="text" tabindex="65" onkeypress="validate(event)" name="qua5" id="qua5" size="25" maxlength="25"  autocomplete="off" value="<?php echo $ratesroom->qua5; ?>"/></td>
                        <td style="text-align: center;background: #D2E0E4;font-size: 125%;color: #000;">&nbsp;<input type="text" tabindex="66" onkeypress="validate(event)" name="chv65" id="chv65" size="25" maxlength="25" style="width: 55px;font-weight: bold;color:#000000;text-align: center;"   autocomplete="off" value="<?php echo $ratesroom->chv65; ?>" ></td>
                        <td style="text-align: center;background: #D2E0E4;font-size: 135%;color: #000;">&nbsp;<input type="text" tabindex="67" onkeypress="validate(event)" name="fdv_adult65" id="fdv_adult65" size="25" maxlength="25" style="width: 55px;font-weight: bold;color:#000000;text-align: center;"  autocomplete="off"  value="<?php echo $ratesroom->fdv_adult65; ?>" ></td>
                        <td style="text-align: center;background: #D2E0E4;font-size: 135%;color: #000;">&nbsp;<input type="text" tabindex="68" onkeypress="validate(event)" name="fdv_child65" id="fdv_child65" size="25" maxlength="25" style="width: 55px;font-weight: bold;color:#000000;text-align: center;"  autocomplete="off" value="<?php echo $ratesroom->fdv_child65; ?>" ></td>

                        <th style="width:95px; background: #0174DF; color: #fff; font-size: initial" rowspan="2"><i  aria-hidden="true"></i>&nbsp;<i class="fa fa-plane fa-2x" aria-hidden="true"></i><br>T-in</th>
                        <td rowspan="2" style="text-align: center;background:#3b5998;font-size: 135%;color: #000;">&nbsp;<input type="text" tabindex="130" onkeypress="validate(event)" name="t_in" id="t_in" size="25" maxlength="25" style="width: 50px; font-weight: bold;color:#000000;text-align: center;"  autocomplete="off" value="<?php echo $ratesroom->t_in; ?>" ></td>
                    </tr>
                    <tr>
                        <td style="text-align: center;background: #0174DF;font-size: 125%;color: #fff;"><b>MODERATE</td>
                        <td style="text-align: center;background: #0174DF;font-size: 125%;color: #fff;">&nbsp;<input style="width: 55px;font-weight: bold;color:#000000;text-align: center;" type="text" tabindex="69" onkeypress="validate(event)" name="sglm5" id="sglm5"  size="25" maxlength="25" autocomplete="off" value="<?php echo $ratesroom->sglm5; ?>"/></td>
                        <td style="text-align: center;background: #0174DF;font-size: 125%;color: #fff;">&nbsp;<input style="width: 55px;font-weight: bold;color:#000000;text-align: center;" type="text" tabindex="70" onkeypress="validate(event)" name="dblm5" id="dblm5"  size="25" maxlength="25" autocomplete="off" value="<?php echo $ratesroom->dblm5; ?>"/></td>
                        <td style="text-align: center;background: #0174DF;font-size: 125%;color: #fff;">&nbsp;<input style="width: 55px;font-weight: bold;color:#000000;text-align: center;" type="text" tabindex="71" onkeypress="validate(event)" name="tplm5" id="tplm5"  size="25" maxlength="25" autocomplete="off" value="<?php echo $ratesroom->tplm5; ?>"/></td>
                        <td style="text-align: center;background: #0174DF;font-size: 125%;color: #fff;">&nbsp;<input style="width: 55px;font-weight: bold;color:#000000;text-align: center;" type="text" tabindex="72" onkeypress="validate(event)" name="quam5" id="quam5"  size="25" maxlength="25" autocomplete="off" value="<?php echo $ratesroom->quam5; ?>"/></td>
                        <td style="text-align: center;background: #0174DF;font-size: 125%;color: #fff;">&nbsp;<input type="text" tabindex="73" onkeypress="validate(event)" name="chm65" id="chm65" size="25" maxlength="25" style="width: 55px;font-weight: bold;color:#000000;text-align: center;"   autocomplete="off"  value="<?php echo $ratesroom->chm65; ?>" ></td>
                        <td style="text-align: center;background: #0174DF;font-size: 135%;color: #fff;">&nbsp;<input type="text" tabindex="74" onkeypress="validate(event)" name="fdm_adult65" id="fdm_adult65" size="25" maxlength="25" style="width: 55px;font-weight: bold;color:#000000;text-align: center;"  autocomplete="off" value="<?php echo $ratesroom->fdm_adult65; ?>" ></td>
                        <td style="text-align: center;background: #0174DF;font-size: 135%;color: #fff;">&nbsp;<input type="text" tabindex="75" onkeypress="validate(event)" name="fdm_child65" id="fdm_child65" size="25" maxlength="25" style="width: 55px;font-weight: bold;color:#000000;text-align: center;"  autocomplete="off" value="<?php echo $ratesroom->fdm_child65; ?>" ></td>


                    </tr>
                    <tr>
                        <td rowspan="2" style="background: #0174DF;font-size: 120%; color: #fff;text-align: center;"><b>7 Days / 6 Nights<br> 7 Parks</b></td>
                        <td style="text-align: center;background: #D2E0E4;font-size: 125%;color: #000;"><b>VALUE</td>
                        <td style="text-align: center;background: #D2E0E4;font-size: 125%;color: #000;">&nbsp;<input style="width: 55px;font-weight: bold;color:#000000;text-align: center;" type="text" tabindex="76" onkeypress="validate(event)" name="sgl6" id="sgl6"  size="25" maxlength="25" autocomplete="off" value="<?php echo $ratesroom->sgl6; ?>"/></td>
                        <td style="text-align: center;background: #D2E0E4;font-size: 125%;color: #000;">&nbsp;<input style="width: 55px;font-weight: bold;color:#000000;text-align: center;" type="text" tabindex="77" onkeypress="validate(event)" name="dbl6" id="dbl6"  size="25" maxlength="25" autocomplete="off" value="<?php echo $ratesroom->dbl6; ?>"/></td>
                        <td style="text-align: center;background: #D2E0E4;font-size: 125%;color: #000;">&nbsp;<input style="width: 55px;font-weight: bold;color:#000000;text-align: center;" type="text" tabindex="78" onkeypress="validate(event)" name="tpl6" id="tpl6"  size="25" maxlength="25" autocomplete="off" value="<?php echo $ratesroom->tpl6; ?>"/></td>
                        <td style="text-align: center;background: #D2E0E4;font-size: 125%;color: #000;">&nbsp;<input style="width: 55px;font-weight: bold;color:#000000;text-align: center;" type="text" tabindex="79" onkeypress="validate(event)" name="qua6" id="qua6"  size="25" maxlength="25" autocomplete="off" value="<?php echo $ratesroom->qua6; ?>"/></td>
                        <td style="text-align: center;background: #D2E0E4;font-size: 125%;color: #000;">&nbsp;<input type="text" tabindex="80" onkeypress="validate(event)" name="chv76" id="chv76" size="25" maxlength="25" style="width: 55px;font-weight: bold;color:#000000;text-align: center;"   autocomplete="off" value="<?php echo $ratesroom->chv76; ?>" ></td>
                        <td style="text-align: center;background: #D2E0E4;font-size: 135%;color: #000;">&nbsp;<input type="text" tabindex="81" onkeypress="validate(event)" name="fdv_adult76" id="fdv_adult76" size="25" maxlength="25" style="width: 55px;font-weight: bold;color:#000000;text-align: center;"  autocomplete="off"  value="<?php echo $ratesroom->fdv_adult76; ?>" ></td>
                        <td style="text-align: center;background: #D2E0E4;font-size: 135%;color: #000;">&nbsp;<input type="text" tabindex="82" onkeypress="validate(event)" name="fdv_child76" id="fdv_child76" size="25" maxlength="25" style="width: 55px;font-weight: bold;color:#000000;text-align: center;"  autocomplete="off" value="<?php echo $ratesroom->fdv_child76; ?>" ></td>

                        <th style="width:95px; background: #0174DF; color: #fff;font-size: initial" rowspan="2"><i  aria-hidden="true"></i>&nbsp;<i class="fa fa-plane fa-2x" aria-hidden="true"></i><br>T-out</th>
                        <td rowspan="2" style="text-align: center;background:#3b5998;font-size: 135%;color: #000;">&nbsp;<input type="text" tabindex="131" onkeypress="validate(event)" name="t_out" id="t_out" size="25"  maxlength="25" style="width: 50px; font-weight: bold;color:#000000;text-align: center;" autocomplete="off" value="<?php echo $ratesroom->t_out; ?>" ></td>
                    </tr>
                    <tr>
                        <td style="text-align: center;background: #0174DF;font-size: 125%;color: #fff;"><b>MODERATE</td>
                        <td style="text-align: center;background: #0174DF;font-size: 125%;color: #fff;">&nbsp;<input style="width: 55px;font-weight: bold;color:#000000;text-align: center;" type="text" tabindex="83" onkeypress="validate(event)" name="sglm6" id="sglm6"  size="25"  maxlength="25" autocomplete="off" value="<?php echo $ratesroom->sglm6; ?>"/></td>
                        <td style="text-align: center;background: #0174DF;font-size: 125%;color: #fff;">&nbsp;<input style="width: 55px;font-weight: bold;color:#000000;text-align: center;" type="text" tabindex="84" onkeypress="validate(event)" name="dblm6" id="dblm6"  size="25"  maxlength="25" autocomplete="off" value="<?php echo $ratesroom->dblm6; ?>"/></td>
                        <td style="text-align: center;background: #0174DF;font-size: 125%;color: #fff;">&nbsp;<input style="width: 55px;font-weight: bold;color:#000000;text-align: center;" type="text" tabindex="85" onkeypress="validate(event)" name="tplm6" id="tplm6"  size="25"  maxlength="25" autocomplete="off" value="<?php echo $ratesroom->tplm6; ?>"/></td>
                        <td style="text-align: center;background: #0174DF;font-size: 125%;color: #fff;">&nbsp;<input style="width: 55px;font-weight: bold;color:#000000;text-align: center;" type="text" tabindex="86" onkeypress="validate(event)" name="quam6" id="quam6"  size="25"  maxlength="25" autocomplete="off" value="<?php echo $ratesroom->quam6; ?>"/></td>
                        <td style="text-align: center;background: #0174DF;font-size: 125%;color: #fff;">&nbsp;<input type="text" tabindex="87" onkeypress="validate(event)" name="chm76" id="chm76" size="25" maxlength="25" style="width: 55px;font-weight: bold;color:#000000;text-align: center;"   autocomplete="off" value="<?php echo $ratesroom->chm76; ?>" ></td>
                        <td style="text-align: center;background: #0174DF;font-size: 135%;color: #fff;">&nbsp;<input type="text" tabindex="88" onkeypress="validate(event)" name="fdm_adult76" id="fdm_adult76" size="25" maxlength="25" style="width: 55px;font-weight: bold;color:#000000;text-align: center;"  autocomplete="off" value="<?php echo $ratesroom->fdm_adult76; ?>" ></td>
                        <td style="text-align: center;background: #0174DF;font-size: 135%;color: #fff;">&nbsp;<input type="text" tabindex="89" onkeypress="validate(event)" name="fdm_child76" id="fdm_child76" size="25" maxlength="25" style="width: 55px;font-weight: bold;color:#000000;text-align: center;"  autocomplete="off" value="<?php echo $ratesroom->fdm_child76; ?>" ></td>


                    </tr>
                    <tr>
                        <td rowspan="2" style="background: #008000;font-size: 120%;color: #fff;text-align: center;"><b>8 Days / 7 Nights<br> 8 Parks</b></td>
                        <td style="text-align: center;background: #D2E0E4;font-size: 125%;color: #000;"><b>VALUE</td>
                        <td style="text-align: center;background: #D2E0E4;font-size: 125%;color: #000;">&nbsp;<input style="width: 55px;font-weight: bold;color:#000000;text-align: center;" type="text" tabindex="90" onkeypress="validate(event)" name="sgl7" id="sgl7"  size="25" maxlength="25" autocomplete="off" value="<?php echo $ratesroom->sgl7; ?>"/></td>
                        <td style="text-align: center;background: #D2E0E4;font-size: 125%;color: #000;">&nbsp;<input style="width: 55px;font-weight: bold;color:#000000;text-align: center;" type="text" tabindex="91" onkeypress="validate(event)" name="dbl7" id="dbl7"  size="25" maxlength="25" autocomplete="off" value="<?php echo $ratesroom->dbl7; ?>"/></td>
                        <td style="text-align: center;background: #D2E0E4;font-size: 125%;color: #000;">&nbsp;<input style="width: 55px;font-weight: bold;color:#000000;text-align: center;" type="text" tabindex="92" onkeypress="validate(event)" name="tpl7" id="tpl7"  size="25" maxlength="25" autocomplete="off" value="<?php echo $ratesroom->tpl7; ?>"/></td>
                        <td style="text-align: center;background: #D2E0E4;font-size: 125%;color: #000;">&nbsp;<input style="width: 55px;font-weight: bold;color:#000000;text-align: center;" type="text" tabindex="93" onkeypress="validate(event)" name="qua7" id="qua7"  size="25" maxlength="25" autocomplete="off" value="<?php echo $ratesroom->qua7; ?>"/></td>
                        <td style="text-align: center;background: #D2E0E4;font-size: 125%;color: #000;">&nbsp;<input type="text" tabindex="94" onkeypress="validate(event)" name="chv87" id="chv87" size="25" maxlength="25" style="width: 55px;font-weight: bold;color:#000000;text-align: center;"   autocomplete="off" value="<?php echo $ratesroom->chv87; ?>" ></td>
                        <td style="text-align: center;background: #D2E0E4;font-size: 135%;color: #000;">&nbsp;<input type="text" tabindex="95" onkeypress="validate(event)" name="fdv_adult87" id="fdv_adult87" size="25" maxlength="25" style="width: 55px;font-weight: bold;color:#000000;text-align: center;"  autocomplete="off"  value="<?php echo $ratesroom->fdv_adult87; ?>" ></td>
                        <td style="text-align: center;background: #D2E0E4;font-size: 135%;color: #000;">&nbsp;<input type="text" tabindex="96" onkeypress="validate(event)" name="fdv_child87" id="fdv_child87" size="25" maxlength="25" style="width: 55px;font-weight: bold;color:#000000;text-align: center;"  autocomplete="off" value="<?php echo $ratesroom->fdv_child87; ?>" ></td>

                        <th style="width:95px; background:#0174DF; color: #fff; font-size: initial" rowspan="2"><i  aria-hidden="true"></i>&nbsp;<i class="fa fa-car fa-2x" aria-hidden="true"></i><br>Car-in</th>
                        <td rowspan="2" style="text-align: center;background:#3b5998;font-size: 135%;color: #000;">&nbsp;<input type="text" tabindex="132" onkeypress="validate(event)" name="car_in" id="car_in" size="25" maxlength="25" style="width: 50px; font-weight: bold;color:#000000;text-align: center;"  autocomplete="off" value="<?php echo $ratesroom->car_in; ?>" ></td>
                    </tr>
                    <tr>
                        <td style="text-align: center;background: #0174DF;font-size: 125%;color: #fff;"><b>MODERATE</td>
                        <td style="text-align: center;background: #0174DF;font-size: 125%;color: #fff;">&nbsp;<input style="width: 55px;font-weight: bold;color:#000000;text-align: center;" type="text" tabindex="97" onkeypress="validate(event)" name="sglm7" id="sglm7"  size="25" maxlength="25" autocomplete="off" value="<?php echo $ratesroom->sglm7; ?>"/></td>
                        <td style="text-align: center;background: #0174DF;font-size: 125%;color: #fff;">&nbsp;<input style="width: 55px;font-weight: bold;color:#000000;text-align: center;" type="text" tabindex="98" onkeypress="validate(event)" name="dblm7" id="dblm7"  size="25" maxlength="25" autocomplete="off" value="<?php echo $ratesroom->dblm7; ?>"/></td>
                        <td style="text-align: center;background: #0174DF;font-size: 125%;color: #fff;">&nbsp;<input style="width: 55px;font-weight: bold;color:#000000;text-align: center;" type="text" tabindex="99" onkeypress="validate(event)" name="tplm7" id="tplm7"  size="25" maxlength="25" autocomplete="off" value="<?php echo $ratesroom->tplm7; ?>"/></td>
                        <td style="text-align: center;background: #0174DF;font-size: 125%;color: #fff;">&nbsp;<input style="width: 55px;font-weight: bold;color:#000000;text-align: center;" type="text" tabindex="100" onkeypress="validate(event)" name="quam7" id="quam7"  size="25" maxlength="25" autocomplete="off" value="<?php echo $ratesroom->quam7; ?>"/></td>
                        <td style="text-align: center;background: #0174DF;font-size: 125%;color: #fff;">&nbsp;<input type="text" tabindex="101" onkeypress="validate(event)" name="chm87" id="chm87" size="25" maxlength="25" style="width: 55px;font-weight: bold;color:#000000;text-align: center;"  autocomplete="off" value="<?php echo $ratesroom->chm87; ?>" ></td>
                        <td style="text-align: center;background: #0174DF;font-size: 135%;color: #fff;">&nbsp;<input type="text" tabindex="102" onkeypress="validate(event)" name="fdm_adult87" id="fdm_adult87" size="25" maxlength="25" style="width: 55px;font-weight: bold;color:#000000;text-align: center;"  autocomplete="off" value="<?php echo $ratesroom->fdm_adult87; ?>" ></td>
                        <td style="text-align: center;background: #0174DF;font-size: 135%;color: #fff;">&nbsp;<input type="text" tabindex="103" onkeypress="validate(event)" name="fdm_child87" id="fdm_child87" size="25" maxlength="25" style="width: 55px;font-weight: bold;color:#000000;text-align: center;"  autocomplete="off" value="<?php echo $ratesroom->fdm_child87; ?>" ></td>


                    </tr>
                    <tr>
                        <td rowspan="2" style="background: #0174DF;font-size: 120%;color: #fff;text-align: center;"><b>9 Days / 8 Nights<br> 9 Parks</b></td>
                        <td style="text-align: center;background: #D2E0E4;font-size: 125%;color: #000;"><b>VALUE</td>
                        <td style="text-align: center;background: #D2E0E4;font-size: 125%;color: #000;">&nbsp;<input style="width: 55px;font-weight: bold;color:#000000;text-align: center;" type="text" tabindex="104" onkeypress="validate(event)" name="sgl8" id="sgl8"  size="25" maxlength="25" autocomplete="off" value="<?php echo $ratesroom->sgl8; ?>"/></td>
                        <td style="text-align: center;background: #D2E0E4;font-size: 125%;color: #000;">&nbsp;<input style="width: 55px;font-weight: bold;color:#000000;text-align: center;" type="text" tabindex="105" onkeypress="validate(event)" name="dbl8" id="dbl8"  size="25" maxlength="25" autocomplete="off" value="<?php echo $ratesroom->dbl8; ?>"/></td>
                        <td style="text-align: center;background: #D2E0E4;font-size: 125%;color: #000;">&nbsp;<input style="width: 55px;font-weight: bold;color:#000000;text-align: center;" type="text" tabindex="106" onkeypress="validate(event)" name="tpl8" id="tpl8"  size="25" maxlength="25" autocomplete="off" value="<?php echo $ratesroom->tpl8; ?>"/></td>
                        <td style="text-align: center;background: #D2E0E4;font-size: 125%;color: #000;">&nbsp;<input style="width: 55px;font-weight: bold;color:#000000;text-align: center;" type="text" tabindex="107" onkeypress="validate(event)" name="qua8" id="qua8"  size="25" maxlength="25" autocomplete="off" value="<?php echo $ratesroom->qua8; ?>"/></td>
                        <td style="text-align: center;background: #D2E0E4;font-size: 125%;color: #000;">&nbsp;<input type="text" tabindex="108" onkeypress="validate(event)" name="chv98" id="chv98" size="25" maxlength="25" style="width: 55px;font-weight: bold;color:#000000;text-align: center;"   autocomplete="off" value="<?php echo $ratesroom->chv98; ?>" ></td>
                        <td style="text-align: center;background: #D2E0E4;font-size: 135%;color: #000;">&nbsp;<input type="text" tabindex="109" onkeypress="validate(event)" name="fdv_adult98" id="fdv_adult98" size="25" maxlength="25" style="width: 55px;font-weight: bold;color:#000000;text-align: center;"  autocomplete="off"  value="<?php echo $ratesroom->fdv_adult98; ?>" ></td>
                        <td style="text-align: center;background: #D2E0E4;font-size: 135%;color: #000;">&nbsp;<input type="text" tabindex="110" onkeypress="validate(event)" name="fdv_child98" id="fdv_child98" size="25" maxlength="25" style="width: 55px;font-weight: bold;color:#000000;text-align: center;"  autocomplete="off" value="<?php echo $ratesroom->fdv_child98; ?>" ></td>

                        <th style="width:95px; background:#0174DF; color: #fff;font-size: initial" rowspan="2"><i  aria-hidden="true"></i>&nbsp;<i class="fa fa-car fa-2x" aria-hidden="true"></i><br>Car-out</th>
                        <td rowspan="2" style="text-align: center;background: #3b5998;font-size: 135%;color: #000;">&nbsp;<input type="text" tabindex="133" onkeypress="validate(event)" name="car_out" id="car_out" size="25" maxlength="25" style="width: 50px; font-weight: bold;color:#000000;text-align: center;"  autocomplete="off" value="<?php echo $ratesroom->car_out; ?>" ></td>
                    </tr>
                    <tr>
                        <td style="text-align: center;background: #0174DF;font-size: 125%;color: #fff;"><b>MODERATE</td>
                        <td style="text-align: center;background: #0174DF;font-size: 125%;color: #fff;">&nbsp;<input style="width: 55px;font-weight: bold;color:#000000;text-align: center;" type="text" tabindex="111" onkeypress="validate(event)" name="sglm8" id="sglm8"  size="25" maxlength="25" autocomplete="off" value="<?php echo $ratesroom->sglm8; ?>"/></td>
                        <td style="text-align: center;background: #0174DF;font-size: 125%;color: #fff;">&nbsp;<input style="width: 55px;font-weight: bold;color:#000000;text-align: center;" type="text" tabindex="112" onkeypress="validate(event)" name="dblm8" id="dblm8"  size="25" maxlength="25" autocomplete="off" value="<?php echo $ratesroom->dblm8; ?>"/></td>
                        <td style="text-align: center;background: #0174DF;font-size: 125%;color: #fff;">&nbsp;<input style="width: 55px;font-weight: bold;color:#000000;text-align: center;" type="text" tabindex="113" onkeypress="validate(event)" name="tplm8" id="tplm8"  size="25" maxlength="25" autocomplete="off" value="<?php echo $ratesroom->tplm8; ?>"/></td>
                        <td style="text-align: center;background: #0174DF;font-size: 125%;color: #fff;">&nbsp;<input style="width: 55px;font-weight: bold;color:#000000;text-align: center;" type="text" tabindex="114" onkeypress="validate(event)" name="quam8" id="quam8"  size="25" maxlength="25" autocomplete="off" value="<?php echo $ratesroom->quam8; ?>"/></td>
                        <td style="text-align: center;background: #0174DF;font-size: 125%;color: #fff;">&nbsp;<input type="text" tabindex="115" onkeypress="validate(event)" name="chm98" id="chm98" size="25" maxlength="25" style="width: 55px;font-weight: bold;color:#000000;text-align: center;"   autocomplete="off" value="<?php echo $ratesroom->chm98; ?>" ></td>
                        <td style="text-align: center;background: #0174DF;font-size: 135%;color: #fff;">&nbsp;<input type="text" tabindex="116" onkeypress="validate(event)" name="fdm_adult98" id="fdm_adult98" size="25" maxlength="25" style="width: 55px;font-weight: bold;color:#000000;text-align: center;"  autocomplete="off" value="<?php echo $ratesroom->fdm_adult98; ?>" ></td>
                        <td style="text-align: center;background: #0174DF;font-size: 135%;color: #fff;">&nbsp;<input type="text" tabindex="117" onkeypress="validate(event)" name="fdm_child98" id="fdm_child98" size="25" maxlength="25" style="width: 55px;font-weight: bold;color:#000000;text-align: center;"  autocomplete="off" value="<?php echo $ratesroom->fdm_child98; ?>" ></td>


                    </tr>
                    
                     
                </table>
                <table border = "5" style="margin: 0 auto; margin-top: 0.5%;">
                    
                    <tr>
                        <td rowspan="3" style="text-align: center;background: #FF0000;font-size: 125%;color: #fff; width: 128px;"><b>Room Surcharge Per Night</b></td>
                        <td style="text-align: center;background: #FF0000; color: #fff; width: 90px; height:24px;">
                            
<!--                            <input name="btncancel" type="button" id="btncancel"  style="height:19px; width: 88px; padding-top: 0.4px; font-weight:bold; font-size: 14px;" value="CANCEL" onclick="eliminar_rango1();eliminar_rango2();eliminar_rango3();eliminar_rango4();"  />-->
                        </td>
                        <td style="text-align: center;background: #0174DF; color: #fff; width: 285px; height:24px;">

                               
                                
                                <input type="text" tabindex="2" name="fecha_iniciale" id="fecha_iniciale" size="35" maxlength="50" placeholder="Start Date" title="M-D-Y" style="width: 80px; margin-top:2px; margin-right:10px; text-align: center; font-weight: bold; color:#000;" required="" value="<?php echo $fecha_schv; ?>" onchange = "fechale1(); fechaFinale(this.value);"  autocomplete="off"/>
                                <input type="text" name="fecha_schv"  id="fecha_schv" title="fecha_schv" size="10" maxlength="15" style="display:none; color:#000; text-align:center; width:80px; margin-left:7px; height: 12px; padding-top:3px; margin-top: 5px;" value="<?php if (isset($ratesroom)) {  echo ($ratesroom->fecha_schv == "0000-00-00"?"00-00-0000":date('Y-m-d', strtotime($ratesroom->fecha_schv))); }  ?>" autocomplete="off"/>
                                                               
                                <input name="buttonx" type="button" id="buttonx" title="Cancel" style="position:absolute; background-color: red; margin-left:-14px; padding:0px; padding-left:2px; height:18px; width:15px; margin-top:3px; color:#fff;" value="x" onclick="eliminar_rango1();" />
                                
                                <input type="text" tabindex="2" name="fecha_finale" id="fecha_finale" size="35" maxlength="50" placeholder="End Date" title="M-D-Y" style=" width: 80px; margin-top:-20px; margin-right:-1px; text-align: center; font-weight: bold; color:#000;" required="" value="<?php echo $fecha_schm; ?>" onchange = "fechale2();" autocomplete="off"/>
                                <input type="text" name="fecha_schm"  id="fecha_schm" title="fecha_schm" size="10" maxlength="15" style="display:none; color:#000; text-align:center; width:80px; margin-left:7px; height: 12px; padding-top:3px; margin-top: 5px;" value="<?php if (isset($ratesroom)) {  echo ($ratesroom->fecha_schm == "0000-00-00"?"00-00-0000":date('Y-m-d', strtotime($ratesroom->fecha_schm))); }  ?>" autocomplete="off"/>
                        
                        </td>
                        
                        <td style="text-align: center;background: #4B0082; color: #fff; width: 185px; height:24px;">
                                
                                
                                <input type="text" tabindex="2" name="fecha_iniciale2" id="fecha_iniciale2" size="35" maxlength="50" placeholder="Start Date" title="M-D-Y" style="width: 80px; margin-top:2px; margin-right:10px; text-align: center; font-weight: bold; color:#000;" required="" value="<?php echo $fecha_schv2; ?>" onchange = "fechale3(); fechaFinale2(this.value);" autocomplete="off"/>
                                <input type="text" name="fecha_schv2"  id="fecha_schv2" title="fecha_schv2" size="10" maxlength="15" style="display:none; color:#000; text-align:center; width:80px; margin-left:7px; height: 12px; padding-top:3px; margin-top: 5px;" value="<?php  if (isset($ratesroom)) {  echo ($ratesroom->fecha_schv2 == "0000-00-00"?"00-00-0000":date('Y-m-d', strtotime($ratesroom->fecha_schv2))); }  ?>" autocomplete="off"/>
                                                               
                                <input name="buttonx2" type="button" id="buttonx2" title="Cancel" style="position:absolute; background-color: red; margin-left:-14px; padding:0px; padding-left:2px; height:18px; width:15px; margin-top:3px; color:#fff;" value="x" onclick="eliminar_rango2();" />
                                
                                <input type="text" tabindex="2" name="fecha_finale2" id="fecha_finale2" size="35" maxlength="50" placeholder="End Date" title="M-D-Y" style=" width: 80px; margin-top:-20px; margin-right:-1px; text-align: center; font-weight: bold; color:#000;" required="" value="<?php echo $fecha_schm2; ?>" onchange = "fechale4();" autocomplete="off"/>
                                <input type="text" name="fecha_schm2"  id="fecha_schm2" title="fecha_schm2" size="10" maxlength="15" style="display:none; color:#000; text-align:center; width:80px; margin-left:7px; height: 12px; padding-top:3px; margin-top: 5px;" value="<?php if (isset($ratesroom)) {  echo ($ratesroom->fecha_schm2 == "0000-00-00"?"00-00-0000":date('Y-m-d', strtotime($ratesroom->fecha_schm2))); }  ?>" autocomplete="off"/>
                        
                        
                        </td>
                        
                        <td style="text-align: center;background: #0174DF; color: #fff; width: 185px; height:24px;">
                            
                                <input type="text" tabindex="2" name="fecha_iniciale3" id="fecha_iniciale3" size="35" maxlength="50" placeholder="Start Date" title="M-D-Y" style="width: 80px; margin-top:2px; margin-right:10px; text-align: center; font-weight: bold; color:#000;" required="" value="<?php echo $fecha_schv3; ?>" onchange = "fechale5(); fechaFinale3(this.value);" autocomplete="off"/>
                                <input type="text" name="fecha_schv3"  id="fecha_schv3" title="fecha_schv3" size="10" maxlength="15" style="display:none; color:#000; text-align:center; width:80px; margin-left:7px; height: 12px; padding-top:3px; margin-top: 5px;" value="<?php if (isset($ratesroom)) {  echo ($ratesroom->fecha_schv3 == "0000-00-00"?"00-00-0000":date('Y-m-d', strtotime($ratesroom->fecha_schv3))); }  ?>" autocomplete="off"/>
                                
                                <input name="buttonx3" type="button" id="buttonx3" title="Cancel" style="position:absolute; background-color: red; margin-left:-14px; padding:0px; padding-left:2px; height:18px; width:15px; margin-top:3px; color:#fff;" value="x" onclick="eliminar_rango3();" />
                               
                                <input type="text" tabindex="2" name="fecha_finale3" id="fecha_finale3" size="35" maxlength="50" placeholder="End Date" title="M-D-Y" style=" width: 80px; margin-top:-20px; margin-right:-1px; text-align: center; font-weight: bold; color:#000;" required="" value="<?php echo $fecha_schm3; ?>" onchange = "fechale6();" autocomplete="off"/>
                                <input type="text" name="fecha_schm3"  id="fecha_schm3" title="fecha_schm3" size="10" maxlength="15" style="display:none; color:#000; text-align:center; width:80px; margin-left:7px; height: 12px; padding-top:3px; margin-top: 5px;" value="<?php if (isset($ratesroom)) {  echo ($ratesroom->fecha_schm3 == "0000-00-00"?"00-00-0000":date('Y-m-d', strtotime($ratesroom->fecha_schm3))); }  ?>" autocomplete="off"/>
                        
                            
                        </td>
                        
                        <td style="text-align: center;background: #4B0082; color: #fff; width: 185px; height:24px;">
                                
                                <input type="text" tabindex="2" name="fecha_iniciale4" id="fecha_iniciale4" size="35" maxlength="50" placeholder="Start Date" title="M-D-Y" style="width: 80px; margin-top:2px; margin-right:10px; text-align: center; font-weight: bold; color:#000;" required="" value="<?php echo $fecha_schv4; ?>" onchange = "fechale7(); fechaFinale4(this.value);" autocomplete="off"/>
                                <input type="text" name="fecha_schv4"  id="fecha_schv4" title="fecha_schv4" size="10" maxlength="15" style="display:none; color:#000; text-align:center; width:80px; margin-left:7px; height: 12px; padding-top:3px; margin-top: 5px;" value="<?php if (isset($ratesroom)) {  echo ($ratesroom->fecha_schv4 == "0000-00-00"?"00-00-0000":date('Y-m-d', strtotime($ratesroom->fecha_schv4))); }  ?>" autocomplete="off"/>
                                                               
                                <input name="buttonx4" type="button" id="buttonx4" title="Cancel" style="position:absolute; background-color: red; margin-left:-14px; padding:0px; padding-left:2px; height:18px; width:15px; margin-top:3px; color:#fff;" value="x" onclick="eliminar_rango4();" />
                                
                                <input type="text" tabindex="2" name="fecha_finale4" id="fecha_finale4" size="35" maxlength="50" placeholder="End Date" title="M-D-Y" style=" width: 80px; margin-top:-20px; margin-right:-1px; text-align: center; font-weight: bold; color:#000;" required="" value="<?php echo $fecha_schm4; ?>" onchange = "fechale8();" autocomplete="off"/>
                                <input type="text" name="fecha_schm4"  id="fecha_schm4" title="fecha_schm4" size="10" maxlength="15" style="display:none; color:#000; text-align:center; width:80px; margin-left:7px; height: 12px; padding-top:3px; margin-top: 5px;" value="<?php if (isset($ratesroom)) {  echo ($ratesroom->fecha_schm4 == "0000-00-00"?"00-00-0000":date('Y-m-d', strtotime($ratesroom->fecha_schm4))); }  ?>" autocomplete="off"/>
                                
                        </td>
                        
                    </tr>
                
                    <tr>

                        <td style="text-align: center;background: #D2E0E4;font-size: 125%;color: #000; width: 90px;"><b>VALUE</td>
                        <td style="text-align: center;background: #D2E0E4;font-size: 125%;color: #000; width: 285px;">&nbsp;<input title="$ (Value)" type="text"  onkeypress="validate(event)" name="schv" id="schv"  size="25" maxlength="25"  style="margin-left:-7px; text-align: center; width: 55px;font-weight: bold;color:#000000;" value="<?php echo $ratesroom->schv; ?>" autocomplete="off" ></td>
                        <td style="text-align: center;background: #D2E0E4;font-size: 125%;color: #000; width: 285px;">&nbsp;<input title="$ (Value)" type="text"  onkeypress="validate(event)" name="schv2" id="schv2"  size="25" maxlength="25"  style="margin-left:-7px; text-align: center; width: 55px;font-weight: bold;color:#000000;" value="<?php echo $ratesroom->schv2; ?>" autocomplete="off" ></td>
                        <td style="text-align: center;background: #D2E0E4;font-size: 125%;color: #000; width: 285px;">&nbsp;<input title="$ (Value)" type="text"  onkeypress="validate(event)" name="schv3" id="schv3"  size="25" maxlength="25"  style="margin-left:-7px; text-align: center; width: 55px;font-weight: bold;color:#000000;" value="<?php echo $ratesroom->schv3; ?>" autocomplete="off" ></td>
                        <td style="text-align: center;background: #D2E0E4;font-size: 125%;color: #000; width: 285px;">&nbsp;<input title="$ (Value)" type="text"  onkeypress="validate(event)" name="schv4" id="schv4" size="25" maxlength="25"  style="margin-left:-7px; text-align: center; width: 55px;font-weight: bold;color:#000000;" value="<?php echo $ratesroom->schv4; ?>" autocomplete="off" ></td>

                    </tr>
                    
                    <tr>
                        <td style="text-align: center;background: #0174DF;font-size: 125%;color: #fff; width: 90px;"><b>MODERATE</td>
                        <td style="text-align: center;background: #0174DF;font-size: 125%;color: #fff; width: 285px;">&nbsp;<input title="$ (Moderate)" type="text"  onkeypress="validate(event)" name="schm" id="schm"  size="25" maxlength="25"  style="text-align: center; margin-left: -8px; width: 55px;font-weight: bold;color:#000000;" value="<?php echo $ratesroom->schm; ?>" autocomplete="off" ></td>
                        <td style="text-align: center;background: #0174DF;font-size: 125%;color: #fff; width: 185px;">&nbsp;<input title="$ (Moderate)" type="text"  onkeypress="validate(event)" name="schm2" id="schm2"  size="25" maxlength="25"  style="text-align: center; margin-left: -8px; width: 55px;font-weight: bold;color:#000000;" value="<?php echo $ratesroom->schm2; ?>" autocomplete="off" ></td>
                        <td style="text-align: center;background: #0174DF;font-size: 125%;color: #fff; width: 185px;">&nbsp;<input title="$ (Moderate)" type="text"  onkeypress="validate(event)" name="schm3" id="schm3"  size="25" maxlength="25"  style="text-align: center; margin-left: -8px; width: 55px;font-weight: bold;color:#000000;" value="<?php echo $ratesroom->schm3; ?>" autocomplete="off" ></td>
                        <td style="text-align: center;background: #0174DF;font-size: 125%;color: #fff; width: 185px;">&nbsp;<input title="$ (Moderate)" type="text"  onkeypress="validate(event)" name="schm4" id="schm4"  size="25" maxlength="25"  style="text-align: center; margin-left: -8px; width: 55px;font-weight: bold;color:#000000;" value="<?php echo $ratesroom->schm4; ?>" autocomplete="off" ></td>

                    </tr>
                    
                </table>
                
                

                

                
                <div style="" id="resultado"></div>



                <input type="hidden" id="dupli" name="dupli" value="<?php echo $ratesroom->dupli = 0; ?>"/>
                <input type="button" style="display:none" value="enviar" onclick="enviar()">               

                <input name="id" type="hidden" id="id" value="<?php echo $ratesroom->id; ?>" />
                <input type="hidden" name="rate_no" placeholder="" style="width: 14%;" id="rate_no" value="<?php echo $ratesroom->rate_no; ?>">
                <?php
                $sql2 = "SELECT id FROM hoteles where categoria='6'";
                $rs2 = Doo::db()->query($sql2);
                $id_hotel = $rs2->fetchAll();

                foreach ($id_hotel as $idh){
                    $idhotel = $idh['id'];
                }
                    ?>   
                
                
                <input name="id_hotel" type="hidden" id="id_hotel" value="<?php echo $idhotel; ?>" />
            </form>
        </fieldset>
    </div>

    


</div>
</form>
<div id="to"></div>
</div>
<script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/form.js"></script>
<script type="text/javascript">

                    $("#fecha_ini").datepicker({
                        dateFormat: 'mm-dd-yy',
                        minDate: 0,
                        changeMonth: true,
                        changeYear: true,
                        numberOfMonths: 2
                    });

                    $("#fecha_fin").datepicker({
                        dateFormat: 'mm-dd-yy',
                        minDate: 0,
                        changeMonth: true,
                        changeYear: true,
                        numberOfMonths: 2
                    });
                    
                    $("#fecha_iniciale").datepicker({
                        dateFormat: 'mm-dd-yy',
                        minDate: 0,
                        changeMonth: true,
                        changeYear: true,
                        numberOfMonths: 2
                    });                   


                    $("#fecha_finale").datepicker({
                        dateFormat: 'mm-dd-yy',
                        minDate: 0,
                        changeMonth: true,
                        changeYear: true,
                        numberOfMonths: 2
                    });
                    

                    $("#fecha_iniciale2").datepicker({
                        dateFormat: 'mm-dd-yy',
                        minDate: 0,
                        changeMonth: true,
                        changeYear: true,
                        numberOfMonths: 2
                    });
                                        
                    $("#fecha_finale2").datepicker({
                        dateFormat: 'mm-dd-yy',
                        minDate: 0,
                        changeMonth: true,
                        changeYear: true,
                        numberOfMonths: 2
                    });
                    

                    $("#fecha_iniciale3").datepicker({
                        dateFormat: 'mm-dd-yy',
                        minDate: 0,
                        changeMonth: true,
                        changeYear: true,
                        numberOfMonths: 2
                    });
                                        
                    $("#fecha_finale3").datepicker({
                        dateFormat: 'mm-dd-yy',
                        minDate: 0,
                        changeMonth: true,
                        changeYear: true,
                        numberOfMonths: 2
                    });
                    
                    $("#fecha_iniciale4").datepicker({
                        dateFormat: 'mm-dd-yy',
                        minDate: 0,
                        changeMonth: true,
                        changeYear: true,
                        numberOfMonths: 2
                    });
                                        
                    $("#fecha_finale4").datepicker({
                        dateFormat: 'mm-dd-yy',
                        minDate: 0,
                        changeMonth: true,
                        changeYear: true,
                        numberOfMonths: 1
                    });
                    
                    //cargamos en las fechas iniciales de cada rango la fecha inicial del rango principal
                    function fechaIni1(menor) {
        
                        var d = new Date(menor);       
                        d.setTime(d.getTime() + 0 * 24 * 60 * 60 * 1000);        
                        $('#fecha_iniciale').datepicker('option', 'minDate', d);
                        $('#fecha_iniciale2').datepicker('option', 'minDate', d);
                        $('#fecha_iniciale3').datepicker('option', 'minDate', d);
                        $('#fecha_iniciale4').datepicker('option', 'minDate', d);
                    }
                    
                    //cargamos en la fecha final del rango principal el mes y el ano de la fecha inicial
                    function fechaFin(menor) {
        
                        var d = new Date(menor);       
                        d.setTime(d.getTime() + 0 * 24 * 60 * 60 * 1000);        
                        $('#fecha_fin').datepicker('option', 'minDate', d);

                    }
                    
                    function fechaFinale(menor) {
        
                        var d = new Date(menor);       
                        d.setTime(d.getTime() + 0 * 24 * 60 * 60 * 1000);        
                        $('#fecha_finale').datepicker('option', 'minDate', d);

                    }
                    
                    function fechaFinale2(menor) {
        
                        var d = new Date(menor);       
                        d.setTime(d.getTime() + 0 * 24 * 60 * 60 * 1000);        
                        $('#fecha_finale2').datepicker('option', 'minDate', d);

                    }
                    
                    function fechaFinale3(menor) {
        
                        var d = new Date(menor);       
                        d.setTime(d.getTime() + 0 * 24 * 60 * 60 * 1000);        
                        $('#fecha_finale3').datepicker('option', 'minDate', d);

                    }
                    
                    function fechaFinale4(menor) {
        
                        var d = new Date(menor);       
                        d.setTime(d.getTime() + 0 * 24 * 60 * 60 * 1000);        
                        $('#fecha_finale4').datepicker('option', 'minDate', d);

                    }
                    
                    
                    
                    function validateForm() {

                        var sErrMsg = "";
                        var flag = true;
                        var estado = "<?php echo $data['dato']; ?>";

                        // sErrMsg += validateInt($('#capacity').val(),$('#l_capacity').html() , true);
                        //sErrMsg += validateText($('#frecuency').val(),$('#l_frecuency').html() , true);
                        
                        if ($("#rate").val() == "") {
                                alert("Por favor Asigne un Nombre al Tarifario");
                                document.getElementById('rate').style.background = 'yellow';
                                document.getElementById('rate').style.color = '#000';
                                $("#rate").focus();

                                return false;
                        }
                        
//                        if ($("#sodastereo").val() == "" && estado == "New") {
//                                alert("Por favor Seleccione una Agencia");
//                                document.getElementById('agencia').style.background = 'yellow';
//                                document.getElementById('agencia').style.color = '#000';
//                                $("#agencia").focus();
//
//                                return false;
//                        }
                        
                        if ($("#fecha_ini").val() == "") {
                                alert("Por favor Asigne una fecha Inicial");
                //                document.getElementById('fecha_ini').style.background = '#4682B4';
                //                document.getElementById('fecha_ini').style.color = '#fff';
                                $("#fecha_ini").focus();

                                return false;
                        }

                        if ($("#fecha_fin").val() == "") {
                                alert("Por favor Asigne una Fecha Final");
                //                document.getElementById('fecha_fin').style.background = '#4682B4';
                //                document.getElementById('fecha_fin').style.color = '#fff';
                                $("#fecha_fin").focus();

                                return false;
                        }

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

<script type="text/javascript">
    
    function cambiafondo() {
       
       document.getElementById('rate').style.background = '#FFFFFF';
       document.getElementById('rate').style.color = '#000';
       document.getElementById('agencia').style.background = '#FFFFFF';
       document.getElementById('agencia').style.color = '#000';
       
//       document.getElementById('child').style.background = '#FFFFFF';
//       document.getElementById('child').style.color = '#696969';
//       
//       document.getElementById('parquecitos').style.background = '#FFFFFF';
//       document.getElementById('parquecitos').style.color = '#000';
//       
//       document.getElementById('id_grupo').style.background = '#FFFFFF';
//       document.getElementById('id_grupo').style.color = '#000';
//       
       
    }
    
</script>

<script>

    var z;
    function capturar()
    {
        var resultado = "ninguno";

        var porNombre = document.getElementsByName("tarifario");
        // Recorremos todos los valores del radio button para encontrar el
        // seleccionado
        for (var i = 0; i < porNombre.length; i++)
        {
            if (porNombre[i].checked)
                resultado = porNombre[i].value;

        }

        //document.getElementById("resultado").innerHTML=" \
        //Value: "+resultado;
        z = document.getElementById("resultado").innerHTML = " \ " + resultado;


    }



    

</script>


<script>
    
    function justNumbers(e)
    {
        var keynum = window.event ? window.event.keyCode : e.which;
        if ((keynum == 8) || (keynum == 46) || (keynum == 45)
            return true;

        return /\d/.test(String.fromCharCode(keynum));

    }
    
</script>

<script>
    
    function eliminar_rango1()
    {
      document.getElementById('fecha_iniciale').value = "";
      document.getElementById('fecha_finale').value = "";
      document.getElementById('fecha_schv').value = "";
      document.getElementById('fecha_schm').value = "";
      document.getElementById('schv').value = "0.00";
      document.getElementById('schm').value = "0.00";
    }
    
</script>

<script>
    
    function eliminar_rango2()
    {
      document.getElementById('fecha_iniciale2').value = "";
      document.getElementById('fecha_finale2').value = "";
      document.getElementById('fecha_schv2').value = "";
      document.getElementById('fecha_schm2').value = "";
      document.getElementById('schv2').value = "0.00";
      document.getElementById('schm2').value = "0.00";
    }
    
</script>

<script>
    
    function eliminar_rango3()
    {
      document.getElementById('fecha_iniciale3').value = "";
      document.getElementById('fecha_finale3').value = "";
      document.getElementById('fecha_schv3').value = "";
      document.getElementById('fecha_schm3').value = "";
      document.getElementById('schv3').value = "0.00";
      document.getElementById('schm3').value = "0.00";
    }
    
</script>

<script>
    
    function eliminar_rango4()
    {
      document.getElementById('fecha_iniciale4').value = "";
      document.getElementById('fecha_finale4').value = "";
      document.getElementById('fecha_schv4').value = "";
      document.getElementById('fecha_schm4').value = "";
      document.getElementById('schv4').value = "0.00";
      document.getElementById('schm4').value = "0.00";
    }
    
</script>

<script>

    $(document).ready(function () {
//set initial state.
        $('#dupli').val($(this).is(':checked'));

        $('#bck_tarifario').change(function () {
            $('#dupli').val($(this).is(':checked'));
        });

        $('#bck_tarifario').mousedown(function () {
            if (!$(this).is(':checked')) {

                $(this).trigger("change");
            }
        });
    });
</script>

<script type="text/javascript">
    function validate(evt) {
        var theEvent = evt || window.event;
        var key = theEvent.keyCode || theEvent.which;
        key = String.fromCharCode(key);
        var regex = /[0123456789-]|\./;
        if (!regex.test(key)) {
            theEvent.returnValue = false;
            if (theEvent.preventDefault)
                theEvent.preventDefault();
        }
    }
</script>

<script type="text/javascript">
    
    $(window).load(function () {                        
          
          comprobarScreen();           
  
          //////////////////////////////////////////////////////////////////
          var fecha1 =  document.getElementById('fecha_iniciale').value;           
               
          
          var dia = parseInt(fecha1.substr(0,2));
          var mes = parseInt(fecha1.substr(3,2));
          var year = parseInt(fecha1.substr(6,4));
        
        
            if(dia >=1 && dia<=9){

                 dia = ("0" + parseInt(fecha1.substr(0,2)));
            }else{
                 dia = parseInt(fecha1.substr(0,2));
            }

            if(mes >=1 && mes<=9){
                 mes = ("0" + parseInt(fecha1.substr(3,2)));
            }else{
                 mes = parseInt(fecha1.substr(3,2));
            }
            
            if(fecha1 == ""){

              fecha_t = "";

            }else{

              var fecha_t = year + '-' + dia + '-' + mes; 

            }
            
          //var fecha_t = year + '-' + dia + '-' + mes; 
          ///////////////////////////////////////////////////////////////////
          
         
          ///////////////////////////////////////////////////////////////////
          var fecha2 = document.getElementById('fecha_finale').value;
          
          var dia2 = parseInt(fecha2.substr(0,2));
          var mes2 = parseInt(fecha2.substr(3,2));
          var year2 = parseInt(fecha2.substr(6,4));
        
        
            if(dia2 >=1 && dia2<=9){

                 dia2 = ("0" + parseInt(fecha2.substr(0,2)));
            }else{
                 dia2 = parseInt(fecha2.substr(0,2));
            }

            if(mes2 >=1 && mes2<=9){
                 mes2 = ("0" + parseInt(fecha2.substr(3,2)));
            }else{
                 mes2 = parseInt(fecha2.substr(3,2));
            }
            
            
            
          if(fecha2 == ""){

              fecha_t2 = "";

            }else{

              var fecha_t2 = year2 + '-' + dia2 + '-' + mes2; 

          }
            
          //var fecha_t2 = year2 + '-' + dia2 + '-' + mes2;   
          
          
          ////////////////////////////////////////////////////////////////////
          
          
          ////////////////////////////////////////////////////////////////////
          var fecha3 =  document.getElementById('fecha_iniciale2').value;           
          var dia3 = parseInt(fecha3.substr(0,2));
          var mes3 = parseInt(fecha3.substr(3,2));
          var year3 = parseInt(fecha3.substr(6,4));
        
        
            if(dia3 >=1 && dia3<=9){

                 dia3 = ("0" + parseInt(fecha3.substr(0,2)));
            }else{
                 dia3 = parseInt(fecha3.substr(0,2));
            }

            if(mes3 >=1 && mes3<=9){
                 mes3 = ("0" + parseInt(fecha3.substr(3,2)));
            }else{
                 mes3 = parseInt(fecha3.substr(3,2));
            }
            
          
          
            if(fecha3 == ""){

              fecha_t3 = "";

            }else{

              var fecha_t3 = year3 + '-' + dia3 + '-' + mes3; 

            }
          
          
          
                 
          
          
          ////////////////////////////////////////////////////////////////////
          var fecha4 = document.getElementById('fecha_finale2').value;
          
          var dia4 = parseInt(fecha4.substr(0,2));
          var mes4 = parseInt(fecha4.substr(3,2));
          var year4 = parseInt(fecha4.substr(6,4));
          
        
            if(dia4 >=1 && dia4<=9){

                 dia4 = ("0" + parseInt(fecha4.substr(0,2)));
            }else{
                 dia4 = parseInt(fecha4.substr(0,2));
            }

            if(mes4 >=1 && mes4<=9){
                 mes4 = ("0" + parseInt(fecha4.substr(3,2)));
            }else{
                 mes4 = parseInt(fecha4.substr(3,2));
            }
            
              if(fecha4 == ""){

                  fecha_t4 = "";

              }else{

                  var fecha_t4 = year4 + '-' + dia4 + '-' + mes4;               

              }
            
           
          /////////////////////////////////////////////////////////////////////
          
          
          /////////////////////////////////////////////////////////////////
          var fecha5 =  document.getElementById('fecha_iniciale3').value;   
          
          var dia5 = parseInt(fecha5.substr(0,2));
          var mes5 = parseInt(fecha5.substr(3,2));
          var year5 = parseInt(fecha5.substr(6,4));
          
                  
        
            if(dia5 >=1 && dia5<=9){

                 dia5 = ("0" + parseInt(fecha5.substr(0,2)));
            }else{
                 dia5 = parseInt(fecha5.substr(0,2));
            }

            if(mes5 >=1 && mes5<=9){
                 mes5 = ("0" + parseInt(fecha5.substr(3,2)));
            }else{
                 mes5 = parseInt(fecha5.substr(3,2));
            }
            
            if(fecha5 == ""){

              fecha_t5 = "";

            }else{

              var fecha_t5 = year5 + '-' + dia5 + '-' + mes5; 

            }
          
            
         
          ////////////////////////////////////////////////////////////////
          
          ////////////////////////////////////////////////////////////////
          
          var fecha6 = document.getElementById('fecha_finale3').value;
          
          var dia6 = parseInt(fecha6.substr(0,2));
          var mes6 = parseInt(fecha6.substr(3,2));
          var year6 = parseInt(fecha6.substr(6,4));
        
        
            if(dia6 >=1 && dia6<=9){

                 dia6 = ("0" + parseInt(fecha6.substr(0,2)));
            }else{
                 dia6 = parseInt(fecha6.substr(0,2));
            }

            if(mes6 >=1 && mes6<=9){
                 mes6 = ("0" + parseInt(fecha6.substr(3,2)));
            }else{
                 mes6 = parseInt(fecha6.substr(3,2));
            }
            
            if(fecha6 == ""){

              fecha_t6 = "";

            }else{

              var fecha_t6 = year6 + '-' + dia6 + '-' + mes6; 

            }
          
           
          
          ///////////////////////////////////////////////////////////////////
          
              
          ///////////////////////////////////////////////////////////////////
          
          var fecha7 =  document.getElementById('fecha_iniciale4').value;           
          var dia7 = parseInt(fecha7.substr(0,2));
          var mes7 = parseInt(fecha7.substr(3,2));
          var year7 = parseInt(fecha7.substr(6,4));
        
        
            if(dia7 >=1 && dia7<=9){

                 dia7 = ("0" + parseInt(fecha7.substr(0,2)));
            }else{
                 dia7 = parseInt(fecha7.substr(0,2));
            }

            if(mes7 >=1 && mes7<=9){
                 mes7 = ("0" + parseInt(fecha7.substr(3,2)));
            }else{
                 mes7 = parseInt(fecha7.substr(3,2));
            }
            
            if(fecha7 == ""){

              fecha_t7 = "";

            }else{

              var fecha_t7 = year7 + '-' + dia7 + '-' + mes7; 

            }
          
            
                    
          //////////////////////////////////////////////////////////////////
      
          
          ///////////////////////////////////////////////////////////////////
          
          var fecha8 = document.getElementById('fecha_finale4').value;
          
          var dia8 = parseInt(fecha8.substr(0,2));
          var mes8 = parseInt(fecha8.substr(3,2));
          var year8 = parseInt(fecha8.substr(6,4));
        
        
            if(dia8 >=1 && dia8<=9){

                 dia8 = ("0" + parseInt(fecha8.substr(0,2)));
            }else{
                 dia8 = parseInt(fecha8.substr(0,2));
            }

            if(mes8 >=1 && mes8<=9){
                 mes8 = ("0" + parseInt(fecha8.substr(3,2)));
            }else{
                 mes8 = parseInt(fecha8.substr(3,2));
            }
            
            if(fecha8 == ""){

              fecha_t8 = "";

            }else{

              var fecha_t8 = year8 + '-' + dia8 + '-' + mes8; 

            }
          
            
                
          
          
          ///////////////////////////////////////////////////////////////////
                            
          document.getElementById('fecha_schv').value = fecha_t;
          document.getElementById('fecha_schm').value = fecha_t2;
          
          document.getElementById('fecha_schv2').value = fecha_t3;
          document.getElementById('fecha_schm2').value = fecha_t4;
          
          document.getElementById('fecha_schv3').value = fecha_t5;
          document.getElementById('fecha_schm3').value = fecha_t6;
          
          document.getElementById('fecha_schv4').value = fecha_t7;
          document.getElementById('fecha_schm4').value = fecha_t8;
          
 
    });

</script>

<script type="text/javascript">

    function comprobarScreen()
    {
        if (window.screen.availWidth <= 640) {
            window.parent.document.body.style.zoom = "62%";
        }

        if (window.screen.availWidth == 800) {
            window.parent.document.body.style.zoom = "78%";
        }
        if (window.screen.availWidth == 1024) {
            window.parent.document.body.style.zoom = "100%";

        }
        if (window.screen.availWidth == 1280) {
            window.parent.document.body.style.zoom = "100%";

        }
        if (window.screen.availWidth == 1366) {
            window.parent.document.body.style.zoom = "100%";

        }

        if (window.screen.availWidth > 1366) {
            window.parent.document.body.style.zoom = "125%";

        }
    }

</script>




<script type="text/javascript">

    function fechale1()
    {
        var fechaz = document.getElementById('fecha_iniciale').value;     
        var dia = parseInt(fechaz.substr(0,2));
        var mes = parseInt(fechaz.substr(3,2));
        var year = parseInt(fechaz.substr(6,4));
        
        
        if(dia >=1 && dia<=9){
            
             dia = ("0" + parseInt(fechaz.substr(0,2)));
        }else{
             dia = parseInt(fechaz.substr(0,2));
        }
        
        if(mes >=1 && mes<=9){
             mes = ("0" + parseInt(fechaz.substr(3,2)));
        }else{
             mes = parseInt(fechaz.substr(3,2));
        }
        
        var year = parseInt(fechaz.substr(6,4));        
        var fecha_t = year + '-' + dia + '-' + mes;
        
        document.getElementById('fecha_schv').value = fecha_t;     
         
        comprobarFecha();
        

      }
</script>

<!--<script type="text/javascript">

    function fechale1()
    {
        var fecha1 = document.getElementById('fecha_iniciale').value;
        document.getElementById('fecha_schv').value = fecha1;
        
      }
</script>-->

<script type="text/javascript">

    function fechale2()
    {
//        var fecha2 = document.getElementById('fecha_finale').value;
//        document.getElementById('fecha_schm').value = fecha2;
       var fechaz = document.getElementById('fecha_finale').value;      
       var dia = parseInt(fechaz.substr(0,2));
       var mes = parseInt(fechaz.substr(3,2));
       var year = parseInt(fechaz.substr(6,4));
        
        
        if(dia >=1 && dia<=9){
            
             dia = ("0" + parseInt(fechaz.substr(0,2)));
        }else{
             dia = parseInt(fechaz.substr(0,2));
        }
        
        if(mes >=1 && mes<=9){
             mes = ("0" + parseInt(fechaz.substr(3,2)));
        }else{
             mes = parseInt(fechaz.substr(3,2));
        }
        
        var year = parseInt(fechaz.substr(6,4));        
        var fecha_t = year + '-' + dia + '-' + mes;
        
        document.getElementById('fecha_schm').value = fecha_t;     
         
        comprobarFecha();
        
        
      }
</script>

<script type="text/javascript">

    function fechale3()
    {
        
        var fechaz = document.getElementById('fecha_iniciale2').value;      
        var dia = parseInt(fechaz.substr(0,2));
        var mes = parseInt(fechaz.substr(3,2));
        var year = parseInt(fechaz.substr(6,4));
        
        
        if(dia >=1 && dia<=9){
            
             dia = ("0" + parseInt(fechaz.substr(0,2)));
        }else{
             dia = parseInt(fechaz.substr(0,2));
        }
        
        if(mes >=1 && mes<=9){
             mes = ("0" + parseInt(fechaz.substr(3,2)));
        }else{
             mes = parseInt(fechaz.substr(3,2));
        }
        
        var year = parseInt(fechaz.substr(6,4));        
        var fecha_t = year + '-' + dia + '-' + mes;
        
        document.getElementById('fecha_schv2').value = fecha_t;     
         
        comprobarFecha();
        
//        var fecha3 = document.getElementById('fecha_iniciale2').value;
//        document.getElementById('fecha_schv2').value = fecha3;
        
      }
</script>

<script type="text/javascript">

    function fechale4()
    {
//        var fecha4 = document.getElementById('fecha_finale2').value;
//        document.getElementById('fecha_schm2').value = fecha4;        
        
        var fechaz = document.getElementById('fecha_finale2').value;      
        var dia = parseInt(fechaz.substr(0,2));
        var mes = parseInt(fechaz.substr(3,2));
        var year = parseInt(fechaz.substr(6,4));
        
        
        if(dia >=1 && dia<=9){
            
             dia = ("0" + parseInt(fechaz.substr(0,2)));
        }else{
             dia = parseInt(fechaz.substr(0,2));
        }
        
        if(mes >=1 && mes<=9){
             mes = ("0" + parseInt(fechaz.substr(3,2)));
        }else{
             mes = parseInt(fechaz.substr(3,2));
        }
        
        var year = parseInt(fechaz.substr(6,4));        
        var fecha_t = year + '-' + dia + '-' + mes;
        
        document.getElementById('fecha_schm2').value = fecha_t;     
         
        comprobarFecha();
        
      }
</script>


<script type="text/javascript">

    function fechale5()
    {
//        var fecha5 = document.getElementById('fecha_iniciale3').value;
//        document.getElementById('fecha_schv3').value = fecha5;
        var fechaz = document.getElementById('fecha_iniciale3').value;      
        var dia = parseInt(fechaz.substr(0,2));
        var mes = parseInt(fechaz.substr(3,2));
        var year = parseInt(fechaz.substr(6,4));
        
        
        if(dia >=1 && dia<=9){
            
             dia = ("0" + parseInt(fechaz.substr(0,2)));
        }else{
             dia = parseInt(fechaz.substr(0,2));
        }
        
        if(mes >=1 && mes<=9){
             mes = ("0" + parseInt(fechaz.substr(3,2)));
        }else{
             mes = parseInt(fechaz.substr(3,2));
        }
        
        var year = parseInt(fechaz.substr(6,4));        
        var fecha_t = year + '-' + dia + '-' + mes;
        
        document.getElementById('fecha_schv3').value = fecha_t;     
         
        comprobarFecha();
        
        
        
      }
</script>

<script type="text/javascript">

    function fechale6()
    {
//        var fecha6 = document.getElementById('fecha_finale3').value;
//        document.getElementById('fecha_schm3').value = fecha6;

        var fechaz = document.getElementById('fecha_finale3').value;      
        var dia = parseInt(fechaz.substr(0,2));
        var mes = parseInt(fechaz.substr(3,2));
        var year = parseInt(fechaz.substr(6,4));
        
        
        if(dia >=1 && dia<=9){
            
             dia = ("0" + parseInt(fechaz.substr(0,2)));
        }else{
             dia = parseInt(fechaz.substr(0,2));
        }
        
        if(mes >=1 && mes<=9){
             mes = ("0" + parseInt(fechaz.substr(3,2)));
        }else{
             mes = parseInt(fechaz.substr(3,2));
        }
        
        var year = parseInt(fechaz.substr(6,4));        
        var fecha_t = year + '-' + dia + '-' + mes;
        
        document.getElementById('fecha_schm3').value = fecha_t;     
         
        comprobarFecha();
        
        
      }
</script>


<script type="text/javascript">

    function fechale7()
    {
//        var fecha7 = document.getElementById('fecha_iniciale4').value;
//        document.getElementById('fecha_schv4').value = fecha7;
        var fechaz = document.getElementById('fecha_iniciale4').value;      
        var dia = parseInt(fechaz.substr(0,2));
        var mes = parseInt(fechaz.substr(3,2));
        var year = parseInt(fechaz.substr(6,4));
        
        
        if(dia >=1 && dia<=9){
            
             dia = ("0" + parseInt(fechaz.substr(0,2)));
        }else{
             dia = parseInt(fechaz.substr(0,2));
        }
        
        if(mes >=1 && mes<=9){
             mes = ("0" + parseInt(fechaz.substr(3,2)));
        }else{
             mes = parseInt(fechaz.substr(3,2));
        }
        
        var year = parseInt(fechaz.substr(6,4));        
        var fecha_t = year + '-' + dia + '-' + mes;
        
        document.getElementById('fecha_schv4').value = fecha_t;     
         
        comprobarFecha();
        
        
        
      }
</script>

<script type="text/javascript">

    function fechale8()
    {
//        var fecha8 = document.getElementById('fecha_finale4').value;
//        document.getElementById('fecha_schm4').value = fecha8;

        var fechaz = document.getElementById('fecha_finale4').value;      
        var dia = parseInt(fechaz.substr(0,2));
        var mes = parseInt(fechaz.substr(3,2));
        var year = parseInt(fechaz.substr(6,4));
        
        
        if(dia >=1 && dia<=9){
            
             dia = ("0" + parseInt(fechaz.substr(0,2)));
        }else{
             dia = parseInt(fechaz.substr(0,2));
        }
        
        if(mes >=1 && mes<=9){
             mes = ("0" + parseInt(fechaz.substr(3,2)));
        }else{
             mes = parseInt(fechaz.substr(3,2));
        }
        
        var year = parseInt(fechaz.substr(6,4));        
        var fecha_t = year + '-' + dia + '-' + mes;
        
        document.getElementById('fecha_schm4').value = fecha_t;     
         
        comprobarFecha();
        
      }
</script>

<script type="text/javascript">
function comprobarFecha(fechaAnterior,fechaPosterior,fechaActual)
{

          
     var fechaini = document.getElementById('fecha_ini').value;
     var fechafin =  document.getElementById('fecha_fin').value;
     
     var fechainiciale = document.getElementById('fecha_iniciale').value;
     var fechafinale = document.getElementById('fecha_finale').value;
     
     var fechainiciale2 = document.getElementById('fecha_iniciale2').value;
     var fechafinale2 = document.getElementById('fecha_finale2').value;
     
     var fechainiciale3 = document.getElementById('fecha_iniciale3').value;
     var fechafinale3 = document.getElementById('fecha_finale3').value;
     
     var fechainiciale4 = document.getElementById('fecha_iniciale4').value;
     var fechafinale4 = document.getElementById('fecha_finale4').value;
     
     

     var fecha_ini = new Date(fechaini);
     var fecha_fin = new Date(fechafin);
     
     var fecha_iniciale = new Date(fechainiciale);
     var fecha_finale = new Date(fechafinale);
     
     var fecha_iniciale2 = new Date(fechainiciale2);
     var fecha_finale2 = new Date(fechafinale2);
     
     var fecha_iniciale3 = new Date(fechainiciale3);
     var fecha_finale3 = new Date(fechafinale3);
     
     var fecha_iniciale4 = new Date(fechainiciale4);
     var fecha_finale4 = new Date(fechafinale4);
    
     //alert(fecha_ini);
    
     if(fechainiciale == ""){
         
        setTimeout(function () {
         //document.getElementById('schv').placeholder = "0.00"
         document.getElementById('schv').value = "0.00"
         document.getElementById('fecha_schv').value = "";
         }, 0.01);
         
     }
     
     if(fechafinale == ""){
         
        setTimeout(function () {
         //document.getElementById('schm').placeholder = "0.00"
         document.getElementById('schm').value = "0.00"
         document.getElementById('fecha_schm').value = "";
         }, 0.01);
     }
     
     
     if(fechainiciale2 == ""){
         
         setTimeout(function () {
         //document.getElementById('schv2').placeholder = "0.00"
         document.getElementById('schv2').value = "0.00"
         document.getElementById('fecha_schv2').value = "";
         }, 0.01);
         
     }
     
     if(fechafinale2 == ""){
         
         setTimeout(function () {
         //document.getElementById('schm2').placeholder = "0.00"
         document.getElementById('schm2').value = "0.00"
         document.getElementById('fecha_schm2').value = "";
         }, 0.01);
         
         
     }
     
     
     if(fechainiciale3 == ""){
         
         setTimeout(function () {
         //document.getElementById('schv3').placeholder = "0.00"
         document.getElementById('schv3').value = "0.00"
         document.getElementById('fecha_schv3').value = "";
        }, 0.01);
         
     }
     
     if(fechafinale3 == ""){
         
         setTimeout(function () {
         //document.getElementById('schm3').placeholder = "0.00"
         document.getElementById('schm3').value = "0.00"
         document.getElementById('fecha_schm3').value = "";
         }, 0.01);
     }
     
     
     if(fechainiciale4 == ""){
         
         setTimeout(function () {
         //document.getElementById('schv4').placeholder = "0.00"
         document.getElementById('schv4').value = "0.00"
         document.getElementById('fecha_schv4').value = "";
         }, 0.01);
         
     }
     
     if(fechafinale4 == ""){
         
         setTimeout(function () {
         //document.getElementById('schm4').placeholder = "0.00"
         document.getElementById('schm4').value = "0.00"         
         document.getElementById('fecha_schm4').value = "";
         }, 0.01);
     }
      
    //Validar RANGOS  No 1, No 2, No 3, No 4 dentro del rango principal   
    
    ///////////////////////////////////////////////////////////////////////    

    if(fechainiciale != ""){
        if(fecha_iniciale >= fecha_ini  && fecha_iniciale <= fecha_fin){

             //alert("Fecha Aceptada");

        }else{
              
              
              alert("Fecha fuera de Rango");

              
              document.getElementById('fecha_iniciale').value = "<?php echo $fecha_schv; ?>";
              document.getElementById('schv').value ="<?php echo $ratesroom->schv; ?>";
             
              fechale1();             
              exit;

        }
    }
    
    if(fechafinale != ""){
    
        if(fecha_finale >= fecha_ini  && fecha_finale <= fecha_fin){

             //alert("Fecha Aceptada");

        }else{

              
              alert("Fecha fuera de Rango");

              
              document.getElementById('fecha_finale').value = "<?php echo $fecha_schm; ?>";
              document.getElementById('schm').value ="<?php echo $ratesroom->schm; ?>";
             
              fechale2();
              exit;

        }
    }
    
    if(fechainiciale2 != ""){
        if(fecha_iniciale2 >= fecha_ini  && fecha_iniciale2 <= fecha_fin){

             //alert("Fecha Aceptada");

        }else{

              alert("Fecha fuera de Rango");

              
              document.getElementById('fecha_iniciale2').value = "<?php echo $fecha_schv2; ?>";
              document.getElementById('schv2').value ="<?php echo $ratesroom->schv2; ?>";
             
              fechale3();
              
              exit;

        }
    }
    
    if(fechafinale2 != ""){
    
        if(fecha_finale2 >= fecha_ini  && fecha_finale2 <= fecha_fin){

             //alert("Fecha Aceptada");

        }else{

              alert("Fecha fuera de Rango");

              
              document.getElementById('fecha_finale2').value = "<?php echo $fecha_schm2; ?>";
              document.getElementById('schm2').value ="<?php echo $ratesroom->schm2; ?>";
             
              fechale4();
              exit;

        }
    }
    
    if(fechainiciale3 != ""){
        if(fecha_iniciale3 >= fecha_ini  && fecha_iniciale3 <= fecha_fin){

             //alert("Fecha Aceptada");

        }else{

              alert("Fecha fuera de Rango");

              
              document.getElementById('fecha_iniciale3').value = "<?php echo $fecha_schv3; ?>";
              document.getElementById('schv3').value ="<?php echo $ratesroom->schv3; ?>";
             
              fechale5();
              
              exit;

        }
    }
    
     if(fechafinale3 != ""){
    
        if(fecha_finale3 >= fecha_ini  && fecha_finale3 <= fecha_fin){

             //alert("Fecha Aceptada");

        }else{

              alert("Fecha fuera de Rango");

              
              document.getElementById('fecha_finale3').value = "<?php echo $fecha_schm3; ?>";
              document.getElementById('schm3').value ="<?php echo $ratesroom->schm3; ?>";
             
              fechale6();
              exit;

        }
    }
    
    if(fechainiciale4 != ""){
    
        if(fecha_iniciale4 >= fecha_ini  && fecha_iniciale4 <= fecha_fin){

             //alert("Fecha Aceptada");

        }else{

              alert("Fecha fuera de Rango");
              
              document.getElementById('fecha_iniciale4').value = "<?php echo $fecha_schv4; ?>";
              document.getElementById('schv4').value ="<?php echo $ratesroom->schv4; ?>";
             
              fechale7();
              exit;

        }
    }
    
    
    if(fechafinale4 != ""){
    
        if(fecha_finale4 >= fecha_ini  && fecha_finale4 <= fecha_fin){

             //alert("Fecha Aceptada");

        }else{

              alert("Fecha fuera de Rango");

              
              document.getElementById('fecha_finale4').value = "<?php echo $fecha_schm4; ?>";
              document.getElementById('schm4').value ="<?php echo $ratesroom->schm4; ?>";
             
              fechale8();
              exit;

        }
    }
    
    //VALIDACION DE FECHAS INICIALES IGUALES Y FECHAS FINALES IGUALES
    
//    if(fechainiciale !=""){
//        
//        if((fechainiciale == fechainiciale2) || (fechainiciale == fechainiciale3) || (fechainiciale == fechainiciale4) || (fechainiciale == fechafinale2) || (fechainiciale == fechafinale3) || (fechainiciale == fechafinale4)){
//
//             alert("Fecha no Aceptada");
//
//             document.getElementById('fecha_iniciale').value = "<?php echo $fecha_schv; ?>";
//             document.getElementById('schv').value ="<?php echo $ratesroom->schv; ?>";
//             
//             fechale1();
//             
//             exit;
//
//        }
//        
//        
//    }
//    
//    if(fechainiciale2 !=""){
//        
//        if((fechainiciale2 == fechainiciale) || (fechainiciale2 == fechainiciale3) || (fechainiciale2 == fechainiciale4) || (fechainiciale2 == fechafinale) || (fechainiciale2 == fechafinale3) || (fechainiciale2 == fechafinale4)){
//
//             alert("Fecha no Aceptada");
//
//             document.getElementById('fecha_iniciale2').value = "<?php echo $fecha_schv2; ?>";
//             document.getElementById('schv2').value ="<?php echo $ratesroom->schv2; ?>";
//             
//             fechale3();
//             exit;
//
//        }
//        
//        
//    }
//   
//    if(fechainiciale3 !=""){
//        
//        if((fechainiciale3 == fechainiciale) || (fechainiciale3 == fechainiciale2) || (fechainiciale3 == fechainiciale4) || (fechainiciale3 == fechafinale) || (fechainiciale3 == fechafinale2) || (fechainiciale3 == fechafinale4)){
//
//             alert("Fecha no Aceptada");
//
//             document.getElementById('fecha_iniciale3').value = "<?php echo $fecha_schv3; ?>";
//             document.getElementById('schv3').value ="<?php echo $ratesroom->schv3; ?>";
//             
//             fechale5();
//             
//             exit;
//
//        }
//        
//        
//    }
//  
//    if(fechainiciale4 !=""){
//        
//        if((fechainiciale4 == fechainiciale) || (fechainiciale4 == fechainiciale2) || (fechainiciale4 == fechainiciale3) || (fechainiciale4 == fechafinale) || (fechainiciale4 == fechafinale2) || (fechainiciale4 == fechafinale3)){
//
//             alert("Fecha no Aceptada");
//
//             document.getElementById('fecha_iniciale4').value = "<?php echo $fecha_schv4; ?>";
//             document.getElementById('schv4').value ="<?php echo $ratesroom->schv4; ?>";
//             
//             fechale7();
//             
//             exit;
//
//        }
//        
//        
//    }
   
//    if(fechafinale !=""){
//        
//        if((fechafinale == fechainiciale2) || (fechafinale == fechainiciale3) || (fechafinale == fechainiciale4) || (fechafinale == fechafinale2) || (fechafinale == fechafinale3) || (fechafinale == fechafinale4)){
//
//             alert("Fecha no Aceptada");
//
//             document.getElementById('fecha_finale').value = "<?php echo $fecha_schm; ?>";
//             document.getElementById('schm').value ="<?php echo $ratesroom->schm; ?>";
//             
//             fechale2();
//             
//             exit;
//
//        }
//        
//        
//    }
//    
//    if(fechafinale2 !=""){
//        
//        if((fechafinale2 == fechainiciale) || (fechafinale2 == fechainiciale3) || (fechafinale2 == fechainiciale4) || (fechafinale2 == fechafinale) || (fechafinale2 == fechafinale3) || (fechafinale2 == fechafinale4)){
//
//             alert("Fecha no Aceptada");
//
//
//             document.getElementById('fecha_finale2').value = "<?php echo $fecha_schm2; ?>";
//             document.getElementById('schm2').value ="<?php echo $ratesroom->schm2; ?>";
//             
//             fechale4();
//             
//             exit;
//
//        }
//        
//        
//    }
//    
//    if(fechafinale3 !=""){
//        
//        if((fechafinale3 == fechainiciale) || (fechafinale3 == fechainiciale2) || (fechafinale3 == fechainiciale4) || (fechafinale3 == fechafinale) || (fechafinale3 == fechafinale2) || (fechafinale3 == fechafinale4)){
//
//             alert("Fecha no Aceptada");
//
//             document.getElementById('fecha_finale3').value = "<?php echo $fecha_schm3; ?>";
//             document.getElementById('schm3').value ="<?php echo $ratesroom->schm3; ?>";
//             
//             fechale6();
//             
//             exit;
//
//        }
//        
//        
//    }
//    
//    if(fechafinale4 !=""){
//        
//        if((fechafinale4 == fechainiciale) || (fechafinale4 == fechainiciale2) || (fechafinale4 == fechainiciale3) || (fechafinale4 == fechafinale) || (fechafinale4 == fechafinale2) || (fechafinale4 == fechafinale3)){
//
//             alert("Fecha no Aceptada");
//
//             document.getElementById('fecha_finale4').value = "<?php echo $fecha_schm4; ?>";
//             document.getElementById('schm4').value ="<?php echo $ratesroom->schm4; ?>";
//             
//             fechale8();
//             
//             
//             exit;
//
//        }
//        
//        
//    }
    
    //VALIDACION DE RANGOS DENTRO DE RANGOS.
    
    //RANGO 1 DENTRO DE LOS DEMAS RANGOS
    
    if(fechainiciale != ""){
        
        if(fecha_iniciale >= fecha_iniciale2  && fecha_iniciale <= fecha_finale2){

             alert("Fecha no Aceptada");
             
             document.getElementById('fecha_iniciale').value = "<?php echo $fecha_schv; ?>";
             document.getElementById('schv').value ="<?php echo $ratesroom->schv; ?>";
             
             fechale1();

             exit;

        }else{
              

        }
        
    }
    
    if(fechainiciale != ""){
        
        if(fecha_iniciale >= fecha_iniciale3  && fecha_iniciale <= fecha_finale3){

             alert("Fecha no Aceptada");

             document.getElementById('fecha_iniciale').value = "<?php echo $fecha_schv; ?>";
             document.getElementById('schv').value ="<?php echo $ratesroom->schv; ?>";
             
             fechale1();
             
             exit;

        }else{
              

        }
        
    }
    
    if(fechainiciale != ""){
        
        if(fecha_iniciale >= fecha_iniciale4  && fecha_iniciale <= fecha_finale4){

             alert("Fecha no Aceptada");

             document.getElementById('fecha_iniciale').value = "<?php echo $fecha_schv; ?>";
             document.getElementById('schv').value ="<?php echo $ratesroom->schv; ?>";
             
             fechale1();
             
             exit;

        }else{
              

        }
        
    }
    
    if(fechafinale != ""){
        
        if(fecha_finale >= fecha_iniciale2  && fecha_finale <= fecha_finale2){

             alert("Fecha no Aceptada");
             
             document.getElementById('fecha_finale').value = "<?php echo $fecha_schm; ?>";
             document.getElementById('schm').value ="<?php echo $ratesroom->schm; ?>";
             
             fechale2();
             
             exit;

        }else{
              

        }
        
    }
    
    if(fechafinale != ""){
        
        if(fecha_finale >= fecha_iniciale3  && fecha_finale <= fecha_finale3){

             alert("Fecha no Aceptada");
             
             document.getElementById('fecha_finale').value = "<?php echo $fecha_schm; ?>";
             document.getElementById('schm').value ="<?php echo $ratesroom->schm; ?>";
             
             fechale2();
             
             exit;

        }else{
              

        }
        
    }
    
    if(fechafinale != ""){
        
        if(fecha_finale >= fecha_iniciale4  && fecha_finale <= fecha_finale4){

             alert("Fecha no Aceptada");
             
             document.getElementById('fecha_finale').value = "<?php echo $fecha_schm; ?>";
             document.getElementById('schm').value ="<?php echo $ratesroom->schm; ?>";
             
             fechale2();
             
             exit;

        }else{
              

        }
        
    }
    
    
    /////////////////////////////////////////////////////////////////////////////////////////////
    
    //RANGO 2 DENTRO DE LOS DEMAS RANGOS
    
    if(fechainiciale2 != ""){
        
        
        
        if(fecha_iniciale2 >= fecha_iniciale  && fecha_iniciale2 <= fecha_finale){

             alert("Fecha no Aceptada");
             
             document.getElementById('fecha_iniciale2').value = "<?php echo $fecha_schv2; ?>";
             document.getElementById('schv2').value ="<?php echo $ratesroom->schv2; ?>";
             
             fechale3();

             exit;

        }else{
              

        }
        
    }
    
    if(fechainiciale2 != ""){
        
        if(fecha_iniciale2 >= fecha_iniciale3  && fecha_iniciale2 <= fecha_finale3){

             alert("Fecha no Aceptada");
             
             document.getElementById('fecha_iniciale2').value = "<?php echo $fecha_schv2; ?>";
             document.getElementById('schv2').value ="<?php echo $ratesroom->schv2; ?>";
             
             fechale3();

             exit;

        }else{
              

        }
        
    }
    
    if(fechainiciale2 != ""){
        
        if(fecha_iniciale2 >= fecha_iniciale4  && fecha_iniciale2 <= fecha_finale4){

             alert("Fecha no Aceptada");
             
             document.getElementById('fecha_iniciale2').value = "<?php echo $fecha_schv2; ?>";
             document.getElementById('schv2').value ="<?php echo $ratesroom->schv2; ?>";
             
             fechale3();

             exit;

        }else{
              

        }
        
    }
    
    if(fechafinale2 != ""){
        
        if(fecha_finale2 >= fecha_iniciale  && fecha_finale2 <= fecha_finale){

             alert("Fecha no Aceptada");
             
             document.getElementById('fecha_finale2').value = "<?php echo $fecha_schm2; ?>";
             document.getElementById('schm2').value ="<?php echo $ratesroom->schm2; ?>";
             
             fechale4();
             
             exit;

        }else{
              

        }
        
    }
    
    if(fechafinale2 != ""){
        
        if(fecha_finale2 >= fecha_iniciale3  && fecha_finale2 <= fecha_finale3){

             alert("Fecha no Aceptada");
             
             document.getElementById('fecha_finale2').value = "<?php echo $fecha_schm2; ?>";
             document.getElementById('schm2').value ="<?php echo $ratesroom->schm2; ?>";
             
             fechale4();
             
             exit;

        }else{
              

        }
        
    }
    
    if(fechafinale2 != ""){
        
        if(fecha_finale2 >= fecha_iniciale4  && fecha_finale2 <= fecha_finale4){

             alert("Fecha no Aceptada");
             
             document.getElementById('fecha_finale2').value = "<?php echo $fecha_schm2; ?>";
             document.getElementById('schm2').value ="<?php echo $ratesroom->schm2; ?>";
             
             fechale4();
             
             exit;

        }else{
              

        }
        
    }
    
    /////////////////////////////////////////////////////////////////////////////////////////////////
    
    //RANGO 3 DENTRO DE LOS DEMAS RANGOS
    
    if(fechainiciale3 != ""){
        
        if(fecha_iniciale3 >= fecha_iniciale  && fecha_iniciale3 <= fecha_finale){

             alert("Fecha no Aceptada");
             
             document.getElementById('fecha_iniciale3').value = "<?php echo $fecha_schv3; ?>";
             document.getElementById('schv3').value ="<?php echo $ratesroom->schv3; ?>";
             
             fechale5();

             exit;

        }else{
              

        }
        
    }
    
    if(fechainiciale3 != ""){
        
        if(fecha_iniciale3 >= fecha_iniciale2  && fecha_iniciale3 <= fecha_finale2){

             alert("Fecha no Aceptada");
             
             document.getElementById('fecha_iniciale3').value = "<?php echo $fecha_schv3; ?>";
             document.getElementById('schv3').value ="<?php echo $ratesroom->schv3; ?>";
             
             fechale5();

             exit;

        }else{
              

        }
        
    }
    
    if(fechainiciale3 != ""){
        
        if(fecha_iniciale3 >= fecha_iniciale4  && fecha_iniciale3 <= fecha_finale4){

             alert("Fecha no Aceptada");
             
             document.getElementById('fecha_iniciale3').value = "<?php echo $fecha_schv3; ?>";
             document.getElementById('schv3').value ="<?php echo $ratesroom->schv3; ?>";
             
             fechale5();

             exit;

        }else{
              

        }
        
    }
    
    if(fechafinale3 != ""){
        
        if(fecha_finale3 >= fecha_iniciale  && fecha_finale3 <= fecha_finale){

             alert("Fecha no Aceptada");
             
             document.getElementById('fecha_finale3').value = "<?php echo $fecha_schm3; ?>";
             document.getElementById('schm3').value ="<?php echo $ratesroom->schm3; ?>";
             
             fechale6();
             
             exit;

        }else{
              

        }
        
    }
    
    if(fechafinale3 != ""){
        
        if(fecha_finale3 >= fecha_iniciale2  && fecha_finale3 <= fecha_finale2){

             alert("Fecha no Aceptada");
             
             document.getElementById('fecha_finale3').value = "<?php echo $fecha_schm3; ?>";
             document.getElementById('schm3').value ="<?php echo $ratesroom->schm3; ?>";
             
             fechale6();
             
             exit;

        }else{
              

        }
        
    }
    
    if(fechafinale3 != ""){
        
        if(fecha_finale3 >= fecha_iniciale4  && fecha_finale3 <= fecha_finale4){

             alert("Fecha no Aceptada");
             
             document.getElementById('fecha_finale3').value = "<?php echo $fecha_schm3; ?>";
             document.getElementById('schm3').value ="<?php echo $ratesroom->schm3; ?>";
             
             fechale6();
             
             exit;

        }else{
              

        }
        
    }
    
    ///////////////////////////////////////////////////////////////////////////////////////////////////
    
     /////////////////////////////////////////////////////////////////////////////////////////////////
    
    //RANGO 4 DENTRO DE LOS DEMAS RANGOS
    
    if(fechainiciale4 != ""){
        
        if(fecha_iniciale4 >= fecha_iniciale  && fecha_iniciale4 <= fecha_finale){

             alert("Fecha no Aceptada");
             
             document.getElementById('fecha_iniciale4').value = "<?php echo $fecha_schv4; ?>";
             document.getElementById('schv4').value ="<?php echo $ratesroom->schv4; ?>";
             
             fechale7();

             exit;

        }else{
              

        }
        
    }
    
    if(fechainiciale4 != ""){
        
        if(fecha_iniciale4 >= fecha_iniciale2  && fecha_iniciale4 <= fecha_finale2){

             alert("Fecha no Aceptada");
             
             document.getElementById('fecha_iniciale4').value = "<?php echo $fecha_schv4; ?>";
             document.getElementById('schv4').value ="<?php echo $ratesroom->schv4; ?>";
             
             fechale7();

             exit;

        }else{
              

        }
        
    }
    
    if(fechainiciale4 != ""){
        
        if(fecha_iniciale4 >= fecha_iniciale3  && fecha_iniciale4 <= fecha_finale3){

             alert("Fecha no Aceptada");

             document.getElementById('fecha_iniciale4').value = "<?php echo $fecha_schv4; ?>";
             document.getElementById('schv4').value ="<?php echo $ratesroom->schv4; ?>";
             
             fechale7();
             
             exit;

        }else{
              

        }
        
    }
    
    if(fechafinale4 != ""){
        
        if(fecha_finale4 >= fecha_iniciale  && fecha_finale4 <= fecha_finale){

             alert("Fecha no Aceptada");
             
             document.getElementById('fecha_finale4').value = "<?php echo $fecha_schm4; ?>";
             document.getElementById('schm4').value ="<?php echo $ratesroom->schm4; ?>";
             
             fechale8();
          
             exit;

        }else{
              

        }
        
    }
    

    
    if(fechafinale4 != ""){
        
        if(fecha_finale4 >= fecha_iniciale2  && fecha_finale4 <= fecha_finale2){

             alert("Fecha no Aceptada");
             
             document.getElementById('fecha_finale4').value = "<?php echo $fecha_schm4; ?>";
             document.getElementById('schm4').value ="<?php echo $ratesroom->schm4; ?>";
             
             fechale8();
          
             exit;

        }else{
              

        }
        
    }
    
    if(fechafinale4 != ""){
        
        if(fecha_finale4 >= fecha_iniciale3  && fecha_finale4 <= fecha_finale3){

             alert("Fecha no Aceptada4");
             
             document.getElementById('fecha_finale4').value = "<?php echo $fecha_schm4; ?>";
             document.getElementById('schm4').value ="<?php echo $ratesroom->schm4; ?>";
             
             fechale8();
          
             exit;

        }else{
              

        }
        
    }


    
    
    

}

</script>


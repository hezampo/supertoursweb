<?php
$comsion_servis = $data['comsion_servis'];
?>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo $data['rootUrl']; ?>global/css/autocompletar/css/style.css" />
<link rel="stylesheet" type="text/css" href="<?php echo $data['rootUrl']; ?>global/css/jquery.notice2.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo $data['rootUrl']; ?>global/css/modal.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo $data['rootUrl']; ?>global/css/blitzer/jquery-ui-1.8.16.custom.css" />
<link rel="stylesheet" href="<?php echo $data['rootUrl']; ?>global/themes/blitzer/jquery-ui-1.9.0.custom.min.css">
<script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/jquery.notice.js"></script>
<script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/jquery.ausu-autosuggest.js"></script>
<script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/Concurrent.Thread.js"></script>

<script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/form.js"></script>
<!--jquery para el calendario-->
<script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/jquery-ui-1.8.18.custom.min.js"></script>
<script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/booking.js"></script>
<script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/jquery.timeentry.js"></script>
<style>
    .fields2 input {
        height: 22px;
        border: #AFAFAF solid thin;
        width: 50px;
        font-family: courier;
        font-size: 22px;
        font-weight: bold;
        text-align: center;
        color: #0033FF;
        padding-top: 3px;
    }
    .fields input {
        height: 22px;
        border: #AFAFAF solid thin;
        width: 50px;
        float: left;
        padding-right: 3px;
        padding-left: 3px;
        text-align: center;
        font-size:12px;
    }
    .field {
        height: 22px;
        font-size: 11px;
        color: #666;
        text-decoration: none;
        border: #AFAFAF solid thin;
        float: left;
    }
    span .field {
        height: 22px;
        font-size: 11px;
        color: #666;
        text-decoration: none;
        border: #AFAFAF solid thin;
        float: left;
        text-align: center;
    }
    .select {
        font-size: 12px;
        color: #666;
        text-decoration: none;
        height: 27px;
        padding: 3px;
        cursor: pointer;
    }
    .select2 {
        font-size: 14px;
        color: #333;
        text-decoration: none;
        height: 27px;
        padding: 3px;
        font-weight:bold;
        cursor: pointer;
    }
    #arrival {
        background-color: #DCE6F2;
        border: #0167CC solid thin;
        width:95%;
        float: left;
        padding: 8px;
        margin-right: 8px;
        margin-left: 7px;
        height: auto;
    }
    #departure {
        background-color: #F3DCDC;
        border: #B83A36 solid thin;
        width: 95%;
        float: left;
        padding: 8px;
        height: auto;
    }
    #type .list {
        float: left;
        padding: 0 2px 0 2px;
        margin: 0;
    }
    #type .label {
        float: left;
        margin-right: 5px;
        margin-top: 4px;
    }
    #type {
        margin: auto auto 8px auto;
        float: left;
        width: 100%;
        clear: both;
    }
    #type .list li {
        font-size: 11px;
        color: #666;
        display: inline;
        text-decoration: none;
        cursor: pointer;
    }
    #total #amount {
        text-align: center;
        vertical-align: middle;
        border: #0368CC solid thin;
        background-color: #DCE6F2;
        color: #0368CC;
        font-size: 26px;
        font-weight: 600;
    }
    #total .label {
        text-align: center;
        font-size: 16px;
    }
    #t-total .price {
        text-align: center;
        vertical-align: middle;
        border: #0368CC solid thin;
        background-color: #DCE6F2;
        color: #0368CC;
        font-size: 26px;
        font-weight: 600;
    }
    #total .label {
        text-align: center;
        font-size: 16px;
    }
    #t-total .price {
        text-align: center;
        vertical-align: middle;
        border: #33449C solid thin;
        background-color: #33449C;
        color: #fff;
        font-size: 26px;
        font-weight: 600;
    }
    #t-total .label {
        text-align: center;
        font-size: 12px;
    }
    #t-total2 .label {
        text-align: center;
        font-size: 16px;
    }
    #t-total2 .price {
        text-align: center;
        vertical-align: middle;
        border: #AC1B29 solid thin;
        background-color: #AC1B29;
        color: #fff;
        font-size: 26px;
        font-weight: 600;
    }
    .t-total3 .label {
        text-align: center;
        font-size: 16px;
    }
    .t-total3 .price {
        text-align: center;
        vertical-align: middle;
        border: #AC1B29 solid thin;
        background-color: #AC1B29;
        color: #fff;
        font-size: 26px;
        width:167px;
        font-weight: 600;
    }
    .t-total4 .label {
        text-align: center;
        font-size: 16px;
    }
    .t-total4 .price {
        text-align: center;
        vertical-align: middle;
        border: #00F solid thin;
        background-color: #DCE6F2;
        color: #00F;
        font-size: 26px;
        font-weight: 600;
    }
    #content_page_tours {
        border: 1px solid #CCC;
        margin-top: 0px;
        margin-right: auto;
        margin-bottom: 20px;
        margin-left: auto;
        padding: 8px;
        width: 98.4%;
        float: left;
        clear: both;
    }
    #selector {
        -moz-box-shadow:inset 0px 1px 0px 0px #ffffff;
        -webkit-box-shadow:inset 0px 1px 0px 0px #ffffff;
        box-shadow:inset 0px 1px 0px 0px #ffffff;
        background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #ededed), color-stop(1, #dfdfdf) );
        background:-moz-linear-gradient( center top, #ededed 5%, #dfdfdf 100% );
        filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#ededed', endColorstr='#dfdfdf');
        background-color:#ededed;
        -moz-border-radius:6px;
        -webkit-border-radius:6px;
        border-radius:6px;
        border:1px solid #dcdcdc;
        display:inline-block;
        color:#777777;
        font-family:arial;
        font-size:11px;
        font-weight:bold;
        padding:6px;
        text-decoration:none;
        text-shadow:1px 1px 0px #ffffff;
    }
    .selector:hover {
        background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #dfdfdf), color-stop(1, #ededed) );
        background:-moz-linear-gradient( center top, #dfdfdf 5%, #ededed 100% );
        filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#dfdfdf', endColorstr='#ededed');
        background-color:#dfdfdf;
        cursor:pointer;
    }
    .selector:active {
        position:relative;
        top:1px;
    }
    #selectos{
        padding:0;
        margin:0;
    }
    input[type="radio"]{
        height: 15px;
        width: 15px;
    }
    
    .background {
       background: rgba(212,228,239,1);
background: -moz-linear-gradient(-45deg, rgba(212,228,239,1) 0%, rgba(134,174,204,1) 100%);
background: -webkit-gradient(left top, right bottom, color-stop(0%, rgba(212,228,239,1)), color-stop(100%, rgba(134,174,204,1)));
background: -webkit-linear-gradient(-45deg, rgba(212,228,239,1) 0%, rgba(134,174,204,1) 100%);
background: -o-linear-gradient(-45deg, rgba(212,228,239,1) 0%, rgba(134,174,204,1) 100%);
background: -ms-linear-gradient(-45deg, rgba(212,228,239,1) 0%, rgba(134,174,204,1) 100%);
background: linear-gradient(135deg, rgba(212,228,239,1) 0%, rgba(134,174,204,1) 100%);
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#d4e4ef', endColorstr='#86aecc', GradientType=1 );

    }
    .rojo{
    /* IE10+ */ 
background-image: -ms-linear-gradient(bottom left, #260505 0%, #AC1B29 75.5%, #FFC7C7 100%);

/* Mozilla Firefox */ 
background-image: -moz-linear-gradient(bottom left, #260505 0%, #AC1B29 75.5%, #FFC7C7 100%);

/* Opera */ 
background-image: -o-linear-gradient(bottom left, #260505 0%, #AC1B29 75.5%, #FFC7C7 100%);

/* Webkit (Safari/Chrome 10) */ 
background-image: -webkit-gradient(linear, left bottom, right top, color-stop(0, #260505), color-stop(75.5, #AC1B29), color-stop(100, #FFC7C7));

/* Webkit (Chrome 11+) */ 
background-image: -webkit-linear-gradient(bottom left, #260505 0%, #AC1B29 75.5%, #FFC7C7 100%);

/* W3C Markup */ 
background-image: linear-gradient(to top right, #260505 0%, #AC1B29 75.5%, #FFC7C7 100%); 
    }
    .cerati{
        /* IE10+ */ 
background-image: -ms-linear-gradient(bottom left, #1E4D82 0%, #33449C 51%, #1B1478 75.5%, #E1E0FF 100%);

/* Mozilla Firefox */ 
background-image: -moz-linear-gradient(bottom left, #1E4D82 0%, #33449C 51%, #1B1478 75.5%, #E1E0FF 100%);

/* Opera */ 
background-image: -o-linear-gradient(bottom left, #1E4D82 0%, #33449C 51%, #1B1478 75.5%, #E1E0FF 100%);

/* Webkit (Safari/Chrome 10) */ 
background-image: -webkit-gradient(linear, left bottom, right top, color-stop(0, #1E4D82), color-stop(51, #33449C), color-stop(75.5, #1B1478), color-stop(100, #E1E0FF));

/* Webkit (Chrome 11+) */ 
background-image: -webkit-linear-gradient(bottom left, #1E4D82 0%, #33449C 51%, #1B1478 75.5%, #E1E0FF 100%);

/* W3C Markup */ 
background-image: linear-gradient(to top right, #1E4D82 0%, #33449C 51%, #1B1478 75.5%, #E1E0FF 100%);
    }
    
</style>

<div id="header_page">
    <div class="header2">Multi - Day  Tours [New]</div>
    
    <div id="toolbar">
        
    <select style="margin-right:6px; margin-top:12px; width:220px; background: #AC1B29;color: #fff;border-color: transparent;" name="fnombre" id="rate" onclick = "capturar();" onchange="obtenerValor(this.value);">
    <option id="" value="0">Select Tour Name</option>
    <?php
        $sql1 = "SELECT id, rate FROM ratesvalid";
        $rs1 = Doo::db()->query($sql1, array(9));
        $rates_valid1 = $rs1->fetchAll();
            foreach ($rates_valid1 as $r) {
                echo '<option value="' . $r['id'] . '" ' . (( 9 == $r['id']) ? 'select' : '' ) . '>' . $r['rate'] . '</option>';
            }
    ?>
</select>                             
<script type="text/javascript">
    var obtenerValor = function (x) {
        document.getElementById('rates').value = x;
        net_rate.value = x;
    };
</script>    
        
        
        
        <div class="toolbar-list">
            <ul>
                <li class="btn-toolbar" id="btn-save">
                    <!--<a class="link-button" id="btn-save"> <span class="icon-32-save" title="Nuevo">&nbsp;</span>Save</a>-->
                    <a class="link-button" id="btn-save"> <i class="fa fa-floppy-o fa-3x" style="margin-left: 4px; color: #AC1B29;"></i><br>Save</a>
                </li>
                <li class="btn-toolbar" id="btn-cancel">
                    <!--<a class="link-button"><span class="icon-back" title="Editar">&nbsp;</span>Back</a>-->
                    <a class="link-button"><i class="fa fa-arrow-left fa-3x" style="color: #33449C;"></i> <br>Back</a>
                </li>
            </ul>
            <div class="clear"></div>
        </div>
        <div class="clear"></div>
    </div>
</div>
<div id="content_page_tours" style="width: 984px;z-index:1;">
    <form id="form1" class="form" action="" method="post" name="form1">
        <div id="info-group" style="width: 900px;">
            <div id="cancelation">
                <div class="ho" style="background: #bb0000;">CANCELATION <span>#</span></div>
                <div id="cancel">00000</div>
            </div>
            <div id="reservation" style="border-color: #fff;width: 300px;">
                <div class="ho" style="color: #bb0000; background: #bb0000;"> <p style="display: none;"> RESERVATION </p>.<span></span></div>
                <div id="reser"> <p ><?php /* echo $_SESSION['codconf']; */ ?></p><input type="hidden" /></div>
            </div>
            <div id="status">
                <div class="ho" style="background: #bb0000;">STATUS</div>
                <div id="stat">CONFIRMED</div>
            </div>
            <div id="status-change">
                <div style="color: #fff;background: #bb0000;padding: 4px;margin-top: 5px;text-align: -webkit-auto;">CHANGE STATUS</div>
                <select id="estado" name="estado" style="margin-left: -7px;">
                    <option></option>
                    <option value="CONFIRMED" selected="">CONFIRMED</option>
                    <option value="QUOTE">QUOTE</option>
                </select>
            </div>
        </div>
        <table><tr><td>
                    <!-- lider pass -->

                    <!-- end lider pass -->
                    <fieldset id="inputype" style="width:85%;border-radius: 10%;" class="background"><legend style="border:1px solid #00C; background:#fff;">INPUT TYPE</legend>
                        <div id="opera" class="input">
                            <table width="100%" >
                                <tr align="left">

                                    <td >
                                        <label style="" id="label">CALL CENTER</label>
                                    </td>
                                    <td >
                                        <input style="margin-left:-4px;" name="nombre" type="text"  id="nombre" value="<?php echo trim($login->nombre . ' (' . $login->usuario . ')'); ?>" readonly="readonly"/>
                                    </td>

                                </tr>
                                
                                <tr><td colspan="2" >
                                        <table width="100%">
                                            <tr>
                                                <td width="10%">
                                                    <label style="margin-top:10px;"><strong>AGENCY</strong></label>
                                                </td>
                                                <td width="40%">
                                                    <div class="ausu-suggest" >
                                                        <input name="agency" style="margin-top:15px; margin-left:4px;" tabindex="1" type="text"  id="agency" size="19" maxlength="30" value=""  autocomplete="off"   />
                                                        <input type="hidden" size="4" value="-1" name="id_agency" id="id_agency" autocomplete="off"  readonly="readonly"/>
                                                        <input type="hidden" size="4" value="0" name="type_rate" id="type_rate" autocomplete="off"  readonly="readonly"/>
                                                        <input type="hidden" size="4" value="0" name="disponible" id="disponible" autocomplete="off"  readonly="readonly"/>
                                                        <input type="hidden" size="4" value="0" name="comision" id="comision" autocomplete="off"  readonly="readonly"/>
                                                        <input type="hidden" size="4" value=0 name="comisionable" id="comisionable" autocomplete="off" readonly="readonly" />
                                                    </div>
                                                </td>
                                                <td width="10%">
                                                    <label style="margin-top:10px; margin-left:4px;"><strong>Employ</strong></label>
                                                </td>
                                                <td width="40%">
                                                    <div class="ausu-suggest" >
                                                        <input style="width:170px; margin-top:15px; margin-left:4px;" name="uagency" tabindex="2" type="text"  id="uagency" autocomplete="off" size="11" maxlength="30" value="" disabled="disabled"  />
                                                        <input type="hidden" size="4" value="-1" name="id_auser" id="id_auser" autocomplete="off" />
                                                    </div>
                                                </td>
                                            </tr>
                                        </table>
                                    </td></tr>

                                <tr><td colspan="2" >&nbsp;</td></tr>
                                <tr><td colspan="2">
                                        <table style="margin-top:-5px;"align="center" cellspacing="10">
                                            <tr valign="top">
                                                <td><label> BY PHONE</label> <input id="byrp" name="byr" type="radio" value="1" checked="checked"/>  </td>
                                                <td><label> BY MAIL</label> <input id="byrm" name="byr" type="radio" value="2" /> </td>
                                                <td><label> WEBSALE </label><input id="byrw" name="byr" type="radio" value="3" />  </td>
                                            </tr>
                                        </table>
                                    </td></tr>
                            </table>
<!--                                    <h3>Tour Name:&nbsp;&nbsp;<select style="margin-left:75px; width:220px;" name="rate" id="rate" onclick = "capturar();" onchange="obtenerValor(this.value);combo();">
                                    <option >Select Tour Name</option>
                                    <?php
                                    $sql = "SELECT id, rate FROM ratesvalid";
                                    $rs = Doo::db() -> query($sql, array(9));
                                    $rates_valid = $rs -> fetchAll();
                                    foreach ($rates_valid as $r) {
                                        echo '<option value="'. $r['id'] .'" '.(( 9 == $r['id'])? 'select': '' ).'>'. $r['rate'] .'</option>';
                                    }
                                    ?>
                        
                                    </select></h3>-->
                            
                             <input type="text" name="rates" id="rates" style="display: none;" value= "<?php echo $agency['tour_name']; ?>" />
                            <script type="text/javascript">
                                    var obtenerValor = function(x){
                                    document.getElementById('rates').value=x;
                                     net_rate.value = x;
                                    };
                            </script>
                            
<!--                            <div id="id_tour" style=""><?php echo $agency['id_tour']; ?></div>-->

                            
<!--                             <input name="tour_name" readonly="true" style="width:220px; color: #0F0CCB; margin-left: -23%; margin-top: 2%;" type="text" id="tour_name" value="<?php echo $agency['tour_name']; ?>"  />-->

                        </div>
                    </fieldset>
                    <!-- end lider pass -->
                </td>
                <td>
                    <!-- agency and cal center -->
                    <fieldset  id="liderpax" style="margin-left:5px; border-radius: 10%; width:90px;" class="background">
                        <legend style="border:1px solid #00C; background:#eee;">LEADER PASS</legend>
                        <table>
                            <tr>
                                <td >
                                    <div id="opera" class="input" style="padding-top:5px;">
                                        <table>
                                            <tr>
                                                <td>
                                                    <label style="margin-left:12px;" id="label" >SEARCH </label>
                                                </td>
                                                <td>
                                                    <div class="ausu-suggest" id="opera">
                                                        <input type="text" style="margin-left:9px; width:350px;" size="65" tabindex="3" value="" name="leader" id="cliente" autocomplete="off" />

                                                        <input type="hidden" size="4" value="" name="id_leader" id="id_leader" autocomplete="off" disabled="disabled"  readonly="readonly"/>
                                                    </div>
                                                </td>
                                                <td>&nbsp;&nbsp;</td>
                                                <td title="">
                                                    <div  class="ausu-suggest" style="margin-top:-5px; margin-left:2px; display:none">		
                                                        <a id="newClient" style="cursor:pointer; visibility:hidden;" ><img src="<?php echo $data['rootUrl']; ?>global/img/new.png" alt=""  align="absmiddle" border="0"  style="padding-bottom:0px;" /></a>
                                                    </div>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div id="opera" class="input" >
                                        <table width="100%">
                                            <tr>
                                                <td width="" align="right">

                                                    <input type="hidden" name="idCliente"   id="idCliente"  value="" />


                                                    <input type="hidden" name="idPagador" id="idPagador" value="0"  />
                                                    <input type="hidden" name="idPagador_aux" id="idPagador_aux" value="0"  />
                                                    <input type="hidden" name="cliente_apto" id="cliente_apto" value="0"  />
                                                    <label style="margin-left:-12px;" id="labeldere12">FIRST NAME</label>		
                                                </td>
                                                <td width="">
                                                    <input name="firstname1" style="margin-left:8px; width:140px;" type="text" tabindex="4"  id="firstname1" size="20" maxlength="20" value="" />
                                                </td>

                                                <td width="" align="right"> 
                                                    <label style="" id="labeldere12" >LAST NAME </label>
                                                </td>
                                                <td width="">  
                                                    <input name="lastname1" style="margin-left:-12px; width:130px;" type="text" tabindex="5" id="lastname1" size="20" maxlength="20" value="" />
                                                </td>
                                            </tr>
                                            <tr>
                                                <td align="right"> 
                                                    <label style="margin-left:-32px;" id="labeldere12">E-MAIL </label>
                                                </td>
                                                <td>
                                                    <input name="email1" style="margin-left:8px; width:140px;" tabindex="7" type="text"  id="email1" size="20" value=""/>
                                                </td>
                                                
                                                <td align="right">
                                                    <label style="" id="labeldere12">PHONE </label>
                                                </td>
                                                <td>
                                                    <input name="phone1" style="margin-left:8px; width:130px;" type="text"  tabindex="6" id="phone1" size="20" maxlength="20" value="" />
                                                    <input  type="hidden" name="type_cliente"  id="type_cliente" value="" />
                                                </td>

                                                
                                            </tr>
                                        </table>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </fieldset>
                    
                    <!-- end agency y cal center -->
                </td></tr></table>
        <!-- date of tours -->
        <fieldset style="margin-top: 5px; border-radius: 10%;margin-top: 2%;">
           
            <div id="date" align="center">
                <table width="90%">
                    <tr valign="top">
                        <td><table>
                                <tr>
                                    <td><label for="type_services_premiun"  style="cursor:pointer" ><strong>Premium Class</strong></label></td>
                                    <td><input type="radio" id="type_services_premiun" name="type_services" value="0"  checked="checked"/> </td>
                                </tr>
                                <tr>
                                    <td><label for="type_services_vip" style="cursor:pointer" ><strong>Platinum VIP</strong></label></td>
                                    <td><input type="radio" id="type_services_vip" name="type_services" value="1" /> </td>
                                </tr>
                            </table>
                        </td>
                        <td>
                            <div id="opera" class="input" >
                                <table >
                                    <tr >
                                        <td>
                                            <label style="width:100px;"  >START DATE </label>
                                        </td>
                                    </tr>
                                    <tr><td>
                                            <a href="" id="dataclick1" ><i class="fa fa-calendar fa-2x"></i></a>
                                            <!--<a href="" id="dataclick1" ><img src="<?php echo $data['rootUrl']; ?>global/images/calendar.png" alt=""  align="absmiddle" width="19" height="20" border="0"  /></a>-->
                                            <input name="fecha_salida" type="text"  id="fecha_salida" size="10" maxlength="15" value="" onchange="fechaRetorno(this.value);" autocomplete="off"  />
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </td>
                        <td>
                            <div id="opera" class="input"> <table><tr><td>

                                            <label style="width:100px;"  >END DATE</label>
                                        </td></tr>
                                    <tr><td>
                                            <!--<a href="" id="dataclick2" ><img src="<?php echo $data['rootUrl']; ?>global/images/calendar.png" alt=""  align="absmiddle" width="19" height="20" border="0"  /></a>-->
                                            <a href="" id="dataclick2">
                                                <i class="fa fa-calendar fa-2x"></i>
                                            </a>
                                            <input name="fecha_retorno" type="text"  id="fecha_retorno" size="10" maxlength="15" value=""   autocomplete="off"   />
                                        </td></tr></table>
                            </div>
                        </td>
                        <td>
                            <div class="fields">
                                <label>ADULT(S)</label><br />
                                <input style="font-size:16px" name="adult" id="adult" type="number" value="1" max="16" min="1" autocomplete="off">
                            </div>
                        </td>
                        
                            
                            <input type="text" name="frates" readonly="readonly" id="rates" hidden="hidden"  value= "<?php echo $agency['tour_name']; ?>" />
                        
                        
                        <td>

                            <div class="fields">
                                <label>CHILD(S)</label><br />
                                <input style="font-size:16px" name="child" id="child" type="number" value="0" max="15" min="0" autocomplete="off">
                            </div>
                        </td>
                        <td style="width:100px;">
                            <label for="tipo_pass"><span>Resident </span></label>
                            <input type="checkbox" id="tipo_pass" name="tipo_pass" value="0" onclick="opcionCheckbox(this.id)" />
                        </td>
                        <td>
                            <div id="length-tour" class="fields2" >
                                <table><tr><td rowspan="2">
                                            <label><strong>LENGTH OF TOUR</strong></label>
                                        </td></tr>
                                    <tr>
                                        <td>
                                            <span>
                                                <i class="fa fa-sun-o" style="color: #FF8000;"></i>
                                                Days:<br /> <input name="days" id="days" type="text" value="" readonly="readonly">
                                            </span>
                                        </td>
                                        <td><span>
                                                <i class="fa fa-moon-o" style="color: blue;"></i>
                                                Nights:<br /> <input name="nights" id="nights" type="text" value="" readonly="readonly">
                                            </span>
                                        </td></tr></table>
                            </div>
                        </td>

                    </tr>
                </table>
            </div>
        </fieldset>
        <!-- end date of tours -->

        <!-- Transfer-->
        <!--<table width="100%">-->
        <table width="100%" style="margin-top: 2%;">
            <tr>
                <td width="49%" valign="top" >

                    <!--<fieldset id="arrival" style="background-color: #33449C;" >-->
                    <fieldset id="arrival" style="border-radius: 7%;" class="cerati" >
                        <legend id="leg_transfer_in" style="border:1px solid #00C; background:#fff">
                            <label for="opcion_transfer_in" style=" cursor:pointer; ">TRANSFER IN</label>  <input type="checkbox" name="opcion_transfer_in" id="opcion_transfer_in" value="1" checked="checked"/></legend>
                        <div id="conte_arrival" style="height: 215px;" >
                            <table width="100%">
                                <tr>
                                    <td>
                                        <div id="type">
                                            <table width="100%">
                                                <tr>
                                                    <td><div style="color:#FFFFFF;" class="label">ARRIVAL</div></td>
                                                    <td>
                                                        <ul class="list">
                                                            <li><input id="a_bus" name="a_type" type="radio" value="0" checked="checked"><label style="cursor:pointer; color:#FFFFFF;"  for="a_bus">BUS</label></li>
                                                            <li><input id="a_vip" name="a_type" type="radio" value="1"/><label style="cursor:pointer; color:#FFFFFF;"  for="a_vip">VIP</label></li>
                                                            <li><input id="a_airpoty" name="a_type" type="radio" value="2"/><label style="cursor:pointer; color:#FFFFFF;"  for="a_airpoty">AIRPORT</label></li>
                                                            <li><input id="a_car" name="a_type" type="radio" value="3"/><label style="cursor:pointer; color:#FFFFFF;"  for="a_car">BY CAR</label></li>
                                                        </ul>
                                                    </td>
                                                    <td>&nbsp;</td>
                                                    <td title="Price of transport per person">   <div id="t-total">

                                                            <div id="price_transport1pp" class="price">$ 0.00</div>
                                                        </div></td>
                                                </tr>
                                            </table>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div id="arrival-content" style="color: #eee;">
                                            <div id="transport1" class="group" align="left">

                                                <table width="100%"><tr>
                                                        <td>
                                                            <div id="div_from">
                                                                <div style="color:#FFFFFF;" class="label">FROM</div>
                                                                <select style="width:190px; " name="from" id="from" class="select" onchange="change_from();">
                                                                    <option value="0"></option>
                                                                    <?php
                                                                    foreach ($data["to_areas"] as $e) {
                                                                        ?>
                                                                        <option value="<?php echo $e["id"]; ?>"><?php echo $e["nombre"]; ?></option>
                                                                        <?php
                                                                    }
                                                                    ?>
                                                                </select>


                                                            </div>
                                                        </td>
                                                        <td>

                                                            <div id="div_to">
                                                                <div style="color:#FFFFFF;" class="label">TO</div>
                                                                <select style="width:190px" name="to" id="to" class="select">
                                                                    <?php foreach ($data["area_park"] as $e) { ?>
                                                                        <option value="<?php echo $e["id"]; ?>" <?php echo ($e["nombre"] == trim("ORLANDO") ? 'selected' : ''); ?> ><?php echo $e["nombre"]; ?></option>
                                                                    <?php } ?>
                                                                </select>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div id="trip">

                                                                <div style="color:#FFFFFF;" class="label">TRIP</div>
                                                                <table><tr><td>
                                                                            <span><input class="field" name="a_trip_no" type="text" id="a_trip_no" size="3" maxlength="3" value="" readonly="readonly"/>
                                                                                <input type="hidden" name="deptime1"  id="deptime1" value="0" />
                                                                                <input type="hidden" name="arrtime1"  id="arrtime1" value="0" />
                                                                                <input type="hidden" name="trip1a"  id="trip1a" value="0" />
                                                                                <input type="hidden" name="trip1c"  id="trip1c" value="0" />
                                                                            </span></td>
                                                                        <!--<td onclick="mostrarTrip1()"><a><img id="popup1" style="cursor:pointer" src="<?php echo $data['rootUrl']; ?>global/images/search.png"  /></a>-->
                                                                            <td onclick="mostrarTrip1()"><a>&nbsp;<i style="cursor:pointer" id="popup1" class="fa fa-search-plus fa-2x"></i></a>

                                                                        </td></tr></table>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td width="100%" colspan="3">
                                                            <div id="pick-drop">
                                                                <div style="color:#FFFFFF;" class="label">PICK UP POINT/ADDRESS</div>
                                                                <div  style="width:100%" class="ausu-suggest">
                                                                    <input name="a_pickup1" style="width:100%" disabled="disabled" class="field" type="text" id="a_pickup1" autocomplete="off" maxlength="55" value=""/>
                                                                    <input name="a_id_pickup1" type="hidden" id="a_id_pickup1" maxlength="55" value="-1"/>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="3">
                                                            <table width="100%">
                                                                <tr>
                                                                    <td width="25%" style="color:#FFFFFF;">
                                                                        EXTENSION AREA: </td>
                                                                    <td>
                                                                        <select name="ext_from1" id="ext_from1" class="select" style="width:200px;" onchange="change_ext_from1();"></select>


                                                                    </td>
                                                                    <td>&nbsp;</td>
                                                                    <td width="15%">
                                                                        <div id="rooms">
                                                                            <div style="color:#FFFFFF;" class="label">LUGGAGE</div>
                                                                            <span>
                                                                                <input name="a_luggage" type="text" id="a_luggage" size="2" maxlength="1" value="" class="field"/>
                                                                            </span>
                                                                        </div>
                                                                    </td>
                                                                    <td width="15%">
                                                                        <div id="rooms">
                                                                            <div style="color:#FFFFFF;" class="label">ROOM #</div>
                                                                            <span><input name="a_room1" type="text" id="a_room1" size="4" maxlength="6" value="" class="field"/></span>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="3">
                                                            <div style="width:100%" id="ex_pick_drop">
                                                                <div style="color:#FFFFFF;" class="label">EXTENTION DROPOFF POINT/ADDRESS</div>
                                                                <div style="width:100%" class="ausu-suggest">
                                                                    <input name="a_pickup4" style="width:100%" class="field" type="text" id="a_pickup2" maxlength="55" autocomplete="off" value=""/>
                                                                    <input name="a_id_pickup2" type="hidden" id="a_id_pickup2" maxlength="55" value=""/>                                              </span></div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </fieldset>
                </td>
                <td>&nbsp;</td>
                <td width="49%" valign="top">
                    <div id="chk_departure" style="color: #eee;">
                        <fieldset id="departure" style="border-radius: 5%" class="rojo" >
                        <!--<fieldset id="departure" style="background-color: #AC1B29;">-->
                            <legend style="background-color: #fff; border: #B83A36 solid thin;" >
                                <label for="opcion_transfer_out" style=" cursor:pointer; " >TRANSFER OUT</label><input type="checkbox" name="opcion_transfer_out" id="opcion_transfer_out" value="1" checked="checked"/>
                            </legend>
                            <div id="conte_departure"  style="height: 215px;"  >
                                <table width="100%">
                                    <tr>
                                        <td>
                                            <div id="type">
                                                <table width="100%">
                                                    <tr>
                                                        <td><div style="color:#FFFFFF;" class="label">DEPARTURE</div></td>
                                                        <td>
                                                            <ul class="list">
                                                                <li><input id="d_bus" name="d_type" type="radio" value="0" checked="checked"><label style="cursor:pointer; color:#FFFFFF;" for="d_bus">BUS</label></li>
                                                                <li><input id="d_vip" name="d_type" type="radio" value="1"/><label style="cursor:pointer; color:#FFFFFF;" for="d_vip">VIP</label></li>
                                                                <li><input id="d_airpoty" name="d_type" type="radio" value="2"/><label style="cursor:pointer; color:#FFFFFF;" for="d_airpoty">AIRPORT</label></li>
                                                                <li><input id="d_car" name="d_type" type="radio" value="3"/><label style="cursor:pointer; color:#FFFFFF;" for="d_car">BY CAR</label></li>
                                                            </ul>
                                                        </td>
                                                        <td>&nbsp;</td>
                                                        <td title="Price of transport per person"> 

                                                            <div id="t-total">

                                                                <div id="price_transport2pp" class="price">$ 0.00</div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div id="departure-content">
                                                <div id="transport2" class="group" align="left">

                                                    <table width="100%"><tr>
                                                            <td>
                                                                <div id="div_from2">
                                                                    <div style="color:#FFFFFF;" class="label">FROM</div>
                                                                    <select style="width:190px" name="from2" id="from2" class="select">
<?php foreach ($data["area_park"] as $e) { ?>
                                                                            <option value="<?php echo $e["id"]; ?>" <?php echo ($e["nombre"] == trim("ORLANDO") ? 'selected' : ''); ?> ><?php echo $e["nombre"]; ?></option>
<?php } ?>
                                                                    </select>
                                                                </div>
                                                            </td>
                                                            <td>

                                                                <div id="div_to2">
                                                                    <div style="color:#FFFFFF;" class="label">TO</div>
                                                                    <select style="width:190px" name="to2" id="to2" class="select" onchange="change_to2();" >
                                                                        <option value="0"></option>
<?php foreach ($data["to_areas"] as $e) { ?>
                                                                            <option value="<?php echo $e["id"]; ?>" <?php echo ($e["nombre"] == trim("ORLANDO") ? 'selected' : ''); ?> ><?php echo $e["nombre"]; ?></option>
<?php } ?>
                                                                    </select>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div id="trip">

                                                                    <div style="color:#FFFFFF;" class="label">TRIP</div>
                                                                    <table><tr><td>
                                                                                <span><input class="field" name="d_trip_no" type="text" id="d_trip_no" size="3" maxlength="3" value=""
                                                                                             readonly="readonly"/>
                                                                                    <input type="hidden" name="deptime2"  id="deptime2" value="0" />
                                                                                    <input type="hidden" name="arrtime2"  id="arrtime2" value="0" />
                                                                                    <input type="hidden" name="trip2a"  id="trip2a" value="0" />
                                                                                    <input type="hidden" name="trip2c"  id="trip2c" value="0" />
                                                                                </span></td><td>
                                                                                <a rel="superbox[ajax][<?php echo $data['rootUrl']; ?>admin/tours/trips/arrival][300x100]">
                                                                                    <img id="popup2" style="cursor:pointer; display: none;" src="<?php echo $data['rootUrl']; ?>global/images/search.png" /><i id="popup2" style="cursor:pointer" class="fa fa-search-plus fa-2x" onclick="mostrarTrip2()"></i>

                                                                                </a></td></tr></table>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td width="100%" colspan="3">
                                                                <div id="pick-drop">
                                                                    <div style="color:#FFFFFF;" class="label">DROP OFF POINT/ADDRESS</div>
                                                                    <div  style="width:100%" class="ausu-suggest">
                                                                        <input name="d_pickup1" style="width:100%" disabled="disabled"  class="field" type="text" id="d_pickup1" autocomplete="off" maxlength="55" value=""/>
                                                                        <input name="d_id_pickup1" type="hidden" id="d_id_pickup1" maxlength="55" value=""/>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="3">
                                                                <table width="100%">
                                                                    <tr>
                                                                        <td style="color:#FFFFFF;" width="25%">
                                                                            EXTENSION AREA: </td>
                                                                        <td>
                                                                            <select name="ext_to2" id="ext_to2" class="select" style="width:200px;" onchange="change_ext_to2();"></select>


                                                                        </td>
                                                                        <td>&nbsp;</td>
                                                                        <td width="15%">
                                                                            <div id="rooms">
                                                                                <div style="color:#FFFFFF;" class="label">LUGGAGE</div>
                                                                                <span><input name="d_luggage" type="text" id="d_luggage" size="2" maxlength="1" value=""
                                                                                             class="field"/></span>
                                                                            </div>
                                                                        </td>
                                                                        <td width="15%">
                                                                            <div id="rooms">
                                                                                <div style="color:#FFFFFF;" class="label">ROOM #</div>
                                                                                <span><input name="d_room1" type="text" id="d_room1" size="4" maxlength="6" value=""
                                                                                             class="field"/></span>
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="3">
                                                                <div style="width:100%" id="ex-pick-drop">
                                                                    <div style="color:#FFFFFF;" class="label">EXTENTION PICK UP POINT/ADDRESS</div>
                                                                    <div style="width:100%" class="ausu-suggest">
                                                                        <input name="a_pickup2" style="width:100%" class="field" type="text" id="d_pickup2" maxlength="55" value=""/>
                                                                        <input name="a_id_pickup2" type="hidden" id="d_id_pickup2" maxlength="55" value=""/>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </div>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </fieldset>
                    </div>
                </td>
            </tr>
        </table>
        <!-- End Transfer-->
        <!-- Hoteles -->
        <br />
        <table width="100%">
            <tr>
                <td>
                    <div id="chk_hotels">
                        <fieldset id="hotelfieldset" style="border-radius: 5%;">
                            <legend style="background-color:white;border: 1px solid #CCCCCC;">
                                <label for="opcion_hotel" style=" cursor:pointer; " >HOTELS</label><input type="checkbox" checked="checked" id="opcion_hotel" value="1" name="opcion_hotel"/>
                            </legend>
                            <div id="hotels">
                                <input type='hidden' id='nhoteles' name="nhoteles" value='' />
                                <table width="100%">
                                    <tr>
                                        <td id="tdRomm">
                                            <table width="100%">
                                                <tr>
                                                    <td width="15%"  valign="middle">
                                                        <table >
                                                            <tr>
                                                                <td>
                                                                    <div class="label"><i class="fa fa-bed fa-1x" style="margin-left: 16px; color: #AC1B29;"></i><br><strong>ROOMS</strong></div>
                                                                </td>
                                                                <td>
                                                                    <div id="rooms-selection">
                                                                        <select name="select_rooms" id="select_rooms" class="select">

                                                                        </select>
                                                                    </div>

                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>

                                                    <td  style="width:630px;">
                                                        <div id="selectos" style="float:left;"></div>
                                                        <div id="t-total" style="width:170px;float: right;">
                                                            <div class="label">TOTAL PRICE PER PERSON
                                                            </div>
                                                            <div class="price" id="amount_hotel"><?php //echo '$ '.number_format($hotel_reserve->total_paid,2,'.','.');   ?></div>
                                                        </div>
                                                    </td>

                                                </tr>
                                                <td colspan="2">
                                                    <table width="100%"><tr>

                                                            <td width="7%">
                                                                <div class="label"><strong>HOTEL</strong></div>                                                    </td>
                                                            <td width="25%" >
                                                                <div  style="width:100%" class="ausu-suggest">
                                                                    <input  style="width:250px" class="field" type="text" value="" id="hotel_name" autocomplete="off">
                                                                    <input type="hidden" name="hotel_id" id="hotel_id" value="-1"/>
                                                                    <input type="hidden" name="hotel_cat" id="hotel_cat" value="-1"/>
                                                                    <input name="super_breakfast" id="super_breakfast" type="hidden" value="0"/>
                                                                </div>                                                    </td>
                                                            <td>
                                                                <fieldset style="width: 270px;float: left;"><legend>START DATE / END DATE</legend>
                                                                    <!--<a href="" id="dataclick1_h" ><img src="<?php echo $data['rootUrl']; ?>global/images/calendar.png" alt=""  align="absmiddle" width="19" height="20" border="0"  /></a>-->
                                                                    <a href="" id="dataclick1_h" ><i class="fa fa-calendar fa-2x"></i></a>
                                                                    <input name="fecha_salida_h" type="text"  id="fecha_salida_h" size="10" maxlength="15" value="" onchange="fechaRetorno_h(this.value);" autocomplete="off"  />
                                                                    <!--<a href="" id="dataclick2_h" ><img src="<?php echo $data['rootUrl']; ?>global/images/calendar.png" alt=""  align="absmiddle" width="19" height="20" border="0"  /></a>-->
                                                                    <a href="" id="dataclick2_h" ><i class="fa fa-calendar fa-2x"></i></a>
                                                                    <input name="fecha_retorno_h" type="text"  id="fecha_retorno_h" size="10" maxlength="15" value=""   autocomplete="off"   />
                                                                </fieldset>
                                                                <fieldset style="float: left; height:45px; "><legend>FREE DAYS</legend>
                                                                    <table width="100%">
                                                                        <tr>
                                                                            <td width="10%">
                                                                                                                                                    </td>
                                                                            <td width="5%">
                                                                              <span><input class="field" style="width:40px; display:none;" type="number"  min="0" value="0" id="nochesfree"/></span></td>                                                                          
                                                                            <td width="">&nbsp;</td>
<!--                                                                            <div class="label">Adults&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Childs&nbsp;</div>-->
<!--                                                                              <span><input class="field" style="width:40px; " type="number"  min="0" value="0" max="0" id="diasfree"/></span></td>    -->
                                                                            <input style="font-size:16px; display:none;" name="fdadult" id="fdadult" type="number" value="" max="8" min="0" autocomplete="off">
                                                                            &nbsp;&nbsp;&nbsp;
                                                                            
                                                                            
                                                                            
                                                                            <input style="font-size:16px; margin-left:3px; margin-top:2px; width:35px; " name="free_buffet" id="free_buffet" type="number" value="0" max="8" min="0" autocomplete="off">
                                                                            
                                                                            <td width="30%">
                                                                                <div class="label"><strong><label style="cursor:pointer;display:none;" for="free_buffet">Free Buffet&nbsp;</label></strong></div>                                                                    </td>
                                                                            <td width="5%">
<!--                                                                                <span><input style="display:none;" type="checkbox"  id="free_buffet" name="free_buffet"/></span></td>-->
                                                                        </tr></table>
                                                                </fieldset>                                                    </td>
                                                            <td align="center" valign="bottom">

                                                                <div id="add" style="vertical-align:bottom;">
                                                                    <input name="button" type="button" id="add_Hotel_list"  style="height:30px" value="Add to list" />
                                                                </div>                                                    </td>

                                                        </tr></table>
                                                </td>
                                            </table>
                                        </td>
                                        <td rowspan="2">

                                        </td>
                                    </tr>
                                    <tr><td>&nbsp;</td></tr>
                                    <tr>
                                        <td colspan="2">
                                            <div id="table">
                                                <table width="100%"><tr>
                                                        <td width="80%">
                                                            <div id="tablehoteles">
                                                                <table class="grid2" cellspacing="0" cellpadding="0" id="table_7">
                                                                    <thead>
                                                                    <th>NAME</th>
                                                                    <th>PAX</th>
                                                                    <th>NIGHTS</th>
                                                                    <th>SQL</th>
                                                                    <th>DBL</th>
                                                                    <th>TPL</th>
                                                                    <th>QUA</th>
                                                                    <th>BREAKFAST</th>
                                                                    </thead>
                                                                    <tr>
                                                                        <td>&nbsp;</td>
                                                                        <td>&nbsp;</td>
                                                                        <td>&nbsp;</td>
                                                                        <td>&nbsp;</td>
                                                                        <td>&nbsp;</td>
                                                                        <td>&nbsp;</td>
                                                                        <td>&nbsp;</td>
                                                                        <td>&nbsp;</td>
                                                                    </tr>

                                                                </table>
                                                            </div>
                                                        </td>
                                                    </tr></table>

                                            </div>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </fieldset>
                    </div>
                </td>
            </tr>
        </table>
        <!-- End Hoteles -->
        <br />
        <!-- Parks -->
        <div id="traffic">
            <fieldset style="border-radius: 5%;">
                <legend style="background-color:white;border: 1px solid #CCCCCC;">
                    <div id="chk_traffic">
                        <label for="opcion_traffic" style=" cursor:pointer; " >TRAFFIC TOURS  </label>  <input type="checkbox" id="opcion_traffic" checked="checked" value="1" name="opcion_traffic"/>

                    </div>
                </legend>
                <div id="attractions">
                    <table width="100%">
                        <tr>
                            <td>
                                <table width="100%">
                                    <tr>
                                        <td valign="bottom">
                                            <div id="category-selection">
                                                <table>
                                                    <tr>
                                                        <td>
                                                            <div class="label"><strong>CATEGORY</strong></div>
                                                        </td>
                                                        <td valign="bottom">
                                                            <div class="label"><strong>SEARCH PARK</strong></div>
                                                        </td>
                                                        <td colspan="">
                                                            <label><strong>LENGTH OF TOUR</strong></label>
                                                        </td>
                                                    </tr>
                                                    <tr>                            <td valign="bottom">

                                                            <select name="categoria_park" id="categoria_park" class="select">
                                                                <option value="0"></option>
<?php
$grupos = $data['grupos'];
foreach ($grupos as $group) {
    echo '<option value="' . $group['id'] . '">' . $group['nombre'] . '</option>';
}
?>
                                                                <!--
                                                                            <option value="4">WALT DISNEY WORLD</option>
                                                                            <option value="5">SEA WORLD</option>
                                                                            <option value="6">UNIVERSAL PARKS</option>
                                                                            <option value="7">WATER PARKS</option>
                                                                            <option value="9">HISTORIC PARKS</option>
                                                                            <option value="11">AFTER PARKS SHOWS</option>
                                                                            <option value="12">FULLY DAY SHOPPING TOUR</option>-->
                                                            </select>
                                                        </td>
                                                        <td valign="bottom">
                                                            <div  style="width:100%" class="ausu-suggest">
                                                                <input style="width:300px;" class="field" id="park_name" type="text" autocomplete="off" />
                                                                <input type="hidden" name="id_park" id="id_park" value=""/>
                                                                <input type="hidden" name="numPark" id="numPark" value="0"/>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <style type="text/css">
                                                                    .button1 {
                                                                        border: none;
                                                                        background: #AC1B29;
                                                                        color: #fff;
                                                                        padding: 10px;
                                                                        font-size: 18px;
                                                                        border-radius: 0px;
                                                                        position: relative;
                                                                        box-sizing: border-box;
                                                                        transition: all 500ms ease; 
                                                                    }

                                                                    .button1{ 
                                                                        padding: 5px 35px;  
                                                                        overflow:hidden;
                                                                    }

                                                                    .button1:before {
                                                                        font-family: FontAwesome;
                                                                        content:"\f0fe";
                                                                        position: absolute;
                                                                        top: 5px;
                                                                        left: -30px;
                                                                        transition: all 200ms ease;
                                                                    }

                                                                    .button1:hover:before {
                                                                        left: 7px;
                                                                    }
                                                                </style>
                                                            <table class="fields2"><tr></tr>
                                                                <tr>
                                                                    <td>
                                                                        <span>
                                                                            Days:<br /> <input name="days2" id="days2" type="text" value="" readonly="readonly">
                                                                        </span>
                                                                    </td>
                                                                    <td><span>Nights:<br /> <input name="nights1" id="nights2" type="text" value="" readonly="readonly">
                                                                        </span>
                                                                    </td></tr>
                                                            </table>
                                                        </td>
                                                        <td valign="bottom">
                                                            
                                                            <input type="button" id="add_attraction_list" style="height:30px" value="Add to list"/>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="3">
                                            <table width="100%">
                                                <tr>
                                                    <td width="80%">
                                                        <div id="tablePark">
                                                            <table class="grid2" cellspacing="0" cellpadding="0" id="table_7" width="100%">
                                                                <thead>
                                                                    <tr>
                                                                        <th>NAME</th>
                                                                        <th>GROUP</th>
                                                                        <th>TICKET</th>
                                                                        <th>TRANSFER</th>
                                                                        <th>ADMISSION</th>
                                                                        <th>TRANSPORT</th>
                                                                        <th>DELETE</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <tr class="row1">
                                                                        <td>&nbsp;</td>
                                                                        <td>&nbsp;</td>
                                                                        <td>&nbsp;</td>
                                                                        <td>&nbsp;</td>
                                                                        <td>&nbsp;</td>
                                                                        <td>&nbsp;</td>
                                                                        <td>&nbsp;</td>
                                                                    </tr>
                                                                    <tr class="row1">
                                                                        <td>&nbsp;</td>
                                                                        <td>&nbsp;</td>
                                                                        <td>&nbsp;</td>
                                                                        <td>&nbsp;</td>
                                                                        <td>&nbsp;</td>
                                                                        <td>&nbsp;</td>
                                                                        <td>&nbsp;</td>
                                                                    </tr>
                                                                    <tr class="row1">
                                                                        <td>&nbsp;</td>
                                                                        <td>&nbsp;</td>
                                                                        <td>&nbsp;</td>
                                                                        <td>&nbsp;</td>
                                                                        <td>&nbsp;</td>
                                                                        <td>&nbsp;</td>
                                                                        <td>&nbsp;</td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                            <td style="width:170px;" valign="bottom">
                                <div id="info_html" style="font-size: 10px;color: rgb(44, 110, 45);"></div>
                                <div id="t-total">
                                    <div class="label">PRICE PER PERSON OF TRANSPORT LOCAL</div>
                                    <div id="park_transport" class="price">$ 0.00</div>
                                    <div class="label">PRICE PER PERSON OF TICKET </div>
                                    <div id="park_admision" class="price">$ 0.00</div>
                                </div>

                            </td>
                        </tr></table>
                </div>

            </fieldset>
        </div>
        <br />
        <fieldset style="border-radius: 5%;">
            <legend style="background-color:white;border: 1px solid #CCCCCC;"><div id="chk_traffic">
                    <div class="label">COSTO SUMMARY</div></div></legend>
            <table><tr>
                    <td width="50%">
                        <div id="opera" class="input" style="padding-top:0px; width:450px;">
                            <table width="100%" id="tr_complementary" style="display:none;"><tr>
                                    <td width="2%">
                                        <input name="opcion_pago" id="opcion_pago_complementary" value="7"  type="radio"></td>
                                    <td width="20%"><label for="opcion_pago_complementary">Complementary</label></td>
                                </tr>
                            </table>
                            <table width="100%" height="125" id="tableorder" style="display:none;">
                                <tr>
                                    <td  colspan="3" width="34%" height="20" align="center"  >
                                        <input type="hidden" name="opcion_pago_saldo" id="opcion_pago_saldo" value="1" />
                                        <table width="100%" align="center" id="tableTypeSaldo" style="display:none;">
                                            <tr>
                                                <td colspan="6"   height="20" id="titlett" align="center"  ><strong>PAYMENT OPTION
                                                    </strong>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>&nbsp;</td>
                                                <td width="2%">
                                                    <input name="opcion_saldo" id="opcion_saldo1" value="1" checked="checked" type="radio"></td>
                                                <td width="20%">Paid Full</td>
                                                <td width="2%"><input name="opcion_saldo" id="opcion_saldo2" value="2" type="radio"></td>
                                                <td width="20%">Paid Balance</td>
                                                <td>&nbsp;</td>
                                            <tr>
                                            <tr><td colspan="6"><hr /></td></tr>
                                        </table>
                                    </td>
                                </tr>
                                <tr>
                                    <td  height="35" id="titlett" align="left"  ><strong>PRED-PAID</strong> </td>
                                    <td  width="34%" height="35" id="titlett" align="left"  ><strong>COLLECT ON BOARD</strong> </td>
                                    <td  width="34%" height="35" id="titlett" align="left"  ><strong>VOUCHER</strong> </td>
                                </tr>
                                <tr>
                                    <td valign="top" style="width:160px;"  >
                                        <table width="100%">
                                            <tr>
                                                <td colspan="2"></td>
                                            </tr>
            <!--                                <tr id="tipo_passager" style="height:20px;width:160px; display:block;">
                                                <td width="5"><input name="opcion_pago" id="opcion_pago_passager"  value="2" agencypago="true" type="radio"></td>
                                                <td nowrap="nowrap" width="" align="left"><label id="label_tipo_passager" for="opcion_pago_passager" class="opcion_pago">Credit Card no fee</label></td>
                                            </tr>
                                            <tr id="tipo_agency" style="height:20px; width:160px;  display:block">
                                                <td width="5"><input name="opcion_pago" id="opcion_pago_agency"  value="1" agencypago="true" type="radio"></td>
                                                <td  nowrap="nowrap" width="" align="left"> <label id="label_tipo_agency" for="opcion_pago_agency" class="opcion_pago">Credit Card with fee</label></td>
                                            </tr>
                                            <tr id="tipo_passager" style="height:20px;width:160px; display:block">
                                                <td width="5"><input name="opcion_pago" id="opcion_pago_predpaid_cash"  value="6" agencypago="true" type="radio"></td>
                                                <td nowrap="nowrap" > <label id="label_tipo_predpaid_cash" for="opcion_pago_predpaid_cash" class="">Cash in terminal </label></td>
                                            </tr>-->
                                            <tr id="tipo_passager" style="height:20px;width:160px; display:block;">
                                                <td width="5"><input name="opcion_pago" id="opcion_pago_passager"  value="2" agencypago="true" type="radio" class="opcion_pago"></td>
                                                <td nowrap="nowrap" width="" align="left"><label id="label_tipo_passager" for="opcion_pago_passager" class="opcion_pago">Credit Card no fee</label></td>
                                            </tr>
                                            <tr id="tipo_agency" style="height:20px; width:160px;  display:block">
                                                <td width="5"><input name="opcion_pago" id="opcion_pago_agency"  value="1" agencypago="true" type="radio" class="opcion_pago"></td>
                                                <td  nowrap="nowrap" width="" align="left"> <label id="label_tipo_agency" for="opcion_pago_agency" class="opcion_pago">Credit Card with fee</label></td>
                                            </tr>
                                            <tr id="tipo_passager_3" style="height:20px;width:160px; display:block">
                                                <td width="5"><input name="opcion_pago" id="opcion_pago_predpaid_cash"  value="6" agencypago="true" type="radio" class="opcion_pago"></td>
                                                <td nowrap="nowrap" > <label id="label_tipo_predpaid_cash" for="opcion_pago_predpaid_cash" class="">Cash</label></td>
                                            </tr>
                                            <tr id="tipo_passager_4" style="height:20px;width:160px; display:block">
                                                <td width="5"><input name="opcion_pago" id="opcion_pago_predpaid_check"  value="10" agencypago="true" type="radio" class="opcion_pago"></td>
                                                <td nowrap="nowrap" > <label id="label_tipo_predpaid_check" for="opcion_pago_predpaid_check" class="">Check</label></td>
                                            </tr>
                                        </table>
                                    </td>
                                    <td valign="top" >
                                        <table style="width:160px;">
                                            <tr>
                                                <td colspan="2"></td>
                                            </tr>
                                            <tr id="tipo_passager_2" style="">
                                                <td width="5"><input name="opcion_pago" id="opcion_pago_passager_2"  value="8" agencypago="true" type="radio" class="opcion_pago"></td>
                                                <td nowrap="nowrap" width="" align="left"><label id="label_tipo_passager_2" for="opcion_pago_passager_2" class="opcion_pago">Credit Card no fee</label></td>
                                            </tr>
                                            <tr id="tipo_CrediFee">
                                                <td width="5"><input name="opcion_pago" id="opcion_pago_CrediFee" value="3" type="radio" class="opcion_pago"></td>
                                                <td align="left"  nowrap="nowrap" > <label id="label_tipo_CrediFee" for="opcion_pago_CrediFee" class="opcion_pago">Credit Card with fee</label></td>
                                            </tr>
                                            <tr id="tipo_Cash">
                                                <td width="5"><input name="opcion_pago" id="opcion_pago_Cash" value="4" type="radio" class="opcion_pago"></td>
                                                <td align="left"><label id="label_tipo_Cash" for="opcion_pago_Cash" class="opcion_pago">Cash</label></td>
                                            </tr>
                                            <tr id="tipo_Cash_2">
                                                <td width="5"><input name="opcion_pago" id="opcion_pago_Cash_2" value="9" type="radio" class="opcion_pago"></td>
                                                <td align="left"><label id="label_tipo_Cash" for="opcion_pago_Cash_2" class="opcion_pago">Check</label></td>
                                            </tr>
                                        </table>
                                    </td>
                                    <td align="left" valign="top" >
                                        <div id="tipo_Voucher" style="display:none">
                                            <input name="opcion_pago" id="opcion_pago_Voucher" value="5" type="radio"><label id="label_tipo_Cash" for="opcion_pago_Voucher" class="opcion_pago">Credit Voucher</label>
                                        </div>
                                    </td>
                                </tr>

                            </table>
                            <table>
                                <tr>
                                    <td>
                                        <table >
                                            <tr>
                                                <td valign="" >
                                                    <div id="t-total2">
                                                        <div class="label" style="text-align:left;  font-size: 14px;"><strong>TOTAL AMOUNT </strong>  </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div id="t-total2" style="width:168px;">
                                                        <input type="hidden" name="id_tours" id="id_tours" value="" />
                                                        <div class="price">
                                                            <samp  id="totalAmount">$ 0.00</samp>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <label style="margin-left:12px; text-align:left; color: black; "><strong> Disc %</strong></label>                           
                                                    <input name="descuento" type="number" id="descuento" maxlength="3" onchange="valorDescuentoPorec();" max="100" min="0"  value=""  style="height:16px; width:100px;" />

                                                </td>
                                            </tr>
                                            <tr>
                                                <td><label style="font-weight:bold;text-align:left; color: #000">Extra Charges</label></td>
                                                <td colspan="0">
                                                    <input name="extra" type="text" id="extra" size="12" style="color: #000; margin-right:8px; padding-left:5px; width:161px; height:16px; font-size: 16px;
                                                           font-weight: 600;" min="0" onkeyup="valorExtra();"  value="<?php echo $tours->extra_charge ?>" autocomplete="off" />
                                                </td>
                                                <td>
                                                    <label style="margin-left:12px; text-align:left; color: #000;"><strong> Disc &nbsp;$</strong></label>                            
                                                    <input name="descuento_valor" type="number" id="descuento_valor" size="12" maxlength="10" pattern="6[0-9]" style="height:16px; width:100px;" onchange="valorDescuentoValor();"  value=""  />                            
                                                </td>
                                            </tr>
                                            <tr >
                                                <!--<td valign="" >
                                                    <div style="display:none" id="div_tex_comision">
                                                        <div class="label">Comision</div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div   id="div_val_comision" style="display:none; width:170px;">
                                                        <samp  id="valorComision">$ 0.00</samp>
                                                    </div>
                                                </td>-->
                                            </tr>
                                            <tr>
                                                <td valign="" >
                                                    <label style="font-weight:bold;text-align:left; color: #000;">Amount to Collect</label>
                                                </td>
                                                <td>
                                                    <div id="t-total2" style="width:168px;">
                                                        <input autocomplete="off" type="text"  name="otheramount" id="otheramount" value=""
                                                               style="color:#000; margin-right: 2px; padding-left:5px; font-size: 16px; font-weight: 600; width:162px; height:16px;" />
                                                    </div>
                                                </td>
                                            </tr>


                                            <tr>
                                                <td>
                                                    <div id="t-total2">
                                                        <div class="label" style="margin-top: -8px; width:150px;color:#000;" ><strong><label class="label"  id="txtSaldoPorPagar" style="font-weight:bold;  text-align:left; color:#000">TOTAL AMOUNT</label></strong></div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div id="div_pagado" class="t-total3" style="width:168px;">
                                                        <div class="price">
                                                            <samp  id="saldoporpagar">$ 0.00</samp>
                                                        </div>
                                                    </div>
                                                    <br />
                                                </td>
                                            </tr>
                                            <tr style="display:none;">
                                                <td>
                                                    <label  style=" font-weight:bold;color:#00F; text-align:left; ">Total Amount Paid</label>
                                                </td>
                                                <td>
                                                    <div id="t-total" style="width:168px;">
                                                        <div class="price">
                                                            <samp  id="pagado">$  </samp>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr style="background-color: #BCED91;">
                                                <td>
                                                    <div id="t-total3">
                                                        <div class="label" style="width:150px; color:#00F;"><strong><label class="label" id="txtSaldoDiff" style="font-weight:bold;  text-align:left; color: #000;">Amount to Collect</label></strong></div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div id="div_actual" class="t-total3">
                                                        <div class="price" style="border:1px #33F solid; background-color:#00f; color:#fff;">
                                                            <samp id="saldoactual">$0.00</samp>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <select name="opcion_pago" id="op_pago_id" style="margin-left:10px;">
                                                        <optgroup label="COLLECT ON BOARD">
                                                            <option value="8">Credit Card no fee</option>
                                                            <option value="3">Credit Card with fee</option>
                                                            <option value="4">Cash</option>
                                                            <option value="9">Check</option>
                                                        </optgroup>
                                                        <optgroup label="VOUCHER">
                                                            <option value="5">Credit Voucher</option>
                                                        </optgroup>
                                                        <optgroup label="COMPLEMENTARY">
                                                            <option value="7">Complementary</option>
                                                        </optgroup>
                                                    </select>
                                                </td>
                                            </tr>
                                            <tr id="pay_amount_html">
                                                <td valign="" >
                                                    <label style="font-weight:bold; text-align:left; color: #000;">Add Payment</label>
                                                </td>
                                                <td>
                                                    <div id="t-total2" style="width:180px; margin-left:-12px;">
                                                        <input autocomplete="off" type="text" class="txtNumbers"  name="pay_amount" id="pay_amount" value=""  style="padding-left:5px; width:160px; height:20px;" />
                                                    </div>
                                                </td>
                                                <td>
                                                    <select name="opcion_pago_2" style="margin-left:10px;">
                                                        <optgroup label="PRED-PAID">
                                                            <option value="2">Credit Card no fee</option>
                                                            <option value="1">Credit Card with fee</option>
                                                            <option value="6">Cash</option>
                                                            <option value="10">Check</option>
                                                        </optgroup>

                                                    </select>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td align="right">
                                                   <!-- &nbsp;<a style="cursor:pointer" id="btn-save2"><img width="50" height="40" src="<?php echo $data['rootUrl']; ?>global/img/admin/save2.png" /></a>-->
                                                <a style="margin-top: 20px; margin-right: -55px; cursor:pointer" id="btn-save2"><i class="fa fa-floppy-o fa-5x" style="color: #AC1B29;"></i></a>
                                                &nbsp;   
                                                </td>
                                            </tr>
                                        </table>
                                        </div>
                                    </td>
                                    <td width="5%">&nbsp;</td>
                                    <td style="width:300px;" align="left" valign="bottom">
                                        <div id="" class="input"> <div style="width:275px;"><label style="width:150px;"  ><strong>NOTES</strong></label></div><textarea id="comments" name="comments" cols="0" rows="0"  style="width: 339px; height: 250px; "></textarea></div>
                                    </td>
                                </tr>

                                <tr><!-- Detalles -->
                                    <td colspan="2">

                                    </td>
                                    <td>&nbsp;</td>
                                    <td>
                                        <div id="estadoTranssacion">
                                        </div>
                                    </td>
                                </tr>
                            </table>

                            <div id="priceTransporA1" style="display:none">0</div>
                            <div id="priceTransporC1" style="display:none">0</div>
                            <div id="comisionTranspor1" style="display:none">0</div>
                            <div id="priceTransporA2" style="display:none">0</div>
                            <div id="priceTransporC2" style="display:none">0</div>
                            <div id="comisionTranspor2" style="display:none">0</div>
                            <div id="priceExt_from1" style="display:none">0</div>
                            <div id="priceExt_to2" style="display:none">0</div>
                            <div id="totalpriceNights" style="display:none">0</div>
                            <div id="totalpriceBreakfast" style="display:none">0</div>
                            <div id="totalpriceAdmision" style="display:none">0</div>
                            <div id="totalpriceTransporLocal" style="display:none">0</div>
                            </fieldset>
                            </form>
                            <div id="userr"></div>
                            <div id="buffet" title="This hotel does not include breakfast" style="height:200px; display:none"><table width="100%" border="0" cellspacing="1"><tr><td width="22%"><img src="<? echo Doo::conf()->APP_URL; ?>global/images/desayunob.jpg" width="150px;" heigth="50px;"/></td><td colspan="2">&nbsp;</td><td width="76%">Do you want to include SUPER BREAKFAST BUFFET in your Hotel?
                                            <label></label>
                                            <label><br />
                                                <input type="radio" name="buffet" id="buffetYes"  class="buff" value="1" /><label for="buffetYes">YES</label></label>

                                            <input type="radio" name="buffet" class="buff" id="buffetNo" value="0" /><label for="buffetNo">NO</label>
                                        </td></tr></table></div>

                            <div  id="dialog_message4" style="display:none" title="Number of parks">
                                <p>
                                    <span class="ui-icon ui-icon-circle-check" style="float:left; margin:0 7px 50px 0;"></span>
                                    <samp  style="font-size:16px; font-family:'Courier New', Courier, monospace; font-weight:bold;" id="txtMensaje">
                                        ---
                                    </samp>
                                </p>

                            </div>

                            <div id="mascaraP" style="display: none;"></div>
                            <div id="popup" style="display: none;">
                                <div class="content-popup"></div>
                            </div>
                            <div id="anonimo"></div>
                            <div id="anonimo2"></div>
                        </div>
                        <script type="text/javascript">
                            $(window).load(function () {
                                //alert("Se cargo");
                                
                            document.getElementById('rates').value = 0;
                                $("#content").css("opacity", "1");
                                var sel_payment = '<?php echo $reserva->op_pago; ?>';
                                $("#op_pago_id option[value=" + sel_payment + "]").attr("selected", "selected");
                                calcularTotalPago();
                            });
                            $("#op_pago_id").change(function () {
                                calcularTotalPago();
                            });
                            $("#pay_amount").change(function () {
                                calcularTotalPago();
                            });
                        //auto-complete
                            $(document).ready(function () {
                                var id = $("#to").val();
                                $("#ext_from1").load(encodeURI('<?php echo $data['rootUrl']; ?>consul/exten/' + id));

                                var id = $("#from2").val();
                                $("#ext_to2").load(encodeURI('<?php echo $data['rootUrl']; ?>consul/exten/' + id));


                            });
                            $("#dataclick1").click(function (e) {
                                e.preventDefault();
                                //$("#fecha_salida").datepicker("show");
                            });
                            $("#dataclick1_h").click(function (e) {
                                e.preventDefault();
                                // $("#fecha_salida_h").datepicker("show");
                            });
                            //$('#cliente').focus();
                            $('#agency').focus();
                            $.fn.autosugguest({
                                className: 'ausu-suggest',
                                methodType: 'POST',
                                minChars: 1,
                                rtnIDs: true,
                                dataFile: '<?php echo $data["rootUrl"]; ?>admin/tours/loaddatos'
                            });

                            function poner(id, id2) {
                                var id = id;
                                var id2 = id2;
                                $("#userr").load('<?php echo $data["rootUrl"]; ?>admin/tours/cargardatos/' + id + '/' + id2);
                            }

                            $("#newClient").click(function () {
                                $.ajax({
                                    url: '<?php echo $data['rootUrl']; ?>admin/clientes/addClient',
                                    success: function (data) {
                                        if (parseInt(data) != 0) {
                                            $("#clienteN").html(data);
                                        }
                                    }
                                });
                                $('#mascaraP').fadeIn('slow');
                                $('#clienteN').fadeIn('slow');
                            });
                            $('#fecha_salida').datepicker({
                                dateFormat: 'mm-dd-yy',
                            });
                            $('#fecha_retorno').datepicker({
                                dateFormat: 'mm-dd-yy',
                                beforeShow: function () {
                                    if ($('#fecha_retorno').attr("readonly") == "readonly") {
                                        return false;
                                    }
                                }
                            });
                            $('#fecha_salida_h').datepicker({
                                dateFormat: 'mm-dd-yy'
                            });
                            $('#fecha_retorno_h').datepicker({
                                dateFormat: 'mm-dd-yy'
                            });
                            $("#dataclick2").click(function (e) {
                                e.preventDefault();
                                //$("#fecha_retorno").datepicker("show");
                            });
                            $("#dataclick2_h").click(function (e) {
                                e.preventDefault();
                                // $("#fecha_retorno_h").datepicker("show");
                            });
                            function fechaRetorno(menor) {
                                var d = new Date(menor);
                                d.setTime(d.getTime() + 1 * 24 * 60 * 60 * 1000)
                                $('#fecha_retorno').datepicker('option', 'minDate', d);
                            }
                            function fechaRetorno_h(menor) {
                                var fecha_max = $("#fecha_retorno").val();
                                var d = new Date(menor);
                                d.setTime(d.getTime() + 1 * 24 * 60 * 60 * 1000);
                                var d2 = new Date(menor);
                                d2.setTime(d.getTime());

                                $('#fecha_retorno_h').datepicker('option', 'minDate', d, "maxDate", d2);
                            }
                            $("#fecha_salida").change(function () {
                                var fecha_salida = $('#fecha_salida').val();
                                $("#fecha_salida_h").val(fecha_salida);
                                if (!Validar(fecha_salida)) {
                                    $('#fecha_salida').focus();
                                } else {
                                    var fecha_retorno = $('#fecha_retorno').val();
                                    if (Validar(fecha_retorno)) {
                                        var d = diferencia();
                                        diferencia();
                                        $("#hotel_name").attr('disabled', false);
                                    } else {
                                        $("#hotel_name").attr('disabled', true);
                                    }
                                }
                            });
                            $("#fecha_retorno").change(function () {
                                var fecha_retorno = $('#fecha_retorno').val();
                                $("#fecha_retorno_h").val(fecha_retorno);
                                if (!Validar(fecha_retorno)) {
                                    $('#fecha_retorno').focus();
                                } else {
                                    var fecha_salida = $('#fecha_salida').val();
                                    if (Validar(fecha_salida)) {
                                        var d = diferencia();
                                        diferencia();
                                        $("#hotel_name").attr('disabled', false);
                                    } else {
                                        $("#hotel_name").attr('disabled', true);
                                    }
                                }
                            });
                            function fechaRetorno(menor) {
                                var d = new Date(menor);
                                d.setTime(d.getTime() + 1 * 24 * 60 * 60 * 1000)
                                $('#fecha_retorno').datepicker('option', 'minDate', d);
                            }
                            function diferencia() {
                                if ($('#fecha_retorno').val() != "") {
                                    var diferencia = Math.floor((Date.parse($('#fecha_retorno').val()) - Date.parse($('#fecha_salida').val())) / 86400000);
                                    if (diferencia < 0) {
                                        alert('End date must be greater than start date');
                                        fechaRetorno($('#fecha_salida').val());
                                        $('#fecha_retorno').focus();
                                        return 0;
                                    } else {
                                        $("#nights").val((diferencia));

                                        $("#days").val(diferencia + 1);
                                        $("#nights2").val((diferencia));
                                        $("#days2").val(diferencia + 1);
                                        $("#fdadult").attr('max', diferencia);
                                        
                                        return diferencia;
                                    }
                                }
                                return 0;
                            }
                            $("#type_services_premiun, #type_services_vip").change(function (e) {
                                var val = $(this).val();
                                if (val == 1) {
                                    $("#a_bus").attr('disabled', true);
                                    $("#a_car").attr('disabled', true);
                                    $("#d_bus").attr('disabled', true);
                                    $("#d_car").attr('disabled', true);

                                    //Seleccionamos VIP
                                    if ($("#a_bus").is(":checked") || $("#a_car").is(":checked")) {
                                        $("#a_vip").attr('checked', true);
                                        typeTranspor1($("#a_vip").val());
                                    }
                                    if ($("#d_bus").is(":checked") || $("#d_car").is(":checked")) {
                                        $("#d_vip").attr('checked', true);
                                        typeTranspor2($("#d_vip").val());
                                    }
                                } else {
                                    $("#a_bus").attr('disabled', false);
                                    $("#a_car").attr('disabled', false);
                                    $("#d_bus").attr('disabled', false);
                                    $("#d_car").attr('disabled', false);
                                }
                            });
                            $("#a_bus, #a_vip,#a_airpoty, #a_car").change(function () {
                                var id = $(this).val();
                                typeTranspor1(id);
                                if (id != 0) {
                                    valorTransfer(id, 1, 1);
                                } else {
                                    $("#priceTransporA1").html(0);
                                    $("#priceTransporC1").html(0);
                                    calcularTotalPago();
                                }
                            });
                            $("#d_bus, #d_vip,#d_airpoty, #d_car").change(function () {
                                var id = $(this).val();
                                typeTranspor2(id);
                                if (id != 0) {
                                    valorTransfer(id, 2, 2);
                                } else {
                                    $("#priceTransporA2").html(0);
                                    $("#priceTransporC2").html(0);
                                    calcularTotalPago();
                                }
                            });
                            function typeTranspor1(id) {
                                $("#transport1").load('<?php echo $data["rootUrl"]; ?>admin/tours/typeTranspor1/' + id);
                            }
                            function typeTranspor2(id) {
                                $("#transport2").load('<?php echo $data["rootUrl"]; ?>admin/tours/typeTranspor2/' + id);
                            }
                            function valorTransferGeneral() {
                                var a_t_num = document.getElementsByName('a_type').length;
                                var a_type = 0;
                                for (var i = 0; i < a_t_num; i++) {
                                    if (document.getElementsByName('a_type').item(i).checked) {
                                        a_type = document.getElementsByName('a_type').item(i).value;
                                    }
                                }

                                var d_t_num = document.getElementsByName('d_type').length;
                                var d_type = 0;
                                for (var i = 0; i < d_t_num; i++) {
                                    if (document.getElementsByName('d_type').item(i).checked) {
                                        d_type = document.getElementsByName('d_type').item(i).value;
                                    }
                                }
                                if (a_type != 0) {
                                    valorTransfer(a_type, 1, 1);
                                }
                                if (d_type != 0) {
                                    valorTransfer(d_type, 2, 2);
                                }
                            }
                            function valorTransfer(tipo_transfer, tipo_transport, sentido) {
                                
                                var rates = $('#rates').val();
                                var child = $('#child').val();
                                var adult = $('#adult').val();
                                if (child == "") {
                                    child = 0;
                                }
                                if (adult == "") {
                                    adult = 0;
                                }
                                var id_agencia = $("#id_agency").val();
                                if (sentido == 1) { //para ida
                                    var fecha = $("#fecha_salida").val();
                                } else {
                                    var fecha = $("#fecha_retorno").val();
                                }
                                //Calulamos el valor y la comision del transfer
                                $("#userr").load('<?php echo $data["rootUrl"]; ?>admin/tours/valorTransfer/' + tipo_transfer + '/' + tipo_transport + '/' + child + '/' + adult + '/' + id_agencia + '/' + fecha + '/' + sentido + '/' + rates);
                            }
                            function opcionCheckbox(id) {
                                if ($("#" + id).attr("checked")) {
                                    $("#" + id).val('1');
                                } else {
                                    $("#" + id).val('0');
                                }
                            }
                            $("#child, #adult").change(function () {
                        //     if($("#type_services_premiun").is(':checked')){
                        //        var vip_new = 0;
                        //    }else{
                        //        var vip_new = 1;
                        //    }
                        //    if(vip_new == 1){
                        //        if(confirm("Tendra que ingresar nuevamente las atracciones y hotel, esta seguro de este cambio?")){
                        //            var sino = 1;
                        //        }else{
                        //            var sino = 0;
                        //        }
                        //    }else{
                        //        var sino = 0;
                        //    }
                        //    
                        //    if(sino == 1){
                                var adult = $("#adult").val();
                                var child = $("#child").val();
                                if (adult < 1) {
                                    adult = 1;
                                    $("#adult").val(adult);
                                } else if (adult > 16) {
                                    adult = 16;
                                    $("#adult").val(adult);
                                }
                                var maxChild = 16 - adult;
                                $("#child").attr('max', maxChild);
                                if (child < 0) {
                                    $("#child").val(0);
                                } else if (child > maxChild) {
                                    $("#child").val(maxChild);
                                }
                                var id_agency = $("#id_agency").val();
                                var url = '<?php echo $data['rootUrl']; ?>admin/tours/change/pax/attractions/' + $("#adult").val() + '/' + $("#child").val() + '/' + id_agency;
                                $("#anonimo2").load(url);

                                // parque 
                                valorTransferGeneral();
                                habitaciones();
                                calcularTotalPago();
                        //    }

                            });
                            function mostrarTrip1() {
                                var rates = $('#rates').val();
                                                                                         
                                var from = $('#from').val();
                                var to = $('#to').val();
                                var fecha_salida = $('#fecha_salida').val();
                                var tipopas = $('#tipo_pass').val();
                                var child = $('#child').val();
                                var adult = $('#adult').val();
                                if (child == "") {
                                    child = 0;
                                }
                                if (adult == "") {
                                    adult = 0;
                                }
                                var totalpax = (parseInt(adult) + parseInt(child));

                                var agency;
                                if ($('#id_agency').val() != '-1') {
                                    agency = $('#id_agency').val()
                                } else {
                                    agency = -1;
                                }
                                var mensage = "";
                                if (!Validar(fecha_salida)) {
                                    msj = '- Incorrect tours start date.';
                                    titulo = 'START DATE';
                                    mensaje(msj, titulo, 'fecha_salida');
                                    return false;
                                }
                                if (totalpax == 0) {
                                    msj = '- Passenger numbers must be greater than zero.';
                                    titulo = 'Passenger numbers ';
                                    mensaje(msj, titulo, 'adult');
                                    return false;
                                }
                                if (from == '' || from == 0) {
                                    msj = '- From is required (The departure area).';
                                    titulo = 'The departure area ';
                                    mensaje(msj, titulo, 'from');
                                    return false;
                                }
                                if (to == '' || to == 0) {
                                    msj = '- To is required (The arrival area).';
                                    titulo = 'The arrival area ';
                                    mensaje(msj, titulo, 'to');
                                    return false;
                                }
                                $(".content-popup").html(" ");
                                var url = '<?php echo $data["rootUrl"]; ?>admin/tours/selectTrip1/' + from + '/' + to + '/' + fecha_salida + '/' + totalpax + '/' + tipopas + '/' + agency + '/' + rates;
                                $('.content-popup').load(url);

                                $('#mascaraP').fadeIn('slow');
                                $('#popup').fadeIn('slow');
                            }
                            function mostrarTrip2() {
                                
                                var rates = $('#rates').val();
                                var from = $('#from2').val();
                                var to = $('#to2').val();
                                var fecha_retorno = $('#fecha_retorno').val();
                                var tipopas = $('#tipo_pass').val();
                                var child = $('#child').val();
                                var adult = $('#adult').val();
                                if (child == "") {
                                    child = 0;
                                }
                                if (adult == "") {
                                    adult = 0;
                                }
                                var totalpax = (parseInt(adult) + parseInt(child));

                                var agency;
                                if ($('#id_agency').val() != '-1') {
                                    agency = $('#id_agency').val()
                                } else {
                                    agency = -1;
                                }
                                //var dato = from+'  '+to+'  '+fecha_retorno+'  '+tipopas+'  '+agency +'  '+totalpax;
                                //alert(dato);
                                var mensage = "";
                        //    if(!Validar(fecha_retorno)){
                        //        msj = '- Incorrect final date of the tour.';
                        //        titulo = 'END DATE';
                        //        mensaje(msj,titulo,'fecha_retorno');
                        //        return false;
                        //    }
                                if (totalpax == 0) {
                                    msj = '- Passenger numbers must be greater than zero.';
                                    titulo = 'Passenger numbers ';
                                    mensaje(msj, titulo, 'adult');
                                    return false;
                                }
                                if (from == '' || from == 0) {
                                    msj = '- From is required (The departure area).';
                                    titulo = 'The departure area ';
                                    mensaje(msj, titulo, 'from2');
                                    return false;
                                }
                                if (to == '' || to == 0) {
                                    msj = '- To is required (The arrival area).';
                                    titulo = 'The arrival area ';
                                    mensaje(msj, titulo, 'to2');
                                    return false;
                                }
                                $(".content-popup").html(" ");
                                var url = '<?php echo $data["rootUrl"]; ?>admin/tours/selectTrip2/' + from + '/' + to + '/' + fecha_retorno + '/' + totalpax + '/' + tipopas + '/' + agency + '/' + rates;
                                $('.content-popup').load(url);

                                $('#mascaraP').fadeIn('slow');
                                $('#popup').fadeIn('slow');
                            }
                            function trim(myString) {
                                return myString.replace(/^\s+/g, '').replace(/\s+$/g, '')
                            }
                            $("#opcion_transfer_in").change(function () {
                                var i = $(this).val();
                                $(this).val((1 - i));
                                ocultar('opcion_transfer_in', 'conte_arrival');
                            });
                            $("#opcion_transfer_out").change(function () {
                                var i = $(this).val();
                                $(this).val((1 - i));
                                ocultar('opcion_transfer_out', 'conte_departure');
                            });
                            $("#opcion_hotel").change(function () {
                                var i = $(this).val();
                                $(this).val((1 - i));
                                ocultar('opcion_hotel', 'hotels');
                            });
                            $("#opcion_traffic").change(function () {
                                var i = $(this).val();
                                $(this).val((1 - i));
                                ocultar("opcion_traffic", 'attractions');
                            });
                            function ocultar(id, id2) {
                                if (!$("#" + id).is(':checked')) {
                                    $("#" + id2).hide("blind", {direction: "vertical"}, 500);
                                } else {
                                    $("#" + id2).show("blind", {direction: "vertical"}, 500);
                                }
                            }
                            function change_from() {
                                var id = $("#to").val();
                                $("#ext_from1").load(encodeURI('<?php echo $data['rootUrl']; ?>consul/exten/' + id));
                                if (id != 0) {
                                    $("#a_pickup1").attr('disabled', false);
                                } else {
                                    $("#a_pickup1").attr('disabled', true);
                                }
                            }
                            function change_to2() {
                                var id = $("#from2").val();
                                $("#ext_to2").load(encodeURI('<?php echo $data['rootUrl']; ?>consul/exten/' + id));
                                if (id != 0) {
                                    $("#d_pickup1").attr('disabled', false);
                                } else {
                                    $("#d_pickup1").attr('disabled', true);
                                }
                            }
                            function change_ext_from1() {
                                var id = $("#ext_from1").val();
                                if (id != 0) {
                                    var id_agency = $("#id_agency").val();
                                    var num = 1;
                                    $("#userr").load(encodeURI('<?php echo $data['rootUrl']; ?>admin/tours/priceexten/' + id + '/' + id_agency + '/' + num));
                                    $("#a_pickup2").attr('disabled', false);
                                    $("#a_pickup1").attr('disabled', true);
                                } else {
                                    $("#a_pickup2").attr('disabled', true);
                                    $("#a_pickup1").attr('disabled', false);
                                    $("#a_id_pickup1").val('-1');
                                    $("#priceExt_from1").html('0');
                                    calcularTotalPago();
                                }
                            }
                            function change_ext_to2() {
                                var id = $("#ext_to2").val();
                                if (id != 0) {
                                    var id_agency = $("#id_agency").val();
                                    var num = 4;
                                    $("#userr").load(encodeURI('<?php echo $data['rootUrl']; ?>admin/tours/priceexten/' + id + '/' + id_agency + '/' + num));
                                    $("#d_pickup2").attr('disabled', false);
                                    $("#d_pickup1").attr('disabled', true);
                                } else {
                                    $("#d_pickup2").attr('disabled', true);
                                    $("#d_pickup1").attr('disabled', false);
                                    $("#priceExt_to2").html('0');
                                    calcularTotalPago();
                                }
                            }
                            habitaciones();
                            function habitaciones() {
                                var child = $('#child').val();
                                var adult = $('#adult').val();
                                if (child == "") {
                                    child = 0;
                                }
                                if (adult == "") {
                                    adult = 0;
                                }
                                url = '<?php echo $data['rootUrl']; ?>admin/tours/habitacionesAginables/' + adult + '/' + adult;
                                $("#select_rooms").load(url);

                                var totalpax = (parseInt(adult) + parseInt(child));
                                var url = '<?php echo $data['rootUrl']; ?>admin/tours/habitaciones/' + adult + '/' + child;
                                $("#selectos").load(url);
                            }
                            $("#select_rooms").change(function () {
                                var child = $('#child').val();
                                var adult = $('#adult').val();
                                if (child == "") {
                                    child = 0;
                                }
                                if (adult == "") {
                                    adult = 0;
                                }
                                var num = $("#select_rooms").val();
                                var url = '<?php echo $data['rootUrl']; ?>admin/tours/habitaciones2/' + num + '/' + adult + '/' + child;
                                $("#selectos").load(url);

                            });
                            $("#add_Hotel_list").click(function () {
                                cargarHoteles();
                            });
                            function validarAcomodacion() {
                                if ($('#adult1').length != 0) {
                                    var adult1 = $('#adult1').val();
                                    if (adult1 == 0) {
                                        alert('- Room 1: The rooms must have at least one adult.')
                                        $('#adult1').focus();
                                        return '';
                                    }
                                } else {
                                    var adult1 = 0;
                                }
                                if ($('#child1').length != 0) {
                                    var child1 = $('#child1').val();
                                } else {
                                    var child1 = 0;
                                }
                                if ($('#adult2').length != 0) {
                                    var adult2 = $('#adult2').val();
                                    if (adult2 == 0) {
                                        alert('- Room 2: The rooms must have at least one adult.')
                                        $('#adult2').focus();
                                        return '';
                                    }
                                } else {
                                    var adult2 = 0;
                                }
                                if ($('#child2').length != 0) {
                                    var child2 = $('#child2').val();
                                } else {
                                    var child2 = 0;
                                }
                                if ($('#adult3').length != 0) {
                                    var adult3 = $('#adult3').val();
                                    if (adult3 == 0) {
                                        alert('- Room 3: The rooms must have at least one adult.')
                                        $('#adult3').focus();
                                        return '';
                                    }
                                } else {
                                    var adult3 = 0;
                                }
                                if ($('#child3').length != 0) {
                                    var child3 = $('#child3').val();
                                } else {
                                    var child3 = 0;
                                }
                                if ($('#adult4').length != 0) {
                                    var adult4 = $('#adult4').val();
                                    if (adult4 == 0) {
                                        alert('- Room 4: The rooms must have at least one adult.')
                                        $('#adult4').focus();
                                        return '';
                                    }
                                } else {
                                    var adult4 = 0;
                                }
                                if ($('#child4').length != 0) {
                                    var child4 = $('#child4').val();
                                } else {
                                    var child4 = 0;
                                }

                                adult1 = parseInt(adult1);
                                child1 = parseInt(child1);
                                adult2 = parseInt(adult2);
                                child2 = parseInt(child2);
                                adult3 = parseInt(adult3);
                                child3 = parseInt(child3);
                                adult4 = parseInt(adult4);
                                child4 = parseInt(child4);

                                var child = $('#child').val();
                                var adult = $('#adult').val();
                                if (child == "") {
                                    child = 0;
                                }
                                if (adult == "") {
                                    adult = 0;
                                }
                                var totalpax1 = (parseInt(adult) + parseInt(child));
                                var totalpax2 = (adult1 + child1 + adult2 + child2 + adult3 + child3 + adult4 + child4);

                                if (totalpax1 != totalpax2) {
                                    alert('- The number of people in the rooms does not match the total passajeros ');
                                    $('#adult1').focus();
                                    return '';
                                }

                                if (adult != (adult1 + adult2 + adult3 + adult4)) {
                                    alert('- The number of people in the rooms does not match the total passajeros.');
                                    $('#adult1').focus();
                                    return '';
                                }
                                var dato = '/' + adult1 + '/' + adult2 + '/' + adult3 + '/' + adult4 + '/' + child1 + '/' + child2 + '/' + child3 + '/' + child4;
                                return dato;
                            }
                            $("#free_buffet").click(function (e) {
//                                if ($("#free_buffet").is(":checked")) {
//                                    $("#free_buffet").val(1);
//                                } else {
//                                    $("#free_buffet").val(0);
//                                }
                             var free_buffet = $('#free_buffet').val();

                            });
                            function cargarHoteles() {
                                
                                var id_tour = $("#id_tour").html();
                                var rates = $('#rates').val();
                                var datosroom = validarAcomodacion();

                                var msj = '';
                                var titulo = '';
                                if (datosroom != '') {
                                    var fecha_retorno = $('#fecha_retorno_h').val();
                                    var fecha_salida = $('#fecha_salida_h').val();
                                    var id_hotel = $('#hotel_id').val()
                                    if (!Validar(fecha_salida)) {
                                        msj = '- Incorrect tours start date.';
                                        titulo = 'START DATE';
                                        mensaje(msj, titulo, 'fecha_salida');
                                        return false;
                                    }
                                    if (!Validar(fecha_retorno)) {
                                        msj = '- Incorrect final date of the tour';
                                        titulo = 'END DATE';
                                        mensaje(msj, titulo, 'fecha_retorno');
                                        return false;
                                    }
                                    if (id_hotel == '' || id_hotel == -1 || id_hotel == 0) {
                                        msj = '-  Select the hotel you want to add';
                                        titulo = 'Hotel of the tour';
                                        mensaje(msj, titulo, 'hotel_name');
                                        return false;
                                    }
                                    var d = diferencia();
                                    var fdadult = $('#fdadult').val();
                                   
                                    if (d < fdadult) {
                                        msj = '- The number of free days exceeds the size of the tour';
                                        titulo = 'Free Days';
                                        mensaje(msj, titulo, 'fdadult');
                                        return false;
                                    }



                                    var free_buffet = $("#free_buffet").val();
                                    if (free_buffet == undefined) {
                                        free_buffet = 0;
                                    }
                                    var id_agency = $("#id_agency").val();
                                    var fdadult = $("#fdadult").val();
                                    var fdchild = $("#fdchild").val();
                                    var url = '<?php echo $data['rootUrl']; ?>admin/tours/selecthotel/' + id_hotel + '/' + fecha_salida + '/' + fecha_retorno + datosroom + '/' + id_agency + '/' + fdadult + '/' +free_buffet+ '/' + rates;
                                    
                                    $("#tablehoteles").load(url);
                                }
                            }

                            function mensaje(msg, titulo, id) {
                                $("#txtMensaje").text(msg);
                                $("#dialog_message4").removeAttr('title');
                                $("#dialog_message4").attr('title', titulo);
                                $("#dialog_message4").dialog({
                                    modal: true,
                                    width: 600,
                                    buttons: {
                                        Ok: function () {
                                            $("#dialog_message4").dialog("close");
                                            $('#' + id).focus();
                                        }
                                    }
                                });
                                $("#ui-dialog-title-dialog_message4").text(titulo);
                            }

                            $("#add_attraction_list").click(function () {
                                var msj = '';
                                var titulo = '';
                                var id_park = $("#id_park").val();
                                var fecha_retorno = $('#fecha_retorno').val();
                                var fecha_salida = $('#fecha_salida').val();
                                var id_group = $('#categoria_park').val();

                                var child = $('#child').val();
                                var adult = $('#adult').val();
                                if (child == "") {
                                    child = 0;
                                }
                                if (adult == "") {
                                    adult = 0;
                                }
                                var totalpax = (parseInt(adult) + parseInt(child));

                                if (!Validar(fecha_salida)) {
                                    msj = '- Incorrect tours start date.';
                                    titulo = 'START DATE';
                                    mensaje(msj, titulo, 'fecha_salida');
                                    return false;
                                }
                                if (!Validar(fecha_retorno)) {
                                    msj = '- Incorrect final date of the tour';
                                    titulo = 'END DATE';
                                    mensaje(msj, titulo, 'fecha_retorno');
                                    return false;
                                }
                                if (id_park == '' || id_park == '-1' || id_park == '0') {
                                    msj = '- Choose a park to add to the tour';
                                    titulo = 'Parks of the tour';
                                    mensaje(msj, titulo, 'park_name');
                                    return false;
                                }
                                if (totalpax <= 1 && id_park == '19') {
                                    msj = '- to go to Kennedy space ctr., there must be 2 passengers ';
                                    titulo = 'Alert';
                                    mensaje(msj, titulo, 'park_name');
                                    return false;
                                }


                                var id_agency = $("#id_agency").val();
                                if ($("#type_services_premiun").is(':checked')) {
                                    var platinum = 0;
                                } else {
                                    var platinum = 1;
                                }

                                var url = '<?php echo $data['rootUrl']; ?>admin/tours/selectpark/' + id_park + '/' + id_group + '/' + adult + '/' + child + '/' + fecha_salida + '/' + fecha_retorno + '/' + platinum + '/' + id_agency;
                                $("#tablePark").load(url);

                                $("#park_name").val('');
                                $("#categoria_park").val(0);
                            });



                            function checker_admision(check, img, id_park) {
                                if ($("#" + check).is(":checked")) {
                                    $("#" + check).attr("checked", false);
                                    var url = "<?php echo $data['rootUrl']; ?>global/img/admin/x02.png";
                                    $("#" + img).hide("blind", {direction: "vertical"}, 300);
                                    $("#" + img).attr('src', url);
                                    $("#" + img).show("blind", {direction: "vertical"}, 300);
                                    var opcion = 0;
                                } else {
                                    $("#" + check).attr("checked", true);
                                    var url = "<?php echo $data['rootUrl']; ?>global/img/admin/check2.png";
                                    $("#" + img).hide("blind", {direction: "vertical"}, 300);
                                    $("#" + img).attr('src', url);
                                    $("#" + img).show("blind", {direction: "vertical"}, 300);
                                    var opcion = 1;
                                }
                                var child = $('#child').val();
                                var adult = $('#adult').val();
                                if (child == "") {
                                    child = 0;
                                }
                                if (adult == "") {
                                    adult = 0;
                                }
                                var id_agency = $("#id_agency").val();
                                $("#userr").load('<?php echo $data['rootUrl']; ?>admin/tours/gastionpark/' + id_park + '/' + opcion + '/' + adult + '/' + child + '/' + id_agency);
                            }
                            function checker_admision_todos(opcion) {
                                var id_park = 'a';
                                var child = $('#child').val();
                                var adult = $('#adult').val();
                                if (child == "") {
                                    child = 0;
                                }
                                if (adult == "") {
                                    adult = 0;
                                }
                                var id_agency = $("#id_agency").val();
                                $("#userr").load('<?php echo $data['rootUrl']; ?>admin/tours/gastionpark/' + id_park + '/' + opcion + '/' + adult + '/' + child + '/' + id_agency);
                            }


                            function checker_transport(check, img, id_park) {
                                if ($("#" + check).is(":checked")) {
                                    $("#" + check).attr("checked", false);
                                    var url = "<?php echo $data['rootUrl']; ?>global/img/admin/x02.png";
                                    $("#" + img).hide("blind", {direction: "vertical"}, 300);
                                    $("#" + img).attr('src', url);
                                    $("#" + img).show("blind", {direction: "vertical"}, 300);
                                    var opcion = 0;
                                } else {
                                    $("#" + check).attr("checked", true);
                                    var url = "<?php echo $data['rootUrl']; ?>global/img/admin/check2.png";
                                    $("#" + img).hide("blind", {direction: "vertical"}, 300);
                                    $("#" + img).attr('src', url);
                                    $("#" + img).show("blind", {direction: "vertical"}, 300);
                                    var opcion = 1;
                                }
                                var child = $('#child').val();
                                var adult = $('#adult').val();
                                if (child == "") {
                                    child = 0;
                                }
                                if (adult == "") {
                                    adult = 0;
                                }
                                $("#userr").load('<?php echo $data['rootUrl']; ?>admin/tours/gastionTransorLocal/' + id_park + '/' + opcion + '/' + adult + '/' + child);
                            }

                            function  checker_transport_todos(opcion) {
                                var id_park = 'a';
                                var child = $('#child').val();
                                var adult = $('#adult').val();
                                if (child == "") {
                                    child = 0;
                                }
                                if (adult == "") {
                                    adult = 0;
                                }
                                $("#userr").load('<?php echo $data['rootUrl']; ?>admin/tours/gastionTransorLocal/' + id_park + '/' + opcion + '/' + adult + '/' + child);
                            }


                            function delete_park(id_park) {
                                var child = $('#child').val();
                                var adult = $('#adult').val();
                                if (child == "") {
                                    child = 0;
                                }
                                if (adult == "") {
                                    adult = 0;
                                }
                                $("#tablePark").load('<?php echo $data['rootUrl']; ?>admin/tours/delete_park/' + id_park + '/' + adult + '/' + child);
                            }
                            function delete_hotel(id_hotel) {
                                $('#buffetYes').attr('checked', false);                                
//                                var free_buffet = $("#free_buffet").val();
//                                free_buffet = 0;
//                                $("#free_buffet").val() = free_buffet;
                                //$("#free_buffet").val(0);
                                
                                var free_buffet = $("#free_buffet").val();
                                    if (free_buffet > 0) {
                                        free_buffet = 0;
                                        $("#free_buffet").val(0);
                                    }
                                $('#buffetNo').attr('checked', false);
                                $("#tablehoteles").load('<?php echo $data['rootUrl']; ?>admin/tours/delete_hotel/' + id_hotel);
                            }
                            function calcularTranspor1(adult, child) {
                                var a_t_num = document.getElementsByName('a_type').length;
                                var a_type = 0;
                                for (var i = 0; i < a_t_num; i++) {
                                    if (document.getElementsByName('a_type').item(i).checked) {
                                        a_type = document.getElementsByName('a_type').item(i).value;
                                    }
                                }
                                                              
                                if (a_type == 0) {
                                    var priceTranspor1 = (priceA * adult) + (priceC * child);
                                } else {
                                    var priceTranspor1 = parseFloat(priceA) + parseFloat(priceC);
                                }
                                return priceTranspor1;
                                
                                
                            }
                            function calcularTranspor2(adult, child) {
                                var d_t_num = document.getElementsByName('d_type').length;
                                var d_type = 0;
                                for (var i = 0; i < d_t_num; i++) {
                                    if (document.getElementsByName('d_type').item(i).checked) {
                                        d_type = document.getElementsByName('d_type').item(i).value;
                                    }
                                }
                                var priceA = $("#priceTransporA2").html();
                                var priceC = $("#priceTransporC2").html();
                                if (d_type == 0) {
                                    var priceTranspor2 = (priceA * adult) + (priceC * child);
                                } else {
                                    var priceTranspor2 = parseFloat(priceA) + parseFloat(priceC);
                                }
                                return priceTranspor2;
                            }
                            function calcularExtencion1(adult, child) {
                                var exten1 = $("#priceExt_from1").html();
                                var totalpax = parseInt(adult) + parseInt(child);
                                var priceExten = (exten1 * totalpax);
                                return priceExten;
                            }
                            function calcularExtencion2(adult, child) {
                                var exten4 = $("#priceExt_to2").html();
                                var totalpax = parseInt(adult) + parseInt(child);
                                var priceExten2 = (exten4 * totalpax);
                                return priceExten2;
                            }
                            function calcularCostoHotel(adult, child) {
                                var priceHotel = $("#totalpriceNights").html();
                                return priceHotel;
                            }
                            function calcularBreakfast(adult, child) {
                                if ($("#buffetYes").is(':checked')) {
                                    var priceBreakfast = $("#totalpriceBreakfast").html();
                                } else {
                                    var priceBreakfast = 0;
                                }
                                return priceBreakfast;
                            }
                            $('.buff').change(function () {
                                $('#buffet').dialog('close');
                                if ($("#buffetYes").is(':checked')) {
                                    $('#breakfastdato').text('SUPER BREKFAST BUFFET');
                                    $("#hotel_buffet").val(1);
                                    var child = $('#child').val();
                                    var adult = $('#adult').val();
                                    if (child == "") {
                                        child = 0;
                                    }
                                    if (adult == "") {
                                        adult = 0;
                                    }
                                    var fdadult = $("#fdadult").val();
//                                    var diasfree = $("#diasfree").val();
                                    
                                    var free_buffet = $("#free_buffet").val();
                                    var noches = $("#nights").val();
                                    var priceBreakfast = calcularBreakfast(adult, child);
                                    //(noches-nochesfree) cambio
//                                    if ((noches) == 0 && free_buffet == 1) {
//                                        var valorDesyuno = 0;
//                                    } else {
//                                        var valorDesyuno = priceBreakfast;
//                                    }
                                    var id_hotel = $('#hotel_id').val();

                                    var url = '<?php echo $data['rootUrl']; ?>admin/tours/activar/superbreakfast/' + id_hotel + '/1';
                                    $("#anonimo").load(url);
                                    $("#breakfastdato").attr('title', '$ ' + valorDesyuno);
                                }
                                calcularTotalPago();
                            });
                            function calcularTransportLocal(adult, child) {
                                var priceTransportLocal = $("#totalpriceTransporLocal").html();
                                if (priceTransportLocal == '') {
                                    priceTransportLocal = 0;
                                }
                                return priceTransportLocal
                            }
                            function calcularAdmision(adult, child) {
                                var priceAdmision = $("#totalpriceAdmision").html();
                                if (priceAdmision == '') {
                                    priceAdmision = 0;
                                }
                                return priceAdmision
                            }
                            function calcularTotal() {
                                var child = $('#child').val();
                                var adult = $('#adult').val();
                                if (child == "") {
                                    child = 0;
                                }
                                if (adult == "") {
                                    adult = 0;
                                }
                                var totalpax = (parseInt(adult) + parseInt(child));
                                if (totalpax > 0) {
                                    //Transporte 1
                                    if ($("#opcion_transfer_in").is(':checked')) {
                                        var priceTranspor1 = calcularTranspor1(adult, child);
                                        var priceExten1 = calcularExtencion1(adult, child);
                                        var totalTranspor1 = parseFloat(priceTranspor1) + parseFloat(priceExten1);
                                    } else {
                                        var totalTranspor1 = 0;
                                    }
                                    //Transporte 2
                                    if ($("#opcion_transfer_out").is(':checked')) {
                                        var priceTranspor2 = calcularTranspor2(adult, child);
                                        var priceExten2 = calcularExtencion2(adult, child);
                                        var totalTranspor2 = parseFloat(priceTranspor2) + parseFloat(priceExten2);
                                    } else {
                                        var totalTranspor2 = 0;
                                    }
                                    //Hotel
                                    if ($("#opcion_hotel").is(':checked')) {
                                        var priceHotel = calcularCostoHotel(adult, child);
                                        var priceBreakfast = calcularBreakfast(adult, child);
                                        var totalHotel = parseFloat(priceHotel) + parseFloat(priceBreakfast);
                                    } else {
                                        var totalHotel = 0;
                                    }
                                    //Park
                                    if ($("#opcion_traffic").is(':checked')) {
                                        var priceTransportLocal = calcularTransportLocal(adult, child);
                                        var priceAdmision = calcularAdmision(adult, child);
                                        var totalpark = parseFloat(priceTransportLocal) + parseFloat(priceAdmision);
                                    } else {
                                        var priceTransportLocal = 0;
                                        var priceAdmision = 0;
                                        var totalpark = 0;
                                    }
                                    var total = parseFloat(totalTranspor1) + parseFloat(totalTranspor2) + parseFloat(totalHotel) + parseFloat(totalpark);
                                    $("#price_transport1pp").text('$ ' + (totalTranspor1 / totalpax).toFixed(2));
                                    $("#price_transport2pp").text('$ ' + (totalTranspor2 / totalpax).toFixed(2));
                                    $("#park_transport").text('$ ' + (priceTransportLocal / totalpax).toFixed(2));
                                    $("#park_admision").text('$ ' + (priceAdmision / totalpax).toFixed(2));
                                    $("#amount_hotel").html('$ ' + (totalHotel / totalpax).toFixed(2));
                                    
                                    return total + 0/*comision()*/;
                                }
                                return 0;
                            }
                            function comision() {
                                var c_tours = '<?php echo $comsion_servis['003']; ?>';
                                var c_hotel = '<?php echo $comsion_servis['004']; ?>';
                                var c_atraction = '<?php echo $comsion_servis['005']; ?>';
                                var c_transport1 = $("#comisionTranspor1").html();
                                var c_transport2 = $("#comisionTranspor2").html();
                                var type_rate = $("#type_rate").val();
                                var id_agency = $("#id_agency").val();
                                if (id_agency == -1 || type_rate == 1) {
                                    return 0;
                                } else {
                                    var child = $('#child').val();
                                    var adult = $('#adult').val();
                                    if (child == "") {
                                        child = 0;
                                    }
                                    if (adult == "") {
                                        adult = 0;
                                    }
                                    //Transporte 1
                                    if ($("#opcion_transfer_in").is(':checked')) {
                                        var priceTranspor1 = calcularTranspor1(adult, child);
                                        var priceExten1 = calcularExtencion1(adult, child);
                                        var totalTranspor1 = parseFloat(priceTranspor1) + parseFloat(priceExten1);
                                    } else {
                                        var totalTranspor1 = 0;
                                    }
                                    //Transporte 2
                                    if ($("#opcion_transfer_out").is(':checked')) {
                                        var priceTranspor2 = calcularTranspor2(adult, child);
                                        var priceExten2 = calcularExtencion2(adult, child);
                                        var totalTranspor2 = parseFloat(priceTranspor2) + parseFloat(priceExten2);
                                    } else {
                                        var totalTranspor2 = 0;
                                    }

                                    //Hotel
                                    if ($("#opcion_hotel").is(':checked')) {
                                        var priceHotel = calcularCostoHotel(adult, child);
                                        var priceBreakfast = calcularBreakfast(adult, child);
                                        var totalHotel = parseFloat(priceHotel) + parseFloat(priceBreakfast);
                                    } else {
                                        var totalHotel = 0;
                                    }
                                    //Park
                                    if ($("#opcion_traffic").is(':checked')) {
                                        //	var priceTransportLocal = calcularTransportLocal(adult,child);
                                        var priceTransportLocal = 0;
                                        //var priceAdmision = calcularAdmision(adult,child);
                                        var priceAdmision = 0;
                                        var totalpark = parseFloat(priceTransportLocal) + parseFloat(priceAdmision);
                                    } else {
                                        var priceTransportLocal = 0;
                                        var priceAdmision = 0;
                                        var totalpark = 0;
                                    }
                                    if (($("#opcion_transfer_in").is(':checked')) && ($("#opcion_transfer_out").is(':checked')) && ($("#opcion_hotel").is(':checked')) && $("#opcion_traffic").is(':checked')) {
                                        var total = parseFloat(totalTranspor1) + parseFloat(totalTranspor2) + parseFloat(totalHotel) + parseFloat(totalpark);
                                        $("#comision").val(total * c_tours / 100);
                                        return (total * c_tours / 100);
                                    } else {
                                        var comi = (parseFloat(totalTranspor1 * c_transport1) + parseFloat(totalTranspor2 * c_transport2) + parseFloat(totalHotel * c_hotel) + parseFloat(totalpark * c_atraction)) / 100;
                                        $("#comision").val(comi);
                                        return comi;
                                    }
                                }
                            }
                            function calcularTotalPago() {
                                var total = calcularTotal();
                                var child = $('#child').val();
                                var adult = $('#adult').val();
                                if (child == "") {
                                    child = 0;
                                }
                                if (adult == "") {
                                    adult = 0;
                                }
                                var totalpax = (parseInt(adult) + parseInt(child));
                                //Calculamos comision
                                var comi = 0/*comision()*/;
                                var full = total;
                                var balance = full - comi;
                                var disponible = $("#disponible").val();
                                var agency = $("#id_agency").val();
                                var tipo_pago = 0;
                                var num = document.getElementsByName('opcion_pago').length
                                for (var i = 0; i < num; i++) {
                                    if (document.getElementsByName('opcion_pago').item(i).checked) {
                                        tipo_pago = document.getElementsByName('opcion_pago').item(i).value;
                                    }
                                }
                                var tipo_pago = $("#op_pago_id option:selected").val();

                                var tipo_saldo = $('#opcion_pago_saldo').val();
                                var apagar = full;
                                if (tipo_saldo == '2') {
                                    apagar = balance;
                                } else if (tipo_saldo == '1') {
                                    apagar = full;
                                }
                                var valor = apagar;
                                //VALOR EXTRA
                                var error = "";
                                error += validateNumber($("#extra").val(), 'Extra', true);
                                var extra = 0;
                                if (error == "") {
                                    extra = $("#extra").val();
                                }

                                //DESCUENTO DE %
                                error = "";
                                error += validateNumber($("#descuento").val(), 'Descuento', true);
                                var desc_porc = 0;
                                if (error == "") {
                                    porcentaje = $("#descuento").val();
                                    //Park--> Calculamos el valor para no tenerlo en cuenta al sacar el porcentaje
                                    if ($("#opcion_traffic").is(':checked')) {
                                        var priceAdmision = calcularAdmision(adult, child);
                                    } else {
                                        var priceAdmision = 0;
                                    }
                                    if (porcentaje > 100) {
                                        porcentaje = 100;
                                    }
                                    desc_porc = (porcentaje * (full - priceAdmision)) / 100;
                                }

                                //DESCUENTO DE $
                                error = "";
                                error += validateNumber($("#descuento_valor").val(), 'Descuento Valor', true);

                                var desc_valor = 0;
                                if (error == "") {
                                    desc_valor = $("#descuento_valor").val();
                                    if (desc_valor > valor) {
                                        desc_valor = valor;
                                    }
                                }
                                apagar = parseFloat(apagar) + parseFloat(extra) - parseFloat(desc_porc) - parseFloat(desc_valor);
                                valor = parseFloat(valor) + parseFloat(extra) - parseFloat(desc_porc) - parseFloat(desc_valor);

                                console.log(apagar);
                                var other = parseFloat($("#otheramount").val());

                                if (other > 0) {
                                    var fee = other * 0.04;
                                    apagar = other;
                                } else {
                                    var fee = apagar * 0.04;
                                }
                                //var fee = apagar*0.03;
                                var totalPax = parseFloat(child) + parseFloat(adult);
                                $("#valorComision").text(comi.toFixed(2))
                                //Calculamos total segun el tipo de pago
                                if (tipo_pago == 5) {
                                    if (disponible - apagar < 0) {//Validamos saldo disponible
                                        /*alert('Your available credit is less than the total amount to be paid');
                                         $("#opcion_pago").attr("checked",false);
                                         $("#opcion_saldo1").attr('checked',false);
                                         $("#opcion_saldo2").attr('checked',false);
                                         $("#opcion_saldo2").attr('disabled',false);
                                         $("#opcion_saldo1").attr('disabled',false);*/
                                        $("#opcion_saldo2").attr('checked', true);
                                        $("#opcion_saldo1").attr('disabled', true);
                                        $("#opcion_saldo2").attr('disabled', false);
                                        $("#opcion_pago_saldo").val('2');
                                    } else {
                                        $("#opcion_saldo2").attr('checked', true);
                                        $("#opcion_saldo1").attr('disabled', true);
                                        $("#opcion_saldo2").attr('disabled', false);
                                        $("#opcion_pago_saldo").val('2');
                                    }
                                } else if (tipo_pago == 1) {
                        //        $("#opcion_saldo2").attr('checked',true);
                        //        $("#opcion_saldo1").attr('disabled',true);
                        //        $("#opcion_saldo2").attr('disabled',false);
                        //        $("#opcion_pago_saldo").val('2');
                                    apagar = parseFloat(apagar) + parseFloat(fee);
                                    valor = parseFloat(valor) + parseFloat(fee);
                                } else {
                                    $("#opcion_saldo2").attr('disabled', false);
                                    $("#opcion_saldo1").attr('disabled', false);
                        //        if(tipo_pago==3){
                        //            apagar = apagar + fee;
                        //            console.log('.....');
                        //        }
                                }
                                if (tipo_pago == 3) {
                                    apagar = parseFloat(apagar) + parseFloat(fee);
                                    valor = parseFloat(valor) + parseFloat(fee);
                                }
                                //alert(apagar);
                                //Guardar O  Pagar
                                if (tipo_pago == 1 || tipo_pago == 2) {
                                    $('#enviarF').css('display', 'block');
                        //        $('#btn-save1').css('display','none');
                        //        $('#btn-save2').css('display','none');
                                } else {
                                    $('#enviarF').css('display', 'none');
                                    $('#btn-save1').css('display', 'block');
                                    $('#btn-save2').css('display', 'block');
                                }
                                console.log(apagar);
                                setTotalPagar(valor, apagar);
                            }
                            function setTotalPagar(total, apagar) {

                                var other = parseInt($("#otheramount").val());
                                $("#totalAmount").text('$ ' + (total).toFixed(2));
                        //    if(other > 0){
                        //        apagar = parseFloat(other);
                        //    }

                                console.log('----' + apagar);
                                $("#saldoporpagar").text('$ ' + (apagar).toFixed(2));
                                var pay_amount = parseFloat($("#pay_amount").val());
                                if (isNaN(pay_amount)) {
                                    pay_amount = 0;
                                }
                                var final_p = apagar - pay_amount;
                                $("#saldoactual").text('$ ' + (final_p).toFixed(2));
                            }
                            $('#opcion_saldo1, #opcion_saldo2').change(function () {
                                if ($(this).get(0).id == 'opcion_saldo1') {
                                    $('#opcion_pago_saldo').val('1');
                                } else if ($(this).get(0).id == 'opcion_saldo2') {
                                    $('#opcion_pago_saldo').val('2');
                                }
                                calcularTotalPago();
                            });
                            function valorExtra() {
                                calcularTotalPago();
                            }
                            function valorDescuentoPorec() {
                                calcularTotalPago();
                            }
                            function valorDescuentoValor() {
                                calcularTotalPago();
                            }
                            $('#opcion_pago_passager, #opcion_pago_agency, #opcion_pago_predpaid_cash,#opcion_pago_complementary,#opcion_pago_CrediFee, #opcion_pago_Cash,#opcion_pago_Voucher').change(function (e) {
                                calcularTotalPago();
                            });
                            function validarTransfer_in() {
                                if ($("#opcion_transfer_in").is(':checked')) {
                                    if ($("#a_bus").is(':checked')) {//BUS
                                        var fecha_salida = trim($('#fecha_salida').val());
                                        if (!Validar(fecha_salida)) {
                                            msj = '- Incorrect tours start date.';
                                            titulo = 'START DATE';
                                            mensaje(msj, titulo, 'fecha_salida');
                                            return false;
                                        }

                                        var trip1 = trim($('#a_trip_no').val());
                                        if (trip1 == '') {
                                            msj = '- Select the trip arrival.';
                                            titulo = 'ARRIVAL TRIP';
                                            mensaje(msj, titulo, 'a_trip_no');
                                            return false;
                                        }
                                        var ext_from1 = trim($("#ext_from1").val());
                                        var a_id_pickup1 = trim($("#a_id_pickup1").val());
                                        var a_pickup2 = trim($("#a_pickup2").val());
                                        if (ext_from1 != '' && ext_from1 != 0) {
                                            if (a_pickup2 == '') {
                                                msj = '- Enter the extension pick up point.';
                                                titulo = 'PickUp - Extension';
                                                mensaje(msj, titulo, 'ext_from1');
                                                return false;
                                            }
                                        } else if (a_id_pickup1 == -1 || a_id_pickup1 == 0 || a_id_pickup1 == '') {
                                            msj = '- Enter the pick up.';
                                            titulo = 'PickUp - Maimi';
                                            mensaje(msj, titulo, 'a_pickup1');
                                            return false;
                                        }
                                    } else if ($("#a_vip").is(':checked')) {//VIP
                                        var hora1 = trim($("#hora1").val());
                                        if (hora1 == '') {
                                            msj = '- Enter the time of private service in Miami.';
                                            titulo = 'Time your private service in Miami';
                                            mensaje(msj, titulo, 'hora1');
                                            return false;
                                        }
                                        var city = trim($("#city").val());
                                        if (city == '') {
                                            msj = '- Enter the city of private service in Miami.';
                                            titulo = 'City your private service in Miami';
                                            mensaje(msj, titulo, 'city');
                                            return false;
                                        }
                                        var address = trim($("#address").val());
                                        if (address == '') {
                                            msj = '- Enter the address of private service in Miami.';
                                            titulo = 'Address your private service';
                                            mensaje(msj, titulo, 'address');
                                            return false;
                                        }
                                        var zipcode = trim($("#zipcode").val());
                                        if (zipcode == '') {
                                            msj = '- Enter the zipcode of private service in Miami.';
                                            titulo = 'Zipcode  your private service';
                                            mensaje(msj, titulo, 'zipcode');
                                            return false;
                                        }
                                        var phone = trim($("#phone").val());
                                        if (phone == '') {
                                            msj = '- Enter the phone of private service in Miami.';
                                            titulo = 'Phone  your private service';
                                            mensaje(msj, titulo, 'phone');
                                            return false;
                                        }
                                    } else if ($("#a_airpoty").is(':checked')) {//AIRPORT
                                        var airlinearrival = trim($("#airlinearrival").val());
                                        if (airlinearrival == '') {
                                            msj = '- Enter Airline of arrival at orlando.';
                                            titulo = 'Airline arrival orlando';
                                            mensaje(msj, titulo, 'airlinearrival');
                                            return false;
                                        }
                                        var flightarrival = trim($("#flightarrival").val());
                                        if (flightarrival == '') {
                                            msj = '- Enter the airline flight arrival to horlando.';
                                            titulo = 'Flight arrival orlando';
                                            mensaje(msj, titulo, 'flightarrival');
                                            return false;
                                        }
                                        var hora1 = trim($("#hora1").val());
                                        if (hora1 == '') {
                                            msj = '- Enter the time of arrival in orlando.';
                                            titulo = 'Time  arrival orlando';
                                            mensaje(msj, titulo, 'hora1');
                                            return false;
                                        }
                                    } else if ($("#a_car").is(':checked')) {//BY CAR
                                        var hora1 = trim($("#hora1").val());
                                        if (hora1 == '') {
                                            msj = '- Enter the time of arrival in orlando.';
                                            titulo = 'Time  arrival orlando';
                                            mensaje(msj, titulo, 'hora1');
                                            return false;
                                        }
                                    }
                                }
                                return true;
                            }
                            function validarTransfer_out() {
                                if ($("#opcion_transfer_out").is(':checked')) {
                                    if ($("#d_bus").is(':checked')) {//BUS
                                        var fecha_retorno = trim($('#fecha_retorno').val());
                        //            if(!Validar(fecha_retorno)){
                        //                msj = '- Incorrect final date of the tour.';
                        //                titulo = 'END DATE';
                        //                mensaje(msj,titulo,'fecha_retorno');
                        //                return false;
                        //            }
                                        var trip2 = trim($('#d_trip_no').val());
                                        if (trip2 == '') {
                                            msj = '- Select the trip departure.';
                                            titulo = 'DEPARTURE TRIP';
                                            mensaje(msj, titulo, 'd_trip_no');
                                            return false;
                                        }
                                        var ext_to2 = trim($("#ext_to2").val());
                                        var d_id_pickup1 = trim($("#d_id_pickup1").val());
                                        var d_pickup2 = trim($("#d_pickup2").val());
                                        if (ext_to2 != '' && ext_to2 != 0) {
                                            if (d_pickup2 == '') {
                                                msj = '- Enter the extension pick up point.';
                                                titulo = 'PickUp - Extension';
                                                mensaje(msj, titulo, 'd_pickup2');
                                                return false;
                                            }
                                        } else if (d_id_pickup1 == -1 || d_id_pickup1 == 0 || d_id_pickup1 == '') {
                                            msj = '- Enter the pick up.';
                                            titulo = 'PickUp - Maimi';
                                            mensaje(msj, titulo, 'd_pickup1');
                                            return false;
                                        }
                                    } else if ($("#d_vip").is(':checked')) {//VIP
                                        var hora2 = trim($("#hora2").val());
                                        if (hora2 == '') {
                                            msj = '- Enter the time of private service in Orlando.';
                                            titulo = 'Time your private service in Miami';
                                            mensaje(msj, titulo, 'hora2');
                                            return false;
                                        }
                                        var city2 = trim($("#city2").val());
                                        if (city2 == '') {
                                            msj = '- Enter the city of private service in Orlando.';
                                            titulo = 'City your private service in Orlando';
                                            mensaje(msj, titulo, 'city2');
                                            return false;
                                        }
                                        var address2 = trim($("#address2").val());
                                        if (address2 == '') {
                                            msj = '- Enter the address of private service in Orlando.';
                                            titulo = 'Address your private service';
                                            mensaje(msj, titulo, 'address2');
                                            return false;
                                        }
                                        var zipcode2 = trim($("#zipcode2").val());
                                        if (zipcode2 == '') {
                                            msj = '- Enter the zipcode of private service in Orlando.';
                                            titulo = 'Zipcode  your private service';
                                            mensaje(msj, titulo, 'zipcode2');
                                            return false;
                                        }
                                        var phone2 = trim($("#phone2").val());
                                        if (phone2 == '') {
                                            msj = '- Enter the phone of private service in Orlando.';
                                            titulo = 'Phone  your private service';
                                            mensaje(msj, titulo, 'phone2');
                                            return false;
                                        }
                                    } else if ($("#d_airpoty").is(':checked')) {//AIRPORT
                                        var airlinearrival = trim($("#airlinedeparture").val());
                                        if (airlinearrival == '') {
                                            msj = '- Enter Airline of departure in  orlando.';
                                            titulo = 'Airline arrival orlando';
                                            mensaje(msj, titulo, 'airlinedeparture');
                                            return false;
                                        }
                                        var flightdeparture = trim($("#flightdeparture").val());
                                        if (flightdeparture == '') {
                                            msj = '- Enter the airline flight departure in orlando.';
                                            titulo = 'Flight departure orlando';
                                            mensaje(msj, titulo, 'flightdeparture');
                                            return false;
                                        }
                                        var hora2 = trim($("#hora2").val());
                                        if (hora2 == '') {
                                            msj = '- Enter the time of departure in orlando.';
                                            titulo = 'Time  departure orlando';
                                            mensaje(msj, titulo, 'hora2');
                                            return false;
                                        }
                                    } else if ($("#d_car").is(':checked')) {//BY CAR
                                        //Nada
                                        var hora2 = trim($("#hora2").val());
                                        if (hora2 == '') {
                                            msj = '- Enter the time of arrival in orlando.';
                                            titulo = 'Time  arrival orlando';
                                            mensaje(msj, titulo, 'hora2');
                                            return false;
                                        }
                                    }
                                }
                                return true;                                                      
                                
                                
                            }
                            function validarHotel() {
                                if ($("#opcion_hotel").is(':checked')) {
                                    var fecha_salida = trim($('#fecha_salida').val());
                                    if (!Validar(fecha_salida)) {
                                        msj = '- Incorrect tours start date.';
                                        titulo = 'START DATE';
                                        mensaje(msj, titulo, 'fecha_salida');
                                        return false;
                                    }
                                    var fecha_retorno = trim($('#fecha_retorno').val());
                        //        if(!Validar(fecha_retorno)){
                        //            msj = '- Incorrect final date of the tour.';
                        //            titulo = 'END DATE';
                        //            mensaje(msj,titulo,'fecha_retorno');
                        //            return false;
                        //        }
                                    var hotel_id_select = $("#hotel_id_select").val();

                                    if (hotel_id_select == -1 || hotel_id_select == undefined) {
                                        msj = '- Select hotel accommodation during the tour.';
                                        titulo = 'Select Hotel';
                                        mensaje(msj, titulo, 'hotel_name');
                                        return false;
                                    }
                                }
                                return true;
                            }
                            function validarPark() {
                                if ($("#opcion_traffic").is(':checked')) {
                                    var fecha_salida = trim($('#fecha_salida').val());
                                    if (!Validar(fecha_salida)) {
                                        msj = '- Incorrect tours start date.';
                                        titulo = 'START DATE';
                                        mensaje(msj, titulo, 'fecha_salida');
                                        return false;
                                    }
                                    var fecha_retorno = trim($('#fecha_retorno').val());
                        //        if(!Validar(fecha_retorno)){
                        //            msj = '- Incorrect final date of the tour.';
                        //            titulo = 'END DATE';
                        //            mensaje(msj,titulo,'fecha_retorno');
                        //            return false;
                        //        }
                                    var numPark = $("#numPark").val();
                                    if (numPark == 0) {
                                        msj = '- Select the park you want to visit on the tour.';
                                        titulo = 'Select parks';
                                        mensaje(msj, titulo, 'park_name');
                                        return false;
                                    }
                                }
                                return true;
                            }
                            function validarSeleccionServicio() {
                                if (!$("#opcion_transfer_in").is(':checked') && !$("#opcion_transfer_out").is(':checked')
                                        && !$("#opcion_hotel").is(':checked') && !$("#opcion_traffic").is(':checked')) {
                                    msj = '- You must select at least one service to sell.';
                                    titulo = 'Select service';
                                    mensaje(msj, titulo, 'opcion_transfer_in');
                                    return false;
                                }
                                return true;
                            }
                            function validarSeleccionTipoPago() {
                                var tipo_pago = 0;
                                var num = document.getElementsByName('opcion_pago').length
                                for (var i = 0; i < num; i++) {
                                    if (document.getElementsByName('opcion_pago').item(i).checked) {
                                        tipo_pago = document.getElementsByName('opcion_pago').item(i).value;
                                    }
                                }
                                if (tipo_pago == 0) {
                                    msj = '- Select the payment method.';
                        //        titulo = 'Payment method ';
                        //        mensaje(msj,titulo,'opcion_pago');
                        //        return false;
                                }
                                var id_agency = $("#id_agency").val();
                                if (id_agency != -1) {
                                    if (!$("#opcion_saldo1").is(':checked') && !$("#opcion_saldo2").is(':checked')) {
                                        msj = '- Select the payment option (FULL / BALANCE).';
                                        titulo = 'Payment option ';
                                        mensaje(msj, titulo, 'uagency');
                                        return false;
                                    }
                                }
                                return true;
                            }
                            function validarFormulario() {
                                //Cliente
                                var msj = '';
                                var titulo = '';
                                var idcliente = $("#idCliente").val();
                                if (idcliente == '-1' && ($("#firstname1").val() == '' && $("#lastname1").val() == '')) {
                                    msj = '- Enter customer data.';
                                    titulo = 'SEARCH CLIENT';
                                    mensaje(msj, titulo, 'cliente');
                                    return false;
                                }
                                //Agencia
                                var id_agency = $("#id_agency").val();
                                if (id_agency == -1) {

                                    var id_auser = $("#id_auser").val();
                        //        if(trim($("#uagency").val()) == ''){
                                    msj = '- Enter data agency.';
                                    titulo = 'EMPLOY ';
                                    mensaje(msj, titulo, 'agency');
                                    return false;
                        //        }
                                }

                                //Transfer in
                                if (!validarTransfer_in()) {
                                    return false;
                                }

                                //Transfer out
                                if (!validarTransfer_out()) {
                                    return false;
                                }

                                //Hotel
                                if (!validarHotel()) {
                                    return false;
                                }

                                //Park
                                if (!validarPark()) {
                                    return false;
                                }

                                //servicios
                                if (!validarSeleccionServicio()) {
                                    return false;
                                }

                                //Tipo Pago
                                if (!validarSeleccionTipoPago()) {
                                    return false;
                                }
                                return true;
                            }

                            $("#btn-save2").click(function (e) {

                                if (validarFormulario()) {
                                    if ($("#a_bus").is(':checked')) {
                                        $("#trip1a").val($("#priceTransporA1").html());
                                        $("#trip1c").val($("#priceTransporC1").html());
                                    }
                                    if ($("#d_bus").is(':checked')) {
                                        $("#trip2a").val($("#priceTransporA2").html());
                                        $("#trip2c").val($("#priceTransporC2").html());
                                    }
                                    $("#content").css("display", "none");
                                    $("#form1").attr('target', '_parent');
                                    $("#form1").attr('action', '<?php echo $data['rootUrl']; ?>admin/tours/save');
                                    bPreguntar = false;
                                    $("#form1").submit();
                                }
                            });

                            $("#descuento, #descuento_valor, #extra, #otheramount").change(function (e) {
                                calcularTotalPago();
                            });

                            $("#descuento, #descuento_valor, #extra, #otheramount").focusout(function (e) {
                                calcularTotalPago();
                            });

                            $("#enviarF").click(function (e) {
                                if (validarFormulario()) {
                                    $("#form1").attr('target', '_blank');
                                    $("#form1").attr('action', '<?php echo $data['rootUrl']; ?>admin/tours/payment');
                                    if ($("#a_bus").is(':checked')) {
                                        $("#trip1a").val($("#priceTransporA1").html());
                                        $("#trip1c").val($("#priceTransporC1").html());
                                    }
                                    if ($("#d_bus").is(':checked')) {
                                        $("#trip2a").val($("#priceTransporA2").html());
                                        $("#trip2c").val($("#priceTransporC2").html());
                                    }

                                    var hilo = setInterval("estadoPago()", 5000);
                                    $("#form1").submit();
                                }
                            });

                            $("#btn-cancel").click(function () {
                                window.location = '<?php echo $data['rootUrl']; ?>admin/tours';
                            });

                            function estadoPago() {
                                console.log('thread init');
                                $("#estadoTranssacion").load('<?php echo $data['rootUrl']; ?>transaction/admin/tours/payment');
                            }
                        </script>
                        <script>
                            $(function () {
                                $("#opcion_pago_predpaid_cash").click(function () {
                                    $("#btn-save2").show();
                                    $("#enviarF").hide();
                                    $("#pay_amount_html").hide();
                                });
                                $("#opcion_pago_CrediFee").click(function () {
                                    $("#btn-save2").show();
                                    $("#enviarF").hide();
                                    //#new
                                    $("#pay_amount_html").show();
                                });
                                $("#opcion_pago_agency").click(function () {
                                    $("#btn-save2").show();
                                    $("#enviarF").hide();
                                    //#new
                                    $("#pay_amount_html").show();
                                });
                                $("#opcion_pago_Cash, #opcion_pago_Voucher").click(function () {
                                    $("#btn-save2").show();
                                    $("#enviarF").hide();
                                    $("#pay_amount_html").hide();
                                });
                                $("#opcion_pago_passager").click(function () {
                        //        $("#btn-save2").hide();
                                    $("#enviarF").show();
                                    $("#pay_amount_html").show();
                                });
                                $("#agency").keyup(function () {
                                    if ($(this).val() == "") {
                                        $("#uagency").attr('disabled', true);
                                        $("#id_agency").val(-1);
                                        $("#tableTypeSaldo").hide();
                                        $("#opcion_pago_agency, #label_tipo_agency").parent().hide();
                                    } else {
                                        $("#opcion_pago_agency, #label_tipo_agency").parent().show();
                                    }
                                });
                                $("#opcion_pago_agency").change(function () {
                                    calcularTotalPago();
                                });
                            });
                        </script>
<script>
         
     function combo()
        {     
                
           $(document).ready(function() {
            // Así accedemos al Texto de la opción seleccionada
            var valor = $("#rate option:selected").html();
            //alert(valor);
            
            tour_name.value= valor;
                                                  
            });
            
        }  
</script>
<style>
    #centrar{
        margin-left: auto;
        margin-right: auto ;
    }
    #voucher_code{
        float: left;
    }		
    #peso{
        float: left;
    }
    #diass{
        width:auto;
    }
    p {  cursor:pointer; }	
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
/*        border: 1px #dadada solid;*/
    }
    #checkboxes label {
        display: block;
        background-color: transparent;
    }
    #checkboxes label:hover {
/*        background-color: #1e90ff;*/
/*        background-color: transparent;*/
    }
</style>

<?php 
$agency = $data['agency'];
$id_agencia = $agency['id'];
$fecha_hoy1 = date('Y-m-d');
$fecha_hoy = date('M-d-Y', strtotime($fecha_hoy1));

$sql = "SELECT acount FROM agency_account ORDER BY id DESC LIMIT 1";
$rs = Doo::db()->query($sql);
$resultado = $rs->fetchAll();

foreach ($resultado as $result) {
    $acount = $result['acount'];
}

if($acount == 0){
    $codigo = 19000;
}else{
    $codigo = $acount + 1;
}
//$mes = date("m");
//$dia = date("d");
//$y = date("y");
//$codigo =  rand(1, 9).rand(0, 9). rand(0, 9). rand(0, 9). rand(0, 9);
//$cod = '000';


?> 


<form id="form1" class="form" action="<?php echo $data['rootUrl']; ?>admin/agency/save" method="post" name="form1">
    
    <div id="header_page"  style="height: 128px; background-color: #FFFFFF;">
        <img style= "width: 165px; height: 62px; margin-left: -543px; margin-top: 3px;" src="<?php echo $data['rootUrl']; ?>global/img/agency.png" />
<!--        <img style= "width: 165px; height: 62px; margin-left: -543px; margin-top: 3px;" src="<?php echo $data['rootUrl']; ?>global/img/aurelia.svg" />-->
        <div class="header2">        
            <fieldset  id="" style="height:107px; margin-top: -11px; margin-left: 82px; background-color: #FFFFFF; border-color: #FFFFFF;"><legend style="font-size:22px; color:#666666; padding-top: 10px; font-weight:bold;">Agency: <?php echo ucwords(strtolower($agency['company_name'])); ?> <span id="est_agency"> <?php echo ucwords(strtolower($data['dato'])); ?> </span></legend><div>
                <label style="margin-left:3px; margin-top:123px; color:#666666; font-size:18px;" class="required" id="ntn">Tour Name </label><label style="font-size:18px; margin-left:275px; margin-top:164px; color: #666666;" class="required" id="nspn">Special Price Name </label>
                <br>
                <input  type="text" readonly="true" style="width:318px; color: #ffffff; font-weight:bold; background: #e63244; margin-left: 5px; margin-top: -10px; height: 17px;" id="tour_name" name="tour_name" value="<?php echo $agency['tour_name']; ?>"  />        
                <input type="text" readonly="true" style="margin-left:366px; margin-top:-21px; width:318px; color: #ffffff; background: #5a5a5a; font-weight:bold; height: 17px;" name="special_price" id="special_price" value="<?php echo $agency['special_price_name']; ?>" />
            </fieldset>
        </div> 
        
        <div  id="toolbar">

            <div class="toolbar-list">
                <ul>

                    <li style="margin-left:-56px; margin-top:40px;" class="btn-toolbar" id="btn-save">
                        <a   class="link-button" id="btn-save">
                            <span class="icon-32-save" title="Nuevo" >&nbsp;</span>
                            Save
                        </a>
                    </li>

                    <li style="margin-right:18px; margin-top:40px;"  class="btn-toolbar" id="btn-cancel">
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

            <fieldset  id="acompany" style="height: 414px; background-color: #F3F3F5;"><legend><strong>COMPANY</strong></legend><div class="input">
                    
                    <label style="width:150px; color:black; font-size:12px;" id="lreq">Required (<span style="color:red; font-size:12px; font-weight:bold;">*</spam><span style="color:black; font-size:12px;">)</spam></label>
                    <br>
                    <br>
                    
                    <label style="width:150px; font-weight:bold; color:#000000; margin-top:-4px;" class="required" id="company_namee">Company Name <span style="color:red; font-size:14px; font-weight:bold;">*</spam></label>
                    <br>
                    <input type="text" name="company_name" id="company_name"  size="60"  style="margin-left: -150px;" value="<?php echo $agency['company_name']; ?>"/>
                </div>
                <div class="input">
                    <label style="width:150px; font-weight:bold; color:#000000; margin-top:-4px;" class="required" id="addresss">Address <span style="color:red; font-size:14px; font-weight:bold;">*</spam></label>
                    <br>
                    <input type="text" name="address" id="address"  size="60" style="margin-left: -150px;"  value="<?php echo $agency['address']; ?>"/>
                </div>
                <div class="input">
                    <label style="width:150px; margin-top:-2px;" id="addresss">Address 2 </label>
                    <br>
                    <input type="text" name="address2" id="address2"  size="60"  style="margin-left: -150px;"  value="<?php echo $agency['address2']; ?>"/>
                </div>
                <div class="input">
                    <label style="width:150px; font-weight:bold; color:#000000; margin-top:-4px;" class="required" id="cityy">City <span style="color:red; font-size:14px; font-weight:bold;">*</spam></label><label style="width:152px; margin-left:95px; font-weight:bold; color:#000000; margin-top:-4px;" class="required" id="statee">State <span id="state_zip" style="color:red; font-size:14px; font-weight:bold;">*</spam></label>
                    <br>
                    <input type="text" name="city" id="city"  size="30"  style="margin-left: -396px; margin-top: 6px; width:235px;"  value="<?php echo $agency['city']; ?>"/>
                    
                    
                    <select name="state" id="state" class="select" style="width:205px; height:23px; margin-left: 5px; color:#000000;">
                        <option value=""></option>  
                        <?php foreach ($data["state"] as $e) { ?>
                            <option value="<?php echo $e['abb']; ?>"  <?php echo ($agency['state'] == trim($e['abb']) ? 'selected' : ''); ?>><?php echo $e["name"]; ?></option>
                        <?php } ?>
                    </select>
                </div>
<!--                <div class="input" style="padding-top:5px;">
                    
                </div>-->

                <div class="input">
                    <label style="width:150px; font-weight:bold; color:#000000; margin-top:-4px;" class="required" id="zip_codee">Zip Code <span id= "ast_zip" style="color:red; font-size:14px; font-weight:bold;">*</spam></label><label style="width:152px; margin-left:95px; font-weight:bold; color:#000000; margin-top:-4px;" class="required" id="l_phone">Country <span style="color:red; font-size:14px; font-weight:bold;">*</spam></label>
                    <br>
                    <input name="zipcode" type="text"  id="zipcode" size="15"  style="margin-left: -396px;" value="<?php echo $agency['zipcode']; ?>" />
                    <select name="country" id="country" class="select" style="text-align:left; width:205px; height:23px; margin-left: 106px; color:#000000;" onchange="change_country();">
                        <option value=""></option>  
                        <?php foreach ($data["country"] as $e): ?>

                            <option value="<?php echo $e['name']; ?>"  <?php echo ($agency['country'] == trim($e['name']) ? 'selected' : ''); ?>><?php echo $e["name"]; ?></option>
                        <?php endforeach; ?>
                    </select>
                
                </div>

<!--                <div class="input" style="padding-top:5px;">
                    <label style="width:152px;" class="required" id="l_phone">Country: </label>
                    
                </div>-->
<!--                <div class="input">
                    <label style="width:150px" class="required" id="positionn">Position: </label>
                    <input name="position" type="text"  id="position" size="20"   value="<?php /*echo $agency['position'];*/ ?>" />
                </div>             -->
                <div class="input">
                    <label style="width:150px; font-weight:bold; color:#000000; margin-top:-4px;" class="required" id="phone11">Phone 1 <span style="color:red; font-size:14px; font-weight:bold;">*</spam></label> <label style="width:150px; margin-left:4px; margin-top:-2px;" class="" id="phone22">Phone 2 </label> <label style="width:150px; margin-left:4px; margin-top:-2px;" class="" id="faxx">Fax </label>
                    <br>
                    <input name="phone1" type="text"  id="phone1" size="15"  style="margin-left: -457px; width: 143px;" value="<?php echo $agency['phone1']; ?>" />
                    <input name="phone2" type="text"  id="phone2" size="15"  style="margin-left: 5px; width: 143px;" value="<?php echo $agency['phone2']; ?>" />
                    <input name="fax" type="text"  id="fax" size="15"  style="margin-left: 5px; width: 143px;" value="<?php echo $agency['fax']; ?>" />
                </div> 
<!--                <div class="input">
                    
                    
                </div> -->

                <div class="input">
                    <label style="width:150px; margin-left:1px; font-weight:bold; color:#000000; margin-top:-4px;" class="required" id="main_emaill">E-Mail <span style="color:red; font-size:16px; font-weight:bold;">*</spam></label> <label style="width:150px;  margin-left:93px; margin-top:-2px;" class="" id="web_pagee">Web Page </label>
                    <br>
                    
                    <input  name="main_email"  type="text"  id="main_email" size="30"  style="margin-left: -393px;" value="<?php echo $agency['main_email']; ?>" />
                    <input name="web_page" type="text" id="web_page" size="25"  style="margin-left: 1px;" value="<?php echo $agency['web_page']; ?>" />
                </div> 

<!--                <div class="input">                                       
                    
                </div> -->

<!--                <div class="input">
                    
                    
                </div> -->
<!--                <div class="input">
                    <label style="width:150px" class="" id="iata_cliaa">IATA/CLIA#: </label>
                    <input name="iata_clia" type="text"  id="iata_clia" size="25"  value="<?php /*echo $agency['iata_clia'];*/ ?>" />
                </div> -->
                <div class="input">
                    <label style="width:150px; margin-top:-2px;" class="required" id="managerr">Manager </label>
                    <br>
                    <input name="manager" type="text"  id="manager" size="60" style="margin-left: -149px;" value="<?php echo $agency['manager']; ?>" />
                </div> 
<!--                <div class="input">
                    <label style="width:150px" class="" id="iata_cliaa">Birthdate: </label>
                    <input name="birthdate" type="text"  id="birthdate" size="10" maxlength="10" value="<?php echo $agency['birthdate']; ?>"/>
                </div> -->
                </fieldset>
            <fieldset style="background-color: #F3F3F5;"><legend><strong>ACCOUNTING</strong></legend>

                <div class="input">
                    <label style="width:150px; margin-left:-6px; color:#000000; margin-top: 9px;" class="required" id="acountt">Account</label><label style="width:150px; margin-left:66px; color:#000000; margin-top: 9px;" class="required" id="costumer_sincee">Costumer Since</label>
                    <br>
                    <input name="acount" type="text"  id="acount" size="25" readonly="readonly" style="margin-left:-366px; margin-top:16px;"   value="<?php echo $agency['acount']; ?>" />
                    <input name="customer_since" type="text"  id="customer_since" readonly="readonly" size="25" style="margin-left:6px; margin-top:16px;"  value="<?php echo $agency['customer_since']; ?>" />              
                                 
                </div>

            </fieldset>

            <fieldset style="background-color: #F3F3F5;"><legend><strong>CUSTOMER ACCOUNTING DEPARTMENT</strong></legend>
                <div class="input">
                    <label style="width:150px; margin-left:-4px; color:#000000; margin-top:0px;" class="" id="person_chargee">Person in Charge</label>
                    <br>
                    <input name="person_charge" type="text"  id="person_charge" size="55"  style="margin-left:-152px; margin-top:11px; width:419px;" value="<?php echo $agency['person_charge']; ?>" />
                </div>
                <div class="input">
                    <label style="width:150px; margin-left:-6px; color:#000000; margin-top:0px;" class="" id="eemaill">E-mail</label><label style="width:150px; margin-left:100px; color:#000000; margin-top:0px;" class="" id="phonee">Phone</label>
                    <br>
                    <input name="eemail" type="text"  id="eemail" size="30"  style="margin-left:-400px; margin-top:11px;" value="<?php echo $agency['eemail']; ?>" />
                    <input name="phone" type="text"  id="phone" size="20" style="margin-left:4px; margin-top:11px; width:171px;" value="<?php echo $agency['phone']; ?>"/>
                </div>
<!--                <div class="input">
                    
                    
                    
                    
                </div>-->
                <!--  <div class="input">
                     <label style="width:150px" class="required" id="phonee">Net Days: </label>
                     <input name="netdays" type="text"  id="netdays" size="5" maxlength="10" value=""/>
                 </div> -->
            </fieldset>

            <fieldset style="height:307px; margin-top:2px; background-color: #F3F3F5;"><legend><strong>PAYMENT AUTHORAIZED</strong></legend>
                <fieldset style="background-color:#FFFFFF; width: 401px;"><legend> <font color="#999999">PRED-PAID</font></legend>
                    <table width="200" border="0" cellspacing="1">
                        <tr>
                            <td colspan="2"></td>
                        </tr>
                        <tr>
                            <td width="23"><input type="checkbox" name="opcion1" id="opcion1" value="1" <?php echo ($agency['opcion1'] == 1 ? 'checked' : ''); ?> /></td>
                            <td width="164">Credit Card</td>
                        </tr>
                       <!-- <tr>
                          <td><input type="checkbox" name="opcion2" id="opcion2" value="1" <?  echo ($agency['opcion2'] == 1?'checked':''); ?>/></td>
                          <td>Direct Bank Deposit</td>
                        </tr>
                        -->
                        <tr>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                        </tr>
                    </table>

                </fieldset>
                <fieldset style="background-color:#FFFFFF; width: 401px; margin-top: 20px;"><legend> <font color="#999999">COLLECT ON BOARD</font></legend>
                    <table width="200" border="0" cellspacing="1">
                        <tr>
                            <td colspan="2"></td>
                        </tr>
                        <tr>
                            <td width="23"><input type="checkbox" name="opcion3" id="opcion3" value="1" <?php echo ($agency['opcion3'] == 1 ? 'checked' : ''); ?>/></td>
                            <td width="164">Credit Car+ 4 % FEE</td>
                        </tr>
                        <tr>
                            <td><input type="checkbox" name="opcion4" id="opcion4" value="1" <?php echo ($agency['opcion4'] == 1 ? 'checked' : ''); ?>/></td>
                            <td>Cash</td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                        </tr>
                    </table>

                </fieldset>
                <fieldset style="background-color:#FFFFFF; width: 401px; margin-top: 16px;"><legend> <font color="#999999">VOUCHER<input  <?php echo ((($agency['opcion5'] == 1) || ($agency['opcion5'] == 2)) ? "checked=\"checked\"" : ''); ?> type="checkbox" name="active_vaucher" id="active_vaucher" value="1" /></font></legend>
                    <table width="200" border="0" cellspacing="1">
                        <tr>
                            <td colspan="2"></td>
                        </tr>
                        <tr>
                            <td width="23"><input type="radio" name="opcion5" id="opcion5" value="1" <?php echo ((($agency['opcion5'] != 1) && ($agency['opcion5'] != 2)) ? "disabled=\"disabled\"" : ''); ?> <?php echo ($agency['opcion5'] == 1 ? 'checked' : ''); ?>/></td>
                            <td width="164">Open Credit Voucher</td>
                        </tr>
                        <tr>
                            <td><input type="radio" name="opcion5" id="opcion6" value="2" <?php echo ((($agency['opcion5'] != 1) && ($agency['opcion5'] != 2)) ? "disabled=\"disabled\"" : ''); ?>  <?php echo ($agency['opcion5'] == 2 ? 'checked' : ''); ?>/></td>
                            <td>Limit Credit Voucher</td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                        </tr>
                    </table>

                </fieldset>
            </fieldset>            
            </fieldset>
            <fieldset id="rates" style="width: 490px; height: 100px; margin-top: -115px; background-color: #F3F3F5;" ><legend><strong>RATES</strong></legend>

                <label>

                    <h3>Tour Name:&nbsp;&nbsp;<select style="margin-left:61px; width:318px; background: #ffffff; color: #000000; font-weight: 700;" name="rate" id="rate"  onchange="obtenerValor(this.value);combo();">
                           <option></option>
                            <?php
                            $sql = "SELECT id, rate FROM ratesvalid";
                            $rs = Doo::db()->query($sql, array(9));
                            $rates_valid = $rs->fetchAll();
                            foreach ($rates_valid as $r) {
                                echo '<option value="' . $r['id'] . '" ' . (( 9 == $r['id']) ? 'select' : '' ) . '>' . $r['rate'] . '</option>';
                                 
                            }
                            ?>





                            <input type="hidden" name="rates" id="rates" style="" value= "<?php echo $agency['id_tour']; ?>" />
                            <input type="hidden" name="idt" id="idt" style="" value= "<?php echo $agency['id']; ?>" />                            
                            <input type="hidden" name="spn" id="spn" style="" value= "<?php echo $agency['spt']; ?>" />
                            <input type="hidden" name="tabla_ruta" id="tabla_ruta" style="" value= "<?php echo $agency['tabla_ruta']; ?>" />
                            
                            
                            <h3>Special Price Name:&nbsp;&nbsp;
                                <select style="color: #000000; text-align:center; font-weight: bold; margin-left:146px; width:318px;  margin-top:-21px; background: #ffffff;" name="special_price_name" id="special_price_name"  onchange="obtenerValor2(this.value);combo2();">
                                <option> </option>
                                <?php
                                $sql2 = "SELECT  DISTINCT special_price_name FROM tarifarios_transportacion WHERE special_price_name NOT IN('');";
                                $rs2 = Doo::db()->query($sql2, array(9));
                                $special_price_name = $rs2->fetchAll();
                                foreach ($special_price_name as $r2) {
                                    
                                    echo '<option value="' . $agency['id'] . '" ' . (( 9 == $agency['id']) ? 'select' : '' ) . '>' . $r2['special_price_name'] . '</option>';
                                }
                               
                                ?>                              
                                

                            </select>
                                                            

                            <script type="text/javascript">
                                var obtenerValor = function (x) {
                                    document.getElementById('rates').value = x;
                                    net_rate.value = x;
                                    
                                };
                            </script>
                            
                             <script type="text/javascript">
                                var obtenerValor2 = function (y) {
                                    document.getElementById('spn').value = y;
                                    //alert(y)
                                    if(y === ''){
                                      document.getElementById('spn').value = 0;  
                                    }
                                    //id_spt.value = y;
                                };
                            </script>


<input type="hidden" name="net_rate" id="net_rate" style="" value= "<?php echo $r['id']; ?>" />

                            </label>
                            <div class="input" style="display:none;">
                                <label style="width:150px;" class="required" id="acountt">Net Rates: </label>
<!--                                <input type="radio" name="id_tour" id="net_rate" value="1" checked="off" <?php /*echo ($agency['id_tour'] == '-1' ? 'checked' : ''); */?><?php /*echo ($agency['id_tour'] == 1 ? 'checked' : ''); */?> />-->
                                
<!--                                <input type="radio" name="id_spt" id="id_spt" value="0" checked="off" <?php /*echo ($agency['spt'] == '-1' ? 'checked' : ''); */?><?php /*echo ($agency['spt'] == 1 ? 'checked' : ''); */?> />-->

                            </div>

                            <!--                            <div class="multiselect" style="margin-left: 206px;">
                                                            <div class="selectBox" onclick="showCheckboxes()" style="">
                                                                <select style="margin-left: -47px; margin-top:4px; width: 110%;" name="agencia[]">
                                                                    <option>Select Agency</option>
                                                                </select>
                                                                <div class="overSelect"></div>
                                                            </div>
                            
                            
                                                            <div id="checkboxes" style="width: 128%;">
                            <?php
                            $sql22 = "SELECT id, company_name FROM agencia where id NOT IN('45','53','208') order by company_name asc";
                            $rs22 = Doo::db()->query($sql22, array(220));
                            $agency_name = $rs22->fetchAll();
                            foreach ($agency_name as $r):
                                ?>
                                                                        <label for="one"> <input type="checkbox" id="agencia<?php /*echo $r['id'] */?>" name="checkbox" onclick="contar();"  value="<?php /*echo $r['id'] */?>"/><?php /*echo $r['company_name'];*/ ?></label>       
                            <?php endforeach; ?>
                            
                                                            </div>
                                                        </div>-->

<!--                            <script>
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
                            </script>-->

<!--                            <script type="text/javascript">
                                function contar() {
                                    var checkboxes = form1.checkbox; //Array que contiene los checkbox
                                    var cont = 0; //Variable que lleva la cuenta de los checkbox pulsados
                                    for (var x = 0; x < checkboxes.length; x++) {
                                        if (checkboxes[x].checked) {
                                            cont = cont + 1;
                                        }
                                    }
                                    alert("El número de checkbox pulsados es " + cont);
                                }
                            
                            
                            </script>-->



                            <?php
                            /*                             * @
                             *  tarifas de transportacion para supertours
                             *  y la service  L.A                
                             */
                            if ($agency['id'] == 45) {
                                $value = 0;
                                //echo $value;
                            } else if ($agency['id'] == 88) {
                                $value = 0;
                                //echo $value;
                            } else {
                                $value = 1;
                                // echo $value;
                            }
                            ?>


                            <div class="input" style="display: none;">

                                <label style="width:150px" class="required" id="costumer_sincee">Commissionable Rates: </label>
                                <input type="radio" name="type_rate" id="commission_rate" value="<?php echo $value; ?>" checked="on" <?php echo ($agency['type_rate'] == 1 ? 'checked' : ''); ?> />

                            </div>

                            <!--                <div class="input" style="display: none;">
                                                <label style="width:150px" class="required" id="acountt">Special Rates for Extensions: </label>
                                                <input type="checkbox" name="precio_especial_exten" id="precio_especial_exten" value="1" <? echo ($agency['precio_especial_exten'] == 1 ? 'checked' : ''); ?> />
                                            </div>-->
                            </fieldset>   
                  
            <!-----******---> 
              
            
            <!----******--->

            <input name="id" type="hidden" id="id" value="<?php echo $agency['id']; ?>" />
            <input name="spt" type="hidden" id="spt" value="<?php echo $agency['id']; ?>" />

            </div>
            </div> 

            <input type="text" style="display:none; margin-top:15px; margin-left:1px; " name="sodastereo1" id="sodastereo1" value="" onkeypress="return solonumeros(event);" />
            <input type="text" style="display:none; margin-top:15px; margin-left:1px; " name="sodastereo2" id="sodastereo2" value="" onkeypress="return solonumeros2(event);" />

            
           

</form>
                            <div id="ajax"></div>
                            </div>
                            <script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/form.js"></script>
                            <script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/jquery.maskedinput.js"></script>
                            <script type="text/javascript">
                                $(document).ready(function () {
                               
                                    
                                    $("#active_vaucher").change(function () {
                                        if ($('#active_vaucher').is(":checked"))
                                        {
                                            $("input[name='opcion5']").each(function (i) {
                                                $(this).removeAttr("disabled");
                                            });
                                        } else
                                        {
                                            $("input[name='opcion5']").each(function (i) {
                                                $(this).attr("disabled", "disabled");
                                            });
                                        }
                                    });
                                });


                                $("#limited").css("display", "none");
                                $("#creditamount").css("display", "none");
                                $("#peso").css("display", "none");
                                ////////
                                $("#net").css("display", "none");
                                $("#days").css("display", "none");
                                $("#diass").css("display", "none");

                                $("#phone1").mask("(999) 999-9999");
                                $("#phone2").mask("(999) 999-9999");
                                $("#phone").mask("(999) 999-9999");
                                $("#birthdate").mask("99/99/9999");





                                $("p").click(function () {

                                    $("#ajax").load('<?php echo $data['rootUrl']; ?>admin/agency/ajax');

                                });
                                function validateForm() {

                                    var sErrMsg = "";
                                    var flag = true;
                                    var id_country = document.getElementById("country").selectedIndex;
                                    
                                    
                                    if(document.getElementById("company_name").value == ''){
                                        sErrMsg += validateText($('#company_name').val(), "Company Name", true);
                                        document.getElementById("company_name").style.borderColor = "red";
                                        $("#company_name").focus();
                                    }else{
                                        
                                        document.getElementById("company_name").style.borderColor = "#AFAFAF";
                                    }
                                    
                                    if(document.getElementById("address").value == ''){
                                        sErrMsg += validateText($('#address').val(), "Address", true);
                                        document.getElementById("address").style.borderColor = "red";
                                        $("#address").focus();                                   
                                    }else{
                                        document.getElementById("address").style.borderColor = "#AFAFAF";
                                    }
                                    
                                    if(document.getElementById("city").value == ''){
                                        sErrMsg += validateText($('#city').val(), "City", true);
                                        document.getElementById("city").style.borderColor = "red";
                                        $("#city").focus();
                                    }else{
                                        document.getElementById("city").style.borderColor = "#AFAFAF";
                                    }
                                    
                                    if(document.getElementById("main_email").value == ''){
                                        sErrMsg += validateEmail($('#main_email').val(), "E-mail", true);   
                                        document.getElementById("main_email").style.borderColor = "red";
                                        $("#main_email").focus(); 
                                    }else{
                                        document.getElementById("main_email").style.borderColor = "#AFAFAF";
                                    }
                                    
                                    if(document.getElementById("phone1").value == ''){
                                        sErrMsg += validateEmail($('#phone1').val(), "Phone 1", true);   
                                        document.getElementById("phone1").style.borderColor = "red";
                                        $("#phone1").focus(); 
                                    }else{
                                        document.getElementById("phone1").style.borderColor = "#AFAFAF";
                                    }

                                    
                                    sErrMsg += validateNumber($('#acount').val(), $('#acountt').html(), true);
                                    sErrMsg += validateText($('#customer_since').val(), $('#customer_sincee').html(), true);
                                    
                                    if(id_country != 248){
                                        
                                    }else{
                                        
                                      if(document.getElementById("zipcode").value == ''){  
                                        sErrMsg += validateText($('#zipcode').val(),"Zip Code" , true);
                                        document.getElementById("zipcode").style.borderColor = "red";
                                        $("#zipcode").focus();
                                      }else{
                                        document.getElementById("zipcode").style.borderColor = "#AFAFAF";
                                      }

                                      
                                      if(document.getElementById("state").value == ''){  
                                        sErrMsg += validateText($('#state').val(),"State" , true);
                                        document.getElementById("state").style.borderColor = "red";
                                        $("#state").focus();
                                      }else{
                                        document.getElementById("state").style.borderColor = "#AFAFAF";
                                      }
                                      
                                    }
                                    //$('#zip_codee').html()
                                    //////////////////////////
                                    //sErrMsg += validateText($('#person_charge').val(), $('#person_chargee').html(), true);
                                    //sErrMsg += validateText($('#position').val(), $('#positionn').html(), true);

                                    //sErrMsg += validateText($('#fax').val(), $('#faxx').html(), true);
                                    //sErrMsg += validateEmail($('#eemail').val(), $('#eemaill').html(), true);
                                    //sErrMsg += validateText($('#web_page').val(), $('#web_pagee').html(), true);
                                    //sErrMsg += validateText($('#iata_clia').val(), $('#iata_cliaa').html(), true);
                                    //////////////////////////////
                                    
                                    //sErrMsg += validateText($('#manager').val(), $('#managerr').html(), true);
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
                                });

                                $('#btn-cancel').click(function () {
                                    window.location = '<?php echo $data['rootUrl']; ?>admin/agency';
                                });

                            </script>
                            <script>

                                function combo()
                                {

                                    $(document).ready(function () {
                                        // Así accedemos al Texto de la opción seleccionada
                                        var valor = $("#rate option:selected").html();
                                        //alert(valor);

                                        tour_name.value = valor;

                                    });

                                }
                            </script>

                            <script>                                                        
                                
                                function combo2()
                                {

                                    $(document).ready(function () {                                        
 
                                        // Así accedemos al Texto de la opción seleccionada
                                        var cadena = $("#special_price_name option:selected").html();
                                        //reemplazamos &amp por &
                                        var resultado = cadena.replace(/&amp;/g, "&");
                                        //console.log(resultado);                                      
                                        document.getElementById('special_price').value = resultado;

                                    });

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

 <button id="button"  style="margin-top:-21px; margin-left:597px; display:none;">Ids!</button>
 <button id="activate" style="margin-top:-21px; margin-left:697px; display:none;">Ids!2</button>
 

    
    <script type="text/javascript">

        $('button').click(function () {
            
            var ids;
            ids = $('input[name="inactivos"]:checked').map(function () {
           
                return $(this).attr('id');
            }).get();
            //alert('IDS: ' + ids.join(', '));
            //alert(ids.join(', '));
            document.getElementById('sodastereo1').value = ids;
            
            //alert(ids);                            

        });
    </script>
    
    <script type="text/javascript">

        $('activate').click(function () {
            
            
            var idact;
            idact = $('input[name="activos"]:checked').map(function () {
           
                return $(this).attr('id');
            }).get();
            //alert('IDS: ' + idact.join(', '));
            document.getElementById('sodastereo2').value = idact;
                                   

        });
    </script>
    
<!--    <script type="text/javascript">

        $('button').click(function () {
            var ids = = new Array();;
            $("input[@name='checkboxuser[]']:checked").each(function() {
            ids.push($(this).val());
            });
            document.getElementById('sodastereo1').value = ids;
            //alert(ids);                            

        });
    </script>-->
    
    
<!--<script type="text/javascript">
$(function() {
    $('#enviar').click(function() {
        var categorias = new Array();
 
        $("input[@name='categoria[]']:checked").each(function() {
            categorias.push($(this).val());
        });
 
        alert(categorias);
    });
});
</script>
    -->
    
    
    
    
<script type="text/javascript">

        function darclick() {
            var obj = document.getElementById('button');
            obj.click();
        }

</script>

<script type="text/javascript">

        function activados() {
            var obaj = document.getElementById('activate');            
            obaj.click();
        }

</script>

    
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

<script>
        var expanded2 = false;
        function showCheckboxes2() {
            var checkboxes2 = document.getElementById("checkboxes2");
            if (!expanded2) {
                checkboxes2.style.display = "block";
                expanded2 = true;
            } else {
                checkboxes2.style.display = "none";
                expanded2 = false;
            }
        }
</script>
    
<script type="text/javascript">
    /**
     * Función que solo permite la entrada de numeros, un signo negativo y
     * un punto para separar los decimales
     */
    function solonumeros(e)
    {
        // capturamos la tecla pulsada
        var teclaPulsada=window.event ? window.event.keyCode:e.which;
 
        // capturamos el contenido del input
        
        var valor=document.getElementById('sodastereo1').value;
        
        // 45 = tecla simbolo menos (-)
        // Si el usuario pulsa la tecla menos, y no se ha pulsado anteriormente
        // Modificamos el contenido del mismo añadiendo el simbolo menos al
        // inicio
//        if(teclaPulsada==45 && valor.indexOf("-")==-1)
//        {
//            document.getElementById("saldoactual").value="-"+valor;
//        }
 
        // 13 = tecla enter
        // 46 = tecla punto (.)
        // 44 = tecla coma (,)
        // Si el usuario pulsa la tecla enter o el punto y no hay ningun otro
        // punto
        if(teclaPulsada==13 || (teclaPulsada==44))
        {
            return true;
        }
 
        // devolvemos true o false dependiendo de si es numerico o no
        return /\d/.test(String.fromCharCode(teclaPulsada));
    }
    </script>
    
<script type="text/javascript">
    /**
     * Función que solo permite la entrada de numeros, un signo negativo y
     * un punto para separar los decimales
     */
    function solonumeros2(e)
    {
        // capturamos la tecla pulsada
        var teclaPulsada=window.event ? window.event.keyCode:e.which;
 
        // capturamos el contenido del input
        
        var valor=document.getElementById('sodastereo2').value;
        
        // 45 = tecla simbolo menos (-)
        // Si el usuario pulsa la tecla menos, y no se ha pulsado anteriormente
        // Modificamos el contenido del mismo añadiendo el simbolo menos al
        // inicio
//        if(teclaPulsada==45 && valor.indexOf("-")==-1)
//        {
//            document.getElementById("saldoactual").value="-"+valor;
//        }
 
        // 13 = tecla enter
        // 46 = tecla punto (.)
        // 44 = tecla coma (,)
        // Si el usuario pulsa la tecla enter o el punto y no hay ningun otro
        // punto
        if(teclaPulsada==13 || (teclaPulsada==44))
        {
            return true;
        }
 
        // devolvemos true o false dependiendo de si es numerico o no
        return /\d/.test(String.fromCharCode(teclaPulsada));
    }
    </script>
    
    
    <script type="text/javascript">

    $(window).load(function () {
        
        var dato = "<?php echo $data['dato']; ?>";
        var fecha_hoy = "<?php echo $fecha_hoy; ?>";
        var codigo = "<?php echo $codigo; ?>";
        
        
                
        if(dato == "New"){
            document.getElementById("country").selectedIndex = 248;
            document.getElementById("rate").selectedIndex = 4;
            document.getElementById("special_price_name").selectedIndex = 4;
            document.getElementById("rates").value = 116;
            
            var tari_tour = $("#rate option:selected").html();
            var tari_transp = $("#special_price_name option:selected").html();
            
            document.getElementById('special_price').value = tari_transp;                    
            document.getElementById('tour_name').value = tari_tour;   
            document.getElementById('opcion1').checked = true;
            document.getElementById('opcion3').checked = true;
            document.getElementById('opcion4').checked = true;
            document.getElementById('customer_since').value = fecha_hoy;
            document.getElementById('acount').value = codigo;
            document.getElementById('est_agency').style.color = "#3CA4DE";
            
            document.getElementById('est_agency').style.color = "#e63244";
            document.getElementById('company_name').style.background = "#ffffff";
            document.getElementById('address').style.background = "#ffffff";
            document.getElementById('address2').style.background = "#ffffff";
            document.getElementById('city').style.background = "#ffffff";
            document.getElementById('state').style.background = "#ffffff";
            document.getElementById('zipcode').style.background = "#ffffff";
            document.getElementById('country').style.background = "#ffffff";
            document.getElementById('phone1').style.background = "#ffffff";
            document.getElementById('phone2').style.background = "#ffffff";
            document.getElementById('fax').style.background = "#ffffff";
            document.getElementById('main_email').style.background = "#ffffff";
            document.getElementById('web_page').style.background = "#ffffff";
            document.getElementById('manager').style.background = "#ffffff";
            document.getElementById('person_charge').style.background = "#ffffff";
            document.getElementById('eemail').style.background = "#ffffff";
            document.getElementById('phone').style.background = "#ffffff";
            
            
           
        }else{            
            change_country();
            document.getElementById('est_agency').style.color = "#e63244";
            document.getElementById('company_name').style.background = "#ceffff";
            document.getElementById('address').style.background = "#ceffff";
            document.getElementById('address2').style.background = "#ceffff";
            document.getElementById('city').style.background = "#ceffff";
            document.getElementById('state').style.background = "#ceffff";
            document.getElementById('zipcode').style.background = "#ceffff";
            document.getElementById('country').style.background = "#ceffff";
            document.getElementById('phone1').style.background = "#ceffff";
            document.getElementById('phone2').style.background = "#ceffff";
            document.getElementById('fax').style.background = "#ceffff";
            document.getElementById('main_email').style.background = "#ceffff";
            document.getElementById('web_page').style.background = "#ceffff";
            document.getElementById('manager').style.background = "#ceffff";
            document.getElementById('person_charge').style.background = "#ceffff";
            document.getElementById('eemail').style.background = "#ceffff";
            document.getElementById('phone').style.background = "#ceffff";
        }
        
    });
    
    function change_country() {
        
        var id_country = document.getElementById("country").selectedIndex;
                                
        //alert(id_country);
        if(id_country != 248){
            document.getElementById("ast_zip").style.color = 'transparent'; 
            document.getElementById("state_zip").style.color = 'transparent'; 
            document.getElementById("state").disabled = true; 
            document.getElementById("state").style.background = "#ececec"; 
            document.getElementById("state").selectedIndex = 0;
            
            
        }else{
            document.getElementById("ast_zip").style.color = 'red'; 
            document.getElementById("state_zip").style.color = 'red'; 
            document.getElementById("state").disabled = false; 
            document.getElementById("state").style.background = "#ffffff"; 
        }
            
    }
   
    </script>
    
    
    
    
    
    
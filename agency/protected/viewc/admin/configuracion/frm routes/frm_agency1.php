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
<?php $agency = $data['agency']; ?> 


<form id="form1" class="form" action="<?php echo $data['rootUrl']; ?>admin/agency/save" method="post" name="form1">
    <div id="header_page" >
        <div class="header2">Agency [ <?php echo $data['dato'];?> ]</div>
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

            <fieldset  id="acompany"><legend><strong>COMPANY</strong></legend><div class="input">
                    <label style="width:150px" class="required" id="company_namee">Company Name: </label>
                    <input type="text" name="company_name" id="company_name"  size="25"   value="<?php echo $agency['company_name']; ?>"/>
                </div>
                <div class="input">
                    <label style="width:150px" class="required" id="addresss">Address: </label>
                    <input type="text" name="address" id="address"  size="25"   value="<?php echo $agency['address']; ?>"/>
                </div>
                <div class="input">
                    <label style="width:150px" class="required" id="addresss">Address 2: </label>
                    <input type="text" name="address2" id="address2"  size="25"   value="<?php echo $agency['address2']; ?>"/>
                </div>
                <div class="input">
                    <label style="width:150px" class="required" id="cityy">City: </label>
                    <input type="text" name="city" id="city"  size="25"   value="<?php echo $agency['city']; ?>"/>
                </div>
                <div class="input" style="padding-top:5px;">
                    <label style="width:152px" class="required" id="statee">State: </label>
                    <select name="state" id="state" class="select" style="width:200px; height:23px;">
                        <option value=""></option>  
                        <?php foreach ($data["state"] as $e) { ?>
                            <option value="<?php echo $e['abb']; ?>"  <?php echo ($agency['state'] == trim($e['abb']) ? 'selected' : ''); ?>><?php echo $e["name"]; ?></option>
                        <?php } ?>
                    </select>
                </div>

                <div class="input">
                    <label style="width:150px" class="required" id="zip_codee">Zip Code: </label>
                    <input name="zipcode" type="text"  id="zipcode" size="5"   value="<?php echo $agency['zipcode']; ?>" />
                </div>

                <div class="input" style="padding-top:5px;">
                    <label style="width:152px" class="required" id="l_phone">Country: </label>
                    <select name="country" id="country" class="select" style="width:200px; height:23px;">
                        <option value=""></option>  
                        <?php foreach ($data["country"] as $e): ?>

                            <option value="<?php echo $e['name']; ?>"  <?php echo ($agency['country'] == trim($e['name']) ? 'selected' : ''); ?>><?php echo $e["name"]; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="input">
                    <label style="width:150px" class="required" id="positionn">Position: </label>
                    <input name="position" type="text"  id="position" size="20"   value="<?php echo $agency['position']; ?>" />
                </div>             
                <div class="input">
                    <label style="width:150px" class="required" id="phone11">Phone 1</label>
                    <input name="phone1" type="text"  id="phone1" size="15"  value="<?php echo $agency['phone1']; ?>" />
                </div> 
                <div class="input">
                    <label style="width:150px" class="required" id="phone22">Phone 2</label>
                    <input name="phone2" type="text"  id="phone2" size="15"  value="<?php echo $agency['phone2']; ?>" />
                </div> 

                <div class="input">
                    <label style="width:150px" class="required" id="faxx">Fax: </label>
                    <input name="fax" type="text"  id="fax" size="25"  value="<?php echo $agency['fax']; ?>" />
                </div> 
                <div class="input">
                    <label style="width:150px" class="required" id="main_emaill">E-Mail: </label>
                    <input name="main_email" type="text"  id="main_email" size="25"   value="<?php echo $agency['main_email']; ?>"/>
                </div> 
                <div class="input">
                    <label style="width:150px" class="required" id="web_pagee">Web Page: </label>
                    <input name="web_page" type="text"  id="web_page" size="25"  value="<?php echo $agency['web_page']; ?>" />
                </div> 
                <div class="input">
                    <label style="width:150px" class="required" id="iata_cliaa">IATA/CLIA#: </label>
                    <input name="iata_clia" type="text"  id="iata_clia" size="25"  value="<?php echo $agency['iata_clia']; ?>" />
                </div> 
                <div class="input">
                    <label style="width:150px" class="required" id="managerr">Manager: </label>
                    <input name="manager" type="text"  id="manager" size="30"  value="<?php echo $agency['manager']; ?>" />
                </div> 
                <div class="input">
                    <label style="width:150px" class="required" id="iata_cliaa">Birthdate: </label>
                    <input name="birthdate" type="text"  id="birthdate" size="10" maxlength="10" value="<?php echo $agency['birthdate']; ?>"/>
                </div> </fieldset>
            <fieldset><legend><strong>ACCOUNTING</strong></legend>
                <div class="input">
                    <label style="width:150px" class="required" id="acountt">Account: </label>
                    <input name="acount" type="text"  id="acount" size="25"   value="<?php echo $agency['acount']; ?>" />
                </div>

                <div class="input">
                    <label style="width:150px" class="required" id="costumer_sincee">Costumer Since: </label>
                    <input name="customer_since" type="text"  id="customer_since" size="25"   value="<?php echo $agency['customer_since']; ?>" />
                </div>

            </fieldset>

            <fieldset><legend><strong>CUSTOMER ACCOUNTING DEPARTMENT</strong></legend>
                <div class="input">
                    <label style="width:150px" class="required" id="person_chargee">Person in Charge: </label>
                    <input name="person_charge" type="text"  id="person_charge" size="25"   value="<?php echo $agency['person_charge']; ?>" />
                </div>
                <div class="input">
                    <label style="width:150px" class="required" id="eemaill">E-mail: </label>
                    <input name="eemail" type="text"  id="eemail" size="25"  value="<?php echo $agency['eemail']; ?>" />
                </div>
                <div class="input">
                    <label style="width:150px" class="required" id="phonee">Phone: </label>
                    <input name="phone" type="text"  id="phone" size="15"  value="<?php echo $agency['phone']; ?>"/>
                </div>
                <!--  <div class="input">
                     <label style="width:150px" class="required" id="phonee">Net Days: </label>
                     <input name="netdays" type="text"  id="netdays" size="5" maxlength="10" value=""/>
                 </div> -->
            </fieldset>

            <fieldset  ><legend><strong>PAYMENT AUTHORAIZED</strong></legend>
                <fieldset style="background-color:#F8F8F8;"><legend> <font color="#999999">PRED-PAID</font></legend>
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
                <fieldset style="background-color:#F8F8F8;"><legend> <font color="#999999">COLLECT ON BOARD</font></legend>
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
                <fieldset style="background-color:#F8F8F8;"><legend> <font color="#999999">VOUCHER<input  <?php echo ((($agency['opcion5'] == 1) || ($agency['opcion5'] == 2)) ? "checked=\"checked\"" : ''); ?> type="checkbox" name="active_vaucher" id="active_vaucher" value="1" /></font></legend>
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

            <fieldset id="acompany" style="margin-bottom:20px;" ><legend><strong>ACCOUNTING</strong></legend>
                
                <div class="input" style="padding-top:5px;">
                    <label style="width:152px" class="required" id="statee">Tour Name: </label>
                     
                                             <select name="tourname" id="tourname" style="margin-left:1px; margin-top:-2px;width:190px; height:20px;" onchange="combo();">
                                                 <option value="0">Select Tour Name</option>
                                                <?php
                                                $sql2 = "SELECT id, rate FROM ratesvalid";
                                                $rs2 = Doo::db()->query($sql2, array(9));
                                                $tourname =  $rs2->fetchAll();
                                                //$tn= $tourname['rate'];
                                                foreach ($tourname as $tn){
                                                echo '<option value="' . $tn ['id'] . '"  >'. $tn ['rate'].' </option>';
                                                                                              
                                                    }
                                                                                                   
                                                ?>
                                            </select>
                    
                  
                </div>
                 
                <div class="input">
                    <label style="width:150px" class="required" id="acountt">Net Rates: </label>
                    <input type="radio" name="type_rate" id="net_rate" value="1" <?php echo ($agency['type_rate'] == '-1' ? 'checked' : ''); ?><?php echo ($agency['type_rate'] == 1 ? 'checked' : ''); ?> />
                </div>

                <div class="input">
                    <label style="width:150px" class="required" id="costumer_sincee">Commissionable Rates: </label>
                    <input type="radio" name="type_rate" id="commission_rate" value="0" <?php echo ($agency['type_rate'] == 0 ? 'checked' : ''); ?> />
                </div>
                <div class="input">
                    <label style="width:150px" class="required" id="acountt">Special Rates for Extensions: </label>
                    <input type="checkbox" name="precio_especial_exten" id="precio_especial_exten" value="1" <?php echo ($agency['precio_especial_exten'] == 1 ? 'checked' : ''); ?> />
                </div>
            </fieldset>     
             
          
            <input name="id" type="" id="id" value="<?php echo $agency['id']; ?>" />


        </div>
    </div> 
      <input type="text" name="tarifario" id="tarifario"  size="25" maxlength="25" style="margin-left: 254px;" value="<?php echo $idtourname1['id'];?>">
                                      
    
<!--                                <div id="result"> </div>-->
</form>
<div id="ajax"></div>
</div>
<script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/form.js"></script>
<script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/jquery.maskedinput.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $("#active_vaucher").change(function() {
            if ($('#active_vaucher').is(":checked"))
            {
                $("input[name='opcion5']").each(function(i) {
                    $(this).removeAttr("disabled");
                });
            }
            else
            {
                $("input[name='opcion5']").each(function(i) {
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





    $("p").click(function() {

        $("#ajax").load('<?php echo $data['rootUrl']; ?>admin/agency/ajax');

    });
    function validateForm() {

        var sErrMsg = "";
        var flag = true;

        sErrMsg += validateText($('#company_name').val(), $('#company_namee').html(), true);
        sErrMsg += validateText($('#address').val(), $('#addresss').html(), true);
        sErrMsg += validateText($('#city').val(), $('#cityy').html(), true);
        sErrMsg += validateText($('#zipcode').val(), $('#zip_codee').html(), true);
        sErrMsg += validateText($('#position').val(), $('#positionn').html(), true);

        sErrMsg += validateText($('#fax').val(), $('#faxx').html(), true);
        sErrMsg += validateEmail($('#eemail').val(), $('#eemaill').html(), true);
        sErrMsg += validateText($('#web_page').val(), $('#web_pagee').html(), true);
        sErrMsg += validateText($('#iata_clia').val(), $('#iata_cliaa').html(), true);
        //////////////////////////////
        sErrMsg += validateNumber($('#acount').val(), $('#acountt').html(), true);
        sErrMsg += validateText($('#customer_since').val(), $('#customer_sincee').html(), true);

        //////////////////////////
        sErrMsg += validateText($('#person_charge').val(), $('#person_chargee').html(), true);
        sErrMsg += validateEmail($('#main_email').val(), $('#main_emaill').html(), true);
        sErrMsg += validateText($('#manager').val(), $('#managerr').html(), true);
        if (sErrMsg != "")
        {
            alert(sErrMsg);
            flag = false;
        }

        return flag;

    }

    $('#btn-save').click(function() {
        if (validateForm()) {
            $('#form1').submit();
        }
    })

    $('#btn-cancel').click(function() {
        window.location = '<?php echo $data['rootUrl']; ?>admin/agency';
    })

 function combo()
        {     
                
           $(document).ready(function() {
            // Así accedemos al Texto de la opción seleccionada
           // var valor = $("#tourname option:selected").html();
            
            var idtarif = $idtarif.value();//alert(valor);
            
            tarifario.value= idtarif;
                                                  
            });
            
        }  
</script>



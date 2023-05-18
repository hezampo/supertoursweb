<link rel="stylesheet" type="text/css" href="<?php echo $data['rootUrl']; ?>global/themes/blitzer/jquery-ui-1.9.0.custom.css" />
<link rel="stylesheet" type="text/css" href="<?php echo $data['rootUrl']; ?>global/themes/blitzer/jquery-ui-1.9.0.custom.min.css" />
<script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/jquery-ui-1.8.18.custom.min.js"></script>
<?php
$tarifaonetour = $data["tarifaonetour"];
$data["type_rate"];

//echo $tarifaonetour->id;
$id_onetour = $tarifaonetour->id;

?>
<form id="form1" class="form" action="<?php echo $data['rootUrl']; ?>admin/onedaytour/rates/save" method="post" name="form1">
    <div id="header_page" >
        <div class="header2">(Tours)One Day Tour Rate [ <?php echo $data['dato'];?> ] - <?php
            if ($data['type_rate'] == 0) {
                echo 'Commissionable rates';
            } else if ($data['type_rate'] == 1) {
                echo 'Net Rates';
            } else if ($data['type_rate'] == 2) {
                echo 'Special Net Rates';
            }
            ?></div>
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

            <fieldset style="background-color: #F0F8FF;"><legend>General Information</legend>
                
                </br>
                
                <?php
                if ($data['type_rate'] == 2) {
                    $display = 'block';
                } else {
                    $display = 'none';
                }
                ?>
                <div  class="input" style="display:<?php echo $display; ?>" >
                    <label style="width:150px; font-weight: bold; color:#0B55C4;; font-size:14px; text-align:right; margin-left:40px;" class="required" for="type_rate">Agency:</label>
                    <div class="ausu-suggest" >
                        <input name="company_name" type="text" id="company_name" style="margin-left:47px; color:#708090;" size="40" maxlength="40" value="<?php echo $tarifaonetour->company_name; ?>"
                        <?php
                        if ($data['dato'] == 'edit') {
                            echo 'readonly';
                            echo '   style="background:#DFDFE1;"';
                        }
                        ?>   />
                        <input type="hidden" size="4" value="<?php echo $tarifaonetour->id_agency ?>" name="id_agency" id="id_agency" autocomplete="off" />
                        
                    </div>
                </div>
                </br>
                </br>

                <label style="position:absolute; width:197px; font-weight:bold; color:#0B55C4;; margin-left: 3px; margin-top: -15px; text-align:right; font-size:14px;" class="" id="transp">From Miami 1 DAY TOUR TO:</label>
                 </br>
                <label style="position:absolute; width:197px; font-weight:bold; color: #0B55C4; margin-left: 3px; margin-top: 10px; text-align:right;" class="" id="wdw">WDW/UNIVERSAL/SEA WORLD:</label>
                <label style="position:absolute; width:197px; font-weight:bold; color: green; margin-left: 3px; margin-top: 40px; text-align:right;" class="" id="wp">WATER PARKS & HOLY LAND:</label>
                <label style="position:absolute; width:197px; font-weight:bold; color: red; margin-left: 3px; margin-top: 70px; text-align:right;" class="" id="kspc">KENNEDY SPACE CENTER:</label>
                <label style="position:absolute; width:10px; font-weight:bold; color:#696969; margin-left: 233px; margin-top: 10px; text-align:right; font-size:16px;" class="" id="d1">$</label>
                <label style="position:absolute; width:10px; font-weight:bold; color:#696969; margin-left: 365px; margin-top: 10px; text-align:right; font-size:16px;" class="" id="d2">$</label>
                <label style="position:absolute; width:10px; font-weight:bold; color:#696969; margin-left: 233px; margin-top: 40px; text-align:right; font-size:16px;" class="" id="d3">$</label>
                <label style="position:absolute; width:10px; font-weight:bold; color:#696969; margin-left: 365px; margin-top: 40px; text-align:right; font-size:16px;" class="" id="d4">$</label>
                 <label style="position:absolute; width:10px; font-weight:bold; color:#696969; margin-left: 233px; margin-top: 70px; text-align:right; font-size:16px;" class="" id="d5">$</label>
                <label style="position:absolute; width:10px; font-weight:bold; color:#696969; margin-left: 365px; margin-top: 70px; text-align:right; font-size:16px;" class="" id="d6">$</label>
                
                
                <input type="text" id="dato" name="dato" style="display:none;"  size="10" maxlength="7"  value="<?php echo $data['dato'];?>" />
                <input type="text" id="id_onetour" name="id_onetour" style="display:none;"  size="10" maxlength="7"  value="<?php echo $id_onetour;?>" />
                
                <div class="input">
                    <label style="width:150px; display:none;" class="required" id="l_priceadult">Adult Price</label>
                    <input name="priceadult"  type="hidden"  id="priceadult" size="10" maxlength="7"  value="<?php echo $tarifaonetour->priceadult=1.00; ?>" />
                </div>
                
                <div class="input">
                    <label style="width:150px; margin-left: 236px; margin-top: -38px; font-weight:bold; color:#0B55C4; font-size:14px;" class="required" id="l_priceadult_WDW">ADULT</label>
                    <input name="priceadult_WDW" type="text"  id="priceadult_WDW" size="10" maxlength="7" style="margin-top: 2px; margin-left: 236px; color:#2F4F4F; font-size: 15px; width: 98px;" value="<?php echo $tarifaonetour->priceadult_WDW; ?>" autocomplete="off"  />
                </div>
                
                <div class="input">
                    <label style="width:150px; display:none;" class="required" id="l_pricechild">Children Price</label>
                    <input name="pricechild" type="hidden"  id="pricechild" size="10" maxlength="7"  value="<?php echo $tarifaonetour->pricechild=1.00; ?>" />
                </div>
                
                <div class="input">
                    <label style="width:150px; margin-top: -67px; margin-left: 367px; font-weight:bold; color:#0B55C4; font-size:14px;" class="required" id="l_pricechild_WDW">CHILD (3 TO 9)</label>
                    <input name="pricechild_WDW" type="text"  id="pricechild_WDW" size="10" maxlength="7" style="margin-top: -27px; margin-left: 368px; color:#2F4F4F; font-size: 15px; width: 98px;" value="<?php echo $tarifaonetour->pricechild_WDW; ?>" autocomplete="off"  />
                </div>
                
                <div class="input">
                    <label style="width:150px; display:none;" class="required" id="l_priceadult_WATERP">Adult Price WP</label>
                    <input name="priceadult_WATERP" type="text"  id="priceadult_WATERP" size="10" maxlength="7" style="margin-left: 236px; color:#2F4F4F; font-size: 15px; width: 98px;" value="<?php echo $tarifaonetour->priceadult_WATERP; ?>" autocomplete="off"  />
                </div>
                
                 <div class="input">
                    <label style="width:150px; display:none;" class="required" id="l_pricechild_WATERP">Children Price WP</label>
                    <input name="pricechild_WATERP" type="text"  id="pricechild_WATERP" size="10" maxlength="7" style="margin-left: 368px; margin-top:-26px; color:#2F4F4F; font-size: 15px; width: 98px;" value="<?php echo $tarifaonetour->pricechild_WATERP; ?>" autocomplete="off"  />
                </div>
                
                <div class="input">
                    <label style="width:150px; display:none;" class="required" id="l_priceadult_KENNEDYSPC">Adult Price KSC</label>
                    <input name="priceadult_KENNEDYSPC" type="text"  id="priceadult_KENNEDYSPC" size="10" maxlength="7" style="margin-left: 236px; color:#2F4F4F; font-size: 15px; width: 98px;" value="<?php echo $tarifaonetour->priceadult_KENNEDYSPC; ?>" autocomplete="off"  />
                </div>
                
                <div class="input">
                    <label style="width:150px; display:none;" class="required" id="l_pricechild_KENNEDYSPC">Child Price KSC</label>
                    <input name="pricechild_KENNEDYSPC" type="text"  id="pricechild_KENNEDYSPC" size="10" maxlength="7" style="margin-left: 368px; margin-top: -26px; color:#2F4F4F; font-size: 15px; width: 98px;" value="<?php echo $tarifaonetour->pricechild_KENNEDYSPC; ?>" autocomplete="off"  />
                </div>
                
                
                
                <?php if ($data['type_rate'] == 2) { ?>
                <fieldset style="display:none;">
                    <legend>SUPLEMENTS FOR WALT DISNEY WORLD :</legend>

                    <div class="input" style="float:left;">
                        <label style="width:150px;" class="required" id="l_pricechild">Magic Kingdom-  Adults $</label>
                        <input name="suplemag_adult" type="text"  id="pricechild" size="10" maxlength="7"  value="<?php echo $tarifaonetour->suplemag_adult; ?>" />
                    </div>
                    <div class="input" style="float:left;">
                        <label style="width:60px;" class="required" id="l_pricechild">Childs $</label>
                        <input name="suplemag_child" type="text"  id="pricechild" size="10" maxlength="7"  value="<?php echo $tarifaonetour->suplemag_child; ?>" />
                    </div>
                    <div style="clear:both;"></div>
                    <div class="input" style="float:left;">
                        <label style="width:150px" class="required" id="l_pricechild">Epcot-  Adults $</label>
                        <input name="suplepcot_adult" type="text"  id="pricechild" size="10" maxlength="7"  value="<?php echo $tarifaonetour->suplepcot_adult; ?>" />
                    </div>
                    <div class="input" style="float:left;">
                        <label style="width:60px" class="required" id="l_pricechild">Childs $</label>
                        <input name="suplepcot_child" type="text"  id="pricechild" size="10" maxlength="7"  value="<?php echo $tarifaonetour->suplepcot_child; ?>" />
                    </div>
                    <div style="clear:both;"></div>
                    <div class="input" style="float:left;">
                        <label style="width:150px" class="required" id="l_pricechild">Hollywood S-  Adults $</label>
                        <input name="suplehollywood_adult" type="text"  id="pricechild" size="10" maxlength="7"  value="<?php echo $tarifaonetour->suplehollywood_adult; ?>" />
                    </div>
                    <div class="input" style="float:left;">
                        <label style="width:60px" class="required" id="l_pricechild">Childs $</label>
                        <input name="suplehollywood_child" type="text"  id="pricechild" size="10" maxlength="7"  value="<?php echo $tarifaonetour->suplehollywood_child; ?>" />
                    </div>
                    <div style="clear:both;"></div>
                    <div class="input" style="float:left;">
                        <label style="width:150px" class="required" id="l_pricechild">Animal Kingdom-  Adults $</label>
                        <input name="supleanimalk_adult" type="text"  id="pricechild" size="10" maxlength="7"  value="<?php echo $tarifaonetour->supleanimalk_adult; ?>" />
                    </div>
                    <div class="input" style="float:left;">
                        <label style="width:60px" class="required" id="l_pricechild">Childs $</label>
                        <input name="supleanimalk_child" type="text"  id="pricechild" size="10" maxlength="7"  value="<?php echo $tarifaonetour->supleanimalk_child; ?>" />
                    </div>
                </fieldset>
                
                <fieldset style="display:none;">
                    <legend>SUPLEMENTS FOR UNIVERSAL PARKS :</legend>
                    <div class="input" style="float:left;">
                        <label style="width:150px" class="required" id="l_pricechild">Universal Studios $</label>
                        <input name="suplemuniv_adult" type="text"  id="pricechild" size="10" maxlength="7"  value="<?php echo $tarifaonetour->suplemuniv_adult; ?>" />
                    </div>
                    <div class="input" style="float:left;">
                        <label style="width:60px;" class="required" id="l_pricechild">Childs $</label>
                        <input name="suplemuniv_child" type="text"  id="pricechild" size="10" maxlength="7"  value="<?php echo $tarifaonetour->suplemuniv_child; ?>" />
                    </div>
                    <div style="clear:both;"></div>
                    <div class="input" style="float:left;">
                        <label style="width:150px" class="required" id="l_pricechild">Island of Adventure $</label>
                        <input name="suplemisland_adult" type="text"  id="pricechild" size="10" maxlength="7"  value="<?php echo $tarifaonetour->suplemisland_adult; ?>" />
                    </div>
                    <div class="input" style="float:left;">
                        <label style="width:60px;" class="required" id="l_pricechild">Childs $</label>
                        <input name="suplemisland_child" type="text"  id="pricechild" size="10" maxlength="7"  value="<?php echo $tarifaonetour->suplemisland_child; ?>" />
                    </div>
                </fieldset>
                
                <fieldset style="display:none;">
                    <legend>SUPLEMENTS FOR SEA WORLD :</legend>
                    <div class="input" style="float:left;">
                        <label style="width:150px" class="required" id="l_pricechild">Sea World $</label>
                        <input name="suplemseaw_adult" type="text"  id="pricechild" size="10" maxlength="7"  value="<?php echo $tarifaonetour->suplemseaw_adult; ?>" />
                    </div>
                    <div class="input" style="float:left;">
                        <label style="width:60px;" class="required" id="l_pricechild">Childs $</label>
                        <input name="suplemseaw_child" type="text"  id="pricechild" size="10" maxlength="7"  value="<?php echo $tarifaonetour->suplemseaw_child; ?>" />
                    </div>
                    <div style="clear:both;"></div>
                    <div class="input" style="float:left;">
                        <label style="width:150px" class="required" id="l_pricechild">Aquatica $</label>
                        <input name="suplemaquat_adult" type="text"  id="pricechild" size="10" maxlength="7"  value="<?php echo $tarifaonetour->suplemaquat_adult; ?>" />
                    </div>
                    <div class="input" style="float:left;">
                        <label style="width:60px;" class="required" id="l_pricechild">Childs $</label>
                        <input name="suplemaquat_child" type="text"  id="pricechild" size="10" maxlength="7"  value="<?php echo $tarifaonetour->suplemaquat_child; ?>" />
                    </div>
                </fieldset>
                
                <fieldset style="display:none;">
                    <legend>SUPLEMENTS FOR WATER PARKS :</legend>
                    <div class="input" style="float:left;">
                        <label style="width:150px" class="required" id="l_pricechild">Wet’n Wild $</label>
                        <input name="suplemwetn_adult" type="text"  id="pricechild" size="10" maxlength="7"  value="<?php echo $tarifaonetour->suplemwetn_adult; ?>" />
                    </div>
                    <div class="input" style="float:left;">
                        <label style="width:60px;" class="required" id="l_pricechild">Childs $</label>
                        <input name="suplemwetn_child" type="text"  id="pricechild" size="10" maxlength="7"  value="<?php echo $tarifaonetour->suplemwetn_child; ?>" />
                    </div>
                    <div style="clear:both;"></div>
                    <div class="input" style="float:left;">
                        <label style="width:150px" class="required" id="l_pricechild">Blizzard Beach $</label>
                        <input name="suplembliz_adult" type="text"  id="pricechild" size="10" maxlength="7"  value="<?php echo $tarifaonetour->suplembliz_adult; ?>" />
                    </div>
                    <div class="input" style="float:left;">
                        <label style="width:60px;" class="required" id="l_pricechild">Childs $</label>
                        <input name="suplembliz_child" type="text"  id="pricechild" size="10" maxlength="7"  value="<?php echo $tarifaonetour->suplembliz_child; ?>" />
                    </div>
                </fieldset>
                
                <fieldset style="display:none;">
                    <legend>SUPLEMENTS FOR HISTORIC PARKS :</legend>
                    <div class="input" style="float:left;">
                        <label style="width:150px" class="required" id="l_pricechild">Kennedy Space Cter. $</label>
                        <input name="suplemkennedy_adult" type="text"  id="pricechild" size="10" maxlength="7"  value="<?php echo $tarifaonetour->suplemkennedy_adult; ?>" />
                    </div>
                    <div class="input" style="float:left;">
                        <label style="width:60px;" class="required" id="l_pricechild">Childs $</label>
                        <input name="suplemkennedy_child" type="text"  id="pricechild" size="10" maxlength="7"  value="<?php echo $tarifaonetour->suplemkennedy_child; ?>" />
                    </div>
                    <div style="clear:both;"></div>
                    <div class="input" style="float:left;">
                        <label style="width:150px" class="required" id="l_pricechild">Holy Land $</label>
                        <input name="suplemholy_adult" type="text"  id="pricechild" size="10" maxlength="7"  value="<?php echo $tarifaonetour->suplemholy_adult; ?>" />
                    </div>
                    <div class="input" style="float:left;">
                        <label style="width:60px;" class="required" id="l_pricechild">Childs $</label>
                        <input name="suplemholy_child" type="text"  id="pricechild" size="10" maxlength="7"  value="<?php echo $tarifaonetour->suplemholy_child; ?>" />
                    </div>
                </fieldset>
                <?php } ?>
                <div class="input">
                    <label style="display: none; width:150px" class="required" for="type_rate">Type Rates</label>

                    <select name="type_rate" id="type_rate" maxlenght="10" class="select" style="display:none; width:154px;">
                        <?php
                        if ($data['type_rate'] == 0) {
                            ?>
                            <option value="0" <?php echo ($tarifaonetour->type_rate == 0) ? "selected=\"selected\"" : ""; ?>>Commissionables Rates</option>
                            <?php
                        } else if ($data['type_rate'] == 1) {
                            ?>
                            <option value="1" <?php echo ($tarifaonetour->type_rate == 1) ? "selected=\"selected\"" : ""; ?>>Net Rates</option>
                            <?php
                        } else if ($data['type_rate'] == 2) {
                            ?>
                            <option value="2" <?php echo ($tarifaonetour->type_rate == 2) ? "selected=\"selected\"" : ""; ?>>Special Net Rates</option>
                            <?php
                        }
                        ?>
                    </select>
                </div>

               <?php
               /* if ($data['type_rate'] == 2) {
                    $display = 'block';
                } else {
                    $display = 'none';
                }*/
                ?>

<!--                <div  class="input" style="display:<?php echo $display; ?>" >
                    <label style="width:150px" class="required" for="type_rate">Agency</label>
                    <div class="ausu-suggest" >
                        <input name="company_name" type="text" id="company_name" size="40" maxlength="40" value="<?php echo $tarifaonetour->company_name; ?>"
                        <?php
                        if ($data['dato'] == 'edit') {
                            echo 'readonly';
                            echo '   style="background:#DFDFE1;"';
                        }
                        ?>   />
                        <input type="hidden" size="4" value="<?php echo $tarifaonetour->id_agency ?>" name="id_agency" id="id_agency" autocomplete="off" />
                    </div>
                </div>-->

                <div class="input">
                    <label style="display:none; width:150px" class="required" for="annio">Year</label>
                    <input type="number" id="annio" style="display:none;" value="<?php echo isset($tarifaonetour->annio)? substr($tarifaonetour->annio,0,4) : date('Y')?>" name="annio">
                </div>
                               
                
                <div class="input">
                    
                    <label class="required" style="position:absolute; width:150px;  margin-left: 236px; margin-top: 3px; color:  #0B55C4;"><strong>START DATE:</strong></label>
                    <input type="text" id="start_date" name="start_date" title="Start Date" style="margin-top: 30px; margin-left:236px; width:98px; font-size: 15px; height:20px; text-align: center; color: red; font-weight: bold;" size="25" maxlength="25" value="<?php echo ($tarifaonetour->start_date != "" ? date("m/d/Y", $tarifaonetour->start_date) : ''); ?>" autocomplete="off" />


                </div>
                
                <div class="input">
                    
                    <label style="position:absolute; width:150px; margin-left: 368px; margin-top: -54px; color: #0B55C4;"><strong>END DATE:</strong> </label>
                    <input type="text" id="end_date" name="end_date" title="End Date" style="margin-top: -26px; width:98px; margin-left:368px;  font-size: 15px; height:20px; text-align: center;color: red; font-weight: bold;"  size="25" maxlength="25" value="<?php echo ($tarifaonetour->end_date != "" ? date("m/d/Y", $tarifaonetour->end_date) : ''); ?>" autocomplete="off" />

                
                </div>
            </fieldset>
        </div>
    </div>
</form>

</div>
<script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/form.js"></script>

<script type="text/javascript">

    $(window).load(function () {

        comprobarScreen();
  

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
        if (window.screen.availWidth <= 1280) {
            window.parent.document.body.style.zoom = "100%";

        }
        if (window.screen.availWidth == 1366) {
            window.parent.document.body.style.zoom = "100%";

        }
        
        if (window.screen.availWidth == 1440) {
            window.parent.document.body.style.zoom = "100%";

        }
        
        if (window.screen.availWidth == 1600) {
            window.parent.document.body.style.zoom = "100%";

        }
        
        if (window.screen.availWidth == 1680) {
            window.parent.document.body.style.zoom = "100%";

        }

        if (window.screen.availWidth > 1680) {
            window.parent.document.body.style.zoom = "125%";


        }
    }

</script>

<script type="text/javascript">

    $(document).ready(function() {
        $("#trips").multiselect();
    });
    
    $(function () {
        $.datepicker.setDefaults($.datepicker.regional["es"]);
        $("#start_date").datepicker({
            firstDay: 1,
            numberOfMonths: 2,
            changeMonth: true,
            changeYear: true
//            dateFormat:'mm-dd-yy'
        });
    });
    $(function () {
        $.datepicker.setDefaults($.datepicker.regional["es"]);
        $("#end_date").datepicker({
//            dateFormat:'mm-dd-yy'
            firstDay: 1,
            numberOfMonths: 2,
            changeMonth: true,
            changeYear: true
            
        });
    });

    $(function() {
        $('#type_rate').change(function() {
            if ($(this).val() == '2') {
                $('#company_name').removeAttr("disabled");
                $('#company_name').attr('placeholder', 'Insert Agency');
            } else {
                $('#company_name').attr("disabled", "disabled");
                $('#company_name').val('');
                $('#id_agency').val('-1');
            }
        });
    });

    //auto-complete
    $("#company_name").keyup(function() {
        $("#company_name").autocomplete({
            source: '<?php echo $data["rootUrl"]; ?>admin/tours/loadcompany/' + $("#company_name").val(),
            select: function(event, ui) {
                $('#id_agency').val(ui.item.id);
            }
        });
    });
    function validateForm() {

        var sErrMsg = "";
        var flag = true;

        sErrMsg += validateNumberPositivo($('#priceadult').val(), $('#l_priceadult').html(), true);
        sErrMsg += validateNumberPositivo($('#pricechild').val(), $('#l_pricechild').html(), true);

<?php if ($data['type_rate'] == 2) { ?>
            if ($('#id_agency').val() == -1) {
                sErrMsg += "- Select the Agency.\n";
            }
<?php } ?>

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
        window.location = '<?php echo $data['rootUrl']; ?>admin/onedaytour/rates/<?php echo $tarifaonetour->type_rate; ?>';
            })

</script>



<link rel="stylesheet" type="text/css" href="<?php echo $data['rootUrl']; ?>global/themes/blitzer/jquery-ui-1.9.0.custom.css" />
<link rel="stylesheet" type="text/css" href="<?php echo $data['rootUrl']; ?>global/themes/blitzer/jquery-ui-1.9.0.custom.min.css" />
<script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/jquery-ui-1.8.18.custom.min.js"></script>
<?php
$tarifaonetour = $data["tarifaonetour"];
$data["type_rate"];
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

            <fieldset><legend>General Information</legend>

                <div class="input">
                    <label style="width:150px; display:none;" class="required" id="l_priceadult">Adult Price</label>
                    <input name="priceadult"  type="hidden"  id="priceadult" size="10" maxlength="7"  value="<?php echo $tarifaonetour->priceadult=1.00; ?>" />
                </div>
                
                <div class="input">
                    <label style="width:150px" class="required" id="l_priceadult_WDW">Adult Price WDW</label>
                    <input name="priceadult_WDW" type="text"  id="priceadult_WDW" size="10" maxlength="7"  value="<?php echo $tarifaonetour->priceadult_WDW; ?>" />
                </div>
                
                <div class="input">
                    <label style="width:150px; display:none;" class="required" id="l_pricechild">Children Price</label>
                    <input name="pricechild" type="hidden"  id="pricechild" size="10" maxlength="7"  value="<?php echo $tarifaonetour->pricechild=1.00; ?>" />
                </div>
                
                <div class="input">
                    <label style="width:150px" class="required" id="l_pricechild_WDW">Children Price WDW</label>
                    <input name="pricechild_WDW" type="text"  id="pricechild_WDW" size="10" maxlength="7"  value="<?php echo $tarifaonetour->pricechild_WDW; ?>" />
                </div>
                
                <div class="input">
                    <label style="width:150px" class="required" id="l_priceadult_WATERP">Adult Price WP</label>
                    <input name="priceadult_WATERP" type="text"  id="priceadult_WATERP" size="10" maxlength="7"  value="<?php echo $tarifaonetour->priceadult_WATERP; ?>" />
                </div>
                
                 <div class="input">
                    <label style="width:150px" class="required" id="l_pricechild_WATERP">Children Price WP</label>
                    <input name="pricechild_WATERP" type="text"  id="pricechild_WATERP" size="10" maxlength="7"  value="<?php echo $tarifaonetour->pricechild_WATERP; ?>" />
                </div>
                
                <div class="input">
                    <label style="width:150px" class="required" id="l_priceadult_KENNEDYSPC">Adult Price KSC</label>
                    <input name="priceadult_KENNEDYSPC" type="text"  id="priceadult_KENNEDYSPC" size="10" maxlength="7"  value="<?php echo $tarifaonetour->priceadult_KENNEDYSPC; ?>" />
                </div>
                
                <div class="input">
                    <label style="width:150px" class="required" id="l_pricechild_KENNEDYSPC">Child Price KSC</label>
                    <input name="pricechild_KENNEDYSPC" type="text"  id="pricechild_KENNEDYSPC" size="10" maxlength="7"  value="<?php echo $tarifaonetour->pricechild_KENNEDYSPC; ?>" />
                </div>
                
                
                
                <?php if ($data['type_rate'] == 2) { ?>
                <fieldset>
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
                
                <fieldset>
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
                
                <fieldset>
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
                
                <fieldset>
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
                
                <fieldset>
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
                    <label style="width:150px" class="required" for="type_rate">Type Rates</label>

                    <select name="type_rate" id="type_rate" maxlenght="10" class="select" style=" width:154px;">
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
                if ($data['type_rate'] == 2) {
                    $display = 'block';
                } else {
                    $display = 'none';
                }
                ?>

                <div  class="input" style="display:<?php echo $display; ?>" >
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
                </div>

                <div class="input">
                    <label style="width:150px" class="required" for="annio">Year</label>
                    <input type="number" id="annio" value="<?php echo isset($tarifaonetour->annio)? substr($tarifaonetour->annio,0,4) : date('Y')?>" name="annio">
                </div>
            </fieldset>
        </div>
    </div>
</form>

</div>
<script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/form.js"></script>
<script type="text/javascript">

    $(document).ready(function() {
        $("#trips").multiselect();
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



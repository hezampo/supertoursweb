<link rel="stylesheet" href="<?php echo $data['rootUrl']; ?>global/themes/blitzer/jquery-ui-1.9.0.custom.min.css">

<div id="content_page" >
    <div id="serpare">

        <fieldset><legend>General Information</legend>

            <form id="form1" class="form" action="<?php echo $data['rootUrl']; ?>admin/traffic/buses/save" method="post" name="form1">
                <div class="input">
                    <label style="width:150px" class="required" for="id_fecha_ini">Initial date: </label>
                    <select>
                        <option value="">------</option>
                        <? foreach($data['parques'] as $parque): ?>
                            <option value="<? echo $parque->id; ?>"><? echo $parque->nombre; ?></option>
                        <? endforeach; ?>
                    </select>
                </div>

                <div class="input">
                    <label style="width:150px" class="required" for="id_fecha_ini">Initial date: </label>
                    <input type="date" name="fecha_ini" id="id_fecha_ini"  size="25" maxlength="5"  value=""/>
                </div>

                <div class="input">
                    <label style="width:150px" class="required" for="id_fecha_fin">Final date: </label>
                    <input type="date" name="fecha_fin" id="id_fecha_fin"  size="25" maxlength="5"  value=""/>
                </div>

                <div class="input">
                    <label style="width:150px" class="required" for="id_time_am">Time am: </label>
                    <input type="time" name="time_am" id="id_time_am"  size="25" maxlength="5"  value=""/>
                </div>

                <div class="input">
                    <label style="width:150px" class="required" for="id_time_pm">Time pm: </label>
                    <input type="time" name="time_pm" id="id_time_pm"  size="25" maxlength="5"  value=""/>
                </div>


                <button type="button" id="update_parks">Update parks</button>
            </form>
        </fieldset>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function(){
        $( "#id_fecha_ini" ).datepicker({
            dateFormat:'yy-mm-dd',
            maxDate:   365
        });
        $( "#id_fecha_fin" ).datepicker({
            dateFormat:'yy-mm-dd',
            maxDate:   365
        });
    });
</script>

<style>
    #update_parks{
        margin-left: 250px;
    }
</style>

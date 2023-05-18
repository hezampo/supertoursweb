<?php $driver = $data["driver"];?>

<script src="<?php echo $data['rootUrl']; ?>global/ft/js/jquery.Jcrop.js" type="text/javascript"></script>

<link rel="stylesheet" href="<?php echo $data['rootUrl']; ?>global/ft/css/jquery.Jcrop.css" type="text/css" />
<link rel="stylesheet" type="text/css" href="<?php echo $data['rootUrl']; ?>global/themes/blitzer/jquery-ui-1.9.0.custom.css" />
<link rel="stylesheet" type="text/css" href="<?php echo $data['rootUrl']; ?>global/themes/blitzer/jquery-ui-1.9.0.custom.min.css" />


<style>

    .preview
    {
        background: #fff;

        text-align:center;
        padding:20px;
        margin-bottom:15px;


    }
    #preview
    {
        list-style:none;
        margin:0;
        padding:0;
        width:220px;
        height:180px;
        background: #fff;
    }

    #preview  img {
        width: 180px;
        height:160px;
        vertical-align: middle;
        /*border:1px solid #474747;*/

    }


</style>
<form id="form1" class="form" action="<?php echo $data['rootUrl']; ?>admin/driver/save" method="post" name="form1" enctype="multipart/form-data">
    <div id="header_page" >
        <div class="header2">Driver [ <? echo $data['dato'];?> ]</div>
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
            <fieldset><legend>Informaci&oacuten general</legend>
                <table width="100" border="0">
                    <tr>
                        <td><div style="width:500px;">

                                <div class="input">


                                    <label style="width:150px" class="required" id="firstname_1">Last Name:</label>
                                    <input name="firstname" type="text"  id="firstname" size="25" maxlength="25"  value="<? echo $driver->firstname;?>" />
                                </div>
                                <div class="input">

                                    <label style="width:150px" class="required" id="lastname_1">First Name:</label>
                                    <input name="lastname" type="text"  id="lastname" size="25" maxlength="25"  value="<? echo $driver->lastname;?>" />
                                </div>

                                <div class="input">

                                    <label style="width:150px" class="required" id="phone_1">Phone</label>
                                    <input name="phone" type="text"  id="phone" size="25" maxlength="10"  value="<? echo $driver->phone;?>" />
                                </div>

                                <div class="input">

                                    <label style="width:150px" class="required" id="phone2_1">Phone #2</label>
                                    <input name="phone2" type="text"  id="phone2" size="25" maxlength="10"  value="<? echo $driver->phone2;?>" />
                                </div>


                                <div class="input">

                                    <label style="width:150px" class="required" id="email_1">E-Mail</label>
                                    <input name="email" type="text"  id="email" size="25" maxlength="25"  value="<? echo $driver->email;?>" />
                                </div>

                                <div class="input">

                                    <label style="width:150px" class="required" id="address_1">Address</label>
                                    <input name="address" type="text"  id="address" size="25" maxlength="25"  value="<? echo $driver->address;?>" />
                                </div>

                                <div class="input">

                                    <label style="width:150px" class="required" id="city_1">City</label>
                                    <input name="city" type="text"  id="city" size="25" maxlength="25"  value="<? echo $driver->city;?>" />
                                </div>
                                <div class="input">

                                    <label style="width:150px" class="required" id="zipcode_1">Zip Code</label>
                                    <input name="zipcode" type="text"  id="zipcode" size="25" maxlength="25"  value="<? echo $driver->zipcode;?>" />
                                </div>


                                <div class="input">

                                    <label style="width:150px" class="required" id="licensedriver_1">License</label>
                                    <input name="licensedriver" type="text"  id="licensedriver" size="25" maxlength="25"  value="<? echo $driver->licensedriver;?>" />
                                </div>

                                <div class="input">

                                    <label style="width:150px" class="required" id="l_trip_no">License Type </label>
                                    <select name="licensetype" id="to">

                                    </select>
                                </div>

                                <div class="input">

                                    <label style="width:150px" class="required" id="ssegurity_1">Social Segurity</label>
                                    <input name="ssegurity" type="text"  id="ssegurity" size="25" maxlength="25"  value="<? echo $driver->ssegurity;?>" />
                                </div>

                                <table class="input"><tr><td><label style="width:145px" class="required" id="datehirin_1">Hiring Date:</label></td><td><input name="datehirin" type="text"  id="datehirin" size="10" maxlength="7"  value="<? echo date("m-d-Y",$driver->datehirin);?>" /></td><td> <a href="" id="dataclick1" ><img src="<?php echo $data['rootUrl']; ?>global/images/calendar.png" alt="" width="19" height="20" border="0" /></a></td></tr></tr></table>

                                <table border="0" class="input" ><tr><td><label style="width:145px" class="required" id="datehirinfin_1">Hiring Termination Date</label></td><td><input name="datehirinfin" type="text"  id="datehirinfin" size="10" maxlength="7"  value="<? echo date("m-d-Y",$driver->datehirin);?>"  /></td><td> <a href="" id="dataclick2" ><img src="<?php echo $data['rootUrl']; ?>global/images/calendar.png" alt="" width="19" height="20" border="0" /></a></td></tr></tr></table>

                                <div class="input">

                                    <label style="width:150px" class="required" id="l_price">Reason For Termination</label>
                                    <textarea name="reasotermination" id="reasotermination"  cols="30" rows="5" > <? echo $driver->reasotermination; ?></textarea>
                                </div>

                                <div class="input">
                                    <table border="0" ><tr><td><label style="width:145px" class="required" id="l_price">Health Certificate Expiration Date:</label></td><td><input name="saludfechafin" type="text"  id="saludfechafin" size="10" maxlength="7"  value="<? echo date("m-d-Y",$driver->saludfechafin);?>" /></td><td> <a href="" id="dataclick3" ><img src="<?php echo $data['rootUrl']; ?>global/images/calendar.png" alt="" width="19" height="20" border="0" /></a></td></tr></tr></table>
                                </div>

                                <div class="input">
                                    <label style="width:150px" class="required" id="hiringcompany_1">Hiring Company:</label>
                                    <input name="hiringcompany" type="text"  id="hiringcompany" size="25" maxlength="25"  value="<? echo $driver->hiringcompany; ?>" />
                                </div>

                                <div class="input">
                                    <label style="width:150px" class="required" id="l_price"></label>
                                </div>

                                <div class="input">

                                </div>

                                <input name="id" type="hidden" id="id" value="<? echo $driver->id; ?>" />


                            </div>

                        </div>
</form>  </td>

<td valign="top"  >

</td>
</tr>
</table>
</fieldset>
</div>
</div>

<div id="con"></div>






<script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/form.js"></script>
<script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/jquery.form.js"></script>

<script type="text/javascript">

    $(document).ready(function() {

    });


    $( "#datehirin" ).datepicker({
        dateFormat:'mm-dd-yy',
        changeMonth: true,
        changeYear: true
    });
    $( "#datehirinfin" ).datepicker({
        dateFormat:'mm-dd-yy',
        changeMonth: true,
        changeYear: true
    });

    $( "#saludfechafin" ).datepicker({
        dateFormat:'mm-dd-yy',
        changeMonth: true,
        changeYear: true
    });



    $("#dataclick1").click(function(e) {

        e.preventDefault();

        $("#datehirin").datepicker("show");



    });
    $("#dataclick2").click(function(e) {



        e.preventDefault();



        $("#datehirinfin").datepicker("show");



    });

    $("#dataclick3").click(function(e) {



        e.preventDefault();



        $("#saludfechafin").datepicker("show");



    });
    function validateForm(){

        var sErrMsg = "";
        var flag = true;

        sErrMsg += validateText($('#firstname').val(), $('#firstname_1').html(), true);
        sErrMsg += validateText($('#lastname').val(),$('#lastname_1').html() , true);
        sErrMsg += validateText($('#phone').val(),$('#phone_1').html() , true);
        sErrMsg += validateText($('#phone2').val(),$('#phone2_1').html() , true);
        sErrMsg += validateText($('#email').val(),$('#email_1').html() , true);
        sErrMsg += validateText($('#address').val(),$('#address_1').html() , true);
        sErrMsg += validateText($('#city').val(),$('#city_1').html() , true);
        sErrMsg += validateText($('#zipcode').val(),$('#zipcode_1').html() , true);
        sErrMsg += validateText($('#licensedriver').val(),$('#licensedriver_1').html() , true);
        sErrMsg += validateText($('#ssegurity').val(),$('#ssegurity_1').html() , true);
        sErrMsg += validateText($('#datehirin').val(),$('#datehirin_1').html() , true);
        sErrMsg += validateText($('#datehirinfin').val(),$('#datehirinfin_1').html() , true);
        sErrMsg += validateText($('#hiringcompany').val(),$('#hiringcompany_1').html() , true);
        if(sErrMsg != "")
        {
            alert(sErrMsg);
            flag = false;
        }

        return flag;

    }

    $('#btn-save').click(function(){
        if (validateForm()){
            //validar();
            $('#form1').submit();
        }
    })

    $('#btn-cancel').click(function(){
        window.location = '<?php echo $data['rootUrl']; ?>admin/driver';
    })

</script>

  
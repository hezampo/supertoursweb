<script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/jquery-ui.min.js"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>

<script>


$(document).ready(function() {		
	
      $('#btn-signup').click(function(){
		  
		  if(!validateForm()){
			  return false;
		  }
		  
           var dato = $('#forma').serialize(); 
           $('#forma').find('input').attr('readonly','readonly'); 
            $('#forma').find('input').attr('disable','disable'); 
           $.ajax({
		type:'POST',
		url:'<?php echo $data['rootUrl']; ?>agency/register',
		data:dato,
		dataType: 'html',
		success:function(data){
          
                     $( "#dialog-confirm").attr("title","registration agency"); 
                     $( "#dialog-confirm").html(data);
		     $( "#dialog-confirm" ).dialog({
                        resizable: false,
                        height:140,
                        modal: true,
                        buttons: {
                        "OK": function() {
                          $( this ).dialog( "close" );
                        },
                      }
                     });		
               	   $("#mascaraP").hide("fade");
                   $("#popupModal").hide("fade");
		}
	  }); 
      });
       
        $('#btn-cancel').click(function(){
       	   $("#mascaraP").hide("fade");
	   $("#popupModal").hide("fade");
       });

	   
$('#defaultReal').realperson(); 
 
$('#disableReal').toggle(function() { 
        $(this).text('Enable'); 
        $('#defaultReal').realperson('disable'); 
    }, 
    function() { 
        $(this).text('Disable'); 
        $('#defaultReal').realperson('enable'); 
    } 
); 
 
$('#removeReal').toggle(function() { 
        $(this).text('Re-attach'); 
        $('#defaultReal').realperson('destroy'); 
    }, 
    function() { 
        $(this).text('Remove'); 
        $('#defaultReal').realperson(); 
    } 
);

});

 function DrawCaptcha()
    {
        var a = Math.ceil(Math.random() * 10)+ '';
        var b = Math.ceil(Math.random() * 10)+ '';       
        var c = Math.ceil(Math.random() * 10)+ '';  
        var d = Math.ceil(Math.random() * 10)+ '';  
        var e = Math.ceil(Math.random() * 10)+ '';  
        var code = a + ' ' + b + ' ' + ' ' + c + ' ' + d + ' ' + e;
        document.getElementById("txtCaptcha").value = code
    }
	DrawCaptcha();

    // Validate the Entered input aganist the generated security code function   
    function ValidCaptcha(){
        var str1 = removeSpaces(document.getElementById('txtCaptcha').value);
        var str2 = removeSpaces(document.getElementById('txtInput').value);
        if (str1 == str2) return true;        
        return false;
        
    }

    // Remove the spaces from the entered and generated code
    function removeSpaces(string)
    {
        return string.split(' ').join('');
    }
	//DrawCaptcha();
    

</script>
<style>
body{
font-family:"Lucida Grande", "Lucida Sans Unicode", Verdana, Arial, Helvetica, sans-serif;
font-size:12px;
}
p, h1, form, button{border:0; margin:0; padding:0;}
.spacer{clear:both; height:1px;}
/* ----------- My Form ----------- */
.myform{
margin:0 auto;
width:745px;
padding:14px;
border-radius: 4px 4px 4px 4px;
-moz-border-radius: 4px 4px 4px 4px;
-webkit-border-radius: 4px 4px 4px 4px;
}
.columna-derecha{
    float:left;
    width:245px;
    }
   
.columna-izquierda{
    text-align:left;
    margin-right:5px;
    padding-right:4px;
    border-right:1px solid #000;
    float:left;
    width:245px;
    }
/* ----------- stylized ----------- */
#stylized{
border:solid 2px #b7ddf2;
background:#ebf4fb;
}
#stylized h1 {
font-size:14px;
font-weight:bold;
margin-bottom:8px;
}
#stylized p{
font-size:11px;
color:#666666;
margin-bottom:20px;
border-bottom:solid 1px #b7ddf2;
padding-bottom:10px;
}
#stylized label{
display:block;
font-weight:bold;
text-align:right;
width:160px;
float:left;
}
#stylized .small{
color:#666666;
display:block;
font-size:11px;
font-weight:normal;
text-align:right;
width:140px;
}
#stylized input[type=text]{
float:left;
font-size:12px;
padding:4px 2px;
border:solid 1px #aacfe4;
width:200px;
margin:2px 0 20px 10px;
}

#stylized select{
float:left;
font-size:10px;
padding:3px 2px;
border:solid 1px #aacfe4;
width:200px;
margin:2px 0 20px 10px;
}

#stylized button{
clear:both;
margin-left:20%;
width:125px;
height:31px;
background:#666666 url(img/button.png) no-repeat;
text-align:center;
line-height:31px;
color:#FFFFFF;
font-size:11px;
font-weight:bold;
}
</style>
   
<div id="dialog-confirm" title="Empty the recycle bin?" style="display:none;" >
    <p><span class="ui-icon ui-icon-alert" style="float: left; margin: 0 7px 20px 0;"></span>These items will be permanently deleted and cannot be recovered. Are you sure?</p>
</div>

    <div id="stylized" class="myform">
    <form id="forma" action="<?php echo $data['rootUrl']; ?>admin/agency/signup" method="post" name="form1">
      
        <div id="columna-derecha">    
          
              <h1>Register Company</h1>
              <p></p>
            
             <div >
                <label style="width:150px" class="required" id="company_namee">Company Name: </label>
                <input type="text" name="company_name" id="company_name"  size="25" maxlength="20"  value=""/>
            </div>
              
            <div >
                <label style="width:150px" class="required" id="addresss">Address: </label>
                <input type="text" name="address" id="address"  size="25" maxlength="20"  value=""/>
            </div>
              
            <div >
                <label style="width:150px" class="required" id="cityy">City: </label>
                <input type="text" name="city" id="city"  size="25" maxlength="20"  value=""/>
            </div>
          
         
           <div >
                <label style="width:150px" class="required" id="zip_codee">Zip Code: </label>
                <input name="zipcode" type="text"  id="zipcode" size="5" maxlength="20"  value="" />
            </div>
               
       </div> 
       <div id="columna-izquierda">      
            <div >
                <label style="width:150px" class="required" id="phone11">Phone 1</label>
                <input name="phone1" type="text"  id="phone1" size="15" maxlength="15" value="" />
            </div> 
           <div >
                <label style="width:150px" class="required" id="phone22">Phone 2</label>
                <input name="phone2" type="text"  id="phone2" size="15" maxlength="15" value="" />
            </div> 
            
                <div >
                
                <label style="width:150px" class="required" id="faxx">Fax: </label>
                <input name="fax" type="text"  id="fax" size="25" maxlength="25"  value="" />
            </div> 
           <div >
                <label style="width:150px" class="required" id="main_emaill">E-Mail: </label>
                <input name="main_email" type="text"  id="main_email" size="25" maxlength="25"  value=""/>
            </div> 
              
             <div >
                <label style="width:150px" class="required" id="web_pagee">Web Page: </label>
                <input name="web_page" type="text"  id="web_page" size="25" maxlength="25"  value="" />
            </div> 
              
            <div >
                <label style="width:150px" class="required" id="person_chargee">Contact Person: </label>
                <input name="person_charge" type="text"  id="person_charge" size="25" maxlength="25"  value="" />
            </div>
              
            <div >
                <label style="width:152px" class="required" id="statee">State: </label>
                <select name="state" id="state" class="select" style="width:200px; height:23px;">
                  <option value=""></option>  
                  <?php foreach($data["state"] as $e):?>
                        <option value="<?php echo  $e['name']; ?>" ><?php echo $e["name"]; ?></option>
                   <?php endforeach;?>
                </select>
            </div>
              
            <div  >
                <label style="width:152px" class="required" id="l_phone">Country: </label>
                <select name="country" id="country" class="select" style="width:200px; height:23px;">
                  <option value=""></option>  
                  <?php foreach($data["country"] as $e):?>
                        <option value="<?php echo  $e['name']; ?>" ><?php echo $e["name"]; ?></option>
                   <?php endforeach;?>
                </select>
            </div>      
           <div>  
      </div>
			<div align="center">
            <table border="0" width="100%" align="center">
<tr>
    <td colspan="6" align="center">
        <label style="width:100%; text-align:center">Enter the verification code</label>
    </td>
</tr>
<tr>
	<td width="30%">&nbsp;</td>
    <td valign="middle">
        <input type="text" id="txtCaptcha" 
            style="background-image:url(1.jpg); text-align:center; border:none;
            font-weight:bold; font-family:Modern;" readonly="readonly" disabled="disabled" />
            </td>
            <td valign="top">
        <input type="button" id="Change" value="change" onclick="DrawCaptcha();" />
    </td>

    <td valign="middle">
        <input type="text" id="txtInput"/>    
    </td>
    <td width="30%">&nbsp;</td>
</tr>
</table>
            </div>
            <div>
             <button   class="btn" id="btn-cancel" type="button">Cancel</button>
             <button  class="btn" id="btn-signup" type="button" >
                 Sign up
             </button>
            </div>
     

       
        </div>

    </form>
<div id="ajax"></div>
</div>
<script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/form.js"></script>
<script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/jquery.maskedinput.js"></script>
<script type="text/javascript">
        
			  
		  $("#phone1").mask("(999) 999-9999");
		  $("#phone2").mask("(999) 999-9999");
		  $("#phone").mask("(999) 999-9999");

	
    function validateForm(){

        var sErrMsg = "";
        var flag = true;
	
		

        sErrMsg += validateText($('#company_name').val(), $('#company_namee').html(), true);
        sErrMsg += validateText($('#address').val(), $('#addresss').html(), true);
		sErrMsg += validateText($('#city').val(), $('#cityy').html(), true);
		sErrMsg += validateText($('#zipcode').val(), $('#zip_codee').html(), true);
		
		
		sErrMsg += validateText($('#fax').val(), $('#faxx').html(), true);
		
		
		
		sErrMsg += validateText($('#web_page').val(), $('#web_pagee').html(), true);
		//////////////////////////////
		
		//////////////////////////
			
		sErrMsg += validateText($('#person_charge').val(), $('#person_chargee').html(), true);
		
		sErrMsg += validateEmail($('#main_email').val(), $('#main_emaill').html(), true);
		
		sErrMsg += validateText($('#txtInput').val(), 'Verification code', true);
		
		if($('#txtInput').val() != ''){
			if(!ValidCaptcha()){
				sErrMsg += '- Incorrect verification code\n';
			}
		}
		
		
		
		if(sErrMsg != "")
		 {
            alert(sErrMsg);
            flag = false;
         }

        return flag;

    }
   
</script>



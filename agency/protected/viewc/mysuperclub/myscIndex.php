<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Supertours Of Orlando, Inc.</title>
<meta NAME="Title" CONTENT="Super Tours Of Orlando - Transportations Florida">
<meta NAME="Author" CONTENT=" Super Tours Of Orlando ">
<meta NAME="Subject" CONTENT=" Transportations Miami  Orlando - ">
<meta NAME="Description" CONTENT=" Bus Tickets through Florida: luxury bus from  Miami to Orlando  , Orlando to ,  Ft.Lauderdale Airport, Fort Pierce , Hollywood (Sheridan), Hialeah , Kendall , Miami Airport , Miami Beach Central , Miami Downtown, Miami Beach North , Pompano , Miami Beach South , West Palm Beach, tours of Orlando from Miami , leader transportations 1989">
<meta NAME="Keywords" CONTENT=" Bus Tickets  Florida, Transportations Miami to Orlando , Transportations Orlando  to Miami , transportations florida, tours , florida tours , miami , travel florida , vacations florida , destinations florida, travel agents florida , Ft.Lauderdale Airport, Fort Pierce , Hollywood (Sheridan), Hialeah , Kendall , Miami Airport , Miami Beach Central , Miami Downtown, Miami Beach North , Pompano , Miami Beach South , West Palm Beach , leader transportations ">
<meta NAME="Language" CONTENT="English">
<meta NAME="Revisit" CONTENT="1 day">
<meta NAME="Distribution" CONTENT="Global">
<meta NAME="Robots" CONTENT="All">
<link href="<?php echo $data['rootUrl']; ?>global/styles.css" rel="stylesheet" type="text/css" />
<link href="<?php echo $data['rootUrl']; ?>global/css/style.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="<?php echo $data['rootUrl']; ?>global/js/themes/base/jquery.ui.all.css">
<link rel="stylesheet" href="<?php echo $data['rootUrl']; ?>global/css/nav.css">
<link rel="stylesheet" href="<?php echo $data['rootUrl']; ?>global/css/mysuperclub.css">
<link rel="stylesheet" href="<?php echo $data['rootUrl']; ?>global/css/jquery-ui.css">
<link rel="stylesheet" href="<?php echo $data['rootUrl']; ?>global/css/jquery-ui2.css">
<link rel="stylesheet" type="text/css" href="<?php echo $data['rootUrl']; ?>global/css/blitzer/jquery-ui-1.8.16.custom.css" />

<script src="<?php echo $data['rootUrl']; ?>global/js/jquery-1.6.4.min.js" type="text/JavaScript"></script>
<script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/jquery-ui-1.8.18.custom.min.js"></script>
<script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/jquery.min2.js"></script>
<script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/jquery-ui.min2.js"></script>
<script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/booking.js"></script>
<script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/jquery_timer.js"></script>
<script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/form.js"></script>
<script type="text/javascript">

$(document).ready(function() {		
	
	$("#tabs").tabs();
	
	var dias = <?php echo $this->data["days"]?>;
	var horas = <?php echo $this->data["hours"]?>;
	var minutos = <?php echo $this->data["minutes"]?>;
	var segundos = <?php echo $this->data["seconds"]?>;
					
    contador();
                    
    function contador(){
     	$.timer(1000, function(){ 
     		if(segundos==0){
	    		$("#segundos").html(segundos);
								
        		if(minutos==0){
        			if(horas==0){
						//si es el dia de cumpleaños.
            			return;
            		}    		
            		horas-=1;
            		minutos=60;
            		$("#horas").html(horas);
       			}
       			minutos-=1;
       			segundos=60
       			$("#minutos").html(minutos);
    		}
    		segundos-=1;
    		$("#segundos").html(segundos);						
       });	
 	}
	
	<?php $user = unserialize($_SESSION["user"]) ?>
		
	//muestra la lista de rewards.
	<?php if($user->left_points>0){ ?>
		$("#exchange_rewards").css("display","block");
		var left_points = <?php echo $user->left_points ?>;
     	$("#rewards_list").load('<?php echo $data['rootUrl']; ?>mysuperclub/getRewards/'+ left_points);		
	<?php }?>
	
	$("#rewards_list").change(function(){	
		var num = $('#rewards_list option:selected').attr("id");
		num = Math.round(num);
		$("#rewards_ammount").load('<?php echo $data['rootUrl']; ?>mysuperclub/getReward/'+ num);
	});
	
	//lista de bonos
	<?php if($this->data["cliente_bono"]) { ?>
		$("#bonos_info").css("display","block");
		$("#bonos_list").load('<?php echo $data['rootUrl']; ?>mysuperclub/exchanged');
	<?php } ?>
	
	//crea un bono de cumpleaños cuando llegue a la fecha.
	<?php if($user->birthday = time("Y-m-d") && $this->data["reward"] >= 10){ ?>
		$("#nombre").val('birthday');
		$("#regla").val("birthday");
		$("#frm_rewards2").submit();
    <?php }else{ ?>
		$("#mensage").html("Today is your birthday but...");
		$("#mensage").append("You don't have enough trips.");
	<?php } ?>
	
	//crea un bono cada 10 tips.
	<?php if($this->data["reward"] >= 10){ ?>
   		$("#nombre").val('trip');
		$("#regla").val("trip");
		$("#frm_rewards2").submit();
    <?php }?>

	//exchange the current rewards.
	$("#btn_exchange").click(function(){
		
		$("#reward_points").val($('#rewards_list option:selected').attr("value"));
		$("#ram").val($('#ra option:selected').attr("value"));
		$("#nombre").val($('#rewards_list option:selected').text());
		$("#regla").val("points");
		$("#ammount_discount").val($('#rewards_list option:selected').attr("ammount"));
		
		var total_ammount = parseInt($("#reward_points").val()) * parseInt($("#ra").val());
		$("#total_ammount").val(total_ammount);
		
		var discount = parseInt($("#ra").val()) * parseFloat($('#ammount_discount').val());
		$("#discount").val(discount);
		
		$("#frm_rewards2").submit();
	});	
	
	$(".ofers").click(function(){				
		
		from = $(this).attr("from");
		to = $(this).attr("to");
		trip = $(this).attr("trip");
		inicio = $(this).attr("inicio");
		fin = $(this).attr("fin");
		
		var date = new Date(inicio*1000);
		var iyear = date.getFullYear();
     	var imonth = date.getMonth();
		var iday = date.getDay();
		
		var date = new Date(fin*1000);
		var fyear = date.getFullYear();
     	var fmonth = date.getMonth();
		var fday = date.getDay();
		
		if(fday < 10 ){fday = "0"+fday}
		if(iday < 10 ){iday = "0"+iday}
		
		if(fmonth < 10 ){fmonth = "0"+fmonth}
		if(imonth < 10 ){imonth = "0"+imonth} 
		
		$("#fromt").val(from);
		$("#to").val(to);
		$("#fecha_salida").val(iday+"-"+imonth+"-"+iyear);
		$("#fecha_retorno").val(fday+"-"+fmonth+"-"+fyear);
		$("#form1").submit();
	});
	
	var value = true;
	
	$("#btn_save").click(function(){
		
		//validar password
		if($("#cpassword").val() == $("#password").val()){
			$(document).ready(function(){
        		$("#frm_client").find(':input').each(function() {
			 		if($(this).attr("type") != "hidden"){
						if($(this).val() == ""){
					 		//$(this).addClass('notFilled');
							alert($(this).attr("name")+" is required!");
							value = false;
							return value;
				 		}else{
							value = true;
						}
			 		}
        		});
       		});
		
			if(value == true){
				$("#frm_client").submit();
			}
		}else{
			alert("Passwords not match");
		}
	});
});
</script>
</head>

<body>
<div id="contenedor">
<div id="header">
  <div id="logo"><a href="<?php echo $data['rootUrl']; ?>"><img src="<?php echo $data['rootUrl']; ?>global/images/logo.png" width="316" height="119" border="0" /></a></div>
  <div style="display:inline; float:right;">
                <a class="home img-link" href="<?php echo $data['rootUrl']; ?>" id="home">Home</a>
     <?php if(isset($_SESSION['user'])){ ?>          
      <a class="logout img-link" href="<?php echo $data['rootUrl']; ?>close/session">Cerrar Session</a>
     <?php } ?>
   </div>
  <div id="redes">
    <div id="iconos">
      <div id="redesGo"></div>
      <div id="redesGo"><a href="https://www.facebook.com/pages/Supertours-of-Orlando/157301064337315" target="_blank"><img src="<?php echo $data['rootUrl']; ?>global/images/Icon-facebook-Colombia.png"  border="0" /></a></div>
      <div id="redesGo"><a href="<?php echo $data['rootUrl']; ?>contact-us-supertours"><img src="<?php echo $data['rootUrl']; ?>global/images/Icon-gmail-Colombia.png"  border="0" /></a></div>
    </div>
    <div class="textosHead" >Toll Free <b> 1-800-251-4206 </b>- Open <br />
      From 4 am To Midnight - (Eastern Time) <br />
      <strong>Hablamos Español</strong> </div>
  </div>
</div>
<div id="barra">
<?php
	include_once('global/menu/menu1.php');?>
    </div>
<div id="policy">
<div id="contendinfo">
  <div id="mapmarcohome">
    <div id="contenido"> 
      <!-- contenido principal -->
      <div id="side1_2">
        <div id="myaccount">
          <div id="title">My Account</div>
          <div id="user_welcome">Welcome,<span><b><?php echo strtoupper($user->firstname) ?></b></span> you are a member of SUPERCLUB!</div>
          <div id="fp">Frequent Passenger #<span><b><?php echo $user->id ?></b></span></div>
        </div>
        <div id="reserves">
          <div id="tabs">
            <ul>
              <li><a href="#reservations" onclick="javascript:window.location.replace('#reservations')";><span>My Reservations</span></a></li>
              <li><a href="#account" onclick="javascript:window.location.replace('#account')";><span>Account Summary</span></a></li>
            </ul>
            
            <!-- Trips Information TAB -->
            <div id="reservations">
              <div class="trips">
                <table width="100%" border="0">
                  <tr>
                    <th width="59" align="center">Date</th>
                    <th width="159" align="center">Confirmation Number</th>
                    <th width="93" align="center">Trip Number</th>
                    <th width="71" align="center">Points</th>
                  </tr>
                  <?php 
				$color ='';
				foreach($data["trips"] as $trip){
					$color == ''  ? $color =  'row_color' : $color = '';
				?>
                  <tr id="trips_info" class="<?php echo $color; ?>">
                    <td align="center"><?php echo $trip["fecha_ini"];?></td>
                    <td align="center"><?php echo $trip["codconf"];?></td>
                    <td align="center"><?php echo $trip["trip_no"];?></td>
                    <td align="center"><?php echo (int)$trip["total_reserva"];?></td>
                  </tr>
                  <?php } ?>
                </table>
              </div>
              <div>
                <table  width="100%" border="0">
                  <tr>
                    <td align="right">Total Points: <?php echo $user->points ?></td>
                  </tr>
                  <tr>
                    <td align="right">Paid with Points: <?php echo $user->paid_points ?></td>
                  </tr>
                  <tr>
                    <td align="right"><b>Left Points: <?php echo $user->left_points ?></b></td>
                  </tr>
                </table>
              </div>
              <form id="frm_rewards2" name="frm_rewards2" action="<?php echo $data['rootUrl']?>mysuperclub/getBono" method="POST">
                <input type="hidden" id="reward_points" name="reward_points"/>
                <input type="hidden" id="nombre" name="nombre"/>
                <input type="hidden" id="ram" name="ram"/>
                <input type="hidden" id="total_ammount" name="total_ammount"/>
                <input type="hidden" id="discount" name="discount"/>
                <input type="hidden" id="regla" name="regla"/>
                <input type="hidden" id="ammount_discount" name="ammount_discount"/>
              </form>
              <div id="exchange_rewards">
                <table width="100%" border="0">
                  <tr>
                    <td colspan="2"><div>You have rewards to change!</div></td>
                  </tr>
                  <tr>
                    <td width="27%" align="right"><div id="rewards_list"></div></td>
                    <td width="73%" align="right"><div id="rewards_ammount"></div></td>
                  </tr>
                  <tr>
                    <td colspan="2" align="center"><div id="d_excgange" class="mybutton3"><a id="btn_exchange" href="#">Exchange!</a></div></td>
                  </tr>
                </table>
              </div>
            </div>
            
            <!-- Account Information TAB -->
            <div id="account">
              <div id="account_owner_info"><img src=""/>Account Owner Information</div>
              <div id="client_form">
                <form id="frm_client" name="frm_client" action="<?php echo $this->data["rootUrl"]?>mysuperclub/save" method="POST" >
                  <input type="hidden" id="username" name="username" value="<?php echo $user->username ?>" />
                  <input type="hidden" id="birthday" name="birthday" value="<?php echo $user->birthday ?>" />
                  <input type="hidden" id="id" name="id" value="<?php echo $user->id ?>" />
                  <table width="100%">
                    <tr>
                      <td><label for="password" style="width:150px" id="l_password">Password</label></td>
                      <td><input type="password"  required="on" myname="Password" minlength="7" name="password" id="cpassword"  size="25" maxlength="20"  value=""  /></td>
                    </tr>
                    <tr>
                      <td><label style="width:150px" id="l_password2">Confirm password</label></td>
                      <td><input type="password" required="on" name="password2" id="password"  size="25" maxlength="20"  value=""/></td>
                    </tr>
                    <tr>
                      <td><label style="width:150px" id="l_firstname">Firts Name</label></td>
                      <td><input type="text" required="on" name="firstname" id="firstname" size="25" maxlength="20" value="<?php echo $user->firstname ?>"/></td>
                    </tr>
                    <tr>
                      <td><label style="width:150px" id="l_lastname">Last Name</label></td>
                      <td><input name="lastname" required="on" type="text"  id="lastname" size="25" maxlength="20"  value="<?php echo $user->lastname ?>" /></td>
                    </tr>
                    <tr>
                      <td><label style="width:150px" id="l_phone">Phone</label></td>
                      <td><input name="phone" required="on" type="text"  id="phone" size="20" maxlength="20"  value="<?php echo $user->phone ?>" /></td>
                    </tr>
                    <tr>
                      <td><label style="width:150px"id="l_celphone">Cel Phone</label></td>
                      <td><input name="celphone" required="on" type="text"  id="celphone" size="20" maxlength="20"  value="<?php echo $user->celphone ?>" /></td>
                    </tr>
                    <tr>
                      <td><label style="width:150px" id="l_city">City</label></td>
                      <td><input name="city" required="on" type="text"  id="city" size="25" maxlength="25"  value="<?php echo $user->city ?>"/></td>
                    </tr>
                    <tr>
                      <td><label style="width:150px" id="l_state">State</label></td>
                      <td><select name="state" id="state">
                          <?php foreach ($data["state"] as $e){ ?>
                          <option value="<?php echo $e['name']; ?>"  <?php echo ($user->state == trim($e['name']) ? 'selected' : ''); ?>><?php echo $e["name"]; ?></option>
                          <?php } ?>
                        </select></td>
                    </tr>
                    <tr>
                      <td><label style="width:150px" id="l_country">Country</label></td>
                      <td><select name="country" id="country">
                          <?php foreach ($data["country"] as $e) {?>
                          <option value="<?php echo $e['name']; ?>"  <?php echo ($user->country == trim($e['name']) ? 'selected' : ''); ?>><?php echo $e["name"]; ?></option>
                          <?php } ?>
                        </select></td>
                    </tr>
                    <tr>
                      <td><label style="width:150px" id="l_address">Address</label></td>
                      <td><input name="address" required="on" type="text"  id="address" size="25" maxlength="25"  value="<?php echo $user->address; ?>"/></td>
                    </tr>
                    <tr align="center" valign="middle">
                      <td colspan="2" valign="bottom">
                        <span>
                        <div id="1" class="mybutton2"><a id="btn_save">Save</a></div>
                        </span>
                    </tr>
                  </table>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
      
      <!-- side 2 -->
      <div id="side2_2">
        <div id="birthday">
          <ul>
            <li>
              <div id="dias" class="myinput"><?php echo $this->data["days"]?></div>
            </li>
            <li>
              <div id="horas" class="myinput"><?php echo $this->data["hours"]?></div>
            </li>
            <li>
              <div id="minutos" class="myinput"><?php echo $this->data["minutes"]?></div>
            </li>
            <li style="display:none">
              <div id="segundos" class="myinput"><?php echo $this->data["seconds"]?></div>
            </li>
          </ul>
        </div>
        <div id="bonos_info">
          <div id="bonos">
            <div>Now you have Rewards. Sele one to redeem!</div>
            <div id="bonos_list"></div>
            <div id="formularioH" style="display:none">
              <form action="<?php echo $data['rootUrl']; ?>questions" method="POST" id="form1" name="form1">
                <input name="tipo_ticket" type="radio" value="roundtrip" id="rd" checked  />
                <input name="tipo_ticket" type="radio" value="oneway" id="ow"  />
                <input name="fromt" id="from" value="1">
                <input name="tot" id="to" value="9">
                <input name="fecha_salida" size="20" maxlength="10" class="input-text" id="fecha_salida" readonly="readonly" value="<?php echo date("m-d-Y")?>"/>
                <input name="fecha_retorno" size="20" maxlength="10" class="input-text" id="fecha_retorno" readonly="readonly"  value="<?php echo date('m-d-Y',time()+84600);?>"/>
                <input name="pax" size="2" maxlength="5" class="input-text" id="pax" value="1" />
                <input name="pax2" size="2" maxlength="5" class="input-text" id="pax2"  value="0"/>
              </form>
            </div>
          </div>
        </div>
        <div id="todays_deals">
          <div class="deals_tittle" id="first">Deals of day</div>
          <div class="deals_tittle"><?php echo date("d")." of ".date("M"); ?></div>
          <div id="ofertas">
            <?php foreach($this->data["ofertas"] as $oferta){ ?>
            <div>
              <a href="#" 
              		class="ofers" 
                    from="<?php echo $oferta["trip_from_id"] ?>" 
                    to="<?php echo $oferta["trip_to_id"] ?>" 
                    trip="<?php echo $oferta["trip_no"] ?>"
                    inicio = "<?php echo $oferta["fecha_ini"] ?>" 
                    fin = "<?php echo $oferta["fecha_fin"] ?>" >
			  	<?php echo $oferta["trip_from"]." to ".$oferta["trip_to"]." #". $oferta["trip_no"] ." $".$oferta["price2"];?>
              </a>
            </div>
            <?php } ?>
          </div>
        </div>
      </div>
      <div id="mensage" style="display:none"></div>
      <!-- fin side 2 --> 
      
      <!-- contenido principal --> 
    </div>
  </div>
  <div id="foot">
    <h4>Home   |   Our Company  |   My Superclub  |   Tickets Policy   &nbsp;|&nbsp;Baggage   | © 2012 Super Tours of Orlando Inc.<br />
      Copyright ©  1989 - 2012 Supertours Of  Orlando, INC . All Rights Reserved. </h4>
  </div>
</div>
<script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/booking.js"></script> 
<script src="<?php echo $data['rootUrl']; ?>global/js/modernizr.js"></script> 
<script>
(function($){
				
				//cache nav
				var nav = $("#topNav");
				
				//add indicator and hovers to submenu parents
				nav.find("li").each(function() {
					if ($(this).find("ul").length > 0) {
						$("<span>").text("^").appendTo($(this).children(":first"));

						//show subnav on hover
						$(this).mouseenter(function() {
							$(this).find("ul").stop(true, true).slideDown();
						});
						
						//hide submenus on exit
						$(this).mouseleave(function() {
							$(this).find("ul").stop(true, true).slideUp();
						});
					}
				});
			})(jQuery);
 
   $("#from").change(function(){
         
         var id = $("#from").val();
         
         if (id != "")
             $("#to").load(encodeURI('<?php echo $data['rootUrl']; ?>load/' + id));
     });
	     
         var id = $("#from").val();
         
         if (id != "")
             $("#to").load(encodeURI('<?php echo $data['rootUrl']; ?>load/' + id));
        </script> 
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-33124456-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
</body>
</html>
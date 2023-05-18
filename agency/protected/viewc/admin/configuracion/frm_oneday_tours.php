<html>
    <head>
        <!-- Estilos y importaciones de javascript-->
        <link rel="stylesheet" type="text/css" href="<?php echo $data['rootUrl']; ?>global/css/panel.css" />
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">
        
        <link rel="stylesheet" type="text/css" href="<?php echo $data['rootUrl']; ?>global/css/autocompletar/css/style.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo $data['rootUrl']; ?>global/css/jquery.notice2.css"/>
        <link rel="stylesheet" type="text/css" href="<?php echo $data['rootUrl']; ?>global/css/modal.css"/>

        <link rel="stylesheet" type="text/css" href="<?php echo $data['rootUrl']; ?>global/css/blitzer/jquery-ui-1.8.16.custom.css" />
        <link rel="stylesheet" href="<?php echo $data['rootUrl']; ?>global/themes/blitzer/jquery-ui-1.9.0.custom.min.css">

        <script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/menubar/js/menu.js"></script>
        <script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/jquery.notice.js"></script>
        <script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/jquery.ausu-autosuggest.js"></script>
        <script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/Concurrent.Thread.js"></script>

        <script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/form.js"></script>

        <script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/jquery-ui-1.8.18.custom.min.js"></script>
        <script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/booking.js"></script>

        <script type="text/javascript" src="<?php echo $data['rootUrl']; ?>global/js/jquery.timeentry.js"></script>


        
       
        
<!--        <script type="text/javascript">
            
            var bPreguntar = true;

            window.onbeforeunload = preguntarAntesDeSalir;
            
            
            function preguntarAntesDeSalir(){
                
                if (bPreguntar === true){
                    
                    $("#puestosEnUso").load("<?php echo $data['rootUrl']; ?>admin/reservas/ocuparPuestoUsuario/4");
                    return "Salir de la ventana o actualizarla, generara un nuevo codigo de reserva.";
                }
                    
                
            }           
           
        </script>-->
        
        
        <script type="text/javascript">
    
    var bPreguntar = true;

    //window.onbeforeunload = preguntarAntesDeSalir;

    function preguntarAntesDeSalir()
    {
        if (bPreguntar === true){
            $("#puestosEnUso").load("<?php echo $data['rootUrl']; ?>admin/reservas/ocuparPuestoUsuario/4");
            return "Salir de la ventana o actualizarla, generara un nuevo codigo de reserva."; 
        }
            
    }
    

    
</script>
        
    </head>
    <body>
        <?php if (isset($_GET['menssage'])) { ?>
            <div class="success"><?php echo $_GET['menssage']; ?></div>
        <?php } ?>
        <?php if (isset($_GET['error'])) { ?>
            <div class="error"><?php echo $_GET['error']; ?></div>
        <?php } ?>
            
        <?php 
        
        $fecha_hoy = date("Y-m-d");
        $dias= 1; // los días a restar 
        $fecha_ayer =  date("Y-m-d", strtotime("$fecha_hoy - $dias day"));  
        Doo::db()->query("DELETE FROM  reservas_trip_puestos WHERE fecha_trip <= '$fecha_ayer'");
        
        //destruimos variable de session Multiday
        //unset($_SESSION['code_conf']);
        //destruimos variable de session Transportation
        //unset($_SESSION['codconf']);

        $id_usuario = $login->id;
        Doo::db()->query("UPDATE reservas_trip_puestos SET estado = 'CANCELED' WHERE usuario ='$id_usuario' AND estado = 'USING'");

        
        ?>
            
        <!--    background-image: url('<?php /*echo $data['rootUrl'] */?>global/img/bg2.jpg');-->

        <div class="catsandstars" id="header_page" style="height: 67px;">
            <div class="header">
                <table style="width:500px;" border="0">
                    <tr>                        
                        <td width="40%"><h6 class='stroke' style="width:362px; margin-top:4px; margin-left:-56px; color:#0B55C4; text-shadow: 1px 4px #999; font-size:33px; font-weight:normal; text-align:center; font-family:Impact;">One Day Tours New</h6></td>   
                        <td>&nbsp;</td>
                        <td width="10%" style="padding:5px;"><div id="mensajeTrip" class="temporizador"></div></td>
                        <div id="dialog-trip-pregunta" title="Estas seguro de cancelar este Tour?" style="display:none">
                            <p>
                                <div id="reloj_temporizador" class="temporizador"></div>
                                <div id="mensaje_trips_pregunta"></div>
                            </p>
                        </div>
                    </tr>
                </table>
            </div>
            <div  id="toolbar">
                <div class="toolbar-list">
                    <ul>
  
                    </ul>
                    <div class="clear"></div>
                </div>
                <div class="clear"></div>
            </div>
        </div>
            
        
            
        <!-- header options background-image: url('<?php /*echo $data['rootUrl'] */?>global/img/bg2.jpg'); -->
        <div id="content_page_tours" style="z-index:1; margin-top: -54px; width: 984px; height: 1346px;">

            <form id="form1" class="form" action="<?php echo $data['rootUrl'] ?>admin/onedaytour/save" target="_blank" method="POST" name="form1">
            <!--<form id="form1" action="<?php echo $data['rootUrl'] ?>onedaytour/save" target="_blank" method="POST">-->

                <!--Opcion de pago y 4% a pagar-->

                <input type="text" id="opc_ap" name="opc_ap" size="12" style="display:none;" value="" />
                <input type="text" id="PAP" name="PAP" size="12" style="display:none;" value="0.00" >

                <?php $mañana = date('d-m-Y', strtotime('+1 day', strtotime(date('d-m-Y')))); ?>
                <div id="info-group" style="width: 900px;">
                    <div id="cancelation">
                        <div class="ho">CANCELATION <span>#</span></div>
                        <div id="cancel" style="background: #fff;">00000</div>
                    </div>
                    <!--                            <div id="reservation" style="width:300px; border-color: #DCDCDC;opacity:0">
                                                    <div class="ho" style="color: #eee; background: #DCDCDC; opacity:0">. <span style="">#</span></div>
                                                    <div id="reser"><?php /* echo $_SESSION['codconf']; */ ?></div>
                                                </div>-->

                    <div id="reservation" style="width:300px;">
<!--                        <div class="ho" style="color: #fff; background: #000; opacity:20"><span>&nbsp;</span></div>-->
                        <div class="ho" style="color: #fff; background: #000;"> RESERVATION <span>#</span></div>
                        <div>
                            <input type="text" id="reser" name="reser" style="color: #000; background: #FFFFFF; text-align: center; font-weight: 600; width: 298px; height: 9px; font-size: 11px; padding-top: 2px;" value ="<?php echo $_SESSION['codconf']; ?>" readonly="readonly">
                            
                        </div>
                    </div>

                    <div id="status">
                        <div class="ho"  style="color: #fff;background: #bb0000; height:12px;"><strong>STATUS</strong></div>
                        <div id="stat" style="display:none">CONFIRMED</div>
                    </div>
                    <div id="status-change">
                         <!--<div><strong>CHANGE STATUS</strong></div>-->
                        <div style="color: #fff; font-weight:bold; background: #bb0000;padding: 4px;margin-top: 0px; margin-left:58px; width:103px; text-align: center;">CHANGE STATUS</div>
                        <select style="margin-top: -2px; margin-left: -4px; width:111px; color:#000; font-weight:bold;" id="estado" name="estado">
                            <option></option>
                            <option value="CONFIRMED" selected><strong>CONFIRMED</strong></option>
                            <option value="QUOTE">QUOTE</option>
                        </select>
                    </div>
                </div>

                <!--                <a href="#" onMouseOver="muestra_caja()">Pasa por aqui</a>
                                <div id="caja" style="position: absolute; height: 20; width: 300;top: 10px;left: 100px; visibility:hidden">
                                <input type="text" name="caja_oculta">
                                </div>-->
                <!-- lider pass -->
                <br />                          

                <fieldset id="inputype" style="margin-left:-1px; width:48%; border-radius: 3px 120px 0px 80px; box-shadow: 0 -8px 2px #f70d50;" class="rojo"><legend style="background-color: #fff; border:1px solid #B83A36;">INPUT TYPE</legend>          

                    <div id="opera" class="input">
                        <table width="100%" >
                            <tr align="left">

                                <td >
                                    <label style="margin-left:-2px; color:#FFFFFF;" id="label">CALL CENTER</label>
                                </td>
                                <td >
                                    <input name="nombre" type="text" style="border-top-left-radius: 25px;text-align: center; width:280px; margin-left: -2px;border-top-right-radius: 25px;" id="nombre" value="<?php echo trim($login->nombre . ' (' . $login->usuario . ')'); ?>" readonly="readonly"/>
                                </td>
                                

                            </tr>
                            <tr><td colspan="2" >
                                    <table width="100%" style="margin-top: 2%;">
                                        <tr>
                                            <td width="10%">
                                                <label style="color:#FFFFFF; margin-left:-2px;">AGENCY</label>
                                            </td>
                                            <td width="40%">
                                                <div class="ausu-suggest" >
                                                    <input style="margin-top:6px; width:150px; margin-left:16px;border-bottom-left-radius: 17px;" name="agency" type="text"  id="agency" size="19" maxlength="30" value=""  autocomplete="off"   />
                                                    <input type="hidden" size="4" value="-1" name="id_agency" id="id_agency" autocomplete="off"  readonly="readonly"/> 
                                                    <input type="hidden" size="4" value="0" name="type_rate" id="type_rate" autocomplete="off"  readonly="readonly"/>
                                                    <input type="hidden" size="4" value="0" name="disponible" id="disponible" autocomplete="off"  readonly="readonly"/>
                                                    <input type="hidden" size="4" value="0" name="comision" id="comision" autocomplete="off"  readonly="readonly"/>
                                                    <input type="hidden" size="4" value=0 name="comisionable" id="comisionable" autocomplete="off" readonly="readonly" />
                                                </div>
                                            </td>
                                            <td width="10%">
                                                <label style="color:#FFFFFF; margin-left:16px;">Employ</label>
                                            </td>
                                            <td width="40%">
                                                <div class="ausu-suggest" >
                                                    <input style=" margin-left:12px; width:150px; margin-top:6px;border-top-right-radius: 25px;" name="uagency" type="text"  id="uagency" autocomplete="off" size="11" maxlength="30" value="" disabled="disabled"  />
                                                    <input type="hidden" size="4" value="-1" name="id_auser" id="id_auser" autocomplete="off" />
                                                </div>
                                            </td>
                                        </tr>
                                    </table>
                                </td></tr>

                            <tr><td colspan="2" >&nbsp;</td></tr>
                            <tr><td colspan="2">
                                    <table style="margin-left:94px; margin-top: -10px;" align="center" cellspacing="10">
                                        <tr valign="top">
                                            <td><label style="margin-left:4px; color:#FFFFFF;">BY PHONE</label> <input style="margin-left:18px; "id="byrp" name="byr" type="radio" value="1" checked="checked"/>  </td>
                                            <td><label style="margin-left:4px; color:#FFFFFF;">BY MAIL</label> <input style="margin-left:18px; "id="byrm" name="byr" type="radio" value="2" /> </td>
                                            <td><label style="margin-left:4px; color:#FFFFFF;">WEBSALE</label><input style="margin-left:18px; " id="byrw" name="byr" type="radio" value="3" />  </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </div>
                </fieldset>  
                <fieldset id="liderpax" style=" margin-left: 502px; width: 94px; margin-top: -129px; background-color: #DCDCDC; border-radius: 130px 3px 80px 0px; box-shadow: 0 -8px 2px #1E90F6;" class="cerati">
                    <legend style=" margin-left: 73px; border:1px solid #00C; background-color: #fff;">LEADER PASS</legend>
                    <table>
                        <tr>
                            <td >
                                <div id="opera" class="input" style="padding-top:5px;">
                                    <table 
                                        <tr>
                                            <td>
                                                <label style="margin-left: 1px; margin-top:-5px; width: 145%; color:#FFFFFF;" id="label" >SEARCH </label>
                                            </td>
                                            <td>
                                                <div class="ausu-suggest" id="opera">
                                                    <input type="text" style="border-top-left-radius: 17px;border-top-right-radius: 17px; margin-top:-5px; margin-left:29px; width: 338px;" size="69" value=""  name="leader" id="cliente" autocomplete="off" />

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
                                                <label  id="labeldere12" style="margin-left: -110px; width:180px; color:#FFFFFF; ">FIRST NAME</label>		
                                            </td>
                                            <td width="">
                                                <input name="firstname1" type="text" style="margin-left: 6px; width: 135px;" id="firstname1" size="20" maxlength="20" value="" />	
                                            </td>

                                            <td width="" align="right"> 
                                                <label  id="labeldere12"style="margin-left: -14px;width:80px; color:#FFFFFF;">LAST NAME</label>
                                            </td>
                                            <td width="">  
                                                <input name="lastname1" type="text"  id="lastname1" size="20" maxlength="20" value="" style="margin-left: -32px; width: 135px;"  />
                                            </td>
                                        </tr>
                                        <tr>
                                            <td align="right"> 
                                                <label style="margin-top: 1px; margin-left: 0px; color:#FFFFFF; " id="labeldere12">E-MAIL</label>
                                            </td>
                                            <td>
                                                <input name="email1" type="text"  id="email1" size="20" style="border-bottom-left-radius: 17px;margin-top: 5%; width: 135px;" value=""/>
                                            </td>

                                            <td align="right">
                                                <label style="margin-top: 1px; margin-left: -14px; color:#FFFFFF; " id="labeldere12" >PHONE</label>
                                            </td>
                                            <td>
                                                <input name="phone1" type="text"  style="border-bottom-right-radius: 17px;width: 135px; margin-top: 5%;" id="phone1" size="20" maxlength="20" value="" /> 
                                                <input  type="hidden" name="type_cliente"  id="type_cliente" value="" />       	
                                            </td>


                                        </tr>
                                    </table>
                                </div>
                            </td>
                        </tr>
                    </table>
                </fieldset>

                <!-- ****************************************************************************   -->   

                <fieldset style="width: 97.3%;margin-top: 5px; border-radius: 10%;background-color:#DCDCDC;" class="gris3">
                    <div id="date" align="center">
                        <table width="90%" border="0">
                            <tr>
                                <td width="11%" height="29" align="right"><span style="width:100px;"><strong>DATE</strong></span></td>
<!--                                <td width="4%" align="right"><a href="" id="dataclick1" ><img src="<?php echo $data['rootUrl']; ?>global/images/calendar.png" alt=""  align="absmiddle" width="19" height="20" border="0" style="padding-bottom: 0px;" /></a></td>-->
                                <td width="4%" align="right"><a href="" id="dataclick1" ><i class="fa fa-calendar" style="font-size: 21px; color: #00E;"></i></a></td>
                                
                                <td width="17%"><input name="fecha_salida" type="text"  id="fecha_salida" onchange="fechatrip(); fecha_retorno(this.value);" size="10" maxlength="16" value="<?php echo date('m-d-Y', strtotime($mañana)); ?>"  autocomplete="off" style="height: 22px; text-align: center; font-weight:bold;" /></td>
                                

                                <!--<td width="17%"><input name="fecha_salida" type="text" id="fecha_salida" size="10"  maxlength="16" class="required" value="<php echo date('m-d-Y',strtotime($mañana));?>" /></td>-->
<!--                                <td width="4%" align="right"><a href="" id="dataclick2" ><img src="<?php echo $data['rootUrl']; ?>global/images/calendar.png" alt=""  align="absmiddle" width="19" height="20" border="0" style="padding-bottom: 0px;" /></a></td>-->
                                <td width="4%" align="right"><a href="" id="dataclick2"><i class="fa fa-calendar" style="font-size: 21px; color: #B83A36;"></i></a></td>
                                
                                <td width="17%"><input name="fecha_retorno" type="text"  id="fecha_retorno" size="10" maxlength="16" value="<?php echo date('m-d-Y', strtotime($mañana)); ?>" autocomplete="off"  style="height: 22px; text-align: center; font-weight:bold;" /></td>


<!--<td width="17%"><input name="fecha_retorno" alternate type="text" id="fecha_retorno" size="10" maxlength="16" class="required" value="<php echo date('m-d-Y',strtotime($mañana));?>" /></td>-->
                                <td width="9%"><strong>ADULT(S)</strong></td>
                                <td width="15%"><input style="font-size:16px; text-align: center; font-weight:bold; border: 1px solid #000;" name="adult" id="adult" type="number"   value="1" max="16" min="1"  autocomplete="off"></td>
                                <td width="8%"><strong>CHILD(S)</strong></td>
                                <td width="29%"><input style="font-size:16px; text-align: center; font-weight:bold; border: 1px solid #000;" name="child" id="child" type="number"   value="0" max="15" min="0"  autocomplete="off"></td>
                            <input type="text" name="group_park" id="group_park" style="display:none" size="2" maxlength="10" style="margin-left: 254px;" value="<?php echo $tour->group_park; ?>">
                            </tr>
                        </table>
                    </div>
                </fieldset>
                <fieldset id="inputype" title="" style="width:97%; margin-top: 4px; height:70%; border-radius: 10%;"class="booking2"><legend style="border:1px solid #00C; background-color: #fff;">ONE DAY TOUR TO</legend>
                    <div id="opera" class="input">
                        <table align="center" cellspacing="10" style="margin-top: 27px;">
                            <tr valign="top">
                              <!-- <form id="form2" class="form" action="<?php echo $data['rootUrl'] ?>admin/onedaytour" target="_blank" method="POST" name="form2" > -->
                                <td style="width: 20%;">

                                    <div style="margin-right:70px; margin-top:-15px;">
<!--                                        <a  href='<?php echo $data['rootUrl'] ?>admin/reservas/add'><img src ='<?php echo $data['rootUrl'] ?>global/estilos/img/one-day/WDW1.png' width='370px' height='70px'></a>-->

                                        <?php
//Datos de las variables en PHP
                                        /* <?php echo "$fecha"; ?><br /> <?php echo "$dato"; ?>...  bgcolor="#FFFFFF" */
                                        
                                        $sql1 = "SELECT g1,g2,g3,g4,g5,g6,g7,g8,g9,g10 FROM grupo_parques_oneday WHERE grupo_parque ='1'";
                                        $rs1 = Doo::db()->query($sql1);
                                        $grupo_parques = $rs1->fetchAll();
                                        foreach ($grupo_parques as $grp1) {
                                            
                                        
                                        }
                                            $gp1= $grp1['g1'];
                                            $gp2= $grp1['g2'];
                                            $gp3= $grp1['g3'];
                                            $gp4= $grp1['g4'];
                                            $gp5= $grp1['g5'];
                                            $gp6= $grp1['g6'];
                                            $gp7= $grp1['g7'];
                                            $gp8= $grp1['g8'];
                                            $gp9= $grp1['g9'];
                                            $gp10= $grp1['g10'];

                                            $sql2 = "SELECT nombre FROM grupo_parques WHERE id ='$gp1'";
                                            $rs2 = Doo::db()->query($sql2);
                                            $nombre_grupo2 = $rs2->fetchAll();


                                            foreach ($nombre_grupo2 as $ng2) {

                                            }
                                            $var1 = $ng2['nombre'];
                                            
                                            /* -------------------  */
                                            
                                            $sql3 = "SELECT nombre FROM grupo_parques WHERE id ='$gp2'";
                                            $rs3 = Doo::db()->query($sql3);
                                            $nombre_grupo3 = $rs3->fetchAll();


                                            foreach ($nombre_grupo3 as $ng3) {

                                            }
                                            $var2 = $ng3['nombre'];
                                            
                                            /* -------------------  */
                                            
                                            $sql4 = "SELECT nombre FROM grupo_parques WHERE id ='$gp3'";
                                            $rs4 = Doo::db()->query($sql4);
                                            $nombre_grupo4 = $rs4->fetchAll();


                                            foreach ($nombre_grupo4 as $ng4) {

                                            }
                                            $var3 = $ng4['nombre'];
                                            
                                            
                                        
                                            /* -------------------  */
                                            
                                            $sql5 = "SELECT nombre FROM grupo_parques WHERE id ='$gp4'";
                                            $rs5 = Doo::db()->query($sql5);
                                            $nombre_grupo5 = $rs5->fetchAll();


                                            foreach ($nombre_grupo5 as $ng5) {

                                            }
                                            $var4 = $ng5['nombre'];
                                           
                                            /* -------------------  */
                                            
                                            $sql6 = "SELECT nombre FROM grupo_parques WHERE id ='$gp5'";
                                            $rs6 = Doo::db()->query($sql6);
                                            $nombre_grupo6 = $rs6->fetchAll();


                                            foreach ($nombre_grupo6 as $ng6) {

                                            }
                                            $var5 = $ng6['nombre'];
                                        

                                        ?>

                                        <fieldset  style="margin-left: 132px; border:4px solid #AC1B29; width:150px; color:#fff; height: 83px; border-radius: 20px 20px 0px 0px; background-color: transparent;" class="round">

                                            <legend align="center" ><b style="color:#AC1B29;">GROUP PARKS 1</b></legend>

                                            <marquee align="center" height="50"  style="border-radius:10px 10px 0px 0px;" direction="up" onmouseover="this.stop();" onmouseout="this.start();" scrolldelay="220" class="wdw1" ><strong>


                                                <span   class="Estilomar"><strong><?php echo "$var1"; ?></span></strong><br />

                                                <span  class="Estilomar"><strong><?php echo "$var2"; ?></strong></span> <br />

                                                <span  class="Estilomar"><strong><?php echo "$var3"; ?></strong></span> <br /> 
                                                
                                                <span  class="Estilomar"><strong><?php echo "$var4"; ?></strong></span> <br /> 
                                                
                                                <span  class="Estilomar"><strong><?php echo "$var5"; ?></strong></span> <br />
                                                
                                                

                                                <span  class="Estilomar"><strong><?php echo "  "; ?></strong></span> <br /> 


                                                <span  class="Estilomar"><strong><?php echo "$var1"; ?></strong></span> <br /> 

                                                <span  class="Estilomar"><strong><?php echo "$var2"; ?></strong></span> <br />  

                                                <span  class="Estilomar"><strong><?php echo "$var3"; ?></strong></span> <br />
                                                
                                                <span  class="Estilomar"><strong><?php echo "$var4"; ?></strong></span> <br /> 
                                                
                                                <span  class="Estilomar"><strong><?php echo "$var5"; ?></strong></span> <br />
                                                


                                                <span  class="Estilomar"><strong><?php echo "  "; ?></strong></span> <br /> 


                                                <span  class="Estilomar"><strong><?php echo "$var1"; ?></strong></span> <br />  

                                                <span  class="Estilomar"><strong><?php echo "$var2"; ?></strong></span> <br />

                                                <span  class="Estilomar"><strong><?php echo "$var3"; ?></strong></span> <br /> 
                                                
                                                <span  class="Estilomar"><strong><?php echo "$var4"; ?></strong></span> <br />
                                                
                                                <span  class="Estilomar"><strong><?php echo "$var5"; ?></strong></span> 



                                            </marquee>
                                            <input type="radio" name="wdw" id="wdwus" style="height: 20px; width: 20px; margin-right: 64px;" value="1" required="required" onClick="capturar();habilitar(1);reseteo();"/>


                                        </fieldset>

                                    </div>                                                  

                                    <!--                                    <label style="color:#33449C; font-size:14px;"><b style="margin-left: 47px;">WDW/UNIVERSAL/SEA WORLD</b></label>-->

                                </td>
                                <td style="width: 20%;">
                                    <!--                                    <label style="color:#498128; font-size:14px;"><b style="margin-left: 16px;">WATER PARKS & HOLY LAND</b></label>-->
                                    <div style="margin-right:36px; margin-top:-15px;">
<!--                                        <a  href='<?php echo $data['rootUrl'] ?>admin/reservas/add'><img src ='<?php echo $data['rootUrl'] ?>global/estilos/img/one-day/WPHL1.png' width='240px' height='80px'></a>-->

                                        <?php
//Datos de las variables en PHP
                                        /* <?php echo "$fecha"; ?><br /> <?php echo "$dato"; ?>...  bgcolor="#FFFFFF" */
                                        
                                        $sql12 = "SELECT g1,g2,g3,g4,g5,g6,g7,g8,g9,g10 FROM grupo_parques_oneday WHERE grupo_parque ='2'";
                                        $rs12 = Doo::db()->query($sql12);
                                        $grupo_parques12 = $rs12->fetchAll();
                                        foreach ($grupo_parques12 as $grp2) {
                                            
                                        
                                        }
                                            $gp11= $grp2['g1'];
                                            $gp12= $grp2['g2'];
                                            $gp13= $grp2['g3'];
                                            $gp14= $grp2['g4'];
                                            $gp15= $grp2['g5'];
                                            $gp16= $grp2['g6'];
                                            $gp17= $grp2['g7'];
                                            $gp18= $grp2['g8'];
                                            $gp19= $grp2['g9'];
                                            $gp20= $grp2['g10'];

                                            $sql13 = "SELECT nombre FROM grupo_parques WHERE id ='$gp11'";
                                            $rs13 = Doo::db()->query($sql13);
                                            $nombre_grupo11 = $rs13->fetchAll();


                                            foreach ($nombre_grupo11 as $ng11) {

                                            }
                                            $var11 = $ng11['nombre'];
                                            
                                            /* -----------------------*/
                                            
                                            $sql14 = "SELECT nombre FROM grupo_parques WHERE id ='$gp12'";
                                            $rs14 = Doo::db()->query($sql14);
                                            $nombre_grupo12 = $rs14->fetchAll();


                                            foreach ($nombre_grupo12 as $ng12) {

                                            }
                                            $var12 = $ng12['nombre'];
                                            
                                             /* -----------------------*/
                                            
                                            $sql15 = "SELECT nombre FROM grupo_parques WHERE id ='$gp13'";
                                            $rs15 = Doo::db()->query($sql15);
                                            $nombre_grupo13 = $rs15->fetchAll();


                                            foreach ($nombre_grupo13 as $ng13) {

                                            }
                                            $var13 = $ng13['nombre'];
                                            

                                             /* -----------------------*/
                                            
                                            $sql16 = "SELECT nombre FROM grupo_parques WHERE id ='$gp14'";
                                            $rs16 = Doo::db()->query($sql16);
                                            $nombre_grupo14 = $rs16->fetchAll();


                                            foreach ($nombre_grupo14 as $ng14) {

                                            }
                                            $var14 = $ng14['nombre'];
                                            
                                             /* -----------------------*/
                                            
                                            $sql17 = "SELECT nombre FROM grupo_parques WHERE id ='$gp15'";
                                            $rs17 = Doo::db()->query($sql17);
                                            $nombre_grupo15 = $rs17->fetchAll();


                                            foreach ($nombre_grupo15 as $ng15) {

                                            }
                                            $var15 = $ng15['nombre'];
                                            
                                         

                                        ?>

                                        <fieldset  style="margin-left: -51px; border:4px solid #FF5E00; width:150px; color:#fff; height: 83px; border-radius: 20px 20px 0px 0px; background-color: transparent;" class="round">

                                            <legend align="center"><b style="color:#FF5E00;">GROUP PARKS 2</b></legend>

                                            <marquee align="center" height="50"  style="border-radius:10px 10px 0px 0px;" direction="up" onmouseover="this.stop();" onmouseout="this.start();" scrolldelay="320" class="wphol" ><strong>


                                                <span   class="Estilomar"><strong><?php echo "$var11"; ?></span></strong><br />

                                                <span  class="Estilomar"><strong><?php echo "$var12"; ?></strong></span> <br />
                                                
                                                <span  class="Estilomar"><strong><?php echo "$var13"; ?></strong></span> <br />
                                                
                                                <span  class="Estilomar"><strong><?php echo "$var14"; ?></strong></span> <br />

                                                <span  class="Estilomar"><strong><?php echo "$var15"; ?></strong></span> <br />

                                                <span  class="Estilomar"><strong><?php echo "  "; ?></strong></span> <br /> 


                                                <span  class="Estilomar"><strong><?php echo "$var11"; ?></strong></span> <br />                 

                                                <span  class="Estilomar"><strong><?php echo "$var12"; ?></strong></span> <br /> 
                                                
                                                <span  class="Estilomar"><strong><?php echo "$var13"; ?></strong></span> <br />
                                                
                                                <span  class="Estilomar"><strong><?php echo "$var14"; ?></strong></span> <br />

                                                <span  class="Estilomar"><strong><?php echo "$var15"; ?></strong></span> <br />


                                                <span  class="Estilomar"><strong><?php echo "  "; ?></strong></span> <br /> 


                                                <span  class="Estilomar"><strong><?php echo "$var11"; ?></strong></span> <br />  

                                                <span  class="Estilomar"><strong><?php echo "$var12"; ?></strong></span> <br />
                                                
                                                <span  class="Estilomar"><strong><?php echo "$var13"; ?></strong></span> <br />
                                                
                                                <span  class="Estilomar"><strong><?php echo "$var14"; ?></strong></span> <br />

                                                <span  class="Estilomar"><strong><?php echo "$var15"; ?></strong></span> <br />


                                                <span  class="Estilomar"><strong><?php echo "  "; ?></strong></span> <br /> 


                                                <span  class="Estilomar"><strong><?php echo "$var11"; ?></strong></span> <br />  

                                                <span  class="Estilomar"><strong><?php echo "$var12"; ?></strong></span> <br />
                                                
                                                <span  class="Estilomar"><strong><?php echo "$var13"; ?></strong></span> <br />
                                                
                                                <span  class="Estilomar"><strong><?php echo "$var14"; ?></strong></span> <br />

                                                <span  class="Estilomar"><strong><?php echo "$var15"; ?></strong></span> <br />




                                            </marquee>

                                            <input type="radio" name="wdw" id="wphol" style="height: 20px; width: 20px; margin-right: 70px;" value="2" required="required" onClick="capturar();habilitar(2);reseteo();"/>


                                        </fieldset>

                                    </div>                                                  


                                    </div>
<!--                                    <input type="radio" name="wdw" id="wphol" style="height: 20px; width: 20px; margin-right: 241px;" value="2" required="required" onClick="capturar();habilitar(2)" />-->
                                </td>
                                <td style="width: 20%;">
                                    <!--                                    <label style="color:#EF152C; font-size:14px;"><b style="margin-left: 36px;">KENNEDY SPACE CENTER</b></label>-->
                                    <div style="margin-right:64px; margin-top:-15px;">
<!--                                        <a style="margin-right:64px; margin-top:-15px;"  href='<?php echo $data['rootUrl'] ?>admin/reservas/add'><img src ='<?php echo $data['rootUrl'] ?>global/estilos/img/one-day/KSPC.png' width='145px' height='70px'></a>-->
                                        <?php
//Datos de las variables en PHP
                                        /* <?php echo "$fecha"; ?><br /> <?php echo "$dato"; ?>...  bgcolor="#FFFFFF" */
                                        
                                        $sql23 = "SELECT g1,g2,g3,g4,g5,g6,g7,g8,g9,g10 FROM grupo_parques_oneday WHERE grupo_parque ='3'";
                                        $rs23 = Doo::db()->query($sql23);
                                        $grupo_parques21 = $rs23->fetchAll();
                                        foreach ($grupo_parques21 as $grp3) {
                                            
                                        
                                        }
                                            $gp21= $grp3['g1'];
                                            $gp22= $grp3['g2'];
                                            $gp23= $grp3['g3'];
                                            $gp24= $grp3['g4'];
                                            $gp25= $grp3['g5'];
                                            $gp26= $grp3['g6'];
                                            $gp27= $grp3['g7'];
                                            $gp28= $grp3['g8'];
                                            $gp29= $grp3['g9'];
                                            $gp30= $grp3['g10'];

                                            $sql24 = "SELECT nombre FROM grupo_parques WHERE id ='$gp21'";
                                            $rs24 = Doo::db()->query($sql24);
                                            $nombre_grupo21 = $rs24->fetchAll();


                                            foreach ($nombre_grupo21 as $ng21) {

                                            }
                                            $var21 = $ng21['nombre'];
                                            
                                            /* -----------------------*/
                                            
                                            $sql25 = "SELECT nombre FROM grupo_parques WHERE id ='$gp22'";
                                            $rs25 = Doo::db()->query($sql25);
                                            $nombre_grupo22 = $rs25->fetchAll();


                                            foreach ($nombre_grupo22 as $ng22) {

                                            }
                                            $var22 = $ng22['nombre'];
                                            
                                            /* -----------------------*/
                                            
                                            $sql26 = "SELECT nombre FROM grupo_parques WHERE id ='$gp23'";
                                            $rs26 = Doo::db()->query($sql26);
                                            $nombre_grupo23 = $rs26->fetchAll();


                                            foreach ($nombre_grupo23 as $ng23) {

                                            }
                                            $var23 = $ng23['nombre'];
                                            
                                            /* -----------------------*/
                                            
                                            $sql27 = "SELECT nombre FROM grupo_parques WHERE id ='$gp24'";
                                            $rs27 = Doo::db()->query($sql27);
                                            $nombre_grupo24 = $rs27->fetchAll();


                                            foreach ($nombre_grupo24 as $ng24) {

                                            }
                                            $var24 = $ng24['nombre'];
                                            
                                            /* -----------------------*/
                                            
                                            $sql28 = "SELECT nombre FROM grupo_parques WHERE id ='$gp25'";
                                            $rs28 = Doo::db()->query($sql28);
                                            $nombre_grupo25 = $rs28->fetchAll();


                                            foreach ($nombre_grupo25 as $ng25) {

                                            }
                                            $var25 = $ng25['nombre'];
                                            
                                            /* -----------------------*/
                                        
                                        
                                        ?>

                                        <fieldset  style="margin-left: -42px; border:4px solid #33449C; width:150px; color:#fff; height: 83px; border-radius: 20px 20px 0px 0px; background-color: transparent;" class="round">

                                            <legend align="center"><b style="color:#33449C;">GROUP PARKS 3</b></legend>

                                            <marquee align="center" height="50"  style="border-radius:10px 10px 0px 0px;" direction="up" onmouseover="this.stop();" onmouseout="this.start();" scrolldelay="420" class="kspc" ><strong>


                                                <span  class="Estilomar"><strong><?php echo "$var21"; ?></span></strong> <br />
                                                <span  class="Estilomar"><strong><?php echo "$var22"; ?></strong></span> <br />
                                                <span  class="Estilomar"><strong><?php echo "$var23"; ?></strong></span> <br />
                                                <span  class="Estilomar"><strong><?php echo "$var24"; ?></strong></span> <br />
                                                <span  class="Estilomar"><strong><?php echo "$var25"; ?></strong></span> <br />



                                                <span  class="Estilomar"><strong><?php echo "  "; ?></strong></span> <br /> 


                                                <span  class="Estilomar"><strong><?php echo "$var21"; ?></strong></span> <br /> 
                                                <span  class="Estilomar"><strong><?php echo "$var22"; ?></strong></span> <br />
                                                <span  class="Estilomar"><strong><?php echo "$var23"; ?></strong></span> <br />
                                                <span  class="Estilomar"><strong><?php echo "$var24"; ?></strong></span> <br />
                                                <span  class="Estilomar"><strong><?php echo "$var25"; ?></strong></span> <br />




                                                <span  class="Estilomar"><strong><?php echo "  "; ?></strong></span> <br /> 


                                                <span  class="Estilomar"><strong><?php echo "$var21"; ?></strong></span> <br />
                                                <span  class="Estilomar"><strong><?php echo "$var22"; ?></strong></span> <br />
                                                <span  class="Estilomar"><strong><?php echo "$var23"; ?></strong></span> <br />
                                                <span  class="Estilomar"><strong><?php echo "$var24"; ?></strong></span> <br />
                                                <span  class="Estilomar"><strong><?php echo "$var25"; ?></strong></span> <br />




                                                <span  class="Estilomar"><strong><?php echo "  "; ?></strong></span> <br /> 


                                                <span  class="Estilomar"><strong><?php echo "$var21"; ?></strong></span> <br /> 
                                                <span  class="Estilomar"><strong><?php echo "$var22"; ?></strong></span> <br />
                                                <span  class="Estilomar"><strong><?php echo "$var23"; ?></strong></span> <br />
                                                <span  class="Estilomar"><strong><?php echo "$var24"; ?></strong></span> <br />
                                                <span  class="Estilomar"><strong><?php echo "$var25"; ?></strong></span> <br />






                                            </marquee>

                                            <input type="radio" name="wdw" id="kspc" style="height: 20px; width: 20px; margin-right: 71px;" value="3" required="required" onClick="capturar();habilitar(3);reseteo();"/>


                                        </fieldset>   

                                    </div>
<!--                                    <input type="radio"  name="wdw" id="kspc" style="height: 20px; width: 20px; margin-right: 144px;"  value="3" required="required" onClick="capturar();habilitar(3)" />-->
                                </td>
<!--                                <td style="width: 20%;">
                                    <label style="color:#33449C;"><b style="margin-left: 75px;">FULL DAY SHOPPING TOURS</b></label>
                                    <input type="radio"  name="wdw" id="fdshop" style="margin-right: 50px;"  value="4" onClick="capturar();habilitar(4)" />
                                </td>-->

                                <!--</form>-->

                            <div style="display:none" id="resultado"></div>
                            <div style="display:none;"  id="result"></div>
                            <input type="text" name="selectcond" id="selectcond" value="" style="display:none; position:absolute; margin-left:0px; margin-top:0px;" />


                            
                            <div style="margin-right: -43%;margin-top: -5px;">
                                <input type="text" name="priceadults" id="priceadults" style="display:none" size="10" maxlength="10" style="margin-left: -70px;" value="<?php echo $tour->t_price_adult; ?>"></div>
                            <div style="margin-left: 100%;margin-top: -25px;">
                                <input type="text" name="pricechilds" id="pricechilds" style="display:none" size="10" maxlength="10" style="margin-left: 254px;" value="<?php echo $tour->t_price_child; ?>"></div>      
                            </tr>
                        </table>

                    </div>
                </fieldset>  

                <!-- end date of tours -->

                <!-- Transfer in-->
                <table width="100%">
                    <tr>
                        <td colspan="" valign="top" >

                            <fieldset id="arrival" style="border-radius: 4%; width: 460px; margin-top: 4px;  margin-left: 5px; background-color: #33449C; color: #fff;border:1px solid #33449C;" class="cerati">
                                <div id="reserveprices" display="none"></div>
                                <input id="totalreserve" name="totalreserve" style="display:none;" type="" value="0" readonly="readonly">
                                <legend id="leg_transfer_in" style="border:1px solid #00C; background:#DCE6F2">
                                    <label for="opcion_transfer_in" style="cursor:pointer; background-color: #fff;">TRANSFER IN</label></legend>
                                <div id="conte_arrival" style="height: 225px;" >
                                    <table width="100%">
                                        <tr>
                                            <td>
                                                <div id="type">
                                                    <table width="100%">
                                                        <tr>
                                                            <td><div class="label">ARRIVAL</div></td>
                                                            <td>

                                                            </td>
                                                            <td>&nbsp;</td>
                                                            <td title="Price of transport per person" style="width: 43%;">
                                                                <div style = "display:none;" id="t-total" >
                                                                    <div id="price_transport1pp" class="price" style="">$ 0.00</div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div id="arrival-content">
                                                    <div id="transport1" class="group" align="left">
                                                        
                                                        <table width="100%"><tr>
                                                                <td>
                                                                    <div id="div_from">
                                                                        <div class="label">FROM</div>
                                                                        <select style="background-color: #CCC; width:254px; margin-right: -36px; color:#000; font-size:14px; font-weight:bold;" name="from" id="from" class="select" disabled="disabled" >
                                                                            <option value="0"></option>
                                                                            <?php foreach ($data["to_areas"] as $e) { ?>
                                                                                <option value="<?php echo $e["id"]; ?>"><?php echo $e["nombre"]; ?></option>
                                                                            <?php } ?>
                                                                        </select>


                                                                    </div>
                                                                </td>
                                                                <td>

                                                                    <div id="div_to" style="margin-left: 69px;">
                                                                        <div style="margin-left: -27px;" class="label">TO</div>
                                                                        <select style="width:190px; color:#000; font-size:14px; margin-left: -27px; font-weight:bold;" name="to" id="to" class="select">
                                                                            <option value="1">Orlando</option>
                                                                        </select>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div id="trip">


                                                                        <table><tr><td>
                                                                                    <span>

                                                                                    </span></td>
                                                                                <td>
                                                                                </td></tr></table>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td width="100%" colspan="3">
                                                                    <div id="pick-drop" style="margin-top: 7px;">
                                                                        <div class="label">PICK UP POINT/ADDRESS</div>
                                                                        <div  style="width:447px;" class="ausu-suggest">
                                                                            <input name="a_pickup1" style="float:left; width: 445px;" disabled="disabled" class="field" type="text" id="a_pickup1" autocomplete="off" maxlength="55" value=""/>
                                                                            <input name="a_id_pickup1" type="hidden" id="a_id_pickup1" maxlength="55" value="-1"/>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="3">
                                                                    <table width="100%">
                                                                        <tr>
                                                                            
                                                                            <td width="25%">
                                                                                <div>
                                                                                <div class="label">EXTENSION AREA:</div>
                                                                                
                                                                                <select name="ext_from1" id="ext_from1" class="select" style="width:253px; margin-top: 0px;"></select>
                                                                                    
                                                                                </div>
                                                                            </td>
                                                                           
<!--                                                                            <td>
                                                                                


                                                                            </td>-->
                                                                            
<!--                                                                            <td>&nbsp;</td>-->
                                                                            <td width="15%">
                                                                                <div id="rooms">
                                                                                    <div style="margin-top: -1px;" class="label">LUGGAGE</div>
                                                                                    <span><input name="a_luggage" type="text" id="a_luggage" size="2" maxlength="2" value="" style="width:61px; margin-top: -1px; margin-right:56px; height: 24px;" class="field"/></span>
                                                                                </div>
                                                                            </td>
                                                                            <td width="15%">
                                                                                <div id="rooms" style="margin-left: 14px;">
                                                                                    <div style="margin-top: -1px; margin-left: -12px;" class="label">ROOM #</div>
                                                                                    <span><input name="a_room1" type="text" id="a_room1" size="4" maxlength="6" value="" style="width:61px; margin-top: -1px; margin-left: -12px; height: 24px;" class="field"/></span>
                                                                                </div>
                                                                            </td>
                                                                        </tr>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="3">
                                                                    <div style="width:100%" id="ex_pick_drop">
                                                                        <div class="label" style="margin-top: 11px;">EXTENTION PICK UP POINT/ADDRESS</div>
                                                                        <div style="width:100%" class="ausu-suggest">
                                                                            <input name="a_pickup2" style="width:445px;" disabled="disabled"  class="field" type="text" id="a_pickup2" maxlength="55" autocomplete="off" value=""/>
                                                                            <div style="display:none" id="extcost"></div>
                                                                            <input name="a_id_pickup2" type="hidden" id="a_id_pickup2" maxlength="55" value=""/>                                              </span></div>

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
                        </td>
                        <td>
                            <fieldset id="departure" style=" border-radius: 4%; margin-top: 4px; margin-left: 2px; width: 460px;background-color: #AC1B29; border: #AC1B29 solid thin; color: #fff;" class="rojo">
                                <div style="display:none" id="reserveprices2">
                                </div>
                                <input id="totalreserver" name="totalreserver" style="display:none;" type="" value="0" readonly="readonly">
                                <legend id="leg_transfer_in" style="background-color: #fff; border: #B83A36 solid thin; color:#B83A36;">
                                    <label for="opcion_transfer_in" style=" cursor:pointer; ">TRANSFER OUT</label> </legend>
                                <div id="conte_arrival" style="height: 225px;" >
                                    <table width="100%">
                                        <tr>
                                            <td>
                                                <div id="type">
                                                    <table width="100%">
                                                        <tr>
                                                            <td><div class="label">DEPARTURE</div></td>
                                                            <td></td>
                                                            <td>&nbsp;</td>
                                                            <td title="Price of transport per person" style="width: 43%;">
                                                                <div style = "display:none;" id="t-total" style="">
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
                                                <div id="arrival-content">
                                                    <div id="transport1" class="group" align="left">
                                                        <table width="100%">
                                                            <tr>
                                                                <td>
                                                                    <div id="div_from2">
                                                                        <div  class="label">FROM</div>
                                                                        <select style="width:190px;  color:#000; font-size:14px; font-weight:bold;" name="from2" id="to" class="select">
                                                                            <option value="1">Orlando</option>
                                                                        </select>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div id="div_to2" style="margin-left: 69px;">
                                                                        <div style="margin-left: -68px;" class="label">TO</div>
                                                                        <select style="background-color: #CCC; width:254px; margin-left: -68px;color:#000; font-size:14px; font-weight:bold;" name="to2" id="to2" class="select" disabled="disabled">
                                                                            <option value="0"></option>
                                                                            <?php foreach ($data["to_areas"] as $e) { ?>
                                                                                <option value="<?php echo $e["id"]; ?>"><?php echo $e["nombre"]; ?></option>
                                                                            <?php } ?>
                                                                        </select>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td width="100%" colspan="3">
                                                                    <div id="pick-drop2" style="    margin-top: 9px;">
                                                                        <div class="label">DROP OFF POINT/ADDRESS</div>
                                                                        <div  style="width:100%" class="ausu-suggest">
                                                                            <input name="d_pickup1" style="float:left; width:445px;" disabled="disabled" class="field" type="text" id="d_pickup1" autocomplete="off" maxlength="55" value=""/>
                                                                            <input name="d_id_pickup1" type="hidden" id="d_id_pickup1" maxlength="55" value="-1"/>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="3">
                                                                    <table width="100%">
                                                                        <tr>
<!--                                                                            <td width="25%">
                                                                                EXTENSION AREA: </td>
                                                                            <td>
                                                                                <select name="ext_to2" id="ext_to2" class="select" style="width:200px;margin-top: 11px;"></select>
                                                                            </td>-->
                                                                            
                                                                            
<!--                                                                            <td>&nbsp;</td>-->
                                                                            <td width="15%">
                                                                                <div id="rooms" >
                                                                                    <div class="label">LUGGAGE</div>
                                                                                    <span><input name="d_luggage" type="text" id="d_luggage" style=" width: 61px; margin-top: -1px; margin-right: 120px; height: 24px;" size="2" maxlength="2" value=""
                                                                                                 class="field"/></span>
                                                                                </div>
                                                                            </td>
                                                                            <td width="15%">
                                                                                <div id="rooms" style="margin-left: 15px;">
                                                                                    <div style="margin-left: -76px;" class="label">ROOM #</div>
                                                                                    <span><input name="d_room1" type="text" id="d_room1" style="width: 61px; margin-top: -1px; margin-left: -76px; height: 24px;" size="4" maxlength="6" value=""
                                                                                                 class="field" /></span>
                                                                                </div>
                                                                            </td>
                                                                            <td width="25%">
                                                                                <div>
                                                                                <div class="label" style="margin-left: -63px;">EXTENSION AREA:</div>
                                                                                
                                                                                <select name="ext_to2" id="ext_to2" class="select" style="width: 253px; margin-top: 0px; margin-left: -63px;"></select>
                                                                                    
                                                                                </div>
                                                                            </td>
                                                                        </tr>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="3">
                                                                    <div style="width:100%;margin-top: 8px;" id="ex_pick_drop2">
                                                                        <div class="label">EXTENTION DROP OFF POINT/ADDRESS</div>
                                                                        <div style="width:100%" class="ausu-suggest">
                                                                            <input name="d_pickup2" style="width:445px; margin-top: 3px;" disabled="disabled"  class="field" type="text" id="d_pickup2" maxlength="55" autocomplete="off" value=""/>
                                                                            <div style="display:none" id="extcost2"></div>
                                                                            <input name="d_id_pickup2" type="hidden" id="d_id_pickup2" maxlength="55" value=""/>                                              </span></div>

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

                        </td>
                        <td>&nbsp;</td>

                    </tr>

                    <!-- End Transfer in-->
                    <!-- Transfer out -->
                    <tr >
                    <tr>
                        <td colspan="" valign="top" >
                            <div id="itinerary" style="width: 479px;margin-left: 6px;height: 130px; background-color: #FFF;">
                                <h3 style="padding-left:15px; font-family:'arial'; color:#33449C;">TRIP SCHEDULE</h3>
                                <div id="schedule1" style=" margin: -30px 4px 0px 4px">

                                </div>

                            </div>
                        </td>
                        <td>
                            <div id="itinerary" style="width: 479px;height: 130px; background-color: #FFF;">
                                <h3 style="padding-left:15px; font-family:'arial'; color:#AC1B29;">TRIP SCHEDULE</h3>
                                <div id="schedule2" style=" margin: -30px 4px 0px 4px">

                                </div>
                            </div>
                        </td>
                        <td>&nbsp;</td>

                    </tr>
                    </tr>
                    <!-- End Transfer out -->

                </table>

                <!-- Parks -->
                <div id="traffic" style="">
                    <fieldset style="color: #fff; border-radius: 5%; margin-top: 8px;" class="verdefosf">
                        <legend style="background-color:#fff;/*border: 1px solid #CCCCCC;*/">
                            <div id="chk_traffic">
                                <label for="opcion_traffic" style=" cursor:pointer; border:1px solid #00C; " >TRAFFIC TOURS  </label>

                            </div>
                        </legend>
                        <input type="hidden" readonly="readonly" id="total_parks" value=0>
                        <input type="hidden" readonly="readonly" id="total_sumplemento" value="0" >
                        <div id="attractions">
                            <table width="100%">
                                <tr>
                                    <td>
                                        <table width="100%">
                                            <tr>
                                                <td valign="bottom">
                                                    <div id="category-selection">
                                                        <input type="hidden" value=0 id="nparks" />
                                                        <table>
                                                            <tr>
                                                                <td>
                                                                    <div class="label"style="color: black;"><strong>CATEGORY</strong></div>
                                                                </td>
                                                                <td valign="bottom">
                                                                    <div class="label" style="color: black;"><strong>SEARCH PARK</strong></div>

                                                                </td>
                                                                <td colspan="">

                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td valign="bottom">


                                                                    <select style="color: #000;font-size: 14px;font-weight:bold; border: 1px #000 solid; height: 28px;" name="categoria_park" id="categoria_park" class="select">

<!--                                                                        <option value="0"> <p style=" "> </p></option>-->
                                                                        <option value="4" style="color: #000;font-size: 14px;font-weight:bold;">WALT DISNEY WORLD</option>
                                                                        <option value="5" style="color: #000;font-size: 14px; font-weight:bold;">SEA WORLD</option>
                                                                        <option value="6" style="color: #000;font-size: 14px; font-weight:bold;">UNIVERSAL PARKS</option>
                                                                        <option value="7" style="color: #000;font-size: 14px; font-weight:bold;">WATER PARKS</option>
                                                                        <option value="8" style="color: #000;font-size: 14px; font-weight:bold;">HISTORIC PARKS</option>
                                                                        <!--                                                                        <option value="9" style="color: black;font-size: 15px;">FULL DAY SHOPPING TOURS</option>                                                                        -->
                                                                        <option value="11" style="color: #000;font-size: 14px; font-weight:bold;">KENNEDY SPACE CENTER</option>
                                                                        <option value="12" style="color: #000;font-size: 14px; font-weight:bold;">HOLY LAND</option>




                                                                    </select>


                                                                </td>
                                                                <td valign="bottom">
                                                                    <div  style="width:100%" class="ausu-suggest">
                                                                        <input style="background-color: #CCC; width:300px; border: 1px #000 solid; margin-left: 3px; height: 22px;" class="field" id="park_name" type="text" autocomplete="off" disabled="disabled" />
                                                                        <input type="hidden" name="id_park" id="id_park" value=""/>
                                                                        <input type="hidden" name="numPark" id="numPark" value="0"/>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <table class="fields2">
                                                                        <tr></tr>
                                                                        <tr>
                                                                            <td></td>
                                                                            <td></td>
                                                                        </tr>
                                                                    </table>
                                                                </td>
                                                                <td valign="bottom"><input type="button" id="add_attraction_list" style="height:30px; color:#33449C;" value="Add to list"/>
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
                                                                            <tr >
                                                                                <th style="background-color: #fff;">NAME</th>
                                                                                <th style="background-color: #fff;">GROUP</th>
                                                                                <th style="background-color: #fff;">TICKET</th>
                                                                                <th style="background-color: #fff;">TRANSFER</th>
                                                                                <th style="background-color: #fff;">ADMISSION</th>
                                                                                <th style="background-color: #fff;">TRANSPORT</th>
                                                                                <th style="background-color: #fff;">DELETE</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            <tr id="park-selected"class="row1">
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
                                        <div  id="t-total">
                                            <div class="label" style="color: black;"><STRONG>PRICE PER PERSON OF TRANSPORT LOCAL</STRONG></div>
                                            <div id="park_transport" class="price">$ 0.00</div>
                                            <div class="label" style="color: black;"><STRONG>PRICE PER PERSON OF TICKET</STRONG></div>
                                            <div id="park_admision" class="price">$ 0.00</div>
                                        </div>
                                    </td>
                                </tr></table>
                        </div>

                    </fieldset>
                </div>
                <br />
                <fieldset style="border-radius: 5%;  margin-top: -6px; height: 396px;" class="super">
                    <legend style="background-color:#fff;border:1px solid #00C;"><div id="chk_traffic">
                            <div class="label">PAYMENT INFORMATIONS</div></div></legend>
                    <table>
                        <tr>
                            <td width="10%">
                                <!--tabla inferior------>
                                <div id="opera" class="input" style="padding-top:0px; width:450px; margin-top:14px; margin-left: 2px; ">
                                    <table width="100%" id="tr_complementary" style="display:none;">
                                        <tr>
                                            <td width="2%">
                                                <input name="opcion_pago" id="opcion_pago_complementary" value="7"  type="radio">
                                            </td>
                                            <td width="20%"><label for="opcion_pago_complementary">Complementary</label></td>
                                        </tr>
                                    </table>
                                    <table width="100%" height="125" id="tableorder" style="margin-top: 5px;display:none;">
                                        <tr>
                                            <td colspan="3" width="34%" height="20" align="center"  >
                                                <input type="hidden" name="opcion_pago_saldo" id="opcion_pago_saldo" value="1" />
                                                <table width="100%" align="center" id="tableTypeSaldo" style="display:none;">
                                                    <tr>
                                                        <td colspan="6"   height="20" id="titlett" align="center" >
                                                            <strong>PAYMENT OPTION</strong>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>&nbsp;</td>
                                                        <td width="2%">
                                                            <input name="opcion_saldo" id="opcion_saldo1" value="1" checked="checked" type="radio">
                                                        </td>
                                                        <td width="20%">Paid Full</td>
                                                        <td width="2%"><input name="opcion_saldo" id="opcion_saldo2" value="2" type="radio"></td>
                                                        <td width="20%">Paid Balance</td>
                                                        <td>&nbsp;</td>
                                                    </tr>
                                                    <tr><td colspan="6"><hr /></td></tr>
                                                </table>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td  height="35" id="titlett" align="left" ><strong>PRED-PAID</strong></td>
                                            <td  width="34%" height="35" id="titlett" align="left"  ><strong>COLLECT ON BOARD</strong></td>
                                            <td  width="34%" height="35" id="titlett" align="left"  ><strong>VOUCHER</strong></td>
                                        </tr>
                                        <tr>
                                            <td valign="top" style="width:160px;"  >
                                                <table width="100%">
                                                    <tr>
                                                        <td colspan="2"></td>
                                                    </tr>
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
                                                    <input name="opcion_pago" id="opcion_pago_Voucher" value="5" type="radio" class="opcion_pago"><label id="label_tipo_Cash" for="opcion_pago_Voucher" class="opcion_pago">Credit Voucher</label>
                                                </div>
                                            </td>
                                        </tr>


                                    </table>

<!--                                     <div id="" class="input" style="margin-top:12px; margin-left:440px; "><div style="width:275px;"><label style="width:150px; color: #000;"  ><strong>NOTES</strong></label></div>-->

                                    <div id="t-total2" style="width:170px;">
                                        <input type="text" class="txtNumbers"  name="otheramount" id="otheramount" onkeyup="ClkPay_Amount();" value=""  style="display:none; margin-left: 366px; margin-top: -42px; padding-left:5px; width:160px; height:25px;  border: 1px solid #000;" autocomplete="off" />
                                    </div>

                                    <div id="opera" class="input" style="width: 85%;" >



                                        <table class="oliveti" style="width: 96%; border: 2px solid #000; margin-left: -8px; margin-top: -22px; height: 156px;">



                                            <caption class="rojo" style=" font-weight:bold; font-size:16px; color:#fff; border-radius: 25px 0px 0px 0px; border: 2px #000 solid;">Passenger Payment Information</caption>


<!--                                            <tr style="display:none;">
                                                <td>
                                                    <label  style="padding-left:20px; font-size:12px; "><strong style="padding-bottom:0px; color:#090;">Total Amount Paid $</strong></label>

                                                </td>
                                                <td>
                                                    <label id="saldoPagado" >$  </label>
                                                    <br />
                                                </td>
                                            </tr>-->

                                            <td>&nbsp;</td>

                                            <tr  style=" height:13px; width:180px;">

                                                <td style="width: 700px;">
                                                    <label  style=" float:right; font-size:16px; margin-top:-35px;"><strong   id="txtamountpendiente" style=" color:#F00">Amount to Collect&nbsp;$</strong></label>
                                                </td>
                                                <td>
                                                    <input  type="text"  id="saldoactual" name="saldoactual" class="verd" class="price" value="" style="width:106px; height:25px; margin-right:6px; margin-top: -33px; text-align: right; border:1px #33F solid;  color:#000; font-family:arial; font-size: 22px; font-weight:bold;" onKeyUp="dupliac();ponDecimales(2);" onkeypress="return soloNumeros(event);" autocomplete="off"/>
                                                </td> 
                                                
                                                <br />
                                           
                                            </tr>
                                            <td>&nbsp;</td>


                                            <tr style="width: 700px;" ><td>
                                                <label  style=" float:right; font-size:16px;  margin-top:-46px; "><strong style=" color: #000;">Paid Driver&nbsp;$</strong></label></td>
                                                <input type="button" id="btn_rever_cob" name="btn_rever_cob" title="Reverse Payment" class="button_sliding_bg" style="display:none; position:absolute; background-color: #8c261a; border-color: lavenderblush; cursor:pointer; color:#fff; margin-left: -136px; margin-top: 72px; padding:2.1px; padding-left:3px; width:17px; height:17px; font-weight: bold; font-size:9px;"  size="20"   value="X" onclick="rever_collect_on_board();"  />
                                                
                                                <td>
                                                    <input type="text" id="paid_driver" name="paid_driver" class="brown3" readonly="readonly"  style="float:right; text-align: right; margin-right:6px; height: 25px; font-size: 22px;font-weight: bold;color: #000; border: 1px #33F solid; margin-top: -45px;  width:106px; font-weight:bold; color:fff;" value="" onKeyUp="calcularTotalPago();" onclick="valida_pago(this,'one');" autocomplete="off" />

                                                </td>
                                                
                                                <div style="position:absolute; margin-left:-2px; margin-top:0px;">
                                    
                                                    <div id="trian1" style="display:none; position:absolute; margin-left:365px; margin-top:100px;" class="triangulo1"></div>
                                                    <div id="trian2" style="display:none; position:absolute; margin-left:380px; margin-top:100px;" class="triangulo2"></div>
                                                    <div id="trian3" style="display:none; position:absolute; margin-left:395px; margin-top:100px;" class="triangulo3"></div>
                                                    <div id="trian4" style="display:none; position:absolute; margin-left:410px; margin-top:100px;" class="triangulo4"></div>
                                                    <div id="trian5" style="display:none; position:absolute; margin-left:425px; margin-top:100px;" class="triangulo5"></div>
                                                    <div id="trian6" style="display:none; position:absolute; margin-left:440px; margin-top:100px;" class="triangulo6"></div>
                                                    <div id="trian7" style="display:none; position:absolute; margin-left:455px; margin-top:100px;" class="triangulo7"></div>
                                                    <div id="trian8" style="display:none; position:absolute; margin-left:470px; margin-top:100px;" class="triangulo8"></div>
                                                    <div id="trian9" style="display:none; position:absolute; margin-left:485px; margin-top:100px;" class="triangulo9"></div>
                                                    <div id="trian10" style="display:none; position:absolute; margin-left:500px; margin-top:100px;" class="triangulo10"></div>

                                                </div>
                                            </tr>

                                            <tr style="width: 700px;" >
                                                <td>
                                                    <label  style=" float:right; font-size:16px;  margin-top: -30px; "><strong style=" color:#000;">Passenger Balance Due&nbsp;$</strong></label>

                                                </td>

                                                <td>
                                                    <input type="text" id="balance_due" name="balance_due" class="ama2"  class="txtNumbers"  style="float:right; border: 1px #33F solid; margin-top: -29px;  text-align: right; margin-right:6px; height: 25px; font-size: 22px; font-weight:bold; width:106px;"  value="" readonly="readonly" autocomplete="off"  />
                                                </td>
                                            </tr>



                                        </table>



                                        <table class="oliveti" style="width: 96%; border: 2px solid #000; margin-left: -8px; margin-top: 9px; height: 155px; ">


                                            <caption class="cerati" style="  font-weight:bold; font-size:16px; color:#fff; border: 2px #000 solid;">Agency Payment Information</caption>

                                            <tr>
                                                <td>
                                                    <b style="display:none; font-size: 18px; margin-left: 3px; ">Agency Request to Collect&nbsp;$</b>
                                                </td>
                                                <td>

                                                </td>
                                            </tr>

                                            <tr style="width: 700px;">
                                                <td>

                                                    <label  style=" float:right; padding-left: 100px; font-size:16px;  margin-top: -16px;"><strong style=" color:#000;">Total Net Fare&nbsp;$</strong></label>

                                                </td>
                                                <td>


                                                    <div id="t-total2" >


                                                        <input type="text"  class="orangered"   id="totalAmount" name="totalAmount" value="" style="float: right; width:106px; height: 25px; margin-right:6px; margin-top: -6px; text-align: right; font-weight:bold; color:#fff; border: 1px #33F solid; font-size:22px; padding-left:0px; font-weight:bold;" onkeypress="validate(event);"  readonly="readonly" autocomplete="off"  />



                                                    </div>
                                                </td>
                                            </tr>

                                            <tr id="pay_amount_html" style="height: 50px; width: 700px;">
                                                <td>
                                                    <b style="float: right; color:#000;font-size: 16px; margin-top:-4px;">Amount Pre-Paid&nbsp;$</b>                                       
                                                    <input type="button" id="btn_rever_prepaid" name="btn_rever_prepaid" title="Reverse Payment" class="button_sliding_bg" style="display:none; position:absolute; background-color: #8c261a; border-color: lavenderblush; cursor:pointer; color:#fff; margin-left: 149px; margin-top: -4px; z-index: 1; padding:2.1px; width:17px; height:17px; font-weight: bold; font-size:9px;"  size="20"   value="X" onclick="rever_prepaid();"  />
                                                </td>
                                                
                                                <div style="position: absolute; margin-left:-1px; margin-top:1px;">
                                    
                                                    <div id="cir1" style="display:none; position:absolute; margin-left:364px; margin-top:105px;" class="circle1"></div>
                                                    <div id="cir2" style="display:none; position:absolute; margin-left:379px; margin-top:105px;" class="circle2"></div>
                                                    <div id="cir3" style="display:none; position:absolute; margin-left:394px; margin-top:105px;" class="circle3"></div>
                                                    <div id="cir4" style="display:none; position:absolute; margin-left:409px; margin-top:105px;" class="circle4"></div>
                                                    <div id="cir5" style="display:none; position:absolute; margin-left:424px; margin-top:105px;" class="circle5"></div>
                                                    <div id="cir6" style="display:none; position:absolute; margin-left:439px; margin-top:105px;" class="circle6"></div>
                                                    <div id="cir7" style="display:none; position:absolute; margin-left:454px; margin-top:105px;" class="circle7"></div>
                                                    <div id="cir8" style="display:none; position:absolute; margin-left:469px; margin-top:105px;" class="circle8"></div>
                                                    <div id="cir9" style="display:none; position:absolute; margin-left:484px; margin-top:105px;" class="circle9"></div>
                                                    <div id="cir10" style="display:none; position:absolute; margin-left:499px; margin-top:105px;" class="circle10"></div>

                                                </div>


                                                <td>
                                                    <div id="t-total2">
                                                        <input type="text"  class="azu" class="txtNumbers"  id="pay_amount" name="pay_amount"  value=""  onKeyUp="calcularTotalPago(); outcharge();" onclick="valida_pago2(this,'two');" style=" text-align: right; margin-right:6px; margin-top: -5px; float:right; width: 106px; height:25px; font-size:22px; font-weight:bold; padding-left:0px; border: 1px #33F solid;" readonly="readonly" autocomplete="off"/>
                                                    </div>
                                                </td>
                                            </tr>

                                            <tr width: 700px;>
                                                <td>
                                                    <b style="float: right; "><strong style=" color:#000;font-size: 16px; font-weight:bold;">Agency Balance Due&nbsp;$</strong></b>                                         
                                                </td>
                                                <td>
                                                    <input type="text" id="agency_balance_due" name="agency_balance_due"    class="roge"  class="txtNumbers"   value=""  style="float:right; border: 1px #33F solid; margin-right:6px; margin-top:-1px; text-align: right; height: 25px; font-size: 22px; font-weight:bold; padding-left:0px; width:106px;" readonly="readonly" autocomplete="off" />
                                                </td>
                                                <input type="text" id="pago_tarjeta" name="pago_tarjeta" title="Pago Tarjeta" value="0.00"  style="display:none; position:absolute;  border: 1px #FFF solid; margin-top: 67.2px;  margin-left: 57px; width: 68px; height:12px; text-align:right; font-size: 14px; padding-top:2px; background-color: transparent; color:#fff;"  autocomplete="off"  />                                

                                                
                                            </tr>  
                                        </table>

                                        <img class="ventana-imagen-class" style="margin-right:-311px; margin-top:-366px; width: 181px; height: 178px; " src="<?php echo $data['rootUrl']; ?>global/img/admin/ventana.png" />

                                        <table class="oliveti" style="width: 63%; border: 2px solid #000; margin-left: 697px; margin-top: -364px; height: 156px; border-radius: 0px 0px 0px 0px;">

                                            <caption class="olivo" style="border-radius: 0px 25px 0px 0px; border: 2px #000 solid; font-weight:bold; font-size:16px; color:#fff;">Extra Charges & Discounts</caption>

                                            <td>&nbsp;</td>


                                            <tr style="width: 700px;" >
                                                <td>
                                                    <label  style=" float:right; font-size:16px; margin-top:-25px; "><strong style="padding-bottom:10px; color: #000;">Discount&nbsp;%</strong></label>
                                                </td>

                                                <td>

                                                    <input type="number" id="descuento" name="descuento"  class="descuentos" maxlength="3" class="txtNumbers" onkeypress="return descuentoporc(event);" onKeyUp="desporc();" onchange="desporc();" max="100" min="0"  value=""  autocomplete="off" style="text-align: right; color:#000; font-size: 22px;font-weight: bold; border: #33F solid thin; float:right; margin-top: -21px;  margin-right: 6px; height:25px; width:80px; " />
                                                </td>
                                            </tr>

                                            <tr style="width: 700px;" >
                                                <td>
                                                    <label  style="float:right; font-size:16px;  margin-top: -3px; "><strong style="padding-bottom:10px; color:#000;">Discount&nbsp;&nbsp;&nbsp;$</strong></label>

                                                </td>

                                                <td>

                                                    <input type="text" id="descuento_valor" name="descuento_valor"  class="descuentos" size="12" style="float:right; border: 1px #33F solid; margin-top: 7px;  margin-right: 6px;  text-align: right; color:#000; font-size: 22px; font-weight: bold; height: 25px; width:80px;" value="0.00" onkeypress="return solodescuento(event);" onkeyup="desval();ponDecimales(2);" autocomplete="off"   />
                                                </td>
                                            </tr>

                                            <td>&nbsp;</td>


                                            <tr  style="width: 700px;">

                                                <td style="width: 700px;">
<!--                                                    <label  style="float:right;  font-size:16px; margin-top:-32px;"><strong   id="txtamountpendiente" style="padding-bottom:0px; color:#000">Extra Charges&nbsp;$</strong></label>-->
                                                    <label  style="float:right;  font-size:16px;  margin-top: -29px;"><strong style="padding-bottom:10px; color: #000;">Extra Charges&nbsp;$</strong></label>
                                                </td>

                                                <td>

<!--                                                    <input autocomplete="off" type="text"  class=""   id="saldoporpagar" value=""  style="float:right; border: 1px #33F solid; margin-top: -26px;  text-align: center; height: 25px; font-family: sans-serif; font-size: 22px; width:106px;"  />-->
                                                    <input type="text" id="extra" name="extra"  class="extracargos" size="12" style="float:right;  text-align: right; color:#000; margin-top: -21px; margin-right:6px;  width:80px; height:25px;  border: 1px #33F solid; font-family: sans-serif; font-size: 22px; font-weight:bold;"   value="0.00" onkeypress="return soloextra(event);" onkeyup="resetextra();ponDecimales(2);" autocomplete="off" />
<!--                                                    <input name="extra" type="text" class="txtNumbers"  id="extra" size="12" style="float:right;  text-align: right; color:#000; margin-top: -17px; margin-right:0px;  width:106px; height:25px;  border: 1px #33F solid; font-family: sans-serif; font-size: 22px;"   value="<?php echo $data['tour']->extra_charge; ?>" autocomplete="off" onkeypress="validate(event);" onkeyup="resetextra();"/>-->
                                                    <br />
                                                </td>
                                            </tr>



                                        </table>


                                    </div>

                                    <div id="tabs" style="margin-left:524px; margin-top:184px; width:416px; height:164px;">
                                        <ul>
                                            <li><a href="#tabs-1">Notes</a></li>
                                            <!--                <li><a href="#tabs-2">Saved Notes</a></li>-->

                                        </ul>
                                        <div id="tabs-1">
                                            <textarea id="comments" name="comments" cols="0" rows="0" style="border-color:red; margin: 13px; width: 405px; height:116px; margin-top:-10px; margin-left:-16px;"></textarea> 
                                        </div>


                                    </div>
                                <div id="" style="margin-top: -3.5px; margin-left: 10px; position: absolute;">
                                     <input type="button" id="btn-cancel_oneday" style="margin-left: 669px; margin-top: -162px; cursor: pointer;"  class="oliverty" value="Cancel Tour" onClick="preguntaTrip();">
                                </div>
                                <div id="">
                                    <input  title="Save" class="oliverty"   type="button" id="btn-save2" class="link-button" onclick ="preguntarAntesDeSalir();" value="Confirm Tour"/> 
                                </div>

                                </div>
                                <div >
                                    <input  type="button" id="pay_driver" name="pay_driver" title="Add Payment" class="button_sliding_bg" onClick="mostrarVentana2();"  style="border-color: #000; border-bottom-left-radius: 0px; border-bottom-right-radius: 0px; border-top-left-radius: 0px; border-top-right-radius: 0px;  height: 30px; cursor:pointer; color: #fff; font-weight: 700; width: 132px;  padding: 6px;  margin-left: 381px; margin-top: -275.5px; padding-left: 6px; padding-top: 4.5px;" value="Add Payment"/>
                                </div>

                            <td>
                                <a  id="pago_agente" style="display:none;"><img style="width: 0px;   margin-left: -160px;  margin-top: 231px;  height: 28px; cursor:pointer" src="<?php echo $data['rootUrl']; ?>global/img/admin/charge.png" /></a>
                            </td>

                            </td>


                            <td width="5%">&nbsp;</td>
                            <td style="width:300px;" align="left" valign="bottom">

                            </td>
                        </tr>
                        <tr><!-- Detalles -->
                        <input type="hidden" value="0" type="number" readonly="readonly" name="total_first" id="total_first">
                        <input type="hidden" value="0" type="number" readonly="readonly" name="total_total" id="total_total">

                        <td>&nbsp;</td>
                        <td>

                        </td>
                        </tr>
                    </table>
                </fieldset>

                <fieldset style="display:none;">
                    <div id="userr" style="display:none;"></div>
                    <div id="mascaraP" style="display:none;"></div>
                    <div id="clienteN" style="display:none">
                        <div id="header_page">
                            <div class="header2">Customer</div>
                            <div id="toolbar">
                                <div class="toolbar-list">
                                    <ul>
                                        <li class="btn-toolbar" id="icon-back">
                                            <a class="link-button">
                                                <span class="icon-back" title="Editar">&nbsp;</span>
                                                Cancel
                                            </a>
                                        </li>
                                        <li class="btn-toolbar" id="icon-save">
                                            <a class="link-button">
                                                <span class="icon-32-save" title="Guardar">&nbsp;</span>
                                                Save
                                            </a>
                                        </li>
                                    </ul>
                                    <div class="clear"></div>
                                </div>
                                <div class="clear"></div>
                            </div>
                        </div>
                        <div id="serpare">
                            <fieldset><legend>Information</legend>
                                <div class="input">
                                    <label style="width:150px;" class="required" id="l_trip_no"></label>
                                    <label for="cardholder" title="Disable this option if the client is not the cardholder">CARDHOLDER  </label>
                                    <input type="checkbox" name="cardholder" checked="checked" id="cardholder">
                                </div>
                                <div id="div_form">

                                    <div class="input">
                                        <label style="width:150px" class="required" id="l_username">Username / E-mail*</label>
                                        <input type="text" name="username" id="username" size="25" maxlength="40" value="">
                                    </div>
                                    <div class="input">
                                        <label style="width:150px;" class="required" id="l_firstname">Firts Name*</label>
                                        <input type="text" name="firstname" id="firstname" size="25" maxlength="30" value="">
                                    </div>
                                    <div class="input">
                                        <label style="width:150px;" class="required" id="l_lastname">Last Name*</label>
                                        <input name="lastname" type="text" id="lastname" size="25" maxlength="30" value="">
                                    </div>
                                    <div class="input">
                                        <label style="width:150px;" class="required" id="l_phone">Phone</label>
                                        <input name="phone" type="text" id="phone" size="20" maxlength="20" value="">
                                    </div>
                                    <div class="input">
                                        <label style="width:150px;" class="required" id="l_country">Country</label>
                                        <select name="country" id="country" class="select">
                                            <option value=""></option>
                                            <?php foreach ($data['countries'] as $country) { ?>
                                                <option value="<?php echo $country['name']; ?>"><?php echo $country['name']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="input">
                                        <label style="width:150px;" class="required" id="l_state">State</label>
                                        <select name="state" id="state" class="select">
                                            <option value=""></option>
                                            <?php foreach ($data['states'] as $state) { ?>
                                                <option value="<?php echo $state['name']; ?>"><?php echo $state['name']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="input">
                                        <label style="width:150px;" class="required" id="l_city">City</label>
                                        <input name="city" type="text" id="city" size="25" maxlength="25" value="">
                                    </div>
                                    <div class="input">
                                        <label style="width:150px;" class="required" id="l_address">Address</label>
                                        <input name="address" type="text" id="address" size="25" maxlength="60" value="">
                                    </div>
                                    <div class="input">
                                        <label style="width:150px;" class="required" id="l_zip">Zip code</label>
                                        <input name="zip" type="text" id="zip" size="25" maxlength="25" value="">
                                    </div>
                                    <input name="id" type="hidden" id="id" value="">
                                </div>
                                <input name="frm" type="hidden" id="frm" value="1">
                                <input name="cliente_pagador" type="hidden" id="cliente_pagador" value="1">
                            </fieldset>
                        </div>
                    </div>
                </fieldset>
                <div id="rastrocomi">
                    <input id="rastrocom" type="hidden" name="rastrocom" value="<?php
                    if (isset($data['ta']->id)) {
                        echo $data['ta']->agency_fee;
                    }
                    ?>" readonly="readonly"/>
                </div>
                <div id="infodb">
                    <input type="hidden" id="complete" value="false">
                </div>



                <div style="margin-left:396px; margin-top: -254px; height:25px; width:133px;">
                    <select style="display:none; width:133px; margin-top:64px;" name="opcion_pago" id="op_pago_id" >
                        <optgroup label="COLLECT ON BOARD">
                            <option value="8">Credit Card no fee</option>
                            <option value="3">Credit Card with fee</option>
                            <option value="4">Cash</option>
                            <option value="9">Check</option>
                        </optgroup>
                        <optgroup label="VOUCHER">
                            <option value="5">Credit Voucher</option>
                        </optgroup>
                        <optgroup disabled= "disabled" label="COMPLEMENTARY">
                            <option value="7">Complementary</option>
                        </optgroup>
                    </select>

                </div>
                
                <div style="margin-left:396px; margin-top: -23px; height:25px; width:133px;">
                    <select style="width:133px; margin-top: 9px;" name="op_pago_conductor" id="op_pago_conductor" onclick="valida_voucher();" onchange="captura(); passenger_balance();" >
                        <optgroup label="COLLECT ON BOARD">
                            <option value="8">Credit Card no fee</option>
                            <option value="3">Credit Card with fee</option>
                            <option value="4">Cash</option>
                            <option value="9">Check</option>
                        </optgroup>
                        <optgroup label="VOUCHER">
                            <option value="5">Credit Voucher</option>
                        </optgroup>
                        <optgroup disabled= "disabled" label="COMPLEMENTARY">
                            <option value="7">Complementary</option>
                        </optgroup>
                    </select>

                </div>

                <select name="opcion_pago_2" id="op_pago_id2" style="display:none; margin-left:396px; margin-top:-65px; width: 133px; ">
                    <optgroup label="PRED-PAID">
                        <option value="2">Credit Card no fee</option>
                        <option value="1">Credit Card with fee</option>
                        <option value="6">Cash</option>
                        <option value="10">Check</option>
                    </optgroup>

                </select>

                <a  id="pago_agente1" style=" margin-right: 2px;"><img style="width:0px; height:4px; margin-top:120px; margin-left:614px;" src="<?php echo $data['rootUrl']; ?>global/img/admin/chargedisabled.png" /></a>

                <script>
                    $(function () {
                        $("#tabs").tabs();
                    });
                </script>
                
            
            
            <table width="100%" style="position:absolute; background-color: transparent; margin-top: -292px;; margin-left:540px; height:179px; width:181px;">
             
            <tr>
                <td style="margin-left:1px; margin-top:0px;">
                    
            <div id="miVentana2" style="position: absolute; width: 176px; height: 174px;  top:0px; left: -1px; font-family:Verdana, Arial, Helvetica, sans-serif; font-size: 12px; font-weight: normal; border: #333333 3px solid; background-color: #FAFAFA; color: #000000; display:none;"  >

            <div style="font-weight: bold; text-align: center; color: #FFFFFF; padding: 4.5px; background-color:#006394">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>


            <p>
                <label  id="tap" style="padding-left:57px; font-size:10px; "><strong style="padding-bottom:10px; color:#090; margin-left:-50px;">Total Amount Paid $</strong></label> 
                <input type="text" id="saldoPagado"  readonly="readonly" style="text-align: right; font-family: sans-serif; font-size: 10px; color:#090; font-weight: bold; padding-left:4px; margin-left: 126px; margin-top: -16px; width: 38px;" value="<?php echo number_format($pagado, 2, '.', ','); ?>"  />
            </p>

            <label  id="dolares" style="padding-left:57px; font-size:16px; "><strong style="padding-bottom:10px; color:#006394; margin-left:-19px;">$</strong></label> 

            <!--class="money"-->
            <input type="text"  id="pago_driver" name="pago_driver"  size="12" style="font-size: 22px; font-weight:bold; text-align:right; margin-top:-20px; margin-left:53px; width:114px; height:20px;" value="" onkeypress="return solopagodriver(event);"  onkeyup="dupliPago();ponDecimales(2);" placeholder="0.00" autocomplete="off"/>

            <input type="text" id="pago_driver2" name="pago_driver2" size="12" style="display:none;  margin-top:4px; margin-left:17px; width:114px; height:20px;" value="0.00" />

<!--            <input name="temp"  type="text" id="temp" title="Fees" size="12" style="display:none; margin-top:4px; margin-left:17px; width:114px; height:20px;" value="0.00" />-->

            <input type="text" id="collect" name="collect"  title="Paid Driver" size="12" style="display:none; margin-top:4px; margin-left:17px; width:114px; height:20px;" value="0.00" />

            <input type="text" id="prepaid" name="prepaid"  title="Amount Paid" size="12" style="display:none; margin-top:4px; margin-left:17px; width:114px; height:20px;" value="0.00" />


            <select name="opcion_pago1" id="op_pago_id1" style="margin-left:13px; margin-top: 8px;" disabled= "disabled" onchange="calculos();">
                <option style="color:red;" id="ppre" value="0">((( Amount Paid )))</option>
                <optgroup   label="PRE-PAID">
                    <option value="20">Credit Card NO Fee</option>
                    <option value="21">Credit Card with Fee</option>
                    <option value="22">Cash</option>
                    <option value="23">Check</option>
                </optgroup>
                <option  style="color:blue;" id="pdrv" value="1">((( Paid Driver )))</option>
                <optgroup   label="COLLECT ON BOARD">
                    <option  value="24">Credit Card NO Fee</option>
                    <option  value="25">Credit Card with Fee</option>
                    <option  value="26">Cash</option>
                    <option  value="27">Check</option>
                </optgroup>       


            </select>



<!--            <input name="opc_ap"  type="text" id="opc_ap" size="12" style="display:none;" value="" />
            <input name="PAP"  type="text" id="PAP" size="12" style="display:none;" value="0.00" />-->



<!--            <div class="paymentvertblack" style="padding: 9px;  text-align: center; margin-top: 9px;">

                <input id="btnExit" name="btnExit" type="button" style=" background-color: #006394; border-color: red; border-bottom-left-radius: 5px; border-bottom-right-radius: 5px; border-top-left-radius: 5px; border-top-right-radius: 5px; cursor:pointer; color:#fff; padding:2px; width:49px; font-weight: 700;" size="20"  value="Exit" onclick="Exit();"  />
                <input id="btnCancelar" name="btnCancelar" type="button" style="background-color: #006394; border-color: red; border-bottom-left-radius: 5px; border-bottom-right-radius: 5px; border-top-left-radius: 5px; border-top-right-radius: 5px; cursor:pointer; color:#fff; padding:2px; width:49px;font-weight: 700;"  size="20"  value="Reset" onclick="resetal(); reset2();"  />
                <input id="btnAceptar" name="btnAceptar" type="button" size="20" value="Save"  style="border-color: red; border-bottom-left-radius: 5px; border-bottom-right-radius: 5px; border-top-left-radius: 5px; border-top-right-radius: 5px; padding:2px; width:49px; font-weight: 700;" onclick="ocultarVentana2();" disabled="true" />


            </div>-->

            <div class="paymentvertblack" style="padding: 5px;  text-align: center; margin-top: 10px; height: 31px;">

                    <div>
                        <input type="button" id="btnExit" name="btnExit" style=" background-color: #006394; border-color: red; border-bottom-left-radius: 5px; border-bottom-right-radius: 5px; border-top-left-radius: 5px; border-top-right-radius: 5px; cursor:pointer; color:#fff; padding:5px; width:39px; height: 24px; font-size:9px; margin-top: 3px; margin-left: -124px; font-weight: bold;"  size="20"  value="EXIT" onclick="Exit();"  />
                    </div>
                    
                    <div>
                        <input type="button" id="btnCancelar" name="btnCancelar" style=" background-color: grey; border-color: #fff; border-bottom-left-radius: 5px; border-bottom-right-radius: 5px; border-top-left-radius: 5px; border-top-right-radius: 5px; cursor:pointer; color:#fff; margin-left: -26px; margin-top: -24px; padding:5px; padding-left:3px; width:49px; font-weight: bold; font-size:9px;"  size="20" disabled="true" value="CANCEL" onclick="resetal(); reset2();"  />
                    </div>
                    
                    <div>
                        <input type="button" id="btnAceptar" name="btnAceptar"  size="20" value="SAVE"  style=" border-color: #fff; border-bottom-left-radius: 5px; border-bottom-right-radius: 5px; border-top-left-radius: 5px; border-top-right-radius: 5px; width:68px; height: 24px; font-size:9px; font-weight: bold; margin-left: 98px; margin-top: -24px;" onclick="ocultarVentana2();" disabled="true" />
                    </div>
                        
                    <div>    
                        <input type="button" id="btnPagolinea" name="btnPagolinea"  size="20" value="MAKE CHARGE"  style=" display:none; border-color: palegreen; border-bottom-left-radius: 5px; border-bottom-right-radius: 5px; border-top-left-radius: 5px; border-top-right-radius: 5px; padding:5px; padding-left:2px; width:68px; height: 24px; font-weight: bold; margin-right: -100px; margin-top: -24px; font-size:8px;  color:#fff; background-color:#006400;" onclick="" disabled="true" />
                    </div>
                        
                    <div>
                        <input type="button" id="btndecline" name="btndecline"  size="20" value="CANCEL"  style="display:none; border-color: #fff; border-bottom-left-radius: 5px; border-bottom-right-radius: 5px; border-top-left-radius: 5px; border-top-right-radius: 5px; padding:5px; padding-left:3px; width:49px; height: 24px; font-weight: bold; margin-top: -24px; font-size:9px; margin-left: -26px; color:#fff; background-color:red;" onclick="declinar();" disabled="true" />
                    </div>
                    
                    <div>
                        <input type="button" id="btncancol" name="btncancol"  size="20" value="CANCEL"  style="display:none; background-color:red; border-color: #fff; border-bottom-left-radius: 5px; border-bottom-right-radius: 5px; border-top-left-radius: 5px; border-top-right-radius: 5px; padding:5px; padding-left:3px; width:49px; height: 24px; font-weight: bold; margin-top: -24px; font-size:9px; margin-left: -26px; color:#fff;" onclick="Exit_Cob();" disabled="true" />
                    </div>
                    
                    <input type="button" id="enviar_escondido" value="0" style="display:none;" />

            </div>


            </div> 
                    
           </td>
            
        </tr>
                
        </table>
               
                
        <div style="margin-top:124px;">
                    
                    
        <input name="temp"  type="text" id="temp" title="Fees" size="12" style="display:none; margin-top:4px; margin-left:126px; width:114px; height:20px;" value="0.00" />
        <input type="text" id="temp_driver"  name="temp_driver" title="Temp Driver" size="12" style="display:none; margin-top:4px; margin-left:60px; width:114px; height:20px;" value="0.00" />
        <input type="text" id="temp_prepaid"  name="temp_prepaid" title="Temp Prepaid" size="12" style="display:none; margin-top:4px; margin-left:64px; width:114px; height:20px;" value="0.00" />
        
        <br>
        </br>
            
        <input type="text" id="no_pago"  name="no_pago" title="# pago" size="12" style="display:none; margin-top:4px; margin-left:17px; width:18px; height:11px;" value="0" />
        <input type="text" id="no_prep"  name="no_prep" title="# prep" size="12" style="display:none; margin-top:4px; margin-left:417px; width:18px; height:11px;" value="0" />
        <br>
        </br>
        <input type="text" id="pago_1"  name="pago_1" title="pago # 1" size="12" style="display:none; margin-top:4px; margin-left:17px; width:18px; height:11px;" value="0" />
        <input type="text" id="pago1"  name="pago1" title="pago" size="12" style="display:none; margin-top:4px; margin-left:17px; width:114px; height:11px; font-size: 9px;" value="" />
        <input type="text" id="tipo_pago1"  name="tipo_pago1" title="tipo pago1" size="12" style="display:none; margin-top:4px; margin-left:17px; width:114px; height:11px; font-size: 9px;" value="" />
        <input type="text" id="pagado1"  name="pagado1" title="pagado1" size="12" style="display:none; margin-top:4px; margin-left:17px; width:59px; height:11px; text-align:right;" value="0.00" />
        <input type="text" id="estado_cob1"  name="estado_cob1" title="estado_cob1" size="12" style="display:none; margin-top:4px; margin-left:16px; width:59px; height:11px; text-align:right;" value="" />
        
        <input type="text" id="pago_pre1"  name="pago_pre1" title="pago # 1" size="12" style="display:none; margin-top:4px; margin-left:35px; width:18px; height:11px;" value="0" />
        <input type="text" id="pagopre1"  name="pagopre1" title="pago prep1" size="12" style="display:none; margin-top:4px; margin-left:16px; width:114px; height:11px; font-size: 9px;" value="" />
        <input type="text" id="tipo_pagopre1"  name="tipo_pagopre1" title="tipo pagopre1" size="12" style="display:none; margin-top:4px; margin-left:16px; width:114px; height:11px; font-size: 9px;" value="" />
        <input type="text" id="pagadopre1"  name="pagadopre1" title="pagadopre1" size="12" style="display:none; margin-top:4px; margin-left:16px; width:59px; height:11px; text-align:right;" value="0.00" />
        <input type="text" id="estado_pre1"  name="estado_pre1" title="estado_pre1" size="12" style="display:none; margin-top:4px; margin-left:16px; width:59px; height:11px; text-align:right;" value="" />
        
        <br>
        </br>
        <input type="text" id="pago_2"  name="pago_2" title="pago # 2" size="12" style="display:none; margin-top:4px; margin-left:17px; width:18px; height:11px;" value="0" />
        <input type="text" id="pago2"  name="pago2" title="pago" size="12" style="display:none; margin-top:4px; margin-left:17px; width:114px; height:11px; font-size: 9px;" value="" />
        <input type="text" id="tipo_pago2"  name="tipo_pago2" title="tipo pago2" size="12" style="display:none; margin-top:4px; margin-left:17px; width:114px; height:11px; font-size: 9px;" value="" />
        <input type="text" id="pagado2"  name="pagado2" title="pagado2" size="12" style="display:none; margin-top:4px; margin-left:17px; width:59px; height:11px; text-align:right;" value="0.00" />
        <input type="text" id="estado_cob2"  name="estado_cob2" title="estado_cob2" size="12" style="display:none; margin-top:4px; margin-left:16px; width:59px; height:11px; text-align:right;" value="" />
        
        <input type="text" id="pago_pre2"  name="pago_pre2" title="pago # 2" size="12" style="display:none; margin-top:4px; margin-left:35px; width:18px; height:11px;" value="0" />
        <input type="text" id="pagopre2"  name="pagopre2" title="pago prep2" size="12" style="display:none; margin-top:4px; margin-left:16px; width:114px; height:11px; font-size: 9px;" value="" />
        <input type="text" id="tipo_pagopre2"  name="tipo_pagopre2" title="tipo pagopre2" size="12" style="display:none; margin-top:4px; margin-left:16px; width:114px; height:11px; font-size: 9px;" value="" />
        <input type="text" id="pagadopre2"  name="pagadopre2" title="pagadopre2" size="12" style="display:none; margin-top:4px; margin-left:16px; width:59px; height:11px; text-align:right;" value="0.00" />        
        <input type="text" id="estado_pre2"  name="estado_pre1" title="estado_pre2" size="12" style="display:none; margin-top:4px; margin-left:16px; width:59px; height:11px; text-align:right;" value="" />

        <br>
        </br>
        <input type="text" id="pago_3"  name="pago_3" title="pago # 3" size="12" style="display:none; margin-top:4px; margin-left:17px; width:18px; height:11px;" value="0" />
        <input type="text" id="pago3"  name="pago3" title="pago" size="12" style="display:none; margin-top:4px; margin-left:17px; width:114px; height:11px; font-size: 9px;" value="" />
        <input type="text" id="tipo_pago3"  name="tipo_pago3" title="tipo pago3" size="12" style="display:none; margin-top:4px; margin-left:17px; width:114px; height:11px; font-size: 9px;" value="" />
        <input type="text" id="pagado3"  name="pagado3" title="pagado3" size="12" style="display:none; margin-top:4px; margin-left:17px; width:59px; height:11px; text-align:right;" value="0.00" />
        <input type="text" id="estado_cob3"  name="estado_cob3" title="estado_cob3" size="12" style="display:none; margin-top:4px; margin-left:16px; width:59px; height:11px; text-align:right;" value="" />
        

        <input type="text" id="pago_pre3"  name="pago_pre3" title="pago # 3" size="12" style="display:none; margin-top:4px; margin-left:35px; width:18px; height:11px;" value="0" />
        <input type="text" id="pagopre3"  name="pagopre3" title="pago prep3" size="12" style="display:none; margin-top:4px; margin-left:16px; width:114px; height:11px; font-size: 9px;" value="" />
        <input type="text" id="tipo_pagopre3"  name="tipo_pagopre3" title="tipo pagopre3" size="12" style="display:none; margin-top:4px; margin-left:16px; width:114px; height:11px; font-size: 9px;" value="" />
        <input type="text" id="pagadopre3"  name="pagadopre3" title="pagadopre3" size="12" style="display:none; margin-top:4px; margin-left:16px; width:59px; height:11px; text-align:right;" value="0.00" />
        <input type="text" id="estado_pre3"  name="estado_pre3" title="estado_pre3" size="12" style="display:none; margin-top:4px; margin-left:16px; width:59px; height:11px; text-align:right;" value="" />



        <br>
        </br>
        <input type="text" id="pago_4"  name="pago_4" title="pago # 4" size="12" style="display:none; margin-top:4px; margin-left:17px; width:18px; height:11px;" value="0" />
        <input type="text" id="pago4"  name="pago4" title="pago" size="12" style="display:none; margin-top:4px; margin-left:17px; width:114px; height:11px; font-size: 9px;" value="" />
        <input type="text" id="tipo_pago4"  name="tipo_pago4" title="tipo pago4" size="12" style="display:none; margin-top:4px; margin-left:17px; width:114px; height:11px; font-size: 9px;" value="" />
        <input type="text" id="pagado4"  name="pagado4" title="pagado4" size="12" style="display:none; margin-top:4px; margin-left:17px; width:59px; height:11px; text-align:right;" value="0.00" />        
        <input type="text" id="estado_cob4"  name="estado_cob4" title="estado_cob4" size="12" style="display:none; margin-top:4px; margin-left:16px; width:59px; height:11px; text-align:right;" value="" />

        <input type="text" id="pago_pre4"  name="pago_pre4" title="pago # 4" size="12" style="display:none; margin-top:4px; margin-left:35px; width:18px; height:11px;" value="0" />
        <input type="text" id="pagopre4"  name="pagopre4" title="pago prep4" size="12" style="display:none; margin-top:4px; margin-left:16px; width:114px; height:11px; font-size: 9px;" value="" />
        <input type="text" id="tipo_pagopre4"  name="tipo_pagopre4" title="tipo pagopre4" size="12" style="display:none; margin-top:4px; margin-left:16px; width:114px; height:11px; font-size: 9px;" value="" />
        <input type="text" id="pagadopre4"  name="pagadopre4" title="pagadopre4" size="12" style="display:none; margin-top:4px; margin-left:16px; width:59px; height:11px; text-align:right;" value="0.00" />
        <input type="text" id="estado_pre4"  name="estado_pre4" title="estado_pre4" size="12" style="display:none; margin-top:4px; margin-left:16px; width:59px; height:11px; text-align:right;" value="" />

        <br>
        </br>
        <input type="text" id="pago_5"  name="pago_5" title="pago # 5" size="12" style="display:none; margin-top:4px; margin-left:17px; width:18px; height:11px;" value="0" />
        <input type="text" id="pago5"  name="pago5" title="pago" size="12" style="display:none; margin-top:4px; margin-left:17px; width:114px; height:11px; font-size: 9px;" value="" />
        <input type="text" id="tipo_pago5"  name="tipo_pago5" title="tipo pago5" size="12" style="display:none; margin-top:4px; margin-left:17px; width:114px; height:11px; font-size: 9px;" value="" />
        <input type="text" id="pagado5"  name="pagado5" title="pagado5" size="12" style="display:none; margin-top:4px; margin-left:17px; width:59px; height:11px; text-align:right;" value="0.00" />
        <input type="text" id="estado_cob5"  name="estado_cob5" title="estado_cob5" size="12" style="display:none; margin-top:4px; margin-left:16px; width:59px; height:11px; text-align:right;" value="" />


        <input type="text" id="pago_pre5"  name="pago_pre5" title="pago # 5" size="12" style="display:none; margin-top:4px; margin-left:35px; width:18px; height:11px;" value="0" />
        <input type="text" id="pagopre5"  name="pagopre5" title="pago prep5" size="12" style="display:none; margin-top:4px; margin-left:16px; width:114px; height:11px; font-size: 9px;" value="" />
        <input type="text" id="tipo_pagopre5"  name="tipo_pagopre5" title="tipo pagopre5" size="12" style="display:none; margin-top:4px; margin-left:16px; width:114px; height:11px; font-size: 9px;" value="" />
        <input type="text" id="pagadopre5"  name="pagadopre5" title="pagadopre5" size="12" style="display:none; margin-top:4px; margin-left:16px; width:59px; height:11px; text-align:right;" value="0.00" />
        <input type="text" id="estado_pre5"  name="estado_pre5" title="estado_pre5" size="12" style="display:none; margin-top:4px; margin-left:16px; width:59px; height:11px; text-align:right;" value="" />
        
        <br>
        </br>
        <input type="text" id="pago_6"  name="pago_6" title="pago # 6" size="12" style="display:none; margin-top:4px; margin-left:17px; width:18px; height:11px;" value="0" />
        <input type="text" id="pago6"  name="pago6" title="pago" size="12" style="display:none; margin-top:4px; margin-left:17px; width:114px; height:11px; font-size: 9px;" value="" />
        <input type="text" id="tipo_pago6"  name="tipo_pago6" title="tipo pago6" size="12" style="display:none; margin-top:4px; margin-left:17px; width:114px; height:11px; font-size: 9px;" value="" />
        <input type="text" id="pagado6"  name="pagado6" title="pagado6" size="12" style="display:none; margin-top:4px; margin-left:17px; width:59px; height:11px; text-align:right;" value="0.00" />
        <input type="text" id="estado_cob6"  name="estado_cob6" title="estado_cob6" size="12" style="display:none; margin-top:4px; margin-left:16px; width:59px; height:11px; text-align:right;" value="" />

        <input type="text" id="pago_pre6"  name="pago_pre6" title="pago # 6" size="12" style="display:none; margin-top:4px; margin-left:35px; width:18px; height:11px;" value="0" />
        <input type="text" id="pagopre6"  name="pagopre6" title="pago prep6" size="12" style="display:none; margin-top:4px; margin-left:16px; width:114px; height:11px; font-size: 9px;" value="" />
        <input type="text" id="tipo_pagopre6"  name="tipo_pagopre6" title="tipo pagopre6" size="12" style="display:none; margin-top:4px; margin-left:16px; width:114px; height:11px; font-size: 9px;" value="" />
        <input type="text" id="pagadopre6"  name="pagadopre6" title="pagadopre6" size="12" style="display:none; margin-top:4px; margin-left:16px; width:59px; height:11px; text-align:right;" value="0.00" />
        <input type="text" id="estado_pre6"  name="estado_pre6" title="estado_pre6" size="12" style="display:none; margin-top:4px; margin-left:16px; width:59px; height:11px; text-align:right;" value="" />

        <br>
        </br>
        <input type="text" id="pago_7"  name="pago_7" title="pago # 7" size="12" style="display:none; margin-top:4px; margin-left:17px; width:18px; height:11px;" value="0" />
        <input type="text" id="pago7"  name="pago7" title="pago" size="12" style="display:none; margin-top:4px; margin-left:17px; width:114px; height:11px; font-size: 9px;" value="" />
        <input type="text" id="tipo_pago7"  name="tipo_pago7" title="tipo pago7" size="12" style="display:none; margin-top:4px; margin-left:17px; width:114px; height:11px; font-size: 9px;" value="" />
        <input type="text" id="pagado7"  name="pagado7" title="pagado7" size="12" style="display:none; margin-top:4px; margin-left:17px; width:59px; height:11px; text-align:right;" value="0.00" />
        <input type="text" id="estado_cob7"  name="estado_cob7" title="estado_cob7" size="12" style="display:none; margin-top:4px; margin-left:16px; width:59px; height:11px; text-align:right;" value="" />

        <input type="text" id="pago_pre7"  name="pago_pre7" title="pago # 7" size="12" style="display:none; margin-top:4px; margin-left:35px; width:18px; height:11px;" value="0" />
        <input type="text" id="pagopre7"  name="pagopre7" title="pago prep7" size="12" style="display:none; margin-top:4px; margin-left:16px; width:114px; height:11px; font-size: 9px;" value="" />
        <input type="text" id="tipo_pagopre7"  name="tipo_pagopre7" title="tipo pagopre7" size="12" style="display:none; margin-top:4px; margin-left:16px; width:114px; height:11px; font-size: 9px;" value="" />
        <input type="text" id="pagadopre7"  name="pagadopre7" title="pagadopre7" size="12" style="display:none; margin-top:4px; margin-left:16px; width:59px; height:11px; text-align:right;" value="0.00" />
        <input type="text" id="estado_pre7"  name="estado_pre7" title="estado_pre7" size="12" style="display:none; margin-top:4px; margin-left:16px; width:59px; height:11px; text-align:right;" value="" />

        <br>
        </br>
        <input type="text" id="pago_8"  name="pago_8" title="pago # 8" size="12" style="display:none; margin-top:4px; margin-left:17px; width:18px; height:11px;" value="0" />
        <input type="text" id="pago8"  name="pago8" title="pago" size="12" style="display:none; margin-top:4px; margin-left:17px; width:114px; height:11px; font-size: 9px;" value="" />
        <input type="text" id="tipo_pago8"  name="tipo_pago8" title="tipo pago8" size="12" style="display:none; margin-top:4px; margin-left:17px; width:114px; height:11px; font-size: 9px;" value="" />
        <input type="text" id="pagado8"  name="pagado8" title="pagado8" size="12" style="display:none; margin-top:4px; margin-left:17px; width:59px; height:11px; text-align:right;" value="0.00" />
        <input type="text" id="estado_cob8"  name="estado_cob8" title="estado_cob8" size="12" style="display:none; margin-top:4px; margin-left:16px; width:59px; height:11px; text-align:right;" value="" />

        <input type="text" id="pago_pre8"  name="pago_pre8" title="pago # 8" size="12" style="display:none; margin-top:4px; margin-left:35px; width:18px; height:11px;" value="0" />
        <input type="text" id="pagopre8"  name="pagopre8" title="pago prep8" size="12" style="display:none; margin-top:4px; margin-left:16px; width:114px; height:11px; font-size: 9px;" value="" />
        <input type="text" id="tipo_pagopre8"  name="tipo_pagopre8" title="tipo pagopre8" size="12" style="display:none; margin-top:4px; margin-left:16px; width:114px; height:11px; font-size: 9px;" value="" />
        <input type="text" id="pagadopre8"  name="pagadopre8" title="pagadopre8" size="12" style="display:none; margin-top:4px; margin-left:16px; width:59px; height:11px; text-align:right;" value="0.00" />
        <input type="text" id="estado_pre8"  name="estado_pre8" title="estado_pre8" size="12" style="display:none; margin-top:4px; margin-left:16px; width:59px; height:11px; text-align:right;" value="" />

        <br>
        </br>
        <input type="text" id="pago_9"  name="pago_9" title="pago # 9" size="12" style="display:none; margin-top:4px; margin-left:17px; width:18px; height:11px;" value="0" />
        <input type="text" id="pago9"  name="pago9" title="pago" size="12" style="display:none; margin-top:4px; margin-left:17px; width:114px; height:11px; font-size: 9px;" value="" />
        <input type="text" id="tipo_pago9"  name="tipo_pago9" title="tipo pago9" size="12" style="display:none; margin-top:4px; margin-left:17px; width:114px; height:11px; font-size: 9px;" value="" />
        <input type="text" id="pagado9"  name="pagado9" title="pagado9" size="12" style="display:none; margin-top:4px; margin-left:17px; width:59px; height:11px; text-align:right;" value="0.00" />
        <input type="text" id="estado_cob9"  name="estado_cob9" title="estado_cob9" size="12" style="display:none; margin-top:4px; margin-left:16px; width:59px; height:11px; text-align:right;" value="" />


        <input type="text" id="pago_pre9"  name="pago_pre9" title="pago # 9" size="12" style="display:none; margin-top:4px; margin-left:35px; width:18px; height:11px;" value="0" />
        <input type="text" id="pagopre9"  name="pagopre9" title="pago prep9" size="12" style="display:none; margin-top:4px; margin-left:16px; width:114px; height:11px; font-size: 9px;" value="" />
        <input type="text" id="tipo_pagopre9"  name="tipo_pagopre9" title="tipo pagopre9" size="12" style="display:none; margin-top:4px; margin-left:16px; width:114px; height:11px; font-size: 9px;" value="" />
        <input type="text" id="pagadopre9"  name="pagadopre9" title="pagadopre9" size="12" style="display:none; margin-top:4px; margin-left:16px; width:59px; height:11px; text-align:right;" value="0.00" />
        <input type="text" id="estado_pre9"  name="estado_pre9" title="estado_pre9" size="12" style="display:none; margin-top:4px; margin-left:16px; width:59px; height:11px; text-align:right;" value="" />


        <br>
        </br>
        <input type="text" id="pago_10"  name="pago_10" title="pago # 10" size="12" style="display:none; margin-top:4px; margin-left:17px; width:18px; height:11px;" value="0" />
        <input type="text" id="pago10"  name="pago10" title="pago" size="12" style="display:none; margin-top:4px; margin-left:17px; width:114px; height:11px; font-size: 9px;" value="" />
        <input type="text" id="tipo_pago10"  name="tipo_pago10" title="tipo pago10" size="12" style="display:none; margin-top:4px; margin-left:17px; width:114px; height:11px; font-size: 9px;" value="" />
        <input type="text" id="pagado10"  name="pagado10" title="pagado10" size="12" style="display:none; margin-top:4px; margin-left:17px; width:59px; height:11px; text-align:right;" value="0.00" />
        <input type="text" id="estado_cob10"  name="estado_cob10" title="estado_cob10" size="12" style="display:none; margin-top:4px; margin-left:16px; width:59px; height:11px; text-align:right;" value="" />

        <input type="text" id="pago_pre10"  name="pago_pre10" title="pago # 10" size="12" style="display:none; margin-top:4px; margin-left:35px; width:18px; height:11px;" value="0" />
        <input type="text" id="pagopre10"  name="pagopre10" title="pago prep10" size="12" style="display:none; margin-top:4px; margin-left:16px; width:114px; height:11px; font-size: 9px;" value="" />
        <input type="text" id="tipo_pagopre10"  name="tipo_pagopre10" title="tipo pagopre10" size="12" style="display:none; margin-top:4px; margin-left:16px; width:114px; height:11px; font-size: 9px;" value="" />
        <input type="text" id="pagadopre10"  name="pagadopre10" title="pagadopre10" size="12" style="display:none; margin-top:4px; margin-left:16px; width:59px; height:11px; text-align:right;" value="0.00" />
        <input type="text" id="estado_pre10"  name="estado_pre10" title="estado_pre10" size="12" style="display:none; margin-top:4px; margin-left:16px; width:59px; height:11px; text-align:right;" value="" />

        
        </div>

        <input type="text" style="display:none; margin-left: 158px; margin-top: 5px; width:30px; color: #0B55C4; font-weight: bold; font-size: 18px; text-align: center;" name="idagencia" id="idagencia"  size="10" maxlength="10"  value="" autocomplete="off"/>
        <input name="fecha_trip" type="text"  id="fecha_trip"  size="10" maxlength="16" value=""  autocomplete="off" style="display:none; height: 22px; text-align: center; font-weight:bold;" />
        
        <!--onClick="window.location.reload();"-->
        <input type="text" style="display:none; margin-left: 158px; margin-top: 5px; width:30px; color: #0B55C4; font-weight: bold; font-size: 18px; text-align: center;" name="incl_ticket" id="incl_ticket"  size="10" maxlength="10"  value="0" autocomplete="off"/>
        <input type="button" style="display:none;" id="btn-pax"   value="Change Pax" onclick="preguntaTrip2();"/> 
        
        </form> 
            
        
        
        <input type="button" style="display:none;" id="btn-load"   value="Cargar Puesto"/> 
        <input type="button" style="display:none;" id="btn-load2"   value="Cargar Puesto2"/> 
        <input type="button" style="display:none;" id="btn-update"   value="Actualizar Puesto"/> 
        
        <div id="puestosEnUso"></div>        
        <div id="CargaTrip"></div>
        <div style="display:none;" id="mensajeTrip"></div>
        
        <div class="" id="save2" style="position:absolute; overflow: visible; z-index: 1000; margin-left: 382px; margin-top: -186px; font-weight: bold; font-size: 16px; display:none;">                
                  
            <a style="margin-left: -133px; margin-top: -667px; position: absolute;" href='<?php echo $data['rootUrl'] ?>admin/onedaytour/add/'><img src ='<?php echo $data['rootUrl'] ?>global/img/spinner1.gif' width="25px" height="25px" margin-left="85px" margin-top="-127px">
    
        </div>      
        
        <div class="" id="save3" style="position:absolute; overflow: visible; z-index: 1000; margin-left: 382px; margin-top: -186px; font-weight: bold; font-size: 16px; display:none;">                
     
            <a style="margin-left: 331px; margin-top: -667px; position: absolute;" href='<?php echo $data['rootUrl'] ?>admin/onedaytour/add/'><img src ='<?php echo $data['rootUrl'] ?>global/img/spinner2.gif' width="25px" height="25px" margin-left="85px" margin-top="-127px">
        
        </div>       

        <script type="text/javascript">
            function cargando()
            {
                document.getElementById('save2').style.display = '';
                document.getElementById('save3').style.display = '';

            }
        </script>
            
              

    </div>

    </body>
    
    

    <script type="text/javascript">

        function comprobarScreen()
        {

            window.moveTo(0, 0);
            window.resizeTo(screen.width, screen.height);
            window.fullScreen;

            if (window.screen.availWidth <= 640) {
                window.parent.document.body.style.zoom = "62%";
            }

            if (window.screen.availWidth == 800) {
                window.parent.document.body.style.zoom = "78%";
            }
            
            if (window.screen.availWidth == 960) {
                window.parent.document.body.style.zoom = "100%";

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

            if (window.screen.availWidth == 1440) {
                window.parent.document.body.style.zoom = "100%";

            }

            if (window.screen.availWidth == 1600) {
                window.parent.document.body.style.zoom = "125%";

            }

            if (window.screen.availWidth == 1680) {
                window.parent.document.body.style.zoom = "125%";

            }

            if (window.screen.availWidth > 1680) {
                window.parent.document.body.style.zoom = "125%";

            }
        }

    </script>

    <script type="text/javascript">

        function make_charge()
        {

            var payamount = document.getElementById('pay_amount').value;


        }

    </script>

    <script type="text/javascript">

        function pago_click()
        {

        }

    </script>

    <script type="text/javascript">

        function outcharge()
        {


            var pamount = document.getElementById('pay_amount').value;


            if (pamount == 0) {


//                var pagt = document.getElementById('pago_agente');
//                pagt.style.display = 'none';

            } else {

//                pagt.style.display = 'block';

            }

        }

    </script>
    
    <script type="text/javascript">

            function passenger_balance()
            {


                var pago_conductor = document.getElementById('op_pago_conductor').value;


                //credit card no fee
                if (pago_conductor == 8) { 

                    document.getElementById('op_pago_conductor').value = "8";
                    document.getElementById('op_pago_id').value = "8";
                    calcularTotalPago();

                //credit card with fee
                }else if (pago_conductor == 3) {  
                    
                document.getElementById('op_pago_conductor').value = "3";
                document.getElementById('op_pago_id').value = "3";
                
                    setTimeout(function () {
                        
//                      $('op_pago_conductor option[value="3"]').attr("selected", true);

                        var balance = parseFloat($("#balance_due").val());
                        var porcbal = balance*0.04;
                        var tot_balance = parseFloat(balance) + parseFloat(porcbal);          

                        $("#balance_due").val((tot_balance).toFixed(2));


                    }, 0.01);
                    
                //cash
                }else  if (pago_conductor == 4) {   
                    
                    document.getElementById('op_pago_conductor').value = "4";
                    document.getElementById('op_pago_id').value = "4";
                    calcularTotalPago();                            
                
                //check
                }else if (pago_conductor == 9) {        
                    
                    document.getElementById('op_pago_conductor').value = "9";
                    document.getElementById('op_pago_id').value = "9";
                    calcularTotalPago();
                    
                //credit voucher
                }else if (pago_conductor == 5) {    
                    
                    document.getElementById('op_pago_conductor').value = "5";
                    document.getElementById('op_pago_id').value = "5";

                    setTimeout(function () {                        
                    
                        var cv = 0;
                        $("#saldoactual").val((cv).toFixed(2));
                        $("#paid_driver").val((cv).toFixed(2));
                        $("#balance_due").val((cv).toFixed(2));
                        
                    }, 0.01);    
                                
                }
//complementary
//                else if (pago_conductor == 7) {   
//                    
//                    document.getElementById('op_pago_conductor').value = "7";
//                    
//                    setTimeout(function () {                        
//                    
//                        var cv = 0;
//                        $("#saldoactual").val((cv).toFixed(2));
//                        $("#paid_driver").val((cv).toFixed(2));
//                        $("#balance_due").val((cv).toFixed(2));
//                        $("#totalAmount").text((cv).toFixed(2));
////                        $("#totaltotal").text((cv).toFixed(2));
//                        $("#pay_amount").val((cv).toFixed(2));                       
//                        $("#agency_balance_due").val((cv).toFixed(2));
//                        $("#otheramount").val((cv).toFixed(2));
//                        
//                    }, 0.01);    
//                }

            }

    </script>


    <script type="text/javascript">
        function resetal()
        {

            
            //document.getElementById('saldoporpagar').value = apagar;
            //var descuento = "0";            
    
            var pay_amount = '0.00';
            var otheramount = '0.00';

            var paid_driver = $("#paid_driver").val();
            var pago_driver = $("#pago_driver").val();
            var totalamount = $("#totalAmount").val();
            var saldoactual = $("#saldoactual").val();  
            var agencybaldue = $("#agency_balance_due").val();  
            var op_pag_conduct = $("#selectcond").val();

        
            $("#pay_amount").val(pay_amount);
            $("#otheramount").val(otheramount);
//        document.getElementById('pay_amount').value = pay_amount;

            

            document.getElementById('pago_driver').value = '';
            document.getElementById('paid_driver').value = '0.00';
            
            document.getElementById('pago_driver').style.color = '#848484';
            document.getElementById('pago_driver2').value = '0.00';
            
            document.getElementById('temp').value = '0.00';
            document.getElementById('PAP').value = '0.00';
            document.getElementById('agency_balance_due').value = '0.00';
            document.getElementById('temp_driver').value = '0.00';
            document.getElementById('temp_prepaid').value = '0.00';
            document.getElementById('pago_tarjeta').value = '0.00';
            document.getElementById('prepaid').value = '0.00';
            document.getElementById('collect').value = '0.00';
            
            document.getElementById('descuento_valor').value = '0.00';
            document.getElementById('descuento').value = '0';
            document.getElementById('extra').value = '0.00';

                       //Pagos Collect on Board
            document.getElementById('no_pago').value = '0';
            document.getElementById('pago_1').value = '0';
            document.getElementById('pago_2').value = '0';
            document.getElementById('pago_3').value = '0';
            document.getElementById('pago_4').value = '0';
            document.getElementById('pago_5').value = '0';
            document.getElementById('pago_6').value = '0';
            document.getElementById('pago_7').value = '0';
            document.getElementById('pago_8').value = '0';
            document.getElementById('pago_9').value = '0';
            document.getElementById('pago_10').value = '0';
            document.getElementById('pago1').value = '';
            document.getElementById('pago2').value = '';
            document.getElementById('pago3').value = '';
            document.getElementById('pago4').value = '';
            document.getElementById('pago5').value = '';
            document.getElementById('pago6').value = '';
            document.getElementById('pago7').value = '';
            document.getElementById('pago8').value = '';
            document.getElementById('pago9').value = '';
            document.getElementById('pago10').value = '';
            document.getElementById('tipo_pago1').value = '';
            document.getElementById('tipo_pago2').value = '';
            document.getElementById('tipo_pago3').value = '';
            document.getElementById('tipo_pago4').value = '';
            document.getElementById('tipo_pago5').value = '';
            document.getElementById('tipo_pago6').value = '';
            document.getElementById('tipo_pago7').value = '';
            document.getElementById('tipo_pago8').value = '';
            document.getElementById('tipo_pago9').value = '';
            document.getElementById('tipo_pago10').value = '';        
            document.getElementById('pagado1').value = '0.00';
            document.getElementById('pagado2').value = '0.00';
            document.getElementById('pagado3').value = '0.00';
            document.getElementById('pagado4').value = '0.00';
            document.getElementById('pagado5').value = '0.00';
            document.getElementById('pagado6').value = '0.00';
            document.getElementById('pagado7').value = '0.00';
            document.getElementById('pagado8').value = '0.00';
            document.getElementById('pagado9').value = '0.00';
            document.getElementById('pagado10').value = '0.00';


            //Pagos prepago

            document.getElementById('no_prep').value = '0';
            document.getElementById('pago_pre1').value = '0';
            document.getElementById('pago_pre2').value = '0';
            document.getElementById('pago_pre3').value = '0';
            document.getElementById('pago_pre4').value = '0';
            document.getElementById('pago_pre5').value = '0';
            document.getElementById('pago_pre6').value = '0';
            document.getElementById('pago_pre7').value = '0';
            document.getElementById('pago_pre8').value = '0';
            document.getElementById('pago_pre9').value = '0';
            document.getElementById('pago_pre10').value = '0';




            document.getElementById('pagopre1').value = '';
            document.getElementById('pagopre2').value = '';
            document.getElementById('pagopre3').value = '';
            document.getElementById('pagopre4').value = '';
            document.getElementById('pagopre5').value = '';
            document.getElementById('pagopre6').value = '';
            document.getElementById('pagopre7').value = '';
            document.getElementById('pagopre8').value = '';
            document.getElementById('pagopre9').value = '';
            document.getElementById('pagopre10').value = '';



            document.getElementById('tipo_pagopre1').value = '';
            document.getElementById('tipo_pagopre2').value = '';
            document.getElementById('tipo_pagopre3').value = '';
            document.getElementById('tipo_pagopre4').value = '';
            document.getElementById('tipo_pagopre5').value = '';
            document.getElementById('tipo_pagopre6').value = '';
            document.getElementById('tipo_pagopre7').value = '';
            document.getElementById('tipo_pagopre8').value = '';
            document.getElementById('tipo_pagopre9').value = '';
            document.getElementById('tipo_pagopre10').value = '';


            document.getElementById('pagadopre1').value = '0.00';
            document.getElementById('pagadopre2').value = '0.00';
            document.getElementById('pagadopre3').value = '0.00';
            document.getElementById('pagadopre4').value = '0.00';
            document.getElementById('pagadopre5').value = '0.00';
            document.getElementById('pagadopre6').value = '0.00';
            document.getElementById('pagadopre7').value = '0.00';
            document.getElementById('pagadopre8').value = '0.00';
            document.getElementById('pagadopre9').value = '0.00';
            document.getElementById('pagadopre10').value = '0.00';
            
            
            document.getElementById('pago_driver').disabled = false;
            
            document.getElementById('btnAceptar').style.background = '';
            document.getElementById('btnAceptar').style.color = '#000';
            document.getElementById('dolares').style.color = '#848484';
            document.getElementById('btnAceptar').style.cursor = '';
            
            document.getElementById('paid_driver').style.color = "#000";
            document.getElementById('pay_amount').style.color = "#000";
            document.getElementById('pay_amount').className = "azu";
            document.getElementById('paid_driver').className = "brown3";
            document.getElementById('paid_driver').title =""; 
            document.getElementById('pay_amount').title =""; 
        
        
            document.getElementById('op_pago_id2').value = 2;
            document.getElementById('op_pago_id1').value = 0;
            document.getElementById('op_pago_id').value = 8;
            document.getElementById('op_pago_conductor').value = 8; 
            document.getElementById('selectcond').value = 8; 
            
            calcularTotalPago();


        }
    </script>
    
    <script type="text/javascript">
    function reset2()
    {
        setTimeout(function () {

            $('#btnAceptar').click();
            //calcularTotalPago();


        }, 0.001);


        setTimeout(function () {

            tipopago();

        }, 100);

    }

</script>

<script type="text/javascript">

    function tipopago()
    {

        var op_pago = document.getElementById('op_pago').value;

        //CREDIT CARD NO FEE
        if (op_pago == 8) {

            document.getElementById('op_pago_id').value = 8;
            $('#op_pago_id').click();

        }

        //CREDIT CARD WITH FEE
        if (op_pago == 3) {
            
            document.getElementById('op_pago_id').value = 3;
            $('#op_pago_id').click();
            
            //balance_pasajero();

        }



        //CASH
        if (op_pago == 4) {

            document.getElementById('op_pago_id').value = 4;
            $('#op_pago_id').click();

        }

        //CREDIT VOUCHER
        if (op_pago == 9) {

            document.getElementById('op_pago_id').value = 9;
            $('#op_pago_id').click();

        }

        //CREDIT VOUCHER
        if (op_pago == 5) {

            document.getElementById('op_pago_id').value = 5;
            $('#op_pago_id').click();

        }

        //COMPLEMENTARY
        if (op_pago == 7) {

            document.getElementById('op_pago_id').value = 7;
            $('#op_pago_id').click();

        }
    }
</script>


    <script type="text/javascript">
        function dupliPago()
        {
//       ("#pago_driver").mask("99,99");
            var dupli = document.getElementById('pago_driver').value;
            document.getElementById('pago_driver2').value = dupli;

            if (dupli == '') {
                
//                document.getElementById('pago_driver').value = '0.00';
                document.getElementById('pago_driver').placeholder = "0.00"

                document.getElementById('pago_driver').style.color = '#848484';

                document.getElementById('dolares').style.color = '#848484';

                $("#pago_driver").focus();
            }

            if (dupli > '0.00') {
                
                document.getElementById("op_pago_id1").disabled = false;

                document.getElementById('pago_driver').style.color = '#000';

                document.getElementById('dolares').style.color = '#000';

                $("#pago_driver").focus();



            } else {

                document.getElementById("op_pago_id1").disabled = false;

                document.getElementById('pago_driver').style.color = '#000';

                document.getElementById('dolares').style.color = '#000';

                $("#pago_driver").focus();


            }

        }
    </script>

    <script>

        function calculos() {


            var opcion = $("#op_pago_id1").val();

            //PRED-PAID////////////////////////////////////////////

            //Credit Card no fee

            if (opcion === '20') {

                if (confirm('Confirme su Tipo de Pago !!!')) {
                    
                    var pago_driver2 = parseFloat($("#pago_driver2").val());
                    var agency_balance_due = parseFloat($("#agency_balance_due").val());
                    var total = parseFloat(pago_driver2);
                    var valor = 0;
                    var prepaid = parseFloat($("#prepaid").val());
                    var kollect = parseFloat($("#pago_driver").val());
                    
                    var no_prep =  document.getElementById("no_prep").value;
                    no_prep = parseInt(no_prep) + 1;
                    
                    var pago = 'PRED-PAID'; 
                    var tipo_pago = 'CREDIT CARD NO FEE';
                    
                    if(agency_balance_due <= "0"){                 
                         
                    document.getElementById('pago_driver').value = "0.00"; 
                    document.getElementById("btnPagolinea").disabled = true;
                    document.getElementById("btnPagolinea").style.display = "none";
                    document.getElementById("btndecline").style.display = "none"; 
                    document.getElementById("btnAceptar").disabled = true;
                    document.getElementById("btnAceptar").style.background = "lightgray";   
                    
                    alert("Este pago no puede ser Procesado!!!");              
                    Exit();
                    
                    }else{
                    
                    prepaid = parseFloat(prepaid) + parseFloat(total);
                    
                    $("#no_prep").val(no_prep);
                    $("#prepaid").val((prepaid).toFixed(2));
                    $("#pago_driver").val((total).toFixed(2));
                    $("#pago_tarjeta").val((total).toFixed(2));
                    $("#PAP").val((valor).toFixed(2));
                    
                    if(no_prep == 1){                    
                                      
                    document.getElementById("pago_pre1").value = no_prep;
                    document.getElementById("pagopre1").value = pago;
                    document.getElementById("tipo_pagopre1").value= tipo_pago;
                    $("#pagadopre1").val((kollect).toFixed(2));
                    $("#estado_pre1").val("temp_pre1");
                    
                    }else if(no_prep == 2){

                        document.getElementById("pago_pre2").value = no_prep;
                        document.getElementById("pagopre2").value = pago;
                        document.getElementById("tipo_pagopre2").value= tipo_pago;
                        $("#pagadopre2").val((kollect).toFixed(2));
                        $("#estado_pre2").val("temp_pre2");

                    }else if(no_prep == 3){

                        document.getElementById("pago_pre3").value = no_prep;
                        document.getElementById("pagopre3").value = pago;
                        document.getElementById("tipo_pagopre3").value= tipo_pago;
                        $("#pagadopre3").val((kollect).toFixed(2));
                        $("#estado_pre3").val("temp_pre3");

                    }else if(no_prep == 4){

                        document.getElementById("pago_pre4").value = no_prep;
                        document.getElementById("pagopre4").value = pago;
                        document.getElementById("tipo_pagopre4").value= tipo_pago;
                        $("#pagadopre4").val((kollect).toFixed(2));
                        $("#estado_pre4").val("temp_pre4");

                    }else if(no_prep == 5){

                        document.getElementById("pago_pre5").value = no_prep;
                        document.getElementById("pagopre5").value = pago;
                        document.getElementById("tipo_pagopre5").value= tipo_pago;
                        $("#pagadopre5").val((kollect).toFixed(2));
                        $("#estado_pre5").val("temp_pre5");

                    }else if(no_prep == 6){

                        document.getElementById("pago_pre6").value = no_prep;
                        document.getElementById("pagopre6").value = pago;
                        document.getElementById("tipo_pagopre6").value= tipo_pago;
                        $("#pagadopre6").val((kollect).toFixed(2));
                        $("#estado_pre6").val("temp_pre6");

                    }else if(no_prep == 7){

                        document.getElementById("pago_pre7").value = no_prep;
                        document.getElementById("pagopre7").value = pago;
                        document.getElementById("tipo_pagopre7").value= tipo_pago;
                        $("#pagadopre7").val((kollect).toFixed(2));
                        $("#estado_pre7").val("temp_pre7");

                    }else if(no_prep == 8){

                        document.getElementById("pago_pre8").value = no_prep;
                        document.getElementById("pagopre8").value = pago;
                        document.getElementById("tipo_pagopre8").value= tipo_pago;
                        $("#pagadopre8").val((kollect).toFixed(2));
                        $("#estado_pre8").val("temp_pre8");

                    }else if(no_prep == 9){

                        document.getElementById("pago_pre9").value = no_prep;
                        document.getElementById("pagopre9").value = pago;
                        document.getElementById("tipo_pagopre9").value= tipo_pago;
                        $("#pagadopre9").val((kollect).toFixed(2));
                        $("#estado_pre9").val("temp_pre9");

                    }else if(no_prep == 10){

                        document.getElementById("pago_pre10").value = no_prep;
                        document.getElementById("pagopre10").value = pago;
                        document.getElementById("tipo_pagopre10").value= tipo_pago;
                        $("#pagadopre10").val((kollect).toFixed(2));
                        $("#estado_pre10").val("temp_pre10");

                    }


                    document.getElementById("op_pago_id1").disabled = true;
                    document.getElementById("pago_driver").disabled = true;
                    document.getElementById('pago_driver').style.color = '#848484';
                    
                    document.getElementById("btnPagolinea").disabled = false;
                    document.getElementById("btnPagolinea").style.display = "";
                    document.getElementById("btnPagolinea").style.cursor = 'pointer';
                
                    document.getElementById("btndecline").disabled = false;
                    document.getElementById("btndecline").style.display = "";
                    document.getElementById("btndecline").style.cursor = 'pointer';   
                    
                    document.getElementById("btnExit").disabled = true;
                    document.getElementById("btnExit").style.display = "";                
                    document.getElementById("btnExit").style.cursor = '';
                    document.getElementById("btnExit").style.borderColor = "#696969";
                    document.getElementById("btnExit").style.background = "#696969"; 

                    document.getElementById("btnAceptar").disabled = false;
                    document.getElementById('btnAceptar').style.cursor = 'pointer';
                    document.getElementById('btnAceptar').style.background = '#006400';
                    document.getElementById('btnAceptar').style.color = '#fff';

                    document.getElementById('op_pago_id2').value = 2;
                    
                    valida_clase2();
                    }

                } else {
                    // Do nothing!
                    Exit2();
                }


            }

            //Credit Card with fee

            if (opcion === '21') {

                if (confirm('Confirme su Tipo de Pago !!!')) {

                    var pago_driver2 = parseFloat($("#pago_driver2").val());
                    var agency_balance_due = parseFloat($("#agency_balance_due").val());
                    var valor = parseFloat(pago_driver2) * 0.04;
                    var total = parseFloat(pago_driver2) + parseFloat(valor);
                    var temp = parseFloat($("#temp").val());
                    var temp_prepaid = parseFloat($("#temp_prepaid").val());
                    
                    var no_prep =  document.getElementById("no_prep").value;
                    no_prep = parseInt(no_prep) + 1;
                    
                    var pago = 'PRED-PAID'; 
                    var tipo_pago = 'CREDIT CARD WITH FEE';
                    
                    
                    if(agency_balance_due <= "0"){
                    
                    document.getElementById('pago_driver').value = "0.00"; 
                    document.getElementById("btnPagolinea").disabled = true;
                    document.getElementById("btnPagolinea").style.display = "none";
                    document.getElementById("btndecline").style.display = "none"; 
                    document.getElementById("btnAceptar").disabled = true;
                    document.getElementById("btnAceptar").style.background = "lightgray";   
                    
                    alert("Este pago no puede ser Procesado!!!");                    
                    Exit();
                    
                    }else{                    
                               
                    temp = parseFloat(temp) + parseFloat(valor);
                    temp_prepaid = parseFloat(temp_prepaid) + parseFloat(valor);

                    $("#temp").val((temp).toFixed(2));
                    $("#temp_prepaid").val((temp_prepaid).toFixed(2));
                    
                    var prepaid = parseFloat($("#prepaid").val());                    
                    prepaid = parseFloat(prepaid) + parseFloat(total);
                    
                    $("#no_prep").val(no_prep);
                    $("#prepaid").val((prepaid).toFixed(2));
                    $("#pago_driver").val((total).toFixed(2));
                    $("#pago_tarjeta").val((total).toFixed(2));
                    $("#tot_charge").val((temp).toFixed(2));
                    $("#PAP").val((valor).toFixed(2));
                    
                    if(no_prep == 1){
                                                          
                    document.getElementById("pago_pre1").value = no_prep;
                    document.getElementById("pagopre1").value = pago;
                    document.getElementById("tipo_pagopre1").value= tipo_pago;
                    $("#pagadopre1").val((total).toFixed(2));
                     $("#estado_pre1").val("temp_pre1");
                    
                    }else if(no_prep == 2){

                        document.getElementById("pago_pre2").value = no_prep;
                        document.getElementById("pagopre2").value = pago;
                        document.getElementById("tipo_pagopre2").value= tipo_pago;
                        $("#pagadopre2").val((total).toFixed(2));
                        $("#estado_pre2").val("temp_pre2");

                    }else if(no_prep == 3){

                        document.getElementById("pago_pre3").value = no_prep;
                        document.getElementById("pagopre3").value = pago;
                        document.getElementById("tipo_pagopre3").value= tipo_pago;
                        $("#pagadopre3").val((total).toFixed(2));
                        $("#estado_pre3").val("temp_pre3");

                    }else if(no_prep == 4){

                        document.getElementById("pago_pre4").value = no_prep;
                        document.getElementById("pagopre4").value = pago;
                        document.getElementById("tipo_pagopre4").value= tipo_pago;
                        $("#pagadopre4").val((total).toFixed(2));
                        $("#estado_pre4").val("temp_pre4");

                    }else if(no_prep == 5){

                        document.getElementById("pago_pre5").value = no_prep;
                        document.getElementById("pagopre5").value = pago;
                        document.getElementById("tipo_pagopre5").value= tipo_pago;
                        $("#pagadopre5").val((total).toFixed(2));
                        $("#estado_pre5").val("temp_pre5");

                    }else if(no_prep == 6){

                        document.getElementById("pago_pre6").value = no_prep;
                        document.getElementById("pagopre6").value = pago;
                        document.getElementById("tipo_pagopre6").value= tipo_pago;
                        $("#pagadopre6").val((total).toFixed(2));
                        $("#estado_pre6").val("temp_pre6");

                    }else if(no_prep == 7){

                        document.getElementById("pago_pre7").value = no_prep;
                        document.getElementById("pagopre7").value = pago;
                        document.getElementById("tipo_pagopre7").value= tipo_pago;
                        $("#pagadopre7").val((total).toFixed(2));
                        $("#estado_pre7").val("temp_pre7");

                    }else if(no_prep == 8){

                        document.getElementById("pago_pre8").value = no_prep;
                        document.getElementById("pagopre8").value = pago;
                        document.getElementById("tipo_pagopre8").value= tipo_pago;
                        $("#pagadopre8").val((total).toFixed(2));
                        $("#estado_pre8").val("temp_pre8");

                    }else if(no_prep == 9){

                        document.getElementById("pago_pre9").value = no_prep;
                        document.getElementById("pagopre9").value = pago;
                        document.getElementById("tipo_pagopre9").value= tipo_pago;
                        $("#pagadopre9").val((total).toFixed(2));
                        $("#estado_pre9").val("temp_pre9");

                    }else if(no_prep == 10){

                        document.getElementById("pago_pre10").value = no_prep;
                        document.getElementById("pagopre10").value = pago;
                        document.getElementById("tipo_pagopre10").value= tipo_pago;
                        $("#pagadopre10").val((total).toFixed(2));
                        $("#estado_pre10").val("temp_pre10");

                    }


                    document.getElementById("op_pago_id1").disabled = true;
                    document.getElementById("pago_driver").disabled = true;
                    document.getElementById('pago_driver').style.color = '#848484';
                    
                    document.getElementById("btnExit").disabled = true;
                    document.getElementById("btnExit").style.display = '';                
                    document.getElementById("btnExit").style.cursor = '';
                    document.getElementById("btnExit").style.borderColor = '#696969';
                    document.getElementById("btnExit").style.background = '#696969';
                    
                    document.getElementById("btnPagolinea").disabled = false;
                    document.getElementById("btnPagolinea").style.display = "";
                    document.getElementById("btnPagolinea").style.cursor = 'pointer';

                    document.getElementById("btndecline").disabled = false;
                    document.getElementById("btndecline").style.display = "";
                    document.getElementById("btndecline").style.cursor = 'pointer';

                    document.getElementById("btnAceptar").disabled = false;
                    document.getElementById('btnAceptar').style.cursor = 'pointer';
                    document.getElementById('btnAceptar').style.background = '#006400';
                    document.getElementById('btnAceptar').style.color = '#fff';
                    document.getElementById('op_pago_id2').value = 1;
                    
                    valida_clase2();
                    
                    }

                } else {
                    // Do nothing!
                    Exit2();
                }


            }

            //Cash
            if (opcion === '22') {

                if (confirm('Confirme su Tipo de Pago !!!')) {

                    var pago_driver2 = parseFloat($("#pago_driver2").val());
                    var agency_balance_due = parseFloat($("#agency_balance_due").val());
                    var total = parseFloat(pago_driver2);
                    var valor = 0;
                    var prepaid = parseFloat($("#prepaid").val());
                    
                    var no_prep =  document.getElementById("no_prep").value;
                    no_prep = parseInt(no_prep) + 1;

                    var pago = 'PRED-PAID'; 
                    var tipo_pago = 'CASH';
                    
                    if(agency_balance_due <= "0"){
                    
                    document.getElementById('pago_driver').value = "0.00"; 
                    document.getElementById("btnPagolinea").disabled = true;
                    document.getElementById("btnPagolinea").style.display = "none";
                    document.getElementById("btndecline").style.display = "none"; 
                    document.getElementById("btnAceptar").disabled = true;
                    document.getElementById("btnAceptar").style.background = "lightgray";   
                    
                    alert("Este pago no puede ser Procesado!!!");
                    Exit();
                    
                    }else{
                
                    prepaid = parseFloat(prepaid) + parseFloat(total);

                    $("#no_prep").val(no_prep);
                    $("#prepaid").val((prepaid).toFixed(2));
                    $("#pago_driver").val((total).toFixed(2));
                    $("#PAP").val((valor).toFixed(2));

                    if(no_prep == 1){                    
                                      
                    document.getElementById("pago_pre1").value = no_prep;
                    document.getElementById("pagopre1").value = pago;
                    document.getElementById("tipo_pagopre1").value= tipo_pago;
                    $("#pagadopre1").val((total).toFixed(2));
                    $("#estado_pre1").val("temp_pre1");

                    }else if(no_prep == 2){

                        document.getElementById("pago_pre2").value = no_prep;
                        document.getElementById("pagopre2").value = pago;
                        document.getElementById("tipo_pagopre2").value= tipo_pago;
                        $("#pagadopre2").val((total).toFixed(2));
                        $("#estado_pre2").val("temp_pre2");

                    }else if(no_prep == 3){

                        document.getElementById("pago_pre3").value = no_prep;
                        document.getElementById("pagopre3").value = pago;
                        document.getElementById("tipo_pagopre3").value= tipo_pago;
                        $("#pagadopre3").val((total).toFixed(2));
                        $("#estado_pre3").val("temp_pre3");

                    }else if(no_prep == 4){

                        document.getElementById("pago_pre4").value = no_prep;
                        document.getElementById("pagopre4").value = pago;
                        document.getElementById("tipo_pagopre4").value= tipo_pago;
                        $("#pagadopre4").val((total).toFixed(2));
                        $("#estado_pre4").val("temp_pre4");

                    }else if(no_prep == 5){

                        document.getElementById("pago_pre5").value = no_prep;
                        document.getElementById("pagopre5").value = pago;
                        document.getElementById("tipo_pagopre5").value= tipo_pago;
                        $("#pagadopre5").val((total).toFixed(2));
                        $("#estado_pre5").val("temp_pre5");

                    }else if(no_prep == 6){

                        document.getElementById("pago_pre6").value = no_prep;
                        document.getElementById("pagopre6").value = pago;
                        document.getElementById("tipo_pagopre6").value= tipo_pago;
                        $("#pagadopre6").val((total).toFixed(2));
                        $("#estado_pre6").val("temp_pre6");

                    }else if(no_prep == 7){

                        document.getElementById("pago_pre7").value = no_prep;
                        document.getElementById("pagopre7").value = pago;
                        document.getElementById("tipo_pagopre7").value= tipo_pago;
                        $("#pagadopre7").val((total).toFixed(2));
                        $("#estado_pre7").val("temp_pre7");

                    }else if(no_prep == 8){

                        document.getElementById("pago_pre8").value = no_prep;
                        document.getElementById("pagopre8").value = pago;
                        document.getElementById("tipo_pagopre8").value= tipo_pago;
                        $("#pagadopre8").val((total).toFixed(2));
                        $("#estado_pre8").val("temp_pre8");

                    }else if(no_prep == 9){

                        document.getElementById("pago_pre9").value = no_prep;
                        document.getElementById("pagopre9").value = pago;
                        document.getElementById("tipo_pagopre9").value= tipo_pago;
                        $("#pagadopre9").val((total).toFixed(2));
                        $("#estado_pre9").val("temp_pre9");

                    }else if(no_prep == 10){

                        document.getElementById("pago_pre10").value = no_prep;
                        document.getElementById("pagopre10").value = pago;
                        document.getElementById("tipo_pagopre10").value= tipo_pago;
                        $("#pagadopre10").val((total).toFixed(2));
                        $("#estado_pre10").val("temp_pre10");

                    }


                    document.getElementById("op_pago_id1").disabled = true;
                    document.getElementById("pago_driver").disabled = true;
                    document.getElementById('pago_driver').style.color = '#848484';
                    
                    document.getElementById("btndecline").disabled = false;
                    document.getElementById("btndecline").style.display = "";
                    document.getElementById("btndecline").style.cursor = 'pointer'; 
                    
                    document.getElementById("btnExit").disabled = true;
                    document.getElementById("btnExit").style.display = '';                
                    document.getElementById("btnExit").style.cursor = '';
                    document.getElementById("btnExit").style.borderColor = "#696969";
                    document.getElementById("btnExit").style.background = "#696969";

                    document.getElementById('btnAceptar').style.cursor = 'pointer';
                    document.getElementById("btnAceptar").disabled = false;
                    document.getElementById('btnAceptar').style.background = '#006400';
                    document.getElementById('btnAceptar').style.color = '#fff';
                    document.getElementById('op_pago_id2').value = 6;
                    
                    valida_clase2();
                    
                    }

                } else {
                    // Do nothing!
                    Exit2();
                }


            }

            //Check
            if (opcion === '23') {

                if (confirm('Confirme su Tipo de Pago !!!')) {

                    var pago_driver2 = parseFloat($("#pago_driver2").val());
                    var agency_balance_due = parseFloat($("#agency_balance_due").val());
                    var total = parseFloat(pago_driver2);
                    var valor = 0;
                    var prepaid = parseFloat($("#prepaid").val());                  
                    
                    var no_prep =  document.getElementById("no_prep").value;
                    no_prep = parseInt(no_prep) + 1;
                    
                    var pago = 'PRED-PAID'; 
                    var tipo_pago = 'CHECK';
                    
                    if(agency_balance_due <= "0"){
                    
                    document.getElementById('pago_driver').value = "0.00"; 
                    document.getElementById("btnPagolinea").disabled = true;
                    document.getElementById("btnPagolinea").style.display = "none";
                    document.getElementById("btndecline").style.display = "none"; 
                    document.getElementById("btnAceptar").disabled = true;
                    document.getElementById("btnAceptar").style.background = "lightgray";   


                    alert("Este pago no puede ser Procesado!!!");
                    Exit();
                    
                    }else{
                    
                    prepaid = parseFloat(prepaid) + parseFloat(total);
                    $("#no_prep").val(no_prep);
                    $("#prepaid").val((prepaid).toFixed(2));
                    $("#pago_driver").val((total).toFixed(2));
                    $("#PAP").val((valor).toFixed(2));
                    
                    if(no_prep == 1){
                    
                                      
                    document.getElementById("pago_pre1").value = no_prep;
                    document.getElementById("pagopre1").value = pago;
                    document.getElementById("tipo_pagopre1").value= tipo_pago;
                    $("#pagadopre1").val((total).toFixed(2));
                    $("#estado_pre1").val("temp_pre1");
                    
                    }else if(no_prep == 2){

                        document.getElementById("pago_pre2").value = no_prep;
                        document.getElementById("pagopre2").value = pago;
                        document.getElementById("tipo_pagopre2").value= tipo_pago;
                        $("#pagadopre2").val((total).toFixed(2));
                        $("#estado_pre2").val("temp_pre2");

                    }else if(no_prep == 3){

                        document.getElementById("pago_pre3").value = no_prep;
                        document.getElementById("pagopre3").value = pago;
                        document.getElementById("tipo_pagopre3").value= tipo_pago;
                        $("#pagadopre3").val((total).toFixed(2));
                        $("#estado_pre3").val("temp_pre3");

                    }else if(no_prep == 4){

                        document.getElementById("pago_pre4").value = no_prep;
                        document.getElementById("pagopre4").value = pago;
                        document.getElementById("tipo_pagopre4").value= tipo_pago;
                        $("#pagadopre4").val((total).toFixed(2));
                        $("#estado_pre4").val("temp_pre4");

                    }else if(no_prep == 5){

                        document.getElementById("pago_pre5").value = no_prep;
                        document.getElementById("pagopre5").value = pago;
                        document.getElementById("tipo_pagopre5").value= tipo_pago;
                        $("#pagadopre5").val((total).toFixed(2));
                        $("#estado_pre5").val("temp_pre5");

                    }else if(no_prep == 6){

                        document.getElementById("pago_pre6").value = no_prep;
                        document.getElementById("pagopre6").value = pago;
                        document.getElementById("tipo_pagopre6").value= tipo_pago;
                        $("#pagadopre6").val((total).toFixed(2));
                        $("#estado_pre6").val("temp_pre6");

                    }else if(no_prep == 7){

                        document.getElementById("pago_pre7").value = no_prep;
                        document.getElementById("pagopre7").value = pago;
                        document.getElementById("tipo_pagopre7").value= tipo_pago;
                        $("#pagadopre7").val((total).toFixed(2));
                        $("#estado_pre7").val("temp_pre7");

                    }else if(no_prep == 8){

                        document.getElementById("pago_pre8").value = no_prep;
                        document.getElementById("pagopre8").value = pago;
                        document.getElementById("tipo_pagopre8").value= tipo_pago;
                        $("#pagadopre8").val((total).toFixed(2));
                        $("#estado_pre8").val("temp_pre8");

                    }else if(no_prep == 9){

                        document.getElementById("pago_pre9").value = no_prep;
                        document.getElementById("pagopre9").value = pago;
                        document.getElementById("tipo_pagopre9").value= tipo_pago;
                        $("#pagadopre9").val((total).toFixed(2));
                        $("#estado_pre9").val("temp_pre9");

                    }else if(no_prep == 10){

                        document.getElementById("pago_pre10").value = no_prep;
                        document.getElementById("pagopre10").value = pago;
                        document.getElementById("tipo_pagopre10").value= tipo_pago;
                        $("#pagadopre10").val((total).toFixed(2));
                        $("#estado_pre10").val("temp_pre10");

                    }


                    document.getElementById("op_pago_id1").disabled = true;
                    document.getElementById("pago_driver").disabled = true;
                    document.getElementById('pago_driver').style.color = '#848484';
                    
                    document.getElementById("btndecline").disabled = false;
                    document.getElementById("btndecline").style.display = "";
                    document.getElementById("btndecline").style.cursor = 'pointer';
                    
                    document.getElementById("btnExit").disabled = true;
                    document.getElementById("btnExit").style.display = '';                
                    document.getElementById("btnExit").style.cursor = '';
                    document.getElementById("btnExit").style.borderColor = "#696969";
                    document.getElementById("btnExit").style.background = "#696969";

                    document.getElementById('btnAceptar').style.cursor = 'pointer';
                    document.getElementById("btnAceptar").disabled = false;
                    document.getElementById('btnAceptar').style.background = '#006400';
                    document.getElementById('btnAceptar').style.color = '#fff';
                    document.getElementById('op_pago_id2').value = 10;
                    
                    valida_clase2();
                    
                    }

                } else {
                    // Do nothing!
                   Exit2();
                }

            }
            
            //COLLECT ON BOARD//////////////////////////////////////

            //Credit Card no fee
            if (opcion === '24') {

                if (confirm('Confirme su Tipo de Pago !!!')) {

                   
                    var pago_driver2 = parseFloat($("#pago_driver2").val());
                    var balance_due = parseFloat($("#balance_due").val());
                    var total = parseFloat(pago_driver2);
                    var valor = 0;
                    var collect = parseFloat($("#collect").val());
                    var kollect = parseFloat($("#pago_driver").val());
                    
                    var no_pago =  document.getElementById("no_pago").value;
                    no_pago = parseInt(no_pago) + 1;
                    
                    var pago = 'COLLECT ON BOARD'; 
                    var tipo_pago = 'CREDIT CARD NO FEE';
                    
                    if(balance_due <= "0"){
                    
                    document.getElementById('pago_driver').value = "0.00"; 
                    document.getElementById("btnPagolinea").disabled = true;
                    document.getElementById("btnPagolinea").style.display = "none";
                    document.getElementById("btndecline").style.display = "none"; 
                    document.getElementById("btncancol").style.display = "none";
                    document.getElementById("btnAceptar").disabled = true;
                    document.getElementById("btnAceptar").style.background = "lightgray";   

                    
                    alert("Este pago no puede ser Procesado!!!");
                    Exit();
                    
                    }else{
                    
                    $("#no_pago").val(no_pago);
                    collect = parseFloat(collect) + parseFloat(total);
                    $("#collect").val((collect).toFixed(2));
                    $("#pago_driver").val((total).toFixed(2));
                    $("#PAP").val((valor).toFixed(2));
                    
                    if(no_pago == 1){                    
                                      
                    document.getElementById("pago_1").value = no_pago;
                    document.getElementById("pago1").value = pago;
                    document.getElementById("tipo_pago1").value= tipo_pago;
                    $("#pagado1").val((kollect).toFixed(2));
                    $("#estado_cob1").val("temp_cob1");
                    
                    }else if(no_pago == 2){

                        document.getElementById("pago_2").value = no_pago;
                        document.getElementById("pago2").value = pago;
                        document.getElementById("tipo_pago2").value= tipo_pago;
                        $("#pagado2").val((kollect).toFixed(2));
                        $("#estado_cob2").val("temp_cob2");

                    }else if(no_pago == 3){

                        document.getElementById("pago_3").value = no_pago;
                        document.getElementById("pago3").value = pago;
                        document.getElementById("tipo_pago3").value= tipo_pago;
                        $("#pagado3").val((kollect).toFixed(2));
                        $("#estado_cob3").val("temp_cob3");

                    }else if(no_pago == 4){

                        document.getElementById("pago_4").value = no_pago;
                        document.getElementById("pago4").value = pago;
                        document.getElementById("tipo_pago4").value= tipo_pago;
                        $("#pagado4").val((kollect).toFixed(2));
                        $("#estado_cob4").val("temp_cob4");

                    }else if(no_pago == 5){

                        document.getElementById("pago_5").value = no_pago;
                        document.getElementById("pago5").value = pago;
                        document.getElementById("tipo_pago5").value= tipo_pago;
                        $("#pagado5").val((kollect).toFixed(2));
                        $("#estado_cob5").val("temp_cob5");

                    }else if(no_pago == 6){

                        document.getElementById("pago_6").value = no_pago;
                        document.getElementById("pago6").value = pago;
                        document.getElementById("tipo_pago6").value= tipo_pago;
                        $("#pagado6").val((kollect).toFixed(2));
                        $("#estado_cob6").val("temp_cob6");

                    }else if(no_pago == 7){

                        document.getElementById("pago_7").value = no_pago;
                        document.getElementById("pago7").value = pago;
                        document.getElementById("tipo_pago7").value= tipo_pago;
                        $("#pagado7").val((kollect).toFixed(2));
                        $("#estado_cob7").val("temp_cob7");

                    }else if(no_pago == 8){

                        document.getElementById("pago_8").value = no_pago;
                        document.getElementById("pago8").value = pago;
                        document.getElementById("tipo_pago8").value= tipo_pago;
                        $("#pagado8").val((kollect).toFixed(2));
                        $("#estado_cob8").val("temp_cob8");

                    }else if(no_pago == 9){

                        document.getElementById("pago_9").value = no_pago;
                        document.getElementById("pago9").value = pago;
                        document.getElementById("tipo_pago9").value= tipo_pago;
                        $("#pagado9").val((kollect).toFixed(2));
                        $("#estado_cob9").val("temp_cob9");

                    }else if(no_pago == 10){

                        document.getElementById("pago_10").value = no_pago;
                        document.getElementById("pago10").value = pago;
                        document.getElementById("tipo_pago10").value= tipo_pago;
                        $("#pagado10").val((kollect).toFixed(2));
                        $("#estado_cob10").val("temp_cob10");

                    }
                    
                    
                    document.getElementById("btndecline").disabled = true;
                    document.getElementById("btndecline").style.display = "none";
                    document.getElementById("btndecline").style.cursor = '';
                    
                    document.getElementById("btnExit").disabled = true;
                    document.getElementById("btnExit").style.display = '';                
                    document.getElementById("btnExit").style.cursor = '';
                    document.getElementById("btnExit").style.borderColor = "#696969";
                    document.getElementById("btnExit").style.background = "#696969";

                    document.getElementById("btncancol").disabled = false;
                    document.getElementById("btncancol").style.display = "";
                    document.getElementById("btncancol").style.cursor = 'pointer';

                    document.getElementById("op_pago_id1").disabled = true;
                    document.getElementById("pago_driver").disabled = true;
                    document.getElementById('pago_driver').style.color = '#848484';
                    
                    document.getElementById('btnAceptar').style.cursor = 'pointer';
                    document.getElementById("btnAceptar").disabled = false;
                    document.getElementById('btnAceptar').style.background = '#006400';
                    document.getElementById('btnAceptar').style.color = '#fff';                    
                    document.getElementById('op_pago_id').value = 8;
                    
                    valida_clase();
                    
                    }

                } else {
                    // Do nothing!
                    Exit2();
                }


            }

            //Credit Card with fee
            if (opcion === '25') {

                if (confirm('Confirme su Tipo de Pago !!!')) {

                    
                    var pago_driver = parseFloat($("#pago_driver").val());
                    var balance_due = parseFloat($("#balance_due").val());
                    var valor = parseFloat(pago_driver) * 0.04;
                    var total = parseFloat(pago_driver) + parseFloat(valor);
                    var temp = parseFloat($("#temp").val());
                    var temp_driver = parseFloat($("#temp_driver").val()); 
                    
                    
                    var no_pago =  document.getElementById("no_pago").value;                
                    no_pago = parseInt(no_pago) + 1;
                    
                    var pago = 'COLLECT ON BOARD'; 
                    var tipo_pago = 'CREDIT CARD WITH FEE';
                    
                    if(balance_due <= "0"){
                    
                    document.getElementById('pago_driver').value = "0.00"; 
                    document.getElementById("btnPagolinea").disabled = true;
                    document.getElementById("btnPagolinea").style.display = "none";
                    document.getElementById("btndecline").style.display = "none"; 
                    document.getElementById("btncancol").style.display = "none";
                    document.getElementById("btnAceptar").disabled = true;
                    document.getElementById("btnAceptar").style.background = "lightgray";   

                    
                    alert("Este pago no puede ser Procesado!!!");
                    Exit();
                    
                    }else{                    

                    temp = parseFloat(temp) + parseFloat(valor);
                    temp_driver = parseFloat(temp_driver) + parseFloat(valor);
                    
                    $("#temp").val((temp).toFixed(2));
                    $("#temp_driver").val((temp_driver).toFixed(2));
                    $("#no_pago").val(no_pago);
                    
                    var collect = parseFloat($("#collect").val());
                    collect = parseFloat(collect) + parseFloat(total);
                    
                    $("#collect").val((collect).toFixed(2));
                    $("#pago_driver").val((total).toFixed(2));                
                    $("#PAP").val((valor).toFixed(2));
                    $("#tot_charge").val((temp).toFixed(2));
                    
                    if(no_pago == 1){                    
                                      
                    document.getElementById("pago_1").value = no_pago;
                    document.getElementById("pago1").value = pago;
                    document.getElementById("tipo_pago1").value= tipo_pago;
                    $("#pagado1").val((total).toFixed(2));
                    $("#estado_cob1").val("temp_cob1");
                    
                    }else if(no_pago == 2){

                        document.getElementById("pago_2").value = no_pago;
                        document.getElementById("pago2").value = pago;
                        document.getElementById("tipo_pago2").value= tipo_pago;
                        $("#pagado2").val((total).toFixed(2));
                        $("#estado_cob2").val("temp_cob2");

                    }else if(no_pago == 3){

                        document.getElementById("pago_3").value = no_pago;
                        document.getElementById("pago3").value = pago;
                        document.getElementById("tipo_pago3").value= tipo_pago;
                        $("#pagado3").val((total).toFixed(2));
                        $("#estado_cob3").val("temp_cob3");

                    }else if(no_pago == 4){

                        document.getElementById("pago_4").value = no_pago;
                        document.getElementById("pago4").value = pago;
                        document.getElementById("tipo_pago4").value= tipo_pago;
                        $("#pagado4").val((total).toFixed(2));
                        $("#estado_cob4").val("temp_cob4");

                    }else if(no_pago == 5){

                        document.getElementById("pago_5").value = no_pago;
                        document.getElementById("pago5").value = pago;
                        document.getElementById("tipo_pago5").value= tipo_pago;
                        $("#pagado5").val((total).toFixed(2));
                        $("#estado_cob5").val("temp_cob5");

                    }else if(no_pago == 6){

                        document.getElementById("pago_6").value = no_pago;
                        document.getElementById("pago6").value = pago;
                        document.getElementById("tipo_pago6").value= tipo_pago;
                        $("#pagado6").val((total).toFixed(2));
                        $("#estado_cob6").val("temp_cob6");

                    }else if(no_pago == 7){

                        document.getElementById("pago_7").value = no_pago;
                        document.getElementById("pago7").value = pago;
                        document.getElementById("tipo_pago7").value= tipo_pago;
                        $("#pagado7").val((total).toFixed(2));
                        $("#estado_cob7").val("temp_cob7");

                    }else if(no_pago == 8){

                        document.getElementById("pago_8").value = no_pago;
                        document.getElementById("pago8").value = pago;
                        document.getElementById("tipo_pago8").value= tipo_pago;
                        $("#pagado8").val((total).toFixed(2));
                        $("#estado_cob8").val("temp_cob8");

                    }else if(no_pago == 9){

                        document.getElementById("pago_9").value = no_pago;
                        document.getElementById("pago9").value = pago;
                        document.getElementById("tipo_pago9").value= tipo_pago;
                        $("#pagado9").val((total).toFixed(2));
                        $("#estado_cob9").val("temp_cob9");

                    }else if(no_pago == 10){

                        document.getElementById("pago_10").value = no_pago;
                        document.getElementById("pago10").value = pago;
                        document.getElementById("tipo_pago10").value= tipo_pago;
                        $("#pagado10").val((total).toFixed(2));
                        $("#estado_cob10").val("temp_cob10");

                    }                

                    document.getElementById("op_pago_id1").disabled = true;
                    document.getElementById("pago_driver").disabled = true;
                    document.getElementById('pago_driver').style.color = '#848484';
                    
                    document.getElementById("btndecline").disabled = true;
                    document.getElementById("btndecline").style.display = "none";
                    document.getElementById("btndecline").style.cursor = '';
                    
                    document.getElementById("btnExit").disabled = true;
                    document.getElementById("btnExit").style.display = '';
                    document.getElementById("btnExit").style.cursor = '';
                    document.getElementById("btnExit").style.borderColor = "#696969";
                    document.getElementById("btnExit").style.background = "#696969";

                    document.getElementById("btncancol").disabled = false;
                    document.getElementById("btncancol").style.display = "";
                    document.getElementById("btncancol").style.cursor = 'pointer';
                    
                    document.getElementById('btnAceptar').style.cursor = 'pointer';
                    document.getElementById("btnAceptar").disabled = false;
                    document.getElementById('btnAceptar').style.background = '#006400';
                    document.getElementById('btnAceptar').style.color = '#fff';                    
                    document.getElementById('op_pago_id').value = 3;
                    
                    valida_clase();
                    
                    }

                } else {
                    // Do nothing!
                    Exit2();
                }

            }

            //Cash
            if (opcion === '26') {

                if (confirm('Confirme su Tipo de Pago !!!')) {
                    //var cash = $('#op_pago_id1').val();
                   
                    var pago_driver2 = parseFloat($("#pago_driver2").val());
                    var balance_due = parseFloat($("#balance_due").val());
                    var total = parseFloat(pago_driver2);
                    var valor = 0;
                    var collect = parseFloat($("#collect").val());
                    var kollect = parseFloat($("#pago_driver").val());
                    
                    var no_pago =  document.getElementById("no_pago").value;
                    no_pago = parseInt(no_pago) + 1;
                
                    var pago = 'COLLECT ON BOARD'; 
                    var tipo_pago = 'CASH';
                    
                    if(balance_due <= "0"){
                    
                    document.getElementById('pago_driver').value = "0.00"; 
                    document.getElementById("btnPagolinea").disabled = true;
                    document.getElementById("btnPagolinea").style.display = "none";
                    document.getElementById("btndecline").style.display = "none"; 
                    document.getElementById("btncancol").style.display = "none";
                    document.getElementById("btnAceptar").disabled = true;
                    document.getElementById("btnAceptar").style.background = "lightgray";   

                    alert("Este pago no puede ser Procesado!!!");
                    Exit();
                    
                    }else{

                    $("#no_pago").val(no_pago);
                    collect = parseFloat(collect) + parseFloat(total);
                    $("#collect").val((collect).toFixed(2));
                    $("#pago_driver").val((total).toFixed(2));
                    $("#PAP").val((valor).toFixed(2));
                    
                    if(no_pago == 1){                    
                                      
                    document.getElementById("pago_1").value = no_pago;
                    document.getElementById("pago1").value = pago;
                    document.getElementById("tipo_pago1").value= tipo_pago;
                    $("#pagado1").val((kollect).toFixed(2));
                    $("#estado_cob1").val("temp_cob1");

                    }else if(no_pago == 2){

                        document.getElementById("pago_2").value = no_pago;
                        document.getElementById("pago2").value = pago;
                        document.getElementById("tipo_pago2").value= tipo_pago;
                        $("#pagado2").val((kollect).toFixed(2));
                        $("#estado_cob2").val("temp_cob2");

                    }else if(no_pago == 3){

                        document.getElementById("pago_3").value = no_pago;
                        document.getElementById("pago3").value = pago;
                        document.getElementById("tipo_pago3").value= tipo_pago;
                        $("#pagado3").val((kollect).toFixed(2));
                        $("#estado_cob3").val("temp_cob3");

                    }else if(no_pago == 4){

                        document.getElementById("pago_4").value = no_pago;
                        document.getElementById("pago4").value = pago;
                        document.getElementById("tipo_pago4").value= tipo_pago;
                        $("#pagado4").val((kollect).toFixed(2));
                        $("#estado_cob4").val("temp_cob4");

                    }else if(no_pago == 5){

                        document.getElementById("pago_5").value = no_pago;
                        document.getElementById("pago5").value = pago;
                        document.getElementById("tipo_pago5").value= tipo_pago;
                        $("#pagado5").val((kollect).toFixed(2));
                        $("#estado_cob5").val("temp_cob5");

                    }else if(no_pago == 6){

                        document.getElementById("pago_6").value = no_pago;
                        document.getElementById("pago6").value = pago;
                        document.getElementById("tipo_pago6").value= tipo_pago;
                        $("#pagado6").val((kollect).toFixed(2));
                        $("#estado_cob6").val("temp_cob6");

                    }else if(no_pago == 7){

                        document.getElementById("pago_7").value = no_pago;
                        document.getElementById("pago7").value = pago;
                        document.getElementById("tipo_pago7").value= tipo_pago;
                        $("#pagado7").val((kollect).toFixed(2));
                        $("#estado_cob7").val("temp_cob7");

                    }else if(no_pago == 8){

                        document.getElementById("pago_8").value = no_pago;
                        document.getElementById("pago8").value = pago;
                        document.getElementById("tipo_pago8").value= tipo_pago;
                        $("#pagado8").val((kollect).toFixed(2));
                        $("#estado_cob8").val("temp_cob8");

                    }else if(no_pago == 9){

                        document.getElementById("pago_9").value = no_pago;
                        document.getElementById("pago9").value = pago;
                        document.getElementById("tipo_pago9").value= tipo_pago;
                        $("#pagado9").val((kollect).toFixed(2));
                        $("#estado_cob9").val("temp_cob9");

                    }else if(no_pago == 10){

                        document.getElementById("pago_10").value = no_pago;
                        document.getElementById("pago10").value = pago;
                        document.getElementById("tipo_pago10").value= tipo_pago;
                        $("#pagado10").val((kollect).toFixed(2));
                        $("#estado_cob10").val("temp_cob10");

                    }

                    document.getElementById("op_pago_id1").disabled = true;
                    document.getElementById("pago_driver").disabled = true;
                    document.getElementById('pago_driver').style.color = '#848484';
                    
                    document.getElementById("btndecline").disabled = true;
                    document.getElementById("btndecline").style.display = "none";
                    document.getElementById("btndecline").style.cursor = '';
                    
                    document.getElementById("btnExit").disabled = true;
                    document.getElementById("btnExit").style.display = '';
                    document.getElementById("btnExit").style.cursor = '';
                    document.getElementById("btnExit").style.borderColor = "#696969";
                    document.getElementById("btnExit").style.background = "#696969";
                
                    document.getElementById("btncancol").disabled = false;
                    document.getElementById("btncancol").style.display = "";
                    document.getElementById("btncancol").style.cursor = 'pointer';

                    document.getElementById('btnAceptar').style.cursor = 'pointer';
                    document.getElementById("btnAceptar").disabled = false;
                    document.getElementById('btnAceptar').style.background = '#006400';
                    document.getElementById('btnAceptar').style.color = '#fff';
                    
                    document.getElementById('op_pago_id').value = 4;
                    
                    valida_clase(); 
                    
                    }

                } else {
                    // Do nothing!
                    Exit2();
                }

            }

            //Check

            if (opcion === '27') {

                if (confirm('Confirme su Tipo de Pago !!!')) {

                    var pago_driver2 = parseFloat($("#pago_driver2").val());
                    var balance_due = parseFloat($("#balance_due").val());
                    var total = parseFloat(pago_driver2);
                    var valor = 0;
                    var collect = parseFloat($("#collect").val());
                    var kollect = parseFloat($("#pago_driver").val());
                    
                    var no_pago =  document.getElementById("no_pago").value;
                    no_pago = parseInt(no_pago) + 1;

                    var pago = 'COLLECT ON BOARD'; 
                    var tipo_pago = 'CHECK';
                    
                    if(balance_due <= "0"){
                    
                    document.getElementById('pago_driver').value = "0.00"; 
                    document.getElementById("btnPagolinea").disabled = true;
                    document.getElementById("btnPagolinea").style.display = "none";
                    document.getElementById("btndecline").style.display = "none"; 
                    document.getElementById("btncancol").style.display = "none";             
                    document.getElementById("btnAceptar").disabled = true;
                    document.getElementById("btnAceptar").style.background = "lightgray";   

                    alert("Este pago no puede ser Procesado!!!");
                    Exit();
                    
                     }else{
                    
                    $("#no_pago").val(no_pago);
                    collect = parseFloat(collect) + parseFloat(total);
                    $("#collect").val((collect).toFixed(2));
                    $("#pago_driver").val((total).toFixed(2));
                    $("#PAP").val((valor).toFixed(2));
                    
                    if(no_pago == 1){                    
                                      
                    document.getElementById("pago_1").value = no_pago;
                    document.getElementById("pago1").value = pago;
                    document.getElementById("tipo_pago1").value= tipo_pago;
                    $("#pagado1").val((kollect).toFixed(2));
                    $("#estado_cob1").val("temp_cob1");

                    }else if(no_pago == 2){

                        document.getElementById("pago_2").value = no_pago;
                        document.getElementById("pago2").value = pago;
                        document.getElementById("tipo_pago2").value= tipo_pago;
                        $("#pagado2").val((kollect).toFixed(2));
                        $("#estado_cob2").val("temp_cob2");

                    }else if(no_pago == 3){

                        document.getElementById("pago_3").value = no_pago;
                        document.getElementById("pago3").value = pago;
                        document.getElementById("tipo_pago3").value= tipo_pago;
                        $("#pagado3").val((kollect).toFixed(2));
                        $("#estado_cob3").val("temp_cob3");

                    }else if(no_pago == 4){

                        document.getElementById("pago_4").value = no_pago;
                        document.getElementById("pago4").value = pago;
                        document.getElementById("tipo_pago4").value= tipo_pago;
                        $("#pagado4").val((kollect).toFixed(2));
                        $("#estado_cob4").val("temp_cob4");

                    }else if(no_pago == 5){

                        document.getElementById("pago_5").value = no_pago;
                        document.getElementById("pago5").value = pago;
                        document.getElementById("tipo_pago5").value= tipo_pago;
                        $("#pagado5").val((kollect).toFixed(2));
                        $("#estado_cob5").val("temp_cob5");

                    }else if(no_pago == 6){

                        document.getElementById("pago_6").value = no_pago;
                        document.getElementById("pago6").value = pago;
                        document.getElementById("tipo_pago6").value= tipo_pago;
                        $("#pagado6").val((kollect).toFixed(2));
                        $("#estado_cob6").val("temp_cob6");

                    }else if(no_pago == 7){

                        document.getElementById("pago_7").value = no_pago;
                        document.getElementById("pago7").value = pago;
                        document.getElementById("tipo_pago7").value= tipo_pago;
                        $("#pagado7").val((kollect).toFixed(2));
                        $("#estado_cob7").val("temp_cob7");

                    }else if(no_pago == 8){

                        document.getElementById("pago_8").value = no_pago;
                        document.getElementById("pago8").value = pago;
                        document.getElementById("tipo_pago8").value= tipo_pago;
                        $("#pagado8").val((kollect).toFixed(2));
                        $("#estado_cob8").val("temp_cob8");

                    }else if(no_pago == 9){

                        document.getElementById("pago_9").value = no_pago;
                        document.getElementById("pago9").value = pago;
                        document.getElementById("tipo_pago9").value= tipo_pago;
                        $("#pagado9").val((kollect).toFixed(2));
                        $("#estado_cob9").val("temp_cob9");

                    }else if(no_pago == 10){

                        document.getElementById("pago_10").value = no_pago;
                        document.getElementById("pago10").value = pago;
                        document.getElementById("tipo_pago10").value= tipo_pago;
                        $("#pagado10").val((kollect).toFixed(2));
                        $("#estado_cob10").val("temp_cob10");

                    }
              

                    document.getElementById("op_pago_id1").disabled = true;
                    document.getElementById("pago_driver").disabled = true;
                    document.getElementById('pago_driver').style.color = '#848484';
                    
                    document.getElementById("btndecline").disabled = true;
                    document.getElementById("btndecline").style.display = "none";
                    document.getElementById("btndecline").style.cursor = '';                 
                    
                    document.getElementById("btnExit").disabled = true;
                    document.getElementById("btnExit").style.display = '';
                    document.getElementById("btnExit").style.cursor = '';
                    document.getElementById("btnExit").style.borderColor = "#696969";
                    document.getElementById("btnExit").style.background = "#696969";
                    
                    document.getElementById("btncancol").disabled = false;
                    document.getElementById("btncancol").style.display = "";
                    document.getElementById("btncancol").style.cursor = 'pointer';

                    document.getElementById('btnAceptar').style.cursor = 'pointer';
                    document.getElementById("btnAceptar").disabled = false;
                    document.getElementById('btnAceptar').style.background = '#006400';
                    document.getElementById('btnAceptar').style.color = '#fff';                    
                    document.getElementById('op_pago_id').value = 9;
                    
                    valida_clase();
                    
                    }

                } else {
                    // Do nothing!
                    Exit2();
                }

            }



        }
    </script>


    <script type="text/javascript">
        function Exit()
        {
            var ventana2 = document.getElementById('miVentana2'); // Accedemos al contenedor
            document.getElementById("btndecline").style.display = "none"; 
            document.getElementById("btncancol").style.display = "none"; 
            document.getElementById("btnAceptar").disabled = true;
            document.getElementById("btnAceptar").style.background = "lightgray";          
            
            ventana2.style.display = 'none'; // Y lo hacemos invisible

        }
    </script>


    <script type="text/javascript">
        function Exit2()
        {
            var ventana2 = document.getElementById('miVentana2'); // Accedemos al contenedor
            ventana2.style.display = 'none'; // Y lo hacemos invisible
            //reset();
            mostrarVentana2();

        }
    </script>

    <script type="text/javascript">
        function ClkPay_Amount()
        {

            var clone = document.getElementById('otheramount').value;

            if (clone == '') {

                document.getElementById('otheramount').value = '0.00';
            }

            if (clone == '0.0') {

                document.getElementById('otheramount').value = '0.00';
            }

            document.getElementById('saldoactual').value = clone;

            if (clone == '0.') {

                document.getElementById('otheramount').value = '0.00';
            }


            if (clone == '0') {

                document.getElementById('otheramount').value = '0.00';
            }
            setTimeout(function () {
                 CalcularTotalPago();

            }, 0.001);


        }
    </script>


    <script type="text/javascript">
        function aplicar_pago() {
            //alert('mostrar');
            var ventana = document.getElementById('miVentana'); // Accedemos al contenedor

            var totalamount = document.getElementById('totalAmount').value;

//        alert(totalPagar);
            ventana.style.marginTop = "100px"; // Definimos su posición vertical. La ponemos fija para simplificar el código
            ventana.style.marginLeft = ((document.body.clientWidth - 350) / 2) + "px"; // Definimos su posición horizontal
            ventana.style.display = 'block'; // Y lo hacemos visible
        }
        function ocultarVentana()
        {
            var ventana = document.getElementById('miVentana'); // Accedemos al contenedor
            ventana.style.display = 'none'; // Y lo hacemos invisible
            var opcion_pago_2 = $('#opcion_pago_2').val();
            var aplica_pago = $('#aplica_pago').val();

            // document.getElementById('pay_amount').value = aplica_pago;
            //var resultados = prueba + opcion_pago_2;
            //alert(opcion_pago_2);
        }
        //document.getElementById('otheramount').value = totalPagar;
    </script>

    <script type="text/javascript">
        function pago_driver() {
            //alert('mostrar');

            var ventana2 = document.getElementById('miVentana2'); // Accedemos al contenedor
            ventana2.style.marginTop = "275px"; // Definimos su posición vertical. La ponemos fija para simplificar el código
            //ventana2.style.marginLeft = ((document.body.clientWidth - 350) / 2) + "px"; // Definimos su posición horizontal
            ventana2.style.marginLeft = "768.4px"; // Definimos su posición horizontal
            ventana2.style.display = 'block'; // Y lo hacemos visible
            ventana2.style.position = 'absolute';

            $("#pago_driver").focus();

            document.getElementById('pago_driver').value = '';
            document.getElementById('pago_driver').style.color = '#848484';

            document.getElementById('op_pago_id1').value = 0;
            document.getElementById('op_pago_id').value = 8;
            document.getElementById('op_pago_id2').value = 2;

            document.getElementById("pago_driver").disabled = false;

            document.getElementById('btnAceptar').style.background = '';

            document.getElementById('btnAceptar').style.color = '#000';

            document.getElementById('btnAceptar').style.cursor = '';



            //$('#pago_driver').val()='0.00';
        }

        function ocultarVentana2()
        {
            var ventana2 = document.getElementById('miVentana2'); // Accedemos al contenedor

            var opcion_pago = $('#opcion_pago_id').val();
            var pago_driver = $('#pago_driver').val();
            var saldoactual = $('#saldoactual').val();
            var totalAmount = $('#totalAmount').val();
            var payamount = $('#pay_amount').val();

            var collect = $('#collect').val();
            var prepaid = $('#prepaid').val();

            var opcion = $("#op_pago_id1").val();
            
            var no_prep =  document.getElementById('no_prep').value;
            var no_pago =  document.getElementById('no_pago').value;

            var pago_pre1 = document.getElementById('pago_pre1').value;
            var pago_pre2 = document.getElementById('pago_pre2').value;
            var pago_pre3 = document.getElementById('pago_pre3').value;
            var pago_pre4 = document.getElementById('pago_pre4').value;
            var pago_pre5 = document.getElementById('pago_pre5').value;
            var pago_pre6 = document.getElementById('pago_pre6').value;
            var pago_pre7 = document.getElementById('pago_pre7').value;
            var pago_pre8 = document.getElementById('pago_pre8').value;
            var pago_pre9 = document.getElementById('pago_pre9').value;
            var pago_pre10 = document.getElementById('pago_pre10').value;

            var tipo_pagopre1 = document.getElementById('tipo_pagopre1').value;
            var tipo_pagopre2 = document.getElementById('tipo_pagopre2').value;
            var tipo_pagopre3 = document.getElementById('tipo_pagopre3').value;
            var tipo_pagopre4 = document.getElementById('tipo_pagopre4').value;
            var tipo_pagopre5 = document.getElementById('tipo_pagopre5').value;
            var tipo_pagopre6 = document.getElementById('tipo_pagopre6').value;
            var tipo_pagopre7 = document.getElementById('tipo_pagopre7').value;
            var tipo_pagopre8 = document.getElementById('tipo_pagopre8').value;
            var tipo_pagopre9 = document.getElementById('tipo_pagopre9').value;
            var tipo_pagopre10 = document.getElementById('tipo_pagopre10').value;

            var pago1 = document.getElementById('pago1').value;
            var pago2 = document.getElementById('pago2').value;
            var pago3 = document.getElementById('pago3').value;
            var pago4 = document.getElementById('pago4').value;
            var pago5 = document.getElementById('pago5').value;
            var pago6 = document.getElementById('pago6').value;
            var pago7 = document.getElementById('pago7').value;
            var pago8 = document.getElementById('pago8').value;
            var pago9 = document.getElementById('pago9').value;
            var pago10 = document.getElementById('pago10').value;

            var tipo_pago1 = document.getElementById('tipo_pago1').value;
            var tipo_pago2 = document.getElementById('tipo_pago2').value;
            var tipo_pago3 = document.getElementById('tipo_pago3').value;
            var tipo_pago4 = document.getElementById('tipo_pago4').value;
            var tipo_pago5 = document.getElementById('tipo_pago5').value;
            var tipo_pago6 = document.getElementById('tipo_pago6').value;
            var tipo_pago7 = document.getElementById('tipo_pago7').value;
            var tipo_pago8 = document.getElementById('tipo_pago8').value;
            var tipo_pago9 = document.getElementById('tipo_pago9').value;
            var tipo_pago10 = document.getElementById('tipo_pago10').value;

            

            //PRED-PAID////////////////////////////////////////////
            //Credit Card with fee

            if (opcion === '0') {

                document.getElementById('paid_driver').value = '0.00';
                document.getElementById('pay_amount').value = '0.00';

                setTimeout(function () {
                    //$('#pay_amount').click();
                    calcularTotalPago();
                    
                    

                }, 0.001);

                setTimeout(function () {
                    //$('#paid_driver').click();
                    calcularTotalPago();

                }, 0.001);

                $("#pago_driver").focus();

                //document.getElementById('op_pago_id1').value = 0;
//            document.getElementById('pago_driver').value = '0.00';



            }

            if (opcion === '1') {

                document.getElementById('paid_driver').value = '0.00';
                document.getElementById('pay_amount').value = '0.00';

                setTimeout(function () {
                    //$('#pay_amount').click();
                    calcularTotalPago();

                }, 0.001);

                setTimeout(function () {
                    //$('#paid_driver').click();
                    calcularTotalPago();

                }, 0.001);

                $("#pago_driver").focus();
                
            }

            //Pred-Paid
            //Credit card no fee

            if (opcion === '20') {

                if (confirm('Esta Seguro que desea Aplicar este Pago?')) {
                    
                    document.getElementById('pay_amount').value = prepaid;
                    document.getElementById('opc_ap').value = opcion;

                    setTimeout(function () {
                        //$('#pay_amount').click();
                        calcularTotalPago();
//                        document.getElementById('pay_amount').style.color = "#FFFFFF";
//                        document.getElementById('pay_amount').className = "flashit2";
//                        document.getElementById('guardar').className = "flashit2";
                        document.getElementById('btn_rever_prepaid').style.display = "";
                        document.getElementById('pay_amount').style.backgroundColor = "#E21F26";
                        
                        //document.getElementById('pay_amount').title ="Pago sin Guardar"; 
                        //make_charge();
                        document.getElementById("btndecline").style.display = "none"; 
                        document.getElementById("btnAceptar").disabled = true;
                        document.getElementById("btnAceptar").style.background = "lightgray";
                        //make_charge();
                        var tit = "CREDIT CARD NO FEE"; 
                        var pagadopre1 = document.getElementById('pagadopre1').value;
                        var pagadopre2 = document.getElementById('pagadopre2').value;
                        var pagadopre3 = document.getElementById('pagadopre3').value;
                        var pagadopre4 = document.getElementById('pagadopre4').value;
                        var pagadopre5 = document.getElementById('pagadopre5').value;
                        var pagadopre6 = document.getElementById('pagadopre6').value;
                        var pagadopre7 = document.getElementById('pagadopre7').value;
                        var pagadopre8 = document.getElementById('pagadopre8').value;
                        var pagadopre9 = document.getElementById('pagadopre9').value;
                        var pagadopre10 = document.getElementById('pagadopre10').value;

                        var titulo1 = tit + "\n" + "$" + pagadopre1;
                        var titulo2 = tit + "\n" + "$" + pagadopre2;
                        var titulo3 = tit + "\n" + "$" + pagadopre3;
                        var titulo4 = tit + "\n" + "$" + pagadopre4;
                        var titulo5 = tit + "\n" + "$" + pagadopre5;
                        var titulo6 = tit + "\n" + "$" + pagadopre6;
                        var titulo7 = tit + "\n" + "$" + pagadopre7;
                        var titulo8 = tit + "\n" + "$" + pagadopre8;
                        var titulo9 = tit + "\n" + "$" + pagadopre9;
                        var titulo10 = tit + "\n" + "$" + pagadopre10;

                        if(pago_pre1 == 0){
                            document.getElementById('cir1').title = "";
                        }

                        if(pago_pre1 == 1 && tipo_pagopre1 == "CREDIT CARD NO FEE"){
                            document.getElementById('cir1').title = titulo1;
                        }

                        if(pago_pre2 == 2 && tipo_pagopre2 == "CREDIT CARD NO FEE"){
                            document.getElementById('cir2').title = titulo2;
                        }


                        if(pago_pre3 == 3 && tipo_pagopre3 == "CREDIT CARD NO FEE"){
                            document.getElementById('cir3').title = titulo3;
                        }

                        if(pago_pre4 == 4 && tipo_pagopre4 == "CREDIT CARD NO FEE"){
                            document.getElementById('cir4').title = titulo4;
                        }

                        if(pago_pre5 == 5 && tipo_pagopre5 == "CREDIT CARD NO FEE"){
                            document.getElementById('cir5').title = titulo5;
                        }

                        if(pago_pre6 == 6 && tipo_pagopre6 == "CREDIT CARD NO FEE"){
                            document.getElementById('cir6').title = titulo6;
                        }

                        if(pago_pre7 == 7 && tipo_pagopre7 == "CREDIT CARD NO FEE"){
                            document.getElementById('cir7').title = titulo7;
                        }

                        if(pago_pre8 == 8 && tipo_pagopre8 == "CREDIT CARD NO FEE"){
                            document.getElementById('cir8').title = titulo8;
                        }

                        if(pago_pre9 == 9 && tipo_pagopre9 == "CREDIT CARD NO FEE"){
                            document.getElementById('cir9').title = titulo9;
                        }

                        if(pago_pre10 == 10 && tipo_pagopre10 == "CREDIT CARD NO FEE"){
                            document.getElementById('cir10').title = titulo10;
                        }

                        if(no_prep == 1){

                                $("#estado_pre1").val("pagado_pre1"); 
                                document.getElementById('cir1').style.display = '';



                        }else if(no_prep == 2){

                                $("#estado_pre2").val("pagado_pre2");   
                                document.getElementById('cir1').style.display = '';
                                document.getElementById('cir2').style.display = '';


                        }else if(no_prep == 3){

                                $("#estado_pre3").val("pagado_pre3");    
                                document.getElementById('cir1').style.display = '';
                                document.getElementById('cir2').style.display = '';
                                document.getElementById('cir3').style.display = '';

                        }else if(no_prep == 4){

                                $("#estado_pre4").val("pagado_pre4");  
                                document.getElementById('cir1').style.display = '';
                                document.getElementById('cir2').style.display = '';
                                document.getElementById('cir3').style.display = '';
                                document.getElementById('cir4').style.display = '';

                        }else if(no_prep == 5){

                                $("#estado_pre5").val("pagado_pre5"); 
                                document.getElementById('cir1').style.display = '';
                                document.getElementById('cir2').style.display = '';
                                document.getElementById('cir3').style.display = '';
                                document.getElementById('cir4').style.display = '';
                                document.getElementById('cir5').style.display = '';

                        }else if(no_prep == 6){

                                $("#estado_pre6").val("pagado_pre6");   
                                document.getElementById('cir1').style.display = '';
                                document.getElementById('cir2').style.display = '';
                                document.getElementById('cir3').style.display = '';
                                document.getElementById('cir4').style.display = '';
                                document.getElementById('cir5').style.display = '';
                                document.getElementById('cir6').style.display = '';


                        }else if(no_prep == 7){

                                $("#estado_pre7").val("pagado_pre7");
                                document.getElementById('cir1').style.display = '';
                                document.getElementById('cir2').style.display = '';
                                document.getElementById('cir3').style.display = '';
                                document.getElementById('cir4').style.display = '';
                                document.getElementById('cir5').style.display = '';
                                document.getElementById('cir6').style.display = '';
                                document.getElementById('cir7').style.display = '';


                        }else if(no_prep == 8){                        

                                $("#estado_pre8").val("pagado_pre8");
                                document.getElementById('cir1').style.display = '';
                                document.getElementById('cir2').style.display = '';
                                document.getElementById('cir3').style.display = '';
                                document.getElementById('cir4').style.display = '';
                                document.getElementById('cir5').style.display = '';
                                document.getElementById('cir6').style.display = '';
                                document.getElementById('cir7').style.display = '';
                                document.getElementById('cir8').style.display = '';

                        }else if(no_prep == 9){

                                $("#estado_pre9").val("pagado_pre9");
                                document.getElementById('cir1').style.display = '';
                                document.getElementById('cir2').style.display = '';
                                document.getElementById('cir3').style.display = '';
                                document.getElementById('cir4').style.display = '';
                                document.getElementById('cir5').style.display = '';
                                document.getElementById('cir6').style.display = '';
                                document.getElementById('cir7').style.display = '';
                                document.getElementById('cir8').style.display = '';
                                document.getElementById('cir9').style.display = '';


                        }else if(no_prep == 10){

                                $("#estado_pre10").val("pagado_pre10");
                                document.getElementById('cir1').style.display = '';
                                document.getElementById('cir2').style.display = '';
                                document.getElementById('cir3').style.display = '';
                                document.getElementById('cir4').style.display = '';
                                document.getElementById('cir5').style.display = '';
                                document.getElementById('cir6').style.display = '';
                                document.getElementById('cir7').style.display = '';
                                document.getElementById('cir8').style.display = '';
                                document.getElementById('cir9').style.display = '';
                                document.getElementById('cir10').style.display = '';

                        }

                    }, 0.001);

                    $("#pago_driver").focus();
                    Exit();

                } else {
                    // Do nothing!                    
                    declinar();
                    $("#pago_driver").focus();
                    Exit();
                   
                }

            }
            
            //CREDIT CARD WITH FEE
            if (opcion === '21') {

                if (confirm('Esta Seguro que desea Aplicar este Pago?')) {


                    document.getElementById('pay_amount').value = prepaid;
                    document.getElementById('opc_ap').value = opcion;

                    setTimeout(function () {
                       
                        calcularTotalPago();
                        
                        //document.getElementById('pay_amount').style.color = "#FFFFFF";
//                      document.getElementById('pay_amount').className = "flashit2";
//                      document.getElementById('guardar').className = "flashit2";

                        document.getElementById('btn_rever_prepaid').style.display = "";
                        document.getElementById('pay_amount').style.backgroundColor = "#E21F26";
//                      document.getElementById('pay_amount').title ="Pago sin Guardar"; 

                        document.getElementById("btndecline").style.display = "none"; 
                        document.getElementById("btnAceptar").disabled = true;
                        document.getElementById("btnAceptar").style.background = "lightgray";
                        
                        var tit = "CREDIT CARD WITH FEE"; 
                        var pagadopre1 = document.getElementById('pagadopre1').value;
                        var pagadopre2 = document.getElementById('pagadopre2').value;
                        var pagadopre3 = document.getElementById('pagadopre3').value;
                        var pagadopre4 = document.getElementById('pagadopre4').value;
                        var pagadopre5 = document.getElementById('pagadopre5').value;
                        var pagadopre6 = document.getElementById('pagadopre6').value;
                        var pagadopre7 = document.getElementById('pagadopre7').value;
                        var pagadopre8 = document.getElementById('pagadopre8').value;
                        var pagadopre9 = document.getElementById('pagadopre9').value;
                        var pagadopre10 = document.getElementById('pagadopre10').value;

                        var titulo1 = tit + "\n" + "$" + pagadopre1;
                        var titulo2 = tit + "\n" + "$" + pagadopre2;
                        var titulo3 = tit + "\n" + "$" + pagadopre3;
                        var titulo4 = tit + "\n" + "$" + pagadopre4;
                        var titulo5 = tit + "\n" + "$" + pagadopre5;
                        var titulo6 = tit + "\n" + "$" + pagadopre6;
                        var titulo7 = tit + "\n" + "$" + pagadopre7;
                        var titulo8 = tit + "\n" + "$" + pagadopre8;
                        var titulo9 = tit + "\n" + "$" + pagadopre9;
                        var titulo10 = tit + "\n" + "$" + pagadopre10;

                        if(pago_pre1 == 0){
                            document.getElementById('cir1').title = "";
                        }

                        if(pago_pre1 == 1 && tipo_pagopre1 == "CREDIT CARD WITH FEE"){
                            document.getElementById('cir1').title = titulo1;
                        }

                        if(pago_pre2 == 2 && tipo_pagopre2 == "CREDIT CARD WITH FEE"){
                            document.getElementById('cir2').title = titulo2;
                        }


                        if(pago_pre3 == 3 && tipo_pagopre3 == "CREDIT CARD WITH FEE"){
                            document.getElementById('cir3').title = titulo3;
                        }

                        if(pago_pre4 == 4 && tipo_pagopre4 == "CREDIT CARD WITH FEE"){
                            document.getElementById('cir4').title = titulo4;
                        }

                        if(pago_pre5 == 5 && tipo_pagopre5 == "CREDIT CARD WITH FEE"){
                            document.getElementById('cir5').title = titulo5;
                        }

                        if(pago_pre6 == 6 && tipo_pagopre6 == "CREDIT CARD WITH FEE"){
                            document.getElementById('cir6').title = titulo6;
                        }

                        if(pago_pre7 == 7 && tipo_pagopre7 == "CREDIT CARD WITH FEE"){
                            document.getElementById('cir7').title = titulo7;
                        }

                        if(pago_pre8 == 8 && tipo_pagopre8 == "CREDIT CARD WITH FEE"){
                            document.getElementById('cir8').title = titulo8;
                        }

                        if(pago_pre9 == 9 && tipo_pagopre9 == "CREDIT CARD WITH FEE"){
                            document.getElementById('cir9').title = titulo9;
                        }

                        if(pago_pre10 == 10 && tipo_pagopre10 == "CREDIT CARD WITH FEE"){
                            document.getElementById('cir10').title = titulo10;
                        }

                        if(no_prep == 1){

                                $("#estado_pre1").val("pagado_pre1"); 
                                document.getElementById('cir1').style.display = '';



                        }else if(no_prep == 2){

                                $("#estado_pre2").val("pagado_pre2");   
                                document.getElementById('cir1').style.display = '';
                                document.getElementById('cir2').style.display = '';


                        }else if(no_prep == 3){

                                $("#estado_pre3").val("pagado_pre3");    
                                document.getElementById('cir1').style.display = '';
                                document.getElementById('cir2').style.display = '';
                                document.getElementById('cir3').style.display = '';

                        }else if(no_prep == 4){

                                $("#estado_pre4").val("pagado_pre4");  
                                document.getElementById('cir1').style.display = '';
                                document.getElementById('cir2').style.display = '';
                                document.getElementById('cir3').style.display = '';
                                document.getElementById('cir4').style.display = '';

                        }else if(no_prep == 5){

                                $("#estado_pre5").val("pagado_pre5"); 
                                document.getElementById('cir1').style.display = '';
                                document.getElementById('cir2').style.display = '';
                                document.getElementById('cir3').style.display = '';
                                document.getElementById('cir4').style.display = '';
                                document.getElementById('cir5').style.display = '';

                        }else if(no_prep == 6){

                                $("#estado_pre6").val("pagado_pre6");   
                                document.getElementById('cir1').style.display = '';
                                document.getElementById('cir2').style.display = '';
                                document.getElementById('cir3').style.display = '';
                                document.getElementById('cir4').style.display = '';
                                document.getElementById('cir5').style.display = '';
                                document.getElementById('cir6').style.display = '';


                        }else if(no_prep == 7){

                                $("#estado_pre7").val("pagado_pre7");
                                document.getElementById('cir1').style.display = '';
                                document.getElementById('cir2').style.display = '';
                                document.getElementById('cir3').style.display = '';
                                document.getElementById('cir4').style.display = '';
                                document.getElementById('cir5').style.display = '';
                                document.getElementById('cir6').style.display = '';
                                document.getElementById('cir7').style.display = '';


                        }else if(no_prep == 8){                        

                                $("#estado_pre8").val("pagado_pre8");
                                document.getElementById('cir1').style.display = '';
                                document.getElementById('cir2').style.display = '';
                                document.getElementById('cir3').style.display = '';
                                document.getElementById('cir4').style.display = '';
                                document.getElementById('cir5').style.display = '';
                                document.getElementById('cir6').style.display = '';
                                document.getElementById('cir7').style.display = '';
                                document.getElementById('cir8').style.display = '';

                        }else if(no_prep == 9){

                                $("#estado_pre9").val("pagado_pre9");
                                document.getElementById('cir1').style.display = '';
                                document.getElementById('cir2').style.display = '';
                                document.getElementById('cir3').style.display = '';
                                document.getElementById('cir4').style.display = '';
                                document.getElementById('cir5').style.display = '';
                                document.getElementById('cir6').style.display = '';
                                document.getElementById('cir7').style.display = '';
                                document.getElementById('cir8').style.display = '';
                                document.getElementById('cir9').style.display = '';


                        }else if(no_prep == 10){

                                $("#estado_pre10").val("pagado_pre10");
                                document.getElementById('cir1').style.display = '';
                                document.getElementById('cir2').style.display = '';
                                document.getElementById('cir3').style.display = '';
                                document.getElementById('cir4').style.display = '';
                                document.getElementById('cir5').style.display = '';
                                document.getElementById('cir6').style.display = '';
                                document.getElementById('cir7').style.display = '';
                                document.getElementById('cir8').style.display = '';
                                document.getElementById('cir9').style.display = '';
                                document.getElementById('cir10').style.display = '';
                                
                        }                       
                        

                    }, 0.001);

                    $("#pago_driver").focus();

                    //document.getElementById('op_pago_id2').value = 1;
//                document.getElementById('pago_driver').value = '0.00';
                    Exit();

                } else {
                    // Do nothing!
                    declinar();                   
                    $("#pago_driver").focus();
                    Exit();

                }

            }

            if (opcion === '22') { // CASH

                if (confirm('Esta Seguro que desea Aplicar este Pago?')) {

                    document.getElementById('pay_amount').value = prepaid;
                    document.getElementById('opc_ap').value = opcion;

                    setTimeout(function () {
                        
                        calcularTotalPago();
//                        document.getElementById('pay_amount').style.color = "#FFFFFF";
//                        document.getElementById('pay_amount').className = "flashit2";
//                        document.getElementById('guardar').className = "flashit2";
                        document.getElementById('btn_rever_prepaid').style.display = "";
                        document.getElementById('pay_amount').style.backgroundColor = "#E21F26";
                        //document.getElementById('pay_amount').title ="Pago sin Guardar"; 

                        document.getElementById("btndecline").style.display = "none"; 
                        document.getElementById("btnAceptar").disabled = true;
                        document.getElementById("btnAceptar").style.background = "lightgray";
                        
                        var tit = "CASH"; 
                        var pagadopre1 = document.getElementById('pagadopre1').value;
                        var pagadopre2 = document.getElementById('pagadopre2').value;
                        var pagadopre3 = document.getElementById('pagadopre3').value;
                        var pagadopre4 = document.getElementById('pagadopre4').value;
                        var pagadopre5 = document.getElementById('pagadopre5').value;
                        var pagadopre6 = document.getElementById('pagadopre6').value;
                        var pagadopre7 = document.getElementById('pagadopre7').value;
                        var pagadopre8 = document.getElementById('pagadopre8').value;
                        var pagadopre9 = document.getElementById('pagadopre9').value;
                        var pagadopre10 = document.getElementById('pagadopre10').value;

                        var titulo1 = tit + "\n" + "$" + pagadopre1;
                        var titulo2 = tit + "\n" + "$" + pagadopre2;
                        var titulo3 = tit + "\n" + "$" + pagadopre3;
                        var titulo4 = tit + "\n" + "$" + pagadopre4;
                        var titulo5 = tit + "\n" + "$" + pagadopre5;
                        var titulo6 = tit + "\n" + "$" + pagadopre6;
                        var titulo7 = tit + "\n" + "$" + pagadopre7;
                        var titulo8 = tit + "\n" + "$" + pagadopre8;
                        var titulo9 = tit + "\n" + "$" + pagadopre9;
                        var titulo10 = tit + "\n" + "$" + pagadopre10;



                        if(pago_pre1 == 0){
                            document.getElementById('cir1').title ="";
                        }

                        if(pago_pre1 == 1 && tipo_pagopre1 == "CASH"){
                            document.getElementById('cir1').title = titulo1;
                        }

                        if(pago_pre2 == 2 && tipo_pagopre2 == "CASH"){
                            document.getElementById('cir2').title = titulo2;
                        }


                        if(pago_pre3 == 3 && tipo_pagopre3 == "CASH"){
                            document.getElementById('cir3').title = titulo3;
                        }

                        if(pago_pre4 == 4 && tipo_pagopre4 == "CASH"){
                            document.getElementById('cir4').title = titulo4;
                        }

                        if(pago_pre5 == 5 && tipo_pagopre5 == "CASH"){
                            document.getElementById('cir5').title = titulo5;
                        }

                        if(pago_pre6 == 6 && tipo_pagopre6 == "CASH"){
                            document.getElementById('cir6').title = titulo6;
                        }

                        if(pago_pre7 == 7 && tipo_pagopre7 == "CASH"){
                            document.getElementById('cir7').title = titulo7;
                        }

                        if(pago_pre8 == 8 && tipo_pagopre8 == "CASH"){
                            document.getElementById('cir8').title = titulo8;
                        }

                        if(pago_pre9 == 9 && tipo_pagopre9 == "CASH"){
                            document.getElementById('cir9').title = titulo9;
                        }

                        if(pago_pre10 == 10 && tipo_pagopre10 == "CASH"){
                            document.getElementById('cir10').title = titulo10;
                        }

                        if(no_prep == 1){

                                $("#estado_pre1").val("pagado_pre1"); 
                                document.getElementById('cir1').style.display = '';



                        }else if(no_prep == 2){

                                $("#estado_pre2").val("pagado_pre2");   
                                document.getElementById('cir1').style.display = '';
                                document.getElementById('cir2').style.display = '';


                        }else if(no_prep == 3){

                                $("#estado_pre3").val("pagado_pre3");    
                                document.getElementById('cir1').style.display = '';
                                document.getElementById('cir2').style.display = '';
                                document.getElementById('cir3').style.display = '';

                        }else if(no_prep == 4){

                                $("#estado_pre4").val("pagado_pre4");  
                                document.getElementById('cir1').style.display = '';
                                document.getElementById('cir2').style.display = '';
                                document.getElementById('cir3').style.display = '';
                                document.getElementById('cir4').style.display = '';

                        }else if(no_prep == 5){

                                $("#estado_pre5").val("pagado_pre5"); 
                                document.getElementById('cir1').style.display = '';
                                document.getElementById('cir2').style.display = '';
                                document.getElementById('cir3').style.display = '';
                                document.getElementById('cir4').style.display = '';
                                document.getElementById('cir5').style.display = '';

                        }else if(no_prep == 6){

                                $("#estado_pre6").val("pagado_pre6");   
                                document.getElementById('cir1').style.display = '';
                                document.getElementById('cir2').style.display = '';
                                document.getElementById('cir3').style.display = '';
                                document.getElementById('cir4').style.display = '';
                                document.getElementById('cir5').style.display = '';
                                document.getElementById('cir6').style.display = '';


                        }else if(no_prep == 7){

                                $("#estado_pre7").val("pagado_pre7");
                                document.getElementById('cir1').style.display = '';
                                document.getElementById('cir2').style.display = '';
                                document.getElementById('cir3').style.display = '';
                                document.getElementById('cir4').style.display = '';
                                document.getElementById('cir5').style.display = '';
                                document.getElementById('cir6').style.display = '';
                                document.getElementById('cir7').style.display = '';


                        }else if(no_prep == 8){                        

                                $("#estado_pre8").val("pagado_pre8");
                                document.getElementById('cir1').style.display = '';
                                document.getElementById('cir2').style.display = '';
                                document.getElementById('cir3').style.display = '';
                                document.getElementById('cir4').style.display = '';
                                document.getElementById('cir5').style.display = '';
                                document.getElementById('cir6').style.display = '';
                                document.getElementById('cir7').style.display = '';
                                document.getElementById('cir8').style.display = '';

                        }else if(no_prep == 9){

                                $("#estado_pre9").val("pagado_pre9");
                                document.getElementById('cir1').style.display = '';
                                document.getElementById('cir2').style.display = '';
                                document.getElementById('cir3').style.display = '';
                                document.getElementById('cir4').style.display = '';
                                document.getElementById('cir5').style.display = '';
                                document.getElementById('cir6').style.display = '';
                                document.getElementById('cir7').style.display = '';
                                document.getElementById('cir8').style.display = '';
                                document.getElementById('cir9').style.display = '';


                        }else if(no_prep == 10){

                                $("#estado_pre10").val("pagado_pre10");
                                document.getElementById('cir1').style.display = '';
                                document.getElementById('cir2').style.display = '';
                                document.getElementById('cir3').style.display = '';
                                document.getElementById('cir4').style.display = '';
                                document.getElementById('cir5').style.display = '';
                                document.getElementById('cir6').style.display = '';
                                document.getElementById('cir7').style.display = '';
                                document.getElementById('cir8').style.display = '';
                                document.getElementById('cir9').style.display = '';
                                document.getElementById('cir10').style.display = '';

                        }
                        

                    }, 0.001);

                   
                    Exit();

                } else {
                    // Do nothing!                    
                    declinar();                     
                    $("#pago_driver").focus();
                    Exit();
                }

            }

            //Check
            if (opcion === '23') {

                if (confirm('Esta Seguro que desea Aplicar este Pago?')) {

                    document.getElementById('pay_amount').value = prepaid;
                    document.getElementById('opc_ap').value = opcion;

                    setTimeout(function () {
                        //$('#pay_amount').click();
                        calcularTotalPago();
//                        document.getElementById('pay_amount').style.color = "#FFFFFF";
//                        document.getElementById('pay_amount').className = "flashit2";
//                        document.getElementById('guardar').className = "flashit2";
                        document.getElementById('btn_rever_prepaid').style.display = "";
                        document.getElementById('pay_amount').style.backgroundColor = "#E21F26";
                        //document.getElementById('pay_amount').title ="Pago sin Guardar"; 

                        document.getElementById("btndecline").style.display = "none"; 
                        document.getElementById("btnAceptar").disabled = true;
                        document.getElementById("btnAceptar").style.background = "lightgray";
                        
                        var tit = "CHECK"; 
                        var pagadopre1 = document.getElementById('pagadopre1').value;
                        var pagadopre2 = document.getElementById('pagadopre2').value;
                        var pagadopre3 = document.getElementById('pagadopre3').value;
                        var pagadopre4 = document.getElementById('pagadopre4').value;
                        var pagadopre5 = document.getElementById('pagadopre5').value;
                        var pagadopre6 = document.getElementById('pagadopre6').value;
                        var pagadopre7 = document.getElementById('pagadopre7').value;
                        var pagadopre8 = document.getElementById('pagadopre8').value;
                        var pagadopre9 = document.getElementById('pagadopre9').value;
                        var pagadopre10 = document.getElementById('pagadopre10').value;

                        var titulo1 = tit + "\n" + "$" + pagadopre1;
                        var titulo2 = tit + "\n" + "$" + pagadopre2;
                        var titulo3 = tit + "\n" + "$" + pagadopre3;
                        var titulo4 = tit + "\n" + "$" + pagadopre4;
                        var titulo5 = tit + "\n" + "$" + pagadopre5;
                        var titulo6 = tit + "\n" + "$" + pagadopre6;
                        var titulo7 = tit + "\n" + "$" + pagadopre7;
                        var titulo8 = tit + "\n" + "$" + pagadopre8;
                        var titulo9 = tit + "\n" + "$" + pagadopre9;
                        var titulo10 = tit + "\n" + "$" + pagadopre10;



                        if(pago_pre1 == 0){
                            document.getElementById('cir1').title ="";
                        }

                        if(pago_pre1 == 1 && tipo_pagopre1 == "CHECK"){
                            document.getElementById('cir1').title = titulo1;
                        }

                        if(pago_pre2 == 2 && tipo_pagopre2 == "CHECK"){
                            document.getElementById('cir2').title = titulo2;
                        }


                        if(pago_pre3 == 3 && tipo_pagopre3 == "CHECK"){
                            document.getElementById('cir3').title = titulo3;
                        }

                        if(pago_pre4 == 4 && tipo_pagopre4 == "CHECK"){
                            document.getElementById('cir4').title = titulo4;
                        }

                        if(pago_pre5 == 5 && tipo_pagopre5 == "CHECK"){
                            document.getElementById('cir5').title = titulo5;
                        }

                        if(pago_pre6 == 6 && tipo_pagopre6 == "CHECK"){
                            document.getElementById('cir6').title = titulo6;
                        }

                        if(pago_pre7 == 7 && tipo_pagopre7 == "CHECK"){
                            document.getElementById('cir7').title = titulo7;
                        }

                        if(pago_pre8 == 8 && tipo_pagopre8 == "CHECK"){
                            document.getElementById('cir8').title = titulo8;
                        }

                        if(pago_pre9 == 9 && tipo_pagopre9 == "CHECK"){
                            document.getElementById('cir9').title = titulo9;
                        }

                        if(pago_pre10 == 10 && tipo_pagopre10 == "CHECK"){
                            document.getElementById('cir10').title = titulo10;
                        }

                        if(no_prep == 1){

                                $("#estado_pre1").val("pagado_pre1"); 
                                document.getElementById('cir1').style.display = '';



                        }else if(no_prep == 2){

                                $("#estado_pre2").val("pagado_pre2");   
                                document.getElementById('cir1').style.display = '';
                                document.getElementById('cir2').style.display = '';


                        }else if(no_prep == 3){

                                $("#estado_pre3").val("pagado_pre3");    
                                document.getElementById('cir1').style.display = '';
                                document.getElementById('cir2').style.display = '';
                                document.getElementById('cir3').style.display = '';

                        }else if(no_prep == 4){

                                $("#estado_pre4").val("pagado_pre4");  
                                document.getElementById('cir1').style.display = '';
                                document.getElementById('cir2').style.display = '';
                                document.getElementById('cir3').style.display = '';
                                document.getElementById('cir4').style.display = '';

                        }else if(no_prep == 5){

                                $("#estado_pre5").val("pagado_pre5"); 
                                document.getElementById('cir1').style.display = '';
                                document.getElementById('cir2').style.display = '';
                                document.getElementById('cir3').style.display = '';
                                document.getElementById('cir4').style.display = '';
                                document.getElementById('cir5').style.display = '';

                        }else if(no_prep == 6){

                                $("#estado_pre6").val("pagado_pre6");   
                                document.getElementById('cir1').style.display = '';
                                document.getElementById('cir2').style.display = '';
                                document.getElementById('cir3').style.display = '';
                                document.getElementById('cir4').style.display = '';
                                document.getElementById('cir5').style.display = '';
                                document.getElementById('cir6').style.display = '';


                        }else if(no_prep == 7){

                                $("#estado_pre7").val("pagado_pre7");
                                document.getElementById('cir1').style.display = '';
                                document.getElementById('cir2').style.display = '';
                                document.getElementById('cir3').style.display = '';
                                document.getElementById('cir4').style.display = '';
                                document.getElementById('cir5').style.display = '';
                                document.getElementById('cir6').style.display = '';
                                document.getElementById('cir7').style.display = '';


                        }else if(no_prep == 8){                        

                                $("#estado_pre8").val("pagado_pre8");
                                document.getElementById('cir1').style.display = '';
                                document.getElementById('cir2').style.display = '';
                                document.getElementById('cir3').style.display = '';
                                document.getElementById('cir4').style.display = '';
                                document.getElementById('cir5').style.display = '';
                                document.getElementById('cir6').style.display = '';
                                document.getElementById('cir7').style.display = '';
                                document.getElementById('cir8').style.display = '';

                        }else if(no_prep == 9){

                                $("#estado_pre9").val("pagado_pre9");
                                document.getElementById('cir1').style.display = '';
                                document.getElementById('cir2').style.display = '';
                                document.getElementById('cir3').style.display = '';
                                document.getElementById('cir4').style.display = '';
                                document.getElementById('cir5').style.display = '';
                                document.getElementById('cir6').style.display = '';
                                document.getElementById('cir7').style.display = '';
                                document.getElementById('cir8').style.display = '';
                                document.getElementById('cir9').style.display = '';


                        }else if(no_prep == 10){

                                $("#estado_pre10").val("pagado_pre10");
                                document.getElementById('cir1').style.display = '';
                                document.getElementById('cir2').style.display = '';
                                document.getElementById('cir3').style.display = '';
                                document.getElementById('cir4').style.display = '';
                                document.getElementById('cir5').style.display = '';
                                document.getElementById('cir6').style.display = '';
                                document.getElementById('cir7').style.display = '';
                                document.getElementById('cir8').style.display = '';
                                document.getElementById('cir9').style.display = '';
                                document.getElementById('cir10').style.display = '';

                        }

                    }, 0.001);

                    $("#pago_driver").focus();

                    //document.getElementById('op_pago_id1').value = 0;
//                document.getElementById('pago_driver').value = '0.00';

                    Exit();

                } else {
                    // Do nothing!
                    declinar();                    
                    $("#pago_driver").focus();
                    Exit();
                }

            }

            //Collect on Board

            if (opcion === '24') {

                if (confirm('Esta Seguro que desea Aplicar este Pago?')) {

                    document.getElementById('paid_driver').value = collect;
//                document.getElementById('pay_amount').value = pago_driver;
                    document.getElementById('opc_ap').value = opcion;

                    setTimeout(function () {
                        //$('#paid_driver').click();
                        calcularTotalPago();
//                        document.getElementById('paid_driver').style.color = "#FFFFFF";
//                        document.getElementById('paid_driver').className = "flashit";
//                        document.getElementById('guardar').className = "flashit";
                        document.getElementById('btn_rever_cob').style.display = "";
                        document.getElementById('paid_driver').style.backgroundColor = "#E21F26";
                        //document.getElementById('paid_driver').title ="Pago sin Guardar"; 

                        document.getElementById("btncancol").style.display = "none"; 
                        document.getElementById("btnAceptar").disabled = true;
                        document.getElementById("btnAceptar").style.background = "lightgray";
                        
                        var pago_1 = document.getElementById('pago_1').value;
                        var pago_2 = document.getElementById('pago_2').value;
                        var pago_3 = document.getElementById('pago_3').value;
                        var pago_4 = document.getElementById('pago_4').value;
                        var pago_5 = document.getElementById('pago_5').value;
                        var pago_6 = document.getElementById('pago_6').value;
                        var pago_7 = document.getElementById('pago_7').value;
                        var pago_8 = document.getElementById('pago_8').value;
                        var pago_9 = document.getElementById('pago_9').value;
                        var pago_10 = document.getElementById('pago_10').value;



                        var tit = "CREDIT CARD NO FEE"; 
                        var pagado1 = document.getElementById('pagado1').value;
                        var pagado2 = document.getElementById('pagado2').value;
                        var pagado3 = document.getElementById('pagado3').value;
                        var pagado4 = document.getElementById('pagado4').value;
                        var pagado5 = document.getElementById('pagado5').value;
                        var pagado6 = document.getElementById('pagado6').value;
                        var pagado7 = document.getElementById('pagado7').value;
                        var pagado8 = document.getElementById('pagado8').value;
                        var pagado9 = document.getElementById('pagado9').value;
                        var pagado10 = document.getElementById('pagado10').value;

                        var titulo1 = tit + "\n" + "$" + pagado1;
                        var titulo2 = tit + "\n" + "$" + pagado2;
                        var titulo3 = tit + "\n" + "$" + pagado3;
                        var titulo4 = tit + "\n" + "$" + pagado4;
                        var titulo5 = tit + "\n" + "$" + pagado5;
                        var titulo6 = tit + "\n" + "$" + pagado6;
                        var titulo7 = tit + "\n" + "$" + pagado7;
                        var titulo8 = tit + "\n" + "$" + pagado8;
                        var titulo9 = tit + "\n" + "$" + pagado9;
                        var titulo10 = tit + "\n" + "$" + pagado10;

                        if(pago_1 == 0){
                            document.getElementById('trian1').title = "";
                        }

                        if(pago_1 == 1 && tipo_pago1 == "CREDIT CARD NO FEE"){
                            document.getElementById('trian1').title = titulo1;
                        }

                        if(pago_2 == 2 && tipo_pago2 == "CREDIT CARD NO FEE"){
                            document.getElementById('trian2').title = titulo2;
                        }


                        if(pago_3 == 3 && tipo_pago3 == "CREDIT CARD NO FEE"){
                            document.getElementById('trian3').title = titulo3;
                        }

                        if(pago_4 == 4 && tipo_pago4 == "CREDIT CARD NO FEE"){
                            document.getElementById('trian4').title = titulo4;
                        }

                        if(pago_5 == 5 && tipo_pago5 == "CREDIT CARD NO FEE"){
                            document.getElementById('trian5').title = titulo5;
                        }

                        if(pago_6 == 6 && tipo_pago6 == "CREDIT CARD NO FEE"){
                            document.getElementById('trian6').title = titulo6;
                        }

                        if(pago_7 == 7 && tipo_pago7 == "CREDIT CARD NO FEE"){
                            document.getElementById('trian7').title = titulo7;
                        }

                        if(pago_8 == 8 && tipo_pago8 == "CREDIT CARD NO FEE"){
                            document.getElementById('trian8').title = titulo8;
                        }

                        if(pago_9 == 9 && tipo_pago9 == "CREDIT CARD NO FEE"){
                            document.getElementById('trian9').title = titulo9;
                        }

                        if(pago_10 == 10 && tipo_pago10 == "CREDIT CARD NO FEE"){
                            document.getElementById('trian10').title = titulo10;
                        }


                        if(no_pago == 1){

                                $("#estado_cob1").val("pagado_cob1");
                                document.getElementById('trian1').style.display = '';

                        }else if(no_pago == 2){

                                $("#estado_cob2").val("pagado_cob2");  
                                document.getElementById('trian1').style.display = '';
                                document.getElementById('trian2').style.display = '';


                        }else if(no_pago == 3){

                                $("#estado_cob3").val("pagado_cob3");
                                 document.getElementById('trian1').style.display = '';
                                 document.getElementById('trian2').style.display = '';
                                 document.getElementById('trian3').style.display = '';



                        }else if(no_pago == 4){

                                $("#estado_cob4").val("pagado_cob4");
                                document.getElementById('trian1').style.display = '';
                                document.getElementById('trian2').style.display = '';
                                document.getElementById('trian3').style.display = '';
                                document.getElementById('trian4').style.display = '';


                        }else if(no_pago == 5){

                                $("#estado_cob5").val("pagado_cob5");
                                document.getElementById('trian1').style.display = '';
                                document.getElementById('trian2').style.display = '';
                                document.getElementById('trian3').style.display = '';
                                document.getElementById('trian4').style.display = '';
                                document.getElementById('trian5').style.display = '';


                        }else if(no_pago == 6){

                                $("#estado_cob6").val("pagado_cob6");
                                document.getElementById('trian1').style.display = '';
                                document.getElementById('trian2').style.display = '';
                                document.getElementById('trian3').style.display = '';
                                document.getElementById('trian4').style.display = '';
                                document.getElementById('trian5').style.display = '';
                                document.getElementById('trian6').style.display = '';



                        }else if(no_pago == 7){

                                $("#estado_cob7").val("pagado_cob7");
                                document.getElementById('trian1').style.display = '';
                                document.getElementById('trian2').style.display = '';
                                document.getElementById('trian3').style.display = '';
                                document.getElementById('trian4').style.display = '';
                                document.getElementById('trian5').style.display = '';
                                document.getElementById('trian6').style.display = '';
                                document.getElementById('trian7').style.display = '';


                        }else if(no_pago == 8){

                                $("#estado_cob8").val("pagado_cob8");
                                document.getElementById('trian1').style.display = '';
                                document.getElementById('trian2').style.display = '';
                                document.getElementById('trian3').style.display = '';
                                document.getElementById('trian4').style.display = '';
                                document.getElementById('trian5').style.display = '';
                                document.getElementById('trian6').style.display = '';
                                document.getElementById('trian7').style.display = '';
                                document.getElementById('trian8').style.display = '';


                        }else if(no_pago == 9){

                                $("#estado_cob9").val("pagado_cob9");
                                document.getElementById('trian1').style.display = '';
                                document.getElementById('trian2').style.display = '';
                                document.getElementById('trian3').style.display = '';
                                document.getElementById('trian4').style.display = '';
                                document.getElementById('trian5').style.display = '';
                                document.getElementById('trian6').style.display = '';
                                document.getElementById('trian7').style.display = '';
                                document.getElementById('trian8').style.display = '';
                                document.getElementById('trian9').style.display = '';


                        }else if(no_pago == 10){

                                $("#estado_cob10").val("pagado_cob10");    
                                document.getElementById('trian1').style.display = '';
                                document.getElementById('trian2').style.display = '';
                                document.getElementById('trian3').style.display = '';
                                document.getElementById('trian4').style.display = '';
                                document.getElementById('trian5').style.display = '';
                                document.getElementById('trian6').style.display = '';
                                document.getElementById('trian7').style.display = '';
                                document.getElementById('trian8').style.display = '';
                                document.getElementById('trian9').style.display = '';
                                document.getElementById('trian10').style.display = '';

                        }


                    }, 0.001);

                    $("#pago_driver").focus();    
//
                    Exit();
                    // Save it!
                } else {
                    // Do nothing!
                    Exit_Cob();                    
                    $("#pago_driver").focus();
                    Exit();
                }

            }
            
            //CREDIT CARD WITH FEE
            if (opcion === '25') {

                if (confirm('Esta Seguro que desea Aplicar este Pago?')) {


                    document.getElementById('paid_driver').value = collect;
//                document.getElementById('pay_amount').value = pago_driver;
                    document.getElementById('opc_ap').value = opcion;
                    
                    setTimeout(function () {
                        //$('#paid_driver').click();
                        calcularTotalPago();
//                        document.getElementById('paid_driver').style.color = "#FFFFFF";
//                        document.getElementById('paid_driver').className = "flashit";
//                        document.getElementById('guardar').className = "flashit";
                        document.getElementById('btn_rever_cob').style.display = "";
                        document.getElementById('paid_driver').style.backgroundColor = "#E21F26";
                        //document.getElementById('paid_driver').title ="Pago sin Guardar"; 
                        document.getElementById("btncancol").style.display = "none"; 
                        document.getElementById("btnAceptar").disabled = true;
                        document.getElementById("btnAceptar").style.background = "lightgray";
                        
                        var pago_1 = document.getElementById('pago_1').value;
                        var pago_2 = document.getElementById('pago_2').value;
                        var pago_3 = document.getElementById('pago_3').value;
                        var pago_4 = document.getElementById('pago_4').value;
                        var pago_5 = document.getElementById('pago_5').value;
                        var pago_6 = document.getElementById('pago_6').value;
                        var pago_7 = document.getElementById('pago_7').value;
                        var pago_8 = document.getElementById('pago_8').value;
                        var pago_9 = document.getElementById('pago_9').value;
                        var pago_10 = document.getElementById('pago_10').value;



                        var tit = "CREDIT CARD WITH FEE"; 
                        var pagado1 = document.getElementById('pagado1').value;
                        var pagado2 = document.getElementById('pagado2').value;
                        var pagado3 = document.getElementById('pagado3').value;
                        var pagado4 = document.getElementById('pagado4').value;
                        var pagado5 = document.getElementById('pagado5').value;
                        var pagado6 = document.getElementById('pagado6').value;
                        var pagado7 = document.getElementById('pagado7').value;
                        var pagado8 = document.getElementById('pagado8').value;
                        var pagado9 = document.getElementById('pagado9').value;
                        var pagado10 = document.getElementById('pagado10').value;

                        var titulo1 = tit + "\n" + "$" + pagado1;
                        var titulo2 = tit + "\n" + "$" + pagado2;
                        var titulo3 = tit + "\n" + "$" + pagado3;
                        var titulo4 = tit + "\n" + "$" + pagado4;
                        var titulo5 = tit + "\n" + "$" + pagado5;
                        var titulo6 = tit + "\n" + "$" + pagado6;
                        var titulo7 = tit + "\n" + "$" + pagado7;
                        var titulo8 = tit + "\n" + "$" + pagado8;
                        var titulo9 = tit + "\n" + "$" + pagado9;
                        var titulo10 = tit + "\n" + "$" + pagado10;

                        if(pago_1 == 0){
                            document.getElementById('trian1').title = "";
                        }

                        if(pago_1 == 1 && tipo_pago1 == "CREDIT CARD WITH FEE"){
                            document.getElementById('trian1').title = titulo1;
                        }

                        if(pago_2 == 2 && tipo_pago2 == "CREDIT CARD WITH FEE"){
                            document.getElementById('trian2').title = titulo2;
                        }


                        if(pago_3 == 3 && tipo_pago3 == "CREDIT CARD WITH FEE"){
                            document.getElementById('trian3').title = titulo3;
                        }

                        if(pago_4 == 4 && tipo_pago4 == "CREDIT CARD WITH FEE"){
                            document.getElementById('trian4').title = titulo4;
                        }

                        if(pago_5 == 5 && tipo_pago5 == "CREDIT CARD WITH FEE"){
                            document.getElementById('trian5').title = titulo5;
                        }

                        if(pago_6 == 6 && tipo_pago6 == "CREDIT CARD WITH FEE"){
                            document.getElementById('trian6').title = titulo6;
                        }

                        if(pago_7 == 7 && tipo_pago7 == "CREDIT CARD WITH FEE"){
                            document.getElementById('trian7').title = titulo7;
                        }

                        if(pago_8 == 8 && tipo_pago8 == "CREDIT CARD WITH FEE"){
                            document.getElementById('trian8').title = titulo8;
                        }

                        if(pago_9 == 9 && tipo_pago9 == "CREDIT CARD WITH FEE"){
                            document.getElementById('trian9').title = titulo9;
                        }

                        if(pago_10 == 10 && tipo_pago10 == "CREDIT CARD WITH FEE"){
                            document.getElementById('trian10').title = titulo10;
                        }


                        if(no_pago == 1){

                                $("#estado_cob1").val("pagado_cob1");
                                document.getElementById('trian1').style.display = '';

                        }else if(no_pago == 2){

                                $("#estado_cob2").val("pagado_cob2");  
                                document.getElementById('trian1').style.display = '';
                                document.getElementById('trian2').style.display = '';


                        }else if(no_pago == 3){

                                $("#estado_cob3").val("pagado_cob3");
                                 document.getElementById('trian1').style.display = '';
                                 document.getElementById('trian2').style.display = '';
                                 document.getElementById('trian3').style.display = '';



                        }else if(no_pago == 4){

                                $("#estado_cob4").val("pagado_cob4");
                                document.getElementById('trian1').style.display = '';
                                document.getElementById('trian2').style.display = '';
                                document.getElementById('trian3').style.display = '';
                                document.getElementById('trian4').style.display = '';


                        }else if(no_pago == 5){

                                $("#estado_cob5").val("pagado_cob5");
                                document.getElementById('trian1').style.display = '';
                                document.getElementById('trian2').style.display = '';
                                document.getElementById('trian3').style.display = '';
                                document.getElementById('trian4').style.display = '';
                                document.getElementById('trian5').style.display = '';


                        }else if(no_pago == 6){

                                $("#estado_cob6").val("pagado_cob6");
                                document.getElementById('trian1').style.display = '';
                                document.getElementById('trian2').style.display = '';
                                document.getElementById('trian3').style.display = '';
                                document.getElementById('trian4').style.display = '';
                                document.getElementById('trian5').style.display = '';
                                document.getElementById('trian6').style.display = '';



                        }else if(no_pago == 7){

                                $("#estado_cob7").val("pagado_cob7");
                                document.getElementById('trian1').style.display = '';
                                document.getElementById('trian2').style.display = '';
                                document.getElementById('trian3').style.display = '';
                                document.getElementById('trian4').style.display = '';
                                document.getElementById('trian5').style.display = '';
                                document.getElementById('trian6').style.display = '';
                                document.getElementById('trian7').style.display = '';


                        }else if(no_pago == 8){

                                $("#estado_cob8").val("pagado_cob8");
                                document.getElementById('trian1').style.display = '';
                                document.getElementById('trian2').style.display = '';
                                document.getElementById('trian3').style.display = '';
                                document.getElementById('trian4').style.display = '';
                                document.getElementById('trian5').style.display = '';
                                document.getElementById('trian6').style.display = '';
                                document.getElementById('trian7').style.display = '';
                                document.getElementById('trian8').style.display = '';


                        }else if(no_pago == 9){

                                $("#estado_cob9").val("pagado_cob9");
                                document.getElementById('trian1').style.display = '';
                                document.getElementById('trian2').style.display = '';
                                document.getElementById('trian3').style.display = '';
                                document.getElementById('trian4').style.display = '';
                                document.getElementById('trian5').style.display = '';
                                document.getElementById('trian6').style.display = '';
                                document.getElementById('trian7').style.display = '';
                                document.getElementById('trian8').style.display = '';
                                document.getElementById('trian9').style.display = '';


                        }else if(no_pago == 10){

                                $("#estado_cob10").val("pagado_cob10");    
                                document.getElementById('trian1').style.display = '';
                                document.getElementById('trian2').style.display = '';
                                document.getElementById('trian3').style.display = '';
                                document.getElementById('trian4').style.display = '';
                                document.getElementById('trian5').style.display = '';
                                document.getElementById('trian6').style.display = '';
                                document.getElementById('trian7').style.display = '';
                                document.getElementById('trian8').style.display = '';
                                document.getElementById('trian9').style.display = '';
                                document.getElementById('trian10').style.display = '';

                        }                         
                        

                    }, 0.001);
                    $("#pago_driver").focus();
                    Exit();

                } else {
                    // Do nothing!
                    Exit_Cob();                      
                    $("#pago_driver").focus();
                    Exit();
                }

            }
            
            // CASH
            if (opcion === '26') {

                if (confirm('Esta Seguro que desea Aplicar este Pago?')) {

                    document.getElementById('paid_driver').value = collect;
//                document.getElementById('pay_amount').value = pago_driver;
                    document.getElementById('opc_ap').value = opcion;
                    
                    setTimeout(function () {
                        //$('#paid_driver').click();
                        calcularTotalPago();
//                        document.getElementById('paid_driver').style.color = "#FFFFFF";
//                        document.getElementById('paid_driver').className = "flashit";
//                        document.getElementById('guardar').className = "flashit";
                        document.getElementById('btn_rever_cob').style.display = "";
                        document.getElementById('paid_driver').style.backgroundColor = "#E21F26";
                        //document.getElementById('paid_driver').title ="Pago sin Guardar"; 
                        document.getElementById("btncancol").style.display = "none"; 
                        document.getElementById("btnAceptar").disabled = true;
                        document.getElementById("btnAceptar").style.background = "lightgray";
                        
                        var pago_1 = document.getElementById('pago_1').value;
                        var pago_2 = document.getElementById('pago_2').value;
                        var pago_3 = document.getElementById('pago_3').value;
                        var pago_4 = document.getElementById('pago_4').value;
                        var pago_5 = document.getElementById('pago_5').value;
                        var pago_6 = document.getElementById('pago_6').value;
                        var pago_7 = document.getElementById('pago_7').value;
                        var pago_8 = document.getElementById('pago_8').value;
                        var pago_9 = document.getElementById('pago_9').value;
                        var pago_10 = document.getElementById('pago_10').value;



                        var tit = "CASH"; 
                        var pagado1 = document.getElementById('pagado1').value;
                        var pagado2 = document.getElementById('pagado2').value;
                        var pagado3 = document.getElementById('pagado3').value;
                        var pagado4 = document.getElementById('pagado4').value;
                        var pagado5 = document.getElementById('pagado5').value;
                        var pagado6 = document.getElementById('pagado6').value;
                        var pagado7 = document.getElementById('pagado7').value;
                        var pagado8 = document.getElementById('pagado8').value;
                        var pagado9 = document.getElementById('pagado9').value;
                        var pagado10 = document.getElementById('pagado10').value;

                        var titulo1 = tit + "\n" + "$" + pagado1;
                        var titulo2 = tit + "\n" + "$" + pagado2;
                        var titulo3 = tit + "\n" + "$" + pagado3;
                        var titulo4 = tit + "\n" + "$" + pagado4;
                        var titulo5 = tit + "\n" + "$" + pagado5;
                        var titulo6 = tit + "\n" + "$" + pagado6;
                        var titulo7 = tit + "\n" + "$" + pagado7;
                        var titulo8 = tit + "\n" + "$" + pagado8;
                        var titulo9 = tit + "\n" + "$" + pagado9;
                        var titulo10 = tit + "\n" + "$" + pagado10;

                        if(pago_1 == 0){
                            document.getElementById('trian1').title = "";
                        }

                        if(pago_1 == 1 && tipo_pago1 == "CASH"){
                            document.getElementById('trian1').title = titulo1;
                        }

                        if(pago_2 == 2 && tipo_pago2 == "CASH"){
                            document.getElementById('trian2').title = titulo2;
                        }


                        if(pago_3 == 3 && tipo_pago3 == "CASH"){
                            document.getElementById('trian3').title = titulo3;
                        }

                        if(pago_4 == 4 && tipo_pago4 == "CASH"){
                            document.getElementById('trian4').title = titulo4;
                        }

                        if(pago_5 == 5 && tipo_pago5 == "CASH"){
                            document.getElementById('trian5').title = titulo5;
                        }

                        if(pago_6 == 6 && tipo_pago6 == "CASH"){
                            document.getElementById('trian6').title = titulo6;
                        }

                        if(pago_7 == 7 && tipo_pago7 == "CASH"){
                            document.getElementById('trian7').title = titulo7;
                        }

                        if(pago_8 == 8 && tipo_pago8 == "CASH"){
                            document.getElementById('trian8').title = titulo8;
                        }

                        if(pago_9 == 9 && tipo_pago9 == "CASH"){
                            document.getElementById('trian9').title = titulo9;
                        }

                        if(pago_10 == 10 && tipo_pago10 == "CASH"){
                            document.getElementById('trian10').title = titulo10;
                        }


                        if(no_pago == 1){

                                $("#estado_cob1").val("pagado_cob1");
                                document.getElementById('trian1').style.display = '';

                        }else if(no_pago == 2){

                                $("#estado_cob2").val("pagado_cob2");  
                                document.getElementById('trian1').style.display = '';
                                document.getElementById('trian2').style.display = '';


                        }else if(no_pago == 3){

                                $("#estado_cob3").val("pagado_cob3");
                                 document.getElementById('trian1').style.display = '';
                                 document.getElementById('trian2').style.display = '';
                                 document.getElementById('trian3').style.display = '';



                        }else if(no_pago == 4){

                                $("#estado_cob4").val("pagado_cob4");
                                document.getElementById('trian1').style.display = '';
                                document.getElementById('trian2').style.display = '';
                                document.getElementById('trian3').style.display = '';
                                document.getElementById('trian4').style.display = '';


                        }else if(no_pago == 5){

                                $("#estado_cob5").val("pagado_cob5");
                                document.getElementById('trian1').style.display = '';
                                document.getElementById('trian2').style.display = '';
                                document.getElementById('trian3').style.display = '';
                                document.getElementById('trian4').style.display = '';
                                document.getElementById('trian5').style.display = '';


                        }else if(no_pago == 6){

                                $("#estado_cob6").val("pagado_cob6");
                                document.getElementById('trian1').style.display = '';
                                document.getElementById('trian2').style.display = '';
                                document.getElementById('trian3').style.display = '';
                                document.getElementById('trian4').style.display = '';
                                document.getElementById('trian5').style.display = '';
                                document.getElementById('trian6').style.display = '';



                        }else if(no_pago == 7){

                                $("#estado_cob7").val("pagado_cob7");
                                document.getElementById('trian1').style.display = '';
                                document.getElementById('trian2').style.display = '';
                                document.getElementById('trian3').style.display = '';
                                document.getElementById('trian4').style.display = '';
                                document.getElementById('trian5').style.display = '';
                                document.getElementById('trian6').style.display = '';
                                document.getElementById('trian7').style.display = '';


                        }else if(no_pago == 8){

                                $("#estado_cob8").val("pagado_cob8");
                                document.getElementById('trian1').style.display = '';
                                document.getElementById('trian2').style.display = '';
                                document.getElementById('trian3').style.display = '';
                                document.getElementById('trian4').style.display = '';
                                document.getElementById('trian5').style.display = '';
                                document.getElementById('trian6').style.display = '';
                                document.getElementById('trian7').style.display = '';
                                document.getElementById('trian8').style.display = '';


                        }else if(no_pago == 9){

                                $("#estado_cob9").val("pagado_cob9");
                                document.getElementById('trian1').style.display = '';
                                document.getElementById('trian2').style.display = '';
                                document.getElementById('trian3').style.display = '';
                                document.getElementById('trian4').style.display = '';
                                document.getElementById('trian5').style.display = '';
                                document.getElementById('trian6').style.display = '';
                                document.getElementById('trian7').style.display = '';
                                document.getElementById('trian8').style.display = '';
                                document.getElementById('trian9').style.display = '';


                        }else if(no_pago == 10){

                                $("#estado_cob10").val("pagado_cob10");    
                                document.getElementById('trian1').style.display = '';
                                document.getElementById('trian2').style.display = '';
                                document.getElementById('trian3').style.display = '';
                                document.getElementById('trian4').style.display = '';
                                document.getElementById('trian5').style.display = '';
                                document.getElementById('trian6').style.display = '';
                                document.getElementById('trian7').style.display = '';
                                document.getElementById('trian8').style.display = '';
                                document.getElementById('trian9').style.display = '';
                                document.getElementById('trian10').style.display = '';

                        }                       
                        

                    }, 0.001);

                    $("#pago_driver").focus();
 
                    Exit();

                } else {
                    // Do nothing!
                    Exit_Cob();                     
                    $("#pago_driver").focus();                    
                    Exit();
                }


            }
            
            //CHECK
            
            if (opcion === '27') {

                if (confirm('Esta Seguro que desea Aplicar este Pago?')) {


                    document.getElementById('paid_driver').value = collect;
//                document.getElementById('pay_amount').value = pago_driver;
                    document.getElementById('opc_ap').value = opcion;

                    setTimeout(function () {
                        //$('#paid_driver').click();
                        calcularTotalPago();
//                        document.getElementById('paid_driver').style.color = "#FFFFFF";
//                        document.getElementById('paid_driver').className = "flashit";
//                        document.getElementById('guardar').className = "flashit";
                        document.getElementById('btn_rever_cob').style.display = "";
                        document.getElementById('paid_driver').style.backgroundColor = "#E21F26";
                        //document.getElementById('paid_driver').title ="Pago sin Guardar"; 
                        document.getElementById("btncancol").style.display = "none"; 
                        document.getElementById("btnAceptar").disabled = true;
                        document.getElementById("btnAceptar").style.background = "lightgray";
                        
                        var pago_1 = document.getElementById('pago_1').value;
                        var pago_2 = document.getElementById('pago_2').value;
                        var pago_3 = document.getElementById('pago_3').value;
                        var pago_4 = document.getElementById('pago_4').value;
                        var pago_5 = document.getElementById('pago_5').value;
                        var pago_6 = document.getElementById('pago_6').value;
                        var pago_7 = document.getElementById('pago_7').value;
                        var pago_8 = document.getElementById('pago_8').value;
                        var pago_9 = document.getElementById('pago_9').value;
                        var pago_10 = document.getElementById('pago_10').value;



                        var tit = "CHECK"; 
                        var pagado1 = document.getElementById('pagado1').value;
                        var pagado2 = document.getElementById('pagado2').value;
                        var pagado3 = document.getElementById('pagado3').value;
                        var pagado4 = document.getElementById('pagado4').value;
                        var pagado5 = document.getElementById('pagado5').value;
                        var pagado6 = document.getElementById('pagado6').value;
                        var pagado7 = document.getElementById('pagado7').value;
                        var pagado8 = document.getElementById('pagado8').value;
                        var pagado9 = document.getElementById('pagado9').value;
                        var pagado10 = document.getElementById('pagado10').value;

                        var titulo1 = tit + "\n" + "$" + pagado1;
                        var titulo2 = tit + "\n" + "$" + pagado2;
                        var titulo3 = tit + "\n" + "$" + pagado3;
                        var titulo4 = tit + "\n" + "$" + pagado4;
                        var titulo5 = tit + "\n" + "$" + pagado5;
                        var titulo6 = tit + "\n" + "$" + pagado6;
                        var titulo7 = tit + "\n" + "$" + pagado7;
                        var titulo8 = tit + "\n" + "$" + pagado8;
                        var titulo9 = tit + "\n" + "$" + pagado9;
                        var titulo10 = tit + "\n" + "$" + pagado10;

                        if(pago_1 == 0){
                            document.getElementById('trian1').title = "";
                        }

                        if(pago_1 == 1 && tipo_pago1 == "CHECK"){
                            document.getElementById('trian1').title = titulo1;
                        }

                        if(pago_2 == 2 && tipo_pago2 == "CHECK"){
                            document.getElementById('trian2').title = titulo2;
                        }


                        if(pago_3 == 3 && tipo_pago3 == "CHECK"){
                            document.getElementById('trian3').title = titulo3;
                        }

                        if(pago_4 == 4 && tipo_pago4 == "CHECK"){
                            document.getElementById('trian4').title = titulo4;
                        }

                        if(pago_5 == 5 && tipo_pago5 == "CHECK"){
                            document.getElementById('trian5').title = titulo5;
                        }

                        if(pago_6 == 6 && tipo_pago6 == "CHECK"){
                            document.getElementById('trian6').title = titulo6;
                        }

                        if(pago_7 == 7 && tipo_pago7 == "CHECK"){
                            document.getElementById('trian7').title = titulo7;
                        }

                        if(pago_8 == 8 && tipo_pago8 == "CHECK"){
                            document.getElementById('trian8').title = titulo8;
                        }

                        if(pago_9 == 9 && tipo_pago9 == "CHECK"){
                            document.getElementById('trian9').title = titulo9;
                        }

                        if(pago_10 == 10 && tipo_pago10 == "CHECK"){
                            document.getElementById('trian10').title = titulo10;
                        }


                        if(no_pago == 1){

                                $("#estado_cob1").val("pagado_cob1");
                                document.getElementById('trian1').style.display = '';

                        }else if(no_pago == 2){

                                $("#estado_cob2").val("pagado_cob2");  
                                document.getElementById('trian1').style.display = '';
                                document.getElementById('trian2').style.display = '';


                        }else if(no_pago == 3){

                                $("#estado_cob3").val("pagado_cob3");
                                 document.getElementById('trian1').style.display = '';
                                 document.getElementById('trian2').style.display = '';
                                 document.getElementById('trian3').style.display = '';



                        }else if(no_pago == 4){

                                $("#estado_cob4").val("pagado_cob4");
                                document.getElementById('trian1').style.display = '';
                                document.getElementById('trian2').style.display = '';
                                document.getElementById('trian3').style.display = '';
                                document.getElementById('trian4').style.display = '';


                        }else if(no_pago == 5){

                                $("#estado_cob5").val("pagado_cob5");
                                document.getElementById('trian1').style.display = '';
                                document.getElementById('trian2').style.display = '';
                                document.getElementById('trian3').style.display = '';
                                document.getElementById('trian4').style.display = '';
                                document.getElementById('trian5').style.display = '';


                        }else if(no_pago == 6){

                                $("#estado_cob6").val("pagado_cob6");
                                document.getElementById('trian1').style.display = '';
                                document.getElementById('trian2').style.display = '';
                                document.getElementById('trian3').style.display = '';
                                document.getElementById('trian4').style.display = '';
                                document.getElementById('trian5').style.display = '';
                                document.getElementById('trian6').style.display = '';



                        }else if(no_pago == 7){

                                $("#estado_cob7").val("pagado_cob7");
                                document.getElementById('trian1').style.display = '';
                                document.getElementById('trian2').style.display = '';
                                document.getElementById('trian3').style.display = '';
                                document.getElementById('trian4').style.display = '';
                                document.getElementById('trian5').style.display = '';
                                document.getElementById('trian6').style.display = '';
                                document.getElementById('trian7').style.display = '';


                        }else if(no_pago == 8){

                                $("#estado_cob8").val("pagado_cob8");
                                document.getElementById('trian1').style.display = '';
                                document.getElementById('trian2').style.display = '';
                                document.getElementById('trian3').style.display = '';
                                document.getElementById('trian4').style.display = '';
                                document.getElementById('trian5').style.display = '';
                                document.getElementById('trian6').style.display = '';
                                document.getElementById('trian7').style.display = '';
                                document.getElementById('trian8').style.display = '';


                        }else if(no_pago == 9){

                                $("#estado_cob9").val("pagado_cob9");
                                document.getElementById('trian1').style.display = '';
                                document.getElementById('trian2').style.display = '';
                                document.getElementById('trian3').style.display = '';
                                document.getElementById('trian4').style.display = '';
                                document.getElementById('trian5').style.display = '';
                                document.getElementById('trian6').style.display = '';
                                document.getElementById('trian7').style.display = '';
                                document.getElementById('trian8').style.display = '';
                                document.getElementById('trian9').style.display = '';


                        }else if(no_pago == 10){

                                $("#estado_cob10").val("pagado_cob10");    
                                document.getElementById('trian1').style.display = '';
                                document.getElementById('trian2').style.display = '';
                                document.getElementById('trian3').style.display = '';
                                document.getElementById('trian4').style.display = '';
                                document.getElementById('trian5').style.display = '';
                                document.getElementById('trian6').style.display = '';
                                document.getElementById('trian7').style.display = '';
                                document.getElementById('trian8').style.display = '';
                                document.getElementById('trian9').style.display = '';
                                document.getElementById('trian10').style.display = '';

                        }                

                    }, 0.001);

                    $("#pago_driver").focus();

                    Exit();

                } else {
                    // Do nothing!
                    Exit_Cob();
                    $("#pago_driver").focus();
                    Exit();
                }

            }


            //var resultados = prueba + opcion_pago_2;
            //alert(pago_driver);
        }
    </script>


    <script type="text/javascript">

        function mostrarVentana2() {

            capturar();


            if (window.screen.availWidth <= 640) {

                window.parent.document.body.style.zoom = "62%";
                var ventana2 = document.getElementById('miVentana2'); // Accedemos al contenedor  
//                ventana2.style.marginTop = "-0.5px"; // Definimos su posición vertical.        
//                ventana2.style.marginLeft = "0.6px"; // Definimos su posición horizontal
                ventana2.style.display = 'block'; // Y lo hacemos visible
//                ventana2.style.position = 'absolute';
                ventana2.style.height = '174px';
            }

            if (window.screen.availWidth == 800) {

                window.parent.document.body.style.zoom = "78%";
                var ventana2 = document.getElementById('miVentana2'); // Accedemos al contenedor  
//                ventana2.style.marginTop = "-0.5px"; // Definimos su posición vertical.        
//                ventana2.style.marginLeft = "0.6px"; // Definimos su posición horizontal
                ventana2.style.display = 'block'; // Y lo hacemos visible
//                ventana2.style.position = 'absolute';
                ventana2.style.height = '174px';
            }
            if (window.screen.availWidth == 1024) {

                window.parent.document.body.style.zoom = "100%";
                var ventana2 = document.getElementById('miVentana2'); // Accedemos al contenedor  
//                ventana2.style.marginTop = "-0.5px"; // Definimos su posición vertical.        
//                ventana2.style.marginLeft = "0.6px"; // Definimos su posición horizontal
                ventana2.style.display = 'block'; // Y lo hacemos visible
//                ventana2.style.position = 'absolute';
                ventana2.style.height = '174px';


            }

            if (window.screen.availWidth == 1366 && (z == 1 || z == 2 || z == 3)) {


                var ventana2 = document.getElementById('miVentana2'); // Accedemos al contenedor  
//                ventana2.style.marginTop = "-1px"; // Definimos su posición vertical.        
//                ventana2.style.marginLeft = "-86.4px"; // Definimos su posición horizontal
                ventana2.style.display = 'block'; // Y lo hacemos visible
//                ventana2.style.position = 'absolute';
                ventana2.style.height = '174px';

            }

            if (window.screen.availWidth == 1440 && (z == 1 || z == 2 || z == 3)) {


                var ventana2 = document.getElementById('miVentana2'); // Accedemos al contenedor  
//                ventana2.style.marginTop = "6px"; // Definimos su posición vertical.        
//                ventana2.style.marginLeft = "-277.4px"; // Definimos su posición horizontal
                ventana2.style.display = 'block'; // Y lo hacemos visible
//                ventana2.style.position = 'absolute';
                ventana2.style.height = '174px';

            }

            if (window.screen.availWidth == 1600 && (z == 1 || z == 2 || z == 3)) {


                var ventana2 = document.getElementById('miVentana2'); // Accedemos al contenedor  
//                ventana2.style.marginTop = "6px"; // Definimos su posición vertical.        
//                ventana2.style.marginLeft = "-277.4px"; // Definimos su posición horizontal
                ventana2.style.display = 'block'; // Y lo hacemos visible
//                ventana2.style.position = 'absolute';
                ventana2.style.height = '174px';

            }

            if (window.screen.availWidth == 1680 && (z == 1 || z == 2 || z == 3)) {


                var ventana2 = document.getElementById('miVentana2'); // Accedemos al contenedor  
//                ventana2.style.marginTop = "6px"; // Definimos su posición vertical.        
//                ventana2.style.marginLeft = "-277.4px"; // Definimos su posición horizontal
                ventana2.style.display = 'block'; // Y lo hacemos visible
//                ventana2.style.position = 'absolute';
                ventana2.style.height = '174px';

            }

            if (window.screen.availWidth > 1680 && (z == 1 || z == 2 || z == 3)) {


                var ventana2 = document.getElementById('miVentana2'); // Accedemos al contenedor  
//                ventana2.style.marginTop = "-0.5px"; // Definimos su posición vertical.        
//                ventana2.style.marginLeft = "-0.4px"; // Definimos su posición horizontal
                ventana2.style.display = 'block'; // Y lo hacemos visible
//                ventana2.style.position = 'absolute';
                ventana2.style.height = '174px';


            }
            

            document.getElementById("pago_driver").disabled = false;           
            document.getElementById('pago_driver').value = '';
            document.getElementById('pago_driver').style.color = '#848484';
            document.getElementById('pago_driver').style.background = '#fff';
            $("#pago_driver").focus();

            document.getElementById('op_pago_id1').value = 0;
            //document.getElementById('op_pago_id').value = 8;
            document.getElementById('opcion_pago_2').value = 2;
            //document.getElementById('opcion_pago_3').value = 2;

            document.getElementById("btnAceptar").style.background = "lightgray";            
            document.getElementById('btnAceptar').style.background = '';
            document.getElementById('btnAceptar').style.color = '#000';
            document.getElementById('btnAceptar').style.cursor = '';
            
            


            //$('#pago_driver').val()='0.00';
        }


    </script>

    <script languague="javascript">

        function ocultarmenu() {
            div = document.getElementById('menu-bar');
            div.style.display = 'none';
            div2 = document.getElementById('hd-menu');
            div2.style.display = 'none';

        }

    </script>

    <script type="text/javascript">
        function CreditCardWithFee()
        {

        }
    </script>


    <script>

        $(function () {
            $("#btn-save1").css('display', 'none');
            $("#btn-cancel").click(function () {
                location.href = "<?php echo $data['rootUrl'] ?>admin/onedaytour"
            });

        });
        
        $("#pay_driver").click(function () {
            
            var id_agency = $("#id_agency").val();
            var child = $("#child").val();
            var adult = $("#adult").val();
            var fecha  = $("#fecha_salida").val();
            var total_pax = parseInt(adult) + parseInt(child);

            $("#reserveprices").load(encodeURI('<?php echo $data['rootUrl'] ?>admin/oneday/getcosttransf/' + $("#type_rate").val() + '/' + fecha + '/' + id_agency + '/' + total_pax));
        
        });
        
        $("#btnPagolinea").click(function () {
        //$("#pago_agente").click(function () {
            
            document.getElementById('btnPagolinea').style.display = 'none';
            document.getElementById("btndecline").disabled = false;
            document.getElementById("btndecline").style.display = "";
            document.getElementById("btndecline").style.cursor = 'pointer';
            
            var paid_driver = $("#paid_driver").val();
            var pay_amount = $("#pay_amount").val();
            //var cantidad = parseFloat(paid_driver) + parseFloat(pay_amount);
        
            //var cantidad = $("#pay_amount").val();
            var cantidad = $("#pago_tarjeta").val();
            
            var id_agency = $("#id_agency").val();
            var child = $("#child").val();
            var adult = $("#adult").val();
            var fecha  = $("#fecha_salida").val();
            var total_pax = parseInt(adult) + parseInt(child);
            $("#reserveprices").load(encodeURI('<?php echo $data['rootUrl'] ?>admin/oneday/getcosttransf/' + $("#type_rate").val() + '/' + fecha + '/' + id_agency + '/' + total_pax));



            if (cantidad <= 0) {
                return false;
            }
            var email1 = $("#email1").val();
            var primer_n = $("#firstname1").val();
            var segundo_n = $("#lastname1").val();
            var phone1 = $("#phone1").val();
            if (segundo_n === '.') {
                segundo_n = '';
            }
            var url = ('<?php echo $data['rootUrl'] ?>admin/pago/agente/' + cantidad + '/' + email1 + '/' + primer_n + '/' + segundo_n + '/' + phone1 + '/' + '<?php echo $_SESSION['codconf']; ?>');
            window.open(url, '_blank');
            return false;
        });

        $(window).load(function () {
            
            ocultarmenu();
            comprobarScreen();
            
            document.getElementById('op_pago_conductor').value = 8;
            captura();
            passenger_balance();
            fechatrip();
            document.getElementById('comments').value = "";
           
            

            $("#agency").focus();
            $("#content").css("opacity", "1");
            var sel_payment = '<?php echo $reserva->op_pago; ?>';

            document.getElementById('saldoactual').value = ('0.00');
            document.getElementById('paid_driver').value = ('0.00');
            document.getElementById('balance_due').value = ('0.00');
            document.getElementById('totalAmount').value = ('0.00');
            document.getElementById('pay_amount').value = ('0.00');
            document.getElementById('agency_balance_due').value = ('0.00');
            document.getElementById('extra').value = ('0.00');
            document.getElementById('descuento').value = ('0');
            document.getElementById('descuento_valor').value = ('0.00');

            $("#op_pago_id option[value=" + sel_payment + "]").attr("selected", "selected");
            calcularTotalPago();
            
        });



        $("#op_pago_id").change(function () {
            calcularTotalPago();
        });
        $("#pay_amount").change(function () {
            calcularTotalPago();
        });
        $.fn.autosugguest({
            className: 'ausu-suggest',
            methodType: 'POST',
            minChars: 1,
            rtnIDs: true,
            dataFile: '<?php echo $data["rootUrl"]; ?>admin/onetours/loaddatos'
        });


        $(function () {
            $.datepicker.setDefaults($.datepicker.regional["es"]);
            $("#fecha_salida").datepicker({
                firstDay: 1,
                dateFormat: 'm-d-yy',
                numberOfMonths: 2,
                changeMonth: true,
                changeYear: true

            });
        });

        
        
        $(function () {
            $.datepicker.setDefaults($.datepicker.regional["es"]);
            $("#fecha_retorno").datepicker({
                firstDay: 1,
                dateFormat: 'm-d-yy',
                numberOfMonths: 2,
                changeMonth: true,
                changeYear: true
            });
        });

        $("#fecha_salida").change(function () {
            var fecha_salida = $('#fecha_salida').val();

            $("#fecha_retorno").val(fecha_salida);           
            $("#fecha_salida").datepicker("hide");


            if (!Validar(fecha_salida)) {
                $('#fecha_salida').focus();
            } else {
                var fecha_retorno = $('#fecha_retorno').val();
            }


        });

        $("#fecha_retorno").change(function () {
            var fecha_retorno = $('#fecha_retorno').val();

            $("#fecha_retorno").val(fecha_retorno);

            if (!Validar(fecha_retorno)) {
                $('#fecha_retorno').focus();
            } else {
                var fecha_salida = $('#fecha_salida').val();
            }


        });




        $(document).ready(function ()
        {
            $("#fecha_salida").datepicker("option", "yearRange", "-99:+2050");
            $("#fecha_salida").datepicker("option", "maxDate", "+1000m +1000d");

            $("#fecha_retorno").datepicker("option", "yearRange", "-99:+2050");
            $("#fecha_retorno").datepicker("option", "maxDate", "+1000m +1000d");
            
                       
            
        });

        function poner(id, id2) {
            var id = id;
            var id2 = id2;
            $("#userr").load('<?php echo $data["rootUrl"]; ?>admin/tours/cargardatos/' + id + '/' + id2);
        }
        $(function () {
            
            $("#from").change(function (evt) {
                
                cargando();                            

                $("#ext_from1").load(encodeURI('<?php echo $data['rootUrl']; ?>consul/exten/' + id));
                if (id !== 0) {
                    $("#a_pickup1").attr('disabled', false);
                } else {
                    $("#a_pickup1").attr('disabled', true);
                }
                if (!Validar($("#fecha_salida").val())) {
                    alert('please insert a valid date');
                    $("#from").val(0);
                } else {
                    
                    var adultos = $("#adult").val();  
                    var chicos = $("#child").val();           
                    var id = $("#from").val();
                    var total_pax = parseInt(adultos) + parseInt(chicos);

                    //alert(total_pax);
                    
                    var fecha = $("#fecha_salida").val();
                    var fechatrip = $("#fecha_trip").val();
                    
//                    alert(fechatrip);
//                    exit;
                    
                    var id_agencia = $("#id_agency").val();
                    //cargando();
                    
                    $("#reserveprices").load(encodeURI('<?php echo $data['rootUrl'] ?>admin/oneday/getcosttransf/' + $("#type_rate").val() + '/' + fecha + '/' + id_agencia + '/' + total_pax), function () {

                        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////@ndromeda


                        if (z == 1) {

                            
                            var tres = (parseFloat($("#pricexadult").val()) * parseFloat($("#adult").val()) + parseFloat($("#pricexchild").val()) * parseFloat($("#child").val())) / 2;
                                                       
                            priceadults.value = parseFloat($("#pricexadult").val());
                            pricechilds.value = parseFloat($("#pricexchild").val());
                            group_park.value = 1;
                            $("#totalreserve").val(tres);
                            
                           
                        }

                        if (z == 2) {
                            
                            
                            var tres = (parseFloat($("#pricexadult1").val()) * parseFloat($("#adult").val()) + parseFloat($("#pricexchild1").val()) * parseFloat($("#child").val())) / 2;
                            
                            priceadults.value = parseFloat($("#pricexadult1").val());
                            pricechilds.value = parseFloat($("#pricexchild1").val());
                            group_park.value = 2;
                            $("#totalreserve").val(tres);
                            
                            
                        }

                        if (z == 3) {
                            
                            
                            var tres = (parseFloat($("#pricexadult2").val()) * parseFloat($("#adult").val()) + parseFloat($("#pricexchild2").val()) * parseFloat($("#child").val())) / 2;
                            
                            priceadults.value = parseFloat($("#pricexadult2").val());
                            pricechilds.value = parseFloat($("#pricexchild2").val());
                            group_park.value = 3;
                            $("#totalreserve").val(tres);
                            
                            
                        }
                        calcularTotalPago();
                        
                        $("#to2").val(id);
                        $("#to2").trigger('change');
//                        var adultos = $("#adult").val();  
//                        var chicos = $("#child").val();    
                        
                        var t= 7;
                        
                        $("#btn-load").load(encodeURI('<?php echo $data['rootUrl']; ?>admin/reservas/ocuparPuesto/'+ t + '/' + 301 + '/' + 1 + '/' + fechatrip + '/' + total_pax + '/' + 1)); 
                        $("#btn-load").load(encodeURI('<?php echo $data['rootUrl']; ?>admin/reservas/ocuparPuesto/'+ t + '/' + 300 + '/' + 2 + '/' + fechatrip + '/' + total_pax + '/' + 1)); 


                        //$("#btn-load").load(encodeURI('<?php echo $data['rootUrl']; ?>admin/reservas/ocuparPuesto/' + 301 + '/' + 1 + '/' + fechatrip + '/' + total_pax + '/' + 1)); 
                        //$("#btn-load").load(encodeURI('<?php echo $data['rootUrl']; ?>admin/reservas/ocuparPuesto/' + 300 + '/' + 2 + '/' + fechatrip + '/' + total_pax + '/' + 1)); 
                        $("#schedule1").load(encodeURI('<?php echo $data['rootUrl']; ?>tours/onedaytour/1/' + $("#from").val() + '/' + $("#fecha_salida").val() + '/' + $("#adult").val() + '/' + $("#child").val()));                    
                        $("#schedule2").load(encodeURI('<?php echo $data['rootUrl']; ?>tours/onedaytour/2/' + $("#to2").val() + '/' + $("#fecha_salida").val() + '/' + $("#adult").val() + '/' + $("#child").val()));
                        
                        
                        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////@ndromeda
//                        if (tres != Math.NaN) {
//                            $("#price_transport1pp").html("$" + tres.toFixed(2));
//                            $("#price_transport2pp").html("$" + tres.toFixed(2));
//
//                        }
                        
                        
                    });
                    
                    
                    
                }
            });
            $("#to2").change(function (evt) {
                var id = $("#to2").val();
                if (id != 0) {
                    $("#d_pickup1").attr('disabled', false);
                } else {
                    $("#d_pickup1").attr('disabled', true);
                }
                $("#ext_to2").load(encodeURI('<?php echo $data['rootUrl']; ?>consul/exten/' + id));
                if (!Validar($("#fecha_salida").val())) {
                    alert('Please enter a valid date');
                    $("#to2").val(0);
                } else {
                    
                    var adultos = $("#adult").val();  
                    var chicos = $("#child").val();           
                    var id = $("#from").val();
                    var total_pax = parseInt(adultos) + parseInt(chicos);

                    var fecha = $("#fecha_salida").val();
                    var id_agencia = $("#id_agency").val();
                    //$("#reserveprices").load(encodeURI('<?php echo $data['rootUrl'] ?>admin/oneday/getcosttransf/' + $("#type_rate").val() + '/' + fecha + '/' + id_agencia), function () {
                    $("#reserveprices").load(encodeURI('<?php echo $data['rootUrl'] ?>admin/oneday/getcosttransf/' + $("#type_rate").val() + '/' + fecha + '/' + id_agencia + '/' + total_pax), function () { 

                        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////@ndromeda

                
                        if (z == 1) {

                            var tres = (parseFloat($("#pricexadult").val()) * parseFloat($("#adult").val()) + parseFloat($("#pricexchild").val()) * parseFloat($("#child").val())) / 2;
                            //alert(tres);
                            
                            priceadults.value = parseFloat($("#pricexadult").val());
                            pricechilds.value = parseFloat($("#pricexchild").val());
                            group_park.value = 1;
                            $("#totalreserver").val(tres);
                           
                        }

                        if (z == 2) {

                            var tres = (parseFloat($("#pricexadult1").val()) * parseFloat($("#adult").val()) + parseFloat($("#pricexchild1").val()) * parseFloat($("#child").val())) / 2;

                            
                            priceadults.value = parseFloat($("#pricexadult1").val());
                            pricechilds.value = parseFloat($("#pricexchild1").val());
                            group_park.value = 2;
                            $("#totalreserver").val(tres);
                            
                        }

                        if (z == 3) {

                            var tres = (parseFloat($("#pricexadult2").val()) * parseFloat($("#adult").val()) + parseFloat($("#pricexchild2").val()) * parseFloat($("#child").val())) / 2;

                           
                            priceadults.value = parseFloat($("#pricexadult2").val());
                            pricechilds.value = parseFloat($("#pricexchild2").val());
                            group_park.value = 3;
                            $("#totalreserver").val(tres);
                            
                        }
                        
                        calcularTotalPago();
                        
//                        if (tres != Math.NaN) {
//                            $("#price_transport2pp").html("$" + tres.toFixed(2));
//                            $("#price_transport1pp").html("$" + tres.toFixed(2));
//                        }
                       
                    });
                   
                }
                //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////  
                if (Validar($("#fecha_salida").val())) {
                    $("#schedule1").load(encodeURI('<?php echo $data['rootUrl']; ?>tours/onedaytour/1/' + $("#from").val() + '/' + $("#fecha_salida").val() + '/' + $("#adult").val() + '/' + $("#child").val()));
                    $("#schedule2").load(encodeURI('<?php echo $data['rootUrl']; ?>tours/onedaytour/2/' + $("#to2").val() + '/' + $("#fecha_salida").val() + '/' + $("#adult").val() + '/' + $("#child").val()));
                } else {
                    $("#to2").val(0);
                }

            });
            $("#ext_from1").change(function () {
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
                    //
                }
            });
            $("#dataclick1").click(function (evt) {
                evt.preventDefault();
                //$("#fecha_salida").datepicker("show");
            });
            $("#dataclick2").click(function (evt) {
                evt.preventDefault();
                //$("#fecha_retorno").datepicker("show");
            });
            $("#fechasalida").focusout(function (evt) {
                evt.preventDefault();
                $("#fecha_salida").datepicker({numberOfMonths: 3});
                //$("#fecha_salidadatepicker").datepicker({numberOfMonths: [3,1] });

            });


//            $("#fecha_salida").click(function ()){
//                
//            $("#fecha_salida").datepicker("getDate")== $("#fecha_retorno").datepicker("getDate");
//            
//            }
///////////////////////////////////////////////////////////////////////

//            $("#fecha_salida").change(function () {
//                                var fecha_salida = $('#fecha_salida').val();
//                                $("#fecha_retorno").val(fecha_salida);
//                                if (!Validar(fecha_salida)) {
//                                    $('#fecha_salida').focus();
//                                } 
            /////////////////////////////////////////////////////////////////////////////////         
            $("#ext_to2").change(function () {
                if (parseFloat($("#ext_to2").val()) > 0) {
                    $("#d_pickup1").attr('disabled', true);
                    $("#d_pickup2").attr('disabled', false);
                    $("#d_room1").attr('disable', false);
                } else {
                    $("#d_pickup1").attr('disabled', false);
                    $("#d_pickup2").attr('disabled', true);
                    $("#d_room1").attr('disable', true);
                }
            });
        });
        
        var apagare
        
        function calcularTotalPago() {

            //////////////////////////////////actualizacion

            var saldoactual = $("#saldoctual").val();
            var paid_driver = $("#paid_driver").val();
            var balance_due = $("#balance_due").val();
            var totalamount = $("#totalAmount").val();
            var pay_amount = $("#pay_amount").val();            
            var otheramount = $("#otheramount").val();
            var agency_balance_due = $("#agency_balance_due").val();
            var priceadults = $("#priceadults").val();
            var pricechilds = $("#pricechilds").val();
            var total_initial = calcCom() - parseFloat($("#rastrocom").val());

            if (parseFloat($("#extra").val()) > 0) {
                
                total_initial += parseFloat($("#extra").val());
                
            }
            var total_total = total_initial;

//            if (parseFloat($("#descuento_valor").val()) > 0) {
//                    total_total -= parseFloat($("#descuento_valor").val());
//                }
//            if (parseFloat($("#descuento").val())) {
//                    total_total -= total_total * (parseFloat($("#descuento").val()));
//                }
            if (parseFloat($("#descuento_valor").val()) > 0) {
                /* total_total -= parseFloat($("#descuento_valor").val()); */
                if (parseFloat($("#otheramount").val()) > 0) {
                    //actualizacion
                    total_total -= parseFloat($("#descuento_valor").val());
                    //
                    total_initial -= parseFloat($("#descuento_valor").val());
                } else {
                    total_total -= parseFloat($("#descuento_valor").val());
                    total_initial -= parseFloat($("#descuento_valor").val());
                }
            }
            if (parseFloat($("#descuento").val())) {
                if (parseFloat($("#otheramount").val()) > 0) {
                    //actualizacion
                    total_total = total_total - ((total_total) * (parseFloat($("#descuento").val()) / 100));
                    //
                    total_initial = total_initial - ((total_initial) * (parseFloat($("#descuento").val()) / 100));
                } else {
                    total_total = total_total - ((total_total) * (parseFloat($("#descuento").val()) / 100));
                    total_initial = total_initial - ((total_initial) * (parseFloat($("#descuento").val()) / 100));
                }
            }
            if (parseFloat($("#otheramount").val()) > 0) {
                //total_total = parseFloat($("#otheramount").val());
                
                //actualizacion
                otheramount = parseFloat($("#otheramount").val());
                //
            }

            apagare = total_total;
            
            var fee = 0;

            var tipo_pago = $("#op_pago_id option:selected").val();


            if (tipo_pago == 3) {

                var otheramount = parseFloat($("#otheramount").val());
                var temp = parseFloat($("#temp").val());                
                var temp_driver = parseFloat($("#temp_driver").val());
                var temp_prepaid = parseFloat($("#temp_prepaid").val());
                var paid_driver = parseFloat($("#paid_driver").val());                
                var pay_amount = parseFloat($("#pay_amount").val());
                
                if (pay_amount == 0 && paid_driver == 0 && otheramount == 0) {
                
                var result = parseFloat(total_total) + parseFloat(temp_driver) +  parseFloat(temp_prepaid);
                var totalbalance = ((result) - (paid_driver)) - (pay_amount);                    

                if (totalbalance < 0) {

                        var tembalance = 0;
                        $("#saldoactual").val((tembalance).toFixed(2));
                        $("#balance_due").val((tembalance).toFixed(2));
                        $("#totalAmount").val((result).toFixed(2));                        
                        $("#agency_balance_due").val((((result) - (paid_driver)) - (pay_amount)).toFixed(2));

                    } else {
                        
                        var temp = parseFloat($("#temp").val());
                        var temp_driver = parseFloat($("#temp_driver").val());
                        var temp_prepaid = parseFloat($("#temp_prepaid").val());
                        var paid_driver = parseFloat($("#paid_driver").val());
                        var pay_amount = parseFloat($("#pay_amount").val()); 
                        var op_pag_conduct = parseFloat($("#selectcond").val());
                        var saldoporpagar = parseFloat(total_total) +  parseFloat(temp_driver)+ parseFloat(temp_prepaid);
                        var result = parseFloat(total_total) + parseFloat(temp);
                        var bd = parseFloat(result) - parseFloat(paid_driver);  
                        
                                        
                      
                        $("#saldoactual").val((saldoporpagar).toFixed(2));
                        $("#balance_due").val((bd).toFixed(2));
                        $("#totalAmount").val((result).toFixed(2));                       
                        $("#agency_balance_due").val((((result) - (paid_driver)) - (pay_amount)).toFixed(2));
                        
                        if(op_pag_conduct == "3"){
                        
                            setTimeout(function () {                               

                                          var balance = parseFloat($("#balance_due").val());
                                          var porcbal = balance*0.04;
                                          var tot_balance = parseFloat(balance) + parseFloat(porcbal);          

                                          $("#balance_due").val((tot_balance).toFixed(2));
                                                                         

                            }, 0.01);
                        
                        }
                       
                    }
                   
                }
                
                if (pay_amount == 0 && paid_driver > 0 && otheramount == 0) {
                    
                    var temp = parseFloat($("#temp").val());
                    var temp_driver = parseFloat($("#temp_driver").val());                  
                    var pay_amount = parseFloat($("#pay_amount").val());
                    var paid_driver = parseFloat($("#paid_driver").val());
                    var op_pag_conduct = parseFloat($("#selectcond").val());
                    var saldoporpagar = parseFloat(total_total) +  parseFloat(temp_driver);
                    var result = parseFloat(total_total) + parseFloat(temp_driver);
                    var bd = parseFloat(saldoporpagar) - parseFloat(paid_driver);  
                    var agbd = (result - paid_driver).toFixed(2); 
                    var total = parseFloat(agbd) - parseFloat(pay_amount);
                    
                    $("#saldoactual").val((saldoporpagar).toFixed(2));
                    $("#balance_due").val((bd).toFixed(2));
                    $("#totalAmount").val((result).toFixed(2));               
                    $("#agency_balance_due").val((total).toFixed(2));
                    
                    if(op_pag_conduct == "3"){
                        
                            setTimeout(function () {                               

                                          var balance = parseFloat($("#balance_due").val());
                                          var porcbal = balance*0.04;
                                          var tot_balance = parseFloat(balance) + parseFloat(porcbal);          
                                          $("#balance_due").val((tot_balance).toFixed(2));
                                          
                            }, 0.01);
                        
                    }

                   
                }


                if (pay_amount > 0 && paid_driver == 0 && otheramount == 0) {

                    var pay_amount = parseFloat($("#pay_amount").val());
                    var paid_driver = parseFloat($("#paid_driver").val());
                    var temp = parseFloat($("#temp").val());
                    var temp_prepaid = parseFloat($("#temp_prepaid").val());
                    var totalbalance = ((total_total + temp_prepaid) - (paid_driver)) - (pay_amount);                    
                    var result = parseFloat(total_total) + parseFloat(temp_prepaid);
                    

                    if (totalbalance < 0) {

                        var tembalance = 0;
                        $("#saldoactual").val((tembalance).toFixed(2));
                        $("#balance_due").val((tembalance).toFixed(2));
                        $("#totalAmount").val((result).toFixed(2));
                        $("#agency_balance_due").val((((result) - (paid_driver)) - (pay_amount)).toFixed(2));

                    } else {
                        
                        var pay_amount = parseFloat($("#pay_amount").val());                        
                        var paid_driver = parseFloat($("#paid_driver").val());                        
                        var temp = parseFloat($("#temp").val());
                        var temp_prepaid = parseFloat($("#temp_prepaid").val());                          
                        var op_pag_conduct = parseFloat($("#selectcond").val());                        
                        var result = parseFloat(total_total) + parseFloat(temp_prepaid);
                        //var total = parseFloat(apagar) + parseFloat(temp);
                        
                        $("#saldoactual").val((result).toFixed(2));
                        $("#balance_due").val((((result) - (paid_driver)) - (pay_amount)).toFixed(2));
                        $("#totalAmount").val((result).toFixed(2));                                            
                        $("#agency_balance_due").val((((result) - (paid_driver)) - (pay_amount)).toFixed(2));
                        
                        if(op_pag_conduct == "3"){
                        
                            setTimeout(function () {                               

                                          var balance = parseFloat($("#balance_due").val());
                                          var porcbal = balance*0.04;
                                          var tot_balance = parseFloat(balance) + parseFloat(porcbal);          

                                          $("#balance_due").val((tot_balance).toFixed(2));
                                                                       

                            }, 0.01);
                        
                        }
                        
                    }                                     
                                 
                }
                
                if(pay_amount > 0 && paid_driver > 0 && otheramount == 0){

                    var temp = parseFloat($("#temp").val());
                    var temp_driver = parseFloat($("#temp_driver").val());
                    var temp_prepaid = parseFloat($("#temp_prepaid").val());                      
                    var pay_amount = parseFloat($("#pay_amount").val());                        
                    var paid_driver = parseFloat($("#paid_driver").val());
                    var op_pag_conduct = parseFloat($("#selectcond").val());                   
                    
                    var result = parseFloat(total_total) + parseFloat(temp_driver) + parseFloat(temp_prepaid);                  
//                    var tot_amount = parseFloat(paid_driver) + parseFloat(pay_amount);
                    var agbd = (result - paid_driver).toFixed(2);                   
                    var total = parseFloat(agbd) - parseFloat(pay_amount);
                    
                   
                    $("#saldoactual").val((result).toFixed(2));
                    $("#balance_due").val((((result) - (paid_driver)) - (pay_amount)).toFixed(2));
                    $("#totalAmount").val((result).toFixed(2));                        
                    $("#agency_balance_due").val((total).toFixed(2));
                    
                    if(op_pag_conduct == "3"){
                        
                        setTimeout(function () {                               

                                          var balance = parseFloat($("#balance_due").val());
                                          var porcbal = balance*0.04;
                                          var tot_balance = parseFloat(balance) + parseFloat(porcbal);      
                                          $("#balance_due").val((tot_balance).toFixed(2));
                                          
                        }, 0.01);
                        
                    }                   
                    
                    
                
                }
                
                
                var otheramount = parseFloat($("#otheramount").val());
                
                if (otheramount > 0 && pay_amount == 0 && paid_driver == 0) {
                
                    var op_pag_conduct = parseFloat($("#selectcond").val());
                    var pay_amount = parseFloat($("#pay_amount").val());
                    var temp = parseFloat($("#temp").val());
                    var temp_driver = parseFloat($("#temp_driver").val());
                    var temp_prepaid = parseFloat($("#temp_prepaid").val());
                    var apagar_2 = parseFloat(otheramount);
                    
                    var result = parseFloat(apagar_2) + parseFloat(temp_driver);
                    var balance = parseFloat(result) - parseFloat(paid_driver);                    
                    var resultado = parseFloat(total_total) + parseFloat(temp_driver) + parseFloat(temp_prepaid);
                    
                                
                    if(op_pag_conduct == "3")  { 
                    
                        $("#saldoactual").val((result).toFixed(2));                 
                        $("#balance_due").val((balance).toFixed(2));
                        $("#totalAmount").val((resultado).toFixed(2));
                        $("#agency_balance_due").val((((resultado) - (paid_driver)) - (pay_amount)).toFixed(2));
                        
                        setTimeout(function () {                               

                                      var balanceo = parseFloat($("#balance_due").val());
                                      var porcbal = balanceo*0.04;
                                      var tot_balance = parseFloat(balanceo) + parseFloat(porcbal);          

                                      $("#balance_due").val((tot_balance).toFixed(2));                                                                 

                        }, 0.01);
                        
                      
                    }else{    
                        $("#saldoactual").val((result).toFixed(2));                 
                        $("#balance_due").val((balance).toFixed(2));
                        $("#totalAmount").val((resultado).toFixed(2));                        
                        $("#agency_balance_due").val((((resultado) - (paid_driver)) - (pay_amount)).toFixed(2));
                    }
                    

                   
                }
                
                if (otheramount > 0 && paid_driver == 0 && pay_amount > 0) {

                    var temp = parseFloat($("#temp").val());
                    var temp_driver = parseFloat($("#temp_driver").val());                                  
                    var temp_prepaid = parseFloat($("#temp_prepaid").val());                    
                    var op_pag_conduct = parseFloat($("#selectcond").val());                                       
                    var apagar_2 = parseFloat(otheramount);
                    var result = parseFloat(apagar_2) +  parseFloat(temp_driver);
                    var apagar1 = parseFloat(total_total)
                    //+ parseFloat(extra) - parseFloat(desc_porc) - parseFloat(desc_valor);
//                    var result1 = parseFloat(apagar1) + parseFloat(temp_prepaid);
                    var resultado = parseFloat(apagar1) + parseFloat(temp_driver) + parseFloat(temp_prepaid);
                    var bd = parseFloat(result) - parseFloat(paid_driver); 
                    
                    if(op_pag_conduct == "3")  { 
                       
                       
                        $("#saldoactual").val((result).toFixed(2));                 
                        $("#balance_due").val((bd).toFixed(2));
                        $("#totalAmount").val((resultado).toFixed(2));                       
                        $("#agency_balance_due").val((((resultado) - (paid_driver)) - (pay_amount)).toFixed(2));
                        
                       setTimeout(function () {                               
                                  
                                  var balanceo = parseFloat($("#balance_due").val());
                                  var porcbal = balanceo*0.04;
                                  var tot_balance = parseFloat(balanceo) + parseFloat(porcbal);        
                                  $("#balance_due").val((tot_balance).toFixed(2));
                                                                  
                                 
                        }, 0.01);
                        
                        
                     
                   }else{    
                    
                        $("#saldoactual").val((result).toFixed(2));
                        $("#balance_due").val((bd).toFixed(2));
                        $("#totalAmount").val((resultado).toFixed(2));                       
                        $("#agency_balance_due").val((((resultado) - (paid_driver)) - (pay_amount)).toFixed(2));
                        
                       
                    }
                    

                
                }
                
                
                var otheramount = parseFloat($("#otheramount").val());

                if(otheramount > 0 && paid_driver > 0 && pay_amount == 0){                        
                                       
                    var temp = parseFloat($("#temp").val());                    
                    var temp_driver = parseFloat($("#temp_driver").val());                   
                    var temp_prepaid = parseFloat($("#temp_prepaid").val());                     
                    var op_pag_conduct = parseFloat($("#selectcond").val());
                    var apagar_2 = parseFloat(otheramount);
                    var result = parseFloat(apagar_2) + parseFloat(temp_driver);                   
                    var resultado = parseFloat(total_total) + parseFloat(temp_prepaid) + parseFloat(temp_driver) ;                    
                    var bd = parseFloat(result) - parseFloat(paid_driver);  
                    
                    if(op_pag_conduct == "3"){ 
                        
                        $("#saldoactual").val((result).toFixed(2));                 
                        $("#balance_due").val((bd).toFixed(2));
                        $("#totalAmount").val((resultado).toFixed(2));                       
                        $("#agency_balance_due").val((((resultado) - (paid_driver)) - (pay_amount)).toFixed(2));
                        
                        setTimeout(function () {                               
                                  
                                  var balance = parseFloat($("#balance_due").val());
                                  var porcbal = balance*0.04;
                                  var tot_balance = parseFloat(balance) + parseFloat(porcbal);          

                                  $("#balance_due").val((tot_balance).toFixed(2));                                                                   
                                 
                        }, 0.01);
                        
                        
                        
                    }else{    
                       
                        $("#saldoactual").val((result).toFixed(2));
                        $("#balance_due").val((bd).toFixed(2));                       
                        $("#totalAmount").val((resultado).toFixed(2));                       
                        $("#agency_balance_due").val((((resultado) - (paid_driver)) - (pay_amount)).toFixed(2));
                    }
                    
                    
                }
                
                
                if (otheramount > 0 && paid_driver > 0 && pay_amount > 0) {

                    var temp = parseFloat($("#temp").val());
                    var temp_driver = parseFloat($("#temp_driver").val());                    
                    var temp_prepaid = parseFloat($("#temp_prepaid").val());                    
                    var op_pag_conduct = parseFloat($("#selectcond").val());                           
                    var apagar_2 = parseFloat(otheramount);
                    var pay_amount = parseFloat($("#pay_amount").val());
                    var result = parseFloat(apagar_2) + parseFloat(temp_driver);                      
                    var resultado = parseFloat(total_total) + parseFloat(temp_prepaid) + parseFloat(temp_driver);                                       
                    var bd = parseFloat(result) - parseFloat(paid_driver);                                       
                    var totalbalance = parseFloat(result) - parseFloat(paid_driver);    
                    
                    var agbd = (resultado - paid_driver).toFixed(2);                   
                    var total = parseFloat(agbd) - parseFloat(pay_amount);

                    
                                        
                        if (totalbalance < 0) {

                            alert('Pago excedido');                   
                           
//                          $("#saldoporpagar").val((bal).toFixed(2));
//                          $("#paid_driver").val((bal).toFixed(2));
                            $("#balance_due").val(((result) - (paid_driver)).toFixed(2));
                            $("#totalAmount").text((resultado).toFixed(2));               
                            $("#agency_balance_due").val((((resultado) - (paid_driver)) - (pay_amount)).toFixed(2));

                        }

                        if (totalbalance >= 0){
                            
                            if(op_pag_conduct == "3")  { 
                                
                                
                                $("#saldoactual").val((result).toFixed(2));                 
                                $("#balance_due").val((bd).toFixed(2));                                
                                $("#totalAmount").val((resultado).toFixed(2)); 
                                $("#agency_balance_due").val((total).toFixed(2));
                                setTimeout(function () {                               
                                  
                                  var balanceo = parseFloat($("#balance_due").val());
                                  var porcbal = balanceo*0.04;
                                  var tot_balance = parseFloat(balanceo) + parseFloat(porcbal);          

                                  $("#balance_due").val((tot_balance).toFixed(2));
                                                              
                                 
                                }, 0.01);
                                
                                
                               
                                

                            }else{    

                                $("#saldoactual").val((result).toFixed(2));
                                $("#balance_due").val((bd).toFixed(2));
                                $("#totalAmount").val((resultado).toFixed(2));                       
                                $("#agency_balance_due").val((total).toFixed(2));
                            }
                        }
                    
       
                
                }             

                document.getElementById('op_pago_id1').value = 0;

            }


            if (tipo_pago == 1) {

                if (parseFloat(total_total) > 0) {
                    fee = total_total * 0.04;
                } else {
                    fee = total_initial * 0.04;
                }
                total_initial += fee;
                total_total += fee;
            }



            //agregando comision
            if (parseFloat($("#rastrocom").val()) > 0) {
                total_total += parseFloat($("#rastrocom").val());
            }
            $("#total_first").val(total_initial);
            $("#total_total").val(total_total);
//            $("#totalAmount").html(total_initial.toFixed(2));
            
        
            //$("#totalAmount").val((total_initial).toFixed(2));


            var pay_amount = parseFloat($("#pay_amount").val());
            if (isNaN(pay_amount)) {
                pay_amount = 0
            }
            var saldoac = total_total - pay_amount;
            if ($("input[name='opcion_saldo']:checked").val() == "1") {
                //$("#saldoporpagar").html("$ " + parseFloat($("#total_total").val()).toFixed(2));
                $("#saldoporpagar").val(parseFloat($("#total_total").val()).toFixed(2));

//                $("#saldoactual").html((saldoac).toFixed(2));


            } else {
                //$("#saldoporpagar").html("$ " + (parseFloat($("#total_total").val()) - parseFloat($("#rastrocom").val())).toFixed(2));
                $("#saldoporpagar").val((parseFloat($("#total_total").val()) - parseFloat($("#rastrocom").val())).toFixed(2));

//                $("#agency_balance_due").val(((total_total) - (paid_driver) - (pay_amount)).toFixed(2));
            }

            //CREDIT CARD NO FEE
            
            if (tipo_pago == 8) {
                
                if (pay_amount == 0 && paid_driver == 0 && otheramount == 0) {
                    
                    var op_pag_conduct = parseFloat($("#selectcond").val());                    
                    var temp = parseFloat($("#temp").val());
                    var paid_driver = parseFloat($("#paid_driver").val());
                    var pay_amount = parseFloat($("#pay_amount").val());
                    var result = parseFloat(total_total) + parseFloat(temp);                   
                    
                    
                    $("#saldoactual").val((result).toFixed(2));
                    $("#balance_due").val((((result) - (paid_driver))- (pay_amount)).toFixed(2));
                    $("#totalAmount").val((total_total).toFixed(2));
                    $("#agency_balance_due").val((((total_total) - (paid_driver)) - (pay_amount)).toFixed(2));
                    
                    if(op_pag_conduct == "3"){
                        
                        setTimeout(function () {                               

                                      var balance = parseFloat($("#balance_due").val());
                                      var porcbal = balance*0.04;
                                      var tot_balance = parseFloat(balance) + parseFloat(porcbal);          

                                      $("#balance_due").val((tot_balance).toFixed(2));
                                                                    

                        }, 0.01);
                        
                    }
                }


                ////
               
                if (pay_amount == 0 && paid_driver > 0 && otheramount == 0) {
                    
                    
                    var temp = parseFloat($("#temp").val());
                    var temp_driver = parseFloat($("#temp_driver").val());
                    var temp_prepaid = parseFloat($("#temp_prepaid").val());                 
                               
                    var op_pag_conduct = parseFloat($("#selectcond").val());
                    var result = parseFloat(total_total) + parseFloat(temp_driver) + parseFloat(temp_prepaid);
                    
                    var agbd = (result - paid_driver).toFixed(2);                   
                    var total = parseFloat(agbd) - parseFloat(pay_amount);
                    
                    $("#saldoactual").val((result).toFixed(2));
                    $("#balance_due").val((((result) - (paid_driver)) - (pay_amount)).toFixed(2));
                    $("#totalAmount").val((result).toFixed(2));
                    $("#agency_balance_due").val((total).toFixed(2));

                    
                    if(op_pag_conduct == "3"){
                        
                                                
                        setTimeout(function () {                               

                                      var balance = parseFloat($("#balance_due").val());
                                      var porcbal = balance*0.04;
                                      var tot_balance = parseFloat(balance) + parseFloat(porcbal);          

                                      $("#balance_due").val((tot_balance).toFixed(2));
//                                      $("#bal_duep").val((tot_balance).toFixed(2));                                  

                            }, 0.01);
                        
                    } 
                        
                
                }
                
               
               
                ////

                if (pay_amount > 0 && paid_driver == 0 && otheramount == 0) {
                    
                    
                    var temp = parseFloat($("#temp").val());
                    var temp_driver = parseFloat($("#temp_driver").val());
                    var temp_prepaid = parseFloat($("#temp_prepaid").val());  
                    var op_pag_conduct = parseFloat($("#selectcond").val());                    
                    var result = parseFloat(total_total) + parseFloat(temp_prepaid);                      
                    var balance_due = parseFloat($("#balance_due").val());
                    var pay_amount = parseFloat($("#pay_amount").val());                                   
                    
                    var totalbalance = ((result) - (paid_driver)) - (pay_amount);
                    var agbd = (result - paid_driver).toFixed(2);                   
                    var total = parseFloat(agbd) - parseFloat(pay_amount);    
                   
                    
                    if (totalbalance < 0) {

                        var tembalance = 0;
                        $("#saldoactual").val((tembalance).toFixed(2));
                        $("#balance_due").val((tembalance).toFixed(2));
                        $("#totalAmount").val((result).toFixed(2));                      
                        $("#agency_balance_due").val((total).toFixed(2));

                    } else {
                                                                        
                        $("#saldoactual").val((result).toFixed(2));
                        $("#balance_due").val((((result) - (paid_driver)) - (pay_amount)).toFixed(2));
                        $("#totalAmount").val((result).toFixed(2));                     
                        $("#agency_balance_due").val((total).toFixed(2));
                        
                        if(op_pag_conduct == "3"){
                        
                        setTimeout(function () {                               

                                      var balance = parseFloat($("#balance_due").val());
                                      var porcbal = balance*0.04;
                                      var tot_balance = parseFloat(balance) + parseFloat(porcbal);          

                                      $("#balance_due").val((tot_balance).toFixed(2));
                                                                       

                            }, 0.01);
                        
                        }
                        

                    }
                    


                }
                
                if (pay_amount > 0 && paid_driver > 0 && otheramount == 0) {


                    var temp = parseFloat($("#temp").val());
                    var temp_driver = parseFloat($("#temp_driver").val());
                    var temp_prepaid = parseFloat($("#temp_prepaid").val());                   
                    var result = parseFloat(total_total) + parseFloat(temp_driver) + parseFloat(temp_prepaid);                    
                    var op_pag_conduct = parseFloat($("#selectcond").val());
                    var agbd = (result - paid_driver).toFixed(2);                   
                    var total = parseFloat(agbd) - parseFloat(pay_amount);

                    $("#saldoactual").val((result).toFixed(2));
                    $("#balance_due").val((((result) - (paid_driver)) - (pay_amount)).toFixed(2));
                    $("#totalAmount").val((result).toFixed(2));                    
                    $("#agency_balance_due").val((total).toFixed(2));
                    
                    if(op_pag_conduct == "3"){
                        
                        setTimeout(function () {                               

                                      var balance = parseFloat($("#balance_due").val());
                                      var porcbal = balance*0.04;
                                      var tot_balance = parseFloat(balance) + parseFloat(porcbal);          

                                      $("#balance_due").val((tot_balance).toFixed(2));
                                      
                            }, 0.01);
                        
                    }

                }
                
                
                var otheramount = parseFloat($("#otheramount").val());
                
                if (otheramount > 0 && paid_driver == 0 && pay_amount == 0) {
                    
                                        
                    var temp = parseFloat($("#temp").val());
                    var temp_driver = parseFloat($("#temp_driver").val());                                     
                    var temp_prepaid = parseFloat($("#temp_prepaid").val());                     
                    var op_pag_conduct = parseFloat($("#selectcond").val());                
                    var apagar_2 = parseFloat(otheramount);
                    var result = parseFloat(apagar_2) + parseFloat(temp_driver);
                    var bd = parseFloat(result) - parseFloat(paid_driver);                      
                    var res_total = parseFloat(total_total) + parseFloat(temp_driver) + parseFloat(temp_prepaid);
                    
                    
                    
                    if(op_pag_conduct == "3")  {
                        
                        
                        $("#saldoactual").val((result).toFixed(2));
                        $("#balance_due").val((bd).toFixed(2));
                        $("#totalAmount").val((res_total).toFixed(2));                       
                        $("#agency_balance_due").val((((res_total) - (paid_driver)) - (pay_amount)).toFixed(2));
                        
                        
                       setTimeout(function () {                               
                                
                                var balance = parseFloat($("#balance_due").val());
                                var porcbal = balance*0.04;
                                var tot_balance = parseFloat(balance) + parseFloat(porcbal);    
                                
                                $("#balance_due").val((tot_balance).toFixed(2));                                                     
                                
                       }, 0.01);

                       
                       
                    }else{
                   
                        $("#saldoactual").val((result).toFixed(2));
                        $("#balance_due").val((bd).toFixed(2));
                        $("#totalAmount").val((res_total).toFixed(2));                       
                        $("#agency_balance_due").val((((res_total) - (paid_driver)) - (pay_amount)).toFixed(2));
                        
                        
                    }
                    
                  
                    

                }

                if (otheramount > 0 && paid_driver == 0 && pay_amount > 0) {

                   
                    var pay_amount = parseFloat($("#pay_amount").val());
                    var temp = parseFloat($("#temp").val());
                    var temp_driver = parseFloat($("#temp_driver").val());                           
                    var temp_prepaid = parseFloat($("#temp_prepaid").val());                    
                    var op_pag_conduct = parseFloat($("#selectcond").val());                    
                    var apagar_2 = parseFloat(otheramount);                    
                    var result = parseFloat(apagar_2) + parseFloat(temp_driver);                     
                    var res_total = parseFloat(total_total) + parseFloat(temp_driver) + parseFloat(temp_prepaid);                   
                    var bd = parseFloat(result) - parseFloat(paid_driver);   
                    var agbd = (res_total - paid_driver).toFixed(2);                   
                    var total = parseFloat(agbd) - parseFloat(pay_amount);
                    
                    if(op_pag_conduct == "3")  {
                    
                        $("#saldoactual").val((result).toFixed(2));
                        $("#balance_due").val((bd).toFixed(2));
                        $("#totalAmount").val((res_total).toFixed(2));                     
                        $("#agency_balance_due").val((total).toFixed(2));


                        setTimeout(function () {                               
                                  
                                  var balance = parseFloat($("#balance_due").val());
                                  var porcbal = balance*0.04;
                                  var tot_balance = parseFloat(balance) + parseFloat(porcbal);          

                                  $("#balance_due").val((tot_balance).toFixed(2));
                                                          
                                 
                        }, 0.01);
                        
                    }else{
                        
                        $("#saldoactual").val((result).toFixed(2));
                        $("#balance_due").val((bd).toFixed(2));
                        $("#totalAmount").val((res_total).toFixed(2));                      
                        $("#agency_balance_due").val((total).toFixed(2));                        
                        
                        
                    }
                    
                      
                }
                
                
                if (otheramount > 0 && paid_driver > 0 && pay_amount == 0) {


                    var temp = parseFloat($("#temp").val());
                    var temp_driver = parseFloat($("#temp_driver").val());                                   
                    var temp_prepaid = parseFloat($("#temp_prepaid").val());                     
                    var op_pag_conduct = parseFloat($("#selectcond").val());                    
                    var pay_amount = parseFloat($("#pay_amount").val());
                    var paid_driver = $("#paid_driver").val();
                    var apagar_2 = parseFloat(otheramount);
                    var result = parseFloat(apagar_2) + parseFloat(temp_driver); 
                    var res_total = parseFloat(total_total) + parseFloat(temp_driver) + parseFloat(temp_prepaid);                    
                    var bd = parseFloat(result) - parseFloat(paid_driver);  
                    var agbd = (res_total - paid_driver).toFixed(2);                   
                    var total = parseFloat(agbd) - parseFloat(pay_amount);
                    
                    
                    if(op_pag_conduct == "3")  {
                       
                       
                        $("#saldoactual").val((result).toFixed(2));
                        $("#balance_due").val((bd).toFixed(2));
                        $("#totalAmount").val((res_total).toFixed(2));                      
                        $("#agency_balance_due").val((total).toFixed(2));
                        
                        setTimeout(function () {                               
                                  
                                  var balance = parseFloat($("#balance_due").val());
                                  var porcbal = balance*0.04;
                                  var tot_balance = parseFloat(balance) + parseFloat(porcbal);          

                                  $("#balance_due").val((tot_balance).toFixed(2));
                                                               
                                 
                        }, 0.01);
                        
                        
                       
                    }else{
                    
                        $("#saldoactual").val((result).toFixed(2));                    
                        $("#balance_due").val((bd).toFixed(2));
                        $("#totalAmount").text((res_total).toFixed(2));                      
                        $("#agency_balance_due").val((total).toFixed(2));
                        
                    }                   
                   

                }
                
                if (otheramount > 0 && paid_driver > 0 && pay_amount > 0) {

                    
                    var temp = parseFloat($("#temp").val());
                    var temp_driver = parseFloat($("#temp_driver").val());                                     
                    var temp_prepaid = parseFloat($("#temp_prepaid").val());                                                 
                    var op_pag_conduct = parseFloat($("#selectcond").val());                    
                    var pay_amount = parseFloat($("#pay_amount").val());
                    var paid_driver = $("#paid_driver").val();
                    var apagar_2 = parseFloat(otheramount);                    
                    var result = parseFloat(apagar_2) + parseFloat(temp_driver);
                    var res_total = parseFloat(total_total) + parseFloat(temp_driver) + parseFloat(temp_prepaid);  
                    var tot_amount_paid = parseFloat(paid_driver) + parseFloat(pay_amount);
                    var bd = parseFloat(result) - parseFloat(paid_driver); 
                    var agbd = (res_total - paid_driver).toFixed(2);                   
                    var total = parseFloat(agbd) - parseFloat(pay_amount);
                    
                    if (bd < 0) {

                            alert('Pago excedido');                   
                           
//                          $("#saldoactual").val((bal).toFixed(2));
//                          $("#paid_driver").val((bal).toFixed(2));
                            $("#balance_due").val((bd).toFixed(2));
                            $("#totalAmount").val((res_total).toFixed(2));  
                            $("#agency_balance_due").val((total).toFixed(2));

                        }
                        if(bd >= 0) {
                            
                            if(op_pag_conduct == "3")  {
                                
                                
                                $("#saldoactual").val((result).toFixed(2));
                                $("#balance_due").val((bd).toFixed(2));
                                $("#totalAmount").val((res_total).toFixed(2));                             
                                $("#agency_balance_due").val((total).toFixed(2));
        
                                setTimeout(function () {                               
                                  
                                  var balance = parseFloat($("#balance_due").val());
                                  var porcbal = balance*0.04;
                                  var tot_balance = parseFloat(balance) + parseFloat(porcbal);          

                                  $("#balance_due").val((tot_balance).toFixed(2));
                                                              
                                 
                                }, 0.01);
                                

                        
                       
                            }else{
//                                
                                $("#saldoporpagar").val((result).toFixed(2));                    
                                $("#balance_due").val((bd).toFixed(2));
                                $("#totalPagar").text((res_total).toFixed(2));
//                                $("#totaltotal").text((res_total).toFixed(2));
                                //$("#tot_amount_paid").val((tot_amount_paid).toFixed(2));   
//                                $("#agency_balance_due").val((((res_total) - (paid_driver)) - (pay_amount)).toFixed(2));
                                $("#agency_balance_due").val((total).toFixed(2));
                            }

                        }  
                                      
                    
                } 
                
                
            document.getElementById('op_pago_id1').value = 0;                  
  
            }
            
            //CASH
            
            if (tipo_pago == 4) {
                
                var paid_driver = parseFloat($("#paid_driver").val());
                var pay_amount = parseFloat($("#pay_amount").val());                
                var otheramount = parseFloat($("#otheramount").val());
                
                if (pay_amount == 0 && paid_driver == 0 && otheramount == 0) {

                    var temp = parseFloat($("#temp").val());
                    var temp_driver = parseFloat($("#temp_driver").val());                                       
                    var temp_prepaid = parseFloat($("#temp_prepaid").val());                      
                    var op_pag_conduct = parseFloat($("#selectcond").val());
                    var result = parseFloat(total_total) + parseFloat(temp_driver) + parseFloat(temp_prepaid);
                    
                    $("#saldoactual").val((result).toFixed(2));
                    $("#balance_due").val((((result) - (paid_driver)) - (pay_amount)).toFixed(2));
                    $("#totalAmount").val((result).toFixed(2));                 
                    $("#agency_balance_due").val((((result) - (paid_driver)) - (pay_amount)).toFixed(2));
                    
                    if(op_pag_conduct == "3"){
                        
                        setTimeout(function () {                               

                                      var balance = parseFloat($("#balance_due").val());
                                      var porcbal = balance*0.04;
                                      var tot_balance = parseFloat(balance) + parseFloat(porcbal);          

                                      $("#balance_due").val((tot_balance).toFixed(2));
                                                                

                        }, 0.01);
                        
                    }
                  
                   
                   
                }
                
                
                if (pay_amount == 0 && paid_driver > 0 && otheramount == 0) {

                    var temp = parseFloat($("#temp").val());
                    var temp_driver = parseFloat($("#temp_driver").val());                                     
                    var temp_prepaid = parseFloat($("#temp_prepaid").val());                       
                    var op_pag_conduct = parseFloat($("#selectcond").val());
                    var result = parseFloat(total_total) + parseFloat(temp_driver) + parseFloat(temp_prepaid);
                    
                    $("#saldoactual").val((result).toFixed(2));
                    $("#balance_due").val((((result) - (paid_driver)) - (pay_amount)).toFixed(2));
                    $("#totalAmount").val((result).toFixed(2));
                    $("#agency_balance_due").val((((result) - (paid_driver)) - (pay_amount)).toFixed(2));
                    
                    if(op_pag_conduct == "3"){
                        
                        setTimeout(function () {                               

                                      var balance = parseFloat($("#balance_due").val());
                                      var porcbal = balance*0.04;
                                      var tot_balance = parseFloat(balance) + parseFloat(porcbal);          

                                      $("#balance_due").val((tot_balance).toFixed(2));
                                                                     

                            }, 0.01);
                        
                    }                
                   
                   
                }
                
                if (pay_amount > 0 && paid_driver == 0 && otheramount == 0) {
                     
                    var temp = parseFloat($("#temp").val());
                    var temp_driver = parseFloat($("#temp_driver").val());                                
                    var temp_prepaid = parseFloat($("#temp_prepaid").val());                       
                    var op_pag_conduct = parseFloat($("#selectcond").val());
                    var result = parseFloat(total_total) + parseFloat(temp_driver) + parseFloat(temp_prepaid);                 
                    var totalbalance = ((result) - (paid_driver)) - (pay_amount);

                    if (totalbalance < 0) {

                        var tembalance = 0;
                        $("#saldoactual").val((tembalance).toFixed(2));
                        $("#balance_due").val((tembalance).toFixed(2));
                        $("#totalAmount").val((result).toFixed(2));                       
                        $("#agency_balance_due").val((((result) - (paid_driver)) - (pay_amount)).toFixed(2));

                    } else {

                        $("#saldoactual").val((result).toFixed(2));
                        $("#balance_due").val((((result) - (paid_driver)) - (pay_amount)).toFixed(2));
                        $("#totalAmount").val((result).toFixed(2));                        
                        $("#agency_balance_due").val((((result) - (paid_driver)) - (pay_amount)).toFixed(2));
                        
                        if(op_pag_conduct == "3"){
                        
                        setTimeout(function () {                               

                                      var balance = parseFloat($("#balance_due").val());
                                      var porcbal = balance*0.04;
                                      var tot_balance = parseFloat(balance) + parseFloat(porcbal);          

                                      $("#balance_due").val((tot_balance).toFixed(2));
                                                               

                            }, 0.01);
                        
                        }
                        

                    }                   

                }
                
                
                if (pay_amount > 0 && paid_driver > 0 && otheramount == 0) {
                    
                    var temp = parseFloat($("#temp").val());
                    var temp_driver = parseFloat($("#temp_driver").val());                    
                    var temp_prepaid = parseFloat($("#temp_prepaid").val());                                    
                    var result = parseFloat(total_total) + parseFloat(temp_driver) + parseFloat(temp_prepaid);
                    
                    var op_pag_conduct = parseFloat($("#selectcond").val());

                    $("#saldoactual").val((result).toFixed(2));
                    $("#balance_due").val((((result) - (paid_driver)) - (pay_amount)).toFixed(2));
                    $("#totalAmount").val((result).toFixed(2));                   
                    $("#agency_balance_due").val((((result) - (paid_driver)) - (pay_amount)).toFixed(2));
                    
                    if(op_pag_conduct == "3"){
                        
                        setTimeout(function () {                               

                                      var balance = parseFloat($("#balance_due").val());
                                      var porcbal = balance*0.04;
                                      var tot_balance = parseFloat(balance) + parseFloat(porcbal);          

                                      $("#balance_due").val((tot_balance).toFixed(2));
                                                                    

                            }, 0.01);
                        
                    }
                                        
                    
                }              
                               
              
                
                var otheramount = parseFloat($("#otheramount").val());
                
                if (otheramount > 0 && paid_driver == 0 && pay_amount == 0) {
                    
                    var temp = parseFloat($("#temp").val());
                    var temp_driver = parseFloat($("#temp_driver").val());                    
                    var temp_prepaid = parseFloat($("#temp_prepaid").val());                                 
                    var op_pag_conduct = parseFloat($("#selectcond").val());
                    //var other_amount = $("#otheramount").val();
                    var apagar_2 = parseFloat(otheramount);
                    var result = parseFloat(apagar_2) + parseFloat(temp_driver);
                    var bd = parseFloat(result) - parseFloat(paid_driver);   
                    //var apagar1 = parseFloat(apagar) + parseFloat(extra) - parseFloat(desc_porc) - parseFloat(desc_valor);
                    var res_total = parseFloat(total_total) + parseFloat(temp_driver) + parseFloat(temp_prepaid);
                    
                    if(op_pag_conduct == "3")  {
                        
                        
                        $("#saldoactual").val((result).toFixed(2));
                        $("#balance_due").val((bd).toFixed(2));
                        $("#totalAmount").val((res_total).toFixed(2));                        
                        $("#agency_balance_due").val((((res_total) - (paid_driver)) - (pay_amount)).toFixed(2));
                        
                        
                       setTimeout(function () {                               
                                
                                var balance = parseFloat($("#balance_due").val());
                                var porcbal = balance*0.04;
                                var tot_balance = parseFloat(balance) + parseFloat(porcbal);          

                                $("#balance_due").val((tot_balance).toFixed(2));
                                                               
                                
                       }, 0.01);

                       
                       
                    }else{
                   
                        $("#saldoactual").val((result).toFixed(2));
                        $("#balance_due").val((bd).toFixed(2));
                        $("#totalAmount").val((res_total).toFixed(2));                        
                        $("#agency_balance_due").val((((res_total) - (paid_driver)) - (pay_amount)).toFixed(2));
                        
                        
                    }
                    


                }
                
                
            if (otheramount > 0 && paid_driver == 0 && pay_amount > 0) {

                    var pay_amount = parseFloat($("#pay_amount").val());
                    var temp = parseFloat($("#temp").val());
                    var temp_driver = parseFloat($("#temp_driver").val());
                    var temp_prepaid = parseFloat($("#temp_prepaid").val());                               
                    var op_pag_conduct = parseFloat($("#selectcond").val());                    
                    var apagar_2 = parseFloat(otheramount);                    
                    var result = parseFloat(apagar_2) + parseFloat(temp_driver) ;                     
                    var res_total = parseFloat(total_total) + parseFloat(temp_driver) + parseFloat(temp_prepaid);                   
                    var bd = parseFloat(result) - parseFloat(paid_driver);   
                    var agbd = (res_total - paid_driver).toFixed(2);                   
                    var total = parseFloat(agbd) - parseFloat(pay_amount);
                    
                    if(op_pag_conduct == "3")  {
                    
                        $("#saldoactual").val((result).toFixed(2));
                        $("#balance_due").val((bd).toFixed(2));
                        $("#totalAmount").val((res_total).toFixed(2));             
                        $("#agency_balance_due").val((total).toFixed(2));

                        setTimeout(function () {                               
                                  
                                  var balance = parseFloat($("#balance_due").val());
                                  var porcbal = balance*0.04;
                                  var tot_balance = parseFloat(balance) + parseFloat(porcbal);          

                                  $("#balance_due").val((tot_balance).toFixed(2));
                                                                
                                 
                        }, 0.01);
                        
                    }else{
                        
                        $("#saldoactual").val((result).toFixed(2));
                        $("#balance_due").val((bd).toFixed(2));
                        $("#totalAmount").val((res_total).toFixed(2));                        
                        $("#agency_balance_due").val((((res_total) - (paid_driver)) - (pay_amount)).toFixed(2));

                                             
                        
                    }


                    
                }     
                
            if (otheramount > 0 && paid_driver > 0 && pay_amount == 0) {

                    var temp = parseFloat($("#temp").val());
                    var temp_driver = parseFloat($("#temp_driver").val());                    
                    var temp_prepaid = parseFloat($("#temp_prepaid").val());                                
                    var op_pag_conduct = parseFloat($("#selectcond").val());                    
                    var pay_amount = parseFloat($("#pay_amount").val());
                    var paid_driver = $("#paid_driver").val();
                    var apagar_2 = parseFloat(otheramount);
                    var result = parseFloat(apagar_2) + parseFloat(temp_driver); 
                    var res_total = parseFloat(total_total) + parseFloat(temp_driver) + parseFloat(temp_prepaid);                    
                    var bd = parseFloat(result) - parseFloat(paid_driver);    
                    var agbd = (res_total - paid_driver).toFixed(2);                   
                    var total = parseFloat(agbd) - parseFloat(pay_amount);
                    
                    if(op_pag_conduct == "3")  {
                       
                       
                        $("#saldoactual").val((result).toFixed(2));
                        $("#balance_due").val((bd).toFixed(2));
                        $("#totalAmount").val((res_total).toFixed(2));
                        $("#agency_balance_due").val((total).toFixed(2));
                        
                        setTimeout(function () {                               
                                  
                                  var balance = parseFloat($("#balance_due").val());
                                  var porcbal = balance*0.04;
                                  var tot_balance = parseFloat(balance) + parseFloat(porcbal);          

                                  $("#balance_due").val((tot_balance).toFixed(2));
                                                              
                                 
                        }, 0.01);
                        
                        
                       
                    }else{
                    
                        $("#saldoactual").val((result).toFixed(2));                    
                        $("#balance_due").val((bd).toFixed(2));
                        $("#totalAmount").val((res_total).toFixed(2));                        
                        $("#agency_balance_due").val((total).toFixed(2));
                        
                    }
                   
                }
                
                if (otheramount > 0 && paid_driver > 0 && pay_amount > 0) {

                    var temp = parseFloat($("#temp").val());
                    var temp_driver = parseFloat($("#temp_driver").val());                    
                    var temp_prepaid = parseFloat($("#temp_prepaid").val());                                  
                    var op_pag_conduct = parseFloat($("#selectcond").val());                    
                    var pay_amount = parseFloat($("#pay_amount").val());
                    var paid_driver = $("#paid_driver").val();
                    var apagar_2 = parseFloat(otheramount);                    
                    var result = parseFloat(apagar_2) + parseFloat(temp_driver);
                    var res_total = parseFloat(total_total) + parseFloat(temp_driver) + parseFloat(temp_prepaid);  
                    var tot_amount_paid = parseFloat(paid_driver) + parseFloat(pay_amount);
                    var bd = parseFloat(result) - parseFloat(paid_driver);   
                    var agbd = (res_total - paid_driver).toFixed(2);                   
                    var total = parseFloat(agbd) - parseFloat(pay_amount);
                    
                   
                    if (bd < 0) {

                            alert('Pago excedido');                   
                           
//                          $("#saldoporpagar").val((bal).toFixed(2));
//                          $("#paid_driver").val((bal).toFixed(2));
                            $("#balance_due").val((bd).toFixed(2));
                            $("#totalAmount").val((res_total).toFixed(2));
                            $("#agency_balance_due").val((total).toFixed(2));

                        }
                        if(bd >= 0) {
                            
                            if(op_pag_conduct == "3")  {
                                
                                
                                $("#saldoactual").val((result).toFixed(2));
                                $("#balance_due").val((bd).toFixed(2));
                                $("#totalAmount").val((res_total).toFixed(2));                                
                                $("#agency_balance_due").val((total).toFixed(2));
                                
                                setTimeout(function () {                               
                                  
                                  var balance = parseFloat($("#balance_due").val());
                                  var porcbal = balance*0.04;
                                  var tot_balance = parseFloat(balance) + parseFloat(porcbal);          

                                  $("#balance_due").val((tot_balance).toFixed(2));
                                                        
                                 
                                }, 0.01);
                                

                        
                       
                            }else{
//                                
                                $("#saldoactual").val((result).toFixed(2));                    
                                $("#balance_due").val((bd).toFixed(2));
                                $("#totalAmount").val((res_total).toFixed(2));                                
                                $("#agency_balance_due").val((total).toFixed(2));
                            }

                        }
                  
                    }                
                
                
            document.getElementById('op_pago_id1').value = 0;   

                    
            }
            
            //CHECK
            
            if (tipo_pago == 9) {
                
                var temp = parseFloat($("#temp").val());
                var paid_driver = parseFloat($("#paid_driver").val());
                var pay_amount = parseFloat($("#pay_amount").val());
                
                 if (pay_amount == 0 && paid_driver == 0 && otheramount == 0) {

                    var temp = parseFloat($("#temp").val());
                    var temp_driver = parseFloat($("#temp_driver").val());                    
                    var temp_prepaid = parseFloat($("#temp_prepaid").val());                    
                    var op_pag_conduct = parseFloat($("#selectcond").val());
                    var result = parseFloat(total_total) + parseFloat(temp_driver) + parseFloat(temp_prepaid);
                    var agbd = (result - paid_driver).toFixed(2);   
                    var total = parseFloat(agbd) - parseFloat(pay_amount);
                    
                    $("#saldoactual").val((result).toFixed(2));
                    $("#balance_due").val((((result) - (paid_driver)) - (pay_amount)).toFixed(2));
                    $("#totalAmount").val((result).toFixed(2));                   
                    $("#agency_balance_due").val((total).toFixed(2));
                    
                    if(op_pag_conduct == "3"){
                        
                        setTimeout(function () {                               

                                      var balance = parseFloat($("#balance_due").val());
                                      var porcbal = balance*0.04;
                                      var tot_balance = parseFloat(balance) + parseFloat(porcbal);          

                                      $("#balance_due").val((tot_balance).toFixed(2));
                                                                     

                        }, 0.01);
                        
                    }
                    
                }
                
                if (pay_amount == 0 && paid_driver > 0 && otheramount == 0) {

                    var temp = parseFloat($("#temp").val());
                    var temp_driver = parseFloat($("#temp_driver").val());                                       
                    var temp_prepaid = parseFloat($("#temp_prepaid").val());                        
                    var op_pag_conduct = parseFloat($("#selectcond").val());
                    var result = parseFloat(total_total) + parseFloat(temp_driver);
                    
                    $("#saldoactual").val((result).toFixed(2));
                    $("#balance_due").val((((result) - (paid_driver)) - (pay_amount)).toFixed(2));
                    $("#totalAmount").val((result).toFixed(2));                    
                    $("#agency_balance_due").val((((result) - (paid_driver)) - (pay_amount)).toFixed(2));
                    
                    if(op_pag_conduct == "3"){
                        
                        setTimeout(function () {                               

                                      var balance = parseFloat($("#balance_due").val());
                                      var porcbal = balance*0.04;
                                      var tot_balance = parseFloat(balance) + parseFloat(porcbal);          

                                      $("#balance_due").val((tot_balance).toFixed(2));
                                                                    

                            }, 0.01);
                        
                    }
                }
                
                
                if (pay_amount > 0 && paid_driver == 0 && otheramount == 0) {
                    
                    var temp = parseFloat($("#temp").val());
                    var temp_driver = parseFloat($("#temp_driver").val());                                      
                    var temp_prepaid = parseFloat($("#temp_prepaid").val());                      
                    var pay_amount = parseFloat($("#pay_amount").val());
                    var paid_driver = parseFloat($("#paid_driver").val());  
                    var op_pag_conduct = parseFloat($("#selectcond").val());
                    var result = parseFloat(total_total) + parseFloat(temp_prepaid) + parseFloat(temp_driver) ;               
                    var balance = apagar + temp_prepaid + temp_driver;        
                    var totalbalance = ((balance) - (paid_driver)) - (pay_amount);

                    var agbd = (result - paid_driver).toFixed(2);                   
                    var total = parseFloat(agbd) - parseFloat(pay_amount);


                    if (totalbalance < 0) {
                        
                        var tembalance = 0;
                        
                        $("#saldoactual").val((tembalance).toFixed(2));
                        $("#balance_due").val((tembalance).toFixed(2));
                        $("#totalAmount").val((result).toFixed(2));                       
                        $("#agency_balance_due").val((total).toFixed(2));

                    } else {

                        $("#saldoactual").val((result).toFixed(2));
                        $("#balance_due").val((((result) - (paid_driver)) - (pay_amount)).toFixed(2));
                        $("#totalAmount").val((result).toFixed(2));                      
                        $("#agency_balance_due").val((total).toFixed(2));
                        
                        if(op_pag_conduct == "3"){
                        
                            setTimeout(function () {                               

                                      var balance = parseFloat($("#balance_due").val());
                                      var porcbal = balance*0.04;
                                      var tot_balance = parseFloat(balance) + parseFloat(porcbal);          

                                      $("#balance_due").val((tot_balance).toFixed(2));
                                                                      

                            }, 0.01);
                        
                        }

                    }
                    

                }
                
                if (pay_amount > 0 && paid_driver > 0 && otheramount == 0) {
                    
                    var temp = parseFloat($("#temp").val());
                    var temp_driver = parseFloat($("#temp_driver").val());
                    var temp_prepaid = parseFloat($("#temp_prepaid").val());                  
                                  
                    var result = parseFloat(total_total) + parseFloat(temp_driver) + parseFloat(temp_prepaid);
                   
                    var op_pag_conduct = parseFloat($("#selectcond").val());
                    var agbd = (result - paid_driver).toFixed(2);                   
                    var total = parseFloat(agbd) - parseFloat(pay_amount);

                    $("#saldoactual").val((result).toFixed(2));
                    $("#balance_due").val((((result) - (paid_driver)) - (pay_amount)).toFixed(2));
                    $("#totalAmount").val((result).toFixed(2));                    
                    $("#agency_balance_due").val((total).toFixed(2));
                    
                    if(op_pag_conduct == "3"){
                        
                        setTimeout(function () {                               

                                      var balance = parseFloat($("#balance_due").val());
                                      var porcbal = balance*0.04;
                                      var tot_balance = parseFloat(balance) + parseFloat(porcbal);          

                                      $("#balance_due").val((tot_balance).toFixed(2));
                                                                   

                            }, 0.01);
                        
                    }
                        
                }    
                         
                var otheramount = parseFloat($("#otheramount").val());
                
                if (otheramount > 0 && paid_driver == 0 && pay_amount == 0) {

                    var temp = parseFloat($("#temp").val());
                    var temp_driver = parseFloat($("#temp_driver").val());                    
                    var temp_prepaid = parseFloat($("#temp_prepaid").val());                      
                    var op_pag_conduct = parseFloat($("#selectcond").val());
                    //var other_amount = $("#otheramount").val();
                    var apagar_2 = parseFloat(otheramount);
                    var result = parseFloat(apagar_2) + parseFloat(temp_driver);
                    var bd = parseFloat(result) - parseFloat(paid_driver);   
                    //var apagar1 = parseFloat(apagar) + parseFloat(extra) - parseFloat(desc_porc) - parseFloat(desc_valor);
                    var res_total = parseFloat(total_total) + parseFloat(temp_driver) + parseFloat(temp_prepaid);
                    
                    if(op_pag_conduct == "3")  {
                        
                        
                        $("#saldoactual").val((result).toFixed(2));
                        $("#balance_due").val((bd).toFixed(2));
                        $("#totalAmount").val((res_total).toFixed(2));                        
                        $("#agency_balance_due").val((((res_total) - (paid_driver)) - (pay_amount)).toFixed(2));
                        
                        
                       setTimeout(function () {                               
                                
                                var balance = parseFloat($("#balance_due").val());
                                var porcbal = balance*0.04;
                                var tot_balance = parseFloat(balance) + parseFloat(porcbal);          

                                $("#balance_due").val((tot_balance).toFixed(2));
                                                                 
                                
                       }, 0.01);

                       
                       
                    }else{
                   
                        $("#saldoactual").val((result).toFixed(2));
                        $("#balance_due").val((bd).toFixed(2));
                        $("#totalAmount").val((res_total).toFixed(2));                        
                        $("#agency_balance_due").val((((res_total) - (paid_driver)) - (pay_amount)).toFixed(2));
                        
                        
                    }

                    
                }
                
            if (otheramount > 0 && paid_driver == 0 && pay_amount > 0) {

                    var pay_amount = parseFloat($("#pay_amount").val());
                    var temp = parseFloat($("#temp").val());
                    var temp_driver = parseFloat($("#temp_driver").val());                                
                    var temp_prepaid = parseFloat($("#temp_prepaid").val());                       
                    var op_pag_conduct = parseFloat($("#selectcond").val());                    
                    var apagar_2 = parseFloat(otheramount);                    
                    var result = parseFloat(apagar_2) + parseFloat(temp_driver);                     
                    var res_total = parseFloat(total_total) + parseFloat(temp_driver) + parseFloat(temp_prepaid);                   
                    var bd = parseFloat(result) - parseFloat(paid_driver);   
                    var agbd = (res_total - paid_driver).toFixed(2);                   
                    var total = parseFloat(agbd) - parseFloat(pay_amount);
                    
                    if(op_pag_conduct == "3")  {
                    
                        $("#saldoactual").val((result).toFixed(2));
                        $("#balance_due").val((bd).toFixed(2));
                        $("#totalAmount").val((res_total).toFixed(2));                        
                        $("#agency_balance_due").val((total).toFixed(2));


                        setTimeout(function () {                               
                                  
                                  var balance = parseFloat($("#balance_due").val());
                                  var porcbal = balance*0.04;
                                  var tot_balance = parseFloat(balance) + parseFloat(porcbal);          

                                  $("#balance_due").val((tot_balance).toFixed(2));
                                                                
                                 
                        }, 0.01);
                        
                    }else{
                        
                        $("#saldoactual").val((result).toFixed(2));
                        $("#balance_due").val((bd).toFixed(2));
                        $("#totalAmount").val((res_total).toFixed(2));
                        $("#agency_balance_due").val((total).toFixed(2));                       
                                                
                    }
                    
                }   
                
                
                if (otheramount > 0 && paid_driver > 0 && pay_amount == 0) {
                    
                    var temp = parseFloat($("#temp").val());
                    var temp_driver = parseFloat($("#temp_driver").val());                                        
                    var temp_prepaid = parseFloat($("#temp_prepaid").val());                       
                    var op_pag_conduct = parseFloat($("#selectcond").val());                    
                    var pay_amount = parseFloat($("#pay_amount").val());
                    var paid_driver = $("#paid_driver").val();
                    var apagar_2 = parseFloat(otheramount);
                    var result = parseFloat(apagar_2) + parseFloat(temp_driver); 
                    var res_total = parseFloat(total_total) + parseFloat(temp_driver) + parseFloat(temp_prepaid);                    
                    var bd = parseFloat(result) - parseFloat(paid_driver);    
                    var agbd = (res_total - paid_driver).toFixed(2);                   
                    var total = parseFloat(agbd) - parseFloat(pay_amount);

                    
                    if(op_pag_conduct == "3")  {
                       
                       
                        $("#saldoactual").val((result).toFixed(2));
                        $("#balance_due").val((bd).toFixed(2));
                        $("#totalAmount").val((res_total).toFixed(2));                       
                        $("#agency_balance_due").val((total).toFixed(2));
                        
                        setTimeout(function () {                               
                                  
                                  var balance = parseFloat($("#balance_due").val());
                                  var porcbal = balance*0.04;
                                  var tot_balance = parseFloat(balance) + parseFloat(porcbal);          

                                  $("#balance_due").val((tot_balance).toFixed(2));
                                                                    
                                 
                        }, 0.01);
                        
                        
                       
                    }else{
                    
                        $("#saldoactual").val((result).toFixed(2));                    
                        $("#balance_due").val((bd).toFixed(2));
                        $("#totalAmount").val((res_total).toFixed(2));                        
                        $("#agency_balance_due").val((total).toFixed(2));
                        
                    }                   
                                                    
                   
                }
                
                if (otheramount > 0 && paid_driver > 0 && pay_amount > 0) {

                    var temp = parseFloat($("#temp").val());
                    var temp_driver = parseFloat($("#temp_driver").val());                                      
                    var temp_prepaid = parseFloat($("#temp_prepaid").val());                        
                    var op_pag_conduct = parseFloat($("#selectcond").val());                    
                    var pay_amount = parseFloat($("#pay_amount").val());
                    var paid_driver = $("#paid_driver").val();
                    var apagar_2 = parseFloat(otheramount);                    
                    var result = parseFloat(apagar_2) + parseFloat(temp_driver);
                    var res_total = parseFloat(total_total) + parseFloat(temp_driver) + parseFloat(temp_prepaid);  
                    var tot_amount_paid = parseFloat(paid_driver) + parseFloat(pay_amount);
                    var bd = parseFloat(result) - parseFloat(paid_driver); 
                    var agbd = (res_total - paid_driver).toFixed(2);                   
                    var total = parseFloat(agbd) - parseFloat(pay_amount);
                   
                    if (bd < 0) {

                            alert('Pago excedido');                   
                           
//                          $("#saldoactual").val((bal).toFixed(2));
//                          $("#paid_driver").val((bal).toFixed(2));
                            $("#balance_due").val((bd).toFixed(2));
                            $("#totalAmount").val((res_total).toFixed(2));                         
                            $("#agency_balance_due").val((total).toFixed(2));


                        }
                        if(bd >= 0) {
                            
                            if(op_pag_conduct == "3")  {
                                
                                
                                $("#saldoactual").val((result).toFixed(2));
                                $("#balance_due").val((bd).toFixed(2));
                                $("#totalAmount").val((res_total).toFixed(2));                                
                                $("#agency_balance_due").val((total).toFixed(2));

        
                                setTimeout(function () {                               
                                  
                                  var balance = parseFloat($("#balance_due").val());
                                  var porcbal = balance*0.04;
                                  var tot_balance = parseFloat(balance) + parseFloat(porcbal);          

                                  $("#balance_due").val((tot_balance).toFixed(2));
                                                              
                                 
                                }, 0.01);
                                

                        
                       
                            }else{
//                                
                                $("#saldoactual").val((result).toFixed(2));                    
                                $("#balance_due").val((bd).toFixed(2));
                                $("#totalAmount").val((res_total).toFixed(2));                                
                                $("#agency_balance_due").val((total).toFixed(2));

                                
                                }

                         }               

                    
                }                
               
                document.getElementById('op_pago_id1').value = 0;
                

                
                
            }
            
            
            if (tipo_pago == 5) {

                var temp = parseFloat($("#temp").val());  
                var pay_amount = parseFloat($("#pay_amount").val());
                var totalamount = parseFloat($("#totalAmount").val());
                var totale = parseFloat(totalamount) -  parseFloat(pay_amount);
                var cv = 0;

                $("#saldoactual").val((cv).toFixed(2));
                $("#paid_driver").val((cv).toFixed(2));
                $("#balance_due").val((cv).toFixed(2));
                $("#totalAmount").val((total_total).toFixed(2));
                $("#pay_amount").text((cv).toFixed(2));
                $("#agency_balance_due").val((totale).toFixed(2));
                
                if (pay_amount > 0 && paid_driver == 0 && otheramount == 0) {
                    
                   
                    var pay_amount = parseFloat($("#pay_amount").val());
                    var paid_driver = parseFloat($("#paid_driver").val());
                    var temp = parseFloat($("#temp").val());
                    var temp_prepaid = parseFloat($("#temp_prepaid").val());
                    var totalbalance = ((total_total + temp_prepaid) - (paid_driver)) - (pay_amount);                    
                    var result = parseFloat(total_total) + parseFloat(temp_prepaid);
                    var saldoporpagar = parseFloat(total_total) + parseFloat(temp_prepaid);

                    if (totalbalance < 0) {

                        var tembalance = 0;
                        $("#saldoactual").val((tembalance).toFixed(2));
                        $("#paid_driver").val((tembalance).toFixed(2));
                        $("#balance_due").val((tembalance).toFixed(2));
                        $("#totalAmount").val((result).toFixed(2));                       
                        $("#agency_balance_due").val((((result) - (paid_driver)) - (pay_amount)).toFixed(2));

                    } else {
                        
                        var cv = 0;
                        var pay_amount = parseFloat($("#pay_amount").val());                        
                        var paid_driver = parseFloat($("#paid_driver").val());                        
                        var temp = parseFloat($("#temp").val());
                        var temp_prepaid = parseFloat($("#temp_prepaid").val());                          
                        var op_pag_conduct = parseFloat($("#selectcond").val());                        
                        var result = parseFloat(total_total) + parseFloat(temp_prepaid);
                        //var total = parseFloat(apagar) + parseFloat(temp);
                        
                        $("#saldoactual").val((cv).toFixed(2));
                        $("#paid_driver").val((cv).toFixed(2));
                        $("#balance_due").val((cv).toFixed(2));
                        $("#totalAmount").val((result).toFixed(2));                                          
                        $("#agency_balance_due").val((((result) - (paid_driver)) - (pay_amount)).toFixed(2));
                        
                       
                        
                    }

                }


            } else if (tipo_pago == 7) {

               
                var cv = 0;


//                $("#saldoactual").val((cv).toFixed(2));
//                $("#paid_driver").val((cv).toFixed(2));
//                $("#balance_due").val((cv).toFixed(2));
//                $("#totalAmount").val((cv).toFixed(2));
//                $("#pay_amount").val((cv).toFixed(2));
//                $("#agency_balance_due").val((cv).toFixed(2));

            }


        }
        $(function () {
            $("input[name='opcion_saldo']").live('change', function (evt) {
                calcularTotalPago();
            });
            
            $("#add_attraction_list").live('click', function (evt) {
                
                
                if ($("#fecha_salida").val() !== '') {
                    if ($("#id_park").val() !== '') {
                        if ($("#nparks").val() === 1) {
                            alert('You have selected already a park');
                        } else {
                            var child = $('#child').val();
                            var adult = $('#adult').val();
                            if (child === "") {
                                child = 0;
                            }
                            if (adult === "") {
                                adult = 0;
                            }
                            var totalpax = (parseInt(adult) + parseInt(child));
                            var id_park = $("#id_park").val();
                            if (totalpax <= 1 && id_park === '19') {
                                alert('to go to Kennedy space ctr., there must be 2 passengers');
                                return false;
                            }

                            if(totalpax >= 1 && id_park == '12'){
                                                               
                                alert('1 Day to Busch Gardens (Min. 3 Day Tour)');
                                return false;
                                
                            }

                            var id_park = $("#id_park").val();
                            var id_agency = $("#id_agency").val();
                            var child = $("#child").val();
                            var adult = $("#adult").val();
                            var fecha  = $("#fecha_salida").val();
                            var total_pax = parseInt(adult) + parseInt(child);

                            /////////////////////////////////////////////


                            var fecha = $("#fecha_salida").val();                      
                            
                            
                            var url = "<?php echo $data['rootUrl'] ?>onedaytour/" + child + "/" + adult + "/" + id_park + "/" + id_agency + '/' + fecha;
                            $("#park-selected").load(url, function () {
                                var total_p = parseFloat($("#rate_adults").val() * $("#adult").val());
                                var total_c = parseFloat($("#rate_childs").val() * $("#child").val());
                                var total_a_s = parseFloat($("#suplemento_adults").val() * $("#adult").val());
                                var total_c_s = parseFloat($("#suplemento_childs").val() * $("#child").val());
                                var suma_s = parseFloat(total_a_s) + parseFloat(total_c_s);
                                if (isNaN(suma_s)) {
                                    suma_s = 0;
                                }
                                var suma_t = parseFloat(total_p) + parseFloat(total_c);
                                var suma_t_s = parseFloat(total_p) + parseFloat(total_c) + parseFloat(suma_s);

                                var suma_pax = parseFloat(adult) + parseFloat(child);
                                var tkxp_total = parseFloat(suma_t) / parseFloat(suma_pax);
                                var tkxp_total_su = parseFloat(suma_s) / parseFloat(suma_pax);
                                //                $("#park_transport").html('$ '+$("#trpark").val()+'.00');

                                $("#park_transport").html('$ ' + Math.ceil(tkxp_total_su) + '.00');

                                $("#park_admision").html('$ ' + Math.ceil(tkxp_total) + '.00');


                                if ($("#adm_selector").is(':checked')) {
                                    $("#park_admision").html('$ ' + Math.ceil(tkxp_total).toFixed(2));
                                } else {
                                    $("#park_admision").html('$ 0.00');
                                }
                                if (!$("#adm_selector").is(':checked')) {
                                    var val = parseFloat($("#trpark").val());
                                    $("#total_parks").val(isNaN(val) ? 0 : val);
                                } else {
                                    var val = parseFloat($("#trpark").val()) + parseFloat($("#admpark").val());
                                    $("#total_parks").val(isNaN(val) ? 0 : val);
                                }
                            });
                            $("#reserveprices").load(encodeURI('<?php echo $data['rootUrl'] ?>admin/oneday/getcosttransf/' + $("#type_rate").val() + '/' + fecha + '/' + id_agency + '/' + total_pax));
                            $("#categoria_park").val(0);
                            $("#park_name").val('');
                            $("#id_park").val('');
                        }
                    } else {
                        alert('Please select a partk first');
                    }
                } else {
                    alert('Please, first select a date for the tour');
                    $("#fecha_salida").focus();
                }
                calcularTotalPago();
            });
            $("#fecha_salida").change(function () {
                if ($("#from").val() !== 0) {
                    //$("#schedule1").load(encodeURI('<?php echo $data['rootUrl']; ?>tours/onedaytour/1/' + $("#from").val() + '/' + $("#fecha_salida").val() + '/' + $("#adult").val() + '/' + $("#child").val()));
                    // $("#schedule2").load(encodeURI('<?php echo $data['rootUrl']; ?>tours/onedaytour/2/' + $("#to2").val() + '/' + $("#fecha_salida").val() + '/' + ($("#adult").val() + $("#child").val()) + '/'));
                }
            });
            $("#fecha_retorno").change(function () {
                if ($("#from").val() !== 0) {
                   // $("#schedule2").load(encodeURI('<?php echo $data['rootUrl']; ?>tours/onedaytour/2/' + $("#to2").val() + '/' + $("#fecha_retorno").val() + '/' + $("#adult").val() + '/' + $("#child").val()));
                }
            });
            $("#delete_park").live('click', function (evt) {
                $("#park-selected").html('<td></td><td></td><td></td><td></td><td></td><td></td><td></td>');
                $("#nparks").val(0);
                $("#total_parks").val(0);
                $("#total_sumplemento").val(0);
                calcularTotalPago();
            });
            $("#include_ticket").live('click', function () {
                if (!$("#adm_selector").is(":checked")) {
                    console.log("here");
                    $("#adm_selector").attr("checked", true);                    
                    $("#incl_ticket").val(1);
                    $("#include_ticket").attr("src", "<?php echo $data['rootUrl'] ?>global/img/admin/check2.png");
                    var child = $("#child").val();
                    var adult = $("#adult").val();
                    var total_p = parseFloat($("#rate_adults").val() * $("#adult").val());
                    var total_c = parseFloat($("#rate_childs").val() * $("#child").val());
                    var total_a_s = parseFloat($("#suplemento_adults").val() * $("#adult").val());
                    var total_c_s = parseFloat($("#suplemento_childs").val() * $("#child").val());
                    var suma_s = parseFloat(total_a_s) + parseFloat(total_c_s);
                    if (isNaN(suma_s)) {
                        suma_s = 0;
                    }
                    var suma_t = parseFloat(total_p) + parseFloat(total_c);
                    var suma_t_s = parseFloat(total_p) + parseFloat(total_c) + parseFloat(suma_s);

                    var suma_pax = parseFloat(adult) + parseFloat(child);
                    var tkxp_total = parseFloat(suma_t) / parseFloat(suma_pax);
                    var tkxp_total_su = parseFloat(suma_s) / parseFloat(suma_pax);
                    //                         $("#park_transport").html('$ '+$("#trpark").val()+'.00');

                    $("#park_transport").html('$ ' + Math.ceil(tkxp_total_su) + '.00');

                    $("#park_admision").html('$ ' + Math.ceil(tkxp_total) + '.00');
                } else {
                    console.log("here2");
                    $("#adm_selector").attr("checked", false);
                    $("#incl_ticket").val(0);
                    $("#include_ticket").attr("src", "<?php echo $data['rootUrl'] ?>global/img/admin/x02.png");
                    $("#park_admision").html('$ 0.00');
                }
                if (!$("#adm_selector").is(':checked')) {
                    $("#total_parks").val(parseFloat($("#trpark").val()));
                } else {
                    $("#total_parks").val(parseFloat($("#trpark").val()) + parseFloat($("#admpark").val()));
                }
                calcularTotalPago();
            });
            $("#btn-save1").click(function () {
                bPreguntar = false;
                preguntarAntesDeSalir();
                if (valid()) {
                    location.href = "<?php echo $data['rootUrl'] ?>admin/onedaytour/";
                }
            });
            $("#btn-save2").click(function () {
               
                 bPreguntar = false;                
                 preguntarAntesDeSalir();
                 console.log('problema');               
                 if (valid()) {
                     $("#puestosEnUso").load("<?php echo $data['rootUrl']; ?>admin/reservas/ocuparPuestoUsuario/3");
                     $("#content").css("display", "none");                 
                     $("#form1").attr('target', '_parent').submit();
                 }    
                
            });
                    
//            $("#adult, #child").change(function () {
//                
//               if ($("#from").val() != 0) {
//
//
//                    if (z == 1) {
//                        var tres = (parseFloat($("#pricexadult").val()) * parseFloat($("#adult").val()) + parseFloat($("#pricexchild").val()) * parseFloat($("#child").val())) / 2;
//                        priceadults.value = parseFloat($("#pricexadult").val());
//                        pricechilds.value = parseFloat($("#pricexchild").val());
//                        group_park.value = 1;
//                    }
//
//                    if (z == 2) {
//                        var tres = (parseFloat($("#pricexadult1").val()) * parseFloat($("#adult").val()) + parseFloat($("#pricexchild1").val()) * parseFloat($("#child").val())) / 2;
//                        priceadults.value = parseFloat($("#pricexadult1").val());
//                        pricechilds.value = parseFloat($("#pricexchild1").val());
//                        group_park.value = 2;
//                    }
//
//                    if (z == 3) {
//                        var tres = (parseFloat($("#pricexadult2").val()) * parseFloat($("#adult").val()) + parseFloat($("#pricexchild2").val()) * parseFloat($("#child").val())) / 2;
//                        priceadults.value = parseFloat($("#pricexadult2").val());
//                        pricechilds.value = parseFloat($("#pricexchild2").val());
//                        group_park.value = 3;
//                    }
//
//                    var ttres = 0;
//                    if ($("#ext_from1").val() != 0) {
//                        ttres = parseFloat($("#cost_ext1").val()) * (parseFloat($("#child").val()) + parseFloat($("#adult").val()));
//
//                    }
//                    $("#totalreserve").val(tres + ttres);
//                    if (tres != Math.NaN) {
//                        $("#price_transport1pp").html("$" + (tres + ttres).toFixed(2));
//                        $("#price_transport2pp").html("$" + (tres + ttres).toFixed(2));
//
//                    }
//                }
//                if ($("#to2").val() != 0) {
//
//                    if (z == 1) {
//                        var tres = (parseFloat($("#pricexadult").val()) * parseFloat($("#adult").val()) + parseFloat($("#pricexchild").val()) * parseFloat($("#child").val())) / 2;
//                        priceadults.value = parseFloat($("#pricexadult").val());
//                        pricechilds.value = parseFloat($("#pricexchild").val());
//                        group_park.value = 1;
//                    }
//
//                    if (z == 2) {
//                        var tres = (parseFloat($("#pricexadult1").val()) * parseFloat($("#adult").val()) + parseFloat($("#pricexchild1").val()) * parseFloat($("#child").val())) / 2;
//                        priceadults.value = parseFloat($("#pricexadult1").val());
//                        pricechilds.value = parseFloat($("#pricexchild1").val());
//                        group_park.value = 2;
//                    }
//
//                    if (z == 3) {
//                        var tres = (parseFloat($("#pricexadult2").val()) * parseFloat($("#adult").val()) + parseFloat($("#pricexchild2").val()) * parseFloat($("#child").val())) / 2;
//                        priceadults.value = parseFloat($("#pricexadult2").val());
//                        pricechilds.value = parseFloat($("#pricexchild2").val());
//                        group_park.value = 3;
//                    }
//
//                    var ttres = 0;
//
//                    if ($("#ext_to2").val() != 0) {
//                        ttres = parseFloat($("#cost_ext2").val()) * (parseFloat($("#child").val()) + parseFloat($("#adult").val()));
//                    }
//                    $("#totalreserver").val(parseFloat(tres) + parseFloat(ttres));
//                    if (tres != Math.NaN) {
//                        $("#price_transport2pp").html("$" + (tres + ttres).toFixed(2));
//                        $("#price_transport1pp").html("$" + (tres + ttres).toFixed(2));
//
//                    }
//                }
//                if ($("#id_selected_park").length) {
//                    var id_park = $("#id_selected_park").val();
//                    var id_agency = $("#id_agency").val();
//                    var child = $("#child").val();
//                    var adult = $("#adult").val();
//                    var url = "<?php echo $data['rootUrl'] ?>onedaytour/" + child + "/" + adult + "/" + id_park + "/" + id_agency;
//                    //           console.log(url);
//                    $("#park-selected").load(url, function () {
//                        var total_p = parseFloat($("#rate_adults").val() * $("#adult").val());
//                        var total_c = parseFloat($("#rate_childs").val() * $("#child").val());
//                        var total_a_s = parseFloat($("#suplemento_adults").val() * $("#adult").val());
//                        var total_c_s = parseFloat($("#suplemento_childs").val() * $("#child").val());
//                        var suma_s = parseFloat(total_a_s) + parseFloat(total_c_s);
//                        if (isNaN(suma_s)) {
//                            suma_s = 0;
//                        }
//                        var suma_t = parseFloat(total_p) + parseFloat(total_c);
//                        var suma_t_s = parseFloat(total_p) + parseFloat(total_c) + parseFloat(suma_s);
//
//                        var suma_pax = parseFloat(adult) + parseFloat(child);
//                        var tkxp_total = parseFloat(suma_t) / parseFloat(suma_pax);
//                        var tkxp_total_su = parseFloat(suma_s) / parseFloat(suma_pax);
//                        //                $("#park_transport").html('$ '+$("#trpark").val()+'.00');
//
//                        $("#park_transport").html('$ ' + Math.ceil(tkxp_total_su) + '.00');
//
//                        $("#park_admision").html('$ ' + Math.ceil(tkxp_total) + '.00');
//
//                        if (!$("#adm_selector").is(':checked')) {
//                            $("#total_parks").val(parseFloat($("#trpark").val()));
//                        } else {
//                            $("#total_parks").val(parseFloat($("#trpark").val()) + parseFloat($("#admpark").val()));
//                        }
//                        calcularTotalPago();
//                    });
//
//                }
//                calcularTotalPago();
//
//            });
            $("#ext_from1").change(function () {
                if ($(this).val() != 0) {
                    var tres = $("#totalreserve").val();
                    $("#extcost").load('<?php echo $data['rootUrl']; ?>admin/oneday/getcosttransfext/' + $(this).val() + '/1', function () {
                        tres = parseFloat(tres) + parseFloat($("#cost_ext1").val()) * ($("#child").val() + $("#adult").val());
                        if (tres != Math.NaN) {
                            $("#totalreserve").val(tres);
                            $("#price_transport1pp").html("$" + tres.toFixed(2));
                        }
                        calcularTotalPago();
                    });
                }
            });
            $("#ext_to2").change(function () {
                if ($(this).val() != 0) {
                    var tres = $("#totalreserver").val();
                    $("#extcost2").load('<?php echo $data['rootUrl']; ?>admin/oneday/getcosttransfext/' + $(this).val() + '/2', function () {
                        tres = parseFloat(tres) + parseFloat($("#cost_ext2").val()) * ($("#child").val() + $("#adult").val());
                        $("#totalreserver").val(tres);
                        $("#price_transport2pp").html("$" + tres.toFixed(2));
                        calcularTotalPago();
                    });
                }
            });
      
            $("#opcion_pago_predpaid_cash").click(function () {
                $("#btn-save2").show();
                $("#btn-save1").hide();
                $("#enviarF").hide();
                $("#is_cardholder").hide();
                //        $("#pay_amount_html").hide();

            });
            $("#opcion_pago_CrediFee").click(function () {
                $("#btn-save2").show();
                $("#btn-save1").hide();
                $("#enviarF").hide();
                $("#is_cardholder").hide();
                $("#pay_amount_html").show();
            });
            $("#opcion_pago_Cash, #opcion_pago_Voucher").click(function () {
                $("#btn-save2").show();
                $("#btn-save1").hide();
                $("#enviarF").hide();
                $("#is_cardholder").hide();
                //        $("#pay_amount_html").hide();
            });
            $("#opcion_pago_passager").click(function () {
                //        $("#btn-save2").hide();
                //        $("#btn-save1").hide();
                $("#is_cardholder").show();
                $("#enviarF").show();
                $("#pay_amount_html").show();
            });
            
           
            
            $('#descuento').keydown(function (evt) {
                var actual = parseFloat($(this).val());
                var pres = String.fromCharCode(evt.which);
                if (parseFloat(actual + pres) > 100) {
                    evt.preventDefault();
                }
            });
            
            $('#descuento_valor').keydown(function (evt) {
                var actual = parseFloat($(this).val());
                var pres = String.fromCharCode(evt.which);
                var total = parseFloat($("#total_first").val());
                if (parseFloat(actual + pres) > total) {
                    evt.preventDefault();
                }
            });
            

            $("#descuento_valor, #descuento").change(function () {
                calcularTotalPago();
            });
            
            $("#extra").keyup(function () {
                //calcularTotalPago();
            });


        });
        function calcCom() {
//            if (parseFloat($("#comisionable").val()) == 0) {
            if ($("#adm_selector").is(":checked")) {
                var total_p = parseFloat($("#rate_adults").val() * $("#adult").val()) + parseFloat($("#rate_childs").val() * $("#child").val());
            } else {
                var total_p = 0;
            }
            if (isNaN(total_p)) {
                total_p = 0;
            }
            var total_a_s = parseFloat($("#suplemento_adults").val() * $("#adult").val());
            var total_c_s = parseFloat($("#suplemento_childs").val() * $("#child").val());
            var suma_s = parseFloat(total_a_s) + parseFloat(total_c_s);
            if (isNaN(suma_s)) {
                suma_s = 0;
            }
            var total_initial = (parseFloat($("#totalreserve").val()) + parseFloat($("#totalreserver").val()) + parseFloat(total_p) + parseFloat(suma_s));
            //                    alert(total_initial);
            $("#rastrocom").val(0);
//            } else {
//                var total_initial = (((parseFloat($("#totalreserve").val()) + parseFloat($("#totalreserver").val())) * (1.15)) + parseFloat($("#total_parks").val()));
//                $("#rastrocom").val(((parseFloat($("#totalreserve").val()) + parseFloat($("#totalreserver").val())) * (0.15)));
//                $("#valorComision").html('$' + ((parseFloat($("#totalreserve").val()) + parseFloat($("#totalreserver").val())) * (0.15).toFixed(2)));
//            }
            return total_initial;
        }
        function valid() {

            var at_point = false;

            if (parseFloat($("#idCliente").val()) > 0) {
                at_point = true;
            } else {
                if ($("#firstname1").val() != "" && $("#lastname1").val() != "") {
                    at_point = true;
                } else {
                    alert('introduce new a client');
                    $("#cliente").focus();
                    return false;
                }
            }

            //Notas     
            if ($("#comments").val() == "") {
                alert("Please Type One Note");
                $("#comments").focus();
                return false;
            }
            
//             if($("wdwus").getProperty("value") == ""){
//                return true;
//                }else{
//                return false;
//                }
//                
//              if($("wphol").getProperty("value") == ""){
//                return true;
//                }else{
//                return false;
//                }
//                
//              if($("kspc").getProperty("value") == ""){
//                return true;
//                }else{
//                return false;
//                }


            if ($("#fecha_salida").val() !== "" && Validar($("#fecha_salida").val())) {
                at_point = true;
            } else {
                alert('bad departure date');
                $("#fecha_salida").focus();
                return false;
            }
            if ((parseFloat($("#adult").val()) + parseFloat($("#child").val())) > 0) {
                at_point = true;
            } else {
                alert('set how many people is traveling');
                $("#adult").focus();
                return false;
            }
            if (parseFloat($("#from").val()) > 0 && (parseFloat($("#a_id_pickup1").val()) > 0) || parseFloat($("#ext_from1").val()) > 0) {
                at_point = true;
            } else {
                alert("select a valid pickup point");
                $("#a_pickup1").focus();
                return false;
            }
            if (parseFloat($("#to2").val()) > 0 && (parseFloat($("#d_id_pickup1").val()) > 0) || parseFloat($("#ext_to2").val()) > 0) {
                at_point = true;
            } else {
                alert("select a valid dropoff point");
                $("#d_pickup1").focus();
                return false;
            }
            if (parseFloat($("#nparks").val()) > 0) {
                at_point = true;
            } else {
                alert('which park is going to be visited')
                $("#park_name").focus();
                return false;
            }
            if (parseFloat($("#id_agency").val()) < 0) {
//                        if (parseFloat($("#id_auser").val()) < 0) {
                alert(' - Enter data Agency');
                $("#agency").focus();
                return false;
//                        } else {
//                at_point = true;
//            }
            }
            if (parseFloat($("#ext_from1").val()) > 0) {
                if ($("#a_pickup2").val() == "") {
                    alert("You should introduce a valid address");
                    $("#a_pickup2").focus();
                    return false;
                }
            }
            if (!$("#byrm").is(':checked') && !$("#byrp").is(':checked') && !$("#byrw").is(':checked')) {
                alert("select a source of the reserve");
                $("#byrp").focus();
                return false;
            }

//            
            if (!$("#opcion_pago_Cash_2").is(':checked') && !$("#opcion_pago_passager_2").is(':checked') && !$("#opcion_pago_predpaid_check").is(':checked') && !$("#opcion_pago_complementary").is(':checked') && (!$("#opcion_pago_passager").is(':checked') && !$("#opcion_pago_agency").is(':checked') && !$("#opcion_pago_predpaid_cash").is(':checked') && !$("#opcion_pago_CrediFee").is(":checked") && !$("#opcion_pago_Cash").is(':checked') && !$("#opcion_pago_Voucher").is(':checked'))) {
//                alert('Please select a payment option');
//                $("#opcion_pago_passager").focus();
//                return false;
            }
            return at_point;
        }

        

        $(document).ready(function () {

            $("#wdwus").click(function () {
                
                if ($("#wdwus").is(':checked')) {
                    

                    document.getElementById('from').disabled = false;
                    document.getElementById('from').value = '0';
                    document.getElementById('from').style.background = '#FFFFFF';
                    
                    document.getElementById('to2').disabled = false;
                    document.getElementById('to2').value = '0';
                    document.getElementById('to2').style.background = '#FFFFFF';
//                    document.getElementById('to2').disabled = "false";
                    document.getElementById('a_pickup1').value = '';
                    document.getElementById('d_pickup1').value = '';
                    
//                    var fecha_salida = $("#fecha_salida").val();               
                    
                    $("#price_transport1pp").html("$" + "0.00");
                    $("#price_transport2pp").html("$" + "0.00");
//                    $("#totalAmount").html("0.00");
                    $("#totalAmount").val("0.00");
                    $("#saldoporpagar").html("0.00");
//                    $("#saldoactual").html("0.00");
                    $("#saldoactual").val("0.00");
//                 calcularTotalPago();
                    document.getElementById("categoria_park").value = "4";
                    document.getElementById("park_name").disabled = false;
                    document.getElementById('park_name').style.background = '#FFFFFF';
                    document.getElementById("park_name").value = "";
                    $('#delete_park').click();
                    
                    //calcularTotalPago();
                    
                    
//                    $("#schedule1").load(encodeURI('<?php echo $data['rootUrl']; ?>tours/onedaytour/1/' + $("#from").val('') + '/' + $("#fecha_salida").val() + '/' + $("#adult").val() + '/' + $("#child").val()));
//                    $("#schedule2").load(encodeURI('<?php echo $data['rootUrl']; ?>tours/onedaytour/2/' + $("#to2").val('') + '/' + $("#fecha_salida").val() + '/' + $("#adult").val() + '/' + $("#child").val()));
                    //$("#schedule2").load(encodeURI('<?php echo $data['rootUrl']; ?>tours/onedaytour/2/' + $("#to2").val('') + '/' + $("#fecha_retorno").val() + '/' + $("#adult").val() + '/' + $("#child").val()));
                    
                    $("#wdwus").focus();



                }
            });


            $("#wphol").click(function () {
            
                if ($("#wphol").is(':checked')) {

                    document.getElementById('from').disabled = false;
                    document.getElementById('from').value = '0';
                    document.getElementById('from').style.background = '#FFFFFF';
                    
                    document.getElementById('to2').disabled = false;
                    document.getElementById('to2').value = '0';
                    document.getElementById('to2').style.background = '#FFFFFF';
                    document.getElementById('a_pickup1').value = '';
                    document.getElementById('d_pickup1').value = '';
                    $("#price_transport1pp").html("$" + "0.00");
                    $("#price_transport2pp").html("$" + "0.00");
                    $("#totalAmount").val("0.00");
                    $("#saldoporpagar").html("0.00");

                    $("#saldoactual").val("0.00");
//                 calcularTotalPago();    
                    document.getElementById("categoria_park").value = "7";
                    document.getElementById("park_name").disabled = false;
                    document.getElementById('park_name').style.background = '#FFFFFF';
                    document.getElementById("park_name").value = "";
                    $('#delete_park').click();

                    
                    //$("#schedule1").load(encodeURI('<?php echo $data['rootUrl']; ?>tours/onedaytour/1/' + $("#from").val('') + '/' + $("#fecha_salida").val() + '/' + $("#adult").val()+ '/' + $("#child").val()));
                    //$("#schedule2").load(encodeURI('<?php echo $data['rootUrl']; ?>tours/onedaytour/2/' + $("#to2").val('') + '/' + $("#fecha_salida").val() + '/' + $("#adult").val()+ '/' + $("#child").val()));
                    //$("#schedule2").load(encodeURI('<?php echo $data['rootUrl']; ?>tours/onedaytour/2/' + $("#to2").val('') + '/' + $("#fecha_retorno").val() + '/' + $("#adult").val()+ '/' + $("#child").val()));
                    //calcularTotalPago();
                    $("#wphol").focus();             

                }
            });
            
    
             $("#adult, #child").change(function () {
                                       
                    var saldo_actual =  $("#saldoactual").val();
                    
                    if(saldo_actual != "0.00"){         
                            
                    var adultos = $("#adult").val();  
                    var chicos = $("#child").val();           
                    var id = $("#from").val();
                    var total_pax = parseInt(adultos) + parseInt(chicos);
                    var fecha = $("#fecha_salida").val();
                    var id_agencia = $("#id_agency").val(); 
                    
                    
                    document.getElementById("wdwus").checked = false;   
                    document.getElementById("wphol").checked = false; 
                    document.getElementById("kspc").checked = false;              
                    document.getElementById('from').disabled = true;
                    document.getElementById('from').value = "0";
                    document.getElementById('from').style.background = "#CCC";                    
                    document.getElementById('to2').disabled = true;
                    document.getElementById('to2').value = "0";
                    document.getElementById('to2').style.background = "#CCC";
//                    document.getElementById('to2').disabled = "false";

                    document.getElementById('a_pickup1').value = "";
                    document.getElementById('d_pickup1').value = "";
                    
                    $("#totalreserve").val(0);
                    $("#totalreserver").val(0);
//                    $("#pricexadult").val(0);
//                    $("#pricexchild").val(0);
//                    $("#pricexadult1").val(0);
//                    $("#pricexchild1").val(0);
//                    $("#pricexadult2").val(0);
//                    $("#pricexchild2").val(0);
                    
//                    var fecha_salida = $("#fecha_salida").val();               
                    
                    $("#price_transport1pp").html("$" + "0.00");
                    $("#price_transport2pp").html("$" + "0.00");
//                    $("#totalAmount").html("0.00");
                    $("#totalAmount").val("0.00");
                    $("#saldoporpagar").html("0.00");
//                    $("#saldoactual").html("0.00");
                    $("#saldoactual").val("0.00");

                    //document.getElementById("categoria_park").value = "4";
                    document.getElementById("park_name").disabled = false;
                    document.getElementById('park_name').style.background = '#FFFFFF';
                    document.getElementById("park_name").value = "";
                    $('#delete_park').click();
                    $("#adm_selector").attr("checked", false);           
                    $("#park_admision").html('$ 0.00');
                    //$("#total_parks").val(parseFloat($("#trpark").val()) + parseFloat($("#admpark").val()));
                    $("#price_transport1pp").html("$" + "0.00");
                    $("#price_transport2pp").html("$" + "0.00"); 


                    calcularTotalPago();
                    
                    $("#saldoactual").val("0.00");
                    $("#totalAmount").val("0.00");
                    $("#paid_driver").val("0.00");
                    $("#balance_due").val("0.00");
                    $("#pay_amount").val("0.00");
                    $("#agency_balance_due").val("0.00");                   

                    
                    $("#from").val(0);
                    $("#to2").val(0);                    
                    
                                        
                    //setTimeout(function () {
            
                    $("#btn-pax").click();
                    //calcularTotalPago();
                    
                    
                    
//                    document.getElementById('trp301').style.display = 'none';
//                    document.getElementById('trp300').style.display = 'none';
                    
                    //$("#schedule1").load(encodeURI('<?php echo $data['rootUrl']; ?>tours/onedaytour/1/' + $("#from").val('') + '/' + $("#fecha_salida").val() + '/' + adultos + '/' + chicos));
                   //$("#schedule2").load(encodeURI('<?php echo $data['rootUrl']; ?>tours/onedaytour/2/' + $("#to2").val('') + '/' + $("#fecha_salida").val() + '/' + adultos + '/' + chicos));
                  
                    document.getElementById('trp301').style.display = 'none';
                    document.getElementById('trp300').style.display = 'none';
                    //}, 0.01);

                    
                    
                    $("#adult").focus();
                     
                    
                    }
	
              
            });
            


            $("#kspc").click(function () {
            
                if ($("#kspc").is(':checked')) {

                    document.getElementById('from').disabled = false;
                    document.getElementById('from').value = '0';
                    document.getElementById('from').style.background = '#FFFFFF';
                    
                    document.getElementById('to2').disabled = false;
                    document.getElementById('to2').value = '0';
                    document.getElementById('to2').style.background = '#FFFFFF';
                    document.getElementById('a_pickup1').value = '';
                    document.getElementById('d_pickup1').value = '';
                    $("#price_transport1pp").html("$" + "0.00");
                    $("#price_transport2pp").html("$" + "0.00");
//                    $("#totalAmount").html("0.00");
                    $("#totalAmount").val("0.00");
                    $("#saldoporpagar").html("0.00");
//                    $("#saldoactual").html("0.00");
                    $("#saldoactual").val("0.00");
                    document.getElementById("categoria_park").value = "11";
                    document.getElementById("park_name").disabled = false;
                    document.getElementById('park_name').style.background = '#FFFFFF';
                    document.getElementById("park_name").value = "";
                    $('#delete_park').click();


                    
                    
                    //$("#schedule1").load(encodeURI('<?php echo $data['rootUrl']; ?>tours/onedaytour/1/' + $("#from").val('') + '/' + $("#fecha_salida").val() + '/' + $("#adult").val() + '/' + $("#child").val()));
                    //$("#schedule2").load(encodeURI('<?php echo $data['rootUrl']; ?>tours/onedaytour/2/' + $("#to2").val('') + '/' + $("#fecha_salida").val() + '/' + $("#adult").val() + '/' + $("#child").val()));
                    //$("#schedule2").load(encodeURI('<?php echo $data['rootUrl']; ?>tours/onedaytour/2/' + $("#to2").val('') + '/' + $("#fecha_retorno").val() + '/' + $("#adult").val() + '/' + $("#child").val()));
                    //calcularTotalPago();
                    $("#kspc").focus();


                }
            });


        });




        $(function () {
            $("#extra").change(function () {
                //calcularTotalPago();
            });
            $("#otheramount").change(function () {
                calcularTotalPago();
            });
            $(".opcion_pago").click(function () {
                calcularTotalPago();
            });
            $("#icon-back").click(function () {
                $("#mascaraP").hide();
                $("#clienteN").hide();
            });
            $("#opcion_pago_agency").click(function () {
                $("#btn-save2").show();
                $("#btn-save1").show();
                $("#enviarF").show();
                $("#pay_amount_html").show();
            });
            $("#enviarF").click(function () {
                if (valid()) {
                    if ($("input[name='opcion_pago']:checked").val() == 2) { //passenger credit card
                        if ($("#is_user_ch").is(':checked') == true) {
                            //$("#form1").attr('target','_blank').submit();
                            //$("#infodb").load('<?php echo $data['rootUrl']; ?>admin/oneday/is_complete/'+$("#idCliente").val(),function(data){
                            var data = $("#complete").val();
                            console.log(data);
                            if (data == "false") {
                                $("#mascaraP").show();
                                $("#cardholder").attr('checked', false);
                                shownclient();
                                $("#country").focus();
                            } else {
                                console.log('submit1');
                                var hilo = setInterval("estadoPago()", 5000);
                                $("#form1").attr('target', '_blank').submit();
                            }
                            //});
                        } else {
                            $("#mascaraP").show();
                            $("#cardholder").attr('checked', false);
                            $("#clienteN").show();
                            $("#username").focus();
                        }
                    } else if ($("input[name='opcion_pago']:checked").val() == 1) {//agency credit card
                        console.log('submit2');
                        $("#form1").attr('target', '_blank').submit();
                        var hilo = setInterval("estadoPago()", 5000);
                    }
                }
            });
            $("#id_agency").change(function () {
                calcularTotalPago();
            });
            $("#icon-save").click(function () {
                $("#clienteN").hide();
                $("#mascaraP").hide();
                if (valid2()) {
                    console.log('submit3');
                    $("#form1").attr('target', '_blank').submit();
                    var hilo = setInterval("estadoPago()", 5000);
                }
            });
        });
        function shownclient() {
            $("#username").val($("#email1").val());
            $("#firstname").val($("#firstname1").val());
            $("#lastname").val($("#lastname1").val());
            $("#phone").val($("#phone1").val());
            $("#clienteN").show();
        }
        function valid2() {
            if ($("#username").val() == "") {
                alert("A username/email is required");
                return false;
            }
            if ($("#firstname").val() == "") {
                alert("Firstname is a required field");
                return false;
            }
            if ($("#lastname").val() == "") {
                alert("Lastname is a required field");
                return false;
            }
            if ($("#phone").val() == "") {
                alert("Phone is a required field");
                return false;
            }
            if ($("#country").val() == "") {
                alert("Please select a valid country");
                return false;
            }
            if ($("#state").val() == "") {
                alert("Please select a valid state");
                return false;
            }
            if ($("#city").val() == "") {
                alert("City is a required field");
                return false;
            }
            if ($("#address").val() == "") {
                alert("An address is required");
                return false;
            }
            if ($("#zip").val() == "") {
                alert("A zip code is required");
                return false;
            }
            return true;
        }
        function estadoPago() {
            $("#estadoTranssacion").load('<?php echo $data['rootUrl']; ?>transaction/admin/onedaytours/payment');
        }
        $(function () {
            $("#cardholder").click(function () {
                if ($(this).is(':checked')) {
                    $("#username").val($("#email1").val());
                    $("#firstname").val($("#firstname1").val());
                    $("#lastname").val($("#lastname1").val());
                    $("#phone").val($("#phone1").val());
                    $("#country").val(0);
                    $("#state").val(0);
                    $("#city").val('');
                    $("#zip").val('');
                } else {
                    $("#username").val('');
                    $("#firstname").val('');
                    $("#lastname").val('');
                    $("#phone").val('');
                    $("#country").val(0);
                    $("#state").val(0);
                    $("#city").val('');
                    $("#zip").val('');
                }
            });
        });
    </script>
    <script>
        $(function () {
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
        });
    </script>





    <script>

        var z
        function capturar()
        {
            var resultado = "ninguno";

            var porNombre = document.getElementsByName("wdw");
            // Recorremos todos los valores del radio button para encontrar el
            // seleccionado
            for (var i = 0; i < porNombre.length; i++)
            {
                if (porNombre[i].checked)
                    resultado = porNombre[i].value;

            }


            z = document.getElementById("resultado").innerHTML = " \ " + resultado;




        }
    </script>
    
    <script type="text/javascript">

    var rup

    function captura() {
      
//      document.getElementsByName("op_pago_conductor").value = "8";
        
      var result = document.getElementsByName("op_pago_conductor")[0].value;


      rup = document.getElementById("result").innerHTML = " \ " + result; 
      
      $("#selectcond").val(result);  
      

    }

    </script>
    
    


    <script>
        function habilitar(value)
        {
            if (value == "1")
            {
                // Habilitamos el grupo de parques de WDW/UNIVERSAL/SEAWORLD

                document.getElementById("categoria_park")[0].style.display = 'block';
                document.getElementById("categoria_park")[1].style.display = 'block';
                document.getElementById("categoria_park")[2].style.display = 'block';
                document.getElementById("categoria_park")[3].style.display = 'none';
                document.getElementById("categoria_park")[4].style.display = 'none';
                document.getElementById("categoria_park")[5].style.display = 'none';
                document.getElementById("categoria_park")[6].style.display = 'none';

            }

            if (value == "2")
            {
                // Habilitamos el grupo de parques de WATER PARKS & HOLY LAND

                document.getElementById("categoria_park")[0].style.display = 'none';
                document.getElementById("categoria_park")[1].style.display = 'none';
                document.getElementById("categoria_park")[2].style.display = 'none';
                document.getElementById("categoria_park")[3].style.display = 'block';
                document.getElementById("categoria_park")[4].style.display = 'none';
                document.getElementById("categoria_park")[5].style.display = 'none';
                document.getElementById("categoria_park")[6].style.display = 'block';


            }

            if (value == "3")
            {
                // Habilitamos el grupo de parques de KENNEDY SPACE CENTER

                document.getElementById("categoria_park")[0].style.display = 'none';
                document.getElementById("categoria_park")[1].style.display = 'none';
                document.getElementById("categoria_park")[2].style.display = 'none';
                document.getElementById("categoria_park")[3].style.display = 'none';
                document.getElementById("categoria_park")[4].style.display = 'none';
                document.getElementById("categoria_park")[5].style.display = 'block';
                document.getElementById("categoria_park")[6].style.display = 'none';

            }

//            if (value == "4")
//            {
//                // Habilitamos el grupo de parque FULL DAY SHOPPING TOURS
//
//                document.getElementById("categoria_park")[0].style.display = 'none';
//                document.getElementById("categoria_park")[1].style.display = 'block';
//                document.getElementById("categoria_park")[2].style.display = 'block';
//                document.getElementById("categoria_park")[3].style.display = 'block';
//                document.getElementById("categoria_park")[4].style.display = 'block';
//                document.getElementById("categoria_park")[9].style.display = 'none';
//                document.getElementById("categoria_park")[6].style.display = 'block';
//
//            }


        }




    </script>


    <script type="text/javascript">
        function dupliac()
        {
//      duplicar amount to collect ---- > otheramount
            var dupliam = document.getElementById('saldoactual').value;
            var extra = $("#extra").val();
            var desc_valor = $("#descuento_valor").val();
            var desc_porc = $("#descuento").val();
            var paid_driver = $("#paid_driver").val();
            var apagare1 = apagare;
            //var apagar1 = parseFloat(apagare1) + parseFloat(extra) - parseFloat(desc_porc) - parseFloat(desc_valor);
            var apagar1 = parseFloat(apagare1);
            var balance = parseFloat(apagar1) - parseFloat(paid_driver);
            var duplicado = (parseFloat(dupliam)).toFixed(2);        
            var other = 0;

            document.getElementById('otheramount').value = duplicado;
            document.getElementById('balance_due').value = dupliam;
            document.getElementById('saldoactual').style.background = "#1919e6"; 
            document.getElementById('saldoactual').style.color = "#ffff00"; 
            document.getElementById('saldoactual').title = "Colectando"; 
            document.getElementById('txtamountpendiente').style.color = "#1919e6";  


            if (dupliam == '') {

                setTimeout(function () {

                    //click al boton Balance_Due para hacer el calculo de passenger Balance Due  
                                        
                    $("#saldoactual").val((apagar1).toFixed(2));
                    $("#balance_due").val((balance).toFixed(2));
                    $("#otheramount").val((other).toFixed(2));
                    document.getElementById('saldoactual').className = "verd";
                    document.getElementById('saldoactual').style.background = "#fff"; 
                    document.getElementById('saldoactual').style.color = "#000";
                    document.getElementById('txtamountpendiente').style.color = "#000"; 
                    document.getElementById('saldoactual').title = "";
                    
                    calcularTotalPago();
                    
                }, 100);

            }
            
            if (dupliam == "0") {

            setTimeout(function () {

                //click al boton Balance_Due para hacer el calculo de passenger Balance Due  
                //$('#paid_driver').click();
                
                 $("#saldoactual").val((apagar1).toFixed(2));
                 $("#balance_due").val((balance).toFixed(2));
                 $("#otheramount").val((other).toFixed(2));
                 document.getElementById('saldoactual').className = "verd";
                 document.getElementById('saldoactual').style.background = "#fff"; 
                 document.getElementById('saldoactual').style.color = "#000";
                 document.getElementById('txtamountpendiente').style.color = "#000"; 
                 document.getElementById('saldoactual').title = "";
//                $("#otheramountp").val((other).toFixed(2));
                 calcularTotalPago();

            }, 100);

        }
        
        if (dupliam > 0) {
                                    
                                    
                setTimeout(function () {

                    //click al boton Balance_Due para hacer el calculo de passenger Balance Due 
                    
                    calcularTotalPago();
                    //document.getElementById('op_pago_conductor').value = 8;

                }, 1250);

            }          

        }

    </script>


    <script type="text/javascript">
        function validate(evt) {
            var theEvent = evt || window.event;
            var key = theEvent.keyCode || theEvent.which;
            key = String.fromCharCode(key);
            var regex = /[0-9]|\.|\-/;
            if (!regex.test(key)) {
                theEvent.returnValue = false;
                if (theEvent.preventDefault)
                    theEvent.preventDefault();
            }
        }
    </script>


    <script type="text/javascript">

        function resetextra()
        {

            var extra_cargo = document.getElementById('extra').value;


            if (extra_cargo == "") {
                
              setTimeout(function () {
                  
                    document.getElementById('extra').value = '0.00';

                    calcularTotalPago();

                    $("#extra").focus();

              }, 2000);

            }

            if (extra_cargo == "0") {
                
                setTimeout(function () {

                    document.getElementById('extra').value = "0.00";

                    calcularTotalPago();

                    $("#extra").focus();
                
                }, 2000);
                

            }
            
            if (extra_cargo > "0") {

                setTimeout(function () {

                    calcularTotalPago();               

                 }, 3000);   

                $("#extra").focus();

            }


        }

    </script>



    <script type="text/javascript">

        function desval()
        {


            var dcval = document.getElementById('descuento_valor').value;
       
            if (dcval == "") {

                setTimeout(function () {
                             
                    document.getElementById('descuento_valor').value = "0.00";
                    calcularTotalPago();
                    $("#descuento_valor").focus();
                
                }, 2000);
                
            }



            if (dcval == "0") {
                
                setTimeout(function () {

                    document.getElementById('descuento_valor').value = "0.00";
                    calcularTotalPago();
                    $("#descuento_valor").focus();
                
                }, 2000);  
                

            }
            
            if (dcval > "0") {                           

              setTimeout(function () {            

                calcularTotalPago();

              }, 3000);                          

              $("#descuento_valor").focus();

            }  


        }
    </script>
    
    <script type="text/javascript">
    
    function cancelar(){/*PAGOS PREPAGADOS*/
        
       
       var pago_driver = parseFloat($("#pago_driver").val());
//       var pago_driver = document.getElementById("pago_driver").value;
       
       var temp_prepaid = parseFloat($("#temp_prepaid").val());       
       var prepaid = parseFloat($("#prepaid").val());  
       
       if (pago_driver % 1 == 0) { /*valor entero*/
           
            var result2 = parseFloat(prepaid) - parseFloat(pago_driver);  

            //$("#temp_driver").val((result).toFixed(2));
            $("#prepaid").val((result2).toFixed(2));
        

       } else { /*valor decimal*/
                                    
           var temp_prepaid = parseFloat($("#temp_prepaid").val());             
           var prepaid = parseFloat($("#prepaid").val());  
           var parte_entera = (parseFloat(pago_driver))/1.04;           
           var cargo = (parseFloat(pago_driver) - parseFloat(parte_entera)).toFixed(2);       
           var result = parseFloat(temp_prepaid) - parseFloat(cargo);             
           var result2 = prepaid - pago_driver;

           $("#temp_prepaid").val((result).toFixed(2));
           $("#prepaid").val((result2).toFixed(2));
       
        }
       

       
       var no_prep =  document.getElementById("no_prep").value;
                
                if(no_prep == 1){
                    document.getElementById("no_prep").value = 0;
                    document.getElementById('pago_pre1').value = '0';
                    document.getElementById('pagopre1').value = '';
                    document.getElementById('tipo_pagopre1').value = '';
                    document.getElementById('pagadopre1').value = '0.00'; 
                    document.getElementById('temp_prepaid').value = '0.00';
                    document.getElementById('temp').value = '0.00';
                    document.getElementById('estado_pre1').value = '';
                    
                }else if(no_prep == 2){
                    document.getElementById("no_prep").value = 1;
                    document.getElementById('pago_pre2').value = '0';
                    document.getElementById('pagopre2').value = '';
                    document.getElementById('tipo_pagopre2').value = '';
                    document.getElementById('pagadopre2').value = '0.00';
                    document.getElementById('temp_prepaid').value = '0.00';
                    document.getElementById('estado_pre2').value = '';
                    
                }else if(no_prep == 3){
                    document.getElementById("no_prep").value = 2;
                    document.getElementById('pago_pre3').value = '0';
                    document.getElementById('pagopre3').value = '';
                    document.getElementById('tipo_pagopre3').value = '';
                    document.getElementById('pagadopre3').value = '0.00'; 
                    document.getElementById('temp_prepaid').value = '0.00';
                    document.getElementById('estado_pre3').value = '';
                    
                }else if(no_prep == 4){
                    document.getElementById("no_prep").value = 3;
                    document.getElementById('pago_pre4').value = '0';
                    document.getElementById('pagopre4').value = '';
                    document.getElementById('tipo_pagopre4').value = '';
                    document.getElementById('pagadopre4').value = '0.00'; 
                    document.getElementById('temp_prepaid').value = '0.00';
                    document.getElementById('estado_pre4').value = '';
                    
                }else if(no_prep == 5){
                    document.getElementById("no_prep").value = 4;
                    document.getElementById('pago_pre5').value = '0';
                    document.getElementById('pagopre5').value = '';
                    document.getElementById('tipo_pagopre5').value = '';
                    document.getElementById('pagadopre5').value = '0.00'; 
                    document.getElementById('temp_prepaid').value = '0.00';
                    document.getElementById('estado_pre5').value = '';
                    
                }else if(no_prep == 6){
                    document.getElementById("no_prep").value = 5;
                    document.getElementById('pago_pre6').value = '0';
                    document.getElementById('pagopre6').value = '';
                    document.getElementById('tipo_pagopre6').value = '';
                    document.getElementById('pagadopre6').value = '0.00'; 
                    document.getElementById('temp_prepaid').value = '0.00';
                    document.getElementById('estado_pre6').value = '';
                    
                }else if(no_prep == 7){
                    document.getElementById("no_prep").value = 6;
                    document.getElementById('pago_pre7').value = '0';
                    document.getElementById('pagopre7').value = '';
                    document.getElementById('tipo_pagopre7').value = '';
                    document.getElementById('pagadopre7').value = '0.00';
                    document.getElementById('temp_prepaid').value = '0.00';
                    document.getElementById('estado_pre7').value = '';
                    
                }else if(no_prep == 8){
                    document.getElementById("no_prep").value = 7;
                    document.getElementById('pago_pre8').value = '0';
                    document.getElementById('pagopre8').value = '';
                    document.getElementById('tipo_pagopre8').value = '';
                    document.getElementById('pagadopre8').value = '0.00'; 
                    document.getElementById('temp_prepaid').value = '0.00';
                    document.getElementById('estado_pre8').value = '';
                    
                }else if(no_prep == 9){
                    document.getElementById("no_prep").value = 8;
                    document.getElementById('pago_pre9').value = '0';
                    document.getElementById('pagopre9').value = '';
                    document.getElementById('tipo_pagopre9').value = '';
                    document.getElementById('pagadopre9').value = '0.00'; 
                    document.getElementById('temp_prepaid').value = '0.00';
                    document.getElementById('estado_pre9').value = '';
                    
                }else if(no_prep == 10){
                    document.getElementById("no_prep").value = 9;
                    document.getElementById('pago_pre10').value = '0';
                    document.getElementById('pagopre10').value = '';
                    document.getElementById('tipo_pagopre10').value = '';
                    document.getElementById('pagadopre10').value = '0.00'; 
                    document.getElementById('temp_prepaid').value = '0.00';
                    document.getElementById('estado_pre10').value = '';
                    
                }
                
       //document.getElementById('prepaid').value = "0.00"; 
       //document.getElementById('temp_prepaid').value = "0.00"; 
       document.getElementById('temp_prepaid').value = '0.00';
       document.getElementById("pago_driver").disabled = false;
       document.getElementById('pago_driver').placeholder = "0.00"; 
       document.getElementById('pago_tarjeta').value = "0.00"; 
       document.getElementById("btnPagolinea").disabled = true;
       document.getElementById("btnPagolinea").style.display = "none";
       document.getElementById("btndecline").style.display = "none"; 
       document.getElementById("btnAceptar").disabled = true;
       document.getElementById("btnAceptar").style.background = "lightgray";   
       $("#pago_driver").focus();
                
        mostrarVentana2();

       
    
    }
    
</script>

<script type="text/javascript">
    
    function cancelar_collect_on_board(){
        
       
       var pago_driver = parseFloat($("#pago_driver").val());      
       var temp_driver = parseFloat($("#temp_driver").val());       
       var collect = parseFloat($("#collect").val());    
       
       if (pago_driver % 1 == 0) { /*valor entero*/           
                                   
            var result2 = parseFloat(collect) - parseFloat(pago_driver);          
            //$("#temp_driver").val((result).toFixed(2));
            $("#collect").val((result2).toFixed(2));
        

       } else { /*valor decimal*/         
                   
           var parte_entera = parseFloat(pago_driver)/1.04;           
             
           var cargo = (parseFloat(pago_driver) - parseFloat(parte_entera)).toFixed(2);           
           var result = parseFloat(temp_driver) - parseFloat(cargo);  
           var result2 = collect - pago_driver;

           $("#temp_driver").val((result).toFixed(2));
           $("#collect").val((result2).toFixed(2));
       
        }
       
       
       var no_pago =  document.getElementById("no_pago").value;
                
        if(no_pago == 1){
            document.getElementById("no_pago").value = 0;
            document.getElementById('pago_1').value = '0';
            document.getElementById('pago1').value = '';
            document.getElementById('tipo_pago1').value = '';
            document.getElementById('pagado1').value = '0.00'; 
            document.getElementById('pago_driver2').value = '0.00';
            document.getElementById('temp').value = '0.00';
            document.getElementById('temp_driver').value = '0.00';

        }else if(no_pago == 2){
            document.getElementById("no_pago").value = 1;
            document.getElementById('pago_2').value = '0';
            document.getElementById('pago2').value = '';
            document.getElementById('tipo_pago2').value = '';
            document.getElementById('pagado2').value = '0.00'; 
            document.getElementById('pago_driver2').value = '0.00';
            document.getElementById('temp').value = '0.00';
            document.getElementById('temp_driver').value = '0.00';

        }else if(no_pago == 3){
            document.getElementById("no_pago").value = 2;
            document.getElementById('pago_3').value = '0';
            document.getElementById('pago3').value = '';
            document.getElementById('tipo_pago3').value = '';
            document.getElementById('pagado3').value = '0.00';
            document.getElementById('pago_driver2').value = '0.00';
            document.getElementById('temp').value = '0.00';
            document.getElementById('temp_driver').value = '0.00';

        }else if(no_pago == 4){
            document.getElementById("no_pago").value = 3;
            document.getElementById('pago_4').value = '0';
            document.getElementById('pago4').value = '';
            document.getElementById('tipo_pago4').value = '';
            document.getElementById('pagado4').value = '0.00';
            document.getElementById('pago_driver2').value = '0.00';
            document.getElementById('temp').value = '0.00';
            document.getElementById('temp_driver').value = '0.00';

        }else if(no_pago == 5){
            document.getElementById("no_pago").value = 4;
            document.getElementById('pago_5').value = '0';
            document.getElementById('pago5').value = '';
            document.getElementById('tipo_pago5').value = '';
            document.getElementById('pagado5').value = '0.00';
            document.getElementById('pago_driver2').value = '0.00';
            document.getElementById('temp').value = '0.00';
            document.getElementById('temp_driver').value = '0.00';

        }else if(no_pago == 6){
            document.getElementById("no_pago").value = 5;
            document.getElementById('pago_6').value = '0';
            document.getElementById('pago6').value = '';
            document.getElementById('tipo_pago6').value = '';
            document.getElementById('pagado6').value = '0.00';
            document.getElementById('pago_driver2').value = '0.00';
            document.getElementById('temp').value = '0.00';
            document.getElementById('temp_driver').value = '0.00';

        }else if(no_pago == 7){
            document.getElementById("no_pago").value = 6;
            document.getElementById('pago_7').value = '0';
            document.getElementById('pago7').value = '';
            document.getElementById('tipo_pago7').value = '';
            document.getElementById('pagado7').value = '0.00';
            document.getElementById('pago_driver2').value = '0.00';
            document.getElementById('temp').value = '0.00';
            document.getElementById('temp_driver').value = '0.00';

        }else if(no_pago == 8){
            document.getElementById("no_pago").value = 7;
            document.getElementById('pago_8').value = '0';
            document.getElementById('pago8').value = '';
            document.getElementById('tipo_pago8').value = '';
            document.getElementById('pagado8').value = '0.00';
            document.getElementById('pago_driver2').value = '0.00';
            document.getElementById('temp').value = '0.00';
            document.getElementById('temp_driver').value = '0.00';

        }else if(no_pago == 9){
            document.getElementById("no_pago").value = 8;
            document.getElementById('pago_9').value = '0';
            document.getElementById('pago9').value = '';
            document.getElementById('tipo_pago9').value = '';
            document.getElementById('pagado9').value = '0.00';
            document.getElementById('pago_driver2').value = '0.00';
            document.getElementById('temp').value = '0.00';
            document.getElementById('temp_driver').value = '0.00';

        }else if(no_pago == 10){
            document.getElementById("no_pago").value = 9;
            document.getElementById('pago_10').value = '0';
            document.getElementById('pago10').value = '';
            document.getElementById('tipo_pago10').value = '';
            document.getElementById('pagado10').value = '0.00';
            document.getElementById('pago_driver2').value = '0.00';
            document.getElementById('temp').value = '0.00';
            document.getElementById('temp_driver').value = '0.00';

        }
                
       //document.getElementById('prepaid').value = "0.00"; 
       //document.getElementById('temp_prepaid').value = "0.00"; 
       document.getElementById('pago_driver2').value = '0.00';
       document.getElementById('temp').value = '0.00';
       document.getElementById("pago_driver").disabled = false;
       document.getElementById('pago_driver').placeholder = "0.00"; 
       
       document.getElementById("btnPagolinea").disabled = true;
       document.getElementById("btnPagolinea").style.display = "none";
       
       document.getElementById("btndecline").style.display = "none"; 
       document.getElementById("btncancol").style.display = "none"; 
       
       document.getElementById("btnAceptar").disabled = true;
       document.getElementById("btnAceptar").style.background = "lightgray";  
       $("#pago_driver").focus();
                
        mostrarVentana2();

       
    
    }
    
</script>
    
<script type="text/javascript">
    
    function valida_clase(){
        
        
        $('#paid_driver').click();
       
    
    }
    
    </script>
    
    
    <script type="text/javascript">
    
    function valida_clase2(){
        
               
        $('#pay_amount').click();
            
    
    }
    
    </script>
    
    <script type="text/javascript">
    
    function valida_pago(obj,abc){
    
    //valida la clase activa en el pago al conductor
    //alert($(obj).attr('class'));
    
    //alert($(obj).attr('class'));
    
        if($(obj).attr('class')=="flashit"){
//            alert("Hay un Pago pendiente Por Guardar");
//            Exit();

        }
        
    
    }
    
    </script>
    
    <script type="text/javascript">
    
    //valida la clase activa en el pago prepagado
    function valida_pago2(obj,def){
        
    //alert($(obj).attr('class'));
    
        if($(obj).attr('class')=="flashit2"){
//            alert("Hay un Pago pendiente Por Guardar");
//            Exit();

        }    
    
    
    }
    
    </script>


    <script type="text/javascript">

        function desporc()
        {


            var dcporc = document.getElementById('descuento').value;

            if (dcporc == "") {

                document.getElementById('descuento').value = "0";
                calcularTotalPago();
                $("#descuento").focus();
                
            }



            if (dcporc == "0") {

                document.getElementById('descuento').value = "0";
                calcularTotalPago();
                $("#descuento_valor").focus();

            }
            
            if (dcporc > "0") {
                            
            setTimeout(function () {

                calcularTotalPago();
            
            }, 0.01);
            
            $("#descuento").focus();

            }


        }
    </script>

    <script type="text/javascript">
        function reseteo()
        {
            document.getElementById('otheramount').value = '0.00';
            document.getElementById('balance_due').value = '0.00';
            div = document.getElementById('menu-bar');
        }
    </script>
    
    <script type="text/javascript"> 
       function redondea(sVal, nDec){ 
           
        var n = parseFloat(sVal); 
        var s = ""; 
        
//        setTimeout(function () {
            if (!isNaN(n)){ 
             n = Math.round(n * Math.pow(10, nDec)) / Math.pow(10, nDec); 
             s = String(n); 
             s += (s.indexOf(".") == -1? ".": "") + String(Math.pow(10, nDec)).substr(1); 
             s = s.substr(0, s.indexOf(".") + nDec + 1); 
                } 
                return s; 
//          }, 2000);
        } 

       function ponDecimales(nDec){ 
          
        setTimeout(function () {
           
        //document.form1.pago_driver.value = redondea(document.form1.pago_driver.value, nDec); 
        document.form1.descuento_valor.value = redondea(document.form1.descuento_valor.value, nDec); 
        document.form1.extra.value = redondea(document.form1.extra.value, nDec);
        document.form1.saldoactual.value = redondea(document.form1.saldoactual.value, nDec); 
//        document.formula.balance_due.value = redondea(document.formula.balance_due.value, nDec); 
        
         }, 1000);
       
       } 
    </script> 
    
    <script type="text/javascript">
    /**
     * Función que solo permite la entrada de numeros, un signo negativo y
     * un punto para separar los decimales
     */
    function soloNumeros(e)
    {
        // capturamos la tecla pulsada
        var teclaPulsada=window.event ? window.event.keyCode:e.which;
 
        // capturamos el contenido del input
        var valor=document.getElementById("saldoactual").value;
        
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
        // Si el usuario pulsa la tecla enter o el punto y no hay ningun otro
        // punto
        if(teclaPulsada==13 || (teclaPulsada==46 && valor.indexOf(".")==-1))
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
    function solopagodriver(e)
    {
        // capturamos la tecla pulsada
        var teclaPulsada=window.event ? window.event.keyCode:e.which;
 
        // capturamos el contenido del input
        
        var valor=document.getElementById("pago_driver").value;
        
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
        // Si el usuario pulsa la tecla enter o el punto y no hay ningun otro
        // punto
        if(teclaPulsada==13 || (teclaPulsada==46 && valor.indexOf(".")==-1))
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
    function solodescuento(e)
    {
        // capturamos la tecla pulsada
        var teclaPulsada=window.event ? window.event.keyCode:e.which;
 
        // capturamos el contenido del input
        
        var valor=document.getElementById("descuento_valor").value;
        
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
        // Si el usuario pulsa la tecla enter o el punto y no hay ningun otro
        // punto
        if(teclaPulsada==13 || (teclaPulsada==46 && valor.indexOf(".")==-1))
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
    function descuentoporc(evt)
    {
//        function validate(evt) {
            var theEvent = evt || window.event;
            var key = theEvent.keyCode || theEvent.which;
            key = String.fromCharCode(key);
            var regex = /[0-9]/;
            if (!regex.test(key)) {
                theEvent.returnValue = false;
                if (theEvent.preventDefault)
                    theEvent.preventDefault();
           }
    }
    </script>
    
    <script type="text/javascript">
    /**
     * Función que solo permite la entrada de numeros, un signo negativo y
     * un punto para separar los decimales
     */
    function soloextra(e)
    {
        // capturamos la tecla pulsada
        var teclaPulsada=window.event ? window.event.keyCode:e.which;
 
        // capturamos el contenido del input
        
        var valor=document.getElementById("extra").value;
        
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
        // Si el usuario pulsa la tecla enter o el punto y no hay ningun otro
        // punto
        if(teclaPulsada==13 || (teclaPulsada==46 && valor.indexOf(".")==-1))
        {
            return true;
        }
 
        // devolvemos true o false dependiendo de si es numerico o no
        return /\d/.test(String.fromCharCode(teclaPulsada));
    }
    </script>
    
    <script type="text/javascript">
    
    function checkDecimals(fieldName, fieldValue) {

    decallowed = 2; // how many decimals are allowed?

    if (isNaN(fieldValue) || fieldValue == "") {
        alert("El número no es válido. Prueba de nuevo.");
        fieldName.select();
        fieldName.focus();
    }
    else {
    if (fieldValue.indexOf('.') == -1) fieldValue += ".";
    dectext = fieldValue.substring(fieldValue.indexOf('.')+1, fieldValue.length);

    if (dectext.length > decallowed)
    {
        alert("Por favor, digita un número con " + decallowed + " números decimales.");
        fieldName.select();
        fieldName.focus();
          }
    else {
        alert("Número validado satisfactoriamente.");
          }
       }
    }
    // End -->
    </script>
    
    
    <script type="text/javascript">
    
    function valida_voucher(){
        

                 
    var idagencia = document.getElementById('idagencia').value;
       
       if(idagencia == "1"){
           
           
           document.getElementById('op_pago_conductor')[4].disabled = false; 
           //document.getElementById('op_pago_conductor').options[5].disabled = true; 
           
       }else{
           
         
           document.getElementById('op_pago_conductor')[4].disabled = true; 
           
           
       }       
             
   

    }
    
</script>

<script type="text/javascript">
function preguntaTrip() {
        $("#dialog-trip-pregunta").dialog({
            resizable: false,
            height: 246,
            width: 323,
            top: 1043.5,
            left: 661,
            modal: false,
            buttons: {
                "YES": function () {
                    $("#puestosEnUso").load("<?php echo $data['rootUrl']; ?>admin/reservas/ocuparPuestoUsuario/4");
                    window.location.reload();
                    $(this).dialog("close");
                },
                'NOT': function () {
                    $("#puestosEnUso").load("<?php echo $data['rootUrl']; ?>admin/reservas/ocuparPuestoUsuario/2");
                    $(this).dialog("close");
                }
            }
        });
    }
</script>

<script type="text/javascript">
function preguntaTrip22() {       
    
        $("#dialog-trip-pregunta").dialog({
            resizable: false,
            height: 246,
            width: 323,
            top: 1043.5,
            left: 661,
            modal: false,
            buttons: {
                "YES": function () {
                    $("#puestosEnUso").load("<?php echo $data['rootUrl']; ?>admin/reservas/ocuparPuestoUsuario/4");
                   
                    $(this).dialog("close");
                },
                
            }
        });              
               
      
    }
</script>


<script type="text/javascript">
    function preguntaTrip2() {        
        
        $("#puestosEnUso").load("<?php echo $data['rootUrl']; ?>admin/reservas/ocuparPuestoUsuario/4");
   
    }
</script>

<script type="text/javascript">
    
    function fechatrip()
    {
        
        var fecha1 = document.getElementById('fecha_salida').value; 
        
        var d = new Date(fecha1); 
        var dia = ("0" + (d.getDate())).slice(-2);                                               
        var mes = ("0" + (d.getMonth() + 1)).slice(-2);                                                               
        var yyy = d.getFullYear();
        var fechita = yyy + '-' + mes + '-' + dia;

        $("#fecha_trip").val(fechita);   
//        alert(fechita);
       

    }
</script>



<script type="text/javascript">
    
    function resetear()
    {
            var adultos = $("#adult").val();  
            var chicos = $("#child").val();           
            var id = $("#from").val();
            var total_pax = parseInt(adultos) + parseInt(chicos);
            var fecha = $("#fecha_salida").val();
            var id_agencia = $("#id_agency").val(); 
            
            document.getElementById("save2").style.display = "none";
            document.getElementById("save3").style.display = "none";  
            document.getElementById('trp301').style.display = 'none';
            document.getElementById('trp300').style.display = 'none';
            document.getElementById("wdwus").checked = false;   
            document.getElementById("wphol").checked = false; 
            document.getElementById("kspc").checked = false;              
            document.getElementById('from').disabled = true;
            document.getElementById('from').value = "0";
            document.getElementById('from').style.background = "#CCC";                    
            document.getElementById('to2').disabled = true;
            document.getElementById('to2').value = "0";
            document.getElementById('to2').style.background = "#CCC";
            document.getElementById('a_pickup1').value = "";
            document.getElementById('d_pickup1').value = "";

            $("#totalreserve").val(0);
            $("#totalreserver").val(0);             

            $("#price_transport1pp").html("$" + "0.00");
            $("#price_transport2pp").html("$" + "0.00");

            $("#totalAmount").val("0.00");
            $("#saldoporpagar").html("0.00");
   
            $("#saldoactual").val("0.00");
           
            document.getElementById("park_name").disabled = false;
            document.getElementById('park_name').style.background = '#FFFFFF';
            document.getElementById("park_name").value = "";
            $('#delete_park').click();
            $("#adm_selector").attr("checked", false);           
            $("#park_admision").html('$ 0.00');
            $("#price_transport1pp").html("$" + "0.00");
            $("#price_transport2pp").html("$" + "0.00"); 


            calcularTotalPago();
            
            $("#saldoactual").val("0.00");
            $("#totalAmount").val("0.00");
            $("#paid_driver").val("0.00");
            $("#balance_due").val("0.00");
            $("#pay_amount").val("0.00");
            $("#agency_balance_due").val("0.00"); 
            $("#adult").val(1);
            $("#child").val(0);
            
            $("#from").val(0);
            $("#to2").val(0);     

            $("#btn-pax").click();    

            
            $("#puestosEnUso").load("<?php echo $data['rootUrl']; ?>admin/reservas/ocuparPuestoUsuario/4");
            $("#schedule1").load(encodeURI('<?php echo $data['rootUrl']; ?>tours/onedaytour/1/' + $("#from").val() + '/' + $("#fecha_salida").val() + '/' + adultos + '/' + chicos));                    
            $("#schedule2").load(encodeURI('<?php echo $data['rootUrl']; ?>tours/onedaytour/2/' + $("#to2").val() + '/' + $("#fecha_salida").val() + '/' + adultos + '/' + chicos));
            document.getElementById('trp301').style.display = 'none';
            document.getElementById('trp300').style.display = 'none';
            $("#adult").focus();

         
        

    }
</script>

<script type="text/javascript">
    
    function rever_collect_on_board(){
        
//      var no_prep =  document.getElementById("no_prep").value;
        var no_pago =  document.getElementById("no_pago").value;
        var pago_1 = document.getElementById("pago_1").value;
        var pago_2 = document.getElementById("pago_2").value;
        var pago_3 = document.getElementById("pago_3").value;
        var pago_4 = document.getElementById("pago_4").value;
        var pago_5 = document.getElementById("pago_5").value;
        var pago_6 = document.getElementById("pago_6").value;
        var pago_7 = document.getElementById("pago_7").value;
        var pago_8 = document.getElementById("pago_8").value;
        var pago_9 = document.getElementById("pago_9").value;
        var pago_10 = document.getElementById("pago_10").value;
        
        var estado_cob1 = document.getElementById("estado_cob1").value;
        var estado_cob2 = document.getElementById("estado_cob2").value;
        var estado_cob3 = document.getElementById("estado_cob3").value;
        var estado_cob4 = document.getElementById("estado_cob4").value;
        var estado_cob5 = document.getElementById("estado_cob5").value;
        var estado_cob6 = document.getElementById("estado_cob6").value;
        var estado_cob7 = document.getElementById("estado_cob7").value;
        var estado_cob8 = document.getElementById("estado_cob8").value;
        var estado_cob9 = document.getElementById("estado_cob9").value;
        var estado_cob10 = document.getElementById("estado_cob10").value;
        var temp_prepaid = document.getElementById("temp_prepaid").value;
        
//      document.getElementById('prepaid').value = "0.00"; 
//      document.getElementById('temp_prepaid').value = "0.00"; 

        
        var pay_amount = document.getElementById('pay_amount').value;     
        document.getElementById('pago_driver').value = "0.00";          
        document.getElementById('paid_driver').value = "0.00"; 
        
        //actualizacion
        
        if(no_pago == 0){ 
            document.getElementById('trian1').style.display = 'none';
            document.getElementById('trian2').style.display = 'none';
            document.getElementById('trian3').style.display = 'none';
            document.getElementById('trian4').style.display = 'none';
            document.getElementById('trian5').style.display = 'none';
            document.getElementById('trian6').style.display = 'none';
            document.getElementById('trian7').style.display = 'none';
            document.getElementById('trian8').style.display = 'none';
            document.getElementById('trian9').style.display = 'none';
            document.getElementById('trian10').style.display = 'none';
        }
        
        if(no_pago == 1){ 
         
            document.getElementById('trian1').style.display = 'none';
        }
        
        if(no_pago == 2){ 
            
            document.getElementById('trian1').style.display = 'none';
            document.getElementById('trian2').style.display = 'none';
            
        }
        
        if(no_pago == 3){ 
            
            document.getElementById('trian1').style.display = 'none';
            document.getElementById('trian2').style.display = 'none';
            document.getElementById('trian3').style.display = 'none';
            
        }
        
        if(no_pago == 4){ 
            
            document.getElementById('trian1').style.display = 'none';
            document.getElementById('trian2').style.display = 'none';
            document.getElementById('trian3').style.display = 'none';
            document.getElementById('trian4').style.display = 'none';
            
        }
        
        if(no_pago == 5){ 
            
            document.getElementById('trian1').style.display = 'none';
            document.getElementById('trian2').style.display = 'none';
            document.getElementById('trian3').style.display = 'none';
            document.getElementById('trian4').style.display = 'none';
            document.getElementById('trian5').style.display = 'none';
            
        }
        
        if(no_pago == 6){ 
            
            document.getElementById('trian1').style.display = 'none';
            document.getElementById('trian2').style.display = 'none';
            document.getElementById('trian3').style.display = 'none';
            document.getElementById('trian4').style.display = 'none';
            document.getElementById('trian5').style.display = 'none';
            document.getElementById('trian6').style.display = 'none';
            
        }
        
        if(no_pago == 7){ 
            
            document.getElementById('trian1').style.display = 'none';
            document.getElementById('trian2').style.display = 'none';
            document.getElementById('trian3').style.display = 'none';
            document.getElementById('trian4').style.display = 'none';
            document.getElementById('trian5').style.display = 'none';
            document.getElementById('trian6').style.display = 'none';
            document.getElementById('trian7').style.display = 'none';
            
        }
        
        if(no_pago == 8){ 
            
            document.getElementById('trian1').style.display = 'none';
            document.getElementById('trian2').style.display = 'none';
            document.getElementById('trian3').style.display = 'none';
            document.getElementById('trian4').style.display = 'none';
            document.getElementById('trian5').style.display = 'none';
            document.getElementById('trian6').style.display = 'none';
            document.getElementById('trian7').style.display = 'none';
            document.getElementById('trian8').style.display = 'none';
            
        }
        
        if(no_pago == 9){ 
            
            document.getElementById('trian1').style.display = 'none';
            document.getElementById('trian2').style.display = 'none';
            document.getElementById('trian3').style.display = 'none';
            document.getElementById('trian4').style.display = 'none';
            document.getElementById('trian5').style.display = 'none';
            document.getElementById('trian6').style.display = 'none';
            document.getElementById('trian7').style.display = 'none';
            document.getElementById('trian8').style.display = 'none';
            document.getElementById('trian9').style.display = 'none';
            
        }
        
        if(no_pago == 10){ 
            
            document.getElementById('trian1').style.display = 'none';
            document.getElementById('trian2').style.display = 'none';
            document.getElementById('trian3').style.display = 'none';
            document.getElementById('trian4').style.display = 'none';
            document.getElementById('trian5').style.display = 'none';
            document.getElementById('trian6').style.display = 'none';
            document.getElementById('trian7').style.display = 'none';
            document.getElementById('trian8').style.display = 'none';
            document.getElementById('trian9').style.display = 'none';
            document.getElementById('trian10').style.display = 'none';
            
        }

        //old
        
        if(pago_1 == 1){
            document.getElementById("no_pago").value = 0;
            document.getElementById('pago_1').value = '0';
            document.getElementById('pago1').value = '';
            document.getElementById('tipo_pago1').value = '';
            document.getElementById('pagado1').value = '0.00';   
            document.getElementById('collect').value = '0.00'; 
            document.getElementById('pago_driver').value = '0.00';
            document.getElementById('pago_driver2').value = '0.00';
            //document.getElementById('temp').value = '0.00';
            document.getElementById('temp_driver').value = '0.00';
            document.getElementById("estado_cob1").value= '';
            
            if(pay_amount == '0.00'){            
            document.getElementById('temp').value = '0.00';            
            }
            if(pay_amount > '0.00'){    
                document.getElementById('temp').value = temp_prepaid;            
            }
            

        }
        if(pago_2 == 2){
            document.getElementById("no_pago").value = 0;
            document.getElementById('pago_2').value = '0';
            document.getElementById('pago2').value = '';
            document.getElementById('tipo_pago2').value = '';
            document.getElementById('pagado2').value = '0.00';
            document.getElementById('collect').value = '0.00'; 
            document.getElementById('pago_driver').value = '0.00';
            document.getElementById('pago_driver2').value = '0.00';
            //document.getElementById('temp').value = '0.00';
            document.getElementById('temp_driver').value = '0.00';
            document.getElementById("estado_cob1").value= '';
            document.getElementById("estado_cob2").value= '';
            
            if(pay_amount == '0.00'){            
            document.getElementById('temp').value = '0.00';            
            }
            if(pay_amount > '0.00'){    
                document.getElementById('temp').value = temp_prepaid;            
            }

        }
        if(pago_3 == 3){
            document.getElementById("no_pago").value = 0;
            document.getElementById('pago_3').value = '0';
            document.getElementById('pago3').value = '';
            document.getElementById('tipo_pago3').value = '';
            document.getElementById('pagado3').value = '0.00';
            document.getElementById('collect').value = '0.00'; 
            document.getElementById('pago_driver').value = '0.00';
            document.getElementById('pago_driver2').value = '0.00';
            //document.getElementById('temp').value = '0.00';
            document.getElementById('temp_driver').value = '0.00';
            document.getElementById("estado_cob1").value= '';
            document.getElementById("estado_cob2").value= '';
            document.getElementById("estado_cob3").value= '';
            
            if(pay_amount == '0.00'){            
            document.getElementById('temp').value = '0.00';            
            }
            if(pay_amount > '0.00'){    
                document.getElementById('temp').value = temp_prepaid;            
            }

        }
        if(pago_4 == 4){
            document.getElementById("no_pago").value = 0;
            document.getElementById('pago_4').value = '0';
            document.getElementById('pago4').value = '';
            document.getElementById('tipo_pago4').value = '';
            document.getElementById('pagado4').value = '0.00'; 
            document.getElementById('collect').value = '0.00';
            document.getElementById('pago_driver').value = '0.00';
            document.getElementById('pago_driver2').value = '0.00';
            //document.getElementById('temp').value = '0.00';
            document.getElementById('temp_driver').value = '0.00';
            document.getElementById("estado_cob1").value= '';
            document.getElementById("estado_cob2").value= '';
            document.getElementById("estado_cob3").value= '';
            document.getElementById("estado_cob4").value= '';
            
            if(pay_amount == '0.00'){            
            document.getElementById('temp').value = '0.00';            
            }
            if(pay_amount > '0.00'){    
                document.getElementById('temp').value = temp_prepaid;            
            }

        }
        if(pago_5 == 5){
            document.getElementById("no_pago").value = 0;
            document.getElementById('pago_5').value = '0';
            document.getElementById('pago5').value = '';
            document.getElementById('tipo_pago5').value = '';
            document.getElementById('pagado5').value = '0.00';
            document.getElementById('collect').value = '0.00';
            document.getElementById('pago_driver').value = '0.00';
            document.getElementById('pago_driver2').value = '0.00';
            //document.getElementById('temp').value = '0.00';
            document.getElementById('temp_driver').value = '0.00';
            document.getElementById("estado_cob1").value= '';
            document.getElementById("estado_cob2").value= '';
            document.getElementById("estado_cob3").value= '';
            document.getElementById("estado_cob4").value= '';
            document.getElementById("estado_cob5").value= '';
            
            if(pay_amount == '0.00'){            
            document.getElementById('temp').value = '0.00';            
            }
            if(pay_amount > '0.00'){    
                document.getElementById('temp').value = temp_prepaid;            
            }

        }
        if(pago_6 == 6){
            document.getElementById("no_pago").value = 0;
            document.getElementById('pago_6').value = '0';
            document.getElementById('pago6').value = '';
            document.getElementById('tipo_pago6').value = '';
            document.getElementById('pagado6').value = '0.00'; 
            document.getElementById('collect').value = '0.00';
            document.getElementById('pago_driver').value = '0.00';
            document.getElementById('pago_driver2').value = '0.00';
            //document.getElementById('temp').value = '0.00';
            document.getElementById('temp_driver').value = '0.00';
            document.getElementById("estado_cob1").value= '';
            document.getElementById("estado_cob2").value= '';
            document.getElementById("estado_cob3").value= '';
            document.getElementById("estado_cob4").value= '';
            document.getElementById("estado_cob5").value= '';
            document.getElementById("estado_cob6").value= '';
            
            if(pay_amount == '0.00'){            
            document.getElementById('temp').value = '0.00';            
            }
            if(pay_amount > '0.00'){    
                document.getElementById('temp').value = temp_prepaid;            
            }

        }
        if(pago_7 == 7){
            document.getElementById("no_pago").value = 0;
            document.getElementById('pago_7').value = '0';
            document.getElementById('pago7').value = '';
            document.getElementById('tipo_pago7').value = '';
            document.getElementById('pagado7').value = '0.00'; 
            document.getElementById('collect').value = '0.00';
            document.getElementById('pago_driver').value = '0.00';
            document.getElementById('pago_driver2').value = '0.00';
            //document.getElementById('temp').value = '0.00';
            document.getElementById('temp_driver').value = '0.00';
            document.getElementById("estado_cob1").value= '';
            document.getElementById("estado_cob2").value= '';
            document.getElementById("estado_cob3").value= '';
            document.getElementById("estado_cob4").value= '';
            document.getElementById("estado_cob5").value= '';
            document.getElementById("estado_cob6").value= '';
            document.getElementById("estado_cob7").value= '';
            
            if(pay_amount == '0.00'){            
            document.getElementById('temp').value = '0.00';            
            }
            if(pay_amount > '0.00'){    
                document.getElementById('temp').value = temp_prepaid;            
            }

        }
        if(pago_8 == 8){
            document.getElementById("no_pago").value = 0;
            document.getElementById('pago_8').value = '0';
            document.getElementById('pago8').value = '';
            document.getElementById('tipo_pago8').value = '';
            document.getElementById('pagado8').value = '0.00'; 
            document.getElementById('collect').value = '0.00'; 
            document.getElementById('pago_driver').value = '0.00';
            document.getElementById('pago_driver2').value = '0.00';
            //document.getElementById('temp').value = '0.00';
            document.getElementById('temp_driver').value = '0.00';
            document.getElementById("estado_cob1").value= '';
            document.getElementById("estado_cob2").value= '';
            document.getElementById("estado_cob3").value= '';
            document.getElementById("estado_cob4").value= '';
            document.getElementById("estado_cob5").value= '';
            document.getElementById("estado_cob6").value= '';
            document.getElementById("estado_cob7").value= '';
            document.getElementById("estado_cob8").value= '';
            
            if(pay_amount == '0.00'){            
            document.getElementById('temp').value = '0.00';            
            }
            if(pay_amount > '0.00'){    
                document.getElementById('temp').value = temp_prepaid;            
            }

        }
        if(pago_9 == 9){
            document.getElementById("no_pago").value = 0;
            document.getElementById('pago_9').value = '0';
            document.getElementById('pago9').value = '';
            document.getElementById('tipo_pago9').value = '';
            document.getElementById('pagado9').value = '0.00'; 
            document.getElementById('collect').value = '0.00';
            document.getElementById('pago_driver').value = '0.00';
            document.getElementById('pago_driver2').value = '0.00';
            //document.getElementById('temp').value = '0.00';
            document.getElementById('temp_driver').value = '0.00';
            document.getElementById("estado_cob1").value= '';
            document.getElementById("estado_cob2").value= '';
            document.getElementById("estado_cob3").value= '';
            document.getElementById("estado_cob4").value= '';
            document.getElementById("estado_cob5").value= '';
            document.getElementById("estado_cob6").value= '';
            document.getElementById("estado_cob7").value= '';
            document.getElementById("estado_cob8").value= '';            
            document.getElementById("estado_cob9").value= '';
            
            if(pay_amount == '0.00'){            
            document.getElementById('temp').value = '0.00';            
            }
            if(pay_amount > '0.00'){    
                document.getElementById('temp').value = temp_prepaid;            
            }

        }
        if(pago_10 == 10){
            document.getElementById("no_pago").value = 0;
            document.getElementById('pago_10').value = '0';
            document.getElementById('pago10').value = '';
            document.getElementById('tipo_pago10').value = '';
            document.getElementById('pagado10').value = '0.00'; 
            document.getElementById('collect').value = '0.00';
            document.getElementById('pago_driver').value = '0.00';
            document.getElementById('pago_driver2').value = '0.00';
            //document.getElementById('temp').value = '0.00';
            document.getElementById('temp_driver').value = '0.00';
            document.getElementById("estado_cob1").value= '';
            document.getElementById("estado_cob2").value= '';
            document.getElementById("estado_cob3").value= '';
            document.getElementById("estado_cob4").value= '';
            document.getElementById("estado_cob5").value= '';
            document.getElementById("estado_cob6").value= '';
            document.getElementById("estado_cob7").value= '';
            document.getElementById("estado_cob8").value= '';            
            document.getElementById("estado_cob9").value= '';
            document.getElementById("estado_cob10").value= '';
            
            if(pay_amount == '0.00'){            
            document.getElementById('temp').value = '0.00';            
            }
            if(pay_amount > '0.00'){    
                document.getElementById('temp').value = temp_prepaid;            
            }

        }
    
       document.getElementById('collect').value = '0.00'; 
       document.getElementById('pago_driver2').value = '0.00';
       //document.getElementById('temp').value = '0.00';
       document.getElementById('temp_driver').value = '0.00';
            
       document.getElementById("pago_driver").disabled = false;
       document.getElementById('pago_driver').placeholder = "0.00"; 
       document.getElementById('pago_tarjeta').value = "0.00"; 
       document.getElementById("btnPagolinea").disabled = true;
       document.getElementById("btnPagolinea").style.display = "none";
       document.getElementById("btndecline").style.display = "none"; 
       document.getElementById("btncancol").style.display = "none"; 
       document.getElementById("btnAceptar").disabled = true;
       document.getElementById("btnAceptar").style.background = "lightgray";  
       
       //document.getElementById('paid_driver').className = "brown3";
       //$("#pago_driver").focus();
       

     calcularTotalPago();   
     document.getElementById('btn_rever_cob').style.display = "none";
     
//     resetal();
//     reset2();
//     ocultarVentana2();
       
        
    }
</script>

<script type="text/javascript">
    
    function rever_prepaid(){
        
    var no_prep =  document.getElementById("no_prep").value;
    var pago_pre1 = document.getElementById("pago_pre1").value;
    var pago_pre2 = document.getElementById("pago_pre2").value;
    var pago_pre3 = document.getElementById("pago_pre3").value;
    var pago_pre4 = document.getElementById("pago_pre4").value;
    var pago_pre5 = document.getElementById("pago_pre5").value;
    var pago_pre6 = document.getElementById("pago_pre6").value;
    var pago_pre7 = document.getElementById("pago_pre7").value;
    var pago_pre8 = document.getElementById("pago_pre8").value;
    var pago_pre9 = document.getElementById("pago_pre9").value;
    var pago_pre10 = document.getElementById("pago_pre10").value;
    var estado_pre1 = document.getElementById("estado_pre1").value;
    var estado_pre2 = document.getElementById("estado_pre2").value;
    var estado_pre3 = document.getElementById("estado_pre3").value;
    var estado_pre4 = document.getElementById("estado_pre4").value;
    var estado_pre5 = document.getElementById("estado_pre5").value;
    var estado_pre6 = document.getElementById("estado_pre6").value;
    var estado_pre7 = document.getElementById("estado_pre7").value;
    var estado_pre8 = document.getElementById("estado_pre8").value;
    var estado_pre9 = document.getElementById("estado_pre9").value;
    var estado_pre10 = document.getElementById("estado_pre10").value;
    var paid_driver = document.getElementById('paid_driver').value;
    var temp_driver = document.getElementById('temp_driver').value;
    
    
    
    
//  var no_pago =  document.getElementById("no_pago").value;
    
    document.getElementById('prepaid').value = "0.00"; 
    
    document.getElementById('temp_prepaid').value = "0.00"; 
    
    document.getElementById('pay_amount').value = "0.00"; 
//  document.getElementById('paid_driver').value = "0.00";
//    document.getElementById('pago_driver').value = "0.00"; 

        if(no_prep == 0){ 
            document.getElementById('cir1').style.display = 'none';
            document.getElementById('cir2').style.display = 'none';
            document.getElementById('cir3').style.display = 'none';
            document.getElementById('cir4').style.display = 'none';
            document.getElementById('cir5').style.display = 'none';
            document.getElementById('cir6').style.display = 'none';
            document.getElementById('cir7').style.display = 'none';
            document.getElementById('cir8').style.display = 'none';
            document.getElementById('cir9').style.display = 'none';
            document.getElementById('cir10').style.display = 'none';
            $("#pago_driver").val((0).toFixed(2));
            document.getElementById('pago_driver').placeholder = "0.00"; 
        }
        
        if(no_prep == 1){ 
         
            document.getElementById('cir1').style.display = 'none';
            $("#pago_driver").val((0).toFixed(2));
            document.getElementById('pago_driver').placeholder = "0.00"; 
            
        }
        
        if(no_prep == 2){ 
            
            document.getElementById('cir1').style.display = 'none';
            document.getElementById('cir2').style.display = 'none';
            $("#pago_driver").val((0).toFixed(2));
            document.getElementById('pago_driver').placeholder = "0.00";
            
        }
        
        if(no_prep == 3){ 
            
            document.getElementById('cir1').style.display = 'none';
            document.getElementById('cir2').style.display = 'none';
            document.getElementById('cir3').style.display = 'none';
            $("#pago_driver").val((0).toFixed(2));
            document.getElementById('pago_driver').placeholder = "0.00";
            
        }
        
        if(no_prep == 4){ 
            
            document.getElementById('cir1').style.display = 'none';
            document.getElementById('cir2').style.display = 'none';
            document.getElementById('cir3').style.display = 'none';
            document.getElementById('cir4').style.display = 'none';
            $("#pago_driver").val((0).toFixed(2));
            document.getElementById('pago_driver').placeholder = "0.00";
            
        }
        
        if(no_prep == 5){ 
            
            document.getElementById('cir1').style.display = 'none';
            document.getElementById('cir2').style.display = 'none';
            document.getElementById('cir3').style.display = 'none';
            document.getElementById('cir4').style.display = 'none';
            document.getElementById('cir5').style.display = 'none';
            $("#pago_driver").val((0).toFixed(2));
            document.getElementById('pago_driver').placeholder = "0.00";
            
        }
        
        if(no_prep == 6){ 
            
            document.getElementById('cir1').style.display = 'none';
            document.getElementById('cir2').style.display = 'none';
            document.getElementById('cir3').style.display = 'none';
            document.getElementById('cir4').style.display = 'none';
            document.getElementById('cir5').style.display = 'none';
            document.getElementById('cir6').style.display = 'none';
            $("#pago_driver").val((0).toFixed(2));
            document.getElementById('pago_driver').placeholder = "0.00";
            
        }
        
        if(no_prep == 7){ 
            
            document.getElementById('cir1').style.display = 'none';
            document.getElementById('cir2').style.display = 'none';
            document.getElementById('cir3').style.display = 'none';
            document.getElementById('cir4').style.display = 'none';
            document.getElementById('cir5').style.display = 'none';
            document.getElementById('cir6').style.display = 'none';
            document.getElementById('cir7').style.display = 'none';
            $("#pago_driver").val((0).toFixed(2));
            document.getElementById('pago_driver').placeholder = "0.00";
            
        }
        
        if(no_prep == 8){ 
            
            document.getElementById('cir1').style.display = 'none';
            document.getElementById('cir2').style.display = 'none';
            document.getElementById('cir3').style.display = 'none';
            document.getElementById('cir4').style.display = 'none';
            document.getElementById('cir5').style.display = 'none';
            document.getElementById('cir6').style.display = 'none';
            document.getElementById('cir7').style.display = 'none';
            document.getElementById('cir8').style.display = 'none';
            $("#pago_driver").val((0).toFixed(2));
            document.getElementById('pago_driver').placeholder = "0.00";
            
        }
        
        if(no_prep == 9){ 
            
            document.getElementById('cir1').style.display = 'none';
            document.getElementById('cir2').style.display = 'none';
            document.getElementById('cir3').style.display = 'none';
            document.getElementById('cir4').style.display = 'none';
            document.getElementById('cir5').style.display = 'none';
            document.getElementById('cir6').style.display = 'none';
            document.getElementById('cir7').style.display = 'none';
            document.getElementById('cir8').style.display = 'none';
            document.getElementById('cir9').style.display = 'none';
            $("#pago_driver").val((0).toFixed(2));
            document.getElementById('pago_driver').placeholder = "0.00";
            
        }
        
        if(no_prep == 10){ 
            
            document.getElementById('cir1').style.display = 'none';
            document.getElementById('cir2').style.display = 'none';
            document.getElementById('cir3').style.display = 'none';
            document.getElementById('cir4').style.display = 'none';
            document.getElementById('cir5').style.display = 'none';
            document.getElementById('cir6').style.display = 'none';
            document.getElementById('cir7').style.display = 'none';
            document.getElementById('cir8').style.display = 'none';
            document.getElementById('cir9').style.display = 'none';
            document.getElementById('cir10').style.display = 'none';
            $("#pago_driver").val((0).toFixed(2));
            document.getElementById('pago_driver').placeholder = "0.00";
            
        }
        
        
        
        //old
               
        if(pago_pre1 == 1){
            
            document.getElementById("no_prep").value = 0;
            document.getElementById('pago_pre1').value = '0';
            document.getElementById('pagopre1').value = '';
            document.getElementById('tipo_pagopre1').value = '';
            document.getElementById('pagadopre1').value = '0.00'; 
            document.getElementById('prepaid').value = '0.00'; 
            document.getElementById('pago_driver2').value = '0.00';
            document.getElementById('pago_driver').value = '0.00';
            
            //document.getElementById('temp').value = '0.00';
            document.getElementById('temp_prepaid').value = '0.00';
            document.getElementById("estado_pre1").value= '';
            
            if(paid_driver == '0.00'){
                document.getElementById('temp').value = '0.00';
            }

            if(paid_driver > '0.00'){    
                document.getElementById('temp').value = temp_driver;        
            }
            

        }
        if(pago_pre2 == 2){
            
            document.getElementById("no_prep").value = 0;
            document.getElementById('pago_pre2').value = '0';
            document.getElementById('pagopre2').value = '';
            document.getElementById('tipo_pagopre2').value = '';
            document.getElementById('pagadopre2').value = '0.00';
            document.getElementById('prepaid').value = '0.00'; 
            document.getElementById('pago_driver2').value = '0.00';
            document.getElementById('pago_driver').value = '0.00';
            //document.getElementById('temp').value = '0.00';
            document.getElementById('temp_prepaid').value = '0.00';
            document.getElementById("estado_pre1").value= '';
            document.getElementById("estado_pre2").value= '';
            
            if(paid_driver == '0.00'){
                document.getElementById('temp').value = '0.00';
            }

            if(paid_driver > '0.00'){    
                document.getElementById('temp').value = temp_driver;        
            }

        }
        if(pago_pre3 == 3){
            
            document.getElementById("no_prep").value = 0;
            document.getElementById('pago_pre3').value = '0';
            document.getElementById('pagopre3').value = '';
            document.getElementById('tipo_pagopre3').value = '';
            document.getElementById('pagadopre3').value = '0.00'; 
            document.getElementById('prepaid').value = '0.00'; 
            document.getElementById('pago_driver2').value = '0.00';
            document.getElementById('pago_driver').value = '0.00';
            //document.getElementById('temp').value = '0.00';
            document.getElementById('temp_prepaid').value = '0.00';
            document.getElementById("estado_pre1").value= '';
            document.getElementById("estado_pre2").value= '';
            document.getElementById("estado_pre3").value= '';
            
            if(paid_driver == '0.00'){
                document.getElementById('temp').value = '0.00';
            }

            if(paid_driver > '0.00'){    
                document.getElementById('temp').value = temp_driver;        
            }

        }
        if(pago_pre4 == 4){
            
            document.getElementById("no_prep").value = 0;
            document.getElementById('pago_pre4').value = '0';
            document.getElementById('pagopre4').value = '';
            document.getElementById('tipo_pagopre4').value = '';
            document.getElementById('pagadopre4').value = '0.00'; 
            document.getElementById('prepaid').value = '0.00'; 
            document.getElementById('pago_driver2').value = '0.00';
            document.getElementById('pago_driver').value = '0.00';
            //document.getElementById('temp').value = '0.00';
            document.getElementById('temp_prepaid').value = '0.00';
            document.getElementById("estado_pre1").value= '';
            document.getElementById("estado_pre2").value= '';
            document.getElementById("estado_pre3").value= '';
            document.getElementById("estado_pre4").value= '';
            
            if(paid_driver == '0.00'){
                document.getElementById('temp').value = '0.00';
            }

            if(paid_driver > '0.00'){    
                document.getElementById('temp').value = temp_driver;        
            }

        }
        if(pago_pre5 == 5){
            
            document.getElementById("no_prep").value = 0;
            document.getElementById('pago_pre5').value = '0';
            document.getElementById('pagopre5').value = '';
            document.getElementById('tipo_pagopre5').value = '';
            document.getElementById('pagadopre5').value = '0.00'; 
            document.getElementById('prepaid').value = '0.00'; 
            document.getElementById('pago_driver2').value = '0.00';
            document.getElementById('pago_driver').value = '0.00';
            //document.getElementById('temp').value = '0.00';
            document.getElementById('temp_prepaid').value = '0.00';
            document.getElementById("estado_pre1").value= '';
            document.getElementById("estado_pre2").value= '';
            document.getElementById("estado_pre3").value= '';
            document.getElementById("estado_pre4").value= '';
            document.getElementById("estado_pre5").value= '';
            
            if(paid_driver == '0.00'){
                document.getElementById('temp').value = '0.00';
            }

            if(paid_driver > '0.00'){    
                document.getElementById('temp').value = temp_driver;        
            }

        }
        if(pago_pre6 == 6){
            
            document.getElementById("no_prep").value = 0;
            document.getElementById('pago_pre6').value = '0';
            document.getElementById('pagopre6').value = '';
            document.getElementById('tipo_pagopre6').value = '';
            document.getElementById('pagadopre6').value = '0.00'; 
            document.getElementById('prepaid').value = '0.00'; 
            document.getElementById('pago_driver2').value = '0.00';
            document.getElementById('pago_driver').value = '0.00';
            //document.getElementById('temp').value = '0.00';
            document.getElementById('temp_prepaid').value = '0.00';
            document.getElementById("estado_pre1").value= '';
            document.getElementById("estado_pre2").value= '';
            document.getElementById("estado_pre3").value= '';
            document.getElementById("estado_pre4").value= '';
            document.getElementById("estado_pre5").value= '';
            document.getElementById("estado_pre6").value= '';
            
            if(paid_driver == '0.00'){
                document.getElementById('temp').value = '0.00';
            }

            if(paid_driver > '0.00'){    
                document.getElementById('temp').value = temp_driver;        
            }
            

        }
        if(pago_pre7 == 7){
            
            document.getElementById("no_prep").value = 0;
            document.getElementById('pago_pre7').value = '0';
            document.getElementById('pagopre7').value = '';
            document.getElementById('tipo_pagopre7').value = '';
            document.getElementById('pagadopre7').value = '0.00'; 
            document.getElementById('prepaid').value = '0.00'; 
            document.getElementById('pago_driver2').value = '0.00';
            document.getElementById('pago_driver').value = '0.00';
            //document.getElementById('temp').value = '0.00';
            document.getElementById('temp_prepaid').value = '0.00';
            document.getElementById("estado_pre1").value= '';
            document.getElementById("estado_pre2").value= '';
            document.getElementById("estado_pre3").value= '';
            document.getElementById("estado_pre4").value= '';
            document.getElementById("estado_pre5").value= '';
            document.getElementById("estado_pre6").value= '';
            document.getElementById("estado_pre7").value= '';
            
            if(paid_driver == '0.00'){
                document.getElementById('temp').value = '0.00';
            }

            if(paid_driver > '0.00'){    
                document.getElementById('temp').value = temp_driver;        
            }
            

        }
        if(pago_pre8 == 8){
            
            document.getElementById("no_prep").value = 0;
            document.getElementById('pago_pre8').value = '0';
            document.getElementById('pagopre8').value = '';
            document.getElementById('tipo_pagopre8').value = '';
            document.getElementById('pagadopre8').value = '0.00';
            document.getElementById('prepaid').value = '0.00'; 
            document.getElementById('pago_driver2').value = '0.00';
            document.getElementById('pago_driver').value = '0.00';
            //document.getElementById('temp').value = '0.00';
            document.getElementById('temp_prepaid').value = '0.00';
            document.getElementById("estado_pre1").value= '';
            document.getElementById("estado_pre2").value= '';
            document.getElementById("estado_pre3").value= '';
            document.getElementById("estado_pre4").value= '';
            document.getElementById("estado_pre5").value= '';
            document.getElementById("estado_pre6").value= '';
            document.getElementById("estado_pre7").value= '';
            document.getElementById("estado_pre8").value= '';
            
            if(paid_driver == '0.00'){
                document.getElementById('temp').value = '0.00';
            }

            if(paid_driver > '0.00'){    
                document.getElementById('temp').value = temp_driver;        
            }


        }
        if(pago_pre9 == 9){
            
            document.getElementById("no_prep").value = 0;
            document.getElementById('pago_pre9').value = '0';
            document.getElementById('pagopre9').value = '';
            document.getElementById('tipo_pagopre9').value = '';
            document.getElementById('pagadopre9').value = '0.00'; 
            document.getElementById('prepaid').value = '0.00'; 
            document.getElementById('pago_driver2').value = '0.00';
            document.getElementById('pago_driver').value = '0.00';
            //document.getElementById('temp').value = '0.00';
            document.getElementById('temp_prepaid').value = '0.00';
            document.getElementById("estado_pre1").value= '';
            document.getElementById("estado_pre2").value= '';
            document.getElementById("estado_pre3").value= '';
            document.getElementById("estado_pre4").value= '';
            document.getElementById("estado_pre5").value= '';
            document.getElementById("estado_pre6").value= '';
            document.getElementById("estado_pre7").value= '';
            document.getElementById("estado_pre8").value= '';
            document.getElementById("estado_pre9").value= '';
            
            if(paid_driver == '0.00'){
                document.getElementById('temp').value = '0.00';
            }

            if(paid_driver > '0.00'){    
                document.getElementById('temp').value = temp_driver;        
            }

        }
        if(pago_pre10 == 10){
            
            document.getElementById("no_prep").value = 0;
            document.getElementById('pago_pre10').value = '0';
            document.getElementById('pagopre10').value = '';
            document.getElementById('tipo_pagopre10').value = '';
            document.getElementById('pagadopre10').value = '0.00';
            document.getElementById('prepaid').value = '0.00'; 
            document.getElementById('pago_driver2').value = '0.00';
            document.getElementById('pago_driver').value = '0.00';
            //document.getElementById('temp').value = '0.00';
            document.getElementById('temp_prepaid').value = '0.00';
            document.getElementById("estado_pre1").value= '';
            document.getElementById("estado_pre2").value= '';
            document.getElementById("estado_pre3").value= '';
            document.getElementById("estado_pre4").value= '';
            document.getElementById("estado_pre5").value= '';
            document.getElementById("estado_pre6").value= '';
            document.getElementById("estado_pre7").value= '';
            document.getElementById("estado_pre8").value= '';
            document.getElementById("estado_pre9").value= '';
            document.getElementById("estado_pre10").value= '';
            
            if(paid_driver == '0.00'){
                document.getElementById('temp').value = '0.00';
            }

            if(paid_driver > '0.00'){    
                document.getElementById('temp').value = temp_driver;        
            }

        }
        
        
        document.getElementById('prepaid').value = '0.00'; 
        //document.getElementById('temp').value = '0.00';
        document.getElementById('temp_prepaid').value = '0.00';
        document.getElementById('pago_driver2').value = '0.00';
        document.getElementById("pago_driver").disabled = false;
        document.getElementById('pago_driver').placeholder = "0.00"; 
        document.getElementById('pago_tarjeta').value = "0.00"; 
        document.getElementById("btnPagolinea").disabled = true;
        document.getElementById("btnPagolinea").style.display = "none";
        document.getElementById("btndecline").style.display = "none"; 
        document.getElementById("btncancol").style.display = "none"; 
        document.getElementById("btnAceptar").disabled = true;
        document.getElementById("btnAceptar").style.background = "lightgray";  
        //document.getElementById('pay_amount').className = "azu";
//      document.getElementById('paid_driver').className = "brown3";
//      $("#pago_driver").focus();
       

        calcularTotalPago();
        document.getElementById('btn_rever_prepaid').style.display = "none";
//        resetal();
//        reset2();
//        ocultarVentana2();      
        
    }
</script>

<script type="text/javascript">
    
    function declinar()     {
        
        
        var ventana2 = document.getElementById('miVentana2'); // Accedemos al contenedor
        var pay_amount = document.getElementById('pay_amount').value;        
        var no_prep = document.getElementById('no_prep').value;    
        var pago_driver2 = document.getElementById('pago_driver2').value; 
        var prepaid = document.getElementById('prepaid').value;   
        var temp_prepaid = document.getElementById('temp_prepaid').value;
        var temp_driver = document.getElementById('temp_driver').value;
        
        
        var estado_pre1 = document.getElementById('estado_pre1').value;
        var estado_pre2 = document.getElementById('estado_pre2').value;
        var estado_pre3 = document.getElementById('estado_pre3').value;
        var estado_pre4 = document.getElementById('estado_pre4').value;
        var estado_pre5 = document.getElementById('estado_pre5').value;
        var estado_pre6 = document.getElementById('estado_pre6').value;
        var estado_pre7 = document.getElementById('estado_pre7').value;
        var estado_pre8 = document.getElementById('estado_pre8').value;
        var estado_pre9 = document.getElementById('estado_pre9').value;
        var estado_pre10 = document.getElementById('estado_pre10').value;
        
        if(pay_amount == '0.00'){
            
            rever_prepaid();
            
        }      
        
        //PREPAID (SI HAY PAGOS PREPAGADOS)
        
        if(pay_amount > "0.00"){            
            
                    
            if(no_prep == '1' && estado_pre1 == 'temp_pre1'){                 
                
                
                var vacio = "";
                var cero ='0.00';
             
                $("#no_prep").val(0);
                $("#pago_pre1").val(0);
                $("#pagopre1").val(vacio);
                $("#tipo_pagopre1").val(vacio);
                $("#pagadopre1").val(cero);
                $("#pago_driver").val((0).toFixed(2));
                $("#pago_driver2").val((0).toFixed(2));
                $("#prepaid").val(pay_amount);                 
                $("#temp_prepaid").val((0).toFixed(2));                
                $("#temp").val((0).toFixed(2));
                //$("#estado_pre1").val(vacio); 
                document.getElementById('estado_pre1').value = "";
                document.getElementById('btnPagolinea').style.display = 'none';

                calcularTotalPago();
                
                document.getElementById("btndecline").style.display = "none"; 
                document.getElementById("btncancol").style.display = "none"; 
                document.getElementById("btnAceptar").disabled = true;
                document.getElementById("btnAceptar").style.background = "lightgray";
                ventana2.style.display = "none"; // Y lo hacemos invisible
            }

            if(no_prep == '2' && estado_pre2 == 'temp_pre2'){  
                
                var tipo_pagopre2 = document.getElementById('tipo_pagopre2').value;
                var pagadopre2 = document.getElementById('pagadopre2').value;
                var temp = parseFloat($("#temp").val());
                var temp_prepaid = parseFloat($("#temp_prepaid").val());
                
                var vacio = '';
                var cero = '0.00';  
                
                if(tipo_pagopre2 == 'CREDIT CARD WITH FEE'){
                    
                    var temporal = parseFloat(pagadopre2) - parseFloat(pagadopre2/1.04); 
                    
                    $("#no_prep").val(1);
                    $("#pago_pre2").val(0);
                    $("#pagopre2").val(vacio);
                    $("#tipo_pagopre2").val(vacio);
                    $("#pagadopre2").val(cero);
                    $("#pago_driver").val((0).toFixed(2));
                    $("#pago_driver2").val((0).toFixed(2));
                    $("#prepaid").val(pay_amount);
                    $("#temp_prepaid").val((temp_prepaid-temporal).toFixed(2));  
                    $("#temp").val((temp-temporal).toFixed(2));                    
                    document.getElementById('estado_pre2').value = "";
                    document.getElementById('btnPagolinea').style.display = 'none';
                    calcularTotalPago();    
                    
                    document.getElementById("btndecline").style.display = "none"; 
                    document.getElementById("btncancol").style.display = "none"; 
                    document.getElementById("btnAceptar").disabled = true;
                    document.getElementById("btnAceptar").style.background = "lightgray";
                    ventana2.style.display = "none"; // Y lo hacemos invisible
                    
                }
                
                if(tipo_pagopre2 == 'CREDIT CARD NO FEE' || tipo_pagopre2 == 'CASH' || tipo_pagopre2 == 'CHECK'){
                    
                    var temporal = 0;                 
                    $("#no_prep").val(1);
                    $("#pago_pre2").val(0);
                    $("#pagopre2").val(vacio);
                    $("#tipo_pagopre2").val(vacio);
                    $("#pagadopre2").val(cero);
                    $("#pago_driver").val((0).toFixed(2));
                    $("#pago_driver2").val((0).toFixed(2));
                    $("#prepaid").val(pay_amount);
                    $("#temp_prepaid").val((temp_prepaid-temporal).toFixed(2));  
                    $("#temp").val((temp-temporal).toFixed(2));                    
                    document.getElementById('estado_pre2').value = "";
                    document.getElementById('btnPagolinea').style.display = 'none';
                    calcularTotalPago();   
                    
                    document.getElementById("btndecline").style.display = "none"; 
                    document.getElementById("btncancol").style.display = "none"; 
                    document.getElementById("btnAceptar").disabled = true;
                    document.getElementById("btnAceptar").style.background = "lightgray";
                    ventana2.style.display = "none"; // Y lo hacemos invisible
                    
                }                      
                
                
            }

            if(no_prep == '3' && estado_pre3 == 'temp_pre3'){  
                
                var tipo_pagopre3 = document.getElementById('tipo_pagopre3').value;
                var pagadopre3 = document.getElementById('pagadopre3').value;
                var temp = parseFloat($("#temp").val());
                var temp_prepaid = parseFloat($("#temp_prepaid").val());
                
                var vacio = '';
                var cero = '0.00';  
                
                if(tipo_pagopre3 == 'CREDIT CARD WITH FEE'){
                    
                    var temporal = parseFloat(pagadopre3) - parseFloat(pagadopre3/1.04); 
                    
                    $("#no_prep").val(2);
                    $("#pago_pre3").val(0);
                    $("#pagopre3").val(vacio);
                    $("#tipo_pagopre3").val(vacio);
                    $("#pagadopre3").val(cero);
                    $("#pago_driver").val((0).toFixed(2));
                    $("#pago_driver2").val((0).toFixed(2));
                    $("#prepaid").val(pay_amount);
                    $("#temp_prepaid").val((temp_prepaid-temporal).toFixed(2));  
                    $("#temp").val((temp-temporal).toFixed(2));                    
                    document.getElementById('estado_pre3').value = "";
                    document.getElementById('btnPagolinea').style.display = 'none';
                    calcularTotalPago();    
                    
                    document.getElementById("btndecline").style.display = "none"; 
                    document.getElementById("btncancol").style.display = "none"; 
                    document.getElementById("btnAceptar").disabled = true;
                    document.getElementById("btnAceptar").style.background = "lightgray";
                    ventana2.style.display = "none"; // Y lo hacemos invisible
                    
                }
                
                if(tipo_pagopre3 == 'CREDIT CARD NO FEE' || tipo_pagopre3 == 'CASH' || tipo_pagopre3 == 'CHECK'){
                    
                    var temporal = 0;                 
                    $("#no_prep").val(2);
                    $("#pago_pre3").val(0);
                    $("#pagopre3").val(vacio);
                    $("#tipo_pagopre3").val(vacio);
                    $("#pagadopre3").val(cero);
                    $("#pago_driver").val((0).toFixed(2));
                    $("#pago_driver2").val((0).toFixed(2));
                    $("#prepaid").val(pay_amount);
                    $("#temp_prepaid").val((temp_prepaid-temporal).toFixed(2));  
                    $("#temp").val((temp-temporal).toFixed(2));                    
                    document.getElementById('estado_pre3').value = "";
                    document.getElementById('btnPagolinea').style.display = 'none';
                    calcularTotalPago();   
                    
                    document.getElementById("btndecline").style.display = "none"; 
                    document.getElementById("btncancol").style.display = "none"; 
                    document.getElementById("btnAceptar").disabled = true;
                    document.getElementById("btnAceptar").style.background = "lightgray";
                    ventana2.style.display = "none"; // Y lo hacemos invisible
                    
                }                      
                
            }

            if(no_prep == '4' && estado_pre4 == 'temp_pre4'){ 
                
                var tipo_pagopre4 = document.getElementById('tipo_pagopre4').value;
                var pagadopre4 = document.getElementById('pagadopre4').value;
                var temp = parseFloat($("#temp").val());
                var temp_prepaid = parseFloat($("#temp_prepaid").val());
                
                var vacio = '';
                var cero = '0.00';  
                
                if(tipo_pagopre4 == 'CREDIT CARD WITH FEE'){
                    
                    var temporal = parseFloat(pagadopre4) - parseFloat(pagadopre4/1.04); 
                    
                    $("#no_prep").val(3);
                    $("#pago_pre4").val(0);
                    $("#pagopre4").val(vacio);
                    $("#tipo_pagopre4").val(vacio);
                    $("#pagadopre4").val(cero);
                    $("#pago_driver").val((0).toFixed(2));
                    $("#pago_driver2").val((0).toFixed(2));
                    $("#prepaid").val(pay_amount);
                    $("#temp_prepaid").val((temp_prepaid-temporal).toFixed(2));  
                    $("#temp").val((temp-temporal).toFixed(2));                    
                    document.getElementById('estado_pre4').value = "";
                    document.getElementById('btnPagolinea').style.display = 'none';
                    calcularTotalPago();    
                    
                    document.getElementById("btndecline").style.display = "none"; 
                    document.getElementById("btncancol").style.display = "none"; 
                    document.getElementById("btnAceptar").disabled = true;
                    document.getElementById("btnAceptar").style.background = "lightgray";
                    ventana2.style.display = "none"; // Y lo hacemos invisible
                    
                }
                
                if(tipo_pagopre4 == 'CREDIT CARD NO FEE' || tipo_pagopre4 == 'CASH' || tipo_pagopre4 == 'CHECK'){
                    
                    var temporal = 0;                 
                    $("#no_prep").val(3);
                    $("#pago_pre4").val(0);
                    $("#pagopre4").val(vacio);
                    $("#tipo_pagopre4").val(vacio);
                    $("#pagadopre4").val(cero);
                    $("#pago_driver").val((0).toFixed(2));
                    $("#pago_driver2").val((0).toFixed(2));
                    $("#prepaid").val(pay_amount);
                    $("#temp_prepaid").val((temp_prepaid-temporal).toFixed(2));  
                    $("#temp").val((temp-temporal).toFixed(2));                    
                    document.getElementById('estado_pre4').value = "";
                    document.getElementById('btnPagolinea').style.display = 'none';
                    calcularTotalPago();   
                    
                    document.getElementById("btndecline").style.display = "none"; 
                    document.getElementById("btncancol").style.display = "none"; 
                    document.getElementById("btnAceptar").disabled = true;
                    document.getElementById("btnAceptar").style.background = "lightgray";
                    ventana2.style.display = "none"; // Y lo hacemos invisible
                    
                }                      
                
            }

            if(no_prep == '5' && estado_pre5 == 'temp_pre5'){                   
                
                var tipo_pagopre5 = document.getElementById('tipo_pagopre5').value;
                var pagadopre5 = document.getElementById('pagadopre5').value;
                var temp = parseFloat($("#temp").val());
                var temp_prepaid = parseFloat($("#temp_prepaid").val());
                
                var vacio = '';
                var cero = '0.00';  
                
                if(tipo_pagopre5 == 'CREDIT CARD WITH FEE'){
                    
                    var temporal = parseFloat(pagadopre5) - parseFloat(pagadopre5/1.04); 
                    
                    $("#no_prep").val(4);
                    $("#pago_pre5").val(0);
                    $("#pagopre5").val(vacio);
                    $("#tipo_pagopre5").val(vacio);
                    $("#pagadopre5").val(cero);
                    $("#pago_driver").val((0).toFixed(2));
                    $("#pago_driver2").val((0).toFixed(2));
                    $("#prepaid").val(pay_amount);
                    $("#temp_prepaid").val((temp_prepaid-temporal).toFixed(2));  
                    $("#temp").val((temp-temporal).toFixed(2));                    
                    document.getElementById('estado_pre5').value = "";
                    document.getElementById('btnPagolinea').style.display = 'none';
                    calcularTotalPago();    
                    
                    document.getElementById("btndecline").style.display = "none"; 
                    document.getElementById("btncancol").style.display = "none"; 
                    document.getElementById("btnAceptar").disabled = true;
                    document.getElementById("btnAceptar").style.background = "lightgray";
                    ventana2.style.display = "none"; // Y lo hacemos invisible
                    
                }
                
                if(tipo_pagopre5 == 'CREDIT CARD NO FEE' || tipo_pagopre5 == 'CASH' || tipo_pagopre5 == 'CHECK'){
                    
                    var temporal = 0;                 
                    $("#no_prep").val(4);
                    $("#pago_pre5").val(0);
                    $("#pagopre5").val(vacio);
                    $("#tipo_pagopre5").val(vacio);
                    $("#pagadopre5").val(cero);
                    $("#pago_driver").val((0).toFixed(2));
                    $("#pago_driver2").val((0).toFixed(2));
                    $("#prepaid").val(pay_amount);
                    $("#temp_prepaid").val((temp_prepaid-temporal).toFixed(2));  
                    $("#temp").val((temp-temporal).toFixed(2));                    
                    document.getElementById('estado_pre5').value = "";
                    document.getElementById('btnPagolinea').style.display = 'none';
                    calcularTotalPago();   
                    
                    document.getElementById("btndecline").style.display = "none"; 
                    document.getElementById("btncancol").style.display = "none"; 
                    document.getElementById("btnAceptar").disabled = true;
                    document.getElementById("btnAceptar").style.background = "lightgray";
                    ventana2.style.display = "none"; // Y lo hacemos invisible
                    
                }                      
                
            }

            if(no_prep == '6' && estado_pre6 == 'temp_pre6'){  
                
                var tipo_pagopre6 = document.getElementById('tipo_pagopre6').value;
                var pagadopre6 = document.getElementById('pagadopre6').value;
                var temp = parseFloat($("#temp").val());
                var temp_prepaid = parseFloat($("#temp_prepaid").val());
                
                var vacio = '';
                var cero = '0.00';  
                
                if(tipo_pagopre6 == 'CREDIT CARD WITH FEE'){
                    
                    var temporal = parseFloat(pagadopre6) - parseFloat(pagadopre6/1.04); 
                    
                    $("#no_prep").val(5);
                    $("#pago_pre6").val(0);
                    $("#pagopre6").val(vacio);
                    $("#tipo_pagopre6").val(vacio);
                    $("#pagadopre6").val(cero);
                    $("#pago_driver").val((0).toFixed(2));
                    $("#pago_driver2").val((0).toFixed(2));
                    $("#prepaid").val(pay_amount);
                    $("#temp_prepaid").val((temp_prepaid-temporal).toFixed(2));  
                    $("#temp").val((temp-temporal).toFixed(2));                    
                    document.getElementById('estado_pre6').value = "";
                    document.getElementById('btnPagolinea').style.display = 'none';
                    calcularTotalPago();    
                    
                    document.getElementById("btndecline").style.display = "none"; 
                    document.getElementById("btncancol").style.display = "none"; 
                    document.getElementById("btnAceptar").disabled = true;
                    document.getElementById("btnAceptar").style.background = "lightgray";
                    ventana2.style.display = "none"; // Y lo hacemos invisible
                    
                }
                
                if(tipo_pagopre6 == 'CREDIT CARD NO FEE' || tipo_pagopre6 == 'CASH' || tipo_pagopre6 == 'CHECK'){
                    
                    var temporal = 0;                 
                    $("#no_prep").val(5);
                    $("#pago_pre6").val(0);
                    $("#pagopre6").val(vacio);
                    $("#tipo_pagopre6").val(vacio);
                    $("#pagadopre6").val(cero);
                    $("#pago_driver").val((0).toFixed(2));
                    $("#pago_driver2").val((0).toFixed(2));
                    $("#prepaid").val(pay_amount);
                    $("#temp_prepaid").val((temp_prepaid-temporal).toFixed(2));  
                    $("#temp").val((temp-temporal).toFixed(2));                    
                    document.getElementById('estado_pre6').value = "";
                    document.getElementById('btnPagolinea').style.display = 'none';
                    calcularTotalPago();   
                    
                    document.getElementById("btndecline").style.display = "none"; 
                    document.getElementById("btncancol").style.display = "none"; 
                    document.getElementById("btnAceptar").disabled = true;
                    document.getElementById("btnAceptar").style.background = "lightgray";
                    ventana2.style.display = "none"; // Y lo hacemos invisible
                    
                }                      
                
            }

            if(no_prep == '7' && estado_pre7 == 'temp_pre7'){ 
                
                var tipo_pagopre7 = document.getElementById('tipo_pagopre7').value;
                var pagadopre7 = document.getElementById('pagadopre7').value;
                var temp = parseFloat($("#temp").val());
                var temp_prepaid = parseFloat($("#temp_prepaid").val());
                
                var vacio = '';
                var cero = '0.00';  
                
                if(tipo_pagopre7 == 'CREDIT CARD WITH FEE'){
                    
                    var temporal = parseFloat(pagadopre7) - parseFloat(pagadopre7/1.04); 
                    
                    $("#no_prep").val(6);
                    $("#pago_pre7").val(0);
                    $("#pagopre7").val(vacio);
                    $("#tipo_pagopre7").val(vacio);
                    $("#pagadopre7").val(cero);
                    $("#pago_driver").val((0).toFixed(2));
                    $("#pago_driver2").val((0).toFixed(2));
                    $("#prepaid").val(pay_amount);
                    $("#temp_prepaid").val((temp_prepaid-temporal).toFixed(2));  
                    $("#temp").val((temp-temporal).toFixed(2));                    
                    document.getElementById('estado_pre7').value = "";
                    document.getElementById('btnPagolinea').style.display = 'none';
                    calcularTotalPago();    
                    
                    document.getElementById("btndecline").style.display = "none"; 
                    document.getElementById("btncancol").style.display = "none"; 
                    document.getElementById("btnAceptar").disabled = true;
                    document.getElementById("btnAceptar").style.background = "lightgray";
                    ventana2.style.display = "none"; // Y lo hacemos invisible
                    
                }
                
                if(tipo_pagopre7 == 'CREDIT CARD NO FEE' || tipo_pagopre7 == 'CASH' || tipo_pagopre7 == 'CHECK'){
                    
                    var temporal = 0;                 
                    $("#no_prep").val(6);
                    $("#pago_pre7").val(0);
                    $("#pagopre7").val(vacio);
                    $("#tipo_pagopre7").val(vacio);
                    $("#pagadopre7").val(cero);
                    $("#pago_driver").val((0).toFixed(2));
                    $("#pago_driver2").val((0).toFixed(2));
                    $("#prepaid").val(pay_amount);
                    $("#temp_prepaid").val((temp_prepaid-temporal).toFixed(2));  
                    $("#temp").val((temp-temporal).toFixed(2));                    
                    document.getElementById('estado_pre7').value = "";
                    document.getElementById('btnPagolinea').style.display = 'none';
                    calcularTotalPago();   
                    
                    document.getElementById("btndecline").style.display = "none"; 
                    document.getElementById("btncancol").style.display = "none"; 
                    document.getElementById("btnAceptar").disabled = true;
                    document.getElementById("btnAceptar").style.background = "lightgray";
                    ventana2.style.display = "none"; // Y lo hacemos invisible
                    
                }                      
                
            }

            if(no_prep == '8' && estado_pre8 == 'temp_pre8'){ 
                
                var tipo_pagopre8 = document.getElementById('tipo_pagopre8').value;
                var pagadopre8 = document.getElementById('pagadopre8').value;
                var temp = parseFloat($("#temp").val());
                var temp_prepaid = parseFloat($("#temp_prepaid").val());
                
                var vacio = '';
                var cero = '0.00';  
                
                if(tipo_pagopre8 == 'CREDIT CARD WITH FEE'){
                    
                    var temporal = parseFloat(pagadopre8) - parseFloat(pagadopre8/1.04); 
                    
                    $("#no_prep").val(7);
                    $("#pago_pre8").val(0);
                    $("#pagopre8").val(vacio);
                    $("#tipo_pagopre8").val(vacio);
                    $("#pagadopre8").val(cero);
                    $("#pago_driver").val((0).toFixed(2));
                    $("#pago_driver2").val((0).toFixed(2));
                    $("#prepaid").val(pay_amount);
                    $("#temp_prepaid").val((temp_prepaid-temporal).toFixed(2));  
                    $("#temp").val((temp-temporal).toFixed(2));                    
                    document.getElementById('estado_pre8').value = "";
                    document.getElementById('btnPagolinea').style.display = 'none';
                    calcularTotalPago();    
                    
                    document.getElementById("btndecline").style.display = "none"; 
                    document.getElementById("btncancol").style.display = "none"; 
                    document.getElementById("btnAceptar").disabled = true;
                    document.getElementById("btnAceptar").style.background = "lightgray";
                    ventana2.style.display = "none"; // Y lo hacemos invisible
                    
                }
                
                if(tipo_pagopre8 == 'CREDIT CARD NO FEE' || tipo_pagopre8 == 'CASH' || tipo_pagopre8 == 'CHECK'){
                    
                    var temporal = 0;                 
                    $("#no_prep").val(7);
                    $("#pago_pre8").val(0);
                    $("#pagopre8").val(vacio);
                    $("#tipo_pagopre8").val(vacio);
                    $("#pagadopre8").val(cero);
                    $("#pago_driver").val((0).toFixed(2));
                    $("#pago_driver2").val((0).toFixed(2));
                    $("#prepaid").val(pay_amount);
                    $("#temp_prepaid").val((temp_prepaid-temporal).toFixed(2));  
                    $("#temp").val((temp-temporal).toFixed(2));                    
                    document.getElementById('estado_pre8').value = "";
                    document.getElementById('btnPagolinea').style.display = 'none';
                    calcularTotalPago();   
                    
                    document.getElementById("btndecline").style.display = "none"; 
                    document.getElementById("btncancol").style.display = "none"; 
                    document.getElementById("btnAceptar").disabled = true;
                    document.getElementById("btnAceptar").style.background = "lightgray";
                    ventana2.style.display = "none"; // Y lo hacemos invisible
                    
                }                      
                
            }

            if(no_prep == '9' && estado_pre9 == 'temp_pre9'){ 
                
                var tipo_pagopre9 = document.getElementById('tipo_pagopre9').value;
                var pagadopre9 = document.getElementById('pagadopre9').value;
                var temp = parseFloat($("#temp").val());
                var temp_prepaid = parseFloat($("#temp_prepaid").val());
                
                var vacio = '';
                var cero = '0.00';  
                
                if(tipo_pagopre9 == 'CREDIT CARD WITH FEE'){
                    
                    var temporal = parseFloat(pagadopre9) - parseFloat(pagadopre9/1.04); 
                    
                    $("#no_prep").val(8);
                    $("#pago_pre9").val(0);
                    $("#pagopre9").val(vacio);
                    $("#tipo_pagopre9").val(vacio);
                    $("#pagadopre9").val(cero);
                    $("#pago_driver").val((0).toFixed(2));
                    $("#pago_driver2").val((0).toFixed(2));
                    $("#prepaid").val(pay_amount);
                    $("#temp_prepaid").val((temp_prepaid-temporal).toFixed(2));  
                    $("#temp").val((temp-temporal).toFixed(2));                    
                    document.getElementById('estado_pre9').value = "";
                    document.getElementById('btnPagolinea').style.display = 'none';
                    calcularTotalPago();    
                    
                    document.getElementById("btndecline").style.display = "none"; 
                    document.getElementById("btncancol").style.display = "none"; 
                    document.getElementById("btnAceptar").disabled = true;
                    document.getElementById("btnAceptar").style.background = "lightgray";
                    ventana2.style.display = "none"; // Y lo hacemos invisible
                    
                }
                
                if(tipo_pagopre9 == 'CREDIT CARD NO FEE' || tipo_pagopre9 == 'CASH' || tipo_pagopre9 == 'CHECK'){
                    
                    var temporal = 0;                 
                    $("#no_prep").val(8);
                    $("#pago_pre9").val(0);
                    $("#pagopre9").val(vacio);
                    $("#tipo_pagopre9").val(vacio);
                    $("#pagadopre9").val(cero);
                    $("#pago_driver").val((0).toFixed(2));
                    $("#pago_driver2").val((0).toFixed(2));
                    $("#prepaid").val(pay_amount);
                    $("#temp_prepaid").val((temp_prepaid-temporal).toFixed(2));  
                    $("#temp").val((temp-temporal).toFixed(2));                    
                    document.getElementById('estado_pre9').value = "";
                    document.getElementById('btnPagolinea').style.display = 'none';
                    calcularTotalPago();   
                    
                    document.getElementById("btndecline").style.display = "none"; 
                    document.getElementById("btncancol").style.display = "none"; 
                    document.getElementById("btnAceptar").disabled = true;
                    document.getElementById("btnAceptar").style.background = "lightgray";
                    ventana2.style.display = "none"; // Y lo hacemos invisible
                    
                }                      
                
            }  

            if(no_prep == '10' && estado_pre10 == 'temp_pre10'){  
                
                var tipo_pagopre10 = document.getElementById('tipo_pagopre10').value;
                var pagadopre10 = document.getElementById('pagadopre10').value;
                var temp = parseFloat($("#temp").val());
                var temp_prepaid = parseFloat($("#temp_prepaid").val());
                
                var vacio = '';
                var cero = '0.00';  
                
                if(tipo_pagopre10 == 'CREDIT CARD WITH FEE'){
                    
                    var temporal = parseFloat(pagadopre10) - parseFloat(pagadopre10/1.04); 
                    
                    $("#no_prep").val(9);
                    $("#pago_pre10").val(0);
                    $("#pagopre10").val(vacio);
                    $("#tipo_pagopre10").val(vacio);
                    $("#pagadopre10").val(cero);
                    $("#pago_driver").val((0).toFixed(2));
                    $("#pago_driver2").val((0).toFixed(2));
                    $("#prepaid").val(pay_amount);
                    $("#temp_prepaid").val((temp_prepaid-temporal).toFixed(2));  
                    $("#temp").val((temp-temporal).toFixed(2));                    
                    document.getElementById('estado_pre10').value = "";
                    document.getElementById('btnPagolinea').style.display = 'none';
                    calcularTotalPago();    
                    
                    document.getElementById("btndecline").style.display = "none"; 
                    document.getElementById("btncancol").style.display = "none"; 
                    document.getElementById("btnAceptar").disabled = true;
                    document.getElementById("btnAceptar").style.background = "lightgray";
                    ventana2.style.display = "none"; // Y lo hacemos invisible
                    
                }
                
                if(tipo_pagopre10 == 'CREDIT CARD NO FEE' || tipo_pagopre10 == 'CASH' || tipo_pagopre10 == 'CHECK'){
                    
                    var temporal = 0;                 
                    $("#no_prep").val(9);
                    $("#pago_pre10").val(0);
                    $("#pagopre10").val(vacio);
                    $("#tipo_pagopre10").val(vacio);
                    $("#pagadopre10").val(cero);
                    $("#pago_driver").val((0).toFixed(2));
                    $("#pago_driver2").val((0).toFixed(2));
                    $("#prepaid").val(pay_amount);
                    $("#temp_prepaid").val((temp_prepaid-temporal).toFixed(2));  
                    $("#temp").val((temp-temporal).toFixed(2));                    
                    document.getElementById('estado_pre10').value = "";
                    document.getElementById('btnPagolinea').style.display = 'none';
                    calcularTotalPago();   
                    
                    document.getElementById("btndecline").style.display = "none"; 
                    document.getElementById("btncancol").style.display = "none"; 
                    document.getElementById("btnAceptar").disabled = true;
                    document.getElementById("btnAceptar").style.background = "lightgray";
                    ventana2.style.display = "none"; // Y lo hacemos invisible
                    
                }                      
                
            }        
            
            
        }        
        

        
    }
    
</script>

<script type="text/javascript">
    
    function Exit_Cob()
    {
        var ventana2 = document.getElementById('miVentana2'); // Accedemos al contenedor
        var paid_driver = document.getElementById('paid_driver').value; 
        var no_pago = document.getElementById('no_pago').value; 
        var pago_driver2 = document.getElementById('pago_driver2').value;
        var collect = document.getElementById('collect').value;
        var temp_driver = document.getElementById('temp_driver').value;
        
        var estado_cob1 = document.getElementById('estado_cob1').value;
        var estado_cob2 = document.getElementById('estado_cob2').value;
        var estado_cob3 = document.getElementById('estado_cob3').value;
        var estado_cob4 = document.getElementById('estado_cob4').value;
        var estado_cob5 = document.getElementById('estado_cob5').value;
        var estado_cob6 = document.getElementById('estado_cob6').value;
        var estado_cob7 = document.getElementById('estado_cob7').value;
        var estado_cob8 = document.getElementById('estado_cob8').value;
        var estado_cob9 = document.getElementById('estado_cob9').value;
        var estado_cob10 = document.getElementById('estado_cob10').value;
        
        if(paid_driver == '0.00'){            
            
            rever_collect_on_board();            
            
        }
        
        //COLLECT ON BOARD (SI HAY PAGOS AL CONDUCTOR)
        
        if(paid_driver > '0.00'){
            
            var vacio = "";
            var cero ='0.00';
            
            if(no_pago == '1' && estado_cob1 == 'temp_cob1'){  
                
                var vacio = '';
                var cero = '0.00';
                
                $("#no_pago").val(0);
                $("#pago_1").val(0);
                $("#pago1").val(vacio);
                $("#tipo_pago1").val(vacio);
                $("#pagado1").val(cero);
                $("#pago_driver2").val((0).toFixed(2));
                $("#collect").val(paid_driver);
                //$("#temp_driver").val((temp_driver1).toFixed(2));                
                //$("#temp").val((temp_fee).toFixed(2));
                //$("#estado_cob1").val(vacio);
                document.getElementById('estado_cob1').value = "";
                
                calcularTotalPago();
                
                document.getElementById("btndecline").style.display = "none"; 
                document.getElementById("btncancol").style.display = "none"; 
                document.getElementById("btnAceptar").disabled = true;
                document.getElementById("btnAceptar").style.background = "lightgray";        
                ventana2.style.display = 'none'; // Y lo hacemos invisible
                
            }
            
            if(no_pago == '2' && estado_cob2 == 'temp_cob2'){ 
                
                var tipo_pago2 = document.getElementById('tipo_pago2').value;
                var pagado2 = document.getElementById('pagado2').value;
                var temp = parseFloat($("#temp").val());
                var temp_driver = parseFloat($("#temp_driver").val());
                
                var vacio = '';
                var cero = '0.00';  
                
                
                if(tipo_pago2 == 'CREDIT CARD WITH FEE'){
                    
                    var temporal = parseFloat(pagado2) - parseFloat(pagado2/1.04);                 
                    $("#no_pago").val(1);
                    $("#pago_2").val(0);
                    $("#pago2").val(vacio);
                    $("#tipo_pago2").val(vacio);
                    $("#pagado2").val(cero);
                    $("#pago_driver2").val((0).toFixed(2));
                    $("#collect").val(paid_driver);
                    $("#temp_driver").val((temp_driver-temporal).toFixed(2));  
                    $("#temp").val((temp-temporal).toFixed(2));                    
                    document.getElementById('estado_cob2').value = "";
                    //document.getElementById('btnPagolinea').style.display = 'none';                    
                    calcularTotalPago();   
                    
                    document.getElementById("btndecline").style.display = "none"; 
                    document.getElementById("btncancol").style.display = "none"; 
                    document.getElementById("btnAceptar").disabled = true;
                    document.getElementById("btnAceptar").style.background = "lightgray";        
                    ventana2.style.display = 'none'; // Y lo hacemos invisible
                    
                }                 
                                
                if(tipo_pago2 == 'CREDIT CARD NO FEE' || tipo_pago2 == 'CASH' || tipo_pago2 == 'CHECK'){
                    
                    var temporal = 0;                 
                    $("#no_pago").val(1);
                    $("#pago_2").val(0);
                    $("#pago2").val(vacio);
                    $("#tipo_pago2").val(vacio);
                    $("#pagado2").val(cero);
                    $("#pago_driver2").val((0).toFixed(2));
                    $("#collect").val(paid_driver);
                    $("#temp_driver").val((temp_driver-temporal).toFixed(2));  
                    $("#temp").val((temp-temporal).toFixed(2));                    
                    document.getElementById('estado_cob2').value = "";
                    calcularTotalPago();
                    
                    document.getElementById("btndecline").style.display = "none"; 
                    document.getElementById("btncancol").style.display = "none"; 
                    document.getElementById("btnAceptar").disabled = true;
                    document.getElementById("btnAceptar").style.background = "lightgray";        
                    ventana2.style.display = 'none'; // Y lo hacemos invisible
                    
                }              
                
                
            }
            
            
            if(no_pago == '3' && estado_cob3 == 'temp_cob3'){ 
                
                var tipo_pago3 = document.getElementById('tipo_pago3').value;
                var pagado3 = document.getElementById('pagado3').value;
                var temp = parseFloat($("#temp").val());
                var temp_driver = parseFloat($("#temp_driver").val());
                
                var vacio = '';
                var cero = '0.00';  
                
                
                if(tipo_pago3 == 'CREDIT CARD WITH FEE'){
                    
                    var temporal = parseFloat(pagado3) - parseFloat(pagado3/1.04);                 
                    $("#no_pago").val(2);
                    $("#pago_3").val(0);
                    $("#pago3").val(vacio);
                    $("#tipo_pago3").val(vacio);
                    $("#pagado3").val(cero);
                    $("#pago_driver2").val((0).toFixed(2));
                    $("#collect").val(paid_driver);
                    $("#temp_driver").val((temp_driver-temporal).toFixed(2));  
                    $("#temp").val((temp-temporal).toFixed(2));                    
                    document.getElementById('estado_cob3').value = "";
                    calcularTotalPago();  
                    
                    document.getElementById("btndecline").style.display = "none"; 
                    document.getElementById("btncancol").style.display = "none"; 
                    document.getElementById("btnAceptar").disabled = true;
                    document.getElementById("btnAceptar").style.background = "lightgray";        
                    ventana2.style.display = 'none'; // Y lo hacemos invisible
                    
                }                 
                                
                if(tipo_pago3 == 'CREDIT CARD NO FEE' || tipo_pago3 == 'CASH' || tipo_pago3 == 'CHECK'){
                    
                    var temporal = 0;                 
                    $("#no_pago").val(2);
                    $("#pago_3").val(0);
                    $("#pago3").val(vacio);
                    $("#tipo_pago3").val(vacio);
                    $("#pagado3").val(cero);
                    $("#pago_driver2").val((0).toFixed(2));
                    $("#collect").val(paid_driver);
                    $("#temp_driver").val((temp_driver-temporal).toFixed(2));  
                    $("#temp").val((temp-temporal).toFixed(2));                    
                    document.getElementById('estado_cob3').value = "";
                    calcularTotalPago();  
                    
                    document.getElementById("btndecline").style.display = "none"; 
                    document.getElementById("btncancol").style.display = "none"; 
                    document.getElementById("btnAceptar").disabled = true;
                    document.getElementById("btnAceptar").style.background = "lightgray";        
                    ventana2.style.display = 'none'; // Y lo hacemos invisible
                    
                }              
                
                
            }
            
            if(no_pago == '4' && estado_cob4 == 'temp_cob4'){ 
                
                var tipo_pago4 = document.getElementById('tipo_pago4').value;
                var pagado4 = document.getElementById('pagado4').value;
                var temp = parseFloat($("#temp").val());
                var temp_driver = parseFloat($("#temp_driver").val());
                
                var vacio = '';
                var cero = '0.00';  
                
                
                if(tipo_pago4 == 'CREDIT CARD WITH FEE'){
                    
                    var temporal = parseFloat(pagado4) - parseFloat(pagado4/1.04);                 
                    $("#no_pago").val(3);
                    $("#pago_4").val(0);
                    $("#pago4").val(vacio);
                    $("#tipo_pago4").val(vacio);
                    $("#pagado4").val(cero);
                    $("#pago_driver4").val((0).toFixed(2));
                    $("#collect").val(paid_driver);
                    $("#temp_driver").val((temp_driver-temporal).toFixed(2));  
                    $("#temp").val((temp-temporal).toFixed(2));                    
                    document.getElementById('estado_cob4').value = "";
                    calcularTotalPago(); 
                    
                    document.getElementById("btndecline").style.display = "none"; 
                    document.getElementById("btncancol").style.display = "none"; 
                    document.getElementById("btnAceptar").disabled = true;
                    document.getElementById("btnAceptar").style.background = "lightgray";        
                    ventana2.style.display = 'none'; // Y lo hacemos invisible
                    
                }                 
                                
                if(tipo_pago4 == 'CREDIT CARD NO FEE' || tipo_pago4 == 'CASH' || tipo_pago4 == 'CHECK'){
                    
                    var temporal = 0;                 
                    $("#no_pago").val(3);
                    $("#pago_4").val(0);
                    $("#pago4").val(vacio);
                    $("#tipo_pago4").val(vacio);
                    $("#pagado4").val(cero);
                    $("#pago_driver2").val((0).toFixed(2));
                    $("#collect").val(paid_driver);
                    $("#temp_driver").val((temp_driver-temporal).toFixed(2));  
                    $("#temp").val((temp-temporal).toFixed(2));                    
                    document.getElementById('estado_cob4').value = "";
                    calcularTotalPago();   
                    
                    document.getElementById("btndecline").style.display = "none"; 
                    document.getElementById("btncancol").style.display = "none"; 
                    document.getElementById("btnAceptar").disabled = true;
                    document.getElementById("btnAceptar").style.background = "lightgray";        
                    ventana2.style.display = 'none'; // Y lo hacemos invisible
                    
                }              
                
                
            }
            
            if(no_pago == '5' && estado_cob5 == 'temp_cob5'){ 
                
                var tipo_pago5 = document.getElementById('tipo_pago5').value;
                var pagado5 = document.getElementById('pagado5').value;
                var temp = parseFloat($("#temp").val());
                var temp_driver = parseFloat($("#temp_driver").val());
                
                var vacio = '';
                var cero = '0.00';  
                
                
                if(tipo_pago5 == 'CREDIT CARD WITH FEE'){
                    
                    var temporal = parseFloat(pagado5) - parseFloat(pagado5/1.04);                 
                    $("#no_pago").val(4);
                    $("#pago_5").val(0);
                    $("#pago5").val(vacio);
                    $("#tipo_pago5").val(vacio);
                    $("#pagado5").val(cero);
                    $("#pago_driver2").val((0).toFixed(2));
                    $("#collect").val(paid_driver);
                    $("#temp_driver").val((temp_driver-temporal).toFixed(2));  
                    $("#temp").val((temp-temporal).toFixed(2));                    
                    document.getElementById('estado_cob5').value = "";
                    calcularTotalPago();  
                    
                    document.getElementById("btndecline").style.display = "none"; 
                    document.getElementById("btncancol").style.display = "none"; 
                    document.getElementById("btnAceptar").disabled = true;
                    document.getElementById("btnAceptar").style.background = "lightgray";        
                    ventana2.style.display = 'none'; // Y lo hacemos invisible
                    
                }                 
                                
                if(tipo_pago5 == 'CREDIT CARD NO FEE' || tipo_pago5 == 'CASH' || tipo_pago5 == 'CHECK'){
                    
                    var temporal = 0;                 
                    $("#no_pago").val(4);
                    $("#pago_5").val(0);
                    $("#pago5").val(vacio);
                    $("#tipo_pago5").val(vacio);
                    $("#pagado5").val(cero);
                    $("#pago_driver2").val((0).toFixed(2));
                    $("#collect").val(paid_driver);
                    $("#temp_driver").val((temp_driver-temporal).toFixed(2));  
                    $("#temp").val((temp-temporal).toFixed(2));                    
                    document.getElementById('estado_cob5').value = "";
                    calcularTotalPago();  
                    
                    document.getElementById("btndecline").style.display = "none"; 
                    document.getElementById("btncancol").style.display = "none"; 
                    document.getElementById("btnAceptar").disabled = true;
                    document.getElementById("btnAceptar").style.background = "lightgray";        
                    ventana2.style.display = 'none'; // Y lo hacemos invisible
                    
                }              
                
                
            }
            
            if(no_pago == '6' && estado_cob6 == 'temp_cob6'){ 
                
                var tipo_pago6 = document.getElementById('tipo_pago6').value;
                var pagado6 = document.getElementById('pagado6').value;
                var temp = parseFloat($("#temp").val());
                var temp_driver = parseFloat($("#temp_driver").val());
                
                var vacio = '';
                var cero = '0.00';  
                
                
                if(tipo_pago6 == 'CREDIT CARD WITH FEE'){
                    
                    var temporal = parseFloat(pagado6) - parseFloat(pagado6/1.04);                 
                    $("#no_pago").val(5);
                    $("#pago_6").val(0);
                    $("#pago6").val(vacio);
                    $("#tipo_pago6").val(vacio);
                    $("#pagado6").val(cero);
                    $("#pago_driver2").val((0).toFixed(2));
                    $("#collect").val(paid_driver);
                    $("#temp_driver").val((temp_driver-temporal).toFixed(2));  
                    $("#temp").val((temp-temporal).toFixed(2));                    
                    document.getElementById('estado_cob6').value = "";
                    calcularTotalPago();   
                    
                    document.getElementById("btndecline").style.display = "none"; 
                    document.getElementById("btncancol").style.display = "none"; 
                    document.getElementById("btnAceptar").disabled = true;
                    document.getElementById("btnAceptar").style.background = "lightgray";        
                    ventana2.style.display = 'none'; // Y lo hacemos invisible
                    
                }                 
                                
                if(tipo_pago6 == 'CREDIT CARD NO FEE' || tipo_pago6 == 'CASH' || tipo_pago6 == 'CHECK'){
                    
                    var temporal = 0;                 
                    $("#no_pago").val(5);
                    $("#pago_6").val(0);
                    $("#pago6").val(vacio);
                    $("#tipo_pago6").val(vacio);
                    $("#pagado6").val(cero);
                    $("#pago_driver2").val((0).toFixed(2));
                    $("#collect").val(paid_driver);
                    $("#temp_driver").val((temp_driver-temporal).toFixed(2));  
                    $("#temp").val((temp-temporal).toFixed(2));                    
                    document.getElementById('estado_cob6').value = "";
                    calcularTotalPago();                 
                    
                    document.getElementById("btndecline").style.display = "none"; 
                    document.getElementById("btncancol").style.display = "none"; 
                    document.getElementById("btnAceptar").disabled = true;
                    document.getElementById("btnAceptar").style.background = "lightgray";        
                    ventana2.style.display = 'none'; // Y lo hacemos invisible
                }              
                
                
            }
            
            if(no_pago == '7' && estado_cob7 == 'temp_cob7'){ 
                
                var tipo_pago7 = document.getElementById('tipo_pago7').value;
                var pagado7 = document.getElementById('pagado7').value;
                var temp = parseFloat($("#temp").val());
                var temp_driver = parseFloat($("#temp_driver").val());
                
                var vacio = '';
                var cero = '0.00';  
                
                
                if(tipo_pago7 == 'CREDIT CARD WITH FEE'){
                    
                    var temporal = parseFloat(pagado7) - parseFloat(pagado7/1.04);                 
                    $("#no_pago").val(6);
                    $("#pago_7").val(0);
                    $("#pago7").val(vacio);
                    $("#tipo_pago7").val(vacio);
                    $("#pagado7").val(cero);
                    $("#pago_driver2").val((0).toFixed(2));
                    $("#collect").val(paid_driver);
                    $("#temp_driver").val((temp_driver-temporal).toFixed(2));  
                    $("#temp").val((temp-temporal).toFixed(2));                    
                    document.getElementById('estado_cob7').value = "";
                    calcularTotalPago();  
                    
                    document.getElementById("btndecline").style.display = "none"; 
                    document.getElementById("btncancol").style.display = "none"; 
                    document.getElementById("btnAceptar").disabled = true;
                    document.getElementById("btnAceptar").style.background = "lightgray";        
                    ventana2.style.display = 'none'; // Y lo hacemos invisible
                    
                }                 
                                
                if(tipo_pago7 == 'CREDIT CARD NO FEE' || tipo_pago7 == 'CASH' || tipo_pago7 == 'CHECK'){
                    
                    var temporal = 0;                 
                    $("#no_pago").val(6);
                    $("#pago_7").val(0);
                    $("#pago7").val(vacio);
                    $("#tipo_pago7").val(vacio);
                    $("#pagado7").val(cero);
                    $("#pago_driver2").val((0).toFixed(2));
                    $("#collect").val(paid_driver);
                    $("#temp_driver").val((temp_driver-temporal).toFixed(2));  
                    $("#temp").val((temp-temporal).toFixed(2));                    
                    document.getElementById('estado_cob7').value = "";
                    calcularTotalPago(); 
                    
                    document.getElementById("btndecline").style.display = "none"; 
                    document.getElementById("btncancol").style.display = "none"; 
                    document.getElementById("btnAceptar").disabled = true;
                    document.getElementById("btnAceptar").style.background = "lightgray";        
                    ventana2.style.display = 'none'; // Y lo hacemos invisible
                    
                }              
                
                
            }
            
            if(no_pago == '8' && estado_cob8 == 'temp_cob8'){ 
                
                var tipo_pago8 = document.getElementById('tipo_pago8').value;
                var pagado8 = document.getElementById('pagado8').value;
                var temp = parseFloat($("#temp").val());
                var temp_driver = parseFloat($("#temp_driver").val());
                
                var vacio = '';
                var cero = '0.00';  
                
                
                if(tipo_pago8 == 'CREDIT CARD WITH FEE'){
                    
                    var temporal = parseFloat(pagado8) - parseFloat(pagado8/1.04);                 
                    $("#no_pago").val(7);
                    $("#pago_8").val(0);
                    $("#pago8").val(vacio);
                    $("#tipo_pago8").val(vacio);
                    $("#pagado8").val(cero);
                    $("#pago_driver2").val((0).toFixed(2));
                    $("#collect").val(paid_driver);
                    $("#temp_driver").val((temp_driver-temporal).toFixed(2));  
                    $("#temp").val((temp-temporal).toFixed(2));                    
                    document.getElementById('estado_cob8').value = "";
                    calcularTotalPago();   
                    
                    document.getElementById("btndecline").style.display = "none"; 
                    document.getElementById("btncancol").style.display = "none"; 
                    document.getElementById("btnAceptar").disabled = true;
                    document.getElementById("btnAceptar").style.background = "lightgray";        
                    ventana2.style.display = 'none'; // Y lo hacemos invisible
                    
                }                 
                                
                if(tipo_pago8 == 'CREDIT CARD NO FEE' || tipo_pago8 == 'CASH' || tipo_pago8 == 'CHECK'){
                    
                    var temporal = 0;                 
                    $("#no_pago").val(7);
                    $("#pago_8").val(0);
                    $("#pago8").val(vacio);
                    $("#tipo_pago8").val(vacio);
                    $("#pagado8").val(cero);
                    $("#pago_driver2").val((0).toFixed(2));
                    $("#collect").val(paid_driver);
                    $("#temp_driver").val((temp_driver-temporal).toFixed(2));  
                    $("#temp").val((temp-temporal).toFixed(2));                    
                    document.getElementById('estado_cob8').value = "";
                    calcularTotalPago();  
                    
                    document.getElementById("btndecline").style.display = "none"; 
                    document.getElementById("btncancol").style.display = "none"; 
                    document.getElementById("btnAceptar").disabled = true;
                    document.getElementById("btnAceptar").style.background = "lightgray";        
                    ventana2.style.display = 'none'; // Y lo hacemos invisible
                    
                }              
                
                
            }
            
            if(no_pago == '9' && estado_cob9 == 'temp_cob9'){ 
                
                var tipo_pago9 = document.getElementById('tipo_pago9').value;
                var pagado9 = document.getElementById('pagado9').value;
                var temp = parseFloat($("#temp").val());
                var temp_driver = parseFloat($("#temp_driver").val());
                
                var vacio = '';
                var cero = '0.00';  
                
                
                if(tipo_pago9 == 'CREDIT CARD WITH FEE'){
                    
                    var temporal = parseFloat(pagado9) - parseFloat(pagado9/1.04);                 
                    $("#no_pago").val(8);
                    $("#pago_9").val(0);
                    $("#pago9").val(vacio);
                    $("#tipo_pago9").val(vacio);
                    $("#pagado9").val(cero);
                    $("#pago_driver2").val((0).toFixed(2));
                    $("#collect").val(paid_driver);
                    $("#temp_driver").val((temp_driver-temporal).toFixed(2));  
                    $("#temp").val((temp-temporal).toFixed(2));                    
                    document.getElementById('estado_cob9').value = "";
                    calcularTotalPago(); 
                    
                    document.getElementById("btndecline").style.display = "none"; 
                    document.getElementById("btncancol").style.display = "none"; 
                    document.getElementById("btnAceptar").disabled = true;
                    document.getElementById("btnAceptar").style.background = "lightgray";        
                    ventana2.style.display = 'none'; // Y lo hacemos invisible
                    
                }                 
                                
                if(tipo_pago9 == 'CREDIT CARD NO FEE' || tipo_pago9 == 'CASH' || tipo_pago9 == 'CHECK'){
                    
                    var temporal = 0;                 
                    $("#no_pago").val(8);
                    $("#pago_9").val(0);
                    $("#pago9").val(vacio);
                    $("#tipo_pago9").val(vacio);
                    $("#pagado9").val(cero);
                    $("#pago_driver2").val((0).toFixed(2));
                    $("#collect").val(paid_driver);
                    $("#temp_driver").val((temp_driver-temporal).toFixed(2));  
                    $("#temp").val((temp-temporal).toFixed(2));                    
                    document.getElementById('estado_cob9').value = "";
                    calcularTotalPago(); 
                    
                    document.getElementById("btndecline").style.display = "none"; 
                    document.getElementById("btncancol").style.display = "none"; 
                    document.getElementById("btnAceptar").disabled = true;
                    document.getElementById("btnAceptar").style.background = "lightgray";        
                    ventana2.style.display = 'none'; // Y lo hacemos invisible
                    
                }              
                
                
            }
            
            if(no_pago == '10' && estado_cob10 == 'temp_cob10'){ 
                
                var tipo_pago10 = document.getElementById('tipo_pago10').value;
                var pagado10 = document.getElementById('pagado10').value;
                var temp = parseFloat($("#temp").val());
                var temp_driver = parseFloat($("#temp_driver").val());
                
                var vacio = '';
                var cero = '0.00';  
                
                
                if(tipo_pago10 == 'CREDIT CARD WITH FEE'){
                    
                    var temporal = parseFloat(pagado10) - parseFloat(pagado10/1.04);                 
                    $("#no_pago").val(9);
                    $("#pago_10").val(0);
                    $("#pago10").val(vacio);
                    $("#tipo_pago10").val(vacio);
                    $("#pagado10").val(cero);
                    $("#pago_driver2").val((0).toFixed(2));
                    $("#collect").val(paid_driver);
                    $("#temp_driver").val((temp_driver-temporal).toFixed(2));  
                    $("#temp").val((temp-temporal).toFixed(2));                    
                    document.getElementById('estado_cob10').value = "";
                    calcularTotalPago();
                    
                    document.getElementById("btndecline").style.display = "none"; 
                    document.getElementById("btncancol").style.display = "none"; 
                    document.getElementById("btnAceptar").disabled = true;
                    document.getElementById("btnAceptar").style.background = "lightgray";        
                    ventana2.style.display = 'none'; // Y lo hacemos invisible
                    
                }                 
                                
                if(tipo_pago10 == 'CREDIT CARD NO FEE' || tipo_pago10 == 'CASH' || tipo_pago10 == 'CHECK'){
                    
                    var temporal = 0;                 
                    $("#no_pago").val(9);
                    $("#pago_10").val(0);
                    $("#pago10").val(vacio);
                    $("#tipo_pago10").val(vacio);
                    $("#pagado10").val(cero);
                    $("#pago_driver2").val((0).toFixed(2));
                    $("#collect").val(paid_driver);
                    $("#temp_driver").val((temp_driver-temporal).toFixed(2));  
                    $("#temp").val((temp-temporal).toFixed(2));                    
                    document.getElementById('estado_cob10').value = "";
                    calcularTotalPago();                 
                    
                    document.getElementById("btndecline").style.display = "none"; 
                    document.getElementById("btncancol").style.display = "none"; 
                    document.getElementById("btnAceptar").disabled = true;
                    document.getElementById("btnAceptar").style.background = "lightgray";        
                    ventana2.style.display = 'none'; // Y lo hacemos invisible
                }              
                
                
            }     
            
            
        }       
        


    }
</script>



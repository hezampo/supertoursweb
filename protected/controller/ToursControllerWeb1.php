<?php

/**
 * ToursController web
 *
  �ngel Valencia
 */
Doo::loadController('I18nController');
Doo::loadHelper('class.phpmailer');

//print_r($_SESSION ["data_agency"]);

class ToursControllerWeb extends DooController {

    public $data;
    public $flag;
	 public function beforeRun($resource, $action) {

       if (isset($_SESSION['data_agency'])) {

            return "https://www.supertours.com/sistema/agency";

      }

    }
    public function index() {
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        unset($_SESSION["toursbooking"]);
        unset($_SESSION['step_onedaytour_one']);
        unset($_SESSION['onedaytour']);
        unset($_SESSION["grupos"]);
        unset($_SESSION["grupos1"]);
        $this->renderc('/tours/1-day-tour', $this->data);
    }

    public function close_session() {
        // Destruir todas las variables de sesión.
        $_SESSION = array();

        // Si se desea destruir la sesión completamente, borre también la cookie de sesión.
        // Nota: ¡Esto destruirá la sesión, y no la información de la sesión!
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000, $params["path"], $params["domain"], $params["secure"], $params["httponly"]);
        }
        // Finalmente, destruir la sesión.
        session_destroy();
        return Doo::conf()->APP_URL . "";
    }

    public function question() {

        if (isset($_SESSION['data_agency'])) {
            Doo::loadModel("Agency");
            $dat = new Agency($_SESSION['data_agency']);
            $type = $dat->type_rate;
        } else {
            $type = 0;
        }
        try {
            $id = $this->params ["id"];
            $id2 = $this->params ["id2"];

            $tiempo = false;
            $mensaje = '';
            if (isset($this->params ["id3"])) {
                $fecha = $this->params ["id3"];
                list ($mes, $dia, $anyo) = explode("-", $fecha);
                $fecha2 = $anyo . "-" . $mes . "-" . $dia;
                $f0 = strtotime(date('Y-m-d h:i A'));
                $f1 = strtotime($fecha2);
                $resultado = ($f1 - $f0);
                $resultado = ($resultado / 60 / 60) + 1;
                $resultado = round($resultado);
                if ($resultado > 7) {
                    $tiempo = true;
                    $mensaje = '';
                } else {
                    $tiempo = false;
                    $mensaje = "The maximum period for reservation of one-day-tours be until 05:00 PM the day prior to the date of departure";
                }
            }

            $url = Doo::conf()->APP_URL;
            if ($this->params ["corte"] == 0) {
                if ($id == 0 && $id2 == 1 && isset($fecha)) {
                    $sql = "SELECT DISTINCT t1.trip_to, t2.nombre  FROM routes t1
                                LEFT JOIN areas t2 ON (t1.trip_to = t2.id)
                                WHERE t1.type_rate = 0 and t1.trip_from = 1 ";
                    $rs = Doo::db()->query($sql);
                    $areas = $rs->fetchAll();

                    $sql = 'SELECT
												  t1.trip_no,
												  t2.id,
												  t1.fecha, 
												  t4.nombre AS trip_from, 
												  t5.nombre AS trip_to, 
												  t2.trip_departure, 
												  t2.trip_arrival,
												  t3.equipment,
												 t1.estado, 
                                                                                                 t2.type_rate
											 FROM programacion t1
											 LEFT JOIN routes t2 ON (t1.trip_no = t2.trip_no)
											 LEFT JOIN trips  t3 ON (t1.trip_no = t3.trip_no)
											 LEFT JOIN areas  t4 ON (t2.trip_from = t4.id)
											 LEFT JOIN areas  t5 ON  (t2.trip_to  = t5.id)
										   WHERE t2.trip_from = 9 AND t2.trip_to = 1 AND fecha = ? AND t2.anno = ? AND t2.type_rate = 0 AND t2.trip_departure > "" AND t1.estado = "1" ORDER BY t2.trip_departure ASC';

                    $anno = explode("-", $fecha);
                    $rs = Doo::db()->query($sql, array(
                        $fecha, $anno[2]
                    ));
//                    print_r(Doo::db()->showSQL());
//                    exit;
                    $llegada = $rs->fetchAll();


                    echo '<script>$("#conte").css("display", "block");$("#pickups").css("display", "none");</script>';
                    echo '<br/><br><div align="center" > 
					<table width="100%" class="table2 table-bordered table-striped">
								 <thead>
									 <tr>
										 <th width="10%">Select</th>
										 <th width="10%">Trip</th>
										 <th width="15%">Departure</th>
										 <th width="15%">Arrive&nbsp;&nbsp;&nbsp;&nbsp;</th>
										 <th width="33%">Equipment</th>
									
									 </tr>
								 </thead>';

                    if (count($llegada) > 0 && $tiempo) {
                        $contador = 0;
                        Doo::loadController('MainController');
                        $main = new MainController();
                        foreach ($llegada as $e) {
                            $disponible = $main->disponible($e['trip_no'], $fecha2);
                            if ($disponible > 0) {
                                echo '<tr >';
                                echo '<td>
				<input type="radio" name="trip1"  value="' . $e['trip_no'] . '" class="trip1" />
				<input name="sarrival" type="hidden"  value="1"/>
				</td>';
                            } else {
                                echo '<tr class="nodisponible" >';
                                echo '<td>
										<img src="' . Doo::conf()->APP_URL . 'global/images/detalles.png" width="24px"
height= "20px" title="The Trip ' . $e['trip_no'] . ' does not have positions available"
								</td>';
                            }

                            echo '<td>' . $e ['trip_no'] . '</td>
									<td nowrap="nowrap" >' . date("g:i A", strtotime($e['trip_departure'])) . '</td>
									<td nowrap="nowrap" >' . date("g:i A", strtotime($e ['trip_arrival'])) . '</td>
									<td nowrap="nowrap" style="font-size:11px;" >' . $e ['equipment'] . '</td>
								</tr>';
                            $contador++;
                        }
                    } else {
                        echo '<tr>
									  <td colspan="7">No tours available</td> 
			      </tr>';
                    }
                    echo '
							 </table>
							 <b style="color:#F00" >' . $mensaje . '</b>
							 </div>
							<script>
						
						var ddData2 = [
						{
							text: "Super Tours Bus",
							value: 2,
							selected: true,
							description: "BY SUPER TOURS BUS TO MIAMI",
							imageSrc: "' . $url . 'global/img/BUS2.png"
						},
						{
							text: "Airport (Transfer OUT)",
							value: 2,
							selected: false,
							description: "BY PLANE AT ORLANDO INT`L AIRPORT (TRANSFER OUT)?",
							imageSrc: "' . $url . 'global/img/icon-plane.png"
						},
						{
							text: "By Car",
							value: 2,
							selected: false,
							description: "BY CAR?",
							imageSrc: "' . $url . 'global/img/car.png"
						}
					];		
					 $("#select2").ddslick("destroy");
					
					 $("#select2").ddslick({
						data: ddData2,
						width: 300,
						imagePosition: "left",
						selectText: "Method of arrival to Orlando?",
						onSelected: function (data) {
							var id = data.selectedIndex;
							$("#indexSelect2").val(id);
							selectTrip2();
						}
					});
					$(".trip1").change(function() {
					var id = 0;
                                        var trip_no = $(this).val();
		         	 $("#pickups").load("' . $url . 'tours/question14/" + id + "/" + trip_no);
					});
					</script>';
                }
                if ($id == 0 && $id2 == 2 && isset($fecha)) {

                    $sql = 'SELECT
								  t1.trip_no,
								  t2.id,
								  t1.fecha, 
								  t4.nombre AS trip_from, 
								  t5.nombre AS trip_to, 
								  t2.trip_departure, 
								  t2.trip_arrival,
								  t3.equipment,
								 t1.estado,
								 t2.type_rate
							 FROM programacion t1
							 LEFT JOIN routes t2 ON (t1.trip_no = t2.trip_no)
							 LEFT JOIN trips  t3 ON (t1.trip_no = t3.trip_no)
							 LEFT JOIN areas  t4 ON (t2.trip_from = t4.id)
							 LEFT JOIN areas  t5 ON  (t2.trip_to  = t5.id)
						   WHERE t2.type_rate = 0 AND t2.trip_from = 1 AND t2.trip_to = 9 AND fecha = ? AND t2.anno = ?  AND t2.trip_departure > "" AND t1.estado = "1" ORDER BY t2.trip_departure ASC';

                    $anno = explode("-", $fecha);
                    $rs = Doo::db()->query($sql, array(
                        $fecha, $anno[2]
                    ));

                    $salida = $rs->fetchAll();

                    echo '<br><br><div align="center" ><table width="100%" class="table2 table-bordered table-striped">
								 <thead>
									 <tr>
										 <th width="10%">Select</th>
										 <th width="5%">Trip</th>
										 <th width="15%">Departure</th>
										 <th width="15%">Arrive&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
										 <th width="33%">Equipment</th>
									
									 </tr>
			</thead>';

                    if (count($salida) > 0 && $tiempo) {
                        $contador = 0;
                        Doo::loadController('MainController');
                        $main = new MainController();
                        list ($mes, $dia, $anyo) = explode("-", $fecha);
                        $fecha2 = $anyo . "-" . $mes . "-" . $dia;
                        foreach ($salida as $e) {
                            $disponible = $main->disponible($e['trip_no'], $fecha2);
                            if ($disponible > 0) {
                                echo '<tr >';
                                echo '<td>
										<input type="radio" name="trip2"  value="' . $e ['trip_no'] . '"  class="trip2"/>
										<input name="sdeparture" type="hidden"  value="1"/>
										</td>';
                            } else {
                                echo '<tr class="nodisponible" >';
                                echo '<td>
										<img src="' . Doo::conf()->APP_URL . 'global/images/detalles.png" width="24px"
height= "20px" title="The Trip ' . $e['trip_no'] . ' does not have positions available"
								</td>';
                            }
                            echo ' 		<td >' . $e['trip_no'] . '</td>
										<td nowrap="nowrap"  >' . date("g:i A", strtotime($e['trip_departure'])) . '</td>
										<td nowrap="nowrap"  >' . date("g:i A", strtotime($e ['trip_arrival'])) . '</td>
										<td nowrap="nowrap" style="font-size:11px;">' . $e ['equipment'] . '</td>
									  
				</tr>';
                            $contador++;
                        }
                    } else {
                        echo '
								  <tr>
									  <td colspan="7">No tours available</td> 
								  </tr>';
                    }
                    echo '
							 </table>
							 <b style="color:#F00" >' . $mensaje . '</b>
							 </div>
							
							
								 ';
                    echo '<script>$(".trip2").change(function() {
					var id = 1;
                                        var trip_no2 = $(this).val();
		         	 $("#pickups2").load("' . $url . 'tours/question14/" + id + "/" + trip_no2);
					});</script>';
                }
                // /condiciones para ajax
                if ($id == 1 && $id2 == 1) {
                    echo '<table width="381" border="0">
					  <tr>
						<td>&nbsp;</td>
						<td colspan="4">&nbsp;</td>
						<td colspan="2">&nbsp;</td>
					  </tr>
					  <tr >
						<td>&nbsp;</td>
						<td colspan="4" >&iquest;At what dtime you wish your private service leaves Miami?</td>
						<td width="29"><label>
							<input name="hora1" type="text" id="hora1" value="" size="6"  class="required"/>
						</label></td>						
					  </tr>
					  <tr>
						<td height="16" colspan="5"><div align="center"></div></td>
						<td colspan="2" rowspan="7">&nbsp;</td>
					  </tr>
					  <tr>
						<td height="7">&nbsp;</td>
						<td colspan="4"><div align="center">&iquest;From where in Miami?</div></td>
					  </tr>
					  <tr>
						<td height="7">&nbsp;</td>
						<td colspan="4"><div align="center"></div></td>
					  </tr>
					  <tr>
						<td width="12" height="7">&nbsp;</td>
						<td width="53">&nbsp;</td>
						<td width="58">City:</td>
						<td width="113"><input name="city" type="text" id="city" size="25" class="required" /></td>
						
					  </tr>
					  <tr>
						<td height="2">&nbsp;</td>
						<td height="2">&nbsp;</td>
						<td height="2">Address:</td>
						<td height="2"><input name="address" type="text" id="address" size="25" class="required" /></td>
						
					  </tr>
					  <tr>
						<td height="3">&nbsp;</td>
						<td height="3">&nbsp;</td>
						<td height="3">Zip Code:</td>
						<td height="3"><input name="zipcode" type="text" id="zipcode" size="25" class="required"/></td>
						
					  </tr>
					  <tr>
						<td height="7">&nbsp;</td>
						<td height="7">&nbsp;</td>
						<td height="7">Phone #:</td>
						<td height="7"><input name="phone" type="text" id="phone" size="25" class="required" /><input name="sarrival" type="hidden"  value="2"/></td>
						
					  </tr>
					</table>
						   
						<script> 	$("#hora1").timeEntry().change(function() { 
    var log = $("#log"); 
    log.val(log.val() + ($("#hora1").val() || "blank") + "\n"); 
});
					$(function(){
					$(".someClass").tipTip({maxWidth: "auto", edgeOffset: 10});
					});
					
					</script>
					
						<script>
						
						var ddData2 = [
						{
							text: "Super Tours Bus",
							value: 2,
							selected: false,
							description: "BY SUPER TOURS BUS TO MIAMI",
							imageSrc: "' . $url . 'global/img/BUS2.png"
						},
						{
							text: "Airport (Transfer OUT)",
							value: 2,
							selected: false,
							description: "BY PLANE AT ORLANDO INT`L AIRPORT (TRANSFER OUT)?",
							imageSrc: "' . $url . 'global/img/icon-plane.png"
						},
						{
							text: "By Car",
							value: 2,
							selected: false,
							description: "BY CAR?",
							imageSrc: "' . $url . 'global/img/car.png"
						}
					];		
					 $("#select2").ddslick("destroy");
					
					 $("#select2").ddslick({
						data: ddData2,
						width: 300,
						imagePosition: "left",
						selectText: "Method of arrival to Orlando?",
						onSelected: function (data) {
							var id = data.selectedIndex;
							$("#indexSelect2").val(id);
							selectTrip2();	
						}
					    });
						</script>
						';
                }
                if ($id == 1 && $id2 == 2) {

                    echo '<table width="381" border="0">
					  
					  <tr>
						<td height="24">&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
					  </tr>
					  <tr>
						<td height="24">&nbsp;</td>
						<td>&nbsp;</td>
						<td width="141"><label></label></td>
					  </tr>
					  
					  <tr>
						<td height="7" rowspan="2">&nbsp;</td>
						<td><div align="center">At what time you wish your private</div></td>
						<td rowspan="2"><input name="hora2" type="text" id="hora2" value="" size="6"  class="required"/><input name="sdeparture" type="hidden"  value="2"/>
						  </td>
					  </tr>
					  <tr>
						<td><div align="center">service leaves Orlando?</div></td>
					  </tr>
					  
					  <tr>
						<td width="45" height="7" rowspan="2">&nbsp;</td>
						<td width="250"><div align="center"></div></td>
						<td rowspan="2">&nbsp;</td>
					  </tr>
					  <tr>
						<td> <div align="center"></div></td>
					  </tr>
					  <tr>
						<td height="2">&nbsp;</td>
						<td height="2">:</td>
						<td>&nbsp;</td>
					  </tr>
					  <tr>
						<td height="3">&nbsp;</td>
						<td height="3">&nbsp;</td>
						<td>&nbsp;</td>
					  </tr>
					  <tr>
						<td height="100">&nbsp;</td>
						<td height="100">&nbsp;</td>
						<td>&nbsp;</td>
					  </tr>
					</table>
					
					
					<script> 
						$("#hora2").timeEntry().change(function() { 
    var log = $("#log"); 
    log.val(log.val() + ($("#hora2").val() || "blank") + "\n"); 
});
					
					$(function(){
					$(".someClass").tipTip({maxWidth: "auto", edgeOffset: 10});
					});
					
					</script>
					';
                }
                if ($id == 2 && $id2 == 1) {
                    echo '<table width="381" border="0">
					  <tr>
						<td>&nbsp;</td>
						<td colspan="2">&nbsp;</td>
						<td width="29"><label></label></td>
					  </tr>
					  <tr>
						<td height="16" colspan="3"><div align="center"></div></td>
						<td rowspan="7">&nbsp;</td>
					  </tr>
					  <tr>
						<td height="7">&nbsp;</td>
						<td> <div align="left">Airline:</div></td><td><label>
						  <input type="text" name="airlinearrival" id="airlinearrival"  class="required"/>
						  </label></td>
					  </tr>
					  <tr>
						<td height="7">&nbsp;</td>
						<td><div align="left">Flight #:</div></td>
						<td><input type="text" name="flightarrival" id="flightarrival"  class="required"/>
						  </td>
					  </tr>
					  <tr>
						<td width="55" height="7"><div align="left"></div></td>
						<td width="89"> <div align="left">Arrival Time:</div></td>
						<td width="279"><input name="hora1" type="text" id="hora1" size="6"  class="required"/><input name="sarrival" type="hidden"  value="3"/>
						</td>
					  </tr>
					  <tr>
						<td height="2">&nbsp;</td>
						<td height="2">&nbsp;</td>
						<td height="2">&nbsp;</td>
					  </tr>
					  <tr>
						<td height="3">&nbsp;</td>
						<td height="3">&nbsp;</td>
						<td height="3">&nbsp;</td>
					  </tr>
					  <tr>
						<td height="7">&nbsp;</td>
						<td height="7">&nbsp;</td>
						<td height="7">&nbsp;</td>
					  </tr>
					</table>
					
					
					<script> 
					
						$("#hora1").timeEntry().change(function() { 
    var log = $("#log"); 
    log.val(log.val() + ($("#hora1").val() || "blank") + "\n"); 
});
					$(function(){
					$(".someClass").tipTip({maxWidth: "auto", edgeOffset: 10});
					});
					var ddData2 = [
						{
							text: "Super Tours Bus",
							value: 2,
							selected: false,
							description: "BY SUPER TOURS BUS TO MIAMI?",
							imageSrc: "' . $url . 'global/img/BUS2.png"
						},
						{
							text: "Airport (Transfer OUT)",
							value: 2,
							selected: true,
							description: "BY PLANE AT ORLANDO INT`L AIRPORT (TRANSFER OUT)?",
							imageSrc: "' . $url . 'global/img/icon-plane.png"
						},
						{
							text: "BY CAR",
							value: 2,
							selected: false,
							description: "BY CAR?",
							imageSrc: "' . $url . 'global/img/car.png"
						}
					];		
					 $("#select2").ddslick("destroy");
					
					
					 $("#select2").ddslick({
						data: ddData2,
						width: 300,
						imagePosition: "left",
						selectText: "Method of arrival to Orlando?",
						onSelected: function (data) {
							var id = data.selectedIndex;
							$("#indexSelect2").val(id);
							selectTrip2();	
						}
					});
					</script>
						';
                }
                if ($id == 2 && $id2 == 2) {

                    echo '<table width="381" border="0">
					  <tr>
						<td>&nbsp;</td>
						<td colspan="2">&nbsp;</td>
						<td width="29"><label></label></td>
					  </tr>
					  <tr>
						<td height="16" colspan="3"><div align="center"></div></td>
						<td rowspan="7">&nbsp;</td>
					  </tr>
					  <tr>
						<td height="7">&nbsp;</td>
						<td> <div align="left">Airline:</div></td><td><label>
						  <input type="text" name="airlinedeparture" id="airlinedeparture"  class="required"/>
						  </label></td>
					  </tr>
					  <tr>
						<td height="7">&nbsp;</td>
						<td><div align="left">Flight #:</div></td>
						<td><input type="text" name="flightdeparture" id="flightdeparture"  class="required"/>
						</td>
					  </tr>
					  <tr>
						<td width="55" height="7"><div align="left"></div></td>
						<td width="104"> <div align="left">Departure Time:</div></td>
						<td width="264"><input name="hora2" type="text" id="hora2" size="6"  class="required"/><input name="sdeparture" type="hidden"  value="3"/>
						 </td>
					  </tr>
					  <tr>
						<td height="2">&nbsp;</td>
						<td height="2">&nbsp;</td>
						<td height="2">&nbsp;</td>
					  </tr>
					  <tr>
						<td height="3">&nbsp;</td>
						<td height="3">&nbsp;</td>
						<td height="3">&nbsp;</td>
					  </tr>
					  <tr>
						<td height="7">&nbsp;</td>
						<td height="7">&nbsp;</td>
						<td height="7">&nbsp;</td>
					  </tr>
					</table>
						<script> 
					
						$("#hora2").timeEntry().change(function() { 
    var log = $("#log"); 
    log.val(log.val() + ($("#hora2").val() || "blank") + "\n"); 
});
					$(function(){
					$(".someClass").tipTip({maxWidth: "auto", edgeOffset: 10});
					});
					
					
					</script>
						
						
						';
                }
                if ($id == 3 && $id2 == 1) {
                    echo '<table width="381" border="0">
					  <tr>
						<td colspan="3">&nbsp;</td>
						<td width="36"><label></label></td>
					  </tr>
					  <tr>
						<td height="16" colspan="3"><div align="center"></div></td>
						<td rowspan="7">&nbsp;</td>
					  </tr>
					  <tr>
						<td width="77" height="7">&nbsp;</td>
						<td width="211"><div align="left">Estimated arrival time to Orlando:</div></td>
						<td><label>
						  <input name="hora1" type="text" id="hora1" size="6" class="required"/><input name="sarrival" type="hidden"  value="4"/>
						 </label></td>
					  </tr>
					  <tr>
						<td height="7" colspan="2">&nbsp;</td>
						<td>&nbsp;</td>
					  </tr>
					  <tr>
						<td height="7" colspan="2">&nbsp;</td>
						<td width="128">&nbsp;</td>
					  </tr>
					  <tr>
						<td height="2" colspan="2">&nbsp;</td>
						<td height="2">&nbsp;</td>
					  </tr>
					  <tr>
						<td height="3" colspan="2">&nbsp;</td>
						<td height="3">&nbsp;</td>
					  </tr>
					  <tr>
						<td height="7" colspan="2">&nbsp;</td>
						<td height="7">&nbsp;</td>
					  </tr>
					</table>
						
						<script> 
						$("#hora1").timeEntry().change(function() { 
    var log = $("#log"); 
    log.val(log.val() + ($("#hora1").val() || "blank") + "\n"); 
});
					$(function(){
					$(".someClass").tipTip({maxWidth: "auto", edgeOffset: 10});
					});
					
					</script>
					
						<script>
						
						var ddData2 = [
						{
							text: "Super Tours Bus",
							value: 2,
							selected: false,
							description: "BY SUPER TOURS BUS TO MIAMI?",
							imageSrc: "' . $url . 'global/img/BUS2.png"
						},
						{
							text: "Airport (Transfer OUT)",
							value: 2,
							selected: false,
							description: "BY PLANE AT ORLANDO INT`L AIRPORT (TRANSFER OUT)?",
							imageSrc: "' . $url . 'global/img/icon-plane.png"
						},
						{
							text: "By Car",
							value: 2,
							selected: true,
							description: "BY CAR?",
							imageSrc: "' . $url . 'global/img/car.png"
						}
					];		
					 $("#select2").ddslick("destroy");
					
					 $("#select2").ddslick({
						data: ddData2,
						width: 300,
						imagePosition: "left",
						selectText: "Method of arrival to Orlando?",
						onSelected: function (data) {
							var id = data.selectedIndex;
							$("#indexSelect2").val(id);
							selectTrip2();	
						}
					});
						</script>
							 ';
                }
                if ($id == 3 && $id2 == 2) {
                    echo '
						   <table width="381" border="0">
					  <tr>
						<td colspan="3">&nbsp;</td>
						<td width="36"><label></label></td>
					  </tr>
					  <tr>
						<td height="16" colspan="3"><div align="center"></div></td>
						<td rowspan="6">&nbsp;</td>
					  </tr>
					  <tr>
						<td width="65" height="7">&nbsp;</td>
						<td width="308"><div align="left">Remember the Hotel Check Out is at 11:00 am<input name="sdeparture" type="hidden"  value="4"/></div></td>
						<td><label></label></td>
					  </tr>
					  
					  <tr>
						<td height="7" colspan="2">&nbsp;</td>
						<td width="43">&nbsp;</td>
					  </tr>
					  <tr>
						<td height="2" colspan="2">&nbsp;</td>
						<td height="2">&nbsp;</td>
					  </tr>
					  <tr>
						<td height="3" colspan="2">&nbsp;</td>
						<td height="3">&nbsp;</td>
					  </tr>
					  <tr>
						<td height="7" colspan="2">&nbsp;</td>
						<td height="7">&nbsp;</td>
					  </tr>
					</table>
					  
							  ';
                }
            }
            if ($this->params ["corte"] == 1) {
                if ($id == 0 && $id2 == 1 && isset($fecha)) {
                    echo '<table width="381" border="0">
					  <tr>
						<td>&nbsp;</td>
						<td colspan="4">&nbsp;</td>
						<td colspan="2">&nbsp;</td>
					  </tr>
					  <tr >
						<td>&nbsp;</td>
						<td colspan="4" >&iquest;At what time you wish your private service leaves Miami?</td>
						<td width="29"><label>
							<input name="hora1" type="text" id="hora1" value="" size="6" class="required"/>
						</label></td>
						<td width="29"></td>
					  </tr>
					  <tr>
						<td height="16" colspan="5"><div align="center"></div></td>
						<td colspan="2" rowspan="7">&nbsp;</td>
					  </tr>
					  <tr>
						<td height="7">&nbsp;</td>
						<td colspan="4"><div align="center">&iquest;From where in Miami?</div></td>
					  </tr>
					  <tr>
						<td height="7">&nbsp;</td>
						<td colspan="4"><div align="center"></div></td>
					  </tr>
					  <tr>
						<td width="12" height="7">&nbsp;</td>
						<td width="53">&nbsp;</td>
						<td width="58">City:</td>
						<td width="113"><input name="city" type="text" id="city" size="25" class="required"  /></td>
						<td width="114"></td>
					  </tr>
					  <tr>
						<td height="2">&nbsp;</td>
						<td height="2">&nbsp;</td>
						<td height="2">Address:</td>
						<td height="2"><input name="address" type="text" id="address" size="25" class="required" /></td>
						<td height="2"></td>
					  </tr>
					  <tr>
						<td height="3">&nbsp;</td>
						<td height="3">&nbsp;</td>
						<td height="3">Zip Code:</td>
						<td height="3"><input name="zipcode" type="text" id="zipcode" size="25" class="required"/></td>
						<td height="3"></td>
					  </tr>
					  <tr>
						<td height="7">&nbsp;</td>
						<td height="7">&nbsp;</td>
						<td height="7">Phone #:</td>
						<td height="7"><input name="phone" type="text" id="phone" size="25" class="required" /><input name="sarrival" type="hidden"  value="2"/></td>
						<td height="7"></td>
					  </tr>
					</table>
						   
						<script> 	
						$("#hora1").timeEntry().change(function() { 
								var log = $("#log"); 
								log.val(log.val() + ($("#hora1").val() || "blank") + "\n"); 
								
								$("#hora2").val($("#hora1").val());
							});
						$("#city").keyup(function(){ 
							$("#city2").val($("#city").val());
					 	});
						$("#address").keyup(function(){ 
							$("#address2").val($("#address").val());
					 	});
						$("#zipcode").keyup(function(){ 
							$("#zipcode2").val($("#zipcode").val());
					 	});
						$("#phone").keyup(function(){ 
							$("#phone2").val($("#phone").val());
					 	});
						
					$(function(){
					$(".someClass").tipTip({maxWidth: "auto", edgeOffset: 10});
					});
					
					</script>
					
						<script>
						
						var ddData2 = [
						
						{
							text: "Super Tours Vip",
							value: 2,
							selected: true,
							description: "BY SUPER TOURS VIP PRIVATE TO MIAMI?",
							imageSrc: "' . $url . 'global/img/vip.png"
						},
						{
							text: "Airport (Transfer OUT)",
							value: 2,
							selected: false,
							description: "BY PLANE AT ORLANDO INT`L AIRPORT (TRANSFER OUT)?",
							imageSrc: "' . $url . 'global/img/icon-plane.png"
						}
					];		
					 $("#select2").ddslick("destroy");
					
					 $("#select2").ddslick({
						data: ddData2,
						width: 300,
						imagePosition: "left",
						selectText: "Method of arrival to Orlando?",
						onSelected: function (data) {
							var id = data.selectedIndex;
							$("#indexSelect2").val(id);
							selectTrip2();	
						}
					    });
						</script>
						';
                }
                if ($id == 0 && $id2 == 2 && isset($fecha)) {
                    echo '<table width="381" border="0">
					  <tr>
						<td>&nbsp;</td>
						<td colspan="4">&nbsp;</td>
						<td colspan="2">&nbsp;</td>
					  </tr>
					  <tr >
						<td>&nbsp;</td>
						<td colspan="4" >¿At what time you wish your private service to Miami?</td>
						<td width="29"><label>
							<input name="hora2" type="text" id="hora2" value="" size="6"  class="required"/><input name="sdeparture" type="hidden"  value="2"/>
						</label></td>
						<td width="29"></td>
					  </tr>
					  <tr>
						<td height="16" colspan="5"><div align="center"></div></td>
						<td colspan="2" rowspan="7">&nbsp;</td>
					  </tr>
					  <tr>
						<td height="7">&nbsp;</td>
						<td colspan="4"><div align="center">&iquest;To where in Miami?</div></td>
					  </tr>
					  <tr>
						<td height="7">&nbsp;</td>
						<td colspan="4"><div align="center"></div></td>
					  </tr>
					  <tr>
						<td width="12" height="7">&nbsp;</td>
						<td width="53">&nbsp;</td>
						<td width="58">City:</td>
						<td width="113"><input name="city2" type="text" id="city2" size="25" class="required" /></td>
						<td width="114"></td>
					  </tr>
					  <tr>
						<td height="2">&nbsp;</td>
						<td height="2">&nbsp;</td>
						<td height="2">Address:</td>
						<td height="2"><input name="address2" type="text" id="address2" size="25" class="required" /></td>
						<td height="2"></td>
					  </tr>
					  <tr>
						<td height="3">&nbsp;</td>
						<td height="3">&nbsp;</td>
						<td height="3">Zip Code:</td>
						<td height="3"><input name="zipcode2" type="text" id="zipcode2" size="25" class="required"/></td>
						<td height="3"></td>
					  </tr>
					  <tr>
						<td height="7">&nbsp;</td>
						<td height="7">&nbsp;</td>
						<td height="7">Phone #:</td>
						<td height="7"><input name="phone2" type="text" id="phone2" size="25" class="required" /><input name="sdeparture" type="hidden"  value="2"/></td>
						<td height="7"></td>
					  </tr>
					</table>
					
					
					<script> 
					 
						$("#hora2").timeEntry().change(function() { 
    var log = $("#log"); 
    log.val(log.val() + ($("#hora2").val() || "blank") + "\n"); 
});
					
					$(function(){
					$(".someClass").tipTip({maxWidth: "auto", edgeOffset: 10});
					});
					
					</script>
					';
                }
                // /condiciones para ajax
                if ($id == 1 && $id2 == 1) {
                    echo '<table width="381" border="0">
					  <tr>
						<td>&nbsp;</td>
						<td colspan="2">&nbsp;</td>
						<td width="29"><label></label></td>
					  </tr>
					  <tr>
						<td height="16" colspan="3"><div align="center"></div></td>
						<td rowspan="7">&nbsp;</td>
					  </tr>
					  <tr>
						<td height="7">&nbsp;</td>
						<td> <div align="left">Airline:</div></td><td><label>
						  <input type="text" name="airlinearrival" id="airlinearrival"  class="required"/>
						  </label></td>
					  </tr>
					  <tr>
						<td height="7">&nbsp;</td>
						<td><div align="left">Flight #:</div></td>
						<td><input type="text" name="flightarrival" id="flightarrival"  class="required"/>
						</td>
					  </tr>
					  <tr>
						<td width="55" height="7"><div align="left"></div></td>
						<td width="89"> <div align="left">Arrival Time:</div></td>
						<td width="279"><input name="hora1" type="text" id="hora1" size="6"  class="required"/><input name="sarrival" type="hidden"  value="3"/>
						</td>
					  </tr>
					  <tr>
						<td height="2">&nbsp;</td>
						<td height="2">&nbsp;</td>
						<td height="2">&nbsp;</td>
					  </tr>
					  <tr>
						<td height="3">&nbsp;</td>
						<td height="3">&nbsp;</td>
						<td height="3">&nbsp;</td>
					  </tr>
					  <tr>
						<td height="7">&nbsp;</td>
						<td height="7">&nbsp;</td>
						<td height="7">&nbsp;</td>
					  </tr>
					</table>
					
					
					<script> 
					
						$("#hora1").timeEntry().change(function() { 
    var log = $("#log"); 
    log.val(log.val() + ($("#hora1").val() || "blank") + "\n"); 
});
					$(function(){
					$(".someClass").tipTip({maxWidth: "auto", edgeOffset: 10});
					});
					var ddData2 = [
						 
						{
							text: "Super Tours Vip",
							value: 2,
							selected: false,
							description: "BY SUPER TOURS VIP PRIVATE TO MIAMI?",
							imageSrc: "' . $url . 'global/img/vip.png"
						},
						{
							text: "Airport (Transfer OUT)",
							value: 2,
							selected: true,
							description: "BY PLANE AT ORLANDO INT`L AIRPORT (TRANSFER OUT)?",
							imageSrc: "' . $url . 'global/img/icon-plane.png"
						}
					];		
					 $("#select2").ddslick("destroy");
					
					
					 $("#select2").ddslick({
						data: ddData2,
						width: 300,
						imagePosition: "left",
						selectText: "Method of arrival to Orlando?",
						onSelected: function (data) {
							var id = data.selectedIndex;
							$("#indexSelect2").val(id);
							selectTrip2();	
						}
					});
					</script>';
                }
                if ($id == 1 && $id2 == 2) {
                    echo '<table width="381" border="0">
					  <tr>
						<td>&nbsp;</td>
						<td colspan="2">&nbsp;</td>

						<td width="29"><label></label></td>
					  </tr>
					  <tr>
						<td height="16" colspan="3"><div align="center"></div></td>
						<td rowspan="7">&nbsp;</td>
					  </tr>
					  <tr>
						<td height="7">&nbsp;</td>
						<td> <div align="left">Airline:</div></td><td><label>
						  <input type="text" name="airlinedeparture" id="airlinedeparture"  class="required"/>
						 </label></td>
					  </tr>
					  <tr>
						<td height="7">&nbsp;</td>
						<td><div align="left">Flight #:</div></td>
						<td><input type="text" name="flightdeparture" id="flightdeparture"  class="required"/>
						  </td>
					  </tr>
					  <tr>
						<td width="55" height="7"><div align="left"></div></td>
						<td width="104"> <div align="left">Departure Time:</div></td>
						<td width="264"><input name="hora2" type="text" id="hora2" size="6"  class="required"/><input name="sdeparture" type="hidden"  value="3"/>
						  </td>
					  </tr>
					  <tr>
						<td height="2">&nbsp;</td>
						<td height="2">&nbsp;</td>
						<td height="2">&nbsp;</td>
					  </tr>
					  <tr>
						<td height="3">&nbsp;</td>
						<td height="3">&nbsp;</td>
						<td height="3">&nbsp;</td>
					  </tr>
					  <tr>
						<td height="7">&nbsp;</td>
						<td height="7">&nbsp;</td>
						<td height="7">&nbsp;</td>
					  </tr>
					</table>
						<script> 
					
						$("#hora2").timeEntry().change(function() { 
    var log = $("#log"); 
    log.val(log.val() + ($("#hora2").val() || "blank") + "\n"); 
});
					$(function(){
					$(".someClass").tipTip({maxWidth: "auto", edgeOffset: 10});
					});
					
					
					</script>';
                }
                if ($id == 2 && $id2 == 1) {
                    echo '<table width="381" border="0">
					  <tr>
						<td colspan="3">&nbsp;</td>
						<td width="36"><label></label></td>
					  </tr>
					  <tr>
						<td height="16" colspan="3"><div align="center"></div></td>
						<td rowspan="7">&nbsp;</td>
					  </tr>
					  <tr>
						<td width="77" height="7">&nbsp;</td>
						<td width="211"><div align="left">Estimated arrival time to Orlando:</div></td>
						<td><label>
						  <input name="hora1" type="text" id="hora1" size="6" class="required"/><input name="sarrival" type="hidden"  value="4"/>
						</label></td>
					  </tr>
					  <tr>
						<td height="7" colspan="2">&nbsp;</td>
						<td>&nbsp;</td>
					  </tr>
					  <tr>
						<td height="7" colspan="2">&nbsp;</td>
						<td width="128">&nbsp;</td>
					  </tr>
					  <tr>
						<td height="2" colspan="2">&nbsp;</td>
						<td height="2">&nbsp;</td>
					  </tr>
					  <tr>
						<td height="3" colspan="2">&nbsp;</td>
						<td height="3">&nbsp;</td>
					  </tr>
					  <tr>
						<td height="7" colspan="2">&nbsp;</td>
						<td height="7">&nbsp;</td>
					  </tr>
					</table>
						
						<script> 
						$("#hora1").timeEntry().change(function() { 
    var log = $("#log"); 
    log.val(log.val() + ($("#hora1").val() || "blank") + "\n"); 
});
					$(function(){
					$(".someClass").tipTip({maxWidth: "auto", edgeOffset: 10});
					});
					
					</script>
					
						<script>
						
						var ddData2 = [
						
						{
							text: "Super Tours Vip",
							value: 2,
							selected: false,
							description: "BY SUPER TOURS VIP PRIVATE TO MIAMI?",
							imageSrc: "' . $url . 'global/img/vip.png"
						},
						{
							text: "Airport (Transfer OUT)",
							value: 2,
							selected: true,
							description: "BY PLANE AT ORLANDO INT`L AIRPORT (TRANSFER OUT)?",
							imageSrc: "' . $url . 'global/img/icon-plane.png"
						}
					];		
					 $("#select2").ddslick("destroy");
					
					 $("#select2").ddslick({
						data: ddData2,
						width: 300,
						imagePosition: "left",
						selectText: "Method of arrival to Orlando?",
						onSelected: function (data) {
							var id = data.selectedIndex;
							$("#indexSelect2").val(id);
							selectTrip2();	
						}
					});
						</script>';
                }
                if ($id == 2 && $id2 == 2) {
                    echo '<table width="381" border="0">
					  <tr>
						<td colspan="3">&nbsp;</td>
						<td width="36"><label></label></td>
					  </tr>
					  <tr>
						<td height="16" colspan="3"><div align="center"></div></td>
						<td rowspan="6">&nbsp;</td>
					  </tr>
					  <tr>
						<td width="65" height="7">&nbsp;</td>
						<td width="308"><div align="left">Remember the Hotel Check Out is at 11:00 am<input name="sdeparture" type="hidden"  value="4"/></div></td>
						<td><label></label></td>
					  </tr>
					  
					  <tr>
						<td height="7" colspan="2">&nbsp;</td>
						<td width="43">&nbsp;</td>
					  </tr>
					  <tr>
						<td height="2" colspan="2">&nbsp;</td>
						<td height="2">&nbsp;</td>
					  </tr>
					  <tr>
						<td height="3" colspan="2">&nbsp;</td>
						<td height="3">&nbsp;</td>
					  </tr>
					  <tr>
						<td height="7" colspan="2">&nbsp;</td>
						<td height="7">&nbsp;</td>
					  </tr>
					</table>';
                }
            }
        } catch (Exception $e) {
            // procedimiento en caso de reportar errores
        }
    }

    public function tours_one() {
        $_SESSION ['toursbooking'] ['pasoposttrip'] = true;

        unset($_SESSION['tourPagoMulDay']);
        unset($_SESSION['tourPagoOneDay']);
        unset($_SESSION['toursbooking']);
        if (isset($_SESSION['data_agency'])) {
            Doo::loadModel("Agency");
            $dat = new Agency($_SESSION['data_agency']);
            $type = $dat->type_rate;
        } else {
            Doo::loadModel("Agency");
            $dat = new Agency();
            $type = 0;
            $dat->id = -1;
        }
        //Tipo de pickup_dropoff;
        if ($dat->id == -1) {
            $type_web = 1;
        } else {
            $type_web = 0;
        }
        $_SESSION['onedaytour'] = false;
        $_SESSION['step_one'] = true;




        try {
            /* if(!isset($_POST)){
              return Doo::conf()->APP_URL . "tours/";
              exit;
              } */
			  
            extract($_POST, EXTR_SKIP);
            if (isset($area)) {
                $id_from = $area;
                $id_tot = 1;
                $sqlArea = "select nombre from areas where id = ?";
                $res = Doo::db()->query($sqlArea, array(
                    $area
                ));

                $ar = $res->fetch();

                $sqlpu = "SELECT id,place,address  FROM pickup_dropoff
                                          WHERE id = ?  AND type_web = ? ORDER BY id ASC";

                $pu = Doo::db()->query($sqlpu, array($pickup, $type_web));

                $pick = $pu->fetch();

                $_SESSION['area'] = $ar['nombre'];
                $_SESSION['pickup'] = $pick['place'];
            } else {
                $id_from = 1;
                $id_tot = 1;
            }

            if (isset($area2)) {
                $id_from2 = 1;
                $id_tot2 = $area2;
                $sqlArea2 = "select nombre from areas where id = ?";
                $res2 = Doo::db()->query($sqlArea2, array(
                    $area2
                ));

                $ar2 = $res2->fetch();

                $sqlpu2 = "SELECT id,place,address FROM pickup_dropoff
                                      WHERE id = ? AND type_web = ? ORDER BY id ASC";

                $pu2 = Doo::db()->query($sqlpu2, array($pickup2, $type_web));
                $pick2 = $pu2->fetch();
                $_SESSION['area2'] = $ar2['nombre'];
                $_SESSION['pickup2'] = $pick2['place'];
            } else {
                $id_tot2 = 0;
                $id_from2 = 0;
            }



            list ($mes, $dia, $anyo) = explode("-", $fecha_salida);

            $llegada = $anyo . "-" . $mes . "-" . $dia;

            if (isset($fecha_retorno)) {

                list ($mes2, $dia2, $anyo2) = explode("-", $fecha_retorno);

                $salida = $anyo2 . "-" . $mes2 . "-" . $dia2;
            }

            $f0 = strtotime($llegada);
            $f1 = strtotime($salida);
            $resultado = ($f1 - $f0);
            $resultado = $resultado / 60 / 60 / 24;
            $resultado = round($resultado);
            $dias = ($resultado + 1 > 0) ? $resultado + 1 : '';
            $noches = ($resultado + 1 > 0) ? $dias - 1 : '';

            $toursbooking = array(
                "question" => $question,
                "fecha_llegada" => $llegada,
                "fecha_salida" => $salida,
                "sarrival" => $sarrival,
                "sdeparture" => $sdeparture,
                "dias" => $dias,
                "noches" => $noches
            );


            // /condicionales session




            if (isset($trip1)) { // /trip de arrival a orlando
                $toursbooking ['trip1'] = $trip1;
                /* $sql = "SELECT t1.trip_departure,t1.trip_arrival,t2.equipment
                  FROM routes t1

                  INNER JOIN trips t2 ON (t1.trip_no = t2.trip_no)

                  WHERE t1.trip_no  = ? "; */

                $sql = " SELECT  t1.trip_no,  t2.trip_departure,t3.equipment,t2.trip_arrival, t1.estado  
					  FROM programacion t1
					  LEFT JOIN routes t2 ON (t1.trip_no = t2.trip_no)
					  LEFT JOIN trips  t3 ON (t1.trip_no = t3.trip_no) 
					  WHERE t2.type_rate = ? and t2.trip_from = " . $area . " AND t2.trip_to = 1 and fecha = ? and t1.trip_no = ? AND t1.estado = '1' ORDER BY t2.trip_departure ASC";



                $fechaSalidaFormato = date("d-m-Y", strtotime($toursbooking ['fecha_llegada']));
                $dat = new DateTime($fechaSalidaFormato);


                $rs = Doo::db()->query($sql, array($type,
                    $dat->format('m') . "-" . $dat->format('d') . "-" . $dat->format('Y'),
                    $trip1
                ));

                $fechas = $rs->fetch();

                $toursbooking ['datedeparturetrip1'] = date("g:i A", strtotime($fechas ['trip_departure']));
                $toursbooking ['datearrivingtrip1'] = date("g:i A", strtotime($fechas ['trip_arrival']));
                $toursbooking ['equipment1'] = $fechas ['equipment'];
                $toursbooking ['service1'] = "SUPER TOURS BUS";
            }

            if (isset($trip2)) { // /trip de departure
                $toursbooking ['trip2'] = $trip2;
                $fechaSalidaFormato2 = date("d-m-Y", strtotime($toursbooking ['fecha_salida']));
                $dat = new DateTime($fechaSalidaFormato2);
                $sql = "SELECT t1.trip_no, t2.trip_departure,t3.equipment,t2.trip_arrival, t1.estado  
						FROM programacion t1
						  LEFT JOIN routes t2 ON (t1.trip_no = t2.trip_no)
						  LEFT JOIN trips  t3 ON (t1.trip_no = t3.trip_no) 
					  	WHERE t2.type_rate = ? 
							AND t2.trip_from = 1 
							AND t2.trip_to = " . $area2 . " 
							AND fecha = ? 
							AND t1.trip_no = ? 
							AND t1.estado = '1' 
						ORDER BY t2.trip_departure ASC";
                $rs = Doo::db()->query($sql, array($type,
                    $dat->format('m') . "-" . $dat->format('d') . "-" . $dat->format('Y'),
                    $trip2
                ));

                $fechas2 = $rs->fetch();
                $toursbooking ['datedeparturetrip2'] = date("g:i A", strtotime($fechas2 ['trip_departure']));
                $toursbooking ['datearrivingtrip2'] = date("g:i A", strtotime($fechas2['trip_arrival']));
                $toursbooking ['equipment2'] = $fechas2 ['equipment'];
                $toursbooking ['service2'] = "SUPER TOURS BUS";
            }

            if (isset($hora1)) { // hora de arrival 
                $toursbooking ['hora1'] = date("H:i", strtotime($hora1));
            }
            if (isset($hora2)) { // hora de departure 
                $toursbooking ['hora2'] = date("H:i", strtotime($hora2));
            }
            if (isset($city) && isset($address) && isset($zipcode) && isset($phone)) {
                // /datos de arrival en la opcion vip complementado con la horas anteriores
                $toursbooking ['city'] = $city;
                $toursbooking ['address'] = $address;
                $toursbooking ['zipcode'] = $zipcode;
                $toursbooking ['phone'] = $phone;
                $toursbooking ['service1'] = "VIP";
            }
            if ($sdeparture == 2) {
                $toursbooking ['service2'] = "VIP";
                if (isset($city2) && isset($address2) && isset($zipcode2) && isset($phone2)) {
                    $toursbooking ['city2'] = $city2;
                    $toursbooking ['address2'] = $address2;
                    $toursbooking ['zipcode2'] = $zipcode2;
                    $toursbooking ['phone2'] = $phone2;
                    $toursbooking ['service2'] = "VIP";
                }
            }
            if (isset($airlinearrival) && isset($flightarrival)) {
                // transfer in arrival complementado con hora1
                $toursbooking ['airlinearrival'] = $airlinearrival;
                $toursbooking ['flightarrival'] = $flightarrival;
                $toursbooking ['service1'] = "PLANE";
            }
            if (isset($airlinedeparture) && isset($flightdeparture)) {
                // transfer in departure complementado con hora 2
                $toursbooking ['airlinedeparture'] = $airlinedeparture;
                $toursbooking ['flightdeparture'] = $flightdeparture;
                $toursbooking ['service2'] = "PLANE";
            }
            if ($sarrival == 4) {
                $toursbooking ['service1'] = "Car";
            }
            if ($sdeparture == 4) {
                $toursbooking ['service2'] = "Car";
            }
            // //////////////////// services
            $toursbooking['id_from'] = $id_from;
            $toursbooking['id_tot'] = $id_tot;
            $toursbooking['id_from2'] = $id_from2;
            $toursbooking['id_tot2'] = $id_tot2;
            $id_pickup1 = (isset($pickup) ? $pickup : 0);
            $id_dropoff1 = 1;
            $id_pickup2 = 1;
            $id_dropoff2 = (isset($pickup2) ? $pickup2 : 0);

            $toursbooking['id_pickup1'] = $id_pickup1;
            $toursbooking['id_dropoff1'] = $id_dropoff1;
            $toursbooking['id_pickup2'] = $id_pickup2;
            $toursbooking['id_dropoff2'] = $id_dropoff2;

            $_SESSION ["toursbooking"] = $toursbooking;
            echo '<script>location.href="' . Doo::conf()->APP_URL . "tours/step-two" . '"</script>';
            return Doo::conf()->APP_URL . "tours/step-two";
        } catch (Exception $e) {
			 echo '<script>location.href="' . Doo::conf()->APP_URL . "tours/" . '"</script>';
            // procedimiento en caso de reportar errores
        }
    }

    public function step_one() {
        $_SESSION['step_one'] = true;
        try {
            echo "please wait...";
            if (isset($_SESSION ['toursbooking'] ['pasopostpark'])) {

                unset($_SESSION ['toursbooking'] ['pasopostpark']);
            }

            $toursbooking = $_SESSION ["toursbooking"];

            $fechal = substr($toursbooking['fecha_llegada'], 0, 4) . '-01-01 00:00:00';


            /* if prices trips bus */
            if (isset($toursbooking ['trip1'])) {

                $sql = 'SELECT adult, child
						 FROM tarifastrip
							WHERE trip_no = ?
							AND annio = ?';

                $rs = Doo::db()->query($sql, array(
                    $toursbooking ['trip1'], $fechal
                ));

                $prices = $rs->fetch();

                if (!empty($prices)) {

                    $priceadult = $prices ['adult'] * $toursbooking ['pax1'];
                    $pricechild = $prices ['child'] * $toursbooking ['pax2'];

                    $trip1 = number_format($priceadult, 2, '.', '') + number_format($pricechild, 2, '.', '');
                    echo "trip1 " . $trip1;
                }
            } else {
                $trip1 = 0;
            }

            if (isset($toursbooking ['trip2'])) {
                $fechas = substr($toursbooking['fecha_salida'], 0, 4) . '-01-01 00:00:00';
                $sql = 'SELECT adult, child
										 FROM tarifastrip
											WHERE trip_no = ?
											AND annio = ?';

                $rs = Doo::db()->query($sql, array(
                    $toursbooking ['trip2'], $fechas
                ));

                $prices = $rs->fetch();

                if (!empty($prices)) {

                    $priceadult = $prices ['adult'] * $toursbooking ['pax1'];
                    $pricechild = $prices ['child'] * $toursbooking ['pax2'];

                    $trip2 = number_format($priceadult, 2, '.', '') + number_format($pricechild, 2, '.', '');
                    echo "trip2 " . number_format($trip2, 2, '.', '');
                }
            } else {
                $trip2 = 0;
            }

            /* if prices supertours vip */

            if ($toursbooking ['sarrival'] == 2) {

                $sql = 'SELECT id,cantidad,price
						FROM tarifasvip
						WHERE cantidad = ?
						annio = ?
						';

                $rs = Doo::db()->query($sql, array(
                    $totalpax, $fechal
                ));

                $pricesvip = $rs->fetch();

                if (!empty($pricesvip)) {

                    $vip1 = number_format($pricesvip ['price'], 2, '.', '');

                    echo "vip1 " . $vip1;
                }
            } else {
                $vip1 = 0;
            }

            if ($toursbooking ['sdeparture'] == 2) {

                $sql = 'SELECT id,cantidad,price
					    FROM tarifasvip
						WHERE cantidad = ?
						AND annio = ?';

                $rs = Doo::db()->query($sql, array(
                    $totalpax, $fechas
                ));

                $pricesvip = $rs->fetch();

                if (!empty($pricesvip)) {

                    $vip2 = number_format($pricesvip ['price'], 2, '.', '');

                    echo "vip2 " . number_format($vip2, 2, '.', '');
                }
            } else {
                $vip2 = 0;
            }

            /* if prices transfer in airport */

            if ($toursbooking ['sarrival'] == 3) {
                $totalpax = $toursbooking ['pax1'] + $toursbooking ['pax2'];

                $sql = 'SELECT id,cantidad,price
											FROM tarifaplane 
												WHERE cantidad = ?';

                $rs = Doo::db()->query($sql, array(
                    $totalpax
                ));

                $pricesbyplane = $rs->fetch();

                if (!empty($pricesbyplane)) {
                    $byplane1 = number_format($pricesbyplane ['price'], 2, '.', '');
                    echo "byplane1 " . number_format($byplane1, 2, '.', '');
                }
            } else {
                $byplane1 = 0;
            }

            if ($toursbooking ['sdeparture'] == 3) {
                $totalpax = $toursbooking ['pax1'] + $toursbooking ['pax2'];

                $sql = 'SELECT id,cantidad,price
											FROM tarifaplane 
												WHERE cantidad = ?';

                $rs = Doo::db()->query($sql, array(
                    $totalpax
                ));

                $pricesbyplane = $rs->fetch();

                if (!empty($pricesbyplane)) {
                    $byplane2 = number_format($pricesbyplane ['price'], 2, '.', '');
                    echo "byplane2 " . number_format($byplane2, 2, '.', '');
                }
            } else {
                $byplane2 = 0;
            }

            /* if prices by car */

            if ($toursbooking ['sarrival'] == 4) {

                $fechal = substr($toursbooking['fecha_llegada'], 0, 4) . '-01-01 00:00:00';

                $sql = 'SELECT id,price
										FROM tarifacar where annio = ?';

                $rs = Doo::db()->query($sql, array($fechal));

                $pricescar = $rs->fetch();

                if (!empty($pricescar)) {
                    $car = number_format($pricescar ['price'], 2, '.', '');
                    echo "car " . number_format($car, 2, '.', '');
                }
            } else {
                $car = 0;
            }
            $tq = $trip1 + $trip2 + $vip1 + $vip2 + $byplane1 + $byplane2 + $car;
            // echo "TQ".number_format($tq,2,'.','');

            $_SESSION ['toursbooking']['tq'] = number_format($tq, 2, '.', '');

            return Doo::conf()->APP_URL ."tours/step-two";
        } catch (Exception $e) {
            echo $e;
            // procedimiento en caso de reportar errores
        }
    }

    public function step_two() {


        $this->data ['rootUrl'] = Doo::conf()->APP_URL;
        if (isset($_SESSION['step_one']) && isset($_SESSION ["toursbooking"])) {
            $_SESSION['step_two'] = true;
            if (isset($_SESSION ['toursbooking'] ['pasopostpark'])) {
                unset($_SESSION ['toursbooking'] ['pasopostpark']);
            }

            unset($_SESSION['step_one']);
            $this->renderc('/tours/2-day-tour', $this->data);
        } else {
            return Doo::conf()->APP_URL . "tours";
        }
    }

    public function question2() {
        try {

            $categoria = $this->params ["id"];
            $toursbooking = $_SESSION ["toursbooking"];
            $fecha_llegada = strtotime($toursbooking ['fecha_llegada']);
            $fecha_salida = strtotime($toursbooking ['fecha_salida']);
            $sql = "(SELECT id,orden,
                                codigo,
                                categoria,
                                nombre,
                                address,
                                city,
                                zipcode,
                                contacname,
                                phone,
                                email,
                                webpage,
                                breakfast,
                                resoftfe,
                                description,
                                image1,
                                'yes' as disponibilidad
                            FROM hoteles WHERE
                              id NOT IN (
                                SELECT id_hotel
                                FROM ratesblock
                                WHERE (ratesblock.fecha_ini BETWEEN ? AND ?)
                                      OR (ratesblock.fecha_fin BETWEEN ? AND ?)
                                      OR (
                                            (? BETWEEN ratesblock.fecha_ini AND ratesblock.fecha_fin )
                                            OR (? BETWEEN ratesblock.fecha_ini AND ratesblock.fecha_fin )
                                        )
                              )
                              AND id in (
                                select id_hotel from ratesvalid
                                where ratesvalid.fecha_ini <= ? and ratesvalid.fecha_fin >= ? OR ratesvalid.fecha_ini <= ? and ratesvalid.fecha_fin >= ?
                              )
                              AND categoria = ? AND estado = 1
                            )
                            UNION
                            (
                              SELECT id,
                                orden,
                                codigo,
                                categoria,
                                nombre,
                                address,
                                city,
                                zipcode,
                                contacname,
                                phone,
                                email,
                                webpage,
                                breakfast,
                                resoftfe,
                                description,
                                image1,
                                'no' as disponibilidad
                              FROM hoteles WHERE
                                id NOT IN (
                                  SELECT id_hotel
                                  FROM ratesblock
                                  WHERE (ratesblock.fecha_ini BETWEEN ? AND ?)
                                        OR (ratesblock.fecha_fin BETWEEN ? AND ?)
                                        OR (
                                    (? BETWEEN ratesblock.fecha_ini AND ratesblock.fecha_fin )
                                    OR (? BETWEEN ratesblock.fecha_ini AND ratesblock.fecha_fin )
                                  )
                                )
                                AND id not in (
                                  select id_hotel from ratesvalid
                                  where ratesvalid.fecha_ini <= ? and ratesvalid.fecha_fin >= ? OR ratesvalid.fecha_ini <= ? and ratesvalid.fecha_fin >= ?
                                )
                                AND categoria = ? AND estado = 1
                            ) ORDER BY orden asc";

            $fi = $fecha_llegada;
            $ff = $fecha_salida;

            $rs = Doo::db()->query($sql, array($fi, $ff, $fi, $ff, $fi, $ff, $fi, $fi, $ff, $ff, $categoria, $fi, $ff, $fi, $ff, $fi, $ff, $fi, $fi, $ff, $ff, $categoria));



            $hoteles = $rs->fetchAll();


            $_SESSION['categoria'] = $categoria;
            $contador = 0;
            $hidden = "hidden";
            $hotel = "hotel";
            if (empty($hoteles)) {
                echo '<table width="100%" border="0" id="tablah" >
					  <tr height="30">
					  	<td align="left">
							<font color="#003399" >&nbsp;&nbsp;&nbsp;No hotels available in this category</font> 
						</td>
					</tr>
					
					</table>';
            } else {
                foreach ($hoteles as $datos) {
                    $html_img = '';
                    $id_hotel = $datos ['id'];
                    $array_imagenes = Doo::db()->find("Imagenes_hotel", array("asc" => "orden", "where" => "id_hotel = ? ", "param" => array($id_hotel)));
                    //print_r($array_imagenes);

                    if (!empty($array_imagenes)) {
                        $contador_img = 1;
                        foreach ($array_imagenes as $values_img) {
                            if ($contador_img == 1) {
                                $html_img .= '<a class="galeria" title="' . $values_img->descripcion . '" data-lightbox-gallery="' . $id_hotel . '" href="' . Doo::conf()->APP_URL . 'global/' . $values_img->ruta_resize . '"> <img width="250px" height="190px" src="' . Doo::conf()->APP_URL . $datos ['image1'] . '"/> </a>';
                            } else {
                                $html_img .= '<a class="galeria" style="display:none;" title="' . $values_img->descripcion . '" href="' . Doo::conf()->APP_URL . 'global/' . $values_img->ruta_resize . '" data-lightbox-gallery="' . $id_hotel . '"></a>';
                            }
                            $contador_img++;
                        }
                    } else {
                        $html_img .= '<img width="250px" height="190px" src="' . Doo::conf()->APP_URL . $datos ['image1'] . '"/>';
                    }
                    // echo $html_img; echo $id_hotel;<!--<td width="11" height="106" rowspan="2">&nbsp;</td>--> <td width="4" rowspan="2">&nbsp;</td>
                    echo '
                        <table width="100%" border="0" id="tablah" >
					<tr>
                                            <td colspan="4" height="30" >&nbsp;&nbsp;&nbsp;
                                                <font color="#003399" >' . $datos ['nombre'] . '&nbsp;' . ($datos ["categoria"] == 3 ? '<img src="' . Doo::conf()->APP_URL . 'global/img/3.png"  border="0" />' : '' ) . ($datos ["categoria"] == 2 ? '<img src="' . Doo::conf()->APP_URL . 'global/img/2.png"  border="0" />' : '' ) . ($datos ["categoria"] == 4 ? '<img src="' . Doo::conf()->APP_URL . 'global/img/4.png"  border="0" />' : '' ) . '
                                                </font>
                                            </td>
					</tr>
					<tr>
                                            <td style="width: 100%;" colspan=2><div align="left">' . $html_img . '</div> <div style="text-align:justify;    margin-top: -132px;    margin-left: 262px;" >' . $datos['description'] . '</div></td>
                                            
					</tr>
					<tr>
                                            <td width="299" height="21"><font color="#006633">' . ($datos ["breakfast"] == 1 ? 'Free Breakfast' : '') . '</font></td>
                                            <td width="265"><div id="choice" align="right"  >
						';
                    if ($datos['disponibilidad'] == "yes") {

                        echo '<input type="checkbox" id="btn-continue' . $contador . '" name="hotel" value="' . $datos ['id'] . '" class="btns"/>
                                  <label for="btn-continue' . $contador . '">REQUEST</label>';
                    } else {
                        echo '<input type="checkbox" disabled name="hotel" value="' . $datos ['id'] . '" />
                                 <label for="btn-continue' . $contador . '">Not Available</label>
                                 ';
                    }
                    echo '</div></td> <td width="10">&nbsp;</td> </tr> <td width="11">&nbsp;</td>'
                    . '</table><br>';
                    /*
                      if ($datos ["breakfast"] != 1) {
                      echo ' <script>
                      $(".btns").removeAttr("checked").removeClass("ui-helper-hidden-accessible");

                      $(".btns").change(function(){
                      $("#namehotel").html("");
                      $("#roomss").html("");
                      $("#desayuno").html("");
                      $("#tqp").html("$");
                      $("#choice span").html("ADD TO TOUR");
                      $("#choice label").removeClass("ui-state-active");
                      var label = "label:[for="+$(this).attr("id")+"]";
                      if($(this).attr("checked")){
                      var hotel = $(this).val();
                      var rooms = $("#rooms").val();
                      var adult1 = $("#adult1").val();
                      var child1 = $("#child1").val();
                      var adult2 = $("#adult2").val();
                      var child2 = $("#child2").val();
                      var adult3 = $("#adult3").val();
                      var child3 = $("#child3").val();
                      var adult4 = $("#adult4").val();
                      var child4 = $("#child4").val();
                      if(adult2 == null && child2 == null){
                      adult2 = 0;
                      child2 = 0;
                      }
                      if(adult3 == null && child3 == null){
                      adult3 = 0;
                      child3 = 0;
                      }
                      if(adult4 == null && child4 == null){
                      adult4 = 0;
                      child4 = 0;
                      }
                      $(this).removeClass("ui-state-active");
                      $(".clean").html("");
                      $(label).find("span").html("REMOVE FROM TOUR");
                      $("#roomsdistri").load("' . Doo::conf()->APP_URL . 'tours/question16/", {  hotel: hotel, adult1:adult1,child1:child1 , adult2:adult2,child2:child2  , adult3:adult3,child3:child3 , adult4:adult4,child4:child4,rooms:rooms} );
                      }else{
                      $(label).removeClass("ui-state-active");
                      $(label).find("span").html("ADD TO TOUR");
                      $(".clean").html("");
                      }
                      });

                      </script>';
                      } else {
                      echo ' <script>
                      $(".btns").removeAttr("checked").removeClass("ui-helper-hidden-accessible");

                      $(".btns").change(function(){
                      $("#namehotel").html("");
                      $("#roomss").html("");
                      $("#desayuno").html("");
                      $("#tqp").html("$");
                      $("#choice span").html("ADD TO TOUR");
                      $("#choice label").removeClass("ui-state-active");
                      var label = "label:[for="+$(this).attr("id")+"]";
                      if($(this).attr("checked")){
                      var hotel = $(this).val();
                      var rooms = $("#rooms").val();
                      var adult1 = $("#adult1").val();
                      var child1 = $("#child1").val();
                      var adult2 = $("#adult2").val();
                      var child2 = $("#child2").val();
                      var adult3 = $("#adult3").val();
                      var child3 = $("#child3").val();
                      var adult4 = $("#adult4").val();
                      var child4 = $("#child4").val();
                      if(adult2 == null && child2 == null){
                      adult2 = 0;
                      child2 = 0;
                      }
                      if(adult3 == null && child3 == null){
                      adult3 = 0;
                      child3 = 0;
                      }
                      if(adult4 == null && child4 == null){
                      adult4 = 0;
                      child4 = 0;
                      }


                      $(this).removeClass("ui-state-active");
                      $(".clean").html("");
                      $(label).find("span").html("REMOVE FROM TOUR");
                      $("#roomsdistri").load("' . Doo::conf()->APP_URL . 'tours/question16/", {  hotel: hotel, adult1:adult1,child1:child1 , adult2:adult2,child2:child2  , adult3:adult3,child3:child3 , adult4:adult4,child4:child4,rooms:rooms} );
                      }
                      else{

                      $(label).removeClass("ui-state-active");
                      $(label).find("span").html("ADD TO TOUR");
                      $(".clean").html("");
                      }
                      });

                      </script>';
                      } */
                    $contador++;
                }
            }
            echo ' <script>
                    $(".galeria").nivoLightbox({ effect: "fade" });
                    $(".btns").removeAttr("checked").removeClass("ui-helper-hidden-accessible");
													
					$(".btns").change(function(){
					$("#namehotel").html("");
					$("#roomss").html("");
					$("#desayuno").html("");
					$("#tqp").html("$");
					$("#choice span").html("REQUEST");
					$("#choice label").removeClass("ui-state-active");
					var label = "label:[for="+$(this).attr("id")+"]";
					if($(this).attr("checked")){
						var hotel = $(this).val();
						var rooms = $("#rooms").val();	                                            		
						var adult1 = $("#adult1").val();
						var child1 = $("#child1").val();
						var adult2 = $("#adult2").val();
						var child2 = $("#child2").val();
						var adult3 = $("#adult3").val();
						var child3 = $("#child3").val();
						var adult4 = $("#adult4").val();
						var child4 = $("#child4").val();
						if(adult2 == null && child2 == null){
						 adult2 = 0;
						 child2 = 0;
						}
						if(adult3 == null && child3 == null){
						 adult3 = 0;
						 child3 = 0;
						}
						if(adult4 == null && child4 == null){
						 adult4 = 0;
						 child4 = 0;
						}
						$(this).removeClass("ui-state-active");
						$(".clean").html("");
						$(label).find("span").html("REMOVE FROM TOUR");
						$("#roomsdistri").load("' . Doo::conf()->APP_URL . 'tours/question16/", {  hotel: hotel, adult1:adult1,child1:child1 , adult2:adult2,child2:child2  , adult3:adult3,child3:child3 , adult4:adult4,child4:child4,rooms:rooms} );
					}else{
					$(label).removeClass("ui-state-active");
					$(label).find("span").html("REQUEST");
					$(".clean").html("");
					}	
						});					
					
					   </script>';

            $sql1 = "SELECT hoteles.id,codigo,categoria,nombre,address,city,zipcode,contacname,phone,email,webpage,breakfast,resoftfe,description,image1,ratesblock.fecha_ini,ratesblock.fecha_fin
					        FROM hoteles INNER JOIN ratesblock 
						ON (hoteles.id = ratesblock.id_hotel and ((ratesblock.fecha_ini BETWEEN $fecha_llegada AND $fecha_salida) OR (ratesblock.fecha_fin BETWEEN $fecha_llegada AND $fecha_salida)
                                                OR (($fecha_llegada BETWEEN ratesblock.fecha_ini AND ratesblock.fecha_fin ) OR ($fecha_salida BETWEEN ratesblock.fecha_ini AND ratesblock.fecha_fin ))     
                                                )
						AND categoria = " . $categoria . ") GROUP BY hoteles.id";

            $rs1 = Doo::db()->query($sql1) or die('error');

            $hoteles1 = $rs1->fetchAll();
            //$contador = 0;
            foreach ($hoteles1 as $datos) {

                echo '<table width="100%" border="0" id="tablah" >
					  <tr>
						<td colspan="4" height="30" >&nbsp;&nbsp;&nbsp;<font color="#003399" >' . $datos ['nombre'] . '&nbsp;' . ($datos ["categoria"] == 3 ? '<img src="' . Doo::conf()->APP_URL . 'global/img/3.png"  border="0" />' : '' ) . ($datos ["categoria"] == 2 ? '<img src="' . Doo::conf()->APP_URL . 'global/img/2.png"  border="0" />' : '' ) . ($datos ["categoria"] == 4 ? '<img src="' . Doo::conf()->APP_URL . 'global/img/4.png"  border="0" />' : '' ) . '</font> </td>
					  </tr>
					  <tr>
						<td width="11" height="106" rowspan="2">&nbsp;</td>
						<td width="176" height="106" rowspan="2"><div align="left"><img src="' . Doo::conf()->APP_URL . $datos ['image1'] . '"  width="250" height="190" border="0"  /></div></td>
						<td width="4" rowspan="2">&nbsp;</td>
						<td height="82" colspan="2"><div align="center" style="text-align:justify" >' . $datos ['description'] . '</div></td>
						<td height="82">&nbsp;</td>
					  </tr>
					  <tr>
						<td width="299" height="21"><font color="#006633">' . ($datos ["breakfast"] == 1 ? 'Free Breakfast' : '') . '</font>
                   <br/>';

                $fechai = new DateTime();
                $fechai->setTimestamp($fecha_llegada);

                $fechaf = new DateTime();
                $fechaf->setTimestamp($fecha_salida);

                $inicio = false;
                $mes1 = 0;
                $mes2 = 0;
                $di = -1;
                $df = -1;
                // $ini = $fechai->format("d");    
                while ($fechai->getTimestamp() <= $fechaf->getTimestamp() && $fechai->getTimestamp() <= $fecha_salida) {
                    if (($fechai->getTimestamp() >= $fecha_llegada || $fechai->getTimestamp() <= $fecha_salida) && !$inicio) {
                        $di = $fechai->format('d');
                        $mes1 = $fechai->format('M');
                        $inicio = true;
                    } else {
                        $df = $fechai->format("d");
                        $mes2 = $fechai->format("M");
                    }
                    $fechai->setDate($fechai->format("Y"), $fechai->format("m"), $fechai->format("d") + 1);
                }
                echo '<font color="red" >Not available from ' . date('M-d', $datos['fecha_ini']) . ' to ' . date('M-d', $datos['fecha_fin']) . ' </font><br /><br />
                                              </td>
					        <td width="265">                                              
						 
                                                <td width="">
                                                <div id="choice" align="right"  >												
						  <label for="btn-continue' . $contador . '" >Not Available</label>												
						</div>
                                                </td>
						<td width="10">&nbsp;</td>
                                                <td width="11">&nbsp;</td>
					  </tr>
                                          <tr>
                                          <td colspan="4" width="299">
                                                <div style="margin-left:220px;" >
                                               </div></td>
                                          </tr>

					</table>
								 <br>';

                $contador++;
            }
            echo ' <script>
					  $("input","#hotels").button();
					   </script>';
        } catch (Exception $e) {

            // procedimiento en caso de reportar errores
        }
    }

    public function question3() {
        try {

            if (isset($this->params ["id3"]) && isset($this->params ["id33"])) {

                $number = $this->params ["id3"];
                $number2 = $this->params ["id33"];

                if ($number == 3) {

                    echo '<option value="1">1</option>';
                } else {
                    $dato = 4 - $number;
                    for ($i = 1; $i <= $dato; $i++) {
                        echo '<option value="' . $i . '" ' . ($i == trim($number2) ? 'selected' : '') . ' >' . $i . '</option>';
                    }
                }
            }

            if (isset($this->params ["id2"]) && isset($this->params ["id22"])) {

                $number = $this->params ["id2"];
                $number2 = $this->params ["id22"];

                if ($number == 4) {

                    echo '<option value="0">0</option>';
                } else {
                    $dato = 4 - $number;

                    for ($i = 0; $i <= $dato; $i++) {

                        echo '<option value="' . $i . '" ' . ($i == trim($number2) ? 'selected' : '') . '>' . $i . '</option>';
                    }
                }
            }

            if (isset($this->params ["id"])) {

                $rooms = $this->params ["id"];
                echo '<ul style="display:inline-table;"> ';
                for ($i = 1; $i <= $rooms; $i++) {
                    echo '<li style="display:inline-table;border: #76838F 1px solid;background: rgb(215, 219, 230);margin-right: 3px;">';
                    echo '
							 <table width="142" border="0"  id="tours-list">
									  <tr>
										<td width="52" rowspan="2">Room ' . $i . '</td>
										<td width="42">Adults</td>
										<td width="34">Child</td>
									  </tr>
									  <tr>
										<td><select name="adult' . $i . '" id="adult' . $i . '" class="tours-list">
																	<option value="1" >1</option>
																	   <option value="2" selected>2</option>
																		<option value="3">3</option>
																		<option value="4">4</option>
																	  </select></td>
										<td> <select name="child' . $i . '" id="child' . $i . '" class="tours-list">
																		<option value="0" selected >0</option>
																	   <option value="1" >1</option>
																		<option value="2">2</option>
																		
																		
																	  </select></td>
									  </tr>
									</table>
									
									<script>
									         /*seleccion de adulto*/
									        $("#adult' . $i . '").change(function(){
											var id2 = $("#adult' . $i . '").val();
											var id22 = $("#child' . $i . '").val();
											/*alert(id2);*/
											
											$("#child' . $i . '").load("' . Doo::conf()->APP_URL . 'tours/question5/" + id2 + "/" + id22);
                                                                                        

                                                                                        /* Code Include */
                                                                                         
													
					
					$("#namehotel").html("");
					$("#roomss").html("");
					/*$("#desayuno").html("");*/
					$("#tqp").html("$");
					var label = "label:[for="+$(".btns").attr("id")+"]";
					if($(".btns").is(":checked")){
					var hotel = $(".btns").val();
					var rooms = $("#rooms").val();	                                            		
					var adult1 = $("#adult1").val();
					var child1 = $("#child1").val();
					var adult2 = $("#adult2").val();
					var child2 = $("#child2").val();
					var adult3 = $("#adult3").val();
					var child3 = $("#child3").val();
					var adult4 = $("#adult4").val();
					var child4 = $("#child4").val();
					if(adult2 == null && child2 == null){
					 adult2 = 0;
					 child2 = 0;
					}
					if(adult3 == null && child3 == null){
					 adult3 = 0;
					 child3 = 0;
					}
					if(adult4 == null && child4 == null){
					 adult4 = 0;
					 child4 = 0;
					}
					
					
					
                    $(".clean").html("");
				        
				    $("#roomsdistri").load("' . Doo::conf()->APP_URL . 'tours/question16/", {  hotel: hotel, adult1:adult1,child1:child1 , adult2:adult2,child2:child2  , adult3:adult3,child3:child3 , adult4:adult4,child4:child4,rooms:rooms} );
						}
					else{
					
					$(label).removeClass("ui-state-active");
					$(label).find("span").html("REQUEST");
					$(".clean").html("");
					}	
						
                                                
                                        /*fincode Include*/
   				       }); 
										 /*seleccion de niño*/ 
										  $("#child' . $i . '").change(function(){
											var id3 = $("#child' . $i . '").val();
											var id33 = $("#adult' . $i . '").val();
											
											/*alert(id3);*/
											$("#adult' . $i . '").load("' . Doo::conf()->APP_URL . 'tours/question6/" + id3 + "/" + id33);
                                                                                            
  /* Code Include */
                			$("#namehotel").html("");
					$("#roomss").html("");
					/*$("#desayuno").html("");*/
					$("#tqp").html("$");
					var label = "label:[for="+$(".btns").attr("id")+"]";
					if($(".btns").attr("checked")){
					var hotel = $(".btns").val();
					var rooms = $("#rooms").val();	                                            		
					var adult1 = $("#adult1").val();
					var child1 = $("#child1").val();
					var adult2 = $("#adult2").val();
					var child2 = $("#child2").val();
					var adult3 = $("#adult3").val();
					var child3 = $("#child3").val();
					var adult4 = $("#adult4").val();
					var child4 = $("#child4").val();
					if(adult2 == null && child2 == null){
					 adult2 = 0;
					 child2 = 0;
					}
					if(adult3 == null && child3 == null){
					 adult3 = 0;
					 child3 = 0;
					}
					if(adult4 == null && child4 == null){
					 adult4 = 0;
					 child4 = 0;
					}
			            $(".btns").removeClass("ui-state-active");
                                    $(".clean").html("");
				    $(label).find("span").html("REMOVE FROM TOUR");
				    $("#roomsdistri").load("' . Doo::conf()->APP_URL . 'tours/question16/", {  hotel: hotel, adult1:adult1,child1:child1 , adult2:adult2,child2:child2  , adult3:adult3,child3:child3 , adult4:adult4,child4:child4,rooms:rooms} );
						}
					else{
					
					$(label).removeClass("ui-state-active");
					$(label).find("span").html("REQUEST");
					$(".clean").html("");
					}	
						
                                                
                                                      /*fincode Include*/
                                         
					  });
				  </script>
							  
							  ';
                    echo '</li> ';
                }
                echo '</ul> ';
                echo '<script>  $(".tours-list").change(function(){
									$("#tqp").html("$");
									$( ".btns" ).button( "destroy" );
								$( ".btns:radio").attr("checked", false);
								$( ".btns" ).button(  );
									
									$("#namehotel").html("");
								$("#roomss").html("");
								$("#desayuno").html("");
									
								  });</script>';
            }
        } catch (Exception $e) {

            // procedimiento en caso de reportar errores
        }
    }

    public function tours_two() {
        $_SESSION['step-two'] = true;
        try {
            extract($_POST, EXTR_SKIP);

            //print_r($_POST); exit();


            Doo::loadModel("Agency");
            if (isset($_SESSION['data_agency'])) {
                $dat = new Agency($_SESSION['data_agency']);
                $net_rate = ($dat->type_rate == 1) ? true : false;
            } else {
                $dat = new Agency();
                $net_rate = false;
                $dat->type_rate = 0;
                $dat->id = -1;
            }

            $toursbooking = $_SESSION["toursbooking"];
            $fecha = new DateTime();
            $fecha->setTimestamp(strtotime($toursbooking ['fecha_llegada']));

            $fecha2 = new DateTime();
            $fecha2->setTimestamp(strtotime($toursbooking ['fecha_llegada']));

            $fecha3 = new DateTime();
            $fecha3->setTimestamp(strtotime($toursbooking ['fecha_llegada']));

            $fecha4 = new DateTime();
            $fecha4->setTimestamp(strtotime($toursbooking ['fecha_llegada']));

            $fecha_fin = new DateTime();
            $fecha_fin->setTimestamp(strtotime($toursbooking ['fecha_salida']));

            $sql = 'SELECT t1.id,t1.breakfast,t1.resoftfe,t1.nombre,t3.sgl,t3.dbl,t3.tpl,t3.qua,t3.breackfast,t1.super_breakfast
									 FROM hoteles t1												 
		     LEFT JOIN comifijas t3 ON (t1.id = t3.id_hotel AND t3.comtax = 1 AND t3.fecha_ini <= ' . strtotime($toursbooking ['fecha_llegada']) . '                                             AND t3.fecha_fin  >= ' . strtotime($toursbooking ['fecha_salida']) . ')
									WHERE t1.id = ?';

            $rs = Doo::db()->query($sql, array(
                $hotel
            ));

            $costohotel = $rs->fetch();

            /* print_r($costohotel);
              exit */
            // breakfast and resoftfe

            /*
             * if($costohotel['resoftfe'] == 1) { $resoftfe =
             * $costohotel['resortprice']; } else { $resoftfe =0 ; }
             */
            $desayuno1 = 0;
            $desayuno2 = 0;
            $desayuno3 = 0;
            $desayuno4 = 0;
            if (isset($adult1)) {
                while ($fecha->format("Y-m-d") < $fecha_fin->format("Y-m-d")) {

                    //$fec = strtotime($toursbooking ['fecha_llegada']);//$fecha->getTimestamp();
                    $fec = $fecha->getTimestamp();
                    if ($dat->type_rate == 0) {

                        $sql = 'SELECT t1.id,t1.breakfast,t1.super_breakfast, t1.resoftfe,t1.nombre,t3.sgl,t3.dbl,t3.tpl,t3.qua,t3.breackfast, t1.categoria
			 		FROM hoteles t1	
						LEFT JOIN comifijas t3 ON (t1.id = t3.id_hotel 
								AND t3.comtax = 1 
								AND t3.fecha_ini <= ' . $fec . ' 
								AND t3.fecha_fin  >= ' . $fec . ')
					WHERE t3.id_hotel  = ' . $hotel . '';
                    } else {
                        $sql = 'SELECT t1.id,t1.breakfast,t1.super_breakfast ,t1.resoftfe,t1.nombre,t3.sgl,t3.dbl,t3.tpl,t3.qua,t3.breackfast, t1.categoria
			 		FROM hoteles t1	
						LEFT JOIN comifijas t3 ON (t1.id = t3.id_hotel 
								AND t3.netax = 1 
								AND t3.fecha_ini <= ' . $fec . ' 
								AND t3.fecha_fin  >= ' . $fec . ')
				    	WHERE t3.id_hotel  = ' . $hotel . '';
                    }
                    $rs = Doo::db()->query($sql);
                    $costohotel = $rs->fetch();
                    if (empty($costohotel)) {
                        echo ' <script>$("input[type=\'checkbox\'").attr("checked",false).change();
                            $( "#dialog-message-t" ).dialog({
                                modal: true,
                                buttons: {
                                    Ok: function() {
                                        $( this ).dialog( "close" );
                                    }
                                }
                            });</script>
                     ';
                        exit;
                    }
                    if ($adult1 == 1) {
                        $totalhotel1v += $costohotel ['sgl'];
                    }
                    if ($adult1 == 2) {
                        $totalhotel1v += $costohotel ['dbl'];
                    }
                    if ($adult1 == 3) {
                        $totalhotel1v += $costohotel ['tpl'];
                    }
                    if ($adult1 == 4) {
                        $totalhotel1v += $costohotel ['qua'];
                    }
                    if ($costohotel['super_breakfast'] == 1) {
                        $desayuno1 += ($costohotel ['breackfast']);
                    } else {
                        $desayuno1 += 0;
                        $breakfast = 0;
                    }
                    date_add($fecha, date_interval_create_from_date_string('1 days'));
                    
                }
                $totalhotel1 = (ceil($totalhotel1v) * $adult1);
                $desayuno1 = $desayuno1 * $adult1;
                //echo $desayuno1;
            } else {
                $totalhotel1 = 0;
            }
            // /room # 2
            if (isset($adult2)) {

                while ($fecha2->format("Y-m-d") < $fecha_fin->format("Y-m-d")) {

                    //$fec = strtotime($toursbooking ['fecha_llegada']);//$fecha->getTimestamp();
                    $fec = $fecha2->getTimestamp();
                    if ($dat->type_rate == 0) {

                        $sql = 'SELECT t1.id,t1.breakfast,t1.super_breakfast, t1.resoftfe,t1.nombre,t3.sgl,t3.dbl,t3.tpl,t3.qua,t3.breackfast, t1.categoria
			 		FROM hoteles t1	
						LEFT JOIN comifijas t3 ON (t1.id = t3.id_hotel 
								AND t3.comtax = 1 
								AND t3.fecha_ini <= ' . $fec . ' 
								AND t3.fecha_fin  >= ' . $fec . ')
					WHERE t3.id_hotel  = ' . $hotel . '';
                    } else {
                        $sql = 'SELECT t1.id,t1.breakfast,t1.super_breakfast ,t1.resoftfe,t1.nombre,t3.sgl,t3.dbl,t3.tpl,t3.qua,t3.breackfast, t1.categoria
			 		FROM hoteles t1	
						LEFT JOIN comifijas t3 ON (t1.id = t3.id_hotel 
								AND t3.netax = 1 
								AND t3.fecha_ini <= ' . $fec . ' 
								AND t3.fecha_fin  >= ' . $fec . ')
				    	WHERE t3.id_hotel  = ' . $hotel . '';
                    }
                    $rs = Doo::db()->query($sql);
                    $costohotel = $rs->fetch();
                    if (empty($costohotel)) {
                        echo ' <script>$("input[type=\'checkbox\'").attr("checked",false).change();
                            $( "#dialog-message-t" ).dialog({
                                modal: true,
                                buttons: {
                                    Ok: function() {
                                        $( this ).dialog( "close" );
                                    }
                                }
                            });</script>
                     ';
                        exit;
                    }

                    if ($adult2 == 1) {

                        $totalhotel2v += $costohotel ['sgl'];
                    }
                    if ($adult2 == 2) {

                        $totalhotel2v += $costohotel ['dbl'];
                    }
                    if ($adult2 == 3) {

                        $totalhotel2v += $costohotel ['tpl'];
                    }
                    if ($adult2 == 4) {

                        $totalhotel2v += $costohotel ['qua'];
                    }
                    if ($adult2 == 0) {

                        $totalhotel2v = 0;
                    }
                    if (($costohotel['super_breakfast'] == 1)) {
                        $desayuno2 += ($costohotel ['breackfast'] );
                    } else {
                        $desayuno2 += 0;
                        $breakfast = 0;
                    }

                    date_add($fecha2, date_interval_create_from_date_string('1 days'));
                }

                $totalhotel2 = ceil($totalhotel2v) * $adult2;
                $desayuno2 = $desayuno2 * $adult2;
            } else {
                $totalhotel2 = 0;
            }
            // /room # 3
            if (isset($adult3)) {
                while ($fecha3->format("Y-m-d") < $fecha_fin->format("Y-m-d")) {

                    //$fec = strtotime($toursbooking ['fecha_llegada']);//$fecha->getTimestamp();
                    $fec = $fecha3->getTimestamp();
                    if ($dat->type_rate == 0) {

                        $sql = 'SELECT t1.id,t1.breakfast,t1.super_breakfast, t1.resoftfe,t1.nombre,t3.sgl,t3.dbl,t3.tpl,t3.qua,t3.breackfast, t1.categoria
			 		FROM hoteles t1	
						LEFT JOIN comifijas t3 ON (t1.id = t3.id_hotel 
								AND t3.comtax = 1 
								AND t3.fecha_ini <= ' . $fec . ' 
								AND t3.fecha_fin  >= ' . $fec . ')
					WHERE t3.id_hotel  = ' . $hotel . '';
                    } else {
                        $sql = 'SELECT t1.id,t1.breakfast,t1.super_breakfast ,t1.resoftfe,t1.nombre,t3.sgl,t3.dbl,t3.tpl,t3.qua,t3.breackfast, t1.categoria
			 		FROM hoteles t1	
						LEFT JOIN comifijas t3 ON (t1.id = t3.id_hotel 
								AND t3.netax = 1 
								AND t3.fecha_ini <= ' . $fec . ' 
								AND t3.fecha_fin  >= ' . $fec . ')
				    	WHERE t3.id_hotel  = ' . $hotel . '';
                    }
                    $rs = Doo::db()->query($sql);
                    $costohotel = $rs->fetch();
                    if (empty($costohotel)) {
                        echo ' <script>$("input[type=\'checkbox\'").attr("checked",false).change();
                            $( "#dialog-message-t" ).dialog({
                                modal: true,
                                buttons: {
                                    Ok: function() {
                                        $( this ).dialog( "close" );
                                    }
                                }
                            });</script>
                     ';
                        exit;
                    }

                    if ($adult3 == 1) {

                        $totalhotel3v += $costohotel ['sgl'];
                    }
                    if ($adult3 == 2) {

                        $totalhotel3v += $costohotel ['dbl'];
                    }
                    if ($adult3 == 3) {

                        $totalhotel3v += $costohotel ['tpl'];
                    }
                    if ($adult3 == 4) {

                        $totalhotel3v += $costohotel ['qua'];
                    }
                    if ($adult3 == 0) {

                        $totalhotel3v = 0;
                    }
                    if (($costohotel['super_breakfast'] == 1)) {
                        $desayuno3 += ($costohotel ['breackfast'] );
                    } else {
                        $desayuno3 += 0;
                        $breakfast = 0;
                    }
                    date_add($fecha3, date_interval_create_from_date_string('1 days'));
                }
                $totalhotel3 = (ceil($totalhotel3v) * $adult3);
                $desayuno3 = $desayuno3 * $adult3;
            } else {
                $totalhotel3 = 0;
            }
            // /room # 4
            if (isset($adult4)) {
                while ($fecha4->format("Y-m-d") < $fecha_fin->format("Y-m-d")) {

                    //$fec = strtotime($toursbooking ['fecha_llegada']);//$fecha->getTimestamp();
                    $fec = $fecha4->getTimestamp();
                    if ($dat->type_rate == 0) {

                        $sql = 'SELECT t1.id,t1.breakfast,t1.super_breakfast, t1.resoftfe,t1.nombre,t3.sgl,t3.dbl,t3.tpl,t3.qua,t3.breackfast, t1.categoria
			 		FROM hoteles t1	
						LEFT JOIN comifijas t3 ON (t1.id = t3.id_hotel 
								AND t3.comtax = 1 
								AND t3.fecha_ini <= ' . $fec . ' 
								AND t3.fecha_fin  >= ' . $fec . ')
					WHERE t3.id_hotel  = ' . $hotel . '';
                    } else {
                        $sql = 'SELECT t1.id,t1.breakfast,t1.super_breakfast ,t1.resoftfe,t1.nombre,t3.sgl,t3.dbl,t3.tpl,t3.qua,t3.breackfast, t1.categoria
			 		FROM hoteles t1	
						LEFT JOIN comifijas t3 ON (t1.id = t3.id_hotel 
								AND t3.netax = 1 
								AND t3.fecha_ini <= ' . $fec . ' 
								AND t3.fecha_fin  >= ' . $fec . ')
				    	WHERE t3.id_hotel  = ' . $hotel . '';
                    }
                    $rs = Doo::db()->query($sql);
                    $costohotel = $rs->fetch(); 
                    if (empty($costohotel)) {
                        echo ' <script>$("input[type=\'checkbox\'").attr("checked",false).change();
                            $( "#dialog-message-t" ).dialog({
                                modal: true,
                                buttons: {
                                    Ok: function() {
                                        $( this ).dialog( "close" );
                                    }
                                }
                            });</script>
                     ';
                        exit;
                    }
                    if ($adult4 == 1) {

                        $totalhotel4v += $costohotel ['sgl'];
                    }
                    if ($adult4 == 2) {

                        $totalhotel4v += $costohotel ['dbl'];
                    }
                    if ($adult4 == 3) {

                        $totalhotel4v += $costohotel ['tpl'];
                    }
                    if ($adult4 == 4) {

                        $totalhotel4v += $costohotel ['qua'];
                    }
                    if ($adult4 == 0) {

                        $totalhotel4v = 0;
                    }
                    if (($costohotel['super_breakfast'] == 1)) {
                        $desayuno4 += ($costohotel ['breackfast'] );
                    } else {
                        $desayuno4 += 0;
                        $breakfast = 0;
                    }
                    date_add($fecha4, date_interval_create_from_date_string('1 days'));
                }
                $totalhotel4 = (ceil($totalhotel4v) * $adult4);
                $desayuno4 = $desayuno4 * $adult4;
            } else {
                $totalhotel4 = 0;
            }


            $desayuno = $desayuno1 + $desayuno2 + $desayuno3 + $desayuno4;

            //echo $desayuno1;

            //Todavia no se le suma el desayuno
            //$tohotel = $totalhotel1 + $totalhotel2 + $totalhotel3 + $totalhotel4+$desayuno;
            $tohotel = $totalhotel1 + $totalhotel2 + $totalhotel3 + $totalhotel4;
            //echo $tohotel;exit;
            // //////////////////////////////////////cierre service hotel
            // ////////////////////////////////////// service hotel
            // if adult cantidad

            if (!isset($adult1)) {
                $adult1 = 0;
            }

            if (!isset($adult2)) {
                $adult2 = 0;
            }
            if (!isset($adult3)) {
                $adult3 = 0;
            }
            if (!isset($adult4)) {
                $adult4 = 0;
            }

            // if child cantidad
            if (!isset($child1)) {
                $child1 = 0;
            }

            if (!isset($child2)) {
                $child2 = 0;
            }
            if (!isset($child3)) {
                $child3 = 0;
            }
            if (!isset($child4)) {
                $child4 = 0;
            }

            $_SESSION ["toursbooking"]['adult_r1'] = $adult1;
            $_SESSION ["toursbooking"]['adult_r2'] = $adult2;
            $_SESSION ["toursbooking"]['adult_r3'] = $adult3;
            $_SESSION ["toursbooking"]['adult_r4'] = $adult4;
            $_SESSION ["toursbooking"]['child_r1'] = $child1;
            $_SESSION ["toursbooking"]['child_r2'] = $child2;
            $_SESSION ["toursbooking"]['child_r3'] = $child3;
            $_SESSION ["toursbooking"]['child_r4'] = $child4;

            $totaladult = $adult1 + $adult2 + $adult3 + $adult4;
            $totalchild = $child1 + $child2 + $child3 + $child4;
            $totalpax = $totaladult + $totalchild;

            if ($totalpax == 0) {
                return Doo::conf()->APP_URL . "tours";
                exit;
            }
            
            if (isset($_SESSION ['menosbuff'])) {
                if($_SESSION ['menosbuff']['buff'] == "SUPER BREKFAST BUFFET"){
                    $desayuno = $desayuno;
                }else{
                    $desayuno = 0;
                }
                $breakfast = $buffet;
                
            } else {
                $desayuno = $desayuno;
            }


            if (isset($toursbooking ['trip1'])) {
                Doo::loadController('admin/ToursController');
                $toursOperador = new ToursController();
                $anio = substr($toursbooking['fecha_llegada'], 0, 4);
                $prices = $toursOperador->precioTripTours($toursbooking ['trip1'], $dat->type_rate, $dat->id, $anio);

                if (!empty($prices)) {
                    $priceadult1 = $prices ['adult'] * $totaladult;
                    $pricechild1 = $prices ['child'] * $totalchild;
                    $trip1 = number_format($priceadult1, 2, '.', '') + number_format($pricechild1, 2, '.', '');
                    $_SESSION['toursbooking']['trasport_total1'] = $trip1;
                    $_SESSION['toursbooking']['trasport_por_adult'] = $priceadult1;
                    $_SESSION['toursbooking']['trasport_por_child'] = $pricechild1;
                } else {
                    $trip1 = 0;
                    $priceadult1 = 0;
                    $pricechild1 = 0;
                }
            } else {
                $trip1 = 0;
                $priceadult1 = 0;
                $pricechild1 = 0;
            }
            if (isset($toursbooking ['trip2'])) {
                Doo::loadController('admin/ToursController');
                $toursOperador = new ToursController();
                $anio = substr($toursbooking['fecha_salida'], 0, 4);
                $prices = $toursOperador->precioTripTours($toursbooking ['trip2'], $dat->type_rate, $dat->id, $anio);
                if (!empty($prices)) {
                    $priceadult2 = $prices ['adult'] * $totaladult;
                    $pricechild2 = $prices ['child'] * $totalchild;
                    $trip2 = number_format($pricechild2, 2, '.', '') + number_format($priceadult2, 2, '.', '');
                    $_SESSION['toursbooking']['trasport_total2'] = $trip2;

                    $_SESSION['toursbooking']['trasport_por_adult'] = $_SESSION['toursbooking']['trasport_por_adult'] + $priceadult2;
                    $_SESSION['toursbooking']['trasport_por_child'] = $_SESSION['toursbooking']['trasport_por_child'] + $pricechild2;
                } else {
                    $trip2 = 0;
                    $priceadult2 = 0;
                    $pricechild2 = 0;
                }
            } else {
                $trip2 = 0;
                $priceadult2 = 0;
                $pricechild2 = 0;
            }

            /* echo json_encode($_SESSION['toursbooking']);
              exit; */

            if ($toursbooking ['sarrival'] == 2) {
                $fechal = substr($toursbooking['fecha_llegada'], 0, 4) . '-01-01 00:00:00';
                if ($dat->type_rate == 1) {// Se busca SpecialNet
                    $sql = 'SELECT id,cantidad,price
				FROM tarifasvip 
				WHERE cantidad = ? 
					AND (type_rate = ? )
					AND (id_agency = ? or id_agency = -1 )
					AND annio = ?
				ORDER BY type_rate Desc LIMIT 1';
                    $type = 2;
                    $rs = Doo::db()->query($sql, array($totalpax, $type, $dat->id, $fechal));
                    $pricesvip = $rs->fetch();

                    if (empty($pricesvip)) {//Si no encuentra Buscamos Net.
                        $sql = 'SELECT id,cantidad,price
				FROM tarifasvip 
				WHERE cantidad = ? 
					AND (type_rate = ? )
					AND (id_agency = ? or id_agency = -1 )
					AND annio = ?
				ORDER BY type_rate Desc LIMIT 1';
                        $type = 1;
                        $rs = Doo::db()->query($sql, array($totalpax, $type, $dat->id, $fechal));
                        $pricesvip = $rs->fetch();
                    }
                } else {
                    $sql = 'SELECT id,cantidad,price
				FROM tarifasvip 
				WHERE cantidad = ? 
					AND (type_rate = ? )
					AND (id_agency = ? or id_agency = -1 )
					AND annio = ?
				ORDER BY type_rate Desc LIMIT 1';
                    $rs = Doo::db()->query($sql, array($totalpax, $dat->type_rate, $dat->id, $fechal));
                    $pricesvip = $rs->fetch();
                }

                if (!empty($pricesvip)) {
                    $vip1 = number_format($pricesvip ['price'], 2, '.', '');
                    $_SESSION['toursbooking']['trasport_total1'] = $vip1;
                }
            } else {
                $vip1 = 0;
            }

            if ($toursbooking ['sdeparture'] == 2) {
                $fechas = substr($toursbooking['fecha_salida'], 0, 4) . '-01-01 00:00:00';
                if ($dat->type_rate == 1) {// Se busca SpecialNet
                    $sql = 'SELECT id,cantidad,price
				FROM tarifasvip 
				WHERE cantidad = ? 
					AND (type_rate = ? )
					AND (id_agency = ? or id_agency = -1 )
					AND annio = ?
				ORDER BY type_rate Desc LIMIT 1';
                    $type = 2;
                    $rs = Doo::db()->query($sql, array($totalpax, $type, $dat->id, $fechas));
                    $pricesvip = $rs->fetch();

                    if (empty($pricesvip)) {//Si no encuentra Buscamos Net.
                        $sql = 'SELECT id,cantidad,price
				FROM tarifasvip 
				WHERE cantidad = ? 
					AND (type_rate = ? )
					AND (id_agency = ? or id_agency = -1 )
					AND annio = ?
				ORDER BY type_rate Desc LIMIT 1';
                        $type = 1;
                        $rs = Doo::db()->query($sql, array($totalpax, $type, $dat->id, $fechas));
                        $pricesvip = $rs->fetch();
                    }
                } else {
                    $sql = 'SELECT id,cantidad,price
				FROM tarifasvip 
				WHERE cantidad = ? 
					AND (type_rate = ? )
					AND (id_agency = ? or id_agency = -1 )
					AND annio = ?
				ORDER BY type_rate Desc LIMIT 1';
                    $rs = Doo::db()->query($sql, array($totalpax, $dat->type_rate, $dat->id, $fechas));
                    $pricesvip = $rs->fetch();
                }

                if (!empty($pricesvip)) {
                    $vip2 = number_format($pricesvip ['price'], 2, '.', '');
                    $_SESSION['toursbooking']['trasport_total2'] = $vip2;
                }
            } else {
                $vip2 = 0;
            }

            /* if prices transfer in airport */
            if ($toursbooking ['sarrival'] == 3) {
                $fechal = substr($toursbooking['fecha_llegada'], 0, 4) . '-01-01 00:00:00';
                if ($dat->type_rate == 1) {// Se busca SpecialNet
                    $sql = 'SELECT id,cantidad,price
				FROM tarifaplane 
				WHERE cantidad = ? 
					AND (type_rate = ? )
					AND (id_agency = ? or id_agency = -1 ) 
                                        AND annio = ?
				ORDER BY type_rate Desc LIMIT 1';
                    $type = 2;
                    $rs = Doo::db()->query($sql, array($totalpax, $type, $dat->id, $fechal));
                    $pricesbyplane = $rs->fetch();

                    if (empty($pricesbyplane)) {//Si no encuentra Buscamos Net.
                        $sql = 'SELECT id,cantidad,price
				FROM tarifaplane 
				WHERE cantidad = ? 
					AND (type_rate = ? )
					AND (id_agency = ? or id_agency = -1 ) 
                                        AND annio = ?
				ORDER BY type_rate Desc LIMIT 1';
                        $type = 1;
                        $rs = Doo::db()->query($sql, array($totalpax, $type, $dat->id, $fechal));
                        $pricesbyplane = $rs->fetch();
                    }
                } else {
                    $sql = 'SELECT id,cantidad,price
				FROM tarifaplane 
				WHERE cantidad = ? 
					AND (type_rate = ? )
					AND (id_agency = ? or id_agency = -1 ) 
                                        AND annio = ?
				ORDER BY type_rate Desc LIMIT 1';
                    $rs = Doo::db()->query($sql, array($totalpax, $dat->type_rate, $dat->id, $fechal));
                    $pricesbyplane = $rs->fetch();
                }

                if (!empty($pricesbyplane)) {
                    $byplane1 = number_format($pricesbyplane ['price'], 2, '.', '');
                    $_SESSION['toursbooking']['trasport_total1'] = $byplane1;
                }
            } else {
                $byplane1 = 0;
            }

            if ($toursbooking ['sdeparture'] == 3) {
                $fechas = substr($toursbooking['fecha_salida'], 0, 4) . '-01-01 00:00:00';
                if ($dat->type_rate == 1) {// Se busca SpecialNet
                    $sql = 'SELECT id,cantidad,price
				FROM tarifaplane 
				WHERE cantidad = ? 
					AND (type_rate = ? )
					AND (id_agency = ? or id_agency = -1 ) 
                                        AND annio = ?
				ORDER BY type_rate Desc LIMIT 1';
                    $type = 2;
                    $rs = Doo::db()->query($sql, array($totalpax, $type, $dat->id, $fechas));
                    $pricesbyplane = $rs->fetch();

                    if (empty($pricesbyplane)) {//Si no encuentra Buscamos Net.
                        $sql = 'SELECT id,cantidad,price
				FROM tarifaplane 
				WHERE cantidad = ? 
					AND (type_rate = ? )
					AND (id_agency = ? or id_agency = -1 ) 
                                        AND annio = ?
				ORDER BY type_rate Desc LIMIT 1';
                        $type = 1;
                        $rs = Doo::db()->query($sql, array($totalpax, $type, $dat->id, $fechas));
                        $pricesbyplane = $rs->fetch();
                    }
                } else {
                    $sql = 'SELECT id,cantidad,price
				FROM tarifaplane 
				WHERE cantidad = ? 
					AND (type_rate = ? )
					AND (id_agency = ? or id_agency = -1 ) 
                                        AND annio = ?
				ORDER BY type_rate Desc LIMIT 1';
                    $rs = Doo::db()->query($sql, array($totalpax, $dat->type_rate, $dat->id, $fechas));
                    $pricesbyplane = $rs->fetch();
                }

                if (!empty($pricesbyplane)) {
                    $byplane2 = number_format($pricesbyplane ['price'], 2, '.', '');
                    $_SESSION['toursbooking']['trasport_total2'] = $byplane2;
                }
            } else {
                $byplane2 = 0;
            }

            /* if prices by car */

            if ($toursbooking ['sarrival'] == 4) {

                $fechal = substr($toursbooking['fecha_llegada'], 0, 4) . '-01-01 00:00:00';
                if ($dat->type_rate == 1) {// Se busca SpecialNet
                    $sql = 'SELECT id,price
				FROM tarifacar 
				WHERE (type_rate = ? )
					AND (id_agency = ? or id_agency = -1 )
					AND annio = ?
				ORDER BY type_rate Desc LIMIT 1';
                    $type = 2;
                    $rs = Doo::db()->query($sql, array($type, $dat->id, $fechal));
                    $pricescar = $rs->fetch();

                    if (empty($pricescar)) {//Si no encuentra Buscamos Net.
                        $sql = 'SELECT id,price
				FROM tarifacar 
				WHERE (type_rate = ? )
					AND (id_agency = ? or id_agency = -1 )
					AND annio = ?
				ORDER BY type_rate Desc LIMIT 1';
                        $type = 1;
                        $rs = Doo::db()->query($sql, array($type, $dat->id, $fechal));
                        $pricescar = $rs->fetch();
                    }
                } else {
                    $sql = 'SELECT id,price
				FROM tarifacar 
				WHERE (type_rate = ? )
					AND (id_agency = ? or id_agency = -1 )
					AND annio = ?
				ORDER BY type_rate Desc LIMIT 1';
                    $rs = Doo::db()->query($sql, array($dat->type_rate, $dat->id, $fechal));
                    $pricescar = $rs->fetch();
                }

                if (!empty($pricescar)) {
                    $car = number_format($pricescar ['price'], 2, '.', '');
                    $_SESSION['toursbooking']['trasport_total1'] = $car;
                }
            } else {
                $car = 0;
            }
            
            
            $tq = $trip1 + $trip2 + $vip1 + $vip2 + $byplane1 + $byplane2 + $car + $tohotel + $desayuno;
            
            // echo "TQ".number_format($tq,2,'.','');
            // //////////////////////////////////cierre services transporte
            $_SESSION ['toursbooking'] ['tq'] = $tq/* $_SESSION['toursbooking']['tq'] */;
            $_SESSION ['toursbooking'] ['tq1'] = $_SESSION ['toursbooking'] ['tq'];
            $_SESSION ['toursbooking'] ['tqp'] = $tq / $totalpax;
            $_SESSION ['toursbooking'] ['tqp1'] = $_SESSION ['toursbooking'] ['tqp'];
            $_SESSION ['toursbooking'] ['dbufe'] = $breakfast;
            $_SESSION ["toursbooking"] ["totalhotel"] = $tohotel;
            $_SESSION ["toursbooking"] ["transport1"] = $trip1 + $trip2 + $vip1 + $vip2 + $byplane1 + $byplane2 + $car;
            $_SESSION ["toursbooking"] ["hotel"] = $costohotel ['nombre'];
            $_SESSION ["toursbooking"] ["desayuno"] = $desayuno;
            $_SESSION ["toursbooking"] ["hotelid"] = $hotel;
            $_SESSION ["toursbooking"] ["rooms"] = $rooms;
            $_SESSION ["toursbooking"] ["adults"] = $totaladult;
            $_SESSION ["toursbooking"] ["totalpax"] = $totalpax;
            $_SESSION ["toursbooking"] ["childs"] = $totalchild;
            $_SESSION ["toursbooking"] ["totaltotal"] = number_format(($totalpax * $_SESSION['toursbooking']['tqp']), 2, '.', '');
            $_SESSION ["toursbooking"] ["comision_agency"] = number_format(((!$net_rate) ? (( $_SESSION ["toursbooking"] ["totaltotal"] ) * (($this->cal_equipament()) / 100)) : 10.00), 2, '.', '');

            echo '<script>location.href="' . Doo::conf()->APP_URL . "tours/step-three" . '"</script>';
            return Doo::conf()->APP_URL . "tours/step-three";
        } catch (Exception $e) {

            // procedimiento en caso de reportar errores
        }
    }

    public function step_three() {
        /* echo json_encode($_SESSION['toursbooking']);
          exit;isset($_SESSION['step-two']) && */
        if (isset($_SESSION ['toursbooking'])) {
            $_SESSION['num'] = 0;
            $_SESSION['var'] = '';
            if (isset($_SESSION['onedaytour'])) {
                if ($_SESSION['onedaytour'] == true) {
                    return Doo::conf()->APP_URL . "tours";
                    exit;
                }
            }
            if ($_SESSION ['toursbooking']["totalpax"] == 0) {
                return Doo::conf()->APP_URL . "tours";
                exit;
            }
            try {
                if (isset($_SESSION ['toursbooking'] ['pasopostpark'])) {

                    unset($_SESSION ['toursbooking'] ['pasopostpark']);
                }
                if (isset($_SESSION ['toursbooking'] ['parktotal'])) {
                    unset($_SESSION ['toursbooking'] ['parktotal']);
                }
                if (isset($_SESSION ['toursbooking'] ['tqp'])) {

                    unset($_SESSION ['toursbooking'] ['tqp']);
                }

                if (isset($_SESSION ['grupos'])) {
                    unset($_SESSION ['grupos']);
                }
                if (isset($_SESSION ['grupos1'])) {
                    unset($_SESSION ['grupos1']);
                }
                if (isset($_SESSION ['toursbooking'] ['ticketpark'])) {
                    unset($_SESSION ['toursbooking'] ['ticketpark']);
                }

                if (isset($_SESSION ['toursbooking'] ['ticketpark'])) {
                    unset($_SESSION ['toursbooking'] ['paso']);
                }
                unset($_SESSION['step-two']);
                /** Imagenes de Magic Kingdom * */
                $id_parque = 7;
                $mgk = Doo::db()->find("Imagenes_parques", array("asc" => "orden", "where" => "id_parques = ? ", "param" => array($id_parque)));
                //print_r($mgk);
                $html_img = "";
                if (!empty($mgk)) {
                    $contador_img = 1;
                    foreach ($mgk as $values_img) {
                        if ($contador_img == 1) {
                            $html_img .= '<a class="galeria" title="' . $values_img->descripcion . '" data-lightbox-gallery="' . $id_parque . '" href="' . Doo::conf()->APP_URL . 'global/' . $values_img->ruta_resize . '"> <img  src="' . Doo::conf()->APP_URL . 'global/img/wall-disney-mk.png"/> </a>';
                        } else {
                            $html_img .= '<a class="galeria" style="display:none;" title="' . $values_img->descripcion . '" href="' . Doo::conf()->APP_URL . 'global/' . $values_img->ruta_resize . '" data-lightbox-gallery="' . $id_parque . '"></a>';
                        }
                        $contador_img++;
                    }
                } else {
                    $html_img .= '<img  src="' . Doo::conf()->APP_URL . 'global/img/wall-disney-mk.png"/>';
                }
                $this->data["magk"] = $html_img;
                /** Fin Magic Kingdom */
                /** Imagenes de Epcot * */
                $id_parque = 8;
                $epcot = Doo::db()->find("Imagenes_parques", array("asc" => "orden", "where" => "id_parques = ? ", "param" => array($id_parque)));

                $html_img = "";
                if (!empty($epcot)) {
                    $contador_img = 1;
                    foreach ($epcot as $values_img) {
                        if ($contador_img == 1) {
                            $html_img .= '<a class="galeria" title="' . $values_img->descripcion . '" data-lightbox-gallery="' . $id_parque . '" href="' . Doo::conf()->APP_URL . 'global/' . $values_img->ruta_resize . '"> <img  src="' . Doo::conf()->APP_URL . 'global/img/wall-disney-epcot.png"/> </a>';
                        } else {
                            $html_img .= '<a class="galeria" style="display:none;" title="' . $values_img->descripcion . '" href="' . Doo::conf()->APP_URL . 'global/' . $values_img->ruta_resize . '" data-lightbox-gallery="' . $id_parque . '"></a>';
                        }
                        $contador_img++;
                    }
                } else {
                    $html_img .= '<img  src="' . Doo::conf()->APP_URL . 'global/img/wall-disney-epcot.png"/>';
                }
                $this->data["epcot"] = $html_img;
                /** Fin Magic Epcot */
                /** Imagenes de Hollywood Studios * */
                $id_parque = 9;
                $hs = Doo::db()->find("Imagenes_parques", array("asc" => "orden", "where" => "id_parques = ? ", "param" => array($id_parque)));

                $html_img = "";
                if (!empty($hs)) {
                    $contador_img = 1;
                    foreach ($hs as $values_img) {
                        if ($contador_img == 1) {
                            $html_img .= '<a class="galeria" title="' . $values_img->descripcion . '" data-lightbox-gallery="' . $id_parque . '" href="' . Doo::conf()->APP_URL . 'global/' . $values_img->ruta_resize . '"> <img  src="' . Doo::conf()->APP_URL . 'global/img/wall-disney-hs.png"/> </a>';
                        } else {
                            $html_img .= '<a class="galeria" style="display:none;" title="' . $values_img->descripcion . '" href="' . Doo::conf()->APP_URL . 'global/' . $values_img->ruta_resize . '" data-lightbox-gallery="' . $id_parque . '"></a>';
                        }
                        $contador_img++;
                    }
                } else {
                    $html_img .= '<img  src="' . Doo::conf()->APP_URL . 'global/img/wall-disney-hs.png"/>';
                }
                $this->data["hs"] = $html_img;
                /** Fin Hollywood Studios */
                /** Imagenes de Animal Kingdom * */
                $id_parque = 10;
                $hs = Doo::db()->find("Imagenes_parques", array("asc" => "orden", "where" => "id_parques = ? ", "param" => array($id_parque)));

                $html_img = "";
                if (!empty($hs)) {
                    $contador_img = 1;
                    foreach ($hs as $values_img) {
                        if ($contador_img == 1) {
                            $html_img .= '<a class="galeria" title="' . $values_img->descripcion . '" data-lightbox-gallery="' . $id_parque . '" href="' . Doo::conf()->APP_URL . 'global/' . $values_img->ruta_resize . '"> <img  src="' . Doo::conf()->APP_URL . 'global/img/wall-disney-ak.png"/> </a>';
                        } else {
                            $html_img .= '<a class="galeria" style="display:none;" title="' . $values_img->descripcion . '" href="' . Doo::conf()->APP_URL . 'global/' . $values_img->ruta_resize . '" data-lightbox-gallery="' . $id_parque . '"></a>';
                        }
                        $contador_img++;
                    }
                } else {
                    $html_img .= '<img  src="' . Doo::conf()->APP_URL . 'global/img/wall-disney-ak.png"/>';
                }
                $this->data["animalk"] = $html_img;
                /** Fin Animal Kingdom */
                /** Imagenes de Sea World * */
                $id_parque = 11;
                $hs = Doo::db()->find("Imagenes_parques", array("asc" => "orden", "where" => "id_parques = ? ", "param" => array($id_parque)));

                $html_img = "";
                if (!empty($hs)) {
                    $contador_img = 1;
                    foreach ($hs as $values_img) {
                        if ($contador_img == 1) {
                            $html_img .= '<a class="galeria" title="' . $values_img->descripcion . '" data-lightbox-gallery="' . $id_parque . '" href="' . Doo::conf()->APP_URL . 'global/' . $values_img->ruta_resize . '"> <img  src="' . Doo::conf()->APP_URL . 'global/img/sea-world-sw.png"/> </a>';
                        } else {
                            $html_img .= '<a class="galeria" style="display:none;" title="' . $values_img->descripcion . '" href="' . Doo::conf()->APP_URL . 'global/' . $values_img->ruta_resize . '" data-lightbox-gallery="' . $id_parque . '"></a>';
                        }
                        $contador_img++;
                    }
                } else {
                    $html_img .= '<img  src="' . Doo::conf()->APP_URL . 'global/img/sea-world-sw.png"/>';
                }
                $this->data["sw"] = $html_img;
                /** Fin Sea World */
                /** Imagenes de Busch Gardens * */
                $id_parque = 12;
                $busg = Doo::db()->find("Imagenes_parques", array("asc" => "orden", "where" => "id_parques = ? ", "param" => array($id_parque)));

                $html_img = "";
                if (!empty($busg)) {
                    $contador_img = 1;
                    foreach ($busg as $values_img) {
                        if ($contador_img == 1) {
                            $html_img .= '<a class="galeria" title="' . $values_img->descripcion . '" data-lightbox-gallery="' . $id_parque . '" href="' . Doo::conf()->APP_URL . 'global/' . $values_img->ruta_resize . '"> <img  src="' . Doo::conf()->APP_URL . 'global/img/sea-world-hs.png"/> </a>';
                        } else {
                            $html_img .= '<a class="galeria" style="display:none;" title="' . $values_img->descripcion . '" href="' . Doo::conf()->APP_URL . 'global/' . $values_img->ruta_resize . '" data-lightbox-gallery="' . $id_parque . '"></a>';
                        }
                        $contador_img++;
                    }
                } else {
                    $html_img .= '<img  src="' . Doo::conf()->APP_URL . 'global/img/sea-world-hs.png"/>';
                }
                $this->data["bg"] = $html_img;

                /** Fin Busch Gardens */
                /** Imagenes de Aquatica * */
                $id_parque = 13;
                $acuatica = Doo::db()->find("Imagenes_parques", array("asc" => "orden", "where" => "id_parques = ? ", "param" => array($id_parque)));

                $html_img = "";
                if (!empty($acuatica)) {
                    $contador_img = 1;
                    foreach ($acuatica as $values_img) {
                        if ($contador_img == 1) {
                            $html_img .= '<a class="galeria" title="' . $values_img->descripcion . '" data-lightbox-gallery="' . $id_parque . '" href="' . Doo::conf()->APP_URL . 'global/' . $values_img->ruta_resize . '"> <img  src="' . Doo::conf()->APP_URL . 'global/img/sea-world-aquatica.png"/> </a>';
                        } else {
                            $html_img .= '<a class="galeria" style="display:none;" title="' . $values_img->descripcion . '" href="' . Doo::conf()->APP_URL . 'global/' . $values_img->ruta_resize . '" data-lightbox-gallery="' . $id_parque . '"></a>';
                        }
                        $contador_img++;
                    }
                } else {
                    $html_img .= '<img  src="' . Doo::conf()->APP_URL . 'global/img/sea-world-aquatica.png"/>';
                }
                $this->data["acuatica"] = $html_img;
                /** Fin Aquatica */
                /** Imagenes de Universal Studios * */
                $id_parque = 14;
                $us = Doo::db()->find("Imagenes_parques", array("asc" => "orden", "where" => "id_parques = ? ", "param" => array($id_parque)));

                $html_img = "";
                if (!empty($us)) {
                    $contador_img = 1;
                    foreach ($us as $values_img) {
                        if ($contador_img == 1) {
                            $html_img .= '<a class="galeria" title="' . $values_img->descripcion . '" data-lightbox-gallery="' . $id_parque . '" href="' . Doo::conf()->APP_URL . 'global/' . $values_img->ruta_resize . '"> <img  src="' . Doo::conf()->APP_URL . 'global/img/universal-parks-us.png"/> </a>';
                        } else {
                            $html_img .= '<a class="galeria" style="display:none;" title="' . $values_img->descripcion . '" href="' . Doo::conf()->APP_URL . 'global/' . $values_img->ruta_resize . '" data-lightbox-gallery="' . $id_parque . '"></a>';
                        }
                        $contador_img++;
                    }
                } else {
                    $html_img .= '<img  src="' . Doo::conf()->APP_URL . 'global/img/universal-parks-us.png"/>';
                }
                $this->data["us"] = $html_img;
                /** Fin Universal Studios */
                /** Imagenes de UIsland of Adventure * */
                $id_parque = 15;
                $ua = Doo::db()->find("Imagenes_parques", array("asc" => "orden", "where" => "id_parques = ? ", "param" => array($id_parque)));

                $html_img = "";
                if (!empty($ua)) {
                    $contador_img = 1;
                    foreach ($ua as $values_img) {
                        if ($contador_img == 1) {
                            $html_img .= '<a class="galeria" title="' . $values_img->descripcion . '" data-lightbox-gallery="' . $id_parque . '" href="' . Doo::conf()->APP_URL . 'global/' . $values_img->ruta_resize . '"> <img  src="' . Doo::conf()->APP_URL . 'global/img/universal-parks-ia.png"/> </a>';
                        } else {
                            $html_img .= '<a class="galeria" style="display:none;" title="' . $values_img->descripcion . '" href="' . Doo::conf()->APP_URL . 'global/' . $values_img->ruta_resize . '" data-lightbox-gallery="' . $id_parque . '"></a>';
                        }
                        $contador_img++;
                    }
                } else {
                    $html_img .= '<img  src="' . Doo::conf()->APP_URL . 'global/img/universal-parks-ia.png"/>';
                }
                $this->data["ua"] = $html_img;
                /** Fin UIsland of Adventure */
                /** Imagenes de Wet’n Wild * */
                $id_parque = 16;
                $ww = Doo::db()->find("Imagenes_parques", array("asc" => "orden", "where" => "id_parques = ? ", "param" => array($id_parque)));

                $html_img = "";
                if (!empty($ww)) {
                    $contador_img = 1;
                    foreach ($ww as $values_img) {
                        if ($contador_img == 1) {
                            $html_img .= '<a class="galeria" title="' . $values_img->descripcion . '" data-lightbox-gallery="' . $id_parque . '" href="' . Doo::conf()->APP_URL . 'global/' . $values_img->ruta_resize . '"> <img  src="' . Doo::conf()->APP_URL . 'global/img/water-parks-ww.png"/> </a>';
                        } else {
                            $html_img .= '<a class="galeria" style="display:none;" title="' . $values_img->descripcion . '" href="' . Doo::conf()->APP_URL . 'global/' . $values_img->ruta_resize . '" data-lightbox-gallery="' . $id_parque . '"></a>';
                        }
                        $contador_img++;
                    }
                } else {
                    $html_img .= '<img  src="' . Doo::conf()->APP_URL . 'global/img/water-parks-ww.png"/>';
                }
                $this->data["ww"] = $html_img;
                /** Fin Wet’n Wild */
                /** Imagenes de Blizzard Beach * */
                $id_parque = 17;
                $bb = Doo::db()->find("Imagenes_parques", array("asc" => "orden", "where" => "id_parques = ? ", "param" => array($id_parque)));

                $html_img = "";
                if (!empty($bb)) {
                    $contador_img = 1;
                    foreach ($bb as $values_img) {
                        if ($contador_img == 1) {
                            $html_img .= '<a class="galeria" title="' . $values_img->descripcion . '" data-lightbox-gallery="' . $id_parque . '" href="' . Doo::conf()->APP_URL . 'global/' . $values_img->ruta_resize . '"> <img  src="' . Doo::conf()->APP_URL . 'global/img/water-parks-bb.png"/></a>';
                        } else {
                            $html_img .= '<a class="galeria" style="display:none;" title="' . $values_img->descripcion . '" href="' . Doo::conf()->APP_URL . 'global/' . $values_img->ruta_resize . '" data-lightbox-gallery="' . $id_parque . '"></a>';
                        }
                        $contador_img++;
                    }
                } else {
                    $html_img .= '<img  src="' . Doo::conf()->APP_URL . 'global/img/water-parks-bb.png"/>';
                }
                $this->data["bb"] = $html_img;
                /** Fin Blizzard Beach */
                /** Imagenes de Kennedy Space Cter. * */
                $id_parque = 19;
                $ks = Doo::db()->find("Imagenes_parques", array("asc" => "orden", "where" => "id_parques = ? ", "param" => array($id_parque)));

                $html_img = "";
                if (!empty($ks)) {
                    $contador_img = 1;
                    foreach ($ks as $values_img) {
                        if ($contador_img == 1) {
                            $html_img .= '<a class="galeria" title="' . $values_img->descripcion . '" data-lightbox-gallery="' . $id_parque . '" href="' . Doo::conf()->APP_URL . 'global/' . $values_img->ruta_resize . '"> <img  src="' . Doo::conf()->APP_URL . 'global/img/historic-parks-ksc.png"/></a>';
                        } else {
                            $html_img .= '<a class="galeria" style="display:none;" title="' . $values_img->descripcion . '" href="' . Doo::conf()->APP_URL . 'global/' . $values_img->ruta_resize . '" data-lightbox-gallery="' . $id_parque . '"></a>';
                        }
                        $contador_img++;
                    }
                } else {
                    $html_img .= '<img  src="' . Doo::conf()->APP_URL . 'global/img/historic-parks-ksc.png"/>';
                }
                $this->data["ks"] = $html_img;
                /** Fin Kennedy Space Cter. */
                /** Imagenes de Holy Land * */
                $id_parque = 20;
                $hl = Doo::db()->find("Imagenes_parques", array("asc" => "orden", "where" => "id_parques = ? ", "param" => array($id_parque)));

                $html_img = "";
                if (!empty($hl)) {
                    $contador_img = 1;
                    foreach ($hl as $values_img) {
                        if ($contador_img == 1) {
                            $html_img .= '<a class="galeria" title="' . $values_img->descripcion . '" data-lightbox-gallery="' . $id_parque . '" href="' . Doo::conf()->APP_URL . 'global/' . $values_img->ruta_resize . '"> <img  src="' . Doo::conf()->APP_URL . 'global/img/historic-parks-hl.png"/></a>';
                        } else {
                            $html_img .= '<a class="galeria" style="display:none;" title="' . $values_img->descripcion . '" href="' . Doo::conf()->APP_URL . 'global/' . $values_img->ruta_resize . '" data-lightbox-gallery="' . $id_parque . '"></a>';
                        }
                        $contador_img++;
                    }
                } else {
                    $html_img .= '<img  src="' . Doo::conf()->APP_URL . 'global/img/historic-parks-hl.png"/>';
                }
                $this->data["hl"] = $html_img;
                /** Fin Holy Land */
                /** Imagenes de Medieval Times * */
                $id_parque = 21;
                $mt = Doo::db()->find("Imagenes_parques", array("asc" => "orden", "where" => "id_parques = ? ", "param" => array($id_parque)));

                $html_img = "";
                if (!empty($mt)) {
                    $contador_img = 1;
                    foreach ($mt as $values_img) {
                        if ($contador_img == 1) {
                            $html_img .= '<a class="galeria" title="' . $values_img->descripcion . '" data-lightbox-gallery="' . $id_parque . '" href="' . Doo::conf()->APP_URL . 'global/' . $values_img->ruta_resize . '"> <img  src="' . Doo::conf()->APP_URL . 'global/img/afp-an.png"/></a>';
                        } else {
                            $html_img .= '<a class="galeria" style="display:none;" title="' . $values_img->descripcion . '" href="' . Doo::conf()->APP_URL . 'global/' . $values_img->ruta_resize . '" data-lightbox-gallery="' . $id_parque . '"></a>';
                        }
                        $contador_img++;
                    }
                } else {
                    $html_img .= '<img  src="' . Doo::conf()->APP_URL . 'global/img/afp-an.png"/>';
                }
                $this->data["mt"] = $html_img;
                /** Fin Medieval Times */
                /** Imagenes de Cirque du Soleil * */
                $id_parque = 22;
                $cs = Doo::db()->find("Imagenes_parques", array("asc" => "orden", "where" => "id_parques = ? ", "param" => array($id_parque)));

                $html_img = "";
                if (!empty($cs)) {
                    $contador_img = 1;
                    foreach ($cs as $values_img) {
                        if ($contador_img == 1) {
                            $html_img .= '<a class="galeria" title="' . $values_img->descripcion . '" data-lightbox-gallery="' . $id_parque . '" href="' . Doo::conf()->APP_URL . 'global/' . $values_img->ruta_resize . '"> <img  src="' . Doo::conf()->APP_URL . 'global/img/afp-cds.png"/></a>';
                        } else {
                            $html_img .= '<a class="galeria" style="display:none;" title="' . $values_img->descripcion . '" href="' . Doo::conf()->APP_URL . 'global/' . $values_img->ruta_resize . '" data-lightbox-gallery="' . $id_parque . '"></a>';
                        }
                        $contador_img++;
                    }
                } else {
                    $html_img .= '<img  src="' . Doo::conf()->APP_URL . 'global/img/afp-cds.png"/>';
                }
                $this->data["cs"] = $html_img;
                /** Fin Cirque du Soleil */
                /** Imagenes de Orlando Premium Outlet Mall * */
                $id_parque = 23;
                $op = Doo::db()->find("Imagenes_parques", array("asc" => "orden", "where" => "id_parques = ? ", "param" => array($id_parque)));

                $html_img = "";
                if (!empty($op)) {
                    $contador_img = 1;
                    foreach ($op as $values_img) {
                        if ($contador_img == 1) {
                            $html_img .= '<a class="galeria" title="' . $values_img->descripcion . '" data-lightbox-gallery="' . $id_parque . '" href="' . Doo::conf()->APP_URL . 'global/' . $values_img->ruta_resize . '"> <img  src="' . Doo::conf()->APP_URL . 'global/img/fdst-opom.png"/></a>';
                        } else {
                            $html_img .= '<a class="galeria" style="display:none;" title="' . $values_img->descripcion . '" href="' . Doo::conf()->APP_URL . 'global/' . $values_img->ruta_resize . '" data-lightbox-gallery="' . $id_parque . '"></a>';
                        }
                        $contador_img++;
                    }
                } else {
                    $html_img .= '<img  src="' . Doo::conf()->APP_URL . 'global/img/fdst-opom.png"/>';
                }
                $this->data["op"] = $html_img;
                /** Fin Orlando Premium Outlet Mall */
                $this->data ['rootUrl'] = Doo::conf()->APP_URL;
                $this->renderc('/tours/3-day-tour', $this->data);
                $_SESSION ['toursbooking'] ['tqp'] = $_SESSION ['toursbooking'] ['tqp1'];
            } catch (Exception $e) {
                return Doo::conf()->APP_URL . "tours/";
                // procedimiento en caso de reportar errores
            }
        } else {
            return Doo::conf()->APP_URL . "tours/";
        }
    }

    public function transporPark($dato) {
        Doo::loadModel("Agency");
        if (isset($_SESSION['data_agency'])) {
            $dat = new Agency($_SESSION['data_agency']);
        } else {
            $dat = new Agency();
            $dat->type_rate = 0;
            $dat->id = -1;
        }

        $fecha = substr($_SESSION['toursbooking']['fecha_salida'], 0, 4) . '-01-01 00:00:00';

        if ($_SESSION ['toursbooking']['question'] == 1) {
            if ($dat->type_rate == 1) {
                $sql = 'SELECT t1.id,t1.nombre,t2.nombre AS grupo,t3.adult,t3.child,t2.id as id_grupo
											FROM parques t1 
											LEFT JOIN grupo_parques t2 ON (t1.id_grupo = t2.id)
											LEFT JOIN parques_tarifasgrupo t3 ON (t1.id_grupo = t3.id_grupo)
							WHERE t3.type_rate = 2  AND t3.id_agency = ' . $dat->id . ' AND t3.annio = ?  AND t1.id = ?';
                $rs = Doo::db()->query($sql, array(
                    $fecha, $dato
                ));
                $parkdatos = $rs->fetch();
                if (!($parkdatos['adult'] && $parkdatos['child'])) {
                    $sql = 'SELECT t1.id,t1.nombre,t2.nombre AS grupo,t3.adult,t3.child,t2.id as id_grupo
											FROM parques t1 
											LEFT JOIN grupo_parques t2 ON (t1.id_grupo = t2.id)
											LEFT JOIN parques_tarifasgrupo t3 ON (t1.id_grupo = t3.id_grupo)
							WHERE t3.type_rate = 1 AND t3.annio = ? AND t1.id = ?';
                    $rs = Doo::db()->query($sql, array($fecha, $dato));
                    $parkdatos = $rs->fetch();
                }
            } else {
                $sql = 'SELECT t1.id,t1.nombre,t2.nombre AS grupo,t3.adult,t3.child,t2.id as id_grupo
											FROM parques t1 
											LEFT JOIN grupo_parques t2 ON (t1.id_grupo = t2.id)
											LEFT JOIN parques_tarifasgrupo t3 ON (t1.id_grupo = t3.id_grupo)
							WHERE t3.type_rate = ' . $dat->type_rate . ' AND t3.annio = ? AND t1.id = ?';
                $rs = Doo::db()->query($sql, array(
                    $fecha, $dato
                ));
                $parkdatos = $rs->fetch();
            }
        } else {
            $pax = $_SESSION ['toursbooking']['totalpax'];
            if ($dat->type_rate == 1) {

                $sql = 'SELECT t1.id,t1.nombre,t2.nombre AS grupo,t3.amount,t3.price,t2.id as id_grupo
											FROM parques t1 
											LEFT JOIN grupo_parques t2 ON (t1.id_grupo = t2.id)
											LEFT JOIN parques_tarifasvipgrupo t3 ON (t1.id_grupo = t3.id_grupo)
							WHERE t3.type_rate = 2  AND t3.id_agency = ' . $dat->id . ' AND annio = ?  AND t1.id = ?  AND t3.amount = ? ';
                $rs = Doo::db()->query($sql, array($fecha, $dato, $pax));
                $parkdatos = $rs->fetch();
                if (!($parkdatos['price'] && $parkdatos['amount'])) {
                    $sql = 'SELECT t1.id,t1.nombre,t2.nombre AS grupo,t3.amount,t3.price,t2.id as id_grupo
											FROM parques t1 
											LEFT JOIN grupo_parques t2 ON (t1.id_grupo = t2.id)
											LEFT JOIN parques_tarifasvipgrupo t3 ON (t1.id_grupo = t3.id_grupo)
							WHERE t3.type_rate = 1 AND t1.id = ? AND t3.annio = ? AND t3.amount = ? ';
                    $rs = Doo::db()->query($sql, array($dato, $fecha, $pax));
                    $parkdatos = $rs->fetch();
                }
            } else {
                $sql = 'SELECT t1.id,t1.nombre,t2.nombre AS grupo,t3.amount,t3.price,t2.id as id_grupo
											FROM parques t1 
											LEFT JOIN grupo_parques t2 ON (t1.id_grupo = t2.id)
											LEFT JOIN parques_tarifasvipgrupo t3 ON (t1.id_grupo = t3.id_grupo)
							WHERE t3.type_rate = ' . $dat->type_rate . ' AND t1.id = ? AND t3.annio = ? AND t3.amount = ? ';
                $rs = Doo::db()->query($sql, array($dato, $fecha, $pax));
                $parkdatos = $rs->fetch();
            }
            $priceXp = $parkdatos['price'] / $pax;
            $parkdatos['adult'] = $priceXp;
            $parkdatos['child'] = $priceXp;
        }

        if ($_SESSION ['toursbooking']['sarrival'] == 4) {
            $parkdatos['adult'] = 0;
            $parkdatos['child'] = 0;
        }
        /* echo "<script> console.log('";
          print_r(Doo::db()->showSQL());
          echo "');</script>"; */
//        print_r($parkdatos);
        if ($dato == 12) {
            $parkdatos['adult'] = 24;
            $parkdatos['child'] = 24;
        }
        return $parkdatos;
    }

    public function ajaxparks() {
        try {
            $tikes = $this->params ["resp"];
            $toursbooking = $_SESSION ["toursbooking"];

            Doo::loadModel("Agency");
            if (isset($_SESSION['data_agency'])) {
                $dat = new Agency($_SESSION['data_agency']);
            } else {
                $dat = new Agency();
                $dat->type_rate = 0;
                $dat->id = -1;
            }

            if (isset($_SESSION ['toursbooking'] ['ticketpark'])) {
                unset($_SESSION ['toursbooking'] ['ticketpark']);
            }
            $arreglo = array();
            if (isset($this->params ["id"])) {
                $dato = $this->params ["id"];
                list ($park, $grupo) = explode(",", $dato);
                $dato = $park;
            }

            if (isset($this->params ["ides"])) {
                $dato = $this->params ["ides"];
                list ($park, $grupo) = explode(",", $dato);
                $dato = $park;
            }


            $parkdatos = $this->transporPark($dato); // Datos del parque

            unset($_SESSION['borrando']);
            if (isset($this->params ["ides"])) {

                $park = $this->params ["ides"];
                if ($parkdatos ['adult'] >= 0 && $parkdatos ['child'] >= 0) {
                    $park_existe = false;

                    if (isset($_SESSION ['grupos'][$parkdatos['id_grupo']])) {

                        if ($_SESSION ['grupos'][$parkdatos['id_grupo']] > 0) {
                            $grupo_new_variable = $parkdatos['id_grupo'];
                            $grupo1_new_variable = $_SESSION ['grupos1']['park' . $grupo_new_variable . ''];
                            $parks_new_variable = explode(",", $grupo1_new_variable);
                            $park_existe = false;
                            foreach ($parks_new_variable as $value_new_variable) {
                                if ($value_new_variable == $parkdatos['id']) {
                                    $park_existe = true;
                                    break;
                                }
                            }
                        }
                    }
                    if ($park_existe) {
                        $_SESSION ['toursbooking'] ['parktotal'] = $_SESSION ['toursbooking'] ['parktotal'] - (($parkdatos ['adult'] * $toursbooking ['adults']) + ($parkdatos ['child'] * $toursbooking ['childs']));
                    } else {
                        $_SESSION ['toursbooking'] ['parktotal'] = $_SESSION ['toursbooking'] ['parktotal'];
                    }



                    $total = $_SESSION ['toursbooking'] ['parktotal'] + $toursbooking ['tq'];
                    $tqp = ($toursbooking ['tq'] / $toursbooking ['totalpax']) + ($_SESSION ['toursbooking'] ['parktotal'] / $toursbooking ['totalpax']);


                    $_SESSION ['toursbooking'] ['tqp'] = $tqp;

                    if (isset($_SESSION ['grupos'])) {

                        if (isset($_SESSION ['grupos'] [$grupo]) && isset($_SESSION ['grupos1'] ['park' . $grupo . ''])) {

                            $_SESSION ['grupos'] [$grupo] -= 1;

                            if (isset($_SESSION ['grupos1'] ['park' . $grupo . ''])) {
                                $parks = array();
                                $parks = explode(",", $_SESSION ['grupos1'] ['park' . $grupo . '']);
                                $contador = 0;
                                unset($_SESSION ['grupos1'] ['park' . $grupo . '']);
                                $_SESSION ['grupos1'] ['park' . $grupo . ''] = "";
                                $list = '';
                                for ($i = 0; $i < count($parks); $i++) {
                                    if (trim($parks[$i]) != trim($dato) && trim($parks[$i]) != '') {
                                        $list = $list . $parks[$i];
                                        if ($i + 1 < count($parks)) {
                                            $list = $list . ',';
                                        }
                                    }
                                }
                                if (trim($list) == '') {
                                    unset($_SESSION ['grupos1']['park' . $grupo . '']);
                                } else {
                                    $_SESSION ['grupos1']['park' . $grupo . ''] = $list;
                                }
                            }
                        } else {
                            $_SESSION['grupos'][$grupo] = $_SESSION['grupos'] [$grupo] - 1;
                        }
                    } else {
                        $_SESSION['grupos'][$grupo] = $_SESSION ['grupos'] [$grupo] - 1;
                    }

                    $_SESSION['borrando'] = true;
                    $this->tours_three();

                    if ($tikes == 1) {
                        $sumatike = $_SESSION ['toursbooking'] ['ticketpark'] / $_SESSION ['toursbooking'] ['totalpax'];
                    } else {
                        $sumatike = 0;
                    }
                    $_SESSION ['toursbooking'] ['tsa'] = $tqp;
                    $_SESSION ['toursbooking'] ['tqp'] = $sumatike + $tqp;

                    // print_r($_SESSION['grupos1']);
                    echo "<script>$('#tqp').html('$" . round($_SESSION ['toursbooking'] ['tqp']) . "');</script>";
                    echo "<script>$('#" . $dato . "').remove();</script>";
                }
                //print_r($_SESSION);
            } else {

                if (!isset($_SESSION ['toursbooking'] ['parktotal'])) {
                    $_SESSION ['toursbooking'] ['parktotal'] = 0;
                }

                if ($parkdatos ['adult'] >= 0 && $parkdatos ['child'] >= 0) {
                    $park_existe = false;
                    if (isset($_SESSION ['grupos'][$parkdatos['id_grupo']])) {

                        if ($_SESSION ['grupos'][$parkdatos['id_grupo']] > 0) {

                            $grupo_new_variable = $parkdatos['id_grupo'];
                            $grupo1_new_variable = $_SESSION ['grupos1']['park' . $grupo_new_variable . ''];
                            $parks_new_variable = explode(",", $grupo1_new_variable);
                            $park_existe = false;
                            foreach ($parks_new_variable as $value_new_variable) {
                                if ($value_new_variable == $parkdatos['id']) {
                                    $park_existe = true;
                                    break;
                                }
                            }
                        }
                    }
                    if (!$park_existe) {
                        $_SESSION ['toursbooking'] ['parktotal'] = $_SESSION ['toursbooking'] ['parktotal'] + ($parkdatos ['adult'] * $toursbooking ['adults']) + ($parkdatos ['child'] * $toursbooking ['childs']);
                    } else {
                        $_SESSION ['toursbooking'] ['parktotal'] = $_SESSION ['toursbooking'] ['parktotal'];
                    }
                    /* echo ($parkdatos ['adult'] * $toursbooking ['adults']) + ($parkdatos ['child'] * $toursbooking ['childs']);
                      $id_park = $parkdatos ['id'];
                      $_SESSION ['toursbooking'] ['park'] = $parkdatos ['id']; */

                    $_SESSION ['grupos1'] ['ratesPark' . $grupo . ''] = (($parkdatos ['adult'] * $toursbooking ['adults']) + ($parkdatos ['child'] * $toursbooking ['childs']));
                    $total = $_SESSION ['toursbooking'] ['parktotal'] + $_SESSION ['toursbooking'] ['tq'];

                    $tqp = $total / $toursbooking ['totalpax'];

                    if (isset($_SESSION ['grupos'])) {
                        if (isset($_SESSION ['grupos'] [$grupo]) && isset($_SESSION ['grupos1'] ['park' . $grupo . ''])) {
                            $_SESSION ['grupos'] [$grupo] += 1;

                            $_SESSION ['grupos1'] ['park' . $grupo . ''] = $_SESSION ['grupos1'] ['park' . $grupo . ''] . "," . $dato;
                        } else {

                            $_SESSION ['grupos'] [$grupo] = 1;

                            $_SESSION ['grupos1'] ['park' . $grupo . ''] = $dato;
                        }
                    } else {
                        $_SESSION ['grupos'] [$grupo] = 1;

                        $_SESSION ['grupos1'] ['park' . $grupo . ''] = $dato;

                        if ($_SESSION ['grupos1'] ['park' . $grupo . ''] == " ,") {
                            $_SESSION ['grupos1'] ['park' . $grupo . ''] = substr($_SESSION ['grupos1'] ['park' . $grupo . ''], 1);
                        }
                    }
                    //echo 'Prueba ';
                    $_SESSION['borrando'] = false;
                    $this->tours_three();

                    if ($tikes == 1) {
                        $sumatike = $_SESSION ['toursbooking'] ['ticketpark'] / $toursbooking ['totalpax'];
                        $_SESSION ['toursbooking'] ['paso'] = "";
                    } else {
                        $sumatike = 0;
                    }
                    // print_r($_SESSION['grupos']);
                    $_SESSION ['toursbooking'] ['tsa'] = $tqp;
                    $_SESSION ['toursbooking'] ['tqp'] = $tqp + $sumatike;
                    echo "<script>$('#tqp').html('$" . round($_SESSION ['toursbooking'] ['tqp']) . "');</script>";
                    echo "<script>$('#" . $dato . "').remove();</script>";
                }
                echo "<script>$('#attractions2').append('<p id=" . $dato . ">" . $parkdatos ['nombre'] . "</p>');</script>";
                //print_r($_SESSION);
            }
        } catch (Exception $e) {

            // procedimiento en caso de reportar errores
        }
    }

    public function tours_three() {
        try {
            unset($_SESSION ['toursbooking'] ['ticketpark']);

            $_SESSION ['toursbooking'] ['ticketpark'] = 0;

            extract($_POST);

            Doo::loadModel("Agency");
            if (isset($_SESSION['data_agency'])) {
                $dat = new Agency($_SESSION['data_agency']);
            } else {
                $dat = new Agency();
                $net_rate = false;
                $dat->type_rate = 0;
                $dat->id = -1;
            }
            if (isset($_SESSION ['grupos']) && isset($_SESSION ['grupos1'])) {

                $priceadult = 0;
                $priceachild = 0;
                $grupos = $_SESSION ['grupos'];

                $grupos1 = $_SESSION ['grupos1'];
                $toursbooking = $_SESSION ['toursbooking'];
                $fecha = substr($toursbooking['fecha_salida'], 0, 4) . '-01-01 00:00:00';

                $sql = 'SELECT id,adults,child,id_grupo,id_parque,cantidad,type_rate, id_agency, company_name
							FROM admin_parques_tarifa
							WHERE type_rate = 1 AND id_agency =-1 AND id_grupo = ? AND  cantidad = ? AND annio = ?';
                $sql0 = 'SELECT id,adults,child,id_grupo,id_parque,cantidad,type_rate, id_agency, company_name
							FROM admin_parques_tarifa
							WHERE type_rate = 2 AND id_parque = 0 AND id_agency =? AND  id_grupo = ? AND cantidad = ? AND annio = ?';
                //print_r($grupos);
                foreach ($grupos as $clave => $valor) {

                    if ($valor == 0) {
                        continue;
                    }
                    if ($dat->id != -1) {
                        $rs = Doo::db()->query($sql0, array(
                            $dat->id,
                            trim($clave),
                            trim($valor),
                            $fecha
                        ));
                        $consulta = $rs->fetch();

                        if (empty($consulta) || $consulta ['id_parque'] != 0) {
                            $rs = Doo::db()->query($sql, array(
                                trim($clave),
                                trim($valor),
                                $fecha
                            ));
                            $consulta = $rs->fetch();
                        }
                    } else {
                        $rs = Doo::db()->query($sql, array(
                            trim($clave),
                            trim($valor),
                            $fecha
                        ));
                        $consulta = $rs->fetch();
                    }
                    $rs->rowCount();

                    $idParque = $consulta ['id_parque'];
                    $grupo = $clave;

//                    print_r($consulta);
                    if (!empty($consulta) && $consulta ['id_parque'] == 0) {

                        $priceadult = $toursbooking ['adults'] * $consulta ['adults'];
                        $priceachild = $toursbooking ['childs'] * $consulta ['child'];

                        $_SESSION['grupos1']['parkAdult' . $grupo . ''] = $consulta ['adults'];
                        $_SESSION['grupos1']['parkChild' . $grupo . ''] = $consulta ['child'];
                        $sumando = $priceadult + $priceachild;
                        $_SESSION ['toursbooking'] ['ticketpark'] = $_SESSION ['toursbooking'] ['ticketpark'] + $sumando;
                    } else {

                        $sql2 = 'SELECT  id,adults,child,id_grupo,id_parque,cantidad,type_rate, id_agency, company_name
									FROM admin_parques_tarifa
									WHERE type_rate = 1 AND id_agency =-1 AND  id_parque = ? AND cantidad = 1 AND annio = ?';
                        $sql02 = 'SELECT  id,adults,child,id_grupo,id_parque,cantidad,type_rate, id_agency, company_name
									FROM admin_parques_tarifa
									WHERE type_rate = 2 AND id_agency =? AND  id_parque = ? AND cantidad = 1 AND annio = ?';

                        if (isset($grupos1 ['park' . $clave . ''])) {
                            $park = array();
                            $park = explode(",", $grupos1 ['park' . $clave . '']);
                        }


                        if (isset($park)) {
                            //print_r($park);
                            foreach ($park as $valor) {
                                //print_r($park );
                                if ($dat->id != -1) {
                                    $rs = Doo::db()->query($sql02, array(
                                        $dat->id,
                                        trim($valor),
                                        $fecha
                                    ));
                                    $consulta = $rs->fetch();
                                    if (empty($consulta)) {
                                        $rs = Doo::db()->query($sql2, array(
                                            trim($valor),
                                            $fecha
                                        ));
                                        $consulta = $rs->fetch();
                                    }
                                } else {
                                    $rs = Doo::db()->query($sql2, array(
                                        trim($valor),
                                        $fecha
                                    ));
                                    $consulta = $rs->fetch();
                                }

                                if (!empty($consulta)) {
                                    //  print_r($consulta);
                                    if ($consulta ['cantidad'] == 1 && $consulta ['id_parque'] != 0) {

                                        $priceadult = $toursbooking ['adults'] * $consulta ['adults'];
                                        $priceachild = $toursbooking ['childs'] * $consulta ['child'];
                                        $_SESSION['grupos1']['parkAdult' . $grupo . ''] = $consulta ['adults'];
                                        $_SESSION['grupos1']['parkChild' . $grupo . ''] = $consulta ['child'];

                                        $sumando = $priceadult + $priceachild;
                                        //echo $sumando;
                                        $_SESSION ['toursbooking'] ['ticketpark'] = $_SESSION ['toursbooking'] ['ticketpark'] + $sumando;
                                    }
                                }
                                $contador++;
                            }
                        } else {
                            $priceadult = 0;
                            $priceachild = 0;
                            $_SESSION['grupos1']['parkAdult' . $grupo . ''] = 0;
                            $_SESSION['grupos1']['parkChild' . $grupo . ''] = 0;
                            $sumando = $priceadult + $priceachild;
                        }
                    }
                    unset($park);
                }

                $totalpark = 0;
                foreach ($grupos as $valor) {
                    $totalpark = $totalpark + $valor;
                }

                $divporpax = $_SESSION['toursbooking']['ticketpark'] / $toursbooking ['totalpax'];
                /*                echo json_encode($_SESSION['toursbooking']['ticketpark']);
                  exit; */
                //print_r($_SESSION['toursbooking']['ticketpark']);

                if ($totalpark > 0) {

                    /* echo "<script>alert('".$idParque."')</script>"; */
                    if ($idParque != '24') {
                        $divpark = $divporpax / $totalpark;
                        $_SESSION['toursbooking']['flag'] = 1;
                    } else {
                        if ($totalpark > 1) {
                            $divpark = $divporpax / ($totalpark - 1);
                            $_SESSION['toursbooking']['flag'] = 1;
                        } else {
                            $divpark = $divporpax / ($totalpark);
                            $_SESSION['toursbooking']['flag'] = 1;
                        }
                    }
                } else {
                    $_SESSION['toursbooking']['flag'] = 0;
                    $divpark = 0;
                }
                //print_r(Doo::db()->showSQL());
                //exit;*/
                /* ECHO $divporpax;
                  exit; */
                $_SESSION['toursbooking']['divporpax'] = $divporpax;
                $_SESSION['toursbooking']['np'] = $totalpark;
                /* echo json_encode($_SESSION['borrando']); */
                //print_r($consulta);
                if ((!$_SESSION['borrando'] && $consulta) || ($_SESSION['borrando'])) {
                    //echo "<script>alert('".$totalpark."');</script>";
                    echo "<script>$('#tikets').html('$" . round($divpark) . "');
				 if(suma == parcks && $('#admision-pregunta').val()==0) {
					 		  $('#admision-pregunta').val('1');
							  var ckresp1 = $('#resp1').attr('checked');
							  var ckresp2 = $('#resp2').attr('checked');
							  if(!ckresp1 && !ckresp2){
								$('#tiketsMess').html($('#tikets').html());
								$( '#dialog-message6' ).dialog({
										modal: true,
										width: 500
								});
							}
                          }
				
				</script>";
                    unset($_SESSION['borrando']);
                } else {
                    echo '<script>
                            $("#attractions").load("' . Doo::conf()->APP_URL . 'tours/question8/' . $this->params['id'] . '/' . $this->params['resp'] . '")
                            $("input[value=\'' . $this->params['id'] . '\']").removeAttr("checked").trigger("change");
                            $( "#dialog-message1" ).dialog({
                                modal: true,
                                buttons: {
                                    Ok: function() {
                                        $( this ).dialog( "close" );
                                    }
                                }
                            });
                            </script>';
                    unset($_SESSION['borrando']);
                }
            }
        } catch (Exception $e) {

            // procedimiento en caso de reportar errores
        }
    }

    public function recalcular_admin_park() {
        try {
            $ticketpark = 0;

            extract($_POST);

            Doo::loadModel("Agency");
            if (isset($_SESSION['data_agency'])) {
                $dat = new Agency($_SESSION['data_agency']);
            } else {
                $dat = new Agency();
                $net_rate = false;
                $dat->type_rate = 0;
                $dat->id = -1;
            }
            if (isset($_SESSION ['grupos']) && isset($_SESSION ['grupos1'])) {
                $priceadult = 0;
                $priceachild = 0;
                $grupos = $_SESSION ['grupos'];
                $grupos1 = $_SESSION ['grupos1'];
                $toursbooking = $_SESSION ['toursbooking'];
                $fecha = substr($toursbooking['fecha_salida'], 0, 4) . '-01-01 00:00:00';

                $sql = 'SELECT id,adults,child,id_grupo,id_parque,cantidad,type_rate, id_agency, company_name
                                                            FROM admin_parques_tarifa
                                                            WHERE type_rate = 1 AND id_agency =-1 AND id_grupo = ? AND  cantidad = ? AND annio = ?';
                $sql0 = 'SELECT id,adults,child,id_grupo,id_parque,cantidad,type_rate, id_agency, company_name
                                                            FROM admin_parques_tarifa
                                                            WHERE type_rate = 2 AND id_parque = 0 AND id_agency =? AND  id_grupo = ? AND cantidad = ? AND annio = ?';

                foreach ($grupos as $clave => $valor) {

                    if ($valor == 0) {
                        continue;
                    }
                    if ($dat->id != -1) {
                        $rs = Doo::db()->query($sql0, array(
                            $dat->id,
                            trim($clave),
                            trim($valor),
                            $fecha
                        ));
                        $consulta = $rs->fetch();

                        if (empty($consulta) || $consulta ['id_parque'] != 0) {
                            $rs = Doo::db()->query($sql, array(
                                trim($clave),
                                trim($valor),
                                $fecha
                            ));
                            $consulta = $rs->fetch();
                        }
                    } else {
                        $rs = Doo::db()->query($sql, array(
                            trim($clave),
                            trim($valor),
                            $fecha
                        ));
                        $consulta = $rs->fetch();
                    }
                    $rs->rowCount();

                    $idParque = $consulta ['id_parque'];
                    $grupo = $clave;


                    if (!empty($consulta) && $consulta ['id_parque'] == 0) {
                        // echo 'entro';
                        $priceadult = $toursbooking ['adults'] * $consulta ['adults'];
                        $priceachild = $toursbooking ['childs'] * $consulta ['child'];

                        $_SESSION['grupos1']['parkAdult' . $grupo . ''] = $consulta ['adults'];
                        $_SESSION['grupos1']['parkChild' . $grupo . ''] = $consulta ['child'];
                        $sumando = $priceadult + $priceachild;
                        $ticketpark = $ticketpark + $sumando;
                    } else {

                        $sql2 = 'SELECT  id,adults,child,id_grupo,id_parque,cantidad,type_rate, id_agency, company_name
                                                                            FROM admin_parques_tarifa
                                                                            WHERE type_rate = 1 AND id_agency =-1 AND  id_parque = ? AND cantidad = 1 AND annio = ?';
                        $sql02 = 'SELECT  id,adults,child,id_grupo,id_parque,cantidad,type_rate, id_agency, company_name
                                                                            FROM admin_parques_tarifa
                                                                            WHERE type_rate = 2 AND id_agency =? AND  id_parque = ? AND cantidad = 1 AND annio = ?';

                        if (isset($grupos1 ['park' . $clave . ''])) {
                            $park = array();
                            $park = explode(",", $grupos1 ['park' . $clave . '']);
                        }


                        if (isset($park)) {
                            //print_r($park);
                            foreach ($park as $valor) {
                                //print_r($park );
                                if ($dat->id != -1) {
                                    $rs = Doo::db()->query($sql02, array(
                                        $dat->id,
                                        trim($valor),
                                        $fecha
                                    ));
                                    $consulta = $rs->fetch();
                                    if (empty($consulta)) {
                                        $rs = Doo::db()->query($sql2, array(
                                            trim($valor),
                                            $fecha
                                        ));
                                        $consulta = $rs->fetch();
                                    }
                                } else {
                                    $rs = Doo::db()->query($sql2, array(
                                        trim($valor),
                                        $fecha
                                    ));
                                    $consulta = $rs->fetch();
                                }

                                if (!empty($consulta)) {
                                    //  print_r($consulta);
                                    if ($consulta ['cantidad'] == 1 && $consulta ['id_parque'] != 0) {

                                        $priceadult = $toursbooking ['adults'] * $consulta ['adults'];
                                        $priceachild = $toursbooking ['childs'] * $consulta ['child'];
                                        $_SESSION['grupos1']['parkAdult' . $grupo . ''] = $consulta ['adults'];
                                        $_SESSION['grupos1']['parkChild' . $grupo . ''] = $consulta ['child'];

                                        $sumando = $priceadult + $priceachild;
                                        //echo $sumando;
                                        $ticketpark = $ticketpark + $sumando;
                                    }
                                }
                                $contador++;
                            }
                        } else {
                            $priceadult = 0;
                            $priceachild = 0;
                            $_SESSION['grupos1']['parkAdult' . $grupo . ''] = 0;
                            $_SESSION['grupos1']['parkChild' . $grupo . ''] = 0;
                            $sumando = $priceadult + $priceachild;
                        }
                    }
                    unset($park);
                }

                $totalpark = 0;
                foreach ($grupos as $valor) {
                    $totalpark = $totalpark + $valor;
                }

                $divporpax = $ticketpark / $toursbooking ['totalpax'];
                /*                echo json_encode($_SESSION['toursbooking']['ticketpark']);
                  exit; */
                //print_r($_SESSION['toursbooking']['ticketpark']);

                if ($totalpark > 0) {

                    /* echo "<script>alert('".$idParque."')</script>"; */
                    if ($idParque != '24') {
                        $divpark = $divporpax / $totalpark;
                        $_SESSION['toursbooking']['flag'] = 1;
                    } else {
                        if ($totalpark > 1) {
                            $divpark = $divporpax / ($totalpark - 1);
                            $_SESSION['toursbooking']['flag'] = 1;
                        } else {
                            $divpark = $divporpax / ($totalpark);
                            $_SESSION['toursbooking']['flag'] = 1;
                        }
                    }
                } else {
                    $_SESSION['toursbooking']['flag'] = 0;
                    $divpark = 0;
                }
                return $divporpax;
            }
        } catch (Exception $e) {

            // procedimiento en caso de reportar errores
        }
    }

    public function ques() {
        $pregunta = $this->params["resp"];

        if ($pregunta == 1) {
            $_SESSION['borrando'] = false;
            $this->tours_three();
            $sumatike = $_SESSION ['toursbooking'] ['ticketpark'] / $_SESSION ['toursbooking'] ['totalpax'];
            $_SESSION ['toursbooking'] ['tqp'] = $_SESSION ['toursbooking'] ['tqp'] + $sumatike;
            $_SESSION ['toursbooking'] ['paso'] = "";
            echo "<script>$('#tickes').html('INCLUDED in tour price ');$('#tqp').html('$" . round($_SESSION ['toursbooking'] ['tqp']) . "');";
        } else {
            if (isset($_SESSION ['toursbooking'] ['paso'])) {
                $_SESSION['borrando'] = false;
                $this->tours_three();

                $sumatike = $_SESSION ['toursbooking'] ['ticketpark'] / $_SESSION ['toursbooking'] ['totalpax'];
                $_SESSION['toursbooking'] ['tqp'] = $_SESSION ['toursbooking'] ['tqp'] - $sumatike;
                unset($_SESSION ['toursbooking'] ['paso']);
                echo "<script>$('#tickes').html('NOT INCLUDED in tour price ');$('#tqp').html('$" . round($_SESSION ['toursbooking'] ['tqp']) . "');</script>";
            }
        }
    }

    public function tours_four() {
        if (isset($_SESSION ['toursbooking'] ['paso'])) {
            unset($_SESSION ['toursbooking'] ['paso']);
        }
        $post = $_POST;
        $parkes = array();
        $namepark = array();



        if (isset($_POST ['question'])) {
            if ($_POST ['question'] == 1) {

                $_SESSION ['toursbooking'] ['ticketpark'] = 1;
            }
            if ($_POST ['question'] == 0) {
                $_SESSION ['toursbooking'] ['ticketpark'] = 0;
            }
        }

        $contador = 0;
        foreach ($post as $valor) {
            if (strlen($valor) > 1) {
                list ($park, $grupo) = explode(",", $valor);
                $parkes [$contador] = $park;
            }
            $contador++;
        }

        $contador = 0;
        $sql = "SELECT nombre
							FROM parques 
								WHERE id = ?";

        foreach ($parkes as $valor) {

            $rs = Doo::db()->query($sql, array(
                $valor
            ));

            $consulta = $rs->fetch();

            $namepark [$contador] = $consulta ['nombre'];
            $contador++;
        }

        $_SESSION ['namepark'] = $namepark;
        Doo::loadModel("Agency");
        if (isset($_SESSION['data_agency'])) {
            $dat = new Agency($_SESSION['data_agency']);
            $comision = $this->cal_equipament();
            if ($dat->type_rate == 0) {
                $_SESSION ['toursbooking']['comision_agency'] = ($_SESSION ['toursbooking'] ['tsa'] * $_SESSION['toursbooking']['totalpax'] * ($comision / 100));
            } else {
                $_SESSION ['toursbooking']['comision_agency'] = 0;
            }
        }
        $_SESSION ['toursbooking'] ['pasopostpark'] = true;
        //echo '<script>location.href="'.Doo::conf()->APP_URL . "tours/confirmation".'"</script>';
        return Doo::conf()->APP_URL . "tours/confirmation";
    }

    public function confirma() {
        if (isset($_SESSION ['toursbooking'] ['paso'])) {
            unset($_SESSION ['toursbooking'] ['paso']);
        }
       //print_r($_SESSION['toursbooking']);
//          echo '<br>';
        /* print_r($_SESSION['grupos']);
          echo '<br>';
          print_r($_SESSION['grupos1']); */
        if (isset($_SESSION ['toursbooking'] ['pasopostpark']) && isset($_SESSION ['grupos']) && isset($_SESSION['toursbooking']) && isset($_SESSION['grupos1'])) {

            $booking = $_SESSION['toursbooking'];
            /** Volver a calcular todo para confirmar dos veces que el calculo es perfecto. */
            #calculo de hotel mas transportacion orlando miami, miami orlando
            $transport = (($booking['trasport_total1'] + $booking['trasport_total2'] ) );
            /* echo 'calculo de transportacion  $'.$transport;
              echo '<br>'; */
            if (isset($_SESSION ["toursbooking"] ["desayuno"])) {
                $desayuno = $_SESSION ["toursbooking"] ["desayuno"];
            } else {
                $desayuno = 0;
            }

            $costo_hotel = ($booking['totalhotel'] + ($desayuno));
            /* echo 'calculo de  hotel $'.$costo_hotel;
              echo '<br>'; */
            #calculo de transportacion a parkes
            $grupos = $_SESSION ['grupos'];
            $parkes_array = $_SESSION['grupos1'];

            $costo_parke_transport = 0;
            foreach ($grupos as $grupo => $cantidad) {
                if ($cantidad > 0) {
                    $array = explode(",", $parkes_array['park' . $grupo . '']);
                    foreach ($array as $parke) {
                        $parkdatos = $this->transporPark($parke);
                        $costo_parke_transport = $costo_parke_transport + ($parkdatos ['adult'] * $booking ['adults']) + ($parkdatos ['child'] * $booking ['childs']);
                    }
                }
            }

            /* echo 'Calculo de transportacion de parkes $'.$costo_parke_transport;
              echo '<br>'; */
            #calculo de tiketes a los parques
            if ($booking["ticketpark"]) {
                $costo_tickets_parkes = $this->recalcular_admin_park();
                $costo_tickets_parkes = $costo_tickets_parkes * $booking['totalpax'];
            } else {
                $costo_tickets_parkes = 0;
            }

            /* echo 'Calculo de tickest a parques $'.$costo_tickets_parkes;
              echo '<br>'; */

            $totaltotal = round($transport + $costo_hotel + $costo_parke_transport + $costo_tickets_parkes);
            
            /* echo 'El total de la reserva recalculado es de $'.$totaltotal;
              /** Cierre de operacion recalculacion */
            /* echo '<br>'; */
            //$totaltotal = 2;
            
            $contenido = "<span style='color:green;'>Array booking</span>";
            $totalmemoria = round($booking['tqp'] * $booking['totalpax']);
            //echo $totaltotal. " - " .$totalmemoria;
            if ($totaltotal != $totalmemoria) {
                try {
                    $contenido .= print_r($_SESSION, true);
                    $contenido .= "<span style='color:red;'>Recalculado = $totaltotal</span>";
                    $mail = new PHPMailer();
                    $mail->IsSMTP();
                    $correo_emisor = "websales@supertours.com";
                    $nombre_emisor = "Supertours Of Orlando";
                    $contrasena = "Daniel4";
                    //$mail->SMTPDebug  = 2;                  
                    $mail->SMTPAuth = true;
                    //$mail->SMTPSecure = "tsl";                
                    $mail->SMTPSecure = "ssl";
                    $mail->Host = "smtpout.secureserver.net";
                    $mail->Port = 465;
                    $mail->Username = $correo_emisor;
                    $mail->Password = $contrasena;
                    //$mail->AddReplyTo($correo_emisor, $nombre_emisor);
                    $mail->SetFrom("no_reply@supertours.com", $nombre_emisor);
                    $mail->Subject = 'Supertours Of Orlando, recalculado y memoria diferentes -' . date("d-m-Y h:i:s");
                    $mail->AltBody = 'Supertours Of Orlando, recalculado y memoria diferentes -' . date("d-m-Y h:i:s");
                    $mail->AddAddress("henry@supertours.com", "");
                    $mail->MsgHTML($contenido);
                    $mail->Send();
                } catch (phpmailerException $e) {
                    echo $e->errorMessage(); // Errores de PhpMailer
                } catch (Exception $e) {
                    echo $e->getMessage(); // Errores de cualquier otra cosa.
                }
                return Doo::conf()->APP_URL . "error";
            }

            #cotizacion 
            try {
                $contenido .= print_r($_SESSION, true);
                $contenido .= "<span style='color:red;'>Cotizacion</span>";
                $mail = new PHPMailer();
                $mail->IsSMTP();
                $correo_emisor = "websales@supertours.com";
                $nombre_emisor = "Supertours Of Orlando";
                $contrasena = "Daniel4";
                //$mail->SMTPDebug  = 2;                  
                $mail->SMTPAuth = true;
                //$mail->SMTPSecure = "tsl";                
                $mail->SMTPSecure = "ssl";
                $mail->Host = "smtpout.secureserver.net";
                $mail->Port = 465;
                $mail->Username = $correo_emisor;
                $mail->Password = $contrasena;
                //$mail->AddReplyTo($correo_emisor, $nombre_emisor);
                $mail->SetFrom("no_reply@supertours.com", $nombre_emisor);
                $mail->Subject = 'Supertours Of Orlando, Cotizacion -' . date("d-m-Y h:i:s");
                $mail->AltBody = 'Supertours Of Orlando, Cotizacion -' . date("d-m-Y h:i:s");
                $mail->AddAddress("henry@supertours.com", "");
                $mail->MsgHTML($contenido);
                $mail->Send();
            } catch (phpmailerException $e) {
                echo $e->errorMessage(); // Errores de PhpMailer
            } catch (Exception $e) {
                echo $e->getMessage(); // Errores de cualquier otra cosa.
            }
            #fin de cotizacion

            $this->data ['rootUrl'] = Doo::conf()->APP_URL;
            $this->data ['recalculado'] = $totaltotal;
            Doo::loadController('admin/ToursController');
            $toursControl = new ToursController();
            $_SESSION['codconf'] = $toursControl->codigoConf(1);

            if (!isset($_SESSION ['toursbooking'] ['ticketpark'])) {
                return Doo::conf()->APP_URL . "tours/step-three";
            }
            if (!isset($_SESSION['data_agency'])) {
                $this->data['disponible'] = 0;
            } else {
                Doo::loadController("AgenciaController");
                $agenControl = new AgenciaController();
                $disponible = $agenControl->iscredit();
                $this->data['disponible'] = $disponible;
            }
			//$varible = print_r($_SESSION['toursbooking'],true);
			//echo "<span style='display:none'>".$varible."</span>";
            $this->renderc('/tours/shoproute', $this->data);
        } else {
            return Doo::conf()->APP_URL . "error";
        }
    }

    public function reportar() {
        try {
            $valor = $this->params['valor'];
            $contenido = "<span style='color:green;'>Array del tours probado</span>";
            $contenido .= print_r($_SESSION, true);
            $contenido .= "<span style='color:red;'>Valor Reportado = $valor</span>";
            $mail = new PHPMailer();
            $mail->IsSMTP();
            $correo_emisor = "websales@supertours.com";
            $nombre_emisor = "Supertours Of Orlando";
            $contrasena = "Daniel4";
            //$mail->SMTPDebug  = 2;                  
            $mail->SMTPAuth = true;
            //$mail->SMTPSecure = "tsl";                
            $mail->SMTPSecure = "ssl";
            $mail->Host = "smtpout.secureserver.net";
            $mail->Port = 465;
            $mail->Username = $correo_emisor;
            $mail->Password = $contrasena;
            //$mail->AddReplyTo($correo_emisor, $nombre_emisor);
            $mail->SetFrom("no_reply@supertours.com", $nombre_emisor);
            $mail->Subject = 'Supertours Of Orlando, Reportado en prueba -' . date("d-m-Y");
            $mail->AltBody = 'Supertours Of Orlando, Reportado en prueba -' . date("d-m-Y");
            $mail->AddAddress("henry@supertours.com", "");
            $mail->MsgHTML($contenido);
            $mail->Send();
        } catch (phpmailerException $e) {
            echo $e->errorMessage(); // Errores de PhpMailer
        } catch (Exception $e) {
            echo $e->getMessage(); // Errores de cualquier otra cosa.
        }
    }

    public function ques2() {
        $select = $this->params ["resp"];
        if ($select == 0) {

            echo "<script>$('#area').html('unselected');</script>";
        }

        if ($select == 1) {

            echo "<script>$('#area').html('MIAMI BEACH (NORTH)');</script>";
        }
        if ($select == 2) {

            echo "<script>$('#area').html('MIAMI BEACH (CENTRAL)');</script>";
        }
        if ($select == 3) {

            echo "<script>$('#area').html('MIAMI BEACH (SOUTH)');</script>";
        }
        if ($select == 4) {

            echo "<script>$('#area').html('MIAMI DOWNTOWN');</script>";
        }
        if ($select == 5) {

            echo "<script>$('#area').html('MIAMI AIRPORT');</script>";
        }
        if ($select == 6) {

            echo "<script>$('#area').html('PORT OF MIAMI');</script>";
        }

        $_SESSION["Area"] = $select;
    }

    public function platinum() {
        $select = $this->params ["id"];
        if ($select == 2) {
            $_SESSION["platinum_opcion"] = 1;
            echo "
					 <script>$('#premiun').html('PRIVATE SERVICE');
					 		
								$('#select1').ddslick('destroy');
					
									var ddData01 = [
								{
									text: 'Super Tours Vip',
									value: 1,
									selected: false,
									description: 'BY SUPER TOURS VIP PRIVATE FROM MIAMI?',
									imageSrc: '" . Doo::conf()->APP_URL . "global/img/vip.png'
								},
								{
									text: 'Airport (Transfer In)',
									value: 1,
									selected: false,
									description: 'BY PLANE AT ORLANDO INT`L AIRPORT (TRANSFER IN)?',
									imageSrc: '" . Doo::conf()->APP_URL . "global/img/icon-plane.png'
								}
							];		
					
										   
					$('#select1').ddslick({
						data: ddData01,
						width: 300,
						imagePosition: 'left',
						selectText: 'Method of arrival to Orlando',
						onSelected: function (data) {
							var id = data.selectedIndex;
							$('#indexSelect1').val(id);
							selectTrip1();						}
					});
					    $('#select2').ddslick('destroy');
					    var ddData011 = [
																		{
										text: 'Super Tours Vip',
										value: 2,
										selected: false,
										description: 'BY SUPER TOURS VIP PRIVATE TO MIAMI?',
										imageSrc: '" . Doo::conf()->APP_URL . "global/img/vip.png'
									},
									{
										text: 'Airport (Transfer Out)',
										value: 2,
										selected: false,
										description: 'BY PLANE AT ORLANDO INT`L AIRPORT (TRANSFER OUT)?',
										imageSrc: '" . Doo::conf()->APP_URL . "global/img/icon-plane.png'
									}
								];	
								
							$('#select2').ddslick({
									data: ddData011,
									width: 300,
									imagePosition: 'left',
									selectText: 'Method of departure from Orlando',
									onSelected: function (data) {
										var id = data.selectedIndex;
										$('#indexSelect2').val(id);
										selectTrip2();
									}
								});
					 $('#conte').html('');
					 $('#conte2').html('');
					
					</script>
					     
						 
						 
						 ";
        }
        if ($select == 1) {
            $_SESSION["platinum_opcion"] = 0;
            echo "
					 <script>$('#premiun').html('PREMIUM SCHEDULED ');
					 		
								$('#select1').ddslick('destroy');
					
									var ddData01 = [
								{
									text: 'Super Tours Bus',
									value: 1,
									selected: false,
									description: 'BY SUPER TOURS FROM MIAMI?',
									imageSrc: '" . Doo::conf()->APP_URL . "global/img/BUS2.png'
								},
								{
									text: 'Airport (Transfer In)',
									value: 1,
									selected: false,
									description: 'BY PLANE AT ORLANDO INT`L AIRPORT(TRANSFER IN)?',
									imageSrc: '" . Doo::conf()->APP_URL . "global/img/icon-plane.png'
								},
								{
									text: 'By Car',
									value: 1,
									selected: false,
									description: 'BY CAR?',
									imageSrc: '" . Doo::conf()->APP_URL . "global/img/car.png'
								}
							];		
					
										   
					$('#select1').ddslick({
						data: ddData01,
						width: 300,
						imagePosition: 'left',
						selectText: 'Method of arrival to Orlando',
						onSelected: function (data) {
							var id = data.selectedIndex;
							$('#indexSelect1').val(id);
							selectTrip1();
						}
					});
					    $('#select2').ddslick('destroy');
					    var ddData011 = [
									{
										text: 'Super Tours Bus',
										value: 2,
										selected: false,
										description: 'BY SUPER TOURS BUS TO MIAMI?',
										imageSrc: '" . Doo::conf()->APP_URL . "global/img/BUS2.png'
									},
									{
										text: 'Airport (Transfer Out)',
										value: 2,
										selected: false,
										description: 'BY PLANE AT ORLANDO INT`L AIRPORT (TRANSFER OUT)?',
										imageSrc: '" . Doo::conf()->APP_URL . "global/img/icon-plane.png'
									},
									{
										text: 'By Car',
										value: 2,
										selected: false,
										description: 'BY CAR?',
										imageSrc: '" . Doo::conf()->APP_URL . "global/img/car.png'
									}
								];	
								
							$('#select2').ddslick({
									data: ddData011,
									width: 300,
									imagePosition: 'left',
									selectText: 'Method of departure from Orlando',
									onSelected: function (data) {
										var id = data.selectedIndex;
										$('#indexSelect2').val(id);
										selectTrip2();
									}
								});
					 $('#conte').html('');
					 $('#conte2').html('');
					
					</script>
					     
						 ";
        }
    }

    public function maillerCorreoAgencia() {
        if (isset($_SESSION['data_agency'])) {
            $dat = new Agency($_SESSION['data_agency']);
            Doo::loadModel("UserA");
            $datos = unserialize($_SESSION['uagency']);
            
            $agencia_name = $dat->company_name;
            $agencia_usuario = $datos->firstname." ".$datos->lastname;
            
        } else {
            $agencia_name = "N/A";
            $agencia_usuario = "N/A";
        }

        // Doo::db()->query($query); 
        if (isset($_SESSION ['toursbooking'])) {
            $toursbooking = $_SESSION['toursbooking'];
        } else {
            return;
        }
        //print_r($toursbooking);
        $question = $toursbooking['ticketpark'];
        $buffet = isset($_SESSION['bufet']) ? $_SESSION['bufet'] : 0;
        if (isset($_SESSION['area']))
            $area = $_SESSION['area'];
        else
            $area = "";
        if (isset($_SESSION['area2']))
            $area2 = $_SESSION['area2'];
        else
            $area2 = "";
        if (isset($_SESSION['pickup']))
            $pickup = $_SESSION['pickup'];
        else
            $pickup = "";

        if (isset($_SESSION['pickup2']))
            $pickup2 = $_SESSION['pickup2'];
        else
            $pickup2 = "";

        $login = $_SESSION ["tourstick"];

        $desayuno = $toursbooking['desayuno'];
        $namepark = $_SESSION ['namepark'];
        $npark = "";
        foreach ($namepark as $value) {
            $npark .= "<li>" . $value . "</li>";
        }
        if (isset($_SESSION['tourPagoMulDay'])) {
            if ($_SESSION['tourPagoMulDay'] == 'ok') {
                $estado = 'PAID';
                $titulo = 'MULTI DAY TOURS CONFIRMATION';
            }
        } else {
            $estado = 'QUOTE';
            $titulo = 'MULTI DAY TOUR QUOTATION';
        }

        if (isset($_SESSION['priceFee'])) {
            $fee = $_SESSION['priceFee'];
        } else {
            $fee = 0;
        }
        $otheramount = (isset($toursbooking['otheramount']) && $toursbooking['otheramount'] != 0) ? $toursbooking['otheramount'] : 0;
        $cotenido = "<title>Reservations Super Tours OF Orlando�?</title>
<style type='text/css'>
#clearTable {
	width: 800px;
	font-size: 13px;
	font-family: Verdana, Geneva, sans-serif;
}
#clearTable tr #titletd3 {
	font-family: Verdana, Geneva, sans-serif;
}
#clearTable tr #titletd2 {
	font-size: 20px;
}
#clearTable tr td p {
	text-align: center;
}

#content #center-column #tdgris {
	background-color: #F0F0F0;
}
#content #center-column #tdrojo {
	background-color: #FFE6E6;
}
#content #center-column1 #titletd {
	background-color: #F5EDEB;
	padding-left: 5px;
	font-size: 12px;
}
 #titlett {
	background-color: #E8E8E8;
	padding-left: 5px;
	font-size: 12px;
}
 #titlell {
	padding-left: 5px;
	font-size: 12px;
	border-bottom-width: 1px;
	border-left-width: 1px;
	border-bottom-style: solid;
	border-left-style: solid;
	border-bottom-color: #E6E6E6;
	border-left-color: #E6E6E6;
}
#titlelp {
	padding-left: 5px;
	font-size: 12px;
	border-bottom-width: 1px;
	border-bottom-style: solid;
	border-bottom-color: #E6E6E6;
}
 #titlelr {
	padding-left: 5px;
	font-size: 12px;
	border-top-width: 1px;
	border-top-style: solid;
	border-top-color: #CE0000;
	color: #CE0000;
}
 #tdgristable {
	background-color: #FFF;
	padding-left: 5px;
}



.Estilo1 {color: #FF0000}
</style>
</head><div align='center'>
<br />
<table   id='clearTable'> 
     <tr>
       <td width='316' height='33' rowspan='3' id='titletd3'><img src='https://www.supertours.com/Logo-Supertours-mail.jpg' width='316' height='88' /></td>
       <td colspan='3' align='center' id='titletd3'>Supertours.com</td>
     </tr>
     <tr>
       <td height='35' colspan='3' id='titletd7'>Date:" . date("M-d-Y") . " / Hora:" . date("g:i A") . " </td>
     </tr>
     <tr>
       <td height='35' colspan='3' id='titletd4'>Agency: <span style='color: #BD1515'>$agencia_name</span>, Usuario : <span style='color: #BD1515'>$agencia_usuario</span></td>
    </tr>
     <tr>
       <td align='center' height='33' colspan='4' id='titletd2'> <h3>" . $titulo . "</h3></td>
     </tr>
     <tr>
       <td height='15' id='titletd6'>LEAD TRAVELER:
       <br/><br/>
       <strong>User Name: </strong>" . $login['email'] . "
       <br/><br/>
       <strong>First Name: </strong>" . $login['firstname'] . "
       <br/><br/>
       <strong>Last Name: </strong>" . $login['lastname'] . "
       <br/><br/>
       <strong>Phone: </strong>" . $login['phone'] . "
        <br/><br/>
       <strong>Cellphone: </strong>" . $login['cellphone'] . "    
           
       </td>
       <td width='145' height='15' id='titletd6'>&nbsp;</td>
       <td colspan='2' id='titletd6'><strong>AD :</strong>" . $_SESSION['toursbooking']['adults'] . " <strong>CHD :</strong>" . $_SESSION['toursbooking']['childs'] . "  <strong> TOTAL :</strong>" . $_SESSION['toursbooking']['totalpax'] . "<br/><br/><strong>Status :</strong> " . $estado . "<br/><br/><strong> Code Quotation :</Strong> " . $_SESSION['codconf'] . "</td>
     </tr>
      <tr>
    <td height='45' colspan='4' id='titletd'> <p><strong>ORDER&nbsp;  QUOTATION</strong></p></td>
  </tr>
  <tr><td colspan=\"3\">Your trip will include:
     <table width=\"96%\" height=\"90\" id=\"tableorder\">
      <tr>
        <td height=\"35\" colspan=\"3\" id=\"titlett\"  ><strong ><div align=\"left\" > ITINERARY ARRIVAL</div></strong></td>
        </tr>
      <tr>
        <td height=\"47\" colspan=\"3\"><br/><p>"
                . (($toursbooking['sarrival'] == 1) ? " Bus Transportation on Trip <strong>" . $toursbooking['trip1'] . "</strong>, <strong>" . date("M-d-Y", strtotime($toursbooking['fecha_llegada'])) . "</strong> &#45; Pick up time <strong>" . date("g:i A", strtotime($toursbooking['datedeparturetrip1'])) . "</strong> &#45; from <strong>" . $area . '-' . $pickup . "</strong>, arriving at <strong>" . date("h:s A", strtotime($toursbooking['datearrivingtrip1'])) . "</strong> , you will be greeted by your tour guide/driver in Orlando.
<hr>
<br>
<strong > <div align=\"left\" id=\"titlett\"> ACCOMMODATION</div></strong>
<br>
<p>Hotel <strong>" . $toursbooking['hotel'] . "</strong> or SIMILAR: <strong><span style='color:red;'>REQUESTED/PENDING</span></strong></p>
<p>You will receive a final confirmation of the hotel or similar in less than 24 hours by e-mail.</p>

Hotel accommodation at the <strong>" . $toursbooking['hotel'] . "</strong> in <strong>" . $toursbooking['rooms'] . "</strong> room(s). for <strong>" . $toursbooking['noches'] . "</strong> night(s) from <strong>" . date("M-d-Y", strtotime($toursbooking['fecha_llegada'])) . "</strong> Check In Time is 4:00pm . To
<strong>" . date("M-d-Y", strtotime($toursbooking['fecha_salida'])) . "</strong> Check Out Time is 11:00am." . (( $desayuno != 0) ? " FREE DAILY CONTINENTAL BREKFAST " : "") . " Taxes are Included.
<br>" . (($buffet == 1 && $_SESSION['categoria'] != 2 ) ? "<br><br>Daily SUPER BREKFAST BUFFET at your hotel." : "") . "<br>
<hr>
<br>
<strong > <div align=\"left\" style='text-decoration: underline' > TRANSFERS & THEME PARKS INCLUDED ARE:</div></strong>
Round trip daily transportation from your Hotel to
<ul>" . $npark . "</ul>" . (($question == 1) ? "<strong>Admissions to Theme Parks ARE INCLUDED.</strong>" : "<strong>Admissions to Theme Parks are NOT INCLUDED.</strong>") . "<hr>" : "")
                . (($toursbooking['sarrival'] == 2) ? "Date Arrival <strong>" . date("M-d-Y", strtotime($toursbooking['fecha_llegada'])) . "</strong> &#45;you have choosen <strong>" . date("h:s A", strtotime($toursbooking['hora1'])) . "</strong>, on a luxury private transportation from <strong>" . $toursbooking['city'] . "</strong>, <strong>" . $toursbooking['address'] . "</strong> ,<strong>" . $area . '-' . $pickup . "</strong> to <strong>" . $toursbooking['hotel'] . "</strong><hr><strong > <div align=\"left\" > ACCOMMODATION</div></strong><br>Hotel accommodation at the <strong>" . $toursbooking['hotel'] . "</strong> in <strong>" . $toursbooking['rooms'] . "</strong> room(s). for <strong>" . $toursbooking['noches'] . "</strong> night(s) from <strong>" . $toursbooking['fecha_llegada'] . "</strong> Check In Time is 4:00pm . To<strong>" . date("M-d-Y", strtotime($toursbooking['fecha_salida'])) . "</strong> Check Out Time is 11:00am." . (($desayuno != 0) ? " FREE DAILY CONTINENTAL BREKFAST. " : "") . "Taxes are Included.<br>" . (($buffet == 1 && $_SESSION['categoria'] != 2 ) ? "<br><br>Daily SUPER BREKFAST BUFFET at your hotel." : "") . "<br><hr><br><strong > <div align=\"left\" > LOCAL TRANSFERS TO PARKS</div></strong>
<strong>" . date("M-d-Y", strtotime($toursbooking['fecha_salida'])) . "</strong> Check Out Time is 11:00am." . (($desayuno != 0) ? " FREE DAILY CONTINENTAL BREKFAST. " : "") . "Taxes are Included.<br>" . (($buffet == 1 && $_SESSION['categoria'] != 2 ) ? "<br><br>Daily SUPER BREKFAST BUFFET at your hotel." : "") . "<br><hr><br><strong > <div align=\"left\" > LOCAL TRANSFERS TO PARKS</div></strong>
Round trip daily transportation from your Hotel to
<ul>" . $npark . "</ul>" . (($question == 1) ? "<strong>Admissions to Theme Parks ARE INCLUDED.</strong>" : "<strong>Admissions to Theme Parks are NOT INCLUDED.</strong>") . "<hr>
    " : "")
                . (($toursbooking['sarrival'] == 3) ? "<br />Date Arrival <strong>" . date("M-d-Y", strtotime($toursbooking['fecha_llegada'])) . "</strong> &#45; Arriving: By plane  at Orlando International Airport 
Data Transfer In  :   Airline: <strong>" . $toursbooking['airlinearrival'] . "</strong>   Flight #:   <strong>" . $toursbooking['flightarrival'] . "</strong> Arrival Time:<strong>" . date("h:s A", strtotime($toursbooking['hora1'])) . "</strong>
. You will be greeted by your tour guide/driver in orlando to take you to  <strong>" . $toursbooking['hotel'] . "
<hr><strong > <div align=\"left\" id=\"titlett\"> ACCOMMODATION</div></strong><br>
Hotel accommodation at the <strong>" . $toursbooking['hotel'] . "</strong> in <strong>" . $toursbooking['rooms'] . "</strong> room(s). for <strong>" . $toursbooking['noches'] . "</strong> night(s) from <strong>" . date("M-d-Y", strtotime($toursbooking['fecha_llegada'])) . "</strong> Check In Time is 4:00pm . To
<strong>" . date("M-d-Y", strtotime($toursbooking['fecha_salida'])) . "</strong> Check Out Time is 11:00am." . (( $desayuno != 0) ? " FREE DAILY CONTINENTAL BREKFAST. " : "") . " Taxes are Included.
   <br>" . (($buffet == 1 && $_SESSION['categoria'] != 2) ? "<br><br>Daily SUPER BREKFAST BUFFET at your hotel." : "") . "<br>
<hr><br>
<strong > <div align=\"left\" style='text-decoration: underline'> TRANSFERS & THEME PARKS INCLUDED ARE:</div></strong>
Round trip daily transportation from your Hotel to<ul>" . $npark . "</ul>" . (($question == 1) ? "<strong>Admissions to Theme Parks ARE INCLUDED.</strong>" : "<strong>Admissions to Theme Parks are NOT INCLUDED.</strong>") . "<hr>" : "")
                . (($toursbooking['sarrival'] == 4) ? "<br />
Date Arrival <strong>" . date("M-d-Y", strtotime($toursbooking['fecha_llegada'])) . "</strong> PLEASE, LET US KNOW ABOUT YOUR ARRIVAL TO ORLANDO BY  DIALING  OUR TOLL FREE 1800-251-4206, TO PLACE YOUR TICKETS AT  <strong>" . $toursbooking['hotel'] . "</strong> OR FIGURE OUT ABOUT OTHER SERVICES. WE WILL PLEASED TO ASSIST YOU. 
<hr>
<strong > <div align=\"left\" id=\"titlett\"> ACCOMMODATION</div></strong><br>

Hotel accommodation at the <strong>" . $toursbooking['hotel'] . "</strong> in <strong>" . $toursbooking['rooms'] . "</strong> room(s). for <strong>" . $toursbooking['noches'] . "</strong> night(s) from <strong>" . date("M-d-Y", strtotime($toursbooking['fecha_llegada'])) . "</strong> Check In Time is 4:00pm . To
<strong>" . date("M-d-Y", strtotime($toursbooking['fecha_salida'])) . "</strong> Check Out Time is 11:00am." . (( $desayuno != 0) ? " FREE DAILY CONTINENTAL BREKFAST. " : "") . " Taxes are Included.
 <br>" . (($buffet == 1 && $_SESSION['categoria'] != 2) ? "<br><br>Daily SUPER BREKFAST BUFFET at your hotel." : "") . "<br>
<br>
<strong > <div align=\"left\" style='text-decoration: underline' > TRANSFERS & THEME PARKS INCLUDED ARE:</div></strong>
<ul>" . $npark . "</ul>" . (($question == 1) ? "<strong>Admissions to Theme Parks ARE INCLUDED.</strong>" : "<strong>Admissions to Theme Parks are NOT INCLUDED.</strong>") . "<hr>" : "") . "
        </p>
		
		
        <p>" . (($toursbooking['sdeparture'] == 1) ? "<strong > <div align=\"left\" id=\"titlett\"> ITINERARY DEPARTURE</div></strong><br>
          Bus Transportation  on Trip <strong>" . $toursbooking['trip2'] . "</strong>, <strong>" . date("M-d-Y", strtotime($toursbooking['fecha_salida'])) . "</strong> &#45; <strong>" . date("h:s A", strtotime($toursbooking ['datedeparturetrip2'])) . "</strong> &#45;  from Orlando Super Tours Terminal to <strong> " . $area2 . '-' . $pickup2 . " </strong> arriving at <strong>" . date("h:s A", strtotime($toursbooking ['datearrivingtrip2'])) . "</strong>  <br />
           " : "") . (($toursbooking['sdeparture'] == 2) ? "<strong > <div align=\"left\" id=\"titlett\"> ITINERARY DEPARTURE</div></strong>
         <br>Date departure <strong>" . $toursbooking['fecha_salida'] . "</strong> &#45; Drop Off Time:  <strong>" . date("h:s A", strtotime($toursbooking['hora2'])) . "</strong>, on a luxury private transportation from <strong>" . $toursbooking['city2'] . "</strong>, <strong>" . $toursbooking['address2'] . "</strong>, to MIAMI 
        <br />
          " : "") . (($toursbooking['sdeparture'] == 3) ? "<strong > <div align=\"left\" id=\"titlett\"> ITINERARY DEPARTURE</div></strong>
         <br>
Date departure <strong>" . date("M-d-Y", strtotime($toursbooking['fecha_salida'])) . "</strong>  &#45; Departure: By Plane at Orlando International Airport 
Data Transfer Out:   Airline: <strong>" . $toursbooking['airlinedeparture'] . "</strong>   Flight #:   <strong>" . $toursbooking['flightdeparture'] . "</strong> Arrival Time: <strong>" . date("h:s A", strtotime($toursbooking['hora2'])) . "</strong>



        <br />
          " : "") . (($toursbooking['sdeparture'] == 4) ? "<strong > <div align=\"left\" id=\"titlett\"> ITINERARY DEPARTURE</div></strong>
         <br>
     Date departure <strong>" . date("M-d-Y", strtotime($toursbooking['fecha_salida'])) . "</strong> <br> Departure: By Car   


        <br />
          " : "") . "
          
            <br />
              <br />
            </p></td>
        </tr>
    </table>

      </td>
  </tr>
  <tr>
    <td height='33' colspan='4' id='titletd5' ><h4><span style='color: #326AC0'>Comentarios:</span>&nbsp; </h4>
      <span style='color:rgb(223, 44, 44);'>".$_SESSION['toursbooking']['comentarios']."</span></td>
  </tr>
  <tr>
    <td height='33' colspan='4' id='titletd' ><strong style='text-decoration: underline'>PRICE</strong></td>
  </tr>
  <tr>
    <td colspan='4'><table width='90%' border='0'>
      <tr>
        <td height='32' align='center'><strong>The total amount for your tour is:</strong> <span id='tqprice' >$" .
                (($otheramount == 0) ? ( ($toursbooking ['tqp'] * $toursbooking ['totalpax'])) : $otheramount)
                . "</span> </td>
      </tr>
      <tr>
        <td height='40' align='center' ><span class='Estilo1'>VERIFY YOUR TOUR BEFORE PROCEEDING CLICKING ON PAY TOUR</span></td>
      </tr>
      <tr>
        <td align='center'>Once you click on PAY TOUR, you can no longer make any changes or modifications.  For questions or assistance you may call (407) 370-3001 and speak with one of our Call Center Representative.<br /></td>
      </tr>
    </table>
    <p>&nbsp;</p>
    <p>Any or all unused services are Non-Refundable - Non-Transferable - Modification in Travel Dates are not permitted. <br />
	<p>Luggage restrictions apply - Please read the terms of transportation at <a href='https://www.supertours.com'>www.supertours.com</a> <br />
     <span style='text-align:center;'> 
	  <p>THANK YOU FOR CHOOSING SUPER TOURS OF ORLANDO! HAVE A SUPER TRIP!</p>
      <p><strong>SUPER TOURS OF ORLANDO, Inc.</strong> </p>
	  <p> 5419 International Drive, Orlando Fl. 32819</p>
      <p>Phone: (407) 370-3001 / U.S.A. TOLL FREE 1-800-251-4206 </p>
	  <p style='text-decoration: underline'>reservations@supertours.com</p>
     </span>
    </p></td>
  </tr>
  <tr>
    <td height='18' colspan='4' align='center'> <p align='center' class='titulopago'> 
    
</p>       </td>

  </tr>
  </table></div>";
        $cont = 0;
        $dest = array("email" => $login['email'], "nombre" => $login['firstname'] . ' ' . $login['lastname']);
        $destinatarios[$cont++] = $dest;

        if (isset($_SESSION['data_agency'])) {//Correo para la agencia
            Doo::loadModel("UserA");
            $user = unserialize($_SESSION ['uagency']);
            $dest = array("email" => $user->email, "nombre" => $user->firstname . ' ' . $user->lastname);
            $destinatarios[$cont++] = $dest;
        }


        if (isset($_SESSION['tourPagoMulDay'])) {// correo para supertours
            if ($_SESSION['tourPagoMulDay'] == 'ok') {
                $correo_emisor = "websales@supertours.com";
                $nombre_emisor = "Supertours Of Orlando";
                //$dest = array("email"=> $correo_emisor, "nombre"=> $nombre_emisor);
                $destinatarios[$cont++] = $dest;
            }
        }
        $this->enviarCorreo($cotenido, $destinatarios);
    }

    public function mailerConsult() {

        // Doo::db()->query($query); 
        if (isset($_SESSION ['toursbooking'])) {
            $toursbooking = $_SESSION ['toursbooking'];
        } else {
            return;
        }
        //print_r($toursbooking);
        $question = $toursbooking['ticketpark'];
        $buffet = isset($_SESSION['bufet']) ? $_SESSION['bufet'] : 0;
        if (isset($_SESSION['area']))
            $area = $_SESSION['area'];
        else
            $area = "";

        if (isset($_SESSION['area2']))
            $area2 = $_SESSION['area2'];
        else
            $area2 = "";
        if (isset($_SESSION['pickup']))
            $pickup = $_SESSION['pickup'];
        else
            $pickup = "";

        if (isset($_SESSION['pickup2']))
            $pickup2 = $_SESSION['pickup2'];
        else
            $pickup2 = "";

        $login = $_SESSION ["tourstick"];

        $desayuno = $toursbooking['desayuno'];
        $namepark = $_SESSION ['namepark'];
        $npark = "";
        foreach ($namepark as $value) {
            $npark .= "<li>" . $value . "</li>";
        }
        if (isset($_SESSION['tourPagoMulDay'])) {
            if ($_SESSION['tourPagoMulDay'] == 'ok') {
                $estado = 'PAID';
                $titulo = 'MULTI DAY TOUR CONFIRMATION';
            } else {
                $estado = 'QUOTE';
                $titulo = 'MULTI DAY TOUR QUOTATION';
            }
        } else {
            $estado = 'QUOTE';
            $titulo = 'MULTI DAY TOUR QUOTATION';
        }
        $otheramount = (isset($toursbooking['otheramount'])) ? $toursbooking['otheramount'] : 0;
        $cotenido = "<title>Reservations Super Tours OF Orlando�?</title>
<style type='text/css'>
#clearTable {
	width: 800px;
	font-size: 13px;
	font-family: Verdana, Geneva, sans-serif;
}
#clearTable tr #titletd3 {
	font-family: Verdana, Geneva, sans-serif;
}
#clearTable tr #titletd2 {
	font-size: 20px;
}
#clearTable tr td p {
	text-align: center;
}

#content #center-column #tdgris {
	background-color: #F0F0F0;
}
#content #center-column #tdrojo {
	background-color: #FFE6E6;
}
#content #center-column1 #titletd {
	background-color: #F5EDEB;
	padding-left: 5px;
	font-size: 12px;
}
 #titlett {
	background-color: #E8E8E8;
	padding-left: 5px;
	font-size: 12px;
}
 #titlell {
	padding-left: 5px;
	font-size: 12px;
	border-bottom-width: 1px;
	border-left-width: 1px;
	border-bottom-style: solid;
	border-left-style: solid;
	border-bottom-color: #E6E6E6;
	border-left-color: #E6E6E6;
}
#titlelp {
	padding-left: 5px;
	font-size: 12px;
	border-bottom-width: 1px;
	border-bottom-style: solid;
	border-bottom-color: #E6E6E6;
}
 #titlelr {
	padding-left: 5px;
	font-size: 12px;
	border-top-width: 1px;
	border-top-style: solid;
	border-top-color: #CE0000;
	color: #CE0000;
}
 #tdgristable {
	background-color: #FFF;
	padding-left: 5px;
}



.Estilo1 {color: #FF0000}
</style>
</head><div align='center'>
<br />
<table   id='clearTable'> 
     <tr>
       <td width='316' height='33' rowspan='2' id='titletd3'><img src='https://www.supertours.com/Logo-Supertours-mail.jpg' width='316' height='88' /></td>
       <td colspan='3' align='center' id='titletd3'>Supertours.com</td>
     </tr>
     <tr>
       <td height='35' colspan='3' id='titletd4'>Date:" . date("M-d-Y") . " / Hora:" . date("g:i A") . " </td>
    </tr>
     <tr>
       <td align='center' height='33' colspan='4' id='titletd2'> <h3>" . $titulo . "</h3></td>
     </tr>
     <tr>
       <td height='15' id='titletd6'>LEAD TRAVELER:
       <br/><br/>
       <strong>User Name: </strong>" . $login['email'] . "
       <br/><br/>
       <strong>First Name: </strong>" . $login['firstname'] . "
       <br/><br/>
       <strong>Last Name: </strong>" . $login['lastname'] . "
       <br/><br/>
       <strong>Phone: </strong>" . $login['phone'] . "
        <br/><br/>
       <strong>Cellphone: </strong>" . $login['cellphone'] . "    
           
       </td>
       <td width='145' height='15' id='titletd6'>&nbsp;</td>
       <td colspan='2' id='titletd6'><strong>AD :</strong>" . $_SESSION['toursbooking']['adults'] . " <strong>CHD :</strong>" . $_SESSION['toursbooking']['childs'] . "  <strong> TOTAL :</strong>" . $_SESSION['toursbooking']['totalpax'] . "<br/><br/><strong>Status :</strong> " . $estado . "<br/><br/><strong> Code Quotation :</Strong> " . $_SESSION['codconf'] . "</td>
     </tr>
      <tr>
    <td height='45' colspan='4' id='titletd'> <p><strong>ORDER&nbsp;  QUOTATION</strong></p></td>
  </tr>
  <tr><td colspan=\"3\">Your trip will include:
     <table width=\"96%\" height=\"90\" id=\"tableorder\">
      <tr>
        <td height=\"35\" colspan=\"3\" id=\"titlett\"  ><strong ><div align=\"left\" > ITINERARY ARRIVAL</div></strong></td>
        </tr>
      <tr>
        <td height=\"47\" colspan=\"3\"><br/><p>"
                . (($toursbooking['sarrival'] == 1) ? " Bus Transportation on Trip <strong>" . $toursbooking['trip1'] . "</strong>, <strong>" . date("M-d-Y", strtotime($toursbooking['fecha_llegada'])) . "</strong> &#45; Pick up time <strong>" . date("g:i A", strtotime($toursbooking['datedeparturetrip1'])) . "</strong> &#45; from <strong>" . $area . '-' . $pickup . "</strong>, arriving at <strong>" . date("h:s A", strtotime($toursbooking['datearrivingtrip1'])) . "</strong> , you will be greeted by your tour guide/driver in Orlando.
<hr>
<br>
<strong > <div align=\"left\" id=\"titlett\"> ACCOMMODATION</div></strong>
<br>
<p>Hotel <strong>" . $toursbooking['hotel'] . "</strong> or SIMILAR: <strong><span style='color:red;'>REQUESTED/PENDING</span></strong></p>
<p>You will receive a final confirmation of the hotel or similar in less than 24 hours by e-mail.</p>

Hotel accommodation at the <strong>" . $toursbooking['hotel'] . "</strong> in <strong>" . $toursbooking['rooms'] . "</strong> room(s). for <strong>" . $toursbooking['noches'] . "</strong> night(s) from <strong>" . date("M-d-Y", strtotime($toursbooking['fecha_llegada'])) . "</strong> Check In Time is 4:00pm . To
<strong>" . date("M-d-Y", strtotime($toursbooking['fecha_salida'])) . "</strong> Check Out Time is 11:00am." . (( $desayuno != 0) ? " FREE DAILY CONTINENTAL BREKFAST " : "") . " Taxes are Included.
<br>" . (($buffet == 1 && $_SESSION['categoria'] != 2 ) ? "<br><br>Daily SUPER BREKFAST BUFFET at your hotel." : "") . "<br>
<hr>
<br>
<strong > <div align=\"left\" style='text-decoration: underline' > TRANSFERS & THEME PARKS INCLUDED ARE:</div></strong>
Round trip daily transportation from your Hotel to
<ul>" . $npark . "</ul>" . (($question == 1) ? "<strong>Admissions to Theme Parks ARE INCLUDED.</strong>" : "<strong>Admissions to Theme Parks are NOT INCLUDED.</strong>") . "<hr>" : "")
                . (($toursbooking['sarrival'] == 2) ? "Date Arrival <strong>" . date("M-d-Y", strtotime($toursbooking['fecha_llegada'])) . "</strong> &#45;you have choosen <strong>" . date("h:s A", strtotime($toursbooking['hora1'])) . "</strong>, on a luxury private transportation from <strong>" . $toursbooking['city'] . "</strong>, <strong>" . $toursbooking['address'] . "</strong> ,<strong>" . $area . '-' . $pickup . "</strong> to <strong>" . $toursbooking['hotel'] . "</strong><hr><strong > <div align=\"left\" > ACCOMMODATION</div></strong><br>Hotel accommodation at the <strong>" . $toursbooking['hotel'] . "</strong> in <strong>" . $toursbooking['rooms'] . "</strong> room(s). for <strong>" . $toursbooking['noches'] . "</strong> night(s) from <strong>" . $toursbooking['fecha_llegada'] . "</strong> Check In Time is 4:00pm . To<strong>" . date("M-d-Y", strtotime($toursbooking['fecha_salida'])) . "</strong> Check Out Time is 11:00am." . (($desayuno != 0) ? " FREE DAILY CONTINENTAL BREKFAST. " : "") . "Taxes are Included.<br>" . (($buffet == 1 && $_SESSION['categoria'] != 2 ) ? "<br><br>Daily SUPER BREKFAST BUFFET at your hotel." : "") . "<br><hr><br><strong > <div align=\"left\" > LOCAL TRANSFERS TO PARKS</div></strong>
<strong>" . date("M-d-Y", strtotime($toursbooking['fecha_salida'])) . "</strong> Check Out Time is 11:00am." . (($desayuno != 0) ? " FREE DAILY CONTINENTAL BREKFAST. " : "") . "Taxes are Included.<br>" . (($buffet == 1 && $_SESSION['categoria'] != 2 ) ? "<br><br>Daily SUPER BREKFAST BUFFET at your hotel." : "") . "<br><hr><br><strong > <div align=\"left\" > LOCAL TRANSFERS TO PARKS</div></strong>
Round trip daily transportation from your Hotel to
<ul>" . $npark . "</ul>" . (($question == 1) ? "<strong>Admissions to Theme Parks ARE INCLUDED.</strong>" : "<strong>Admissions to Theme Parks are NOT INCLUDED.</strong>") . "<hr>
    " : "")
                . (($toursbooking['sarrival'] == 3) ? "<br />Date Arrival <strong>" . date("M-d-Y", strtotime($toursbooking['fecha_llegada'])) . "</strong> &#45; Arriving: By plane  at Orlando International Airport 
Data Transfer In  :   Airline: <strong>" . $toursbooking['airlinearrival'] . "</strong>   Flight #:   <strong>" . $toursbooking['flightarrival'] . "</strong> Arrival Time:<strong>" . date("h:s A", strtotime($toursbooking['hora1'])) . "</strong>
. You will be greeted by your tour guide/driver in orlando to take you to  <strong>" . $toursbooking['hotel'] . "
<hr><strong > <div align=\"left\" id=\"titlett\"> ACCOMMODATION</div></strong><br>
Hotel accommodation at the <strong>" . $toursbooking['hotel'] . "</strong> in <strong>" . $toursbooking['rooms'] . "</strong> room(s). for <strong>" . $toursbooking['noches'] . "</strong> night(s) from <strong>" . date("M-d-Y", strtotime($toursbooking['fecha_llegada'])) . "</strong> Check In Time is 4:00pm . To
<strong>" . date("M-d-Y", strtotime($toursbooking['fecha_salida'])) . "</strong> Check Out Time is 11:00am." . (( $desayuno != 0) ? " FREE DAILY CONTINENTAL BREKFAST. " : "") . " Taxes are Included.
   <br>" . (($buffet == 1 && $_SESSION['categoria'] != 2) ? "<br><br>Daily SUPER BREKFAST BUFFET at your hotel." : "") . "<br>
<hr><br>
<strong > <div align=\"left\" style='text-decoration: underline'> TRANSFERS & THEME PARKS INCLUDED ARE:</div></strong>
Round trip daily transportation from your Hotel to<ul>" . $npark . "</ul>" . (($question == 1) ? "<strong>Admissions to Theme Parks ARE INCLUDED.</strong>" : "<strong>Admissions to Theme Parks are NOT INCLUDED.</strong>") . "<hr>" : "")
                . (($toursbooking['sarrival'] == 4) ? "<br />
Date Arrival <strong>" . date("M-d-Y", strtotime($toursbooking['fecha_llegada'])) . "</strong> PLEASE, LET US KNOW ABOUT YOUR ARRIVAL TO ORLANDO BY  DIALING  OUR TOLL FREE 1800-251-4206, TO PLACE YOUR TICKETS AT  <strong>" . $toursbooking['hotel'] . "</strong> OR FIGURE OUT ABOUT OTHER SERVICES. WE WILL PLEASED TO ASSIST YOU. 
<hr>
<strong > <div align=\"left\" id=\"titlett\"> ACCOMMODATION</div></strong><br>

Hotel accommodation at the <strong>" . $toursbooking['hotel'] . "</strong> in <strong>" . $toursbooking['rooms'] . "</strong> room(s). for <strong>" . $toursbooking['noches'] . "</strong> night(s) from <strong>" . date("M-d-Y", strtotime($toursbooking['fecha_llegada'])) . "</strong> Check In Time is 4:00pm . To
<strong>" . date("M-d-Y", strtotime($toursbooking['fecha_salida'])) . "</strong> Check Out Time is 11:00am." . (( $desayuno != 0) ? " FREE DAILY CONTINENTAL BREKFAST. " : "") . " Taxes are Included.
 <br>" . (($buffet == 1 && $_SESSION['categoria'] != 2) ? "<br><br>Daily SUPER BREKFAST BUFFET at your hotel." : "") . "<br>
<br>
<strong > <div align=\"left\" style='text-decoration: underline' > TRANSFERS & THEME PARKS INCLUDED ARE:</div></strong>
<ul>" . $npark . "</ul>" . (($question == 1) ? "<strong>Admissions to Theme Parks ARE INCLUDED.</strong>" : "<strong>Admissions to Theme Parks are NOT INCLUDED.</strong>") . "<hr>" : "") . "
        </p>
		
		
        <p>" . (($toursbooking['sdeparture'] == 1) ? "<strong > <div align=\"left\" id=\"titlett\"> ITINERARY DEPARTURE</div></strong><br>
          Bus Transportation  on Trip <strong>" . $toursbooking['trip2'] . "</strong>, <strong>" . date("M-d-Y", strtotime($toursbooking['fecha_salida'])) . "</strong> &#45; <strong>" . date("h:s A", strtotime($toursbooking ['datedeparturetrip2'])) . "</strong> &#45;  from Orlando Super Tours Terminal to <strong> " . $area2 . '-' . $pickup2 . " </strong> arriving at <strong>" . date("h:s A", strtotime($toursbooking ['datearrivingtrip2'])) . "</strong>  <br />
           " : "") . (($toursbooking['sdeparture'] == 2) ? "<strong > <div align=\"left\" id=\"titlett\"> ITINERARY DEPARTURE</div></strong>
         <br>Date departure <strong>" . $toursbooking['fecha_salida'] . "</strong> &#45; Drop Off Time:  <strong>" . date("h:s A", strtotime($toursbooking['hora2'])) . "</strong>, on a luxury private transportation from <strong>" . $toursbooking['city2'] . "</strong>, <strong>" . $toursbooking['address2'] . "</strong>, to MIAMI 
        <br />
          " : "") . (($toursbooking['sdeparture'] == 3) ? "<strong > <div align=\"left\" id=\"titlett\"> ITINERARY DEPARTURE</div></strong>
         <br>
Date departure <strong>" . date("M-d-Y", strtotime($toursbooking['fecha_salida'])) . "</strong>  &#45; Departure: By Plane at Orlando International Airport 
Data Transfer Out:   Airline: <strong>" . $toursbooking['airlinedeparture'] . "</strong>   Flight #:   <strong>" . $toursbooking['flightdeparture'] . "</strong> Arrival Time: <strong>" . date("h:s A", strtotime($toursbooking['hora2'])) . "</strong>



        <br />
          " : "") . (($toursbooking['sdeparture'] == 4) ? "<strong > <div align=\"left\" id=\"titlett\"> ITINERARY DEPARTURE</div></strong>
         <br>
     Date departure <strong>" . date("M-d-Y", strtotime($toursbooking['fecha_salida'])) . "</strong> <br> Departure: By Car   


        <br />
          " : "") . "
          
            <br />
              <br />
            </p></td>
        </tr>
    </table>

      </td>
  </tr>
  <tr>
    <td height='33' colspan='4' id='titletd' ><strong style='text-decoration: underline'>PRICE</strong></td>
  </tr>
  <tr>
    <td colspan='4'><table width='90%' border='0'>
      <tr>
        <td height='32' align='center'><strong>The total amount for your tour is:</strong> <span id='tqprice' >$" .
                (($otheramount == 0) ? ( ($toursbooking ['tqp'] * $toursbooking ['totalpax'])) : $otheramount)
                . "</span> </td>
      </tr>
      <tr>
        <td height='40' align='center' ><span class='Estilo1'>VERIFY YOUR TOUR BEFORE PROCEEDING CLICKING ON PAY TOUR</span></td>
      </tr>
      <tr>
        <td align='center'>Once you click on PAY TOUR, you can no longer make any changes or modifications.  For questions or assistance you may call (407) 370-3001 and speak with one of our Call Center Representative.<br /></td>
      </tr>
    </table>
    <p>&nbsp;</p>
    <p>Any or all unused services are Non-Refundable - Non-Transferable - Modification in Travel Dates are not permitted. <br />
	<p>Luggage restrictions apply - Please read the terms of transportation at <a href='https://www.supertours.com'>www.supertours.com</a> <br />
     <span style='text-align:center;'> 
	  <p>THANK YOU FOR CHOOSING SUPER TOURS OF ORLANDO! HAVE A SUPER TRIP!</p>
      <p><strong>SUPER TOURS OF ORLANDO, Inc.</strong> </p>
	  <p> 5419 International Drive, Orlando Fl. 32819</p>
      <p>Phone: (407) 370-3001 / U.S.A. TOLL FREE 1-800-251-4206 </p>
	  <p style='text-decoration: underline'>reservations@supertours.com</p>
     </span>
    </p></td>
  </tr>
  <tr>
    <td height='18' colspan='4' align='center'> <p align='center' class='titulopago'> 
    
</p>       </td>

  </tr>
  </table></div>";

        $cont = 0;
        $dest = array("email" => $login['email'], "nombre" => $login['firstname'] . ' ' . $login['lastname']);
        $destinatarios[$cont++] = $dest;

        if (isset($_SESSION['data_agency'])) {//Correo para la agencia
            Doo::loadModel("UserA");
            $user = unserialize($_SESSION ['uagency']);
            $dest = array("email" => $user->email, "nombre" => $user->firstname . ' ' . $user->lastname);
            $destinatarios[$cont++] = $dest;
        }
        if (isset($_SESSION['tourPagoMulDay'])) {
            if ($_SESSION['tourPagoMulDay'] == 'ok') {
                $correo_emisor = "websales@supertours.com";
                $nombre_emisor = "Supertours Of Orlando";
                //$dest = array("email"=> $correo_emisor, "nombre"=> $nombre_emisor);
                $destinatarios[$cont++] = $dest;
            }
        }
        $this->enviarCorreo($cotenido, $destinatarios);
    }

    public function autentication() {
        $this->data ['rootUrl'] = Doo::conf()->APP_URL;
        $this->renderc('/tours/loginuser', $this->data);
    }

    public function signup() {
        Doo::loadModel("Signup");
        $signup = new Signup ();

        $this->data ['rootUrl'] = Doo::conf()->APP_URL;
        $this->data ['signup'] = $signup;
        $this->data ['state'] = Doo::db()->find("State", array(
            "select name from State",
            "asArray" => true
        ));
        $this->data ['country'] = Doo::db()->find("Country", array(
            "select name from Country",
            "asArray" => true
        ));
        $this->renderc('/tours/pruesignup', $this->data);
    }

    public function logueo() {
        if (isset($_POST ['usuario']) && isset($_POST ['password'])) {

            if (!empty($_POST ['usuario']) && !empty($_POST ['password'])) {

                $user = trim($_POST ['usuario']);
                $pass = trim($_POST ['password']);
                $u = $this->db()->find('Clientes', array(
                    'where' => 'username = ? and password = ?',
                    'limit' => 1,
                    'select' => 'id,username,firstname,lastname,state,address,zip,tipo_client,city,country,phone',
                    'param' => array(
                        $user,
                        $pass
                    )
                ));

                $this->data ['rootUrl'] = Doo::conf()->APP_URL;
                if ($u == Null) { // o $u == false
                    $this->data ['error'] = "Acceso denegado";
                    // return Doo::conf()->APP_URL."admin";
                    $this->renderc('tours/loginuser', $this->data);
                } else {

                    $login = new stdclass ();
                    $login->username = $u->username;
                    $login->username2 = $u->username;
                    $login->firstname = $u->firstname;
                    $login->lastname = $u->lastname;
                    $login->state = $u->state;
                    $login->address = $u->address;
                    $login->zip = $u->zip;
                    $login->tipo_client = $u->tipo_client;
                    $login->city = $u->city;
                    $login->country = $u->country;
                    $login->phone = $u->phone;
                    $login->celphone = $u->celphone;
                    $login->id = $u->id;

                    $_SESSION ['user'] = $login;
                    $this->data ['rootUrl'] = Doo::conf()->APP_URL;
                    $auth = $this->isAuth();
                    if (isset($_SESSION['onedaytour']) && $_SESSION['onedaytour'] == true) {
                        return Doo::conf()->APP_URL . "tours/userlog2";
                    } else {
                        return Doo::conf()->APP_URL . "tours/userlog";
                    }
                }
            }
        } else {
            return Doo::conf()->APP_URL . "";
        }
    }

    public function pago() {
//        echo 'pago';
        if (isset($_SESSION['toursbooking'])) {
            Doo::loadModel("Agency");
            if (isset($_SESSION['data_agency'])) {
                $dat = new Agency($_SESSION['data_agency']);
                $tpoNormal = 'Agency Credit Card';
            } else {
                $dat = new Agency();
                $dat->id = -1;
                $dat->type_rate = 0;
                $tpoNormal = 'Passenger Credit Card';
            }

            $op = $this->types_payments();
            if (isset($_REQUEST['opcion_pago'])) {
                $pago = $_REQUEST['opcion_pago'];
            } else
                $pago = 1;
            if ($pago < "2") {
//                echo json_encode($_SESSION);
//                exit;
                Doo::loadController('admin/ToursController');
                $toursControl = new ToursController();
                $_SESSION['codconf'] = $toursControl->codigoConf(1);

                if (isset($_SESSION ['user'])) {
                    $user = $_SESSION ['user'];
                    $tourstick = array(
                        "firstname" => $user->firstname,
                        "lastname" => $user->firstname,
                        "email" => $user->username,
                        "cellphone" => $user->celphone,
                        "phone" => $user->phone
                    );
                    $_SESSION ["tourstick"] = $tourstick;

                    $this->data['rootUrl'] = Doo::conf()->APP_URL;
                    $this->view()->renderc('tours/pago', $this->data);
                } else {

                    $this->logUser();
                }
            } else {

                Doo::loadModel("Agency");
                $dat = new Agency($_SESSION['data_agency']);
                Doo::loadModel("Reserve");
                Doo::loadModel("Transfer");

                $sdeparture = (isset($_SESSION['toursbooking']['sdeparture']) ? $_SESSION['toursbooking']['sdeparture'] : 0);
                $sarrival = (isset($_SESSION['toursbooking']['sarrival']) ? $_SESSION['toursbooking']['sarrival'] : 0);
                if (($sarrival != 0) && ($sdeparture != 0)) {
                    if (($sarrival != 1)) {
                        $tranferIn = new Transfer();
                        $tranferIn->airlie = (isset($_SESSION['toursbooking']['airlinearrival']) ? $_SESSION['toursbooking']['airlinearrival'] : "");
                        $tranferIn->arrival_time = (isset($_SESSION['toursbooking']['hora1']) ? $_SESSION['toursbooking']['hora1'] : "");
                        $tranferIn->flight = (isset($_SESSION['toursbooking']['flightarrival']) ? $_SESSION['toursbooking']['flightarrival'] : "");
                        $tranferIn->total_pax = (isset($_SESSION['toursbooking']['totalpax']) ? $_SESSION['toursbooking']['totalpax'] : 0);
                        $tranferIn->total_price = (isset($_SESSION['toursbooking']['trasport_total1']) ? $_SESSION['toursbooking']['trasport_total1'] : 0);
                        $tranferIn->type = $sarrival;
                        $tranferIn->type_transfer = (isset($_SESSION['toursbooking']['service1']) ? $_SESSION['toursbooking']['service1'] : "N/A");
                        Doo::db()->insert($tranferIn) or die("Error Ingresando Datos de Trasporte_");
                        $inTrans = Doo::db()->lastInsertId();
                    }
                    if (($sdeparture != 1)) {
                        $tranferOut = new Transfer();
                        $tranferOut->airlie = (isset($_SESSION['toursbooking']['airlinedeparture']) ? $_SESSION['toursbooking']['airlinedeparture'] : "");
                        $tranferOut->arrival_time = (isset($_SESSION['toursbooking']['hora2']) ? $_SESSION['toursbooking']['hora2'] : "");
                        $tranferOut->flight = (isset($_SESSION['toursbooking']['flightdeparture']) ? $_SESSION['toursbooking']['flightdeparture'] : "");
                        $tranferOut->total_pax = (isset($_SESSION['toursbooking']['totalpax']) ? $_SESSION['toursbooking']['totalpax'] : 0);
                        $tranferOut->total_price = $_SESSION['toursbooking']['trasport_total2'];
                        $tranferOut->type = $sdeparture;
                        $tranferOut->type_transfer(isset($_SESSION['toursbooking']['service2']) ? $_SESSION['toursbooking']['service2'] : "N/A");
                        ;
                        Doo::db()->insert($tranferOut) or die("Error Ingresando Datos de Trasporte");
                        $outTrans = Doo::db()->lastInsertId();
                    }
                }

                Doo::loadModel("Hotel_Reserves");
                $hotel = new Hotel_Reserves();
                $hotel->additional_night = 0;
                $hotel->adult = $_SESSION['toursbooking']['adults'];
                $hotel->category = $_SESSION['categoria'];
                $hotel->child = $_SESSION['toursbooking']['childs'];
                $hotel->days = $_SESSION['toursbooking']['dias'];
                $hotel->id_agencia = $dat->id;
                $hotel->id_cliente = $login->id;
                $hotel->id_hotel = $_SESSION['toursbooking']['hotelid'];
                $hotel->nights = $_SESSION['toursbooking']['noches'];
                $hotel->room1_adult = $_SESSION ["toursbooking"]['adult_r1'];
                $hotel->room2_adult = $_SESSION ["toursbooking"]['adult_r2'];
                $hotel->room3_adult = $_SESSION ["toursbooking"]['adult_r3'];
                $hotel->room4_adult = $_SESSION ["toursbooking"]['adult_r4'];
                $hotel->room1_child = $_SESSION ["toursbooking"]['child_r1'];
                $hotel->room2_child = $_SESSION ["toursbooking"]['child_r2'];
                $hotel->room3_child = $_SESSION ["toursbooking"]['child_r3'];
                $hotel->room4_child = $_SESSION ["toursbooking"]['child_r4'];
                $hotel->roooms = $_SESSION['toursbooking']['rooms'];
                $hotel->total_paid = $_SESSION['toursbooking']['totalhotel'];
                $hotel->total_persons = $_SESSION['toursbooking']['totalpax'];
                $hotel->type = 0;
                Doo::db()->insert($hotel) or die("Error Ingresando Datos de Hotel");
                $id_hotel_reserves = Doo::db()->lastInsertId();

                Doo::loadModel("Tours");
                $tours = new Tours();
                $tours->id_agency = $dat->id;
                $tours->id_client = $login->id;
                $tours->id_hotel_reserve = $id_hotel_reserves;
                $tours->id_transfer_in = (isset($inTrans) ? $inTrans : "-1");
                $tours->id_transfer_out = (isset($outTrans) ? $outTrans : "-1");
                ;
                $tours->agency_employee = $dat->id;
                $tours->code_conf = $_SESSION['codconf'];
                $tours->creation_date = date("Y-m-d");
                $tours->ending_date = $_SESSION['toursbooking']['fecha_llegada'];
                $tours->starting_date = $_SESSION['toursbooking']['fecha_salida'];
                $tours->length_day = $_SESSION['toursbooking']['dias'];
                $tours->length_nights = $_SESSION['toursbooking']['noches'];
                $tours->child = $hotel->child;
                $tours->adult = $tours->adult;
                Doo::db()->insert($tours) or die("Error Ingresando Datos de Tours");
                $id_tours = Doo::db()->lastInsertId();


                $group = $_SESSION ['grupos'];
                $group1 = $_SESSION ['grupos1'];

                $i = 0;
                Doo::loadModel("Attraction_Trafic");
                Doo::loadModel('Parques');
                $key = array_keys($group);
                while ($i < count($key)) {
                    $grou = explode(',', $group1['park' . $key[$i]]);
                    $j = 0;
                    while ($j < count($grou)) {
                        $attraction = new Attraction_Trafic();
                        $attraction->admission = $_SESSION['toursbooking']['question'];
                        $attraction->id_tours = $id_tours;
                        $attraction->adult = $_SESSION['toursbooking']['adults'];
                        $attraction->child = $_SESSION['toursbooking']['childs'];
                        $attraction->group = $key[$i];
                        $attraction->id_agencia = $dat->id;
                        $attraction->id_cliente = $login->id;
                        $attraction->id_park = $grou[$j];
                        $attraction->total_paid = $_SESSION['toursbooking']['parktotal'];
                        $attraction->total_person = $_SESSION['toursbooking']['totalpax'];
                        $attraction->trafic = 1;
                        Doo::db()->insert($attraction) or die("Error Ingresando Datos de Attractions");
                        ;
                        if ($attraction->admission == 1) {
                            $parque = new Parques();
                            $parque->id = $attraction->id_park;
                            $parque = Doo::db()->getOne($parque);
                            $parque->stock = intval($parque->stock) - ($tours->child + $tours->adult);
                            $parque->update();
                        }
                        $j++;
                    }
                    $i++;
                }


                if (($sarrival == 1) || ($sdeparture == 1)) {
                    $reserves = new Reserve();
                    $arval = array_values($op[$pago]);
                    $arkey = array_keys($op[$pago]);
                    $reserves->agen = $dat->id;
                    $reserves->agency = $dat->id;
                    $reserves->arrtime1 = (isset($_SESSION['toursbooking']['datearrivingtrip1']) ? $_SESSION['toursbooking']['datearrivingtrip1'] : "");
                    $reserves->arrtime2 = (isset($_SESSION['toursbooking']['datearrivingtrip2']) ? $_SESSION['toursbooking']['datearrivingtrip2'] : "");
                    $reserves->codconf = (isset($_SESSION['code']) ? $_SESSION['code'] : -1);
                    ;
                    $reserves->comments;
                    $reserves->deptime1 = (isset($_SESSION['toursbooking']['datedeparturetrip1']) ? $_SESSION['toursbooking']['datedeparturetrip1'] : "");
                    $reserves->deptime2 = (isset($_SESSION['toursbooking']['datedeparturetrip1']) ? $_SESSION['toursbooking']['datedeparturetrip2'] : "");
                    $reserves->fecha_retorno = (isset($_SESSION['toursbooking']['fecha_salida']) ? $_SESSION['toursbooking']['fecha_salida'] : "");
                    $reserves->fecha_salida = (isset($_SESSION['toursbooking']['fecha_llegada']) ? $_SESSION['toursbooking']['fecha_llegada'] : "");
                    $reserves->agen = $dat->id;
                    $reserves->codconf = (isset($_SESSION['code']) ? $_SESSION['code'] : -1);
                    $reserves->dropoff1 = (isset($_SESSION['pickup2']) ? $_SESSION['pickup2'] : 0);
                    $reserves->fecha_ini = date("Y-m-d");
                    $reserves->fecha_retorno = (isset($_SESSION['toursbooking']['fecha_llegada']) ? $_SESSION['toursbooking']['fecha_llegada'] : "");
                    $reserves->fecha_salida = (isset($_SESSION['toursbooking']['fecha_salida']) ? $_SESSION['toursbooking']['fecha_salida'] : "");
                    $reserves->firsname = $_REQUEST['firstname_tick'];
                    $reserves->hora = date("H:i:s");
                    $reserves->id_clientes = $user->id;
                    $reserves->tipo_pago = $arkey[0];
                    $reserves->pago = $arval[0];
                    $reserves->lasname = $_REQUEST['lastname_tick'];
                    $reserves->email = $_REQUEST['email_tick'];
                    $reserves->dropoff1 = (isset($_SESSION['dropoff1']) ? $_SESSION['dropoff1'] : 0);
                    
                    $reserves->dropoff2 = (isset($_SESSION['dropoff2']) ? $_SESSION['dropoff2'] : 0);
                    
                    $reserves->pickup1 = (isset($_SESSION['pickup1']) ? $_SESSION['pickup1'] : 0);
                    
                    $reserves->pickup2 = (isset($_SESSION['pickup2']) ? $_SESSION['pickup2'] : 0);
                    
                    $reserves->id_tours = $id_tours;
                    $reserves->tipo_ticket = (($sarrival == 1) && ($sdeparture == 1)) ? "roundtrip" : "oneway";
                    $reserves->totaltotal = (isset($_SESSION['toursbooking']['trasport_total2']) ? $_SESSION['toursbooking']['trasport_total2'] : 0) + (isset($_SESSION['toursbooking']['trasport_total1']) ? $_SESSION['toursbooking']['trasport_total1'] : 0);
                    $reserves->trip_no = (isset($_SESSION['toursbooking']['trip1']) ? $_SESSION['toursbooking']['trip1'] : "");
                    $reserves->trip_no2 = (isset($_SESSION['toursbooking']['trip2']) ? $_SESSION['toursbooking']['trip2'] : "");
                    Doo::db()->insert($reserves) or die("Error Ingresando Datos de Trasnporte Por Bus");
                    $id_reserva = Doo::db()->lastInsertId();
                }

                Doo::loadModel("Tours_Agency");
                $tours_reserv = new Tours_Agency();
                $comision = $this->cal_equipament();
                $totalouta = ($_SESSION ['toursbooking'] ['tsa'] * $_SESSION['toursbooking']['totalpax']);
                if ($_SESSION ['toursbooking']['comision_agency'] != 0) {
                    $total = ($totalouta - (($totalouta * $_SESSION ['toursbooking']['comision_agency']) / 100));
                } else {
                    $total = $totalouta;
                }
                $tours_reserv->id_agency = $dat->id;
                $tours_reserv->agency_fee = $agency_fee;
                $tours_reserv->comision = $comision;
                $tours_reserv->id_reserva = $id_reserva;
                $tours_reserv->id_tours = $id_tours;
                $arval = array_values($op[$pago]);
                $arkey = array_keys($op[$pago]);
                $tours_reserv->tipo_pago = $arkey[0];
                $tours_reserv->pago = $arval[0];
                $tours_reserv->type_rate = $dat->type_rate;
                $tours_reserv->total = $total;
                Doo::db()->insert($tours_reserv) or die("Error Ingresando Datos de Trasnporte Por Bus");
            }
        } else {
            return Doo::conf()->APP_URL . "agency/";
        }
    }

    public function cal_equipament() {
        Doo::loadModel("Agencomi");
        $age_comis = Doo::db()->find("Agencomi", array("where" => "service_code = '003' ", "limit" => 1));
        if (!empty($age_comis))
            return $age_comis->comision;
        else
            return 0;
    }

    public function save() {
        Doo::loadModel("Signup");

        $signup = new Signup($_POST);
        $signup->password = trim($signup->password);
        $signup->fecha_r = date("m-d-Y  H:i:s");

        $sql = "SELECT username FROM clientes WHERE  username = ?";
        // Registered user
        $signup2 = new stdclass ();
        $signup2->username = $signup->username;
        $signup2->firstname = $signup->firstname;
        $signup2->lastname = $signup->lastname;

        // Billing address
        $signup2->address = $signup->address;
        $signup2->city = $signup->city;
        $signup2->zip = $signup->zip;
        $signup2->phone = $signup->phone;
        $signup2->celphone = $signup->celphone;

        $signup2->error = "";

        $_SESSION ['signup2'] = $signup2;

        $rs = Doo::db()->query($sql, array(
            $signup->username
        ));
        $reci = $rs->fetch();

        if ($reci != NUll) {
            echo '<script>location.href="' . Doo::conf()->APP_URL . "tours/slope" . '"</script>';
            return Doo::conf()->APP_URL . "tours/slope";
        } else {

            $new = false;
            if ($signup->birthday != "") {

                $signup->tipo_client = 1;
            } else {
                $signup->tipo_client = 0;
            }
            if ($_POST ['id'] == "") {
                $signup->id = Null;
                $new = true;
            }

            $this->data ['rootUrl'] = Doo::conf()->APP_URL;

            if ($new) {
                Doo::db()->insert($signup);

                if (isset($_POST ['username']) && isset($_POST ['firstname'])) {

                    if ($signup->tipo_client == 1) {

                        try {
                            Doo::loadController('DatosMailController');
                            $datosMail = new DatosMailController();
                            $mail4 = new PHPMailer(true);
                            $mail4 = $datosMail->datos();

                            $nombre_destino = $signup->firstname; // Nombre de quien
                            // La direccion a donde mandamos el correo
                            $mail4->AddAddress($signup->username, $nombre_destino);
                            // Asunto del correo
                            $mail4->Subject = 'Signup / Supertours Of Orlando';
                            // Mensaje alternativo en caso que el destinatario
                            // no pueda abrir correos HTML
                            $mail4->AltBody = 'Signup / Supertours Of Orlando';

                            $mail4->MsgHTML("<div align='center'>
<br />
<table   id='clearTable'> 
     <tr>
       <td width='401' height='33' rowspan='2' id='titletd3'><img src='https://www.supertours.com/Logo-Supertours-mail.jpg' width='316' height='88' /></td>
       <td colspan='3' align='center' id='titletd3'>Supertours.com</td>
     </tr>
     <tr>
       <td height='35' colspan='3' id='titletd4'>&nbsp;</td>
    </tr>
     <tr>
       <td align='center' height='33' colspan='4' id='titletd2'>SUPER CLUB</td>
     </tr>
     <tr>
       
       
       <td colspan='2' align='center' id='titletd6'>Welcome, " . $_POST ['username'] . " you are a member of the SUPERCLUB <br />
         The incentive program for frequent passengers <br />
       of SUPER TOURS OF ORLANDO, Inc.</td>
    </tr>
   
     
  <tr>
    <td colspan='4' ><table id='tableorder3' width='90%'>
      <tr>
        <td  height='35' colspan='3' id='titlett3'  aling='center' >RECEIPT</td>
        </tr>
      <tr>
        <td width='34%' height='28'>MEMBER NAME:</td>
        <td colspan='2'>" . $_POST ['firstname'] . " " . $_POST ['lastname'] . "</td>
      </tr>
      <tr>
        <td height='31'>MEMBER SINCE:</td>
        <td colspan='2'>JUN. 12-2012 / 13:32</td>
      </tr>
      <tr>
        <td height='27'>USERNAME:</td>
        <td colspan='2'>" . $_POST ['username'] . "</td>
      </tr>
      <tr>
        <td height='27'>PASSWORD:</td>
        <td>" . $signup->password . "</td>
      </tr>
      <tr>
        <td height='27'>&nbsp;</td>
        <td colspan='2'>&nbsp;</td>
      </tr>
    </table>
    <p><br />
  </p></td>
  </tr>
  <tr>
    <td height='37' colspan='4' align='center' id='titletd' ><strong>REDWARS</strong></td>
  </tr>
  <tr>
    <td colspan='4'>&bull;  A FREE ticket, after 10 trips paid</td>
  </tr>
  <tr>
    <td colspan='4'>&bull;  A free ticket on your birthday week</td>
  </tr>
  <tr>
    <td colspan='4'>&bull;  Exclusive offers for members of SUPER CLUB </td>
  </tr>
  <tr>
    <td colspan='4'>&nbsp;</td>
  </tr>
  <tr>
    <td colspan='4'>&nbsp;</td>
  </tr>
  <tr>
    <td colspan='4' align='center'> <p align='center' class='titulopago'>THANK YOU FOR CHOOSING US <br />
      SUPER TOURS OF ORLANDO,Inc. 5419 International Drive, Orlando Fl. 32819 <br />
      Phone: (407) 370-3001 / U.S.A. TOLL FREE 1-800-251-4206 / reservations@supertours.com  
    
</p>       </td>
  </tr>
  </table>



</div>");
                            $mail4->Send();
//                            echo '<script>location.href='.Doo::conf()->APP_URL . "tours/pago".'</script>';
                            // echo "Mensaje enviado. Que chivo va vos!!";
                        } catch (phpmailerException $e) {
                            echo $e->errorMessage(); // Errores de PhpMailer
                        } catch (Exception $e) {
                            echo $e->getMessage(); // Errores de cualquier otra cosa.
                        }
                    } else {
                        try {
                            $nombre_destino = $signup->firstname;
                            Doo::loadController('DatosMailController');
                            $datosMail = new DatosMailController();
                            $mail4 = new PHPMailer(true);
                            $mail4 = $datosMail->datos();
                            // La direccion a donde mandamos el correo
                            $mail4->AddAddress($signup->username, $nombre_destino);
                            // De parte de quien es el correo
                            $mail4->Subject = 'Signup / Supertours Of Orlando';
                            // Mensaje alternativo en caso que el destinatario
                            // no pueda abrir correos HTML
                            $mail4->AltBody = 'Signup / Supertours Of Orlando';

                            $mail4->MsgHTML("<div align='center'>
<br />
<table   id='clearTable'> 
     <tr>
       <td width='401' height='33' rowspan='2' id='titletd3'><img src='https://www.supertours.com/Logo-Supertours-mail.jpg' width='316' height='88' /></td>
       <td colspan='3' align='center' id='titletd3'>Supertours.com</td>
     </tr>
     <tr>
       <td height='35' colspan='3' id='titletd4'>&nbsp;</td>
    </tr>
     <tr>
       <td align='center' height='33' colspan='4' id='titletd2'>&nbsp;</td>
     </tr>
     <tr>
       
       
       <td colspan='2' align='center' id='titletd6'>Welcome, " . $_POST ['username'] . "</td>
    </tr>
   
     
  <tr>
    <td colspan='4' ><table id='tableorder3' width='90%'>
      <tr>
        <td  height='35' colspan='3' id='titlett3'  aling='center' >RECEIPT</td>
        </tr>
      <tr>
        <td width='34%' height='28'>MEMBER NAME:</td>
        <td colspan='2'>" . $_POST ['firstname'] . " " . $_POST ['lastname'] . "</td>
      </tr>
      <tr>
        <td height='31'>MEMBER SINCE:</td>
        <td colspan='2'>JUN. 12-2012 / 13:32</td>
      </tr>
      <tr>
        <td height='27'>USERNAME:</td>
        <td colspan='2'>" . $_POST ['username'] . "</td>
      </tr>
      <tr>
        <td height='27'>PASSWORD:</td>
        <td>" . $signup->password . "</td>
      </tr>
      <tr>
        <td height='27'>&nbsp;</td>
        <td colspan='2'>&nbsp;</td>
      </tr>
    </table>
    <p><br />
  </p></td>
  </tr>
  <tr>
    <td colspan='4'>&nbsp;</td>
  </tr>
  <tr>
    <td colspan='4'>&nbsp;</td>
  </tr>
  <tr>
    <td colspan='4' align='center'> <p align='center' class='titulopago'>THANK YOU FOR CHOOSING US <br />
      SUPER TOURS OF ORLANDO,Inc. 5419 International Drive, Orlando Fl. 32819 <br />
      Phone: (407) 370-3001 / U.S.A. TOLL FREE 1-800-251-4206 / reservations@supertours.com  
    
</p>       </td>
  </tr>
  </table>



</div>");
                            $mail4->Send();
                            // echo "Mensaje enviado. Que chivo va vos!!";
                        } catch (phpmailerException $e) {
                            echo $e->errorMessage(); // Errores de PhpMailer
                        } catch (Exception $e) {
                            echo $e->getMessage(); // Errores de cualquier otra cosa.
                        }
                    }
                    $login = new stdclass ();
                    $login->username = $signup->username;
                    $login->firstname = $signup->firstname;
                    $login->lastname = $signup->lastname;
                    $login->state = $signup->state;
                    $login->address = $signup->address;
                    $login->tipo_client = $signup->tipo_client;
                    $login->zip = $signup->zip;
                    $login->phone = $signup->phone;
                    $login->celphone = $signup->celphone;
                    $login->id = Doo::db()->lastInsertId();
                    $_SESSION ['user'] = $login;
                    $this->logUser();

                    echo '<script>location.href="' . Doo::conf()->APP_URL . "tours/pago" . '"</script>';
                    return Doo::conf()->APP_URL . "tours/pago";
                }
            } else {
                Doo::db()->update($signup);
                echo '<script>location.href="' . Doo::conf()->APP_URL . "tours/pago" . '"</script>';
            }
        }
    }

    public function slope() {
        $this->data ['rootUrl'] = Doo::conf()->APP_URL;
        $this->view()->renderc('slope', $this->data);
    }

    public function tours_six() {
        if (isset($_POST['usuario']) && isset($_POST['password'])) {

            if (!empty($_POST['usuario']) && !empty($_POST['password'])) {

                $user = trim($_POST['usuario']);
                $pass = trim($_POST['password']);



                //$pass  = trim($_POST['password']);
                $u = $this->db()->find('Clientes', array('where' => 'username = ? and password = ?',
                    'limit' => 1,
                    'select' => 'id,username,firstname,lastname,state,address,zip,tipo_client,city,country,phone,celphone',
                    'param' => array($user, $pass)
                        )
                );

                $this->data['rootUrl'] = Doo::conf()->APP_URL;

                if ($u == Null) { // o $u == false
                    $this->data['error'] = "Acceso denegado";
                    //return Doo::conf()->APP_URL."admin";
                    $this->renderc('loginuser', $this->data);
                } else {

                    $login = new stdclass();
                    $login->username = $u->username;
                    $login->username2 = $u->username;
                    $login->firstname = $u->firstname;
                    $login->lastname = $u->lastname;
                    $login->state = $u->state;
                    $login->address = $u->address;
                    $login->zip = $u->zip;
                    $login->tipo_client = $u->tipo_client;
                    $login->city = $u->city;
                    $login->country = $u->country;
                    $login->phone = $u->phone;
                    $login->celphone = $u->celphone;
                    $login->id = $u->id;

                    $_SESSION['user'] = $login;
                    //$this->home();
                    $auth = $this->isAuth();

                    return Doo::conf()->APP_URL . "'tours/loginuser/'";
                }
            }
        } else {
            return Doo::conf()->APP_URL . "tours/userlog";
        }
    }

    public function logUser() {

        extract($_POST, EXTR_SKIP);
        if (isset($_SESSION['onedaytour'])) {
            if ($_SESSION['onedaytour'] == true) {
                return Doo::conf()->APP_URL . "one-day-tour";
                exit;
            }
        }
        $_SESSION['onedaytour'] = false;
        if (!isset($_SESSION ['user'])) {
            if (!(isset($firstname_tick) && isset($lastname_tick) && isset($email_tick) && isset($cellular_tick) /*&& isset($phone_tick)*/ && isset($_SESSION['toursbooking']) )) {
                if (isset($_SESSION['data_agency'])) {
                    return Doo::conf()->APP_URL . "agency/#tours";
                } else {
                    return Doo::conf()->APP_URL . "tours/";
                }
            }
            $tourstick = array(
                "firstname" => $firstname_tick,
                "lastname" => $lastname_tick,
                "email" => $email_tick,
                "cellphone" => $cellular_tick,
                //"phone" => $phone_tick
            );
            $_SESSION ["tourstick"] = $tourstick;
            $this->data['rootUrl'] = Doo::conf()->APP_URL;
            $this->renderc('tours/loginuser', $this->data);
        } else {
            $login = $user = $_SESSION ['user'];
            if (isset($_SESSION['data_agency'])) {
                $tourstick = array(
                    "firstname" => $firstname_tick,
                    "lastname" => $lastname_tick,
                    "email" => $email_tick,
                    "cellphone" => $cellular_tick,
                    //"phone" => $phone_tick
                );
                $_SESSION ["tourstick"] = $tourstick;
            } else {
                $tourstick = array(
                    "firstname" => $user->firstname,
                    "lastname" => $user->lastname,
                    "email" => $user->username,
                    "cellphone" => $user->celphone,
                    //"phone" => $user->phone
                );
                $_SESSION ["tourstick"] = $tourstick;
            }
            if (isset($_SESSION['toursbooking'])) {
                if (isset($_REQUEST['opcion_pago'])) {
                    $pago = $_REQUEST['opcion_pago'];
                } else
                    $pago = 1;
                $total = $_SESSION['toursbooking']['tqp'] * $_SESSION['toursbooking']['totalpax'];
                if ($pago == '3') {
                    $fee = $total * 0.04;
                    $_SESSION['priceFee'] = $fee;
                } else {
                    $fee = 0;
                    $_SESSION['priceFee'] = 0;
                }
                Doo::loadModel("Agency");
                if (isset($_SESSION['data_agency'])) {
                    $dat = new Agency($_SESSION['data_agency']);
                } else {
                    $dat = new Agency();
                    $dat->id = -1;
                    $dat->type_rate = 0;
                }
                $op = $this->types_payments();
                if (isset($_REQUEST['opcion_pago'])) {
                    $pago = $_REQUEST['opcion_pago'];
                } else {
                    if ($dat->id == -1) {//Paga el usurio
                        $pago = isset($_POST['opcion_pago']) ? $_POST['opcion_pago'] : 2;
                    } else {
                        $pago = isset($_POST['opcion_pago']) ? $_POST['opcion_pago'] : 1;
                    }
                }
                if (isset($_REQUEST['opcion_pago_saldo'])) {
                    $tipo_saldo = $_REQUEST['opcion_pago_saldo'];
                } else {
                    $tipo_saldo = 1;
                }
                if ($tipo_saldo == 2) {
                    $opcion_saldo = 'BALANCE';
                } else {
                    $opcion_saldo = 'FULL';
                }
                
                if(isset($_REQUEST['comentarios'])){
                    $_SESSION['toursbooking']['comentarios'] = $_REQUEST['comentarios'];
                }else{
                    $_SESSION['toursbooking']['comentarios'] = "";
                }
                
                if (isset($_REQUEST['otheramount'])) {
                    $otheramount = (is_numeric($_REQUEST['otheramount'])) ? $_REQUEST['otheramount'] : 0;
                } else {
                    $otheramount = 0;
                }
                $_SESSION['toursbooking']['otheramount'] = $otheramount;
                if (isset($_SESSION['toursbooking']['comision_agency'])) {
                    $valorComision = $_SESSION['toursbooking']['comision_agency'];
                } else {
                    $valorComision = 0.00;
                }
                if ($pago == 1 || $tipo_saldo == 2) {
                    $totaltotal = $total - $valorComision;
                } else {
                    $totaltotal = $total;
                }

                $totaltotal = $totaltotal + $fee;
                Doo::loadController('admin/ToursController');
                $toursControl = new ToursController();
                $_SESSION['codconf'] = $toursControl->codigoConf(1);
                $totalmemoria = (round($_SESSION['toursbooking']['tqp']) * $_SESSION['toursbooking']['totalpax']);
                if ($pago < 3) {
                    $arval = array_values($op[$pago]);
                    unset($_SESSION['pagoListo']);
                    $_SESSION['toursbooking']['totalouta'] = $totaltotal;
                    $_SESSION['toursbooking']['otheramount'] = $otheramount;
                    if ($otheramount == 0) {
                        $_SESSION['toursbooking']['pago_pred'] = $totalmemoria;
                    } else {
                        $_SESSION['toursbooking']['pago_pred'] = $otheramount;
                    }
                    $_SESSION['toursbooking']['opcionPago'] = $arval[0] . '-' . $opcion_saldo;
                    $this->data['opcionPago'] = $pago;
                    $this->data['rootUrl'] = Doo::conf()->APP_URL;
                    $this->view()->renderc('tours/pago', $this->data);

                    #cotizacion 
                    try {
                        $contenido .= print_r($_SESSION, true);
                        $contenido .= "<span style='color:red;'>Cotizacion con usuario login true</span>";
                        $mail = new PHPMailer();
                        $mail->IsSMTP();
                        $correo_emisor = "websales@supertours.com";
                        $nombre_emisor = "Supertours Of Orlando";
                        $contrasena = "Daniel4";
                        //$mail->SMTPDebug  = 2;                  
                        $mail->SMTPAuth = true;
                        //$mail->SMTPSecure = "tsl";                
                        $mail->SMTPSecure = "ssl";
                        $mail->Host = "smtpout.secureserver.net";
                        $mail->Port = 465;
                        $mail->Username = $correo_emisor;
                        $mail->Password = $contrasena;
                        //$mail->AddReplyTo($correo_emisor, $nombre_emisor);
                        $mail->SetFrom("no_reply@supertours.com", $nombre_emisor);
                        $mail->Subject = 'Supertours Of Orlando, Cotizacion con usuario login true -' . date("d-m-Y h:i:s");
                        $mail->AltBody = 'Supertours Of Orlando, Cotizacion con usuario login true -' . date("d-m-Y h:i:s");
                        $mail->AddAddress("henry@supertours.com", "");
                        $mail->MsgHTML($contenido);
                        $mail->Send();
                    } catch (phpmailerException $e) {
                        echo $e->errorMessage(); // Errores de PhpMailer
                    } catch (Exception $e) {
                        echo $e->getMessage(); // Errores de cualquier otra cosa.
                    }
                    #fin de cotizacion
                } else {

                    Doo::loadModel("Reserve");
                    Doo::loadModel("Transfer");
                    Doo::loadModel("Clientes");

                    //Cargando Datos cliente
                    $cliente = new Clientes();
                    $cliente->username = $tourstick['email'];
                    $cliente = Doo::db()->find($cliente, array('limit' => 1));
                    if (empty($cliente)) {
                        $cliente = new Clientes();
                        $cliente->username = $tourstick['email'];
                        $cliente->firstname = $tourstick['firstname'];
                        $cliente->lastname = $tourstick['lastname'];
                        $cliente->phone = $tourstick['phone'];
                        $cliente->celphone = $tourstick['cellphone'];
                        Doo::db()->insert($cliente) or die("Error Ingresando Datos de Cliente");
                        $id_cliente = Doo::db()->lastInsertId();
                        $cliente->id = $id_cliente;
                    }

                    //FIN carga datos clientes
                    $sdeparture = (isset($_SESSION['toursbooking']['sdeparture']) ? $_SESSION['toursbooking']['sdeparture'] : 0);
                    $sarrival = (isset($_SESSION['toursbooking']['sarrival']) ? $_SESSION['toursbooking']['sarrival'] : 0);
                    $type_tour = 'MULTI';
                    if (($sarrival != 0) && ($sdeparture != 0)) {
                        if (($sarrival != 1)) {
                            $tranferIn = new Transfer();
                            $tranferIn->airlie = (isset($_SESSION['toursbooking']['airlinearrival']) ? $_SESSION['toursbooking']['airlinearrival'] : "");
                            $tranferIn->arrival_time = (isset($_SESSION['toursbooking']['hora1']) ? $_SESSION['toursbooking']['hora1'] : "");
                            $tranferIn->flight = (isset($_SESSION['toursbooking']['flightarrival']) ? $_SESSION['toursbooking']['flightarrival'] : "");
                            $tranferIn->total_pax = (isset($_SESSION['toursbooking']['totalpax']) ? $_SESSION['toursbooking']['totalpax'] : 0);
                            $tranferIn->total_price = (isset($_SESSION['toursbooking']['trasport_total1']) ? $_SESSION['toursbooking']['trasport_total1'] : 0);
                            $tranferIn->type = $sarrival;
                            $tranferIn->type_transfer = (isset($_SESSION['toursbooking']['service1']) ? $_SESSION['toursbooking']['service1'] : "N/A");
                            $tranferIn->city = (isset($_SESSION['toursbooking']['city']) ? $_SESSION['toursbooking']['city'] : 0);
                            $tranferIn->address = (isset($_SESSION['toursbooking']['address']) ? $_SESSION['toursbooking']['address'] : 0);
                            $tranferIn->zipcode = (isset($_SESSION['toursbooking']['zipcode']) ? $_SESSION['toursbooking']['zipcode'] : 0);
                            $tranferIn->phone = (isset($_SESSION['toursbooking']['phone']) ? $_SESSION['toursbooking']['phone'] : "N/A");

                            Doo::db()->insert($tranferIn) or die("Error Ingresando Datos de Trasporte_");
                            $inTrans = Doo::db()->lastInsertId();
                        }
                        if (($sdeparture != 1)) {
                            $tranferOut = new Transfer();
                            $tranferOut->airlie = (isset($_SESSION['toursbooking']['airlinedeparture']) ? $_SESSION['toursbooking']['airlinedeparture'] : "");
                            $tranferOut->arrival_time = (isset($_SESSION['toursbooking']['hora2']) ? $_SESSION['toursbooking']['hora2'] : "");
                            $tranferOut->flight = (isset($_SESSION['toursbooking']['flightdeparture']) ? $_SESSION['toursbooking']['flightdeparture'] : "");
                            $tranferOut->total_pax = (isset($_SESSION['toursbooking']['totalpax']) ? $_SESSION['toursbooking']['totalpax'] : 0);
                            $tranferOut->total_price = $_SESSION['toursbooking']['trasport_total2'];
                            $tranferOut->type = $sdeparture;

                            $tranferOut->type_transfer = (isset($_SESSION['toursbooking']['service2']) ? $_SESSION['toursbooking']['service2'] : "N/A");

                            $tranferOut->city = (isset($_SESSION['toursbooking']['city2']) ? $_SESSION['toursbooking']['city2'] : 0);
                            $tranferOut->address = (isset($_SESSION['toursbooking']['address2']) ? $_SESSION['toursbooking']['address2'] : 0);
                            $tranferOut->zipcode = (isset($_SESSION['toursbooking']['zipcode2']) ? $_SESSION['toursbooking']['zipcode2'] : 0);
                            $tranferOut->phone = (isset($_SESSION['toursbooking']['phone2']) ? $_SESSION['toursbooking']['phone2'] : "N/A");

                            Doo::db()->insert($tranferOut) or die("Error Ingresando Datos de Trasporte");
                            $outTrans = Doo::db()->lastInsertId();
                        }
                    }

                    Doo::loadModel("Hotel_Reserves");
                    $hotel = new Hotel_Reserves();
                    $hotel->additional_night = 0;
                    $hotel->adult = $_SESSION['toursbooking']['adults'];
                    $hotel->category = $_SESSION['categoria'];
                    $hotel->child = $_SESSION['toursbooking']['childs'];
                    $hotel->days = $_SESSION['toursbooking']['dias'];
                    $hotel->id_agencia = $dat->id;
                    $hotel->id_cliente = $login->id;
                    $hotel->id_hotel = $_SESSION['toursbooking']['hotelid'];
                    $hotel->nights = $_SESSION['toursbooking']['noches'];
                    $hotel->creation_date = date("Y-m-d H:i");
                    $hotel->starting_date = $_SESSION['toursbooking']['fecha_llegada'];
                    $hotel->ending_date = $_SESSION['toursbooking']['fecha_salida'];
                    $hotel->room1_adult = $_SESSION ["toursbooking"]['adult_r1'];
                    $hotel->room2_adult = $_SESSION ["toursbooking"]['adult_r2'];
                    $hotel->room3_adult = $_SESSION ["toursbooking"]['adult_r3'];
                    $hotel->room4_adult = $_SESSION ["toursbooking"]['adult_r4'];
                    $hotel->room1_child = $_SESSION ["toursbooking"]['child_r1'];
                    $hotel->room2_child = $_SESSION ["toursbooking"]['child_r2'];
                    $hotel->room3_child = $_SESSION ["toursbooking"]['child_r3'];
                    $hotel->room4_child = $_SESSION ["toursbooking"]['child_r4'];
                    $hotel->roooms = $_SESSION['toursbooking']['rooms'];
                    if ($_SESSION ['menosbuff']['buff'] == 'SUPER BREKFAST BUFFET') {
                        $hotel->breakfastprice = $_SESSION ['menosbuff']['breakfastprice'];
                        $hotel->totalbreakfasts = $hotel->breakfastprice * $hotel->nights;
                    } else {
                        $hotel->breakfastprice = 0;
                        $hotel->totalbreakfasts = 0;
                    }
                    $hotel->nightprice = $_SESSION ["menosbuff"] ["nightprice"];
                    $hotel->totalnights = $hotel->nightprice * $hotel->nights;
                    $hotel->total_paid = $hotel->totalnights + $hotel->totalbreakfasts;
                    $hotel->total_persons = $_SESSION['toursbooking']['totalpax'];
                    $hotel->type = 0;
                    Doo::db()->insert($hotel) or die("Error Ingresando Datos de Hotel");
                    $id_hotel_reserves = Doo::db()->lastInsertId();

                    Doo::loadModel("Tours");
                    $arval = array_values($op[$pago]);
                    $arkey = array_keys($op[$pago]);
                    $platinum = $_SESSION['toursbooking']['question'];
                    $tours = new Tours();
                    $tours->id_client = $cliente->id;
                    $tours->tipo_client = $cliente->tipo_client;
                    $tours->platinum = ($platinum == 2) ? 1 : 0;
                    $tours->id_agency = $dat->id;
                    $tours->code_conf = $_SESSION['codconf'];
                    $tours->agency_employee = $user->id;
                    $tours->creation_date = date("Y-m-d H:i");
                    $tours->starting_date = $_SESSION['toursbooking']['fecha_llegada'];
                    $tours->ending_date = $_SESSION['toursbooking']['fecha_salida'];
                    $tours->length_day = $_SESSION['toursbooking']['dias'];
                    $tours->length_nights = $_SESSION['toursbooking']['noches'];
                    $tours->adult = $_SESSION['toursbooking']['adults'];
                    $tours->child = $_SESSION['toursbooking']['childs'];
                    $tours->id_hotel_reserve = $id_hotel_reserves;
                    $tours->id_reserva = -1;
                    $tours->id_transfer_in = (isset($inTrans) ? $inTrans : "-1");
                    $tours->id_transfer_out = (isset($outTrans) ? $outTrans : "-1");
                    
                    $tours->comments = (isset($_SESSION['toursbooking']['comentarios'])) ? $_SESSION['toursbooking']['comentarios'] : '';
                    $tours->tipo_pago = $arkey[0];
                    $tours->pago = $arval[0];
                    $tours->total = $total;
                    $tours->totalouta = $total + $fee;
                    $tours->otheramount = $otheramount;
                    $tours->extra_charge = 0;
                    $tours->descuento_procentaje = 0;
                    $tours->descuento_valor = 0;
                    $tours->canal = 'WEBSALE';
                    $tours->estado = 'CONFIRMED';


                    Doo::db()->insert($tours) or die("Error Ingresando Datos de Tours");
                    $id_tours = Doo::db()->lastInsertId();

                    $hotel->id = $id_hotel_reserves;
                    $hotel->id_tours = $id_tours;
                    $hotel->update();
                    //Registramos pago y del tours
                    Doo::loadController('admin/ToursController');
                    $tours->id = $id_tours;
                    $login = $_SESSION['user'];
                    $login->tipo = 'AGENCY';
                    $toursControl = new ToursController();
                    $toursControl->registrar_pago($tours, NULL, $login);
                    $toursControl->rastro_tours('CREATE', NULL, $tours, $login);


                    $group = $_SESSION ['grupos'];
                    $group1 = $_SESSION ['grupos1'];


                    $i = 0;
                    Doo::loadModel("Attraction_Trafic");
                    Doo::loadModel('Parques');
                    $key = array_keys($group);
                    while ($i < count($key)) {
                        $grou = explode(',', $group1['park' . $key[$i]]);
                        $j = 0;
                        while ($j < count($grou)) {
                            if (isset($group1['ratesPark' . $key[$i] . '']) && trim($group1['ratesPark' . $key[$i] . '']) != '') {
                                $attraction = new Attraction_Trafic();
                                $attraction->admission = $_SESSION ['toursbooking'] ['ticketpark'];
                                $attraction->id_tours = $id_tours;
                                $attraction->type_tour = $type_tour;
                                $attraction->adult = $_SESSION['toursbooking']['adults'];
                                $attraction->child = $_SESSION['toursbooking']['childs'];
                                $attraction->group = $key[$i];
                                $attraction->creation_date = date("Y-m-d H:i");
                                $attraction->starting_date = $_SESSION['toursbooking']['fecha_llegada'];
                                $attraction->ending_date = $_SESSION['toursbooking']['fecha_salida'];
                                $attraction->id_agencia = $dat->id;
                                $attraction->id_cliente = $login->id;
                                $attraction->id_park = $grou[$j];
                                $attraction->trafic = 1;
                                $attraction->total_person = $_SESSION['toursbooking']['totalpax'];
                                if ($attraction->admission == 1) {
                                    $attraction->admission_child = $group1['parkChild' . $key[$i] . ''] * $_SESSION['toursbooking']['childs'] / $_SESSION ['grupos'] [$key[$i]];
                                    $attraction->admission_adtul = $group1['parkAdult' . $key[$i] . ''] * $_SESSION['toursbooking']['adults'] / $_SESSION ['grupos'] [$key[$i]];
                                    ;
                                } else {
                                    $attraction->admission_child = 0;
                                    $attraction->admission_adtul = 0;
                                }
                                $attraction->totalAdmission = $attraction->admission_child + $attraction->admission_adtul;
                                $attraction->totalTraspor = $group1['ratesPark' . $key[$i] . ''];
                                $attraction->total_paid = $attraction->totalTraspor + $attraction->totalAdmission;
                                Doo::db()->insert($attraction) or die("Error Ingresando Datos de Attractions");
                                if ($attraction->admission == 1) {
                                    $parque = new Parques();
                                    $parque->id = $attraction->id_park;
                                    $parque = Doo::db()->getOne($parque);
                                    $parque->stock = intval($parque->stock) - ($tours->child + $tours->adult);
                                    $parque->update();
                                }
                            }
                            $j++;
                        }
                        $i++;
                    }
                    if (($sarrival == 1) || ($sdeparture == 1)) {
                        $reserves = new Reserve();
                        $reserves->id_tours = $id_tours;
                        $reserves->type_tour = $type_tour;
                        $reserves->fecha_ini = date("Y-m-d");
                        $reserves->trip_no = (isset($_SESSION['toursbooking']['trip1']) ? $_SESSION['toursbooking']['trip1'] : "");
                        $reserves->trip_no2 = (isset($_SESSION['toursbooking']['trip2']) ? $_SESSION['toursbooking']['trip2'] : "");
                        $reserves->tipo_ticket = (($sarrival == 1) && ($sdeparture == 1)) ? "roundtrip" : "oneway";


                        $reserves->fromt = (isset($_SESSION['toursbooking']['id_from']) ? $_SESSION['toursbooking']['id_from'] : "");
                        $reserves->tot = (isset($_SESSION['toursbooking']['id_tot']) ? $_SESSION['toursbooking']['id_tot'] : "");
                        $reserves->fromt2 = (isset($_SESSION['toursbooking']['id_from2']) ? $_SESSION['toursbooking']['id_from2'] : "");
                        $reserves->tot2 = (isset($_SESSION['toursbooking']['id_tot2']) ? $_SESSION['toursbooking']['id_tot2'] : "");
                        $reserves->firsname = $cliente->firstname;
                        $reserves->lasname = $cliente->lastname;
                        $reserves->email = $cliente->username;
                        $reserves->deptime1 = (isset($_SESSION['toursbooking']['datedeparturetrip1']) ? $_SESSION['toursbooking']['datedeparturetrip1'] : "");
                        $reserves->deptime2 = (isset($_SESSION['toursbooking']['datedeparturetrip1']) ? $_SESSION['toursbooking']['datedeparturetrip2'] : "");
                        $reserves->arrtime1 = (isset($_SESSION['toursbooking']['datearrivingtrip1']) ? $_SESSION['toursbooking']['datearrivingtrip1'] : "");
                        $reserves->arrtime2 = (isset($_SESSION['toursbooking']['datearrivingtrip2']) ? $_SESSION['toursbooking']['datearrivingtrip2'] : "");
                        $reserves->precioA = (isset($_SESSION['toursbooking']['priceadults']) ? $_SESSION['toursbooking']['priceadults'] : "");
                        $reserves->precioN = (isset($_SESSION['toursbooking']['pricechilds']) ? $_SESSION['toursbooking']['pricechilds'] : "");
                        $reserves->extension1 = 0;
                        $reserves->precio_e1 = 0;
                        $reserves->pickup_exten1 = '';
                        $reserves->extension2 = 0;
                        $reserves->precio_e2 = 0;
                        $reserves->pickup_exten2 = '';
                        $reserves->extension3 = 0;
                        $reserves->precio_e3 = 0;
                        $reserves->pickup_exten3 = '';
                        $reserves->extension4 = 0;
                        $reserves->precio_e4 = 0;
                        $reserves->pickup_exten4 = '';
                        $reserves->fecha_salida = (isset($_SESSION['toursbooking']['fecha_llegada']) ? $_SESSION['toursbooking']['fecha_llegada'] : "");
                        $reserves->fecha_retorno = (isset($_SESSION['toursbooking']['fecha_salida']) ? $_SESSION['toursbooking']['fecha_salida'] : "");
                        $reserves->pax = $_SESSION['toursbooking']['adults'];
                        $reserves->pax2 = $_SESSION['toursbooking']['childs'];
                        $reserves->id_clientes = $cliente->id;

                        $reserves->dropoff1 = (isset($_SESSION['toursbooking']['id_pickup1']) ? $_SESSION['toursbooking']['id_pickup1'] : 0);
                        $reserves->pickup1 = (isset($_SESSION['toursbooking']['id_dropoff1']) ? $_SESSION['toursbooking']['id_dropoff1'] : 0);
                        $reserves->dropoff2 = (isset($_SESSION['toursbooking']['id_pickup2']) ? $_SESSION['toursbooking']['id_pickup2'] : 0);
                        $reserves->pickup2 = (isset($_SESSION['toursbooking']['id_dropoff2']) ? $_SESSION['toursbooking']['id_dropoff2'] : 0);
                        $reserves->tipo_pago = $arkey[0];
                        $reserves->pago = $arval[0];
                        $reserves->totaltotal = (isset($_SESSION['toursbooking']['trasport_total2']) ? $_SESSION['toursbooking']['trasport_total2'] : 0) + (isset($_SESSION['toursbooking']['trasport_total1']) ? $_SESSION['toursbooking']['trasport_total1'] : 0);
                        $reserves->otheramount = 0;
                        $reserves->extra_charge = 0;
                        $reserves->total2 = $reserves->totaltotal;
                        $reserves->codconf = $_SESSION['codconf'];
                        $reserves->hora = date("H:i:s");
                        $reserves->comments;
                        $reserves->resident = 0;
                        $reserves->agen = $user->id;
                        $reserves->tipo_client = $cliente->tipo_client;
                        $reserves->reward_id = 0;
                        $reserves->agency = $dat->id;
                        $reserves->luggage1 = -1;
                        $reserves->luggage2 = -1;
                        $reserves->canal = 'WEBSALE';
                        $reserves->estado = 'CONFIRMED';
                        Doo::db()->insert($reserves) or die("Error Ingresando Datos de Trasnporte Por Bus");
                        $id_reserva = Doo::db()->lastInsertId();
                        //Actualizamos tours
                        $tours->id = $id_tours;
                        $tours->id_reserva = $id_reserva;
                        Doo::db()->update($tours);
                        //Registramos pago y rastro
                        Doo::loadController('admin/ReservasController');
                        $reseControl = new ReservasController();
                        $reserves->id = $id_reserva;
                        $login = $_SESSION['user'];
                        $login->tipo = 'AGENCY';
                        $reseControl->registrar_pago($reserves, NULL, $login);
                        $reseControl->rastro_reserva('CREATE', NULL, $reserves, $login);
                    } else {
                        $id_reserva = -1;
                    }
                    Doo::loadModel("Tours_Agency");
                    $tours_reserv = new Tours_Agency();
                    $comision = $this->cal_equipament();
                    if (isset($_SESSION ['toursbooking']['comision_agency'])) {
                        $valorComision = $_SESSION ['toursbooking']['comision_agency'];
                    } else {
                        $valorComision = 0;
                    }
                    $tours_reserv->id_agency = $dat->id;
                    $tours_reserv->comision = $comision;
                    $tours_reserv->id_reserva = $id_reserva;
                    $tours_reserv->id_tours = $id_tours;
                    $tours_reserv->type_tour = $type_tour;
                    $tours_reserv->tipo_pago = $arkey[0];
                    $tours_reserv->pago = $arval[0];
                    $tours_reserv->type_rate = $dat->type_rate;
                    $tours_reserv->agency_fee = $valorComision;
                    $tours_reserv->total = $total;
                    $tours_reserv->otheramount = $otheramount;
                    $tours_reserv->totalouta = $totaltotal;
                    if (Doo::db()->insert($tours_reserv)) {
                        if ($pago == 5) {// Actualizamos el credio
                            
                            $creditos = Doo::db()->find("Acredito", array("where" => "id_agency_account = ? and disponible > 0", "param" => array($dat->id), "limit" => 1));
                            if (!empty($creditos)) {
                                $creditos->disponible = ($creditos->disponible - $total);
                                if (!Doo::db()->update($creditos)) {
                                    $this->view()->renderc('decline', $this->data);
                                }
                            }
                        }
                        $this->maillerCorreoAgencia();
                        $this->data['rootUrl'] = Doo::conf()->APP_URL;
                        $this->data['opcionPago'] = $pago;
                        $_SESSION['pagoListo'] = 'ok';
                        $this->view()->renderc('tours/approval', $this->data);
                        unset($_SESSION['toursbooking']);
                    } else {
                        $this->data['rootUrl'] = Doo::conf()->APP_URL;
                        $this->view()->renderc('tours/decline', $this->data);
                        unset($_SESSION['toursbooking']);
                    }
                }
            } else {
                return Doo::conf()->APP_URL . "agency/";
            }
        }
    }

    public function diasnoches() {
        $fecha_salida = $this->params ['fecharri'];
        $fecha_retorno = $this->params ['fechadepar'];
        list ($mes, $dia, $anyo) = explode("-", $fecha_salida);

        $llegada = $anyo . "-" . $mes . "-" . $dia;

        if (isset($fecha_retorno)) {
            list ($mes2, $dia2, $anyo2) = explode("-", $fecha_retorno);
            $salida = $anyo2 . "-" . $mes2 . "-" . $dia2;
        }

        $f0 = strtotime($llegada);
        $f1 = strtotime($salida);
        $resultado = ($f1 - $f0);
        $resultado = $resultado / 60 / 60 / 24;
        $resultado = round($resultado);
        $dias = ($resultado + 1 > 0) ? $resultado + 1 : '';
        $noches = ($resultado + 1 > 0) ? $dias - 1 : '';

        echo " <script>$('#dias').html('$dias');$('#noches').html('$noches');</script>
					 ";
    }

    public function arrival() {
        $fecha = $this->params ['fecha'];
        $tipo = $this->params ['tipo'];
        list ($mes, $dia, $anyo) = explode("-", $fecha);

        $fecha = $anyo . "-" . $mes . "-" . $dia;
        $_SESSION['formaviaje'] = $tipo;

        if ($tipo == 0) {

            echo "<script>$('#arrival0').html('Arrival Date: ');
	$('#arrival1').html('" . date('l', strtotime($fecha)) . "," . date('M', strtotime($fecha)) . " " . date('d', strtotime($fecha)) . ", " . date('Y', strtotime($fecha)) . "');
	$('#arrival2').html('Arriving: ');$('#arrival3').html('by SUPER TOURS BUS from Miami ');
	</script>";
        } elseif ($tipo == 1) {
            echo "<script>$('#departure0').html('Departure Date: ');
	$('#departure1').html('" . date('l', strtotime($fecha)) . "," . date('M', strtotime($fecha)) . " " . date('d', strtotime($fecha)) . ", " . date('Y', strtotime($fecha)) . "');
	$('#departure2').html('Departure: ');$('#departure3').html('by SUPER TOURS BUS to Miami ');
	</script>";
        } elseif ($tipo == 2) {
            echo "<script>$('#arrival0').html('Arrival Date: ');
	$('#arrival1').html('" . date('l', strtotime($fecha)) . "," . date('M', strtotime($fecha)) . " " . date('d', strtotime($fecha)) . ", " . date('Y', strtotime($fecha)) . "');
	$('#arrival2').html('Arriving: ');$('#arrival3').html('by Super Tours Vip ');
	</script>";
        } elseif ($tipo == 3) {

            echo "<script>$('#departure0').html('Departure Date: ');
	$('#departure1').html('" . date('l', strtotime($fecha)) . "," . date('M', strtotime($fecha)) . " " . date('d', strtotime($fecha)) . ", " . date('Y', strtotime($fecha)) . "');
	$('#departure2').html('Departure: ');$('#departure3').html('by Super Tours Vip ');
	</script>";
        } elseif ($tipo == 4) {

            echo "<script>$('#arrival0').html('Arrival Date: ');
	$('#arrival1').html('" . date('l', strtotime($fecha)) . "," . date('M', strtotime($fecha)) . " " . date('d', strtotime($fecha)) . ", " . date('Y', strtotime($fecha)) . "');
	$('#arrival2').html('Arriving: ');$('#arrival3').html('by Airport ');
	</script>";
        } elseif ($tipo == 5) {

            echo "<script>$('#departure0').html('Departure Date: ');
	$('#departure1').html('" . date('l', strtotime($fecha)) . "," . date('M', strtotime($fecha)) . " " . date('d', strtotime($fecha)) . ", " . date('Y', strtotime($fecha)) . "');
	$('#departure2').html('Departure: ');$('#departure3').html('by Airport ');
	</script>";
        } elseif ($tipo == 6) {

            echo "<script>$('#arrival0').html('Arrival Date: ');
	$('#arrival1').html('" . date('l', strtotime($fecha)) . "," . date('M', strtotime($fecha)) . " " . date('d', strtotime($fecha)) . ", " . date('Y', strtotime($fecha)) . "');
	$('#arrival2').html('Arriving: ');$('#arrival3').html('By Car');
	</script>";
        } elseif ($tipo == 7) {

            echo "<script>$('#departure0').html('Departure Date: ');
	$('#departure1').html('" . date('l', strtotime($fecha)) . "," . date('M', strtotime($fecha)) . " " . date('d', strtotime($fecha)) . ", " . date('Y', strtotime($fecha)) . "');
	$('#departure2').html('Departure: ');$('#departure3').html('By Car ');
	</script>";
        }
    }

    public function area() {

        if (isset($_SESSION['data_agency'])) {
            Doo::loadModel("Agency");
            $dat = new Agency($_SESSION['data_agency']);
        } else {
            Doo::loadModel("Agency");
            $dat = new Agency();
            $dat->id = -1;
        }
        //Tipo de pickup_dropoff;
        if ($dat->id == -1) {
            $type_web = 1;
        } else {
            $type_web = 0;
        }
        $id = $this->params ['id'];
        if (isset($this->params["trip_no"])) {
            $trip_no = $this->params["trip_no"];
            if ($trip_no % 2 == 0) {
                $sql = "SELECT DISTINCT t2.id as trip_to,
                                        t2.nombre
                        FROM routes t1
                        LEFT JOIN areas t2 ON (t1.trip_to = t2.id )
                        WHERE t1.type_rate = 0
                          AND t1.trip_from = 1
                          AND t1.trip_no = ?";
            } else {
                $sql = "SELECT DISTINCT t2.id as trip_to,
                                        t2.nombre
                        FROM routes t1
                        LEFT JOIN areas t2 ON (t1.trip_from = t2.id )
                        WHERE t1.type_rate = 0
                          AND t1.trip_to = 1
                          AND t1.trip_no = ?";
            }
            
        } else {
            $trip_no = 0;
        $sql = "SELECT DISTINCT t1.trip_to, t2.nombre  FROM routes t1
                LEFT JOIN areas t2 ON (t1.trip_to = t2.id)
                WHERE t1.type_rate = 0  and t1.trip_from = 1";
        }

//        $sql = "SELECT DISTINCT t1.trip_to, t2.nombre  FROM routes t1
//                LEFT JOIN areas t2 ON (t1.trip_to = t2.id)
//                WHERE t1.type_rate = 0  AND t1.trip_no = ?";
        /*  */
        $sql2 = "SELECT id,place,address FROM pickup_dropoff WHERE id_area = ? AND type_web = ? ORDER BY id ASC";
        if ($id == 0) {
            unset($_SESSION['areaSelect']);
        }
        if (isset($this->params["trip_no"])) {
            $rs = Doo::db()->query($sql, array($trip_no));
        } else {
        $rs = Doo::db()->query($sql);
        }
        $areas = $rs->fetchAll();
		
        $id_area_pick = (isset($_SESSION['areaSelect']) ? $_SESSION['areaSelect'] : 9);
        $rs2 = Doo::db()->query($sql2, array(
            $id_area_pick, $type_web
        ));
        $rs3 = Doo::db()->query($sql2, array(
            1, $type_web
        ));
        $pickupdropof = $rs2->fetchAll();

        $pikuporlando = $rs3->fetchAll();
        if ($id == 0) {
            unset($_SESSION['areaSelect']);
            echo '<script> $("#conte").css("display", "none");$("#pickups").css("display", "block"); </script>';
            echo "<table width='80%' border='0' cellspacing='1' aling='center'>
  <tr>
    <td width='20%'>Area:</td>
    <td width='20%'>";
            echo "<select name='area' id='area'>";
            foreach ($areas as $e) {
                echo '<option value="' . $e ['trip_to'] . '" ' . ($e ["trip_to"] == 9 ? 'selected' : '') . ' >' . $e ['nombre'] . '</option>';
            }
            echo "</select>";
            echo "</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>Pickup Point:</td>
    <td>";
            echo "<select name='pickup' id='pickup' style='width:195px;'>";
            foreach ($pickupdropof as $e) {
                echo '<option value="' . $e ['id'] . '"  >' . $e ['place'] . '  ' . $e ['address'] . '</option>';
            }

            echo "</select>";
            echo "</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <!--tr>
    <td>Drop Off Point: </td>
    <td>";

            // gropoff orlando
            echo "<select name='pickup' id='pickup' style='width:195px;'>";
            foreach ($pikuporlando as $e) {
                echo '<option value="' . $e ['id'] . '"  >' . $e ['place'] . '  ' . $e ['address'] . '</option>';
            }

            echo "</select>";
            echo "</td>
  </tr-->
</table>";
            echo "<div id='regreso'><a href='#' id='back'>Back to trip</a></div>";

            $url = Doo::conf()->APP_URL;

            echo '<script>
	
$("#area").change(function() {			

	var id = $(this).val();	 
	var idArea =  id;
	$("#area2").attr("value",id);
				
	$("#pickup").load("' . $url . 'tours/question15/" + id );
	$("#pickup2").load("' . $url . 'tours/question15/" + id );
	

			
});

	$("#pickup").change(function() {			
		var id = $(this).val();	  
		$("#pickup2").attr("value",id);
	});

$("#back").click(function() {


  $( ".trip1:radio").attr("checked", false);
  $("#pickups").css("display", "none");
  $("#conte").css("display", "block");

  return false;
   
});

</script>';
        } else {
            echo '<script>$("#conte2").css("display", "none");$("#pickups2").css("display", "block"); </script>';

            // ////////////

            echo "<table width='80%' border='0' cellspacing='1' aling='center'>
  <tr>
    <td width='20%'>Area:</td>
    <td width='20%'>";
            $idA1 = isset($_SESSION['areaSelect']) ? $_SESSION['areaSelect'] : 9;
            echo "<select name='area2' id='area2'>";
            foreach ($areas as $e) {
                if ($idA1 == $e ['trip_to']) {
                    $select = 'selected';
                } else {
                    $select = ' ';
                }
                echo '<option value="' . $e ['trip_to'] . '" ' . $select . ' >' . $e ['nombre'] . '</option>';
            }

            echo "</select>";
            echo "</td>
  </tr>
  <!--tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr-->
  <!--tr>
    <td>Pickup Point:</td>
    <td>";
            echo "<select name='pickup2' id='pickup' style='width:195px;'>";
            foreach ($pikuporlando as $e) {
                echo '<option value="' . $e ['id'] . '"  >' . $e ['place'] . '  ' . $e ['address'] . '</option>';
            }

            echo "</select>";
            echo "</td>
  </tr-->
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>Drop Off Point:</td>
    <td>";

            // gropoff area escogida
            echo "<select name='pickup2' id='pickup2' style='width:195px;'>";
            foreach ($pickupdropof as $e) {
                echo '<option value="' . $e ['id'] . '"  >' . $e ['place'] . '  ' . $e ['address'] . '</option>';
            }
            echo "</select>";
            echo "</td>
  </tr>
</table>";
            echo "<div id='regreso'><a href='#' id='back2'>Back to trip</a></div>";

            $url = Doo::conf()->APP_URL;
            echo '<script>
	
			$("#area2").change(function() {
			
			    var id = $(this).val();
			   $("#pickup2").load("' . $url . 'tours/question15/" + id );
			
			});

$("#back2").click(function() {
  $(".trip2:radio").attr("checked", false); 
  $("#pickups2").css("display", "none");
  $("#conte2").css("display", "block");

  return false;
  
});
</script>';
        }
    }

    public function idArea() {
        // $id = $this->params ['id'];	
        // $sql = "SELECT id,nombre FROM programacion
        // WHERE id = ?";
        // $rs = Doo::db()->query($sql, array(
        // $id
        // ));
        // $pickupdropof = $rs->fetchAll();
        // foreach ($pickupdropof as $e) {
        // }
    }

    public function exten() {
        $id = $this->params ['id'];
        if (isset($this->params ['num'])) {
            $num = $this->params ['num'];
        } else {
            $num = '';
        }
        if (isset($_SESSION['data_agency'])) {
            Doo::loadModel("Agency");
            $dat = new Agency($_SESSION['data_agency']);
        } else {
            Doo::loadModel("Agency");
            $dat = new Agency();
            $dat->id = -1;
        }
        //Tipo de pickup_dropoff;
        if ($dat->id == -1) {
            $type_web = 1;
        } else {
            $type_web = 0;
        }
        $sql = "SELECT id,place,address FROM pickup_dropoff
           WHERE id_area = ? AND type_web = ? ORDER BY id ASC";
        if ($num == '') {
            $_SESSION['areaSelect'] = $id;
        }
        $rs = Doo::db()->query($sql, array(
            $id, $type_web
        ));
        $pickupdropof = $rs->fetchAll();
        echo "<select name='pickup" . $num . "' id='pickup" . $num . "' style='width:195px;'>";
        foreach ($pickupdropof as $e) {
            echo '<option value="' . $e ['id'] . '"  >' . $e ['place'] . '  ' . $e ['address'] . '</option>';
        }
        echo "</select>";
    }

    public function comentarioHotelOcupado() {
        //Validando si el hotel esta disponible
        $toursbooking = $_SESSION['toursbooking'];
        $fecha_llegada = strtotime($toursbooking ['fecha_llegada']);
        $fecha_salida = strtotime($toursbooking ['fecha_salida']);
        $valornoche = $toursbooking['totalhotel'] / $toursbooking['noches'];
        $hotel = $toursbooking['id_hotel'];
        $sqlHotel = "SELECT hoteles.id,codigo,categoria,nombre,address,city,zipcode,contacname,phone,email,webpage,breakfast,resoftfe,description,image1,ratesblock.fecha_ini,ratesblock.fecha_fin
					        FROM hoteles INNER JOIN ratesblock 
						ON (hoteles.id = ratesblock.id_hotel and ((ratesblock.fecha_ini BETWEEN $fecha_llegada AND $fecha_salida) OR (ratesblock.fecha_fin BETWEEN $fecha_llegada AND $fecha_salida)
                                                OR (($fecha_llegada BETWEEN ratesblock.fecha_ini AND ratesblock.fecha_fin ) OR ($fecha_salida BETWEEN ratesblock.fecha_ini AND ratesblock.fecha_fin ))     
                                                )
						AND hoteles.id = " . $hotel . ")";

        $rs1 = Doo::db()->query($sqlHotel) or die('error');

        $valdHotel = $rs1->fetch();
        if (!empty($valdHotel)) {
            $comments = 'For this client must book a hotel similar to ' . $valdHotel['nombre'] . ' of category ' . $valdHotel['categoria'] . ', ' . date('M-d-y', $fecha_llegada) . ' to ' . date('M-d-y', $fecha_salida) . ' by the cost of $ ' . number_format($valornoche, 2, '.', '.') . ' for day.';
            $_SESSION['toursbooking']['comments'] = $comments;
        } else {
            $_SESSION['toursbooking']['comments'] = '';
        }
        //FIN Validacion Hotel
    }

    public function hotelajax() {
        extract($_POST, EXTR_SKIP);
        Doo::loadModel("Agency");
        if (isset($_SESSION['data_agency'])) {
            $dat = new Agency($_SESSION['data_agency']);
            $net_rate = ($dat->type_rate == 1) ? true : false;
        } else {
            $dat = new Agency();
            $net_rate = false;
            $dat->type_rate = 0;
            $dat->id = -1;
        }
        //print_r($_POST);

        $this->seguridad();
        $fecha = new DateTime();
        $fecha_fin = new DateTime();
        $toursbooking = $_SESSION ["toursbooking"];
        $fecha->setTimestamp(strtotime($toursbooking ['fecha_llegada']));

        $fecha2 = new DateTime();
        $fecha2->setTimestamp(strtotime($toursbooking ['fecha_llegada']));

        $fecha3 = new DateTime();
        $fecha3->setTimestamp(strtotime($toursbooking ['fecha_llegada']));

        $fecha4 = new DateTime();
        $fecha4->setTimestamp(strtotime($toursbooking ['fecha_llegada']));

        $fecha_fin->setTimestamp(strtotime($toursbooking ['fecha_salida']));
        $tohotel = 0;
        $totaladult = $adult1 + $adult2 + $adult3 + $adult4;
        $totalchild = $child1 + $child2 + $child3 + $child4;
        $totalpax = $totaladult + $totalchild;
        $desayuno = 0;
        $totalhotel1 = 0;
        $totalhotel2 = 0;
        $totalhotel3 = 0;
        $totalhotel4 = 0;
        //Validamos la capacidad de los trip
        Doo::loadController('MainController');
        $main = new MainController();
        $valCapacidad = true;
        if (isset($toursbooking['trip1']) && isset($toursbooking['trip2'])) {
            $disponible1 = $main->disponible($toursbooking['trip1'], $toursbooking['fecha_llegada']);
            $disponible2 = $main->disponible($toursbooking['trip2'], $toursbooking['fecha_salida']);
            if ($disponible1 < $totalpax) {
                $txtC = 'Total passenger traffic <strong>(' . $totalpax . ')</strong> exceeds available seats <strong>(' . $disponible1 . ')</strong> of the trip output  <strong>' . $toursbooking['trip1'] . '</strong> for the <strong>' . date('M-d-Y', strtotime($toursbooking['fecha_llegada'])) . '</strong>';
                $valCapacidad = false;
            } else if ($disponible2 < $totalpax) {
                $txtC = 'Total passenger traffic <strong>(' . $totalpax . ')</strong> exceeds available seats <strong>(' . $disponible2 . ')</strong> of the trip output  <strong>' . $toursbooking['trip2'] . '</strong> for the <strong>' . date('M-d-Y', strtotime($toursbooking['fecha_salida'])) . '</strong>';
                $valCapacidad = false;
            }
        } else if (isset($toursbooking['trip1'])) {
            $disponible1 = $main->disponible($toursbooking['trip1'], $toursbooking['fecha_llegada']);
            if ($disponible1 < $totalpax) {
                $txtC = 'Total passenger traffic <strong>(' . $totalpax . ')</strong> exceeds available seats <strong>(' . $disponible1 . ')</strong> of the trip output  <strong>' . $toursbooking['trip1'] . '</strong> for the <strong>' . date('M-d-Y', strtotime($toursbooking['fecha_llegada'])) . '</strong>';
                $valCapacidad = false;
            }
        } else if (isset($toursbooking['trip2'])) {
            $disponible2 = $main->disponible($toursbooking['trip2'], $toursbooking['fecha_salida']);
            if ($disponible2 < $totalpax) {
                $txtC = 'Total passenger traffic <strong>(' . $totalpax . ')</strong> exceeds available seats <strong>(' . $disponible2 . ')</strong> of the trip output  <strong>' . $toursbooking['trip2'] . '</strong> for the <strong>' . date('M-d-Y', strtotime($toursbooking['fecha_salida'])) . '</strong>';
                $valCapacidad = false;
            }
        }
        if (isset($toursbooking ['sarrival'])) {
            if ($toursbooking ['sarrival'] == 2) {
                if ($totalpax > 14) {
                    $txtC = 'Total passenger traffic <strong>(' . $totalpax . ')</strong> exceeds available seats <strong>(14)</strong> of the trip output  <strong>' . $toursbooking['trip2'] . '</strong> for the <strong>' . date('M-d-Y', strtotime($toursbooking['fecha_salida'])) . '</strong>';
                    $valCapacidad = false;
                }
            } else if ($toursbooking ['sarrival'] == 3) {
                if ($totalpax > 14) {
                    $txtC = 'Total passenger traffic <strong>(' . $totalpax . ')</strong> exceeds available seats <strong>(14)</strong> of the trip output  <strong>' . $toursbooking['trip2'] . '</strong> for the <strong>' . date('M-d-Y', strtotime($toursbooking['fecha_salida'])) . '</strong>';
                    $valCapacidad = false;
                }
            }
        }
        if (isset($toursbooking ['sdeparture'])) {
            if ($toursbooking ['sdeparture'] == 2) {
                if ($totalpax > 14) {
                    $txtC = 'Total passenger traffic <strong>(' . $totalpax . ')</strong> exceeds available seats <strong>(14)</strong> of the trip output  <strong>' . $toursbooking['trip2'] . '</strong> for the <strong>' . date('M-d-Y', strtotime($toursbooking['fecha_salida'])) . '</strong>';
                    $valCapacidad = false;
                }
            } else if ($toursbooking ['sdeparture'] == 3) {
                if ($totalpax > 14) {
                    $txtC = 'Total passenger traffic <strong>(' . $totalpax . ')</strong> exceeds available seats <strong>(14)</strong> of the trip output  <strong>' . $toursbooking['trip2'] . '</strong> for the <strong>' . date('M-d-Y', strtotime($toursbooking['fecha_salida'])) . '</strong>';
                    $valCapacidad = false;
                }
            }
        }

        if (!$valCapacidad) {
            echo '<script>
				function quitarSelecionHotel(){
				 num = $(".btns").length;
				 for(var i = 0; i<num; i++){
					 if($(".btns").get(i).checked){
						 var id = $(".btns").get(i).id
						 var label = "label:[for="+$("#"+id).attr("id")+"]";
						 $(label).removeClass("ui-state-active");
						 $(label).find("span").html("ADD TO TOUR");
						 $(".clean").html("");
					 }
				 }
			 }
			$("#capacidad").dialog({
					modal: true,
					width: 400,
					resizable: false,
					buttons: {
						Ok: function() {
							$( this ).dialog( "close" );
						}
					}
			});
			$("#txtCapacidad").html("' . $txtC . '");	
			quitarSelecionHotel();
			</script>';
            return;
        }

        $_SESSION ["toursbooking"]['adult_r1'] = $adult1;
        $_SESSION ["toursbooking"]['adult_r2'] = $adult2;
        $_SESSION ["toursbooking"]['adult_r3'] = $adult3;
        $_SESSION ["toursbooking"]['adult_r4'] = $adult4;
        $_SESSION ["toursbooking"]['child_r1'] = $child1;
        $_SESSION ["toursbooking"]['child_r2'] = $child2;
        $_SESSION ["toursbooking"]['child_r3'] = $child3;
        $_SESSION ["toursbooking"]['child_r4'] = $child4;
        $_SESSION ["toursbooking"]['id_hotel'] = $hotel;
        $toursbooking = $_SESSION ["toursbooking"];



        /* print_r(Doo::db()->showSQL());
          exit; */
        $desayuno1 = 0;
        $desayuno2 = 0;
        $desayuno3 = 0;
        $desayuno4 = 0;
        if (isset($adult1)) {
            while ($fecha->format("Y-m-d") < $fecha_fin->format("Y-m-d")) {

                //$fec = strtotime($toursbooking ['fecha_llegada']);//$fecha->getTimestamp();
                $fec = $fecha->getTimestamp();
                if ($dat->type_rate == 0) {

                    $sql = 'SELECT t1.id,t1.breakfast,t1.super_breakfast, t1.resoftfe,t1.nombre,t3.sgl,t3.dbl,t3.tpl,t3.qua,t3.breackfast, t1.categoria
			 		FROM hoteles t1	
						LEFT JOIN comifijas t3 ON (t1.id = t3.id_hotel 
								AND t3.comtax = 1 
								AND t3.fecha_ini <= ' . $fec . ' 
								AND t3.fecha_fin  >= ' . $fec . ')
					WHERE t3.id_hotel  = ' . $hotel . '';
                } else {
                    $sql = 'SELECT t1.id,t1.breakfast,t1.super_breakfast ,t1.resoftfe,t1.nombre,t3.sgl,t3.dbl,t3.tpl,t3.qua,t3.breackfast, t1.categoria
			 		FROM hoteles t1	
						LEFT JOIN comifijas t3 ON (t1.id = t3.id_hotel 
								AND t3.netax = 1 
								AND t3.fecha_ini <= ' . $fec . ' 
								AND t3.fecha_fin  >= ' . $fec . ')
				    	WHERE t3.id_hotel  = ' . $hotel . '';
                }
                $rs = Doo::db()->query($sql);
                $costohotel = $rs->fetch();
                if (empty($costohotel)) {
                    echo ' <script>$("input[type=\'checkbox\'").attr("checked",false).change();
                            $( "#dialog-message-t" ).dialog({
                                modal: true,
                                buttons: {
                                    Ok: function() {
                                        $( this ).dialog( "close" );
                                    }
                                }
                            });</script>
                     ';
                    exit;
                }
                if ($adult1 == 1) {
                    $totalhotel1v += $costohotel ['sgl'];
                }
                if ($adult1 == 2) {
                    $totalhotel1v += $costohotel ['dbl'];
                }
                if ($adult1 == 3) {
                    $totalhotel1v += $costohotel ['tpl'];
                }
                if ($adult1 == 4) {
                    $totalhotel1v += $costohotel ['qua'];
                }
                if ($costohotel['super_breakfast'] == 1) {
                    $desayuno1 += ($costohotel ['breackfast']);
                } else {
                    $desayuno1 += 0;
                    $breakfast = 0;
                }

                date_add($fecha, date_interval_create_from_date_string('1 days'));
            }

            $totalhotel1 = (ceil($totalhotel1v) * $adult1);
            $desayuno1 = $desayuno1 * $adult1;
            
        } else {
            $totalhotel1 = 0;
        }
//        print_r(ceil($totalhotel1v));
        
//        print_r(Doo::db()->showSQL());
//        exit;
        // /room # 2
        if (isset($adult2)) {

            while ($fecha2->format("Y-m-d") < $fecha_fin->format("Y-m-d")) {

                //$fec = strtotime($toursbooking ['fecha_llegada']);//$fecha->getTimestamp();
                $fec = $fecha2->getTimestamp();
                if ($dat->type_rate == 0) {

                    $sql = 'SELECT t1.id,t1.breakfast,t1.super_breakfast, t1.resoftfe,t1.nombre,t3.sgl,t3.dbl,t3.tpl,t3.qua,t3.breackfast, t1.categoria
			 		FROM hoteles t1	
						LEFT JOIN comifijas t3 ON (t1.id = t3.id_hotel 
								AND t3.comtax = 1 
								AND t3.fecha_ini <= ' . $fec . ' 
								AND t3.fecha_fin  >= ' . $fec . ')
					WHERE t3.id_hotel  = ' . $hotel . '';
                } else {
                    $sql = 'SELECT t1.id,t1.breakfast,t1.super_breakfast ,t1.resoftfe,t1.nombre,t3.sgl,t3.dbl,t3.tpl,t3.qua,t3.breackfast, t1.categoria
			 		FROM hoteles t1	
						LEFT JOIN comifijas t3 ON (t1.id = t3.id_hotel 
								AND t3.netax = 1 
								AND t3.fecha_ini <= ' . $fec . ' 
								AND t3.fecha_fin  >= ' . $fec . ')
				    	WHERE t3.id_hotel  = ' . $hotel . '';
                }
                $rs = Doo::db()->query($sql);
                $costohotel = $rs->fetch();
                if (empty($costohotel)) {
                    echo ' <script>$("input[type=\'checkbox\'").attr("checked",false).change();
                            $( "#dialog-message-t" ).dialog({
                                modal: true,
                                buttons: {
                                    Ok: function() {
                                        $( this ).dialog( "close" );
                                    }
                                }
                            });</script>
                     ';
                    exit;
                }

                if ($adult2 == 1) {

                    $totalhotel2v += $costohotel ['sgl'];
                }
                if ($adult2 == 2) {

                    $totalhotel2v += $costohotel ['dbl'];
                }
                if ($adult2 == 3) {

                    $totalhotel2v += $costohotel ['tpl'];
                }
                if ($adult2 == 4) {

                    $totalhotel2v += $costohotel ['qua'];
                }
                if ($adult2 == 0) {

                    $totalhotel2v = 0;
                }
                if (($costohotel['super_breakfast'] == 1)) {
                        $desayuno2 += ($costohotel ['breackfast'] );
                    } else {
                        $desayuno2 += 0;
                        $breakfast = 0;
                    }
                date_add($fecha2, date_interval_create_from_date_string('1 days'));
            }

            $totalhotel2 = ceil($totalhotel2v) * $adult2;
            $desayuno2 = $desayuno2 * $adult2;
        } else {
            $totalhotel2 = 0;
        }
        // /room # 3
        if (isset($adult3)) {
            while ($fecha3->format("Y-m-d") < $fecha_fin->format("Y-m-d")) {

                //$fec = strtotime($toursbooking ['fecha_llegada']);//$fecha->getTimestamp();
                $fec = $fecha3->getTimestamp();
                if ($dat->type_rate == 0) {

                    $sql = 'SELECT t1.id,t1.breakfast,t1.super_breakfast, t1.resoftfe,t1.nombre,t3.sgl,t3.dbl,t3.tpl,t3.qua,t3.breackfast, t1.categoria
			 		FROM hoteles t1	
						LEFT JOIN comifijas t3 ON (t1.id = t3.id_hotel 
								AND t3.comtax = 1 
								AND t3.fecha_ini <= ' . $fec . ' 
								AND t3.fecha_fin  >= ' . $fec . ')
					WHERE t3.id_hotel  = ' . $hotel . '';
                } else {
                    $sql = 'SELECT t1.id,t1.breakfast,t1.super_breakfast ,t1.resoftfe,t1.nombre,t3.sgl,t3.dbl,t3.tpl,t3.qua,t3.breackfast, t1.categoria
			 		FROM hoteles t1	
						LEFT JOIN comifijas t3 ON (t1.id = t3.id_hotel 
								AND t3.netax = 1 
								AND t3.fecha_ini <= ' . $fec . ' 
								AND t3.fecha_fin  >= ' . $fec . ')
				    	WHERE t3.id_hotel  = ' . $hotel . '';
                }
                $rs = Doo::db()->query($sql);
                $costohotel = $rs->fetch();
                if (empty($costohotel)) {
                    echo ' <script>$("input[type=\'checkbox\'").attr("checked",false).change();
                            $( "#dialog-message-t" ).dialog({
                                modal: true,
                                buttons: {
                                    Ok: function() {
                                        $( this ).dialog( "close" );
                                    }
                                }
                            });</script>
                     ';
                    exit;
                }

                if ($adult3 == 1) {

                    $totalhotel3v += $costohotel ['sgl'];
                }
                if ($adult3 == 2) {

                    $totalhotel3v += $costohotel ['dbl'];
                }
                if ($adult3 == 3) {

                    $totalhotel3v += $costohotel ['tpl'];
                }
                if ($adult3 == 4) {

                    $totalhotel3v += $costohotel ['qua'];
                }
                if ($adult3 == 0) {

                    $totalhotel3v = 0;
                }
                if (($costohotel['super_breakfast'] == 1)) {
                        $desayuno3 += ($costohotel ['breackfast'] );
                    } else {
                        $desayuno3 += 0;
                        $breakfast = 0;
                    }
                date_add($fecha3, date_interval_create_from_date_string('1 days'));
            }
            $totalhotel3 = (ceil($totalhotel3v) * $adult3);
            $desayuno3 = $desayuno3 * $adult3;
        } else {
            $totalhotel3 = 0;
        }
        
        // /room # 4
        if (isset($adult4)) {
            while ($fecha4->format("Y-m-d") < $fecha_fin->format("Y-m-d")) {

                //$fec = strtotime($toursbooking ['fecha_llegada']);//$fecha->getTimestamp();
                $fec = $fecha4->getTimestamp();
                if ($dat->type_rate == 0) {

                    $sql = 'SELECT t1.id,t1.breakfast,t1.super_breakfast, t1.resoftfe,t1.nombre,t3.sgl,t3.dbl,t3.tpl,t3.qua,t3.breackfast, t1.categoria
			 		FROM hoteles t1	
						LEFT JOIN comifijas t3 ON (t1.id = t3.id_hotel 
								AND t3.comtax = 1 
								AND t3.fecha_ini <= ' . $fec . ' 
								AND t3.fecha_fin  >= ' . $fec . ')
					WHERE t3.id_hotel  = ' . $hotel . '';
                } else {
                    $sql = 'SELECT t1.id,t1.breakfast,t1.super_breakfast ,t1.resoftfe,t1.nombre,t3.sgl,t3.dbl,t3.tpl,t3.qua,t3.breackfast, t1.categoria
			 		FROM hoteles t1	
						LEFT JOIN comifijas t3 ON (t1.id = t3.id_hotel 
								AND t3.netax = 1 
								AND t3.fecha_ini <= ' . $fec . ' 
								AND t3.fecha_fin  >= ' . $fec . ')
				    	WHERE t3.id_hotel  = ' . $hotel . '';
                }
                $rs = Doo::db()->query($sql);
                $costohotel = $rs->fetch();
                if (empty($costohotel)) {
                    echo ' <script>$("input[type=\'checkbox\'").attr("checked",false).change();
                            $( "#dialog-message-t" ).dialog({
                                modal: true,
                                buttons: {
                                    Ok: function() {
                                        $( this ).dialog( "close" );
                                    }
                                }
                            });</script>
                     ';
                    exit;
                }
                if ($adult4 == 1) {

                    $totalhotel4v += $costohotel ['sgl'];
                }
                if ($adult4 == 2) {

                    $totalhotel4v += $costohotel ['dbl'];
                }
                if ($adult4 == 3) {

                    $totalhotel4v += $costohotel ['tpl'];
                }
                if ($adult4 == 4) {

                    $totalhotel4v += $costohotel ['qua'];
                }
                if ($adult4 == 0) {

                    $totalhotel4v = 0;
                }
                if ($costohotel ['breakfast'] == 0 && ($costohotel['super_breakfast'] == 1)) {
                        $desayuno4 += ($costohotel ['breackfast'] );
                    } else {
                        $desayuno4 += 0;
                        $breakfast = 0;
                    }
                date_add($fecha4, date_interval_create_from_date_string('1 days'));
            }
            $totalhotel4 = (ceil($totalhotel4v) * $adult4);
            $desayuno4 = $desayuno4 * $adult4;
        } else {
            $totalhotel4 = 0;
        }

        $desayuno = $desayuno1 + $desayuno2 + $desayuno3 + $desayuno4;

        

        //Todavia no se le suma el desayuno
        //$tohotel = $totalhotel1 + $totalhotel2 + $totalhotel3 + $totalhotel4+$desayuno;
        $tohotel = $totalhotel1 + $totalhotel2 + $totalhotel3 + $totalhotel4;


        $_SESSION['toursbooking']['trasport_total1'] = 0;
        $_SESSION['toursbooking']['trasport_total2'] = 0;


        #nuevas variables
        $_SESSION['toursbooking']['trasport_por_adult'] = 0;
        $_SESSION['toursbooking']['trasport_por_child'] = 0;

        if (isset($toursbooking ['trip1'])) {
            Doo::loadController('admin/ToursController');
            $toursOperador = new ToursController();
            $anio = substr($toursbooking['fecha_llegada'], 0, 4);

            $prices = $toursOperador->precioTripTours($toursbooking ['trip1'], $dat->type_rate, $dat->id, $anio);

            if (!empty($prices)) {
                $priceadult1 = $prices ['adult'] * $totaladult;
                $pricechild1 = $prices ['child'] * $totalchild;
                $trip1 = number_format($priceadult1, 2, '.', '') + number_format($pricechild1, 2, '.', '');
                $_SESSION['toursbooking']['trasport_total1'] = $trip1;
                $_SESSION['toursbooking']['trasport_por_adult'] = $priceadult1;
                $_SESSION['toursbooking']['trasport_por_child'] = $pricechild1;
            } else {
                $trip1 = 0;
                $priceadult1 = 0;
                $pricechild1 = 0;
            }
        } else {
            $trip1 = 0;
            $priceadult1 = 0;
            $pricechild1 = 0;
        }
        if (isset($toursbooking ['trip2'])) {
            Doo::loadController('admin/ToursController');
            $toursOperador = new ToursController();
            $anio = substr($toursbooking['fecha_salida'], 0, 4);
            $prices = $toursOperador->precioTripTours($toursbooking ['trip2'], $dat->type_rate, $dat->id, $anio);
            if (!empty($prices)) {
                $priceadult2 = $prices ['adult'] * $totaladult;
                $pricechild2 = $prices ['child'] * $totalchild;
                $trip2 = number_format($pricechild2, 2, '.', '') + number_format($priceadult2, 2, '.', '');
                $_SESSION['toursbooking']['trasport_total2'] = $trip2;

                $_SESSION['toursbooking']['trasport_por_adult'] = $_SESSION['toursbooking']['trasport_por_adult'] + $priceadult2;
                $_SESSION['toursbooking']['trasport_por_child'] = $_SESSION['toursbooking']['trasport_por_child'] + $pricechild2;
            } else {
                $trip2 = 0;
                $priceadult2 = 0;
                $pricechild2 = 0;
            }
        } else {
            $trip2 = 0;
            $priceadult2 = 0;
            $pricechild2 = 0;
        }

        /* echo json_encode($_SESSION['toursbooking']);
          exit; */

        if ($toursbooking ['sarrival'] == 2) {
            $fechal = substr($toursbooking['fecha_llegada'], 0, 4) . '-01-01 00:00:00';
            if ($dat->type_rate == 1) {// Se busca SpecialNet
                $sql = 'SELECT id,cantidad,price
				FROM tarifasvip 
				WHERE cantidad = ? 
					AND (type_rate = ? )
					AND (id_agency = ? or id_agency = -1 )
					AND annio = ?
				ORDER BY type_rate Desc LIMIT 1';
                $type = 2;
                $rs = Doo::db()->query($sql, array($totalpax, $type, $dat->id, $fechal));
                $pricesvip = $rs->fetch();

                if (empty($pricesvip)) {//Si no encuentra Buscamos Net.
                    $sql = 'SELECT id,cantidad,price
				FROM tarifasvip 
				WHERE cantidad = ? 
					AND (type_rate = ? )
					AND (id_agency = ? or id_agency = -1 )
					AND annio = ?
				ORDER BY type_rate Desc LIMIT 1';
                    $type = 1;
                    $rs = Doo::db()->query($sql, array($totalpax, $type, $dat->id, $fechal));
                    $pricesvip = $rs->fetch();
                }
            } else {
                $sql = 'SELECT id,cantidad,price
				FROM tarifasvip 
				WHERE cantidad = ? 
					AND (type_rate = ? )
					AND (id_agency = ? or id_agency = -1 )
					AND annio = ?
				ORDER BY type_rate Desc LIMIT 1';
                $rs = Doo::db()->query($sql, array($totalpax, $dat->type_rate, $dat->id, $fechal));
                $pricesvip = $rs->fetch();
            }

            if (!empty($pricesvip)) {
                $vip1 = number_format($pricesvip ['price'], 2, '.', '');
                $_SESSION['toursbooking']['trasport_total1'] = $vip1;
            }
        } else {
            $vip1 = 0;
        }

        if ($toursbooking ['sdeparture'] == 2) {
            $fechas = substr($toursbooking['fecha_salida'], 0, 4) . '-01-01 00:00:00';
            if ($dat->type_rate == 1) {// Se busca SpecialNet
                $sql = 'SELECT id,cantidad,price
				FROM tarifasvip 
				WHERE cantidad = ? 
					AND (type_rate = ? )
					AND (id_agency = ? or id_agency = -1 )
					AND annio = ?
				ORDER BY type_rate Desc LIMIT 1';
                $type = 2;
                $rs = Doo::db()->query($sql, array($totalpax, $type, $dat->id, $fechas));
                $pricesvip = $rs->fetch();

                if (empty($pricesvip)) {//Si no encuentra Buscamos Net.
                    $sql = 'SELECT id,cantidad,price
				FROM tarifasvip 
				WHERE cantidad = ? 
					AND (type_rate = ? )
					AND (id_agency = ? or id_agency = -1 )
					AND annio = ?
				ORDER BY type_rate Desc LIMIT 1';
                    $type = 1;
                    $rs = Doo::db()->query($sql, array($totalpax, $type, $dat->id, $fechas));
                    $pricesvip = $rs->fetch();
                }
            } else {
                $sql = 'SELECT id,cantidad,price
				FROM tarifasvip 
				WHERE cantidad = ? 
					AND (type_rate = ? )
					AND (id_agency = ? or id_agency = -1 )
					AND annio = ?
				ORDER BY type_rate Desc LIMIT 1';
                $rs = Doo::db()->query($sql, array($totalpax, $dat->type_rate, $dat->id, $fechas));
                $pricesvip = $rs->fetch();
            }

            if (!empty($pricesvip)) {
                $vip2 = number_format($pricesvip ['price'], 2, '.', '');
                $_SESSION['toursbooking']['trasport_total2'] = $vip2;
            }
        } else {
            $vip2 = 0;
        }

        /* if prices transfer in airport */
        if ($toursbooking ['sarrival'] == 3) {
            $fechal = substr($toursbooking['fecha_llegada'], 0, 4) . '-01-01 00:00:00';
            if ($dat->type_rate == 1) {// Se busca SpecialNet
                $sql = 'SELECT id,cantidad,price
				FROM tarifaplane 
				WHERE cantidad = ? 
					AND (type_rate = ? )
					AND (id_agency = ? or id_agency = -1 ) 
                                        AND annio = ?
				ORDER BY type_rate Desc LIMIT 1';
                $type = 2;
                $rs = Doo::db()->query($sql, array($totalpax, $type, $dat->id, $fechal));
                $pricesbyplane = $rs->fetch();

                if (empty($pricesbyplane)) {//Si no encuentra Buscamos Net.
                    $sql = 'SELECT id,cantidad,price
				FROM tarifaplane 
				WHERE cantidad = ? 
					AND (type_rate = ? )
					AND (id_agency = ? or id_agency = -1 ) 
                                        AND annio = ?
				ORDER BY type_rate Desc LIMIT 1';
                    $type = 1;
                    $rs = Doo::db()->query($sql, array($totalpax, $type, $dat->id, $fechal));
                    $pricesbyplane = $rs->fetch();
                }
            } else {
                $sql = 'SELECT id,cantidad,price
				FROM tarifaplane 
				WHERE cantidad = ? 
					AND (type_rate = ? )
					AND (id_agency = ? or id_agency = -1 ) 
                                        AND annio = ?
				ORDER BY type_rate Desc LIMIT 1';
                $rs = Doo::db()->query($sql, array($totalpax, $dat->type_rate, $dat->id, $fechal));
                $pricesbyplane = $rs->fetch();
            }

            if (!empty($pricesbyplane)) {
                $byplane1 = number_format($pricesbyplane ['price'], 2, '.', '');
                $_SESSION['toursbooking']['trasport_total1'] = $byplane1;
            }
        } else {
            $byplane1 = 0;
        }

        if ($toursbooking ['sdeparture'] == 3) {
            $fechas = substr($toursbooking['fecha_salida'], 0, 4) . '-01-01 00:00:00';
            if ($dat->type_rate == 1) {// Se busca SpecialNet
                $sql = 'SELECT id,cantidad,price
				FROM tarifaplane 
				WHERE cantidad = ? 
					AND (type_rate = ? )
					AND (id_agency = ? or id_agency = -1 ) 
                                        AND annio = ?
				ORDER BY type_rate Desc LIMIT 1';
                $type = 2;
                $rs = Doo::db()->query($sql, array($totalpax, $type, $dat->id, $fechas));
                $pricesbyplane = $rs->fetch();

                if (empty($pricesbyplane)) {//Si no encuentra Buscamos Net.
                    $sql = 'SELECT id,cantidad,price
				FROM tarifaplane 
				WHERE cantidad = ? 
					AND (type_rate = ? )
					AND (id_agency = ? or id_agency = -1 ) 
                                        AND annio = ?
				ORDER BY type_rate Desc LIMIT 1';
                    $type = 1;
                    $rs = Doo::db()->query($sql, array($totalpax, $type, $dat->id, $fechas));
                    $pricesbyplane = $rs->fetch();
                }
            } else {
                $sql = 'SELECT id,cantidad,price
				FROM tarifaplane 
				WHERE cantidad = ? 
					AND (type_rate = ? )
					AND (id_agency = ? or id_agency = -1 ) 
                                        AND annio = ?
				ORDER BY type_rate Desc LIMIT 1';
                $rs = Doo::db()->query($sql, array($totalpax, $dat->type_rate, $dat->id, $fechas));
                $pricesbyplane = $rs->fetch();
            }

            if (!empty($pricesbyplane)) {
                $byplane2 = number_format($pricesbyplane ['price'], 2, '.', '');
                $_SESSION['toursbooking']['trasport_total2'] = $byplane2;
            }
        } else {
            $byplane2 = 0;
        }

        /* if prices by car */

        if ($toursbooking ['sarrival'] == 4) {

            $fechal = substr($toursbooking['fecha_llegada'], 0, 4) . '-01-01 00:00:00';
            if ($dat->type_rate == 1) {// Se busca SpecialNet
                $sql = 'SELECT id,price
				FROM tarifacar 
				WHERE (type_rate = ? )
					AND (id_agency = ? or id_agency = -1 )
					AND annio = ?
				ORDER BY type_rate Desc LIMIT 1';
                $type = 2;
                $rs = Doo::db()->query($sql, array($type, $dat->id, $fechal));
                $pricescar = $rs->fetch();

                if (empty($pricescar)) {//Si no encuentra Buscamos Net.
                    $sql = 'SELECT id,price
				FROM tarifacar 
				WHERE (type_rate = ? )
					AND (id_agency = ? or id_agency = -1 )
					AND annio = ?
				ORDER BY type_rate Desc LIMIT 1';
                    $type = 1;
                    $rs = Doo::db()->query($sql, array($type, $dat->id, $fechal));
                    $pricescar = $rs->fetch();
                }
            } else {
                $sql = 'SELECT id,price
				FROM tarifacar 
				WHERE (type_rate = ? )
					AND (id_agency = ? or id_agency = -1 )
					AND annio = ?
				ORDER BY type_rate Desc LIMIT 1';
                $rs = Doo::db()->query($sql, array($dat->type_rate, $dat->id, $fechal));
                $pricescar = $rs->fetch();
            }

            if (!empty($pricescar)) {
                $car = number_format($pricescar ['price'], 2, '.', '');
                $_SESSION['toursbooking']['trasport_total1'] = $car;
            }
        } else {
            $car = 0;
        }


        $tq1 = $trip1 + $trip2 + $vip1 + $vip2 + $byplane1 + $byplane2 + $car;

        $tq = $tq1 + $tohotel; //$tq1 + $tohotel codigo original
        $tqp = $tq / $totalpax;

        if ($totaladult != 0) {
            $transporA = $priceadult1 + $priceadult2;

            $transporA = $transporA + (($vip1 + $vip2 + $byplane1 + $byplane2 + $car) / $totaladult);
            if ($priceadult1 == 0 && $priceadult2 == 0) {
                $transporA = $transporA + $transporA;
            }
        } else {
            $transporA = 0;
        }


        if ($totalchild != 0) {
            $transporN = $pricechild1 + $pricechild2;
            $transporN = $transporN + (($vip1 + $vip2 + $byplane1 + $byplane2 + $car) / $totalchild);
            if ($pricechild1 == 0 && $pricechild2 == 0) {
                $transporN = $transporN + $transporN;
            }
        } else {
            $transporN = 0;
        }
        //echo $tohotel;
        /* $_SESSION ["toursbooking"] ["priceadults"] = $transporA;
          $_SESSION ["toursbooking"] ["pricechilds"] = $transporN; */
        $_SESSION['toursbooking']['totalhotel'] = $tohotel;
        $namehotel = $costohotel ['nombre'];
        /* echo $costohotel['categoria'];
          exit; */

        if ($costohotel['super_breakfast'] == 0) {// falta confirmar si es solo para tourist 
            $_SESSION ['menosbuff']['buff'] = '';
            $_SESSION ['menosbuff'] ['totalpax'] = $totalpax;
            $_SESSION ['menosbuff'] ['tq'] = $tq;
            $_SESSION['toursbooking']['tqp'] = $tqp;
            $_SESSION['toursbooking']['tq'] = $tq;
            $_SESSION ["toursbooking"] ["totaltotal"] = $totalpax * $_SESSION['toursbooking']['tqp'];
            $_SESSION ["toursbooking"] ["comision_agency"] = (!$net_rate) ? ($tqp * (($this->cal_equipament()) / 100)) : 0.00;

            $breakfastdato = "";

//            $buffet = '<div id="buffet2" title="asdfg"><table width="100%" border="0" cellspacing="1"><tr><td width="22%"><img src="' . Doo::conf()->APP_URL . 'global/images/desayunob.jpg" width="150px;" heigth="50px;"/></td><td colspan="2">&nbsp;</td><td width="76%">Do you want to include SUPER BREAKFAST BUFFET in your Hotel?<label></label><label><br /><input type="radio" name="buffet" id="buffet"  class="buff" value="1" />YES</label><input type="radio" name="buffet" class="buff" id="buffet" value="0" />NO</td></tr></table>';
//            echo "<script>$('#buffet').dialog({
//					modal: true,
//					width: 600,
//				});
//		$('.buff').change(function(){
//									var id = $(this).val();
//
//									$('#roomsdistri').load('" . Doo::conf()->APP_URL . "tours/question17/' + id);
//								 								  });
//		</script>";
        } else {
            $breakfastdato = "Free Breakfast ";
            $buffet = "";
            if (isset($_SESSION ['menosbuff'])) {
                unset($_SESSION ['menosbuff']);
            }
            $_SESSION ['menosbuff']['buff'] = $breakfastdato;
            $categoria = $costohotel['categoria'];
            if ($costohotel['super_breakfast'] == 0) {
                $_SESSION ['menosbuff'] ['mando'] = ($desayuno);
                $_SESSION['toursbooking']['tqp'] = $tqp;
                $_SESSION['toursbooking']['tq'] = $tq;
                $_SESSION ["toursbooking"] ["totaltotal"] = $totalpax * $_SESSION['toursbooking']['tqp'];
                $_SESSION ["toursbooking"] ["comision_agency"] = (!$net_rate) ? ($tqp * (($this->cal_equipament()) / 100)) : 0.00;
            } else if ($costohotel['super_breakfast'] == 1) {
                $_SESSION ['menosbuff'] ['mando'] = ($desayuno);
                $_SESSION ['menosbuff'] ['totalpax'] = $totalpax;
                $_SESSION ['menosbuff'] ['tq'] = $tq;
                $_SESSION['toursbooking']['tqp'] = $tqp;
                $_SESSION['toursbooking']['tq'] = $tq;
                $_SESSION ["toursbooking"] ["totaltotal"] = $totalpax * $_SESSION['toursbooking']['tqp'];
                $_SESSION ["toursbooking"] ["comision_agency"] = (!$net_rate) ? ($tqp * (($this->cal_equipament()) / 100)) : 0.00;
                $breakfastdato = "Free Breakfast ";

                $buffet = '<div id="buffet2" title="asdfg"><table width="100%" border="0" cellspacing="1"><tr><td width="22%"><img src="' . Doo::conf()->APP_URL . 'global/images/desayunob.jpg" width="150px;" heigth="50px;"/></td><td colspan="2">&nbsp;</td><td width="76%">Do you want to include SUPER BREAKFAST BUFFET in your Hotel?<label></label><label><br /><input type="radio" name="buffet" id="buffet"  class="buff" value="1" />YES</label><input type="radio" name="buffet" class="buff" id="buffet" value="0" />NO</td></tr></table>';
                echo "<script>$('#buffet').dialog({
						modal: true,
						width: 600,
					});
					$('.buff').change(function(){
										var id = $(this).val();
										
										$('#roomsdistri').load('" . Doo::conf()->APP_URL . "tours/question17/' + id);
																	  }); 
			</script>";
            }
        }
        $_SESSION ["menosbuff"] ["nightprice"] = $tohotel / $toursbooking ['noches'];
        $_SESSION ['menosbuff'] ['breakfastprice'] = $desayuno / $toursbooking ['noches'];
        $datos = $_SESSION ['menosbuff'];
        $tqph = round($tqp);

        echo "<script>$('#namehotel').html('$namehotel');$('#roomss').html('$rooms ROOM');$('#desayuno').html('$breakfastdato');$('#tqp').html('$ $tqph');</script>";

        //Comentario De Hotel ocupado
        $this->comentarioHotelOcupado();
        //Fin Comentario
        // print_r($_SESSION ["toursbooking"]);
    }

    public function buffet() {
        /* echo json_encode($_SESSION['menosbuff']); */
        $yes = $this->params ['id'];

        $_SESSION['bufet'] = $yes;

        $datos = $_SESSION ['menosbuff'];
        if ($yes == 1) {
            $sumando = $datos ['tq'];
            if (isset($datos['breakfastprice'])) {
                $sumando += ($datos['breakfastprice'] * $_SESSION['toursbooking']['noches']);
            }
            $breakfastdato = "SUPER BREKFAST BUFFET";
            $_SESSION ['menosbuff']['buff'] = $breakfastdato;
            echo "<script >$('#desayuno').html('$breakfastdato');</script>";
        } else {

            $_SESSION ['menosbuff']['buff'] = '';
            $sumando = $datos ['tq'];
        }
        //aqui se quito el redondeo

        $tqp = $sumando / $datos ['totalpax'];
        $_SESSION['toursbooking']['tqp'] = $tqp;
        $_SESSION['toursbooking']['tq'] = $sumando;
        echo "<script >$('#tqp').html('$ " . round($tqp) . "');
		</script>";
        //print_r($_SESSION ['menosbuff']);
    }

    function transaction_approval() {
        $txt = (isset($_SERVER['HTTP_REFERER'])) ? $_SERVER['HTTP_REFERER'] : "";
        //&& strstr("myvirtualmerchant.com",$txt)
        if ((isset($_SESSION['user']) && isset($_REQUEST['ssl_approval_code'])) && isset($_SESSION['toursbooking'])) {
            $this->data ['rootUrl'] = Doo::conf()->APP_URL;
            // $this->response_approval(); 
            $_SESSION['tourPagoMulDay'] = 'ok';
            if (isset($_SESSION['codconf'])) {
                $_SESSION['codconf2'] = $_SESSION['codconf'] . "_" . $_REQUEST['ssl_approval_code'];
            }
            return $this->renderc("tours/approval", $this->data);
        } else {
            if (isset($_SESSION['data_agency'])) {
                return Doo::conf()->APP_URL . "agency/";
            } else {
                return Doo::conf()->APP_URL . "";
            }
        }
    }

    function transaction_decline() {
        if ((isset($_SESSION['user']) && isset($_REQUEST['ssl_approval_code'])) && isset($_SESSION['toursbooking'])) {
            $this->data['rootUrl'] = Doo::conf()->APP_URL;
            $this->view()->renderc('tours/decline', $this->data);
        } else {
            $this->data ['rootUrl'] = Doo::conf()->APP_URL;
            $this->view()->renderc('tours/decline', $this->data);
            // $this->renderc("error",$this->data); 
        }
    }

    function seguridad() {
        if (!(((isset($_SESSION['user']) && isset($_REQUEST['ssl_approval_code'])) && isset($_SESSION['toursbooking'])))) {
            return Doo::conf()->APP_URL . "tours/";
        }
    }

    /* response approval */

    function response_approval() {
        if (!isset($_SESSION['toursbooking'])) {
            if (isset($_SESSION['data_agency'])) {
                return Doo::conf()->APP_URL . "agency/";
            } else {
                return Doo::conf()->APP_URL . "tours/";
            }
        } else if ($_SESSION['onedaytour'] == true) {
            return $this->response_approval_onedaytour();
        } else {
            Doo::loadModel("Clientes");
            //if ((isset($_SESSION['user'])&& isset($_REQUEST['ssl_approval_code'])) && isset($_SESSION['toursbooking'])  ){
            (isset($_SESSION['user'])) or die("Page No Found Error 404");
            $_SESSION['codconf'] = $_SESSION['codconf'] . "_" . $_REQUEST['ssl_approval_code'];
            $codigoConf = $_SESSION['codconf'];
            Doo::loadModel("Agency");
            if (isset($_SESSION['data_agency'])) {
                $dat = new Agency($_SESSION['data_agency']);
                Doo::loadModel("UserA");
                $user = new UserA($_SESSION['user']);
            } else {
                $user = new Clientes($_SESSION['user']);
                $dat = new Agency();
                $dat->id = -1;
                $dat->type_rate = 0;
            }

            //Cargando Datos cliente
            $tourstick = $_SESSION ["tourstick"];
            $cliente = new Clientes();
            $cliente->username = $tourstick['email'];
            $cliente = Doo::db()->find($cliente, array('limit' => 1));
            if (empty($cliente)) {
                $cliente = new Clientes();
                $cliente->username = $tourstick['email'];
                $cliente->firstname = $tourstick['firstname'];
                $cliente->lastname = $tourstick['lastname'];
                $cliente->phone = $tourstick['phone'];
                $cliente->celphone = $tourstick['cellphone'];
                Doo::db()->insert($cliente) or die("Error Ingresando Datos de Cliente");
                $id_cliente = Doo::db()->lastInsertId();
                $cliente->id = $id_cliente;
            }

            //FIN carga datos clientes

            Doo::loadModel("Reserve");
            Doo::loadModel("Transfer");
            try {
                $sdeparture = (isset($_SESSION['toursbooking']['sdeparture']) ? $_SESSION['toursbooking']['sdeparture'] : 0);
                $sarrival = (isset($_SESSION['toursbooking']['sarrival']) ? $_SESSION['toursbooking']['sarrival'] : 0);
                $type_tour = 'MULTI';
                if (($sarrival != 0) && ($sdeparture != 0)) {
                    if (($sarrival != 1)) {

                        $tranferIn = new Transfer();
                        $tranferIn->airlie = (isset($_SESSION['toursbooking']['airlinearrival']) ? $_SESSION['toursbooking']['airlinearrival'] : "");
                        $tranferIn->arrival_time = (isset($_SESSION['toursbooking']['hora1']) ? $_SESSION['toursbooking']['hora1'] : "");
                        $tranferIn->flight = (isset($_SESSION['toursbooking']['flightarrival']) ? $_SESSION['toursbooking']['flightarrival'] : "");
                        $tranferIn->total_pax = (isset($_SESSION['toursbooking']['totalpax']) ? $_SESSION['toursbooking']['totalpax'] : 0);
                        $tranferIn->total_price = (isset($_SESSION['toursbooking']['trasport_total1']) ? $_SESSION['toursbooking']['trasport_total1'] : 0);
                        $tranferIn->type = $sarrival;
                        $tranferIn->type_transfer = (isset($_SESSION['toursbooking']['service1']) ? $_SESSION['toursbooking']['service1'] : "N/A");
                        Doo::db()->insert($tranferIn) or die("Error Ingresando Datos de Trasporte_");
                        $inTrans = Doo::db()->lastInsertId();
                    }
                    if (($sdeparture != 1)) {
                        $tranferOut = new Transfer();
                        $tranferOut->airlie = (isset($_SESSION['toursbooking']['airlinedeparture']) ? $_SESSION['toursbooking']['airlinedeparture'] : "");
                        $tranferOut->arrival_time = (isset($_SESSION['toursbooking']['hora2']) ? $_SESSION['toursbooking']['hora2'] : "");
                        $tranferOut->flight = (isset($_SESSION['toursbooking']['flightdeparture']) ? $_SESSION['toursbooking']['flightdeparture'] : "");
                        $tranferOut->total_pax = (isset($_SESSION['toursbooking']['totalpax']) ? $_SESSION['toursbooking']['totalpax'] : 0);
                        $tranferOut->total_price = $_SESSION['toursbooking']['trasport_total2'];
                        $tranferOut->type = $sdeparture;
                        $tranferOut->type_transfer(isset($_SESSION['toursbooking']['service2']) ? $_SESSION['toursbooking']['service2'] : "N/A");
                        ;
                        Doo::db()->insert($tranferOut) or die("Error Ingresando Datos de Trasporte");
                        $outTrans = Doo::db()->lastInsertId();
                    }
                }

                Doo::loadModel("Hotel_Reserves");
                $hotel = new Hotel_Reserves();
                $hotel->additional_night = 0;
                $hotel->adult = $_SESSION['toursbooking']['adults'];
                $hotel->category = $_SESSION['categoria'];
                $hotel->child = $_SESSION['toursbooking']['childs'];
                $hotel->days = $_SESSION['toursbooking']['dias'];
                $hotel->id_agencia = $dat->id;
                
                $hotel->id_cliente = $user->id;
                $hotel->id_hotel = $_SESSION['toursbooking']['hotelid'];
                $hotel->nights = $_SESSION['toursbooking']['noches'];
                $hotel->creation_date = date("Y-m-d H:i");
                $hotel->starting_date = $_SESSION['toursbooking']['fecha_llegada'];
                $hotel->ending_date = $_SESSION['toursbooking']['fecha_salida'];
                $hotel->room1_adult = $_SESSION ["toursbooking"]['adult_r1'];
                $hotel->room2_adult = $_SESSION ["toursbooking"]['adult_r2'];
                $hotel->room3_adult = $_SESSION ["toursbooking"]['adult_r3'];
                $hotel->room4_adult = $_SESSION ["toursbooking"]['adult_r4'];
                $hotel->room1_child = $_SESSION ["toursbooking"]['child_r1'];
                $hotel->room2_child = $_SESSION ["toursbooking"]['child_r2'];
                $hotel->room3_child = $_SESSION ["toursbooking"]['child_r3'];
                $hotel->room4_child = $_SESSION ["toursbooking"]['child_r4'];
                $hotel->roooms = $_SESSION['toursbooking']['rooms'];
                if ($_SESSION ['menosbuff']['buff'] == 'SUPER BREKFAST BUFFET') {
                    $hotel->breakfastprice = $_SESSION ['menosbuff']['breakfastprice'];
                    $hotel->totalbreakfasts = $hotel->breakfastprice * $hotel->nights;
                    $hotel->buffet = 1;
                } else {
                    $hotel->breakfastprice = 0;
                    $hotel->totalbreakfasts = 0;
                }
                $hotel->nightprice = $_SESSION ["menosbuff"] ["nightprice"];
                $hotel->totalnights = $hotel->nightprice * $hotel->nights;
                $hotel->total_paid = $hotel->totalnights + $hotel->totalbreakfasts;
                $hotel->total_persons = $_SESSION['toursbooking']['totalpax'];
                $hotel->type = 0;
                Doo::db()->insert($hotel) or die("Error Ingresando Datos de Hotel");
                $id_hotel_reserves = Doo::db()->lastInsertId();

                Doo::loadModel("Tours");
                $total = $_SESSION['toursbooking']['tqp'] * $_SESSION['toursbooking']['totalpax'];
                $platinum = $_SESSION['toursbooking']['question'];
                $tours = new Tours();
                $tours->id_client = $cliente->id;
                $tours->type_client = $cliente->tipo_client;
                $tours->platinum = ($platinum == 2) ? 1 : 0;
                $tours->id_agency = $dat->id;
                $tours->code_conf = $_SESSION['codconf'];
                $tours->agency_employee = ($dat->id != -1) ? $user->id : 0;
                $tours->creation_date = date("Y-m-d H:i");
                $tours->starting_date = $_SESSION['toursbooking']['fecha_llegada'];
                $tours->ending_date = $_SESSION['toursbooking']['fecha_salida'];
                $tours->length_day = $_SESSION['toursbooking']['dias'];
                $tours->length_nights = $_SESSION['toursbooking']['noches'];
                $tours->adult = $_SESSION['toursbooking']['adults'];
                $tours->child = $_SESSION['toursbooking']['childs'];
                $tours->id_reserva = -1;
                $tours->id_transfer_in = (isset($inTrans) ? $inTrans : "-1");
                $tours->id_transfer_out = (isset($outTrans) ? $outTrans : "-1");
                $tours->id_hotel_reserve = $id_hotel_reserves;
                $tours->comments = (isset($_SESSION['toursbooking']['comments'])) ? $_SESSION['toursbooking']['comments'] : '';
                $tours->tipo_pago = "PRED-PAID";
                $tours->pago = $_SESSION ['toursbooking']['opcionPago'];
                $tours->total = $total;
                $tours->totalouta = $total;
                $tours->otheramount = $_SESSION['toursbooking']['otheramount'];
                $tours->extra_charge = 0;
                $tours->descuento_procentaje = 0;
                $tours->descuento_valor = 0;
                $tours->canal = 'WEBSALE';
                $tours->estado = 'CONFIRMED';


                Doo::db()->insert($tours) or die("Error Ingresando Datos de Tours");
                $id_tours = Doo::db()->lastInsertId();
                $sql = "update hotel_reserves set id_tours = ? where id = ?";
                $rs = Doo::db()->query($sql, array($id_tours, $id_hotel_reserves));

                $group = $_SESSION ['grupos'];
                $group1 = $_SESSION ['grupos1'];

                $i = 0;
                Doo::loadModel("Attraction_Trafic");
                Doo::loadModel('Parques');
                $key = array_keys($group);
                while ($i < count($key)) {
                    $grou = explode(',', $group1['park' . $key[$i]]);
                    $j = 0;
                    while ($j < count($grou)) {
                        $attraction = new Attraction_Trafic();
                        $attraction->id_tours = $id_tours;
                        $attraction->type_tour = $type_tour;
                        $attraction->id_park = $grou[$j];
                        $attraction->group = $key[$i];
                        $attraction->creation_date = date("Y-m-d H:i");
                        $attraction->starting_date = $_SESSION['toursbooking']['fecha_llegada'];
                        $attraction->ending_date = $_SESSION['toursbooking']['fecha_salida'];
                        $attraction->admission = $_SESSION ['toursbooking'] ['ticketpark'];
                        $attraction->trafic = 1;
                        $attraction->id_cliente = $cliente->id;
                        $attraction->id_agencia = $dat->id;
                        $attraction->adult = $_SESSION['toursbooking']['adults'];
                        $attraction->child = $_SESSION['toursbooking']['childs'];
                        $attraction->total_person = $_SESSION['toursbooking']['totalpax'];
                        if ($attraction->admission == 1) {
                            $attraction->admission_child = $group1['parkChild' . $key[$i] . ''] * $_SESSION['toursbooking']['childs'] / $_SESSION ['grupos'] [$key[$i]];
                            $attraction->admission_adtul = $group1['parkAdult' . $key[$i] . ''] * $_SESSION['toursbooking']['adults'] / $_SESSION ['grupos'] [$key[$i]];
                            ;
                        } else {
                            $attraction->admission_child = 0;
                            $attraction->admission_adtul = 0;
                        }
                        $attraction->totalAdmission = $attraction->admission_child + $attraction->admission_adtul;
                        $attraction->totalTraspor = $group1['ratesPark' . $key[$i] . ''];
                        $attraction->total_paid = $attraction->totalTraspor + $attraction->totalAdmission;
                        Doo::db()->insert($attraction) or die("Error Ingresando Datos de Attractions");
                        if ($attraction->admission == 1) {
                            $parque = new Parques();
                            $parque->id = $attraction->id_park;
                            $parque = Doo::db()->getOne($parque);
                            $parque->stock = intval($parque->stock) - ($tours->child + $tours->adult);
                            $parque->update();
                        }
                        $j++;
                    }
                    $i++;
                }


                if (($sarrival == 1) || ($sdeparture == 1)) {

                    $reserves = new Reserve();
                    $reserves->id_tours = $id_tours;
                    $reserves->type_tour = $type_tour;
                    $reserves->fecha_ini = date("Y-m-d");
                    $reserves->trip_no = (isset($_SESSION['toursbooking']['trip1']) ? $_SESSION['toursbooking']['trip1'] : "");
                    $reserves->trip_no2 = (isset($_SESSION['toursbooking']['trip2']) ? $_SESSION['toursbooking']['trip2'] : "");
                    $reserves->tipo_ticket = (($sarrival == 1) && ($sdeparture == 1)) ? "roundtrip" : "oneway";
                    $reserves->fromt = (isset($_SESSION['toursbooking']['id_from']) ? $_SESSION['toursbooking']['id_from'] : "");
                    $reserves->tot = (isset($_SESSION['toursbooking']['id_tot']) ? $_SESSION['toursbooking']['id_tot'] : "");
                    $reserves->fromt2 = (isset($_SESSION['toursbooking']['id_from2']) ? $_SESSION['toursbooking']['id_from2'] : "");
                    $reserves->tot2 = (isset($_SESSION['toursbooking']['id_tot2']) ? $_SESSION['toursbooking']['id_tot2'] : "");

                    $reserves->firsname = $user->firstname;
                    $reserves->lasname = $user->lastname;
                    if (isset($_SESSION['data_agency'])) {
                        $reserves->email = $user->email;
                    } else {
                        $reserves->email = $user->username;
                    }

                    $reserves->deptime1 = (isset($_SESSION['toursbooking']['datedeparturetrip1']) ? $_SESSION['toursbooking']['datedeparturetrip1'] : "");
                    $reserves->deptime2 = (isset($_SESSION['toursbooking']['datedeparturetrip1']) ? $_SESSION['toursbooking']['datedeparturetrip2'] : "");
                    $reserves->arrtime1 = (isset($_SESSION['toursbooking']['datearrivingtrip1']) ? $_SESSION['toursbooking']['datearrivingtrip1'] : "");
                    $reserves->arrtime2 = (isset($_SESSION['toursbooking']['datearrivingtrip2']) ? $_SESSION['toursbooking']['datearrivingtrip2'] : "");
                    $reserves->precioA = (isset($_SESSION['toursbooking']['priceadults']) ? $_SESSION['toursbooking']['priceadults'] : "");
                    $reserves->precioN = (isset($_SESSION['toursbooking']['pricechilds']) ? $_SESSION['toursbooking']['pricechilds'] : "");
                    $reserves->fecha_salida = (isset($_SESSION['toursbooking']['fecha_llegada']) ? $_SESSION['toursbooking']['fecha_llegada'] : "");
                    $reserves->fecha_retorno = (isset($_SESSION['toursbooking']['fecha_salida']) ? $_SESSION['toursbooking']['fecha_salida'] : "");
                    $reserves->pax = $_SESSION['toursbooking']['adults'];
                    $reserves->pax2 = $_SESSION['toursbooking']['childs'];
                    $reserves->id_clientes = $cliente->id;
                    $reserves->pickup1 = (isset($_SESSION['toursbooking']['id_pickup1']) ? $_SESSION['toursbooking']['id_pickup1'] : 0);
                    $reserves->dropoff1 = (isset($_SESSION['toursbooking']['id_dropoff1']) ? $_SESSION['toursbooking']['id_dropoff1'] : 0);
                    $reserves->pickup2 = (isset($_SESSION['toursbooking']['id_pickup2']) ? $_SESSION['toursbooking']['id_pickup2'] : 0);
                    $reserves->dropoff2 = (isset($_SESSION['toursbooking']['id_dropoff2']) ? $_SESSION['toursbooking']['id_dropoff2'] : 0);
                    $reserves->tipo_pago = "PRED-PAID";
                    $reserves->pago = $_SESSION ['toursbooking']['opcionPago'];
                    $reserves->totaltotal = (isset($_SESSION['toursbooking']['trasport_total2']) ? $_SESSION['toursbooking']['trasport_total2'] : 0) + (isset($_SESSION['toursbooking']['trasport_total1']) ? $_SESSION['toursbooking']['trasport_total1'] : 0);
                    $reserves->total2 = $reserves->totaltotal;
                    $reserves->codconf = ($_SESSION['codconf']);
                    $reserves->hora = date("H:i:s");
                    $reserves->comments = 'PAID ONLINE';
                    $reserves->agen = ($dat->id != -1) ? $user->id : 0;
                    $reserves->tipo_client = $cliente->tipo_client;
                    $reserves->agency = $dat->id;
                    $reserves->luggage1 = -1;
                    $reserves->luggage2 = -1;
                    $reserves->canal = 'WEBSALE';
                    $reserves->estado = 'CONFIRMED';
                    Doo::db()->insert($reserves) or die("Error Ingresando Datos de Trasnporte Por Bus");
                    $id_reserva = Doo::db()->lastInsertId();

                    //Actualizamos tour
                    $tours->id = $id_tours;
                    $tours->id_reserva = $id_reserva;
                    Doo::db()->update($tours);
                    //registramos rastro y pago
                    Doo::loadController('admin/ReservasController');
                    $reseControl = new ReservasController();
                    $reserves->id = $id_reserva;
                    $login = $_SESSION['user'];
                    if (isset($_SESSION['data_agency'])) {
                        $login->tipo = 'AGENCY';
                    } else {
                        $login->tipo = 'CLIENTE';
                    }
                    $reseControl->registrar_pago($reserves, NULL, $login);
                    $reseControl->rastro_reserva('CREATE', NULL, $reserves, $login);
                }

                if (isset($_SESSION['data_agency'])) {
                    Doo::loadModel("Tours_Agency");
                    $tours_reserv = new Tours_Agency();
                    $comision = $this->cal_equipament();
                    if (isset($_SESSION ['toursbooking']['comision_agency'])) {
                        $valorComision = $_SESSION ['toursbooking']['comision_agency'];
                    } else {
                        $valorComision = 0;
                    }
                    $tours_reserv->id_agency = $dat->id;
                    $tours_reserv->comision = $comision;
                    $tours_reserv->id_reserva = $id_reserva;
                    $tours_reserv->id_tours = $id_tours;
                    $tours_reserv->type_tour = $type_tour;
                    $tours_reserv->tipo_pago = "Credit Card";
                    $tours_reserv->pago = $_SESSION ['toursbooking']['opcionPago'];
                    $tours_reserv->type_rate = $dat->type_rate;
                    $tours_reserv->agency_fee = $valorComision;
                    $tours_reserv->total = $total;
                    $tours_reserv->totalouta = $_SESSION['toursbooking']['totalouta'];
                    Doo::db()->insert($tours_reserv);
                }
                
                //Guardamos el pago y el rastro del tours 
                Doo::loadController('admin/ToursController');
                $tours->id = $id_tours;
                $login = $_SESSION['user'];
                $login->tipo = 'AGENCY';
                $toursControl = new ToursController();
                $toursControl->registrar_pago($tours, NULL, $login);
                $toursControl->rastro_tours('CREATE', NULL, $tours, $login);
                Doo::loadModel('Factura');
                Doo::loadModel('FacturaServicio');
                
                $factura = new Factura();
                $factura->id_agency = $tours->id_agency;
                $factura->creation_date = date('Y-m-d');
                $factura->subtotal = $tours->total;
                $factura->collect = $tours->otheramount;
                $factura->total = $factura->subtotal - $factura->collect;
                $factura->estado = 'PAID';
                $factura->id = Doo::db()->insert($factura);
                $fs = new FacturaServicio();
                $fs->id_servicio = $tours->id;
                $fs->tipo_servicio = "MULTI";
                $fs->id_factura = $factura->id;
                $fs->id = Doo::db()->insert($fs);
                Doo::loadModel('CollectService');
                $coll = new CollectService();
                $coll->id_servicio = $tours->id;
                $coll->tipo_servicio = "MULTI";
                $coll->monto_pagado = $tours->totalouta;
                $coll->id = $coll->insert();
                Doo::loadModel('Pago');
                $pago = new Pago();
                $pago->factura = $factura->id;
                $pago->monto = $tours->totalouta;
                $pago->tipo = 'FULL';
                $pago->transnu = 0;
                $pago->adjunto = 'online-paid';
                $pago->descuento = 0;
                $pago->per_descuento = 0;
                $pago->fecha = date('Y-m-d h:m:s');
                $pago->metodo = 4;
                $pago->id = $pago->insert();
                $this->mailerConsult();
                $_SESSION['codconf2'] = $codigoConf;
                unset($_SESSION['toursbooking']);
                $_SESSION['codconf2'] = $codigoConf;
            } catch (Exception $exc) {
                unset($_SESSION['toursbooking']);
                //   echo $exc->getMessage();
                return Doo::conf()->APP_URL . "error/";
            }
        }
    }

    function quotation() {

        try {
            extract($_POST, EXTR_SKIP);
            if (!(isset($firstname_tick) && isset($lastname_tick) && isset($email_tick) && isset($cellular_tick) /*&& isset($phone_tick)*/ && isset($_SESSION['toursbooking']))) {
                if (isset($_SESSION['data_agency'])) {
                    return Doo::conf()->APP_URL . "agency/#tours2";
                } else {
                    return Doo::conf()->APP_URL . "tours/";
                }
            }
            Doo::loadController('admin/ToursController');
            $toursControl = new ToursController();
            $_SESSION['codcuot'] = $toursControl->codigoConf(0);
            $_SESSION['codconf'] = $_SESSION['codcuot'];
            if (!isset($_SESSION ['user'])) {
                $tourstick = array(
                    "firstname" => $firstname_tick,
                    "lastname" => $lastname_tick,
                    "email" => $email_tick,
                    "cellphone" => $cellular_tick,
                   // "phone" => $phone_tick
                );
                $_SESSION ["tourstick"] = $tourstick;
            } else {
                $user = $_SESSION ['user'];
                if (isset($_SESSION['data_agency'])) {
                    $tourstick = array(
                        "firstname" => $firstname_tick,
                        "lastname" => $lastname_tick,
                        "email" => $email_tick,
                        "cellphone" => $cellular_tick,
                        //"phone" => $phone_tick
                    );
                    $_SESSION ["tourstick"] = $tourstick;
                } else {
                    if (!isset($user->celphone)) {
                        $user->celphone = '';
                    }
                    if (!isset($user->phone)) {
                        $user->phone = '';
                    }
                    $tourstick = array(
                        "firstname" => $user->firstname,
                        "lastname" => $user->lastname,
                        "email" => $user->username,
                        "cellphone" => $user->celphone,
                        //"phone" => $user->phone
                    );
                    $_SESSION ["tourstick"] = $tourstick;
                }
            }
            $this->mailerConsult();
            $_SESSION['tourPagoMulDay'] = 'No';
            $this->data['rootUrl'] = Doo::conf()->APP_URL;
            $this->view()->renderc('tours/quotation', $this->data);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    /*
      Return void
      Para
     */

    public function onedaytour() {
        unset($_SESSION['tourPagoMulDay']);
        unset($_SESSION['tourPagoOneDay']);
        unset($_SESSION['toursbooking']);



        $sql = "SELECT DISTINCT t2.id, t2.nombre  FROM routes t1
						LEFT JOIN areas t2 ON (t1.trip_from = t2.id)
						WHERE t1.type_rate = 0 AND t1.trip_to = 1 AND trip_no = 301 
						ORDER BY t2.id DESC  ";
        $rs = Doo::db()->query($sql);
        $areas_ida = $rs->fetchAll();

        $sql = "SELECT DISTINCT t2.id, t2.nombre  FROM routes t1
						LEFT JOIN areas t2 ON (t1.trip_to = t2.id)
						WHERE t1.type_rate = 0 AND t1.trip_from = 1 AND trip_no = 300
						ORDER BY t2.id ASC  ";
        $rs = Doo::db()->query($sql);
        $areas_return = $rs->fetchAll();

        $this->data ['areas_ida'] = $areas_ida;
        $this->data ['areas_return'] = $areas_return;
        $this->data ['rootUrl'] = Doo::conf()->APP_URL;
        $this->renderc('/tours/1-one-day-tour', $this->data);
    }

    public function onedaytour_one() {
        Doo::loadModel("Agency");
        if (isset($_SESSION['data_agency'])) {
            $dat = new Agency($_SESSION['data_agency']);
            $type = $dat->type_rate;
        } else {
            $dat = new Agency();
            $type = 0;
            $dat->id = -1;
        }
        //Tipo de pickup_dropoff;
        if ($dat->id == -1) {
            $type_web = 1;
        } else {
            $type_web = 0;
        }

        $_SESSION['step_onedaytour_one'] = true;
        $_SESSION['onedaytour'] = true;
        extract($_POST, EXTR_SKIP);
        $sqlArea = "select nombre from areas where id = ?";
        $res = Doo::db()->query($sqlArea, array($area));
        $ar = $res->fetch();
        $sqlpu = "SELECT id,place,address FROM pickup_dropoff	WHERE id = ?";
        $pu = Doo::db()->query($sqlpu, array($pickup));
        $pick = $pu->fetch();
        $_SESSION['area'] = $ar['nombre'];
        $_SESSION['pickup'] = $pick['place'];

        $sqlArea = "select nombre from areas where id = ?";
        $res = Doo::db()->query($sqlArea, array($area2));
        $ar2 = $res->fetch();
        $sqlpu2 = "SELECT id,place,address FROM pickup_dropoff	WHERE id = ?";
        $pu2 = Doo::db()->query($sqlpu2, array($pickup2));
        $pick2 = $pu2->fetch();
        $_SESSION['area2'] = $ar2['nombre'];
        $_SESSION['pickup2'] = $pick2['place'];

        //Pickup de orlando;
        $sqlpu2 = "SELECT id,place,address FROM pickup_dropoff	WHERE id_area = 1 AND type_web = ? ORDER BY id ASC";
        $puO = Doo::db()->query($sqlpu2, array($type_web));
        $pickO = $puO->fetch();
        $dropoff = $pickO['id']; // Este sera el dropoff1 de ida y el pickup de regreso


        $fecha_salida = $txtfecha_salida;
        $fecha_retorno = $txtfecha_salida;
        list ($mes, $dia, $anyo) = explode("-", $fecha_salida);

        $llegada = $anyo . "-" . $mes . "-" . $dia;

        if (isset($fecha_retorno)) {

            list ($mes2, $dia2, $anyo2) = explode("-", $fecha_retorno);

            $salida = $anyo2 . "-" . $mes2 . "-" . $dia2;
        }

        $dias = (strtotime($llegada) - strtotime($salida)) / 86400;
        $dias = abs($dias);
        $dias = floor($dias) + 1;
        $noches = $dias - 1;
        $question = 1;
        $toursbooking = array(
            "question" => $question,
            "fecha_llegada" => $llegada,
            "fecha_salida" => $salida,
            "sarrival" => $sarrival,
            "sdeparture" => $sdeparture,
            "dias" => $dias,
            "noches" => $noches,
            "area1" => $area,
            "pickup1" => $pickup,
            "dropoff1" => $dropoff,
            "area2" => $area2,
            "pickup2" => $dropoff,
            "dropoff2" => $pickup2
        );
        if (isset($trip1)) {

            $toursbooking ['trip1'] = $trip1;
            $sql = "SELECT  t1.trip_no, t2.trip_departure,t3.equipment,t2.trip_arrival, t1.estado  
				FROM programacion t1
					  LEFT JOIN routes t2 ON (t1.trip_no = t2.trip_no)
					  LEFT JOIN trips  t3 ON (t1.trip_no = t3.trip_no) 
					  LEFT JOIN areas  a ON (t2.trip_from = a.id)
				WHERE t2.type_rate = ? 
					AND t2.trip_from = ? 
					AND t2.trip_to = 1 
					AND fecha = ? 
					AND t1.trip_no = ? 
					AND t1.estado = '1' 
				ORDER BY t2.trip_departure ASC";



            $fechallegada = date("d-m-Y", strtotime($toursbooking ['fecha_llegada']));
            $fechallegada = date("m-d-Y", strtotime($fechallegada));

            $rs = Doo::db()->query($sql, array($type, $area,
                $fechallegada, $trip1
            ));

            $fechas = $rs->fetch();

            $toursbooking ['datedeparturetrip1'] = $fechas ['trip_departure'];
            $toursbooking ['datearrivingtrip1'] = $fechas ['trip_arrival'];
            $toursbooking ['equipment1'] = $fechas ['equipment'];
            $toursbooking ['service1'] = "SUPER TOURS BUS";
        }
//         print_r(Doo::db()->show_sql());
//         exit;
        if (isset($trip2)) { // /trip de departure
            $toursbooking ['trip2'] = $trip2;

            $fechasalida = date("d-m-Y", strtotime($toursbooking ['fecha_salida']));
            $fechasalida = date("m-d-Y", strtotime($fechasalida));
            $sql = "SELECT  t1.trip_no, t2.trip_departure,t3.equipment,t2.trip_arrival, t1.estado  
						FROM programacion t1  LEFT JOIN routes t2 ON (t1.trip_no = t2.trip_no)
								LEFT JOIN trips  t3 ON (t1.trip_no = t3.trip_no) 
								LEFT JOIN areas  a ON (t2.trip_from = a.id)
						WHERE t2.type_rate = ? 
							AND t2.trip_from = 1 
							AND t2.trip_to = ? 
							AND fecha = ? 
							AND t1.trip_no = ? 
							AND t1.estado = '1' 
						ORDER BY t2.trip_departure ASC";

            $rs = Doo::db()->query($sql, array($type, $area, $fechasalida, $trip2)
            );
            $fechas2 = $rs->fetch();
            $toursbooking ['datedeparturetrip2'] = date("g:i A", strtotime($fechas2 ['trip_departure']));
            $toursbooking ['datearrivingtrip2'] = date("g:i A", strtotime($fechas2['trip_arrival']));
            $toursbooking ['equipment2'] = $fechas2 ['equipment'];
            $toursbooking ['service2'] = "SUPER TOURS BUS";
        }

        // //////////////////// services
        $_SESSION ["toursbooking"] = $toursbooking;

        $this->onedaytour_two2(); //Calular valores
        if ($txtAdults + $txtChild > 16) {
            $_SESSION['ErrorOnedayTour'] = "The sum of children ($ " . $txtChild . ") and adults ($ " . $txtAdults . ") has exceeded the maximum number of passengers";
            return Doo::conf()->APP_URL . "one-day-tour";
        } else {
            return Doo::conf()->APP_URL . "tours/onedaytour-park";
        }
    }

    public function onedaytour_two() {
        $this->data ['rootUrl'] = Doo::conf()->APP_URL;
        if (isset($_SESSION['step_onedaytour_one']) && isset($_SESSION ["toursbooking"])) {
            /** Imagenes de Magic Kingdom * */
            $id_parque = 7;
            $mgk = Doo::db()->find("Imagenes_parques", array("asc" => "orden", "where" => "id_parques = ? ", "param" => array($id_parque)));
            //print_r($mgk);
            $html_img = "";
            if (!empty($mgk)) {
                $contador_img = 1;
                foreach ($mgk as $values_img) {
                    if ($contador_img == 1) {
                        $html_img .= '<a class="galeria" title="' . $values_img->descripcion . '" data-lightbox-gallery="' . $id_parque . '" href="' . Doo::conf()->APP_URL . 'global/' . $values_img->ruta_resize . '"> <img  src="' . Doo::conf()->APP_URL . 'global/img/wall-disney-mk.png"/> </a>';
                    } else {
                        $html_img .= '<a class="galeria" style="display:none;" title="' . $values_img->descripcion . '" href="' . Doo::conf()->APP_URL . 'global/' . $values_img->ruta_resize . '" data-lightbox-gallery="' . $id_parque . '"></a>';
                    }
                    $contador_img++;
                }
            } else {
                $html_img .= '<img  src="' . Doo::conf()->APP_URL . 'global/img/wall-disney-mk.png"/>';
            }
            $this->data["magk"] = $html_img;
            /** Fin Magic Kingdom */
            /** Imagenes de Epcot * */
            $id_parque = 8;
            $epcot = Doo::db()->find("Imagenes_parques", array("asc" => "orden", "where" => "id_parques = ? ", "param" => array($id_parque)));

            $html_img = "";
            if (!empty($epcot)) {
                $contador_img = 1;
                foreach ($epcot as $values_img) {
                    if ($contador_img == 1) {
                        $html_img .= '<a class="galeria" title="' . $values_img->descripcion . '" data-lightbox-gallery="' . $id_parque . '" href="' . Doo::conf()->APP_URL . 'global/' . $values_img->ruta_resize . '"> <img  src="' . Doo::conf()->APP_URL . 'global/img/wall-disney-epcot.png"/> </a>';
                    } else {
                        $html_img .= '<a class="galeria" style="display:none;" title="' . $values_img->descripcion . '" href="' . Doo::conf()->APP_URL . 'global/' . $values_img->ruta_resize . '" data-lightbox-gallery="' . $id_parque . '"></a>';
                    }
                    $contador_img++;
                }
            } else {
                $html_img .= '<img  src="' . Doo::conf()->APP_URL . 'global/img/wall-disney-epcot.png"/>';
            }
            $this->data["epcot"] = $html_img;
            /** Fin Magic Epcot */
            /** Imagenes de Hollywood Studios * */
            $id_parque = 9;
            $hs = Doo::db()->find("Imagenes_parques", array("asc" => "orden", "where" => "id_parques = ? ", "param" => array($id_parque)));

            $html_img = "";
            if (!empty($hs)) {
                $contador_img = 1;
                foreach ($hs as $values_img) {
                    if ($contador_img == 1) {
                        $html_img .= '<a class="galeria" title="' . $values_img->descripcion . '" data-lightbox-gallery="' . $id_parque . '" href="' . Doo::conf()->APP_URL . 'global/' . $values_img->ruta_resize . '"> <img  src="' . Doo::conf()->APP_URL . 'global/img/wall-disney-hs.png"/> </a>';
                    } else {
                        $html_img .= '<a class="galeria" style="display:none;" title="' . $values_img->descripcion . '" href="' . Doo::conf()->APP_URL . 'global/' . $values_img->ruta_resize . '" data-lightbox-gallery="' . $id_parque . '"></a>';
                    }
                    $contador_img++;
                }
            } else {
                $html_img .= '<img  src="' . Doo::conf()->APP_URL . 'global/img/wall-disney-hs.png"/>';
            }
            $this->data["hs"] = $html_img;
            /** Fin Hollywood Studios */
            /** Imagenes de Animal Kingdom * */
            $id_parque = 10;
            $hs = Doo::db()->find("Imagenes_parques", array("asc" => "orden", "where" => "id_parques = ? ", "param" => array($id_parque)));

            $html_img = "";
            if (!empty($hs)) {
                $contador_img = 1;
                foreach ($hs as $values_img) {
                    if ($contador_img == 1) {
                        $html_img .= '<a class="galeria" title="' . $values_img->descripcion . '" data-lightbox-gallery="' . $id_parque . '" href="' . Doo::conf()->APP_URL . 'global/' . $values_img->ruta_resize . '"> <img  src="' . Doo::conf()->APP_URL . 'global/img/wall-disney-ak.png"/> </a>';
                    } else {
                        $html_img .= '<a class="galeria" style="display:none;" title="' . $values_img->descripcion . '" href="' . Doo::conf()->APP_URL . 'global/' . $values_img->ruta_resize . '" data-lightbox-gallery="' . $id_parque . '"></a>';
                    }
                    $contador_img++;
                }
            } else {
                $html_img .= '<img  src="' . Doo::conf()->APP_URL . 'global/img/wall-disney-ak.png"/>';
            }
            $this->data["animalk"] = $html_img;
            /** Fin Animal Kingdom */
            /** Imagenes de Sea World * */
            $id_parque = 11;
            $hs = Doo::db()->find("Imagenes_parques", array("asc" => "orden", "where" => "id_parques = ? ", "param" => array($id_parque)));

            $html_img = "";
            if (!empty($hs)) {
                $contador_img = 1;
                foreach ($hs as $values_img) {
                    if ($contador_img == 1) {
                        $html_img .= '<a class="galeria" title="' . $values_img->descripcion . '" data-lightbox-gallery="' . $id_parque . '" href="' . Doo::conf()->APP_URL . 'global/' . $values_img->ruta_resize . '"> <img  src="' . Doo::conf()->APP_URL . 'global/img/sea-world-sw.png"/> </a>';
                    } else {
                        $html_img .= '<a class="galeria" style="display:none;" title="' . $values_img->descripcion . '" href="' . Doo::conf()->APP_URL . 'global/' . $values_img->ruta_resize . '" data-lightbox-gallery="' . $id_parque . '"></a>';
                    }
                    $contador_img++;
                }
            } else {
                $html_img .= '<img  src="' . Doo::conf()->APP_URL . 'global/img/sea-world-sw.png"/>';
            }
            $this->data["sw"] = $html_img;
            /** Fin Sea World */
            /** Imagenes de Busch Gardens * */
            $id_parque = 12;
            $busg = Doo::db()->find("Imagenes_parques", array("asc" => "orden", "where" => "id_parques = ? ", "param" => array($id_parque)));

            $html_img = "";
            if (!empty($busg)) {
                $contador_img = 1;
                foreach ($busg as $values_img) {
                    if ($contador_img == 1) {
                        $html_img .= '<a class="galeria" title="' . $values_img->descripcion . '" data-lightbox-gallery="' . $id_parque . '" href="' . Doo::conf()->APP_URL . 'global/' . $values_img->ruta_resize . '"> <img  src="' . Doo::conf()->APP_URL . 'global/img/sea-world-hs.png"/> </a>';
                    } else {
                        $html_img .= '<a class="galeria" style="display:none;" title="' . $values_img->descripcion . '" href="' . Doo::conf()->APP_URL . 'global/' . $values_img->ruta_resize . '" data-lightbox-gallery="' . $id_parque . '"></a>';
                    }
                    $contador_img++;
                }
            } else {
                $html_img .= '<img  src="' . Doo::conf()->APP_URL . 'global/img/sea-world-hs.png"/>';
            }
            $this->data["bg"] = $html_img;

            /** Fin Busch Gardens */
            /** Imagenes de Aquatica * */
            $id_parque = 13;
            $acuatica = Doo::db()->find("Imagenes_parques", array("asc" => "orden", "where" => "id_parques = ? ", "param" => array($id_parque)));

            $html_img = "";
            if (!empty($acuatica)) {
                $contador_img = 1;
                foreach ($acuatica as $values_img) {
                    if ($contador_img == 1) {
                        $html_img .= '<a class="galeria" title="' . $values_img->descripcion . '" data-lightbox-gallery="' . $id_parque . '" href="' . Doo::conf()->APP_URL . 'global/' . $values_img->ruta_resize . '"> <img  src="' . Doo::conf()->APP_URL . 'global/img/sea-world-aquatica.png"/> </a>';
                    } else {
                        $html_img .= '<a class="galeria" style="display:none;" title="' . $values_img->descripcion . '" href="' . Doo::conf()->APP_URL . 'global/' . $values_img->ruta_resize . '" data-lightbox-gallery="' . $id_parque . '"></a>';
                    }
                    $contador_img++;
                }
            } else {
                $html_img .= '<img  src="' . Doo::conf()->APP_URL . 'global/img/sea-world-aquatica.png"/>';
            }
            $this->data["acuatica"] = $html_img;
            /** Fin Aquatica */
            /** Imagenes de Universal Studios * */
            $id_parque = 14;
            $us = Doo::db()->find("Imagenes_parques", array("asc" => "orden", "where" => "id_parques = ? ", "param" => array($id_parque)));

            $html_img = "";
            if (!empty($us)) {
                $contador_img = 1;
                foreach ($us as $values_img) {
                    if ($contador_img == 1) {
                        $html_img .= '<a class="galeria" title="' . $values_img->descripcion . '" data-lightbox-gallery="' . $id_parque . '" href="' . Doo::conf()->APP_URL . 'global/' . $values_img->ruta_resize . '"> <img  src="' . Doo::conf()->APP_URL . 'global/img/universal-parks-us.png"/> </a>';
                    } else {
                        $html_img .= '<a class="galeria" style="display:none;" title="' . $values_img->descripcion . '" href="' . Doo::conf()->APP_URL . 'global/' . $values_img->ruta_resize . '" data-lightbox-gallery="' . $id_parque . '"></a>';
                    }
                    $contador_img++;
                }
            } else {
                $html_img .= '<img  src="' . Doo::conf()->APP_URL . 'global/img/universal-parks-us.png"/>';
            }
            $this->data["us"] = $html_img;
            /** Fin Universal Studios */
            /** Imagenes de UIsland of Adventure * */
            $id_parque = 15;
            $ua = Doo::db()->find("Imagenes_parques", array("asc" => "orden", "where" => "id_parques = ? ", "param" => array($id_parque)));

            $html_img = "";
            if (!empty($ua)) {
                $contador_img = 1;
                foreach ($ua as $values_img) {
                    if ($contador_img == 1) {
                        $html_img .= '<a class="galeria" title="' . $values_img->descripcion . '" data-lightbox-gallery="' . $id_parque . '" href="' . Doo::conf()->APP_URL . 'global/' . $values_img->ruta_resize . '"> <img  src="' . Doo::conf()->APP_URL . 'global/img/universal-parks-ia.png"/> </a>';
                    } else {
                        $html_img .= '<a class="galeria" style="display:none;" title="' . $values_img->descripcion . '" href="' . Doo::conf()->APP_URL . 'global/' . $values_img->ruta_resize . '" data-lightbox-gallery="' . $id_parque . '"></a>';
                    }
                    $contador_img++;
                }
            } else {
                $html_img .= '<img  src="' . Doo::conf()->APP_URL . 'global/img/universal-parks-ia.png"/>';
            }
            $this->data["ua"] = $html_img;
            /** Fin UIsland of Adventure */
            /** Imagenes de Wet’n Wild * */
            $id_parque = 16;
            $ww = Doo::db()->find("Imagenes_parques", array("asc" => "orden", "where" => "id_parques = ? ", "param" => array($id_parque)));

            $html_img = "";
            if (!empty($ww)) {
                $contador_img = 1;
                foreach ($ww as $values_img) {
                    if ($contador_img == 1) {
                        $html_img .= '<a class="galeria" title="' . $values_img->descripcion . '" data-lightbox-gallery="' . $id_parque . '" href="' . Doo::conf()->APP_URL . 'global/' . $values_img->ruta_resize . '"> <img  src="' . Doo::conf()->APP_URL . 'global/img/water-parks-ww.png"/> </a>';
                    } else {
                        $html_img .= '<a class="galeria" style="display:none;" title="' . $values_img->descripcion . '" href="' . Doo::conf()->APP_URL . 'global/' . $values_img->ruta_resize . '" data-lightbox-gallery="' . $id_parque . '"></a>';
                    }
                    $contador_img++;
                }
            } else {
                $html_img .= '<img  src="' . Doo::conf()->APP_URL . 'global/img/water-parks-ww.png"/>';
            }
            $this->data["ww"] = $html_img;
            /** Fin Wet’n Wild */
            /** Imagenes de Blizzard Beach * */
            $id_parque = 17;
            $bb = Doo::db()->find("Imagenes_parques", array("asc" => "orden", "where" => "id_parques = ? ", "param" => array($id_parque)));

            $html_img = "";
            if (!empty($bb)) {
                $contador_img = 1;
                foreach ($bb as $values_img) {
                    if ($contador_img == 1) {
                        $html_img .= '<a class="galeria" title="' . $values_img->descripcion . '" data-lightbox-gallery="' . $id_parque . '" href="' . Doo::conf()->APP_URL . 'global/' . $values_img->ruta_resize . '"> <img  src="' . Doo::conf()->APP_URL . 'global/img/water-parks-bb.png"/></a>';
                    } else {
                        $html_img .= '<a class="galeria" style="display:none;" title="' . $values_img->descripcion . '" href="' . Doo::conf()->APP_URL . 'global/' . $values_img->ruta_resize . '" data-lightbox-gallery="' . $id_parque . '"></a>';
                    }
                    $contador_img++;
                }
            } else {
                $html_img .= '<img  src="' . Doo::conf()->APP_URL . 'global/img/water-parks-bb.png"/>';
            }
            $this->data["bb"] = $html_img;
            /** Fin Blizzard Beach */
            /** Imagenes de Kennedy Space Cter. * */
            $id_parque = 19;
            $ks = Doo::db()->find("Imagenes_parques", array("asc" => "orden", "where" => "id_parques = ? ", "param" => array($id_parque)));

            $html_img = "";
            if (!empty($ks)) {
                $contador_img = 1;
                foreach ($ks as $values_img) {
                    if ($contador_img == 1) {
                        $html_img .= '<a class="galeria" title="' . $values_img->descripcion . '" data-lightbox-gallery="' . $id_parque . '" href="' . Doo::conf()->APP_URL . 'global/' . $values_img->ruta_resize . '"> <img  src="' . Doo::conf()->APP_URL . 'global/img/historic-parks-ksc.png"/></a>';
                    } else {
                        $html_img .= '<a class="galeria" style="display:none;" title="' . $values_img->descripcion . '" href="' . Doo::conf()->APP_URL . 'global/' . $values_img->ruta_resize . '" data-lightbox-gallery="' . $id_parque . '"></a>';
                    }
                    $contador_img++;
                }
            } else {
                $html_img .= '<img  src="' . Doo::conf()->APP_URL . 'global/img/historic-parks-ksc.png"/>';
            }
            $this->data["ks"] = $html_img;
            /** Fin Kennedy Space Cter. */
            /** Imagenes de Holy Land * */
            $id_parque = 20;
            $hl = Doo::db()->find("Imagenes_parques", array("asc" => "orden", "where" => "id_parques = ? ", "param" => array($id_parque)));

            $html_img = "";
            if (!empty($hl)) {
                $contador_img = 1;
                foreach ($hl as $values_img) {
                    if ($contador_img == 1) {
                        $html_img .= '<a class="galeria" title="' . $values_img->descripcion . '" data-lightbox-gallery="' . $id_parque . '" href="' . Doo::conf()->APP_URL . 'global/' . $values_img->ruta_resize . '"> <img  src="' . Doo::conf()->APP_URL . 'global/img/historic-parks-hl.png"/></a>';
                    } else {
                        $html_img .= '<a class="galeria" style="display:none;" title="' . $values_img->descripcion . '" href="' . Doo::conf()->APP_URL . 'global/' . $values_img->ruta_resize . '" data-lightbox-gallery="' . $id_parque . '"></a>';
                    }
                    $contador_img++;
                }
            } else {
                $html_img .= '<img  src="' . Doo::conf()->APP_URL . 'global/img/historic-parks-hl.png"/>';
            }
            $this->data["hl"] = $html_img;
            /** Fin Holy Land */
            /** Imagenes de Medieval Times * */
            $id_parque = 21;
            $mt = Doo::db()->find("Imagenes_parques", array("asc" => "orden", "where" => "id_parques = ? ", "param" => array($id_parque)));

            $html_img = "";
            if (!empty($mt)) {
                $contador_img = 1;
                foreach ($mt as $values_img) {
                    if ($contador_img == 1) {
                        $html_img .= '<a class="galeria" title="' . $values_img->descripcion . '" data-lightbox-gallery="' . $id_parque . '" href="' . Doo::conf()->APP_URL . 'global/' . $values_img->ruta_resize . '"> <img  src="' . Doo::conf()->APP_URL . 'global/img/afp-an.png"/></a>';
                    } else {
                        $html_img .= '<a class="galeria" style="display:none;" title="' . $values_img->descripcion . '" href="' . Doo::conf()->APP_URL . 'global/' . $values_img->ruta_resize . '" data-lightbox-gallery="' . $id_parque . '"></a>';
                    }
                    $contador_img++;
                }
            } else {
                $html_img .= '<img  src="' . Doo::conf()->APP_URL . 'global/img/afp-an.png"/>';
            }
            $this->data["mt"] = $html_img;
            /** Fin Medieval Times */
            /** Imagenes de Cirque du Soleil * */
            $id_parque = 22;
            $cs = Doo::db()->find("Imagenes_parques", array("asc" => "orden", "where" => "id_parques = ? ", "param" => array($id_parque)));

            $html_img = "";
            if (!empty($cs)) {
                $contador_img = 1;
                foreach ($cs as $values_img) {
                    if ($contador_img == 1) {
                        $html_img .= '<a class="galeria" title="' . $values_img->descripcion . '" data-lightbox-gallery="' . $id_parque . '" href="' . Doo::conf()->APP_URL . 'global/' . $values_img->ruta_resize . '"> <img  src="' . Doo::conf()->APP_URL . 'global/img/afp-cds.png"/></a>';
                    } else {
                        $html_img .= '<a class="galeria" style="display:none;" title="' . $values_img->descripcion . '" href="' . Doo::conf()->APP_URL . 'global/' . $values_img->ruta_resize . '" data-lightbox-gallery="' . $id_parque . '"></a>';
                    }
                    $contador_img++;
                }
            } else {
                $html_img .= '<img  src="' . Doo::conf()->APP_URL . 'global/img/afp-cds.png"/>';
            }
            $this->data["cs"] = $html_img;
            /** Fin Cirque du Soleil */
            /** Imagenes de Orlando Premium Outlet Mall * */
            $id_parque = 23;
            $op = Doo::db()->find("Imagenes_parques", array("asc" => "orden", "where" => "id_parques = ? ", "param" => array($id_parque)));

            $html_img = "";
            if (!empty($op)) {
                $contador_img = 1;
                foreach ($op as $values_img) {
                    if ($contador_img == 1) {
                        $html_img .= '<a class="galeria" title="' . $values_img->descripcion . '" data-lightbox-gallery="' . $id_parque . '" href="' . Doo::conf()->APP_URL . 'global/' . $values_img->ruta_resize . '"> <img  src="' . Doo::conf()->APP_URL . 'global/img/fdst-opom.png"/></a>';
                    } else {
                        $html_img .= '<a class="galeria" style="display:none;" title="' . $values_img->descripcion . '" href="' . Doo::conf()->APP_URL . 'global/' . $values_img->ruta_resize . '" data-lightbox-gallery="' . $id_parque . '"></a>';
                    }
                    $contador_img++;
                }
            } else {
                $html_img .= '<img  src="' . Doo::conf()->APP_URL . 'global/img/fdst-opom.png"/>';
            }
            $this->data["op"] = $html_img;
            /** Fin Orlando Premium Outlet Mall */
            $_SESSION['step_onedaytour_two'] = true;
            $this->renderc('/tours/2-one-day-tour', $this->data);
        } else {
            return Doo::conf()->APP_URL . "one-day-tour";
        }
    }

    public function onedaytour_two2() {

        extract($_POST, EXTR_SKIP);
        $toursbooking = $_SESSION ["toursbooking"];
        $fecha = substr($toursbooking['fecha_llegada'], 0, 4) . '-01-01 00:00:00';
        $totaladult = $txtAdults;
        $totalchild = $txtChild;
        $totalpax = $totaladult + $totalchild;
        Doo::loadModel("Agency");
        if (isset($_SESSION['data_agency'])) {
            $dat = new Agency($_SESSION['data_agency']);
            $type = $dat->type_rate;
        } else {
            $dat = new Agency();
            $dat->type_rate = 0;
            $dat->id = -1;
        }
        // /////////////////////////////////services
        if (isset($toursbooking ['trip1'])) {
            if ($dat->type_rate == 1) {// Se busca SpecialNet
                $sql = 'SELECT onet.priceadult,
                              onet.pricechild                              
                                     FROM  onetour onet 
						WHERE onet.type_rate = ? AND id_agency = ? AND annio = ?';
                $type = 2;
                $rs = Doo::db()->query($sql, array($type, $dat->id, $fecha));
                $prices = $rs->fetch();

                if (empty($prices)) {//Si no encuentra Buscamos Net.
                    $sql = 'SELECT onet.priceadult,
                                   onet.pricechild
                                   FROM  onetour onet 
						WHERE onet.type_rate = ? AND annio = ?';
                    $type = 1;
                    $rs = Doo::db()->query($sql, array($dat->type_rate, $fecha));
                    $prices = $rs->fetch();
                    $_SESSION ['toursbooking'] ['especial'] = false;
                } else {
                    $_SESSION ['toursbooking'] ['especial'] = true;
                }
            } else {//Buscamos Comi
                $sql = 'SELECT onet.priceadult, onet.pricechild	FROM  onetour onet WHERE onet.type_rate = ? AND annio = ?';
                $type = 0;
                $rs = Doo::db()->query($sql, array($dat->type_rate, $fecha));
                $prices = $rs->fetch();
            }
            if (!empty($prices)) {
                $priceadult = $prices ['priceadult'] * $totaladult;
                $pricechild = $prices ['pricechild'] * $totalchild;
                $trip1 = number_format($priceadult, 2, '.', '') + number_format($pricechild, 2, '.', '');
            } else {
                $priceadult = 0;
                $pricechild = 0;
            }
        } else {
            $trip1 = 0;
            $priceadult = 0;
            $pricechild = 0;
        }



        $tq = $trip1;

        // //////////////////////////////////cierre services transporte
        $_SESSION ['toursbooking'] ['tsa'] = $tq;
        $_SESSION['toursbooking']['tq'] = $tq; // total a pagar
        $_SESSION['toursbooking']['tqp'] = $tq / $totalpax; // total por personas
        $_SESSION ['toursbooking'] ['np'] = 0;
        $_SESSION ["toursbooking"] ["adults"] = $totaladult;
        $_SESSION ["toursbooking"] ["childs"] = $totalchild;

        $_SESSION ["toursbooking"] ["priceadults"] = $priceadult;
        $_SESSION ["toursbooking"] ["pricechilds"] = $pricechild;
        $_SESSION ["toursbooking"] ["totalpax"] = $totalpax;
        $_SESSION ["toursbooking"] ["totaltotal"] = number_format(($totalpax * $_SESSION['toursbooking']['tqp']), 2, '.', '');
    }

    public function onedaytour_four() {
        if (isset($_SESSION ['toursbooking'] ['paso'])) {
            unset($_SESSION ['toursbooking'] ['paso']);
        }
        $post = $_POST;
        $parkes = array();
        $namepark = array();



        if (isset($_POST ['question'])) {
            if ($_POST ['question'] == 1) {

                $_SESSION ['toursbooking'] ['ticketpark'] = 1;
            }
            if ($_POST ['question'] == 0) {
                $_SESSION ['toursbooking'] ['ticketpark'] = 0;
            }
        }

        $contador = 0;
        foreach ($post as $valor) {
            if (strlen($valor) > 1) {
                list ($park, $grupo) = explode(",", $valor);
                $parkes [$contador] = $park;
            }
            $contador++;
        }

        $contador = 0;
        $sql = "SELECT nombre
							FROM parques 
								WHERE id = ?";

        foreach ($parkes as $valor) {

            $rs = Doo::db()->query($sql, array(
                $valor
            ));

            $consulta = $rs->fetch();

            $namepark [$contador] = $consulta ['nombre'];
            $contador++;
        }

        $_SESSION ['namepark'] = $namepark;
        return Doo::conf()->APP_URL . "tours/confirmation_onedaytouy";
    }

    public function onedaytour_step_three() {

        if (isset($_SESSION['step-two']) && isset($_SESSION ['toursbooking'])) {
            $_SESSION['num'] = 0;
            $_SESSION['var'] = '';
            try {
                if (isset($_SESSION ['toursbooking'] ['parktotal'])) {
                    unset($_SESSION ['toursbooking'] ['parktotal']);
                }
                if (isset($_SESSION ['toursbooking'] ['tqp'])) {

                    unset($_SESSION ['toursbooking'] ['tqp']);
                }

                if (isset($_SESSION ['grupos'])) {
                    unset($_SESSION ['grupos']);
                }
                if (isset($_SESSION ['grupos1'])) {
                    unset($_SESSION ['grupos1']);
                }
                if (isset($_SESSION ['toursbooking'] ['ticketpark'])) {
                    unset($_SESSION ['toursbooking'] ['ticketpark']);
                }

                if (isset($_SESSION ['toursbooking'] ['ticketpark'])) {
                    unset($_SESSION ['toursbooking'] ['paso']);
                }

                $this->data ['rootUrl'] = Doo::conf()->APP_URL;
                // print_r($_SESSION["toursbooking"]);
                // echo $_SESSION['toursbooking']['tq']; 
                $this->renderc('/tours/2-one-day-tour.php', $this->data);
                $_SESSION ['toursbooking'] ['tqp'] = $_SESSION ['toursbooking'] ['tqp1'];
            } catch (Exception $e) {
                return Doo::conf()->APP_URL . "one-day-tour/";
                // procedimiento en caso de reportar errores
            }
        } else {
            return Doo::conf()->APP_URL . "tours/";
        }
    }

    public function onedaytour_confirma() {
        Doo::loadModel("Agency");
        if (isset($_SESSION['data_agency'])) {
            $dat = new Agency($_SESSION['data_agency']);
            $comision = $this->cal_equipament();
            if ($dat->type_rate == 0) {
                $_SESSION ['toursbooking'] ['comision_agency'] = ($_SESSION ['toursbooking'] ['tsa'] * $_SESSION['toursbooking']['totalpax'] * ($comision / 100));
            } else {
                $_SESSION ['toursbooking'] ['comision_agency'] = 0;
            }
            Doo::loadController("AgenciaController");
            $agenControl = new AgenciaController();
            $disponible = $agenControl->iscredit();
        } else {
            $_SESSION ['toursbooking']['comision_agency'] = 0;
            $dat = new Agency();
            $dat->type_rate = 0;
            $dat->id = -1;
            $disponible = 0;
        }

        $this->data ['rootUrl'] = Doo::conf()->APP_URL;
        Doo::loadController('admin/ToursOneController');
        $toursOneControl = new ToursOneController();
        $_SESSION['codconf'] = $toursOneControl->codigoConf(1);

        if (!isset($_SESSION ['toursbooking'] ['ticketpark'])) {
            return Doo::conf()->APP_URL . "tours/onedaytour_step_three";
        }
        #cotizacion 
        try {
            $contenido .= print_r($_SESSION, true);
            $contenido .= "<span style='color:red;'>Cotizacion Tours One-days</span>";
            $mail = new PHPMailer();
            $mail->IsSMTP();
            $correo_emisor = "websales@supertours.com";
            $nombre_emisor = "Supertours Of Orlando";
            $contrasena = "Daniel4";
            //$mail->SMTPDebug  = 2;                  
            $mail->SMTPAuth = true;
            //$mail->SMTPSecure = "tsl";                
            $mail->SMTPSecure = "ssl";
            $mail->Host = "smtpout.secureserver.net";
            $mail->Port = 465;
            $mail->Username = $correo_emisor;
            $mail->Password = $contrasena;
            //$mail->AddReplyTo($correo_emisor, $nombre_emisor);
            $mail->SetFrom("no_reply@supertours.com", $nombre_emisor);
            $mail->Subject = 'Supertours Of Orlando, Cotizacion Tours One-days -' . date("d-m-Y h:i:s");
            $mail->AltBody = 'Supertours Of Orlando, Cotizacion Tours One-days -' . date("d-m-Y h:i:s");
            $mail->AddAddress("henry@supertours.com", "");
            $mail->MsgHTML($contenido);
            $mail->Send();
        } catch (phpmailerException $e) {
            echo $e->errorMessage(); // Errores de PhpMailer
        } catch (Exception $e) {
            echo $e->getMessage(); // Errores de cualquier otra cosa.
        }
        #fin de cotizacion
        $this->data['disponible'] = $disponible;
        $this->data['dat'] = $dat;
        $this->renderc('/tours/shoproute_onedaytour', $this->data);
    }

    /*
      Seleccionar el trip para tour de un dia.
     */

    public function selectTrip() {
        if (isset($this->params ["sentido"])) {
            $sentido = $this->params ["sentido"];
        }
        if (isset($this->params ["idArea"])) {
            $idArea = $this->params ["idArea"];
        }
        if (isset($this->params ["fechaS"])) {
            $fechaS = $this->params ["fechaS"];
        }
        if (isset($this->params ["totalpax"])) {
            $totalpax = $this->params ["totalpax"];
        } else {
            $totalpax = 1;
        }

        list ($mes, $dia, $anyo) = explode("-", $fechaS);
        $fecha2 = $anyo . "-" . $mes . "-" . $dia;
        //echo date('Y-m-d h:i A');
        $f0 = strtotime(date('Y-m-d h:i A'));
        $f1 = strtotime($fecha2);
        $resultado = ($f1 - $f0);
        $resultado = ($resultado / 60 / 60);
        $resultado = round($resultado);
        if ($resultado > 2) {
            $tiempo = true;
            $mensaje = '';
        } else {
            $tiempo = false;
            $mensaje = "The maximum period for reservation of one-day-tours be until 10:00 PM the day prior to the date of departure";
        }
        $url = Doo::conf()->APP_URL;
        if ($sentido == 1) {// Salida
            $type = 0; // sin Agencia
            $sql = 'SELECT p.trip_no, r.id, p.fecha,  a1.nombre AS trip_from,  a2.nombre AS trip_to,  r.trip_departure,  r.trip_arrival, t.equipment, p.estado, r.type_rate  
		 FROM programacion p LEFT JOIN routes r ON (p.trip_no = r.trip_no)  
                             LEFT JOIN trips  t ON (p.trip_no = t.trip_no)
                             LEFT JOIN areas  a1 ON (r.trip_from = a1.id)
                             LEFT JOIN areas  a2 ON  (r.trip_to  = a2.id)
		 WHERE p.trip_no = "301"  
			AND r.trip_to = "1"
			AND r.trip_departure > "" 
			AND p.estado = "1" 
			AND p.trip_no = "301" 
			AND r.type_rate = ? 
			AND r.`trip_from` = ? 
			AND  p.fecha = ?
  ORDER BY r.trip_departure ASC';
            $rs = Doo::db()->query($sql, array(
                $type, $idArea, $fechaS
            ));
            $llegada = $rs->fetchAll();
            echo '<br><br> <div align="center" >
		 <table width="100%" class="table2 table-bordered table-striped">
		 		<thead>
					<tr>
						 <th width="10%">Trip</th>
						 <th width="25%">Departure</th>
						 <th width="25%">Arrive</th>
						 <th width="30%">Equipment</th>
				   </tr>
				</thead>';
            $num = count($llegada);
            if ($num > 0 && $tiempo) {
                $e = $llegada[0];
                Doo::loadController('MainController');
                $main = new MainController();
                $disponible1 = $main->disponible('301', $fecha2);

                if ($totalpax > $disponible1) {

                    echo '  <tr class="nodisponible" title="Trip not available">';
                    echo '	<td width="10%" >301</td>';
                } else {
                    echo '  <tr class="">';
                    echo '	<td width="10%" >301
								<input type="hidden" name="trip1" id="trip1"  value="301"  class="trip1"/>
								<input name="sarrival" type="hidden"  value="1"/>
							</td>';
                }
                if (isset($e)) {
                    echo '			
								<td>' . date("g:i A", strtotime($e['trip_departure'])) . '</td>
								<td>' . date("g:i A", strtotime($e ['trip_arrival'])) . '</td>
								<td width="30%" >BUS</td>
							</tr>';
                } else {
                    echo '<script>$(function(){ $("#fecha_salida").val(""); alert("no trips for this date") 
                                           $("#from").val(0); $("#to2").val(0);
                                            })
                                           </script>';
                }
            } else {
                echo '<tr>
								<td colspan="7">
								<input type="hidden" name="trip1" id="trip1"  value="-1"  class="trip1"/>
								No tours available</td> 
							  </tr> ';
            }
            if (isset($e)) {
                echo ' </table>
				 <b style="color:#F00" >' . $mensaje . '</b>
                                     <input type="hidden" value = "' . date("H:i", strtotime($e['trip_departure'])) . '" id="deptime1" name="deptime1">
                                     <input type="hidden" value = "' . date("H:i", strtotime($e['trip_arrival'])) . '" id="arrtime1" name="arrtime1">
				 </div>
				 ';
            } else {
                echo '<script>$(function(){ $("#fecha_salida").val(""); alert("no trips for this date") 
                                           $("#from").val(0); $("#to2").val(0);
                                            })
                                           </script>';
            }
        } else if ($sentido == 2) {
            $type = 0; // sin Agencia 
            $sql = 'SELECT p.trip_no, r.id, p.fecha,  a1.nombre AS trip_from,  a2.nombre AS trip_to,  r.trip_departure,  r.trip_arrival, t.equipment, p.estado, r.type_rate  
				FROM programacion p 
                                LEFT JOIN routes r ON (p.trip_no = r.trip_no)  
                             LEFT JOIN trips  t ON (p.trip_no = t.trip_no)
                             LEFT JOIN areas  a1 ON (r.trip_from = a1.id)
                             LEFT JOIN areas  a2 ON  (r.trip_to  = a2.id)
				 WHERE p.trip_no = "300"  
					AND r.`trip_from` =  "1"
					AND r.trip_departure >  ""
					AND p.estado =  "1"
					AND r.type_rate =  ?
					AND r.trip_to =  ?
					AND  p.fecha = ?
		  ORDER BY r.trip_departure ASC';
            $rs = Doo::db()->query($sql, array(
                $type, $idArea, $fechaS
            ));
            echo '<br><br><div align="center" > <table width="100%" class="table2 table-bordered table-striped">
		 		<thead>
					<tr>
						 <th width="10%">Trip</th>
						  <th width="25%">Departure</th>
						 <th width="25%">Arrive</th>
						 <th width="40%">Equipment</th>
				   </tr>
				</thead>';
            $salida = $rs->fetchAll();
            $num = count($salida);
            if ($num > 0 && $tiempo) {
                $e = $salida[0];
                Doo::loadController('MainController');
                $main = new MainController();
                $disponible1 = $main->disponible('301', $fecha2);
                if ($totalpax > $disponible1) {
                    echo '  <tr class="nodisponible">';
                    echo '	<td width="10%" >301</td>';
                } else {
                    echo '  <tr class="">';
                    echo '	<td width="10%" >300
									<input type="hidden" name="trip2" id="trip2"  value="300"  class="trip2"/>
								<input name="sdeparture" type="hidden"  value="1"/>
								</td>';
                }

                echo ' <td>' . date("g:i A", strtotime($e['trip_departure'])) . '</td>
								<td>' . date("g:i A", strtotime($e['trip_arrival'])) . '</td>
								<td width="40%" >BUS</td>
							</tr>';
            } else {
                echo '<tr>
								<td colspan="7">
								<input type="hidden" name="trip2" id="trip2"  value="-1"  class="trip1"/>
								No tours available</td> 
							  </tr> ';
            }
            if (isset($e)) {
                echo ' </table>
                     <input type="hidden" value = "' . date("H:i", strtotime($e['trip_departure'])) . '" id="deptime2" name="deptime2" />
                     <input type="hidden" value = "' . date("H:i", strtotime($e['trip_arrival'])) . '" id="arrtime2" name="arrtime2" />
				 </div> 
                    ';
            }
        }
    }

    public function selectArea() {

        if (isset($_SESSION['data_agency'])) {
            Doo::loadModel("Agency");
            $dat = new Agency($_SESSION['data_agency']);
        } else {
            Doo::loadModel("Agency");
            $dat = new Agency();
            $dat->id = -1;
        }
        //Tipo de pickup_dropoff;
        if ($dat->id == -1) {
            $type_web = 1;
        } else {
            $type_web = 0;
        }
        $id = $this->params ['id'];
        $idArea = $this->params ['idArea'];
        $sql = "SELECT DISTINCT t1.trip_to, t2.nombre  FROM routes t1
                LEFT JOIN areas t2 ON (t1.trip_to = t2.id)
                WHERE t1.type_rate = 0 and t1.trip_from = 1 ";
        $sql2 = "SELECT id,place,address
FROM pickup_dropoff
WHERE id_area = ? AND type_web = ? ORDER BY id ASC";

        $rs = Doo::db()->query($sql);
        $rs2 = Doo::db()->query($sql2, array(
            9, $type_web
        ));
        $rs3 = Doo::db()->query($sql2, array(
            1, $type_web
        ));
        $pickupdropof = $rs2->fetchAll();
        $areas = $rs->fetchAll();
        $pikuporlando = $rs3->fetchAll();
        if ($id == 0) {
            echo '<script> $("#pickups").css("display", "block"); </script>';
            echo "<table width='80%' border='0' cellspacing='1' aling='center'>
  <tr>
    <td width='20%'>Area:</td>
    <td width='20%'>";
            echo "<select name='area' id='area'>";
            foreach ($areas as $e) {
                echo '<option value="' . $e ['trip_to'] . '" ' . (($idArea == $e ['trip_to']) ? 'selected' : '') . ' >' . $e ['nombre'] . '</option>';
            }

            echo "</select>";
            echo "</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>Pickup Point:</td>
    <td>";
            echo "<select name='pickup' id='pickup' style='width:195px;'>";
            foreach ($pickupdropof as $e) {
                echo '<option value="' . $e ['id'] . '"  >' . $e ['place'] . '  ' . $e ['address'] . '</option>';
            }

            echo "</select>";
            echo "</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <!--tr>
    <td>Drop Off Point: </td>
    <td>";

            // gropoff orlando
            echo "<select name='pickup' id='pickup' style='width:195px;'>";
            foreach ($pikuporlando as $e) {

                echo '<option value="' . $e ['id'] . '"  >' . $e ['place'] . '  ' . $e ['address'] . '</option>';
            }

            echo "</select>";
            echo "</td>
  </tr-->
</table>";

            $url = Doo::conf()->APP_URL;

            echo '<script>
	
$("#area").change(function() {			

	var id = $(this).val();	  
	$("#area2").attr("value",id);
				
	$("#pickup").load("' . $url . 'tours/question15/" + id );
	$("#pickup2").load("' . $url . 'tours/question15/" + id );
	var sentido = 1;
	var idArea = $(this).val();
	var fechaS = $("#txtfecha_salida").val();
	 var opcionPickup = 0;
    $("#trip1_onedaytour").load("' . $url . 'tours/onedaytour/" + sentido +"/"+ idArea +"/"+ fechaS +"/"+ opcionPickup);
	var sentido = 2;
	$("#trip2_onedaytour").load("' . $url . 'tours/onedaytour/" + sentido +"/"+ idArea +"/"+ fechaS +"/"+ opcionPickup);
			
});
</script>';
        } else {
            echo '<script>$("#conte2").css("display", "none");$("#pickups2").css("display", "block"); </script>';

            // ////////////

            echo "<table width='80%' border='0' cellspacing='1' aling='center'>
  <tr>
    <td width='20%'>Area:</td>
    <td width='20%'>";
            echo "<select name='area2' id='area2'>";
            foreach ($areas as $e) {
                echo '<option value="' . $e ['trip_to'] . '" ' . (($idArea == $e ['trip_to']) ? 'selected' : '') . ' >' . $e ['nombre'] . '</option>';
            }

            echo "</select>";
            echo "</td>
  </tr>
  <!--tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr-->
  <!--tr>
    <td>Pickup Point:</td>
    <td>";
            echo "<select name='pickup2' id='pickup' style='width:195px;'>";
            foreach ($pikuporlando as $e) {
                echo '<option value="' . $e ['id'] . '"  >' . $e ['place'] . '  ' . $e ['address'] . '</option>';
            }

            echo "</select>";
            echo "</td>
  </tr-->
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>Drop Off Point:</td>
    <td>";

            // gropoff area escogida
            echo "<select name='pickup2' id='pickup2' style='width:195px;'>";
            foreach ($pickupdropof as $e) {
                echo '<option value="' . $e ['id'] . '"  >' . $e ['place'] . '  ' . $e ['address'] . '</option>';
            }

            echo "</select>";
            echo "</td>
  </tr>
</table>";
            $url = Doo::conf()->APP_URL;
            echo '<script>
	
			$("#area2").change(function() {
			   var id = $(this).val();
			   $("#pickup2").load("' . $url . 'tours/question15/" + id );
			   var sentido = 2;
			   var idArea = id;
			   var sentido = 2;
			   var opcionPickup = 0;
			$("#trip2_onedaytour").load("' . $url . 'tours/onedaytour/" + sentido +"/"+ idArea +"/"+ fechaS +"/" opcionPickup);
			});
</script>';
        }
    }

    public function ajaxparks_onedaytour() {
        try {

            $tikes = $this->params ["resp"];

            $toursbooking = $_SESSION ["toursbooking"];

            $fecha = substr($toursbooking['fecha_salida'], 0, 4) . '-01-01 00:00:00';

            if (isset($_SESSION ['toursbooking'] ['ticketpark'])) {
                unset($_SESSION ['toursbooking'] ['ticketpark']);
            }

            $arreglo = array();
            if (isset($this->params ["id"])) {
                $dato = $this->params ["id"];
                list ($park, $grupo) = explode(",", $dato);
                $dato = $park;
            }

            if (isset($this->params ["ides"])) {

                $dato = $this->params ["ides"];
                list ($park, $grupo) = explode(",", $dato);

                $dato = $park;
            }
            /** Codigo para que el parke kennedy space cter, para  este parque es necesario como minimo 2 pasajeros* */
            if ($dato == 19) {
                if ($_SESSION ['toursbooking'] ['totalpax'] < 2) {

                    echo "<script>$('#tqp').html('$" . round($_SESSION ['toursbooking'] ['tqp']) . "');</script>";
                    echo "<script>$('#" . $dato . "').remove();</script>";
                    echo '<script type="text/javascript">
                         $("input[type=\'checkbox\'").attr("checked",false).change();
                      $("#dialog-message-new").dialog({
                                    modal: true,
                                    buttons: {
                                    Ok: function() {  $( this ).dialog( "close" );  }
                                    }
                                }); 
                                
                      </script>';
                    exit;
                }
            }
            /*             * **** ***************** */

            $sql = 'SELECT t1.id,t1.nombre,t2.nombre AS grupo,t3.adult,t3.child
										FROM parques t1
										LEFT JOIN grupo_parques t2 ON (t1.id_grupo = t2.id)
										LEFT JOIN parques_tarifasgrupo t3 ON (t1.id_grupo = t3.id_grupo)
									    WHERE t1.id = ?';

            $rs = Doo::db()->query($sql, array(
                $dato
            ));

            $parkdatos = $rs->fetch();
            /* print_r(Doo::db()->showSQL());
              exit; */
            if (isset($this->params ["ides"])) {
                $park = $this->params ["ides"];

                if ($parkdatos ['adult'] && $parkdatos ['child']) {
                    $tqp = ($toursbooking ['tq'] / $toursbooking ['totalpax']) + ($_SESSION ['toursbooking'] ['parktotal'] / $toursbooking ['totalpax']);
                    $_SESSION ['toursbooking'] ['ticketpark'] = 0;
                    $_SESSION ['toursbooking'] ['np'] = 0;
                    /* $this->tours_tow_onedaytour(); */
                    if ($tikes == 1) {
                        $sumatike = $_SESSION ['toursbooking'] ['ticketpark'] / $_SESSION ['toursbooking'] ['totalpax'];
                    } else {
                        $sumatike = 0;
                    }
                    $_SESSION ['toursbooking'] ['tsa'] = $tqp;
                    $_SESSION ['toursbooking'] ['tqp'] = ($_SESSION ['toursbooking'] ['ticketpark'] + $_SESSION ['toursbooking'] ['tq']) / $toursbooking ['totalpax'];
                    echo "<script>$('#tqp').html('$" . round($_SESSION ['toursbooking'] ['tqp']) . "');</script>";
                    echo "<script>$('#" . $dato . "').remove();</script>";
                }
            } else {


                if (!isset($_SESSION ['toursbooking'] ['parktotal'])) {
                    $_SESSION ['toursbooking'] ['parktotal'] = 0;
                }
                if ($parkdatos ['adult'] && $parkdatos ['child']) {
                    $especial = false;
                    $_SESSION ['toursbooking'] ['parktotal'] = 1;
                    $_SESSION ['grupos'] ['id'] = $grupo;
                    $_SESSION ['grupos']['idParque'] = $dato;
                    $_SESSION ['toursbooking'] ['np'] = 1;
                    $this->tours_tow_onedaytour();
                    if ($tikes == 1) {
                        $sumatike = $_SESSION ['toursbooking'] ['ticketpark'];
                        $_SESSION ['toursbooking'] ['paso'] = "";
                    } else {
                        $sumatike = 0;
                    }


                    $toursbooking = $_SESSION ["toursbooking"];
                    $fecha = substr($toursbooking['fecha_llegada'], 0, 4) . '-01-01 00:00:00';
                    $totaladult = $toursbooking["adults"];
                    $totalchild = $toursbooking["childs"];
                    $totalpax = $totaladult + $totalchild;
                    Doo::loadModel("Agency");
                    if (isset($_SESSION['data_agency'])) {
                        $dat = new Agency($_SESSION['data_agency']);
                        $type = $dat->type_rate;
                    } else {
                        $dat = new Agency();
                        $dat->type_rate = 0;
                        $dat->id = -1;
                    }
                    // /////////////////////////////////services
                    if (isset($toursbooking ['trip1'])) {
                        if ($dat->type_rate == 1) {// Se busca SpecialNet
                            $sql = 'SELECT onet.priceadult,
                                    onet.pricechild,
                                    onet.suplemag_adult,
                                    onet.suplemag_child,
                                    onet.suplepcot_adult,
                                    onet.suplepcot_child,
                                    onet.suplehollywood_adult,
                                    onet.suplehollywood_child,
                                    onet.supleanimalk_adult,
                                    onet.supleanimalk_child,
                                    onet.suplemuniv_adult,
                                    onet.suplemuniv_child,
                                    onet.suplemisland_adult,
                                    onet.suplemisland_child,
                                    onet.suplemseaw_adult,
                                    onet.suplemseaw_child,
                                    onet.suplemaquat_adult,
                                    onet.suplemaquat_child,
                                    onet.suplemwetn_adult,
                                    onet.suplemwetn_child,
                                    onet.suplembliz_adult,
                                    onet.suplembliz_child,
                                    onet.suplemkennedy_adult,
                                    onet.suplemkennedy_child,
                                    onet.suplemholy_adult,
                                    onet.suplemholy_child
                                    FROM  onetour onet 
						WHERE onet.type_rate = ? AND id_agency = ? AND annio = ?';
                            $type = 2;
                            $rs = Doo::db()->query($sql, array($type, $dat->id, $fecha));
                            $prices = $rs->fetch();

                            if (empty($prices)) {//Si no encuentra Buscamos Net.
                                $sql = 'SELECT onet.priceadult, onet.pricechild,onet.pricechild,
                                    onet.suplemag_adult,
                                    onet.suplemag_child,
                                    onet.suplepcot_adult,
                                    onet.suplepcot_child,
                                    onet.suplehollywood_adult,
                                    onet.suplehollywood_child,
                                    onet.supleanimalk_adult,
                                    onet.supleanimalk_child,
                                    onet.suplemuniv_adult,
                                    onet.suplemuniv_child,
                                    onet.suplemisland_adult,
                                    onet.suplemisland_child,
                                    onet.suplemseaw_adult,
                                    onet.suplemseaw_child,
                                    onet.suplemaquat_adult,
                                    onet.suplemaquat_child,
                                    onet.suplemwetn_adult,
                                    onet.suplemwetn_child,
                                    onet.suplembliz_adult,
                                    onet.suplembliz_child,
                                    onet.suplemkennedy_adult,
                                    onet.suplemkennedy_child,
                                    onet.suplemholy_adult,
                                    onet.suplemholy_child	FROM  onetour onet 
						WHERE onet.type_rate = ? AND annio = ?';
                                $type = 1;
                                $rs = Doo::db()->query($sql, array($dat->type_rate, $fecha));
                                $prices = $rs->fetch();
                            } else {
                                $especial = true;
                            }
                        } else {//Buscamos Comi
                            $sql = 'SELECT onet.priceadult, onet.pricechild,onet.pricechild,
                                    onet.suplemag_adult,
                                    onet.suplemag_child,
                                    onet.suplepcot_adult,
                                    onet.suplepcot_child,
                                    onet.suplehollywood_adult,
                                    onet.suplehollywood_child,
                                    onet.supleanimalk_adult,
                                    onet.supleanimalk_child,
                                    onet.suplemuniv_adult,
                                    onet.suplemuniv_child,
                                    onet.suplemisland_adult,
                                    onet.suplemisland_child,
                                    onet.suplemseaw_adult,
                                    onet.suplemseaw_child,
                                    onet.suplemaquat_adult,
                                    onet.suplemaquat_child,
                                    onet.suplemwetn_adult,
                                    onet.suplemwetn_child,
                                    onet.suplembliz_adult,
                                    onet.suplembliz_child,
                                    onet.suplemkennedy_adult,
                                    onet.suplemkennedy_child,
                                    onet.suplemholy_adult,
                                    onet.suplemholy_child	FROM  onetour onet WHERE onet.type_rate = ? AND annio = ?';
                            $type = 0;
                            $rs = Doo::db()->query($sql, array($dat->type_rate, $fecha));
                            $prices = $rs->fetch();
                        }

                        if (!empty($prices)) {
                            $priceadult = $prices ['priceadult'] * $totaladult;
                            $pricechild = $prices ['pricechild'] * $totalchild;
                            $trip1 = number_format($priceadult, 2, '.', '') + number_format($pricechild, 2, '.', '');
                        } else {
                            $priceadult = 0;
                            $pricechild = 0;
                        }
                    } else {
                        $trip1 = 0;
                        $priceadult = 0;
                        $pricechild = 0;
                    }

                    if ($especial) {

                        $tq = $trip1;

                        // //////////////////////////////////cierre services transporte
                        $_SESSION ['toursbooking'] ['tsa'] = $tq;
                        $_SESSION['toursbooking']['tq'] = $tq; // total a pagar
                        $_SESSION['toursbooking']['tqp'] = $tq / $totalpax; // total por personas
                        $_SESSION ['toursbooking'] ['np'] = 0;
                        $_SESSION ["toursbooking"] ["adults"] = $totaladult;
                        $_SESSION ["toursbooking"] ["childs"] = $totalchild;
                        $_SESSION ["toursbooking"] ["priceadults"] = $priceadult;
                        $_SESSION ["toursbooking"] ["pricechilds"] = $pricechild;
                        $_SESSION ["toursbooking"] ["totalpax"] = $totalpax;
                        $_SESSION ["toursbooking"] ["totaltotal"] = number_format(($totalpax * $_SESSION['toursbooking']['tqp']), 2, '.', '');

                        $array_parks_asoc_price_adult = array(7 => $prices["suplemag_adult"],
                            8 => $prices["suplepcot_adult"],
                            9 => $prices["suplehollywood_adult"],
                            10 => $prices["supleanimalk_adult"],
                            14 => $prices["suplemuniv_adult"],
                            15 => $prices["suplemisland_adult"],
                            11 => $prices["suplemseaw_adult"],
                            13 => $prices["suplemaquat_adult"],
                            16 => $prices["suplemwetn_adult"],
                            17 => $prices["suplembliz_adult"],
                            19 => $prices["suplemkennedy_adult"],
                            20 => $prices["suplemholy_adult"]);

                        $array_parks_asoc_price_child = array(7 => $prices["suplemag_child"],
                            8 => $prices["suplepcot_child"],
                            9 => $prices["suplehollywood_child"],
                            10 => $prices["supleanimalk_child"],
                            14 => $prices["suplemuniv_child"],
                            15 => $prices["suplemisland_child"],
                            11 => $prices["suplemseaw_child"],
                            13 => $prices["suplemaquat_child"],
                            16 => $prices["suplemwetn_child"],
                            17 => $prices["suplembliz_child"],
                            19 => $prices["suplemkennedy_child"],
                            20 => $prices["suplemholy_child"]);

                        if ($especial) {
                            $sumatike = ($array_parks_asoc_price_adult[$dato] * $totaladult) + ($array_parks_asoc_price_child[$dato] * $totalchild);
                        }
                        $_SESSION ['toursbooking'] ['ticketpark'] = 1;
                    }
                    if ($dato == '19' && $especial == false) {//transport local une day
                        $tranposrLocal = 60 * $toursbooking ['totalpax'];
                        $_SESSION ['toursbooking'] ['tranposrLocal'] = $tranposrLocal;
                        //////////////// **** ///// *** 
                    } else {
                        $tranposrLocal = 0;
                        $_SESSION ['toursbooking'] ['tranposrLocal'] = $tranposrLocal;
                    }

                    // print_r($_SESSION['grupos']);
                    $_SESSION ['toursbooking'] ['tqp'] = ($sumatike + $_SESSION ['toursbooking'] ['tq'] + $_SESSION ['toursbooking'] ['tranposrLocal']) / $toursbooking ['totalpax'];
                    $_SESSION ['toursbooking'] ['tsa'] = $_SESSION ['toursbooking'] ['tqp'];
                    echo "<script>$('#tqp').html('$" . round($_SESSION ['toursbooking'] ['tqp']) . "');</script>";
                    echo "<script>$('#" . $dato . "').remove();</script>";
                    //print_r($_SESSION ['toursbooking']);
                }

                echo "<script>$('#attractions2').append('<p id=" . $dato . ">" . $parkdatos ['nombre'] . "</p>');</script>";
            }
        } catch (Exception $e) {

            // procedimiento en caso de reportar errores
        }
    }

    /*
      Agregar tiquete a la factura de one day tour
     */

    public function ques_agregarTiquete() {
        $pregunta = $this->params ["resp"];
        if ($pregunta == 1) {
            $this->tours_tow_onedaytour();
            $sumatike = $_SESSION ['toursbooking'] ['ticketpark'];
            $_SESSION ['toursbooking'] ['tqp'] = ($_SESSION ['toursbooking'] ['tq'] + $sumatike + $_SESSION ['toursbooking'] ['tranposrLocal']) / $_SESSION ['toursbooking'] ['totalpax'];
            $_SESSION ['toursbooking'] ['paso'] = "";
            echo "<script>$('#tickes').html('INCLUDED in tour price ');$('#tqp').html('$" . round($_SESSION ['toursbooking'] ['tqp']) . "');";
        } else {
            $this->tours_tow_onedaytour();
            if (isset($_SESSION ['toursbooking'] ['paso'])) {
                $_SESSION ['toursbooking'] ['tqp'] = ($_SESSION ['toursbooking'] ['tq'] + $_SESSION ['toursbooking'] ['tranposrLocal']) / $_SESSION ['toursbooking'] ['totalpax'];
                unset($_SESSION ['toursbooking'] ['paso']);
                echo "<script>$('#tickes').html('NOT INCLUDED in tour price ');$('#tqp').html('$" . round($_SESSION ['toursbooking'] ['tqp']) . "');</script>";
            }
        }
    }

    public function tours_tow_onedaytour() {
        try {
            unset($_SESSION ['toursbooking'] ['ticketpark']);

            $_SESSION ['toursbooking'] ['ticketpark'] = 0;

            extract($_POST, EXTR_SKIP);

            $fecha = substr($_SESSION['toursbooking']['fecha_llegada'], 0, 4) . '-01-01 00:00:00';

            Doo::loadModel("Agency");
            if (isset($_SESSION['data_agency'])) {
                $dat = new Agency($_SESSION['data_agency']);
            } else {
                $dat = new Agency();
                $net_rate = false;
                $dat->type_rate = 0;
                $dat->id = -1;
            }
            $divporpax = 0;
            if ($_SESSION ['toursbooking'] ['np'] == 0 && $_SESSION ['toursbooking'] ['parktotal'] == 1) {
                $_SESSION['toursbooking']['ticketpark'] = 0;
                $divporpax = 0;
            } else {
                $grupos = $_SESSION ['grupos'];
                $toursbooking = $_SESSION ['toursbooking'];
                $clave = $_SESSION ['grupos']['id'];
                $park = $_SESSION ['grupos']['idParque'];
                $sql = 'SELECT id,adults,child,id_grupo,id_parque,cantidad
											FROM admin_parques_tarifa
												WHERE type_rate = 1 AND id_agency = -1 AND id_parque = ? AND  id_grupo = ? AND cantidad = 1 and annio = ?';
                $sql0 = 'SELECT id,adults,child,id_grupo,id_parque,cantidad,type_rate, id_agency
						FROM admin_parques_tarifa
						WHERE type_rate = 2 AND id_parque = ? AND  id_grupo = ? AND id_agency = ? AND cantidad = 1 and annio = ?';
                if ($dat->id != -1) {
                    $rs = Doo::db()->query($sql0, array(
                        trim($park), trim($clave), $dat->id, $fecha
                    ));
                    $consulta = $rs->fetch();
                    $val = $rs->rowCount();
                    if (empty($consulta)) {
                        $rs = Doo::db()->query($sql, array(
                            trim($park), trim($clave), $fecha
                        ));
                        $consulta = $rs->fetch();
                        $val = $rs->rowCount();
                    }
                } else {
                    $rs = Doo::db()->query($sql, array(
                        trim($park), trim($clave), $fecha
                    ));
                    $consulta = $rs->fetch();
                    $val = $rs->rowCount();
                }
                if ($val > 0) {
                    $priceadult = $toursbooking ['adults'] * $consulta ['adults'];
                    $priceachild = $toursbooking ['childs'] * $consulta ['child'];
                    $_SESSION ['toursbooking'] ['ticketpark'] = $priceadult + $priceachild;
                    $divporpax = $_SESSION['toursbooking']['ticketpark'] / $toursbooking ['totalpax'];
                    $_SESSION ['toursbooking']['parkAdult'] = $priceadult;
                    $_SESSION ['toursbooking']['parkChilds'] = $priceachild;
                } else {
                    $clave = $_SESSION ['grupos']['id'];
                    $park = $_SESSION ['grupos']['idParque'];
                    $sql = 'SELECT id,adults,child,id_grupo,id_parque,cantidad
								FROM admin_parques_tarifa
								WHERE type_rate = 1 AND id_agency = -1 AND id_parque = 0 AND  id_grupo = ? AND cantidad = 1 and annio = ?';
                    $sql0 = 'SELECT id,adults,child,id_grupo,id_parque,cantidad
								FROM admin_parques_tarifa
								WHERE  type_rate = 2 AND id_parque = 0 AND  id_grupo = ? AND id_agency = ? AND cantidad = 1 and annio = ?';
                    if ($dat->id != -1) {
                        $rs = Doo::db()->query($sql0, array(
                            trim($clave), $dat->id, $fecha
                        ));
                        $consulta = $rs->fetch();
                        $val = $rs->rowCount();
                        if (empty($consulta)) {
                            $rs = Doo::db()->query($sql, array(
                                trim($clave), $fecha
                            ));
                            $consulta = $rs->fetch();
                            $val = $rs->rowCount();
                        }
                    } else {
                        $rs = Doo::db()->query($sql, array(
                            trim($clave), $fecha
                        ));
                        $consulta = $rs->fetch();
                        $val = $rs->rowCount();
                    }
                    if ($val > 0) {
                        $priceadult = $toursbooking ['adults'] * $consulta ['adults'];
                        $priceachild = $toursbooking ['childs'] * $consulta ['child'];
                        $_SESSION ['toursbooking'] ['ticketpark'] = $priceadult + $priceachild;
                        $divporpax = $_SESSION['toursbooking']['ticketpark'] / $toursbooking ['totalpax'];
                        $_SESSION ['toursbooking']['parkAdult'] = $priceadult;
                        $_SESSION ['toursbooking']['parkChilds'] = $priceachild;
                    } else {
                        $_SESSION['toursbooking']['ticketpark'] = 0;
                        $_SESSION ['toursbooking']['parkAdult'] = 0;
                        $_SESSION ['toursbooking']['parkChilds'] = 0;
                        $divporpax = 0;
                    }
                }
            }
            /* print_r(Doo::db()->showSQL());
              exit; */
            if ($divporpax > 0) {
                $_SESSION['toursbooking']['divporpax'] = $divporpax;
                $_SESSION['toursbooking']['np'] = 1;
                echo "<script>$('#tikets').html('$" . round($divporpax) . "');
					 if(suma == parcks && $('#admision-pregunta').val()==0) {
						  $('#admision-pregunta').val('1');
						  var ckresp1 = $('#resp1').attr('checked');
						  var ckresp2 = $('#resp2').attr('checked');
						  if(!ckresp1 && !ckresp2){
							$('#tiketsMess').html($('#tikets').html());
							$( '#dialog-message6' ).dialog({
									modal: true,
									width: 500
									
							});
						}
					  }
			</script>";
            } else {
                echo '<script type="text/javascript">
                      $("#dialog-message7").dialog({
                                    modal: true,
                                    buttons: {
                                    Ok: function() {  $( this ).dialog( "close" );  }
                                    }
                                });
                      $("#attractions").load("' . Doo::conf()->APP_URL . 'tours/onedaytour-park2/' . $_SESSION ['grupos']['idParque'] . ',' . $clave = $_SESSION ['grupos']['id'] . '/3");
                      $("input[type=\'checkbox\'").attr("checked",false).change();
                      </script>';
                exit;
            }
        } catch (Exception $e) {
            echo $e;
            // procedimiento en caso de reportar errores
        }
    }

    public function pagoOnedaytour() {
        if (isset($_SESSION ['toursbooking'])) {
            Doo::loadModel("Agency");
            if (isset($_SESSION['data_agency'])) {
                $dat = new Agency($_SESSION['data_agency']);
                $tpoNormal = 'Passanger Credit Card';
            } else {
                $dat = new Agency();
                $dat->id = -1;
                $dat->type_rate = 0;
                $tpoNormal = 'Credit Card';
            }

            $op = array("1" => array("PRED-PAID" => "Agency Credit Card"),
                "2" => array("PRED-PAID" => $tpoNormal),
                "3" => array("COLLECT ON BOARD" => "Credit Card+ 4 % FEE"),
                "4" => array("COLLECT ON BOARD" => "Cash"),
                "5" => array("VOUCHER" => "Credit Voucher"),
            );
            if (isset($_REQUEST['opcion_pago'])) {
                $pago = $_REQUEST['opcion_pago'];
            } else {
                $pago = 1;
            }
            Doo::loadController('admin/ToursOneController');
            $toursOneControl = new ToursOneController();
            $_SESSION['codconf'] = $toursOneControl->codigoConf(1);

            if ($pago < "2") {
                if ($a != NULL) {
                    $this->pago();
                }

                if (isset($_SESSION ['user'])) {
                    $user = $_SESSION ['user'];
                    $tourstick = array(
                        "firstname" => $user->firstname,
                        "lastname" => $user->firstname,
                        "email" => $user->username,
                        "cellphone" => $user->celphone,
                        "phone" => $user->phone
                    );
                    $_SESSION ["tourstick"] = $tourstick;

                    $this->data['rootUrl'] = Doo::conf()->APP_URL;
                    $this->view()->renderc('tours/pago', $this->data);
                } else {
                    // $this->logUser();
                }
            } else {
                Doo::loadModel("Agency");
                $dat = new Agency($_SESSION['data_agency']);
                Doo::loadModel("Reserve");
                Doo::loadModel("Transfer");

                $sdeparture = (isset($_SESSION['toursbooking']['sdeparture']) ? $_SESSION['toursbooking']['sdeparture'] : 0);
                $sarrival = (isset($_SESSION['toursbooking']['sarrival']) ? $_SESSION['toursbooking']['sarrival'] : 0);


                Doo::loadModel("Hotel_Reserves");
                $hotel = new Hotel_Reserves();
                $hotel->additional_night = 0;
                $hotel->adult = $_SESSION['toursbooking']['adults'];
                $hotel->category = $_SESSION['categoria'];
                $hotel->child = $_SESSION['toursbooking']['childs'];
                $hotel->days = $_SESSION['toursbooking']['dias'];
                $hotel->id_agencia = $dat->id;
                $hotel->id_cliente = $login->id;
                $hotel->id_hotel = $_SESSION['toursbooking']['hotelid'];
                $hotel->nights = $_SESSION['toursbooking']['noches'];
                $hotel->room1_adult = $_SESSION ["toursbooking"]['adult_r1'];
                $hotel->room2_adult = $_SESSION ["toursbooking"]['adult_r2'];
                $hotel->room3_adult = $_SESSION ["toursbooking"]['adult_r3'];
                $hotel->room4_adult = $_SESSION ["toursbooking"]['adult_r4'];
                $hotel->room1_child = $_SESSION ["toursbooking"]['child_r1'];
                $hotel->room2_child = $_SESSION ["toursbooking"]['child_r2'];
                $hotel->room3_child = $_SESSION ["toursbooking"]['child_r3'];
                $hotel->room4_child = $_SESSION ["toursbooking"]['child_r4'];
                $hotel->roooms = $_SESSION['toursbooking']['rooms'];
                $hotel->total_paid = $_SESSION['toursbooking']['totalhotel'];
                $hotel->total_persons = $_SESSION['toursbooking']['totalpax'];
                $hotel->type = 0;
                Doo::db()->insert($hotel) or die("Error Ingresando Datos de Hotel");
                $id_hotel_reserves = Doo::db()->lastInsertId();

                Doo::loadModel("Tours");
                $tours = new Tours();
                $tours->id_agency = $dat->id;
                $tours->id_client = $login->id;
                $tours->id_hotel_reserve = $id_hotel_reserves;
                $tours->id_transfer_in = (isset($inTrans) ? $inTrans : "-1");
                $tours->id_transfer_out = (isset($outTrans) ? $outTrans : "-1");
                ;
                $tours->agency_employee = $dat->id;
                $tours->code_conf = $_SESSION['codconf'];
                $tours->creation_date = date("Y-m-d");
                $tours->ending_date = $_SESSION['toursbooking']['fecha_llegada'];
                $tours->starting_date = $_SESSION['toursbooking']['fecha_salida'];
                $tours->length_day = $_SESSION['toursbooking']['dias'];
                $tours->length_nights = $_SESSION['toursbooking']['noches'];
                Doo::db()->insert($tours) or die("Error Ingresando Datos de Tours");
                $id_tours = Doo::db()->lastInsertId();


                $group = $_SESSION ['grupos'];
                $group1 = $_SESSION ['grupos1'];

                $i = 0;
                Doo::loadModel("Attraction_Trafic");
                Doo::loadModel('Parques');
                $key = array_keys($group);
                while ($i < count($key)) {
                    $grou = explode(',', $group1['park' . $key[$i]]);
                    $j = 0;
                    while ($j < count($grou)) {
                        $attraction = new Attraction_Trafic();
                        $attraction->admission = $_SESSION['toursbooking']['question'];
                        $attraction->id_tours = $id_tours;
                        $attraction->adult = $_SESSION['toursbooking']['adults'];
                        $attraction->child = $_SESSION['toursbooking']['childs'];
                        $attraction->group = $key[$i];
                        $attraction->id_agencia = $dat->id;
                        $attraction->id_cliente = $login->id;
                        $attraction->id_park = $grou[$j];
                        $attraction->total_paid = $_SESSION['toursbooking']['parktotal'];
                        $attraction->total_person = $_SESSION['toursbooking']['totalpax'];
                        $attraction->trafic = 0;
                        Doo::db()->insert($attraction) or die("Error Ingresando Datos de Attractions");
                        ;
                        if ($attraction->admission == 1) {
                            $parque = new Parques();
                            $parque->id = $attraction->id_park;
                            $parque = Doo::db()->getOne($parque);
                            $parque->stock = intval($parque->stock) - 1;
                            $parque->update();
                        }
                        $j++;
                    }
                    $i++;
                }


                if (($sarrival == 1) || ($sdeparture == 1)) {
                    $reserves = new Reserve();
                    $arval = array_values($op[$pago]);
                    $arkey = array_keys($op[$pago]);
                    $reserves->agen = $dat->id;
                    $reserves->agency = $dat->id;
                    $reserves->arrtime1 = (isset($_SESSION['toursbooking']['datearrivingtrip1']) ? $_SESSION['toursbooking']['datearrivingtrip1'] : "");
                    $reserves->arrtime2 = (isset($_SESSION['toursbooking']['datearrivingtrip2']) ? $_SESSION['toursbooking']['datearrivingtrip2'] : "");
                    $reserves->codconf = (isset($_SESSION['code']) ? $_SESSION['code'] : -1);
                    ;
                    $reserves->comments;
                    $reserves->deptime1 = (isset($_SESSION['toursbooking']['datedeparturetrip1']) ? $_SESSION['toursbooking']['datedeparturetrip1'] : "");
                    $reserves->deptime2 = (isset($_SESSION['toursbooking']['datedeparturetrip1']) ? $_SESSION['toursbooking']['datedeparturetrip2'] : "");
                    $reserves->fecha_retorno = (isset($_SESSION['toursbooking']['fecha_salida']) ? $_SESSION['toursbooking']['fecha_salida'] : "");
                    $reserves->fecha_salida = (isset($_SESSION['toursbooking']['fecha_llegada']) ? $_SESSION['toursbooking']['fecha_llegada'] : "");
                    $reserves->agen = $dat->id;
                    $reserves->codconf = (isset($_SESSION['code']) ? $_SESSION['code'] : -1);
                    $reserves->dropoff1 = (isset($_SESSION['pickup2']) ? $_SESSION['pickup2'] : 0);
                    $reserves->fecha_ini = date("Y-m-d");
                    $reserves->fecha_retorno = (isset($_SESSION['toursbooking']['fecha_llegada']) ? $_SESSION['toursbooking']['fecha_llegada'] : "");
                    $reserves->fecha_salida = (isset($_SESSION['toursbooking']['fecha_salida']) ? $_SESSION['toursbooking']['fecha_salida'] : "");
                    $reserves->firsname = $_REQUEST['firstname_tick'];
                    $reserves->hora = date("H:i:s");
                    $reserves->id_clientes = $user->id;
                    $reserves->tipo_pago = $arkey[0];
                    $reserves->pago = $arval[0];
                    $reserves->lasname = $_REQUEST['lastname_tick'];
                    $reserves->email = $_REQUEST['email_tick'];
                    $reserves->dropoff1 = (isset($_SESSION['dropoff1']) ? $_SESSION['dropoff1'] : 0);
                    
                    $reserves->dropoff2 = (isset($_SESSION['dropoff2']) ? $_SESSION['dropoff2'] : 0);
                    
                    $reserves->pickup1 = (isset($_SESSION['pickup1']) ? $_SESSION['pickup1'] : 0);
                    
                    $reserves->pickup2 = (isset($_SESSION['pickup2']) ? $_SESSION['pickup2'] : 0);
                    
                    $reserves->id_tours = $id_tours;
                    $reserves->tipo_ticket = (($sarrival == 1) && ($sdeparture == 1)) ? "roundtrip" : "oneway";
                    $reserves->totaltotal = (isset($_SESSION['toursbooking']['trasport_total2']) ? $_SESSION['toursbooking']['trasport_total2'] : 0) + (isset($_SESSION['toursbooking']['trasport_total1']) ? $_SESSION['toursbooking']['trasport_total1'] : 0);
                    $reserves->trip_no = (isset($_SESSION['toursbooking']['trip1']) ? $_SESSION['toursbooking']['trip1'] : "");
                    $reserves->trip_no2 = (isset($_SESSION['toursbooking']['trip2']) ? $_SESSION['toursbooking']['trip2'] : "");
                    Doo::db()->insert($reserves) or die("Error Ingresando Datos de Trasnporte Por Bus");
                    $id_reserva = Doo::db()->lastInsertId();
                }

                Doo::loadModel("Tours_Agency");
                $tours_reserv = new Tours_Agency();
                $comision = $this->cal_equipament();
                $totalouta = ($_SESSION ['toursbooking'] ['tsa'] * $_SESSION['toursbooking']['totalpax']);
                if ($_SESSION ['toursbooking']['comision_agency'] != 0) {
                    $total = ($totalouta - (($totalouta * $_SESSION ['toursbooking']['comision_agency']) / 100));
                } else {
                    $total = $totalouta;
                }
                $tours_reserv->id_agency = $dat->id;
                $tours_reserv->comision = $comision;
                $tours_reserv->id_reserva = $id_reserva;
                $tours_reserv->id_tours = $id_tours;
                $arval = array_values($op[$pago]);
                $arkey = array_keys($op[$pago]);
                $tours_reserv->tipo_pago = $arkey[0];
                $tours_reserv->pago = $arval[0];
                $tours_reserv->type_rate = $dat->type_rate;
                $tours_reserv->total = $total;
            }
        } else {
            return Doo::conf()->APP_URL . "agency/";
        }
    }

    public function logUser_onedaytour() {
        
        extract($_POST, EXTR_SKIP);
        if (isset($_SESSION['toursbooking'])) {
            if (isset($_SESSION['onedaytour'])) {
                if ($_SESSION['onedaytour'] == "" || $_SESSION['onedaytour'] == false) {
                    return Doo::conf()->APP_URL . "tours";
                    exit;
                }
            }
            $_SESSION['onedaytour'] = true;
            Doo::loadModel("Agency");
            if (isset($_SESSION['data_agency'])) {
                $dat = new Agency($_SESSION['data_agency']);
                $net_rate = ($dat->type_rate == 1) ? true : false;
                $tpoNormal = 'Passanger Credit Card';
            } else {
                $dat = new Agency();
                $dat->id = -1;
                $net_rate = false;
                $dat->type_rate = 0;
                $tpoNormal = 'Credit Card';
            }
            if (!isset($_SESSION ['user'])) {
                if (!(isset($firstname_tick) && isset($lastname_tick) && isset($email_tick) && isset($cellular_tick) /*&& isset($phone_tick)*/ && isset($_SESSION['toursbooking']))) {
                    if (isset($_SESSION['data_agency'])) {
                        return Doo::conf()->APP_URL . "agency/#tours2";
                    } else {
                        return Doo::conf()->APP_URL . "one-day-tour/";
                    }
                }
                $tourstick = array(
                    "firstname" => $firstname_tick,
                    "lastname" => $lastname_tick,
                    "email" => $email_tick,
                    "cellphone" => $cellular_tick,
                    //"phone" => $phone_tick
                );

                $_SESSION ["tourstick"] = $tourstick;
                $this->data['rootUrl'] = Doo::conf()->APP_URL;
                $this->renderc('tours/loginuser', $this->data);
            } else {
                $login = $user = $_SESSION ['user'];
                $tourstick = array(
                    "firstname" => $user->firstname,
                    "lastname" => $user->lastname,
                    "email" => $user->username,
                    "cellphone" => $user->celphone,
                    //"phone" => $user->phone
                );
                $_SESSION ["tourstick"] = $tourstick;
                $op = $this->types_payments();
                if (isset($_REQUEST['opcion_pago'])) {
                    $pago = $_REQUEST['opcion_pago'];
                } else {
                    if ($dat->id == -1) {//Paga el usurio
                        $pago = isset($_POST['opcion_pago']) ? $_POST['opcion_pago'] : 2;
                    } else {
                        $pago = isset($_POST['opcion_pago']) ? $_POST['opcion_pago'] : 1;
                    }
                }
                if (isset($_REQUEST['opcion_pago_saldo'])) {
                    $tipo_saldo = $_REQUEST['opcion_pago_saldo'];
                } else {
                    $tipo_saldo = 1;
                }
                if ($tipo_saldo == 2) {
                    $opcion_saldo = 'BALANCE';
                } else {
                    $opcion_saldo = 'FULL';
                }

                $total = $_SESSION['toursbooking']['tqp'] * $_SESSION['toursbooking']['totalpax'];
                if ($pago == '3') {// Calculamos el recargo Fee 4 %
                    $fee = $total * 0.04;
                    $_SESSION['priceFee'] = $fee;
                } else {
                    $fee = 0;
                    $_SESSION['priceFee'] = 0;
                }
                if (isset($_SESSION['toursbooking']['comision_agency'])) {
                    $valorComision = $_SESSION['toursbooking']['comision_agency'];
                } else {
                    $valorComision = 0.00;
                }
                if ($pago == 1 || $tipo_saldo == 2) {
                    $totaltotal = $total - $valorComision;
                } else {
                    $totaltotal = $total;
                }
                if(isset($_REQUEST['comentarios'])){
                    $_SESSION['toursbooking']['comentarios'] = $_REQUEST['comentarios'];
                }else{
                    $_SESSION['toursbooking']['comentarios'] = "";
                }
                $totaltotal = $totaltotal + $fee;
                if (isset($_REQUEST['otheramount'])) {
                    $otheramount = (is_numeric($_REQUEST['otheramount'])) ? $_REQUEST['otheramount'] : 0;
                } else {
                    $otheramount = 0;
                }
                $_SESSION['toursbooking']['otheramount'] = $otheramount;
                $_SESSION['toursbooking']['totalouta'] = $totaltotal;
                $_SESSION['toursbooking']['otheramount'] = $otheramount;
                //Codigo de confirmacion
                Doo::loadController('admin/ToursOneController');
                $toursOneControl = new ToursOneController();
                $_SESSION['codconf'] = $toursOneControl->codigoConf(1);

                if ($pago < "3") {
                    unset($_SESSION['pagoListo']);
                    $arval = array_values($op[$pago]);
                    if ($otheramount == 0) {
                        $_SESSION['toursbooking']['pago_pred'] = $totaltotal;
                    } else {
                        $_SESSION['toursbooking']['pago_pred'] = $otheramount;
                    }
                    $_SESSION['toursbooking']['opcionPago'] = $arval[0] . '-' . $opcion_saldo;

                    $this->data['rootUrl'] = Doo::conf()->APP_URL;
                    $this->view()->renderc('tours/pago', $this->data);
                    #cotizacion 
                    try {
                        $contenido .= print_r($_SESSION, true);
                        $contenido .= "<span style='color:red;'>Cotizacion One Day Tours - con usuario login true</span>";
                        $mail = new PHPMailer();
                        $mail->IsSMTP();
                        $correo_emisor = "websales@supertours.com";
                        $nombre_emisor = "Supertours Of Orlando";
                        $contrasena = "Daniel4";
                        //$mail->SMTPDebug  = 2;                  
                        $mail->SMTPAuth = true;
                        //$mail->SMTPSecure = "tsl";                
                        $mail->SMTPSecure = "ssl";
                        $mail->Host = "smtpout.secureserver.net";
                        $mail->Port = 465;
                        $mail->Username = $correo_emisor;
                        $mail->Password = $contrasena;
                        //$mail->AddReplyTo($correo_emisor, $nombre_emisor);
                        $mail->SetFrom("no_reply@supertours.com", $nombre_emisor);
                        $mail->Subject = 'Supertours Of Orlando, Cotizacion One Day Tours - con usuario login true -' . date("d-m-Y h:i:s");
                        $mail->AltBody = 'Supertours Of Orlando, Cotizacion One Day Tours - con usuario login true -' . date("d-m-Y h:i:s");
                        $mail->AddAddress("henry@supertours.com", "");
                        $mail->MsgHTML($contenido);
                        $mail->Send();
                    } catch (phpmailerException $e) {
                        echo $e->errorMessage(); // Errores de PhpMailer
                    } catch (Exception $e) {
                        echo $e->getMessage(); // Errores de cualquier otra cosa.
                    }
                    #fin de cotizacion
                } else {
                    Doo::loadModel("Reserve");
                    Doo::loadModel("Transfer");

                    $sdeparture = (isset($_SESSION['toursbooking']['sdeparture']) ? $_SESSION['toursbooking']['sdeparture'] : 0);
                    $sarrival = (isset($_SESSION['toursbooking']['sarrival']) ? $_SESSION['toursbooking']['sarrival'] : 0);
                    $type_tour = 'ONE';

                    //Cargando Datos cliente
                    Doo::loadModel("Clientes");
                    if ($dat->id != -1) {
                        $cliente = new Clientes();
                        $cliente->username = $tourstick['email'];
                        $cliente = Doo::db()->find($cliente, array('limit' => 1));
                        if (empty($cliente)) {
                            $cliente = new Clientes();
                            $cliente->username = $tourstick['email'];
                            $cliente->firstname = $tourstick['firstname'];
                            $cliente->lastname = $tourstick['lastname'];
                            $cliente->phone = $tourstick['phone'];
                            $cliente->celphone = $tourstick['cellphone'];
                            Doo::db()->insert($cliente) or die("Error Ingresando Datos de Cliente");
                            $id_cliente = Doo::db()->lastInsertId();
                            $cliente->id = $id_cliente;
                        }
                    } else {
                        $cliente = new Clientes();
                        $cliente->username = $user->username;
                        $cliente = Doo::db()->find($cliente, array('limit' => 1));
                    }

                    Doo::loadModel("Tour_oneday");
                    $tours = new Tour_oneday();
                    $tours->id_client = $cliente->id;
                    $tours->type_client = $cliente->tipo_client;
                    $tours->id_agency = $dat->id;
                    $tours->agency_employee = ($dat->id != -1) ? $login->id : -1;
                    $tours->code_conf = $_SESSION['codconf'];
                    $tours->creation_date = date("Y-m-d H:i");
                    $tours->starting_date = $_SESSION['toursbooking']['fecha_llegada'];
                    $tours->ending_date = $_SESSION['toursbooking']['fecha_salida'];
                    $tours->length_day = $_SESSION['toursbooking']['dias'];
                    $tours->length_nights = $_SESSION['toursbooking']['noches'];
                    $tours->adult = $_SESSION['toursbooking']['adults'];
                    $tours->child = $_SESSION['toursbooking']['childs'];
                    $tours->id_reserva = -5;
                    $tours->id_transfer_in = -1;
                    $tours->id_transfer_out = -1;
                    $tours->comments = $_SESSION['toursbooking']['comentarios'];
                    $tours->total = $total;
                    $tours->totalouta = $total + $fee;
                    $tours->otheramount = $otheramount;
                    $tours->extra_charge = 0;
                    $tours->descuento_procentaje = 0;
                    $tours->descuento_valor = 0;
                    $tours->canal = 'WEBSALE';
                    $tours->estado = 'CONFIRMED';
                    $tours->id = Doo::db()->insert($tours) or die("Error Ingresando Datos de Tours");
                    $id_tours = $tours->id;

                    //Guardamos el parque seleccioando
                    $group = $_SESSION ['grupos']['id'];
                    $park = $_SESSION ['grupos']['idParque'];
                    Doo::loadModel("Attraction_Trafic");
                    $attraction = new Attraction_Trafic();
                    $attraction->id_tours = $id_tours;
                    $attraction->type_tour = $type_tour;
                    $attraction->id_park = $park;
                    $attraction->group = $group;
                    $attraction->creation_date = date("Y-m-d H:i");
                    $attraction->starting_date = $_SESSION['toursbooking']['fecha_llegada'];
                    $attraction->ending_date = $_SESSION['toursbooking']['fecha_salida'];
                    $attraction->admission = $_SESSION ['toursbooking']['ticketpark'];
                    $attraction->trafic = 1;
                    $attraction->id_cliente = $cliente->id;
                    $attraction->type_client = $cliente->tipo_client;
                    $attraction->id_agencia = $dat->id;
                    $attraction->adult = $_SESSION['toursbooking']['adults'];
                    $attraction->child = $_SESSION['toursbooking']['childs'];
                    $attraction->total_person = $_SESSION['toursbooking']['totalpax'];
                    if ($attraction->admission == 1) {
                        $tours->include_park = 1;
                        $tours->update();
                        $attraction->admission_child = $_SESSION ['toursbooking']['parkChilds'];
                        $attraction->admission_adtul = $_SESSION ['toursbooking']['parkAdult'];
                    } else {
                        $attraction->admission_child = 0;
                        $attraction->admission_adtul = 0;
                    }
                    $attraction->totalAdmission = $attraction->admission_adtul + $attraction->admission_child;
                    if ($park == '19') {
                        $attraction->totalTraspor = 60 * $_SESSION['toursbooking']['totalpax'];
                    } else {
                        $attraction->totalTraspor = 0;
                    }
                    $attraction->total_paid = $attraction->totalAdmission + $attraction->totalTraspor;
                    Doo::db()->insert($attraction) or die("Error Ingresando Datos de Attractions");
                    //bajar el stock de la attraction
                    Doo::loadModel('Parques');
                    if ($attraction->admission == 1) {
                        $parque = new Parques();
                        $parque->id = $attraction->id_park;
                        $parque = Doo::db()->getOne($parque);
                        $parque->stock = intval($parque->stock) - 1;
                        $parque->update();
                    }

                    if (($sarrival == 1) || ($sdeparture == 1)) {
                        $reserves = new Reserve();
                        $arval = array_values($op[$pago]);
                        $arkey = array_keys($op[$pago]);
                        $reserves->id_tours = $id_tours;
                        $reserves->type_tour = $type_tour;
                        $reserves->fecha_ini = date("Y-m-d");
                        $reserves->trip_no = (isset($_SESSION['toursbooking']['trip1']) ? $_SESSION['toursbooking']['trip1'] : "");
                        $reserves->trip_no2 = (isset($_SESSION['toursbooking']['trip2']) ? $_SESSION['toursbooking']['trip2'] : "");
                        $reserves->tipo_ticket = "roundtrip";
                        $reserves->fromt = (isset($_SESSION['toursbooking']['area1']) ? $_SESSION['toursbooking']['area1'] : "");
                        $reserves->tot = 1;
                        $reserves->fromt2 = 1;
                        $reserves->tot2 = (isset($_SESSION['toursbooking']['area2']) ? $_SESSION['toursbooking']['area2'] : "");
                        $reserves->firsname = $_REQUEST['firstname_tick'];
                        $reserves->lasname = $_REQUEST['lastname_tick'];
                        $reserves->email = $_REQUEST['email_tick'];
                        $reserves->deptime1 = date("H:i:s",  strtotime((isset($_SESSION['toursbooking']['datedeparturetrip1']) ? $_SESSION['toursbooking']['datedeparturetrip1'] : "")));
                        $reserves->deptime2 = date("H:i:s",  strtotime((isset($_SESSION['toursbooking']['datedeparturetrip1']) ? $_SESSION['toursbooking']['datedeparturetrip2'] : "")));
                        $reserves->arrtime1 = date("H:i:s",  strtotime((isset($_SESSION['toursbooking']['datearrivingtrip1']) ? $_SESSION['toursbooking']['datearrivingtrip1'] : "")));
                        $reserves->arrtime2 = date("H:i:s",  strtotime((isset($_SESSION['toursbooking']['datearrivingtrip2']) ? $_SESSION['toursbooking']['datearrivingtrip2'] : "")));
                        $reserves->precioA = (isset($_SESSION['toursbooking']['priceadults']) ? $_SESSION['toursbooking']['priceadults'] : "");
                        $reserves->precioN = (isset($_SESSION['toursbooking']['pricechilds']) ? $_SESSION['toursbooking']['pricechilds'] : "");

                        $reserves->fecha_retorno = (isset($_SESSION['toursbooking']['fecha_salida']) ? $_SESSION['toursbooking']['fecha_salida'] : "");
                        $reserves->fecha_salida = (isset($_SESSION['toursbooking']['fecha_llegada']) ? $_SESSION['toursbooking']['fecha_llegada'] : "");
                        $reserves->pax = (isset($_SESSION['toursbooking']['adults']) ? $_SESSION['toursbooking']['adults'] : 0);
                        $reserves->pax2 = (isset($_SESSION['toursbooking']['childs']) ? $_SESSION['toursbooking']['childs'] : 0);
                        $reserves->id_clientes = $cliente->id;
                        $reserves->pickup1 = (isset($_SESSION['toursbooking']['pickup1']) ? $_SESSION['toursbooking']['pickup1'] : 0);
                        $reserves->dropoff1 = (isset($_SESSION['toursbooking']['dropoff1']) ? $_SESSION['toursbooking']['dropoff1'] : 0);
                        $reserves->pickup2 = (isset($_SESSION['toursbooking']['pickup2']) ? $_SESSION['toursbooking']['pickup2'] : 0);
                        $reserves->dropoff2 = (isset($_SESSION['toursbooking']['dropoff2']) ? $_SESSION['toursbooking']['dropoff2'] : 0);

                        $reserves->tipo_pago = $arkey[0];
                        $reserves->pago = $arval[0] . '-' . $opcion_saldo;
                        $reserves->totaltotal = $reserves->precioA + $reserves->precioN;
                        $reserves->otheramount = 0;
                        $reserves->extra_charge = 0;
                        $reserves->descuento_procentaje = 0;
                        $reserves->descuento_valor = 0;
                        $reserves->total2 = $reserves->totaltotal;
                        $reserves->codconf = (isset($_SESSION['codconf']) ? $_SESSION['codconf'] : -1);
                        $reserves->hora = date("H:i:s");
                        $reserves->comments = $_SESSION['toursbooking']['comentarios'];
                        $reserves->resident = 0;
                        $reserves->agen = ($dat->id != -1) ? $login->id : -1;
                        $reserves->tipo_client = $cliente->tipo_client;
                        $reserves->reward_id = 1;
                        $reserves->agency = $dat->id;
                        $reserves->luggage1 = -1;
                        $reserves->luggage2 = -1;
                        $reserves->canal = 'WEBSALE';
                        $reserves->estado = 'CONFIRMED';
                        Doo::db()->insert($reserves) or die("Error Ingresando Datos de Trasnporte Por Bus");
                        $id_reserva = Doo::db()->lastInsertId();

                        //Actualizamos tours
                        $tours->id = $id_tours;
                        $tours->id_reserva = $id_reserva;
                        Doo::db()->update($tours);
                        //REgistraos pago y rastro
                        Doo::loadController('admin/ReservasController');
                        $reseControl = new ReservasController();
                        $reserves->id = $id_reserva;
                        $login = $_SESSION['user'];
                        $login->tipo = 'AGENCY';
                        $reseControl->registrar_pago($reserves, NULL, $login);
                        $reseControl->rastro_reserva('CREATE', NULL, $reserves, $login);


                        Doo::loadModel("Tours_Agency");
                        $tours_reserv = new Tours_Agency();
                        $comision = $this->cal_equipament();
                        $tours_reserv->id_agencia = $dat->id;
                        $tours_reserv->comision = $comision;
                        $tours_reserv->id_reserva = $id_reserva;
                        $tours_reserv->id_tours = $id_tours;
                        $tours_reserv->type_tour = $type_tour;
                        $arval = array_values($op[$pago]);
                        $arkey = array_keys($op[$pago]);
                        $tours_reserv->tipo_pago = $arkey[0];
                        $tours_reserv->pago = $arval[0] . '-' . $opcion_saldo;
                        $tours_reserv->type_rate = $dat->type_rate;
                        $tours_reserv->agency_fee = $valorComision;
                        $tours_reserv->total = $total;
                        $tours_reserv->otheramount = $otheramount;
                        $tours_reserv->totalouta = $totaltotal;
                        $this->data ['rootUrl'] = Doo::conf()->APP_URL;
                        $this->data ['opcionPago'] = $pago;
                        if (Doo::db()->insert($tours_reserv)) {
//                            if ($pago == 5) {// Actualizamos el credio
//                                $creditos = Doo::db()->find("Acredito", array("where" => "id_agency_account = ? and disponible > 0", "param" => array($dat->id), "limit" => 1));
//                                if (!empty($creditos)) {
//                                    $creditos->disponible = ($creditos->disponible - $total);
//                                    if (!Doo::db()->update($creditos)) {
//                                        $this->view()->renderc('decline', $this->data);
//                                    }
//                                }
//                            }
                            $_SESSION['tourPagoOneDay'] = 'ok';
                            $_SESSION['pagoListo'] = 'ok'; // el pago de one day tour esta listo;
                            $this->correo_onedaytour();
                            unset($_SESSION['toursbooking']);
                            $this->view()->renderc('tours/approval', $this->data);
                            
                        } else {
                            $this->view()->renderc('tours/decline', $this->data);
                        }
                    }
                }
            }
        } else {
            if (isset($_SESSION['data_agency'])) {
                return Doo::conf()->APP_URL . "agency/";
            } else {
                return Doo::conf()->APP_URL . "one-day-tour/";
            }
        }
    }

    public function enviarCorreo($cotenido, $destinatarios) {
        try {
            Doo::loadController('DatosMailController');
            $datosMail = new DatosMailController();
            $mail = new PHPMailer(true);
            $mail = $datosMail->datos();
            foreach ($destinatarios as $row) {
                $mail->AddAddress($row['email'], $row['nombre']);
            }
            $mail->Subject = 'Reservations Super Tours OF Orlando'; // Mensaje alternativo en caso que el destinatario no pueda abrir        // correos HTML
            $mail->AltBody = 'Reservations Super Tours OF Orlando'; // El cuerpo del mensaje, puede ser con etiquetas HTML
            $mail->MsgHTML($cotenido);
            $mail->Send();
        } catch (phpmailerException $e) {
            echo $e->errorMessage(); // Errores de PhpMailer
        } catch (Exception $e) {
            echo $e->getMessage(); // Errores de cualquier otra cosa.
        }
    }

    function quotationOnedayTour() {
        try {
            extract($_POST, EXTR_SKIP);
            if (!(isset($firstname_tick) && isset($lastname_tick) && isset($email_tick) && isset($cellular_tick)/* && isset($phone_tick) */&& isset($_SESSION['toursbooking']))) {
                if (isset($_SESSION['data_agency'])) {
                    return Doo::conf()->APP_URL . "agency/#tours2";
                } else {
                    return Doo::conf()->APP_URL . "one-day-tour/";
                }
            }
            Doo::loadController('admin/ToursOneController');
            $toursOneControl = new ToursOneController();
            $_SESSION['codcuot'] = $toursOneControl->codigoConf(0);
            $_SESSION['codconf'] = $_SESSION['codcuot'];

            if (!isset($_SESSION ['user'])) {
                $tourstick = array(
                    "firstname" => $firstname_tick,
                    "lastname" => $lastname_tick,
                    "email" => $email_tick,
                    "cellphone" => $cellular_tick,
                    //"phone" => $phone_tick
                );
                $_SESSION ["tourstick"] = $tourstick;
            } else {
                $user = $_SESSION ['user'];
                if (isset($_SESSION['data_agency'])) {
                    $tourstick = array(
                        "firstname" => $firstname_tick,
                        "lastname" => $lastname_tick,
                        "email" => $email_tick,
                        "cellphone" => $cellular_tick,
                        //"phone" => $phone_tick
                    );
                    $_SESSION ["tourstick"] = $tourstick;
                } else {
                    if (!isset($user->celphone)) {
                        $user->celphone = '';
                    }
                    if (!isset($user->phone)) {
                        $user->phone = '';
                    }
                    $tourstick = array(
                        "firstname" => $user->firstname,
                        "lastname" => $user->lastname,
                        "email" => $user->username,
                        "cellphone" => $user->celphone,
                        //"phone" => $user->phone
                    );
                    $_SESSION ["tourstick"] = $tourstick;
                }
            } $this->correo_onedaytour();
            unset($_SESSION['toursbooking']);
            $_SESSION['tourPagoMulDay'] = "No";
            if (isset($_SESSION['tourPagoOneDay'])) {
                $_SESSION['tourPagoOneDay'] == 'No';
            }
            $this->data['rootUrl'] = Doo::conf()->APP_URL;
            $this->view()->renderc('tours/quotation', $this->data);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function correo_onedaytour() {
        if (isset($_SESSION['data_agency'])) {
            $dat = new Agency($_SESSION['data_agency']);
            Doo::loadModel("UserA");
            $datos = unserialize($_SESSION['uagency']);
            
            $agencia_name = $dat->company_name;
            $agencia_usuario = $datos->firstname." ".$datos->lastname;
            
        } else {
            $agencia_name = "N/A";
            $agencia_usuario = "N/A";
        }
        // Doo::db()->query($query); 
        if (isset($_SESSION ['toursbooking'])) {
            $toursbooking = $_SESSION ['toursbooking'];
        } else {
            return;
        }
        //print_r($toursbooking);
        $question = $toursbooking['ticketpark'];
        $buffet = isset($_SESSION['bufet']) ? $_SESSION['bufet'] : 0;
        if (isset($_SESSION['area']))
            $area = $_SESSION['area'];
        else
            $area = "";
        if (isset($_SESSION['area2']))
            $area2 = $_SESSION['area2'];
        else
            $area2 = "";
        if (isset($_SESSION['pickup']))
            $pickup = $_SESSION['pickup'];
        else
            $pickup = "";

        if (isset($_SESSION['pickup2']))
            $pickup2 = $_SESSION['pickup2'];
        else
            $pickup2 = "";

        $login = $_SESSION ["tourstick"];

        $desayuno = "";
        $namepark = $_SESSION ['namepark'];
        $npark = "";
        foreach ($namepark as $value) {
            $npark .= "<li>" . $value . "</li>";
        }

        if (isset($_SESSION['tourPagoOneDay'])) {
            if ($_SESSION['tourPagoOneDay'] == 'ok') {
                $estado = 'PAID';
                $titulo = 'ONE DAY TOUR CONFIRMATION';
            }
        } else {
            $estado = 'QUOTE';
            $titulo = 'ONE DAY TOUR QUOTATION';
        }
        $cotenido = "<title>Documento sin t�tulo</title>
<style type='text/css'>
#clearTable {
	width: 800px;
	font-size: 13px;
	font-family: Verdana, Geneva, sans-serif;
}
#clearTable tr #titletd3 {
	font-family: Verdana, Geneva, sans-serif;
}
#clearTable tr #titletd2 {
	font-size: 20px;
}
#clearTable tr td p {
	text-align: center;
}

#content #center-column #tdgris {
	background-color: #F0F0F0;
}
#content #center-column #tdrojo {
	background-color: #FFE6E6;
}
#content #center-column1 #titletd {
	background-color: #F5EDEB;
	padding-left: 5px;
	font-size: 12px;
}
 #titlett {
	background-color: #E8E8E8;
	padding-left: 5px;
	font-size: 12px;
}
 #titlell {
	padding-left: 5px;
	font-size: 12px;
	border-bottom-width: 1px;
	border-left-width: 1px;
	border-bottom-style: solid;
	border-left-style: solid;
	border-bottom-color: #E6E6E6;
	border-left-color: #E6E6E6;
}
#titlelp {
	padding-left: 5px;
	font-size: 12px;
	border-bottom-width: 1px;
	border-bottom-style: solid;
	border-bottom-color: #E6E6E6;
}
 #titlelr {
	padding-left: 5px;
	font-size: 12px;
	border-top-width: 1px;
	border-top-style: solid;
	border-top-color: #CE0000;
	color: #CE0000;
}
 #tdgristable {
	background-color: #FFF;
	padding-left: 5px;
}



.Estilo1 {color: #FF0000}
</style>
</head><div align='center'>
<br />
<table   id='clearTable'> 
     <tr>
       <td width='316' height='33' rowspan='3' id='titletd3'><img src='https://www.supertours.com/Logo-Supertours-mail.jpg' width='316' height='88' /></td>
       <td colspan='3' align='center' id='titletd3'>Supertours.com</td>
     </tr>
     <tr>
       <td height='35' colspan='3' id='titletd7'>Fecha:" . date("M-d-Y") . " / Hora:" . date("g:i A") . " </td>
     </tr>
     <tr>
       <td height='35' colspan='3' id='titletd4'>Agency: <span style='color: #BD1515'>$agencia_name</span>, Usuario : <span style='color: #BD1515'>$agencia_usuario</span></td>
    </tr>
     <tr>
       <td align='center' height='33' colspan='4' id='titletd2'> <h3>" . $titulo . "</h3></td>
     </tr>
     <tr>
       <td height='15' id='titletd6'>
       LEAD TRAVELER:
       <br/><br/>
       <strong>User Name: </strong>" . $login['email'] . "
       <br/><br/>
       <strong>Firstname: </strong>" . $login['firstname'] . "
       <br/><br/>
       <strong>Lastname: </strong>" . $login['lastname'] . "
       <br/><br/>
       <strong>Phone: </strong>" . $login['phone'] . "
        <br/><br/>
       <strong>Cellphone: </strong>" . $login['cellphone'] . "    
       </td>
       <td width='145' height='15' id='titletd6'>&nbsp;</td>
       <td colspan='2' id='titletd6'><strong>AD :</strong>" . $_SESSION['toursbooking']['adults'] . " <strong>CHD :</strong>" . $_SESSION['toursbooking']['childs'] . "  <strong> TOTAL :</strong>" . $_SESSION['toursbooking']['totalpax'] . "<br/><br/><strong>Status :</strong> " . $estado . "<br/><br/><strong> Code Quotation :</Strong> " . $_SESSION['codconf'] . "</td>
     </tr>
      <tr>
    <td height='45' colspan='4' id='titletd'> <p><strong>ORDER&nbsp;  QUOTATION</strong></p></td>
  </tr>
  <tr><td colspan=\"3\">
     <table width=\"100%\" height=\"90\" id=\"tableorder\">
      <tr>
        <td height=\"35\" colspan=\"3\" id=\"titlett\"  ><strong ><div align=\"left\" > ITINERARY ARRIVAL</div></strong></td>
        </tr>
      <tr>
        <td height=\"47\" colspan=\"3\"><br/><p>"
                . (($toursbooking['sarrival'] == 1) ? " Date Arrival <strong>" . date("M-d-Y", strtotime($toursbooking['fecha_llegada'])) . "</strong> &#45; Pick up time <strong>" . date("g:i A", strtotime($toursbooking['datedeparturetrip1'])) . "</strong> &#45; Trip <strong>" . $toursbooking['trip1'] . "</strong>, Luxury <strong>" . $toursbooking['equipment1'] . "</strong> &#45; transportation from <strong>" . $area . '-' . $pickup . "</strong>, to Super Tours of orlando Terminal, arriving at <strong>" . date("h:s A", strtotime($toursbooking['datearrivingtrip1'])) . "</strong> , you will be greeted by your tour guide/driver in Orlando. 

<br>
<strong > <div align=\"left\" > LOCAL TRANSFERS TO PARKS</div></strong>
Local Round Trip Transfers from Super Tours Orlando Terminal to
<ul>" . $npark . "</ul>" . (($question == 1) ? "<strong>Includes tickets to parks.</strong>" : "<strong>Not includes tickets to parks.</strong>") . "<hr>" : "") . (($toursbooking['sarrival'] == 2) ? "Date Arrival <strong>" . date("M-d-Y", strtotime($toursbooking['fecha_llegada'])) . "</strong> &#45;you have choosen <strong>" . date("h:s A", strtotime($toursbooking['hora1'])) . "</strong>, on a luxury private transportation from <strong>" . $toursbooking['city'] . "</strong>, <strong>" . $toursbooking['address'] . "</strong> ,<strong>" . $area . "</strong> to <strong>" . $toursbooking['hotel'] . "</strong><hr><strong > <div align=\"left\" > ACCOMMODATION</div></strong><br>Hotel accommodation at the <strong>" . $toursbooking['hotel'] . "</strong> in <strong>" . $toursbooking['rooms'] . "</strong> room(s). for <strong>" . $toursbooking['noches'] . "</strong> night(s) from <strong>" . date("M-d-Y", strtotime($toursbooking['fecha_llegada'])) . "</strong> Check In Time is 4:00pm . To<strong>" . date("M-d-Y", strtotime($toursbooking['fecha_salida'])) . "</strong> Check Out Time is 11:00am." . (($desayuno != 0) ? " FREE DAILY CONTINENTAL BREKFAST. " : "") . "Taxes are Included.<br>" . (($buffet == 1 && $_SESSION['categoria'] != 2 ) ? "<br><br>Daily SUPER BREKFAST BUFFET at your hotel." : "") . "<br><hr><br><strong > <div align=\"left\" > LOCAL TRANSFERS TO PARKS</div></strong>
<strong>" . date("M-d-Y", strtotime($toursbooking['fecha_salida'])) . "</strong> Check Out Time is 11:00am." . (($desayuno != 0) ? " FREE DAILY CONTINENTAL BREKFAST. " : "") . "Taxes are Included.<br>" . (($buffet == 1 && $_SESSION['categoria'] != 2 ) ? "<br><br>Daily SUPER BREKFAST BUFFET at your hotel." : "") . "<br><hr><br><strong > <div align=\"left\" > LOCAL TRANSFERS TO PARKS</div></strong>
Local Round Trip Transfers from Super Tours Orlando Terminal to
<ul>" . $npark . "</ul>" . (($question == 1) ? "<strong>Includes tickets to parks.</strong>" : "<strong>Not includes tickets to parks.</strong>") . "<hr>
    " : "") . (($toursbooking['sarrival'] == 3) ? "<br />Date Arrival <strong>" . date("M-d-Y", strtotime($toursbooking['fecha_llegada'])) . "</strong> &#45; Arriving: By plane  at Orlando International Airport 
Data Transfer In  :   Airline: <strong>" . $toursbooking['airlinearrival'] . "</strong>   Flight #:   <strong>" . $toursbooking['flightarrival'] . "</strong> Arrival Time:<strong>" . date("h:s A", strtotime($toursbooking['hora1'])) . "</strong>
. You will be greeted by your tour guide/driver in orlando to take you to  <strong>" . $toursbooking['hotel'] . "
<hr><strong > <div align=\"left\" > ACCOMMODATION</div></strong><br>
Hotel accommodation at the <strong>" . $toursbooking['hotel'] . "</strong> in <strong>" . $toursbooking['rooms'] . "</strong> room(s). for <strong>" . $toursbooking['noches'] . "</strong> night(s) from <strong>" . date("M-d-Y", strtotime($toursbooking['fecha_llegada'])) . "</strong> Check In Time is 4:00pm . To
<strong>" . date("M-d-Y", strtotime($toursbooking['fecha_salida'])) . "</strong> Check Out Time is 11:00am." . (( $desayuno != 0) ? " FREE DAILY CONTINENTAL BREKFAST. " : "") . " Taxes are Included.
   <br>" . (($buffet == 1 && $_SESSION['categoria'] != 2) ? "<br><br>Daily SUPER BREKFAST BUFFET at your hotel." : "") . "<br>
<hr><br>
<strong > <div align=\"left\" > LOCAL TRANSFERS TO PARKS</div></strong>
Local Round Trip Transfers from Super Tours Orlando Terminal to<ul>" . $npark . "</ul>" . (($question == 1) ? "<strong>Includes tickets to parks.</strong>" : "<strong>Not includes tickets to parks.</strong>") . "<hr>" : "")
                . (($toursbooking['sarrival'] == 4) ? "<br />
Date Arrival <strong>" . date("M-d-Y", strtotime($toursbooking['fecha_llegada'])) . "</strong> PLEASE, LET US KNOW ABOUT YOUR ARRIVAL TO ORLANDO BY  DIALING  OUR TOLL FREE 1800-251-4206, TO PLACE YOUR TICKETS AT  <strong>" . $toursbooking['hotel'] . "</strong> OR FIGURE OUT ABOUT OTHER SERVICES. WE WILL PLEASED TO ASSIST YOU. 
<hr>
<strong > <div align=\"left\" > ACCOMMODATION</div></strong><br>

Hotel accommodation at the <strong>" . $toursbooking['hotel'] . "</strong> in <strong>" . $toursbooking['rooms'] . "</strong> room(s). for <strong>" . $toursbooking['noches'] . "</strong> night(s) from <strong>" . date("M-d-Y", strtotime($toursbooking['fecha_llegada'])) . "</strong> Check In Time is 4:00pm . To
<strong>" . date("M-d-Y", strtotime($toursbooking['fecha_salida'])) . "</strong> Check Out Time is 11:00am." . (( $desayuno != 0) ? " FREE DAILY CONTINENTAL BREKFAST. " : "") . " Taxes are Included.
 <br>" . (($buffet == 1 && $_SESSION['categoria'] != 2) ? "<br><br>Daily SUPER BREKFAST BUFFET at your hotel." : "") . "<br>
<br>
<strong > <div align=\"left\" > LOCAL TRANSFERS TO PARKS</div></strong>
<ul>" . $npark . "</ul>" . (($question == 1) ? "<strong>Includes tickets to parks.</strong>" : "<strong>Not includes tickets to parks.</strong>") . "<hr>" : "") . "
        </p>
        <p>" . (($toursbooking['sdeparture'] == 1) ? "<strong > <div align=\"left\" > ITINERARY DEPARTURE</div></strong><br>
          Date departure <strong>" . date("M-d-Y", strtotime($toursbooking['fecha_salida'])) . "</strong> &#45; <strong>" . date("h:s A", strtotime($toursbooking ['datedeparturetrip2'])) . "</strong> &#45;  Trip <strong>" . $toursbooking['trip2'] . "</strong>, Luxury <strong>" . $toursbooking['equipment2'] . "</strong> &#45; transportation from Orlando Super Tours Terminal to  <strong> " . $area2 . '-' . $pickup2 . " </strong> arriving at <strong>" . date("h:s A", strtotime($toursbooking ['datearrivingtrip2'])) . "</strong>, Thank you for choosing us !. <br />
           " : "") . (($toursbooking['sdeparture'] == 2) ? "<strong > <div align=\"left\" > ITINERARY DEPARTURE</div></strong>
         <br>Date departure <strong>" . date("M-d-Y", strtotime($toursbooking['fecha_salida'])) . "</strong> &#45; Drop Off Time:  <strong>" . date("h:s A", strtotime($toursbooking['hora2'])) . "</strong>, PRIVATE SERVICE  &#45; transportation VIP from Orlando, to MIAMI BEACH SOUTH 
        <br />
          " : "") . (($toursbooking['sdeparture'] == 3) ? "<strong > <div align=\"left\" > ITINERARY DEPARTURE</div></strong>
         <br>
Date departure <strong>" . $toursbooking['fecha_salida'] . "</strong>  &#45; Departure: By Plane at Orlando International Airport 
Data Transfer Out:   Airline: <strong>" . $toursbooking['airlinedeparture'] . "</strong>   Flight #:   <strong>" . $toursbooking['flightdeparture'] . "</strong> Arrival Time: <strong>" . date("h:s A", strtotime($toursbooking['hora2'])) . "</strong>



        <br />
          " : "") . (($toursbooking['sdeparture'] == 4) ? "<strong > <div align=\"left\" > ITINERARY DEPARTURE</div></strong>
         <br>
     Date departure <strong>" . date("M-d-Y", strtotime($toursbooking['fecha_salida'])) . "</strong> <br> Departure: By Car   


        <br />
          " : "") . "
          
            <br />
              <br />
            </p></td>
        </tr>
    </table>
      </td>
  </tr>
  <tr>
    <td height='33' colspan='4' id='titletd5' ><h4><span style='color: #326AC0'>Comentarios:</span>&nbsp; </h4>
      <span style='color:rgb(223, 44, 44);'>".$_SESSION['toursbooking']['comentarios']."</span></td>
  </tr>
  <tr>
    <td height='33' colspan='4' id='titletd' ><strong>PRICE</strong></td>
  </tr>
  <tr>
    <td colspan='4'><table width='90%' border='0'>
      <tr>
        <td height='32' align='center'><strong>TOTAL AMOUNT for THIS TOUR:</strong> <span id=tqprice' >$" . $toursbooking ['tqp'] * $toursbooking ['totalpax'] . "</span> </td>
      </tr>
      <tr>
        <td height='40' align='center' ><span class='Estilo1'>CHECK YOUR TOUR BEFORE PROCEEDING WITH  PAY TOUR</span></td>
      </tr>
      <tr>
        <td align='center'>Once you select the PAY TOUR button, you can no longer make changes to your TOUR  online. You must call (407) 370-3001 and speak with our  Call Center.<br /></td>
      </tr>
    </table>
    <p>&nbsp;</p>
    <p>Non-refundable - non-transferable - no changes are allowed on dates or time of departure - no pets allowed on board -<br />
      luggage restrictions apply - Please read the terms of transportation at www.supertours.com<br />
      THANK YOU FOR CHOOSING US<br />
      HAVE A NICE TRIP<br />
      SUPER TOURS OF ORLANDO,Inc. 5419 International Drive, Orlando Fl. 32819<br />
      Phone: (407) 370-3001 / U.S.A. TOLL FREE 1-800-251-4206 / reservations@supertours.com
    
    </p></td>
  </tr>
  <tr>
    <td height='18' colspan='4' align='center'> <p align='center' class='titulopago'> 
    
</p>       </td>

  </tr>
  </table></div>";

        $destiEmail = $login['email'];
        $destiName = $login['firstname'] . ' ' . $login['lastname'];
        $dest = array("email" => $login['email'], "nombre" => $login['firstname'] . ' ' . $login['lastname']);
        $cont = 0;
        $destinatarios[$cont++] = $dest;

        if (isset($_SESSION['data_agency'])) {
            Doo::loadModel("UserA");
            $user = unserialize($_SESSION ['uagency']);
            $dest = array("email" => $user->email, "nombre" => $user->firstname . ' ' . $user->lastname);
            $destinatarios[$cont++] = $dest;
        }

        if (isset($_SESSION['tourPagoOneDay'])) {
            $correo_emisor = "websales@supertours.com";
            $nombre_emisor = "Supertours Of Orlando";
            $dest = array("email" => $correo_emisor, "nombre" => $nombre_emisor);
            //$destinatarios[$cont++] = $dest;
        }
        $this->enviarCorreo($cotenido, $destinatarios);
    }

    function response_approval_onedaytour() {
        if (!empty($_SESSION['toursbooking'])) {
            
            if ((isset($_SESSION['user']) && isset($_REQUEST['ssl_approval_code'])) && isset($_SESSION['toursbooking'])) {
                (isset($_SESSION['user'])) or die("Page No Found Error 404");
                $_SESSION['codconf'] = $_SESSION['codconf'] . "_" . $_REQUEST['ssl_approval_code'];
                Doo::loadModel("Reserve");
                Doo::loadModel("Transfer");
                Doo::loadModel("Agency");
                Doo::loadModel("Clientes");
                $user = $_SESSION ['user'];
                if (isset($_SESSION['data_agency'])) {
                    $dat = new Agency($_SESSION['data_agency']);
                } else {
                    $dat = new Agency();
                    $dat->id = -1;
                    $dat->type_rate = 0;
                }
                $tourstick = $_SESSION ["tourstick"];
                //Cargando Datos cliente
                Doo::loadModel("Clientes");
                if ($dat->id != -1) {
                    $cliente = new Clientes();
                    $cliente->username = $tourstick['email'];
                    $cliente = Doo::db()->find($cliente, array('limit' => 1));
                    if (empty($cliente)) {
                        $cliente = new Clientes();
                        $cliente->username = $tourstick['email'];
                        $cliente->firstname = $tourstick['firstname'];
                        $cliente->lastname = $tourstick['lastname'];
                        $cliente->phone = $tourstick['phone'];
                        $cliente->celphone = $tourstick['cellphone'];
                        Doo::db()->insert($cliente) or die("Error Ingresando Datos de Cliente");
                        $id_cliente = Doo::db()->lastInsertId();
                        $cliente->id = $id_cliente;
                    }
                } else {
                    $cliente = new Clientes();
                    $cliente->username = $user->username;
                    $cliente = Doo::db()->find($cliente, array('limit' => 1));
                }

                $type_tour = 'ONE';
                // Guardar Tour
                Doo::loadModel("Tour_oneday");
                $total = $_SESSION['toursbooking']['tqp'] * $_SESSION['toursbooking']['totalpax'];
                $tours = new Tour_oneday();
                $tours->id_client = $cliente->id;
                $tours->type_client = $cliente->tipo_client;
                $tours->id_agency = $dat->id;
                $tours->agency_employee = ($dat->id != -1) ? $user->id : -1;
                $tours->code_conf = $_SESSION['codconf'];
                $tours->creation_date = date("Y-m-d H:i");
                $tours->starting_date = $_SESSION['toursbooking']['fecha_llegada'];
                $tours->ending_date = $_SESSION['toursbooking']['fecha_salida'];
                $tours->length_day = $_SESSION['toursbooking']['dias'];
                $tours->length_nights = $_SESSION['toursbooking']['noches'];
                $tours->adult = $_SESSION['toursbooking']['adults'];
                $tours->child = $_SESSION['toursbooking']['childs'];
                $tours->id_reserva = -5;
                $tours->id_transfer_in = -1;
                $tours->id_transfer_out = -1;
                $tours->comments = '';
                $tours->total = $total;
                $tours->totalouta = $total;
                $tours->otheramount = $_SESSION['toursbooking']['otheramount'];
                $tours->extra_charge = 0;
                $tours->descuento_procentaje = 0;
                $tours->descuento_valor = 0;
                $tours->canal = 'WEBSALE';
                $tours->estado = 'CONFIRMED';
                Doo::db()->insert($tours) or die("Error Ingresando Datos de Tours");
                $id_tours = Doo::db()->lastInsertId();
                // Fin Guardar Tour
                // Guardar parque
                $group = $_SESSION ['grupos']['id'];
                $park = $_SESSION ['grupos']['idParque'];
                Doo::loadModel("Attraction_Trafic");
                $attraction = new Attraction_Trafic();
                $attraction->id_tours = $id_tours;
                $attraction->type_tour = $type_tour;
                $attraction->id_park = $park;
                $attraction->group = $group;
                $attraction->creation_date = date("Y-m-d H:i");
                $attraction->starting_date = $_SESSION['toursbooking']['fecha_llegada'];
                $attraction->ending_date = $_SESSION['toursbooking']['fecha_salida'];
                $attraction->admission = $_SESSION ['toursbooking'] ['ticketpark'];
                $attraction->trafic = 1;
                $attraction->id_cliente = $cliente->id;
                $attraction->type_client = $cliente->tipo_client;
                $attraction->id_agencia = $dat->id;
                $attraction->adult = $_SESSION['toursbooking']['adults'];
                $attraction->child = $_SESSION['toursbooking']['childs'];
                $attraction->total_person = $_SESSION['toursbooking']['totalpax'];
                if ($attraction->admission == 1) {
                    $attraction->admission_child = $_SESSION ['toursbooking']['parkChilds'];
                    $attraction->admission_adtul = $_SESSION ['toursbooking']['parkAdult'];
                } else {
                    $attraction->admission_child = 0;
                    $attraction->admission_adtul = 0;
                }
                $attraction->totalAdmission = $attraction->admission_adtul + $attraction->admission_child;
                if ($park == '19') {
                    $attraction->totalTraspor = 60 * $_SESSION['toursbooking']['totalpax'];
                } else {
                    $attraction->totalTraspor = 0;
                }
                $attraction->total_paid = $attraction->totalAdmission + $attraction->totalTraspor;
                Doo::db()->insert($attraction) or die("Error Ingresando Datos de Attractions");
                Doo::loadModel('Parques');
                if ($attraction->admission == 1) {
                    $parque = new Parques();
                    $parque->id = $attraction->id_park;
                    $parque = Doo::db()->getOne($parque);
                    $parque->stock = intval($parque->stock) - 1;
                    $parque->update();
                }
                // Fin - Guardar parque
                //Guardamos la reserva
                $reserves = new Reserve();
                $reserves->id_tours = $id_tours;
                $reserves->type_tour = $type_tour;
                $reserves->fecha_ini = date("Y-m-d");
                $reserves->trip_no = (isset($_SESSION['toursbooking']['trip1']) ? $_SESSION['toursbooking']['trip1'] : "");
                $reserves->trip_no2 = (isset($_SESSION['toursbooking']['trip2']) ? $_SESSION['toursbooking']['trip2'] : "");
                $reserves->tipo_ticket = "roundtrip";
                $reserves->fromt = (isset($_SESSION['toursbooking']['area1']) ? $_SESSION['toursbooking']['area1'] : "");
                $reserves->tot = 1;
                $reserves->fromt2 = 1;
                $reserves->tot2 = (isset($_SESSION['toursbooking']['area2']) ? $_SESSION['toursbooking']['area2'] : "");
                $reserves->firsname = $tourstick['firstname'];
                $reserves->lasname = $tourstick['lastname'];
                $reserves->email = $tourstick['email'];
                $reserves->deptime1 = (isset($_SESSION['toursbooking']['datedeparturetrip1']) ? $_SESSION['toursbooking']['datedeparturetrip1'] : "");
                $reserves->deptime2 = (isset($_SESSION['toursbooking']['datedeparturetrip1']) ? $_SESSION['toursbooking']['datedeparturetrip2'] : "");
                $reserves->arrtime1 = (isset($_SESSION['toursbooking']['datearrivingtrip1']) ? $_SESSION['toursbooking']['datearrivingtrip1'] : "");
                $reserves->arrtime2 = (isset($_SESSION['toursbooking']['datearrivingtrip2']) ? $_SESSION['toursbooking']['datearrivingtrip2'] : "");
                $reserves->precioA = (isset($_SESSION['toursbooking']['priceadults']) ? $_SESSION['toursbooking']['priceadults'] : "");
                $reserves->precioN = (isset($_SESSION['toursbooking']['pricechilds']) ? $_SESSION['toursbooking']['pricechilds'] : "");

                $reserves->fecha_retorno = (isset($_SESSION['toursbooking']['fecha_salida']) ? $_SESSION['toursbooking']['fecha_salida'] : "");
                $reserves->fecha_salida = (isset($_SESSION['toursbooking']['fecha_llegada']) ? $_SESSION['toursbooking']['fecha_llegada'] : "");
                $reserves->pax = (isset($_SESSION['toursbooking']['adults']) ? $_SESSION['toursbooking']['adults'] : 0);
                $reserves->pax2 = (isset($_SESSION['toursbooking']['childs']) ? $_SESSION['toursbooking']['childs'] : 0);
                $reserves->id_clientes = $cliente->id;
                $reserves->pickup1 = (isset($_SESSION['toursbooking']['pickup1']) ? $_SESSION['toursbooking']['pickup1'] : 0);
                $reserves->dropoff1 = (isset($_SESSION['toursbooking']['dropoff1']) ? $_SESSION['toursbooking']['dropoff1'] : 0);
                $reserves->pickup2 = (isset($_SESSION['toursbooking']['pickup2']) ? $_SESSION['toursbooking']['pickup2'] : 0);
                $reserves->dropoff2 = (isset($_SESSION['toursbooking']['dropoff2']) ? $_SESSION['toursbooking']['dropoff2'] : 0);

                $reserves->tipo_pago = "PRED-PAID";
                $reserves->pago = $_SESSION ['toursbooking']['opcionPago'];
                $reserves->totaltotal = $reserves->precioA + $reserves->precioN;
                $reserves->otheramount = 0;
                $reserves->extra_charge = 0;
                $reserves->descuento_procentaje = 0;
                $reserves->descuento_valor = 0;
                $reserves->total2 = $reserves->precioA + $reserves->precioN;
                $reserves->codconf = (isset($_SESSION['codconf']) ? $_SESSION['codconf'] : -1);
                $reserves->hora = date("H:i:s");
                $reserves->comments = '';
                $reserves->resident = 0;
                $reserves->agen = ($dat->id != -1) ? $login->id : -1;
                $reserves->tipo_client = $cliente->tipo_client;
                $reserves->reward_id = 1;
                $reserves->agency = $dat->id;
                $reserves->luggage1 = -1;
                $reserves->luggage2 = -1;
                $reserves->canal = 'WEBSALE';
                $reserves->estado = 'CONFIRMED';
                Doo::db()->insert($reserves) or die("Error Ingresando Datos de Trasnporte Por Bus");
                $id_reserva = Doo::db()->lastInsertId();
                //Fin Guardamos la reserva
                //Actualizamos tours
                $tours->id = $id_tours;
                $tours->id_reserva = $id_reserva;
                Doo::db()->update($tours);

                //REgistraos pago y rastro
                Doo::loadController('admin/ReservasController');
                $reseControl = new ReservasController();
                $reserves->id = $id_reserva;
                $login = $_SESSION['user'];
                $login->tipo = 'AGENCY';
                $reseControl->registrar_pago($reserves, NULL, $login);
                $reseControl->rastro_reserva('CREATE', NULL, $reserves, $login);
                //generamos la factura
                Doo::loadModel('Factura');
                Doo::loadModel('FacturaServicio');
                Doo::loadModel('CollectService');
                
                $factura = new Factura(); //aqui
                $factura->id_agency = $tours->id_agency;
                $factura->subtotal = $tours->total;
                $factura->collect = $tours->totalouta;
                $factura->total = $factura->subtotal - $factura->collect;
                $factura->estado = "PAID";
                $factura->creation_date = date('Y-m-d');
                $factura->id = $factura->insert();
                $fs = new FacturaServicio();
                $fs->id_servicio = $id_tours;
                $fs->id_factura = $factura->id;
                $fs->tipo_servicio = 'ONE';
                $fs->id = $fs->insert();
                $coll = new CollectService();
                $coll->tipo_servicio = 'ONE';
                $coll->id_servicio = $id_tours;
                $coll->monto_pagado = $tours->totalouta;
                $coll->id = $coll->insert();
                Doo::loadModel('Pago');
                $pago = new Pago();
                $pago->factura = $factura->id;
                $pago->monto = $tours->totalouta;
                $pago->tipo = 'FULL';
                $pago->transnu = 0;
                $pago->adjunto = 'online-paid';
                $pago->descuento = 0;
                $pago->per_descuento = 0;
                $pago->fecha = date('Y-m-d h:m:s');
                $pago->metodo = 4;
                $pago->id = $pago->insert();

                if (isset($_SESSION['data_agency'])) {
                    //Fin Guardamos datos del tours referente a la agencia
                    Doo::loadModel("Tours_Agency");
                    $comision = $this->cal_equipament();
                    if (isset($_SESSION ['toursbooking']['comision_agency'])) {
                        $valorComision = $_SESSION ['toursbooking']['comision_agency'];
                    } else {
                        $valorComision = 0;
                    }
                    $tours_reserv = new Tours_Agency();
                    $tours_reserv->id_agencia = $dat->id;
                    $tours_reserv->comision = $comision;
                    $tours_reserv->id_reserva = $id_reserva;
                    $tours_reserv->id_tours = $id_tours;
                    $tours_reserv->type_tour = $type_tour;
                    $tours_reserv->tipo_pago = "PRED-PAID";
                    $tours_reserv->pago = $_SESSION ['toursbooking']['opcionPago'];
                    $tours_reserv->type_rate = $dat->type_rate;
                    $tours_reserv->agency_fee = $valorComision;
                    $tours_reserv->total = $total;
                    $tours_reserv->totalouta = $_SESSION['toursbooking']['totalouta'];
                    $tours_reserv->otheramount = $_SESSION['toursbooking']['otheramount'];
                    Doo::db()->insert($tours_reserv);
                }
                //$_SESSION['pago']
                $_SESSION['tourPagoOneDay'] = 'ok';
                $this->correo_onedaytour();
                unset($_SESSION['toursbooking']);
                //session_destroy();
            } else {
                if (isset($_SESSION['data_agency'])) {
                    return Doo::conf()->APP_URL . "agency/";
                } else {
                    return Doo::conf()->APP_URL . "one-day-tour/";
                }
            }
        }
    }

    public function validarFechaTours() {
        if (isset($this->params ["fecha"])) {
            $fecha = $this->params ["fecha"];
            list ($mes, $dia, $anyo) = explode("-", $fecha);
            $fecha2 = $anyo . "-" . $mes . "-" . $dia;
            $f0 = strtotime(date('Y-m-d h:i A'));
            $f1 = strtotime($fecha2);
            $resultado = ($f1 - $f0);
            $resultado = ($resultado / 60 / 60) + 1;
            $resultado = round($resultado);
            echo 'ok';
            if ($resultado > 2) {
                $disponible = true;
                $mensaje = '';
            } else {
                $disponible = false;
                $mensaje = "The maximum period for reservation of one-day-tours be until 10:00 PM the day prior to the date of departure";
            }
        }
    }

    public function types_payments() {
        return $op = array("1" => array("PRED-PAID" => "Agency Credit Card"),
            "2" => array("PRED-PAID" => 'Passenger Credit Card'),
            "3" => array("COLLECT ON BOARD" => "Credit Card+ 4 % FEE"),
            "4" => array("COLLECT ON BOARD" => "Cash"),
            "5" => array("VOUCHER" => "Credit Voucher")
        );
    }

}
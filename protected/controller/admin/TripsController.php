<?php

/**
 * Description of TripsController
 *
 * 
 */

Doo::loadController('I18nController');
class TripsController extends I18nController{
   
    public function beforeRun($resource, $action) {
       if (!isset($_SESSION['login'])) {
            return Doo::conf()->APP_URL;
        }
    }
    
    public function index(){
         // Cargamos el paginador
        Doo::loadHelper('DooPager'); 
        
        if (!isset($_POST["filtro"])) {
            if (!isset($this->params['filtro'])) {
                $filtro = "trip_no";
            } else {
                $filtro = $this->params['filtro'];
            }
        }else{
            $filtro = $_POST["filtro"];
        }
       
        if (!isset($_POST["texto"])) {
           if (!isset($this->params['texto'])) {
                $texto = "";
            } else {
                $texto = $this->params['texto'];
            } 
        } else {
            $texto = $_POST["texto"];
        }
               
        $rs    = Doo::db()->find("Trips", array("select"=>"COUNT(*) AS total", 
                                                     "where" => "$filtro like ?", 
                                                     "limit"=>1,
                                                     "param" => array($texto . '%')
                                                    ));
         $total = $rs->total;

         if ($total == 0)
           $total = 1;
        // iniciamos el paginador

        $pager = new DooPager(Doo::conf()->APP_URL."admin/trips/$filtro/$texto/page", $total, 10, 5);

        if(isset($this->params['pindex']))
            $pager->paginate(intval($this->params['pindex']));
        else
            $pager->paginate(1);
        
        $rs = Doo::db()->query("select trips.id,trip_no,equipment,lunes,martes,miercoles,jueves,viernes,sabado,domingo
                                from trips
                                
                                where $filtro like ?  order by trip_no limit $pager->limit ", 
                                array($texto.'%'));
        
        $trips = $rs->fetchAll();
		
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['content'] = 'configuracion/trips.php';
        $this->data['filtro']  = $filtro;
        $this->data['texto']   = $texto;
        $this->data['trips']   = $trips;
        $this->data['pager']   = $pager->output;
        $this->renderc('admin/index', $this->data,true);
    }
    
public function add(){
        Doo::loadModel("Trips");
        $trip = new Trips();
		$rs = Doo::db()->query("SELECT id_bus, id_trips , t2.capacidad,t2.plate,t3.trip_no,t2.tipobus

      									 		FROM bus_trips t1
      
											  LEFT JOIN bus t2 ON (t1.id_bus = t2.id)
											  LEFT JOIN trips t3 ON (t3.id = t1.id_trips) 

                                              WHERE  t1.id_trips = ?", 
                                array(""));
        
        $bus_trips = $rs->fetchAll();
		
		$sql ="SELECT  id,plate,tipobus,capacidad,fecha_ini,fecha_fin
		FROM bus
		WHERE id NOT IN (SELECT id_bus FROM bus_trips)";
		$rs = Doo::db()->query($sql);
        
        $libres = $rs->fetchAll();
		 
        
		$this->data['bus_trips']   =  $bus_trips;
		$this->data['libres']      =  $libres;
        $this->data['rootUrl']     = Doo::conf()->APP_URL;
        $this->data['trip']        = $trip;
        $this->data['equipos']     = Doo::db()->find("Codigos", array("where" => "tipo = 'equipment'", "asArray" => true));
        //$this->data['frecuencia']  = Doo::db()->find("Codigos", array("where" => "tipo = 'frecuency'","asArray" => true));
		
		$this->data['bus']     = Doo::db()->find("Bus", array("asArray" => true));
        $this->data['content'] = 'configuracion/frm_trip.php';
		$this->data['dato'] = "New";
        $this->renderc('admin/index', $this->data);
    }
    
    public function save(){ 
      
        Doo::loadModel("Trips");
        
         $trip = new Trips($_POST);
         $dias = $_POST['dias'];
		
		if(isset($_POST['id_bus'])){
		$bus_trips = $_POST['id_bus'];
		
		}
		
		if(isset($_POST['sacar'])){
		$bus_trips2 = $_POST['sacar'];
		}
		
	foreach ($dias as $valor)
		{
			if($valor == 1){
			
			$trip->lunes=1;
			
			}
			
			if($valor == 2){
			
			$trip->martes=1;
			
			}
			
			if($valor == 3){
			
			$trip->miercoles=1;
			
			}
			
			if($valor == 4){
			
			$trip->jueves=1;
			
			}
			
			if($valor == 5){
			
			$trip->viernes=1;
			
			}
			
			if($valor == 6){
			
			$trip->sabado=1;
			
			}
			
			if($valor == 7){
			
			$trip->domingo=1;
			
			}
			
		}
		
	  if($trip->lunes == ""){
                $trip->lunes=0;
               }
               if($trip->martes == ""){
                $trip->martes=0;
               }
               if($trip->miercoles == ""){
                $trip->miercoles=0;
               }
               if($trip->jueves == ""){
                $trip->jueves=0;
               }
               if($trip->viernes == ""){
                $trip->viernes=0;
               }
               if($trip->sabado == ""){
                $trip->sabado=0;
               }
               if($trip->domingo == ""){
                $trip->domingo=0;
               }

 
        $new = false;
      
        if ($_POST['id'] == "") {
            $trip->id = Null;
            $new = true;
        }

        $this->data['rootUrl'] = Doo::conf()->APP_URL;
      
        if ($new){
                Doo::db()->insert($trip);
	         $id = 	Doo::db()->lastInsertId();
			if(isset($bus_trips)){
		   
		    if(is_array($bus_trips))
	        {
		       	
			   for($i=0; $i<count($bus_trips); $i++){
			   
		
			   Doo::db()->query("INSERT INTO bus_trips (id_bus,id_trips)  

                                   VALUES ('$bus_trips[$i] ','$id')"
                                );
							
		     }
			 }
			 
			 } 
			 
			
	         
	     }
		 
        else{
			
			
           
		  
		    if(isset($_POST['change'])){
			$trip_no = $_POST['trip_no'];
			
			   $trips    = Doo::db()->find("Trips", array("select" => "trip_no,lunes,martes,miercoles,jueves,viernes,sabado,domingo",
                                                    "where"  => "trip_no like ?",
                                                    "asArray" => true,
                                                    "param"  => array($trip_no.'%')
                                                   ));
				
				
			if(!empty($trips)){
			 foreach($trips as $e){
			 
					$lunes = $e["lunes"];
					$martes = $e["martes"];
					$miercoles = $e["miercoles"];
					$jueves = $e["jueves"];
					$viernes = $e["viernes"];
					$sabado = $e["sabado"];
					$domingo = $e["domingo"];
					
			 }
			$info = false;
			     if($lunes != $trip->lunes)
				 {
				 	$info =  true;
				 }
				  if($martes != $trip->martes)
				 {
				 	$info = true;
				 }
				  if($miercoles != $trip->miercoles)
				 {
				 	$info = true;
				 }
			     if($jueves != $trip->jueves)
				 {
				 	$info = true;
				 }
				 if($viernes != $trip->viernes)
				 {
				 	$info = true;
				 }
				
			}	
					
					if($info){
						 $rs = Doo::db()->query("DELETE
														FROM programacion
														WHERE trip_no= '$trip_no'");
														
					 	$_SESSION['elimi'] ="ha eliminado la programacion de trip $trip_no, please generar programacion";
											
											
					}
					
											
			}
			
			Doo::db()->update($trip);
           if(isset($bus_trips)){
		   
		    if(is_array($bus_trips))
	        {
				
				
		       	
		for($i=0; $i<count($bus_trips); $i++){
			   
		     $rs =  Doo::db()->query("SELECT id_bus, id_trips 
												FROM bus_trips
													WHERE id_bus = ? AND id_trips = ?"
                                ,array($bus_trips[$i],$trip->id ));
								
				$variable = $rs->fetchall();				
				
			if(empty($variable))
			{	
							
			   Doo::db()->query("INSERT INTO bus_trips (id_bus,id_trips)  

                                   VALUES ('$bus_trips[$i] ','$trip->id')"
                                );
			}
							
		     }
			 }
			 
			 } 
			 
			 
			 if(isset($bus_trips2)){
		  
		    if(is_array($bus_trips2))
	        {
		       	
				
				
			   for($i=0; $i<count($bus_trips2); $i++){
			   	
		
			   Doo::db()->query("DELETE
									FROM bus_trips
									WHERE id_bus = '$bus_trips2[$i]' AND id_trips= '$trip->id'"
                                );
							
		     }
			 }
			 
	} 
			
}
       
         return Doo::conf()->APP_URL . "admin/trips";
                
    }
    
    public function edit() {
        Doo::loadModel("Trips");
        $trip = new Trips();
		$trip->id = $this->params["pindex"];
		   $rs = Doo::db()->query("SELECT id_bus, id_trips , t2.capacidad,t2.plate,t3.trip_no,t2.tipobus

      									 		FROM bus_trips t1
      
											  LEFT JOIN bus t2 ON (t1.id_bus = t2.id)
											  LEFT JOIN trips t3 ON (t3.id = t1.id_trips) 

                                              WHERE  t1.id_trips = ?", 
                                array($trip->id));
        
        $bus_trips = $rs->fetchAll();
		$sql ="SELECT  id,plate,tipobus,capacidad,fecha_ini,fecha_fin
		FROM bus
		WHERE id NOT IN (SELECT id_bus FROM bus_trips)";
		$rs = Doo::db()->query($sql);
        
        $libres = $rs->fetchAll();
		
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['trip']        = Doo::db()->find($trip, array('limit' => 1));
		
		$this->data['bus_trips']  = $bus_trips;
		
		$this->data['libres']  = $libres;
        $this->data['equipos']     = Doo::db()->find("Codigos", array("where" => "tipo = 'equipment'", "asArray" => true));
		$this->data['bus']     = Doo::db()->find("Bus", array("asArray" => true));
       // $this->data['frecuencia']  = Doo::db()->find("Codigos", array("select tipo from Codigos" ,"asArray" => true));
        $this->data['content'] = 'configuracion/frm_trip.php';
		$this->data['dato'] = "edit";
        $this->view()->renderc('admin/index', $this->data);
    }

    public function delete() {
        Doo::loadModel("Trips");
        $trip = new Trips();
        $trip->id = $_REQUEST['item'];
        Doo::db()->delete($trip);
        return Doo::conf()->APP_URL . "admin/trips";
    }
	
	public function passengers(){
         // Cargamos el paginador
        Doo::loadHelper('DooPager'); 
        
		 if (!isset($_POST["trip"])) {
            if (!isset($this->params['trip'])) {
	        	$trip = "100";
            } else {
                $trip = $this->params['trip'];
	    	}
        }else{
	    	$trip = $_POST["trip"];
        }
		if (!isset($_POST["fecha_ini"])) {
            if (!isset($this->params['fecha_ini'])) {
	        	$fecha = date('m-d-Y');
            } else {
                $fecha = $this->params['fecha_ini'];
			}
        }else{
	    	$fecha = $_POST["fecha_ini"];
        }
		$fe = $fecha;
		$url = "admin/trips/passengers/$trip/$fe";
		list($mes, $dia, $anyo) = explode("-", $fecha);
        $fecha = $anyo . "-" . $mes . "-" . $dia;
		$total = $this->totalReservas($trip,$fecha);
        $pager = new DooPager(Doo::conf()->APP_URL."admin/trips/passengers/$trip/$fe/page", $total, $total, $total);

        if(isset($this->params['pindex']))
            $pager->paginate(intval($this->params['pindex']));			
        else
            $pager->paginate(1);

		
		/*BORRAMOS DATOS DE LAS VARIABLES DE SESSION*/
		unset($_SESSION['asignacion']);
		unset($_SESSION['total_areas']);
		unset($_SESSION['buses']);
		unset($_SESSION['reservas']);
		unset($_SESSION['estado_equipaje']);
		unset($_SESSION['estado_bus']);
		unset($_SESSION['total_areas']);
		unset($_SESSION['totalPax']);

		
		//Buscamos la reservas
		$reservas = $this->reservas($trip,$fecha);	
		$_SESSION['reservas'] = $reservas;	
		$botones = array();
		
		if(count($reservas)==0){
			$botones['btn-save'] = 'none';
			$botones['btn-bus'] = 'none';
			$botones['btn-areas'] = 'none';
		}/*else if ($_SESSION['estado_equipaje'] == 0){
			$botones['btn-areas'] = 'none';
			$botones['btn-bus'] = 'none';
		}*/else if($_SESSION['estado_bus'] == 0){
			$botones['btn-bus'] = 'none';
		}
		
		
		
		
		$sql = "select trips.id,trip_no,equipment,lunes,martes,miercoles,jueves,viernes,sabado,domingo
                                from trips
                                order by trip_no limit $pager->limit ";
		$rs = Doo::db()->query($sql, 
                                array());
		$sqlT = "SELECT `id`, `trip_no`, `equipment` FROM  `trips` ORDER BY  `trips`.`trip_no` ASC  ";
		$rs = Doo::db()->query($sqlT, array());
        $trips = $rs->fetchAll();
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['content'] = 'configuracion/passengers_trip.php';
        $this->data['trips']   = $trips;
		$this->data['trip_no']   = $trip;
		$this->data['botones']   = $botones;
		$this->data['fecha'] = $fecha;
		$this->data['reservas']   = $reservas;
        $this->data['pager']   = $pager->output;
		$this->data['url']   = $url;
        $this->renderc('admin/index', $this->data,true);
    }
	
	
	
	public function reservas($trip, $fecha){
		//** Adecuar para fromt2 y tot2 
												
		$rIda = array();
		$rRetorno = array();
        // Buscamos las de ida
	
			/*$sql = "SELECT r.id,codconf,fecha_ini,hora,tipo_ticket,fecha_salida,fecha_retorno,pax,pax2,
							pax+pax2 as totalPax, r.type_tour, r.tipo_pago, r.pago,r.totaltotal,r.otheramount, r.total2, 
							upper(firsname) as firsname ,upper(lasname) as lasname, r.trip_no,
							totaltotal, ar.nombre as de, ob.nombre as para, r.fromt, r.tot,
							ot.phone as phone, IFNULL(upper(ag.company_name),'Supertours') as company_name, pk.place as pickup,
							pk.place as pickup_index, do.place as dropoff, do.place as dropoff_index,
							e1.place as nomExten1, e2.place as nomExten2, r.luggage1 as luggage, fecha_salida as fecha , pb.id_bus as bus,
						    pk.posicion as pos_pk,
							do.posicion as pos_po
						FROM reservas r
							left join areas ar on (r.fromt = ar.id)
							left join areas ob on (r.tot =  ob.id) 
							left join pickup_dropoff pk on (r.pickup1 =  pk.id) 
							left join pickup_dropoff do on (r.dropoff1 =  do.id) 
							left join extension e1 on (r.extension1 =  e1.id) 
							left join extension e2 on (r.extension2 =  e2.id) 
							left join clientes ot on (r.id_clientes =  ot.id) 
							left join agencia ag on (r.agency =  ag.id) 
							left join passengers_bus pb on (r.id =  pb.id_reservas AND r.trip_no = pb.trip) 
						WHERE `trip_no` = ? AND fecha_salida =  ?	
						ORDER BY pk.posicion DESC";
			$rs = Doo::db()->query($sql, array( $trip, $fecha ));														
			$rIda = $rs->fetchAll();*/
		
			//Regreso
			/*$sql = "SELECT r.id,codconf,fecha_ini,hora,tipo_ticket,fecha_salida,fecha_retorno,pax,pax2,
							pax+pax2 as totalPax, r.type_tour, r.tipo_pago, r.pago,r.totaltotal,r.otheramount, r.total2,
							upper(firsname) as firsname ,upper(lasname) as lasname,totaltotal,
							ar.nombre as de, ob.nombre as para,
							r.fromt2 as fromt, r.tot2 as tot, ot.phone as phone, IFNULL(upper(ag.company_name),'Supertours') as company_name ,
							pk.place as pickup, do.place as dropoff,
							pk.place as pickup_index, do.place as dropoff, do.place as dropoff_index,
							e1.place as nomExten1, e2.place as nomExten2,
							r.luggage2 as luggage, fecha_retorno as fecha , r.trip_no2 as trip_no, pb.id_bus as bus,
							pk.posicion as pos_pk,
							do.posicion as pos_po
						FROM reservas r
							left join areas ar on (r.fromt2 = ar.id)
							left join areas ob on (r.tot2 =  ob.id)
							left join pickup_dropoff pk on (r.pickup2 =  pk.id)
							left join pickup_dropoff do on (r.dropoff2 =  do.id)
							left join extension e1 on (r.extension3=  e1.id)
							left join extension e2 on (r.extension4 =  e2.id)
							left join clientes ot on (r.id_clientes =  ot.id)
							left join agencia ag on (r.agency =  ag.id)
							left join passengers_bus pb on (r.id =  pb.id_reservas AND r.trip_no2 = pb.trip)
						WHERE trip_no2 = ?  AND  fecha_retorno = ?  AND tipo_ticket = 'roundtrip'
						ORDER BY do.posicion ASC";*/
        $dis = substr($trip,-1);
        if($dis == 0){
            $dir = 'result.pos_po ASC';
        }else{
            $dir = 'result.pos_pk DESC, result.pos_po ASC';
        }

        $sql = "select * from ((SELECT r.id,
                  codconf,
                  fecha_ini,
                  hora,
                  tipo_ticket,
                  fecha_salida,
                  fecha_retorno,
                  pax,
                  pax2,
                  pax+pax2 as totalPax,
                  r.type_tour,
                  r.tipo_pago,
                  r.pago,
                  r.totaltotal,
                  r.otheramount,
                  if(r.type_tour = 'MULTI',t.total,if(r.type_tour = 'ONE',ton.total,r.total2)) as total2,
                  upper(firsname) as firsname ,
                  upper(lasname) as lasname,
                  r.trip_no,
                  ar.nombre as de,
                  ob.nombre as para,
                  r.fromt,
                  r.tot,
                  ot.phone as phone,
                  IFNULL(upper(ag.company_name),'Supertours') as company_name,
                  pk.place as pickup,
                  pk.place as pickup_index,
                  do.place as dropoff,
                  do.place as dropoff_index,
                  e1.place as nomExten1,
                  e2.place as nomExten2,
                  r.luggage1 as luggage,
                  fecha_salida as fecha ,
                  pb.id_bus as bus,
                  pk.posicion as pos_pk,
                  do.posicion as pos_po
                FROM reservas r
                  left join areas ar on (r.fromt = ar.id)
                  left join areas ob on (r.tot = ob.id)
                  left join pickup_dropoff pk on (r.pickup1 = pk.id)
                  left join pickup_dropoff do on (r.dropoff1 = do.id)
                  left join extension e1 on (r.extension1 = e1.id)
                  left join extension e2 on (r.extension2 = e2.id)
                  left join clientes ot on (r.id_clientes = ot.id)
                  left join agencia ag on (r.agency = ag.id)
                  left join passengers_bus pb on (r.id = pb.id_reservas AND r.trip_no = pb.trip)
                  left join tours as t on (t.id_reserva = r.id)
                  left join tours_oneday as ton on (ton.id_reserva = r.id)
                WHERE `trip_no` = ? AND
                      fecha_salida = ?)

               UNION ALL

               (
                 SELECT re.id,codconf,
                   fecha_ini,
                   hora,
                   tipo_ticket,
                   fecha_salida,
                   fecha_retorno,
                   pax,
                   pax2,
                   pax+pax2 as totalPax,
                   re.type_tour,
                   re.tipo_pago,
                   re.pago,
                   re.totaltotal,
                   re.otheramount,
                   if(re.type_tour = 'MULTI',t.total,if(re.type_tour = 'ONE',ton.total,re.total2)) as total2,
                   upper(firsname) as firsname ,
                   upper(lasname) as lasname,
                   trip_no2,
                   ar.nombre as de,
                   ob.nombre as para,
                   re.fromt2 as fromt,
                   re.tot2 as tot,
                   ot.phone as phone,
                   IFNULL(upper(ag.company_name),'Supertours') as company_name,
                   pk.place as pickup,
                   pk.place as pickup_index,
                   do.place as dropoff,
                   do.place as dropoff_index,
                   e1.place as nomExten1,
                   e2.place as nomExten2,
                   re.luggage2 as luggage,
                   fecha_retorno as fecha ,
                   pb.id_bus as bus,
                   pk.posicion as pos_pk,
                   do.posicion as pos_po
                 FROM reservas re
                   left join areas ar on (re.fromt2 = ar.id)
                   left join areas ob on (re.tot2 = ob.id)
                   left join pickup_dropoff pk on (re.pickup2 = pk.id)
                   left join pickup_dropoff do on (re.dropoff2 = do.id)
                   left join extension e1 on (re.extension3= e1.id)
                   left join extension e2 on (re.extension4 = e2.id)
                   left join clientes ot on (re.id_clientes = ot.id)
                   left join agencia ag on (re.agency = ag.id)
                   left join passengers_bus pb on (re.id = pb.id_reservas AND re.trip_no2 = pb.trip)
                   left join tours as t on (t.id_reserva = re.id)
                   left join tours_oneday as ton on (ton.id_reserva = re.id)
                 WHERE trip_no2 = ?
                       AND fecha_retorno = ?
                       AND tipo_ticket = 'roundtrip'))
                       as result order by $dir;";
			$rs = Doo::db()->query($sql, array( $trip, $fecha,$trip, $fecha ));
			$rRetorno = $rs->fetchAll();
		//Unimos reservas
		$reservas = array();
		$cont = 0;
		$_SESSION['estado_equipaje'] = '1';
		$_SESSION['estado_bus'] = '1';
		/*if(!empty($rIda)){
			foreach($rIda as $e){
				$e['tipo'] = 'I';// IDA
				$reservas[$cont++] = $e;
				if($e['luggage']==-1){
					$_SESSION['estado_equipaje'] = '0';
				}
				if(trim($e['bus'])==''){
					$_SESSION['estado_bus'] = '0';
				}
			}
		}*/
		
		if(!empty($rRetorno)){
			foreach($rRetorno as $e){
				$e['tipo'] = 'R';
				$reservas[$cont++] = $e;
				if($e['luggage']==-1){
					 $_SESSION['estado_equipaje'] = '0';
				}
				if(trim($e['bus'])==''){
					$_SESSION['estado_bus'] = '0';
				}
			}
		}

		return $reservas;
	}
	
	public function orderMultiDimensionalArray ($toOrderArray, $field, $inverse = false) {  
		$position = array();  
		$newRow = array();  
		foreach ($toOrderArray as $key => $row) {  
				$position[$key]  = $row[$field];  
				$newRow[$key] = $row;  
		}  
		if ($inverse == true) {  
			arsort($position);  
		}  
		else {  
			asort($position);  
		}  
		$returnArray = array();  
		foreach ($position as $key => $pos) {       
			$returnArray[] = $newRow[$key];  
		}  
		return $returnArray;  
   }  
	
	public function totalReservas($trip,$fecha){
		$sqlT1 = "SELECT COUNT(*) as total 
						FROM reservas 
						Where (trip_no = ? AND  fecha_salida = ?) OR (trip_no2 = ? AND  fecha_retorno = ?)" ;
		$rs    = Doo::db()->query($sqlT1,array($trip, $fecha,$trip, $fecha));
		
		$rTotal1 = $rs->fetchAll();
        $total = ($rTotal1[0]['total']!='')?$rTotal1[0]['total']:0;
        if ($total == 0)
           $total = 1;
		return $total;
	}
	
	public function totalPasajeros($trip,$fecha){
		$sqlT1 = "SELECT SUM(pax) + SUM(pax2) as total 
						FROM reservas 
						Where (trip_no = ? AND  fecha_salida = ?) OR (trip_no2 = ? AND  fecha_retorno = ?)" ;
		$rs    = Doo::db()->query($sqlT1,array($trip, $fecha,$trip, $fecha));
		$rTotal1 = $rs->fetchAll();
        $total = ($rTotal1[0]['total']!='')?$rTotal1[0]['total']:0;
		return $total;
	}
	
	
	
	public function totalPaxBus(){
		$reserv_bus = $_SESSION['reserv_bus'];
		$totalBus = array();
		$buses = $_SESSION['buses'];
		foreach($buses as $b){
			$totalBus[$b['id_bus']] = 0;
		}
		foreach($reserv_bus  as $key => $e){
			$r_bus = $e;
			foreach($r_bus as $r){
				if(!isset($totalBus[$key])){
					$totalBus[$key] = 0;
				}
				$totalBus[$key] =  $totalBus[$key] +  $r['totalPax'];
			}		
		}
		return $totalBus;
	}
	
	public function save_luggage(){
		Doo::loadHelper('DooPager'); 
		if (!isset($_POST["trip"])) {
            if (!isset($this->params['trip'])) {
	        	$trip = "100";
            } else {
                $trip = $this->params['trip'];
	    	}
        }else{
	    	$trip = $_POST["trip"];
        }
		if (!isset($_POST["fecha_ini"])) {
            if (!isset($this->params['fecha_ini'])) {
	        	$fecha = date('m-d-Y');
            } else {
                $fecha = $this->params['fecha_ini'];
			}
        }else{
	    	$fecha = $_POST["fecha_ini"];
        }
		list($mes, $dia, $anyo) = explode("-", $fecha);
        $fecha = $anyo . "-" . $mes . "-" . $dia;
		$fe = $mes . "-" . $dia."-".$anyo;
		$total = $this->totalReservas($trip,$fecha);
        $pager = new DooPager(Doo::conf()->APP_URL."admin/trips/passengers/$trip/$fe/page", $total, 10, 5);

        if(isset($this->params['pindex']))
            $pager->paginate(intval($this->params['pindex']));			
        else
            $pager->paginate(1);
		
		
		//Buscamos la reservas
		$reservas = $_SESSION['reservas'];
		foreach($reservas  as $e){
			if(isset($_POST['equipaje_'.$e['id']])){
				$equipaje = $_POST['equipaje_'.$e['id']];
				if($e['tipo'] == 'I'){
					$sql = "UPDATE  `reservas` SET  `luggage1` =  ? WHERE  `reservas`.`id` = ? ";
				}else{
					$sql = "UPDATE  `reservas` SET  `luggage2` =  ? WHERE  `reservas`.`id` = ? ";
				}
				$rs    = Doo::db()->query($sql,array($equipaje, $e['id']));
			}
		}
		return Doo::conf()->APP_URL."admin/trips/passengers/$trip/$fe";
	}
	
	public function passengers_bus_one(){
		if (!isset($_POST["trip"])) {
            if (!isset($this->params['trip'])) {
	        	$trip = "100";
            } else {
                $trip = $this->params['trip'];
	    	}
        }else{
	    	$trip = $_POST["trip"];
        }
		
		if (!isset($_POST["direction"])) {
            if (!isset($this->params['direction'])) {
	        	$dir = 1;
            } else {
                $dir = $this->params['direction'];
	    	}
        }else{
	    	$dir = $_POST["direction"];
        }
		
		if (!isset($_POST["fecha_ini"])) {
            if (!isset($this->params['fecha_ini'])) {
	        	$fecha = date('m-d-Y');
            } else {
                $fecha = $this->params['fecha_ini'];
			}
        }else{
	    	$fecha = $_POST["fecha_ini"];
        }
		list($mes, $dia, $anyo) = explode("-", $fecha);
        $fecha = $anyo . "-" . $mes . "-" . $dia;
		$dir = $trip[2];
		if(!isset($_SESSION['asignacion'])){
			$_SESSION['asignacion'] = array();
		}
		$asignacion = $_SESSION['asignacion'];
		
		$reservas = $this->reservasXArea($trip,$fecha,$dir);
		$_SESSION['total_areas'] = count($reservas);
		$r_to_from = $this->reservasFromTo($trip,$fecha,$reservas);
		$_SESSION['r_to_from'] = $r_to_from;
		$total = $this->totalReservas($trip,$fecha);
		$totalPax =  $this->totalPasajeros($trip,$fecha);
		$_SESSION['totalPax'] = $totalPax;
		$buses = $this->buses($trip, $fecha);
		$_SESSION['buses'] = $buses;	
		$this->busesAreas($r_to_from);// Mirar el estado de cada area con respecto a las reservas de from.
		$area_to_from = $_SESSION['area_to_from'];
		$bus_to_from = $_SESSION['bus_to_from'];
		$bus_area = $_SESSION['bus_area'];	
		
		$this->data['rootUrl'] = Doo::conf()->APP_URL;
		$this->data['reservas'] = $reservas;
		$this->data['r_to_from'] = $r_to_from;
		$this->data['area_to_from'] = $area_to_from;
		$this->data['bus_to_from'] = $bus_to_from;
		$this->data['bus_area'] = $bus_area;
		$this->data['asignacion'] = $asignacion;
		$this->data['buses'] = $buses;
		$this->data['total'] = $total;
		$this->data['totalPax'] = $totalPax;
		$this->data['fecha'] = $fecha;
		$this->data['msg_areas'] = $this->opcionGuarda_Areasr();
		$this->data['trip'] = $trip;
        $this->data['content'] = 'configuracion/passengers_bus.php';
        $this->renderc('admin/index', $this->data,true);
	}
	
	public function busesAreas($r_to_from){
		$asignacion = $_SESSION['asignacion'];
		$buses = $_SESSION['buses'];
		$bus_to_from = array();
		$area_to_from = array();
		$bus_area = array();
		foreach($r_to_from as $to => $array){
			if(isset($asignacion[$to])){
				$tt = count($array);
				$cont = 0;
				foreach($array as $from => $val){
					if(isset($asignacion[$to][$from])){
						$cont++;
						$bus_to_from[$to][$from] = $asignacion[$to][$from];
						$bus_area[$asignacion[$to][$from]][$to] = 1;
					}
				}
				$area_to_from[$to] = $tt-$cont;
			}else{
				$area_to_from[$to] = count($array);
			}
		}
		//exit();
		$_SESSION['area_to_from'] = $area_to_from;
		$_SESSION['bus_to_from'] = $bus_to_from;
		$_SESSION['bus_area'] = $bus_area;
	}
	
	public function reservasXArea($trip, $fecha, $dir){
		$reservas = array();
        // Buscamos las de ida
			$sql = "SELECT  r.tot, (SUM(pax) + SUM(pax2)) as totalpax, count(r.tot ) as total, ob.nombre as para
						FROM reservas r
							left join areas ob on (r.tot =  ob.id) 
						Where (trip_no = ? AND  fecha_salida = ?)
						GROUP BY (r.tot) ORDER BY ob.id ASC";
						
			$rs = Doo::db()->query($sql, array( $trip, $fecha));											
			$reservas1 = $rs->fetchAll();
			
			
			//Buscamos las de Regreso
			$sql = "SELECT  r.tot2 as tot, (SUM(pax) + SUM(pax2)) as totalpax, count(r.tot2 ) as total, ob.nombre as para
						FROM reservas r
							left join areas ob on (r.tot2 =  ob.id) 
						Where (trip_no2 = ? AND  fecha_retorno = ?)
						GROUP BY (r.tot2) ORDER BY ob.id DESC";
			$rs = Doo::db()->query($sql, array( $trip, $fecha ));	
			$reservas2 = $rs->fetchAll();
			foreach($reservas1 as $val){
				$reservas[] = $val;
			}
			foreach($reservas2 as $val){
				$reservas[] = $val;
			}
		return $reservas;
	}
	
	
	public function reservasFromTo($trip, $fecha, $r_tot){
		$from_to = array();
        // Buscamos las de ida
		$sql = "SELECT  r.fromt, r.tot,(SUM(pax) + SUM(pax2)) as totalpax, count(r.tot ) as total, ob.nombre as de
				FROM reservas r
					left join areas ob on (r.fromt =  ob.id) 
				Where (trip_no = ? AND  fecha_salida = ?)
				GROUP BY r.fromt, r.tot ORDER BY ob.id DESC";	
		$rs = Doo::db()->query($sql, array( $trip, $fecha));											
		$from_to_ida = $rs->fetchAll();
		
		// Buscamos las de regreso
		$sql = "SELECT  r.fromt2 as fromt, r.tot2 as tot,(SUM(pax) + SUM(pax2)) as totalpax, count(r.tot2 ) as total, ob.nombre as de
				FROM reservas r
					left join areas ob on (r.fromt2 =  ob.id) 
				Where (trip_no2 = ? AND  fecha_retorno = ?)
				GROUP BY r.fromt2, r.tot2 ORDER BY ob.id DESC";	
		$rs = Doo::db()->query($sql, array( $trip, $fecha));											
		$from_to_return = $rs->fetchAll();
		$from_to = array_merge($from_to_ida, $from_to_return);
		$r_from_to = array();
			foreach($r_tot as $to){
				$array = array();
				foreach($from_to as $val){
					if($val['tot'] == $to['tot']){
						$array[$val['fromt']] = $val;
					}
				}
				$r_from_to[$to['tot']]	= $array;
			}
		return $r_from_to;
	}
	
	public function buses($trip, $fecha){
		$sql = "SELECT bt.`id_bus`, bt.`id_trips` , b.`plate`, b.`tipobus`, b.`capacidad`, b.`fecha_ini`, b.`fecha_fin`
				FROM `bus_trips` bt 
					LEFT JOIN bus b on (bt.id_bus = b.id)
					LEFT JOIN trips t on (bt.id_trips = t.id)
				WHERE t.trip_no	 = ? AND  b.`fecha_ini`<= ? AND  b.`fecha_fin` >= ? ";
		$rs = Doo::db()->query($sql, array( $trip, strtotime($fecha), strtotime($fecha)));	
		$buses = $rs->fetchAll();
		return $buses;
				
	}
	
	public function reserves_bus_area_add(){
		if (isset($this->params['area']) && isset($this->params['bus'])) {
			$area = $this->params['area'];
			$axu = substr_count($area,'-');
			$bus = $this->params['bus'];
			if($axu>0){
				$this->reserves_bus_fromt_to_add($area,$bus);
			}else{
				$asignacion = $_SESSION['asignacion'];
				$r_to_from = $_SESSION['r_to_from'];
				$array = $r_to_from[$area];
				foreach($array as $v){
					$from = $v['fromt'];
					if(!isset($asignacion[$area][$from ])){
						$asignacion[$area][$from ] = $bus;	
						echo "<script>meter_bus2($area,$from,$bus,1,0,0,0);</script>";
					}
				}
				$_SESSION['asignacion'] = $asignacion;
				$this->opcionGuarda_Areasr();
				$msg_area = $this->opcionGuarda_Areasr();
				echo "<script>document.getElementById('opcionGuardar').value = '$msg_area'</script>";
			}
        } 
	}
	
	public function reserves_bus_fromt_to_add($area,$bus){
		list($from, $tot) = explode('-',$area);
		$asignacion = $_SESSION['asignacion'];
		$bus_viejo = isset($asignacion[$tot][$from])?$asignacion[$tot][$from]:0;
		$asignacion[$tot][$from] = $bus;
		$_SESSION['asignacion'] = $asignacion;
		$cont=0;
		$cont_bv=0;
		$ver = 1;
		$ocupadas = 0;
		foreach($asignacion[$tot] as $va){
			$ocupadas++;
			if($bus == $va){
				$cont++;
			}
			if($bus_viejo == $va){
				$cont_bv++;
			}
		}
		if($cont>1){
			$ver = 0;
		}
		if($cont_bv!=0){// para que no lo oculte
			$bus_viejo = 0;
		}
		$r_to_from = $_SESSION['r_to_from'];
		$iniciales = count($r_to_from[$tot]);
		$nrt = $iniciales - $ocupadas; //numero de areas inicales
		echo "<script>meter_bus2($tot,$from,$bus,$ver,$nrt,$bus_viejo,1);</script>";	
	}
	
	public function reserves_bus_area_dell(){
		if (isset($this->params['area']) && substr_count($this->params['area'],'-')) {
			list($from, $tot) = explode('-',$this->params['area']);
			$asignacion = $_SESSION['asignacion'];
			$cont = 0;
			if(isset($asignacion[$tot][$from])){
				$bus = $asignacion[$tot][$from];
				unset($asignacion[$tot][$from]);
				$_SESSION['asignacion'] = $asignacion;
				foreach($asignacion[$tot] as $va){
					if($bus == $va){
						$cont++;
					}
				}
				echo "<script>sacar_bus($tot,$from,$bus,$cont);</script>";
				$msg_area = $this->opcionGuarda_Areasr();
				echo "<script>document.getElementById('opcionGuardar').value = '$msg_area'</script>";
			}
        } 
	}
	
	public function opcionGuarda_Areasr(){
		$asignacion = $_SESSION['asignacion'];
		$asgin_areas = count($asignacion);
		$total_areas = $_SESSION['total_areas'];
		if($asgin_areas == $total_areas){
			$msg_areas = '';
		}else{
			$msg_areas = 'You must put all the areas in a bus available';
		}
		return $msg_areas;
	}
	
	public function reserves_bus_area_save(){
		 Doo::loadModel("Passengers_Bus");
		$asignacion = $_SESSION['asignacion'];
		$asgin_areas = count($asignacion);
		$total_areas = $_SESSION['total_areas'];
		if($asgin_areas == $total_areas && isset($_POST["trip"]) && isset($_POST["fecha"]) ){
			$trip = $_POST["trip"];
			$fecha = $_POST["fecha"];
			$reservas = $_SESSION['reservas'] ;
			$reservas = $this->orderMultiDimensionalArray($reservas,'firsname'); 
			$reserv_bus = array();
			$aux = array();
			
			foreach($reservas as $e){
				$bus = $asignacion[$e['tot']][$e['fromt']];
				$pb = new Passengers_Bus();
				$pb->id_reservas = $e['id'];
				$pb->trip = $trip;
				$e['bus'] = $bus;
				$reserv_bus[$bus][] = $e;
				$result = Doo::db()->find($pb ,array("limit",1)); 
				if(empty($result)){
					$pb->id = NULL;
					$pb->id_bus = $bus;
					Doo::db()->insert($pb);
				}else{
					$pb = new Passengers_Bus($result [0]);
					$pb->id_bus = $bus;
					Doo::db()->update($pb);
				}
				
				$aux[] = $e;
			}
			$reservas = $aux;
			$_SESSION['reservas'] = $reservas;
			$_SESSION['reserv_bus'] = $reserv_bus;
			return Doo::conf()->APP_URL . "admin/trips/passengers/bus-two";
		}
	}
	
	public function passengers_bus_two(){
        Doo::loadHelper('DooPager'); 
		$reservas = $_SESSION['reservas'];
		

		$trip = $reservas[0]['trip_no'];
		$fecha = $reservas[0]['fecha'];
		$reservas = $this->reservas($trip,$fecha);
		$aux = array();
		$buses =  $this->buses($trip,$fecha);
		$_SESSION['buses'] = $buses;
		$cancel = -1;
		if(!isset($_SESSION['asignacion'])){
			$cancel = -2;
		}
		
		//INICIO
			$reservas = $this->orderMultiDimensionalArray($reservas,'firsname'); 
			$reserv_bus = array();
			foreach($reservas as $e){
				$reserv_bus[$e['bus']][] = $e;
			}
			$_SESSION['reserv_bus'] = $reserv_bus;
		//FIN
		
		$total = $this->totalReservas($trip,$fecha);
		$totalPaxBus = $this->totalPaxBus();
		$msg_buses = $this->validarBuses();
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['content'] = 'configuracion/passengers_bus_2.php';
		$this->data['trip']   = $trip;
		$this->data['fecha'] = $fecha;
		$this->data['totalPaxBus'] = $totalPaxBus;
		$this->data['msg_buses'] = $msg_buses;
		$this->data['reservas']   = $reservas;
		$this->data['buses'] = $buses;
		$this->data['total'] = $total;
		$this->data['cancel'] = $cancel;
        $this->renderc('admin/index', $this->data, true);
	}
	
	public function reserves_bus_add(){
		if (isset($this->params['bus']) && isset($this->params['r_string'])) {
			$bus = $this->params['bus'];
			$r_string = $this->params['r_string'];
			$r_pasar = explode("-",$r_string);
			
			if(!empty($r_pasar)){
				$this->pasarReservas($bus, $r_pasar);
				$this-> validarBuses();
			}else{
				echo "<script>alert('Choose stocks you want to change buses');</script>";
			}
		}else{
			echo "<script>alert('Ups. Failed bus assignment. Update page');</script>";
		}
	}
	
	public function pasarReservas($bus, $r_pasar){
		$reserv_bus = array();
		$reservas = $_SESSION['reservas'];
		$aux = array();
		$bus_viejo = '';
		foreach($reservas as $e){
			foreach($r_pasar as $id){
				if($e['id']==$id){
					$bus_viejo = $e['bus'];
					$e['bus'] = $bus;
				}
			}
			$aux[] = $e;
			$reserv_bus[$e['bus']][] = $e;
			echo "<script>document.getElementById('r_'+".$e['id'].").value = 0;</script>";
		}
		$reservas = $aux;
		$_SESSION['reservas'] = $reservas;
		$_SESSION['reserv_bus'] = $reserv_bus;
		$this->mostrarReservas($bus);
		echo '<script>bg_tr("'.$bus_viejo.'");
			bg_tr("'.$bus.'");
		</script>';
		$this->allotted();
	}
	
	public function allotted(){
		$totalPax = $this->totalPaxBus();
		foreach($totalPax as $key => $e){
            	echo "<script>$('#allotted'+".$key.").html('".$e."');</script>";
			
		}
	}
	
	public function mostrarReservas($bus){
		$reserv_bus = $_SESSION['reserv_bus'];
		$i = 0;
		foreach($reserv_bus[$bus] as $e){
			echo '<script>cambiar("'.$e['id'].'", "'.$bus.'");</script>';
		}
	}
	public function ordernar_bus(){
		if (isset($this->params['bus']) && isset($this->params['c_order'])) {
			$bus = $this->params['bus'];
			$c_order = $this->params['c_order'];
			$invertir = $this->params['invertir'];
			$r_bus = $_SESSION['reserv_bus'][$bus];
			$r_bus = $this->orderMultiDimensionalArray($r_bus,$c_order, $invertir);
			$_SESSION['reserv_bus'][$bus] = $r_bus;
			$this->mostrarReservas($bus);
			echo '<script>bg_tr("'.$bus.'");</script>';
		}
	}
	
	public function reserves_bus_save(){
		$buses = $_SESSION['buses'];
		$msg_buses = $this->validarBuses();
		if($msg_buses==''){
			Doo::loadModel("Passengers_Bus");
			$reservas = $_SESSION['reservas'];
			foreach($reservas as $e){
				$pb = new Passengers_Bus();
				$pb->id_reservas = $e['id'];
				$pb->id_bus = $e['bus'];
				$pb->trip = $e['trip_no'];
				$result = Doo::db()->find($pb ,array("limit",1)); 
				if(empty($result)){
					$pb->id = NULL;
					Doo::db()->insert($pb);
				}else{
					$pb = new Passengers_Bus($result [0]);
					$pb->id_bus = $e['bus'];
					Doo::db()->update($pb);
				}
			}
			return Doo::conf()->APP_URL . "admin/trips/passengers/bus-two";
		}else{
			echo '<script>alert("'.$msg_buses.'");</script>';
		}
	}
	
	public function validarBuses(){
		$buses = $_SESSION['buses'];
		$reserv_bus = $_SESSION['reserv_bus'];
		$mensaje = '';
		foreach($buses as $e){
			$abordo = $this->totalPaxBus();
			if($abordo[$e['id_bus']]>$e['capacidad']){
				$mensaje .= '- It has exceeded the capacity of the bus '.$e['plate'].'-'.$e['tipobus'].'    ';
			}
		}
		"<script>document.getElementById('opcionGuardar').value = '".trim($mensaje)."';</script>";
		return $mensaje;
	}
	
	public function pdf(){
		if (isset($this->params['bus']) && isset($this->params['trip']) && isset($this->params['fecha']) && isset($this->params['order'])) {
		  $bus = $this->params['bus'];
		  $trip = $this->params['trip'];
		  $fecha = $this->params['fecha'];
		  $torder = $this->params['order'];
		  $reservas = $this->reservas($trip, $fecha);
		  if($torder == 1){
			  $cOrder = 'pickup_index';
		  }else{
			 $cOrder = 'dropoff_index';
		  }
		 $dir = $trip[strlen($trip)-1];
		 if($dir == 0){
			 $txtdir = 'MCO/MIA';
			// $reservas = $this->orderMultiDimensionalArray($reservas, $cOrder , false);
		 }else{
			 $txtdir = 'MIA/MCO';
			// $reservas = $this->orderMultiDimensionalArray($reservas, $cOrder, true);
		 }
		 Doo::loadModel("Bus");
		 $trans_bus = new Bus();
		 $trans_bus->id = $bus;
		
		 $trans_bus = Doo::db()->find($trans_bus ,array("limit",1)); 
		  $trans_bus =  $trans_bus[0];
		  $page = "<head>
<title>Documento sin t�tulo</title>
<style type='text/css'>
#clearTable {
	width:80%;
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

.grid2 {
    border-collapse:collapse;
    border: thin solid #CCCCCC;
	border-spacing: 1px;
	background-color: #E7E7E7;
	font-family: Arial, Helvetica, sans-serif;
	font-size: 12px;
	color: #0A439A;
}

.grid2 td {
    font-family:Verdana, Arial, Helvetica, sans-serif;
    font-size:11px;
    color:#000;
    height:20px;
	border: 1px solid white;
	
}


.trInicial {
		text-align: center;
		background: #F0F0F0;
		color: #0B55C4;
		border-bottom: 1px solid white;
		border-left: 1px solid white;
		font-weight: bold;
		height:20px;
		font-size:12px;
		 border-bottom-width: 1px;
		border-bottom-style: solid;
		border-bottom-color: #666666;
		
}

.grid2 thead th:hover {
	cursor:pointer;
	background-color: #ffd;

}

.tdCuerpo {
    font-family: Verdana, Arial, Helvetica, sans-serif;
    font-size: 11px;
    font-weight: bold;
    color: #000000;
    background-color: #EABB00;
    text-align: left;
    border-top-style: none;
    border-right-style: none;
    border-bottom-style: none;
    border-left-style: none;
    height: 30px;
	
}

.row0 {
    background-color:#FFF;
	 font-family: Verdana, Arial, Helvetica, sans-serif;
    font-size: 11px;
    color: #000000;
    text-align: left;
    border-top-style: none;
    border-right-style: none;
    border-bottom-style: none;
    border-left-style: none;
    height: 30px;
	
}


.row1 {
    background-color:#F8F8F8;
	 font-family: Verdana, Arial, Helvetica, sans-serif;
    font-size: 11px;
    color: #000000;
    text-align: left;
    border-top-style: none;
    border-right-style: none;
    border-bottom-style: none;
    border-left-style: none;
    height: 30px;
	
}

.row0:hover td,
.row1:hover td  {
    background-color: #ffd;
    cursor:pointer;
	
}

.grid2 tr.selected{
	background-color:#09F;
	cursor:pointer;
}



</style></head><div align='center'>
<br />
<table   id='clearTable'  style=''  > 
     <tr>
       <td align='left' style='width:200px;' rowspan='2' height='33' id='titletd3'><img src='".Doo::conf()->APP_URL."global/img/admin/logo.png' style='width:200px;'  height='60' /></td>
       <td style='width:500px; font-size:11px; ' valign='top' align='right' >
	   	<b>".trim(date('M-d-Y g:i a'))."</b>
		</tr>
		<tr>
		<td height='35'  id='titletd4' valign='top'>
		<strong>PASSENGER LIST, Trip :".$trip.'  '. $txtdir.' '.date('M-d-Y', strtotime($fecha))."</strong>
		<br />Bus: ".$trans_bus->plate.', '.$trans_bus->tipobus."
	   </td>
    </tr>";
	 $page .='</table><table style="">';
	$page .= '  
                            <tr class="trInicial">
                                <th style="width:10px;" >No.</th>
								<th style="width:130px;">PICK</th>
								<th style="width:100px;">PAX NAME</th>
								<th style="width:50px;">PHONE</th>
								<th style="width:10px;" >TOTAL PAX</th>
								<th style="width:80px;">AGENCY</th>
								<th  style="width:130px;">DROP</th>
								<th  style="width:50px;">TOUR</th>
								<th  style="width:60px;">COLLECT</th>
								<th  style="width:60px;">PAYMENT</th>
                             </tr>
                        ';
		 $cont = 0;
		 $total = 0;	 
		 $totalPax = 0;	 
		foreach($reservas  as $resv){
		 $dato_pago = $resv['tipo_pago'];
		 if($bus==$resv['bus']){                    
			 if(strtoupper($dato_pago) == strtoupper('COLLECT ON BOARD')){
				 $colectar = $resv['total2'];
			 }else{
				 $colectar = '0.00';
			 }
			 if($resv['type_tour']=='MULTI' || $resv['type_tour']=='ONE'){
				  $tour = $resv['type_tour'];
			 }else{
				  $tour = $txtdir;
				
			 }
			 $totalPax += $resv['pax']+$resv['pax2'];
			 $total +=  $colectar;
			 $var = explode('-',$resv['pago']);

                             if($var[0] == "1" || $var[0] == "2" || $var[0] == "6"){
                                 $tipo_pago = "PRE-PAID";
                             }else if($var[0] == "3"){
                                 $tipo_pago = "CREDIT CARD 4% FEE";
                             }else if($var[0] == "4"){
                                 $tipo_pago = "CASH";
                             }else if($var[0] == "5"){
                                 $tipo_pago = "VOUCHER";
                             }else if($var[0] == "7"){
                                 $tipo_pago = "COMPLEMENTARY";
                             }else{
                                 $tipo_pago = strtoupper($var[0]);
                             }
                         
			 $page .= '<tr class="row'.($cont%2).'" >';
			 $page .= '<td style="width:10px;" >'.$resv['id'].'</td>';
     		 $page .= '<td style="width:130px; font-size:10px;" >'.trim($resv['pickup']).'</td>';
			 $page .= '<td style="width:100px; font-size:10px;">'.trim($resv['firsname']." ".$resv['lasname']).'</td>';
			 $page .= '<td style="width:50px; font-size:10px;">'.trim($resv['phone']).'</td>';
			 $page .= '<td style="width:5px; font-size:10px;" align="center" >'.($resv['pax']+$resv['pax2']).'</td>';
			 $page .= '<td style="width:80px; font-size:10px;"  >'.trim($resv['company_name']).'</td>';
			 $page .= '<td style="width:130px ; font-size:10px;" >'.trim($resv['dropoff']).'</td>';
			 $page .= '<td style="width:50px;  font-size:10px;" >'.trim($tour).'</td>';
			 $page .= '<td style="width:60px; font-size:10px;" >&nbsp;$ '.number_format(trim($colectar),2) .'</td>';
			 $page .= '<td style="width:60px; font-size:10px;" >'.trim($tipo_pago) .'</td>';
			 $page .= '</tr>';
			 $cont++;
		 }
	 }
	 

	 $page .= "</td></tr>";
	 
	 $page .= '<tr class="trInicial">
		  <th  >&nbsp;</th>
		  <th>**SUBTOTAL**</th>
		  <th>&nbsp;</th>
                  <th>&nbsp;</th>
		  <th >'.$totalPax.'</th>
		  <th>&nbsp;</th>
		  <th>&nbsp;</th>
                  
		  <th  >&nbsp;</th>
		  <th >'.number_format($total,2,'.','.').'</th>
		  <th  >&nbsp;</th>
            </tr>';
	 
	 $page .= "</table>
	 
	 
	 
	 </div>
	 </html>";
		  
    	  
		  
		  
		  Doo::loadHelper("DooPDF"); 
//		 
//		  echo $page;
          $pdf = new DooPDF('Ejemplo',$page, false, 'letter', 'landscape');
          $pdf->doPDF();
		}
	}
}

?>

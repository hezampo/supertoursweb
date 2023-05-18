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
		
		 $rs4 =  Doo::db()->query(" SELECT DISTINCTROW id_bus AS id
										FROM bus_trips
											  "
                                );
			 	$buss2 = $rs4->fetchall();
			
		 $sacables = array(); 
	
			  
			 $rs3 =  Doo::db()->query(" SELECT    plate,id
	                                                  FROM bus
											  "
                                );
			 $buss = $rs3->fetchall();					
		$contar = 	sizeof($buss2) - 2;
			
			
			
			$contador=0;
			
			
				while ($contador <= 0) {
				
				foreach($buss as $id => $value){
				
				
				//echo $value['id']." Buss2 ".$buss2[$contador]['id']."<br>" ;
				         if($value['id'] != $buss2[$contador]['id']){
						 
						  $rs =  Doo::db()->query(" SELECT DISTINCTROW id_bus 
															 FROM bus_trips 
													 WHERE id_bus = ?
											  ",array($value['id'])
                                );
						$validar = $rs->fetchall();	
								
						if(empty($validar) )		
								$rs =  Doo::db()->query(" SELECT id,plate,tipobus,capacidad
																	FROM bus
																	 
																		WHERE id = ?
											  ", array($value['id'])
                                );
						$bus = $rs->fetchAll();
							
						
						
						foreach ( $bus as $value ) {
				                         
				            $sacables[] = $value;
							 
					     }
						
						 
						 }
				
				        
						
						
					}
					$contador++;
					
					}
					





        $this->data['buss']        = $sacables;
		$this->data['bus_trips']   =  $bus_trips;
        $this->data['rootUrl']     = Doo::conf()->APP_URL;
        $this->data['trip']        = $trip;
        $this->data['equipos']     = Doo::db()->find("Codigos", array("where" => "tipo = 'equipment'", "asArray" => true));
        //$this->data['frecuencia']  = Doo::db()->find("Codigos", array("where" => "tipo = 'frecuency'","asArray" => true));
		
		$this->data['bus']     = Doo::db()->find("Bus", array("asArray" => true));
        $this->data['content'] = 'configuracion/frm_trip.php';
        $this->renderc('admin/index', $this->data);
    }
    
    public function save(){ 
      
        Doo::loadModel("Trips");
        
        $trip = new Trips($_POST);
        
		
		if(isset($_POST['id_bus'])){
		$bus_trips = $_POST['id_bus'];
		
		}
		
		if(isset($_POST['sacar'])){
		$bus_trips2 = $_POST['sacar'];
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
		
	
		 $rs4 =  Doo::db()->query(" SELECT DISTINCTROW id_bus AS id
										FROM bus_trips
											  "
                                );
			 	$buss2 = $rs4->fetchall();
				
			//	print_r($buss2);
			
		 $sacables = array(); 
		/*foreach ( $buss2 as $id => $value ) {
				
				$sacables[$id]=$value;
					}*/
			   
			  
			 $rs3 =  Doo::db()->query(" SELECT    plate,id
	                                                  FROM bus
											  "
                                );
			 $buss = $rs3->fetchall();					
		$contar = 	sizeof($buss2) - 2;
			
			
			
			$contador=0;
			
			
				while ($contador <= 0) {
				
				foreach($buss as $id => $value){
				
				
				//echo $value['id']." Buss2 ".$buss2[$contador]['id']."<br>" ;
				         if($value['id'] != $buss2[$contador]['id']){
						 
						  $rs =  Doo::db()->query(" SELECT DISTINCTROW id_bus 
															 FROM bus_trips 
													 WHERE id_bus = ?
											  ",array($value['id'])
                                );
						$validar = $rs->fetchall();	
								
						if(empty($validar) )		
								$rs =  Doo::db()->query(" SELECT id,plate,tipobus,capacidad
																	FROM bus
																	 
																		WHERE id = ?
											  ", array($value['id'])
                                );
						$bus = $rs->fetchAll();
							
						
						
						foreach ( $bus as $value ) {
				                         
				            $sacables[] = $value;
							 
					     }
						
						 
						 }
				
				        
						
						
					}
					$contador++;
					
					}
					
		   
		  
			
       
		
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['trip']        = Doo::db()->find($trip, array('limit' => 1));
		
		$this->data['bus_trips']  = $bus_trips;
		
		$this->data['buss']  = $sacables;
        $this->data['equipos']     = Doo::db()->find("Codigos", array("where" => "tipo = 'equipment'", "asArray" => true));
		$this->data['bus']     = Doo::db()->find("Bus", array("asArray" => true));
       // $this->data['frecuencia']  = Doo::db()->find("Codigos", array("select tipo from Codigos" ,"asArray" => true));
        $this->data['content'] = 'configuracion/frm_trip.php';
        $this->view()->renderc('admin/index', $this->data);
    }

    public function delete() {
        Doo::loadModel("Trips");
        $trip = new Trips();
        $trip->id = $_REQUEST['item'];
        Doo::db()->delete($trip);
        return Doo::conf()->APP_URL . "admin/trips";
    }
	
	
	/*public function valid()
	{
		 $id_bus  = $this->params["id_bus"];
		 $id_trips  = $this->params["id_trips"];
		
		
		echo $id_bus.$id_trips;
	}
     */
     
}

?>

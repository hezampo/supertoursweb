<?php
/**
 * Description of TripsController
 *
 * 
 */

Doo::loadController('I18nController');
class RoutesController extends I18nController {
   
    public function beforeRun($resource, $action) {
       if (!isset($_SESSION['login'])) {
            return Doo::conf()->APP_URL;
        }
    }
    
    public function index(){
        
         // Cargamos el paginador
    Doo::loadHelper('DooPager'); 
	if (!isset($this->params['type_rate'])) {
          $type_rate = "0";
       } else {
          $type_rate = $this->params['type_rate'];
       }
    if (!isset($_POST["id_agencya"])) {
            if (!isset($this->params['id_agency'])) {
                $id_agency = "-1";
            } else {
                $id_agency = $this->params['id_agency'];
            }
        }else{
            $id_agency = $_POST["id_agencya"];
        }
       
        if (!isset($_POST["acompany"])) {
            if (!isset($this->params['acompany'])) {
                $acompany = "";
            } else {
                $acompany = $this->params['acompany'];
            }
        }else{
            $acompany = $_POST["acompany"];
        }
        
        
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
        if($type_rate == 2){
        $from = "from routes_net t1 
                      left join areas t2 ON (t1.trip_from = t2.id)
                      LEFT JOIN areas t3 ON (t1.trip_to = t3.id)
                      left join agencia t4 ON (t1.id_agency = t4.id)";
           
        }else{
        $from = "from routes t1 
                      left join areas t2 ON (t1.trip_from = t2.id)
                      LEFT JOIN areas t3 ON (t1.trip_to = t3.id)";
        }
        if($type_rate==2 && $id_agency == "-1"){
          $where = "t1.type_rate=".$type_rate." and ".$filtro." like ?  ";
          $param = array($texto.'%');
          $rs = Doo::db()->query("select COUNT(*) ".$from." where ".$where,$param );
        }else{
          $where = "t1.type_rate=".$type_rate." and id_agency = ? and ".$filtro." like ?  ";
          $param =  array($id_agency,$texto.'%'); 
          $rs = Doo::db()->query("select COUNT(*) ".$from." where ".$where,$param);
        }
        
       
        $total = $rs->fetchColumn();

         if ($total == 0)
           $total = 1;
        // iniciamos el paginador

        $pager = new DooPager(Doo::conf()->APP_URL."admin/routes/$filtro/$texto/$type_rate/$id_agency/$acompany/page", $total, 10, 5);

        if(isset($this->params['pindex']))
            $pager->paginate(intval($this->params['pindex']));
        else
            $pager->paginate(1);
        
            $sql = "select t1.id,
                       t1.trip_no,
                       t2.nombre AS trip_from,
                       t3.nombre AS trip_to,
                       t1.price,
                       t1.price2, t1.price3,t1.price4, 
                       t1.trip_departure,
                       ".(($type_rate == 2)?"t4.company_name,":"")."
                       t1.trip_arrival,t1.anno, t1.type_rate ".$from." where  ".$where."  Order By anno desc limit ".$pager->limit ;
        
           $rs = Doo::db()->query($sql,$param);
      
        
        $trips = $rs->fetchAll();
  
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['content'] = 'configuracion/routes.php';
        $this->data['type_rate']  = $type_rate;
        $this->data['texto'] = $texto;
        $this->data['id_agency'] = $id_agency;
        $this->data['acompany'] = $acompany;
       
        $this->data['filtro']  = $filtro;
        $this->data['trips']   = $trips;
        $this->data['pager']   = $pager->output;
        $this->renderc('admin/index', $this->data,true);
    }
    
    public function add(){
        
        Doo::loadModel("Routes");
        $trip = new Routes();
        $this->data['rootUrl']     = Doo::conf()->APP_URL;
        $this->data['trip']        = $trip;
        $this->data['areas']       = Doo::db()->find("Areas", array("asArray" => true));
        $this->data['tripsnumber'] = Doo::db()->find("Trips", array("asArray" => true));
        $this->data['content'] = 'configuracion/frm_route.php';
        $this->data['dato'] = "New";
        $this->renderc('admin/index', $this->data);

        
    }
	
	 public function add_Net_especial(){
        Doo::loadModel("Routes_Net");
        $trip = new Routes_Net();
        $this->data['rootUrl']     = Doo::conf()->APP_URL;
        $this->data['trip']        = $trip;
        $this->data['areas']       = Doo::db()->find("Areas", array("asArray" => true));
        $this->data['tripsnumber'] = Doo::db()->find("Trips", array("asArray" => true));
		
        $this->data['content'] = "configuracion/frm_rates2.php";

        Doo::loadModel("Routes");
        $routes = new Routes_Net();

        $this->data["routes"] = $routes;
        $this->renderc('admin/index', $this->data);
    }
    
    public function save(){
      
         Doo::loadModel("Routes");
         Doo::loadModel("Routes_Net");
         if($_POST['type_rate']==2)
         {
           $trip = new Routes_Net($_POST);
         }else{
           $trip = new Routes($_POST);
         }
        $new = false;
      
        if ($_POST['id'] == "") {
            $trip->id = Null;
            $new = true;
        }

        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        
        if ($new)
            Doo::db()->insert($trip);
        else
         Doo::db()->update($trip);
         return Doo::conf()->APP_URL . "admin/routes/".$_POST['type_rate'];                
    }
    
    public function edit() {

        Doo::loadModel("Routes");
		Doo::loadModel("Agency");
        Doo::loadModel("Routes_Net");
        $k = explode(":",$this->params["pindex"]); 
        
        if($k[1]=="2"){
           $trip = new Routes_Net();
		   $agency = new Agency();
        }else{
           $trip = new Routes();
        } 
        $trip->id = $k[0];
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['trip']    = Doo::db()->find($trip, array('limit' => 1));
        $this->data['areas']   = Doo::db()->find("Areas", array("asArray" => true));
        $this->data['tripsnumber'] = Doo::db()->find("Trips", array("asArray" => true));	
		$agency = new Agency();
		$agency->id =  $this->data['trip']->id_agency;
		$this->data['agency'] = Doo::db()->find($agency, array('limit' => 1));
		if($this->data['trip']->type_rate == 2){
        	$this->data['content'] = 'configuracion/frm_route_especial.php';
		}else{
			$this->data['content'] = 'configuracion/frm_route.php';
		}
        $this->data['dato'] = "edit";
        $this->view()->renderc('admin/index', $this->data);
    }

    public function delete() {
        Doo::loadModel("Routes");
        Doo::loadModel("Routes_Net");
        $k = explode(":",$_REQUEST['item']); 
        if($k[1]=="2"){
           $trip = new Routes_Net();
        }else{
           $trip = new Routes();
        } 
        $trip->id = $k[0];
        Doo::db()->delete($trip);
        return Doo::conf()->APP_URL . "admin/routes/".$k[1];
    }
	
	public function trip_from(){
		$trip = $this->params['trip'];
		 $sql = "SELECT DISTINCT a.id, a.nombre
		 			FROM   `areas`  a LEFT JOIN `routes` r ON (a.id = r.trip_from)
		 			WHERE  trip_no = ? Order By a.`nombre` ASC ";
        $rs = Doo::db()->query($sql, array($trip));        
        $area = $rs->fetchAll();
		echo "<option value='0'>Select Option</option>";
		echo "<option value='*'>\"ALL POINTS OF DEPARTURE\"</option>";
		foreach($area as $e){
			echo "<option value='".$e["id"]."'>".$e["nombre"]."</option>";
		}
	}
	
	public function trip_to(){
		$trip = $this->params['trip'];
		$from = $this->params['from'];
		echo $sql = "SELECT DISTINCT a.id, a.nombre
		 			FROM   `areas`  a LEFT JOIN `routes` r ON (a.id = r.trip_to)
		 			WHERE  r.trip_no = ?  AND r.trip_from = ? Order By a.`nombre` ASC ";
        $rs = Doo::db()->query($sql, array($trip,$from));        
        $area = $rs->fetchAll();
		echo "<option value='0'>Select Option</option>";
		if (count($area)>0){
			echo "<option value='*'>\"ALL POINTS OF ARRIVAL\"</option>";
		}
		foreach($area as $e){
			echo "<option value='".$e["id"]."'>".$e["nombre"]." </option>";
		}
	}

     
}

?>

<?php

/**
 * Description of RatesController
 *
 * @author Ivan gallo
 *  
 */

Doo::loadController('I18nController');

class RatesController extends I18nController {

    public $data;

    public function beforeRun($resource, $action) {
        if (!isset($_SESSION['login'])) {
            return Doo::conf()->APP_URL;
        }
    }

    public function index() {	
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
		
        $this->data['content'] = "configuracion/frm_rates.php";

        Doo::loadModel("Routes");
        $routes = new Routes();
        $this->data["routes"] = $routes;
        $this->renderc('admin/index', $this->data);
    }
	
	public function save_multi_from_to($route){
		Doo::loadModel("Routes");
        Doo::loadModel("Routes_Net");
		if($route->trip_from == "*"){
			$sql = "SELECT  `trip_from`,`trip_to` , trip_departure, trip_arrival,  `price` ,  `price2` ,  `price3` ,  `price4`
				FROM  `routes`
				WHERE  `type_rate` = 1
					AND  `trip_no` = ?
					AND  `anno` = ?	";
			$rs = Doo::db()->query($sql, array($route->trip_no,$route->anno));
		}else{
			$sql = "SELECT  `trip_from`,`trip_to` , trip_departure, trip_arrival,  `price` ,  `price2` ,  `price3` ,  `price4`
				FROM  `routes`
				WHERE  `type_rate` = 1
					AND  `trip_from` = ?
					AND  `trip_no` = ?
					AND  `anno` = ?	";
			$rs = Doo::db()->query($sql, array($route->trip_from, $route->trip_no,$route->anno));
		}
		$rutas = $rs->fetchAll();
		foreach($rutas as $aux){
			$route->trip_from = $aux['trip_from'];
			$route->trip_to = $aux['trip_to'];
			$route->trip_departure =  $aux['trip_departure'];
			$route->trip_arrival =  $aux['trip_arrival']; 
			Doo::db()->insert($route);	
		}
	}
    public function save() {

        Doo::loadModel("Routes");
        Doo::loadModel("Routes_Net");
		if($_POST['id_agency'] != -1){//routes_net
			$routes = new Routes_Net(); 
			$routes->type_rate = 2; 
			$routes->id_agency = $_POST['id_agency']; 
			$routes->trip_no = $_POST['trip_no']; 
			$routes->trip_from = $_POST['trip_from'];
			$routes->trip_to = $_POST['trip_to'];
			$routes->price =  $_POST['price'];
			$routes->price2 =  $_POST['price2'];
			$routes->price3 =  $_POST['price3'];
			$routes->price4 =  $_POST['price4'];
			$routes->trip_departure =  $_POST['trip_departure'];
			$routes->trip_arrival =  $_POST['trip_arrival'];
			$routes->anno = $_POST['anno']; 
			if($_POST['trip_from'] == '*' || $_POST['trip_to'] == '*'){
				$this->save_multi_from_to($routes);
			}else{
				$sql = "SELECT * FROM  `routes_net` WHERE trip_no = ? AND anno = ? AND type_rate = ? AND id_agency = ?";
				$rs = Doo::db()->query($sql, array($routes->trip_no,$routes->anno,$routes->type_rate, $routes->id_agency));
				$trips = $rs->fetchAll();
				$num = count($trips);
				if($num==0){
					Doo::db()->insert($routes);	
				}else{
					 $sql = "UPDATE routes_net SET 
								 price = ".$routes->price." , 
								 price2 = ".$routes->price2." ,  
								 price3 = ".$routes->price3." ,  
								 price4 = ".$routes->price4."  
							WHERE trip_no = ? 
							AND anno = ? 
							AND type_rate = ?
							AND id_agency = ? ";
					 $rs = Doo::db()->query($sql,array($routes->trip_no,$routes->anno,$routes->type_rate, $routes->id_agency));
				}
			}
		}else{//routes
			$routes = new Routes(); 
			$routes->type_rate = $_POST['type_rate']; 
			$routes->anno = $_POST['anno']; 
			$routes->trip_no = $_POST['trip_no']; 
			$routes->id_agency = $_POST['id_agency']; 
			$routes->price =  $_POST['price'];
			$routes->price2 =  $_POST['price2'];
			$routes->price3 =  $_POST['price3'];
			$routes->price4 =  $_POST['price4'];
			$sql = "SELECT * FROM  `routes` WHERE trip_no = ? AND anno = ? AND type_rate = ? ";
			$rs = Doo::db()->query($sql,array($routes->trip_no,$routes->anno,$routes->type_rate));
			$trips = $rs->fetchAll();
			$num = count($trips);
			if($num==0){
				Doo::db()->insert($routes);
			}else{
				 $sql = "UPDATE routes SET 
							 price = ".$routes->price." , 
							 price2 = ".$routes->price2." ,  
							 price3 = ".$routes->price3." ,  
							 price4 = ".$routes->price4."  
						WHERE trip_no = ? 
						AND anno = ? 
						AND type_rate = ? ";
				 $rs = Doo::db()->query($sql,array($routes->trip_no,$routes->anno,$routes->type_rate));
			}
		}
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        return Doo::conf()->APP_URL . "admin/routes/".$_POST['type_rate'];
    }

}

?>

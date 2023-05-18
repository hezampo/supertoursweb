<?php

/**
 * Description of TripsController
 *
 * 
 */

Doo::loadController('I18nController');
class Service_DriverController extends I18nController{
   
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
                $filtro = "id";
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
               
        $rs    = Doo::db()->find("Service_driver", array("select"=>"COUNT(*) AS total", 
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
        
        $rs = Doo::db()->query("SELECT   t1.fecha,t2.name_service, t3.firstname,t3.lastname,t1.id,t2.price
												FROM services_driver t1
												
												LEFT JOIN type_service t2 ON (t1.id_service_type = t2.id)
												LEFT JOIN driver t3 ON (t1.id_driver = t3.id) 
                                where t1.$filtro like ?  order by t1.id limit $pager->limit ", 
                                array($texto.'%'));
        
        $service_driver = $rs->fetchAll();

        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['content'] = 'configuracion/service_driver.php';
        $this->data['filtro']  = $filtro;
        $this->data['texto']   = $texto;
        $this->data['service_driver']   = $service_driver;
        $this->data['pager']   = $pager->output;
        $this->renderc('admin/index', $this->data,true);

    }
    
public function add(){
        
        Doo::loadModel("Service_driver");
        $service_driver = new Service_driver();

        $this->data['rootUrl']     = Doo::conf()->APP_URL;
        $this->data['service_driver']        = $service_driver;
	    $this->data['driver']  = Doo::db()->find("Driver",array("sselect id,name  " ,"asArray" => true)); 
		$this->data['type_service']  = Doo::db()->find("Type_service",array("select id,name_service " ,"asArray" => true)); 
        $this->data['content'] = 'configuracion/frm_service_driver.php';
		$this->data['dato'] = "New";
        $this->renderc('admin/index', $this->data);
    }
    
    public function save(){ 
      
        Doo::loadModel("Service_driver");
        
        $service_driver = new Service_driver($_POST);
        
		
		list($mes,$dia,$anyo) = explode("-",$service_driver->fecha);
		
		
		$fecha = $anyo."-".$mes."-".$dia;
		$service_driver->fecha = strtotime($fecha);
		
		
        $new = false;
      
        if ($_POST['id'] == "") {
            $service_driver->id = Null;
            $new = true;
        }

        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        
        if ($new)
                Doo::db()->insert($service_driver);
	    
        else
			
           Doo::db()->update($service_driver);
     
         return Doo::conf()->APP_URL . "admin/driver/service-driver";
                
    }
    
    public function edit() {
         Doo::loadModel("Service_driver");
        $service_driver = new Service_driver();
        $service_driver->id = $this->params["pindex"];
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['service_driver']        = Doo::db()->find($service_driver, array('limit' => 1));
		$this->data['driver']  = Doo::db()->find("Driver",array("select id,name  " ,"asArray" => true)); 
		$this->data['type_service']  = Doo::db()->find("Type_service",array("select id,name_service " ,"asArray" => true));  
        $this->data['content'] = 'configuracion/frm_service_driver.php';
		$this->data['dato'] = "edit";
        $this->view()->renderc('admin/index', $this->data);
    }

    public function delete() {
        Doo::loadModel("Service_driver");
        $service_driver = new Service_driver();
        $service_driver->id = $_REQUEST['item'];
        Doo::db()->delete($service_driver);
        return Doo::conf()->APP_URL . "admin/driver/service-driver";
    }
	
	
	
     
}



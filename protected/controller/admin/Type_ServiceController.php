<?php

/**
 * Description of TripsController
 *
 * 
 */

Doo::loadController('I18nController');
class Type_ServiceController extends I18nController{
   
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
               
        $rs    = Doo::db()->find("Type_service", array("select"=>"COUNT(*) AS total", 
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
        
        $rs = Doo::db()->query("SELECT name_service, price,id 
												FROM type_service
                                
                                where $filtro like ?  order by id limit $pager->limit ", 
                                array($texto.'%'));
        
        $type_service = $rs->fetchAll();

        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['content'] = 'configuracion/type_Service.php';
        $this->data['filtro']  = $filtro;
        $this->data['texto']   = $texto;
        $this->data['type_service']   = $type_service;
        $this->data['pager']   = $pager->output;
        $this->renderc('admin/index', $this->data,true);

    }
    
public function add(){
        
        Doo::loadModel("Type_service");
        $type_service = new Type_service();

        $this->data['rootUrl']     = Doo::conf()->APP_URL;
        $this->data['type_service']        = $type_service;
	    $this->data['driver']  = Doo::db()->find("Driver",array("select id,name  " ,"asArray" => true)); 
        $this->data['content'] = 'configuracion/frm_typeserv.php';
		$this->data['dato'] = "New";
        $this->renderc('admin/index', $this->data);
    }
    
    public function save(){ 
      
        Doo::loadModel("Type_service");
        
        $type_service = new Type_service($_POST);
        
		
		
        $new = false;
      
        if ($_POST['id'] == "") {
            $type_service->id = Null;
            $new = true;
        }

        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        
        if ($new)
                Doo::db()->insert($type_service);
	    
        else
			
           Doo::db()->update($type_service);
     
         return Doo::conf()->APP_URL . "admin/driver/type-service";
                
    }
    
    public function edit() {
         Doo::loadModel("Type_service");
        $type_service = new Type_service();
        $type_service->id = $this->params["pindex"];
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['type_service']        = Doo::db()->find($type_service, array('limit' => 1));
		$this->data['driver']  = Doo::db()->find("Driver",array("select id,name  " ,"asArray" => true));  
        $this->data['content'] = 'configuracion/frm_typeserv.php';
		$this->data['dato'] = "edit";
        $this->view()->renderc('admin/index', $this->data);
    }

    public function delete() {
        Doo::loadModel("Type_service");
        $type_service = new Type_service();
        $type_service->id = $_REQUEST['item'];
        Doo::db()->delete($type_service);
        return Doo::conf()->APP_URL . "admin/driver/type-service";
    }
	
	
	
     
}

?>

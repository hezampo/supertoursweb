<?php

/**
 * Description of TripsController
 *
 * @author Ivan Gallo P.
 */

Doo::loadController('I18nController');
class UseraController extends I18nController{
   
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
               
        $rs    = Doo::db()->find("UserA", array("select"=>"COUNT(*) AS total", 
                                                     "where" => "$filtro like ? and activo = 1",
                                                     "limit"=>1,
                                                     "param" => array($texto . '%')
                                                    ));
         $total = $rs->total;

         if ($total == 0)
           $total = 1;
        // iniciamos el paginador

        $pager = new DooPager(Doo::conf()->APP_URL."admin/agency/users/$filtro/$texto/page", $total, 10, 5);

        if(isset($this->params['pindex']))
            $pager->paginate(intval($this->params['pindex']));
        else
            $pager->paginate(1);
        
        $rs = Doo::db()->query("SELECT t1.id,t1.firstname,t1.lastname,t1.email,t1.birthdate,t1.admon,t2.company_name,t2.phone1
										FROM user_agencia t1
								
									LEFT JOIN agencia t2 ON (t1.id_agencia = t2.id)

                                where t1.$filtro like ? and activo = 1 order by t1.id limit $pager->limit ",
                                array('%'.$texto.'%'));
        
        $user_agency = $rs->fetchAll();

        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['content'] = 'configuracion/user_agency.php';
        $this->data['filtro']  = $filtro;
        $this->data['texto']   = $texto;
        $this->data['user_agency']   = $user_agency;
        $this->data['pager']   = $pager->output;
        $this->renderc('admin/index', $this->data,true);

    }
    
  public function add(){
        
        Doo::loadModel("UserA");
        $user_agency = new UserA();

        $this->data['rootUrl']     = Doo::conf()->APP_URL;
		$this->data['agencia']  = Doo::db()->find("Agency",array("select id,company_name from agencia" ,"asArray" => true));
        $this->data['user_agency']        = $user_agency;
	     
        $this->data['content'] = 'configuracion/frm_usera.php';
		$this->data['dato'] = "New";
        $this->renderc('admin/index', $this->data);
    }
   
    public function save(){
      
        Doo::loadModel("UserA");
       
        $usera = new UserA($_POST);
	if(isset($_POST['admon'])){
            $usera->admon = 1; 
        }else{
            $usera->admon = 0;
        }
	
        $new = false;
        
		
        if ($_POST['id'] == "") {
            $usera->id = Null;
            $new = true;
        }
        $usera->activo = 1;
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        
        if ($new){

            Doo::db()->insert($usera);
	}else{
           Doo::db()->update($usera);
	}
         return Doo::conf()->APP_URL . "admin/agency/users";
                
    }
    
    public function edit() {
        Doo::loadModel("UserA");
        $usera = new UserA();
        $usera->id = $this->params["pindex"];
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['user_agency']        = Doo::db()->find($usera, array('limit' => 1));
		$this->data['agencia']  = Doo::db()->find("Agency",array("select id,company_name from agencia" ,"asArray" => true));
        $this->data['content'] = 'configuracion/frm_usera.php';
		$this->data['dato'] = "edit";
        $this->view()->renderc('admin/index', $this->data);
    }
	
	

    public function delete() {
        Doo::loadModel("UserA");
        $usera = new UserA();
        $usera->id = $_REQUEST['item'];
        Doo::db()->delete($usera);
        return Doo::conf()->APP_URL . "admin/agency/";
    }

    
}



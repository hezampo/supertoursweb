<?php

/**
 * Description of TripsController
 *
 * 
 */

Doo::loadController('I18nController');
class ToursplaneController extends I18nController{
   
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
        
          if (!isset($_POST["id_agency"])) {
            if (!isset($this->params['id_agency'])) {
                $id_agency = "-1";
            } else {
                $id_agency = $this->params['id_agency'];
            }
        }else{
            $id_agency = $_POST["id_agency"];
        }
       
        
         if (!isset($_POST["company_name"])) {
            if (!isset($this->params['company_name'])) {
                $acompany = "";
            } else {
                $acompany = $this->params['company_name'];
            }
        }else{
            $acompany = $_POST["company_name"];
        }
        
       
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
             
        
                
         if($type_rate==2 && $id_agency == "-1"){
          $where = "type_rate=".$type_rate." and ".$filtro." like ?  ";
          $param = array($texto.'%');
         // $rs = Doo::db()->query("select COUNT(*) AS total From tarifastrip where ".$where,$param);
        }else{
          $where = "type_rate=".$type_rate." and id_agency = ? and ".$filtro." like ?  ";
          $param =  array($id_agency,$texto.'%'); 
         // $rs = Doo::db()->query("select COUNT(*) AS total From tarifastrip where ".$where,$param);
        }
        
        
        $rs    = Doo::db()->find("Tarifasplane", array("select"=>"COUNT(*) AS total", 
                                                     "where" => $where, 
                                                     "limit"=>1,
                                                     "param" =>$param
                                                    ));
         $total = $rs->total;

         if ($total == 0)
           $total = 1;
        // iniciamos el paginador

        $pager = new DooPager(Doo::conf()->APP_URL."admin/tours/tarifa-plane/$filtro/$texto/$type_rate/$id_agency/page", $total, 10, 5);

        if(isset($this->params['pindex']))
            $pager->paginate(intval($this->params['pindex']));
        else
            $pager->paginate(1);
        
        $rs = Doo::db()->query("SELECT id,cantidad,price,type_rate,annio
			        ".(($type_rate == 2)?",company_name":"")." 
                                FROM  tarifaplane where ".$where." order by annio DESC,id ASC limit $pager->limit ",
                                $param);
        
        $tarifaplane = $rs->fetchAll();

        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['content'] = 'configuracion/tarifaplane.php';
        $this->data['filtro'] = $filtro;
        $this->data['texto'] = $texto;
        $this->data['type_rate']   = $type_rate; 
        $this->data['id_agency'] = $id_agency;
        $this->data['company_name'] = $acompany;
        $this->data['tarifaplane'] = $tarifaplane;
        $this->data['pager'] = $pager->output;
        $this->renderc('admin/index', $this->data,true);

    }
    
    public function add(){
        
        Doo::loadModel("Tarifasplane");
        $tarifasplane = new Tarifasplane();
		 if(isset($this->params['type_rate']))
		     $type_rate = $this->params['type_rate'];
		$tarifasplane->id_agency = -1;
        $this->data['rootUrl']     = Doo::conf()->APP_URL;
		$this->data['tarifastrip']        = Doo::db()->find($tarifasplane, array('limit' => 1));
        $this->data['tarifasplane']        = $tarifasplane;
		$this->data['type_rate']   = $type_rate; 
        $this->data['content'] = 'configuracion/frm_plane.php';
		$this->data['dato'] = "New";
        $this->renderc('admin/index', $this->data);
    }
    
    public function save(){
        /*echo json_encode($_POST);
        exit;*/
        Doo::loadModel("Tarifasplane");
        $tarifasplane = new Tarifasplane();
        $new = false;
        $tarifasplane->cantidad = $_POST['cantidad'];
        $tarifasplane->type_rate = $_POST['type_rate'];
        $tarifasplane->id_agency = $_POST['id_agency'];
        $tarifasplane->annio = $_POST['annio'].'-01-01 00:00:00';
        $tarifasplane  = Doo::db()->find($tarifasplane,array("limit",1));  
        if(empty($tarifasplane)){
			$tarifasplane = new Tarifasplane($_POST);
            $date = new DateTime($_POST['annio'].'-1-1');
            $tarifasplane->annio = $date->format('Y-m-d H:i:s');
            $tarifasplane->id = Null;
            $new = true;
        }else{
			$tarifasplane = new Tarifasplane($tarifasplane[0]);
            $date = new DateTime($_POST['annio'].'-1-1');
            $tarifasplane->annio = $date->format('Y-m-d H:i:s');
			$tarifasplane->price = $_POST['price'];
		}
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        if ($new){
           if(Doo::db()->insert($tarifasplane)){
             $_SESSION['plane'] = "Rates Successfully Saved...!!" ;
           }else{
             $_SESSION['plane'] = "Failed to Save Rates...!!" ;  
           }
        }else{
	    if(Doo::db()->update($tarifasplane)){
               $_SESSION['plane'] = "Rates Successfully Update...!!" ;
            }else{
               $_SESSION['plane'] =  "Failed to Update Rates...!!";  
            }
             
        } 
         return Doo::conf()->APP_URL . "admin/tours/tarifa-plane/".$_POST['type_rate'];
                
    }
    
    public function edit() {
        Doo::loadModel("Tarifasplane");
        $tarifasplane = new Tarifasplane();
		$tarifasplane->id = $this->params["pindex"];
		
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
		$this->data['tarifasplane']        = Doo::db()->find($tarifasplane, array('limit' => 1));
        $this->data['content'] = 'configuracion/frm_plane.php';
		$this->data['dato'] = "edit"; 
		$this->data['type_rate'] = $this->data['tarifasplane']->type_rate;
        $this->view()->renderc('admin/index', $this->data);
    }

    public function delete() {
        Doo::loadModel("Tarifasplane");
        $tarifasplane = new Tarifasplane();
        $tarifasplane->id = $_REQUEST['item'];
        
         $dats = Doo::db()->find($tarifasplane, array("limit" => 1)); 
         if(empty($dats)){
            $_SESSION['plane'] = "Failed to Delete Rates...!!" ;
         }else{
             $type_rate = $dats->type_rate; 
              if(Doo::db()->delete($tarifasplane))
                $_SESSION['plane'] = "Rates Successfully Delete...!!" ;
              else {
                $_SESSION['plane'] = "Rates Successfully Delete...!!" ;
               }
           
         }
           return Doo::conf()->APP_URL . "admin/tours/tarifa-plane/".$type_rate;
    }
	
	
	
     
}

?>

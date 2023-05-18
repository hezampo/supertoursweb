<?php

/**
 * Description of TripsController
 *
 * 
 */

Doo::loadController('I18nController');

class Group_parksController extends I18nController{
   
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
               
        $rs    = Doo::db()->find("Grupo_parque", array("select"=>"COUNT(*) AS total", 
                                                     "where" => "$filtro like ?", 
                                                     "limit"=>1,
                                                     "param" => array($texto . '%')
                                                    ));
         $total = $rs->total;

         if ($total == 0)
           $total = 1;
        // iniciamos el paginador

        $pager = new DooPager(Doo::conf()->APP_URL."admin/tours/group-parks/$filtro/$texto/page", $total, 10, 5);

        if(isset($this->params['pindex']))
            $pager->paginate(intval($this->params['pindex']));
        else
            $pager->paginate(1);
        
        $rs = Doo::db()->query("SELECT  id,nombre,code_refe
													FROM grupo_parques

                       where $filtro like ?  order by id limit $pager->limit ", 
                                array($texto.'%'));
        
        $group_parks = $rs->fetchAll();

        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['content'] = 'configuracion/group_parks.php';
        $this->data['filtro']  = $filtro;
        $this->data['texto']   = $texto;
        $this->data['group_parks']   = $group_parks;
        $this->data['pager']   = $pager->output;
        $this->renderc('admin/index', $this->data,true);

    }
    
public function add(){
        
        Doo::loadModel("Grupo_parque");
        $grupo_parque = new Grupo_parque();

        $this->data['rootUrl']     = Doo::conf()->APP_URL;
		$this->data['grupo_parque']        = Doo::db()->find($grupo_parque, array('limit' => 1));
	    $this->data['grupo_parque']        = $grupo_parque;
        $this->data['content'] = 'configuracion/frm_group_parks.php';
		$this->data['dato'] = "New";
        $this->renderc('admin/index', $this->data);
    }
    
    public function save(){
      
        Doo::loadModel("Grupo_parque");
        
        $grupo_parque = new Grupo_parque($_POST);
		
       
		
        $new = false;
      
        if ($_POST['id'] == "") {
            $grupo_parque->id = Null;
            $new = true;
        }

       
        
        if ($new){
		  
			
            Doo::db()->insert($grupo_parque);
			
			}
        else{
           Doo::db()->update($grupo_parque);
            }

       
         return Doo::conf()->APP_URL . "admin/tours/group-parks";
                
    }
    
    public function edit() {
        Doo::loadModel("Grupo_parque");
        $grupo_parque = new Grupo_parque();
        $grupo_parque->id = $this->params["pindex"];
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['grupo_parque']        = Doo::db()->find($grupo_parque, array('limit' => 1));
	    $this->data['content'] = 'configuracion/frm_group_parks.php';
		$this->data['dato'] = "edit";
        $this->view()->renderc('admin/index', $this->data);
    }

    public function delete() {
        Doo::loadModel("Grupo_parque");
        $grupo_parque = new Grupo_parque();
        $grupo_parque->id = $_REQUEST['item'];
        Doo::db()->delete($grupo_parque);
        return Doo::conf()->APP_URL . "admin/tours/group-parks";
    }

     
}



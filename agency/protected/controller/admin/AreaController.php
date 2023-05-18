<?php

/**
 * Description of TripsController
 *
 * 
 */

Doo::loadController('I18nController');
class AreaController extends I18nController{
   
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
               
        $rs    = Doo::db()->find("Areas", array("select"=>"COUNT(*) AS total", 
                                                     "where" => "$filtro like ?", 
                                                     "limit"=>1,
                                                     "param" => array($texto . '%')
                                                    ));
         $total = $rs->total;

         if ($total == 0)
           $total = 1;
        // iniciamos el paginador

        $pager = new DooPager(Doo::conf()->APP_URL."admin/areas/$filtro/$texto/page", $total, 10, 5);

        if(isset($this->params['pindex']))
            $pager->paginate(intval($this->params['pindex']));
        else
            $pager->paginate(1);
        
        $rs = Doo::db()->query("SELECT      id,nombre 
		                                         FROM areas 
                                
                                where $filtro like ?  order by id limit $pager->limit ", 
                                array($texto.'%'));
        
        $areas = $rs->fetchAll();

        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['content'] = 'configuracion/areas.php';
        $this->data['filtro']  = $filtro;
        $this->data['texto']   = $texto;
        $this->data['areas']   = $areas;
        $this->data['pager']   = $pager->output;
        $this->renderc('admin/index', $this->data,true);

    }
    
public function add(){
        
        Doo::loadModel("Areas");
        $areas = new Areas();

        $this->data['rootUrl']      = Doo::conf()->APP_URL;
		$this->data['areas']        = Doo::db()->find($areas, array('limit' => 1));
        $this->data['areas']        = $areas;
        $this->data['content'] = 'configuracion/frm_areas.php';
		$this->data['dato'] = "New";
        $this->renderc('admin/index', $this->data);
    }
    
    public function save(){
      
        Doo::loadModel("Areas");
        
        $areas = new Areas($_POST);
		
       
		
        $new = false;
      
        if ($_POST['id'] == "") {
            $areas->id = Null;
            $new = true;
        }

       
        
        if ($new){
            Doo::db()->insert($areas);
			}
        else{
           Doo::db()->update($areas);
            }

       
         return Doo::conf()->APP_URL . "admin/areas";
                
    }
    
    public function edit() {
        Doo::loadModel("Areas");
        $areas = new Areas();
        $areas->id = $this->params["pindex"];
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['areas']        = Doo::db()->find($areas, array('limit' => 1));
        $this->data['content'] = 'configuracion/frm_areas.php';
		$this->data['dato'] = "edit";
        $this->view()->renderc('admin/index', $this->data);
    }

    public function delete() {
        Doo::loadModel("Areas");
        $areas = new Areas();
        $areas->id = $_REQUEST['item'];
        Doo::db()->delete($areas);
        return Doo::conf()->APP_URL . "admin/areas";
    }

     
}



<?php

/**
 * Description of TripsController
 *
 * 
 */

Doo::loadController('I18nController');

class Parks_vip_ratesController extends I18nController{
   
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
               
        $rs    = Doo::db()->find("Parks_vip_rate", array("select"=>"COUNT(*) AS total", 
                                                     "where" => "$filtro like ?", 
                                                     "limit"=>1,
                                                     "param" => array($texto . '%')
                                                    ));
         $total = $rs->total;

         if ($total == 0)
           $total = 1;
        // iniciamos el paginador

        $pager = new DooPager(Doo::conf()->APP_URL."admin/tours/parks-vip/$filtro/$texto/page", $total, 10, 5);

        if(isset($this->params['pindex']))
            $pager->paginate(intval($this->params['pindex']));
        else
            $pager->paginate(1);
        
        $rs = Doo::db()->query("SELECT  id,cantidad,valor
									FROM parque_tarifa_vip
                    where $filtro like ?  order by id limit $pager->limit ", 
                                array($texto.'%'));
        
        $parks_vip_rates = $rs->fetchAll();

        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['content'] = 'configuracion/parks_vip_rates.php';
        $this->data['filtro']  = $filtro;
        $this->data['texto']   = $texto;
        $this->data['parks_vip_rates']   = $parks_vip_rates;
        $this->data['pager']   = $pager->output;
        $this->renderc('admin/index', $this->data,true);

    }
    
public function add(){
        
        Doo::loadModel("Parks_vip_rate");
        $parks_vip_rate = new Parks_vip_rate();

        $this->data['rootUrl']     = Doo::conf()->APP_URL;
		$this->data['parks_vip_rate']        = Doo::db()->find($parks_vip_rate, array('limit' => 1));
		
        $this->data['parks_vip_rate']        = $parks_vip_rate;
        $this->data['content'] = 'configuracion/frm_parks_vip_rates.php';
		$this->data['dato'] = "New";
        $this->renderc('admin/index', $this->data);
    }
    
    public function save(){
      
        Doo::loadModel("Parks_vip_rate");
        
        $parks_vip_rate = new Parks_vip_rate($_POST);
		
       
		
        $new = false;
      
        if ($_POST['id'] == "") {
            $parks_vip_rate->id = Null;
            $new = true;
        }

       
        
        if ($new){
		  
			
            Doo::db()->insert($parks_vip_rate);
			
			}
        else{
           Doo::db()->update($parks_vip_rate);
            }

       
         return Doo::conf()->APP_URL . "admin/tours/parks-vip";
                
    }
    
    public function edit() {
        Doo::loadModel("Parks_vip_rate");
        $parks_vip_rate = new Parks_vip_rate();
        $parks_vip_rate->id = $this->params["pindex"];
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['parks_vip_rate']        = Doo::db()->find($parks_vip_rate, array('limit' => 1));
	    $this->data['content'] = 'configuracion/frm_parks_vip_rates.php';
		$this->data['dato'] = "edit";
        $this->view()->renderc('admin/index', $this->data);
    }

    public function delete() {
        Doo::loadModel("Parks_vip_rate");
        $parks_vip_rate = new Parks_vip_rate();
        $parks_vip_rate->id = $_REQUEST['item'];
        Doo::db()->delete($parks_vip_rate);
        return Doo::conf()->APP_URL . "admin/tours/parks-vip";
    }

     
}

?>

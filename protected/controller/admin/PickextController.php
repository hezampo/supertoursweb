<?php

/**
 * Description of TripsController
 *
 * 
 */

Doo::loadController('I18nController');
class PickextController extends I18nController{
   
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
                $filtro = "place";
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
               
        $rs    = Doo::db()->find("Extenpickupdro", array("select"=>"COUNT(*) AS total", 
                                                     "where" => "$filtro like ?", 
                                                     "limit"=>1,
                                                     "param" => array($texto . '%')
                                                    ));
         $total = $rs->total;

         if ($total == 0)
           $total = 1;
        // iniciamos el paginador

        $pager = new DooPager(Doo::conf()->APP_URL."admin/pickup-dropoff/ext/$filtro/$texto/page", $total, 10, 5);

        if(isset($this->params['pindex']))
            $pager->paginate(intval($this->params['pindex']));
        else
            $pager->paginate(1);
        
        $rs = Doo::db()->query("SELECT t1.id, t1.place, t1.address, t2.place as nombre
												FROM pickupdropoff_exten t1
												
												LEFT JOIN extension t2 ON (t1.id_extension = t2.id)
                                
                                where t1.$filtro like ?  order by t1.id limit $pager->limit ", 
                                array($texto.'%'));
        
        $pickdrop = $rs->fetchAll();

        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['content'] = 'configuracion/pickuext.php';
        $this->data['filtro']  = $filtro;
        $this->data['texto']   = $texto;
        $this->data['pickdrop']   = $pickdrop;
        $this->data['pager']   = $pager->output;
        $this->renderc('admin/index', $this->data,true);

    }
    
public function add(){
        Doo::loadModel("Extenpickupdro");
        $pickup = new Extenpickupdro();
		
        $this->data['rootUrl']     = Doo::conf()->APP_URL;
        $this->data['pickdrop']    = $pickup;
        $this->data['extension']   = Doo::db()->find("Extension", array("select" => "id,place,address", "asArray"=>true));
		$this->data['content'] = 'configuracion/frm_pick_ext.php';
		$this->data['dato'] = "New";
        $this->renderc('admin/index', $this->data);
    }
    
    public function save(){ 
      
       
        Doo::loadModel("Extenpickupdro");
       
        $pickdrop = new Extenpickupdro($_POST);
	
	   
        $new = false;
      
        if ($_POST['id'] == "") {
            $pickdrop->id = Null;
            $new = true;
        }

        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        
        if ($new){
		    
				
                Doo::db()->insert($pickdrop);
	            
	         
	     }
		 
        else{
			
           Doo::db()->update($pickdrop);
          
			 
		 } 
			 
			 
			

       
         return Doo::conf()->APP_URL . "admin/pickup-dropoff/ext";
                
    }
    
    public function edit(){
        Doo::loadModel("Extenpickupdro");
        $pickdrop = new Extenpickupdro();
        $pickdrop->id = $this->params["pindex"];
    
		
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['pickdrop']    = Doo::db()->find($pickdrop, array('limit' => 1));
		
		$this->data['extension']   = Doo::db()->find("Extension", array("select" => "id,place,address", "asArray"=>true));
      
        $this->data['content'] = 'configuracion/frm_pick_ext.php';
		$this->data['dato'] = "edit";
        $this->view()->renderc('admin/index', $this->data);
    }

    public function delete() {
        Doo::loadModel("PickupDropoff");
        $pickupDropoff = new PickupDropoff();
        $pickupDropoff->id = $_REQUEST['item'];
        Doo::db()->delete($pickupDropoff);
        return Doo::conf()->APP_URL . "admin/pickup-dropoff";
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

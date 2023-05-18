<?php

/**
 * Description of TripsController
 *
 * 
 */

Doo::loadController('I18nController');
class PickdropController extends I18nController{
   
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
        
        if($filtro == "type_web"){
            $texto = strtoupper($texto);
            if($texto == "YES"){
                $texto = "1";
            }
            if ($texto == "NO"){
                $texto = "0";
            }
        }
           
        $rs    = Doo::db()->find("PickupDropoff", array("select"=>"COUNT(*) AS total", 
                                                     "where" => "$filtro like ?", 
                                                     "limit"=>1,
                                                     "param" => array($texto . '%')
                                                    ));
         $total = $rs->total;

         if ($total == 0)
           $total = 1;
        // iniciamos el paginador

        $pager = new DooPager(Doo::conf()->APP_URL."admin/pickup-dropoff/$filtro/$texto/page", $total, 10, 5);

        if(isset($this->params['pindex']))
            $pager->paginate(intval($this->params['pindex']));
        else
            $pager->paginate(1);
        
        $rs = Doo::db()->query("SELECT t1.id, t1.place, t1.address, t1.type_web, t1.valid, t1.valid, t1.posicion, t2.nombre
												FROM pickup_dropoff t1
												
												LEFT JOIN areas t2 ON (t1.id_area = t2.id)
                                
                                where t1.$filtro like ?  order by t1.id limit $pager->limit ", 
                                array($texto.'%'));
        
        $pickdrop = $rs->fetchAll();
        
        if($filtro == "type_web"){
            if($texto == "1"){
                $texto = "YES";
            }
            if ($texto == "0"){
                $texto = "NO";
            }
        }
        
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['content'] = 'configuracion/pickdrop.php';
        $this->data['filtro']  = $filtro;
        $this->data['texto']   = $texto;
        $this->data['pickdrop']   = $pickdrop;
        $this->data['pager']   = $pager->output;
        $this->renderc('admin/index', $this->data,true);

    }
    
public function add(){
        
        Doo::loadModel("PickupDropoff");
		
        $pickdrop = new PickupDropoff();
		$rs =  Doo::db()->query("SELECT t1.id, t1.place, t1.address, t2.nombre
												  FROM pickup_dropoff t1
												
												LEFT JOIN areas t2 ON (t1.id_area = t2.id)
                                
                                WHERE t1.id = ?  ", array(""));
				
		$datas= $rs->fetch();
				

  
	
        $this->data['rootUrl']     = Doo::conf()->APP_URL;
        $this->data['pickdrop']        = $datas;
        $this->data['equipos']     = Doo::db()->find("Codigos", array("where" => "tipo = 'equipment'", "asArray" => true));
        //$this->data['frecuencia']  = Doo::db()->find("Codigos", array("where" => "tipo = 'frecuency'","asArray" => true));
		$this->data['areas']   = Doo::db()->find("Areas", array("select" => "id, nombre", "asArray"=>true));
		$this->data['extension']   = Doo::db()->find("Extension", array("select" => "id,place, address", "asArray"=>true));
		$this->data['bus']     = Doo::db()->find("Bus", array("asArray" => true));
        $this->data['content'] = 'configuracion/frm_pickdrop.php';
		$this->data['dato'] = "New";
        $this->renderc('admin/index', $this->data);
    }
    
    public function save(){ 
      
        Doo::loadModel("PickupDropoff");
        $pickdrop = new PickupDropoff($_POST);
       
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
			 
			 
			

       
         return Doo::conf()->APP_URL . "admin/pickup-dropoff";
                
    }
    
    public function edit() {
        Doo::loadModel("PickupDropoff");
        $pickdrop = new PickupDropoff();
		$pickdrop->id = $this->params["pindex"];
		  
        
      $rs =  Doo::db()->query("SELECT t1.id, t1.place, t1.address, t2.nombre, t1.posicion, t1.type_web 
	  								FROM pickup_dropoff t1	
									LEFT JOIN areas t2 ON (t1.id_area = t2.id)
                                WHERE t1.id = ?  ", array($pickdrop->id));
				
		$datas= $rs->fetch();
		
		
		
		
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['pickdrop']    = $datas;
		
		
        $this->data['equipos']     = Doo::db()->find("Codigos", array("where" => "tipo = 'equipment'", "asArray" => true));
		$this->data['areas']   = Doo::db()->find("Areas", array("select" => "id, nombre", "asArray"=>true));
       // $this->data['frecuencia']  = Doo::db()->find("Codigos", array("select tipo from Codigos" ,"asArray" => true));
        $this->data['content'] = 'configuracion/frm_pickdrop.php';
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

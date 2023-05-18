<?php

/**
 * Description of TripsController
 *
 * 
 */

Doo::loadController('I18nController');
class OfertasController extends I18nController{
   
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
                $filtro = "trip_no";
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
               
        $rs    = Doo::db()->find("Trips", array("select"=>"COUNT(*) AS total", 
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
        
        $rs = Doo::db()->query("SELECT
											t1.id,
										   t1.fecha_fin,
										   t1.fecha_ini,
										   t1.frecuente,
										   t1.price,
										   t1.price2,
										   t1.price3,
										   t1.price4,
										   t1.regular,
										   t1.trip_no,
										   t4.nombre AS trip_from,
										   t5.nombre AS trip_to
										FROM
											ofertas t1
											
											LEFT JOIN areas  t4 ON (t1.trip_from = t4.id)
											LEFT JOIN areas  t5 ON  (t1.trip_to  = t5.id)  
                                
                                where $filtro like ?  order by trip_no limit $pager->limit ", 
                                array($texto.'%'));
        
        $ofertas = $rs->fetchAll();

        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['content'] = 'configuracion/ofertas.php';
        $this->data['filtro']  = $filtro;
        $this->data['texto']   = $texto;
        $this->data['ofertas']   = $ofertas;
        $this->data['pager']   = $pager->output;
        $this->renderc('admin/index', $this->data,true);

    }
    
public function add(){
        
        Doo::loadModel("Ofertas");
        $ofertas = new Ofertas();

        $this->data['rootUrl']     = Doo::conf()->APP_URL;
        $this->data['ofertas']        = $ofertas;
        		
		$this->data['viajes']  = Doo::db()->find("Trips", array("asArray" => true));
		$this->data['areas']   = Doo::db()->find("Areas", array("select" => "id, nombre", "asArray"=>true));
        $this->data['content'] = 'configuracion/frm_ofertas.php';
		$this->data['dato'] = "New";
        $this->renderc('admin/index', $this->data);
    }
    
    public function save(){
      
        Doo::loadModel("Ofertas");
        
        $ofertas = new Ofertas($_POST);
        if(isset($ofertas->fecha_ini))
		{
		
		list($mes,$dia,$anyo) = explode("-",$ofertas->fecha_ini);
		
		
		$fecha_ini = $anyo."-".$mes."-".$dia;
		$ofertas->fecha_ini = strtotime($fecha_ini);
		
		}
		 if(isset($ofertas->fecha_fin))
		{
		
		list($mes,$dia,$anyo) = explode("-",$ofertas->fecha_fin);
		
		
		$fecha_fin = $anyo."-".$mes."-".$dia;
		$ofertas->fecha_fin = strtotime($fecha_fin);
		
		}
		
		
        $new = false;
      
        if ($_POST['id'] == "") {
            $ofertas->id = Null;
            $new = true;
        }

        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        
        if ($new)
            Doo::db()->insert($ofertas);
			
        else
           Doo::db()->update($ofertas);
            

       
         return Doo::conf()->APP_URL . "admin/ofertas";
                
    }
    
    public function edit() {
        Doo::loadModel("Ofertas");
        $ofertas = new Ofertas();
        $ofertas->id = $this->params["pindex"];
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['ofertas']        = Doo::db()->find($ofertas, array('limit' => 1));
		$this->data['areas']   = Doo::db()->find("Areas", array("select" => "id, nombre", "asArray"=>true));
        $this->data['viajes']  = Doo::db()->find("Trips", array("asArray" => true));
        $this->data['content'] = 'configuracion/frm_ofertas.php';
		$this->data['dato'] = "edit";
        $this->view()->renderc('admin/index', $this->data);
    }

    public function delete() {
        Doo::loadModel("Ofertas");
        $ofertas = new Ofertas();
        $ofertas->id = $_REQUEST['item'];
        Doo::db()->delete($ofertas);
        return Doo::conf()->APP_URL . "admin/ofertas";
    }

     
}



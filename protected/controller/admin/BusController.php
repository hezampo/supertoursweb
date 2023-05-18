<?php

/**
 * Description of TripsController
 *
 * 
 */

Doo::loadController('I18nController');
class BusController extends I18nController{
   
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
        $rs    = Doo::db()->find("Bus", array("select"=>"COUNT(*) AS total", 
                                                     "where" => "$filtro like ?", 
                                                     "limit"=>1,
                                                     "param" => array($texto . '%')
                                                    ));
         $total = $rs->total;

         if ($total == 0)
           $total = 1;
        // iniciamos el paginador

        $pager = new DooPager(Doo::conf()->APP_URL."admin/bus/$filtro/$texto/page", $total, 10, 5);

        if(isset($this->params['pindex']))
            $pager->paginate(intval($this->params['pindex']));
        else
            $pager->paginate(1);
        
        $rs = Doo::db()->query("select bus.id,plate,tipobus,capacidad,fecha_ini,fecha_fin
                                from bus
                                
                                where $filtro like ?  order by fecha_ini DESC limit $pager->limit ", 
                                array($texto.'%'));
        
        $bus = $rs->fetchAll();

        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['content'] = 'configuracion/bus.php';
        $this->data['filtro']  = $filtro;
        $this->data['texto']   = $texto;
        $this->data['bus']   = $bus;
        $this->data['pager']   = $pager->output;
        $this->renderc('admin/index', $this->data,true);

    }
    
public function add(){
        
        Doo::loadModel("Bus");
        $bus = new Bus();

        $this->data['rootUrl']     = Doo::conf()->APP_URL;
		$this->data['bus']        = Doo::db()->find($bus, array('limit' => 1));
        $this->data['bus']        = $bus;
        $this->data['content'] = 'configuracion/frm_bus.php';
		$this->data['dato'] = "New";
        $this->renderc('admin/index', $this->data);
    }
    
    public function save(){
        Doo::loadModel("Bus");
		$bus = new Bus($_POST);
		list($mes,$dia,$anyo) = explode("-",$bus->fecha_ini);
			$ini = $anyo."-".$mes."-".$dia;
			$bus->fecha_ini = strtotime($ini);
		if($bus->fecha_fin){
			list($mes2,$dia2,$anyo2) = explode("-",$bus->fecha_fin);
			$fin = $anyo2."-".$mes2."-".$dia2;
			$bus->fecha_fin = strtotime($fin);
		}
		$sql = "SELECT count(*)  as total
				FROM `bus` 
				WHERE  `plate` = ? ";
		$rs = Doo::db()->query($sql, array($bus->plate));
		$nuevo = $rs->fetchAll();
		$cont = ($nuevo[0]['total']==!'')?$nuevo[0]['total']:0;
		if($cont==0){
			 if(Doo::db()->insert($bus)){
				$_SESSION['bus'] = "Bus Successfully Saved...!!" ;
			}else{
				$_SESSION['bus'] = "Failed to Save Bus...!!" ;	
			}
		}else{
			$sql = "SELECT `id`, `plate`, `tipobus`, `capacidad`, `fecha_ini`, `fecha_fin` 
				FROM `bus` 
				WHERE  `plate` = ? 
					AND `fecha_ini` = ? 
					AND fecha_fin = ? ";
			
			$rs = Doo::db()->query($sql, array($bus->plate,  $bus->fecha_ini,  $bus->fecha_fin));
			$buses = $rs->fetchAll();
			if(!empty($buses)){
				$aux = new Bus($buses[0]);
				$aux->capacidad = $bus->capacidad;
				$aux->tipobus = $bus->tipobus;
				if(Doo::db()->update($aux)){
					$_SESSION['bus'] = "Bus Successfully Update...!!" ;
					//Actualizamos cantidad
					$sql = "UPDATE `bus` SET  `capacidad` =  ?  ,  `tipobus` =  ?  
					WHERE  `bus`.`plate` = ?;";
					$rs = Doo::db()->query($sql, array($bus->capacidad, $bus->tipobus,  $bus->plate));
				}else{
              		$_SESSION['bus'] = "Failed to Update Bus...!!" ;
				}
			}else{
				$sql = "SELECT `id`, `plate`, `tipobus`, `capacidad`, `fecha_ini`, `fecha_fin` 
					FROM `bus` 
					WHERE  `plate` = ? 
						AND `fecha_ini` = ? 
						AND fecha_fin < ? ";
				$rs = Doo::db()->query($sql, array($bus->plate,  $bus->fecha_ini,  $bus->fecha_fin));
				$buses = $rs->fetchAll();
				if(!empty($buses)){// Ampliar Fecha fin
					$aux = new Bus($buses[0]);
					$aux->capacidad = $bus->capacidad;
					$aux->fecha_fin = $bus->fecha_fin;
					$aux->tipobus = $bus->tipobus;
					if(Doo::db()->update($aux)){
						$_SESSION['bus'] = "Was extended the date range of bus (".$bus->plate.")";
						//Actualizamos cantidad
						$sql = "UPDATE  `supertours_h`.`bus` SET  `capacidad` =  ? WHERE  `bus`.`id` = ?;";
						$rs = Doo::db()->query($sql, array($bus->capacidad,  $bus->plate));
					}else{
						$_SESSION['bus'] = "Ups. Failed to time to expand the date range of bus";
					}
				}else{// Ampliar Fecha ini
					$sql = "SELECT `id`, `plate`, `tipobus`, `capacidad`, `fecha_ini`, `fecha_fin` 
						FROM `bus` 
						WHERE  `plate` = ? 
							AND `fecha_ini` > ? 
							AND fecha_fin = ? ";
					$rs = Doo::db()->query($sql, array($bus->plate,  $bus->fecha_ini,  $bus->fecha_fin));
					$buses = $rs->fetchAll();
					if(!empty($buses)){// Ampliar Fecha fin
						$aux = new Bus($buses[0]);
						$aux->capacidad = $bus->capacidad;
						$aux->fecha_ini = $bus->fecha_ini;
						$aux->tipobus = $bus->tipobus;
						if(Doo::db()->update($aux)){
							$_SESSION['bus'] = "Was extended the date range of bus (".$bus->plate.")";
							//Actualizamos cantidad
							$sql = "UPDATE  `supertours_h`.`bus` SET  `capacidad` =  ? WHERE  `bus`.`id` = ?;";
							$rs = Doo::db()->query($sql, array($bus->capacidad,  $bus->plate));
						}else{
							$_SESSION['bus'] = "Ups. Failed to time to expand the date range of bus";
						}
					}
				}
			}
		}
		
		
      
        if(isset($_POST['superbox'])){
			return $_SERVER['HTTP_REFERER'];	
		}else{
         	return Doo::conf()->APP_URL . "admin/bus";
         }  
    }
    
    public function edit() {
        Doo::loadModel("Bus");
        $bus = new Bus();
        $bus->id = $this->params["pindex"];
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['bus']        = Doo::db()->find($bus, array('limit' => 1));
        $this->data['content'] = 'configuracion/frm_bus.php';
		$this->data['dato'] = "edit";
        $this->view()->renderc('admin/index', $this->data);
    }

    public function delete() {
        Doo::loadModel("Bus");
        $bus = new Bus();
        $bus->id = $_REQUEST['item'];
        if(Doo::db()->delete($bus)){
			$_SESSION['bus'] = "Bus Successfully Delete...!!" ;
        }else{
			$_SESSION['bus'] = "Failed to Delete Bus...!!" ;
		}
        return Doo::conf()->APP_URL . "admin/bus";
    }

     
}

?>

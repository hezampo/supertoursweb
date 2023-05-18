<?php

/**
 * Description of RatezBlockController
 *
 * @author Angel Valencia.
 */

Doo::loadController('I18nController');

class RatesblockController extends I18nController{
   
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
               
//        $rs    = Doo::db()->find("Ratesblock", array("select"=>"COUNT(*) AS total", 
//                                                     "where" => "$filtro like ?", 
//                                                     "limit"=>1,
//                                                     "param" => array($texto . '%')
//                                                    ));
        $sql = "SELECT COUNT( * ) AS total
               FROM hoteles AS h, ratesblock AS r
               WHERE h.nombre LIKE ?
               AND r.id_hotel = h.id";
        $rs = Doo::db()->fetchAll($sql,array($texto.'%'));
         $total = $rs[0]['total'];

         if ($total == 0)
           $total = 1;
        // iniciamos el paginador
        //url base /admin/tours/block-rates/:filtro/:texto/page/:pindex
        $pager = new DooPager(Doo::conf()->APP_URL."admin/tours/block-rates/$filtro/$texto/page", $total, 10, 5);

        if(isset($this->params['pindex']))
            $pager->paginate(intval($this->params['pindex']));
        else
            $pager->paginate(1);
        
        $rs = Doo::db()->query("SELECT t1.id,t1.fecha_ini,t1.fecha_fin,t2.nombre
					FROM ratesblock t1
                                        LEFT JOIN hoteles t2 ON (t1.id_hotel = t2.id)
                                where t2.".$filtro." like ? order by t1.id limit $pager->limit ", 
                                array('%'.$texto.'%'));
        
        $ratesblock = $rs->fetchAll();

        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['content'] = 'configuracion/ratesblock.php';
        $this->data['filtro']  = $filtro;
        $this->data['texto']   = $texto;
        $this->data['ratesblock']   = $ratesblock;
        $this->data['pager']   = $pager->output;
        $this->renderc('admin/index', $this->data,true);

    }
    
  public function add(){
        
        Doo::loadModel("Ratesblock");
        $ratesblock = new Ratesblock();

        $this->data['rootUrl']     = Doo::conf()->APP_URL;
        $this->data['ratesblock']        = $ratesblock;
	    $this->data['hotel']  = Doo::db()->find("Hoteles",array("select id,nombre from hoteles" ,"asArray" => true)); 
        $this->data['content'] = 'configuracion/frm_rblock.php';
		$this->data['dato'] = "New";
        $this->renderc('admin/index', $this->data);
    }
   
    public function save(){
      
        Doo::loadModel("Ratesblock");

        $ratesblock = new Ratesblock($_POST);
		
        list($mes,$dia,$anyo) = explode("-",$ratesblock->fecha_ini);
		
		
		$fecha_ini = $anyo."-".$mes."-".$dia;
				
		$ratesblock->fecha_ini = strtotime($fecha_ini);
		
		
		if(isset($ratesblock->fecha_fin)){
		
		list($mes2,$dia2,$anyo2) = explode("-",$ratesblock->fecha_fin);
		
		$fecha_fin = $anyo2."-".$mes2."-".$dia2;
		$ratesblock->fecha_fin = strtotime($fecha_fin);
		
		}
		
        $new = false;
      
        if ($_POST['id'] == "") {
            $ratesblock->id = Null;
            $new = true;
        }

        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        
        if ($new)
            Doo::db()->insert($ratesblock);
        else
           Doo::db()->update($ratesblock);

         return Doo::conf()->APP_URL . "admin/tours/block-rates";
                
    }
    
    public function edit() {
        Doo::loadModel("Ratesblock");
        $ratesblock = new Ratesblock();
        $ratesblock->id = $this->params["pindex"];
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['ratesblock']        = Doo::db()->find($ratesblock, array('limit' => 1));
		$this->data['hotel']  = Doo::db()->find("Hoteles",array("select id,nombre from hoteles" ,"asArray" => true)); 
        $this->data['content'] = 'configuracion/frm_rblock.php';
		$this->data['dato'] = "edit";
        $this->view()->renderc('admin/index', $this->data);
    }
	
	

    public function delete() {
        Doo::loadModel("Ratesblock");
        $ratesblock = new Ratesblock();
        $ratesblock->id = $_REQUEST['item'];
        Doo::db()->delete($ratesblock);
        return Doo::conf()->APP_URL . "admin/tours/block-rates";
    }

    
}

?>

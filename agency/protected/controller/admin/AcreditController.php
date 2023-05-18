<?php

/**
 * Description of TripsController
 *
 * 
 */

Doo::loadController('I18nController');
class AcreditController extends I18nController{
   
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
               
        $rs    = Doo::db()->find("Acredito", array("select"=>"COUNT(*) AS total", 
                                                     "where" => "? like ?", 
                                                     "limit"=>1,
                                                     "param" => array($filtro,$texto . '%')
                                                    ));
         $total = $rs->total;

         if ($total == 0)
           $total = 1;
        // iniciamos el paginador

        $pager = new DooPager(Doo::conf()->APP_URL."admin/agency/credit/$filtro/$texto/page", $total, 10, 5);

        if(isset($this->params['pindex']))
            $pager->paginate(intval($this->params['pindex']));
        else
            $pager->paginate(1);
        
        $rs = Doo::db()->query("SELECT  t1.id,t1.fecha,t1.cantidad,t1.id_agency_account,t2.company_name, t1.disponible
                                       FROM credito t1
                                 LEFT JOIN agencia t2 ON (t1.id_agency_account = t2.id)

                                 where t2.$filtro like ?  order by t1.id limit $pager->limit ", 
                                array($texto.'%'));
        
        $areas = $rs->fetchAll();

        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['content'] = 'configuracion/acredito.php';
        $this->data['filtro']  = $filtro;
        $this->data['texto']   = $texto;
        $this->data['areas']   = $areas;
        $this->data['pager']   = $pager->output;
        $this->renderc('admin/index', $this->data,true);

    }
    
public function add(){
        
        Doo::loadModel("Acredito");
        $acredito = new Acredito();
        $sql = "SELECT t1.id_agencia,t2.company_name,t2.id FROM agency_account t1  LEFT JOIN agencia t2 ON (t1.id_agencia = t2.id)
                 WHERE t1.opcion5 = 2";
		$rs = Doo::db()->query($sql);
		$datos  = $rs->fetchALl();
        $this->data['rootUrl']      = Doo::conf()->APP_URL;
		$this->data['acredito']        = Doo::db()->find($acredito, array('limit' => 1));
        $this->data['acredito']        = $acredito;
		 $this->data['agencias']   = $datos;
        $this->data['content'] = 'configuracion/frm_acredito.php';
		$this->data['dato'] = "New";
        $this->renderc('admin/index', $this->data);
    }
    
    public function save(){
      
        Doo::loadModel("Acredito");
        
        $acredito = new Acredito($_POST);
		$acredito->disponible = $acredito->cantidad;
       
		$acredito->fecha = date("m-d-Y");
        $new = false;
      
        if ($_POST['id'] == "") {
            $acredito->id = Null;
            $new = true;
        }
        if ($new){
            Doo::db()->insert($acredito);
			}
        else{
            Doo::db()->update($acredito);
            }

       
         return Doo::conf()->APP_URL . "admin/agency/credit";
                
    }
    
    public function edit() {
        Doo::loadModel("Acredito");
        $acredito = new Acredito();
		$sql = "SELECT t1.id_agencia,t2.company_name,t2.id FROM agency_account t1  LEFT JOIN agencia t2 ON (t1.id_agencia = t2.id)
                 WHERE t1.opcion5 = 2";
		$rs = Doo::db()->query($sql);
		$datos  = $rs->fetchALl();
        $acredito->id = $this->params["pindex"];
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['acredito']        = Doo::db()->find($acredito, array('limit' => 1));
		$this->data['agencias']   = $datos;
        $this->data['content'] = 'configuracion/frm_acredito.php';
		$this->data['dato'] = "edit";
        $this->view()->renderc('admin/index', $this->data);
    }

    public function delete() {
        Doo::loadModel("Acredito");
        $acredito = new Acredito();
        $acredito->id = $_REQUEST['item'];
        Doo::db()->delete($acredito);
        return Doo::conf()->APP_URL . "admin/agency/credit";
    }

     
}



<?php

/**
 * Description of AgencyController
 *
 * @Angel Valencia.
 */

Doo::loadController('I18nController');
class ComisionController extends I18nController{
   
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
               
        $rs    = Doo::db()->find("Agencomi", array("select"=>"COUNT(*) AS total", 
                                                     "where" => "$filtro like ?", 
                                                     "limit"=>1,
                                                     "param" => array($texto . '%')
                                                    ));
         $total = $rs->total;

         if ($total == 0)
           $total = 1;
        // iniciamos el paginador

        $pager = new DooPager(Doo::conf()->APP_URL."admin/agency/comision/$filtro/$texto/page", $total, 10, 5);

        if(isset($this->params['pindex']))
            $pager->paginate(intval($this->params['pindex']));
        else
            $pager->paginate(1);
        
        $rs = Doo::db()->query("SELECT id,service,service_code,comision
									  FROM agencia_comision
									  
									 where $filtro like ? order by id limit $pager->limit ", 
                                array('%'.$texto.'%'));
        
        $comis = $rs->fetchAll();

        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['content'] = 'configuracion/agencia_comis.php';
        $this->data['filtro']  = $filtro;
        $this->data['texto']   = $texto;
        $this->data['comis']   = $comis;
        $this->data['pager']   = $pager->output;
        $this->renderc('admin/index', $this->data,true);

    }
    public function vistas()
	{
		  $this->data['rootUrl'] = Doo::conf()->APP_URL;
		  $this->data['content'] = 'configuracion/frm_agency.php';	
		  $this->renderc('admin/index', $this->data,true);
	}
  public function add(){
        
        Doo::loadModel("Agencomi");
        $agencomi = new Agencomi();

        $this->data['rootUrl']     = Doo::conf()->APP_URL;
        $this->data['agencomi']        = $agencomi;
	   	       
        $this->data['content'] = 'configuracion/frm_acomis.php';
		$this->data['dato'] = "New";
        $this->renderc('admin/index', $this->data);
    }
   
    public function save(){
      
         Doo::loadModel("Agencomi");

         $agencomi = new Agencomi($_POST);
        
		
        $new = false;
      
        if ($_POST['id'] == "") {
           $agencomi->id = Null;
		   $agencomi->service = strtoupper($agencomi->service);
           $new = true;
        }
    
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        
        if ($new){
             Doo::db()->insert($agencomi);
		}else{
		$agencomi->service = strtoupper($agencomi->service);
		   Doo::db()->update($agencomi);
            }
         return Doo::conf()->APP_URL . "admin/agency/comision";
                
    }
    
    public function edit() {
        Doo::loadModel("Agencomi");
        $agencomi = new Agencomi();
        $agencomi->id = $this->params["pindex"];
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
     	$this->data['agencomi']        = Doo::db()->find($agencomi, array('limit' => 1));
		$this->data['content'] = 'configuracion/frm_acomis.php';
		$this->data['dato'] = "edit";
        $this->view()->renderc('admin/index', $this->data);
    }
	
	

    public function delete() {
       
        Doo::loadModel("Agencomi");
        $agencomi = new Agencomi();
        $agencomi->id = $_REQUEST['item'];
        Doo::db()->delete($agencomi);
       return Doo::conf()->APP_URL . "admin/agency/comision";
    }

 
}


<?php

/**
 * Description of AdebitoController
 *
 * 
 */

Doo::loadController('I18nController');
class AdebitController extends I18nController{
   
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
               
        $rs    = Doo::db()->find("Adebito", array("select"=>"COUNT(*) AS total", 
                                                     "where" => "$filtro like ?", 
                                                     "limit"=>1,
                                                     "param" => array($texto . '%')
                                                    ));
         $total = $rs->total;

         if ($total == 0)
           $total = 1;
        // iniciamos el paginador

        $pager = new DooPager(Doo::conf()->APP_URL."admin/agency/debit/$filtro/$texto/page", $total, 10, 5);

        if(isset($this->params['pindex']))
            $pager->paginate(intval($this->params['pindex']));
        else
            $pager->paginate(1);
        
        $rs = Doo::db()->query("SELECT   t1.id,t1.fecha,t1.cantidad,t1.referepago,t1.anexo,t2.company_name
                                    FROM debito t1
                                 LEFT JOIN agencia t2 ON (t1.id_agency_account = t2.id)

                                 where t1.$filtro like ?  order by t1.id limit $pager->limit ", 
                                array($texto.'%'));
        
        $areas = $rs->fetchAll();

        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['content'] = 'configuracion/adebito.php';
        $this->data['filtro']  = $filtro;
        $this->data['texto']   = $texto;
        $this->data['areas']   = $areas;
        $this->data['pager']   = $pager->output;
        $this->renderc('admin/index', $this->data,true);

    }
    
public function add(){
        
        Doo::loadModel("Adebito");
        $adebito = new Adebito();
        $sql = "SELECT t1.id_agencia,t2.company_name,t2.id FROM agency_account t1  LEFT JOIN agencia t2 ON (t1.id_agencia = t2.id)
                 WHERE t1.opcion5 = 2";
		$rs = Doo::db()->query($sql);
		$datos  = $rs->fetchAll();
        $this->data['rootUrl']      = Doo::conf()->APP_URL;
		$this->data['acredito']        = Doo::db()->find($adebito, array('limit' => 1));
        $this->data['adebito']        = $adebito;
		 $this->data['agencias']   = $datos;
        $this->data['content'] = 'configuracion/frm_debito.php';
		$this->data['dato'] = "New";
        $this->renderc('admin/index', $this->data);
    }
    
    public function save(){
      
        Doo::loadModel("Adebito");
        
        $adebito = new Adebito($_POST);
		
       
		$adebito->fecha = date("m-d-Y");
        $new = false;
      
        if ($_POST['id'] == "") {
		
            $adebito->id = Null;
            $new = true;
        }

     
        if ($new){
		
            if (is_uploaded_file($_FILES['anexo']['tmp_name']) ) { 
			echo "entro";
			 exit();
			if($_FILES['anexo']['type'] == "image/gif" || $_FILES['anexo']['type'] == "application/pdf" || $_FILES['anexo']['type'] == "application/msword" || $_FILES['anexo']['type'] == "application/vnd.openxmlformats-officedocument.wordprocessingml.document" || $_FILES['anexo']['type'] == "image/png" || $_FILES['anexo']['type'] == "image/bmp" || $_FILES['anexo']['type'] == "image/jpeg"){
			
			
				
		   $imagen = $_FILES['anexo']['name']; 
		   $imagen1 = explode(".",$imagen);
		   $imagen2 = rand(0,9).rand(100,9999).rand(100,9999).".".$imagen1[1]; 
		   
		   move_uploaded_file($_FILES['anexo']['tmp_name'], Doo::conf()->SITE_PATH."global/files/docu/" .$imagen2);
		   $adebito->anexo = $imagen2;
            Doo::db()->insert($adebito); 
		   }else
		   {
		     echo "tipo de archivo equivocado";
			 return Doo::conf()->APP_URL . "error";
		   }}
	}
    else{
		
           if (is_uploaded_file($_FILES['anexo']['tmp_name']) ) {
		    
			 if(isset($_POST['ruta'])){
			 
		     $path = Doo::conf()->SITE_PATH."global/files/docu/".$_POST['ruta'];
			
	         if (file_exists($path)){ 
			    unlink($path);
				
			}
			}
			
			if($_FILES['anexo']['type'] == "image/gif" || $_FILES['anexo']['type'] == "application/pdf" || $_FILES['anexo']['type'] == "application/msword" || $_FILES['anexo']['type'] == "application/vnd.openxmlformats-officedocument.wordprocessingml.document" || $_FILES['anexo']['type'] == "image/png" || $_FILES['anexo']['type'] == "image/bmp" || $_FILES['anexo']['type'] == "image/jpeg"){
			
			
				
		   $imagen = $_FILES['anexo']['name']; 
		   $imagen1 = explode(".",$imagen);
		   $imagen2 = rand(0,9).rand(100,9999).rand(100,9999).".".$imagen1[1]; 
		   
		   move_uploaded_file($_FILES['anexo']['tmp_name'], Doo::conf()->SITE_PATH."global/files/docu/" .$imagen2);
		   $adebito->anexo = $imagen2;
            Doo::db()->update($adebito);
		   }else
		   {
		     echo "tipo de archivo equivocado";
			 return Doo::conf()->APP_URL . "error";
		   }
		   
		   }
		   
		   }

       
         return Doo::conf()->APP_URL . "admin/agency/debit";
                
    }
    
    public function edit() {
        Doo::loadModel("Adebito");
        $adebito = new Adebito();
		$sql = "SELECT t1.id_agencia,t2.company_name,t2.id FROM agency_account t1  LEFT JOIN agencia t2 ON (t1.id_agencia = t2.id)
                 WHERE t1.opcion5 = 2";
		$rs = Doo::db()->query($sql);
		$datos  = $rs->fetchALl();
        $adebito->id = $this->params["pindex"];
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['adebito']        = Doo::db()->find($adebito, array('limit' => 1));
		$this->data['agencias']   = $datos;
        $this->data['content'] = 'configuracion/frm_debito.php';
		$this->data['dato'] = "edit";
        $this->view()->renderc('admin/index', $this->data);
    }

    public function delete() {
        Doo::loadModel("Adebito");
        $adebito = new Adebito();
        $adebito->id = $_REQUEST['item'];
        Doo::db()->delete($adebito);
        return Doo::conf()->APP_URL . "admin/agency/debit";
    }

     
}

?>

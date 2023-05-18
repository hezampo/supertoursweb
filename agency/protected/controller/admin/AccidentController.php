<?php

/**
 * Description of AccidentController
 *
 * 
 */

Doo::loadController('I18nController');
Doo::loadHelper('DooFile');
class AccidentController extends I18nController{
   
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
               
        $rs    = Doo::db()->find("Accident_drag", array("select"=>"COUNT(*) AS total", 
                                                     "where" => "$filtro like ?", 
                                                     "limit"=>1,
                                                     "param" => array($texto . '%')
                                                    ));
         $total = $rs->total;

         if ($total == 0)
           $total = 1;
        // iniciamos el paginador

        $pager = new DooPager(Doo::conf()->APP_URL."admin/accident-drag/$filtro/$texto/page", $total, 10, 5);

        if(isset($this->params['pindex']))
            $pager->paginate(intval($this->params['pindex']));
        else
            $pager->paginate(1);
        
        $rs = Doo::db()->query("SELECT t1.id, t1.fecha,t1.reporte,t1.anexo,t2.firstname,t2.lastname
										FROM accident_drag t1 
										
										LEFT JOIN driver t2 ON (t1.id_driver = t2.id)


                                where t1.$filtro like ? order by t1.id limit $pager->limit ", 
                                array('%'.$texto.'%'));
        
        $accident = $rs->fetchAll();

        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['content'] = 'configuracion/acciden_drag.php';
        $this->data['filtro']  = $filtro;
        $this->data['texto']   = $texto;
        $this->data['accident']   = $accident;
        $this->data['pager']   = $pager->output;
        $this->renderc('admin/index', $this->data,true);

    }
    
  public function add(){
        
        Doo::loadModel("Accident_drag");
        $accident_drag = new Accident_drag();

        $this->data['rootUrl']     = Doo::conf()->APP_URL;
        $this->data['accident']        = $accident_drag;
	    $this->data['driver']  = Doo::db()->find("Driver",array("select id,name  " ,"asArray" => true)); 
        $this->data['content'] = 'configuracion/frm_accident.php';
		$this->data['dato'] = "New";
        $this->renderc('admin/index', $this->data);
    }
   
    public function save(){
      

        Doo::loadModel("Accident_drag");

        $accident_drag = new Accident_drag($_POST);
		
        list($mes,$dia,$anyo) = explode("-",$accident_drag->fecha);
		
		
		$fecha = $anyo."-".$mes."-".$dia;
				
		$accident_drag->fecha = strtotime($fecha);
		
		/*doophp 
		
		$file = new DooFile();
		
		$uploadPath = Doo::conf()->SITE_PATH."global/files/";
		$filename = $_FILES['anexo']['name'];
		$rename = "fdas"; 
		
		$file->upload($uploadPath, $filename,$rename);
		 
	   
		
		echo Doo::conf()->SITE_PATH."global/files".$filename;
		exit();*/
		
	
		
		
        $new = false;
      
        if ($_POST['id'] == "") {
            $accident_drag->id = Null;
            $new = true;
        }

        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        
        if ($new){
		if (is_uploaded_file($_FILES['anexo']['tmp_name']) ) { 
			
			if($_FILES['anexo']['type'] == "image/gif" || $_FILES['anexo']['type'] == "application/pdf" || $_FILES['anexo']['type'] == "application/msword" || $_FILES['anexo']['type'] == "application/vnd.openxmlformats-officedocument.wordprocessingml.document" || $_FILES['anexo']['type'] == "image/png" || $_FILES['anexo']['type'] == "image/bmp" || $_FILES['anexo']['type'] == "image/jpeg"){
			
			
				
		   $imagen = $_FILES['anexo']['name']; 
		   $imagen1 = explode(".",$imagen);
		   $imagen2 = rand(0,9).rand(100,9999).rand(100,9999).".".$imagen1[1]; 
		   
		   move_uploaded_file($_FILES['anexo']['tmp_name'], Doo::conf()->SITE_PATH."global/files/docu/" .$imagen2);
		   $accident_drag->anexo = $imagen2;
            Doo::db()->insert($accident_drag); 
		   }else
		   {
		     echo "tipo de archivo equivocado";
			 return Doo::conf()->APP_URL . "error";
		   }
  
    }
		    
      }  else{
          
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
		   $accident_drag->anexo = $imagen2;
            Doo::db()->update($accident_drag);
		   }else
		   {
		     echo "tipo de archivo equivocado";
			 return Doo::conf()->APP_URL . "error";
		   }
		   
		   }}
		   
         return Doo::conf()->APP_URL . "admin/driver/accident-drag";
                
    }
    
    public function edit(){
        Doo::loadModel("Accident_drag");
        $accident_drag = new Accident_drag();
        $accident_drag->id = $this->params["pindex"];
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['accident']        = Doo::db()->find($accident_drag, array('limit' => 1));
		$this->data['driver']  = Doo::db()->find("Driver",array("select id,name  " ,"asArray" => true));  
        $this->data['content'] = 'configuracion/frm_accident.php';
		$this->data['dato'] = "edit";
        $this->view()->renderc('admin/index', $this->data);
    }
	
	

    public function delete(){
        Doo::loadModel("Accident_drag");
        $accident_drag = new Accident_drag();
        $accident_drag->id = $_REQUEST['item'];
        Doo::db()->delete($accident_drag);
		
        return Doo::conf()->APP_URL . "admin/driver/accident-drag";
    }


    
}



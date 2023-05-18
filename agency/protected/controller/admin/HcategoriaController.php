<?php

/**
 * Description of HcategoriaController
 *
 * @author Angel Valencia
 */

Doo::loadController('I18nController');
class HcategoriaController extends I18nController{
   
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
               
        $rs    = Doo::db()->find("Hoteles", array("select"=>"COUNT(*) AS total", 
                                                     "where" => "$filtro like ?", 
                                                     "limit"=>1,
                                                     "param" => array($texto . '%')
                                                    ));
         $total = $rs->total;

         if ($total == 0)
           $total = 1;
        // iniciamos el paginador

        $pager = new DooPager(Doo::conf()->APP_URL."admin/hotel-category/$filtro/$texto/page", $total, 10, 5);

        if(isset($this->params['pindex']))
            $pager->paginate(intval($this->params['pindex']));
        else
            $pager->paginate(1);
        
        $rs = Doo::db()->query("SELECT id,nombre, star
											FROM hotelcategoria


                                where $filtro like ? order by id limit $pager->limit ", 
                                array('%'.$texto.'%'));
        
        $hotelcategory = $rs->fetchAll();

        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['content'] = 'configuracion/hcategory.php';
        $this->data['filtro']  = $filtro;
        $this->data['texto']   = $texto;
        $this->data['hotelcategory']   = $hotelcategory;
        $this->data['pager']   = $pager->output;
        $this->renderc('admin/index', $this->data,true);

    }
    
  public function add(){
        
        Doo::loadModel("Hcategoria");
        $hcategoria = new Hcategoria();

        $this->data['rootUrl']     = Doo::conf()->APP_URL;
        $this->data['hcategoria']        = $hcategoria;
	  
        $this->data['content'] = 'configuracion/frm_hcategory.php';
		$this->data['dato'] = "New";
        $this->renderc('admin/index', $this->data);
    }
   
    public function save(){
      
        Doo::loadModel("Hcategoria");

        $hcategoria = new Hcategoria($_POST);
        
        $new = false;
      
        if ($_POST['id'] == "") {
            $hcategoria->id = Null;
            $new = true;
        }

        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        
        if ($new)
            Doo::db()->insert($hcategoria);
        else
           Doo::db()->update($hcategoria);

         return Doo::conf()->APP_URL . "admin/tours/hotel-category";
                
    }
    
    public function edit() {
        Doo::loadModel("Hcategoria");
        $hcategoria = new Hcategoria();
        $hcategoria->id = $this->params["pindex"];
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['hcategoria']        = Doo::db()->find($hcategoria, array('limit' => 1));
		$this->data['dato'] = "edit";
        $this->data['content'] = 'configuracion/frm_hcategory.php';
        $this->view()->renderc('admin/index', $this->data);
    }
	
	

    public function delete() {
        Doo::loadModel("Hcategoria");
        $hcategoria = new Hcategoria();
        $hcategoria->id = $_REQUEST['item'];
        Doo::db()->delete($hcategoria);
        return Doo::conf()->APP_URL . "admin/tours/hotel-category";
    }

    
}



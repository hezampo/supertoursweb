<?php
/**
 * Description of RolesController
 *
 * @author Angel Valencia.
 */
Doo::loadController('I18nController');

class RolesController extends I18nController {

    public function beforeRun($resource, $action) {
       if (!isset($_SESSION['login'])) {
            return Doo::conf()->APP_URL;
        }
    }
    
    public function index(){

         if (!isset($_POST["filtro"]))
            $filtro = "role";
        else
            $filtro = $_POST["filtro"];

        if (!isset($_POST["texto"]))
            $texto = "";
        else
            $texto = $_POST["texto"];

        $roles = Doo::db()->find("Roles", array("where" => "$filtro like ?",
                                                "desc" => "id",
                                                "asArray" => true,
                                                "param" => array($texto.'%')));
       
	   
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['content'] = 'seguridad/roles.php';
        $this->data['roles'] = $roles;
        $this->data['filtro'] = $filtro;
        $this->data['texto']  = $texto;
        $this->renderc('admin/index', $this->data,true);

    }

    public function add(){

        Doo::loadModel("Roles");
        $role = new Roles();

        $this->data['rootUrl']   = Doo::conf()->APP_URL;
        $this->data['role'] = $role;
        $this->data['opciones'] = $this->getOpciones();
        $this->data['content'] = 'seguridad/frm_role.php';
		$this->data['dato'] = "New";
        $this->renderc('admin/index', $this->data);

    }

   public function save(){

        Doo::loadModel("Roles");
        Doo::loadModel("RolesOpciones");

        $role = new Roles($_POST);

        if ($role->id == "") {
          $role->id = Null;
        }
         
        $opciones = $_POST["opcion"];

        foreach ($opciones as $opcion):
            $ro = new RolesOpciones();
            $ro->opcion  = $opcion;
            $a_op[] = $ro;
        endforeach;
		
		//$consultar = $_POST["consultar"];
		
        $rs = Doo::db()->query("SELECT  id,clase,id_opcion FROM datos");
		
		$dataquery = $rs->fetchAll();
		
		//print_r($dataquery);
		//exit();
        if ($role->id == Null){
            Doo::db()->relatedInsert($role, $a_op);
        }else {
		     
			 /*  $texto1 = "";
			 foreach($opciones as $dato){
			 	foreach($dataquery as $query){
		        echo $query['id_opcion'];
					if($dato == $query['id_opcion']){
					
					    $texto1 .= '$acl["admin"]["allow"] = array( "'.$query['clase'].'"=>"*" );'; 
				      
		                }
						
					foreach($consultar as $datos){
					
					
					
						if($datos != $query['id_opcion']){
						 $texto = '$acl["admin"]["deny"] = array(';
						 $texto .= '"ParqueController"=>array(';
						   }
						   
						}
					
					foreach($consultar as $datos){
						if($datos != $query['id_opcion']){
						    $texto .= '"index",';
						   }
						   
						}
					
				 
				 foreach($consultar as $datos){
						if($datos != 31){
				$texto .= ')';
			  $texto .= ');';
						   }
						 	  
					}
			  
			  }
			}
			  //echo $texto;
		    //print_r($_POST);
			
		
		
		  
		    $nuevoarchivo = fopen(Doo::conf()->SITE_PATH.'protected/config/acl.conf.php', "w+");
			
			
			
			
			fwrite($nuevoarchivo,"<?php $texto1 $texto ?>");
			fclose($nuevoarchivo);
				exit();*/
			
		
            Doo::db()->query("delete from roles_opciones where role_id = ?",array($role->id));
            Doo::db()->relatedUpdate($role, $a_op);
        }

       // print_r(Doo::db()->showSQL());

       return Doo::conf()->APP_URL."admin/roles";

    }

    public function edit(){

        $id    = $this->params["pindex"];
        $role  = Doo::db()->find("Roles",
                                 array('where' => 'id = ?','limit' => 1,
                                        'param' => array($id)));

        $this->data['rootUrl']   = Doo::conf()->APP_URL;
        $this->data['role']      = $role;
        $this->data['opciones']  = $this->getOpciones($id);
        $this->data['content']   = 'seguridad/frm_role.php';
		$this->data['dato'] = "edit";
        $this->renderc('admin/index', $this->data);
    }

    private function getOpciones($role="") {
        
        $lang = Doo::conf()->lang;
        
        if ($role == "") {
            $sql = "select codigo, CONCAT(REPEAT('&nbsp;',LENGTH(codigo)), menuitem_$lang) AS menuitem, '' as opcion  FROM opciones";
        } else {
            $sql = "select
                       o.codigo,CONCAT(REPEAT('&nbsp;',LENGTH(codigo)), menuitem_$lang) AS menuitem,r.opcion
                    from opciones o
                    left JOIN
                       roles_opciones r on (o.codigo = r.opcion and r.role_id = '$role')";
        }

        $rs = Doo::db()->query($sql);
		
        return $rs->fetchAll();
    }
	
	public function delete() {
	
        Doo::loadModel("Roles");
        $roles = new Roles();
        $roles->id = $_REQUEST['item'];
        Doo::db()->delete($roles);
		Doo::db()->query("delete from roles_opciones where role_id = ?",array($roles->id));
        return Doo::conf()->APP_URL . "admin/roles";
    }
   
}


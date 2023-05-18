<?php

/**
 * Description of TripsController
 *
 * @author Ivan Gallo P.
 */

Doo::loadController('I18nController');
class ClienteController extends I18nController{
   
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
               
        $rs    = Doo::db()->find("Clientes", array("select"=>"COUNT(*) AS total", 
                                                     "where" => "$filtro like ?", 
                                                     "limit"=>1,
                                                     "param" => array($texto . '%')
                                                    ));
         $total = $rs->total;

         if ($total == 0)
           $total = 1;
        // iniciamos el paginador
		

        $pager = new DooPager(Doo::conf()->APP_URL."admin/clientes/$filtro/$texto/page", $total, 10, 5);

        if(isset($this->params['pindex']))
            $pager->paginate(intval($this->params['pindex']));
        else
            $pager->paginate(1);
        
		
        $rs = Doo::db()->query("select clientes.id,username,firstname,lastname,phone,celphone,city,state,country,address
                                from clientes
                                where $filtro like ? order by id limit $pager->limit ", 
                                array('%'.$texto.'%'));
        
        $clientes = $rs->fetchAll();

        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['content'] = 'configuracion/cliente.php';
        $this->data['filtro']  = $filtro;
        $this->data['texto']   = $texto;
        $this->data['clientes']   = $clientes;
        $this->data['pager']   = $pager->output;
        $this->renderc('admin/index', $this->data,true);

    }
    
  public function add(){
        
		
        Doo::loadModel("Clientes");
        $cliente = new Clientes();		

        $this->data['rootUrl']     = Doo::conf()->APP_URL;
        $this->data['cliente']        = $cliente;
	   	$this->data['state']  = Doo::db()->find("State",array("select name from State" ,"asArray" => true));
		$this->data['country']  = Doo::db()->find("Country",array("select name from Country" ,"asArray" => true));        $this->data['clientepagador']        = '0';
		$this->data['cliente_pagador_otro']        = 0;
        $this->data['content'] = 'configuracion/frm_client.php';
        $this->renderc('admin/index', $this->data);
    }
	
	 public function addClient(){
        Doo::loadModel("Clientes");
        $cliente = new Clientes();
		$cliente->username = (isset($this->params['username']))?$this->params['username']:'';
		$cliente->firstname = (isset($this->params['firstname']))?$this->params['firstname']:'';
		$cliente->lastname  = (isset($this->params['lastname']))?$this->params['lastname']:'';

        $this->data['rootUrl']     = Doo::conf()->APP_URL;
        $this->data['cliente']        = $cliente;
	   	$this->data['state']  = Doo::db()->find("State",array("select name from State" ,"asArray" => true));
		$this->data['country']  = Doo::db()->find("Country",array("select name from Country" ,"asArray" => true));
		$this->data['clientepagador']        = '0';
                $this->data['frm']        = '0';
		$this->data['cliente_pagador_otro']        = 0;
        $this->renderc('admin/configuracion/frm_client', $this->data);
    }
	
	public function addPagador(){
        Doo::loadModel("Clientes");
		$aux = $this->params;
		foreach($aux as $key => $v){
			$aux[$key] = trim(strtoupper(urldecode($v)));
		}
		foreach($aux as $key => $v){
			$aux[$key] = ($aux[$key] == '0')?'':$aux[$key];
		}
        $cliente = new Clientes($aux);
		$id = $this->params['id']; 
		if($id== '' || $id == 0){
			$id = -1;
		}
		if($id != -1){
			$cliente = new Clientes();
			$cliente->id = $this->params['id'];
       		$cliente  = Doo::db()->find($cliente, array('limit' => 1));
			if(empty($cliente)){
				$cliente = new Clientes($aux);
				 Doo::db()->insert($cliente);
			}
		}
        $this->data['rootUrl']     = Doo::conf()->APP_URL;
        $this->data['cliente']        = $cliente;
		$this->data['clientepagador']        = '1';
                $this->data['creating'] = true;
	   	$this->data['state']  = Doo::db()->find("State",array("select name from State" ,"asArray" => true));
		$this->data['country']  = Doo::db()->find("Country",array("select name from Country" ,"asArray" => true));
        $this->renderc('admin/configuracion/frm_client', $this->data);
    }
	
		
   
    public function save(){
	
		
        Doo::loadModel("Clientes");
        $cliente = new Clientes($_POST);
		
		$cliente->tipo_client = 1;
                $new = false;
		$aux = new Clientes();
		$aux->id = $_POST['id'];
        $aux  = Doo::db()->find($aux, array('limit' => 1)); //busca si existe el id
        if (empty($aux)) { //si es vacio
            $cliente->id = Null;
            $new = true; //el cliente es nuevo
        }else{
			$cliente->id = $_POST['id']; //sino, el cliente tiene el id que viene por post
		}
		
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $accion = 0;
        if ($new){ //si el cliente es nuevo
			$sql = "SELECT id FROM clientes WHERE username = ? ";
			$rs = Doo::db()->query($sql,array($cliente->username)); 
	        $aux = $rs->fetchAll();
			if(empty($aux)){
				if(Doo::db()->insert($cliente)){
					$accion = 1;
					$id = Doo::db()->lastInsertId(); 
					$cliente->id = $id;
				}
			}
		}else{
			$sql = "SELECT id FROM clientes WHERE username = ? AND id != ? ";
			$rs = Doo::db()->query($sql,array($cliente->username, $cliente->id));
	        $aux = $rs->fetchAll();
			if(empty($aux)){
				Doo::db()->update($cliente);
				$accion =1;
				$id = Doo::db()->lastInsertId(); 
			}
		}
			
		 if(isset($_POST['cliente_pagador'])){
			 if($accion==1){
				 $toReturn = $cliente->lastname . " " .$cliente->firstname . " - E-Mail -" . $cliente->username;
				 $salidaJson = array(
				 		"id" => $cliente->id,
						"firstname" => $cliente->firstname,
						"lastname" => $cliente->lastname,
						"phone" => $cliente->phone,
						"username" => $cliente->username,
						"leader" => $toReturn,
						"accion" => $accion
				 ); 
		 	 }else{
				$salidaJson = array(
				 		"id" => $cliente->id,
						"firstname" => '',
						"lastname" => '',
						"phone" => '',
						"username" => $cliente->username,
						"leader" => '' ,
						"accion" => $accion
				 );
			 }
                         if(isset($_POST['creator'])){
                             return Doo::conf()->APP_URL.'admin/clientes';
                         }else{
                            echo json_encode($salidaJson);	
                         }
		 }else if($_POST['frm'] == 0){
			return Doo::conf()->APP_URL . "admin/clientes";		 
		 }else{
			  $toReturn = $cliente->lastname . " " .$cliente->firstname . " - E-Mail -" . $cliente->username;
			  $salidaJson = array(
				 		"id" => $cliente->id,
						"firstname" => $cliente->firstname,
						"lastname" => $cliente->lastname,
						"phone" => $cliente->phone,
						"username" => $cliente->username,
						"leader" => $toReturn,
						"accion" => $accion
				 );
		      if(isset($_POST['creator'])){
                             return Doo::conf()->APP_URL.'admin/clientes';
                         }else{
                            echo json_encode($salidaJson);	
                         }	
		 }
                        
                
    }
	
    
    public function edit() {
        Doo::loadModel("Clientes");
        $cliente = new Clientes();
        $cliente->id = $this->params["pindex"];
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['cliente']  = Doo::db()->find($cliente, array('limit' => 1));
		$this->data['state']  = Doo::db()->find("State",array("select name from State" ,"asArray" => true));
		$this->data['country']  = Doo::db()->find("Country",array("select name from Country" ,"asArray" => true));
        $this->data['content'] = 'configuracion/frm_client.php';
		$this->data['clientepagador']        = '0';
		$this->data['cliente_pagador_otro']        = 1;
        $this->view()->renderc('admin/index', $this->data);
    }
	
	

    public function delete() {
        Doo::loadModel("Clientes");
        $cliente = new Clientes();
        $cliente->id = $_REQUEST['item'];
		$cliente = Doo::db()->find($cliente, array('limit' => 1));
        Doo::db()->delete($cliente);
        return Doo::conf()->APP_URL . "admin/clientes";
    }
	
	public function datosCliente(){
		Doo::loadModel("Clientes");
        $cliente = new Clientes();
		if($this->params["id"] != '0' && $this->params["id"] != '-1' && trim($this->params["id"]) != ''){			
			$cliente->id = $this->params["id"];
			$cliente = Doo::db()->find($cliente, array('limit' => 1));
		}
		$state = Doo::db()->find("State",array("select name from State" ,"asArray" => true));
		$country  = Doo::db()->find("Country",array("select name from Country" ,"asArray" => true));
        
		echo ' 
            <div class="input">
                <label style="width:150px" class="required" id="l_username">Username / E-mail*</label>
                <input type="text" name="username" id="username"  size="25" maxlength="40"  value="'. $cliente->username.'"/>
            </div>
            <div class="input">
                <label style="width:150px" class="required" id="l_firstname">Firts Name*</label>
                <input type="text" name="firstname" id="firstname" size="25" maxlength="30" value="'. $cliente->firstname.'"/>
            </div>
        
            <div class="input">
                <label style="width:150px" class="required" id="l_lastname">Last Name*</label>
                <input name="lastname" type="text"  id="lastname" size="25" maxlength="30"  value="'. $cliente->lastname.'" />
            </div>
          
         <div class="input">
                <label style="width:150px" class="required" id="l_phone">Phone</label>
                <input name="phone" type="text"  id="phone" size="20" maxlength="20"  value="'.$cliente->phone.'" />
            </div>    
            <div class="input">
                <label style="width:150px" class="required" id="l_city">City</label>
                <input name="city" type="text"  id="city" size="25" maxlength="25"  value="'.$cliente->city.'" />
            </div> 
            <div class="input">
                <label style="width:150px" class="required" id="l_state">State</label>
                <select name="state" id="state" class="select">
                  <option value=""></option>  ';
            foreach($state as $e):
                  echo '
                       <option value="'.$e['name'].'" '.($cliente->state == trim($e['name'])?'selected':'').'>'. $e["name"].'</option>';
                   endforeach;
               echo ' </select>
               
            </div>
            <div class="input">
                <label style="width:150px" class="required" id="l_country">Country</label>
                <select name="country" id="country" class="select">
                  <option value=""></option> '; 
                  foreach($country as $e):
                  echo '
                       <option value="'.$e['name'].'" '.($cliente->country == trim($e['name'])?'selected':'').'>'.$e["name"].'</option>';
                  endforeach;
				  echo '
                </select>
               
            </div>
                <div class="input">
                <label style="width:150px" class="required" id="l_address">Address</label>
                <input name="address" type="text"  id="address" size="25" maxlength="25"  value="'.$cliente->address .'" />
            </div> 
            <div class="input">
                <label style="width:150px" class="required" id="l_zip">Zip code</label>
                <input name="zip" type="text"  id="zip" size="25" maxlength="25"  value="'.$cliente->zip.'" />
            </div> 
        <input name="id" type="hidden"  id="id"  value="'.$cliente->id.'" />';
	}

    
}

?>

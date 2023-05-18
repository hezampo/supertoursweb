<?php

Doo::loadController('I18nController');
class UsersController extends I18nController{
    
    public function beforeRun($resource, $action) {
       if (!isset($_SESSION['login'])) {
            return Doo::conf()->APP_URL;
        }
    }
    
    public function addUser(){
        $this->data['rootUrl']     = Doo::conf()->APP_URL;
        $this->data['content']     = 'configuracion/frm_users_add.php' ;
        $sql = "select * from roles";
        $query = Doo::db()->query($sql);
        $rs = $query->fetchAll();
        $this->data['roles'] = $rs;
        $this->view()->renderc('admin/index',$this->data);
    }
    
    public function saveUser(){
        try{
        extract($_POST,EXTR_SKIP);
        Doo::loadModel('Usuarios');
        $u = new Usuarios();
        $u->nombre = $lastname.' '.$firstname;
        $u->usuario = $username;
        $u->email = $email;
        $u->password = md5($password);
        $u->role = $roles;
        if(isset($active)){
            $u->estado = 1;
        }else{
            $u->estado = 0;
        }
        $u->fecha_creacion = date('Y-m-d h:i');
        $u->insert();
        return Doo::conf()->APP_URL.'admin/users';
        }catch(Exception $e){
            
        }
    }
    
    public function existuserajax(){
        $u = $this->params['username'];
        //echo $u;
        $rs    = Doo::db()->find("Usuarios", array("select"=>"COUNT(*) AS total", 
                                                     "where" => "usuario = ? ", 
                                                     "limit"=>1,
                                                     "param" => array($u)
                                                    ));
        if ($rs->total > 0){
            echo '<input type="hidden" id="selected" value="true" />';
        }else{
            echo '<input type="hidden" id="selected" value="false" />';
        }
    }
    
    public function existemailajax(){
        $u = $this->params['email'];
        //echo $u;
        $rs    = Doo::db()->find("Usuarios", array("select"=>"COUNT(*) AS total", 
                                                     "where" => "email = ? ", 
                                                     "limit"=>1,
                                                     "param" => array($u)
                                                    ));
        if ($rs->total > 0){
            echo '<input type="hidden" id="selected-email" value="true" />';
        }else{
            echo '<input type="hidden" id="selected-email" value="false" />';
        }
    }
    
    public function index(){
        
        
         if (!isset($_POST["filtro"]))
            $filtro = "usuario";
        else
            if($_POST['filtro'] == 'username'){
            $filtro = 'usuario';
            }else{
            $filtro = $_POST["filtro"];
            }
        if (!isset($_POST["texto"]))
            $texto = "";
        else
        $texto = $_POST["texto"];
        $usuarios = Doo::db()->find("Usuarios", array("where" => "$filtro like ?",
                                                "desc" => "id",
                                                "param" => array($texto.'%')));
       
        $sql = "select id,role from roles";
        $query = Doo::db()->query($sql);
        $rs = $query->fetchAll();
        $roles = array();
        foreach($rs as $k=>$v){
            $roles[$v['id']] = $v['role'];
        }
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['content'] = 'configuracion/frm_list_users.php';
        $this->data['roles'] = $roles;
        $this->data['usuarios'] = $usuarios;
        $this->data['filtro'] = ($filtro == "usuario")? "username":$filtro;
        $this->data['texto']  = $texto;
        $this->renderc('admin/index', $this->data,true);

    }
    
    
    public function editUser(){
        $id = $this->params['id'];
        Doo::loadModel('Usuarios');
        $u = new Usuarios();
        $u->id = $id;
        $u = Doo::db()->getOne($u);
        $this->data['usuario'] = $u;
        $sql = "select * from roles";
        $query = Doo::db()->query($sql);
        $rs = $query->fetchAll();
        $this->data['roles'] = $rs;
        $scripts = '';
        $scripts.='$(function(){
                    $("#roles").val('.$u->role.')
                    });';
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['scripts'] = $scripts;
        $this->data['content'] = 'configuracion/frm_users_edit.php';
        $this->renderc('admin/index', $this->data,true);
    }
    
    public function deleteUser(){
        $id = $this->params['id'];
        Doo::loadModel('Usuarios');
        $u = new Usuarios();
        $u->id = $id;
        $u = Doo::db()->getOne($u);
        $u->delete();
        return Doo::conf()->APP_URL.'admin/users';
    }
    
    public function saveUser_edited(){
        try{
            extract($_POST,EXTR_SKIP);
            Doo::loadModel('Usuarios');
            $u = new Usuarios();
            $u->id = $id;
            $u = Doo::db()->getOne($u);
            
            if($u->email != $email){
                $u->email = $email;
            }
            
            if($u->nombre != $lastname.' '.$firstname){
                $u->nombre = $lastname.' '.$firstname;
            }

            if(isset($change_password)){
                $u->password = md5($password);
            }

            if($u->role != $roles){
                $u->role = $roles;
            }
            
            if(isset($active)){
                $u->estado = 1;
            }else{
                $u->estado = 0;
            }
            
            $u->update();
            return Doo::conf()->APP_URL.'admin/users';
        }catch(Exception $p){
            
        }
    }
    
}
?>

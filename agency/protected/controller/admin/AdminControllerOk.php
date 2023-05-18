<?php

if (Doo::acl()->isDenied("operador", "AdminController")) {
    echo "entro";
    exit();
}

Doo::loadController('I18nController');

class AdminController extends I18nController {

    public function isAuth() {

        if (isset($_SESSION["login"])) {
            return true;
        } else {
            return false;
        }
    }

    public function home() {

        $auth = $this->isAuth();
        
        
        if ($auth) {
            $this->data['rootUrl'] = Doo::conf()->APP_URL;
            $this->data['content'] = 'home.php';
            $this->renderc('admin/index', $this->data);
        } else {
            return Doo::conf()->APP_URL . "admin";
        }
    }

    public function index() {

        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->view()->renderc('admin/login', $this->data);
    }

    public function login() {

        if (isset($_POST['usuario']) && isset($_POST['password'])) {

            if (!empty($_POST['usuario']) && !empty($_POST['password'])) {

                $user = trim($_POST['usuario']);
                
                $pass = md5(trim($_POST['password']));
                //$pass  = trim($_POST['password']);
                
                
                $u = $this->db()->find('Usuarios', array('where' => 'usuario = ? and password = ? and estado = 1',
                    'limit' => 1,
                    'select' => 'id,role,usuario,nombre,email,id_pago,usuario_pago,pin_pago',
                    'param' => array($user, $pass)
                        )
                );

                $this->data['rootUrl'] = Doo::conf()->APP_URL;

                if ($u == Null) { // o $u == false
                    $this->data['error'] = "Access Denied";
                    //return Doo::conf()->APP_URL."admin";
                    $this->renderc('admin/login', $this->data);
                } else {
                    $this->buildMenu($u->role);
                    $login = new stdclass();
                    $login->usuario = $u->usuario;
                    $login->nombre = $u->nombre;
                    $login->email = $u->email;
                    $login->id_pago = $u->id_pago;
                    $login->usuario_pago = $u->usuario_pago;
                    $login->pin_pago = $u->pin_pago;
                    
                    $login->id = $u->id;
                    $login->menu = $this->data["htmlmenu"];
                    $login->toolbar = $this->data["toolbar"];
                    
                    $_SESSION['login'] = $login;
                                 
                    //$this->home();
                    return Doo::conf()->APP_URL . "admin/home";
                    
                }
            }
        } else {
            return Doo::conf()->APP_URL . "admin";
        }
    }

    public function logout() {
        unset($_SESSION['usuario']);
        session_destroy();
        return Doo::conf()->APP_URL . "admin/ok";
    }

    private function buildMenu($role) {

        $this->data["role"] = $role;
        $lang = Doo::conf()->lang;

        $sql = "select
                       o.codigo, o.menuitem_$lang, o.depende, o.submenu, o.url, r.opcion, o.quicklink
                       from opciones o
                       left join roles_opciones r on (o.codigo = r.opcion and r.role_id = '$role')
                      where depende = ''";


        $rs = Doo::db()->query($sql);
        $parentMenu = $rs->fetchAll();

        $this->data["toolbar"] = "";
        $this->data["htmlmenu"] = '<div id="menu-bar">';
        $this->data["htmlmenu"].= '<ul id="menu">';
        $this->buildChildMenu($parentMenu);
        $this->data["htmlmenu"].= '</ul>';
        $this->data["htmlmenu"].= '<br class="clear" />';
        $this->data["htmlmenu"].= '</div>';
    }

    private function buildChildMenu($parentMenu) {

        $role = $this->data["role"];
        $lang = Doo::conf()->lang;

        foreach ($parentMenu as $row){

            $submenu = $row["submenu"];
            $depende = $row["depende"];
            $codigo = $row["codigo"];
            $opcion = $row["opcion"];
            $toolbar = $row["quicklink"];

            if ($submenu == 'S') {
                if (strlen($opcion) != Null) {//condicion para desaparecer el menu desplegable completo 
                    $this->data["htmlmenu"].= '<li>';
                    $this->data["htmlmenu"].= '<a class="node" href="javascript:void(0);">' . ($row["menuitem_$lang"]) . '</a>';

                    $sql = "select
                           o.codigo, o.menuitem_$lang, o.depende, o.submenu, o.url, r.opcion,o.quicklink
                       from opciones o
                       left join roles_opciones r on (o.codigo = r.opcion and r.role_id = '$role')
                      where depende = '$codigo'";


                    $rs = Doo::db()->query($sql);
                    $childMenu = $rs->fetchAll();

                    $this->data["htmlmenu"].= '<ul>';
                    $this->buildChildMenu($childMenu);
                    $this->data["htmlmenu"].= '</ul>';
                    $this->data["htmlmenu"].= '</li>';
                }
            } else {

                if (strlen($opcion) != Null) {
                    $this->data["htmlmenu"].= '<li>';
                    $this->data["htmlmenu"].= '<a href="' . Doo::conf()->APP_URL . $row["url"] . '">' . ($row["menuitem_$lang"]) . '</a>';
                    if ($toolbar != "" & strlen($opcion) != Null) {

                        $toolbar = $this->data["rootUrl"] . "global/img/" . $toolbar;
                        $this->data["toolbar"].= '<div class="icon">
                                        <a href="' . Doo::conf()->APP_URL . $row["url"] . '"><img src="' . $toolbar . '" width="48" height="48" border="0"  alt="' . ($row["menuitem_$lang"]) . '"/><span>' . ($row["menuitem_$lang"]) . '</span></a>
                                     </div>';
                    }
                    $this->data["htmlmenu"].= '</li>';
                }
            }


        }
    }

}

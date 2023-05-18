<?php

/**
 * Description of TripsController
 *
 * 
 */
Doo::loadController('I18nController');

class ExtController extends I18nController {

    public function beforeRun($resource, $action) {
        if (!isset($_SESSION['login'])) {
            return Doo::conf()->APP_URL;
        }
    }

    public function index() {

        // Cargamos el paginador
        Doo::loadHelper('DooPager');

        if (!isset($_POST["filtro"])) {
            if (!isset($this->params['filtro'])) {
                $filtro = "place";
            } else {
                $filtro = $this->params['filtro'];
            }
        } else {
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

        $rs = Doo::db()->find("Extension", array("select" => "COUNT(*) AS total",
            "where" => "$filtro like ?",
            "limit" => 1,
            "param" => array($texto . '%')
        ));
        $total = $rs->total;

        if ($total == 0)
            $total = 1;
        // iniciamos el paginador

        $pager = new DooPager(Doo::conf()->APP_URL . "admin/extension/$filtro/$texto/page", $total, 10, 5);

        if (isset($this->params['pindex']))
            $pager->paginate(intval($this->params['pindex']));
        else
            $pager->paginate(1);

        $rs = Doo::db()->query("SELECT t1.id,t1.place,t1.address,t1.precio,t1.precio_neto,t1.precio_especial,t2.nombre
												FROM extension t1
													LEFT JOIN areas t2 ON (t1.id_area = t2.id)
                                
                                where t1.$filtro like ?  order by t1.id limit $pager->limit ", array($texto . '%'));

        $extension = $rs->fetchAll();

        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['content'] = 'configuracion/extension.php';
        $this->data['filtro'] = $filtro;
        $this->data['texto'] = $texto;
        $this->data['extension'] = $extension;
        $this->data['pager'] = $pager->output;
        $this->renderc('admin/index', $this->data, true);
    }

    public function add() {

        Doo::loadModel("Extension");

        $extension = new Extension();

        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['extension'] = Doo::db()->find($extension, array('limit' => 1));
        $this->data['extension'] = $extension;
        $this->data['equipos'] = Doo::db()->find("Codigos", array("where" => "tipo = 'equipment'", "asArray" => true));
        //$this->data['frecuencia']  = Doo::db()->find("Codigos", array("where" => "tipo = 'frecuency'","asArray" => true));
        $this->data['areas'] = Doo::db()->find("Areas", array("select" => "id, nombre", "asArray" => true));
        $this->data['bus'] = Doo::db()->find("Bus", array("asArray" => true));
        $this->data['content'] = 'configuracion/frm_ext.php';
        $this->data['dato'] = "New";
        $this->renderc('admin/index', $this->data);
    }

    public function save() {

        Doo::loadModel("Extension");

        $extension = new Extension($_POST);

        $new = false;

        if ($_POST['id'] == "") {
            $extension->id = Null;
            $new = true;
        }

        $extension->valid = 1;

        $this->data['rootUrl'] = Doo::conf()->APP_URL;

        if ($new) {
            Doo::db()->insert($extension);
        } else {
            Doo::db()->update($extension);
        }

        return Doo::conf()->APP_URL . "admin/extension";
    }

    public function edit() {
        Doo::loadModel("Extension");
        $extension = new Extension();
        $extension->id = $this->params["pindex"];

        $this->data['rootUrl'] = Doo::conf()->APP_URL;

        $this->data['extension'] = Doo::db()->find($extension, array('limit' => 1));
        $this->data['equipos'] = Doo::db()->find("Codigos", array("where" => "tipo = 'equipment'", "asArray" => true));
        $this->data['areas'] = Doo::db()->find("Areas", array("select" => "id, nombre", "asArray" => true));
        $this->data['content'] = 'configuracion/frm_ext.php';
        $this->data['dato'] = "edit";
        $this->view()->renderc('admin/index', $this->data);
    }

    public function delete() {
        Doo::loadModel("Extension");
        $extension = new Extension();
        $extension->id = $_REQUEST['item'];
        Doo::db()->delete($extension);
        return Doo::conf()->APP_URL . "admin/extension";
    }

}


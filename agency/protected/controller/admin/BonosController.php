<?php

/**
 * Description of TripsController
 *
 * @author Andrew Fraser
 */
Doo::loadController('I18nController');

class BonosController extends I18nController {

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
                $filtro = "id";
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

        $rs = Doo::db()->find("Bonos", array("select" => "COUNT(*) AS total",
            "where" => "$filtro like ?",
            "limit" => 1,
            "param" => array($texto . '%')
                ));
        $total = $rs->total;

        if ($total == 0)
            $total = 1;

        //Iniciamos el paginador
        $pager = new DooPager(Doo::conf()->APP_URL . "admin/bonos/$filtro/$texto/page", $total, 10, 5);

        if (isset($this->params['pindex']))
            $pager->paginate(intval($this->params['pindex']));
        else
            $pager->paginate(1);

        $rs = Doo::db()->query("SELECT id,codigo,nombre,tipo_cliente,rule_id,asignado,redimido,valor,cantidad,fecha_creacion,fecha_vencimiento
                                FROM bonos
                                WHERE $filtro like ? order by id limit $pager->limit ", array('%' . $texto . '%'));

        $bonos = $rs->fetchAll();

        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['content'] = 'configuracion/bonos.php';
        $this->data['filtro'] = $filtro;
        $this->data['texto'] = $texto;
        $this->data['bonos'] = $bonos;
        $this->data['pager'] = $pager->output;
        $this->renderc('admin/index', $this->data, true);
    }

    public function add() {

        Doo::loadModel("Bonos");
        $bono = new Bonos();

        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['bono'] = $bono;
        $this->data['rules'] = Doo::db()->fetchAll("SELECT * FROM bonos_rules");
        $this->data['clientes'] = Doo::db()->fetchAll("SELECT * FROM clientes");
        $this->data['state'] = Doo::db()->find("State", array("select name from State", "asArray" => true));
        $this->data['country'] = Doo::db()->find("Country", array("select name from Country", "asArray" => true));
        $this->data['content'] = 'configuracion/frm_bono.php';
		$this->data['dato'] = "New";
        $this->renderc('admin/index', $this->data);
    }

    public function save() {

        Doo::loadModel("Bonos");

        $bono = new Bonos($_POST);
        $new = false;

        if ($_POST['id'] == "") {
            $bono->id = Null;
            $new = true;
        }

        $this->data['rootUrl'] = Doo::conf()->APP_URL;

        if ($new)
            Doo::db()->insert($bono);
        else
            Doo::db()->update($bono);

        return Doo::conf()->APP_URL . "admin/bonos";
    }

    public function edit() {

        Doo::loadModel("Bonos");
        $bono = new Bonos();
        $bono->id = $this->params["pindex"];
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['bono'] = Doo::db()->find($bono, array('limit' => 1));
        $this->data['rules'] = Doo::db()->fetchAll("SELECT * FROM bonos_rules");
        $this->data['clientes'] = Doo::db()->fetchAll("SELECT * FROM clientes");
        $this->data['state'] = Doo::db()->find("State", array("select name from State", "asArray" => true));
        $this->data['country'] = Doo::db()->find("Country", array("select name from Country", "asArray" => true));
        $this->data['content'] = 'configuracion/frm_bono.php';
		$this->data['dato'] = "edit";
        $this->view()->renderc('admin/index', $this->data);
    }

    public function delete() {
        Doo::loadModel("Bonos");
        $bono = new Bonos();
        $bono->id = $_REQUEST['item'];
        Doo::db()->delete($bono);
        return Doo::conf()->APP_URL . "admin/bonos";
    }

}



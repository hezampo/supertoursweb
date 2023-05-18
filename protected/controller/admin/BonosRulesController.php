<?php

/**
 * Rewards Crud CRUD.
 * Create Date. 05:25 p.m. 05/09/2012.
 * @author Andrew Fraser.
 */
Doo::loadController('I18nController');

class BonosRulesController extends I18nController {

    //Valida si se ha iniciado sesion previamente.
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

        //Cargar registros de la tabla.       
        $rs = Doo::db()->find("BonosRules", array("select" => "COUNT(*) AS total",
            "where" => "$filtro like ?",
            "limit" => 1,
            "param" => array($texto . '%')
                ));

        $total = $rs->total;

        if ($total == 0)
            $total = 1;
        //iniciamos el paginador

        $pager = new DooPager(Doo::conf()->APP_URL . "admin/BonosRules/$filtro/$texto/page", $total, 10, 5);

        if (isset($this->params['pindex']))
            $pager->paginate(intval($this->params['pindex']));
        else
            $pager->paginate(1);

        $rs = Doo::db()->query("SELECT id,tipo_bono,valor,vencimiento
                                FROM bonos_rules
                                WHERE $filtro like ? order by id limit $pager->limit ", array('%' . $texto . '%'));

        $bonos_rules = $rs->fetchAll();

        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['content'] = 'configuracion/BonosRules.php';
        $this->data['filtro'] = $filtro;
        $this->data['texto'] = $texto;
        $this->data['bonos_rules'] = $bonos_rules;
        $this->data['pager'] = $pager->output;
        $this->renderc('admin/index', $this->data, true);
    }

    public function add() {

        Doo::loadModel("BonosRules");
        $bono_rule = new BonosRules();

        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['bono_rule'] = $bono_rule;
        $this->data['state'] = Doo::db()->find("State", array("select name from State", "asArray" => true));
        $this->data['country'] = Doo::db()->find("Country", array("select name from Country", "asArray" => true));
        $this->data['content'] = 'configuracion/frm_bono_rule.php';
		$this->data['dato'] = "New";
        $this->renderc('admin/index', $this->data);
    }

    public function save() {

        Doo::loadModel("BonosRules");

        $bono_rule = new BonosRules($_POST);

        $new = false;

        if ($_POST['id'] == "") {
            $bono_rule->id = Null;
            $new = true;
        }

        $this->data['rootUrl'] = Doo::conf()->APP_URL;

        if ($new)
            Doo::db()->insert($bono_rule);
        else
            Doo::db()->update($bono_rule);

        return Doo::conf()->APP_URL . "admin/BonosRules";
    }

    public function edit() {

        Doo::loadModel("BonosRules");

        $bono_rule = new BonosRules();
        $bono_rule->id = $this->params["pindex"];
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['bono_rule'] = Doo::db()->find($bono_rule, array('limit' => 1));
        $this->data['state'] = Doo::db()->find("State", array("select name from State", "asArray" => true));
        $this->data['country'] = Doo::db()->find("Country", array("select name from Country", "asArray" => true));
        $this->data['content'] = 'configuracion/frm_bono_rule.php';
		$this->data['dato'] = "edit";
        $this->view()->renderc('admin/index', $this->data);
    }

    public function delete() {
        Doo::loadModel("BonosRules");
        $bono_rule = new BonosRule();
        $bono_rule->id = $_REQUEST['item'];
        Doo::db()->delete($bono_rule);
        return Doo::conf()->APP_URL . "admin/BonosRules";
    }

}

?>

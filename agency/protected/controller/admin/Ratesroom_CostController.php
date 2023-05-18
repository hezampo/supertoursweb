<?php

/**
 * Description of Ratesroom_CostController
 *
 * @author Angel Valencia.
 */
Doo::loadController('I18nController');

class Ratesroom_CostController extends I18nController {

    public function beforeRun($resource, $action) {
        if (!isset($_SESSION['login'])) {
            return Doo::conf()->APP_URL;
        }
    }

    public function index() {

        // Cargamos el paginador
        Doo::loadHelper('DooPager');
        $filtro = "";
        if (!isset($this->params['type_rate'])) {
            $type_rate = "0";
        } else {
            $type_rate = $this->params['type_rate'];
        }

        if (!isset($_POST["filtro"])) {
            if (!isset($this->params['filtro'])) {
                $filtro = "";
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

        $rtval = 0;
        $fi = "";
        if ($filtro == "codigo") {
            $fi = "codigo";
            $filtro = " and t2.codigo like '%" . $texto . "%'";
            $rtval = 1;
        }
        if ($filtro == "nombre") {
            $fi = "nombre";
            $filtro = "and t2.nombre like '%" . $texto . "%'";
            $rtval = 2;
        }
        $ano = strtotime(date("Y") . "-01-01");
        $sql = "select count(*) as total  from (SELECT t1.id,t1.id_hotel,t1.fecha_ini,t1.fecha_fin, t1.sgl, t1.dbl, t1.tpl,
     									  t1.qua, t1.brackfast, t1.super_breakfast
      									 FROM hotel_cost t1
										 LEFT JOIN hoteles t2 ON (t1.id_hotel = t2.id)
                                 $filtro order by t1.id) as result";
        $qset = Doo::db()->query($sql);
        $rs = $qset->fetchAll();
        $total = $rs[0]['total'];

        if ($total == 0)
            $total = 1;
        // iniciamos el paginador

        $pager = new DooPager(Doo::conf()->APP_URL . "admin/tours/room-rates-cost/$fi/$texto/$type_rate/page", $total, 10, 5);

        if (isset($this->params['pindex']))
            $pager->paginate(intval($this->params['pindex']));
        else
            $pager->paginate(1);

        $rs = Doo::db()->query("SELECT t1.id,t1.id_hotel,t1.fecha_ini,t1.fecha_fin, t1.sgl, t1.dbl, t1.tpl,
     									  t1.qua, t1.brackfast, t1.super_breakfast,t2.nombre
      									 FROM hotel_cost t1
										 LEFT JOIN hoteles t2 ON (t1.id_hotel = t2.id)
                                $filtro order by t1.id desc limit $pager->limit  " );

        $ratesroom = $rs->fetchAll();

        if ($rtval == 0) {
            $filtro = "";
        }
        if ($rtval == 1) {
            $fitro = "codigo";
        }
        if ($rtval == 2) {
            $filtro = "nombre";
        }

        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['content'] = 'configuracion/roomrates_Cost.php';
        //$this->data['content'] = 'configuracion/rates_B.php';
        $this->data['filtro'] = $filtro;
        $this->data['texto'] = $texto;
        $this->data['ratesroom'] = $ratesroom;
        $this->data['pager'] = $pager->output;
        $this->renderc('admin/index', $this->data, true);
    }

    public function add() {
        Doo::loadModel("Ratesroom");
        $ratesroom = new Ratesroom();
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['ratesroom'] = $ratesroom;
        $this->data['hotel'] = Doo::db()->find("Hoteles", array("select id,nombre from hoteles", "asArray" => true));
        $this->data['content'] = 'configuracion/frm_rrates_Cost.php';
        $this->data['dato'] = "New";
        $this->renderc('admin/index', $this->data);
    }

    public function save() {

        Doo::loadModel("Ratesroom_Cost");

        $ratesroom = new Ratesroom_Cost($_POST);

        list($mes, $dia, $anyo) = explode("-", $ratesroom->fecha_ini);

        $fecha_ini = $anyo . "-" . $mes . "-" . $dia;

        $ratesroom->fecha_ini = strtotime($fecha_ini);


        if (isset($ratesroom->fecha_fin)) {

            list($mes2, $dia2, $anyo2) = explode("-", $ratesroom->fecha_fin);

            $fecha_fin = $anyo2 . "-" . $mes2 . "-" . $dia2;
            $ratesroom->fecha_fin = strtotime($fecha_fin);
        }



        $rs = Doo::db()->query("SELECT tax,stoproft,maximo 
		                                  FROM hoteles 		
			                               WHERE id = ?", array($ratesroom->id_hotel));


        $porcentajes = $rs->fetch();



        $new = false;


        if ($_POST['id'] == "") {
            $ratesroom->id = Null;
            $new = true;
        }

        $this->data['rootUrl'] = Doo::conf()->APP_URL;

        if ($new) {
            try {
                Doo::db()->beginTransaction();
                
                Doo::db()->insert($ratesroom);

                Doo::db()->commit();
            } catch (Exception $exc) {
                Doo::db()->rollBack();
                //echo $exc->getTraceAsString();
                return Doo::conf()->APP_URL . "admin/tours/room-rates-cost/add/?menssage='error'";
            }
            return Doo::conf()->APP_URL . "admin/tours/room-rates-cost/edit/$id?menssage=ok";
        } else {
            try {
                Doo::db()->beginTransaction();

                Doo::db()->update($ratesroom);
                
                Doo::db()->commit();
            } catch (Exception $exc) {
                Doo::db()->rollBack();
                return Doo::conf()->APP_URL . "admin/tours/room-rates-cost/edit/$id?menssage='error'";
            }
        }
        return Doo::conf()->APP_URL . "admin/tours/room-rates-cost/edit/$id?menssage=ok";
    }

    public function edit() {
        Doo::loadModel("Ratesroom_Cost");
        $ratesroom = new Ratesroom_Cost();
        $ratesroom->id = $this->params["pindex"];
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['ratesroom'] = Doo::db()->find($ratesroom, array('limit' => 1));
        $this->data['hotel'] = Doo::db()->find("Hoteles", array("select id,nombre from hoteles", "asArray" => true));
        $this->data['content'] = 'configuracion/frm_rrates_Cost.php';
        $this->data['dato'] = "edit";
        $this->view()->renderc('admin/index', $this->data);
    }

    public function delete() {
        Doo::loadModel("Ratesroom_Cost");
        $ratesroom = new Ratesroom_Cost();
        $ratesroom->id = $_REQUEST['item'];
        Doo::db()->delete($ratesroom);
        return Doo::conf()->APP_URL . "admin/tours/room-rates-cost";
    }

}

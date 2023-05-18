<?php

/**
 * Description of TripsController
 *
 *
 */

Doo::loadController('I18nController');
class TourstripController extends I18nController{

    public function beforeRun($resource, $action) {
        if (!isset($_SESSION['login'])) {
            return Doo::conf()->APP_URL;
        }
    }

    public function index(){

        // Cargamos el paginador
        Doo::loadHelper('DooPager');

        if (!isset($this->params['type_rate'])) {
            $type_rate = "0";
        } else {
            $type_rate = $this->params['type_rate'];
        }

        if (!isset($_POST["id_agency"])) {
            if (!isset($this->params['id_agency'])) {
                $id_agency = "-1";
            } else {
                $id_agency = $this->params['id_agency'];
            }
        }else{
            $id_agency = $_POST["id_agency"];
        }


        if (!isset($_POST["company_name"])) {
            if (!isset($this->params['company_name'])) {
                $acompany = "";
            } else {
                $acompany = $this->params['company_name'];
            }
        }else{
            $acompany = $_POST["company_name"];
        }


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

        if($type_rate==2 && $id_agency == "-1"){
            $where = "type_rate=".$type_rate." and ".$filtro." like ?  ";
            $param = array($texto.'%');
            // $rs = Doo::db()->query("select COUNT(*) AS total From tarifastrip where ".$where,$param);
        }else{
            $where = "type_rate=".$type_rate." and id_agency = ? and ".$filtro." like ?  ";
            $param =  array($id_agency,$texto.'%');
            // $rs = Doo::db()->query("select COUNT(*) AS total From tarifastrip where ".$where,$param);
        }

        $rs    = Doo::db()->find("Tarifastrip", array("select"=>"COUNT(*) AS total",
            "where" => $where,
            "limit"=>1,
            "param" => $param
        ));

        $total = $rs->total;
        if ($total == 0)
            $total = 1;
        // iniciamos el paginador

        $pager = new DooPager(Doo::conf()->APP_URL."admin/tours/tarifa-trip/$filtro/$texto/$type_rate/$id_agency/page", $total, 10, 5);

        if(isset($this->params['pindex']))
            $pager->paginate(intval($this->params['pindex']));
        else
            $pager->paginate(1);

        $rs = Doo::db()->query("SELECT id,trip_no,adult,child,type_rate, annio
            ".(($type_rate == 2)?",company_name":"")." 
            FROM tarifastrip where ".$where." order by  annio DESC, id ASC limit $pager->limit ",$param);

        $tarifatrip = $rs->fetchAll();

        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['content'] = 'configuracion/tarifatrip.php';
        $this->data['filtro']  = $filtro;
        $this->data['texto']   = $texto;
        $this->data['type_rate']   = $type_rate;
        $this->data['id_agency'] = $id_agency;
        $this->data['company_name'] = $acompany;
        $this->data['tarifatrip']  = $tarifatrip;
        $this->data['pager']   = $pager->output;
        $this->renderc('admin/index', $this->data,true);

    }

    public function add(){
        Doo::loadModel("Tarifastrip");

        $tarifastrip = new Tarifastrip();
        $tarifastrip->id_agency = -1;
        $this->data['type_rate']  = $this->params['type_rate'];
        $this->data['rootUrl']     = Doo::conf()->APP_URL;
        $this->data['tarifastrip']        = Doo::db()->find($tarifastrip, array('limit' => 1));
        $this->data['tarifastrip']        = $tarifastrip;
        $this->data['equipos']     = Doo::db()->find("Codigos", array("where" => "tipo = 'equipment'", "asArray" => true));
        $this->data['trip']   = Doo::db()->find("Trips", array("select" => "id, trip_no", "asArray"=>true));
        $this->data['content'] = 'configuracion/frm_taritrip.php';
        $this->data['dato'] = "New";
        $this->renderc('admin/index', $this->data);
    }

    public function save(){

        Doo::loadModel("Tarifastrip");

        $tarifastrip = new Tarifastrip();

        $new = false;

        $tarifastrip->trip_no = $_POST['trip_no'];
        $tarifastrip->type_rate = $_POST['type_rate'];
        $tarifastrip->id_agency = $_POST['id_agency'];
        $tarifastrip->annio = $_POST['annio'].'-01-01 00:00:00';
        $tarifastrip = Doo::db()->find($tarifastrip,array("limit",1));
        if(empty($tarifastrip)){
            $tarifastrip = new Tarifastrip($_POST);
            $tarifastrip->annio = $_POST['annio'].'-01-01 00:00:00';
            $tarifastrip->id = Null;
            $new = true;
        }else{
            $tarifastrip = new Tarifastrip($tarifastrip[0]);
            $tarifastrip->annio = $_POST['annio'].'-01-01 00:00:00';
            $tarifastrip->adult = $_POST['adult'];
            $tarifastrip->child = $_POST['child'];
        }

        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        if ($new){
            if(Doo::db()->insert($tarifastrip)){
                $_SESSION['triocu'] = "Rates Successfully Saved...!!" ;
            }else{
                $_SESSION['triocu'] = "Failed to Save Rates...!!" ;
            }
        }else{
            if(Doo::db()->update($tarifastrip)){
                $_SESSION['triocu'] = "Rates Successfully Update...!!" ;
            }else{
                $_SESSION['triocu'] = "Failed to Update Rates...!!" ;
            }
        }
        return Doo::conf()->APP_URL . "admin/tours/tarifa-trip/".$_POST['type_rate'];
    }

    public function edit() {
        Doo::loadModel("Tarifastrip");
        $tarifastrip = new Tarifastrip();
        $tarifastrip->id = $this->params["pindex"];
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['trip'] = Doo::db()->find("Trips", array("select" => "id, trip_no", "asArray"=>true));
        $this->data['tarifastrip'] = Doo::db()->find($tarifastrip, array('limit' => 1));
        $this->data['type_rate'] =  $this->data['tarifastrip']->type_rate;
        $this->data['content'] = 'configuracion/frm_taritrip.php';// Crear este archivo
        $this->data['dato'] = "edit";
        $this->view()->renderc('admin/index', $this->data);
    }

    public function delete() {
        Doo::loadModel("Tarifastrip");
        $tarifastrip = new Tarifastrip();
        $tarifastrip->id = $_REQUEST['item'];
        $dats = Doo::db()->find($tarifastrip, array("limit" => 1));
        if(empty($dats)){
            $_SESSION['triocu'] = "Failed to Delete Rates...!!" ;
        }else{
            $type_rate = $dats->type_rate;
            Doo::db()->delete($tarifastrip);
            $_SESSION['triocu'] = "Rates Successfully Delete...!!" ;

        }
        return Doo::conf()->APP_URL . "admin/tours/tarifa-trip/".$type_rate;
    }




}



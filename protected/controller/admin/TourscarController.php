<?php

/**
 * Description of TripsController
 *
 *
 */

Doo::loadController('I18nController');
class TourscarController extends I18nController{

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




        $rs    = Doo::db()->find("Tarifascar", array("select"=>"COUNT(*) AS total",
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

        $rs = Doo::db()->query("SELECT id,price,type_rate, annio
                                ".(($type_rate == 2)?",company_name":"")."  
                                FROM tarifacar
                                Where ".$where." order by annio DESC limit $pager->limit ",$param);

        $tarifacar = $rs->fetchAll();

        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['content'] = 'configuracion/tarifacar.php';
        $this->data['filtro']  = $filtro;
        $this->data['texto']   = $texto;
        $this->data['type_rate']   = $type_rate;
        $this->data['id_agency'] = $id_agency;
        $this->data['company_name'] = $acompany;
        $this->data['tarifacar']   = $tarifacar;
        $this->data['pager']   = $pager->output;
        $this->renderc('admin/index', $this->data,true);

    }

    public function add(){

        Doo::loadModel("Tarifascar");
        $tarifascar = new Tarifascar();
        $tarifascar->id_agency = -1;
        $this->data['rootUrl']     = Doo::conf()->APP_URL;
        $this->data['tarifascar']        = Doo::db()->find($tarifascar, array('limit' => 1));
        $this->data['tarifascar']        = $tarifascar;
        $this->data['content'] = 'configuracion/frm_car.php';
        $this->data['dato'] = "New";
        $this->data['type_rate']  = $this->params['type_rate'];
        $this->renderc('admin/index', $this->data);
    }

    public function save(){

        Doo::loadModel("Tarifascar");
        $tarifascar = new Tarifascar();
        $new = false;
        $tarifascar->type_rate = $_POST['type_rate'];
        $tarifascar->id_agency = $_POST['id_agency'];
        $tarifascar->annio = $_POST['annio'].'-01-01 00:00:00';
        $tarifascar = Doo::db()->find($tarifascar,array("limit",1));
        if(empty($tarifascar)){
            $tarifascar = new Tarifascar($_POST);
            $tarifascar->annio = $_POST['annio'].'-01-01 00:00:00';
            $tarifascar->id = Null;
            $new = true;
        }else{
            $tarifascar = new Tarifascar($tarifascar[0]);
            $tarifascar->annio = $_POST['annio'].'-01-01 00:00:00';
            $tarifascar->price =  $_POST['price'];
        }

        $this->data['rootUrl'] = Doo::conf()->APP_URL;

        if ($new){
            if(Doo::db()->insert($tarifascar)){
                $_SESSION['car'] = "Rates Successfully Saved...!!" ;
            }else{
                $_SESSION['car'] = "Failed to Save Rates...!!" ;
            }
        }else{
            if(Doo::db()->update($tarifascar)){
                $_SESSION['car'] = "Rates Successfully Update...!!" ;
            }else{
                $_SESSION['car'] = "Failed to Update Rates...!!" ;
            }
        }
        return Doo::conf()->APP_URL . "admin/tours/tarifa-car/".$_POST['type_rate'];

    }

    public function edit() {
        Doo::loadModel("Tarifascar");
        $tarifascar = new Tarifascar();
        $tarifascar->id = $this->params["pindex"];
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['tarifascar']        = Doo::db()->find($tarifascar, array('limit' => 1));
        $this->data['content'] = 'configuracion/frm_car.php';
        $this->data['type_rate']  = $this->data['tarifascar']->type_rate;
        $this->data['dato'] = "edit";
        $this->view()->renderc('admin/index', $this->data);
    }

    public function delete() {
        Doo::loadModel("Tarifascar");
        $tarifascar = new Tarifascar();
        $tarifascar->id = $_REQUEST['item'];
        $dats = Doo::db()->find($tarifascar, array("limit" => 1));
        if(empty($dats)){
            $_SESSION['car'] = "Failed to Delete Rates...!!" ;
        }else{
            $type_rate = $dats->type_rate;
            if(Doo::db()->delete($tarifascar)){
                $_SESSION['car'] = "Rates Successfully Delete...!!" ;
            }else{
                $_SESSION['car'] = "Failed to Delete Rates...!!" ;
            }
        }
        return Doo::conf()->APP_URL . "admin/tours/tarifa-car/".$type_rate;
    }




}

?>

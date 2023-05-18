<?php

/**
 * Description of ToursvipController
 *
 * @author Angel Valencia.
 */

Doo::loadController('I18nController');
class ToursvipController extends I18nController{

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

        $rs    = Doo::db()->find("Tarifasvip", array("select"=>"COUNT(*) AS total",
            "where" => $where,
            "limit"=>1,
            "param" => $param
        ));
        $total = $rs->total;

        if ($total == 0)
            $total = 1;
        // iniciamos el paginador

        $pager = new DooPager(Doo::conf()->APP_URL."admin/tours/tarifa-vip/$filtro/$texto/$type_rate/$id_agency/page", $total, 10, 5);

        if(isset($this->params['pindex']))
            $pager->paginate(intval($this->params['pindex']));
        else
            $pager->paginate(1);

        $rs = Doo::db()->query("SELECT id,cantidad,price,type_rate, annio
                              ".(($type_rate == 2)?",company_name":"")."  
                              FROM tarifasvip WHERE ".$where." order by annio DESC, cantidad ASC limit $pager->limit ",
            $param);

        $tarifavip = $rs->fetchAll();

        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['content'] = 'configuracion/tarifavip.php';
        $this->data['filtro']  = $filtro;
        $this->data['texto']   = $texto;
        $this->data['type_rate'] = $type_rate;

        $this->data['id_agency'] = $id_agency;
        $this->data['company_name'] = $acompany;
        $this->data['tarifavip']   = $tarifavip;
        $this->data['pager']   = $pager->output;
        $this->renderc('admin/index', $this->data,true);

    }

    public function add(){

        Doo::loadModel("Tarifasvip");

        $tarifasvip = new Tarifasvip();
        $tarifasvip->id_agency = -1;
        $this->data['rootUrl']     = Doo::conf()->APP_URL;
        $this->data['tarifasvip']        = Doo::db()->find($tarifasvip, array('limit' => 1));
        $this->data['tarifasvip']        = $tarifasvip;
        $this->data['type_rate']  = $this->params['type_rate'];
        $this->data['content'] = 'configuracion/frm_vip.php';
        $this->data['dato'] = "New";
        $this->renderc('admin/index', $this->data);
    }

    public function save(){

        Doo::loadModel("Tarifasvip");

        $tarifasvip = new Tarifasvip();

        $new = false;


        $tarifasvip->cantidad = $_POST['cantidad'];
        $tarifasvip->type_rate = $_POST['type_rate'];
        $tarifasvip->id_agency = $_POST['id_agency'];
        $tarifasvip->annio = $_POST['annio'].'-01-01 00:00:00';
        $tarifasvip = Doo::db()->find($tarifasvip,array("limit",1));
        if(empty($tarifasvip)){
            $tarifasvip = new Tarifasvip($_POST);
            $tarifasvip->annio = $_POST['annio'].'-01-01 00:00:00';
            $tarifasvip->id = Null;
            $new = true;
        }else{
            $tarifasvip = new Tarifasvip($tarifasvip[0]);
            $tarifasvip->annio = $_POST['annio'].'-01-01 00:00:00';
            $tarifasvip->price =  $_POST['price'];

        }

        $this->data['rootUrl'] = Doo::conf()->APP_URL;


        if ($new){
            if(Doo::db()->insert($tarifasvip)){
                $_SESSION['vip'] = "Rates Successfully Saved...!!" ;
            }else{
                $_SESSION['vip'] = "Failed to Save Rates...!!" ;
            }
        }else{
            if(Doo::db()->update($tarifasvip)){
                $_SESSION['vip'] = "Rates Successfully Saved...!!" ;
            }else{
                $_SESSION['vip'] =  "Failed to Save Rates...!!";
            }

        }
        return Doo::conf()->APP_URL . "admin/tours/tarifa-vip/".$_POST['type_rate'];

    }

    public function edit() {
        Doo::loadModel("Tarifasvip");
        $tarifasvip = new Tarifasvip();
        $tarifasvip->id = $this->params["pindex"];
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['tarifasvip']        = Doo::db()->find($tarifasvip, array('limit' => 1));
        $this->data['type_rate'] = $this->data['tarifasvip']->type_rate;
        $this->data['content'] = 'configuracion/frm_vip.php';
        $this->data['dato'] = "edit";
        $this->view()->renderc('admin/index', $this->data);
    }

    public function delete() {
        Doo::loadModel("Tarifasvip");
        $tarifasvip = new Tarifasvip();
        $tarifasvip->id = $_REQUEST['item'];
        $dats = Doo::db()->find($tarifasvip, array("limit" => 1));
        if(empty($dats)){
            $_SESSION['vip'] = "Failed to Delete Rates...!!" ;
        }else{
            $type_rate = $dats->type_rate;
            Doo::db()->delete($tarifasvip);
            $_SESSION['vip'] = "Rates Successfully Delete...!!" ;

        }
        return Doo::conf()->APP_URL . "admin/tours/tarifa-vip/".$type_rate;
    }




}

?>

<?php

/**
 * Description of Rates_groupController
 *
 * @author Angel Valencia.
 */

Doo::loadController('I18nController');

class Rates_groupController extends I18nController{

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
                $filtro = "gp.nombre";
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

        if(trim($texto) != ''){
            $texto .='%';
        }

        if(trim($acompany) != ''){
            $acompany .='%';
        }

        $count01 = "select COUNT(*) as total from(select gp.nombre,pt.adult,pt.child,pt.annio from parques_tarifasgrupo as pt
                    left join grupo_parques gp on (pt.id_grupo = gp.id)
                    where pt.type_rate = ? and $filtro like ? ) as result";
        $count2 = "select COUNT(*) as total from (select gp.nombre,pt.adult,pt.child,pt.annio from parques_tarifasgrupo as pt
                    left join grupo_parques gp on (pt.id_grupo = gp.id)
                    left join agencia as a on (pt.id_agency = a.id)
                    where pt.type_rate = 2 and $filtro like ? and a.company_name like ? ) as result";

        if($type_rate == 2){
            $q = Doo::db()->query($count2,array('%'.$texto,'%'.$acompany));
        }else{
            $q = Doo::db()->query($count01,array($type_rate,'%'.$texto));
        }

        $rs = $q->fetchAll();
        $total = $rs[0]['total'];

        if ($total == 0)
            $total = 1;
        // iniciamos el paginador

        $pager = new DooPager(Doo::conf()->APP_URL."admin/tours/rates-group/$filtro/$texto/$type_rate/$id_agency/page", $total, 10, 5);

        if(isset($this->params['pindex']))
            $pager->paginate(intval($this->params['pindex']));
        else
            $pager->paginate(1);

        if($type_rate == 2){
            $sql02 = "select pt.id, gp.nombre as grupo,pt.adult,pt.child,pt.annio, a.company_name from parques_tarifasgrupo as pt
                    left join grupo_parques gp on (pt.id_grupo = gp.id)
                    left join agencia as a on (pt.id_agency = a.id)
                    where pt.type_rate = 2 and $filtro like ? and a.company_name like ? limit $pager->limit";
            $query = Doo::db()->query($sql02,array('%'.$texto,'%'.$acompany));
        }else{
            $sql01 = "select pt.id, gp.nombre as grupo,pt.adult,pt.child,pt.annio from parques_tarifasgrupo as pt
                    left join grupo_parques gp on (pt.id_grupo = gp.id)
                    where pt.type_rate = ? and $filtro like ? limit $pager->limit";
            $query = Doo::db()->query($sql01,array($type_rate,'%'.$texto));
        }
        $rates_group = $query->fetchAll();
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['content'] = 'configuracion/rates_group.php';
        $this->data['filtro']  = $filtro;
        $this->data['texto']   = substr($texto,0,-1);
        $this->data['type_rate']   = $type_rate;
        $this->data['id_agency'] = $id_agency;
        $this->data['company_name'] = substr($acompany,0,-1);
        $this->data['rates_group']   = $rates_group;
        $this->data['pager']   = $pager->output;
        $this->renderc('admin/index', $this->data,true);

    }

    public function add(){

        Doo::loadModel("Rates_Group");
        $rates_Group = new Rates_Group();
        $rates_Group->id_agency = -1;
        $this->data['rootUrl']     = Doo::conf()->APP_URL;
        $this->data['rates_Group']        = Doo::db()->find($rates_Group, array('limit' => 1));
        $this->data['grupos']       = Doo::db()->find("Grupo_parque", array("asArray" => true));
        $this->data['rates_Group']        = $rates_Group;
        $this->data['content'] = 'configuracion/frm_rates_group.php';
        $this->data['type_rate']  = $this->params['type_rate'];
        $this->data['dato'] = "New";
        $this->renderc('admin/index', $this->data);
    }

    public function save(){

        Doo::loadModel("Rates_Group");

        $rates_Group = new Rates_Group();
        $new = false;

        $rates_Group->id_grupo = $_POST['id_grupo'];
        $rates_Group->type_rate = $_POST['type_rate'];
        $rates_Group->id_agency = $_POST['id_agency'];
        $rates_Group ->annio	 = $_POST['annio'].'-01-01 00:00:00';
        $rates_Group = Doo::db()->find($rates_Group,array("limit",1));
        if(empty($rates_Group)){
            $rates_Group = new Rates_Group($_POST);
            $rates_Group ->annio	 = $_POST['annio'].'-01-01 00:00:00';
            $rates_Group->id = Null;
            $new = true;
        }else{
            $rates_Group = new Rates_Group($rates_Group[0]);
            $rates_Group ->annio	 = $_POST['annio'].'-01-01 00:00:00';
            $rates_Group->adult =  $_POST['adult'];
            $rates_Group->child =  $_POST['child'];
        }

        if ($new){
            if(Doo::db()->insert($rates_Group)){
                $_SESSION['response'] = "Rates Successfully Saved...!!" ;
            }else{
                $_SESSION['response'] = "Failed to Save Rates...!!" ;
            }
        }else{
            if(Doo::db()->update($rates_Group)){
                $_SESSION['response'] = "Rates Successfully Update...!!" ;
            }else{
                $_SESSION['response'] = "Failed to Update Rates...!!" ;
            }
        }

        return Doo::conf()->APP_URL . "admin/tours/rates-group/".$_POST['type_rate'];

    }

    public function edit() {
        Doo::loadModel("Rates_Group");
        $rates_Group = new Rates_Group();
        $rates_Group->id = $this->params["pindex"];
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['rates_Group']        = Doo::db()->find($rates_Group, array('limit' => 1));
        $this->data['grupos']       = Doo::db()->find("Grupo_parque", array("asArray" => true));
        $this->data['content'] = 'configuracion/frm_rates_group.php';
        $this->data['type_rate']  =  $this->data['rates_Group']->type_rate;
        $this->data['dato'] = "edit";
        $this->view()->renderc('admin/index', $this->data);
    }

    public function delete() {
        Doo::loadModel("Rates_Group");
        $rates_Group = new Rates_Group();
        $rates_Group->id = $_REQUEST['item'];
        $dats = Doo::db()->find($rates_Group, array("limit" => 1));
        if(empty($dats)){
            $_SESSION['response'] = "Failed to Delete Rates...!!" ;
        }else{
            $type_rate = $dats->type_rate;
            if(Doo::db()->delete($rates_Group)){
                $_SESSION['response'] = "Rates Successfully Delete...!!" ;
            }else{
                $_SESSION['response'] = "Failed to Delete Rates...!!" ;
            }
        }

        return Doo::conf()->APP_URL . "admin/tours/rates-group/".$type_rate;
    }


}

?>

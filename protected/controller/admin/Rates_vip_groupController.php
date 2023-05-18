<?php

/**
 * Description of Rates_groupController
 *
 * @author Angel Valencia.
 */

Doo::loadController('I18nController');

class Rates_vip_groupController extends I18nController{

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

        $counter01 = "select count(*) as total from (select pt.id,pt.amount,pt.price,pt.annio as year, gp.nombre from parques_tarifasvipgrupo as pt
                      left join grupo_parques as gp on (pt.id_grupo = gp.id)
                      where type_rate = ? and $filtro like ? order by gp.id ASC, pt.annio ASC, pt.amount DESC) as result;";
        $counter2 = "select count(*) as total from (select pt.id,pt.amount,pt.price,pt.annio as year, gp.nombre from parques_tarifasvipgrupo as pt
                     left join grupo_parques as gp on (pt.id_grupo = gp.id)
                     left join agencia as a on (pt.id_agency = a.id)
                     where pt.type_rate = 2 and $filtro like ? and a.company_name like ? order by gp.id ASC, pt.annio ASC, pt.amount DESC) as result;";

        if($type_rate == 2){
            $q2 = Doo::db()->query($counter2,array('%'.$texto.'%',$acompany));
            $rs = $q2->fetchAll();
        }else{
            $q01 = Doo::db()->query($counter01,array($type_rate,'%'.$texto));
            $rs = $q01->fetchAll();
        }

        $total = $rs[0]['total'];

        if ($total == 0)
            $total = 1;
        // iniciamos el paginador

        $pager = new DooPager(Doo::conf()->APP_URL."admin/tours/rates-vip-group/$filtro/$texto/$type_rate/$id_agency/page", $total, 10, 5);

        if(isset($this->params['pindex']))
            $pager->paginate(intval($this->params['pindex']));
        else
            $pager->paginate(1);

        if($type_rate == 2){
            $sql2 = "select pt.id,pt.amount,pt.price,pt.annio, gp.nombre as grupo, a.company_name from parques_tarifasvipgrupo as pt
                     left join grupo_parques as gp on (pt.id_grupo = gp.id)
                     left join agencia as a on (pt.id_agency = a.id)
                     where pt.type_rate = 2 and $filtro like ? and a.company_name like ? order by pt.annio DESC, gp.id ASC,  pt.amount ASC limit $pager->limit";
            $q = Doo::db()->query($sql2,array('%'.$texto.'%','%'.$acompany));
        }else{
            $sql01 = "select pt.id,pt.amount,pt.price,pt.annio, gp.nombre as grupo from parques_tarifasvipgrupo as pt
                      left join grupo_parques as gp on (pt.id_grupo = gp.id)
                      where type_rate = ? and $filtro like ? order by pt.annio DESC, gp.id ASC,  pt.amount ASC limit $pager->limit";
            $q = Doo::db()->query($sql01,array($type_rate,'%'.$texto));
        }

        $rates_vip_Group = $q->fetchAll();

        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['content'] = 'configuracion/rates_vip_group.php';
        $this->data['filtro']  = $filtro;
        $this->data['texto']   = substr($texto,0,-1);
        $this->data['type_rate']   = $type_rate;
        $this->data['id_agency'] = $id_agency;
        $this->data['company_name'] = substr($acompany,0,-1);
        $this->data['rates_group']   = $rates_vip_Group ;
        $this->data['pager']   = $pager->output;
        $this->renderc('admin/index', $this->data,true);

    }

    public function add(){

        Doo::loadModel("Rates_vip_Group");
        $rates_vip_Group = new Rates_vip_Group();
        $rates_vip_Group->id_agency = -1;
        $this->data['rootUrl']     = Doo::conf()->APP_URL;
        $this->data['rates_vip_Group']        = Doo::db()->find($rates_vip_Group, array('limit' => 1));
        $this->data['grupos']       = Doo::db()->find("Grupo_parque", array("asArray" => true));
        $this->data['rates_vip_Group']        = $rates_vip_Group;
        $this->data['content'] = 'configuracion/frm_rates_vip_group.php';
        $this->data['type_rate']  = $this->params['type_rate'];
        $this->data['dato'] = "New";
        $this->renderc('admin/index', $this->data);
    }

    public function saveGrupos(){
        Doo::loadModel("Rates_vip_Group");
        $grupos = Doo::db()->find("Grupo_parque", array("asArray" => true));
        foreach($grupos as $e){
            $rates_vip_Group = new Rates_vip_Group();
            $rates_vip_Group ->id_grupo = $e['id'];
            $rates_vip_Group ->type_rate = $_POST['type_rate'];
            $rates_vip_Group ->id_agency = $_POST['id_agency'];
            $rates_vip_Group ->amount	 = $_POST['amount'];
            $rates_vip_Group ->amount	 = $_POST['annio'].'-01-01 00:00:00';
            $rates_vip_Group = Doo::db()->find($rates_vip_Group ,array("limit",1));
            if(empty($rates_vip_Group )){
                $rates_vip_Group = new Rates_vip_Group($_POST);
                $rates_vip_Group ->id_grupo = $e['id'];
                Doo::db()->insert($rates_vip_Group );
            }
        }
    }

    public function save(){

        if($_POST['id_grupo'] == '*'){
            $this->saveGrupos();
        }else{
            Doo::loadModel("Rates_vip_Group");

            $rates_vip_Group = new Rates_vip_Group();
            $new = false;

            $rates_vip_Group ->id_grupo = $_POST['id_grupo'];
            $rates_vip_Group ->type_rate = $_POST['type_rate'];
            $rates_vip_Group ->id_agency = $_POST['id_agency'];
            $rates_vip_Group ->amount	 = $_POST['amount'];
            $rates_vip_Group ->annio	 = $_POST['annio'].'-01-01 00:00:00';
            $rates_vip_Group = Doo::db()->find($rates_vip_Group ,array("limit",1));
            if(empty($rates_vip_Group )){
                $rates_vip_Group = new Rates_vip_Group($_POST);
                $rates_vip_Group ->annio	 = $_POST['annio'].'-01-01 00:00:00';
                $rates_vip_Group ->id = Null;
                $new = true;
            }else{
                $rates_vip_Group = new Rates_vip_Group($rates_vip_Group [0]);
                $rates_vip_Group ->annio	 = $_POST['annio'].'-01-01 00:00:00';
                $rates_vip_Group ->amount =  $_POST['amount'];
                $rates_vip_Group ->price =  $_POST['price'];
            }
            if ($new){
                if(Doo::db()->insert($rates_vip_Group )){
                    $_SESSION['response'] = "Rates Successfully Saved...!!" ;
                }else{
                    $_SESSION['response'] = "Failed to Save Rates...!!" ;
                }
            }else{
                if(Doo::db()->update($rates_vip_Group)){
                    $_SESSION['response'] = "Rates Successfully Update...!!" ;
                }else{
                    $_SESSION['response'] = "Failed to Update Rates...!!" ;
                }
            }
        }
        return Doo::conf()->APP_URL . "admin/tours/rates-vip-group/".$_POST['type_rate'];

    }

    public function edit() {
        Doo::loadModel("Rates_vip_Group");
        $rates_vip_Group = new Rates_vip_Group();
        $rates_vip_Group ->id = $this->params["pindex"];
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['rates_vip_Group']        = Doo::db()->find($rates_vip_Group , array('limit' => 1));
        $this->data['grupos']       = Doo::db()->find("Grupo_parque", array("asArray" => true));
        $this->data['content'] = 'configuracion/frm_rates_vip_group.php';
        $this->data['type_rate']  =  $this->data['rates_vip_Group']->type_rate;
        $this->data['dato'] = "edit";
        $this->view()->renderc('admin/index', $this->data);
    }

    public function delete() {
        Doo::loadModel("Rates_vip_Group");
        $rates_vip_Group = new Rates_vip_Group();
        $rates_vip_Group ->id = $_REQUEST['item'];
        $dats = Doo::db()->find($rates_vip_Group , array("limit" => 1));
        if(empty($dats)){
            $_SESSION['response'] = "Failed to Delete Rates...!!" ;
        }else{
            $type_rate = $dats->type_rate;
            if(Doo::db()->delete($rates_vip_Group )){
                $_SESSION['response'] = "Rates Successfully Delete...!!" ;
            }else{
                $_SESSION['response'] = "Failed to Delete Rates...!!" ;
            }
        }

        return Doo::conf()->APP_URL . "admin/tours/rates-vip-group/".$type_rate;
    }


}

?>

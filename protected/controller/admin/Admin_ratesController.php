<?php

/**
 * Description of TripsController
 *
 *
 */
Doo::loadController('I18nController');

class Admin_ratesController extends I18nController {

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
                $filtro = "gp.nombre";
            } else {
                $filtro = $this->params['filtro'];
            }
        } else {
            $filtro = $_POST["filtro"];
        }

        if (!isset($_POST["type_rate"])) {
            if (!isset($this->params['type_rate'])) {
                $type_rate = "1";
            } else {
                $type_rate = $this->params['type_rate'];
            }
        } else {
            $type_rate = $_POST["type_rate"];
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

        if (trim($texto) != '') {
            $texto .='%';
        }
        //////
        // $annio = strtotime(date("Y") . "-01-01");
        /////
        $counter1 = "select count(*) as total from (
                        select apt.id, apt.adults, apt.child,apt.adults1, apt.child1, apt.annio, apt.fecha_ini, apt.fecha_fin, p.nombre as parque, gp.nombre as grupo
                        from admin_parques_tarifa as apt
                        left join parques as p on (apt.id_parque = p.id)
                        left join grupo_parques as gp on (apt.id_grupo = gp.id)
                     where apt.type_rate = ? and $filtro like ?) as salida;";


        $counter2 = "select count(*) as total from (
                        select apt.id, apt.adults, apt.child,apt.adults1, apt.child1, apt.annio, apt.fecha_ini, apt.fecha_fin, p.nombre as parque, gp.nombre as grupo
                        from admin_parques_tarifa as apt
                        left join parques as p on (apt.id_parque = p.id)
                        left join grupo_parques as gp on (apt.id_grupo = gp.id)
                        left join agencia as a on (apt.id_agency = a.id)
                     where apt.type_rate = 2 and $filtro like ?) as salida;";

        if ($type_rate == 2) {
            $q2 = Doo::db()->query($counter2, array($texto . '%'));
            $rs = $q2->fetchAll();
        } else {
            $q1 = Doo::db()->query($counter1, array($type_rate, $texto . '%'));
            $rs = $q1->fetchAll();
        }

        /* $rs    = Doo::db()->find("Admision_rates", array("select"=>"COUNT(*) AS total",
          "where" => "$filtro like ?",
          "limit"=>1,
          "param" => array($texto . '%')
          )); */
        $total = $rs[0]['total'];

        if ($total == 0)
            $total = 1;
        // iniciamos el paginador

        $pager = new DooPager(Doo::conf()->APP_URL . "admin/tours/admision-rate/$type_rate/$filtro/$texto/page", $total, 10, 5);

        if (isset($this->params['pindex']))
            $pager->paginate(intval($this->params['pindex']));
        else
            $pager->paginate(1);

        /* $rs = Doo::db()->query("SELECT t1.id,t1.adults,t1.child,t1.cantidad,t2.nombre AS grupo,t3.nombre AS parque, t1.company_name, t1.annio
          FROM admin_parques_tarifa t1
          LEFT JOIN grupo_parques t2 ON (t1.id_grupo = t2.id )
          LEFT JOIN parques t3 ON (t1.id_parque = t3.id)
          where type_rate = ? AND t1.$filtro like ?  order by t1.annio DESC limit $pager->limit ",
          array($type_rate, $texto.'%')); */
        if ($type_rate == 1) {
            $sql1 = "select apt.id, apt.cantidad, apt.adults, apt.child, apt.adults1, apt.child1, apt.annio, apt.fecha_ini, apt.fecha_fin, p.nombre as parque, gp.nombre as grupo
                        from admin_parques_tarifa as apt
                        left join parques as p on (apt.id_parque = p.id)
                        left join grupo_parques as gp on (apt.id_grupo = gp.id)
                     where apt.type_rate = ? and $filtro like ? order by apt.fecha_ini DESC, apt.fecha_fin DESC, apt.id_grupo ASC, p.nombre ASC, apt.cantidad limit $pager->limit";
            $q = Doo::db()->query($sql1, array($type_rate, $texto . '%'));
        } else if ($type_rate == 2) {
            $sql2 = "   select apt.id, apt.cantidad , apt.adults, apt.child,apt.adults1, apt.child1, apt.annio, apt.fecha_ini, apt.fecha_fin,p.nombre as parque, gp.nombre as grupo, a.company_name
                        from admin_parques_tarifa as apt
                        left join parques as p on (apt.id_parque = p.id)
                        left join grupo_parques as gp on (apt.id_grupo = gp.id)
                        left join agencia as a on (apt.id_agency = a.id)
                     where apt.type_rate = 2 and $filtro like ? order by  apt.fecha_ini DESC, apt.fecha_fin DESC, apt.id_grupo ASC, p.nombre ASC, apt.cantidad limit $pager->limit";
            $q = Doo::db()->query($sql2, array($type_rate, $texto . '%'));
        }

        $admin_rates = $q->fetchAll();
        $this->data['type_rate'] = $type_rate;
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['content'] = 'configuracion/admin_rates.php';
        $this->data['filtro'] = $filtro;
        $this->data['texto'] = $texto;
        $this->data['type_rate'] = $type_rate;
        $this->data['admin_rates'] = $admin_rates;
        $this->data['pager'] = $pager->output;
        $this->renderc('admin/index', $this->data, true);
    }

    public function add() {
        Doo::loadModel("Admision_rates");
        $admision_rates = new Admision_rates();

        if (!isset($_POST["type_rate"])) {
            if (!isset($this->params['type_rate'])) {
                $type_rate = "1";
            } else {
                $type_rate = $this->params['type_rate'];
            }
        } else {
            $type_rate = $_POST["type_rate"];
        }
        $admision_rates->type_rate = $type_rate;
        $admision_rates->id_agency = -1;
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['type_rate'] = $type_rate;
        $this->data['admision_rates'] = Doo::db()->find($admision_rates, array('limit' => 1));
        $this->data['grupos'] = Doo::db()->find("Grupo_parque", array("asArray" => true));
        $this->data['parques'] = Doo::db()->find("Parques", array("asArray" => true));
        $this->data['admision_rates'] = $admision_rates;
        $this->data['content'] = 'configuracion/frm_admin_rates.php';
        $this->data['dato'] = "New";
        $this->renderc('admin/index', $this->data);
    }

    public function save() {
        Doo::loadModel("Admision_rates");
        //$admision_rates = new Admision_rates($_POST);
        //
        //actualizacion marzo 2016////////////////////////////////////////////////

        $annios = $_POST['annio'];

        $nuevoannio = strtotime('+1 year', strtotime($annios));

        $nuevaannio1 = date('Y', $nuevoannio);



        //////////////////////////////////////////////////////////////////////////

        $admision_rates = new Admision_rates();

        $fecha_ini = $_POST['fecha_ini'];
        $fecha_fin = $_POST['fecha_fin'];




        if (isset($admision_rates->fecha_ini)) {
            list($mes, $dia, $anyo) = explode("-", $admision_rates->fecha_ini);
            $fecha_ini = $mes . "-" . $dia . "-" . $anyo;
            $admision_rates->fecha_ini = strtotime($fecha_ini);
        } 
        
        if (isset($admision_rates->fecha_fin)) {
            list($mes2, $dia2, $anyo2) = explode("-", $admision_rates->fecha_fin);
            $fecha_fin = $mes2 . "-" . $dia2 . "-" . $anyo2;
            $admision_rates->fecha_fin = strtotime($fecha_fin);
        }
        /////////////////////////////////////////////////////////////////////////



        $admision_rates->id_agency = $_POST['id_agency'];
        $admision_rates->id_grupo = $_POST['id_grupo'];
        $admision_rates->id_parque = $_POST['id_parque'];
        $admision_rates->cantidad = $_POST['cantidad'];
        $admision_rates->annio = $nuevoannio1 . '-00-00 00:00:00'; ///////actualizacion marzo 2016
        $admision_rates->fecha_ini = strtotime($fecha_nueva);
        $admision_rates->fecha_fin = strtotime($fecha_fin);


        if ($admision_rates->id_agency == -1) { //cuando es -1 es por que se estarna cogiendo los costos reales.
            $type_rate = 1;
        } else {
            $type_rate = 2;
        }

        $admision_rates = Doo::db()->find($admision_rates, array("limit", 1));
        if (empty($admision_rates)) {

            $admision_rates = new Admision_rates($_POST);
            $admision_rates->type_rate = $type_rate;
            $admision_rates->annio = $nuevoannio1 . '-00-00 00:00:00'; ////actualizacion marzo 2016
            $admision_rates->fecha_ini = strtotime($fecha_ini);
            $admision_rates->fecha_fin = strtotime($fecha_fin);

            $admision_rates->id = Null;
            $new = true;
            Doo::db()->insert($admision_rates);
        } else {

            $admision_rates = new Admision_rates($admision_rates[0]);
            $admision_rates->type_rate = $type_rate;
            $admision_rates->adults = $_POST['adults'];
            $admision_rates->child = $_POST['child'];
            $admision_rates->adult1 = $_POST['adult1'];
            $admision_rates->child1 = $_POST['child1'];
            $admision_rates->annio = $nuevoannio1 . '-00-00 00:00:00'; ////////actualizacion marzo 2016
            $admision_rates->fecha_ini = strtotime($fecha_ini);
            $admision_rates->fecha_fin = strtotime($fecha_fin);
            Doo::db()->update($admision_rates);
        }
        return Doo::conf()->APP_URL . "admin/tours/admision-rate/" . $type_rate;
    }

    public function edit() {
        Doo::loadModel("Admision_rates");
        $admision_rates = new Admision_rates();
        $admision_rates->id = $this->params["pindex"];
        $admision_rates = Doo::db()->find($admision_rates, array('limit' => 1));
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['admision_rates'] = $admision_rates;
        $this->data['grupos'] = Doo::db()->find("Grupo_parque", array("asArray" => true));
        $this->data['parques'] = Doo::db()->find("Parques", array("asArray" => true));
        $this->data['content'] = 'configuracion/frm_admin_rates.php';
        $this->data['dato'] = "edit";
        $this->view()->renderc('admin/index', $this->data);
    }

    public function delete() {
        Doo::loadModel("Admision_rates");
        $admision_rates = new Admision_rates();
        $admision_rates->id = $_REQUEST['item'];
        $admision_rates = Doo::db()->find($admision_rates, array('limit' => 1));
        Doo::db()->delete($admision_rates);
        return Doo::conf()->APP_URL . "admin/tours/admision-rate/" . $admision_rates->type_rate;
    }

///////////////////actualizacion marzo 2016///////////////////////////////////////////////////////////////////

    /*
      public function list_admincost(){
      Doo::loadHelper('DooPager');
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
      $texto = $this->params['texto'].'%';
      }
      } else {
      $texto = $_POST["texto"].'%';
      }



      $sql0 = "SELECT count(*) as total FROM admin_parques_tarifa as apt left join grupo_parques as gp on (apt.id_grupo = gp.id) left join parques as p on (apt.id_parque = p.id) where type_rate = -1 and $filtro like '%$texto'";
      $q0 = Doo::db()->query($sql0);
      $rs  = $q0->fetchAll();
      $total = $rs[0]['total'];
      if ($total == 0)
      $total = 1;
      // iniciamos el paginador

      $stext = (trim($texto) == '')? '%':'%'.$texto;

      $pager = new DooPager(Doo::conf()->APP_URL."admin/tours/admision-cost/$filtro/$texto/page", $total, 10, 5);

      $sql = "SELECT gp.nombre as grupo, IFNULL(p.nombre,'') as parque,apt.id, apt.cantidad, apt.adults, apt.child, apt.annio, apt.fecha_ini, apt.fecha_fin FROM admin_parques_tarifa as apt left join grupo_parques as gp on (apt.id_grupo = gp.id) left join parques as p on (apt.id_parque = p.id) where type_rate = -1 and $filtro like ? order by apt.annio DESC";
      $q = Doo::db()->query($sql,array($stext));
      $rs = $q->fetchAll();
      if(isset($this->params['pindex']))
      $pager->paginate(intval($this->params['pindex']));
      else
      $pager->paginate(1);
      $this->data['pager']   = $pager->output;
      $this->data['filtro'] = $filtro;
      $this->data['texto'] = substr($texto,0,-1);
      $this->data['admin_rates'] = $rs;
      $this->data['rootUrl'] = Doo::conf()->APP_URL;
      $this->data['content'] = 'configuracion/admin_cost.php';
      $this->view()->renderc('admin/index',$this->data,true);
      }

      public function addadmincost(){
      Doo::loadModel("Admision_rates");
      $admision_rates = new Admision_rates();
      $admision_rates->type_rate = -1; //type_rate -1 para costos reales de tiquetes
      $admision_rates->id_agency = -1;
      $admision_rates->id = -1;
      $this->data['rootUrl']     = Doo::conf()->APP_URL;
      $this->data['grupos']       = Doo::db()->find("Grupo_parque", array("asArray" => true));
      $this->data['parques']       = Doo::db()->find("Parques", array("asArray" => true));
      $this->data['admision_rates']        = $admision_rates;
      $this->data['content'] = 'configuracion/frm_admin_cost.php';
      $this->data['dato'] = "New";
      $this->renderc('admin/index', $this->data);
      }

      public function editadmincost(){
      $id = $this->params['id'];
      Doo::loadModel("Admision_rates");
      $admision_rates = new Admision_rates();
      $admision_rates->id = $id;
      $admision_rates->type_rate = -1; //type_rate -1 para costos reales de tiquetes
      $admision_rates->id_agency = -1;
      $admision_rates = Doo::db()->getOne($admision_rates);
      $this->data['rootUrl']     = Doo::conf()->APP_URL;
      $this->data['grupos']       = Doo::db()->find("Grupo_parque", array("asArray" => true));
      $this->data['parques']       = Doo::db()->find("Parques", array("asArray" => true));
      $this->data['admision_rates']        = $admision_rates;
      $this->data['content'] = 'configuracion/frm_admin_cost.php';
      $this->data['dato'] = "New";
      $this->renderc('admin/index', $this->data);
      }



      public function saveadmincost(){
      Doo::loadModel("Admision_rates");
      $cost_admision = new Admision_rates();
      $cost_admision->type_rate = -1;
      $cost_admision->id_agency = -1;
      $cost_admision->id_parque = $_POST['id_parque'];
      $cost_admision->id_grupo = $_POST['id_grupo'];
      $cost_admision->cantidad = $_POST['cantidad'];
      $cost_admision->adults = $_POST['adults'];
      $cost_admision->child = $_POST['child'];
      $cost_admision->annio = $_POST['annio'].'-01-01 00:00:00';
      $cost_admision->fecha_ini = $_POST['fecha_ini'].date('Y-m-d');
      $cost_admision->fecha_fin = $_POST['fecha_fin'].date('Y-m-d');
      if($_POST['id'] == -1){
      $cost_admision->insert();
      }else{
      $cost_admision->id = $_POST['id'];
      $cost_admision->update();
      }
      return Doo::conf()->APP_URL.'admin/tours/admision-cost';
      }

      public function deleteadmincost(){
      $id = $this->params['id'];
      $sql = "delete from admin_parques_tarifa where id = ?";
      $q = Doo::db()->query($sql,array($id));
      return Doo::conf()->APP_URL.'admin/tours/admision-cost';
      } */
}

?>

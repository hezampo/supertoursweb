<?php

/**
 * Description of AgencyController
 *
 * @Angel Valencia.
 */
Doo::loadController('I18nController');

class AgencyController extends I18nController {

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

        $rs = Doo::db()->find("Agency", array("select" => "COUNT(*) AS total",
            "where" => "$filtro like ?",
            "limit" => 1,
            "param" => array($texto . '%')
        ));
        $total = $rs->total;

        if ($total == 0)
            $total = 1;
        // iniciamos el paginador

        $pager = new DooPager(Doo::conf()->APP_URL . "admin/agency/$filtro/$texto/page", $total, 10, 5);

        if (isset($this->params['pindex']))
            $pager->paginate(intval($this->params['pindex']));
        else
            $pager->paginate(1);

        $rs = Doo::db()->query("SELECT  id,company_name,address,city,state,zipcode,country,manager,phone1,main_email,zipcode,type_rate,precio_especial_exten
                   					FROM agencia
										 where $filtro like ? order by id limit $pager->limit ", array('%' . $texto . '%'));

        $clientes = $rs->fetchAll();

        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['content'] = 'configuracion/agency.php';
        $this->data['filtro'] = $filtro;
        $this->data['texto'] = $texto;
        $this->data['clientes'] = $clientes;
        $this->data['pager'] = $pager->output;
        $this->renderc('admin/index', $this->data, true);
    }

    public function vistas() {
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['content'] = 'configuracion/frm_agency.php';
        $this->renderc('admin/index', $this->data, true);
    }

    public function add() {

        Doo::loadModel("Agency");
        $agency = new Agency();

        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['agency'] = $agency->fetch();
        $this->data['state'] = Doo::db()->find("State", array("select name from State", "asArray" => true));
        $this->data['country'] = Doo::db()->find("Country", array("select name from Country", "asArray" => true));
        $this->data['content'] = 'configuracion/frm_agency.php';
        $this->data['dato'] = "New";
        $this->renderc('admin/index', $this->data);
    }

    public function save() {

        //Doo::loadModel("Agency");
        //$agency = new Agency($_POST);

        extract($_POST, EXTR_SKIP);


        if (!isset($opcion1)) {
            $opcion1 = 0;
        }
        if (!isset($opcion2)) {
            $opcion2 = 0;
        }
        if (!isset($opcion3)) {
            $opcion3 = 0;
        }
        if (!isset($opcion4)) {
            $opcion4 = 0;
        }
        if (!isset($opcion5)) {
            $opcion5 = 0;
        }



        $new = false;

        if ($_POST['id'] == "") {

            $new = true;
        }

        $this->data['rootUrl'] = Doo::conf()->APP_URL;

        if ($new) {
            Doo::db()->query("INSERT INTO agencia (company_name,address,city,state,zipcode,main_email,country,manager,birthdate,position,phone1,
             phone2,fax,web_page,iata_clia,type_rate,precio_especial_exten,customer_since)
			 
      VALUES ('$company_name', '$address', '$city','$state', '$zipcode','$main_email','$country','$manager','$birthdate','$position',
        '$phone1','$phone2','$fax','$web_page','$iata_clia','$type_rate','$precio_especial_exten','$customer_since')");


            $id = Doo::db()->lastInsertId();


            Doo::db()->query("INSERT INTO agency_account (id_agencia,person_charge,eemail,phone,acount,opcion1,opcion2,opcion3,opcion4,opcion5)
         VALUES ('$id','$person_charge','$main_email','$phone','$acount','$opcion1','$opcion2','$opcion3','$opcion4',
        '$opcion5')");
        } else {
            $id = $_POST['id'];
            Doo::db()->query("UPDATE agencia
SET 
  company_name = '$company_name',
  address = '$address',
  city = '$city',
  state = '$state',
  zipcode = '$zipcode',
  country = '$country',
  manager = '$manager',
  birthdate = '$birthdate',
  POSITION = '$position',
  phone1 = '$phone1',
  phone2 = '$phone2',
  fax = '$fax',
  web_page = '$web_page',
  iata_clia = '$iata_clia',
  type_rate = '$type_rate',
  precio_especial_exten = '$precio_especial_exten',
  customer_since = '$customer_since'

WHERE id = $id ");

            Doo::db()->query("UPDATE agency_account
SET 
  
  person_charge = '$person_charge',
  eemail = '$eemail',
  phone = '$phone',
  acount = '$acount',
  opcion1 = '$opcion1',
  opcion2 = '$opcion2',
  opcion3 = '$opcion3',
  opcion4 = '$opcion4',
  opcion5 = '$opcion5'
WHERE id_agencia = '$id'");
        }
        return Doo::conf()->APP_URL . "admin/agency";
    }

    public function edit() {

        $id = $this->params["pindex"];
        $this->data['rootUrl'] = Doo::conf()->APP_URL;

        $rs = Doo::db()->query("SELECT  t1.id,t1.company_name,t1.address,t1.city,state,t1.zipcode,t1.main_email,t1.country,t1.manager,t1.birthdate,
						t1.position,t1.phone1,t1.phone2,t1.fax,t1.web_page,t1.iata_clia,t1.customer_since,
						t2.acount,t2.eemail,t2.opcion1,t2.opcion2,t2.opcion3,t2.opcion4,t2.opcion5,t2.person_charge,t2.phone,t1.type_rate,t1.precio_especial_exten
	          					FROM agencia t1 
							 LEFT JOIN agency_account t2 ON (t1.id = t2.id_agencia)	
										
										WHERE t1.id = ?", array($id));

        $agencia = $rs->fetch();

        $this->data['agency'] = $agencia;
        $this->data['state'] = Doo::db()->find("State", array("select name from State", "asArray" => true));
        $this->data['country'] = Doo::db()->find("Country", array("select name from Country", "asArray" => true));
        $this->data['content'] = 'configuracion/frm_agency.php';
        $this->data['dato'] = "edit";
        $this->view()->renderc('admin/index', $this->data);
    }

    public function delete() {

        $id = $_REQUEST['item'];
        $rs = Doo::db()->query("DELETE
								  FROM agencia
								  WHERE id = ? ", array($id));

        $rs = Doo::db()->query("DELETE
							     FROM agency_account
							     WHERE id_agencia = ? ", array($id));


        return Doo::conf()->APP_URL . "admin/agency";
    }

    public function code() {

        $code = rand(0, 9) . rand(0, 9) . rand(0, 9) . rand(0, 9);

        echo "<script>$('#voucher_code').val('$code');</script>";
    }

    public function searchagency() {
        $term = $_GET['term'];
        if (trim($term) == "") {
            $term = "%";
        } else {
            $term = '%' . $term . '%';
        }
        $sql = 'select a.company_name as label,a.id from agencia as a where a.company_name like ? limit 6';
        $q = Doo::db()->query($sql, array($term));
        $rs = $q->fetchAll();
        /* $salida = array();
          foreach($rs as $r){
          array_push($salida,$r['label']);
          }
          echo json_encode($salida); */
        echo json_encode($rs);
    }

}

?>

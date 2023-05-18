<?php

/**
 * Description of RatesroomController
 *
 * @author Angel Valencia.
 */
Doo::loadController('I18nController');

class RatesroomController extends I18nController {

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
     									  t1.qua,t1.resortprice,t1.brackfast,t2.nombre,type_rate
      									 FROM ratesvalid t1
										 LEFT JOIN hoteles t2 ON (t1.id_hotel = t2.id)
                                where type_rate = ? and t1.fecha_ini >= $ano $filtro order by t1.id) as result";
        $qset = Doo::db()->query($sql, array($type_rate));
        $rs = $qset->fetchAll();
        $total = $rs[0]['total'];

        if ($total == 0)
            $total = 1;
        // iniciamos el paginador

        $pager = new DooPager(Doo::conf()->APP_URL . "admin/tours/room-rates/$fi/$texto/$type_rate/page", $total, 10, 5);

        if (isset($this->params['pindex']))
            $pager->paginate(intval($this->params['pindex']));
        else
            $pager->paginate(1);

        $rs = Doo::db()->query("SELECT t1.id,t1.id_hotel,t1.fecha_ini,t1.fecha_fin, t1.sgl, t1.dbl, t1.tpl,
     									    t1.qua,t1.resortprice,t1.brackfast,t2.nombre,type_rate
      									    FROM ratesvalid t1
                                                                            LEFT JOIN hoteles t2 ON (t1.id_hotel = t2.id)
                                where type_rate = ? and t1.fecha_ini >= $ano $filtro order by t1.id desc limit $pager->limit  ", array($type_rate));

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
        $this->data['content'] = 'configuracion/roomrates.php';
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
        $this->data['content'] = 'configuracion/frm_rrates.php';
        $this->data['dato'] = "New";
        $this->renderc('admin/index', $this->data);
    }

    public function save() {

        Doo::loadModel("Ratesroom");

       $ratesroom = new Ratesroom($_POST);

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

                $id = Doo::db()->lastInsertId();



                $sgltax = ((($porcentajes['tax'] / 100) * $ratesroom->sgl) + ($ratesroom->sgl));
                $dbltax = ((($porcentajes['tax'] / 100) * $ratesroom->dbl) + ($ratesroom->dbl));
                $tpltax = ((($porcentajes['tax'] / 100) * $ratesroom->tpl) + ($ratesroom->tpl));
                $quatax = ((($porcentajes['tax'] / 100) * $ratesroom->qua) + ($ratesroom->qua));

                #division por tipo de habitacion
                $sqlt = ceil($sgltax / 1);
                $dblt = ceil($dbltax / 2);
                $tplt = ceil($tpltax / 3);
                $quat = ceil($quatax / 4);

                $desayunotax = ((($porcentajes['tax'] / 100) * $ratesroom->brackfast) + ($ratesroom->brackfast));

                Doo::db()->query("INSERT INTO comifijas
                       (id_hotel,sgl,dbl,tpl,qua,costax,netax,comtax,id_ratesvalid,breackfast,fecha_ini,fecha_fin)
            VALUES ('$ratesroom->id_hotel','$sqlt','$dblt','$tplt','$quat','1','0','0','$id','$desayunotax','$ratesroom->fecha_ini','$ratesroom->fecha_fin');");





                $sglsto = ($sgltax / (((100 - $porcentajes['stoproft']) / 100)));
                $dblsto = ($dbltax / ((100 - $porcentajes['stoproft']) / 100));
                $tplsto = ($tpltax / ((100 - $porcentajes['stoproft']) / 100));
                $quasto = ($quatax / ((100 - $porcentajes['stoproft']) / 100));

                #division por tipo de habitacion
                if ($ratesroom->resortprice != "" && $ratesroom->resortprice > 0) {
                    $desayuno_normal = $ratesroom->resortprice;
                } else {
                    $desayuno_normal = 0;
                }
                $sglstod = ($sglsto / 1) + $desayuno_normal;
                $dblstod = ($dblsto / 2) + $desayuno_normal;
                $tplstod = ($tplsto / 3) + $desayuno_normal;
                $quastod = ($quasto / 4) + $desayuno_normal;


                $desayunosto = ceil(($porcentajes['stoproft'] / 100) * $ratesroom->brackfast + $desayunotax);

                Doo::db()->query("INSERT INTO comifijas
                       (id_hotel,sgl,dbl,tpl,qua,costax,netax,comtax,id_ratesvalid,breackfast,fecha_ini,fecha_fin)
            VALUES ('$ratesroom->id_hotel','$sglstod','$dblstod','$tplstod','$quastod','0','1','0','$id','$desayunosto','$ratesroom->fecha_ini','$ratesroom->fecha_fin');");

                $variable = (100 - $porcentajes['maximo']) / 100;

                $sglmaximo = (($sglsto / $variable));
                $dblmaximo = (($dblsto / $variable));
                $tplmaximo = (($tplsto / $variable));
                $quamaximo = (($quasto / $variable));

                $sqlm = ($sglmaximo / 1) + $desayuno_normal;
                $dblm = ($dblmaximo / 2) + $desayuno_normal;
                $tplm = ($tplmaximo / 3) + $desayuno_normal;
                $quam = ($quamaximo / 4) + $desayuno_normal;

                //echo $dblmaximo;
                $desayunomaxi = ceil($desayunosto / $variable);
                Doo::db()->query("INSERT INTO comifijas
                       (id_hotel,sgl,dbl,tpl,qua,costax,netax,comtax,id_ratesvalid,breackfast,fecha_ini,fecha_fin)
            VALUES ('$ratesroom->id_hotel','$sqlm','$dblm','$tplm','$quam','0','0','1','$id','$desayunomaxi','$ratesroom->fecha_ini','$ratesroom->fecha_fin');");

                Doo::db()->commit();
            } catch (Exception $exc) {
                Doo::db()->rollBack();
                //echo $exc->getTraceAsString();
                return Doo::conf()->APP_URL . "admin/tours/room-rates/add/?menssage='error'";
            }
            return Doo::conf()->APP_URL . "admin/tours/room-rates/edit/$id?menssage=ok";
        } else {
            try {
                Doo::db()->beginTransaction();

                Doo::db()->update($ratesroom);

                $rs = Doo::db()->query("SELECT  id
							FROM ratesvalid 
							 where id = '$ratesroom->id'");

                $dato = $rs->fetch();
                $id = $dato['id'];
                $borrado = Doo::db()->query("DELETE FROM  comifijas
								WHERE id_hotel = '$ratesroom->id_hotel' and id_ratesvalid = $id");

                if ($borrado) {



                    $sgltax = ((($porcentajes['tax'] / 100) * $ratesroom->sgl) + ($ratesroom->sgl));
                    $dbltax = ((($porcentajes['tax'] / 100) * $ratesroom->dbl) + ($ratesroom->dbl));
                    $tpltax = ((($porcentajes['tax'] / 100) * $ratesroom->tpl) + ($ratesroom->tpl));
                    $quatax = ((($porcentajes['tax'] / 100) * $ratesroom->qua) + ($ratesroom->qua));

                    #division por tipo de habitacion
                    $sqlt = ceil($sgltax / 1); 
                    $dblt = ceil($dbltax / 2);
                    $tplt = ceil($tpltax / 3);
                    $quat = ceil($quatax / 4);

                    $desayunotax = ((($porcentajes['tax'] / 100) * $ratesroom->brackfast) + ($ratesroom->brackfast));

                    Doo::db()->query("INSERT INTO comifijas
                       (id_hotel,sgl,dbl,tpl,qua,costax,netax,comtax,id_ratesvalid,breackfast,fecha_ini,fecha_fin)
            VALUES ('$ratesroom->id_hotel','$sqlt','$dblt','$tplt','$quat','1','0','0','$id','$desayunotax','$ratesroom->fecha_ini','$ratesroom->fecha_fin');");





                    $sglsto = ($sgltax / (((100 - $porcentajes['stoproft']) / 100)));
                    $dblsto = ($dbltax / ((100 - $porcentajes['stoproft']) / 100));
                    $tplsto = ($tpltax / ((100 - $porcentajes['stoproft']) / 100));
                    $quasto = ($quatax / ((100 - $porcentajes['stoproft']) / 100));

                    #divicion por tipo de habitacion 
                    # PHP_ROUND_UP echo round(9.5, 0, PHP_ROUND_HALF_UP);   // 10
                    if ($ratesroom->resortprice != "" && $ratesroom->resortprice > 0) {
                        $desayuno_normal = $ratesroom->resortprice;
                    } else {
                        $desayuno_normal = 0;
                    }
                    
                    $sglstod = ($sglsto / 1) + $desayuno_normal; //
                    $dblstod = ($dblsto / 2) + $desayuno_normal;
                    $tplstod = ($tplsto / 3) + $desayuno_normal;
                    $quastod = ($quasto / 4) + $desayuno_normal;


                    $desayunosto = ceil(($porcentajes['stoproft'] / 100) * $ratesroom->brackfast + $desayunotax);

                    Doo::db()->query("INSERT INTO comifijas
                       (id_hotel,sgl,dbl,tpl,qua,costax,netax,comtax,id_ratesvalid,breackfast,fecha_ini,fecha_fin)
            VALUES ('$ratesroom->id_hotel','$sglstod','$dblstod','$tplstod','$quastod','0','1','0','$id','$desayunosto','$ratesroom->fecha_ini','$ratesroom->fecha_fin');");

                    $variable = (100 - $porcentajes['maximo']) / 100;
                    
                    $sglmaximo = (($sglsto / $variable));
                    $dblmaximo = (($dblsto / $variable));
                    $tplmaximo = (($tplsto / $variable));
                    $quamaximo = (($quasto / $variable));
                    $desayuno_normal_mas_comi = (($desayuno_normal / $variable));
                    
                    $sqlm = ($sglmaximo / 1) + $desayuno_normal_mas_comi;
                    $dblm = ($dblmaximo / 2) + $desayuno_normal_mas_comi;
                    $tplm = ($tplmaximo / 3) + $desayuno_normal_mas_comi;
                    $quam = ($quamaximo / 4) + $desayuno_normal_mas_comi;
                    
//                    print_r((($porcentajes['tax'] / 100) * $ratesroom->sgl));
//                    echo "<br>";
//                    print_r($dblt);
//                    echo "<br>";
//                    print_r($dblsto);
//                    echo "<br>";
//                    print_r($dblmaximo);
//                    echo "<br>";
//                    print_r($dblm);
//                    echo "<br>";
//                    exit;
//                    echo $dblmaximo;
                    $desayunomaxi = ceil($desayunosto / $variable);
                    Doo::db()->query("INSERT INTO comifijas
                       (id_hotel,sgl,dbl,tpl,qua,costax,netax,comtax,id_ratesvalid,breackfast,fecha_ini,fecha_fin)
            VALUES ('$ratesroom->id_hotel','$sqlm','$dblm','$tplm','$quam','0','0','1','$id','$desayunomaxi','$ratesroom->fecha_ini','$ratesroom->fecha_fin');");
                }


                Doo::db()->commit();
            } catch (Exception $exc) {
                Doo::db()->rollBack();
                return Doo::conf()->APP_URL . "admin/tours/room-rates/edit/$id?menssage='error'";
            }
        }
        return Doo::conf()->APP_URL . "admin/tours/room-rates/edit/$id?menssage=ok";
    }

    public function edit() {
        Doo::loadModel("Ratesroom");
        $ratesroom = new Ratesroom();
        $ratesroom->id = $this->params["pindex"];
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['ratesroom'] = Doo::db()->find($ratesroom, array('limit' => 1));
        $this->data['hotel'] = Doo::db()->find("Hoteles", array("select id,nombre from hoteles", "asArray" => true));
        $this->data['content'] = 'configuracion/frm_rrates.php';
        $this->data['dato'] = "edit";
        $this->view()->renderc('admin/index', $this->data);
    }

    public function delete() {
        Doo::loadModel("Ratesroom");
        $ratesroom = new Ratesroom();
        $ratesroom->id = $_REQUEST['item'];
        Doo::db()->delete($ratesroom);

        Doo::db()->query("DELETE FROM  comifijas
								WHERE id_ratesvalid = $ratesroom->id");
        return Doo::conf()->APP_URL . "admin/tours/room-rates";
    }

}

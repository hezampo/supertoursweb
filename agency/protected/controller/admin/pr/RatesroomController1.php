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
        $sql = "select count(*) as total  from (SELECT t1.id,t1.id_hotel,t1.fecha_ini,t1.fecha_fin,t2.nombre,type_rate
      									 FROM ratesvalid t1
										 LEFT JOIN hoteles t2 ON (t1.id_hotel = t2.id)
                                where type_rate = ? and t1.fecha_ini >= $ano $filtro order by t1.rate asc) as result";
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

        $rs = Doo::db()->query("SELECT t1.id,t1.id_hotel,t1.fecha_ini,t1.fecha_fin,t1.rate,type_rate
      									 FROM ratesvalid t1
										 LEFT JOIN hoteles t2 ON (t1.id_hotel = t2.id)
                                where type_rate = ? and t1.fecha_ini >= $ano $filtro order by t1.rate asc limit $pager->limit  ", array($type_rate));

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
        Doo::loadModel("Tarifastrip");    
        $ratesroom = new Ratesroom();         
        $tarifastrip = new Tarifastrip();

        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['ratesroom'] = $ratesroom;
        $this->data['Tarifastrip'] = $tarifastrip;
        $this->data['hotel'] = Doo::db()->find("Hoteles", array("select id,nombre from hoteles", "asArray" => true));
        $this->data['content'] = 'configuracion/frm_rrates.php';
        $this->data['dato'] = "New";
        $this->renderc('admin/index', $this->data);
    }

    public function save() {

        Doo::loadModel("Ratesroom");
        Doo::loadModel("Tarifastrip");

        $ratesroom = new Ratesroom($_POST);
        $tarifastrip = new Tarifastrip();



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

                Doo::db()->insert($tarifastrip);
                
                $id = Doo::db()->lastInsertId();
                
                
                



//                $sgltax = ((($porcentajes['tax'] / 100) * $ratesroom->sglm) + ($ratesroom->sglm));
//                $dbltax = ((($porcentajes['tax'] / 100) * $ratesroom->dblm) + ($ratesroom->dblm));
//                $tpltax = ((($porcentajes['tax'] / 100) * $ratesroom->tplm) + ($ratesroom->tplm));
//                $quatax = ((($porcentajes['tax'] / 100) * $ratesroom->quam) + ($ratesroom->quam));
                
                //VALUE
                $sgltax1 = $ratesroom->sgl;
                $dbltax1 = $ratesroom->dbl;
                $tpltax1 = $ratesroom->tpl;
                $quatax1 = $ratesroom->qua;
                
                $sgltax22 = $ratesroom->sgl2;
                $dbltax22 = $ratesroom->dbl2;
                $tpltax22 = $ratesroom->tpl2;
                $quatax22 = $ratesroom->qua2;
                
                $sgltax33 = $ratesroom->sgl3;
                $dbltax33 = $ratesroom->dbl3;
                $tpltax33 = $ratesroom->tpl3;
                $quatax33 = $ratesroom->qua3;
                
                $sgltax44 = $ratesroom->sgl4;
                $dbltax44 = $ratesroom->dbl4;
                $tpltax44 = $ratesroom->tpl4;
                $quatax44 = $ratesroom->qua4;
                
                $sgltax55 = $ratesroom->sgl5;
                $dbltax55 = $ratesroom->dbl5;
                $tpltax55 = $ratesroom->tpl5;
                $quatax55 = $ratesroom->qua5;
                
                $sgltax66 = $ratesroom->sgl6;
                $dbltax66 = $ratesroom->dbl6;
                $tpltax66 = $ratesroom->tpl6;
                $quatax66 = $ratesroom->qua6;
                
                $sgltax77 = $ratesroom->sgl7;
                $dbltax77 = $ratesroom->dbl7;
                $tpltax77 = $ratesroom->tpl7;
                $quatax77 = $ratesroom->qua7;
                
                $sgltax88 = $ratesroom->sgl8;
                $dbltax88 = $ratesroom->dbl8;
                $tpltax88 = $ratesroom->tpl8;
                $quatax88 = $ratesroom->qua8;
                
               
                
                //CHILDREN VALUE
                $chv21 = $ratesroom->chv21;
                $chv32 = $ratesroom->chv32;
                $chv43 = $ratesroom->chv43;
                $chv54 = $ratesroom->chv54;
                $chv65 = $ratesroom->chv65;
                $chv76 = $ratesroom->chv76;
                $chv87 = $ratesroom->chv87;
                $chv98 = $ratesroom->chv98;
                
                
                
                //CHILDREN MODERATE
                $chm21 = $ratesroom->chm21;
                $chm32 = $ratesroom->chm32;
                $chm43 = $ratesroom->chm43;
                $chm54 = $ratesroom->chm54;
                $chm65 = $ratesroom->chm65;
                $chm76 = $ratesroom->chm76;
                $chm87 = $ratesroom->chm87;
                $chm98 = $ratesroom->chm98;
                
                //FREEDAY ADULT
                $fdv_adult21 = $ratesroom->fdv_adult21;
                $fdv_child21 = $ratesroom->fdv_child21;
                $fdv_adult32 = $ratesroom->fdv_adult32;
                $fdv_child32 = $ratesroom->fdv_child32;
                $fdv_adult43 = $ratesroom->fdv_adult43;
                $fdv_child43 = $ratesroom->fdv_child43;
                $fdv_adult54 = $ratesroom->fdv_adult54;
                $fdv_child54 = $ratesroom->fdv_child54;
                $fdv_adult65 = $ratesroom->fdv_adult65;
                $fdv_child65 = $ratesroom->fdv_child65;
                $fdv_adult76 = $ratesroom->fdv_adult76;
                $fdv_child76 = $ratesroom->fdv_child76;
                $fdv_adult87 = $ratesroom->fdv_adult87;
                $fdv_child87 = $ratesroom->fdv_child87;
                $fdv_adult98 = $ratesroom->fdv_adult98;
                $fdv_child98 = $ratesroom->fdv_child98;
                
                $trip100 = $ratesroom->trip100;
                $trip200 = $ratesroom->trip200;
                $trip300 = $ratesroom->trip300;
                $trip101 = $ratesroom->trip101;
                $trip201 = $ratesroom->trip201;
                $trip301 = $ratesroom->trip301;
                $t_in = $ratesroom->t_in;
                $t_out = $ratesroom->t_out;
                $car_in = $ratesroom->car_in;
                $car_out = $ratesroom->car_out;
                $schv = $ratesroom->schv;
                $schm = $ratesroom->schm;
                
                
                
                //FREEDAY CHILDREN
                $fdm_adult21 = $ratesroom->fdm_adult21;
                $fdm_child21 = $ratesroom->fdm_child21;
                $fdm_adult32 = $ratesroom->fdm_adult32;
                $fdm_child32 = $ratesroom->fdm_child32;
                $fdm_adult43 = $ratesroom->fdm_adult43;
                $fdm_child43 = $ratesroom->fdm_child43;
                $fdm_adult54 = $ratesroom->fdm_adult54;
                $fdm_child54 = $ratesroom->fdm_child54;
                $fdm_adult65 = $ratesroom->fdm_adult65;
                $fdm_child65 = $ratesroom->fdm_child65;
                $fdm_adult76 = $ratesroom->fdm_adult76;
                $fdm_child76 = $ratesroom->fdm_child76;
                $fdm_adult87 = $ratesroom->fdm_adult87;
                $fdm_child87 = $ratesroom->fdm_child87;
                $fdm_adult98 = $ratesroom->fdm_adult98;
                $fdm_child98 = $ratesroom->fdm_child98;
                
                
                
                
                //MODERATE
                $sgltax = $ratesroom->sglm;
                $dbltax = $ratesroom->dblm;
                $tpltax = $ratesroom->tplm;
                $quatax = $ratesroom->quam;
                
                $sgltax2 = $ratesroom->sglm2;
                $dbltax2 = $ratesroom->dblm2;
                $tpltax2 = $ratesroom->tplm2;
                $quatax2 = $ratesroom->quam2;
                
                $sgltax3 = $ratesroom->sglm3;
                $dbltax3 = $ratesroom->dblm3;
                $tpltax3 = $ratesroom->tplm3;
                $quatax3 = $ratesroom->quam3;
                
                $sgltax4 = $ratesroom->sglm4;
                $dbltax4 = $ratesroom->dblm4;
                $tpltax4 = $ratesroom->tplm4;
                $quatax4 = $ratesroom->quam4;
                
                
                $sgltax5 = $ratesroom->sglm5;
                $dbltax5 = $ratesroom->dblm5;
                $tpltax5 = $ratesroom->tplm5;
                $quatax5 = $ratesroom->quam5;
                
                $sgltax6 = $ratesroom->sglm6;
                $dbltax6 = $ratesroom->dblm6;
                $tpltax6 = $ratesroom->tplm6;
                $quatax6 = $ratesroom->quam6;
                
                $sgltax7 = $ratesroom->sglm7;
                $dbltax7 = $ratesroom->dblm7;
                $tpltax7 = $ratesroom->tplm7;
                $quatax7 = $ratesroom->quam7;
                
                $sgltax8 = $ratesroom->sglm8;
                $dbltax8 = $ratesroom->dblm8;
                $tpltax8 = $ratesroom->tplm8;
                $quatax8 = $ratesroom->quam8;
                
                #divicion por tipo de habitacion
//                $sqlt = ceil($sgltax / 1);
//                $dblt = ceil($dbltax / 2);
//                $tplt = ceil($tpltax / 3);
//                $quat = ceil($quatax / 4);
                
                
                //VALUE
                
                $sqlt1 = $sgltax1;
                $dblt1 = $dbltax1;
                $tplt1 = $tpltax1;
                $quat1 = $quatax1;
                
                $sqlt22 = $sgltax22;
                $dblt22 = $dbltax22;
                $tplt22 = $tpltax22;
                $quat22 = $quatax22;
                
                $sqlt33 = $sgltax33;
                $dblt33 = $dbltax33;
                $tplt33 = $tpltax33;
                $quat33 = $quatax33;
                
                $sqlt44 = $sgltax44;
                $dblt44 = $dbltax44;
                $tplt44 = $tpltax44;
                $quat44 = $quatax44;
                
                $sqlt55 = $sgltax55;
                $dblt55 = $dbltax55;
                $tplt55 = $tpltax55;
                $quat55 = $quatax55;
                
                $sqlt66 = $sgltax66;
                $dblt66 = $dbltax66;
                $tplt66 = $tpltax66;
                $quat66 = $quatax66;
                
                $sqlt77 = $sgltax77;
                $dblt77 = $dbltax77;
                $tplt77 = $tpltax77;
                $quat77 = $quatax77;
                
                $sqlt88 = $sgltax88;
                $dblt88 = $dbltax88;
                $tplt88 = $tpltax88;
                $quat88 = $quatax88;
                
                //CHILDREN VALUE
                $chva21 = $chv21;
                $chva32 = $chv32;
                $chva43 = $chv43;
                $chva54 = $chv54;
                $chva65 = $chv65;
                $chva76 = $chv76;
                $chva87 = $chv87;
                $chva98 = $chv98;
                
                
                $frdv_adult21   = $fdv_adult21;
                $frdv_child21   = $fdv_child21;
                $frdv_adult32   = $fdv_adult32;
                $frdv_child32   = $fdv_child32;
                $frdv_adult43   = $fdv_adult43;
                $frdv_child43   = $fdv_child43;
                $frdv_adult54   = $fdv_adult54;
                $frdv_child54   = $fdv_child54;
                $frdv_adult65   = $fdv_adult65;
                $frdv_child65   = $fdv_child65;
                $frdv_adult76   = $fdv_adult76;
                $frdv_child76   = $fdv_child76;
                $frdv_adult87   = $fdv_adult87;
                $frdv_child87   = $fdv_child87;
                $frdv_adult98   = $fdv_adult98;
                $frdv_child98   = $fdv_child98;
                
                $trip_100  = $trip100;
                $trip_200  = $trip200;
                $trip_300  = $trip300;
                $trip_101  = $trip101;
                $trip_201  = $trip201;
                $trip_301  = $trip301;
                $tr_in     = $t_in;
                $tr_out    = $t_out;
                $tcar_in   = $car_in;
                $tcar_out  = $car_out;
                $sch_v     = $schv;
                $sch_m     = $schm;
                
                
                
                
                //CHILDREN MODERATE
                $chmo21 = $chm21;
                $chmo32 = $chm32;
                $chmo43 = $chm43;
                $chmo54 = $chm54;
                $chmo65 = $chm65;
                $chmo76 = $chm76;
                $chmo87 = $chm87;
                $chmo98 = $chm98;
                
                $frdm_adult21   = $fdm_adult21;
                $frdm_child21   = $fdm_child21;
                $frdm_adult32   = $fdm_adult32;
                $frdm_child32   = $fdm_child32;
                $frdm_adult43   = $fdm_adult43;
                $frdm_child43   = $fdm_child43;
                $frdm_adult54   = $fdm_adult54;
                $frdm_child54   = $fdm_child54;
                $frdm_adult65   = $fdm_adult65;
                $frdm_child65   = $fdm_child65;
                $frdm_adult76   = $fdm_adult76;
                $frdm_child76   = $fdm_child76;
                $frdm_adult87   = $fdm_adult87;
                $frdm_child87   = $fdm_child87;
                $frdm_adult98   = $fdm_adult98;
                $frdm_child98   = $fdm_child98;
                
                
                
                //MODERATE
                
                $sqlt = $sgltax;
                $dblt = $dbltax;
                $tplt = $tpltax;
                $quat = $quatax;
                
                $sqlt2 = $sgltax2;
                $dblt2 = $dbltax2;
                $tplt2 = $tpltax2;
                $quat2 = $quatax2;

                $sqlt3 = $sgltax3;
                $dblt3 = $dbltax3;
                $tplt3 = $tpltax3;
                $quat3 = $quatax3;
                
                $sqlt4 = $sgltax4;
                $dblt4 = $dbltax4;
                $tplt4 = $tpltax4;
                $quat4 = $quatax4;
                
                
                $sqlt5 = $sgltax5;
                $dblt5 = $dbltax5;
                $tplt5 = $tpltax5;
                $quat5 = $quatax5;

                $sqlt6 = $sgltax6;
                $dblt6 = $dbltax6;
                $tplt6 = $tpltax6;
                $quat6 = $quatax6;
                
                $sqlt7 = $sgltax7;
                $dblt7 = $dbltax7;
                $tplt7 = $tpltax7;
                $quat7 = $quatax7;
                
                $sqlt8 = $sgltax8;
                $dblt8 = $dbltax8;
                $tplt8 = $tpltax8;
                $quat8 = $quatax8;

                $desayunotax = ((($porcentajes['tax'] / 100) * $ratesroom->brackfast) + ($ratesroom->brackfast));
//                $tarif = $ratesroom->rate;
//                $rate_no = ($ratesroom->rate_no)+1;
                
               //VALUE
                
                Doo::db()->query("INSERT INTO comifijas
                       (id_hotel,sgl,dbl,tpl,qua,sgl2,dbl2,tpl2,qua2,sgl3,dbl3,tpl3,qua3,sgl4,dbl4,tpl4,qua4,sgl5,dbl5,tpl5,qua5,sgl6,dbl6,tpl6,qua6,sgl7,dbl7,tpl7,qua7,sgl8,dbl8,tpl8,qua8,chv21,chv32,chv43,chv54,chv65,chv76,chv87,chv98,costax,netax,comtax,id_ratesvalid,breackfast,fecha_ini,fecha_fin,fdv_adult21,fdv_child21,fdv_adult32,fdv_child32,fdv_adult43,fdv_child43,fdv_adult54,fdv_child54,fdv_adult65,fdv_child65,fdv_adult76,fdv_child76,fdv_adult87,fdv_child87,fdv_adult98,fdv_child98,trip100,trip200,trip300,trip101,trip201,trip301,t_in,t_out,car_in,car_out,schv,schm)
            VALUES ('27','$sqlt1','$dblt1','$tplt1','$quat1','$sqlt22','$dblt22','$tplt22','$quat22','$sqlt33','$dblt33','$tplt33','$quat33','$sqlt44','$dblt44','$tplt44','$quat44','$sqlt55','$dblt55','$tplt55','$quat55','$sqlt66','$dblt66','$tplt66','$quat66','$sqlt77','$dblt77','$tplt77','$quat77','$sqlt88','$dblt88','$tplt88','$quat88','$chva21','$chva32','$chva43','$chva54','$chva65','$chva76','$chva87','$chva98','0','0','1','$id','$desayunotax','$ratesroom->fecha_ini','$ratesroom->fecha_fin','$frdv_adult21','$frdv_child21','$frdv_adult32','$frdv_child32','$frdv_adult43','$frdv_child43','$frdv_adult54','$frdv_child54','$frdv_adult65','$frdv_child65','$frdv_adult76','$frdv_child76','$frdv_adult87','$frdv_child87','$frdv_adult98','$frdv_child98','$trip_100','$trip_200','$trip_300','$trip_101','$trip_201','$trip_301','$tr_in','$tr_out','$tcar_in','$tcar_out','$sch_v','$sch_m');");
                
                Doo::db()->query("INSERT INTO comifijas
                       (id_hotel,sgl,dbl,tpl,qua,sgl2,dbl2,tpl2,qua2,sgl3,dbl3,tpl3,qua3,sgl4,dbl4,tpl4,qua4,sgl5,dbl5,tpl5,qua5,sgl6,dbl6,tpl6,qua6,sgl7,dbl7,tpl7,qua7,sgl8,dbl8,tpl8,qua8,chv21,chv32,chv43,chv54,chv65,chv76,chv87,chv98,costax,netax,comtax,id_ratesvalid,breackfast,fecha_ini,fecha_fin,fdv_adult21,fdv_child21,fdv_adult32,fdv_child32,fdv_adult43,fdv_child43,fdv_adult54,fdv_child54,fdv_adult65,fdv_child65,fdv_adult76,fdv_child76,fdv_adult87,fdv_child87,fdv_adult98,fdv_child98,trip100,trip200,trip300,trip101,trip201,trip301,t_in,t_out,car_in,car_out,schv,schm)
            VALUES ('38','$sqlt1','$dblt1','$tplt1','$quat1','$sqlt22','$dblt22','$tplt22','$quat22','$sqlt33','$dblt33','$tplt33','$quat33','$sqlt44','$dblt44','$tplt44','$quat44','$sqlt55','$dblt55','$tplt55','$quat55','$sqlt66','$dblt66','$tplt66','$quat66','$sqlt77','$dblt77','$tplt77','$quat77','$sqlt88','$dblt88','$tplt88','$quat88','$chva21','$chva32','$chva43','$chva54','$chva65','$chva76','$chva87','$chva98','0','0','1','$id','$desayunotax','$ratesroom->fecha_ini','$ratesroom->fecha_fin','$frdv_adult21','$frdv_child21','$frdv_adult32','$frdv_child32','$frdv_adult43','$frdv_child43','$frdv_adult54','$frdv_child54','$frdv_adult65','$frdv_child65','$frdv_adult76','$frdv_child76','$frdv_adult87','$frdv_child87','$frdv_adult98','$frdv_child98','$trip_100','$trip_200','$trip_300','$trip_101','$trip_201','$trip_301','$tr_in','$tr_out','$tcar_in','$tcar_out','$sch_v','$sch_m');");
                
                Doo::db()->query("INSERT INTO comifijas
                       (id_hotel,sgl,dbl,tpl,qua,sgl2,dbl2,tpl2,qua2,sgl3,dbl3,tpl3,qua3,sgl4,dbl4,tpl4,qua4,sgl5,dbl5,tpl5,qua5,sgl6,dbl6,tpl6,qua6,sgl7,dbl7,tpl7,qua7,sgl8,dbl8,tpl8,qua8,chv21,chv32,chv43,chv54,chv65,chv76,chv87,chv98,costax,netax,comtax,id_ratesvalid,breackfast,fecha_ini,fecha_fin,fdv_adult21,fdv_child21,fdv_adult32,fdv_child32,fdv_adult43,fdv_child43,fdv_adult54,fdv_child54,fdv_adult65,fdv_child65,fdv_adult76,fdv_child76,fdv_adult87,fdv_child87,fdv_adult98,fdv_child98,trip100,trip200,trip300,trip101,trip201,trip301,t_in,t_out,car_in,car_out,schv,schm)
            VALUES ('39','$sqlt1','$dblt1','$tplt1','$quat1','$sqlt22','$dblt22','$tplt22','$quat22','$sqlt33','$dblt33','$tplt33','$quat33','$sqlt44','$dblt44','$tplt44','$quat44','$sqlt55','$dblt55','$tplt55','$quat55','$sqlt66','$dblt66','$tplt66','$quat66','$sqlt77','$dblt77','$tplt77','$quat77','$sqlt88','$dblt88','$tplt88','$quat88','$chva21','$chva32','$chva43','$chva54','$chva65','$chva76','$chva87','$chva98','0','0','1','$id','$desayunotax','$ratesroom->fecha_ini','$ratesroom->fecha_fin','$frdv_adult21','$frdv_child21','$frdv_adult32','$frdv_child32','$frdv_adult43','$frdv_child43','$frdv_adult54','$frdv_child54','$frdv_adult65','$frdv_child65','$frdv_adult76','$frdv_child76','$frdv_adult87','$frdv_child87','$frdv_adult98','$frdv_child98','$trip_100','$trip_200','$trip_300','$trip_101','$trip_201','$trip_301','$tr_in','$tr_out','$tcar_in','$tcar_out','$sch_v','$sch_m');");
                
                Doo::db()->query("INSERT INTO comifijas
                       (id_hotel,sgl,dbl,tpl,qua,sgl2,dbl2,tpl2,qua2,sgl3,dbl3,tpl3,qua3,sgl4,dbl4,tpl4,qua4,sgl5,dbl5,tpl5,qua5,sgl6,dbl6,tpl6,qua6,sgl7,dbl7,tpl7,qua7,sgl8,dbl8,tpl8,qua8,chv21,chv32,chv43,chv54,chv65,chv76,chv87,chv98,costax,netax,comtax,id_ratesvalid,breackfast,fecha_ini,fecha_fin,fdv_adult21,fdv_child21,fdv_adult32,fdv_child32,fdv_adult43,fdv_child43,fdv_adult54,fdv_child54,fdv_adult65,fdv_child65,fdv_adult76,fdv_child76,fdv_adult87,fdv_child87,fdv_adult98,fdv_child98,trip100,trip200,trip300,trip101,trip201,trip301,t_in,t_out,car_in,car_out,schv,schm)
            VALUES ('40','$sqlt1','$dblt1','$tplt1','$quat1','$sqlt22','$dblt22','$tplt22','$quat22','$sqlt33','$dblt33','$tplt33','$quat33','$sqlt44','$dblt44','$tplt44','$quat44','$sqlt55','$dblt55','$tplt55','$quat55','$sqlt66','$dblt66','$tplt66','$quat66','$sqlt77','$dblt77','$tplt77','$quat77','$sqlt88','$dblt88','$tplt88','$quat88','$chva21','$chva32','$chva43','$chva54','$chva65','$chva76','$chva87','$chva98','0','0','1','$id','$desayunotax','$ratesroom->fecha_ini','$ratesroom->fecha_fin','$frdv_adult21','$frdv_child21','$frdv_adult32','$frdv_child32','$frdv_adult43','$frdv_child43','$frdv_adult54','$frdv_child54','$frdv_adult65','$frdv_child65','$frdv_adult76','$frdv_child76','$frdv_adult87','$frdv_child87','$frdv_adult98','$frdv_child98','$trip_100','$trip_200','$trip_300','$trip_101','$trip_201','$trip_301','$tr_in','$tr_out','$tcar_in','$tcar_out','$sch_v','$sch_m');");
                
                Doo::db()->query("INSERT INTO comifijas
                       (id_hotel,sgl,dbl,tpl,qua,sgl2,dbl2,tpl2,qua2,sgl3,dbl3,tpl3,qua3,sgl4,dbl4,tpl4,qua4,sgl5,dbl5,tpl5,qua5,sgl6,dbl6,tpl6,qua6,sgl7,dbl7,tpl7,qua7,sgl8,dbl8,tpl8,qua8,chv21,chv32,chv43,chv54,chv65,chv76,chv87,chv98,costax,netax,comtax,id_ratesvalid,breackfast,fecha_ini,fecha_fin,fdv_adult21,fdv_child21,fdv_adult32,fdv_child32,fdv_adult43,fdv_child43,fdv_adult54,fdv_child54,fdv_adult65,fdv_child65,fdv_adult76,fdv_child76,fdv_adult87,fdv_child87,fdv_adult98,fdv_child98,trip100,trip200,trip300,trip101,trip201,trip301,t_in,t_out,car_in,car_out,schv,schm)
            VALUES ('43','$sqlt1','$dblt1','$tplt1','$quat1','$sqlt22','$dblt22','$tplt22','$quat22','$sqlt33','$dblt33','$tplt33','$quat33','$sqlt44','$dblt44','$tplt44','$quat44','$sqlt55','$dblt55','$tplt55','$quat55','$sqlt66','$dblt66','$tplt66','$quat66','$sqlt77','$dblt77','$tplt77','$quat77','$sqlt88','$dblt88','$tplt88','$quat88','$chva21','$chva32','$chva43','$chva54','$chva65','$chva76','$chva87','$chva98','0','0','1','$id','$desayunotax','$ratesroom->fecha_ini','$ratesroom->fecha_fin','$frdv_adult21','$frdv_child21','$frdv_adult32','$frdv_child32','$frdv_adult43','$frdv_child43','$frdv_adult54','$frdv_child54','$frdv_adult65','$frdv_child65','$frdv_adult76','$frdv_child76','$frdv_adult87','$frdv_child87','$frdv_adult98','$frdv_child98','$trip_100','$trip_200','$trip_300','$trip_101','$trip_201','$trip_301','$tr_in','$tr_out','$tcar_in','$tcar_out','$sch_v','$sch_m');");
               
                Doo::db()->query("INSERT INTO comifijas
                       (id_hotel,sgl,dbl,tpl,qua,sgl2,dbl2,tpl2,qua2,sgl3,dbl3,tpl3,qua3,sgl4,dbl4,tpl4,qua4,sgl5,dbl5,tpl5,qua5,sgl6,dbl6,tpl6,qua6,sgl7,dbl7,tpl7,qua7,sgl8,dbl8,tpl8,qua8,chv21,chv32,chv43,chv54,chv65,chv76,chv87,chv98,costax,netax,comtax,id_ratesvalid,breackfast,fecha_ini,fecha_fin,fdv_adult21,fdv_child21,fdv_adult32,fdv_child32,fdv_adult43,fdv_child43,fdv_adult54,fdv_child54,fdv_adult65,fdv_child65,fdv_adult76,fdv_child76,fdv_adult87,fdv_child87,fdv_adult98,fdv_child98,trip100,trip200,trip300,trip101,trip201,trip301,t_in,t_out,car_in,car_out,schv,schm)
            VALUES ('46','$sqlt1','$dblt1','$tplt1','$quat1','$sqlt22','$dblt22','$tplt22','$quat22','$sqlt33','$dblt33','$tplt33','$quat33','$sqlt44','$dblt44','$tplt44','$quat44','$sqlt55','$dblt55','$tplt55','$quat55','$sqlt66','$dblt66','$tplt66','$quat66','$sqlt77','$dblt77','$tplt77','$quat77','$sqlt88','$dblt88','$tplt88','$quat88','$chva21','$chva32','$chva43','$chva54','$chva65','$chva76','$chva87','$chva98','0','0','1','$id','$desayunotax','$ratesroom->fecha_ini','$ratesroom->fecha_fin','$frdv_adult21','$frdv_child21','$frdv_adult32','$frdv_child32','$frdv_adult43','$frdv_child43','$frdv_adult54','$frdv_child54','$frdv_adult65','$frdv_child65','$frdv_adult76','$frdv_child76','$frdv_adult87','$frdv_child87','$frdv_adult98','$frdv_child98','$trip_100','$trip_200','$trip_300','$trip_101','$trip_201','$trip_301','$tr_in','$tr_out','$tcar_in','$tcar_out','$sch_v','$sch_m');");
                
                Doo::db()->query("INSERT INTO tarifastrip
                       (trip_no, adult, child, type_rate, id_agency, company_name, annio, id_ratesvalid)
            VALUES ('100','$trip_100','50','0','-1','2016-01-01 00:00:00','$id');");
                
                Doo::db()->query("INSERT INTO tarifastrip
                       (trip_no, adult, child, type_rate, id_agency, company_name, annio, id_ratesvalid)
            VALUES ('200','$trip_200','60','0','-1','2016-01-01 00:00:00','$id');");
                
                Doo::db()->query("INSERT INTO tarifastrip
                       (trip_no, adult, child, type_rate, id_agency, company_name, annio, id_ratesvalid)
            VALUES ('300','$trip_300','70','0','-1','2016-01-01 00:00:00','$id');");
                
                Doo::db()->query("INSERT INTO tarifastrip
                       (trip_no, adult, child, type_rate, id_agency, company_name, annio, id_ratesvalid)
            VALUES ('101','$trip_101','50','0','-1','2016-01-01 00:00:00','$id');");
                
                Doo::db()->query("INSERT INTO tarifastrip
                       (trip_no, adult, child, type_rate, id_agency, company_name, annio, id_ratesvalid)
            VALUES ('201','$trip_201','60','0','-1','2016-01-01 00:00:00','$id');");
                
                Doo::db()->query("INSERT INTO tarifastrip
                       (trip_no, adult, child, type_rate, id_agency, company_name, annio, id_ratesvalid)
            VALUES ('301','$trip_301','70','0','-1','2016-01-01 00:00:00','$id');");
                
                //MODERATE                 
               
                Doo::db()->query("INSERT INTO comifijas
                       (id_hotel,sglm,dblm,tplm,quam,sglm2,dblm2,tplm2,quam2,sglm3,dblm3,tplm3,quam3,sglm4,dblm4,tplm4,quam4,sglm5,dblm5,tplm5,quam5,sglm6,dblm6,tplm6,quam6,sglm7,dblm7,tplm7,quam7,sglm8,dblm8,tplm8,quam8,chm21,chm32,chm43,chm54,chm65,chm76,chm87,chm98,costax,netax,comtax,id_ratesvalid,breackfast,fecha_ini,fecha_fin,fdm_adult21,fdm_child21,fdm_adult32,fdm_child32,fdm_adult43,fdm_child43,fdm_adult54,fdm_child54,fdm_adult65,fdm_child65,fdm_adult76,fdm_child76,fdm_adult87,fdm_child87,fdm_adult98,fdm_child98,trip100,trip200,trip300,trip101,trip201,trip301,t_in,t_out,car_in,car_out,schv,schm)
            VALUES ('30','$sqlt','$dblt','$tplt','$quat','$sqlt2','$dblt2','$tplt2','$quat2','$sqlt3','$dblt3','$tplt3','$quat3','$sqlt4','$dblt4','$tplt4','$quat4','$sqlt5','$dblt5','$tplt5','$quat5','$sqlt6','$dblt6','$tplt6','$quat6','$sqlt7','$dblt7','$tplt7','$quat7','$sqlt8','$dblt8','$tplt8','$quat8','$chmo21','$chmo32','$chmo43','$chmo54','$chmo65','$chmo76','$chmo87','$chmo98','0','0','1','$id','$desayunotax','$ratesroom->fecha_ini','$ratesroom->fecha_fin','$frdm_adult21','$frdm_child21','$frdm_adult32','$frdm_child32','$frdm_adult43','$frdm_child43','$frdm_adult54','$frdm_child54','$frdm_adult65','$frdm_child65','$frdm_adult76','$frdm_child76','$frdm_adult87','$frdm_child87','$frdm_adult98','$frdm_child98','$trip_100','$trip_200','$trip_300','$trip_101','$trip_201','$trip_301','$tr_in','$tr_out','$tcar_in','$tcar_out','$sch_v','$sch_m');");
                 
                Doo::db()->query("INSERT INTO comifijas
                       (id_hotel,sglm,dblm,tplm,quam,sglm2,dblm2,tplm2,quam2,sglm3,dblm3,tplm3,quam3,sglm4,dblm4,tplm4,quam4,sglm5,dblm5,tplm5,quam5,sglm6,dblm6,tplm6,quam6,sglm7,dblm7,tplm7,quam7,sglm8,dblm8,tplm8,quam8,chm21,chm32,chm43,chm54,chm65,chm76,chm87,chm98,costax,netax,comtax,id_ratesvalid,breackfast,fecha_ini,fecha_fin,fdm_adult21,fdm_child21,fdm_adult32,fdm_child32,fdm_adult43,fdm_child43,fdm_adult54,fdm_child54,fdm_adult65,fdm_child65,fdm_adult76,fdm_child76,fdm_adult87,fdm_child87,fdm_adult98,fdm_child98,trip100,trip200,trip300,trip101,trip201,trip301,t_in,t_out,car_in,car_out,schv,schm)
            VALUES ('31','$sqlt','$dblt','$tplt','$quat','$sqlt2','$dblt2','$tplt2','$quat2','$sqlt3','$dblt3','$tplt3','$quat3','$sqlt4','$dblt4','$tplt4','$quat4','$sqlt5','$dblt5','$tplt5','$quat5','$sqlt6','$dblt6','$tplt6','$quat6','$sqlt7','$dblt7','$tplt7','$quat7','$sqlt8','$dblt8','$tplt8','$quat8','$chmo21','$chmo32','$chmo43','$chmo54','$chmo65','$chmo76','$chmo87','$chmo98','0','0','1','$id','$desayunotax','$ratesroom->fecha_ini','$ratesroom->fecha_fin','$frdm_adult21','$frdm_child21','$frdm_adult32','$frdm_child32','$frdm_adult43','$frdm_child43','$frdm_adult54','$frdm_child54','$frdm_adult65','$frdm_child65','$frdm_adult76','$frdm_child76','$frdm_adult87','$frdm_child87','$frdm_adult98','$frdm_child98','$trip_100','$trip_200','$trip_300','$trip_101','$trip_201','$trip_301','$tr_in','$tr_out','$tcar_in','$tcar_out','$sch_v','$sch_m');");

                Doo::db()->query("INSERT INTO comifijas
                       (id_hotel,sglm,dblm,tplm,quam,sglm2,dblm2,tplm2,quam2,sglm3,dblm3,tplm3,quam3,sglm4,dblm4,tplm4,quam4,sglm5,dblm5,tplm5,quam5,sglm6,dblm6,tplm6,quam6,sglm7,dblm7,tplm7,quam7,sglm8,dblm8,tplm8,quam8,chm21,chm32,chm43,chm54,chm65,chm76,chm87,chm98,costax,netax,comtax,id_ratesvalid,breackfast,fecha_ini,fecha_fin,fdm_adult21,fdm_child21,fdm_adult32,fdm_child32,fdm_adult43,fdm_child43,fdm_adult54,fdm_child54,fdm_adult65,fdm_child65,fdm_adult76,fdm_child76,fdm_adult87,fdm_child87,fdm_adult98,fdm_child98,trip100,trip200,trip300,trip101,trip201,trip301,t_in,t_out,car_in,car_out,schv,schm)
            VALUES ('34','$sqlt','$dblt','$tplt','$quat','$sqlt2','$dblt2','$tplt2','$quat2','$sqlt3','$dblt3','$tplt3','$quat3','$sqlt4','$dblt4','$tplt4','$quat4','$sqlt5','$dblt5','$tplt5','$quat5','$sqlt6','$dblt6','$tplt6','$quat6','$sqlt7','$dblt7','$tplt7','$quat7','$sqlt8','$dblt8','$tplt8','$quat8','$chmo21','$chmo32','$chmo43','$chmo54','$chmo65','$chmo76','$chmo87','$chmo98','0','0','1','$id','$desayunotax','$ratesroom->fecha_ini','$ratesroom->fecha_fin','$frdm_adult21','$frdm_child21','$frdm_adult32','$frdm_child32','$frdm_adult43','$frdm_child43','$frdm_adult54','$frdm_child54','$frdm_adult65','$frdm_child65','$frdm_adult76','$frdm_child76','$frdm_adult87','$frdm_child87','$frdm_adult98','$frdm_child98','$trip_100','$trip_200','$trip_300','$trip_101','$trip_201','$trip_301','$tr_in','$tr_out','$tcar_in','$tcar_out','$sch_v','$sch_m');");
                
                Doo::db()->query("INSERT INTO comifijas
                       (id_hotel,sglm,dblm,tplm,quam,sglm2,dblm2,tplm2,quam2,sglm3,dblm3,tplm3,quam3,sglm4,dblm4,tplm4,quam4,sglm5,dblm5,tplm5,quam5,sglm6,dblm6,tplm6,quam6,sglm7,dblm7,tplm7,quam7,sglm8,dblm8,tplm8,quam8,chm21,chm32,chm43,chm54,chm65,chm76,chm87,chm98,costax,netax,comtax,id_ratesvalid,breackfast,fecha_ini,fecha_fin,fdm_adult21,fdm_child21,fdm_adult32,fdm_child32,fdm_adult43,fdm_child43,fdm_adult54,fdm_child54,fdm_adult65,fdm_child65,fdm_adult76,fdm_child76,fdm_adult87,fdm_child87,fdm_adult98,fdm_child98,trip100,trip200,trip300,trip101,trip201,trip301,t_in,t_out,car_in,car_out,schv,schm)
            VALUES ('35','$sqlt','$dblt','$tplt','$quat','$sqlt2','$dblt2','$tplt2','$quat2','$sqlt3','$dblt3','$tplt3','$quat3','$sqlt4','$dblt4','$tplt4','$quat4','$sqlt5','$dblt5','$tplt5','$quat5','$sqlt6','$dblt6','$tplt6','$quat6','$sqlt7','$dblt7','$tplt7','$quat7','$sqlt8','$dblt8','$tplt8','$quat8','$chmo21','$chmo32','$chmo43','$chmo54','$chmo65','$chmo76','$chmo87','$chmo98','0','0','1','$id','$desayunotax','$ratesroom->fecha_ini','$ratesroom->fecha_fin','$frdm_adult21','$frdm_child21','$frdm_adult32','$frdm_child32','$frdm_adult43','$frdm_child43','$frdm_adult54','$frdm_child54','$frdm_adult65','$frdm_child65','$frdm_adult76','$frdm_child76','$frdm_adult87','$frdm_child87','$frdm_adult98','$frdm_child98','$trip_100','$trip_200','$trip_300','$trip_101','$trip_201','$trip_301','$tr_in','$tr_out','$tcar_in','$tcar_out','$sch_v','$sch_m');");

                Doo::db()->query("INSERT INTO comifijas
                       (id_hotel,sglm,dblm,tplm,quam,sglm2,dblm2,tplm2,quam2,sglm3,dblm3,tplm3,quam3,sglm4,dblm4,tplm4,quam4,sglm5,dblm5,tplm5,quam5,sglm6,dblm6,tplm6,quam6,sglm7,dblm7,tplm7,quam7,sglm8,dblm8,tplm8,quam8,chm21,chm32,chm43,chm54,chm65,chm76,chm87,chm98,costax,netax,comtax,id_ratesvalid,breackfast,fecha_ini,fecha_fin,fdm_adult21,fdm_child21,fdm_adult32,fdm_child32,fdm_adult43,fdm_child43,fdm_adult54,fdm_child54,fdm_adult65,fdm_child65,fdm_adult76,fdm_child76,fdm_adult87,fdm_child87,fdm_adult98,fdm_child98,trip100,trip200,trip300,trip101,trip201,trip301,t_in,t_out,car_in,car_out,schv,schm)
            VALUES ('41','$sqlt','$dblt','$tplt','$quat','$sqlt2','$dblt2','$tplt2','$quat2','$sqlt3','$dblt3','$tplt3','$quat3','$sqlt4','$dblt4','$tplt4','$quat4','$sqlt5','$dblt5','$tplt5','$quat5','$sqlt6','$dblt6','$tplt6','$quat6','$sqlt7','$dblt7','$tplt7','$quat7','$sqlt8','$dblt8','$tplt8','$quat8','$chmo21','$chmo32','$chmo43','$chmo54','$chmo65','$chmo76','$chmo87','$chmo98','0','0','1','$id','$desayunotax','$ratesroom->fecha_ini','$ratesroom->fecha_fin','$frdm_adult21','$frdm_child21','$frdm_adult32','$frdm_child32','$frdm_adult43','$frdm_child43','$frdm_adult54','$frdm_child54','$frdm_adult65','$frdm_child65','$frdm_adult76','$frdm_child76','$frdm_adult87','$frdm_child87','$frdm_adult98','$frdm_child98','$trip_100','$trip_200','$trip_300','$trip_101','$trip_201','$trip_301','$tr_in','$tr_out','$tcar_in','$tcar_out','$sch_v','$sch_m');");
                
                Doo::db()->query("INSERT INTO comifijas
                       (id_hotel,sglm,dblm,tplm,quam,sglm2,dblm2,tplm2,quam2,sglm3,dblm3,tplm3,quam3,sglm4,dblm4,tplm4,quam4,sglm5,dblm5,tplm5,quam5,sglm6,dblm6,tplm6,quam6,sglm7,dblm7,tplm7,quam7,sglm8,dblm8,tplm8,quam8,chm21,chm32,chm43,chm54,chm65,chm76,chm87,chm98,costax,netax,comtax,id_ratesvalid,breackfast,fecha_ini,fecha_fin,fdm_adult21,fdm_child21,fdm_adult32,fdm_child32,fdm_adult43,fdm_child43,fdm_adult54,fdm_child54,fdm_adult65,fdm_child65,fdm_adult76,fdm_child76,fdm_adult87,fdm_child87,fdm_adult98,fdm_child98,trip100,trip200,trip300,trip101,trip201,trip301,t_in,t_out,car_in,car_out,schv,schm)
            VALUES ('42','$sqlt','$dblt','$tplt','$quat','$sqlt2','$dblt2','$tplt2','$quat2','$sqlt3','$dblt3','$tplt3','$quat3','$sqlt4','$dblt4','$tplt4','$quat4','$sqlt5','$dblt5','$tplt5','$quat5','$sqlt6','$dblt6','$tplt6','$quat6','$sqlt7','$dblt7','$tplt7','$quat7','$sqlt8','$dblt8','$tplt8','$quat8','$chmo21','$chmo32','$chmo43','$chmo54','$chmo65','$chmo76','$chmo87','$chmo98','0','0','1','$id','$desayunotax','$ratesroom->fecha_ini','$ratesroom->fecha_fin','$frdm_adult21','$frdm_child21','$frdm_adult32','$frdm_child32','$frdm_adult43','$frdm_child43','$frdm_adult54','$frdm_child54','$frdm_adult65','$frdm_child65','$frdm_adult76','$frdm_child76','$frdm_adult87','$frdm_child87','$frdm_adult98','$frdm_child98','$trip_100','$trip_200','$trip_300','$trip_101','$trip_201','$trip_301','$tr_in','$tr_out','$tcar_in','$tcar_out','$sch_v','$sch_m');");
                
                Doo::db()->query("INSERT INTO comifijas
                       (id_hotel,sglm,dblm,tplm,quam,sglm2,dblm2,tplm2,quam2,sglm3,dblm3,tplm3,quam3,sglm4,dblm4,tplm4,quam4,sglm5,dblm5,tplm5,quam5,sglm6,dblm6,tplm6,quam6,sglm7,dblm7,tplm7,quam7,sglm8,dblm8,tplm8,quam8,chm21,chm32,chm43,chm54,chm65,chm76,chm87,chm98,costax,netax,comtax,id_ratesvalid,breackfast,fecha_ini,fecha_fin,fdm_adult21,fdm_child21,fdm_adult32,fdm_child32,fdm_adult43,fdm_child43,fdm_adult54,fdm_child54,fdm_adult65,fdm_child65,fdm_adult76,fdm_child76,fdm_adult87,fdm_child87,fdm_adult98,fdm_child98,trip100,trip200,trip300,trip101,trip201,trip301,t_in,t_out,car_in,car_out,schv,schm)
            VALUES ('47','$sqlt','$dblt','$tplt','$quat','$sqlt2','$dblt2','$tplt2','$quat2','$sqlt3','$dblt3','$tplt3','$quat3','$sqlt4','$dblt4','$tplt4','$quat4','$sqlt5','$dblt5','$tplt5','$quat5','$sqlt6','$dblt6','$tplt6','$quat6','$sqlt7','$dblt7','$tplt7','$quat7','$sqlt8','$dblt8','$tplt8','$quat8','$chmo21','$chmo32','$chmo43','$chmo54','$chmo65','$chmo76','$chmo87','$chmo98','0','0','1','$id','$desayunotax','$ratesroom->fecha_ini','$ratesroom->fecha_fin','$frdm_adult21','$frdm_child21','$frdm_adult32','$frdm_child32','$frdm_adult43','$frdm_child43','$frdm_adult54','$frdm_child54','$frdm_adult65','$frdm_child65','$frdm_adult76','$frdm_child76','$frdm_adult87','$frdm_child87','$frdm_adult98','$frdm_child98','$trip_100','$trip_200','$trip_300','$trip_101','$trip_201','$trip_301','$tr_in','$tr_out','$tcar_in','$tcar_out','$sch_v','$sch_m');");
                
                Doo::db()->query("INSERT INTO comifijas
                       (id_hotel,sglm,dblm,tplm,quam,sglm2,dblm2,tplm2,quam2,sglm3,dblm3,tplm3,quam3,sglm4,dblm4,tplm4,quam4,sglm5,dblm5,tplm5,quam5,sglm6,dblm6,tplm6,quam6,sglm7,dblm7,tplm7,quam7,sglm8,dblm8,tplm8,quam8,chm21,chm32,chm43,chm54,chm65,chm76,chm87,chm98,costax,netax,comtax,id_ratesvalid,breackfast,fecha_ini,fecha_fin,fdm_adult21,fdm_child21,fdm_adult32,fdm_child32,fdm_adult43,fdm_child43,fdm_adult54,fdm_child54,fdm_adult65,fdm_child65,fdm_adult76,fdm_child76,fdm_adult87,fdm_child87,fdm_adult98,fdm_child98,trip100,trip200,trip300,trip101,trip201,trip301,t_in,t_out,car_in,car_out,schv,schm)
            VALUES ('48','$sqlt','$dblt','$tplt','$quat','$sqlt2','$dblt2','$tplt2','$quat2','$sqlt3','$dblt3','$tplt3','$quat3','$sqlt4','$dblt4','$tplt4','$quat4','$sqlt5','$dblt5','$tplt5','$quat5','$sqlt6','$dblt6','$tplt6','$quat6','$sqlt7','$dblt7','$tplt7','$quat7','$sqlt8','$dblt8','$tplt8','$quat8','$chmo21','$chmo32','$chmo43','$chmo54','$chmo65','$chmo76','$chmo87','$chmo98','0','0','1','$id','$desayunotax','$ratesroom->fecha_ini','$ratesroom->fecha_fin','$frdm_adult21','$frdm_child21','$frdm_adult32','$frdm_child32','$frdm_adult43','$frdm_child43','$frdm_adult54','$frdm_child54','$frdm_adult65','$frdm_child65','$frdm_adult76','$frdm_child76','$frdm_adult87','$frdm_child87','$frdm_adult98','$frdm_child98','$trip_100','$trip_200','$trip_300','$trip_101','$trip_201','$trip_301','$tr_in','$tr_out','$tcar_in','$tcar_out','$sch_v','$sch_m');");
                
                
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
                //Doo::db()->update($tarifastrip);
                
                

                $rs = Doo::db()->query("SELECT  id
							FROM ratesvalid 
							 where id = '$ratesroom->id'");

                $dato = $rs->fetch();
                $id = $dato['id'];
                
                $borrado = Doo::db()->query("DELETE FROM  comifijas
								WHERE id_hotel = '$ratesroom->id_hotel' and id_ratesvalid = $id");
                
                //Doo::db()->beginTransaction();
                
//                Doo::db()->update($tarifastrip);
//                
//                $borrado1 = Doo::db()->query("DELETE FROM  tarifastrip
//								WHERE id_ratesvalid = $id");
                

                if ($borrado)  {



                    $sglt1 = $ratesroom->sgl;
                    $dblt1 = $ratesroom->dbl;
                    $tplt1 = $ratesroom->tpl;
                    $quat1 = $ratesroom->qua;
                
                    $sgltax22 = $ratesroom->sgl2;
                    $dbltax22 = $ratesroom->dbl2;
                    $tpltax22 = $ratesroom->tpl2;
                    $quatax22 = $ratesroom->qua2;
                    
                    $sgltax33 = $ratesroom->sgl3;
                    $dbltax33 = $ratesroom->dbl3;
                    $tpltax33 = $ratesroom->tpl3;
                    $quatax33 = $ratesroom->qua3;
                
                    $sgltax44 = $ratesroom->sgl4;
                    $dbltax44 = $ratesroom->dbl4;
                    $tpltax44 = $ratesroom->tpl4;
                    $quatax44 = $ratesroom->qua4;
                
                    $sgltax55 = $ratesroom->sgl5;
                    $dbltax55 = $ratesroom->dbl5;
                    $tpltax55 = $ratesroom->tpl5;
                    $quatax55 = $ratesroom->qua5;
                
                    $sgltax66 = $ratesroom->sgl6;
                    $dbltax66 = $ratesroom->dbl6;
                    $tpltax66 = $ratesroom->tpl6;
                    $quatax66 = $ratesroom->qua6;
                
                    $sgltax77 = $ratesroom->sgl7;
                    $dbltax77 = $ratesroom->dbl7;
                    $tpltax77 = $ratesroom->tpl7;
                    $quatax77 = $ratesroom->qua7;
                
                    $sgltax88 = $ratesroom->sgl8;
                    $dbltax88 = $ratesroom->dbl8;
                    $tpltax88 = $ratesroom->tpl8;
                    $quatax88 = $ratesroom->qua8;
                    
                     
                    $chv21 = $ratesroom->chv21;
                    $chv32 = $ratesroom->chv32;
                    $chv43 = $ratesroom->chv43;
                    $chv54 = $ratesroom->chv54;
                    $chv65 = $ratesroom->chv65;
                    $chv76 = $ratesroom->chv76;
                    $chv87 = $ratesroom->chv87;
                    $chv98 = $ratesroom->chv98;
                    
                    $fdv_adult21 = $ratesroom->fdv_adult21;
                    $fdv_child21 = $ratesroom->fdv_child21;
                    $fdv_adult32 = $ratesroom->fdv_adult32;
                    $fdv_child32 = $ratesroom->fdv_child32;
                    $fdv_adult43 = $ratesroom->fdv_adult43;
                    $fdv_child43 = $ratesroom->fdv_child43;
                    $fdv_adult54 = $ratesroom->fdv_adult54;
                    $fdv_child54 = $ratesroom->fdv_child54;
                    $fdv_adult65 = $ratesroom->fdv_adult65;
                    $fdv_child65 = $ratesroom->fdv_child65;
                    $fdv_adult76 = $ratesroom->fdv_adult76;
                    $fdv_child76 = $ratesroom->fdv_child76;
                    $fdv_adult87 = $ratesroom->fdv_adult87;
                    $fdv_child87 = $ratesroom->fdv_child87;
                    $fdv_adult98 = $ratesroom->fdv_adult98;
                    $fdv_child98 = $ratesroom->fdv_child98;
                    
                    $trip100 = $ratesroom->trip100;
                    $trip200 = $ratesroom->trip200;
                    $trip300 = $ratesroom->trip300;
                    $trip101 = $ratesroom->trip101;
                    $trip201 = $ratesroom->trip201;
                    $trip301 = $ratesroom->trip301;
                    $t_in = $ratesroom->t_in;
                    $t_out = $ratesroom->t_out;
                    $car_in = $ratesroom->car_in;
                    $car_out = $ratesroom->car_out;
                    $schv = $ratesroom->schv;
                    $schm = $ratesroom->schm;
                
                    
                
                    
                    
                    //VALUE
                   
                    $sqlt1 = $sglt1;
                    $dblt1 = $dblt1;
                    $tplt1 = $tplt1;
                    $quat1 = $quat1;
                
                    $sqlt22 = $sgltax22;
                    $dblt22 = $dbltax22;
                    $tplt22 = $tpltax22;
                    $quat22 = $quatax22;
                    
                    $sqlt33 = $sgltax33;
                    $dblt33 = $dbltax33;
                    $tplt33 = $tpltax33;
                    $quat33 = $quatax33;
                
                    $sqlt44 = $sgltax44;
                    $dblt44 = $dbltax44;
                    $tplt44 = $tpltax44;
                    $quat44 = $quatax44;
                
                    $sqlt55 = $sgltax55;
                    $dblt55 = $dbltax55;
                    $tplt55 = $tpltax55;
                    $quat55 = $quatax55;
                
                    $sqlt66 = $sgltax66;
                    $dblt66 = $dbltax66;
                    $tplt66 = $tpltax66;
                    $quat66 = $quatax66;
                
                    $sqlt77 = $sgltax77;
                    $dblt77 = $dbltax77;
                    $tplt77 = $tpltax77;
                    $quat77 = $quatax77;
                
                    $sqlt88 = $sgltax88;
                    $dblt88 = $dbltax88;
                    $tplt88 = $tpltax88;
                    $quat88 = $quatax88;
                    
                    
                    $chva21 = $chv21;
                    $chva32 = $chv32;
                    $chva43 = $chv43;
                    $chva54 = $chv54;
                    $chva65 = $chv65;
                    $chva76 = $chv76;
                    $chva87 = $chv87;
                    $chva98 = $chv98;
                    
                    $frdv_adult21   = $fdv_adult21;
                    $frdv_child21   = $fdv_child21;
                    $frdv_adult32   = $fdv_adult32;
                    $frdv_child32   = $fdv_child32;
                    $frdv_adult43   = $fdv_adult43;
                    $frdv_child43   = $fdv_child43;
                    $frdv_adult54   = $fdv_adult54;
                    $frdv_child54   = $fdv_child54;
                    $frdv_adult65   = $fdv_adult65;
                    $frdv_child65   = $fdv_child65;
                    $frdv_adult76   = $fdv_adult76;
                    $frdv_child76   = $fdv_child76;
                    $frdv_adult87   = $fdv_adult87;
                    $frdv_child87   = $fdv_child87;
                    $frdv_adult98   = $fdv_adult98;
                    $frdv_child98   = $fdv_child98;
                    
                    $trip_100  = $trip100;
                    $trip_200  = $trip200;
                    $trip_300  = $trip300;
                    $trip_101  = $trip101;
                    $trip_201  = $trip201;
                    $trip_301  = $trip301;
                    $tr_in     = $t_in;
                    $tr_out    = $t_out;
                    $tcar_in   = $car_in;
                    $tcar_out  = $car_out;
                    $sch_v     = $schv;
                    $sch_m     = $schm;
                    
                    
                    //$desayunotax = ((($porcentajes['tax'] / 100) * $ratesroom->brackfast) + ($ratesroom->brackfast));


                                     
                  
                    Doo::db()->query("UPDATE comifijas SET sgl='$sqlt1',dbl='$dblt1',tpl='$tplt1',qua='$quat1',sgl2='$sqlt22',dbl2='$dblt22',tpl2='$tplt22',qua2='$quat22',sgl3='$sqlt33',dbl3='$dblt33',tpl3='$tplt33',qua3='$quat33',sgl4='$sqlt44',dbl4='$dblt44',tpl4='$tplt44',qua4='$quat44',sgl5='$sqlt55',dbl5='$dblt55',tpl5='$tplt55',qua5='$quat55',sgl6='$sqlt66',dbl6='$dblt66',tpl6='$tplt66',qua6='$quat66',sgl7='$sqlt77',dbl7='$dblt77',tpl7='$tplt77',qua7='$quat77',sgl8='$sqlt88',dbl8='$dblt88',tpl8='$tplt88',qua8='$quat88',chv21='$chva21',chv32='$chva32',chv43='$chva43',chv54='$chva54',chv65='$chva65',chv76='$chva76',chv87='$chva87',chv98='$chva98',id_ratesvalid='$id',fdv_adult21='$frdv_adult21',fdv_child21='$frdv_child21',fdv_adult32='$frdv_adult32',fdv_child32='$frdv_child32',fdv_adult43='$frdv_adult43',fdv_child43='$frdv_child43',fdv_adult54='$frdv_adult54',fdv_child54='$frdv_child54',fdv_adult65='$frdv_adult65',fdv_child65='$frdv_child65',fdv_adult76='$frdv_adult76',fdv_child76='$frdv_child76',fdv_adult87='$frdv_adult87',fdv_child87='$frdv_child87',fdv_adult98='$frdv_adult98',fdv_child98='$frdv_child98',trip100='$trip_100',trip200='$trip_200',trip300='$trip_300',trip101='$trip_101',trip201='$trip_201',trip301='$trip_301',t_in='$tr_in',t_out='$tr_out',car_in='$tcar_in ',car_out='$tcar_out',schv='$sch_v',schm='$sch_m' WHERE id_ratesvalid = '$id' AND id_hotel='27' AND fecha_ini='$ratesroom->fecha_ini' AND fecha_fin='$ratesroom->fecha_fin' AND comtax='1'");
                    
                    Doo::db()->query("UPDATE comifijas SET sgl='$sqlt1',dbl='$dblt1',tpl='$tplt1',qua='$quat1',sgl2='$sqlt22',dbl2='$dblt22',tpl2='$tplt22',qua2='$quat22',sgl3='$sqlt33',dbl3='$dblt33',tpl3='$tplt33',qua3='$quat33',sgl4='$sqlt44',dbl4='$dblt44',tpl4='$tplt44',qua4='$quat44',sgl5='$sqlt55',dbl5='$dblt55',tpl5='$tplt55',qua5='$quat55',sgl6='$sqlt66',dbl6='$dblt66',tpl6='$tplt66',qua6='$quat66',sgl7='$sqlt77',dbl7='$dblt77',tpl7='$tplt77',qua7='$quat77',sgl8='$sqlt88',dbl8='$dblt88',tpl8='$tplt88',qua8='$quat88',chv21='$chva21',chv32='$chva32',chv43='$chva43',chv54='$chva54',chv65='$chva65',chv76='$chva76',chv87='$chva87',chv98='$chva98',id_ratesvalid='$id',fdv_adult21='$frdv_adult21',fdv_child21='$frdv_child21',fdv_adult32='$frdv_adult32',fdv_child32='$frdv_child32',fdv_adult43='$frdv_adult43',fdv_child43='$frdv_child43',fdv_adult54='$frdv_adult54',fdv_child54='$frdv_child54',fdv_adult65='$frdv_adult65',fdv_child65='$frdv_child65',fdv_adult76='$frdv_adult76',fdv_child76='$frdv_child76',fdv_adult87='$frdv_adult87',fdv_child87='$frdv_child87',fdv_adult98='$frdv_adult98',fdv_child98='$frdv_child98',trip100='$trip_100',trip200='$trip_200',trip300='$trip_300',trip101='$trip_101',trip201='$trip_201',trip301='$trip_301',t_in='$tr_in',t_out='$tr_out',car_in='$tcar_in ',car_out='$tcar_out',schv='$sch_v',schm='$sch_m' WHERE id_ratesvalid = '$id' AND id_hotel='38' AND fecha_ini='$ratesroom->fecha_ini' AND fecha_fin='$ratesroom->fecha_fin' AND comtax='1'");
                    
                    Doo::db()->query("UPDATE comifijas SET sgl='$sqlt1',dbl='$dblt1',tpl='$tplt1',qua='$quat1',sgl2='$sqlt22',dbl2='$dblt22',tpl2='$tplt22',qua2='$quat22',sgl3='$sqlt33',dbl3='$dblt33',tpl3='$tplt33',qua3='$quat33',sgl4='$sqlt44',dbl4='$dblt44',tpl4='$tplt44',qua4='$quat44',sgl5='$sqlt55',dbl5='$dblt55',tpl5='$tplt55',qua5='$quat55',sgl6='$sqlt66',dbl6='$dblt66',tpl6='$tplt66',qua6='$quat66',sgl7='$sqlt77',dbl7='$dblt77',tpl7='$tplt77',qua7='$quat77',sgl8='$sqlt88',dbl8='$dblt88',tpl8='$tplt88',qua8='$quat88',chv21='$chva21',chv32='$chva32',chv43='$chva43',chv54='$chva54',chv65='$chva65',chv76='$chva76',chv87='$chva87',chv98='$chva98',id_ratesvalid='$id',fdv_adult21='$frdv_adult21',fdv_child21='$frdv_child21',fdv_adult32='$frdv_adult32',fdv_child32='$frdv_child32',fdv_adult43='$frdv_adult43',fdv_child43='$frdv_child43',fdv_adult54='$frdv_adult54',fdv_child54='$frdv_child54',fdv_adult65='$frdv_adult65',fdv_child65='$frdv_child65',fdv_adult76='$frdv_adult76',fdv_child76='$frdv_child76',fdv_adult87='$frdv_adult87',fdv_child87='$frdv_child87',fdv_adult98='$frdv_adult98',fdv_child98='$frdv_child98',trip100='$trip_100',trip200='$trip_200',trip300='$trip_300',trip101='$trip_101',trip201='$trip_201',trip301='$trip_301',t_in='$tr_in',t_out='$tr_out',car_in='$tcar_in ',car_out='$tcar_out',schv='$sch_v',schm='$sch_m' WHERE id_ratesvalid = '$id' AND id_hotel='39' AND fecha_ini='$ratesroom->fecha_ini' AND fecha_fin='$ratesroom->fecha_fin' AND comtax='1'");
                    
                    Doo::db()->query("UPDATE comifijas SET sgl='$sqlt1',dbl='$dblt1',tpl='$tplt1',qua='$quat1',sgl2='$sqlt22',dbl2='$dblt22',tpl2='$tplt22',qua2='$quat22',sgl3='$sqlt33',dbl3='$dblt33',tpl3='$tplt33',qua3='$quat33',sgl4='$sqlt44',dbl4='$dblt44',tpl4='$tplt44',qua4='$quat44',sgl5='$sqlt55',dbl5='$dblt55',tpl5='$tplt55',qua5='$quat55',sgl6='$sqlt66',dbl6='$dblt66',tpl6='$tplt66',qua6='$quat66',sgl7='$sqlt77',dbl7='$dblt77',tpl7='$tplt77',qua7='$quat77',sgl8='$sqlt88',dbl8='$dblt88',tpl8='$tplt88',qua8='$quat88',chv21='$chva21',chv32='$chva32',chv43='$chva43',chv54='$chva54',chv65='$chva65',chv76='$chva76',chv87='$chva87',chv98='$chva98',id_ratesvalid='$id',fdv_adult21='$frdv_adult21',fdv_child21='$frdv_child21',fdv_adult32='$frdv_adult32',fdv_child32='$frdv_child32',fdv_adult43='$frdv_adult43',fdv_child43='$frdv_child43',fdv_adult54='$frdv_adult54',fdv_child54='$frdv_child54',fdv_adult65='$frdv_adult65',fdv_child65='$frdv_child65',fdv_adult76='$frdv_adult76',fdv_child76='$frdv_child76',fdv_adult87='$frdv_adult87',fdv_child87='$frdv_child87',fdv_adult98='$frdv_adult98',fdv_child98='$frdv_child98',trip100='$trip_100',trip200='$trip_200',trip300='$trip_300',trip101='$trip_101',trip201='$trip_201',trip301='$trip_301',t_in='$tr_in',t_out='$tr_out',car_in='$tcar_in ',car_out='$tcar_out',schv='$sch_v',schm='$sch_m' WHERE id_ratesvalid = '$id' AND id_hotel='40' AND fecha_ini='$ratesroom->fecha_ini' AND fecha_fin='$ratesroom->fecha_fin' AND comtax='1'");
                    
                    Doo::db()->query("UPDATE comifijas SET sgl='$sqlt1',dbl='$dblt1',tpl='$tplt1',qua='$quat1',sgl2='$sqlt22',dbl2='$dblt22',tpl2='$tplt22',qua2='$quat22',sgl3='$sqlt33',dbl3='$dblt33',tpl3='$tplt33',qua3='$quat33',sgl4='$sqlt44',dbl4='$dblt44',tpl4='$tplt44',qua4='$quat44',sgl5='$sqlt55',dbl5='$dblt55',tpl5='$tplt55',qua5='$quat55',sgl6='$sqlt66',dbl6='$dblt66',tpl6='$tplt66',qua6='$quat66',sgl7='$sqlt77',dbl7='$dblt77',tpl7='$tplt77',qua7='$quat77',sgl8='$sqlt88',dbl8='$dblt88',tpl8='$tplt88',qua8='$quat88',chv21='$chva21',chv32='$chva32',chv43='$chva43',chv54='$chva54',chv65='$chva65',chv76='$chva76',chv87='$chva87',chv98='$chva98',id_ratesvalid='$id',fdv_adult21='$frdv_adult21',fdv_child21='$frdv_child21',fdv_adult32='$frdv_adult32',fdv_child32='$frdv_child32',fdv_adult43='$frdv_adult43',fdv_child43='$frdv_child43',fdv_adult54='$frdv_adult54',fdv_child54='$frdv_child54',fdv_adult65='$frdv_adult65',fdv_child65='$frdv_child65',fdv_adult76='$frdv_adult76',fdv_child76='$frdv_child76',fdv_adult87='$frdv_adult87',fdv_child87='$frdv_child87',fdv_adult98='$frdv_adult98',fdv_child98='$frdv_child98',trip100='$trip_100',trip200='$trip_200',trip300='$trip_300',trip101='$trip_101',trip201='$trip_201',trip301='$trip_301',t_in='$tr_in',t_out='$tr_out',car_in='$tcar_in ',car_out='$tcar_out',schv='$sch_v',schm='$sch_m' WHERE id_ratesvalid = '$id' AND id_hotel='43' AND fecha_ini='$ratesroom->fecha_ini' AND fecha_fin='$ratesroom->fecha_fin' AND comtax='1'");
                    
                    Doo::db()->query("UPDATE comifijas SET sgl='$sqlt1',dbl='$dblt1',tpl='$tplt1',qua='$quat1',sgl2='$sqlt22',dbl2='$dblt22',tpl2='$tplt22',qua2='$quat22',sgl3='$sqlt33',dbl3='$dblt33',tpl3='$tplt33',qua3='$quat33',sgl4='$sqlt44',dbl4='$dblt44',tpl4='$tplt44',qua4='$quat44',sgl5='$sqlt55',dbl5='$dblt55',tpl5='$tplt55',qua5='$quat55',sgl6='$sqlt66',dbl6='$dblt66',tpl6='$tplt66',qua6='$quat66',sgl7='$sqlt77',dbl7='$dblt77',tpl7='$tplt77',qua7='$quat77',sgl8='$sqlt88',dbl8='$dblt88',tpl8='$tplt88',qua8='$quat88',chv21='$chva21',chv32='$chva32',chv43='$chva43',chv54='$chva54',chv65='$chva65',chv76='$chva76',chv87='$chva87',chv98='$chva98',id_ratesvalid='$id',fdv_adult21='$frdv_adult21',fdv_child21='$frdv_child21',fdv_adult32='$frdv_adult32',fdv_child32='$frdv_child32',fdv_adult43='$frdv_adult43',fdv_child43='$frdv_child43',fdv_adult54='$frdv_adult54',fdv_child54='$frdv_child54',fdv_adult65='$frdv_adult65',fdv_child65='$frdv_child65',fdv_adult76='$frdv_adult76',fdv_child76='$frdv_child76',fdv_adult87='$frdv_adult87',fdv_child87='$frdv_child87',fdv_adult98='$frdv_adult98',fdv_child98='$frdv_child98',trip100='$trip_100',trip200='$trip_200',trip300='$trip_300',trip101='$trip_101',trip201='$trip_201',trip301='$trip_301',t_in='$tr_in',t_out='$tr_out',car_in='$tcar_in ',car_out='$tcar_out',schv='$sch_v',schm='$sch_m' WHERE id_ratesvalid = '$id' AND id_hotel='46' AND fecha_ini='$ratesroom->fecha_ini' AND fecha_fin='$ratesroom->fecha_fin' AND comtax='1'");                   
                       
                    
//                    Doo::db()->query("UPDATE tarifastrip SET adult='$trip_100', child='80' WHERE id_ratesvalid = '$id' AND trip_no = '100'");
//                    
//                    Doo::db()->query("UPDATE tarifastrip SET adult='$trip_200', child='70' WHERE id_ratesvalid = '$id' AND trip_no = '200'");
//                    
//                    Doo::db()->query("UPDATE tarifastrip SET adult='$trip_300', child='60' WHERE id_ratesvalid = '$id' AND trip_no = '300'");
//                    
//                    Doo::db()->query("UPDATE tarifastrip SET adult='$trip_101', child='80' WHERE id_ratesvalid = '$id' AND trip_no = '101'");
//                     
//                    Doo::db()->query("UPDATE tarifastrip SET adult='$trip_201', child='70' WHERE id_ratesvalid = '$id' AND trip_no = '201'");
//                    
//                    Doo::db()->query("UPDATE tarifastrip SET adult='$trip_301', child='60' WHERE id_ratesvalid = '$id' AND trip_no = '301'");
                    
                    
                    
                    
                    //MODERATE
                    $sgltax = $ratesroom->sglm;
                    $dbltax = $ratesroom->dblm;
                    $tpltax = $ratesroom->tplm;
                    $quatax = $ratesroom->quam;
                    
                    
                    $sgltax2 = $ratesroom->sglm2;
                    $dbltax2 = $ratesroom->dblm2;
                    $tpltax2 = $ratesroom->tplm2;
                    $quatax2 = $ratesroom->quam2;
                    
                    $sgltax3 = $ratesroom->sglm3;
                    $dbltax3 = $ratesroom->dblm3;
                    $tpltax3 = $ratesroom->tplm3;
                    $quatax3 = $ratesroom->quam3;
                    
                    $sgltax4 = $ratesroom->sglm4;
                    $dbltax4 = $ratesroom->dblm4;
                    $tpltax4 = $ratesroom->tplm4;
                    $quatax4 = $ratesroom->quam4;
                    
                    $sgltax5 = $ratesroom->sglm5;
                    $dbltax5 = $ratesroom->dblm5;
                    $tpltax5 = $ratesroom->tplm5;
                    $quatax5 = $ratesroom->quam5;
                
                    $sgltax6 = $ratesroom->sglm6;
                    $dbltax6 = $ratesroom->dblm6;
                    $tpltax6 = $ratesroom->tplm6;
                    $quatax6 = $ratesroom->quam6;
                
                    $sgltax7 = $ratesroom->sglm7;
                    $dbltax7 = $ratesroom->dblm7;
                    $tpltax7 = $ratesroom->tplm7;
                    $quatax7 = $ratesroom->quam7;
                
                    $sgltax8 = $ratesroom->sglm8;
                    $dbltax8 = $ratesroom->dblm8;
                    $tpltax8 = $ratesroom->tplm8;
                    $quatax8 = $ratesroom->quam8;
                    
                    //NIñOS
                    $chm21 = $ratesroom->chm21;
                    $chm32 = $ratesroom->chm32;
                    $chm43 = $ratesroom->chm43;
                    $chm54 = $ratesroom->chm54;
                    $chm65 = $ratesroom->chm65;
                    $chm76 = $ratesroom->chm76;
                    $chm87 = $ratesroom->chm87;
                    $chm98 = $ratesroom->chm98;
                    
                    $trip100 = $ratesroom->trip100;
                    $trip200 = $ratesroom->trip200;
                    $trip300 = $ratesroom->trip300;
                    $trip101 = $ratesroom->trip101;
                    $trip201 = $ratesroom->trip201;
                    $trip301 = $ratesroom->trip301;
                    $t_in = $ratesroom->t_in;
                    $t_out = $ratesroom->t_out;
                    $car_in = $ratesroom->car_in;
                    $car_out = $ratesroom->car_out;
                    $schv = $ratesroom->schv;
                    $schm = $ratesroom->schm;
                    
                     //FREEDAY CHILDREN
                    $fdm_adult21 = $ratesroom->fdm_adult21;
                    $fdm_child21 = $ratesroom->fdm_child21;
                    $fdm_adult32 = $ratesroom->fdm_adult32;
                    $fdm_child32 = $ratesroom->fdm_child32;
                    $fdm_adult43 = $ratesroom->fdm_adult43;
                    $fdm_child43 = $ratesroom->fdm_child43;
                    $fdm_adult54 = $ratesroom->fdm_adult54;
                    $fdm_child54 = $ratesroom->fdm_child54;
                    $fdm_adult65 = $ratesroom->fdm_adult65;
                    $fdm_child65 = $ratesroom->fdm_child65;
                    $fdm_adult76 = $ratesroom->fdm_adult76;
                    $fdm_child76 = $ratesroom->fdm_child76;
                    $fdm_adult87 = $ratesroom->fdm_adult87;
                    $fdm_child87 = $ratesroom->fdm_child87;
                    $fdm_adult98 = $ratesroom->fdm_adult98;
                    $fdm_child98 = $ratesroom->fdm_child98;
                           
                    //MODERATE
                    
                    $sqlt = $sgltax;
                    $dblt = $dbltax;
                    $tplt = $tpltax;
                    $quat = $quatax;
                    
                    $sqlt2 = $sgltax2;
                    $dblt2 = $dbltax2;
                    $tplt2 = $tpltax2;
                    $quat2 = $quatax2;
                    
                    $sqlt3 = $sgltax3;
                    $dblt3 = $dbltax3;
                    $tplt3 = $tpltax3;
                    $quat3 = $quatax3;
                    
                    $sqlt4 = $sgltax4;
                    $dblt4 = $dbltax4;
                    $tplt4 = $tpltax4;
                    $quat4 = $quatax4;
                    
                    $sqlt5 = $sgltax5;
                    $dblt5 = $dbltax5;
                    $tplt5 = $tpltax5;
                    $quat5 = $quatax5;

                    $sqlt6 = $sgltax6;
                    $dblt6 = $dbltax6;
                    $tplt6 = $tpltax6;
                    $quat6 = $quatax6;
                
                    $sqlt7 = $sgltax7;
                    $dblt7 = $dbltax7;
                    $tplt7 = $tpltax7;
                    $quat7 = $quatax7;
                
                    $sqlt8 = $sgltax8;
                    $dblt8 = $dbltax8;
                    $tplt8 = $tpltax8;
                    $quat8 = $quatax8;
                    
                    $chmo21 = $chm21;
                    $chmo32 = $chm32;
                    $chmo43 = $chm43;
                    $chmo54 = $chm54;
                    $chmo65 = $chm65;
                    $chmo76 = $chm76;
                    $chmo87 = $chm87;
                    $chmo98 = $chm98;
                    
                    $frdm_adult21   = $fdm_adult21;
                    $frdm_child21   = $fdm_child21;
                    $frdm_adult32   = $fdm_adult32;
                    $frdm_child32   = $fdm_child32;
                    $frdm_adult43   = $fdm_adult43;
                    $frdm_child43   = $fdm_child43;
                    $frdm_adult54   = $fdm_adult54;
                    $frdm_child54   = $fdm_child54;
                    $frdm_adult65   = $fdm_adult65;
                    $frdm_child65   = $fdm_child65;
                    $frdm_adult76   = $fdm_adult76;
                    $frdm_child76   = $fdm_child76;
                    $frdm_adult87   = $fdm_adult87;
                    $frdm_child87   = $fdm_child87;
                    $frdm_adult98   = $fdm_adult98;
                    $frdm_child98   = $fdm_child98;
                    
                    $trip_100  = $trip100;
                    $trip_200  = $trip200;
                    $trip_300  = $trip300;
                    $trip_101  = $trip101;
                    $trip_201  = $trip201;
                    $trip_301  = $trip301;
                    $tr_in     = $t_in;
                    $tr_out    = $t_out;
                    $tcar_in   = $car_in;
                    $tcar_out  = $car_out;
                    $sch_v     = $schv;
                    $sch_m     = $schm;
                    

//                  //$desayunotax = ((($porcentajes['tax'] / 100) * $ratesroom->brackfast) + ($ratesroom->brackfast));
               
                  Doo::db()->query("UPDATE comifijas SET sglm='$sqlt',dblm='$dblt',tplm='$tplt',quam='$quat',sglm2='$sqlt2',dblm2='$dblt2',tplm2='$tplt2',quam2='$quat2',sglm3='$sqlt3',dblm3='$dblt3',tplm3='$tplt3',quam3='$quat3',sglm4='$sqlt4',dblm4='$dblt4',tplm4='$tplt4',quam4='$quat4',sglm5='$sqlt5',dblm5='$dblt5',tplm5='$tplt5',quam5='$quat5',sglm6='$sqlt6',dblm6='$dblt6',tplm6='$tplt6',quam6='$quat6',sglm7='$sqlt7',dblm7='$dblt7',tplm7='$tplt7',quam7='$quat7',sglm8='$sqlt8',dblm8='$dblt8',tplm8='$tplt8',quam8='$quat8',chm21='$chmo21',chm32='$chmo32',chm43='$chmo43',chm54='$chmo54',chm65='$chmo65',chm76='$chmo76',chm87='$chmo87',chm98='$chmo98',fdm_adult21='$frdm_adult21',fdm_child21='$frdm_child21',fdm_adult32='$frdm_adult32',fdm_child32='$frdm_child32',fdm_adult43='$frdm_adult43',fdm_child43='$frdm_child43',fdm_adult54='$frdm_adult54',fdm_child54='$frdm_child54',fdm_adult65='$frdm_adult65',fdm_child65='$frdm_child65',fdm_adult76='$frdm_adult76',fdm_child76='$frdm_child76',fdm_adult87='$frdm_adult87',fdm_child87='$frdm_child87',fdm_adult98='$frdm_adult98',fdm_child98='$frdm_child98',trip100='$trip_100',trip200='$trip_200',trip300='$trip_300',trip101='$trip_101',trip201='$trip_201',trip301='$trip_301',t_in='$tr_in',t_out='$tr_out',car_in='$tcar_in ',car_out='$tcar_out',schv='$sch_v',schm='$sch_m' WHERE id_ratesvalid = '$id' AND id_hotel='30' AND fecha_ini='$ratesroom->fecha_ini' AND fecha_fin='$ratesroom->fecha_fin' AND comtax='1'");
                  
                  Doo::db()->query("UPDATE comifijas SET sglm='$sqlt',dblm='$dblt',tplm='$tplt',quam='$quat',sglm2='$sqlt2',dblm2='$dblt2',tplm2='$tplt2',quam2='$quat2',sglm3='$sqlt3',dblm3='$dblt3',tplm3='$tplt3',quam3='$quat3',sglm4='$sqlt4',dblm4='$dblt4',tplm4='$tplt4',quam4='$quat4',sglm5='$sqlt5',dblm5='$dblt5',tplm5='$tplt5',quam5='$quat5',sglm6='$sqlt6',dblm6='$dblt6',tplm6='$tplt6',quam6='$quat6',sglm7='$sqlt7',dblm7='$dblt7',tplm7='$tplt7',quam7='$quat7',sglm8='$sqlt8',dblm8='$dblt8',tplm8='$tplt8',quam8='$quat8',chm21='$chmo21',chm32='$chmo32',chm43='$chmo43',chm54='$chmo54',chm65='$chmo65',chm76='$chmo76',chm87='$chmo87',chm98='$chmo98',fdm_adult21='$frdm_adult21',fdm_child21='$frdm_child21',fdm_adult32='$frdm_adult32',fdm_child32='$frdm_child32',fdm_adult43='$frdm_adult43',fdm_child43='$frdm_child43',fdm_adult54='$frdm_adult54',fdm_child54='$frdm_child54',fdm_adult65='$frdm_adult65',fdm_child65='$frdm_child65',fdm_adult76='$frdm_adult76',fdm_child76='$frdm_child76',fdm_adult87='$frdm_adult87',fdm_child87='$frdm_child87',fdm_adult98='$frdm_adult98',fdm_child98='$frdm_child98',trip100='$trip_100',trip200='$trip_200',trip300='$trip_300',trip101='$trip_101',trip201='$trip_201',trip301='$trip_301',t_in='$tr_in',t_out='$tr_out',car_in='$tcar_in ',car_out='$tcar_out',schv='$sch_v',schm='$sch_m' WHERE id_ratesvalid = '$id' AND id_hotel='31' AND fecha_ini='$ratesroom->fecha_ini' AND fecha_fin='$ratesroom->fecha_fin' AND comtax='1'");
                  
                  Doo::db()->query("UPDATE comifijas SET sglm='$sqlt',dblm='$dblt',tplm='$tplt',quam='$quat',sglm2='$sqlt2',dblm2='$dblt2',tplm2='$tplt2',quam2='$quat2',sglm3='$sqlt3',dblm3='$dblt3',tplm3='$tplt3',quam3='$quat3',sglm4='$sqlt4',dblm4='$dblt4',tplm4='$tplt4',quam4='$quat4',sglm5='$sqlt5',dblm5='$dblt5',tplm5='$tplt5',quam5='$quat5',sglm6='$sqlt6',dblm6='$dblt6',tplm6='$tplt6',quam6='$quat6',sglm7='$sqlt7',dblm7='$dblt7',tplm7='$tplt7',quam7='$quat7',sglm8='$sqlt8',dblm8='$dblt8',tplm8='$tplt8',quam8='$quat8',chm21='$chmo21',chm32='$chmo32',chm43='$chmo43',chm54='$chmo54',chm65='$chmo65',chm76='$chmo76',chm87='$chmo87',chm98='$chmo98',fdm_adult21='$frdm_adult21',fdm_child21='$frdm_child21',fdm_adult32='$frdm_adult32',fdm_child32='$frdm_child32',fdm_adult43='$frdm_adult43',fdm_child43='$frdm_child43',fdm_adult54='$frdm_adult54',fdm_child54='$frdm_child54',fdm_adult65='$frdm_adult65',fdm_child65='$frdm_child65',fdm_adult76='$frdm_adult76',fdm_child76='$frdm_child76',fdm_adult87='$frdm_adult87',fdm_child87='$frdm_child87',fdm_adult98='$frdm_adult98',fdm_child98='$frdm_child98',trip100='$trip_100',trip200='$trip_200',trip300='$trip_300',trip101='$trip_101',trip201='$trip_201',trip301='$trip_301',t_in='$tr_in',t_out='$tr_out',car_in='$tcar_in ',car_out='$tcar_out',schv='$sch_v',schm='$sch_m' WHERE id_ratesvalid = '$id' AND id_hotel='34' AND fecha_ini='$ratesroom->fecha_ini' AND fecha_fin='$ratesroom->fecha_fin' AND comtax='1'");
                  
                  Doo::db()->query("UPDATE comifijas SET sglm='$sqlt',dblm='$dblt',tplm='$tplt',quam='$quat',sglm2='$sqlt2',dblm2='$dblt2',tplm2='$tplt2',quam2='$quat2',sglm3='$sqlt3',dblm3='$dblt3',tplm3='$tplt3',quam3='$quat3',sglm4='$sqlt4',dblm4='$dblt4',tplm4='$tplt4',quam4='$quat4',sglm5='$sqlt5',dblm5='$dblt5',tplm5='$tplt5',quam5='$quat5',sglm6='$sqlt6',dblm6='$dblt6',tplm6='$tplt6',quam6='$quat6',sglm7='$sqlt7',dblm7='$dblt7',tplm7='$tplt7',quam7='$quat7',sglm8='$sqlt8',dblm8='$dblt8',tplm8='$tplt8',quam8='$quat8',chm21='$chmo21',chm32='$chmo32',chm43='$chmo43',chm54='$chmo54',chm65='$chmo65',chm76='$chmo76',chm87='$chmo87',chm98='$chmo98',fdm_adult21='$frdm_adult21',fdm_child21='$frdm_child21',fdm_adult32='$frdm_adult32',fdm_child32='$frdm_child32',fdm_adult43='$frdm_adult43',fdm_child43='$frdm_child43',fdm_adult54='$frdm_adult54',fdm_child54='$frdm_child54',fdm_adult65='$frdm_adult65',fdm_child65='$frdm_child65',fdm_adult76='$frdm_adult76',fdm_child76='$frdm_child76',fdm_adult87='$frdm_adult87',fdm_child87='$frdm_child87',fdm_adult98='$frdm_adult98',fdm_child98='$frdm_child98',trip100='$trip_100',trip200='$trip_200',trip300='$trip_300',trip101='$trip_101',trip201='$trip_201',trip301='$trip_301',t_in='$tr_in',t_out='$tr_out',car_in='$tcar_in ',car_out='$tcar_out',schv='$sch_v',schm='$sch_m' WHERE id_ratesvalid = '$id' AND id_hotel='35' AND fecha_ini='$ratesroom->fecha_ini' AND fecha_fin='$ratesroom->fecha_fin' AND comtax='1'");
                  
                  Doo::db()->query("UPDATE comifijas SET sglm='$sqlt',dblm='$dblt',tplm='$tplt',quam='$quat',sglm2='$sqlt2',dblm2='$dblt2',tplm2='$tplt2',quam2='$quat2',sglm3='$sqlt3',dblm3='$dblt3',tplm3='$tplt3',quam3='$quat3',sglm4='$sqlt4',dblm4='$dblt4',tplm4='$tplt4',quam4='$quat4',sglm5='$sqlt5',dblm5='$dblt5',tplm5='$tplt5',quam5='$quat5',sglm6='$sqlt6',dblm6='$dblt6',tplm6='$tplt6',quam6='$quat6',sglm7='$sqlt7',dblm7='$dblt7',tplm7='$tplt7',quam7='$quat7',sglm8='$sqlt8',dblm8='$dblt8',tplm8='$tplt8',quam8='$quat8',chm21='$chmo21',chm32='$chmo32',chm43='$chmo43',chm54='$chmo54',chm65='$chmo65',chm76='$chmo76',chm87='$chmo87',chm98='$chmo98',fdm_adult21='$frdm_adult21',fdm_child21='$frdm_child21',fdm_adult32='$frdm_adult32',fdm_child32='$frdm_child32',fdm_adult43='$frdm_adult43',fdm_child43='$frdm_child43',fdm_adult54='$frdm_adult54',fdm_child54='$frdm_child54',fdm_adult65='$frdm_adult65',fdm_child65='$frdm_child65',fdm_adult76='$frdm_adult76',fdm_child76='$frdm_child76',fdm_adult87='$frdm_adult87',fdm_child87='$frdm_child87',fdm_adult98='$frdm_adult98',fdm_child98='$frdm_child98',trip100='$trip_100',trip200='$trip_200',trip300='$trip_300',trip101='$trip_101',trip201='$trip_201',trip301='$trip_301',t_in='$tr_in',t_out='$tr_out',car_in='$tcar_in ',car_out='$tcar_out',schv='$sch_v',schm='$sch_m' WHERE id_ratesvalid = '$id' AND id_hotel='41' AND fecha_ini='$ratesroom->fecha_ini' AND fecha_fin='$ratesroom->fecha_fin' AND comtax='1'");
                  
                  Doo::db()->query("UPDATE comifijas SET sglm='$sqlt',dblm='$dblt',tplm='$tplt',quam='$quat',sglm2='$sqlt2',dblm2='$dblt2',tplm2='$tplt2',quam2='$quat2',sglm3='$sqlt3',dblm3='$dblt3',tplm3='$tplt3',quam3='$quat3',sglm4='$sqlt4',dblm4='$dblt4',tplm4='$tplt4',quam4='$quat4',sglm5='$sqlt5',dblm5='$dblt5',tplm5='$tplt5',quam5='$quat5',sglm6='$sqlt6',dblm6='$dblt6',tplm6='$tplt6',quam6='$quat6',sglm7='$sqlt7',dblm7='$dblt7',tplm7='$tplt7',quam7='$quat7',sglm8='$sqlt8',dblm8='$dblt8',tplm8='$tplt8',quam8='$quat8',chm21='$chmo21',chm32='$chmo32',chm43='$chmo43',chm54='$chmo54',chm65='$chmo65',chm76='$chmo76',chm87='$chmo87',chm98='$chmo98',fdm_adult21='$frdm_adult21',fdm_child21='$frdm_child21',fdm_adult32='$frdm_adult32',fdm_child32='$frdm_child32',fdm_adult43='$frdm_adult43',fdm_child43='$frdm_child43',fdm_adult54='$frdm_adult54',fdm_child54='$frdm_child54',fdm_adult65='$frdm_adult65',fdm_child65='$frdm_child65',fdm_adult76='$frdm_adult76',fdm_child76='$frdm_child76',fdm_adult87='$frdm_adult87',fdm_child87='$frdm_child87',fdm_adult98='$frdm_adult98',fdm_child98='$frdm_child98',trip100='$trip_100',trip200='$trip_200',trip300='$trip_300',trip101='$trip_101',trip201='$trip_201',trip301='$trip_301',t_in='$tr_in',t_out='$tr_out',car_in='$tcar_in ',car_out='$tcar_out',schv='$sch_v',schm='$sch_m' WHERE id_ratesvalid = '$id' AND id_hotel='42' AND fecha_ini='$ratesroom->fecha_ini' AND fecha_fin='$ratesroom->fecha_fin' AND comtax='1'");
                  
                  Doo::db()->query("UPDATE comifijas SET sglm='$sqlt',dblm='$dblt',tplm='$tplt',quam='$quat',sglm2='$sqlt2',dblm2='$dblt2',tplm2='$tplt2',quam2='$quat2',sglm3='$sqlt3',dblm3='$dblt3',tplm3='$tplt3',quam3='$quat3',sglm4='$sqlt4',dblm4='$dblt4',tplm4='$tplt4',quam4='$quat4',sglm5='$sqlt5',dblm5='$dblt5',tplm5='$tplt5',quam5='$quat5',sglm6='$sqlt6',dblm6='$dblt6',tplm6='$tplt6',quam6='$quat6',sglm7='$sqlt7',dblm7='$dblt7',tplm7='$tplt7',quam7='$quat7',sglm8='$sqlt8',dblm8='$dblt8',tplm8='$tplt8',quam8='$quat8',chm21='$chmo21',chm32='$chmo32',chm43='$chmo43',chm54='$chmo54',chm65='$chmo65',chm76='$chmo76',chm87='$chmo87',chm98='$chmo98',fdm_adult21='$frdm_adult21',fdm_child21='$frdm_child21',fdm_adult32='$frdm_adult32',fdm_child32='$frdm_child32',fdm_adult43='$frdm_adult43',fdm_child43='$frdm_child43',fdm_adult54='$frdm_adult54',fdm_child54='$frdm_child54',fdm_adult65='$frdm_adult65',fdm_child65='$frdm_child65',fdm_adult76='$frdm_adult76',fdm_child76='$frdm_child76',fdm_adult87='$frdm_adult87',fdm_child87='$frdm_child87',fdm_adult98='$frdm_adult98',fdm_child98='$frdm_child98',trip100='$trip_100',trip200='$trip_200',trip300='$trip_300',trip101='$trip_101',trip201='$trip_201',trip301='$trip_301',t_in='$tr_in',t_out='$tr_out',car_in='$tcar_in ',car_out='$tcar_out',schv='$sch_v',schm='$sch_m' WHERE id_ratesvalid = '$id' AND id_hotel='47' AND fecha_ini='$ratesroom->fecha_ini' AND fecha_fin='$ratesroom->fecha_fin' AND comtax='1'");
             
                  Doo::db()->query("UPDATE comifijas SET sglm='$sqlt',dblm='$dblt',tplm='$tplt',quam='$quat',sglm2='$sqlt2',dblm2='$dblt2',tplm2='$tplt2',quam2='$quat2',sglm3='$sqlt3',dblm3='$dblt3',tplm3='$tplt3',quam3='$quat3',sglm4='$sqlt4',dblm4='$dblt4',tplm4='$tplt4',quam4='$quat4',sglm5='$sqlt5',dblm5='$dblt5',tplm5='$tplt5',quam5='$quat5',sglm6='$sqlt6',dblm6='$dblt6',tplm6='$tplt6',quam6='$quat6',sglm7='$sqlt7',dblm7='$dblt7',tplm7='$tplt7',quam7='$quat7',sglm8='$sqlt8',dblm8='$dblt8',tplm8='$tplt8',quam8='$quat8',chm21='$chmo21',chm32='$chmo32',chm43='$chmo43',chm54='$chmo54',chm65='$chmo65',chm76='$chmo76',chm87='$chmo87',chm98='$chmo98',fdm_adult21='$frdm_adult21',fdm_child21='$frdm_child21',fdm_adult32='$frdm_adult32',fdm_child32='$frdm_child32',fdm_adult43='$frdm_adult43',fdm_child43='$frdm_child43',fdm_adult54='$frdm_adult54',fdm_child54='$frdm_child54',fdm_adult65='$frdm_adult65',fdm_child65='$frdm_child65',fdm_adult76='$frdm_adult76',fdm_child76='$frdm_child76',fdm_adult87='$frdm_adult87',fdm_child87='$frdm_child87',fdm_adult98='$frdm_adult98',fdm_child98='$frdm_child98',trip100='$trip_100',trip200='$trip_200',trip300='$trip_300',trip101='$trip_101',trip201='$trip_201',trip301='$trip_301',t_in='$tr_in',t_out='$tr_out',car_in='$tcar_in ',car_out='$tcar_out',schv='$sch_v',schm='$sch_m' WHERE id_ratesvalid = '$id' AND id_hotel='48' AND fecha_ini='$ratesroom->fecha_ini' AND fecha_fin='$ratesroom->fecha_fin' AND comtax='1'");    
               

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
        Doo::loadModel("Tarifastrip"); 
        $ratesroom = new Ratesroom();  
        $tarifastrip = new Tarifastrip();
        
        $ratesroom->id = $this->params["pindex"];        
        //$tarifastrip->id = $this->params["pindex"];
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['ratesroom'] = Doo::db()->find($ratesroom, array('limit' => 1));        
        //$this->data['Tarifastrip'] = Doo::db()->find($tarifastrip, array('limit' => 1));
        $this->data['hotel'] = Doo::db()->find("Hoteles", array("select id,nombre from hoteles", "asArray" => true));
        $this->data['content'] = 'configuracion/frm_rrates.php';
        $this->data['dato'] = "edit";
        $this->view()->renderc('admin/index', $this->data);
    }

    public function delete() {
        Doo::loadModel("Ratesroom");
        Doo::loadModel("Tarifastrip"); 
        $ratesroom = new Ratesroom();              
        $tarifastrip = new Tarifastrip();
        
        $ratesroom->id = $_REQUEST['item'];
        //$tarifastrip->id = $_REQUEST['item'];
        
        Doo::db()->delete($ratesroom);        

        Doo::db()->query("DELETE FROM  comifijas
								WHERE id_ratesvalid = $ratesroom->id");
               
//        Doo::db()->delete($tarifastrip);
//        
//        Doo::db()->query("DELETE FROM  tarifastrip
//								WHERE id_ratesvalid = $ratesroom->id");
        return Doo::conf()->APP_URL . "admin/tours/room-rates";
        
    }

}

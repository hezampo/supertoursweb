<?php

/**
 * Description of RatesroomController
 *
 *
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
        $ano = strtotime(date("2016") . "-01-01");

        $sql = "select count(*) as total  from (SELECT t1.id,t1.id_hotel,t1.fecha_ini,t1.fecha_fin,t2.nombre,type_rate,pax1v_21
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

        $rs = Doo::db()->query("SELECT t1.id,t1.id_hotel,t1.fecha_ini,t1.fecha_fin,t1.rate,type_rate,pax1v_21
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
        Doo::loadModel("Hoteles");

        $hoteles = new Hoteles();
        //Doo::loadModel("Tarifastrip");
        $ratesroom = new Ratesroom();
        //$tarifastrip = new Tarifastrip();
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['ratesroom'] = $ratesroom;
        //$this->data['Tarifastrip'] = $tarifastrip;
        $this->data['hotel'] = Doo::db()->find("hoteles", array("select id,nombre from hoteles", "asArray" => true));
        $this->data['content'] = 'configuracion/frm_rrates.php';
        $this->data['dato'] = "New";
        $this->renderc('admin/index', $this->data);
    }
    
    public function add_comi() {
        Doo::loadModel("Ratesroom");
        Doo::loadModel("Hoteles");

        $hoteles = new Hoteles();
        //Doo::loadModel("Tarifastrip");
        $ratesroom = new Ratesroom();
        //$tarifastrip = new Tarifastrip();
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['ratesroom'] = $ratesroom;
        //$this->data['Tarifastrip'] = $tarifastrip;
        $this->data['hotel'] = Doo::db()->find("hoteles", array("select id,nombre from hoteles", "asArray" => true));
        $this->data['content'] = 'configuracion/frm_rrates_commissionable.php';
        $this->data['dato'] = "New";
        $this->renderc('admin/index', $this->data);
    }

    public function save() {


        Doo::loadModel("Ratesroom");
        Doo::loadModel("Tarifastrip");
        Doo::loadModel("Tarifasplane");
        Doo::loadModel("Tarifascar");
        DOO::loadModel("Comifijas");
        //'45,11,78';
        
        $ratesroom = new Ratesroom($_POST);
        $tarifastrip = new Tarifastrip();
        $tarifasplane = new Tarifasplane();
        $tarifascar = new Tarifascar();
        $comifijas = new Comifijas();
        
        
        
        $pax1v_21 = $_POST['pax1v_21'];  
        $pax2v_21 = $_POST['pax2v_21'];
        $pax1m_21 = $_POST['pax1m_21'];
        $pax2m_21 = $_POST['pax2m_21'];

        $pax1v_32 = $_POST['pax1v_32'];
        $pax2v_32 = $_POST['pax2v_32'];
        $pax1m_32 = $_POST['pax1m_32'];
        $pax2m_32 = $_POST['pax2m_32'];

        $pax1v_43 = $_POST['pax1v_43'];
        $pax2v_43 = $_POST['pax2v_43'];
        $pax1m_43 = $_POST['pax1m_43'];
        $pax2m_43 = $_POST['pax2m_43'];

        $pax1v_54 = $_POST['pax1v_54'];
        $pax2v_54 = $_POST['pax2v_54'];
        $pax1m_54 = $_POST['pax1m_54'];
        $pax2m_54 = $_POST['pax2m_54'];

        $pax1v_65 = $_POST['pax1v_65'];
        $pax2v_65 = $_POST['pax2v_65'];
        $pax1m_65 = $_POST['pax1m_65'];
        $pax2m_65 = $_POST['pax2m_65'];

        $pax1v_76 = $_POST['pax1v_76'];
        $pax2v_76 = $_POST['pax2v_76'];
        $pax1m_76 = $_POST['pax1m_76'];
        $pax2m_76 = $_POST['pax2m_76'];

        $pax1v_87 = $_POST['pax1v_87'];
        $pax2v_87 = $_POST['pax2v_87'];
        $pax1m_87 = $_POST['pax1m_87'];
        $pax2m_87 = $_POST['pax2m_87'];

        $pax1v_98 = $_POST['pax1v_98'];
        $pax2v_98 = $_POST['pax2v_98'];
        $pax1m_98 = $_POST['pax1m_98'];
        $pax2m_98 = $_POST['pax2m_98'];
        
        //echo ("<pre>");//
//            print($pax1v_21);
//            print($pax2v_21);
//            print($pax1m_21);
//            print($pax2m_21);            

        //echo ("</pre>");
        //exit;

        
        

        $idtour = $_POST['id'];
        
        $fecha_iniciale = $_POST['fecha_schv'];        
        $fecha_finale = $_POST['fecha_schm'];
        
        $fecha_iniciale2 = $_POST['fecha_schv2'];
        $fecha_finale2 = $_POST['fecha_schm2'];
        
        $fecha_iniciale3 = $_POST['fecha_schv3'];
        $fecha_finale3 = $_POST['fecha_schm3'];
        
        $fecha_iniciale4 = $_POST['fecha_schv4'];
        $fecha_finale4 = $_POST['fecha_schm4'];        

        
        $agen = $_POST['sodastereo'];
        $agencias = explode(",", $agen);
        $tour_name = $_POST['rate'];

        //echo $special_price_name;
        for ($aux = 0; $aux < count($agencias); $aux++) {
            $lista = array(
                "agencia" => $agen,
                "idTour" => $idtour,
                "agencias" => $agencias,
                "tourname" => $tour_name
            );
            //print_r($lista);
            //exit();
            Doo::db()->query("UPDATE agencia SET id_tour='$idtour', tour_name='$tour_name'  WHERE id ='$agencias[$aux]'");
            //print $agencias[$aux] . "<br>";
        }



        



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

                Doo::db()->insert($tarifastrip);
                Doo::db()->insert($tarifasplane);
                Doo::db()->insert($tarifascar);
                Doo::db()->insert($comifijas);
                

                for ($aux = 0; $aux < count($agencias); $aux++) {
                    $lista = array(
                        "agencia" => $agen,
                        "idTour" => $idtour,
                        "agencias" => $agencias,
                        "tourname" => $tour_name
                    );
                    //print_r($lista);
                    //exit();
                    Doo::db()->query("UPDATE agencia SET id_tour='$id', tour_name='$tour_name'  WHERE id ='$agencias[$aux]'");
                    //print $agencias[$aux] . "<br>";
                }



//                Doo::db()->beginTransaction();
//                Doo::db()->insert($tarifastrip);
//                $id = Doo::db()->lastInsertId();
//                                
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
                $trip100c = $ratesroom->trip100c;
                $trip200c = $ratesroom->trip200c;
                $trip300c = $ratesroom->trip300c;
                $trip101c = $ratesroom->trip101c;
                $trip201c = $ratesroom->trip201c;
                $trip301c = $ratesroom->trip301c;

                $t_in = $ratesroom->t_in;
                $t_out = $ratesroom->t_out;
                $car_in = $ratesroom->car_in;
                $car_out = $ratesroom->car_out;
                
                $schv = $ratesroom->schv;
                $schm = $ratesroom->schm;
                
                $schv2 = $ratesroom->schv2;
                $schm2 = $ratesroom->schm2;
                
                $schv3 = $ratesroom->schv3;
                $schm3 = $ratesroom->schm3;
                
                $schv4 = $ratesroom->schv4;
                $schm4 = $ratesroom->schm4;
                
                $dup = $ratesroom->dupli;




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


                $frdv_adult21 = $fdv_adult21;
                $frdv_child21 = $fdv_child21;
                $frdv_adult32 = $fdv_adult32;
                $frdv_child32 = $fdv_child32;
                $frdv_adult43 = $fdv_adult43;
                $frdv_child43 = $fdv_child43;
                $frdv_adult54 = $fdv_adult54;
                $frdv_child54 = $fdv_child54;
                $frdv_adult65 = $fdv_adult65;
                $frdv_child65 = $fdv_child65;
                $frdv_adult76 = $fdv_adult76;
                $frdv_child76 = $fdv_child76;
                $frdv_adult87 = $fdv_adult87;
                $frdv_child87 = $fdv_child87;
                $frdv_adult98 = $fdv_adult98;
                $frdv_child98 = $fdv_child98;

                $trip_100 = $trip100;
                $trip_200 = $trip200;
                $trip_300 = $trip300;
                $trip_101 = $trip101;
                $trip_201 = $trip201;
                $trip_301 = $trip301;

                $trip_100c = $trip100c;
                $trip_200c = $trip200c;
                $trip_300c = $trip300c;
                $trip_101c = $trip101c;
                $trip_201c = $trip201c;
                $trip_301c = $trip301c;

                $tr_in = $t_in;
                $tr_in2 = 2 * $t_in;
                $tr_in3 = 3 * $t_in;
                $tr_in4 = 4 * $t_in;
                $tr_in5 = 5 * $t_in;
                $tr_in6 = 6 * $t_in;
                $tr_in7 = 7 * $t_in;
                $tr_in8 = 8 * $t_in;
                $tr_in9 = 9 * $t_in;
                $tr_in10 = 10 * $t_in;
                $tr_in11 = 11 * $t_in;
                $tr_in12 = 12 * $t_in;
                $tr_in13 = 13 * $t_in;
                $tr_in14 = 14 * $t_in;
                $tr_in15 = 15 * $t_in;



                $anio_act1 = $anyo . '-01-01 00:00:00';
                $anio_act = $anyo2 . '-01-01 00:00:00';

                $tr_out = $t_out;
                $tcar_in = $car_in;
                $tcar_out = $car_out;
                
                $sch_v = $schv;
                $sch_m = $schm;
                
                $sch_v2 = $schv2;
                $sch_m2 = $schm2;
                
                $sch_v3 = $schv3;
                $sch_m3 = $schm3;
                
                $sch_v4 = $schv4;
                $sch_m4 = $schm4;
                
                $dup_m = $dup;




                //CHILDREN MODERATE
                $chmo21 = $chm21;
                $chmo32 = $chm32;
                $chmo43 = $chm43;
                $chmo54 = $chm54;
                $chmo65 = $chm65;
                $chmo76 = $chm76;
                $chmo87 = $chm87;
                $chmo98 = $chm98;

                $frdm_adult21 = $fdm_adult21;
                $frdm_child21 = $fdm_child21;
                $frdm_adult32 = $fdm_adult32;
                $frdm_child32 = $fdm_child32;
                $frdm_adult43 = $fdm_adult43;
                $frdm_child43 = $fdm_child43;
                $frdm_adult54 = $fdm_adult54;
                $frdm_child54 = $fdm_child54;
                $frdm_adult65 = $fdm_adult65;
                $frdm_child65 = $fdm_child65;
                $frdm_adult76 = $fdm_adult76;
                $frdm_child76 = $fdm_child76;
                $frdm_adult87 = $fdm_adult87;
                $frdm_child87 = $fdm_child87;
                $frdm_adult98 = $fdm_adult98;
                $frdm_child98 = $fdm_child98;



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
                
                //HOTEL VALUE

                $sql1 = "SELECT id FROM hoteles WHERE categoria ='2' ORDER BY id ASC";
                $rs1 = Doo::db()->query($sql1);
                $idvalue = $rs1->fetchAll();
                
                foreach ($idvalue as $idv){
                    

                $idaux = $idv['id'];
                    
                    

                Doo::db()->query("INSERT INTO comifijas
                       (id_hotel,categoria,sgl,dbl,tpl,qua,sgl2,dbl2,tpl2,qua2,sgl3,dbl3,tpl3,qua3,sgl4,dbl4,tpl4,qua4,
                        sgl5,dbl5,tpl5,qua5,sgl6,dbl6,tpl6,qua6,sgl7,dbl7,tpl7,qua7,sgl8,dbl8,tpl8,qua8,chv21,chv32,chv43,
                        chv54,chv65,chv76,chv87,chv98,costax,netax,comtax,id_ratesvalid,breackfast,fecha_ini,fecha_fin,
                        fdv_adult21,fdv_child21,fdv_adult32,fdv_child32,fdv_adult43,fdv_child43,fdv_adult54,fdv_child54,
                        fdv_adult65,fdv_child65,fdv_adult76,fdv_child76,fdv_adult87,fdv_child87,fdv_adult98,fdv_child98,
                        trip100,trip200,trip300,trip101,trip201,trip301,trip100c,trip200c,trip300c,trip101c,trip201c,trip301c,
                        t_in,t_out,car_in,car_out,schv,schm,schv2,schm2,schv3,schm3,schv4,schm4,dupli,
                        fecha_schv,fecha_schm,fecha_schv2,fecha_schm2,fecha_schv3,fecha_schm3,fecha_schv4,fecha_schm4,
                        pax1v_21,pax2v_21,pax1m_21,pax2m_21,pax1v_32,pax2v_32,pax1m_32,pax2m_32,pax1v_43,pax2v_43,pax1m_43,pax2m_43,
                        pax1v_54,pax2v_54,pax1m_54,pax2m_54,pax1v_65,pax2v_65,pax1m_65,pax2m_65,pax1v_76,pax2v_76,pax1m_76,pax2m_76,
                        pax1v_87,pax2v_87,pax1m_87,pax2m_87,pax1v_98,pax2v_98,pax1m_98,pax2m_98)
                VALUES ('$idaux','2','$sqlt1','$dblt1','$tplt1','$quat1','$sqlt22','$dblt22','$tplt22','$quat22','$sqlt33','$dblt33','$tplt33','$quat33','$sqlt44','$dblt44','$tplt44','$quat44','$sqlt55','$dblt55','$tplt55','$quat55','$sqlt66','$dblt66','$tplt66','$quat66','$sqlt77','$dblt77','$tplt77','$quat77','$sqlt88','$dblt88','$tplt88','$quat88','$chva21','$chva32','$chva43','$chva54','$chva65','$chva76','$chva87','$chva98','0','0','1','$id','$desayunotax','$ratesroom->fecha_ini','$ratesroom->fecha_fin','$frdv_adult21','$frdv_child21','$frdv_adult32','$frdv_child32','$frdv_adult43','$frdv_child43','$frdv_adult54','$frdv_child54','$frdv_adult65','$frdv_child65','$frdv_adult76','$frdv_child76','$frdv_adult87','$frdv_child87','$frdv_adult98','$frdv_child98','$trip_100','$trip_200','$trip_300','$trip_101','$trip_201','$trip_301','$trip_100c','$trip_200c','$trip_300c','$trip_101c','$trip_201c','$trip_301c','$tr_in','$tr_out','$tcar_in','$tcar_out','$sch_v','$sch_m','$sch_v2','$sch_m2','$sch_v3','$sch_m3','$sch_v4','$sch_m4','$dup_m','$fecha_iniciale','$fecha_finale','$fecha_iniciale2','$fecha_finale2','$fecha_iniciale3','$fecha_finale3','$fecha_iniciale4','$fecha_finale4','$pax1v_21','$pax2v_21','','','$pax1v_32','$pax2v_32','','','$pax1v_43','$pax2v_43','','','$pax1v_54','$pax2v_54','','','$pax1v_65','$pax2v_65','','','$pax1v_76','$pax2v_76','','','$pax1v_87','$pax2v_87','','','$pax1v_98','$pax2v_98','','');");

                }
               

                //TARIFAS TRIP



                if ($anio_act1 == $anio_act) {

                    Doo::db()->query("INSERT INTO tarifastrip
                       (trip_no, adult, child, type_rate, id_agency, annio, id_ratesvalid)
            VALUES ('100','$trip_100','$trip_100c','1','-1','$anio_act','$id');");

                    Doo::db()->query("INSERT INTO tarifastrip
                       (trip_no, adult, child, type_rate, id_agency, annio, id_ratesvalid)
            VALUES ('200','$trip_200','$trip_200c','1','-1','$anio_act','$id');");

                    Doo::db()->query("INSERT INTO tarifastrip
                       (trip_no, adult, child, type_rate, id_agency, annio, id_ratesvalid)
            VALUES ('300','$trip_300','$trip_300c','1','-1','$anio_act','$id');");

                    Doo::db()->query("INSERT INTO tarifastrip
                       (trip_no, adult, child, type_rate, id_agency, annio, id_ratesvalid)
            VALUES ('101','$trip_101','$trip_101c','1','-1','$anio_act','$id');");

                    Doo::db()->query("INSERT INTO tarifastrip
                       (trip_no, adult, child, type_rate, id_agency, annio, id_ratesvalid)
            VALUES ('201','$trip_201','$trip_201c','1','-1','$anio_act','$id');");

                    Doo::db()->query("INSERT INTO tarifastrip
                       (trip_no, adult, child, type_rate, id_agency, annio, id_ratesvalid)
            VALUES ('301','$trip_301','$trip_301c','1','-1','$anio_act','$id');");


                    Doo::db()->query("INSERT INTO tarifastrip
                       (trip_no, adult, child, type_rate, id_agency, annio, id_ratesvalid)
            VALUES ('100','$trip_100','$trip_100c','0','-1','$anio_act','$id');");

                    Doo::db()->query("INSERT INTO tarifastrip
                       (trip_no, adult, child, type_rate, id_agency, annio, id_ratesvalid)
            VALUES ('200','$trip_200','$trip_200c','0','-1','$anio_act','$id');");

                    Doo::db()->query("INSERT INTO tarifastrip
                       (trip_no, adult, child, type_rate, id_agency, annio, id_ratesvalid)
            VALUES ('300','$trip_300','$trip_300c','0','-1','$anio_act','$id');");

                    Doo::db()->query("INSERT INTO tarifastrip
                       (trip_no, adult, child, type_rate, id_agency, annio, id_ratesvalid)
            VALUES ('101','$trip_101','$trip_101c','0','-1','$anio_act','$id');");

                    Doo::db()->query("INSERT INTO tarifastrip
                       (trip_no, adult, child, type_rate, id_agency, annio, id_ratesvalid)
            VALUES ('201','$trip_201','$trip_201c','0','-1','$anio_act','$id');");

                    Doo::db()->query("INSERT INTO tarifastrip
                       (trip_no, adult, child, type_rate, id_agency, annio, id_ratesvalid)
            VALUES ('301','$trip_301','$trip_301c','0','-1','$anio_act','$id');");
                }

                if ($anio_act1 != $anio_act) {

                    Doo::db()->query("INSERT INTO tarifastrip
                       (trip_no, adult, child, type_rate, id_agency, annio, id_ratesvalid)
            VALUES ('100','$trip_100','$trip_100c','1','-1','$anio_act','$id');");

                    Doo::db()->query("INSERT INTO tarifastrip
                       (trip_no, adult, child, type_rate, id_agency, annio, id_ratesvalid)
            VALUES ('200','$trip_200','$trip_200c','1','-1','$anio_act','$id');");

                    Doo::db()->query("INSERT INTO tarifastrip
                       (trip_no, adult, child, type_rate, id_agency, annio, id_ratesvalid)
            VALUES ('300','$trip_300','$trip_300c','1','-1','$anio_act','$id');");

                    Doo::db()->query("INSERT INTO tarifastrip
                       (trip_no, adult, child, type_rate, id_agency, annio, id_ratesvalid)
            VALUES ('101','$trip_101','$trip_101c','1','-1','$anio_act','$id');");

                    Doo::db()->query("INSERT INTO tarifastrip
                       (trip_no, adult, child, type_rate, id_agency, annio, id_ratesvalid)
            VALUES ('201','$trip_201','$trip_201c','1','-1','$anio_act','$id');");

                    Doo::db()->query("INSERT INTO tarifastrip
                       (trip_no, adult, child, type_rate, id_agency, annio, id_ratesvalid)
            VALUES ('301','$trip_301','$trip_301c','1','-1','$anio_act','$id');");


                    Doo::db()->query("INSERT INTO tarifastrip
                       (trip_no, adult, child, type_rate, id_agency, annio, id_ratesvalid)
            VALUES ('100','$trip_100','$trip_100c','0','-1','$anio_act','$id');");

                    Doo::db()->query("INSERT INTO tarifastrip
                       (trip_no, adult, child, type_rate, id_agency, annio, id_ratesvalid)
            VALUES ('200','$trip_200','$trip_200c','0','-1','$anio_act','$id');");

                    Doo::db()->query("INSERT INTO tarifastrip
                       (trip_no, adult, child, type_rate, id_agency, annio, id_ratesvalid)
            VALUES ('300','$trip_300','$trip_300c','0','-1','$anio_act','$id');");

                    Doo::db()->query("INSERT INTO tarifastrip
                       (trip_no, adult, child, type_rate, id_agency, annio, id_ratesvalid)
            VALUES ('101','$trip_101','$trip_101c','0','-1','$anio_act','$id');");

                    Doo::db()->query("INSERT INTO tarifastrip
                       (trip_no, adult, child, type_rate, id_agency, annio, id_ratesvalid)
            VALUES ('201','$trip_201','$trip_201c','0','-1','$anio_act','$id');");

                    Doo::db()->query("INSERT INTO tarifastrip
                       (trip_no, adult, child, type_rate, id_agency, annio, id_ratesvalid)
            VALUES ('301','$trip_301','$trip_301c','0','-1','$anio_act','$id');");


                    Doo::db()->query("INSERT INTO tarifastrip
                       (trip_no, adult, child, type_rate, id_agency, annio, id_ratesvalid)
            VALUES ('100','$trip_100','$trip_100c','1','-1','$anio_act1','$id');");

                    Doo::db()->query("INSERT INTO tarifastrip
                       (trip_no, adult, child, type_rate, id_agency, annio, id_ratesvalid)
            VALUES ('200','$trip_200','$trip_200c','1','-1','$anio_act1','$id');");

                    Doo::db()->query("INSERT INTO tarifastrip
                       (trip_no, adult, child, type_rate, id_agency, annio, id_ratesvalid)
            VALUES ('300','$trip_300','$trip_300c','1','-1','$anio_act1','$id');");

                    Doo::db()->query("INSERT INTO tarifastrip
                       (trip_no, adult, child, type_rate, id_agency, annio, id_ratesvalid)
            VALUES ('101','$trip_101','$trip_101c','1','-1','$anio_act1','$id');");

                    Doo::db()->query("INSERT INTO tarifastrip
                       (trip_no, adult, child, type_rate, id_agency, annio, id_ratesvalid)
            VALUES ('201','$trip_201','$trip_201c','1','-1','$anio_act1','$id');");

                    Doo::db()->query("INSERT INTO tarifastrip
                       (trip_no, adult, child, type_rate, id_agency, annio, id_ratesvalid)
            VALUES ('301','$trip_301','$trip_301c','1','-1','$anio_act1','$id');");


                    Doo::db()->query("INSERT INTO tarifastrip
                       (trip_no, adult, child, type_rate, id_agency, annio, id_ratesvalid)
            VALUES ('100','$trip_100','$trip_100c','0','-1','$anio_act1','$id');");

                    Doo::db()->query("INSERT INTO tarifastrip
                       (trip_no, adult, child, type_rate, id_agency, annio, id_ratesvalid)
            VALUES ('200','$trip_200','$trip_200c','0','-1','$anio_act1','$id');");

                    Doo::db()->query("INSERT INTO tarifastrip
                       (trip_no, adult, child, type_rate, id_agency, annio, id_ratesvalid)
            VALUES ('300','$trip_300','$trip_300c','0','-1','$anio_act1','$id');");

                    Doo::db()->query("INSERT INTO tarifastrip
                       (trip_no, adult, child, type_rate, id_agency, annio, id_ratesvalid)
            VALUES ('101','$trip_101','$trip_101c','0','-1','$anio_act1','$id');");

                    Doo::db()->query("INSERT INTO tarifastrip
                       (trip_no, adult, child, type_rate, id_agency, annio, id_ratesvalid)
            VALUES ('201','$trip_201','$trip_201c','0','-1','$anio_act1','$id');");

                    Doo::db()->query("INSERT INTO tarifastrip
                       (trip_no, adult, child, type_rate, id_agency, annio, id_ratesvalid)
            VALUES ('301','$trip_301','$trip_301c','0','-1','$anio_act1','$id');");
                }


                if ($anio_act1 == $anio_act) {
                    //TARIFAS PLANE   type_rate 1

                    Doo::db()->query("INSERT INTO tarifaplane
                       (cantidad, price, type_rate, id_agency, annio, id_ratesvalid)
            VALUES ('1','$tr_in','1','-1','$anio_act','$id');");

                    Doo::db()->query("INSERT INTO tarifaplane
                       (cantidad, price, type_rate, id_agency, annio, id_ratesvalid)
            VALUES ('2','$tr_in2','1','-1','$anio_act','$id');");

                    Doo::db()->query("INSERT INTO tarifaplane
                       (cantidad, price, type_rate, id_agency, annio, id_ratesvalid)
            VALUES ('3','$tr_in3','1','-1','$anio_act','$id');");

                    Doo::db()->query("INSERT INTO tarifaplane
                       (cantidad, price, type_rate, id_agency, annio, id_ratesvalid)
            VALUES ('4','$tr_in4','1','-1','$anio_act','$id');");

                    Doo::db()->query("INSERT INTO tarifaplane
                       (cantidad, price, type_rate, id_agency, annio, id_ratesvalid)
            VALUES ('5','$tr_in5','1','-1','$anio_act','$id');");

                    Doo::db()->query("INSERT INTO tarifaplane
                       (cantidad, price, type_rate, id_agency, annio, id_ratesvalid)
            VALUES ('6','$tr_in6','1','-1','$anio_act','$id');");

                    Doo::db()->query("INSERT INTO tarifaplane
                       (cantidad, price, type_rate, id_agency, annio, id_ratesvalid)
            VALUES ('7','$tr_in7','1','-1','$anio_act','$id');");

                    Doo::db()->query("INSERT INTO tarifaplane
                       (cantidad, price, type_rate, id_agency, annio, id_ratesvalid)
            VALUES ('8','$tr_in8','1','-1','$anio_act','$id');");

                    Doo::db()->query("INSERT INTO tarifaplane
                       (cantidad, price, type_rate, id_agency, annio, id_ratesvalid)
            VALUES ('9','$tr_in9','1','-1','$anio_act','$id');");

                    Doo::db()->query("INSERT INTO tarifaplane
                       (cantidad, price, type_rate, id_agency, annio, id_ratesvalid)
            VALUES ('10','$tr_in10','1','-1','$anio_act','$id');");

                    Doo::db()->query("INSERT INTO tarifaplane
                       (cantidad, price, type_rate, id_agency, annio, id_ratesvalid)
            VALUES ('11','$tr_in11','1','-1','$anio_act','$id');");

                    Doo::db()->query("INSERT INTO tarifaplane
                       (cantidad, price, type_rate, id_agency, annio, id_ratesvalid)
            VALUES ('12','$tr_in12','1','-1','$anio_act','$id');");

                    Doo::db()->query("INSERT INTO tarifaplane
                       (cantidad, price, type_rate, id_agency, annio, id_ratesvalid)
            VALUES ('13','$tr_in13','1','-1','$anio_act','$id');");

                    Doo::db()->query("INSERT INTO tarifaplane
                       (cantidad, price, type_rate, id_agency, annio, id_ratesvalid)
            VALUES ('14','$tr_in14','1','-1','$anio_act','$id');");

                    Doo::db()->query("INSERT INTO tarifaplane
                       (cantidad, price, type_rate, id_agency, annio, id_ratesvalid)
            VALUES ('15','$tr_in15','1','-1','$anio_act','$id');");

                    //type_rate 0

                    Doo::db()->query("INSERT INTO tarifaplane
                       (cantidad, price, type_rate, id_agency, annio, id_ratesvalid)
            VALUES ('1','$tr_in','0','-1','$anio_act','$id');");

                    Doo::db()->query("INSERT INTO tarifaplane
                       (cantidad, price, type_rate, id_agency, annio, id_ratesvalid)
            VALUES ('2','$tr_in2','0','-1','$anio_act','$id');");

                    Doo::db()->query("INSERT INTO tarifaplane
                       (cantidad, price, type_rate, id_agency, annio, id_ratesvalid)
            VALUES ('3','$tr_in3','0','-1','$anio_act','$id');");

                    Doo::db()->query("INSERT INTO tarifaplane
                       (cantidad, price, type_rate, id_agency, annio, id_ratesvalid)
            VALUES ('4','$tr_in4','0','-1','$anio_act','$id');");

                    Doo::db()->query("INSERT INTO tarifaplane
                       (cantidad, price, type_rate, id_agency, annio, id_ratesvalid)
            VALUES ('5','$tr_in5','0','-1','$anio_act','$id');");

                    Doo::db()->query("INSERT INTO tarifaplane
                       (cantidad, price, type_rate, id_agency, annio, id_ratesvalid)
            VALUES ('6','$tr_in6','0','-1','$anio_act','$id');");

                    Doo::db()->query("INSERT INTO tarifaplane
                       (cantidad, price, type_rate, id_agency, annio, id_ratesvalid)
            VALUES ('7','$tr_in7','0','-1','$anio_act','$id');");

                    Doo::db()->query("INSERT INTO tarifaplane
                       (cantidad, price, type_rate, id_agency, annio, id_ratesvalid)
            VALUES ('8','$tr_in8','0','-1','$anio_act','$id');");

                    Doo::db()->query("INSERT INTO tarifaplane
                       (cantidad, price, type_rate, id_agency, annio, id_ratesvalid)
            VALUES ('9','$tr_in9','0','-1','$anio_act','$id');");

                    Doo::db()->query("INSERT INTO tarifaplane
                       (cantidad, price, type_rate, id_agency, annio, id_ratesvalid)
            VALUES ('10','$tr_in10','0','-1','$anio_act','$id');");

                    Doo::db()->query("INSERT INTO tarifaplane
                       (cantidad, price, type_rate, id_agency, annio, id_ratesvalid)
            VALUES ('11','$tr_in11','0','-1','$anio_act','$id');");

                    Doo::db()->query("INSERT INTO tarifaplane
                       (cantidad, price, type_rate, id_agency, annio, id_ratesvalid)
            VALUES ('12','$tr_in12','0','-1','$anio_act','$id');");

                    Doo::db()->query("INSERT INTO tarifaplane
                       (cantidad, price, type_rate, id_agency, annio, id_ratesvalid)
            VALUES ('13','$tr_in13','0','-1','$anio_act','$id');");

                    Doo::db()->query("INSERT INTO tarifaplane
                       (cantidad, price, type_rate, id_agency, annio, id_ratesvalid)
            VALUES ('14','$tr_in14','0','-1','$anio_act','$id');");

                    Doo::db()->query("INSERT INTO tarifaplane
                       (cantidad, price, type_rate, id_agency, annio, id_ratesvalid)
            VALUES ('15','$tr_in15','0','-1','$anio_act','$id');");
                }

                if ($anio_act1 != $anio_act) {

                    Doo::db()->query("INSERT INTO tarifaplane
                       (cantidad, price, type_rate, id_agency, annio, id_ratesvalid)
            VALUES ('1','$tr_in','1','-1','$anio_act','$id');");

                    Doo::db()->query("INSERT INTO tarifaplane
                       (cantidad, price, type_rate, id_agency, annio, id_ratesvalid)
            VALUES ('2','$tr_in2','1','-1','$anio_act','$id');");

                    Doo::db()->query("INSERT INTO tarifaplane
                       (cantidad, price, type_rate, id_agency, annio, id_ratesvalid)
            VALUES ('3','$tr_in3','1','-1','$anio_act','$id');");

                    Doo::db()->query("INSERT INTO tarifaplane
                       (cantidad, price, type_rate, id_agency, annio, id_ratesvalid)
            VALUES ('4','$tr_in4','1','-1','$anio_act','$id');");

                    Doo::db()->query("INSERT INTO tarifaplane
                       (cantidad, price, type_rate, id_agency, annio, id_ratesvalid)
            VALUES ('5','$tr_in5','1','-1','$anio_act','$id');");

                    Doo::db()->query("INSERT INTO tarifaplane
                       (cantidad, price, type_rate, id_agency, annio, id_ratesvalid)
            VALUES ('6','$tr_in6','1','-1','$anio_act','$id');");

                    Doo::db()->query("INSERT INTO tarifaplane
                       (cantidad, price, type_rate, id_agency, annio, id_ratesvalid)
            VALUES ('7','$tr_in7','1','-1','$anio_act','$id');");

                    Doo::db()->query("INSERT INTO tarifaplane
                       (cantidad, price, type_rate, id_agency, annio, id_ratesvalid)
            VALUES ('8','$tr_in8','1','-1','$anio_act','$id');");

                    Doo::db()->query("INSERT INTO tarifaplane
                       (cantidad, price, type_rate, id_agency, annio, id_ratesvalid)
            VALUES ('9','$tr_in9','1','-1','$anio_act','$id');");

                    Doo::db()->query("INSERT INTO tarifaplane
                       (cantidad, price, type_rate, id_agency, annio, id_ratesvalid)
            VALUES ('10','$tr_in10','1','-1','$anio_act','$id');");

                    Doo::db()->query("INSERT INTO tarifaplane
                       (cantidad, price, type_rate, id_agency, annio, id_ratesvalid)
            VALUES ('11','$tr_in11','1','-1','$anio_act','$id');");

                    Doo::db()->query("INSERT INTO tarifaplane
                       (cantidad, price, type_rate, id_agency, annio, id_ratesvalid)
            VALUES ('12','$tr_in12','1','-1','$anio_act','$id');");

                    Doo::db()->query("INSERT INTO tarifaplane
                       (cantidad, price, type_rate, id_agency, annio, id_ratesvalid)
            VALUES ('13','$tr_in13','1','-1','$anio_act','$id');");

                    Doo::db()->query("INSERT INTO tarifaplane
                       (cantidad, price, type_rate, id_agency, annio, id_ratesvalid)
            VALUES ('14','$tr_in14','1','-1','$anio_act','$id');");

                    Doo::db()->query("INSERT INTO tarifaplane
                       (cantidad, price, type_rate, id_agency, annio, id_ratesvalid)
            VALUES ('15','$tr_in15','1','-1','$anio_act','$id');");

                    //type_rate 0

                    Doo::db()->query("INSERT INTO tarifaplane
                       (cantidad, price, type_rate, id_agency, annio, id_ratesvalid)
            VALUES ('1','$tr_in','0','-1','$anio_act','$id');");

                    Doo::db()->query("INSERT INTO tarifaplane
                       (cantidad, price, type_rate, id_agency, annio, id_ratesvalid)
            VALUES ('2','$tr_in2','0','-1','$anio_act','$id');");

                    Doo::db()->query("INSERT INTO tarifaplane
                       (cantidad, price, type_rate, id_agency, annio, id_ratesvalid)
            VALUES ('3','$tr_in3','0','-1','$anio_act','$id');");

                    Doo::db()->query("INSERT INTO tarifaplane
                       (cantidad, price, type_rate, id_agency, annio, id_ratesvalid)
            VALUES ('4','$tr_in4','0','-1','$anio_act','$id');");

                    Doo::db()->query("INSERT INTO tarifaplane
                       (cantidad, price, type_rate, id_agency, annio, id_ratesvalid)
            VALUES ('5','$tr_in5','0','-1','$anio_act','$id');");

                    Doo::db()->query("INSERT INTO tarifaplane
                       (cantidad, price, type_rate, id_agency, annio, id_ratesvalid)
            VALUES ('6','$tr_in6','0','-1','$anio_act','$id');");

                    Doo::db()->query("INSERT INTO tarifaplane
                       (cantidad, price, type_rate, id_agency, annio, id_ratesvalid)
            VALUES ('7','$tr_in7','0','-1','$anio_act','$id');");

                    Doo::db()->query("INSERT INTO tarifaplane
                       (cantidad, price, type_rate, id_agency, annio, id_ratesvalid)
            VALUES ('8','$tr_in8','0','-1','$anio_act','$id');");

                    Doo::db()->query("INSERT INTO tarifaplane
                       (cantidad, price, type_rate, id_agency, annio, id_ratesvalid)
            VALUES ('9','$tr_in9','0','-1','$anio_act','$id');");

                    Doo::db()->query("INSERT INTO tarifaplane
                       (cantidad, price, type_rate, id_agency, annio, id_ratesvalid)
            VALUES ('10','$tr_in10','0','-1','$anio_act','$id');");

                    Doo::db()->query("INSERT INTO tarifaplane
                       (cantidad, price, type_rate, id_agency, annio, id_ratesvalid)
            VALUES ('11','$tr_in11','0','-1','$anio_act','$id');");

                    Doo::db()->query("INSERT INTO tarifaplane
                       (cantidad, price, type_rate, id_agency, annio, id_ratesvalid)
            VALUES ('12','$tr_in12','0','-1','$anio_act','$id');");

                    Doo::db()->query("INSERT INTO tarifaplane
                       (cantidad, price, type_rate, id_agency, annio, id_ratesvalid)
            VALUES ('13','$tr_in13','0','-1','$anio_act','$id');");

                    Doo::db()->query("INSERT INTO tarifaplane
                       (cantidad, price, type_rate, id_agency, annio, id_ratesvalid)
            VALUES ('14','$tr_in14','0','-1','$anio_act','$id');");

                    Doo::db()->query("INSERT INTO tarifaplane
                       (cantidad, price, type_rate, id_agency, annio, id_ratesvalid)
            VALUES ('15','$tr_in15','0','-1','$anio_act','$id');");

                    ////2 tanda con anio diferente  

                    Doo::db()->query("INSERT INTO tarifaplane
                       (cantidad, price, type_rate, id_agency, annio, id_ratesvalid)
            VALUES ('1','$tr_in','1','-1','$anio_act1','$id');");

                    Doo::db()->query("INSERT INTO tarifaplane
                       (cantidad, price, type_rate, id_agency, annio, id_ratesvalid)
            VALUES ('2','$tr_in2','1','-1','$anio_act1','$id');");

                    Doo::db()->query("INSERT INTO tarifaplane
                       (cantidad, price, type_rate, id_agency, annio, id_ratesvalid)
            VALUES ('3','$tr_in3','1','-1','$anio_act1','$id');");

                    Doo::db()->query("INSERT INTO tarifaplane
                       (cantidad, price, type_rate, id_agency, annio, id_ratesvalid)
            VALUES ('4','$tr_in4','1','-1','$anio_act1','$id');");

                    Doo::db()->query("INSERT INTO tarifaplane
                       (cantidad, price, type_rate, id_agency, annio, id_ratesvalid)
            VALUES ('5','$tr_in5','1','-1','$anio_act1','$id');");

                    Doo::db()->query("INSERT INTO tarifaplane
                       (cantidad, price, type_rate, id_agency, annio, id_ratesvalid)
            VALUES ('6','$tr_in6','1','-1','$anio_act1','$id');");

                    Doo::db()->query("INSERT INTO tarifaplane
                       (cantidad, price, type_rate, id_agency, annio, id_ratesvalid)
            VALUES ('7','$tr_in7','1','-1','$anio_act1','$id');");

                    Doo::db()->query("INSERT INTO tarifaplane
                       (cantidad, price, type_rate, id_agency, annio, id_ratesvalid)
            VALUES ('8','$tr_in8','1','-1','$anio_act1','$id');");

                    Doo::db()->query("INSERT INTO tarifaplane
                       (cantidad, price, type_rate, id_agency, annio, id_ratesvalid)
            VALUES ('9','$tr_in9','1','-1','$anio_act1','$id');");

                    Doo::db()->query("INSERT INTO tarifaplane
                       (cantidad, price, type_rate, id_agency, annio, id_ratesvalid)
            VALUES ('10','$tr_in10','1','-1','$anio_act1','$id');");

                    Doo::db()->query("INSERT INTO tarifaplane
                       (cantidad, price, type_rate, id_agency, annio, id_ratesvalid)
            VALUES ('11','$tr_in11','1','-1','$anio_act1','$id');");

                    Doo::db()->query("INSERT INTO tarifaplane
                       (cantidad, price, type_rate, id_agency, annio, id_ratesvalid)
            VALUES ('12','$tr_in12','1','-1','$anio_act1','$id');");

                    Doo::db()->query("INSERT INTO tarifaplane
                       (cantidad, price, type_rate, id_agency, annio, id_ratesvalid)
            VALUES ('13','$tr_in13','1','-1','$anio_act1','$id');");

                    Doo::db()->query("INSERT INTO tarifaplane
                       (cantidad, price, type_rate, id_agency, annio, id_ratesvalid)
            VALUES ('14','$tr_in14','1','-1','$anio_act1','$id');");

                    Doo::db()->query("INSERT INTO tarifaplane
                       (cantidad, price, type_rate, id_agency, annio, id_ratesvalid)
            VALUES ('15','$tr_in15','1','-1','$anio_act1','$id');");

                    //type_rate 0

                    Doo::db()->query("INSERT INTO tarifaplane
                       (cantidad, price, type_rate, id_agency, annio, id_ratesvalid)
            VALUES ('1','$tr_in','0','-1','$anio_act1','$id');");

                    Doo::db()->query("INSERT INTO tarifaplane
                       (cantidad, price, type_rate, id_agency, annio, id_ratesvalid)
            VALUES ('2','$tr_in2','0','-1','$anio_act1','$id');");

                    Doo::db()->query("INSERT INTO tarifaplane
                       (cantidad, price, type_rate, id_agency, annio, id_ratesvalid)
            VALUES ('3','$tr_in3','0','-1','$anio_act1','$id');");

                    Doo::db()->query("INSERT INTO tarifaplane
                       (cantidad, price, type_rate, id_agency, annio, id_ratesvalid)
            VALUES ('4','$tr_in4','0','-1','$anio_act1','$id');");

                    Doo::db()->query("INSERT INTO tarifaplane
                       (cantidad, price, type_rate, id_agency, annio, id_ratesvalid)
            VALUES ('5','$tr_in5','0','-1','$anio_act1','$id');");

                    Doo::db()->query("INSERT INTO tarifaplane
                       (cantidad, price, type_rate, id_agency, annio, id_ratesvalid)
            VALUES ('6','$tr_in6','0','-1','$anio_act1','$id');");

                    Doo::db()->query("INSERT INTO tarifaplane
                       (cantidad, price, type_rate, id_agency, annio, id_ratesvalid)
            VALUES ('7','$tr_in7','0','-1','$anio_act1','$id');");

                    Doo::db()->query("INSERT INTO tarifaplane
                       (cantidad, price, type_rate, id_agency, annio, id_ratesvalid)
            VALUES ('8','$tr_in8','0','-1','$anio_act1','$id');");

                    Doo::db()->query("INSERT INTO tarifaplane
                       (cantidad, price, type_rate, id_agency, annio, id_ratesvalid)
            VALUES ('9','$tr_in9','0','-1','$anio_act1','$id');");

                    Doo::db()->query("INSERT INTO tarifaplane
                       (cantidad, price, type_rate, id_agency, annio, id_ratesvalid)
            VALUES ('10','$tr_in10','0','-1','$anio_act1','$id');");

                    Doo::db()->query("INSERT INTO tarifaplane
                       (cantidad, price, type_rate, id_agency, annio, id_ratesvalid)
            VALUES ('11','$tr_in11','0','-1','$anio_act1','$id');");

                    Doo::db()->query("INSERT INTO tarifaplane
                       (cantidad, price, type_rate, id_agency, annio, id_ratesvalid)
            VALUES ('12','$tr_in12','0','-1','$anio_act1','$id');");

                    Doo::db()->query("INSERT INTO tarifaplane
                       (cantidad, price, type_rate, id_agency, annio, id_ratesvalid)
            VALUES ('13','$tr_in13','0','-1','$anio_act1','$id');");

                    Doo::db()->query("INSERT INTO tarifaplane
                       (cantidad, price, type_rate, id_agency, annio, id_ratesvalid)
            VALUES ('14','$tr_in14','0','-1','$anio_act1','$id');");

                    Doo::db()->query("INSERT INTO tarifaplane
                       (cantidad, price, type_rate, id_agency, annio, id_ratesvalid)
            VALUES ('15','$tr_in15','0','-1','$anio_act1','$id');");
                }



                //tarifa car

                if ($anio_act1 == $anio_act) {

                    Doo::db()->query("INSERT INTO tarifacar
                       (price, type_rate, id_agency, annio, id_ratesvalid)
            VALUES ('$tcar_in','1','-1','$anio_act','$id');");

                    Doo::db()->query("INSERT INTO tarifacar
                       (price, type_rate, id_agency, annio, id_ratesvalid)
            VALUES ('$tcar_in','0','-1','$anio_act','$id');");
                }

                if ($anio_act1 != $anio_act) {


                    Doo::db()->query("INSERT INTO tarifacar
                       (price, type_rate, id_agency, annio, id_ratesvalid)
            VALUES ('$tcar_in','1','-1','$anio_act','$id');");

                    Doo::db()->query("INSERT INTO tarifacar
                       (price, type_rate, id_agency, annio, id_ratesvalid)
            VALUES ('$tcar_in','0','-1','$anio_act','$id');");


                    Doo::db()->query("INSERT INTO tarifacar
                       (price, type_rate, id_agency, annio, id_ratesvalid)
            VALUES ('$tcar_in','1','-1','$anio_act1','$id');");

                    Doo::db()->query("INSERT INTO tarifacar
                       (price, type_rate, id_agency, annio, id_ratesvalid)
            VALUES ('$tcar_in','0','-1','$anio_act1','$id');");
                }


            
             //HOTEL MODERATE

                $sql2 = "SELECT id FROM hoteles WHERE categoria ='3' ORDER BY id ASC";
                $rs2 = Doo::db()->query($sql2);
                $idmoderate = $rs2->fetchAll();
                
                foreach ($idmoderate as $idm){
                    

                $idaux2 = $idm['id'];              
                                
                Doo::db()->query("INSERT INTO comifijas
                      (id_hotel,categoria,sglm,dblm,tplm,quam,sglm2,dblm2,tplm2,quam2,sglm3,dblm3,tplm3,quam3,sglm4,dblm4,tplm4,quam4,sglm5,dblm5,tplm5,quam5,sglm6,dblm6,tplm6,quam6,sglm7,dblm7,tplm7,quam7,sglm8,dblm8,tplm8,quam8,chm21,chm32,chm43,chm54,chm65,chm76,chm87,chm98,costax,netax,comtax,id_ratesvalid,breackfast,fecha_ini,fecha_fin,fdm_adult21,fdm_child21,fdm_adult32,fdm_child32,fdm_adult43,fdm_child43,fdm_adult54,fdm_child54,fdm_adult65,fdm_child65,fdm_adult76,fdm_child76,fdm_adult87,fdm_child87,fdm_adult98,fdm_child98,trip100,trip200,trip300,trip101,trip201,trip301,trip100c,trip200c,trip300c,trip101c,trip201c,trip301c,t_in,t_out,car_in,car_out,schv,schm,schv2,schm2,schv3,schm3,schv4,schm4,dupli,fecha_schv,fecha_schm,fecha_schv2,fecha_schm2,fecha_schv3,fecha_schm3,fecha_schv4,fecha_schm4,pax1v_21,pax2v_21,pax1m_21,pax2m_21,pax1v_32,pax2v_32,pax1m_32,pax2m_32,pax1v_43,pax2v_43,pax1m_43,pax2m_43,pax1v_54,pax2v_54,pax1m_54,pax2m_54,pax1v_65,pax2v_65,pax1m_65,pax2m_65,pax1v_76,pax2v_76,pax1m_76,pax2m_76,pax1v_87,pax2v_87,pax1m_87,pax2m_87,pax1v_98,pax2v_98,pax1m_98,pax2m_98)
                VALUES ('$idaux2','3','$sqlt','$dblt','$tplt','$quat','$sqlt2','$dblt2','$tplt2','$quat2','$sqlt3','$dblt3','$tplt3','$quat3','$sqlt4','$dblt4','$tplt4','$quat4','$sqlt5','$dblt5','$tplt5','$quat5','$sqlt6','$dblt6','$tplt6','$quat6','$sqlt7','$dblt7','$tplt7','$quat7','$sqlt8','$dblt8','$tplt8','$quat8','$chmo21','$chmo32','$chmo43','$chmo54','$chmo65','$chmo76','$chmo87','$chmo98','0','0','1','$id','$desayunotax','$ratesroom->fecha_ini','$ratesroom->fecha_fin','$frdm_adult21','$frdm_child21','$frdm_adult32','$frdm_child32','$frdm_adult43','$frdm_child43','$frdm_adult54','$frdm_child54','$frdm_adult65','$frdm_child65','$frdm_adult76','$frdm_child76','$frdm_adult87','$frdm_child87','$frdm_adult98','$frdm_child98','$trip_100','$trip_200','$trip_300','$trip_101','$trip_201','$trip_301','$trip_100c','$trip_200c','$trip_300c','$trip_101c','$trip_201c','$trip_301c','$tr_in','$tr_out','$tcar_in','$tcar_out','$sch_v','$sch_m','$sch_v2','$sch_m2','$sch_v3','$sch_m3','$sch_v4','$sch_m4','$dup_m','$fecha_iniciale','$fecha_finale','$fecha_iniciale2','$fecha_finale2','$fecha_iniciale3','$fecha_finale3','$fecha_iniciale4','$fecha_finale4','','','$pax1m_21','$pax2m_21','','','$pax1m_32','$pax2m_32','','','$pax1m_43','$pax2m_43','','','$pax1m_54','$pax2m_54','','','$pax1m_65','$pax2m_65','','','$pax1m_76','$pax2m_76','','','$pax1m_87','$pax2m_87','','','$pax1m_98','$pax2m_98');");
  
                
                }

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


                //Formateamos la fecha Unix para extraer el annio actual de la fecha_ini del tour

                list($mes, $dia, $anyo) = explode("-", date("m-d-Y", $ratesroom->fecha_ini));

                $fecha_ini = $anyo . "-" . $mes . "-" . $dia;

                $anio_act = $anyo . '-01-01 00:00:00';




                $rs = Doo::db()->query("SELECT  id
							FROM ratesvalid 
							 where id = '$ratesroom->id'");

                $dato = $rs->fetch();
                $id = $dato['id'];

                $borrado = Doo::db()->query("DELETE FROM  comifijas
								WHERE id_hotel = '$ratesroom->id_hotel' and id_ratesvalid = $id");




                if ($borrado) {

//                    $fecha_iniciale = $_POST['fecha_schv'];        
//                    $fecha_finale = $_POST['fecha_schm'];
//
//                    $fecha_iniciale2 = $_POST['fecha_schv2'];
//                    $fecha_finale2 = $_POST['fecha_schm2'];
//
//                    $fecha_iniciale3 = $_POST['fecha_schv3'];
//                    $fecha_finale3 = $_POST['fecha_schm3'];
//
//                    $fecha_iniciale4 = $_POST['fecha_schv4'];
//                    $fecha_finale4 = $_POST['fecha_schm4']; 
//                    

                    $sgltax11 = $ratesroom->sgl;
                    $dbltax11 = $ratesroom->dbl;
                    $tpltax11 = $ratesroom->tpl;
                    $quatax11 = $ratesroom->qua;

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

                    $trip1001 = $ratesroom->trip100;
                    $trip2002 = $ratesroom->trip200;
                    $trip3003 = $ratesroom->trip300;
                    $trip1011 = $ratesroom->trip101;
                    $trip2012 = $ratesroom->trip201;
                    $trip3013 = $ratesroom->trip301;



                    $trip1001c = $ratesroom->trip100c;
                    $trip2002c = $ratesroom->trip200c;
                    $trip3003c = $ratesroom->trip300c;
                    $trip1011c = $ratesroom->trip101c;
                    $trip2012c = $ratesroom->trip201c;
                    $trip3013c = $ratesroom->trip301c;




                    $tf_in = $ratesroom->t_in;
                    $tf_out = $ratesroom->t_out;
                    $car1_in = $ratesroom->car_in;
                    $car2_out = $ratesroom->car_out;
                    
                    
//                    $sch11v = $ratesroom->schv;
//                    $sch11m = $ratesroom->schm;
                    
                    $schv11 = $ratesroom->schv;
                    $schm11 = $ratesroom->schm;

                    $schv22 = $ratesroom->schv2;
                    $schm22 = $ratesroom->schm2;

                    $schv33 = $ratesroom->schv3;
                    $schm33 = $ratesroom->schm3;

                    $schv44 = $ratesroom->schv4;
                    $schm44 = $ratesroom->schm4;
                    
                    $dup1m = $ratesroom->dupli;






                    //VALUE


                    $sqlt1 = $sgltax11;
                    $dblt1 = $dbltax11;
                    $tplt1 = $tpltax11;
                    $quat1 = $quatax11;

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

                    $frdv_adult21 = $fdv_adult21;
                    $frdv_child21 = $fdv_child21;
                    $frdv_adult32 = $fdv_adult32;
                    $frdv_child32 = $fdv_child32;
                    $frdv_adult43 = $fdv_adult43;
                    $frdv_child43 = $fdv_child43;
                    $frdv_adult54 = $fdv_adult54;
                    $frdv_child54 = $fdv_child54;
                    $frdv_adult65 = $fdv_adult65;
                    $frdv_child65 = $fdv_child65;
                    $frdv_adult76 = $fdv_adult76;
                    $frdv_child76 = $fdv_child76;
                    $frdv_adult87 = $fdv_adult87;
                    $frdv_child87 = $fdv_child87;
                    $frdv_adult98 = $fdv_adult98;
                    $frdv_child98 = $fdv_child98;

                    $tripp_100 = $trip1001;
                    $tripp_200 = $trip2002;
                    $tripp_300 = $trip3003;
                    $tripp_101 = $trip1011;
                    $tripp_201 = $trip2012;
                    $tripp_301 = $trip3013;

                    $tripp_100c = $trip1001c;
                    $tripp_200c = $trip2002c;
                    $tripp_300c = $trip3003c;
                    $tripp_101c = $trip1011c;
                    $tripp_201c = $trip2012c;
                    $tripp_301c = $trip3013c;

                    $trr_in = $tf_in;
                    $trr_in2 = 2 * $tf_in;
                    $trr_in3 = 3 * $tf_in;
                    $trr_in4 = 4 * $tf_in;
                    $trr_in5 = 5 * $tf_in;
                    $trr_in6 = 6 * $tf_in;
                    $trr_in7 = 7 * $tf_in;
                    $trr_in8 = 8 * $tf_in;
                    $trr_in9 = 9 * $tf_in;
                    $trr_in10 = 10 * $tf_in;
                    $trr_in11 = 11 * $tf_in;
                    $trr_in12 = 12 * $tf_in;
                    $trr_in13 = 13 * $tf_in;
                    $trr_in14 = 14 * $tf_in;
                    $trr_in15 = 15 * $tf_in;

                    $trr_out = $tf_out;

                    $ttcar_in = $car1_in;
                    $ttcar_out = $car2_out;
//                    $sch_v1 = $sch11v;
//                    $sch_m1 = $sch11m;
                    $sch_v11 = $schv11;
                    $sch_m11 = $schm11;

                    $sch_v22 = $schv22;
                    $sch_m22 = $schm22;

                    $sch_v33 = $schv33;
                    $sch_m33 = $schm33;

                    $sch_v44 = $schv44;
                    $sch_m44 = $schm44;
                    
                    $dup_m1 = $dup1m;


                    //$desayunotax = ((($porcentajes['tax'] / 100) * $ratesroom->brackfast) + ($ratesroom->brackfast));

                    //HOTEL VALUE
                    //ERROR EN WEB 
                    $sql3 = "SELECT id FROM hoteles WHERE categoria ='2' ORDER BY id ASC";
                    $rs3 = Doo::db()->query($sql3);
                    $idval = $rs3->fetchAll();

                   foreach ($idval as $idvup){


                        $idvalup = $idvup['id'];
                        
                        Doo::db()->query("UPDATE comifijas SET categoria='2',sgl='$sqlt1',dbl='$dblt1',tpl='$tplt1',qua='$quat1',sgl2='$sqlt22',dbl2='$dblt22',tpl2='$tplt22',qua2='$quat22',sgl3='$sqlt33',dbl3='$dblt33',tpl3='$tplt33',qua3='$quat33',sgl4='$sqlt44',dbl4='$dblt44',tpl4='$tplt44',qua4='$quat44',sgl5='$sqlt55',dbl5='$dblt55',tpl5='$tplt55',qua5='$quat55',sgl6='$sqlt66',dbl6='$dblt66',tpl6='$tplt66',qua6='$quat66',sgl7='$sqlt77',dbl7='$dblt77',tpl7='$tplt77',qua7='$quat77',sgl8='$sqlt88',dbl8='$dblt88',tpl8='$tplt88',qua8='$quat88',chv21='$chva21',chv32='$chva32',chv43='$chva43',chv54='$chva54',chv65='$chva65',chv76='$chva76',chv87='$chva87',chv98='$chva98',id_ratesvalid='$id',fdv_adult21='$frdv_adult21',fdv_child21='$frdv_child21',fdv_adult32='$frdv_adult32',fdv_child32='$frdv_child32',fdv_adult43='$frdv_adult43',fdv_child43='$frdv_child43',fdv_adult54='$frdv_adult54',fdv_child54='$frdv_child54',fdv_adult65='$frdv_adult65',fdv_child65='$frdv_child65',fdv_adult76='$frdv_adult76',fdv_child76='$frdv_child76',fdv_adult87='$frdv_adult87',fdv_child87='$frdv_child87',fdv_adult98='$frdv_adult98',fdv_child98='$frdv_child98',trip100='$tripp_100',trip200='$tripp_200',trip300='$tripp_300',trip101='$tripp_101',trip201='$tripp_201',trip301='$tripp_301',trip100c='$tripp_100c',trip200c='$tripp_200c',trip300c='$tripp_300c',trip101c='$tripp_101c',trip201c='$tripp_201c',trip301c='$tripp_301c',t_in='$trr_in',t_out='$trr_out',car_in='$ttcar_in ',car_out='$ttcar_out',schv='$sch_v11',schm='$sch_m11',schv2='$sch_v22',schm2='$sch_m22',schv3='$sch_v33',schm3='$sch_m33',schv4='$sch_v44',schm4='$sch_m44',dupli='$dup_m1',fecha_schv='$fecha_iniciale',fecha_schm='$fecha_finale',fecha_schv2='$fecha_iniciale2',fecha_schm2='$fecha_finale2',fecha_schv3='$fecha_iniciale3',fecha_schm3='$fecha_finale3',fecha_schv4='$fecha_iniciale4',fecha_schm4='$fecha_finale4' WHERE id_ratesvalid = '$id' AND id_hotel='$idvalup' AND fecha_ini='$ratesroom->fecha_ini' AND fecha_fin='$ratesroom->fecha_fin' AND comtax='1'");

                        

                    }


                    Doo::db()->query("UPDATE agencia SET tour_name='$tour_name'  WHERE id_tour ='$id'");
                    
                    Doo::db()->query("UPDATE tarifastrip SET adult='$tripp_100', child='$tripp_100c' WHERE id_ratesvalid = '$id' AND trip_no = '100' AND type_rate ='1'");

                    Doo::db()->query("UPDATE tarifastrip SET adult='$tripp_200', child='$tripp_200c' WHERE id_ratesvalid = '$id' AND trip_no = '200' AND type_rate ='1'");

                    Doo::db()->query("UPDATE tarifastrip SET adult='$tripp_300', child='$tripp_300c' WHERE id_ratesvalid = '$id' AND trip_no = '300' AND type_rate ='1'");

                    Doo::db()->query("UPDATE tarifastrip SET adult='$tripp_101', child='$tripp_101c' WHERE id_ratesvalid = '$id' AND trip_no = '101' AND type_rate ='1'");

                    Doo::db()->query("UPDATE tarifastrip SET adult='$tripp_201', child='$tripp_201c' WHERE id_ratesvalid = '$id' AND trip_no = '201' AND type_rate ='1'");

                    Doo::db()->query("UPDATE tarifastrip SET adult='$tripp_301', child='$tripp_301c' WHERE id_ratesvalid = '$id' AND trip_no = '301' AND type_rate ='1'");


                    Doo::db()->query("UPDATE tarifastrip SET adult='$tripp_100', child='$tripp_100c' WHERE id_ratesvalid = '$id' AND trip_no = '100' AND type_rate ='0'");

                    Doo::db()->query("UPDATE tarifastrip SET adult='$tripp_200', child='$tripp_200c' WHERE id_ratesvalid = '$id' AND trip_no = '200' AND type_rate ='0'");

                    Doo::db()->query("UPDATE tarifastrip SET adult='$tripp_300', child='$tripp_300c' WHERE id_ratesvalid = '$id' AND trip_no = '300' AND type_rate ='0'");

                    Doo::db()->query("UPDATE tarifastrip SET adult='$tripp_101', child='$tripp_101c' WHERE id_ratesvalid = '$id' AND trip_no = '101' AND type_rate ='0'");

                    Doo::db()->query("UPDATE tarifastrip SET adult='$tripp_201', child='$tripp_201c' WHERE id_ratesvalid = '$id' AND trip_no = '201' AND type_rate ='0'");

                    Doo::db()->query("UPDATE tarifastrip SET adult='$tripp_301', child='$tripp_301c' WHERE id_ratesvalid = '$id' AND trip_no = '301' AND type_rate ='0'");


                    Doo::db()->query("UPDATE tarifaplane SET price='$trr_in' WHERE id_ratesvalid = '$id' AND cantidad = '1' AND type_rate ='1'");
                    Doo::db()->query("UPDATE tarifaplane SET price='$trr_in2' WHERE id_ratesvalid = '$id' AND cantidad = '2' AND type_rate ='1'");
                    Doo::db()->query("UPDATE tarifaplane SET price='$trr_in3' WHERE id_ratesvalid = '$id' AND cantidad = '3' AND type_rate ='1'");
                    Doo::db()->query("UPDATE tarifaplane SET price='$trr_in4' WHERE id_ratesvalid = '$id' AND cantidad = '4' AND type_rate ='1'");
                    Doo::db()->query("UPDATE tarifaplane SET price='$trr_in5' WHERE id_ratesvalid = '$id' AND cantidad = '5' AND type_rate ='1'");
                    Doo::db()->query("UPDATE tarifaplane SET price='$trr_in6' WHERE id_ratesvalid = '$id' AND cantidad = '6' AND type_rate ='1'");
                    Doo::db()->query("UPDATE tarifaplane SET price='$trr_in7' WHERE id_ratesvalid = '$id' AND cantidad = '7' AND type_rate ='1'");
                    Doo::db()->query("UPDATE tarifaplane SET price='$trr_in8' WHERE id_ratesvalid = '$id' AND cantidad = '8' AND type_rate ='1'");
                    Doo::db()->query("UPDATE tarifaplane SET price='$trr_in9' WHERE id_ratesvalid = '$id' AND cantidad = '9' AND type_rate ='1'");
                    Doo::db()->query("UPDATE tarifaplane SET price='$trr_in10' WHERE id_ratesvalid = '$id' AND cantidad = '10' AND type_rate ='1'");
                    Doo::db()->query("UPDATE tarifaplane SET price='$trr_in11' WHERE id_ratesvalid = '$id' AND cantidad = '11' AND type_rate ='1'");
                    Doo::db()->query("UPDATE tarifaplane SET price='$trr_in12' WHERE id_ratesvalid = '$id' AND cantidad = '12' AND type_rate ='1'");
                    Doo::db()->query("UPDATE tarifaplane SET price='$trr_in13' WHERE id_ratesvalid = '$id' AND cantidad = '13' AND type_rate ='1'");
                    Doo::db()->query("UPDATE tarifaplane SET price='$trr_in14' WHERE id_ratesvalid = '$id' AND cantidad = '14' AND type_rate ='1'");
                    Doo::db()->query("UPDATE tarifaplane SET price='$trr_in15' WHERE id_ratesvalid = '$id' AND cantidad = '15' AND type_rate ='1'");



                    Doo::db()->query("UPDATE tarifaplane SET price='$trr_in' WHERE id_ratesvalid = '$id' AND cantidad = '1' AND type_rate ='0'");
                    Doo::db()->query("UPDATE tarifaplane SET price='$trr_in2' WHERE id_ratesvalid = '$id' AND cantidad = '2' AND type_rate ='0'");
                    Doo::db()->query("UPDATE tarifaplane SET price='$trr_in3' WHERE id_ratesvalid = '$id' AND cantidad = '3' AND type_rate ='0'");
                    Doo::db()->query("UPDATE tarifaplane SET price='$trr_in4' WHERE id_ratesvalid = '$id' AND cantidad = '4' AND type_rate ='0'");
                    Doo::db()->query("UPDATE tarifaplane SET price='$trr_in5' WHERE id_ratesvalid = '$id' AND cantidad = '5' AND type_rate ='0'");
                    Doo::db()->query("UPDATE tarifaplane SET price='$trr_in6' WHERE id_ratesvalid = '$id' AND cantidad = '6' AND type_rate ='0'");
                    Doo::db()->query("UPDATE tarifaplane SET price='$trr_in7' WHERE id_ratesvalid = '$id' AND cantidad = '7' AND type_rate ='0'");
                    Doo::db()->query("UPDATE tarifaplane SET price='$trr_in8' WHERE id_ratesvalid = '$id' AND cantidad = '8' AND type_rate ='0'");
                    Doo::db()->query("UPDATE tarifaplane SET price='$trr_in9' WHERE id_ratesvalid = '$id' AND cantidad = '9' AND type_rate ='0'");
                    Doo::db()->query("UPDATE tarifaplane SET price='$trr_in10' WHERE id_ratesvalid = '$id' AND cantidad = '10' AND type_rate ='0'");
                    Doo::db()->query("UPDATE tarifaplane SET price='$trr_in11' WHERE id_ratesvalid = '$id' AND cantidad = '11' AND type_rate ='0'");
                    Doo::db()->query("UPDATE tarifaplane SET price='$trr_in12' WHERE id_ratesvalid = '$id' AND cantidad = '12' AND type_rate ='0'");
                    Doo::db()->query("UPDATE tarifaplane SET price='$trr_in13' WHERE id_ratesvalid = '$id' AND cantidad = '13' AND type_rate ='0'");
                    Doo::db()->query("UPDATE tarifaplane SET price='$trr_in14' WHERE id_ratesvalid = '$id' AND cantidad = '14' AND type_rate ='0'");
                    Doo::db()->query("UPDATE tarifaplane SET price='$trr_in15' WHERE id_ratesvalid = '$id' AND cantidad = '15' AND type_rate ='0'");

                    Doo::db()->query("UPDATE tarifacar SET price='$ttcar_in'  WHERE id_ratesvalid = '$id' AND annio = '$anio_act' AND type_rate='1'");
                    Doo::db()->query("UPDATE tarifacar SET price='$ttcar_in'  WHERE id_ratesvalid = '$id' AND annio = '$anio_act' AND type_rate='0'");





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

                    //NINOS
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

                    $trip100c = $ratesroom->trip100c;
                    $trip200c = $ratesroom->trip200c;
                    $trip300c = $ratesroom->trip300c;
                    $trip101c = $ratesroom->trip101c;
                    $trip201c = $ratesroom->trip201c;
                    $trip301c = $ratesroom->trip301c;

                    $t_in = $ratesroom->t_in;
                    $t_out = $ratesroom->t_out;
                    $car_in = $ratesroom->car_in;
                    $car_out = $ratesroom->car_out;
                    $schv = $ratesroom->schv;
                    $schm = $ratesroom->schm;
                    
                    $schv2 = $ratesroom->schv2;
                    $schm2 = $ratesroom->schm2;
                    
                    $schv3 = $ratesroom->schv3;
                    $schm3 = $ratesroom->schm3;
                    
                    $schv4 = $ratesroom->schv4;
                    $schm4 = $ratesroom->schm4;
                    
                    $dup2m = $ratesroom->dupli;

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

                    $frdm_adult21 = $fdm_adult21;
                    $frdm_child21 = $fdm_child21;
                    $frdm_adult32 = $fdm_adult32;
                    $frdm_child32 = $fdm_child32;
                    $frdm_adult43 = $fdm_adult43;
                    $frdm_child43 = $fdm_child43;
                    $frdm_adult54 = $fdm_adult54;
                    $frdm_child54 = $fdm_child54;
                    $frdm_adult65 = $fdm_adult65;
                    $frdm_child65 = $fdm_child65;
                    $frdm_adult76 = $fdm_adult76;
                    $frdm_child76 = $fdm_child76;
                    $frdm_adult87 = $fdm_adult87;
                    $frdm_child87 = $fdm_child87;
                    $frdm_adult98 = $fdm_adult98;
                    $frdm_child98 = $fdm_child98;

                    $trip_100 = $trip100;
                    $trip_200 = $trip200;
                    $trip_300 = $trip300;
                    $trip_101 = $trip101;
                    $trip_201 = $trip201;
                    $trip_301 = $trip301;

                    $trip_100c = $trip100c;
                    $trip_200c = $trip200c;
                    $trip_300c = $trip300c;
                    $trip_101c = $trip101c;
                    $trip_201c = $trip201c;
                    $trip_301c = $trip301c;

                    $tr_in = $t_in;
                    $tr_out = $t_out;
                    $tcar_in = $car_in;
                    $tcar_out = $car_out;
                    
                    $sch_v = $schv;
                    $sch_m = $schm;
                    
                    $sch_v2 = $schv2;
                    $sch_m2 = $schm2;
                    
                    $sch_v3 = $schv3;
                    $sch_m3 = $schm3;
                    
                    $sch_v4 = $schv4;
                    $sch_m4 = $schm4;
                    
                    
                    $dup_m2 = $dup2m;


                    //HOTEL MODERATE
                    //ERROR EN WEB*******************************************************************
                    $sql4 = "SELECT id FROM hoteles WHERE categoria ='3' ORDER BY id ASC";
                    $rs4 = Doo::db()->query($sql4);
                    $idmodup = $rs4->fetchAll();

                    foreach ($idmodup as $idmup){


                    $idmodeup = $idmup['id'];
                    
                        Doo::db()->query("UPDATE comifijas SET categoria='3',sglm='$sqlt',dblm='$dblt',tplm='$tplt',quam='$quat',sglm2='$sqlt2',dblm2='$dblt2',tplm2='$tplt2',quam2='$quat2',sglm3='$sqlt3',dblm3='$dblt3',tplm3='$tplt3',quam3='$quat3',sglm4='$sqlt4',dblm4='$dblt4',tplm4='$tplt4',quam4='$quat4',sglm5='$sqlt5',dblm5='$dblt5',tplm5='$tplt5',quam5='$quat5',sglm6='$sqlt6',dblm6='$dblt6',tplm6='$tplt6',quam6='$quat6',sglm7='$sqlt7',dblm7='$dblt7',tplm7='$tplt7',quam7='$quat7',sglm8='$sqlt8',dblm8='$dblt8',tplm8='$tplt8',quam8='$quat8',chm21='$chmo21',chm32='$chmo32',chm43='$chmo43',chm54='$chmo54',chm65='$chmo65',chm76='$chmo76',chm87='$chmo87',chm98='$chmo98',fdm_adult21='$frdm_adult21',fdm_child21='$frdm_child21',fdm_adult32='$frdm_adult32',fdm_child32='$frdm_child32',fdm_adult43='$frdm_adult43',fdm_child43='$frdm_child43',fdm_adult54='$frdm_adult54',fdm_child54='$frdm_child54',fdm_adult65='$frdm_adult65',fdm_child65='$frdm_child65',fdm_adult76='$frdm_adult76',fdm_child76='$frdm_child76',fdm_adult87='$frdm_adult87',fdm_child87='$frdm_child87',fdm_adult98='$frdm_adult98',fdm_child98='$frdm_child98',trip100='$trip_100',trip200='$trip_200',trip300='$trip_300',trip101='$trip_101',trip201='$trip_201',trip301='$trip_301',trip100c='$trip_100c',trip200c='$trip_200c',trip300c='$trip_300c',trip101c='$trip_101c',trip201c='$trip_201c',trip301c='$trip_301c',t_in='$tr_in',t_out='$tr_out',car_in='$tcar_in ',car_out='$tcar_out',schv='$sch_v',schm='$sch_m',schv2='$sch_v2',schm2='$sch_m2',schv3='$sch_v3',schm3='$sch_m3',schv4='$sch_v4',schm4='$sch_m4',dupli='$dup_m2',fecha_schv='$fecha_iniciale',fecha_schm='$fecha_finale',fecha_schv2='$fecha_iniciale2',fecha_schm2='$fecha_finale2',fecha_schv3='$fecha_iniciale3',fecha_schm3='$fecha_finale3',fecha_schv4='$fecha_iniciale4',fecha_schm4='$fecha_finale4' WHERE id_ratesvalid = '$id' AND id_hotel='$idmodeup' AND fecha_ini='$ratesroom->fecha_ini' AND fecha_fin='$ratesroom->fecha_fin' AND comtax='1'");
                    
                    }
                    
                    Doo::db()->query("UPDATE agencia SET tour_name='$tour_name'  WHERE id_tour ='$id'");


                    $sql8 = "SELECT id 

                    FROM ratesvalid
                    ORDER BY id DESC LIMIT 1";




                    $rs8 = Doo::db()->query($sql8);
                    $id_rvalid = $rs8->fetchAll();

                    foreach ($id_rvalid as $clave8 => $key8) {
                        
                    }

                    $ultimoid = $key8['id'];
                    $nuevo_id = $ultimoid + 1;

                    //////////////////////////////////////////////
                    $sql10 = "SELECT dupli 

                    FROM ratesvalid
                    WHERE id='$id'";




                    $rs10 = Doo::db()->query($sql10);
                    $duptarif = $rs10->fetchAll();

                    foreach ($duptarif as $clave10 => $key10) {
                        
                    }

                    $dupli = $key10['dupli'];


                    if ($dupli == 'true') {


                        Doo::db()->query("INSERT INTO ratesvalid SELECT '$nuevo_id', id_hotel, fecha_ini, fecha_fin, sgl, dbl, tpl, qua, sgl2, dbl2, tpl2, qua2, sgl3, dbl3, tpl3, qua3, sgl4, dbl4, tpl4, qua4, sgl5, dbl5,
                        tpl5, qua5, sgl6, dbl6, tpl6, qua6, sgl7, dbl7, tpl7, qua7, sgl8, dbl8, tpl8, qua8, sglm, dblm, tplm, quam, sglm2, dblm2, tplm2, quam2,sglm3, dblm3, tplm3, quam3, sglm4, dblm4, tplm4, quam4, sglm5,
                        dblm5, tplm5, quam5, sglm6, dblm6, tplm6, quam6, sglm7, dblm7, tplm7, quam7,sglm8, dblm8, tplm8, quam8, chv21, chm21, chv32, chm32, chv43, chm43, chv54, chm54, chv65, chm65, chv76, chm76, chv87, chm87,
                        chv98, chm98,resortprice, brackfast, type_rate, id_agency, company_name, CONCAT(rate,'_1'), rate_no, fdv_adult21, fdv_child21, fdm_adult21, fdm_child21,fdv_adult32, fdv_child32, fdm_adult32, fdm_child32,
                        fdv_adult43, fdv_child43, fdm_adult43, fdm_child43, fdv_adult54, fdv_child54, fdm_adult54, fdm_child54, fdv_adult65, fdv_child65, fdm_adult65, fdm_child65, fdv_adult76, fdv_child76, fdm_adult76, fdm_child76,
                        fdv_adult87, fdv_child87, fdm_adult87, fdm_child87, fdv_adult98, fdv_child98, fdm_adult98, fdm_child98, trip100, trip200, trip300, trip101, trip201, trip301, trip100c, trip200c, trip300c, trip101c, trip201c,
                        trip301c, t_in, t_out, car_in, car_out, schv, schm, schv2, schm2, schv3, schm3, schv4, schm4, 'false', fecha_schv, fecha_schm , fecha_schv2, fecha_schm2 , fecha_schv3, fecha_schm3 , fecha_schv4, fecha_schm4,
                        pax1v_21,pax2v_21,pax1m_21,pax2m_21,pax1v_32,pax2v_32,pax1m_32,pax2m_32,pax1v_43,pax2v_43,pax1m_43,pax2m_43,pax1v_54,pax2v_54,pax1m_54,pax2m_54,pax1v_65,pax2v_65,pax1m_65,pax2m_65,pax1v_76,pax2v_76,pax1m_76,
                        pax2m_76,pax1v_87,pax2v_87,pax1m_87,pax2m_87,pax1v_98,pax2v_98,pax1m_98,pax2m_98 FROM ratesvalid WHERE id = '$id';");

                        
                        $sql5 = "SELECT id FROM hoteles WHERE categoria BETWEEN '2' AND '3' ORDER BY id ASC";
                        $rs5 = Doo::db()->query($sql5);
                        $idhotel = $rs5->fetchAll();

                        foreach ($idhotel as $id_hot){


                        $id_hotel = $id_hot['id'];
                        
                        
                        Doo::db()->query("INSERT INTO comifijas SELECT '', id_hotel,categoria,sgl,dbl,tpl,qua,sgl2,dbl2,tpl2,qua2,sgl3,dbl3,tpl3,qua3,sgl4,dbl4,tpl4,qua4,sgl5,dbl5,tpl5,qua5,sgl6,dbl6,tpl6,qua6,sgl7,
                        dbl7,tpl7,qua7,sgl8,dbl8,tpl8,qua8,sglm,dblm,tplm,quam,sglm2,dblm2,tplm2,quam2,sglm3,dblm3,tplm3,quam3,sglm4,dblm4,tplm4,quam4,sglm5,dblm5,tplm5,quam5,sglm6,dblm6,
                        tplm6,quam6,sglm7,dblm7,tplm7,quam7,sglm8,dblm8,tplm8,quam8,chv21,chm21,chv32,chm32,chv43,chm43,chv54,chm54,chv65,chm65,chv76,chm76,chv87,chm87,chv98,chm98,costax,
                        netax,comtax,'$nuevo_id',breackfast,fecha_ini,fecha_fin,fdv_adult21,fdv_child21,fdm_adult21,fdm_child21,fdv_adult32,fdv_child32,fdm_adult32,fdm_child32,fdv_adult43,fdv_child43,
                        fdm_adult43,fdm_child43,fdv_adult54,fdv_child54,fdm_adult54,fdm_child54,fdv_adult65,fdv_child65,fdm_adult65,fdm_child65,fdv_adult76,fdv_child76,fdm_adult76,fdm_child76,
                        fdv_adult87,fdv_child87,fdm_adult87,fdm_child87,fdv_adult98,fdv_child98,fdm_adult98,fdm_child98,trip100,trip200,trip300,trip101,trip201,trip301,trip100c,trip200c,trip300c,
                        trip101c,trip201c,trip301c,t_in,t_out,car_in,car_out,schv,schm,schv2,schm2,schv3,schm3,schv4,schm4,'false',fecha_schv,fecha_schm,fecha_schv2,fecha_schm2,fecha_schv3,fecha_schm3,fecha_schv4,fecha_schm4,
                        pax1v_21,pax2v_21,pax1m_21,pax2m_21,pax1v_32,pax2v_32,pax1m_32,pax2m_32,pax1v_43,pax2v_43,pax1m_43,pax2m_43,pax1v_54,pax2v_54,pax1m_54,pax2m_54,pax1v_65,pax2v_65,pax1m_65,pax2m_65,pax1v_76,pax2v_76,pax1m_76,pax2m_76,
                        pax1v_87,pax2v_87,pax1m_87,pax2m_87,pax1v_98,pax2v_98,pax1m_98,pax2m_98
                        FROM comifijas WHERE id_ratesvalid = '$id' AND id_hotel = '$id_hotel';");

                        }
                        
                        //TARIFAS TRIP
                        //Type_rate 1

                        Doo::db()->query("INSERT INTO tarifastrip SELECT '', trip_no,adult,child,'1',id_agency,company_name,annio,'$nuevo_id' FROM tarifastrip WHERE id_ratesvalid = '$id' AND trip_no = '100' AND type_rate = '1';");

                        Doo::db()->query("INSERT INTO tarifastrip SELECT '', trip_no,adult,child,'1',id_agency,company_name,annio,'$nuevo_id' FROM tarifastrip WHERE id_ratesvalid = '$id' AND trip_no = '200' AND type_rate = '1';");

                        Doo::db()->query("INSERT INTO tarifastrip SELECT '', trip_no,adult,child,'1',id_agency,company_name,annio,'$nuevo_id' FROM tarifastrip WHERE id_ratesvalid = '$id' AND trip_no = '300' AND type_rate = '1';");

                        Doo::db()->query("INSERT INTO tarifastrip SELECT '', trip_no,adult,child,'1',id_agency,company_name,annio,'$nuevo_id' FROM tarifastrip WHERE id_ratesvalid = '$id' AND trip_no = '101' AND type_rate = '1';");

                        Doo::db()->query("INSERT INTO tarifastrip SELECT '', trip_no,adult,child,'1',id_agency,company_name,annio,'$nuevo_id' FROM tarifastrip WHERE id_ratesvalid = '$id' AND trip_no = '201' AND type_rate = '1';");

                        Doo::db()->query("INSERT INTO tarifastrip SELECT '', trip_no,adult,child,'1',id_agency,company_name,annio,'$nuevo_id' FROM tarifastrip WHERE id_ratesvalid = '$id' AND trip_no = '301' AND type_rate = '1';");

                        //Type_rate 0

                        Doo::db()->query("INSERT INTO tarifastrip SELECT '', trip_no,adult,child,'0',id_agency,company_name,annio,'$nuevo_id' FROM tarifastrip WHERE id_ratesvalid = '$id' AND trip_no = '100' AND type_rate = '0';");

                        Doo::db()->query("INSERT INTO tarifastrip SELECT '', trip_no,adult,child,'0',id_agency,company_name,annio,'$nuevo_id' FROM tarifastrip WHERE id_ratesvalid = '$id' AND trip_no = '200' AND type_rate = '0';");

                        Doo::db()->query("INSERT INTO tarifastrip SELECT '', trip_no,adult,child,'0',id_agency,company_name,annio,'$nuevo_id' FROM tarifastrip WHERE id_ratesvalid = '$id' AND trip_no = '300' AND type_rate = '0';");

                        Doo::db()->query("INSERT INTO tarifastrip SELECT '', trip_no,adult,child,'0',id_agency,company_name,annio,'$nuevo_id' FROM tarifastrip WHERE id_ratesvalid = '$id' AND trip_no = '101' AND type_rate = '0';");

                        Doo::db()->query("INSERT INTO tarifastrip SELECT '', trip_no,adult,child,'0',id_agency,company_name,annio,'$nuevo_id' FROM tarifastrip WHERE id_ratesvalid = '$id' AND trip_no = '201' AND type_rate = '0';");

                        Doo::db()->query("INSERT INTO tarifastrip SELECT '', trip_no,adult,child,'0',id_agency,company_name,annio,'$nuevo_id' FROM tarifastrip WHERE id_ratesvalid = '$id' AND trip_no = '301' AND type_rate = '0';");


                        //////////// PLANE type_rate 1



                        Doo::db()->query("INSERT INTO tarifaplane SELECT '', cantidad, price, '1', id_agency, company_name, annio, '$nuevo_id' FROM tarifaplane WHERE id_ratesvalid = '$id' AND cantidad = '1' AND type_rate = '1';");

                        Doo::db()->query("INSERT INTO tarifaplane SELECT '', cantidad, price, '1', id_agency, company_name, annio, '$nuevo_id' FROM tarifaplane WHERE id_ratesvalid = '$id' AND cantidad = '2' AND type_rate = '1';");

                        Doo::db()->query("INSERT INTO tarifaplane SELECT '', cantidad, price, '1', id_agency, company_name, annio, '$nuevo_id' FROM tarifaplane WHERE id_ratesvalid = '$id' AND cantidad = '3' AND type_rate = '1';");

                        Doo::db()->query("INSERT INTO tarifaplane SELECT '', cantidad, price, '1', id_agency, company_name, annio, '$nuevo_id' FROM tarifaplane WHERE id_ratesvalid = '$id' AND cantidad = '4' AND type_rate = '1';");

                        Doo::db()->query("INSERT INTO tarifaplane SELECT '', cantidad, price, '1', id_agency, company_name, annio, '$nuevo_id' FROM tarifaplane WHERE id_ratesvalid = '$id' AND cantidad = '5' AND type_rate = '1';");

                        Doo::db()->query("INSERT INTO tarifaplane SELECT '', cantidad, price, '1', id_agency, company_name, annio, '$nuevo_id' FROM tarifaplane WHERE id_ratesvalid = '$id' AND cantidad = '6' AND type_rate = '1';");

                        Doo::db()->query("INSERT INTO tarifaplane SELECT '', cantidad, price, '1', id_agency, company_name, annio, '$nuevo_id' FROM tarifaplane WHERE id_ratesvalid = '$id' AND cantidad = '7' AND type_rate = '1';");

                        Doo::db()->query("INSERT INTO tarifaplane SELECT '', cantidad, price, '1', id_agency, company_name, annio, '$nuevo_id' FROM tarifaplane WHERE id_ratesvalid = '$id' AND cantidad = '8' AND type_rate = '1';");

                        Doo::db()->query("INSERT INTO tarifaplane SELECT '', cantidad, price, '1', id_agency, company_name, annio, '$nuevo_id' FROM tarifaplane WHERE id_ratesvalid = '$id' AND cantidad = '9' AND type_rate = '1';");

                        Doo::db()->query("INSERT INTO tarifaplane SELECT '', cantidad, price, '1', id_agency, company_name, annio, '$nuevo_id' FROM tarifaplane WHERE id_ratesvalid = '$id' AND cantidad = '10' AND type_rate = '1';");

                        Doo::db()->query("INSERT INTO tarifaplane SELECT '', cantidad, price, '1', id_agency, company_name, annio, '$nuevo_id' FROM tarifaplane WHERE id_ratesvalid = '$id' AND cantidad = '11' AND type_rate = '1';");

                        Doo::db()->query("INSERT INTO tarifaplane SELECT '', cantidad, price, '1', id_agency, company_name, annio, '$nuevo_id' FROM tarifaplane WHERE id_ratesvalid = '$id' AND cantidad = '12' AND type_rate = '1';");

                        Doo::db()->query("INSERT INTO tarifaplane SELECT '', cantidad, price, '1', id_agency, company_name, annio, '$nuevo_id' FROM tarifaplane WHERE id_ratesvalid = '$id' AND cantidad = '13' AND type_rate = '1';");

                        Doo::db()->query("INSERT INTO tarifaplane SELECT '', cantidad, price, '1', id_agency, company_name, annio, '$nuevo_id' FROM tarifaplane WHERE id_ratesvalid = '$id' AND cantidad = '14' AND type_rate = '1';");

                        Doo::db()->query("INSERT INTO tarifaplane SELECT '', cantidad, price, '1', id_agency, company_name, annio, '$nuevo_id' FROM tarifaplane WHERE id_ratesvalid = '$id' AND cantidad = '15' AND type_rate = '1';");




                        ///  PLANE type_rate 0

                        Doo::db()->query("INSERT INTO tarifaplane SELECT '', cantidad, price, '0', id_agency, company_name, annio, '$nuevo_id' FROM tarifaplane WHERE id_ratesvalid = '$id' AND cantidad = '1' AND type_rate = '0';");

                        Doo::db()->query("INSERT INTO tarifaplane SELECT '', cantidad, price, '0', id_agency, company_name, annio, '$nuevo_id' FROM tarifaplane WHERE id_ratesvalid = '$id' AND cantidad = '2' AND type_rate = '0';");

                        Doo::db()->query("INSERT INTO tarifaplane SELECT '', cantidad, price, '0', id_agency, company_name, annio, '$nuevo_id' FROM tarifaplane WHERE id_ratesvalid = '$id' AND cantidad = '3' AND type_rate = '0';");

                        Doo::db()->query("INSERT INTO tarifaplane SELECT '', cantidad, price, '0', id_agency, company_name, annio, '$nuevo_id' FROM tarifaplane WHERE id_ratesvalid = '$id' AND cantidad = '4' AND type_rate = '0';");

                        Doo::db()->query("INSERT INTO tarifaplane SELECT '', cantidad, price, '0', id_agency, company_name, annio, '$nuevo_id' FROM tarifaplane WHERE id_ratesvalid = '$id' AND cantidad = '5' AND type_rate = '0';");

                        Doo::db()->query("INSERT INTO tarifaplane SELECT '', cantidad, price, '0', id_agency, company_name, annio, '$nuevo_id' FROM tarifaplane WHERE id_ratesvalid = '$id' AND cantidad = '6' AND type_rate = '0';");

                        Doo::db()->query("INSERT INTO tarifaplane SELECT '', cantidad, price, '0', id_agency, company_name, annio, '$nuevo_id' FROM tarifaplane WHERE id_ratesvalid = '$id' AND cantidad = '7' AND type_rate = '0';");

                        Doo::db()->query("INSERT INTO tarifaplane SELECT '', cantidad, price, '0', id_agency, company_name, annio, '$nuevo_id' FROM tarifaplane WHERE id_ratesvalid = '$id' AND cantidad = '8' AND type_rate = '0';");

                        Doo::db()->query("INSERT INTO tarifaplane SELECT '', cantidad, price, '0', id_agency, company_name, annio, '$nuevo_id' FROM tarifaplane WHERE id_ratesvalid = '$id' AND cantidad = '9' AND type_rate = '0';");

                        Doo::db()->query("INSERT INTO tarifaplane SELECT '', cantidad, price, '0', id_agency, company_name, annio, '$nuevo_id' FROM tarifaplane WHERE id_ratesvalid = '$id' AND cantidad = '10' AND type_rate = '0';");

                        Doo::db()->query("INSERT INTO tarifaplane SELECT '', cantidad, price, '0', id_agency, company_name, annio, '$nuevo_id' FROM tarifaplane WHERE id_ratesvalid = '$id' AND cantidad = '11' AND type_rate = '0';");

                        Doo::db()->query("INSERT INTO tarifaplane SELECT '', cantidad, price, '0', id_agency, company_name, annio, '$nuevo_id' FROM tarifaplane WHERE id_ratesvalid = '$id' AND cantidad = '12' AND type_rate = '0';");

                        Doo::db()->query("INSERT INTO tarifaplane SELECT '', cantidad, price, '0', id_agency, company_name, annio, '$nuevo_id' FROM tarifaplane WHERE id_ratesvalid = '$id' AND cantidad = '13' AND type_rate = '0';");

                        Doo::db()->query("INSERT INTO tarifaplane SELECT '', cantidad, price, '0', id_agency, company_name, annio, '$nuevo_id' FROM tarifaplane WHERE id_ratesvalid = '$id' AND cantidad = '14' AND type_rate = '0';");

                        Doo::db()->query("INSERT INTO tarifaplane SELECT '', cantidad, price, '0', id_agency, company_name, annio, '$nuevo_id' FROM tarifaplane WHERE id_ratesvalid = '$id' AND cantidad = '15' AND type_rate = '0';");


                        /// CAR type_rate = '1'

                        Doo::db()->query("INSERT INTO tarifacar SELECT '', price, '1', id_agency, company_name, annio, '$nuevo_id' FROM tarifacar WHERE id_ratesvalid = '$id' AND type_rate = '1';");

                        /// CAR type_rate = '0'

                        Doo::db()->query("INSERT INTO tarifacar SELECT '', price, '0', id_agency, company_name, annio, '$nuevo_id' FROM tarifacar WHERE id_ratesvalid = '$id' AND type_rate = '0';");
                    }
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
        Doo::loadModel("Tarifasplane");
        Doo::loadModel("Tarifascar");

        $ratesroom = new Ratesroom();
        $tarifastrip = new Tarifastrip();
        $tarifasplane = new Tarifasplane();
        $tarifascar = new Tarifascar();

        $ratesroom->id = $this->params["pindex"];
        $tarifastrip->id = $this->params["pindex"];
        $tarifasplane->id = $this->params["pindex"];
        $tarifascar->id = $this->params["pindex"];

        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['ratesroom'] = Doo::db()->find($ratesroom, array('limit' => 1));
        $this->data['Tarifastrip'] = Doo::db()->find($tarifastrip, array('limit' => 1));
        $this->data['Tarifasplane'] = Doo::db()->find($tarifasplane, array('limit' => 1));
        $this->data['Tarifascar'] = Doo::db()->find($tarifascar, array('limit' => 1));
        $this->data['hotel'] = Doo::db()->find("hoteles", array("select id,nombre from hoteles", "asArray" => true));
        $this->data['content'] = 'configuracion/frm_rrates.php';
        $this->data['dato'] = "edit";
        $this->view()->renderc('admin/index', $this->data);
    }

    public function edit_comi() {
        Doo::loadModel("Ratesroom");
        Doo::loadModel("Tarifastrip");
        Doo::loadModel("Tarifasplane");
        Doo::loadModel("Tarifascar");

        $ratesroom = new Ratesroom();
        $tarifastrip = new Tarifastrip();
        $tarifasplane = new Tarifasplane();
        $tarifascar = new Tarifascar();

        $ratesroom->id = $this->params["pindex"];
        $tarifastrip->id = $this->params["pindex"];
        $tarifasplane->id = $this->params["pindex"];
        $tarifascar->id = $this->params["pindex"];

        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['ratesroom'] = Doo::db()->find($ratesroom, array('limit' => 1));
        $this->data['Tarifastrip'] = Doo::db()->find($tarifastrip, array('limit' => 1));
        $this->data['Tarifasplane'] = Doo::db()->find($tarifasplane, array('limit' => 1));
        $this->data['Tarifascar'] = Doo::db()->find($tarifascar, array('limit' => 1));
        $this->data['hotel'] = Doo::db()->find("hoteles", array("select id,nombre from hoteles", "asArray" => true));
        $this->data['content'] = 'configuracion/frm_rrates_commissionable.php';
        $this->data['dato'] = "edit";
        $this->view()->renderc('admin/index', $this->data);
    }
    
    
    public function delete() {
        Doo::loadModel("Ratesroom");
        Doo::loadModel("Tarifastrip");
        Doo::loadModel("Tarifasplane");
        Doo::loadModel("Tarifascar");

        $ratesroom = new Ratesroom();
        $ratesroom->id = $_REQUEST['item'];
        Doo::db()->delete($ratesroom);

        $tarifastrip = new Tarifastrip();
        $tarifastrip->id = $_REQUEST['item'];
        Doo::db()->delete($tarifastrip);

        $tarifasplane = new Tarifasplane();
        $tarifasplane->id = $_REQUEST['item'];
        Doo::db()->delete($tarifasplane);

        $tarifascar = new Tarifascar();
        $tarifascar->id = $_REQUEST['item'];
        Doo::db()->delete($tarifascar);



        Doo::db()->query("DELETE FROM  comifijas
								WHERE id_ratesvalid = $ratesroom->id");

        Doo::db()->query("DELETE FROM  tarifastrip
								WHERE id_ratesvalid = $tarifastrip->id");

        Doo::db()->query("DELETE FROM  tarifaplane
								WHERE id_ratesvalid = $tarifasplane->id");

        Doo::db()->query("DELETE FROM  tarifacar
								WHERE id_ratesvalid = $tarifascar->id");


        return Doo::conf()->APP_URL . "admin/tours/room-rates";
    }

}

<?php

/**
 * MainController
 *
 */
Doo::loadController('I18nController');
Doo::loadController('RecaptController');
Doo::loadHelper('DooPDF');
Doo::loadHelper('class.phpmailer');
class MainController extends DooController {
    static $variable;
    public $data;

    public function beforeRun($resource, $action) {

        if (isset($_SESSION['data_agency'])) {
            return "https://localhost/sistema/agency";
        }
    }

    /* FUNCIONES QUE CARGAN VISTAS PRINCIPALES */

    public function fleet() {
        if(isset($_SESSION["booking"])){//Sin comentarios, Sorry
            $booking = $_SESSION["booking"];
            $modalT = $this->naveganteT();
            print($modalT);
        }
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['areas'] = Doo::db()->find("Areas", array("select" => "id, nombre", "asArray" => true));
        $this->renderc('page/fleet-terminal-supertours', $this->data);
    }

    public function baggage() {
        if(isset($_SESSION["booking"])){//Sin comentarios, Sorry
            $booking = $_SESSION["booking"];
            $modalT = $this->naveganteT();
            print($modalT);
        }
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['areas'] = Doo::db()->find("Areas", array("select" => "id, nombre", "asArray" => true));
        $this->renderc('page/baggage', $this->data);
    }

    public function Localizar() {
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->renderc('page/localizador', $this->data);
    }

    public function conditionsT() {
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['areas'] = Doo::db()->find("Areas", array("select" => "id, nombre", "asArray" => true));
        $this->renderc('tours/terms-conditions-tours', $this->data);
    }

    public function policies() {
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['areas'] = Doo::db()->find("Areas", array("select" => "id, nombre", "asArray" => true));
        $this->renderc('tours/cancellation-policies', $this->data);
    }

    public function goal() {
        if(isset($_SESSION["booking"])){//Sin comentarios, Sorry
            $booking = $_SESSION["booking"];
            $modalT = $this->naveganteT();
            print($modalT);
        }
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['areas'] = Doo::db()->find("Areas", array("select" => "id, nombre", "asArray" => true));
        $this->renderc('page/goal-supertours-of-orlando', $this->data);
    }

    public function free() {
        if(isset($_SESSION["booking"])){
            $booking = $_SESSION["booking"];
            $modalT = $this->naveganteT();
            print($modalT);
        }
        if(!isset($_SESSION["booking"]['iden']) && $_SESSION["booking"]['iden'] == ''){
          // return Doo::conf()->APP_URL;
          $s = date("s");
          $iden = rand(10, 90) . 0 . rand(1, 9);
               $booking = $_SESSION["booking"];
              if($booking["iden"]!=""){
                  $iden = $booking["iden"];
              } else {
                  $iden = $iden;
              }
          $_SESSION["booking"]['iden'] = $iden;
      }
          // print_r($_SESSION["booking"]);
          // die;
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['areas'] = Doo::db()->find("Areas", array("select" => "id, nombre", "asArray" => true));
        $this->renderc('page/free-onboard', $this->data);
    }

    public function charters() {
        if(isset($_SESSION["booking"])){//Sin comentarios, Sorry
            $booking = $_SESSION["booking"];
            $modalT = $this->naveganteT();
            print($modalT);
        }
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['areas'] = Doo::db()->find("Areas", array("select" => "id, nombre", "asArray" => true));
        $this->renderc('page/charters-miami-orlando', $this->data);
    }

    public function GeneralInfo(){
      if (isset($_SESSION['user'])) {
      $sql = "CALL reservaxuser(".$_SESSION['user']->id.");";
      $res = Doo::db()->query($sql);

      $this->data['rootUrl'] = Doo::conf()->APP_URL;
      $this->data['infopersonal'] = $res->fetchAll();
    $this->renderc('generalinfo', $this->data);
    }else{
      return Doo::conf()->APP_URL;
    }
    }


    public function settinguser(){
      if (isset($_SESSION['user'])) {
      $sql1 = "SELECT * from clientes WHERE id = '" . $_SESSION['user']->id . "'";
    $rs1 = Doo::db()->query($sql1);
    $this->data['persinfo'] = $rs1->fetch(PDO::FETCH_OBJ);
        // print_r($this->data['persinfo']->tipo_client);
        // die;
        if($this->data['persinfo']->points == 1143364253){
          $sql3 = "SELECT *,( SELECT COUNT(*) FROM contactar WHERE estadoscont = 1) as cantidad from contactar WHERE estadoscont = 1";
          $rs3 = Doo::db()->query($sql3);
          $this->data['contactar'] = $rs3->fetchAll(PDO::FETCH_ASSOC);
        }
        //         print_r($this->data['persinfo']->points);
        // die;
    $this->data['rootUrl'] = Doo::conf()->APP_URL;
    $this->renderc('settingUser', $this->data);
      }else{
        return Doo::conf()->APP_URL;
      }

    }

    public function ajaxcountry(){
      $sql1 = "SELECT id as value, name as text from country ";
      $rs1 = Doo::db()->query($sql1);
      $data = $rs1->fetchAll(PDO::FETCH_OBJ);
     echo json_encode($data);
    }

    public function ajaxstate(){
      $sql1 = "SELECT id as value, name as text from state ";
      $rs1 = Doo::db()->query($sql1);
      $data = $rs1->fetchAll(PDO::FETCH_OBJ);
     echo json_encode($data);
    }

    public function saveinfouser(){
      $name = $_POST['name'];
      $valor = $_POST['value'];
      $pk = $_POST['pk'];
      $sttt = $_SESSION["user"]->state;
      $scountttt = $_SESSION["user"]->country;
//       echo '<pre>';
//       print_r($_POST);
//       echo '</pre>';
//       die;
      switch ($name) {
        case 'firstnameC':
          $update = "UPDATE clientes SET firstname='" . $valor . "' WHERE id = '" . $pk . "'   ";
          break;
        case 'lastnameC':
          $update = "UPDATE clientes SET lastname='" . $valor . "' WHERE id = '" . $pk . "'   ";
          break;
        case 'cityC':
          $update = "UPDATE clientes SET city='" . $valor . "' WHERE id = '" . $pk . "'   ";
          break;
        case 'zipC':
          $update = "UPDATE clientes SET zip='" . $valor . "' WHERE id = '" . $pk . "'   ";
          break;
        case 'phoneC':
          $update = "UPDATE clientes SET phone='" . $valor . "' WHERE id = '" . $pk . "'   ";
        break;
        case 'inputcountryC':
          $sql1 = "SELECT name from country WHERE id = '" . $valor . "'";
          $rs1 = Doo::db()->query($sql1);
          $count = $rs1->fetch(PDO::FETCH_OBJ);
          $update = "UPDATE clientes SET country='" . $count->name . "', state='" . $sttt . "' WHERE id = '" . $pk . "'   ";
          $_SESSION['user']->country = $count->name;
          break;
        case 'inputStateC':
          $sql2 = "SELECT name from state WHERE id = '" . $valor . "'";
          $rs2 = Doo::db()->query($sql2);
          $state = $rs2->fetch(PDO::FETCH_OBJ);
          $update = "UPDATE clientes SET state='" . $state->name . "' WHERE id = '" . $pk . "'   ";
          $_SESSION['user']->state = $state->name;
          break;
        case 'AddressC':
          $update = "UPDATE clientes SET address='" . $valor . "' WHERE id = '" . $pk . "'   ";
          break;
        case 'emailsC':
          $update = "UPDATE clientes SET username='" . $valor . "' WHERE id = '" . $pk . "'   ";
          break;

        default:
          # code...
          break;
      }
      // print_r($update);
      // die;

      if (Doo::db()->query($update)) {
        if($valor != 248 AND $name == 'inputcountryC'){
          $update2 = "UPDATE clientes SET state='OTHERS' WHERE id = '" . $pk . "'   ";
          Doo::db()->query($update2);
        }
        echo 'Your information was updated successfully';
        // return Doo::conf()->APP_URL . "setting_info?msj=Your information was updated successfully";
      }else{
        echo 'Ups! Could not update your information please try again later';
        // return Doo::conf()->APP_URL . "setting_info?msj=Ups! Could not update your information please try again later";
      }

  }

    public function updateinfo(){

      if ($_POST['country'] != 'UNITED STATES') {
         $estado = 'OTHERS';
      }else{
        $estado = $_POST['state'];
      }

      $update = "UPDATE clientes SET username = '" . $_POST['email'] . "' ,firstname='" . $_POST['firstname'] . "',lastname='" . $_POST['lastname'] . "',phone='" . $_POST['phone'] . "',city='" . $_POST['city'] . "',state='" . $estado . "',country='" . $_POST['country'] . "',address='" . $_POST['address'] . "',zip='" . $_POST['zip'] . "' WHERE id = '" . $_SESSION['user']->id . "'   ";
      if (Doo::db()->query($update)) {
        return Doo::conf()->APP_URL . "setting_info?msj=Your information was updated successfully";
      }else{
        return Doo::conf()->APP_URL . "setting_info?msj=Ups! Could not update your information please try again later";
      }
    }

    public function userlogin(){
      //if (isset($_SESSION['infoforms'])) {
      //  unset($_SESSION['infoforms']);
      //}

        $lasturl = $_SERVER['HTTP_REFERER'];
      $sql = "SELECT id, nombre FROM  areas WHERE id <> '20' ORDER BY orden ASC ";
      $rs = Doo::db()->query($sql);
      $areas = $rs->fetchAll();

      $sql1 = "SELECT * from clientes WHERE username = '" . $_POST['email'] . "' AND `password` = '" . $_POST['password'] . "'";
      $rs1 = Doo::db()->query($sql1);
      $info = $rs1->fetchAll(PDO::FETCH_OBJ);
      // print_r($info[0]->username);
      $lasturl = explode('?', $lasturl);
	  // echo '<pre>';
	  // print_r($lasturl[0]);
	  // echo '</pre>';
	  // die;

      // die;
      if (COUNT($info) > 0) {
        unset($_SESSION['signup2']);
        unset($_SESSION['infoforms']);
        unset($_SESSION ['toursinvi']);
        unset($_SESSION ['toursinvimulti']);

        $login = new stdclass();
        $login->username = $info[0]->username;
        $login->firstname = $info[0]->firstname;
        $login->lastname = $info[0]->lastname;
        $login->tipo_client = $info[0]->tipo_client;
        $login->zip = $info[0]->zip;
        $login->phone = $info[0]->phone;
        $login->celphone = $info[0]->celphone;
        $login->address = $info[0]->address;
        $login->state = $info[0]->state;
        $login->city = $info[0]->city;
        $login->id = $info[0]->id;
        $login->country = $info[0]->country;
        $_SESSION['user'] = $login;
        $this->data['persinfo'] = $info[0];
      // $this->data['persinfo']= $info ;
      // print_r(Doo::conf()->APP_URL.''.$lasturl);
      // die;
          $this->data['rootUrl'] = Doo::conf()->APP_URL;
          $this->data['areas'] = $areas;
      // return Doo::conf()->APP_URL;
      // $this->renderc('home2', $this->data);
      // return Doo::conf()->APP_URL;
      return $lasturl[0]. "?stat=true";
      }else{
          return Doo::conf()->APP_URL . "?stat=false";
      }
   }

      //   if (COUNT($rs[0]) > 0) {
      //     $_SESSION['admin'] = $rs[0];
      // // print_r($_SESSION);
      // // die;
      //     $this->renderc('home2', $this->data);
      //   }


      public function ajaxfrom(){
        $sql = "SELECT id, nombre FROM areas WHERE id <> '20' AND id <> '13' AND id <> '15' AND id <> '16' AND id <> '17' AND id <> '18' AND id <> '19' ORDER BY orden ASC ";
        $rs = Doo::db()->query($sql);
        $areas = $rs->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($areas);
    }

  //   public function ajaxto(){
  //     $idarea = $_POST['id'];
  //     // print_r($_POST);
  //     // die;
  //     $sql2 = "CALL areas($idarea)";
  //     $rs2 = Doo::db()->query($sql2);
  //     $areas2 = $rs2->fetchAll(PDO::FETCH_ASSOC);
  //     echo json_encode($areas2);
  // }

    public function updatepass(){
      $mailT = $_SESSION['user']->username;
      $this->data['rootUrl'] = Doo::conf()->APP_URL;
    $sql = "SELECT * FROM clientes WHERE `password` = '" . $_POST['oldpass'] . "' AND id = '" . $_SESSION['user']->id . "'";
      $rs = Doo::db()->query($sql);
      $user = $rs->fetchAll();
      if (COUNT($user) == 0) {
        return Doo::conf()->APP_URL . "setting_info?msj=Sorry, your current Password is whrong";
      }else{
        if ($_POST['newpass'] === $_POST['repeatpass']) {
          $update = "UPDATE clientes SET `password` = '" . $_POST['newpass'] . "' WHERE id = '" . $_SESSION['user']->id . "' ";
          if (Doo::db()->query($update)) {
            try {
              Doo::loadController('DatosMailController');
              $datosMail = new DatosMailController();
              $mail = new PHPMailer(true);;
               $mail2 = $datosMail->datos();

              $mail->FromName = "Supertours Of Orlando";
              //La direccion a donde mandamos el correo
              $nombre_destino = $data['firstname'];
              $mail->AddAddress($mailT, $nombre_destino);
              //$mail->AddCC("arbusmad2021@gmail.com");    //En este espacio debe
              $mail->AddBCC("arbusmad2021@gmail.com");    //En este espacio debe ir un correo de respaldo.
              $mail->AddBCC("arturo@supertours.com");    //En este espacio debe ir un correo de respaldo.
//                    //Asunto del correo
              $mail->Subject = 'Change of Password / Super Tours';
              //Mensaje alternativo en caso que el destinatario no pueda abrir correos HTML
              $mail->AltBody = 'Change Of Password';
//                    //El cuerpo del mensaje, puede ser con etiquetas HTML
              $mail->MsgHTML("<title>Mail</title>
              <style type='text/css'>
                  * { -webkit-text-size-adjust:none; -ms-text-size-adjust:none; max-height:1000000px;}
                  table {border-collapse: collapse !important;}
                  #outlook a {padding:0;}
                  .ReadMsgBody { width: 100%; }
                  .ExternalClass { width: 100%; }
                  .ExternalClass * { line-height: 100%; }
                  .ios_geo a { color:#1c1c1c !important; text-decoration:none !important; }

                  #clearTable {
                          /*width: 800px;*/
                          font-size: 13px;
                          font-family: Verdana, Geneva, sans-serif;
                  }
                  #clearTable tr #titletd3 {
                          font-family: Verdana, Geneva, sans-serif;
                  }
                  #clearTable tr #titletd2 {
                          font-size: 20px;
                  }
                  #clearTable tr td.p {
                          text-align: center;
                  }
                  #clearTable td{
                      padding: 1px 5px;

                  }
                  #content #center-column #tdgris {
                          background-color: #F0F0F0;
                  }
                  #content #center-column #tdrojo {
                          background-color: #FFE6E6;
                  }
                  #content #center-column1 #titletd {
                          background-color: #F5EDEB;
                          padding-left: 5px;
                          font-size: 12px;
                  }
                   #titlett {
                          background-color: #ececec;
                          color: #1f2b56;
                          padding-left: 5px;
                          font-size: 12px;
                  }
                   #titlell {
                          padding-left: 5px;
                          font-size: 12px;
                          border-bottom-width: 1px;
                          border-left-width: 1px;
                          border-bottom-style: solid;
                          border-left-style: solid;
                          border-bottom-color: #E6E6E6;
                          border-left-color: #E6E6E6;
                  }
                  #titlelp {
                          font-size: 11px;
                          border-bottom-width: 1px;
                          border-bottom-style: solid;
                          border-bottom-color: #E6E6E6;
                          border-right: 1px;
                          border-right-style: solid;
                          border-right-color: #e6e6e6;
                  }
                   #titlelr {
                          padding-left: 5px;
                          font-size: 12px;
                          border-top: 1px solid #2160a0;
                          color: #CE0000;
                  }
                   #tdgristable {
                          background-color: #FFF;
                          padding-left: 5px;
                  }
                  </style>

              <div align='center'>
              <br />
              <table   id='clearTable'>
                <tr>
                  <td width='401' height='33' rowspan='2' id='titletd3'><img src='".$this->data['rootUrl']."global/estilos/logo.png' width='316' height='88' /></td>
                  <td colspan='3' align='center' id='titletd3'>Supertours.com</td>
                </tr>
                <tr>
                  <td height='35' colspan='3' id='titletd4'>&nbsp;</td>
                </tr>
                <tr>
                  <td align='center' height='33' colspan='4' id='titletd2'>Change Of Password</td>
                </tr>

              <tr>
                <td colspan='4' ><table id='tableorder3' width='90%'>
                  <tr>
                    <td  height='35' colspan='3' id='titlett3'  aling='center' >RECEIPT</td>
                    </tr>

                  <tr>
                    <td width='34%' height='27'>UserName:</td>
                    <td colspan='2'>" . $_SESSION['user']->username . "</td>
                  </tr>
                  <tr>
                    <td height='27'>You New Password:</td>
                    <td>" . $_POST['newpass']. "</td>
                  </tr>
                  <tr>
                    <td height='27'>&nbsp;</td>
                    <td colspan='2'>&nbsp;</td>
                  </tr>
                </table>
                <p><br />
              </p></td>
              </tr>
              <tr>
                <td colspan='4'>&nbsp;</td>
              </tr>
              <tr>
                <td colspan='4'>&nbsp;</td>
              </tr>
              <tr>
                <td colspan='4' align='center'> <p align='center' class='titulopago'>THANK YOU FOR CHOOSING US <br />
                  SUPER TOURS.<br />
                  Phone: (407) 370-3001 Orlando / (305) 677-2676 Miami / e-mail: reservations@supertours.com

              </p>       </td>
              </tr>
              </table>

              </div>");
//                    //Archivos adjuntos
//                    //$mail->AddAttachment('img/logo.jpg');      // Archivos Adjuntos
//                    //Enviamos el correo
              $mail->Send();
//                    //
          } catch (phpmailerException $e) {
              echo $e->errorMessage(); //Errores de PhpMailer
          } catch (Exception $e) {
              echo $e->getMessage(); //Errores de cualquier otra cosa.
          }
//
            return Doo::conf()->APP_URL . "setting_info?msj=change successful, we send you a email with your new password, thank you for choosing Us.";
          }else{
            return Doo::conf()->APP_URL . "setting_info?msj=Ups! Could not update your Password please try again later";
          }
        }else {
          return Doo::conf()->APP_URL . "setting_info?msj=The new password Should be same";
        }

      }
    }

    public function contact() {
        if(isset($_SESSION["booking"])){//Sin comentarios, Sorry
            $booking = $_SESSION["booking"];
            $modalT = $this->naveganteT();
            print($modalT);
        }
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['areas'] = Doo::db()->find("Areas", array("select" => "id, nombre", "asArray" => true));

        $this->renderc('page/contact-us-supertours', $this->data);
    }

    public function destinations() {
        if(isset($_SESSION["booking"])){//Sin comentarios, Sorry
            $booking = $_SESSION["booking"];
            $modalT = $this->naveganteT();
            print($modalT);
        }
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['areas'] = Doo::db()->find("Areas", array("select" => "id, nombre", "asArray" => true));
        $this->renderc('page/destinations-florida', $this->data);
    }

        public function faq() {
        if(isset($_SESSION["booking"])){//Sin comentarios, Sorry
            $booking = $_SESSION["booking"];
            $modalT = $this->naveganteT();
            print($modalT);
        }
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        // $this->data['areas'] = Doo::db()->find("Areas", array("select" => "id, nombre", "asArray" => true));
        $this->renderc('page/faq', $this->data);
    }

    public function tickets() {
        if(isset($_SESSION["booking"])){//Sin comentarios, Sorry
            $booking = $_SESSION["booking"];
            $modalT = $this->naveganteT();
            print($modalT);
        }
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['areas'] = Doo::db()->find("Areas", array("select" => "id, nombre", "asArray" => true));
        $this->renderc('page/tickets-policy-supertours', $this->data);
    }

    public function daytour() {
        if(isset($_SESSION["booking"])){//Sin comentarios, Sorry
            $booking = $_SESSION["booking"];
            $modalT = $this->naveganteT();
            print($modalT);
        }
        unset($_SESSION['tourPagoMulDay']);
        unset($_SESSION['tourPagoOneDay']);
        unset($_SESSION['toursbooking']);
        $sql = "SELECT DISTINCT t2.id, t2.nombre  FROM routes t1
                LEFT JOIN areas t2 ON (t1.trip_from = t2.id)
                WHERE t1.type_rate = 0 AND t1.trip_to = 1 AND trip_no = 301
                ORDER BY t2.id DESC";
        $rs = Doo::db()->query($sql);
        $areas_ida = $rs->fetchAll();

        $sql1 = "SELECT DISTINCT t2.id, t2.nombre  FROM routes t1
                LEFT JOIN areas t2 ON (t1.trip_to = t2.id)
                WHERE t1.type_rate = 0 AND t1.trip_from = 1 AND trip_no = 300
                ORDER BY t2.id ASC";
        $rs1 = Doo::db()->query($sql1);
        $areas_return = $rs1->fetchAll();
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $consulta = Doo::db()->query('SELECT * FROM areas WHERE id <> "1" AND id <> "20" ');
        $response = $consulta->fetchAll();
        $this->data['areas'] = $response;
        $this->data['areas_ida'] = $areas_ida;
        $this->data['areas_return'] = $areas_return;
        $this->renderc('page/1-day-tour', $this->data);
    }

    public function hotel() {
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['areas'] = Doo::db()->find("Areas", array("select" => "id, nombre", "asArray" => true));
        $this->renderc('page/hotel-month', $this->data);
    }

    public function multitours() {
        if(isset($_SESSION["booking"])){//Sin comentarios, Sorry
            $booking = $_SESSION["booking"];
            $modalT = $this->naveganteT();
            print($modalT);
        }
        if(!isset($_SESSION["booking"]['iden']) && $_SESSION["booking"]['iden'] == ''){
          // return Doo::conf()->APP_URL;
          $s = date("s");
          $iden = rand(10, 90) . 0 . rand(1, 9);
               $booking = $_SESSION["booking"];
              if($booking["iden"]!=""){
                  $iden = $booking["iden"];
              } else {
                  $iden = $iden;
              }
          $_SESSION["booking"]['iden'] = $iden;
      }
          // print_r($_SESSION["booking"]);
          // die;
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['areas'] = Doo::db()->find("Areas", array("select" => "id, nombre", "asArray" => true));
        $this->data['content'] = 'home2.php';
        $this->renderc('page/multi-days-tours', $this->data, true);
    }

    public function index() {
      $hora_hoy = "";
    if($hora_hoy >= '21:45'){
        
    $sqlcap_100 = "SELECT DISTINCT capacity, capacity2, capacity3, capacity4, capacity5, spseats, sdseats, stseats, wfseats, sflexseats, spprcseats, toursseats FROM routes WHERE fecha_ini = '$fecha_mas_un_dia' AND trip_no = '100' ";
        $rscap_100 = Doo::db()->query($sqlcap_100);
        $capac_100 = $rscap_100->fetchAll();


        foreach ($capac_100 as $cap100) {

        }

        $capacidad1_100 = $cap100['capacity'];
        $capacidad2_100 = $cap100['capacity2'];
        $capacidad3_100 = $cap100['capacity3'];
        $capacidad4_100 = $cap100['capacity4'];
        $capacidad5_100 = $cap100['capacity5'];
        $stseats_100 = $cap100['stseats'];
        $spseats_100 = $cap100['spseats'];
        $sdseats_100 = $cap100['sdseats'];
        $wfseats_100 = $cap100['wfseats'];
        $sflexseats_100 = $cap100['sflexseats'];
        $spprcseats_100 = $cap100['spprcseats'];
        $toursseats_100 = $cap100['toursseats']; 

        $capacidad100 = $capacidad1_100 + $capacidad2_100 + $capacidad3_100 + $capacidad4_100 + $capacidad5_100;
        
        $trip = '100';
        $fecha = $fecha_mas_un_dia;
        
      //tarifa standard
        $sql_stdida100 = "SELECT (sum(pax) + sum(pax2))as tari_std
                          FROM  reservas 
                          Where trip_no = '$trip' AND fecha_salida = '$fecha' AND id1 = '1' AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
        $rs_stdida100 = Doo::db()->query($sql_stdida100, array($trip, $fecha));
        $r_stdida100 = $rs_stdida100->fetchAll();
        $std_seats_ida100 = $r_stdida100[0]['tari_std'] ? $r_stdida100[0]['tari_std'] : 0;

        $sql_stdretorno100 = "SELECT (sum(pax_r) + sum(pax2_r))as tari_std
                              FROM  reservas 
                              Where trip_no2 = '$trip' AND fecha_retorno = '$fecha' AND id2 = '1' AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
        $rs_stdretorno100 = Doo::db()->query($sql_stdretorno100, array($trip, $fecha));
        $r_stdretorno100 = $rs_stdretorno100->fetchAll();
        $std_seats_retorno100 = $r_stdretorno100[0]['tari_std'] ? $r_stdretorno100[0]['tari_std'] : 0;

        $standard_total100 = $std_seats_ida100 + $std_seats_retorno100;

        //echo $standard_total;
        //tarifa superflex
        $sqlflexida100 = "SELECT (sum(pax) + sum(pax2))as tari_flex
                          FROM  reservas 
                          Where trip_no = '$trip' AND fecha_salida = '$fecha' AND id1 = '2' AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
        $rsflexida100 = Doo::db()->query($sqlflexida100, array($trip, $fecha));
        $r_flexida100 = $rsflexida100->fetchAll();
        $superflex_seats_ida100 = $r_flexida100[0]['tari_flex'] ? $r_flexida100[0]['tari_flex'] : 0;

        $sqlflexretorno100 = "SELECT (sum(pax_r) + sum(pax2_r))as tari_flex
                              FROM  reservas 
                              Where trip_no2 = '$trip' AND fecha_retorno = '$fecha' AND id2 = '2' AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
        $rsflexretorno100 = Doo::db()->query($sqlflexretorno100, array($trip, $fecha));
        $r_flexretorno100 = $rsflexretorno100->fetchAll();
        $superflex_seats_retorno100 = $r_flexretorno100[0]['tari_flex'] ? $r_flexretorno100[0]['tari_flex'] : 0;

        $superflex_total100 = $superflex_seats_ida100 + $superflex_seats_retorno100;

        //echo $superflex_total;

        //webfare
        $sqlwebida100 = "SELECT (sum(pax) + sum(pax2))as webfare
                         FROM  reservas 
                         Where trip_no = '$trip' AND fecha_salida = '$fecha' AND id1 = '3' AND agency = '53' AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
        $rswebida100 = Doo::db()->query($sqlwebida100, array($trip, $fecha));
        $r_webida100 = $rswebida100->fetchAll();
        $webfare_ida100 = $r_webida100[0]['webfare'] ? $r_webida100[0]['webfare'] : 0;

        $sqlwebretorno100 = "SELECT (sum(pax_r) + sum(pax2_r))as webfare
                             FROM  reservas 
                             Where trip_no2 = '$trip' AND fecha_retorno = '$fecha' AND id2 = '3' AND agency = '53' AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
        $rswebretorno100 = Doo::db()->query($sqlwebretorno100, array($trip, $fecha));
        $r_webretorno100 = $rswebretorno100->fetchAll();
        $webfare_retorno100 = $r_webretorno100[0]['webfare'] ? $r_webretorno100[0]['webfare'] : 0;

        $webfare_total100 = $webfare_ida100 + $webfare_retorno100;

        //echo $webfare_total;
        //superpromo
        $sqlspromoida100 = "SELECT (sum(pax) + sum(pax2))as spromo
        FROM  reservas 
        Where trip_no = '$trip' AND fecha_salida = '$fecha' AND id1 = '4' AND agency = '53' AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
        $rsspromoida100 = Doo::db()->query($sqlspromoida100, array($trip, $fecha));
        $r_spromoida100 = $rsspromoida100->fetchAll();
        $superpromo_ida100 = $r_spromoida100[0]['spromo'] ? $r_spromoida100[0]['spromo'] : 0;

        $sqlspromoretorno100 = "SELECT (sum(pax_r) + sum(pax2_r))as spromo
                            FROM  reservas 
                            Where trip_no2 = '$trip' AND fecha_retorno = '$fecha' AND id2 = '4' AND agency = '53' AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
        $rsspromoretorno100 = Doo::db()->query($sqlspromoretorno100, array($trip, $fecha));
        $r_spromoretorno100 = $rsspromoretorno100->fetchAll();
        $superpromo_retorno100 = $r_spromoretorno100[0]['spromo'] ? $r_spromoretorno100[0]['spromo'] : 0;

        $superpromo_total100 = $superpromo_ida100 + $superpromo_retorno100;
        
        //echo $superpromo_total;
        //superdiscount
        $sqlsdiscida100 = "SELECT (sum(pax) + sum(pax2))as sdisc
                            FROM  reservas 
                            Where trip_no = '$trip' AND fecha_salida = '$fecha' AND id1 = '5' AND agency = '53' AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
        $rsdiscida100 = Doo::db()->query($sqlsdiscida100, array($trip, $fecha));
        $r_discida100 = $rsdiscida100->fetchAll();
        $superdisc_ida100 = $r_discida100[0]['sdisc'] ? $r_discida100[0]['sdisc'] : 0;

        $sqlsdiscretorno100 = "SELECT (sum(pax_r) + sum(pax2_r))as sdisc
                            FROM  reservas 
                            Where trip_no2 = '$trip' AND fecha_retorno = '$fecha' AND id2 = '5' AND agency = '53' AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
        $rssdiscretorno100 = Doo::db()->query($sqlsdiscretorno100, array($trip, $fecha));
        $r_discretorno100 = $rssdiscretorno100->fetchAll();
        $superdisc_retorno100 = $r_discretorno100[0]['sdisc'] ? $r_discretorno100[0]['sdisc'] : 0;

        $superdiscount_total100 = $superdisc_ida100 + $superdisc_retorno100;

        //echo $superdiscount_total;

        //tours
        //De Ida
        $sqlTourIda100 = "SELECT (sum(pax) + sum(pax2))as ocupadas_tour
                            FROM  reservas 
                            Where trip_no = '$trip' AND fecha_salida = '$fecha' AND (type_tour = 'ONE' OR type_tour = 'MULTI') AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
        $rstida100 = Doo::db()->query($sqlTourIda100, array($trip, $fecha));
        $r_tida100 = $rstida100->fetchAll();
        $ocupadas_tour_ida100 = $r_tida100[0]['ocupadas_tour'] ? $r_tida100[0]['ocupadas_tour'] : 0;


        //De Retorno
        $sqlTourReturn100 = "SELECT (sum(pax_r) + sum(pax2_r))as ocupadas_tour
                            FROM  reservas 
                            Where trip_no2 = '$trip' AND fecha_retorno = '$fecha' AND (type_tour = 'ONE' OR type_tour = 'MULTI') AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
        $rstreturn100 = Doo::db()->query($sqlTourReturn100, array($trip, $fecha));
        $r_treturn100 = $rstreturn100->fetchAll();
        $ocupadas_tour_return100 = $r_treturn100[0]['ocupadas_tour'] ? $r_treturn100[0]['ocupadas_tour'] : 0;


        $tours_total100 = $ocupadas_tour_ida100 + $ocupadas_tour_return100;

//                      echo $tours_total;
        //SPECIAL/////////////////////////////////////////////////////////////////

        $sql_spcida100 = "SELECT (sum(pax) + sum(pax2))as tari_spc
                            FROM  reservas 
                            Where trip_no = '$trip' AND fecha_salida = '$fecha' AND id1 = '6' AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
        $rs_spcida100 = Doo::db()->query($sql_spcida100, array($trip, $fecha));
        $r_spcida100 = $rs_spcida100->fetchAll();
        $spc_seats_ida100 = $r_spcida100[0]['tari_spc'] ? $r_spcida100[0]['tari_spc'] : 0;

        $sql_spcretorno100 = "SELECT (sum(pax_r) + sum(pax2_r))as tari_spc
                            FROM  reservas 
                            Where trip_no2 = '$trip' AND fecha_retorno = '$fecha' AND id2 = '6' AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
        $rs_spcretorno100 = Doo::db()->query($sql_spcretorno100, array($trip, $fecha));
        $r_spcretorno100 = $rs_spcretorno100->fetchAll();
        $spc_seats_retorno100 = $r_spcretorno100[0]['tari_spc'] ? $r_spcretorno100[0]['tari_spc'] : 0;

        $special_total100 = $spc_seats_ida100 + $spc_seats_retorno100;

        //echo $special_total;

        $ocupadas100 = $standard_total100 + $superflex_total100 + $webfare_total100 + $superpromo_total100 + $superdiscount_total100 + $tours_total100 + $special_total100;
        //$ocupadas100 = $standard_total100 + $superflex_total100 + $tours_total100 + $special_total100;
        //$seats_remain100 = ($capacidad100 - $ocupadas100)-($puestos_ocupados100);
        

        
        $seats_remain100 = ($capacidad100 - $ocupadas100);
        
        $reservados100 = $capacidad100 - $seats_remain100; 
        //$spseats =
        //$sdseats =
        
        $wfseats_100 = $reservados100;
        $stseats_100 = $reservados100;
        //$sflexseats =
        $spprcseats_100 = $reservados100;
        $toursseats_100 = $reservados100;
        
        $capacidad100 = $reservados100;
        $seats_remain100 = 0;


        if($sflexseats_100 > 0){                    
                    $sflexseats_100 = $cap100['sflexseats'];                  
        }else{
            $sflexseats_100 = 0;
        }

        if($spseats_100 > 0){                    
            $spseats_100 = $cap100['spseats'];
        }else{
            $spseats_100 = 0;
        }

        if($sdseats_100 > 0){                    
            $sdseats_100 = $cap100['sdseats'];
        }else{                    
            $sdseats_100 = 0;
        }

        //$result = ($capacidad100 - $ocupadas100)-($puestos_ocupados100);
        //return array($result,$result_standard100,$result_superflex100,$result_webfare100,$result_superpromo100,$result_superdiscount100);   
            
         

        
      Doo::db()->query("UPDATE routes SET capacity = '$capacidad100', seats_remain = '$seats_remain100', wfseats = '$wfseats_100', stseats = '$stseats_100', sflexseats = '$sflexseats_100', spseats = '$spseats_100', sdseats = '$sdseats_100', spprcseats = '$spprcseats_100', toursseats = '$toursseats_100'  WHERE fecha_ini = '$fecha_mas_un_dia'  AND trip_no = '100'");        
               
         
      //301
      
      $sqlcap_301 = "SELECT DISTINCT capacity, capacity2, capacity3, capacity4, capacity5, spseats, sdseats, stseats, wfseats, sflexseats, spprcseats, toursseats FROM routes WHERE fecha_ini = '$fecha_mas_un_dia' AND trip_no = '301' ";
        $rscap_301 = Doo::db()->query($sqlcap_301);
        $capac_301 = $rscap_301->fetchAll();
        
        foreach ($capac_301 as $cap301) {

        }

        $capacidad1_301 = $cap301['capacity'];
        $capacidad2_301 = $cap301['capacity2'];
        $capacidad3_301 = $cap301['capacity3'];
        $capacidad4_301 = $cap301['capacity4'];
        $capacidad5_301 = $cap301['capacity5'];
        $stseats_301 = $cap301['stseats'];
        $spseats_301 = $cap301['spseats'];
        $sdseats_301 = $cap301['sdseats'];
        $wfseats_301 = $cap301['wfseats'];
        $sflexseats_301 = $cap301['sflexseats'];
        $spprcseats_301 = $cap301['spprcseats'];
        $toursseats_301 = $cap301['toursseats']; 

        $capacidad301 = $capacidad1_301 + $capacidad2_301 + $capacidad3_301 + $capacidad4_301 + $capacidad5_301;
        
        $trip = '301';
        $fecha = $fecha_mas_un_dia;
        
      //tarifa standard
        $sql_stdida301 = "SELECT (sum(pax) + sum(pax2))as tari_std
                          FROM  reservas 
                          Where trip_no = '$trip' AND fecha_salida = '$fecha' AND id1 = '1' AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
        $rs_stdida301 = Doo::db()->query($sql_stdida301, array($trip, $fecha));
        $r_stdida301 = $rs_stdida301->fetchAll();
        $std_seats_ida301 = $r_stdida301[0]['tari_std'] ? $r_stdida301[0]['tari_std'] : 0;

        $sql_stdretorno301 = "SELECT (sum(pax_r) + sum(pax2_r))as tari_std
                              FROM  reservas 
                              Where trip_no2 = '$trip' AND fecha_retorno = '$fecha' AND id2 = '1' AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
        $rs_stdretorno301 = Doo::db()->query($sql_stdretorno301, array($trip, $fecha));
        $r_stdretorno301 = $rs_stdretorno301->fetchAll();
        $std_seats_retorno301 = $r_stdretorno301[0]['tari_std'] ? $r_stdretorno301[0]['tari_std'] : 0;

        $standard_total301 = $std_seats_ida301 + $std_seats_retorno301;

        //echo $standard_total;
        //tarifa superflex
        $sqlflexida301 = "SELECT (sum(pax) + sum(pax2))as tari_flex
                          FROM  reservas 
                          Where trip_no = '$trip' AND fecha_salida = '$fecha' AND id1 = '2' AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
        $rsflexida301 = Doo::db()->query($sqlflexida301, array($trip, $fecha));
        $r_flexida301 = $rsflexida301->fetchAll();
        $superflex_seats_ida301 = $r_flexida301[0]['tari_flex'] ? $r_flexida301[0]['tari_flex'] : 0;

        $sqlflexretorno301 = "SELECT (sum(pax_r) + sum(pax2_r))as tari_flex
                              FROM  reservas 
                              Where trip_no2 = '$trip' AND fecha_retorno = '$fecha' AND id2 = '2' AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
        $rsflexretorno301 = Doo::db()->query($sqlflexretorno301, array($trip, $fecha));
        $r_flexretorno301 = $rsflexretorno301->fetchAll();
        $superflex_seats_retorno301 = $r_flexretorno301[0]['tari_flex'] ? $r_flexretorno301[0]['tari_flex'] : 0;

        $superflex_total301 = $superflex_seats_ida301 + $superflex_seats_retorno301;

        //echo $superflex_total;

        //webfare
        $sqlwebida301 = "SELECT (sum(pax) + sum(pax2))as webfare
                         FROM  reservas 
                         Where trip_no = '$trip' AND fecha_salida = '$fecha' AND id1 = '3' AND agency = '53' AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
        $rswebida301 = Doo::db()->query($sqlwebida301, array($trip, $fecha));
        $r_webida301 = $rswebida301->fetchAll();
        $webfare_ida301 = $r_webida301[0]['webfare'] ? $r_webida301[0]['webfare'] : 0;

        $sqlwebretorno301 = "SELECT (sum(pax_r) + sum(pax2_r))as webfare
                             FROM  reservas 
                             Where trip_no2 = '$trip' AND fecha_retorno = '$fecha' AND id2 = '3' AND agency = '53' AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
        $rswebretorno301 = Doo::db()->query($sqlwebretorno301, array($trip, $fecha));
        $r_webretorno301 = $rswebretorno301->fetchAll();
        $webfare_retorno301 = $r_webretorno301[0]['webfare'] ? $r_webretorno301[0]['webfare'] : 0;

        $webfare_total301 = $webfare_ida301 + $webfare_retorno301;

        //echo $webfare_total;
        //superpromo
        $sqlspromoida301 = "SELECT (sum(pax) + sum(pax2))as spromo
        FROM  reservas 
        Where trip_no = '$trip' AND fecha_salida = '$fecha' AND id1 = '4' AND agency = '53' AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
        $rsspromoida301 = Doo::db()->query($sqlspromoida301, array($trip, $fecha));
        $r_spromoida301 = $rsspromoida301->fetchAll();
        $superpromo_ida301 = $r_spromoida301[0]['spromo'] ? $r_spromoida301[0]['spromo'] : 0;

        $sqlspromoretorno301 = "SELECT (sum(pax_r) + sum(pax2_r))as spromo
                            FROM  reservas 
                            Where trip_no2 = '$trip' AND fecha_retorno = '$fecha' AND id2 = '4' AND agency = '53' AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
        $rsspromoretorno301 = Doo::db()->query($sqlspromoretorno301, array($trip, $fecha));
        $r_spromoretorno301 = $rsspromoretorno301->fetchAll();
        $superpromo_retorno301 = $r_spromoretorno301[0]['spromo'] ? $r_spromoretorno301[0]['spromo'] : 0;

        $superpromo_total301 = $superpromo_ida301 + $superpromo_retorno301;

        //echo $superpromo_total;
        //superdiscount
        $sqlsdiscida301 = "SELECT (sum(pax) + sum(pax2))as sdisc
                            FROM  reservas 
                            Where trip_no = '$trip' AND fecha_salida = '$fecha' AND id1 = '5' AND agency = '53' AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
        $rsdiscida301 = Doo::db()->query($sqlsdiscida301, array($trip, $fecha));
        $r_discida301 = $rsdiscida301->fetchAll();
        $superdisc_ida301 = $r_discida301[0]['sdisc'] ? $r_discida301[0]['sdisc'] : 0;

        $sqlsdiscretorno301 = "SELECT (sum(pax_r) + sum(pax2_r))as sdisc
                            FROM  reservas 
                            Where trip_no2 = '$trip' AND fecha_retorno = '$fecha' AND id2 = '5' AND agency = '53' AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
        $rssdiscretorno301 = Doo::db()->query($sqlsdiscretorno301, array($trip, $fecha));
        $r_discretorno301 = $rssdiscretorno301->fetchAll();
        $superdisc_retorno301 = $r_discretorno301[0]['sdisc'] ? $r_discretorno301[0]['sdisc'] : 0;

        $superdiscount_total301 = $superdisc_ida301 + $superdisc_retorno301;

        //echo $superdiscount_total;

        //tours
        //De Ida
        $sqlTourIda301 = "SELECT (sum(pax) + sum(pax2))as ocupadas_tour
                            FROM  reservas 
                            Where trip_no = '$trip' AND fecha_salida = '$fecha' AND (type_tour = 'ONE' OR type_tour = 'MULTI') AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
        $rstida301 = Doo::db()->query($sqlTourIda301, array($trip, $fecha));
        $r_tida301 = $rstida301->fetchAll();
        $ocupadas_tour_ida301 = $r_tida301[0]['ocupadas_tour'] ? $r_tida301[0]['ocupadas_tour'] : 0;


        //De Retorno
        $sqlTourReturn301 = "SELECT (sum(pax_r) + sum(pax2_r))as ocupadas_tour
                            FROM  reservas 
                            Where trip_no2 = '$trip' AND fecha_retorno = '$fecha' AND (type_tour = 'ONE' OR type_tour = 'MULTI') AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
        $rstreturn301 = Doo::db()->query($sqlTourReturn301, array($trip, $fecha));
        $r_treturn301 = $rstreturn301->fetchAll();
        $ocupadas_tour_return301 = $r_treturn301[0]['ocupadas_tour'] ? $r_treturn301[0]['ocupadas_tour'] : 0;


        $tours_total301 = $ocupadas_tour_ida301 + $ocupadas_tour_return301;

//                      echo $tours_total;
        //SPECIAL/////////////////////////////////////////////////////////////////

        $sql_spcida301 = "SELECT (sum(pax) + sum(pax2))as tari_spc
                            FROM  reservas 
                            Where trip_no = '$trip' AND fecha_salida = '$fecha' AND id1 = '6' AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
        $rs_spcida301 = Doo::db()->query($sql_spcida301, array($trip, $fecha));
        $r_spcida301 = $rs_spcida301->fetchAll();
        $spc_seats_ida301 = $r_spcida301[0]['tari_spc'] ? $r_spcida301[0]['tari_spc'] : 0;

        $sql_spcretorno301 = "SELECT (sum(pax_r) + sum(pax2_r))as tari_spc
                            FROM  reservas 
                            Where trip_no2 = '$trip' AND fecha_retorno = '$fecha' AND id2 = '6' AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
        $rs_spcretorno301 = Doo::db()->query($sql_spcretorno301, array($trip, $fecha));
        $r_spcretorno301 = $rs_spcretorno301->fetchAll();
        $spc_seats_retorno301 = $r_spcretorno301[0]['tari_spc'] ? $r_spcretorno301[0]['tari_spc'] : 0;

        $special_total301 = $spc_seats_ida301 + $spc_seats_retorno301;

        //echo $special_total;

        $ocupadas301 = $standard_total301 + $superflex_total301 + $webfare_total301 + $superpromo_total301 + $superdiscount_total301 + $tours_total301 + $special_total301;
        //$ocupadas301 = $standard_total301 + $superflex_total301 + $tours_total301 + $special_total301;
        //$seats_remain301 = ($capacidad301 - $ocupadas301)-($puestos_ocupados301);
        

        
        $seats_remain301 = ($capacidad301 - $ocupadas301);
        
        $reservados301 = $capacidad301 - $seats_remain301; 
        //$spseats =
        //$sdseats =
        
        $wfseats_301 = $reservados301;
        $stseats_301 = $reservados301;
        //$sflexseats =
        $spprcseats_301 = $reservados301;
        $toursseats_301 = $reservados301;
        
        $capacidad301 = $reservados301;
        $seats_remain301 = 0;


        if($sflexseats_301 > 0){                    
                    $sflexseats_301 = $cap301['sflexseats'];                  
        }else{
            $sflexseats_301 = 0;
        }

        if($spseats_301 > 0){                    
            $spseats_301 = $cap301['spseats'];
        }else{
            $spseats_301 = 0;
        }

        if($sdseats_301 > 0){                    
            $sdseats_301 = $cap301['sdseats'];
        }else{                    
            $sdseats_301 = 0;
        }

        //$result = ($capacidad301 - $ocupadas301)-($puestos_ocupados301);
        //return array($result,$result_standard301,$result_superflex301,$result_webfare301,$result_superpromo301,$result_superdiscount301);   
            
         

        
      Doo::db()->query("UPDATE routes SET capacity = '$capacidad301', seats_remain = '$seats_remain301', wfseats = '$wfseats_301', stseats = '$stseats_301', sflexseats = '$sflexseats_301', spseats = '$spseats_301', sdseats = '$sdseats_301', spprcseats = '$spprcseats_301', toursseats = '$toursseats_301'  WHERE fecha_ini = '$fecha_mas_un_dia'  AND trip_no = '301'");        
           
           
      //705
      
        $sqlcap_705 = "SELECT DISTINCT capacity, capacity2, capacity3, capacity4, capacity5, spseats, sdseats, stseats, wfseats, sflexseats, spprcseats, toursseats FROM routes WHERE fecha_ini = '$fecha_mas_un_dia' AND trip_no = '705' ";
        $rscap_705 = Doo::db()->query($sqlcap_705);
        $capac_705 = $rscap_705->fetchAll();


        foreach ($capac_705 as $cap705) {

        }

        $capacidad1_705 = $cap705['capacity'];
        $capacidad2_705 = $cap705['capacity2'];
        $capacidad3_705 = $cap705['capacity3'];
        $capacidad4_705 = $cap705['capacity4'];
        $capacidad5_705 = $cap705['capacity5'];
        $stseats_705 = $cap705['stseats'];
        $spseats_705 = $cap705['spseats'];
        $sdseats_705 = $cap705['sdseats'];
        $wfseats_705 = $cap705['wfseats'];
        $sflexseats_705 = $cap705['sflexseats'];
        $spprcseats_705 = $cap705['spprcseats'];
        $toursseats_705 = $cap705['toursseats']; 

        $capacidad705 = $capacidad1_705 + $capacidad2_705 + $capacidad3_705 + $capacidad4_705 + $capacidad5_705;
        
        $trip = '705';
        $fecha = $fecha_mas_un_dia;
        
      //tarifa standard
        $sql_stdida705 = "SELECT (sum(pax) + sum(pax2))as tari_std
                          FROM  reservas 
                          Where trip_no = '$trip' AND fecha_salida = '$fecha' AND id1 = '1' AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
        $rs_stdida705 = Doo::db()->query($sql_stdida705, array($trip, $fecha));
        $r_stdida705 = $rs_stdida705->fetchAll();
        $std_seats_ida705 = $r_stdida705[0]['tari_std'] ? $r_stdida705[0]['tari_std'] : 0;

        $sql_stdretorno705 = "SELECT (sum(pax_r) + sum(pax2_r))as tari_std
                              FROM  reservas 
                              Where trip_no2 = '$trip' AND fecha_retorno = '$fecha' AND id2 = '1' AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
        $rs_stdretorno705 = Doo::db()->query($sql_stdretorno705, array($trip, $fecha));
        $r_stdretorno705 = $rs_stdretorno705->fetchAll();
        $std_seats_retorno705 = $r_stdretorno705[0]['tari_std'] ? $r_stdretorno705[0]['tari_std'] : 0;

        $standard_total705 = $std_seats_ida705 + $std_seats_retorno705;

        //echo $standard_total;
        //tarifa superflex
        $sqlflexida705 = "SELECT (sum(pax) + sum(pax2))as tari_flex
                          FROM  reservas 
                          Where trip_no = '$trip' AND fecha_salida = '$fecha' AND id1 = '2' AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
        $rsflexida705 = Doo::db()->query($sqlflexida705, array($trip, $fecha));
        $r_flexida705 = $rsflexida705->fetchAll();
        $superflex_seats_ida705 = $r_flexida705[0]['tari_flex'] ? $r_flexida705[0]['tari_flex'] : 0;

        $sqlflexretorno705 = "SELECT (sum(pax_r) + sum(pax2_r))as tari_flex
                              FROM  reservas 
                              Where trip_no2 = '$trip' AND fecha_retorno = '$fecha' AND id2 = '2' AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
        $rsflexretorno705 = Doo::db()->query($sqlflexretorno705, array($trip, $fecha));
        $r_flexretorno705 = $rsflexretorno705->fetchAll();
        $superflex_seats_retorno705 = $r_flexretorno705[0]['tari_flex'] ? $r_flexretorno705[0]['tari_flex'] : 0;

        $superflex_total705 = $superflex_seats_ida705 + $superflex_seats_retorno705;

        //echo $superflex_total;

        //webfare
        $sqlwebida705 = "SELECT (sum(pax) + sum(pax2))as webfare
                         FROM  reservas 
                         Where trip_no = '$trip' AND fecha_salida = '$fecha' AND id1 = '3' AND agency = '53' AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
        $rswebida705 = Doo::db()->query($sqlwebida705, array($trip, $fecha));
        $r_webida705 = $rswebida705->fetchAll();
        $webfare_ida705 = $r_webida705[0]['webfare'] ? $r_webida705[0]['webfare'] : 0;

        $sqlwebretorno705 = "SELECT (sum(pax_r) + sum(pax2_r))as webfare
                             FROM  reservas 
                             Where trip_no2 = '$trip' AND fecha_retorno = '$fecha' AND id2 = '3' AND agency = '53' AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
        $rswebretorno705 = Doo::db()->query($sqlwebretorno705, array($trip, $fecha));
        $r_webretorno705 = $rswebretorno705->fetchAll();
        $webfare_retorno705 = $r_webretorno705[0]['webfare'] ? $r_webretorno705[0]['webfare'] : 0;

        $webfare_total705 = $webfare_ida705 + $webfare_retorno705;

        //echo $webfare_total;
        //superpromo
        $sqlspromoida705 = "SELECT (sum(pax) + sum(pax2))as spromo
        FROM  reservas 
        Where trip_no = '$trip' AND fecha_salida = '$fecha' AND id1 = '4' AND agency = '53' AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
        $rsspromoida705 = Doo::db()->query($sqlspromoida705, array($trip, $fecha));
        $r_spromoida705 = $rsspromoida705->fetchAll();
        $superpromo_ida705 = $r_spromoida705[0]['spromo'] ? $r_spromoida705[0]['spromo'] : 0;

        $sqlspromoretorno705 = "SELECT (sum(pax_r) + sum(pax2_r))as spromo
                            FROM  reservas 
                            Where trip_no2 = '$trip' AND fecha_retorno = '$fecha' AND id2 = '4' AND agency = '53' AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
        $rsspromoretorno705 = Doo::db()->query($sqlspromoretorno705, array($trip, $fecha));
        $r_spromoretorno705 = $rsspromoretorno705->fetchAll();
        $superpromo_retorno705 = $r_spromoretorno705[0]['spromo'] ? $r_spromoretorno705[0]['spromo'] : 0;

        $superpromo_total705 = $superpromo_ida705 + $superpromo_retorno705;

        //echo $superpromo_total;
        //superdiscount
        $sqlsdiscida705 = "SELECT (sum(pax) + sum(pax2))as sdisc
                            FROM  reservas 
                            Where trip_no = '$trip' AND fecha_salida = '$fecha' AND id1 = '5' AND agency = '53' AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
        $rsdiscida705 = Doo::db()->query($sqlsdiscida705, array($trip, $fecha));
        $r_discida705 = $rsdiscida705->fetchAll();
        $superdisc_ida705 = $r_discida705[0]['sdisc'] ? $r_discida705[0]['sdisc'] : 0;

        $sqlsdiscretorno705 = "SELECT (sum(pax_r) + sum(pax2_r))as sdisc
                            FROM  reservas 
                            Where trip_no2 = '$trip' AND fecha_retorno = '$fecha' AND id2 = '5' AND agency = '53' AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
        $rssdiscretorno705 = Doo::db()->query($sqlsdiscretorno705, array($trip, $fecha));
        $r_discretorno705 = $rssdiscretorno705->fetchAll();
        $superdisc_retorno705 = $r_discretorno705[0]['sdisc'] ? $r_discretorno705[0]['sdisc'] : 0;

        $superdiscount_total705 = $superdisc_ida705 + $superdisc_retorno705;

        //echo $superdiscount_total;

        //tours
        //De Ida
        $sqlTourIda705 = "SELECT (sum(pax) + sum(pax2))as ocupadas_tour
                            FROM  reservas 
                            Where trip_no = '$trip' AND fecha_salida = '$fecha' AND (type_tour = 'ONE' OR type_tour = 'MULTI') AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
        $rstida705 = Doo::db()->query($sqlTourIda705, array($trip, $fecha));
        $r_tida705 = $rstida705->fetchAll();
        $ocupadas_tour_ida705 = $r_tida705[0]['ocupadas_tour'] ? $r_tida705[0]['ocupadas_tour'] : 0;


        //De Retorno
        $sqlTourReturn705 = "SELECT (sum(pax_r) + sum(pax2_r))as ocupadas_tour
                            FROM  reservas 
                            Where trip_no2 = '$trip' AND fecha_retorno = '$fecha' AND (type_tour = 'ONE' OR type_tour = 'MULTI') AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
        $rstreturn705 = Doo::db()->query($sqlTourReturn705, array($trip, $fecha));
        $r_treturn705 = $rstreturn705->fetchAll();
        $ocupadas_tour_return705 = $r_treturn705[0]['ocupadas_tour'] ? $r_treturn705[0]['ocupadas_tour'] : 0;


        $tours_total705 = $ocupadas_tour_ida705 + $ocupadas_tour_return705;

//                      echo $tours_total;
        //SPECIAL/////////////////////////////////////////////////////////////////

        $sql_spcida705 = "SELECT (sum(pax) + sum(pax2))as tari_spc
                            FROM  reservas 
                            Where trip_no = '$trip' AND fecha_salida = '$fecha' AND id1 = '6' AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
        $rs_spcida705 = Doo::db()->query($sql_spcida705, array($trip, $fecha));
        $r_spcida705 = $rs_spcida705->fetchAll();
        $spc_seats_ida705 = $r_spcida705[0]['tari_spc'] ? $r_spcida705[0]['tari_spc'] : 0;

        $sql_spcretorno705 = "SELECT (sum(pax_r) + sum(pax2_r))as tari_spc
                            FROM  reservas 
                            Where trip_no2 = '$trip' AND fecha_retorno = '$fecha' AND id2 = '6' AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
        $rs_spcretorno705 = Doo::db()->query($sql_spcretorno705, array($trip, $fecha));
        $r_spcretorno705 = $rs_spcretorno705->fetchAll();
        $spc_seats_retorno705 = $r_spcretorno705[0]['tari_spc'] ? $r_spcretorno705[0]['tari_spc'] : 0;

        $special_total705 = $spc_seats_ida705 + $spc_seats_retorno705;

        //echo $special_total;

        $ocupadas705 = $standard_total705 + $superflex_total705 + $webfare_total705 + $superpromo_total705 + $superdiscount_total705 + $tours_total705 + $special_total705;
        //$ocupadas705 = $standard_total705 + $superflex_total705 + $tours_total705 + $special_total705;
        //$seats_remain705 = ($capacidad705 - $ocupadas705)-($puestos_ocupados705);
        

        
        $seats_remain705 = ($capacidad705 - $ocupadas705);
        
        $reservados705 = $capacidad705 - $seats_remain705; 
        //$spseats =
        //$sdseats =
        
        $wfseats_705 = $reservados705;
        $stseats_705 = $reservados705;
        //$sflexseats =
        $spprcseats_705 = $reservados705;
        $toursseats_705 = $reservados705;
        
        $capacidad705 = $reservados705;
        $seats_remain705 = 0;


        if($sflexseats_705 > 0){                    
                    $sflexseats_705 = $cap705['sflexseats'];                  
        }else{
            $sflexseats_705 = 0;
        }

        if($spseats_705 > 0){                    
            $spseats_705 = $cap705['spseats'];
        }else{
            $spseats_705 = 0;
        }

        if($sdseats_705 > 0){                    
            $sdseats_705 = $cap705['sdseats'];
        }else{                    
            $sdseats_705 = 0;
        }

        //$result = ($capacidad705 - $ocupadas705)-($puestos_ocupados705);
        //return array($result,$result_standard705,$result_superflex705,$result_webfare705,$result_superpromo705,$result_superdiscount705);   
            
         

        
      Doo::db()->query("UPDATE routes SET capacity = '$capacidad705', seats_remain = '$seats_remain705', wfseats = '$wfseats_705', stseats = '$stseats_705', sflexseats = '$sflexseats_705', spseats = '$spseats_705', sdseats = '$sdseats_705', spprcseats = '$spprcseats_705', toursseats = '$toursseats_705'  WHERE fecha_ini = '$fecha_mas_un_dia'  AND trip_no = '705'");        
          
   
    //710
      
        $sqlcap_710 = "SELECT DISTINCT capacity, capacity2, capacity3, capacity4, capacity5, spseats, sdseats, stseats, wfseats, sflexseats, spprcseats, toursseats FROM routes WHERE fecha_ini = '$fecha_mas_un_dia' AND trip_no = '710' ";
        $rscap_710 = Doo::db()->query($sqlcap_710);
        $capac_710 = $rscap_710->fetchAll();


        foreach ($capac_710 as $cap710) {

        }

        $capacidad1_710 = $cap710['capacity'];
        $capacidad2_710 = $cap710['capacity2'];
        $capacidad3_710 = $cap710['capacity3'];
        $capacidad4_710 = $cap710['capacity4'];
        $capacidad5_710 = $cap710['capacity5'];
        $stseats_710 = $cap710['stseats'];
        $spseats_710 = $cap710['spseats'];
        $sdseats_710 = $cap710['sdseats'];
        $wfseats_710 = $cap710['wfseats'];
        $sflexseats_710 = $cap710['sflexseats'];
        $spprcseats_710 = $cap710['spprcseats'];
        $toursseats_710 = $cap710['toursseats']; 

        $capacidad710 = $capacidad1_710 + $capacidad2_710 + $capacidad3_710 + $capacidad4_710 + $capacidad5_710;
        
        $trip = '710';
        $fecha = $fecha_mas_un_dia;
        
      //tarifa standard
        $sql_stdida710 = "SELECT (sum(pax) + sum(pax2))as tari_std
                          FROM  reservas 
                          Where trip_no = '$trip' AND fecha_salida = '$fecha' AND id1 = '1' AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
        $rs_stdida710 = Doo::db()->query($sql_stdida710, array($trip, $fecha));
        $r_stdida710 = $rs_stdida710->fetchAll();
        $std_seats_ida710 = $r_stdida710[0]['tari_std'] ? $r_stdida710[0]['tari_std'] : 0;

        $sql_stdretorno710 = "SELECT (sum(pax_r) + sum(pax2_r))as tari_std
                              FROM  reservas 
                              Where trip_no2 = '$trip' AND fecha_retorno = '$fecha' AND id2 = '1' AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
        $rs_stdretorno710 = Doo::db()->query($sql_stdretorno710, array($trip, $fecha));
        $r_stdretorno710 = $rs_stdretorno710->fetchAll();
        $std_seats_retorno710 = $r_stdretorno710[0]['tari_std'] ? $r_stdretorno710[0]['tari_std'] : 0;

        $standard_total710 = $std_seats_ida710 + $std_seats_retorno710;

        //echo $standard_total;
        //tarifa superflex
        $sqlflexida710 = "SELECT (sum(pax) + sum(pax2))as tari_flex
                          FROM  reservas 
                          Where trip_no = '$trip' AND fecha_salida = '$fecha' AND id1 = '2' AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
        $rsflexida710 = Doo::db()->query($sqlflexida710, array($trip, $fecha));
        $r_flexida710 = $rsflexida710->fetchAll();
        $superflex_seats_ida710 = $r_flexida710[0]['tari_flex'] ? $r_flexida710[0]['tari_flex'] : 0;

        $sqlflexretorno710 = "SELECT (sum(pax_r) + sum(pax2_r))as tari_flex
                              FROM  reservas 
                              Where trip_no2 = '$trip' AND fecha_retorno = '$fecha' AND id2 = '2' AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
        $rsflexretorno710 = Doo::db()->query($sqlflexretorno710, array($trip, $fecha));
        $r_flexretorno710 = $rsflexretorno710->fetchAll();
        $superflex_seats_retorno710 = $r_flexretorno710[0]['tari_flex'] ? $r_flexretorno710[0]['tari_flex'] : 0;

        $superflex_total710 = $superflex_seats_ida710 + $superflex_seats_retorno710;

        //echo $superflex_total;

        //webfare
        $sqlwebida710 = "SELECT (sum(pax) + sum(pax2))as webfare
                         FROM  reservas 
                         Where trip_no = '$trip' AND fecha_salida = '$fecha' AND id1 = '3' AND agency = '53' AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
        $rswebida710 = Doo::db()->query($sqlwebida710, array($trip, $fecha));
        $r_webida710 = $rswebida710->fetchAll();
        $webfare_ida710 = $r_webida710[0]['webfare'] ? $r_webida710[0]['webfare'] : 0;

        $sqlwebretorno710 = "SELECT (sum(pax_r) + sum(pax2_r))as webfare
                             FROM  reservas 
                             Where trip_no2 = '$trip' AND fecha_retorno = '$fecha' AND id2 = '3' AND agency = '53' AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
        $rswebretorno710 = Doo::db()->query($sqlwebretorno710, array($trip, $fecha));
        $r_webretorno710 = $rswebretorno710->fetchAll();
        $webfare_retorno710 = $r_webretorno710[0]['webfare'] ? $r_webretorno710[0]['webfare'] : 0;

        $webfare_total710 = $webfare_ida710 + $webfare_retorno710;

        //echo $webfare_total;
        //superpromo
        $sqlspromoida710 = "SELECT (sum(pax) + sum(pax2))as spromo
        FROM  reservas 
        Where trip_no = '$trip' AND fecha_salida = '$fecha' AND id1 = '4' AND agency = '53' AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
        $rsspromoida710 = Doo::db()->query($sqlspromoida710, array($trip, $fecha));
        $r_spromoida710 = $rsspromoida710->fetchAll();
        $superpromo_ida710 = $r_spromoida710[0]['spromo'] ? $r_spromoida710[0]['spromo'] : 0;

        $sqlspromoretorno710 = "SELECT (sum(pax_r) + sum(pax2_r))as spromo
                            FROM  reservas 
                            Where trip_no2 = '$trip' AND fecha_retorno = '$fecha' AND id2 = '4' AND agency = '53' AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
        $rsspromoretorno710 = Doo::db()->query($sqlspromoretorno710, array($trip, $fecha));
        $r_spromoretorno710 = $rsspromoretorno710->fetchAll();
        $superpromo_retorno710 = $r_spromoretorno710[0]['spromo'] ? $r_spromoretorno710[0]['spromo'] : 0;

        $superpromo_total710 = $superpromo_ida710 + $superpromo_retorno710;

        //echo $superpromo_total;
        //superdiscount
        $sqlsdiscida710 = "SELECT (sum(pax) + sum(pax2))as sdisc
                            FROM  reservas 
                            Where trip_no = '$trip' AND fecha_salida = '$fecha' AND id1 = '5' AND agency = '53' AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
        $rsdiscida710 = Doo::db()->query($sqlsdiscida710, array($trip, $fecha));
        $r_discida710 = $rsdiscida710->fetchAll();
        $superdisc_ida710 = $r_discida710[0]['sdisc'] ? $r_discida710[0]['sdisc'] : 0;

        $sqlsdiscretorno710 = "SELECT (sum(pax_r) + sum(pax2_r))as sdisc
                            FROM  reservas 
                            Where trip_no2 = '$trip' AND fecha_retorno = '$fecha' AND id2 = '5' AND agency = '53' AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
        $rssdiscretorno710 = Doo::db()->query($sqlsdiscretorno710, array($trip, $fecha));
        $r_discretorno710 = $rssdiscretorno710->fetchAll();
        $superdisc_retorno710 = $r_discretorno710[0]['sdisc'] ? $r_discretorno710[0]['sdisc'] : 0;

        $superdiscount_total710 = $superdisc_ida710 + $superdisc_retorno710;

        //echo $superdiscount_total;

        //tours
        //De Ida
        $sqlTourIda710 = "SELECT (sum(pax) + sum(pax2))as ocupadas_tour
                            FROM  reservas 
                            Where trip_no = '$trip' AND fecha_salida = '$fecha' AND (type_tour = 'ONE' OR type_tour = 'MULTI') AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
        $rstida710 = Doo::db()->query($sqlTourIda710, array($trip, $fecha));
        $r_tida710 = $rstida710->fetchAll();
        $ocupadas_tour_ida710 = $r_tida710[0]['ocupadas_tour'] ? $r_tida710[0]['ocupadas_tour'] : 0;


        //De Retorno
        $sqlTourReturn710 = "SELECT (sum(pax_r) + sum(pax2_r))as ocupadas_tour
                            FROM  reservas 
                            Where trip_no2 = '$trip' AND fecha_retorno = '$fecha' AND (type_tour = 'ONE' OR type_tour = 'MULTI') AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
        $rstreturn710 = Doo::db()->query($sqlTourReturn710, array($trip, $fecha));
        $r_treturn710 = $rstreturn710->fetchAll();
        $ocupadas_tour_return710 = $r_treturn710[0]['ocupadas_tour'] ? $r_treturn710[0]['ocupadas_tour'] : 0;


        $tours_total710 = $ocupadas_tour_ida710 + $ocupadas_tour_return710;

//                      echo $tours_total;
        //SPECIAL/////////////////////////////////////////////////////////////////

        $sql_spcida710 = "SELECT (sum(pax) + sum(pax2))as tari_spc
                            FROM  reservas 
                            Where trip_no = '$trip' AND fecha_salida = '$fecha' AND id1 = '6' AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
        $rs_spcida710 = Doo::db()->query($sql_spcida710, array($trip, $fecha));
        $r_spcida710 = $rs_spcida710->fetchAll();
        $spc_seats_ida710 = $r_spcida710[0]['tari_spc'] ? $r_spcida710[0]['tari_spc'] : 0;

        $sql_spcretorno710 = "SELECT (sum(pax_r) + sum(pax2_r))as tari_spc
                            FROM  reservas 
                            Where trip_no2 = '$trip' AND fecha_retorno = '$fecha' AND id2 = '6' AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
        $rs_spcretorno710 = Doo::db()->query($sql_spcretorno710, array($trip, $fecha));
        $r_spcretorno710 = $rs_spcretorno710->fetchAll();
        $spc_seats_retorno710 = $r_spcretorno710[0]['tari_spc'] ? $r_spcretorno710[0]['tari_spc'] : 0;

        $special_total710 = $spc_seats_ida710 + $spc_seats_retorno710;

        //echo $special_total;

        $ocupadas710 = $standard_total710 + $superflex_total710 + $webfare_total710 + $superpromo_total710 + $superdiscount_total710 + $tours_total710 + $special_total710;
        //$ocupadas710 = $standard_total710 + $superflex_total710 + $tours_total710 + $special_total710;
        //$seats_remain710 = ($capacidad710 - $ocupadas710)-($puestos_ocupados710);
        

        
        $seats_remain710 = ($capacidad710 - $ocupadas710);
        
        $reservados710 = $capacidad710 - $seats_remain710; 
        //$spseats =
        //$sdseats =
        
        $wfseats_710 = $reservados710;
        $stseats_710 = $reservados710;
        //$sflexseats =
        $spprcseats_710 = $reservados710;
        $toursseats_710 = $reservados710;
        
        $capacidad710 = $reservados710;
        $seats_remain710 = 0;


        if($sflexseats_710 > 0){                    
                    $sflexseats_710 = $cap710['sflexseats'];                  
        }else{
            $sflexseats_710 = 0;
        }

        if($spseats_710 > 0){                    
            $spseats_710 = $cap710['spseats'];
        }else{
            $spseats_710 = 0;
        }

        if($sdseats_710 > 0){                    
            $sdseats_710 = $cap710['sdseats'];
        }else{                    
            $sdseats_710 = 0;
        }

        //$result = ($capacidad710 - $ocupadas710)-($puestos_ocupados710);
        //return array($result,$result_standard710,$result_superflex710,$result_webfare710,$result_superpromo710,$result_superdiscount710);   
            
         

        
      Doo::db()->query("UPDATE routes SET capacity = '$capacidad710', seats_remain = '$seats_remain710', wfseats = '$wfseats_710', stseats = '$stseats_710', sflexseats = '$sflexseats_710', spseats = '$spseats_710', sdseats = '$sdseats_710', spprcseats = '$spprcseats_710', toursseats = '$toursseats_710'  WHERE fecha_ini = '$fecha_mas_un_dia'  AND trip_no = '710'");        
          
      
      //700
      
        $sqlcap_700 = "SELECT DISTINCT capacity, capacity2, capacity3, capacity4, capacity5, spseats, sdseats, stseats, wfseats, sflexseats, spprcseats, toursseats FROM routes WHERE fecha_ini = '$fecha_mas_un_dia' AND trip_no = '700' ";
        $rscap_700 = Doo::db()->query($sqlcap_700);
        $capac_700 = $rscap_700->fetchAll();


        foreach ($capac_700 as $cap700) {

        }

        $capacidad1_700 = $cap700['capacity'];
        $capacidad2_700 = $cap700['capacity2'];
        $capacidad3_700 = $cap700['capacity3'];
        $capacidad4_700 = $cap700['capacity4'];
        $capacidad5_700 = $cap700['capacity5'];
        $stseats_700 = $cap700['stseats'];
        $spseats_700 = $cap700['spseats'];
        $sdseats_700 = $cap700['sdseats'];
        $wfseats_700 = $cap700['wfseats'];
        $sflexseats_700 = $cap700['sflexseats'];
        $spprcseats_700 = $cap700['spprcseats'];
        $toursseats_700 = $cap700['toursseats']; 

        $capacidad700 = $capacidad1_700 + $capacidad2_700 + $capacidad3_700 + $capacidad4_700 + $capacidad5_700;
        
        $trip = '700';
        $fecha = $fecha_mas_un_dia;
        
      //tarifa standard
        $sql_stdida700 = "SELECT (sum(pax) + sum(pax2))as tari_std
                          FROM  reservas 
                          Where trip_no = '$trip' AND fecha_salida = '$fecha' AND id1 = '1' AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
        $rs_stdida700 = Doo::db()->query($sql_stdida700, array($trip, $fecha));
        $r_stdida700 = $rs_stdida700->fetchAll();
        $std_seats_ida700 = $r_stdida700[0]['tari_std'] ? $r_stdida700[0]['tari_std'] : 0;

        $sql_stdretorno700 = "SELECT (sum(pax_r) + sum(pax2_r))as tari_std
                              FROM  reservas 
                              Where trip_no2 = '$trip' AND fecha_retorno = '$fecha' AND id2 = '1' AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
        $rs_stdretorno700 = Doo::db()->query($sql_stdretorno700, array($trip, $fecha));
        $r_stdretorno700 = $rs_stdretorno700->fetchAll();
        $std_seats_retorno700 = $r_stdretorno700[0]['tari_std'] ? $r_stdretorno700[0]['tari_std'] : 0;

        $standard_total700 = $std_seats_ida700 + $std_seats_retorno700;

        //echo $standard_total;
        //tarifa superflex
        $sqlflexida700 = "SELECT (sum(pax) + sum(pax2))as tari_flex
                          FROM  reservas 
                          Where trip_no = '$trip' AND fecha_salida = '$fecha' AND id1 = '2' AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
        $rsflexida700 = Doo::db()->query($sqlflexida700, array($trip, $fecha));
        $r_flexida700 = $rsflexida700->fetchAll();
        $superflex_seats_ida700 = $r_flexida700[0]['tari_flex'] ? $r_flexida700[0]['tari_flex'] : 0;

        $sqlflexretorno700 = "SELECT (sum(pax_r) + sum(pax2_r))as tari_flex
                              FROM  reservas 
                              Where trip_no2 = '$trip' AND fecha_retorno = '$fecha' AND id2 = '2' AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
        $rsflexretorno700 = Doo::db()->query($sqlflexretorno700, array($trip, $fecha));
        $r_flexretorno700 = $rsflexretorno700->fetchAll();
        $superflex_seats_retorno700 = $r_flexretorno700[0]['tari_flex'] ? $r_flexretorno700[0]['tari_flex'] : 0;

        $superflex_total700 = $superflex_seats_ida700 + $superflex_seats_retorno700;

        //echo $superflex_total;

        //webfare
        $sqlwebida700 = "SELECT (sum(pax) + sum(pax2))as webfare
                         FROM  reservas 
                         Where trip_no = '$trip' AND fecha_salida = '$fecha' AND id1 = '3' AND agency = '53' AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
        $rswebida700 = Doo::db()->query($sqlwebida700, array($trip, $fecha));
        $r_webida700 = $rswebida700->fetchAll();
        $webfare_ida700 = $r_webida700[0]['webfare'] ? $r_webida700[0]['webfare'] : 0;

        $sqlwebretorno700 = "SELECT (sum(pax_r) + sum(pax2_r))as webfare
                             FROM  reservas 
                             Where trip_no2 = '$trip' AND fecha_retorno = '$fecha' AND id2 = '3' AND agency = '53' AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
        $rswebretorno700 = Doo::db()->query($sqlwebretorno700, array($trip, $fecha));
        $r_webretorno700 = $rswebretorno700->fetchAll();
        $webfare_retorno700 = $r_webretorno700[0]['webfare'] ? $r_webretorno700[0]['webfare'] : 0;

        $webfare_total700 = $webfare_ida700 + $webfare_retorno700;

        //echo $webfare_total;
        //superpromo
        $sqlspromoida700 = "SELECT (sum(pax) + sum(pax2))as spromo
        FROM  reservas 
        Where trip_no = '$trip' AND fecha_salida = '$fecha' AND id1 = '4' AND agency = '53' AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
        $rsspromoida700 = Doo::db()->query($sqlspromoida700, array($trip, $fecha));
        $r_spromoida700 = $rsspromoida700->fetchAll();
        $superpromo_ida700 = $r_spromoida700[0]['spromo'] ? $r_spromoida700[0]['spromo'] : 0;

        $sqlspromoretorno700 = "SELECT (sum(pax_r) + sum(pax2_r))as spromo
                            FROM  reservas 
                            Where trip_no2 = '$trip' AND fecha_retorno = '$fecha' AND id2 = '4' AND agency = '53' AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
        $rsspromoretorno700 = Doo::db()->query($sqlspromoretorno700, array($trip, $fecha));
        $r_spromoretorno700 = $rsspromoretorno700->fetchAll();
        $superpromo_retorno700 = $r_spromoretorno700[0]['spromo'] ? $r_spromoretorno700[0]['spromo'] : 0;

        $superpromo_total700 = $superpromo_ida700 + $superpromo_retorno700;

        //echo $superpromo_total;
        //superdiscount
        $sqlsdiscida700 = "SELECT (sum(pax) + sum(pax2))as sdisc
                            FROM  reservas 
                            Where trip_no = '$trip' AND fecha_salida = '$fecha' AND id1 = '5' AND agency = '53' AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
        $rsdiscida700 = Doo::db()->query($sqlsdiscida700, array($trip, $fecha));
        $r_discida700 = $rsdiscida700->fetchAll();
        $superdisc_ida700 = $r_discida700[0]['sdisc'] ? $r_discida700[0]['sdisc'] : 0;

        $sqlsdiscretorno700 = "SELECT (sum(pax_r) + sum(pax2_r))as sdisc
                            FROM  reservas 
                            Where trip_no2 = '$trip' AND fecha_retorno = '$fecha' AND id2 = '5' AND agency = '53' AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
        $rssdiscretorno700 = Doo::db()->query($sqlsdiscretorno700, array($trip, $fecha));
        $r_discretorno700 = $rssdiscretorno700->fetchAll();
        $superdisc_retorno700 = $r_discretorno700[0]['sdisc'] ? $r_discretorno700[0]['sdisc'] : 0;

        $superdiscount_total700 = $superdisc_ida700 + $superdisc_retorno700;

        //echo $superdiscount_total;

        //tours
        //De Ida
        $sqlTourIda700 = "SELECT (sum(pax) + sum(pax2))as ocupadas_tour
                            FROM  reservas 
                            Where trip_no = '$trip' AND fecha_salida = '$fecha' AND (type_tour = 'ONE' OR type_tour = 'MULTI') AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
        $rstida700 = Doo::db()->query($sqlTourIda700, array($trip, $fecha));
        $r_tida700 = $rstida700->fetchAll();
        $ocupadas_tour_ida700 = $r_tida700[0]['ocupadas_tour'] ? $r_tida700[0]['ocupadas_tour'] : 0;


        //De Retorno
        $sqlTourReturn700 = "SELECT (sum(pax_r) + sum(pax2_r))as ocupadas_tour
                            FROM  reservas 
                            Where trip_no2 = '$trip' AND fecha_retorno = '$fecha' AND (type_tour = 'ONE' OR type_tour = 'MULTI') AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
        $rstreturn700 = Doo::db()->query($sqlTourReturn700, array($trip, $fecha));
        $r_treturn700 = $rstreturn700->fetchAll();
        $ocupadas_tour_return700 = $r_treturn700[0]['ocupadas_tour'] ? $r_treturn700[0]['ocupadas_tour'] : 0;


        $tours_total700 = $ocupadas_tour_ida700 + $ocupadas_tour_return700;

//                      echo $tours_total;
        //SPECIAL/////////////////////////////////////////////////////////////////

        $sql_spcida700 = "SELECT (sum(pax) + sum(pax2))as tari_spc
                            FROM  reservas 
                            Where trip_no = '$trip' AND fecha_salida = '$fecha' AND id1 = '6' AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
        $rs_spcida700 = Doo::db()->query($sql_spcida700, array($trip, $fecha));
        $r_spcida700 = $rs_spcida700->fetchAll();
        $spc_seats_ida700 = $r_spcida700[0]['tari_spc'] ? $r_spcida700[0]['tari_spc'] : 0;

        $sql_spcretorno700 = "SELECT (sum(pax_r) + sum(pax2_r))as tari_spc
                            FROM  reservas 
                            Where trip_no2 = '$trip' AND fecha_retorno = '$fecha' AND id2 = '6' AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
        $rs_spcretorno700 = Doo::db()->query($sql_spcretorno700, array($trip, $fecha));
        $r_spcretorno700 = $rs_spcretorno700->fetchAll();
        $spc_seats_retorno700 = $r_spcretorno700[0]['tari_spc'] ? $r_spcretorno700[0]['tari_spc'] : 0;

        $special_total700 = $spc_seats_ida700 + $spc_seats_retorno700;

        //echo $special_total;

        $ocupadas700 = $standard_total700 + $superflex_total700 + $webfare_total700 + $superpromo_total700 + $superdiscount_total700 + $tours_total700 + $special_total700;
        //$ocupadas700 = $standard_total700 + $superflex_total700 + $tours_total700 + $special_total700;
        //$seats_remain700 = ($capacidad700 - $ocupadas700)-($puestos_ocupados700);
        

        
        $seats_remain700 = ($capacidad700 - $ocupadas700);
        
        $reservados700 = $capacidad700 - $seats_remain700; 
        //$spseats =
        //$sdseats =
        
        $wfseats_700 = $reservados700;
        $stseats_700 = $reservados700;
        //$sflexseats =
        $spprcseats_700 = $reservados700;
        $toursseats_700 = $reservados700;
        
        $capacidad700 = $reservados700;
        $seats_remain700 = 0;


        if($sflexseats_700 > 0){                    
                    $sflexseats_700 = $cap700['sflexseats'];                  
        }else{
            $sflexseats_700 = 0;
        }

        if($spseats_700 > 0){                    
            $spseats_700 = $cap700['spseats'];
        }else{
            $spseats_700 = 0;
        }

        if($sdseats_700 > 0){                    
            $sdseats_700 = $cap700['sdseats'];
        }else{                    
            $sdseats_700 = 0;
        }

        //$result = ($capacidad700 - $ocupadas700)-($puestos_ocupados700);
        //return array($result,$result_standard700,$result_superflex700,$result_webfare700,$result_superpromo700,$result_superdiscount700);   
            
         

        
      Doo::db()->query("UPDATE routes SET capacity = '$capacidad700', seats_remain = '$seats_remain700', wfseats = '$wfseats_700', stseats = '$stseats_700', sflexseats = '$sflexseats_700', spseats = '$spseats_700', sdseats = '$sdseats_700', spprcseats = '$spprcseats_700', toursseats = '$toursseats_700'  WHERE fecha_ini = '$fecha_mas_un_dia'  AND trip_no = '700'");        
          
      
      //711
      
        $sqlcap_711 = "SELECT DISTINCT capacity, capacity2, capacity3, capacity4, capacity5, spseats, sdseats, stseats, wfseats, sflexseats, spprcseats, toursseats FROM routes WHERE fecha_ini = '$fecha_mas_un_dia' AND trip_no = '711' ";
        $rscap_711 = Doo::db()->query($sqlcap_711);
        $capac_711 = $rscap_711->fetchAll();


        foreach ($capac_711 as $cap711) {

        }

        $capacidad1_711 = $cap711['capacity'];
        $capacidad2_711 = $cap711['capacity2'];
        $capacidad3_711 = $cap711['capacity3'];
        $capacidad4_711 = $cap711['capacity4'];
        $capacidad5_711 = $cap711['capacity5'];
        $stseats_711 = $cap711['stseats'];
        $spseats_711 = $cap711['spseats'];
        $sdseats_711 = $cap711['sdseats'];
        $wfseats_711 = $cap711['wfseats'];
        $sflexseats_711 = $cap711['sflexseats'];
        $spprcseats_711 = $cap711['spprcseats'];
        $toursseats_711 = $cap711['toursseats']; 

        $capacidad711 = $capacidad1_711 + $capacidad2_711 + $capacidad3_711 + $capacidad4_711 + $capacidad5_711;
        
        $trip = '711';
        $fecha = $fecha_mas_un_dia;
        
      //tarifa standard
        $sql_stdida711 = "SELECT (sum(pax) + sum(pax2))as tari_std
                          FROM  reservas 
                          Where trip_no = '$trip' AND fecha_salida = '$fecha' AND id1 = '1' AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
        $rs_stdida711 = Doo::db()->query($sql_stdida711, array($trip, $fecha));
        $r_stdida711 = $rs_stdida711->fetchAll();
        $std_seats_ida711 = $r_stdida711[0]['tari_std'] ? $r_stdida711[0]['tari_std'] : 0;

        $sql_stdretorno711 = "SELECT (sum(pax_r) + sum(pax2_r))as tari_std
                              FROM  reservas 
                              Where trip_no2 = '$trip' AND fecha_retorno = '$fecha' AND id2 = '1' AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
        $rs_stdretorno711 = Doo::db()->query($sql_stdretorno711, array($trip, $fecha));
        $r_stdretorno711 = $rs_stdretorno711->fetchAll();
        $std_seats_retorno711 = $r_stdretorno711[0]['tari_std'] ? $r_stdretorno711[0]['tari_std'] : 0;

        $standard_total711 = $std_seats_ida711 + $std_seats_retorno711;

        //echo $standard_total;
        //tarifa superflex
        $sqlflexida711 = "SELECT (sum(pax) + sum(pax2))as tari_flex
                          FROM  reservas 
                          Where trip_no = '$trip' AND fecha_salida = '$fecha' AND id1 = '2' AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
        $rsflexida711 = Doo::db()->query($sqlflexida711, array($trip, $fecha));
        $r_flexida711 = $rsflexida711->fetchAll();
        $superflex_seats_ida711 = $r_flexida711[0]['tari_flex'] ? $r_flexida711[0]['tari_flex'] : 0;

        $sqlflexretorno711 = "SELECT (sum(pax_r) + sum(pax2_r))as tari_flex
                              FROM  reservas 
                              Where trip_no2 = '$trip' AND fecha_retorno = '$fecha' AND id2 = '2' AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
        $rsflexretorno711 = Doo::db()->query($sqlflexretorno711, array($trip, $fecha));
        $r_flexretorno711 = $rsflexretorno711->fetchAll();
        $superflex_seats_retorno711 = $r_flexretorno711[0]['tari_flex'] ? $r_flexretorno711[0]['tari_flex'] : 0;

        $superflex_total711 = $superflex_seats_ida711 + $superflex_seats_retorno711;

        //echo $superflex_total;

        //webfare
        $sqlwebida711 = "SELECT (sum(pax) + sum(pax2))as webfare
                         FROM  reservas 
                         Where trip_no = '$trip' AND fecha_salida = '$fecha' AND id1 = '3' AND agency = '53' AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
        $rswebida711 = Doo::db()->query($sqlwebida711, array($trip, $fecha));
        $r_webida711 = $rswebida711->fetchAll();
        $webfare_ida711 = $r_webida711[0]['webfare'] ? $r_webida711[0]['webfare'] : 0;

        $sqlwebretorno711 = "SELECT (sum(pax_r) + sum(pax2_r))as webfare
                             FROM  reservas 
                             Where trip_no2 = '$trip' AND fecha_retorno = '$fecha' AND id2 = '3' AND agency = '53' AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
        $rswebretorno711 = Doo::db()->query($sqlwebretorno711, array($trip, $fecha));
        $r_webretorno711 = $rswebretorno711->fetchAll();
        $webfare_retorno711 = $r_webretorno711[0]['webfare'] ? $r_webretorno711[0]['webfare'] : 0;

        $webfare_total711 = $webfare_ida711 + $webfare_retorno711;

        //echo $webfare_total;
        //superpromo
        $sqlspromoida711 = "SELECT (sum(pax) + sum(pax2))as spromo
        FROM  reservas 
        Where trip_no = '$trip' AND fecha_salida = '$fecha' AND id1 = '4' AND agency = '53' AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
        $rsspromoida711 = Doo::db()->query($sqlspromoida711, array($trip, $fecha));
        $r_spromoida711 = $rsspromoida711->fetchAll();
        $superpromo_ida711 = $r_spromoida711[0]['spromo'] ? $r_spromoida711[0]['spromo'] : 0;

        $sqlspromoretorno711 = "SELECT (sum(pax_r) + sum(pax2_r))as spromo
                            FROM  reservas 
                            Where trip_no2 = '$trip' AND fecha_retorno = '$fecha' AND id2 = '4' AND agency = '53' AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
        $rsspromoretorno711 = Doo::db()->query($sqlspromoretorno711, array($trip, $fecha));
        $r_spromoretorno711 = $rsspromoretorno711->fetchAll();
        $superpromo_retorno711 = $r_spromoretorno711[0]['spromo'] ? $r_spromoretorno711[0]['spromo'] : 0;

        $superpromo_total711 = $superpromo_ida711 + $superpromo_retorno711;

        //echo $superpromo_total;
        //superdiscount
        $sqlsdiscida711 = "SELECT (sum(pax) + sum(pax2))as sdisc
                            FROM  reservas 
                            Where trip_no = '$trip' AND fecha_salida = '$fecha' AND id1 = '5' AND agency = '53' AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
        $rsdiscida711 = Doo::db()->query($sqlsdiscida711, array($trip, $fecha));
        $r_discida711 = $rsdiscida711->fetchAll();
        $superdisc_ida711 = $r_discida711[0]['sdisc'] ? $r_discida711[0]['sdisc'] : 0;

        $sqlsdiscretorno711 = "SELECT (sum(pax_r) + sum(pax2_r))as sdisc
                            FROM  reservas 
                            Where trip_no2 = '$trip' AND fecha_retorno = '$fecha' AND id2 = '5' AND agency = '53' AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
        $rssdiscretorno711 = Doo::db()->query($sqlsdiscretorno711, array($trip, $fecha));
        $r_discretorno711 = $rssdiscretorno711->fetchAll();
        $superdisc_retorno711 = $r_discretorno711[0]['sdisc'] ? $r_discretorno711[0]['sdisc'] : 0;

        $superdiscount_total711 = $superdisc_ida711 + $superdisc_retorno711;

        //echo $superdiscount_total;

        //tours
        //De Ida
        $sqlTourIda711 = "SELECT (sum(pax) + sum(pax2))as ocupadas_tour
                            FROM  reservas 
                            Where trip_no = '$trip' AND fecha_salida = '$fecha' AND (type_tour = 'ONE' OR type_tour = 'MULTI') AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
        $rstida711 = Doo::db()->query($sqlTourIda711, array($trip, $fecha));
        $r_tida711 = $rstida711->fetchAll();
        $ocupadas_tour_ida711 = $r_tida711[0]['ocupadas_tour'] ? $r_tida711[0]['ocupadas_tour'] : 0;


        //De Retorno
        $sqlTourReturn711 = "SELECT (sum(pax_r) + sum(pax2_r))as ocupadas_tour
                            FROM  reservas 
                            Where trip_no2 = '$trip' AND fecha_retorno = '$fecha' AND (type_tour = 'ONE' OR type_tour = 'MULTI') AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
        $rstreturn711 = Doo::db()->query($sqlTourReturn711, array($trip, $fecha));
        $r_treturn711 = $rstreturn711->fetchAll();
        $ocupadas_tour_return711 = $r_treturn711[0]['ocupadas_tour'] ? $r_treturn711[0]['ocupadas_tour'] : 0;


        $tours_total711 = $ocupadas_tour_ida711 + $ocupadas_tour_return711;

//                      echo $tours_total;
        //SPECIAL/////////////////////////////////////////////////////////////////

        $sql_spcida711 = "SELECT (sum(pax) + sum(pax2))as tari_spc
                            FROM  reservas 
                            Where trip_no = '$trip' AND fecha_salida = '$fecha' AND id1 = '6' AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
        $rs_spcida711 = Doo::db()->query($sql_spcida711, array($trip, $fecha));
        $r_spcida711 = $rs_spcida711->fetchAll();
        $spc_seats_ida711 = $r_spcida711[0]['tari_spc'] ? $r_spcida711[0]['tari_spc'] : 0;

        $sql_spcretorno711 = "SELECT (sum(pax_r) + sum(pax2_r))as tari_spc
                            FROM  reservas 
                            Where trip_no2 = '$trip' AND fecha_retorno = '$fecha' AND id2 = '6' AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
        $rs_spcretorno711 = Doo::db()->query($sql_spcretorno711, array($trip, $fecha));
        $r_spcretorno711 = $rs_spcretorno711->fetchAll();
        $spc_seats_retorno711 = $r_spcretorno711[0]['tari_spc'] ? $r_spcretorno711[0]['tari_spc'] : 0;

        $special_total711 = $spc_seats_ida711 + $spc_seats_retorno711;

        //echo $special_total;

        $ocupadas711 = $standard_total711 + $superflex_total711 + $webfare_total711 + $superpromo_total711 + $superdiscount_total711 + $tours_total711 + $special_total711;
        //$ocupadas711 = $standard_total711 + $superflex_total711 + $tours_total711 + $special_total711;
        //$seats_remain711 = ($capacidad711 - $ocupadas711)-($puestos_ocupados711);
        

        
        $seats_remain711 = ($capacidad711 - $ocupadas711);
        
        $reservados711 = $capacidad711 - $seats_remain711; 
        //$spseats =
        //$sdseats =
        
        $wfseats_711 = $reservados711;
        $stseats_711 = $reservados711;
        //$sflexseats =
        $spprcseats_711 = $reservados711;
        $toursseats_711 = $reservados711;
        
        $capacidad711 = $reservados711;
        $seats_remain711 = 0;


        if($sflexseats_711 > 0){                    
                    $sflexseats_711 = $cap711['sflexseats'];                  
        }else{
            $sflexseats_711 = 0;
        }

        if($spseats_711 > 0){                    
            $spseats_711 = $cap711['spseats'];
        }else{
            $spseats_711 = 0;
        }

        if($sdseats_711 > 0){                    
            $sdseats_711 = $cap711['sdseats'];
        }else{                    
            $sdseats_711 = 0;
        }

        //$result = ($capacidad711 - $ocupadas711)-($puestos_ocupados711);
        //return array($result,$result_standard711,$result_superflex711,$result_webfare711,$result_superpromo711,$result_superdiscount711);   
            
         

        
      Doo::db()->query("UPDATE routes SET capacity = '$capacidad711', seats_remain = '$seats_remain711', wfseats = '$wfseats_711', stseats = '$stseats_711', sflexseats = '$sflexseats_711', spseats = '$spseats_711', sdseats = '$sdseats_711', spprcseats = '$spprcseats_711', toursseats = '$toursseats_711'  WHERE fecha_ini = '$fecha_mas_un_dia'  AND trip_no = '711'");        
          
         
          
      //790
      
        
     //790
     
     $sqlcap_790 = "SELECT DISTINCT capacity, capacity2, capacity3, capacity4, capacity5, spseats, sdseats, stseats, wfseats, sflexseats, spprcseats, toursseats FROM routes WHERE fecha_ini = '$fecha_actual' AND trip_no = '790' ";
        $rscap_790 = Doo::db()->query($sqlcap_790);
        $capac_790 = $rscap_790->fetchAll();


        foreach ($capac_790 as $cap790) {

        }

        $capacidad1_790 = $cap790['capacity'];
        $capacidad2_790 = $cap790['capacity2'];
        $capacidad3_790 = $cap790['capacity3'];
        $capacidad4_790 = $cap790['capacity4'];
        $capacidad5_790 = $cap790['capacity5'];
        $stseats_790 = $cap790['stseats'];
        $spseats_790 = $cap790['spseats'];
        $sdseats_790 = $cap790['sdseats'];
        $wfseats_790 = $cap790['wfseats'];
        $sflexseats_790 = $cap790['sflexseats'];
        $spprcseats_790 = $cap790['spprcseats'];
        $toursseats_790 = $cap790['toursseats']; 

        $capacidad790 = $capacidad1_790 + $capacidad2_790 + $capacidad3_790 + $capacidad4_790 + $capacidad5_790;
        
        $trip = '790';
        $fecha = $fecha_actual;
        
      //tarifa standard
        $sql_stdida790 = "SELECT (sum(pax) + sum(pax2))as tari_std
                          FROM  reservas 
                          Where trip_no = '$trip' AND fecha_salida = '$fecha' AND id1 = '1' AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
        $rs_stdida790 = Doo::db()->query($sql_stdida790, array($trip, $fecha));
        $r_stdida790 = $rs_stdida790->fetchAll();
        $std_seats_ida790 = $r_stdida790[0]['tari_std'] ? $r_stdida790[0]['tari_std'] : 0;

        $sql_stdretorno790 = "SELECT (sum(pax_r) + sum(pax2_r))as tari_std
                              FROM  reservas 
                              Where trip_no2 = '$trip' AND fecha_retorno = '$fecha' AND id2 = '1' AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
        $rs_stdretorno790 = Doo::db()->query($sql_stdretorno790, array($trip, $fecha));
        $r_stdretorno790 = $rs_stdretorno790->fetchAll();
        $std_seats_retorno790 = $r_stdretorno790[0]['tari_std'] ? $r_stdretorno790[0]['tari_std'] : 0;

        $standard_total790 = $std_seats_ida790 + $std_seats_retorno790;

        //echo $standard_total;
        //tarifa superflex
        $sqlflexida790 = "SELECT (sum(pax) + sum(pax2))as tari_flex
                          FROM  reservas 
                          Where trip_no = '$trip' AND fecha_salida = '$fecha' AND id1 = '2' AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
        $rsflexida790 = Doo::db()->query($sqlflexida790, array($trip, $fecha));
        $r_flexida790 = $rsflexida790->fetchAll();
        $superflex_seats_ida790 = $r_flexida790[0]['tari_flex'] ? $r_flexida790[0]['tari_flex'] : 0;

        $sqlflexretorno790 = "SELECT (sum(pax_r) + sum(pax2_r))as tari_flex
                              FROM  reservas 
                              Where trip_no2 = '$trip' AND fecha_retorno = '$fecha' AND id2 = '2' AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
        $rsflexretorno790 = Doo::db()->query($sqlflexretorno790, array($trip, $fecha));
        $r_flexretorno790 = $rsflexretorno790->fetchAll();
        $superflex_seats_retorno790 = $r_flexretorno790[0]['tari_flex'] ? $r_flexretorno790[0]['tari_flex'] : 0;

        $superflex_total790 = $superflex_seats_ida790 + $superflex_seats_retorno790;

        //echo $superflex_total;

        //webfare
        $sqlwebida790 = "SELECT (sum(pax) + sum(pax2))as webfare
                         FROM  reservas 
                         Where trip_no = '$trip' AND fecha_salida = '$fecha' AND id1 = '3' AND agency = '53' AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
        $rswebida790 = Doo::db()->query($sqlwebida790, array($trip, $fecha));
        $r_webida790 = $rswebida790->fetchAll();
        $webfare_ida790 = $r_webida790[0]['webfare'] ? $r_webida790[0]['webfare'] : 0;

        $sqlwebretorno790 = "SELECT (sum(pax_r) + sum(pax2_r))as webfare
                             FROM  reservas 
                             Where trip_no2 = '$trip' AND fecha_retorno = '$fecha' AND id2 = '3' AND agency = '53' AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
        $rswebretorno790 = Doo::db()->query($sqlwebretorno790, array($trip, $fecha));
        $r_webretorno790 = $rswebretorno790->fetchAll();
        $webfare_retorno790 = $r_webretorno790[0]['webfare'] ? $r_webretorno790[0]['webfare'] : 0;

        $webfare_total790 = $webfare_ida790 + $webfare_retorno790;

        //echo $webfare_total;
        //superpromo
        $sqlspromoida790 = "SELECT (sum(pax) + sum(pax2))as spromo
        FROM  reservas 
        Where trip_no = '$trip' AND fecha_salida = '$fecha' AND id1 = '4' AND agency = '53' AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
        $rsspromoida790 = Doo::db()->query($sqlspromoida790, array($trip, $fecha));
        $r_spromoida790 = $rsspromoida790->fetchAll();
        $superpromo_ida790 = $r_spromoida790[0]['spromo'] ? $r_spromoida790[0]['spromo'] : 0;

        $sqlspromoretorno790 = "SELECT (sum(pax_r) + sum(pax2_r))as spromo
                            FROM  reservas 
                            Where trip_no2 = '$trip' AND fecha_retorno = '$fecha' AND id2 = '4' AND agency = '53' AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
        $rsspromoretorno790 = Doo::db()->query($sqlspromoretorno790, array($trip, $fecha));
        $r_spromoretorno790 = $rsspromoretorno790->fetchAll();
        $superpromo_retorno790 = $r_spromoretorno790[0]['spromo'] ? $r_spromoretorno790[0]['spromo'] : 0;

        $superpromo_total790 = $superpromo_ida790 + $superpromo_retorno790;

        //echo $superpromo_total;
        //superdiscount
        $sqlsdiscida790 = "SELECT (sum(pax) + sum(pax2))as sdisc
                            FROM  reservas 
                            Where trip_no = '$trip' AND fecha_salida = '$fecha' AND id1 = '5' AND agency = '53' AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
        $rsdiscida790 = Doo::db()->query($sqlsdiscida790, array($trip, $fecha));
        $r_discida790 = $rsdiscida790->fetchAll();
        $superdisc_ida790 = $r_discida790[0]['sdisc'] ? $r_discida790[0]['sdisc'] : 0;

        $sqlsdiscretorno790 = "SELECT (sum(pax_r) + sum(pax2_r))as sdisc
                            FROM  reservas 
                            Where trip_no2 = '$trip' AND fecha_retorno = '$fecha' AND id2 = '5' AND agency = '53' AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
        $rssdiscretorno790 = Doo::db()->query($sqlsdiscretorno790, array($trip, $fecha));
        $r_discretorno790 = $rssdiscretorno790->fetchAll();
        $superdisc_retorno790 = $r_discretorno790[0]['sdisc'] ? $r_discretorno790[0]['sdisc'] : 0;

        $superdiscount_total790 = $superdisc_ida790 + $superdisc_retorno790;

        //echo $superdiscount_total;

        //tours
        //De Ida
        $sqlTourIda790 = "SELECT (sum(pax) + sum(pax2))as ocupadas_tour
                            FROM  reservas 
                            Where trip_no = '$trip' AND fecha_salida = '$fecha' AND (type_tour = 'ONE' OR type_tour = 'MULTI') AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
        $rstida790 = Doo::db()->query($sqlTourIda790, array($trip, $fecha));
        $r_tida790 = $rstida790->fetchAll();
        $ocupadas_tour_ida790 = $r_tida790[0]['ocupadas_tour'] ? $r_tida790[0]['ocupadas_tour'] : 0;


        //De Retorno
        $sqlTourReturn790 = "SELECT (sum(pax_r) + sum(pax2_r))as ocupadas_tour
                            FROM  reservas 
                            Where trip_no2 = '$trip' AND fecha_retorno = '$fecha' AND (type_tour = 'ONE' OR type_tour = 'MULTI') AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
        $rstreturn790 = Doo::db()->query($sqlTourReturn790, array($trip, $fecha));
        $r_treturn790 = $rstreturn790->fetchAll();
        $ocupadas_tour_return790 = $r_treturn790[0]['ocupadas_tour'] ? $r_treturn790[0]['ocupadas_tour'] : 0;


        $tours_total790 = $ocupadas_tour_ida790 + $ocupadas_tour_return790;

//                      echo $tours_total;
        //SPECIAL/////////////////////////////////////////////////////////////////

        $sql_spcida790 = "SELECT (sum(pax) + sum(pax2))as tari_spc
                            FROM  reservas 
                            Where trip_no = '$trip' AND fecha_salida = '$fecha' AND id1 = '6' AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
        $rs_spcida790 = Doo::db()->query($sql_spcida790, array($trip, $fecha));
        $r_spcida790 = $rs_spcida790->fetchAll();
        $spc_seats_ida790 = $r_spcida790[0]['tari_spc'] ? $r_spcida790[0]['tari_spc'] : 0;

        $sql_spcretorno790 = "SELECT (sum(pax_r) + sum(pax2_r))as tari_spc
                            FROM  reservas 
                            Where trip_no2 = '$trip' AND fecha_retorno = '$fecha' AND id2 = '6' AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
        $rs_spcretorno790 = Doo::db()->query($sql_spcretorno790, array($trip, $fecha));
        $r_spcretorno790 = $rs_spcretorno790->fetchAll();
        $spc_seats_retorno790 = $r_spcretorno790[0]['tari_spc'] ? $r_spcretorno790[0]['tari_spc'] : 0;

        $special_total790 = $spc_seats_ida790 + $spc_seats_retorno790;

        //echo $special_total;

        $ocupadas790 = $standard_total790 + $superflex_total790 + $webfare_total790 + $superpromo_total790 + $superdiscount_total790 + $tours_total790 + $special_total790;
        //$ocupadas790 = $standard_total790 + $superflex_total790 + $tours_total790 + $special_total790;
        //$seats_remain790 = ($capacidad790 - $ocupadas790)-($puestos_ocupados790);
        

        
        $seats_remain790 = ($capacidad790 - $ocupadas790);
        
        $reservados790 = $capacidad790 - $seats_remain790; 
        //$spseats =
        //$sdseats =
        
        $wfseats_790 = $reservados790;
        $stseats_790 = $reservados790;
        //$sflexseats =
        $spprcseats_790 = $reservados790;
        $toursseats_790 = $reservados790;
        
        $capacidad790 = $reservados790;
        $seats_remain790 = 0;


        if($sflexseats_790 > 0){                    
                    $sflexseats_790 = $cap790['sflexseats'];                  
        }else{
            $sflexseats_790 = 0;
        }

        if($spseats_790 > 0){                    
            $spseats_790 = $cap790['spseats'];
        }else{
            $spseats_790 = 0;
        }

        if($sdseats_790 > 0){                    
            $sdseats_790 = $cap790['sdseats'];
        }else{                    
            $sdseats_790 = 0;
        }

        //$result = ($capacidad790 - $ocupadas790)-($puestos_ocupados790);
        //return array($result,$result_standard790,$result_superflex790,$result_webfare790,$result_superpromo790,$result_superdiscount790);   
            
         

        
      Doo::db()->query("UPDATE routes SET capacity = '$capacidad790', seats_remain = '$seats_remain790', wfseats = '$wfseats_790', stseats = '$stseats_790', sflexseats = '$sflexseats_790', spseats = '$spseats_790', sdseats = '$sdseats_790', spprcseats = '$spprcseats_790', toursseats = '$toursseats_790'  WHERE fecha_ini = '$fecha_actual'  AND trip_no = '790'");        
    
        
      //731
      
        $sqlcap_731 = "SELECT DISTINCT capacity, capacity2, capacity3, capacity4, capacity5, spseats, sdseats, stseats, wfseats, sflexseats, spprcseats, toursseats FROM routes WHERE fecha_ini = '$fecha_actual' AND trip_no = '731' ";
        $rscap_731 = Doo::db()->query($sqlcap_731);
        $capac_731 = $rscap_731->fetchAll();


        foreach ($capac_731 as $cap731) {

        }

        $capacidad1_731 = $cap731['capacity'];
        $capacidad2_731 = $cap731['capacity2'];
        $capacidad3_731 = $cap731['capacity3'];
        $capacidad4_731 = $cap731['capacity4'];
        $capacidad5_731 = $cap731['capacity5'];
        $stseats_731 = $cap731['stseats'];
        $spseats_731 = $cap731['spseats'];
        $sdseats_731 = $cap731['sdseats'];
        $wfseats_731 = $cap731['wfseats'];
        $sflexseats_731 = $cap731['sflexseats'];
        $spprcseats_731 = $cap731['spprcseats'];
        $toursseats_731 = $cap731['toursseats']; 

        $capacidad731 = $capacidad1_731 + $capacidad2_731 + $capacidad3_731 + $capacidad4_731 + $capacidad5_731;
        
        $trip = '731';
        $fecha = $fecha_actual;
        
      //tarifa standard
        $sql_stdida731 = "SELECT (sum(pax) + sum(pax2))as tari_std
                          FROM  reservas 
                          Where trip_no = '$trip' AND fecha_salida = '$fecha' AND id1 = '1' AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
        $rs_stdida731 = Doo::db()->query($sql_stdida731, array($trip, $fecha));
        $r_stdida731 = $rs_stdida731->fetchAll();
        $std_seats_ida731 = $r_stdida731[0]['tari_std'] ? $r_stdida731[0]['tari_std'] : 0;

        $sql_stdretorno731 = "SELECT (sum(pax_r) + sum(pax2_r))as tari_std
                              FROM  reservas 
                              Where trip_no2 = '$trip' AND fecha_retorno = '$fecha' AND id2 = '1' AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
        $rs_stdretorno731 = Doo::db()->query($sql_stdretorno731, array($trip, $fecha));
        $r_stdretorno731 = $rs_stdretorno731->fetchAll();
        $std_seats_retorno731 = $r_stdretorno731[0]['tari_std'] ? $r_stdretorno731[0]['tari_std'] : 0;

        $standard_total731 = $std_seats_ida731 + $std_seats_retorno731;

        //echo $standard_total;
        //tarifa superflex
        $sqlflexida731 = "SELECT (sum(pax) + sum(pax2))as tari_flex
                          FROM  reservas 
                          Where trip_no = '$trip' AND fecha_salida = '$fecha' AND id1 = '2' AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
        $rsflexida731 = Doo::db()->query($sqlflexida731, array($trip, $fecha));
        $r_flexida731 = $rsflexida731->fetchAll();
        $superflex_seats_ida731 = $r_flexida731[0]['tari_flex'] ? $r_flexida731[0]['tari_flex'] : 0;

        $sqlflexretorno731 = "SELECT (sum(pax_r) + sum(pax2_r))as tari_flex
                              FROM  reservas 
                              Where trip_no2 = '$trip' AND fecha_retorno = '$fecha' AND id2 = '2' AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
        $rsflexretorno731 = Doo::db()->query($sqlflexretorno731, array($trip, $fecha));
        $r_flexretorno731 = $rsflexretorno731->fetchAll();
        $superflex_seats_retorno731 = $r_flexretorno731[0]['tari_flex'] ? $r_flexretorno731[0]['tari_flex'] : 0;

        $superflex_total731 = $superflex_seats_ida731 + $superflex_seats_retorno731;

        //echo $superflex_total;

        //webfare
        $sqlwebida731 = "SELECT (sum(pax) + sum(pax2))as webfare
                         FROM  reservas 
                         Where trip_no = '$trip' AND fecha_salida = '$fecha' AND id1 = '3' AND agency = '53' AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
        $rswebida731 = Doo::db()->query($sqlwebida731, array($trip, $fecha));
        $r_webida731 = $rswebida731->fetchAll();
        $webfare_ida731 = $r_webida731[0]['webfare'] ? $r_webida731[0]['webfare'] : 0;

        $sqlwebretorno731 = "SELECT (sum(pax_r) + sum(pax2_r))as webfare
                             FROM  reservas 
                             Where trip_no2 = '$trip' AND fecha_retorno = '$fecha' AND id2 = '3' AND agency = '53' AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
        $rswebretorno731 = Doo::db()->query($sqlwebretorno731, array($trip, $fecha));
        $r_webretorno731 = $rswebretorno731->fetchAll();
        $webfare_retorno731 = $r_webretorno731[0]['webfare'] ? $r_webretorno731[0]['webfare'] : 0;

        $webfare_total731 = $webfare_ida731 + $webfare_retorno731;

        //echo $webfare_total;
        //superpromo
        $sqlspromoida731 = "SELECT (sum(pax) + sum(pax2))as spromo
        FROM  reservas 
        Where trip_no = '$trip' AND fecha_salida = '$fecha' AND id1 = '4' AND agency = '53' AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
        $rsspromoida731 = Doo::db()->query($sqlspromoida731, array($trip, $fecha));
        $r_spromoida731 = $rsspromoida731->fetchAll();
        $superpromo_ida731 = $r_spromoida731[0]['spromo'] ? $r_spromoida731[0]['spromo'] : 0;

        $sqlspromoretorno731 = "SELECT (sum(pax_r) + sum(pax2_r))as spromo
                            FROM  reservas 
                            Where trip_no2 = '$trip' AND fecha_retorno = '$fecha' AND id2 = '4' AND agency = '53' AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
        $rsspromoretorno731 = Doo::db()->query($sqlspromoretorno731, array($trip, $fecha));
        $r_spromoretorno731 = $rsspromoretorno731->fetchAll();
        $superpromo_retorno731 = $r_spromoretorno731[0]['spromo'] ? $r_spromoretorno731[0]['spromo'] : 0;

        $superpromo_total731 = $superpromo_ida731 + $superpromo_retorno731;

        //echo $superpromo_total;
        //superdiscount
        $sqlsdiscida731 = "SELECT (sum(pax) + sum(pax2))as sdisc
                            FROM  reservas 
                            Where trip_no = '$trip' AND fecha_salida = '$fecha' AND id1 = '5' AND agency = '53' AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
        $rsdiscida731 = Doo::db()->query($sqlsdiscida731, array($trip, $fecha));
        $r_discida731 = $rsdiscida731->fetchAll();
        $superdisc_ida731 = $r_discida731[0]['sdisc'] ? $r_discida731[0]['sdisc'] : 0;

        $sqlsdiscretorno731 = "SELECT (sum(pax_r) + sum(pax2_r))as sdisc
                            FROM  reservas 
                            Where trip_no2 = '$trip' AND fecha_retorno = '$fecha' AND id2 = '5' AND agency = '53' AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
        $rssdiscretorno731 = Doo::db()->query($sqlsdiscretorno731, array($trip, $fecha));
        $r_discretorno731 = $rssdiscretorno731->fetchAll();
        $superdisc_retorno731 = $r_discretorno731[0]['sdisc'] ? $r_discretorno731[0]['sdisc'] : 0;

        $superdiscount_total731 = $superdisc_ida731 + $superdisc_retorno731;

        //echo $superdiscount_total;

        //tours
        //De Ida
        $sqlTourIda731 = "SELECT (sum(pax) + sum(pax2))as ocupadas_tour
                            FROM  reservas 
                            Where trip_no = '$trip' AND fecha_salida = '$fecha' AND (type_tour = 'ONE' OR type_tour = 'MULTI') AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
        $rstida731 = Doo::db()->query($sqlTourIda731, array($trip, $fecha));
        $r_tida731 = $rstida731->fetchAll();
        $ocupadas_tour_ida731 = $r_tida731[0]['ocupadas_tour'] ? $r_tida731[0]['ocupadas_tour'] : 0;


        //De Retorno
        $sqlTourReturn731 = "SELECT (sum(pax_r) + sum(pax2_r))as ocupadas_tour
                            FROM  reservas 
                            Where trip_no2 = '$trip' AND fecha_retorno = '$fecha' AND (type_tour = 'ONE' OR type_tour = 'MULTI') AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
        $rstreturn731 = Doo::db()->query($sqlTourReturn731, array($trip, $fecha));
        $r_treturn731 = $rstreturn731->fetchAll();
        $ocupadas_tour_return731 = $r_treturn731[0]['ocupadas_tour'] ? $r_treturn731[0]['ocupadas_tour'] : 0;


        $tours_total731 = $ocupadas_tour_ida731 + $ocupadas_tour_return731;

//                      echo $tours_total;
        //SPECIAL/////////////////////////////////////////////////////////////////

        $sql_spcida731 = "SELECT (sum(pax) + sum(pax2))as tari_spc
                            FROM  reservas 
                            Where trip_no = '$trip' AND fecha_salida = '$fecha' AND id1 = '6' AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
        $rs_spcida731 = Doo::db()->query($sql_spcida731, array($trip, $fecha));
        $r_spcida731 = $rs_spcida731->fetchAll();
        $spc_seats_ida731 = $r_spcida731[0]['tari_spc'] ? $r_spcida731[0]['tari_spc'] : 0;

        $sql_spcretorno731 = "SELECT (sum(pax_r) + sum(pax2_r))as tari_spc
                            FROM  reservas 
                            Where trip_no2 = '$trip' AND fecha_retorno = '$fecha' AND id2 = '6' AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
        $rs_spcretorno731 = Doo::db()->query($sql_spcretorno731, array($trip, $fecha));
        $r_spcretorno731 = $rs_spcretorno731->fetchAll();
        $spc_seats_retorno731 = $r_spcretorno731[0]['tari_spc'] ? $r_spcretorno731[0]['tari_spc'] : 0;

        $special_total731 = $spc_seats_ida731 + $spc_seats_retorno731;

        //echo $special_total;

        $ocupadas731 = $standard_total731 + $superflex_total731 + $webfare_total731 + $superpromo_total731 + $superdiscount_total731 + $tours_total731 + $special_total731;
        //$ocupadas731 = $standard_total731 + $superflex_total731 + $tours_total731 + $special_total731;
        //$seats_remain731 = ($capacidad731 - $ocupadas731)-($puestos_ocupados731);
        

        
        $seats_remain731 = ($capacidad731 - $ocupadas731);
        
        $reservados731 = $capacidad731 - $seats_remain731; 
        //$spseats =
        //$sdseats =
        
        $wfseats_731 = $reservados731;
        $stseats_731 = $reservados731;
        //$sflexseats =
        $spprcseats_731 = $reservados731;
        $toursseats_731 = $reservados731;
        
        $capacidad731 = $reservados731;
        $seats_remain731 = 0;


        if($sflexseats_731 > 0){                    
                    $sflexseats_731 = $cap731['sflexseats'];                  
        }else{
            $sflexseats_731 = 0;
        }

        if($spseats_731 > 0){                    
            $spseats_731 = $cap731['spseats'];
        }else{
            $spseats_731 = 0;
        }

        if($sdseats_731 > 0){                    
            $sdseats_731 = $cap731['sdseats'];
        }else{                    
            $sdseats_731 = 0;
        }

        //$result = ($capacidad731 - $ocupadas731)-($puestos_ocupados731);
        //return array($result,$result_standard731,$result_superflex731,$result_webfare731,$result_superpromo731,$result_superdiscount731);   
            
         

        
      Doo::db()->query("UPDATE routes SET capacity = '$capacidad731', seats_remain = '$seats_remain731', wfseats = '$wfseats_731', stseats = '$stseats_731', sflexseats = '$sflexseats_731', spseats = '$spseats_731', sdseats = '$sdseats_731', spprcseats = '$spprcseats_731', toursseats = '$toursseats_731'  WHERE fecha_ini = '$fecha_actual'  AND trip_no = '731'");        
          
    
    //773
      
        $sqlcap_773 = "SELECT DISTINCT capacity, capacity2, capacity3, capacity4, capacity5, spseats, sdseats, stseats, wfseats, sflexseats, spprcseats, toursseats FROM routes WHERE fecha_ini = '$fecha_actual' AND trip_no = '773' ";
        $rscap_773 = Doo::db()->query($sqlcap_773);
        $capac_773 = $rscap_773->fetchAll();


        foreach ($capac_773 as $cap773) {

        }

        $capacidad1_773 = $cap773['capacity'];
        $capacidad2_773 = $cap773['capacity2'];
        $capacidad3_773 = $cap773['capacity3'];
        $capacidad4_773 = $cap773['capacity4'];
        $capacidad5_773 = $cap773['capacity5'];
        $stseats_773 = $cap773['stseats'];
        $spseats_773 = $cap773['spseats'];
        $sdseats_773 = $cap773['sdseats'];
        $wfseats_773 = $cap773['wfseats'];
        $sflexseats_773 = $cap773['sflexseats'];
        $spprcseats_773 = $cap773['spprcseats'];
        $toursseats_773 = $cap773['toursseats']; 

        $capacidad773 = $capacidad1_773 + $capacidad2_773 + $capacidad3_773 + $capacidad4_773 + $capacidad5_773;
        
        $trip = '773';
        $fecha = $fecha_actual;
        
      //tarifa standard
        $sql_stdida773 = "SELECT (sum(pax) + sum(pax2))as tari_std
                          FROM  reservas 
                          Where trip_no = '$trip' AND fecha_salida = '$fecha' AND id1 = '1' AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
        $rs_stdida773 = Doo::db()->query($sql_stdida773, array($trip, $fecha));
        $r_stdida773 = $rs_stdida773->fetchAll();
        $std_seats_ida773 = $r_stdida773[0]['tari_std'] ? $r_stdida773[0]['tari_std'] : 0;

        $sql_stdretorno773 = "SELECT (sum(pax_r) + sum(pax2_r))as tari_std
                              FROM  reservas 
                              Where trip_no2 = '$trip' AND fecha_retorno = '$fecha' AND id2 = '1' AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
        $rs_stdretorno773 = Doo::db()->query($sql_stdretorno773, array($trip, $fecha));
        $r_stdretorno773 = $rs_stdretorno773->fetchAll();
        $std_seats_retorno773 = $r_stdretorno773[0]['tari_std'] ? $r_stdretorno773[0]['tari_std'] : 0;

        $standard_total773 = $std_seats_ida773 + $std_seats_retorno773;

        //echo $standard_total;
        //tarifa superflex
        $sqlflexida773 = "SELECT (sum(pax) + sum(pax2))as tari_flex
                          FROM  reservas 
                          Where trip_no = '$trip' AND fecha_salida = '$fecha' AND id1 = '2' AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
        $rsflexida773 = Doo::db()->query($sqlflexida773, array($trip, $fecha));
        $r_flexida773 = $rsflexida773->fetchAll();
        $superflex_seats_ida773 = $r_flexida773[0]['tari_flex'] ? $r_flexida773[0]['tari_flex'] : 0;

        $sqlflexretorno773 = "SELECT (sum(pax_r) + sum(pax2_r))as tari_flex
                              FROM  reservas 
                              Where trip_no2 = '$trip' AND fecha_retorno = '$fecha' AND id2 = '2' AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
        $rsflexretorno773 = Doo::db()->query($sqlflexretorno773, array($trip, $fecha));
        $r_flexretorno773 = $rsflexretorno773->fetchAll();
        $superflex_seats_retorno773 = $r_flexretorno773[0]['tari_flex'] ? $r_flexretorno773[0]['tari_flex'] : 0;

        $superflex_total773 = $superflex_seats_ida773 + $superflex_seats_retorno773;

        //echo $superflex_total;

        //webfare
        $sqlwebida773 = "SELECT (sum(pax) + sum(pax2))as webfare
                         FROM  reservas 
                         Where trip_no = '$trip' AND fecha_salida = '$fecha' AND id1 = '3' AND agency = '53' AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
        $rswebida773 = Doo::db()->query($sqlwebida773, array($trip, $fecha));
        $r_webida773 = $rswebida773->fetchAll();
        $webfare_ida773 = $r_webida773[0]['webfare'] ? $r_webida773[0]['webfare'] : 0;

        $sqlwebretorno773 = "SELECT (sum(pax_r) + sum(pax2_r))as webfare
                             FROM  reservas 
                             Where trip_no2 = '$trip' AND fecha_retorno = '$fecha' AND id2 = '3' AND agency = '53' AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
        $rswebretorno773 = Doo::db()->query($sqlwebretorno773, array($trip, $fecha));
        $r_webretorno773 = $rswebretorno773->fetchAll();
        $webfare_retorno773 = $r_webretorno773[0]['webfare'] ? $r_webretorno773[0]['webfare'] : 0;

        $webfare_total773 = $webfare_ida773 + $webfare_retorno773;

        //echo $webfare_total;
        //superpromo
        $sqlspromoida773 = "SELECT (sum(pax) + sum(pax2))as spromo
        FROM  reservas 
        Where trip_no = '$trip' AND fecha_salida = '$fecha' AND id1 = '4' AND agency = '53' AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
        $rsspromoida773 = Doo::db()->query($sqlspromoida773, array($trip, $fecha));
        $r_spromoida773 = $rsspromoida773->fetchAll();
        $superpromo_ida773 = $r_spromoida773[0]['spromo'] ? $r_spromoida773[0]['spromo'] : 0;

        $sqlspromoretorno773 = "SELECT (sum(pax_r) + sum(pax2_r))as spromo
                            FROM  reservas 
                            Where trip_no2 = '$trip' AND fecha_retorno = '$fecha' AND id2 = '4' AND agency = '53' AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
        $rsspromoretorno773 = Doo::db()->query($sqlspromoretorno773, array($trip, $fecha));
        $r_spromoretorno773 = $rsspromoretorno773->fetchAll();
        $superpromo_retorno773 = $r_spromoretorno773[0]['spromo'] ? $r_spromoretorno773[0]['spromo'] : 0;

        $superpromo_total773 = $superpromo_ida773 + $superpromo_retorno773;

        //echo $superpromo_total;
        //superdiscount
        $sqlsdiscida773 = "SELECT (sum(pax) + sum(pax2))as sdisc
                            FROM  reservas 
                            Where trip_no = '$trip' AND fecha_salida = '$fecha' AND id1 = '5' AND agency = '53' AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
        $rsdiscida773 = Doo::db()->query($sqlsdiscida773, array($trip, $fecha));
        $r_discida773 = $rsdiscida773->fetchAll();
        $superdisc_ida773 = $r_discida773[0]['sdisc'] ? $r_discida773[0]['sdisc'] : 0;

        $sqlsdiscretorno773 = "SELECT (sum(pax_r) + sum(pax2_r))as sdisc
                            FROM  reservas 
                            Where trip_no2 = '$trip' AND fecha_retorno = '$fecha' AND id2 = '5' AND agency = '53' AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
        $rssdiscretorno773 = Doo::db()->query($sqlsdiscretorno773, array($trip, $fecha));
        $r_discretorno773 = $rssdiscretorno773->fetchAll();
        $superdisc_retorno773 = $r_discretorno773[0]['sdisc'] ? $r_discretorno773[0]['sdisc'] : 0;

        $superdiscount_total773 = $superdisc_ida773 + $superdisc_retorno773;

        //echo $superdiscount_total;

        //tours
        //De Ida
        $sqlTourIda773 = "SELECT (sum(pax) + sum(pax2))as ocupadas_tour
                            FROM  reservas 
                            Where trip_no = '$trip' AND fecha_salida = '$fecha' AND (type_tour = 'ONE' OR type_tour = 'MULTI') AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
        $rstida773 = Doo::db()->query($sqlTourIda773, array($trip, $fecha));
        $r_tida773 = $rstida773->fetchAll();
        $ocupadas_tour_ida773 = $r_tida773[0]['ocupadas_tour'] ? $r_tida773[0]['ocupadas_tour'] : 0;


        //De Retorno
        $sqlTourReturn773 = "SELECT (sum(pax_r) + sum(pax2_r))as ocupadas_tour
                            FROM  reservas 
                            Where trip_no2 = '$trip' AND fecha_retorno = '$fecha' AND (type_tour = 'ONE' OR type_tour = 'MULTI') AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
        $rstreturn773 = Doo::db()->query($sqlTourReturn773, array($trip, $fecha));
        $r_treturn773 = $rstreturn773->fetchAll();
        $ocupadas_tour_return773 = $r_treturn773[0]['ocupadas_tour'] ? $r_treturn773[0]['ocupadas_tour'] : 0;


        $tours_total773 = $ocupadas_tour_ida773 + $ocupadas_tour_return773;

//                      echo $tours_total;
        //SPECIAL/////////////////////////////////////////////////////////////////

        $sql_spcida773 = "SELECT (sum(pax) + sum(pax2))as tari_spc
                            FROM  reservas 
                            Where trip_no = '$trip' AND fecha_salida = '$fecha' AND id1 = '6' AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
        $rs_spcida773 = Doo::db()->query($sql_spcida773, array($trip, $fecha));
        $r_spcida773 = $rs_spcida773->fetchAll();
        $spc_seats_ida773 = $r_spcida773[0]['tari_spc'] ? $r_spcida773[0]['tari_spc'] : 0;

        $sql_spcretorno773 = "SELECT (sum(pax_r) + sum(pax2_r))as tari_spc
                            FROM  reservas 
                            Where trip_no2 = '$trip' AND fecha_retorno = '$fecha' AND id2 = '6' AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
        $rs_spcretorno773 = Doo::db()->query($sql_spcretorno773, array($trip, $fecha));
        $r_spcretorno773 = $rs_spcretorno773->fetchAll();
        $spc_seats_retorno773 = $r_spcretorno773[0]['tari_spc'] ? $r_spcretorno773[0]['tari_spc'] : 0;

        $special_total773 = $spc_seats_ida773 + $spc_seats_retorno773;

        //echo $special_total;

        $ocupadas773 = $standard_total773 + $superflex_total773 + $webfare_total773 + $superpromo_total773 + $superdiscount_total773 + $tours_total773 + $special_total773;
        //$ocupadas773 = $standard_total773 + $superflex_total773 + $tours_total773 + $special_total773;
        //$seats_remain773 = ($capacidad773 - $ocupadas773)-($puestos_ocupados773);
        

        
        $seats_remain773 = ($capacidad773 - $ocupadas773);
        
        $reservados773 = $capacidad773 - $seats_remain773; 
        //$spseats =
        //$sdseats =
        
        $wfseats_773 = $reservados773;
        $stseats_773 = $reservados773;
        //$sflexseats =
        $spprcseats_773 = $reservados773;
        $toursseats_773 = $reservados773;
        
        $capacidad773 = $reservados773;
        $seats_remain773 = 0;


        if($sflexseats_773 > 0){                    
                    $sflexseats_773 = $cap773['sflexseats'];                  
        }else{
            $sflexseats_773 = 0;
        }

        if($spseats_773 > 0){                    
            $spseats_773 = $cap773['spseats'];
        }else{
            $spseats_773 = 0;
        }

        if($sdseats_773 > 0){                    
            $sdseats_773 = $cap773['sdseats'];
        }else{                    
            $sdseats_773 = 0;
        }

        //$result = ($capacidad773 - $ocupadas773)-($puestos_ocupados773);
        //return array($result,$result_standard773,$result_superflex773,$result_webfare773,$result_superpromo773,$result_superdiscount773);   
            
         

        
      Doo::db()->query("UPDATE routes SET capacity = '$capacidad773', seats_remain = '$seats_remain773', wfseats = '$wfseats_773', stseats = '$stseats_773', sflexseats = '$sflexseats_773', spseats = '$spseats_773', sdseats = '$sdseats_773', spprcseats = '$spprcseats_773', toursseats = '$toursseats_773'  WHERE fecha_ini = '$fecha_actual'  AND trip_no = '773'");        
          
    
    
    //8000
      
        $sqlcap_8000 = "SELECT DISTINCT capacity, capacity2, capacity3, capacity4, capacity5, spseats, sdseats, stseats, wfseats, sflexseats, spprcseats, toursseats FROM routes WHERE fecha_ini = '$fecha_mas_un_dia' AND trip_no = '8000' ";
        $rscap_8000 = Doo::db()->query($sqlcap_8000);
        $capac_8000 = $rscap_8000->fetchAll();


        foreach ($capac_8000 as $cap8000) {

        }

        $capacidad1_8000 = $cap8000['capacity'];
        $capacidad2_8000 = $cap8000['capacity2'];
        $capacidad3_8000 = $cap8000['capacity3'];
        $capacidad4_8000 = $cap8000['capacity4'];
        $capacidad5_8000 = $cap8000['capacity5'];
        $stseats_8000 = $cap8000['stseats'];
        $spseats_8000 = $cap8000['spseats'];
        $sdseats_8000 = $cap8000['sdseats'];
        $wfseats_8000 = $cap8000['wfseats'];
        $sflexseats_8000 = $cap8000['sflexseats'];
        $spprcseats_8000 = $cap8000['spprcseats'];
        $toursseats_8000 = $cap8000['toursseats']; 

        $capacidad8000 = $capacidad1_8000 + $capacidad2_8000 + $capacidad3_8000 + $capacidad4_8000 + $capacidad5_8000;
        
        $trip = '8000';
        $fecha = $fecha_mas_un_dia;
        
      //tarifa standard
        $sql_stdida8000 = "SELECT (sum(pax) + sum(pax2))as tari_std
                          FROM  reservas 
                          Where trip_no = '$trip' AND fecha_salida = '$fecha' AND id1 = '1' AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
        $rs_stdida8000 = Doo::db()->query($sql_stdida8000, array($trip, $fecha));
        $r_stdida8000 = $rs_stdida8000->fetchAll();
        $std_seats_ida8000 = $r_stdida8000[0]['tari_std'] ? $r_stdida8000[0]['tari_std'] : 0;

        $sql_stdretorno8000 = "SELECT (sum(pax_r) + sum(pax2_r))as tari_std
                              FROM  reservas 
                              Where trip_no2 = '$trip' AND fecha_retorno = '$fecha' AND id2 = '1' AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
        $rs_stdretorno8000 = Doo::db()->query($sql_stdretorno8000, array($trip, $fecha));
        $r_stdretorno8000 = $rs_stdretorno8000->fetchAll();
        $std_seats_retorno8000 = $r_stdretorno8000[0]['tari_std'] ? $r_stdretorno8000[0]['tari_std'] : 0;

        $standard_total8000 = $std_seats_ida8000 + $std_seats_retorno8000;

        //echo $standard_total;
        //tarifa superflex
        $sqlflexida8000 = "SELECT (sum(pax) + sum(pax2))as tari_flex
                          FROM  reservas 
                          Where trip_no = '$trip' AND fecha_salida = '$fecha' AND id1 = '2' AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
        $rsflexida8000 = Doo::db()->query($sqlflexida8000, array($trip, $fecha));
        $r_flexida8000 = $rsflexida8000->fetchAll();
        $superflex_seats_ida8000 = $r_flexida8000[0]['tari_flex'] ? $r_flexida8000[0]['tari_flex'] : 0;

        $sqlflexretorno8000 = "SELECT (sum(pax_r) + sum(pax2_r))as tari_flex
                              FROM  reservas 
                              Where trip_no2 = '$trip' AND fecha_retorno = '$fecha' AND id2 = '2' AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
        $rsflexretorno8000 = Doo::db()->query($sqlflexretorno8000, array($trip, $fecha));
        $r_flexretorno8000 = $rsflexretorno8000->fetchAll();
        $superflex_seats_retorno8000 = $r_flexretorno8000[0]['tari_flex'] ? $r_flexretorno8000[0]['tari_flex'] : 0;

        $superflex_total8000 = $superflex_seats_ida8000 + $superflex_seats_retorno8000;

        //echo $superflex_total;

        //webfare
        $sqlwebida8000 = "SELECT (sum(pax) + sum(pax2))as webfare
                         FROM  reservas 
                         Where trip_no = '$trip' AND fecha_salida = '$fecha' AND id1 = '3' AND agency = '53' AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
        $rswebida8000 = Doo::db()->query($sqlwebida8000, array($trip, $fecha));
        $r_webida8000 = $rswebida8000->fetchAll();
        $webfare_ida8000 = $r_webida8000[0]['webfare'] ? $r_webida8000[0]['webfare'] : 0;

        $sqlwebretorno8000 = "SELECT (sum(pax_r) + sum(pax2_r))as webfare
                             FROM  reservas 
                             Where trip_no2 = '$trip' AND fecha_retorno = '$fecha' AND id2 = '3' AND agency = '53' AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
        $rswebretorno8000 = Doo::db()->query($sqlwebretorno8000, array($trip, $fecha));
        $r_webretorno8000 = $rswebretorno8000->fetchAll();
        $webfare_retorno8000 = $r_webretorno8000[0]['webfare'] ? $r_webretorno8000[0]['webfare'] : 0;

        $webfare_total8000 = $webfare_ida8000 + $webfare_retorno8000;

        //echo $webfare_total;
        //superpromo
        $sqlspromoida8000 = "SELECT (sum(pax) + sum(pax2))as spromo
        FROM  reservas 
        Where trip_no = '$trip' AND fecha_salida = '$fecha' AND id1 = '4' AND agency = '53' AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
        $rsspromoida8000 = Doo::db()->query($sqlspromoida8000, array($trip, $fecha));
        $r_spromoida8000 = $rsspromoida8000->fetchAll();
        $superpromo_ida8000 = $r_spromoida8000[0]['spromo'] ? $r_spromoida8000[0]['spromo'] : 0;

        $sqlspromoretorno8000 = "SELECT (sum(pax_r) + sum(pax2_r))as spromo
                            FROM  reservas 
                            Where trip_no2 = '$trip' AND fecha_retorno = '$fecha' AND id2 = '4' AND agency = '53' AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
        $rsspromoretorno8000 = Doo::db()->query($sqlspromoretorno8000, array($trip, $fecha));
        $r_spromoretorno8000 = $rsspromoretorno8000->fetchAll();
        $superpromo_retorno8000 = $r_spromoretorno8000[0]['spromo'] ? $r_spromoretorno8000[0]['spromo'] : 0;

        $superpromo_total8000 = $superpromo_ida8000 + $superpromo_retorno8000;

        //echo $superpromo_total;
        //superdiscount
        $sqlsdiscida8000 = "SELECT (sum(pax) + sum(pax2))as sdisc
                            FROM  reservas 
                            Where trip_no = '$trip' AND fecha_salida = '$fecha' AND id1 = '5' AND agency = '53' AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
        $rsdiscida8000 = Doo::db()->query($sqlsdiscida8000, array($trip, $fecha));
        $r_discida8000 = $rsdiscida8000->fetchAll();
        $superdisc_ida8000 = $r_discida8000[0]['sdisc'] ? $r_discida8000[0]['sdisc'] : 0;

        $sqlsdiscretorno8000 = "SELECT (sum(pax_r) + sum(pax2_r))as sdisc
                            FROM  reservas 
                            Where trip_no2 = '$trip' AND fecha_retorno = '$fecha' AND id2 = '5' AND agency = '53' AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
        $rssdiscretorno8000 = Doo::db()->query($sqlsdiscretorno8000, array($trip, $fecha));
        $r_discretorno8000 = $rssdiscretorno8000->fetchAll();
        $superdisc_retorno8000 = $r_discretorno8000[0]['sdisc'] ? $r_discretorno8000[0]['sdisc'] : 0;

        $superdiscount_total8000 = $superdisc_ida8000 + $superdisc_retorno8000;

        //echo $superdiscount_total;

        //tours
        //De Ida
        $sqlTourIda8000 = "SELECT (sum(pax) + sum(pax2))as ocupadas_tour
                            FROM  reservas 
                            Where trip_no = '$trip' AND fecha_salida = '$fecha' AND (type_tour = 'ONE' OR type_tour = 'MULTI') AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
        $rstida8000 = Doo::db()->query($sqlTourIda8000, array($trip, $fecha));
        $r_tida8000 = $rstida8000->fetchAll();
        $ocupadas_tour_ida8000 = $r_tida8000[0]['ocupadas_tour'] ? $r_tida8000[0]['ocupadas_tour'] : 0;


        //De Retorno
        $sqlTourReturn8000 = "SELECT (sum(pax_r) + sum(pax2_r))as ocupadas_tour
                            FROM  reservas 
                            Where trip_no2 = '$trip' AND fecha_retorno = '$fecha' AND (type_tour = 'ONE' OR type_tour = 'MULTI') AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
        $rstreturn8000 = Doo::db()->query($sqlTourReturn8000, array($trip, $fecha));
        $r_treturn8000 = $rstreturn8000->fetchAll();
        $ocupadas_tour_return8000 = $r_treturn8000[0]['ocupadas_tour'] ? $r_treturn8000[0]['ocupadas_tour'] : 0;


        $tours_total8000 = $ocupadas_tour_ida8000 + $ocupadas_tour_return8000;

//                      echo $tours_total;
        //SPECIAL/////////////////////////////////////////////////////////////////

        $sql_spcida8000 = "SELECT (sum(pax) + sum(pax2))as tari_spc
                            FROM  reservas 
                            Where trip_no = '$trip' AND fecha_salida = '$fecha' AND id1 = '6' AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
        $rs_spcida8000 = Doo::db()->query($sql_spcida8000, array($trip, $fecha));
        $r_spcida8000 = $rs_spcida8000->fetchAll();
        $spc_seats_ida8000 = $r_spcida8000[0]['tari_spc'] ? $r_spcida8000[0]['tari_spc'] : 0;

        $sql_spcretorno8000 = "SELECT (sum(pax_r) + sum(pax2_r))as tari_spc
                            FROM  reservas 
                            Where trip_no2 = '$trip' AND fecha_retorno = '$fecha' AND id2 = '6' AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
        $rs_spcretorno8000 = Doo::db()->query($sql_spcretorno8000, array($trip, $fecha));
        $r_spcretorno8000 = $rs_spcretorno8000->fetchAll();
        $spc_seats_retorno8000 = $r_spcretorno8000[0]['tari_spc'] ? $r_spcretorno8000[0]['tari_spc'] : 0;

        $special_total8000 = $spc_seats_ida8000 + $spc_seats_retorno8000;

        //echo $special_total;

        $ocupadas8000 = $standard_total8000 + $superflex_total8000 + $webfare_total8000 + $superpromo_total8000 + $superdiscount_total8000 + $tours_total8000 + $special_total8000;
        //$ocupadas8000 = $standard_total8000 + $superflex_total8000 + $tours_total8000 + $special_total8000;
        //$seats_remain8000 = ($capacidad8000 - $ocupadas8000)-($puestos_ocupados8000);
        

        
        $seats_remain8000 = ($capacidad8000 - $ocupadas8000);
        
        $reservados8000 = $capacidad8000 - $seats_remain8000; 
        //$spseats =
        //$sdseats =
        
        $wfseats_8000 = $reservados8000;
        $stseats_8000 = $reservados8000;
        //$sflexseats =
        $spprcseats_8000 = $reservados8000;
        $toursseats_8000 = $reservados8000;
        
        $capacidad8000 = $reservados8000;
        $seats_remain8000 = 0;


        if($sflexseats_8000 > 0){                    
                    $sflexseats_8000 = $cap8000['sflexseats'];                  
        }else{
            $sflexseats_8000 = 0;
        }

        if($spseats_8000 > 0){                    
            $spseats_8000 = $cap8000['spseats'];
        }else{
            $spseats_8000 = 0;
        }

        if($sdseats_8000 > 0){                    
            $sdseats_8000 = $cap8000['sdseats'];
        }else{                    
            $sdseats_8000 = 0;
        }

        //$result = ($capacidad8000 - $ocupadas8000)-($puestos_ocupados8000);
        //return array($result,$result_standard8000,$result_superflex8000,$result_webfare8000,$result_superpromo8000,$result_superdiscount8000);   
            
         

        
      Doo::db()->query("UPDATE routes SET capacity = '$capacidad8000', seats_remain = '$seats_remain8000', wfseats = '$wfseats_8000', stseats = '$stseats_8000', sflexseats = '$sflexseats_8000', spseats = '$spseats_8000', sdseats = '$sdseats_8000', spprcseats = '$spprcseats_8000', toursseats = '$toursseats_8000'  WHERE fecha_ini = '$fecha_mas_un_dia'  AND trip_no = '8000'");        
          
               
    //8001
      
        $sqlcap_8001 = "SELECT DISTINCT capacity, capacity2, capacity3, capacity4, capacity5, spseats, sdseats, stseats, wfseats, sflexseats, spprcseats, toursseats FROM routes WHERE fecha_ini = '$fecha_mas_un_dia' AND trip_no = '8001' ";
        $rscap_8001 = Doo::db()->query($sqlcap_8001);
        $capac_8001 = $rscap_8001->fetchAll();


        foreach ($capac_8001 as $cap8001) {

        }

        $capacidad1_8001 = $cap8001['capacity'];
        $capacidad2_8001 = $cap8001['capacity2'];
        $capacidad3_8001 = $cap8001['capacity3'];
        $capacidad4_8001 = $cap8001['capacity4'];
        $capacidad5_8001 = $cap8001['capacity5'];
        $stseats_8001 = $cap8001['stseats'];
        $spseats_8001 = $cap8001['spseats'];
        $sdseats_8001 = $cap8001['sdseats'];
        $wfseats_8001 = $cap8001['wfseats'];
        $sflexseats_8001 = $cap8001['sflexseats'];
        $spprcseats_8001 = $cap8001['spprcseats'];
        $toursseats_8001 = $cap8001['toursseats']; 

        $capacidad8001 = $capacidad1_8001 + $capacidad2_8001 + $capacidad3_8001 + $capacidad4_8001 + $capacidad5_8001;
        
        $trip = '8001';
        $fecha = $fecha_mas_un_dia;
        
      //tarifa standard
        $sql_stdida8001 = "SELECT (sum(pax) + sum(pax2))as tari_std
                          FROM  reservas 
                          Where trip_no = '$trip' AND fecha_salida = '$fecha' AND id1 = '1' AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
        $rs_stdida8001 = Doo::db()->query($sql_stdida8001, array($trip, $fecha));
        $r_stdida8001 = $rs_stdida8001->fetchAll();
        $std_seats_ida8001 = $r_stdida8001[0]['tari_std'] ? $r_stdida8001[0]['tari_std'] : 0;

        $sql_stdretorno8001 = "SELECT (sum(pax_r) + sum(pax2_r))as tari_std
                              FROM  reservas 
                              Where trip_no2 = '$trip' AND fecha_retorno = '$fecha' AND id2 = '1' AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
        $rs_stdretorno8001 = Doo::db()->query($sql_stdretorno8001, array($trip, $fecha));
        $r_stdretorno8001 = $rs_stdretorno8001->fetchAll();
        $std_seats_retorno8001 = $r_stdretorno8001[0]['tari_std'] ? $r_stdretorno8001[0]['tari_std'] : 0;

        $standard_total8001 = $std_seats_ida8001 + $std_seats_retorno8001;

        //echo $standard_total;
        //tarifa superflex
        $sqlflexida8001 = "SELECT (sum(pax) + sum(pax2))as tari_flex
                          FROM  reservas 
                          Where trip_no = '$trip' AND fecha_salida = '$fecha' AND id1 = '2' AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
        $rsflexida8001 = Doo::db()->query($sqlflexida8001, array($trip, $fecha));
        $r_flexida8001 = $rsflexida8001->fetchAll();
        $superflex_seats_ida8001 = $r_flexida8001[0]['tari_flex'] ? $r_flexida8001[0]['tari_flex'] : 0;

        $sqlflexretorno8001 = "SELECT (sum(pax_r) + sum(pax2_r))as tari_flex
                              FROM  reservas 
                              Where trip_no2 = '$trip' AND fecha_retorno = '$fecha' AND id2 = '2' AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
        $rsflexretorno8001 = Doo::db()->query($sqlflexretorno8001, array($trip, $fecha));
        $r_flexretorno8001 = $rsflexretorno8001->fetchAll();
        $superflex_seats_retorno8001 = $r_flexretorno8001[0]['tari_flex'] ? $r_flexretorno8001[0]['tari_flex'] : 0;

        $superflex_total8001 = $superflex_seats_ida8001 + $superflex_seats_retorno8001;

        //echo $superflex_total;

        //webfare
        $sqlwebida8001 = "SELECT (sum(pax) + sum(pax2))as webfare
                         FROM  reservas 
                         Where trip_no = '$trip' AND fecha_salida = '$fecha' AND id1 = '3' AND agency = '53' AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
        $rswebida8001 = Doo::db()->query($sqlwebida8001, array($trip, $fecha));
        $r_webida8001 = $rswebida8001->fetchAll();
        $webfare_ida8001 = $r_webida8001[0]['webfare'] ? $r_webida8001[0]['webfare'] : 0;

        $sqlwebretorno8001 = "SELECT (sum(pax_r) + sum(pax2_r))as webfare
                             FROM  reservas 
                             Where trip_no2 = '$trip' AND fecha_retorno = '$fecha' AND id2 = '3' AND agency = '53' AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
        $rswebretorno8001 = Doo::db()->query($sqlwebretorno8001, array($trip, $fecha));
        $r_webretorno8001 = $rswebretorno8001->fetchAll();
        $webfare_retorno8001 = $r_webretorno8001[0]['webfare'] ? $r_webretorno8001[0]['webfare'] : 0;

        $webfare_total8001 = $webfare_ida8001 + $webfare_retorno8001;

        //echo $webfare_total;
        //superpromo
        $sqlspromoida8001 = "SELECT (sum(pax) + sum(pax2))as spromo
        FROM  reservas 
        Where trip_no = '$trip' AND fecha_salida = '$fecha' AND id1 = '4' AND agency = '53' AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
        $rsspromoida8001 = Doo::db()->query($sqlspromoida8001, array($trip, $fecha));
        $r_spromoida8001 = $rsspromoida8001->fetchAll();
        $superpromo_ida8001 = $r_spromoida8001[0]['spromo'] ? $r_spromoida8001[0]['spromo'] : 0;

        $sqlspromoretorno8001 = "SELECT (sum(pax_r) + sum(pax2_r))as spromo
                            FROM  reservas 
                            Where trip_no2 = '$trip' AND fecha_retorno = '$fecha' AND id2 = '4' AND agency = '53' AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
        $rsspromoretorno8001 = Doo::db()->query($sqlspromoretorno8001, array($trip, $fecha));
        $r_spromoretorno8001 = $rsspromoretorno8001->fetchAll();
        $superpromo_retorno8001 = $r_spromoretorno8001[0]['spromo'] ? $r_spromoretorno8001[0]['spromo'] : 0;

        $superpromo_total8001 = $superpromo_ida8001 + $superpromo_retorno8001;

        //echo $superpromo_total;
        //superdiscount
        $sqlsdiscida8001 = "SELECT (sum(pax) + sum(pax2))as sdisc
                            FROM  reservas 
                            Where trip_no = '$trip' AND fecha_salida = '$fecha' AND id1 = '5' AND agency = '53' AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
        $rsdiscida8001 = Doo::db()->query($sqlsdiscida8001, array($trip, $fecha));
        $r_discida8001 = $rsdiscida8001->fetchAll();
        $superdisc_ida8001 = $r_discida8001[0]['sdisc'] ? $r_discida8001[0]['sdisc'] : 0;

        $sqlsdiscretorno8001 = "SELECT (sum(pax_r) + sum(pax2_r))as sdisc
                            FROM  reservas 
                            Where trip_no2 = '$trip' AND fecha_retorno = '$fecha' AND id2 = '5' AND agency = '53' AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
        $rssdiscretorno8001 = Doo::db()->query($sqlsdiscretorno8001, array($trip, $fecha));
        $r_discretorno8001 = $rssdiscretorno8001->fetchAll();
        $superdisc_retorno8001 = $r_discretorno8001[0]['sdisc'] ? $r_discretorno8001[0]['sdisc'] : 0;

        $superdiscount_total8001 = $superdisc_ida8001 + $superdisc_retorno8001;

        //echo $superdiscount_total;

        //tours
        //De Ida
        $sqlTourIda8001 = "SELECT (sum(pax) + sum(pax2))as ocupadas_tour
                            FROM  reservas 
                            Where trip_no = '$trip' AND fecha_salida = '$fecha' AND (type_tour = 'ONE' OR type_tour = 'MULTI') AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
        $rstida8001 = Doo::db()->query($sqlTourIda8001, array($trip, $fecha));
        $r_tida8001 = $rstida8001->fetchAll();
        $ocupadas_tour_ida8001 = $r_tida8001[0]['ocupadas_tour'] ? $r_tida8001[0]['ocupadas_tour'] : 0;


        //De Retorno
        $sqlTourReturn8001 = "SELECT (sum(pax_r) + sum(pax2_r))as ocupadas_tour
                            FROM  reservas 
                            Where trip_no2 = '$trip' AND fecha_retorno = '$fecha' AND (type_tour = 'ONE' OR type_tour = 'MULTI') AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
        $rstreturn8001 = Doo::db()->query($sqlTourReturn8001, array($trip, $fecha));
        $r_treturn8001 = $rstreturn8001->fetchAll();
        $ocupadas_tour_return8001 = $r_treturn8001[0]['ocupadas_tour'] ? $r_treturn8001[0]['ocupadas_tour'] : 0;


        $tours_total8001 = $ocupadas_tour_ida8001 + $ocupadas_tour_return8001;

//                      echo $tours_total;
        //SPECIAL/////////////////////////////////////////////////////////////////

        $sql_spcida8001 = "SELECT (sum(pax) + sum(pax2))as tari_spc
                            FROM  reservas 
                            Where trip_no = '$trip' AND fecha_salida = '$fecha' AND id1 = '6' AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
        $rs_spcida8001 = Doo::db()->query($sql_spcida8001, array($trip, $fecha));
        $r_spcida8001 = $rs_spcida8001->fetchAll();
        $spc_seats_ida8001 = $r_spcida8001[0]['tari_spc'] ? $r_spcida8001[0]['tari_spc'] : 0;

        $sql_spcretorno8001 = "SELECT (sum(pax_r) + sum(pax2_r))as tari_spc
                            FROM  reservas 
                            Where trip_no2 = '$trip' AND fecha_retorno = '$fecha' AND id2 = '6' AND estado != 'QUOTE' AND estado != 'CANCELED' AND estado != 'NOT SHOW W/ CHARGE' AND estado != 'NOT SHOW W/O CHARGE'";
        $rs_spcretorno8001 = Doo::db()->query($sql_spcretorno8001, array($trip, $fecha));
        $r_spcretorno8001 = $rs_spcretorno8001->fetchAll();
        $spc_seats_retorno8001 = $r_spcretorno8001[0]['tari_spc'] ? $r_spcretorno8001[0]['tari_spc'] : 0;

        $special_total8001 = $spc_seats_ida8001 + $spc_seats_retorno8001;

        //echo $special_total;

        $ocupadas8001 = $standard_total8001 + $superflex_total8001 + $webfare_total8001 + $superpromo_total8001 + $superdiscount_total8001 + $tours_total8001 + $special_total8001;
        //$ocupadas8001 = $standard_total8001 + $superflex_total8001 + $tours_total8001 + $special_total8001;
        //$seats_remain8001 = ($capacidad8001 - $ocupadas8001)-($puestos_ocupados8001);
        

        
        $seats_remain8001 = ($capacidad8001 - $ocupadas8001);
        
        $reservados8001 = $capacidad8001 - $seats_remain8001; 
        //$spseats =
        //$sdseats =
        
        $wfseats_8001 = $reservados8001;
        $stseats_8001 = $reservados8001;
        //$sflexseats =
        $spprcseats_8001 = $reservados8001;
        $toursseats_8001 = $reservados8001;
        
        $capacidad8001 = $reservados8001;
        $seats_remain8001 = 0;


        if($sflexseats_8001 > 0){                    
                    $sflexseats_8001 = $cap8001['sflexseats'];                  
        }else{
            $sflexseats_8001 = 0;
        }

        if($spseats_8001 > 0){                    
            $spseats_8001 = $cap8001['spseats'];
        }else{
            $spseats_8001 = 0;
        }

        if($sdseats_8001 > 0){                    
            $sdseats_8001 = $cap8001['sdseats'];
        }else{                    
            $sdseats_8001 = 0;
        }

        //$result = ($capacidad8001 - $ocupadas8001)-($puestos_ocupados8001);
        //return array($result,$result_standard8001,$result_superflex8001,$result_webfare8001,$result_superpromo8001,$result_superdiscount8001);   
            
         

        
      Doo::db()->query("UPDATE routes SET capacity = '$capacidad8001', seats_remain = '$seats_remain8001', wfseats = '$wfseats_8001', stseats = '$stseats_8001', sflexseats = '$sflexseats_8001', spseats = '$spseats_8001', sdseats = '$sdseats_8001', spprcseats = '$spprcseats_8001', toursseats = '$toursseats_8001'  WHERE fecha_ini = '$fecha_mas_un_dia'  AND trip_no = '8001'");        
          
                 
      
    
    
}

        
        
        // if(isset($_SESSION["booking"])){//Sin comentarios, Sorry

        
          $booking = $_SESSION["booking"];
            $modalT = $this->naveganteT();
            print($modalT);
        // }else{
          $s = date("s");
          $iden = rand(10, 90) . 0 . rand(1, 9);
          if(isset($_SESSION["booking"])){
               $booking = $_SESSION["booking"];
              if($booking["iden"]!=""){
                  $iden = $booking["iden"];
              } else {
                  $iden = $iden;
              }
          }else{
              $iden = $iden;
          }
          // print_r($_SESSION["booking"]);
          // die;
          $_SESSION["booking"]['iden'] = $iden;
          $modalT = $this->naveganteT();
          print($modalT);
        // }
          // print_r($_SESSION["booking"]);
          // die;
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
       
        unset($_SESSION['pasabordo']);
        $sql = "SELECT id, nombre, orden FROM  areas WHERE id <> '20' ORDER BY orden ASC ";
        $rs = Doo::db()->query($sql);
        $areas = $rs->fetchAll();
        $this->data['areas'] = $areas;
        $this->renderc('home2', $this->data);
    }

    /*     * ***** */

    /* PREGUNTA SI ERES RESIDENTE DE FLOIRIDA */

    public function areyou() {
        Doo::loadModel("Agency");
        Doo::loadModel("Reservas_trip_puestos");
        if (isset($_SESSION['data_agency'])){
            $dat = new Agency($_SESSION['data_agency']);
        } else {
            $dat = new Agency();
            $net_rate = false;
            $dat->type_rate = 0;
        }
        $booking = $_SESSION['booking'];
        $iden = $booking['iden'];
        if($iden == '' || $iden == null){
          $this->index();
        }

        $a = "UPDATE reservas_trip_puestos SET estado = 'CANCELLED' WHERE usuario = $iden and estado = 'USING'";
        Doo::db()->query($a);
        if (isset($_SESSION["booking"])) {
                $booking = $_SESSION["booking"];
                $tipo_ticket = $_POST["tipo_ticket"];
                $from = $booking["fromt"];
                $to = $booking["tot"];
                $fecha_salida = $booking["fecha_salida"];
                $fecha_retorno = $booking["fecha_retorno"];
                $pax = $booking["pax"];
                $chil = $booking["chil"];
                $iden = $iden;
            }
            $data = array(
                $tipo_ticket => $_POST["tipo_ticket"],
                $from => $_POST["fromt"],
                $to => $_POST["tot"],
                $fecha_salida => $_POST["fecha_salida"],
                $fecha_retorno => $_POST["fecha_retorno"],
                $pax => $_POST["pax"],
                $chil => $_POST["pax2"],
                $iden => $iden
            );
            
         if (!isset($tipo_ticket)) {
            return Doo::conf()->APP_URL;
        }
        $bt = "SELECT NOW() as time from reservas_trip_puestos";
                    $sqlS=Doo::db()->query($bt);
                    foreach ($sqlS as $S):
                        $dateTbt = $S['time'];
                    endforeach;
        $dateT = $dateTbt;
        $dateT1 = $booking["dateT1"];
        $dateT2 = $booking["dateT2"];
        $booking = array(
            "tipo_ticket" => $tipo_ticket,
            "fromt" => $from,
            "tot" => $to,
            "fecha_salida" => $fecha_salida,
            "fecha_retorno" => $fecha_retorno,
            "pax" => $pax,
            "chil" => $chil,
            "iden" => $iden,
            "dateT" =>$dateT,
            "dateT1" => $dateT1,
            "dateT2" => $dateT2
        );
        $_SESSION["booking"] = $booking;
        $rs = Doo::db()->find("Areas", array("select" => "nombre",
            "where" => "id = ?",
            "param" => array($from),
            "limit" => 1));
        $from_name = $rs->nombre;
        $rs = Doo::db()->find("Areas", array("select" => "nombre",
            "where" => "id = ?",
            "param" => array($to),
            "limit" => 1));
        $to_name = $rs->nombre;
        $this->data['from_name'] = $from_name;
        $this->data['to_name'] = $to_name;
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['areas'] = Doo::db()->find("Areas", array("select" => "id, nombre", "asArray" => true));
        if (isset($_SESSION['data_agency'])) {
            return Doo::conf()->APP_URL . "booking/";
        } else {
            $this->renderc('questions', $this->data, true);
        }
    }



    public function floridaResident() {
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $tipo_ticket = $_POST['tipo_ticket'];
        $from = $_POST['fromt'];
        $to = $_POST['tot'];
        $fecha_salida = $_POST['fecha_salida'];
        $fecha_retorno = $_POST['fecha_retorno'];
        $adult = $_POST['adult'];
        $child = $_POST['child'];
        //echo $tipo_ticket;
        $booking = array(
            "tipo_ticket" => $tipo_ticket,
            "fromt" => $from,
            "tot" => $to,
            "fecha_salida" => $fecha_salida,
            "fecha_retorno" => $fecha_retorno,
            "adult" => $adult,
            "child" => $child,
        );
        $_SESSION["booking"] = $booking;

        $rs = Doo::db()->find("Areas", array("select" => "nombre",
            "where" => "id = ?",
            "param" => array($from),
            "limit" => 1));
        $from_name = $rs->nombre;

        $rs2 = Doo::db()->find("Areas", array("select" => "nombre",
            "where" => "id = ?",
            "param" => array($to),
            "limit" => 1));

        $to_name = $rs2->nombre;
        $this->data['from_name'] = $from_name;
        $this->data['to_name'] = $to_name;
        //print_r($_SESSION["booking"]);
        $this->renderc('questionsMobile', $this->data, true);
    }

    public function dateFormatMonthDayYear($fecha){
      list($day, $month, $years) = explode('/', $fecha);
      $fechaFormateada = $day.'-'.$month.'-'.$years;
      return date("d-m-Y", strtotime($fechaFormateada));
    }

    /* AGENDA O BOOKING DEL TICKET */

    public function booking() {
      session_start();
      Doo::loadModel("Reservas_trip_puestos");
      $booking = $_SESSION["booking"];
      $iden = $booking['iden'];
      $a = "UPDATE reservas_trip_puestos SET estado = 'CANCELLED' WHERE usuario = $iden and estado = 'USING'";
      Doo::db()->query($a);
      $data = array(
        "tipo_ticket" => $_POST["tipo_ticket"],
        "from" => $_POST["fromt"],
        "to" => $_POST["tot"],
        "fecha_salida" => $this->dateFormatMonthDayYear($_POST["fecha_salida"]),
        "fecha_retorno" => $this->dateFormatMonthDayYear($_POST["fecha_retorno"]),
        "pax" => $_POST["pax"],
        "chil" => $_POST["pax2"],
        "iden" => $iden
    );
    
      if (isset($_SESSION["booking"])) {
              $booking = $_SESSION["booking"];
              $tipo_ticket = $data["tipo_ticket"];
              $from = $data["from"];
              $to = $data["to"];
              $fecha_salida = $data["fecha_salida"];
              $fecha_retorno = $data["fecha_retorno"];
              $pax = $data["pax"];
              $chil = $data["chil"];
              $iden = $iden;
          }
          
         
       if (!isset($tipo_ticket)) {
          return Doo::conf()->APP_URL;
      }
      $bt = "SELECT NOW() as time from reservas_trip_puestos";
                  $sqlS=Doo::db()->query($bt);
                  foreach ($sqlS as $S):
                      $dateTbt = $S['time'];
                  endforeach;
      $dateT = $dateTbt;
      $dateT1 = $booking["dateT1"];
      $dateT2 = $booking["dateT2"];
      $booking = array(
          "tipo_ticket" => $tipo_ticket,
          "fromt" => $from,
          "tot" => $to,
          "fecha_salida" => $fecha_salida,
          "fecha_retorno" => $fecha_retorno,
          "pax" => $pax,
          "chil" => $chil,
          "iden" => $iden,
          "dateT" =>$dateT,
          "dateT1" => $dateT1,
          "dateT2" => $dateT2
      );
      $_SESSION["booking"] = $booking;
      
      $rs = Doo::db()->find("Areas", array("select" => "nombre",
          "where" => "id = ?",
          "param" => array($from),
          "limit" => 1));
      $from_name = $rs->nombre;
      $rs = Doo::db()->find("Areas", array("select" => "nombre",
          "where" => "id = ?",
          "param" => array($to),
          "limit" => 1));
      $to_name = $rs->nombre;
      $this->data['from_name'] = $from_name;
      $this->data['to_name'] = $to_name;
      $this->data['rootUrl'] = Doo::conf()->APP_URL;
      $this->data['areas'] = Doo::db()->find("Areas", array("select" => "id, nombre", "asArray" => true));
      
      
        
        Doo::loadModel("Agency");
        if (isset($_SESSION['data_agency'])) {
            $dat = new Agency($_SESSION['data_agency']);
            $net_rate = ($dat->type_rate == 1) ? true : false;
        } else {
            $dat = new Agency();
            $net_rate = false;
            $dat->type_rate = 0;
        }
        
        
        if (isset($_SESSION["booking"])) {

            $booking = $_SESSION["booking"];
            $tipo_ticket = $booking["tipo_ticket"];
            $from = $booking["fromt"];
            $to = $booking["tot"];
            $fecha_salida = $booking["fecha_salida"];
            $fecha_retorno = $booking["fecha_retorno"];
            $pax = $booking["pax"];
            $chil = $booking["chil"];
            $resident = isset($booking["resident"]) ? $booking["resident"] : "0";
            $zip = isset($booking["zip"]) ? $booking["zip"] : "0";
            $dateT = $booking["dateT"];
            $dateT1 = $booking["dateT1"];
            $dateT2 = $booking["dateT2"];
        } else {
            return Doo::conf()->APP_URL;
        }
        

        $date = date("Y-m-d");
        list($mes, $dia, $anyo) = explode("-", $fecha_salida);
        $salida = $anyo . "-" . $mes . "-" . $dia;
        if ($fecha_retorno != "" && $fecha_retorno != "N/A") {
            list($mes2, $dia2, $anyo2) = explode("-", $fecha_retorno);
            $retorno = $anyo2 . "-" . $mes2 . "-" . $dia2;
        }


        $hora = date("H:i");
        $hora2 = date("H:i");
        if (strtotime($date) != strtotime($salida)) {
            $hora = "";
        }
        if (isset($retorno)) {
            if (strtotime($date) != strtotime($retorno)) {
                $hora2 = "";
            }
        }
       

        ///////////////////////////////////////////////// *Ofertas*/ IDA

        if (!isset($_SESSION['data_agency'])) {
            $sqlofer = "(SELECT t1.trip_no, t1.id, t1.fecha_ini, t1.fecha_fin, t4.nombre AS trip_from, t5.nombre AS trip_to, t1.price, t1.price2, t1.price3, t1.price4, t1.regular, t1.frecuente,  t3.equipment
						FROM ofertas t1
							LEFT JOIN trips  t3 ON ( t1.trip_no = t3.trip_no )
							LEFT JOIN areas  t4 ON (t1.trip_from = t4.id)
							LEFT JOIN areas  t5 ON  (t1.trip_to  = t5.id)
						WHERE t1.trip_from = ?
							AND t1.trip_to = ?
							AND t1.fecha_ini <= ?
							AND t1.fecha_fin >= ? order by t1.trip_no asc)";
            $rsofer = Doo::db()->query($sqlofer, array($from, $to, strtotime($salida), strtotime($salida)));
            $ofertas = $rsofer->fetchAll();
            foreach ($ofertas as $key => $value) {
                $_SESSION["ofertaida"][$key] = $value;
            }

            //////////////////////////////////////////////// /* Cierre de ofertas */    IDA
            //////////////////////////////////////////////// / *Ofertas*/ Return

            $sqlofer2 = "(SELECT t1.trip_no, t1.id, t1.fecha_ini, t1.fecha_fin, t4.nombre AS trip_from, t5.nombre AS trip_to, t1.price, t1.price2, t1.price3, t1.price4, t1.regular, t1.frecuente, t3.equipment
                         FROM ofertas t1
						 	LEFT JOIN trips  t3 ON (t1.trip_no = t3.trip_no )
							LEFT JOIN areas  t4 ON (t1.trip_from = t4.id)
							LEFT JOIN areas  t5 ON  (t1.trip_to  = t5.id)
                         WHERE t1.trip_from = ?
						 	AND t1.trip_to = ?
							AND t1.fecha_ini <= ?
							AND t1.fecha_fin >= ?)";

            if (isset($retorno)) {
                $rsofer2 = Doo::db()->query($sqlofer2, array($to, $from, strtotime($retorno), strtotime($retorno)));
                $ofertas2 = $rsofer2->fetchAll();
                foreach ($ofertas2 as $key => $value) {
                    $_SESSION["ofertaretur"] = $value;
                }
            }

        } else {
            $ofertas = " ";
            $ofertas2 = " ";
        }
        list($dia22, $mes22, $anno22) = explode("-", $fecha_salida);
        $fecha_retorno1 = $anno22 . "-" . $mes22 . "-" . $dia22;
        
        list($mes, $dia, $anno) = explode("-", $fecha_retorno);        
        $fecha_retorno2 = $mes . "-" . $dia . "-" . $anno;
        
        
        
//        echo  "Fec Ret 1".$fecha_retorno1;
//        echo  "Fec Ret 2".$fecha_retorno2;
        //echo  $anno22;
//        die;
        //////////////////////////////////////////////// /* Cierre de ofertas */    Return

        $sql = "SELECT distinct t2.trip_no, t2.id,t2.fecha_ini,t4.nombre AS trip_from,t5.nombre AS trip_to,t2.spprc_adult,t2.spprc_child,
                t2.sdprc_adult,t2.sdprc_child,t2.sflexprc_adult,t2.sflexprc_child,t2.seats_remain,t2.univext,t2.wdext,t2.f1t3,t2.f1t4,
                t2.f1t5,t2.f1t6,t2.f1t7,t2.f1t8,t2.f1t9,t2.f1t10,t2.f1t19,t2.f1t11,t2.f1t12,t2.f1t13,t2.f1t14,t2.f2t3,t2.f2t4,t2.f2t5,
                t2.f2t6,t2.f2t7,t2.f2t8,t2.f2t9,t2.f2t10,t2.f2t19,t2.f2t11,t2.f2t12,t2.f2t13,t2.f2t14,t2.f3t4,t2.f3t5,t2.f3t6,t2.f3t7,
                t2.f3t8,t2.f3t9,t2.f3t10,t2.f3t19,t2.f3t11,t2.f3t12,t2.f3t13,t2.f3t14,t2.f4t5,t2.f4t6,t2.f4t7,t2.f4t8,t2.f4t9,t2.f4t10,
                t2.f4t19,t2.f4t11,t2.f4t12,t2.f4t13,t2.f4t14,t2.f5t6,t2.f5t7,t2.f5t8,t2.f5t9,t2.f5t10,t2.f5t19,t2.f5t11,t2.f5t12,t2.f5t13,t2.f5t14,
                t2.flresprc_adult,t2.flresprc_child,t2.wfprc_adult,t2.wfprc_child,t2.trip_departure,t2.trip_arrival,t3.equipment,t1.estado,t2.capacity
            FROM
              programacion t1
              LEFT JOIN routes t2
                ON (t1.trip_no = t2.trip_no)
              LEFT JOIN trips t3
                ON (t1.trip_no = t3.trip_no)
              LEFT JOIN areas t4
                ON (t2.trip_from = t4.id)
              LEFT JOIN areas t5
                ON (t2.trip_to = t5.id)
            WHERE t2.type_rate = '0'
              AND t2.trip_from = '$from'
              AND t2.trip_to = '$to'
              AND t2.fecha_ini = '$fecha_retorno1'
            ORDER BY t2.trip_departure ASC";
        
        
        if ($net_rate) {
            $sql_net = "SELECT t1.trip_no, t2.id, t2.id, t1.fecha, t4.nombre as trip_from, t5.nombre as trip_to, t2.price, t2.price2, t2.price3, t2.price4, t2.trip_departure, t2.trip_arrival, t3.equipment, t1.estado, t2.capacity
            FROM programacion t1
            left join routes_net t2 on (t1.trip_no = t2.trip_no)
            left join trips  t3 on (t1.trip_no = t3.trip_no)
            left join areas  t4 on (t2.trip_from = t4.id)
            left join areas  t5 on  (t2.trip_to  = t5.id)
            WHERE t2.type_rate = 2
            AND t2.id_agency = '$dat->id'
            AND t2.trip_from = ?
            AND t2.trip_to = ?
            AND fecha = ?
            AND t2.trip_departure > '$hora'
            AND t1.estado = '1'
            AND t2.anno='$anyo' ORDER BY t2.trip_departure ASC";

            $sql = "Select
            ms.trip_no, ms.id, ms.fecha, ms.trip_from, ms.trip_to,

            CASE
                  WHEN ms.trip_no = k.trip_no THEN k.price
                   ELSE ms.price
               END as price ,
            CASE
                  WHEN ms.trip_no = k.trip_no THEN k.price2
                   ELSE ms.price2
               END as price2,
            CASE
                  WHEN ms.trip_no = k.trip_no THEN k.price3
                   ELSE ms.price3
               END as price3,
            CASE
                  WHEN ms.trip_no = k.trip_no THEN k.price4
                   ELSE ms.price4
               END as price4,
            ms.trip_departure, ms.trip_arrival, ms.equipment, ms.estado
             From ( " . $sql . " )as ms LEFT JOIN ( " . $sql_net . " ) as k ON (ms.trip_no = k.trip_no)";
            $rs = Doo::db()->query($sql, array($from, $to, $fecha_salida, $from, $to, $fecha_salida));

        } else {
            $rs = Doo::db()->query($sql);
        }
        
          
        $salida = $rs->fetchAll();
          
        
         
        $row_array = array();
        
//        echo '<pre>';
//         print_r($row_array);
//        echo '</pre>';
        
        $resul_array = array();
        $lista_trip = array();
        /////////////////////////////////////////////////////Igualar Ofertas
        if (!empty($ofertas)) {
            foreach ($ofertas as $key1 => $value1) {
                foreach ($salida as $key2 => $value) {
                    list($mes, $dia, $anyo) = explode("-", $value["fecha"]);
                    $fechaarray = array();
                    $fechaarray = $anyo . "-" . $mes . "-" . $dia;

                    if (($value["trip_no"] == $value1["trip_no"]) && strtotime($fechaarray) >= $value1["fecha_ini"] && strtotime($fechaarray) <= $value1["fecha_fin"]) {

                        $value = array(
                            "trip_no" => $value1["trip_no"],
                            "trip_departure" => $value["trip_departure"],
                            "trip_arrival" => $value["trip_arrival"],
                            "price" => $value1["price"],
                            "id" => $value["id"],
                            "price2" => $value1["price2"],
                            "price3" => $value1["price3"],
                            "price4" => $value1["price4"],
                            "equipment" => $value["equipment"],
                            "oferta" => "1"
                        );
                        $row_array[$key2] = $value;
                        $lista_trip[$key2] = $value1["trip_no"];
                    } else if (($value1["trip_no"] == '') && strtotime($fechaarray) >= $value1["fecha_ini"] && strtotime($fechaarray) <= $value1["fecha_fin"]) {

                        $value = array(
                            "trip_no" => $value["trip_no"],
                            "trip_departure" => $value["trip_departure"],
                            "trip_arrival" => $value["trip_arrival"],
                            "price" => $value1["price"],
                            "id" => $value["id"],
                            "price2" => $value1["price2"],
                            "price3" => $value1["price3"],
                            "price4" => $value1["price4"],
                            "equipment" => $value["equipment"],
                            "oferta" => "1"
                        );
                        $row_array[$key2] = $value;
                        $lista_trip[$key2] = $value1["trip_no"];
                    } else {
                        $sino = true;
                        foreach ($ofertas as $valu_n_trip) {
                            if ($valu_n_trip["trip_no"] == $value["trip_no"]) {
                                $sino = false;
                                break;
                            }
                        }
                        if ($sino == true) {
                            $row_array[$key2] = $value;
                        }
                    }
                }
            }
        } else {
            foreach ($salida as $key => $value) {
                $row_array[$key] = $value;
            }
        }


        ///////////////////////////////////////////////////// */ Cierre de Igualar Ofertas */
        $rs = Doo::db()->find("Areas", array("select" => "nombre",
            "where" => "id = ?",
            "param" => array($from),
            "limit" => 1));
        $from_name = $rs->nombre;
        $retorno = array();
        
        list($dia2, $mes2, $anno2) = explode("-", $fecha_retorno);
        $retorno_fecha = $anno2 . "-" . $mes2 . "-" . $dia2;
        
        list($mes3, $dia3, $anno3) = explode("-", $fecha_retorno);
        $retorno_fecha2 = $mes3 . "-" . $dia3 . "-" . $anno3;
        
        
        if ($tipo_ticket == "roundtrip") {
            $sql2 = "SELECT distinct t2.trip_no,t2.id,t2.fecha_ini,t4.nombre AS trip_from,t5.nombre AS trip_to,t2.spprc_adult,t2.spprc_child,
                          t2.sdprc_adult,t2.sdprc_child,t2.sflexprc_adult,t2.sflexprc_child,t2.seats_remain,t2.univext,t2.wdext,
                          t2.f1t3,t2.f1t4,t2.f1t5,t2.f1t6,t2.f1t7,t2.f1t8,t2.f1t9,t2.f1t10,t2.f1t19,t2.f1t11,t2.f1t12,t2.f1t13,t2.f1t14,
                          t2.f2t3,t2.f2t4,t2.f2t5,t2.f2t6,t2.f2t7,t2.f2t8,t2.f2t9,t2.f2t10,t2.f2t19,t2.f2t11,t2.f2t12, t2.f2t13,t2.f2t14,
                          t2.f3t4,t2.f3t5,t2.f3t6,t2.f3t7,t2.f3t8,t2.f3t9,t2.f3t10,t2.f3t19,t2.f3t11,t2.f3t12,t2.f3t13,t2.f3t14,t2.f4t5,t2.f4t6,t2.f4t7,
                          t2.f4t8,t2.f4t9,t2.f4t10,t2.f4t19,t2.f4t11,t2.f4t12,t2.f4t13,t2.f4t14,t2.f5t6,t2.f5t7,t2.f5t8,t2.f5t9,t2.f5t10,
                          t2.f5t19,t2.f5t11,t2.f5t12,t2.f5t13,t2.f5t14,t2.flresprc_adult,t2.flresprc_child,t2.wfprc_adult,t2.wfprc_child,
                          t2.trip_departure,t2.trip_arrival,t3.equipment,t1.estado,t2.capacity
                          FROM
                          programacion t1
                          left join routes t2
                            on (t1.trip_no = t2.trip_no)
                          left join trips t3
                            on (t1.trip_no = t3.trip_no)
                          left join areas t4
                            on (t2.trip_from = t4.id)
                          left join areas t5
                            on (t2.trip_to = t5.id)
                          where t2.type_rate = '0'
                          AND t2.trip_from = '$to'
                          AND t2.trip_to = '$from'
                          and t2.fecha_ini = '$retorno_fecha'
                          AND t2.anno = '$anno'
                        ORDER BY t2.trip_departure ASC";

            /*             * *********************************** */
            if ($net_rate) {
                $sql_net1 = "select
                                t1.trip_no,
                                t2.id,
                                t1.fecha,
                                t4.nombre as trip_from,
                                t5.nombre as trip_to,
                                t2.price,
                                t2.price2,
                                t2.price3,
                                t2.price4,
                                t2.trip_departure,
                                t2.trip_arrival,
                                t3.equipment,
                                t1.estado,
              t2.capacity
			from programacion t1
                        left join routes_net t2 on (t1.trip_no = t2.trip_no)
                        left join trips  t3 on (t1.trip_no = t3.trip_no)
                        left join areas  t4 on (t2.trip_from = t4.id)
                        left join areas  t5 on  (t2.trip_to  = t5.id)
		        where t2.type_rate = 2 and t2.id_agency = '$dat->id' AND t2.trip_from = ? AND t2.trip_to = ? and fecha = ?  AND t2.trip_departure > '$hora2' and t1.estado = '1' AND t2.anno='$anyo' ORDER BY t2.trip_departure ASC ";


                $sql2 = "Select
                ms.trip_no, ms.id, ms.fecha, ms.trip_from, ms.trip_to,

                CASE
                      WHEN ms.trip_no = k.trip_no THEN k.price
                       ELSE ms.price
                   END as price ,
                CASE
                      WHEN ms.trip_no = k.trip_no THEN k.price2
                       ELSE ms.price2
                   END as price2,
                CASE
                      WHEN ms.trip_no = k.trip_no THEN k.price3
                       ELSE ms.price3
                   END as price3,
                CASE
                      WHEN ms.trip_no = k.trip_no THEN k.price4
                       ELSE ms.price4
                   END as price4,
                ms.trip_departure, ms.trip_arrival, ms.equipment, ms.estado
                 From ( " . $sql2 . " )as ms  LEft JOIN ( " . $sql_net1 . " ) as k ON (ms.trip_no = k.trip_no)";
                $rs = Doo::db()->query($sql2, array($to, $from, $fecha_retorno, $to, $from, $fecha_retorno));
            } else {
              
                $rs = Doo::db()->query($sql2);
            }

            $retorno = $rs->fetchAll();
            $rs = Doo::db()->find("Areas", array("select" => "nombre",
                "where" => "id = ?",
                "param" => array($to),
                "limit" => 1));
            $to_name = $rs->nombre;
        }

        


        if ($tipo_ticket == "oneway") {
            if ($net_rate) {
                $rs = Doo::db()->query($sql, array($to, $from, $fecha_retorno, $to, $from, $fecha_retorno));
            } else {
                $rs = Doo::db()->query($sql, array($to, $from, $fecha_retorno));
            }
            $retorno = $rs->fetchAll();
            $rs = Doo::db()->find("Areas", array("select" => "nombre",
                "where" => "id = ?",
                "param" => array($to),
                "limit" => 1));
            $to_name = $rs->nombre;
        }
        $row_array2 = array();
        $lista_trip = array();
        $contador = 0;
        if (!empty($ofertas2)) {
            foreach ($ofertas2 as $key2 => $value1) {
                foreach ($retorno as $key => $value) {
                    list($mes, $dia, $anyo) = explode("-", $value["fecha"]);
                    $fechaarray2 = array();
                    $fechaarray2 = $anyo . "-" . $mes . "-" . $dia;
                    if (($value["trip_no"] == $value1["trip_no"]) && strtotime($fechaarray2) >= $value1["fecha_ini"] && strtotime($fechaarray2) <= $value1["fecha_fin"]) {
//                        echo $value["trip_no"]." - ". $value1["trip_no"]."<br>";
                        $value = array(
                            "trip_no" => $value["trip_no"],
                            "trip_departure" => $value["trip_departure"],
                            "trip_arrival" => $value["trip_arrival"],
                            "price" => $value1["price"],
                            "id" => $value["id"],
                            "price2" => $value1["price2"],
                            "price3" => $value1["price3"],
                            "price4" => $value1["price4"],
                            "equipment" => $value["equipment"],
                            "oferta" => "1"
                        );
                        $row_array2[$key] = $value;
                        $lista_trip[$contador++] = $value1["trip_no"];
                    } else if (($value1["trip_no"] == "") && strtotime($fechaarray2) >= $value1["fecha_ini"] && strtotime($fechaarray2) <= $value1["fecha_fin"]) {

                        $value = array(
                            "trip_no" => $value["trip_no"],
                            "trip_departure" => $value["trip_departure"],
                            "trip_arrival" => $value["trip_arrival"],
                            "price" => $value1["price"],
                            "id" => $value["id"],
                            "price2" => $value1["price2"],
                            "price3" => $value1["price3"],
                            "price4" => $value1["price4"],
                            "equipment" => $value["equipment"],
                            "oferta" => "1"
                        );
                        $row_array2[$key] = $value;
                        $lista_trip[$contador++] = $value1["trip_no"];
                    } else {
                        $sino = true;
                        foreach ($ofertas2 as $valu_n_trip) {
                            if ($valu_n_trip["trip_no"] == $value["trip_no"]) {
                                $sino = false;
                                break;
                            }
                        }
                        if ($sino == true) {
                            $row_array2[$key] = $value;
                        }
                    }
                }
            }
        } else {

            foreach ($retorno as $key => $value) {

                $row_array2[$key] = $value;
            }
        }
        //Cierre de Igualar Ofertas2
        $booking = array(
            "jojo" => "jojojo",
            "tipo_ticket" => $tipo_ticket,
            "fromt" => $from,
            "tot" => $to,
            "fecha_salida" => $fecha_salida,
            "fecha_retorno" => $fecha_retorno,
            "pax" => $pax,
            "chil" => $chil,
            "resident" => $resident,
            "zip" => $zip,
            "iden" => $booking['iden'],
            "dateT" => $booking["dateT"],
            "dateT1" => $booking["dateT1"],
            "dateT2" => $booking["dateT2"],
            //'trip1' => $booking["trip1"],
            //'trip2' => $booking["trip2"],
            //'idPrecioIda' => $booking["idPrecioIda"],
            //'idPrecioVuelta' => $booking["idPrecioVuelta"]
        );

        // Disponibilidad
        list($mes, $dia, $anyo) = explode("-", $fecha_salida);
        $salida = $anyo . "-" . $mes . "-" . $dia;
        if ($fecha_retorno != "" && $fecha_retorno != "N/A") {
            list($mes2, $dia2, $anyo2) = explode("-", $fecha_retorno);
            $retorno = $anyo2 . "-" . $mes2 . "-" . $dia2;
        }
        //IDA
        $i = 0;
        $aux = array();
        foreach ($row_array as $key => $value1) {
            $disponible = $this->disponible($value1['trip_no'], $salida);
            if ($disponible > 0) {
                $value1["disponible"] = $disponible;
                $aux[$i] = $value1;
            }
            $i++;
        }
        $row_array = $aux;
        /* echo '<pre>';
          print_r($_SESSION['booking']);
          echo '</pre>'; */
        //RETORNO
        $i = 0;
        $aux = array();
        foreach ($row_array2 as $key => $value1) {
            $disponible = $this->disponible($value1['trip_no'], $retorno);
            //exit();
            if ($disponible > 0) {
                $value1["disponible"] = $disponible;
                $aux[$i] = $value1;
            }
            $i++;
        }
        //$row_array = $row_array2;
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['salida'] = $row_array;
        $this->data['retorno'] = $row_array2;
        $this->data['from_name'] = $from_name;
        $this->data['to_name'] = $to_name;
        
        $_SESSION["booking"] = $booking;
        $this->data['areas'] = Doo::db()->find("Areas", array("select" => "id, nombre", "asArray" => true));
        
        $this->renderc('booking', $this->data, true);

    }
    

    public function bookingMobil() {
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $booking = $_SESSION['booking'];

        $resident = $_POST['pregun'];
        $zipcode = $_POST['zip1'];
        $tipo_ticket = $booking['tipo_ticket'];
        $from = $booking['fromt'];
        $to = $booking['tot'];
        $fecha_salida = $booking['fecha_salida'];
        $fecha_retorno = $booking['fecha_retorno'];
        $adult = $booking['adult'];
        $child = $booking['child'];
        $dateT = $booking["dateT"];
        $dateT1 = $booking["dateT1"];
        $dateT2 = $booking["dateT2"];

        $datos = array(
            "tipo_ticket" => $tipo_ticket,
            "fromt" => $from,
            "tot" => $to,
            "fecha_salida" => $fecha_salida,
            "fecha_retorno" => $fecha_retorno,
            "adult" => $adult,
            "child" => $child,
            "residente" => $resident,
            "zipCode" => ($resident = 0 ? 'Not Resident' : $zipcode)
        );
        //fecha ida
        list($mes, $dia, $anio) = explode('-', $fecha_salida);
        $fecha1 = $anio . '-' . $mes . '-' . $dia;
        list($mes3, $dia3, $anio3) = explode('-', $fecha_salida);
        $fechax = $mes3 . '-' . $dia3 . '-' . $anio3;
        

        //fecha venida
        list($mes1, $dia1, $anio1) = explode('-', $fecha_retorno);
        $fecha2 = $anio1 . '-' . $mes1 . '-' . $dia1;
        list($mes4, $dia4, $anio4) = explode('-', $fecha_retorno);
        $fechay = $anio4 . '-' . $mes4 . '-' . $dia4;
        /* BOOKING MOBILE PARA EL VIAJE DE IDA */
        $sql_ida = "SELECT t1.trip_no,
              t2.id,
              t1.fecha,
              t2.fecha_ini,
              t4.nombre AS trip_from,
              t5.nombre AS trip_to,
              t2.spprc_adult,
              t2.spprc_child,
              t2.sdprc_adult,
              t2.sdprc_child,
              t2.sflexprc_adult,
              t2.sflexprc_child,
              t2.seats_remain,
              t2.univext,
              t2.wdext,
              t2.f1t3,
              t2.f1t4,
              t2.f1t5,
              t2.f1t6,
              t2.f1t7,
              t2.f1t8,
              t2.f1t9,
              t2.f1t10,
              t2.f1t19,
              t2.f1t11,
              t2.f1t12,
              t2.f1t13,
              t2.f1t14,
              t2.f2t3,
              t2.f2t4,
              t2.f2t5,
              t2.f2t6,
              t2.f2t7,
              t2.f2t8,
              t2.f2t9,
              t2.f2t10,
              t2.f2t19,
              t2.f2t11,
              t2.f2t12,
              t2.f2t13,
              t2.f2t14,
              t2.f3t4,
              t2.f3t5,
              t2.f3t6,
              t2.f3t7,
              t2.f3t8,
              t2.f3t9,
              t2.f3t10,
              t2.f3t19,
              t2.f3t11,
              t2.f3t12,
              t2.f3t13,
              t2.f3t14,
              t2.f4t5,
              t2.f4t6,
              t2.f4t7,
              t2.f4t8,
              t2.f4t9,
              t2.f4t10,
              t2.f4t19,
              t2.f4t11,
              t2.f4t12,
              t2.f4t13,
              t2.f4t14,
              t2.f5t6,
              t2.f5t7,
              t2.f5t8,
              t2.f5t9,
              t2.f5t10,
              t2.f5t19,
              t2.f5t11,
              t2.f5t12,
              t2.f5t13,
              t2.f5t14,
              t2.flresprc_adult,
              t2.flresprc_child,
              t2.wfprc_adult,
              t2.wfprc_child,
              t2.trip_departure,
              t2.trip_arrival,
              t3.equipment,
              t1.estado,
              t2.capacity
            FROM
              programacion t1
              LEFT JOIN routes t2
                ON (t1.trip_no = t2.trip_no)
              LEFT JOIN trips t3
                ON (t1.trip_no = t3.trip_no)
              LEFT JOIN areas t4
                ON (t2.trip_from = t4.id)
              LEFT JOIN areas t5
                ON (t2.trip_to = t5.id)
            WHERE t2.type_rate = '0'
              AND t2.trip_from = '" . $from . "'
              AND t2.trip_to = '" . $to . "'
              AND t1.fecha = '" . $fechax . "'
              AND t2.fecha_ini = '" . $fecha1 . "'
              AND t1.estado = '1'
              AND t2.anno = '" . date('Y') . "'
            ORDER BY t2.trip_departure ASC";
        //echo $sql_ida;
        $rs_ida = Doo::db()->query($sql_ida);
        $tripIda = $rs_ida->fetchAll();

        if ($tipo_ticket == 'roundtrip') {
            $sql_venida = "SELECT t1.trip_no,
              t2.id,
              t1.fecha,
              t2.fecha_ini,
              t4.nombre AS trip_from,
              t5.nombre AS trip_to,
              t2.spprc_adult,
              t2.spprc_child,
              t2.sdprc_adult,
              t2.sdprc_child,
              t2.sflexprc_adult,
              t2.sflexprc_child,
              t2.seats_remain,
              t2.univext,
              t2.wdext,
              t2.f1t3,
              t2.f1t4,
              t2.f1t5,
              t2.f1t6,
              t2.f1t7,
              t2.f1t8,
              t2.f1t9,
              t2.f1t10,
              t2.f1t19,
              t2.f1t11,
              t2.f1t12,
              t2.f1t13,
              t2.f1t14,
              t2.f2t3,
              t2.f2t4,
              t2.f2t5,
              t2.f2t6,
              t2.f2t7,
              t2.f2t8,
              t2.f2t9,
              t2.f2t10,
              t2.f2t19,
              t2.f2t11,
              t2.f2t12,
              t2.f2t13,
              t2.f2t14,
              t2.f3t4,
              t2.f3t5,
              t2.f3t6,
              t2.f3t7,
              t2.f3t8,
              t2.f3t9,
              t2.f3t10,
              t2.f3t19,
              t2.f3t11,
              t2.f3t12,
              t2.f3t13,
              t2.f3t14,
              t2.f4t5,
              t2.f4t6,
              t2.f4t7,
              t2.f4t8,
              t2.f4t9,
              t2.f4t10,
              t2.f4t19,
              t2.f4t11,
              t2.f4t12,
              t2.f4t13,
              t2.f4t14,
              t2.f5t6,
              t2.f5t7,
              t2.f5t8,
              t2.f5t9,
              t2.f5t10,
              t2.f5t19,
              t2.f5t11,
              t2.f5t12,
              t2.f5t13,
              t2.f5t14,
              t2.flresprc_adult,
              t2.flresprc_child,
              t2.wfprc_adult,
              t2.wfprc_child,
              t2.trip_departure,
              t2.trip_arrival,
              t3.equipment,
              t1.estado,
              t2.capacity
            FROM
              programacion t1
              LEFT JOIN routes t2
                ON (t1.trip_no = t2.trip_no)
              LEFT JOIN trips t3
                ON (t1.trip_no = t3.trip_no)
              LEFT JOIN areas t4
                ON (t2.trip_from = t4.id)
              LEFT JOIN areas t5
                ON (t2.trip_to = t5.id)
            WHERE t2.type_rate = '0'
              AND t2.trip_from = '" . $to . "'
              AND t2.trip_to = '" . $from . "'
              AND t1.fecha = '" . $fechay . "'
              AND t2.fecha_ini = '" . $fecha2 . "'
              AND t1.estado = '1'
              AND t2.anno = '" . date('Y') . "'
            ORDER BY t2.trip_departure ASC";
            //echo $sql_ida;
            $rs_venida = Doo::db()->query($sql_venida);
            $tripVenida = $rs_venida->fetchAll();
            $this->data['tripVenida'] = $tripVenida;
        } else {
            $this->data['tripVenida'] = null;
        }

        $this->data['tripIda'] = $tripIda;
        $this->renderc('bookingMobile', $this->data, true);
    }

    public function calcularPrecio() {
        $adult = $this->params['adult'];
        $child = $this->params['child'];

        $totalAdult = ($adult * $_SESSION['booking']['adult']);
        $totalChild = ($child * $_SESSION['booking']['child']);
        $totalperpasenger = ($totalAdult + $totalChild);
        echo number_format($totalperpasenger, 2, '.', ',');
    }

    public function quitarPax() {
        $booking = $_SESSION['booking'];
        $update = "DELETE FROM reservas_trip_puestos WHERE estado = 'USING' AND usuario = '" . $booking['iden'] . "'";
        Doo::db()->query($update);
    }

    public function editarPax() {
        $booking = $_SESSION['booking'];
        $update = "UPDATE reservas_trip_puestos SET estado = 'USING' WHERE usuario = '" . $booking['iden'] . "'";
        Doo::db()->query($update);
    }
    public function cargarPax() {
      list($mes, $dia, $anio) = explode('-', $_SESSION['booking']['fecha_salida']);
      $fecha_trip = $anio . '-' . $mes . '-' . $dia;
      $trip = $this->params['trip_no'];
      //print_r($_SESSION['booking']['fecha_salida']);
      //echo $fecha_trip;
//      print($trip);
//      die;
      
//         echo '<pre>';
//         print_r($_SESSION['booking']['fecha_retorno']);
//         print($trip);
//         die;
//         echo '</pre>';
//         die;
        if ($this->params['promo'] == 'wFareIda' || $this->params['promo'] == 'sPromoIda' || $this->params['promo'] == 'sDiscIda' || $this->params['promo'] == 'sDiscIda' || $this->params['promo'] == 'sFlexIda') {

        if ($this->params['promo'] == 'wFareIda') {
           $idpromo = 3;
        }elseif ($this->params['promo'] == 'sPromoIda') {
            $idpromo = 4;
        }elseif ($this->params['promo'] == 'sDiscIda') {
           $idpromo = 5;
        }elseif ($this->params['promo'] == 'sFlexIda') {
           $idpromo = 2;
        }
        $_SESSION['promoida'] = $this->params['promo'];
//         print_r($_SESSION);
//         die;
        $sql = "SELECT
        SUM(cantidad) AS cantwebf,
            (SELECT SUM(cantidad) FROM reservas_trip_puestos
        WHERE fecha_trip = ?
        AND trip_to = ?
        AND (tipo = '1' OR tipo = '2')
        AND ( estado = 'USING' OR estado = 'RENEWED' ) AND tarifa = 4
        ) as cantsuperp,
        (SELECT SUM(cantidad) FROM reservas_trip_puestos
        WHERE fecha_trip = ?
        AND trip_to = ?
        AND (tipo = '1' OR tipo = '2')
        AND ( estado = 'USING' OR estado = 'RENEWED' ) AND tarifa = 5
        ) as cantsuperdisc,
        (SELECT SUM(cantidad) FROM reservas_trip_puestos
        WHERE fecha_trip = ?
        AND trip_to = ?
        AND (tipo = '1' OR tipo = '2')
        AND ( estado = 'USING' OR estado = 'RENEWED' ) AND tarifa = 2
        ) as cantsuperflex,
        (SELECT SUM(cantidad) FROM reservas_trip_puestos
        WHERE fecha_trip = ?
        AND trip_to = ?
        AND (tipo = '1' OR tipo = '2')
        AND ( estado = 'USING' OR estado = 'RENEWED' ) AND tarifa = 1
        ) as cantstandar
        FROM reservas_trip_puestos WHERE fecha_trip = ?
        AND trip_to = ?
        AND (tipo = '1' OR tipo = '2')
        AND ( estado = 'USING' OR estado = 'RENEWED' ) AND tarifa = 3 ";
        $rs = Doo::db()->query($sql, array($fecha_trip,$trip,$fecha_trip,$trip,$fecha_trip,$trip,$fecha_trip,$trip,$fecha_trip,$trip));
        $puestos = $rs->fetchAll(PDO::FETCH_ASSOC);
        // $p_ocupadoswf = $puestos[0]['CANTIDAD'];

        $cantidadwebf = $puestos[0]['cantwebf'] ? $puestos[0]['cantwebf'] : 0;
        $cantidadsuperpro = $puestos[0]['cantsuperp'] ? $puestos[0]['cantsuperp'] : 0;
        $cantidadsuperdisc = $puestos[0]['cantsuperdisc'] ? $puestos[0]['cantsuperdisc'] : 0;
        $cantidadsuperflex = $puestos[0]['cantsuperflex'] ? $puestos[0]['cantsuperflex'] : 0;
        $cantidadsstandar = $puestos[0]['cantstandar'] ? $puestos[0]['cantstandar'] : 0;

        // print_r($cantidadsuperdisc);
      $sql2 = "SELECT DISTINCT spseats,sdseats,wfseats,sflexseats,stseats,spprcseats,toursseats,vehicles,capacity,capacity2,capacity3,capacity4,capacity5,seats_remain FROM routes WHERE fecha_ini = ? AND trip_no = ?";
        $rs2 = Doo::db()->query($sql2, array($fecha_trip,$trip));
        $routes = $rs2->fetchAll(PDO::FETCH_ASSOC);
        //print_r($routes);
        $seats = $routes[0]['seats_remain'];

        $capacidad100_1 = $routes[0]['capacity'];
        $capacidad100_2 = $routes[0]['capacity2'];
        $capacidad100_3 = $routes[0]['capacity3'];
        $capacidad100_4 = $routes[0]['capacity4'];
        $capacidad100_5 = $routes[0]['capacity5'];

        $webfare_100 = $routes[0]['wfseats'];
        $superpromo_100 = $routes[0]['spseats'];
        $superdiscount_100 = $routes[0]['sdseats'];
        $superflex_100 = $routes[0]['sflexseats'];
        $standard_100 = $routes[0]['sflexseats'];
        $sppr_100 = $routes[0]['spprcseats'];
        $tour_100 = $routes[0]['toursseats'];

        $sql_spcida100 = "SELECT
        (sum(pax) + sum(pax2)) AS superpromo,
      (SELECT (sum(pax) + sum(pax2)) FROM reservas WHERE trip_no = ? AND fecha_salida = ?
      AND estado != 'QUOTE'
      AND estado != 'CANCELED'
      AND estado != 'NOT SHOW W/ CHARGE'
      AND estado != 'NOT SHOW W/O CHARGE'
      AND estado != 'NO SHOW'
      AND id1 = '5') as superdiscount,
      (SELECT (sum(pax) + sum(pax2)) FROM reservas WHERE trip_no = ? AND fecha_salida = ?
      AND estado != 'QUOTE'
      AND estado != 'CANCELED'
      AND estado != 'NOT SHOW W/ CHARGE'
      AND estado != 'NOT SHOW W/O CHARGE'
      AND estado != 'NO SHOW'
      AND id1 = '3') as webfare,
      (SELECT (sum(pax) + sum(pax2)) FROM reservas WHERE trip_no = ? AND fecha_salida = ?
      AND estado != 'QUOTE'
      AND estado != 'CANCELED'
      AND estado != 'NOT SHOW W/ CHARGE'
      AND estado != 'NOT SHOW W/O CHARGE'
      AND estado != 'NO SHOW'
      AND id1 = '1') as standard,
      (SELECT (sum(pax) + sum(pax2)) FROM reservas  WHERE trip_no = ? AND fecha_salida = ?
      AND estado != 'QUOTE'
      AND estado != 'CANCELED'
      AND estado != 'NOT SHOW W/ CHARGE'
      AND estado != 'NOT SHOW W/O CHARGE'
      AND estado != 'NO SHOW'
      AND id1 = '2') as superflex,
      (SELECT (sum(pax) + sum(pax2)) FROM  reservas Where trip_no = ? AND fecha_salida = ?
      AND (type_tour = 'ONE'
      OR type_tour = 'MULTI')
      AND estado != 'QUOTE'
      AND estado != 'CANCELED'
      AND estado != 'NOT SHOW W/ CHARGE'
      AND estado != 'NOT SHOW W/O CHARGE') AS tours,
      (SELECT (sum(pax) + sum(pax2)) FROM  reservas Where trip_no = ?  AND fecha_salida = ?
      AND id1 = '6'
      AND estado != 'QUOTE'
      AND estado != 'CANCELED'
      AND estado != 'NOT SHOW W/ CHARGE'
      AND estado != 'NOT SHOW W/O CHARGE') AS especial

      FROM reservas  WHERE trip_no = ? AND fecha_salida = ?
      AND estado != 'QUOTE'
      AND estado != 'CANCELED'
      AND estado != 'NOT SHOW W/ CHARGE'
      AND estado != 'NOT SHOW W/O CHARGE'
      AND estado != 'NO SHOW'
      AND id1 = '4'";
        $trips100 = Doo::db()->query($sql_spcida100, array($trip,$fecha_trip,$trip,$fecha_trip,$trip,$fecha_trip,$trip,$fecha_trip,$trip,$fecha_trip,$trip,$fecha_trip,$trip,$fecha_trip));
        $r_spcida100 = $trips100->fetchAll();
        // $seats_ida100 = $r_spcida100[0]['superdiscount'];
        $spro_ida100 = $r_spcida100[0]['superpromo'] ? $r_spcida100[0]['superpromo'] : 0;
        $sdic_ida100 = $r_spcida100[0]['superdiscount'] ? $r_spcida100[0]['superdiscount'] : 0;
        $wfare_ida100 = $r_spcida100[0]['webfare'] ? $r_spcida100[0]['webfare'] : 0;
        $standr_ida100 = $r_spcida100[0]['standard'] ? $r_spcida100[0]['standard'] : 0;
        $sflex_ida100 = $r_spcida100[0]['superflex'] ? $r_spcida100[0]['superflex'] : 0;
        $special_ida100 = $r_spcida100[0]['especial'] ? $r_spcida100[0]['especial'] : 0;
        $tour_ida100 = $r_spcida100[0]['tours'] ? $r_spcida100[0]['tours'] : 0;

        $sql_spcretorno100 = "SELECT (sum(pax_r) + sum(pax2_r)) AS superpromo,
      (SELECT (sum(pax_r) + sum(pax2_r)) FROM  reservas WHERE trip_no2 = ? AND fecha_retorno = ?
      AND estado != 'QUOTE'
      AND estado != 'CANCELED'
      AND estado != 'NOT SHOW W/ CHARGE'
      AND estado != 'NOT SHOW W/O CHARGE'
      AND estado != 'NO SHOW'
      AND id2 = '5') as superdiscount,
      (SELECT (sum(pax_r) + sum(pax2_r)) FROM reservas WHERE trip_no2 = ? AND fecha_retorno = ?
      AND estado != 'QUOTE'
      AND estado != 'CANCELED'
      AND estado != 'NOT SHOW W/ CHARGE'
      AND estado != 'NOT SHOW W/O CHARGE'
      AND estado != 'NO SHOW'
      AND id2 = '3') as webfare,
      (SELECT (sum(pax_r) + sum(pax2_r)) FROM reservas WHERE trip_no2 = ? AND fecha_retorno = ?
      AND estado != 'QUOTE'
      AND estado != 'CANCELED'
      AND estado != 'NOT SHOW W/ CHARGE'
      AND estado != 'NOT SHOW W/O CHARGE'
      AND estado != 'NO SHOW'
      AND id2 = '1') as standard,
      (SELECT (sum(pax_r) + sum(pax2_r)) FROM reservas WHERE trip_no2 = ? AND fecha_retorno = ?
      AND estado != 'QUOTE'
      AND estado != 'CANCELED'
      AND estado != 'NOT SHOW W/ CHARGE'
      AND estado != 'NOT SHOW W/O CHARGE'
      AND estado != 'NO SHOW'
      AND id2 = '2') as superflex,
      (SELECT (sum(pax_r) + sum(pax2_r)) FROM  reservas  Where trip_no2 = ? AND fecha_retorno = ?
      AND (type_tour = 'ONE'
      OR type_tour = 'MULTI')
      AND estado != 'QUOTE'
      AND estado != 'CANCELED'
      AND estado != 'NOT SHOW W/ CHARGE'
      AND estado != 'NOT SHOW W/O CHARGE') AS tours,
      (SELECT (sum(pax_r) + sum(pax2_r)) FROM  reservas Where trip_no2 = ? AND fecha_retorno = ?
      AND id2 = '6'
      AND estado != 'QUOTE'
      AND estado != 'CANCELED'
      AND estado != 'NOT SHOW W/ CHARGE'
      AND estado != 'NOT SHOW W/O CHARGE') AS especial
      FROM reservas WHERE trip_no2 = ? AND fecha_retorno = ?
      AND estado != 'QUOTE'
      AND estado != 'CANCELED'
      AND estado != 'NOT SHOW W/ CHARGE'
      AND estado != 'NOT SHOW W/O CHARGE'
      AND estado != 'NO SHOW'
      AND id2 = '4'";
        // $rs_spcretorno100 = Doo::db()->query($sql_spcretorno100, array($trip100, $fecha));
        $rs_spcretorno100 = Doo::db()->query($sql_spcretorno100, array($trip,$fecha_trip,$trip,$fecha_trip,$trip,$fecha_trip,$trip,$fecha_trip,$trip,$fecha_trip,$trip,$fecha_trip,$trip,$fecha_trip));
        $r_spcretorno100 = $rs_spcretorno100->fetchAll();

        $spro_retorno100 = $r_spcretorno100[0]['superpromo'] ? $r_spcretorno100[0]['superpromo'] : 0;
        $sdic_retorno100 = $r_spcretorno100[0]['superdiscount'] ? $r_spcretorno100[0]['superdiscount'] : 0;
        $wfare_retorno100 = $r_spcretorno100[0]['webfare'] ? $r_spcretorno100[0]['webfare'] : 0;
        $standr_retorno100 = $r_spcretorno100[0]['standard'] ? $r_spcretorno100[0]['standard'] : 0;
        $sflex_retorno100 = $r_spcretorno100[0]['superflex'] ? $r_spcretorno100[0]['superflex'] : 0;
        $special_retorno100 = $r_spcretorno100[0]['especial'] ? $r_spcretorno100[0]['especial'] : 0;
        $tour_retorno100 = $r_spcretorno100[0]['tours'] ? $r_spcretorno100[0]['tours'] : 0;


        $total_spro100 = $spro_ida100 + $spro_retorno100 ;
        $total_sdic100 = $sdic_ida100 + $sdic_retorno100 ;
        $total_wfare100 = $wfare_ida100 + $wfare_retorno100 ;
        $total_standr100 = $standr_ida100 + $standr_retorno100 ;
        $total_sflex100 = $sflex_ida100 + $sflex_retorno100 ;
        $total_especial100 = $special_ida100 + $special_retorno100 ;
        $total_tours100 = $tour_ida100 + $tour_retorno100 ;

        $ReservasTotales = $total_spro100 + $total_sdic100 + $total_wfare100  + $total_standr100 + $total_sflex100 + $total_especial100 + $total_tours100;
        $resultsuperflex = $total_sflex100 - $superflex_100;

        $OcupadosTotales =  $ReservasTotales + $p_ocupados100;

        // $cantidadwebf = $puestos[0]['cantwebf'] ? $puestos[0]['cantwebf'] : 0;
        // $cantidadsuperpro = $puestos[0]['cantsuperp'] ? $puestos[0]['cantsuperp'] : 0;
        // $cantidadsuperdisc = $puestos[0]['cantsuperdisc'] ? $puestos[0]['cantsuperdisc'] : 0;
        // $cantidadsuperflex = $puestos[0]['cantsuperflex'] ? $puestos[0]['cantsuperflex'] : 0;

          $numperson100 = $_SESSION['booking']['pax'] + $_SESSION['booking']['chil'];
        //   $wf_totreturn = ($webfare_100return - $total_wfare100return)-$total_standr100return-$total_especial100return-$total_tours100return-$total_spro100return-$total_sdic100return-$numperson100return-$cantidadwebfreturn ;

        //   $sflx_totreturn = ($superflex_100return - $total_sflex100return)-$numperson100return-$cantidadsuperflexreturn;

        //   $spr_totreturn = ($superpromo_100return - $total_spro100return)-$numperson100return-$cantidadsuperproreturn;

        //   $sdc_totreturn = ($superdiscount_100return - $total_sdic100return)-$numperson100return-$cantidadsuperdiscreturn;

        //   if($wf_tot < $spr_totreturn){
        //       $spr_totreturn = $wf_totreturn;
        //     }else{
        //       $spr_totreturn = ($spr_totreturn);
        //     }

        //     if($wf_totreturn < $sdc_totreturn){
        //       $sdc_totreturn = $wf_totreturn;
        //     }else{
        //       $sdc_totreturn = ($sdc_totreturn);
        //     }

        // $cantidadwebf = $puestos[0]['cantwebf'] ? $puestos[0]['cantwebf'] : 0;
        // $cantidadsuperpro = $puestos[0]['cantsuperp'] ? $puestos[0]['cantsuperp'] : 0;
        // $cantidadsuperdisc = $puestos[0]['cantsuperdisc'] ? $puestos[0]['cantsuperdisc'] : 0;
        // $cantidadsuperflex = $puestos[0]['cantsuperflex'] ? $puestos[0]['cantsuperflex'] : 0;

            $wf_tot = ($webfare_100 - $total_wfare100)-$total_standr100-$total_especial100-$total_tours100 -$total_spro100-$total_sdic100-$numperson100-$cantidadwebf - $cantidadsuperpro - $cantidadsuperdisc - $cantidadsstandar;

            $sflx_tot = ($superflex_100 - $total_sflex100)-$numperson100-$cantidadsuperflex;

            $spr_tot = ($superpromo_100 - $total_spro100)-$numperson100-$cantidadsuperpro;

            $sdc_tot = ($superdiscount_100 - $total_sdic100)-$numperson100-$cantidadsuperdisc;

            // $totoawfsinpas = $wf_tot + $numperson100;
            // $totoasflxsinpas = $sflx_tot +$numperson100;
            // $totoasprsinpas = $spr_tot +$numperson100;
            // $totoasdcsinpas = $sdc_tot +$numperson100;
            //  $totalsinpas = $totoawfsinpas + $totoasflxsinpas + $totoasprsinpas + $totoasdcsinpas;
            if($wf_tot <= $spr_tot){
                $spr_tot = $wf_tot;
              }else{
                $spr_tot = $spr_tot;
              }

              if($wf_tot <= $sdc_tot){
                $sdc_tot = $wf_tot;
              }else{
                $sdc_tot = $sdc_tot;
              }


              if ($this->params['promo'] == 'wFareIda') {
                $disp = $wf_tot ;
              }elseif ($this->params['promo'] == 'sPromoIda') {
                  $disp = $spr_tot;
              }elseif ($this->params['promo'] == 'sDiscIda') {
                  $disp = $sdc_tot;
              }elseif ($this->params['promo'] == 'sFlexIda') {
                $disp = $sflx_tot;

              }

              // echo '<pre>';
              // print_r($disp);
              // echo '</pre>';
              // die;

        if ($disp < 0){
         $this->naveganteT();
        //  $this->params['click'] = 1;
        echo "<no_cupos";
        die;
        }
  // }

        }else{ //RETORNO
          list($mes2, $dia2, $anio2) = explode('-', $_SESSION['booking']['fecha_retorno']);
          $fecha_returnn = $anio2 . '-' . $mes2 . '-' . $dia2;
          $trip_no = $this->params['trip_no'];
          if ($this->params['promo'] == 'wFareReturn') {
            $idpromo = 3;
         }elseif ($this->params['promo'] == 'sPromoReturn') {
             $idpromo = 4;
         }elseif ($this->params['promo'] == 'sDiscReturn') {
            $idpromo = 5;
         }elseif ($this->params['promo'] == 'sFlexReturn') {
            $idpromo = 2;
         }
         $_SESSION['promoretorno'] = $this->params['promo'];
        //  print_r($_SESSION);
         $sql = "SELECT
         SUM(cantidad) AS cantwebf,
             (SELECT SUM(cantidad) FROM reservas_trip_puestos
         WHERE fecha_trip = ?
         AND trip_to = ?
         AND (tipo = '1' OR tipo = '2')
         AND ( estado = 'USING' OR estado = 'RENEWED' ) AND tarifa = '4'
         ) as cantsuperp,
         (SELECT SUM(cantidad) FROM reservas_trip_puestos
         WHERE fecha_trip = ?
         AND trip_to = ?
         AND (tipo = '1' OR tipo = '2')
         AND ( estado = 'USING' OR estado = 'RENEWED' ) AND tarifa = '5'
         ) as cantsuperdisc,
         (SELECT SUM(cantidad) FROM reservas_trip_puestos
         WHERE fecha_trip = ?
         AND trip_to = ?
         AND (tipo = '1' OR tipo = '2')
         AND ( estado = 'USING' OR estado = 'RENEWED' ) AND tarifa = '2'
         ) as cantsuperflex,
        (SELECT SUM(cantidad) FROM reservas_trip_puestos
        WHERE fecha_trip = ?
        AND trip_to = ?
        AND (tipo = '1' OR tipo = '2')
        AND ( estado = 'USING' OR estado = 'RENEWED' ) AND tarifa = '1'
        ) as cantstandar
         FROM reservas_trip_puestos WHERE fecha_trip = ?
         AND trip_to = ?
         AND (tipo = '1' OR tipo = '2')
         AND ( estado = 'USING' OR estado = 'RENEWED' ) AND tarifa = '3' ";
         $rs = Doo::db()->query($sql, array($fecha_returnn,$trip_no,$fecha_returnn,$trip_no,$fecha_returnn,$trip_no,$fecha_returnn,$trip_no,$fecha_returnn,$trip_no));
         $puestos = $rs->fetchAll(PDO::FETCH_ASSOC);
         // $p_ocupadoswf = $puestos[0]['CANTIDAD'];

         $cantidadwebfreturn = $puestos[0]['cantwebf'] ? $puestos[0]['cantwebf'] : 0;
         $cantidadsuperproreturn = $puestos[0]['cantsuperp'] ? $puestos[0]['cantsuperp'] : 0;
         $cantidadsuperdiscreturn = $puestos[0]['cantsuperdisc'] ? $puestos[0]['cantsuperdisc'] : 0;
         $cantidadsuperflexreturn = $puestos[0]['cantsuperflex'] ? $puestos[0]['cantsuperflex'] : 0;
         $cantidadsstandarreturn = $puestos[0]['cantstandar'] ? $puestos[0]['cantstandar'] : 0;

         // print_r($cantidadsuperdisc);
       $sql2 = "SELECT DISTINCT spseats,sdseats,wfseats,sflexseats,stseats,spprcseats,toursseats,vehicles,capacity,capacity2,capacity3,capacity4,capacity5,seats_remain FROM routes WHERE fecha_ini = ? AND trip_no = ?";
         $rs2 = Doo::db()->query($sql2, array($fecha_returnn,$trip_no));
         $routesreturn = $rs2->fetchAll(PDO::FETCH_ASSOC);
         $seats = $routes[0]['seats_remain'];

         $capacidad100_1return = $routesreturn[0]['capacity'];
         $capacidad100_2return = $routesreturn[0]['capacity2'];
         $capacidad100_3return = $routesreturn[0]['capacity3'];
         $capacidad100_4return = $routesreturn[0]['capacity4'];
         $capacidad100_5return = $routesreturn[0]['capacity5'];

         $webfare_100return = $routesreturn[0]['wfseats'];
         $superpromo_100return = $routesreturn[0]['spseats'];
         $superdiscount_100return = $routesreturn[0]['sdseats'];
         $superflex_100return = $routesreturn[0]['sflexseats'];
         $standard_100return = $routesreturn[0]['sflexseats'];
         $sppr_100return = $routesreturn[0]['spprcseats'];
         $tour_100return = $routesreturn[0]['toursseats'];

         // echo '<pre>';
         // print_r($routesreturn);
         // echo '</pre>';

         $sql_spcida100 = "SELECT
         (sum(pax) + sum(pax2)) AS superpromo,
       (SELECT (sum(pax) + sum(pax2)) FROM reservas WHERE trip_no = ? AND fecha_salida = ?
       AND estado != 'QUOTE'
       AND estado != 'CANCELED'
       AND estado != 'NOT SHOW W/ CHARGE'
       AND estado != 'NOT SHOW W/O CHARGE'
       AND estado != 'NO SHOW'
       AND id1 = '5') as superdiscount,
       (SELECT (sum(pax) + sum(pax2)) FROM reservas WHERE trip_no = ? AND fecha_salida = ?
       AND estado != 'QUOTE'
       AND estado != 'CANCELED'
       AND estado != 'NOT SHOW W/ CHARGE'
       AND estado != 'NOT SHOW W/O CHARGE'
       AND estado != 'NO SHOW'
       AND id1 = '3') as webfare,
       (SELECT (sum(pax) + sum(pax2)) FROM reservas WHERE trip_no = ? AND fecha_salida = ?
       AND estado != 'QUOTE'
       AND estado != 'CANCELED'
       AND estado != 'NOT SHOW W/ CHARGE'
       AND estado != 'NOT SHOW W/O CHARGE'
       AND estado != 'NO SHOW'
       AND id1 = '1') as standard,
       (SELECT (sum(pax) + sum(pax2)) FROM reservas  WHERE trip_no = ? AND fecha_salida = ?
       AND estado != 'QUOTE'
       AND estado != 'CANCELED'
       AND estado != 'NOT SHOW W/ CHARGE'
       AND estado != 'NOT SHOW W/O CHARGE'
       AND estado != 'NO SHOW'
       AND id1 = '2') as superflex,
       (SELECT (sum(pax) + sum(pax2)) FROM  reservas Where trip_no = ? AND fecha_salida = ?
       AND (type_tour = 'ONE'
       OR type_tour = 'MULTI')
       AND estado != 'QUOTE'
       AND estado != 'CANCELED'
       AND estado != 'NOT SHOW W/ CHARGE'
       AND estado != 'NOT SHOW W/O CHARGE') AS tours,
       (SELECT (sum(pax) + sum(pax2)) FROM  reservas Where trip_no = ?  AND fecha_salida = ?
       AND id1 = '6'
       AND estado != 'QUOTE'
       AND estado != 'CANCELED'
       AND estado != 'NOT SHOW W/ CHARGE'
       AND estado != 'NOT SHOW W/O CHARGE') AS especial

       FROM reservas  WHERE trip_no = ? AND fecha_salida = ?
       AND estado != 'QUOTE'
       AND estado != 'CANCELED'
       AND estado != 'NOT SHOW W/ CHARGE'
       AND estado != 'NOT SHOW W/O CHARGE'
       AND estado != 'NO SHOW'
       AND id1 = '4'";
         $trips100return = Doo::db()->query($sql_spcida100, array($trip_no,$fecha_returnn,$trip_no,$fecha_returnn,$trip_no,$fecha_returnn,$trip_no,$fecha_returnn,$trip_no,$fecha_returnn,$trip_no,$fecha_returnn,$trip_no,$fecha_returnn));
         $r_spcida100return = $trips100return->fetchAll();
         // $seats_ida100 = $r_spcida100[0]['superdiscount'];
         $spro_ida100return = $r_spcida100return[0]['superpromo'] ? $r_spcida100return[0]['superpromo'] : 0;
         $sdic_ida100return = $r_spcida100return[0]['superdiscount'] ? $r_spcida100return[0]['superdiscount'] : 0;
         $wfare_ida100return = $r_spcida100return[0]['webfare'] ? $r_spcida100return[0]['webfare'] : 0;
         $standr_ida100return = $r_spcida100return[0]['standard'] ? $r_spcida100return[0]['standard'] : 0;
         $sflex_ida100return = $r_spcida100return[0]['superflex'] ? $r_spcida100return[0]['superflex'] : 0;
         $special_ida100return = $r_spcida100return[0]['especial'] ? $r_spcida100return[0]['especial'] : 0;
         $tour_ida100return = $r_spcida100return[0]['tours'] ? $r_spcida100return[0]['tours'] : 0;

         $sql_spcretorno100 = "SELECT (sum(pax_r) + sum(pax2_r)) AS superpromo,
       (SELECT (sum(pax_r) + sum(pax2_r)) FROM  reservas WHERE trip_no2 = ? AND fecha_retorno = ?
       AND estado != 'QUOTE'
       AND estado != 'CANCELED'
       AND estado != 'NOT SHOW W/ CHARGE'
       AND estado != 'NOT SHOW W/O CHARGE'
       AND estado != 'NO SHOW'
       AND id2 = '5') as superdiscount,
       (SELECT (sum(pax_r) + sum(pax2_r)) FROM reservas WHERE trip_no2 = ? AND fecha_retorno = ?
       AND estado != 'QUOTE'
       AND estado != 'CANCELED'
       AND estado != 'NOT SHOW W/ CHARGE'
       AND estado != 'NOT SHOW W/O CHARGE'
       AND estado != 'NO SHOW'
       AND id2 = '3') as webfare,
       (SELECT (sum(pax_r) + sum(pax2_r)) FROM reservas WHERE trip_no2 = ? AND fecha_retorno = ?
       AND estado != 'QUOTE'
       AND estado != 'CANCELED'
       AND estado != 'NOT SHOW W/ CHARGE'
       AND estado != 'NOT SHOW W/O CHARGE'
       AND estado != 'NO SHOW'
       AND id2 = '1') as standard,
       (SELECT (sum(pax_r) + sum(pax2_r)) FROM reservas WHERE trip_no2 = ? AND fecha_retorno = ?
       AND estado != 'QUOTE'
       AND estado != 'CANCELED'
       AND estado != 'NOT SHOW W/ CHARGE'
       AND estado != 'NOT SHOW W/O CHARGE'
       AND estado != 'NO SHOW'
       AND id2 = '2') as superflex,
       (SELECT (sum(pax_r) + sum(pax2_r)) FROM  reservas  Where trip_no2 = ? AND fecha_retorno = ?
       AND (type_tour = 'ONE'
       OR type_tour = 'MULTI')
       AND estado != 'QUOTE'
       AND estado != 'CANCELED'
       AND estado != 'NOT SHOW W/ CHARGE'
       AND estado != 'NOT SHOW W/O CHARGE') AS tours,
       (SELECT (sum(pax_r) + sum(pax2_r)) FROM  reservas Where trip_no2 = ? AND fecha_retorno = ?
       AND id2 = '6'
       AND estado != 'QUOTE'
       AND estado != 'CANCELED'
       AND estado != 'NOT SHOW W/ CHARGE'
       AND estado != 'NOT SHOW W/O CHARGE') AS especial
       FROM reservas WHERE trip_no2 = ? AND fecha_retorno = ?
       AND estado != 'QUOTE'
       AND estado != 'CANCELED'
       AND estado != 'NOT SHOW W/ CHARGE'
       AND estado != 'NOT SHOW W/O CHARGE'
       AND estado != 'NO SHOW'
       AND id2 = '4'";
         // $rs_spcretorno100 = Doo::db()->query($sql_spcretorno100, array($trip100, $fecha));
         $rs_spcretorno100return = Doo::db()->query($sql_spcretorno100, array($trip_no,$fecha_returnn,$trip_no,$fecha_returnn,$trip_no,$fecha_returnn,$trip_no,$fecha_returnn,$trip_no,$fecha_returnn,$trip_no,$fecha_returnn,$trip_no,$fecha_returnn));
         $r_spcretorno100return = $rs_spcretorno100return->fetchAll();

         $spro_retorno100return = $r_spcretorno100return[0]['superpromo'] ? $r_spcretorno100return[0]['superpromo'] : 0;
         $sdic_retorno100return = $r_spcretorno100return[0]['superdiscount'] ? $r_spcretorno100return[0]['superdiscount'] : 0;
         $wfare_retorno100return = $r_spcretorno100return[0]['webfare'] ? $r_spcretorno100return[0]['webfare'] : 0;
         $standr_retorno100return = $r_spcretorno100return[0]['standard'] ? $r_spcretorno100return[0]['standard'] : 0;
         $sflex_retorno100return = $r_spcretorno100return[0]['superflex'] ? $r_spcretorno100return[0]['superflex'] : 0;
         $special_retorno100return = $r_spcretorno100return[0]['especial'] ? $r_spcretorno100return[0]['especial'] : 0;
         $tour_retorno100return = $r_spcretorno100return[0]['tours'] ? $r_spcretorno100return[0]['tours'] : 0;


         $total_spro100return = $spro_ida100return + $spro_retorno100return ;
         $total_sdic100return = $sdic_ida100return + $sdic_retorno100return ;
         $total_wfare100return = $wfare_ida100return + $wfare_retorno100return ;
         $total_standr100return = $standr_ida100return + $standr_retorno100return ;
         $total_sflex100return = $sflex_ida100return + $sflex_retorno100return ;
         $total_especial100return = $special_ida100return + $special_retorno100return ;
         $total_tours100return = $tour_ida100return + $tour_retorno100return ;

         $ReservasTotalesreturn = $total_spro100return + $total_sdic100return + $total_wfare100return  + $total_standr100return + $total_sflex100return + $total_especial100return + $total_tours100return;
         $resultsuperflexreturn = $total_sflex100return - $superflex_100return;

         $OcupadosTotalesreturn =  $ReservasTotalesreturn + $p_ocupados100return;

          // $cantidadwebfreturn = $puestos[0]['cantwebf'] ? $puestos[0]['cantwebf'] : 0;
          // $cantidadsuperproreturn = $puestos[0]['cantsuperp'] ? $puestos[0]['cantsuperp'] : 0;
          // $cantidadsuperdiscreturn = $puestos[0]['cantsuperdisc'] ? $puestos[0]['cantsuperdisc'] : 0;
          // $cantidadsuperflexreturn = $puestos[0]['cantsuperflex'] ? $puestos[0]['cantsuperflex'] : 0;

           $numperson100return = $_SESSION['booking']['pax'] + $_SESSION['booking']['chil'];

             $wf_totreturn = ($webfare_100return - $total_wfare100return)-$total_standr100return-$total_especial100return-$total_tours100return-$total_spro100return-$total_sdic100return-$numperson100return-$cantidadwebfreturn-$cantidadsuperproreturn-$cantidadsuperdiscreturn -$cantidadsstandarreturn ;

             $sflx_totreturn = ($superflex_100return - $total_sflex100return)-$numperson100return-$cantidadsuperflexreturn;

             $spr_totreturn = ($superpromo_100return - $total_spro100return)-$numperson100return-$cantidadsuperproreturn;

             $sdc_totreturn = ($superdiscount_100return - $total_sdic100return)-$numperson100return-$cantidadsuperdiscreturn;

             if($wf_totreturn < $spr_totreturn){
                 $spr_totreturn = $wf_totreturn;
               }else{
                 $spr_totreturn = $spr_totreturn;
               }

               if($wf_totreturn < $sdc_totreturn){
                 $sdc_totreturn = $wf_totreturn;
               }else{
                 $sdc_totreturn = $sdc_totreturn;
               }



              if ($this->params['promo'] == 'wFareReturn') {
                $disp = $wf_totreturn;
              }elseif ($this->params['promo'] == 'sPromoReturn') {
                  $disp = $spr_totreturn;
              }elseif ($this->params['promo'] == 'sDiscReturn') {
                  $disp = $sdc_totreturn;
              }elseif ($this->params['promo'] == 'sFlexReturn') {
                  $disp = $sflx_totreturn;

              }

        // if (true) {


        //  echo '<pre>';
        //  print_r($disp);
        //  echo '</pre>';
        //  die;

         if ($disp < 0){
        $this->naveganteT();
        // print($modalT);
         echo "<no_cupos";
         die;
         }

        }
        // echo '<pre>';
        // print_r($disp);
        // echo '</pre>';
        // die;
        if (true) {

        // if ($disp < 0) {
          Doo::loadModel("Reservas_trip_puestos");
          $cantidad = ( ($_SESSION['booking']['pax']) + ($_SESSION['booking']['chil']) );
          list($mes, $dia, $anio) = explode('-', $_SESSION['booking']['fecha_salida']);

          list($mes1, $dia1, $anio1) = explode('-', $_SESSION['booking']['fecha_retorno']);
          $trip_to = $this->params['trip_no'];
          
          $tipo = $this->params['tipo'];
          
          $click = $this->params['click'];        
          
          //echo $click;
          
          $id_user = $_SESSION['booking']['iden'];
          //echo $id_user;
          $tidaun = $_SESSION['booking']['dateT1'];
          //echo $tidaun;
          $tivudo = $_SESSION['booking']['dateT2'];
          //echo $tivudo;
          //echo $id_user;
          $fecha_trip = $anio . '-' . $mes . '-' . $dia;
          $fecha_trip1 = $anio1 . '-' . $mes1 . '-' . $dia1;
          //print_r($_SESSION['booking']) ;
          //echo 'cantidad de pasajeros '.$cantidad.', fecha del trip '.$fecha_trip.', numero del trip '.$trip_to.', tipo trip '.$tipo.' numero de click '.$click;
          $reservas_trip_puestos = new Reservas_trip_puestos;
          $reservas_trip_puestos->trip_to = $trip_to;
          $reservas_trip_puestos->tipo = $tipo;
          $reservas_trip_puestos->fecha_trip = ($tipo == 1 ? $fecha_trip : $fecha_trip1);
          $reservas_trip_puestos->cantidad = $cantidad;
          $reservas_trip_puestos->fecha_usado = date('Y-m-d H:i:s');
          $reservas_trip_puestos->usuario = $id_user;
          $reservas_trip_puestos->estado = 'USING';
          //print_r($reservas_trip_puestos);


          // date_default_timezone_set('America/New_York');
          if ($reservas_trip_puestos->tipo == 1) {

              if ($click == 1) {
                  //Sin comentarios. Sorry :)
                  $bCuenta=0;
                  if($tidaun!=''){
                     $b = "SELECT tipo, usuario, estado, fecha_usado from reservas_trip_puestos WHERE usuario = $id_user and tipo = 1 and fecha_usado <= '$tidaun'";
                      $sqlS=Doo::db()->query($b);
                      foreach ($sqlS as $S):
                          $bUsuario = $S['usuario'];
                          $bEstado = $S['estado'];
                          $bTipo = $S['tipo'];
                          $tarifaold = $S['tarifa'];
                          if($bUsuario!='' and $bEstado!='' and $bTipo!=''){
                              $bCuenta++;
                          }
                      endforeach;
                  }else{
                      $bCuenta=$bCuenta;
                  }

              //   echo '<pre>';
              // print_r($b);
              // echo '</pre>';
              // die;
                  // print_r($_SESSION['booking']['dateT1']);
                  // die;
                  if($bCuenta == 0){
                      $z = "SELECT now() as timet";
                      $zrt = Doo::db()->query($z);
                      foreach ($zrt as $t):
                          $Tt=$t['timet'];
                      endforeach;
                      $_SESSION['booking']['dateT1']=$Tt;
                      $insert = "INSERT INTO reservas_trip_puestos (id, trip_to, tipo, fecha_trip, cantidad, fecha_usado, usuario, estado, fecha_actividad,tarifa)
                  VALUES(NULL, $trip_to, $tipo, '".$fecha_trip."', $cantidad, now(), $id_user, 'USING', now(),$idpromo)";

                  Doo::db()->query($insert);
                  }else{

                      $z = "SELECT now() as timet";
                      $zrt = Doo::db()->query($z);
                      foreach ($zrt as $t):
                          $Tt=$t['timet'];
                      endforeach;
                      $_SESSION['booking']['dateT1']=$Tt;
                      $sqlUpdate = "UPDATE reservas_trip_puestos SET trip_to = $trip_to, tipo = $tipo, fecha_trip = '".$fecha_trip."', "
                              . "cantidad = $cantidad, fecha_usado = now(), usuario = $id_user, estado = 'USING', fecha_actividad = now(),tarifa=$idpromo"
                              . " WHERE tipo = $tipo AND usuario = $id_user AND fecha_usado <= '$tidaun'  ";

                      Doo::db()->query($sqlUpdate);
                      }
              } else {
                      $z = "SELECT now() as timet";
                      $zrt = Doo::db()->query($z);
                      foreach ($zrt as $t):
                          $Tt=$t['timet'];
                      endforeach;
                      $_SESSION['booking']['dateT1']=$Tt;
                      $update = "UPDATE reservas_trip_puestos SET fecha_usado = now(), trip_to = '" . $trip_to . "', estado = 'USING',tarifa=$idpromo WHERE usuario = '" . $id_user . "' AND fecha_trip = '" . ($tipo == 2 ? $fecha_trip1 : $fecha_trip) . "' AND tipo = '1' ";


                      Doo::db()->query($update);
                  }
          } else {
              if ($click == 1) {
                  //Sin comentarios, sorry
                  $bCuenta2=0;
                  if($tivudo!=''){
                      $b = "SELECT tipo, usuario, estado from reservas_trip_puestos WHERE usuario = $id_user and tipo = 2 and fecha_usado <= '$tivudo'";
                      $sqlS=Doo::db()->query($b);

                      foreach ($sqlS as $S):
                          $bUsuario = $S['usuario'];
                          $bEstado = $S['estado'];
                          $bTipo = $S['tipo'];
                          $tarifaold = $S['tarifa'];
                          if($bUsuario!='' and $bEstado!='' and $bTipo!=''){
                              $bCuenta2++;
                          }
                      endforeach;
                  }else{
                      $bCuenta2=$bCuenta2;
                  }
                  // print_r($b);
                  // // die;
                  if($bCuenta2 == 0){
                      $z = "SELECT now() as timet";
                      $zrt = Doo::db()->query($z);
                      foreach ($zrt as $t):
                          $Tt=$t['timet'];
                      endforeach;
                      $_SESSION['booking']['dateT2']=$Tt;
                      $insert = "INSERT INTO reservas_trip_puestos (id, trip_to, tipo, fecha_trip, cantidad, fecha_usado, usuario, estado, fecha_actividad,tarifa)
                      VALUES(NULL, $trip_to, $tipo, '".$fecha_trip1."', $cantidad, now(), $id_user, 'USING', now(),$idpromo)";
                      Doo::db()->query($insert);
                  }else{
                      $z = "SELECT now() as timet";
                      $zrt = Doo::db()->query($z);
                      foreach ($zrt as $t):
                          $Tt=$t['timet'];
                      endforeach;
                      $_SESSION['booking']['dateT2']=$Tt;
                      $sqlUpdate = "UPDATE reservas_trip_puestos SET trip_to = $trip_to, tipo = $tipo, fecha_trip = '".$fecha_trip1."', "
                              . "cantidad = $cantidad, fecha_usado = now(), usuario = $id_user, estado = 'USING', fecha_actividad = now(),tarifa=$idpromo"
                              . " WHERE tipo = $tipo AND usuario = $id_user and fecha_usado <= '$tivudo' ";
                      Doo::db()->query($sqlUpdate);
                  }
              } else {
                  $z = "SELECT now() as timet";
                      $zrt = Doo::db()->query($z);
                      foreach ($zrt as $t):
                          $Tt=$t['timet'];
                      endforeach;
                      $_SESSION['booking']['dateT2']=$Tt;
                  $update2 = "UPDATE reservas_trip_puestos SET fecha_usado = now(), trip_to = '" . $trip_to . "', estado = 'USING',tarifa=$idpromo WHERE usuario = '" . $id_user . "' AND fecha_trip = '" . ($tipo == 2 ? $fecha_trip1 : $fecha_trip) . "' AND tipo = '2' ";
                  Doo::db()->query($update2);
              }
          }
                  }else {
              // echo  json_encode(array('opc' => 'no_cupos','trip'=>$this->params['trip_no']));
              echo '<no_cupos';
              // echo json_encode(array('trip' =>$this->params['trip_no']));

          }
      }
    public function disponibilidad($trip_no, $fecha, $identificador, $totalpax) {

        /*
         * Esta consulta es para
         * sacar la capacidad total
         * del bus
         */
        $sql = "SELECT DISTINCT
                  capacity,
                  capacity2,
                  capacity3,
                  capacity4,
                  capacity5
                FROM
                  routes
                WHERE fecha_ini = '" . $fecha . "'
                  AND fecha_fin = '" . $fecha . "'
                  AND trip_no = '" . $trip_no . "'";
        $result = Doo::db()->query($sql);
        $response = $result->fetchAll();
        
//        print_r($response);
//        die;
        foreach ($response as $r):
            $capacidad = $r['capacity'];
            $capacidad2 = $r['capacity2'];
            $capacidad3 = $r['capacity3'];
            $capacidad4 = $r['capacity4'];
            $capacidad5 = $r['capacity5'];
        endforeach;
        $capacidadTotal = ($capacidad + $capacidad2 + $capacidad3 + $capacidad4 + $capacidad5);

        /*
         * Esta consulta es para
         * sacar el valor de los
         * cupos que ya fueron
         * vendidos.
         */
        $sql2 = "SELECT
                  (SUM(pax) + SUM(pax2)) AS ocupados
                FROM
                  reservas
                WHERE trip_no = '" . $trip_no . "'
                  AND fecha_salida = '" . $fecha . "'
                  AND id1 = '" . $identificador . "'
                  AND estado != 'QUOTE'
                  AND estado != 'CANCELED'
                  AND estado != 'NOT SHOW W/ CHARGE'
                  AND estado != 'NOT SHOW W/O CHARGE'";
        $result2 = Doo::db()->query($sql2);
        $response2 = $result2->fetchAll();
        foreach ($response2 as $r2):
            $ocupados = $r2['ocupados'];
        endforeach;
        switch ($identificador) {
            case 1:
                //estandar
                $parametro = 'stseats';
                break;
            case 2:
                //super flex
                $parametro = 'sflexseats';
                break;
            case 3:
                //web fare
                $parametro = 'wfseats';
                break;
            case 4:
                //super promo
                $parametro = 'spseats';
                break;
            case 5:
                //super discount
                $parametro = 'sdseats';
                break;
            default:
                break;
        }

        /*
         * esta consulta muestra los cupos
         * asignados
         */
        $sql3 = "SELECT DISTINCT " . $parametro . " AS asignado FROM routes WHERE fecha_ini = '" . $fecha . "' AND trip_no = '" . $trip_no . "'";
        $response3 = Doo::db()->query($sql3);
        $result3 = $response3->fetchAll();
        foreach ($result3 as $r3):
            $asignado = $r3['asignado'];
        endforeach;
        $cupoDisponible = ($asignado - ($ocupados == null ? 0 : $ocupados));
        return $cupoDisponible;
        //echo 'la capacidad es de '.$capacidadTotal.' para el trip #'. $trip_no.' y los puestos usados son '.($ocupados == null ? 0: $ocupados).' y la capacidad de cupo asignada es de '.$asignado.' y los cupos disponibles son '.$cupoDisponible;
    }

    public function disponible($trip_no, $fecha) {
        //tipo = 1 -> De Ida
        //tipo = 2 -> De Retorno
        $sqlC = "SELECT sum(b.capacidad) as capacidad
                    FROM  trips t
                    LEFT JOIN  bus_trips tb  on (t.id = tb.id_trips )
                    LEFT JOIN  bus b  on (tb.id_bus=b.id)
		WHERE t.trip_no= ?";
        $rs_d = Doo::db()->query($sqlC, array($trip_no));
        $trip_bus = $rs_d->fetchAll();
        $capacidad = $trip_bus[0]['capacidad'];

        $capacidad = ($capacidad != 0) ? $capacidad : 0;
        if ($capacidad == 0) {// No esta disponible
            return -1;
        }
        //De Ida
        $sqlIda = "SELECT (sum(pax) + sum(pax2))as ocupadas
                    FROM  reservas
                    Where trip_no = '" . $trip_no . "' AND fecha_salida = '" . $fecha . "' ";
        $rsi = Doo::db()->query($sqlIda);
        $r_idas = $rsi->fetchAll();
        $ocupadas_idas = $r_idas[0]['ocupadas'] ? $r_idas[0]['ocupadas'] : 0;

          //echo $trip_no;
          // echo '<pre>';
          // print_r($ocupadas_idas);
          // echo '</pre>';


        //De Retorno
        $sqlRetunr = "SELECT (sum(pax_r) + sum(pax2_r))as ocupadas
				FROM  reservas
				Where trip_no2 = ? AND fecha_retorno = ?";
        $rsv = Doo::db()->query($sqlRetunr, array($trip_no, $fecha));
        $r_return = $rsv->fetchAll();
        $ocupadas_return = $r_return[0]['ocupadas'] ? $r_return[0]['ocupadas'] : 0;

        $ocupadas = $ocupadas_idas + $ocupadas_return;
        return $capacidad - $ocupadas;
    }

    /* FUNCION DE PICK UP Y DROP OP */

    public function pickupDropoff() {

        
        $modalT = $this->modalTripPuesto();
        print($modalT);
        $miraT = $this->miraSesion();
        print($miraT);
        global $variable;
        //Refrescar, si No existe
        $Refresca = $this->compruebaUsingNop();
        print($Refresca);
        
        //Fin Refrescar
//        if(isset($_SESSION["booking"])){
//            $booking = $_SESSION["booking"];
//            $modalT = $this->naveganteDescaradoT();
//            print($modalT);
//        }
        Doo::loadModel("Agency");

        $datos = array(
            'priceAdult' => $_POST['priceAdult'],
            'priceChild' => $_POST['priceChild'],
            'priceAdult1' => $_POST['priceAdult1'],
            'priceChild1' => $_POST['priceChild1'],
            'fecha_salida' => $_POST['fecha_salida'],
            'fecha_retorno' => $_POST['fecha_retorno'],
            'pax' => $_POST['pax'],
            'child' => $_POST['child'],
            'from' => $_POST['from'],
            'to' => $_POST['to'],
            'idPrecioIda' => $_POST['price'],
            'idPrecioVuelta' => $_POST['price1']
        );

        

     //   $this->data['idPrecioIda'] = $datos['idPrecioIda'];
     //   $this->data['idPrecioVenida'] = $datos['idPrecioVuelta'];

        if (isset($_SESSION['data_agency'])) {
            $dat = new Agency($_SESSION['data_agency']);
            $net_rate = ($dat->type_rate == 1) ? true : false;
            $dat2 = new Agency();
            $dat2->id = $dat->id;
            $dato_exten_n = Doo::db()->getOne($dat2);
            if ($dato_exten_n->precio_especial_exten == 1) {
                $precio_sql = "precio_especial as precio";
            } else if ($net_rate) {
                $precio_sql = "precio_neto as precio";
            } else {
                $precio_sql = "precio";
            }
        } else {
            $dat = new Agency();
            $dat->id = -1;
            $net_rate = false;
            $dat->type_rate = 0;
            $precio_sql = "precio";
        }

        if (isset($_SESSION['msg'])) {
            unset($_SESSION['msg']);
        }

//        if ($_SERVER["REQUEST_METHOD"] == "GET") {
//            return Doo::conf()->APP_URL . "booking";
//        }

        if (isset($_SESSION["booking"])) {
            $booking = $_SESSION["booking"];
            
//            echo '<pre>';
//            print_r($_SESSION);
//            echo '</pre>';
//            die;
            
            
            //Estos dos datos son los que tengo que modificar
            $_SESSION['booking']['idPrecioIda'] = $_SESSION['booking']['idPrecioIda'];
            $_SESSION['booking']['idPrecioVuelta'] = $_SESSION['booking']['idPrecioVuelta'];
            $fecha_salida = $booking["fecha_salida"];
            $fecha_retorno = $booking["fecha_retorno"];
        } else {
            return Doo::conf()->APP_URL;
        }


        $sql = "SELECT
                t1.trip_no,
                t1.fecha,
                t4.nombre AS trip_from,
                t5.nombre AS trip_to,
                t2.price,
                t2.price2,
                t2.price3,
                t2.price4,
                t2.trip_from as tf,
                t2.trip_to as tt,
                t2.trip_departure,
                t2.trip_arrival
                FROM programacion t1
                LEFT JOIN routes t2 ON (t1.trip_no = t2.trip_no)
                LEFT JOIN trips  t3 ON (t1.trip_no = t3.trip_no)
                LEFT JOIN areas  t4 ON (t2.trip_from = t4.id)
                LEFT JOIN areas  t5 ON  (t2.trip_to  = t5.id)
                WHERE t2.id = ? AND fecha = ?";

        if ($net_rate) {
            $sql_net = "SELECT
                    t1.trip_no,
                    t1.fecha,
                    t4.nombre AS trip_from,
                    t5.nombre AS trip_to,
                    t2.price,
                    t2.price2,
                    t2.price3,
                    t2.price4,
                    t2.trip_from as tf,
                    t2.trip_to as tt,
                    t2.trip_departure,
                    t2.trip_arrival
                    FROM programacion t1
                    LEFT JOIN routes_net t2 ON (t1.trip_no = t2.trip_no)
                    LEFT JOIN trips  t3 ON (t1.trip_no = t3.trip_no)
                    LEFT JOIN areas  t4 ON (t2.trip_from = t4.id)
                    LEFT JOIN areas  t5 ON  (t2.trip_to  = t5.id)
                    WHERE fecha = '" . $booking["fecha_salida"] . "' AND t2.type_rate = 2 and t2.id_agency = '$dat->id' ";
            $sql = "Select ms.trip_no, ms.fecha, ms.trip_from, ms.trip_to, ms.trip_to,
              CASE
                    WHEN ms.trip_no = k.trip_no THEN k.price
                    ELSE ms.price
                END as price ,
              CASE
                    WHEN ms.trip_no = k.trip_no THEN k.price2
                    ELSE ms.price2
                END as price2,
              CASE
                    WHEN ms.trip_no = k.trip_no THEN k.price3
                    ELSE ms.price3
                END as price3,
              CASE
                    WHEN ms.trip_no = k.trip_no THEN k.price4
                    ELSE ms.price4
                END as price4,

                ms.tf,ms.tt,ms.trip_departure,ms.trip_arrival
              From ( " . $sql . " )as ms  LEft JOIN ( " . $sql_net . " ) as k ON ((ms.trip_no = k.trip_no) and (k.trip_from = ms.trip_from) AND (ms.trip_to = k.trip_to)  )";
        }

        //Tipo de pickup_dropoff;
        if ($dat->id == -1) {
            $active_web = 1;
        } else {
            $active_web = 0;
        }
        $trip1T = $_SESSION['booking']['trip1'];
        $trip2T = $_SESSION['booking']['trip2'];
        //idPrecioIda e idPrecioVuelta
        //echo $trip1T."-".$trip2T;
        
        if (isset($_SESSION['booking']['trip1'])) {
            $fecha = $booking["fecha_salida"];
            list($mes, $dia, $anio) = explode('-', $fecha);
            $fecha_trip = $anio . '-' . $mes . '-' . $dia;
            $trip1 = $_SESSION['booking']['trip1'];            
            $rsb = Doo::db()->query($sql, array($trip1, $booking["fecha_salida"]));
            $salida = $rsb->fetch();
            
            //print_r($salida);
            
            $trip = $salida["trip_no"];
//            echo"****";
//            echo $trip;
//            die;

	$sqlavalible = "SELECT  SUM(cantidad) AS cantwebf,
        (SELECT SUM(cantidad) FROM reservas_trip_puestos  WHERE fecha_trip = ? AND trip_to = ?  AND (tipo = '1' OR tipo = '2') AND (estado = 'USING' OR estado = 'RENEWED') AND tarifa = '4') as cantsuperp,
        (SELECT SUM(cantidad) FROM reservas_trip_puestos  WHERE fecha_trip = ? AND trip_to = ?  AND (tipo = '1' OR tipo = '2') AND (estado = 'USING' OR estado = 'RENEWED') AND tarifa = '5') as cantsuperdisc,
        (SELECT SUM(cantidad) FROM reservas_trip_puestos  WHERE fecha_trip = ? AND trip_to = ?  AND (tipo = '1' OR tipo = '2') AND (estado = 'USING' OR estado = 'RENEWED') AND tarifa = '2') as cantsuperflex,
        (SELECT SUM(cantidad) FROM reservas_trip_puestos  WHERE fecha_trip = ? AND trip_to = ?  AND (tipo = '1' OR tipo = '2') AND (estado = 'USING' OR estado = 'RENEWED') AND tarifa = '1') as cantstandar
        FROM reservas_trip_puestos WHERE fecha_trip = ?  AND trip_to = ?  AND (tipo = '1' OR tipo = '2') AND (estado = 'USING' OR estado = 'RENEWED') AND tarifa = '3'";
        
        $rsp = Doo::db()->query($sqlavalible, array($fecha_trip,$trip,$fecha_trip,$trip,$fecha_trip,$trip,$fecha_trip,$trip,$fecha_trip,$trip));
        $puestos = $rsp->fetchAll(PDO::FETCH_ASSOC);
        
//        print_r($puestos);
//        die;
//        echo "trip1:";
//        echo $trip1; 
//        echo "     ";   
//        echo "fecha trip:";
//        echo $fecha_trip;
//        echo "     ";
//        echo "trip:";
//        echo $trip;
//        echo "     ";
//        
//        print_r($puestos);
//        die;
        $cantidadwebf = $puestos[0]['cantwebf'] ? $puestos[0]['cantwebf'] : 0;
        $cantidadsuperpro = $puestos[0]['cantsuperp'] ? $puestos[0]['cantsuperp'] : 0;
        $cantidadsuperdisc = $puestos[0]['cantsuperdisc'] ? $puestos[0]['cantsuperdisc'] : 0;
        $cantidadsuperflex = $puestos[0]['cantsuperflex'] ? $puestos[0]['cantsuperflex'] : 0;
        $cantidadsstandar = $puestos[0]['cantstandar'] ? $puestos[0]['cantstandar'] : 0;

	$sql2 = "SELECT DISTINCT spseats,sdseats,wfseats,sflexseats,stseats,spprcseats,toursseats,vehicles,capacity,capacity2,capacity3,capacity4,capacity5,seats_remain FROM routes WHERE fecha_ini = ? AND trip_no = ?";
        $rs2 = Doo::db()->query($sql2, array($fecha_trip,$trip));
        $routes = $rs2->fetchAll(PDO::FETCH_ASSOC);
        $seats = $routes[0]['seats_remain'];

        $capacidad100_1 = $routes[0]['capacity'];
        $capacidad100_2 = $routes[0]['capacity2'];
        $capacidad100_3 = $routes[0]['capacity3'];
        $capacidad100_4 = $routes[0]['capacity4'];
        $capacidad100_5 = $routes[0]['capacity5'];

        $webfare_100 = $routes[0]['wfseats'];
        $superpromo_100 = $routes[0]['spseats'];
        $superdiscount_100 = $routes[0]['sdseats'];
        $superflex_100 = $routes[0]['sflexseats'];
        $standard_100 = $routes[0]['sflexseats'];
        $sppr_100 = $routes[0]['spprcseats'];
        $tour_100 = $routes[0]['toursseats'];

	$sql_spcida100 = "SELECT
        (sum(pax) + sum(pax2)) AS superpromo,
      (SELECT (sum(pax) + sum(pax2)) FROM reservas WHERE trip_no = ? AND fecha_salida = ?
      AND estado != 'QUOTE'
      AND estado != 'CANCELED'
      AND estado != 'NOT SHOW W/ CHARGE'
      AND estado != 'NOT SHOW W/O CHARGE'
      AND estado != 'NO SHOW'
      AND id1 = '5') as superdiscount,
      (SELECT (sum(pax) + sum(pax2)) FROM reservas WHERE trip_no = ? AND fecha_salida = ?
      AND estado != 'QUOTE'
      AND estado != 'CANCELED'
      AND estado != 'NOT SHOW W/ CHARGE'
      AND estado != 'NOT SHOW W/O CHARGE'
      AND estado != 'NO SHOW'
      AND id1 = '3') as webfare,
      (SELECT (sum(pax) + sum(pax2)) FROM reservas WHERE trip_no = ? AND fecha_salida = ?
      AND estado != 'QUOTE'
      AND estado != 'CANCELED'
      AND estado != 'NOT SHOW W/ CHARGE'
      AND estado != 'NOT SHOW W/O CHARGE'
      AND estado != 'NO SHOW'
      AND id1 = '1') as standard,
      (SELECT (sum(pax) + sum(pax2)) FROM reservas  WHERE trip_no = ? AND fecha_salida = ?
      AND estado != 'QUOTE'
      AND estado != 'CANCELED'
      AND estado != 'NOT SHOW W/ CHARGE'
      AND estado != 'NOT SHOW W/O CHARGE'
      AND estado != 'NO SHOW'
      AND id1 = '2') as superflex,
      (SELECT (sum(pax) + sum(pax2)) FROM  reservas Where trip_no = ? AND fecha_salida = ?
      AND (type_tour = 'ONE'
      OR type_tour = 'MULTI')
      AND estado != 'QUOTE'
      AND estado != 'CANCELED'
      AND estado != 'NOT SHOW W/ CHARGE'
      AND estado != 'NOT SHOW W/O CHARGE') AS tours,
      (SELECT (sum(pax) + sum(pax2)) FROM  reservas Where trip_no = ?  AND fecha_salida = ?
      AND id1 = '6'
      AND estado != 'QUOTE'
      AND estado != 'CANCELED'
      AND estado != 'NOT SHOW W/ CHARGE'
      AND estado != 'NOT SHOW W/O CHARGE') AS especial

      FROM reservas  WHERE trip_no = ? AND fecha_salida = ?
      AND estado != 'QUOTE'
      AND estado != 'CANCELED'
      AND estado != 'NOT SHOW W/ CHARGE'
      AND estado != 'NOT SHOW W/O CHARGE'
      AND estado != 'NO SHOW'
      AND id1 = '4' ";
        $trips100 = Doo::db()->query($sql_spcida100, array($trip,$fecha_trip,$trip,$fecha_trip,$trip,$fecha_trip,$trip,$fecha_trip,$trip,$fecha_trip,$trip,$fecha_trip,$trip,$fecha_trip));
        $r_spcida100 = $trips100->fetchAll();
        // $seats_ida100 = $r_spcida100[0]['superdiscount'];
        $spro_ida100 = $r_spcida100[0]['superpromo'] ? $r_spcida100[0]['superpromo'] : 0;
        $sdic_ida100 = $r_spcida100[0]['superdiscount'] ? $r_spcida100[0]['superdiscount'] : 0;
        $wfare_ida100 = $r_spcida100[0]['webfare'] ? $r_spcida100[0]['webfare'] : 0;
        $standr_ida100 = $r_spcida100[0]['standard'] ? $r_spcida100[0]['standard'] : 0;
        $sflex_ida100 = $r_spcida100[0]['superflex'] ? $r_spcida100[0]['superflex'] : 0;
        $special_ida100 = $r_spcida100[0]['especial'] ? $r_spcida100[0]['especial'] : 0;
        $tour_ida100 = $r_spcida100[0]['tours'] ? $r_spcida100[0]['tours'] : 0;

        $sql_spcretorno100 = "SELECT (sum(pax_r) + sum(pax2_r)) AS superpromo,
      (SELECT (sum(pax_r) + sum(pax2_r)) FROM  reservas WHERE trip_no2 = ? AND fecha_retorno = ?
      AND estado != 'QUOTE'
      AND estado != 'CANCELED'
      AND estado != 'NOT SHOW W/ CHARGE'
      AND estado != 'NOT SHOW W/O CHARGE'
      AND estado != 'NO SHOW'
      AND id2 = '5') as superdiscount,
      (SELECT (sum(pax_r) + sum(pax2_r)) FROM reservas WHERE trip_no2 = ? AND fecha_retorno = ?
      AND estado != 'QUOTE'
      AND estado != 'CANCELED'
      AND estado != 'NOT SHOW W/ CHARGE'
      AND estado != 'NOT SHOW W/O CHARGE'
      AND estado != 'NO SHOW'
      AND id2 = '3') as webfare,
      (SELECT (sum(pax_r) + sum(pax2_r)) FROM reservas WHERE trip_no2 = ? AND fecha_retorno = ?
      AND estado != 'QUOTE'
      AND estado != 'CANCELED'
      AND estado != 'NOT SHOW W/ CHARGE'
      AND estado != 'NOT SHOW W/O CHARGE'
      AND estado != 'NO SHOW'
      AND id2 = '1') as standard,
      (SELECT (sum(pax_r) + sum(pax2_r)) FROM reservas WHERE trip_no2 = ? AND fecha_retorno = ?
      AND estado != 'QUOTE'
      AND estado != 'CANCELED'
      AND estado != 'NOT SHOW W/ CHARGE'
      AND estado != 'NOT SHOW W/O CHARGE'
      AND estado != 'NO SHOW'
      AND id2 = '2') as superflex,
      (SELECT (sum(pax_r) + sum(pax2_r)) FROM  reservas  Where trip_no2 = ? AND fecha_retorno = ?
      AND (type_tour = 'ONE'
      OR type_tour = 'MULTI')
      AND estado != 'QUOTE'
      AND estado != 'CANCELED'
      AND estado != 'NOT SHOW W/ CHARGE'
      AND estado != 'NOT SHOW W/O CHARGE') AS tours,
      (SELECT (sum(pax_r) + sum(pax2_r)) FROM  reservas Where trip_no2 = ? AND fecha_retorno = ?
      AND id2 = '6'
      AND estado != 'QUOTE'
      AND estado != 'CANCELED'
      AND estado != 'NOT SHOW W/ CHARGE'
      AND estado != 'NOT SHOW W/O CHARGE') AS especial
      FROM reservas WHERE trip_no2 = ? AND fecha_retorno = ?
      AND estado != 'QUOTE'
      AND estado != 'CANCELED'
      AND estado != 'NOT SHOW W/ CHARGE'
      AND estado != 'NOT SHOW W/O CHARGE'
      AND estado != 'NO SHOW'
      AND id2 = '4'";

        $rs_spcretorno100 = Doo::db()->query($sql_spcretorno100, array($trip,$fecha_trip,$trip,$fecha_trip,$trip,$fecha_trip,$trip,$fecha_trip,$trip,$fecha_trip,$trip,$fecha_trip,$trip,$fecha_trip));
        $r_spcretorno100 = $rs_spcretorno100->fetchAll();

        $spro_retorno100 = $r_spcretorno100[0]['superpromo'] ? $r_spcretorno100[0]['superpromo'] : 0;
        $sdic_retorno100 = $r_spcretorno100[0]['superdiscount'] ? $r_spcretorno100[0]['superdiscount'] : 0;
        $wfare_retorno100 = $r_spcretorno100[0]['webfare'] ? $r_spcretorno100[0]['webfare'] : 0;
        $standr_retorno100 = $r_spcretorno100[0]['standard'] ? $r_spcretorno100[0]['standard'] : 0;
        $sflex_retorno100 = $r_spcretorno100[0]['superflex'] ? $r_spcretorno100[0]['superflex'] : 0;
        $special_retorno100 = $r_spcretorno100[0]['especial'] ? $r_spcretorno100[0]['especial'] : 0;
        $tour_retorno100 = $r_spcretorno100[0]['tours'] ? $r_spcretorno100[0]['tours'] : 0;


        $total_spro100 = $spro_ida100 + $spro_retorno100 ;
        $total_sdic100 = $sdic_ida100 + $sdic_retorno100 ;
        $total_wfare100 = $wfare_ida100 + $wfare_retorno100 ;
        $total_standr100 = $standr_ida100 + $standr_retorno100 ;
        $total_sflex100 = $sflex_ida100 + $sflex_retorno100 ;
        $total_especial100 = $special_ida100 + $special_retorno100 ;
        $total_tours100 = $tour_ida100 + $tour_retorno100 ;

        $ReservasTotales = $total_spro100 + $total_sdic100 + $total_wfare100  + $total_standr100 + $total_sflex100 + $total_especial100 + $total_tours100;
        $resultsuperflex = $total_sflex100 - $superflex_100;

        $OcupadosTotales =  $ReservasTotales + $p_ocupados100;
        $numperson100 = $_SESSION['booking']['pax'] + $_SESSION['booking']['chil'];


            $wf_tot = ($webfare_100 - $total_wfare100)-$total_standr100-$total_especial100-$total_tours100 -$total_spro100-$total_sdic100-$cantidadwebf - $cantidadsuperpro - $cantidadsuperdisc - $cantidadsstandar;

            $sflx_tot = ($superflex_100 - $total_sflex100)-$cantidadsuperflex;

            $spr_tot = ($superpromo_100 - $total_spro100)-$cantidadsuperpro;

            $sdc_tot = ($superdiscount_100 - $total_sdic100)-$cantidadsuperdisc;

            if($wf_tot <= $spr_tot){
                $spr_tot = $wf_tot;
              }else{
                $spr_tot = $spr_tot;
              }

              if($wf_tot <= $sdc_tot){
                $sdc_tot = $wf_tot;
              }else{
                $sdc_tot = $sdc_tot;
              }
            $data['rootUrl'] = Doo::conf()->APP_URL;

  			/*if(isset($_GET['op'])){
            return Doo::conf()->APP_URL.'?op='.$_GET['op'].'trip'.$_GET['trip'];*/

              if ($booking['idPrecioIda'] == 3) { //'wFareIda'
                $disp = $wf_tot ;
              }elseif ($booking['idPrecioIda'] == 4) { //'sPromoIda'
                  $disp = $spr_tot;
              }elseif ($booking['idPrecioIda'] == 5) { //'sDiscIda'
                  $disp = $sdc_tot;
              }elseif ($booking['idPrecioIda'] == 2) { //'sFlexIda'
                $disp = $sflx_tot;

              }
              // print_r($disp);
              // die;
    			if($disp<0){
    			$_SESSION['opcnop'] = 'nope1';
    			return Doo::conf()->APP_URL.'booking?op=nope1&trip='.base64_encode($trip);
    			}

            $trip111 = ($trip == NULL) ? NULL : ' AND tripw'.$trip.' = 1 ';

            $rs = Doo::db()->query("SELECT id, address, place as nombre,valid from pickup_dropoff where id_area = ? $trip111 AND (SELECT FIND_IN_SET('2', type_pick)) > 0 AND active_web = ?  ORDER BY posicion ASC", array($salida["tf"], $active_web));

            $pickup1 = $rs->fetchAll();
//            echo '<pre>';
//            print_r($pickup1);
//            echo '<pre>';
//            echo "*****";
//            echo $trip;
//            die;

            $rs2 = Doo::db()->query("SELECT address, valid, place as nombre,id," . $precio_sql . ",valid
				FROM extension
			 where id_area = ? ORDER BY id ASC", array($salida["tf"]));

            $exten1 = $rs2->fetchAll();
            
//            print_r($exten1);
//            die;
            //echo 'hola';
            /////////////////////////////////////////////////////*/ Igualar Extension  pickup 1*/
            $pickupnew = array();
            $contador = 0;
            if (!empty($exten1)) {
                foreach ($exten1 as $key => $value) {
                    $value['type'] = 'E';
                    $pickupnew[$key] = $value;
                    $contador++;
                }
                foreach ($pickup1 as $key => $value) {
                    $value['type'] = 'P';
                    $pickupnew[$contador] = $value;
                    $contador++;
                }
            } else {
                foreach ($pickup1 as $key => $value) {
                    $value['type'] = 'P';
                    $pickupnew[$key] = $value;
                }
            }
            //////////Cierre de Igualar extension */

            $rs = Doo::db()->query("SELECT id, address, valid, place AS nombre FROM pickup_dropoff  WHERE id_area = ? AND  (SELECT FIND_IN_SET('2', type_pick)) > 0 $trip111 AND active_web = ? ORDER BY posicion ASC", array($salida["tt"], $active_web));
            $dropoff1 = $rs->fetchAll();

            $rs3 = Doo::db()->query("SELECT address, valid, place as nombre,id," . $precio_sql . ",valid
					FROM extension  where id_area = ? ORDER BY id ASC", array($salida["tt"]));

            $exten2 = $rs3->fetchAll();

            ///////////////////////////////////////////////////// */ Igualar Extension  dropoff 1 */
            $pickupnew2 = array();
            $contador = 0;

            if (!empty($exten2)) {
                foreach ($exten2 as $key => $value) {
                    $value['type'] = 'E';
                    $pickupnew2[$key] = $value;
                    $contador++;
                }
                foreach ($dropoff1 as $key => $value) {
                    $value['type'] = 'P';
                    $pickupnew2[$contador] = $value;
                    $contador++;
                }
            } else {
                foreach ($dropoff1 as $key => $value) {
                    $value['type'] = 'P';
                    $pickupnew2[$key] = $value;
                }
            }
            if (!isset($_SESSION['data_agency'])) {
                list($mes, $dia, $anyo) = explode("-", $salida["fecha"]);
                $fecha = $anyo . "-" . $mes . "-" . $dia;

                ///////////////////////////////////////////////////// */ Cierre de Igualar extension */
                ///////////////////////////////////////////////////// */ Igualar Ofertas */
                $sqlofer = "(SELECT t1.trip_no, t1.id, t1.fecha_ini, t1.fecha_fin, t4.nombre AS trip_from, t5.nombre AS trip_to, t1.price, t1.price2, t1.price3, t1.price4, t1.regular, t1.frecuente, t3.equipment
						FROM ofertas t1
							LEFT JOIN trips  t3 ON (t1.trip_no = t3.trip_no)
							LEFT JOIN areas  t4 ON (t1.trip_from = t4.id)
							LEFT JOIN areas  t5 ON  (t1.trip_to  = t5.id)
						WHERE t1.trip_from = ?
							AND t1.trip_to = ?
							AND t1.fecha_ini <= ?
							AND t1.fecha_fin >= ?
							AND t1.trip_no = ?)";
                $rsofer = Doo::db()->query($sqlofer, array($salida["tf"], $salida["tt"], strtotime($fecha), strtotime($fecha), $salida["trip_no"]));
                $ofertas = $rsofer->fetch();
            } else {
                $ofertas = "";
            }

            $row_array = array();

            if (!empty($ofertas)) {

                list($mes, $dia, $anyo) = explode("-", $salida["fecha"]);


                $fechaarray = array();
                $fechaarray = $anyo . "-" . $mes . "-" . $dia;

                if ($salida["trip_no"] == $ofertas["trip_no"] && strtotime($fechaarray) >= $ofertas["fecha_ini"] && strtotime($fechaarray) <= $ofertas["fecha_fin"]) {
                    $value1 = array(
                        "trip_no" => $ofertas["trip_no"],
                        "trip_departure" => $salida["trip_departure"],
                        "trip_arrival" => $salida["trip_arrival"],
                        "price" => $ofertas["price"],
                        "price2" => $ofertas["price2"],
                        "price3" => $ofertas["price3"],
                        "price4" => $ofertas["price4"],
                        "oferta" => "1",
                        "fecha" => $salida["fecha"],
                        "trip_from" => $salida["trip_from"],
                        "trip_to" => $salida["trip_to"]
                    );
                    $row_array = $value1;
                } else {
                    $row_array = $salida;
                }
                // echo $row_array[""]."<br>";
            } else {
              // print_r($salida);
              // die;
                foreach ($salida as $key => $value) {
                    $row_array[$key] = $value;
                }
            }

            ///////////////////////////////////////////////////// */ Cierre de Igualar Ofertas */
            /////////////////////////////////////////////////////// /*CAPACIDAD RUTA IDA*/


            $sqlcapa = "SELECT t1.id_bus,t1.id_trips,t2.capacidad,t3.trip_no,t2.fecha_fin,t2.fecha_ini
                        FROM bus_trips t1
                        LEFT JOIN bus t2 ON (t1.id_bus = t2.id)
                        LEFT JOIN trips t3 ON (t1.id_trips = t3.id)
                        WHERE t3.trip_no = ?  AND t2.fecha_ini <= ? AND t2.fecha_fin >= ?";


            list($mes, $dia, $anyo) = explode("-", $fecha_salida);

            $fechaida = $anyo . "-" . $mes . "-" . $dia;


            $rs_capa = Doo::db()->query($sqlcapa, array($row_array['trip_no'], strtotime($fechaida), strtotime($fechaida)));


            $capacidad = $rs_capa->fetchAll();
            //print_r($capacidad);

            $capacity = array();
            $total = 0;
            foreach ($capacidad as $key => $value) {
                $capacity[$key] = $value;
                $total = $total + $value['capacidad'];
            }

            $fecha_sali = $_SESSION['booking']['fecha_salida'];
            $demanda = $_SESSION['booking']['pax'] + $_SESSION['booking']['chil'];

            $rs_res = Doo::db()->find("Reserve", array("select" => "COUNT(*) AS total",
                "where" => "fecha_ini = ? AND trip_no = ?",
                "limit" => 1,
                "param" => array($fecha_sali, $row_array['trip_no'])
            ));           
            
            $totaldispo = $rs_res->total;            

            $disponible = ($total - $totaldispo);
            

            if (isset($disponible) && isset($demanda)) {
                if ($demanda > $disponible) {

                    $_SESSION['msg'] = array("error" => "error", "disponible" => $disponible, "demanda" => $demanda, "trip" => $row_array['trip_no']);
                    return Doo::conf()->APP_URL . "booking/";
                }
            }
            ////////////////////////////////////////////////////////////// /* CIERRE CAPACIDAD RUTA */

            $this->data['salida'] = $row_array;
            $this->data['pickup1'] = $pickupnew;
            $this->data['dropoff1'] = $pickupnew2;
            $e = $salida;
        }

        if (isset($_SESSION['booking']['trip2'])) {
            $trip2 = $_SESSION['booking']['trip2'];
            $rs = Doo::db()->query($sql, array($trip2, $booking["fecha_retorno"]));
            $retorno = $rs->fetch();
			$trip_no = $retorno['trip_no'];
			list($mes2, $dia2, $anio2) = explode('-', $booking['fecha_retorno']);
          $fecha_returnn = $anio2 . '-' . $mes2 . '-' . $dia2;

         $sql = "SELECT
         SUM(cantidad) AS cantwebf,
             (SELECT SUM(cantidad) FROM reservas_trip_puestos
         WHERE fecha_trip = ?
         AND trip_to = ?
         AND (tipo = '1' OR tipo = '2')
         AND ( estado = 'USING' OR estado = 'RENEWED' ) AND tarifa = '4'
         ) as cantsuperp,
         (SELECT SUM(cantidad) FROM reservas_trip_puestos
         WHERE fecha_trip = ?
         AND trip_to = ?
         AND (tipo = '1' OR tipo = '2')
         AND ( estado = 'USING' OR estado = 'RENEWED' ) AND tarifa = '5'
         ) as cantsuperdisc,
         (SELECT SUM(cantidad) FROM reservas_trip_puestos
         WHERE fecha_trip = ?
         AND trip_to = ?
         AND (tipo = '1' OR tipo = '2')
         AND ( estado = 'USING' OR estado = 'RENEWED' ) AND tarifa = '2'
         ) as cantsuperflex,
        (SELECT SUM(cantidad) FROM reservas_trip_puestos
        WHERE fecha_trip = ?
        AND trip_to = ?
        AND (tipo = '1' OR tipo = '2')
        AND ( estado = 'USING' OR estado = 'RENEWED' ) AND tarifa = '1'
        ) as cantstandar
         FROM reservas_trip_puestos WHERE fecha_trip = ?
         AND trip_to = ?
         AND (tipo = '1' OR tipo = '2')
         AND ( estado = 'USING' OR estado = 'RENEWED' ) AND tarifa = '3' ";
         $rs = Doo::db()->query($sql, array($fecha_returnn,$trip_no,$fecha_returnn,$trip_no,$fecha_returnn,$trip_no,$fecha_returnn,$trip_no,$fecha_returnn,$trip_no));
         $puestos = $rs->fetchAll(PDO::FETCH_ASSOC);
         // $p_ocupadoswf = $puestos[0]['CANTIDAD'];
  			//print_r($puestos);
			//die;
         $cantidadwebfreturn = $puestos[0]['cantwebf'] ? $puestos[0]['cantwebf'] : 0;
         $cantidadsuperproreturn = $puestos[0]['cantsuperp'] ? $puestos[0]['cantsuperp'] : 0;
         $cantidadsuperdiscreturn = $puestos[0]['cantsuperdisc'] ? $puestos[0]['cantsuperdisc'] : 0;
         $cantidadsuperflexreturn = $puestos[0]['cantsuperflex'] ? $puestos[0]['cantsuperflex'] : 0;
         $cantidadsstandarreturn = $puestos[0]['cantstandar'] ? $puestos[0]['cantstandar'] : 0;

         // print_r($cantidadsuperdisc);
       $sql2 = "SELECT DISTINCT spseats,sdseats,wfseats,sflexseats,stseats,spprcseats,toursseats,vehicles,capacity,capacity2,capacity3,capacity4,capacity5,seats_remain FROM routes WHERE fecha_ini = ? AND trip_no = ?";
         $rs2 = Doo::db()->query($sql2, array($fecha_returnn,$trip_no));
         $routesreturn = $rs2->fetchAll(PDO::FETCH_ASSOC);
         $seats = $routes[0]['seats_remain'];

         $capacidad100_1return = $routesreturn[0]['capacity'];
         $capacidad100_2return = $routesreturn[0]['capacity2'];
         $capacidad100_3return = $routesreturn[0]['capacity3'];
         $capacidad100_4return = $routesreturn[0]['capacity4'];
         $capacidad100_5return = $routesreturn[0]['capacity5'];

         $webfare_100return = $routesreturn[0]['wfseats'];
         $superpromo_100return = $routesreturn[0]['spseats'];
         $superdiscount_100return = $routesreturn[0]['sdseats'];
         $superflex_100return = $routesreturn[0]['sflexseats'];
         $standard_100return = $routesreturn[0]['sflexseats'];
         $sppr_100return = $routesreturn[0]['spprcseats'];
         $tour_100return = $routesreturn[0]['toursseats'];

         // echo '<pre>';
         // print_r($routesreturn);
         // echo '</pre>';

         $sql_spcida100 = "SELECT
         (sum(pax) + sum(pax2)) AS superpromo,
       (SELECT (sum(pax) + sum(pax2)) FROM reservas WHERE trip_no = ? AND fecha_salida = ?
       AND estado != 'QUOTE'
       AND estado != 'CANCELED'
       AND estado != 'NOT SHOW W/ CHARGE'
       AND estado != 'NOT SHOW W/O CHARGE'
       AND estado != 'NO SHOW'
       AND id1 = '5') as superdiscount,
       (SELECT (sum(pax) + sum(pax2)) FROM reservas WHERE trip_no = ? AND fecha_salida = ?
       AND estado != 'QUOTE'
       AND estado != 'CANCELED'
       AND estado != 'NOT SHOW W/ CHARGE'
       AND estado != 'NOT SHOW W/O CHARGE'
       AND estado != 'NO SHOW'
       AND id1 = '3') as webfare,
       (SELECT (sum(pax) + sum(pax2)) FROM reservas WHERE trip_no = ? AND fecha_salida = ?
       AND estado != 'QUOTE'
       AND estado != 'CANCELED'
       AND estado != 'NOT SHOW W/ CHARGE'
       AND estado != 'NOT SHOW W/O CHARGE'
       AND estado != 'NO SHOW'
       AND id1 = '1') as standard,
       (SELECT (sum(pax) + sum(pax2)) FROM reservas  WHERE trip_no = ? AND fecha_salida = ?
       AND estado != 'QUOTE'
       AND estado != 'CANCELED'
       AND estado != 'NOT SHOW W/ CHARGE'
       AND estado != 'NOT SHOW W/O CHARGE'
       AND estado != 'NO SHOW'
       AND id1 = '2') as superflex,
       (SELECT (sum(pax) + sum(pax2)) FROM  reservas Where trip_no = ? AND fecha_salida = ?
       AND (type_tour = 'ONE'
       OR type_tour = 'MULTI')
       AND estado != 'QUOTE'
       AND estado != 'CANCELED'
       AND estado != 'NOT SHOW W/ CHARGE'
       AND estado != 'NOT SHOW W/O CHARGE') AS tours,
       (SELECT (sum(pax) + sum(pax2)) FROM  reservas Where trip_no = ?  AND fecha_salida = ?
       AND id1 = '6'
       AND estado != 'QUOTE'
       AND estado != 'CANCELED'
       AND estado != 'NOT SHOW W/ CHARGE'
       AND estado != 'NOT SHOW W/O CHARGE') AS especial

       FROM reservas  WHERE trip_no = ? AND fecha_salida = ?
       AND estado != 'QUOTE'
       AND estado != 'CANCELED'
       AND estado != 'NOT SHOW W/ CHARGE'
       AND estado != 'NOT SHOW W/O CHARGE'
       AND estado != 'NO SHOW'
       AND id1 = '4' ";
         $trips100return = Doo::db()->query($sql_spcida100, array($trip_no,$fecha_returnn,$trip_no,$fecha_returnn,$trip_no,$fecha_returnn,$trip_no,$fecha_returnn,$trip_no,$fecha_returnn,$trip_no,$fecha_returnn,$trip_no,$fecha_returnn));
         $r_spcida100return = $trips100return->fetchAll();
         // $seats_ida100 = $r_spcida100[0]['superdiscount'];
         $spro_ida100return = $r_spcida100return[0]['superpromo'] ? $r_spcida100return[0]['superpromo'] : 0;
         $sdic_ida100return = $r_spcida100return[0]['superdiscount'] ? $r_spcida100return[0]['superdiscount'] : 0;
         $wfare_ida100return = $r_spcida100return[0]['webfare'] ? $r_spcida100return[0]['webfare'] : 0;
         $standr_ida100return = $r_spcida100return[0]['standard'] ? $r_spcida100return[0]['standard'] : 0;
         $sflex_ida100return = $r_spcida100return[0]['superflex'] ? $r_spcida100return[0]['superflex'] : 0;
         $special_ida100return = $r_spcida100return[0]['especial'] ? $r_spcida100return[0]['especial'] : 0;
         $tour_ida100return = $r_spcida100return[0]['tours'] ? $r_spcida100return[0]['tours'] : 0;

         $sql_spcretorno100 = "SELECT (sum(pax) + sum(pax2)) AS superpromo,
       (SELECT (sum(pax) + sum(pax2)) FROM  reservas WHERE trip_no2 = ? AND fecha_retorno = ?
       AND estado != 'QUOTE'
       AND estado != 'CANCELED'
       AND estado != 'NOT SHOW W/ CHARGE'
       AND estado != 'NOT SHOW W/O CHARGE'
       AND estado != 'NO SHOW'
       AND id2 = '5') as superdiscount,
       (SELECT (sum(pax) + sum(pax2)) FROM reservas WHERE trip_no2 = ? AND fecha_retorno = ?
       AND estado != 'QUOTE'
       AND estado != 'CANCELED'
       AND estado != 'NOT SHOW W/ CHARGE'
       AND estado != 'NOT SHOW W/O CHARGE'
       AND estado != 'NO SHOW'
       AND id2 = '3') as webfare,
       (SELECT (sum(pax) + sum(pax2)) FROM reservas WHERE trip_no2 = ? AND fecha_retorno = ?
       AND estado != 'QUOTE'
       AND estado != 'CANCELED'
       AND estado != 'NOT SHOW W/ CHARGE'
       AND estado != 'NOT SHOW W/O CHARGE'
       AND estado != 'NO SHOW'
       AND id2 = '1') as standard,
       (SELECT (sum(pax) + sum(pax2)) FROM reservas WHERE trip_no2 = ? AND fecha_retorno = ?
       AND estado != 'QUOTE'
       AND estado != 'CANCELED'
       AND estado != 'NOT SHOW W/ CHARGE'
       AND estado != 'NOT SHOW W/O CHARGE'
       AND estado != 'NO SHOW'
       AND id2 = '2') as superflex,
       (SELECT (sum(pax) + sum(pax2)) FROM  reservas  Where trip_no2 = ? AND fecha_retorno = ?
       AND (type_tour = 'ONE'
       OR type_tour = 'MULTI')
       AND estado != 'QUOTE'
       AND estado != 'CANCELED'
       AND estado != 'NOT SHOW W/ CHARGE'
       AND estado != 'NOT SHOW W/O CHARGE') AS tours,
       (SELECT (sum(pax) + sum(pax2)) FROM  reservas Where trip_no2 = ? AND fecha_retorno = ?
       AND id2 = '6'
       AND estado != 'QUOTE'
       AND estado != 'CANCELED'
       AND estado != 'NOT SHOW W/ CHARGE'
       AND estado != 'NOT SHOW W/O CHARGE') AS especial
       FROM reservas WHERE trip_no2 = ? AND fecha_retorno = ?
       AND estado != 'QUOTE'
       AND estado != 'CANCELED'
       AND estado != 'NOT SHOW W/ CHARGE'
       AND estado != 'NOT SHOW W/O CHARGE'
       AND estado != 'NO SHOW'
       AND id2 = '4'";
         // $rs_spcretorno100 = Doo::db()->query($sql_spcretorno100, array($trip100, $fecha));
         $rs_spcretorno100return = Doo::db()->query($sql_spcretorno100, array($trip_no,$fecha_returnn,$trip_no,$fecha_returnn,$trip_no,$fecha_returnn,$trip_no,$fecha_returnn,$trip_no,$fecha_returnn,$trip_no,$fecha_returnn,$trip_no,$fecha_returnn));
         $r_spcretorno100return = $rs_spcretorno100return->fetchAll();

         $spro_retorno100return = $r_spcretorno100return[0]['superpromo'] ? $r_spcretorno100return[0]['superpromo'] : 0;
         $sdic_retorno100return = $r_spcretorno100return[0]['superdiscount'] ? $r_spcretorno100return[0]['superdiscount'] : 0;
         $wfare_retorno100return = $r_spcretorno100return[0]['webfare'] ? $r_spcretorno100return[0]['webfare'] : 0;
         $standr_retorno100return = $r_spcretorno100return[0]['standard'] ? $r_spcretorno100return[0]['standard'] : 0;
         $sflex_retorno100return = $r_spcretorno100return[0]['superflex'] ? $r_spcretorno100return[0]['superflex'] : 0;
         $special_retorno100return = $r_spcretorno100return[0]['especial'] ? $r_spcretorno100return[0]['especial'] : 0;
         $tour_retorno100return = $r_spcretorno100return[0]['tours'] ? $r_spcretorno100return[0]['tours'] : 0;


         $total_spro100return = $spro_ida100return + $spro_retorno100return ;
         $total_sdic100return = $sdic_ida100return + $sdic_retorno100return ;
         $total_wfare100return = $wfare_ida100return + $wfare_retorno100return ;
         $total_standr100return = $standr_ida100return + $standr_retorno100return ;
         $total_sflex100return = $sflex_ida100return + $sflex_retorno100return ;
         $total_especial100return = $special_ida100return + $special_retorno100return ;
         $total_tours100return = $tour_ida100return + $tour_retorno100return ;

         $ReservasTotalesreturn = $total_spro100return + $total_sdic100return + $total_wfare100return  + $total_standr100return + $total_sflex100return + $total_especial100return + $total_tours100return;
         $resultsuperflexreturn = $total_sflex100return - $superflex_100return;

         $OcupadosTotalesreturn =  $ReservasTotalesreturn + $p_ocupados100return;

          // $cantidadwebfreturn = $puestos[0]['cantwebf'] ? $puestos[0]['cantwebf'] : 0;
          // $cantidadsuperproreturn = $puestos[0]['cantsuperp'] ? $puestos[0]['cantsuperp'] : 0;
          // $cantidadsuperdiscreturn = $puestos[0]['cantsuperdisc'] ? $puestos[0]['cantsuperdisc'] : 0;
          // $cantidadsuperflexreturn = $puestos[0]['cantsuperflex'] ? $puestos[0]['cantsuperflex'] : 0;

           //$numperson100return = $_SESSION['booking']['pax'] + $_SESSION['booking']['chil'];

             $wf_totreturn = ($webfare_100return - $total_wfare100return)-$total_standr100return-$total_especial100return-$total_tours100return-$total_spro100return-$total_sdic100return-$cantidadwebfreturn-$cantidadsuperproreturn-$cantidadsuperdiscreturn -$cantidadsstandarreturn ;

             $sflx_totreturn = ($superflex_100return - $total_sflex100return)-$cantidadsuperflexreturn;

             $spr_totreturn = ($superpromo_100return - $total_spro100return)-$cantidadsuperproreturn;

             $sdc_totreturn = ($superdiscount_100return - $total_sdic100return)-$cantidadsuperdiscreturn;

             if($wf_totreturn < $spr_totreturn){
                 $spr_totreturn = $wf_totreturn;
               }else{
                 $spr_totreturn = $spr_totreturn;
               }

               if($wf_totreturn < $sdc_totreturn){
                 $sdc_totreturn = $wf_totreturn;
               }else{
                 $sdc_totreturn = $sdc_totreturn;
               }

              if ($booking['idPrecioVuelta'] == 3) { //'wFareIda'
                $disp2 = $wf_totreturn ;
              }elseif ($booking['idPrecioVuelta'] == 4) {  //'sPromoIda'
                  $disp2 = $spr_totreturn;
              }elseif ($booking['idPrecioVuelta'] == 5) { //'sDiscIda'
                  $disp2 = $sdc_totreturn;
              }elseif ($booking['idPrecioVuelta'] == 2) { //'sFlexIda'
                $disp2 = $sflx_totreturn;

              }
//             echo '<pre>';
//             print_r( $disp2);
//             echo '</pre>';
//             die;
			if($disp2<0){
			return Doo::conf()->APP_URL.'booking?op=nope1&trip='.base64_encode($trip);
			}

          //  echo '<pre>';
          // print_r($disp2);
          // echo '</pre>';
          // die;
            $trip_no222 = ($trip_no == NULL)? NULL : 'AND tripw'.$trip_no.' = 1';

            $rs = Doo::db()->query("SELECT id, address,valid, place as nombre from pickup_dropoff WHERE id_area = ? AND (SELECT FIND_IN_SET('2', type_pick)) > 0 $trip_no222 AND active_web = ? ORDER BY posicion ASC", array($retorno["tf"], $active_web));
            $pickup2 = $rs->fetchAll();
            // echo '<pre>';
            // // print_r( $trip111);select id as id, (select FIND_IN_SET('4',title))  as existe from Test ;
            // print_r( $pickup2);
            // echo '</pre>';
            // exit();
            $rs2 = Doo::db()->query("SELECT address, valid,place as nombre,id," . $precio_sql . ",valid
					FROM extension WHERE id_area = ? ORDER BY id ASC", array($retorno["tf"]));

            $exten2 = $rs2->fetchAll();

            //////// */ Igualar Extension  pickup 2*/
            $pickupnew2 = array();
            $contador = 0;
            if (!empty($exten2)) {

                foreach ($exten2 as $key => $value) {
                    $value['type'] = 'E';
                    $pickupnew2[$key] = $value;
                    $contador++;
                }


                foreach ($pickup2 as $key => $value) {
                    $value['type'] = 'P';
                    $pickupnew2[$contador] = $value;
                    $contador++;
                }
            } else {
                foreach ($pickup2 as $key => $value) {
                    $value['type'] = 'P';
                    $pickupnew2[$key] = $value;
                }
            }



            ///////////////////////////////////////////////////// */ Cierre de Igualar extension pickup2*/

            $rs = Doo::db()->query("SELECT id, address, valid,  place as nombre from pickup_dropoff
				WHERE id_area = ? AND  (SELECT FIND_IN_SET('2', type_pick)) > 0  $trip_no222 AND active_web = ? ORDER BY posicion ASC", array($retorno["tt"], $active_web));
            $dropoff2 = $rs->fetchAll();
            // echo '<pre>';
            // print_r( $trip_no222);
            // print_r( $pickup1);
            // echo '</pre>';
            // exit();
            $rs3 = Doo::db()->query("SELECT address, valid, place as nombre,id," . $precio_sql . ",valid
											FROM extension
			 where id_area = ? ORDER BY id ASC", array($retorno["tt"]));

            $exten4 = $rs3->fetchAll();

            ///////////////////////////////////////////////////// */ Igualar Extension  dropoff 1 */
            $pickupnew3 = array();
            $contador = 0;

            if (!empty($exten4)) {
                foreach ($exten4 as $key => $value) {
                    $value['type'] = 'E';
                    $pickupnew3[$key] = $value;
                    $contador++;
                }
                foreach ($dropoff2 as $key => $value) {
                    $value['type'] = 'P';
                    $pickupnew3[$contador] = $value;
                    $contador++;
                }
            } else {
                foreach ($dropoff2 as $key => $value) {
                    $value['type'] = 'P';
                    $pickupnew3[$key] = $value;
                }
            }
            if (!isset($_SESSION['data_agency'])) {
                list($mes, $dia, $anyo) = explode("-", $retorno["fecha"]);
                $fecha = $anyo . "-" . $mes . "-" . $dia;
                ///////////////////////////////////////////////////// */ Cierre de Igualar extension dropoff 2*/
                $sqlofer2 = "(SELECT t1.trip_no, t1.id, t1.fecha_ini, t1.fecha_fin, t4.nombre AS trip_from, t5.nombre AS trip_to, t1.price, t1.price2, t1.price3, t1.price4, t1.regular, t1.frecuente, t3.equipment
                         FROM ofertas t1
						 	LEFT JOIN trips  t3 ON (t1.trip_no = t3.trip_no )
							LEFT JOIN areas  t4 ON (t1.trip_from = t4.id)
							LEFT JOIN areas  t5 ON  (t1.trip_to  = t5.id)
                         WHERE t1.trip_from = ?
						 	AND t1.trip_to = ?
							AND t1.fecha_ini <= ?
							AND t1.fecha_fin >= ?
                                                        AND t1.trip_no = ?)
							";


                $rsofer2 = Doo::db()->query($sqlofer2, array($retorno["tf"], $retorno["tt"], strtotime($fecha), strtotime($fecha), $retorno["trip_no"]));
                $ofertas2 = $rsofer2->fetch();
            } else {
                $ofertas2 = "";
            }

            $row_array2 = array();
            if (!empty($ofertas2)) {
                list($mes, $dia, $anyo) = explode("-", $retorno["fecha"]);
                $fechaarray2 = array();
                $fechaarray2 = $anyo . "-" . $mes . "-" . $dia;
                if ($retorno["trip_no"] == $ofertas2["trip_no"] && strtotime($fechaarray2) >= $ofertas2["fecha_ini"] && strtotime($fechaarray2) <= $ofertas2["fecha_fin"]) {
                    $value1 = array(
                        "trip_no" => $ofertas2["trip_no"],
                        "trip_departure" => $retorno["trip_departure"],
                        "trip_arrival" => $retorno["trip_arrival"],
                        "price" => $ofertas2["price"],
                        "price2" => $ofertas2["price2"],
                        "price3" => $ofertas2["price3"],
                        "price4" => $ofertas2["price4"],
                        "oferta" => "1",
                        "fecha" => $retorno["fecha"],
                        "trip_from" => $retorno["trip_from"],
                        "trip_to" => $retorno["trip_to"]
                    );

                    $row_array2 = $value1;
                } else {

                    $row_array2 = $retorno;
                }
            } else{

                foreach ($retorno as $key => $value) {

                    $row_array2[$key] = $value;
                }
            }


            /////////////////////////////////////////////////////// /*CAPACIDAD RUTA RETORNO*/


            $sqlcapa2 = "SELECT t1.id_bus,t1.id_trips,t2.capacidad,t3.trip_no,t2.fecha_fin,t2.fecha_ini	FROM bus_trips t1
									LEFT JOIN bus t2 ON (t1.id_bus = t2.id)
									LEFT JOIN trips t3 ON (t1.id_trips = t3.id)
                                                                        WHERE t3.trip_no = ?  AND t2.fecha_ini <= ? AND t2.fecha_fin >= ?";


            list($mes, $dia, $anyo) = explode("-", $booking["fecha_retorno"]);

            $fecharet = $anyo . "-" . $mes . "-" . $dia;


            $rs = Doo::db()->query($sqlcapa2, array($row_array2['trip_no'], strtotime($fecharet), strtotime($fecharet)));


            $capacidad = $rs->fetchAll();

            $capacity = array();
            $total = 0;
            foreach ($capacidad as $key => $value) {

                $capacity[$key] = $value;
                $total = $total + $value['capacidad'];
            }



            $fecha_ret = $_SESSION['booking']['fecha_retorno'];
            $demanda = $_SESSION['booking']['pax'] + $_SESSION['booking']['chil'];

            $rs = Doo::db()->find("Reserve", array("select" => "COUNT(*) AS total",
                "where" => "fecha_ini = ? AND trip_no = ?",
                "limit" => 1,
                "param" => array($fecha_ret, $row_array2['trip_no'])
            ));
            $totaldispo = $rs->total;
            
            $disponible = ($total - $totaldispo );


            if (isset($disponible) && isset($demanda)) {
                if ($demanda > $disponible) {

                    $_SESSION['msg'] = array("error" => "error", "disponible" => $disponible, "demanda" => $demanda, "trip" => $row_array2['trip_no']);
                    return Doo::conf()->APP_URL . "booking/";
                }
            }

            $this->data['pickup2'] = $pickupnew2;
            $this->data['dropoff2'] = $pickupnew3;
            $this->data['retorno'] = $row_array2;
            $r = $retorno;
        }
        $departure1T= $this->params["time"];
        if(isset($departure1T)){
            echo "llllll".$departure1T;
        }
        $_SESSION['booking']['trip_arrival'] = $this->data['salida']['trip_arrival'];
        $_SESSION['booking']['trip_departure'] = $this->data['salida']['trip_departure'];
        $_SESSION['booking']['trip_arrival2'] = isset($this->data['retorno']['trip_arrival']) ? $this->data['retorno']['trip_arrival'] : '';
        $_SESSION['booking']['trip_departure2'] = isset($this->data['retorno']['trip_departure']) ? $this->data['retorno']['trip_departure'] : '';
        //$_SESSION['booking']['idPrecioIda'] = $datos['idPrecioIda'];
        //$_SESSION['booking']['idPrecioVuelta'] = $datos['idPrecioVuelta'];
        $_SESSION['trip_arrival'] = $this->data['salida']['trip_arrival'];
        $_SESSION['trip_departure'] = $this->data['salida']['trip_departure'];
        $_SESSION['trip_arrival2'] = isset($this->data['retorno']['trip_arrival']) ? $this->data['retorno']['trip_arrival'] : '';
        $_SESSION['trip_departure2'] = isset($this->data['retorno']['trip_departure']) ? $this->data['retorno']['trip_departure'] : '';

        $date = date("Y-m-d");
        $hor = date("H:i");

        if (isset($e['trip_departure']) && isset($r['trip_departure'])) {
            if (strtotime($date) == strtotime($fecha_salida)) {

                if ($hor > $e['trip_departure'] && $booking["fecha_retorno"] == $date) {
                    return Doo::conf()->APP_URL . "booking/";
                }
                if ($hor > $r['trip_departure'] && $booking["fecha_retorno"] == $date) {
                    return Doo::conf()->APP_URL . "booking/";
                }
            }
        }
        //$this->data['datos'] = $datos;
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->renderc('pickupdropoff', $this->data, true);
    }

    public function pickupDropoffMobil(){
        echo $rate = $_POST['rate'];
        echo '<br />'.$rate1 = $_POST['rate1'];
        list($id,$priceAdult,$priceChild,$rate) = explode(',', $rate);
        list($id1,$priceAdult1,$priceChild1,$rate1) = explode(',', $rate1);


        global $variable;
        Doo::loadModel("Agency");


        if (isset($_SESSION['data_agency'])) {
            $dat = new Agency($_SESSION['data_agency']);
            $net_rate = ($dat->type_rate == 1) ? true : false;
            $dat2 = new Agency();
            $dat2->id = $dat->id;
            $dato_exten_n = Doo::db()->getOne($dat2);
            if ($dato_exten_n->precio_especial_exten == 1) {
                $precio_sql = "precio_especial as precio";
            } else if ($net_rate) {
                $precio_sql = "precio_neto as precio";
            } else {
                $precio_sql = "precio";
            }
        } else {
            $dat = new Agency();
            $dat->id = -1;
            $net_rate = false;
            $dat->type_rate = 0;
            $precio_sql = "precio";
        }

        if (isset($_SESSION['msg'])) {
            unset($_SESSION['msg']);
        }

        if ($_SERVER["REQUEST_METHOD"] == "GET") {
            return Doo::conf()->APP_URL . "booking";
        }

        if (isset($_SESSION["booking"])) {
            $booking = $_SESSION["booking"];
            //echo '<pre>';
            //print_r($_SESSION['booking']['idPrecioVuelta'] = $datos['idPrecioVuelta']);
            //echo '</pre>';
            $_SESSION['booking']['idPrecioIda'] = $datos['idPrecioIda'];
            $_SESSION['booking']['idPrecioVuelta'] = $datos['idPrecioVuelta'];
            $fecha_salida = $booking["fecha_salida"];
            $fecha_retorno = $booking["fecha_retorno"];
        } else {
            return Doo::conf()->APP_URL;
        }

        $sql = "SELECT
                t1.trip_no,
                t1.fecha,
                t4.nombre AS trip_from,
                t5.nombre AS trip_to,
                t2.price,
                t2.price2,
                t2.price3,
                t2.price4,
                t2.trip_from as tf,
                t2.trip_to as tt,
                t2.trip_departure,
                t2.trip_arrival
                FROM programacion t1
                LEFT JOIN routes t2 ON (t1.trip_no = t2.trip_no)
                LEFT JOIN trips  t3 ON (t1.trip_no = t3.trip_no)
                LEFT JOIN areas  t4 ON (t2.trip_from = t4.id)
                LEFT JOIN areas  t5 ON  (t2.trip_to  = t5.id)
                WHERE t2.id = ? AND fecha = ?";



        if ($net_rate) {
            $sql_net = "SELECT
                    t1.trip_no,
                    t1.fecha,
                    t4.nombre AS trip_from,
                    t5.nombre AS trip_to,
                    t2.price,
                    t2.price2,
                    t2.price3,
                    t2.price4,
                    t2.trip_from as tf,
                    t2.trip_to as tt,
                    t2.trip_departure,
                    t2.trip_arrival
                    FROM programacion t1
                    LEFT JOIN routes_net t2 ON (t1.trip_no = t2.trip_no)
                    LEFT JOIN trips  t3 ON (t1.trip_no = t3.trip_no)
                    LEFT JOIN areas  t4 ON (t2.trip_from = t4.id)
                    LEFT JOIN areas  t5 ON  (t2.trip_to  = t5.id)
                    WHERE fecha = '" . $booking["fecha_salida"] . "' AND t2.type_rate = 2 and t2.id_agency = '$dat->id' ";
            $sql = "Select ms.trip_no, ms.fecha, ms.trip_from, ms.trip_to, ms.trip_to,
CASE
      WHEN ms.trip_no = k.trip_no THEN k.price
       ELSE ms.price
   END as price ,
CASE
      WHEN ms.trip_no = k.trip_no THEN k.price2
       ELSE ms.price2
   END as price2,
CASE
      WHEN ms.trip_no = k.trip_no THEN k.price3
       ELSE ms.price3
   END as price3,
CASE
      WHEN ms.trip_no = k.trip_no THEN k.price4
       ELSE ms.price4
   END as price4,

  ms.tf,ms.tt,ms.trip_departure,ms.trip_arrival
 From ( " . $sql . " )as ms  LEft JOIN ( " . $sql_net . " ) as k ON ((ms.trip_no = k.trip_no) and (k.trip_from = ms.trip_from) AND (ms.trip_to = k.trip_to)  )";
        }
        //Tipo de pickup_dropoff;
        if ($dat->id == -1) {
            $active_web = 1;
        } else {
            $active_web = 0;
        }
        //echo 'trip1 =>'.$_POST["trip1"];

        if (isset($id)) {
            $trip1 = $_SESSION['booking']['trip1'];
            $rs = Doo::db()->query($sql, array($id, $booking["fecha_salida"]));
            $salida = $rs->fetch();
            //print_r($salida);
            $rs = Doo::db()->query("select id, address, place as nombre,valid from pickup_dropoff where id_area = ? AND active_web = ? ORDER BY id ASC", array($salida["tf"], $active_web));

            $pickup1 = $rs->fetchAll();

            $rs2 = Doo::db()->query("SELECT address, valid, place as nombre,id," . $precio_sql . ",valid
				FROM extension
			 where id_area = ? ORDER BY id ASC", array($salida["tf"]));

            $exten1 = $rs2->fetchAll();
            //echo 'hola';
            ///////////////////////////////////////////////////// */ Igualar Extension  pickup 1*/
            $pickupnew = array();
            $contador = 0;
            if (!empty($exten1)) {
                foreach ($exten1 as $key => $value) {
                    $value['type'] = 'E';
                    $pickupnew[$key] = $value;
                    $contador++;
                }
                foreach ($pickup1 as $key => $value) {
                    $value['type'] = 'P';
                    $pickupnew[$contador] = $value;
                    $contador++;
                }
            } else {
                foreach ($pickup1 as $key => $value) {
                    $value['type'] = 'P';
                    $pickupnew[$key] = $value;
                }
            }



            //////////Cierre de Igualar extension */


            $rs = Doo::db()->query("SELECT id, address, valid, place AS nombre FROM pickup_dropoff
                                        WHERE id_area = ? AND active_web = ? ORDER BY nombre ASC", array($salida["tt"], $active_web));
            $dropoff1 = $rs->fetchAll();

            $rs3 = Doo::db()->query("SELECT address, valid, place as nombre,id," . $precio_sql . ",valid
					FROM extension
                                    where id_area = ? ORDER BY id ASC", array($salida["tt"]));

            $exten2 = $rs3->fetchAll();

            ///////////////////////////////////////////////////// */ Igualar Extension  dropoff 1 */
            $pickupnew2 = array();
            $contador = 0;

            if (!empty($exten2)) {
                foreach ($exten2 as $key => $value) {
                    $value['type'] = 'E';
                    $pickupnew2[$key] = $value;
                    $contador++;
                }
                foreach ($dropoff1 as $key => $value) {
                    $value['type'] = 'P';
                    $pickupnew2[$contador] = $value;
                    $contador++;
                }
            } else {
                foreach ($dropoff1 as $key => $value) {
                    $value['type'] = 'P';
                    $pickupnew2[$key] = $value;
                }
            }
            if (!isset($_SESSION['data_agency'])) {
                list($mes, $dia, $anyo) = explode("-", $salida["fecha"]);
                $fecha = $anyo . "-" . $mes . "-" . $dia;
                ///////////////////////////////////////////////////// */ Cierre de Igualar extension */
                ///////////////////////////////////////////////////// */ Igualar Ofertas */
                $sqlofer = "(SELECT t1.trip_no, t1.id, t1.fecha_ini, t1.fecha_fin, t4.nombre AS trip_from, t5.nombre AS trip_to, t1.price, t1.price2, t1.price3, t1.price4, t1.regular, t1.frecuente,                          t3.equipment
						FROM ofertas t1
							LEFT JOIN trips  t3 ON ( t1.trip_no = t3.trip_no )
							LEFT JOIN areas  t4 ON (t1.trip_from = t4.id)
							LEFT JOIN areas  t5 ON  (t1.trip_to  = t5.id)
						WHERE t1.trip_from = ?
							AND t1.trip_to = ?
							AND t1.fecha_ini <= ?
							AND t1.fecha_fin >= ?
							AND t1.trip_no = ?)";
                $rsofer = Doo::db()->query($sqlofer, array($salida["tf"], $salida["tt"], strtotime($fecha), strtotime($fecha), $salida["trip_no"]));
                $ofertas = $rsofer->fetch();
            } else {
                $ofertas = "";
            }

            $row_array = array();

            if (!empty($ofertas)) {

                list($mes, $dia, $anyo) = explode("-", $salida["fecha"]);


                $fechaarray = array();
                $fechaarray = $anyo . "-" . $mes . "-" . $dia;

                if ($salida["trip_no"] == $ofertas["trip_no"] && strtotime($fechaarray) >= $ofertas["fecha_ini"] && strtotime($fechaarray) <= $ofertas["fecha_fin"]) {
                    $value1 = array(
                        "trip_no" => $ofertas["trip_no"],
                        "trip_departure" => $salida["trip_departure"],
                        "trip_arrival" => $salida["trip_arrival"],
                        "price" => $ofertas["price"],
                        "price2" => $ofertas["price2"],
                        "price3" => $ofertas["price3"],
                        "price4" => $ofertas["price4"],
                        "oferta" => "1",
                        "fecha" => $salida["fecha"],
                        "trip_from" => $salida["trip_from"],
                        "trip_to" => $salida["trip_to"]
                    );
                    $row_array = $value1;
                } else {
                    $row_array = $salida;
                }
                // echo $row_array[""]."<br>";
            } else {
                foreach ($salida as $key => $value) {
                    $row_array[$key] = $value;
                }
            }

            ///////////////////////////////////////////////////// */ Cierre de Igualar Ofertas */
            /////////////////////////////////////////////////////// /*CAPACIDAD RUTA IDA*/


            $sqlcapa = "SELECT t1.id_bus,t1.id_trips,t2.capacidad,t3.trip_no,t2.fecha_fin,t2.fecha_ini

									FROM bus_trips t1

									LEFT JOIN bus t2 ON (t1.id_bus = t2.id)
									LEFT JOIN trips t3 ON (t1.id_trips = t3.id)

										WHERE t3.trip_no = ?  AND t2.fecha_ini <= ? AND t2.fecha_fin >= ?
                         ";


            list($mes, $dia, $anyo) = explode("-", $fecha_salida);

            $fechaida = $anyo . "-" . $mes . "-" . $dia;


            $rs = Doo::db()->query($sqlcapa, array($row_array['trip_no'], strtotime($fechaida), strtotime($fechaida)));


            $capacidad = $rs->fetchAll();

            $capacity = array();
            $total = 0;
            foreach ($capacidad as $key => $value) {
                $capacity[$key] = $value;
                $total = $total + $value['capacidad'];
            }

            $fecha_sali = $_SESSION['booking']['fecha_salida'];
            $demanda = $_SESSION['booking']['pax'] + $_SESSION['booking']['chil'];

            $rs = Doo::db()->find("Reserve", array("select" => "COUNT(*) AS total",
                "where" => "fecha_ini = ? AND trip_no = ?",
                "limit" => 1,
                "param" => array($fecha_sali, $row_array['trip_no'])
            ));
            $totaldispo = $rs->total;

            $disponible = ($total - $totaldispo );


            if (isset($disponible) && isset($demanda)) {
                if ($demanda > $disponible) {

                    $_SESSION['msg'] = array("error" => "error", "disponible" => $disponible, "demanda" => $demanda, "trip" => $row_array['trip_no']);
                    return Doo::conf()->APP_URL . "booking/";
                }
            }
            ////////////////////////////////////////////////////////////// /* CIERRE CAPACIDAD RUTA */

            $this->data['salida'] = $row_array;
            $this->data['pickup1'] = $pickupnew;
            $this->data['dropoff1'] = $pickupnew2;
            $e = $salida;
        }

        if (isset($id1)) {

            $rs = Doo::db()->query($sql, array($id1, $booking["fecha_retorno"]));
            $retorno = $rs->fetch();

            $rs = Doo::db()->query("select id, address,valid,  place as nombre from pickup_dropoff
			WHERE id_area = ? AND active_web = ? ORDER BY nombre ASC", array($retorno["tf"], $active_web));
            $pickup2 = $rs->fetchAll();

            $rs2 = Doo::db()->query("SELECT address, valid,place as nombre,id," . $precio_sql . ",valid
											FROM extension
			 where id_area = ? ORDER BY id ASC", array($retorno["tf"]));

            $exten2 = $rs2->fetchAll();

            ///////////////////////////////////////////////////// */ Igualar Extension  pickup 2*/
            $pickupnew2 = array();
            $contador = 0;
            if (!empty($exten2)) {

                foreach ($exten2 as $key => $value) {
                    $value['type'] = 'E';
                    $pickupnew2[$key] = $value;
                    $contador++;
                }


                foreach ($pickup2 as $key => $value) {
                    $value['type'] = 'P';
                    $pickupnew2[$contador] = $value;
                    $contador++;
                }
            } else {
                foreach ($pickup2 as $key => $value) {
                    $value['type'] = 'P';
                    $pickupnew2[$key] = $value;
                }
            }



            ///////////////////////////////////////////////////// */ Cierre de Igualar extension pickup2*/

            $rs = Doo::db()->query("select id, address, valid,  place as nombre from pickup_dropoff
				WHERE id_area = ? AND active_web = ?  ORDER BY id ASC", array($retorno["tt"], $active_web));
            $dropoff2 = $rs->fetchAll();

            $rs3 = Doo::db()->query("SELECT address, valid, place as nombre,id," . $precio_sql . ",valid
											FROM extension
			 where id_area = ? ORDER BY id ASC", array($retorno["tt"]));

            $exten4 = $rs3->fetchAll();

            ///////////////////////////////////////////////////// */ Igualar Extension  dropoff 1 */
            $pickupnew3 = array();
            $contador = 0;

            if (!empty($exten4)) {
                foreach ($exten4 as $key => $value) {
                    $value['type'] = 'E';
                    $pickupnew3[$key] = $value;
                    $contador++;
                }
                foreach ($dropoff2 as $key => $value) {
                    $value['type'] = 'P';
                    $pickupnew3[$contador] = $value;
                    $contador++;
                }
            } else {
                foreach ($dropoff2 as $key => $value) {
                    $value['type'] = 'P';
                    $pickupnew3[$key] = $value;
                }
            }
            if (!isset($_SESSION['data_agency'])) {
                list($mes, $dia, $anyo) = explode("-", $retorno["fecha"]);
                $fecha = $anyo . "-" . $mes . "-" . $dia;
                ///////////////////////////////////////////////////// */ Cierre de Igualar extension dropoff 2*/
                $sqlofer2 = "(SELECT t1.trip_no, t1.id, t1.fecha_ini, t1.fecha_fin, t4.nombre AS trip_from, t5.nombre AS trip_to, t1.price, t1.price2, t1.price3, t1.price4, t1.regular, t1.frecuente, t3.equipment
                         FROM ofertas t1
						 	LEFT JOIN trips  t3 ON (t1.trip_no = t3.trip_no )
							LEFT JOIN areas  t4 ON (t1.trip_from = t4.id)
							LEFT JOIN areas  t5 ON  (t1.trip_to  = t5.id)
                         WHERE t1.trip_from = ?
						 	AND t1.trip_to = ?
							AND t1.fecha_ini <= ?
							AND t1.fecha_fin >= ?
                                                        AND t1.trip_no = ?)
							";


                $rsofer2 = Doo::db()->query($sqlofer2, array($retorno["tf"], $retorno["tt"], strtotime($fecha), strtotime($fecha), $retorno["trip_no"]));
                $ofertas2 = $rsofer2->fetch();
            } else {
                $ofertas2 = "";
            }

            $row_array2 = array();
            if (!empty($ofertas2)) {
                list($mes, $dia, $anyo) = explode("-", $retorno["fecha"]);
                $fechaarray2 = array();
                $fechaarray2 = $anyo . "-" . $mes . "-" . $dia;
                if ($retorno["trip_no"] == $ofertas2["trip_no"] && strtotime($fechaarray2) >= $ofertas2["fecha_ini"] && strtotime($fechaarray2) <= $ofertas2["fecha_fin"]) {
                    $value1 = array(
                        "trip_no" => $ofertas2["trip_no"],
                        "trip_departure" => $retorno["trip_departure"],
                        "trip_arrival" => $retorno["trip_arrival"],
                        "price" => $ofertas2["price"],
                        "price2" => $ofertas2["price2"],
                        "price3" => $ofertas2["price3"],
                        "price4" => $ofertas2["price4"],
                        "oferta" => "1",
                        "fecha" => $retorno["fecha"],
                        "trip_from" => $retorno["trip_from"],
                        "trip_to" => $retorno["trip_to"]
                    );

                    $row_array2 = $value1;
                } else {

                    $row_array2 = $retorno;
                }
            } else {

                foreach ($retorno as $key => $value) {

                    $row_array2[$key] = $value;
                }
            }


            /////////////////////////////////////////////////////// /*CAPACIDAD RUTA RETORNO*/


            $sqlcapa2 = "SELECT t1.id_bus,t1.id_trips,t2.capacidad,t3.trip_no,t2.fecha_fin,t2.fecha_ini

									FROM bus_trips t1

									LEFT JOIN bus t2 ON (t1.id_bus = t2.id)
									LEFT JOIN trips t3 ON (t1.id_trips = t3.id)

										WHERE t3.trip_no = ?  AND t2.fecha_ini <= ? AND t2.fecha_fin >= ?
                         ";


            list($mes, $dia, $anyo) = explode("-", $booking["fecha_retorno"]);

            $fecharet = $anyo . "-" . $mes . "-" . $dia;


            $rs = Doo::db()->query($sqlcapa2, array($row_array2['trip_no'], strtotime($fecharet), strtotime($fecharet)));


            $capacidad = $rs->fetchAll();

            $capacity = array();
            $total = 0;
            foreach ($capacidad as $key => $value) {

                $capacity[$key] = $value;
                $total = $total + $value['capacidad'];
            }



            $fecha_ret = $_SESSION['booking']['fecha_retorno'];
            $demanda = $_SESSION['booking']['pax'] + $_SESSION['booking']['chil'];

            $rs = Doo::db()->find("Reserve", array("select" => "COUNT(*) AS total",
                "where" => "fecha_ini = ? AND trip_no = ?",
                "limit" => 1,
                "param" => array($fecha_ret, $row_array2['trip_no'])
            ));
            $totaldispo = $rs->total;




            $disponible = ($total - $totaldispo );


            if (isset($disponible) && isset($demanda)) {
                if ($demanda > $disponible) {

                    $_SESSION['msg'] = array("error" => "error", "disponible" => $disponible, "demanda" => $demanda, "trip" => $row_array2['trip_no']);
                    return Doo::conf()->APP_URL . "booking/";
                }
            }

            $this->data['pickup2'] = $pickupnew2;
            $this->data['dropoff2'] = $pickupnew3;
            $this->data['retorno'] = $row_array2;
            $r = $retorno;


        }
        $_SESSION['booking']['trip_arrival'] = $this->data['salida']['trip_arrival'];
        $_SESSION['booking']['trip_departure'] = $this->data['salida']['trip_departure'];
        $_SESSION['booking']['trip_arrival2'] = isset($this->data['retorno']['trip_arrival']) ? $this->data['retorno']['trip_arrival'] : '';
        $_SESSION['booking']['trip_departure2'] = isset($this->data['retorno']['trip_departure']) ? $this->data['retorno']['trip_departure'] : '';
        //$_SESSION['booking']['idPrecioIda'] = $datos['idPrecioIda'];
        //$_SESSION['booking']['idPrecioVuelta'] = $datos['idPrecioVuelta'];
        $_SESSION['trip_arrival'] = $this->data['salida']['trip_arrival'];
        $_SESSION['trip_departure'] = $this->data['salida']['trip_departure'];
        $_SESSION['trip_arrival2'] = isset($this->data['retorno']['trip_arrival']) ? $this->data['retorno']['trip_arrival'] : '';
        $_SESSION['trip_departure2'] = isset($this->data['retorno']['trip_departure']) ? $this->data['retorno']['trip_departure'] : '';

        $date = date("Y-m-d");
        $hor = date("H:i");

        if (isset($e['trip_departure']) && isset($r['trip_departure'])) {
            if (strtotime($date) == strtotime($fecha_salida)) {

                if ($hor > $e['trip_departure'] && $booking["fecha_retorno"] == $date) {
                    return Doo::conf()->APP_URL . "booking/";
                }
                if ($hor > $r['trip_departure'] && $booking["fecha_retorno"] == $date) {
                    return Doo::conf()->APP_URL . "booking/";
                }
            }
        }
        //print_r($datos);
        $this->data['datos'] = $datos;
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->renderc('pickupdropoffMobil', $this->data, true);
    }

    function messageReserveUserAgencyOneWay($tipo = array("N/A", "N/A")) {
        Doo::loadModel("Agency");
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        if (isset($_SESSION['data_agency'])) {
            $dat = new Agency($_SESSION['data_agency']);
            Doo::loadModel("UserA");
            $datos = unserialize($_SESSION['uagency']);

            $agencia_name = $dat->company_name;
            $agencia_usuario = $datos->firstname . " " . $datos->lastname;
        } else {
            $agencia_name = "N/A";
            $agencia_usuario = "N/A";
        }

        $booking = $_SESSION['booking'];
        list($mes, $dia, $anyo) = explode("-", $booking['fecha_salida']);
        $fecha = $anyo . "-" . $mes . "-" . $dia;
        if ($_SESSION['booking']['fecha_retorno'] != "N/A") {
            list($mes1, $dia1, $anyo1) = explode("-", $booking['fecha_retorno']);
            $fecha1 = $anyo1 . "-" . $mes1 . "-" . $dia1;
        }
        $login = $_SESSION['user'];

        $var = explode('-', $tipo[1]);
        $tipoPago = strtoupper($var[0]);
        $totalpax = $booking['pax'] + $booking['chil'];
        $otheramount = isset($_SESSION['booking']['otheramount']) ? $_SESSION['booking']['otheramount'] : 0;
        $pago = ( ($otheramount == 0) ? $_SESSION['booking']['totaltotal'] : $otheramount );
        $pago = number_format($pago, 2, '.', ',');
//Mail editado
        return ("
<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
<html xmlns='http://www.w3.org/1999/xhtml'>
    <head>

	<!-- view port meta tag -->
	<meta name='viewport' content='width=device-width, initial-scale=1'>
	<meta http-equiv='X-UA-Compatible' content='IE=edge' />
	<title>Mail</title>
    <style type='text/css'>
        /* hacks */
        * { -webkit-text-size-adjust:none; -ms-text-size-adjust:none; max-height:1000000px;}
        table {border-collapse: collapse !important;}
        #outlook a {padding:0;}
        .ReadMsgBody { width: 100%; }
        .ExternalClass { width: 100%; }
        .ExternalClass * { line-height: 100%; }
        .ios_geo a { color:#1c1c1c !important; text-decoration:none !important; }

        #clearTable {
                /*width: 800px;*/
                font-size: 13px;
                font-family: Verdana, Geneva, sans-serif;
        }
        #clearTable tr #titletd3 {
                font-family: Verdana, Geneva, sans-serif;
        }
        #clearTable tr #titletd2 {
                font-size: 20px;
        }
        #clearTable tr td p {
                text-align: center;
        }
        #clearTable td{
            padding: 0 5px;
        }
        #content #center-column #tdgris {
                background-color: #F0F0F0;
        }
        #content #center-column #tdrojo {
                background-color: #FFE6E6;
        }
        #content #center-column1 #titletd {
                background-color: #F5EDEB;
                padding-left: 5px;
                font-size: 12px;
        }
         #titlett {
                background-color: #E8E8E8;
                padding-left: 5px;
                font-size: 12px;
        }
         #titlell {
                padding-left: 5px;
                font-size: 12px;
                border-bottom-width: 1px;
                border-left-width: 1px;
                border-bottom-style: solid;
                border-left-style: solid;
                border-bottom-color: #E6E6E6;
                border-left-color: #E6E6E6;
        }
        #titlelp {
                padding-left: 5px;
                font-size: 12px;
                border-bottom-width: 1px;
                border-bottom-style: solid;
                border-bottom-color: #E6E6E6;
        }
         #titlelr {
                padding-left: 5px;
                font-size: 12px;
                border-top-width: 1px;
                border-top-style: solid;
                border-top-color: #CE0000;
                color: #CE0000;
        }
         #tdgristable {
                background-color: #FFF;
                padding-left: 5px;
        }
        *[class].borderTableT{  border: 1px solid #d4d4d4; }
        *[class].bgTableHT{  background-color: #f1f1f1; }
        *[class].bgE-TICKETT{  background-color: #585351; color: #fff; }
        *[class].textLeftT{  text-align: left; }
        </style>
    </head>
    <body>
    <div align='center'>
    <br/>
        <table   id='clearTable' class='borderTableT'>
            <tr class='bgTableHT'>
                <td width='316' height='33' rowspan='3' id='titletd3'>
                    <img src='".$this->data['rootUrl']."global/estilos/logo.png' width='316' height='88' />
                </td>
                <td colspan='3' align='center' id='titletd3'>
                    <a href='http://www.supertours.com'>Supertours.com</a>
                </td>
            </tr>
            <tr class='bgTableHT'>
                <td height='35' colspan='3' id='titletd5'>
                    Date/Time of Booking: " . $_SESSION['booking']['fecha_ini'] . " / " . $_SESSION['booking']['hora'] . "
                </td>
            </tr>
            <tr >
              <td height='35' colspan='3' id='titletd4'>Agency: <span style='color: #1B58E5'>$agencia_name</span>, Usuario : <span style='color: #1B58E5'>$agencia_usuario</span></td>
           </tr>
            <tr class='bgE-TICKETT'>
              <td align='center' height='33' colspan='4' id='titletd2'>" . $_SESSION['booking']['ticke'] . " E-TICKET</td>
            </tr>
            <tr>
                <td colspan='4'>
                    <div align='center'>
                        <table width='98%'>
                            <td height='15' id='titletd6'>LEAD TRAVELER: " . $_POST['firstname'] . " " . $_POST['lastname'] . " </td>
                            <td width='145' height='15' id='titletd6'>&nbsp;</td>
                            <td colspan='2' id='titletd6'>AD : " . $_SESSION['booking']['pax'] . "<strong>  </strong>CHD : " . $_SESSION['booking']['chil'] . " <strong> TOTAL</strong> : " . $totalpax . "</td>
                        </table>
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <div align='center'>
                        <table width='98%'>
                            <td height='16' id='titletd7'>&nbsp;</td>
                            <td height='16' id='titletd7' class='textLeftT'>Status: CONFIRMED</td>
                            <td width='197' height='16' id='titletd7'>Confirmation # " . $_SESSION['booking']['codconf'] . "</td>
                            <td width='122' height='16' id='titletd7'>Paid by: " . $tipo[0] . "</td>
                        </table>
                    </div>
                </td>
            </tr>
            <tr>
               <td height='45' colspan='4' id='titletd'> <p><strong>ORDER&nbsp;  CONFIRMATION</strong> + " . $_SESSION['booking']['ticke'] . " </p></td>
            </tr>
            <tr>
                <td colspan='4' >
                    <div align='center'>

                        <table width='90%' height='125' id='tableorder'>
                            <tr>
                                <td  width='34%' height='35' id='titlett'  ><strong>Departure Date: </strong>" . date('l', strtotime($fecha)) . ", " . date('M-d-Y', strtotime($fecha)) . "  </td>
                                <td  id='titlett' width='26%'><strong>TRIP # :</strong> " . $_SESSION['booking']['trip_no'] . "</td>
                                <td  id='titlett' width='40%'><strong>DEPARTURE TIME :</strong> " . date('g:i a', strtotime($_SESSION['booking']['trip_departure'])) . "</td>
                            </tr>
                            <tr>
                                <td height='41'><strong>From :</strong> " . $_SESSION['booking']['from_name'] . "</td>
                                <td colspan='2'><strong>Pick up Point / Extensions :</strong> " . $_SESSION['booking']['place1'] . " , " . $_SESSION['booking']['hotelarea1'] . "</td>
                            </tr>
                            <tr>
                                <td height='39'><strong>To </strong>:" . $_SESSION['booking']['to_name'] . "</td>
                                <td colspan='2'><strong>Drop Off / Extensions :</strong> " . $_SESSION['booking']['address1'] . " , " . $_SESSION['booking']['hotelarea2'] . "</td>
                            </tr>
                        </table>

                    </div>
                    <div align='center'>

                        <table id='tableorder2' width='90%'>
                            <tr>
                              <td  align='center' height='35' id='titlett2'  >Please print and present this e-ticket for boarding<br />
                                Please arrive at departure point 30 minutes before the scheduled time</td>
                            </tr>
                        </table>

                    </div>
                    <div align='center'>
                        <table id='tableorder3' width='90%'>
                            <tr>
                              <td  height='35' colspan='3' bgcolor='#DDD7D7' id='titlett3'  aling='center' >RECEIPT</td>
                              </tr>
                            <tr>
                              <td width='34%' height='28'>Card Holder Information</td>
                              <td colspan='2'>Billing Address </td>
                              </tr>
                            <tr>
                              <td height='27'>Name : " . $_POST['firstname'] . " </td>
                              <td colspan='2'>Address : " . $login->address . "</td>
                              <td colspan='2'>Phone : " . $login->phone . "</td>
                              </tr>
                            <tr>
                              <td height='27'>Last Name : " . $_POST['lastname'] . "</td>
                              <td colspan='2'>City : " . $login->city . "</td>
                              </tr>
                            <tr>
                              <td height='27'>E-mail : " . $login->username2 . "</td>
                              <td>State : " . $login->state . "</td>
                              <td>Country :" . $login->country . "</td>
                              </tr>
                            <tr>
                              <td height='27'>Lead Traveler : " . $_POST['firstname'] . " " . $_POST['firstname'] . "</td>
                              <td colspan='2'>Zip / Postal Code : " . $login->zip . " </td>
                              </tr>
                        </table>
                    </div>
                    <p><br/>
                    </p>
                </td>
            </tr>
            <tr>
                <td colspan='4'>
                    <div align='center'>
                        <table width='90%' border='0' cellpadding='3' id='tableorder'>
                            <tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td  id='titlelr' align='center' colspan='2'> " . $tipoPago . "</td>
                                <td id='titlelr'><strong>$  " . $pago . " </strong></td>
                            </tr>
                        </table>
                    </div>
                    <div align='center'>
                        <table width='90%' border='0' cellpadding='3'>
                            <tr align='center'>
	    			<td colspan='5' class=''>
                                    <h4><span style='color: #326AC0'>Comentarios:</span>&nbsp; </h4>
                                      <span style='color:rgb(223, 44, 44);'>" . $_SESSION['booking']['comentarios'] . "</span>
                                      <p>Non-refundable - non-transferable - no changes are allowed on dates or time of departure - no pets allowed on board -<br />
                                        luggage restrictions apply - Please read the terms of transportation at www.supertours.com<br />
                                        THANK YOU FOR CHOOSING US<br />
                                        HAVE A NICE TRIP<br />
                                        SUPER TOURS.<br />
                                        Phone: (407) 370-3001 Orlando / (305) 677-2676 Miami / e-mail: reservations@supertours.com

                                    </p>
                                </td>
                            </tr>
                        </table>
                    </div>
                </td>
            </tr>
            <tr>
                <td colspan='4' align='center'>
                    <p align='center' class='titulopago'>
                    </p>
                </td>
            </tr>
        </table>
    </div>
</body>
</html>
");
    }

    function messageReserveUserAgencyRoundtrip($tipo = array("N/A", "N/A")) {
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        if (isset($_SESSION['data_agency'])) {
            $dat = new Agency($_SESSION['data_agency']);
            Doo::loadModel("UserA");
            $datos = unserialize($_SESSION['uagency']);

            $agencia_name = $dat->company_name;
            $agencia_usuario = $datos->firstname . " " . $datos->lastname;
        } else {
            $agencia_name = "N/A";
            $agencia_usuario = "N/A";
        }
        list($mes, $dia, $anyo) = explode("-", $_SESSION['booking']['fecha_salida']);
        $fecha = $anyo . "-" . $mes . "-" . $dia;
        if ($_SESSION['booking']['fecha_retorno'] != "N/A") {
            list($mes1, $dia1, $anyo1) = explode("-", $_SESSION['booking']['fecha_retorno']);
            $fecha1 = $anyo1 . "-" . $mes1 . "-" . $dia1;
        }
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $login = $_SESSION['user'];

        $var = explode('-', $tipo[1]);
        $tipoPago = strtoupper($var[0]);
        $totalpax = $_SESSION['booking']['pax'] + $_SESSION['booking']['chil'];
        $otheramount = isset($_SESSION['booking']['otheramount']) ? $_SESSION['booking']['otheramount'] : 0;
        $pago = ( ($otheramount == 0) ? $_SESSION['booking']['totaltotal'] : $otheramount );
        $pago = number_format($pago, 2, '.', ',');
        return ("
                <!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
<html xmlns='http://www.w3.org/1999/xhtml'>
    <head>

	<!-- view port meta tag -->
	<meta name='viewport' content='width=device-width, initial-scale=1'>
	<meta http-equiv='X-UA-Compatible' content='IE=edge' />
	<title>Mail</title>
    <style type='text/css'>
        /* hacks */
        * { -webkit-text-size-adjust:none; -ms-text-size-adjust:none; max-height:1000000px;}
        table {border-collapse: collapse !important;}
        #outlook a {padding:0;}
        .ReadMsgBody { width: 100%; }
        .ExternalClass { width: 100%; }
        .ExternalClass * { line-height: 100%; }
        .ios_geo a { color:#1c1c1c !important; text-decoration:none !important; }

        #clearTable {
                /*width: 800px;*/
                font-size: 13px;
                font-family: Verdana, Geneva, sans-serif;
        }
        #clearTable tr #titletd3 {
                font-family: Verdana, Geneva, sans-serif;
        }
        #clearTable tr #titletd2 {
                font-size: 20px;
        }
        #clearTable tr td p {
                text-align: center;
        }
        #clearTable td{
            padding: 0 5px;
        }
        #content #center-column #tdgris {
                background-color: #F0F0F0;
        }
        #content #center-column #tdrojo {
                background-color: #FFE6E6;
        }
        #content #center-column1 #titletd {
                background-color: #F5EDEB;
                padding-left: 5px;
                font-size: 12px;
        }
         #titlett {
                background-color: #E8E8E8;
                padding-left: 5px;
                font-size: 12px;
        }
         #titlell {
                padding-left: 5px;
                font-size: 12px;
                border-bottom-width: 1px;
                border-left-width: 1px;
                border-bottom-style: solid;
                border-left-style: solid;
                border-bottom-color: #E6E6E6;
                border-left-color: #E6E6E6;
        }
        #titlelp {
                padding-left: 5px;
                font-size: 12px;
                border-bottom-width: 1px;
                border-bottom-style: solid;
                border-bottom-color: #E6E6E6;
        }
         #titlelr {
                padding-left: 5px;
                font-size: 12px;
                border-top-width: 1px;
                border-top-style: solid;
                border-top-color: #CE0000;
                color: #CE0000;
        }
         #tdgristable {
                background-color: #FFF;
                padding-left: 5px;
        }
        *[class].borderTableT{  border: 1px solid #d4d4d4; }
        *[class].bgTableHT{  background-color: #f1f1f1; }
        *[class].bgE-TICKETT{  background-color: #585351; color: #fff; }
        *[class].textLeftT{  text-align: left; }
        </style>
    </head>
    <body>
        <div align='center'>
        <br />
        <table  id='clearTable' class='borderTableT'>
             <tr class='bgTableHT'>
               <td width='316' height='33' rowspan='3' id='titletd3'><img src='".$this->data['rootUrl']."global/estilos/logo.png' width='316' height='88' /></td>
               <td colspan='3' align='center' id='titletd3'>Supertours.com</td>
             </tr>
             <tr class='bgE-TICKETT'>
               <td height='35' colspan='3' id='titletd5'>Date/Time of Booking: " . $_SESSION['booking']['fecha_ini'] . " / " . $_SESSION['booking']['hora'] . "</td>
            </tr>
            <tr>
               <td height='35' colspan='3' id='titletd4'>Agency: <span style='color: #1B58E5'>$agencia_name</span>, Usuario : <span style='color: #1B58E5'>$agencia_usuario</span></td>
            </tr>
             <tr>
               <td align='center' height='33' colspan='4' id='titletd2'>" . $_SESSION['booking']['ticke'] . " E-TICKET</td>
             </tr>
             <tr>
               <td height='15' id='titletd6'>LEAD TRAVELER:  " . $_POST['firstname'] . " " . $_POST['lastname'] . " </td>
               <td width='145' height='15' id='titletd6'>&nbsp;</td>
               <td colspan='2' id='titletd6'>AD : " . $_SESSION['booking']['pax'] . "<strong>  </strong>CHD : " . $_SESSION['booking']['chil'] . " <strong> TOTAL</strong> : " . $totalpax . "</td>
             </tr>
             <tr>
               <td height='16' id='titletd7'>&nbsp;</td>
               <td height='16' id='titletd7'>Status: CONFIRMED</td>
               <td width='197' height='16' id='titletd7'>Confirmation # " . $_SESSION['booking']['codconf'] . "</td>
               <td width='122' height='16' id='titletd7'>Paid by: " . $tipo[0] . "</td>
             </tr>
             <tr>
            <td height='45' colspan='4' id='titletd'> <p><strong>ORDER&nbsp;  CONFIRMATION</strong> + " . $_SESSION['booking']['ticke'] . " </p></td>
            </tr>
          <tr>
                <td colspan='4' ><table width='90%' height='125' id='tableorder'>
                  <tr>
                        <td  width='34%' height='35' id='titlett'  ><strong>Departure Date: </strong>" . date('l', strtotime($fecha)) . ", " . date('M-d-Y', strtotime($fecha)) . "  </td>
                        <td  id='titlett' width='26%'><strong>TRIP # :</strong> " . $_SESSION['booking']['trip_no'] . "</td>
                        <td  id='titlett' width='40%'><strong>DEPARTURE TIME :</strong> " . date('g:i a', strtotime($_SESSION['booking']['trip_departure'])) . "</td>
                  </tr>
                  <tr>
                        <td height='41'><strong>From :</strong> " . $_SESSION['booking']['from_name'] . "</td>
                        <td colspan='2'><strong>Pick up Point / Extensions :</strong> " . $_SESSION['booking']['place1'] . " , " . $_SESSION['booking']['hotelarea1'] . "</td>
                  </tr>
                  <tr>
                        <td height='39'><strong>To </strong>:" . $_SESSION['booking']['to_name'] . "</td>
                        <td colspan='2'><strong>Drop Off / Extensions :</strong> " . $_SESSION['booking']['address1'] . " , " . $_SESSION['booking']['hotelarea2'] . "</td>
                        </tr>
          </table>

           <table id='tableorder' width='90%'>
                  <tr>
                        <td id='titlett'  width='34%' height='35'  ><strong> Return Date :</strong> " . date('l', strtotime($fecha1)) . ", " . date('M-d-Y', strtotime($fecha1)) . "  , </td>
                        <td id='titlett' width='26%'><strong>TRIP # :</strong> " . $_SESSION['booking']['trip_no2'] . "</td>
                        <td id='titlett' width='40%'><strong>DEPARTURE TIME :</strong> " . date('g:i a', strtotime($_SESSION['booking']['trip_departure2'])) . "</td>
                  </tr>
                  <tr>
                        <td height='28'><strong>From :</strong> " . $_SESSION['booking']['to_name'] . "</td>
                        <td colspan='2'><strong>Pick up Point / Extensions :</strong> " . $_SESSION['booking']['place2'] . " , " . $_SESSION['booking']['hotelarea3'] . "</td>
                  </tr>
                  <tr>
                        <td height='27'><strong>To :</strong>" . $_SESSION['booking']['from_name'] . "</td>
                        <td colspan='2'><strong>Drop Off / Extensions :</strong> " . $_SESSION['booking']['address2'] . ", " . $_SESSION['booking']['hotelarea4'] . "</td>
                        </tr>
                </table>


                <table id='tableorder2' width='90%'>
                  <tr>
                        <td  align='center' height='35' id='titlett2'  >Please print and present this e-ticket for boarding<br />
                          Please arrive at departure point 30 minutes before the scheduled time</td>
                        </tr>
                </table>
                <table id='tableorder3' width='90%'>
                  <tr>
                        <td  height='35' colspan='3' id='titlett3'  aling='center' >RECEIPT</td>
                        </tr>
                  <tr>
                        <td width='34%' height='28'>Card Holder Information</td>
                        <td colspan='2'>Billing Address </td>
                  </tr>
                  <tr>
                        <td height='27'>Name : " . $_POST['firstname'] . " </td>
                        <td colspan='2'>Address : " . $login->address . "</td>
                         <td colspan='2'>Phone : " . $login->phone . "</td>
                  </tr>
                  <tr>
                        <td height='27'>Last Name : " . $_POST['lastname'] . "</td>
                        <td colspan='2'>City : " . $login->city . "</td>
                  </tr>
                  <tr>
                        <td height='27'>E-mail : " . $login->username2 . "</td>
                        <td>State : " . $login->state . "</td>
                        <td>Country :" . $login->country . "</td>
                  </tr>
                  <tr>
                        <td height='27'>Lead Traveler : " . $_POST['firstname'] . " " . $_POST['lastname'] . "</td>
                        <td colspan='2'>Zip / Postal Code : " . $login->zip . " </td>
                  </tr>
                </table>
                <p><br />
          </p></td>
          </tr>
          <tr>
                <td height='33' colspan='4' id='titletd' ><strong>PRICE</strong></td>
          </tr>
          <tr>
                <td colspan='4'><table width='90%' border='0' cellpadding='3' id='tableorder'>

                  <tr>
                        <td height='31' colspan='5' align='center' id='titlell2'>&nbsp;</td>
                  </tr>
                  <tr>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td colspan='2' align='center' class='Estilo1'  id='titlelr2'> " . $tipoPago . "</td>
                        <td id='titlelr2'><span class='Estilo2'>$  " . $pago . "</span></td>
                  </tr>

                </table>
                  <h4><span style='color: #326AC0'>Comentarios:</span>&nbsp; </h4>
<span style='color:rgb(223, 44, 44);'>" . $_SESSION['booking']['comentarios'] . "</span>
<p>Non-refundable - non-transferable - no changes are allowed on dates or time of departure - no pets allowed on board -<br />
                  luggage restrictions apply - Please read the terms of transportation at www.supertours.com<br />
                  THANK YOU FOR CHOOSING US<br />
                  HAVE A NICE TRIP<br />
                  SUPER TOURS.<br />
                  Phone: (407) 370-3001 Orlando / (305) 677-2676 Miami / e-mail: reservations@supertours.com

                </p></td>
          </tr>
          <tr>
                <td colspan='4' align='center'> <p align='center' class='titulopago'>

        </p>       </td>

          </tr>
          </table>



        </div></body>
</html>");
    }

    public function guestcard()
    {

        Doo::loadModel("Signup");
        $this->data['rootUrl'] = Doo::conf()->APP_URL;

        $_SESSION['infoforms'] = $_POST;
//        echo '<pre>';
//        print_r($_SESSION);
//        echo '</pre>';
//        die;
//        return Doo::conf()->APP_URL . "booking/pickup-dropoff/autentication/signup/saveGuest";
        $this->renderc('guestcard', $this->data);
    }

    public function saveGuest(){

      Doo::loadModel("Signup");
//    echo '<pre>';
//    print_r($_SESSION);
//    echo '</pre>';
//    die;
      $this->data['rootUrl'] = Doo::conf()->APP_URL;
      $signup = new Signup($_REQUEST);
      // $sql = "SELECT name from country where id=?";
      $rs = Doo::db()->find("Country",array("select"=>"name","where"=>"id=?","param"=>array($_REQUEST['country'])));
      $country = $rs[0]->name;
      if ($_REQUEST['country'] == 248) {
        $rsstate = Doo::db()->find("State",array("select"=>"name","where"=>"id=?","param"=>array($_REQUEST['state'])));
        $state = $rsstate[0]->name;
      }else{
        $state = "OTHERS";
      }
      // print_r($state);
      // die;
      $signup->fecha_r = date("m-d-Y  H:i:s");
      $signup->firstname = $_REQUEST['firstname'];
      $signup->lastname = $_REQUEST['lastname'];
//      $signup->phone = "3016779303";
//      $signup->address = "Calle del Cuartel";
      $signup->zip = $_REQUEST['zip'];
      $signup->state = $state;
      $signup->country = $country;
      
      

      //Registered user
      $signup2 = new stdclass();

      if (isset($_SESSION['infoforms']['passingName1'])) {
        $signup2->person1 = array("nombre1"=>$_SESSION['infoforms']['passingName1'],"apelli1"=>$_SESSION['infoforms']['passinglast1'],"email1"=>$_SESSION['infoforms']['passingMail']);
      }
      if (isset($_SESSION['infoforms']['passingName2'])) {
        $signup2->person2 = array("nombre2"=>$_SESSION['infoforms']['passingName2'],"apelli2"=>$_SESSION['infoforms']['passinglast2']);
      }
       if (isset($_SESSION['infoforms']['passingName3'])) {
      $signup2->person3 = array("nombre3"=> $_SESSION['infoforms']['passingName3'],"apelli3"=>$_SESSION['infoforms']['passinglast3']);
      }
       if (isset($_SESSION['infoforms']['passingName4'])) {
      $signup2->person4 = array("nombre4"=>$_SESSION['infoforms']['passingName4'],"apelli4"=>$_SESSION['infoforms']['passinglast4']);
      }
       if (isset($_SESSION['infoforms']['passingName5'])) {
      $signup2->person5 = array("nombre5"=>$_SESSION['infoforms']['passingName5'],"apelli5"=>$_SESSION['infoforms']['passinglast5']);
      }
       if (isset($_SESSION['infoforms']['passingName6'])) {
      $signup2->person6 = array("nombre6"=>$_SESSION['infoforms']['passingName6'],"apelli6"=>$_SESSION['infoforms']['passinglast6']);
      }
       if (isset($_SESSION['infoforms']['passingName7'])) {
      $signup2->person7 = array("nombre7"=>$_SESSION['infoforms']['passingName7'],"apelli7"=>$_SESSION['infoforms']['passinglast7']);
      }
       if (isset($_SESSION['infoforms']['passingName8'])) {
      $signup2->person7 = array("nombre8"=>$_SESSION['infoforms']['passingName8'],"apelli8"=>$_SESSION['infoforms']['passinglast8']);
      }

      if (isset($_SESSION['infoforms']['childName1'])) {
        $signup2->child1 = array("nombre1"=>$_SESSION['infoforms']['childName1'],"apelli1"=>$_SESSION['infoforms']['childlast1']);
      }
      if (isset($_SESSION['infoforms']['childName2'])) {
        $signup2->child2 = array("nombre2"=>$_SESSION['infoforms']['childName2'],"apelli2"=>$_SESSION['infoforms']['childlast2']);
      }
       if (isset($_SESSION['infoforms']['childName3'])) {
      $signup2->child3 = array("nombre3"=> $_SESSION['infoforms']['childName3'],"apelli3"=>$_SESSION['infoforms']['childlast3']);
      }
       if (isset($_SESSION['infoforms']['childName4'])) {
      $signup2->child4 = array("nombre4"=>$_SESSION['infoforms']['childName4'],"apelli4"=>$_SESSION['infoforms']['childlast4']);
      }
       if (isset($_SESSION['infoforms']['childName5'])) {
      $signup2->child5 = array("nombre5"=>$_SESSION['infoforms']['childName5'],"apelli5"=>$_SESSION['infoforms']['childlast5']);
      }
       if (isset($_SESSION['infoforms']['childName6'])) {
      $signup2->child6 = array("nombre6"=>$_SESSION['infoforms']['childName6'],"apelli6"=>$_SESSION['infoforms']['childlast6']);
      }
       if (isset($_SESSION['infoforms']['childName7'])) {
      $signup2->child7 = array("nombre7"=>$_SESSION['infoforms']['childName7'],"apelli7"=>$_SESSION['infoforms']['childlast7']);
      }
       if (isset($_SESSION['infoforms']['childName8'])) {
      $signup2->child8 = array("nombre8"=>$_SESSION['infoforms']['childName8'],"apelli8"=>$_SESSION['infoforms']['childlast8']);
      }


      // $person = json_enconde(array(""));
      // $c=0;

// for ($i=1; $i <= 8; $i++) {
  // $c = $c+1;
  // eval("/$val=/$signup2->firstname.$c");
  // $val = $_REQUEST['passingName'.$i];
    // $a = $person1;
      // echo "<pre>";
      // print_r($a);
      // echo "</pre>";
// }

      $signup2->username2 = $_SESSION['infoforms']['passingMail'];    //$signup->username;
      $signup2->username = $signup->username;
      $signup2->firstname =  $signup->firstname;
      $signup2->lastname = $signup->lastname;
      $signup2->guest = true;
      $signup2->tipo_client = 0;
      $signup2->zip = $_REQUEST['zip'];

      //Billing address
      $signup2->phone = $signup->phone;
      $signup2->city = $signup->city;
      $signup2->state = $state;
      $signup2->country = $country;
          $new = false;
          if ($signup->birthday != "") {
              $signup->tipo_client = 1;
          } else {
              $signup->tipo_client = 0;
          }
          if ($_POST['id'] == "") {
              $signup->id = Null;
              $new = true;
          }
          // print_r($signup);
          // die;
      $signup2->fecha_r = $signup->fecha_r;
      $signup2->error = "";
//        echo "<pre>";
//        print_r($signup2);
//        echo "</pre>";
//        die;

      $_SESSION['signup2'] = $signup2;
//        echo '<pre>';
//        print_r($_SESSION);
//        echo '</pre>';
//        die;
          $this->data['rootUrl'] = Doo::conf()->APP_URL;
          if ($new) {
               Doo::db()->insert($signup);
               $signup->firstname = $_REQUEST['firstname'];
               $signup->lastname = $_REQUEST['lastname'];
          // print_r($signup);
          // die;
              if (isset($_POST['username']) && isset($_POST['firstname'])) {
                  $login = new stdclass();
                  $login->username = $signup->username;
                  // $login->firstname =  $_REQUEST['passingName'];
                  // $login->lastname = $_REQUEST['passinglast'];
                  $login->firstname = $signup->firstname;
                  $login->lastname = $signup->lastname;
//                    $login->state = $signup->state;
//                    $login->address = $signup->address;
                  $login->tipo_client = $signup->tipo_client;
                  $login->zip = $signup->zip;
                  $login->phone = $signup->phone;
                  $login->celphone = $signup->celphone;
                  $login->address = $signup->address;
                  $login->state = $signup->state;
                  $login->city = $signup->city;
                  $login->country = $signup->country;
                  $login->id = Doo::db()->lastInsertId();
                  $_SESSION['user'] = $login;
                  return Doo::conf()->APP_URL . "booking/pickup-dropoff/autentication/shopuser";
              }
          } else {
              Doo::db()->update($signup);
          }
      return Doo::conf()->APP_URL . "booking/pickup-dropoff/autentication/guest";
  }



    function emailReserveUserAgency($reserves) {
        Doo::loadModel("Reserve");
        $reserve = new Reserve();
        $reserve = $reserves;
        try {
            $login = $_SESSION['user'];
            if (isset($_POST['email'])) {
                $NomCliente = $_POST['firstname'] . ' ' . $_POST['lastname'];
                $correoCliente = $_POST['email'];
            } else {
                $correoCliente = '';
            }
            Doo::loadController('DatosMailController');
            $datosMail = new DatosMailController();
            $mail4 = new PHPMailer(true);
            $mail4 = $datosMail->datos();
            $tipo = array($reserve->tipo_pago, $reserve->pago);
            $mail4->AddAddress($login->username2, $login->firstname . ' ' . $login->lastname);
            if ($correoCliente != '') {
                $mail4->AddAddress($correoCliente, $NomCliente);
            }
            if ($_SESSION['booking']['tipo_ticket'] == "oneway") {
                $mail4->MsgHTML($this->messageReserveUserAgencyOneWay($tipo));
            } else {
                $mail4->MsgHTML($this->messageReserveUserAgencyRoundtrip($tipo));
            }
            $mail4->Send();
        } catch (phpmailerException $e) {
            echo $e->errorMessage(); //Errores de PhpMailer
        } catch (Exception $e) {
            echo $e->getMessage(); //Errores de cualquier otra cosa.
        }
    }

    public function aprovado() {
      
      $cargo = $this->params["cargosf"];
      $cliente = $this->params["clientef"];
      
      $this->data['rootUrl'] = Doo::conf()->APP_URL;
      $this->data['cargo'] = $cargo;
      $this->data['cliente'] = $cliente;
      
     
      // $login = new stdclass();
      // $user = Doo::db()->find("clientes",array("select"=>"*","where"=>"id=?","param"=>array($_SESSION['user']->id)));
      // echo '<pre>';
      // print_r($user[0]->firstname);
      // echo '</pre>';
      // die;

      if (isset($_SESSION['signup2']) AND $_SESSION['signup2']->guest == 1) {
          session_destroy();
      }
      if (isset($_SESSION['signup3'])) {
        session_destroy();
    }
      // else{
      //   $_SESSION['user'] = $user[0]->firstname;
      // }
      $this->renderc('approval', $this->data, true);
  }

    // public function aprovado() {
    //     $this->data['rootUrl'] = Doo::conf()->APP_URL;
    //     $this->renderc('approval', $this->data, true);
    // }

    public function mostrar() {
        $sql = "SELECT seats_remain FROM routes WHERE trip_from = '1' AND trip_to = '3' AND fecha_ini = '2017-12-29' AND trip_no = '100'";
        $res = Doo::db()->query($sql);
        $resul = $res->fetchAll();
        foreach ($resul as $r) {
            echo $r['seats_remain'];
        }
    }

    public function load() {//esta función es la que guarda en la bd después del pago
        
              
        $cargoJson = $this->params["cargoJson"];
        $clienteJson = $this->params["clienteJson"];       
        
        
        $charge = urldecode($cargoJson);
        $chargedec= json_decode($charge, true);
        
        $cliente = urldecode($clienteJson);
        $clientedec = json_decode($cliente, true);
        
//        echo '<pre>';
//              
//          print_r($chargedec);
//
//        echo '</pre>';
//        
//        echo '<pre>';
//              
//          print_r($clientedec);
//
//        echo '</pre>';
//        
//        die;
        
        //cargos
        $ssl_approval_code = $chargedec['transactionID'];
        $code_confirmation = $chargedec['code_confirmation'];
        $paidAmount = $chargedec['paidAmount'];
        $paidCurrency = $chargedec['paidCurrency'];
        $payment_status = $chargedec['payment_status'];
        $created = $chargedec['created'];
        $funding = $chargedec['funding'];
        $brand = $chargedec['brand'];
        $last4 = $chargedec['last4'];
        $mailc = $chargedec['mailc'];
        $cardhn = $chargedec['cardhn'];
        $ssl_card_number = "************".$last4;
        
        //datos cliente
        
        $ssl_first_name = $clientedec['ssl_first_name'];
        $ssl_last_name = $clientedec['ssl_last_name'];
        $ssl_phone = $clientedec['ssl_phone'];
        $ssl_phone_reg = $clientedec['ssl_phone_reg'];
        $ssl_country = $clientedec['ssl_country'];
        $ssl_state = $clientedec['ssl_state'];
        $ssl_city = $clientedec['ssl_city'];
        $ssl_zip_code = $clientedec['ssl_zip_code'];
        $ssl_passengers_name = $clientedec['ssl_passengers_name'];
        $ssl_email = $clientedec['ssl_email']; 
        $ssl_email_reg = $clientedec['ssl_email_reg']; 
        $ssl_address = $clientedec['ssl_avs_address'];  
        $ssl_id_cliente = $clientedec['ssl_id_cliente']; 
        $ssl_usuario = $clientedec['ssl_usuario']; 
        
        
        
        
        $cargosf ='{"transactionID":"'.$ssl_approval_code.'","code_confirmation":"'.$code_confirmation.'","paidAmount":"'.$paidAmount.'","paidCurrency":"'.$paidCurrency.'","payment_status":"'.$payment_status.'","created":"'.$created.'","funding":"'.$funding.'","brand":"'.$brand.'","last4":"'.$last4.'","mailc":"'.$mailc.'","cardhn":"'.$cardhn.'"}';
        $clientef = '{"ssl_usuario":"'.$ssl_usuario.'","ssl_first_name":"'.$ssl_first_name.'","ssl_last_name":"'.$ssl_last_name.'","ssl_phone":"'.$ssl_phone.'","ssl_phone_reg":"'.$ssl_phone_reg.'","ssl_country":"'.$ssl_country.'","ssl_state":"'.$ssl_state.'","ssl_city":"'.$ssl_city.'","ssl_zip_code":"'.$ssl_zip_code.'","ssl_passengers_name":"'.$ssl_passengers_name.'","ssl_email":"'.$ssl_email.'","ssl_email_reg":"'.$ssl_email_reg.'","ssl_avs_address":"'.$ssl_address.'","ssl_id_cliente":"'.$ssl_id_cliente.'"}';
             
        
        //$ssl_first_name = $this->params["ssl_first_name"];
        //$ssl_last_name = $this->params["ssl_last_name"];
        //echo $ssl_approval_code;
        //die;
              //  $_SESSION['booking']['codconf'] = 'WR191005647';
              //  $_SESSION['booking']['fecha_ini'] = 'Oct-05-2019';
              //  $_SESSION['booking']['hora'] = '01:15:03';
         //$approval='';
//         $_GET['ssl_approval_code'] = '123456';
//         $_GET['ssl_card_number'] = '54321';
//         
//         
//         $approval='txn_1IgssdFtNeZxSwSYTLSMulj7';

        
        try {
              $contenido12 = "";
              Doo::loadController('DatosMailController');
              $datosMail = new DatosMailController();
              $mail = new PHPMailer(true);
              $mail2 = $datosMail->datos();
              $contenido12 .= '<pre>' . print_r($chargedec, true) . '</pre>'."others : ".'<pre>' . print_r($clientedec, true) . '</pre>'."booking : ".'<pre>' . print_r($_SESSION['booking'], true) . '</pre>';
              $contenido12 .= "<span style='color:red;'>Informacion del cardholder </span>";              
//              echo $contenido12;
//              die;
              $mail->Host = $mail2->Host;
              $mail->From = $mail2->From;
              $mail->FromName = "Super Tours";
              $mail->Subject = "Info del user (cardholder)".$ssl_first_name." ".$ssl_last_name;
              $mail->AddAddress("arturo@supertours.com");    //En este espacio debe ir un correo de respaldo.
              $mail->AddBCC("arbusmad2021@gmail.com");
              //$mail->AddCC("bustamante3@hotmail.com");    //En este espacio debe ir un correo de respaldo.

      $mail->MsgHTML($contenido12);
      $mail->Send();
      } catch (phpmailerException $e) {
          echo $e->errorMessage(); //Errores de PhpMailer
      } catch (Exception $e) {
          echo $e->getMessage(); //Errores de cualquier otra cosa.
      }
      
      

        if (isset($_SESSION['user']) && isset($_SESSION['booking'])) {
            $login = $_SESSION['user'];
            $booking = $_SESSION['booking'];
            
//            print_r($login);
//            die;
            if ($login->tipo_client != 2) {
                  if (isset($ssl_approval_code) && isset($_SESSION['booking']['codconf'])) {
                    //esta línea no se debe descomentar $_SESSION['booking']['codconf'] = $_SESSION['booking']['codconf'] . "_" . $_GET['ssl_approval_code'];
                    $approval = $ssl_approval_code;
                } else {
                    return Doo::conf()->APP_URL . "booking/pickup-dropoff/autentication/";
                }
            }
        }

        /* esta parte debe ser descomentadas, solo las comento para poder pasar sin la verificacion del programa */


         //id de transaccion
        Doo::loadModel("Reserve");
        Doo::loadModel("Agency");
        $reserve = new Reserve();
		// &&  isset($_GET['ssl_approval_code'])
        if (isset($_SESSION["booking"])) {
            if (isset($ssl_card_number)) {
                $_SESSION['booking']['card_number'] = $ssl_card_number;
            } else {
                $_SESSION['booking']['card_number'] = "N/A";
            }
            if (isset($_SESSION['tipo'])) {
                $tipo = $_SESSION['tipo'];
                $_SESSION['booking']['total2'] = $_SESSION['booking']['totaltotal'];
                if (isset($tipo->agencia) && isset($tipo->otheram)) {
                    $_SESSION['booking']['agen'] = $tipo->agencia;
                    $_SESSION['booking']['totaltotal'] = $tipo->otheram;
                } else {
                    $_SESSION['booking']['agen'] = "N/A";
                }
                if (isset($tipo->otheram)) {
                    $_SESSION['booking']['totaltotal'] = $tipo->otheram;
                }
            }

            $booking = $_SESSION["booking"];
            if (isset($ssl_approval_code)) {
                $tipo->pago = "TOTAL AMOUNT PAID";
                $tipo->comment = "PAID ONLINE";
            }
            if (isset($tipo->comment)) {
                $_SESSION['booking']['comments'] = $tipo->comment;
            }
            $reserve = new Reserve($_SESSION['booking']);

            $new = true;
            $this->data['rootUrl'] = Doo::conf()->APP_URL;
            $login = $_SESSION['user'];
            $user2 = $_SESSION['infoforms']; //DATOS DEL INVITADO
            
//            print_r($_SESSION['infoforms']);
//            die;
                 
            
            
//            print_r($_SESSION['user']);
//            die;

           //$rs = Doo::db()->find("Country",array("select"=>"name","where"=>"id=?","param"=>array($_REQUEST['ssl_country'])));
           // $country = $rs[0]->name;
            $country = $ssl_country;

            $state = $ssl_state;
            // if ($_REQUEST['ssl_country'] == 248) {
            //     $rsstate = Doo::db()->find("State",array("select"=>"name","where"=>"id=?","param"=>array($_REQUEST['ssl_state'])));
            //     $state = $rsstate[0]->name;
            // }else{  $state = "OTHERS"; }

//            if(isset($ssl_usuario)){
//                //echo $ssl_usuario; 
//                //die;
//            }
            if (isset($_SESSION['infoforms'])) { // SE INSERTA EN CLIENTE SI ES INVITADO
            
            $email_invitado = utf8_decode($user2['passingMail']);
            $firstname_invitado = utf8_decode($user2['passingName1']); 
            $lastname_invitado = utf8_decode($user2['passinglast1']);
//            print($email_invitado);
//            die;
                
            Doo::loadModel("Signup");
            $login = new Signup($clientedec);
//            $login = new stdclass();

            // print_r($state);
            // die;
            $login->fecha_r = date("m-d-Y  H:i:s");
            $login->firstname = $_SESSION['infoforms']['passingName1'];
            $login->lastname = $_SESSION['infoforms']['passinglast1'];
            $login->username = $_SESSION['infoforms']['passingMail'];
            $login->zip = $ssl_zip_code;
            $login->state = $ssl_state;
            $login->country = $ssl_country;
            $login->city =  $ssl_city;
            $login->phone = $ssl_phone;
            $login->address = $ssl_address;


            if ($login->birthday != "") { $login->tipo_client = 1; } else { $login->tipo_client = 0; }
            if ($_POST['id'] == "") {
                $login->id = Null;
                $new = true;
            }
            if ($login->birthday != "") {
                $login->tipo_client = 1;
            } else {
                $login->tipo_client = 0;
            }

            Doo::db()->insert($login);
            // $login->id = Doo::db()->lastInsertId();
            $login->id  = Doo::db()->lastInsertId();
            $login->firstname = $ssl_first_name;
            $login->lastname = $ssl_last_name;
            $login->username = $ssl_email;
            $login->phone = $ssl_phone;
            $_SESSION['user'] = $login;
          }
            // $signup2 = $_SESSION['signup2'];

            if (isset($_SESSION['tipo'])) {
                $tipo = $_SESSION['tipo'];
                $reserve->tipo_pago = $tipo->tipo;
                $tipo_pago = $tipo->tipo;
                $fpago = "CREDIT CARD WITH FEE-FULL";
            }
            if ($new) {
                if (isset($_SESSION['data_agency'])) {
                    $dat = new Agency($_SESSION['data_agency']);
                } else {
                    $dat = new Agency();
                    $dat->id = -1;
                    $dat->type_rate = 0;
                }
                Doo::loadModel("Reserve");
                list ($mes, $dia, $anyo) = explode("-", $_SESSION['booking']['fecha_salida']);
                $fecha_salida = $anyo . "-" . $mes . "-" . $dia;
                if ($_SESSION['booking']['tipo_ticket'] == 'roundtrip') {
                    list ($mes2, $dia2, $anyo2) = explode("-", $_SESSION['booking']['fecha_retorno']);
                    $fecha_retorno = $anyo2 . "-" . $mes2 . "-" . $dia2;
                } else {
                    $fecha_retorno = 'N/A';
                }
                $tipo_pago = 'PRED-PAID';
                $total_neto = $_SESSION['booking']['totaltotal'];
                $otheramount = (isset($_SESSION['booking']['otheramount'])) ? $_SESSION['booking']['otheramount'] : 0;
                $reserves = new Reserve();

                // echo '<pre>';
                //     print_r($login->username);
                // echo '</pre>'; die;
                $reserves->id_tours = -1;
                $reserves->id1 = $_SESSION['booking']['idPrecioIda'];

                if ($_SESSION['booking']['idPrecioVuelta'] == null) {
                    $_SESSION['booking']['idPrecioVuelta'] = 0;
                }
                $reserves->id2 = $_SESSION['booking']['idPrecioVuelta'];

                $reserves->type_tour = '';
                $reserves->fecha_ini = date('Y-m-d');
                $reserves->trip_no = $_SESSION['booking']['trip_no'];
                $reserves->trip_no2 = $_SESSION['booking']['trip_no2'];
                $reserves->tipo_ticket = $_SESSION['booking']['tipo_ticket'];
                $reserves->fromt = $_SESSION['booking']['fromt'];
                $reserves->tot = $_SESSION['booking']['tot'];
                if($_SESSION['booking']['tipo_ticket'] === 'oneway'){
                    $reserves->fromt2 = 0;
                    $reserves->tot2 = 0;
                }else{
                    $reserves->fromt2 = $_SESSION['booking']['tot'];
                    $reserves->tot2 = $_SESSION['booking']['fromt'];
                }
//        echo '<pre>';
////        print_r($_SESSION['infoforms']);
//        print_r($_SESSION['infoforms']);
//        echo '</pre>';
//        die;
                if (isset($_SESSION['infoforms'])) {
                    $reserves->firsname = $_SESSION['infoforms']['passingName1'];
                    $reserves->lasname = $_SESSION['infoforms']['passinglast1'];
                    $reserves->email = $_SESSION['infoforms']['passingMail'];
                }else{
                    $reserves->firsname = $_SESSION['booking']['firsname1'] ;
                    $reserves->lasname = $_SESSION['booking']['lasname1'];
                    $reserves->email = $_SESSION['booking']['email'];
                }

                // if (isset($_SESSION['booking']['email'])) {
                //     $reserves->email = $login->username;
                // } else {
                //     if (!isset($_SESSION['data_agency'])) {
                //         $reserves->email = $login->username;
                //     }
                // }
                // if (!isset($_SESSION['data_agency'])) {
                //   if (isset($user2) && $user2->guest == 1) {
                //     $reserves->email = $user2->username2;
                //   }else{
                //     $reserves->email = $user2->username2;
                //   }
                // }

                $reserves->op_pago = 3;
                $reserves->op_pago_conductor = 3;
                $reserves->tarifa_one = $reserves->id1;
                $reserves->tarifa_round = $reserves->id2;
                /* precios de los trip ida */
                $reserves->precio_trip1_a = $_SESSION['booking']['price'];
                $reserves->precio_trip1_c = $_SESSION['booking']['pricer'];

                /* precios de los trip vuelta */
                $reserves->precio_trip2_a = $_SESSION['booking']['priceadult'];
                $reserves->precio_trip2_c = $_SESSION['booking']['pricechil'];

                /* precios Totales para adulto y ninios */
                $reserves->precioA = $_SESSION['booking']['totaladul'];
                if ($_SESSION['booking']['chil'] > 0) {
                    $reserves->precioN = ($_SESSION['booking']['totalchil']);
                } else {
                    $reserves->precioN = 0;
                }

                /* fechas para el tarifarios */
                $reserves->fecha_salida = $fecha_salida;
                $reserves->fecha_salida_ns = $fecha_salida;
                $reserves->fecha_retorno = $fecha_retorno;
                $reserves->fecha_retorno_ns = $fecha_retorno;


                $reserves->deptime1 = $_SESSION['booking']['trip_departure'];
                $reserves->deptime2 = isset($_SESSION['booking']['trip_departure2']) ? $_SESSION['booking']['trip_departure2'] : '';
                $reserves->arrtime1 = $_SESSION['booking']['trip_arrival'];
                $reserves->arrtime2 = isset($_SESSION['booking']['trip_arrival2']) ? $_SESSION['booking']['trip_arrival2'] : '';

                //$reserves->precioA = $_SESSION['booking']['totaladul'];
                //$reserves->precioN = ($_SESSION['booking']['chil'] > 0) ? $total_neto - $_SESSION['booking']['totaladul'] : 0;

                $reserves->extension1 = $_SESSION['booking']['extension1'];
                $reserves->precio_e1 = $_SESSION['booking']['precio_e1'];
                $reserves->precio_exten1_a = $_SESSION['booking']['precio_e1'];
                $reserves->precio_exten1_c = $_SESSION['booking']['precio_e1'];
                $reserves->pickup_exten1 = $_SESSION['booking']['hotelarea1'];
                $reserves->extension2 = $_SESSION['booking']['extension2'];
                $reserves->precio_e2 = $_SESSION['booking']['precio_e2'];
                $reserves->precio_exten2_a = $_SESSION['booking']['precio_e2'];
                $reserves->precio_exten2_c = $_SESSION['booking']['precio_e2'];
                $reserves->pickup_exten2 = $_SESSION['booking']['hotelarea2'];
                $reserves->extension3 = $_SESSION['booking']['extension3'];
                $reserves->precio_e3 = $_SESSION['booking']['precio_e3'];
                $reserves->precio_exten3_a = $_SESSION['booking']['precio_e3'];
                $reserves->precio_exten3_c = $_SESSION['booking']['precio_e3'];
                $reserves->pickup_exten3 = $_SESSION['booking']['hotelarea3'];
                $reserves->extension4 = $_SESSION['booking']['extension4'];
                $reserves->precio_e4 = $_SESSION['booking']['precio_e4'];
                $reserves->precio_exten4_a = $_SESSION['booking']['precio_e4'];
                $reserves->precio_exten4_c = $_SESSION['booking']['precio_e4'];
                $reserves->pickup_exten4 = $_SESSION['booking']['hotelarea4'];

                $reserves->pred_paid_amount = $total_neto;
                $reserves->total_paid = $total_neto;

                $reserves->pax = $_SESSION['booking']['pax'];
                $reserves->pax2 = $_SESSION['booking']['chil'];
                $reserves->pax3 =  0;
                if($_SESSION['booking']['tipo_ticket'] == 'roundtrip'){
                  $reserves->pax_r =  $_SESSION['booking']['pax'];
                  $reserves->pax2_r = $_SESSION['booking']['chil'];
                  $reserves->pax3_r = 0;
                }else{
                  $reserves->pax_r = 0;
                  $reserves->pax2_r = 0;
                  $reserves->pax3_r = 0;
                }
                // print_r($_SESSION['booking']['tipo_ticket']);
                // die;
                
                //echo "Usuario: ".$ssl_usuario;
                //
//                echo "Email Invitado: ".$email_invitado;
//                die;
                
                if($ssl_usuario == "Invitado"){
                    
                
                    $sql_inv = "SELECT DISTINCT username, id, firstname,lastname, phone , `password`, city, state, country, address, zip                     
                                FROM clientes  WHERE username = '$email_invitado' AND `password` = '' ORDER BY id DESC LIMIT 0,1;";
                    $rs_inv = Doo::db()->query($sql_inv);
                    $reg_inv = $rs_inv->fetchAll(); 

                    //print_r($reg_inv);
                    //die;

                    foreach($reg_inv as $rinv){
                        $id_invitado = $rinv['id'];
                        $user_name_invitado = $rinv['username'];
                        $first_name_invitado = $rinv['firstname'];
                        $last_name_invitado = $rinv['lastname'];
                        $phone_invitado = $rinv['phone'];
                    }
                   
                    $reserves->id_clientes = $id_invitado;
                
                }else{
                    //(isset($_SESSION['user'])){     
                    
                    $register = $_SESSION['user'];
                    $regis = json_decode( json_encode($register), true );
                    
                    $ssl_first_name = $clientedec['ssl_first_name'];
                    $ssl_last_name = $clientedec['ssl_last_name'];
                    $ssl_phone = $clientedec['ssl_phone'];
                    $ssl_phone_reg = $clientedec['ssl_phone_reg'];
                    $ssl_country = $clientedec['ssl_country'];
                    $ssl_state = $clientedec['ssl_state'];
                    $ssl_city = $clientedec['ssl_city'];
                    $ssl_zip_code = $clientedec['ssl_zip_code'];
                    $ssl_passengers_name = $clientedec['ssl_passengers_name'];
                    $ssl_email = $clientedec['ssl_email']; 
                    $ssl_email_reg = $clientedec['ssl_email_reg']; 
                    $ssl_address = $clientedec['ssl_avs_address'];  
                    $ssl_id_cliente = $clientedec['ssl_id_cliente']; 
                    $ssl_usuario = $clientedec['ssl_usuario']; 
                    
                            
                    
                    
                    
            
                    //print_r($regis);
                    //die;
                    $email_registrado = utf8_decode($regis['username']);
                    $firstname_registrado = utf8_decode($regis['firstname']); 
                    $lastname_registrado = utf8_decode($regis['lastname']);
                    
//                    print($email_registrado);
//                    die;
//                    
                    $sql_reg = "SELECT DISTINCT username, id, firstname,lastname, phone , `password`, city, state, country, address, zip  FROM clientes WHERE username = '$email_registrado' AND `password` != '' ORDER BY id DESC LIMIT 0,1";
                    $rs_reg = Doo::db()->query($sql_reg);
                    $registrados = $rs_reg->fetchAll();
                    

                    foreach ($registrados as $reg) {
                        $id_user = $reg['id'];
                        $email_user = $reg['username'];
                        $phone_user = $reg['phone'];
                        $city_user = $reg['city'];
                        $state_user = $reg['state'];
                        $country_user = $reg['country'];
                        $address_user = $reg['address'];
                        $zip_user = $reg['zip'];
                        $firstname = $reg['firstname'];
                        $lastname = $reg['lastname'];

                    }           
                    
                    //if (isset($_SESSION['user'])) {
                        $reserves->id_clientes = $id_user;
                        
                        Doo::db()->query('UPDATE clientes SET phone = "'.$ssl_phone.'", city = "'.$ssl_city.'", state = "'.$ssl_state.'", country = "'.$ssl_country.'", address = "'.$ssl_address.'", zip = "'.$ssl_zip_code.'" WHERE id = "' . $id_user . '"');
                    //}
                    
                }
                
                            
//                if (isset($_SESSION['user'])) {
//                    $reserves->id_clientes = $ssl_id_cliente;
//                    
//                }else{
//                    $reserves->id_clientes = $login->id;               
//                }
                //$reserves->id_clientes = $login->id;
                $reserves->pickup1 = $_SESSION['booking']['pickup1'];
                $reserves->dropoff1 = $_SESSION['booking']['dropoff1'];
                $reserves->pickup2 = $_SESSION['booking']['pickup2'];
                $reserves->dropoff2 = $_SESSION['booking']['dropoff2'];
                $reserves->tipo_pago = $tipo_pago;
                $reserves->pago = $fpago;
                $reserves->total_charge = $_SESSION['booking']['fee'];

                ///

                $reserves->ip_op = 480;
                $reserves->totaltotal = ($total_neto);
                $reserves->otheramount = $_SESSION['booking']['otheramount'];
                $reserves->extra_charge = 0;
                $reserves->total2 = ($total_neto - $_SESSION['booking']['fee']);
                $reserves->codconf = $_SESSION['booking']['codconf'];
                $reserves->hora = $_SESSION['booking']['hora'];
                if (isset($_SESSION["booking"]["comentarios"])) {
                    $comentarios = $_SESSION["booking"]["comentarios"];
                } else {
                    $comentarios = "PAID ONLINE";
                }
                $dateTT = date("Y-m-d");
                $horTT = date("H:i");
//                $user2['passingName1']


                if (isset($_SESSION['infoforms'])) {
                    $email = $user2['passingMail'];
                    $opcuser1 = (isset($user2['passingName1'])) ? "\n\nPASSENGER INFORMATION:\n\nADULT(s) INFORMATION :\nPassenger's Name1:".$user2['passingName1']." ".$user2['passinglast1'].""." - ".$user2['passingMail'].";"  : null;
                    $opcuser2 = (isset($user2['passingName2']))? "\nPassenger's Name2:".$user2['passingName2']." ".$user2['passinglast2'].";"  : null;
                    $opcuser3 = (isset($user2['passingName3']))? "\nPassenger's Name3:".$user2['passingName3']." ".$user2['passinglast3'].";"  : null;
                    $opcuser4 = (isset($user2['passingName4']))? "\nPassenger's Name4:".$user2['passingName4']." ".$user2['passinglast4'].";"  : null;
                    $opcuser5 = (isset($user2['passingName5']))? "\nPassenger's Name5:".$user2['passingName5']." ".$user2['passinglast5'].";"  : null;
                    $opcuser6 = (isset($user2['passingName6']))? "\nPassenger's Name6:".$user2['passingName6']." ".$user2['passinglast6'].";"  : null;
                    $opcuser7 = (isset($user2['passingName7']))? "\nPassenger's Name7:".$user2['passingName7']." ".$user2['passinglast7'].";"  : null;
                    $opcuser8 = (isset($user2['passingName8']))? "\nPassenger's Name8:".$user2['passingName8']." ".$user2['passinglast8'].";"  : null;

                    $opcchild1 = (isset($user2['childName1'])) ? "\n\nCHILD(s) INFORMATION :\nPassenger's Name1:".$user2['childName1']." ".$user2['childlast1'].", Age:".$user2['edad1'].";": null;
                    $opcchild2 = (isset($user2['childName2']))? "\nPassenger's Name2:".$user2['childName2']." ".$user2['childlast2'].", Age:".$user2['edad2'].";" : null;
                    $opcchild3 = (isset($user2['childName3']))? "\nPassenger's Name3:".$user2['childName3']." ".$user2['childlast3'].", Age:".$user2['edad3'].";" : null;
                    $opcchild4 = (isset($user2['childName4']))? "\nPassenger's Name4:".$user2['childName4']." ".$user2['childlast4'].", Age:".$user2['edad4'].";" : null;
                    $opcchild5 = (isset($user2['childName5']))? "\nPassenger's Name5:".$user2['childName5']." ".$user2['childlast5'].", Age:".$user2['edad5'].";" : null;
                    $opcchild6 = (isset($user2['childName6']))? "\nPassenger's Name6:".$user2['childName6']." ".$user2['childlast6'].", Age:".$user2['edad6'].";" : null;
                    $opcchild7 = (isset($user2['childName7']))? "\nPassenger's Name7:".$user2['childName7']." ".$user2['childlast7'].", Age:".$user2['edad7'].";" : null;
                    $opcchild8 = (isset($user2['childName8']))? "\nPassenger's Name8:".$user2['childName8']." ".$user2['childlast8'].", Age:".$user2['edad8'].";" : null;
                }else{
                    $email = $login->username;
                    $opcuser1 = (isset($booking['firsname1'])) ? "\n\nPASSENGER INFORMATION...\nADULT(s) :\nPassenger's Name1:".$booking['firsname1']." ".$booking['lasname1']." - ".$booking['email'].";"  : null;
                    $opcuser2 = (isset($booking['firsname2']))? "\nPassenger's Name2:".$booking['firsname2']." ".$booking['lasname2'].";"  : null;
                    $opcuser3 = (isset($booking['firsname3']))? "\nPassenger's Name3:".$booking['firsname3']." ".$booking['lasname3'].";"  : null;
                    $opcuser4 = (isset($booking['firsname4']))? "\nPassenger's Name4:".$booking['firsname4']." ".$booking['lasname4'].";"  : null;
                    $opcuser5 = (isset($booking['firsname5']))? "\nPassenger's Name5:".$booking['firsname5']." ".$booking['lasname5'].";"  : null;
                    $opcuser6 = (isset($booking['firsname6']))? "\nPassenger's Name6:".$booking['firsname6']." ".$booking['lasname6'].";"  : null;
                    $opcuser7 = (isset($booking['firsname7']))? "\nPassenger's Name7:".$booking['firsname7']." ".$booking['lasname7'].";"  : null;
                    $opcuser8 = (isset($booking['firsname8']))? "\nPassenger's Name8:".$booking['firsname8']." ".$booking['lasname8'].";"  : null;

                    $opcchild1 = (isset($booking['childName1'])) ? "\n\nCHILD(s) :\nPassenger's Name1:".$booking['childName1']." ".$booking['childlast1'].", Age:".$booking['edad1']." ;": null;
                    $opcchild2 = (isset($booking['childName2']))? "\nPassenger's Name2:".$booking['childName2']." ".$booking['childlast2'].", Age:".$booking['edad2'].";" : null;
                    $opcchild3 = (isset($booking['childName3']))? "\nPassenger's Name3:".$booking['childName3']." ".$booking['childlast3'].", Age:".$booking['edad3'].";" : null;
                    $opcchild4 = (isset($booking['childName4']))? "\nPassenger's Name4:".$booking['childName4']." ".$booking['childlast4'].", Age:".$booking['edad4'].";" : null;
                    $opcchild5 = (isset($booking['childName5']))? "\nPassenger's Name5:".$booking['childName5']." ".$booking['childlast5'].", Age:".$booking['edad5'].";" : null;
                    $opcchild6 = (isset($booking['childName6']))? "\nPassenger's Name6:".$booking['childName6']." ".$booking['childlast6'].", Age:".$booking['edad6'].";" : null;
                    $opcchild7 = (isset($booking['childName7']))? "\nPassenger's Name7:".$booking['childName7']." ".$booking['childlast7'].", Age:".$booking['edad7'].";" : null;
                    $opcchild8 = (isset($booking['childName8']))? "\nPassenger's Name8:".$booking['childName8']." ".$booking['childlast8'].", Age:".$booking['edad18'].";" : null;
                }
                
                //$reserves->firsname = $_SESSION['booking']['firsname1'] ;
                //$reserves->lasname = $_SESSION['booking']['lasname1'];
                //$reserves->email = $_SESSION['booking']['email'];

                //if(isset($_SESSION['user'])){
                    
                    
                if($ssl_usuario == "Invitado"){
                        
                    $comments2T="NOTE\n*****************************\nCARDHOLDER's: ". $first_name_invitado ." ". $last_name_invitado .";\nEMAIL: ".$user_name_invitado.";\nPHONE: ".$phone_invitado.";\n\nTipo Ticket: ".strtoupper($_SESSION['booking']['tipo_ticket'])."\nDATE: ".$created."\nDESCRIPTION: PAID ONLINE.\n\nTRAN AMOUNT: $".$paidAmount."USD."."\nAPPROVAL CD: ".$ssl_approval_code."\nTRAN ID: ".$_SESSION['booking']['card_number']."\nMESSAGE: APPROVAL.\nRESERVATION#: ".$_SESSION['booking']['codconf'].$opcuser1."".$opcuser2."".$opcuser3."".$opcuser4."".$opcuser5."".$opcuser6."".$opcuser7."".$opcuser8.$opcchild1."".$opcchild2."".$opcchild3."".$opcchild4."".$opcchild5."".$opcchild6."".$opcchild7."".$opcchild8."\n\n\n***************************** ";

                }else{
                        
                    $comments2T="NOTE\n*****************************\nCARDHOLDER's: ". $cardhn .";\nEMAIL: ". $email_user .";\nPHONE: ". $phone_user .";\n\nTipo Ticket: ". strtoupper($_SESSION['booking']['tipo_ticket']) ."\nDATE: ". $created ."\nDESCRIPTION: PAID ONLINE.\n\nTRAN AMOUNT: $". $paidAmount ."USD."."\nAPPROVAL CD: ". $ssl_approval_code ."\nTRAN ID: ". $_SESSION['booking']['card_number'] ."\nMESSAGE: APPROVAL.\nRESERVATION#: ". $_SESSION['booking']['codconf'].$opcuser1."".$opcuser2."".$opcuser3."".$opcuser4."".$opcuser5."".$opcuser6."".$opcuser7."".$opcuser8.$opcchild1."".$opcchild2."".$opcchild3."".$opcchild4."".$opcchild5."".$opcchild6."".$opcchild7."".$opcchild8."\n\n\n***************************** ";

                }
                    
                
                
                
                $reserves->comments = $comentarios;
                $reserves->comments2 = $comments2T;
                $reserves->resident = isset($_SESSION['booking']['resident']) ? $_SESSION['booking']['resident'] : 0;
                $reserves->agen = 53;
                $reserves->tipo_client = isset($login->tipo_client) ? $login->tipo_client : 0;
                $reserves->reward_id = -1;
                $reserves->agency = 53;
                $reserves->luggage1 = -1;
                $reserves->luggage2 = -1;
                $reserves->canal = 'WEBSALE';
                $reserves->estado = 'CONFIRMED';


                $this->data['rootUrl'] = Doo::conf()->APP_URL;
                // echo '<pre>';
                // print_r($reserves);
                // echo '</pre>';
                // die;

                /* esto con el fin de que no se guarde en
                 * la base de datos mientras se hacen
                 * pruebas unitarias
                 */

                if (Doo::db()->insert($reserves)) {
                    //Registramos pagos y rastro
                    $id_reserva = Doo::db()->lastInsertId();
                    Doo::loadController('admin/ReservasController');
                    $reseControl = new ReservasController();
                    $reserves->id = $id_reserva;

                    $login = $_SESSION['user'];
                    if (isset($_SESSION['data_agency'])) {
                        $login->tipo = 'AGENCY';
                    } else {
                        $login->tipo = 'WEB';
                    }
                    $datosTRastro = $reserves;
                    $datosTRastro->paid = $total_neto;
                    $datosTRastro->totaltotal = $total_neto;
                    $reseControl->rastro_reserva('CREATE', NULL, $datosTRastro, $login);
                    $reserves->totaltotal = ($total_neto - $_SESSION['booking']['fee']);//Resta el fin para los otros valores
                    // $reseControl->registrar_pago($datosTRastro, NULL, $login);
                    Doo::loadModel("Reserve_Pago");
                    $pagor_r = new Reserve_Pago();
                    $pagor_r->id_reserva = $datosTRastro->id;
                    $pagor_r->pago = $datosTRastro->pago;
                    $pagor_r->tipo_pago = $datosTRastro->tipo_pago;
                    $pagor_r->pagado = $datosTRastro->totaltotal;
                    
//                    if (isset($_SESSION['user'])) {
//                        $pagor_r->usuario = $ssl_id_cliente;
//                    }else{
//                        //$pagor_r->usuario = $login->id;
//                        $pagor_r->usuario = $id_invitado;
//                    }
                    
                    //if(isset($_SESSION['user'])){
                                               
                    if($ssl_usuario == "Invitado"){
                        $pagor_r->usuario = $id_invitado;
                    }else{
                        $pagor_r->usuario = $id_user; 
                    }
                    
                    //$pagor_r->usuario = $login->id;
                    
                    $pagor_r->fecha = date('Y-m-d H:s');
                    // $pagor_r->id =  Doo::db()->insert($pagor_r);
                    $pagor_r->id = $pagor_r->insert();


                    //fin registro pagos y rastro
                    //facturamos
                    Doo::loadModel('Factura');
                    Doo::loadModel('FacturaServicio');
                    $factura = new Factura();
                    $factura->id_agency = ($reserve->agency == 0) ? -1 : $reserve->agency;
                    $factura->creation_date = date('Y-m-d');
                    $factura->subtotal = $reserve->total2;
                    $factura->collect = $reserve->totaltotal;
                    $factura->total = $factura->subtotal - $factura->collect;
                    $factura->estado = "PAID";
//                    $factura->id = $factura->insert();
//                    $fs = new FacturaServicio();
//                    $fs->id_servicio = $id_reserva;
//                    $fs->tipo_servicio = "RESERVE";
//                    $fs->id_factura = $factura->id;
//                    $fs->id = $fs->insert();
                    Doo::loadModel('CollectService');
                    $coll = new CollectService();
                    $coll->id_servicio = $id_reserva;
                    $coll->tipo_servicio = "RESERVE";
                    $coll->monto_pagado = $reserve->totaltotal;
                    $coll->id = $coll->insert();
                    Doo::loadModel('Pago');
                    $pago = new Pago();
                    $pago->factura = $factura->id;
                    $pago->monto = $reserve->totaltotal;
                    $pago->tipo = 'FULL';
                    $pago->transnu = 0;
                    $pago->adjunto = 'online-paid';
                    $pago->descuento = 0;
                    $pago->per_descuento = 0;
                    $pago->fecha = date('Y-m-d h:m:s');
                    $pago->metodo = 4;
                    $pago->id = $pago->insert();
                    $tipo_pago = $reserves->tipo_pago;
                    $fpago = $reserves->pago;
                    $tipo = new stdclass();
                    $tipo->tipo = $tipo_pago;
                    $tipo->pago = $fpago;
                    $tipo->comment = "PAID ONLINE";
                    $_SESSION['tipo'] = $tipo;
                    if (isset($_SESSION['data_agency'])) {
                        $id_reserva = Doo::db()->lastInsertId();
                        $tipo_pago = $reserves->tipo_pago;
                        $fpago = $reserves->pago;
                        $dat = new Agency($_SESSION['data_agency']);
                        Doo::loadModel("Reservas_Agency");
                        $reserves_a = new Reservas_Agency();
                        $reserves_a->id_reservas = $id_reserva;
                        $reserves_a->id_agencia = 53;
                        
//                        if (isset($_SESSION['user'])) {
//                            $reserves_a->id_client = $ssl_id_cliente;
//                        }else{
//                            //$reserves_a->id_client = $login->id;
//                            $reserves_a->id_client = $id_invitado;
//                        }
                        
                        //if(isset($_SESSION['user'])){
                            
                        if($ssl_usuario == "Invitado"){
                            $reserves_a->id_client = $id_invitado;
                        }else{
                            $reserves_a->id_client = $id_user;
                        }
                        //$reserves_a->id_client = $login->id;
                        $reserves_a->type_client = $login->id;
                        $reserves_a->id_useragency = 963;
                        $reserves_a->paid_type = $tipo_pago;
                        $reserves_a->metodo_paid = $fpago;
                        $reserves_a->paid_net = $total_neto;
                        $reserves_a->otheramount = $_SESSION['booking']['otheramount'];
                        $reserves_a->paid_full = (($_SESSION['booking']['totaltotal'])*0.05) + $_SESSION['booking']['totaltotal'];
                        // echo $reserves_a->paid_full;
                        // exit;
                        if ($dat->type_rate == 1) {
                            $reserves_a->comision = 0;
                        } else {
                            //$reserves_a->comision = ($this->cal_equipament($reserve->trip_no) + $this->cal_equipament($reserve->trip_no2)) / 2;
                            $reserves_a->comision = 0;
                        }
                        $reserves_a->otheramount = $otheramount;
                        $reserves_a->agency_fee = $total_neto * $reserves_a->comision / 100;
                        $reserves_a->paper_voucher = 0;
                        Doo::db()->insert($reserves_a);
                    }
                }

//                if (isset($_SESSION['user'])) {
//                    $usuario_pago = $ssl_id_cliente;
//                }else{
//                    //$usuario_pago = $login->id;
//                    $usuario_pago = $id_invitado;
//                }
                
                //if(isset($_SESSION['user'])){
                    
                if($ssl_usuario == "Invitado"){
                    $usuario_pago = $id_invitado;
                }else{
                    $usuario_pago = $id_user;
                }
                
                //$sql = 'UPDATE reservas_pago SET pagado = "' . $reserves->total_paid . '", pago = "PRED-PAID", tipo_pago = "CREDIT CARD WITH FEE", usuario = '.$login->id.' WHERE id_reserva = "' . $reserves->id . '" AND pagado = "' . $reserves->total2 . '" ';
                Doo::db()->query('UPDATE reservas_pago SET pagado = "' .$reserves->total_paid. '", pago = "PRED-PAID", tipo_pago = "CREDIT CARD WITH FEE", usuario = "' . $usuario_pago . '" WHERE id_reserva = "' .$reserves->id. '" AND pagado = "' .$reserves->total2. '" ;');
//                 print_r($sql);
//                 die;
                
                //Doo::db()->query($sql);
                //$insert = 'INSERT INTO reservas_agency (id, id_reservas, id_agencia, id_cliente, type_client, id_useragency, paid_type, metodo_paid, paid_net, paid_full, otheramount, agency_fee, comision, paper_voucher) VALUES("", "' . $reserves->id . '", "53", "' . $login->id . '", "1", "421", "PRED-PAID", "CREDIT CARD WITH FEE-FULL", "' . $reserves->total2 . '", "' . ($reserves->total2 + $_SESSION['booking']['fee']) . '", "0", "0", "0", "0");';
                        
                //$reserx = $reserves->total2 + $_SESSION['booking']['fee'];
                //Doo::db()->query($insert);
                Doo::db()->query('INSERT INTO reservas_agency(id, id_reservas, id_agencia, id_cliente, type_client, id_useragency, paid_type, metodo_paid, paid_net, paid_full, otheramount, agency_fee, comision, paper_voucher) VALUES("", "' . $reserves->id . '", "53", "' . $usuario_pago . '", "1", "963", "PRED-PAID", "CREDIT CARD WITH FEE-FULL", "' . $reserves->total2 . '", "' . ($reserves->total2 + $_SESSION['booking']['fee']) . '", "0", "0", "0", "0");');

                $usuario = $_SESSION['booking']['iden'];

                //$update = "UPDATE reservas_trip_puestos SET estado = 'RESERVED' WHERE usuario = '" . $usuario . "'";

                //Doo::db()->query($update);
                
                Doo::db()->query('UPDATE reservas_trip_puestos SET estado = "RESERVED" WHERE usuario = "' . $usuario . '"');
                
                    $usersend = new stdclass();
                    $usersend->firstname = $ssl_first_name;
                    $usersend->lastname = $ssl_last_name;
                    $usersend->username = $ssl_email;
                    $usersend->zip = $ssl_zip_code;
                    $usersend->state = $ssl_state;
                    $usersend->country = $ssl_country;
                    $usersend->city =  $ssl_city;
                    $usersend->phone = $ssl_phone;
                    $usersend->address = $ssl_address;
                    $_SESSION['usersend'] = $usersend;

                    $_SESSION['contenido1321'] = 'login: <pre>' . print_r($login, true) . '</pre>'."Reserve : ".'<pre>' . print_r($reserves, true) . '</pre>'."Reserve_Pago: ".'<pre>' . print_r($pagor_r, true) . '</pre>'."CollectService: ".'<pre>' . print_r($coll, true) . '</pre>'."pago: ".'<pre>' . print_r($pago, true) . '</pre>'."sql update reservas_pago: ".'<pre>' . print_r($sql, true) . '</pre>'."sql insert reservas_agency: ".'<pre>' . print_r($insert, true) . '</pre>'."usersend: ".'<pre>' . print_r($usersend, true) . '</pre>';
                
            $this->loading();
                

                if (isset($ssl_approval_code)) {
                    $codconf = array(
                        "codconf" => $_SESSION['booking']['codconf']
                    );
                    $_SESSION['code'] = $codconf;
                    return Doo::conf()->APP_URL . "transaction/approved/$cargosf/$clientef";
                    unset($_SESSION['booking']);
                }
            } else {
                return Doo::conf()->APP_URL . "error";
            }
            $codconf = array(
                "codconf" => $_SESSION['booking']['codconf']
            );
            $_SESSION['code'] = $codconf;
            $pasabordo = array(
                "from_name" => $booking['from_name'],
                "to_name" => $booking['to_name'],
                "total_pax" => ($booking['pax'] + $booking['chil']),
                "fee" => $booking['fee'],
                "pago_pred" => $booking['pago_pred'],
                "tipo" => $booking['tipo_ticket']
            );
            $_SESSION['pasabordo'] = $pasabordo;
            unset($_SESSION['booking']);
            unset($_SESSION['signup3']);
            return Doo::conf()->APP_URL . "transaction/approved";
            if (isset($_SESSION['signup2']) || isset($_SESSION['infoforms'])) {
              session_destroy();
              // unset($_SESSION['infoforms']);
              // unset($_SESSION['signup2']);
              // unset($_SESSION['user']);
            }
        } else {
            return Doo::conf()->APP_URL . "";
        }
    }


    public function loading() {
    header("Content-Type: text/html; charset=utf-8");
        $tipo = $_SESSION['tipo'];
        $login = $_SESSION['user'];
        $user2 = $_SESSION['signup2'];
        $user3 = $_SESSION['signup3'];
        $booking = $_SESSION['booking'];
        $infiform = $_SESSION['infoforms'];
        $user4 = $_SESSION['usersend'];
        // echo "<pre>";
        // print_r($_SESSION);
        // die;
        // echo "</pre>";
          if (isset($infiform)) {
            $emailsen = $infiform['passingMail'];
            $lastnamesen = $infiform['passinglast1'];
            $opcuser1 = (isset($user2->person1['nombre1'])) ? "Cardholder's: <span style='font-weight: bold;'>".utf8_decode($login->firstname)." ".utf8_decode($login->lastname)."</span><br>EMAIL: <span style='font-weight: bold;'>".$login->username ."</span><br>Lead Traveler: <span style='font-weight: bold;'>".utf8_decode($user2->person1['nombre1'])." ".utf8_decode($user2->person1['apelli1'])."</span><br>" : null;
            $opcuser2 = (isset($user2->person2['nombre2']))? "<span style='font-weight: bold;'> ".utf8_decode($user2->person2['nombre2'])." ".utf8_decode($user2->person2['apelli2'])."</span>": null;
            $opcuser3 = (isset($user2->person3['nombre3']))? "<span style='font-weight: bold;'>, ".utf8_decode($user2->person3['nombre3'])." ".utf8_decode($user2->person3['apelli3'])."</span>": null;
            $opcuser4 = (isset($user2->person4['nombre4']))? "<span style='font-weight: bold;'>, ".utf8_decode($user2->person4['nombre4'])." ".utf8_decode($user2->person4['apelli4'])."</span><br>": null;
            $opcuser5 = (isset($user2->person5['nombre5']))? "<span style='font-weight: bold;'> ".utf8_decode($user2->person5['nombre5'])." ".utf8_decode($user2->person5['apelli5'])."</span>": null;
            $opcuser6 = (isset($user2->person6['nombre6']))? "<span style='font-weight: bold;'>, ".utf8_decode($user2->person6['nombre6'])." ".utf8_decode($user2->person6['apelli6'])."</span>": null;
            $opcuser7 = (isset($user2->person7['nombre7']))? "<span style='font-weight: bold;'>, ".utf8_decode($user2->person7['nombre7'])." ".utf8_decode($user2->person7['apelli7'])."</span>": null;
            $opcuser8 = (isset($user2->person8['nombre8']))? "<span style='font-weight: bold;'> ".utf8_decode($user2->person8['nombre8'])." ".utf8_decode($user2->person8['apelli8'])."</span><br>": null;
          //   <tr id=''>
          //   <td  colspan='2' id='' align='left'>E-mail: <span style='font-weight: bold;'>" . $login->username . "</span></td>
          // </tr>
            $opcchild1 = (isset($user2->child1['nombre1'])) ? "Child's: <span style='font-weight: bold;'>".utf8_decode($user2->child1['nombre1'])." ".utf8_decode($user2->child1['apelli1'])."  - Age:".$user2->child1['edad1']."</span><br>": null;
            $opcchild2 = (isset($user2->child2['nombre2']))? "<span style='font-weight: bold;'> ".utf8_decode($user2->child2['nombre2'])." ".utf8_decode($user2->child2['apelli2'])." - Age:".$user2->child2['edad2']."</span>": null;
            $opcchild3 = (isset($user2->child3['nombre3']))? "<span style='font-weight: bold;'>, ".utf8_decode($user2->child3['nombre3'])." ".utf8_decode($user2->child3['apelli3'])." - Age:".$user2->child3['edad3']."</span>": null;
            $opcchild4 = (isset($user2->child4['nombre4']))? "<span style='font-weight: bold;'>, ".utf8_decode($user2->child4['nombre4'])." ".utf8_decode($user2->child4['apelli4'])." - Age:".$user2->child4['edad4']."</span><br>": null;
            $opcchild5 = (isset($user2->child5['nombre5']))? "<span style='font-weight: bold;'> ".utf8_decode($user2->child5['nombre5'])." ".utf8_decode($user2->child5['apelli5'])." - Age:".$user2->child5['edad5']."</span>": null;
            $opcchild6 = (isset($user2->child6['nombre6']))? "<span style='font-weight: bold;'>, ".utf8_decode($user2->child6['nombre6'])." ".utf8_decode($user2->child6['apelli6'])." - Age:".$user2->child6['edad6']."</span>": null;
            $opcchild7 = (isset($user2->child7['nombre7']))? "<span style='font-weight: bold;'>, ".utf8_decode($user2->child7['nombre7'])." ".utf8_decode($user2->child7['apelli7'])." - Age:".$user2->child7['edad7']."</span>,": null;
            $opcchild8 = (isset($user2->child8['nombre8']))? "<span style='font-weight: bold;'> ".utf8_decode($user2->child8['nombre8'])." ".utf8_decode($user2->child8['apelli8'])." - Age:".$user2->child8['edad8']."</span>,<br>": null;
          }else{
            $emailsen = $user3->person1['email1'];
            $lastnamesen = $user3->person1['apelli1'];
            $opcuser1 = (isset($user3->person1['nombre1'])) ? "Cardholder's: <span style='font-weight: bold;'>".utf8_decode($user4->firstname)." ".utf8_decode($user4->lastname)."</span><br>EMAIL: <span style='font-weight: bold;'>".$user4->username ."</span><br>Lead Traveler: <span style='font-weight: bold;'>".utf8_decode($user3->person1['nombre1'])." ".utf8_decode($user3->person1['apelli1'])."</span><br>" : null;
            $opcuser2 = (isset($user3->person2['nombre2']))? "<span style='font-weight: bold;'> ".utf8_decode($user3->person2['nombre2'])." ".utf8_decode($user3->person2['apelli2'])."</span>": null;
            $opcuser3 = (isset($user3->person3['nombre3']))? "<span style='font-weight: bold;'>, ".utf8_decode($user3->person3['nombre3'])." ".utf8_decode($user3->person3['apelli3'])."</span>": null;
            $opcuser4 = (isset($user3->person4['nombre4']))? "<span style='font-weight: bold;'>, ".utf8_decode($user3->person4['nombre4'])." ".utf8_decode($user3->person4['apelli4'])."</span><br>": null;
            $opcuser5 = (isset($user3->person5['nombre5']))? "<span style='font-weight: bold;'> ".utf8_decode($user3->person5['nombre5'])." ".utf8_decode($user3->person5['apelli5'])."</span>": null;
            $opcuser6 = (isset($user3->person6['nombre6']))? "<span style='font-weight: bold;'>, ".utf8_decode($user3->person6['nombre6'])." ".utf8_decode($user3->person6['apelli6'])."</span>": null;
            $opcuser7 = (isset($user3->person7['nombre7']))? "<span style='font-weight: bold;'>, ".utf8_decode($user3->person7['nombre7'])." ".utf8_decode($user3->person7['apelli7'])."</span>": null;
            $opcuser8 = (isset($user3->person8['nombre8']))? "<span style='font-weight: bold;'> ".utf8_decode($user3->person8['nombre8'])." ".utf8_decode($user3->person8['apelli8'])."</span><br>": null;
          //   <tr id=''>
          //   <td  colspan='2' id='' align='left'>E-mail: <span style='font-weight: bold;'>" . $login->username . "</span></td>
          // </tr>
          $opcchild1 = (isset($user3->child1['nombre1'])) ? "Child's: <span style='font-weight: bold;'>".utf8_decode($user3->child1['nombre1'])." ".utf8_decode($user3->child1['apelli1'])." - Age:".$user3->child1['edad1']."</span><br>": null;
          $opcchild2 = (isset($user3->child2['nombre2']))? "<span style='font-weight: bold;'> ".utf8_decode($user3->child2['nombre2'])." ".utf8_decode($user3->child2['apelli2'])." - Age:".$user3->child2['edad2']."</span>": null;
          $opcchild3 = (isset($user3->child3['nombre3']))? "<span style='font-weight: bold;'>, ".utf8_decode($user3->child3['nombre3'])." ".utf8_decode($user3->child3['apelli3'])." - Age:".$user3->child3['edad3']."</span>": null;
          $opcchild4 = (isset($user3->child4['nombre4']))? "<span style='font-weight: bold;'>, ".utf8_decode($user3->child4['nombre4'])." ".utf8_decode($user3->child4['apelli4'])." - Age:".$user3->child4['edad4']."</span><br>": null;
          $opcchild5 = (isset($user3->child5['nombre5']))? "<span style='font-weight: bold;'> ".utf8_decode($user3->child5['nombre5'])." ".utf8_decode($user3->child5['apelli5'])." - Age:".$user3->child5['edad5']."</span>": null;
          $opcchild6 = (isset($user3->child6['nombre6']))? "<span style='font-weight: bold;'>, ".utf8_decode($user3->child6['nombre6'])." ".utf8_decode($user3->child6['apelli6'])." - Age:".$user3->child6['edad6']."</span>": null;
          $opcchild7 = (isset($user3->child7['nombre7']))? "<span style='font-weight: bold;'>, ".utf8_decode($user3->child7['nombre7'])." ".utf8_decode($user3->child7['apelli7'])." - Age:".$user3->child7['edad7']."</span>,": null;
          $opcchild8 = (isset($user3->child8['nombre8']))? "<span style='font-weight: bold;'> ".utf8_decode($user3->child8['nombre8'])." ".utf8_decode($user3->child8['apelli8'])." - Age:".$user3->child8['edad8']."</span>,<br>": null;
          }


         //echo '<pre>';
          //print_r($opcuser1);
         //echo '</pre>'; die;
        list($mes, $dia, $anyo) = explode("-", $booking['fecha_salida']);
        $fecha = $anyo . "-" . $mes . "-" . $dia;

        if ($booking['fecha_retorno'] != "N/A") {
            list($mes1, $dia1, $anyo1) = explode("-", $booking['fecha_retorno']);
            $fecha1 = $anyo1 . "-" . $mes1 . "-" . $dia1;
        }

        $totalpax = $booking['pax'] + $booking['chil'];

        $this->data['rootUrl'] = Doo::conf()->APP_URL;
         if ($tipo->tipo == "PRED-PAID") {

            try {

                Doo::loadController('DatosMailController');
                $datosMail = new DatosMailController();
                $mail = new PHPMailer(true);

                $mail2 = $datosMail->datos();

                $mail->Host = $mail2->Host;
                $mail->From = $mail2->From;
                $mail->FromName = "SuperTours";
                // echo '<pre>';
                // print_r( $infiform['passingMail']);
                // echo '</pre>'; die;



                //$mail->Subject = $mail2->Subject. ' ' . utf8_decode($login->firstname) . ' ' . utf8_decode($login->lastname) ;
                $mail->Subject = $mail2->Subject. ' ' . utf8_decode($login->firstname) . ' ' . utf8_decode($login->lastname) ;
                $mail->AddAddress($login->username, $login->lastname); //MANDA UN CORREO AL DUENIO DE LA CUENTA
                $mail->AddAddress($emailsen, $lastnamesen); //MANDA UN CORREO AL PASAJERO RESPONSABLE
                $mail->AddAddress($user4->username, $user4->lastname); //MANDA UN CORREO AL DUENIO DE LA TARJETA
                ///**********************$mail->AddCC("reservations@supertours.com");    //En este espacio debe ir un correo de respaldo.
                //$mail->AddCC("bustamante3@hotmail.com");    //En este espacio debe ir un correo de respaldo.
                $mail->AddCC("reservations@supertours.com");    //En este espacio debe ir un correo de respaldo.
	            $mail->AddBCC("arturo@supertours.com");  //En este espacio debe ir websales@supertours.com
	            //$mail->AddBCC("arbusmad2021@gmail.com");
                
               
                $numberPhone='';
                $phone=$login->phone;

                $celphone=$login->celphone;
                if($phone == NULL || $phone == ''){
                    $numberPhone=$celphone;
                }else{
                    $numberPhone=$phone;
                }
                $numberPhone= trim(str_replace("E", "", str_replace("+", "", str_replace(",", "", str_replace(")", "", str_replace("(", "", str_replace(".", "", $numberPhone)))))));

                    $y = wordwrap($numberPhone,3, '-', 1);
                    $ty = explode("-", $y);
                    for($i = 0; $i<sizeof($ty); $i++){
                        if($i==0){
                           $ty[0]= "(".$ty[0].")";
                        }else if($i==(sizeof($ty)-1) && (sizeof($ty[(sizeof($ty)-1)]))<3){
                            $ty[$i]="".$ty[$i];
                        }else{
                            $ty[$i]="-".$ty[$i];
                        }
                    }
                $login->phone = implode($ty);
                $tipo_ticket = $booking["tipo_ticket"];
                $otheramount = isset($_SESSION['booking']['otheramount']) ? $_SESSION['booking']['otheramount'] : 0;
                $pago = ( ($otheramount == 0) ? $booking['totaltotal'] : $otheramount);
                $pago = number_format($pago, 2, '.', ',');
                $var = explode('-', $tipo->pago);
                $tipoPago = strtoupper($var[0]);
                $timeBSalida=15;//Tiempo que debe estar esperando en la parada del bus, antes de salir
                if($booking['from_name']=='Orlando'){
                    $timeBSalida=30;
                }else{
                    $timeBSalida=$timeBSalida;
                }

                 $place1;
                 $place2;
                 $place3;
                 $place4;
                 if($booking['hotelarea1']==''){
                     $place1 = str_replace(" - Express", "", $booking['place1']);
                 }else{
                     $place1 = $booking['hotelarea1'];
                 }

                 if($booking['hotelarea2']==''){
                     $place2 = str_replace(" - Express", "", $booking['address1']);
                 }else{
                     $place2 = $booking['hotelarea2'];
                 }
                 if($booking['hotelarea3']==''){
                     $place3 = str_replace(" - Express", "", $booking['place2']);
                 }else{
                     $place3 = $booking['hotelarea3'];
                 }
                 if($booking['hotelarea4']==''){
                     $place4 = str_replace(" - Express", "", $booking['address2']);
                 }else{
                     $place4 = $booking['hotelarea4'];
                 }

                $precioAdultT = number_format($booking['pricexten']+$booking['precioadul'], 2, '.', '');
                $precioChildT = number_format($booking['pricexten']+$booking['preciochil'], 2, '.', '');
                $precioTotalAdultT = number_format((($booking['pricexten']*$booking['pax']) + $booking['totaladul']), 2, '.', '');
                $precioTotalChildT = number_format((($booking['pricexten']*$booking['chil']) + $booking['totalchil']), 2, '.', '');
                if($booking['chil']==0){
                    $precioChildT = $booking['preciochil'];
                    $precioTotalChildT = $booking['totalchil'];
                }
                
                if($booking['trip_no']== '100' || $booking['trip_no']== '101' || $booking['trip_no']== '300' || $booking['trip_no']== '301'){
                    $company = 'JET SET BUS';
                }
                
                if($booking['trip_no']== '700' || $booking['trip_no']== '710' || $booking['trip_no']== '720' || $booking['trip_no']== '722' || $booking['trip_no']== '724' || $booking['trip_no']== '726' || $booking['trip_no']== '730' || $booking['trip_no']== '736' || $booking['trip_no']== '740' || $booking['trip_no']== '744' || $booking['trip_no']== '750' || $booking['trip_no']== '760' || $booking['trip_no']== '770' || $booking['trip_no']== '774' || $booking['trip_no']== '776' || $booking['trip_no']== '780' || $booking['trip_no']== '790' || $booking['trip_no']== '810' || $booking['trip_no']== '820' || $booking['trip_no']== '830' || $booking['trip_no']== '840' || $booking['trip_no']== '8000' || $booking['trip_no']== '8820' || $booking['trip_no']== '8830' || $booking['trip_no']== '8840' || $booking['trip_no']== '8004' || $booking['trip_no']== '705' || $booking['trip_no']== '711' || $booking['trip_no']== '721' || $booking['trip_no']== '723' || $booking['trip_no']== '731' || $booking['trip_no']== '741' || $booking['trip_no']== '759' ||  $booking['trip_no']== '773' ||$booking['trip_no']== '761' || $booking['trip_no']== '763' || $booking['trip_no']== '771' || $booking['trip_no']== '775' || $booking['trip_no']== '781' || $booking['trip_no']== '791' || $booking['trip_no']== '811' || $booking['trip_no']== '821' || $booking['trip_no']== '831' || $booking['trip_no']== '841' || $booking['trip_no']== '851' || $booking['trip_no']== '8001' || $booking['trip_no']== '8811' || $booking['trip_no']== '8821' || $booking['trip_no']== '8005' || $booking['trip_no']== '8841' || $booking['trip_no']== '8851'){
                    $company = 'FLIXBUS';
                }
                
                if($booking['trip_no2']== '100' || $booking['trip_no2']== '101' || $booking['trip_no2']== '300' || $booking['trip_no2']== '301'){
                    $company2 = 'JET SET BUS';
                }
                
                if($booking['trip_no2']== '710' || $booking['trip_no2']== '720' || $booking['trip_no2']== '722' || $booking['trip_no2']== '724' || $booking['trip_no2']== '726' || $booking['trip_no2']== '730' || $booking['trip_no2']== '736' || $booking['trip_no2']== '740' || $booking['trip_no2']== '744' || $booking['trip_no2']== '750' || $booking['trip_no2']== '760' || $booking['trip_no2']== '770' || $booking['trip_no2']== '774' || $booking['trip_no2']== '776' || $booking['trip_no2']== '780' || $booking['trip_no2']== '790' || $booking['trip_no2']== '810' || $booking['trip_no2']== '820' || $booking['trip_no2']== '830' || $booking['trip_no2']== '840' || $booking['trip_no2']== '8000' || $booking['trip_no2']== '8820' || $booking['trip_no2']== '8830' || $booking['trip_no2']== '8840' || $booking['trip_no2']== '8004' || $booking['trip_no2']== '705' || $booking['trip_no2']== '711' || $booking['trip_no2']== '721' || $booking['trip_no2']== '723' || $booking['trip_no2']== '731' || $booking['trip_no2']== '741' || $booking['trip_no2']== '759' || $booking['trip_no2']== '761' || $booking['trip_no2']== '763' || $booking['trip_no2']== '771' || $booking['trip_no2']== '775' || $booking['trip_no2']== '781' || $booking['trip_no2']== '791' || $booking['trip_no2']== '811' || $booking['trip_no2']== '821' || $booking['trip_no2']== '831' || $booking['trip_no2']== '841' || $booking['trip_no2']== '851' || $booking['trip_no2']== '8001' || $booking['trip_no2']== '8811' || $booking['trip_no2']== '8821' || $booking['trip_no2']== '8005' || $booking['trip_no2']== '8841' || $booking['trip_no2']== '8851'){
                    $company2 = 'FLIXBUS';
                }


                if ($tipo_ticket == "oneway") {
                    $codigoHTML="
                    <html>
                        <head>

                        
                        <meta name='viewport' content='width=device-width, initial-scale=1'>
                        <meta http-equiv='X-UA-Compatible' content='IE=edge' />
                        <title>Mail</title>
    <style type='text/css'>
        * { -webkit-text-size-adjust:none; -ms-text-size-adjust:none; max-height:1000000px;}
        table {border-collapse: collapse !important;}
        #outlook a {padding:0;}
        .ReadMsgBody { width: 100%; }
        .ExternalClass { width: 100%; }
        .ExternalClass * { line-height: 100%; }
        .ios_geo a { color:#1c1c1c !important; text-decoration:none !important; }

        #clearTable {
                /*width: 800px;*/
                font-size: 13px;
                font-family: Verdana, Geneva, sans-serif;
        }
        #clearTable tr #titletd3 {
                font-family: Verdana, Geneva, sans-serif;
        }
        #clearTable tr #titletd2 {
                font-size: 20px;
        }
        #clearTable tr td.p {
                text-align: center;
        }
        #clearTable td{
            padding: 1px 5px;

        }
        #content #center-column #tdgris {
                background-color: #F0F0F0;
        }
        #content #center-column #tdrojo {
                background-color: #FFE6E6;
        }
        #content #center-column1 #titletd {
                background-color: #F5EDEB;
                padding-left: 5px;
                font-size: 12px;
        }
         #titlett {
                background-color: #ececec;
                color: #1f2b56;
                padding-left: 5px;
                font-size: 12px;
        }
         #titlell {
                padding-left: 5px;
                font-size: 12px;
                border-bottom-width: 1px;
                border-left-width: 1px;
                border-bottom-style: solid;
                border-left-style: solid;
                border-bottom-color: #E6E6E6;
                border-left-color: #E6E6E6;
        }
        #titlelp {
                font-size: 11px;
                border-bottom-width: 1px;
                border-bottom-style: solid;
                border-bottom-color: #E6E6E6;
                border-right: 1px;
                border-right-style: solid;
                border-right-color: #e6e6e6;
        }
         #titlelr {
                padding-left: 5px;
                font-size: 12px;
                border-top: 1px solid #2160a0;
                color: #CE0000;
        }
         #tdgristable {
                background-color: #FFF;
                padding-left: 5px;
        }
        </style>
    </head>
    <body>
         <table id='clearTable' style='-webkit-print-color-adjust: exact; /*economy | exact*/color-adjust: exact;width: 100%;' align='center'>
                    <tr>
                        <td colspan='4' align='center'>
                            <table width='99%' style='border: 1px solid #e6e6e6;' id='tableorder'>
                              <tr style='background-color: #ececec;'>
                                <td rowspan='' id='titletd3'>
                                 <a href='http://www.supertours.com' target='_blank'>
                                   <img src='global/estilos/logo.png' width='164' height='62' />
                                 </a>
                                 </td>
                                <td rowspan='' style='color: #000;font-size: 12px;' colspan='5' align='right' id='titletd3'>
                                <br>
                                    <table width='100%' align='right'>
                                        <tr>
                                            <td align='right'>
                                                <span style='font-weight: bold;'>DATE/TIME OF BOOKING</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td align='right'>
                                                <span style='font-weight: bold;color: #dc3545;'>" . $booking['fecha_ini'] . " / " . $booking['hora'] . "</span>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                              </tr>
                              <tr style='background-color: #ececec;'>
                                <td width='25%' colspan='3' style='border: 1px solid #e6e6e6; color: #2f2f2f;font-weight: bold;' align='center' height='39' colspan='' id='titletd2'>
                                    <table align='right' width='100%'>
                                        <tr>
                                            <td width='56%' style='color:#ececec;'>
                                            .
                                            </td>
                                            <td width='44%' style='font-size:30px;' height='39'>
                                                E-TICKET
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                                <td width='10%' align='right' colspan='3'>
                                    <table align='right' width='100%'>
                                        <tr style='background-color:white;'>
                                         <td align='center'> Ticket Confirmation #: </td>
                                        </tr>
                                        <tr>
                                          <td align='center' width='22%' style='color: white;font-size: 14px; border: 1px solid #d8d3d3; background-color: black;font-weight: bold;'>".$booking['codconf']."</td>
                                        </tr>
                                        <tr id='titletd7' style='background-color:#ececec;font-size: 10px; '>
                                            <td align='center'>&nbsp;</td>
                                        </tr>
                                    </table>
                                </td>
                              </tr>
                            </table>
                            <br>
                        </td>
                   </tr>
                    <tr>
                      <td colspan='4' align='center'>
                        <table width='99%'>
                          <tr>
                              <td height='15' id='titletd6'>
                              " .$opcuser1. "" .$opcuser2. "" .$opcuser3. "" .$opcuser4. "" .$opcuser5. "" .$opcuser6. "" .$opcuser7. "" .$opcuser8. "
                              </td>
                          </tr>
                          <tr>
                              <td height='15' id='titletd6'>
                              " .$opcchild1. "" .$opcchild2. "" .$opcchild3. "" .$opcchild4. "" .$opcchild5. "" .$opcchild6. "" .$opcchild7. "" .$opcchild8. "
                              </td>
                            <td colspan='' id='titletd6'>
                              AD: <span style='font-weight: bold;'>".$booking['pax']."</span> CHD: <span style='font-weight: bold;'>".$booking['chil']."</span> TOTAL: <span style='font-weight: bold;'>".$totalpax."
                            </td>
                          </tr>
                          <tr id=''>
                            <td colspan='' id='' align='left'>Address: <span style='font-weight: bold;'>" . ucwords(strtolower($user4->address)) . "</span></td>
                            <td colspan='' id='' align='left'>City: <span style='font-weight: bold;'>" . ucwords(strtolower($user4->city)) . "</span></td>
                          </tr>
                          <tr id=''>
                            <td id='' align='left'>State: <span style='font-weight: bold;'>" . ucwords(strtolower($user4->state)) . "</span></td>
                            <td id='' align='left'>Zip / Postal Code: <span style='font-weight: bold;'>" . $user4->zip . "</span></td>
                          </tr>
                          <tr id=''>
                            <td colspan='' align='left' id=''>Country: <span style='font-weight: bold;'>" . ucwords(strtolower($user4->country)) . "</span></td>
                            <td colspan='' id='' align='left'>Phone: <span style='font-weight: bold;'>" . $user4->phone . "</span></td>
                          </tr>
                        </table>
                        <br>
                      </td>
                    </tr>
                    <tr>
                      <td colspan='4' align='center'>
                        <table width='99%' style='border: 1px solid #e6e6e6;background-color: #fdfdfd;' id='tableorder'>
                          <tr>
                            <td height='25' align='center' id='titlett' width='100%' colspan='3' style='font-size: 14px; font-weight: bold; '> <span style='font-weight: bold;'>" . strtoupper($booking['ticke']) . " </span></td>
                          </tr>
                          <tr>
                            <td id='titlelp' width='45%'>
                              Trip: <strong>" . $booking['trip_no'] . "</strong><a>  </a><strong>" . $company . "</strong>
                            </td>
                            <td id='titlelp' colspan='2' width='55%'>
                              Departure Date: <strong>" . date('M-d-Y', strtotime($fecha)) . "</strong>
                              <br>
                              Departure Time: <strong>" . date('g:i a', strtotime($booking['trip_departure'])) . "</strong>
                            </td>
                          </tr>
                          <tr>
                            <td id='titlelp'>
                              From: <strong>" . $booking['from_name'] . "</strong>
                            </td>
                            <td id='titlelp' colspan='2'>
                              Departure Location: <strong>" . $place1 . "</strong>
                            </td>
                          </tr>
                          <tr>
                            <td id='titlelp'>
                              To: <strong>" . $booking['to_name'] . "</strong>
                            </td>
                            <td id='titlelp' colspan='2'>
                              Arrival Time: <strong>" . date('g:i a', strtotime($booking['trip_arrival'])) . "</strong>
                              <br>
                              Drop Off: <strong>" . $place2 . "</strong>
                            </td>
                          </tr>
                        </table>
                        <table id='tableorder2' width='100%'>
                          <tr>
                            <td style='color: #dc3545; font-weight: bold;font-size: 11px;' align='center' height='35' id='titlett2'  >
                              Please print and present this e-ticket to for boarding.
                              <br/>
                              Passenger needs to arrive at least " . $timeBSalida ." minutes prior to departure.</td>
                          </tr>
                        </table>
                      </td>
                    </tr>
                   <tr>
                        <td colspan='4' align='center'>
                            <table width='99%' style='border: 1px solid #e6e6e6;background-color: #fdfdfd;' border='0' cellpadding='3' id='tableorder'>
                              <tr>
                                <td height='29' colspan='4' align='center'  id='titlett' style='font-size: 14px; font-weight: bold;'><strong>PURCHASE SUMMARY</strong></td>
                              </tr>
                              <tr>
                                <td id='titlelp'>&nbsp;</td>
                                <td id='titlelp' style='text-align: left; font-weight: bold;'>
                                  Passenger Traveling
                                </td>
                                <td id='titlelp' style='text-align: right; font-weight: bold;'>
                                  Fare
                                </td>
                                <td id='titlelp' style='text-align: right; font-weight: bold;'>
                                  Total
                                </td>
                              </tr>
                             <tr>
                                <td id='titlelp' width='55%'>" . $booking['ticke'] . " Adults</td>
                                <td id='titlelp' style='color: #2160a0' align='center' width='7%'><span style='font-weight: bold;'>" . $booking['pax'] . "</span></td>
                                <td id='titlelp' style='color: #2160a0' align='right' width='13%'><span style='font-weight: bold;'>" . $precioAdultT . "</span></td>
                                <td id='titlelp' style='color: #2160a0' width='13%' align='right'><span style='font-weight: bold;'>" . $precioTotalAdultT . "</span></td>
                              </tr>
                              <tr>
                                <td id='titlelp'>" . $booking['ticke'] . " Children (0-9 Years)</td>
                                <td id='titlelp' style='color: #2160a0' align='center'><span style='font-weight: bold;'>" . $booking['chil'] . "</span></td>
                                    <td id='titlelp' style='color: #2160a0' align='right'><span style='font-weight: bold;'>" . $precioChildT. "</span></td>
                                    <td id='titlelp' style='color: #2160a0' align='right'><span style='font-weight: bold;'>" . $precioTotalChildT . "</span></td>
                              </tr>
                              <tr id='titlelp'>
                                <td id='titlell' colspan='3' style='border-right: 1px solid #e6e6e6;border-bottom: 1px solid #2160a0;'> Service Fee </td>
                                <td id='titlelp' style='color: #2160a0;border-bottom: 1px solid #2160a0;' align='right'><span style='font-weight: bold;'> " . number_format($booking['fee'], 2, '.', '') . "</span></td>
                              </tr>
                              <tr>
                                <td id='titlelr'>&nbsp;</td>
                                <td  id='titlelr' align='center' colspan='2'><span style='font-weight: bold;'>Total Amount Paid</span></td>
                                <td id='titlelr' align='right'><span style='font-weight: bold;'>$  " . $pago . " </span></td>
                              </tr>
                            </table>
                            <br>
                        </td>
                   </tr>
                   <tr>
                        <td colspan='4' align='center'>
                            <table width='100%' style='border: 1px solid #e6e6e6;background-color: #fdfdfd;' border='0' cellpadding='3' id='tableorder'>
                              <tr>
                                <td width='0%' id='titlett'>
                                &nbsp;
                                </td>
                                <td width='100%' height='29' colspan='4' align='center'  id='titlett' style='font-size: 14px; font-weight: bold;padding-top: 10px;padding-bottom: 10px;'>
                                    <span style='font-size: 9px;color: black; font-weight: bold;'>Non-Refundable - Non-Transferable - No Schedule Changes Permitted <br>
                                    No pets allowed on board - luggage restrictions apply 1 Bag per person. <br>
                                    Please read additional terms <a href='http://www.supertours.com'>www.supertours.com</a><br>
                                    Have a SUPER trip!<br />
                                    <br/>
                                    SUPER TOURS.<br>
                                    Phone: (407) 370-3001 Orlando / (305) 677-2676 Miami / e-mail: reservations@supertours.com
                                  </span>
                                </td>
                                
                              </tr>
                            </table>
                            <br>
                        </td>
                   </tr>
                </table>

    </body>
</html>";
// print_r($codigoHTML);
// die;
    $codigoHTML = mb_convert_encoding($codigoHTML, 'HTML-ENTITIES', 'UTF-8');

      $pdf = new DooPDF(''.$booking['codconf'].'', $codigoHTML, false, 'letter', 'letter');
      $pdf->doPDF();
                    $mail->MsgHTML("
                    <!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
                    <html xmlns='http://www.w3.org/1999/xhtml'>
                        <head>

                      
                      <meta name='viewport' content='width=device-width, initial-scale=1'>
                      <meta http-equiv='X-UA-Compatible' content='IE=edge' />
                      <title>Mail</title>
                        <style type='text/css'>
                            * { -webkit-text-size-adjust:none; -ms-text-size-adjust:none; max-height:1000000px;}
                            table {border-collapse: collapse !important;}
                            #outlook a {padding:0;}
                            .ReadMsgBody { width: 100%; }
                            .ExternalClass { width: 100%; }
                            .ExternalClass * { line-height: 100%; }
                            .ios_geo a { color:#1c1c1c !important; text-decoration:none !important; }

                            #clearTable {
                                    /*width: 800px;*/
                                    font-size: 13px;
                                    font-family: Verdana, Geneva, sans-serif;
                            }
                            #clearTable tr #titletd3 {
                                    font-family: Verdana, Geneva, sans-serif;
                            }
                            #clearTable tr #titletd2 {
                                    font-size: 20px;
                            }
                            #clearTable tr td.p {
                                    text-align: center;
                            }
                            #clearTable td{
                                padding: 1px 5px;

                            }
                            #content #center-column #tdgris {
                                    background-color: #F0F0F0;
                            }
                            #content #center-column #tdrojo {
                                    background-color: #FFE6E6;
                            }
                            #content #center-column1 #titletd {
                                    background-color: #F5EDEB;
                                    padding-left: 5px;
                                    font-size: 12px;
                            }
                             #titlett {
                                    background-color: #ececec;
                                    color: #1f2b56;
                                    padding-left: 5px;
                                    font-size: 12px;
                            }
                             #titlell {
                                    padding-left: 5px;
                                    font-size: 12px;
                                    border-bottom-width: 1px;
                                    border-left-width: 1px;
                                    border-bottom-style: solid;
                                    border-left-style: solid;
                                    border-bottom-color: #E6E6E6;
                                    border-left-color: #E6E6E6;
                            }
                            #titlelp {
                                    font-size: 11px;
                                    border-bottom-width: 1px;
                                    border-bottom-style: solid;
                                    border-bottom-color: #E6E6E6;
                                    border-right: 1px;
                                    border-right-style: solid;
                                    border-right-color: #e6e6e6;
                            }
                             #titlelr {
                                    padding-left: 5px;
                                    font-size: 12px;
                                    border-top: 1px solid #2160a0;
                                    color: #CE0000;
                            }
                             #tdgristable {
                                    background-color: #FFF;
                                    padding-left: 5px;
                            }
                            </style>
                        </head>
                        <body>
                                    <table id='clearTable' style='-webkit-print-color-adjust: exact; /*economy | exact*/color-adjust: exact;max-width: 900px;min-width: 640px;' align='center'>
                                        <tr>
                                          <td align='center'>
                                            <table width='98%' style='background-color: #ececec;'>
                                              <tr>
                                                 <td width='164' rowspan='' id='titletd3'>
                                                  <a href='http://www.supertours.com' target='_blank'>
                                                    <img src='".$this->data['rootUrl']."global/estilos/logo.png' width='164' height='62' />
                                                  </a>
                                                  </td>
                                                 <td rowspan='2' style='color: #000;font-size: 9px;' colspan='3' align='right' id='titletd3'>
                                                    <b>DATE/TIME OF BOOKING<br>
                                                      <span style='color: #dc3545;'>" . $booking['fecha_ini'] . " / " . $booking['hora'] . "</span>
                                                    </b>
                                                    <br><br>
                                                    <table>
                                                      <tr style='font-size: 14px; border: 1px solid #d8d3d3; background-color: white;'>
                                                        <td align='center'>Ticket Confirmation #</td>
                                                      </tr>
                                                      <tr style='font-size: 14px; border: 1px solid #d8d3d3; background-color: black; color: white;'>
                                                        <td align='center' id='titletd7'><b>".$booking['codconf']."</b></td>
                                                      </tr>
                                                      <tr>
                                                        <td align='center' id='titletd7' style='font-size: 10px; '>&nbsp;</td>
                                                      </tr>
                                                    </table>
                                                 </td>
                                              </tr>
                                              <tr>
                                                <td style='background-color: #fff; border: 1px solid #e6e6e6; color: #2f2f2f;font-weight: bold;' align='center' height='33' colspan='' id='titletd2'>E-TICKET</td>
                                              </tr>
                                            </table>
                                          </td>
                                        </tr>
                                        <tr>
                                          <td colspan='4' align='center'>
                                            <br>
                                            <table width='99%'>
                                              <tr>
                                                  <td height='15' id='titletd6'>
                                                  " .$opcuser1. "" .$opcuser2. "" .$opcuser3. "" .$opcuser4. "" .$opcuser5. "" .$opcuser6. "" .$opcuser7. "" .$opcuser8. "
                                                  </td>
                                              </tr>
                                                 <tr>
                                                  <td height='15' id='titletd6'>
                                                  " .$opcchild1. "" .$opcchild2. "" .$opcchild3. "" .$opcchild4. "" .$opcchild5. "" .$opcchild6. "" .$opcchild7. "" .$opcchild8. "
                                                  </td>

                                                <td colspan='' id='titletd6'>
                                                  AD: <b>".$booking['pax']."</b><strong>  </strong>CHD: <b>".$booking['chil']."</b> TOTAL: <strong>".$totalpax."</span>
                                                </td>
                                                </tr>
                                              <tr id=''>
                                                <td colspan='' id='' align='left'>Address: <b>" . ucwords(strtolower($user4->address)) . "</b></td>
                                                <td colspan='' id='' align='left'>City: <b>" . ucwords(strtolower($user4->city)) . "</b></td>
                                              </tr>
                                              <tr id=''>
                                                <td id='' align='left'>State: <b>" . ucwords(strtolower($user4->state)) . "</b></td>
                                                <td id='' align='left'>Zip / Postal Code: <b>" . $user4->zip . "</b></td>
                                              </tr>
                                              <tr id=''>
                                                <td colspan='' align='left' id=''>Country: <b>" . ucwords(strtolower($user4->country)) . "</b></td>
                                                <td colspan='' id='' align='left'>Phone: <b>" . $user4->phone . "</b></td>
                                              </tr>
                                            </table>
                                            <br>
                                          </td>
                                        </tr>
                                        <tr>
                                          <td colspan='4' align='center'>
                                            <table width='98%' style='border: 1px solid #e6e6e6;background-color: #fdfdfd;' height='125' id='tableorder'>
                                              <tr>
                                                <td height='25' id='titlett' class='p' colspan='4' style='font-size: 14px; font-weight: bold; '> <b>" . strtoupper($booking['ticke']) . " </b></td>
                                              </tr>
                                              <tr>
                                                <td id='titlelp' width='45%'>
                                                  Trip: <strong>" . $booking['trip_no'] . "</strong><a>  </a><strong>" . $company . "</strong>
                                                </td>
                                                <td id='titlelp' colspan='2'>
                                                  Departure Date: <strong>" . date('M-d-Y', strtotime($fecha)) . "</strong>
                                                  <br>
                                                  Departure Time: <strong>" . date('g:i a', strtotime($booking['trip_departure'])) . "</strong>
                                                </td>
                                              </tr>
                                              <tr>
                                                <td id='titlelp'>
                                                  From: <strong>" . $booking['from_name'] . "</strong>
                                                </td>
                                                <td id='titlelp' colspan='2'>
                                                  Departure Location: <strong>" . $place1 . "</strong>
                                                </td>
                                              </tr>
                                              <tr>
                                                <td id='titlelp'>
                                                  To: <strong>" . $booking['to_name'] . "</strong>
                                                </td>
                                                <td id='titlelp' colspan='2'>
                                                  Arrival Time: <strong>" . date('g:i a', strtotime($booking['trip_arrival'])) . "</strong>
                                                  <br>
                                                  Drop Off: <strong>" . $place2 . "</strong>
                                                </td>
                                              </tr>
                                            </table>
                                            <table id='tableorder2' width='100%'>
                                              <tr>
                                                <td style='color: #dc3545; font-weight: bold;font-size: 11px;' align='center' height='35' id='titlett2'  >
                                                  Please print and present this e-ticket to for boarding.
                                                  <br/>
                                                  Passenger needs to arrive at least " . $timeBSalida ." minutes prior to departure.</td>
                                              </tr>
                                            </table>
                                          </td>
                                        </tr>
                                        <tr>
                                          <td colspan='4' align='center'>
                                            <table width='99%' style='border: 1px solid #e6e6e6;background-color: #fdfdfd;' border='0' cellpadding='3' id='tableorder'>
                                                  <tr>
                                                    <td height='29' colspan='4' align='center'  id='titlett' style='font-size: 14px; font-weight: bold;'><strong>PURCHASE SUMMARY</strong></td>
                                                  </tr>
                                                  <tr>
                                                    <td id='titlelp'>&nbsp;</td>
                                                    <td id='titlelp' style='text-align: left; font-weight: bold;'>
                                                      Passenger Traveling
                                                    </td>
                                                    <td id='titlelp' style='text-align: right; font-weight: bold;'>
                                                      Fare
                                                    </td>
                                                    <td id='titlelp' style='text-align: right; font-weight: bold;'>
                                                      Total
                                                    </td>
                                                  </tr>
                                                 <tr>
                                                    <td id='titlelp' width='55%'>" . $booking['ticke'] . " Adults</td>
                                                    <td id='titlelp' style='color: #2160a0' align='center' width='7%'><span style='font-weight: bold;'>" . $booking['pax'] . "</span></td>
                                                    <td id='titlelp' style='color: #2160a0' align='right' width='13%'><span style='font-weight: bold;'>" . $precioAdultT . "</span></td>
                                                    <td id='titlelp' style='color: #2160a0' width='13%' align='right'><span style='font-weight: bold;'>" . $precioTotalAdultT . "</span></td>
                                                  </tr>
                                                  <tr>
                                                    <td id='titlelp'>" . $booking['ticke'] . " Children (0-9 Years)</td>
                                                    <td id='titlelp' style='color: #2160a0' align='center'><span style='font-weight: bold;'>" . $booking['chil'] . "</span></td>
                                                        <td id='titlelp' style='color: #2160a0' align='right'><span style='font-weight: bold;'>" . $precioChildT . "</span></td>
                                                        <td id='titlelp' style='color: #2160a0' align='right'><span style='font-weight: bold;'>" . $precioTotalChildT . "</span></td>
                                                  </tr>
                                                  <tr id='titlelp'>
                                                    <td id='titlell' colspan='3' style='border-right: 1px solid #e6e6e6;border-bottom: 1px solid #2160a0;'> Service Fee </td>
                                                    <td id='titlelp' style='color: #2160a0;border-bottom: 1px solid #2160a0;' align='right'><span style='font-weight: bold;'> " . number_format($booking['fee'], 2, '.', '') . "</span></td>
                                                  </tr>
                                                  <tr>
                                                    <td id='titlelr'>&nbsp;</td>
                                                    <td  id='titlelr' align='center' colspan='2'><span style='font-weight: bold;'>Total Amount Paid</span></td>
                                                    <td id='titlelr' align='right'><span style='font-weight: bold;'>$  " . $pago . " </span></td>
                                                  </tr>
                                            </table>
                                            <br>
                                                <table width='100%' style='border: 1px solid #e6e6e6;background-color: #fdfdfd;' border='0' cellpadding='3' id='tableorder'>
                                                  <tr>
                                                    <td colspan='0' width='0%' id='titlett'>
                                                    &nbsp;
                                                    </td>
                                                    <td colspan='3' width='100%' height='29' colspan='4' align='center'  id='titlett' style='font-size: 14px; font-weight: bold;padding-top: 10px;padding-bottom: 10px;'>
                                                        <span style='font-size: 9px;color: black; font-weight: bold;'>Non-Refundable - Non-Transferable - No Schedule Changes Permitted <br>
                                                        No pets allowed on board - luggage restrictions apply 1 Bag per person. <br>
                                                        Please read additional terms <a href='http://www.supertours.com'>www.supertours.com</a><br>
                                                        Have a SUPER trip!<br />
                                                        <br/>
                                                        SUPER TOURS.<br>
                                                        Phone: (407) 370-3001 Orlando / (305) 677-2676 Miami / e-mail: reservations@supertours.com
                                                      </span>
                                                    </td>
                                                    
                                                  </tr>
                                                </table>
                                          </td>
                                        </tr>
                                    </table>
                        </body>
                    </html>");
                } else {

                $timeBRegreso=15;
                if($booking['to_name']=='Orlando'){
                    $timeBRegreso=30;
                }else{
                    $timeBRegreso=$timeBRegreso;
                }
                    //Para PDF
                    $codigoHTML = "
                    <!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
                    <html xmlns='http://www.w3.org/1999/xhtml'>
                        <head>

                      <!-- view port meta tag-->
                      <meta name='viewport' content='width=device-width, initial-scale=1'>
                      <meta http-equiv='X-UA-Compatible' content='IE=edge' />
                      <title>Mail Round Trip</title>
                        <style type='text/css'>
                            * { -webkit-text-size-adjust:none; -ms-text-size-adjust:none; max-height:1000000px;}
                            table {border-collapse: collapse !important;}
                            #outlook a {padding:0;}
                            .ReadMsgBody { width: 100%; }
                            .ExternalClass { width: 100%; }
                            .ExternalClass * { line-height: 100%; }
                            .ios_geo a { color:#1c1c1c !important; text-decoration:none !important; }

                            #clearTable {
                                    /*width: 800px;*/
                                    font-size: 13px;
                                    font-family: Verdana, Geneva, sans-serif;
                            }
                            #clearTable tr #titletd3 {
                                    font-family: Verdana, Geneva, sans-serif;
                            }
                            #clearTable tr #titletd2 {
                                    font-size: 20px;
                            }
                            #clearTable tr td.p {
                                    text-align: center;
                            }
                            #clearTable td{
                                padding: 1px 5px;

                            }
                            #content #center-column #tdgris {
                                    background-color: #F0F0F0;
                            }
                            #content #center-column #tdrojo {
                                    background-color: #FFE6E6;
                            }
                            #content #center-column1 #titletd {
                                    background-color: #F5EDEB;
                                    padding-left: 5px;
                                    font-size: 12px;
                            }
                             #titlett {
                                    background-color: #e6e6e6;
                                    color: #1f2b56;
                                    padding-left: 5px;
                                    font-size: 12px;
                            }
                             #titlell {
                                    padding-left: 5px;
                                    font-size: 12px;
                                    border-bottom-width: 1px;
                                    border-left-width: 1px;
                                    border-bottom-style: solid;
                                    border-left-style: solid;
                                    border-bottom-color: #E6E6E6;
                                    border-left-color: #E6E6E6;
                            }
                            #titlelp {
                                    font-size: 11px;
                                    border-bottom-width: 1px;
                                    border-bottom-style: solid;
                                    border-bottom-color: #E6E6E6;
                                    border-right: 1px;
                                    border-right-style: solid;
                                    border-right-color: #e6e6e6;
                            }
                             #titlelr {
                                    padding-left: 5px;
                                    font-size: 12px;
                                    border-top: 1px solid #2160a0;
                                    color: #CE0000;
                            }
                             #tdgristable {
                                    background-color: #FFF;
                                    padding-left: 5px;
                            }
                            </style>
                        </head>
                        <body>
                            <table id='clearTable' style='-webkit-print-color-adjust: exact; /*economy | exact*/color-adjust: exact;width: 100%;' align='center'>
                                <tr>
                                            <td colspan='4' align='center'>
                                                <table width='99%' style='border: 1px solid #e6e6e6;' id='tableorder'>
                                                  <tr style='background-color: #ececec;'>
                                                    <td rowspan='' id='titletd3'>
                                                     <a href='http://www.supertours.com' target='_blank'>
                                                       <img src='global/estilos/logo.png' width='164' height='62' />
                                                     </a>
                                                     </td>
                                                    <td rowspan='' style='color: #000;font-size: 12px;' colspan='5' align='right' id='titletd3'>
                                                    <br>
                                                        <table width='100%' align='right'>
                                                            <tr>
                                                                <td align='right'>
                                                                    <span style='font-weight: bold;'>DATE/TIME OF BOOKING</span>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td align='right'>
                                                                    <span style='font-weight: bold;color: #dc3545;'>" . $booking['fecha_ini'] . " / " . $booking['hora'] . "</span>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                  </tr>
                                                  <tr style='background-color: #ececec;'>
                                                    <td width='25%' colspan='3' style='border: 1px solid #e6e6e6; color: #2f2f2f;font-weight: bold;' align='center' height='39' colspan='' id='titletd2'>
                                                        <table align='right' width='100%'>
                                                            <tr>
                                                                <td width='56%' style='color:#ececec;'>
                                                                .
                                                                </td>
                                                                <td width='44%' style='font-size:30px;' height='39'>
                                                                    E-TICKET
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                    <td width='10%' align='right' colspan='3'>
                                                        <table align='right' width='100%'>
                                                            <tr style='background-color:white;'>
                                                             <td align='center'> Ticket Confirmation #: </td>
                                                            </tr>
                                                            <tr>
                                                              <td align='center' width='22%' style='color: white;font-size: 14px; border: 1px solid #d8d3d3; background-color: black;font-weight: bold;'>".$booking['codconf']."</td>
                                                            </tr>
                                                            <tr id='titletd7' style='background-color:#ececec;font-size: 10px; '>
                                                                <td align='center'>&nbsp;</td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                  </tr>
                                                </table>
                                                <br>
                                            </td>
                                       </tr>
                                <tr>
                                  <td colspan='4' align='center'>
                                    <table width='99%'>
                                      <tr>
                                          <td height='15' id='titletd6'>
                                          " .$opcuser1. "" .$opcuser2. "" .$opcuser3. "" .$opcuser4. "" .$opcuser5. "" .$opcuser6. "" .$opcuser7. "" .$opcuser8. "
                                          </td>
                                      </tr>
                                      <tr>
                                      <td height='15' id='titletd6'>
                                      " .$opcchild1. "" .$opcchild2. "" .$opcchild3. "" .$opcchild4. "" .$opcchild5. "" .$opcchild6. "" .$opcchild7. "" .$opcchild8. "
                                      </td>
                                        <td colspan='' id='titletd6'>
                                          AD: <span style='font-weight: bold;'>".($booking['pax'])."</span> CHD: <span style='font-weight: bold;'>".($booking['chil'])."</span> TOTAL: <span style='font-weight: bold;'>".($totalpax)."</span>
                                        </td>
                                      </tr>
                                      <tr>
                                        <td id='' align='left'>Address: <span style='font-weight: bold;'>" . ucwords(strtolower($user4->address)) . "</span></td>
                                        <td colspan='' id='' align='left'>City: <span style='font-weight: bold;'>" . ucwords(strtolower($user4->city)) . "</span></td>
                                      </tr>
                                      <tr>
                                        <td id='' align='left'>State: <span style='font-weight: bold;'>" . ucwords(strtolower($user4->state)) . "</span></td>
                                        <td id='' align='left'>Zip / Postal Code: <span style='font-weight: bold;'>" . $user4->zip . "</span></td>
                                      </tr>
                                      <tr>
                                        <td id='' align='left'>Country: <span style='font-weight: bold;'>" . ucwords(strtolower($user4->country)) . "</span></td>
                                        <td  id='' align='left'>Phone: <span style='font-weight: bold;'>" . $user4->phone . "</span></td>
                                      </tr>
                                    </table>
                                    <br>
                                  </td>
                                </tr>
                                <tr>
                                  <td colspan='4' align='center'>
                                    <table  width='99%' style='border: 1px solid #e6e6e6;background-color: #fdfdfd;' height='125' id='tableorder'>
                                      <tr>
                                        <td height='25' id='titlett' class='p' colspan='3' style='font-size: 14px; font-weight: bold;'> <span style='font-weight: bold;'>" . strtoupper($booking['ticke']) . " </span></td>
                                      </tr>
                                      <tr>
                                        <td  id='titlelp' width='45%'>
                                          Trip: <strong>" . $booking['trip_no'] . " - </strong><a>  </a><strong>" . $company . "</strong>  -  AD: <strong>". $booking['pax'] ."</strong> ~ CHD: <strong>". $booking['chil'] ."</strong>
                                        </td>
                                        <td id='titlelp' width='55%' colspan='2'>
                                          Departure Date: <strong>" . date('M-d-Y', strtotime($fecha)) . "</strong>
                                          <br>
                                          Departure Time: <strong>" . date('g:i a', strtotime($booking['trip_departure'])) . "</strong>
                                        </td>
                                      </tr>
                                      <tr>
                                        <td id='titlelp'>
                                          From: <strong>" . $booking['from_name'] . "</strong>
                                        </td>
                                        <td colspan='2' id='titlelp'>
                                          Departure Location: <strong>" . $place1 . "
                                            </strong>
                                        </td>
                                      </tr>
                                      <tr>
                                        <td id='titlelp'>To: <strong>" . $booking['to_name'] . "</strong></td>
                                        <td colspan='2' id='titlelp'>
                                            Arrival Time: <strong>" . date('g:i a', strtotime($booking['trip_arrival'])) . "</strong>
                                                <br>
                                            Drop Off: <strong>" . $place2 . "</strong>
                                        </td>
                                      </tr>
                                      <tr >
                                        <td colspan='3' id='titlelp' style='color: #dc3545; font-weight: bold;font-size: 11px;' align='center' height='35' id='titlett2'  >
                                          Please print and present this e-ticket to for boarding.
                                          <br/>
                                          Passenger needs to arrive at least " . $timeBSalida ." minutes prior to departure.</td>
                                      </tr>
                                      <tr>
                                        <td colspan='3' id='titlelp' height='1' style='background-color: #e6e6e6;'></td>
                                      </tr>
                                      <tr>
                                        <td id='titlelp'>Trip: <strong>" . $booking['trip_no2'] . " - </strong><a>  </a><strong>" . $company2 . "</strong> - AD: <strong>". $booking['pax'] ."</strong> ~ CHD: <strong>". $booking['chil'] ."</strong></td>
                                        <td id='titlelp' colspan='2'>
                                          Return Date: <strong>" . date('M-d-Y', strtotime($fecha1)) . "</strong>
                                          <br>
                                          Departure Time: <strong>" . date('g:i a', strtotime($booking['trip_departure2'])) . "</strong>
                                        </td>
                                      </tr>
                                      <tr>
                                        <td id='titlelp'>From: <strong>" . $booking['to_name'] . "</strong></td>
                                        <td id='titlelp' colspan='2'>
                                            Departure Location: <strong>" . $place3 . "</strong>
                                        </td>
                                      </tr>
                                      <tr>
                                        <td id='titlelp' height='27'>To: <strong>" . $booking['from_name'] . "</strong></td>
                                        <td id='titlelp' colspan='2'>
                                            Arrival Time: <strong>" . date('g:i a', strtotime($booking['trip_arrival2'])) . "</strong>
                                            <br>
                                            Drop Off: <strong>" . $place4 . "</strong>
                                        </td>
                                      </tr>
                                      <tr>
                                        <td colspan='3' id='titlelp' style='color: #dc3545; font-weight: bold;font-size: 11px;' align='center' height='35' id='titlett2'  >
                                          Please print and present this e-ticket to for boarding.
                                          <br/>
                                          Passenger needs to arrive at least " . $timeBRegreso ." minutes prior to departure.</td>
                                      </tr>
                                    </table>
                                    <br/>
                                  </td>
                                </tr>
                                <tr>
                                  <td colspan='4' align='center'>
                                    <table width='99%' style='border: 1px solid #e6e6e6;background-color: #fdfdfd;' border='0' cellpadding='3' id='tableorder'>
                                      <tr>
                                        <td height='29' colspan='4' align='center'  id='titlett' style='font-size: 14px; font-weight: bold;'><strong>PURCHASE SUMMARY</strong></td>
                                      </tr>
                                      <tr>
                                        <td id='titlelp'>&nbsp;</td>
                                        <td id='titlelp' style='text-align: left; font-weight: bold;'>
                                          Passenger Traveling
                                        </td>
                                        <td id='titlelp' style='text-align: right; font-weight: bold;'>
                                          Fare
                                        </td>
                                        <td id='titlelp' style='text-align: right; font-weight: bold;'>
                                          Total
                                        </td>
                                      </tr>
                                     <tr>
                                        <td id='titlelp' width='55%'>" . $booking['ticke'] . " Adults</td>
                                        <td id='titlelp' style='color: #2160a0' align='center' width='7%'><span style='font-weight: bold;'>" . $booking['pax'] . "</span></td>
                                        <td id='titlelp' style='color: #2160a0' align='right' width='13%'><span style='font-weight: bold;'>" . $precioAdultT . "</span></td>
                                        <td id='titlelp' style='color: #2160a0' width='13%' align='right'><span style='font-weight: bold;'>" . $precioTotalAdultT . "</span></td>
                                      </tr>
                                      <tr>
                                        <td id='titlelp'>" . $booking['ticke'] . " Children (0-9 Years)</td>
                                        <td id='titlelp' style='color: #2160a0' align='center'><span style='font-weight: bold;'>" . $booking['chil'] . "</span></td>
                                        <td id='titlelp' style='color: #2160a0' align='right'><span style='font-weight: bold;'>" . $precioChildT . "</span></td>
                                        <td id='titlelp' style='color: #2160a0' align='right'><span style='font-weight: bold;'>" . $precioTotalChildT . "</span></td>
                                      </tr>
                                      <tr id='titlelp'>
                                        <td id='titlell' colspan='3' style='border-right: 1px solid #e6e6e6;border-bottom: 1px solid #2160a0;'> Service Fee </td>
                                        <td id='titlelp' style='color: #2160a0; border-bottom: 1px solid #2160a0;' align='right'><span style='font-weight: bold;'>" . number_format($booking['fee'], 2, '.', '') . "</span></td>
                                      </tr>
                                      <tr>
                                        <td id='titlelr'>&nbsp;</td>
                                        <td  id='titlelr' align='center' colspan='2'><span style='font-weight: bold;'>Total Amount Paid</span></td>
                                        <td id='titlelr' align='right'><span style='font-weight: bold;'>$  " . $pago . " </span></td>
                                      </tr>
                                    </table>
                                    <br>
                                  </td>
                                </tr>
                                <tr>
                                    <td colspan='4' align='center'>
                                        <table width='100%' style='border: 1px solid #e6e6e6;background-color: #fdfdfd;' border='0' cellpadding='3' id='tableorder'>
                                                  <tr>
                                                    <td width='0%' id='titlett'>
                                                    &nbsp;
                                                    </td>
                                                    <td width='100%' height='29' colspan='4' align='center'  id='titlett' style='font-size: 14px; font-weight: bold;padding-top: 10px;padding-bottom: 10px;'>
                                                        <span style='font-size: 9px;color: black; font-weight: bold;'>Non-Refundable - Non-Transferable - No Schedule Changes Permitted <br>
                                                        No pets allowed on board - luggage restrictions apply 1 Bag per person. <br>
                                                        Please read additional terms <a href='http://www.supertours.com'>www.supertours.com</a><br>
                                                        Have a SUPER trip!<br />
                                                        <br/>
                                                        SUPER TOURS.<br>
                                                        Phone: (407) 370-3001 Orlando / (305) 677-2676 Miami / e-mail: reservations@supertours.com
                                                      </span>
                                                    </td>
                                                    
                                                  </tr>
                                        </table>
                                        <br>
                                    </td>
                               </tr>
                            </table>
                        </body>
                    </html>";
                    // print_r($codigoHTML);
                    // die;
                  $codigoHTML = mb_convert_encoding($codigoHTML, 'HTML-ENTITIES', 'UTF-8');

                    $pdf = new DooPDF(''.$booking['codconf'].'', $codigoHTML, false, 'letter', 'letter');
                    $pdf->doPDF();
      //Fin de PDF

      ///Para mail
                    $mail->MsgHTML("<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
                    <html xmlns='http://www.w3.org/1999/xhtml'>
                        <head>

                      
                      <meta name='viewport' content='width=device-width, initial-scale=1'>
                      <meta http-equiv='X-UA-Compatible' content='IE=edge' />
                      <title>Mail Round Trip</title>
                        <style type='text/css'>
                            * { -webkit-text-size-adjust:none; -ms-text-size-adjust:none; max-height:1000000px;}
                            table {border-collapse: collapse !important;}
                            #outlook a {padding:0;}
                            .ReadMsgBody { width: 100%; }
                            .ExternalClass { width: 100%; }
                            .ExternalClass * { line-height: 100%; }
                            .ios_geo a { color:#1c1c1c !important; text-decoration:none !important; }

                            #clearTable {
                                    /*width: 800px;*/
                                    font-size: 13px;
                                    font-family: Verdana, Geneva, sans-serif;
                            }
                            #clearTable tr #titletd3 {
                                    font-family: Verdana, Geneva, sans-serif;
                            }
                            #clearTable tr #titletd2 {
                                    font-size: 20px;
                            }
                            #clearTable tr td.p {
                                    text-align: center;
                            }
                            #clearTable td{
                                padding: 1px 5px;

                            }
                            #content #center-column #tdgris {
                                    background-color: #F0F0F0;
                            }
                            #content #center-column #tdrojo {
                                    background-color: #FFE6E6;
                            }
                            #content #center-column1 #titletd {
                                    background-color: #F5EDEB;
                                    padding-left: 5px;
                                    font-size: 12px;
                            }
                             #titlett {
                                    background-color: #e6e6e6;
                                    color: #1f2b56;
                                    padding-left: 5px;
                                    font-size: 12px;
                            }
                             #titlell {
                                    padding-left: 5px;
                                    font-size: 12px;
                                    border-bottom-width: 1px;
                                    border-left-width: 1px;
                                    border-bottom-style: solid;
                                    border-left-style: solid;
                                    border-bottom-color: #E6E6E6;
                                    border-left-color: #E6E6E6;
                            }
                            #titlelp {
                                    font-size: 11px;
                                    border-bottom-width: 1px;
                                    border-bottom-style: solid;
                                    border-bottom-color: #E6E6E6;
                                    border-right: 1px;
                                    border-right-style: solid;
                                    border-right-color: #e6e6e6;
                            }
                             #titlelr {
                                    padding-left: 5px;
                                    font-size: 12px;
                                    border-bottom-width: 1px;
                                    border-bottom-style: solid;
                                    border-bottom-color: #CE0000;
                                    color: #CE0000;
                            }
                             #tdgristable {
                                    background-color: #FFF;
                                    padding-left: 5px;
                            }
                            </style>
                        </head>
                        <body>
                            <table id='clearTable' style='-webkit-print-color-adjust: exact; /*economy | exact*/color-adjust: exact;max-width: 900px;min-width: 640px;' align='center'>
                                <tr>
                                    <td align='center'>
                                        <table width='98%' style='background-color: #ececec;'>
                                              <tr>
                                                 <td width='164' rowspan='' id='titletd3'>
                                                  <a href='http://www.supertours.com' target='_blank'>
                                                    <img src='".$this->data['rootUrl']."global/estilos/logo.png' width='164' height='62' />
                                                  </a>
                                                  </td>
                                                 <td rowspan='2' style='color: #000;font-size: 9px;' colspan='3' align='right' id='titletd3'>
                                                    <b>DATE/TIME OF BOOKING<br>
                                                      <span style='color: #dc3545;'>" . $booking['fecha_ini'] . " / " . $booking['hora'] . "</span>
                                                    </b>
                                                    <br><br>
                                                    <table>
                                                      <tr style='font-size: 14px; border: 1px solid #d8d3d3; background-color: white;'>
                                                        <td align='center'>Ticket Confirmation #</td>
                                                      </tr>
                                                      <tr style='font-size: 14px; border: 1px solid #d8d3d3; background-color: black; color: white;'>
                                                        <td align='center' id='titletd7'><b>".$booking['codconf']."</b></td>
                                                      </tr>
                                                      <tr>
                                                        <td align='center' id='titletd7' style='font-size: 10px; '>&nbsp;</td>
                                                      </tr>
                                                    </table>
                                                 </td>
                                              </tr>
                                              <tr>
                                                <td style='background-color: #fff; color: #2f2f2f;font-weight: bold; border: 1px solid #e6e6e6;' align='center' height='33' colspan='' id='titletd2'>E-TICKET</td>
                                              </tr>
                                            </table>
                                    </td>
                                </tr>
                                <tr>
                                  <td colspan='4' align='center'>
                                    <br>
                                    <table width='99%'>
                                      <tr>
                                          <td height='15' id='titletd6'>
                                          " .$opcuser1. "" .$opcuser2. "" .$opcuser3. "" .$opcuser4. "" .$opcuser5. "" .$opcuser6. "" .$opcuser7. "" .$opcuser8. "
                                          </td>
                                      </tr>
                                     <tr>
                                      <td height='15' id='titletd6'>
                                      " .$opcchild1. "" .$opcchild2. "" .$opcchild3. "" .$opcchild4. "" .$opcchild5. "" .$opcchild6. "" .$opcchild7. "" .$opcchild8. "
                                      </td>
                                        <td colspan='' id='titletd6'>
                                          AD: <span style='font-weight: bold;'>".($booking['pax'])."</span> CHD: <span style='font-weight: bold;'>".($booking['chil'])."</span> TOTAL: <span style='font-weight: bold;'>".($totalpax)."</span>
                                        </td>
                                      </tr>

                                      <tr>
                                        <td id='' align='left'>Address: <b>" . ucwords(strtolower($user4->address)) . "</b></td>
                                        <td colspan='' id='' align='left'>City: <b>" . ucwords(strtolower($user4->city)) . "</b></td>
                                      </tr>
                                      <tr>
                                        <td id='' align='left'>State: <b>" . ucwords(strtolower($user4->state)) . "</b></td>
                                        <td id='' align='left'>Zip / Postal Code: <b>" . $user4->zip . "</b></td>
                                      </tr>
                                      <tr>
                                        <td id='' align='left'>Country: <b>" . ucwords(strtolower($user4->country)) . "</b></td>
                                        <td  id='' align='left'>Phone: <b>" . $user4->phone . "</b></td>
                                      </tr>
                                    </table>
                                    <br>
                                  </td>
                                </tr>
                                <tr>
                                  <td colspan='4' align='center'>
                                    <table  width='99%' style='border: 1px solid #e6e6e6;background-color: #fdfdfd;' height='125' id='tableorder'>
                                      <tr>
                                        <td height='25' id='titlett' class='p' colspan='3' style='font-size: 14px; font-weight: bold;'> <span style='font-weight: bold;'>" . strtoupper($booking['ticke']) . " </span></td>
                                      </tr>
                                      <tr>
                                        <td  id='titlelp' width='45%'>
                                          Trip: <strong>" . $booking['trip_no'] . "</strong><a>  </a><strong>" . $company . "</strong> - AD: <strong>". $booking['pax'] ."</strong> ~ CHD: <strong>". $booking['chil'] ."</strong>
                                        </td>
                                        <td id='titlelp' width='55%' colspan='2'>
                                          Departure Date: <strong>" . date('M-d-Y', strtotime($fecha)) . "</strong>
                                          <br>
                                          Departure Time: <strong>" . date('g:i a', strtotime($booking['trip_departure'])) . "</strong>
                                        </td>
                                      </tr>
                                      <tr>
                                        <td id='titlelp'>
                                          From: <strong>" . $booking['from_name'] . "</strong>
                                        </td>
                                        <td colspan='2' id='titlelp'>
                                          Departure Location: <strong>" . $place1 . "
                                            </strong>
                                        </td>
                                      </tr>
                                      <tr>
                                        <td id='titlelp'>To: <strong>" . $booking['to_name'] . "</strong></td>
                                        <td colspan='2' id='titlelp'>
                                            Arrival Time: <strong>" . date('g:i a', strtotime($booking['trip_arrival'])) . "</strong>
                                            <br>
                                            Drop Off: <strong>" . $place2 . "</strong>
                                        </td>
                                      </tr>
                                      <tr >
                                        <td colspan='3' id='titlelp' style='color: #dc3545; font-weight: bold;font-size: 11px;' align='center' height='35' id='titlett2'  >
                                          Please print and present this e-ticket to for boarding.
                                          <br/>
                                          Passenger needs to arrive at least " . $timeBSalida ." minutes prior to departure.</td>
                                      </tr>
                                      <tr>
                                        <td colspan='3' id='titlelp' height='1' style='background-color: #e6e6e6;'></td>
                                      </tr>
                                      <tr>
                                        <td id='titlelp'>Trip: <strong>" . $booking['trip_no2'] . "</strong> - <strong>" . $company2 . "</strong> - AD: <strong>". $booking['pax'] ."</strong> ~ CHD: <strong>". $booking['chil'] ."</strong></td>
                                        <td id='titlelp' colspan='2'>
                                          Return Date: <strong>" . date('M-d-Y', strtotime($fecha1)) . "</strong>
                                          <br>
                                          Departure Time: <strong>" . date('g:i a', strtotime($booking['trip_departure2'])) . "</strong>
                                        </td>
                                      </tr>
                                      <tr>
                                        <td id='titlelp'>From: <strong>" . $booking['to_name'] . "</strong></td>
                                        <td id='titlelp' colspan='2'>
                                            Departure Location: <strong>" . $place3 . "</strong>
                                        </td>
                                      </tr>
                                      <tr>
                                        <td id='titlelp' height='27'>To: <strong>" . $booking['from_name'] . "</strong></td>
                                        <td id='titlelp' colspan='2'>
                                            Arrival Time: <strong>" . date('g:i a', strtotime($booking['trip_arrival2'])) . "</strong>
                                            <br>
                                            Drop Off: <strong>" . $place4 . "</strong>
                                        </td>
                                      </tr>
                                      <tr>
                                        <td colspan='3' id='titlelp' style='color: #dc3545; font-weight: bold;font-size: 11px;' align='center' height='35' id='titlett2'  >
                                          Please print and present this e-ticket to for boarding.
                                          <br/>
                                          Passenger needs to arrive at least " . $timeBRegreso ." minutes prior to departure.</td>
                                      </tr>
                                    </table>
                                    <br/>
                                  </td>
                                </tr>
                                <tr>
                                  <td colspan='4' align='center'>


                                    <table width='99%' style='border: 1px solid #e6e6e6;background-color: #fdfdfd;' border='0' cellpadding='3' id='tableorder'>
                                      <tr>
                                        <td height='29' colspan='4' align='center'  id='titlett' style='font-size: 14px; font-weight: bold;'><strong>PURCHASE SUMMARY</strong></td>
                                      </tr>
                                      <tr>
                                        <td id='titlelp'>&nbsp;</td>
                                        <td id='titlelp' style='text-align: left; font-weight: bold;'>
                                          Passenger Traveling
                                        </td>
                                        <td id='titlelp' style='text-align: right; font-weight: bold;'>
                                          Fare
                                        </td>
                                        <td id='titlelp' style='text-align: right; font-weight: bold;'>
                                          Total
                                        </td>
                                      </tr>
                                     <tr>
                                        <td id='titlelp' width='55%'>" . $booking['ticke'] . " Adults</td>
                                        <td id='titlelp' style='color: #2160a0' align='center' width='7%'><span style='font-weight: bold;'>" . $booking['pax'] . "</span></td>
                                        <td id='titlelp' style='color: #2160a0' align='right' width='13%'><span style='font-weight: bold;'>" . $precioAdultT . "</span></td>
                                        <td id='titlelp' style='color: #2160a0' width='13%' align='right'><span style='font-weight: bold;'>" . $precioTotalAdultT . "</span></td>
                                      </tr>
                                      <tr>
                                        <td id='titlelp'>" . $booking['ticke'] . " Children (0-9 Years)</td>
                                        <td id='titlelp' style='color: #2160a0' align='center'><span style='font-weight: bold;'>" . $booking['chil'] . "</span></td>
                                        <td id='titlelp' style='color: #2160a0' align='right'><span style='font-weight: bold;'>" . $precioChildT . "</span></td>
                                        <td id='titlelp' style='color: #2160a0' align='right'><span style='font-weight: bold;'>" . $precioTotalChildT . "</span></td>
                                      </tr>
                                      <tr id='titlelp'>
                                        <td id='titlell' colspan='3' style='border-right: 1px solid #e6e6e6;border-bottom: 1px solid #2160a0;'> Service Fee </td>
                                        <td id='titlelp' style='color: #2160a0; border-bottom: 1px solid #2160a0;' align='right'><span style='font-weight: bold;'>" . number_format($booking['fee'], 2, '.', '') . "</span></td>
                                      </tr>
                                      <tr>
                                        <td id='titlelr'>&nbsp;</td>
                                        <td  id='titlelr' align='center' colspan='2'><span style='font-weight: bold;'>Total Amount Paid</span></td>
                                        <td id='titlelr' align='right'><span style='font-weight: bold;'>$  " . $pago . " </span></td>
                                      </tr>
                                    </table>
                                      <table width='100%' style='border: 1px solid #e6e6e6;background-color: #fdfdfd;' border='0' cellpadding='3' id='tableorder'>
                                          <tr>
                                            <td width='0%' id='titlett'>
                                            &nbsp;
                                            </td>
                                            <td colspan='3' width='100%' height='29' colspan='4' align='center'  id='titlett' style='font-size: 14px; font-weight: bold;padding-top: 10px;padding-bottom: 10px;'>
                                                <span style='font-size: 9px;color: black; font-weight: bold;'>Non-Refundable - Non-Transferable - No Schedule Changes Permitted <br>
                                                No pets allowed on board - luggage restrictions apply 1 Bag per person. <br>
                                                Please read additional terms <a href='http://www.supertours.com'>www.supertours.com</a><br>
                                                Have a SUPER trip!<br />
                                                <br/>
                                                SUPER TOURS.<br>
                                                Phone: (407) 370-3001 Orlando / (305) 677-2676 Miami / e-mail: reservations@supertours.com
                                              </span>
                                            </td>
                                            
                                          </tr>
                                        </table>
                                  </td>
                                </tr>
                            </table>
                        </body>
                    </html>");
                }
                $mail->addAttachment('PDF-E-T/E-TICKET-'.$booking['codconf'].'.pdf');
                //$mail->addAttachment('PDF-E-T/', 'E-TICKET-'.$booking['codconf'].'.pdf');
                $mail->Send();
            } catch (phpmailerException $e) {
                echo $e->errorMessage(); //Errores de PhpMailer
            } catch (Exception $e) {
                echo $e->getMessage(); //Errores de cualquier otra cosa.
            }
        }


        //unset($mail);
    }

    public function load_old() {
    $this->data['rootUrl'] = Doo::conf()->APP_URL;
        Doo::loadModel("Reserve");
        $reserve = new Reserve();
        if (isset($_SESSION["booking"])) {
            if (isset($_POST['ssl_card_number'])) {
                $_SESSION['booking']['card_number'] = $_POST['ssl_card_number'];
            } else {
                $_SESSION['booking']['card_number'] = "N/A";
            }

            if (isset($_SESSION['tipo'])) {
                $tipo = $_SESSION['tipo'];
                $_SESSION['booking']['total2'] = $_SESSION['booking']['totaltotal'];

                if (isset($tipo->agencia) && isset($tipo->otheram)) {
                    $_SESSION['booking']['agen'] = $tipo->agencia;
                    $_SESSION['booking']['agency'] = $tipo->agencia;
                    $_SESSION['booking']['totaltotal'] = $tipo->otheram;
                } else {
                    $_SESSION['booking']['agen'] = "N/A";
                }

                if (isset($tipo->otheram) && isset($tipo->comment)) {
                    $_SESSION['booking']['comments'] = $tipo->comment;
                    $_SESSION['booking']['totaltotal'] = $tipo->otheram;
                }
            }
            $booking = $_SESSION["booking"];

            if (isset($_POST['ssl_txn_id'])) {

                $tipo->pago = "TOTAL AMOUNT PAID";

                $tipo->comment = "PAID ONLINE";
            }



            list($mes, $dia, $anyo) = explode("-", $booking['fecha_salida']);
            $fecha = $anyo . "-" . $mes . "-" . $dia;

            if ($booking['fecha_retorno'] != "N/A") {
                list($mes1, $dia1, $anyo1) = explode("-", $booking['fecha_retorno']);
                $fecha1 = $anyo1 . "-" . $mes1 . "-" . $dia1;
            }

            $reserve = new Reserve($booking);

            $new = false;
            $id = "";
            if ($id == "") {
                $reserve->id = Null;
                $new = true;
            } else {
                return Doo::conf()->APP_URL . "booking/pickup-dropoff/autentication/shopuser";
            }


            $this->data['rootUrl'] = Doo::conf()->APP_URL;
            $login = $_SESSION['user'];
            if (isset($_SESSION['tipo'])) {
                $reserve->tipo_pago = $tipo->tipo;
            }

            $totalpax = $booking['pax'] + $booking['chil'];

            if ($new) {
                Doo::db()->insert($reserve);
                if ($tipo->comment == "PAGO ONLINE") {
                    try {
                        Doo::loadController('DatosMailController');
                        $datosMail = new DatosMailController();
                        $mail = new PHPMailer(true);
                        $mail = $datosMail->datos();
                        //La direccion a donde mandamos el correo
                        $mail->AddAddress($login->username, $login->lastname);
                        $tipo_ticket = $booking["tipo_ticket"];

                        if ($tipo_ticket == "oneway") {

                            $mail->MsgHTML("<head>

                            <title>Documento sin título</title>
                            <style type='text/css'>
                            #clearTable {
                                width: 800px;
                                font-size: 13px;
                                font-family: Verdana, Geneva, sans-serif;
                            }
                            #clearTable tr #titletd3 {
                                font-family: Verdana, Geneva, sans-serif;
                            }
                            #clearTable tr #titletd2 {
                                font-size: 20px;
                            }
                            #clearTable tr td p {
                                text-align: center;
                            }

                            #content #center-column #tdgris {
                                background-color: #F0F0F0;
                            }
                            #content #center-column #tdrojo {
                                background-color: #FFE6E6;
                            }
                            #content #center-column1 #titletd {
                                background-color: #F5EDEB;
                                padding-left: 5px;
                                font-size: 12px;
                            }
                             #titlett {
                                background-color: #E8E8E8;
                                padding-left: 5px;
                                font-size: 12px;
                            }
                             #titlell {
                                padding-left: 5px;
                                font-size: 12px;
                                border-bottom-width: 1px;
                                border-left-width: 1px;
                                border-bottom-style: solid;
                                border-left-style: solid;
                                border-bottom-color: #E6E6E6;
                                border-left-color: #E6E6E6;
                            }
                            #titlelp {
                                padding-left: 5px;
                                font-size: 12px;
                                border-bottom-width: 1px;
                                border-bottom-style: solid;
                                border-bottom-color: #E6E6E6;
                            }
                             #titlelr {
                                padding-left: 5px;
                                font-size: 12px;
                                border-top-width: 1px;
                                border-top-style: solid;
                                border-top-color: #CE0000;
                                color: #CE0000;
                            }
                             #tdgristable {
                                background-color: #FFF;
                                padding-left: 5px;
                            }



                            </style>
                            </head><div align='center'>
                            <br />
                            <table   id='clearTable'>
                                 <tr>
                                   <td width='316' height='33' rowspan='2' id='titletd3'><img src='".$this->data['rootUrl']."global/estilos/logo.png' width='316' height='88' /></td>
                                   <td colspan='3' align='center' id='titletd3'>Supertours.com</td>
                                 </tr>
                                 <tr>
                                   <td height='35' colspan='3' id='titletd4'>Date/Time of Booking: " . $booking['fecha_ini'] . " / " . $booking['hora'] . "</td>
                                </tr>
                                 <tr>
                                   <td align='center' height='33' colspan='4' id='titletd2'>" . $booking['ticke'] . " E-TICKET</td>
                                 </tr>
                                 <tr>
                                     <td height='15' id='titletd6'>
                                     " .$opcuser1. "" .$opcuser2. "" .$opcuser3. "" .$opcuser4. "" .$opcuser5. "" .$opcuser6. "" .$opcuser7. "" .$opcuser8. "
                                     </td>
                                </tr>
                                 <tr>
                                 <td height='15' id='titletd6'>
                                 " .$opcchild1. "" .$opcchild2. "" .$opcchild3. "" .$opcchild4. "" .$opcchild5. "" .$opcchild6. "" .$opcchild7. "" .$opcchild8. "
                                 </td>
                                   <td width='145' height='15' id='titletd6'>&nbsp;</td>
                                   <td colspan='2' id='titletd6'>AD : " . $booking['pax'] . "<strong>  </strong>CHD : " . $booking['chil'] . " <strong> TOTAL</strong> : " . $totalpax . "</td>
                                 </tr>
                                 <tr>
                                   <td height='16' id='titletd7'></td>
                                   <td height='16' id='titletd7'>Status: CONFIRMED</td>
                                   <td width='197' height='16' id='titletd7'>Confirmation # " . $booking['codconf'] . "</td>
                                   <td width='122' height='16' id='titletd7'>Paid by: " . $tipo->tipo . "</td>
                                 </tr>
                                 <tr>
                                <td height='45' colspan='4' id='titletd'> <p><strong>ORDER&nbsp;  CONFIRMATION</strong> + " . $booking['ticke'] . " </p></td>
                              </tr>
                              <tr>
                                <td colspan='4' ><table width='90%' height='125' id='tableorder'>
                                  <tr>
                                    <td  width='34%' height='35' id='titlett'  ><strong>Departure Date: </strong>" . date('l', strtotime($fecha)) . ", " . date('M-d-Y', strtotime($fecha)) . "  </td>
                                    <td  id='titlett' width='26%'><strong>TRIP # :</strong> " . $booking['trip_no'] . "</td>
                                    <td  id='titlett' width='40%'><strong>DEPARTURE TIME :</strong> " . date('g:i a', strtotime($booking['trip_departure'])) . "</td>
                                  </tr>
                                  <tr>
                                    <td height='41'><strong>From :</strong> " . $booking['from_name'] . "</td>
                                    <td colspan='2'><strong>Pick up Point / Extensions :</strong> " . $booking['place1'] . " , " . $booking['hotelarea1'] . " </td>
                                  </tr>
                                  <tr>
                                    <td height='39'><strong>To </strong>:" . $booking['to_name'] . "</td>
                                    <td colspan='2'><strong>Drop Off / Extensions :</strong> " . $booking['address1'] . " , " . $booking['hotelarea2'] . "</td>
                                    </tr>
                              </table>

                                <table id='tableorder2' width='90%'>
                                  <tr>
                                    <td  align='center' height='35' id='titlett2'  >Please print and present this e-ticket to for boarding<br />
                                      Please arrive at departure point 30 minutes before the scheduled time</td>
                                    </tr>
                                </table>
                                <table id='tableorder3' width='90%'>
                                  <tr>
                                    <td  height='35' colspan='3' id='titlett3'  aling='center' >RECEIPT</td>

                                    </tr>
                                  <tr>
                                    <td width='34%' height='28'>Card Holder Information</td>
                                    <td colspan='2'>Billing Address </td>
                                  </tr>
                                  <tr>
                                    <td height='27'>Name : " . $_SESSION['booking']['firstname'] . " </td>
                                    <td colspan='2'>Address : " . $login->address . "</td>
                                     <td colspan='2'>Phone : " . $login->phone . "</td>
                                  </tr>
                                  <tr>
                                    <td height='27'>Last Name : " . $_SESSION['booking']['lastname'] . "</td>
                                    <td colspan='2'>City : " . $login->city . "</td>
                                  </tr>
                                  <tr>
                                    <td height='27'>E-mail : " . $login->username . "</td>
                                    <td>State : " . $login->state . "</td>
                                    <td>Country :" . $login->country . "</td>
                                  </tr>
                                  <tr>
                                    <td height='27'>Lead Traveler : " . $_SESSION['booking']['firstname'] . " " . $_SESSION['booking']['lastname'] . "</td>
                                    <td colspan='2'>Zip / Postal Code : " . $login->zip . " </td>
                                  </tr>
                                </table>
                                <p><br />
                              </p></td>
                              </tr>
                              <tr>
                                <td height='33' colspan='4' id='titletd' ><strong>PRICE</strong></td>
                              </tr>
                              <tr>
                                <td colspan='4'><table width='90%' border='0' cellpadding='3' id='tableorder'>
                                  <tr>
                                    <td height='29' colspan='5' align='center'  id='titlett'><strong>COST SUMMARY</strong></td>
                                  </tr>
                                  <tr>
                                    <td height='31' colspan='5' align='center' id='titlell'>" . $booking['ticke'] . " Transportation from <b>" . $booking['from_name'] . " </b>to <b>" . $booking['to_name'] . "</b></td>
                                  </tr>
                                  <tr >
                                    <td width='7%' height='30'>" . $booking['pax'] . "</td>
                                    <td width='17%'>Adults</td>
                                    <td id='titlell' width='53%'>" . $booking['ticke'] . " " . $booking['residente'] . "</td>
                                    <td id='titlelp' width='11%'>$ " . $booking['precioadul'] . "</td>
                                    <td id='titlelp' width='12%'>$ " . $booking['totaladul'] . "</td>
                                  </tr>
                                  <tr>


                                    <td height='27'>" . $booking['chil'] . "</td>
                                    <td>Children (3-9 Years)</td>
                                    <td id='titlell'>" . $booking['ticke'] . " " . $booking['residente'] . "</td>
                                    <td id='titlelp'>$ " . $booking['preciochil'] . "</td>
                                    <td id='titlelp'>$ " . $booking['totalchil'] . "</td>

                                  </tr>
                                   <tr>
                                    <td height='27'></td>
                                    <td>&nbsp;</td>
                                    <td id='titlell'> Pick up Point /Drop Off - Extension </td>
                                    <td id='titlelp'>$ " . $booking['pricexten'] . "</td>
                                    <td id='titlelp'>$ " . $booking['totalexten'] . "</td>
                                  </tr>
                                  <tr>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td id='titlell'>Taxes and Fees</td>
                                    <td id='titlelp'>$ 0.00</td>
                                    <td id='titlelp'>$ 0.00 </td>
                                  </tr>
                                  <tr>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td  id='titlelr' align='center' colspan='2'> " . $tipo->pago . "</td>
                                    <td id='titlelr'><strong>$  " . $booking['totaltotal'] . " </strong></td>
                                  </tr>
                                </table>
                                  <p>&nbsp;</p>
                                <p>Non-refundable - non-transferable - no changes are allowed on dates or time of departure - no pets allowed on board -<br />
                                  luggage restrictions apply - Please read the terms of transportation at www.supertours.com<br />
                                  THANK YOU FOR CHOOSING US<br />
                                  HAVE A NICE TRIP<br />
                                  SUPER TOURS.<br />
                                  Phone: (407) 370-3001 Orlando / (305) 677-2676 Miami / e-mail: reservations@supertours.com

                                </p></td>
                              </tr>
                              <tr>
                                <td colspan='4' align='center'> <p align='center' class='titulopago'>

                            </p>       </td>

                              </tr>
                              </table>



                            </div>");
                        } else {
                            $mail->MsgHTML("<head>

                            <title>Documento sin título</title>
                            <style type='text/css'>
                            #clearTable {
                                width: 800px;
                                font-size: 13px;
                                font-family: Verdana, Geneva, sans-serif;
                            }
                            #clearTable tr #titletd3 {
                                font-family: Verdana, Geneva, sans-serif;
                            }
                            #clearTable tr #titletd2 {
                                font-size: 20px;
                  }

                            #clearTable tr td p {
                                text-align: center;
                            }

                            #content #center-column #tdgris {
                                background-color: #F0F0F0;
                            }
                            #content #center-column #tdrojo {
                                background-color: #FFE6E6;
                            }
                            #content #center-column1 #titletd {
                                background-color: #F5EDEB;
                                padding-left: 5px;
                                font-size: 12px;
                            }
                             #titlett {
                                background-color: #E8E8E8;
                                padding-left: 5px;
                                font-size: 12px;
                            }
                             #titlell {
                                padding-left: 5px;
                                font-size: 12px;
                                border-bottom-width: 1px;
                                border-left-width: 1px;
                                border-bottom-style: solid;
                                border-left-style: solid;
                                border-bottom-color: #E6E6E6;
                                border-left-color: #E6E6E6;
                            }
                            #titlelp {
                                padding-left: 5px;
                                font-size: 12px;
                                border-bottom-width: 1px;
                                border-bottom-style: solid;
                                border-bottom-color: #E6E6E6;
                            }
                             #titlelr {
                                padding-left: 5px;
                                font-size: 12px;
                                border-top-width: 1px;
                                border-top-style: solid;
                                border-top-color: #CE0000;
                                color: #CE0000;
                            }
                             #tdgristable {
                                background-color: #FFF;
                                padding-left: 5px;
                            }



                            </style>
                            </head><div align='center'>
                            <br />
                            <table   id='clearTable'>
                                 <tr>
                                   <td width='316' height='33' rowspan='2' id='titletd3'><img src='".$this->data['rootUrl']."global/estilos/logo.png' width='316' height='88' /></td>
                                   <td colspan='3' align='center' id='titletd3'>Supertours.com</td>
                                 </tr>
                                 <tr>
                                   <td height='35' colspan='3' id='titletd4'>Date/Time of Booking: " . $booking['fecha_ini'] . " / " . $booking['hora'] . "</td>
                                </tr>
                                 <tr>
                                   <td align='center' height='33' colspan='4' id='titletd2'>" . $booking['ticke'] . " E-TICKET</td>
                                 </tr>
                                 <tr>
                                     <td height='15' id='titletd6'>
                                     " .$opcuser1. "" .$opcuser2. "" .$opcuser3. "" .$opcuser4. "" .$opcuser5. "" .$opcuser6. "" .$opcuser7. "" .$opcuser8. "
                                     </td>
                                </tr>
                                <tr>
                                     <td height='15' id='titletd6'>
                                     " .$opcchild1. "" .$opcchild2. "" .$opcchild3. "" .$opcchild4. "" .$opcchild5. "" .$opcchild6. "" .$opcchild7. "" .$opcchild8. "
                                     </td>
                                   <td width='145' height='15' id='titletd6'>&nbsp;</td>
                                   <td colspan='2' id='titletd6'>AD : " . $booking['pax'] . "<strong>  </strong>CHD : " . $booking['chil'] . " <strong> TOTAL</strong> : " . $totalpax . "</td>
                                 </tr>
                                 <tr>
                                   <td height='16' id='titletd7'></td>
                                   <td height='16' id='titletd7'>Status: CONFIRMED</td>
                                   <td width='197' height='16' id='titletd7'>Confirmation # " . $booking['codconf'] . "</td>
                                   <td width='122' height='16' id='titletd7'>Paid by: " . $tipo->tipo . "</td>
                                 </tr>
                                 <tr>
                                <td height='45' colspan='4' id='titletd'> <p><strong>ORDER&nbsp;  CONFIRMATION</strong> + " . $booking['ticke'] . " </p></td>
                              </tr>
                              <tr>
                                <td colspan='4' ><table width='90%' height='125' id='tableorder'>
                                  <tr>
                                    <td  width='34%' height='35' id='titlett'  ><strong>Departure Date: </strong>" . date('l', strtotime($fecha)) . ", " . date('M-d-Y', strtotime($fecha)) . "  </td>
                                    <td  id='titlett' width='26%'><strong>TRIP # :</strong> " . $booking['trip_no'] . "</td>
                                    <td  id='titlett' width='40%'><strong>DEPARTURE TIME :</strong> " . date('g:i a', strtotime($booking['trip_departure'])) . "</td>
                                  </tr>
                                  <tr>
                                    <td height='41'><strong>From :</strong> " . $booking['from_name'] . "</td>
                                    <td colspan='2'><strong>Pick up Point / Extensions :</strong> " . $booking['place1'] . " , " . $booking['hotelarea1'] . "</td>
                                  </tr>
                                  <tr>
                                    <td height='39'><strong>To </strong>:" . $booking['to_name'] . "</td>
                                    <td colspan='2'><strong>Drop Off / Extensions :</strong> " . $booking['address1'] . ", " . $booking['hotelarea2'] . "</td>
                                    </tr>
                              </table>

                               <table id='tableorder' width='90%'>
                                  <tr>
                                    <td id='titlett'  width='34%' height='35'  ><span style='font-weight: bold;'>Return Date :</span> " . date('l', strtotime($fecha1)) . ", " . date('M-d-Y', strtotime($fecha1)) . "  , </td>
                                    <td id='titlett' width='26%'><strong>TRIP # :</strong> " . $booking['trip_no2'] . "</td>
                                    <td id='titlett' width='40%'><strong>DEPARTURE TIME :</strong> " . date('g:i a', strtotime($booking['trip_departure2'])) . "</td>
                                  </tr>
                                  <tr>
                                    <td height='28'><strong>From :</strong> " . $booking['to_name'] . "</td>
                                    <td colspan='2'><strong>Pick up Point / Extensions :</strong> " . $booking['place2'] . " , " . $booking['hotelarea3'] . " </td>
                                  </tr>
                                  <tr>
                                    <td height='27'><strong>To :</strong>" . $booking['from_name'] . "</td>
                                    <td colspan='2'><strong>Drop Off / Extensions :</strong> " . $booking['address2'] . " , " . $booking['hotelarea4'] . "</td>
                                    </tr>
                                </table>


                                <table id='tableorder2' width='90%'>
                                  <tr>
                                    <td  align='center' height='35' id='titlett2'  >Please print and present this e-ticket to for boarding<br />
                                      Please arrive at departure point 30 minutes before the scheduled time</td>
                                    </tr>
                                </table>
                                <table id='tableorder3' width='90%'>
                                  <tr>
                                    <td  height='35' colspan='3' id='titlett3'  aling='center' >RECEIPT</td>
                                    </tr>
                                  <tr>
                                    <td width='34%' height='28'>Card Holder Information</td>
                                    <td colspan='2'>Billing Address </td>
                                  </tr>
                                  <tr>
                                    <td height='27'>Name : " . $_SESSION['booking']['firstname'] . " </td>
                                    <td colspan='2'>Address : " . $login->address . "</td>
                                     <td colspan='2'>Phone : " . $login->phone . "</td>
                                  </tr>
                                  <tr>
                                    <td height='27'>Last Name : " . $_SESSION['booking']['lastname'] . "</td>
                                    <td colspan='2'>City : " . $login->city . "</td>
                                  </tr>
                                  <tr>
                                    <td height='27'>E-mail : " . $login->username . "</td>
                                    <td>State : " . $login->state . "</td>
                                    <td>Country :" . $login->country . "</td>
                                  </tr>
                                  <tr>
                                    <td height='27'>Lead Traveler : " . $_SESSION['booking']['firstname'] . " " . $_SESSION['booking']['lastname'] . "</td>
                                    <td colspan='2'>Zip / Postal Code : " . $login->zip . " </td>
                                  </tr>
                                </table>
                                <p><br />
                              </p></td>
                              </tr>
                              <tr>
                                <td height='33' colspan='4' id='titletd' ><strong>PRICE</strong></td>
                              </tr>
                              <tr>
                                <td colspan='4'><table width='90%' border='0' cellpadding='3' id='tableorder'>
                                  <tr>
                                    <td height='29' colspan='5' align='center'  id='titlett'><strong>COST SUMMARY</strong></td>
                                  </tr>
                                  <tr>
                                    <td height='31' colspan='5' align='center' id='titlell'>" . $booking['ticke'] . " Transportation from <b>" . $booking['from_name'] . " </b>to <b>" . $booking['to_name'] . "</b></td>
                                  </tr>
                                  <tr >
                                    <td width='7%' height='30'>" . $booking['pax'] . "</td>
                                    <td width='17%'>Adults</td>
                                    <td id='titlell' width='53%'>" . $booking['ticke'] . " " . $booking['residente'] . "</td>
                                    <td id='titlelp' width='11%'>$ " . $booking['precioadul'] . "</td>
                                    <td id='titlelp' width='12%'>$ " . $booking['totaladul'] . "</td>
                                  </tr>
                                  <tr>


                                    <td height='27'>" . $booking['chil'] . "</td>
                                    <td>Children (3-9 Years)</td>
                                    <td id='titlell'>" . $booking['ticke'] . " " . $booking['residente'] . "</td>
                                    <td id='titlelp'>$ " . $booking['preciochil'] . "</td>
                                    <td id='titlelp'>$ " . $booking['totalchil'] . "</td>

                                  </tr>
                                   <tr>
                                    <td height='27'></td>
                                    <td>&nbsp;</td>
                                    <td id='titlell'> Pick up Point /Drop Off - Extension </td>
                                    <td id='titlelp'>$ " . $booking['pricexten'] . "</td>
                                    <td id='titlelp'>$ " . $booking['totalexten'] . "</td>
                                  </tr>
                                  <tr>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td id='titlell'>Taxes and Fees</td>
                                    <td id='titlelp'>$ 0.00</td>
                                    <td id='titlelp'>$ 0.00 </td>
                                  </tr>
                                  <tr>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td  id='titlelr' align='center' colspan='2'> " . $tipo->pago . "</td>
                                    <td id='titlelr'><strong>$  " . $booking['totaltotal'] . " </strong></td>
                                  </tr>
                                </table>
                                  <p>&nbsp;</p>
                                <p>Non-refundable - non-transferable - no changes are allowed on dates or time of departure - no pets allowed on board -<br />
                                  luggage restrictions apply - Please read the terms of transportation at www.supertours.com<br />
                                  THANK YOU FOR CHOOSING US<br />
                                  HAVE A NICE TRIP<br />
                                  SUPER TOURS.<br />
                                  Phone: (407) 370-3001 Orlando / (305) 677-2676 Miami / e-mail: reservations@supertours.com
                                <div id='agencia' style='display: none;'>Name Agencia
                            <input name='agencia' size='20' maxlength='10' class='input-text' id='agencia1' /> </div>
                                </p></td>
                              </tr>
                              <tr>
                                <td colspan='4' align='center'> <p align='center' class='titulopago'>

                            </p>       </td>

                              </tr>
                              </table>



                            </div>");
                        }


                        $mail->Send();
                    } catch (phpmailerException $e) {
                        echo $e->errorMessage(); //Errores de PhpMailer
                    } catch (Exception $e) {
                        echo $e->getMessage(); //Errores de cualquier otra cosa.
                    }
                }
                try {
                    $nombre_destino = 'Admin';
                    Doo::loadController('DatosMailController');
                    $datosMail = new DatosMailController();
                    $mail2 = new PHPMailer(true);
                    $mail2 = $datosMail->datos();
                    //La direccion a donde mandamos el correo
                    $mail2->AddAddress("reservations@supertours.com", $nombre_destino);
                    $mail2->AddBCC("arturo@supertours.com", $nombre_destino);
                    //$mail->AddBCC("arbusmad2021@gmail.com");
//                    $mail2->AddAddress("websales@supertours.com", $nombre_destino);
                    $tipo_ticket = $booking["tipo_ticket"];

                    if ($tipo_ticket == "oneway") {

                        $mail2->MsgHTML("<head>
                        <title>Documento sin titulo</title>
                                <style type='text/css'>
                                #clearTable {
                                    width: 800px;
                                    font-size: 13px;
                                    font-family: Verdana, Geneva, sans-serif;
                                }
                                #clearTable tr #titletd3 {
                                    font-family: Verdana, Geneva, sans-serif;
                                }
                                #clearTable tr #titletd2 {
                                    font-size: 20px;
                                }
                                #clearTable tr td p {
                                    text-align: center;
                                }

                                #content #center-column #tdgris {
                                    background-color: #F0F0F0;
                                }
                                #content #center-column #tdrojo {
                                    background-color: #FFE6E6;
                                }
                                #content #center-column1 #titletd {
                                    background-color: #F5EDEB;
                                    padding-left: 5px;
                                    font-size: 12px;
                                }
                                 #titlett {
                                    background-color: #E8E8E8;
                                    padding-left: 5px;
                                    font-size: 12px;
                                }
                                 #titlell {
                                    padding-left: 5px;
                                    font-size: 12px;
                                    border-bottom-width: 1px;
                                    border-left-width: 1px;
                                    border-bottom-style: solid;
                                    border-left-style: solid;
                                    border-bottom-color: #E6E6E6;
                                    border-left-color: #E6E6E6;
                                }
                                #titlelp {
                                    padding-left: 5px;
                                    font-size: 12px;
                                    border-bottom-width: 1px;
                                    border-bottom-style: solid;
                                    border-bottom-color: #E6E6E6;
                                }
                                 #titlelr {
                                    padding-left: 5px;
                                    font-size: 12px;
                                    border-top-width: 1px;
                                    border-top-style: solid;
                                    border-top-color: #CE0000;
                                    color: #CE0000;
                                }
                                 #tdgristable {
                                    background-color: #FFF;
                                    padding-left: 5px;
                                }



                                .Estilo2 {color: #FF0000}
                                .Estilo3 {color: #FFFFFF}
                                .Estilo4 {color: #000000; }
                                </style>
                                </head>

                    <div align='center'>
            <br />
            <table   id='clearTable'>
                 <tr>
                   <td width='316' height='33' rowspan='2' id='titletd3'><img src='".$this->data['rootUrl']."global/estilos/logo.png' width='316' height='88' /></td>
                   <td colspan='3' align='center' id='titletd3'>Supertours.com</td>
                 </tr>
                 <tr>
                   <td height='35' colspan='3' id='titletd4'>Date/Time of Booking: " . $booking['fecha_ini'] . " / " . $booking['hora'] . "</td>
                </tr>
                 <tr>
                   <td align='center' height='33' colspan='4' id='titletd2'>" . $booking['ticke'] . " E-TICKET</td>
                 </tr>
                 <tr>
                     <td height='15' id='titletd6'>
                     " .$opcuser1. "" .$opcuser2. "" .$opcuser3. "" .$opcuser4. "" .$opcuser5. "" .$opcuser6. "" .$opcuser7. "" .$opcuser8. "
                     </td>
                 </tr>
                 <tr>
                     <td height='15' id='titletd6'>
                     " .$opcchild1. "" .$opcchild2. "" .$opcchild3. "" .$opcchild4. "" .$opcchild5. "" .$opcchild6. "" .$opcchild7. "" .$opcchild8. "
                     </td>
                   <td width='145' height='15' id='titletd6'>&nbsp;</td>
                   <td colspan='2' id='titletd6'>AD : " . $booking['pax'] . "<strong>  </strong>CHD : " . $booking['chil'] . " <strong> TOTAL</strong> : " . $totalpax . "</td>
                 </tr>

                 <tr>
                   <td height='16' id='titletd7'>" . $_SESSION['booking']['agen'] . "</td>
                   <td height='16' id='titletd7'>Status: CONFIRMED</td>
                   <td width='197' height='16' id='titletd7'>Confirmation # " . $booking['codconf'] . "</td>
                   <td width='122' height='16' id='titletd7'>Paid by: " . $tipo->tipo . "</td>
                 </tr>
                 <tr>
                <td height='45' colspan='4' id='titletd'> <p><strong>ORDER&nbsp;  CONFIRMATION</strong> + " . $booking['ticke'] . " </p></td>
              </tr>
              <tr>
                <td colspan='4' ><table width='90%' height='125' id='tableorder'>
                  <tr>
                    <td  width='34%' height='35' id='titlett'  ><strong>Departure Date: </strong>" . date('l', strtotime($fecha)) . ", " . date('M-d-Y', strtotime($fecha)) . "  </td>
                    <td  id='titlett' width='26%'><strong>TRIP # :</strong> " . $booking['trip_no'] . "</td>
                    <td  id='titlett' width='40%'><strong>DEPARTURE TIME :</strong> " . date('g:i a', strtotime($booking['trip_departure'])) . "</td>
                  </tr>
                  <tr>
                    <td height='41'><strong>From :</strong> " . $booking['from_name'] . "</td>
                    <td colspan='2'><strong>Pick up Point / Extensions :</strong> " . $booking['place1'] . " , " . $booking['hotelarea1'] . "</td>
                  </tr>
                  <tr>
                    <td height='39'><strong>To </strong>:" . $booking['to_name'] . "</td>
                    <td colspan='2'><strong>Drop Off / Extensions :</strong> " . $booking['address1'] . " , " . $booking['hotelarea2'] . "</td>
                    </tr>
              </table>

                <table id='tableorder2' width='90%'>
                  <tr>
                    <td  align='center' height='35' id='titlett2'  >Please print and present this e-ticket to for boarding<br />
                      Please arrive at departure point 30 minutes before the scheduled time</td>
                    </tr>
                </table>
                <table id='tableorder3' width='90%'>
                  <tr>
                    <td  height='35' colspan='3' id='titlett3'  aling='center' >RECEIPT</td>
                    </tr>
                  <tr>
                    <td width='34%' height='28'>Card Holder Information</td>
                    <td colspan='2'>Billing Address </td>
                  </tr>
                  <tr>
                    <td height='27'>Name : " . $_SESSION['booking']['firstname'] . " </td>
                    <td colspan='2'>Address : " . $login->address . "</td>
                     <td colspan='2'>Phone : " . $login->phone . "</td>
                  </tr>
                  <tr>
                    <td height='27'>Last Name : " . $_SESSION['booking']['lastname'] . "</td>
                    <td colspan='2'>City : " . $login->city . "</td>
                  </tr>
                  <tr>
                    <td height='27'>E-mail : " . $login->username . "</td>
                    <td>State : " . $login->state . "</td>
                    <td>Country :" . $login->country . "</td>
                  </tr>
                  <tr>
                    <td height='27'>Lead Traveler : " . $_SESSION['booking']['firstname'] . " " . $_SESSION['booking']['lastname'] . "</td>
                    <td colspan='2'>Zip / Postal Code : " . $login->zip . " </td>
                  </tr>
                </table>
                <p><br />
              </p></td>
              </tr>
              <tr>
                <td height='33' colspan='4' id='titletd' ><strong>PRICE</strong></td>
              </tr>
              <tr>
                <td colspan='4'><table width='90%' border='0' cellpadding='3' id='tableorder'>
                  <tr>
                    <td height='29' colspan='5' align='center'  id='titlett'><strong>COST SUMMARY</strong></td>
                  </tr>
                  <tr>
                    <td height='31' colspan='5' align='center' id='titlell'>" . $booking['ticke'] . " Transportation from <b>" . $booking['from_name'] . " </b>to <b>" . $booking['to_name'] . "</b></td>
                  </tr>
                  <tr >
                    <td width='7%' height='30'>" . $booking['pax'] . "</td>
                    <td width='17%'>Adults</td>
                    <td id='titlell' width='53%'>" . $booking['ticke'] . " " . $booking['residente'] . "</td>
                    <td id='titlelp' width='11%'>$ " . $booking['precioadul'] . "</td>
                    <td id='titlelp' width='12%'>$ " . $booking['totaladul'] . "</td>
                  </tr>
                  <tr>


                    <td height='27'>" . $booking['chil'] . "</td>
                    <td>Children (3-9 Years)</td>
                    <td id='titlell'>" . $booking['ticke'] . " " . $booking['residente'] . "</td>
                    <td id='titlelp'>$ " . $booking['preciochil'] . "</td>
                    <td id='titlelp'>$ " . $booking['totalchil'] . "</td>
                  </tr>
                   <tr>
                    <td height='27'></td>
                    <td>&nbsp;</td>
                    <td id='titlell'> Pick up Point /Drop Off - Extension </td>
                    <td id='titlelp'>$ " . $booking['pricexten'] . "</td>
                    <td id='titlelp'>$ " . $booking['totalexten'] . "</td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td id='titlell'>Taxes and Fees</td>
                    <td id='titlelp'>$ 0.00</td>
                    <td id='titlelp'>$ 0.00 </td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td colspan='2' align='center' class='Estilo2'  id='titlelr2'> " . $tipo->pago . "</td>
                    <td id='titlelr2'><span class='Estilo2'><strong>$  " . $booking['totaltotal'] . " </strong></span></td>
                  </tr>
                  <tr>
                    <td>Comments</td>
                    <td>&nbsp;</td>
                    <td colspan='2' align='center' class='Estilo4'  id='titlelr'><p>" . $tipo->comment . "</p>
                      <p>&nbsp;</p></td>
                    <td class='Estilo3' id='titlelr'>" . $_SESSION['booking']['card_number'] . "</td>
                  </tr>
                </table>
                  <p>&nbsp;</p>
                <p>Non-refundable - non-transferable - no changes are allowed on dates or time of departure - no pets allowed on board -<br />
                  luggage restrictions apply - Please read the terms of transportation at www.supertours.com<br />
                  THANK YOU FOR CHOOSING US<br />
                  HAVE A NICE TRIP<br />
                  SUPER TOURS.<br />
                  Phone: (407) 370-3001 Orlando / (305) 677-2676 Miami / e-mail: reservations@supertours.com

                </p></td>
              </tr>
              <tr>
                <td colspan='4' align='center'> <p align='center' class='titulopago'>

            </p>       </td>

              </tr>
              </table>


            </div>");
                                } else {
                                    $mail2->MsgHTML("<head>

                            <title>Documento sin título</title>
                            <style type='text/css'>
                            #clearTable {
                                width: 800px;
                                font-size: 13px;
                                font-family: Verdana, Geneva, sans-serif;
                            }
                            #clearTable tr #titletd3 {
                                font-family: Verdana, Geneva, sans-serif;
                            }
                            #clearTable tr #titletd2 {
                                font-size: 20px;
                            }
                            #clearTable tr td p {
                                text-align: center;
                            }

                            #content #center-column #tdgris {
                                background-color: #F0F0F0;
                            }
                            #content #center-column #tdrojo {
                                background-color: #FFE6E6;
                            }
                            #content #center-column1 #titletd {
                                background-color: #F5EDEB;
                                padding-left: 5px;
                                font-size: 12px;
                            }
                             #titlett {
                                background-color: #E8E8E8;
                                padding-left: 5px;
                                font-size: 12px;
                            }
                             #titlell {
                                padding-left: 5px;
                                font-size: 12px;
                                border-bottom-width: 1px;
                                border-left-width: 1px;
                                border-bottom-style: solid;
                                border-left-style: solid;
                                border-bottom-color: #E6E6E6;
                                border-left-color: #E6E6E6;
                            }
                            #titlelp {
                                padding-left: 5px;
                                font-size: 12px;
                                border-bottom-width: 1px;
                                border-bottom-style: solid;
                                border-bottom-color: #E6E6E6;
                            }
                             #titlelr {
                                padding-left: 5px;
                                font-size: 12px;
                                border-top-width: 1px;
                                border-top-style: solid;
                                border-top-color: #CE0000;
                                color: #CE0000;
                            }
                             #tdgristable {
                                background-color: #FFF;
                                padding-left: 5px;
                            }



                            .Estilo1 {color: #FF0000}
                            .Estilo2 {
                                color: #990000;
                                font-weight: bold;
                            }
                            </style>
                            </head><div align='center'>
                            <br />
                            <table   id='clearTable'>
                                 <tr>
                                   <td width='316' height='33' rowspan='2' id='titletd3'><img src='".$this->data['rootUrl']."global/estilos/logo.png' width='316' height='88' /></td>
                                   <td colspan='3' align='center' id='titletd3'>Supertours.com</td>
                                 </tr>
                                 <tr>
                                   <td height='35' colspan='3' id='titletd4'>Date/Time of Booking: " . $booking['fecha_ini'] . " / " . $booking['hora'] . "</td>
                                </tr>
                                 <tr>
                                   <td align='center' height='33' colspan='4' id='titletd2'>" . $booking['ticke'] . " E-TICKET</td>
                                 </tr>
                                 <tr>
                                   <td height='15' id='titletd6'>
                                   " .$opcuser1."".$opcuser2. "" .$opcuser3. "" .$opcuser4. "" .$opcuser5. "" .$opcuser6. "" .$opcuser7. "" .$opcuser8. "
                                   </td>
                                  </tr>
                                  <tr>
                                   <td height='15' id='titletd6'>
                                   " .$opcchild1. "" .$opcchild2. "" .$opcchild3. "" .$opcchild4. "" .$opcchild5. "" .$opcchild6. "" .$opcchild7. "" .$opcchild8. "
                                   </td>
                                   <td width='145' height='15' id='titletd6'>&nbsp;</td>
                                   <td colspan='2' id='titletd6'>AD : " . $booking['pax'] . "<strong>  </strong>CHD : " . $booking['chil'] . " <strong> TOTAL</strong> : " . $totalpax . "</td>
                                 </tr>
                                 <tr>
                                   <td height='16' id='titletd7'>" . $_SESSION['booking']['agen'] . "</td>
                                   <td height='16' id='titletd7'>Status: CONFIRMED</td>
                                   <td width='197' height='16' id='titletd7'>Confirmation # " . $booking['codconf'] . "</td>
                                   <td width='122' height='16' id='titletd7'>Paid by: " . $tipo->tipo . "</td>
                                 </tr>
                                 <tr>
                                <td height='45' colspan='4' id='titletd'> <p><strong>ORDER&nbsp;  CONFIRMATION</strong> + " . $booking['ticke'] . " </p></td>
                              </tr>
                              <tr>
                                <td colspan='4' ><table width='90%' height='125' id='tableorder'>
                                  <tr>
                                    <td  width='34%' height='35' id='titlett'  ><strong>Departure Date: </strong>" . date('l', strtotime($fecha)) . ", " . date('M-d-Y', strtotime($fecha)) . "  </td>
                                    <td  id='titlett' width='26%'><strong>TRIP # :</strong> " . $booking['trip_no'] . "</td>
                                    <td  id='titlett' width='40%'><strong>DEPARTURE TIME :</strong> " . date('g:i a', strtotime($booking['trip_departure'])) . "</td>
                                  </tr>
                                  <tr>
                                    <td height='41'><strong>From :</strong> " . $booking['from_name'] . "</td>
                                    <td colspan='2'><strong>Pick up Point / Extensions :</strong> " . $booking['place1'] . " , " . $booking['hotelarea1'] . "</td>
                                  </tr>
                                  <tr>
                                    <td height='39'><strong>To </strong>:" . $booking['to_name'] . "</td>
                                    <td colspan='2'><strong>Drop Off / Extensions :</strong> " . $booking['address1'] . " , " . $booking['hotelarea2'] . "</td>
                                    </tr>
                              </table>

                               <table id='tableorder' width='90%'>
                                  <tr>
                                    <td id='titlett'  width='34%' height='35'  ><strong>Return Date :</strong> " . date('l', strtotime($fecha1)) . ", " . date('M-d-Y', strtotime($fecha1)) . "  , </td>
                                    <td id='titlett' width='26%'><strong>TRIP # :</strong> " . $booking['trip_no2'] . "</td>
                                    <td id='titlett' width='40%'><strong>DEPARTURE TIME :</strong> " . date('g:i a', strtotime($booking['trip_departure2'])) . "</td>
                                  </tr>
                                  <tr>
                                    <td height='28'><strong>From :</strong> " . $booking['to_name'] . "</td>
                                    <td colspan='2'><strong>Pick up Point / Extensions :</strong> " . $booking['place2'] . "  , " . $booking['hotelarea3'] . "</td>
                                  </tr>
                                  <tr>
                                    <td height='27'><strong>To :</strong>" . $booking['from_name'] . "</td>
                                    <td colspan='2'><strong>Drop Off / Extensions :</strong> " . $booking['address2'] . " , " . $booking['hotelarea4'] . "</td>
                                    </tr>
                                </table>


                                <table id='tableorder2' width='90%'>
                                  <tr>
                                    <td  align='center' height='35' id='titlett2'  >Please print and present this e-ticket to for boarding<br />
                                      Please arrive at departure point 30 minutes before the scheduled time</td>
                                    </tr>
                                </table>
                                <table id='tableorder3' width='90%'>
                                  <tr>
                                    <td  height='35' colspan='3' id='titlett3'  aling='center' >RECEIPT</td>
                                    </tr>
                                  <tr>
                                    <td width='34%' height='28'>Card Holder Information</td>
                                    <td colspan='2'>Billing Address </td>
                                  </tr>
                                  <tr>
                                    <td height='27'>Name : " . $_SESSION['booking']['firstname'] . " </td>
                                    <td colspan='2'>Address : " . $login->address . "</td>
                                     <td colspan='2'>Phone : " . $login->phone . "</td>
                                  </tr>
                                  <tr>
                                    <td height='27'>Last Name : " . $_SESSION['booking']['lastname'] . "</td>
                                    <td colspan='2'>City : " . $login->city . "</td>
                                  </tr>
                                  <tr>
                                    <td height='27'>E-mail : " . $login->username . "</td>
                                    <td>State : " . $login->state . "</td>
                                    <td>Country :" . $login->country . "</td>
                                  </tr>
                                  <tr>
                                    <td height='27'>Lead Traveler : " . $_SESSION['booking']['firstname'] . " " . $_SESSION['booking']['lastname'] . "</td>
                                    <td colspan='2'>Zip / Postal Code : " . $login->zip . " </td>
                                  </tr>
                                </table>
                                <p><br />
                              </p></td>
                              </tr>
                              <tr>
                                <td height='33' colspan='4' id='titletd' ><strong>PRICE</strong></td>
                              </tr>
                              <tr>
                                <td colspan='4'><table width='90%' border='0' cellpadding='3' id='tableorder'>
                                  <tr>
                                    <td height='29' colspan='5' align='center'  id='titlett'><strong>COST SUMMARY</strong></td>
                                  </tr>
                                  <tr>
                                    <td height='31' colspan='5' align='center' id='titlell'>" . $booking['ticke'] . " Transportation from <b>" . $booking['from_name'] . " </b>to <b>" . $booking['to_name'] . "</b></td>
                                  </tr>
                                  <tr >
                                    <td width='7%' height='30'>" . $booking['pax'] . "</td>
                                    <td width='17%'>Adults</td>
                                    <td id='titlell' width='53%'>" . $booking['ticke'] . " " . $booking['residente'] . "</td>
                                    <td id='titlelp' width='11%'>$ " . $booking['precioadul'] . "</td>
                                    <td id='titlelp' width='12%'>$ " . $booking['totaladul'] . "</td>
                                  </tr>
                                  <tr>


                                    <td height='27'>" . $booking['chil'] . "</td>
                                    <td>Children (3-9 Years)</td>
                                    <td id='titlell'>" . $booking['ticke'] . " " . $booking['residente'] . "</td>
                                    <td id='titlelp'>$ " . $booking['preciochil'] . "</td>
                                    <td id='titlelp'>$ " . $booking['totalchil'] . "</td>
                                  </tr>
                                   <tr>
                                    <td height='27'></td>
                                    <td>&nbsp;</td>
                                    <td id='titlell'> Pick up Point /Drop Off - Extension </td>
                                    <td id='titlelp'>$ " . $booking['pricexten'] . "</td>
                                    <td id='titlelp'>$ " . $booking['totalexten'] . "</td>
                                  </tr>
                                  <tr>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td id='titlell'>Taxes and Fees</td>
                                    <td id='titlelp'>$ 0.00</td>
                                    <td id='titlelp'>$ 0.00 </td>
                                  </tr>
                                  <tr>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td colspan='2' align='center' class='Estilo1'  id='titlelr2'> " . $tipo->pago . "</td>
                                    <td id='titlelr2'><span class='Estilo2'>$  " . $booking['totaltotal'] . "</span></td>
                                  </tr>
                                  <tr>
                                    <td>Comments</td>
                                    <td>&nbsp;</td>
                                    <td  id='titlelr' align='center' colspan='2'><p>" . $tipo->comment . "</p>
                                      <p>&nbsp;</p></td>
                                    <td id='titlelr'>" . $_SESSION['booking']['card_number'] . "</td>
                                  </tr>
                                </table>
                                  <p>&nbsp;</p>
                                <p>Non-refundable - non-transferable - no changes are allowed on dates or time of departure - no pets allowed on board -<br />
                                  luggage restrictions apply - Please read the terms of transportation at www.supertours.com<br />
                                  THANK YOU FOR CHOOSING US<br />
                                  HAVE A NICE TRIP<br />
                                  SUPER TOURS.<br />
                                  Phone: (407) 370-3001 Orlando / (305) 677-2676 Miami / e-mail: reservations@supertours.com

                                </p></td>
                              </tr>
                              <tr>
                                <td colspan='4' align='center'> <p align='center' class='titulopago'>

                            </p>       </td>

                              </tr>
                              </table>



                            </div>");
                    }

                    $mail2->Send();
                } catch (phpmailerException $e) {
                    echo $e->errorMessage(); //Errores de PhpMailer
                } catch (Exception $e) {
                    echo $e->getMessage(); //Errores de cualquier otra cosa.
                }

/////////////////////////////////////////////////////////




                if ($login->username == "operador1@supertours.com" || $login->username == "operador2@supertours.com" || $login->username == "operador3@supertours.com") {

                    try {
                        Doo::loadController('DatosMailController');
                        $datosMail = new DatosMailController();
                        $mail3 = new PHPMailer(true);
                        $mail3 = $datosMail->datos();
                        //La direccion a donde mandamos el correo
                        $mail3->AddAddress($login->username, "Super Tours");
                        $tipo_ticket = $booking["tipo_ticket"];

                        if ($tipo_ticket == "oneway") {

                            $mail3->MsgHTML("<head>

                            <title>Documento sin titulo</title>
                            <style type='text/css'>
                            #clearTable {
                                width: 800px;
                                font-size: 13px;
                                font-family: Verdana, Geneva, sans-serif;
                            }
                            #clearTable tr #titletd3 {
                                font-family: Verdana, Geneva, sans-serif;
                            }
                            #clearTable tr #titletd2 {
                                font-size: 20px;
                            }
                            #clearTable tr td p {
                                text-align: center;
                            }

                            #content #center-column #tdgris {
                                background-color: #F0F0F0;
                            }
                            #content #center-column #tdrojo {
                                background-color: #FFE6E6;
                            }
                            #content #center-column1 #titletd {
                                background-color: #F5EDEB;
                                padding-left: 5px;
                                font-size: 12px;
                            }
                             #titlett {
                                background-color: #E8E8E8;
                                padding-left: 5px;
                                font-size: 12px;
                            }
                             #titlell {
                                padding-left: 5px;
                                font-size: 12px;
                                border-bottom-width: 1px;
                                border-left-width: 1px;
                                border-bottom-style: solid;
                                border-left-style: solid;
                                border-bottom-color: #E6E6E6;
                                border-left-color: #E6E6E6;
                            }
                            #titlelp {
                                padding-left: 5px;
                                font-size: 12px;
                                border-bottom-width: 1px;
                                border-bottom-style: solid;
                                border-bottom-color: #E6E6E6;
                            }
                             #titlelr {
                                padding-left: 5px;
                                font-size: 12px;
                                border-top-width: 1px;
                                border-top-style: solid;
                                border-top-color: #CE0000;
                                color: #CE0000;
                            }
                             #tdgristable {
                                background-color: #FFF;
                                padding-left: 5px;
                            }



                            .Estilo2 {color: #FF0000}
                            .Estilo3 {color: #FFFFFF}
                            .Estilo4 {color: #000000; }
                            </style>
                            </head><div align='center'>
                            <br />
                            <table   id='clearTable'>
                                 <tr>
                                   <td width='316' height='33' rowspan='2' id='titletd3'><img src='".$this->data['rootUrl']."global/estilos/logo.png' width='316' height='88' /></td>
                                   <td colspan='3' align='center' id='titletd3'>Supertours.com</td>
                                 </tr>
                                 <tr>
                                   <td height='35' colspan='3' id='titletd4'>Date/Time of Booking: " . $booking['fecha_ini'] . " / " . $booking['hora'] . "</td>
                                </tr>
                                 <tr>
                                   <td align='center' height='33' colspan='4' id='titletd2'>" . $booking['ticke'] . " E-TICKET</td>
                                 </tr>
                                 <tr>
                                 <td height='15' id='titletd6'>
                                 " .$opcuser1. "" .$opcuser2. "" .$opcuser3. "" .$opcuser4. "" .$opcuser5. "" .$opcuser6. "" .$opcuser7. "" .$opcuser8. "
                                 </td>
                                 </tr>
                                 <tr>
                                 <td height='15' id='titletd6'>
                                 " .$opcchild1. "" .$opcchild2. "" .$opcchild3. "" .$opcchild4. "" .$opcchild5. "" .$opcchild6. "" .$opcchild7. "" .$opcchild8. "
                                 </td>
                                   <td width='145' height='15' id='titletd6'>&nbsp;</td>
                                   <td colspan='2' id='titletd6'>AD : " . $booking['pax'] . "<strong>  </strong>CHD : " . $booking['chil'] . " <strong> TOTAL</strong> : " . $totalpax . "</td>
                                 </tr>
                                 <tr>
                                   <td height='16' id='titletd7'>" . $_SESSION['booking']['agen'] . "</td>
                                   <td height='16' id='titletd7'>Status: CONFIRMED</td>
                                   <td width='197' height='16' id='titletd7'>Confirmation # " . $booking['codconf'] . "</td>
                                   <td width='122' height='16' id='titletd7'>Paid by: " . $tipo->tipo . "</td>
                                 </tr>
                                 <tr>
                                <td height='45' colspan='4' id='titletd'> <p><strong>ORDER&nbsp;  CONFIRMATION</strong> + " . $booking['ticke'] . " </p></td>
                              </tr>
                              <tr>
                                <td colspan='4' ><table width='90%' height='125' id='tableorder'>
                                  <tr>
                                    <td  width='34%' height='35' id='titlett'  ><strong>Departure Date: </strong>" . date('l', strtotime($fecha)) . ", " . date('M-d-Y', strtotime($fecha)) . "  </td>
                                    <td  id='titlett' width='26%'><strong>TRIP # :</strong> " . $booking['trip_no'] . "</td>
                                    <td  id='titlett' width='40%'><strong>DEPARTURE TIME :</strong> " . date('g:i a', strtotime($booking['trip_departure'])) . "</td>
                                  </tr>
                                  <tr>
                                    <td height='41'><strong>From :</strong> " . $booking['from_name'] . "</td>
                                    <td colspan='2'><strong>Pick up Point / Extensions :</strong> " . $booking['place1'] . " , " . $booking['hotelarea1'] . "</td>
                                  </tr>
                                  <tr>
                                    <td height='39'><strong>To </strong>:" . $booking['to_name'] . "</td>
                                    <td colspan='2'><strong>Drop Off / Extensions :</strong> " . $booking['address1'] . " , " . $booking['hotelarea2'] . "</td>
                                    </tr>

                              </table>

                                <table id='tableorder2' width='90%'>
                                  <tr>
                                    <td  align='center' height='35' id='titlett2'  >Please print and present this e-ticket to for boarding<br />
                                      Please arrive at departure point 30 minutes before the scheduled time</td>
                                    </tr>
                                </table>
                                <table id='tableorder3' width='90%'>
                                  <tr>
                                    <td  height='35' colspan='3' id='titlett3'  aling='center' >RECEIPT</td>
                                    </tr>
                                  <tr>
                                    <td width='34%' height='28'>Card Holder Information</td>
                                    <td colspan='2'>Billing Address </td>
                                  </tr>
                                  <tr>
                                    <td height='27'>Name : " . $_SESSION['booking']['firstname'] . " </td>
                                    <td colspan='2'>Address : " . $login->address . "</td>
                                     <td colspan='2'>Phone : " . $login->phone . "</td>
                                  </tr>
                                  <tr>
                                    <td height='27'>Last Name : " . $_SESSION['booking']['lastname'] . "</td>
                                    <td colspan='2'>City : " . $login->city . "</td>
                                  </tr>
                                  <tr>
                                    <td height='27'>E-mail : " . $login->username . "</td>
                                    <td>State : " . $login->state . "</td>
                                    <td>Country :" . $login->country . "</td>
                                  </tr>
                                  <tr>
                                    <td height='27'>Lead Traveler : " . $_SESSION['booking']['firstname'] . " " . $_SESSION['booking']['lastname'] . "</td>
                                    <td colspan='2'>Zip / Postal Code : " . $login->zip . " </td>
                                  </tr>
                                </table>
                                <p><br />
                              </p></td>
                              </tr>
                              <tr>
                                <td height='33' colspan='4' id='titletd' ><strong>PRICE</strong></td>
                              </tr>
                              <tr>
                                <td colspan='4'><table width='90%' border='0' cellpadding='3' id='tableorder'>
                                  <tr>
                                    <td height='29' colspan='5' align='center'  id='titlett'><strong>COST SUMMARY</strong></td>
                                  </tr>
                                  <tr>
                                    <td height='31' colspan='5' align='center' id='titlell'>" . $booking['ticke'] . " Transportation from <b>" . $booking['from_name'] . " </b>to <b>" . $booking['to_name'] . "</b></td>
                                  </tr>
                                  <tr >
                                    <td width='7%' height='30'>" . $booking['pax'] . "</td>
                                    <td width='17%'>Adults</td>
                                    <td id='titlell' width='53%'>" . $booking['ticke'] . " " . $booking['residente'] . "</td>
                                    <td id='titlelp' width='11%'>$ " . $booking['precioadul'] . "</td>
                                    <td id='titlelp' width='12%'>$ " . $booking['totaladul'] . "</td>
                                  </tr>
                                  <tr>


                                    <td height='27'>" . $booking['chil'] . "</td>
                                    <td>Children (3-9 Years)</td>
                                    <td id='titlell'>" . $booking['ticke'] . " " . $booking['residente'] . "</td>
                                    <td id='titlelp'>$ " . $booking['preciochil'] . "</td>
                                    <td id='titlelp'>$ " . $booking['totalchil'] . "</td>
                                  </tr>
                                   <tr>
                                    <td height='27'></td>
                                    <td>&nbsp;</td>
                                    <td id='titlell'> Pick up Point /Drop Off - Extension </td>
                                    <td id='titlelp'>$ " . $booking['pricexten'] . "</td>
                                    <td id='titlelp'>$ " . $booking['totalexten'] . "</td>
                                  </tr>
                                  <tr>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td id='titlell'>Taxes and Fees</td>
                                    <td id='titlelp'>$ 0.00</td>
                                    <td id='titlelp'>$ 0.00 </td>
                                  </tr>
                                  <tr>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td colspan='2' align='center' class='Estilo2'  id='titlelr2'> " . $tipo->pago . "</td>
                                    <td id='titlelr2'><span class='Estilo2'><strong>$  " . $booking['totaltotal'] . " </strong></span></td>
                                  </tr>
                                  <tr>
                                    <td>Comments</td>
                                    <td>&nbsp;</td>
                                    <td colspan='2' align='center' class='Estilo4'  id='titlelr'><p>" . $tipo->comment . "</p>
                                      <p>&nbsp;</p></td>
                                    <td class='Estilo3' id='titlelr'>&nbsp;</td>
                                  </tr>
                                </table>
                                  <p>&nbsp;</p>
                                <p>Non-refundable - non-transferable - no changes are allowed on dates or time of departure - no pets allowed on board -<br />
                                  luggage restrictions apply - Please read the terms of transportation at www.supertours.com<br />
                                  THANK YOU FOR CHOOSING US<br />
                                  HAVE A NICE TRIP<br />
                                  SUPER TOURS.<br />
                                  Phone: (407) 370-3001 Orlando / (305) 677-2676 Miami / e-mail: reservations@supertours.com

                                </p></td>
                              </tr>
                              <tr>
                                <td colspan='4' align='center'> <p align='center' class='titulopago'>

                            </p>       </td>

                              </tr>
                              </table>


                            </div>");
                                                    } else {
                                                        $mail3->MsgHTML("<head>

                                                <title>Documento sin título</title>
                                                <style type='text/css'>
                                                #clearTable {
                                                    width: 800px;
                                                    font-size: 13px;
                                                    font-family: Verdana, Geneva, sans-serif;
                                                }
                                                #clearTable tr #titletd3 {
                                                    font-family: Verdana, Geneva, sans-serif;
                                                }
                                                #clearTable tr #titletd2 {
                                                    font-size: 20px;
                                                }
                                                #clearTable tr td p {
                                                    text-align: center;
                                                }

                                                #content #center-column #tdgris {
                                                    background-color: #F0F0F0;
                                                }
                                                #content #center-column #tdrojo {
                                                    background-color: #FFE6E6;
                                                }
                                                #content #center-column1 #titletd {
                                                    background-color: #F5EDEB;
                                                    padding-left: 5px;
                                                    font-size: 12px;
                                                }
                                                 #titlett {
                                                    background-color: #E8E8E8;
                                                    padding-left: 5px;
                                                    font-size: 12px;
                                                }
                                                 #titlell {
                                                    padding-left: 5px;
                                                    font-size: 12px;
                                                    border-bottom-width: 1px;
                                                    border-left-width: 1px;
                                                    border-bottom-style: solid;
                                                    border-left-style: solid;
                                                    border-bottom-color: #E6E6E6;
                                                    border-left-color: #E6E6E6;
                                                }
                                                #titlelp {
                                                    padding-left: 5px;
                                                    font-size: 12px;
                                                    border-bottom-width: 1px;
                                                    border-bottom-style: solid;
                                                    border-bottom-color: #E6E6E6;
                                                }
                                                 #titlelr {
                                                    padding-left: 5px;
                                                    font-size: 12px;
                                                    border-top-width: 1px;
                                                    border-top-style: solid;
                                                    border-top-color: #CE0000;
                                                    color: #CE0000;
                                                }
                                                 #tdgristable {
                                                    background-color: #FFF;
                                                    padding-left: 5px;
                                                }



                                                .Estilo1 {color: #FF0000}
                                                .Estilo2 {
                                                    color: #990000;
                                                    font-weight: bold;
                                                }
                                                </style>
                                                </head><div align='center'>
                                                <br />
                                                <table   id='clearTable'>
                                                     <tr>
                                                       <td width='316' height='33' rowspan='2' id='titletd3'><img src='".$this->data['rootUrl']."global/estilos/logo.png' width='316' height='88' /></td>
                                                       <td colspan='3' align='center' id='titletd3'>Supertours.com</td>
                                                     </tr>
                                                     <tr>
                                                       <td height='35' colspan='3' id='titletd4'>Date/Time of Booking: " . $booking['fecha_ini'] . " / " . $booking['hora'] . "</td>
                                                    </tr>
                                                     <tr>
                                                       <td align='center' height='33' colspan='4' id='titletd2'>" . $booking['ticke'] . " E-TICKET</td>
                                                     </tr>
                                                     <tr>
                                                         <td height='15' id='titletd6'>
                                                         " .$opcuser1. "" .$opcuser2. "" .$opcuser3. "" .$opcuser4. "" .$opcuser5. "" .$opcuser6. "" .$opcuser7. "" .$opcuser8. "
                                                         </td>
                                                        </tr>
                                                        <tr>
                                                         <td height='15' id='titletd6'>
                                                         " .$opcchild1. "" .$opcchild2. "" .$opcchild3. "" .$opcchild4. "" .$opcchild5. "" .$opcchild6. "" .$opcchild7. "" .$opcchild8. "
                                                         </td>
                                                       <td width='145' height='15' id='titletd6'>&nbsp;</td>
                                                       <td colspan='2' id='titletd6'>AD : " . $booking['pax'] . "<strong>  </strong>CHD : " . $booking['chil'] . " <strong> TOTAL</strong> : " . $totalpax . "</td>
                                                     </tr>

                                                     <tr>
                                                       <td height='16' id='titletd7'>" . $_SESSION['booking']['agen'] . "</td>
                                                       <td height='16' id='titletd7'>Status: CONFIRMED</td>
                                                       <td width='197' height='16' id='titletd7'>Confirmation # " . $booking['codconf'] . "</td>
                                                       <td width='122' height='16' id='titletd7'>Paid by: " . $tipo->tipo . "</td>
                                                     </tr>
                                                     <tr>
                                                    <td height='45' colspan='4' id='titletd'> <p><strong>ORDER&nbsp;  CONFIRMATION</strong> + " . $booking['ticke'] . " </p></td>
                                                  </tr>
                                                  <tr>
                                                    <td colspan='4' ><table width='90%' height='125' id='tableorder'>
                                                      <tr>
                                                        <td  width='34%' height='35' id='titlett'  ><strong>Departure Date: </strong>" . date('l', strtotime($fecha)) . ", " . date('M-d-Y', strtotime($fecha)) . "  </td>
                                                        <td  id='titlett' width='26%'><strong>TRIP # :</strong> " . $booking['trip_no'] . "</td>
                                                        <td  id='titlett' width='40%'><strong>DEPARTURE TIME :</strong> " . date('g:i a', strtotime($booking['trip_departure'])) . "</td>
                                                      </tr>
                                                      <tr>
                                                        <td height='41'><strong>From :</strong> " . $booking['from_name'] . "</td>
                                                        <td colspan='2'><strong>Pick up Point / Extensions :</strong> " . $booking['place1'] . " , " . $booking['hotelarea1'] . "</td>
                                                      </tr>
                                                      <tr>
                                                        <td height='39'><strong>To </strong>:" . $booking['to_name'] . "</td>
                                                        <td colspan='2'><strong>Drop Off / Extensions :</strong> " . $booking['address1'] . " , " . $booking['hotelarea2'] . "</td>
                                                        </tr>
                                                  </table>

                                                   <table id='tableorder' width='90%'>
                                                      <tr>
                                                        <td id='titlett'  width='34%' height='35'  ><strong>Return Date :</strong> " . date('l', strtotime($fecha1)) . ", " . date('M-d-Y', strtotime($fecha1)) . "  , </td>
                                                        <td id='titlett' width='26%'><strong>TRIP # :</strong> " . $booking['trip_no2'] . "</td>
                                                        <td id='titlett' width='40%'><strong>DEPARTURE TIME :</strong> " . date('g:i a', strtotime($booking['trip_departure2'])) . "</td>
                                                      </tr>
                                                      <tr>
                                                        <td height='28'><strong>From :</strong> " . $booking['to_name'] . "</td>
                                                        <td colspan='2'><strong>Pick up Point / Extensions :</strong> " . $booking['place2'] . " , " . $booking['hotelarea3'] . "</td>
                                                      </tr>
                                                      <tr>
                                                        <td height='27'><strong>To :</strong>" . $booking['from_name'] . "</td>
                                                        <td colspan='2'><strong>Drop Off / Extensions :</strong> " . $booking['address2'] . " , " . $booking['hotelarea4'] . "</td>
                                                        </tr>
                                                    </table>


                                                    <table id='tableorder2' width='90%'>
                                                      <tr>
                                                        <td  align='center' height='35' id='titlett2'  >Please print and present this e-ticket to for boarding<br />
                                                          Please arrive at departure point 30 minutes before the scheduled time</td>
                                                        </tr>
                                                    </table>
                                                    <table id='tableorder3' width='90%'>
                                                      <tr>
                                                        <td  height='35' colspan='3' id='titlett3'  aling='center' >RECEIPT</td>
                                                        </tr>
                                                      <tr>
                                                        <td width='34%' height='28'>Card Holder Information</td>
                                                        <td colspan='2'>Billing Address </td>
                                                      </tr>
                                                      <tr>
                                                        <td height='27'>Name : " . $_SESSION['booking']['firstname'] . " </td>
                                                        <td colspan='2'>Address : " . $login->address . "</td>
                                                         <td colspan='2'>Phone : " . $login->phone . "</td>
                                                      </tr>
                                                      <tr>
                                                        <td height='27'>Last Name : " . $_SESSION['booking']['lastname'] . "</td>
                                                        <td colspan='2'>City : " . $login->city . "</td>
                                                      </tr>
                                                      <tr>
                                                        <td height='27'>E-mail : " . $login->username . "</td>
                                                        <td>State : " . $login->state . "</td>
                                                        <td>Country :" . $login->country . "</td>
                                                      </tr>
                                                      <tr>
                                                        <td height='27'>Lead Traveler : " . $_SESSION['booking']['firstname'] . " " . $_SESSION['booking']['lastname'] . "</td>
                                                        <td colspan='2'>Zip / Postal Code : " . $login->zip . " </td>
                                                      </tr>
                                                    </table>
                                                    <p><br />
                                                  </p></td>
                                                  </tr>
                                                  <tr>
                                                    <td height='33' colspan='4' id='titletd' ><strong>PRICE</strong></td>
                                                  </tr>
                                                  <tr>
                                                    <td colspan='4'><table width='90%' border='0' cellpadding='3' id='tableorder'>
                                                      <tr>
                                                        <td height='29' colspan='5' align='center'  id='titlett'><strong>COST SUMMARY</strong></td>
                                                      </tr>
                                                      <tr>
                                                        <td height='31' colspan='5' align='center' id='titlell'>" . $booking['ticke'] . " Transportation from <b>" . $booking['from_name'] . " </b>to <b>" . $booking['to_name'] . "</b></td>
                                                      </tr>
                                                      <tr >
                                                        <td width='7%' height='30'>" . $booking['pax'] . "</td>
                                                        <td width='17%'>Adults</td>
                                                        <td id='titlell' width='53%'>" . $booking['ticke'] . " " . $booking['residente'] . "</td>
                                                        <td id='titlelp' width='11%'>$ " . $booking['precioadul'] . "</td>
                                                        <td id='titlelp' width='12%'>$ " . $booking['totaladul'] . "</td>
                                                      </tr>
                                                      <tr>


                                                        <td height='27'>" . $booking['chil'] . "</td>
                                                        <td>Children (3-9 Years)</td>
                                                        <td id='titlell'>" . $booking['ticke'] . " " . $booking['residente'] . "</td>
                                                        <td id='titlelp'>$ " . $booking['preciochil'] . "</td>
                                                        <td id='titlelp'>$ " . $booking['totalchil'] . "</td>
                                                      </tr>
                                                       <tr>
                                                        <td height='27'></td>
                                                        <td>&nbsp;</td>
                                                        <td id='titlell'> Pick up Point /Drop Off - Extension </td>
                                                        <td id='titlelp'>$ " . $booking['pricexten'] . "</td>
                                                        <td id='titlelp'>$ " . $booking['totalexten'] . "</td>
                                                      </tr>
                                                      <tr>
                                                        <td>&nbsp;</td>
                                                        <td>&nbsp;</td>
                                                        <td id='titlell'>Taxes and Fees</td>
                                                        <td id='titlelp'>$ 0.00</td>
                                                        <td id='titlelp'>$ 0.00 </td>
                                                      </tr>
                                                      <tr>
                                                        <td>&nbsp;</td>
                                                        <td>&nbsp;</td>
                                                        <td colspan='2' align='center' class='Estilo1'  id='titlelr2'> " . $tipo->pago . "</td>
                                                        <td id='titlelr2'><span class='Estilo2'>$  " . $booking['totaltotal'] . "</span></td>
                                                      </tr>
                                                      <tr>
                                                        <td>Comments</td>
                                                        <td>&nbsp;</td>
                                                        <td  id='titlelr' align='center' colspan='2'><p>" . $tipo->comment . "</p>
                                                          <p>&nbsp;</p></td>
                                                        <td id='titlelr'>&nbsp;</td>
                                                      </tr>
                                                    </table>
                                                      <p>&nbsp;</p>
                                                    <p>Non-refundable - non-transferable - no changes are allowed on dates or time of departure - no pets allowed on board -<br />
                                                      luggage restrictions apply - Please read the terms of transportation at www.supertours.com<br />
                                                      THANK YOU FOR CHOOSING US<br />
                                                      HAVE A NICE TRIP<br />
                                                      SUPER TOURS.<br />
                                                      Phone: (407) 370-3001 Orlando / (305) 677-2676 Miami / e-mail: reservations@supertours.com

                                                    </p></td>
                                                  </tr>
                                                  <tr>
                                                    <td colspan='4' align='center'> <p align='center' class='titulopago'>

                                                </p>       </td>

                                                  </tr>
                                                  </table>



                                                </div>");
                        }

                        $mail3->Send();
                    } catch (phpmailerException $e) {
                        echo $e->errorMessage(); //Errores de PhpMailer
                    } catch (Exception $e) {
                        echo $e->getMessage(); //Errores de cualquier otra cosa.
                    }
                }





/////////////////////////////////////////////////////////

                if ($login->tipo_client == 3) {
                    try {
                        Doo::loadController('DatosMailController');
                        $datosMail = new DatosMailController();
                        $mail4 = new PHPMailer(true);
                        $mail4 = $datosMail->datos();
                        //La direccion a donde mandamos el correo
                        $mail4->AddAddress($login->username2, "Supertours");
                        if ($tipo_ticket == "oneway") {
                            $mail4->MsgHTML("<head>

                            <title>Documento sin titulo</title>
                            <style type='text/css'>
                            #clearTable {
                                width: 800px;
                                font-size: 13px;
                                font-family: Verdana, Geneva, sans-serif;
                            }
                            #clearTable tr #titletd3 {
                                font-family: Verdana, Geneva, sans-serif;
                            }
                            #clearTable tr #titletd2 {
                                font-size: 20px;
                            }
                            #clearTable tr td p {
                                text-align: center;
                            }

                            #content #center-column #tdgris {
                                background-color: #F0F0F0;
                            }
                            #content #center-column #tdrojo {
                                background-color: #FFE6E6;
                            }
                            #content #center-column1 #titletd {
                                background-color: #F5EDEB;
                                padding-left: 5px;
                                font-size: 12px;
                            }
                             #titlett {
                                background-color: #E8E8E8;
                                padding-left: 5px;
                                font-size: 12px;
                            }
                             #titlell {
                                padding-left: 5px;
                                font-size: 12px;
                                border-bottom-width: 1px;
                                border-left-width: 1px;
                                border-bottom-style: solid;
                                border-left-style: solid;
                                border-bottom-color: #E6E6E6;
                                border-left-color: #E6E6E6;
                            }
                            #titlelp {
                                padding-left: 5px;
                                font-size: 12px;
                                border-bottom-width: 1px;
                                border-bottom-style: solid;
                                border-bottom-color: #E6E6E6;
                            }
                             #titlelr {
                                padding-left: 5px;
                                font-size: 12px;
                                border-top-width: 1px;
                                border-top-style: solid;
                                border-top-color: #CE0000;
                                color: #CE0000;
                            }
                             #tdgristable {
                                background-color: #FFF;
                                padding-left: 5px;
                            }



                            </style>
                            </head><div align='center'>
                            <br />
                            <table   id='clearTable'>
                                 <tr>
                                   <td width='316' height='33' rowspan='2' id='titletd3'><img src='".$this->data['rootUrl']."global/estilos.logo.png' width='316' height='88' /></td>
                                   <td colspan='3' align='center' id='titletd3'>Supertours.com</td>
                                 </tr>
                                 <tr>
                                   <td height='35' colspan='3' id='titletd4'>Date/Time of Booking: " . $booking['fecha_ini'] . " / " . $booking['hora'] . "</td>
                                </tr>
                                 <tr>
                                   <td align='center' height='33' colspan='4' id='titletd2'>" . $booking['ticke'] . " E-TICKET</td>
                                 </tr>
                                 <tr>
                                 <td height='15' id='titletd6'>
                                 " .$opcuser1. "" .$opcuser2. "" .$opcuser3. "" .$opcuser4. "" .$opcuser5. "" .$opcuser6. "" .$opcuser7. "" .$opcuser8. "
                                 </td>
                                 </tr>
                                 <tr>
                                 <td height='15' id='titletd6'>
                                 " .$opcchild1. "" .$opcchild2. "" .$opcchild3. "" .$opcchild4. "" .$opcchild5. "" .$opcchild6. "" .$opcchild7. "" .$opcchild8. "
                                 </td>
                                   <td width='145' height='15' id='titletd6'>&nbsp;</td>
                                   <td colspan='2' id='titletd6'>AD : " . $booking['pax'] . "<strong>  </strong>CHD : " . $booking['chil'] . " <strong> TOTAL</strong> : " . $totalpax . "</td>
                                 </tr>
                                 <tr>
                                   <td height='16' id='titletd7'>&nbsp;</td>
                                   <td height='16' id='titletd7'>Status: CONFIRMED</td>
                                   <td width='197' height='16' id='titletd7'>Confirmation # " . $booking['codconf'] . "</td>
                                   <td width='122' height='16' id='titletd7'>Paid by: " . $tipo->tipo . "</td>
                                 </tr>
                                 <tr>
                                <td height='45' colspan='4' id='titletd'> <p><strong>ORDER&nbsp;  CONFIRMATION</strong> + " . $booking['ticke'] . " </p></td>
                              </tr>
                              <tr>
                                <td colspan='4' ><table width='90%' height='125' id='tableorder'>
                                  <tr>
                                    <td  width='34%' height='35' id='titlett'  ><strong>Departure Date: </strong>" . date('l', strtotime($fecha)) . ", " . date('M-d-Y', strtotime($fecha)) . "  </td>
                                    <td  id='titlett' width='26%'><strong>TRIP # :</strong> " . $booking['trip_no'] . "</td>
                                    <td  id='titlett' width='40%'><strong>DEPARTURE TIME :</strong> " . date('g:i a', strtotime($booking['trip_departure'])) . "</td>
                                  </tr>
                                  <tr>
                                    <td height='41'><strong>From :</strong> " . $booking['from_name'] . "</td>
                                    <td colspan='2'><strong>Pick up Point / Extensions :</strong> " . $booking['place1'] . " , " . $booking['hotelarea1'] . "</td>
                                  </tr>
                                  <tr>
                                    <td height='39'><strong>To </strong>:" . $booking['to_name'] . "</td>
                                    <td colspan='2'><strong>Drop Off / Extensions :</strong> " . $booking['address1'] . " , " . $booking['hotelarea2'] . "</td>
                                    </tr>
                              </table>

                                <table id='tableorder2' width='90%'>
                                  <tr>
                                    <td  align='center' height='35' id='titlett2'  >Please print and present this e-ticket to for boarding<br />
                                      Please arrive at departure point 30 minutes before the scheduled time</td>
                                    </tr>
                                </table>
                                <table id='tableorder3' width='90%'>
                                  <tr>
                                    <td  height='35' colspan='3' id='titlett3'  aling='center' >RECEIPT</td>
                                    </tr>
                                  <tr>
                                    <td width='34%' height='28'>Card Holder Information</td>
                                    <td colspan='2'>Billing Address </td>
                                  </tr>
                                  <tr>
                                    <td height='27'>Name : " . $_SESSION['booking']['firstname'] . " </td>
                                    <td colspan='2'>Address : " . $login->address . "</td>
                                     <td colspan='2'>Phone : " . $login->phone . "</td>
                                  </tr>
                                  <tr>
                                    <td height='27'>Last Name : " . $_SESSION['booking']['lastname'] . "</td>
                                    <td colspan='2'>City : " . $login->city . "</td>
                                  </tr>
                                  <tr>
                                    <td height='27'>E-mail : " . $login->username2 . "</td>
                                    <td>State : " . $login->state . "</td>
                                    <td>Country :" . $login->country . "</td>
                                  </tr>
                                  <tr>
                                    <td height='27'>Lead Traveler : " . $_SESSION['booking']['firstname'] . " " . $_SESSION['booking']['lastname'] . "</td>
                                    <td colspan='2'>Zip / Postal Code : " . $login->zip . " </td>
                                  </tr>
                                </table>
                                <p><br />
                              </p></td>
                              </tr>
                              <tr>
                                <td height='33' colspan='4' id='titletd' >&nbsp;</td>
                              </tr>
                              <tr>
                                <td colspan='4'><table width='90%' border='0' cellpadding='3' id='tableorder'>

                                  <tr>
                                    <td width='7%'>&nbsp;</td>
                                    <td width='17%'>&nbsp;</td>
                                    <td width='53%' id='titlell'>Taxes and Fees</td>
                                    <td width='11%' id='titlelp'>$ 0.00</td>
                                    <td width='12%' id='titlelp'>$ 0.00 </td>
                                  </tr>
                                  <tr>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td  id='titlelr' align='center' colspan='2'> " . $tipo->pago . "</td>
                                    <td id='titlelr'><strong>$  " . $booking['totaltotal'] . " </strong></td>
                                  </tr>
                                </table>
                                  <p>&nbsp;</p>
                                <p>Non-refundable - non-transferable - no changes are allowed on dates or time of departure - no pets allowed on board -<br />
                                  luggage restrictions apply - Please read the terms of transportation at www.supertours.com<br />
                                  THANK YOU FOR CHOOSING US<br />
                                  HAVE A NICE TRIP<br />
                                  SUPER TOURS.<br />
                                  Phone: (407) 370-3001 Orlando / (305) 677-2676 Miami / e-mail: reservations@supertours.com

                                </p></td>
                              </tr>
                              <tr>
                                <td colspan='4' align='center'> <p align='center' class='titulopago'>

                            </p>       </td>

                              </tr>
                              </table>



                            </div>");
                                                    } else {

                                                        $mail4->MsgHTML("<head>

                                                        <title>Documento sin título</title>
                                                        <style type='text/css'>
                                                        #clearTable {
                                                            width: 800px;
                                                            font-size: 13px;
                                                            font-family: Verdana, Geneva, sans-serif;
                                                        }
                                                        #clearTable tr #titletd3 {
                                                            font-family: Verdana, Geneva, sans-serif;
                                                        }
                                                        #clearTable tr #titletd2 {
                                                            font-size: 20px;
                                                        }
                                                        #clearTable tr td p {
                                                            text-align: center;
                                                        }

                                                        #content #center-column #tdgris {
                                                            background-color: #F0F0F0;
                                                        }
                                                        #content #center-column #tdrojo {
                                                            background-color: #FFE6E6;
                                                        }
                                                        #content #center-column1 #titletd {
                                                            background-color: #F5EDEB;
                                                            padding-left: 5px;
                                                            font-size: 12px;
                                                        }
                                                         #titlett {
                                                            background-color: #E8E8E8;
                                                            padding-left: 5px;
                                                            font-size: 12px;
                                                        }
                                                         #titlell {
                                                            padding-left: 5px;
                                                            font-size: 12px;
                                                            border-bottom-width: 1px;
                                                            border-left-width: 1px;
                                                            border-bottom-style: solid;
                                                            border-left-style: solid;
                                                            border-bottom-color: #E6E6E6;
                                                            border-left-color: #E6E6E6;
                                                        }
                                                        #titlelp {
                                                            padding-left: 5px;
                                                            font-size: 12px;
                                                            border-bottom-width: 1px;
                                                            border-bottom-style: solid;
                                                            border-bottom-color: #E6E6E6;
                                                        }
                                                         #titlelr {
                                                            padding-left: 5px;
                                                            font-size: 12px;
                                                            border-top-width: 1px;
                                                            border-top-style: solid;
                                                            border-top-color: #CE0000;
                                                            color: #CE0000;
                                                        }
                                                         #tdgristable {
                                                            background-color: #FFF;
                                                            padding-left: 5px;
                                                        }



                                                        .Estilo1 {color: #FF0000}
                                                        .Estilo2 {
                                                            color: #990000;
                                                            font-weight: bold;
                                                        }
                                                        </style>
                                                        </head><div align='center'>
                                                        <br />
                                                        <table   id='clearTable'>
                                                             <tr>
                                                               <td width='316' height='33' rowspan='2' id='titletd3'><img src='".$this->data['rootUrl']."global/estilos/logo.png' width='316' height='88' /></td>
                                                               <td colspan='3' align='center' id='titletd3'>Supertours.com</td>
                                                             </tr>
                                                             <tr>
                                                               <td height='35' colspan='3' id='titletd4'>Date/Time of Booking: " . $booking['fecha_ini'] . " / " . $booking['hora'] . "</td>
                                                            </tr>
                                                             <tr>
                                                               <td align='center' height='33' colspan='4' id='titletd2'>" . $booking['ticke'] . " E-TICKET</td>
                                                             </tr>
                                                             <tr>
                                                             <td height='15' id='titletd6'>
                                                             " .$opcuser1. "" .$opcuser2. "" .$opcuser3. "" .$opcuser4. "" .$opcuser5. "" .$opcuser6. "" .$opcuser7. "" .$opcuser8. "
                                                             </td>
                                                             </tr>
                                                             <tr>
                                                             <td height='15' id='titletd6'>
                                                             " .$opcchild1. "" .$opcchild2. "" .$opcchild3. "" .$opcchild4. "" .$opcchild5. "" .$opcchild6. "" .$opcchild7. "" .$opcchild8. "
                                                             </td>
                                                               <td width='145' height='15' id='titletd6'>&nbsp;</td>
                                                               <td colspan='2' id='titletd6'>AD : " . $booking['pax'] . "<strong>  </strong>CHD : " . $booking['chil'] . " <strong> TOTAL</strong> : " . $totalpax . "</td>
                                                             </tr>
                                                             <tr>
                                                               <td height='16' id='titletd7'>&nbsp;</td>
                                                               <td height='16' id='titletd7'>Status: CONFIRMED</td>
                                                               <td width='197' height='16' id='titletd7'>Confirmation # " . $booking['codconf'] . "</td>
                                                               <td width='122' height='16' id='titletd7'>Paid by: " . $tipo->tipo . "</td>
                                                             </tr>
                                                             <tr>
                                                            <td height='45' colspan='4' id='titletd'> <p><strong>ORDER&nbsp;  CONFIRMATION</strong> + " . $booking['ticke'] . " </p></td>
                                                          </tr>
                                                          <tr>
                                                            <td colspan='4' ><table width='90%' height='125' id='tableorder'>
                                                              <tr>
                                                                <td  width='34%' height='35' id='titlett'  ><strong>Departure Date: </strong>" . date('l', strtotime($fecha)) . ", " . date('M-d-Y', strtotime($fecha)) . "  </td>
                                                                <td  id='titlett' width='26%'><strong>TRIP # :</strong> " . $booking['trip_no'] . "</td>
                                                                <td  id='titlett' width='40%'><strong>DEPARTURE TIME :</strong> " . date('g:i a', strtotime($booking['trip_departure'])) . "</td>
                                                              </tr>
                                                              <tr>
                                                                <td height='41'><strong>From :</strong> " . $booking['from_name'] . "</td>
                                                                <td colspan='2'><strong>Pick up Point / Extensions :</strong> " . $booking['place1'] . " , " . $booking['hotelarea1'] . "</td>
                                                              </tr>
                                                              <tr>
                                                                <td height='39'><strong>To </strong>:" . $booking['to_name'] . "</td>
                                                                <td colspan='2'><strong>Drop Off / Extensions :</strong> " . $booking['address1'] . " , " . $booking['hotelarea2'] . "</td>
                                                                </tr>
                                                          </table>

                                                           <table id='tableorder' width='90%'>
                                                              <tr>
                                                                <td id='titlett'  width='34%' height='35'  ><strong> Return Date :</strong> " . date('l', strtotime($fecha1)) . ", " . date('M-d-Y', strtotime($fecha1)) . "  , </td>
                                                                <td id='titlett' width='26%'><strong>TRIP # :</strong> " . $booking['trip_no2'] . "</td>
                                                                <td id='titlett' width='40%'><strong>DEPARTURE TIME :</strong> " . date('g:i a', strtotime($booking['trip_departure2'])) . "</td>
                                                              </tr>
                                                              <tr>
                                                                <td height='28'><strong>From :</strong> " . $booking['to_name'] . "</td>
                                                                <td colspan='2'><strong>Pick up Point / Extensions :</strong> " . $booking['place2'] . " , " . $booking['hotelarea3'] . "</td>
                                                              </tr>
                                                              <tr>
                                                                <td height='27'><strong>To :</strong>" . $booking['from_name'] . "</td>
                                                                <td colspan='2'><strong>Drop Off / Extensions :</strong> " . $booking['address2'] . ", " . $booking['hotelarea4'] . "</td>
                                                                </tr>
                                                            </table>


                                                            <table id='tableorder2' width='90%'>
                                                              <tr>
                                                                <td  align='center' height='35' id='titlett2'  >Please print and present this e-ticket to for boarding<br />
                                                                  Please arrive at departure point 30 minutes before the scheduled time</td>
                                                                </tr>
                                                            </table>
                                                            <table id='tableorder3' width='90%'>
                                                              <tr>
                                                                <td  height='35' colspan='3' id='titlett3'  aling='center' >RECEIPT</td>
                                                                </tr>
                                                              <tr>
                                                                <td width='34%' height='28'>Card Holder Information</td>
                                                                <td colspan='2'>Billing Address </td>
                                                              </tr>
                                                              <tr>
                                                                <td height='27'>Name : " . $_SESSION['booking']['firstname'] . " </td>
                                                                <td colspan='2'>Address : " . $login->address . "</td>
                                                                 <td colspan='2'>Phone : " . $login->phone . "</td>
                                                              </tr>
                                                              <tr>
                                                                <td height='27'>Last Name : " . $_SESSION['booking']['lastname'] . "</td>
                                                                <td colspan='2'>City : " . $login->city . "</td>
                                                              </tr>
                                                              <tr>
                                                                <td height='27'>E-mail : " . $login->username2 . "</td>
                                                                <td>State : " . $login->state . "</td>
                                                                <td>Country :" . $login->country . "</td>
                                                              </tr>
                                                              <tr>
                                                                <td height='27'>Lead Traveler : " . $_SESSION['booking']['firstname'] . " " . $_SESSION['booking']['lastname'] . "</td>
                                                                <td colspan='2'>Zip / Postal Code : " . $login->zip . " </td>
                                                              </tr>
                                                            </table>
                                                            <p><br />
                                                          </p></td>
                                                          </tr>
                                                          <tr>
                                                            <td height='33' colspan='4' id='titletd' ><strong>PRICE</strong></td>
                                                          </tr>
                                                          <tr>
                                                            <td colspan='4'><table width='90%' border='0' cellpadding='3' id='tableorder'>

                                                              <tr>
                                                                <td height='31' colspan='5' align='center' id='titlell2'>&nbsp;</td>
                                                              </tr>

                                                              <tr>
                                                                <td width='7%'>&nbsp;</td>
                                                                <td width='17%'>&nbsp;</td>
                                                                <td width='53%' id='titlell'>Taxes and Fees</td>
                                                                <td width='11%' id='titlelp'>$ 0.00</td>
                                                                <td width='12%' id='titlelp'>$ 0.00 </td>
                                                              </tr>
                                                              <tr>
                                                                <td>&nbsp;</td>
                                                                <td>&nbsp;</td>
                                                                <td colspan='2' align='center' class='Estilo1'  id='titlelr2'> " . $tipo->pago . "</td>
                                                                <td id='titlelr2'><span class='Estilo2'>$  " . $booking['totaltotal'] . "</span></td>
                                                              </tr>

                                                            </table>
                                                              <p>&nbsp;</p>
                                                            <p>Non-refundable - non-transferable - no changes are allowed on dates or time of departure - no pets allowed on board -<br />
                                                              luggage restrictions apply - Please read the terms of transportation at www.supertours.com<br />
                                                              THANK YOU FOR CHOOSING US<br />
                                                              HAVE A NICE TRIP<br />
                                                              SUPER TOURS.<br />
                                                              Phone: (407) 370-3001 Orlando / (305) 677-2676 Miami / e-mail: reservations@supertours.com

                                                            </p></td>
                                                          </tr>
                                                          <tr>
                                                            <td colspan='4' align='center'> <p align='center' class='titulopago'>

                                                        </p>       </td>

                                                          </tr>
                                                          </table>



                                                        </div>");
                        }
                        $mail4->Send();
                    } catch (phpmailerException $e) {
                        echo $e->errorMessage(); //Errores de PhpMailer
                    } catch (Exception $e) {
                        echo $e->getMessage(); //Errores de cualquier otra cosa.
                    }
                }

                if (isset($_POST['ssl_txn_id'])) {

                    $this->renderc('approval', $this->data, true);
                }
            } else {
                Doo::db()->update($reserve);




                /* $mainController=new MainController();

                  $mainController->saveregreso();
                  $mainController->saveida(); */

                return Doo::conf()->APP_URL . "booking/pickup-dropoff/autentication/shopuser";
            }

            $this->renderc('approval', $this->data, true);
            unset($_SESSION['booking']);
        } else {
            return Doo::conf()->APP_URL . "";
        }
    }

    public function reserve() {

        if (isset($_POST['firstname']) && isset($_POST['lastname'])) {
            $firsname = $_POST['firstname'];
            $lasname = $_POST['lastname'];
        }

        if (isset($_SESSION["booking"])) {

            $booking = $_SESSION["booking"];
            $tipo_ticket = $booking["tipo_ticket"];
            $fecha_ini = $booking["fecha_ini"];
            $from = $booking["fromt"];
            $to = $booking["tot"];
            $fecha_salida = $booking["fecha_salida"];
            $fecha_retorno = $booking["fecha_retorno"];
            $pax = $booking["pax"];
            $pax2 = $booking["pax2"];
            $pickup1 = $booking["pickup1"];
            $dropoff1 = $booking["dropoff1"];
            $trip_no = $booking['trip_no'];
            $pickup2 = $booking["pickup2"];
            $dropoff2 = $booking["dropoff2"];
            $id_clientes = $booking['id_clientes'];
            $trip_no2 = $booking["trip_no2"];
            $price = $booking['price'];
            $price2 = $booking['price2'];
            $wf1 = $booking['wfprc_adult'];
            $wf2 = $booking['wfprc_child'];
            $total = $booking['total'];
            $codconf = $booking['codconf'];
            $hora = $booking['hora'];
        }


        $booking = array(
            "tipo_ticket" => $tipo_ticket,
            "fecha_ini" => $fecha_ini,
            "fromt" => $from,
            "tot" => $to,
            "fecha_salida" => $fecha_salida,
            "fecha_retorno" => $fecha_retorno,
            "pax" => $pax,
            "pax2" => $pax2,
            "trip_no" => $trip_no,
            "pickup1" => $pickup1,
            "dropoff1" => $dropoff1,
            "id_clientes" => $id_clientes,
            "firsname" => $firsname,
            "lasname" => $lasname,
            "pickup2" => $pickup2,
            "dropoff2" => $dropoff2,
            "trip_no2" => $trip_no2,
            "price" => $price,
            "price2" => $price2,
            "wfprc_adult" => $wf1,
            "wfprc_child" => $wf2,
            "total" => $total,
            "codconf" => $codconf,
            "hora" => $hora,
        );



        $_SESSION["booking"] = $booking;



        return Doo::conf()->APP_URL . "booking/pickup-dropoff/autentication/reserva/load";
        /*
         */
    }

    public function tipoclient() {
//        echo "<pre>";
//        print_r($_SESSION['user']->firstname);
//        die;
//        echo "</pre>";
        
        
        
         $firstname = $_POST['firstname'];
         $lastname = $_POST['lastname'];
         $email = $_POST['email'];

//        $firstname = $_POST['passingName1'];
//        $lastname = $_POST['passinglast1'];
//        $email = $_POST['passingMail'];
        
                        
        
        
        //echo $firstname;
        //echo $lastname;
        //echo $email;
        
        
//        
        //die;
        
        $_SESSION['user'] = new stdClass();
        $_SESSION['user']->firstname = $firstname;
        $_SESSION['user']->lastname = $lastname;
        $_SESSION['user']->email= $email;
        
//        print_r($_SESSION['user']);
//        die;
        
//        if($_SESSION['user']->firstname == "" && $_SESSION['user']->lastname == "" && $_SESSION['user']->email == ""){
//          isset($_SESSION['user']);
//          
//        }
        
//!isset($_SESSION['user'])
        
        if ($_SESSION['infoforms'] AND empty($_POST['firstname'])) {
            $_SESSION['user']->firstname = $_SESSION['infoforms']['passingName1'];
            $_SESSION['user']->lastname = $_SESSION['infoforms']['passinglast1'];
            $_SESSION['user']->username2 = $_SESSION['infoforms']['passingMail'];
            
            $nombre_inv = $_POST['nombre_inv'];
            $apellido_inv = $_POST['apellido_inv'];
            $email_inv =  $_POST['email_inv'];
           //echo "infoforms";
            //print_r($_SESSION['infoforms']);
            //print_r($_SESSION['user']);
            //die;
        }else{
            
          
        
          $_SESSION['user']->firstname = $_SESSION['user']->firstname;
          $_SESSION['user']->lastname = $_SESSION['user']->lastname;
          $_SESSION['user']->username2 = $_SESSION['user']->username;
          
          //$_SESSION['user']->firstname = $firstname;
          //$_SESSION['user']->lastname = $lastname;
          //$_SESSION['user']->username2 = $email;           
          //echo "user"; 
          //print_r($_SESSION['user']);
          //die;
          
        }
          
//          print_r($_SESSION['user']);
//          die;
//          
//          echo "user";
//          die;
        
        
        //print_r($_SESSION["booking"]);
        //print($_REQUEST['passingName1']);
        //die;

        if (isset($_SESSION["booking"]) && isset($_SESSION['user'])) {
            $login = $_SESSION['user'];
            $tipo = new stdclass();

            // if (isset($_POST['firstname']) && isset($_POST['lastname'])) {
          if (isset($_POST['passingName1']) && isset($_POST['passinglast1'])) {

                $_SESSION['booking']['firsname'] = $_POST['firstname'];
                $_SESSION['booking']['lasname'] = $_POST['lastname'];

          if (isset($_REQUEST['passingName1'])) {
                  $_SESSION['booking']['firsname1'] = $_POST['passingName1'];
                  $_SESSION['booking']['lasname1'] = $_POST['passinglast1'];
          }
          if (isset($_REQUEST['passingName2'])) {
                  $_SESSION['booking']['firsname2'] = $_POST['passingName2'];
                  $_SESSION['booking']['lasname2'] = $_POST['passinglast2'];
          }
           if (isset($_REQUEST['passingName3'])) {
                  $_SESSION['booking']['firsname3'] = $_POST['passingName3'];
                  $_SESSION['booking']['lasname3'] = $_POST['passinglast3'];
          }
           if (isset($_REQUEST['passingName4'])) {
                  $_SESSION['booking']['firsname4'] = $_POST['passingName4'];
                  $_SESSION['booking']['lasname4'] = $_POST['passinglast4'];
          }
           if (isset($_REQUEST['passingName5'])) {
                  $_SESSION['booking']['firsname5'] = $_POST['passingName5'];
                  $_SESSION['booking']['lasname5'] = $_POST['passinglast5'];
          }
           if (isset($_REQUEST['passingName6'])) {
                  $_SESSION['booking']['firsname6'] = $_POST['passingName6'];
                  $_SESSION['booking']['lasname6'] = $_POST['passinglast6'];
          }
           if (isset($_REQUEST['passingName7'])) {
                  $_SESSION['booking']['firsname7'] = $_POST['passingName7'];
                  $_SESSION['booking']['lasname7'] = $_POST['passinglast7'];
          }
           if (isset($_REQUEST['passingName8'])) {
                  $_SESSION['booking']['firsname8'] = $_POST['passingName8'];
                  $_SESSION['booking']['lasname8'] = $_POST['passinglast8'];
          }


          if (isset($_REQUEST['childName1'])) {
                  $_SESSION['booking']['childName1'] = $_POST['childName1'];
                  $_SESSION['booking']['childlast1'] = $_POST['childlast1'];
                  $_SESSION['booking']['edad1'] = $_POST['edad1'];
          }
          if (isset($_REQUEST['childName2'])) {
                  $_SESSION['booking']['childName2'] = $_POST['childName2'];
                  $_SESSION['booking']['childlast2'] = $_POST['childlast2'];
                  $_SESSION['booking']['edad2'] = $_POST['edad2'];
          }
           if (isset($_REQUEST['childName3'])) {
                  $_SESSION['booking']['childName3'] = $_POST['childName3'];
                  $_SESSION['booking']['childlast3'] = $_POST['childlast3'];
                  $_SESSION['booking']['edad3'] = $_POST['edad3'];
          }
           if (isset($_REQUEST['childName4'])) {
                  $_SESSION['booking']['childName4'] = $_POST['childName4'];
                  $_SESSION['booking']['childlast4'] = $_POST['childlast4'];
                  $_SESSION['booking']['edad4'] = $_POST['edad4'];
          }
           if (isset($_REQUEST['childName5'])) {
                  $_SESSION['booking']['childName5'] = $_POST['childName5'];
                  $_SESSION['booking']['childlast5'] = $_POST['childlast5'];
                  $_SESSION['booking']['edad5'] = $_POST['edad5'];
          }
           if (isset($_REQUEST['childName6'])) {
                  $_SESSION['booking']['childName6'] = $_POST['childName6'];
                  $_SESSION['booking']['childlast6'] = $_POST['childlast6'];
                  $_SESSION['booking']['edad6'] = $_POST['edad6'];
          }
           if (isset($_REQUEST['childName7'])) {
                  $_SESSION['booking']['childName7'] = $_POST['childName7'];
                  $_SESSION['booking']['childlast7'] = $_POST['childlast7'];
                  $_SESSION['booking']['edad7'] = $_POST['edad7'];
          }
           if (isset($_REQUEST['childName8'])) {
                  $_SESSION['booking']['childName8'] = $_POST['childName8'];
                  $_SESSION['booking']['childlast8'] = $_POST['childlast8'];
                  $_SESSION['booking']['edad8'] = $_POST['edad8'];
          }
            if (isset($_POST['passingMail'])) {
                $_SESSION['booking']['email'] = $_POST['passingMail'];
            }

            if (isset($_POST['comments'])) {
                $comments = $_POST['comments'];
                $tipo->comment = $comments;
            }
          }

            if (isset($_POST['celphone']) && isset($_POST['email'])) {

                $login->phone = $_POST['celphone'];
                $login->username2 = $_POST['email'];
            }


            if (isset($_POST['pago'])) {

                if ($_POST['pago'] == "Collect") {
                    $tipo->tipo = "Collect";
                    $tipo->pago = "PLEASE PAY DRIVER";
                    $_SESSION['tipo'] = $tipo;
                    return Doo::conf()->APP_URL . "booking/pickup-dropoff/autentication/showproute/email";
                }

                if ($_POST['pago'] == "OtherAmount") {
                    $total = $_POST['amount2'];



                    $tipo->tipo = "Collect";
                    $tipo->otheram = $total;
                    $tipo->pago = "PLEASE PAY DRIVER";

                    $_SESSION['tipo'] = $tipo;


                    return Doo::conf()->APP_URL . "booking/pickup-dropoff/autentication/showproute/email";
                }

                if ($_POST['pago'] == "voucher") {

                    $total = $_POST['amount'];
                    $agencia = $_POST['agencia'];

                    $tipo->tipo = "Voucher";
                    $tipo->otheram = $total;
                    $tipo->agencia = $agencia;
                    $tipo->pago = "PLEASE PAY DRIVER";

                    $_SESSION['tipo'] = $tipo;
                    return Doo::conf()->APP_URL . "booking/pickup-dropoff/autentication/showproute/email";
                }

                if ($_POST['pago'] == "credicard") {
                    $this->data['rootUrl'] = Doo::conf()->APP_URL;
                    $this->renderc('pago2', $this->data, true);
                }
            } else {
                $tipo->tipo = "Credit Card";

                // $_SESSION['booking']['firstname'] = $_SESSION['user']->firstname;  booking/pickup-dropoff/autentication/signup/guestcard
                // $_SESSION['booking']['lastname'] = $_SESSION['user']->lastname;
                $_SESSION['tipo'] = $tipo;
      // echo '<pre>';
      // print_r($_SESSION);
      // echo '</pre>'; die;
                // if ($_SESSION['signup2']->guest == 1) {
                // return Doo::conf()->APP_URL . "booking/pickup-dropoff/autentication/signup/guestcard";
                // }else{
                // return Doo::conf()->APP_URL . "booking/pickup-dropoff/autentication/pago";
                return Doo::conf()->APP_URL . "booking/pickup-dropoff/autentication/pago";               
                
                // }
            }
        }
    }

    public function tipoclient_old() {

        if (isset($_SESSION["booking"]) && isset($_SESSION['user'])) {

            $login = $_SESSION['user'];
            $tipo = new stdclass();
            if (isset($_POST['firstname']) && isset($_POST['lastname'])) {

                $_SESSION['booking']['firstname'] = $_POST['firstname'];
                $_SESSION['booking']['lastname'] = $_POST['lastname'];

                if (isset($_POST['comments'])) {
                    $comments = $_POST['comments'];
                    $tipo->comment = $comments;
                }
            }

            if (isset($_POST['celphone']) && isset($_POST['email'])) {

                $login->phone = $_POST['celphone'];
                $login->username2 = $_POST['email'];
            }


            if (isset($_POST['pago'])) {

                if ($_POST['pago'] == "Collect") {
                    $tipo->tipo = "Collect";
                    $tipo->pago = "PLEASE PAY DRIVER";
                    $_SESSION['tipo'] = $tipo;
                    return Doo::conf()->APP_URL . "booking/pickup-dropoff/autentication/showproute/email";
                }

                if ($_POST['pago'] == "OtherAmount") {
                    $total = $_POST['amount2'];
                    $tipo->tipo = "Collect";
                    $tipo->otheram = $total;
                    $tipo->pago = "PLEASE PAY DRIVER";
                    $_SESSION['tipo'] = $tipo;
                    return Doo::conf()->APP_URL . "booking/pickup-dropoff/autentication/showproute/email";
                }

                if ($_POST['pago'] == "voucher") {

                    $total = $_POST['amount'];
                    $agencia = $_POST['agencia'];


                    $tipo->tipo = "Voucher";
                    $tipo->otheram = $total;
                    $tipo->agencia = $agencia;
                    $tipo->pago = "PLEASE PAY DRIVER";

                    $_SESSION['tipo'] = $tipo;
                    return Doo::conf()->APP_URL . "booking/pickup-dropoff/autentication/showproute/email";
                }

                if ($_POST['pago'] == "credicard") {
                    $this->data['rootUrl'] = Doo::conf()->APP_URL;
                    $this->renderc('pago2', $this->data, true);
                }
            } else {
                $tipo->tipo = "Credit Card";
                $tipo->comment = "PAY ONLINE";
                $_SESSION['tipo'] = $tipo;
                // return Doo::conf()->APP_URL . "booking/pickup-dropoff/autentication/pago";
                return Doo::conf()->APP_URL . "booking/pickup-dropoff/autentication/pago";
            }
        }
    }

public function shopuser_inv(){
  // Doo::loadModel("Signup");
  $_SESSION['infoforms'] = $_POST;
//  print_r($_REQUEST);
//  die;
  // try {
  //   $contenido = "";
  //           Doo::loadController('DatosMailController');
  //           $datosMail = new DatosMailController();
  //           $mail = new PHPMailer(true);

  //           $mail2 = $datosMail->datos();
  //   $contenido .= '<pre> REQUEST: ' . print_r($_REQUEST, true) . '</pre>'.'<pre> ARRAY INFOFORM: '.print_r($_SESSION['infoforms'],true).'</pre>';
  //   $contenido .= "<span style='color:red;'>Cotizacion Transportation con usuario true </span>";
  //           $mail->Host = $mail2->Host;
  //           $mail->From = $mail2->From;
  //           $mail->FromName = "Supertours Of Orlando";
  //           $mail->Subject = "Arreglo del user (INFoFoRM)".$_REQUEST['passingName1']." ".$_REQUEST['passinglast1'];
  //           $mail->AddAddress("prodownloadall@gmail.com");    //En este espacio debe ir un correo de respaldo.

  //  $mail->MsgHTML($contenido);
  //  $mail->Send();

  //       } catch (phpmailerException $e) {
  //           echo $e->errorMessage(); //Errores de PhpMailer
  //       } catch (Exception $e) {
  //           echo $e->getMessage(); //Errores de cualquier otra cosa.
  //       }
  // $signup = new Signup($_REQUEST);

  // $signup->fecha_r = date("m-d-Y  H:i:s");
  // $signup->firstname = $_REQUEST['firstname'];
  // $signup->lastname = $_REQUEST['lastname'];
  // $signup->zip = $_REQUEST['zip'];
  // $signup->state = $state;
  // $signup->country = $country;

  $signup2 = new stdclass();

  if (isset($_SESSION['infoforms']['passingName1'])) {
    $signup2->person1 = array("nombre1"=>$_SESSION['infoforms']['passingName1'],"apelli1"=>$_SESSION['infoforms']['passinglast1'],"email1"=>$_SESSION['infoforms']['passingMail']);
  }
  if (isset($_SESSION['infoforms']['passingName2'])) {
    $signup2->person2 = array("nombre2"=>$_SESSION['infoforms']['passingName2'],"apelli2"=>$_SESSION['infoforms']['passinglast2']);
  }
   if (isset($_SESSION['infoforms']['passingName3'])) {
  $signup2->person3 = array("nombre3"=> $_SESSION['infoforms']['passingName3'],"apelli3"=>$_SESSION['infoforms']['passinglast3']);
  }
   if (isset($_SESSION['infoforms']['passingName4'])) {
  $signup2->person4 = array("nombre4"=>$_SESSION['infoforms']['passingName4'],"apelli4"=>$_SESSION['infoforms']['passinglast4']);
  }
   if (isset($_SESSION['infoforms']['passingName5'])) {
  $signup2->person5 = array("nombre5"=>$_SESSION['infoforms']['passingName5'],"apelli5"=>$_SESSION['infoforms']['passinglast5']);
  }
   if (isset($_SESSION['infoforms']['passingName6'])) {
  $signup2->person6 = array("nombre6"=>$_SESSION['infoforms']['passingName6'],"apelli6"=>$_SESSION['infoforms']['passinglast6']);
  }
   if (isset($_SESSION['infoforms']['passingName7'])) {
  $signup2->person7 = array("nombre7"=>$_SESSION['infoforms']['passingName7'],"apelli7"=>$_SESSION['infoforms']['passinglast7']);
  }
   if (isset($_SESSION['infoforms']['passingName8'])) {
  $signup2->person8 = array("nombre8"=>$_SESSION['infoforms']['passingName8'],"apelli8"=>$_SESSION['infoforms']['passinglast8']);
  }

   if (isset($_SESSION['infoforms']['childName1'])) {
    $signup2->child1 = array("nombre1"=>$_SESSION['infoforms']['childName1'],"apelli1"=>$_SESSION['infoforms']['childlast1'],"edad1"=>$_SESSION['infoforms']['edad1']);
  }
  if (isset($_SESSION['infoforms']['childName2'])) {
    $signup2->child2 = array("nombre2"=>$_SESSION['infoforms']['childName2'],"apelli2"=>$_SESSION['infoforms']['childlast2'],"edad2"=>$_SESSION['infoforms']['edad2']);
  }
   if (isset($_SESSION['infoforms']['childName3'])) {
  $signup2->child3 = array("nombre3"=> $_SESSION['infoforms']['childName3'],"apelli3"=>$_SESSION['infoforms']['childlast3'],"edad3"=>$_SESSION['infoforms']['edad3']);
  }
   if (isset($_SESSION['infoforms']['childName4'])) {
  $signup2->child4 = array("nombre4"=>$_SESSION['infoforms']['childName4'],"apelli4"=>$_SESSION['infoforms']['childlast4'],"edad4"=>$_SESSION['infoforms']['edad4']);
  }
   if (isset($_SESSION['infoforms']['childName5'])) {
  $signup2->child5 = array("nombre5"=>$_SESSION['infoforms']['childName5'],"apelli5"=>$_SESSION['infoforms']['childlast5'],"edad5"=>$_SESSION['infoforms']['edad5']);
  }
   if (isset($_SESSION['infoforms']['childName6'])) {
  $signup2->child6 = array("nombre6"=>$_SESSION['infoforms']['childName6'],"apelli6"=>$_SESSION['infoforms']['childlast6'],"edad6"=>$_SESSION['infoforms']['edad6']);
  }
   if (isset($_SESSION['infoforms']['childName7'])) {
  $signup2->child7 = array("nombre7"=>$_SESSION['infoforms']['childName7'],"apelli7"=>$_SESSION['infoforms']['childlast7'],"edad7"=>$_SESSION['infoforms']['edad7']);
  }
   if (isset($_SESSION['infoforms']['childName8'])) {
  $signup2->child8 = array("nombre8"=>$_SESSION['infoforms']['childName8'],"apelli8"=>$_SESSION['infoforms']['childlast8'],"edad8"=>$_SESSION['infoforms']['edad8']);
  }

  $signup2->username2 = $_SESSION['infoforms']['passingMail'];    //$signup->username;
  $signup2->username =  $_SESSION['infoforms']['passingMail'];
  $signup2->firstname =   $_SESSION['infoforms']['passingName1'];
  $signup2->lastname =  $_SESSION['infoforms']['passinglast1'];
  $signup2->guest = true;
  $_SESSION['signup2'] = $signup2;
//        echo "<pre>";
//        print_r($_SESSION);
//        echo "</pre>";
//       die;

  $this->data['rootUrl'] = Doo::conf()->APP_URL;

  return Doo::conf()->APP_URL . "booking/pickup-dropoff/autentication/shopuser";

}



    public function confir() {
        if(isset($_SESSION["booking"])){
          //Comprueba que el usuario x no pasa a ágina sin hacer proceso de búsqueda de la disponibilidad
            $booking = $_SESSION["booking"];
            $modalT = $this->naveganteDescaradoT();
            print($modalT);
        }

        $modalT = $this->modalTripPuesto();
        print($modalT);
        Doo::loadModel("Agency");

        if (isset($_SESSION['data_agency'])) {
            $dat = new Agency($_SESSION['data_agency']);
            $net_rate = ($dat->type_rate == 1) ? true : false;
        } else {
            $dat = new Agency();
            $net_rate = false;
            $dat->type_rate = 0;
        }

        if (isset($_SESSION["user"]) && isset($_SESSION["booking"]) || isset($_SESSION["infoforms"]) && isset($_SESSION["booking"])) {
            $booking = $_SESSION["booking"];
//            echo '<pre>';
//              print_r($booking);
//            echo '</pre>'; 
            if (isset($booking["pickup1"])) {
                $mainController = new MainController();
                $hor = date("is");
                list($mes, $dia, $anyo) = explode("-", $booking['fecha_salida']);
                $salida = $anyo . "-" . $mes . "-" . $dia;
                if (isset($_SESSION["booking"])) {
                    $booking = $_SESSION["booking"];
                    $tipo_ticket = $booking["tipo_ticket"];
                    $from = $booking["fromt"];
                    $to = $booking["tot"];
                    $fecha_salida = $booking["fecha_salida"];
                    $fecha_retorno = $booking["fecha_retorno"];
                    $pax = $booking["pax"];
                    $pickup1 = $booking["pickup1"];
                    $dropoff1 = $booking["dropoff1"];
                    $trip_no = $booking['trip_no'];
                    $pickup2 = $booking["pickup2"];
                    $dropoff2 = $booking["dropoff2"];
                    $trip_no2 = $booking["trip_no2"];
                    $price = $booking['price'];
                    $price2 = $booking['price2'];
                    $iden = $booking['iden'];
                    $dateT = $booking['dateT'];
                    $dateT1 = $booking["dateT1"];
                    $dateT2 = $booking["dateT2"];
                }

                Doo::loadController('admin/ReservasController');
                $reserveControl = new ReservasController();
                $codconf = $reserveControl->codigoConf(1);
        // session_destroy();
        // echo '<pre><b>';
        // print_r($codconf);
        // echo '</pre></b>';
        // die;
                $sql = "select
                              t1.trip_no,
                              t2.id,
                              t1.fecha,
                              t4.nombre as trip_from,
                              t5.nombre as trip_to,
                              t2.price,
                              t2.price2,
                              t2.wfprc_adult,
                              t2.wfprc_child,
                              t2.trip_departure,
                              t2.trip_arrival,
                              t3.equipment,
                             t1.estado ,
              t2.capacity
                         from programacion t1
                         left join routes t2 on (t1.trip_no = t2.trip_no)
                         left join trips  t3 on (t1.trip_no = t3.trip_no)
                         left join areas  t4 on (t2.trip_from = t4.id)
                         left join areas  t5 on  (t2.trip_to  = t5.id)
                         where t2.trip_from = ? AND t2.trip_to = ? and fecha = ? AND fecha > curdate() and t1.estado = '1'";

                if ($net_rate) {
                    $sql_net = "select
                              t1.trip_no,
                              t2.id,
                              t1.fecha,
                              t4.nombre as trip_from,
                              t5.nombre as trip_to,
                              t2.price,
                              t2.price2,
                              t2.wfprc_adult,
                              t2.wfprc_child,
                              t2.trip_departure,
                              t2.trip_arrival,
                              t3.equipment,
                             t1.estado ,
              t2.capacity
                         from programacion t1
                         left join routes t2 on (t1.trip_no = t2.trip_no)
                         left join trips  t3 on (t1.trip_no = t3.trip_no)
                         left join areas  t4 on (t2.trip_from = t4.id)
                         left join areas  t5 on  (t2.trip_to  = t5.id)
                         where t2.type_rate = 2 and t2.id_agency = '$dat->id' and t2.trip_from = '$from' AND t2.trip_to = '$to' and fecha = '$fecha_salida' AND fecha > curdate() and t1.estado = '1'";


                    $sql = "Select
                              ms.trip_no,
                              ms.id,
                              ms.fecha,
                              ms.trip_from,
                              ms.trip_to,
CASE
      WHEN ms.trip_no = k.trip_no THEN k.price
       ELSE ms.price
   END as price ,
CASE
      WHEN ms.trip_no = k.trip_no THEN k.price2
       ELSE ms.price2
   END as price2,
 ms.trip_departure,
 ms.trip_arrival,
 ms.equipment,
 ms.estado
 From ( " . $sql . " )as ms  LEft JOIN ( " . $sql_net . " ) as k ON (ms.trip_no = k.trip_no)";
                }
                $rs = Doo::db()->query($sql, array($from, $to, $fecha_salida));


                //    $rs = Doo::db()->query($sql, array($from, $to, $fecha_salida));

                $salida = $rs->fetchAll();

                $rs = Doo::db()->find("Areas", array("select" => "nombre",
                    "where" => "id = ?",
                    "param" => array($from),
                    "limit" => 1));
                $from_name = $rs->nombre;

                if ($tipo_ticket == "roundtrip") {
                    $rs = Doo::db()->query($sql, array($to, $from, $fecha_retorno));
                    $retorno = $rs->fetchAll();
                    $rs = Doo::db()->find("Areas", array("select" => "nombre",
                        "where" => "id = ?",
                        "param" => array($to),
                        "limit" => 1));
                    $to_name = $rs->nombre;
                }
                if ($tipo_ticket == "oneway") {
                    $rs = Doo::db()->query($sql, array($to, $from, $fecha_retorno));
                    $retorno = $rs->fetchAll();
                    $rs = Doo::db()->find("Areas", array("select" => "nombre",
                        "where" => "id = ?",
                        "param" => array($to),
                        "limit" => 1));
                    $to_name = $rs->nombre;
                }


                $this->data['rootUrl'] = Doo::conf()->APP_URL;
                $this->data['from_name'] = $from_name;
                $this->data['to_name'] = $to_name;

                $this->data['areas'] = Doo::db()->find("Areas", array("select" => "id, nombre", "asArray" => true));


                /* /////////////////////////////////////////////////////// */

                $fecha_ini = date("M-d-Y");
                $hora = date("H:i:s");


                $booking = $_SESSION['booking'];

                $login = $_SESSION['user'];

                if ($booking["tipo_ticket"] === "oneway") {
                    if ($from_name === "ORLANDO") {
                        if ($booking['exten'] == "Disney Resort" && isset($booking['actuali'])) {
                            $booking['trip_departure'] = date("H:i", strtotime("00:00") + strtotime($booking['trip_departure']) - strtotime("00:45"));
                        }
                        if ($booking['exten'] == "Universal Resort Area" && isset($booking['actuali'])) {
                            $booking['trip_departure'] = date("H:i", strtotime("00:00") + strtotime($booking['trip_departure']) - strtotime("00:30"));
                        }
                        if ($booking['exten'] == "International Drive Area" && isset($booking['actuali'])) {
                            $booking['trip_departure'] = date("H:i", strtotime("00:00") + strtotime($booking['trip_departure']) - strtotime("00:30"));
                        }
                    }
                }

                if ($booking["tipo_ticket"] == "roundtrip") {

                    if ($to_name == "ORLANDO") {

                        if ($booking['exten1'] == "Disney Resort" && isset($booking['actuali'])) {

                            $booking['trip_departure2'] = date("H:i", strtotime("00:00") + strtotime($booking['trip_departure2']) - strtotime("00:45"));
                        }


                        if ($booking['exten1'] == "Universal Resort Area" && isset($booking['actuali'])) {

                            $booking['trip_departure2'] = date("H:i", strtotime("00:00") + strtotime($booking['trip_departure2']) - strtotime("00:30"));
                        }
                        if ($booking['exten1'] == "International Drive Area" && isset($booking['actuali'])) {

                            $booking['trip_departure2'] = date("H:i", strtotime("00:00") + strtotime($booking['trip_departure2']) - strtotime("00:30"));
                        }
                    }

                    if ($from_name == "ORLANDO") {

                        if ($booking['exten'] == "Disney Resort" && isset($booking['actuali'])) {

                            $booking['trip_departure'] = date("H:i", strtotime("00:00") + strtotime($booking['trip_departure']) - strtotime("00:45"));
                        }


                        if ($booking['exten'] == "Universal Resort Area" && isset($booking['actuali'])) {

                            $booking['trip_departure'] = date("H:i", strtotime("00:00") + strtotime($booking['trip_departure']) - strtotime("00:30"));
                        }
                        if ($booking['exten'] == "International Drive Area" && isset($booking['actuali'])) {

                            $booking['trip_departure'] = date("H:i", strtotime("00:00") + strtotime($booking['trip_departure']) - strtotime("00:30"));
                        }
                    }
                }

                $c = date($booking['fecha_salida']);
                $y = date('Y');
                $limitDate = '12-31-'.$y;

                if ($booking["tipo_ticket"] == "oneway") {
                    $booking['fecha_retorno'] = "N/A";
                    $booking['pickup2'] = "N/A";
                    $booking['dropoff2'] = "N/A";
                    $booking['trip_no2'] = "N/A";
                    //$pax2 = "N/A";
                    ///////////////////////////////////
                    if (isset($_SESSION['user']) && isset($booking['pricer']) || isset($_SESSION["infoforms"]) && isset($booking['pricer']) ) {
                        $login = $_SESSION['user'];
                        if ($booking['resident'] == 1) {
                            $booking['totaladul'] = $booking['price'] * ($booking['pax']);
                            $booking['totaladul'] = number_format($booking['totaladul'], 2, '.', '');
                            $booking['precioadul'] = ( $booking['price'] );
                            $booking['precioadul'] = number_format($booking['precioadul'], 2, '.', '');
                            $booking['preciochil'] = ( $booking['pricer']);
                            $booking['preciochil'] = number_format($booking['preciochil'], 2, '.', '');
                            $booking['totalchil'] = $booking['pricer'] * ($booking['chil']);
                            $booking['totalchil'] = number_format($booking['totalchil'], 2, '.', '');
                            $booking['pricexten'] = ($booking['precio_e1'] + $booking['precio_e2'] + $booking['precio_e3'] + $booking['precio_e4']);
                            $booking['pricexten'] = number_format($booking['pricexten'], 2, '.', '');
                            $paxtotal = $booking['chil'] + $booking['pax'];
                            $booking['totalexten'] = ($booking['precio_e1'] + $booking['precio_e2'] + $booking['precio_e3'] + $booking['precio_e4']) * $paxtotal;
                            $booking['totalexten'] = number_format($booking['totalexten'], 2, '.', '');
                            $booking['totaltotal'] = $booking['totaladul'] + $booking['totalchil'] + $booking['totalexten'];
                            $booking['totaltotal'] = number_format($booking['totaltotal'], 2, '.', '');
                            $booking['residente'] = "Florida Residents Rate Express Service";
                            $booking['ticke'] = "One Way Trip";
                        } else {
                            /* esta parte del condicional es para los One Way */
                            //echo '<pre>';
                            //  print_r($booking);
                            //echo '</pre>';
                            $booking['totaladul'] = $booking['price'] * ($booking['pax']);
                            $booking['totaladul'] = number_format($booking['totaladul'], 2, '.', '');

                            $booking['precioadul'] = ( $booking['price'] );
                            $booking['precioadul'] = number_format($booking['precioadul'], 2, '.', '');

                            $booking['preciochil'] = ( $booking['pricer']);
                            $booking['preciochil'] = number_format($booking['preciochil'], 2, '.', '');


                            $booking['totalchil'] = $booking['pricer'] * ($booking['chil']);
                            $booking['totalchil'] = number_format($booking['totalchil'], 2, '.', '');

                            $booking['pricexten'] = ($booking['precio_e1'] + $booking['precio_e2'] + $booking['precio_e3'] + $booking['precio_e4']);
                            $booking['pricexten'] = number_format($booking['pricexten'], 2, '.', '');
                            $paxtotal = $booking['chil'] + $booking['pax'];

                            $booking['totalexten'] = ($booking['precio_e1'] + $booking['precio_e2'] + $booking['precio_e3'] + $booking['precio_e4']) * $paxtotal;
                            $booking['totalexten'] = number_format($booking['totalexten'], 2, '.', '');

                            $booking['totaltotal'] = $booking['totaladul'] + $booking['totalchil'] + $booking['totalexten'];
                            $booking['totaltotal'] = number_format($booking['totaltotal'], 2, '.', '');
                            $booking['residente'] = "Regular Ticket Rate Express Service";
                            $booking['ticke'] = "One Way Trip";
                        }
                    }

                    if ($booking['chil'] == 0) {
                        $booking['preciochil'] = 0.00;
                        $booking['preciochil'] = number_format($booking['preciochil'], 2, '.', '');
                    }
                    ////////////////////
                    $fee = $booking['totaltotal'] * 0.05;



                    $comision_agency = (!$net_rate) ? ($booking['totaltotal'] * (($this->cal_equipament($booking['trip_no'])) / 100)) : 0.00;
                    //Departure 300
                    if($booking["extension1"]=="12" && $booking["trip_no"]=="300" && $booking["fromt"]=="1"){
                      if ($c == $limitDate) {
                        $booking["trip_departure"]="15:30:0";
                        }else{
                        $booking["trip_departure"]="18:30:0";
                        }
                    }else if($booking["extension1"]=="11" && $booking["trip_no"]=="300" && $booking["fromt"]=="1"){
                      if ($c == $limitDate) {
                        $booking["trip_departure"]="15:30:0";
                        }else{
                        $booking["trip_departure"]="18:30:0";
                        }
                    }else if($booking["extension1"]=="13" && $booking["trip_no"]=="300" && $booking["fromt"]=="1"){
                      if ($c == $limitDate) {
                        $booking["trip_departure"]="15:00:0";
                      }else{
                        $booking["trip_departure"]="17:45:0";
                      }
                    }

                    //Departure 301
                    if($booking["pickup1"]=="7" && $booking["trip_no"]=="301" && $booking["fromt"]=="7"){
                        $booking["trip_departure"]="06:00:0";
                    }else if($booking["pickup1"]=="16" && $booking["trip_no"]=="301" && $booking["fromt"]=="7"){
                        $booking["trip_departure"]="05:50:0";
                    }
                    //arrival 301
                    if($booking["extension3"]=="12" && $booking["trip_no"]=="301" && $booking["tot"]=="1"){
                        $booking["trip_arrival"]="10:20:0";
                    }else if($booking["extension3"]=="11" && $booking["trip_no"]=="301" && $booking["tot"]=="1"){
                        $booking["trip_arrival"]="10:20:0";
                    }else if($booking["extension3"]=="13" && $booking["trip_no"]=="301" && $booking["tot"]=="1"){
                        $booking["trip_arrival"]="10:30:0";
                    }

                    //Departure 200
//                    if($booking["extension1"]=="12" && $booking["trip_no"]=="200" && $booking["fromt"]=="1"){
//                        $booking["trip_departure"]="11:20:0";
//                    }else if($booking["extension1"]=="11" && $booking["trip_no"]=="200" && $booking["fromt"]=="1"){
//                        $booking["trip_departure"]="11:20:0";
//                    }else if($booking["extension1"]=="13" && $booking["trip_no"]=="200" && $booking["fromt"]=="1"){
//                        $booking["trip_departure"]="11:00:0";
//                    }
//                    //Departure 201
//                    if(($booking["pickup1"]=="179" || $booking["pickup1"]=="304" || $booking["pickup1"]=="465") && $booking["trip_no"]=="201" && $booking["fromt"]=="9"){
//                        $booking["trip_departure"]="18:15:0";
//                    }
//                    //arrival 201
//                    if($booking["extension3"]=="12" && $booking["trip_no"]=="201" && $booking["tot"]=="1"){
//                        $booking["trip_arrival"]="23:15:0";
//                    }else if($booking["extension3"]=="11" && $booking["trip_no"]=="201" && $booking["tot"]=="1"){
//                        $booking["trip_arrival"]="23:15:0";
//                    }else if($booking["extension3"]=="13" && $booking["trip_no"]=="201" && $booking["tot"]=="1"){
//                        $booking["trip_arrival"]="23:30:0";
//                    }
                    //Departure 100
                    if($booking["extension1"]=="12" && $booking["trip_no"]=="100" && $booking["fromt"]=="1"){
                        $booking["trip_departure"]="6:30:0";
                    }else if($booking["extension1"]=="11" && $booking["trip_no"]=="100" && $booking["fromt"]=="1"){
                        $booking["trip_departure"]="6:30:0";
                    }else if($booking["extension1"]=="13" && $booking["trip_no"]=="100" && $booking["fromt"]=="1"){
                        $booking["trip_departure"]="6:00:0";
                    }
                    //Departure 101
                    if(($booking["pickup1"]=="179" || $booking["pickup1"]=="304" || $booking["pickup1"]=="465") && $booking["trip_no"]=="101" && $booking["fromt"]=="9"){
                        $booking["trip_departure"]="14:45:0";
                    }
                    //arrival 101
                    if($booking["extension3"]=="12" && $booking["trip_no"]=="101" && $booking["tot"]=="1"){
                        $booking["trip_arrival"]="19:45:0";
                    }else if($booking["extension3"]=="11" && $booking["trip_no"]=="101" && $booking["tot"]=="1"){
                        $booking["trip_arrival"]="19:45:0";
                    }else if($booking["extension3"]=="13" && $booking["trip_no"]=="101" && $booking["tot"]=="1"){
                        $booking["trip_arrival"]="20:00:0";
                    }

                    $booking = array(
                        "tipo_ticket" => $booking['tipo_ticket'],
                        "fecha_ini" => $fecha_ini,
                        "fromt" => $booking['fromt'],
                        "tot" => $booking['tot'],
                        "fecha_salida" => $booking['fecha_salida'],
                        "fecha_retorno" => $booking['fecha_retorno'],
                        "pax" => $booking['pax'],
                        "pax2" => $booking['chil'],
                        "exten" => $booking['exten'],
                        "to_name" => $this->data['to_name'],
                        "from_name" => $this->data['from_name'],
                        "totaladul" => $booking['totaladul'],
                        "precioadul" => $booking['precioadul'],
                        "pricechil" => $booking['pricechil'],
                        "preciochil" => $booking['preciochil'],
                        "totalchil" => $booking['totalchil'],
                        "pricexten" => $booking['pricexten'],
                        "totalexten" => $booking['totalexten'],
                        "totaltotal" => $booking['totaltotal'] + $fee,
                        "priceAdult" => $booking['priceAdult'],
                        "priceChild" => $booking['priceChild'],
                        "priceAdultR" => $booking['priceAdult1'],
                        "priceChildR" => $booking['priceChild1'],
                        "fee" => $fee,
                        "comision_agency" => $comision_agency,
                        "balance" => $booking['totaltotal'] - $comision_agency,
                        "resident" => $booking['resident'],
                        "residente" => $booking['residente'],
                        "ticke" => $booking['ticke'],
                        "priceadult" => $booking['priceadult'],
                        "price" => $booking['price'],
                        "trip_no" => $booking['trip_no'],
                        "pickup1" => $booking['pickup1'],
                        "dropoff1" => $booking['dropoff1'],
                        "id_clientes" => $login->id,
                        "pickup2" => $booking['pickup2'],
                        "dropoff2" => $booking['dropoff2'],
                        "trip_no2" => $booking['trip_no2'],
                        "price2" => $booking['price2'],
                        "pricechil" => $booking['pricechil'],
                        "codconf" => $codconf,
                        "hora" => $hora,
                        "pricer" => $booking['pricer'],
                        "extension1" => $booking['extension1'],
                        "extension3" => $booking['extension3'],
                        "extension2" => $booking['extension2'],
                        "extension4" => $booking['extension4'],
                        "precio_e1" => $booking['precio_e1'],
                        "precio_e2" => $booking['precio_e2'],
                        "precio_e3" => $booking['precio_e3'],
                        "precio_e4" => $booking['precio_e4'],
                        "trip_arrival" => $booking['trip_arrival'],
                        "trip_departure" => $booking['trip_departure'],
                        "trip_arrival2" => $booking['trip_arrival2'],
                        "trip_departure2" => $booking['trip_departure2'],
                        "place1" => $booking['place1'],
                        "address1" => $booking['address1'],
                        "chil" => $booking['chil'],
                        "hotelarea1" => $booking['hotelarea1'],
                        "hotelarea2" => $booking['hotelarea2'],
                        "zip" => $booking['zip'],
                        "hotelarea1" => $booking['hotelarea1'],
                        "hotelarea2" => $booking['hotelarea2'],
                        "hotelarea3" => $booking['hotelarea3'],
                        "hotelarea4" => $booking['hotelarea4'],
                        "idPrecioIda" => $booking['idPrecioIda'],
                        "idPrecioVuelta" => $booking['idPrecioVuelta'],
                        "iden" => $booking['iden'],
                        "dateT" => $booking['dateT'],
                        "dateT1" => $booking['dateT1'],
                        "dateT2" => $booking['dateT2'],
                        "trip1" => $booking['trip1'],
                        "trip2" => $booking['trip2']
                    );

                    $_SESSION["booking"] = $booking;
                } else { //[tipo_ticket] => roundtrip

                    if (isset($_SESSION['user']) || isset($_SESSION["infoforms"])) {
                        $login = $_SESSION['user'];

                        if ($booking['resident'] == 1) {

                            $booking['totaladul'] = ($booking['price'] + $booking['priceadult'] ) * ($booking['pax'] );
                            $booking['totaladul'] = number_format($booking['totaladul'], 2, '.', '');

                            $booking['precioadul'] = ( $booking['price'] + $booking['priceadult']);
                            $booking['precioadul'] = number_format($booking['precioadul'], 2, '.', '');

                            $booking['preciochil'] = ( $booking['pricechil'] + $booking['pricer']);
                            $booking['preciochil'] = number_format($booking['preciochil'], 2, '.', '');


                            $booking['totalchil'] = ($booking['pricechil'] + $booking['pricer']) * ($booking['chil']);
                            $booking['totalchil'] = number_format($booking['totalchil'], 2, '.', '');

                            $booking['pricexten'] = ($booking['precio_e1'] + $booking['precio_e2'] + $booking['precio_e3'] + $booking['precio_e4']);
                            $booking['pricexten'] = number_format($booking['pricexten'], 2, '.', '');
                            $paxtotal = $booking['chil'] + $booking['pax'];

                            $booking['totalexten'] = ($booking['precio_e1'] + $booking['precio_e2'] + $booking['precio_e3'] + $booking['precio_e4']) * $paxtotal;
                            $booking['totalexten'] = number_format($booking['totalexten'], 2, '.', '');

                            $booking['totaltotal'] = $booking['totaladul'] + $booking['totalchil'] + $booking['totalexten'];
                            $booking['totaltotal'] = number_format($booking['totaltotal'], 2, '.', '');
                            $booking['residente'] = "Florida Residents Rate Express Service";
                            $booking['ticke'] = "Round Trip";

                        } else {
                            /* esta parte del condicional es para configurar los precios del Round Trip */

                            /* echo '<pre>';
                              print_r($booking);
                              echo '</pre>'; */

                            $booking['precioadul'] = ( $booking['price'] + $booking['priceadult']);
                            $booking['precioadul'] = number_format($booking['precioadul'], 2, '.', '');

                            $booking['totaladul'] = ($booking['precioadul']) * ($booking['pax']);
                            $booking['totaladul'] = number_format($booking['totaladul'], 2, '.', '');

                            $booking['preciochil'] = ( $booking['pricer'] + $booking['pricechil']);
                            $booking['preciochil'] = number_format($booking['preciochil'], 2, '.', '');


                            $booking['totalchil'] = ($booking['preciochil']) * ($booking['chil']);
                            $booking['totalchil'] = number_format($booking['totalchil'], 2, '.', '');

                            $booking['pricexten'] = ($booking['precio_e1'] + $booking['precio_e2'] + $booking['precio_e3'] + $booking['precio_e4']);
                            $booking['pricexten'] = number_format($booking['pricexten'], 2, '.', '');
                            $paxtotal = $booking['chil'] + $booking['pax'];

                            $booking['totalexten'] = ($booking['precio_e1'] + $booking['precio_e2'] + $booking['precio_e3'] + $booking['precio_e4']) * $paxtotal;
                            $booking['totalexten'] = number_format($booking['totalexten'], 2, '.', '');

                            $booking['totaltotal'] = $booking['totaladul'] + $booking['totalchil'] + $booking['totalexten'];
                            $booking['totaltotal'] = number_format($booking['totaltotal'], 2, '.', '');
                            $booking['residente'] = "Regular Ticket Rate Express Service";
                            $booking['ticke'] = "Round Trip";
                            $fee = $booking['totaltotal'] * 0.05;
                        }
                    }

                    if ($booking['chil'] == 0) {
                        $booking['preciochil'] = 0.00;
                        $booking['preciochil'] = number_format($booking['preciochil'], 2, '.', '');
                    }
                    $comision_agency = (!$net_rate) ? ($booking['totaltotal'] * (($this->cal_equipament($booking['trip_no']) + $this->cal_equipament($booking['trip_no2'])) / 100)) / 2 : 0.00;
                    $fee = $booking['totaltotal'] * 0.05;
                    //Departure 300

                    if($booking["extension1"]=="12" && $booking["trip_no"]=="300" && $booking["fromt"]=="1"){
						if ($c == $limitDate) {
							$booking["trip_departure"]="15:30:0";
                        }else{
							$booking["trip_departure"]="18:30:0";
                        };
                    }else if($booking["extension1"]=="11" && $booking["trip_no"]=="300" && $booking["fromt"]=="1"){
						if ($c == $limitDate) {
							$booking["trip_departure"]="15:30:0";
                        }else{
							$booking["trip_departure"]="18:30:0";
                        };
                    }else if($booking["extension1"]=="13" && $booking["trip_no"]=="300" && $booking["fromt"]=="1"){
						if ($c == $limitDate) {
							$booking["trip_departure"]="15:00:0";
                        }else{
							 $booking["trip_departure"]="17:45:0";
                        };
                    }

                    if($booking["extension2"]=="12" && $booking["trip_no2"]=="300" && $booking["tot"]=="1"){
						if ($c == $limitDate) {
							$booking["trip_departure"]="15:30:0";
						}else{
                        $booking["trip_departure2"]="18:30:0";
						}
                    }else if($booking["extension2"]=="11" && $booking["trip_no2"]=="300" && $booking["tot"]=="1"){
						if ($c == $limitDate) {
							$booking["trip_departure"]="15:30:0";
						}else{
                        $booking["trip_departure2"]="18:30:0";
						}
                    }else if($booking["extension2"]=="13" && $booking["trip_no2"]=="300" && $booking["tot"]=="1"){
						if ($c == $limitDate) {
							$booking["trip_departure"]="15:00:0";
						}else{
                        $booking["trip_departure2"]="17:45:0";
						}
                    }

                    //Departure 301
                    if($booking["pickup1"]=="7" && $booking["trip_no"]=="301" && $booking["fromt"]=="7"){
                        $booking["trip_departure"]="06:00:0";
                    }else if($booking["pickup1"]=="16" && $booking["trip_no"]=="301" && $booking["fromt"]=="7"){
                        $booking["trip_departure"]="05:50:0";
                    }
                    if($booking["pickup2"]=="7" && $booking["trip_no2"]=="301" && $booking["tot"]=="7"){
                        $booking["trip_departure2"]="06:00:0";
                    }else if($booking["pickup2"]=="16" && $booking["trip_no2"]=="301" && $booking["tot"]=="7"){
                        $booking["trip_departure2"]="05:50:0";
                    }
                    //arrival 301
                    if($booking["extension3"]=="12" && $booking["trip_no"]=="301" && $booking["tot"]=="1"){
                        $booking["trip_arrival"]="10:20:0";
                    }else if($booking["extension3"]=="11" && $booking["trip_no"]=="301" && $booking["tot"]=="1"){
                        $booking["trip_arrival"]="10:20:0";
                    }else if($booking["extension3"]=="13" && $booking["trip_no"]=="301" && $booking["tot"]=="1"){
                        $booking["trip_arrival"]="10:30:0";
                    }
                    if($booking["extension4"]=="12" && $booking["trip_no2"]=="301" && $booking["fromt"]=="1"){
                        $booking["trip_arrival2"]="10:20:0";
                    }else if($booking["extension4"]=="11" && $booking["trip_no2"]=="301" && $booking["fromt"]=="1"){
                        $booking["trip_arrival2"]="10:20:0";
                    }else if($booking["extension4"]=="13" && $booking["trip_no2"]=="301" && $booking["fromt"]=="1"){
                        $booking["trip_arrival2"]="10:30:0";
                    }


                    //Departure 200
                    if($booking["extension1"]=="12" && $booking["trip_no"]=="200" && $booking["fromt"]=="1"){
                        $booking["trip_departure"]="11:20:0";
                    }else if($booking["extension1"]=="11" && $booking["trip_no"]=="200" && $booking["fromt"]=="1"){
                        $booking["trip_departure"]="11:20:0";
                    }else if($booking["extension1"]=="13" && $booking["trip_no"]=="200" && $booking["fromt"]=="1"){
                        $booking["trip_departure"]="11:00:0";
                    }
                    if($booking["extension2"]=="12" && $booking["trip_no2"]=="200" && $booking["tot"]=="1"){
                        $booking["trip_departure2"]="11:20:0";
                    }else if($booking["extension2"]=="11" && $booking["trip_no2"]=="200" && $booking["tot"]=="1"){
                        $booking["trip_departure2"]="11:20:0";
                    }else if($booking["extension2"]=="13" && $booking["trip_no2"]=="200" && $booking["tot"]=="1"){
                        $booking["trip_departure2"]="11:00:0";
                    }
                    //Departure 201
                    if(($booking["pickup1"]=="179" || $booking["pickup1"]=="304" || $booking["pickup1"]=="465") && $booking["trip_no"]=="201" && $booking["fromt"]=="9"){
                        $booking["trip_departure"]="18:15:0";
                    }
                    if(($booking["pickup2"]=="179" || $booking["pickup2"]=="304" || $booking["pickup2"]=="465") && $booking["trip_no2"]=="201" && $booking["tot"]=="9"){
                        $booking["trip_departure1"]="18:15:0";
                    }
                    //arrival 201
                    if($booking["extension3"]=="12" && $booking["trip_no"]=="201" && $booking["tot"]=="1"){
                        $booking["trip_arrival"]="23:15:0";
                    }else if($booking["extension3"]=="11" && $booking["trip_no"]=="201" && $booking["tot"]=="1"){
                        $booking["trip_arrival"]="23:15:0";
                    }else if($booking["extension3"]=="13" && $booking["trip_no"]=="201" && $booking["tot"]=="1"){
                        $booking["trip_arrival"]="23:30:0";
                    }
                    if($booking["extension4"]=="12" && $booking["trip_no2"]=="201" && $booking["fromt"]=="1"){
                        $booking["trip_arrival2"]="23:15:0";
                    }else if($booking["extension4"]=="11" && $booking["trip_no2"]=="201" && $booking["fromt"]=="1"){
                        $booking["trip_arrival2"]="23:15:0";
                    }else if($booking["extension4"]=="13" && $booking["trip_no2"]=="201" && $booking["fromt"]=="1"){
                        $booking["trip_arrival2"]="23:30:0";
                    }
                    //Departure 100
                    if($booking["extension1"]=="12" && $booking["trip_no"]=="100" && $booking["fromt"]=="1"){
                        $booking["trip_departure"]="6:30:0";
                    }else if($booking["extension1"]=="11" && $booking["trip_no"]=="100" && $booking["fromt"]=="1"){
                        $booking["trip_departure"]="6:30:0";
                    }else if($booking["extension1"]=="13" && $booking["trip_no"]=="100" && $booking["fromt"]=="1"){
                        $booking["trip_departure"]="6:00:0";
                    }
                    if($booking["extension2"]=="12" && $booking["trip_no2"]=="100" && $booking["tot"]=="1"){
                        $booking["trip_departure2"]="6:30:0";
                    }else if($booking["extension2"]=="11" && $booking["trip_no2"]=="100" && $booking["tot"]=="1"){
                        $booking["trip_departure2"]="6:30:0";
                    }else if($booking["extension2"]=="13" && $booking["trip_no2"]=="100" && $booking["tot"]=="1"){
                        $booking["trip_departure2"]="6:00:0";
                    }
                    //Departure 101
                    if(($booking["pickup1"]=="179" || $booking["pickup1"]=="304" || $booking["pickup1"]=="465") && $booking["trip_no"]=="101" && $booking["fromt"]=="9"){
                        $booking["trip_departure"]="14:45:0";
                    }
                    if(($booking["pickup2"]=="179" || $booking["pickup2"]=="304" || $booking["pickup2"]=="465") && $booking["trip_no2"]=="101" && $booking["tot"]=="9"){
                        $booking["trip_departure2"]="14:45:0";
                    }
                    //arrival 101
                    if($booking["extension3"]=="12" && $booking["trip_no"]=="101" && $booking["tot"]=="1"){
                        $booking["trip_arrival"]="19:45:0";
                    }else if($booking["extension3"]=="11" && $booking["trip_no"]=="101" && $booking["tot"]=="1"){
                        $booking["trip_arrival"]="19:45:0";
                    }else if($booking["extension3"]=="13" && $booking["trip_no"]=="101" && $booking["tot"]=="1"){
                        $booking["trip_arrival"]="20:00:0";
                    }
                    if($booking["extension4"]=="12" && $booking["trip_no2"]=="101" && $booking["fromt"]=="1"){
                        $booking["trip_arrival2"]="19:45:0";
                    }else if($booking["extension4"]=="11" && $booking["trip_no2"]=="101" && $booking["fromt"]=="1"){
                        $booking["trip_arrival2"]="19:45:0";
                    }else if($booking["extension4"]=="13" && $booking["trip_no2"]=="101" && $booking["fromt"]=="1"){
                        $booking["trip_arrival2"]="20:00:0";
                    }
					/*echo '<pre><b>';
					 print_r($booking);
					 echo '</pre></b>';
					 die;*/
                    $booking = array(
                        "tipo_ticket" => $booking['tipo_ticket'],
                        "fecha_ini" => $fecha_ini,
                        "fromt" => $booking['fromt'],
                        "tot" => $booking['tot'],
                        "fecha_salida" => $booking['fecha_salida'],
                        "fecha_retorno" => $booking['fecha_retorno'],
                        "pax" => $booking['pax'],
                        "exten" => $booking['exten'],
                        "exten1" => $booking['exten1'],
                        "to_name" => $this->data['to_name'],
                        "from_name" => $this->data['from_name'],
                        "pax2" => $booking['chil'],
                        "resident" => $booking['resident'],
                        "totaladul" => $booking['totaladul'],
                        "precioadul" => $booking['precioadul'],
                        "pricechil" => $booking['pricechil'],
                        "preciochil" => $booking['preciochil'],
                        "2pricechil" => $booking['2pricechil'],
                        "totalchil" => $booking['totalchil'],
                        "pricexten" => $booking['pricexten'],
                        "totalexten" => $booking['totalexten'],
                        "totaltotal" => $booking['totaltotal'] + $fee,
                        "fee" => $fee,
                        "comision_agency" => $comision_agency,
                        "balance" => $booking['totaltotal'] - $comision_agency,
                        "resident" => $booking['resident'],
                        "residente" => $booking['residente'],
                        "ticke" => $booking['ticke'],
                        "price" => $booking['price'],
                        "2price" => $booking['2price'],
                        "trip_no" => $booking['trip_no'],
                        "pickup1" => $booking['pickup1'],
                        "dropoff1" => $booking['dropoff1'],
                        "priceadult" => $booking['priceadult'],
                        "2priceadult" => $booking['2priceadult'],
                        "id_clientes" => $login->id,
                        "pickup2" => $booking['pickup2'],
                        "dropoff2" => $booking['dropoff2'],
                        "trip_no2" => $booking['trip_no2'],
                        "price2" => $booking['price2'],
                        "codconf" => $codconf,
                        "hora" => $hora,
                        "pricer" => $booking['pricer'],
                        "2pricer" => $booking['2pricer'],
                        "extension1" => $booking['extension1'],
                        "extension3" => $booking['extension3'],
                        "extension2" => $booking['extension2'],
                        "extension4" => $booking['extension4'],
                        "precio_e1" => $booking['precio_e1'],
                        "precio_e2" => $booking['precio_e2'],
                        "precio_e3" => $booking['precio_e3'],
                        "precio_e4" => $booking['precio_e4'],
                        "trip_arrival" => $booking['trip_arrival'],
                        "trip_departure" => $booking['trip_departure'],
                        "trip_arrival2" => $booking['trip_arrival2'],
                        "trip_departure2" => $booking['trip_departure2'],
                        "place2" => $booking['place2'],
                        "place1" => $booking['place1'],
                        "address1" => $booking['address1'],
                        "address2" => $booking['address2'],
                        "chil" => $booking['chil'],
                        "hotelarea1" => $booking['hotelarea1'],
                        "hotelarea2" => $booking['hotelarea2'],
                        "zip" => $booking['zip'],
                        "hotelarea1" => $booking['hotelarea1'],
                        "hotelarea2" => $booking['hotelarea2'],
                        "hotelarea3" => $booking['hotelarea3'],
                        "hotelarea4" => $booking['hotelarea4'],
                        "idPrecioIda" => $booking['idPrecioIda'],
                        "idPrecioVuelta" => $booking['idPrecioVuelta'],
                        "iden" => $booking['iden'],
                        "dateT" => $booking['dateT'],
                        "dateT1" => $booking['dateT1'],
                        "dateT2" => $booking['dateT2'],
                        "trip1" => $booking['trip1'],
                        "trip2" => $booking['trip2']
                    );


                    $_SESSION["booking"] = $booking;


                    $booking = $_SESSION['booking'];
                    /* echo '<pre>';
                      print_r($booking);
                      echo '</pre>'; */
                }
                      //  echo '<pre>';
                      // print_r($_SESSION['data_agency']);
                      // echo '</pre>';
                      // die;
                if (!isset($_SESSION['data_agency'])) {
                    #cotizacion
                    try {
                        $contenido .= '<pre>' . print_r($_SESSION, true) . '</pre>';
                        $contenido .= "<span style='color:red;'>Cotizacion Transportation </span>";
                        $mail = new PHPMailer();
                        $mail->IsSMTP();
                        $correo_emisor = "henry@supertours.com";
                        $nombre_emisor = "Super Tours";
                        $contrasena = "Henry123";
                        //$mail->SMTPDebug  = 2;
                        $mail->SMTPAuth = true;
                        //$mail->SMTPSecure = "tsl";
                        $mail->SMTPSecure = "ssl";
                        $mail->Host = "smtpout.secureserver.net";
                        $mail->Port = 465;
                        $mail->Username = $correo_emisor;
                        $mail->Password = $contrasena;
                        //$mail->AddReplyTo($correo_emisor, $nombre_emisor);
                        $mail->SetFrom("no_reply@supertours.com", $nombre_emisor);
                        $mail->Subject = 'SuperTours, Esta es una reserva de doble via -' . date("d-m-Y h:i:s");
                        $mail->AltBody = 'SuperTours, Esta es una reserva de doble via -' . date("d-m-Y h:i:s");
                        //$mail->AddAddress("bustamante3@hotmail.com");
			            $mail->AddBCC("arturo@supertours.com");
			            //$mail->AddBCC("arbusmad2021@gmail.com");
//                        $mail->AddAddress("websales@supertours.com");
                        $mail->MsgHTML($contenido);
                        $mail->Send();
                    } catch (phpmailerException $e) {
                        echo $e->errorMessage(); // Errores de PhpMailer
                    } catch (Exception $e) {
                        echo $e->getMessage(); // Errores de cualquier otra cosa.
                    }
                    #fin de cotizacion
                    $this->data['datosBooking'] = $booking;
                    /* echo '<pre>';
                      print_r($_SESSION['booking']);
                      echo '</pre>'; */
                    $this->renderc('shoproute', $this->data, true);
                } else {
                    if ($dat->type_rate == 0) {
                        $_SESSION['agency_fee'] = $booking['comision_agency'];
                    }
                    Doo::loadController("AgenciaController");

                    $agenControl = new AgenciaController();
                    $disponible = $agenControl->iscredit();
                    $this->data['disponible'] = $disponible;
                    $this->renderc('shoproute_agency', $this->data, true);
                }
            } else {
                return Doo::conf()->APP_URL . "booking/pickup-dropoff";
            }
        } else {
            return Doo::conf()->APP_URL . "booking/pickup-dropoff/autentication";
        }
    }

    public function confir2() {
        $modalT = $this->modalTripPuesto();
        print($modalT);
        if (isset($_SESSION["booking"])) {
            $booking = $_SESSION["booking"];
            if (isset($booking["pickup1"])) {
                $mainController = new MainController();
                $hor = date("is");
                list($mes, $dia, $anyo) = explode("-", $booking['fecha_salida']);
                $salida = $anyo . "-" . $mes . "-" . $dia;
                if (isset($_SESSION["booking"])) {
                    $booking = $_SESSION["booking"];
                    $tipo_ticket = $booking["tipo_ticket"];
                    $from = $booking["fromt"];
                    $to = $booking["tot"];
                    $fecha_salida = $booking["fecha_salida"];
                    $fecha_retorno = $booking["fecha_retorno"];
                    $pax = $booking["pax"];
                    $pickup1 = $booking["pickup1"];
                    $dropoff1 = $booking["dropoff1"];
                    $trip_no = $booking['trip_no'];
                    $pickup2 = $booking["pickup2"];
                    $dropoff2 = $booking["dropoff2"];
                    $trip_no2 = $booking["trip_no2"];
                    $price = $booking['price'];
                    $price2 = $booking['price2'];
                    $dateT = $booking['dateT'];
                    $dateT1 = $booking["dateT1"];
                    $dateT2 = $booking["dateT2"];
                }

                Doo::loadController('admin/ReservasController');
                $reserveControl = new ReservasController();
                $codconf = $reserveControl->codigoConf(1);

                $sql = "select
                              t1.trip_no,
                              t2.id,
                              t1.fecha,
                              t4.nombre as trip_from,
                              t5.nombre as trip_to,
                              t2.price,
                              t2.price2,
                              t2.trip_departure,
                              t2.trip_arrival,
                              t3.equipment,
                             t1.estado ,
              t2.capacity
                         from programacion t1
                         left join routes t2 on (t1.trip_no = t2.trip_no)
                         left join trips  t3 on (t1.trip_no = t3.trip_no)
                         left join areas  t4 on (t2.trip_from = t4.id)
                         left join areas  t5 on  (t2.trip_to  = t5.id)
                         where t2.trip_from = ? AND t2.trip_to = ? and fecha = ? AND fecha > curdate() and t1.estado = '1'";

                if ($net_rate) {
                    $sql_net = "select
                              t1.trip_no,
                              t2.id,
                              t1.fecha,
                              t4.nombre as trip_from,
                              t5.nombre as trip_to,
                              t2.price,
                              t2.price2,
                              t2.trip_departure,
                              t2.trip_arrival,
                              t3.equipment,
                             t1.estado ,
              t2.capacity
                         from programacion t1
                         left join routes t2 on (t1.trip_no = t2.trip_no)
                         left join trips  t3 on (t1.trip_no = t3.trip_no)
                         left join areas  t4 on (t2.trip_from = t4.id)
                         left join areas  t5 on  (t2.trip_to  = t5.id)
                         where t2.type_rate = 2 and t2.id_agency = '$dat->id' and t2.trip_from = '$from' AND t2.trip_to = '$to' and fecha = '$fecha_salida' AND fecha > curdate() and t1.estado = '1'";


                    $sql = "Select
                              ms.trip_no,
                              ms.id,
                              ms.fecha,
                              ms.trip_from,
                              ms.trip_to,
CASE
      WHEN ms.trip_no = k.trip_no THEN k.price
       ELSE ms.price
   END as price ,
CASE
      WHEN ms.trip_no = k.trip_no THEN k.price2
       ELSE ms.price2
   END as price2,
 ms.trip_departure,
 ms.trip_arrival,
 ms.equipment,
 ms.estado
 From ( " . $sql . " )as ms  LEft JOIN ( " . $sql_net . " ) as k ON (ms.trip_no = k.trip_no)";
                }
                $rs = Doo::db()->query($sql, array($from, $to, $fecha_salida));



                //    $rs = Doo::db()->query($sql, array($from, $to, $fecha_salida));




                $salida = $rs->fetchAll();

                $rs = Doo::db()->find("Areas", array("select" => "nombre",
                    "where" => "id = ?",
                    "param" => array($from),
                    "limit" => 1));
                $from_name = $rs->nombre;

                if ($tipo_ticket == "roundtrip") {
                    $rs = Doo::db()->query($sql, array($to, $from, $fecha_retorno));
                    $retorno = $rs->fetchAll();
                    $rs = Doo::db()->find("Areas", array("select" => "nombre",
                        "where" => "id = ?",
                        "param" => array($to),
                        "limit" => 1));
                    $to_name = $rs->nombre;
                }
                if ($tipo_ticket == "oneway") {
                    $rs = Doo::db()->query($sql, array($to, $from, $fecha_retorno));
                    $retorno = $rs->fetchAll();
                    $rs = Doo::db()->find("Areas", array("select" => "nombre",
                        "where" => "id = ?",
                        "param" => array($to),
                        "limit" => 1));
                    $to_name = $rs->nombre;
                }


                $this->data['rootUrl'] = Doo::conf()->APP_URL;
                $this->data['from_name'] = $from_name;
                $this->data['to_name'] = $to_name;

                $this->data['areas'] = Doo::db()->find("Areas", array("select" => "id, nombre", "asArray" => true));


                /* /////////////////////////////////////////////////////// */

                $fecha_ini = date("M-d-Y");
                $hora = date("H:i:s");


                $booking = $_SESSION['booking'];

                $login = $_SESSION['user'];

                if ($booking["tipo_ticket"] === "oneway") {
                    if ($from_name === "ORLANDO") {
                        if ($booking['exten'] == "Disney Resort" && isset($booking['actuali'])) {
                            $booking['trip_departure'] = date("H:i", strtotime("00:00") + strtotime($booking['trip_departure']) - strtotime("00:45"));
                        }
                        if ($booking['exten'] == "Universal Resort Area" && isset($booking['actuali'])) {
                            $booking['trip_departure'] = date("H:i", strtotime("00:00") + strtotime($booking['trip_departure']) - strtotime("00:30"));
                        }
                        if ($booking['exten'] == "International Drive Area" && isset($booking['actuali'])) {
                            $booking['trip_departure'] = date("H:i", strtotime("00:00") + strtotime($booking['trip_departure']) - strtotime("00:30"));
                        }
                    }
                }

                if ($booking["tipo_ticket"] == "roundtrip") {

                    if ($to_name == "ORLANDO") {

                        if ($booking['exten1'] == "Disney Resort" && isset($booking['actuali'])) {

                            $booking['trip_departure2'] = date("H:i", strtotime("00:00") + strtotime($booking['trip_departure2']) - strtotime("00:45"));
                        }


                        if ($booking['exten1'] == "Universal Resort Area" && isset($booking['actuali'])) {

                            $booking['trip_departure2'] = date("H:i", strtotime("00:00") + strtotime($booking['trip_departure2']) - strtotime("00:30"));
                        }
                        if ($booking['exten1'] == "International Drive Area" && isset($booking['actuali'])) {

                            $booking['trip_departure2'] = date("H:i", strtotime("00:00") + strtotime($booking['trip_departure2']) - strtotime("00:30"));
                        }
                    }

                    if ($from_name == "ORLANDO") {

                        if ($booking['exten'] == "Disney Resort" && isset($booking['actuali'])) {

                            $booking['trip_departure'] = date("H:i", strtotime("00:00") + strtotime($booking['trip_departure']) - strtotime("00:45"));
                        }


                        if ($booking['exten'] == "Universal Resort Area" && isset($booking['actuali'])) {

                            $booking['trip_departure'] = date("H:i", strtotime("00:00") + strtotime($booking['trip_departure']) - strtotime("00:30"));
                        }
                        if ($booking['exten'] == "International Drive Area" && isset($booking['actuali'])) {

                            $booking['trip_departure'] = date("H:i", strtotime("00:00") + strtotime($booking['trip_departure']) - strtotime("00:30"));
                        }
                    }
                }



                if ($booking["tipo_ticket"] == "oneway") {
                    $booking['fecha_retorno'] = "N/A";
                    $booking['pickup2'] = "N/A";
                    $booking['dropoff2'] = "N/A";
                    $booking['trip_no2'] = "N/A";
                    $pax2 = "N/A";
                    ///////////////////////////////////
                    if (isset($_SESSION['user']) && isset($booking['pricer'])) {
                        $login = $_SESSION['user'];
                        if ($booking['resident'] == 1) {
                            $booking['totaladul'] = $booking['priceadult'] * ($booking['pax']);
                            $booking['totaladul'] = number_format($booking['totaladul'], 2, '.', '');
                            $booking['precioadul'] = ( $booking['priceadult'] );
                            $booking['precioadul'] = number_format($booking['precioadul'], 2, '.', '');
                            $booking['preciochil'] = ( $booking['pricechil']);
                            $booking['preciochil'] = number_format($booking['preciochil'], 2, '.', '');
                            $booking['totalchil'] = $booking['pricechil'] * ($booking['chil']);
                            $booking['totalchil'] = number_format($booking['totalchil'], 2, '.', '');
                            $booking['pricexten'] = ($booking['precio_e1'] + $booking['precio_e2'] + $booking['precio_e3'] + $booking['precio_e4']);
                            $booking['pricexten'] = number_format($booking['pricexten'], 2, '.', '');
                            $paxtotal = $booking['chil'] + $booking['pax'];
                            $booking['totalexten'] = ($booking['precio_e1'] + $booking['precio_e2'] + $booking['precio_e3'] + $booking['precio_e4']) * $paxtotal;
                            $booking['totalexten'] = number_format($booking['totalexten'], 2, '.', '');
                            $booking['totaltotal'] = $booking['totaladul'] + $booking['totalchil'] + $booking['totalexten'];
                            $booking['totaltotal'] = number_format($booking['totaltotal'], 2, '.', '');
                            $booking['residente'] = "Florida Residents Rate Express Service";
                            $booking['ticke'] = "One Way Trip";
                        } else {


                            $booking['totaladul'] = $booking['price'] * ($booking['pax']);
                            $booking['totaladul'] = number_format($booking['totaladul'], 2, '.', '');

                            $booking['precioadul'] = ( $booking['price'] );
                            $booking['precioadul'] = number_format($booking['precioadul'], 2, '.', '');

                            $booking['preciochil'] = ( $booking['pricer']);
                            $booking['preciochil'] = number_format($booking['preciochil'], 2, '.', '');


                            $booking['totalchil'] = $booking['pricer'] * ($booking['chil']);
                            $booking['totalchil'] = number_format($booking['totalchil'], 2, '.', '');

                            $booking['pricexten'] = ($booking['precio_e1'] + $booking['precio_e2'] + $booking['precio_e3'] + $booking['precio_e4']);
                            $booking['pricexten'] = number_format($booking['pricexten'], 2, '.', '');
                            $paxtotal = $booking['chil'] + $booking['pax'];

                            $booking['totalexten'] = ($booking['precio_e1'] + $booking['precio_e2'] + $booking['precio_e3'] + $booking['precio_e4']) * $paxtotal;
                            $booking['totalexten'] = number_format($booking['totalexten'], 2, '.', '');

                            $booking['totaltotal'] = $booking['totaladul'] + $booking['totalchil'] + $booking['totalexten'];
                            $booking['totaltotal'] = number_format($booking['totaltotal'], 2, '.', '');
                            $booking['residente'] = "Regular Ticket Rate Express Service";
                            $booking['ticke'] = "One Way Trip";
                        }
                    }
                    if ($booking['chil'] == 0) {
                        $booking['preciochil'] = 0.00;
                        $booking['preciochil'] = number_format($booking['preciochil'], 2, '.', '');
                    }
                    ////////////////////
                    $fee = $booking['totaltotal'] * 0.05;

                    $comision_agency = (!$net_rate) ? ($booking['totaltotal'] * (($this->cal_equipament($booking['trip_no'])) / 100)) : 0.00;
                    $booking = array(
                        "tipo_ticket" => $booking['tipo_ticket'],
                        "fecha_ini" => $fecha_ini,
                        "fromt" => $booking['fromt'],
                        "tot" => $booking['tot'],
                        "fecha_salida" => $booking['fecha_salida'],
                        "fecha_retorno" => $booking['fecha_retorno'],
                        "pax" => $booking['pax'],
                        "pax2" => $pax2,
                        "exten" => $booking['exten'],
                        "to_name" => $this->data['to_name'],
                        "from_name" => $this->data['from_name'],
                        "totaladul" => $booking['totaladul'],
                        "precioadul" => $booking['precioadul'],
                        "pricechil" => $booking['pricechil'],
                        "preciochil" => $booking['preciochil'],
                        "totalchil" => $booking['totalchil'],
                        "pricexten" => $booking['pricexten'],
                        "totalexten" => $booking['totalexten'],
                        "totaltotal" => $booking['totaltotal'] + $fee,
                        "fee" => $fee,
                        "comision_agency" => $comision_agency,
                        "balance" => $booking['totaltotal'] - $comision_agency,
                        "resident" => $booking['resident'],
                        "residente" => $booking['residente'],
                        "ticke" => $booking['ticke'],
                        "priceadult" => $booking['priceadult'],
                        "price" => $booking['price'],
                        "trip_no" => $booking['trip_no'],
                        "pickup1" => $booking['pickup1'],
                        "dropoff1" => $booking['dropoff1'],
                        "id_clientes" => $login->id,
                        "pickup2" => $booking['pickup2'],
                        "dropoff2" => $booking['dropoff2'],
                        "trip_no2" => $booking['trip_no2'],
                        "price2" => $booking['price2'],
                        "pricechil" => $booking['pricechil'],
                        "codconf" => $codconf,
                        "hora" => $hora,
                        "pricer" => $booking['pricer'],
                        "extension1" => $booking['extension1'],
                        "extension3" => $booking['extension3'],
                        "extension2" => $booking['extension2'],
                        "extension4" => $booking['extension4'],
                        "precio_e1" => $booking['precio_e1'],
                        "precio_e2" => $booking['precio_e2'],
                        "precio_e3" => $booking['precio_e3'],
                        "precio_e4" => $booking['precio_e4'],
                        "trip_arrival" => $booking['trip_arrival'],
                        "trip_departure" => $booking['trip_departure'],
                        "trip_arrival2" => $booking['trip_arrival2'],
                        "trip_departure2" => $booking['trip_departure2'],
                        "place1" => $booking['place1'],
                        "address1" => $booking['address1'],
                        "chil" => $booking['chil'],
                        "hotelarea1" => $booking['hotelarea1'],
                        "hotelarea2" => $booking['hotelarea2'],
                        "zip" => $booking['zip'],
                        "hotelarea1" => $booking['hotelarea1'],
                        "hotelarea2" => $booking['hotelarea2'],
                        "hotelarea3" => $booking['hotelarea3'],
                        "hotelarea4" => $booking['hotelarea4'],
                        "dateT" => $booking['dateT'],
                        "dateT1" => $booking['dateT1'],
                        "dateT2" => $booking['dateT2']
                    );


                    $_SESSION["booking"] = $booking;


                    $booking = $_SESSION['booking'];
                } else {

                    if (isset($_SESSION['user'])) {
                        $login = $_SESSION['user'];

                        if ($booking['resident'] == 1) {

                            $booking['totaladul'] = ($booking['priceadult'] + $booking['2priceadult'] ) * ($booking['pax'] );
                            $booking['totaladul'] = number_format($booking['totaladul'], 2, '.', '');

                            $booking['precioadul'] = ( $booking['priceadult'] + $booking['2priceadult']);
                            $booking['precioadul'] = number_format($booking['precioadul'], 2, '.', '');

                            $booking['preciochil'] = ( $booking['pricechil'] + $booking['2pricechil']);
                            $booking['preciochil'] = number_format($booking['preciochil'], 2, '.', '');


                            $booking['totalchil'] = ($booking['pricechil'] + $booking['2pricechil']) * ($booking['chil']);
                            $booking['totalchil'] = number_format($booking['totalchil'], 2, '.', '');

                            $booking['pricexten'] = ($booking['precio_e1'] + $booking['precio_e2'] + $booking['precio_e3'] + $booking['precio_e4']);
                            $booking['pricexten'] = number_format($booking['pricexten'], 2, '.', '');
                            $paxtotal = $booking['chil'] + $booking['pax'];

                            $booking['totalexten'] = ($booking['precio_e1'] + $booking['precio_e2'] + $booking['precio_e3'] + $booking['precio_e4']) * $paxtotal;
                            $booking['totalexten'] = number_format($booking['totalexten'], 2, '.', '');

                            $booking['totaltotal'] = $booking['totaladul'] + $booking['totalchil'] + $booking['totalexten'];
                            $booking['totaltotal'] = number_format($booking['totaltotal'], 2, '.', '');
                            $booking['residente'] = "Florida Residents Rate Express Service";
                            $booking['ticke'] = "Round Trip";
                        } else {

                          $booking['totaladul'] = ($booking['price'] + $booking['2price']) * ($booking['pax']);
                            $booking['totaladul'] = number_format($booking['totaladul'], 2, '.', '');

                            $booking['precioadul'] = ( $booking['price'] + $booking['2price']);
                            $booking['precioadul'] = number_format($booking['precioadul'], 2, '.', '');

                            $booking['preciochil'] = ( $booking['pricer'] + $booking['2pricer']);
                            $booking['preciochil'] = number_format($booking['preciochil'], 2, '.', '');


                            $booking['totalchil'] = ($booking['pricer'] + $booking['2pricer']) * ($booking['chil']);
                            $booking['totalchil'] = number_format($booking['totalchil'], 2, '.', '');

                            $booking['pricexten'] = ($booking['precio_e1'] + $booking['precio_e2'] + $booking['precio_e3'] + $booking['precio_e4']);
                            $booking['pricexten'] = number_format($booking['pricexten'], 2, '.', '');
                            $paxtotal = $booking['chil'] + $booking['pax'];

                            $booking['totalexten'] = ($booking['precio_e1'] + $booking['precio_e2'] + $booking['precio_e3'] + $booking['precio_e4']) * $paxtotal;
                            $booking['totalexten'] = number_format($booking['totalexten'], 2, '.', '');

                            $booking['totaltotal'] = $booking['totaladul'] + $booking['totalchil'] + $booking['totalexten'];
                            $booking['totaltotal'] = number_format($booking['totaltotal'], 2, '.', '');
                            $booking['residente'] = "Regular Ticket Rate Express Service";
                            $booking['ticke'] = "Round Trip";
                        }
                    }

                    if ($booking['chil'] == 0) {
                        $booking['preciochil'] = 0.00;
                        $booking['preciochil'] = number_format($booking['preciochil'], 2, '.', '');
                    }
                    $comision_agency = (!$net_rate) ? ($booking['totaltotal'] * (($this->cal_equipament($booking['trip_no']) + $this->cal_equipament($booking['trip_no2'])) / 100)) / 2 : 0.00;
                    $fee = $booking['totaltotal'] * 0.05;
                    $booking = array(
                        "tipo_ticket" => $booking['tipo_ticket'],
                        "fecha_ini" => $fecha_ini,
                        "fromt" => $booking['fromt'],
                        "tot" => $booking['tot'],
                        "fecha_salida" => $booking['fecha_salida'],
                        "fecha_retorno" => $booking['fecha_retorno'],
                        "pax" => $booking['pax'],
                        "exten" => $booking['exten'],
                        "exten1" => $booking['exten1'],
                        "to_name" => $this->data['to_name'],
                        "from_name" => $this->data['from_name'],
                        "pax2" => $booking['pax'],
                        "resident" => $booking['resident'],
                        "totaladul" => $booking['totaladul'],
                        "precioadul" => $booking['precioadul'],
                        "pricechil" => $booking['pricechil'],
                        "preciochil" => $booking['preciochil'],
                        "2pricechil" => $booking['2pricechil'],
                        "totalchil" => $booking['totalchil'],
                        "pricexten" => $booking['pricexten'],
                        "totalexten" => $booking['totalexten'],
                        "totaltotal" => $booking['totaltotal'] + $fee,
                        "fee" => $fee,
                        "comision_agency" => $comision_agency,
                        "balance" => $booking['totaltotal'] - $comision_agency,
                        "resident" => $booking['resident'],
                        "residente" => $booking['residente'],
                        "ticke" => $booking['ticke'],
                        "price" => $booking['price'],
                        "2price" => $booking['2price'],
                        "trip_no" => $booking['trip_no'],
                        "pickup1" => $booking['pickup1'],
                        "dropoff1" => $booking['dropoff1'],
                        "priceadult" => $booking['priceadult'],
                        "2priceadult" => $booking['2priceadult'],
                        "id_clientes" => $login->id,
                        "pickup2" => $booking['pickup2'],
                        "dropoff2" => $booking['dropoff2'],
                        "trip_no2" => $booking['trip_no2'],
                        "price2" => $booking['price2'],
                        "codconf" => $codconf,
                        "hora" => $hora,
                        "pricer" => $booking['pricer'],
                        "2pricer" => $booking['2pricer'],
                        "extension1" => $booking['extension1'],
                        "extension3" => $booking['extension3'],
                        "extension2" => $booking['extension2'],
                        "extension4" => $booking['extension4'],
                        "precio_e1" => $booking['precio_e1'],
                        "precio_e2" => $booking['precio_e2'],
                        "precio_e3" => $booking['precio_e3'],
                        "precio_e4" => $booking['precio_e4'],
                        "trip_arrival" => $booking['trip_arrival'],
                        "trip_departure" => $booking['trip_departure'],
                        "trip_arrival2" => $booking['trip_arrival2'],
                        "trip_departure2" => $booking['trip_departure2'],
                        "place2" => $booking['place2'],
                        "place1" => $booking['place1'],
                        "address1" => $booking['address1'],
                        "address2" => $booking['address2'],
                        "chil" => $booking['chil'],
                        "hotelarea1" => $booking['hotelarea1'],
                        "hotelarea2" => $booking['hotelarea2'],
                        "zip" => $booking['zip'],
                        "hotelarea1" => $booking['hotelarea1'],
                        "hotelarea2" => $booking['hotelarea2'],
                        "hotelarea3" => $booking['hotelarea3'],
                        "hotelarea4" => $booking['hotelarea4'],
                        "dateT" => $booking['dateT'],
                        "dateT1" => $booking['dateT1'],
                        "dateT2" => $booking['dateT2']
                    );

                    $_SESSION["booking"] = $booking;


                    $booking = $_SESSION['booking'];
                }
                if (!isset($_SESSION['data_agency'])) {
                    #cotizacion
                    try {

                        $contenido .= '<pre>' . print_r($_SESSION, true) . '</pre>';

                        $contenido .= "<span style='color:red;'>Cotizacion Transportation </span>";
                        $mail = new PHPMailer();
                        $mail->IsSMTP();
                        $correo_emisor = "henry@supertours.com";
                        $nombre_emisor = "SuperTours";
                        $contrasena = "Henry123";
                        //$mail->SMTPDebug  = 2;
                        $mail->SMTPAuth = true;
                        //$mail->SMTPSecure = "tsl";
                        $mail->SMTPSecure = "ssl";
                        $mail->Host = "smtpout.secureserver.net";
                        $mail->Port = 465;
                        $mail->Username = $correo_emisor;
                        $mail->Password = $contrasena;
                        //$mail->AddReplyTo($correo_emisor, $nombre_emisor);
                        $mail->SetFrom("no_reply@supertours.com", $nombre_emisor);
                        $mail->Subject = 'SuperTours, Reserva de multi day -' . date("d-m-Y h:i:s");
                        $mail->AltBody = 'SuperTours, Reserva de multi day -' . date("d-m-Y h:i:s");
                        //$mail->AddAddress("prodownloadall@gmail.com");
			            $mail->AddAddress("arturo@supertours.com");
			            //$mail->AddBCC("arbusmad2021@gmail.com");
//                        $mail->AddAddress("websales@supertours.com");
                        //$mail->Attachment(Doo::conf()->APP_URL . "global/files/carpetita.pdf", "carpetita.pdf");
                        $mail->MsgHTML($contenido);
                        $mail->Send();
                    } catch (phpmailerException $e) {
                        echo $e->errorMessage(); // Errores de PhpMailer
                    } catch (Exception $e) {
                        echo $e->getMessage(); // Errores de cualquier otra cosa.
                    }
                    #fin de cotizacion
                    $this->renderc('invitado', $this->data, true);
                } else {
                    if ($dat->type_rate == 0) {
                        $_SESSION['agency_fee'] = $booking['comision_agency'];
                    }
                    Doo::loadController("AgenciaController");
                    $agenControl = new AgenciaController();
                    $disponible = $agenControl->iscredit();
                    $this->data['disponible'] = $disponible;
                    $this->renderc('shoproute_agency', $this->data, true);
                }
            } else {
                return Doo::conf()->APP_URL . "booking/pickup-dropoff";
            }
        } else {
            return Doo::conf()->APP_URL . "booking/pickup-dropoff/autentication";
        }
    }

    public function signup() {

        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['signup'] = $signup;
        $this->data['state'] = Doo::db()->find("State", array("select name from State", "asArray" => true));
        $this->data['country'] = Doo::db()->find("Country", array("select name from Country", "asArray" => true));

        //print_r($signup);
        //die;
        $this->renderc('pruesignup', $this->data);
    }

    public function guest() {
      $this->data['rootUrl'] = Doo::conf()->APP_URL;
      // echo '<pre>';
      // print_r($_SESSION);
      // echo '</pre>';
      // die;
      // $booking = $_SESSION['booking'];
      //$this->data['datosUsuario'] = $this->cargarGuest();
      // var_dump($_SESSION['booking']);
      // die;
      // $this->renderc('gest', $this->data);

      $this->renderc('guest2', $this->data);

  }
    // public function guest() {
    //     $this->data['rootUrl'] = Doo::conf()->APP_URL;
    //     //$booking = $_SESSION('booking');
    //     $this->data['datosUsuario'] = $this->cargarGuest();

    //     $this->renderc('gest', $this->data);
    // }

    public function cargarGuest() {
        $email = $_POST['email'];
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $celphone = $_POST['cellphone'];
        $sql = "INSERT INTO clientes (
                                      id,
                                      username,
                                      firstname,
                                      lastname,
                                      PASSWORD,
                                      phone,
                                      celphone,
                                      city,
                                      state,
                                      country,
                                      address,
                                      zip,
                                      tipo_client,
                                      birthday,
                                      fecha_r,
                                      points,
                                      left_points,
                                      paid_points
                                    )VALUES (
                                    '',
                                    '$email',
                                    '$firstname',
                                    '$lastname',
                                    '',
                                    '$celphone',
                                    '$celphone',
                                    '',
                                    '',
                                    '',
                                    '',
                                    '',
                                    '',
                                    '',
                                    '',
                                    '',
                                    '',
                                    ''
                                    )";
        Doo::db()->query($sql);

        $u = $this->db()->find('Clientes', array('where' => 'username = ? and firstname = ?',
            'limit' => 1,
            'select' => 'id,username,firstname,lastname,state,address,zip,tipo_client,city,country,phone',
            'param' => array($email, $firstname)
                )
        );
        Doo::loadModel("Signup");
        $login = new Signup();
        $login->username = $email;
        $login->firstname = $firstname;
        $login->lastname = $lastname;
        $login->state = 'OTHER';
        $login->address = '';
        $login->zip = 000000;
        $login->tipo_client = '';
        $login->city = '';
        $login->country = '';
        $login->phone = $celphone;
        $login->celphone = $celphone;
        $login->id = $u->id;
        return $login;
    }

    public function save() {

        Doo::loadModel("Signup");
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $signup = new Signup($_POST);
//        echo '<pre>';
//        print_r($signup);
//        echo '<pre>';
//        die;
        $signup->password = trim($signup->password);
        $signup->fecha_r = date("m-d-Y  H:i:s");
        
        
        $sql = "SELECT DISTINCT username, id, phone, `password`, city, state, country, address, zip FROM clientes WHERE  username = ? AND `password` != '' ORDER BY id DESC LIMIT 0,1";
        //Registered user
        $signup2 = new stdclass();
        $signup2->username = $signup->username;
        $signup2->firstname = $signup->firstname;
        $signup2->lastname = $signup->lastname;

        //Billing address
        $signup2->address = $signup->address;
        $signup2->city = $signup->city;
        $signup2->zip = $signup->zip;
        $signup2->phone = $signup->phone;
        $signup2->celphone = $signup->celphone;
        
        


        $signup2->error = "";

        // $_SESSION['signup2'] = $signup2;


        $rs = Doo::db()->query($sql, array($signup->username));
        $reci = $rs->fetch();
        //print_r($reci);
        //die;
        if ($reci != NUll) {

            return Doo::conf()->APP_URL . "booking/pickup-dropoff/autentication/signup/slope";
        } else {

            unset($_SESSION['signup2']);
            unset($_SESSION['infoforms']);
            unset($_SESSION ['toursinvi']);


            $new = false;
            if ($signup->birthday != "") {

                $signup->tipo_client = 1;
            } else {
                $signup->tipo_client = 0;
            }
            if ($_POST['id'] == "") {
                $signup->id = Null;
                $new = true;
            }

            $this->data['rootUrl'] = Doo::conf()->APP_URL;

            if ($new) {
                Doo::db()->insert($signup);


                if (isset($_POST['username']) && isset($_POST['firstname'])) {


                    if ($signup->tipo_client == 1) {



                        try {
                            Doo::loadController('DatosMailController');
                            $datosMail = new DatosMailController();
                            $mail = new PHPMailer(true);
                            $mail = $datosMail->datos();
                            //La direccion a donde mandamos el correo
                            $nombre_destino = 'SuperTours';
                            $mail->AddAddress($signup->username, $nombre_destino);
                            //De parte de quien es el correo
                            $mail->Subject = 'Signup / SuperTours';
                            //Mensaje alternativo en caso que el destinatario no pueda abrir correos HTML
                            $mail->AltBody = 'Signup / SuperTours';

                            $mail->MsgHTML("<div align='center'>
<br />
<table   id='clearTable'>
     <tr>
       <td width='401' height='33' rowspan='2' id='titletd3'><img src='".$this->data['rootUrl']."global/estilos/logo.png' width='316' height='88' /></td>
       <td colspan='3' align='center' id='titletd3'>Supertours.com</td>
     </tr>
     <tr>
       <td height='35' colspan='3' id='titletd4'>&nbsp;</td>
    </tr>
     <tr>
       <td align='center' height='33' colspan='4' id='titletd2'>SUPER CLUB</td>
     </tr>
     <tr>


       <td colspan='2' align='center' id='titletd6'>Welcome, " . $_POST['username'] . " you are a member of the SUPERCLUB <br />
         The incentive program for frequent passengers <br />
       of SUPER TOURS.</td>
    </tr>


  <tr>
    <td colspan='4' ><table id='tableorder3' width='90%'>
      <tr>
        <td  height='35' colspan='3' id='titlett3'  aling='center' >RECEIPT</td>
        </tr>
      <tr>
        <td width='34%' height='28'>MEMBER NAME:</td>
        <td colspan='2'>" . $_POST['firstname'] . " " . $_POST['lastname'] . "</td>
      </tr>
      <tr>
        <td height='31'>MEMBER SINCE:</td>
        <td colspan='2'>JUN. 12-2012 / 13:32</td>
      </tr>
      <tr>
        <td height='27'>USERNAME:</td>
        <td colspan='2'>" . $_POST['username'] . "</td>
      </tr>
      <tr>
        <td height='27'>PASSWORD:</td>
        <td>" . $signup->password . "</td>
      </tr>
      <tr>
        <td height='27'>&nbsp;</td>
        <td colspan='2'>&nbsp;</td>
      </tr>
    </table>
    <p><br />
  </p></td>
  </tr>
  <tr>
    <td height='37' colspan='4' align='center' id='titletd' ><strong>REDWARS</strong></td>
  </tr>

  </tr>
  <tr>
    <td colspan='4'> From this moment you are an official member of our company and you will receive the following benefits:
</td>
  <tr>
    <td colspan='4'>&bull;  A FREE ticket, after 10 trips paid</td>
  </tr>
  <tr>
    <td colspan='4'>&bull;  A free ticket on your birthday week (you will get this benefit after having traveled for at least one year with us)</td>
  </tr>
  <tr>
    <td colspan='4'>&bull;  Exclusive offers for members of SUPER CLUB </td>
  </tr>
  <tr>
    <td colspan='4'>&nbsp;</td>
  </tr>
  <tr>
    <td colspan='4'>&nbsp;</td>
  </tr>
  <tr>
    <td colspan='4' align='center'> <p align='center' class='titulopago'>THANK YOU FOR CHOOSING US <br />
      SUPER TOURS.<br />
      Phone: (407) 370-3001 Orlando / (305) 677-2676 Miami / e-mail: reservations@supertours.com

</p>       </td>
  </tr>
  </table>



</div>");
                            $mail->Send();
                            // echo "Mensaje enviado. Que chivo va vos!!";
                        } catch (phpmailerException $e) {
                            echo $e->errorMessage(); //Errores de PhpMailer
                        } catch (Exception $e) {
                            echo $e->getMessage(); //Errores de cualquier otra cosa.
                        }
                    } else {
                        try {
                            Doo::loadController('DatosMailController');
                            $datosMail = new DatosMailController();
                            $mai2 = new PHPMailer(true);
                            $mai2 = $datosMail->datos();
                            $nombre_destino = 'Admin';
                            //La direccion a donde mandamos el correo
                            $mai2->AddAddress($signup->username, $nombre_destino);
                            //Asunto del correo
                            $mai2->Subject = 'Signup / SuperTours';
                            //Mensaje alternativo en caso que el destinatario no pueda abrir correos HTML
                            $mai2->AltBody = 'Signup / SuperTours';


                            $mai2->MsgHTML("<div align='center'>
<br />
<table   id='clearTable'>
     <tr>
       <td width='401' height='33' rowspan='2' id='titletd3'><img src='".$this->data['rootUrl']."global/estilos/logo.png' width='316' height='88' /></td>
       <td colspan='3' align='center' id='titletd3'>Supertours.com</td>
     </tr>
     <tr>
       <td height='35' colspan='3' id='titletd4'>&nbsp;</td>
    </tr>
     <tr>
       <td align='center' height='33' colspan='4' id='titletd2'>&nbsp;</td>
     </tr>
     <tr>


       <td colspan='2' align='center' id='titletd6'>Welcome, " . $_POST['username'] . "</td>
    </tr>


  <tr>
    <td colspan='4' ><table id='tableorder3' width='90%'>
      <tr>
        <td  height='35' colspan='3' id='titlett3'  aling='center' >RECEIPT</td>
        </tr>
      <tr>
        <td width='34%' height='28'>MEMBER NAME:</td>
        <td colspan='2'>" . $_POST['firstname'] . " " . $_POST['lastname'] . "</td>
      </tr>
      <tr>
        <td height='31'>MEMBER SINCE:</td>
        <td colspan='2'>JUN. 12-2021 / 13:32</td>
      </tr>
      <tr>
        <td height='27'>USERNAME:</td>
        <td colspan='2'>" . $_POST['username'] . "</td>
      </tr>
      <tr>
        <td height='27'>PASSWORD:</td>
        <td>" . $signup->password . "</td>
      </tr>
      <tr>
        <td height='27'>&nbsp;</td>
        <td colspan='2'>&nbsp;</td>
      </tr>
    </table>
    <p><br />
  </p></td>
  </tr>
  <tr>
    <td colspan='4'>&nbsp;</td>
  </tr>
  <tr>
    <td colspan='4'>&nbsp;</td>
  </tr>
  <tr>
    <td colspan='4' align='center'> <p align='center' class='titulopago'>THANK YOU FOR CHOOSING US <br />
      SUPER TOURS.<br />
      Phone: (407) 370-3001 Orlando / (305) 677-2676 Miami / e-mail: reservations@supertours.com

</p>       </td>
  </tr>
  </table>



</div>");
                            $mai2->Send();
                            // echo "Mensaje enviado. Que chivo va vos!!";
                        } catch (phpmailerException $e) {
                            echo $e->errorMessage(); //Errores de PhpMailer
                        } catch (Exception $e) {
                            echo $e->getMessage(); //Errores de cualquier otra cosa.
                        }
                    }
                    $login = new stdclass();
                    $login->username = $signup->username;
                    $login->firstname = $signup->firstname;
                    $login->lastname = $signup->lastname;
//                    $login->state = $signup->state;
//                    $login->address = $signup->address;
                    $login->tipo_client = $signup->tipo_client;
                    $login->zip = $signup->zip;
                    $login->phone = $signup->phone;
                    $login->celphone = $signup->celphone;
                    $login->address = $signup->address;
                    $login->state = $signup->state;
                    $login->city = $signup->city;
                    $login->country = $signup->country;
                    $login->id = Doo::db()->lastInsertId();
                    $_SESSION['user'] = $login;

                    return Doo::conf()->APP_URL . "booking/pickup-dropoff/autentication/shopuser";
                }
            } else {
                Doo::db()->update($signup);
            }
        }
        return Doo::conf()->APP_URL . "booking/pickup-dropoff/autentication/signup";
    }

    /* FUNCION DE LOGUEO */

    public function logueo() {

        if(isset($_SESSION["booking"])){
            $booking = $_SESSION["booking"];
            $modalT = $this->naveganteDescaradoT();
            print($modalT);
        }
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        Doo::loadModel("Agency");
        if (isset($_SESSION['data_agency'])) {
            $dat = new Agency($_SESSION['data_agency']);
            $net_rate = ($dat->type_rate == 1) ? true : false;

            $dat2 = new Agency();
            $dat2->id = $dat->id;
            $dato_exten_n = Doo::db()->getOne($dat2);
            if ($dato_exten_n->precio_especial_exten == 1) {
                $precio_sql = "precio_especial as precio";
            } else if ($net_rate) {
                $precio_sql = "precio_neto as precio";
            } else {
                $precio_sql = "precio";
            }
        } else {
            $dat = new Agency();
            $net_rate = false;
            $dat->type_rate = 0;
            $precio_sql = "precio";
        }

        if (isset($_POST["pickup1"]) && isset($_POST["dropoff1"])) {
            $booking = $_SESSION['booking'];

            if (isset($_POST["pickup2"]) && isset($_POST["dropoff2"]) && isset($booking['price2']) && isset($booking["trip_departure2"])) {
                $pickup2 = $_POST["pickup2"];
                $dropoff2 = $_POST["dropoff2"];
                $trip_no2 = $booking['trip_no2'];
                $price2 = $booking['price2'];
                $trip_departure2 = $booking["trip_departure2"];
            } else {
                $trip_departure2 = "N/A";
                $pickup2 = "N/A";
                $dropoff2 = "N/A";
                $trip_no2 = "N/A";
                $price2 = "N/A";
            }

            /* ----- DATOS VIAJE DE IDA------------------------ */
            if (isset($_POST['pickup1']) || isset($_POST['dropoff1'])) {
                ///* PICKUP 01 *///
                list($mes1, $dia1, $anyo1) = explode('-', $booking["fecha_salida"]);
                $fechaSalida = $anyo1 . '-' . $mes1 . '-' . $dia1;
                $values = explode(',', $_POST['pickup1']);
                $pickup1 = $values[0]; //Puede ser el id de un pickup o de una extension
                $valid = $values[1];
                //$numero == $values[2];
                $type = isset($values[3]) ? $values[3] : 'P';

                if ($type == 'P') { //es un pickup
                    $sql = "SELECT place,address FROM pickup_dropoff WHERE id = ?";
                    $pre1 = Doo::db()->query($sql, array($pickup1));
                    if ($pre1 != NULL) {
                        $p = $pre1->fetch();

                        if (isset($p['place']) && isset($p['address'])) {
                            $pick1 = trim($p['place']) . ", " . trim($p['address']);
                        } else {
                            $pick1 = '';
                        }
                    } else {
                        $pick1 = '';
                    }
                    $exten = "";
                    $extension1 = NULL;
                    $precio_e1 = 0;
                } else {//es una extension

                    $sql = "SELECT id,place, address," . $precio_sql . ",valid
						FROM extension
						WHERE id = ? and valid = ?";
                    $pre1 = Doo::db()->query($sql, array($pickup1, $valid));
                    if ($pre1 != NULL) {
                        $e = $pre1->fetch();

                        if (isset($e['precio']) && isset($e['place'])) {
                            $exten = trim($e['place']);
                            $extension1 = $pickup1;//Consulta cambia precio .
                                $consultaPrecio = "SELECT * FROM routes WHERE trip_from = ".$booking['fromt']." and trip_to = ".$booking['tot']." and trip_no = ".$booking['trip_no']." and fecha_ini = '".$fechaSalida."'";
                                $sqlResp= Doo::db()->query($consultaPrecio);
                                $sqlRespt1= $sqlResp->fetchAll();

                                foreach ($sqlRespt1 as $extpt1):
                                    $valor1 = $extpt1['univext'];
                                    $valor2 = $extpt1['wdext'];
                                endforeach;
//                                echo 'uuuuuuu'.$fechaSalida;
                            if($pickup1==11 || $pickup1 == 12){//por id ext
                                $precio_e1 = $valor1;
                            }else if($pickup1==13){
                                $precio_e1 = $valor2;
                            }
//                            $precio_e1 = $e['precio']; ***********************
                        } else {
                            $exten = "";
                            $extension1 = NULL;
                            $precio_e1 = 0;
                        }
                    } else {
                        $exten = "";
                    }
                    $pick1 = $exten;
                    $pickup1 = 'N/A';
                }

                ///* DROPOFF 01 *///
                $values = explode(',', $_POST['dropoff1']);
                $dropoff1 = $values[0]; //Puede ser el id de un pickup o de una extension
                $valid = $values[1];

                //$numero == $values[2];
                $type = isset($values[3]) ? $values[3] : 'P';
                if ($type == 'P') { //es un pickup
                    $sql = "SELECT place, address FROM pickup_dropoff WHERE id = ?";
                    $drop1 = Doo::db()->query($sql, array($dropoff1));
                    if ($drop1 != NUll) {
                        $d = $drop1->fetch();
                        if (isset($d['place']) && isset($d['address'])) {
                            $drop1 = trim($d['place']) . ", " . trim($d['address']);
                        } else {
                            $drop1 = "";
                        }
                    } else {
                        $drop1 = "";
                    }
                    $exten = "";
                    $extension2 = NULL;
                    $precio_e2 = 0;
                } else {//es una extension
                    $sql = "SELECT id,place, address," . $precio_sql . ",valid
							FROM extension
							WHERE id = ? and valid = ?";
                    $pre2 = Doo::db()->query($sql, array($dropoff1, $valid));
                    if ($pre2 != NULL) {
                        $e = $pre2->fetch();
                        if (isset($e['precio']) && isset($e['place'])) {
                            if ($e['valid'] == 1) {
                                $exten = trim($e['place']);
                            } else {
                                $exten = "";
                            }
                            $extension2 = $dropoff1;//Consulta cambia precio.
                                $consultaPrecio = "SELECT * FROM routes WHERE trip_from = ".$booking['fromt']." and trip_to = ".$booking['tot']." and trip_no = ".$booking['trip_no']." and fecha_ini = '".$fechaSalida."'";
                                $sqlResp= Doo::db()->query($consultaPrecio);
                                $sqlRespt1= $sqlResp->fetchAll();
                                foreach ($sqlRespt1 as $extpt1):
                                    $valor1 = $extpt1['univext'];
                                    $valor2 = $extpt1['wdext'];
                                endforeach;
//                                echo 'uuuuuuu'.$extpt1['univext'];
                            if($dropoff1==11 || $dropoff1 == 12){//por id ext
                                $precio_e2 = $valor1;
                            }else if($dropoff1==13){
                                $precio_e2 = $valor2;
                            }
//                            $precio_e3 = $e['precio']; //****************
                        } else {
                            $extension2 = NULL;
                            $precio_e2 = 0;
                        }
                    } else {
                        $exten = "";
                        $extension2 = NULL;
                        $precio_e2 = 0;
                    }
                    $drop1 = $exten;
                    $dropoff1 = 'N/A';
                }
            } else {
                $exten = "";
                $extension1 = NULL;
                $extension2 = NULL;
                $precio_e1 = 0;
                $precio_e2 = 0;
            }
            /* ----- FIN: DATOS VIAJE DE IDA------------------------ */


            /* ----- DATOS VIAJE DE RETORNO------------------------ */
            if (isset($_POST['dropoff2']) || isset($_POST['pickup2'])) {
                ///* PICKUP 02 *///
                list($mes1, $dia1, $anyo1) = explode('-', $booking["fecha_retorno"]);
                $fechaRetorno = $anyo1 . '-' . $mes1 . '-' . $dia1;
                $values = explode(',', $_POST['pickup2']);
                $pickup2 = $values[0]; //Puede ser el id de un pickup o de una extension
                $valid = $values[1];
                //$numero == $values[2];
                $type = isset($values[3]) ? $values[3] : 'P';

                if ($type == 'P') {//es un pickup
                    $sql = "SELECT place,address FROM pickup_dropoff WHERE id = ?";
                    $pick2 = Doo::db()->query($sql, array($_POST['pickup2']));
                    if ($pick2 != NUll) {
                        $p2 = $pick2->fetch();
                        if (isset($p2['place']) && isset($p2['address'])) {
                            $pick2 = trim($p2['place']) . ", " . trim($p2['address']);
                        } else {
                            $pick2 = "";
                        }
                    } else {
                        $pick2 = "";
                    }
                    $exten1 = "";
                    $extension3 = NULL;
                    $precio_e3 = 0;
                } else {//es una extension
                    $sql = "SELECT id,place, address," . $precio_sql . ",valid
							FROM extension
							WHERE id = ? and valid = ?";
                    $pre1 = Doo::db()->query($sql, array($values[0], $values[1]));
                    if ($pre1 != NUll) {
                        $e = $pre1->fetch();
                        if (isset($e['precio']) && isset($e['place'])) {
                            if ($e['valid'] == 1) {
                                $exten1 = trim($e['place']);
                            } else {
                                $exten1 = "";
                            }
                            $extension3 = $pickup2;//Consulta cambia precio.
                                $consultaPrecio = "SELECT * FROM routes WHERE trip_from = ".$booking['tot']." and trip_to = ".$booking['fromt']." and trip_no = ".$booking['trip_no2']." and fecha_ini = '".$fechaRetorno."'";
                                $sqlResp= Doo::db()->query($consultaPrecio);
                                $sqlRespt1= $sqlResp->fetchAll();
                                foreach ($sqlRespt1 as $extpt1):
                                    $valor1 = $extpt1['univext'];
                                    $valor2 = $extpt1['wdext'];
                                endforeach;
                            if($pickup2==11 || $pickup2 == 12){//por id ext
                                $precio_e3 = $valor1;
                            }else if($pickup2==13){
                                $precio_e3 = $valor2;
                            }
//                            $precio_e2 = $e['precio'];//****************
                        } else {
                            $exten1 = "";
                            $extension3 = NULL;
                            $precio_e3 = 0;
                        }
                    } else {
                        $exten1 = "";
                        $extension3 = NULL;
                        $precio_e3 = 0;
                    }
                    $pick2 = $exten1;
                    $pickup2 = 'N/A';
                }

                ///* DROPOFF 02 *///
                $values = explode(',', $_POST['dropoff2']);
                $dropoff2 = $values[0]; //Puede ser el id de un pickup o de una extension
                $valid = $values[1];
                //$numero == $values[2];
                $type = isset($values[3]) ? $values[3] : 'P';
                if ($type == 'P') {//es un pickup
                    $sql = "SELECT place, address FROM pickup_dropoff WHERE id = ?";
                    $drop2 = Doo::db()->query($sql, array($dropoff2));
                    if ($drop2 != NUll) {
                        $d2 = $drop2->fetch();
                        if (isset($d2['place']) && isset($d2['address'])) {

                            $drop2 = trim($d2['place']) . ", " . trim($d2['address']);
                        } else {

                            $drop2 = "";
                        }
                    } else {
                        $drop2 = "";
                    }
                    $exten1 = "";
                    $extension4 = NULL;
                    $precio_e4 = 0;
                } else {//es una extension
                    $sql = "SELECT id,place, address," . $precio_sql . ",valid
							FROM extension
							WHERE id = ? and valid = ?";
                    $pre2 = Doo::db()->query($sql, array($dropoff2, $valid));
                    if ($pre2 != NUll) {
                        $e = $pre2->fetch();
                        if (isset($e['precio']) && isset($e['place'])) {
                            if ($e['valid'] == 1) {
                                $exten1 = trim($e['place']);
                            } else {
                                $exten1 = "";
                            }
                            $extension4 = $dropoff2;//Consulta cambia precio.
                                $consultaPrecio = "SELECT * FROM routes WHERE trip_from = ".$booking['tot']." and trip_to = ".$booking['fromt']." and trip_no = ".$booking['trip_no2']." and fecha_ini = '".$fechaRetorno."'";
                                $sqlResp= Doo::db()->query($consultaPrecio);
                                $sqlRespt1= $sqlResp->fetchAll();
                                foreach ($sqlRespt1 as $extpt1):
                                    $valor1 = $extpt1['univext'];
                                    $valor2 = $extpt1['wdext'];
                                endforeach;
                            if($dropoff2==11 || $dropoff2 == 12){//por id ext
                                $precio_e4 = $valor1;
                            }else if($dropoff2==13){
                                $precio_e4 = $valor2;
                            }
//                            $precio_e4 = $e['precio'];//****************
                        } else {
                            $extension4 = NULL;
                            $precio_e4 = 0;
                        }
                    } else {
                        $exten1 = "";
                        $extension4 = $dropoff2;
                        $precio_e4 = $e['precio'];
                    }
                    $drop2 = $exten1;
                    $dropoff2 = 'N/A';
                }
            } else {
                $exten1 = "";
                $extension3 = NULL;
                $extension4 = NULL;
                $precio_e3 = 0;
                $precio_e4 = 0;
                $pick2 = '';
                $drop2 = '';
            }

            /* ---------------------------------------------- */
            if (isset($_POST['hotelarea1'])) {
                $hotelarea1 = trim($_POST['hotelarea1']);
            } else {
                $hotelarea1 = "";
            }
            if (isset($_POST['hotelarea2'])) {
                $hotelarea2 = trim($_POST['hotelarea2']);
            } else {
                $hotelarea2 = "";
            }
            if (isset($_POST['hotelarea3'])) {
                $hotelarea3 = trim($_POST['hotelarea3']);
            } else {
                $hotelarea3 = "";
            }
            if (isset($_POST['hotelarea4'])) {
                $hotelarea4 = trim($_POST['hotelarea4']);
            } else {
                $hotelarea4 = "";
            }
            if (isset($booking['2pricer'])) {
                $p2ricer = $booking['2pricer'];
            } else {
                $p2ricer = "";
            }
            if (isset($booking['2price'])) {
                $p2rice = $booking['2price'];
            } else {
                $p2rice = "";
            }
            if (isset($booking['2priceadult'])) {
                $p2riceadult = $booking['2priceadult'];
            } else {
                $p2riceadult = "";
            }
            if (isset($booking['2pricechil'])) {
                $p2ricechil = $booking['2pricechil'];
            } else {
                $p2ricechil = "";
            }

            /* ---------------------------------------------- */
            $booking['trip_arrival'] = $_SESSION['trip_arrival'];
            $booking['trip_departure'] = $_SESSION['trip_departure'];
            $booking['trip_arrival2'] = $_SESSION['trip_arrival2'];
            $booking['trip_departure2'] = $_SESSION['trip_departure2'];

            $datos = array(
                'precioAdult' => $_POST['precioAdult'],
                'precioChild' => $_POST['precioChild'],
                'precioAdult1' => $_POST['precioAdult1'],
                'precioChild1' => $_POST['precioChild1'],
            );
            //print_r($datos);
            $this->data['datosPrecios'] = $datos;
            $booking2 = array(
                "precioAdult" => $datos['precioAdult'],
                "precioChild" => $datos['precioChild'],
                "precioAdult1" => $datos['precioAdult1'],
                "precioChild1" => $datos['precioChild1'],
                "pricer" => $booking['pricer'],
                "2pricer" => $p2ricer,
                "exten" => $exten,
                "exten1" => $exten1,
                "actuali" => "vali",
                "tipo_ticket" => $booking['tipo_ticket'],
                "fromt" => $booking['fromt'],
                "tot" => $booking['tot'],
                "fecha_salida" => $booking['fecha_salida'],
                "fecha_retorno" => $booking['fecha_retorno'],
                "pax" => $booking['pax'],
                "trip_no" => $booking['trip_no'],
                "pickup1" => $pickup1,
                "dropoff1" => $dropoff1,
                "pickup2" => $pickup2,
                "dropoff2" => $dropoff2,
                "trip_no2" => $trip_no2,
                "price" => $booking['price'],
                "2price" => $p2rice,
                "price2" => $price2,
                "pricechil" => $booking['pricechil'],
                "2pricechil" => $p2ricechil,
                "priceadult" => $booking['priceadult'],
                "2priceadult" => $p2riceadult,
                "resident" => $booking['resident'],
                "extension1" => $extension1,
                "extension3" => $extension3,
                "extension2" => $extension2,
                "extension4" => $extension4,
                "precio_e1" => $precio_e1,
                "precio_e2" => $precio_e2,
                "precio_e3" => $precio_e3,
                "precio_e4" => $precio_e4,
                "trip_arrival" => $booking['trip_arrival'],
                "trip_departure" => $booking['trip_departure'],
                "trip_arrival2" => $booking['trip_arrival2'],
                "trip_departure2" => $booking['trip_departure2'],
                "place1" => $pick1,
                "address1" => $drop1,
                "place2" => $pick2,
                "address2" => $drop2,
                "chil" => $booking['chil'],
                "hotelarea1" => $hotelarea1,
                "hotelarea2" => $hotelarea2,
                "hotelarea3" => $hotelarea3,
                "hotelarea4" => $hotelarea4,
                "zip" => $booking['zip'],
                "idPrecioIda" => $booking['idPrecioIda'],
                "idPrecioVuelta" => $booking['idPrecioVuelta'],
                "iden" => $booking['iden'],
                "dateT" => $booking['dateT'],
                "dateT1" => $booking["dateT1"],
                "dateT2" => $booking["dateT2"],
                "trip1" => $booking["trip1"],
                "trip2" => $booking["trip2"],
            );


            $_SESSION["booking"] = $booking2;
                  unset($_SESSION['signup2']);
                  unset($_SESSION['infoforms']);
                  unset($_SESSION ['toursinvi']);
                  unset($_SESSION ['toursinvimulti']);

            if (isset($_SESSION["user"]) AND !isset($_SESSION['infoforms'])) {
                if (!isset($_SESSION['data_agency'])) {
                    return Doo::conf()->APP_URL . "booking/pickup-dropoff/autentication/shopuser";
                } else {

                    return Doo::conf()->APP_URL . "booking/pickup-dropoff/autentication/shopuser_agency";
                }
            } else {
                $this->view()->renderc('loginuser', $this->data);
            }
        } else {

            if (isset($_SESSION["user"]) AND !isset($_SESSION['signup2'])) {
                if (!isset($_SESSION['data_agency'])) {
                    return Doo::conf()->APP_URL . "booking/pickup-dropoff/autentication/shopuser";
                } else {
                    return Doo::conf()->APP_URL . "booking/pickup-dropoff/autentication/shopuser_agency";
                }
            } else {
                $this->view()->renderc('loginuser', $this->data);
            }
        }
    }

    public function maill() {
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->view()->renderc('correo', $this->data);
    }

    public function recover() {

$this->data['rootUrl'] = Doo::conf()->APP_URL;
        if (isset($_POST['email'])) {
            $pass = Doo::db()->query("SELECT password,firstname,lastname,username FROM clientes WHERE username = ?"
                    , array(trim($_POST['email'])));

            $email = trim($_POST['email']);
            $data = $pass->fetch();

            if (isset($data['password'])) {

                try {
                    Doo::loadController('DatosMailController');
                    $datosMail = new DatosMailController();
                    $mail = new PHPMailer(true);
                    $mail = $datosMail->datos();
                    //La direccion a donde mandamos el correo
                    $nombre_destino = 'Admin';
                    $mail->AddAddress($email, $nombre_destino);
                    //Asunto del correo
                    $mail->Subject = 'Recovery Password / SuperTours';
                    //Mensaje alternativo en caso que el destinatario no pueda abrir correos HTML
                    $mail->AltBody = 'Recovery Password';
                    //El cuerpo del mensaje, puede ser con etiquetas HTML
                    $mail->MsgHTML("<div align='center'>
<br />
<table   id='clearTable'>
     <tr>
       <td width='401' height='33' rowspan='2' id='titletd3'><img src='".$this->data['rootUrl']."global/estilos/logo.png' width='316' height='88' /></td>
       <td colspan='3' align='center' id='titletd3'>Supertours.com</td>
     </tr>
     <tr>
       <td height='35' colspan='3' id='titletd4'>&nbsp;</td>
    </tr>
     <tr>
       <td align='center' height='33' colspan='4' id='titletd2'>RECOVERY PASSWORD</td>
     </tr>



  <tr>
    <td colspan='4' ><table id='tableorder3' width='90%'>
      <tr>
        <td  height='35' colspan='3' id='titlett3'  aling='center' >RECEIPT</td>
        </tr>

      <tr>
        <td width='34%' height='27'>USERNAME:</td>
        <td colspan='2'>" . $email . "</td>
      </tr>
      <tr>
        <td height='27'>PASSWORD:</td>
        <td>" . $data['password'] . "</td>
      </tr>
      <tr>
        <td height='27'>&nbsp;</td>
        <td colspan='2'>&nbsp;</td>
      </tr>
    </table>
    <p><br />
  </p></td>
  </tr>
  <tr>
    <td colspan='4'>&nbsp;</td>
  </tr>
  <tr>
    <td colspan='4'>&nbsp;</td>
  </tr>
  <tr>
    <td colspan='4' align='center'> <p align='center' class='titulopago'>THANK YOU FOR CHOOSING US <br />
      SUPER TOURS.<br />
      Phone: (407) 370-3001 Orlando / (305) 677-2676 Miami / e-mail: reservations@supertours.com

</p>       </td>
  </tr>
  </table>



</div>");
                    //Archivos adjuntos
                    //$mail->AddAttachment('img/logo.jpg');      // Archivos Adjuntos
                    //Enviamos el correo
                    $mail->Send();
                    //
                } catch (phpmailerException $e) {
                    echo $e->errorMessage(); //Errores de PhpMailer
                } catch (Exception $e) {
                    echo $e->getMessage(); //Errores de cualquier otra cosa.
                }

                echo "Contrase&ntildea Enviada a " . $data['username'];
            } else {

                echo "El correo no Existe ";
            }
        }
    }

    public function puesto() {
        $sql = Doo::db()->query("SELECT priceAdult FROM preciotemporal WHERE id = '9'");
        //$result = Doo::db()->query($sql);
        $r = $sql->fetchAll();
        foreach ($r as $re) {
            echo $resul = $re['priceAdult'];
        }
    }

    public function pago() {
    header("Content-Type: text/html; charset=utf-8");
        //echo '<pre>';
        //print_r($_SESSION['user']->firstname);
       //echo '</pre>';
        //die;
        if(isset($_SESSION["booking"])){//Sin comentarios, Sorry
            $booking = $_SESSION["booking"];
            $modalT = $this->naveganteDescaradoT();
            print($modalT);
        }
        $pagoInvitado = $_POST['pagoInvitado'];
        echo $pagoInvitado;
        $pagoInvitadoResidente = $_POST['pagoInvitadoResidente'];
        //echo $pagoInvitadoResidente;
        if ($pagoInvitado == 0.00) {
            $pagoInvitado = $pagoInvitadoResidente;
        }
  //        $onewaypago = $_POST['onewaypago'];
//        if ($pagoInvitado == '') {
//            $pagoInvitado = $onewaypago;
//        } else {
//            $pagoInvitado = $_POST['pagoInvitado'];
//        }
//        $pagoInvitado = $onewaypago;
//        //echo $pagoInvitado;
//        echo'<br />' . $onewaypago;


        if (isset($_SESSION['booking']['codconf'])) {
            $this->data['rootUrl'] = Doo::conf()->APP_URL;


            if (isset($_REQUEST['opcion_pago'])) {
                $pago = $_REQUEST['opcion_pago'];
            } else {
                $pago = 2;
            }


            if (isset($_REQUEST['otheramount'])) {
                $otheramount = (is_numeric($_REQUEST['otheramount'])) ? $_REQUEST['otheramount'] : 0;
            } else {
                $otheramount = 0;
            }
            $_SESSION['booking']['otheramount'] = $otheramount;
            //Tipos de pagos
            Doo::loadController('admin/ReservasController');
            $reserveControl = new ReservasController();
            $op = $reserveControl->types_payments();

            $arval = array_values($op[$pago]);
            $arkey = array_keys($op[$pago]);

            $tipo = new stdclass();
            $tipo->tipo = "Credit Card";
            $tipo->pago = $arval[0];
            $tipo->otheram = $_SESSION['booking']['totaltotal'];
            $tipo->agencia = -1;
            $_SESSION['formaPago'] = $arval[0];
            $_SESSION['booking']['pago_pred'] = $_SESSION['booking']['totaltotal'];
            //echo "esto >>".$_SESSION['booking']['pago_pred'];


            if ($_SESSION['booking']['pago_pred'] == 0) {
                $_SESSION['booking']['pago_pred'] = $pagoInvitado; //$onewaypago;
                //echo $_SESSION['booking']['pago_pred'];
            } else {
                $_SESSION['booking']['pago_pred'] = $_SESSION['booking']['totaltotal'];
                //echo $_SESSION['booking']['pago_pred'];
            }
            if ($_SESSION['signup2']->guest == 1) {
	              try {
                $contenido = "";
                        Doo::loadController('DatosMailController');
                        $datosMail = new DatosMailController();
                        $mail = new PHPMailer(true);

                        $mail2 = $datosMail->datos();
                $contenido .= '<pre>' . print_r($_SESSION, true) . '</pre>';
                $contenido .= "<span style='color:red;'>Cotizacion Transportation con usuario true </span>";
                        $mail->Host = $mail2->Host;
                        $mail->From = $mail2->From;
                        $mail->FromName = "Super Tours";
                        $mail->Subject = "Arreglo del user (Invitado)".utf8_decode($_SESSION['signup2']->firstname)." ".utf8_decode($_SESSION['signup2']->lastname);
                        //$mail->AddAddress("prodownloadall@gmail.com");    //En este espacio debe ir un correo de respaldo.
		        $mail->AddCC("arturo@supertours.com");    //En este espacio debe ir un correo de respaldo.
		        //$mail->AddBCC("arbusmad2021@gmail.com");

               $mail->MsgHTML($contenido);
               $mail->Send();

                    } catch (phpmailerException $e) {
                        echo $e->errorMessage(); //Errores de PhpMailer
                    } catch (Exception $e) {
                        echo $e->getMessage(); //Errores de cualquier otra cosa.
                    }
              $this->view()->renderc('guestcard', $this->data);
              }else{
		$signup3 = new stdclass();

		  if (isset($_SESSION['booking']['firsname1'])) {
			$signup3->person1 = array("nombre1"=>$_SESSION['booking']['firsname1'],"apelli1"=>$_SESSION['booking']['lasname1'],"email1"=>$_SESSION['booking']['email']);
		  }
		  if (isset($_SESSION['booking']['firsname2'])) {
			$signup3->person2 = array("nombre2"=>$_SESSION['booking']['firsname2'],"apelli2"=>$_SESSION['booking']['lasname2']);
		  }
		   if (isset($_SESSION['booking']['firsname3'])) {
		  $signup3->person3 = array("nombre3"=> $_SESSION['booking']['firsname3'],"apelli3"=>$_SESSION['booking']['lasname3']);
		  }
		   if (isset($_SESSION['booking']['firsname4'])) {
		  $signup3->person4 = array("nombre4"=>$_SESSION['booking']['firsname4'],"apelli4"=>$_SESSION['booking']['lasname4']);
		  }
		   if (isset($_SESSION['booking']['firsname5'])) {
		  $signup3->person5 = array("nombre5"=>$_SESSION['booking']['firsname5'],"apelli5"=>$_SESSION['booking']['lasname5']);
		  }
		   if (isset($_SESSION['booking']['firsname6'])) {
		  $signup3->person6 = array("nombre6"=>$_SESSION['booking']['firsname6'],"apelli6"=>$_SESSION['booking']['lasname6']);
		  }
		   if (isset($_SESSION['booking']['firsname7'])) {
		  $signup3->person7 = array("nombre7"=>$_SESSION['booking']['firsname7'],"apelli7"=>$_SESSION['booking']['lasname7']);
		  }
		   if (isset($_SESSION['booking']['firsname8'])) {
		  $signup3->person8 = array("nombre8"=>$_SESSION['booking']['firsname8'],"apelli8"=>$_SESSION['booking']['lasname8']);
		  }

		if (isset($_SESSION['booking']['childName1'])) {
                    $signup3->child1 = array("nombre1"=>$_SESSION['booking']['childName1'],"apelli1"=>$_SESSION['booking']['childlast1'],"edad1"=>$_SESSION['booking']['edad1']);
                }
                if (isset($_SESSION['booking']['childName2'])) {
                    $signup3->child2 = array("nombre2"=>$_SESSION['booking']['childName2'],"apelli2"=>$_SESSION['booking']['childlast2'],"edad2"=>$_SESSION['booking']['edad2']);
                }
                if (isset($_SESSION['booking']['childName3'])) {
                    $signup3->child3 = array("nombre3"=> $_SESSION['booking']['childName3'],"apelli3"=>$_SESSION['booking']['childlast3'],"edad3"=>$_SESSION['booking']['edad3']);
                }
                if (isset($_SESSION['booking']['childName4'])) {
                    $signup3->child4 = array("nombre4"=>$_SESSION['booking']['childName4'],"apelli4"=>$_SESSION['booking']['childlast4'],"edad4"=>$_SESSION['booking']['edad4']);
                }
                if (isset($_SESSION['booking']['childName5'])) {
                    $signup3->child5 = array("nombre5"=>$_SESSION['booking']['childName5'],"apelli5"=>$_SESSION['booking']['childlast5'],"edad5"=>$_SESSION['booking']['edad5']);
                }
                if (isset($_SESSION['booking']['childName6'])) {
                    $signup3->child6 = array("nombre6"=>$_SESSION['booking']['childName6'],"apelli6"=>$_SESSION['booking']['childlast6'],"edad6"=>$_SESSION['booking']['edad6']);
                }
                if (isset($_SESSION['booking']['childName7'])) {
                    $signup3->child7 = array("nombre7"=>$_SESSION['booking']['childName7'],"apelli7"=>$_SESSION['booking']['childlast7'],"edad7"=>$_SESSION['booking']['edad7']);
                }
                if (isset($_SESSION['booking']['childName8'])) {
                    $signup3->child8 = array("nombre8"=>$_SESSION['booking']['childName8'],"apelli8"=>$_SESSION['booking']['childlast8'],"edad8"=>$_SESSION['booking']['edad8']);
                }
		$_SESSION['signup3'] = $signup3;

                // echo '<pre>';
                // print_r($signup2);
                // echo '</pre>'; die;


            try {
                $contenido = "";
                Doo::loadController('DatosMailController');
                $datosMail = new DatosMailController();
                $mail = new PHPMailer(true);
                $contenido .="";
                $mail2 = $datosMail->datos();
		$contenido .= '<pre>' . print_r($_SESSION, true) . '</pre>';
		$contenido .= "<span style='color:red;'>Cotizacion Transportation con usuario true </span>";
                $mail->Host = $mail2->Host;
                $mail->From = $mail2->From;
                $mail->FromName = "SuperTours";
                $mail->Subject = "Arreglo del user (Registrado)".utf8_decode($_SESSION['user']->firstname)." ".utf8_decode($_SESSION['user']->lastname);
                $mail->AddAddress("bustamante3@hotmail.com");    //En este espacio debe ir un correo de respaldo.
                $mail->AddCC("arturo@supertours.com");    //En este espacio debe ir un correo de respaldo.
                //$mail->AddBCC("arbusmad2021@gmail.com");
                $mail->MsgHTML($contenido);
                $mail->Send();

            } catch (phpmailerException $e) {
                echo $e->errorMessage(); //Errores de PhpMailer
            } catch (Exception $e) {
                echo $e->getMessage(); //Errores de cualquier otra cosa.
            }


				$this->view()->renderc('guestcard', $this->data);
                // $this->view()->renderc('pago', $this->data);
               // return Doo::conf()->APP_URL . "booking/pickup-dropoff/autentication/shopuser_inv";
              }

            #cotizacion '<h2>nombre: </h2> '.$firstname.' '.$lastname.

            #fin de cotizacion
        } else {
            return Doo::conf()->APP_URL . "";
        }
    }

    public function pagoAgency() {
        if (isset($_SESSION['booking'])) {
            //Tipos de pagos
            Doo::loadController('admin/ReservasController');
            $reserveControl = new ReservasController();
            $op = $reserveControl->types_payments();

            $this->tipoclient();
            //  if (isset($_SESSION['booking']['codconf'])) {
            if (isset($_SESSION['totalboking']))
                $_SESSION['booking']["totaltotal"] = $_SESSION['totalboking'];
            if (isset($_REQUEST['opcion_pago']))
                $pago = $_REQUEST['opcion_pago'];
            else
                $pago = 2;

            $login = $user = $_SESSION ['user'];
            if (isset($_REQUEST['opcion_pago_saldo']))
                $tipo_saldo = $_REQUEST['opcion_pago_saldo'];
            else
                $tipo_saldo = 1;
            if ($tipo_saldo == 2) {
                $opcion_saldo = 'BALANCE';
            } else {
                $opcion_saldo = 'FULL';
            }
            if (isset($_REQUEST['comentarios'])) {
                $_SESSION['booking']['comentarios'] = $_REQUEST['comentarios'];
            } else {
                $_SESSION['booking']['comentarios'] = "";
            }

            if (isset($_REQUEST['otheramount'])) {
                $otheramount = (is_numeric($_REQUEST['otheramount'])) ? $_REQUEST['otheramount'] : 0;
            } else {
                $otheramount = 0;
            }
            $_SESSION['booking']['otheramount'] = $otheramount;
            Doo::loadModel("Agency");
            $dat = new Agency($_SESSION['data_agency']);
            $total_neto = $_SESSION['booking']['totaltotal'];

            $total_reserva = $total_neto;
            if ($pago == '3') {//"Credit Card+ 4 % FEE
                $total_reserva = $total_reserva + ($total_reserva * 0.05);
            }
            $_SESSION['booking']['totaltotal'] = $total_reserva;
            if ($pago < "3") {
                $this->data['opcionPago'] = $pago;
                $total = $_SESSION['booking']["totaltotal"];
                if (isset($_SESSION['booking']['comision_agency'])) {
                    $valorComision = $_SESSION['booking']['comision_agency'];
                } else {
                    $valorComision = 0.00;
                }

                if ($pago == 1 || $tipo_saldo == 2) {
                    $pagovalor = $total - $valorComision;
                } else {
                    $pagovalor = $total;
                }
                $_SESSION['booking']['totaltotal'] = $pagovalor;

                if ($otheramount == 0) {
                    $_SESSION['booking']['pago_pred'] = $pagovalor;
                } else {
                    $_SESSION['booking']['pago_pred'] = $otheramount;
                }

                $arval = array_values($op[$pago]);
                $_SESSION['formaPago'] = $arval[0] . '-' . $opcion_saldo;

                $this->data['rootUrl'] = Doo::conf()->APP_URL;
                $this->view()->renderc('pago', $this->data);
            } else {
                //$_SESSION['booking']['firsname'] =
                //Tipo PAGO
                $arval = array_values($op[$pago]);
                $arkey = array_keys($op[$pago]);
                $tipo_pago = $arkey[0];
                $fpago = $arval[0];


                Doo::loadModel("Reserve");
                Doo::loadModel("Clientes");
                list ($mes, $dia, $anyo) = explode("-", $_SESSION['booking']['fecha_salida']);
                $fecha_salida = $anyo . "-" . $mes . "-" . $dia;
                if ($_SESSION['booking']['tipo_ticket'] == 'roundtrip') {
                    list ($mes2, $dia2, $anyo2) = explode("-", $_SESSION['booking']['fecha_retorno']);
                    $fecha_retorno = $anyo2 . "-" . $mes2 . "-" . $dia2;
                } else {
                    $fecha_retorno = 'N/A';
                }

                //Cargando Datos cliente
                $cliente = new Clientes();
                $cliente->username = $_POST['email'];
                $cliente = Doo::db()->find($cliente, array('limit' => 1));
                if (empty($cliente)) {
                    $cliente = new Clientes();
                    $cliente->username = $_POST['email'];
                    $cliente->firstname = $_POST['firstname'];
                    $cliente->lastname = $_POST['lastname'];
                    Doo::db()->insert($cliente) or die("Error Ingresando Datos de Cliente");
                    $id_cliente = Doo::db()->lastInsertId();
                    $cliente->id = $id_cliente;
                }
                //FIN carga datos
                $reserves = new Reserve();
                $reserves->id_tours = -1;
                $reserves->type_tour = '';
                $reserves->fecha_ini = date('Y-m-d');
                $reserves->trip_no = $_SESSION['booking']['trip_no'];
                $reserves->trip_no2 = $_SESSION['booking']['trip_no2'];
                $reserves->tipo_ticket = $_SESSION['booking']['tipo_ticket'];
                $reserves->fromt = $_SESSION['booking']['fromt'];
                $reserves->tot = $_SESSION['booking']['tot'];
                $reserves->fromt2 = $_SESSION['booking']['tot'];
                $reserves->tot2 = $_SESSION['booking']['fromt'];
                $reserves->firsname = $cliente->firstname;
                $reserves->lasname = $cliente->lastname;
                $reserves->email = $cliente->username;
                $reserves->deptime1 = $_SESSION['booking']['trip_departure'];
                $reserves->deptime2 = isset($_SESSION['booking']['trip_departure2']) ? $_SESSION['booking']['trip_departure2'] : '';
                $reserves->arrtime1 = $_SESSION['booking']['trip_arrival'];
                $reserves->arrtime2 = isset($_SESSION['booking']['trip_arrival2']) ? $_SESSION['booking']['trip_arrival2'] : '';
                $reserves->precioA = $_SESSION['booking']['precioadul'];
                $reserves->precioN = ($_SESSION['booking']['chil'] > 0) ? $total_neto - $_SESSION['booking']['totaladul'] : 0;
                $reserves->extension1 = $_SESSION['booking']['extension1'];
                $reserves->precio_e1 = $_SESSION['booking']['precio_e1'];
                $reserves->pickup_exten1 = $_SESSION['booking']['hotelarea1'];
                $reserves->extension2 = $_SESSION['booking']['extension2'];
                $reserves->precio_e2 = $_SESSION['booking']['precio_e2'];
                $reserves->pickup_exten2 = $_SESSION['booking']['hotelarea2'];
                $reserves->extension3 = $_SESSION['booking']['extension3'];

                $reserves->precio_e3 = $_SESSION['booking']['precio_e3'];
                $reserves->pickup_exten3 = $_SESSION['booking']['hotelarea3'];
                $reserves->extension4 = $_SESSION['booking']['extension4'];
                $reserves->precio_e4 = $_SESSION['booking']['precio_e4'];
                $reserves->pickup_exten4 = $_SESSION['booking']['hotelarea4'];
                $reserves->fecha_salida = $fecha_salida;
                $reserves->fecha_retorno = $fecha_retorno;
                $reserves->pax = $_SESSION['booking']['pax'];
                $reserves->pax2 = ($_SESSION['booking']['chil'] > 0) ? $_SESSION['booking']['chil'] : 0;
                $reserves->id_tours = -1;
                $reserves->id_clientes = $cliente->id;
                $reserves->pickup1 = $_SESSION['booking']['pickup1'];
                $reserves->dropoff1 = $_SESSION['booking']['dropoff1'];
                $reserves->pickup2 = $_SESSION['booking']['pickup2'];
                $reserves->dropoff2 = $_SESSION['booking']['dropoff2'];
                $reserves->tipo_pago = $tipo_pago;
                $reserves->pago = $fpago . '-' . $opcion_saldo;
                $reserves->totaltotal = $total_reserva;
                $reserves->otheramount = $otheramount;
                $reserves->extra_charge = 0;
                $reserves->total2 = $total_neto;
                $reserves->codconf = $_SESSION['booking']['codconf'];
                $reserves->hora = $_SESSION['booking']['hora'];
                $reserves->comments = $_SESSION['booking']['comentarios'];
                $reserves->resident = 0;
                $reserves->agen = $user->id;
                $reserves->tipo_client = $cliente->tipo_client;
                $reserves->reward_id = -1;
                $reserves->agency = $dat->id;
                $reserves->luggage1 = -1;
                $reserves->luggage2 = -1;
                $reserves->canal = 'WEBSALE';
                $reserves->estado = 'CONFIRMED';
                $reserves->estado = 'CONFIRMED';
                $reserves->tarifa_one = $_SESSION['booking']['idPrecioIda'];
                $reserves->tarifa_round = $_SESSION['booking']['idPrecioVuelta'];
                $reserves->id1 = $_SESSION['booking']['idPrecioIda'];
                $reserves->id2= $_SESSION['booking']['idPrecioVuelta'];
                $this->data['rootUrl'] = Doo::conf()->APP_URL;
                if (Doo::db()->insert($reserves)) {
                    $id_reserva = Doo::db()->lastInsertId();
                    Doo::loadController('admin/ReservasController');
                    $reseControl = new ReservasController();
                    $reserves->id = $id_reserva;
                    $login = $_SESSION['user'];
                    $login->tipo = 'AGENCY';
                    $reseControl->registrar_pago($reserves, NULL, $login);
                    $reseControl->rastro_reserva('CREATE', NULL, $reserves, $login);
                    if ($pago == 5) {
                        // Actualizamos el credio
                        $creditos = Doo::db()->find("Acredito", array("where" => "id_agency_account = ? and disponible > 0", "param" => array($dat->id), "limit" => 1));
                        if (!empty($creditos)) {
                            $creditos->disponible = ($creditos->disponible - $_SESSION['booking']["totaltotal"]);
                            if (!Doo::db()->update($creditos)) {
                                $this->view()->renderc('decline', $this->data);
                            }
                        }
                    }


                    Doo::loadModel("Reservas_Agency");
                    $reserves_a = new Reservas_Agency();
                    $reserves_a->id_reservas = $id_reserva;
                    $reserves_a->id_agencia = $dat->id;
                    $reserves_a->id_client = $cliente->id;
                    $reserves_a->type_client = $cliente->tipo_client;
                    $reserves_a->id_useragency = $user->id;
                    $reserves_a->paid_type = $tipo_pago;
                    $reserves_a->metodo_paid = $fpago . '-' . $opcion_saldo;
                    if ($dat->type_rate == 1) {
                        $reserves_a->comision = 0;
                    } else {
                        $reserves_a->comision = ($this->cal_equipament($reserves->trip_no) + $this->cal_equipament($reserves->trip_no2)) / 2;
                    }
                    $reserves_a->agency_fee = $total_neto * $reserves_a->comision / 100;
                    $reserves_a->paper_voucher = 0;
                    if ($tipo_saldo == 2 && $pago != 5) {
                        $total_pagado = $total_reserva - ($total_neto * $reserves_a->comision / 100);
                    } else {
                        $total_pagado = $total_reserva;
                    }
                    $reserves_a->otheramount = $otheramount;
                    $reserves_a->paid_net = $total_neto;
                    $reserves_a->paid_full = $total_pagado;

                    Doo::db()->insert($reserves_a);


                    $codconf = array(
                        "codconf" => $_SESSION['booking']['codconf']
                    );

                    $_SESSION['code'] = $codconf;
                    $this->emailReserveUserAgency($reserves);
                    $this->view()->renderc('approval', $this->data);
                } else {
                    $this->view()->renderc('decline', $this->data);
                }
            }
        } else {
            return Doo::conf()->APP_URL . "agency/";
        }
    }

    public function cal_equipament($trip) {
        Doo::loadModel("Trips");
        $trip1 = ($trip == "EXPRESS MINIBUS") ? "EXPRESS SERVICES" : $trip;
        $tripss = Doo::db()->find("Trips", array("select" => "equipment", "where" => "trip_no = ?", "param" => array($trip1), "limit" => 1));
        if (empty($tripss)) {
            $age_comis = array();
        } else {
            Doo::loadModel("Agencomi");
            $age_comis = Doo::db()->find("Agencomi", array("where" => "service = ?", "param" => array($tripss->equipment), "limit" => 1));
        }
        if (!empty($age_comis))
            return $age_comis->comision;
        else
            return 0;
    }

    public function prue() {
        $this->data['rootUrl'] = Doo::conf()->APP_URL;

        $this->view()->renderc('index11', $this->data);
    }

    public function isAuth() {

        if (isset($_SESSION["login"])) {
            return true;
        } else {
            return false;
        }
    }

    public function loginuser() {
        $modalT = $this->modalTripPuesto();
        print($modalT);
        if (isset($_POST['usuario']) && isset($_POST['password'])) {

            if (!empty($_POST['usuario']) && !empty($_POST['password'])) {

                $user = trim($_POST['usuario']);
                $pass = trim($_POST['password']);

                $datos = array(
                    'precioAdult' => $_POST['precioAdult'],
                    'precioChild' => $_POST['precioChild'],
                    'precioAdult1' => $_POST['precioAdult1'],
                    'precioChild1' => $_POST['precioChild1']
                );


                //$pass  = trim($_POST['password']);
                $u = $this->db()->find('Clientes', array('where' => 'username = ? and password = ?',
                    'limit' => 1,
                    'select' => 'id,username,firstname,lastname,state,address,zip,tipo_client,city,country,phone,celphone',
                    'param' => array($user, $pass)
                        )
                );

                $this->data['rootUrl'] = Doo::conf()->APP_URL;
                // print_r($_SESSION);
                // die;
                if ($u == Null AND !isset($_SESSION['Signup2'])) { // o $u == false
                    $this->data['error'] = "Acceso denegado";
                    //return Doo::conf()->APP_URL."admin";
                    $this->renderc('loginuser', $this->data);
                } else {
                  unset($_SESSION['signup2']);
                  unset($_SESSION['infoforms']);
                  unset($_SESSION ['toursinvi']);
                  unset($_SESSION ['toursinvimulti']);

                  // unset($_SESSION['signup3']);
                    $precios = new stdClass();
                    $precios->precioAdult = $datos['precioAdult'];
                    $precios->precioChild = $datos['precioChild'];
                    $precios->precioAdult1 = $datos['precioAdult1'];
                    $precios->precioChild1 = $datos['precioChild1'];
                    $login = new stdclass ();
                    $login->precioAdult = $datos['precioAdult'];
                    $login->precioChild = $datos['precioChild'];
                    $login->precioAdult1 = $datos['precioAdult1'];
                    $login->precioChild1 = $datos['precioChild1'];
                    $login->username = $u->username;
                    $login->username2 = $u->username;
                    $login->firstname = $u->firstname;
                    $login->lastname = $u->lastname;
                    $login->state = $u->state;
                    $login->address = $u->address;
                    $login->zip = $u->zip;
                    $login->tipo_client = $u->tipo_client;
                    $login->city = $u->city;
                    $login->country = $u->country;
                    $login->phone = $u->phone;
                    $login->celphone = $u->celphone;
                    $login->id = $u->id;

                    $_SESSION['user'] = $login;
                    $_SESSION['precio'] = $precios;
                    //$this->home();
                    $auth = $this->isAuth();

                    return Doo::conf()->APP_URL . "booking/pickup-dropoff/autentication/shopuser";
                }
            }
        } else {
            return Doo::conf()->APP_URL . "";
        }
    }
    public function logout() {
      unset($_SESSION['user']);
      session_destroy();
      return Doo::conf()->APP_URL . "";
  }
    // public function logout() {
    //     unset($_SESSION['user']);

    //     return Doo::conf()->APP_URL . "";
    // }

    public function pais() {
        $from = $this->params["country"];

        if ($from != "UNITED%20STATES") {

            echo '<option value="OTHER" >OTHER</option>';
        }

        if ($from == "UNITED%20STATES") {
            echo '<option value="ODER"></option>';
            $sql = "SELECT  name  FROM state";

            $rs = Doo::db()->query($sql);

            $states = $rs->fetchAll();

            foreach ($states as $e) {
                echo '<option value="' . $e['name'] . '" ' . ($e["name"] == trim("FLORIDA") ? 'selected' : '') . ' >' . $e['name'] . '</option>';
            }
        }
    }

    public function Myreservas() {
        $this->data['rootUrl'] = Doo::conf()->APP_URL;



        if (isset($_SESSION['user'])) {
            $login = $_SESSION['user'];

            if (isset($_SESSION["booking"])) {
                $booking = $_SESSION["booking"];
                $tipo_ticket = $booking["tipo_ticket"];
                $from = $booking["fromt"];
                $to = $booking["tot"];


                $rs = Doo::db()->find("Areas", array("select" => "nombre",
                    "where" => "id = ?",
                    "param" => array($from),
                    "limit" => 1));
                $from_name = $rs->nombre;

                if ($tipo_ticket == "roundtrip") {


                    $rs = Doo::db()->find("Areas", array("select" => "nombre",
                        "where" => "id = ?",
                        "param" => array($to),
                        "limit" => 1));
                    $to_name = $rs->nombre;
                }
                if ($tipo_ticket == "oneway") {

                    $rs = Doo::db()->find("Areas", array("select" => "nombre",
                        "where" => "id = ?",
                        "param" => array($to),
                        "limit" => 1));
                    $to_name = $rs->nombre;
                }

                $rs = Doo::db()->query("select r.id,codconf,fecha_ini,hora,tipo_ticket,fecha_salida,fecha_retorno,pax,pax2,firsname,lasname,totaltotal,
                                ar.nombre as de , ob.nombre as para,ot.phone as phone

									from reservas r
									left join areas ar on (r.fromt = ar.id)
									left join areas ob on (r.tot =  ob.id)
									left join clientes ot on (r.id_clientes =  ot.id)

                                where id_clientes = ? ", array($login->id));

                $myr = $rs->fetchAll();

                $this->data['rootUrl'] = Doo::conf()->APP_URL;
                $this->data['myr'] = $myr;
                $this->data['from_name'] = $from_name;
                $this->data['to_name'] = $to_name;
                $this->data['areas'] = Doo::db()->find("Areas", array("select" => "id, nombre", "asArray" => true));


                $this->view()->renderc('reservations', $this->data);
            }
        } else {
            return Doo::conf()->APP_URL . "";
        }
    }
    
//    public function proccess() {
//        
//         
//        
//    require_once('stripe-php/init.php');
//        
//
//        //require_once('../protected/viewc/page/fixed/onboard.php');
//
//
//        $payment_id = $statusMsg = ''; 
//        $ordStatus = 'error';
//
//        //Clave Secreta
//        //Test
//        \Stripe\Stripe::setApiKey('sk_test_51IVLS2FtNeZxSwSYyvbtqdM137MwOgqmEFzyigCczKsuu3gx20Lryyk34V9nH4NI7TG7QV1W16BoSEYsDn0kPd7500oXY0lvQM'); 
//
//               
//        //Clave Secreta
//        //Production
//        
//        //\Stripe\Stripe::setApiKey('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'); 
//        
//        
//        
//        //check if token exist to proceed with payment
//
//        $token = $_POST['stripeToken'];
//        $total  = $_POST['ssl_amount'];
//        $email = $_POST['ssl_email'];
//        //$email2 = $_POST['stripeEmail2'];
//        $passengers_name = $_POST['passengers_name'];        
//        $ssl_first_name = $_POST['ssl_first_name'];
//        $ssl_last_name = $_POST['ssl_last_name'];        
//        $name = $_POST['cardholder_name'];
//        $phone = $_POST['ssl_phone'];
//        $country = $_POST['ssl_country'];
//        $state = $_POST['ssl_state'];
//        $city = $_POST['ssl_city'];
//        $zip_code = $_POST['ssl_avs_zip'];
//        $address = $_POST['ssl_avs_address'];
//        $ssl_usuario = $_POST['ssl_usuario'];
//        //$postal_code = $_POST['inputZC'];
//        $cardholder_name = ucwords($name);
//        
//        //$phone = $_POST['phone'];
//        $cod_conf = $_POST['ssl_invoice_number'];
//        //$description = $_POST['ssl_description'];
//        //$aprobado = $_POST['ssl_receipt_apprvl_get_url'];
//        //$declinado = $_POST['ssl_receipt_decl_get_url'];
//        //$salida = $_POST['salida'];
//        //$home = $_POST['home'];
//        $back = $_POST['back'];
//        //echo $back;
//
//
//        try {
//        //crear email cliente
////        $customer = \Stripe\Customer::create([
////          'email' => $email,
////          'name' => $cardholder_name,
////          'source' => $token,
////        ]);
//        
//            $customer = \Stripe\Customer::create(
//                array(
//                      'email' => $email,
//                      'name' => $cardholder_name,
//                      'source' => $token,
//                )
//            );
//
//            // Crear cargo de Stripe
//            $charge = \Stripe\Charge::create(
//                array(
//                    'customer' => $customer->id,
//                    'amount' => $total*100,
//                    'currency' => 'usd', // Cambiar el tipo de moneda
//                    'description' => 'Paid Online Reservation # '.$cod_conf,      
//                )   
//            );
//
//
//            // Retrieve charge details 
//            $chargeJson = $charge->jsonSerialize(); 
//            $customerJson = $customer->jsonSerialize();
//
//            //echo '<pre>';
//           // print_r($chargeJson);
//            //echo '<pre>';
//            
//            $mailc = $customerJson['email'];
//            $cardhn = $customerJson['name'];
//
//
//            // Check whether the charge is successful 
//            if($chargeJson['amount_refunded'] == 0 && empty($chargeJson['failure_code']) && $chargeJson['paid'] == 1 && $chargeJson['captured'] == 1){ 
//                // Transaction details  
//                $transactionID = $chargeJson['balance_transaction']; 
//                $paidAmount = $chargeJson['amount']; 
//                $paidAmount = ($paidAmount/100); 
//                $paidCurrency = $chargeJson['currency']; 
//                $payment_status = $chargeJson['status'];
//                $fecha = $chargeJson[ 'created' ];
//                $funding = $chargeJson[ 'source' ]['funding'];
//                $brand = $chargeJson[ 'source' ]['brand'];
//                $last4 = $chargeJson[ 'source' ]['last4'];
//
//
//            }    
//
//            if($charge->status=="succeeded"){
//
//                $ordStatus = "success"; 
//                $statusMsg = "Your Payment has been Successful!"; 
//                //$payment_id = 1;
//
//                //echo "Your Payment has been Successful!"; 
//
//                //echo "salida".$salida;
//                //echo "*****";
//                //echo "home".$home;
//                //echo "*****";
//                //echo "back".$back;
//
//                //echo "";
//                //echo "PRESENT!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!";
//                //echo $transactionID;
//
//
//                // Insert tansaction data into the database 
//                $date = date('Y-m-d H:m:s',$fecha);  
//                //echo $date;
//
//                Doo::db()->query("INSERT INTO pagos_online(txn_id,created,tipo_tarjeta,brand,last4,paid_amount,paid_amount_currency,payment_status,status_msg,cod_conf,cardholder_name,passenger_name,email) VALUES('$transactionID','$date','$funding','$brand','$last4','$paidAmount','$paidCurrency','$payment_status','$statusMsg','$cod_conf','$cardholder_name','$passengers_name','$email');");
//
//                $cargoJson ='{"transactionID":"'.$transactionID.'","code_confirmation":"'.$cod_conf.'","paidAmount":"'.$paidAmount.'","paidCurrency":"'.$paidCurrency.'","payment_status":"'.$payment_status.'","created":"'.$date.'","funding":"'.$funding.'","brand":"'.$brand.'","last4":"'.$last4.'","mailc":"'.$mailc.'","cardhn":"'.$cardhn.'"}';
//                $clienteJson = '{"ssl_usuario":"'.$ssl_usuario.'","ssl_first_name":"'.$ssl_first_name.'","ssl_last_name":"'.$ssl_last_name.'","ssl_phone":"'.$phone.'","ssl_country":"'.$country.'","ssl_state":"'.$state.'","ssl_city":"'.$city.'","ssl_zip_code":"'.$zip_code.'","ssl_passengers_name":"'.$passengers_name.'","ssl_email":"'.$email.'","ssl_avs_address":"'.$address.'"}';
//
//                //echo $cargoJson;
//
//                //return $back;
//                //echo $data['rootUrl'];
//
//                //return $back."/booking2/pickup-dropoff/autentication/reserva/load/$cargoJson/$clienteJson";
//
//                return $data['rootUrl']."booking2/pickup-dropoff/autentication/reserva/load/$cargoJson/$clienteJson";
//
//                //echo
//                //return Doo::conf()->APP_URL . "booking2/pickup-dropoff/autentication/reserva/load/$cargoJson/$clienteJson";
//                //return Doo::conf()->APP_URL . "booking/pickup-dropoff/autentication/reserva/load";
//                        
//                                                
//            }else{
//
//                //echo "Your Payment has Failed!";
//                $statusMsg = "Your Payment has Failed!"; 
//                echo $statusMsg;
//
//                //$payment_id = '';
//
//
//                //return Doo::conf()->APP_URL . "booking/pickup-dropoff/autentication/";
//                //return Doo::conf()->APP_URL . "transaction/decline";
//
//                return $data['rootUrl']."booking/pickup-dropoff/autentication";
//
//            }
//
//        }catch(Exception $e){
//                echo "<script>alert('".$e->getMessage()."');</script>";
//                //echo "Problems";
//                //return Doo::conf()->APP_URL . "transaction/decline";
//        }          
//        
//        
//    }

    public function proceso() {
        
        
        require_once('stripe-php/init.php');
        

        //require_once('../protected/viewc/page/fixed/onboard.php');


        $payment_id = $statusMsg = ''; 
        $ordStatus = 'error';

        //Clave Secreta Produccion
        
        //\Stripe\Stripe::setApiKey('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'); 
        
        //agosto 28 de 2021
        
        \Stripe\Stripe::setApiKey('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');
        
        
        //agosto 16 2021
        
        //\Stripe\Stripe::setApiKey('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'); 
        
        //Test
        //\Stripe\Stripe::setApiKey('sk_test_51IVLS2FtNeZxSwSYyvbtqdM137MwOgqmEFzyigCczKsuu3gx20Lryyk34V9nH4NI7TG7QV1W16BoSEYsDn0kPd7500oXY0lvQM'); 

        
        //check if token exist to proceed with payment

        $token = $_POST['stripeToken'];
        $total  = $_POST['ssl_amount'];
        $email = $_POST['ssl_email'];
        //$email2 = $_POST['stripeEmail2'];
        $passengers_name = $_POST['passengers_name'];
        $ssl_first_name = $_POST['ssl_first_name'];
        $ssl_last_name = $_POST['ssl_last_name'];        
        $name = $_POST['cardholder_name'];
        $phone = $_POST['ssl_phone'];
        $country = $_POST['ssl_country'];
        $state = $_POST['ssl_state'];
        $city = $_POST['ssl_city'];
        $zip_code = $_POST['ssl_avs_zip'];
        $address = $_POST['ssl_avs_address'];
        $ssl_usuario = $_POST['ssl_usuario'];
        //$arreglo = $_POST['booking_arr'];
        //$postal_code = $_POST['inputZC'];
        $cardholder_name = ucwords($name);
        
        //$phone = $_POST['phone'];
        $cod_conf = $_POST['ssl_invoice_number'];
        //$description = $_POST['ssl_description'];
        //$aprobado = $_POST['ssl_receipt_apprvl_get_url'];
        //$declinado = $_POST['ssl_receipt_decl_get_url'];
        //$salida = $_POST['salida'];
        //$home = $_POST['home'];
        $back = $_POST['back'];
        //echo $back;


        try {
        //crear email cliente
//        $customer = \Stripe\Customer::create([
//          'email' => $email,
//          'name' => $cardholder_name,
//          'source' => $token,
//        ]);
        
        $customer = \Stripe\Customer::create(
            array(
                  'email' => $email,
                  'name' => $cardholder_name,
                  'source' => $token,
            )
        );

        // Crear cargo de Stripe
        $charge = \Stripe\Charge::create(
            array(
                'customer' => $customer->id,
                'amount' => $total*100,
                'currency' => 'usd', // Cambiar el tipo de moneda
                'description' => 'Paid Online Reservation # '.$cod_conf,      
            )   
        );


            // Retrieve charge details 
            $chargeJson = $charge->jsonSerialize(); 
            $customerJson = $customer->jsonSerialize();

            //echo '<pre>';
           // print_r($chargeJson);
            //echo '<pre>';
            
            $mailc = $customerJson['email'];
            $cardhn = $customerJson['name'];


            // Check whether the charge is successful 
            if($chargeJson['amount_refunded'] == 0 && empty($chargeJson['failure_code']) && $chargeJson['paid'] == 1 && $chargeJson['captured'] == 1){ 
                // Transaction details  
                $transactionID = $chargeJson['balance_transaction']; 
                $paidAmount = $chargeJson['amount']; 
                $paidAmount = ($paidAmount/100); 
                $paidCurrency = $chargeJson['currency']; 
                $payment_status = $chargeJson['status'];
                $fecha = $chargeJson[ 'created' ];
                $funding = $chargeJson[ 'source' ]['funding'];
                $brand = $chargeJson[ 'source' ]['brand'];
                $last4 = $chargeJson[ 'source' ]['last4'];


            }
            
            
            

                if($charge->status=="succeeded"){

                        $ordStatus = "success"; 
                        $statusMsg = "Your Payment has been Successful!"; 
                        //$payment_id = 1;
                        
                        //echo "Your Payment has been Successful!"; 
                        
                        //echo "salida".$salida;
                        //echo "*****";
                        //echo "home".$home;
                        //echo "*****";
                        //echo "back".$back;
                        
                        //echo "";
                        //echo "PRESENT!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!";
                        //echo $transactionID;

                         
                        // Insert tansaction data into the database 
                        $date = date('Y-m-d H:m:s',$fecha);  
                        //echo $date;
      
                        //Doo::db()->query("INSERT INTO pagos_online(txn_id,created,tipo_tarjeta,brand,last4,paid_amount,paid_amount_currency,payment_status,status_msg,cod_conf,cardholder_name,passenger_name,email) VALUES('$transactionID','$date','$funding','$brand','$last4','$paidAmount','$paidCurrency','$payment_status','$statusMsg','$cod_conf','$cardholder_name','$passengers_name','$email');");
                        
                        Doo::db()->query("INSERT INTO pagos_online(txn_id,created,tipo_tarjeta,brand,last4,paid_amount,paid_amount_currency,payment_status,status_msg,cod_conf,cardholder_name,passenger_name,email,phone,address,country,city,zip_code,state) VALUES('$transactionID','$date','$funding','$brand','$last4','$paidAmount','$paidCurrency','$payment_status','$statusMsg','$cod_conf','$cardholder_name','$passengers_name','$email','$phone','$address','$country','$city','$zip_code','$state');");
                       
                        $cargoJson ='{"transactionID":"'.$transactionID.'","code_confirmation":"'.$cod_conf.'","paidAmount":"'.$paidAmount.'","paidCurrency":"'.$paidCurrency.'","payment_status":"'.$payment_status.'","created":"'.$date.'","funding":"'.$funding.'","brand":"'.$brand.'","last4":"'.$last4.'","mailc":"'.$mailc.'","cardhn":"'.$cardhn.'"}';
                        $clienteJson = '{"ssl_usuario":"'.$ssl_usuario.'","ssl_first_name":"'.$ssl_first_name.'","ssl_last_name":"'.$ssl_last_name.'","ssl_phone":"'.$phone.'","ssl_country":"'.$country.'","ssl_state":"'.$state.'","ssl_city":"'.$city.'","ssl_zip_code":"'.$zip_code.'","ssl_passengers_name":"'.$passengers_name.'","ssl_email":"'.$email.'","ssl_avs_address":"'.$address.'"}';
                        
                        //echo $cargoJson;
                        
                        //return $back;
                        //echo $data['rootUrl'];
                          
                        //return $back."/booking2/pickup-dropoff/autentication/reserva/load/$cargoJson/$clienteJson";
                        
                        return $data['rootUrl']."booking2/pickup-dropoff/autentication/reserva/load/$cargoJson/$clienteJson";
                        
                        //echo
                        //return Doo::conf()->APP_URL . "booking2/pickup-dropoff/autentication/reserva/load/$cargoJson/$clienteJson";
                        //return Doo::conf()->APP_URL . "booking/pickup-dropoff/autentication/reserva/load";
                        
                                                
                }else{

                        //echo "Your Payment has Failed!";
                        $statusMsg = "Your Payment has Failed!"; 
                        echo $statusMsg;
                        
                        //$payment_id = '';
                        
                        
                        //return Doo::conf()->APP_URL . "booking/pickup-dropoff/autentication/";
                        //return Doo::conf()->APP_URL . "transaction/decline";
                        
                        return $data['rootUrl']."booking/pickup-dropoff/autentication";

                }

        }catch(Exception $e){
                echo "<script>alert('".$e->getMessage()."');</script>";
                //echo "Problems";
                //return Doo::conf()->APP_URL . "transaction/decline";
        }       
        
        
    }

    public function profile() {
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        if (isset($_SESSION['user'])) {
            $login = $_SESSION['user'];
        }
        if (isset($_SESSION["booking"])) {
            $booking = $_SESSION["booking"];
            $tipo_ticket = $booking["tipo_ticket"];
            $from = $booking["fromt"];
            $to = $booking["tot"];


            $rs = Doo::db()->find("Areas", array("select" => "nombre",
                "where" => "id = ?",
                "param" => array($from),
                "limit" => 1));
            $from_name = $rs->nombre;

            if ($tipo_ticket == "roundtrip") {


                $rs = Doo::db()->find("Areas", array("select" => "nombre",
                    "where" => "id = ?",
                    "param" => array($to),
                    "limit" => 1));
                $to_name = $rs->nombre;
            }
            if ($tipo_ticket == "oneway") {

                $rs = Doo::db()->find("Areas", array("select" => "nombre",
                    "where" => "id = ?",
                    "param" => array($to),
                    "limit" => 1));
                $to_name = $rs->nombre;
            }

            Doo::loadModel("Clientes");
            $cliente = new Clientes();
            $cliente->id = $login->id;
            $this->data['rootUrl'] = Doo::conf()->APP_URL;
            $this->data['cliente'] = Doo::db()->find($cliente, array('limit' => 1));
            $this->data['state'] = Doo::db()->find("State", array("select name from State", "asArray" => true));
            $this->data['country'] = Doo::db()->find("Country", array("select name from Country", "asArray" => true));
            $this->data['rootUrl'] = Doo::conf()->APP_URL;
            $this->data['from_name'] = $from_name;
            $this->data['to_name'] = $to_name;
            $this->data['areas'] = Doo::db()->find("Areas", array("select" => "id, nombre", "asArray" => true));

            $this->view()->renderc('profile', $this->data);
        }
    }

    public function pro() {
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->view()->renderc('probando', $this->data);
    }

    public function r() {
        $this->data['rootUrl'] = Doo::conf()->APP_URL;


        $id = $this->params["variable"];


        $sql = "SELECT fecha_ini,tipo_ticket,firsname,lasname,pax,pax2,codconf,tipo_pago FROM reservas WHERE codconf= ?";
        $rs = Doo::db()->query($sql, array($id));
        $factu = $rs->fetch();

        $totalpax = $factu['pax'] + $factu['pax2'];
        //$this->data['fac']     = $factu;

        if ($factu['tipo_ticket'] == "oneway") {

            echo "<head>
<title>Documento sin título</title>
<style type='text/css'>
#clearTable {
	width: 800px;
	font-size: 13px;
	font-family: Verdana, Geneva, sans-serif;
}
#clearTable tr #titletd3 {
	font-family: Verdana, Geneva, sans-serif;
}
#clearTable tr #titletd2 {
	font-size: 20px;
}
#clearTable tr td p {
	text-align: center;
}

#content #center-column #tdgris {
	background-color: #F0F0F0;
}
#content #center-column #tdrojo {
	background-color: #FFE6E6;
}
#content #center-column1 #titletd {
	background-color: #F5EDEB;
	padding-left: 5px;
	font-size: 12px;
}
 #titlett {
	background-color: #E8E8E8;
	padding-left: 5px;
	font-size: 12px;
}
 #titlell {
	padding-left: 5px;
	font-size: 12px;
	border-bottom-width: 1px;
	border-left-width: 1px;
	border-bottom-style: solid;
	border-left-style: solid;
	border-bottom-color: #E6E6E6;
	border-left-color: #E6E6E6;
}
#titlelp {
	padding-left: 5px;
	font-size: 12px;
	border-bottom-width: 1px;
	border-bottom-style: solid;
	border-bottom-color: #E6E6E6;
}
 #titlelr {
	padding-left: 5px;
	font-size: 12px;
	border-top-width: 1px;
	border-top-style: solid;
	border-top-color: #CE0000;
	color: #CE0000;
}
 #tdgristable {
	background-color: #FFF;
	padding-left: 5px;
}



</style>
</head><div align='center'>
<br />
<table   id='clearTable'>
     <tr>
       <td width='316' height='33' rowspan='2' id='titletd3'><img src='".$this->data['rootUrl']."global/estilos/logo.png' width='316' height='88' /></td>
       <td colspan='3' align='center' id='titletd3'>Supertours.com</td>
     </tr>
     <tr>
       <td height='35' colspan='3' id='titletd4'>Date/Time of Booking:</td>
    </tr>
     <tr>
       <td align='center' height='33' colspan='4' id='titletd2'> E-TICKET</td>
     </tr>
     <tr>
       <td height='15' id='titletd6'>LEAD TRAVELER: " . $factu['firstname'] . " " . $factu['lastname'] . " </td>
       <td width='202' height='15' id='titletd6'></td>
       <td colspan='2' id='titletd6' width='266' height='15'>AD : <strong>" . $factu['pax'] . "  </strong>CHD :" . $factu['pax2'] . "<strong> TOTAL</strong> :" . $totalpax . "</td>
    </tr>
     <tr>

       <td height='16' id='titletd7'>Status: CONFIRMED</td>
       <td width='202' height='16' id='titletd7'>Confirmation # " . $factu['codconf'] . "</td>
       <td width='200' height='16' id='titletd7'>Paid by: " . $factu['tipo_pago'] . "</td>
    </tr>
     <tr>
    <td height='45' colspan='4' id='titletd'> <p><strong>ORDER&nbsp;  CONFIRMATION</strong> + </p></td>
  </tr>
  <tr>
    <td colspan='4' ><table width='90%' height='125' id='tableorder'>
      <tr>
        <td  width='34%' height='35' id='titlett'  ><strong>Departure Date: </strong> </td>
        <td  id='titlett' width='26%'><strong>TRIP # :</strong> </td>
        <td  id='titlett' width='40%'><strong>DEPARTURE TIME :</strong> </td>
      </tr>
      <tr>
        <td height='41'><strong>From :</strong> </td>
        <td colspan='2'><strong>Pick up Point / Extensions :</strong>  </td>
      </tr>
      <tr>
        <td height='39'><strong>To </strong>:</td>
        <td colspan='2'><strong>Drop Off / Extensions :</strong> </td>
        </tr>
  </table>

    <table id='tableorder2' width='90%'>
      <tr>
        <td  align='center' height='35' id='titlett2'  >Please print and present this e-ticket for boarding<br />
          Please arrive at departure point 30 minutes before the scheduled time</td>
        </tr>
    </table>
    <table id='tableorder3' width='90%'>
      <tr>
        <td  height='35' colspan='3' id='titlett3'  aling='center' >RECEIPT</td>
        </tr>
      <tr>
        <td width='34%' height='28'>Card Holder Information</td>
        <td colspan='2'>Billing Address </td>
      </tr>
      <tr>
        <td height='27'>Name : </td>
        <td colspan='2'>Address : </td>
		 <td colspan='2'>Phone : </td>
      </tr>
      <tr>
        <td height='27'>Last Name : </td>
        <td colspan='2'>City : </td>
      </tr>
      <tr>
        <td height='27'>E-mail : </td>
        <td>State : </td>
        <td>Country :</td>
      </tr>
      <tr>
        <td height='27'>Lead Traveler :</td>
        <td colspan='2'>Zip / Postal Code : </td>
      </tr>
    </table>
    <p><br />
  </p></td>
  </tr>
  <tr>
    <td height='33' colspan='4' id='titletd' ><strong>PRICE</strong></td>
  </tr>
  <tr>
    <td colspan='4'><table width='90%' border='0' cellpadding='3' id='tableorder'>
      <tr>
        <td height='29' colspan='5' align='center'  id='titlett'><strong>COST SUMMARY</strong></td>
      </tr>
      <tr>
        <td height='31' colspan='5' align='center' id='titlell'> Transportation from <b> </b>to <b></b></td>
      </tr>
      <tr >
        <td width='7%' height='30'></td>
        <td width='17%'>Adults</td>
        <td id='titlell' width='53%'></td>
        <td id='titlelp' width='11%'>$ </td>
        <td id='titlelp' width='12%'>$ </td>
      </tr>
      <tr>


        <td height='27'></td>
        <td>Children (3-9 Years)</td>
        <td id='titlell'></td>
        <td id='titlelp'>$ </td>
        <td id='titlelp'>$ </td>

      </tr>
       <tr>
        <td height='27'></td>
        <td>&nbsp;</td>
        <td id='titlell'> Pick up Point /Drop Off - Extension </td>
        <td id='titlelp'>$ </td>
        <td id='titlelp'>$ </td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td id='titlell'>Taxes and Fees</td>
        <td id='titlelp'>$ 0.00</td>
        <td id='titlelp'>$ 0.00 </td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td  id='titlelr' align='center' colspan='2'> </td>
        <td id='titlelr'><strong>$   </strong></td>
      </tr>
    </table>
      <p>&nbsp;</p>
    <p>Non-refundable - non-transferable - no changes are allowed on dates or time of departure - no pets allowed on board -<br />
      luggage restrictions apply - Please read the terms of transportation at www.supertours.com<br />
      THANK YOU FOR CHOOSING US<br />
      HAVE A NICE TRIP<br />
      SUPER TOURS.<br />
      Phone: (407) 370-3001 Orlando / (305) 677-2676 Miami / e-mail: reservations@supertours.com

    </p></td>
  </tr>
  <tr>
    <td colspan='4' align='center'> <p align='center' class='titulopago'>

</p>       </td>

  </tr>
  </table>



</div>

		";
        } else {
            echo "no listo, roundtrip";
        }
    }

    public function update() {
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        Doo::loadModel("Clientes");

        $cliente = new Clientes($_POST);

        $new = false;

        if ($_POST['id'] == "") {
            $cliente->id = Null;
            $new = true;
        }

        $this->data['rootUrl'] = Doo::conf()->APP_URL;

        if ($new)
            Doo::db()->insert($cliente);
        else
            Doo::db()->update($cliente);

        return Doo::conf()->APP_URL . "booking/pickup-dropoff/autentication/profile/";
    }

    public function exten() {
        $id = $this->params["id"];
        $this->getExten($id);
    }

    public function getExten($id) {
        $sql = "SELECT id,place,address FROM extension WHERE id_area = ?";
        $rs = Doo::db()->query($sql, array($id));
        $datos = $rs->fetchAll();
        echo "<option value='0'> </option>";
        foreach ($datos as $resul) {
            echo "<option  value='" . $resul['id'] . "'>" . $resul['place'] . "' '" . $resul['address'] . " </option>";
        }
    }

    /*
     * Busca todos los destino de una area determinada
      y retorna las extenciones de la primera area encontrada
     */

    public function exten_to_tot_of_from() {

        $from = $this->params["from"];

        $sql = "SELECT distinct t1.trip_to, t2.nombre  FROM routes t1
                LEFT JOIN areas t2 ON (t1.trip_to = t2.id)
                WHERE t1.trip_from = ? ORDER BY  t2.id ASC";

        $rs = Doo::db()->query($sql, array($from));

        $areas = $rs->fetchAll();
        if (!empty($areas)) {
            $this->getExten($areas[0]['trip_to']);
        }
    }

    public function area_to_tot_of_from() {
        $from = $this->params["from"];
        $areas_to = $this->areas_to($from);
        echo '<option value="0" ></option>';
        foreach ($areas_to as $e) {
            echo '<option value="' . $e['trip_to'] . '" >' . $e['nombre'] . '</option>';
        }
    }

    public function areas_to($from) {
        $from = $this->params["from"];
        $sql = "SELECT distinct t1.trip_to as trip_to, t2.nombre  FROM routes t1
                LEFT JOIN areas t2 ON (t1.trip_to = t2.id)
                WHERE t1.trip_from = ? ORDER BY  t2.orden ASC";
        $rs = Doo::db()->query($sql, array($from));
        $areas = $rs->fetchAll();
        return $areas;
    }
    
    /*elseif ($from == 23) {
            $sql = "SELECT distinct t1.trip_to, t2.nombre  FROM routes t1
                LEFT JOIN areas t2 ON (t1.trip_to = t2.id)
                WHERE t1.trip_from = ? AND t2.id <> '1' AND t2.id <> '13' AND t2.id <> '14' AND t2.id <>  '15' AND t2.id <> '16'  AND t2.id <> '20' ORDER BY  t2.orden ASC";
            $rs = Doo::db()->query($sql, array($from));
            $areas = $rs->fetchAll();
            return $areas;}*/

    public function areas($from) { //Arreas disponibles del form reserva
        //       echo '<pre>';
        // print_r($from);
        // echo '</pre>';
        // die;AND t2.id <> '17'
        $from = $this->params["from"];
        if ($from == 2) {
            $sql = "SELECT distinct t1.trip_to, t2.nombre  FROM routes t1
                LEFT JOIN areas t2 ON (t1.trip_to = t2.id)
                WHERE t1.trip_from = ? AND t2.id <> '1' AND t2.id <> '13' AND t2.id <> '14' AND t2.id <>  '15' AND t2.id <> '16'  AND t2.id <> '20' ORDER BY  t2.orden ASC";
            $rs = Doo::db()->query($sql, array($from));
            $areas = $rs->fetchAll();
            return $areas;
        }elseif ($from == 1) {
            $sql = "SELECT distinct t1.trip_to, t2.nombre  FROM routes t1
                LEFT JOIN areas t2 ON (t1.trip_to = t2.id)
                WHERE t1.trip_from = ?  AND t2.id <> '2' AND t2.id <> '13'  AND t2.id <> '15' AND t2.id <> '16'  AND t2.id <> '20' ORDER BY  t2.orden ASC";
            $rs = Doo::db()->query($sql, array($from));
            $areas = $rs->fetchAll();
            return $areas;
        } elseif ($from == 17) {
            $sql = "SELECT distinct t1.trip_to, t2.nombre  FROM routes t1
                LEFT JOIN areas t2 ON (t1.trip_to = t2.id)
                WHERE t1.trip_from = ?  AND t2.id <> '3' AND t2.id <> '4' AND t2.id <> '5' AND t2.id <> '6' AND t2.id <> '7' AND t2.id <> '8' AND t2.id <> '9' AND t2.id <> '10' AND t2.id <> '12' ORDER BY  t2.orden ASC";
            $rs = Doo::db()->query($sql, array($from));
            $areas = $rs->fetchAll();
            return $areas;
        } elseif ($from == 3) {
            $sql = "SELECT distinct t1.trip_to, t2.nombre  FROM routes t1
                    LEFT JOIN areas t2 ON (t1.trip_to = t2.id)
                    WHERE t1.trip_from = ?  AND t2.id <> '13' AND t2.id <> '14' AND t2.id <>  '15' AND t2.id <> '16' AND t2.id <> '17' AND t2.id <> '20' ORDER BY  t2.orden ASC";
            $rs = Doo::db()->query($sql, array($from));
            $areas = $rs->fetchAll();
            return $areas;
        } elseif ($from == 4) {
            $sql = "SELECT distinct t1.trip_to, t2.nombre  FROM routes t1
                LEFT JOIN areas t2 ON (t1.trip_to = t2.id)
                WHERE t1.trip_from = ?  AND t2.id <> '3'  AND t2.id <> '13' AND t2.id <> '14' AND t2.id <>  '15' AND t2.id <> '16' AND t2.id <> '17' AND t2.id <> '20' ORDER BY  t2.orden ASC";
            $rs = Doo::db()->query($sql, array($from));
            $areas = $rs->fetchAll();
            return $areas;
        } elseif ($from == 5) {
            $sql = "SELECT distinct t1.trip_to, t2.nombre  FROM routes t1
                LEFT JOIN areas t2 ON (t1.trip_to = t2.id)
                WHERE t1.trip_from = ?   AND t2.id <> '13' AND t2.id <> '14' AND t2.id <> '15' AND t2.id <> '16' AND t2.id <> '17' AND t2.id <> '20' ORDER BY  t2.orden ASC";
            $rs = Doo::db()->query($sql, array($from));
            $areas = $rs->fetchAll();
            return $areas;
        } elseif ($from == 6) {
            $sql = "SELECT DISTINCT t1.trip_to, t2.nombre  FROM routes t1
            LEFT JOIN areas t2 ON (t1.trip_to = t2.id)
            WHERE t1.trip_from = ? AND t2.id <> '4'  AND t2.id <> '7' AND t2.id <> '8' AND t2.id <> '9' AND t2.id <> '10' AND t2.id <> '11' AND t2.id <> '12' AND t2.id <> '13' AND t2.id <> '14' AND t2.id <> '15' AND t2.id <> '16' AND t2.id <> '17' AND t2.id <> '20' ORDER BY  t2.orden ASC";
            $rs = Doo::db()->query($sql, array($from));
            $areas = $rs->fetchAll();
            return $areas;
        }
        elseif ($from == 7) {
            $sql = "SELECT DISTINCT t1.trip_to, t2.nombre  FROM routes t1
            LEFT JOIN areas t2 ON (t1.trip_to = t2.id)
            WHERE t1.trip_from = ?  AND t2.id <> '8' AND t2.id <> '9' AND t2.id <> '10' AND t2.id <> '11' AND t2.id <> '12' AND t2.id <> '13' AND t2.id <> '14' AND t2.id <> '15' AND t2.id <> '16' AND t2.id <> '17' AND t2.id <> '20' ORDER BY  t2.orden ASC";
            $rs = Doo::db()->query($sql, array($from));
            $areas = $rs->fetchAll();
            return $areas;
        }elseif ( $from == 8 or $from == 9 or $from == 10 or $from == 12) {
            $sql = "SELECT distinct t1.trip_to, t2.nombre  FROM routes t1
                LEFT JOIN areas t2 ON (t1.trip_to = t2.id)
                WHERE t1.trip_from = ? AND t2.id <> '13' AND t2.id <> '14' AND t2.id <> '15' AND t2.id <> '16' AND t2.id <> '17' AND t2.id <> '20' ORDER BY  t2.orden ASC";
            $rs = Doo::db()->query($sql, array($from));
            $areas = $rs->fetchAll();
            return $areas;
        } else {
            $sql = "SELECT distinct t1.trip_to, t2.nombre  FROM routes t1
                LEFT JOIN areas t2 ON (t1.trip_to = t2.id)
                WHERE t1.trip_from = ?  ORDER BY  t2.orden ASC";
            $rs = Doo::db()->query($sql, array($from));
            $areas = $rs->fetchAll();
            return $areas;
        }
    }

    /*
     * elseif($from == 6){}
     */
    public function getAreas() {
        $from = $this->params["from"];

        if ($from == 1) {
            $from = 'Orlando';
            echo $from . '<br /><br />';
        } elseif ($from == 2) {
            $from = 'Kissimmee';
            echo $from . '<br /><br />';
        } elseif ($from == 3) {
            $from = 'Fort Pierce';
            echo $from;
        } elseif ($from == 4) {
            $from = 'West Palm Beach';
            echo $from;
        } elseif ($from == 5) {
            $from = 'Pompano';
            echo $from;
        } elseif ($from == 6) {
            $from = 'Hollywood';
            echo $from;
        } elseif ($from == 7) {
            $from = 'Miami Beach (North)';
            echo $from;
        } elseif ($from == 8) {
            $from = 'Miami Beach (Central)';
            echo $from;
        } elseif ($from == 9) {
            $from = 'Miami Beach (South)';
            echo $from;
        } elseif ($from == 10) {
            $from = 'Miami Downtown';
            echo $from;
        } elseif ($from == 11) {
            $from = 'Miami Airport (Main Terminal)';
            echo $from;
        } elseif ($from == 12) {
            $from = 'Miami Airport Area (Zone)';
            echo $from;
        } elseif ($from == 13) {
            $from = 'Saint Petersburg';
            echo $from;
        } elseif ($from == 14) {
            $from = 'Tampa';
            echo $from;
        } elseif ($from == 15) {
            $from = 'Sarasota';
            echo $from;
        }elseif ($from == 16) {
            $from = 'Fort Myers';
            echo $from;
        }elseif ($from == 17) {
            $from = 'Fort Lauderdale';
            echo $from;
        }

        $areas = $this->areas($from);
        // echo '<pre>';
        // print_r($areas);
        // echo '</pre>';
        // die;
        foreach ($areas as $e) {
            echo '<option value="' . $e['trip_to'] . '" ' . ($e["nombre"] == trim("MIAMI BEACH (CENTRAL)") ? 'selected' : '') . ' >' . $e['nombre'] . '</option>';
        }
    }
    public function getAreasLoad() {
        $from = $this->params["from"];
        $to = $this->params["to"];
        if ($from == 1) {
            $from = 'Orlando';
            echo $from . '<br /><br />';
        } elseif ($from == 2) {
            $from = 'Kissimmee';
            echo $from . '<br /><br />';
        } elseif ($from == 3) {
            $from = 'Fort Pierce';
            echo $from;
        } elseif ($from == 4) {
            $from = 'West Palm Beach';
            echo $from;
        } elseif ($from == 5) {
            $from = 'Pompano';
            echo $from;
        } elseif ($from == 6) {
            $from = 'Hollywood';
            echo $from;
        } elseif ($from == 7) {
            $from = 'Miami Beach (North)';
            echo $from;
        } elseif ($from == 8) {
            $from = 'Miami Beach (Central)';
            echo $from;
        } elseif ($from == 9) {
            $from = 'Miami Beach (South)';
            echo $from;
        } elseif ($from == 10) {
            $from = 'Miami Downtown';
            echo $from;
        } elseif ($from == 11) {
            $from = 'Miami Airport (Main Terminal)';
            echo $from;
        } elseif ($from == 12) {
            $from = 'Miami Airport Area (Zone)';
            echo $from;
        } elseif ($from == 13) {
            $from = 'Saint Petersburg';
            echo $from;
        } elseif ($from == 14) {
            $from = 'Tampa';
            echo $from;
        } elseif ($from == 15) {
            $from = 'Sarasota';
            echo $from;
        } elseif ($from == 16) {
            $from = 'Fort Myers';
            echo $from;
        } elseif ($from == 17) {
            $from = 'Fort Lauderdale';
            echo $from;
        }

        $areas = $this->areas($from);
        foreach ($areas as $e) {
            if( $to == $e['trip_to']){
                echo '<option value="' . $e['trip_to'] . '" selected="" >' . $e['nombre'] . '</option>';
            }else{
                echo '<option value="' . $e['trip_to'] . '" ' . ($e["nombre"] == trim("MIAMI BEACH (CENTRAL)") ? 'selected' : '') . ' >' . $e['nombre'] . '</option>';
            }
        }
    }

    public function Asinup() {
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['state'] = Doo::db()->find("State", array("select name from State", "asArray" => true));
        $this->data['country'] = Doo::db()->find("Country", array("select name from Country", "asArray" => true));
        $this->view()->renderc('agency/signup', $this->data);
    }

    public function Asave() {
        Doo::loadModel("ASignup");

        $Asignup = new ASignup($_POST);


        $sql = "SELECT atanumber FROM agency WHERE atanumber= ?";

        $signup1 = new stdclass();
        $signup1->atanumber = $Asignup->atanumber;
        $signup1->name = $Asignup->name;
        $signup1->address = $Asignup->address;
        $signup1->phone1 = $Asignup->phone1;
        $signup1->phone2 = $Asignup->phone2;
        $signup1->email = $Asignup->email;
        $signup1->toolfree = $Asignup->toolfree;
        $signup1->movil = $Asignup->movil;
        //contac person
        $signup1->firstname = $Asignup->firstname;
        $signup1->lastname = $Asignup->lastname;
        $signup1->celphone = $Asignup->celphone;
        $signup1->error = "";
        $_SESSION['signup1'] = $signup1;

        if (strtoupper($_REQUEST["captcha"]) == $_SESSION["captcha"]) {
            // REMPLAZO EL CAPTCHA USADO POR UN TEXTO LARGO PARA EVITAR QUE SE VUELVA A INTENTAR
            $_SESSION["captcha"] = md5(rand() * time());
            // INSERTA EL CÓDIGO EXITOSO AQUI
            $rs = Doo::db()->query($sql, array($Asignup->atanumber));
            $reci = $rs->fetch();

            if ($reci != NUll) {

                return Doo::conf()->APP_URL . "agency/signup/slope/";
            } else {

                $new = false;
                $Asignup->estado = "slope";

                $id = "";
                if ($id == "") {
                    $Asignup->id = Null;
                    $new = true;
                }



                if ($new) {
                    Doo::db()->insert($Asignup);
                }

                unset($_SESSION['signup1']);
            }
        } else {
            // REMPLAZO EL CAPTCHA USADO POR UN TEXTO LARGO PARA EVITAR QUE SE VUELVA A INTENTAR
            $_SESSION["captcha"] = md5(rand() * time());
            // INSERTA EL CÓDIGO DE ERROR AQU�?
            $signup1->error = "Error";
            return Doo::conf()->APP_URL . "agency/signup/";
        }
    }

    public function slope() {
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->view()->renderc('slope', $this->data);
    }

    public function slope2() {
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->view()->renderc('slope2', $this->data);
    }

    // public function contacto() {//Mensaje enviado por el cliente para contactar a supertours por medio de correo
    //     $this->data['rootUrl'] = Doo::conf()->APP_URL;
    //     $contact_name = $_POST['contact_name'];
    //     $contact_email = $_POST['contact_email'];
    //     $contact_phone = $_POST['contact_phone'];
    //     $contact_page = $_POST['contact_page'];
    //     $contact_message = $_POST['contact_message'];

    //     $insert = 'INSERT INTO contactar ( namescont, emailscont, phonescont, messagescont, estadoscont, fechacrscont)
    //     VALUES ("'.$contact_name.'","'.$contact_email.'","'.$contact_phone.'","'.$contact_message.'",1,NOW())';
    //     Doo::db()->query($insert);
    //     // print_r($insert);
    //     // die;
    //     echo "<script>
    //                 redi()
    //                 function redi(){
    //                  window.location.href = '".$this->data['rootUrl']."".$contact_page."';
    //                 }
    //             </script>";
    // }


    public function contacto() {//Mensaje enviado por el cliente para contactar a supertours por medio de correo
      // echo '<pre>';
      // print_r($_POST);
      // echo '</pre>';
      // die;
      $this->data['rootUrl'] = Doo::conf()->APP_URL;
      $contact_name = $_POST['contact_name'];
      $contact_email = $_POST['contact_email'];
      $contact_phone = $_POST['contact_phone'];
      $contact_page = $_POST['contact_page'];
      $contact_message = $_POST['contact_message'];
      $mail13e = "arturo@supertours.com";
      //$mail12 = "arbusmad2021@gmail.com";
//        $mail2 = "jotafu@live.com";//Quitar
      //$mail2 = "reservations@supertours.com"; //Colocar
      //exit();
      Doo::loadController('DatosMailController');
      $datosMail = new DatosMailController();
      $mail = new PHPMailer(true);
      $mail = $datosMail->datos();
      $nombre_destino = 'Admin';
      $mail->AddBCC($mail13e, $nombre_destino);
      //$mail->AddBCC($mail12, $nombre_destino);
//      $mail->AddAddress($mail13e, $nombre_destino);
//      $mail->AddAddress($mail1, $nombre_destino);
//      $mail->AddAddress($mail2, $nombre_destino);
      //Asunto del correo
      $mail->Subject = 'Client / SuperTours';
      //Mensaje alternativo en caso que el destinatario no pueda abrir correos HTML
      $mail->AltBody = 'Information';

      //El cuerpo del mensaje, puede ser con etiquetas HTML
      $mail->MsgHTML("<div align='center'>
<br />
<table   id='clearTable'>
   <tr>
     <td width='401' height='33' rowspan='2' id='titletd3'><img src='".$this->data['rootUrl']."global/estilos/logo.png' width='316' height='88' /></td>
     <td colspan='3' align='center' id='titletd3'>Supertours.com</td>
   </tr>
   <tr>
     <td height='35' colspan='3' id='titletd4'>&nbsp;</td>
  </tr>
   <tr>
     <td align='center' height='33' colspan='4' style='font-weight: bold; color: red;' id='titletd2'>CONTACT INFORMATION</td>
   </tr>



<tr>
  <td colspan='4' ><table id='tableorder3' width='90%'>
    <tr>
      <td  height='35' colspan='3' id='titlett3'  aling='center' ><span style='font-weight: bold; color: red;'>CLIENT:</span> ".$contact_name."</td>
      </tr>

    <tr>
      <td width='34%' colspan='3' height='27'><span style='font-weight: bold; color: red;'>E-MAIL:</span> ".$contact_email."</td>

    </tr>
    <tr>
      <td colspan='3' height='27'><span style='font-weight: bold; color: red;'>PHONE:</span> ".$contact_phone."</td>
    </tr>
    <tr>
      <td colspan='3' height='27'><span style='font-weight: bold; color: red;'>MESSAGE:</span> ".$contact_message.".</td>

    </tr>
    <tr>
      <td height='27'>&nbsp;</td>
      <td colspan='2'>&nbsp;</td>
    </tr>
  </table>
  <p><br />
</p></td>
</tr>
<tr>
  <td colspan='4' align='center'> <p align='center' class='titulopago'>THANK YOU FOR CHOOSING US <br />
    SUPER TOURS.<br />
    Phone: (407) 370-3001 Orlando / (305) 677-2676 Miami / e-mail: reservations@supertours.com

</p>       </td>
</tr>
</table>



</div>");
      $mail->Send();
      if ($mail) {
          echo 'Sending Message';
      } else {
         // echo $mail4->ErrorInfo;
      }
      echo "<script>
                  redi()
                  function redi(){
                   window.location.href = '".$this->data['rootUrl']."".$contact_page."';
                  }
              </script>";
  }


    public function deletecontact(){
      $id = $this->params['id'];

      $delete = "UPDATE contactar SET estadoscont = 0  WHERE idscont = '" . $id . "'";
      Doo::db()->query($delete);
      return Doo::conf()->APP_URL."setting_info";
    }
    public function sentcontact(){
      $id = $_POST['id'];
      $sql = "SELECT *  FROM contactar WHERE idscont = ? ";
      $rs = Doo::db()->query($sql, array($id));
      $cnt = $rs->fetchAll();
      $contact_name = $cnt[0]['namescont'];
      $contact_email = $cnt[0]['emailscont'];
      $contact_phone = $cnt[0]['phonescont'];
      $contact_message = $cnt[0]['messagescont'];
        // print_r($contact_message);
        // die;
      //$mail13e = "bustamante3@hotmail.com";
      $mail1 = "arturo@supertours.com";
        //$mail2 = "arbusmad2021@gmail.com";//Quitar
        //$mail2 = "reservations@supertours.com"; //Colocar
        //exit();
        Doo::loadController('DatosMailController');
        $datosMail = new DatosMailController();
        $mail = new PHPMailer(true);
        $mail = $datosMail->datos();
        $nombre_destino = 'Admin';
        $mail->AddBCC($mail1, $nombre_destino);
        //$mail->AddBCC($mail2, $nombre_destino);
//        $mail->AddAddress($mail13e, $nombre_destino);
//        $mail->AddAddress($mail1, $nombre_destino);
//        $mail->AddAddress($mail2, $nombre_destino);
        //Asunto del correo
        $mail->Subject = 'Client / Super Tours';
        //Mensaje alternativo en caso que el destinatario no pueda abrir correos HTML
        $mail->AltBody = 'Information';

        //El cuerpo del mensaje, puede ser con etiquetas HTML
        $mail->MsgHTML("<div align='center'>
<br />
<table   id='clearTable'>
     <tr>
       <td width='401' height='33' rowspan='2' id='titletd3'><img src='".$this->data['rootUrl']."global/estilos/logo.png' width='316' height='88' /></td>
       <td colspan='3' align='center' id='titletd3'>Supertours.com</td>
     </tr>
     <tr>
       <td height='35' colspan='3' id='titletd4'>&nbsp;</td>
    </tr>
     <tr>
       <td align='center' height='33' colspan='4' style='font-weight: bold; color: red;' id='titletd2'>CONTACT INFORMATION</td>
     </tr>



  <tr>
    <td colspan='4' ><table id='tableorder3' width='90%'>
      <tr>
        <td  height='35' colspan='3' id='titlett3'  aling='center' ><span style='font-weight: bold; color: red;'>CLIENT:</span> ".$contact_name."</td>
        </tr>

      <tr>
        <td width='34%' colspan='3' height='27'><span style='font-weight: bold; color: red;'>E-MAIL:</span> ".$contact_email."</td>

      </tr>
      <tr>
        <td colspan='3' height='27'><span style='font-weight: bold; color: red;'>PHONE:</span> ".$contact_phone."</td>
      </tr>
      <tr>
        <td colspan='3' height='27'><span style='font-weight: bold; color: red;'>MESSAGE:</span> ".$contact_message.".</td>

      </tr>
      <tr>
        <td height='27'>&nbsp;</td>
        <td colspan='2'>&nbsp;</td>
      </tr>
    </table>
    <p><br />
  </p></td>
  </tr>
  <tr>
    <td colspan='4' align='center'> <p align='center' class='titulopago'>THANK YOU FOR CHOOSING US <br />
      SUPER TOURS.<br />
      Phone: (407) 370-3001 Orlando / (305) 677-2676 Miami / e-mail: reservations@supertours.com

</p>       </td>
  </tr>
  </table>



</div>");
        $mail->Send();
        if ($mail) {
            echo 'Sending Message';
            $UPDATE = "UPDATE contactar SET estadoscont = 0  WHERE idscont = '" . $id . "'";
            Doo::db()->query($UPDATE);
            return Doo::conf()->APP_URL."setting_info";
        } else {
           // echo $mail4->ErrorInfo;
        }
    }

    public function valid() {
        $explode = $this->params["id"];
        $values = explode(',', $explode);
        if (isset($values[1])) {
             //print_r($values);

            if ($values[1] == 1 && $values[2] == 1) {
                echo '<script>$("#areapickup1").show("slow");</script>';
            }
            if ($values[1] == 0 && $values[2] == 1) {
                echo '<script>$("#hotelarea1").val(""); $("#areapickup1").hide("slow"); </script>';
            }
            //// fin pickup 1

            if ($values[1] == 1 && $values[2] == 2) {
                echo '<script>$("#areadropoff1").show("slow"); </script>';
            }
            if ($values[1] == 0 && $values[2] == 2) {
                echo '<script>$("#hotelarea2").val("");$("#areadropoff1").hide("slow"); </script>';
            }

            //// fin dropoff 1


            if ($values[1] == 1 && $values[2] == 3) {
                echo '<script>$("#areapickup2").show("slow"); </script>';
            }
            if ($values[1] == 0 && $values[2] == 3) {
                echo '<script>$("#hotelarea3").val("");$("#areapickup2").hide("slow"); </script>';
            }


            ///fin de pickup 2

            if ($values[1] == 1 && $values[2] == 4) {

                echo '<script>$("#areadropoff2").show("slow"); </script>';
            }
            if ($values[1] == 0 && $values[2] == 4) {
                echo '<script>$("#hotelarea4").val("");$("#areadropoff2").hide("slow"); </script>';
            }

            ///fin de dropoff 2
        }
    }

    function decline() {
      // echo '<pre>';
      // print_r($_REQUEST);
      // echo '</pre>';
      // die;
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->view()->renderc('decline', $this->data);
    }

    public function mobile_index() {
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        unset($_SESSION['pasabordo']);
        $sql = "SELECT id, nombre FROM  areas WHERE id <> '20' ORDER BY orden ASC ";
        $rs = Doo::db()->query($sql);
        $areas = $rs->fetchAll();
        $this->data['areas'] = $areas;
        $this->view()->renderc('homeMobile', $this->data);
    }

    public function tripInfo() {
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $from_name = $this->params['from_name'];
        $to_name = $this->params['to_name'];

        $this->data['from_name'] = $from_name;
        $this->data['to_name'] = $to_name;
        $this->view()->renderc('informacionTrip', $this->data);
    }

    function modalTripPuesto() {
        //$dateT = $this->params['fecha'];
        $idt = $this->params['id'];
        $dateT = $this->params['dateT'];
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $tiempoRenuevaSesion ='00:50:00'; //Tiempo en el que se pide renovar la sesión
        $tiempoMaxSesion ='00:55:50'; //Tiempo máximo de la duración de la sesión
        /*
         * Trae la duración de la sesión
         * *****************************
         */

        if($idt==''){//el script que manda el id demora en cargar, por eso se pone esto
        }else{//el script que manda el id demora en cargar, por eso se pones esto
        $sqlModal = "SELECT TIMEDIFF( NOW(), fecha_usado) as Dif_fecha_usado FROM reservas_trip_puestos WHERE usuario = $idt and estado = 'USING' ";
            $sqlModal2 = Doo::db()->query($sqlModal);
            $sqlModalResult = $sqlModal2->fetchAll();
            foreach ($sqlModalResult as $ModalV):
                $tiempoSesion = $ModalV['Dif_fecha_usado'];
            endforeach;

            $dateTime1 = new DateTime($tiempoSesion);
            $dateTime2 = new DateTime("00:45:00");
            $diff = $dateTime1->diff($dateTime2);
            $resta= $diff->format('%R%I:%S Minutos');
           // echo "<br>".$resta."<br>".($tiempoSesion)."<br>".$dateTime2->format('%R%I:%S Minutos');
          //         var_dump($tiempoSesion>$tiempoRenuevaSesion);
          // var_dump($tiempoSesion);
          // echo '******';
          // var_dump($tiempoSesion<$tiempoMaxSesion);
        if($tiempoSesion>$tiempoRenuevaSesion and $tiempoSesion<$tiempoMaxSesion){
//        if($tiempoSesion>"00:00:30"){
            $sqlV= "SELECT NOW() as fecha_actual";
            $sqlVQuery = Doo::db()->query($sqlV);
            foreach ($sqlVQuery as $squery):
                $timeActual = $squery["fecha_actual"];
            endforeach;
            echo '<script>

                   $(document).ready(function()
                   {
                      $("#myModal").modal("show");
                   });
                   function hacerClick(){
                   $.ajax({
                        url: "'.$this->data['rootUrl'].'modal/sesion/iden/'.$timeActual.'/'.$idt.'",
                        method: "POST",
                        beforeSend: function () {
                        }
                    }).done(function(data) {
                    });
                   }
                </script>
                <div class="modal fade" id="myModal" role="dialog">
                  <div class="modal-dialog modal-dialog-centered">
                    <!-- Modal content-->
                    <div class="modal-content">
                      <div class="modal-header">
                        <h4 class="modal-title">Your session will expired</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                      </div>
                      <div class="modal-body">
                        <p>Your session will expired in a few minutes<br>Would you like to renovate it?</p>
                      </div>
                      <div class="modal-footer">
                        <button id="aceptar" onclick="hacerClick()" type="button" class="btn btn-default" data-dismiss="modal">Acept</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                      </div>
                    </div>
                  </div>
                </div>
            ';
        }

        /*Fin de Trae la duración de la sesión
         * ************************************
         */

        /*
         *
         *  Actualiza Fecha y hora de la actividad
         * ***************************************
         */
            $sqlUpdate = "UPDATE reservas_trip_puestos SET fecha_actividad = NOW() WHERE estado = 'USING' AND usuario = $idt";//variable que guarda el sql de editar
            Doo::db()->query($sqlUpdate);
        /*Fin de Actualiza Fecha y hora de la actividad
         * *****************************************
         */

        /*
         *
         *  Trae la duración entre el tiempo de la sesión y la fecha de uso
         * *********************************************************************************
         */
            if($tiempoSesion>$tiempoMaxSesion){

                //Elimina todas las sesiones y redirecciona a la pantalla principal si no se renueva el tiempo de la reserva
                echo '<!-- Trigger the modal with a button -->
                <script>
                   $(document).ready(function()
                   {
                      $("#myModalSorry").modal("show");
                   });
                </script>
                <!-- Modal -->
                <div class="modal fade" id="myModalSorry" role="dialog">
                  <div class="modal-dialog modal-dialog-centered">
                    <!-- Modal content-->
                    <div class="modal-content">
                      <div class="modal-header">
                        <h4 class="modal-title">SESSION EXPIRED</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                      </div>
                      <div class="modal-body">
                        <p>Sorry, your session has expired.</p>
                      </div>
                      <div class="modal-footer">
                        <a href="'.$this->data['rootUrl'].'" class="btn btn-danger" style="background-color: white;padding: 8.5px;float: right;color: #dc3545;font-weight: bold;">HOME</a>
                      </div>
                    </div>
                  </div>
                </div><br>';
                echo '
                <script>
                   $.ajax({
                        url: "'.$this->data['rootUrl'].'modal/modal/iden/'.$idt.'",
                        method: "POST",
                        beforeSend: function () {
                        }
                    }).done(function(data) {
                        });
                </script>';
                //session_destroy();
                echo '<script>
                setTimeout(destroyed, 3000);';
                echo "
                    function destroyed(){
                     window.location.href = '".$this->data['rootUrl']."';
                    }
                    </script>";
            }
         /*  - Fin de Trae la duración entre el tiempo de la sesión y la fecha de uso
         * *********************************************************************************
          * S
         */
    }
   }
   function changeData(){//DS//
       $idt = $this->params['id'];
        $sqlUpdate = "UPDATE reservas_trip_puestos SET fecha_actividad = NOW(), estado = 'CANCELLED' WHERE estado = 'USING' AND usuario = $idt";
        Doo::db()->query($sqlUpdate);
   }
   function timeSesion(){//RS//
       $time = $this->params['time'];
       $idt = $this->params['id'];
       $_SESSION["booking"]['dateT']=$time;
        $sqlUpdate = "UPDATE reservas_trip_puestos SET fecha_usado = NOW() WHERE estado = 'USING' AND usuario = $idt";
        Doo::db()->query($sqlUpdate);
        $z = "SELECT now() as timet";
        $zrt = Doo::db()->query($z);
        foreach ($zrt as $t):
            $Tt=$t['timet'];
        endforeach;
        $_SESSION['booking']['dateT1']=$Tt;
        $_SESSION['booking']['dateT2']=$Tt;
   }
   function miraSesion(){//
       $idt = $this->params['id'];
       $this->data['rootUrl'] = Doo::conf()->APP_URL;
       if($idt==''){

       }else{
           if($idt==''){
                echo '<script>
                setTimeout(redi, 1000);';
                echo "
                    function redi(){
                     window.location.href = '".$this->data['rootUrl']."';
                    }
                </script>";
            }else{
                $sqlV = "SELECT * from reservas_trip_puestos WHERE estado = 'USING'";
                $sqlModal2 = Doo::db()->query($sqlV);
                $sqlModalResult = $sqlModal2->fetchAll();
                foreach ($sqlModalResult as $MV):
                    $d =0;
                    if($MV['usuario']==$idt and $MV['estado']=='USING'){
                        $d++;
                    }
                endforeach;
                if($d==0){
                    echo "kkkkkt";
                }else{
                    echo "nnn";
                }
            }
       }
   }

   function naveganteT(){//Sin comentarios, sorry
            //Esta función es para cuando el usuario se salga del proceso que lleva realizar la reserva
       //se cancele la misma y el puesto no quede apartado
       $iden =0;
       if(isset($_SESSION["booking"])){
            $booking = $_SESSION["booking"];
            if($booking["iden"]!=""){
                $iden = $booking["iden"];
            }else{
                $iden = $iden;
           }
        }else{
             $iden = $iden;
           }
          //  print_r($iden);
          //  die;
        $a = "UPDATE reservas_trip_puestos SET estado = 'CANCELLED' WHERE usuario = $iden and estado = 'USING'";
        Doo::db()->query($a);
        // print_r($iden);
        // die;
        $booking = array(
            "tipo_ticket" => $booking["tipo_ticket"],
            "fromt" => $booking["fromt"],
            "tot" => $booking["tot"],
            "fecha_salida" => $booking["fecha_salida"],
            "fecha_retorno" => $booking["fecha_retorno"],
            "pax" => $booking["pax"],
            "chil" => $booking["chil"],
            "iden" => $booking["iden"],
            "dateT" => $booking["dateT"],
            "dateT1" => $booking["dateT1"],
            "dateT2" => $booking["dateT2"],
            "resident"=>0
        );
        $_SESSION["booking"] = $booking;
   }

   function naveganteDescaradoT(){
       $iden =0;
       $this->data['rootUrl'] = Doo::conf()->APP_URL;
       if(isset($_SESSION["booking"])){
            $booking = $_SESSION["booking"];
            if($booking["iden"]!=""){
                $iden = $booking["iden"];
            }else{
                $iden = $iden;
           }
        }else{
             $iden = $iden;
           }
        $a = "SELECT estado, usuario from reservas_trip_puestos WHERE estado = 'USING' and usuario = $iden";
        $ab = Doo::db()->query($a);
        $bCuenta = 0;
        foreach ($ab as $S):
            $bUsuario = $S['usuario'];
            $bEstado = $S['estado'];
            if($bUsuario!='' and $bEstado!=''){
                $bCuenta++;
            }
        endforeach;
//        echo $bCuenta."- Vuelta: ".$booking["idPrecioVuelta"]."- Ida: ".$booking["idPrecioIda"];
        if($bCuenta == 0 || ($booking["tipo_ticket"]=="roundtrip" && ($booking["idPrecioIda"]=="" || $booking["idPrecioVuelta"]=="")) || ($booking["tipo_ticket"]=="oneway" && $booking["idPrecioIda"]=="")){
            echo '<!-- -->
                        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
                        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
                        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
                <script>
                   $(document).ready(function()
                   {
                      $("#ModalWithoutSesion").modal("show");
                   });
                </script>
                <!-- Modal -->
                <div class="modal fade" id="ModalWithoutSesion" data-backdrop="static" data-keyboard="false" role="dialog">
                  <div class="modal-dialog">
                    <!-- Modal content-->
                    <div class="modal-content">
                      <div class="modal-header">
                        <h4 class="modal-title">SESSION EXPIRED</h4>
                      </div>
                      <div class="modal-body">
                        <p> ida:'.$booking["idPrecioIda"].' vuelta:'.$booking["idPrecioVuelta"].' You must select a destination to be on this page. If you left this page recently, you must will check our disponibility and select your destination again..</p>
                      </div>
                      <div class="modal-footer">
                        <a href="'.$this->data['rootUrl'].'" class="btn btn-danger" style="background-color: white;padding: 8.5px;float: right;color: #dc3545;font-weight: bold;">HOME</a>
                      </div>
                    </div>
                  </div>
                </div>';
            echo '<script>
                setTimeout(redi, 6000);';
                if(isset($_SESSION['infoforms']) || isset($_SESSION['signup2'])){
                    unset($_SESSION['user']);
                }
                echo "
                    function redi(){
                     window.location.href = '".$this->data['rootUrl']."';
                    }
                </script>";
        }else{

        }
   }
   function formPrincipalRound(){
    //  echo '<pre>';
    //  print_r($this->params);
    //  echo '</pre>';
    //  die;
       $this->data['rootUrl'] = Doo::conf()->APP_URL;
       $toT = $this->params['to'];
        $fromT = $this->params['from'];
        $fechaSalidaT = $this->params['departure'];
        $fechaRetornoT = $this->params['returning'];
        $adultT = $this->params['adult'];
        $childT = $this->params['child'];
        $totalPax = $adultT + $childT;
        $tipo_ticket = "roundtrip";
        // echo '<pre>';
        // var_dump($totalPax<=8 && $totalPax>=1 && $adultT>=1);
        // echo '</pre>';
        // die;
        if($totalPax<=8 && $totalPax>=1 && $adultT>=1){
            if (isset($_SESSION["booking"])) {
                $booking = $_SESSION["booking"];
            }
            $dateT1 = $booking["dateT1"];
            $dateT2 = $booking["dateT2"];
            $booking = array(
                "tipo_ticket" => $tipo_ticket,
                "fromt" => $fromT,
                "tot" => $toT,
                "fecha_salida" => $fechaSalidaT,
                "fecha_retorno" => $fechaRetornoT,
                "pax" => $adultT,
                "chil" => $childT,
                "iden" => $booking["iden"],
                "dateT1" => $dateT1,
                "dateT2" => $dateT2
            );

            $_SESSION["booking"] = $booking;

            echo "ok";

        }else{
            echo " <div class='bg-danger' style='color:#e4c990; border-radius: 5px;background-color: white; padding:3px;font-weight: bold;text-align:center;'>Error!<br/> The total number of passengers must be a <span style='color: white;'>maximum of 8</span> and a <span style='color: white;'>minimum of 1</span><br>(1 passengers must be adult).</div>";
        }
   }
   function formPrincipalOneway(){
        $toT = $this->params['to'];
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $fromT = $this->params['from'];
        $fechaSalidaT = $this->params['departure'];
        $adultT = $this->params['adult'];
        $childT = $this->params['child'];
        $totalPax = $adultT + $childT;
        $tipo_ticket = "oneway";
        if($totalPax<=8 && $totalPax>=1 && $adultT>=1){
            if (isset($_SESSION["booking"])) {
                $booking = $_SESSION["booking"];
            }
            $dateT1 = $booking["dateT1"];
            $dateT2 = $booking["dateT2"];

            $booking = array(
                "tipo_ticket" => $tipo_ticket,
                "fromt" => $fromT,
                "tot" => $toT,
                "fecha_salida" => $fechaSalidaT,
                "fecha_retorno" => "",
                "pax" => $adultT,
                "chil" => $childT,
                "iden" => $booking["iden"],
                "dateT1" => $dateT1,
                "dateT2" => $dateT2
            );

            $_SESSION["booking"] = $booking;
            // echo '<pre>';
            // print_r($_SESSION);
            // echo '</pre>';
            // die;
           echo "ok";
        }else{
            echo " <div class='bg-danger' style='color:#e4c990; border-radius: 5px;background-color: white; padding:3px;font-weight: bold;text-align:center;'>Error!<br/> The total number of passengers must be a <span style='color: white;'>maximum of 8</span> and a <span style='color: white;'>minimum of 1</span>.</div>";
        }
   }
  function formResidentT(){
    $resident = $this->params['resident'];
    $this->data['rootUrl'] = Doo::conf()->APP_URL;
    $zip = $this->params['zip'];
        if($zip==="1" and $resident === "0"){
            $zip="";
        }else{
            $zip=$zip;
        }
        if (isset($_SESSION["booking"])) {
                $booking = $_SESSION["booking"];
            }
        $booking = array(
            "tipo_ticket" => $booking['tipo_ticket'],
            "fromt" => $booking['fromt'],
            "tot" => $booking['tot'],
            "fecha_salida" => $booking['fecha_salida'],
            "fecha_retorno" => $booking['fecha_retorno'],
            "pax" => $booking['pax'],
            "chil" => $booking['chil'],
            "iden" => $booking['iden'],
            "dateT" => $booking['dateT'],
            "dateT1" => $booking['dateT1'],
            "dateT2" => $booking['dateT2'],
            "zip" => $zip,
            "resident" => $resident
        );
        $_SESSION["booking"] = $booking;
          //        echo '<pre>';
          //  print_r($_SESSION["booking"]);
          //  echo '</pre>';
          //  die;
        echo "<script>
                    window.location.href = '".$this->data['rootUrl']."booking';
                </script>";
  }

  function formIdPrecio(){
    $idPrecioIda = $this->params['idPrecioIda'];
    $idPrecioVuelta = $this->params['idPrecioVuelta'];
    $this->data['rootUrl'] = Doo::conf()->APP_URL;
    $trip1 = $this->params['trip1'];
    $trip2 = $this->params['trip2'];
    
    //echo $trip_no;
    //die;
    
//    echo $idPrecioIda;
//    echo "--";
//    echo $idPrecioVuelta;
//    echo "--";
//    echo $trip1;
//    echo "--";
//    echo $trip2;
//    echo "--";
//    die;
    
    //print_r($_SESSION["booking"]);
    //die;

    if (isset($_SESSION["booking"])) {
            if($trip2==="trip2" || $idPrecioVuelta==="idPrecioVuelta" || $_SESSION['booking']['oneway']){
                $_SESSION['booking']['idPrecioIda'] = $idPrecioIda;
                $_SESSION['booking']['trip1'] = $trip1;
                
            }else{
                $_SESSION['booking']['idPrecioIda'] = $idPrecioIda;
                $_SESSION['booking']['idPrecioVuelta'] = $idPrecioVuelta;
                $_SESSION['booking']['trip1'] = $trip1;
                $_SESSION['booking']['trip2'] = $trip2;
            }
        }
    
    echo "<script>
            window.location.href = '".$this->data['rootUrl']."booking/pickup-dropoff';
          </script>";
    
  }
//  function pan(){
//      $departure1T= $this->params["time"];
//        if($departure1T==""){
//        }else{
//            echo "$departure1T";
//        }
//  }
  function compruebaUsing(){//Comprueba si se está usando un trip; es decir, si en la BD está seleccionado un trip con el usuario actual y de ser así, se actualiza el booking y se coloca en cancelado
    $this->data['rootUrl'] = Doo::conf()->APP_URL;
    if (isset($_SESSION["booking"])) {
        $sqlUsingD = "SELECT estado FROM reservas_trip_puestos WHERE usuario ='".$_SESSION["booking"]["iden"]."' AND estado = 'USING'";
        $sqlSelect = Doo::db()->query($sqlUsingD);
        $ver = 0;
        foreach ($sqlSelect as $MV):
            $t = $MV["estado"];
            $ver++;
        endforeach;

        $sqlUsing = "UPDATE reservas_trip_puestos SET estado = 'CANCELLED' WHERE usuario ='".$_SESSION["booking"]["iden"]."' AND estado = 'USING'";
            Doo::db()->query($sqlUsing);
        if($ver>0){
            echo "<script>
                console.log('Clean selection');
                window.location.href = '".$this->data['rootUrl']."booking';
                </script>
                ";
            }
        }
  }

  function compruebaUsingNop(){//Comprueba si no se está usando un trip; es decir, si en la BD no está seleccionado un trip con el usuario actual y de ser así, se redirecciona a booking
    $this->data['rootUrl'] = Doo::conf()->APP_URL;
    if (isset($_SESSION["booking"])) {
        $sqlUsingD = "SELECT estado FROM reservas_trip_puestos WHERE usuario ='".$_SESSION["booking"]["iden"]."' AND estado = 'USING'";
        $sqlSelect = Doo::db()->query($sqlUsingD);
        $ver = 0;
        foreach ($sqlSelect as $MV):
            $t = $MV["estado"];
            $ver++;
//            echo $ver;
//            die;
        endforeach;
        if($ver <= 0){
            echo "<script>
                console.log('Clean selection Nop".$ver."');
                window.location.href = '".$this->data['rootUrl']."booking';
                </script>
                ";
            }
        }
  }

  public function cargarTablaDinamica(){
    $adult = $this->params['adult'];
    $child = $this->params['child'];
    $data = $_SESSION['booking'];
    
        $html = '<table class="table table-borderless" id="tablaPreciosTarifa">
        <tr>
           <th>Fare Summary</th>
           <th>Base Fare</th>
           <th>Total Fare</th>
        </tr>
        <tr>
           <td>Adult x '.$data["pax"].'</td>
           <td>
              '.number_format($adult, 2, '.', ',').'
           </td>
           <td>
              '.number_format($data["pax"]*$adult, 2, '.', ',').'
           </td>
        </tr>
        <tr>
           <td>Child x '.$data["chil"].'</td>
           <td>
              '.number_format($child, 2, '.', ',').'
           </td>
           <td>
              '.number_format($data["chil"]*$child, 2, '.', ',').'
           </td>
        </tr>
     </table>';
     echo $html;
  }

  public function cargarPrecioDinamico(){
    $adult = $this->params['adult'];
    $child = $this->params['child'];
    $data = $_SESSION['booking'];
        $precioTotal = (number_format($data["pax"]*$adult, 2, '.', ',') + number_format($data["chil"]*$child, 2, '.', ','));
        echo number_format($precioTotal, 2, ',', '.');
  }

   public function recoverPass() {/* Con esta funcion se recupera la clave del usuario*/
    // if(isset($this->params['mail'])){
      $mailT = $this->params['mail'];
    // }else{
    //   $mailT = $_POST['remberEmailt1'];
    // }

    // echo $mailT;

        $this->data['rootUrl'] = Doo::conf()->APP_URL;

            $pass = Doo::db()->query("SELECT `password`,firstname,lastname,username FROM clientes WHERE username = ? AND `password` <> ''"
                    , array(trim($mailT)));
            $data = $pass->fetch();
		if($data != null){

      echo '<h3>Correo Enviado: '.$mailT.'-'.$data['password'].'</h3';
            if (isset($data['password'])) {
                try {
                    Doo::loadController('DatosMailController');
                    $datosMail = new DatosMailController();
                    $mail = new PHPMailer(true);;
                     $mail2 = $datosMail->datos();

                    $mail->Host = $mail2->Host;
                    $mail->From = $mail2->From;
                    $mail->FromName = "Super Tours";
                    //La direccion a donde mandamos el correo
                    $nombre_destino = $data['firstname'];
                    $mail->AddAddress($mailT, $nombre_destino);
                     //$mail->AddCC("bustamante3@hotmail.com.com");    //En este espacio debe ir un correo de respaldo.
		            $mail->AddBCC("arturo@supertours.com");    //En este espacio debe ir un correo de respaldo.
		            //$mail->AddBCC("arbusmad2021@gmail.com");    //En este espacio debe ir un correo de respaldo.
//                    //Asunto del correo
                    $mail->Subject = 'Recovery Password / Super Tours';
                    //Mensaje alternativo en caso que el destinatario no pueda abrir correos HTML
                    $mail->AltBody = 'Recovery Password';
//                    //El cuerpo del mensaje, puede ser con etiquetas HTML
                    $mail->MsgHTML("<div align='center'>
<br />
<table   id='clearTable'>
    <tr>
      <td width='401' height='33' rowspan='2' id='titletd3'><img src='".$this->data['rootUrl']."global/estilos/logo.png' width='316' height='88' /></td>
      <td colspan='3' align='center' id='titletd3'>Supertours.com</td>
    </tr>
    <tr>
       <td height='35' colspan='3' id='titletd4'>&nbsp;</td>
    </tr>
    <tr>
      <td align='center' height='33' colspan='4' id='titletd2'>RECOVERY PASSWORD</td>
    </tr>
    <tr>
       <td colspan='4' >
        <table id='tableorder3' width='90%'>
            <tr>
                <td  height='35' colspan='3' id='titlett3'  aling='center' >RECEIPT</td>
            </tr>
            <tr>
                <td width='34%' height='27'>USERNAME:</td>
                <td colspan='2'>" . $mailT . "</td>
            </tr>
            <tr>
                <td height='27'>PASSWORD:</td>
                <td>" . $data['password'] . "</td>
            </tr>
            <tr>
                <td height='27'>&nbsp;</td>
                <td colspan='2'>&nbsp;</td>
            </tr>
        </table>
       </td>
    </tr>
    <tr>
        <td colspan='4' align='center'>
            <p align='center' class='titulopago'>
                <span style='font-size: 9px;color: black; font-weight: bold;'>THANK YOU FOR CHOOSING US  <br>
                Please read additional terms <a href='http://www.supertours.com'>www.supertours.com</a><br>
                Have a SUPER trip!<br />
                <br/>
                SUPER TOURS.<br>
                Phone: (407) 370-3001 Orlando / (305) 677-2676 Miami / e-mail: reservations@supertours.com
                </span>
            </p>
        </td>
    </tr>
  </table>



</div>");
//                    //Archivos adjuntos
//                    //$mail->AddAttachment('img/logo.jpg');      // Archivos Adjuntos
//                    //Enviamos el correo
                    $mail->Send();
//                    //
                } catch (phpmailerException $e) {
                    echo $e->errorMessage(); //Errores de PhpMailer
                } catch (Exception $e) {
                    echo $e->getMessage(); //Errores de cualquier otra cosa.
                }
//
                echo "Contrase&ntildea Enviada a " . $data['username'];
            } else {
//
//                echo "El correo no Existe ";
            }
		}else{
		echo 'error';
		}
    }

}



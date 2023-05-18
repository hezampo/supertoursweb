<?php

/**
 * AgenciaController
 *
  �ngel Valencia
 */
Doo::loadController('I18nController');
Doo::loadHelper('class.phpmailer');

class AgenciaController extends DooController {

    public $data;
    

    public function index() {
        if (isset($_SESSION['uagency'])) {
            Doo::loadModel("UserA");
            $datos = unserialize($_SESSION['uagency']);

            $this->data['datos'] = array();
            $this->data['filtro'] = "";
            $this->data['texto'] = "";
            $this->data['pager'] = 0;
            $this->data['pagina'] = 1;


            $this->data['rootUrl'] = Doo::conf()->APP_URL;


            $this->data['agencia'] = $this->db()->find('Agency', array('where' => 'id = ? ',
                'limit' => 1,
                'select' => 'company_name,phone1,iata_clia,main_email',
                'param' => array($datos->id_agencia)
                    )
            );
            $hora = date("H:i:s");
            list($hora, $minutos, $segundos) = explode(":", $hora);
            $this->data['hora'] = $hora;
            $this->data['minutos'] = $minutos;
            $this->data['segundos'] = $segundos;
            $this->data['areas'] = Doo::db()->find("Areas", array("select" => "id, nombre", "asArray" => true));
            $this->renderc('/agency/index', $this->data);
            unset($_SESSION['amensage']);
        } else {
            $this->data['rootUrl'] = Doo::conf()->APP_URL;
            $this->data['error'] = "";
            $this->renderc('/agency/login', $this->data);
        }
    }

    public function totalizar() {
        
        // nombre_input_variable=nombre_input_seleccionado+valorfijo
        if (isset($_SESSION["toursbooking"])) {
            $toursbooking = $_SESSION["toursbooking"];
            $_SESSION['totalboking'] = $toursbooking['tqp'] * $toursbooking['totalpax'];
            echo (($toursbooking['tqp'] * $toursbooking['totalpax']) + $_REQUEST['new_val']);
            $_SESSION['agency_fee'] = $_REQUEST['new_val'];
        } else {
            $_SESSION['totalboking'] = $_SESSION['booking']['totaltotal'];
            echo ($_SESSION['booking']['totaltotal'] + $_REQUEST['new_val']);
            $_SESSION['agency_fee'] = $_REQUEST['new_val'];
        }
    }

    public function iscredit() {
        
        $allcredito = 0;
        if (isset($_SESSION['agencyAcount'])) {
            Doo::loadModel("Agency_Account");
            $acountAgen = new Agency_Account($_SESSION['agencyAcount']);
            if (($acountAgen->opcion5 == 2)) {
                Doo::loadModel("Acredito");
                $credito = new Acredito();
                $credito->id_agency_account = $acountAgen->id_agencia;
                $creditos = Doo::db()->find($credito, array("select" => "*"));
                $allcredito = 0;
                foreach ($creditos as $e) {
                    $allcredito += $e->disponible;
                }
                return $allcredito;
            }
        }
        return $allcredito;
    }

    public function credito($id) {
        
        $allcredito = 0;
        Doo::loadModel("Acredito");
        $credito = new Acredito();
        $credito->id_agency_account = $id;
        $creditos = Doo::db()->find($credito, array("select" => "*"));
        $allcredito = 0;
        foreach ($creditos as $e) {
            $allcredito += $e->disponible;
        }
        return $allcredito;
    }

    public function login() {
        

        if (!isset($_SESSION['uagency'])) {
            extract($_POST, EXTR_SKIP);
            Doo::loadModel("UserA");
            $usera = new UserA($_POST);

            if (isset($user)) {
                if (mb_ereg("@", $user) != "") {
                    $usera->email = $user;
                } else
                    $usera->firstname = $user;
            }else {
                $usera->email = "";
            }
            $usera->password = isset($pass) ? $pass : "";
            $datos = Doo::db()->find($usera, array('limit' => 1));
            if (!empty($datos) && $datos->activo == '1') {
                $agency = Doo::db()->find("Agency", array("select" => "*",
                    "where" => "id = ?", "param" => array($datos->id_agencia), "limit" => 1));
                $agencyAcount = Doo::db()->find("Agency_Account", array("select" => "*",
                    "where" => "id_agencia = ?", "param" => array($datos->id_agencia), "limit" => 1));
                if (!empty($agency) || !empty($agencyAcount)) {
                    $_SESSION['data_agency'] = $agency;
                    $_SESSION['agencyAcount'] = $agencyAcount;
                    $_SESSION['uagency'] = serialize($datos);
                } else {
                    return Doo::conf()->APP_URL;
                }
                $login = new stdclass();
                $login->username = $datos->email;
                $login->username2 = $datos->email;
                $login->firstname = $datos->firstname;
                $login->lastname = $datos->lastname;
                $login->state = "N/A";
                $login->address = "N/A";
                $login->zip = "0";
                $login->tipo_client = "3";
                $login->city = "N/A";
                $login->country = "N/A";
                $login->phone = "0";
                $login->celphone = "0";
                $login->id = $datos->id;
                $login->admon = $datos->admon;
                $_SESSION['user'] = $login;
                $_SESSION['agenci_data'] = serialize($datos);
                return Doo::conf()->APP_URL . "agency/#transporte";
            } else {
                $this->data['error'] = "user / password invalid";
                $this->data['rootUrl'] = Doo::conf()->APP_URL;
                $this->renderc('/agency/login', $this->data);
            }
        } else {
            return Doo::conf()->APP_URL . "agency/#transporte";
        }
    }

    public function logout() {
        $_SESSION = array();
        return Doo::conf()->APP_URL . "agency/";
    }

    public function mytours() {
        if (!isset($_SESSION['uagency'])) {
            return Doo::conf()->APP_URL;
        }

        Doo::loadHelper('DooPager');
        Doo::loadModel("UserA");
        $datos = unserialize($_SESSION['uagency']);
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
        $sqll = "SELECT COUNT(*) as total
			          FROM tours WHERE id_agency = $datos->id_agencia and $filtro like ?  ";

        $rs = Doo::db()->query($sqll, array($texto . '%'));

        $count = $rs->fetch();
        $total = $count['total'];

        if ($total == 0)
            $total = 1;
        // iniciamos el paginador

        $pager = new DooPager(Doo::conf()->APP_URL . "agency/mytours/$filtro/$texto/page", $total, 8, 5);

        if (isset($this->params['pindex'])) {
            $pager->paginate(intval($this->params['pindex']));
        } else {
            $pager->paginate(1);
        }

        $sql = "SELECT k.id,k.code_conf,k.starting_date,k.ending_date,k.creation_date,t4.firstname,t4.lastname,t5.company_name,t3.firstname as f_cliente,t3.lastname as l_cliente
			          FROM tours k          left join clientes t3 on (k.id_client = t3.id) 
							LEFT JOIN user_agencia t4 ON (k.agency_employee = t4.id)
							LEFT JOIN agencia t5 ON (k.id_agency = t5.id)	
			       where k.$filtro like ?  AND k.id_agency = $datos->id_agencia   ORDER BY k.id DESC  limit $pager->limit";

        $rs = Doo::db()->query($sql, array($texto . '%'));
        $dato = $rs->fetchAll();
       
        $this->data['areas'] = Doo::db()->find("Areas", array("select" => "id, nombre", "asArray" => true));
        $this->data['datos'] = $dato;
        $this->data['filtro'] = $filtro;
        $this->data['texto'] = $texto;
        $this->data['pager'] = $pager->output;
        $this->data['pagina'] = 2;
//        print_r(Doo::db()->show_sql());
//        exit;
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->renderc('/agency/page_tours', $this->data);
    }

    public function mytours2() {
        

        Doo::loadHelper('DooPager');
        Doo::loadModel("UserA");
        $datos = unserialize($_SESSION['uagency']);

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
        $sqll = "SELECT COUNT(*) as total
			          FROM tours_oneday WHERE id_agency = $datos->id_agencia and $filtro like ?  ";

        $rs = Doo::db()->query($sqll, array($texto . '%'));

        $count = $rs->fetch();
        $total = $count['total'];
//        print_r(Doo::db()->showSQL());
//        exit;

        if ($total == 0)
            $total = 1;
        // iniciamos el paginador

        $pager = new DooPager(Doo::conf()->APP_URL . "agency/mytours2/$filtro/$texto/page", $total, 8, 5);

        if (isset($this->params['pindex'])) {
            $pager->paginate(intval($this->params['pindex']));
        } else {
            $pager->paginate(1);
        }

        $sql = "SELECT k.id,t1.fecha_ini, t1.trip_no,t1.trip_no2,t1.tipo_ticket,t1.fromt,t1.tot,t1.firsname,t1.lasname,t1.pax,t1.pax2,t1.totaltotal,k.code_conf,hora,
			      t2.nombre AS de,t2.nombre AS para,t1.fecha_salida,t4.firstname,t4.lastname,t5.company_name
			          FROM tours_oneday k         LEFT JOIN reservas t1 ON (k.id = t1.id_tours)
							LEFT JOIN areas t2 ON (t1.fromt = t2.id)
							LEFT JOIN areas t3 ON (t1.tot = t3.id)
							LEFT JOIN user_agencia t4 ON (k.agency_employee = t4.id)
							LEFT JOIN agencia t5 ON (t1.agency = t5.id)
			       
							
			       where t1.$filtro like ?  AND k.id_agency = $datos->id_agencia  ORDER BY k.id DESC limit $pager->limit";

        $rs = Doo::db()->query($sql, array($texto . '%'));
        $dato = $rs->fetchAll();
        $this->data['areas'] = Doo::db()->find("Areas", array("select" => "id, nombre", "asArray" => true));
        $this->data['datos'] = $dato;
        $this->data['filtro'] = $filtro;
        $this->data['texto'] = $texto;
        $this->data['pager'] = $pager->output;
        $this->data['pagina'] = 2;

        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->renderc('/agency/page_tours2', $this->data);
    }

    public function myadmin() {
        
        $this->data['pagina'] = 4;
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->renderc('/agency/agency_administrator', $this->data);
    }

    public function myprofile() {
       
        if (!isset($_SESSION['uagency'])) {
            return Doo::conf()->APP_URL;
        }
        if (isset($_SESSION['uagency'])) {
            Doo::loadModel("UserA");
            $datos = unserialize($_SESSION['uagency']);
            $this->data['agencia'] = $this->db()->find('Agency', array('where' => 'id = ? ',
                'limit' => 1,
                'select' => 'company_name,phone1,iata_clia,main_email',
                'param' => array($datos->id_agencia)
                    )
            );
            $this->data['pagina'] = 3;
            $this->data['rootUrl'] = Doo::conf()->APP_URL;
            $this->renderc('/agency/profiles', $this->data);
        }
    }

    public function mytransportations() {
        
        Doo::loadModel("UserA");
        Doo::loadHelper('DooPager');
        $datos = unserialize($_SESSION['uagency']);


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
        $sqll = "SELECT COUNT(*) as total
			          FROM reservas WHERE agency = $datos->id_agencia and $filtro like ? and type_tour = '' ";
        //AND tipo_client = 3 
        $rs = Doo::db()->query($sqll, array($texto . '%'));

        $count = $rs->fetch();
        $total = $count['total'];
        
        $hora = date("H:i:s");
        list($hora, $minutos, $segundos) = explode(":", $hora);
        $this->data['hora'] = $hora;
        $this->data['minutos'] = $minutos;
        $this->data['segundos'] = $segundos;
        if ($total == 0)
            $total = 1;
        // iniciamos el paginador

        $pager = new DooPager(Doo::conf()->APP_URL . "agency/transport/$filtro/$texto/page", $total, 8, 5);

        if (isset($this->params['pindex'])) {
            $pager->paginate(intval($this->params['pindex']));
        } else {
            $pager->paginate(1);
        }

        $sql = "SELECT t1.id,t1.fecha_ini, t1.trip_no,t1.trip_no2,t1.tipo_ticket,t1.fromt,t1.tot,t1.firsname,t1.lasname,t1.pax,t1.pax2,t1.totaltotal,t1.codconf,hora,
			      t2.nombre AS de,t2.nombre AS para,t1.fecha_salida,t4.firstname,t4.lastname,t5.company_name
			          FROM reservas t1
							LEFT JOIN areas t2 ON (t1.fromt = t2.id)
							LEFT JOIN areas t3 ON (t1.tot = t3.id)
							LEFT JOIN user_agencia t4 ON (t1.agen = t4.id)
							LEFT JOIN agencia t5 ON (t1.agency = t5.id)
			       WHERE t1.$filtro like ?  
				   		AND agency = $datos->id_agencia and t1.type_tour = ''
						ORDER BY  t1.id desc 
					limit $pager->limit";

        $rs = Doo::db()->query($sql, array($texto . '%'));

        $dato = $rs->fetchAll();
        $this->data['areas'] = Doo::db()->find("Areas", array("select" => "id, nombre", "asArray" => true));
        $this->data['datos'] = $dato;
        $this->data['filtro'] = $filtro;
        $this->data['texto'] = $texto;
        $this->data['pager'] = $pager->output;
        $this->data['pagina'] = 1;
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->renderc('/agency/page_transportation', $this->data);
    }

    public function profile() {
        if (!isset($_SESSION['uagency'])) {
            return Doo::conf()->APP_URL;
        }
        Doo::loadModel("UserA");

        $datos = unserialize($_SESSION['uagency']);

        $usera = new UserA($_POST);

        $usera->id = $datos->id;
        $pass = $_POST["newpassword"];

        $datos = Doo::db()->find($usera, array('limit' => 1));

        if (!empty($datos)) {
            $sql = "UPDATE user_agencia
							SET 
							  password = '$pass'
							 
							WHERE id = '$usera->id'    
				      ";
            $rs = Doo::db()->query($sql);

            if ($rs) {
                $_SESSION['amensage'] = "Changed password";
                return Doo::conf()->APP_URL . "agency/#profile";
            } else {
                $_SESSION['amensage'] = "ERROR";
                return Doo::conf()->APP_URL . "agency/#profile";
            }
        } else {
            $_SESSION['amensage'] = "ERROR Old password";
            return Doo::conf()->APP_URL . "agency/#profile";
        }
    }

    public function register() {
        
        extract($_POST, EXTR_SKIP);
        $mail = new PHPMailer(true); // Declaramos un nuevo correo, el
        // parametro
        // true significa que mostrara excepciones
        // y
        // errores.
        $mail->IsSMTP(); // Se especifica a la clase que se utilizar� SMTP
        try {
            // ------------------------------------------------------
            $correo_emisor = "websales@supertours.com"; // Correo a utilizar para
            // autenticarse
            // Gmail o de GoogleApps
            $nombre_emisor = "Supertours Of Orlando"; // Nombre de quien env�a el
            // correo
            $contrasena = "daniel4"; // contrase�a de tu cuenta en Gmail
            // Correo de quien recibe
            // Nombre de quien recibe
            // --------------------------------------------------------
            // $mail->SMTPDebug = 2; // Habilita
            // informaci�n SMTP (opcional para pruebas)
            // 1 = errores y mensajes
            // 2 = solo mensajes
            $mail->SMTPAuth = true; // Habilita la autenticaci�n SMTP
            $mail->SMTPSecure = "tsl"; // Establece el tipo de seguridad SMTP
            $mail->Host = "smtpout.secureserver.net"; // Establece Gmail como el
            // servidor SMTP
            $mail->Port = 80; // Establece el puerto del servidor SMTP de Gmail
            $mail->Username = $correo_emisor; // Usuario Gmail
            $mail->Password = $contrasena; // Contrase�a Gmail
            //$mail->AddAddress("curiel30@hotmail.com", "Daniel Curiel");
            $mail->AddAddress($correo_emisor, $nombre_emisor);
            // De parte de quien es el correo
            $mail->SetFrom("no_reply@supertours.com", $nombre_emisor);
            // Asunto del correo
            $mail->Subject = 'Registration Agency';
            // Mensaje alternativo en caso que el destinatario no pueda abrir
            // correos HTML
            $mail->AltBody = 'Registration Agency'; // El cuerpo
            // del mensaje,
            // puede
            // ser con
            // etiquetas
            // HTML

            $mail->MsgHTML("<html>
<head>
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
</style>
</head>
<body>
<div align='center'>
<br />
<table   id='clearTable'> 
     <tr>
       <td width='316' height='33' rowspan='2' id='titletd3'><img src='https://www.supertours.com/Logo-Supertours-mail.jpg' width='316' height='88' /></td>
       <td colspan='3' align='center' id='titletd3'>Supertours.com</td>
     </tr>
     <tr>
       <td height='35' colspan='3' id='titletd4'>Fecha:" . date("M-d-Y") . " / Hora:" . date("g:i A") . " </td>
    </tr>
     <tr>
       <td align='center' height='33' colspan='4' id='titletd2'> Registration Agency (Prueba)</td>
     </tr>
     <tr>
       <td colspan=\"2\" height='15' id='titletd6'>
       <br/><br/>
       <strong>Company Name: </strong>" . $company_name . "
       <br/><br/>
       <strong>Address: </strong>" . $address . "
       <br/><br/>
       <strong>City: </strong>" . $city . "
       <br/><br/>
       <strong>Zip Code: </strong>" . $zipcode . "
        <br/><br/>
       <strong>Phone: </strong>" . $phone1 . " - " . $phone2 . "    
      </td>  
       <td colspan=\"2\" height='15' id='titletd6'>
       <br/><br/>
       <strong>Fax: </strong>" . $fax . "
       <br/><br/>
       <strong>E-Mail: </strong>" . $main_email . "
       <br/><br/>
       <strong>Web Page: </strong>" . $web_page . "
       <br/><br/>
       <strong>Person Contact: </strong>" . $person_contact . "
      </td>
 </tr>
 </table>
 </div>
       
           
</body>
</html>");

            $mail->Send();
        } catch (phpmailerException $e) {
            echo $e->errorMessage(); // Errores de PhpMailer
        } catch (Exception $e) {
            echo $e->getMessage(); // Errores de cualquier otra cosa.
        }
        $this->ResponseRegister($main_email, $company_name);
        echo "please register your agency, we will contact ...!";
    }

    public function ResponseRegister($email, $Agency) {
        $mail = new PHPMailer(true); // Declaramos un nuevo correo, el
        $mail->IsSMTP(); // Se especifica a la clase que se utilizar� SMTP
        try {
            $correo_emisor = "websales@supertours.com"; // Correo a utilizar para
            $nombre_emisor = "Supertours Of Orlando"; // Nombre de quien env�a el
            $contrasena = "daniel4"; // contrase�a de tu cuenta en Gmail
            $mail->SMTPAuth = true; // Habilita la autenticaci�n SMTP
            $mail->SMTPSecure = "tsl"; // Establece el tipo de seguridad SMTP
            $mail->Host = "smtpout.secureserver.net"; // Establece Gmail como el
            $mail->Port = 80; // Establece el puerto del servidor SMTP de Gmail
            $mail->Username = $correo_emisor; // Usuario Gmail
            $mail->Password = $contrasena; // Contrase�a Gmail
            $mail->AddAddress($email, $Agency);
            $mail->SetFrom("no_reply@supertours.com", $nombre_emisor);
            $mail->Subject = 'Thank you for choosing Supertours as your partner';
            $mail->AltBody = 'Thank you for choosing Supertours as your partner'; // El cuerpo
            $mail->MsgHTML("<title>Thank you for choosing Supertours as your partner</title><body><h1>Thank you for choosing Supertours as your partner</h1><br/><br/><p>We have received successfully your information, in the next 72 hours; we will contact you via email or phone.  </p></body>");
            $mail->Send();
        } catch (phpmailerException $e) {
            echo $e->errorMessage(); // Errores de PhpMailer
        } catch (Exception $e) {
            echo $e->getMessage(); // Errores de cualquier otra cosa.
        }
    }

    public function airport() {
        
        Doo::loadModel("Agency");
        $dat = new Agency($_SESSION['data_agency']);
        //  echo $dat->type_rate; 
        // exit();
        //date("m-d-Y")
        if (isset($_POST['fecha'])) {
            $fecha = (!empty($_POST['fecha'])) ? $_POST['fecha'] : date("m-d-Y");
        } else {
            $fecha = date('Y-m-d');
            $fecha = strtotime('+1 day', strtotime($fecha));
            $fecha = date('m-d-Y', $fecha);
            //  $fecha = date("m")."-".str_pad((date("d")+1),2,"0",STR_PAD_LEFT)."-".date("Y");
        }
        /* if(isset($_POST['hora'])){
          $hours = (!empty($_POST['hora']))?$_POST['hora']:date("H:i");
          $hours = date("H:i",strtotime($hours));
          //  $hours = str_replace("am", "", $hours);
          //  $hours = str_replace("pm", "", $hours);
          }else{
          $hours = date("H:i");
          } */
        $hours = date("H:s");
        $anno = date("Y");

        $sql = "SELECT DISTINCT t1.trip_no,t2.trip_departure,t1.estado
	FROM programacion t1
           LEFT JOIN routes t2 ON (t1.trip_no = t2.trip_no AND (t2.trip_from = 1 AND t2.trip_to = 9 OR t2.trip_from = 9 AND t2.trip_to = 1) )
	   WHERE t2.type_rate = '$dat->type_rate'AND t1.fecha = '$fecha' AND t1.anno = '$anno' 
	 ";

        $rs = Doo::db()->query($sql);

        $activoida = $rs->fetchAll();
        echo '<table width="50%" border="0" id="airport">';
        foreach ($activoida as $datos) {

            if ($datos['trip_no'] % 2 == 0) {
                echo ' <tr>
						<td width="25%"><strong>' . $datos['trip_no'] . ' - ' . date("h:s A", strtotime($datos['trip_departure'])) . '</strong></td>';

                if (strtotime($datos['trip_departure']) > strtotime($hours) && $datos['estado'] == 1) {
                    echo '<td width="20%"><div id="activo"><img src="' . Doo::conf()->APP_URL . 'global/img/agencias/activo.png"  border="0" /></div><div id="open"> Open</div></td>';
                } else {
                    echo '<td width="22%"><div id="activo"><img src="' . Doo::conf()->APP_URL . 'global/img/agencias/cerrado.png"  border="0" /></div><div id="open"> Close</div></td>';
                }



                echo '  </tr>';
            }
        }
        echo '</table>';

        echo '<table width="50%" border="0" id="airport2">';
        foreach ($activoida as $datos) {

            if ($datos['trip_no'] % 2 != 0) {
                echo ' <tr>
						<td width="25%"><strong>' . $datos['trip_no'] . ' - ' . date("h:s A", strtotime($datos['trip_departure'])) . '</strong></td>';

                if (strtotime($datos['trip_departure']) > strtotime($hours) && $datos['estado'] == 1) {
                    echo '<td width="20%"><div id="activo"><img src="' . Doo::conf()->APP_URL . 'global/img/agencias/activo.png"  border="0" /></div><div id="open"> Open</div></td>';
                } else {
                    echo '<td width="22%"><div id="activo"><img src="' . Doo::conf()->APP_URL . 'global/img/agencias/cerrado.png"  border="0" /></div><div id="open"> Close</div></td>';
                }



                echo '  </tr>';
            }
        }
        echo '</table>';
    }

    public function formato() {
        if (!isset($_SESSION['uagency'])) {
            return Doo::conf()->APP_URL;
        }
        $id = $this->params["id"];

        $sql = "SELECT  t8.company_name,t1.fecha_ini,t1.trip_no,t1.trip_no2,t1.tipo_ticket,t1.fromt,t1.tot,t1.firsname,t1.lasname,t1.email,t1.fecha_salida,t1.fecha_retorno,t1.pax,
        t1.pax2,t1.id_clientes,t1.extension1, t1.precio_e1, t1.extension2, t1.precio_e2, t1.extension3, t1.precio_e3, 	t1.extension4, t1.precio_e4,t1.pickup1,t1.dropoff1,t1.pickup2,t1.dropoff2,t1.tipo_pago,t1.totaltotal,t1.total2,t1.codconf,t1.hora,t1.comments,t1.agen,t1.tipo_client
								 ,t2.nombre AS de, t3.nombre AS  hasta,t1.deptime1,t1.deptime2,precioA,precioN,resident
                                                                        , t4.place as placepo1, t4.address as addrespo1
                                                                        , t5.place as placepo2, t5.address as addrespo2
                                                                        , t6.place as placepi1, t6.address as addrespi1
                                                                        , t7.place as placepi2, t7.address as addrespi2
									FROM reservas t1 
									LEFT JOIN areas t2 ON (t1.fromt = t2.id)
									LEFT JOIN areas t3 ON (t1.tot = t3.id)
                                                                        LEFT JOIN pickup_dropoff t4 ON (t1.dropoff1 = t4.id)
                                                                        LEFT JOIN pickup_dropoff t5 ON (t1.dropoff2 = t5.id)
                                                                        LEFT JOIN pickup_dropoff t6 ON (t1.pickup1 = t6.id)
                                                                        LEFT JOIN pickup_dropoff t7 ON (t1.pickup2 = t7.id)
                                                                        LEFT JOIN agencia t8 ON (t1.agency = t8.id)
									WHERE t1.id = ?							
 																			 ";
        $rs = Doo::db()->query($sql, array($id));

        $datos = $rs->fetch();
        $totalpax = $datos['pax'] + $datos['pax2'];
        $fee = $datos['totaltotal'] - $datos['total2'];
        $exteXpax = $datos['precio_e1'] + $datos['precio_e2'] + $datos['precio_e3'] + $datos['precio_e4'];
        $totalExten = $exteXpax * $totalpax;
        $page = "<head>
<title>Documento sin t�tulo</title>
<style type='text/css'>
#clearTable {
	width:'100%'
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



</style></head><div align='center'>
<br />
<table   id='clearTable' width='100%' > 
     <tr>
       <td width='316' height='33' rowspan='3' id='titletd3'><img src='" . Doo::conf()->APP_URL . "Logo-Supertours-mail.jpg' width='316' height='88' /></td>
       <td colspan='3' align='center' id='titletd3'>Supertours.com</td>
     </tr>
     <tr>
       <td height='35' colspan='3' id='titletd5'>Date/Time of Booking: " . $datos['fecha_ini'] . " / " . $datos['fecha_ini'] . "</td>
     </tr>
     <tr>
       <td height='35' colspan='3' id='titletd4'>Agency : <span style='color: #AD2829'>" . $datos['company_name'] . "</span></td>
    </tr>
     <tr>
       <td align='center' height='33' colspan='4' id='titletd2'> E-TICKET</td>
     </tr>
     <tr>
       
       <td height='16' id='titletd7'>Status: CONFIRMED</td>
       <td width='202' height='16' id='titletd7'>Confirmation # " . $datos['codconf'] . "</td>
       <td width='200' height='16' id='titletd7'>Paid by: " . $datos['tipo_pago'] . "</td>
    </tr>
     <tr>
    <td height='45' colspan='4' id='titletd'> <p><strong>ORDER&nbsp;  CONFIRMATION</strong> + </p></td>
  </tr>
  <tr>
    <td colspan='4' >
   
 
      <table id=\"tableorder\"  width=\"100%\">
      <tr>
        <td  colspan=\"8\" height=\"28\" id=\"titlett\" ><strong>LEADER PASSENGER'S NAME</strong></td>
      </tr>
      <tr>
     
        <td><div style=\"color:red; display:inline;\">*</div><span id=\"r1\"> Firstname: </span>
          " . $datos['firsname'] . " </td>
        <td><div style=\"color:red; display:inline;\">*</div><span id=\"r2\"> Lastname:</span>
          " . $datos['lasname'] . " </td>
        <td><span id=\"r3\">E-Mail:</span>
         " . $datos['email'] . "</td>  
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>AD : " . $datos['pax'] . "</td>
        <td>CHD : " . $datos['pax2'] . "</td>
        <td><strong>TOTAL</strong> : " . ($datos['pax'] + $datos['pax2']) . "</td>
        
      </tr>
   </table>
   <p><br />
  </p>   


      <table  width='100%' id='tableorder'>
      <tbody><tr id=\"titlett\" height=\"28\"   >
        <td height=\"28\" width=\"34%\"><strong>DEPARTURE DATE:</strong> " . date("F j, Y", strtotime($datos['fecha_salida'])) . "</td>
        <td height=\"28\" width=\"26%\"><strong>TRIP # :</strong>" . $datos['trip_no'] . "</td>
        <td height=\"28\" width=\"40%\"><strong>DEPARTURE TIME :</strong>" . date("g:i a", strtotime($datos['deptime1'])) . "</td>
      </tr>
      <tr>
        <td ><strong>From :</strong>" . $datos['de'] . "</td>
        <td colspan=\"2\"><strong>Pick up Point / Extensions :</strong> " . $datos['placepi1'] . ", " . $datos['addrespi1'] . "  </td>
      </tr>
      <tr>
        <td ><strong>To </strong>:" . $datos['hasta'] . "</td>
        <td colspan=\"2\"><strong>Drop Off / Extensions :</strong> " . $datos['placepo1'] . ", " . $datos['addrespo1'] . " </td>
        </tr>
    </tbody>




  </table>
    <p><br />
  </p>  
    " . (($datos['tipo_ticket'] == "roundtrip") ? "
      <table width='100%' id='tableorder'>
      <tbody><tr id=\"titlett\"  >
        <td height=\"28\"  width=\"34%\"><strong>DEPARTURE DATE:</strong> " . date("M-d-Y", strtotime($datos['fecha_salida'])) . "</td>
        <td height=\"28\"  width=\"26%\"><strong>TRIP # :</strong>" . $datos['trip_no'] . "</td>
        <td height=\"28\"  width=\"40%\"><strong>DEPARTURE TIME :</strong>" . date("g:i a", strtotime($datos['deptime2'])) . "</td>
      </tr>
      <tr>
        <td ><strong>From :</strong>" . $datos['hasta'] . "</td>
        <td colspan=\"2\"><strong>Pick up Point / Extensions :</strong> " . $datos['placepi2'] . ", " . $datos['addrespi2'] . "  </td>
      </tr>
      <tr>
        <td ><strong>To </strong>:" . $datos['de'] . "</td>
        <td colspan=\"2\"><strong>Drop Off / Extensions :</strong> " . $datos['placepo2'] . ", " . $datos['addrespo2'] . " </td>
        </tr>
    </tbody>
     </table>  <p><br />
  </p>  " : "") . "
    </td>
  </tr>
  <tr>
    <td colspan='4'><table border='0' width='100%'  cellpadding='3' id='tableorder'>
      <tr>
        <td height='29' colspan='5' align='center'  id='titlett'><strong>COST SUMMARY</strong></td>
      </tr>
      <tr>
        <td height='31' colspan='5' align='center' id='titlell'>" . $datos['tipo_ticket'] . " Transportation from <b>" . $datos['de'] . " </b>to <b>" . $datos['hasta'] . "</td>
      </tr>
      <tr >
        <td width='7%' height='30'></td>
        <td width='17%'>Adults</td>
        <td id='titlell' width='53%'>" . $datos['tipo_ticket'] . " Regular Ticket Rate Express Service </td>
        <td id='titlelp' width='11%'>$ " . number_format($datos['precioA'], 2, '.', '') . "  </td>
        <td id='titlelp' width='12%'>$ " . number_format(($datos['precioA'] * $datos['pax']), 2, '.', '') . " </td>
      </tr>
      <tr>
        
         
        <td height='27'></td>
        <td>Children (3-9 Years)</td>
        <td id='titlell'>Round TripRegular Ticket Rate Express Service</td>
        <td id='titlelp' width='11%'>$ " . number_format($datos['precioN'], 2, '.', '') . "  </td>
        <td id='titlelp' width='12%'>$ " . number_format(($datos['precioN'] * $datos['pax2']), 2, '.', '') . " </td>
             
      </tr>
       <tr>
        <td height='27'></td>
        <td>&nbsp;</td>
        <td id='titlell'> Pick up Point /Drop Off - Extension </td>
        <td id='titlelp'>$ " . number_format($exteXpax, 2, '.', '') . "</td>
        <td id='titlelp'>$ " . number_format($totalExten, 2, '.', '') . " </td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td id='titlell'>Taxes and Fees</td>
        <td id='titlelp'>$ " . number_format($fee, 2, '.', '') . "</td>
        <td id='titlelp'>$ " . number_format($fee, 2, '.', '') . " </td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td  id='titlelr' align='center' > TOTAL AMOUNT PAID </td>
		<td id='titlelr' colspan='1' >&nbsp;</td>
        <td id='titlelr' colspan='1' ><strong>$ " . $datos['totaltotal'] . "  </strong></td>
      </tr>
    </table>
    

     
      <h4><span style='color: #326AC0'>Comentarios:</span>&nbsp;
      </h4><span style='color:rgb(223, 44, 44);'>".$datos["comments"]."</span>
    <p>Please print and present this e-ticket to board the bus<br />
          Please arrive at departure point 30 minutes before the scheduled time 
    </p>    

    <p>&nbsp;</p>
    <p>Non-refundable - non-transferable - no changes are allowed on dates or time of departure - no pets allowed on board -<br />
      luggage restrictions apply - Please read the terms of transportation at www.supertours.com<br />
      THANK YOU FOR CHOOSING US<br />
      HAVE A NICE TRIP<br />
      SUPER TOURS OF ORLANDO,Inc. 5419 International Drive, Orlando Fl. 32819<br />
      Phone: (407) 370-3001 / U.S.A. TOLL FREE 1-800-251-4206 / reservations@supertours.com
    
    </p></td>
  </tr>
  <tr>
    <td colspan='4' align='center'> <p align='center' class='titulopago'> 
    
</p>       </td>

  </tr>
  </table>
</div>";
        Doo::loadHelper("DooPDF");
        $pdf = new DooPDF('E-TICKET(' . $datos['codconf'] . ').pdf', $page);
        $pdf->doPDF();
    }

    public function formatoMDTours() {
        if (!isset($_SESSION['uagency'])) {
            return Doo::conf()->APP_URL;
        }
        $id = $this->params["id"];

        $sql = "SELECT t3.company_name,t1.comments,t1.id_hotel_reserve,t1.total,t1.otheramount,t1.id,t1.adult,t1.child,t1.estado,t1.code_conf,t1.id_reserva,t1.id_transfer_in,t1.id_transfer_out,t2.username,t2.firstname,t2.lastname,t2.phone,t2.celphone FROM tours t1 
                          left join clientes t2 on (t1.id_client = t2.id)
                          left join agencia t3 on (t1.id_agency = t3.id)
                WHERE t1.id = ? ";
        $rs = Doo::db()->query($sql, array($id));
        $titulo = 'MULTI DAY TOUR CONFIRMATION';
        $datos = $rs->fetch();
        $totalpax = $datos['adult'] + $datos['child'];
        $fee = $datos['totaltotal'] - $datos['total2'];
        $exteXpax = $datos['precio_e1'] + $datos['precio_e2'] + $datos['precio_e3'] + $datos['precio_e4'];
        $totalExten = $exteXpax * $totalpax;

        if ($datos["id_transfer_in"] != -1) {
            $sql_in = "select * from transfer where id = ?";
            $rs_in = Doo::db()->query($sql_in, array($datos["id_transfer_in"]));
            $datos_in = $rs_in->fetch();
            $s_arrival = $datos_in["type"];
        }
        if ($datos["id_transfer_out"] != -1) {
            $sql_out = "select * from transfer where id = ?";
            $rs_out = Doo::db()->query($sql_in, array($datos["id_transfer_out"]));
            $datos_out = $rs_out->fetch();
            $s_departure = $datos_in["type"];
        }
        if ($datos["id_reserva"] != -1) {
            $reserva = "select t1.trip_no,t1.trip_no2,t1.deptime1,t1.deptime2,t1.arrtime1,
                         t1.arrtime2,t1.fecha_salida,t1.fecha_retorno,t2.nombre AS de,
                         t3.nombre AS  hasta, t4.place as placepo1, t4.address as addrespo1
                                                                        , t5.place as placepo2, t5.address as addrespo2
                                                                        , t6.place as placepi1, t6.address as addrespi1
                                                                        , t7.place as placepi2, t7.address as addrespi2
                                                                        from reservas t1  LEFT JOIN areas t2 ON (t1.fromt = t2.id)
						      LEFT JOIN areas t3 ON (t1.tot = t3.id) 
                                                      LEFT JOIN pickup_dropoff t4 ON (t1.dropoff1 = t4.id)
                                                      LEFT JOIN pickup_dropoff t5 ON (t1.dropoff2 = t5.id)
                                                      LEFT JOIN pickup_dropoff t6 ON (t1.pickup1 = t6.id)
                                                      LEFT JOIN pickup_dropoff t7 ON (t1.pickup2 = t7.id)
                                                      where t1.id = ?";
           
            $rs_r = Doo::db()->query($reserva, array($datos["id_reserva"]));
            $datos_reserva = $rs_r->fetch();
            $s_arrival = 1;
            $s_departure = 1;
        }
//        print_r($datos_reserva);
//        exit;
        $sql_h = "select t2.nombre as hotel,t2.breakfast,t1.buffet,t1.roooms,t1.nights,t1.days,t1.starting_date,t1.ending_date from hotel_reserves t1 left join hoteles t2 on (t1.id_hotel = t2.id) where t1.id = ?";
        $rs_h = Doo::db()->query($sql_h, array($datos["id_hotel_reserve"]));
        $datos_hotel = $rs_h->fetch();
        
        $sql_park = "SELECT t2.nombre,t1.admission FROM attraction_trafic t1 LEFT JOIN parques t2 ON (t1.id_park = t2.id) WHERE t1.id_tours = ?";
        $rs_park = Doo::db()->query($sql_park, array($id));
        $datos_park = $rs_park->fetchAll();
        $npark = "";
        foreach ($datos_park as $value) {
            $npark .= "<li>" . $value["nombre"] . "</li>";
            $admision = $value['admission'];            
        }
       
        $page = "<title>Reservations Super Tours OF Orlando�?</title>
<style type='text/css'>
    #clearTable {
        width: 1024px;
        font-size: 13px;
        font-family: Verdana, Geneva, sans-serif;
        margin: 0 auto;
    }
    #clearTable tr #titletd3 {
        font-family: Verdana, Geneva, sans-serif;
    }
    #clearTable tr #titletd2 {
        font-size: 20px;
    }
    #clearTable tr td p {
        
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
        font-size: 12px;
        height: 30px;
        padding: 5px;
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
</style>
</head>
<div align='center'>
    <table   id='clearTable' > 
        <tr>
            <td width='316' height='33' rowspan='3' id='titletd3'><img src='" . Doo::conf()->APP_URL . "Logo-Supertours-mail.jpg' width='316' height='88' /></td>
            <td colspan='3' align='center' id='titletd3'>Supertours.com</td>
        </tr>
        <tr>
          <td height='50' colspan='3' id='titletd7'>Date:" . date("M-d-Y") . " / Hora:" . date("g:i A") . " </td>
        </tr>
        <tr>
            <td height='41' colspan='3' id='titletd4'>Agency : <span style='color: #AD2829'>" . $datos['company_name'] . "</span></td>
        </tr>
        <tr>
            <td align='center' height='25' colspan='4' id='titletd2'> <h3>" . $titulo . "</h3></td>
        </tr>
        <tr>
            <td height='15' id='titletd6'>LEAD TRAVELER:
                <br/><br/>
                <strong>User Name: </strong>" . $datos['username'] . "
                <br/><br/>
                <strong>First Name: </strong>" . $datos['firstname'] . "
                <br/><br/>
                <strong>Last Name: </strong>" . $datos['lastname'] . "
                <br/><br/>
                <strong>Phone: </strong>" . $datos['phone'] . "
                <br/><br/>
                <strong>Cellphone: </strong>" . $datos['celphone'] . "    

            </td>
            <td width='145' height='15' id='titletd6'>&nbsp;</td>
            <td colspan='2' id='titletd6'><strong>AD :</strong>" . $datos["adult"] . " <strong>CHD :</strong>" . $datos["child"] . "  <strong> TOTAL :</strong>" . $totalpax . "<br/><br/><strong>Status :</strong> " . $datos["estado"] . "<br/><br/><strong> Code Quotation :</Strong> " . $datos['code_conf'] . "</td>
        </tr>
        <tr>
            <td height='18' colspan='4' id='titletd' style='text-align: center;'> <p><strong>ORDER&nbsp;  QUOTATION</strong></p></td>
        </tr>
        <tr><td colspan='3'>Your trip will include:
                <table style='width: 1024px;' height='90' id='tableorder'>
                    <tr>
                        <td height='35' colspan='3' id='titlett'  ><strong > ITINERARY ARRIVAL</strong></td>
                    </tr>
                    <tr>
                        <td height='47' colspan='3'><p>"
                                . (($s_arrival == 1) ? " Bus Transportation on Trip <strong>" . $datos_reserva["trip_no"] . "</strong>, <strong>" . date("M-d-Y", strtotime($datos_reserva['fecha_salida'])) . "</strong> &#45; Pick up time <strong>" . date("g:i A", strtotime($datos_reserva['deptime1'])) . "</strong> &#45; from <strong>" . $datos_reserva["de"] . '-' . $datos_reserva["placepo1"] . ", " .$datos_reserva["addrespo1"]. "</strong>, to <strong>".$datos_reserva["placepo2"]."</strong>, arriving at <strong>" . date("h:s A", strtotime($datos_reserva['arrtime1'])) . "</strong> , you will be greeted by your tour guide/driver in Orlando.
                            
                            
                            <strong > <div align='left' id='titlett'> ACCOMMODATION</div></strong>
                            
                            <p>Hotel <strong>" . $datos_hotel['hotel'] . "</strong> or SIMILAR: <strong><span style='color:red;'>REQUESTED/PENDING</span></strong></p>
                            <p>You will receive a final confirmation of the hotel or similar in less than 24 hours by e-mail.</p>

                            Hotel accommodation at the <strong>" . $datos_hotel['hotel'] . " or SIMILAR</strong> in <strong>" . $datos_hotel['roooms'] . "</strong> room(s). for <strong>" . $datos_hotel['nights'] . "</strong> night(s) from <strong>" . date("M-d-Y", strtotime($datos_hotel['starting_date'])) . "</strong> Check In Time is 4:00pm . To
                            <strong>" . date("M-d-Y", strtotime($datos_hotel['ending_date'])) . "</strong> Check Out Time is 11:00am." . (( $datos_hotel["breakfast"] != 0) ? " FREE DAILY CONTINENTAL BREKFAST " : "") . " Taxes are Included.
                            <br>" . (($datos_hotel["buffet"] == 1 ) ? "<br><br>Daily SUPER BREKFAST BUFFET at your hotel." : "") . "<br>
                            
                            <strong > <div align='left' style='text-decoration: underline' id='titlett'> TRANSFERS & THEME PARKS INCLUDED ARE:</div></strong>
                            Round trip daily transportation from your Hotel to
                            <ul>" . $npark . "</ul>" . (($admision == 1) ? "<strong>Admissions to Theme Parks ARE INCLUDED.</strong>" : "<strong>Admissions to Theme Parks are NOT INCLUDED.</strong>") . "" : "")
                            . (($s_arrival == 2) ? "Date Arrival <strong>" . date("M-d-Y", strtotime($datos_hotel['starting_date'])) . "</strong> &#45;you have choosen <strong>" . date("h:s A", strtotime($datos_in["arrival_time"])) . "</strong>, on a luxury private transportation from <strong>" . $datos_in['city'] . "</strong>, <strong>" . $datos_in['address'] . "</strong> ,<strong></strong> to <strong>" . $datos_hotel['hotel'] . "</strong><hr><strong > <div align=\"left\" > ACCOMMODATION</div></strong><br>Hotel accommodation at the <strong>" . $datos_hotel['hotel'] . "</strong> in <strong>" . $datos_hotel['roooms'] . "</strong> room(s). for <strong>" . $datos_hotel['nights'] . "</strong> night(s) from <strong>" . date("M-d-Y", strtotime($datos_hotel['starting_date'])) . "</strong> Check In Time is 4:00pm . To<strong>" . date("M-d-Y", strtotime($datos_hotel['ending_date'])) . "</strong> Check Out Time is 11:00am." . (($datos_hotel["breakfast"] != 0) ? " FREE DAILY CONTINENTAL BREKFAST. " : "") . "Taxes are Included.<br>" . (($datos_hotel["buffet"] == 1 ) ? "<br><br>Daily SUPER BREKFAST BUFFET at your hotel." : "") . "<br><hr><br><strong > <div align=\"left\" > LOCAL TRANSFERS TO PARKS</div></strong>
                            <strong>" . date("M-d-Y", strtotime($datos_hotel['starting_date'])) . "</strong> Check Out Time is 11:00am." . (($datos_hotel["breakfast"] != 0) ? " FREE DAILY CONTINENTAL BREKFAST. " : "") . "Taxes are Included.<br>" . (($datos_hotel["buffet"] == 1 ) ? "<br><br>Daily SUPER BREKFAST BUFFET at your hotel." : "") . "<br><hr><br><strong > <div align=\"left\" > LOCAL TRANSFERS TO PARKS</div></strong>
                            Round trip daily transportation from your Hotel to
                            <ul>" . $npark . "</ul>" . (($admision == 1) ? "<strong>Admissions to Theme Parks ARE INCLUDED.</strong>" : "<strong>Admissions to Theme Parks are NOT INCLUDED.</strong>") . "
                            " : "")
                            . (($s_arrival == 3) ? "<br />Date Arrival <strong>" . $datos_hotel['starting_date'] . "</strong> &#45; Arriving: By plane  at Orlando International Airport 
                            Data Transfer In  :   Airline: <strong>" . $datos_in["airlie"] . "</strong>   Flight #:   <strong>" . $datos_in["flight"] . "</strong> Arrival Time:<strong>" . date("h:s A", strtotime($datos_in['arrival_time'])) . "</strong>
                            . You will be greeted by your tour guide/driver in orlando to take you to  <strong>" . $datos_hotel['hotel'] . "
                                <strong > <div align='left' id=\"titlett\"> ACCOMMODATION</div></strong><br>
                                Hotel accommodation at the <strong>" . $datos_hotel['hotel'] . "</strong> in <strong>" . $datos_hotel['roooms'] . "</strong> room(s). for <strong>" . $datos_hotel['nights'] . "</strong> night(s) from <strong>" . date("M-d-Y", strtotime($datos_hotel['starting_date'])) . "</strong> Check In Time is 4:00pm . To
                                <strong>" . date("M-d-Y", strtotime($datos_hotel['ending_date'])) . "</strong> Check Out Time is 11:00am." . (( $datos_hotel["breakfast"] != 0) ? " FREE DAILY CONTINENTAL BREKFAST. " : "") . " Taxes are Included.
                                <br>" . (($datos_hotel["buffet"] == 1 ) ? "<br><br>Daily SUPER BREKFAST BUFFET at your hotel." : "") . "<br>
                                
                                <strong > <div align='left' style='text-decoration: underline' id='titlett'> TRANSFERS & THEME PARKS INCLUDED ARE:</div></strong>
                                Round trip daily transportation from your Hotel to<ul>" . $npark . "</ul>" . (($admision == 1) ? "<strong>Admissions to Theme Parks ARE INCLUDED.</strong>" : "<strong>Admissions to Theme Parks are NOT INCLUDED.</strong>") . "" : "")
                                . (($s_arrival == 4) ? "<br />
                                Date Arrival <strong>" . date("M-d-Y", strtotime($datos_hotel['starting_date'])) . "</strong> PLEASE, LET US KNOW ABOUT YOUR ARRIVAL TO ORLANDO BY  DIALING  OUR TOLL FREE 1800-251-4206, TO PLACE YOUR TICKETS AT  <strong>" . $datos_hotel['hotel'] . "</strong> OR FIGURE OUT ABOUT OTHER SERVICES. WE WILL PLEASED TO ASSIST YOU. 
                                
                                <strong > <div align='left' id='titlett'> ACCOMMODATION</div></strong><br>

                                Hotel accommodation at the <strong>" . $datos_hotel['hotel'] . " or SIMILAR</strong> in <strong>" . $datos_hotel['roooms'] . "</strong> room(s). for <strong>" . $datos_hotel['nights'] . "</strong> night(s) from <strong>" . date("M-d-Y", strtotime($datos_hotel['starting_date'])) . "</strong> Check In Time is 4:00pm . To
                                <strong>" . date("M-d-Y", strtotime($datos_hotel['ending_date'])) . "</strong> Check Out Time is 11:00am." . (( $datos_hotel["breakfast"] != 0) ? " FREE DAILY CONTINENTAL BREKFAST. " : "") . " Taxes are Included.
                                <br>" . (($datos_hotel["buffet"] == 1 ) ? "<br><br>Daily SUPER BREKFAST BUFFET at your hotel." : "") . "<br>
                              
                                <strong > <div align='left' style='text-decoration: underline' > TRANSFERS & THEME PARKS INCLUDED ARE:</div></strong>
                                <ul>" . $npark . "</ul>" . (($admision == 1) ? "<strong>Admissions to Theme Parks ARE INCLUDED.</strong>" : "<strong>Admissions to Theme Parks are NOT INCLUDED.</strong>") . "<hr>" : "") . "
                                </p>


                                <p>" . (($s_departure == 1) ? "<strong > <div align=\"left\" id=\"titlett\"> ITINERARY DEPARTURE</div></strong><br>
                                    Bus Transportation  on Trip <strong>" . $datos_reserva["trip_no2"] . "</strong>, <strong>" . date("M-d-Y", strtotime($datos_reserva['fecha_retorno'])) . "</strong> &#45; <strong>" . date("h:s A", strtotime($datos_reserva['deptime2'])) . "</strong> &#45;  from Orlando Super Tours Terminal to <strong>". $datos_reserva["de"] ." - ".$datos_reserva["placepi2"].", ".$datos_reserva["addrespi2"]." </strong> arriving at approximately <strong>" . date("h:s A", strtotime($datos_reserva ['arrtime2'])) . ".</strong>  <br />
                                    " : "") . (($s_departure == 2) ? "<strong > <div align=\"left\" id=\"titlett\"> ITINERARY DEPARTURE</div></strong>
                                    <br>Date departure <strong>" . $datos_hotel['ending_date'] . "</strong> &#45; Drop Off Time:  <strong>" . date("h:s A", strtotime($datos_out['arrival_time'])) . "</strong>, on a luxury private transportation from <strong>" . $datos_out['city'] . "</strong>, <strong>" . $datos_out['address'] . "</strong>, to MIAMI 
                                    <br />
                                    " : "") . (($s_departure == 3) ? "<strong > <div align=\"left\" id=\"titlett\"> ITINERARY DEPARTURE</div></strong>
                                    <br>
                                    Date departure <strong>" . date("M-d-Y", strtotime($datos_hotel['ending_date'])) . "</strong>  &#45; Departure: By Plane at Orlando International Airport 
                                    Data Transfer Out:   Airline: <strong>" . $datos_out['airlie'] . "</strong>   Flight #:   <strong>" . $datos_out['flight'] . "</strong> Arrival Time: <strong>" . date("h:s A", strtotime($datos_out['arrival_time'])) . "</strong>
                                    <br />
                                    " : "") . (($s_departure == 4) ? "<strong > <div align=\"left\" id=\"titlett\"> ITINERARY DEPARTURE</div></strong>
                                    <br>
                                    Date departure <strong>" . date("M-d-Y", strtotime($datos_hotel['ending_date'])) . "</strong> <br> Departure: By Car   

                                    <br />
                                    " : "") . "

                                    <br />
                                </p></td>
                    </tr>
                </table>

            </td>
        </tr>
        <tr>
          <td height='23' colspan='4' id='titletd5' ><h4><span style='color: #326AC0'>Comentarios:</span>&nbsp; </h4>
          <span style='color:rgb(223, 44, 44);'>".$datos["comments"]."</span></td>
        </tr>
        <tr>
            <td height='23' colspan='4' id='titletd' ><strong style='text-decoration: underline'>PRICE</strong></td>
        </tr>
        <tr>
            <td height='' colspan='4' align='center'>
            <table width='100%' border='0'>
                    <tr>
                        <td height='23' align='center'><strong>The total amount for your tour is:</strong> <span id='tqprice' >$" .
                                (($datos["otheramount"] == 0) ? ( ($datos ['total'] )) : $datos["otheramount"])
                                . "</span> </td>
                    </tr>
                    <tr>
                        <td height='20' align='center' ><span class='Estilo1'>VERIFY YOUR TOUR BEFORE PROCEEDING CLICKING ON PAY TOUR</span></td>
                    </tr>
                    <tr>
                        <td height='38' align='center'>Once you click on PAY TOUR, you can no longer make any changes or modifications.  For questions or assistance you may call (407) 370-3001 and speak with one of our Call Center Representative.</td>
              </tr>
                </table>
                Any or all unused services are Non-Refundable - Non-Transferable - Modification in Travel Dates are not permitted. 
                Luggage restrictions apply - Please read the terms of transportation at <a href='https://www.supertours.com'>www.supertours.com</a><span style='text-align:center;'>
                </span>
                <span style='text-align:center;'>
                THANK YOU FOR CHOOSING SUPER TOURS OF ORLANDO! HAVE A SUPER TRIP!
                        <strong>SUPER TOURS OF ORLANDO, Inc.</strong> 
                        5419 International Drive, Orlando Fl. 32819
                        Phone: (407) 370-3001 / U.S.A. TOLL FREE 1-800-251-4206 
                        reservations@supertours.com
                </span>
                </p></td>
      </tr>
    </table>
</div>";
//        echo $page;
//        exit;
        Doo::loadHelper("DooPDF");
        $pdf = new DooPDF('E-TICKET-Tours(' . $datos['code_conf'] . ').pdf', $page);
        $pdf->doPDF();
    }

    public function formatoOneTours() {
        if (!isset($_SESSION['uagency'])) {
            return Doo::conf()->APP_URL;
        }
        Doo::loadModel("Attraction_Trafic");
        $atractions = new Attraction_Trafic();

        $id = $this->params["id"];

        $sql = "SELECT t.*,t10.company_name,t1.id_tours,	t1.type_tour, 	 t1.fecha_ini,t1.trip_no,t8.equipment as equipment1,t1.trip_no2,t9.equipment as equipment2,t1.tipo_ticket,t1.fromt,t1.tot,t1.firsname,t1.lasname,t1.email,t1.fecha_salida,t1.fecha_retorno,t1.pax,
        t1.pax2,t1.id_clientes,t1.extension1, t1.precio_e1, t1.extension2, t1.precio_e2, t1.extension3, t1.precio_e3, 	t1.extension4, t1.precio_e4,t1.pickup1,t1.dropoff1,t1.pickup2,t1.dropoff2,t1.tipo_pago,t1.totaltotal,t1.total2,t1.codconf,t1.hora,t1.comments,t1.agen,t1.tipo_client
								 ,t2.nombre AS de, t3.nombre AS  hasta,t1.deptime1,t1.deptime2,precioA,precioN,resident,t1.arrtime1,t1.arrtime2
                                                                        , t4.place as placepo1, t4.address as addrespo1
                                                                        , t5.place as placepo2, t5.address as addrespo2
                                                                        , t6.place as placepi1, t6.address as addrespi1
                                                                        , t7.place as placepi2, t7.address as addrespi2
									FROM tours_oneday t
									LEFT JOIN reservas t1 ON (t1.id_tours = t.id)
									LEFT JOIN areas t2 ON (t1.fromt = t2.id)
									LEFT JOIN areas t3 ON (t1.tot = t3.id)
                                    LEFT JOIN pickup_dropoff t4 ON (t1.dropoff1 = t4.id)
                                    LEFT JOIN pickup_dropoff t5 ON (t1.dropoff2 = t5.id)
                                    LEFT JOIN pickup_dropoff t6 ON (t1.pickup1 = t6.id)
                                    LEFT JOIN pickup_dropoff t7 ON (t1.pickup2 = t7.id)
                                    
                                                                        left join trips t8 on(t1.trip_no = t8.trip_no)
                                                                        left join trips t9 on(t1.trip_no2 = t9.trip_no)
                                                                        left join agencia t10 on (t.id_agency = t10.id)
									WHERE t.id = ?	AND t1.type_tour = 'ONE'						
 																			 ";
        $rs = Doo::db()->query($sql, array($id));

        $datos = $rs->fetch();
//        print_r($datos);
//        exit;
        //Cargamos Actractions
        $atracciones = $atractions->parque_one_days($id);
        Doo::loadModel("Clientes");
        $cliente = new Clientes();
        $cliente->id = $datos["id_client"];
        $cliente = Doo::db()->getOne($cliente);

        $totalpax = $datos['pax'] + $datos['pax2'];
        $fee = $datos['totaltotal'] - $datos['total2'];
        $exteXpax = $datos['precio_e1'] + $datos['precio_e2'] + $datos['precio_e3'] + $datos['precio_e4'];
        $totalExten = $exteXpax * $totalpax;
        $page = "<style type='text/css'>
    #clearTable {
        width: 90%;
        font-size: 13px;
        font-family: Verdana, Geneva, sans-serif;
        margin: 0 auto;
    }
    #clearTable tr #titletd3 {
        font-family: Verdana, Geneva, sans-serif;
    }
    #clearTable tr #titletd2 {
        font-size: 20px;
    }
    #clearTable tr td p {
        /*text-align: center;*/
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
</style>
</head><div align='center'>
    <br />
    <table   id='clearTable' width='100%'> 
        <tr>
            <td width='499' height='33' rowspan='3' id='titletd3'><img src='" . Doo::conf()->APP_URL . "Logo-Supertours-mail.jpg' width='316' height='88' /></td>
            <td width='358' colspan='3' align='center' id='titletd3'>Supertours.com</td>
        </tr>
        <tr>
          <td height='35' colspan='3' id='titletd12'>Fecha:" . date("M-d-Y") . " / Hora:" . date("g:i A") . "</td>
        </tr>
        <tr>
            <td height='35' colspan='3' id='titletd4'>Agency : <span style='color: #AD2829'>" . $datos['company_name'] . "</span></td>
        </tr>
        <tr>
            <td align='center' height='33' colspan='4' id='titletd2'> <h3>ONE DAY TOUR CONFIRMATION</h3></td>
        </tr>
        <tr>
          <td height='15' id='titletd5'>LEAD TRAVELER: </td>
          <td colspan='2' id='titletd5'>&nbsp;</td>
        </tr>
        <tr>
          <td height='15' id='titletd7'><strong>User Name: </strong>" . $datos['email'] . " </td>
          <td colspan='2' id='titletd7'><strong>AD :</strong>" . $datos['adult'] . " <strong>CHD :</strong>" . $datos['child'] . " <strong> TOTAL :</strong>" . $totalpax . "</td>
        </tr>
        <tr>
          <td height='15' id='titletd8'><strong>Firstname: </strong>" . $datos['firsname'] . " </td>
          <td colspan='2' id='titletd8'><strong>Status :</strong> " . $datos["estado"] . " </td>
        </tr>
        <tr>
          <td height='15' id='titletd9'><strong>Lastname: </strong>" . $datos['lasname'] . "</td>
          <td colspan='2' id='titletd9'><strong>Code CONFIRMATION :</Strong> " . $datos["code_conf"] . "</td>
        </tr>
        <tr>
          <td height='15' id='titletd10'><strong>Phone: </strong> " . $cliente->phone . " </td>
          <td colspan='2' id='titletd10'>&nbsp;</td>
        </tr>
        <tr>
          <td height='15' id='titletd11'><strong>Cellphone: </strong> " . $cliente->celphone . " </td>
          <td colspan='2' id='titletd11'>&nbsp;</td>
        </tr>
        <tr>
            <td height='45' colspan='4' id='titletd'> <p style='text-align: center;'><strong>ORDER&nbsp;  QUOTATION</strong></p></td>
        </tr>
        <tr>
            <td colspan='3'>
                <table width='100%' height='90' id='tableorder'>
                    <tr>
                        <td height='35' colspan='3' id='titlett'  ><strong ><div align='left' > ITINERARY ARRIVAL</div></strong></td>
                    </tr>
                    <tr>
                        <td height='47' colspan='3'>
                            <p>" . ( " Date Arrival <strong>" . date("M-d-Y", strtotime($datos['fecha_salida'])) . "</strong> &#45; Pick up time <strong>" . date("g:i A", strtotime($datos['deptime1'])) . "</strong> &#45; Trip <strong>" . $datos['trip_no'] . "</strong>, Luxury <strong>" .$datos['equipment1']. "</strong> &#45;  transportation from <strong>" . $datos["de"] . ' - ' . $datos["placepo1"] . ", " . $datos["addrespo1"] . "</strong>, to Super Tours of orlando Terminal, arriving at <strong>" . date("h:i A", strtotime($datos['arrtime1'])) . "</strong> , you will be greeted by your tour guide/driver in Orlando. <br>
                            <div align='left'id='titlett' style='padding:10px;' ><strong> LOCAL TRANSFERS TO PARKS</strong></div>
                            Local Round Trip Transfers from Super Tours Orlando Terminal to<br>
                            <ul><li>" . $atracciones["nombre"] . "</li></ul>" . (($datos["include_park"] == 1) ? "<strong>Includes tickets to parks.</strong>" : "<strong>Not includes tickets to parks.</strong>") ) . "
                            </p>
                            <p>" . ("<strong > <div align='left' id='titlett' style='padding:10px;'> ITINERARY DEPARTURE</div></strong><br>
                                Date departure <strong>" . date("M-d-Y", strtotime($datos['fecha_retorno'])) . "</strong> &#45; <strong>" . date("h:s A", strtotime($datos['deptime2'])) . "</strong> &#45;  Trip <strong>" . $datos['trip_no2'] . "</strong>, Luxury <strong>" .$datos['equipment2']. "</strong> &#45;  transportation from Orlando Super Tours Terminal to  <strong> " . $datos["de"] . ' - ' . $datos["placepo2"] . ", " . $datos["addrespo2"] . " </strong> arriving at <strong>" . date("h:i A", strtotime($datos['arrtime2'])) . "</strong>, Thank you for choosing us !. <br />
                                " ) . "

                                <br />
                                <br />
                            </p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
          <td height='33' colspan='4' id='titletd6' ><h4><span style='color: #326AC0'>Comentarios:</span>&nbsp; </h4>
          <span style='color:rgb(223, 44, 44);'>".$datos["comments"]."</span></td>
        </tr>
        <tr>
            <td height='33' colspan='4' id='titletd' ><strong>PRICE</strong></td>
        </tr>
        <tr>
            <td colspan='4' align='center'>
                <table width='100%' border='0'>
                    <tr>
                        <td height='32' align='center'><strong>TOTAL AMOUNT for THIS TOUR:</strong> <span id='tqprice' >$" . $datos ['total'] . "</span> </td>
                    </tr>
                    <tr>
                        <td height='40' align='center' ><span class='Estilo1'>CHECK YOUR TOUR BEFORE PROCEEDING WITH  PAY TOUR</span></td>
                    </tr>
                    <tr>
                        <td align='center'>Once you select the PAY TOUR button, you can no longer make changes to your TOUR  online. You must call (407) 370-3001 and speak with our  Call Center.<br /></td>
                    </tr>
                </table>
                <p>Non-refundable - non-transferable - no changes are allowed on dates or time of departure - no pets allowed on board -<br />
                    luggage restrictions apply - Please read the terms of transportation at www.supertours.com<br />
                    THANK YOU FOR CHOOSING US<br />
                    HAVE A NICE TRIP<br />
                    SUPER TOURS OF ORLANDO,Inc. 5419 International Drive, Orlando Fl. 32819<br />
                    Phone: (407) 370-3001 / U.S.A. TOLL FREE 1-800-251-4206 / reservations@supertours.com                </p>
            </td>
        </tr>
    </table>
</div>";
        
        Doo::loadHelper("DooPDF");
        $pdf = new DooPDF('E-TICKET-OneDayTours(' . $datos['codconf'] . ').pdf', $page);
        $pdf->doPDF();
    }

}

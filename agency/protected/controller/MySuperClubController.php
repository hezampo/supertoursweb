<?php

/**
 * MySuperClub Controller.
 * By Andrew Fraser.
 * Last Change: 02:14 p.m. 10/09/2012.
 */
Doo::loadController('I18nController');

class MySuperClubController extends DooController {

    public $data;
    public $points;
    public $discountvalid = 0;

    public function index() {
        try {
            $this->data['rootUrl'] = Doo::conf()->APP_URL;
            $this->data["error"] = " ";

            if (!isset($_SESSION["user"])) {
                $this->renderc('mysuperclub/myscLogin', $this->data);
            } else {
                Doo::loadModel("Clientes");
                $user = unserialize($_SESSION["user"]);
                $this->getUserData($user->id);
                $this->renderc('mysuperclub/myscIndex', $this->data);
            }
        } catch (Exception $e) {
            echo $e;
        }
    }

    /*
      Restrives all the current user information. (code reuse)
     */

    public function getUserData($id) {
        try {
            if (!empty($id)) {
                //Devuelve la lista de reservas que ha hecho el cliete.
                $rs_trip = Doo::db()->query("CALL sp_cliente_trips($id)");
                $this->data['trips'] = $rs_trip->fetchAll();
                $rs_trip->closeCursor();

                /*
                 * Identifica cual fue la ultima reseva que se hizo despues del ultimo bono.
                 */
                $rs_reward = Doo::db()->query("CALL sp_has_rewards($id)");
                $ntrips = $rs_reward->fetchAll();
                $rs_reward->closeCursor();

                if (count($ntrips) >= 10) {
                    $this->data["reward"] = $this->getRewardByRerserves();
                } else {
                    $this->data["reward"] = 0;
                }

                // Obtiene la lista de bonos que no han sido redimidos por el usuario actual.
                $rs = Doo::db()->query("SELECT * FROM client_bonos WHERE client_id = '$id'");
                $this->data["cliente_bono"] = $rs->fetchAll();

                // Obtiene la lista de ofertas acutuales.
                $rs_reward = Doo::db()->query("CALL sp_get_ofertas");
                $ofertas = $rs_reward->fetchAll();
                $rs_reward->closeCursor();
                $this->data["ofertas"] = $ofertas;

                //obtener el tiempo faltante para el cumpleaños.
                $now = time();

                Doo::loadModel("Clientes");
                $user = unserialize($_SESSION["user"]);

                $birthday = $user->birthday;

                $my_time = strtotime($birthday);
                $diff_time = $left_time = $now - $my_time;

                //time = time/seconds.
                $left_day = floor($diff_time / 86400);
                $left_time = $left_time % 86400;
                $left_hour = floor($left_time / 3600);
                $left_time = $left_time % 3600;
                $left_minute = floor($left_time / 60);
                $left_time = $left_time % 60;
                $left_seconds = floor($left_time / 60);

                $this->data["days"] = $left_day;
                $this->data["hours"] = $left_hour;
                $this->data["minutes"] = $left_minute;
                $this->data["seconds"] = $left_seconds;

                /* Datos para el booking */
            }

            $this->data['state'] = Doo::db()->find("State", array("select name from State", "asArray" => true));
            $this->data['country'] = Doo::db()->find("Country", array("select name from Country", "asArray" => true));
            $this->data["rootUrl"] = Doo::conf()->APP_URL;
            $this->data["error"] = "";
        } catch (Exception $e) {
            echo $e;
        }
    }

    /*
     * Restrive all the information about the current user 
     */

    public function login() {
        try {
            if (!isset($_SESSION["user"])) {
                if ($_POST) {

                    extract($_POST,EXTR_SKIP);
                    Doo::loadModel("Clientes");
                    $cliente = new Clientes($_POST);
                    $cliente->username = $user;
                    $cliente->password = $pass;
                    $user = Doo::db()->find($cliente, array('limit' => 1));
                    
					if ($user) {
						if($user->tipo_client == 1){
							
							$_SESSION["user"] = serialize($user);
                        	$this->getUserData($user->id);
							
                        	$this->renderc('/mysuperclub/myscIndex', $this->data);
						}else{
							/* bad typiying */
                        	$this->getUserData("");
                        	$this->data["error"] = "You are not a MySuperClub user.";
							
                        	$this->renderc('/mysuperclub/myscLogin', $this->data);
						}
                    } else {
                        /* bad typiying */
                        $this->getUserData("");
                        $this->data["error"] = "User or password incorrect!.";
                        $this->renderc('/mysuperclub/myscLogin', $this->data);
                    }
                } else {
                    /* access from other URI */
                    $this->getUserData("");
                    $this->renderc('/home2', $this->data);
                }
            } else {
                /* already loged */
                Doo::loadModel("Clientes");
                $user = unserialize($_SESSION["user"]);
                $this->getUserData($user->id);
				$this->data["rootUrl"] = Doo::conf()->APP_URL;
                $this->renderc('/mysuperclub/myscIndex', $this->data);
            }
        } catch (Exception $e) {
            echo $e;
            exit();
        }
    }

    /*
     * Redirect to user registration if isnt registered.
     */

    public function singUp() {

        try {
            $this->data['rootUrl'] = Doo::conf()->APP_URL;
            $this->data['state'] = Doo::db()->fetchAll("SELECT * FROM state");
            $this->data['country'] = Doo::db()->fetchAll("SELECT * FROM country");
            $this->data["error"] = "";

            if (!isset($_SESSION["user"])) {
                $this->renderc('/mysuperclub/myscSingUp', $this->data);
            } else {
                Doo::loadModel("Clientes");
                $user = unserialize($_SESSION["user"]);
                $id = $user->id;
                $points = $user->points;

                $sr = Doo::db()->query("CALL sp_cliente_trips($id)");
                $this->data['trips'] = $sr->fetchAll();
                $sr->closeCursor();
                $this->data["rewards"] = $this->getRewards($points);
                $this->renderc('/mysuperclub/myscIndex', $this->data);
            }
        } catch (Exception $e) {
            echo $e;
        }
    }

    /*
     * Get rewards based on points earned.
     */

    public function getRewardsByPoints() {
        try {

            // Muestra la lista de rewards si los puntos restantes son suficientes.
            $points = $this->params["left_points"];
            $rs = Doo::db()->query("SELECT MIN(points) AS min_points FROM rewards");
            $min = $rs->fetch();

            if ($points > 0 && $points >= $min["min_points"]) {

                $rs = Doo::db()->query("SELECT code,reward_ticket,points,ammount_discount FROM rewards");
                $rewards = $rs->fetchAll();

                echo "<select id='rew'>";
                //Compare the curret points against available rewards ponts.
                foreach ($rewards as $reward) {
                    $num = floor($points / (int) $reward["points"]);
                    if ($points >= $reward["points"]) {
                        echo "<option class='op' id='" . $num . "' ammount='" . $reward["ammount_discount"] . "' value='" . $reward["points"] . "' >" . $reward["reward_ticket"] . "</option>";
                    }
                }
                echo "</select>";
                echo "<script>
                        var num = $('#rewards_list option:selected').attr('id');
                        num = Math.round(num);
                        $('#rewards_ammount').load('" . Doo::conf()->APP_URL . "mysuperclub/getReward/'+ num);
                      </script>";
            }
        } catch (Exception $e) {
            echo $e;
        }
    }

    /*
      Get the number of rewards based on points earned.
     */

    public function getRewardsAmmount() {
        try {
            $num = $this->params["num"];

            if ($num > 0) {

                echo "<select id='ra' length='5'>";
                //compare the curret points against available rewards ponts.
                for ($i = 1; $i <= $num; $i++) {
                    echo "<option value='$i'>" . $i . "</option>";
                }
                echo "</select>";
                echo "<script>
                        $('#ra').change(function(){	
                            $('#reward_points').val($('#rewards_list option:selected').attr('value'));
                            $('#ram').val($('#ra option:selected').attr('value'));
                            $('#nombre').val($('#rewards_list option:selected').text());
                            $('#regla').val('points');
                            $('#ammount_discount').val($('#rewards_list option:selected').attr('ammount'));
                            var total_ammount = parseInt($('#reward_points').val()) * parseInt($('#ra').val());
                            $('#total_ammount').val(total_ammount);
			    			var discount = parseFloat($('#ra').val()) * parseFloat($('#ammount_discount').val());
                            $('#discount').val(discount);
                        });
                      </script>";
            } else {
                $this->data["error"] = "10";
            }
        } catch (Exception $e) {
            echo $e;
        }
    }

    /* Retrives a random index in rewards when reserves >= 10 */

    public function getRewardByRerserves() {
        try {
            $rs = Doo::db()->query("SELECT *, RAND() AS rnd FROM rewards ORDER BY Rnd LIMIT 1");
            $rs->fetch();
            return $this->data["reward"] = $rs;
        } catch (Exception $e) {
            echo $e;
        }
    }

    public function getExchangedRewards() {
        try {
            Doo::loadModel("Clientes");
            $user = unserialize($_SESSION["user"]);
            $this->getUserData($user->id);
            $bonos = $this->data["cliente_bono"];

            if (count($bonos) > 0) {
                echo "<ul>";
                foreach ($bonos as $bono) {
                    $id = $bono["bono_id"];
                    $descuento = $bono["discuont_value"];

                    echo
                    "<li id='$id' descuento = '$descuento'>
                    <table>
                        <tr>
                            <td width='70'>$id</td>
                            <td width='70'>$ $descuento</td>
                            <td width='70'><div id='btn_redeem' class='redeem' ><span>Redeem!!</span></div></td>
                        </tr>
                    </table>
                    </li>";
                }
                echo "</ul>
                     <script>
                    	$('.redeem').click(function(){
                            $('#form1').submit();
                        });
                      </script>";
            }
        } catch (Exception $e) {
            echo $e;
        }
    }

    public function asad() {
        /*print_r($_POST);*/
    }

    /**/

    function save() {
        try {
			if($_SESSION["user"]){
				if ($_POST) {

                Doo::loadModel("Clientes");
                $user = new Clientes($_POST);
                $id = 0;

                if (isset($_SESSION["user"])) {
                    Doo::db()->update($user);
                    $id = $user->id;
                } else {
                    $user->birthday = $_POST["ibirthday"];
                    Doo::db()->insert($user);
                    $id = Doo::db()->lastInsertId();
                }

                $this->getUserData($id);
                $_SESSION["user"] = serialize($user);
                return Doo::conf()->APP_URL . "mysuperclub/myscIndex";
				//$this->renderc("mysuperclub/myscIndex", $this->data);
            } else {
                $this->getUserData('');
                $this->renderc("mysuperclub/myscIndex", $this->data);
            }
			
			}else{
				$this->getUserData("");
                $this->data["error"] = "";
                $this->renderc('/mysuperclub/myscLogin', $this->data);
			}
        } catch (Exception $e) {
            echo $e;
        }
    }

    /*
     * Crea un bono automaticamente segun el tipo.
     */

    public function autoBono() {

        try {

            if (isset($_SESSION["user"])) {

                Doo::loadModel("Clientes");
                $user = unserialize($_SESSION["user"]);

                if ($_POST) {

                    extract($_POST,EXTR_SKIP);

                    if ($total_ammount > 0) {

                        if ($reward_points <= $user->left_points) {

                            // 1.Crear un bono.
                            $rs = Doo::db()->query("SELECT id FROM bonos_rules where tipo_bono = '$regla' ");
                            $bono_rule = $rs->fetch();

                            Doo::loadModel("Bonos");
                            $bono = new Bonos();
                            $bono->codigo = $this->getNextBono($regla);
                            $bono->nombre = $nombre;
                            $bono->tipo_cliente = $user->tipo_client;
                            $bono->rule_id = $bono_rule["id"];
                            $bono->asignado = $user->id;
                            $bono->redimido = 'No';

                            if ($regla == 'points') {
                                $bono->fecha_creacion = date("Y-m-d");
                                $bono->valor = (double) $total_ammount;
                                $bono->cantidad = (int) $ram;
                            } else {
                                $bono->fecha_creacion = date("Y-mm-dd");
								$fecha_vencimiento = mktime(0, 0, 0, date("Y"), date("m"), date("d") + (int) $bono_rule["vencimiento"]);
                                $bono->fecha_vencimiento = $fecha_vencimiento;
								$bono->valor = (double)  $bono_rule["valor"];
								$bono->cantidad = 1;    
                            }

                            Doo::db()->insert($bono);

                            // 2.Asignar bono al cliente.
                            Doo::loadModel("ClientBonos");
                            $client_bonos = new ClientBonos;
                            $client_bonos->client_id = $user->id;
                            $client_bonos->bono_id = $bono->codigo;
                            $client_bonos->bono_nombre = $bono->nombre;
                            $client_bonos->points = $user->points;
                            $client_bonos->valid_unitl = $bono->fecha_vencimiento;
                            $client_bonos->active = 1;

                            if ($regla == 'points') {
                                $client_bonos->ammount = (int) $ram;
                                $client_bonos->discuont_value = (double) $discount;
                            } else {
                                $client_bonos->ammount = 1;
                                $client_bonos->discuont_value = $bono_rule["valor"];
                            }

                            Doo::db()->insert($client_bonos);

                            // 3.Descontar los puntos.
							if($regla == 'points'){
								$total = doubleval($total_ammount);
								$lef_points = $user->left_points - $total;
                            	$paid_points = $user->paid_points + $total;
                         
                            	$user->left_points = $lef_points;
                            	$user->paid_points = $paid_points;
                            	Doo::db()->update($user);
								$_SESSION["user"] = serialize($user);
							}	
							$this->getUserData($user->id);
                            return Doo::conf()->APP_URL . "mysuperclub/";
                        } else {
                            return Doo::conf()->APP_URL . "mysuperclub/";
                        }
                    }
                }
            } else {
                return Doo::conf()->APP_URL . "mysuperclub/";
            }
        } catch (Exception $e) {
            echo $e;
        }
    }

    /*
     * Generate an automatic Bono name.
     */

    public function getNextBono($tipo) {
        try {
            $rs = Doo::db()->query("SELECT MAX(codigo) AS codigo FROM bonos");
            $name = $rs->fetch();

            if (empty($name)) {
                $name = 'xx0';
            }

            $next_bono = $name["codigo"];
            $next_bono = substr($next_bono, 2, strlen($next_bono));
            $next_bono = (double) $next_bono;
            $next_bono+= 1;
            $next_bono+= '' . abs(time() % 10000);

            switch ($tipo) {
                case 'points':
                    $next_bono = 'BP' . $next_bono;
                    break;
                case 'birthday':
                    $next_bono = 'BD' . $next_bono;
                    break;
                case 'trip':
                    $next_bono = 'BT' . $next_bono;
                    break;
            }
            return $next_bono;
        } catch (Exception $e) {
            echo $e;
        }
    }

    /* Devuelve el valor del bono a redimir */

    public function getBono() {

        try{
			if ($this->params["bono"]) {

            Doo::loadModel("Clientes");
            $user = unserialize($_SESSION["user"]);

            $bono_id = $this->params["bono"];

            $rs = Doo::db()->query("SELECT discuont_value,active FROM client_bonos WHERE client_id ='$user->id' AND bono_id ='$bono_id' ");
            $client_bono = $rs->fetch();
            
            if ($client_bono && $client_bono["active"] == 1) {
                    echo
                   "<script>
						$('#txt_ammount_discount').val('" . $client_bono["discuont_value"] . "');			
                    	
						var bono = $('#txt_reward_code').val();
						var discount = parseFloat($('#txt_ammount_discount').val());
                       	var total = parseFloat($('#totaltotal').html());
						
						var total_ammount =  total - discount;
						$('#totaltotal').html(total_ammount);
                       	$('#incorrect').css('display','none');
						$('#correct').fadeIn('fast');
                    </script>";
            } else {
                echo "
                    <script>
                        $('#correct').css('display','none');
                        $('#incorrect').fadeIn('fast');
                    </script>
                    ";
            }
        }
		}catch(Exception $ex){
			echo $ex;
		}
    }

    /*
     * 
     */

    public function discountBono() {
        try {
            Doo::loadModel("Cliente");
            $user = unserialize($_SESSION["user"]);
            $bono = $this->params["bono"];
            $rs = Doo::db()->query("CALL sp_discount_bono($bono,$user->id)");
            $rs->execute();
            $rs->closeCursor();
        } catch (Exception $ex) {
            echo $ex;
        }
    }

    /**/

    public function close() {
        try {

            if (isset($_SESSION["user"])) {
                unset($_SESSION["user"]);
            }

            $this->data['rootUrl'] = Doo::conf()->APP_URL;
            $this->data['state'] = Doo::db()->find("State", array("select name from State", "asArray" => true));
            $this->data['country'] = Doo::db()->find("Country", array("select name from Country", "asArray" => true));
            $this->data['areas'] = Doo::db()->find("Areas", array("select name from Areas", "asArray" => true));
            $this->renderc('/home2', $this->data);
        } catch (Exception $e) {
            echo $e;
        }
    }

}

?>
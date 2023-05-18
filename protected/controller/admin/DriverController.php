<?php

/**
 * Description of TripsController
 *
 * @author Angel Valencia
 */

Doo::loadController('I18nController');
class DriverController extends I18nController{

    public function beforeRun($resource, $action) {
        if (!isset($_SESSION['login'])) {
            return Doo::conf()->APP_URL;
        }
    }

    public function index(){

        // Cargamos el paginador
        Doo::loadHelper('DooPager');

        if (!isset($_POST["filtro"])) {
            if (!isset($this->params['filtro'])) {
                $filtro = "id";
            } else {
                $filtro = $this->params['filtro'];
            }
        }else{
            $filtro = $_POST["filtro"];
        }

        if (!isset($_POST["texto"])) {
            if (!isset($this->params['texto'])){
                $texto = "";

            } else {
                $texto = $this->params['texto'];
            }
        } else {
            $texto = $_POST["texto"];
        }

        $rs    = Doo::db()->find("Driver", array("select"=>"COUNT(*) AS total",
            "where" => "$filtro like ?",
            "limit"=>1,
            "param" => array($texto . '%')
        ));
        $total = $rs->total;

        if ($total == 0)
            $total = 1;
        // iniciamos el paginador

        $pager = new DooPager(Doo::conf()->APP_URL."admin/driver/$filtro/$texto/page", $total, 10, 5);

        if(isset($this->params['pindex']))
            $pager->paginate(intval($this->params['pindex']));
        else
            $pager->paginate(1);

        $rs = Doo::db()->query("SELECT    id,firstname,lastname, phone, phone2, email, licensedriver,
										  licensetype,  ssegurity,  address, city, zipcode, datehirin,
										  datehirinfin, reasotermination, saludfechafin, hiringcompany
										  
										  FROM driver

                                where $filtro like ? order by id limit $pager->limit ",
            array('%'.$texto.'%'));

        $driver = $rs->fetchAll();

        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['content'] = 'configuracion/driver.php';
        $this->data['filtro']  = $filtro;
        $this->data['texto']   = $texto;
        $this->data['driver']   = $driver;
        $this->data['pager']   = $pager->output;
        $this->renderc('admin/index', $this->data,true);

    }

    public function add(){
//        if(isset($_SESSION['ruta'])){
//            echo "<script>alert('fdsa');</script>";
//            $this->deleteimg();
//        }
        Doo::loadModel("Driver");
        $driver = new Driver();

        $this->data['rootUrl']     = Doo::conf()->APP_URL;
        $this->data['driver']        = $driver;
        $this->data['hotel']  = Doo::db()->find("Hoteles",array("select id,nombre from hoteles" ,"asArray" => true));
        $this->data['content'] = 'configuracion/frm_driver.php';
        $this->data['dato'] = "New";
        $this->renderc('admin/index', $this->data);
    }

    public function save(){
        Doo::loadModel("Driver");

        $driver = new Driver($_POST);

        list($mes,$dia,$anyo) = explode("-",$driver->datehirin);


        $datehirin = $anyo."-".$mes."-".$dia;

        $driver->datehirin = strtotime($datehirin);

        if(isset($driver->datehirinfin)){

            list($mes2,$dia2,$anyo2) = explode("-",$driver->datehirinfin);

            $datehirinfin = $anyo2."-".$mes2."-".$dia2;
            $driver->datehirinfin = strtotime($datehirinfin);

        }

        if(isset($driver->saludfechafin)){

            list($mes2,$dia2,$anyo2) = explode("-",$driver->saludfechafin);

            $saludfechafin = $anyo2."-".$mes2."-".$dia2;
            $driver->saludfechafin = strtotime($saludfechafin);

        }

        $new = false;


        if ($_POST['id'] == "") {
            $driver->id = Null;
            $new = true;
        }

        $this->data['rootUrl'] = Doo::conf()->APP_URL;

        if ($new){
//            print_r($driver);
//            if(isset($_SESSION['ruta']['name']) ){

//                $driver->avatar = "global/files/".$_SESSION['ruta']['name'];
                $driver->insert();
//                print_r($driver);


//                $path = Doo::conf()->SITE_PATH."global/files/";
//
//                $data = $_POST['image'];
//
//                $img = $data;
//                $img = str_replace('data:image/jpeg;base64,', '', $img);
//                $img = str_replace(' ', '+', $img);
//                $data = base64_decode($img);
//                $file = $path .$_SESSION['ruta']['name'];
//                $success = file_put_contents($file, $data);
//                unset($_SESSION['ruta']);

//            }

        }
        else{
//            if(isset($_SESSION['ruta']['name']) ){
//
//                $driver->avatar = "global/files/".$_SESSION['ruta']['name'];
//                if(isset($_POST['imagene'])){
//                    $path = Doo::conf()->SITE_PATH.$_POST['imagene'];
//                    if (file_exists($path)){
//                        unlink($path);
//
//                    }
//
//                }
//
//                Doo::db()->update($driver);
//
//                $path = Doo::conf()->SITE_PATH."global/files/";
//
//                $data = $_POST['image'];
//
//                $img = $data;
//                $img = str_replace('data:image/jpeg;base64,', '', $img);
//                $img = str_replace(' ', '+', $img);
//                $data = base64_decode($img);
//                $file = $path .$_SESSION['ruta']['name'];
//                $success = file_put_contents($file, $data);
//                unset($_SESSION['ruta']);
//
//            }else
//            {
            Doo::db()->update($driver);
//            }
        }
        //print_r($driver);

        return Doo::conf()->APP_URL . "admin/driver";
    }

    public function edit() {
//        if(isset($_SESSION['ruta'])){

//            $this->deleteimg();

//        }
        Doo::loadModel("Driver");
        $driver = new Driver();
        $driver->id = $this->params["pindex"];
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['driver']        = Doo::db()->find($driver, array('limit' => 1));
        $this->data['hotel']  = Doo::db()->find("Hoteles",array("select id,nombre from hoteles" ,"asArray" => true));
        $this->data['content'] = 'configuracion/frm_driver.php';
        $this->data['dato'] = "edit";

        $this->view()->renderc('admin/index', $this->data);
    }



    public function delete() {
        Doo::loadModel("Driver");
        $driver = new Driver();
        $driver->id = $_REQUEST['item'];
        $datos     = Doo::db()->find($driver, array('limit' => 1));
//        $path = Doo::conf()->SITE_PATH.$datos->avatar;


        Doo::db()->delete($driver);
//        unlink($path);
        return Doo::conf()->APP_URL . "admin/driver";
    }


//    public function img(){
//
//        $session_id='1'; //$session id
//        $path = Doo::conf()->SITE_PATH."global/files/";
//        $pat2 = Doo::conf()->APP_URL."global/files/";
//        $valid_formats = array("jpeg","jpg","JPG");
//        if(isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST")
//        {
//            $name = $_FILES['photoimg']['name'];
//            $size = $_FILES['photoimg']['size'];
//
//            if(strlen($name))
//            {
//                list($txt, $ext) = explode(".", $name);
//
//                if(in_array($ext,$valid_formats))
//                {
//                    if($size<(1024*1024))
//                    {
//                        $actual_image_name = time().substr(str_replace(" ", "_", $txt), 5).".".$ext;
//
//                        $tmp = $_FILES['photoimg']['tmp_name'];
//
//
//                        if(move_uploaded_file($tmp, $path.$actual_image_name))
//                        {
//                            //mysql_query("UPDATE users SET profile_image='$actual_image_name' WHERE uid='$session_id'");
//
//                            $variable = 'class="jc-dialog"';
//                            $ruta = 'src="'.$pat2.$actual_image_name.'"';
//
//                            $formulario ='<form action="'.Doo::conf()->APP_URL.'admin/driver/ajax" method="post" name="formu" id="formu"><input type="hidden" id="x" name="x" />									<input type="hidden" id="y" name="y" /><input type="hidden" id="w" name="w" /><input type="hidden" id="h" name="h" /><a href="#" id="cortar" onclick="return checkCoords(); ">Cortar</a></form>';
//                            echo "<html></html><script>
//									alert();
//
//										var dialog = $('<div><div $variable> <img $ruta />$formulario</div></div>');
//										dialog.find('img').Jcrop({	aspectRatio: 1,
//					onSelect: updateCoords},function(){
//										  jcrop_api = this;
//										  dialog.dialog({
//											modal: true,
//											title: 'Jcrop in jQuery-ui Dialog (Dynamic)',
//											close: function(){ dialog.remove();  $('#photoimg').val('');  $('#to').load(encodeURI('".Doo::conf()->APP_URL."admin/driver/ajax2')); },
//											width: jcrop_api.getBounds()[0]+34,
//											resizable: false
//										  })
//
//										dialog.append('<p><b>This dialog was dynamically created in Javascript.</b><br />'+
//										  'Jcrop was attached to the image, and the dialog opened when Jcrop finished.</p>');
//										return false;
//									  })
//
//
//
//									  $('#tabs-2 img').Jcrop({
//										setSelect: [10,10,200,200]
//									  });
//									  $('#tabs').tabs();
//
//		function updateCoords(c)
//			{
//				$('#x').val(c.x);
//				$('#y').val(c.y);
//				$('#w').val(c.w);
//				$('#h').val(c.h);
//			};
//
//			function checkCoords()
//			{
//				if (parseInt($('#x').val())){
//
//				$('#formu').ajaxForm({
//						target: '#preview'
//					  }).submit();
//							return true;
//							}
//
//				alert('Please select a crop region then press submit.');
//
//				return false;
//			};
//
//
//									  </script>
//
//
//
//									  ";
//
//                            $_SESSION['ruta']['rutas'] = $path.$actual_image_name;
//                            $_SESSION['ruta']['name'] =$actual_image_name;
//                        }
//                        else{
//                            echo "<script>alert('failed');</script>";
//                        }
//                    }
//                    else{
//                        echo "<script>alert('Image file size max 1 MB');</script>";
//                    }
//                }
//                else{
//
//                    echo '<script>alert("Invalid file format.."); </script>';}
//            }
//
//            else{
//                echo "<script>alert('Please select image..!');</script>";
//            }
//        }
//    }
//    /**
//     * Jcrop image cropping plugin for jQuery
//     * Example cropping script
//     * @copyright 2008-2009 Kelly Hallman
//     * More info: http://deepliquid.com/content/Jcrop_Implementation_Theory.html
//     */
//    public function ajax()
//    {
//
//        if ($_SERVER['REQUEST_METHOD'] == 'POST')
//        {
//            $targ_w = $targ_h = 150;
//            $jpeg_quality = 90;
//
//
//            $src = $_SESSION["ruta"]['rutas'];
//            $img_r = imagecreatefromjpeg($src);
//            $dst_r = ImageCreateTrueColor( $targ_w, $targ_h );
//
//            imagecopyresampled($dst_r,$img_r,0,0,$_POST['x'],$_POST['y'],
//                $targ_w,$targ_h,$_POST['w'],$_POST['h']);
//
//
//            ob_start();
//            imagejpeg($dst_r,null,$jpeg_quality);
//            $img_final_code = ob_get_contents();
//            ob_end_clean();
//            $dates = "data:image/jpeg;base64,";
//            echo "<img src='".$dates.base64_encode($img_final_code)."' />";
//            $base = base64_encode($img_final_code);
//            $image = '"image"';
//            $hidden = '"hidden"';
//            echo "<script> dialog.remove(); $('#content_page').append('<input name=".$image." type=".$hidden."  value=".$base." />'); </script>";
//
//            /* $path = Doo::conf()->SITE_PATH."global/files/";
//
//             $data = $base;
//
//             $img = $data;
//             $img = str_replace('data:image/jpeg;base64,', '', $img);
//             $img = str_replace(' ', '+', $img);
//             $data = base64_decode($img);
//             $file = $path .$_SESSION['ruta']['name'];
//             $success = file_put_contents($file, $data);
//             */
//
//            exit;
//
//
//        }
//    }

    public function deleteimg(){

        $path = Doo::conf()->SITE_PATH."global/files/".$_SESSION['ruta']['name'];
        if (file_exists($path)){
            unlink($path);
            unset($_SESSION['ruta']);
        }
        else{
            return Doo::conf()->APP_URL."error";
        }


    }


}

?>

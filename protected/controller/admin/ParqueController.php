<?php

/**
 * Description of ParqueController
 *
 *  @author Angel Valencia.
 */
  
Doo::loadController('I18nController');
Doo::loadHelper('DooFile');
Doo::db()->loadModel("Imagenes_parques");

class ParqueController extends I18nController{


    public function beforeRun($resource, $action) {
       if (!isset($_SESSION['login'])) {
            return Doo::conf()->APP_URL;
        }
		
	/*	
		if($rs = $this->acl()->process("admin", $resource, $action )){
			return $rs;
		}*/
		
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
           if (!isset($this->params['texto'])) {
                $texto = "";
            } else {
                $texto = $this->params['texto'];
            } 
        } else {
            $texto = $_POST["texto"];
        }
               
        $rs    = Doo::db()->find("Parques", array("select"=>"COUNT(*) AS total", 
                                                     "where" => "$filtro like ?", 
                                                     "limit"=>1,
                                                     "param" => array($texto . '%')
                                                    ));
         $total = $rs->total;

         if ($total == 0)
           $total = 1;
        // iniciamos el paginador

        $pager = new DooPager(Doo::conf()->APP_URL."admin/tours/parks/$filtro/$texto/page", $total, 10, 5);

        if(isset($this->params['pindex']))
            $pager->paginate(intval($this->params['pindex']));
        else
            $pager->paginate(1);
        
        $rs = Doo::db()->query("SELECT  t1.id,t1.nombre,t1.description,t2.nombre as grupo
												FROM parques t1
												LEFT JOIN grupo_parques t2 ON (t1.id_grupo = t2.id)


                                where t1.$filtro like ?  order by t1.id limit $pager->limit ", 
                                array($texto.'%'));
        
        $parques = $rs->fetchAll();

        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['content'] = 'configuracion/parques.php';
        $this->data['filtro']  = $filtro;
        $this->data['texto']   = $texto;
        $this->data['parques']   = $parques;
        $this->data['pager']   = $pager->output;
        $this->renderc('admin/index', $this->data,true);

    }
    
public function add(){
         
        Doo::loadModel("Parques");
        $parques = new Parques();

        $this->data['rootUrl']     = Doo::conf()->APP_URL;
		$this->data['parques']        = Doo::db()->find($parques, array('limit' => 1));
		$this->data['grupos']       = Doo::db()->find("Grupo_parque", array("asArray" => true));
        $this->data['parques']        = $parques;
        $this->data['content'] = 'configuracion/frm_parks.php';
		$this->data['dato'] = "New";
        $this->renderc('admin/index', $this->data);
    }
    
    public function save(){
      
        Doo::loadModel("Parques");
        
        $parques = new Parques($_POST);
		
       
		
        $new = false;
      
        if ($_POST['id'] == "") {
            $parques->id = Null;
            $new = true;
        }
        if (isset($_POST["eliminarb"])) {
            $dato = $_POST["eliminarb"];
            $imagenes = new Imagenes_parques();
            foreach ($dato as $value) {
                $codigo = $value;
                $imagenes->id = $codigo;
                $query = Doo::db()->getOne($imagenes);

                if (!empty($query->ruta_resize)) {
                    if (file_exists(Doo::conf()->SITE_PATH . "global/" . $query->ruta_resize)) {
                        @unlink(Doo::conf()->SITE_PATH . "global/" . $query->ruta_resize);
                    }
                }
                if (!empty($query->ruta_peque)) {
                    if (file_exists(Doo::conf()->SITE_PATH . "global/" . $query->ruta_peque)) {
                        @unlink(Doo::conf()->SITE_PATH . "global/" . $query->ruta_peque);
                    }
                }
       
                Doo::db()->delete($imagenes);
            }
        }
        if (isset($_POST["ordenb"])) {
        
            $orden = new Imagenes_parques();
            $ordenb = $_POST["ordenb"];
            foreach ($ordenb as $id => $val) {
                $orden->orden = $val;
                $orden->id = $id;
                Doo::db()->update($orden);
            }
        }
        if (isset($_POST["describ"])) {

            $orden = new Imagenes_parques();
            $ordenb = $_POST["describ"];
            foreach ($ordenb as $id => $val) {
                $orden->descripcion = $val;
                $orden->id = $id;
                Doo::db()->update($orden);
            }
        }



        if ($new) {
		   $df = new DooFile();
            $file = $df->upload(Doo::conf()->FILE_DIR . '/global/uploads/', 'image1', 'doc_' . date('Ymdhis'));
			
            $parques->image1 = 'global/uploads/' . $file;
			
            Doo::db()->insert($parques);
            $codigo_parque = Doo::db()->lastInsertId();
			
            if (isset($_FILES['img_gallery'])) {
                $vacio = $this->reArrayFiles($_FILES['img_gallery']);

                if ($vacio[0]["size"] != 0) {

                    $path_banner = Doo::conf()->SITE_PATH . "global/files/parques/";
                    $imagenes_parques = new Imagenes_parques();


                    $datos = $_FILES['img_banner'];

                    $file_ary = $this->reArrayFiles($_FILES['img_banner']);

                    foreach ($file_ary as $file) {
                        $image = $file['tmp_name'];

                        $extension = $this->formato($image);
                        $name_resize = $cod . rand() . rand() . "_p_img_fotos_normal.";
                        $name_peque = $cod . rand() . rand() . "_p_img_fotos_peque.";

                        while (file_exists($path . $name_resize . $extension)) {
                            $name_resize = $cod . rand() . rand() . "_p_img_fotos_normal.";
			}

                        while (file_exists($path . $name_peque . $extension)) {
                            $name_peque = $cod . rand() . rand() . "_p_img_fotos_peque.";
                        }

                        /** configuracion config.ini imagenes */
                        list($rgb1, $rgb2, $rgb3) = explode(",", Doo::conf()->ini["img_f_fs_rgb"]);
                        $x = Doo::conf()->ini["img_f_fs_x"];
                        $y = Doo::conf()->ini["img_f_fs_y"];

                        $formato = $this->resize($image, $path_banner, $name_resize, $rgb1, $rgb2, $rgb3, $x, $y);

                        list($rgb1, $rgb2, $rgb3) = explode(",", Doo::conf()->ini["img_p_rgb"]);
                        $x = Doo::conf()->ini["img_p_x"];
                        $y = Doo::conf()->ini["img_p_y"];

                        $formato1 = $this->resize($image, $path_banner, $name_peque, $rgb1, $rgb2, $rgb3, $x, $y);

                        /** end  */
                        if ($formato != false) {
                            $imagenes_parques->id_parques = $codigo_parque;
                            $imagenes_parques->ruta_resize = "files/parques/" . $name_resize . $formato;
                            $imagenes_parques->ruta_peque = "files/parques/" . $name_peque . $formato1;
                            $imagenes_parques->nombre_original = $file['name'];
                            Doo::db()->insert($imagenes_parques);
                        }
                    }
                }
            }
        } else {
           Doo::db()->update($parques);
            if (isset($_FILES['img_gallery'])) {
                $vacio = $this->reArrayFiles($_FILES['img_gallery']);

                if ($vacio[0]["size"] != 0) {

                    if (isset($_POST["reemp_img_gallery"])) {
                        $imagenes_parques1 = new Imagenes_parques();
                        $path_eliminar = Doo::conf()->SITE_PATH . "global/";
                        $imagenes_parques1->id_parques = trim($_POST['id']);

                        $datos = Doo::db()->find($imagenes_parques1);
                        foreach ($datos as $value) {

                            $elimina_risize = $value->ruta_resize;
                            $elimina_normal = $value->ruta_peque;
                            if (!empty($elimina_risize)) {
                                if (file_exists($path_eliminar . $elimina_risize)) {
                                    unlink($path_eliminar . $elimina_risize);
            }
                            }
                            if (!empty($elimina_normal)) {
                                if (file_exists($path_eliminar . $elimina_normal)) {

                                    unlink($path_eliminar . $elimina_normal);
                                }
                            }
                        }
                        Doo::db()->delete($imagenes_parques1);
                    }
                    $path_banner = Doo::conf()->SITE_PATH . "global/files/parques/";
                    $imagenes_parques = new Imagenes_parques();
       
                
                    $datos = $_FILES['img_gallery'];

                    $file_ary = $this->reArrayFiles($_FILES['img_gallery']);

                    foreach ($file_ary as $file) {
                        $image = $file['tmp_name'];
                        /* $name_resize = rand() . rand() . "_img_fotos_normal.";
                          $name_normal = rand() . rand() . "_img_fotos_fs."; */
                        $extension = $this->formato($image);
                        $name_resize = $cod . rand() . rand() . "_p_img_fotos_normal.";
                        $name_peque = $cod . rand() . rand() . "_p_img_fotos_peque.";

                        while (file_exists($path . $name_resize . $extension)) {
                            $name_resize = $cod . rand() . rand() . "_p_img_fotos_normal.";
    }
                        while (file_exists($path . $name_peque . $extension)) {
                            $name_peque = $cod . rand() . rand() . "_p_img_fotos_peque.";
                        }
    
                        /** configuracion config.ini  */
                        list($rgb1, $rgb2, $rgb3) = explode(",", Doo::conf()->ini["img_f_fs_rgb"]);
                        $x = Doo::conf()->ini["img_f_fs_x"];
                        $y = Doo::conf()->ini["img_f_fs_y"];


                        $formato = $this->resize($image, $path_banner, $name_resize, $rgb1, $rgb2, $rgb3, $x, $y);

                        list($rgb1, $rgb2, $rgb3) = explode(",", Doo::conf()->ini["img_p_rgb"]);
                        $x = Doo::conf()->ini["img_p_x"];
                        $y = Doo::conf()->ini["img_p_y"];

                        $formato1 = $this->resize($image, $path_banner, $name_peque, $rgb1, $rgb2, $rgb3, $x, $y);

                        if ($formato != false) {
                            $imagenes_parques->id_parques = trim($_POST['id']);
                            $imagenes_parques->ruta_resize = "files/parques/" . $name_resize . $formato;
                            $imagenes_parques->ruta_peque = "files/parques/" . $name_peque . $formato1;
                            $imagenes_parques->nombre_original = $file['name'];
                            Doo::db()->insert($imagenes_parques);
                        }
                    }
                }
            }
        }
        if ($new) {
            return Doo::conf()->APP_URL . "admin/tours/parks/edit/" . $codigo_parque . "?menssage=ok";
        } else {
            return Doo::conf()->APP_URL . "admin/tours/parks/edit/" . trim($_POST['id']) . "?menssage=ok";
        }
    }

    public function edit() {
        Doo::loadModel("Parques");
        $parques = new Parques();
        $parques->id = $this->params["pindex"];
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['parques']        = Doo::db()->find($parques, array('limit' => 1));
		$this->data['grupos']       = Doo::db()->find("Grupo_parque", array("asArray" => true));
        $this->data['content'] = 'configuracion/frm_parks.php';
        $this->data['gallery'] = Doo::db()->find("Imagenes_parques", array("asc" => "orden", "where" => "id_parques = ? ", "param" => array($parques->id)));
        $this->data['edit'] = 1;
		$this->data['dato'] = "edit";
        $this->view()->renderc('admin/index', $this->data);
    }

    public function delete() {
        Doo::loadModel("Parques");
        $parques = new Parques();
        $parques->id = $_REQUEST['item'];
        Doo::db()->delete($parques);
        return Doo::conf()->APP_URL . "admin/tours/parks";
    }
	
	public function parks(){
		$grupo = $this->params["grupo"];
		$sql = "SELECT  id, nombre, id_grupo	
					FROM parques 
					where  id_grupo	 = ?";
		$rs = Doo::db()->query($sql,  array($grupo));
		$parques = $rs->fetchAll();
		echo '<option value="0">All</option>';
		foreach($parques as $p){
			echo '<option value="'.$p['id'].'">'.$p['nombre'].'</option>';
		}
	}

    public function add_stock(){
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['content'] = 'ticket_stock/add_stock.php';
        $sql0 = "select p.id,p.nombre,p.stock from parques as p order by p.id_grupo";
        $q0 = Doo::db()->query($sql0);
        $parques = $q0->fetchAll();

        $this->data['parques'] = $parques;
        $this->renderc('admin/index',$this->data,true);
    }

    public function update_stock(){
        $amount = $this->params['amount'];
        $id = $this->params['id'];
        Doo::db()->loadModel('Parques');
        $park = new Parques();
        $park->id = $id;
        $park = Doo::db()->getOne($park);
        $park->stock = intval($park->stock) + $amount;
        $park->update();
        return Doo::conf()->APP_URL.'admin/tours/parks/stock';
    }
     
    public function reArrayFiles(&$file_post) {

        $file_ary = array();
        $file_count = count($file_post['name']);
        $file_keys = array_keys($file_post);

        for ($i = 0; $i < $file_count; $i++) {
            foreach ($file_keys as $key) {
                $file_ary[$i][$key] = $file_post[$key][$i];
}
        }

        return $file_ary;
    }

    public function resize($source_image, $destination, $name, $rgb1, $rgb2, $rgb3, $tn_w, $tn_h, $quality = 100, $wmsource = false) {
        $info = getimagesize($source_image);
        $imgtype = image_type_to_mime_type($info[2]);

        #assuming the mime type is correct
        switch ($imgtype) {
            case 'image/jpeg':
                $source = imagecreatefromjpeg($source_image);
                $formato = 'jpeg';
                break;
            case 'image/gif':
                $source = imagecreatefromgif($source_image);
                $formato = 'gif';
                break;
            case 'image/png':
                $source = imagecreatefrompng($source_image);
                $formato = 'png';
                break;
            default:
                die('Invalid image type.');
        }

#Figure out the dimensions of the image and the dimensions of the desired thumbnail
        $src_w = imagesx($source);
        $src_h = imagesy($source);


#Do some math to figure out which way we'll need to crop the image
#to get it proportional to the new size, then crop or adjust as needed

        $x_ratio = $tn_w / $src_w;
        $y_ratio = $tn_h / $src_h;

        if (($src_w <= $tn_w) && ($src_h <= $tn_h)) {
            $new_w = $src_w;
            $new_h = $src_h;
        } elseif (($x_ratio * $src_h) < $tn_h) {
            $new_h = ceil($x_ratio * $src_h);
            $new_w = $tn_w;
        } else {
            $new_w = ceil($y_ratio * $src_w);
            $new_h = $tn_h;
        }
        $tn_w = $new_w;
        $tn_h = $new_h;

        $newpic = imagecreatetruecolor(round($new_w), round($new_h));
        imagecopyresampled($newpic, $source, 0, 0, 0, 0, $new_w, $new_h, $src_w, $src_h);
        $final = imagecreatetruecolor($tn_w, $tn_h);
        $backgroundColor = imagecolorallocate($final, $rgb1, $rgb2, $rgb3);

        imagefill($final, 0, 0, $backgroundColor);

//imagecopyresampled($final, $newpic, 0, 0, ($x_mid - ($tn_w / 2)), ($y_mid - ($tn_h / 2)), $tn_w, $tn_h, $tn_w, $tn_h);
        imagecopy($final, $newpic, (($tn_w - $new_w) / 2), (($tn_h - $new_h) / 2), 0, 0, $new_w, $new_h);

#if we need to add a watermark
        if ($wmsource) {
#find out what type of image the watermark is
            $info = getimagesize($wmsource);
            $imgtype = image_type_to_mime_type($info[2]);

#assuming the mime type is correct
            switch ($imgtype) {
                case 'image/jpeg':
                    $watermark = imagecreatefromjpeg($wmsource);
                    $formato = 'jpeg';
                    break;
                case 'image/gif':
                    $watermark = imagecreatefromgif($wmsource);
                    $formato = 'gif';
                    break;
                case 'image/png':
                    $watermark = imagecreatefrompng($wmsource);
                    $formato = 'png';
                    break;
                default:
                    die('Invalid watermark type.');
            }

#if we're adding a watermark, figure out the size of the watermark
#and then place the watermark image on the bottom right of the image
            $wm_w = imagesx($watermark);
            $wm_h = imagesy($watermark);
            imagecopy($final, $watermark, $tn_w - $wm_w, $tn_h - $wm_h, 0, 0, $tn_w, $tn_h);
        }
        $destino = $destination . $name . $formato;

        if (imagejpeg($final, $destino, $quality)) {
            return $formato;
        }
        return false;
    }

    public function formato($source_image) {
        $info = getimagesize($source_image);
        $imgtype = image_type_to_mime_type($info[2]);

        #assuming the mime type is correct
        switch ($imgtype) {
            case 'image/jpeg':
                $formato = 'jpeg';
                break;
            case 'image/gif':

                $formato = 'gif';
                break;
            case 'image/png':

                $formato = 'png';
                break;
            default:
                die('Invalid image type.');
        }

        return $formato;
    }

}

?>

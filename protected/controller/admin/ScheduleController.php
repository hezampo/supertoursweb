<?php

/**
 * Description of RatesController
 *
 * @author Ivan gallo
 *  
 */

Doo::loadController('I18nController');

class ScheduleController extends I18nController {

    public $data;

    public function beforeRun($resource, $action) {
        if (!isset($_SESSION['login'])) {
            return Doo::conf()->APP_URL;
        }
    }

    public function index() {
                
         // Cargamos el paginador
		 
        Doo::loadHelper('DooPager'); 
        $noFiltro = false; 
         if (!isset($_POST["filtro"])) {
		 if(!isset($this->params['filtro']) || $this->params['filtro'] == -1){
		 
            $noFiltro = true; 
			$filtro = -1;
			
			}else{
			
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
		 $subLike = "$filtro like '%$texto%'";
         if($noFiltro){
		    $subLike = "1";
            
		 }    
       /*
	    $rs    = Doo::db()->find("Programacion", array("select"=>"COUNT(*) AS total", 
                                                     "where" => "$subLike", 
                                                     "limit"=>1,
                                                     "param" => array($texto . '%')
                                                    ));
		*/	
		$rs = Doo::db()->query("select COUNT(*) AS total from programacion Where $subLike order by fecha DESC");									
         $row = $rs->fetch();
		 $total = $row['total'];

         if ($total == 0)
           $total = 1;
        // iniciamos el paginador

        $pager = new DooPager(Doo::conf()->APP_URL."admin/schedule/$filtro/$texto/page", $total, 10, 5);

        if(isset($this->params['pindex']))
            $pager->paginate(intval($this->params['pindex']));
        else
            $pager->paginate(1);

        /*$prog = Doo::db()->find("Programacion", array("where" => "$filtro like ?",
                                                "desc" => "anno",
                                                "asc"  => "trip_no,fecha",
                                                "asArray" => true,
                                                "limit"=>$pager->limit,
                                                "param" => array($texto.'%')));
        */


	    $query ="select * from programacion where $subLike order by fecha DESC limit $pager->limit ";
		
		$prog = Doo::db()->query($query);

        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['content'] = 'configuracion/programacion.php';
        $this->data['filtro']  = $filtro;
        $this->data['texto']   = $texto;
        $this->data['prog']    = $prog;
        $this->data['pager']   = $pager->output;
        $this->renderc('admin/index', $this->data);
    }
    
    public function add() {
        $this->data['viajes']  = Doo::db()->find("Trips", array("asArray" => true));
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['content'] = 'configuracion/frm_prog.php';
        $this->data['dato'] = "New";
        $this->renderc('admin/index', $this->data);
    }

    public function save() {

        $anno     = $_POST["anno"];
		
		list($mes,$dia,$anyo) = explode("-",$_POST["fechafin"]);
		$fechafin = $anyo."-".$mes."-".$dia;
		
        $ff       = new DateTime($fechafin);
		
        $trip_no  = $_POST["trip_no"];
        
               
        $trips    = Doo::db()->find("Trips", array("select" => "trip_no,lunes,martes,miercoles,jueves,viernes,sabado,domingo",
                                                    "where"  => "trip_no like ?",
                                                    "asArray" => true,
                                                    "param"  => array($trip_no.'%')
                                                   ));
                     
        $sql = "insert into programacion(trip_no, fecha, anno, estado) values ";
        
        foreach($trips as $e):
		
            $tn = $e["trip_no"];
            $lunes = $e["lunes"];
			$martes = $e["martes"];
			$miercoles = $e["miercoles"];
			$jueves = $e["jueves"];
			$viernes = $e["viernes"];
			$sabado = $e["sabado"];
			$domingo = $e["domingo"];
			
			
			if($lunes == 0){
			$lunes = 1;
			}else
			{
			$lunes = 30;
			}
			
			if($martes == 0){
			$martes = 2;
			}else
			{
			$martes = 30;
			}
			
			if($miercoles == 0){
			$miercoles = 3;
			}else
			{
			$miercoles = 30;
			}
			
			if($jueves == 0){
			$jueves = 4;
			}else
			{
			$jueves = 30;
			}
			
			if($viernes == 0){
			$viernes = 5;
			}else
			{
			$viernes = 30;
			}
			
			if($sabado == 0){
			$sabado = 6;
			}else
			{
			$sabado = 30;
			}
			
			if($domingo == 0){
			  $domingo = 0;
			}else
			{
			$domingo = 30;
			}
			
			list($mes,$dia,$anyo) = explode("-",$_POST["fechaini"]);
		$fechaini = $anyo."-".$mes."-".$dia;
		
            $fi = new DateTime($fechaini);
			
          while ($fi <= $ff) {
              
                $cd = $fi->format('m-d-Y');
				//echo $cd."<br>";
              
				$gd = explode("-", $cd);
               
				$gd = getdate(mktime(0, 0, 0,$gd[0], $gd[1], $gd[2]));
				
                $wd = $gd['wday'];
				
             //echo $cd."<br>";
				
                if ($wd != $lunes && $wd != $martes && $wd != $miercoles && $wd != $jueves && $wd != $viernes && $wd != $sabado &&  $wd != $domingo ){
						
                   $values[] = "('$tn', '$cd', '$anno', '1')";
				   
                    }
                  $fi->modify('+1 day');
                                    
            }
           
       endforeach;
     
        $sql.= implode(',', $values);
                     
        Doo::db()->query($sql);
              
       return Doo::conf()->APP_URL . "admin/schedule";
    }
    
    
    public function change(){
    
        Doo::loadModel("Programacion");
        $prog = new Programacion();
        $prog->id = $this->params["pindex"];
        
        $this->data['rootUrl']     = Doo::conf()->APP_URL;
        $this->data['prog']        = Doo::db()->find($prog, array('limit' => 1));
        $this->data['content']     = 'configuracion/frm_programa.php';
		$this->data['dato'] = "edit";
        $this->view()->renderc('admin/index', $this->data);
        
    }
	
	public function change2(){
    
        $this->data['rootUrl']     = Doo::conf()->APP_URL;
        
        $this->data['content']     = 'configuracion/frm_programaPorTrip.php';
		$this->data['dato'] = "edit";
        $this->view()->renderc('admin/index', $this->data);
		
		 
    }
    
    public function update() {
       
        Doo::loadModel("Programacion");
        $prog = new Programacion();
        $prog->id     = $_POST["id"];
        $prog->estado = $_POST["estado"];
        
        $prog->update();
        
        return Doo::conf()->APP_URL . "admin/schedule";
        
    }
	
	 public function update2() {
       
        //Doo::loadModel("Programacion");
       
       $viaje = $_POST['trip_no'];
       $estado = $_POST["estado"];
	   $anio = $_POST['anno'];
       
	   $sql = "update programacion set estado=$estado where trip_no =? and anno=?";
	   $res = Doo::db()->query($sql,array($_POST['trip_no'],$_POST['anno']));
	
	   /*echo "<script>alert('".$estado." ".$viaje." ".$anio."')</script>";*/
       
        return Doo::conf()->APP_URL . "admin/schedule";
        
    }

}
?>

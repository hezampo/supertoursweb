<?php

/**
 * Description of ToursvipController
 *
 * @author Jairo Guzman
 */

Doo::loadController('I18nController');
class ToursOneController extends I18nController{
   
    public function codigoConf($tipo){
		if($tipo == 1){//Pago
			$prefijo = 'TO';
		}else{//Cotizacion
			$prefijo = 'QO';
		}
		do{ 
		   $mes = date("m"); 
		   $dia = date("d"); 
		   $y = date("y"); 					 
		   $code = $prefijo.$y.$mes.$dia. rand(0, 9).rand(0, 9).rand(0, 9).rand(0, 9); 
		   $a = $this->db()->find('Tour_oneday', array('where' => 'code_conf = ?',
				   'limit' => 1,
				   'select' => 'code_conf',
				   'param' => array($code)
				   )
		   );
	  }while($a != null);
	  
	  return $code;
	}
	
	public function codigoConftour($tipo){
		if($tipo == 1){//Pago
			$prefijo = 'WTO';
		}else{//Cotizacion
			$prefijo = 'WTQ';
		}
		do{ 
		   $mes = date("m"); 
		   $dia = date("d"); 
		   $y = date("y"); 					 
		   $code = $prefijo.$y.$mes.$dia. rand(0, 9).rand(0, 9).rand(0, 9).rand(0, 9); 
		   $a = $this->db()->find('Tour_oneday', array('where' => 'code_conf = ?',
				   'limit' => 1,
				   'select' => 'code_conf',
				   'param' => array($code)
				   )
		   );
	  }while($a != null);
	  
	  return $code;
	}

	
	public function codigoConfMultitour($tipo){
		if($tipo == 1){//Pago
			$prefijo = 'WTM';
		}else{//Cotizacion
			$prefijo = 'WTQ';
		}
		do{ 
		   $mes = date("m"); 
		   $dia = date("d"); 
		   $y = date("y"); 					 
		   $code = $prefijo.$y.$mes.$dia. rand(0, 9).rand(0, 9).rand(0, 9).rand(0, 9); 
		   $a = $this->db()->find('Tour_oneday', array('where' => 'code_conf = ?',
				   'limit' => 1,
				   'select' => 'code_conf',
				   'param' => array($code)
				   )
		   );
	  }while($a != null);
	  
	  return $code;
	}
     
}


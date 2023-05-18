<?php
/**
 * ErrorController
 * Feel free to change this and customize your own error message
 *
 * @author darkredz
 */
 
 
Doo::loadController('I18nController');
class ErrorController extends DooController{
    public $data;
    public function index(){
    
    $this->data['rootUrl'] = Doo::conf()->APP_URL;
	 
       $this->renderc('error', $this->data,true);  
    }
	
public function error_tour(){
   $this->data['rootUrl'] = Doo::conf()->APP_URL;
   $this->renderc('error_tours',$this->data,true);
}

}
?>
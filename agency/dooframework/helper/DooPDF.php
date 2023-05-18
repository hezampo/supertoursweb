<?php





/*


 * To change this template, choose Tools | Templates


 * and open the template in the editor.


 */





/**


 * Description of DooPDF


 *


 * @author Administrador


 */


Doo::loadClass("libs/dompdf/dompdf_config.inc");


class DooPDF {


    //put your code here


    public $paper_1='a3'; 


    public $paper_2='portrait'; 


    public $dompdf;


    public $name;


    public $page;


    public $mode; 


    public function __construct($name,$page,$mode=false,$paper_1='a3',$paper_2='portrait') {


        $this->page = $page; 


        $this->name = $name; 


        $this->mode = $mode; 


        $this->paper_1 = $paper_1; 


        $this->paper_2 = $paper_2; 


        //$this->dompdf  =  new DOMPDF();; 


    }


    


     


    


  function doPDF()
{  
    if($this->mode!=true and $this->mode!=false ) $this->mode=false;
    if( $this->page!='' )
    {        
        //Añadimos la extensión del archivo. Si está vacío el nombre lo creamos
        $this->name!='' ? $this->name .='.pdf' : $this->name = crearNombre(10);  
        //Las opciones del papel del PDF. Si no existen se asignan las siguientes:[*]
        if( $this->paper_1=='' ) $this->paper_1='a4';
        if( $this->paper_2=='' ) $this->paper_2='portrait';
        //ob_start();
        $dompdf =  new DOMPDF();  
        $dompdf -> set_paper($this->paper_1,$this->paper_2);
        $dompdf -> load_html(utf8_decode($this->page));
        $dompdf -> render();
        //Creamos el pdf
        if($this->mode==false)
        $dompdf->stream($this->name);
        //Lo guardamos en un directorio y lo mostramos
        if($this->mode==true)
            if( file_put_contents(Doo::conf ()->APP_URL."global/files/".$this->name, $dompdf->output()) ) header('Location: '.Doo::conf ()->APP_URL."global/files/".$this->name);
    }
}

function doPDF2()
{  
    if($this->mode!=true and $this->mode!=false ) $this->mode=false;
    if( $this->page!='' )
    {        
        //Añadimos la extensión del archivo. Si está vacío el nombre lo creamos
        $this->name!='' ? $this->name .='.pdf' : $this->name = crearNombre(10);  
        //Las opciones del papel del PDF. Si no existen se asignan las siguientes:[*]
        if( $this->paper_1=='' ) $this->paper_1='a4';
        if( $this->paper_2=='' ) $this->paper_2='portrait';
        //ob_start();
        $dompdf =  new DOMPDF();  
        $dompdf -> set_paper($this->paper_1,$this->paper_2);
        $dompdf -> load_html(utf8_decode($this->page));

        $dompdf -> render();
        //Creamos el pdf
        if($this->mode==false)
        $dompdf->stream($this->name);
        //Lo guardamos en un directorio y lo mostramos
        if($this->mode==true)
            if( file_put_contents(Doo::conf ()->APP_URL."global/files/".$this->name, $dompdf->output()) ) header('Location: '.Doo::conf ()->APP_URL."global/files/".$this->name);
    }
}



function crearNombre($length)


{


    if( ! isset($length) or ! is_numeric($length) ) $length=6;


    


    $str  = "0123456789abcdefghijklmnopqrstuvwxyz";


    $path = '';


    


    for($i=1 ; $i<$length ; $i++)


      $path .= $str{rand(0,strlen($str)-1)};





    return $path.'_'.date("d-m-Y_H-i-s").'.pdf';    


}








}






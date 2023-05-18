<?php
Doo::loadCore('db/DooModel');

class Imagenes_parquesBase extends DooModel{

    
    public $id;
    
    public $id_parques;
    
    public $ruta_resize;
    
    public $ruta_peque;
    
    public $nombre_original;
    
    public $descripcion;
    
    public $orden;
  

    public $_table = 'imagenes_parques';
    public $_primarykey = 'id';
    public $_fields = array('id','id_parques','ruta_resize','ruta_peque','nombre_original','descripcion','orden');    

}
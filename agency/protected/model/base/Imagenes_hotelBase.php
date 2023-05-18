<?php
Doo::loadCore('db/DooModel');

class Imagenes_hotelBase extends DooModel{

    
    public $id;
    
    public $id_hotel;
    
    public $ruta_resize;
    
    public $ruta_peque;
    
    public $nombre_original;
    
    public $descripcion;
    
    public $orden;
  

    public $_table = 'imagenes_hotel';
    public $_primarykey = 'id';
    public $_fields = array('id','id_hotel','ruta_resize','ruta_peque','nombre_original','descripcion','orden');    

}
<?php

Doo::loadCore('db/DooModel');



class ParquesrestricBase extends DooModel{




    public $id_parque;
    public $id_grupo;    
    public $fecha_ini;
    public $fecha_fin;      
    public $park_select2;    
    public $park_select3;    
    public $park_select4;    
    public $park_select5;    
    public $park_select6;    
    public $tari_2;    
    public $tari_3;    
    public $tari_4;    
    public $tari_5;    
    public $tari_6;
    public $inicio;
    public $fin;
    public $cantidad;

    public $_table = 'parques_restric';


    public $_fields = array('id_parque','id_grupo','fecha_ini','fecha_fin','park_select2','park_select3','park_select4','park_select5','park_select6','tari_2','tari_3','tari_4','tari_5','tari_6','inicio','fin','cantidad');



   

}

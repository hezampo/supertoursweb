<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

Doo::loadCore('db/DooModel');



class TaritransportBase extends DooModel {


    public $id;


    public $special_price_name;   


    public $_table = 'tarifarios_transportacion';


    public $_primarykey = 'id';


    public $_fields = array('id', 'special_price_name');



}



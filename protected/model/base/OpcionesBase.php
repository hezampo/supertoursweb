<?php
Doo::loadCore('db/DooModel');

class OpcionesBase extends DooModel{

    /**
     * @var varchar Max length is 5.
     */
    public $codigo;

    /**
     * @var varchar Max length is 60.
     */
    public $menuitem;

    /**
     * @var varchar Max length is 5.
     */
    public $depende;

    /**
     * @var char Max length is 1.
     */
    public $submenu;

    /**
     * @var varchar Max length is 100.
     */
    public $url;

    /**
     * @var varchar Max length is 100.
     */
    public $toolbar;

    public $_table = 'opciones';
    public $_primarykey = 'codigo';
    public $_fields = array('codigo','menuitem','depende','submenu','url','toolbar');

    
}
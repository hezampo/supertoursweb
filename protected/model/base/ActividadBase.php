<?php
Doo::loadCore('db/DooModel');

class ActividadBase extends DooModel{

    /**
     * @var int Max length is 10.
     */
    public $id;
    /**
     * @var varchar Max length is 10.
     */
    public $id_table;
    /**
     * @var varchar Max length is 40.
     */
    public $table;
    /**
     * @var varchar Max length is 40.
     */
    public $type_change;
    /**
     * @var char Max length is 2.
     */
    public $fecha;
	 /**
     * @var char Max length is 2.
     */
	public $user;
	 /**
     * @var char Max length is 2.
     */
	public $type_user;

  

    public $_table = 'actividad';
    public $_primarykey = 'id';
    public $_fields = array('id','id_table','table','type_change','fecha','user','type_user');

   
}
<?php
Doo::loadCore('db/DooModel');

class UserABase extends DooModel{

    /**
     * @var int Max length is 10.
     */
    public $id;

    /**
     * @var varchar Max length is 10.
     */
    public $firstname;


    public $lastname;
    /**
     * @var varchar Max length is 40.
     */
    public $email;

    /**
     * @var varchar Max length is 40.
     */
    public $birthdate;

    /**
     * @var char Max length is 2.
     */
    public $password;

    /**
     * @var char Max length is 1.
     */
    public $id_agencia;
    
    
    public $admon;

    public $active;

    public $_table = 'user_agencia';
    public $_primarykey = 'id';
    public $_fields = array('id','firstname','lastname','email','birthdate','password','id_agencia','admon','activo');

   
}
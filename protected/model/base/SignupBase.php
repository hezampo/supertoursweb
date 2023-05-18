<?php
Doo::loadCore('db/DooModel');

class SignupBase extends DooModel{

    /**
     * @var int Max length is 10.
     */
    public $id;

    public $username;

    public $firstname;
    public $lastname;
    public $password;
	public $phone;
    public $celphone;
	public $city;
    public $state;
    public $country;
	public $address;
	public $zip;
	public $tipo_client;
    public $birthday;
    public $fecha_r;
    public $_table = 'clientes';
    public $_primarykey = 'id';
    public $_fields = array('id','username','firstname','lastname','password','phone','celphone','city','state','country','address',"zip","tipo_client","birthday","fecha_r");

    
}
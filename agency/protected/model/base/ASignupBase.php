<?php
Doo::loadCore('db/DooModel');

class ASignupBase extends DooModel{

    /**
     * @var int Max length is 10.
     */
    public $id;

    public $atanumber;

    public $name;
    public $address;
    public $phone1;
	public $phone2;
    public $email;
	public $toolfree;
    public $movil;
    public $firstname;
	public $lastname;
	public $celphone;
	public $username;
    public $password;
    public $code;
	public $estado;
	
    public $_table = 'agency';
    public $_primarykey = 'id';
    public $_fields = array('id','atanumber','name','address','phone1','phone2','email','toolfree','movil','firstname','lastname',"celphone","username","password","code","estado");

    
}
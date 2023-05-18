<?php
Doo::loadCore('db/DooModel');

class DriverBase extends DooModel{

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
    public $phone;

    /**
     * @var varchar Max length is 40.
     */
    public $phone2;

    /**
     * @var char Max length is 2.
     */
    public $email;

    /**
     * @var char Max length is 1.
     */
    public $licensedriver;

    public $ssegurity;

    public $address;

    public $city;
	
	public $zipcode;
	
	public $datehirin;
	
	public $datehirinfin;
	
	public $reasotermination;
	
	public $saludfechafin;
	
	public $hiringcompany;
	public $avatar;

    public $_table = 'driver';
    public $_primarykey = 'id';
    public $_fields = array('id','firstname','lastname','phone','phone2','email','licensedriver','licensetype', 'ssegurity', 'address', 'city', 'zipcode','datehirin','datehirinfin','reasotermination','saludfechafin','hiringcompany','avatar');

   
}
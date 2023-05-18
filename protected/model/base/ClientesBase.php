<?php

Doo::loadCore('db/DooModel');

class ClientesBase extends DooModel {

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
    public $birthday;
    public $tipo_client;
    public $points;
    public $left_points;
    public $paid_points;
	public $agency;
    /**
     * @var int Max length is 11.
     */
    public $id;
    public $_table = 'clientes';
    public $_primarykey = 'id';
    public $_fields = array('id', 'username', 'firstname', 'lastname', 'password', 'phone', 'celphone', 'city', 'state', 'country', 'address','zip','birthday', 'tipo_client','points','left_points','paid_points','agency');

}
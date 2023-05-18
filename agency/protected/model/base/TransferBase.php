<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
Doo::loadCore('db/DooModel');
/**
 * Description of TransferBase
 *
 * @author Administrador
 */
class TransferBase extends DooModel{
    //put your code here
    public $id;
    public $type;
    public $type_transfer;
    public $airlie;
    public $flight;
    public $arrival_time;
    public $city;
    public $address;
    public $zipcode;
	public $phone;
    public $total_pax;
    
    /** Discriminacion de precios */
    public $price_adult;
    public $price_child;
    /** fin Discriminacion de precios*/
    
    public $total_price;
    public $estado;
    public $_table = 'transfer';
    public $_primarykey = 'id';
    public $_fields = array('id','type','type_transfer','airlie','flight','arrival_time','city','address','zipcode','phone','total_pax','price_adult','price_child','total_price','estado');
}

<?php
Doo::loadCore('db/DooModel');

class RatesBase extends DooModel{

    /**
     * @var int Max length is 10.
     */
    public $id;

    /**
     * @var double Max length is 10. ,2).
     */
    public $price;

    /**
     * @var double Max length is 10. ,2).
     */
    public $price2;
    public $price3;
	public $price4;
	
    public $_table = 'rates';
    public $_primarykey = 'id';
    public $_fields = array('id','price','price2','price3','price4');

}
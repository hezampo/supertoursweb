<?php
Doo::loadCore('db/DooModel');

class RewardsBase extends DooModel{

	public $id;
	
    public $code;

    public $reward_ticket;

    public $points;
    
	public $ammount_discount;

    public $_table = 'rewards';
    public $_primarykey = 'id';
    public $_fields = array('id','code','reward_ticket','points','ammount_discount');
}
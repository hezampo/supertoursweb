<?phpDoo::loadCore('db/DooModel');class PickupDropoffBase extends DooModel{    /**     * @var int Max length is 10.     */    public $id;    /**     * @var varchar Max length is 4.     */    public $id_area;    /**     * @var varchar Max length is 40.     */    public $place;           public $address;		public $valid;	public $posicion;	public $type_web;				    public $_table = 'pickup_dropoff';    public $_primarykey = 'id';    public $_fields = array('id','id_area','place', 'address','valid','posicion','type_web', 'active_web');}
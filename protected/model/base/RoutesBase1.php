<?phpDoo::loadCore('db/DooModel');class RoutesBase1 extends DooModel{    /**     * @var int Max length is 10.     */    public $id;    /**     * @var varchar Max length is 40.     */    public $trip_from;    /**     * @var varchar Max length is 40.     */    public $trip_to;        public $price;        public $price2;	    public $price3;	    public $price4;    /**     * @var char Max length is 4.     */    public $trip_no;    /**     * @var varchar Max length is 7.     */    public $trip_departure;    /**     * @var varchar Max length is 7.     */    public $trip_arrival;        public $anno;    public $type_rate;    public $id_agency;         public $fecha_ini;        public $fecha_fin;        public $vehicles;        public $capacity;        public $seats_remain;        public $spprc_adult;        public $spprc_child;        public $sdprc_adult;         public $sdprc_child;        public $wfprc_adult;        public $wfprc_child;        public $stprc_adult;        public $stprc_child;        public $sflexprc_adult;    public $sflexprc_child;        public $flresprc_adult;        public $flresprc_child;        public $spseats;        public $sdseats;        public $wfseats;        public $stseats;        public $sflexseats;        public $spprcseats;        public $toursseats;        public $univext;        public $wdext;        /*from orlando to areas(3,4,5,6,7,8,9,10,19,11,12,13,14)*/        public $f1t3;        public $f1t4;        public $f1t5;    public $f1t6;    public $f1t7;    public $f1t8;    public $f1t9;    public $f1t10;    public $f1t19;    public $f1t11;    public $f1t12;    public $f1t13;    public $f1t14;        /*from kissimmee to areas(3,4,5,6,7,8,9,10,19,11,12,13,14)*/        public $f2t3;        public $f2t4;        public $f2t5;    public $f2t6;    public $f2t7;    public $f2t8;    public $f2t9;    public $f2t10;    public $f2t19;    public $f2t11;    public $f2t12;    public $f2t13;    public $f2t14;            /*from Fort Pierce to areas(4,5,6,7,8,9,10,19,11,12,13,14)*/        public $f3t4;        public $f3t5;    public $f3t6;    public $f3t7;    public $f3t8;    public $f3t9;    public $f3t10;    public $f3t19;    public $f3t11;    public $f3t12;    public $f3t13;    public $f3t14;         /*from Lake Worth to areas(5,6,7,8,9,10,19,11,12,13,14)*/            public $f4t5;    public $f4t6;    public $f4t7;    public $f4t8;    public $f4t9;    public $f4t10;    public $f4t19;    public $f4t11;    public $f4t12;    public $f4t13;    public $f4t14;             /*from Fort Lauderdale to areas(6,7,8,9,10,19,11,12,13,14)*/            public $f5t6;    public $f5t7;    public $f5t8;    public $f5t9;    public $f5t10;    public $f5t19;    public $f5t11;    public $f5t12;    public $f5t13;    public $f5t14;    public $_table = 'routes1';    public $_primarykey = 'id';    public $_fields = array('id','trip_from','trip_to','trip_no','price', 'price2','price3','price4','trip_departure','trip_arrival','anno','type_rate','id_agency','fecha_ini','fecha_fin','vehicles','capacity','seats_remain','spprc_adult','spprc_child','sdprc_adult','sdprc_child','wfprc_adult','wfprc_child','stprc_adult','stprc_child','sflexprc_adult','sflexprc_child','flresprc_adult','flresprc_child','spseats','sdseats','wfseats','stseats','sflexseats','spprcseats','toursseats','univext','wdext','f1t3','f1t4','f1t5','f1t6','f1t7','f1t8','f1t9','f1t10','f1t19','f1t11','f1t12','f1t13','f1t14','f2t3','f2t4','f2t5','f2t6','f2t7','f2t8','f2t9','f2t10','f2t19','f2t11','f2t12','f2t13','f2t14','f3t4','f3t5','f3t6','f3t7','f3t8','f3t9','f3t10','f3t19','f3t11','f3t12','f3t13','f3t14','f4t5','f4t6','f4t7','f4t8','f4t9','f4t10','f4t19','f4t11','f4t12','f4t13','f4t14','f5t6','f5t7','f5t8','f5t9','f5t10','f5t19','f5t11','f5t12','f5t13','f5t14');    }
<?php

Doo::loadCore('db/DooModel');

class AgencyBase extends DooModel {

    public $id;
    
    public $company_name;
    
    public $address;
    
    public $address2;
    
    public $city;
    
    public $state;
    
    public $zipcode;
    
    public $main_email;
    
    public $country;
    
    public $manager;
    
    public $birthdate;
    
    public $position;    
    
    public $phone1;    
    
    public $phone2;
    
    public $fax;
    
    public $web_page;
    
    public $iata_clia;
    
    public $voucher_code;
    
    public $type_rate;
    
    public $precio_especial_exten;
    
    public $tax_edit;
    
    public $customer_since;
    
    public $last_sale_date;
    
    public $tour_name;
    
    public $id_tour;
    
    public $spt;
    
    public $special_price_name;  
    
    public $tabla_ruta;
    
    
    public $_table = 'agencia';
    public $_primarykey = 'id';
    public $_fields = array('id', 'company_name', 'address', 'address2', 'city', 'state', 'zipcode', 'main_email', 'country', 'manager', 'birthdate', 'position', 'phone1', 'phone2', 'fax', 'web_page', 'iata_clia', 'voucher_code', 'type_rate', 'precio_especial_exten', 'tax_edit', 'customer_since', 'last_sale_date','tour_name','id_tour','spt','special_price_name','tabla_ruta');

}

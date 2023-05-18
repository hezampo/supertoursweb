<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
Doo::loadCore('db/DooModel');

/**
 * Description of Attraction_TraficBase
 *
 * @author Administrador
 */
class Attraction_TraficBase extends DooModel {

    //put your code here
    public $id;
    public $id_tours;
    public $type_tour;
    public $id_park;
    public $group;
    public $creation_date;
    public $starting_date;
    public $ending_date;
    public $fecha_parque;
    public $admission;
    public $trafic;
    public $id_cliente;
    public $id_agencia;
    public $adult;
    public $child;
    public $total_person;
    public $total_paid;
    public $type_client;
    public $admission_child;
    public $admission_adtul;
    
    /** nuevos campos */
    public $precio_varios;
    public $cantidad;
    public $v_p_child;
    public $v_p_adult;  
    
    public $transpor_adult;
    public $transpor_child;
    /** fin nuevos campos */
    
    public $totalAdmission;
    public $totalTraspor;
    public $_table = 'attraction_trafic';
    public $_primarykey = 'id';
    public $_fields = array('id', 'id_tours', 'type_tour', 'id_park', 'group', 'creation_date', 'starting_date', 'ending_date', 'fecha_parque', 'admission', 'trafic', 'id_cliente', 'type_client', 'id_agencia', 'adult', 'child', 'total_person', 'admission_child', 'admission_adtul', 'totalAdmission', 'precio_varios','cantidad','v_p_child','v_p_adult','transpor_adult','transpor_child','totalTraspor', 'total_paid');

    public function parque_one_days($id) {
        $sql = "select t2.nombre from attraction_trafic t1 left join parques t2 on (t1.id_park = t2.id) where t1.id_tours = ?";
        $rs = Doo::db()->query($sql, array($id));
        $datos = $rs->fetch();
        return $datos;
    }

}

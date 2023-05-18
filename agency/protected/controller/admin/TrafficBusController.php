<?php
DOO::loadController('I18nController');
DOO::loadModel('TrafficBus');
DOO::loadModel('Driver');

class TrafficBusController extends I18nController{

    public function beforeRun($resource, $action) {
        if (!isset($_SESSION['login'])) {
            return Doo::conf()->APP_URL;
        }
    }

    function index(){
        $data = array();

        $sql_all_buses = "select traffic_bus.id, traffic_bus.short_name, traffic_bus.name, traffic_bus.type_bus,
        traffic_bus.capacity, traffic_bus.id_driver, driver.firstname, driver.lastname from traffic_bus
        left join driver
        on driver.id=traffic_bus.id_driver
        order by traffic_bus.short_name, traffic_bus.name";

        $all_buses = $this->db()->query($sql_all_buses);
        $all_buses = $all_buses->fetchAll();

        $data['all_buses'] = $all_buses;
        $data['content'] = 'traffic_bus/index.php';
        $data['rootUrl'] = Doo::conf()->APP_URL;
        $this->renderc('admin/index', $data, true);

    }

    function add(){
        $data = array();

        $bus = new TrafficBus();
        $drivers = new Driver();
        $drivers = $drivers->find();

        $data['bus'] = $bus;
        $data['drivers'] = $drivers;
        $data['content'] = 'traffic_bus/form.php';
        $data['rootUrl'] = Doo::conf()->APP_URL;
        $this->renderc('admin/index', $data, true);
    }

    function save(){
        if(isset($_POST['id'])){
            $id = $_POST['id'];
            if($id == ''){
                $id = null;
            }
        }else{
            $id = null;
        }

        $traffic_bus = new TrafficBus($_POST);

        if($id != null){
            $traffic_bus->id = $id;
            #$traffic_bus = $traffic_bus->getOne();
        }

        if($id != null){
            $this->db()->update($traffic_bus);
        }else{
            $traffic_bus->insert();
        }

        return Doo::conf()->APP_URL . "admin/traffic/buses/index";
    }

    function edit(){
        $id = $this->params['id'];

        $data = array();

        $bus = new TrafficBus();
        $bus->id = $id;
        $bus = $bus->getOne();

        $drivers = new Driver();
        $drivers = $drivers->find();

        $data['drivers'] = $drivers;
        $data['bus'] = $bus;
        $data['content'] = 'traffic_bus/form.php';
        $data['rootUrl'] = Doo::conf()->APP_URL;
        $this->renderc('admin/index', $data, true);
    }

    function delete(){
        if(isset($_POST['id_bus'])){
            $id = $_POST['id_bus'];
        }else{
            return Doo::conf()->APP_URL . "admin/traffic/buses/index";
        }

        $bus = new TrafficBus();
        $bus->id = $id;
        $bus->delete();

        return Doo::conf()->APP_URL . "admin/traffic/buses/index";
    }
}
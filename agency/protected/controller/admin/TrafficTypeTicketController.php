<?php
DOO::loadController('I18nController');
DOO::loadModel('TrafficTypeTicket');

class TrafficTypeTicketController extends I18nController{

    public function beforeRun($resource, $action) {
        if (!isset($_SESSION['login'])) {
            return Doo::conf()->APP_URL;
        }
    }

    function index(){
        $data = array();

        $all_type_tickets = $this->db()->find('TrafficTypeTicket');

        $data['all_type_tickets'] = $all_type_tickets;
        $data['content'] = 'traffic_type_ticket/index.php';
        $data['rootUrl'] = Doo::conf()->APP_URL;
        $this->renderc('admin/index', $data, true);

    }

    function add(){
        $data = array();

        $type_ticket = new TrafficTypeTicket();

        $data['type_ticket'] = $type_ticket;
        $data['content'] = 'traffic_type_ticket/form.php';
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

        $traffic_type_ticket = new TrafficTypeTicket($_POST);

        if($id != null){
            $traffic_type_ticket->id = $id;
            #$traffic_bus = $traffic_bus->getOne();
        }

        if($id != null){
            $this->db()->update($traffic_type_ticket);
        }else{
            $traffic_type_ticket->insert();
        }

        return Doo::conf()->APP_URL . "admin/traffic/type_tickets/index";
    }

    function edit(){
        $id = $this->params['id'];

        $data = array();

        $type_ticket = new TrafficTypeTicket();
        $type_ticket->id = $id;
        $type_ticket = $type_ticket->getOne();

        $data['type_ticket'] = $type_ticket;
        $data['content'] = 'traffic_type_ticket/form.php';
        $data['rootUrl'] = Doo::conf()->APP_URL;
        $this->renderc('admin/index', $data, true);
    }

    function delete(){
        if(isset($_POST['id_bus'])){
            $id = $_POST['id_bus'];
        }else{
            return Doo::conf()->APP_URL . "admin/traffic/type_tickets/index";
        }

        $bus = new TrafficTypeTicket();
        $bus->id = $id;
        $bus->delete();

        return Doo::conf()->APP_URL . "admin/traffic/type_tickets/index";
    }
}
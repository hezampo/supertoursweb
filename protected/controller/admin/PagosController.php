<?php

Doo::loadController('I18nController');
Doo::loadHelper('DooFile');
class PagosController extends I18nController{

    public function beforeRun($resource, $action) {
        if (!isset($_SESSION['login'])) {
            return Doo::conf()->APP_URL;
        }
    }

    public function generar_pago(){
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['content'] = 'pagos/pagos.php';
        if(!isset($this->params['id'])){
            $this->renderc('admin/index',$this->data,true);
        }else{
            $this->data['preload'] = true;
            $this->data['id'] = $this->params['id'];
            Doo::loadModel('Agency');
            $ag = new Agency();
            $ag->id = $this->params['id'];
            $ag = Doo::db()->getOne($ag);
            $this->data['agency'] = $ag;
            $this->renderc('admin/index',$this->data,true);
        }
    }

    public function loadagency(){
        $id = $this->params['id'];
        $sql = 'select company_name, phone1, manager from agencia where id = ?';
        $q = Doo::db()->query($sql,array($id));
        $rs = $q->fetchAll();
        echo json_encode($rs);
    }

    public function get_invoicesa(){
        Doo::loadModel('Factura');
        $id = $this->params['id'];
        $sql = "SELECT f.id,f.creation_date,f.total,f.subtotal,IFNULL(p.descuento,0) as descuento,IFNULL(p.por_descuento,0) as pdescuento, IFNULL(p.monto,0) as monto, (f.subtotal - f.collect) as balance, IFNULL(p.fecha,'') as fecha, IFNULL(p.adjunto,'#') as url FROM Factura AS f LEFT JOIN Pagos AS p ON (p.factura = f.id)
        where f.id_agency = ? AND f.estado = ?";
        $rs = Doo::db()->query($sql,array($id,'UNPAID'));
        $facturas = $rs->fetchAll();
        /*print_r(Doo::db()->showSQL());
        exit;*/
        $output = '';
        foreach($facturas as $factura){

            $output.='<tr>
                      <td><input type="radio" id="'.$factura['id'].'" value="'.$factura['id'].'" name="factura" /></td>
                      <td>'.str_pad($factura['id'],8,'0',STR_PAD_LEFT).'</td>
                      <td><a href="'.Doo::conf()->APP_URL.'admin/facturacion/genpdf/'.$factura['id'].'">
                            <img class="pdficon" src="http://localhost/supertours/global/img/pdf.png">
                          </a></td>
                      <td> '.(($factura['descuento']>0)? '$'.$factura['descuento']:'').'<br>'.(($factura['pdescuento']>0)? '% -'.$factura['pdescuento']:'').'</td>
                      <td>'.$factura['creation_date'].'</td>
                      <td>'.$factura['total'].'<br>'.$factura['subtotal'].'</td>
                      <td>'.$factura['balance'].'
                            <input type="hidden" name="balance-'.$factura['id'].'" id="balance-'.$factura['id'].'" value="'.$factura['balance'].'" /></td>
                      <td>'.$factura['monto'].'</td>
                      <td>'.$factura['fecha'].'</td>
                      <td>'.(($factura['url']== "#")? 'No Att.' : '<a href="'.Doo::conf()->APP_URL.$factura['url'] .'" class="box"><img class="details" src = "'.Doo::conf()->APP_URL.'global/img/details.png"/></a>').'</td>
                      </tr>';

        }
        echo $output;
    }

    public function get_paid_invoicesa(){
        Doo::loadModel('Factura');
        $id = $this->params['id'];
        $sql = "SELECT f.id,f.creation_date,f.total,f.subtotal,IFNULL(p.descuento,0) as descuento,IFNULL(p.por_descuento,0) as pdescuento, IFNULL(p.monto,0) as monto, (f.total - f.collect) as balance, IFNULL(p.fecha,'') as fecha, IFNULL(p.adjunto,'#') as url FROM Factura AS f LEFT JOIN Pagos AS p ON (p.factura = f.id)
        where f.id_agency = ? AND f.estado = ?";
        $rs = Doo::db()->query($sql,array($id,'PAID'));
        $facturas = $rs->fetchAll();
        //echo json_encode($facturas);
        $output = '';
        foreach($facturas as $factura){

            $output.='<tr>
                      <td>'.str_pad($factura['id'],8,'0',STR_PAD_LEFT).'</td>
                      <td> '.(($factura['descuento']>0)? '$'.$factura['descuento']:'').'<br>'.(($factura['pdescuento']>0)? '% -'.$factura['pdescuento']:'').'</td>
                      <td>'.$factura['creation_date'].'</td>
                      <td> s: '.$factura['subtotal'].'<br> T: '.$factura['total'].'</td>
                      <td>'.$factura['monto'].'</td>
                      <td>'.$factura['fecha'].'</td>
                      <td><a href="'.Doo::conf()->APP_URL.'admin/facturacion/genpdf/'.$factura['id'].'"><img src="'.Doo::conf()->APP_URL.'global/img/pdf.png" class="pdficon" /></a></td>
                      <td>'.(($factura['url']== "#")? 'No Att.' : '<a href="'.Doo::conf()->APP_URL.$factura['url'] .'" class="box"><img class="details" src = "'.Doo::conf()->APP_URL.'global/img/details.png"/></a>').'</td>
                      </tr>';

        }
        echo $output;
    }

    public function realizar_pago(){
        Doo::loadModel('Pago');
        Doo::loadModel('Factura');
        $id_factura = $_POST['factura'];
        $factura = new Factura();
        $factura->id = $id_factura;
        $factura = Doo::db()->getOne($factura);
        $pago = new Pago();
        $pago->factura = $id_factura;
        $pago->transnu = $_POST['check-nu'];
        $pago->descuento = $_POST['discount'];
        $pago->per_descuento = $_POST['perdiscount'];
        $pago->monto = $_POST['ammount'];
        $pago->fecha = date('Y-m-d H:m:s');
        $df = new DooFile();
        $file = $df->upload(Doo::conf()->FILE_DIR . '/global/uploads/','attach','att_'.$id_factura.'-'.$pago->fecha.date('Hms'));
        if (isset($file)){
            $pago->adjunto = 'global/uploads/'.$file;
        }
        $pago->insert();
        $balance = $_POST['balance-'.$factura->id];
        $factura->collect = floatval($factura->collect) + floatval($pago->monto) + floatval($pago->descuento) + floatval($pago->per_descuento * $balance);
        $factura->update();

        if(intval($factura->collect) >= intval($factura->subtotal)){
            $factura->estado = "PAID";
            $factura->total = intval($factura->subtotal) - intval($factura->collect) ;
            $factura->update();
        }else{
            $factura->update();
        }
        return Doo::conf()->APP_URL.'admin/pagos/'.$factura->id_agency;
    }

    public function supertours_sales(){
        $this->data['rootUrl'] = Doo::conf()->APP_URL;
        $this->data['content'] = 'pagos/ventas.php';
        $this->renderc('admin/index',$this->data);
    }

    public function get_invoicessu(){

        Doo::loadModel('Factura');
        $id = -1;
        $sql = "SELECT f.id,f.creation_date,f.total,f.subtotal,IFNULL(p.descuento,0) as descuento,IFNULL(p.por_descuento,0) as pdescuento, IFNULL(p.monto,0) as monto, (f.total - f.collect) as balance, IFNULL(p.fecha,'') as fecha, IFNULL(p.adjunto,'#') as url FROM Factura AS f LEFT JOIN Pagos AS p ON (p.factura = f.id)
        where f.id_agency = ? AND f.estado = ? order by f.id DESC";
        $rs = Doo::db()->query($sql,array($id,'PAID'));
        $facturas = $rs->fetchAll();
        //echo json_encode($facturas);
        $output = '';
        foreach($facturas as $factura){

            $output.='<tr>
                      <td>'.str_pad($factura['id'],8,'0',STR_PAD_LEFT).'</td>
                      <td> '.(($factura['descuento']>0)? '$'.$factura['descuento']:'').'<br>'.(($factura['pdescuento']>0)? '% -'.$factura['pdescuento']:'').'</td>
                      <td>'.$factura['creation_date'].'</td>
                      <td> s: '.$factura['subtotal'].'<br> T: '.$factura['total'].'</td>
                      <td>'.$factura['monto'].'</td>
                      <td>'.$factura['fecha'].'</td>
                      <td><a href="'.Doo::conf()->APP_URL.'admin/facturacion/genpdf/'.$factura['id'].'"><img src="'.Doo::conf()->APP_URL.'global/img/pdf.png" class="pdficon" /></a></td>
                      <td>'.(($factura['url']== "#" || $factura['url']== "online-paid")? 'No Att.' : '<a href="'.Doo::conf()->APP_URL.$factura['url'] .'" class="box"><img class="details" src = "'.Doo::conf()->APP_URL.'global/img/details.png"/></a>').'</td>
                      </tr>';

        }
        echo $output;
    }


}

?>
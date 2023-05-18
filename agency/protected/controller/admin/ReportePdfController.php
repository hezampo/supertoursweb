<?php

set_time_limit(320);
ini_set('memory_limit', '356M');
Doo::loadController('I18nController');
ob_start();

Doo::loadHelper('DooFile');

Doo::loadController('DooController');  

class ReportePdfController extends DooController {
    
    
public function mostrar(){

Doo::loadModel("Clientes");
Doo::loadModel("PickupDropoff");
Doo::loadModel("Reserve");

$url_back = '';

$cliente = new Clientes();

$pickup1 = new PickupDropoff();
    
//$reserve->id = $this->params["pindex"];
//$reserve = Doo::db()->find($reserve, array('limit' => 1));
// if (!empty($reserve)) {
$reserve = new Reserve();
$reserve->id = $this->params["pindex"];
            
$id_reserva =  $this->params["pindex"];
//echo  $id_reserva;


//$id_reserve = $this->params['id'];
//echo $id_reserve;
//$reserve = new Reserve(array('id' => $id_reserve));
//$reserve = $reserve->getOne();


$codigoHTML = '

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Resumen de Transportacion</title>
</head>
<body>
 
 	 
<table width="100%" border="0" cellspacing="8" cellpadding="1">

  <tr>
  
      <td  colspan="4"  bgcolor="skyblue"><CENTER><strong>TRANSPORTACION</strong></CENTER></td>
  
  </tr>
  ';

$sql = "SELECT   r1.firsname as nombre,r1.lasname as apellido,r1.email, c2.phone,r1.pax as adult,r1.pax2 as child, r1.pax3 as inf, r1.fecha_salida, p1.place as lugar1, p1.address as direccion1, r1.deptime1, p2.place as lugar2, p2.address as direccion2,
	 r1.trip_no,  r1.fecha_retorno, p3.place as lugar3, p3.address as direccion3,
	 r1.deptime2, p4.place as lugar4, p4.address as direccion4, r1.trip_no2, r1.codconf FROM reservas r1
	 
					LEFT JOIN clientes c2 ON (r1.id_clientes=c2.id) 
					LEFT JOIN pickup_dropoff P1 ON (r1.pickup1=p1.id) 
					LEFT JOIN Pickup_dropoff P2 ON (r1.dropoff1=p2.id) 
					LEFT JOIN pickup_dropoff P3 ON (r1.pickup2=p3.id) 
					LEFT JOIN Pickup_dropoff P4 ON (r1.dropoff2=p4.id)
					WHERE r1.id = ?";

$rs = $this->db()->query($sql, array($reserve->id));

$transp = $rs->fetchAll();

foreach ($transp as $clave=>$key) 
        {
              
    }
            
$nombre = $key['nombre'];
$apellido = $key['apellido'];
$email = $key['email'];
$phone = $key['phone'];
$adult = $key['adult'];
$child = $key['child'];
$infant = $key['inf'];
$fecha_salida = $key['fecha_salida'];
$lugar1 = $key['lugar1'];
$direccion1 = $key['direccion1'];
$deptime1 = $key['deptime1'];
$lugar2 = $key['lugar2'];
$direccion2 = $key['direccion2'];
$trip_no = $key['trip_no'];
$fecha_retorno = $key['fecha_retorno'];
$lugar3 = $key['lugar3'];
$direccion3 = $key['direccion3'];
$deptime2 = $key['deptime2'];
$lugar4 = $key['lugar4'];
$direccion4 = $key['direccion4'];
$trip_no2 = $key['trip_no2'];
$codconf = $key['codconf'];


//foreach ($tours as $tour) {
//            $html .= '<tr>
//                <td>' . $tour['code_conf'] . '</td>
//                <td>' . $tour['length_day'] . '</td>
//                <td>' . $tour['length_nights'] . '</td>
//                <td>' . number_format($tour['totalouta'], 2, '.', '') . '</td>
//            </tr>';
//        }



    $codigoHTML.='	
	<tr>          
            <td><strong>NOMBRE:</strong></td>
            <td>' . $nombre . '</td>
        </tr>
        <tr>
            <td><strong>APELLIDO:</strong></td>
            <td>' . $apellido . '</td>
        </tr>
        <tr>
            <td><strong>E-MAIL:</strong></td>		
            <td>' . $email . '</td>               
        </tr>
        <tr>
            <td><strong>TELEFONO:</strong></td>		
            <td>' . $phone . '</td>               
        </tr>
        <tr>
            <td><strong>ADULT:</strong></td>		
            <td>' . $adult . '</td>               
        </tr>
        <tr>
            <td><strong>CHILD:</strong></td>		
            <td>' . $child . '</td>               
        </tr>
        <tr>
            <td><strong>INFANT:</strong></td>		
            <td>' . $infant . '</td>               
        </tr>
        <tr>
            <td><strong>FECHA DE SALIDA:</strong></td>		
            <td>' . $fecha_salida. '</td>               
        </tr>
        <tr>
            <td><strong>DESDE:</strong></td>		
            <td>' . $lugar1 . '</td>               
        </tr>
        <tr>
            <td><strong>DIRECCION:</strong></td>		
            <td>' . $direccion1 . '</td>               
        </tr>
        <tr>
            <td><strong>HORA DE SALIDA:</strong></td>		
            <td>' . $deptime1 . '</td>               
        </tr>
        <tr>
            <td><strong>HASTA:</strong></td>		
            <td>' . $lugar2 . '</td>               
        </tr>
        <tr>
            <td><strong>DIRECCION:</strong></td>		
            <td>' . $direccion2 . '</td>               
        </tr>
        <tr>
            <td><strong>TRIP:</strong></td>		
            <td>' . $trip_no . '</td>               
        </tr>
        <tr>
            <td><strong>FECHA DE RETORNO:</strong></td>		
            <td>' . $fecha_retorno . '</td>               
        </tr>
        <tr>
            <td><strong>DESDE:</strong></td>		
            <td>' . $lugar3 . '</td>               
        </tr>
        <tr>
            <td><strong>DIRECCION:</strong></td>		
            <td>' . $direccion3 . '</td>               
        </tr>
        <tr>
            <td><strong>RETORNO:</strong></td>		
            <td>' . $deptime2 . '</td>               
        </tr>
        <tr>
            <td><strong>HASTA:</strong></td>		
            <td>' . $lugar4 . '</td>               
        </tr>
        <tr>
            <td><strong>DIRECCION:</strong></td>		
            <td>' . $direccion4 . '</td>               
        </tr> 
        <tr>
            <td><strong>TRIP:</strong></td>		
            <td>' . $trip_no2 . '</td>               
        </tr>       
        <tr>
            <td><strong>COD CONFIRMACION:</strong></td>
            <td>' . $codconf . '</td>										
	</tr>';
    //}
$codigoHTML.='
</table>
</body>
</html>';
//$codigoHTML = utf8_encode($codigoHTML);
//$dompdf = new DOMPDF();
//$dompdf->load_html($codigoHTML);
//ini_set("memory_limit", "256M");
//$dompdf->render();
//$dompdf->stream("Resumen Transportation.pdf");
   
//echo $codigoHTML;
//Doo::loadHelper('DooPDF');
//$pdf = new DooPDF('Service by client ' . $client->firstname . ' ' . $client->lastname, $html, false, 'letter', 'letter');'landscape'
//$pdf->doPDF();

Doo::loadHelper('DooPDF');
$pdf = new DooPDF('Resumen Transportation' . date('Y-m-d'), $codigoHTML, false, 'letter', 'letter');
$pdf->doPDF();

//  }
    }
    

       
  

}